<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Activity Class.
 *
 * @author alfian purnomo <alfian.pacul@gmail.com>
 *
 * @version 3.0
 *
 * @category Controller
 */
class Activity extends CI_Controller
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
        $this->load->model('Activity_model');
        $this->class_path_name = $this->router->fetch_class();
    }

    /**
     * Index page.
     */
    public function index()
    {
        $this->data['menu_title']     = 'Master ';
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
            if (isset($post['order'])) {
                $param['order_field'] = $post['columns'][$post['order'][0]['column']]['data'];
                $param['order_sort']  = $post['order'][0]['dir'];
            }
            $param['row_from']         = $post['start'];
            $param['length']           = $post['length'];
            $count_all_records         = $this->Activity_model->CountAllData();
            $count_filtered_records    = $this->Activity_model->CountAllData($param);
            $records                   = $this->Activity_model->GetAllData($param);
            $return                    = [];
            $return['draw']            = $post['draw'];
            $return['recordsTotal']    = $count_all_records;
            $return['recordsFiltered'] = $count_filtered_records;
            $return['data']            = [];
            foreach ($records as $row => $record) {
                $return['data'][$row]['DT_RowId']    = $record['id'];
                $return['data'][$row]['actions']     = '<a href="'.site_url($this->class_path_name.'/edit/'.$record['id']).'" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                $return['data'][$row]['activity_name']    = $record['activity_name'];
                $return['data'][$row]['activity_description']    = $record['activity_description'];
                
            }
            json_exit($return);
        }
        redirect($this->class_path_name);
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

        if ($this->input->post()) {
            $post = $this->input->post();
            // debugvar($_POST);
            // die();
            if ($this->validateForm()) {
                

                // update data
                $id = $this->Activity_model->InsertRecord($post);
                
                // insert to log
                $data_log = [
                    'id_user'  => id_auth_user(),
                    'id_group' => id_auth_group(),
                    'action'   => 'Activity',
                    'desc'     => 'Add Activity; ID: '.$id.'; Data: '.json_encode($post),
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
        $record = $this->Activity_model->GetActivity($id);
        // $record['channel_distributor'] = explode(',',$record['channel_distributor']);

        /*debugvar($record);
        die();*/
        if (!$record) {
            redirect($this->class_path_name);
        }
        
        
        $this->data['page_title']         = 'Edit';
        $this->data['form_action']        = site_url($this->class_path_name.'/edit/'.$id);
        $this->data['cancel_url']         = site_url($this->class_path_name);
        if ($this->input->post()) {
            $post = $this->input->post();

            if ($this->validateForm($id)) {
                

                // update data
                // debugvar($post);
                // die();
                $this->Activity_model->UpdateRecord($id, $post);
                
                
                
                // insert to log
                $data_log = [
                    'id_user'  => id_auth_user(),
                    'id_group' => id_auth_group(),
                    'action'   => 'Activity',
                    'desc'     => 'Edit Activity; ID: '.$id.'; Data: '.json_encode($post),
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
                        $record = $this->Activity_model->GetActivity($id);
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
                                    $this->Activity_model->DeleteRecord($id);
                                    $json['success'] = alert_box('Data has been deleted', 'success');
                                    $this->session->set_flashdata('flash_message', $json['success']);
                                    // insert to log
                                    $data_log = [
                                        'id_user'  => id_auth_user(),
                                        'id_group' => id_auth_group(),
                                        'action'   => 'Activity',
                                        'desc'     => 'Delete  Activity; ID: '.$id.';',
                                    ];
                                    insert_to_log($data_log);
                                    // end insert to log
                                } else {
                                    $json['error'] = alert_box('You don\'t have permission to delete this record(s). Please contact the Activityistrator.', 'danger');
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
                'field' => 'activity_name',
                'label' => 'Activity Name',
                'rules' => 'required|min_length[3]|max_length[32]|callback_check_activity_name_exists['.$id.']',
            ]
        ];
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() === false) {
            $this->error = alert_box(validation_errors(), 'danger');

            return false;
        } else {
            if (!$this->error) {
                

                return true;
            } else {
                $this->error = alert_box($this->error, 'danger');

                return false;
            }
        }
    }

    /**
     * form validation check activity exist.
     *
     * @param string $string
     * @param int    $id
     *
     * @return bool
     */
    public function check_activity_name_exists($string, $id = 0)
    {
        if (!$this->Activity_model->checkExistsActivity($string, $id)) {
            $this->form_validation->set_message('check_activity_name_exists', '{field} is already exists. Please use different {field}');

            return false;
        }

        return true;
    }

    
}
/* End of file Activity.php */
/* Location: ./application/controllers/Activity.php */
