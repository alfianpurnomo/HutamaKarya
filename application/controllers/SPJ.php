<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * SPJ Class.
 *
 * @author alfian purnomo <alfian.pacul@gmail.com>
 *
 * @version 3.0
 *
 * @category Controller
 */
class SPJ extends CI_Controller
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
        $this->load->model('SPJ_model');
        $this->class_path_name = $this->router->fetch_class();
    }

    /**
     * Index page.
     */
    public function index()
    {
        $this->data['menu_title']     = 'Master User';
        $this->data['add_url']        = site_url($this->class_path_name.'/create');
        $this->data['url_data']       = site_url($this->class_path_name.'/list_data');
        $this->data['record_perpage'] = SHOW_RECORDS_DEFAULT;
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
            $count_all_records         = $this->SPJ_model->CountAllData();
            $count_filtered_records    = $this->SPJ_model->CountAllData($param);
            $records                   = $this->SPJ_model->GetAllData($param);
            $return                    = [];
            $return['draw']            = $post['draw'];
            $return['recordsTotal']    = $count_all_records;
            $return['recordsFiltered'] = $count_filtered_records;
            $return['data']            = [];
            foreach ($records as $row => $record) {
                $action = '';
                if(is_superadmin() || id_auth_group()==2){
                    $action = '<a href="'.site_url($this->class_path_name.'/validation/'.$record['id']).'" class="btn btn-sm btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                }
                $return['data'][$row]['DT_RowId']    = $record['id'];
                $return['data'][$row]['actions']     = $action;
                $return['data'][$row]['spj_doc_no']                     = $record['spj_doc_no'];
                $return['data'][$row]['employee_requested']             = $record['employee_requested'];
                $return['data'][$row]['jobs_name']                      = $record['jobs_name'];
                $return['data'][$row]['grade']                          = $record['grade'];
                $return['data'][$row]['division_name']                  = $record['division_name'];
                $return['data'][$row]['head_of_division_name']          = $record['head_of_division_name'];
                $return['data'][$row]['status']          = $record['status'];
                
            }
            json_exit($return);
        }
        redirect($this->class_path_name);
    }

    private function sendEmailNotif($html,$to,$cc) {
        
        $this->layout = 'none';
        
        $this->load->library('email');
        // mail($to,$subject,$body,$headers);
        $from_email = "alfian.pacul@gmail.com"; 
        $to_email = $to; 

        $config = Array(
               'protocol' => 'smtp',
               'smtp_host' => 'smtp.googlemail.com',
               'smtp_port' => 587,
               'smtp_crypto'=>'tls',
               'smtp_user' => $from_email,
               'smtp_pass' => 'Anytimeslow311291',
               'mailtype'  => 'html', 
               'charset'   => 'iso-8859-1'
       );

        $this->email->initialize($config);
        $this->email->set_newline("\r\n");   

        $this->email->from($from_email, 'Alfian Purnomo'); 
        $this->email->to($to_email);
        $this->email->cc($cc);
        $this->email->subject('Surat Perjalanan'); 
        $this->email->message($html); 
        $this->email->set_mailtype('html');

        if($this->email->send()){
                echo 'Berhasil';
        }else {
            echo 'Gagal';
                $this->session->set_flashdata("notif","Email gagal dikirim."); 
                //$this->load->view(‘home’); 
                debugvar($this->email->print_debugger());
        } 
    }

    /**
     * Add page.
     *
     * @return string layout page
     */
    public function create()
    {
        // $this->data['master_employees']     = $this->SPJ_model->GetEmployee();
        // $this->data['master_activities']    = $this->SPJ_model->GetDivision();
        $this->data['page_title']  = 'Create SPJ';
        $this->data['form_action'] = site_url($this->class_path_name.'/create');
        $this->data['cancel_url']  = site_url($this->class_path_name);
        $this->data['master_vehicle'] = $this->SPJ_model->GetVehicle();
        if ($this->input->post()) {
            $post = $this->input->post();
            
            if ($this->validateForm()) {
                $id_auth_user   = id_auth_user();
                $do_calculation = $this->generateCalculation($post);
                $data_spj = [
                    'spj_doc_no'=>$do_calculation['spj_doc_number'],
                    'employeeid'=>$post['employeeid'],
                    'grade'=>$post['grade'],
                    'destinationid'=>$post['destination'],
                    'activityid'=>$post['activityid'],
                    'activity_detail'=>trim($post['activity_detail']),
                    'start_date'=>$post['start_date'],
                    'end_date'=>$post['end_date'],
                    'vehicle'=>$post['vehicle'],
                    'jenis_pengurusan'=>$post['jenis_pengurusan'],
                    'jenis_spj'=>($post['jenis_perjalanan_dinas']=='daily_money') ? 'Dinas' : 'Diklat',
                    'status'=>'REQUESTED',
                    'id_auth_user'=>$id_auth_user

                ];
                // debugvar($post);
                // die();
                
                // update data
                $id = $this->SPJ_model->InsertRecord($data_spj);
                if($id){
                    if($do_calculation['data_requester']){
                        $data_detail_travel_bill = [];
                        foreach ($do_calculation['data_requester'] as $key => $value) {
                            $data_travel_bill = [
                                'employeeid'=>$value['employeeid'],
                                'employee_name'=>$value['employee_name'],
                                'head_of_division'=>$value['head_of_division'],
                                'head_of_division_id'=>$value['head_of_division_id'],
                                'days'=>$value['days'],
                                'id_spj_online'=>$id,
                                'status'=>'REQUESTED_LPD',
                                'id_auth_user'=>$id_auth_user
                            ];
                            $id_travel_bill = $this->SPJ_model->InsertTravelBill($data_travel_bill);
                            if($id_travel_bill){
                                $data_detail_travel_bill[] = [
                                    'id_travel_bill'=>$id_travel_bill,
                                    'detail_activity'=>'Uang Harian',
                                    'amount'=>$value['daily_money'],
                                    'final_amount'=>$value['daily_money']*$value['days']
                                ];
                                $data_detail_travel_bill[] = [
                                    'id_travel_bill'=>$id_travel_bill,
                                    'detail_activity'=>'Uang Reprentasi',
                                    'amount'=>$value['reprentasi_money'],
                                    'final_amount'=>$value['reprentasi_money']*$value['days']
                                ];
                                $data_detail_travel_bill[] = [
                                    'id_travel_bill'=>$id_travel_bill,
                                    'detail_activity'=>'Uang Hotel',
                                    'amount'=>$value['hotel_cost'],
                                    'final_amount'=>$value['hotel_cost']*$value['days']
                                ];
                                $data_detail_travel_bill[] = [
                                    'id_travel_bill'=>$id_travel_bill,
                                    'detail_activity'=>'Uang Transportasi',
                                    'amount'=>$value['vehicle_cost'] + $value['vehicle_cost_destination'],
                                    'final_amount'=>$value['vehicle_cost'] + $value['vehicle_cost_destination']
                                ];
                            }
                        }
                        if($data_detail_travel_bill){
                            $this->db->insert_batch('detail_travel_bill',$data_detail_travel_bill);
                        }
                        
                    }
                }

                // send email notif
                    
                foreach ($do_calculation['data_requester'] as $key => $value) {
                    $html_email =  $this->generateDocumentEmail($do_calculation['spj_doc_number'],$value,$do_calculation['start_date'],$post['regional']);
                    $getEmailVP = $this->SPJ_model->getVPEmail($value['employeeid']);
                    //$cc = array('selo.tjahjono@hutamakarya.com','aprindaprames@gmail.com','novalinahhanawati@gmail.com','khusain.munawir@gmail.com');
                    $cc = array('aprindaprames@gmail.com','novalinahhanawati@gmail.com',);
                    if($getEmailVP!='selo.tjahjono@hutamakarya.com'){
                        $cc = array_push($cc,$getEmailVP);
                    }
                    
                    $this->sendEmailNotif($html_email,'khusain.munawir@gmail.com',$cc);
                }
                //die();
                // insert to log
                $data_log = [
                    'id_user'  => $id_auth_user,
                    'id_group' => id_auth_group(),
                    'action'   => 'Add SPJ',
                    'desc'     => 'Add SPJ; ID: '.$id.'; Data: '.json_encode($post),
                ];
                insert_to_log($data_log);
                // end insert to log
                $this->session->set_flashdata('flash_message', alert_box('Success.', 'success'));

                redirect($this->class_path_name);
            }
            $this->data['post'] = $post;
        }
        #$this->data['template'] = $this->class_path_name.'/form';
        if (isset($this->error)) {
            $this->data['form_message'] = $this->error;
        }
    }

    

    
    private function generateDocumentEmail( $spj_doc_number, $value = array(), $start_date, $regional = 'Dalam Negri' ){
        //debubvar($data_requester);
        //$html = '';
        //foreach ($data_requester as $key => $value) {
            $html = '<div class="col-lg-12">
                        <div style="text-align: center;margin-bottom: 20px;"  class="kop_surat">
                            <h3 style="font-size: initial;">PERINCIAN BIAYA PERJALANAN DINAS</h3>
                            <h3 style="font-size: initial;">BERDASARKAN SURAT TUGAS</h3>
                            <h3 style="font-size: initial;">No. : '.$spj_doc_number.' Tanggal : '.date('d M Y',strtotime($start_date)).'</h3> 
                        </div>
                        
                    </div>';
            $html .= $this->generateTabelSPJEmail($value,$regional,$start_date);
            
            
        //}

       return $html; 
    }


    private function generateTabelSPJEmail($value=[],$regional,$start_date){
        
        $html ='<div style="display: block;
                            float: left;
                            border: 1px solid #ccc;
                            margin: 10px 0px 30px 0px;
                            padding: 10px 0px;">
                <div class="col-lg-12">
                    <table style="border: 1px solid #D0D0D0;
                                border-spacing: 0;
                                border-collapse: collapse;width: 100%;
                                max-width: 100%;
                                margin-bottom: 20px;">
                        <thead>
                            <tr style="">
                                <th style="text-align: center;padding: 15px 5px;
                                color: #000000;
                                vertical-align: middle;
                                border: 1px solid #000000;">Uraian Biaya </th>
                                <th style="text-align: center;padding: 15px 5px;
                                color: #000000;
                                vertical-align: middle;
                                border: 1px solid #000000;">Jumlah Uang</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="padding: 15px 5px;
                                color: #000000;
                                vertical-align: middle;
                                border: 1px solid #000000;line-height:1.4">
                                    Uang Harian '.$value['jenis_spj'].'<br>
                                    '.$value['destination_name'].' <br>
                                    Rp. '.number_format($value['daily_money'],2,',','.').' x '.$value['days'].' <br>
                                </td>
                                <td style="padding: 15px 5px;
                                color: #000000;
                                vertical-align: middle;
                                border: 1px solid #000000;line-height:1.4">
                                    Rp. '.number_format($value['daily_money'] * $value['days'],2,',','.').'
                                </td>
                            </tr>';
                        if($regional=="Dalam Negri"){

                        
                            $html .= '<tr>
                                <td style="padding: 15px 5px;
                                color: #000000;
                                vertical-align: middle;
                                border: 1px solid #000000;line-height:1.4">
                                    Uang Representasi <br>
                                    '.$value['group_grade'].' <br>
                                    Rp. '.number_format($value['reprentasi_money'],2,',','.').' x '.$value['days'].' <br>
                                </td>
                                <td style="padding: 15px 5px;
                                color: #000000;
                                vertical-align: middle;
                                border: 1px solid #000000;line-height:1.4">
                                    Rp. '.number_format($value['reprentasi_money'] * $value['days'],2,',','.').'
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 15px 5px;
                                color: #000000;
                                vertical-align: middle;
                                border: 1px solid #000000;line-height:1.4">
                                    Uang Hotel ( Maksimal ) <br>
                                    '.$value['province'].' <br>
                                    Rp. '.number_format($value['hotel_cost'],2,',','.').' x '.$value['days'].' <br>
                                </td>
                                <td style="padding: 15px 5px;
                                color: #000000;
                                vertical-align: middle;
                                border: 1px solid #000000;line-height:1.4">
                                    Rp. '.number_format($value['hotel_cost'] * $value['days'],2,',','.').'
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 15px 5px;
                                color: #000000;
                                vertical-align: middle;
                                border: 1px solid #000000;line-height:1.4">
                                    Uang Transport  <br>
                                    '.$value['province'].' <br>
                                    Rp. '.number_format($value['vehicle_cost'] + $value['vehicle_cost_destination'],2,',','.').' <br>
                                </td>
                                <td style="padding: 15px 5px;
                                color: #000000;
                                vertical-align: middle;
                                border: 1px solid #000000;line-height:1.4">
                                    Rp. '.number_format($value['vehicle_cost'] + $value['vehicle_cost_destination'],2,',','.').'
                                </td>
                            </tr>';
                            $total_amount =   (($value['reprentasi_money']+$value['daily_money']+$value['hotel_cost']) * $value['days'])+$value['vehicle_cost'] + $value['vehicle_cost_destination'];
                        }else{
                            $total_amount = $value['daily_money'] * $value['days'];
                        }
                            $html .='<tr>
                                <td style="padding: 15px 5px;
                                color: #000000;
                                vertical-align: middle;
                                border: 1px solid #000000;line-height:1.4">
                                    Jumlah
                                </td>
                                <td style="padding: 15px 5px;
                                color: #000000;
                                vertical-align: middle;
                                border: 1px solid #000000;line-height:1.4">
                                    Rp. '.number_format($total_amount,2,',','.').'
                                </td>
                            </tr>
                        </tbody>
                    
                    </table> 
                    <p>Yang bertanda tangan dibawah ini bertanggung jawab sepenuhnya terhadap kebenaran Biaya Perjalanan ini, yang semuanya dilaksanana untuk keperluan Dinas, dan dibuat dalam rangkap 2 (dua).</p>   
                        </div>
                        <div style="display: flex;
                                    flex-direction: row;
                                    justify-content: space-around;" class="col-lg-12" >
                            <div class="text-center">
                            <p>Mengetahui,</p>
                            <p>Divisi EPC</p>
                            
                            <label style="margin-top: 100px;display: block;">'.$value['head_of_division'].' </label>
                            <p>Executive Vice President</p>
                        </div>
                        <div class="text-center">
                            <p>Jakarta, '.date('d M Y',strtotime($start_date)).'</p>
                            
                            <label style="margin-top: 135px;display: block;">'.$value['employee_name'].' </label>
                            
                        </div>
                    </div>
                </div>';
    
    return $html;
    
    }

    public function ajax_get_employee(){
        $return = array();
        $this->layout = 'none';
        if ($this->input->is_ajax_request()) {
            $get = $this->input->get();
            // if($get['q']){
                
                $data = $this->db
                        ->like('firstname',$get['search'])
                        ->or_like('nik',$get['search'])
                        ->get('view_employee')->result_array();
                if($data){
                    foreach ($data as $key => $value) {
                        $return[] = [
                            'id'=>$value['employeeid'],
                            'text'=>$value['nik'].' - '.$value['firstname'].' - '.$value['lastname'],
                            'name'=>$value['firstname'].' '.$value['lastname'],
                            'nik'=>$value['nik'],
                            'jobsid'=>$value['jobsid'],
                            'jobs_name'=>$value['jobs_name'],
                            'department'=>$value['department'],
                            'department_name'=>$value['department_name'],
                            'division'=>$value['division'],
                            'division_name'=>$value['division_name'],
                            'grade'=>$value['golongan'],
                            'group_grade'=>$value['group_gol_name'],
                            'id_group_grade'=>$value['id_master_group_golongan']
                            ];
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

    public function ajax_get_destination(){
        $return = array();
        $this->layout = 'none';
        if ($this->input->is_ajax_request()) {
            $get = $this->input->get();
            // if($get['q']){
                
                $data = $this->db
                        ->like('regional',$get['search'])
                        ->or_like('sub_regional',$get['search'])
                        ->or_like('province',$get['search'])
                        ->get('master_destination')->result_array();
                if($data){
                    foreach ($data as $key => $value) {
                        $data[$key]['id'] = $value['id_master_destination'];
                        $data[$key]['text'] = $value['sub_regional'].' - '.$value['regional'];
                        $data[$key]['province'] = $value['province'];
                        $data[$key]['regional'] = $value['regional'];
                    }
                }
            //}
            
            
        }
        return $this->output
          ->set_content_type('application/json')
          ->set_status_header(200)
          ->set_output(json_encode($data));
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

    private function calculate2Date($startDate,$endDate){
        $start = strtotime($startDate);
        $end = strtotime('+1 day',strtotime($endDate));#strtotime($endDate);
        $datediff = $end - $start;

        return round($datediff / (60 * 60 * 24));
    }

    private function checkKriteriaSPJ($group_range = 0,$frekuensi ){
        $kriteria = '';
        switch ($group_range) {
            case 1:
                if($frekuensi >= 0 && $frekuensi < 2){
                    $kriteria = 'Kriteria 1';
                }elseif($frekuensi >= 2 && $frekuensi < 5){
                    $kriteria = 'Kriteria 2';
                }elseif($frekuensi >= 5){
                    $kriteria = 'Kriteria 3';
                }
                break;
            case 2:
                if($frekuensi >= 0 && $frekuensi <= 2){
                    $kriteria = 'Kriteria 1';
                }elseif($frekuensi >= 3 && $frekuensi <= 5){
                    $kriteria = 'Kriteria 2';
                }elseif($frekuensi > 5){
                    $kriteria = 'Kriteria 3';
                }
                break;
            case 3:
                if($frekuensi >= 0 && $frekuensi <= 2){
                    $kriteria = 'Kriteria 2';
                }elseif($frekuensi >= 3 && $frekuensi <= 5){
                    $kriteria = 'Kriteria 2';
                }elseif($frekuensi > 5){
                    $kriteria = 'Kriteria 3';
                }
                break;
            default:
                $kriteria = '';
                break;
        }

        return $kriteria;
        
    }

    

    private function checkFrequensiSPJ($employeeid,$start_date,$end_date){
        
        $monthStart = date('m',strtotime($start_date));

        $check_frekuensi = $this->db
                    ->where('status !=','REJECTED')
                    ->where('MONTH(start_date)',$monthStart)
                    ->where('employeeid',$employeeid)
                    ->where('is_delete',0)
                    ->from('spj_online')
                    ->count_all_results();
                    //echo $check_frekuensi;
        $date_range = $this->calculate2Date($start_date,$end_date);

        if( $date_range >= 1 && $date_range <= 3 ) {
            $kriteria = $this->checkKriteriaSPJ(1,$check_frekuensi);
        }elseif ($date_range >= 4 && $date_range <= 10 ) {
            $kriteria = $this->checkKriteriaSPJ(2,$check_frekuensi);
        }elseif ($date_range >= 11  ) {
            $kriteria = $this->checkKriteriaSPJ(3,$check_frekuensi);
        }

        $return['kriteria'] = $kriteria;
        $return['days']     = $date_range;
        //print_r($return);
        return $return;
        
    }

    private function getRepresentasiMoney($id_group_golongan,$kriteria){
        $get_preprentasi_money = $this->db
                                    ->where('id_group_golongan',$id_group_golongan)
                                    ->where('LCASE(name)',strtolower($kriteria))
                                    ->get('frekuensi_perjalanan')
                                    ->row_array();
        return $get_preprentasi_money['amount'];
        
    }

    private function getDailyMoney($destination,$jenis,$regional,$id_group_grade='',$pengurusan){
        //echo $regional;
        if($regional=="Luar Negeri"){
            $data = $this->db
                ->where('sub_regional',$destination)
                ->where('id_master_group_golongan',$id_group_grade)
                ->get('view_master_destination_luar_negeri')->row_array();
                //echo $this->db->last_query();
            $result = $data['amount'];
            if($pengurusan == "Kantor"){
                
                $result = round(($data['amount'] * 0.3),PHP_ROUND_HALF_UP);
            }
            
        }else{
            $data = $this->db
                ->where('sub_regional',$destination)
                ->get('master_destination')->row_array();
            $result = $data[$jenis];
        }
        
        #echo $this->db->last_query();
        return (float)$result;
    }

    private function generateSPJDocNumber($division_name,$start_date){
        
        $last_Tno = $this->db
                    #->select('id_spj_online')
                    ->where('is_delete',0)
                    ->order_by('id_spj_online','desc')
                    ->get('spj_online')
                    ->row_array();
        //echo $this->db->last_query();
        if($last_Tno){
            $row = $last_Tno['spj_doc_no'];
            //echo $row;
            
            $ttno = array_map('trim', explode('/', $row));
            
            $ttno = array_filter($ttno);
            $ttno = $ttno[1];
            
            
            $ttno = substr($ttno, 2);
            
            $nott = $ttno + 1;

            $no_tt = sprintf("%04d", $nott);
        }else{
            $no_tt = sprintf("%04d", 1);
        }
        $spj_doc_no = $division_name.'/KM'.$no_tt.'/SPJ/'.romanic_number(date('m',strtotime($start_date))).'/'.date('Y',strtotime($start_date));
        return $spj_doc_no;

    }

    private function getHotelCost($golongan_grade,$province,$pengurusan,$penginapan){
        $get_hotel_cost = $this->db
                            ->where('id_group_grade',$golongan_grade)
                            ->where('LCASE(province)',strtolower($province))
                            ->get('view_hotel_cost')->row_array();
        $amount = 0;
        if($get_hotel_cost){
            $amount = $get_hotel_cost['amount'];
            if($penginapan=='Rumah'){
                $amount = round(($get_hotel_cost['amount'] * 0.3),PHP_ROUND_HALF_UP);
            }
        }

        return $amount;
    }

    private function getVehicleCost($vehicle,$province,$regional){
        //echo $vehicle;
        if($vehicle=='Pesawat' || $vehicle=='Kereta'){
            if($provice=='DKI JAKARTA'){
                return 500000;
            }else{
                return 300000;
            }
        }else{
            return 0;
        }
        
    }

    private function generateCalculation($post){
        $employeeid = $post['employeeid'];
        $start_date = $post['start_date'];
        $end_date   = $post['end_date'];

        $check_kriteria_requester     = $this->checkFrequensiSPJ($employeeid,$start_date,$end_date);
        $reprentasi_money_requester   = $this->getRepresentasiMoney($post['id_group_grade'],$check_kriteria_requester['kriteria']);
        $daily_money_requester        = $this->getDailyMoney($post['destination_name'],$post['jenis_perjalanan_dinas'],$post['regional'],$post['id_group_grade'],$post['pengurusan']);
        $getHeadofDivisionName        = $this->db->where('division_name','EPC')->get('view_master_division')->row_array();
        $spj_doc_number               = $this->generateSPJDocNumber($post['division_name'],$start_date);
        $get_hotel_cost               = $this->getHotelCost($post['id_group_grade'],$post['province'],$post['pengurusan'],$post['penginapan']);
        $get_vehicle_cost             = $this->getVehicleCost($post['vehicle'],$post['province'],$post['regional']);
        //echo $get_vehicle_cost;
        $data_requester[] = [
            'employeeid'=>$post['employeeid'],
            'employee_name'=>$post['employee_name'],
            'head_of_division'=>$getHeadofDivisionName['head_of_division_name'],
            'head_of_division_id'=>$getHeadofDivisionName['head_of_division'],
            'destination_name'=>$post['destination_name'],
            'days'=>$check_kriteria_requester['days'],
            'reprentasi_money'=>$post['regional']=="Dalam Negri" ? $reprentasi_money_requester : 0 ,
            'daily_money'=>$daily_money_requester,
            'hotel_cost'=>$post['regional']=="Dalam Negri" ? $get_hotel_cost : 0,
            'province'=>$post['province'],
            'vehicle'=>$post['vehicle'],
            'vehicle_cost'=>$post['regional']=="Dalam Negri" ? 500000 : 0,
            'vehicle_cost_destination'=>$post['regional']=="Dalam Negri" ? 300000 : 0,
            'start_date'=>$start_date,
            'group_grade'=>$post['group_grade'],
            'end_date'=>$end_date,
            'jenis_spj'=>($post['jenis_perjalanan_dinas']=='daily_money') ? 'Dinas' : 'Diklat'
        ];
        $listFollower = $post['listFollower'];
        if($listFollower){
            
            foreach ($listFollower as $k => $follower) {
                $check_kriteria_follower     = $this->checkFrequensiSPJ($follower['employeeid'],$start_date,$end_date);
                $reprentasi_money_follower   = $this->getRepresentasiMoney($follower['id_group_grade'],$check_kriteria_requester['kriteria']);
                $daily_money_follower       = $this->getDailyMoney($post['destination_name'],$post['jenis_perjalanan_dinas'],$post['regional'],$follower['id_group_grade'],$post['pengurusan']);
                $getHeadofDivisionNameFollower = $this->db->where('division_name','EPC')->get('view_master_division')->row_array();
                $get_hotel_cost               = $this->getHotelCost($follower['id_group_grade'],$post['province'],$post['pengurusan'],$post['penginapan']);
                $data_requester[] = [
                    'employeeid'=>$follower['employeeid'],
                    'employee_name'=>$follower['employee_name'],
                    'head_of_division'=>$getHeadofDivisionNameFollower['head_of_division_name'],
                    'head_of_division_id'=>$getHeadofDivisionNameFollower['head_of_division'],
                    'destination_name'=>$post['destination_name'],
                    'days'=>$check_kriteria_follower['days'],
                    'group_grade'=>$follower['group_grade'],
                    'reprentasi_money'=>$post['regional']=="Dalam Negri" ? $reprentasi_money_follower : 0,
                    'province'=>$post['province'],
                    'daily_money'=>$daily_money_follower,
                    'hotel_cost'=>$post['regional']=="Dalam Negri" ? $get_hotel_cost : 0,
                    'vehicle'=>$post['vehicle'],
                    'vehicle_cost'=>$post['regional']=="Dalam Negri" ? 500000 : 0,
                    'vehicle_cost_destination'=>0,
                    'start_date'=>$start_date,
                    'end_date'=>$end_date,
                    'jenis_spj'=>($post['jenis_perjalanan_dinas']=='daily_money') ? 'Dinas' : 'Diklat'
                ];
            }
        }
        $return['data_requester'] = $data_requester;
        $return['spj_doc_number'] = $spj_doc_number;
        $return['start_date'] = $start_date;
        #json_exit($return);
        return $return;
    }
    
    public function ajax_caculate_spj(){
        $this->layout = 'none';
        if($this->input->post() && $this->input->is_ajax_request()){
            $post = $this->input->post();

            $do_calculation = $this->generateCalculation($post);

            $html_document = $this->generateDocumentSPJ($do_calculation['spj_doc_number'],$do_calculation['data_requester'],$do_calculation['start_date'],$post['regional']);
            $return['html'] = $html_document;
            //$data_req_spj = array_merge($data_requester,$data_follower);
            // echo $reprentasi_money;
            json_exit($return);
        }
    }

    private function generateTabelSPJ($value=[],$regional,$start_date){
        
        $html ='<div class="content_document"><div class="col-lg-12">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">Uraian Biaya </th>
                                <th class="text-center">Jumlah Uang</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Uang Harian '.$value['jenis_spj'].'<br>
                                    '.$value['destination_name'].' <br>
                                    Rp. '.number_format($value['daily_money'],2,',','.').' x '.$value['days'].' <br>
                                </td>
                                <td>
                                    Rp. '.number_format($value['daily_money'] * $value['days'],2,',','.').'
                                </td>
                            </tr>';
                        if($regional=="Dalam Negri"){

                        
                            $html .= '<tr>
                                <td>
                                    Uang Representasi <br>
                                    '.$value['group_grade'].' <br>
                                    Rp. '.number_format($value['reprentasi_money'],2,',','.').' x '.$value['days'].' <br>
                                </td>
                                <td>
                                    Rp. '.number_format($value['reprentasi_money'] * $value['days'],2,',','.').'
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Uang Hotel ( Maksimal ) <br>
                                    '.$value['province'].' <br>
                                    Rp. '.number_format($value['hotel_cost'],2,',','.').' x '.$value['days'].' <br>
                                </td>
                                <td>
                                    Rp. '.number_format($value['hotel_cost'] * $value['days'],2,',','.').'
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Uang Transport  <br>
                                    '.$value['province'].' <br>
                                    Rp. '.number_format($value['vehicle_cost'] + $value['vehicle_cost_destination'],2,',','.').' <br>
                                </td>
                                <td>
                                    Rp. '.number_format($value['vehicle_cost'] + $value['vehicle_cost_destination'],2,',','.').'
                                </td>
                            </tr>';
                            $total_amount =   (($value['reprentasi_money']+$value['daily_money']+$value['hotel_cost']) * $value['days'])+$value['vehicle_cost'] + $value['vehicle_cost_destination'];
                        }else{
                            $total_amount = $value['daily_money'] * $value['days'];
                        }
                            $html .='<tr>
                                <td>
                                    Jumlah
                                </td>
                                <td>
                                    Rp. '.number_format($total_amount,2,',','.').'
                                </td>
                            </tr>
                        </tbody>
                    
                    </table> 
                    <p>Yang bertanda tangan dibawah ini bertanggung jawab sepenuhnya terhadap kebenaran Biaya Perjalanan ini, yang semuanya dilaksanana untuk keperluan Dinas, dan dibuat dalam rangkap 2 (dua).</p>   
                        </div>
                        <div class="col-lg-12 footer_doc" >
                            <div class="text-center">
                            <p>Mengetahui,</p>
                            <p>Divisi EPC</p>
                            
                            <label style="margin-top: 100px;">'.$value['head_of_division'].' </label>
                            <p>Executive Vice President</p>
                        </div>
                        <div class="text-center">
                            <p>Jakarta, '.date('d M Y',strtotime($start_date)).'</p>
                            
                            <label style="margin-top: 135px;">'.$value['employee_name'].' </label>
                            
                        </div>
                    </div>
                </div>';
    
    return $html;
    
    }

    private function generateDocumentSPJ( $spj_doc_number, $data_requester = array(), $start_date, $regional = 'Dalam Negri' ){
        //debubvar($data_requester);
        $html = '<div class="col-lg-12">
                    <div class="kop_surat">
                        <h3>PERINCIAN BIAYA PERJALANAN DINAS</h3>
                        <h3>BERDASARKAN SURAT TUGAS</h3>
                        <h3>No. : '.$spj_doc_number.' Tanggal : '.date('d M Y',strtotime($start_date)).'</h3> 
                    </div>
                    
                </div>';
        foreach ($data_requester as $key => $value) {
            $html .= $this->generateTabelSPJ($value,$regional,$start_date);
            
            
        }

       return $html; 
    }

    public function validation($id){
        if (!$id) {
            redirect($this->class_path_name);
        }
        $record = $this->SPJ_model->GetSPJ($id);
        // debugvar($record);
        // die();
        if (!$record) {
            redirect($this->class_path_name);
        } 
        
        
        foreach ($record['listTravelBill'] as $key => $value) {
            // foreach ($value['detailTravelBill'] as $x => $y) {
            //     if($y['detail_activity']=='Uang Harian'){
            //         $daily_money = $value['amount'];
            //     }
            //     if($y['detail_activity']=='Uang Reprentasi'){
            //         $reprentasi_money = $value['amount'];
            //     }
            // }
            $data_requester[] = [
                'employeeid'=>$value['employeeid'],
                'employee_name'=>$value['employee_name'],
                'head_of_division'=>$value['head_of_division'],
                'head_of_division_id'=>$value['head_of_division_id'],
                'destination_name'=>$record['sub_regional'].' - '.$record['province'],
                'days'=>$value['days'],
                'reprentasi_money'=>$value['detailTravelBill'][1]['amount'],
                'daily_money'=>$value['detailTravelBill'][0]['amount'],
                'vehicle_cost'=>$value['detailTravelBill'][3]['amount'],
                'hotel_cost'=>$value['detailTravelBill'][2]['amount'],
                'start_date'=>$record['start_date'],
                'end_date'=>$record['end_date']
            ];
        }
        //debugvar($record);
        //die();
        $html_document = $this->generateDocumentSPJ($record['spj_doc_no'],$data_requester,$record['start_date']);
        $record['documentBiayaPerjalananDinas'] = $html_document;
        $this->data['detailSPJ'] = $record;
        //json_exit($data_requester);   
    }

    public function generatePDF(){
        $this->layout = 'none';
        $this->load->library('pdf');
        
        // Load HTML content
        $this->pdf->loadHtml('<h1>Aha</h1>');
        
        // (Optional) Setup the paper size and orientation
        $this->pdf->setPaper('A4', 'landscape');
        
        // Render the HTML as PDF
        $this->pdf->render();
        
        // Output the generated PDF (1 = download and 0 = preview)
        $this->pdf->stream("welcome.pdf", array("Attachment"=>0));
    }

    public function print_document($id){
        $this->layout = 'print_a4';
        if (!$id) {
            redirect($this->class_path_name);
        }
        $record = $this->SPJ_model->GetSPJ($id);
        
        if (!$record) {
            redirect($this->class_path_name);
        }
        $this->data['detailSPJ'] = $record;
        // json_exit($record);
    }

    public function change_status(){
        $this->layout = 'none';
        if($this->input->post() && $this->input->is_ajax_request()){
            $post = $this->input->post();
            $this->db->where('id_spj_online',$post['id_spj_online']);
            $this->db->update('spj_online',['status'=>$post['status']]);

            $data_log_status = [
                'status'=>$post['status'],
                'id_auth_user'=>id_auth_user()
            ];
            $this->db->insert('spj_status_history',$data_log_status);
            $data_log = [
                'id_user'  => $data_log_status['id_auth_user'],
                'id_group' => id_auth_group(),
                'action'   => 'Validation SPJ',
                'desc'     => 'Validation SPJ; ID: '.$id.'; Data: '.json_encode($post),
            ];
            insert_to_log($data_log);
            $return['html'] = alert_box('Success.', 'success');

            json_exit($return);
        }
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
        $record = $this->SPJ_model->GetSPJ($id);
        
        if (!$record) {
            redirect($this->class_path_name);
        }
        
        $this->data['master_employee']    = $this->SPJ_model->GetEmployee();
        $this->data['master_division']    = $this->SPJ_model->GetDivision();
        $this->data['page_title']         = 'Edit';
        $this->data['form_action']        = site_url($this->class_path_name.'/edit/'.$id);
        $this->data['delete_picture_url'] = site_url($this->class_path_name.'/delete_picture/'.$id);
        $this->data['cancel_url']         = site_url($this->class_path_name);
        if ($this->input->post()) {
            $post = $this->input->post();

            if ($this->validateForm($id)) {
                $post['modify_date']   = date('Y-m-d H:i:s');
                $post['id_auth_user']   = id_auth_user();
                $this->SPJ_model->UpdateRecord($id, $post);

                
                // insert to log
                $data_log = [
                    'id_user'  => $post['id_auth_user'],
                    'id_group' => id_auth_group(),
                    'action'   => 'Edit SPJ',
                    'desc'     => 'Edit SPJ; ID: '.$id.'; Data: '.json_encode($post),
                ];
                insert_to_log($data_log);
                // end insert to log
                $this->session->set_flashdata('flash_message', alert_box('Success.', 'success'));

                redirect($this->class_path_name);
            }
        }
        $this->data['template'] = $this->class_path_name.'/create';
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
                        $record = $this->SPJ_model->GetSPJ($id);
                        if ($record) {
                            if ($id == id_auth_user()) {
                                $json['error'] = alert_box('You can\'t delete Your own account.', 'danger');
                                break;
                            } else {
                                if (is_superadmin()) {
                                    $this->SPJ_model->DeleteRecord($id);
                                    $json['success'] = alert_box('Data has been deleted', 'success');
                                    $this->session->set_flashdata('flash_message', $json['success']);
                                    // insert to log
                                    $data_log = [
                                        'id_user'  => id_auth_user(),
                                        'id_group' => id_auth_group(),
                                        'action'   => 'User SPJ',
                                        'desc'     => 'Delete User SPJ; ID: '.$id.';',
                                    ];
                                    insert_to_log($data_log);
                                    // end insert to log
                                } else {
                                    $json['error'] = alert_box('You don\'t have permission to delete this record(s). Please contact the SPJistrator.', 'danger');
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
                'field' => 'employeeid',
                'label' => 'Nama',
                'rules' => 'required',
            ],
            [
                'field' => 'destination',
                'label' => 'Tujuan',
                'rules' => 'required',
            ],
            [
                'field' => 'activityid',
                'label' => 'Tujuan',
                'rules' => 'required',
            ],
            [
                'field' => 'activity_detail',
                'label' => 'Detail Keperluan',
                'rules' => 'required',
            ],
            [
                'field' => 'start_date',
                'label' => 'Tanggal Berangkat',
                'rules' => 'required',
            ],
            [
                'field' => 'end_date',
                'label' => 'Tanggal Selesai',
                'rules' => 'required',
            ],
            [
                'field' => 'vehicle',
                'label' => 'Berangkat dengan',
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
     * form validation check email exist.
     *
     * @param string $string
     * @param int    $id
     *
     * @return bool
     */
    public function check_department_name_exists($string, $id = 0)
    {
        if (!$this->SPJ_model->checkExistsSPJName($string, $id)) {
            $this->form_validation->set_message('check_department_name_exists', '{field} is already exists. Please use different {field}');

            return false;
        }

        return true;
    }
}
/* End of file SPJ.php */
/* Location: ./application/controllers/SPJ.php */
