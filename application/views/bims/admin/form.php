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
                                <label for="f_username">Username <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="f_username" id="f_username" value="<?php echo (isset($post['f_username'])) ? $post['f_username'] : ''; ?>" required="required"/>
                                <input type="hidden" class="form-control" name="employeeid" id="employeeid" value="<?php echo (isset($post['employeeid'])) ? $post['employeeid'] : ''; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="f_grouprole">Group <span class="text-danger">*</span></label>
                                <select class="form-control" name="f_grouprole" id="f_grouprole" required="required">
                                    <?php foreach ($groups as $group) : ?>
                                    <option value="<?php echo $group['id_auth_group']; ?>" <?php echo (isset($post['f_grouprole']) && $group['id_auth_group'] == $post['f_grouprole']) ? 'selected="selected"' : ''; ?>>
                                        <?php echo $group['auth_group']; ?>
                                    </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="department">Department <span class="text-danger">*</span></label>
                                <select class="form-control" name="department" id="department" required="required">
                                    <?php foreach ($departments as $department) : ?>
                                    <option value="<?php echo $department['id_master_department']; ?>" <?php echo (isset($post['department']) && $department['id_master_department'] == $post['department']) ? 'selected="selected"' : ''; ?>>
                                        <?php echo $department['department_name']; ?>
                                    </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="golongan">Golongan <span class="text-danger">*</span></label>
                                <select class="form-control" name="golongan" id="golongan" required="required">
                                    <?php foreach ($golongans as $golongan) : ?>
                                    <option value="<?php echo $golongan['id_master_golongan']; ?>" <?php echo (isset($post['golongan']) && $golongan['id_master_golongan'] == $post['golongan']) ? 'selected="selected"' : ''; ?>>
                                        <?php echo $golongan['golongan_name']; ?>
                                    </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="password">Password  <span class="text-danger">*</span></label>
                                <input type="password" id="f_password" class="form-control" name="f_password" value=""/>
                                <?php if (isset($post['id'])): ?>
                                <p class="help-block"><small>Leave this field empty if You don't want to change the password.</small></p>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="conf_password">Password Confirmation <span class="text-danger">*</span></label>
                                <input type="password" id="conf_password" class="form-control" name="conf_password" value=""/>
                            </div>
                            <div class="form-group">
                                <label for="nik">NIK <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="f_nik" id="f_nik" value="<?php echo (isset($post['f_nik'])) ? $post['f_nik'] : ''; ?>" required="required"/>
                            </div>
                            <div class="form-group">
                                <label for="jobsid">Jobs Title <span class="text-danger">*</span></label>
                                <select class="form-control" name="jobsid" id="jobsid" required="required">
                                    <?php foreach ($jobs as $job) : ?>
                                    <option value="<?php echo $job['id_jobs_title']; ?>" <?php echo (isset($post['jobsid']) && $job['id_jobs_title'] == $post['jobsid']) ? 'selected="selected"' : ''; ?>>
                                        <?php echo $job['jobs_name']; ?>
                                    </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="f_firstname" id="f_firstname" value="<?php echo (isset($post['f_firstname'])) ? $post['f_firstname'] : ''; ?>" required="required"/>
                            </div>
                            <div class="form-group">
                                <label for="name">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="f_lastname" id="f_lastname" value="<?php echo (isset($post['f_lastname'])) ? $post['f_lastname'] : ''; ?>" required="required"/>
                            </div>
                            <div class="form-group">
                                <label for="sex">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select class="form-control" id="sex" name="sex">
                                    <option>Pilih</option>
                                    <option  <?php echo (isset($post['sex']) && $post['sex'] == 'P') ? 'selected="selected"' : ''; ?>value="P">Perempuan</option>
                                    <option <?php echo (isset($post['sex']) && $post['sex'] == 'L') ? 'selected="selected"' : ''; ?> value="L">Laki Laki</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="f_mail" id="f_mail" value="<?php echo (isset($post['f_mail'])) ? $post['f_mail'] : ''; ?>" required="required"/>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="number" class="form-control number_only" name="f_phone" id="f_phone" value="<?php echo (isset($post['f_phone'])) ? $post['f_phone'] : ''; ?>"/>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4  col-xs-12 col-lg-offset-1">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <div class="checkbox checkbox-primary">
                                    <input type="checkbox" value="1" class="styled" name="f_auth" id="f_auth" <?php echo (isset($post['f_auth']) && !empty($post['f_auth'])) ? 'checked="checked"' : ''; ?>/>
                                    <label>
                                        Active
                                    </label>
                                </div>
                            </div>
                            <?php if (is_superadmin()) : ?>
                            <div class="form-group">
                                <label for="is_superadmin">Super Administrator</label>
                                <div class="checkbox checkbox-primary">
                                    <input type="checkbox" value="1" class="styled" name="is_superadmin" id="is_superadmin" <?php echo (isset($post['is_superadmin']) && !empty($post['is_superadmin'])) ? 'checked="checked"' : ''; ?>/>
                                    <label for="checkbox2">Yes</label>
                                </div>
                            </div>
                            <?php endif; ?>
                       
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
        document.querySelector(".number_only").addEventListener("keypress", function (evt) {
            //console.log('asd');
            if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
            {
                evt.preventDefault();
            }
        });
        $('#f_role').change(function(){
            var id_role = $(this).val();
            if(id_role){

            }
        })
    })

</script>
