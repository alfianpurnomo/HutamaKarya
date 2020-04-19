<style type="text/css">
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
                <?php echo form_open($form_action, 'id="form-spj" role="form" enctype="multipart/form-data"'); ?>
                    <div class="row">
                        <ul class="nav nav-tabs" id="myTabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#spj_form" aria-controls="hotels" role="tab" data-toggle="tab">Formulir SPJ</a>
                            </li>
                            <li role="presentation">
                                <a href="#calculation" aria-controls="type" role="tab" data-toggle="tab">Kalkulasi Uang Jalan</a>
                            </li>
                            
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="spj_form">
                                <div class="col-lg-6 col-md-6  col-xs-12">
                                <div class="form-group">
                                        <label for="nama">Jenis Perjalanan Dinas <span class="text-danger">*</span></label>
                                        
                                        <select class="form-control" name="jenis_perjalanan_dinas" id="jenis_perjalanan_dinas" required="required">
                                            <option value="0">Pilih </option>
                                            <option value="daily_money">Dinas</option>
                                            <option value="diklat_money">Diklat</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama <span class="text-danger">*</span></label>
                                        <div id="detailEmp"></div>
                                        <select class="form-control" name="employeeid" id="employeeid" required="required">
                                            
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="jabatan">Jabatan <span class="text-danger">*</span></label>
                                        <input type="text" name="jabatan"  readonly=""   value="" class="form-control" id="jabatan_text">
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="destination">Tujuan <span class="text-danger">*</span></label>
                                        <select class="form-control" name="destination" id="destination" required="required">
                                            
                                        </select>
                                        <div id="detailDestination"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="pengurusan">Pengurusan <span class="text-danger">*</span></label>
                                        <select class="form-control" name="pengurusan" id="pengurusan" required="required">
                                            <option value="0">Pilih</option>
                                            <option value="Sendiri">Sendiri</option>
                                            <option value="Kantor">Kantor</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="penginapan">Tempat Menginap <span class="text-danger">*</span></label>
                                        <select class="form-control" name="penginapan" id="penginapan" required="required">
                                            <option value="0">Pilih</option>
                                            <option value="Rumah">Di Rumah</option>
                                            <option value="Hotel">Hotel</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="activity">Keperluan <span class="text-danger">*</span></label>
                                        <select class="form-control" name="activityid" id="activityid" required="required">
                                            
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="activity_detail">Detail Keperluan <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="activity_detail" id="activity_detail" required="required">
                                            
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="follower">Pengikut<span class="text-danger">*</span></label>
                                        <select class="form-control"  id="follower">
                                            
                                        </select>
                                        <a id="addFollower" class="btn btn-success"><i class="fa fa-plus"></i></a>
                                    </div>
                                    <div class="form-group" id="wrap_function">
                                        <!-- <div id="<?=$div_id?>" class="item-function">
                                            <div class="col btn btn-info" >
                                                asdasd asdadsad asdasdasd asdasdsadasa asdasdasdasdasd 
                                            </div>
                                            <div class="col close-location">
                                                <span data-id="<?php echo $value['id_auth_menu_function'];?>" class="deleteFunctionEdit">x</span>
                                            </div>
                                        </div> -->

                                    </div>

                                </div>
                                <div class="col-lg-6 col-md-6  col-xs-12">
                                    <div class="form-group">
                                        <label for="start_date">Tanggal Berangkat</label>
                                        <div class="input-group date" >
                                            <input type="text" readonly name="start_date" id="start_date" class="form-control" data-autoclose="1" value="<?php echo (isset($post['start_date'])) ? $post['start_date'] : date('Y-m-d'); ?>" placeholder="Select Date">
                                            <div class="input-group-addon">
                                                <span class="sli-calendar"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="end_date">Tanggal Selesai</label>
                                        <div class="input-group date" >
                                            <input type="text" readonly name="end_date" id="end_date" class="form-control" data-autoclose="1" value="<?php echo (isset($post['end_date'])) ? $post['end_date'] : date('Y-m-d'); ?>" placeholder="Select Date">
                                            <div class="input-group-addon">
                                                <span class="sli-calendar"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Berangat Dengan <span class="text-danger">*</span></label>
                                        <select class="form-control" name="vehicle">
                                            <option>Pilih</option>
                                            <?php
                                            foreach ($master_vehicle as $key => $value) {
                                            ?>
                                                <option <?php echo  ($post['vehicle'] && $post['vehicle']==$value['vehicle_name']) ?  'selected="selected"' : ''; ?> value="<?php echo $value['vehicle_name'] ?>"><?php echo $value['vehicle_name'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <!-- <input type="text" name="vehicle" class="form-control" required="required"> -->
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Tipe Berangkat</label>
                                        <div class="checkbox checkbox-primary">
                                            <input type="checkbox" value="1" class="styled" name="vehicle_type" id="vehicle_type" <?php echo (isset($post['vehicle_type']) && !empty($post['vehicle_type'])) ? 'checked="checked"' : ''; ?>/>
                                            <label>
                                                Bersama-sama
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <a id="calculate" class="btn btn-info">Calculate</a>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="calculation">
                                
                                
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-xs-12 col-lg-offset-9">
                                <button type="submit" class="btn btn-social btn-success">
                                    Submit
                                    <span class="fa fa-hdd-o"></span>
                                </button>
                                <a class="btn btn-labeled btn-warning btn-rounded" href="<?php echo $cancel_url; ?>"><span class="btn-label"><i class="fa fa-arrow-left"></i></span>Back</a>
                            </div>
                    </div>
                <?php echo form_close(); ?>
                <!-- end form for Admin -->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#employeeid').select2({
            placeholder: 'Pilih karyawan',
            ajax: {
              url: "<?php echo site_url('SPJ/ajax_get_employee') ?>",
              dataType: 'json',
              delay: 250,
              data: function (params) {
                var query = {
                    search: params.term,
                    type: 'public',
                    q:params.q
                }

                  // Query parameters will be ?search=[term]&type=public
                  return query;
              },
              processResults: function (data) {
                return {
                  results: data
                };
              },
              cache: false
            }
        });

        var entityEmployee =(data)=>{
            var html = '<input type="hidden" id="grade" name="grade" value="'+data.grade+'">\
                        <input type="hidden" id="employee_name" name="employee_name" value="'+data.name+'">\
                        <input type="hidden" id="division" name="division" value="'+data.division+'">\
                        <input type="hidden" id="division_name" name="division_name" value="'+data.division_name+'">\
                        <input type="hidden" id="department_name" name="department_name" value="'+data.department_name+'">\
                        <input type="hidden" id="department" name="department" value="'+data.department+'">\
                        <input type="hidden" id="group_grade" name="group_grade" value="'+data.group_grade+'">\
                        <input type="hidden" id="id_group_grade" name="id_group_grade" value="'+data.id_group_grade+'">';
            return html;
            
        }

        $('#employeeid').change(function(){
            var text = $(this).select2('data');
            //console.log(text);
            var html = entityEmployee(text[0]);
            $('#detailEmp').html(html);
            $('#jabatan_text').val(text[0].jobs_name);
            
        });

        //END EMPLOYEE


        //START TUJUAN
        $('#destination').select2({
            placeholder: 'Pilih tujuan',
            ajax: {
              url: "<?php echo site_url('SPJ/ajax_get_destination') ?>",
              dataType: 'json',
              delay: 250,
              data: function (params) {
                var query = {
                    search: params.term,
                    type: 'public',
                    q:params.q
                }

                  // Query parameters will be ?search=[term]&type=public
                  return query;
              },
              processResults: function (data) {
                return {
                  results: data
                };
              },
              cache: false
            }
        });
        $('#destination').change(function(){
            var text = $(this).select2('data');
            var destination_name = text[0].sub_regional;
            var province = text[0].province;
            var regional = text[0].regional;
            var html = '<input name="destination_name" value="'+destination_name+'" id="destination_name" type="hidden"/>\
                        <input name="province" value="'+province+'" id="province" type="hidden"/>\
                        <input name="regional" value="'+regional+'" id="regional" type="hidden"/>';
            $('#detailDestination').html(html);
        });
        //END TUJUAN


        //START ACTIVITY
        $('#activityid').select2({
            placeholder: 'Pilih Keperluan',
            ajax: {
              url: "<?php echo site_url('SPJ/ajax_get_activity') ?>",
              dataType: 'json',
              delay: 250,
              data: function (params) {
                var query = {
                    search: params.term,
                    type: 'public',
                    q:params.q
                }

                  // Query parameters will be ?search=[term]&type=public
                  return query;
              },
              processResults: function (data) {
                return {
                  results: data
                };
              },
              cache: false
            }
        });
        //END ACTIVITY


        //PENGIKUT
        $('#follower').select2({
            placeholder: 'Pilih karyawan',
            ajax: {
              url: "<?php echo site_url('SPJ/ajax_get_employee') ?>",
              dataType: 'json',
              delay: 250,
              data: function (params) {
                var query = {
                    search: params.term,
                    type: 'public',
                    q:params.q
                }

                  // Query parameters will be ?search=[term]&type=public
                  return query;
              },
              processResults: function (data) {
                return {
                  results: data
                };
              },
              cache: false
            }
        });

        $('#addFollower').click(function(){
            var n           = $('#wrap_function .item-function').length;
            var data_emp    = $('#follower').select2('data');
            var data        = data_emp[0];
            
            //console.log(data_emp);
            var row = n +1;
            var div_id = 'list-function-'+data.id;
            var name_element = 'listFollower['+data.id+']';

            var html = '<div id="'+div_id+'" class="item-function">\
                            <div class="col btn btn-info" >\
                                '+data.text+'\
                            </div>\
                            <div  class="col close-location">\
                                <span data-wrap="'+div_id+'" class="deleteFollower">x</span>\
                            </div>\
                                <input type="hidden" name="'+name_element+'[employeeid]"  value="'+data.id+'">\
                                <input type="hidden" name="'+name_element+'[employee_name]"  value="'+data.name+'">\
                                <input type="hidden" name="'+name_element+'[grade]"  value="'+data.grade+'">\
                                <input type="hidden" name="'+name_element+'[division]" value="'+data.division+'">\
                                <input type="hidden" name="'+name_element+'[division_name]" value="'+data.division_name+'">\
                                <input type="hidden" name="'+name_element+'[department_name]" value="'+data.department_name+'">\
                                <input type="hidden" name="'+name_element+'[department]" value="'+data.department+'">\
                                <input type="hidden" id="department" name="'+name_element+'[group_grade]" value="'+data.group_grade+'">\
                                <input type="hidden" id="department" name="'+name_element+'[id_group_grade]" value="'+data.id_group_grade+'">\
                            </div>';
            if(data.text !=''){
                if($('#'+div_id).length == 0){
                    $('#wrap_function').append(html);
                }
                
            }
        });

        //END PENGIKUT

        $('#start_date,#end_date').datepicker({
            autoclose:($(this).attr("data-autoclose") == "1" ? true : false),
            format: 'yyyy-mm-dd'
        });

        //CALCULATION
        $('#calculate').click(function(){
            $('.loading').show();
            var data = $('#form-spj').serializeArray();
            ajax_post("<?php echo site_url('SPJ/ajax_caculate_spj') ?>",data).
                done(function(result){
                    if(result['html']){
                        var html = result['html'];
                        $('#calculation').html(html);
                        // $('.saveAction').prop('disabled',false);
                        
                    }       
                }).
                fail(function(){
                    custom_alert('Error');
                });
            //console.log(data);
            $('#myTabs a[href="#calculation"]').tab('show');
            $('.loading').hide();
        })
        //END CALCULATION


        
    })

</script>
