<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Profile Class.
 *     Profile page for every admin user
 *
 * @author alfian purnomo <alfian.pacul@gmail.com>
 *
 * @version 3.0
 *
 * @category Controller
 */
class Profile extends CI_Controller
{
    /**
     * This show current class.
     *
     * @var string
     */
    private $class_path_name;

    /**
     * Error message/system.
     *
     * @var string
     */
    private $error;

    /**
     * Class contructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->class_path_name = $this->router->fetch_class();
    }

    /**
     * Index page for this controller.
     */
    public function index()
    {
        $id = id_auth_user();
        $id_group = id_auth_group();
        if ( ! $id || ! $id_group) {
            redirect();
        }
        #$id = 140;
        $this->data['page_title']      = 'Profile';
        $this->data['form_action']     = site_url($this->class_path_name);
        $this->data['changepass_form'] = site_url($this->class_path_name.'/change_pass');
        $detail                        = $this->Admin_model->GetAdmin($id);
        $post                          = $detail;
        
        // debugvar($detail);
        // die();
        if ($this->input->post()) {
            if ($this->validateForm()) {
                $post      = $this->input->post();
                $now       = date('Y-m-d H:i:s');
                $data_user = [
                    'f_firstname'           => $post['f_firstname'],
                    'f_lastname'            => $post['f_lastname'],
                    'f_mail'                => strtolower($post['f_mail']),
                    'f_phone'               =>$post['f_phone'],                    
                    'modify_date' => $now,
                ];

                $data_employee = [
                    'firstname'             => $post['f_firstname'],
                    'lastname'              => $post['f_lastname'],
                    'email'                 => strtolower($post['f_mail']),
                    'handphone'             =>$post['f_phone'],
                    'nik'                   =>$post['f_nik'],
                ];

                $post['f_nik'] = $data_employee['nik'];

                // update data
                $this->Admin_model->UpdateRecord($id, $data_user);
                $this->Admin_model->UpdateEmployee($detail['employeeid'],$data_employee);
                $post_image = $_FILES;
                if ($post_image['image']['tmp_name']) {
                    $filename = 'adm_'.url_title($post['f_firtsname'], '_', true).md5plus($id);
                    if ($record['image'] != '' && file_exists(UPLOAD_DIR.'admin/'.$record['image'])) {
                        unlink(UPLOAD_DIR.'admin/'.$record['image']);
                        @unlink(UPLOAD_DIR.'admin/tmb_'.$record['image']);
                        @unlink(UPLOAD_DIR.'admin/sml_'.$record['image']);
                    }
                    $picture_db = file_copy_to_folder($post_image['image'], UPLOAD_DIR.'admin/', $filename);
                    copy_image_resize_to_folder(UPLOAD_DIR.'admin/'.$picture_db, UPLOAD_DIR.'admin/', 'tmb_'.$filename, IMG_THUMB_WIDTH, IMG_THUMB_HEIGHT, 70);
                    copy_image_resize_to_folder(UPLOAD_DIR.'admin/'.$picture_db, UPLOAD_DIR.'admin/', 'sml_'.$filename, IMG_SMALL_WIDTH, IMG_SMALL_HEIGHT, 70);
                    // update data
                    $this->Admin_model->UpdateRecord($id, ['image' => $picture_db]);
                }

                $user_session                = $_SESSION['ADM_SESS'];
                $user_session['admin_name']  = $post['f_firstname'].' '.$post['f_lastname'];
                $user_session['admin_email'] = strtolower($post['f_mail']);
                
                $_SESSION['ADM_SESS'] = $user_session;

                // insert to log
                $data_log = [
                    'id_user'  => $id,
                    'id_group' => $id_group,
                    'action'   => 'Profile',
                    'desc'     => 'Edit Profile; ID: '.$id.'; Data: '.json_encode($post),
                ];
                insert_to_log($data_log);
                // end insert to log

                $this->session->set_flashdata('form_message', alert_box('Your Profile has been updated.', 'success'));

                redirect($this->class_path_name);
            }
        }
        $this->data['post'] = $post;
        if ($this->error) {
            $this->data['form_message'] = $this->error;
        }
        if ($this->session->flashdata('form_message')) {
            $this->data['form_message'] = $this->session->flashdata('form_message');
        }
    }

