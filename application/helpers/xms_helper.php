<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Use $CI=& get_instance() for get CI instance inside the helper.
 * example : use $CI->load->database() to connect a db after you declare $CI=&get_instance().
 *
 * @author alfian purnomo <alfian.pacul@gmail.com>
 */




/**
 * Validate upload image
 *
 * @param string $fieldname fieldname of input file form
 *
 * @return string $error
 */
function validate_picture($fieldname)
{
    $error = '';
    if ( ! empty($_FILES[$fieldname]['error'])) {
        switch ($_FILES[$fieldname]['error']) {
            case '1':
                $error = 'Upload maximum file is '.number_format(IMG_UPLOAD_MAX_SIZE / 1024, 2).' MB.';
                break;
            case '2':
                $error = 'File is too big, please upload with smaller size.';
                break;
            case '3':
                $error = 'File uploaded, but only half of file.';
                break;
            case '4':
                $error = 'There is no File to upload';
                break;
            case '6':
                $error = 'Temporary folder not exists, Please try again.';
                break;
            case '7':
                $error = 'Failed to record File into disk.';
                break;
            case '8':
                $error = 'Upload file has been stop by extension.';
                break;
            case '999':
            default:
                $error = 'No error code avaiable';
        }
    } elseif (empty($_FILES[$fieldname]['tmp_name']) || $_FILES[$fieldname]['tmp_name'] == 'none') {
        $error = 'There is no File to upload.';
    } elseif ($_FILES[$fieldname]['size'] > IMG_UPLOAD_MAX_SIZE) {
        $error = 'Upload maximum file is '.number_format(IMG_UPLOAD_MAX_SIZE / 1024, 2).' MB.';
    } else {
        $cekfileformat = check_image_type($_FILES[$fieldname]);
        if ( ! $cekfileformat) {
            $error = 'Upload Picture only allow (jpg, gif, png)';
        }
    }

    return $error;
}

/**
 * Post Filtered Data.
 * 
 * @param  array         $posts
 * @param  array|string  $keys
 * 
 * @return array $filtered filtered post
 */
function array_filtered($posts = [], $keys = [])
{
    $filtered = [];

    if (is_array($keys)) {
        foreach ($keys as $key) {
            $filtered[$key] = (isset($posts[$key])) ? $posts[$key] : '';
        }
    } else {
        $filtered[$keys] = (isset($posts[$keys])) ? $posts[$keys] : '';
    }

    return $filtered;
}

function update_batch_modify($db, $table = '', $set = NULL, $index = NULL, $index_update_key = '') {
if ($table === '' || is_null($set) || is_null($index) || !is_array($set)) {
    return FALSE;
}

$sql = 'UPDATE ' . $db->protect_identifiers($table) . ' SET ';

$ids = $when = array();
$cases = '';

//generate the WHEN statements from the set array
foreach ($set as $key => $val) {
    $ids[] = $val[$index];

    foreach (array_keys($val) as $field) {
        if ($field != $index && $field != $index_update_key) {
            $when[$field][] = 'WHEN ' . $db->protect_identifiers($index) 
                            . ' = ' . $db->escape($val[$index]) . ' THEN ' . $db->escape($val[$field]);
        } elseif ($field == $index) {
            //if index should also be updated use the new value specified by index_update_key
            $when[$field][] = 'WHEN ' . $db->protect_identifiers($index) 
                            . ' = ' . $db->escape($val[$index]) . ' THEN ' . $db->escape($val[$index_update_key]);
        }
    }
}

//generate the case statements with the keys and values from the when array
foreach ($when as $k => $v) {
    $cases .= "\n" . $db->protect_identifiers($k) . ' = CASE ' . "\n";
    foreach ($v as $row) {
        $cases .= $row . "\n";
    }

    $cases .= 'ELSE ' . $k . ' END, ';
 }

 $sql .= substr($cases, 0, -2) . "\n"; //remove the comma of the last case
 $sql .= ' WHERE ' . $index . ' IN (' . implode(',', $ids) . ')';

 return $db->query($sql);
}
function MakeRange($array){
        $myArray = $array;

        //last value is dropped so add something useless to be dropped
        array_push($myArray, null);
        $rangeArray = array();

        array_walk($myArray, function($val) use (&$rangeArray){
            static $oldVal, $rangeStart;

            if (is_null($rangeStart))
                goto init;

            if ($oldVal+1 == $val) {
                $oldVal = $val;
                return;
            }

            if ($oldVal == $rangeStart) {
                array_push($rangeArray, $rangeStart);
                goto init;
            }

            array_push($rangeArray, $rangeStart . '-' . $oldVal);

            init: {
                $rangeStart = $val;
                $oldVal = $val;
            }
        });

        return $rangeArray;
    }

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function GetPic(){
    $CI = &get_instance();
    if ( ! $return = $CI->cache->get('picOnDuty')) {
        $CI->load->database();
        $return = $CI->db
                ->select('pic_name, pic_dn_1,pic_dn_2,l_responsible_group')
                ->where('t_data_pic_schedule.p_year', date('Y'))
                ->where('t_data_pic_schedule.p_month', date('m'))
                ->where('t_data_pic_schedule.p_day_'.date('j'), 1)
                ->join('t_data_pic_schedule','t_data_pic_schedule.p_pic_id=t_data_pic.id')
                ->join('t_lookup_responsible_group','t_lookup_responsible_group.id=t_data_pic.pic_resp_group_id')
                ->get('t_data_pic')->result_array();
        $CI->cache->save('picOnDuty', $return);
    }

    return $return;

}
/**
 * get sites 
 * @return array $data
 */
function get_sites(){
    $CI =& get_instance();
    $CI->load->database();
    $data = $CI->db
            ->where('is_delete',0)
            ->order_by('id_site','asc')
            ->get('sites')->result_array();
    return $data;
}

function romanic_number($integer, $upcase = true) 
{ 
    $table = array('M'=>1000, 'CM'=>900, 'D'=>500, 'CD'=>400, 'C'=>100, 'XC'=>90, 'L'=>50, 'XL'=>40, 'X'=>10, 'IX'=>9, 'V'=>5, 'IV'=>4, 'I'=>1); 
    $return = ''; 
    while($integer > 0) 
    { 
        foreach($table as $rom=>$arb) 
        { 
            if($integer >= $arb) 
            { 
                $integer -= $arb; 
                $return .= $rom; 
                break; 
            } 
        } 
    } 

    return $return; 
}
/**
 * Custom date format.
 *
 * @param string $string date
 * @param string $format format date
 *
 * @return string $return
 */
function custDateFormat($string, $format = 'Y-m-d H:i:s')
{
    $return = date($format, strtotime($string));

    return $return;
}

/**
 * Generate alert box notification with close button.
 *     style is based on bootstrap 3.
 *
 * @param string $msg          notification message
 * @param string $type         type of notofication
 * @param bool   $close_button close button
 *
 * @return string notification with html tag
 */
function alert_box($msg, $type = 'warning', $close_button = true)
{
    $html = '';
    if ($msg != '') {
        $html .= '<div class="alert alert-'.$type.' alert-dismissible" role="alert">';
        if ($close_button) {
            $html .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="ti-close"></i></button>';
        }
        $html .= $msg;
        $html .= '</div>';
    }

    return $html;
}

