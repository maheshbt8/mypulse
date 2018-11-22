<?php 
$this->session->set_userdata('last_page', current_url());
?>
<form action="<?php echo base_url()?>main/bed/delete_multiple/" method="post">
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
<button type="button" onclick="window.location.href = '<?php echo base_url();?>main/add_bed/<?= $ward_id;?>'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_bed'); ?>
</button>
</div>
<div class="panel-body">
<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">
    <thead>
        <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value=""></th>
            <th data-field="name" data-sortable="true"><?php echo get_phrase('name'); ?></th>
            <th data-field="name" data-sortable="true"><?php echo get_phrase('hospital_name'); ?></th>
            <th data-field="branch" data-sortable="true"><?php echo get_phrase('branch_name'); ?></th>
            <th data-field="department" data-sortable="true"><?php echo get_phrase('department_name'); ?></th>
            <th data-field="ward" data-sortable="true"><?php echo get_phrase('ward_name'); ?></th>
            <th><?php echo get_phrase('options'); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php 
        $i=1;
        foreach ($bed_info as $row) { ?>   
            <tr>
             
                <td><input type="checkbox" name="check[]" class="check" id="check_<?php echo $i;?>" value="<?php echo $row['bed_id'] ?>"></td>
                <td><a href="<?php echo base_url(); ?>main/edit_bed/<?php echo $row['bed_id'] ?>" class="hiper"><?php echo $row['name'] ?></a></td>
                <td><?php echo $this->db->where('hospital_id',$row['hospital_id'])->get('hospitals')->row()->name; ?></td>
                <td><?php echo $this->db->where('branch_id',$row['branch_id'])->get('branch')->row()->name; ?></td>
                <td><?php echo $this->db->where('department_id',$row['department_id'])->get('department')->row()->name; ?></td>
                <td><?php echo $this->db->where('ward_id',$row['ward_id'])->get('ward')->row()->name; ?></td>
                
                <td>
           
            <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>main/bed/delete/<?php echo $row['bed_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
                </td>
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