<?php 
$this->session->set_userdata('last_page', current_url());
?>
<form action="<?php echo base_url()?>main/hospital_admins/delete_multiple/" method="post">
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
<button type="button" onclick="window.location.href = '<?php echo base_url(); ?>main/add_hospital_admins'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_hospital_admin'); ?>
</button>
</div>
<div class="panel-body">
<table data-toggle="table" data-url="tables/data1.json"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">
    <thead>  
        <tr>   
        <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value=""></th>
        <th data-field="id" data-sortable="true"><?php echo get_phrase('hospital_admin_id');?></th>
        <th data-field="name" data-sortable="true"><?php echo get_phrase('hospital_admin_name'); ?></th> 
        <th data-field="hospital" data-sortable="true"><?php echo get_phrase('hospital'); ?></th>
        <th data-field="status" data-sortable="true"><?php echo get_phrase('status'); ?></th> 
        <th><?php echo get_phrase('options'); ?></th>   
        </tr>
    </thead>
  
    <tbody>
        <?php  $i=1;foreach ($admin_info as $row) {
       
        ?>   
            <tr>
                <td><input type="checkbox" name="check[]" class="check" id="check_<?php echo $i;?>" value="<?php echo $row['admin_id'] ?>"></td>
                <td><?php echo $row['unique_id'];?></td>
                <td><a href="<?php echo base_url(); ?>main/edit_hospital_admins/<?php echo $row['admin_id'] ?>" class="hiper"><?php echo $row['name'] ?></a></td>
                <td><?php echo $this->db->get_where('hospitals',array('hospital_id'=>$row['hospital_id']))->row()->name; ?></td>
               
                 <td><?php if($row['status'] == 1){echo "<button type='button' class='btn-success'>Active</button>";   
                 }elseif($row['status'] == 2){ echo "<button type='button' class='btn-danger'>Inactive</button>";}?></td>
                <td>
                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>main/hospital_admins/delete/<?php echo $row['admin_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i>
                </a>
                <?php if($row['is_email'] == '2'){?>
                <a href="<?php echo base_url(); ?>main/resend_email_verification/hospitaladmins/admin/<?php echo $row['unique_id'] ?>" title="Verification Mail"><i class="glyphicon glyphicon-envelope"></i></a><?php }?>
                </td>
            </tr>
        <?php $i++;} ?>
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