/**
 * Get site setting into array.
 *
 * @return array $return
 */
function get_sitesetting()
{
    $CI = &get_instance();
    $CI->load->database();
    
    $query = $CI->db
                ->select('site_setting.type, site_setting.value')
                #->where('site.id_ref_publish', 1)
                ->where('site.is_delete', 0)
                ->where('site.is_default', 1)
                ->join('site', 'site.id_site = site_setting.id_site', 'left')
                ->order_by('site_setting.id_site', 'asc')
                ->get('site_setting')->result_array();

    foreach ($query as $row => $val) {
        $return[$val['type']] = $val['value'];
    }
    return $return;
}

/**
 * Get current controller value.
 *
 * @param string $param
 *
 * @return string current controller url
 */
function current_controller($param = '')
{
    $param = '/'.$param;
    $CI    = &get_instance();
    $dir   = $CI->router->directory;
    $class = $CI->router->fetch_class();

    return base_url().$dir.$class.$param;
}

/**
 * Encrypt string to md5 value.
 *
 * @param string $string
 *
 * @return string encryption string
 */
function md5plus($string)
{
    $CI = &get_instance();

    return '_'.md5($CI->session->encryption_key.$string);
}

/**
 * Generate new token.
 *
 * @return string $code
 */
function generate_token()
{
    $rand          = md5(sha1('reg'.date('Y-m-d H:i:s')));
    $acceptedChars = 'abcdefghijklmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789';
    $max           = strlen($acceptedChars) - 1;
    $tmp_code      = null;
    for ($i = 0; $i < 8; $i++) {
        $tmp_code .= $acceptedChars{mt_rand(0, $max)};
    }
    $code = $rand.$tmp_code;

    return $code;
}

/**
 * Generate random code.
 *
 * @param int $loop
 *
 * @return string $code
 */
function random_code($loop = 5)
{
    $acceptedChars = 'abcdefghijklmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789';
    $max           = strlen($acceptedChars) - 1;
    $tmp_code      = null;
    for ($i = 0; $i < $loop; $i++) {
        $tmp_code .= $acceptedChars{mt_rand(0, $max)};
    }
    $code = $tmp_code;

    return $code;
}

/**
 * Generate random number.
 *
 * @param int $loop
 *
 * @return string $code
 */
function random_number($loop = 3)
{
    $acceptedChars = '23456789';
    $max           = strlen($acceptedChars) - 1;
    $tmp_code      = null;
    for ($i = 0; $i < $loop; $i++) {
        $tmp_code .= $acceptedChars{mt_rand(0, $max)};
    }
    $code = $tmp_code;

    return $code;
}
function getAdminLoginGroupName(){
    $CI   = &get_instance();
    $data = false;
    $user = getAdminLoggedInfo();
    if(isset($_SESSION['ADM_SESS']) && $_SESSION['ADM_SESS'] != ''){
        $CI->load->database();
        $data = $CI->db
                //->select('id_auth_user')
                ->where('id_auth_group', $user['f_grouprole'])
                ->limit(1)
                ->get('auth_group')
                ->row_array();
        if($data){
            return $data['auth_group'];
        }
        return false;
    }
}
/**
 * Get admin logged info by email session.
 *
 * @return array|bool $data
 */
function getAdminLoggedInfo()
{
    $CI   = &get_instance();
    $data = false;
    $CI->load->library('session');
    if (isset($_SESSION['ADM_SESS']) && $_SESSION['ADM_SESS'] != '') {
        $ADM_SESS  = $_SESSION['ADM_SESS'];
        $adm_email = $ADM_SESS['admin_email'];
        $CI->load->database();
        $data = $CI->db
                //->select('id_auth_user')
                ->where('LCASE(f_mail)', strtolower($adm_email))
                ->limit(1)
                ->join('master_employee b','b.userid=a.id','LEFT')
                ->get('t_data_user a')
                ->row_array();
    }

    return $data;
}

/**
 * Retrieve auth user id from session.
 *
 * @return int|bool $data admin user id
 */
function id_auth_user()
{
    $CI = &get_instance();
    $CI->load->library('session');
    if ($CI->session->ADM_SESS == '') {
        return false;
    }
    $ADM_SESS = $CI->session->ADM_SESS;
    $sess = $ADM_SESS['admin_email'];
    $CI->load->database();
    $data = getAdminLoggedInfo();
    if ($data) {
        return $data['id'];
    }

    return false;
}

/**
 * Retrieve auth user id from session.
 *
 * @return int|bool $data admin user id
 */
function employeeid()
{
    $CI = &get_instance();
    $CI->load->library('session');
    if ($CI->session->ADM_SESS == '') {
        return false;
    }
    $ADM_SESS = $CI->session->ADM_SESS;
    $sess = $ADM_SESS['admin_email'];
    $CI->load->database();
    $data = getAdminLoggedInfo();
    if ($data) {
        return $data['employeeid'];
    }

    return false;
}

/**
 * Check user if super admin.
 *
 * @return bool
 */
function is_superadmin()
{
    $CI = &get_instance();
    $CI->load->library('session');
    if ($CI->session->ADM_SESS == '') {
        return false;
    }
    $data = getAdminLoggedInfo();
    if (isset($data['is_superadmin']) && $data['is_superadmin'] == 1) {
        return true;
    }

    return false;
}

/**
 * Retrieve session of admin user group id.
 *
 * @return int|bool $data admin user group id
 */
function id_auth_group()
{
    $CI = &get_instance();
    $CI->load->library('session');
    if ($CI->session->ADM_SESS == '') {
        return '0';
    }

    $data = getAdminLoggedInfo();

    return $data['f_grouprole'];
}

/**
 * Get active themes.
 *
 * @param string $default default themes
 * 
 * @return string $return themes
 */
function getActiveThemes($default = 'gentelella')
{
    $user = getAdminLoggedInfo();
    $return = ($user) ? $user['themes'] : $default;

    return $return;
}

/**
 * Clear browser cache.
 * 
 */
function clear_cache()
{
    $CI = &get_instance();
    $CI->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0');
    $CI->output->set_header('Pragma: no-cache');
}

/**
 * Remove recursive directory.
 *
 * @param string $dir
 */
function remove_recursive_directory($dir)
{
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != '.' && $object != '..') {
                if (filetype($dir.'/'.$object) == 'dir') {
                    rrmdir($dir.'/'.$object);
                } else {
                    unlink($dir.'/'.$object);
                }
            }
        }
        reset($objects);
        rmdir($dir);
    }
}

/**
 * Retrieve field value of table.
 *
 * @param string $field field of table
 * @param string $table table name
 * @param string $where condition of query
 *
 * @return string $val value
 */
function get_value($field, $table, $where)
{
    // load ci instance
    $CI = &get_instance();
    $CI->load->database();

    $val = '';
    $sql = 'SELECT '.$field.' FROM '.$table.' WHERE '.$where;
    $query = $CI->db->query($sql);
    foreach ($query->result_array() as $r) {
        $val = $r[$field];
    }

    return $val;
}

function get_price($where){
    $CI = &get_instance();
    $CI->load->database();

    $val = '';
    $sql = 'SELECT price FROM product_price WHERE '.$where;
    #echo $CI->db->last_query();
    $query = $CI->db->query($sql);
    /*foreach ($query->result_array() as $r) {
        $val = $r[$field];
    }
    echo debugvar($query);
    die();*/
    $val = $query->row_array();
    return $val[$field];
}

