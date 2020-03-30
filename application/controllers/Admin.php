<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Admin Class.
 *
 * @author alfian purnomo <alfian.pacul@gmail.com>
 *
 * @version 3.0
 *
 * @category Controller
 */
class Admin extends CI_Controller
{
    /**
     * This show current class.
     *
     * @var string
     */
    private $class_path_name;

    /**
     * Error message/system.
     *
     * @var string
     */
    private $error;

    /**
     * Class contructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->class_path_name = $this->router->fetch_class();
    }

    /**
     * Index page.
     */
    public function index()
    {
        $this->data['menu_title']     = 'Master User';
        $this->data['add_url']        = site_url($this->class_path_name.'/add');
        $this->data['url_data']       = site_url($this->class_path_name.'/list_data');
        $this->data['record_perpage'] = SHOW_RECORDS_DEFAULT;
    }

    public function upload_employee(){
        $this->layout = 'none';
        $file = UPLOAD_DIR. $this->class_path_name. '/master_employee.csv';
        

    }

    /**
     * listing data from record.
     *
     * @return json $return
     */
    public function list_data()
    {
        $this->layout = 'none';
        if ($this->input->post() && $this->input->is_ajax_request()) {
            $post = $this->input->post();
            $param['search_value'] = $post['search']['value'];
            $param['search_field'] = $post['columns'];
            if (isset($post['order'])) {
                $param['order_field'] = $post['columns'][$post['order'][0]['column']]['data'];
                $param['order_sort']  = $post['order'][0]['dir'];
            }
            $param['row_from']         = $post['start'];
            $param['length']           = $post['length'];
            $count_all_records         = $this->Admin_model->CountAllData();
            $count_filtered_records    = $this->Admin_model->CountAllData($param);
            $records                   = $this->Admin_model->GetAllData($param);
            $return                    = [];
            $return['draw']            = $post['draw'];
            $return['recordsTotal']    = $count_all_records;
            $return['recordsFiltered'] = $count_filtered_records;
            $return['data']            = [];
            foreach ($records as $row => $record) {
                $return['data'][$row]['DT_RowId']    = $record['id'];
                $return['data'][$row]['actions']     = '<a href="'.site_url($this->class_path_name.'/edit/'.$record['id']).'" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                $return['data'][$row]['f_username']    = $record['f_username'];
                $return['data'][$row]['f_firstname']        = $record['f_firstname'];
                $return['data'][$row]['f_mail']       = $record['f_mail'];
                $return['data'][$row]['auth_group']  = $record['auth_group'];
                $return['data'][$row]['f_last_login'] = ($record['f_last_login']!='0000-00-00 00:00:00')?custDateFormat($record['f_last_login'], 'd M Y H:i:s') : '';
            }
            json_exit($return);
        }
        redirect($this->class_path_name);
    }

    /**
     * ajax get distributtor channel.
     *
     * @return string layout page
     */
    public function get_distributtor_channel()
    {
        $return = array();
        $this->layout = 'none';
        if ($this->input->post() && $this->input->is_ajax_request()) {
            $post = $this->input->post();
            $distributor_code = explode(',',$post['distributor_code']);
            $return['html'] = '<option value="0">Choose Channel Distributor</option>';
            $channel_distributor = $this->Admin_model->GetChannelDistributor(array('master_mainchannel_code'=> $post['master_mainchannel_code']));
            if(count($channel_distributor)>0) foreach($channel_distributor as $i=>$val)
            {
                $selected = "";
                if(count($distributor_code)>0)
                {
                  if(in_array($val['ChannelDistributor_code'],$distributor_code))
                  {
                    $selected = "selected";
                  }
                }
                $return['html'] .= '<option '.$selected.' value="'.$val['ChannelDistributor_code'].'">'.$val['salesdealer_codename'].'</option>';
            }
        }
        return $this->output
          ->set_content_type('application/json')
          ->set_status_header(200)
          ->set_output(json_encode($return));
        exit();
    }

