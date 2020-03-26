<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Notification Model Class.
 *
 * @author alfian purnomo <alfian.pacul@gmail.com>
 *
 * @version 3.0
 *
 * @category Model
 */
class Notification_model extends CI_Model
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
                ->select('transaction_management.id_transaction,transaction_management.controller_handling,user_notif.notif_date,transaction_approval.`approval_lvl` AS lvl_notif,
(SELECT master_transaction_code FROM transaction_management WHERE Transaction_no=user_notif.`Transaction_no`) AS code_transaction ')
                ->join('transaction_approval', 'transaction_approval.Transaction_no = user_notif.Transaction_no')
                ->join('transaction_management', 'transaction_management.Transaction_no = user_notif.Transaction_no')
                ->where('user_notif.usermgmt_id', $id)
                ->where('transaction_approval.approval_code !=','03')
                ->order_by('user_notif.notif_date', 'desc')
                ->get('user_notif')
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
                ->from('user_notif')
                ->join('transaction_approval', 'transaction_approval.Transaction_no = user_notif.Transaction_no')
                ->join('transaction_management', 'transaction_management.Transaction_no = user_notif.Transaction_no')
                ->where('user_notif.usermgmt_id', $id)
                ->where('transaction_approval.approval_code !=','03')
                ->count_all_results();

        return $total_records;
    }

    
}
/* End of file Notification_model.php */
/* Location: ./application/models/Notification_model.php */
