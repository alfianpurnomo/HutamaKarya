<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?=$menu_title?></h3>
                <div class="tools">
                    <a href="<?=$add_url?>" class="btn btn-social btn-success">
                        <span class="fa fa-plus-circle"></span> Add Data
                    </a>
                    <a class="btn-link panel-collapse collapses" href="javascript:;" style="color:#000000;"></a>
                    <a class="btn-link reload" href="javascript:;" style="color:#000000;"><i class="ti-reload"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover" id="datatable-responsive">
                    <thead>
                        <tr>
                            <th data-searchable="false" data-orderable="false" data-name="actions" data-classname="text-center"></th>
                            <th data-name="jobs_name">Jobs Name</th>
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
        <button type="button" data-delete-url="delete" class="btn btn-danger delete-record" id="delete-record">Delete</button>
    </div>
</div>
<br/><br/>
<script type="text/javascript">
    list_dataTables('#datatable-responsive','<?php echo $url_data; ?>');
    // Collapse ibox function

</script>
