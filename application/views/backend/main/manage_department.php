<?php 
$this->session->set_userdata('last_page', current_url());
$branch=$this->db->where('branch_id',$branch_id)->get('branch')->row_array();
?>
<form action="<?php echo base_url()?>main/department/delete_multiple/" method="post">
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">   
            <div class="panel-heading">
<div class="col-sm-8">
<?php if($account_type == 'superadmin' && $page_name != 'hospital_history'){ ?>
<div class="col-sm-4">   
<span for="field-ta" class="col-sm-4 control-label"> <?php echo get_phrase('Hospital'); ?></span> 
<div class="col-sm-8">
<select name="hospital" class="form-control" onchange="return get_branch(this.value)">
    <?php $hospitals=$this->db->get('hospitals')->result_array();
    foreach ($hospitals as $hospital) { ?>
<option value="<?=$hospital['hospital_id']?>" <?php if($hospital['hospital_id'] == $branch['hospital_id']){echo "selected";}?>><?=ucfirst($hospital['name'])?></option>
<?php    }?>
</select>
</div>
    </div>
<?php }?>
<?php if(($account_type == 'superadmin' || $account_type == 'hospitaladmins') && $page_name != 'hospital_history'){?>
<div class="col-sm-4">    
<span for="field-ta" class="col-sm-4 control-label"> <?php echo get_phrase('branch'); ?></span> 
<div class="col-sm-8">
<select name="branch" class="form-control" onchange="return get_departments(this.value)" id="branch">
    <?php $branchs=$this->db->where('hospital_id',$branch['hospital_id'])->get('branch')->result_array();
    foreach ($branchs as $branches) { ?>
<option value="<?=$branches['branch_id']?>" <?php if($branches['branch_id'] == $branch_id){echo "selected";}?>><?=ucfirst($branches['name'])?></option>
<?php    }?>
</select>
</div>
</div>
<?php }?>
</div>
<div class="col-sm-4">
<button type="button" onClick="confSubmit(this.form);" id="delete" class="btn btn-danger pull-right delete" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onClick="checkone(this.form);" id="delete1" class="btn btn-danger pull-right delete1" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onclick="window.location.href = '<?php echo base_url(); ?>main/add_department/<?= $branch_id?>'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_department'); ?>
</button>
</div>
</div>
<div class="panel-body">
<table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">
    <thead>
        <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value=""></th>
            <th data-field="name" data-sortable="true"><?php echo get_phrase('name'); ?></th>
            <th data-field="hospital" data-sortable="true"><?php echo get_phrase('hospital_name'); ?></th>
            <th data-field="branch" data-sortable="true"><?php echo get_phrase('branch_name'); ?></th>
            <?php if($account_type=='superadmin' || $license_category=='MPHL_19002'){ ?><th data-field="ward" data-sortable="true"><?php echo get_phrase('wards'); ?></th><?php }?>
            <th><?php echo get_phrase('options'); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php $i=1;foreach ($department_info as $row) { ?>   
            <tr>  
                <td><input type="checkbox" name="check[]" class="check" id="check_<?php echo $i;?>" value="<?php echo $row['department_id'] ?>"></td>
                <td><a href="<?php echo base_url(); ?>main/edit_department/<?php echo $row['department_id'] ?>" class="hiper"><?php echo $row['name'] ?></a></td>
                <td><?php echo $this->db->where('hospital_id',$row['hospital_id'])->get('hospitals')->row()->name; ?></td>
                <td><?php echo $this->db->where('branch_id',$row['branch_id'])->get('branch')->row()->name; ?></td>
               <?php if($account_type=='superadmin' || $license_category=='MPHL_19002'){ ?> <td><a href="<?php echo base_url(); ?>main/get_hospital_ward/<?php echo $row['department_id'] ?>" title="Wards"><i class="glyphicon glyphicon-eye-open"></i></a></td><?php }?>
                <td>
            <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>main/department/delete/<?php echo $row['department_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
           
                </td>
            </tr>
        <?php $i++;} ?>
    </tbody>
</table>
</div>
</div>
 </div>
</div>
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
<script type="text/javascript">
    function get_branch(hospital_id) {
    
        $.ajax({
            url: '<?php echo base_url();?>ajax/get_branch/' + hospital_id ,
            success: function(response)
            {
                jQuery('#branch').html(response);
            }
        });

    }
    function get_departments(id) {
        window.location.href = '<?php echo base_url();?>main/get_hospital_departments/'+id;
    }
</script>