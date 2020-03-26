<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Auth Model Class.
 *
 * @author alfian purnomo <alfian.pacul@gmail.com>
 *
 * @version 3.0
 *
 * @category Model
 */
class Auth_model extends CI_Model
{
    /**
     * check login admin.
     *
     * @param string $username
     * @param string $password
     */
    function CheckAuth($username, $password)
    {
        if ($username != '' && $password != '') {
            $username = strtolower($username);
            // this is for development only in case you're too lazy to change the db
            if (ENVIRONMENT == 'development' && ($username == 'super_dev' && $password == 'jangan')) {
                $user_sess = [
                    'admin_name'          => 'Alfian Purnomo (DEV)',
                    'admin_id_auth_group' => 1,
                    'admin_id_auth_user'  => md5plus(1),
                    'admin_email'         => 'alfian.pacul@gmail.com',
                    'admin_type'          => 'superadmin',
                    'admin_url'           => base_url(),
                    'admin_employeeid'    => isset($user_data['employeeid']) ? $user_data['employeeid'] : '8e33e57b-9bd5-1229-9cb8-b4d5bd9e2608',
                    'admin_token'         => $this->security->get_csrf_hash(),
                    'admin_ip'            => get_client_ip(),
                    'admin_last_login'    => date('Y-m-d H:i:s'),
                ];
                $_SESSION['ADM_SESS'] = $user_sess;
                if (isset($_SESSION['tmp_login_redirect'])) {
                    redirect($_SESSION['tmp_login_redirect']);
                } else {
                    redirect();
                }

                return;
            }
            // end of testing dev
            $user_data = $this->db
                ->where('LCASE(f_username)', $username)
                ->limit(1)
                ->join('master_employee b','b.userid=a.id','LEFT')
                ->get('t_data_user a')
                ->row_array();

            if ($user_data) {
                // $string_password = '123456';
                // $hash_password = password_hash($string_password,PASSWORD_DEFAULT);
                // if(password_verify($password, $user_data['f_password'])){
                //     echo 'sdsds';
                // }
                // die();
                // echo password_hash($password,PASSWORD_DEFAULT).'<br>';
                // echo $user_data['f_password'].'<br>';
                // die();
                if (password_verify($password, $user_data['f_password'])) {
                    $user_sess = [
                        'admin_name'          => $user_data['f_firstname'].' '.$user_data['f_lastname'],
                        'admin_id_auth_group' => $user_data['f_grouprole'],
                        'admin_id_auth_user'  => md5plus($user_data['id']),
                        'admin_email'         => $user_data['f_mail'],
                        'admin_ip'            => get_client_ip(),
                        'admin_url'           => base_url(),
                        'admin_employeeid'    => $user_data['employeeid'],
                        'admin_token'         => $this->security->get_csrf_hash(),
                        'admin_last_login'    => $user_data['f_last_login'],
                    ];
                    $_SESSION['ADM_SESS'] = $user_sess;
                    $this->load->model('Admin_model');
                    $data_update = [
                        'f_last_login'=>date('Y-m-d H:i:s')
                    ];
                    $this->Admin_model->UpdateRecord($user_data['id'], $data_update);
                    // insert to log
                    $data = [
                        'id_user'  => $user_data['id'],
                        'id_group' => $user_data['f_grouprole'],
                        'action'   => 'Login',
                        'desc'     => 'Login:succeed; IP:'.get_client_ip().'; username:'.$username.';',
                    ];
                    insert_to_log($data);
                    if (isset($_SESSION['tmp_login_redirect'])) {
                        redirect($_SESSION['tmp_login_redirect']);
                    } else {
                        redirect('dashboard');
                    }
                } else {
                    // insert to log
                    $data = [
                        'action' => 'Login',
                        'desc'   => 'Login:failed; IP:'.get_client_ip().'; username:'.$username.';',
                    ];
                    insert_to_log($data);
                }
            } else {
                //insert to log
                $data = [
                    'action' => 'Login',
                    'desc'   => 'Login:failed; IP:'.get_client_ip().'; username:'.$username.';',
                ];
                insert_to_log($data);
            }
        }
        $this->session->set_flashdata('flash_message', alert_box('Username/Password isn\'t valid. Please try again.', 'danger'));
        redirect('login');
    }
}
/* End of file Auth_model.php */
/* Location: ./application/models/Auth_model.php */
