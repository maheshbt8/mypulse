<?php 
$this->session->set_userdata('last_page', current_url());
?>
<form action="<?php echo base_url()?>main/medical_labs/delete_multiple/" method="post">
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">   
            <div class="panel-heading">
            </div>
<div class="panel-body">
<table data-toggle="table" data-url="tables/data1.json"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">
    <thead>  
        <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value=""></th>
            <th data-field="id" data-sortable="true"><?php echo get_phrase('patient_no.');?></th>
            <th data-field="name" data-sortable="true"><?php echo get_phrase('name');?></th>   
            <th data-field="email" data-sortable="true"><?php echo get_phrase('email');?></th>
            <th data-field="status" data-sortable="true"><?php echo get_phrase('status');?></th>
        </tr>
    </thead>

    <tbody>
        <?php  $j=1;
            foreach ($patient_info as $user) {
              
            ?>   
            <tr>
                <td><input type="checkbox" name="check[]" class="check" id="check_<?php echo $j;?>" value="<?php echo $user->user_id; ?>"></td>
                <td><?php echo $user->unique_id;?></td>
                 <td><a href="<?php echo base_url();?>main/edit_user/<?php echo $user->user_id;?>" class="hiper"><?php echo $user->name;?></a></td>
                <td><?php echo $user->email;?></td>
                <td><?php if($user->row_status_cd == 1){echo "<button type='button' class='btn-success'>Active</button>";}elseif($user->row_status_cd == 2){ echo "<button type='button' class='btn-danger'>Inactive</button>";}?></td>
            </tr>
        <?php  $j++;}?>
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