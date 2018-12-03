<?php 
$this->session->set_userdata('last_page', current_url());
?>
<?php if($account_type=='superadmin' || $account_type=='hospitaladmins' || $account_type=='users' || $account_type=='medicalstores' || $account_type=='medicallabs'){?>
<div class="row">
    <div class="col-lg-12">
<div class="panel panel-default">   
<div class="panel-heading">
Order With Prescription
</div>
<div class="panel-body">
<table data-toggle="table"data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">  
    <thead>
        <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value=""></th>
            <th data-field="hospital" data-sortable="true"><?php echo get_phrase('hospital / doctor'); ?></th>
            <th data-field="patient" data-sortable="true"><?php echo get_phrase('patient'); ?></th>
            <th data-field="contact_number" data-sortable="true"><?php echo get_phrase('contact_number'); ?></th>
            <th data-field="address" data-sortable="true"><?php echo get_phrase('address'); ?></th>
            <th data-field="status" data-sortable="true"><?php echo get_phrase('status'); ?></th>
            <th><?php echo get_phrase('prescription'); ?></th>
            <th><?php echo get_phrase('options'); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php
        $i=1;foreach ($order as $row1) {
            if($order_type==$row1['order_type'] && $row1['type_of_order']==0){
           $user_info=$this->crud_model->select_user_information($row1['user_id']);
           $prescription_info=$this->crud_model->select_prescription_information($row1['prescription_id']);
           foreach ($user_info as $user1) {
             
            ?>
            <tr>
                <td><input type="checkbox" name="check[]" class="check" id="check_<?php echo $i;?>" value="<?php echo $row1['order_id'] ?>"></td>
                <td><?php $doc=$this->db->where('doctor_id',$prescription_info['doctor_id'])->get('doctors')->row();echo $this->db->where('hospital_id',$doc->hospital_id)->get('hospitals')->row()->name.' / '.$doc->name?></td>
                <td><?php echo $user1['name'] ?></td>
                <td><?php echo $user1['phone'] ?></td>
                <td><?php echo $user1['address'] ?></td>
                <td><?php if($row1['status']==1){echo "Completed";}elseif($row1['status']==2){echo "Pending";} ?></td>
                <td><a href="<?php echo base_url(); ?>main/ordered_prescription_history/<?php echo $row1['order_id'].'/'.$row1['order_type']; ?>" class="hiper"><i class="fa fa-file"></i></a></td>
                <td><?php if($row1['status']==1){?><a href="<?php echo base_url(); ?>main/receipt/<?php echo $row1['order_id'] ?>" class="hiper">Receipt</a><?php }elseif($row1['status']==2 && $account_type=='medicalstores'|| $account_type=='medicallabs'){ ?>
                    <a href="<?php echo base_url(); ?>main/add_receipt/<?=$row1['order_id'];?>" class="hiper">Upload Receipt</a><?php }elseif($row1['status']==2 && $account_type!='medicalstores'|| $account_type!='medicallabs'){ ?>Receipt Not Upload<?php }?></td>
            </tr>
        <?php }$i++;}} ?>
    </tbody>
</table>
</div>
</div>
</div>
</div>
<?php }
if($account_type=='superadmin' || $account_type=='hospitaladmins' || $account_type=='users'){ ?>
<div class="row">
    <div class="col-lg-12">
<div class="panel panel-default">   
<div class="panel-heading">
Order By Doctors/Users
<?php if($account_type=='users'){?>
<button type="button" onclick="window.location.href = '<?php echo base_url();?>main/add_order/<?=$order_type;?>'" class="btn btn-primary pull-right">
        <?php if($order_type==0){echo get_phrase('Order Medicen');}elseif($order_type==1){echo get_phrase('Order Medical Tests');} ?>
</button>
<?php }?>
</div>
<div class="panel-body">
<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">  
    <thead>
        <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value=""></th>
            <th data-field="patient" data-sortable="true"><?php echo get_phrase('patient'); ?></th>
            <th data-field="contact_number" data-sortable="true"><?php echo get_phrase('contact_number'); ?></th>
            <th data-field="address" data-sortable="true"><?php echo get_phrase('address'); ?></th>
            <th data-field="status" data-sortable="true"><?php echo get_phrase('status'); ?></th>
            <th><?php echo get_phrase('prescription'); ?></th>
            <th><?php echo get_phrase('options'); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php
        $i=1;foreach ($order as $row1) {
            if($order_type==$row1['order_type'] && $row1['type_of_order']==1){
           $user_info=$this->crud_model->select_user_information($row1['user_id']);
           $prescription_info=$this->crud_model->select_prescription_information($row1['prescription_id']);
           foreach ($user_info as $user1) {
            ?>
            <tr>
                <td><input type="checkbox" name="check[]" class="check" id="check_<?php echo $i;?>" value="<?php echo $row1['order_id'] ?>"></td>
                <td><?php echo $user1['name'] ?></td>
                <td><?php echo $user1['phone'] ?></td>
                <td><?php echo $user1['address'] ?></td>
                <td><?php if($row1['status']==1){echo "Completed";}elseif($row1['status']==2){echo "Pending";} ?></td>
                <td><a href="<?php echo base_url(); ?>main/ordered_prescription_history/<?php echo $row1['order_id'].'/'.$row1['order_type']; ?>" class="hiper"><i class="fa fa-file"></i></a></td>
                <td><a href="<?php echo base_url(); ?>main/receipt/<?php echo $row1['order_id'] ?>" class="hiper"><?php if($row1['status']==1){echo 'Receipt';}elseif($row1['status']==2){ ?>
                    <a href="<?php echo base_url(); ?>main/add_receipt/<?=$row1['order_id'];?>" class="hiper">Upload Receipt</a><?php }?></a></td>
            </tr>
        <?php }$i++;}} ?>
    </tbody>
</table>
</div>
</div>
</div>
</div>
<?php }?>
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