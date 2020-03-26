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
				<?php if(is_superadmin() || isset($list_project)):?>
					<h1 style="color:#000">Filter</h1>
					<form class="filter" id="form-filter">
						<?php if(is_superadmin()):?>
						<div class="col">
							<label class="panel-title">Employee</label>
							<select name="employeeid" class="form-control selectEmployee"  id="employeeid">
		                    
		                	</select>
						</div>
						<?php endif;?>
						<?php if(isset($list_project)):?>
							<div class="col">
								<label class="panel-title">Project</label>
								<select name="projectid_filter" class="form-control selectProjectTeamLead"  id="projectid_filter">
									<option>Choose Projects</option>
									<?php foreach($list_project as $key => $value) : ?>
			                    	<option value="<?php echo $value['projectid']; ?>" ><?php echo $value['title']; ?></option>
			                    	<?php endforeach; ?>
			                	</select>
							</div>
						<?php endif;?>
						<div class="col">
							<label class="panel-title">Date</label>
							<div class="input-group">
							    <input type="text" readonly class="form-control " id="startDate" name="startDate" value="" placeholder="Date from">
							    <div class="input-group-addon">to</div>
							    <input type="text" readonly class="form-control " id="endDate" name="endDate"  placeholder="Date until">
							</div>
						</div>
						
						
						<div class="col" style="    padding-top: 22px;">
							<a class="btn btn-success getListdata"><i class="fa fa-search"></i></a>
						</div>	
					</form>
						
					
	                
				<?php endif;?>

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
            <div class="col-lg-12 col-md-12  col-xs-12">
            	<input type="hidden" id="date_selected" name="date_selected" >
                <div class="form-group">
                    <label for="project">Project <span class="text-danger">*</span></label>
                    <select name="projectid" class="form-control select2Search selectProject" id="projects">
                        <option value="0">Select Project</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="activity">Activity</label>
                    <select name="activityid" class="form-control select2Search selectActivity" id="activity">
                        <option value="0">Select Activity</option>
                    </select>
                    
                </div>
                <div class="form-group">
                    <label for="Assign_to">Hours</label>
                    <input type="number" min="0" class="form-control" name="hours" id="hours" value="" required="required"/>
                    
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
                    <input type="number" min="0" class="form-control" name="hours_edit" id="hours_edit" value="" required="required"/>
                    
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
		$('#form-filter').on('keyup keypress', function(e) {
		  var keyCode = e.keyCode || e.which;
		  if (keyCode === 13) { 
		    e.preventDefault();
		    return false;
		  }
		});
		$('#selectProjectTeamLead').select2();
		$('#startDate').datepicker({
            autoclose:true,
            format: 'yyyy-mm-dd',
            zIndexOffset:9999
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
	    	if(is_superadmin() || isset($list_project)) :
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
		var dataFrom = $('#form-add-tasks').serializeArray();
		<?php
	    	if(is_superadmin() || isset($list_project)) :
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
	});
	$(document).on('click','.editTasks',function(){
		var project_name = $(this).data('title');
		var projectid = $(this).data('id_project');
		var activityid = $(this).data('id_activity');
		var activity_name = $(this).data('activity_name');
		var date = $(this).data('date');
		var hour = $(this).data('hours');
		var employeeid = $(this).data('employeeid');

		$('#project_name_edit').val(project_name);
		$('#projectid_edit').val(projectid);
		$('#activity_name_edit').val(activity_name);
		$('#activityid_edit').val(activityid);
		$('#date_edit').val(date);
		$('#hours_edit').val(hour);
		$('#employeeid_edit').val(employeeid);
		$('#ModalEditHour').modal('show');
	});

	function getListTasks(employeeid){
		// var data = [
		// 			{name:'employeeid',value:employeeid},
		// 			{name:'startDate',value:$('#startDate').val()},
		// 			{name:'endDate',value:$('#endDate').val()}
		// 		   ];
		var data = $('#form-filter').serializeArray();
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

		var dataFrom = $('#form-edit-tasks').serializeArray();
		<?php
	    	if(is_superadmin() || isset($list_project)) :
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
	});
	


	
</script>