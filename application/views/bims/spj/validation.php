<style type="text/css">
    .head_document{
        margin: 0 auto;
    }
    .document_title{
        text-align: center;
        font-size: 15px;
        font-weight: 600;
    }
    .document_number{
        text-align: center;
        font-size: 15px;
    }
    .body_document{
        margin: 0 auto;
    }
    .footer_document{
        margin: 0 auto;
    }
    .detail_spj{
        width: 50%;
        margin: 0 auto;
        line-height: 1.5;
    }
    .row_item{
        display: flex;
        flex-direction: row;

    }
    .title_item{
        width: 30%;
    }
    .value_item{
        width: 70%;
    }
    .legal_section{
        padding-left: 60%;
    }
    .footer_document .row_item{
        padding-left: 41%;
    }
    .footer_document .title_item{
        width: 20%;
    }

    #wrap_function{
        display: flex;
        margin-top: 20px;
        padding: 10px;
        flex-wrap: wrap;
        justify-content: space-between;
    }
    .item-function{
        display: flex;
        position: relative;
        margin-right: 20px;
        margin-bottom: 20px;

    }
    .close-location{
        position: absolute;
        right: -11px;
        top: -11px;
    }
    .close-location span{
        background: red;
        border: 1px solid red;
        color: white;
        display: inline-block;
        padding: 0px 7px;
        border-radius: 13px;
    }
    .close-location div{
        text-align: center;
    }
    .kop_surat h3 {
        font-size: initial;;
    }
    .kop_surat {
        text-align: center;
        margin-bottom: 20px;
    }
    .footer_doc{
        display: flex;
        flex-direction: row;
        justify-content: space-around;
    }

    .content_document{
        display: block;
        float: left;
        border: 1px solid #ccc;
        margin: 10px 0px 30px 0px;
        padding: 10px 0px;
    }

