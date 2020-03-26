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
                <?php echo form_open($form_action, 'role="form" enctype="multipart/form-data"'); ?>
                    <div class="row">
                        <div class="col-lg-6 col-md-6  col-xs-12">
                            <div class="form-group">
                                <label for="activity_name">Activity Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="activity_name" id="activity_name" value="<?php echo (isset($post['activity_name'])) ? $post['activity_name'] : ''; ?>" required="required"/>
                            </div>
                            <div class="form-group">
                                <label for="activity_description">Activity Description</label>
                                <textarea type="text" class="form-control" name="activity_description" id="activity_description"><?php echo (isset($post['activity_description'])) ? $post['activity_description'] : ''; ?> </textarea>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-xs-12 col-lg-offset-9">
                                <button type="submit" class="btn btn-social btn-success">
                                    Submit
                                    <span class="fa fa-hdd-o"></span>
                                </button>
                                <a class="btn btn-labeled btn-default btn-rounded" href="<?php echo $cancel_url; ?>"><span class="btn-label"><i class="fa fa-arrow-left"></i></span>Back</a>
                            </div>
                    </div>
                <?php echo form_close(); ?>
                <!-- end form for Admin -->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#f_role').change(function(){
            var id_role = $(this).val();
            if(id_role){

            }
        })
    })

</script>
