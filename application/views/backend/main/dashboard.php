<style>
    .title{
        font-size: 20px;
    }
</style>
<?php 
$this->session->set_userdata('last_page', current_url());
?>
			<div class="panel panel-container">
				<div class="row">
			<!-- ************** 1 ******************* -->
					<div class="col-xs-4 col-md-2 col-lg-2 no-padding">
						<div class="panel panel-teal panel-widget border-right">
							<div class="row no-padding"><em class="fa fa-xl <?php if($account_type=='doctors'){echo 'fa-user';}elseif($account_type=='medicalstores' || $account_type=='medicallabs'){echo 'fa-list-alt';}else{echo 'fa-hospital-o';}?> color-blue"></em>
								<div class="large">
<?php
if($account_type=='superadmin' || $account_type=='users'){
	echo count($this->crud_model->select_hospital_info());
}elseif($account_type=='hospitaladmins'){
	echo $this->db->where('hospital_id',$this->session->userdata('hospital_id'))->get('branch')->num_rows();
}elseif($account_type=='nurse' || $account_type=='receptionist'){
if($account_type=='nurse'){$dt=$this->db->where('nurse_id',$this->session->userdata('login_user_id'))->get('nurse')->row();if($dt->department_id==0){echo $this->db->where('branch_id',$dt->branch_id)->get('department')->num_rows();}else{echo count(explode(',',$dt->department_id));}}elseif($account_type=='receptionist'){$dt=$this->db->where('receptionist_id',$this->session->userdata('login_user_id'))->get('receptionist')->row(); if($dt->department_id==0){echo $this->db->where('branch_id',$dt->branch_id)->get('department')->num_rows();}else{echo count(explode(',',$dt->department_id));}}}elseif($account_type=='doctors'){echo count($this->crud_model->select_receptionist_info());}elseif($account_type=='medicalstores' || $account_type=='medicallabs'){echo count($this->crud_model->select_outstanding_order_info());}?>
</div>
<div class="text-muted"><?php if($account_type=='superadmin' || $account_type=='users'){echo "Hospitals";}elseif($account_type=='hospitaladmins'){echo 'Branches';}elseif($account_type=='nurse' || $account_type=='receptionist'){echo 'Departments';}elseif($account_type=='doctors'){echo 'receptionists';}elseif($account_type=='medicalstores'){echo 'Outstanding Orders';}elseif( $account_type=='medicallabs'){echo 'Outstanding Reports';}?></div>
							</div>
						</div>
					</div>
		<!-- ************** 2 ******************* -->
					<div class="col-xs-4 col-md-2 col-lg-2 no-padding">
						<div class="panel panel-blue panel-widget border-right">
							<div class="row no-padding"><em class="fa fa-xl <?php if($account_type=='doctors'){echo 'fa-user';}elseif($account_type=='medicalstores' || $account_type=='medicallabs'){echo 'fa-check-square';}else{echo 'fa-user-md';}?> color-orange"></em>
								<div class="large"><?php if($account_type=='superadmin' || $account_type=='hospitaladmins'|| $account_type=='nurse'|| $account_type=='receptionist'|| $account_type=='users'){ echo count($this->crud_model->select_doctor_info());}elseif($account_type=='doctors'){echo count($this->crud_model->select_nurse_info());}elseif($account_type=='medicalstores' || $account_type=='medicallabs'){echo count($this->crud_model->select_completed_order_info());}?></div>
								<div class="text-muted"><?php if($account_type=='superadmin' || $account_type=='hospitaladmins'|| $account_type=='nurse'|| $account_type=='receptionist'|| $account_type=='users'){echo 'Doctors';}elseif($account_type=='doctors'){echo 'Nurses';}elseif($account_type=='medicalstores'){echo 'Complete Orders';}elseif( $account_type=='medicallabs'){echo 'Complete Reports';}?></div>
							</div>
						</div>
					</div>
			<!-- ************** 3 ******************* -->
	<?php if($account_type != 'doctors' && $account_type != 'nurse' && $account_type != 'receptionist'&& $account_type != 'medicalstores'){?>
					<div class="col-xs-4 col-md-2 col-lg-2 no-padding">
						<div class="panel panel-orange panel-widget border-right">
							<div class="row no-padding"><em class="fa fa-xl <?php if($account_type == 'users'||$account_type == 'superadmin'|| $account_type == 'hospitaladmins'){echo 'fa-plus-square';}else{echo 'fa-users';}?> color-red"></em>
								<div class="large">
<?php if($account_type == 'medicalstores'|| $account_type == 'medicallabs'){echo count($this->crud_model->select_patient_info());}elseif($account_type == 'users'||$account_type == 'superadmin' || $account_type == 'hospitaladmins'){echo count($this->crud_model->select_lab_info());}?></div>
								<div class="text-muted"><?php if($account_type == 'medicalstores' || $account_type == 'medicallabs'){echo 'patients';}elseif($account_type == 'users'||$account_type == 'superadmin'|| $account_type == 'hospitaladmins'){echo 'Medical Labs';}?></div>
							</div>
						</div>
					</div>
				<?php }?>
