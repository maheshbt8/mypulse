<?php 
$this->session->set_userdata('last_page', current_url());
?>

<div class="row">
<div class="col-lg-12">
<ul class="nav nav-tabs bordered"> 
    <li class="active">
    <a href="#h1" data-toggle="tab"><i class="entypo-plus-circled"></i>
    <?php echo 'Orders based on Prescription';?>
    </a>
    </li>
    <li>
    <a href="#h2" data-toggle="tab"><i class="entypo-plus-circled"></i>
    <?php echo 'Orders without Prescription';?>
    </a>
    </li>
</ul> 
<div class="panel panel-default">

<div class="panel-body">
<div class="tab-content">
<?php if($account_type=='superadmin' || $account_type=='hospitaladmins' || $account_type=='users' || $account_type=='medicalstores' || $account_type=='medicallabs'){ ?>
<div class="tab-pane box active" id="h1" style="padding: 5px">
<div class="panel-heading">
<button type="button" class="btn btn-info pull-right" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'" style="margin-left: 2px;"><i class="glyphicon glyphicon-refresh icon-refresh"></i>&nbsp;Refresh</button>
</div>
<table data-toggle="table"data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">  
    <thead>
        <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value=""></th>
            <th><?php echo get_phrase('order_no.'); ?></th>
            <th data-field="hospital" data-sortable="true"><?php echo get_phrase('hospital / doctor'); ?></th>
            <th data-field="patient" data-sortable="true"><?php echo get_phrase('patient'); ?></th>
            <?php if($account_type!='medicallabs' && $account_type != 'medicalstores'){ ?><th data-field="<?php if($order_type==0){echo get_phrase('store');}elseif($order_type==1){echo get_phrase('lab');} ?>" data-sortable="true"><?php if($order_type==0){echo get_phrase('medical store');}elseif($order_type==1){echo get_phrase('medical lab');} ?></th><?php }?>
            <th data-field="date" data-sortable="true"><?php echo get_phrase('date & time'); ?></th>
            <th><?php echo get_phrase('receipt'); ?></th>
            <?php if($account_type=='medicallabs' || $account_type == 'medicalstores'){ ?><th data-field="status" data-sortable="true"><?php echo get_phrase('status'); ?></th><?php }?>
            <th><?php if($account_type=='medicallabs' || $account_type == 'medicalstores'){ echo get_phrase('Action');}else{echo "Status";} ?></th>
            <?php if($account_type=='users'){?><th>Options</th><?php }?>
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
                <td><a href="<?php echo base_url(); ?>main/ordered_prescription_history/<?php echo $row1['order_id'].'/'.$row1['order_type']; ?>" class="hiper"><?=$row1['unique_id'];?></a></td>
                <td><?php $doc=$this->db->where('doctor_id',$prescription_info['doctor_id'])->get('doctors')->row();echo $this->db->where('hospital_id',$doc->hospital_id)->get('hospitals')->row()->name.' / '.$doc->name?></td>
                <td><a href="<?php echo base_url();?>main/edit_user/<?php echo $row1['user_id']?>" class="hiper"><?php echo $user1['name'] ?></a></td>
                <?php if($account_type!='medicallabs' && $account_type != 'medicalstores'){?><td><?php if($order_type==0){ ?><a href="<?php echo base_url();?>main/edit_stores/<?php echo $row1['store_id']?>" class="hiper"><?php echo get_phrase($this->db->where('store_id',$row1['store_id'])->get('medicalstores')->row()->name);?></a><?php }elseif($order_type==1){ ?><a href="<?php echo base_url();?>main/edit_labs/<?php echo $row1['lab_id']?>" class="hiper"><?php echo get_phrase($this->db->where('lab_id',$row1['lab_id'])->get('medicallabs')->row()->name);?> </a><?php } ?></td><?php }?>
                <td><?php echo date('d M,Y h:i A',strtotime($row1['created_at']));?></td>
                <td><?php if($row1['status']!=1 && $row1['status']!=2 && $row1['status']!=4 && $row1['status']!=8){echo '<a href="'.base_url().'main/receipt/'.$row1['order_id'].'" class="hiper"><i class="fa fa-file"></i>&nbsp;Receipt</a>';}else{echo "Receipt Not Uploaded";}?></td>
                <?php if($account_type=='medicallabs' || $account_type == 'medicalstores'){ ?> <td>
                    <?php 
                        if($row1['status']==1){
                            echo "Pending";
                        }elseif($row1['status']==2){
                            echo "Order Received";
                        }elseif($row1['status']==3){
                            echo "Waiting for Samples";
                        }elseif($row1['status']==4){
                        if($order_type==0){echo "Being Processed";}elseif($order_type==1){echo "Tests in Progress";}
                        }elseif($row1['status']==5){
                            echo "Out for Delivery";
                        }elseif($row1['status']==6){
                            echo "Reports Submitted";
                        }elseif($row1['status']==7){
                            if($order_type==0){
                            $title_name="Delivered";
                            }elseif($order_type==1){
                            $title_name="Completed";
                            }
                            echo $title_name;
                        }elseif($row1['status']==8){
                            if($order_type==0){
                            $title_name="To Be Delivered";
                            }elseif($order_type==1){
                            $title_name="Being Processed";
                            }
                            echo $title_name;
                        }
                    ?>
                </td><?php }?>
                <td>
                    <?php 
                        if($row1['status']==1){
                            echo "Pending";
                        }elseif($row1['status']==2){
                            if($order_type==0){
                                $stat=4;
                            }elseif($order_type==1){
                                $stat=8;
                            };
                            if($account_type!='medicallabs' && $account_type != 'medicalstores'){
                            echo "Order Received";
                            }else{
                            echo '<button type="button" class="btn-primary" onclick="window.location.href='."'".base_url('main/orders/order_status/').$row1['order_id'].'/'.$stat."'".'">Confirm Order</button>';
                            }
                        }elseif($row1['status']==3){
                            if($account_type!='medicallabs' && $account_type != 'medicalstores'){
                            echo "Waiting for Samples";
                            }else{
                            echo '<button type="button" class="btn-primary" onclick="window.location.href='."'".base_url('main/orders/order_status/').$row1['order_id'].'/4'."'".'">Samples Received</button>';
                            }
                        }elseif($row1['status']==4){
                            if($account_type!='medicallabs' && $account_type != 'medicalstores'){
                            if($row1['order_type']==0){echo "Being Processed";}elseif($row1['order_type']==1){echo "Tests in Progress";}
                            }else{
                            if($order_type==0){
                                echo '<a href="'.base_url()."main/add_receipt/".$row1['order_id'].'" class="hiper">Upload Receipt</a>';
                            }elseif($order_type==1){
                            echo '<a href="'.base_url()."main/add_prescription_reports/".$row1['order_id'].'" class="hiper">Upload Reports</a>';
                            }
                            }
                        }elseif($row1['status']==5){
                            if($account_type!='medicallabs' && $account_type != 'medicalstores'){
                            echo "Out for Delivery";
                            }else{
                            echo '<button type="button" class="btn-primary" onclick="window.location.href='."'".base_url('main/orders/order_status/').$row1['order_id'].'/7'."'".'">Delivered</button>';
                            }
                        }elseif($row1['status']==6){
                            if($account_type!='medicallabs' && $account_type != 'medicalstores'){
                            echo "Reports Submitted";
                            }else{
                            echo '<button type="button" class="btn-primary" onclick="window.location.href='."'".base_url('main/orders/order_status/').$row1['order_id'].'/7'."'".'">Completed</button>';
                            }
                        }elseif($row1['status']==7){
                            if($order_type==0){
                            $title_name="Delivered";
                            }elseif($order_type==1){
                            $title_name="Completed";
                            }
                            if($account_type!='medicallabs' && $account_type != 'medicalstores'){
                            echo $title_name;}
                        }elseif($row1['status']==8){
                            if($account_type!='medicallabs' && $account_type != 'medicalstores'){
                            if($order_type==0){
                            $title_name="To be Delivered";
                            }elseif($order_type==1){
                            $title_name="Being Processed";
                            }
                            echo $title_name;
                            }else{
                            if($order_type==0){
                            echo '<button type="button" class="btn-primary" onclick="window.location.href='."'".base_url('main/orders/order_status/').$row1['order_id'].'/5'."'".'">Out for Delivery</button>';
                            }elseif($order_type==1){
                            echo '<a href="'.base_url()."main/add_receipt/".$row1['order_id'].'" class="hiper">Upload Receipt</a>';
                            }
                            
                            }
                        }
                    ?>
                </td>
        <?php if($account_type=='users'){?><td><a href="<?php echo base_url(); ?>main/prescription_re_order/<?=$row1['order_id'];?>" title="<?php if($order_type==0){echo "Order Medicine";}elseif($order_type==1){echo "Order Medical Tests";}?>"><?php if($order_type==0){?><em class="fa fa-sm fa-medkit color-blue"></em><?php }elseif($order_type==1){?><em class="fa fa-sm fa-plus-square color-red"></em><?php }?>
            </a></td><?php }?>
            </tr>
        <?php }$i++;}} ?>
    </tbody>
