<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Tasks Class.
 *
 * @author alfian purnomo <alfian.pacul@gmail.com>
 *
 * @version 3.0
 *
 * @category Controller
 */
class Tasks extends CI_Controller
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
        $this->load->model('Tasks_model','TM');
        $this->class_path_name = $this->router->fetch_class();
    }

    /**
     * Index page.
     */
    public function index()
    {
        $this->data['menu_title']     = 'Tasks';
        $this->data['add_url']        = site_url($this->class_path_name.'/add');
        $this->data['url_data']       = site_url($this->class_path_name.'/list_data');
        $this->data['record_perpage'] = SHOW_RECORDS_DEFAULT;

        $list_date = $this->week_from_monday(date('d-m-Y'));
        // debugvar($_SESSION);
        // die();

        $this->data['list_date'] = $list_date;
        $employeeid = $_SESSION['ADM_SESS']['admin_employeeid'];

        $list_project = $this->db
                        ->select('a.*, b.title')
                        ->where('a.employeeid',$employeeid)
                        ->where('a.employee_role',1)
                        ->join('projects b','a.projectid=b.id_projects')
                        ->group_by('b.id_projects')
                        ->get('mapping_project_employee a')->result_array();

        $this->data['list_project'] = $list_project;

        // debugvar($data);
        // die();
    }

    /**
     * listing data from record.
     *
     * @return json $return
     */
    public function list_data()
    {
        $this->layout = 'none';
        if ($this->input->post() && $this->input->is_ajax_request()) {
            $post = $this->input->post();
            $param['search_value'] = $post['search']['value'];
            $param['search_field'] = $post['columns'];
            if (isset($post['order'])) {
                $param['order_field'] = $post['columns'][$post['order'][0]['column']]['data'];
                $param['order_sort']  = $post['order'][0]['dir'];
            }
            $param['row_from']         = $post['start'];
            $param['length']           = $post['length'];
            $count_all_records         = $this->RAM->CountAllData();
            $count_filtered_records    = $this->RAM->CountAllData($param);
            $records                   = $this->RAM->GetAllData($param);
            $return                    = [];
            $return['draw']            = $post['draw'];
            $return['recordsTotal']    = $count_all_records;
            $return['recordsFiltered'] = $count_filtered_records;
            $return['data']            = [];
            foreach ($records as $row => $record) {
                $return['data'][$row]['DT_RowId']    = $record['id'];
                $return['data'][$row]['actions']        = '<a href="'.site_url($this->class_path_name.'/edit/'.$record['id']).'" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                $return['data'][$row]['title']        = $record['title'];
                $return['data'][$row]['description']       = $record['description'];
                $return['data'][$row]['start_date']       = custDateFormat($record['start_date'],'d M Y H:i:s');
                $return['data'][$row]['end_date']     = custDateFormat($record['end_date'],'d M Y H:i:s');
                
                
                
            }
            json_exit($return);
        }
        redirect($this->class_path_name);
    }


    private function week_from_monday($date) {
        // Assuming $date is in format DD-MM-YYYY
        list($day, $month, $year) = explode("-", $date);

        // Get the weekday of the given date
        $wkday = date('l',mktime('0','0','0', $month, $day, $year));

        switch($wkday) {
            case 'Monday': $numDaysToMon = 0; break;
            case 'Tuesday': $numDaysToMon = 1; break;
            case 'Wednesday': $numDaysToMon = 2; break;
            case 'Thursday': $numDaysToMon = 3; break;
            case 'Friday': $numDaysToMon = 4; break;
            case 'Saturday': $numDaysToMon = 5; break;
            case 'Sunday': $numDaysToMon = 6; break;   
        }

        // Timestamp of the monday for that week
        $monday = mktime('0','0','0', $month, $day-$numDaysToMon, $year);

        $seconds_in_a_day = 86400;

        // Get date for 7 days from Monday (inclusive)
        for($i=0; $i<7; $i++)
        {
            $dates[$i] = date('Y-m-d',$monday+($seconds_in_a_day*$i));
        }

        foreach ($dates as $key => $value) {
            $status = TypeAbsen($value);
            if($status){
                $status = 'disabled';
            }else{
                $status = 'enable';
            }
            $dateNew[] = [
                'status'=>$status,
                'date'=>$value
            ];
        }

        return $dateNew;
    }

    public function ajax_get_employee(){
        $return = array();
        $this->layout = 'none';
        if ($this->input->is_ajax_request()) {
            $get = $this->input->get();
            // if($get['q']){
                
                $data = $this->db
                        ->like('a.firstname',$get['search'])
                        ->or_like('a.nik',$get['search'])
                        ->where('b.f_auth',1)
                        ->join('t_data_user b','b.id=a.userid')
                        ->get('master_employee a')->result_array();
                if($data){
                    foreach ($data as $key => $value) {
                        $return[] = ['id'=>$value['employeeid'],'text'=>$value['nik'].' - '.$value['firstname'].' - '.$value['lastname'],'name'=>$value['firstname'].' - '.$value['lastname'],'nik'=>$value['nik']];
                    }
                }
            //}
            
            
        }
        return $this->output
          ->set_content_type('application/json')
          ->set_status_header(200)
          ->set_output(json_encode($return));
        exit();
    }

    public function ajax_get_projects(){
        $return = array();
        $this->layout = 'none';
        if ($this->input->is_ajax_request()) {
            $get = $this->input->get();
            // if($get['q']){
                if(is_superadmin()){
                    $employeeid = $this->input->get('employeeid');
                }else{
                    $employeeid = employeeid();
                }
                $data = $this->db
                        ->select('a.*, b.title')
                        ->where('a.start_date <=',$get['date'])
                        ->where('a.end_date >=',$get['date'])
                        ->where('a.employeeid',$employeeid)
                        ->like('b.title',$get['search'])
                        ->join('projects b','a.projectid=b.id_projects')
                        ->group_by('b.id_projects')
                        ->get('mapping_project_employee a')->result_array();
                //echo $this->db->last_query();
                if($data){
                    foreach ($data as $key => $value) {
                        $return[] = ['id'=>$value['projectid'],'text'=>$value['title'],'id_project'=>$value['projectid']];
                    }
                }
            //}
            
            
        }
        return $this->output
          ->set_content_type('application/json')
          ->set_status_header(200)
          ->set_output(json_encode($return));
        exit();
    }

    public function ajax_get_activity(){
        $return = array();
        $this->layout = 'none';
        if ($this->input->is_ajax_request()) {
            $get = $this->input->get();
            // if($get['q']){
                
                $data = $this->db
                        ->like('activity_name',$get['search'])
                        ->where('is_delete',0)
                        ->get('master_activity')->result_array();
                //echo $this->db->last_query();
                if($data){
                    foreach ($data as $key => $value) {
                        $return[] = ['id'=>$value['id_activity'],'text'=>$value['activity_name']];
                    }
                }
            //}
            
            
        }
        return $this->output
          ->set_content_type('application/json')
          ->set_status_header(200)
          ->set_output(json_encode($return));
        exit();
    }

    private function createDateRange($startDate,$endDate){

        $begin = new DateTime($startDate);
        $end = new DateTime($endDate);

        $daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);
        $dates = [];
        foreach($daterange as $date){
            $dates[] = $date->format("Y-m-d");
        }
        foreach ($dates as $key => $value) {
            $status = TypeAbsen($value);
            if($status){
                $status = 'disabled';
            }else{
                $status = 'enable';
            }
            $dateNew[] = [
                'status'=>$status,
                'date'=>$value
            ];
        }
        //debugvar($dates);

        return $dateNew;

    }
    private function generateHeaderTabelAdmin($listDate){
        $html = '<tr>
                    <th>Activity Name / Date</th>';
                    
                    
        foreach ($listDate as $key => $date) {
            $class_action       = '';
            $btn_class          = 'danger';
            if($date['status']=='enable'){
                
                $class_action       = 'addTasks';
                $btn_class          = 'success';
            }
            $html .= '  <th>
                            <a data-date="'.$date['date'].'" class="'.$class_action.' btn btn-'.$btn_class.'">'.custDateFormat($date['date'],'d M Y').'</a>
                        </th>';
        }
                    
        $html .=      '</tr>';

        return $html;
    }

    private function generateTabelRow($employeeid,$startDate,$endDate,$listDate,$rangeDate=7){

        $html_th = $this->generateHeaderTabelAdmin($listDate);
        $return['html_th'] = $html_th; 
        try{
            if($rangeDate){
                if($rangeDate < 8){
                    $getData = $this->db
                                ->select('a.*,b.title,c.activity_name,sum(hours) as total_hours')
                               ->where('a.employeeid',$employeeid)
                               ->join('projects b','b.id_projects=a.projectid')
                               ->join('master_activity c','c.id_activity=a.activityid')
                               ->where('c.is_delete',0)
                               ->where('a.date >=',$startDate)
                               ->where('a.date <=',$endDate)
                               ->group_by('a.date')
                               ->group_by('b.title')
                               ->group_by('c.activity_name')
                               ->get('tasks a')
                               ->result_array();
                    #echo $this->db->last_query();
                    if($getData){
                        #$listDate = $this->createDateRange($startDate,$endDate);
                        #json_exit($listDate);
                        foreach ($getData as $key => $value) {
                            $keyid = $value['title'].$value['activity_name'];
                            $result[$keyid]['title'] = $value['title'];
                            $result[$keyid]['activity_name'] = $value['activity_name'];
                            $result[$keyid]['employeeid'] = $value['employeeid'];
                            $result[$keyid]['projectid'] = $value['projectid'];
                            $result[$keyid]['activityid'] = $value['activityid'];
                            $result[$keyid]['data'][$value['date']] = $value['total_hours'];
                            
                        }
                        //json_exit($listDate);
                        $html = '';
                        foreach ($result as $key => $value) {
                            $html .= '<tr>
                                            <td>'.$value['title'].' - '.$value['activity_name'].'</td>';
                            foreach ($listDate as $x => $y) {
                                $hours = ($value['data'][$y['date']]) ? $value['data'][$y['date']] : 0;
                                $attr = '';
                                if($hours){
                                    $attr = 'class="editTasks" data-title="'.$value['title'].'" data-activity_name="'.$value['activity_name'].'" data-employeeid="'.$value['employeeid'].'" data-id_project="'.$value['projectid'].'" data-id_activity="'.$value['activityid'].'" data-date="'.$y['date'].'" data-hours="'.$hours.'"';
                                }
                                $html .= '<td ><div '.$attr.'>'.$hours.'</div></td>';# code...
                            }
                            
                            $html .= '</tr>';
                        }
                        $return['raw_data'] = $result;
                        $return['html'] = $html;
                    }else{
                        $return['status'] = alert_box('List tasks not found for this user', 'warning');
                        $return['html'] = '';
                    }
                }else{
                    $return['status'] = alert_box('Range between date cannot more than 7 days', 'danger');
                    $return['html'] = '';  
                }
                
            }else{
                $return['html'] = '';
                $return['status'] = alert_box('Choose date range first', 'warning');
                
            }
            
        }catch(Exception $e){
            $return['error'] = $e->getMessage();
            
        }

        return $return;
    }

    private function generateTabelRowTeamLead($projectid,$startDate,$endDate,$listDate,$rangeDate=7){

        $html_th = $this->generateHeaderTabelAdmin($listDate);
        $return['html_th'] = $html_th; 
        try{
            if($rangeDate){
                
                if($rangeDate < 8){
                    $getDataEmployee = $this->db
                                        ->select('a.date,a.employeeid,e.title,b.employee_role,a.projectid,a.activityid,c.firstname,c.lastname,d.activity_name,sum(a.hours) as total_hours')
                                       ->where('a.projectid',$projectid)
                                       ->join('mapping_project_employee b','a.employeeid=b.employeeid')
                                       ->join('master_employee c','a.employeeid=c.employeeid')
                                       ->join('master_activity d','d.id_activity=a.activityid')
                                       ->join('projects e','e.id_projects=a.projectid')
                                       ->where('a.date >=',$startDate)
                                       ->where('a.date <=',$endDate)
                                       #->where('b.employee_role',2)
                                       ->group_by('a.date')
                                       ->group_by('a.employeeid')
                                       ->group_by('a.activityid')
                                       ->get('tasks a')
                                       ->result_array();
                    #echo $this->db->last_query();
                    #json_exit($getDataEmployee);
                    if($getDataEmployee){
                        #$listDate = $this->createDateRange($startDate,$endDate);
                        
                        foreach ($getDataEmployee as $key => $value) {
                            $keyid = $value['firstname'].' '.$value['firstname'].''.$value['activity_name'];
                            $result[$keyid]['employee_role']        = $value['employee_role'];
                            $result[$keyid]['employee_name']        = $value['firstname'].' '.$value['firstname'];
                            $result[$keyid]['activity_name']        = $value['activity_name'];
                            $result[$keyid]['employeeid']           = $value['employeeid'];
                            $result[$keyid]['projectid']            = $value['projectid'];
                            $result[$keyid]['activityid']           = $value['activityid'];
                            $result[$keyid]['employee_role']        = $value['employee_role'];
                            $result[$keyid]['title']                = $value['title'];
                            $result[$keyid]['data'][$value['date']] = $value['total_hours'];
                            
                        }
                        #json_exit($result);
                        $html = '';
                        foreach ($result as $key => $value) {
                            $html .= '<tr>
                                            <td>'.$value['employee_name'].' - '.$value['activity_name'].'</td>';
                            foreach ($listDate as $x => $y) {
                                $hours = ($value['data'][$y['date']]) ? $value['data'][$y['date']] : 0;
                                $attr = '';
                                if($hours){
                                    $edit = '';
                                    if(is_superadmin()){
                                        $edit = 'editTasks';
                                    }else{
                                        if(employeeid() == $value['employeeid']){
                                            $edit = 'editTasks';
                                        }else{
                                            $edit = '';
                                        }
                                    }
                                    $attr = 'class="'.$edit.'" data-title="'.$value['title'].'" data-employee_name="'.$value['employee_name'].'" data-activity_name="'.$value['activity_name'].'" data-employeeid="'.$value['employeeid'].'" data-id_project="'.$value['projectid'].'" data-id_activity="'.$value['activityid'].'" data-date="'.$y['date'].'" data-role="'.$value['employee_role'].'" data-hours="'.$hours.'"';
                                }
                                $html .= '<td ><div '.$attr.'>'.$hours.'</div></td>';# code...
                            }
                            
                            $html .= '</tr>';
                        }
                        $return['raw_data'] = $result;
                        $return['html'] = $html;
                    }else{
                        $return['status'] = alert_box('List tasks not found for this user', 'warning');
                        $return['html'] = '';
                    }
                }else{
                    $return['status'] = alert_box('Range between date cannot more than 7 days', 'danger');
                    $return['html'] = '';  
                }
                
            }else{
                $return['html'] = '';
                $return['status'] = alert_box('Choose date range first', 'warning');
                
            }
            
        }catch(Exception $e){
            $return['error'] = $e->getMessage();
            
        }

        return $return;
    }

    

    private function calculate2Date($startDate,$endDate){
        $start = strtotime($startDate);
        $end = strtotime($endDate);
        $datediff = $end - $start;

        return round($datediff / (60 * 60 * 24));
    }
    public function getListTasks(){
        $this->layout = 'none';
        $return = [];
        if ($this->input->is_ajax_request()) {
            $post = $this->input->post();

            
            if(is_superadmin()){
                $employeeid = $post['employeeid'];
                if($employeeid){
                    if($post['startDate'] && $post['endDate']){
                        $employeeid = $post['employeeid'];
                        $startDate = $post['startDate'];
                        $endDate   = $post['endDate'];
                        $listDate = $this->createDateRange($startDate,$endDate);
                        $rangeDate = $this->calculate2Date($startDate,$endDate);
                        $return = $this->generateTabelRow($employeeid,$startDate,$endDate,$listDate,$rangeDate);
                    }else{
                        $return['status'] = alert_box('Start and End Date must be filled','danger');
                    }
                }else{
                    $return['status'] = alert_box('Choose Employee first','danger');
                }
            }else{
                $employeeid = employeeid();
                $listTeamLead = $this->TM->getProjectTeamLead($employeeid);
                if($listTeamLead){

                    if($post['projectid_filter']){
                        $startDate = $post['startDate'];
                        $endDate   = $post['endDate'];
                        $listDate = $this->createDateRange($startDate,$endDate);
                        $rangeDate = $this->calculate2Date($startDate,$endDate);
                        $return = $this->generateTabelRowTeamLead($post['projectid_filter'],$startDate,$endDate,$listDate,$rangeDate);
                    }else{
                        $return['status'] = alert_box('Choose project first','warning');
                    }
                    
                }else{
                   $listDate = $this->week_from_monday(date('d-m-Y'));
                    $startDate = $listDate[0]['date'];
                    $endDate   = $listDate[6]['date'];
                    $rangeDate = 7;
                    $return = $this->generateTabelRow($employeeid,$startDate,$endDate,$listDate,$rangeDate); 
                }
                
                //$html_th = $this->generateTabelAdmin($listDate);
            }

            
            
            json_exit($return);
            
        }
    }

    public function saveTasks(){
        $this->layout = 'none';
        $return = [];
        $id_auth_user = id_auth_user();
        if ($this->input->post() && $this->input->is_ajax_request()) {
            $post = $this->input->post();
            if(is_superadmin()){
                $employeeid = $this->input->post('employeeid');
                $startDate = $post['startDate'];
                $endDate   = $post['endDate'];
                $listDate = $this->createDateRange($startDate,$endDate);
                $rangeDate = $this->calculate2Date($startDate,$endDate);
            }else{
                $employeeid = employeeid();
                $listTeamLead = $this->TM->getProjectTeamLead($employeeid);
                if($listTeamLead){
                    if($post['projectid']){
                        $startDate = $post['startDate'];
                        $endDate   = $post['endDate'];
                        $listDate = $this->createDateRange($startDate,$endDate);
                        $rangeDate = $this->calculate2Date($startDate,$endDate);
                    }else{
                        $return['status'] = alert_box('Choose project first','warning');
                    }
                    
                }else{
                    #$employeeid = employeeid();
                    $listDate = $this->week_from_monday(date('d-m-Y'));
                    $startDate = $listDate[0]['date'];
                    $endDate   = $listDate[6]['date'];
                    $rangeDate = 7;  
                     
                }
                
            }
            if($employeeid){
               $dataInsert = [
                    'date'=>$post['date_selected'],
                    'employeeid'=>$employeeid,
                    'projectid'=>$post['projectid'],
                    'activityid'=>$post['activityid'],
                    'hours'=>$post['hours']
                ];

                $check = $this->db
                           ->select_sum('hours')
                           ->where('a.date',$post['date_selected'])
                           ->where('a.employeeid',$employeeid)
                           ->join('projects b','b.id_projects=a.projectid')
                           ->join('master_activity c','c.id_activity=a.activityid')
                           ->where('c.is_delete',0)
                           ->get('tasks a')
                           ->row_array();
                $total_hours = $check['hours'] + $post['hours'];
                if($total_hours > 12){
                    $return['raw_data'] = [];
                    $return['html'] = '';
                    $return['status'] = alert_box('Jumlah jam pada hari itu melewati batas','danger');
                    json_exit($return);
                }
                $this->db->insert('tasks',$dataInsert);
                $data_log = [
                    'id_user'  => $id_auth_user,
                    'id_group' => id_auth_group(),
                    'action'   => 'Add Tasks',
                    'desc'     => 'Add Tasks; ID: '.$id.'; Data: '.json_encode($post),
                ];
                insert_to_log($data_log);
                
                $return['status'] = alert_box('Success','success');
                if(is_superadmin()){
                    $return = $this->generateTabelRow($employeeid,$startDate,$endDate,$listDate,$rangeDate); 
                }else{
                
                    $listTeamLead = $this->TM->getProjectTeamLead($employeeid);
                    if($listTeamLead){

                        if($post['projectid']){
                            $return = $this->generateTabelRowTeamLead($post['projectid'],$startDate,$endDate,$listDate,$rangeDate);
                        }else{
                            $return['status'] = alert_box('Choose project first','warning');
                        }
                        
                    }else{
                        
                        $return = $this->generateTabelRow($employeeid,$startDate,$endDate,$listDate,$rangeDate); 
                    }
                }
                
            }else{
                $return['raw_data'] = [];
                $return['html'] = '';
                $return['status'] = alert_box('Employee ID must be choosen','danger');
            }
            //$employeeid = 'ba33e57b-9bd5-11e9-9cb8-b4d5bd9e2609';
            


            json_exit($return);
        }
    }

    public function editTasks(){
        $this->layout = 'none';
        $return = [];
        $id_auth_user = id_auth_user();
        if ($this->input->post() && $this->input->is_ajax_request()) {
            $post = $this->input->post();
            if($this->validateFormAjax()){
                // if(is_superadmin()){
                //     $employeeid = $post['employeeid_edit'];
                //     $startDate = $post['startDate'];
                //     $endDate   = $post['endDate'];
                //     $listDate = $this->createDateRange($startDate,$endDate);
                //     $rangeDate = $this->calculate2Date($startDate,$endDate);
                // }else{
                //     $employeeid = $post['employeeid_edit'];
                //     $listDate = $this->week_from_monday(date('d-m-Y'));
                //     $startDate = $listDate[0]['date'];
                //     $endDate   = $listDate[6]['date'];
                //     $rangeDate = 7;
                // }
                if(is_superadmin()){
                    $employeeid = $this->input->post('employeeid_edit');
                    $startDate = $post['startDate'];
                    $endDate   = $post['endDate'];
                    $listDate = $this->createDateRange($startDate,$endDate);
                    $rangeDate = $this->calculate2Date($startDate,$endDate);
                }else{
                    $employeeid = employeeid();
                    $listTeamLead = $this->TM->getProjectTeamLead($employeeid);
                    if($listTeamLead){
                        #json_exit($post);
                        if($post['projectid']){
                            $startDate = $post['startDate'];
                            $endDate   = $post['endDate'];
                            $listDate = $this->createDateRange($startDate,$endDate);
                            $rangeDate = $this->calculate2Date($startDate,$endDate);
                        }else{
                            $return['status'] = alert_box('Choose project first','warning');
                        }
                        
                    }else{
                        $employeeid = employeeid();
                        $listDate = $this->week_from_monday(date('d-m-Y'));
                        $startDate = $listDate[0]['date'];
                        $endDate   = $listDate[6]['date'];
                        $rangeDate = 7;  
                         //die('das');
                    }
                    
                }
                $dataInsert = [
                    'date'=>$post['date_edit'],
                    'employeeid'=>$employeeid,
                    'projectid'=>$post['projectid'],
                    'activityid'=>$post['activityid'],
                    'hours'=>$post['hours_edit']
                ];
                $check = $this->db
                           ->select_sum('hours')
                           ->where('a.date',$post['date_edit'])
                           ->where('a.employeeid',$employeeid)
                           ->join('projects b','b.id_projects=a.projectid')
                           ->join('master_activity c','c.id_activity=a.activityid')
                           ->where('c.is_delete',0)
                           ->get('tasks a')
                           ->row_array();
                #echo $this->db->last_query();
                $total_hours = $check['hours'] + $post['hours_edit'];
                #json_exit($check);
                if($total_hours > 12){
                    $return['raw_data'] = [];
                    $return['html'] = '';
                    $return['status'] = alert_box('Jumlah jam pada hari itu melewati batas','danger');
                    json_exit($return);
                }
                $where = [
                    'date'=>$post['date_edit'],
                    'employeeid'=>$employeeid,
                    'projectid'=>$post['projectid'],
                    'activityid'=>$post['activityid'],
                ];
                $this->db->where($where);
                $this->db->delete('tasks');

                $this->db->insert('tasks',$dataInsert);

                $data_log = [
                    'id_user'  => $id_auth_user,
                    'id_group' => id_auth_group(),
                    'action'   => 'Edit Tasks',
                    'desc'     => 'Edit Tasks; ID: '.$id.'; Data: '.json_encode($post),
                ];
                insert_to_log($data_log);

                $return['status'] = alert_box('Success','success');
                if(is_superadmin()){

                    $return = $this->generateTabelRow($employeeid,$startDate,$endDate,$listDate,$rangeDate); 
                }else{
                
                    $listTeamLead = $this->TM->getProjectTeamLead($employeeid);
                    if($listTeamLead){

                        if($post['projectid']){
                            #echo $startDate;
                            #die();
                            $return = $this->generateTabelRowTeamLead($post['projectid'],$startDate,$endDate,$listDate,$rangeDate);
                        }else{
                            $return['status'] = alert_box('Choose project first','warning');
                        }
                        
                    }else{
                        
                        $return = $this->generateTabelRow($employeeid,$startDate,$endDate,$listDate,$rangeDate); 
                    }
                }
                #$return = $this->generateTabelRow($employeeid,$startDate,$endDate,$listDate,$rangeDate);


                
            }else{
                $return['raw_data'] = $result;
                $return['html'] = $html;
                $return['status'] = $this->error;
            }
            json_exit($return);
            
            
        }
    }
    /**
     * Add page.
     *
     * @return string layout page
     */
    public function add()
    {
        
        $this->data['page_title']  = 'Add';
        $this->data['form_action'] = site_url($this->class_path_name.'/add');
        $this->data['cancel_url']  = site_url($this->class_path_name);
        $this->data['form_action_upload'] = site_url($this->class_path_name.'/check_employee');
        
        if ($this->input->post()) {
            $post = $this->input->post();
            // debugvar($post);
            // die();
            $id_auth_user = id_auth_user();
            if ($this->validateForm()) {
                $dataCreateProject = [
                  'title'=>$post['title'],
                  'description'=>$post['description'],
                  'start_date'=>$post['start_date'],
                  'end_date'=>$post['end_date'],
                  'status'=>($post['f_auth']) ? 1 : 2 
                ];

                $id = $this->RAM->InsertRecord($dataCreateProject);
                if($id){
                  if($post['listEmployee']){
                    $dataInsertEmp = [];
                    foreach ($post['listEmployee'] as $key => $value) {
                      $dataInsertEmp[] = [
                        'projectid'=>$id,
                        'employeeid'=>$value['employeeid'],
                        'start_date'=>$value['start_date'],
                        'end_date'=>$value['end_date']
                      ];

                    }

                    if($dataInsertEmp){
                      $this->db->insert_batch('mapping_project_employee',$dataInsertEmp);
                    }
                  }
                } 
                
                
                // insert to log
                $data_log = [
                    'id_user'  => $id_auth_user,
                    'id_group' => id_auth_group(),
                    'action'   => 'Add Project',
                    'desc'     => 'Add Project; ID: '.$id.'; Data: '.json_encode($post),
                ];
                insert_to_log($data_log);
                // end insert to log
                $this->session->set_flashdata('flash_message', alert_box('Success.', 'success'));

                redirect($this->class_path_name);
            }
            $this->data['post'] = $post;
        }
        //$this->data['template'] = $this->class_path_name.'/form';
        if (isset($this->error)) {
            $this->data['form_message'] = $this->error;
        }
    }

    public function detail($id=0){
        $getDetail = $this->BKM_HK->getDetail($id);
        
        $this->data['detail'] = $getDetail;
    }


    /**
     * Detail/Edit Page.
     *
     * @param int $id
     *
     * @return string layout
     */
    public function edit($id = 0)
    {
        if (!$id) {
            redirect($this->class_path_name);
        }
        $record = $this->RAM->getProject($id);
        
        if (!$record) {
            redirect($this->class_path_name);
        }
        // debugvar($record);
        // die();
        $this->data['page_title']         = 'Edit';
        $this->data['form_action']        = site_url($this->class_path_name.'/edit/'.$id);
        $this->data['cancel_url']         = site_url($this->class_path_name);
        if ($this->input->post()) {
            $post = $this->input->post();

            if ($this->validateForm($id)) {
                $dataUpadateProject = [
                  'title'=>$post['title'],
                  'description'=>$post['description'],
                  'start_date'=>$post['start_date'],
                  'end_date'=>$post['end_date'],
                  'status'=>($post['f_auth']) ? 1 : 2 
                ];

                $this->RAM->UpdateRecord($id,$dataUpadateProject);
                if($id){
                  if($post['listEmployee']){
                    $this->RAM->DeleteRecordMappingEmp($id);
                    $dataInsertEmp = [];
                    foreach ($post['listEmployee'] as $key => $value) {
                      $dataInsertEmp[] = [
                        'projectid'=>$id,
                        'employeeid'=>$value['employeeid'],
                        'start_date'=>$value['start_date'],
                        'end_date'=>$value['end_date']
                      ];

                    }

                    if($dataInsertEmp){
                      $this->db->insert_batch('mapping_project_employee',$dataInsertEmp);
                    }
                  }
                } 
                // insert to log
                $data_log = [
                    'id_user'  => id_auth_user(),
                    'id_group' => id_auth_group(),
                    'action'   => 'Update Project',
                    'desc'     => 'Update Project; ID: '.$id.'; Data: '.json_encode($post),
                ];
                insert_to_log($data_log);
                // end insert to log
                $this->session->set_flashdata('flash_message', alert_box('Success.', 'success'));

                redirect($this->class_path_name);
            }
        }
        //$this->data['template'] = $this->class_path_name.'/form';
        $this->data['post']     = $record;
        if (isset($this->error)) {
            $this->data['form_message'] = $this->error;
        }
    }

    /**
     * Delete page.
     *
     * @return json $json
     */
    public function delete()
    {
        $this->layout = 'none';
        if ($this->input->post() && $this->input->is_ajax_request()) {
            $post = $this->input->post();
            $json = [];
            if ($post['ids'] != '') {
                $array_id = array_map('trim', explode(',', $post['ids']));
                if (count($array_id) > 0) {
                    foreach ($array_id as $row => $id) {
                        $record = $this->Admin_model->GetAdmin($id);
                        if ($record) {
                            if ($id == id_auth_user()) {
                                $json['error'] = alert_box('You can\'t delete Your own account.', 'danger');
                                break;
                            } else {
                                if (is_superadmin()) {
                                    /*if ($record['image'] != '' && file_exists(UPLOAD_DIR. $this->class_path_name. '/'.$record['image'])) {
                                        unlink(UPLOAD_DIR. $this->class_path_name. '/'.$record['image']);
                                        @unlink(UPLOAD_DIR. $this->class_path_name. '/tmb_'.$record['image']);
                                        @unlink(UPLOAD_DIR. $this->class_path_name. '/sml_'.$record['image']);
                                    }*/
                                    $this->Admin_model->DeleteRecord($id);
                                    $json['success'] = alert_box('Data has been deleted', 'success');
                                    $this->session->set_flashdata('flash_message', $json['success']);
                                    // insert to log
                                    $data_log = [
                                        'id_user'  => id_auth_user(),
                                        'id_group' => id_auth_group(),
                                        'action'   => 'User Admin',
                                        'desc'     => 'Delete User Admin; ID: '.$id.';',
                                    ];
                                    insert_to_log($data_log);
                                    // end insert to log
                                } else {
                                    $json['error'] = alert_box('You don\'t have permission to delete this record(s). Please contact the Administrator.', 'danger');
                                    break;
                                }
                            }
                        } else {
                            $json['error'] = alert_box('Failed. Please refresh the page.', 'danger');
                            break;
                        }
                    }
                }
            }
            json_exit($json);
        }
        redirect($this->class_path_name);
    }

    /**
     * Delete Picture.
     *
     * @return json $json
     */
    public function delete_picture()
    {
        $this->layout = 'none';
        if ($this->input->post() && $this->input->is_ajax_request()) {
            $json = [];
            $post = $this->input->post();
            if (isset($post['id']) && $post['id'] > 0 && ctype_digit($post['id'])) {
                $detail = $this->Admin_model->GetAdmin($post['id']);
                if ($detail && $detail['image'] != '') {
                    $id = $post['id'];
                    unlink(UPLOAD_DIR. $this->class_path_name. '/'.$detail['image']);
                    @unlink(UPLOAD_DIR. $this->class_path_name. '/tmb_'.$detail['image']);
                    @unlink(UPLOAD_DIR. $this->class_path_name. '/sml_'.$detail['image']);
                    $data_update = ['image' => ''];
                    $this->Admin_model->UpdateRecord($post['id'], $data_update);
                    $json['success'] = alert_box('File hase been deleted.', 'success');
                    // insert to log
                    $data_log = [
                        'id_user'  => id_auth_user(),
                        'id_group' => id_auth_group(),
                        'action'   => 'User Admin',
                        'desc'     => 'Delete Picture User Admin; ID: '.$id.';',
                    ];
                    insert_to_log($data_log);
                    // end insert to log
                } else {
                    $json['error'] = alert_box('Failed to remove File. Please try again.', 'danger');
                }
            }
            json_exit($json);
        }
        redirect($this->class_path_name);
    }

    /**
     * Validate Form.
     *
     * @param int $id
     *
     * @return bool
     */
    private function validateForm($id = 0)
    {
        $post = $this->input->post();
        $rules = [
            [
                'field' => 'start_date',
                'label' => 'Start Date',
                'rules' => 'required',
            ]
        ];
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() === false) {
            $this->error = alert_box(validation_errors(), 'danger');

            return false;
        } else {
            $post_image = $_FILES;
            if (!$this->error) {
                if ( ! empty($post_image['image']['tmp_name'])) {
                    $check_picture = validatePicture('image');
                    if ( ! empty($check_picture)) {
                        $this->error = alert_box($check_picture, 'danger');

                        return false;
                    }
                }

                return true;
            } else {
                $this->error = alert_box($this->error, 'danger');

                return false;
            }
        }
    }

    /**
     * Validate Form.
     *
     * @param int $id
     *
     * @return bool
     */
    private function validateFormAjax()
    {
        $post = $this->input->post();
        $rules = [
            [
                'field' => 'hours_edit',
                'label' => 'Hours',
                'rules' => 'numeric|required|less_than_equal_to[12]|max_length[2]',
            ]
        ];
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() === false) {
            $this->error = alert_box(validation_errors(), 'danger');

            return false;
        } else {
            if (!$this->error) {

                return true;
            } else {
                $this->error = alert_box($this->error, 'danger');

                return false;
            }
        }
    }

    /**
     * form validation check email exist.
     *
     * @param string $string
     * @param int    $id
     *
     * @return bool
     */
    public function check_email_exists($string, $id = 0)
    {
        if (!$this->Admin_model->checkExistsEmail($string, $id)) {
            $this->form_validation->set_message('check_email_exists', '{field} is already exists. Please use different {field}');

            return false;
        }

        return true;
    }

    /**
     * form validation check username exist.
     *
     * @param string $string
     * @param int    $id
     *
     * @return bool
     */
    public function check_username_exists($string, $id = 0)
    {
        if (!$this->Admin_model->checkExistsUsername($string, $id)) {
            $this->form_validation->set_message('check_username_exists', '{field} is already exists. Please use different {field}');

            return false;
        }

        return true;
    }
}
/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */
