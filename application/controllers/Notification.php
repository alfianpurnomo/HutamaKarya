<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Notification Class.
 *
 * @author alfian purnomo <alfian.pacul@gmail.com>
 *
 * @version 3.0
 *
 * @category Controller
 */
class Notification extends CI_Controller
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
        $this->load->model('Notification_model','PDM');
        $this->class_path_name = $this->router->fetch_class();
        $ADM_SESS  = $_SESSION['ADM_SESS'];
        $this->adm_sess = $ADM_SESS;
    }

    /**
     * Index page.
     */
    public function index()
    {
        $this->data['menu_title']     = 'Management Notif';  
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
            $count_all_records         = $this->PDM->CountAllData();
            $count_filtered_records    = $this->PDM->CountAllData($param);
            $records                   = $this->PDM->GetAllData($param);
            $return                    = [];
            $return['draw']            = $post['draw'];
            $return['recordsTotal']    = $count_all_records;
            $return['recordsFiltered'] = $count_filtered_records;
            $return['data']            = [];
            $type_po = ['Material','Service'];
           
            foreach ($records as $row => $record) {
                
                $return['data'][$row]['DT_RowId']       = $record['id'];
                $return['data'][$row]['actions']        = '<a href="'.site_url($this->class_path_name.'/edit/'.$record['id']).'" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                $return['data'][$row]['PO_No']          = $record['PO_No'];
                $return['data'][$row]['Supplier_name']  = $record['Supplier_name'];
                $return['data'][$row]['PO_QTY']         = $record['PO_QTY'];
                $return['data'][$row]['Description']    = $record['Description'];
                $return['data'][$row]['PO_Type_code']        = $type_po[$record['PO_Type_code']-1];
            }
            json_exit($return);
        }
        redirect($this->class_path_name);
    }

}
/* End of file Notification.php */
/* Location: ./application/controllers/Notification.php */
