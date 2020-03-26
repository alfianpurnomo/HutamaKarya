<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-6">
		<div class="form-group">
            <label for="code">Project Code</label>
            <input type="text" class="form-control" name="code" id="projectCode" value=""/>
            
        </div>
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <div class="input-group date" >
                <input type="text" readonly name="start_date" id="start_date" class="form-control" data-autoclose="1" value="" placeholder="Select Date">
                <div class="input-group-addon">
                    <span class="sli-calendar"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="end_date">End Date</label>
            <div class="input-group date" >
                <input type="text" readonly name="end_date" id="end_date" class="form-control" data-autoclose="1" value="" placeholder="Select Date">
                <div class="input-group-addon">
                    <span class="sli-calendar"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="end_date">Status</label>
            <select class="form-control" id="status_text" name="status_text">
            	<option value="">All</option>
            	<option value="Open">Open</option>
            	<option value="Close">Close</option>
            	<option value="Cancel">Cancel</option>
            </select>
        </div>
        <div class="form-group">
        	<a  class="btn btn-social btn-success" id="filterData">
                <span class="fa fa-search"></span> Filter
            </a>
        </div>
	</div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?=$menu_title?></h3>
                
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th data-name="code">Project Code</th>
                            <th data-name="title">Project Name</th>
                            <th data-name="description">Project Description</th>
                            <th data-name="start_date">Start Date</th>
                            <th data-name="end_date">End Date</th>
                            <th data-name="total_employee">Total Employee</th>
                            <th data-name="total_hours">Total Hour</th>
                            <th data-name="status_text">Status</th>
                            <th  data-name="started">Started</th>
                            <th data-searchable="false" data-orderable="false" data-name="actions" data-classname="text-center">Actions</th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>
</div>
<br/><br/>
<input type="hidden" id="delete-record-field"/>
<div class="row">
    <div class="col-md-4 col-md-offset-8 text-right">
        <a href="<?=$add_url?>" class="btn btn-social btn-success">
            <span class="fa fa-plus-circle"></span> Add Data
        </a>
        <?php
        if(is_superadmin()) :
        ?>
        <button type="button" data-delete-url="delete" class="btn btn-danger delete-record" id="delete-record">Delete</button>
        <?php
        endif;
        ?>
    </div>
</div>
<script type="text/javascript">
	
$(document).ready(function () {
	$('#start_date,#end_date').datepicker({
        autoclose:($(this).attr("data-autoclose") == "1" ? true : false),
        format: 'yyyy-mm-dd'
    });
	var element = '#datatable-responsive';
	var url = '<?php echo $url_data; ?>';
    var selected = [];
    var sort = [];
    if ($(element+' thead th.default_sort').index(element+' thead th') > 0) {
        sort.push([$(element+' thead th.default_sort').index(element+' thead th'),"desc"]);
    }
    var colom = [];
    var i=0;
    $(element+' thead th').each(function() {
        var edit = $(this).data('edit');
        var view = $(this).data('view');
        colom[i] = {
            'data':(typeof $(this).data('name') === 'undefined') ? null : $(this).data('name'),
            'name':(typeof $(this).data('name') === 'undefined') ? null : $(this).data('name'),
            'searchable':(typeof $(this).data('searchable') === 'undefined') ? true : $(this).data('searchable'),
            'sortable':(typeof $(this).data('orderable') === 'undefined') ? true : $(this).data('orderable'),
            'className':(typeof $(this).data('classname') === 'undefined') ? null : $(this).data('classname')
        };
        i++;
    });
    var DTTable = $(element).DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": false,
        /*"ajax": $.fn.dataTable.pipeline({
            url: url,
            pages: perpage // number of pages to cache
        })*/
        "ajax": {
            "url": url,
            "type": "POST",
            "data": function(data){
		          // Read values
		          
		          var filter = {
		            'code':$('#projectCode').val(),
		            'start_date':$('#start_date').val(),
		            'end_date':$('#end_date').val(),
		            'status_text':$('#status_text').val()
		       	  };
		          data.filterCustom = filter;
		          data[token_name] = token_key;
		       }
        },
        "rowCallback": function( row, data ) {
            if ( $.inArray(data.DT_RowId, selected) !== - 1) {
                $(row).addClass('selected');
            }
            if ( typeof data.RowClass !== 'undefined' && data.RowClass != '') {
                $(row).addClass(data.RowClass);
            }
        },
        "columns":colom,
        "order":sort
    });
    $(element+'_filter input').unbind();
    $(element+'_filter input').keyup(function (e) {
        if (e.keyCode == 13) {
            DTTable.search(this.value).draw();
        }
    });
    if ($(element +' tfoot th.searchable').length > 1) {
        DTTable.columns().every( function () {
            var that = this;
            $( 'input', this.footer() ).on( 'keydown', function (ev) {
                 if (ev.keyCode == 13) { //only on enter keypress (code 13)
                    that
                    .search( this.value )
                    .draw();
                }
            } );
            $( 'select', this.footer() ).on( 'change', function (ev) {
                that
                .search( this.value )
                .draw();
            } );
        } );
    }

    $('#filterData').click(function(){
		DTTable.draw();
	});
    
});
</script>