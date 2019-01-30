<?php 
$this->session->set_userdata('last_page', current_url());
?>
<form action="<?php echo base_url()?>main/medical_labs/delete_multiple/" method="post">
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
<button type="button" onclick="window.location.href = '<?php echo base_url();?>main/add_labs'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_medical_labs'); ?>
</button>
<?php }?>
<?php if($account_type == 'users'){?>
<a href="<?php echo base_url(); ?>main/add_order/1/" class="pull-right" title="Order Medical Tests"><em class="fa fa-lg fa-plus-square color-red"></em>
            </a>
<?php }?>
</div>
<div class="panel-body">
<table data-toggle="table" data-url="tables/data1.json"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">
    <thead>  
        <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value=""></th>
            <th data-field="id" data-sortable="true"><?php echo get_phrase('lab_id');?></th>
            <th data-field="name" data-sortable="true"><?php echo get_phrase('name');?></th>   
            <th data-field="owner" data-sortable="true"><?php echo get_phrase('owner_name');?></th>
            <th data-field="phone" data-sortable="true"><?php echo get_phrase('owner phone number');?></th>
            <th data-field="hospital" data-sortable="true"><?php echo get_phrase('hospital');?></th> 
             <th data-field="branch" data-sortable="true"><?php echo get_phrase('branch');?></th>
            <th><?php echo get_phrase('status');?></th>
            <th><?php echo get_phrase('options');?></th>
        </tr>
    </thead>

    <tbody>
        <?php 
        if($account_type=='superadmin' || $account_type=='hospitaladmins'){$lab_info = $this->crud_model->select_lab_info_table();}
        $i=1;foreach ($lab_info as $row) { ?>   
            <tr>
                <td><input type="checkbox" name="check[]" class="check" id="check" value="<?php echo $row['lab_id'] ?>"></td>
                <td><?php echo $row['unique_id'];?></td>
                 <td><a href="<?php echo base_url();?>main/edit_labs/<?php echo $row['lab_id']?>" class="hiper"><?php echo $row['name'] ?></a></td>
                <td><?php echo $row['owner_name'] ?></td>
                <td><?php echo $row['owner_mobile'] ?></td>
                <td><?php echo $this->db->get_where('hospitals',array('hospital_id'=>$row['hospital']))->row()->name; ?></td>
                <td><?php echo $this->db->get_where('branch',array('branch_id'=>$row['branch']))->row()->name; ?></td>
                <td><?php if($row['status'] == 1){echo "<button type='button' class='btn-success'>Active</button>";  
                 }
                 else if(
                 $row['status'] == 2){ echo "<button type='button' class='btn-danger'>Inactive</button>";}?>
                 </td>
               <td>
<?php if($account_type == 'superadmin'||$account_type == 'hospitaladmins'){?>
               <?php if($row['is_email'] == '2'){?>
                <a href="<?php echo base_url(); ?>main/resend_email_verification/medicallabs/lab/<?php echo $row['unique_id'] ?>" title="Verification Mail"><i class="glyphicon glyphicon-envelope"></i></a><?php }?>
                <?php if($row['isDeleted'] == '1'){?>
                <a href="#" onclick="confirm_modal('<?php echo base_url();?>main/medical_labs/delete/<?php echo $row['lab_id']?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
                <?php }}elseif($account_type == 'users'){?>
                <a href="<?php echo base_url(); ?>main/add_order/1/<?=$row['lab_id'];?>" title="Order Medical Tests"><em class="fa fa-sm fa-plus-square color-red"></em>
            </a>&nbsp;&nbsp; 
                <a href="#" onclick="confirm_modal('<?php echo base_url();?>main/medical_labs/delete_lab/<?php echo $row['lab_id']?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a><?php }?>
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