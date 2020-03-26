<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Layout Class.
 *     library class that load to display layouts
 *
 * @author alfian purnomo <alfian.pacul@gmail.com>
 *
 * @version 3.0
 *
 * @category Libraries
 */
class FAT_Layout
{
    /**
     * Load Codeigniter Super Object
     * 
     * @var object
     */
    protected $CI;
    private $themes;

    /**
     * Print layout based on controller class and function.
     *
     * @return string view layout
     */
    public function layout()
    {
        $this->CI = &get_instance();

        if (isset($this->CI->layout) && $this->CI->layout == 'none') {
            return;
        }
        // set data
        $dir                        = $this->CI->router->directory;
        $class                      = $this->CI->router->fetch_class();
        $method                     = $this->CI->router->fetch_method();
        $method                     = ($method == 'index') ? $class : $method;
        $data                       = (isset($this->CI->data)) ? $this->CI->data : [];
        $data['current_controller'] = base_url().$dir.$class.'/';
        if (isset($data['current_path'])) {
            $current_path = str_replace(base_url().$dir, '', current_url());
        } else {
            $current_path = $class;
        }
        $page_info           = $this->GetPageInfoByFile($class);
        $id_auth_menu        = $page_info['id_auth_menu'];

        $data['base_url']    = base_url();
        $data['current_url'] = current_url();
        
        if (isset($_SESSION['ADM_SESS'])) {
            $data['ADM_SESSION'] = $_SESSION['ADM_SESS'];
        }
        $data['flash_message']      = $this->CI->session->flashdata('flash_message');
        $data['persistent_message'] = (isset($_SESSION['persistent_message'])) ? $_SESSION['persistent_message'] : '';
        
        $data['auth_sess']          = (isset($_SESSION['ADM_SESS'])) ? $_SESSION['ADM_SESS'] : [];
        $data['site_setting']       = get_sitesetting();
        $data['site_info']          = get_site_info();
        // debugvar($data);
        // die();
        $data['page_title']         = (isset($data['page_title'])) ? $data['page_title'] : $page_info['menu'];
        $data['pic_on_duty']        = [];#GetPic();
        $menus                      = $this->MenusData();
        
        // $notif                      = $this->GetNotifByUser(id_auth_user());
        $data['notif']              = '';
        $data['count_notif']        = '';
        
        $ids[]                      = $id_auth_menu;
        $menus_ids                  = [];
        if (isset($page_info['parent_auth_menu'])) {
            $menus_ids = $this->ActiveMenuIds($page_info['parent_auth_menu'], $ids);
        }
        $data['main_menu'] = $this->PrintMainMenu($menus, $menus_ids);

        $breadcrumbs = $this->Breadcrumbs($id_auth_menu);
        $breadcrumbs[] = [
            'text'  => '<i class="fa fa-dashboard"></i> Dashboard',
            'url'   => site_url('dashboard'),
            'class' => '',
        ];
        array_multisort($breadcrumbs, SORT_ASC, SORT_NUMERIC);

        if (isset($data['breadcrumbs'])) {
            $breadcrumbs[] = $data['breadcrumbs'];
        }
        /*debugvar($breadcrumbs);
        die();*/
        $data['breadcrumbs'] = $breadcrumbs;

        // template
        $template_dir = 'bims';//getActiveThemes();

        // default
        $data['GLOBAL_ASSETS_URL'] = PATH_CMS.'assets/default/';
        $data['GLOBAL_IMG_URL']    = $data['GLOBAL_ASSETS_URL'].'img/';
        $data['GLOBAL_CSS_URL']    = $data['GLOBAL_ASSETS_URL'].'css/';
        $data['GLOBAL_JS_URL']     = $data['GLOBAL_ASSETS_URL'].'js/';
        $data['GLOBAL_VENDOR_URL'] = $data['GLOBAL_ASSETS_URL'].'vendor/';
        $data['GLOBAL_LIBS_URL']   = $data['GLOBAL_ASSETS_URL'].'libs/';
        // active template
        $data['ASSETS_URL']     = PATH_CMS.'assets/'.$template_dir.'/';
        $data['IMG_URL']        = $data['ASSETS_URL'].'img/';
        $data['CSS_URL']        = $data['ASSETS_URL'].'css/';
        $data['JS_URL']         = $data['ASSETS_URL'].'js/';
        $data['VENDOR_URL']     = $data['ASSETS_URL'].'vendor/';
        $data['LIBS_URL']       = $data['ASSETS_URL'].'libs/';
        $data['PLUGINS_URL']    = $data['ASSETS_URL'].'plugins/';

        if (isset($data['template'])) {
            $data['content'] = $this->CI->load->view($template_dir.'/'.$data['template'], $data, true);
        } else {
            $data['content'] = $this->CI->load->view($template_dir.'/'.$class.'/'.$method, $data, true);
        }
        if (isset($this->CI->layout)) {
            $layout = $template_dir.'/layout/'.$this->CI->layout;
        } elseif ($this->CI->input->is_ajax_request()) {
            $layout = $template_dir.'/layout/blank';
        } else {
            $layout = $template_dir.'/layout/default';
        }
        $this->CI->load->view($layout, $data);
    }


