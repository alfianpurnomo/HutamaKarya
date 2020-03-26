<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Project  Model Class
 * @author Alfian Purnomo <alfian.pacul@gmail.com>
 * @version 3.0
 * @category Model
 * @desc Product model
 * 
 */
class Project_model extends CI_Model
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

        
        $data = $this->db
                ->select("a.*,a.id_projects as id,b.total_hours,b.total_employee")
                ->where('is_delete',0)
                ->join('detail_projects b','a.id_projects=b.projectid','LEFT')
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
        $total_records = $this->db
                ->from('view_project a')
                ->join('detail_projects b','a.id_projects=b.projectid','LEFT')
                ->where('a.is_delete',0)
                ->count_all_results();
        return $total_records;
    }

    function getProject($id){
        $data = $this->db
                ->where('id_projects',$id)
                ->get('view_project')
                ->row_array();
        if($data){
            $data['listEmployee'] = $this->db
                ->select('a.*,b.firstname,b.lastname,b.nik,c.name as role,c.id_master_role_tasks')
                ->where('a.projectid',$data['id_projects'])
                ->join('master_employee b','a.employeeid=b.employeeid')
                ->join('t_data_user d','d.id=b.userid')
                ->join('master_role_tasks c','a.employee_role=c.id_master_role_tasks','LEFT')
                ->get('mapping_project_employee a')
                ->result_array();
        }
        return $data;
    }
    
    



    
    
    /**
     * insert new record
     * @param array $param
     * @return int last inserted id
     */
    function InsertRecord($param) {
        $this->db->insert('projects',$param);
        $last_id = $this->db->insert_id();
        return $last_id;
    }
    
    /**
     * update record
     * @param int $id
     * @param array $param
     */
    function UpdateRecord($id,$param) {
        $this->db->where('id_projects',$id);
        $this->db->update('projects',$param);
    }

    
    
    /**
     * delete record
     * @param int $id
     */
    function DeleteRecord($id) {
        $this->db->where('id_projects',$id);
        $this->db->update('projects',array('is_delete'=>1));
    }

    function DeleteRecordMappingEmp($id) {
        $this->db->where('projectid',$id);
        $this->db->delete('mapping_project_employee');
    }

    function InsertTabelBatch($tabel,$data){
        $this->db->insert_batch($tabel,$data);
    }

    /**
     * Check exist code.
     *
     * @param string $code
     * @param int    $id
     *
     * @return bool true/false
     */
    function checkExistsCode($email, $id = 0)
    {
        if ($id != '' && $id != 0) {
            $this->db->where('id_projects !=', $id);
        }
        $count_records = $this->db
                ->from('projects')
                ->where('LCASE(code)', strtolower($email))
                ->count_all_results();
        if ($count_records > 0) {
            return false;
        }

        return true;
    }
    
}
/* End of file Product_model.php */
/* Location: ./application/models/Product_model.php */