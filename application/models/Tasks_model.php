<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Tasks  Model Class
 * @author Alfian Purnomo <alfian.pacul@gmail.com>
 * @version 3.0
 * @category Model
 * @desc Product model
 * 
 */
class Tasks_model extends CI_Model
{
    /**
     * constructor
     */
    function __construct()
    {
        parent::__construct();
    }
    

    function getProjectTeamLead($employeeid){
        $data = $this->db
                ->select('a.*, b.title')
                ->where('a.employeeid',$employeeid)
                ->where('a.employee_role',1)
                ->join('projects b','a.projectid=b.id_projects')
                ->group_by('b.id_projects')
                ->get('mapping_project_employee a')->result_array();
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
     * was added by fadilah ajiq surya
     * insert record product meta
     * @param array $param
     */
    function insertProductMeta($param) {
        $this->db->insert_batch('product_meta', $param);
    }

    /**
     * was added by fadilah ajiq surya
     * update record product meta
     * @param int $id of product
     * @param array $case of WHERE syntax
     * @param array $param
     */
    function updateProductMeta($id, $param, $case) {
        $this->db->update('product_meta', $param, $case);
    }
    
    /**
     * delete record
     * @param int $id
     */
    function DeleteRecord($id) {
        $this->db->where('id_product',$id);
        $this->db->update('product',array('is_delete'=>1));
    }

    
    
}
/* End of file Product_model.php */
/* Location: ./application/models/Product_model.php */