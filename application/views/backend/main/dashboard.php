<?php 
$this->session->set_userdata('last_page', current_url());
?>
<style>
    .title{
        font-size: 20px;
    }
</style>

  
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
								<div class="text-muted"><?php if($account_type=='superadmin' || $account_type=='hospitaladmins'|| $account_type=='nurse'|| $account_type=='receptionist'|| $account_type=='users'){echo 'Doctors';}elseif($account_type=='doctors'){echo 'Nurses';}elseif($account_type=='medicalstores'){echo 'Completed Orders';}elseif( $account_type=='medicallabs'){echo 'Completed Reports';}?></div>
							</div>
						</div>
					</div>
			<!-- ************** 3 ******************* -->
	<?php if($account_type != 'doctors' && $account_type != 'nurse' && $account_type != 'receptionist'&& $account_type != 'medicalstores' && $account_type != 'medicallabs'){?>
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
							<div class="row no-padding"><em class="fa fa-xl <?php if($account_type == 'users'||$account_type == 'superadmin'|| $account_type == 'hospitaladmins'|| $account_type == 'medicalstores' || $account_type == 'medicallabs'){echo 'fa-medkit';}else{echo 'fa-users';}?> color-blue"></em>
								<div class="large">
<?php if($account_type == 'doctors'){echo count($this->crud_model->select_inpatient_info());}elseif($account_type == 'users'||$account_type == 'superadmin'|| $account_type == 'hospitaladmins'){echo count($this->crud_model->select_store_info());}elseif($account_type == 'medicalstores' || $account_type == 'medicallabs'){echo count($this->crud_model->select_order_info());}?></div>
								<div class="text-muted"><?php if($account_type == 'doctors' ){echo 'in-patients';}elseif($account_type == 'users'||$account_type == 'superadmin'|| $account_type == 'hospitaladmins'){echo 'Medical Stores';}elseif($account_type == 'medicalstores'){echo 'Total Orders';}elseif($account_type == 'medicallabs'){echo 'Total Reports';}?></div>
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
						<div class="panel panel-red panel-widget border-right">
							<div class="row no-padding"><em class="fa fa-xl fa-envelope color-red"></em>
								<div class="large">
<?php if($account_type != 'medicalstores' && $account_type != 'medicallabs'){echo $this->crud_model->dashboard_appointment_count();}?></div>
								<div class="text-muted"><?php if($account_type != 'medicalstores' && $account_type != 'medicallabs'){echo 'Appointments';}?></div>
							</div>
						</div>
					</div>
				<?php }?>

				</div><!--/.row-->
			</div>

<?php $account_type=$this->session->userdata('login_type');?>

<div class="row">
    <div class="col-lg-12">
        <ul class="nav nav-tabs bordered">
            <?php if($account_type == 'doctors'||$account_type == 'receptionist'||$account_type == 'users'){?>
            <li class="active">
                <a href="#h1" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo 'APPOINTMENTS';?>
                </a>
            </li>
        <?php }?>
        <?php if($account_type == 'users'){?>
            <li class="">
                <a href="#h5" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo 'Recommended';?>

                </a>
            </li>
            <li class="">
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
        <div class="panel panel-default">
        <!-- <div class="panel-heading"> -->
  
        <!-- </div> -->
    <!-- ****************SUPER ADMIN********************************** -->
<?php if($account_type=='superadmin'){?>

<?php 
$hospital_status=$this->db->select('hospital_id,name,till_date')->get('hospitals')->result_array();
?>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <!-- CALENDAR-->
            <div class="col-md-12 col-xs-12">
                <div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-calendar"></i>&nbsp;Calender for License Expiry dates
                        </div>
                    </div>
                    <div class="panel-body" style="padding:0px;">
                        <div class="calendar-env">
                            <div class="calendar-body">
                                <div class="notranslate" id="notice_calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  $(document).ready(function() {

      var calendar = $('#notice_calendar');

                $('#notice_calendar').fullCalendar({
                    header: {
                        left: 'title',
                        right: 'today prev,next'
                    },

                    //defaultView: 'basicWeek',

                    editable: false,
                    firstDay: 0,
                    height: 530,
                    droppable: false,

                    events: [
                        <?php
                        foreach($hospital_status as $row):    
                        ?>
                        {
                            url:"<?php echo base_url();?>main/get_hospital_history/<?=$row['hospital_id'];?>",
                            title: "<?php echo $row['name'];?>",
                            start: new Date(<?php echo date('Y',strtotime($row['till_date']));?>, <?php echo date('m',strtotime($row['till_date']))-1;?>, <?php echo date('d',strtotime($row['till_date']));?>),
                    
                        },
                        <?php
                        endforeach
                        ?>

                    ]

                });
    });
  </script>
