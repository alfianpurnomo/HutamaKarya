<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Employee Class.
 *
 * @author alfian purnomo <alfian.pacul@gmail.com>
 *
 * @version 3.0
 *
 * @category Controller
 */
class Employee extends CI_Controller
{
    /**
     * This show current class.
     *
     * @var string
     */
    private $class_path_name;
    // Columns names after parsing
    private $fields;
    // Separator used to explode each line
    private $separator = ';';
    // Enclosure used to decorate each field
    private $enclosure = '"';
    // Maximum row size to be used for decoding
    private $max_row_size = 4096;

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
        $this->load->model('Employee_model','RAM');
        $this->class_path_name = $this->router->fetch_class();
    }

    /**
     * Index page.
     */
    public function index()
    {
        $this->data['menu_title']     = 'Employee';
        $this->data['upload_url']        = site_url($this->class_path_name.'/add');
        $this->data['url_data']       = site_url($this->class_path_name.'/list_data');
        $this->data['record_perpage'] = SHOW_RECORDS_DEFAULT;
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
            $count_all_records         = $this->RAM->CountAllData();
            $count_filtered_records    = $this->RAM->CountAllData($param);
            $records                   = $this->RAM->GetAllData($param);
            $return                    = [];
            $return['draw']            = $post['draw'];
            $return['recordsTotal']    = $count_all_records;
            $return['recordsFiltered'] = $count_filtered_records;
            $return['data']            = [];
            foreach ($records as $row => $record) {
                $return['data'][$row]['DT_RowId']    = $record['id'];
                
                $return['data'][$row]['nik']        = $record['nik'];
                $return['data'][$row]['name']       = $record['firstname'].' '.$record['lastname'];
                $return['data'][$row]['jobs_name']       = $record['jobs_name'];
                $return['data'][$row]['group_golongan_name']  = $record['group_golongan_name'];
                
                
                
            }
            json_exit($return);
        }
        redirect($this->class_path_name);
    }


    public function check_employee(){
      $this->load->model('Jobs_title_model','JTM');
      $return = array();
      ini_set('memory_limit', -1);
      $this->layout = 'none';
      if(!empty($_FILES['file']['tmp_name']))
      {
        $files = $_FILES['file'];
        
        $filename   = $this->class_path_name.'_'.time();
        $upload = file_copy_to_folder($files, $_SERVER['DOCUMENT_ROOT'].'/HK/'.$this->class_path_name.'s/', $filename);
        $return['path'] = $_SERVER['DOCUMENT_ROOT'].'/HK/'.$this->class_path_name.'s/data_update_employee_04032020.csv';
        $return['file'] = $files;
        
        #$upload = false;
        if (!$upload)
        {
            $return['error'] = "Failed to upload your file";
        }
        else
        {
            
            $get_data = file_get_contents($return['path']);
            $extractFile = $this->parse_csv($get_data);
            //json_exit($extractFile);
            $dataInsertEmployee = [];
            $dataUpdateEmployee = [];
            foreach ($extractFile as $key => $value) {
              if($value['NIK']){
                $check_emp= 0;//$this->db->where('TRIM(nik)',trim($value['NIK']))->get('master_employee')->row_array();
                $getJabatanID = $this->db->where('LCASE(TRIM(jobs_name))',strtolower(trim($value['JOBS NAME'])))->get('jobs_title')->row_array();
                if($getJabatanID){
                  $idJobsDB = $getJabatanID['id_jobs_title'];
                }else{
                  $dataInputJobs = [
                    'jobs_name'=>$value['JOBS NAME']
                  ];
                  $idJobsDB = $this->JTM->InsertRecord($dataInputJobs);

                }
                $explode_name = explode(' ', trim($value['Name']));
                if(count($explode_name) >= 2){
                  $firstname = $explode_name[0];
                  $lastname = '';
                  foreach ($explode_name as $x => $name) {
                    if($x > 0){
                      $lastname  .= $explode_name[$x].' ';
                    }
                    
                  }
                  
                }else{
                  $firstname = $explode_name[0];
                  $lastname =  isset($explode_name[1]) ? $explode_name[1] : '';
                }
                if($check_emp){
                  
                  $dataUpdateEmployee[] = [
                    'employeeid'  =>$check_emp['employeeid'],
                    'firstname'   =>$firstname,
                    'lastname'    =>$lastname,
                    'nik'         =>trim($value['NIK']),
                    'golongan'    =>$value['GOLONGAN'],
                    'sex'         =>$value['KELAMIN'],
                    'department'  =>1,
                    'jobsid'      =>$idJobsDB,
                    'userid'      =>$check_emp['userid']
                  ];
                }else{
                  $dataInsertEmployee[] = [
                    
                    'firstname'   =>$firstname,
                    'lastname'    =>$lastname,
                    'nik'         =>trim($value['NIK']),
                    'golongan'    =>trim($value['GOLONGAN']),
                    'sex'         =>trim($value['KELAMIN']),
                    'department'  =>1,
                    'jobsid'      =>$idJobsDB
                  ];
                }
              }
              
            }
            $return['html'] = '<table style="width: 100%;" class="table table-striped table-bordered table-hover" id="list_range_modal">
                        <thead>
                      <tr>
                        <th>No.</th>
                        <th>NIK</th>
                        <th>Fistname</th>
                        <th>Lastname</th>
                        <th>Golongan</th>
                        <th>Sex</th>
                        <th>Department</th>
                        <th>Jobsid</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>';
            $x = 1;
            if($dataUpdateEmployee){
              
                      foreach ($dataUpdateEmployee as $key => $value) {
                        $return['html'] .= '<tr>
                                              <td>'.$x.'</td>
                                              <td>
                                                <input type="hidden" name="dataUpdateEmployee['.$key.'][nik]" value="'.$value['nik'].'" />
                                                '.$value['nik'].'
                                              </td>
                                              <td>
                                                <input type="hidden" name="dataUpdateEmployee['.$key.'][employeeid]" value="'.$value['employeeid'].'" />
                                                <input type="hidden" name="dataUpdateEmployee['.$key.'][firstname]" value="'.$value['firstname'].'" />'.$value['firstname'].'
                                              </td>
                                              <td>
                                                <input type="hidden" name="dataUpdateEmployee['.$key.'][lastname]" value="'.$value['lastname'].'" />'.$value['lastname'].'
                                              </td>
                                              <td>
                                                <input type="hidden" name="dataUpdateEmployee['.$key.'][golongan]" value="'.$value['golongan'].'" />
                                                '.$value['golongan'].'
                                              </td>
                                              <td>
                                                <input type="hidden" name="dataUpdateEmployee['.$key.'][sex]" value="'.$value['sex'].'" />
                                                '.$value['sex'].'
                                              </td>
                                              <td>
                                                <input type="hidden" name="dataUpdateEmployee['.$key.'][department]" value="'.$value['department'].'" />
                                                '.$value['department'].'
                                              </td>
                                              <td>
                                                <input type="hidden" name="dataUpdateEmployee['.$key.'][jobsid]" value="'.$value['jobsid'].'" />
                                                '.$value['jobsid'].'
                                              </td>
                                              <td>Update Data</td>
                                            </tr>';
                        $x++;
                      }
                      
            }    
            if($dataInsertEmployee){
                foreach ($dataInsertEmployee as $key => $value) {
                  $return['html'] .= '<tr>
                                              <td>'.$x.'</td>
                                              <td>
                                                <input type="hidden" name="dataInsertEmployee['.$key.'][nik]" value="'.$value['nik'].'" />
                                                '.$value['nik'].'
                                              </td>
                                              <td>
                                                
                                                <input type="hidden" name="dataInsertEmployee['.$key.'][firstname]" value="'.$value['firstname'].'" />'.$value['firstname'].'
                                              </td>
                                              <td>
                                                <input type="hidden" name="dataInsertEmployee['.$key.'][lastname]" value="'.$value['lastname'].'" />'.$value['lastname'].'
                                              </td>
                                              <td>
                                                <input type="hidden" name="dataInsertEmployee['.$key.'][golongan]" value="'.$value['golongan'].'" />
                                                '.$value['golongan'].'
                                              </td>
                                              <td>
                                                <input type="hidden" name="dataInsertEmployee['.$key.'][sex]" value="'.$value['sex'].'" />
                                                '.$value['sex'].'
                                              </td>
                                              <td>
                                                <input type="hidden" name="dataInsertEmployee['.$key.'][department]" value="'.$value['department'].'" />
                                                '.$value['department'].'
                                              </td>
                                              <td>
                                                <input type="hidden" name="dataInsertEmployee['.$key.'][jobsid]" value="'.$value['jobsid'].'" />
                                                '.$value['jobsid'].'
                                              </td>
                                              <td>Insert Data</td>
                                            </tr>';
                  $x++;
                }
              }  
              $return['html'] .= '</tbody>
                                </table>';

          

        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($return));
        exit(json_encode($return));
      }
      
    }


    private function extractFile($data)
    {
      $ex_file = explode(PHP_EOL, $data);
      $return = [];
      foreach ($ex_file as $line) {
          
          $return['param'][] = $data;
      }
      return $return;
    }

    private function parse_csv($filepath){
        
        
        #$this->fields = explode(PHP_EOL,$filepath);
        $this->fields = preg_split('/\n|\r\n?/', $filepath);
        $keys_values = explode($this->separator, $this->fields[0]);
        $keys = $this->escape_string($keys_values);
        
        //Store CSV data in an array
        $csvData = array();
        $i = 1;
        foreach ($this->fields  as $key => $value) {
        	if($key != 0){
        		if($value !== NULL){
	        		$values = explode($this->separator, $value);
	        		if(count($keys) == count($values)){
	        			$arr = [];
	        			$new_values = [];
	        			$new_values = $this->escape_string($values);
	        			for($j = 0; $j < count($keys); $j++){
	                        if($keys[$j] != ""){
	                            $arr[$keys[$j]] = $new_values[$j];
	                        }
	                    }
	                    $csvData[$i] = $arr;
	                    $i++;
	        		}
	        	}
        	}
        	
        }
      
        return $csvData;
    }

    private function escape_string($data){
        $result = array();
        foreach($data as $row){
            $result[] = str_replace('"', '', trim($row));
        }
        return $result;
    }

    /**
     * Add page.
     *
     * @return string layout page
     */
    public function add()
    {
        $this->load->model('Admin_model');
        $this->data['page_title']  = 'Add';
        $this->data['form_action'] = site_url($this->class_path_name.'/add');
        $this->data['cancel_url']  = site_url($this->class_path_name);
        $this->data['form_action_upload'] = site_url($this->class_path_name.'/check_employee');
        
        if ($this->input->post()) {
            $post = $this->input->post();
            // echo json_encode($_POST);
            // die();
            $id_auth_user = id_auth_user();
            #if ($this->validateForm()) {
                $update_employee          = $post['dataUpdateEmployee'];
                $insert_employee          = $post['dataInsertEmployee'];
               

               if($insert_employee){
                  $password_hash = password_hash('123456xx',PASSWORD_DEFAULT);
                  foreach ($insert_employee as $key => $value) {
                    $data_insert_user = [
                      'f_firstname'=>$value['firstname'],
                      'f_lastname'=>$value['lastname'],
                      'f_password'=>$password_hash,
                      'f_mail'=>str_replace('.', '', $value['nik']).'@mail.com',
                      'f_username'=>str_replace('.', '', $value['nik']),
                      'f_auth'=>1,
                      'f_grouprole'=>3

                    ];
                    $id = $this->Admin_model->InsertRecord($data_insert_user);
                    if($id){
                        //$employeeid = $this->db->select('uuid()');
                      $data_employee = [
                          'userid'=>$id,
                          'jobsid'=>$value['jobsid'],
                          'firstname'=>$value['firstname'],
                          'lastname'=>$value['lastname'],
                          'nik'=>$value['nik'],
                          'email'=>str_replace('.', '', $value['nik']).'@mail.com',
                          'department'=>$value['department'],
                          'golongan'=>$value['golongan'],
                          'sex'=>$value['sex']
                      ];
                      
                      $this->Admin_model->InsertEmployee($data_employee);
                    }
                  }
                  
               }

                // update data
                
                
                // insert to log
                $data_log = [
                    'id_user'  => $id_auth_user,
                    'id_group' => id_auth_group(),
                    'action'   => 'Update Emoloyee',
                    'desc'     => 'Update Emoloyee; ID: 1; Data: '.json_encode($post),
                ];
                insert_to_log($data_log);
                // end insert to log
                $this->session->set_flashdata('flash_message', alert_box('Success.', 'success'));

                redirect($this->class_path_name);
            #}
            $this->data['post'] = $post;
        }
        //$this->data['template'] = $this->class_path_name.'/form';
        if (isset($this->error)) {
            $this->data['form_message'] = $this->error;
        }
    }

    public function detail($id=0){
        $getDetail = $this->BKM_HK->getDetail($id);
        
        $this->data['detail'] = $getDetail;
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

        /*debugvar($record);
        die();*/
        if (!$record) {
            redirect($this->class_path_name);
        }
        if ($record['is_superadmin'] == 1 && !is_superadmin()) {
            $this->session->set_flashdata('flash_message', alert_box('You don\'t have rights to manage this record. Please contact Your Administrator', 'danger'));
            redirect($this->class_path_name);
        }
        $this->data['groups']             = $this->Admin_model->GetGroups();
        $this->data['user_locations']     = $this->Admin_model->GetUserLocations();
        $this->data['channel_distributor'] = [];
        $this->data['main_channel'] = aray();
		
		$this->data['company']			= [];
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
                // $post['ChannelDistributor_code'] = implode(',',$_POST['ChannelDistributor_code']);
                $post['ChannelDistributor_code'] = $this->Admin_model->getDistributorByCompany($post['company_id']);
                $post['master_mainchannel_code'] = $this->Admin_model->getMainChannelByCompany($post['company_id']);

                if (!empty($post['f_password'])) {
                    $post['f_password'] = password_hash($post['f_password'],PASSWORD_DEFAULT);
                }else{
                  unset($post['f_password']);
                }
                //unset($post['f_password']);
                unset($post['conf_password']);

                // update data
                // debugvar($post);
                // die();
                $this->Admin_model->UpdateRecord($id, $post);
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
                'field' => 'logbook_date',
                'label' => 'LogBook Date',
                'rules' => 'required',
            ],
            [
                'field' => 'division',
                'label' => 'Divisi',
                'rules' => 'required',
            ]
        ];
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