    /**
     * Add page.
     *
     * @return string layout page
     */
    public function add()
    {
        // $employeeid = $this->db->select('uuid()');
        // debugvar($employeeid); 
        // die();


        $this->data['groups']               = $this->Admin_model->GetGroups();
        $this->data['jobs']                 = $this->Admin_model->GetJobs();
        $this->data['departments']          = $this->Admin_model->GetDepartment();
        $this->data['golongans']            = $this->Admin_model->GetGolongan();
        #json_exit($this->data);
        $this->data['page_title']  = 'Add';
        $this->data['form_action'] = site_url($this->class_path_name.'/add');
        $this->data['cancel_url']  = site_url($this->class_path_name);

        if ($this->input->post()) {
            $post = $this->input->post();
            // debugvar($_POST);
            // die();
            if ($this->validateForm()) {
                $post['f_auth']        = (isset($post['f_auth'])) ?: 0;
                $post['is_superadmin'] = (isset($post['is_superadmin'])) ? : 0;
                $post['f_mail']         = strtolower($post['f_mail']);
                $post['f_password'] = password_hash($post['f_password'],PASSWORD_DEFAULT);
                $nik = $post['f_nik'];
                $jobsid = $post['jobsid'];
                $department             = $post['department'];
                $golongan                 = $post['golongan'];
                $sex                 = $post['sex'];
                // $post['ChannelDistributor_code'] = implode(',',$_POST['ChannelDistributor_code']);
                unset($post['f_nik']);
                unset($post['conf_password']);
                unset($post['jobsid']);
                unset($post['department']);
                unset($post['golongan']);
                unset($post['sex']);
                
                
                unset($post['employeeid']);

                // update data
                $id = $this->Admin_model->InsertRecord($post);
                if($id){
                    //$employeeid = $this->db->select('uuid()');
                    $data_employee = [
                        'userid'=>$id,
                        'jobsid'=>$jobsid,
                        'firstname'=>$post['f_firstname'],
                        'lastname'=>$post['f_lastname'],
                        'nik'=>$nik,
                        'email'=>$post['f_mail'],
                        'handphone'=>$post['f_phone'],
                        'department'=>$department,
                        'golongan'=>$golongan,
                        'sex'=>$sex
                    ];
                    
                    $this->Admin_model->InsertEmployee($data_employee);


                    $this->connectEmployeeToDefaultProject($id,$post['f_auth']);
                    // if($post['f_auth']){
                    //     $getProjectDefaults = $this->db
                    //                             ->where('is_default',1)
                    //                             ->get('projects')->result_array();
                    //     $UUID = $this->db
                    //                             ->where('userid',$id)
                    //                             ->get('master_employee')->row_array();
                    //     if($getProjectDefaults){
                    //         $dataEmpDefault = [];
                    //         foreach ($getProjectDefaults as $k => $v) {
                    //             $dataEmpDefault = [
                                    
                    //                   'projectid'=>$v['id_projects'],
                    //                   'employeeid'=>$UUID['employeeid'],
                    //                   'employee_role'=>2,
                    //                   'start_date'=>'1970-01-01',
                    //                   'end_date'=>'9999-12-31'
                                    
                    //             ];
                    //         }

                    //         if($dataEmpDefault){
                    //             $this->db->insert_batch('mapping_project_employee',$dataEmpDefault);
                    //         }
                    //     }
                    // }
                }

                unset($post['f_password']);
                $post_image = $_FILES;
                if ($post_image['image']['tmp_name']) {
                    $filename   = 'adm_'.url_title($post['f_firstname'].'_'.$post['f_lastname'], '_', true).md5plus($id);
                    $picture_db = file_copy_to_folder($post_image['image'], UPLOAD_DIR. $this->class_path_name. '/', $filename);
                    copy_image_resize_to_folder(UPLOAD_DIR. $this->class_path_name. '/'.$picture_db, UPLOAD_DIR. $this->class_path_name. '/', 'tmb_'.$filename, IMG_THUMB_WIDTH, IMG_THUMB_HEIGHT, 70);
                    copy_image_resize_to_folder(UPLOAD_DIR. $this->class_path_name. '/'.$picture_db, UPLOAD_DIR. $this->class_path_name. '/', 'sml_'.$filename, IMG_SMALL_WIDTH, IMG_SMALL_HEIGHT, 70);
                    // update data
                    $this->Admin_model->UpdateRecord($id, ['image' => $picture_db]);
                }
                // insert to log
                $data_log = [
                    'id_user'  => id_auth_user(),
                    'id_group' => id_auth_group(),
                    'action'   => 'User Admin',
                    'desc'     => 'Add User Admin; ID: '.$id.'; Data: '.json_encode($post),
                ];
                insert_to_log($data_log);
                // end insert to log
                $this->session->set_flashdata('flash_message', alert_box('Success.', 'success'));

                redirect($this->class_path_name);
            }
            $this->data['post'] = $post;
        }
        $this->data['template'] = $this->class_path_name.'/form';
        if (isset($this->error)) {
            $this->data['form_message'] = $this->error;
        }
    }