<!-- ************** 4 ******************* -->
<?php if($account_type != 'nurse' && $account_type != 'receptionist'){?>
					<div class="col-xs-4 col-md-2 col-lg-2 no-padding">
						<div class="panel panel-orange panel-widget border-right">
							<div class="row no-padding"><em class="fa fa-xl <?php if($account_type == 'users'||$account_type == 'superadmin'|| $account_type == 'hospitaladmins'|| $account_type == 'medicalstores'){echo 'fa-medkit';}else{echo 'fa-users';}?> color-blue"></em>
								<div class="large">
<?php if($account_type == 'doctors'){echo count($this->crud_model->select_inpatient_info());}elseif($account_type == 'users'||$account_type == 'superadmin'|| $account_type == 'hospitaladmins'){echo count($this->crud_model->select_store_info());}elseif($account_type == 'medicalstores'){echo count($this->crud_model->select_order_info());}?></div>
								<div class="text-muted"><?php if($account_type == 'doctors' ){echo 'in-patients';}elseif($account_type == 'users'||$account_type == 'superadmin'|| $account_type == 'hospitaladmins'){echo 'Medical Stores';}elseif($account_type == 'medicalstores'){echo 'Total Orders';}?></div>
							</div>
						</div>
					</div>
			<?php }?>
			<!-- ************** 5 ******************* -->
            <?php if($account_type != 'users'){?>
					<div class="col-xs-4 col-md-2 col-lg-2 no-padding">
						<div class="panel panel-orange panel-widget border-right">
							<div class="row no-padding"><em class="fa fa-xl fa-users color-teal"></em>
								<div class="large">
<?php if($account_type=='superadmin'){echo $this->db->count_all('users');}elseif($account_type == 'medicalstores' || $account_type == 'doctors' || $account_type == 'medicallabs' || $account_type == 'hospitaladmins'){echo count($this->crud_model->select_patient_info());}elseif($account_type=='nurse'||$account_type=='receptionist'){echo count($this->crud_model->select_inpatient_info());}?></div>
								<div class="text-muted"><?php if($account_type=='superadmin'){echo 'Users';}elseif($account_type == 'medicalstores' || $account_type == 'doctors' || $account_type == 'medicallabs' || $account_type == 'hospitaladmins'){echo 'patients';}elseif($account_type=='nurse'||$account_type=='receptionist'){echo 'in-patients';}?></div>
							</div>
						</div>
					</div>
                <?php }?>
		<!-- ************** 6 ******************* -->
		<?php if($account_type!='medicalstores' && $account_type!='medicallabs'){?>
					<div class="col-xs-4 col-md-2 col-lg-2 no-padding">
						<div class="panel panel-red panel-widget">
							<div class="row no-padding"><em class="fa fa-xl fa-envelope color-red"></em>
								<div class="large">
<?php if($account_type != 'medicalstores' && $account_type != 'medicallabs'){echo count($this->crud_model->select_appointment_info());}?></div>
								<div class="text-muted"><?php if($account_type != 'medicalstores' && $account_type != 'medicallabs'){echo 'Appointments';}?></div>
							</div>
						</div>
					</div>
				<?php }?>

				</div><!--/.row-->
			</div>

