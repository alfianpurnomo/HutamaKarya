<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Activity Model Class.
 *
 * @author alfian purnomo <alfian.pacul@gmail.com>
 *
 * @version 3.0
 *
 * @category Model
 */
class Activity_model extends CI_Model
{
    /**
     * Class constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    
    /**
     * Get all admin data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function GetAllData($param = [])
    {
        
        if (isset($param['search_value']) && $param['search_value'] != '') {
            $this->db->group_start();
            $i = 0;
            foreach ($param['search_field'] as $row => $val) {
                if ($val['searchable'] == 'true') {
                    if ($i == 0) {
                        $this->db->like('LCASE(`'.$val['data'].'`)', strtolower($param['search_value']));
                    } else {
                        $this->db->or_like('LCASE(`'.$val['data'].'`)', strtolower($param['search_value']));
                    }
                    $i++;
                }
            }
            $this->db->group_end();
        }
        if (isset($param['row_from']) && isset($param['length'])) {
            $this->db->limit($param['length'], $param['row_from']);
        }
        if (isset($param['order_field'])) {
            if (isset($param['order_sort'])) {
                $this->db->order_by($param['order_field'], $param['order_sort']);
            } else {
                $this->db->order_by($param['order_field'], 'desc');
            }
        } else {
            $this->db->order_by('id', 'desc');
        }
        $data = $this->db
                ->select('master_activity.*,id_activity as id')
                ->where('is_delete',0)
                ->get('master_activity')
                ->result_array();

        return $data;
    }

    /**
     * Count records.
     *
     * @param array $param
     *
     * @return int $total_records total records
     */
    function CountAllData($param = [])
    {
        
        if (is_array($param) && isset($param['search_value']) && $param['search_value'] != '') {
            $this->db->group_start();
            $i = 0;
            foreach ($param['search_field'] as $row => $val) {
                if ($val['searchable'] == 'true') {
                    if ($i == 0) {
                        $this->db->like('LCASE(`'.$val['data'].'`)', strtolower($param['search_value']));
                    } else {
                        $this->db->or_like('LCASE(`'.$val['data'].'`)', strtolower($param['search_value']));
                    }
                    $i++;
                }
            }
            $this->db->group_end();
        }
        $total_records = $this->db
                ->from('master_activity')
                 ->where('is_delete',0)
                ->count_all_results();

        return $total_records;
    }

    /**
     * Get admin user detail by id.
     *
     * @param int $id
     *
     * @return array|bool $data
     */
    function GetActivity($id)
    {
        $data = $this->db
                ->where('id_activity', $id)
                ->limit(1)
                ->get('master_activity')
                ->row_array();
                // echo $this->db->last_query();
                // die();
        return $data;
    }

    /**
     * Insert new record.
     *
     * @param array $param
     *
     * @return int $last_id last inserted id
     */
    function InsertRecord($param)
    {
        $this->db->insert('master_activity', $param);
        $last_id = $this->db->insert_id();

        return $last_id;
    }

    

    /**
     * Update record admin user.
     *
     * @param int   $id
     * @param array $param
     */
    function UpdateRecord($id, $param)
    {
        $this->db
            ->where('id_activity', $id)
            ->update('master_activity', $param);
    }

    

    /**
     * Delete record.
     *
     * @param int $id
     */
    function DeleteRecord($id)
    {
        $this->db
            ->where('id_activity', $id)
            ->update('master_activity',['is_delete'=>1]);
    }

    /**
     * Check exist activity_name.
     *
     * @param string $activity_name
     * @param int    $id
     *
     * @return bool true/false
     */
    function checkExistsActivity($activity_name, $id = 0)
    {
        if ($id != '' && $id != 0) {
            $this->db->where('id_activity !=', $id);
        }
        $count_records = $this->db
                ->from('master_activity')
                ->where('LCASE(activity_name)', strtolower($activity_name))
                ->count_all_results();
        if ($count_records > 0) {
            return false;
        }

        return true;
    }

    
	
}
/* End of file Activity_model.php */
/* Location: ./application/models/Activity_model.php */
