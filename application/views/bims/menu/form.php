<style type="text/css">
    #wrap_function{
        display: flex;
        margin-top: 20px;
        padding: 10px;
        flex-wrap: wrap;
        justify-content: space-between;
    }
    .item-function{
        display: flex;
        position: relative;
        margin-right: 20px;
        margin-bottom: 20px;

    }
    .close-location{
        position: absolute;
        right: -11px;
        top: -11px;
    }
    .close-location span{
        background: red;
        border: 1px solid red;
        color: white;
        display: inline-block;
        padding: 0px 7px;
        border-radius: 13px;
    }
    .close-location div{
        text-align: center;
    }

</style>
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
                <h5 class="panel-title"><?php echo $page_title?> form</h5>
                <div class="tools">
                    
                    <a class="btn-link panel-collapse collapses" href="javascript:;" style="color:#000000;"></a>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 b-r">
                        <?php echo form_open($form_action, 'role="form"'); ?>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="parent_auth_menu">Parent <span class="text-danger">*</span></label>
                                        <select class="form-control" name="parent_auth_menu" id="parent_auth_menu" required="required">
                                            <option value="0">ROOT</option>
                                            <?php echo $auth_menu_html; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Menu <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="menu" id="menu" value="<?php echo (isset($post['menu'])) ? $post['menu'] : ''; ?>" required="required"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="file">File Path <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="file" id="file" value="<?php echo (isset($post['file'])) ? $post['file'] : ''; ?>" required="required"/>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="position">Position</label>
                                        <input type="number" min="1" step="1" class="form-control" name="position" id="position" value="<?php echo (isset($post['position'])) ? $post['position'] : $max_position; ?>"/>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="position">Icon Class</label>
                                        <input type="text" class="form-control" name="class_icon" id="class_icon" value="<?php echo (isset($post['class_icon'])) ? $post['class_icon'] : 'none'; ?>"/>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        
                                        <a class="btn btn-success" id="addFunction">Add Function</a>
                                        <?php 
                                        if($post['id_auth_menu']){
                                        ?>
                                        <div id="wrap_function_delete">
                                            
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <div id="wrap_function">
                                            <?php
                                            if($post['id_auth_menu']){
                                                if($post['listFunctionDetail']){
                                                    foreach ($post['listFunctionDetail'] as $key => $value) {
                                                        $div_id = 'list-function-'.$value['function_name'];
                                            ?>
                                                    <div id="<?=$div_id?>" class="item-function">
                                                        <div class="col btn btn-info" >
                                                            <?php echo $value['function_name'];?>
                                                        </div>
                                                        <div class="col close-location">
                                                            <span data-id="<?php echo $value['id_auth_menu_function'];?>" class="deleteFunctionEdit">x</span>
                                                        </div>
                                                    </div>
                                            <?php
                                                    }
                                                }
                                                if($post['listFunction']){
                                                    foreach ($post['listFunction'] as $key => $value) {
                                                        $div_id = 'list-function-'.$value['function_name'];
                                                        $name_element = 'listFunction['.$value['function_name'].']';

                                            ?>
                                                        <div id="<?=$div_id?>" class="item-function">
                                                            <div class="col btn btn-info" >
                                                                <?php echo $value['function_name'];?>
                                                            </div>
                                                            <div class="col close-location">
                                                                <span class="deleteFunction">x</span>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" value="<?=$value['function_name']?>" name="<?=$name_element?>[function_name]">
                                                        <input type="hidden" value="<?=$value['function_path']?>" name="<?=$name_element?>[function_path]">
                                            <?php
                                                    }
                                                }
                                            }else{
                                                if($post['listFunction']){
                                                    foreach ($post['listFunction'] as $key => $value) {
                                                        $div_id = 'list-function-'.$value['function_name'];
                                                        $name_element = 'listFunction['.$value['function_name'].']';
                                            ?>
                                                        <div id="<?=$div_id?>" class="item-function">
                                                            <div class="col btn btn-info" >
                                                                <?php echo $value['function_name'];?>
                                                            </div>
                                                            <div class="col close-location">
                                                                <span class="deleteFunction">x</span>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" value="<?=$value['function_name']?>" name="<?=$name_element?>[function_name]">
                                                        <input type="hidden" value="<?=$value['function_path']?>" name="<?=$name_element?>[function_path]">
                                            <?php
                                                    }
                                                }
                                            }
                                            ?>
                                            

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-lg-offset-2">
                                    <?php if (is_superadmin()) : ?>
                                    <div class="form-group">
                                        <label for="is_superadmin">Super Administrator</label>
                                        <div class="checkbox checkbox-success">
                                                <input type="checkbox" value="1" class="styled" name="is_superadmin" id="is_superadmin" <?php echo (isset($post['is_superadmin']) && ! empty($post['is_superadmin'])) ? 'checked="checked"' : ''; ?>/>
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
</div>
<div id="ModalFormFunction" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Form Function</h4>
      </div>
      <div class="modal-body">

        
        <div class="row">
            <div class="col-lg-12 col-md-12  col-xs-12">
                <div class="form-group">
                    <label for="project">Function Name <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="function_name"  value="" id="function_name" >
        
                </div>
                <div class="form-group">
                    <label for="activity">Path <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="function_path" value="" id="function_path" >
                    
                </div>
            </div>
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class=" btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveData">Add</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#addFunction').click(function(){
            $('#ModalFormFunction').modal('show');
        });
        $('#saveData').click(function(){
            var n = $('#wrap_function .item-function').length;
            var function_name = $('#function_name').val();
            var function_path = $('#function_path').val();

            
            //console.log(data);
            var row = n +1;
            var div_id = 'list-function-'+function_name;
            var name_element = 'listFunction['+function_name+']';
            var html = '<div id="'+div_id+'" class="item-function">\
                            <div class="col btn btn-info" >\
                                '+function_name+'\
                            </div>\
                            <div  class="col close-location">\
                                <span data-wrap="'+div_id+'" class="deleteFunction">x</span>\
                            </div>\
                            <input type="hidden" value="'+function_name+'" name="'+name_element+'[function_name]">\
                            <input type="hidden" value="'+function_path+'" name="'+name_element+'[function_path]">\
                        </div>';
            if(function_name !='' && function_path != ''){
                if($('#'+div_id).length == 0){
                    $('#wrap_function').append(html);
                }
                
            }
        });
    });
    $(document).on('click','.deleteFunction',function(){
        $(this).closest('.item-function').remove();
    });

    $(document).on('click','.deleteFunctionEdit',function(){
        var id = $(this).data('id');
        var name_element = 'listDeleteFunction['+id+']';
        var html = '<input type="hidden" value="'+id+'" name="'+name_element+'[id_auth_menu_function]">';
        $('#wrap_function_delete').append(html);
        $(this).closest('.item-function').remove();
    });
</script>