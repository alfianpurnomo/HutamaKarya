<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Login Class.
 *
 * @author alfian purnomo <alfian.pacul@gmail.com>
 *
 * @version 3.0
 *
 * @category Controller
 */
class Auth extends CI_Controller
{
    /**
     * login page.
     */
    public function login()
    {
        $this->load->model('Auth_model');
        $this->layout              = 'login';
        $this->data['page_title']  = 'Login';
        $this->data['form_action'] = site_url('login');
        $this->data['url_register'] = site_url('auth/register');
        $this->load->model('Global_model','GM');
        $q_type = $this->GM->GetFromTabel('MULTI','id_auth_group, auth_group','auth_group',array('id_auth_group >'=>1),array(),[],[],[],'id_auth_group','ASC');
        $this->data['q_type'] = $q_type;
        if ($this->input->post()) {
            $post = $this->input->post();

            /*echo '<pre>';
            print_r($post);

            echo $this->db->last_query();

            die();*/

            if (isset($post['username']) && isset($post['password']) && $post['username'] != '' && $post['password'] != '') {
                
                $this->Auth_model->CheckAuth($post['username'], $post['password']);

            } else {
                $error_login = alert_box('Username/Password isn\'t valid. Please try again.', 'danger');
            }
        }
        if (isset($error_login)) {
            $this->data['error_login'] = $error_login;
        }
        if ($this->session->flashdata('flash_message')) {
            $this->data['error_login'] = $this->session->flashdata('flash_message');
        }
    }

    /**
     * lougout page.
     */
    public function logout()
    {
        // debugvar($_SESSION['ADM_SESS']);
        // die();
        $this->layout='none';
        $data = [
            'id_user'  => id_auth_user(),
            'id_group' => id_auth_group(),
            'action'   => 'Logout',
            'desc'     => 'Logout:succeed; IP:'.get_client_ip().'; id:'.$_SESSION['ADM_SESS']['admin_name'].';',
        ];
        insert_to_log($data);
        session_destroy();
        redirect('login', 'refresh');
        exit;
    }

    public function register(){
        $this->layout = 'none';
        if($this->input->post() && $this->input->is_ajax_request()){
            $result = array();
            $post = array_map('trim', $this->input->post()); 
            $this->load->model('Troubleticket_model','TT_M');
            $val_data = array(
                "id" => 'NULL',
                "f_firstname" => ($post['f_firstname']),
                "f_lastname" => ($post['f_lastname']),
                "f_username" => ($post['f_username']),
                "f_password" => (md5($post['f_password'])),
                "f_mail" => ($post['f_mail']),
                "f_phone" => ($post['f_phone']),
                "f_grouprole" => $post['f_group'],
                "f_userrole" => '""',
                "f_auth" => 0,
                "f_remarks" => '""',
                "f_last_login" => '"0000-00-00 00:00:00"',
                "modify_date"=> '"0000-00-00 00:00:00"',
                "is_superadmin"=>0,
                "themes"=>'"inspinia"'
            );

            $q_username = $this->TT_M->GetFromTabel('f_username','t_data_user',array('f_username'=>$val_data['f_username']),array(),'','','SINGEL');#$DBC->query_single('SELECT f_username FROM t_data_user WHERE f_username = '.$val_data["f_username"].';');
            
            if($q_username > 0) {
                $result['result']='ERROR';
                json_exit($result);
            } else {
                $xr = $this->TT_M->InsertTabel($val_data,'t_data_user');#$DBC->execute('INSERT INTO t_data_user VALUES ('.implode(",", $val_data).');');
                if($xr){
                    $sendmail = $this->sendMail($post);
                    $result['result']='OK';
                    json_exit($result);
                }
                
            }
        }
        redirect('login');
    }

    private function sendMail($data){
        $result = array();
        
        $html = '<b>Dear Admin of OSS3,</b><br><br>
        '.$data['f_firstname'].' '.$data['f_lastname'].' has been register with user <b>'.$data['f_username'].'</b> and waiting for your approval.<br><br>
        <b>Thanks.</b>
        ';
        $subject = "Register OSS3";
        
        $sender  = array(
                array(
                    'name'=>'OSS3 Administrator',
                    'email'=>'info@bolt.id'
                )
            );
        $cc = array();
        $rcpt = array(
                    array(
                        'name'=>'Alfian Purnomo',
                        'email'=>'alfian.purnomo@bolt.id',
                    ),
                    array(
                        'name'=>'Taufan Aji',
                        'email'=>'taufan.aji@bolt.id',
                    ),
                    array(
                        'name'=>'Franklin Jane',
                        'email'=>'franklin.jane@bolt.id',
                    )
            );
        
        $mail   = custom_send_email_ci($sender,$rcpt,$cc,$subject,$html);
        

        return $result;
    }

    public function forgot_password(){
        $this->layout              = 'login';
        $this->data['page_title']  = 'Login';
    }
}
/* End of file Login.php */
/* Location: ./application/controllers/Login.php */