</table>
</div>
<?php }
if($account_type=='superadmin' || $account_type=='hospitaladmins' || $account_type=='users' || $account_type=='medicalstores' || $account_type=='medicallabs'){ ?>
<div class="tab-pane box" id="h2" style="padding: 5px">
<?php if($account_type=='users'){?>
<div class="panel-heading">
<button type="button" class="btn btn-info pull-right" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'" style="margin-left: 2px;"><i class="glyphicon glyphicon-refresh icon-refresh"></i>&nbsp;Refresh</button>
<button type="button" onclick="window.location.href = '<?php echo base_url();?>main/add_order/<?=$order_type;?>'" class="btn btn-primary pull-right">
        <?php if($order_type==0){echo get_phrase('Order Medicine');}elseif($order_type==1){echo get_phrase('Order Medical Tests');} ?>
</button>
</div>
<?php }?>
<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">  
    <thead>
        <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value=""></th>
            <th><?php echo get_phrase('order_no.'); ?></th>
            <th data-field="patient" data-sortable="true"><?php echo get_phrase('patient'); ?></th>
           <?php if($account_type!='medicallabs' && $account_type != 'medicalstores'){?> <th data-field="<?php if($order_type==0){echo get_phrase('store');}elseif($order_type==1){echo get_phrase('lab');} ?>" data-sortable="true"><?php if($order_type==0){echo get_phrase('medical store');}elseif($order_type==1){echo get_phrase('medical lab');} ?></th><?php }?>
            <th data-field="date" data-sortable="true"><?php echo get_phrase('date & time'); ?></th>
            <th><?php echo get_phrase('receipt'); ?></th>
            <?php if($account_type=='medicallabs' || $account_type == 'medicalstores'){ ?><th data-field="status" data-sortable="true"><?php echo get_phrase('status'); ?></th><?php }?>
            <th><?php if($account_type=='medicallabs' || $account_type == 'medicalstores'){ echo get_phrase('Action');}else{echo "Status";} ?></th>
            <?php if($account_type=='users'){?><th>Options</th><?php }?>
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
                <td><a href="<?php echo base_url(); ?>main/ordered_prescription_history/<?php echo $row1['order_id'].'/'.$row1['order_type']; ?>" class="hiper"><?=$row1['unique_id'];?></a></td>
                <td><a href="<?php echo base_url();?>main/edit_user/<?php echo $row1['user_id']?>" class="hiper"><?php echo $user1['name'] ?></a></td>
                <?php if($account_type!='medicallabs' && $account_type != 'medicalstores'){?><td><?php if($order_type==0){ ?><a href="<?php echo base_url();?>main/edit_stores/<?php echo $row1['store_id']?>" class="hiper"><?php echo get_phrase($this->db->where('store_id',$row1['store_id'])->get('medicalstores')->row()->name);?></a><?php }elseif($order_type==1){ ?><a href="<?php echo base_url();?>main/edit_labs/<?php echo $row1['lab_id']?>" class="hiper"><?php echo get_phrase($this->db->where('lab_id',$row1['lab_id'])->get('medicallabs')->row()->name);?> </a><?php } ?></td><?php }?>
                <td><?php echo date('d M,Y h:i A',strtotime($row1['created_at']));?></td>
                <td><?php if($row1['status']!=1 && $row1['status']!=2 && $row1['status']!=4 && $row1['status']!=8){echo '<a href="'.base_url().'main/receipt/'.$row1['order_id'].'" class="hiper"><i class="fa fa-file"></i>&nbsp;Receipt</a>';}else{echo "Receipt Not Uploaded";}?></td>
                <?php if($account_type=='medicallabs' || $account_type == 'medicalstores'){ ?> <td>
                    <?php 
                      if($row1['status']==1){
                            echo "Pending";
                        }elseif($row1['status']==2){
                            echo "Order Received";
                        }elseif($row1['status']==3){
                            echo "Waiting for Samples";
                        }elseif($row1['status']==4){
                        if($order_type==0){echo "Being Processed";}elseif($order_type==1){echo "Tests in Progress";}
                        }elseif($row1['status']==5){
                            echo "Out for Delivery";
                        }elseif($row1['status']==6){
                            echo "Reports Submitted";
                        }elseif($row1['status']==7){
                            if($order_type==0){
                            $title_name="Delivered";
                            }elseif($order_type==1){
                            $title_name="Completed";
                            }
                            echo $title_name;
                        }elseif($row1['status']==8){
                            if($order_type==0){
                            $title_name="To Be Delivered";
                            }elseif($order_type==1){
                            $title_name="Being Processed";
                            }
                            echo $title_name;
                        }
                    ?>
                </td><?php }?>
                <td>
                    <?php 
                       if($row1['status']==1){
                            echo "Pending";
                        }elseif($row1['status']==2){
                            if($order_type==0){
                                $stat=4;
                            }elseif($order_type==1){
                                $stat=8;
                            };
                            if($account_type!='medicallabs' && $account_type != 'medicalstores'){
                            echo "Order Received";
                            }else{
                            echo '<button type="button" class="btn-primary" onclick="window.location.href='."'".base_url('main/orders/order_status/').$row1['order_id'].'/'.$stat."'".'">Confirm Order</button>';
                            }
                        }elseif($row1['status']==3){
                            if($account_type!='medicallabs' && $account_type != 'medicalstores'){
                            echo "Waiting for Samples";
                            }else{
                            echo '<button type="button" class="btn-primary" onclick="window.location.href='."'".base_url('main/orders/order_status/').$row1['order_id'].'/4'."'".'">Samples Received</button>';
                            }
                        }elseif($row1['status']==4){
                            if($account_type!='medicallabs' && $account_type != 'medicalstores'){
                            if($row1['order_type']==0){echo "Being Processed";}elseif($row1['order_type']==1){echo "Tests in Progress";}
                            }else{
                            if($order_type==0){
                                echo '<a href="'.base_url()."main/add_receipt/".$row1['order_id'].'" class="hiper">Upload Receipt</a>';
                            }elseif($order_type==1){
                            echo '<a href="'.base_url()."main/add_prescription_reports/".$row1['order_id'].'" class="hiper">Upload Reports</a>';
                            }
                            }
                        }elseif($row1['status']==5){
                            if($account_type!='medicallabs' && $account_type != 'medicalstores'){
                            echo "Out for Delivery";
                            }else{
                            echo '<button type="button" class="btn-primary" onclick="window.location.href='."'".base_url('main/orders/order_status/').$row1['order_id'].'/7'."'".'">Delivered</button>';
                            }
                        }elseif($row1['status']==6){
                            if($account_type!='medicallabs' && $account_type != 'medicalstores'){
                            echo "Reports Submitted";
                            }else{
                            echo '<button type="button" class="btn-primary" onclick="window.location.href='."'".base_url('main/orders/order_status/').$row1['order_id'].'/7'."'".'">Completed</button>';
                            }
                        }elseif($row1['status']==7){
                            if($order_type==0){
                            $title_name="Delivered";
                            }elseif($order_type==1){
                            $title_name="Completed";
                            }
                            if($account_type!='medicallabs' && $account_type != 'medicalstores'){
                            echo $title_name;}
                        }elseif($row1['status']==8){
                            if($account_type!='medicallabs' && $account_type != 'medicalstores'){
                            if($order_type==0){
                            $title_name="To be Delivered";
                            }elseif($order_type==1){
                            $title_name="Being Processed";
                            }
                            echo $title_name;
                            }else{
                            if($order_type==0){
                            echo '<button type="button" class="btn-primary" onclick="window.location.href='."'".base_url('main/orders/order_status/').$row1['order_id'].'/5'."'".'">Out for Delivery</button>';
                            }elseif($order_type==1){
                            echo '<a href="'.base_url()."main/add_receipt/".$row1['order_id'].'" class="hiper">Upload Receipt</a>';
                            }
                            
                            }
                        }
                    ?>
                </td>
                <?php if($account_type=='users'){?><td><a href="<?php echo base_url(); ?>main/re_order/<?=$row1['order_id'];?>" title="<?php if($order_type==0){echo "Order Medicine";}elseif($order_type==1){echo "Order Medical Tests";}?>"><?php if($order_type==0){?><em class="fa fa-sm fa-medkit color-blue"></em><?php }elseif($order_type==1){?><em class="fa fa-sm fa-plus-square color-red"></em><?php }?>
            </a></td><?php }?>
            </tr>
        <?php }$i++;}} ?>
    </tbody>
</table>
</div>
<?php }?>
</div>
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