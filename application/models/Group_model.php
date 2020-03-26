<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Group Model Class.
 *
 * @author alfian purnomo <alfian.pacul@gmail.com>
 *
 * @version 3.0
 *
 * @category Model
 * 
 */
class Group_model extends CI_Model
{
    /**
     * Class constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get all group data.
     *
     * @param array $param
     *
     * @return array|bool $data
     */
    function GetAllGroupData($param = [])
    {
        if (!is_superadmin()) {
            $this->db->where('is_superadmin', 0);
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
                ->select('*, id_auth_group as id')
                ->get('auth_group')
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
    function CountAllGroup($param = [])
    {
        if ( ! is_superadmin()) {
            $this->db->where('is_superadmin', 0);
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
                ->from('auth_group')
                ->count_all_results();

        return $total_records;
    }

    /**
     * Get admin group detail by id.
     *
     * @param int $id
     *
     * @return array|bool $data
     */
    function GetGroup($id)
    {
        $data = $this->db
                ->where('id_auth_group', $id)
                ->limit(1)
                ->get('auth_group')
                ->row_array();

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
        $this->db->insert('auth_group', $param);
        $last_id = $this->db->insert_id();

        return $last_id;
    }

    /**
     * Update record admin group.
     *
     * @param int   $id
     * @param array $param
     */
    function UpdateRecord($id, $param)
    {
        $this->db
            ->where('id_auth_group', $id)
            ->update('auth_group', $param);
    }

    /**
     * Delete record.
     *
     * @param int $id
     */
    function DeleteRecord($id)
    {
        $this->db
            ->where('id_auth_group', $id)
            ->delete('auth_group');
    }

    /**
     * Get all auth menu.
     *
     * @param int $id_parent
     *
     * @return array|bool $data
     */
    function MenusData($id_group = 0, $id_parent = 0)
    {
        if (!is_superadmin()) {
            $this->db->where('is_superadmin', 0);
        }
        $data = $this->db
                ->join(
                    "(
                        SELECT id_auth_menu as id_auth,id_auth_group 
                        FROM {$this->db->dbprefix('auth_menu_group')} 
                        WHERE id_auth_group = {$id_group}
                    ) AS {$this->db->dbprefix('auth_menu_group')}", 
                    'auth_menu_group.id_auth = auth_menu.id_auth_menu', 
                    'left'
                )
                ->where('parent_auth_menu', $id_parent)
                ->order_by('position', 'asc')
                ->order_by('auth_menu.id_auth_menu', 'asc')
                ->get('auth_menu')
                ->result_array();

        foreach ($data as $row => $val) {
            $data[$row]['checked'] = false;
            if ($val['id_auth_group'] == $id_group) {
                $data[$row]['checked'] = true;
            }
            $data[$row]['children'] = $this->MenusData($id_group, $val['id_auth_menu']);
            $data[$row]['function'] = $this->MenusFunctionData($id_group, $val['id_auth_menu']);
        }

        return $data;
    }

    function MenusFunctionData($id_group = 0, $id_menu = 0){

        // $data = $this->db
        //         ->select('a.*,b.id_auth_group,b.id_auth_function_group')
        //         ->where('a.menu_id',$id_menu)
        //         ->group_start()
        //          ->where('b.id_auth_group',$id_group)
        //          ->or_where('b.id_auth_group',null)
        //          ->group_end()
        //         ->join('auth_function_group b','a.id_auth_menu_function=b.id_auth_menu_function','LEFT')
        //         ->order_by('a.id_auth_menu_function', 'asc')
        //         ->get('auth_menu_function a')
        //         ->result_array();
        #echo $this->db->last_query();
        $data = $this->db
                ->select('auth_menu_function.*,auth_function_group.id_auth_group,auth_function_group.id_auth_function_group')
                ->join(
                    "(
                        select *
                        from auth_function_group
                        where id_auth_group={$id_group}
                        
                    ) AS {$this->db->dbprefix('auth_function_group')}", 
                    'auth_function_group.id_auth_menu_function = auth_menu_function.id_auth_menu_function', 
                    'left'
                )
                ->where('auth_menu_function.menu_id', $id_menu)
                ->order_by('auth_menu_function.id_auth_menu_function', 'asc')
                ->get('auth_menu_function')
                ->result_array();
        if($data){
            foreach ($data as $key => $value) {
                $data[$key]['checked'] = false;
                if($value['id_auth_group']==$id_group){
                    $data[$key]['checked'] = true;
                }
            }
        }
        return $data;
    }

    /**
     * Update authorization.
     *
     * @param int   $id_group
     * @param array $data
     */
    function UpdateAuth($id_group, $data = [],$data_function = [])
    {
        $this->db
            ->where('id_auth_group', $id_group)
            ->delete('auth_menu_group');

        if (count($data) > 0) {
            $insert = [];
            foreach ($data as $row => $val) {
                $insert[$row]['id_auth_group'] = $id_group;
                $insert[$row]['id_auth_menu']  = $val;
            }
            $this->db->insert_batch('auth_menu_group', $insert);
        }

        $this->db
            ->where('id_auth_group', $id_group)
            ->delete('auth_function_group');
        if(count($data_function) > 0){
            $insert_data_function = [];
            foreach ($data_function as $key => $value) {
                $insert_data_function[$key]['id_auth_group'] = $id_group;
                $insert_data_function[$key]['id_auth_menu_function']  = $value;
            }
            $this->db->insert_batch('auth_function_group', $insert_data_function);
        }
    }

    /**
     * Print auth menu to html.
     *
     * @param array  $menus
     * @param string $prefix
     *
     * @return string $return
     */
    function PrintAuthMenu($menus = [], $prefix = '')
    {
        $return = '';
        if ($menus) {
            foreach ($menus as $row => $menu) {
                $return .= '<div class="checkbox checkbox-success">';
                if ($menu['parent_auth_menu'] != 0) {
                    $return .= $prefix;
                    $prefix_f = '&nbsp;&nbsp;&nbsp;&nbsp;';
                    $return .= '<img src="'.PATH_CMS.'assets/default/img/tree-taxo.png"/>&nbsp;&nbsp;';
                } else {
                    $prefix = '';
                    $prefix_f = '';
                }
                $checked = '';
                #$return .= '<label>';
                if ($menu['checked'] == true) {
                    $checked = 'checked="checked"';
                }
                $return .= '<input type="checkbox" value="'.$menu['id_auth_menu'].'"  name="auth_menu_group[]" id="auth-'.$menu['id_auth_menu'].'" class="auth-menu checkauth" '.$checked.'/><label for="auth-'.$menu['id_auth_menu'].'" class="auth-menu">'.$menu['menu'].'</label>';
                #$return .= '</label>';
                $return .= '</div>';
                if (isset($menu['children']) && count($menu['children']) > 0) {
                    $prefix .= '&nbsp;&nbsp;&nbsp;&nbsp;';
                    $return .= $this->PrintAuthMenu($menu['children'], $prefix);
                }
                if (isset($menu['function']) && count($menu['function']) > 0) {
                    $prefix_f .= '&nbsp;&nbsp;&nbsp;&nbsp;'.$prefix;
                    $return .= $this->PrintAuthFunction($menu['function'], $prefix_f);
                    #$prefix = '&nbsp;&nbsp;&nbsp;&nbsp;';
                }
            }
        }

        return $return;
    }

    function PrintAuthFunction($functions = [],$prefix='')
    {
        $return = '';
        if($functions){
            foreach ($functions as $key => $function) {
                $return .= '<div class="checkbox checkbox-success">';
                $return .= $prefix;
                $checked = '';
                #$return .= '<label>';
                if ($function['checked'] == true) {
                    $checked = 'checked="checked"';
                }
                $return .= '<input type="checkbox" value="'.$function['id_auth_menu_function'].'"  name="auth_function_group[]" id="auth-function-'.$function['id_auth_menu_function'].'" class="auth-menu checkauth" '.$checked.'/><label for="auth-'.$function['id_auth_menu_function'].'" class="auth-menu">'.$function['function_name'].'</label>';
                #$return .= '</label>';
                $return .= '</div>';
                
            }
        }
        return $return;
    }
}
/* End of file Group_model.php */
/* Location: ./application/models/Group_model.php */