/**
 * Retrieve setting value by key.
 *
 * @param string $config_key field key
 * @param int $id_site (optional) site id
 *
 * @return string $val value
 */
function get_setting($config_key = '', $id_site = 1)
{
    // load ci instance
    $CI = &get_instance();
    $CI->load->database();
    $val = '';
    if ($config_key != '') {
        $CI->db->where('type', $config_key);
    }
    $query = $CI->db
        ->where('id_site', $id_site)
        ->get('setting');

    if ($query->num_rows() > 1) {
        $val = $query->result_array();
    } elseif ($query->num_rows() == 1) {
        $row = $query->row_array();
        $val = $row['value'];
    }

    return $val;
}

/**
 * Retrieve site info by id site.
 *
 * @param int $id_site (optional) site id
 *
 * @return string $return
 */
function get_site_info($id_site = 1)
{
    // load ci instance
    $CI = &get_instance();
    if ( ! $return = $CI->cache->get('siteInfo')) {
        $CI->load->database();

        $return = $CI->db
                ->where('id_site', $id_site)
                ->limit(1)
                ->order_by('id_site', 'desc')
                ->get('site')->row_array();
        $CI->cache->save('siteInfo', $return);
    }

    return $return;
}

/**
 * Retrieve menu admin title.
 *
 * @param string $key key menu file, returning blank if empty/false
 *
 * @return string title value
 */
function get_admin_menu_title($key)
{
    // load ci instance
    $CI = &get_instance();
    $CI->load->database();

    $query = $CI->db
        ->where('LCASE(file)', strtolower($key))
        ->limit(1)
        ->order_by('id_auth_menu', 'desc')
        ->get('auth_menu');

    if ($query->num_rows() > 0) {
        $row = $query->row_array();

        return $row['menu'];
    }

    return '';
}

/**
 * Retrieve menu admin id.
 *
 * @param string $key key menu file, returning blank if empty/false
 *
 * @return int id menu value
 */
function get_admin_menu_id($key)
{
    // load ci instance
    $CI = &get_instance();
    $CI->load->database();

    $query = $CI->db
        ->where('LCASE(file)', strtolower($key))
        ->limit(1)
        ->order_by('id_auth_menu', 'desc')
        ->get('auth_menu');

    if ($query->num_rows() > 0) {
        $row = $query->row_array();

        return $row['id_auth_menu'];
    }

    return '0';
}

/**
 * Insert log user activity to database.
 *
 * @param array $data data to insert
 */
function insert_to_log($data)
{
    // load ci instance
    $CI = &get_instance();
    $CI->load->database();
    $data = array_merge($data, ['ip_address' => get_client_ip()]);
    $CI->db->insert('logs', $data);
}

/**
 * Check page requested by ajax.
 *
 * @return bool
 */
function is_ajax_requested()
{
    /* AJAX check  */
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        return true;
    }

    return false;
}

/**
 * Enconding url characters.
 *
 * @param string $string value to encode
 *
 * @return string encoded string value
 */
function myUrlEncode($string)
{
    $entities = [' ', '!', '*', "'", '(', ')', ';', ':', '@', '&', '=', '+', '$', ',', '/', '?', '[', ']', '(', ')'];
    $replacements = ['%20', '%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%5B', '%5D', '&#40;', '&#41;'];

    return str_replace($entities, $replacements, $string);
}

/**
 * Decoding url characters.
 *
 * @param string $string value to decode
 *
 * @return string decoded string value
 */
function myUrlDecode($string)
{
    $entities = ['%20', '%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%5B', '%5D', '&#40;', '&#41;'];
    $replacements = [' ', '!', '*', "'", '(', ')', ';', ':', '@', '&', '=', '+', '$', ',', '/', '?', '[', ']', '(', ')'];

    return str_replace($entities, $replacements, $string);
}

/**
 * Form validation : check characters only alpha, numeric, dash.
 *
 * @param string $str
 *
 * @return bool
 */
function mycheck_alphadash($str)
{
    if (preg_match('/^[a-z0-9_-]+$/i', $str)) {
        return true;
    }

    return false;
}

/**
 * Form validation : check iso date.
 *
 * @param string $str
 *
 * @return bool true/false
 */
function mycheck_isodate($str)
{
    if (preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $str)) {
        return true;
    }

    return false;
}

/**
 * Form validation : check email.
 * 
 * @param string $str value to check
 *
 * @return bool true or false
 */
function mycheck_email($str)
{
    $str = strtolower($str);

    return preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $str);
}

/**
 * Form validation : check phone number.
 *
 * @param string $string
 *
 * @return bool
 */
