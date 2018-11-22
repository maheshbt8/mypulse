<?php 
$this->session->set_userdata('last_page', current_url());
?>
			<div class="panel panel-container">
				<div class="row">
			<!-- ************** 1 ******************* -->
					<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
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
					<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
						<div class="panel panel-blue panel-widget border-right">
							<div class="row no-padding"><em class="fa fa-xl <?php if($account_type=='doctors'){echo 'fa-user';}elseif($account_type=='medicalstores' || $account_type=='medicallabs'){echo 'fa-check-square';}else{echo 'fa-user-md';}?> color-orange"></em>
								<div class="large"><?php if($account_type=='superadmin' || $account_type=='hospitaladmins'|| $account_type=='nurse'|| $account_type=='receptionist'){ echo count($this->crud_model->select_doctor_info());}elseif($account_type=='doctors'){echo count($this->crud_model->select_nurse_info());}elseif($account_type=='medicalstores' || $account_type=='medicallabs'){echo count($this->crud_model->select_completed_order_info());}?></div>
								<div class="text-muted"><?php if($account_type=='superadmin' || $account_type=='hospitaladmins'|| $account_type=='nurse'|| $account_type=='receptionist'){echo 'Doctors';}elseif($account_type=='doctors'){echo 'Nurses';}elseif($account_type=='medicalstores'){echo 'Complete Orders';}elseif( $account_type=='medicallabs'){echo 'Complete Reports';}?></div>
							</div>
						</div>
					</div>
			<!-- ************** 3 ******************* -->
					<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
						<div class="panel panel-orange panel-widget border-right">
							<div class="row no-padding"><em class="fa fa-xl fa-users color-teal"></em>
								<div class="large">
<?php if($account_type=='superadmin'){echo $this->db->count_all('users');}elseif($account_type == 'medicalstores' || $account_type == 'doctors' || $account_type == 'medicallabs' || $account_type == 'hospitaladmins'){echo count($this->crud_model->select_patient_info());}elseif($account_type=='nurse'||$account_type=='receptionist'){echo count($this->crud_model->select_inpatient_info());}?></div>
								<div class="text-muted"><?php if($account_type=='superadmin'){echo 'Users';}elseif($account_type == 'medicalstores' || $account_type == 'doctors' || $account_type == 'medicallabs' || $account_type == 'hospitaladmins'){echo 'patients';}elseif($account_type=='nurse'||$account_type=='receptionist'){echo 'in-patients';}?></div>
							</div>
						</div>
					</div>
		<!-- ************** 4 ******************* -->
					<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
						<div class="panel panel-red panel-widget ">
							<div class="row no-padding"><em class="fa fa-xl fa-envelope color-red"></em>
								<div class="large">
<?php if($account_type != 'medicalstores' && $account_type != 'medicallabs'){echo count($this->crud_model->select_appointment_info());}?></div>
								<div class="text-muted"><?php if($account_type != 'medicalstores' && $account_type != 'medicallabs'){echo 'Appointments';}?></div>
							</div>
						</div>
					</div>
				</div><!--/.row-->
			</div>

<!-- Datbale Data -->
<?php $account_type=$this->session->userdata('login_type');$user_data=$this->db->where('user_id',1)->get('users')->row_array();?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
        <div class="panel-heading">
        	<!-- FILTERS -->
<div class="col-sm-8">
                  <div class="form-group">
         <span for="field-ta" class="col-sm-2 control-label"><b> <?php echo get_phrase('date_range'); ?></b></span> 
         <div class="col-sm-5">
        <input  class="form-control" onclick="return get_report_data(this.value)" name="report" id="reportrange" value="<?php if((isset($_GET['sd']) && $_GET['sd'] != "") AND (isset($_GET['ed']) && $_GET['ed'] != "")){echo date('M d,Y',strtotime($_GET['sd'])).' - '.date('M d,Y',strtotime($_GET['ed']));}else{echo date('M d,Y', strtotime('-0 days')).' - '.date('M d,Y');}?>"/>
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
        </div>
        <div class="panel-body">
        <!------CONTROL TABS START------>   
        <ul class="nav nav-tabs bordered">
        	<?php if($account_type == 'doctors'){?>
            <li class="active">
                <a href="#h1" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo 'Prescriptions';?>

                </a>
            </li>
        <?php }?>
        </ul>
        <div class="tab-content">
    <div class="tab-pane box active" id="h1" style="padding: 5px">
    	<h3>TODAY'S APPOINTMENTS</h3>
<form action="<?php echo base_url()?>main/appointment/delete_multiple/" method="post">
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
            <!-- <th><?php echo get_phrase('doctor');?></th> -->
            <!-- <th><?php echo get_phrase('Hospital-Branch-Department');?></th> -->  
            <th><?php echo get_phrase('city');?></th> 
            <th><?php echo get_phrase('date & time');?></th>
            <th><?php echo get_phrase('status'); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php if($_GET['sd']!=''&&$_GET['ed']!=''){$appointment_info=$this->crud_model->select_appointment_info_by_date($_GET['sd'],$_GET['ed']);}else{$appointment_info=$this->crud_model->select_today_appointment_info_by_doctor();}
        $i=1;foreach ($appointment_info as $row) { 
           /* print_r($row);die;*/
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
                 <!-- <td>
                <?php $name = $this->db->get_where('doctors' , array('doctor_id' => $row['doctor_id'] ))->row()->name;
                        echo $name;?>
                </td> -->
                <!-- <td>
                    <?php 
                    $branch=$this->db->get_where('branch' , array('branch_id' => $this->db->where('doctor_id',$row['doctor_id'])->get('doctors')->row()->branch_id))->row();
                    $hospital=$this->db->get_where('hospitals' , array('hospital_id' => $this->db->where('branch_id',$branch->branch_id)->get('branch')->row()->hospital_id))->row();
                    if($row['department_id'] == 0){$name='All Departments';}else{$name = $this->db->get_where('department' , array('department_id' => $row['department_id'] ))->row()->name;}
                        echo $hospital->name.' - '.$branch->name.' - '.$name;?>
                </td> -->
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