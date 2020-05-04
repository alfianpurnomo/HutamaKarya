<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * LPD Class.
 *
 * @author alfian purnomo <alfian.pacul@gmail.com>
 *
 * @version 3.0
 *
 * @category Controller
 */
class LPD extends CI_Controller
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
        $this->load->model('LPD_model');
        $this->class_path_name = $this->router->fetch_class();
        $this->location_upload = $_SERVER['DOCUMENT_ROOT'].'/SPJ_Online_HK/'.strtoupper($this->router->fetch_class()).'S/';
        // echo base_url();
        // die();
    }

    /**
     * Index page.
     */
    public function index()
    {
        $this->data['menu_title']     = 'Master User';
        $this->data['add_url']        = site_url($this->class_path_name.'/create');
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
            $count_all_records         = $this->LPD_model->CountAllData();
            $count_filtered_records    = $this->LPD_model->CountAllData($param);
            $records                   = $this->LPD_model->GetAllData($param);
            $return                    = [];
            $return['draw']            = $post['draw'];
            $return['recordsTotal']    = $count_all_records;
            $return['recordsFiltered'] = $count_filtered_records;
            $return['data']            = [];
            foreach ($records as $row => $record) {
                $action = '<a href="'.site_url($this->class_path_name.'/edit/'.$record['id']).'" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                if(is_superadmin() || id_auth_group()==2){
                    $action .= '<a href="'.site_url($this->class_path_name.'/validation/'.$record['id']).'" class="btn btn-sm btn-warning"><i class="fa fa-check-square-o" aria-hidden="true"></i></a>';
                }
                $return['data'][$row]['DT_RowId']    = $record['id'];
                $return['data'][$row]['actions']     = $action;
                $return['data'][$row]['spj_doc_no']                     = $record['spj_doc_no'];
                $return['data'][$row]['employee_name']             = $record['employee_name'];
                
                $return['data'][$row]['status']          = $record['status'];
                
            }
            json_exit($return);
        }
        redirect($this->class_path_name);
    }

    

    public function print_document($id){
        $this->layout = 'print_a4';
        if (!$id) {
            redirect($this->class_path_name);
        }
        $record = $this->LPD_model->GetLPD($id);
        
        if (!$record) {
            redirect($this->class_path_name);
        }
        $this->data['detailLPD'] = $record;
        //json_exit($record);
    }

    public function ajax_edit_detail(){
        $this->layout = 'none';
        if($this->input->post() && $this->input->is_ajax_request()){
            $post = $this->input->post();
            $file_kwitansi = $_FILES['file_kwitansi'];
            $picture_db = isset($post['old_file']) ? $post['old_file'] : null;
            
            if($file_kwitansi['tmp_name']){
                
                if($post['old_file']){
                    unlink($this->location_upload.$post['old_file']);
                }
                $filename   = 'file_'.url_title($post['detail_activity'], '_', true).md5plus(time());
                $picture_db = file_copy_to_folderArray($file_kwitansi['name'],$file_kwitansi['tmp_name'], $this->location_upload, $filename);
            }
            
            $data_update = [
                'detail_activity'=>$post['detail_activity'],
                'check_number'=>$post['check_number'],
                'amount'=>$post['amount'],
                'final_amount'=>$post['amount'],
                'file_attachment'=>$picture_db
            ];

            $this->db->where('id_detail_travel_bill',$post['id_detail_travel_bill']);
            $this->db->update('detail_travel_bill',$data_update);

            $data_log = [
                'id_user'  => id_auth_user(),
                'id_group' => id_auth_group(),
                'action'   => 'Edit Detail LPD',
                'desc'     => 'Edit Detail LPD; ID: '.$post['id_detail_travel_bill'].'; Data: '.json_encode($post),
            ];
            insert_to_log($data_log);
            //echo 'ads';
            $return['status'] = 'success';
            json_exit($return);
            

        }
    }

    public function delete_item_lpd(){
        $this->layout = 'none';
        if($this->input->post() && $this->input->is_ajax_request()){
            $post = $this->input->post();
            $this->db->where('id_detail_travel_bill',$post['id_detail_travel_bill']);
            $this->db->update('detail_travel_bill',['is_delete'=>1]);

            //$this->db->insert('spj_status_history',$data_log_status);
            $data_log = [
                'id_user'  => id_auth_user(),
                'id_group' => id_auth_group(),
                'action'   => 'Delete Item LPD',
                'desc'     => 'Delete Item LPD; ID: '.$post['id_detail_travel_bill'].'; Data: '.json_encode($post),
            ];
            insert_to_log($data_log);
            $return['html'] = alert_box('Success.', 'success');
            $this->session->set_flashdata('flash_message', alert_box('Success menghapus item.', 'success'));
            json_exit($return);
        }
    }

    public function change_status(){
        $this->layout = 'none';
        if($this->input->post() && $this->input->is_ajax_request()){
            $post = $this->input->post();
            $this->db->where('id_travel_bill',$post['id_travel_bill']);
            $this->db->update('travel_bill',['status'=>$post['status']]);

            $data_log_status = [
                'status'=>$post['status'],
                'id_auth_user'=>id_auth_user()
            ];
            //$this->db->insert('spj_status_history',$data_log_status);
            $data_log = [
                'id_user'  => $data_log_status['id_auth_user'],
                'id_group' => id_auth_group(),
                'action'   => 'Validation LPD',
                'desc'     => 'Validation LPD; ID: '.$post['id_travel_bill'].'; Data: '.json_encode($post),
            ];
            insert_to_log($data_log);
            $return['html'] = alert_box('Success.', 'success');

            json_exit($return);
        }
    }

    public function validation($id = 0){
        if (!$id) {
            redirect($this->class_path_name);
        }
        $record = $this->LPD_model->GetLPD($id);
        // debugvar($record);
        // die();
        if (!$record) {
            redirect($this->class_path_name);
        }

        $this->data['post']     = $record;
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
        $record = $this->LPD_model->GetLPD($id);
        // debugvar($record);
        // die();
        if (!$record) {
            redirect($this->class_path_name);
        }

        //json_exit($record);
        
        
        $this->data['page_title']         = 'Edit';
        $this->data['form_action']        = site_url($this->class_path_name.'/edit/'.$id);
        $this->data['delete_picture_url'] = site_url($this->class_path_name.'/delete_picture/'.$id);
        $this->data['cancel_url']         = site_url($this->class_path_name);
        if ($this->input->post()) {
            $post = $this->input->post();

            if ($this->validateForm($id)) {
                $post['modify_date']   = date('Y-m-d H:i:s');
                $post['id_auth_user']   = id_auth_user();
                //echo UPLOAD_DIR;
                $post_file = $_FILES;
                $file_attachment = $post_file['file_attachment'];
                
                if($post['listActivity']){
                    $detailTravelBill = [];
                    foreach ($post['listActivity'] as $key => $value) {
                        if($file_attachment['tmp_name'][$key]){
                            $filename   = 'file_'.url_title($value['detail_activity'], '_', true).md5plus($id);
                            $picture_db = file_copy_to_folderArray($file_attachment['name'][$key],$file_attachment['tmp_name'][$key], $this->location_upload, $filename);
                            
                        }
                        
                        $detailTravelBill[] = [
                            'id_travel_bill'=>$id,
                            'detail_activity'=>$value['detail_activity'],
                            'check_number'=>$value['check_number'],
                            'amount'=>$value['amount'],
                            'final_amount'=>$value['amount'],
                            'file_attachment'=>$picture_db,
                        ];
                    }
                    if($detailTravelBill){
                        // debugvar($detailTravelBill);
                        // die();
                        $this->db->insert_batch('detail_travel_bill',$detailTravelBill);
                    }
                }

                
                // insert to log
                $data_log = [
                    'id_user'  => $post['id_auth_user'],
                    'id_group' => id_auth_group(),
                    'action'   => 'Edit LPD',
                    'desc'     => 'Edit LPD; ID: '.$id.'; Data: '.json_encode($post),
                ];
                insert_to_log($data_log);
                // end insert to log
                $this->session->set_flashdata('flash_message', alert_box('Success.', 'success'));

                redirect($this->class_path_name);
            }
        }
        $this->data['post']     = $record;
        if (isset($this->error)) {
            $this->data['form_message'] = $this->error;
        }
    }

    public function ajax_calculate_data(){
        $this->layout = 'none';
        if($this->input->post() && $this->input->is_ajax_request()){
            $post  = $this->input->post();
            $record = $this->LPD_model->GetLPD($post['id_travel_bill']);
            $html = '';
            $total_amount = 0;
            foreach ($record['detailTravelBill'] as $x => $y) {
                $total_amount += ($y['amount'] * $record['days']);
                $detail = '';
                if($y['detail_activity']=='Uang Harian'){
                    $detail = $record['sub_regional'].' - '. $record['province'].'  <br>';
                } 

                if($y['detail_activity']=='Uang Harian' || $y['detail_activity']=='Uang Reprentasi'){
                    $detail_rp = 'Rp. '. number_format($y['amount'],2,',','.').'  x '. $record['days'].'  <br>';
                    $total_amount = number_format($y['amount'] * $record['days'],2,',','.');
                }else{
                    $detail_rp = 'Rp. '. number_format($y['amount'],2,',','.').'  <br>';
                    $total_amount = number_format($y['amount'],2,',','.');
                } 

                $html .= '<tr>
                            <td>
                                '. $y['detail_activity'].'  <br>
                                '.$detail.'
                                Rp. '. number_format($y['amount'],2,',','.').'  x '. $record['days'].'  <br>';
                                
                                if($y['file_attachment']){
                                
                               $html .= '<div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail fileinput-upload" style="width: 200px; height: 150px;">';
                                        if (isset($y['file_attachment']) && $y['file_attachment'] != '' ) {
                                            $html .= '<img src="'.URL_IMAGE_LPD.$y['file_attachment'].'" class="post-image" />';
                                            
                                        }
                                   $html .= '</div>
                                </div>';
                                    }
                                
               $html .=   '</td>
                            <td class="text-right">
                                Rp. '.$total_amount.' 
                            </td>
                        </tr>';
            
            }
            foreach ($post['listActivity'] as $key => $value) {
                $total_amount += $value['amount'];
                $html .= '<tr>
                            <td>'.$value['detail_activity'].'
                                <br>
                                Nomer Kwitansi : '.$value['check_number'].'
                                <div class="col">
                                    <label>Upload Bukti Scan Kwitansi</label>
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail fileinput-upload" style="width: 200px; height: 150px;">
                                            
                                                <img src="" id="post-image" />
                                            
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                        <div>
                                            <span class="btn btn-success btn-file">
                                                <span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                                                <input type="file" name="file_attachment['.$key.']">
                                            </span>
                                            <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                    </div>
                                    
                                </div>
                            </td>
                            <td class="text-right">Rp. '.number_format($value['amount'],2,',','.').'</td>
                          </tr>';
            }

            $html .= '<tr>
                            <td>
                                Jumlah <br>
                                
                            </td>
                            <td id="total_amount_td" class="text-right">
                                Rp. '. number_format($total_amount,2,',','.').' 
                            </td>
                        </tr>';

            $total_amount_td = 'Rp. '.number_format($total_amount,2,',','.');
            $return['html'] = $html;
            $return['total_amount'] = $total_amount;
            $return['total_amount_td'] = $total_amount_td;
            json_exit($return);
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
                        $record = $this->LPD_model->GetLPD($id);
                        if ($record) {
                            if ($id == id_auth_user()) {
                                $json['error'] = alert_box('You can\'t delete Your own account.', 'danger');
                                break;
                            } else {
                                if (is_superadmin()) {
                                    $this->LPD_model->DeleteRecord($id);
                                    $json['success'] = alert_box('Data has been deleted', 'success');
                                    $this->session->set_flashdata('flash_message', $json['success']);
                                    // insert to log
                                    $data_log = [
                                        'id_user'  => id_auth_user(),
                                        'id_group' => id_auth_group(),
                                        'action'   => 'User LPD',
                                        'desc'     => 'Delete User LPD; ID: '.$id.';',
                                    ];
                                    insert_to_log($data_log);
                                    // end insert to log
                                } else {
                                    $json['error'] = alert_box('You don\'t have permission to delete this record(s). Please contact the LPDistrator.', 'danger');
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
                'field' => 'listActivity[]',
                'label' => 'Detail Aktivitas',
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
    public function check_department_name_exists($string, $id = 0)
    {
        if (!$this->LPD_model->checkExistsLPDName($string, $id)) {
            $this->form_validation->set_message('check_department_name_exists', '{field} is already exists. Please use different {field}');

            return false;
        }

        return true;
    }
}
/* End of file LPD.php */
/* Location: ./application/controllers/LPD.php */
