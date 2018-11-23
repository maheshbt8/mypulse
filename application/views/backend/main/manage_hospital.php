<?php 
$this->session->set_userdata('last_page', current_url());
?>
<form action="<?php echo base_url()?>main/hospital/delete_multiple/" method="post">
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">   
            <div class="panel-heading">
<?php if($account_type == 'superadmin'){?>
<button type="button" onClick="confSubmit(this.form);" id="delete" class="btn btn-danger pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onClick="checkone(this.form);" id="delete1" class="btn btn-danger pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onclick="window.location.href = '<?php echo base_url(); ?>main/add_hospital/'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_hospital'); ?>
</button>
<?php }?>
</div>
<div class="panel-body">
<table data-toggle="table" data-url="tables/data1.json"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">
    <thead>
        <tr><?php if($account_type == 'superadmin'){?>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value=""></th><?php }?>
            <th data-field="id" data-sortable="true"><?php echo get_phrase('hospital_id');?></th>
            <th data-field="name" data-sortable="true"><?php echo get_phrase('hospital_name'); ?></th>
            <th data-field="license" data-sortable="true"><?php echo get_phrase('license_status'); ?></th>
            <th data-field="branch" data-sortable="true"><?php echo get_phrase('branches'); ?></th>
            <th><?php echo get_phrase('options'); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php  $i=1;foreach ($hospital_info as $row) {?>   
            <tr><?php if($account_type == 'superadmin'){?>
                <td><input type="checkbox" name="check[]" class="check" id="check_<?php echo $i;?>" value="<?php echo $row['hospital_id'] ?>"></td><?php }?>
                <td><?php echo $row['unique_id'];?></td>
                <td><a href="<?php echo base_url();?>main/get_hospital_history/<?php echo $row['hospital_id'];?>" class="hiper"><?php echo $row['name'] ?></a></td>
                <td><?php $license_code=$this->db->where('license_id',$row['license'])->get('license')->row()->license_code;
                 if($row['license_status'] == 1){echo "<button type='button' class='btn-success'>".$license_code." - Active</button>";   
                 }
                 else if($row['license_status'] == 2){ echo "<button type='button' class='btn-danger'>".$license_code." - Inactive</button>";}?>
                </td>
                 <td>
            <a href="<?php echo base_url(); ?>main/get_hospital_branch/<?php echo $row['hospital_id'] ?>" title="Branches"><i class="glyphicon glyphicon-eye-open"></i></a>     
                </td>
                
                <td>
           <?php if($account_type == 'superadmin'){?>
            <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>main/hospital/delete/<?php echo $row['hospital_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a><?php }elseif($account_type == 'users'){?>
                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>main/hospital/delete_hospital/<?php echo $row['hospital_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
            <?php }?>
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
