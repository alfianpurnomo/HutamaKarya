<style type="text/css">
	
	.filter{
		display: flex;
		flex-direction: row;
	}
	.col+.col{
		margin-left: 16px;
	}
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="form-message form_message">
            
        </div>
    </div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php if(is_superadmin()):?>
					<h1 style="color:#000">Filter</h1>
					<div class="filter">
						<div class="col">
							<label class="panel-title">Employee</label>
							<select name="employeeid" class="form-control selectEmployee"  id="employeeid">
		                    
		                	</select>
						</div>
						<div class="col">
							<label class="panel-title">Date</label>
							<div class="input-group">
							    <input type="text" readonly class="form-control " id="startDate" value="" placeholder="Date from">
							    <div class="input-group-addon">to</div>
							    <input type="text" readonly class="form-control " id="endDate" placeholder="Date until">
							</div>
						</div>
						<div class="col" style="    padding-top: 22px;">
							<a class="btn btn-success getListdata"><i class="fa fa-search"></i></a>
						</div>	
					</div>
						
					
	                
				<?php endif;?>

				<?php /*if($list_project):?>
					<h3 class="panel-title">Project</h3>
					<select name="projectid_teamlead" class="form-control selectProjectTeamLead"  id="projectid_teamlead">
	                    
	                </select>
	                <a class="btn btn-success getListdataProject"><i class="fa fa-search"></i></a>
				<?php endif;*/?>
			</div>
			<div class="panel-body">
				<div class="bs-example" data-example-id="simple-responsive-table">
				    <div class="table-responsive">
				        <table class="table" id="table_tasks" border="1">
				            <thead>
				                <tr>
				                    <th>Activity Name / Date</th>
				                    <?php
				                    foreach ($list_date as $key => $value) {
				                    	$class_action 		= '';
				                    	$btn_class		 	= 'danger';
				                    	if($value['status']=='enable'){
				                    		
				                    		$class_action 		= 'addTasks';
				                    		$btn_class		 	= 'success';
				                    	}
				                    ?>
				                    <th>
				                    	<a data-date="<?php echo $value['date']; ?>" class="<?php echo $class_action; ?> btn btn-<?php echo $btn_class; ?>"><?php echo custDateFormat($value['date'],'d M Y'); ?></a>
				                    </th>
				                    <?php	# code...
				                    }
				                    ?>
				                    
				                </tr>
				            </thead>
				            <tbody>
				                
				            </tbody>
				        </table>
				    </div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="ModalSearchPO" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Tasks</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open($form_action, 'id="form-add-tasks" role="form" enctype="multipart/form-data"'); ?>
        <div class="row">
            <div id="form-addTask" class="col-lg-12 col-md-12  col-xs-12">
            	
            	<input type="hidden" id="date_selected" name="date_selected" >
                <div class="form-group">
                    <label for="project">Project <span class="text-danger">*</span></label>
                    <select name="projectid" class="form-control select2Search selectProject" id="projects">
                        <option value="0">Select Project</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="activity">Activity</label>
                    <select name="activityid" class="form-control select2Search selectActivity " id="activity">
                        <option value="0">Select Activity</option>
                    </select>
                    
                </div>
                <div class="form-group">
                    <label for="Assign_to">Hours</label>
                    <input type="number" class="form-control number validate[required,max[12],maxSize[2]],onlyNumberSp" name="hours" id="hours" value="" required="required"/>
                    
                </div>
                <div class="form-group">
                	<label>Notes</label>
                	<textarea class="form-control" name="notes" id="notes"></textarea>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="saveAction btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveTasks">Add</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="ModalEditHour" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Tasks</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open($form_action, 'id="form-edit-tasks" role="form" enctype="multipart/form-data"'); ?>
        <div class="row">
            <div class="col-lg-12 col-md-12  col-xs-12">
            	<input type="hidden" id="date_edit" name="date_edit" >
            	<input type="hidden" id="employeeid_edit" name="employeeid_edit" >
                <div class="form-group">
                    <label for="project">Project <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" readonly="" value="" id="project_name_edit" >
                    <input type="hidden" value="" id="projectid_edit" name="projectid">
                </div>
                <div class="form-group">
                    <label for="activity">Activity</label>
                    <input class="form-control" type="text" readonly="" value="" id="activity_name_edit" >
                    <input type="hidden" value="" id="activityid_edit" name="activityid">
                    
                </div>
                <div class="form-group">
                    <label for="Assign_to">Hours</label>
                    <input type="number" min="0" class="form-control number validate[required,max[12],maxSize[2]],onlyNumberSp" name="hours_edit" id="hours_edit" value="" required="required"/>
                    <input type="hidden" min="0"  name="hours_before" id="hours_before" />
                    
                </div>
                <div class="form-group">
                	<label>Notes</label>
                	<textarea class="form-control" name="notes" id="notes_edit"></textarea>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class=" btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="editAction">Update</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
	$(document).ready(function(){
		$("#ModalSearchPO").on("hidden.bs.modal", function () {
		    $("#projects").val([]).trigger("change");
		    $("#activity").val([]).trigger("change");
		    $("#hours").val('');
		    $("#notes").val('');
		});
		$("#ModalEditHour").on("hidden.bs.modal", function () {
		    $("#project_name_edit").val('');
		    $("#projectid_edit").val('');
		    $("#activityid_edit").val('');
		    $("#activity_name_edit").val('');
		    $("#hours_edit").val('');
		    $("#notes_edit").val('');
		});
		
		$("#form-addTask").validationEngine();
		$('#startDate').datepicker({
            autoclose:true,
            format: 'yyyy-mm-dd',
            zIndexOffset:9999
        });
        document.querySelector(".number").addEventListener("keypress", function (evt) {
        	//console.log('asd');
		    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
		    {
		        evt.preventDefault();
		    }
		});
        $('#endDate').datepicker({
            autoclose:true,
            format: 'yyyy-mm-dd',
            startDate: new Date($('.startDate').val()),
            zIndexOffset:9999
        });
        $("#startDate").on('changeDate', function(selected) {
	        var startDate = new Date(selected.date.valueOf());
	        $("#endDate").datepicker('setStartDate', startDate);
	        
	    });
		$('#employeeid').select2({
	        placeholder: 'Select Employee',
	        ajax: {
	          url: "<?php echo site_url('tasks/ajax_get_employee') ?>",
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
	    <?php
	    	if(is_superadmin()) :
	    ?>
	    	$('.getListdata').click(function(){
	    		var employeeid = $('#employeeid').val();
	    		getListTasks(employeeid);
	    	});
	    <?php
	    	endif;
	    ?>
		getListTasks();
	})
	
	$(document).on('click','.addTasks',function(){
		$('.form_message').html('');
		var date = $(this).data('date');
		$('#date_selected').val(date);
		$('#ModalSearchPO').modal('show');
		var employeeid = $('#employeeid').val();
		$('#projects').select2({
	        placeholder: 'Select Project',
	        ajax: {
	          url: "<?php echo site_url('tasks/ajax_get_projects') ?>",
	          dataType: 'json',
	          delay: 250,
	          data: function (params) {
	            var query = {
	                search: params.term,
	                type: 'public',
	                q:params.q,
	                date:date,
	                employeeid:employeeid
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
	    $('#activity').select2({
	        placeholder: 'Select Activity',
	        ajax: {
	          url: "<?php echo site_url('tasks/ajax_get_activity') ?>",
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
	})

	$('#saveTasks').click(function(){
		var validateForm = $("#form-add-tasks").validationEngine('validate');
		if(validateForm){
			var dataFrom = $('#form-add-tasks').serializeArray();
			$('.form_message').html('');
			<?php
		    	if(is_superadmin()) :
		    ?>
		    	dataFrom.push(
		    					{name:'startDate',value:$('#startDate').val()},
								{name:'endDate',value:$('#endDate').val()},
								{name:'employeeid',value:$('#employeeid').val()}
							);
		    <?php
		    	endif;
		    ?>
			
			ajax_post("<?php echo site_url('tasks/saveTasks') ?>",dataFrom).
			done(function(result){
				$('.form_message').html(result['status']);
				if(result['html']){
					

					$('#table_tasks tbody').html(result['html']);
					
					//$('.select2Search').select2();
				}	
				$('#ModalSearchPO').modal('hide');	
			}).
			fail(function(){
				custom_alert('Error');
			});
		}else{

		}
		
	});
	$(document).on('click','.editTasks',function(){
		var project_name = $(this).data('title');
		var projectid = $(this).data('id_project');
		var activityid = $(this).data('id_activity');
		var activity_name = $(this).data('activity_name');
		var date = $(this).data('date');
		var notes = $(this).data('notes');
		var hour = $(this).data('hours');
		var employeeid = $(this).data('employeeid');
		$('.form_message').html('');
		$('#project_name_edit').val(project_name);
		$('#projectid_edit').val(projectid);
		$('#activity_name_edit').val(activity_name);
		$('#activityid_edit').val(activityid);
		$('#notes_edit').val(notes);
		$('#date_edit').val(date);
		$('#hours_edit').val(hour);
		$('#hours_before').val(hour);
		$('#employeeid_edit').val(employeeid);
		$('#ModalEditHour').modal('show');
	});

	function getListTasks(employeeid){
		$('.form_message').html('');
		var data = [
					{name:'employeeid',value:employeeid},
					{name:'startDate',value:$('#startDate').val()},
					{name:'endDate',value:$('#endDate').val()},{name:'view',value:2}
				   ];
		ajax_post("<?php echo site_url('tasks/getListTasks') ?>",data).
		done(function(result){
			$('.form_message').html(result['status']);
			$('#table_tasks thead').html(result['html_th']);
			$('#table_tasks tbody').html(result['html']);

				
		}).
		fail(function(){
			custom_alert('Error');
		});
	}

	$('#editAction').click(function(){
		$('.form_message').html('');
		var validateForm = $("#form-edit-tasks").validationEngine('validate');
		if(validateForm){
			var dataFrom = $('#form-edit-tasks').serializeArray();
			<?php
		    	if(is_superadmin()) :
		    ?>
		    	dataFrom.push(
		    					{name:'startDate',value:$('#startDate').val()},
								{name:'endDate',value:$('#endDate').val()}
							);
		    <?php
		    	endif;
		    ?>
			ajax_post("<?php echo site_url('tasks/editTasks') ?>",dataFrom).
			done(function(result){
				$('.form_message').html(result['status']);
				if(result['html']){
					

					$('#table_tasks tbody').html(result['html']);
					
					//$('.select2Search').select2();
				}	
				$('#ModalEditHour').modal('hide');	
			}).
			fail(function(){
				custom_alert('Error');
			});
		}
		
	});
	


	
</script>