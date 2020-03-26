<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Authentication Class.
 *     hook class that check the authentication
 *
 * @author alfian purnomo <alfian.pacul@gmail.com>
 *
 * @version 3.0
 *
 * @category Hook
 */
class FAT_Authentication
{
    /**
     * Load Codeigniter Super Object
     *
     * @var object
     */
    protected $CI;

    /**
     * Check admin session authorization, return true or false.
     *
     * @author alfian purnomo
     *
     * @return redirect to cms login page if not valid
     */
    public function authentication()
    {
        $this->CI =& get_instance();
        // make exception auth for login
        $segment_1    = $this->CI->uri->segment(1);
        $segment_2    = $this->CI->uri->segment(2);
        $fetch_class  = $this->CI->router->fetch_class();
        $fetch_method = $this->CI->router->fetch_method();
        // echo $fetch_method;
        // die();
        if ($fetch_class == 'error') {
            // allow to access error page
            return;
        }
        if ($segment_1 == 'api') {
            // allow to access api page
            return;
        }
        if ($fetch_class == 'auth' || $fetch_class =='cron') {
            if ($fetch_method == 'login') {
                if (isset($_SESSION['ADM_SESS']) && $_SESSION['ADM_SESS'] != '') {
                    redirect();
                }
            }
            return;
        } else {
            if ( ! isset($_SESSION['ADM_SESS'])) {
                if ($this->CI->input->is_ajax_request()) {
                    $_SESSION['tmp_login_redirect'] = 'dashboard';
                    $json['redirect_auth']          = site_url('login');
                    json_exit($json);
                } else {
                    $_SESSION['tmp_login_redirect'] = site_url('dashboard');
                    redirect('login');
                }
            } else {
                $sess = $_SESSION['ADM_SESS'];
                if (base_url() != $sess['admin_url'] || $sess['admin_token'] != $this->CI->security->get_csrf_hash() || $_SERVER['REMOTE_ADDR'] != $sess['admin_ip']) {
                    session_destroy();
                    if ($this->CI->input->is_ajax_request()) {
                        $_SESSION['tmp_login_redirect'] = 'dashboard';
                        $json['redirect_auth']          = site_url('login');
                        json_exit($json);
                    } else {
                        $this->CI->session->set_userdata('tmp_login_redirect',current_url());
                        redirect('login');
                    }
                }

                // check auth
                $id_group = $sess['admin_id_auth_group'];
                /*echo $id_group;
                echo $fetch_class;*/
                if ( ! $this->checkAuth($fetch_class, $id_group,$fetch_method)) {

                    show_404();
                    // $this->CI->session->sess_destroy();
                    // redirect('login');
                }
            }
        }
    }

    /**
     * Check authorization for user.
     *
     * @param string $menu
     * @param int    $id_group
     *
     * @return bool
     */
    private function checkAuth($menu, $id_group,$method)
    {
        $this->CI = &get_instance();
        $this->CI->load->database();
        $sess = $_SESSION['ADM_SESS'];
        // exclude this uri/menu
        // this menu does not require acl
        if ( ! $menu || $menu == 'home' || $menu == 'dashboard' || $menu == '' || $menu == 'profile' || $menu=='cron') {
            return true;
        }

        if (is_superadmin()) {
            $count = $this->CI->db
                    ->from('auth_menu')
                    ->where('LCASE(file)', strtolower($menu))
                    ->where('id_auth_group', $id_group)
                    ->join('auth_menu_group', 'auth_menu_group.id_auth_menu = auth_menu.id_auth_menu', 'left')
                    ->count_all_results();
        } else {
            $count = $this->CI->db
                    ->from('auth_menu')
                    ->where('LCASE(file)', strtolower($menu))
                    ->where('id_auth_group', $id_group)
                    ->where('is_superadmin', 0)
                    ->join('auth_menu_group', 'auth_menu_group.id_auth_menu = auth_menu.id_auth_menu', 'left')
                    ->count_all_results();

        }

        if ($count > 0) {
            $count_method = $this->CI->db
                            ->from('auth_function_group a')
                            ->where('LCASE(b.function_path)', strtolower($method))
                            ->where('LCASE(c.file)', strtolower($menu))
                            ->where('a.id_auth_group', $id_group)
                            ->join('auth_menu_function b','a.id_auth_menu_function=b.id_auth_menu_function')
                            ->join('auth_menu c','c.id_auth_menu=b.menu_id')
                            ->count_all_results();
            // echo $this->CI->db->last_query();
            // echo $count_method;
            // die();
            if($count_method > 0){
                return true;
            }else{
                if($this->CI->input->is_ajax_request()){
                    return true;
                }
            }

            if($sess['admin_type']=='superadmin'){
                return true;
            }
            
        }

        return false;
    }
}

/* End of file FAT_Authentication.php */
/* Location: ./application/hooks/FAT_Authentication.php */
