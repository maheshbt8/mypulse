<?php 
$this->session->set_userdata('last_page', current_url());
$ward=$this->db->where('ward_id',$ward_id)->get('ward')->row_array();
?>
<form action="<?php echo base_url()?>main/bed/delete_multiple/" method="post">
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">   
            <div class="panel-heading">
<div class="col-sm-10">
<?php if($account_type == 'superadmin' && $page_name != 'hospital_history'){ ?>
<div class="col-sm-3">   
<span for="field-ta" class="col-sm-4 control-label"> <?php echo get_phrase('Hospital'); ?></span> 
<div class="col-sm-8">
<select name="hospital" class="form-control" onchange="return get_branch(this.value)">
    <?php $hospitals=$this->crud_model->select_hospital();
    foreach ($hospitals as $hospital) { ?>
<option value="<?=$hospital['hospital_id']?>" <?php if($hospital['hospital_id'] == $ward['hospital_id']){echo "selected";}?>><?=ucfirst($hospital['name'])?></option>
<?php    }?>
</select>
</div>
    </div>
<?php }?>
<?php if(($account_type == 'superadmin' || $account_type == 'hospitaladmins') && $page_name != 'hospital_history'){?>
<div class="col-sm-3">    
<span for="field-ta" class="col-sm-4 control-label"> <?php echo get_phrase('branch'); ?></span> 
<div class="col-sm-8">
<select name="branch" class="form-control" onchange="return get_departments(this.value)" id="branch">
    <?php if($ward_id!=''){ $branchs=$this->crud_model->select_branch($ward['hospital_id']);}elseif($ward_id==''){$branchs=$this->crud_model->select_branch($this->session->userdata('hospital_id'));}
    if($ward_id==''){
        ?>
<option value="">Select Branch</option>
<?php    }
    foreach ($branchs as $branches) { ?>
<option value="<?=$branches['branch_id']?>" <?php if($branches['branch_id'] == $ward['branch_id']){echo "selected";}?>><?=ucfirst($branches['branch_name'])?></option>
<?php    }?>
</select>
</div>
</div>
<?php }?>
<?php if(($account_type == 'superadmin' || $account_type == 'hospitaladmins') && $page_name != 'hospital_history'){?>
<div class="col-sm-3">    
<span for="field-ta" class="col-sm-5 control-label"> <?php echo get_phrase('department'); ?></span> 
<div class="col-sm-7">
<select name="department" class="form-control" onchange="return get_ward(this.value)" id="department">
    <?php $departments=$this->crud_model->select_department_info_by_branch_id($ward['branch_id']);
    foreach ($departments as $departments) { ?>
<option value="<?=$departments['department_id']?>" <?php if($departments['department_id'] == $ward['department_id']){echo "selected";}?>><?=ucfirst($departments['dept_name'])?></option>
<?php    }?>
</select>
</div>
</div>
<?php }?>
<?php if(($account_type == 'superadmin' || $account_type == 'hospitaladmins') && $page_name != 'hospital_history'){?>
<div class="col-sm-3">    
<span for="field-ta" class="col-sm-5 control-label"> <?php echo get_phrase('ward'); ?></span> 
<div class="col-sm-7">
<select name="ward" class="form-control" onchange="return get_bed(this.value)" id="ward">
    <?php $wards=$this->crud_model->select_ward_info_by_department_id($ward['department_id']);
    foreach ($wards as $wards) { ?>
<option value="<?=$wards['ward_id']?>" <?php if($wards['ward_id'] == $ward['ward_id']){echo "selected";}?>><?=ucfirst($wards['ward_name'])?></option>
<?php    }?>
</select>
</div>
</div>
<?php }?>
</div>
<?php if($account_type == 'superadmin' || $account_type == 'hospitaladmins'){?>
<div class="col-sm-2">
<button type="button" onClick="confSubmit(this.form);" id="delete" class="btn btn-danger pull-right delete" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onClick="checkone(this.form);" id="delete1" class="btn btn-danger pull-right delete1" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onclick="window.location.href = '<?php echo base_url();?>main/add_bed/<?= $ward_id;?>'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_bed'); ?>
</button>
</div>
<?php }?>
</div>
<div class="panel-body">
<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">
    <thead>
        <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value=""></th>
            <th data-field="name" data-sortable="true"><?php echo get_phrase('name'); ?></th>
            <th data-field="hospital_name" data-sortable="true"><?php echo get_phrase('hospital_name'); ?></th>
            <th data-field="branch" data-sortable="true"><?php echo get_phrase('branch_name'); ?></th>
            <th data-field="department" data-sortable="true"><?php echo get_phrase('department_name'); ?></th>
            <th data-field="ward" data-sortable="true"><?php echo get_phrase('ward_name'); ?></th>
            <th data-field="status" data-sortable="true"><?php echo get_phrase('status'); ?></th>
            <?php if($account_type == 'superadmin' || $account_type == 'hospitaladmins'){?>
            <th><?php echo get_phrase('options'); ?></th>
        <?php }?>
        </tr>
    </thead>

    <tbody>
        <?php 
        $i=1;
        foreach ($bed_info as $row) { ?>   
            <tr>
<td><input type="checkbox" name="check[]" class="check" id="check_<?php echo $i;?>" value="<?php echo $row['bed_id'] ?>"></td>
<td><a href="<?php echo base_url(); ?>main/edit_bed/<?php echo $row['bed_id'] ?>" class="hiper"><?php echo $row['bed_name'] ?></a></td>
                <td><?php echo $this->db->where('hospital_id',$row['hospital_id'])->get('hospitals')->row()->name; ?></td>
                <td><?php echo $this->db->where('branch_id',$row['branch_id'])->get('branch')->row()->branch_name; ?></td>
                <td><?php echo $this->db->where('department_id',$row['department_id'])->get('department')->row()->dept_name; ?></td>
                <td><?php echo $this->db->where('ward_id',$row['ward_id'])->get('ward')->row()->ward_name; ?></td>
                <td><?php if($row['bed_status']==1){echo "Available";}elseif($row['bed_status']==2){echo "Not - Available";} ?></td>
                <?php if($account_type == 'superadmin' || $account_type == 'hospitaladmins'){?>
                <td><?php if($row['row_status_cd']!='0'){ ?>
            <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>main/bed/delete/<?php echo $row['bed_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a> <?php }else{echo '<span class="error"><b>Deleted</b></span>';}?>
                </td>
            <?php }?>
            </tr>
       <?php $i++; } ?>
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
    function get_departments(branch_id) {
    
        $.ajax({
            url: '<?php echo base_url();?>ajax/get_department/' + branch_id ,
            success: function(response)
            {
                jQuery('#department').html(response);
            }
        });

    }
    function get_ward(department_id) {
    
        $.ajax({
            url: '<?php echo base_url();?>ajax/get_ward/' + department_id ,
            success: function(response)
            {
                jQuery('#ward').html(response);
            }
        });

    }
    function get_bed(id) {
        window.location.href = '<?php echo base_url();?>main/get_hospital_bed/'+id;
    }
</script>