function mycheck_phone($string)
{
    if (preg_match('/^[+]?([\d]{0,3})?[\(\.\-\s]?([\d]{3})[\)\.\-\s]*([\d]{3})[\.\-\s]?([\d]{4})$/', $string)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Convert number/decimal to default price
 * 
 * @param string $string
 * @param int    $decimal
 * @param string $thousands_sep
 * @param string $dec_point
 *
 * @return string price format
 */
function myprice($string, $decimal = 0, $thousands_sep = '.', $dec_point = ',')
{
    return number_format($string, $decimal, $dec_point, $thousands_sep);
}

/**
 * Clean data from xss.
 *
 * @return string $return clean data from xss
 */
function xss_clean_data($string)
{
    $CI = &get_instance();
    $return = $CI->security->xss_clean($string);

    return $return;
}

/**
 * Check validation file size of upload file.
 *
 * @param array|object|string $str file to check
 * @param int $max_size (optional) set maximum of file size, default is 4 MB
 *
 * @return bool
 */
function check_file_size($str, $max_size = 0)
{
    if ( ! $max_size) {
        $max_size = IMG_UPLOAD_MAX_SIZE;
    }
    $file_size = $str['size'];
    if ($file_size > $max_size) {
        return false;
    }

    return true;
}

/**
 * Get mime upload file.
 *
 * @param string|array|object $source file to check
 *
 * @return string|bool mime type
 */
function check_mime_type($source)
{
    $mime_types = [
        // images
        'png'  => 'image/png',
        'jpe'  => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'jpg'  => 'image/jpeg',
        'gif'  => 'image/gif',
        'bmp'  => 'image/bmp',
        'ico'  => 'image/vnd.microsoft.icon',
        'tiff' => 'image/tiff',
        'tif'  => 'image/tiff',
        'svg'  => 'image/svg+xml',
        'svgz' => 'image/svg+xml',
        // adobe
        'pdf' => 'application/pdf',
        // ms office
        'doc'  => 'application/msword',
        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'rtf'  => 'application/rtf',
        'xls'  => 'application/vnd.ms-excel',
        'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'ppt'  => 'application/vnd.ms-powerpoint',
        // open office
        'odt' => 'application/vnd.oasis.opendocument.text',
        'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
    ];
    $arrext = explode('.', $source['name']);
    $jml = count($arrext) - 1;
    $ext = $arrext[$jml];
    $ext = strtolower($ext);

    //$ext = strtolower(array_pop(explode(".", $source['name'])));
    if (array_key_exists($ext, $mime_types)) {

        return $mime_types[$ext];
    } elseif (function_exists('finfo_open')) {
        $finfo = finfo_open(FILEINFO_MIME);
        $mimetype = finfo_file($finfo, $source['tmp_name']);
        finfo_close($finfo);

        return $mimetype;
    }

    return false;
}

/**
 * Check validation of image type.
 *
 * @param string|object|array $source_pic file to check
 *
 * @return bool
 */
function check_image_type($source_pic)
{
    $image_info = check_mime_type($source_pic);
    
    // allowed type of image
    $allowed_type = array(
        'image/gif',
        'image/jpeg',
        'image/png',
        'image/wbmp',
    );
    
    if ($image_info && in_array($image_info, $allowed_type)) {
        return true;
    }

    return false;
}

/**
 * check validation of file type.
 *
 * @author alfian purnomo
 *
 * @param $source string file to check
 *
 * @return true or false
 */
function check_file_type($source)
{
    $file_info = check_mime_type($source);
    // allowed type of file
    $allowed_type = [
        'image/gif',
        'image/jpeg',
        'image/png',
        'image/wbmp',
        'application/pdf',
        'application/msword',
        'application/rtf',
        'application/vnd.ms-excel',
        'application/vnd.ms-powerpoint',
        'application/vnd.oasis.opendocument.text',
        'application/vnd.oasis.opendocument.spreadsheet',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    ];

    if ($file_info && in_array($allowed_type, $file_info)) {
        return true;
    }

    return false;
}

/**
 * Validate upload image
 *
 * @param string $fieldname fieldname of input file form
 *
 * @return string $error
 */
function validatePicture($fieldname)
{
    $error = '';
    if (!empty($_FILES[$fieldname]['error'])) {
        switch ($_FILES[$fieldname]['error']) {
            case '1':
                $error = 'Upload maximum file is '.number_format(IMG_UPLOAD_MAX_SIZE / 1024, 2).' MB.';
                break;
            case '2':
                $error = 'File is too big, please upload with smaller size.';
                break;
            case '3':
                $error = 'File uploaded, but only halef of file.';
                break;
            case '4':
                $error = 'There is no File to upload';
                break;
            case '6':
                $error = 'Temporary folder not exists, Please try again.';
                break;
            case '7':
                $error = 'Failed to record File into disk.';
                break;
            case '8':
                $error = 'Upload file has been stop by extension.';
                break;
            case '999':
            default:
                $error = 'No error code avaiable';
        }
    } elseif (empty($_FILES[$fieldname]['tmp_name']) || $_FILES[$fieldname]['tmp_name'] == 'none') {
        $error = 'There is no File to upload.';
    } elseif ($_FILES[$fieldname]['size'] > IMG_UPLOAD_MAX_SIZE) {
        $error = 'Upload maximum file is '.number_format(IMG_UPLOAD_MAX_SIZE / 1024, 2).' MB.';
    } else {
        $cekfileformat = check_image_type($_FILES[$fieldname]);
        if ( ! $cekfileformat) {
            $error = 'Upload Picture only allow (jpg, gif, png)';
        }
    }

    return $error;
}

/**
 * Validation for file upload from form
 *
 * @param string $fieldname fieldname of input file form
 *
 * @return string $error
 */
function validateFile($fieldname)
{
    $error = '';
    if (!empty($_FILES[$fieldname]['error'])) {
        switch ($_FILES[$fieldname]['error']) {
            case '1':
                $error = 'Upload maximum file is 4 MB.';
                break;
            case '2':
                $error = 'File is too big, please upload with smaller size.';
                break;
            case '3':
                $error = 'File uploaded, but only halef of file.';
                break;
            case '4':
                $error = 'There is no File to upload';
                break;
            case '6':
                $error = 'Temporary folder not exists, Please try again.';
                break;
            case '7':
                $error = 'Failed to record File into disk.';
                break;
            case '8':
                $error = 'Upload file has been stop by extension.';
                break;
            case '999':
            default:
                $error = 'No error code avaiable';
        }
    } elseif (empty($_FILES[$fieldname]['tmp_name']) || $_FILES[$fieldname]['tmp_name'] == 'none') {
        $error = 'There is no File to upload.';
    } elseif ($_FILES[$fieldname]['size'] > FILE_UPLOAD_MAX_SIZE) {
        $error = 'Upload maximum file is '.number_format(FILE_UPLOAD_MAX_SIZE / 1024, 2).' MB.';
    } else {
        //$get_ext = substr($_FILES[$fieldname]['name'],strlen($_FILES[$fieldname]['name'])-3,3);
        $cekfileformat = check_file_type($_FILES[$fieldname]);
        if ( ! $cekfileformat) {
            $error = 'Upload File only allow (jpg, gif, png, pdf, doc, xls, xlsx, docx)';
        }
    }

    return $error;
}

/**
 * Debug variable.
 *
 * @param mixed $datadebug data to debug
 *
 * @return string print debug data
 */
function debugvar($datadebug)
{
    echo '<pre>';
    print_r($datadebug);
    echo '</pre>';
}

/**
 * Set number to rupiah format.
 *
 * @param string $angka number to change format
 *
 * @return string $rupiah number format idr
 */
function rupiah($angka)
{
    $rupiah = '';
    $rp = strlen($angka);
    while ($rp > 3) {
        $rupiah = '.'.substr($angka, -3).$rupiah;
        $s = strlen($angka) - 3;
        $angka = substr($angka, 0, $s);
        $rp = strlen($angka);
    }
    $rupiah = 'Rp. '.$angka.$rupiah.',-';

    return $rupiah;
}

/**
 * Upload file to destination folder, return file name.
 *
 * @param array|object $source_file source file
 * @param string $destination_folder destination upload folder
 * @param sreing $filename file name
 *
 * @return string $ret filename
 */
function file_copy_to_folder($source_file, $destination_folder, $filename)
{
	ini_set("display_errors", "1");
  	error_reporting(E_ALL);
// 	
	// print_r($source_file);
	//echo $destination_folder;
    #die();
    $arrext = explode('.', $source_file['name']);
    $jml = count($arrext) - 1;
    $ext = $arrext[$jml];
    $ext = strtolower($ext);
    $ret = false;
    if (!is_dir($destination_folder)) {
        mkdir($destination_folder, 0755);

    }
	
    $destination_folder .= $filename.'.'.$ext;
	// exit($destination_folder);
    
    if (@move_uploaded_file($source_file['tmp_name'], $destination_folder)) {
        $ret = $filename.'.'.$ext;
    }
    // echo $ret;
	// die();
    return $ret;
}

/**
 * Upload multiple (array) file to destination folder, return array of file name.
 *
 * @param array|object $source_file source file
 * @param string $destination_folder destination upload folder
 * @param string $filename file name
 *
 * @return string $ret filename
 */
function file_arr_copy_to_folder($source_file, $destination_folder, $filename)
{
    $tmp_destination = $destination_folder;
    $ret             = [];
    for ($index = 0; $index < count($source_file['tmp_name']); $index++) {
        $arrext             = explode('.', $source_file['name'][$index]);
        $jml                = count($arrext) - 1;
        $ext                = $arrext[$jml];
        $ext                = strtolower($ext);
        $destination_folder = $tmp_destination.$filename[$index].'.'.$ext;

        if (@move_uploaded_file($source_file['tmp_name'][$index], $destination_folder)) {
            $ret[$index] = $filename[$index].'.'.$ext;
        }
    }

    return $ret;
}

/**
 * Upload image to destination folder, return file name.
 *
 * @param array|object $source_file source file
 * @param string $destination_folder destination upload folder
 * @param string $filename file name
 * @param int $max_width maximum image width
 * @param int $max_height maximum image height
 *
 * @return string $callback_filename file name
 */
function image_resize_to_folder($source_pic, $destination_folder, $filename, $max_width, $max_height)
{
    $image_info         = getimagesize($source_pic['tmp_name']);
    $source_pic_name    = $source_pic['name'];
    $source_pic_tmpname = $source_pic['tmp_name'];
    $source_pic_size    = $source_pic['size'];
    $source_pic_width   = $image_info[0];
    $source_pic_height  = $image_info[1];
    if (!is_dir($destination_folder)) {
        mkdir($destination_folder, 0755);
    }

    $x_ratio = $max_width / $source_pic_width;
    $y_ratio = $max_height / $source_pic_height;

    if (($source_pic_width <= $max_width) && ($source_pic_height <= $max_height)) {
        $tn_width  = $source_pic_width;
        $tn_height = $source_pic_height;
    } elseif (($x_ratio * $source_pic_height) < $max_height) {
        $tn_height = ceil($x_ratio * $source_pic_height);
        $tn_width  = $max_width;
    } else {
        $tn_width  = ceil($y_ratio * $source_pic_width);
        $tn_height = $max_height;
    }

    switch ($image_info['mime']) {
        case 'image/gif':
            if (imagetypes() & IMG_GIF) {
                $src = imagecreatefromgif($source_pic['tmp_name']);
                $destination_folder .= "$filename.gif";
                $callback_filename  = "$filename.gif";
            }
            break;

        case 'image/jpeg':
            if (imagetypes() & IMG_JPG) {
                $src = imagecreatefromjpeg($source_pic['tmp_name']);
                $destination_folder .= "$filename.jpg";
                $callback_filename  = "$filename.jpg";
            }
            break;

        case 'image/pjpeg':
            if (imagetypes() & IMG_JPG) {
                $src = imagecreatefromjpeg($source_pic['tmp_name']);
                $destination_folder .= "$filename.jpg";
                $callback_filename  = "$filename.jpg";
            }
            break;

        case 'image/png':
            if (imagetypes() & IMG_PNG) {
                $src = imagecreatefrompng($source_pic['tmp_name']);
                $destination_folder .= "$filename.png";
                $callback_filename  = "$filename.png";
            }
            break;

        case 'image/wbmp':
            if (imagetypes() & IMG_WBMP) {
                $src = imagecreatefromwbmp($source_pic['tmp_name']);
                $destination_folder .= "$filename.bmp";
                $callback_filename  = "$filename.bmp";
            }
            break;
    }

    //chmod($destination_pic, 0777);
    $tmp = imagecreatetruecolor($tn_width, $tn_height);
    imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tn_width, $tn_height, $source_pic_width, $source_pic_height);

    //**** 100 is the quality settings, values range from 0-100.
    switch ($image_info['mime']) {
        case 'image/jpeg':
            imagejpeg($tmp, $destination_folder, 100);
            break;

        case 'image/gif':
            imagegif($tmp, $destination_folder, 100);
            break;

        case 'image/png':
            imagepng($tmp, $destination_folder);
            break;

        default:
            imagejpeg($tmp, $destination_folder, 100);
            break;
    }

    return $callback_filename;
}

/**
 * Copy image and resize it to destination folder.
 *
 * @param string $source_file
 * @param string $destination_folder
 * @param string $filename
 * @param int $max_width
 * @param int $max_height
 * @param int $quality image quality
 * @param bool $ext get the extension
 *
 * @return string $callback_filename file name
 */
function copy_image_resize_to_folder($source_file, $destination_folder, $filename, $max_width, $max_height, $quality = 100, $ext = true)
{
    $image_info        = getimagesize($source_file);
    $source_pic_width  = $image_info[0];
    $source_pic_height = $image_info[1];

    $x_ratio = $max_width / $source_pic_width;
    $y_ratio = $max_height / $source_pic_height;

    if (($source_pic_width <= $max_width) && ($source_pic_height <= $max_height)) {
        $tn_width  = $source_pic_width;
        $tn_height = $source_pic_height;
    } elseif (($x_ratio * $source_pic_height) < $max_height) {
        $tn_height = ceil($x_ratio * $source_pic_height);
        $tn_width  = $max_width;
    } else {
        $tn_width  = ceil($y_ratio * $source_pic_width);
        $tn_height = $max_height;
    }

    if (!is_dir($destination_folder)) {
        mkdir($destination_folder, 0755);
    }

    switch ($image_info['mime']) {
        case 'image/gif':
            if (imagetypes() & IMG_GIF) {
                $src = imagecreatefromgif($source_file);
                $destination_folder .= ($ext == true) ? $filename .'.gif' : $filename;
                $callback_filename  = ($ext == true) ? $filename .'.gif' : $filename;
            }
            break;

        case 'image/jpeg':
            if (imagetypes() & IMG_JPG) {
                $src = imagecreatefromjpeg($source_file);
                $destination_folder .= ($ext == true) ? $filename .'.jpg' : $filename;
                $callback_filename  = ($ext == true) ? $filename .".jpg" : $filename;
            }
            break;

        case 'image/pjpeg':
            if (imagetypes() & IMG_JPG) {
                $src = imagecreatefromjpeg($source_file);
                $destination_folder .= ($ext == true) ? $filename .'.jpg' : $filename;
                $callback_filename  = ($ext == true) ? $filename .".jpg" : $filename;
            }
            break;

        case 'image/png':
            if (imagetypes() & IMG_PNG) {
                $src = imagecreatefrompng($source_file);
                $destination_folder .= ($ext == true) ? $filename .'.png' : $filename;
                $callback_filename  = ($ext == true) ? $filename .".png" : $filename;
            }
            break;

        case 'image/wbmp':
            if (imagetypes() & IMG_WBMP) {
                $src = imagecreatefromwbmp($source_file);
                $destination_folder .= ($ext == true) ? $filename .'.bmp' : $filename;
                $callback_filename  = ($ext == true) ? $filename .".bmp" : $filename;
            }
            break;
    }

    $tmp = imagecreatetruecolor($tn_width, $tn_height);
    imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tn_width, $tn_height, $source_pic_width, $source_pic_height);

    //**** 100 is the quality settings, values range from 0-100.
    switch ($image_info['mime']) {
        case 'image/jpeg':
            imagejpeg($tmp, $destination_folder, $quality);
            break;

        case 'image/gif':
            imagegif($tmp, $destination_folder, $quality);
            break;

        case 'image/png':
            imagepng($tmp, $destination_folder);
            break;

        default:
            imagejpeg($tmp, $destination_folder, $quality);
            break;
    }

    return $callback_filename;
}

