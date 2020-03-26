<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Exceptions Class Extension.
 *     extending exceptions class for customize error page.
 *     
 * @author alfian purnomo <alfian.pacul@gmail.com>
 * 
 * @version 3.0
 * 
 * @category Core
 * 
 */

class FAT_Exceptions extends CI_Exceptions 
{
    /**
     * Load Codeigniter Super Object
     * 
     * @var object
     */
    protected $CI;

    /**
     * Load the parent constructor.
     */
    public function __construct() 
    {
        parent::__construct();
    }

    /**
     * Error 404 handler.
     * 
     * @param  string  $page
     * @param  boolean $log_error
     * 
     * @return string layout
     */
    public function show_404($page = '', $log_error = TRUE)
    {
        $this->CI =& get_instance();
        if (is_cli())
        {
            $heading = 'Not Found';
            $message = 'The controller/method pair you requested was not found.';
        }
        else
        {
            // set data
            $heading = '404 Page Not Found';
            $message = 'The page you requested was not found.';
            $data['base_url']    = base_url();
            $data['current_url'] = current_url();
            if (isset($_SESSION['ADM_SESS'])) {
                $data['ADM_SESSION'] = $_SESSION['ADM_SESS'];
            }
            $data['flash_message']      = $this->CI->session->flashdata('flash_message');
            $data['persistent_message'] = (isset($_SESSION['persistent_message'])) ? $_SESSION['persistent_message'] : '';
            $data['auth_sess']          = (isset($_SESSION['ADM_SESS'])) ? $_SESSION['ADM_SESS'] : [];
            $data['site_setting']       = [];#get_sitesetting();
            $data['site_info']          = [];#get_site_info();
            $data['page_title']         = $heading;
            $data['error_heading']      = $heading;
            $data['error_message']      = $message;
            
            $menus                      = $this->MenusData();
            $menus_ids                  = [];
            $data['main_menu']          = $this->PrintMainMenu($menus, $menus_ids);

            // breadcrumbs
            $data['breadcrumbs'][] = [
                'text'  => '<i class="fa fa-dashboard"></i> Dashboard',
                'url'   => site_url('dashboard'),
                'class' => '',
            ];
            $data['breadcrumbs'][] = [
                'text'  => '<i class="fa fa-bug"></i> Error 404',
                'url'   => '#',
                'class' => 'active',
            ];

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
            $data['ASSETS_URL'] = PATH_CMS.'assets/'.$template_dir.'/';
            $data['IMG_URL']    = $data['ASSETS_URL'].'img/';
            $data['CSS_URL']    = $data['ASSETS_URL'].'css/';
            $data['JS_URL']     = $data['ASSETS_URL'].'js/';
            $data['VENDOR_URL'] = $data['ASSETS_URL'].'vendor/';
            $data['LIBS_URL']   = $data['ASSETS_URL'].'libs/';
            $data['PLUGINS_URL']   = $data['ASSETS_URL'].'plugins/';

            $data['content'] = $this->CI->load->view($template_dir.'/error/page_not_found', $data, true);
            $layout = $template_dir.'/layout/default';
            echo $layout;
            echo $this->CI->load->view($layout, $data, true);
        }

        // By default we log this, but allow a dev to skip it
        if ($log_error)
        {
            log_message('error', $heading.': '.$page);
        }
        set_status_header(404);
        // echo $this->show_error($heading, $message, 'error_404', 404);
        exit(4); // EXIT_UNKNOWN_FILE
    }

    

    // --------------------------------------------------------------------

    /**
     * General Error Page
     *
     * Takes an error message as input (either as a string or an array)
     * and displays it using the specified template.
     *
     * @param   string      $heading    Page heading
     * @param   string|string[] $message    Error message
     * @param   string      $template   Template name
     * @param   int     $status_code    (default: 500)
     *
     * @return  string  Error page output
     */
    public function show_error($heading, $message, $template = 'error_general', $status_code = 500) 
    {
        $templates_path = config_item('error_views_path');
        if (empty($templates_path)) {
            $templates_path = VIEWPATH . 'bims'.DIRECTORY_SEPARATOR.'errors' . DIRECTORY_SEPARATOR;
        }
        
        if (is_cli()) {
            $message = "\t" . (is_array($message) ? implode("\n\t", $message) : $message);
            $template = 'cli' . DIRECTORY_SEPARATOR . $template;
        } else {
            set_status_header($status_code);
            $message = '<p>' . (is_array($message) ? implode('</p><p>', $message) : $message) . '</p>';
            $template = 'html' . DIRECTORY_SEPARATOR . $template;
        }

        if (ob_get_level() > $this->ob_level + 1) {
            ob_end_flush();
        }
        ob_start();
        include_once($templates_path . $template . '.php');
        $buffer = ob_get_contents();
        ob_end_clean();
        return $buffer;
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

}

/* End of file FAT_Exceptions.php */
/* Location: ./application/core/FAT_Exceptions.php */