    private function GetNotifByUser($id){
        $this->CI = &get_instance();
        $this->CI->load->database();
        /*$data = $this->CI->db
                ->select('transaction_management.id_transaction,transaction_management.controller_handling,user_notif.notif_date,transaction_approval.`approval_lvl` AS lvl_notif,
(SELECT master_transaction_code FROM transaction_management WHERE Transaction_no=user_notif.`Transaction_no` limit 1) AS code_transaction ')
                ->join('transaction_approval', 'transaction_approval.transaction_approval_no = user_notif.id_transaction_management')
                ->join('transaction_management', 'transaction_management.Transaction_no = transaction_approval.Transaction_no')
                ->where('user_notif.usermgmt_id', $id)
                ->where('transaction_approval.usermgmt_id', $id)
                ->where('transaction_approval.approval_code','00')
                ->order_by('user_notif.notif_date', 'desc')
                ->get('user_notif')
                ->result_array();*/
        $data = $this->CI->db
                ->select('a.approval_date,b.id_transaction,b.transaction_date,b.controller_handling,a.`approval_lvl` AS lvl_notif,b.master_transaction_code AS code_transaction ')
                ->join('transaction_management b','a.Transaction_no = b.Transaction_no')
                ->where('a.usermgmt_id', $id)
                ->where('a.approval_code','00')
                ->order_by('a.approval_date', 'desc')
                ->get('transaction_approval a')->result_array();
        /*echo $this->CI->db->last_query();
        die();*/
        $html = '';
        if($data){
            foreach ($data as $key => $value) {
                $href = site_url($value['controller_handling'].'/detail/'.$value['id_transaction']);
                $html .='<li>
                            <a href="'.$href.'">
                                <div class="user-list-wrap">
                                    <div class="profile-pic profile-icon">Level '.$value['lvl_notif'].'</div>
                                    <div class="detail">
                                        <span class="text-normal">'.$value['code_transaction'].'</span>
                                        <span class="time">'.time_elapsed_string($value['approval_date'].' '.date('H:i:s',strtotime($value['transaction_date']))).'</span>
                                        <p class="font-11 no-m-b text-overflow">Sent you a File to Approve</p>
                                    </div>
                                </div>
                            </a>
                        </li>';
            }
        }
        $result['cnt']  = count($data);
        $result['html'] = $html;
        return $result;
    }

    /**
     * Get page info by file.
     *
     * @param string $class
     * @param mixed  $return array or string
     *
     * @return mixed array/string
     */
    private function GetPageInfoByFile($class, $return = [])
    {
        $this->CI = &get_instance();
        $this->CI->load->database();
        if ($class == 'login') {
            $arr = [
                'id_auth_menu' => 0,
                'menu'         => 'Login',
            ];

            return $arr;
        }
        $data = $this->CI->db
                ->where('LCASE(file)', strtolower($class))
                ->limit(1)
                ->get('auth_menu')
                ->row_array();
        if (is_array($return)) {
            return $data;
        } else {
            return $data[$return];
        }
    }

    /**
     * Get all authenticated menu.
     *
     * @param int $id_parent
     *
     * @return array|bool $data
     */
    private function MenusData($id_parent = 0)
    {
        $i = 0;
        $id_group = id_auth_group();
        if ( ! $id_group) {
            return;
        }
        

        $this->CI = &get_instance();
        $this->CI->load->database();
        $data = $this->CI->db
                ->join('auth_menu', 'auth_menu.id_auth_menu = auth_menu_group.id_auth_menu', 'left')
                ->where('auth_menu_group.id_auth_group', $id_group)
                ->where('auth_menu.parent_auth_menu', $id_parent)
                ->order_by('auth_menu.position', 'asc')
                ->order_by('auth_menu.id_auth_menu', 'asc')
                ->get('auth_menu_group')
                ->result_array();
        foreach ($data as $row => $val) {
            $data[$row]['children'] = $this->MenusData($val['id_auth_menu']);
            $i++;
        }

        return $data;
    }