/**
 * Move file to folder.
 *
 * @param string $source_file
 * @param string $destination_folder
 * @param string $filename
 *
 * @return string $ret file name
 */
function move_file_to_folder($source_file, $destination_folder, $filename)
{
    $arrext = explode('.', $source_file);
    $jml    = count($arrext) - 1;
    $ext    = $arrext[$jml];
    $ext    = strtolower($ext);
    $ret    = false;
    if (!is_dir($destination_folder)) {
        mkdir($destination_folder, 0755);
    }
    $destination_folder .= $filename.'.'.$ext;

    if (rename($source_file, $destination_folder)) {
        $ret = $filename.'.'.$ext;
    }

    return $ret;
}

/**
 * Upload image (array) to destination folder, return file name.
 *
 * @param array|object $source_pic source file
 * @param string $destination_folder destination upload folder
 * @param string $filename file name
 * @param int $max_width maximum image width
 * @param int $max_height maximum image height
 *
 * @return array|string $return file name
 */
function image_arr_resize_to_folder($source_pic, $destination_folder, $filename, $max_width, $max_height)
{
    $tmp_dest = $destination_folder;
    $return   = [];
    for ($index = 0; $index < count($source_pic['tmp_name']); $index++) {
        $destination_folder = $tmp_dest;
        $image_info         = getimagesize($source_pic['tmp_name'][$index]);
        $source_pic_name    = $source_pic['name'][$index];
        $source_pic_tmpname = $source_pic['tmp_name'][$index];
        $source_pic_size    = $source_pic['size'][$index];
        $source_pic_width   = $image_info[0];
        $source_pic_height  = $image_info[1];
        $x_ratio            = $max_width / $source_pic_width;
        $y_ratio            = $max_height / $source_pic_height;

        if (($source_pic_width <= $max_width) && ($source_pic_height <= $max_height)) {
            $tn_width  = $source_pic_width;
            $tn_height = $source_pic_height;
        } elseif (($x_ratio * $source_pic_height) < $max_height) {
            $tn_height = ceil($x_ratio * $source_pic_height);
            $tn_width  = $max_width;
        } else {
            $tn_width  = ceil($y_ratio * $source_pic_width);
            $tn_height = $max_height;
        }

        switch ($image_info['mime']) {
            case 'image/gif':
                if (imagetypes() & IMG_GIF) {
                    $src                = imagecreatefromgif($source_pic['tmp_name'][$index]);
                    $destination_folder .= "$filename[$index].gif";
                    $callback_filename  = "$filename[$index].gif";
                }
                break;

            case 'image/jpeg':
                if (imagetypes() & IMG_JPG) {
                    $src                = imagecreatefromjpeg($source_pic['tmp_name'][$index]);
                    $destination_folder .= "$filename[$index].jpg";
                    $callback_filename  = "$filename[$index].jpg";
                }
                break;

            case 'image/pjpeg':
                if (imagetypes() & IMG_JPG) {
                    $src                = imagecreatefromjpeg($source_pic['tmp_name'][$index]);
                    $destination_folder .= "$filename[$index].jpg";
                    $callback_filename  = "$filename[$index].jpg";
                }
                break;

            case 'image/png':
                if (imagetypes() & IMG_PNG) {
                    $src                = imagecreatefrompng($source_pic['tmp_name'][$index]);
                    $destination_folder .= "$filename[$index].png";
                    $callback_filename  = "$filename[$index].png";
                }
                break;

            case 'image/wbmp':
                if (imagetypes() & IMG_WBMP) {
                    $src                = imagecreatefromwbmp($source_pic['tmp_name'][$index]);
                    $destination_folder .= "$filename[$index].bmp";
                    $callback_filename  = "$filename[$index].bmp";
                }
                break;
        }

        //chmod($destination_pic,0777);
        $tmp = imagecreatetruecolor($tn_width, $tn_height);
        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tn_width, $tn_height, $source_pic_width, $source_pic_height);

        //**** 100 is the quality settings, values range from 0-100.
        switch ($image_info['mime']) {
            case 'image/jpeg':
                imagejpeg($tmp, $destination_folder, 100);
                break;

            case 'image/gif':
                imagegif($tmp, $destination_folder, 100);
                break;

            case 'image/png':
                imagepng($tmp, $destination_folder);
                break;

            default:
                imagejpeg($tmp, $destination_folder, 100);
                break;
        }
        $return[] = $callback_filename;
    }

    return $return;
}

