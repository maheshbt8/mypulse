<?php 
$this->session->set_userdata('last_page', current_url());
$department=$this->db->where('department_id',$department_id)->get('department')->row_array();
?>
<form action="<?php echo base_url()?>main/ward/delete_multiple/" method="post">
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">   
            <div class="panel-heading">
<div class="col-sm-10">
<?php if($account_type == 'superadmin'){ ?>
<div class="col-sm-4">   
<span for="field-ta" class="col-sm-4 control-label"> <?php echo get_phrase('Hospital'); ?></span> 
<div class="col-sm-8">
<select name="hospital" class="form-control" onchange="return get_branch(this.value)">
    <?php $hospitals=$this->db->get('hospitals')->result_array();
    foreach ($hospitals as $hospital) { ?>
<option value="<?=$hospital['hospital_id']?>" <?php if($hospital['hospital_id'] == $department['hospital_id']){echo "selected";}?>><?=ucfirst($hospital['name'])?></option>
<?php    }?>
</select>
</div>
    </div>
<?php }?>
<?php if($account_type == 'superadmin' || $account_type == 'hospitaladmins'){?>
<div class="col-sm-4">    
<span for="field-ta" class="col-sm-4 control-label"> <?php echo get_phrase('branch'); ?></span> 
<div class="col-sm-8">
<select name="branch" class="form-control" onchange="return get_departments(this.value)" id="branch">
    <?php $branchs=$this->db->where('hospital_id',$department['hospital_id'])->get('branch')->result_array();
    foreach ($branchs as $branches) { ?>
<option value="<?=$branches['branch_id']?>" <?php if($branches['branch_id'] == $department['branch_id']){echo "selected";}?>><?=ucfirst($branches['name'])?></option>
<?php    }?>
</select>
</div>
</div>
<?php }?>
<?php if($account_type == 'superadmin' || $account_type == 'hospitaladmins'){?>
<div class="col-sm-4">    
<span for="field-ta" class="col-sm-5 control-label"> <?php echo get_phrase('department'); ?></span> 
<div class="col-sm-7">
<select name="department" class="form-control" onchange="return get_ward(this.value)" id="department">
    <?php $departments=$this->db->where('branch_id',$department['branch_id'])->get('department')->result_array();
    foreach ($departments as $departments) { ?>
<option value="<?=$departments['department_id']?>" <?php if($departments['department_id'] == $department_id){echo "selected";}?>><?=ucfirst($departments['name'])?></option>
<?php    }?>
</select>
</div>
</div>
<?php }?>
</div>
<div class="col-sm-2">
<?php if($account_type=='superadmin' || $account_type=='hospitaladmins'){?>
<button type="button" onClick="confSubmit(this.form);" id="delete" class="btn btn-danger pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onClick="checkone(this.form);" id="delete1" class="btn btn-danger pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onclick="window.location.href = '<?php echo base_url(); ?>main/add_ward/<?= $department_id;?>'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_ward'); ?>
</button>
<?php }?>
</div>
</div>
<div class="panel-body">
<table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">
    <thead>
        <tr>
           <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value=""></th>
            <th><?php echo get_phrase('name'); ?></th>
            <th><?php echo get_phrase('hospital_name'); ?></th>
            <th><?php echo get_phrase('branch_name'); ?></th>
            <th><?php echo get_phrase('department_name'); ?></th>
            <th><?php echo get_phrase('beds'); ?></th>
            <th><?php echo get_phrase('options'); ?></th>
        </tr>
    </thead>

    <tbody>
        
        <?php $i=1;foreach ($ward_info as $row) { ?>   
            <tr>  
                <td><input type="checkbox" name="check[]" class="check" id="check_<?php echo $i;?>" value="<?php echo $row['ward_id'] ?>"></td>
                 <td><a href="<?php echo base_url(); ?>main/edit_ward/<?php echo $row['ward_id'] ?>" class="hiper"><?php echo $row['name'] ?></a></td>
                <td><?php echo $this->db->where('hospital_id',$row['hospital_id'])->get('hospitals')->row()->name; ?></td>
                <td><?php echo $this->db->where('branch_id',$row['branch_id'])->get('branch')->row()->name; ?></td>
                <td><?php echo $this->db->where('department_id',$row['department_id'])->get('department')->row()->name; ?></td>
                <td><a href="<?php echo base_url(); ?>main/get_hospital_bed/<?php echo $row['ward_id'] ?>" title="Beds"><i class="glyphicon glyphicon-eye-open"></i></a></td>
                <td>
            
            <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>main/ward/delete/<?php echo $row['ward_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
                 
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
    function get_ward(id) {
        window.location.href = '<?php echo base_url();?>main/get_hospital_ward/'+id;
    }
</script>