<style type="text/css">
    .wrap_activity{
        display: flex;
        flex-direction: column;

    }
    .item-activity{
        display: flex;
        flex-direction: row;
        margin-bottom: 20px;
    }
    .col{
        margin : 0 15px;
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
    .fileinput{
    display:block !important;
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
                        <div class="col-lg-12">
                            <a id="addActivity" style="margin-bottom: 20px" class="col-lg-offset-9 btn btn-success">Tambah Keperluan</a>
                            <div class="wrap_activity">
                                
                                <!-- <div class="item-activity">
                                   <div class="col">
                                        <label>Keterangan Biaya</label>
                                        <textarea class="form-control"></textarea>
                                    </div>
                                    <div class="col">
                                        <label>Jumlah</label>
                                        <input class="form-control" type="number" name=""> 
                                    </div>
                                    <div class="col">
                                        <label>No Kwitansi</label>
                                        <input class="form-control" type="text" name=""> 
                                    </div>
                                    <div class="col">
                                        <label>Upload Bukti Scan Kwitansi</label>
                                        <input class="form-control" type="file" name=""> 
                                    </div>
                                    <div  class="col close-location">
                                        <span  class="deleteActivity">x</span>
                                    </div> 
                                </div> -->
                                

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <a id="calculate" class="btn btn-success">Calculate</a>
                        </div>
                    </div>
                    <div class="row">
                         <div class="">
                            <div class="col-lg-12">
                                <table id="tabel_lpd" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Uraian Biaya </th>
                                            <th class="text-center">Jumlah Uang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php 
                                        foreach ($post['detailTravelBill'] as $x => $y) {
                                            $total_amount += ($y['final_amount'])
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $y['detail_activity'] ?> <br>
                                                
                                                <?php 
                                                if($y['detail_activity']=='Uang Harian'){

                                                ?>
                                                <?php echo $post['sub_regional'] ?> - <?php echo $post['province'] ?> <br>
                                                <?php 
                                                } 
                                                ?>
                                                Rp. <?php 
                                                if($y['detail_activity']=='Uang Harian' || $y['detail_activity']=='Uang Reprentasi'){
                                                    $description_amount = number_format($y['amount'],2,',','.').' x '.$post['days'].' hari';
                                                }else{
                                                    $description_amount = number_format($y['amount'],2,',','.');
                                                }
                                                echo $description_amount;
                                                ?> <br>
                                                <?php
                                                if($y['file_attachment']){
                                                ?>
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail fileinput-upload" style="width: 200px; height: 150px;">
                                                        <?php if (isset($y['file_attachment']) && $y['file_attachment'] != '' ) : ?>
                                                            <img src="<?php echo URL_IMAGE_LPD.$y['file_attachment'] ?>" class="post-image" />
                                                            <!-- <span class="btn btn-danger btn-delete-photo" id="delete-picture" data-id="<?php echo $y['id_detail_travel_bill']; ?>">x</span> -->
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <?php
                                                    
                                                }
                                                ?>
                                            </td>
                                            <td class="text-right">
                                                Rp. <?php echo number_format($y['final_amount'],2,',','.') ?>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                        
                                        <tr>
                                            <td>
                                                Jumlah <br>
                                                
                                            </td>
                                            <td id="total_amount_td" class="text-right">
                                                Rp. <?php echo number_format($total_amount,2,',','.') ?>
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                
                                </table> 
                                <input type="hidden" id="total_amount" name="total_amount" value="<?php echo $total_amount?>">
                                <input type="hidden"  name="id_travel_bill" value="<?php echo $post['id_travel_bill']?>">
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
        var generateActivity = (x) => {
            var n = '';
            if(x==0){

                n  = $('.wrap_activity .item-activity').length;
            }else{
                n  = x;
            }


            var component_name = 'listActivity['+n+']';
            var div_id = 'list-activity-'+n;
            var html = '<div id="'+div_id+'" class="item-activity">\
                            <div class="col">\
                                <label>Keterangan Biaya</label>\
                                <textarea class="form-control" name="'+component_name+'[detail_activity]"></textarea>\
                            </div>\
                             <div class="col">\
                                <label>Jumlah</label> \
                                <input class="form-control" type="number" name="'+component_name+'[amount]">\
                            </div>\
                            <div class="col">\
                                <label>No Kwitansi</label> \
                                <input class="form-control" type="text" name="'+component_name+'[check_number]">\
                            </div>\
                            <div  class="col close-location">     \
                                <span data-id="'+div_id+'" class="deleteActivity">x</span> \
                            </div> \
                        </div>';
            
            if($('#'+div_id).length == 0){
                $('.wrap_activity').append(html);
               // console.log(n);
            }else{
                generateActivity(n+1);
            }
        }

        // <div class="col"> \
        //                         <label>Upload Bukti Scan Kwitansi</label> \
        //                         <input class="form-control" type="file" name="'+component_name+'[file_attachment]"> \
        //                     </div> \
        $('#addActivity').click(function(){
            generateActivity(0);
        });

        $('#calculate').click(function(){
            $('.loading').show();
            var data = $('#form-spj').serializeArray();
            ajax_post("<?php echo site_url('LPD/ajax_calculate_data') ?>",data).
                done(function(result){
                    if(result['html']){
                        var html = result['html'];
                        $('tbody').html(html);
                        
                        // $('.saveAction').prop('disabled',false);
                        
                    }       
                }).
                fail(function(){
                    custom_alert('Error');
                });
            //console.log(data);
            //$('#myTabs a[href="#calculation"]').tab('show');
            $('.loading').hide();
        });
    });
    $(document).on('click','.deleteActivity',function(){
        var id = $(this).data('id');
        $('#'+id).remove();
    })
</script>