/**
 * Crop image.
 *
 * @param string|int $nw new width
 * @param string|int $nh new height
 * @param string $source source file
 * @param string $dest destination folder
 */
function cropImage($nw, $nh, $source, $dest)
{
    $image_info = getimagesize($source);
    $w          = $image_info[0];
    $h          = $image_info[1];

    switch ($image_info['mime']) {
        case 'image/gif':
            $simg = imagecreatefromgif($source);
            break;
        case 'image/jpeg':
            $simg = imagecreatefromjpeg($source);
            break;
        case 'image/pjpeg':
            $simg = imagecreatefromjpeg($source);
            break;
        case 'png':
            $simg = imagecreatefrompng($source);
            break;
    }

    $dimg     = imagecreatetruecolor($nw, $nh);
    $wm       = $w / $nw;
    $hm       = $h / $nh;
    $h_height = $nh / 2;
    $w_height = $nw / 2;

    if ($w > $h) {
        $adjusted_width = $w / $hm;
        $half_width     = $adjusted_width / 2;
        $int_width      = $half_width - $w_height;

        imagecopyresampled($dimg, $simg, -$int_width, 0, 0, 0, $adjusted_width, $nh, $w, $h);
    } elseif (($w < $h) || ($w == $h)) {
        $adjusted_height = $h / $wm;
        $half_height     = $adjusted_height / 2;
        $int_height      = $half_height - $h_height;

        imagecopyresampled($dimg, $simg, 0, -$int_height, 0, 0, $nw, $adjusted_height, $w, $h);
    } else {
        imagecopyresampled($dimg, $simg, 0, 0, 0, 0, $nw, $nh, $w, $h);
    }
    imagejpeg($dimg, $dest, 100);
}

/**
 * Get option list.
 *
 * @param array $options
 * @param string|int $selected
 * @param string $type
 * @param string $name
 *
 * @return string $temp_list list
 */
function getOptions($options = [], $selected = '', $type = 'option', $name = 'option_list')
{
    $tmp_list = '';
    for ($a = 0; $a < count($options); $a++) {
        $set_select = '';
        if ($selected == $options[$a]) {
            $set_select = 'selected="selected"';
        }

        if ($type == 'option') {
            $tmp_list .= '<option value="'.$options[$a].'" '.$set_select.'>'.$options[$a].'</option>';
        } else {
            $tmp_list .= '<label for="opt-'.$a.'" class="'.$type.'"><input name="'.$name.'" id="opt-'.$a.'" value="'.$options[$a].'" type="'.$type.'"/>'.$options[$a].'&nbsp; </label>';
        }
    }

    return $tmp_list;
}

/**
 * Get languange text by key.
 *
 * @param string $key
 *
 * @return string text language
 */
function get_lang_key($key)
{
    $CI = &get_instance();

    return $CI->lang->line($key);
}

/**
 * Simple bug fix for array_keys when returning key is 0.
 *
 * @param string $needle
 * @param array $haystack
 * 
 * @return int|bool $current_key key of array or false
 */
function recursive_array_search($needle, $haystack)
{
    foreach ($haystack as $key => $value) {
        $current_key = $key;
        if ($needle === $value or (is_array($value) && recursive_array_search($needle, $value) !== false)) {
            return $current_key;
        }
    }

    return false;
}

