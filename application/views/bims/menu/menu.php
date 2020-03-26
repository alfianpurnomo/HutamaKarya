<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5 class="panel-title">List <?=$page_title?></h5>
                <div class="tools">
                    <a href="<?=$add_url?>" class="btn btn-social btn-success">
                        <span class="fa fa-plus-circle"></span> Add Data
                    </a>
                    <a class="btn-link panel-collapse collapses" href="javascript:;" style="color:#000000;"></a>
                    <a class="btn-link reload" href="javascript:;" style="color:#000000;"><i class="ti-reload"></i></a>
                </div>
            </div>
            <div class="panel-body">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-list">
                        <thead>
                            <tr>
                                <th data-searchable="false" data-orderable="false" data-name="actions" data-classname="text-center">Actions</th>
                                <th data-name="menu">Menu</th>
                                <th data-name="parent_menu" data-searchable="false">Parent Menu</th>
                                <th data-searchable="false" data-name="position">Position</th>
                            </tr>
                        </thead>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-md-offset-8 text-right">
        <a href="<?php echo $add_url; ?>" class="btn btn-success">Add</a>
        <button type="button" class="btn btn-danger delete-record" id="delete-record">Delete</button>
    </div>
</div>
<br/><br/>
<input type="hidden" id="delete-record-field"/>

<br/><br/>
<script type="text/javascript">
    list_dataTables('#dataTables-list','<?php echo $url_data; ?>');
</script>