    /**
     * Change user password.
     */
    public function change_pass()
    {
        $this->layout = 'none';
        if ($this->input->is_ajax_request() && $this->input->post()) {

            $json   = [];
            $post   = $this->input->post();
            // debugvar($post);
            // die();
            $id     = id_auth_user();
            $detail = $this->Admin_model->GetAdmin($id);
            if ( ! $id || ! $detail) {
                $json['location'] = site_url('dashboard');
            }
            if ( ! $this->validatePassword($detail)) {
                $json['error'] = $this->error;
            }

            if (!password_verify($post['old_password'], $detail['f_password'])) {
                $json['error'] = alert_box('The old password is wrong','danger');
            }
            if (!$json) {
                $now = date('Y-m-d H:i:s');
                $data = [
                    'f_password'    => password_hash($post['f_password'],PASSWORD_DEFAULT),#md5($post['new_password']),
                    'modify_date' => $now,
                ];
                //password_hash($post['f_password'],PASSWORD_DEFAULT);
                $this->Admin_model->UpdateRecord($id, $data);
                // insert to log
                $data_log = [
                    'id_user'  => id_auth_user(),
                    'id_group' => id_auth_group(),
                    'action'   => 'Profile',
                    'desc'     => 'Change Password Profile; ID: '.$id.';',
                ];
                insert_to_log($data_log);
                // end insert to log
                $json['success']  = alert_box('Your Password has been changed.', 'success');
                $json['redirect'] = site_url('profile');
                $this->session->set_flashdata('form_message', $json['success']);
            }
            json_exit($json);
        }
        redirect('profile');
    }

    /**
     * Validate form.
     *
     * @return bool
     */
    private function validateForm()
    {
        $id   = id_auth_user();
        $post = $this->input->post();
        $config = [
            [
                'field' => 'f_firstname',
                'label' => 'First Name',
                'rules' => 'required|alpha_numeric_spaces',
            ],
            [
                'field' => 'f_lastname',
                'label' => 'Last Name',
                'rules' => 'required|alpha_numeric_spaces',
            ],
            [
                'field' => 'f_nik',
                'label' => 'NIK',
                'rules' => 'required|alpha_numeric_spaces|callback_check_nik_exists['.$id.']',
            ],
            [
                'field' => 'f_mail',
                'label' => 'Email',
                'rules' => 'required|valid_email|callback_check_email_exists['.$id.']',
            ],
        ];
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() === false) {
            $this->error = alert_box(validation_errors(), 'danger');

            return false;
        } else {
            $post_image = $_FILES;
            if (!empty($post_image['image']['tmp_name'])) {
                $check_picture = validatePicture('image');
                if (!empty($check_picture)) {
                    $this->error = alert_box($check_picture, 'danger');

                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Validate change password form.
     *
     * @return bool
     */
    private function validatePassword($user_data)
    {
        $post   = $this->input->post();
        $config = [
            [
                'field' => 'old_password',
                'label' => 'Old Password',
                'rules' => 'required',
            ],
            [
                'field' => 'f_password',
                'label' => 'Password',
                'rules' => 'required',
            ],
            [
                'field' => 'conf_password',
                'label' => 'Password Confirmation',
                'rules' => 'required',
            ],
        ];
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() === false) {
            $this->error = alert_box(validation_errors(), 'danger');

            return false;
        } else {
            /*if ( ! validate_password($post['old_password'], $user_data['userpass']) && $user_data['userpass'] != '') {
                $this->error = alert_box('Your Old Password is incorrect.', 'danger');

                return false;
            }*/
        }

        return true;
    }

    /**
     * Form validation check email exist.
     *
     * @param string $string
     * @param int    $id
     *
     * @return bool
     */
    public function check_email_exists($string, $id = 0)
    {
        if ( ! $this->Admin_model->checkExistsEmail($string, $id)) {
            $this->form_validation->set_message('check_email_exists', '{field} is already exists. Please use different {field}');

            return false;
        }

        return true;
    }

    /**
     * Form validation check email exist.
     *
     * @param string $string
     * @param int    $id
     *
     * @return bool
     */
    public function check_nik_exists($string, $id = 0)
    {
        if ( ! $this->Admin_model->checkExistsNIK($string, $id)) {
            $this->form_validation->set_message('check_nik_exists', '{field} is already exists. Please use different {field}');

            return false;
        }

        return true;
    }
}
/* End of file Profile.php */
/* Location: ./application/controllers/Profile.php */
