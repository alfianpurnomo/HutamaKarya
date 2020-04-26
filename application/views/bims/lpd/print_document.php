<style type="text/css">
	.text-center{
		text-align: center;
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
        margin-bottom: 35px;
    }
    .footer_doc{
        display: flex;
        flex-direction: row;
        justify-content: space-around;
    }
    .text-right{
    	text-align: right;
    }

    .table-bordered {
    border: 1px solid #D0D0D0;
}
table {
    border-spacing: 0;
    border-collapse: collapse;
}
.table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 20px;
}
.table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
    border: 1px solid #D0D0D0;
    line-height: 1.42857143;
    padding: 15px 15px;
}
</style>
<div class="book">
    <?php
    // foreach ($detailLPD['detailTravelBill'] as $key => $value) {
    ?>

    <div class="page">
				<div class="kop_surat">
            <h3>PERINCIAN BIAYA PERJALANAN DINAS</h3>
            <h3>BERDASARKAN SURAT TUGAS</h3>
            <h3>No. : <?php echo $detailLPD['spj_doc_no'] ?> Tanggal : <?php echo date('d M Y',strtotime($detailLPD['spj_date'])) ?></h3> 
        </div>
        <div class="content_document">
        	<div class="col-lg-12">
	            <table class="table table-striped table-bordered table-hover">
	                <thead>
	                    <tr>
	                        <th class="text-center">Uraian Biaya </th>
	                        <th class="text-center">Jumlah Uang</th>
	                    </tr>
	                </thead>
	                <tbody>
	                	<?php 
	                	foreach ($detailLPD['detailTravelBill'] as $x => $y) {
	                		$total_amount += ($y['final_amount'])
	                	?>
	                    <tr>
	                        <td>
	                            <?php echo $y['detail_activity'] ?> <br>

	                            <?php 
	                            if($x<=1){
	                            	echo $detailLPD['sub_regional'] ?> - <?php echo $detailLPD['province'] ;
	                            }
	                            
	                            ?> <br>
	                            Rp. <?php 
                                if($y['detail_activity']=='Uang Harian' || $y['detail_activity']=='Uang Reprentasi'){
                                    $description_amount = number_format($y['amount'],2,',','.').' x '.$value['days'].' hari';
                                }else{
                                    $description_amount = number_format($y['amount'],2,',','.');
                                }
                                echo $description_amount;
                                ?>
                                <br>
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
	                        <td class="text-right">
	                            Rp. <?php echo number_format($total_amount,2,',','.') ?>
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
	                    <br>
	                    <br>
	                    <br>
	                    <br>
	                    <br>
	                    <br>
	                    <label style="margin-top: 100px;"><?php echo $detailLPD['head_of_division'] ?> </label>
	                    <p><?php echo $detailLPD['jobs_name_head'] ?></p>
	                </div>
	                <div class="text-center">
	                    <p>Jakarta, <?php echo date('d M Y',strtotime($detailLPD['spj_date'])) ?></p>
	                    <br>
	                    <br>
	                    <br>
	                    <br>
	                    <br>
	                    <br>
	                    <br>
	                    <br>

	                    <label style="margin-top: 135px;"><?php echo $detailLPD['employee_name'] ?> </label>
	                    
	                </div>
	            </div>
	        </div>   
	  </div>
    
    <?php
    //}
    ?>
</div>

<script type="text/javascript">
	window.print();
</script>