<style type="text/css">
    .item-pekerja {
            display: flex;
    margin-top: 5px;
    justify-content: space-between;
    align-items: center;
    }
    .item-pekerja input{
        margin:0 2px 0;
    }
    .close-employee span{
            background: red;
    border: 1px solid red;
    color: white;
    display: inline-block;
    padding: 0px 7px;
    border-radius: 13px;
    }
    .close-employee div{
        text-align: center;
    }
</style>
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
                <h2 class="panel-title"><?php echo $page_title?> Detail</h2>

            </div>
            <div class="panel-body">
                <!-- start form for Admin -->
                <div id="form-project">
                    <div class="row">
                        <div class="col-lg-6 col-md-6  col-xs-12">
                            <div class="form-group">
                                <label for="code">Project Code</label>
                                <input type="text" readonly class="form-control" name="code" id="code" value="<?php echo (isset($post['code'])) ? $post['code'] : ''; ?>" required="required"/>
                            </div>
                            <div class="form-group">
                                <label for="invoice_number">Invoice Number</label>
                                <input type="text" readonly class="form-control" name="invoice_number" id="invoice_number" value="<?php echo (isset($post['invoice_number'])) ? $post['invoice_number'] : ''; ?>" required="required"/>
                            </div>
                            <div class="form-group">
                                <label for="title">Project Name</label>
                                <input type="text" readonly class="form-control" name="title" id="title" value="<?php echo (isset($post['title'])) ? $post['title'] : ''; ?>" required="required"/>
                            </div>
                            <div class="form-group">
                                <label for="description">Project Description</label>
                                <textarea readonly class="form-control" name="description" id="description"><?php echo (isset($post['description'])) ? $post['description'] : ''; ?></textarea>
                                
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4  col-xs-12 col-lg-offset-1">
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <div class="input-group date" >
                                    <input type="text" readonly name="start_date" id="start_date" class="form-control" data-autoclose="1" value="<?php echo (isset($post['start_date'])) ? $post['start_date'] : date('Y-m-d'); ?>" placeholder="Select Date">
                                    <div class="input-group-addon">
                                        <span class="sli-calendar"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <div class="input-group date" >
                                    <input type="text" readonly name="end_date" id="end_date" class="form-control" data-autoclose="1" value="<?php echo (isset($post['end_date'])) ? $post['end_date'] : date('Y-m-d'); ?>" placeholder="Select Date">
                                    <div class="input-group-addon">
                                        <span class="sli-calendar"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="title">Status</label>
                                <input type="text" readonly class="form-control" value="<?php echo $post['status_text']; ?>" required="required"/>
                            </div>
                            <div class="form-group">
                                <label><?php echo ($post['is_started']==1)  ? $post['started'].' '.custDateFormat($post['started_date'],'d M Y') : $post['started']; ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12  col-xs-12">
                            <table class="table table-striped table-bordered table-hover" id="datatable-responsive">
                                <thead>
                                    <tr>
                                        <th>No. </th>
                                        <th>Employee Name</th>
                                        <th>Employee NIK</th>
                                        <th>Employee Role</th>
                                        <th>Total Hour</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if($post['employee_task']){

                                        foreach ($post['employee_task'] as $key => $value) {
                                    ?>
                                    <tr>
                                        <td><?= $key+1 ?></td>
                                        <td><?php echo $value['firstname'].' '.$value['lastname'];?></td>
                                        <td><?php echo $value['nik'];?></td>
                                        <td><?php echo $value['role'];?></td>
                                        <td><?php echo $value['total_hours'];?></td>
                                    </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
   makeDataTables('#datatable-responsive'); 
</script>
