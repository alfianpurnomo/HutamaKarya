<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Report_projects Class.
 *
 * @author alfian purnomo <alfian.pacul@gmail.com>
 *
 * @version 3.0
 *
 * @category Controller
 */
class Report_projects extends CI_Controller
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
        $this->load->model('Report_projects_model','RAM');
        $this->class_path_name = $this->router->fetch_class();
    }

    /**
     * Index page.
     */
    public function index()
    {
        $this->data['menu_title']     = 'Report Projects';
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
            
            foreach ($records as $row => $record) {
                $return['data'][$row]['DT_RowId']           = $record['id'];
                #$return['data'][$row]['actions']            = '<a href="'.site_url($this->class_path_name.'/edit/'.$record['id']).'" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                $return['data'][$row]['title']              = $record['title'];
                $return['data'][$row]['description']        = $record['description'];
                $return['data'][$row]['code']               = $record['code'];#isset($record['code']) ? '<a href="'.site_url($this->class_path_name.'/detail/'.$record['id']).'" >'.$record['code'].'</a>' : '';
                $return['data'][$row]['total_employee']     = $record['total_employee'];
                $return['data'][$row]['total_hours']        = $record['total_hours'];
                $return['data'][$row]['employee_name']        = $record['employee_name'];
                $return['data'][$row]['status_text']        = $record['status_text'];#isset($record['status']) && $record['status']==1 ? 'Open' : 'Close';
                $return['data'][$row]['started']            = $record['started'];
                $return['data'][$row]['start_date']         = custDateFormat($record['start_date'],'d M Y');
                $return['data'][$row]['end_date']           = custDateFormat($record['end_date'],'d M Y');
                
                
                
            }
            json_exit($return);
        }
        redirect($this->class_path_name);
    }

    
}
/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */
