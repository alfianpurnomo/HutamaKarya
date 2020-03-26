<div class="row">
    <div class="col-lg-12">
        <div class="form-message">
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
                <h5 class="panel-title"><?php echo $page_title ?> Form</h5>
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
                                    <label for="auth_group">Group Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="auth_group" id="auth_group" value="<?php echo (isset($post['auth_group'])) ? $post['auth_group'] : ''; ?>" required="required"/>
                                </div>
                            </div>
                            <div class="col-lg-4 col-lg-offset-2">
                                <?php if (is_superadmin()): ?>
                                <div class="form-group">
                                    <label for="is_superadmin">Super Administrator</label>
                                    <div class="checkbox checkbox-success">
                                        <input class="styled" type="checkbox" value="1" name="is_superadmin" id="is_superadmin" <?php echo (isset($post['is_superadmin']) && !empty($post['is_superadmin'])) ? 'checked="checked"' : ''; ?>/>
                                        <label>Yes</label>
                                    </div>
                                </div>
                                <?php endif; ?>
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