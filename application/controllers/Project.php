<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Project Class.
 *
 * @author alfian purnomo <alfian.pacul@gmail.com>
 *
 * @version 3.0
 *
 * @category Controller
 */
class Project extends CI_Controller
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
        $this->load->model('Project_model','RAM');
        $this->class_path_name = $this->router->fetch_class();
    }

    /**
     * Index page.
     */
    public function index()
    {
        $this->data['menu_title']     = 'Project';
        $this->data['add_url']        = site_url($this->class_path_name.'/add');
        $this->data['url_data']       = site_url($this->class_path_name.'/list_data');
        $this->data['record_perpage'] = SHOW_RECORDS_DEFAULT;

        
    }

    public function report(){
      $this->data['menu_title']     = 'Project';
      $this->data['add_url']        = site_url($this->class_path_name.'/add');
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
            $param['filterCustom'] = $post['filterCustom'];
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
            $dataStatus = [
              1=>'Open',
              2=>'Close',
              3=>'Cancel'
            ];
            foreach ($records as $row => $record) {
                $return['data'][$row]['DT_RowId']           = $record['id'];
                $return['data'][$row]['actions']            = '<a href="'.site_url($this->class_path_name.'/edit/'.$record['id']).'" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                $return['data'][$row]['title']              = $record['title'];
                $return['data'][$row]['description']        = $record['description'];
                $return['data'][$row]['code']               = isset($record['code']) ? '<a href="'.site_url($this->class_path_name.'/detail/'.$record['id']).'" >'.$record['code'].'</a>' : '';
                $return['data'][$row]['total_employee']     = $record['total_employee'];
                $return['data'][$row]['total_hours']        = $record['total_hours'];
                $return['data'][$row]['status_text']        = $record['status_text'];#isset($record['status']) && $record['status']==1 ? 'Open' : 'Close';
                $return['data'][$row]['default_text']        = $record['default_text'];
                $return['data'][$row]['started']            = $record['started'];
                $return['data'][$row]['start_date']         = custDateFormat($record['start_date'],'d M Y');
                $return['data'][$row]['end_date']           = custDateFormat($record['end_date'],'d M Y');
                
                
                
            }
            json_exit($return);
        }
        redirect($this->class_path_name);
    }

    public function ajax_get_employee(){
        $return = array();
        $this->layout = 'none';
        if ($this->input->is_ajax_request()) {
            $get = $this->input->get();
            // if($get['q']){
                
                $data = $this->db
                        ->like('a.firstname',$get['search'])
                        ->or_like('a.nik',$get['search'])
                        ->where('b.f_auth',1)
                        ->join('t_data_user b','b.id=a.userid')
                        ->get('master_employee a')->result_array();
                if($data){
                    foreach ($data as $key => $value) {
                        $return[] = ['id'=>$value['employeeid'],'text'=>$value['nik'].' - '.$value['firstname'].' - '.$value['lastname'],'name'=>$value['firstname'].' - '.$value['lastname'],'nik'=>$value['nik']];
                    }
                }
            //}
            
            
        }
        return $this->output
          ->set_content_type('application/json')
          ->set_status_header(200)
          ->set_output(json_encode($return));
        exit();
    }

    public function ajax_get_role(){
        $return = array();
        $this->layout = 'none';
        if ($this->input->is_ajax_request()) {
            $get = $this->input->get();
            // if($get['q']){
                
                $data = $this->db
                        ->like('name',$get['search'])
                        
                        ->get('master_role_tasks')->result_array();
                //echo $this->db->last_query();
                if($data){
                    foreach ($data as $key => $value) {
                        $return[] = ['id'=>$value['id_master_role_tasks'],'text'=>$value['name']];
                    }
                }
            //}
            
            
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
        
        $this->data['page_title']  = 'Add';
        $this->data['form_action'] = site_url($this->class_path_name.'/add');
        $this->data['cancel_url']  = site_url($this->class_path_name);
        $this->data['form_action_upload'] = site_url($this->class_path_name.'/check_employee');
        
        if ($this->input->post()) {
            $post = $this->input->post();
            // debugvar($post);
            // die();
            $id_auth_user = id_auth_user();
            if ($this->validateForm()) {
                if($post['is_default']){
                  $post['start_date'] = '1970-01-01';
                  $post['end_date'] = '9999-12-31';
                }
                $dataCreateProject = [
                  'code'=>$post['code'],
                  'invoice_number'=>$post['invoice_number'],
                  'title'=>$post['title'],
                  'description'=>$post['description'],
                  'start_date'=>$post['start_date'],
                  'end_date'=>$post['end_date'],
                  'status'=>$post['status'],
                  'is_started'=>(isset($post['is_started']) ? 1 : 0),
                  'is_default'=>(isset($post['is_default']) ? 1 : 0),
                  'started_date'=>(isset($post['is_started']) ? $post['started_date'] : NULL)
                  
                ];

                $id = $this->RAM->InsertRecord($dataCreateProject);
                if($id){
                  if($post['is_default']){
                    $listEmployee = $this->db->where('deleted',0)->get('master_employee')->result_array();
                    if($listEmployee){
                      foreach ($listEmployee as $key => $value) {
                        $dataInsertEmp[] = [
                          'projectid'=>$id,
                          'employeeid'=>$value['employeeid'],
                          'employee_role'=>2,
                          'start_date'=>'1970-01-01',
                          'end_date'=>'9999-12-31'
                        ];
                      }
                      if($dataInsertEmp){
                        $this->db->insert_batch('mapping_project_employee',$dataInsertEmp);
                      }
                    }
                  }else{
                    if($post['listEmployee']){
                      $dataInsertEmp = [];
                      foreach ($post['listEmployee'] as $key => $value) {
                        $dataInsertEmp[] = [
                          'projectid'=>$id,
                          'employeeid'=>$value['employeeid'],
                          'employee_role'=>$value['employee_role'],
                          'start_date'=>$value['start_date'],
                          'end_date'=>$value['end_date']
                        ];

                      }

                      if($dataInsertEmp){
                        $this->db->insert_batch('mapping_project_employee',$dataInsertEmp);
                      }
                    }
                  }
                  
                } 
                
                
                // insert to log
                $data_log = [
                    'id_user'  => $id_auth_user,
                    'id_group' => id_auth_group(),
                    'action'   => 'Add Project',
                    'desc'     => 'Add Project; ID: '.$id.'; Data: '.json_encode($post),
                ];
                insert_to_log($data_log);
                // end insert to log
                $this->session->set_flashdata('flash_message', alert_box('Success.', 'success'));

                redirect($this->class_path_name);
            }
            $this->data['post'] = $post;
        }
        //$this->data['template'] = $this->class_path_name.'/form';
        if (isset($this->error)) {
            $this->data['form_message'] = $this->error;
        }
    }

    public function detail($id=0){
        $getDetail = $this->RAM->getProject($id);

        $getDataEmployee = $this->db
                            ->select('a.employeeid,e.title,b.employee_role,f.name as role,c.nik,a.projectid,c.firstname,c.lastname,sum(a.hours) as total_hours')
                           ->where('a.projectid',$id)
                           
                           ->where('e.is_delete',0)
                           ->where('a.employeeid=b.employeeid')
                           ->join('mapping_project_employee b','a.projectid=b.projectid')
                           ->join('master_employee c','a.employeeid=c.employeeid')
                           ->join('projects e','e.id_projects=a.projectid')
                           ->join('master_role_tasks f','b.employee_role=f.id_master_role_tasks')
                           ->group_by('a.employeeid')
                           ->get('tasks a')
                           ->result_array();
        // echo $this->db->last_query();
        // die();
        $getDetail['employee_task'] = $getDataEmployee;
        #json_exit($getDetail);
        
        $this->data['post'] = $getDetail;
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
        $record = $this->RAM->getProject($id);
        
        if (!$record) {
            redirect($this->class_path_name);
        }
        // debugvar($record);
        // die();
        $this->data['page_title']         = 'Edit';
        $this->data['form_action']        = site_url($this->class_path_name.'/edit/'.$id);
        $this->data['cancel_url']         = site_url($this->class_path_name);
        $dataRole = $this->db->get('master_role_tasks')->result_array();
        $this->data['dataRole']         = $dataRole;

        if ($this->input->post()) {
            $post = $this->input->post();
            // debugvar($post);
            // die();
            if ($this->validateForm($id)) {
                if($post['is_default']){
                  $post['start_date'] = '1970-01-01';
                  $post['end_date'] = '9999-12-31';
                }
                $dataUpadateProject = [
                  'code'=>$post['code'],
                  'invoice_number'=>$post['invoice_number'],
                  'title'=>$post['title'],
                  'description'=>$post['description'],
                  'start_date'=>$post['start_date'],
                  'end_date'=>$post['end_date'],
                  'status'=>$post['status'],
                  'is_default'=>(isset($post['is_default']) ? 1 : 0),
                  'is_started'=>(isset($post['is_started']) ? 1 : 0),
                  'started_date'=>(isset($post['is_started']) ? $post['started_date'] : NULL)
                ];

                $this->RAM->UpdateRecord($id,$dataUpadateProject);
                if($id){
                  if($post['is_default']){
                    $this->RAM->DeleteRecordMappingEmp($id);
                    $listEmployee = $this->db->where('deleted',0)->get('master_employee')->result_array();
                    if($listEmployee){
                      foreach ($listEmployee as $key => $value) {
                        $dataInsertEmp[] = [
                          'projectid'=>$id,
                          'employeeid'=>$value['employeeid'],
                          'employee_role'=>2,
                          'start_date'=>'1970-01-01',
                          'end_date'=>'9999-12-31'
                        ];
                      }
                      if($dataInsertEmp){
                        $this->db->insert_batch('mapping_project_employee',$dataInsertEmp);
                      }
                    }
                  }else{
                    if($post['listEmployee']){
                      $this->RAM->DeleteRecordMappingEmp($id);
                      $dataInsertEmp = [];
                      foreach ($post['listEmployee'] as $key => $value) {
                        $dataInsertEmp[] = [
                          'projectid'=>$id,
                          'employeeid'=>$value['employeeid'],
                          'employee_role'=>$value['employee_role'],
                          'start_date'=>$value['start_date'],
                          'end_date'=>$value['end_date']
                        ];

                      }

                      if($dataInsertEmp){
                        $this->db->insert_batch('mapping_project_employee',$dataInsertEmp);
                      }
                    }
                  }
                  // if($post['listEmployee']){
                    
                  //   $dataInsertEmp = [];
                  //   foreach ($post['listEmployee'] as $key => $value) {
                  //     $dataInsertEmp[] = [
                  //       'projectid'=>$id,
                  //       'employeeid'=>$value['employeeid'],
                  //       'employee_role'=>$value['employee_role'],
                  //       'start_date'=>$value['start_date'],
                  //       'end_date'=>$value['end_date']
                  //     ];

                  //   }

                  //   if($dataInsertEmp){
                  //     $this->db->insert_batch('mapping_project_employee',$dataInsertEmp);
                  //   }
                  // }
                } 
                // insert to log
                $data_log = [
                    'id_user'  => id_auth_user(),
                    'id_group' => id_auth_group(),
                    'action'   => 'Update Project',
                    'desc'     => 'Update Project; ID: '.$id.'; Data: '.json_encode($post),
                ];
                insert_to_log($data_log);
                // end insert to log
                $this->session->set_flashdata('flash_message', alert_box('Success.', 'success'));

                redirect($this->class_path_name);
            }
        }
        //$this->data['template'] = $this->class_path_name.'/form';
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
                        $record = $this->RAM->getProject($id);
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
                                    $this->RAM->DeleteRecord($id);
                                    $json['success'] = alert_box('Data has been deleted', 'success');
                                    $this->session->set_flashdata('flash_message', $json['success']);
                                    // insert to log
                                    $data_log = [
                                        'id_user'  => id_auth_user(),
                                        'id_group' => id_auth_group(),
                                        'action'   => 'Delete Projects',
                                        'desc'     => 'Delete Projects; ID: '.$id.';',
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
                'field' => 'code',
                'label' => 'Project Code',
                'rules' => 'required|callback_check_code_exists['.$id.']',
            ],
            [
                'field' => 'title',
                'label' => 'Project Name',
                'rules' => 'required',
            ],
            [
                'field' => 'start_date',
                'label' => 'Start Date',
                'rules' => 'required',
            ],
            [
                'field' => 'end_date',
                'label' => 'End Date',
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
    public function check_code_exists($string, $id = 0)
    {
        if (!$this->RAM->checkExistsCode($string, $id)) {
            $this->form_validation->set_message('check_code_exists', '{field} is already exists. Please use different {field}');

            return false;
        }

        return true;
    }

    
}
/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */
