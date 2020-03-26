<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Master_data Model Class.
 *
 * @author alfian purnomo <alfian.pacul@gmail.com>
 *
 * @version 3.0
 *
 * @category Model
 */
class Master_data_model extends CI_Model
{
    /**
     * Class constructor.
     */
    function __construct()
    {
        parent::__construct();
    }


    /**
     * Count records.
     *
     * @param array $param
     *
     * @return int $total_records total records
     */
    function CountAllDataOutlet($param = [])
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
                ->where('a.is_delete',0)
                ->join('master_channeldistributor b' ,' a.`ChannelDistributor_code`=b.`ChannelDistributor_code`','a.`id_company`=b.`id_company`')
                ->join('master_bank c ',' c.`id`=a.`Bank`')
                ->join('master_type_lvl2 d ','a.`type_code`=d.`id`')
                ->from('master_outlet_lvl2 a')
                ->count_all_results();

        return $total_records;
    }

    /**
     * Get all area data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function GetAllDataOutlet($param = [])
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
                ->select('a.*,b.`salesdealer_codename`,c.`nama_bank`,d.`type_name`,a.Id_lvl2 as id')
                ->where('a.is_delete',0)
                ->join('master_channeldistributor b' ,' a.`ChannelDistributor_code`=b.`ChannelDistributor_code`','a.`company_name`=d.`id_company`')
                ->join('master_bank c ',' c.`id`=a.`Bank`')
                ->join('master_type_lvl2 d ','a.`type_code`=d.`id`')
                ->get('master_outlet_lvl2 a')
                ->result_array();
                #echo $this->db->last_query();
        return $data;
    }

	/** 			
  * Count records. 			
  * 			
  * @param array $param 			
  * 			
  * @return int $total_records total records 			
  */ 			
 function CountAllDataAR($param = []) 			
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
             ->where('a.is_delete',0) 			
             ->join('master_vendor b ','a.`vendor`=b.`id`','left') 			
             ->from('master_ar a') 			
             ->count_all_results(); 			

     return $total_records; 			
 } 			

 /** 			
  * Get all area data. 			
  * 			
  * @param array $param 			
  * 			
  * @return array|bool $data 			
  */ 			
 function GetAllDataAR($param = []) 			
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
             ->select('a.*,b.nama_vendor') 			
             ->where('a.is_delete',0) 			
              ->join('master_vendor b ','a.`vendor`=b.`id`','left') 			
             ->get('master_ar a') 			
             ->result_array(); 			
             #echo $this->db->last_query(); 			
     return $data; 			
 } 			


 /** 			
  * Count records. 			
  * 			
  * @param array $param 			
  * 			
  * @return int $total_records total records 			
  */ 			
 function CountAllDataVendor($param = []) 			
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
             ->where('a.is_delete',0) 			
             #->join('master_vendor b ','a.`vendor`=b.`id`','left') 			
             ->from('master_vendor a') 			
             ->count_all_results(); 			

     return $total_records; 			
 } 			

 /** 			
  * Get all area data. 			
  * 			
  * @param array $param 			
  * 			
  * @return array|bool $data 			
  */ 			
 function GetAllDataVendor($param = []) 			
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
             ->select('a.*') 			
             ->where('a.is_delete',0) 			
              ->get('master_vendor a') 			
             ->result_array(); 			
             #echo $this->db->last_query(); 			
     return $data; 			
 }
	
	

    /**
     * Count records.
     *
     * @param array $param
     *
     * @return int $total_records total records
     */
    function CountAllDataLvl2($param = [])
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
                ->where('is_delete',0)
                ->from('master_type_lvl2')
                ->count_all_results();

        return $total_records;
    }

    function GetAllDataLvl2($param = [])
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
                ->select('*')
                ->where('is_delete',0)
                ->get('master_type_lvl2')
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
    function CountAllDataBank($param = [])
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
                ->where('is_delete',0)
                ->from('master_bank')
                ->count_all_results();

        return $total_records;
    }

    function GetAllDataBank($param = [])
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
                ->select('*')
                ->where('is_delete',0)
                ->get('master_bank')
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
    function CountAllDataCompany($param = [])
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
                ->where('is_delete',0)
                ->from('master_company')
                ->count_all_results();

        return $total_records;
    }

    /**
     * Get all area data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function GetAllDataCompany($param = [])
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
                ->select('*')
                ->where('is_delete',0)
                ->get('master_company')
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
    function CountAllDataArea($param = [])
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
                ->where('is_delete',0)
                ->from('master_area')
                ->count_all_results();

        return $total_records;
    }

    /**
     * Get all area data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function GetAllDataArea($param = [])
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
                ->select('id,area_code,area_name,area_coverage')
                ->where('is_delete',0)
                ->get('master_area')
                ->result_array();

        return $data;
    }

    function getMasterAreaData() {
        $data = $this->db
                ->where('master_area.is_delete', 0)
                ->get('master_area')
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
    function CountAllDataRetail($param = [])
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
                ->select('*')
                ->where('master_retail.is_delete',0)
                ->join("(select salesdealer_codename,ChannelDistributor_code from {$this->db->dbprefix('master_channeldistributor')}) as {$this->db->dbprefix('master_channeldistributor')}", 'master_retail.ChannelDistributor_code = master_channeldistributor.ChannelDistributor_code', 'left')
                ->join("(select retail_role_id,retail_role from {$this->db->dbprefix('retail_role')}) as {$this->db->dbprefix('retail_role')}", 'retail_role.retail_role_id = master_retail.retail_role_id', 'left')
                ->from('master_retail')
                ->count_all_results();

        return $total_records;
    }

    /**
     * Get all retail data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function GetAllDataRetail($param = [])
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
                ->select('*')
                ->where('master_retail.is_delete',0)
                ->join("(select salesdealer_codename,ChannelDistributor_code from {$this->db->dbprefix('master_channeldistributor')}) as {$this->db->dbprefix('master_channeldistributor')}", 'master_retail.ChannelDistributor_code = master_channeldistributor.ChannelDistributor_code', 'left')
                ->join("(select retail_role_id,retail_role from {$this->db->dbprefix('retail_role')}) as {$this->db->dbprefix('retail_role')}", 'retail_role.retail_role_id = master_retail.retail_role_id', 'left')
                ->get('master_retail')
                ->result_array();

        return $data;
    }

    function getRetailRole() {
        $data = $this->db
                ->where('retail_role.is_delete', 0)
                ->get('retail_role')
                ->result_array();

        return $data;
    }

    function getPICData() {
        $data = $this->db
                /*->where('t_data_user.is_delete', 0)*/
                ->get('t_data_user')
                ->result_array();

        return $data;
    }

    function getMasterChannelDistributor() {
        $data = $this->db
                ->where('master_channeldistributor.is_delete', 0)
                ->get('master_channeldistributor')
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
    function CountAllDataRetailRole($param = [])
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
                ->where('is_delete',0)
                ->from('retail_role')
                ->count_all_results();

        return $total_records;
    }

    /**
     * Get all retail data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function GetAllDataRetailRole($param = [])
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
            $this->db->order_by('retail_role_id', 'desc');
        }
        $data = $this->db
                ->where('retail_role.is_delete',0)
                ->get('retail_role')
                ->result_array();

        return $data;
    }

    // end of retail role

    /**
     * Count records Sub Area.
     *
     * @param array $param
     *
     * @return int $total_records total records
     */
    function CountAllDataSubArea($param = [])
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
                ->where('master_subarea.is_delete',0)
                ->join('master_area','master_area.id=master_subarea.id_area')
                ->from('master_subarea')
                ->count_all_results();

        return $total_records;
    }

    /**
     * Get all sub area data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function GetAllDataSubArea($param = [])
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
                ->select('master_subarea.*,master_area.area_name')
                ->where('master_subarea.is_delete',0)
                ->join('master_area','master_area.id=master_subarea.id_area')
                ->get('master_subarea')
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
    function CountAllDataChannelDistributor($param = [])
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
                ->where('master_channeldistributor.is_delete',0)
                ->join('master_mainchannel','master_mainchannel.master_mainchannel_code=master_channeldistributor.master_mainchannel_code')
                ->from('master_channeldistributor')
                ->count_all_results();

        return $total_records;
    }

    /**
     * Get all area data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function GetAllDataChannelDistributor($param = [])
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
                ->select('master_channeldistributor.*,master_mainchannel.mainchannel_name,master_channeldistributor.ChannelDistributor_code as id')
               
                ->where('master_channeldistributor.is_delete',0)
                ->join('master_mainchannel','master_mainchannel.master_mainchannel_code=master_channeldistributor.master_mainchannel_code')
                ->get('master_channeldistributor')
                ->result_array();

        return $data;
    }


    function CountAllDataBundling($param = [])
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
                ->where('is_delete',0)
                ->from('master_bundling')
                ->count_all_results();

        return $total_records;
    }

    /**
     * Get all area data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function GetAllDataBundling($param = [])
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
                ->select('*')
                ->where('is_delete',0)
                ->get('master_bundling')
                ->result_array();
               /* echo $this->db->last_query();*/
        return $data;
    }

    function CountAllDataDealer($param = [])
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
                ->where('is_delete',0)
                ->from('master_dealer')
                ->count_all_results();

        return $total_records;
    }

    /**
     * Get all area data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function GetAllDataDealer($param = [])
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
                ->select('*')
                ->where('is_delete',0)
                ->get('master_dealer')
                ->result_array();

        return $data;
    }


    function CountAllDataMaterial($param = [])
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
                ->where('is_delete',0)
                ->from('master_material')
                ->count_all_results();

        return $total_records;
    }

    /**
     * Get all Material data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function GetAllDataMaterial($param = [])
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
                ->select('*')
                ->where('is_delete',0)
                ->get('master_material')
                ->result_array();

        return $data;
    }

    function CountAllDataMDChannel($param = [])
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
                ->where('master_mdchannel.is_delete',0)
                ->join('master_dealer','master_dealer.MD_code=master_mdchannel.master_dealer')
                ->from('master_mdchannel')
                ->count_all_results();

        return $total_records;
    }

    /**
     * Get all MD Channel data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function GetAllDataMDChannel($param = [])
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
                ->select('master_mdchannel.*,master_dealer.MD_name as MD_name')
                ->where('master_mdchannel.is_delete',0)
                ->join('master_dealer','master_dealer.MD_code=master_mdchannel.master_dealer')
                ->get('master_mdchannel')
                ->result_array();

        return $data;
    }
    /**
     * Get group data.
     *
     * @return array|bool $data
     */
    function GetGroups()
    {
        if ( ! is_superadmin()) {
            $this->db->where('is_superadmin', 0);
        }
        $data = $this->db
                ->order_by('auth_group', 'asc')
                ->get('auth_group')
                ->result_array();

        return $data;
    }

     /**
     * Count all Main Channel data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function CountAllDataMDMainChannel($param = [])
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

                ->where('master_mainchannel.is_delete',0)
                ->join('channel_type','channel_type.channel_type_code=master_mainchannel.channel_type_code','left')
                ->join('master_subarea','master_mainchannel.id_subarea=master_subarea.id','left')
                ->from('master_mainchannel')
                ->count_all_results();

        return $total_records;
    }

    /**
     * Get all Main Channel data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function GetAllDataMDMainChannel($param = [])
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
            $this->db->order_by('master_mainchannel_code', 'desc');
        }
        $data = $this->db
                ->select('master_mainchannel.*,channel_type.channel_type,master_subarea.subarea_name')
                ->where('master_mainchannel.is_delete',0)
                ->join('channel_type','channel_type.channel_type_code=master_mainchannel.channel_type_code','left')
                ->join('master_subarea','master_mainchannel.id_subarea=master_subarea.id','left')
                
                ->get('master_mainchannel')
                ->result_array();

        return $data;
    }

    /**
     * Get Master Main Channel data.
     *
     * @return array|bool $data
     */
    function GetMasterMainChannel()
    {
        if ( ! is_superadmin()) {
            $this->db->where('is_superadmin', 0);
        }
        $data = $this->db
                ->order_by('master_mainchannel_code', 'asc')
                ->get('master_mainchannel')
                ->result_array();

        return $data;
    }

    /**
     * Count all master simcard data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function CountAllDataMDSimcard($param = [])
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
                ->where('master_simcard.is_delete',0)
                ->from('master_simcard')
                ->count_all_results();

        return $total_records;
    }

    /**
     * Get all Simcard data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function GetAllDataMDSimcard($param = [])
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
            $this->db->order_by('ICCID', 'desc');
        }
        $data = $this->db
                ->select('master_simcard.*')
                ->where('master_simcard.is_delete',0)
                ->get('master_simcard')
                ->result_array();

        return $data;
    }

    /**
     * Count all master device data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function CountAllDataMDDevice($param = [])
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
                ->where('master_device_only.is_delete',0)
                ->from('master_device_only')
                ->count_all_results();

        return $total_records;
    }

    /**
     * Get all Device data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function GetAllDataMDDevice($param = [])
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
            $this->db->order_by('IMEI', 'desc');
        }
        $data = $this->db
                ->select('master_device_only.*')
                ->where('master_device_only.is_delete',0)
                ->get('master_device_only')
                ->result_array();

        return $data;
    }

    /**
     * Count all master accessories data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function CountAllDataMDAccessories($param = [])
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
                ->where('master_accessories.is_delete',0)
                ->from('master_accessories')
                ->count_all_results();

        return $total_records;
    }

    /**
     * Get all Accessories data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function GetAllDataMDAccessories($param = [])
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
            $this->db->order_by('Serial_no', 'desc');
        }
        $data = $this->db
                ->select('master_accessories.*')
                ->where('master_accessories.is_delete',0)
                ->get('master_accessories')
                ->result_array();

        return $data;
    }

    /**
     * Count all master bundling data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function CountAllDataMDBundling($param = [])
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
                /*->where('Master_SPBundling.is_delete',0)
                ->from('Master_SPBundling')*/
                ->select('a.*,c.Product_Name_Combination,a.MDN as id')
                 ->where('a.is_delete',0)
                ->join('incoming_product_summary b', 'b.id=a.Incoming_Product_Summary_no')
                ->join('t7_product_name_combination c', ' c.id=b.Product_Name_Combination_Code')               
                ->from('Master_SPBundling a')
                ->count_all_results();

        return $total_records;
    }

    /**
     * Get all bundling data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function GetAllDataMDBundling($param = [])
    {
        //debugvar($param);
        if (isset($param['search_value']) && $param['search_value'] != '') {
            //echo 'asdsad';
            //debugvar($param);
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
               /* ->select('Master_SPBundling.*,Master_SPBundling.MDN as id')
                ->where('Master_SPBundling.is_delete',0)
                ->get('Master_SPBundling')*/
                ->select('a.*,c.Product_Name_Combination,a.MDN as id')
                 ->where('a.is_delete',0)
                ->join('incoming_product_summary b', 'b.id=a.Incoming_Product_Summary_no')
                ->join('t7_product_name_combination c', ' c.id=b.Product_Name_Combination_Code')               
                ->get('Master_SPBundling a')
                ->result_array();

        return $data;
    }

    /**
     * Count all master voucher data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function CountAllDataMDVoucher($param = [])
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
                ->where('master_voucher.is_delete',0)
                ->from('master_voucher')
                ->count_all_results();

        return $total_records;
    }

    /**
     * Get all voucher data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function GetAllDataMDVoucher($param = [])
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
            $this->db->order_by('serial_no', 'desc');
        }
        $data = $this->db
                ->select('master_voucher.*')
                ->where('master_voucher.is_delete',0)
                ->get('master_voucher')
                ->result_array();

        return $data;
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
        if ( ! is_superadmin()) {
            $this->db->where('t_data_user.is_superadmin', 0);
            $this->db->where('auth_group.is_superadmin', 0);
        }
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
        if ( ! is_superadmin()) {
            $this->db->where('t_data_user.is_superadmin', 0);
            $this->db->where('auth_group.is_superadmin', 0);
        }
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
    function GetMaster_data($id)
    {
        $data = $this->db
                ->where('id', $id)
                ->limit(1)
                ->get('t_data_user')
                ->row_array();

        return $data;
    }

    /**
     * Get admin user detail by id.
     *
     * @param int $id
     *
     * @return array|bool $data
     */
    function GetOutlet($id)
    {
        $data = $this->db
                ->where('id_lvl2', $id)
                ->limit(1)
                ->get('master_outlet_lvl2')
                ->row_array();

        return $data;
    }

	function GetAR($id) 	
		
   { 			
       $data = $this->db 			
               ->where('id', $id) 			
               ->limit(1) 			
               ->get('master_ar') 			
               ->row_array(); 			
		
       return $data; 			
   } 			
		
   function GetVendor($id) 			
   { 			
       $data = $this->db 			
               ->where('id', $id) 			
               ->limit(1) 			
               ->get('master_vendor') 			
               ->row_array(); 			
		
       return $data; 			
   }
	
	
    /**
     * Insert new record to tabel.
     *
     * @param string $tabel_name
     * @param array $param
     *
     * @return int $last_id last inserted id
     */
    function InsertRecord($tabel_name='',$param)
    {
        $this->db->insert($tabel_name, $param);
        $last_id = $this->db->insert_id();

        return $last_id;
    }

    /**
     * Update record by tabel name.
     *
     * @param string $tabel_name
     * @param array $where
     * @param array $param
     */
    function UpdateRecord($tabel_name='',$where='', $param)
    {
        $this->db
            ->where($where)
            ->update($tabel_name, $param);
    }

    /**
     * Delete record by tabel name.
     *
     * @param string $tabel_name
     * @param array $where
     */
    function DeleteRecord($tabel_name='',$where='')
    {
        $param = ['is_delete'=>1];
        $this->db
            ->where($where)
            ->update($tabel_name,$param);
    }

    /**
     * Check exist email.
     *
     * @param string $email
     * @param int    $id
     *
     * @return bool true/false
     */
    function checkExistsEmail($email, $id = 0)
    {
        if ($id != '' && $id != 0) {
            $this->db->where('id !=', $id);
        }
        $count_records = $this->db
                ->from('t_data_user')
                ->where('LCASE(f_mail)', strtolower($email))
                ->count_all_results();
        if ($count_records > 0) {
            return false;
        }

        return true;
    }

    /**
     * Check exist username.
     *
     * @param string $username
     * @param int    $id
     *
     * @return bool true/false
     */
    function checkExistsUsername($username, $id = 0)
    {
        if ($id != '' && $id != 0) {
            $this->db->where('id !=', $id);
        }
        $count_records = $this->db
                ->from('t_data_user')
                ->where('f_username', $username)
                ->count_all_results();
        if ($count_records > 0) {
            return false;
        }

        return true;
    }

    function checkExistsWarehouseCode($warehousecode, $id)
    {
        if ($id != '' && $id != 0) {
            $this->db->where('id !=', $id);
        }
        $count_records = $this->db
                ->from('master_warehouse')
                ->where('Warehouse_code', $warehousecode)
                ->count_all_results();
        if ($count_records > 0) {
            return false;
        }

        return true;
    }

    /**
     * Get all area data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function GetAllDataResourceType($param = [])
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
                ->select('t0_resource_type.*, id')
                ->where('t0_resource_type.is_delete', 0)
                ->get('t0_resource_type')
                ->result_array();

        return $data;
    }


    function CountAllDataResourceType($param = [])
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
                ->from('t0_resource_type')
                ->count_all_results();

        return $total_records;
    }

    function getT0Resourcetype() {
        $data = $this->db
                ->where('t0_resource_type.is_delete', 0)
                ->get('t0_resource_type')
                ->result_array();

        return $data;
    }

    function getT2DeviceSpName() {
        $data = $this->db
                ->where('t2_device_sp_name_.is_delete', 0)
                ->get('t2_device_sp_name_')
                ->result_array();

        return $data;
    }

    function getT3ProductBenefit() {
        $data = $this->db
                ->where('t3_product_benefit.is_delete', 0)
                ->get('t3_product_benefit')
                ->result_array();

        return $data;
    }

    function getT4ProductType() {
        $data = $this->db
                ->where('t4_product_type.is_delete', 0)
                ->get('t4_product_type')
                ->result_array();

        return $data;
    }

    function getT5ProductColor() {
        $data = $this->db
                ->where('t5_product_color.is_delete', 0)
                ->get('t5_product_color')
                ->result_array();

        return $data;
    }


    /**
     * Get all area data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function GetAllDataDeviceSimcardType($param = [])
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
            $this->db->order_by('a.id', 'desc');
        }
        $data = $this->db
                ->select('*,a.id,b.Resource_Type as Resource_Type')
                ->where('a.is_delete', 0)
                ->join('t0_resource_type b', 'b.id = a.id_t0', 'left')
                ->get('t1_device_simcard_type_ a')
                ->result_array();

        return $data;
    }


    function CountAllDataDeviceSimcardType($param = [])
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
                ->where('a.is_delete', 0)
                ->join('t0_resource_type b', 'b.id = a.id_t0', 'left')
                #->from('t1_device_simcard_type_ a')
                ->from('t1_device_simcard_type_ a')
                ->count_all_results();

        return $total_records;
    }



    /**
     * Get all area data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function getT1SpName() {
        $data = $this->db
                ->where('t1_device_simcard_type_.is_delete', 0)
                ->get('t1_device_simcard_type_')
                ->result_array();

        return $data;
    }

    function GetAllDataDeviceSPName($param = [])
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
            $this->db->order_by('a.id', 'desc');
        }
        $data = $this->db
                ->select('*, a.id, b.Device_SimCard_Type as device_simcard_type')
                ->where('a.is_delete', 0)
                ->join('t1_device_simcard_type_ b', 'a.id_t1 = b.id' ,'left')
                ->get('t2_device_sp_name_ a')
                ->result_array();

        return $data;
    }


    function CountAllDataDeviceSPName($param = [])
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
                ->where('a.is_delete', 0)
                ->join('t1_device_simcard_type_ b', 'a.id_t1 = b.id' ,'left')
                ->from('t2_device_sp_name_ a')
                ->count_all_results();

        return $total_records;
    }

     /**
     * Get all area data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function GetAllDataProductBenefit($param = [])
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
            $this->db->order_by('a.id', 'desc');
        }
        $data = $this->db
                ->select('*,  a.id')
                ->where('a.is_delete', 0)
                ->get('t3_product_benefit a')
                ->result_array();

        return $data;
    }


    function CountAllDataProductBenefit($param = [])
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
                ->from('t3_product_benefit')
                ->count_all_results();

        return $total_records;
    }

     /**
     * Get all area data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function GetAllDataProductType($param = [])
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
            $this->db->order_by('a.id', 'desc');
        }
        $data = $this->db
                ->select('*, a.id')
                ->where('a.is_delete', 0)
                ->get('t4_product_type a')
                ->result_array();

        return $data;
    }


    function CountAllDataProductType($param = [])
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
                ->from('t4_product_type')
                ->count_all_results();

        return $total_records;
    }

     /**
     * Get all area data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function GetAllDataProductColor($param = [])
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
            $this->db->order_by('a.id', 'desc');
        }
        $data = $this->db
                ->select('*, a.id')
                ->where('a.is_delete', 0)
                ->get('t5_product_color a')
                ->result_array();

        return $data;
    }


    function CountAllDataProductColor($param = [])
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
                ->from('t5_product_color')
                ->count_all_results();

        return $total_records;
    }

     /**
     * Get all area data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function GetAllDataProductName($param = [])
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
            $this->db->order_by('a.id', 'desc');
        }
        $data = $this->db
                ->select('*, a.id, b.Device_SP_Name')
                ->where('a.is_delete', 0)
                ->join('t2_device_sp_name_ b', 'b.id = a.id_t2', 'left')
                ->get('t6_product_name a')
                ->result_array();

        return $data;
    }


    function CountAllDataProductName($param = [])
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
                ->where('a.is_delete', 0)
                ->join('t2_device_sp_name_ b', 'b.id = a.id_t2', 'left')
                ->from('t6_product_name a')
                ->count_all_results();

        return $total_records;
    }

    function CountAllDataSupplier($param = [])
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
                ->where('is_delete',0)
                ->from('master_supplier')
                ->count_all_results();

        return $total_records;
    }

    /**
     * Get all area data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function GetAllDataSupplier($param = [])
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
                ->select('*')
                ->where('is_delete',0)
                ->get('master_supplier')
                ->result_array();

        return $data;
    }

    /**
     * Get all area data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function CountAllDataWarehouse($param = [])
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
                ->where('a.is_delete',0)
                ->join('t_data_user b','a.id_pic=b.id','left')
                ->from('master_warehouse a')
                ->count_all_results();

        return $total_records;
    }


    function GetAllDataWarehouse($param = [])
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
                ->select('a.*,CONCAT(b.f_firstname, " ", b.f_lastname) as pic_name,b.f_mail')
                ->where('a.is_delete',0)
                ->join('t_data_user b','a.id_pic=b.id','left')
                ->get('master_warehouse a')
                ->result_array();

        return $data;
    }

    /**
     * Get all area data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function GetAllDataSOstatus($param = [])
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
                ->select('*, SO_status_code as id')
                ->get('master_so_status')
                ->result_array();

        return $data;
    }


    function CountAllDataSOstatus($param = [])
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
                ->from('master_so_status')
                ->count_all_results();

        return $total_records;
    }

    /**
     * Get all area data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function GetAllDataStockStatus($param = [])
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
                ->select('*, Stock_Status_code as id')
                ->where('master_stock_status.is_delete', 0)
                ->get('master_stock_status')
                ->result_array();

        return $data;
    }


    function CountAllDataStockStatus($param = [])
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
                ->where('master_stock_status.is_delete', 0)
                ->from('master_stock_status')
                ->count_all_results();

        return $total_records;
    }

    function InsertUpload($tabel_name,$data){
        $this->db->insert($tabel_name,$data);
        $last_id = $this->db->insert_id();

        return $last_id;

    }

    function checkExistsResourceCode($resource_code, $id = 0){
        if ($id != '' && $id != 0) {
            $this->db->where('id !=', $id);
        }
        $count_records = $this->db
                ->from('t1_device_simcard_type_')
                ->where('resource_code', $resource_code)
                ->count_all_results();
        if ($count_records > 0) {
            return false;
        }

        return true;
    }

    function checkExistsStatusCode($status_code, $id = 0){
        if ($id != '' && $id != 0) {
            $this->db->where('id !=', $id);
        }
        $count_records = $this->db
                ->from('master_stock_status')
                ->where('Stock_Status_code', $status_code)
                ->count_all_results();
        if ($count_records > 0) {
            return false;
        }

        return true;
    }

    function checkExistsCompany($status_code, $id = 0){
        if ($id != '' && $id != 0) {
            $this->db->where('id !=', $id);
        }
        $count_records = $this->db
                ->from('master_company')
                ->where('company_name', $status_code)
                ->where('is_delete',0)
                ->count_all_results();
        if ($count_records > 0) {
            return false;
        }

        return true;
    }
}
/* End of file Master_data_model.php */
/* Location: ./application/models/Master_data_model.php */