/**
 * Check exists uri path.
 *
 * @param string $table
 * @param string $path
 * @param int    $id
 *
 * @return bool true/false
 */
function check_exist_uri($table, $path, $id = 0)
{
    $CI = &get_instance();
    $CI->load->database();
    if ($id) {
        $field = ($table == 'pages') ? 'page' : $table;
        $CI->db->where('id_'.$field.' !=', $id);
    }
    $exists = $CI->db
            ->from($table)
            ->where('LCASE(uri_path)', strtolower($path))
            ->count_all_results();

    if ($exists > 0) {
        // if exists return false
        return false;
    }

    return true;
}

/**
 * Check exists value in db.
 *
 * @param string $table
 * @param string $field
 * @param string $value
 * @param int    $id
 *
 * @return bool true/false
 */
function check_exist_value($table, $field, $value, $id = 0)
{
    $CI = &get_instance();
    $CI->load->database();
    if ($id) {
        $CI->db->where('id_'.$table.' !=', $id);
    }
    $exists = $CI->db
            ->from($table)
            ->where("LCASE({$field})", strtolower($value))
            ->count_all_results();
    if ($exists > 0) {
        // if exists return false
        return false;
    }

    return true;
}

/**
 * Generate Password.
 *
 * @param string $value password
 *
 * @return string $hash hashed password
 */
function generate_password($value)
{
    $CI = &get_instance();
    // A higher "cost" is more secure but consumes more processing power
    $cost = 12;

    // Create a random salt
    $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM).$CI->config->item('encryption_key')), '+', '.');

    // Prefix information about the hash so PHP knows how to verify it later.
    // "$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter.
    $salt = sprintf('$2a$%02d$', $cost).$salt;

    $hash = crypt($value, $salt);

    return $hash;
}

/**
 * Validate a password.
 *
 * @param string $password
 * @param string $hash
 *
 * @return bool true/false
 */
function validate_password($password, $hash)
{
    if (hash_equals($hash, crypt($password, $hash))) {
        // return valid!
        return true;
    }

    return false;
}
/**
 * Print Json with header.
 *
 * @param array $params parameters
 *
 * @return string encoded json
 */
function json_exit($params)
{
    header('Content-type: application/json');
    exit(
        json_encode($params)
    );
}

/**
 * Customize sending email using default library
 * 
 * @param mixed $from
 * @param mixed $to
 * @param string $subject
 * @param string $body
 * @param mixed $attachment
 * @param string $method
 * 
 */
function custom_send_email_ci($from, $to, $cc,$subject, $body, $attachment = '', $method = 'smtp') 
{
    $CI = &get_instance();
    $CI->load->library('email');
    $config['mailtype'] = 'html';
    $config['useragent'] = '';
    // smtp
    if ($method == 'smtp') {
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = "139.0.29.133"; 
        /* $config['protocol'] = 'smtp';
        $config['smtp_host'] = "smtp2.bigtv.co.id"; 
        $config['smtp_user'] = "bramadhanus";
        $config['smtp_pass'] = "123456Br"; */
        $config['smtp_port'] = 587;
    }
    $CI->email->initialize($config);
    if (is_array($from)) {
        $CI->email->from($from[0]['email'], $from[0]['name']);
    } else {
        $CI->email->from($from);
    }
    if (is_array($to)) {
        foreach ($to as $key => $email_to) {
            $CI->email->to($email_to['email']);
        }
    } else {
        $CI->email->to($to);
    }
    if(isset($cc)){
        $CI->email->cc($cc);    
    }
    
    if ($attachment != '') {
        $CI->email->attach($attachment);
    }
    //$CI->email->bcc('only.ccbcc@gmail.com');
    $CI->email->subject($subject);
    $CI->email->message($body);
    /*$CI->email->send();*/
    if($CI->email->send()){
        echo 'yesy';
    }else{
        debugvar($CI->email->print_debugger());
    }
    die();
    log_message('info', $CI->email->print_debugger());
    $CI->email->clear(TRUE);
}

/**
 * Get the client IP address.
 * 
 * @return string $ipaddress
 */
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function sort_by_cluster($a, $b){
    return strcmp($a['cluster'] , $b['cluster']);
}
function cmp($a, $b) {
        $a_tot = 0;
        $a_tot += (($a['pf_bts_status']['problem'] == 'YES') ? 20 : 0);
        $a_tot += (($a['pf_bts_power']['problem'] == 'YES') ? 10 : 0);
        $a_tot += (($a['pf_svcdrop']['problem'] == 'YES') ? 7 : 0);
        $a_tot += (($a['pf_rrc']['problem'] == 'YES') ? 5 : 0);
        $a_tot += (($a['pf_erab']['problem'] == 'YES') ? 3 : 0);
        $a_tot += (($a['pf_ho']['problem'] == 'YES') ? 2 : 0);
        $a_tot += (($a['pf_prb']['problem'] == 'YES') ? 1 : 0);
        
        $b_tot = 0;
        $b_tot += (($b['pf_bts_status']['problem'] == 'YES') ? 20 : 0);
        $b_tot += (($b['pf_bts_power']['problem'] == 'YES') ? 10 : 0);
        $b_tot += (($b['pf_svcdrop']['problem'] == 'YES') ? 7 : 0);
        $b_tot += (($b['pf_rrc']['problem'] == 'YES') ? 5 : 0);
        $b_tot += (($b['pf_erab']['problem'] == 'YES') ? 3 : 0);
        $b_tot += (($b['pf_ho']['problem'] == 'YES') ? 2 : 0);
        $b_tot += (($b['pf_prb']['problem'] == 'YES') ? 1 : 0);
        
        if ($a_tot == $b_tot) {
            return 0;
        }
        return ($a_tot > $b_tot) ? -1 : 1;
    }

function rangeTime($start,$end,$increasment='+60 minutes'){
    

    return $data;
}

function list_color($key){
    $list_color = ['#0000FF','#8A2BE2','#A52A2A','#DEB887','#5F9EA0','#7FFF00','#D2691E','#FF7F50','#6495ED','#00FFFF','#DC143C','#8B0000','#E9967A','#8FBC8F','#1E90FF','#228B22','#FF00FF'];

    return $list_color[$key];
}

function get_variant_type(){
    $CI = &get_instance();
    $CI->load->database();
    
    $data = $CI->db->get('product_varian_type')->result_array();

    return $data;
}

function get_type_customer_active(){
    $CI = &get_instance();
    $CI->load->database();
    
    $data = $CI->db->where('status',1)->get('customer_type')->result_array();

    return $data;
}

