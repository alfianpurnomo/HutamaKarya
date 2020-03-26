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
class Admin_model extends CI_Model
{
    /**
     * Class constructor.
     */
    function __construct()
    {
        parent::__construct();
    }


    /**
     * Get admin user detail by id.
     *
     * @param int $id
     *
     * @return array|bool $data
     */
    function GetDepartment()
    {
        $data = $this->db
                ->select('a.*,CONCAT("c.firtsname"," "," c.lastname") as head_of_department_name')
                ->join('master_employee c','a.head_of_department=c.employeeid')
                ->join('master_division b','a.id_division=b.id_master_division')
                ->get('master_department a')
                ->result_array();
                // echo $this->db->last_query();
                // die();
        return $data;
    }

    /**
     * Get group data.
     *
     * @return array|bool $data
     */
    function GetGolongan()
    {
        
        $data = $this->db
                ->order_by('golongan_name', 'asc')
                ->get('master_golongan')
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
     * Get jobs data.
     *
     * @return array|bool $data
     */
    function GetJobs()
    {
        
        $data = $this->db
                ->order_by('jobs_name', 'asc')
                 ->where('is_delete', 0)
                ->get('jobs_title')
                ->result_array();

        return $data;
    }

    /**
     * Get User Location data.
     *
     * @return array|bool $data
     */
    function GetUserLocations()
    {
        if ( ! is_superadmin()) {
            $this->db->where('is_superadmin', 0);
        }
        $dataWarehouse = $this->db
                        ->select('master_warehouse.id, master_warehouse.Warehouse_Name as location')
                        ->where('master_warehouse.is_delete', 0)
                        ->order_by('id', 'asc')
                        ->get('master_warehouse')
                        ->result_array();

        $dataChannelDistributor = $this->db
                                ->select('master_channeldistributor.ChannelDistributor_code as id, master_channeldistributor.Dealer_Name as location')
                                ->where('master_channeldistributor.is_delete', 0)
                                ->order_by('master_channeldistributor.ChannelDistributor_code', 'asc')
                                ->get('master_channeldistributor')
                                ->result_array();

        $data = array_merge($dataWarehouse, $dataChannelDistributor);

        return $data;
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
     * Get User Main Channel.
     *
     * @return array|bool $data
     */
    public function GetChannelDistributor($param)
    {
        $data = $this->db
          ->select('salesdealer_codename, ChannelDistributor_code')
          ->where($param)
          ->where('channel_type_code', 1)
          ->where('is_delete', 0)
          ->order_by('master_mainchannel_code', 'asc')
          ->get('master_channeldistributor')
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
    function GetAdmin($id)
    {
        $data = $this->db
                ->select('a.*,b.nik as f_nik,b.employeeid,b.jobsid,b.sex,b.department,b.golongan')
                ->where('a.id', $id)
                ->limit(1)
                ->join('master_employee b','a.id=b.userid')
                ->get('t_data_user a')
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
        $this->db->insert('t_data_user', $param);
        $last_id = $this->db->insert_id();

        return $last_id;
    }

    function InsertEmployee($param)
    {
        $this->db->set('employeeid', 'UUID()', FALSE);
        $this->db->insert('master_employee',$param);

        //return $last_id;
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

    function UpdateEmployee($id, $param)
    {
        $this->db
            ->where('employeeid', $id)
            ->update('master_employee', $param);
    }

    /**
     * Delete record.
     *
     * @param int $id
     */
    function DeleteRecord($id)
    {
        $this->db
            ->where('id', $id)
            ->delete('t_data_user');

        
    }

    function DeleteEmployee($id){
        $UUID = $this->db
                        ->where('userid',$id)
                        ->get('master_employee')->row_array();
        $this->db
            ->where('userid', $id)
            ->delete('master_employee');

        $this->db
            ->where('employeeid', $UUID['employeeid'])
            ->delete('mapping_project_employee');
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

    function checkExistsNIK($nik, $id = 0 ){
        if ($id != '' && $id != 0) {
            $this->db->where('a.id !=', $id);
        }
        
        $count_records = $this->db
                ->join('master_employee b','a.id=b.userid')
                ->from('t_data_user a')
                
                ->where('LCASE(b.nik)', strtolower($nik))
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
	
	/**
     * .
     *
     * @param string $username
     * @param int    $id
     *
     * @return bool true/false
     */
    public function getCompanyList()
    {
        
        $data = $this->db
                ->get('master_company')
                ->result_array();
		return $data;
    }
	
	/**
     * .
     *
     * @param string $username
     * @param int    $id
     *
     * @return bool true/false
     */
    public function getDistributorByCompany($company_id)
    {
        
        $data = $this->db
        		->select('ChannelDistributor_code, master_mainchannel_code')
        		->where('id_company',$company_id)
				->order_by('company_name')
                ->get('master_channeldistributor')
                ->result_array();
		$ids = array();
		$return = "";
		if(count($data)>0) foreach($data as $i=>$val)
		{
			$ids[] = $val['ChannelDistributor_code'];
		}
		if(count($ids)>0) $return = implode(',', $ids);
		return $return;
    }
	public function getMainChannelByCompany($company_id)
    {
        
        $data = $this->db
        		->select('master_mainchannel_code')
        		->where('id_company',$company_id)
                ->get('master_channeldistributor')
                ->row_array();
	
		return $data['master_mainchannel_code'];	
	}
	
}
/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */
