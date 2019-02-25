<?php 
$this->session->set_userdata('last_page', current_url());
?>
<form action="<?php echo base_url()?>main/medical_stores/delete_multiple/" method="post">
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">   
            <div class="panel-heading">
<?php if($account_type=='superadmin' || $account_type=='hospitaladmins'){?>
<button type="button" onClick="confSubmit(this.form);" id="delete" class="btn btn-danger pull-right delete" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onClick="checkone(this.form);" id="delete1" class="btn btn-danger pull-right delete1" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onclick="window.location.href = '<?php echo base_url();?>main/add_stores'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_medical_store'); ?>
</button>
<?php }?>
<?php
if($account_type=='users'){ ?>
    <a href="<?php echo base_url(); ?>main/add_order/0" class="pull-right" title="Order Medicine"><em class="fa fa-lg fa-medkit color-blue"></em>
            </a>

<?php }
?>
</div>
<div class="panel-body">
<table data-toggle="table" data-url="tables/data1.json"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">
    <thead>
        <tr>
             <?php if($account_type=='superadmin' || $account_type=='hospitaladmins'){ ?>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value=""></th><?php }?>
            <th><?php echo get_phrase('store_id');?></th>
            <th><?php echo get_phrase('name');?></th>   
            <th><?php echo get_phrase('owner name');?></th>
            <th><?php echo get_phrase('owner phone number');?></th>
            <th><?php echo get_phrase('hospital');?></th>
             <th><?php echo get_phrase('branch');?></th>
             <?php if($account_type!='users'){?>
            <th><?php echo get_phrase('status');?></th><?php }?>
            <th><?php echo get_phrase('options');?></th>
        </tr>
    </thead>

    <tbody>
        <?php if(($account_type=='superadmin' || $account_type=='hospitaladmins') && $page_name!='hospital_history'){$store_info = $this->crud_model->select_store_info_table();}
        $i=1;foreach ($store_info as $row) { ?>   
            <tr> <?php if($account_type=='superadmin' || $account_type=='hospitaladmins'){ ?>
               <td><input type="checkbox" name="check[]" class="check" id="check_<?php echo $i;?>" value="<?php echo $row['store_id'] ?>"></td><?php }?> 
               <td><?php echo $row['unique_id'];?></td>
                <td><a href="<?php echo base_url();?>main/edit_stores/<?php echo $row['store_id']?>" class="hiper"><?php echo $row['name'] ?></a></td>
                <td><?php echo $row['owner_name'] ?></td>
                <td><?php echo $row['owner_mobile'] ?></td>
                <td><?php echo $this->db->get_where('hospitals',array('hospital_id'=>$row['hospital']))->row()->name; ?></td>
                <td><?php echo $this->db->get_where('branch',array('branch_id'=>$row['branch']))->row()->name; ?></td>
                <?php if($account_type!='users'){?>
                <td><?php if($row['status'] == 1){echo "<button type='button' class='btn-success'>Active</button>";  
                 }
                 else if(
                 $row['status'] == 2){ echo "<button type='button' class='btn-danger'>Inactive</button>";}?>
                     
                 </td>
             <?php }?>
               <td>
                 <?php if($account_type == 'superadmin'||$account_type == 'hospitaladmins'){?>
                    <?php if($row['is_email'] == '2'){?>
                <a href="<?php echo base_url(); ?>main/resend_email_verification/medicalstores/store/<?php echo $row['unique_id'] ?>" title="Verification Mail"><i class="glyphicon glyphicon-envelope"></i></a><?php }?>
                <?php if($row['isDeleted'] == '1'){?>
                <a href="#" onclick="confirm_modal('<?php echo base_url();?>main/medical_stores/delete/<?php echo $row['store_id']?>');" title="Delete"><i class="glyphicon glyphicon-remove">
                </i></a>
                <?php }}elseif($account_type == 'users'){?>
            <a href="<?php echo base_url(); ?>main/add_order/0/<?=$row['store_id'];?>" title="Order Medicine"><em class="fa fa-sm fa-medkit color-blue"></em>
            </a>&nbsp;&nbsp;
                    <a href="#" onclick="confirm_modal('<?php echo base_url();?>main/medical_stores/delete_store/<?php echo $row['store_id']?>');" title="Delete"><i class="glyphicon glyphicon-remove">
                </i></a><?php }?>
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