<!-- Datbale Data -->
<?php $account_type=$this->session->userdata('login_type');$user_data=$this->db->where('user_id',1)->get('users')->row_array();?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
        <div class="panel-heading">
  <ul class="nav nav-tabs bordered">
        	<?php if($account_type == 'doctors'){?>
            <li class="active">
                <a href="#h1" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo 'APPOINTMENTS';?>

                </a>
            </li>
        <?php }?>
        <?php if($account_type == 'users'){?>
            <li class="active">
                <a href="#h2" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo 'MEDICINES';?>

                </a>
            </li>
            <li>
                <a href="#h3" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo 'MEDICIAL TESTS';?>

                </a>
            </li>
        <?php }?>
        <?php if($account_type == 'medicalstores' || $account_type == 'medicallabs'){?>
            <li class="active">
                <a href="#h4" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php 
        echo get_phrase('OUTSTANDING ORDERS');
                    ?>
                </a>
            </li>
        <?php }?>
        </ul>
        </div>
    
        <div class="panel-body">
          	<!-- FILTERS -->
     <?php if($account_type=='doctors'){?>
<div class="col-sm-12">
	<div class="col-sm-5">
                  <div class="form-group">
         <span for="field-ta" class="col-sm-3 control-label"><b> <?php echo get_phrase('date_range'); ?></b></span> 
         <div class="col-sm-7">
        <input  class="form-control" onclick="return get_report_data(this.value)" name="report" id="reportrange" value="<?php if((isset($_GET['sd']) && $_GET['sd'] != "") AND (isset($_GET['ed']) && $_GET['ed'] != "")){echo date('M d,Y',strtotime($_GET['sd'])).' - '.date('M d,Y',strtotime($_GET['ed']));}else{echo date('M d,Y', strtotime('-0 days')).' - '.date('M d,Y');}?>"/>
        </div>
                </div>
</div>
</div>
<script type="text/javascript">
        
    $(document).ready(function(){
        var start = moment().subtract(0, 'days');
        var end = moment();

        <?php
        if(isset($_GET['sd']) && $_GET['sd'] != ""){
            ?>
            start = moment('<?php echo $_GET['sd'];?>');
            <?php
        }
        ?>

        <?php
        if(isset($_GET['ed']) && $_GET['ed'] != ""){
            ?>
            end = moment('<?php echo $_GET['ed'];?>');
            <?php
        }
        ?>
        function cb(start, end) {
            window.location.href = '<?php echo base_url();?>main/dashboard?sd='+start.format('YYYY-MM-DD')+"&ed="+end.format('YYYY-MM-DD');

        }
        
        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            locale: { 
                applyLabel : '<?php echo $this->lang->line('apply');?>',
                cancelLabel: '<?php echo $this->lang->line('clear');?>',
                "customRangeLabel": "<?php echo $this->lang->line('custom');?>",
            },  
            ranges: {
                '<?php echo $this->lang->line('today');?>': [moment(), moment()],
                '<?php echo $this->lang->line('yesterday');?>': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                '<?php echo $this->lang->line('last_7_day');?>': [moment().subtract(6, 'days'), moment()],
                '<?php echo $this->lang->line('last_30_day');?>': [moment().subtract(29, 'days'), moment()],
                '<?php echo $this->lang->line('this_month');?>': [moment().startOf('month'), moment().endOf('month')],
                '<?php echo $this->lang->line('last_month');?>': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        },cb);

    });