<?php }?>
<!-- Datbale Data -->
        
        
        <div class="panel-body">
        <div class="tab-content">
    <?php if($account_type == 'doctors'||$account_type == 'receptionist' || $account_type == 'users'){?>
    <div class="tab-pane box active" id="h1" style="padding: 5px">
<form action="<?php echo base_url()?>main/appointment/delete_multiple/" method="post">
<span class="title"><?php echo "UPCOMING APPOINTMENTS";?></span>
<div class="panel-body">
<button type="button" data-toggle="modal" data-target="#myModal" onClick="confcancel1(this.form);" id="cancel" class="btn btn-warning pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('cancel'); ?>
</button>
<button type="button" onClick="checkone(this.form);" id="cancel1" class="btn btn-warning pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('cancel'); ?>
</button>
<button type="button" onclick="window.location.href = '<?php echo base_url();?>main/add_appointment'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_appointment'); ?>
</button>
<?php if($account_type=='doctors' || $account_type=='receptionist'){?>
<div class="col-sm-5">
                  <div class="form-group">
         <span for="field-ta" class="col-sm-3 control-label"><b> <?php echo get_phrase('date_range'); ?></b></span> 
         <div class="col-sm-7">
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
                '<?php echo 'Today';?>': [moment(), moment()],
                '<?php echo 'Tomorrow';?>': [moment().add(1, 'days'), moment().add(1, 'days')],
                '<?php echo 'Upcoming 7 day';?>': [moment(),moment().add(6, 'days')],
                '<?php echo 'Upcoming 30 day';?>': [moment(),moment().add(29, 'days'),],
                '<?php echo 'This Month';?>': [moment().startOf('month'), moment().endOf('month')],
                '<?php echo 'Next Month';?>': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf('month')]
            }
        },cb);

    });

