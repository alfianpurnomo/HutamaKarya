<link href="<?php echo $VENDOR_URL; ?>clockpicker/clockpicker.css" rel="stylesheet">
<script src="<?php echo $VENDOR_URL; ?>clockpicker/clockpicker.js"></script>
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
                <?php echo form_open($form_action, 'role="form" enctype="multipart/form-data"'); ?>
                    <div class="row">
                        <div class="col-lg-12 col-md-12  col-xs-12">
                            <a class="btn btn-success" id="addTime"><i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6" id="warp-time">
                            <?php
                                if($post['time']){
                                    $data_time = json_decode($post['time']);
                                    /*debugvar($data_time);*/
                                    foreach ($data_time->time as $key => $value) {
                                        echo '<div class="form-group" id="time_from_group'.$key.'"> 
                                                <a class="deleteTime btn btn-danger" data-target="#time_from_group'.$key.'"><i class="fa fa-trash"></i></a>
                                                <div class="input-group"> 
                                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i> </span> 
                                                    <input type="text" class="form-control mandatory_input time_field" name="time['.$key.']" required="" value="'.$value.'"> 
                                                </div>
                                        </div>';
                                    }
                                }
                            ?>
                            
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
  $('#addTime').click(function () {
        var n = $('#warp-time .form-group').length;
        var id = 'time_from_group'+n;
        var html = '<div class="form-group" id="'+id+'">\
                        <a class="deleteTime btn btn-danger" data-target="#'+id+'"><i class="fa fa-trash"></i></a>\
                            <div class="input-group">\
                                <span class="input-group-addon">\
                                    <i class="fa fa-clock-o"></i>\
                                </span>\
                                <input type="text" class="form-control mandatory_input time_field"  name="time[]"  required="">\
                            </div>\
                        </div>';
        $('#warp-time').append(html);
        $('.time_field').clockpicker({
            autoclose: true,
            'default': 'now',
            beforeShow: function() {
                setTimeout(function(){
                    $('.clockpicker-popover').css('z-index', 99999999999999);
                }, 0);
            }
        });
    });
  $(document).on('click','.deleteTime',function(){
    var target = $(this).data('target');
    $(target).remove();
  });
  $('.time_field').clockpicker({
            autoclose: true,
            'default': 'now',
            beforeShow: function() {
                setTimeout(function(){
                    $('.clockpicker-popover').css('z-index', 99999999999999);
                }, 0);
            }
        });  

</script>
