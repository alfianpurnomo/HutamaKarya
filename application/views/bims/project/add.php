<style type="text/css">
    .item-pekerja {
            display: flex;
    margin-top: 5px;
    justify-content: space-between;
    align-items: center;
    }
    .item-pekerja input{
        margin:0 2px 0;
    }
    .close-employee span{
            background: red;
    border: 1px solid red;
    color: white;
    display: inline-block;
    padding: 0px 7px;
    border-radius: 13px;
    }
    .close-employee div{
        text-align: center;
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
                <?php echo form_open($form_action, 'id="form-project" role="form" enctype="multipart/form-data"'); ?>
                    <div class="row">
                        <div class="col-lg-6 col-md-6  col-xs-12">
                            <div class="form-group">
                                <label for="code">Project Code <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="code" id="code" value="<?php echo (isset($post['code'])) ? $post['code'] : ''; ?>" required="required"/>
                            </div>
                            <div class="form-group">
                                <label for="invoice_number">Invoice Number</label>
                                <input type="text" class="form-control" name="invoice_number" id="invoice_number" value="<?php echo (isset($post['invoice_number'])) ? $post['invoice_number'] : ''; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="title">Project Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" id="title" value="<?php echo (isset($post['title'])) ? $post['title'] : ''; ?>" required="required"/>
                            </div>
                            <div class="form-group">
                                <label for="description">Project Description</label>
                                <textarea class="form-control" name="description" id="description"><?php echo (isset($post['description'])) ? $post['description'] : ''; ?></textarea>
                                
                            </div>
                            <div class="form-group"  id="employee_list" <?php echo (isset($post['is_default']) && !empty($post['is_default'])) ? 'style="display: none;"' : ''; ?>>
                                <label for="Assign_to">Assign To</label>
                                <select class="form-control select2Search selectEmployee" id="employee">
                                    <option value="0">Select Employee</option>
                                </select>
                                <div class="wrap-employee">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4  col-xs-12 col-lg-offset-1">
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <div class="input-group date" >
                                    <input type="text" readonly name="start_date" id="start_date" class="form-control" data-autoclose="1" value="<?php echo (isset($post['start_date'])) ? $post['start_date'] : date('Y-m-d'); ?>" placeholder="Select Date">
                                    <div class="input-group-addon">
                                        <span class="sli-calendar"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <div class="input-group date" >
                                    <input type="text" readonly name="end_date" id="end_date" class="form-control" data-autoclose="1" value="<?php echo (isset($post['end_date'])) ? $post['end_date'] : date('Y-m-d'); ?>" placeholder="Select Date">
                                    <div class="input-group-addon">
                                        <span class="sli-calendar"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="checkbox checkbox-primary">
                               <input type="checkbox" value="1" class="styled" name="is_default" id="is_default" <?php echo (isset($post['is_default']) && !empty($post['is_default'])) ? 'checked="checked"' : ''; ?>/>
                                <label>
                                    Default Project
                                </label>
                                
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option <?php echo ($post['status'] == 1) ? 'selected="selected"' : ''; ?> value="1">Open</option>
                                    <option <?php echo ($post['status'] == 2) ? 'selected="selected"' : ''; ?> value="2">Close</option>
                                    <option <?php echo ($post['status'] == 3) ? 'selected="selected"' : ''; ?> value="3">Cancel</option>
                                </select>
                            </div>
                            <div class="checkbox checkbox-primary">
                               <input type="checkbox" value="1" class="styled" name="is_started" id="is_started" <?php echo (isset($post['is_started']) && !empty($post['is_started'])) ? 'checked="checked"' : ''; ?>/>
                                <label>
                                    Started
                                </label>
                                
                            </div>
                            <div class="form-group" style="display: none;" id="wrap_started_date">
                                <label for="started_date">Started Date</label>
                                <div class="input-group date" >
                                    <input type="text"  readonly name="started_date" id="started_date" class="form-control" data-autoclose="1" value="<?php echo (isset($post['started_date'])) ? $post['started_date'] : date('Y-m-d'); ?>" placeholder="Select Date">
                                    <div class="input-group-addon">
                                        <span class="sli-calendar"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-xs-12 col-lg-offset-9">
                                <button type="submit" class="btn btn-social btn-success">
                                    Submit
                                    <span class="fa fa-hdd-o"></span>
                                </button>
                                <a class="btn btn-labeled btn-default btn-rounded" href="<?php echo $cancel_url; ?>"><span class="btn-label"><i class="fa fa-arrow-left"></i></span>Back</a>
                            </div>
                    </div>
                <?php echo form_close(); ?>
                <!-- end form for Admin -->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#employee').select2({
        placeholder: 'Select employee',
        ajax: {
          url: "<?php echo site_url('project/ajax_get_employee') ?>",
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
          cache: false,
          templateSelection: function (data, container) {
            
            $(data.element).attr('data-name', data.name);
            return data.text;
          }
        }
    });

    $(document).on('change','.selectEmployee',function(){
        
        var text = $(this).select2('data');
        //console.log(text);
        var data = {
            text:text[0].text,
            fistname:text[0].fistname,
            lastname:text[0].lastname,
            nik:text[0].nik,
            id:$(this).val()
        }
        var html_location = generateEmployee(data);

        

    });

    var generateEmployee = (data) => {
        var n = $('.wrap-employee .list-employee').length;
        var start_date = $('#start_date').val();
        var end_date    = $('#end_date').val();
        //console.log(data);
        var row = n +1;
        var div_id = 'list-employee-'+row;
        var html = '<div id="'+div_id+'" class="list-employee">\
                        <div class="item-pekerja ">\
                            <div class="col" style="width: 204px;">\
                                <label>'+data.text+'</label>\
                            <input type="hidden" value="'+data.id+'" name="listEmployee['+row+'][employeeid]">\
                            \
                            </div>\
                            <div class="col" >\
                                <label>Role</label>\
                                <select class="form-control selectRole" id="employee_role'+row+'" name="listEmployee['+row+'][employee_role]">\
                                </select>\
                            </div>\
                            <div class="col">\
                                <label>Start Date</label>\
                                <div class="input-group date" >\
                                    <input type="text" readonly id="start_date'+row+'" name="listEmployee['+row+'][start_date]" class="form-control date-pickers" data-autoclose="1" value="<?php echo date('Y-m-d'); ?>" placeholder="Select Date">\
                                    <div class="input-group-addon">\
                                        <span class="sli-calendar"></span>\
                                    </div>\
                                </div>\
                            </div>\
                            <div class="col">\
                                <label>End Date</label>\
                                <div class="input-group date" >\
                                    <input type="text" readonly id="end_date'+row+'" name="listEmployee['+row+'][end_date]" class="form-control date-pickers" data-autoclose="1" value="<?php echo date('Y-m-d'); ?>" placeholder="Select Date">\
                                    <div class="input-group-addon">\
                                        <span class="sli-calendar"></span>\
                                    </div>\
                                </div>\
                            </div>\
                            <div class="col close-employee">\
                                <span class="deleteEmployee" data-wrap="'+div_id+'">x</span>\
                            </div>\
                        </div>\
                    </div>';
        if($('.wrap-employee #'+div_id).length===0){
            $('.wrap-employee').append(html);    
        }else{
            //console.log('sd')
            
        }
        $('#employee_role'+row).select2({
            placeholder: 'Select Role',
            ajax: {
              url: "<?php echo site_url('project/ajax_get_role') ?>",
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
        var minDate = new Date(start_date);
        var maxDate = new Date(end_date);
        //$('.date-pickers').datepicker('setStartDate',minDate);
        $('.date-pickers').datepicker({
            autoclose:($(this).attr("data-autoclose") == "1" ? true : false),
            format: 'yyyy-mm-dd',
            endDate: maxDate,
            startDate: minDate,
        });
        $("#form-project").validationEngine();
        

    }

    $(document).on('click','.deleteEmployee',function(){
        
        var wrap = $(this).data('wrap');
        var string_parent = '#'+wrap;
        //console.log(string_parent);
        $(string_parent).remove();

    });
    $(document).ready(function(){
        $("#is_started").click( function(){
            if( $(this).is(':checked') ) {
                $('#wrap_started_date').show();
            }else{
                $('#wrap_started_date').hide();
            }
        });
        $("#is_default").click( function(){
            if( $(this).is(':checked') ) {
                $('#employee_list').hide();
            }else{
                $('#employee_list').show();
            }
        });
        $('#start_date,#end_date,#started_date').datepicker({
            autoclose:($(this).attr("data-autoclose") == "1" ? true : false),
            format: 'yyyy-mm-dd'
        });
        $('#start_date').change(function(){
     
            // Get value
            var start_date = $(this).val();
            var maxDate = $("#end_date").val();

            // Set minDate and maxDate
            if(start_date != ''){
                $('#end_date,#started_date').datepicker('setStartDate', new Date(start_date));
            }

            if($('.date-pickers').length){
                $('.date-pickers').each(function(index,element){
                    $(element).datepicker('setStartDate', new Date(start_date));
                    $(element).datepicker('setEndDate', new Date(maxDate));
                })
            } 
            
         }); 

        $('#end_date').change(function(){
     
            // Get value
            var start_date = $('#start_date').val();
            var maxDate = $(this).val();
            if($('.date-pickers').length){
                $('.date-pickers').each(function(index,element){
                    $(element).datepicker('setStartDate', new Date(start_date));
                    $(element).datepicker('setEndDate', new Date(maxDate));
                })
            } 
            $('#started_date').datepicker('setEndDate', new Date(maxDate));
            
         });

    });
    

</script>
