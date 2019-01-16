<?php 
$this->session->set_userdata('last_page', current_url());
?>
<form action="<?php echo base_url()?>main/users/delete_multiple/" method="post">
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">   
            <div class="panel-heading">
<button type="button" onClick="confSubmit(this.form);" id="delete" class="btn btn-danger pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onClick="checkone(this.form);" id="delete1" class="btn btn-danger pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onclick="window.location.href = '<?php echo base_url();?>main/add_user/'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_myPulse_user'); ?>
</button>
</div>
<div class="panel-body">
<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">    
    <thead>
        <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value=""></th>
            <th><?php echo get_phrase('user_id');?></th>
            <th><?php echo get_phrase('user_name');?></th>
            <th><?php echo get_phrase('email');?></th>
            <th><?php echo get_phrase('status');?></th>
            <th><?php echo get_phrase('options');?></th>
        </tr>
    </thead>

    <tbody>
        <?php $i=1;foreach ($patient_info as $row) {
            
         ?>   
            <tr>
                <td><input type="checkbox" name="check[]" class="check" id="check_<?php echo $i;?>" value="<?php echo $row['user_id'] ?>"></td>
                 <td><?php echo $row['unique_id']?></td>
                <td><a href="<?php echo base_url();?>main/edit_user/<?php echo $row['user_id']?>" class="hiper"><?php echo $row['name'] ?></a></td>
                <td><?php echo $row['email']?></td>
                <td><?php if($row['status'] == 1){echo "<button type='button' class='btn-success'>Active</button>";   
                 }
                 else if(
                 $row['status'] == 2){ echo "<button type='button' class='btn-danger'>Inactive</button>";}?>
                     <?php if($row['reg_status'] == 1){echo "<span class='text-success'>Registered</span>";   
                 }
                 elseif($row['reg_status'] == 2){ echo "<span class='text-danger'>Unregistered</span>";}?>
                 </td> 
                <td>
                   <!--  <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                            Action <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                            <li>
                                <a onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/patient_profile/<?php echo $row['patient_id']?>');">
                                    <i class="entypo-user"></i>
                                    <?php echo get_phrase('profile'); ?>
                                </a>
                            </li>
                            <li>
                                <a onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/medication_history/<?php echo $row['patient_id']?>');">
                                   <i class="entypo-eye"></i>
                                    <?php echo get_phrase('medication history'); ?>
                                </a>
                            </li>
                            <li>
                                <a onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/diagnosis_report/<?php echo $row['patient_id']; ?>');">
                               <!-- <a href="<?php echo base_url();?>index.php?modal/popup/diagnosis_report/<?php echo $row['patient_id']; ?>">
                                    <i class="fa fa-medkit"></i>
                                    <?php echo get_phrase('diagnosis report'); ?>
                                </a>
                            </li>
                            
                            <li>
                                <a onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/bed_allotment_history/<?php echo $row['patient_id']?>');">
                                   <i class="fa fa-hdd-o"></i>
                                    <?php echo get_phrase('bed allotment history'); ?>
                                </a>
                            </li>
                            <li>
                                <a  onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/edit_patient/<?php echo $row['patient_id']?>');" 
                                    <i class="entypo-pencil"></i>
                                    <?php echo get_phrase('edit'); ?>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?php echo base_url();?>main/user/delete/<?php echo $row['patient_id']?>" 
                                    onclick="return checkDelete();">
                                        <i class="entypo-cancel"></i>
                                        <?php echo get_phrase('delete'); ?>
                                </a>
                            </li>
                        </ul>
                    </div> -->
                    <a href="#" onclick="confirm_modal('<?php echo base_url();?>main/users/delete/<?php echo $row['user_id']?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
                    <?php if($row['is_email'] == '2'){?>
                <a href="<?php echo base_url(); ?>main/resend_email_verification/users/user/<?php echo $row['unique_id'] ?>" title="Verification Mail"><i class="glyphicon glyphicon-envelope"></i></a><?php }?> 
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>
</div>
 </div>
</div>
</form>
<script>
    $(document).ready(function(){
        $("#delete1").show();
        $("#delete").hide();
 $(".all_check").click(function () {
    if($(this).prop("checked") == true){
                $("#delete1").hide();
                $("#delete").show();
            }
            else if($(this).prop("checked") == false){
                $("#delete1").show();
                $("#delete").hide();
            }
     $('input:checkbox').not(this).prop('checked', this.checked);
 });
         $(".check").click(function(){
            if(($(".check:checked").length)!=0){
            $("#delete1").hide();
            $("#delete").show();
        if($(".check").length == $(".check:checked").length) {
            $("#all_check").attr("checked", "checked");
        } else {
            $("#all_check").removeAttr("checked");
        }
    }else{
        $("#delete1").show();
        $("#delete").hide();
    }
    });
    });
</script>