    private function connectEmployeeToDefaultProject($id_employee,$status){
        if($status){
            $getProjectDefaults = $this->db
                                        ->where('is_default',1)
                                        ->get('projects')->result_array();
            $UUID = $this->db
                        ->where('userid',$id_employee)
                        ->get('master_employee')->row_array();
            // debugvar($UUID);
            // die();
            if($getProjectDefaults){
                $dataEmpDefault = [];
                foreach ($getProjectDefaults as $k => $v) {
                    $dataEmpDefault[] = [
                        
                          'projectid'=>$v['id_projects'],
                          'employeeid'=>$UUID['employeeid'],
                          'employee_role'=>2,
                          'start_date'=>'1970-01-01',
                          'end_date'=>'9999-12-31'
                        
                    ];
                }

                if($dataEmpDefault){
                    // debugvar($dataEmpDefault);
                    // die();
                    $this->db->insert_batch('mapping_project_employee',$dataEmpDefault);
                }
            }
        }else{
            $UUID = $this->db
                        ->where('userid',$id_employee)
                        ->get('master_employee')->row_array();
            if($UUID){
                $this->db->where('employeeid',$UUID['employeeid']);
                $this->db->delete('mapping_project_employee');
            }
        }
        
    }

    /**
     * Detail/Edit Page.
     *
     * @param int $id
     *
     * @return string layout
     */
    public function edit($id = 0)
    {
        if (!$id) {
            redirect($this->class_path_name);
        }
        $record = $this->Admin_model->GetAdmin($id);
        // $record['channel_distributor'] = explode(',',$record['channel_distributor']);

        // debugvar($record);
        // die();
        if (!$record) {
            redirect($this->class_path_name);
        }
        if ($record['is_superadmin'] == 1 && !is_superadmin()) {
            $this->session->set_flashdata('flash_message', alert_box('You don\'t have rights to manage this record. Please contact Your Administrator', 'danger'));
            redirect($this->class_path_name);
        }
        $this->data['groups']               = $this->Admin_model->GetGroups();
        $this->data['jobs']                 = $this->Admin_model->GetJobs();
        $this->data['departments']          = $this->Admin_model->GetDepartment();
        $this->data['golongans']            = $this->Admin_model->GetGolongan();
        //json_exit($this->data);
        $this->data['page_title']         = 'Edit';
        $this->data['form_action']        = site_url($this->class_path_name.'/edit/'.$id);
        $this->data['delete_picture_url'] = site_url($this->class_path_name.'/delete_picture/'.$id);
        $this->data['cancel_url']         = site_url($this->class_path_name);
        if ($this->input->post()) {
            $post = $this->input->post();

            if ($this->validateForm($id)) {
                $post['modify_date']   = date('Y-m-d H:i:s');
                $post['f_auth']        = (isset($post['f_auth'])) ?: 0;
                $post['is_superadmin'] = (isset($post['is_superadmin'])) ?: 0;
                $post['f_mail']         = strtolower($post['f_mail']);
                $nik                    = $post['f_nik'];
                $employeeid             = $post['employeeid'];
                $jobsid                 = $post['jobsid'];

                $department             = $post['department'];
                $golongan                 = $post['golongan'];
                $sex                 = $post['sex'];
                // $post['ChannelDistributor_code'] = implode(',',$_POST['ChannelDistributor_code']);
                
                if (!empty($post['f_password'])) {
                    $post['f_password'] = password_hash($post['f_password'],PASSWORD_DEFAULT);
                }else{
                  unset($post['f_password']);
                }
                //unset($post['f_password']);
                unset($post['conf_password']);
                unset($post['sex']);
                unset($post['employeeid']);
                unset($post['f_nik']);
                unset($post['jobsid']);
                unset($post['department']);
                unset($post['golongan']);

                // update data
                // debugvar($post);
                // die();
                $this->Admin_model->UpdateRecord($id, $post);

                if($employeeid){
                    $data_employee = [
                        'firstname'=>$post['f_firstname'],
                        'lastname'=>$post['f_lastname'],
                        'jobsid'=>$jobsid,
                        'nik'=>$nik,
                        'email'=>$post['f_mail'],
                        'handphone'=>$post['f_phone'],
                        'department'=>$department,
                        'golongan'=>$golongan,
                        'sex'=>$sex
                    ];
                    $this->Admin_model->UpdateEmployee($employeeid, $data_employee);
                }
                $this->connectEmployeeToDefaultProject($id,$post['f_auth']);
                
                unset($post['f_password']);
                // now change session if user is edit themselve
                if (id_auth_user() == $id) {
                    $user_session                        = $_SESSION['ADM_SESS'];
                    $user_session['admin_name']          = $post['f_firstname'].' '.$post['f_lastname'];
                    $user_session['admin_id_auth_group'] = $post['f_grouprole'];
                    $user_session['admin_email']         = strtolower($post['f_mail']);
                    $_SESSION['ADM_SESS']                = $user_session;
                }
                $post_image = $_FILES;
                if ($post_image['image']['tmp_name']) {
                    if ($record['image'] != '' && file_exists(UPLOAD_DIR. $this->class_path_name. '/'.$record['image'])) {
                        unlink(UPLOAD_DIR. $this->class_path_name. '/'.$record['image']);
                        @unlink(UPLOAD_DIR. $this->class_path_name. '/tmb_'.$record['image']);
                        @unlink(UPLOAD_DIR. $this->class_path_name. '/sml_'.$record['image']);
                    }
                    $filename   = 'adm_'.url_title($post['f_firstname'].'_'.$post['f_lastname'], '_', true).md5plus($id);
                    $picture_db = file_copy_to_folder($post_image['image'], UPLOAD_DIR. $this->class_path_name. '/', $filename);
                    copy_image_resize_to_folder(UPLOAD_DIR. $this->class_path_name. '/'.$picture_db, UPLOAD_DIR. $this->class_path_name. '/', 'tmb_'.$filename, IMG_THUMB_WIDTH, IMG_THUMB_HEIGHT, 70);
                    copy_image_resize_to_folder(UPLOAD_DIR. $this->class_path_name. '/'.$picture_db, UPLOAD_DIR. $this->class_path_name. '/', 'sml_'.$filename, IMG_SMALL_WIDTH, IMG_SMALL_HEIGHT, 70);
                    // update data
                    $this->Admin_model->UpdateRecord($id, ['image' => $picture_db]);
                }
                // insert to log
                $data_log = [
                    'id_user'  => id_auth_user(),
                    'id_group' => id_auth_group(),
                    'action'   => 'User Admin',
                    'desc'     => 'Edit User Admin; ID: '.$id.'; Data: '.json_encode($post),
                ];
                insert_to_log($data_log);
                // end insert to log
                $this->session->set_flashdata('flash_message', alert_box('Success.', 'success'));

                redirect($this->class_path_name);
            }
        }
        $this->data['template'] = $this->class_path_name.'/form';
        $this->data['post']     = $record;
        if (isset($this->error)) {
            $this->data['form_message'] = $this->error;
        }
    }