</script>
<?php }?>
</div>
<table data-toggle="table" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">  
    <thead>
       <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value=""></th>
            <th><?php echo get_phrase('appointment_no');?></th> 
            <th><?php if($account_type=='doctors'){echo get_phrase('user');}elseif($account_type=='users' || $account_type=='receptionist'){echo "Doctor";}?></th>
            <?php if($account_type!='receptionist'){?>
            <th><?php if($account_type=='doctors'){echo get_phrase('city');}elseif($account_type=='users'){echo "Hospital-Branch-Department";}?></th> <?php }?>
            <th><?php echo get_phrase('appointment date & time');?></th>
            <th><?php echo get_phrase('status'); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php if($account_type=='doctors' || $account_type=='receptionist'){if($_GET['sd']!='' && $_GET['ed']!=''){$appointment_info=$this->crud_model->select_appointment_info_by_date($_GET['sd'],$_GET['ed'],2);}else{$appointment_info=$this->crud_model->select_today_appointment_info_by_doctor(2);}}elseif($account_type=='users'){$appointment_info=$this->crud_model->select_upcoming_appointments(2);}
        $i=1;foreach ($appointment_info as $row) {
           /* if(strtotime($row['appointment_date']) < strtotime(date('m/d/Y')))
            {
                $count=$this->db->get_where('appointments',array('appointment_id' => $row['appointment_id'],'status'=>2 ))->num_rows();
                if($count>0){
                $array=array('appointment_id'=>$row['appointment_id'],'status'=>2);
                $this->db->where($array)->update('appointments',array('status'=>'4'));
                $this->db->insert('appointment_history',array('appointment_id'=>$row['appointment_id'],'action'=>7,'created_type'=>'System','created_by'=>'MyPulse'));
                }
            }*/
            ?>   
            <tr>
                <td><input type="checkbox" name="check[]" class="check" id="check_<?php echo $i;?>" value="<?php echo $row['appointment_id'] ?>"></td>
                 <td><a href="<?php echo base_url(); ?>main/edit_appointment/<?php echo $row['appointment_id'] ?>" class="hiper"><?php echo $row['appointment_number'] ?></a>
                 </td>
                <td>
             <?php if($account_type=='doctors'){$name = $this->db->get_where('users' , array('user_id' => $row['user_id'] ))->row();}elseif($account_type=='users' || $account_type=='receptionist'){$name = $this->db->get_where('doctors' , array('doctor_id' => $row['doctor_id'] ))->row();}
                        echo $name->name;?>
                </td>
                <?php if($account_type!='receptionist'){?>
                 <td><?php 
                 $branch=$this->db->get_where('branch' , array('branch_id' => $this->db->where('doctor_id',$row['doctor_id'])->get('doctors')->row()->branch_id))->row();
                 if($account_type=='doctors'){echo $this->db->where('city_id',$name->city)->get('city')->row()->name;}elseif($account_type=='users'){
                    $hospital=$this->db->get_where('hospitals' , array('hospital_id' => $this->db->where('branch_id',$branch->branch_id)->get('branch')->row()->hospital_id))->row();
                    if($row['department_id'] == 0){$name='All Departments';}else{$name = $this->db->get_where('department' , array('department_id' => $row['department_id'] ))->row()->dept_name;}
                        echo $hospital->name.' - '.$branch->branch_name.' - '.$name;}?></td> <?php }?>
                <td><?php echo date("d M, Y",strtotime($row['appointment_date']));?><br/><?php echo date("h:i A", strtotime($row['appointment_time_start'])).' - '.date("h:i A", strtotime($row['appointment_time_end']));?></td>
                <td><?php if($row['appointment_status'] == 1){echo "<button type='button' class='btn-danger'>Pending</button>";   
                 }
                 elseif($row['appointment_status'] == 2){ echo "<button type='button' class='btn-success'>Confirmed</button>";}
                 elseif($row['appointment_status'] == 3){ echo "<button type='button' class='btn-info'>Cancelled</button>";}
                 elseif($row['appointment_status'] == 4){ echo "<button type='button' class='btn-warning'>Closed</button>";}
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
    <div class="tab-pane box" id="h5" style="padding: 5px">
<form action="<?php echo base_url()?>main/appointment/delete_multiple/" method="post">
<span class="title">RECOMMEND APPOINTMENTS</span>
<div class="panel-body">
<table data-toggle="table" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">  
    <thead>
       <tr>
           <th><?php echo get_phrase('sl_no'); ?></th>
            <th><?php echo get_phrase('Hospital-Branch-Department'); ?></th>
            <th><?php echo get_phrase('doctor'); ?></th>
            <th><?php echo get_phrase('Recommed Date'); ?></th>
            <th><?php echo get_phrase('options'); ?></th>
        </tr>
    </thead>

    <tbody>
         <?php $appointment_info=$this->crud_model->select_recommend_appointments();
        $i=1;foreach ($appointment_info as $row) {
            ?>   
            <tr>
                <td><?=$i;?></td>
                 <td><?php $branch=$this->db->get_where('branch' , array('branch_id' => $this->db->where('doctor_id',$row['doctor_id'])->get('doctors')->row()->branch_id))->row();
                    $hospital=$this->db->get_where('hospitals' , array('hospital_id' => $this->db->where('branch_id',$branch->branch_id)->get('branch')->row()->hospital_id))->row();
                    if($row['department_id'] == 0){$name='All Departments';}else{$name = $this->db->get_where('department' , array('department_id' => $row['department_id'] ))->row()->dept_name;}
                        echo $hospital->name.' - '.$branch->branch_name.' - '.$name;?></td>
                <td>
             <?php $name = $this->db->get_where('doctors' , array('doctor_id' => $row['doctor_id'] ))->row();
                        echo $name->name;?>
                </td> 
                <td><?=date("d M, Y",strtotime($row['next_appointment']));?></td>
                <td>
        <a href="<?php echo base_url(); ?>main/add_appointment/<?=$row['doctor_id'].'?date='.$row['next_appointment'];?>" title="Book Appointment"><i class="glyphicon glyphicon-plus"></i>
            </a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>
</form>
</div>
<div class="tab-pane box" id="h2" style="padding: 5px">
<form action="<?php echo base_url()?>main/appointment/delete_multiple/" method="post">
<span class="title">OUTSTANDING PRESCRIPTIONS FOR MEDICINES</span>
<div class="panel-body">
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
                <td><a href="<?php echo base_url(); ?>prescription_for_medicine/<?=$row1['prescription_id'];?>" class="hiper">
                    <?php echo $prescription_data[0];?></a></td>
                <td><?php echo $row1['created_at'] ?></td>
                <td>
        <a href="<?php echo base_url(); ?>main/prescription_order/<?php echo $row1['prescription_id'] ?>/0" title="Order Medicin"><em class="fa fa-sm fa-medkit color-blue"></em>
            </a>
                </td>
            </tr>
        <?php $i++;}} ?>
    </tbody>
