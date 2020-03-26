<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Global Model Class.
 *
 * @author alfian purnomo <alfian.pacul@gmail.com>
 *
 * @version 3.0
 *
 * @category Model
 * 
 */
class Global_model extends CI_Model
{
    /**
     * Class constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get all site data.
     *
     * @param string $param
     *
     * @return array|bool $data
     */
    function GetFromTabel($result='MULTI',$select='*',$table='',$where=array(),$or_where=array(),$like=array(),$or_like=array(),$not_in=array(),$order='',$order_type='DESC')
    {
        if($where){
            $this->db->where($where);
        }
        if($or_where){
            $this->db->or_where($or_where);
        }
        if($not_in){
            $this->db->where_not_in($not_in);
        
        }
        if($order){
            $this->db->order_by($order,$order_type);
        }
        if($like){
            foreach ($like as $k => $lk) {
                $field = $k;
                $type = substr($field, 0,1);
                $field =  substr($field, 1);
                if($type==0){
                    $this->db->like($field,$lk,'none');
                }elseif($type==1){
                    $this->db->like($field,$lk,'before');
                }elseif($type==2){
                    $this->db->like($field,$lk,'after');
                }else{
                    $this->db->like(array($field=>$lk));
                }
            }
        }
        if($or_like){
            foreach ($like as $k => $lk) {
                $field = $k;
                $type = substr($field, 0,1);
                $field =  substr($field, 1);
                if($type==0){
                    $this->db->or_like($field,$lk,'none');
                }elseif($type==1){
                    $this->db->or_like($field,$lk,'before');
                }elseif($type==2){
                    $this->db->or_like($field,$lk,'after');
                }else{
                    $this->db->or_like(array($field=>$lk));
                }
            }
        }
        $data = $this->db->select($select);
        if( strtolower(substr($select, 5)) == 'count'){//count
            return $data->from($table)->count_all_result();
        }
        if($result=='SINGEL' && strtolower(substr($select, 5)) != 'count' ){
            return $data->get($table)->row_array();
        }elseif($result=='MULTI' && strtolower(substr($select, 5)) != 'count' ){
            return $data->get($table)->result_array();
        }
        
    }


    function getEmail($id){
        foreach ($id as $value) {
            $this->db->or_where($value);
        }

        $data = $this->db->select('CONCAT(f_firstname, " ", f_lastname) as name,f_mail as email')->get('t_data_user')->result_array();
        return $data;
    }
    
}
/* End of file Global_model.php */
/* Location: ./application/models/Global_model.php */
