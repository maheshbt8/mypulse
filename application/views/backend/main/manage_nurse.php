
<?php 
$this->session->set_userdata('last_page', current_url());
?>
<form action="<?php echo base_url()?>main/nurse/delete_multiple/" method="post">
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">   
            <div class="panel-heading">
<?php if($account_type=='superadmin' || $account_type=='hospitaladmins'){?>
<button type="button" onClick="confSubmit(this.form);" id="delete" class="btn btn-danger pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onClick="checkone(this.form);" id="delete1" class="btn btn-danger pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onclick="window.location.href = '<?php echo base_url();?>main/add_nurse'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_nurse'); ?>
</button>
<?php }?>
</div>
<div class="panel-body">
<table data-toggle="table" data-url="tables/data1.json"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">
    <thead>
        <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value=""></th>
            <th data-field="id" data-sortable="true"><?php echo get_phrase('nurse_id');?></th>
            <th data-field="name" data-sortable="true"><?php echo get_phrase('nurse_name');?></th> 
             <th data-field="hospital" data-sortable="true"><?php echo get_phrase('hospital');?></th>
            <th data-field="branch" data-sortable="true"><?php echo get_phrase('branch');?></th>
            <th data-field="department" data-sortable="true"><?php echo get_phrase('department');?></th>  
            <?php if($account_type != 'doctors'){?>
            <th data-field="doctor" data-sortable="true"><?php echo get_phrase('doctor');?></th><?php }?>
            <th data-field="status" data-sortable="true"><?php echo get_phrase('status'); ?></th>
            <?php if($account_type=='superadmin' || $account_type=='hospitaladmins'){?>
            <th><?php echo get_phrase('options');?></th><?php }?>
        </tr> 
    </thead>

    <tbody>
        <?php if($account_type=='superadmin' || $account_type=='hospitaladmins'){$nurse_info = $this->crud_model->select_nurse_info_table();}
        $i=1;foreach ($nurse_info as $row) { ?>   
            <tr>
                <td><input type="checkbox" name="check[]" class="check" id="check_<?php echo $i;?>" value="<?php echo $row['nurse_id'] ?>"></td>
                <td><?php echo $row['unique_id'];?></td>
                 <td><a href="<?php echo base_url(); ?>main/edit_nurse/<?php echo $row['nurse_id'] ?>" class="hiper"><?php echo $row['name'] ?></a></td>
                <td>
                    <?php $name = $this->db->get_where('hospitals' , array('hospital_id' => $row['hospital_id'] ))->row()->name;
                        echo $name;?>
                </td>
                 <td>
                    <?php $name = $this->db->get_where('branch' , array('branch_id' => $row['branch_id'] ))->row()->name;
                        echo $name;?>
                </td>
                <td>
                    <?php if($row['department_id'] == 0){$name='All Departments';}else{$name = $this->db->get_where('department' , array('department_id' => $row['department_id'] ))->row()->name;}
                        echo $name;?>
                </td>
                <?php if($account_type != 'doctors'){?><td><a href="<?php echo base_url();?>main/view_doctors/nurse/<?php echo $row['nurse_id']?>" class="hiper">View Doctors</a></td><?php }?>
                <td><?php if($row['status'] == 1){echo "<button type='button' class='btn-success'>Active</button>";  
                 }
                 else if(
                 $row['status'] == 2){ echo "<button type='button' class='btn-danger'>Inactive</button>";}?>
                     
                 </td>
                <?php if($account_type=='superadmin' || $account_type=='hospitaladmins'){?>
                <td>
                    <?php if($row['is_email'] == '2'){?>
                <a href="<?php echo base_url(); ?>main/resend_email_verification/nurse/nurse/<?php echo $row['unique_id'] ?>" title="Verification Mail"><i class="glyphicon glyphicon-envelope"></i></a><?php }?>
                <?php if($row['isDeleted'] == '1'){?>
                <a href="#" onclick="confirm_modal('<?php echo base_url();?>main/nurse/delete/<?php echo $row['nurse_id']?>');" id="dellink_2" class="delbtn" data-toggle="modal" data-target=".bs-example-modal-sm" data-id="2" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
                </td><?php }}?>
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