    /**
     * Delete page.
     *
     * @return json $json
     */
    public function delete()
    {
        $this->layout = 'none';
        if ($this->input->post() && $this->input->is_ajax_request()) {
            $post = $this->input->post();
            $json = [];
            if ($post['ids'] != '') {
                $array_id = array_map('trim', explode(',', $post['ids']));
                if (count($array_id) > 0) {
                    foreach ($array_id as $row => $id) {
                        $record = $this->Admin_model->GetAdmin($id);
                        if ($record) {
                            if ($id == id_auth_user()) {
                                $json['error'] = alert_box('You can\'t delete Your own account.', 'danger');
                                break;
                            } else {
                                if (is_superadmin()) {
                                    /*if ($record['image'] != '' && file_exists(UPLOAD_DIR. $this->class_path_name. '/'.$record['image'])) {
                                        unlink(UPLOAD_DIR. $this->class_path_name. '/'.$record['image']);
                                        @unlink(UPLOAD_DIR. $this->class_path_name. '/tmb_'.$record['image']);
                                        @unlink(UPLOAD_DIR. $this->class_path_name. '/sml_'.$record['image']);
                                    }*/
                                    $this->Admin_model->DeleteRecord($id);
                                    $this->Admin_model->DeleteEmployee($id);
                                    $json['success'] = alert_box('Data has been deleted', 'success');
                                    $this->session->set_flashdata('flash_message', $json['success']);
                                    // insert to log
                                    $data_log = [
                                        'id_user'  => id_auth_user(),
                                        'id_group' => id_auth_group(),
                                        'action'   => 'User Admin',
                                        'desc'     => 'Delete User Admin; ID: '.$id.';',
                                    ];
                                    insert_to_log($data_log);
                                    // end insert to log
                                } else {
                                    $json['error'] = alert_box('You don\'t have permission to delete this record(s). Please contact the Administrator.', 'danger');
                                    break;
                                }
                            }
                        } else {
                            $json['error'] = alert_box('Failed. Please refresh the page.', 'danger');
                            break;
                        }
                    }
                }
            }
            json_exit($json);
        }
        redirect($this->class_path_name);
    }

