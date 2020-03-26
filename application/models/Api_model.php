<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Admin Model Class.
 *
 * @author alfian purnomo <alfian.pacul@gmail.com>
 *
 * @version 3.0
 *
 * @category Model
 */
class Api_model extends CI_Model
{
    /**
     * Class constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get User Main Channel.
     *
     * @return array|bool $data
     */
    public function GetMainChannel()
    {
        $data = $this->db
          ->select('mainchannel_name, master_mainchannel_code')
          ->where('channel_type_code', 1)
          ->where('is_delete', 0)
          ->order_by('master_mainchannel_code', 'asc')
          ->get('master_mainchannel')
          ->result_array();
        return $data;
    }

    /**
     * Get all data.
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
                ->select('t_data_user.*, auth_group.auth_group, id as id')
                ->join('auth_group', 'auth_group.id_auth_group = t_data_user.f_grouprole', 'left')
                ->get('t_data_user')
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
                ->from('t_data_user')
                ->join('auth_group', 'auth_group.id_auth_group = t_data_user.f_grouprole', 'left')
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
    function GetAdmin($id)
    {
        $data = $this->db
                ->where('id', $id)
                ->limit(1)
                ->get('t_data_user')
                ->row_array();

        return $data;
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
            ->where('id', $id)
            ->update('t_data_user', $param);
    }

}
/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */
