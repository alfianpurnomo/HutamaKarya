<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Employee  Model Class
 * @author ivan lubis <ivan.z.lubis@gmail.com>
 * @version 3.0
 * @category Model
 * @desc Product model
 * 
 */
class Employee_model extends CI_Model
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
                ->select("*,employeeid as id")
                #->where('is_delete',0)
                ->get('view_employee')
                ->result_array();
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
                ->from('view_employee')
                #->where('is_delete',0)
                ->count_all_results();
        return $total_records;
    }
    
    /**
     * Get detail by id
     * @param int $id
     * @return array data
     */
    function GetProduct($id) {
        $data = $this->db
                ->where('id_product',$id)
                ->get('product')->row_array();
        if($data){
            $data['varians'] = $this->db
                                    ->where('id_product',$data['id_product'])
                                    ->get('product_varian')->result_array();
            if($data['varians']){
                foreach ($data['varians'] as $key => $value) {
                    $data['varians'][$key]['price'] = $this->db
                                                        ->where('id_product_varian',$value['id_product_varian'])
                                                        ->get('product_price')->result_array();
                    
                    $data['varians'][$key]['qty'] = $this->db
                                                        ->select('qty')
                                                        ->where('lcase(sku)',strtolower($value['sku']))
                                                        ->get('product_history_stock')->row()->qty;

                }
            }
        }

        return $data;
    }

    function getProductMeta($id) {
        $data = $this->db
                ->select('product.id_product')
                ->where('product.is_delete', 0)
                ->where('product.id_status', 1)
                ->where('product_meta.id_product', $id)
                ->limit(1)
                ->join('product', 'product_meta.id_product = product.id_product', 'left')
                ->get('product_meta')
                ->row_array();

        return $data;
    }
    
    /**
     * insert new record
     * @param array $param
     * @return int last inserted id
     */
    function InsertRecord($param) {
        $this->db->insert('product',$param);
        $last_id = $this->db->insert_id();
        return $last_id;
    }
    
    /**
     * update record
     * @param int $id
     * @param array $param
     */
    function UpdateRecord($id,$param) {
        $this->db->where('id_product',$id);
        $this->db->update('product',$param);
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

    /**
     * insert sites with batch method
     * @param array $data
     */
    function InsertSitesBatch($data){
        $this->db->insert_batch('product_sites',$data);
    }

    /**
     * Get Site by id
     * @param int $id
     * @return array data
     */
    function GetSitesById($id) {
        $data = $this->db
                ->where('id_product',$id)
                ->get('product_sites')
                ->result_array();
        return $data;
    }

    /**
     * delete site record
     * @param int $id
     */
    function DeleteSite($id){
        $this->db->where('id_product',$id);
        $this->db->delete('product_sites');
    }


    function InsertRecordVarian($data){
        $this->db->insert('product_varian',$data);

        return $this->db->insert_id();
    }

    function InsertTabelBatch($tabel,$data){
        $this->db->insert_batch($tabel,$data);
    }

    function DeleteVarian($id){
        $this->db->where('id_product',$id);
        $this->db->delete('product_varian');        
    }

    function DeletePrice($id){
        $this->db->where('id_product_varian',$id);
        $this->db->delete('product_price');        
    }
    
}
/* End of file Product_model.php */
/* Location: ./application/models/Product_model.php */