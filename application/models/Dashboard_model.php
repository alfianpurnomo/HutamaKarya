<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Dashboard Model Class.
 * 
 * @author alfian purnomo <alfian.pacul@gmail.com>
 * 
 * @version 3.0
 * 
 * @category Model
 * 
 */
class Dashboard_model extends CI_Model
{
    /**
     * Class constructor.
     * 
     */
    function __construct()
    {
        parent::__construct();
    }
    
    /**
     * function GetFromViewBTSStatusDownV2.
     * @param array $where
     * @return arrat $data
     */
    function GetFromViewBTSStatusDownV2($select='*',$where=array()){
        if($select == 'COUNT(id) AS cnt'){

             $count = $this->db
                        ->where($where)                
                        ->from('v_data_perf_hourly_bts_status_down_v2')
                        ->count_all_results();
            return $count;
            exit;
        }
        $data = $this->db
                ->select($select)
                ->where($where)
                ->get('v_data_perf_hourly_bts_status_down_v2')->result_array();
        return $data;
    }

    /**
     * function GetFromViewBTSVIPSpanShotStatus.
     * @param array $where, string $select
     * @return arrat $data
     */
    function GetFromViewBTSVIPSpanShotStatus($select='*',$where=array()){
        
        $data = $this->db
                ->select($select)
                ->where($where)
                ->get('v_bts_vip_snapshot_status')->result_array();
        return $data;
    }

    /**
     * function GetFromView.
     * @param array $where, string $select, string $table_name
     * @return arrat $data
     */
    function GetFromView($table_name='v_stat_bts_zero_user',$select='*',$where=array(),$order_field='',$order_type=''){
        if($order_field){
            $this->db->order_by($order_field,isset($order_type)? $order_type :'DESC');
        }
        $data = $this->db
                ->select($select)
                ->where($where)
                ->get($table_name)->result_array();
        return $data;
    }

}
/* End of file Dashboard_model.php */
/* Location: ./application/models/Dashboard_model.php */