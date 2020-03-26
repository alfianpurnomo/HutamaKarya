<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Report Class
 * 		default home location
 * 		
 * @author alfian purnomo <alfian.pacul@gmail.com>
 * 
 * @version 3.0
 * 
 * @category Controller
 * 
 */
class Report extends CI_Controller 
{

    function __construct() 
    {
        parent::__construct();
        $this->load->model('Global_model','GL_M');
        $this->class_path_name = $this->router->fetch_class();
    }
    /**
     * Index Page for this controller.
     * 
     */
    public function index() 
    {

        $this->data['page_title'] = 'Report';
    }

    public function bts_down(){
        $this->data['report_bts_down'] = site_url('report/ajax_getReportBtsDown');
        echo date('Y-m-d',strtotime("-1 week"));
        echo date('Y-m-d',strtotime("-1 day"));
    }
    public function ajax_getReportBtsDown(){
        $this->layout  = 'none';
        if($this->input->post() && $this->input->is_ajax_request()){
            $post = $this->input->post();
            $type = $post['type'];
            $today = date('Y-m-d');
            if($type=='weekly'){
                $last =  date('Y-m-d',strtotime("-1 week"));
            }else{
                $last =  date('Y-m-d',strtotime("-1 month"));
            }
            

            $begin = new DateTime( $last );
            $end = new DateTime( $today );

            $interval = DateInterval::createFromDateString('1 day');
            $period = new DatePeriod($begin, $interval, $end);
            $out_data = array(
                'xAxis' => array(),
                'seriesData' => array()
            );
            foreach ( $period as $dt ){
                $start_date     =  $dt->format( "Y-m-d" ).' 00:00:00';
                $end_date       =  $dt->format( "Y-m-d" ).' 23:59:59';
                $xAxis = $dt->format( "Y-m-d" );
                array_push($out_data['xAxis'], $xAxis);
                $where = ['f_time >='=>$start_date,'f_time <='=>$end_date];
                $x = 0;
                $query = $this->GL_M->GetFromTabel('COUNT(*) AS cnt','v_data_perf_hourly_bts_status_down_v2',$where,[],[],[],[],'','','SINGEL');
                $x = intval($query['cnt']);

                array_push($out_data['seriesData'], $x);

                
            }
              
            json_exit($out_data);
        }
        
    }


}

/* End of file Report.php */
/* Location: ./application/controllers/Report.php */
