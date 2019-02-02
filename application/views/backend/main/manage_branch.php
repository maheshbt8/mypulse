<form action="<?php echo base_url()?>main/branch/delete_multiple/" method="post">
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">   
            <div class="panel-heading">
<?php if($account_type == 'superadmin' && $page_name != 'hospital_history'){ ?>
<div class="col-sm-5">
                  <div class="form-group">     
                        <span for="field-ta" class="col-sm-2 control-label"> <?php echo get_phrase('Hospital'); ?></span> 
                        <div class="col-sm-6">
<select name="hospital" class="form-control" onchange="return get_data(this.value)">
    <?php $hospitals=$this->db->get('hospitals')->result_array();
    foreach ($hospitals as $hospital) { ?>
<option value="<?=$hospital['hospital_id']?>" <?php if($hospital['hospital_id'] == $hospital_id){echo "selected";}?>><?=ucfirst($hospital['name'])?></option>
<?php    }?>
</select>
</div>
</div>
    </div>
<?php }?>

<?php if($account_type == 'superadmin' || $account_type == 'hospitaladmins'){?>
<button type="button" onClick="confSubmit(this.form);" id="delete" class="btn btn-danger pull-right delete" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onClick="checkone(this.form);" id="delete1" class="btn btn-danger pull-right delete1" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onclick="window.location.href = '<?php echo base_url(); ?>main/add_branch/<?php echo $hospital_id;?>'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_branch'); ?>
</button>
<?php }?>
</div>
<div class="panel-body">
<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">  
    <thead>
        <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value=""></th>
            <th data-field="name" data-sortable="true"><?php echo get_phrase('branch_name'); ?></th>
            <th data-field="email" data-sortable="true"><?php echo get_phrase('email'); ?></th>
            <th data-field="phone" data-sortable="true"><?php echo get_phrase('phone'); ?></th>
            <th data-field="department" data-sortable="true"><?php echo get_phrase('departments'); ?></th>
            <?php if($account_type == 'superadmin' || $account_type == 'hospitaladmins'){?>
            <th><?php echo get_phrase('options'); ?></th><?php }?>
        </tr>
    </thead>

    <tbody>
        <?php  $i=1;foreach ($branch_info as $row) {?>
        
            <tr>
                <td><input type="checkbox" name="check[]" class="check" id="check_<?php echo $i;?>" value="<?php echo $row['branch_id'] ?>"></td>
                <td><a href="<?php echo base_url(); ?>main/edit_branch/<?php echo $row['branch_id'] ?>" class="hiper"><?php echo $row['name'] ?></a></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['phone'] ?></td>
                <td>
            <a href="<?php echo base_url(); ?>main/get_hospital_departments/<?php echo $row['branch_id'] ?>" title="Departments"><i class="glyphicon glyphicon-eye-open"></i></a>
                </td>
        <?php if($account_type == 'superadmin' || $account_type == 'hospitaladmins'){?>
                <td>
            <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>main/branch/delete/<?php echo $row['branch_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
                </td>
            <?php }?>
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
        $(".delete1").show();
        $(".delete").hide();
 $(".all_check").click(function () {
    if($(this).prop("checked") == true){
                $(".delete1").hide();
                $(".delete").show();
            }
            else if($(this).prop("checked") == false){
                $(".delete1").show();
                $(".delete").hide();
            }
     $('input:checkbox').not(this).prop('checked', this.checked);
 });
         $(".check").click(function(){
            if(($(".check:checked").length)!=0){
            $(".delete1").hide();
            $(".delete").show();
        if($(".check").length == $(".check:checked").length) {
            $("#all_check").attr("checked", "checked");
        } else {
            $("#all_check").removeAttr("checked");
        }
    }else{
        $(".delete1").show();
        $(".delete").hide();
    }
    });
    });
</script>
<script type="text/javascript">
    function get_data(id) {
        window.location.href = '<?php echo base_url();?>main/get_hospital_branch/'+id;
    }
</script>