</style>
<div class="row">
    <div class="col-lg-12">
        <div class="form-message .form_message">
            <?php
            if (isset($form_message)) {
                echo $form_message;
            }
            ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo $page_title?> form</h2>

            </div>
            <div class="panel-body">
                <!-- start form for Admin -->

                <!-- <?php echo form_open($form_action, 'id="form-spj" role="form" enctype="multipart/form-data"'); ?> -->
                    <div class="row">
                        <ul class="nav nav-tabs" id="myTabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#spj_form" aria-controls="spj_form" role="tab" data-toggle="tab">Detail SPJ</a>
                            </li>
                            <li role="presentation">
                                <a href="#calculation" aria-controls="calculation" role="tab" data-toggle="tab">Kalkulasi Uang Jalan</a>
                            </li>
                            
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="spj_form">
                                <div class="col-lg-12 col-md-12  col-xs-12">
                                    <div class="head_document">
                                        <h3 class="document_title">
                                            SURAT PERINTAH JALAN
                                        </h3>
                                        <h3 class="document_number">
                                            <?php echo $detailSPJ['spj_doc_no']; ?>
                                        </h3>
                                    </div>
                                    <div class="body_document form-inline">
                                        
                                        <div class="detail_spj">
                                            <p>Diperintahkan kepada: </p>
                                            <div class="row_item">
                                                <div class="title_item">Nama</div>
                                                <div class="value_item">
                                                    : &nbsp;<?php echo $detailSPJ['employee_requested']; ?>
                                                </div>
                                            </div>
                                            <div class="row_item">
                                                <div class="title_item">Jabatan</div>
                                                <div class="value_item">
                                                    : &nbsp;<?php echo $detailSPJ['jobs_name']; ?>
                                                </div>
                                            </div>
                                            <div class="row_item">
                                                <div class="title_item">Tujuan</div>
                                                <div class="value_item">
                                                    : &nbsp;<?php echo $detailSPJ['sub_regional'].' - '.$detailSPJ['province']; ?>
                                                </div>
                                            </div>
                                            <div class="row_item">
                                                <div class="title_item">Keperluan</div>
                                                <div class="value_item">
                                                    : &nbsp;<?php echo $detailSPJ['activity_name']; ?>
                                                </div>
                                            </div>
                                            <div class="row_item">
                                                <div class="title_item">Pengikut</div>
                                                <div class="value_item">
                                                    : &nbsp;<?php echo $detailSPJ['dataFollower']; ?>
                                                </div>
                                            </div>
                                            <div class="row_item">
                                                <div class="title_item">Berangkat</div>
                                                <div class="value_item">
                                                    : &nbsp; <?php echo date('d M Y',strtotime($detailSPJ['start_date'])); ?>
                                                </div>
                                            </div>
                                            <div class="row_item">
                                                <div class="title_item">Dengan</div>
                                                <div class="value_item">
                                                    : &nbsp;<?php echo $detailSPJ['vehicle']; ?>
                                                </div>
                                            </div>
                                            <p>Harap yang berkepentingan menjadi maklum dan memberikan bantuan secukupnya.</p>
                                        </div>
                                        
                                        <div class="legal_section">
                                            <div class="row_item">
                                                <div class="title_item">Dikeluarkan di</div>
                                                <div class="value_item">
                                                    : &nbsp; Jakarta
                                                </div>
                                            </div>
                                            <div class="row_item">
                                                <div class="title_item">Pada tanggal</div>
                                                <div class="value_item">
                                                    : &nbsp;<?php echo date('d M Y',strtotime($detailSPJ['end_date'])); ?>
                                                </div>
                                            </div>
                                            <p>PT. HUTAMA KARYA (Persero)</p>
                                            <p style=" margin-bottom: 100px;">Divisi Engineering, Procruitment, dan Consructions</p>

                                            <p><?php echo strtoupper($detailSPJ['head_of_division_name']) ?></p>
                                            <p><?php echo $detailSPJ['jobs_name_head'] ?></p>
                                        </div>
                                    </div>
                                    <div class="footer_document">
                                        
                                    </div>
                                 </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="calculation">
                                
                                <?php echo $detailSPJ['documentBiayaPerjalananDinas']; ?>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <div class="row_item">
                                <div class="message_action"></div>
                            </div>
                            <div class="row_item">
                                <div class="title_item">Status Dokumen</div>
                                <div class="value_item">
                                    : &nbsp; <?php echo $detailSPJ['status']; ?>
                                </div>
                            </div>
                            <div class="row_item" style="display: inherit;">
                                <?php
                                    if((is_superadmin() || id_auth_group()==2) && $detailSPJ['status']=="REQUESTED"){

                                    
                                ?>
                                <a data-id_spj_online="<?php echo $detailSPJ['id_spj_online']; ?>" data-status="APPROVED" class="changeStatus btn btn-success">APPROVE</a>
                                <a data-id_spj_online="<?php echo $detailSPJ['id_spj_online']; ?>" data-status="REJECTED" class="changeStatus btn btn-danger">REJECT</a>
                                <?php
                                    }
                                ?>
                                <?php
                                    if($detailSPJ['status']=="APPROVED"){
                                ?>
                                    <a href="<?php echo site_url('/spj/print_document/'.$detailSPJ['id_spj_online'])?>"  class="btn btn-success">PRINT</a>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                <!-- <?php echo form_close(); ?> -->
                <!-- end form for Admin -->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        

        //CHANGE STATUS
        $('.changeStatus').click(function(){
            $('.loading').show();
            var data = [
                        {name:'id_spj_online',value:$(this).data('id_spj_online')},
                        {name:'status',value:$(this).data('status')}];
            ajax_post("<?php echo site_url('SPJ/change_status') ?>",data).
                done(function(result){
                    if(result['html']){
                        $('.message_action').html(result['html']);
                    }
                    windows.reload()
                }).
                fail(function(){
                    custom_alert('Error');
                });
            $('.loading').hide();
        })
        //END CHANGE STATUS


        
    });

</script>
