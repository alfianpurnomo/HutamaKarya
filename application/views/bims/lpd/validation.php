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
                              echo '<img src="'.RELATIVE_UPLOAD_DIR_LPD.$y['file_attachment'].'" alt="..." class="img-thumbnail"><br>';
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

</script>