<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Use $CI=& get_instance() for get CI instance inside the helper.
 * example : use $CI->load->database() to connect a db after you declare $CI=&get_instance().
 *
 * @author alfian purnomo <alfian.pacul@gmail.com>
 */

/**
 * return grid data from query
 * @param string $query
 * @param string $alias
 * @param string $group_by
 * @return array data
 */
function query_grid($query, $alias=array(), $group_by='')
{
    $CI = & get_instance();
    $CI->layout = 'blank';
    $param = $CI->input->get();
    $where = q_where($param, $alias);
    $order = "order by $param[sort_field] $param[sort_type]";
    $paging = "limit $param[perpage] offset $param[page]";

    $group = ($group_by) ? "group by ".$group_by : "";
    $sql = "$query $where $group";
    
    //echo $param['lang'];
    $data['total'] = $CI->db->query($sql)->num_rows();
    $data['data'] = $data['total']>0?$CI->db->query($sql . " $order $paging")->result_array():array();
    return $data;
}

/**
 * return grid data from query
 * @param string $query
 * @param string $alias
 * @param string $group_by
 * @return array data
 */
function query_grid_223($query, $alias=array(), $group_by='')
{
    $CI = & get_instance();
    $CI->layout = 'blank';
    $param = $CI->input->get();
    $db_223 = $CI->load->database('new_server_223', TRUE);

    $where = q_where($param, $alias);
    $order = "order by $param[sort_field] $param[sort_type]";
    $paging = "limit $param[perpage] offset $param[page]";

    $group = ($group_by) ? "group by ".$group_by : "";
    $sql = "$query $where $group";
    
    //echo $param['lang'];
    $data['total'] = $db_223->query($sql)->num_rows();
    $data['data'] = $data['total']>0?$db_223->query($sql . " $order $paging")->result_array():array();
    return $data;
}

/**
 * set/convert query condition
 * @param array $param
 * @param array $alias
 * @return string query condition
 */
function q_where($param, $alias)
{
    $where = '';
    foreach ($param as $key => $val) {
        if (substr($key, 0, 6) == 'search' && (substr($key,0,8) != 'search_e') && (substr($key,0,8) != 'search_s')) {
            $field = ($alias[$key] != '') ? $alias[$key] : substr($key, 7);
            if ($val && !empty($val)) {
                $where .= "and LCASE($field)  like '%".strtolower($val)."%' ";                
            }
        }elseif( (substr($key,0,8) == 'search_e') || (substr($key,0,8) == 'search_s') ) {
            if($val){

                $field = ($alias[$key] != '') ? $alias[$key] : substr($key, 9);
                if((substr($key, 7,1)=='s')){
                    $where .= " and $field  >= '$val 00:00:00'";
                }else{
                    $where .= " and $field  <= '$val 23:59:59'";
                }
            }
        }


    }

    return $where;
}
/**
 * 
 * @param int $total_row
 * @param int $uri_segment
 * @return string pagination
 */
function paging($total_row, $uri_segment = 3,$id=0)
{
    $CI = & get_instance();
    $param = $_GET;
    $function = $CI->uri->segment(2);
    $CI->load->library('pagination');
    
    $config['base_url'] = current_controller($function.'/');
    if($id){
         $config['base_url'] = current_controller($function.'/'.$id);   
    }
    $config['total_rows'] = $total_row;
    $config['uri_segment'] = $uri_segment;
    $config['anchor_class'] = 'class="tangan"';
    $config['per_page'] = $param['perpage'];
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['first_link'] = '<<';
    $config['last_link'] = '>>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $config['last_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['first_tag_open'] = '<li>';
    $config['next_link'] = '>';
    $config['prev_link'] = '<';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a>';
    $config['cur_tag_close'] = '</a></li>';
    $CI->pagination->initialize($config);
    $paging = '<div class="pull-right"><ul class="pagination">';
    $paging .= $CI->pagination->create_links();
    $paging .= '</ul></div>';
    $n = $param['page'];
    $n2 = $n + 1;
    $sd = $n + $param['perpage'];
    $sd = ($total_row < $sd) ? $total_row : $sd;
    $remark = ($sd > 0) ? ("View $n2 - $sd of $total_row") : '';
    return $paging . '<div class="pull-right" style="line-height:32px;margin:22px 8px;">' . $remark . '</div>';
}
/* End of file xms_helper.php */
/* Location: ./application/helpers/xms_helper.php */
