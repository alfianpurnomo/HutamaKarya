<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Report_projects  Model Class
 * @author Alfian Purnomo <alfian.pacul@gmail.com>
 * @version 3.0
 * @category Model
 * @desc Product model
 * 
 */
class Report_projects_model extends CI_Model
{
    /**
     * constructor
     */
    function __construct()
    {
        parent::__construct();
    }
    
    /**
     * get all data
     * @param string $param
     * @return array data
     */
    function GetAllData($param=array()) {
        if (isset($param['search_value']) && $param['search_value'] != '') {
            $this->db->group_start();
            $i=0;
            foreach ($param['search_field'] as $row => $val) {
                if ($val['searchable'] == 'true') {
                    if ($i==0) {
                        $this->db->like('LCASE(`'.$val['data'].'`)',strtolower($param['search_value']));
                    } else {
                        $this->db->or_like('LCASE(`'.$val['data'].'`)',strtolower($param['search_value']));
                    }
                    $i++;
                }
            }
            $this->db->group_end();
        }
        if (isset($param['row_from']) && isset($param['length'])) {
            $this->db->limit($param['length'],$param['row_from']);
        }
        if (isset($param['order_field'])) {
            if (isset($param['order_sort'])) {
                $this->db->order_by($param['order_field'],$param['order_sort']);
            } else {
                $this->db->order_by($param['order_field'],'desc');
            }
        } else {
            $this->db->order_by('id','desc');
        }

        if(isset($param['filterCustom'])){
            #$this->db->group_start();
            $i=0;
            foreach ($param['filterCustom'] as $keyFilter => $filter) {
                if($keyFilter=='start_date' || $keyFilter=='end_date'){
                    if($filter){
                        if($keyFilter=='start_date'){
                            $this->db->where($keyFilter.' >=',strtolower($filter));
                        }

                        if($keyFilter=='end_date'){
                            $this->db->where($keyFilter.' <=',strtolower($filter));
                        }
                        
                    }
                }else{
                    if($filter){
                        $this->db->where('LCASE(`'.$keyFilter.'`)',strtolower($filter));
                    }
                    
                }
                
                
            }
            #$this->db->group_end();
        }
        $data = $this->db
                ->select("a.*,a.id_projects as id,b.total_hours,b.total_employee")
                ->where('is_delete',0)
                ->join('detail_projects b','a.id_projects=b.projectid')
                ->get('view_project a')
                ->result_array();
        #echo $this->db->last_query();
        return $data;
    }
    
    /**
     * count records
     * @param string $param
     * @return int total records
     */
    function CountAllData($param=array()) {
        if (is_array($param) && isset($param['search_value']) && $param['search_value'] != '') {
            $this->db->group_start();
            $i=0;
            foreach ($param['search_field'] as $row => $val) {
                if ($val['searchable'] == 'true') {
                    if ($i==0) {
                        $this->db->like('LCASE(`'.$val['data'].'`)',strtolower($param['search_value']));
                    } else {
                        $this->db->or_like('LCASE(`'.$val['data'].'`)',strtolower($param['search_value']));
                    }
                    $i++;
                }
            }
            $this->db->group_end();
        }
        if(isset($param['filterCustom'])){
            #$this->db->group_start();
            foreach ($param['filterCustom'] as $keyFilter => $filter) {
                if($keyFilter=='start_date' || $keyFilter=='end_date'){
                    if($filter){
                        if($keyFilter=='start_date'){
                            $this->db->where($keyFilter.' >=',strtolower($filter));
                        }

                        if($keyFilter=='end_date'){
                            $this->db->where($keyFilter.' <=',strtolower($filter));
                        }
                        
                    }
                }else{
                    if($filter){
                        $this->db->where('LCASE(`'.$keyFilter.'`)',strtolower($filter));
                    }
                    
                }
                
                
            }
            #$this->db->group_end();
        }
        $total_records = $this->db
                ->from('view_project a')
                ->join('detail_projects b','a.id_projects=b.projectid')
                ->where('a.is_delete',0)
                ->count_all_results();
        return $total_records;
    }
    
}
/* End of file Product_model.php */
/* Location: ./application/models/Product_model.php */