</table>
</div>
</form>
</div>
 <div class="tab-pane box" id="h3" style="padding: 5px">
<form action="<?php echo base_url()?>main/appointment/delete_multiple/" method="post">
<span class="title">OUTSTANDING PRESCRIPTIONS FOR MEDICAL TESTS</span>
<div class="panel-body">
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
                <td><a href="<?php echo base_url(); ?>prescription_for_medical_test/<?=$row1['prescription_id'];?>" class="hiper">
                    <?php echo $prescription_data[0];?></a></td>
                <td><?php echo $row1['created_at'] ?></td>
                <td>
            <a href="<?php echo base_url(); ?>main/prescription_order/<?php echo $row1['prescription_id'] ?>/1" title="Order Medical Test"><em class="fa fa-sm fa-plus-square color-red"></em>
            </a>&nbsp;
                </td>
            </tr>
        <?php $i++;}}?>
    </tbody>
</table>
</div>
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
<div class="panel-body">
<table data-toggle="table" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">  
    <thead>
       <tr>
            <th><?php echo get_phrase('order_no.'); ?></th>
            <th><?php echo get_phrase('hospital / doctor'); ?></th>
            <th><?php echo get_phrase('patient'); ?></th>
            <th><?php echo get_phrase('contact_number'); ?></th>
            <th><?php echo get_phrase('address'); ?></th>
            <th><?php echo get_phrase('Date'); ?></th>
            <th><?php echo get_phrase('receipt'); ?></th>
            <th><?php echo get_phrase('status'); ?></th>
            <th><?php echo get_phrase('Action'); ?></th>
        </tr>
    </thead>

    <tbody>
         <?php  
        $prescription_info=$this->crud_model->select_outstanding_order_info();
        $i=1;foreach ($prescription_info as $row1) {
            $user_info=$this->crud_model->select_user_information($row1['user_id']);
           $prescription_info=$this->crud_model->select_prescription_information($row1['prescription_id']);
           foreach ($user_info as $user1) {
            
            ?>
            <tr>
                <td><a href="<?php echo base_url(); ?>main/ordered_prescription_history/<?php echo $row1['order_id'].'/'.$row1['order_type'] ?>" class="hiper"><?=$row1['unique_id'];?></a></td>
                <td><?php if($row1['type_of_order']=='0'){$doc=$this->db->where('doctor_id',$prescription_info['doctor_id'])->get('doctors')->row();echo $this->db->where('hospital_id',$doc->hospital_id)->get('hospitals')->row()->name.' / '.$doc->name;}elseif($row1['type_of_order']==1){echo "Ordered By User";}?></td>
                <td><?php echo $user1['name'] ?></td>
                <td><?php echo $user1['phone'] ?></td>
                <td><?php echo $user1['address'] ?></td>
                <td><?php echo date('M d-Y h:i A',strtotime($row1['created_at'])); ?></td>
                <td><?php if($row1['status']!=1 && $row1['status']!=2 && $row1['status']!=4 && $row1['status']!=8){echo '<a href="'.base_url().'main/receipt/'.$row1['order_id'].'" class="hiper"><i class="fa fa-file"></i>&nbsp;Receipt</a>';}else{echo "Receipt Not Uploaded";}?></td>
                <td>
                    <?php 
                        if($row1['status']==1){
                            echo "Pending";
                        }elseif($row1['status']==2){
                            echo "Order Received";
                        }elseif($row1['status']==3){
                            echo "Waiting for Samples";
                        }elseif($row1['status']==4){
                        if($row1['order_type']==0){echo "Being Processed";}elseif($row1['order_type']==1){echo "Tests in Progress";}
                        }elseif($row1['status']==5){
                            echo "Out for Delivery";
                        }elseif($row1['status']==6){
                            echo "Reports Submitted";
                        }elseif($row1['status']==7){
                            if($row1['order_type']==0){
                            $title_name="Delivered";
                            }elseif($row1['order_type']==1){
                            $title_name="Completed";
                            }
                            echo $title_name;
                        }elseif($row1['status']==8){
                            if($row1['order_type']==0){
                            $title_name="To Be Delivered";
                            }elseif($row1['order_type']==1){
                            $title_name="Being Processed";
                            }
                            echo $title_name;
                        }
                    ?>
                </td>
                <td>
                <?php if($row1['status']==1){
                            echo "Pending";
                        }elseif($row1['status']==2){
                            if($row1['order_type']==0){
                                $stat=4;
                            }elseif($row1['order_type']==1){
                                $stat=8;
                            }
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
                            if($row1['order_type']==0){
                                echo '<a href="'.base_url()."main/add_receipt/".$row1['order_id'].'" class="hiper">Upload Receipt</a>';
                            }elseif($row1['order_type']==1){
                            echo '<a href="'.base_url()."main/add_prescription_reports/".$row1['order_id'].'" class="hiper">Upload Reports</a>';
                            }
                            }
                        }elseif($row1['status']==5){
                            if($account_type!='medicallabs' && $account_type != 'medicalstores'){
                            echo "To Be Delivered";
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
                            /*if($row1['order_type']==0){
                            $title_name="Delivered";
                            }elseif($row1['order_type']==1){
                            $title_name="Completed";
                            }
                            echo $title_name;*/
                        }elseif($row1['status']==8){
                            if($account_type!='medicallabs' && $account_type != 'medicalstores'){
                            if($row1['order_type']==0){
                            $title_name="Out for Delivery";
                            }elseif($row1['order_type']==1){
                            $title_name="Being Processed";
                            }
                            echo $title_name;
                            }else{
                            if($row1['order_type']==0){
                            echo '<button type="button" class="btn-primary" onclick="window.location.href='."'".base_url('main/orders/order_status/').$row1['order_id'].'/5'."'".'">Out for Delivery</button>';
                            }elseif($row1['order_type']==1){
                            echo '<a href="'.base_url()."main/add_receipt/".$row1['order_id'].'" class="hiper">Upload Receipt</a>';
                            }
                            
                            }
                        }
                    ?>
                </td>
            </tr>
            
        <?php } $i++;} ?>
    </tbody>
</table>
</div>
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