<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Jobs_title Model Class.
 *
 * @author alfian purnomo <alfian.pacul@gmail.com>
 *
 * @version 3.0
 *
 * @category Model
 */
class Jobs_title_model extends CI_Model
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
                ->select('jobs_title.*,id_jobs_title as id')
                ->where('is_delete',0)
                ->get('jobs_title')
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
                ->from('jobs_title')
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
    function GetJobs_title($id)
    {
        $data = $this->db
                ->where('id_jobs_title', $id)
                ->limit(1)
                ->get('jobs_title')
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
        $this->db->insert('jobs_title', $param);
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
            ->where('id_jobs_title', $id)
            ->update('jobs_title', $param);
    }

    

    /**
     * Delete record.
     *
     * @param int $id
     */
    function DeleteRecord($id)
    {
        $this->db
            ->where('id_jobs_title', $id)
            ->update('jobs_title',['is_delete'=>1]);
    }

    /**
     * Check exist jobs_name.
     *
     * @param string $jobs_name
     * @param int    $id
     *
     * @return bool true/false
     */
    function checkExistsJobs_title($jobs_name, $id = 0)
    {
        if ($id != '' && $id != 0) {
            $this->db->where('id_jobs_title !=', $id);
        }
        $count_records = $this->db
                ->from('jobs_title')
                ->where('LCASE(jobs_name)', strtolower($jobs_name))
                ->where('is_delete', 0)
                ->count_all_results();
        if ($count_records > 0) {
            return false;
        }

        return true;
    }

    
	
}
/* End of file Jobs_title_model.php */
/* Location: ./application/models/Jobs_title_model.php */