</script>
<?php }?>
        <div class="tab-content">
      <?php if($account_type == 'doctors'){?>
    <div class="tab-pane box active" id="h1" style="padding: 5px">
<form action="<?php echo base_url()?>main/appointment/delete_multiple/" method="post">
<span class="title">TODAY'S APPOINTMENTS</span>
<button type="button" data-toggle="modal" data-target="#myModal" onClick="confcancel1(this.form);" id="cancel" class="btn btn-warning pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('cancel'); ?>
</button>
<button type="button" onClick="checkone(this.form);" id="cancel1" class="btn btn-warning pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('cancel'); ?>
</button>
<button type="button" onclick="window.location.href = '<?php echo base_url();?>main/add_appointment'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_appointment'); ?>
</button>
<table data-toggle="table" data-url="tables/data1.json"  data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">  
    <thead>
       <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value=""></th>
            <th><?php echo get_phrase('appointment_no');?></th> 
            <th><?php echo get_phrase('user');?></th>
            <th><?php echo get_phrase('city');?></th> 
            <th><?php echo get_phrase('date & time');?></th>
            <th><?php echo get_phrase('status'); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php if($_GET['sd']!=''&&$_GET['ed']!=''){$appointment_info=$this->crud_model->select_appointment_info_by_date($_GET['sd'],$_GET['ed']);}else{$appointment_info=$this->crud_model->select_today_appointment_info_by_doctor();}
        $i=1;foreach ($appointment_info as $row) {
            if(strtotime($row['appointment_date']) < strtotime(date('m/d/Y')))
            {
                $count=$this->db->get_where('appointments',array('appointment_id' => $row['appointment_id'],'status'=>2 ))->num_rows();
                if($count>0){
                $array=array('appointment_id'=>$row['appointment_id'],'status'=>2);
                $this->db->where($array)->update('appointments',array('status'=>'4'));
                $this->db->insert('appointment_history',array('appointment_id'=>$row['appointment_id'],'action'=>7,'created_type'=>'System','created_by'=>'MyPulse'));
                }
            }
            ?>   
            <tr>
                <td><input type="checkbox" name="check[]" class="check" id="check_<?php echo $i;?>" value="<?php echo $row['appointment_id'] ?>"></td>
                 <td><a href="<?php echo base_url(); ?>main/edit_appointment/<?php echo $row['appointment_id'] ?>" class="hiper"><?php echo $row['appointment_number'] ?></a>
                 </td>
                <td>
             <?php $name = $this->db->get_where('users' , array('user_id' => $row['user_id'] ))->row()->name;
                        echo $name;?>
                </td>
                 <td><?php echo $this->db->where('city_id',$branch->city)->get('city')->row()->name;?></td> 
                <td><?php echo date("d M, Y",strtotime($row['appointment_date']));?><br/><?php echo date("h:i A", strtotime($row['appointment_time_start'])).' - '.date("h:i A", strtotime($row['appointment_time_end']));?></td>
                <td><?php if($row['status'] == 1){echo "<button type='button' class='btn-danger'>Pending</button>";   
                 }
                 elseif($row['status'] == 2){ echo "<button type='button' class='btn-success'>Confirmed</button>";}
                 elseif($row['status'] == 3){ echo "<button type='button' class='btn-info'>Cancelled</button>";}
                 elseif($row['status'] == 4){ echo "<button type='button' class='btn-warning'>Closed</button>";}
                 ?>
                     
                 </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</form>
</div>
<?php }?>
<?php if($account_type == 'users'){?>
    <div class="tab-pane box active" id="h2" style="padding: 5px">
<form action="<?php echo base_url()?>main/appointment/delete_multiple/" method="post">
<span class="title">OUTSTANDING PRESCRIPTIONS FOR MEDICINES</span>
<table data-toggle="table" data-url="tables/data1.json"  data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">  
    <thead>
       <tr>
           <th><?php echo get_phrase('sl_no'); ?></th>
            <th><?php echo get_phrase('title (Prescription_for)'); ?></th>
            <th><?php echo get_phrase('date'); ?></th>
            <th><?php echo get_phrase('options'); ?></th>
        </tr>
    </thead>

    <tbody>
         <?php  
        $prescription_info=$this->db->order_by('prescription_id','desc')->get_where('prescription',array('user_id'=>$this->session->userdata('login_user_id'),'medicin_status'=>2))->result_array();
        $i=1;foreach ($prescription_info as $row1) {
            $prescription_data=explode('|',$this->encryption->decrypt($row1['prescription_data']));
            if($prescription_data[1]!=''){
            ?>
            <tr>
                <td><?php echo $i?></td>
                <td><a href="<?php echo base_url(); ?>main/prescription_history/<?php echo $row1['prescription_id'] ?>/0" class="hiper">
                    <?php echo $prescription_data[0];?></a></td>
                <td><?php echo $row1['created_at'] ?></td>
                <td>
        <a href="<?php echo base_url(); ?>main/prescription_order/<?php echo $row1['prescription_id'] ?>/0" title="Order Medicin"><i class="glyphicon glyphicon-plus"></i>
            </a>
                </td>
            </tr>
        <?php $i++;}} ?>
    </tbody>
</table>
</form>
</div>
 <div class="tab-pane box" id="h3" style="padding: 5px">
<form action="<?php echo base_url()?>main/appointment/delete_multiple/" method="post">
<span class="title">OUTSTANDING PRESCRIPTIONS FOR MEDICAL TESTS</span>
<table data-toggle="table" data-url="tables/data1.json"  data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">  
    <thead>
       <tr>
           <th><?php echo get_phrase('sl_no'); ?></th>
            <th><?php echo get_phrase('title'); ?></th>
            <th><?php echo get_phrase('date'); ?></th>
            <th><?php echo get_phrase('options'); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php  
        $prescription_info=$this->db->order_by('prescription_id','desc')->get_where('prescription',array('user_id'=>$this->session->userdata('login_user_id'),'test_status'=>2))->result_array();
        $i=1;foreach ($prescription_info as $row1) {
            $prescription_data=explode('|',$this->encryption->decrypt($row1['prescription_data']));
            if($prescription_data[7]!=''){
            ?>
            <tr>
                <td><?php echo $i?></td>
                <td><a href="<?php echo base_url(); ?>main/prescription_history/<?php echo $row1['prescription_id'] ?>/1" class="hiper">
                    <?php echo $prescription_data[0];?></a></td>
                <td><?php echo $row1['created_at'] ?></td>
                <td>

            <a href="<?php echo base_url(); ?>main/prescription_order/<?php echo $row1['prescription_id'] ?>/1" title="Order Medical Test"><i class="glyphicon glyphicon-plus"></i>
            </a>&nbsp;<!-- 
            <a href="#" onclick="confirm_modal('<?php echo base_url();?>main/receptionist/delete/<?php echo $row1['prescription_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a> -->
                </td>
            </tr>
        <?php $i++;}}?>
    </tbody>
</table>
</form>
</div>
<?php }?>
<?php if($account_type == 'medicalstores' || $account_type == 'medicallabs'){?>
    <div class="tab-pane box active" id="h2" style="padding: 5px">
<form action="<?php echo base_url()?>main/appointment/delete_multiple/" method="post">
<span class="title"><?php if($account_type == 'medicalstores'){
        echo get_phrase('OUTSTANDING ORDERS FOR MEDICINES');
    }
if($account_type == 'medicallabs'){
    echo get_phrase('OUTSTANDING ORDERS FOR LAB TESTS');
}?></span>
<table data-toggle="table" data-url="tables/data1.json"  data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">  
    <thead>
       <tr>
           <th><?php echo get_phrase('sl_no'); ?></th>
            <th><?php echo get_phrase('hospital / doctor'); ?></th>
            <th><?php echo get_phrase('patient'); ?></th>
            <th><?php echo get_phrase('contact_number'); ?></th>
            <th><?php echo get_phrase('address'); ?></th>
            <th><?php echo get_phrase('status'); ?></th>
            <th><?php echo get_phrase('prescription'); ?></th>
            <th><?php echo get_phrase('Upload Receipt'); ?></th>
        </tr>
    </thead>

    <tbody>
         <?php  
        $prescription_info=$this->crud_model->select_outstanding_order_info();
        $i=1;foreach ($prescription_info as $row1) {$user_info=$this->crud_model->select_user_information($row1['user_id']);
           $prescription_info=$this->crud_model->select_prescription_information($row1['prescription_id']);
           foreach ($user_info as $user1) {
            
            ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php if($row1['type_of_order']=='0'){$doc=$this->db->where('doctor_id',$prescription_info['doctor_id'])->get('doctors')->row();echo $this->db->where('hospital_id',$doc->hospital_id)->get('hospitals')->row()->name.' / '.$doc->name;}elseif($row1['type_of_order']==1){echo "Ordered By User";}?></td>
                <td><?php echo $user1['name'] ?></td>
                <td><?php echo $user1['phone'] ?></td>
                <td><?php echo $user1['address'] ?></td>
                <td><?php if($row1['status']==1){echo "Completed";}elseif($row1['status']==2){echo "Pending";} ?></td>
                <td><a href="<?php echo base_url(); ?>main/ordered_prescription_history/<?php echo $row1['order_id'].'/'.$row1['order_type'] ?>" class="hiper"><i class="fa fa-file"></i></a></td>
                <td>
  <a href="<?php echo base_url(); ?>main/add_receipt/<?=$row1['order_id'];?>" class="hiper">Upload Receipt</a>
                </td>
            </tr>
            
        <?php } $i++;} ?>
    </tbody>
</table>
</form>
</div>
<?php }?>  
</div>
</div>
</div>
</div>
</div>

<script>
    $(document).ready(function(){
        $("#cancel1").show();
        $("#cancel").hide();
 $(".all_check").click(function () {
    if($(this).prop("checked") == true){
                $("#cancel1").hide();
                $("#cancel").show();
            }
            else if($(this).prop("checked") == false){
                $("#cancel1").show();
                $("#cancel").hide();
            }
     $('input:checkbox').not(this).prop('checked', this.checked);
 });
         $(".check").click(function(){
            if(($(".check:checked").length)!=0){
            $("#cancel1").hide();
            $("#cancel").show();
        if($(".check").length == $(".check:checked").length) {
            $("#all_check").attr("checked", "checked");
        } else {
            $("#all_check").removeAttr("checked");
        }
    }else{
        $("#cancel1").show();
        $("#cancel").hide();
    }
    });
    });
</script>
 <script>
       function confclose1(form) {
            /*form.submit();*/
            $.ajax({
            type: 'post',
            url: '<?php echo base_url();?>main/appointment/close_multiple/',
            data: $('form').serialize(),
            success: function (response) {
                window.location.reload();
            }
          });  
}
 function opt_submit(form) {
            $.ajax({
            type: 'post',
            url: '<?php echo base_url();?>main/appointment_cancel/cancel_multiple/',
            data: $('form').serialize(),
            success: function (response) {
               /* alert(response);*/
                if(response == 1){
                window.location.reload();
                }else{
                jQuery('#reason_error').html(response);
                }
            }
          });  
}
   </script>
    <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Reason</h4>
        </div>
        <div class="modal-body">
         <form role="form" class="form-horizontal form-groups-bordered validate" action="" method="post" enctype="multipart/form-data">
                <div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">
         <div class="panel-body">
                <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo "Reason";?></label>
                        <div class="col-sm-8">
                            <input type="text" name="cancel_reason" class="form-control" id="cancel_reason"  data-validate="required" data-message-required="Value Required" value="<?php echo set_value('otp'); ?>" autocomplete="off">
                            <span id="reason_error"></span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 control-label col-sm-offset-2">
                        <input type="button" class="btn btn-success" value="Submit" onClick="opt_submit(this.form);">
                </div>
                </div>
                </div>
        </div>
    </div>
</div>
        </form>
        </div>
      </div>   
    </div>
  </div> 