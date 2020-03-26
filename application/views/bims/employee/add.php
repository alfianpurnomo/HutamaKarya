<link rel="stylesheet" href="<?php echo $PLUGINS_URL; ?>dropzone-new/dropzone.min.css">
<script type="text/javascript" src="<?php echo $PLUGINS_URL; ?>dropzone-new/dropzone.min.js"></script>
<style type="text/css">
	.dropzone{
		background: #f2f2f2;
	}
	.row_app{
		float: left;
    	margin-bottom: 10px;
	}
	.tg  {border-collapse:collapse;border-spacing:0;}
	.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
	.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
	.tg .tg-yw4l{
		vertical-align: top;
	    text-align: center;
	    font-size: 16px;
	    font-weight: bold;
	}
	#section_tabel{
		padding: 15px;
	}
	#section_tabel table{
		width: 100%;
	}
	.form-horizontal .form-group {
	    margin-right: 0px;
	    margin-left: 0px;
	}
	.row_range{
		margin-bottom: 20px;
	    display: block;
	    float: left;
	}
	#table_so .row{
		margin: 0 0;
	}
	.border_top{
		border-top: 2px dashed #ccc;
		padding-top: 15px;
	}
	.row_item,.row_range{
		margin-bottom: 10px !important;
	}
	table  {border-collapse:collapse;border-spacing:0;}
	table td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
	table th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
	table .tg-yw4l{vertical-align:top}
	.checkbox input[type="checkbox"], .checkbox input[type="radio"] {
	    opacity: 1;
	    z-index: 1;
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
				<div class="row">
					<div class="col-lg-12">
						
						<form action="<?=$form_action_upload?>" class="dropzone" id="create-dropzone">
							<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
						</form>
						
						<div style="margin-top: 5px;"><i>Maximum upload file size: <?=ini_get("upload_max_filesize")?></i></div>
					</div>
				</div>

                <?php echo form_open($form_action, 'id="form-incoming" class="form-horizontal" role="form" enctype="multipart/form-data"'); ?>

										<div class="content-upload">

										</div>
										<div class="row">
											
										</div>


										<div class="row">
												<div class="col-sm-offset-4 col-sm-10">
														<button type="submit" class=" btn btn-social btn-success"><span class="fa fa-save"></span>Update</button>
												</div>
												<div class="col-lg-10 col-md-4 col-xs-12 col-lg-offset-1">
														<a class="btn btn-labeled btn-default btn-rounded" href="<?php echo $cancel_url; ?>"><span class="btn-label"><i class="fa fa-arrow-left"></i></span>Back</a>
												</div>
										</div>
                <?php echo form_close(); ?>
                <!-- end form for Admin -->
            </div>
        </div>
    </div>
</div>
<div id="ModalShowDetailProduct" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Detail product</h4>
        <div class="message"></div>
      </div>
      <div class="modal-body">
				<div id="wrap_list_detail">
				</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="saveAction btn btn-default" data-dismiss="modal">Close</button>
        <input type="hidden" id="id_product_action">
        <input type="hidden" id="id_product_type_action">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<script type="text/javascript">
$('.input-group.date').datepicker({
	    format: 'yyyy-mm-dd'
	});
$(document).on('click', '#findParam', function(){
	$('.loading').show();
	var data = [{name:'get_product_detail_list',value:'true'}];
	ajax_post("<?php echo site_url('retail_stock_status/ajax_get_product_detail_list'); ?>",data).
	done(function(result){
		console.log(result);
		if(result['status']=='OK'){
			$('#wrap_list_detail').html(result['html']);
			$('#ModalThisDetailRangeDataTable').DataTable();
		}else{
			$('#wrap_list_range').html('');
		}
		$('.loading').hide();
		$('#ModalShowDetailProduct').modal('show');
	}).
	fail(function(){
		alert('Error Connection');
		$('.loading').hide();
	});
});

var CheckParam = function(th){
	var row = $(th).data('row'),
			param = $(th).data('param'),
			product_name_combination_code = $(th).data('product_name_combination_code'),
			box_no = $(th).data('box_no');
		if(th.checked) {
			$('.product-param').val($(th).data('param'));
			$('#Product_Name_Combination').val($(th).data('product_name_combination'));
			$('#box_no').val($(th).data('box_no'));
			$('#Product_Name_Combination_Code').val($(th).data('product_name_combination_code'));
			$('#ChannelDistributor_code').val($(th).data('channeldistributor_code'));
		}else{
			$('.product-param').val('');
			$('#Product_Name_Combination').val('');
			$('#box_no').val('');
			$('#Product_Name_Combination_Code').val('');
			$('#ChannelDistributor_code').val('');
		}
};

$(document).on('change','.chooseRange',function(){
	var check = this;
	CheckParam(check);
});

	// dropzone upload
	Dropzone.options.createDropzone = {
		paramName: 'file',
		maxFilesize: 10, // MB
		maxFiles: 5,
		dictDefaultMessage: 'Drag an CSV/.csv here to upload, or click to select one',
		acceptedFiles: 'text/csv',
		// thumbnailWidth: 150,
		// thumbnailHeight: 150,
		init: function() {
			this.on('success', function( file, resp ){
				// $('.dz-image').css({"width":"100%", "height":"auto"});
					
					$('.content-upload').html(resp.html);
			});
			// this.on('thumbnail', function(file,dataUrl) {
			// 	// $('.dz-image').last().find('img').attr({width: 'auto', height: '100px'});
			// });
			this.on('complete', function(file, resp) {
				setTimeout(function() {
						$('.dropzone .dz-preview').remove();
						$('.dropzone').attr('class','dropzone dz-clickable');
				}, 3000);
				// on upload complete -- run function to load media here
				// OxygenMedia.load();
				// this.removeAllFiles(true);
			});
		}
	};

</script>