    /**
     * Active Menu Ids 
     *     return array for listing hierarcy active menu
     *     
     * @param int $id_parent
     * @param array &$ids
     *
     * @return array $ids;
     */
    private function ActiveMenuIds($id_parent = 0, &$ids = [])
    {
        $this->CI = &get_instance();
        $this->CI->load->database();
        if ( ! $id_parent) {
            return $ids;
        }
        $data = $this->CI->db
                ->select('id_auth_menu, parent_auth_menu, file')
                ->where('id_auth_menu', $id_parent)
                ->limit(1)
                ->get('auth_menu')
                ->row_array();
        if ($data) {
            $ids[] = $data['id_auth_menu'];
            $parent = $this->ActiveMenuIds($data['parent_auth_menu'], $ids);
        }

        return $ids;
    }

    /**
     * print left menu.
     *
     * @param array $menus
     *
     * @return string $return left menu html
     */
    private function PrintMainMenu($menus = [], $active_menus = [])
    {
        $template_dir = 'bims';//getActiveThemes();

        $return = '';
        if ($menus) {
            foreach ($menus as $row => $menu) {
                $style = $set_active = '';
                if (strlen($menu['menu']) > 25) {
                    $style = 'style="font-size:12px;"';
                }
                if (is_array($active_menus) && count($active_menus) > 0) {
                    if (in_array($menu['id_auth_menu'], $active_menus)) {
                        $set_active = 'active';
                    }
                }

                $has_child = '';
                if (isset($menu['children']) && count($menu['children']) > 0) {
                    $return .= '<li class="'.$set_active.' has-submenu ">';
                    $return .= '<a href="#subMenu'.strtolower(str_replace(' ', '_', $menu['menu'])).'" data-toggle="collapse" aria-expanded="false" class="collapsed" >';
                }else{
                    $return .= '<li class="'.$set_active.'">';
                    $return .= '<a '.(($menu['file'] == '#' || $menu['file'] == '') ? '' : 'href="'.site_url($menu['file'])).'" '.$style.' '.$set_active.'>';
                }
                
                if($menu['class_icon']!='none'){
                    $return .= '<i class="'.$menu['class_icon'].'"></i>';
                }
                if($template_dir=='bims'){
                    $return .= '<span class="nav-text">'.$menu['menu'].'</span>';
                }else{
                    $return .= $menu['menu'];
                }
                
                /*if (isset($menu['children']) && count($menu['children']) > 0) {
                    $return .= '<span class="fa fa-chevron-down"></span>';
                }*/
                $return .= '</a>';
                $menu_second = '';
                if($template_dir=='inspinia'){
                    $menu_second = 'nav-second-level';
                }elseif($template_dir=='gentelella'){
                    $menu_second='child_menu';
                }elseif($template_dir=='bims'){
                    $menu_second='child_menu';
                }
                if (isset($menu['children']) && count($menu['children']) > 0) {
                    $return .= '<div class="sub-menu collapse secondary" id="subMenu'.strtolower(str_replace(' ', '_', $menu['menu'])).'">';
                        $return .= '<ul>';
                        $return .= $this->PrintMainMenu($menu['children'], $active_menus);
                        $return .= '</ul>';
                    $return .= '</div>';
                }
                $return .= '</li>';
            }
        }

        return $return;
    }

    /**
     * Breadcrumbs.
     *
     * @param int   $id_auth_menu
     * @param array $breadcrumbs
     *
     * @return array breadcrumbs list
     */
    private function Breadcrumbs($id_auth_menu, &$breadcrumbs = [])
    {
        $this->CI = &get_instance();
        $this->CI->load->database();
        if (!$id_auth_menu) {
            return;
        }
        $data = $this->CI->db
                ->select('id_auth_menu,parent_auth_menu,menu,file')
                ->where('id_auth_menu', $id_auth_menu)
                ->limit(1)
                ->get('auth_menu')
                ->row_array();
        if ($data) {
            $breadcrumbs[] = [
                'text'  => $data['menu'],
                'url'   => ($data['file'] != '' && $data['file'] != '#') ? site_url($data['file']) : '#',
                'class' => '',
            ];
            if ($data['parent_auth_menu'] > 0) {
                $parent_data = $this->CI->db
                        ->select('id_auth_menu')
                        ->where('id_auth_menu', $data['parent_auth_menu'])
                        ->limit(1)
                        ->get('auth_menu')
                        ->row_array();
                if ($parent_data) {
                    $this->Breadcrumbs($parent_data['id_auth_menu'], $breadcrumbs);
                }
            }
        }

        return $breadcrumbs;
    }
}

/* End of file FAT_Layout.php */
/* Location: ./application/hooks/FAT_Layout.php */
