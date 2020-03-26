<?php
public function ajax_optic_open_save(){
        $this->layout = 'none';
        if($this->input->post() && $this->input->is_ajax_request()){
            $post = array_map('trim', $this->input->post()); 
        
            $nott = $this->getTTid();
            $ttid = "OTH-".date('Y/m/d')."-".$nott;

            $val_data = array(
                "tt_id" => ($ttid),
                "tt_sev" => '"1"',
                "tt_create" => date("Y-m-d H:i:s"),
                "tt_start" => (date("Y-m-d", strtotime($post['f_add_date_occured']))." ".date("H:i", strtotime($post['f_add_time_occured'])).":00"),
                "tt_ne_type" => '"0"',
                "tt_ne_id" => ($post['f_add_object']),
                "tt_ref_id" => '""',
                "tt_alm_src" => '"2"',
                "tt_alm_event_id" => '""',
                "tt_alm_id" => '""',
                "tt_alm_desc" => ($post['f_add_description']),
                "tt_alm_serv" => ($post['f_add_affected']),
                "tt_res_grp" => ($post['f_add_resp_grp']),
                "tt_res_oth" => ($post['f_add_oth_mail']),
                "tt_pic" => ($post['f_add_pic']),
                "tt_remarks" => ($post['f_add_suspect']),
                "tt_rc" => '""',
                "tt_close" => '"0000-00-00 00:00:00"',
                "tt_closing" => '"0000-00-00 00:00:00"',
                "tt_solution" => '""',
                "tt_creator" => $_SESSION["id"],
                "tt_closer" => '""',
                "tt_stat" => 1
            );
            $q_ticket = $this->TT_M->GetFromTabel('count(tt_id) as cnt','tbl_tt_oth',array('tt_ne_id'=>$val_data['tt_ne_id'],'tt_res_grp'=>$val_data['tt_res_grp'],'tt_start'=>$val_data['tt_start']),array(),'','','SINGEL');#$DBC->query_single('SELECT count(tt_id) as cnt FROM tbl_tt_oth WHERE tt_ne_id='.$val_data['tt_ne_id'].' AND tt_res_grp = '.$val_data['tt_res_grp'].'  AND tt_start = '.$val_data['tt_start'].';');
            if($q_ticket) {
                if ($q_ticket['cnt'] == 0) {
                    $exec = $this->TT_M->InsertTabel($val_data,'tbl_tt_oth');

                    if($exec['status']==TRUE) {
                        $out_data['status']     = $exec['status'];
                        $out_data['txt_status'] = $exec['txt_status'];

                        $getTicket = $this->getDetailTicketOptic($ttid);
                        
                        $sendmail = $this->sendEmailOptic($getTicket,'OPEN');
                        
                        $data_log = array(
                            'id_user'  => id_auth_user(),
                            'id_group' => id_auth_group(),
                            'action'   => 'Open Optic Ticket',
                            'desc'     => 'Open Optic Ticket; Ticket ID: '.$ttid.'; Data: '.json_encode($post),
                        );
                        insert_to_log($data_log);
                        $out_data['result'] = 'OK';
                        json_exit($out_data);
                        
                    }
                    else {
                        $out_data['result'] = $out_data['txt_status'];
                        json_exit($out_data);
                    }
                } else {
                    set_json_response("ERROR", "Alarm Already Created");
                }
            }
            
        }
    }
    private function getDetailTicketOptic($tt_id){
        if($tt_id){
            $q_tt = $this->TT_M->GetFromTabel('*','tbl_tt_oth',array('tt_id'=>$tt_id),array(),'no','DESC','SINGEL');
        }
        return $out_data['ticketDetail'] = $q_tt;
    }

    private function sendEmailOptic($data,$type='OPEN'){
        
        $ttid = $data['tt_id'];
        $val_data = $data;
        $val_data['tt_ne_id'] = $this->resNode($DBC,explode(",", $val_data['tt_ne_id']));
        $val_data['resGrp'] = $this->resGrp($DBC,explode(",", $val_data['tt_res_grp']));
        $result = array();
        
        $title = "Dummy [OTH]-[".$type."] ".$ttid." - ".$val_data['tt_ne_id'];
        $subject = $title;
        $html = '';
        $html .= "
        <table style='border:1px solid #000;border-collapse:collapse;'>
            <thead>
                <tr>
                    <th colspan='2' style='border:1px solid #000;padding:5px;'>".$title."</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style='border:1px solid #000;padding:5px;'>Ticket No.</td>
                    <td style='border:1px solid #000;padding:5px;'>".$val_data['tt_id']."</td>
                </tr>
                <tr>
                    <td style='border:1px solid #000;padding:5px;'>Occured Time</td>
                    <td style='border:1px solid #000;padding:5px;'>".$val_data['tt_start']."</td>
                </tr>
                <tr>
                    <td style='border:1px solid #000;padding:5px;'>Object</td>
                    <td style='border:1px solid #000;padding:5px;'>".$val_data['tt_ne_id']."</td>
                </tr>
                <tr>
                    <td style='border:1px solid #000;padding:5px;'>Service Affected</td>
                    <td style='border:1px solid #000;padding:5px;'>".$val_data['tt_alm_serv']."</td>
                </tr>
                <tr>
                    <td style='border:1px solid #000;padding:5px;'>Suspect</td>
                    <td style='border:1px solid #000;padding:5px;'>".$val_data['tt_alm_desc']."</td>
                </tr>
                <tr>
                    <td style='border:1px solid #000;padding:5px;'>Responsible Group</td>
                    <td style='border:1px solid #000;padding:5px;'>".$val_data['resGrp']."</td>
                </tr>
                <tr>
                    <td style='border:1px solid #000;padding:5px;'>Others Res. Group</td>
                    <td style='border:1px solid #000;padding:5px;'>".$val_data['tt_res_oth']."</td>
                </tr>
                <tr>
                    <td style='border:1px solid #000;padding:5px;'>PIC</td>
                    <td style='border:1px solid #000;padding:5px;'>".$val_data['tt_pic']."</td>
                </tr>
            </tbody>
        </table>
        ";
        $resAddr = $this->getRespAddr($data['ticketDetail']['res_grp']);
        
        $sender = array(
                    array(
                        'name'=>'NOC INTERNUX',
                        'email'=>'inx-op_noc@boltsuper4g.com'
                    )
                );
        $rcpt = array(
                    array(
                        'name'=>'NOC INTERNUX',
                        'email'=>'inx-op_noc@boltsuper4g.com'
                    )
                );
        $rcpt = array_merge($rcpt,$sender);
        $oth_mail = array();
        if(!empty($data['ticketDetail']['mail_oth'])){
            $oth_mail = array(
                            array(
                                    'name'=>'',
                                    'email'=>$data['ticketDetail']['mail_oth']
                                )
                        );
        }
        $rcpt = array_merge($oth_mail,$rcpt);
        
        $cc = array( array(
                            'name'=>'Alfian Purnomo',
                            'email'=>'alfian.purnomo@boltsuper4g.com'
                        ),
                    array(
                            'name'=>'Martayedo Idris',
                            'email'=>'martayedo.idris@bolt.id'
                        ),
                    array(
                            'name'=>'Khalil',
                            'email'=>'khalil@bolt.id'
                        ),
                    array(
                            'name'=>'Taufan Aji',
                            'email'=>'taufan.aji@bolt.id'
                        ),
                    array(
                            'name'=>'Rio Pradipta',
                            'email'=>'rio.pradipta@bolt.id'
                        ),
                    array(
                            'name'=>'Dwi Kuntary',
                            'email'=>'dwi.kuntari@bolt.id'
                        )
                );
        $from   = $sender;
        $to     = $rcpt;
        $body   = $html;
        $mail   = custom_send_email_ci($from,$to,$cc,$subject,$body);
        
        /*if ($mail['result'] == 'OK') {
            $result['result'] = true;
        } else {
            $result['result'] = false;
        }*/

        return $result;
    }