function generateApprovalButton($data_approval,$id_user_login){
    $html = '';
    $col = (count($data_approval)>1) ? 12 / count($data_approval) : 12;
    foreach ($data_approval as $key => $value) {
        $level = ($value['lvl']!=4)?$value['lvl']:'Finance';
        if($key==0){
            if($value['user_id']==$id_user_login){
                if($value['approval_code'] =='00'){
                    $action = '<a data-id-user="'.$value['user_id'].'" data-transaction-no="'.$value['Transaction_no'].'" data-lvl="'.$value['lvl'].'" data-status="01" class="approve btn btn-success">Approve This Doc</a>
                        <br>
                        <a data-id-user="'.$value['user_id'].'" data-transaction-no="'.$value['Transaction_no'].'" data-lvl="'.$value['lvl'].'" data-status="02" class="approve btn btn-danger">Reject This Doc</a>';
                }else if($value['approval_code'] =='01'){
                    $action = 'Approved
                                <br>'.date('d M Y',strtotime($value['approval_date']));
                }else{
                    $action = 'Rejected
                                <br>'.date('d M Y',strtotime($value['approval_date'])).'<br>'.$value['remark'];
                }
                $html .= '<div class="col-md-'.$col.'">
                            <center>
                                <h5>Approval '.$level.'</h5>
                            </center>
                            <center>
                                <label>'.$value['user_name'].'</label>
                                <div class="approve_date">
                                    '.$action.'
                                </div>
                            </center>   
                        </div>';
            }else{
                if($value['approval_code'] =='00'){
                    $action = 'Not Approved';
                }else if($value['approval_code'] =='01'){
                    $action = 'Approved
                                <br>'.date('d M Y',strtotime($value['approval_date']));
                }else{
                    $action = 'Rejected
                                <br>'.date('d M Y',strtotime($value['approval_date'])).'<br>'.$value['remark'];
                }
                $html .= '<div class="col-md-'.$col.'">
                            <center>
                                <h5>Approval '.$level.'</h5>
                            </center>
                            <center>
                                <label>'.$value['user_name'].'</label>
                                <div class="approve_date">
                                    '.$action.'
                                </div>
                            </center>   
                        </div>';
            }
        }else{
            if($value['user_id']==$id_user_login){

                if($data_approval[$key-1]['approval_code']=='01'){
                    
                    if($value['approval_code'] =='00'){
                        $action = '<a data-id-user="'.$value['user_id'].'" data-transaction-no="'.$value['Transaction_no'].'" data-lvl="'.$value['lvl'].'" data-status="01" class="approve btn btn-success">Approve This Doc</a>
                            <br>
                            <a data-id-user="'.$value['user_id'].'" data-transaction-no="'.$value['Transaction_no'].'" data-lvl="'.$value['lvl'].'" data-status="02" class="approve btn btn-danger">Reject This Doc</a>';
                    }else if($value['approval_code'] =='01'){
                        $action = 'Approved
                                    <br>'.date('d M Y',strtotime($value['approval_date']));
                    }else{
                        $action = 'Rejected
                                    <br>'.date('d M Y',strtotime($value['approval_date'])).'<br>'.$value['remark'];
                    }
                }else{
                    if($value['approval_code'] =='00'){
                        $action = 'Need Previous Approval';
                    }else if($value['approval_code'] =='01'){
                        $action = 'Approved
                                    <br>'.date('d M Y',strtotime($value['approval_date']));
                    }else{
                        $action = 'Rejected
                                    <br>'.date('d M Y',strtotime($value['approval_date'])).'<br>'.$value['remark'];
                    }
                }
                
                $html .= '<div class="col-md-'.$col.'">
                            <center>
                                <h5>Approval '.$level.'</h5>
                            </center>
                            <center>
                                <label>'.$value['user_name'].'</label>
                                <div class="approve_date">
                                    '.$action.'
                                </div>
                            </center>   
                        </div>';
            }else{
                if($value['approval_code'] =='00'){
                    $action = 'Not Approved';
                }else if($value['approval_code'] =='01'){
                    $action = 'Approved
                                <br>'.date('d M Y',strtotime($value['approval_date']));
                }else{
                    $action = 'Rejected
                                <br>'.date('d M Y',strtotime($value['approval_date'])).'<br>'.$value['remark'];
                }
                $html .= '<div class="col-md-'.$col.'">
                            <center>
                                <h5>Approval '.$level.'</h5>
                            </center>
                            <center>
                                <label>'.$value['user_name'].'</label>
                                <div class="approve_date">
                                    '.$action.'
                                </div>
                            </center>   
                        </div>';
            }
        }
        
        
    }
    return $html;
}
/**
 * Export data to excel/csv/txt
 * @author Alfian Purnomo
 * @param $fname nama file
 */
function export_to($fname){
    
    header("Content-type: application/force-download");
    #$fname = str_replace(' ','_',$fname);
    header ("Content-Disposition: attachment; filename=$fname");
    header("Pragma: no-cache");
    header("Expires: 0");
}

/**
 * Export data to excel/csv/txt
 * @author Alfian Purnomo
 * @param $fname nama file
 */
function export_to_xml($fname){
    header("Content-type: application/x-msdownload");
    #$fname = str_replace(' ','_',$fname);
    header ("Content-Disposition: attachment; filename=$fname");
    header("Pragma: no-cache");
    header("Expires: 0");
}
/*function show_error(){
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}*/


function number_format_ID($val)
{
	return number_format($val,2,",",".");
}

function getTypeAB(){
    //$this->layout = 'none';
    $day = date('D');
    $type = 1; //KJ
    if(strtolower($day)=='sun'){
        $type = 2;
    }
    return $type;
}

function TypeAbsen($value) {
    $CI = &get_instance();
    $CI->load->database();
    
    $getHoliday = $CI->db->where('id',1)->get('master_holiday')->row_array();

     
    $array = json_decode($getHoliday['national'],true);
    if($array[$value]['status']=='CONFIRMED'){
        $is_holiday = 1;
    }elseif(date("D",strtotime($value))==="Sun"){
        $is_holiday = 2;
    }elseif(date("D",strtotime($value))==="Sat"){
        $is_holiday = 2;
    }else{
        $is_holiday = 0;
    }

    return $is_holiday;
}

function printWeek($year=''){
    if($year){
        $year = $year;
    }else{
        $year = date('Y');
    }
    
    #$this->layout = 'none';
    $weeksPeriod = new DatePeriod(
        new DateTime("$year-W01-1"),
        new DateInterval('P1W'),
        new DateTime("$year-12-31T23:59:59Z")
    );
    $dataWeeks = [];
    foreach ($weeksPeriod as $week => $monday) {

        $daysPeriod   = new DatePeriod($monday, new DateInterval('P1D'), 4);

        
        $day = $monday->format('W');
        $week_start = date('Y-m-d', strtotime('-'.$day.' days'));
        $week_end = date('Y-m-d', strtotime('+'.(6-$day).' days'));
        $dataWeeks[] = 

            [
                "week_name"=>"Week ".$monday->format('W'),
                "week_number"=>$monday->format('W'),
                "date"=>listDayOfWeek($monday->format('Y-m-d')),
            ];
        
    }

    return $dataWeeks;
}

function listDayOfWeek($date){
    $status = TypeAbsen($date_);
    if($status){
        $status = 'disabled';
    }else{
        $status = 'enable';
    }
    $dates[] = [
        'status'=>$status,
        'date'=>$date
    ];
    for ($i=1; $i < 7; $i++) { 
        $date_ = date('Y-m-d',strtotime('+'.$i.' day',strtotime($date)));
        $status = TypeAbsen($date_);
        if($status){
            $status = 'disabled';
        }else{
            $status = 'enable';
        }
        $dates[] = [
            'status'=>$status,
            'date'=>$date_
        ];
        
    }

    return $dates;

    //echo $dates;
}

/* End of file xms_helper.php */
/* Location: ./application/helpers/xms_helper.php */
