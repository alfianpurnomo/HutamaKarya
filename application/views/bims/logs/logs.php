<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo $page_title ?></h2>
                <div class="tools">
                    <a class="btn-link panel-collapse collapses" href="javascript:;" style="color:#000000;"></a>
                    <a class="btn-link reload" href="javascript:;" style="color:#000000;"><i class="ti-reload"></i></a>
                </div>
            </div>
            <div class="panel-body">

                <table class="table table-striped table-bordered table-hover" id="dataTables-list">
                    <thead>
                        <tr>
                            <th data-name="f_username">Username</th>
                            <th data-name="auth_group">Group</th>
                            <th data-name="action">Action</th>
                            <th data-name="desc">Desc</th>
                            <th data-name="created" data-searchable="false">Create Date</th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>
</div>

<br/><br/>
<script type="text/javascript">
    list_dataTables('#dataTables-list','<?php echo $url_data; ?>');
</script>
