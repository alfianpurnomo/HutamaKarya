<div class="row">
    <div class="col-lg-12">
        <div class="form-message">
            <?php 
            if (isset($form_message)) {
                echo $form_message;
            }
            ?>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title"><?php echo $page_title ?></h2>
                <div class="tools">
                    <a class="btn-link panel-collapse collapses" href="javascript:;" style="color:#000000;"></a>
                </div>
            </div>
            <div class="panel-body">
                <div class="">
                    <?php echo form_open($form_action, 'role="form"'); ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="checkbox checkbox-primary">
                                        <input type="checkbox" class="styled" value="1" id="select-all"/> 
                                        <label for="select-all">Select All</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <?php echo $auth_menu_html; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-lg-offset-8">
                                <button type="submit" class="btn btn-social btn-success">
                                    Submit
                                    <span class="fa fa-hdd-o"></span>
                                </button>
                                <a class="btn btn-labeled btn-default btn-rounded" href="<?php echo $cancel_url; ?>">
                                    <span class="btn-label"><i class="fa fa-arrow-left"></i></span>
                                    Back
                                </a>
                            </div>
                        </div>
                        <!-- /.row (nested) -->
                    <?php echo form_close(); ?>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $('#select-all').on('click', function () {
            $(this).closest('form').find(':checkbox').prop('checked', this.checked);
        });
        $('.checkauth').on('click', function() {
            if ($('.checkauth:checked').length == $('.checkauth').length) {
                $('#select-all').prop('checked', true);
            } else {
                $('#select-all').prop('checked', false);
            }
        });
        if ($('.checkauth:checked').length == $('.checkauth').length) {
            $('#select-all').attr('checked', 'checked');
        }
    });
</script>
