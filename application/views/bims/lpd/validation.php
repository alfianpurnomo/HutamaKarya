<style type="text/css">
  .kop_surat h3 {
        font-size: initial;;
    }
    .kop_surat {
        text-align: center;
        margin-bottom: 20px;
    }
    .footer_document{
        margin: 0 auto;
    }
    .footer_doc {
    display: flex;
    flex-direction: row;
    justify-content: space-around;
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
    <div class="">
    <div class="col-lg-12">
          <div class="kop_surat">
              <h3>PERINCIAN LAPORAN PERJALANAN DINAS</h3>
              <h3>BERDASARKAN SURAT TUGAS</h3>
              <h3>No. :  <?php echo $post['spj_doc_no']; ?> Tanggal : <?php echo date('d M Y',strtotime($post['spj_date']))?></h3> 
          </div>
          
      </div>
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
                          <?php
                          if($y['detail_activity']!='Uang Harian' && $y['detail_activity']!='Uang Reprentasi' && $post['status']=="REQUESTED_LPD"){
                          
                          ?>
                          <br>
                          <a data-id="<?php echo $y['id_detail_travel_bill']; ?>" data-desc="<?php echo $y['detail_activity']; ?>" data-amount="<?php echo $y['final_amount']; ?>" data-image="<?php echo $y['file_attachment']; ?>" data-kwitansi="<?php echo $y['check_number']; ?>" class="editDetail btn btn-sm btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
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
       
      <div class="col-lg-12 footer_doc">
            <div class="text-center">
            <p>Mengetahui,</p>
            <p>Divisi EPC</p>
            
            <label style="margin-top: 100px;"><?php echo $post['head_of_division'];?>  </label>
            <p>Executive Vice President</p>
        </div>
        <div class="text-center">
            <p>Jakarta, <?php echo date('d M Y',strtotime($post['spj_date']))?></p>
            
            <label style="margin-top: 135px;"><?php echo $post['employee_name'];?>  </label>
            
        </div>
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
                : &nbsp; <?php echo $post['status']; ?>
            </div>
        </div>
        <div class="row_item" style="display: inherit;">
            <?php
                if((is_superadmin() || id_auth_group()==2) && $post['status']=="REQUESTED_LPD"){

                
            ?>
            <a data-id_travel_bill="<?php echo $post['id_travel_bill']; ?>" data-status="APPROVE_LPD" class="changeStatus btn btn-success">APPROVE</a>
            <a data-id_travel_bill="<?php echo $post['id_travel_bill']; ?>" data-status="REJECT_LPD" class="changeStatus btn btn-danger">REJECT</a>
            <?php
                }
            ?>
            <?php
                if($post['status']=="APPROVE_LPD"){
            ?>
                <a href="<?php echo site_url('/lpd/print_document/'.$post['id_travel_bill'])?>"  class="btn btn-success">PRINT</a>
            <?php
                }
            ?>
        </div>
    </div>
</div>
<div id="ModalEditDetailLPD" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Tasks</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open($form_action, 'id="form-add-tasks" role="form" enctype="multipart/form-data"'); ?>
        <div class="row">
            <div class="col-lg-12 col-md-12  col-xs-12">
                <div class="form-group">
                    <label for="Detail">Deskripsi</label>
                    <input type="text" class="form-control" name="detail_activity" id="detail_activity" value="" required="required"/>
                    <input type="hidden" name="id_detail_travel_bill" id="id_detail_travel_bill" value=""/>
                    <input type="hidden" name="old_file" id="old_file" value=""/>
                    
                </div>
                <div class="form-group">
                    <label for="Assign_to">Jumlah</label>
                    <input type="text" class="form-control" name="amount" id="amount" value="" required="required"/>
                    
                </div>
                <div class="form-group">
                    <label for="Assign_to">No. Kwitansi</label>
                    <input type="text" class="form-control" name="check_number" id="check_number" value="" required="required"/>
                    
                </div>
                <div class="form-group">
                    <label for="Assign_to">Upload Kwitansi</label>
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail fileinput-upload" style="width: 200px; height: 150px;">
                            
                                <img src="" id="post-image" />
                            
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                        <div>
                            <span class="btn btn-success btn-file">
                                <span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                                <input type="file" name="file_kwitansi">
                            </span>
                            <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="saveAction btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveUpdate">Save</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    $(document).ready(function(){
        

        //CHANGE STATUS
        $('.changeStatus').click(function(){
            $('.loading').show();
            var data = [
                        {name:'id_travel_bill',value:$(this).data('id_travel_bill')},
                        {name:'status',value:$(this).data('status')}];
            ajax_post("<?php echo site_url('LPD/change_status') ?>",data).
                done(function(result){
                    if(result['html']){
                        $('.message_action').html(result['html']);
                    }
                    location.reload()
                }).
                fail(function(){
                    custom_alert('Error');
                });
            $('.loading').hide();
        })
        //END CHANGE STATUS


        
    });
    $('#ModalEditDetailLPD').on('hidden.bs.modal', function () {
        $('#detail_activity').val('');
        $('#amount').val('');
        $('#check_number').val('');
        $('#id_detail_travel_bill').val('');
    });
    $(document).on('click','.editDetail',function(){
        var id_detail = $(this).data('id');
        var desc = $(this).data('desc');
        var amount = $(this).data('amount');
        var image = $(this).data('image');
        var kwitansi = $(this).data('kwitansi');
        $('#detail_activity').val(desc);
        $('#amount').val(amount);
        $('#check_number').val(kwitansi);
        $('#id_detail_travel_bill').val(id_detail);
        $('#old_file').val(image);
        var src_image = '<?php echo URL_IMAGE_LPD?>'+image;
        if(image){
            $('#post-image').attr('src',src_image);
        }
        
        // console.log(src_image);
        
        $('#ModalEditDetailLPD').modal('show');
    });

    $(document).on('click','.post-image',function(){
        console.log($(this).attr('src'));
    })

    $(document).on('click','#saveUpdate',function(){
        
        let myForm = document.getElementById('form-add-tasks');
        var dataForm = new FormData(myForm);
        // var files = $('#file_kwitansi')[0].files[0];
        // fd.append('file',files);

        $.ajax({
            url: '<?php echo site_url('LPD/ajax_edit_detail'); ?>',
            type: 'post',
            data: dataForm,
            contentType: false,
            processData: false
        }).
        done(function(result){
            //console.log(result);
			if(result['status']=='success'){
                location.reload();
            }
		}).
		fail(function(){
			alert('Error');
		});
        
    })

</script>