    /**
     * Delete Picture.
     *
     * @return json $json
     */
    public function delete_picture()
    {
        $this->layout = 'none';
        if ($this->input->post() && $this->input->is_ajax_request()) {
            $json = [];
            $post = $this->input->post();
            if (isset($post['id']) && $post['id'] > 0 && ctype_digit($post['id'])) {
                $detail = $this->Admin_model->GetAdmin($post['id']);
                if ($detail && $detail['image'] != '') {
                    $id = $post['id'];
                    unlink(UPLOAD_DIR. $this->class_path_name. '/'.$detail['image']);
                    @unlink(UPLOAD_DIR. $this->class_path_name. '/tmb_'.$detail['image']);
                    @unlink(UPLOAD_DIR. $this->class_path_name. '/sml_'.$detail['image']);
                    $data_update = ['image' => ''];
                    $this->Admin_model->UpdateRecord($post['id'], $data_update);
                    $json['success'] = alert_box('File hase been deleted.', 'success');
                    // insert to log
                    $data_log = [
                        'id_user'  => id_auth_user(),
                        'id_group' => id_auth_group(),
                        'action'   => 'User Admin',
                        'desc'     => 'Delete Picture User Admin; ID: '.$id.';',
                    ];
                    insert_to_log($data_log);
                    // end insert to log
                } else {
                    $json['error'] = alert_box('Failed to remove File. Please try again.', 'danger');
                }
            }
            json_exit($json);
        }
        redirect($this->class_path_name);
    }

    /**
     * Validate Form.
     *
     * @param int $id
     *
     * @return bool
     */
    private function validateForm($id = 0)
    {
        $post = $this->input->post();
        $rules = [
            [
                'field' => 'f_username',
                'label' => 'Username',
                'rules' => 'required|min_length[3]|max_length[32]|alpha_dash|callback_check_username_exists['.$id.']',
            ],
            [
                'field' => 'f_nik',
                'label' => 'NIK',
                'rules' => 'required|min_length[3]',
            ],
            [
                'field' => 'f_grouprole',
                'label' => 'Group',
                'rules' => 'required|is_natural_no_zero',
            ],
            [
                'field' => 'f_firstname',
                'label' => 'First Name',
                'rules' => 'required|alpha_numeric_spaces',
            ],
            [
                'field' => 'f_lastname',
                'label' => 'Last Name',
                'rules' => 'required|alpha_numeric_spaces',
            ],
            [
                'field' => 'f_mail',
                'label' => 'Email',
                'rules' => 'required|valid_email|callback_check_email_exists['.$id.']',
            ],
            [
                'field' => 'f_grouprole',
                'label' => 'Group',
                'rules' => 'required|is_natural_no_zero',
            ],
        ];
        if ( ! $id) {
            array_push($rules,
                [
                    'field' => 'f_password',
                    'label' => 'Password',
                    'rules' => 'required',
                ],
                [
                    'field' => 'conf_password',
                    'label' => 'Password Confirmation',
                    'rules' => 'required|matches[f_password]',
                ]);
        } else {
            if (strlen($post['f_password']) > 0) {
                array_push($rules,
                    [
                        'field' => 'f_password',
                        'label' => 'Password',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'conf_password',
                        'label' => 'Password Confirmation',
                        'rules' => 'required|matches[f_password]',
                    ]);
            }
        }
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() === false) {
            $this->error = alert_box(validation_errors(), 'danger');

            return false;
        } else {
            $post_image = $_FILES;
            if (!$this->error) {
                if ( ! empty($post_image['image']['tmp_name'])) {
                    $check_picture = validatePicture('image');
                    if ( ! empty($check_picture)) {
                        $this->error = alert_box($check_picture, 'danger');

                        return false;
                    }
                }

                return true;
            } else {
                $this->error = alert_box($this->error, 'danger');

                return false;
            }
        }
    }

    /**
     * form validation check email exist.
     *
     * @param string $string
     * @param int    $id
     *
     * @return bool
     */
    public function check_email_exists($string, $id = 0)
    {
        if (!$this->Admin_model->checkExistsEmail($string, $id)) {
            $this->form_validation->set_message('check_email_exists', '{field} is already exists. Please use different {field}');

            return false;
        }

        return true;
    }

    /**
     * form validation check username exist.
     *
     * @param string $string
     * @param int    $id
     *
     * @return bool
     */
    public function check_username_exists($string, $id = 0)
    {
        if (!$this->Admin_model->checkExistsUsername($string, $id)) {
            $this->form_validation->set_message('check_username_exists', '{field} is already exists. Please use different {field}');

            return false;
        }

        return true;
    }
}
/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */
