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
                                <label for="division_name">Division Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="division_name" id="division_name" value="<?php echo (isset($post['division_name'])) ? $post['division_name'] : ''; ?>" required="required"/>
                                
                            </div>
                            <div class="form-group">
                                <label for="head_of_division">Head Of Division <span class="text-danger">*</span></label>
                                <select class="form-control" name="head_of_division" id="head_of_division" required="required">
                                    <?php foreach ($master_employee as $employee) : ?>
                                    <option value="<?php echo $employee['employeeid']; ?>" <?php echo (isset($post['head_of_division']) && $employee['employeeid'] == $post['head_of_division']) ? 'selected="selected"' : ''; ?>>
                                        <?php echo $employee['f_firstname'].' '.$employee['f_lastname']; ?>
                                    </option>
                                    <?php endforeach ?>
                                </select>
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
        $('#head_of_division').select2();
    })

</script>
