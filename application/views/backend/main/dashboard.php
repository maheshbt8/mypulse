<style>
    .tile-stats .icon{
        bottom: 50px;
    }
    .modal-backdrop.in{
        z-index: auto;
    }
</style>
<?php 
$this->session->set_userdata('last_page', current_url());
?>
<div class="row">
    
<?php if($account_type=='superadmin' || $account_type=='users'){?>
      <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>main/hospital">
            <div class="tile-stats tile-white-gray  tile-white-primary">
                <div class="icon"><i class="fa fa-hospital-o"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php echo count($this->crud_model->select_hospital_info()); ?>" data-duration="1500" data-delay="0">0</div>
                <h3 style="padding-left: 65px;"><?php echo 'Hospitals';?></h3>
            </div>
        </a>
    </div>
<?php }elseif($account_type=='hospitaladmins'){?>
    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>main/get_hospital_branch/<?php echo $this->session->userdata('hospital_id');?>">
            <div class="tile-stats tile-white-gray  tile-white-primary">
                <div class="icon"><i class="fa fa-hospital-o"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php echo $this->db->where('hospital_id',$this->session->userdata('hospital_id'))->get('branch')->num_rows(); ?>" data-duration="1500" data-delay="0">0</div>
                <h3 style="padding-left: 65px;"><?php echo 'Branches';?></h3>
            </div>
        </a>
    </div>
<?php }elseif($account_type=='nurse' || $account_type=='receptionist'){?>
    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>main/get_hospital_branch/<?php echo $this->session->userdata('hospital_id');?>">
            <div class="tile-stats tile-white-gray  tile-white-primary">
                <div class="icon"><i class="fa fa-hospital-o"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php if($account_type=='nurse'){$dt=$this->db->where('nurse_id',$this->session->userdata('login_user_id'))->get('nurse')->row(); if($dt->department_id==0){echo $this->db->where('branch_id',$dt->branch_id)->get('department')->num_rows();}else{echo explode(',',$dt->department_id);}}elseif($account_type=='receptionist'){$dt=$this->db->where('receptionist_id',$this->session->userdata('login_user_id'))->get('receptionist')->row(); if($dt->department_id==0){echo $this->db->where('branch_id',$dt->branch_id)->get('department')->num_rows();}else{echo explode(',',$dt->department_id);}}?>" data-duration="1500" data-delay="0">0</div>
                <h3 style="padding-left: 65px;"><?php echo 'Departments';?></h3>
            </div>
        </a>
    </div>
<?php }?>
<?php if($account_type=='doctors'){?>
      <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>main/receptionist">
            <div class="tile-stats tile-white-gray  tile-white-primary">
                <div class="icon"><i class="fa fa-user"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php echo count($this->crud_model->select_receptionist_info()); ?>" data-duration="1500" data-delay="0">0</div>
                <h3 style="padding-left: 65px;"><?php echo 'receptionists';?></h3>
            </div>
        </a>
    </div>
<?php }?>
<?php if($account_type=='superadmin' || $account_type=='hospitaladmins'|| $account_type=='nurse'|| $account_type=='receptionist'){?>
    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>main/doctor">
            <div class="tile-stats tile-white tile-white-primary">
                <div class="icon"><i class="fa fa-user-md"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php echo count($this->crud_model->select_doctor_info()); ?>"
                     data-duration="1500" data-delay="0">0 </div>
                <h3 style="padding-left: 65px;"><?php echo 'Doctors';?> </h3>
            </div>
        </a>
    </div>
   <?php }?>
   <?php if($account_type=='doctors'){?>
    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>main/nurse">
            <div class="tile-stats tile-white tile-white-primary">
                <div class="icon"><i class="fa fa-user"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php echo count($this->crud_model->select_nurse_info()); ?>"
                     data-duration="1500" data-delay="0">0 </div>
                <h3 style="padding-left: 65px;"><?php echo 'Nurses';?> </h3>
            </div>
        </a>
    </div>
   <?php }?>
   <?php if($account_type=='superadmin'){?>
      <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>main/users">
            <div class="tile-stats tile-white-red">
                <div class="icon"><i class="fa fa-users"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php echo $this->db->count_all('users'); ?>" 
                     data-duration="1500" data-delay="0">0 </div>
                <h3 style="padding-left: 65px;"><?php echo 'Users';?></h3>
            </div>
        </a>
        </div>
    <?php }?>
    <?php if($account_type != 'superadmin' && $account_type != 'users' && $account_type != 'nurse' && $account_type != 'receptionist'){?>
    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>main/patient">
            <div class="tile-stats tile-white-red">
                <div class="icon"><i class="fa fa-users"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php echo count($this->crud_model->select_patient_info()); ?>" 
                     data-duration="1500" data-delay="0">0 </div>
                <h3 style="padding-left: 65px;"><?php echo 'Patients';?></h3>
            </div>
        </a>
    </div>
<?php }?>
   <?php if($account_type == 'users'){?>
    <div class="col-sm-3">
        <a href="#">
            <div class="tile-stats tile-white-red">
                <div class="icon"><i class="fa fa-users"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php echo $this->db->where('hospital_id',$this->session->userdata('hospital_id'))->get('inpatient')->num_rows(); ?>" 
                     data-duration="1500" data-delay="0">0 </div>
                <h3 style="padding-left: 65px;"><?php echo 'Medical Labs';?></h3>
            </div>
        </a>
    </div>
<?php }?>
<?php if($account_type != 'medicalstores' && $account_type != 'medicallabs' && $account_type != 'nurse' && $account_type != 'receptionist'){?>
        <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>main/appointment">
            <div class="tile-stats tile-white-aqua">
               <div class="icon"><i class="fa fa-envelope"></i></div>
                <div class="num pull-right" data-start="0" data-end="
                <?php if($account_type=='superadmin'){ echo $this->db->count_all('appointments'); }elseif($account_type=='hospitaladmins'){echo $this->db->where('hospital_id',$this->session->userdata('hospital_id'))->get('appointments')->num_rows();}elseif($account_type=='doctors'){echo $this->db->where('doctor_id',$this->session->userdata('login_user_id'))->get('appointments')->num_rows();}elseif($account_type=='users'){echo $this->db->where('user_id',$this->session->userdata('login_user_id'))->get('appointments')->num_rows();}?>" 
                     data-duration="1500" data-delay="0">0 </div>
                <h3 style="padding-left: 65px;"><?php echo $this->lang->line('appointments');?> </h3>
            </div>
        </a>
        </div>
 <?php }?>
 <?php if($account_type=='medicalstores' || $account_type=='medicallabs'){?>
      <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>main/hospital">
            <div class="tile-stats tile-white-gray  tile-white-primary">
                <div class="icon"><i class="glyphicon glyphicon-list-alt"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php echo count($this->crud_model->select_outstanding_order_info()); ?>" data-duration="1500" data-delay="0">0</div>
                <h3 style="padding-left: 65px;"><?php if($account_type=='medicalstores'){echo 'Outstanding Orders';}elseif( $account_type=='medicallabs'){echo 'Outstanding Reports';}?></h3>
            </div>
        </a>
    </div>
    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>main/doctor">
            <div class="tile-stats tile-white tile-white-primary">
                <div class="icon"><i class="fa fa-check-square"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php echo count($this->crud_model->select_completed_order_info()); ?>"
                     data-duration="1500" data-delay="0">0 </div>
                <h3 style="padding-left: 65px;"><?php if($account_type=='medicalstores'){echo 'Complete Orders';}elseif( $account_type=='medicallabs'){echo 'Complete Reports';}?> </h3>
            </div>
        </a>
    </div>
<?php }?>
</div>
<br/>
<hr/>
<?php if($account_type == 'doctors'){?>
<h4 class="col-sm-12"><?php echo get_phrase("TODAY'S APPOINTMENTS"); ?></h4>
<style>
    .modal-backdrop.in{
        z-index: auto;
    }
</style>
<?php 
$this->session->set_userdata('last_page', current_url());
?>
<form action="<?php echo base_url()?>main/appointment/delete_multiple/" method="post">
<?php if($account_type=='superadmin'){?>
<button type="button" onClick="confclose1(this.form);" id="close" class="btn btn-warning pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('close'); ?>
</button>
<button type="button" onClick="checkone(this.form);" id="close1" class="btn btn-warning pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('close'); ?>
</button>
<?php }?>

<button type="button" data-toggle="modal" data-target="#myModal" onClick="confcancel1(this.form);" id="cancel" class="btn btn-warning pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('cancel'); ?>
</button>
<button type="button" onClick="checkone(this.form);" id="cancel1" class="btn btn-warning pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('cancel'); ?>
</button>

<?php if($account_type=='superadmin'){?>
<button type="button" onClick="confSubmit(this.form);" id="delete" class="btn btn-danger pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onClick="checkone(this.form);" id="delete1" class="btn btn-danger pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<?php }?>
<button type="button" onclick="window.location.href = '<?php echo base_url();?>main/add_appointment'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_appointment'); ?>
</button>
<!-- FILTERS -->
<div class="col-sm-8">
                  <div class="form-group">
         <label for="field-ta" class="col-sm-2 control-label"><b> <?php echo get_phrase('date_range'); ?></b></label> 
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
<!--Filters End-->
<div style="clear:both;"></div>
<br>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value=""></th>
            <th><?php echo get_phrase('appointment_no');?></th> 
            <th><?php echo get_phrase('user');?></th>
            <th><?php echo get_phrase('doctor');?></th>
            <th><?php echo get_phrase('Hospital-Branch-Department');?></th>  
            <th><?php echo get_phrase('city');?></th> 
            <th><?php echo get_phrase('date & time');?></th>
            <th><?php echo get_phrase('status'); ?></th>
            <?php if($account_type=='superadmin'){?>
            <th><?php echo get_phrase('options');?></th><?php }?>
        </tr> 
    </thead>

    <tbody>
        <?php $appointment_info=$this->crud_model->select_today_appointment_info_by_doctor();$i=1;foreach ($appointment_info as $row) { 
           /* print_r($row);die;*/
            if(strtotime($row['appointment_date']) < strtotime(date('m/d/Y')))
            {
                $count=$this->db->get_where('appointments',array('appointment_id' => $row['appointment_id'],'status'=>2 ))->num_rows();
                if($count>0){
                $array=array('appointment_id'=>$row['appointment_id'],'status'=>2);
                $this->db->where($array)->update('appointments',array('status'=>'4'));
                $this->db->insert('appointment_history',array('appointment_id'=>$row['appointment_id'],'action'=>7,'created_type'=>'System','created_by'=>'MyPulse'));
            /*$notification['created_by']=$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id');
            $notification['user_id']='users-user-'.$data['user_id'];
            $notification['title']='Appointment Booking';
            $notification['text']='Hi User Your Appointment is Booked Please Wait For The Confirmation.';
                $this->db->insert('notification',);*/
                }
            }
            ?>   
            <tr>
                <td><input type="checkbox" name="check[]" class="check" value="<?php echo $row['appointment_id'] ?>"></td>
                 <td><a href="<?php echo base_url(); ?>main/edit_appointment/<?php echo $row['appointment_id'] ?>" class="hiper"><?php echo $row['appointment_number'] ?></a></td>
                <td>
                   <!-- <a href="<?php echo base_url();?>main/edit_user/<?php echo $row['user_id']?>" class="hiper"> <?php $name = $this->db->get_where('users' , array('user_id' => $row['user_id'] ))->row()->unique_id;
                        echo $name;?></a> -->
             <?php $name = $this->db->get_where('users' , array('user_id' => $row['user_id'] ))->row()->name;
                        echo $name;?>
                </td>
                 <td>
                    <!-- <a href="<?php echo base_url(); ?>main/edit_doctor/<?php echo $row['doctor_id'] ?>" class="hiper"><?php $name = $this->db->get_where('doctors' , array('doctor_id' => $row['doctor_id'] ))->row()->unique_id;
                        echo $name;?></a> -->
                <?php $name = $this->db->get_where('doctors' , array('doctor_id' => $row['doctor_id'] ))->row()->name;
                        echo $name;?>
                </td>
                <td>
                    <?php 
                    $branch=$this->db->get_where('branch' , array('branch_id' => $this->db->where('doctor_id',$row['doctor_id'])->get('doctors')->row()->branch_id))->row();
                    $hospital=$this->db->get_where('hospitals' , array('hospital_id' => $this->db->where('branch_id',$branch->branch_id)->get('branch')->row()->hospital_id))->row();
                    if($row['department_id'] == 0){$name='All Departments';}else{$name = $this->db->get_where('department' , array('department_id' => $row['department_id'] ))->row()->name;}
                        echo $hospital->name.' - '.$branch->name.' - '.$name;?>
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
                 <?php if($account_type=='superadmin'){?>
                <td>
                    <a href="#" onclick="confirm_modal('<?php echo base_url();?>main/appointment/delete/<?php echo $row['appointment_id']?>');" id="dellink_2" class="delbtn" data-toggle="modal" data-target=".bs-example-modal-sm" data-id="2" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
                    <!-- <a href="#" onclick="confirm_modal('<?php echo base_url();?>main/appointment/close/<?php echo $row['appointment_id']?>');" id="dellink_2" class="delbtn" data-toggle="modal" data-target=".bs-example-modal-sm" data-id="2" title="Close"><i class="glyphicon glyphicon-ban-circle"></i></a> -->
                </td><?php }?>
            </tr>
        <?php } ?>
    </tbody>
</table>
</form>
<script type="text/javascript">   
    jQuery(window).load(function ()
    {
        var $ = jQuery;

        $("#table-2").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-md-3 col-xs-12 col-left'l><'col-md-9 col-xs-12  col-right'<'export-data'T>f>r>t<'row'<' col-md-3 col-xs-12 col-left'i><'col-md-9 col-xs-12 col-right'p>>"
        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });

        // Highlighted rows
        $("#table-2 tbody input[type=checkbox]").each(function (i, el)
        {
            var $this = $(el),
                    $p = $this.closest('tr');

            $(el).on('change', function ()
            {
                var is_checked = $this.is(':checked');

                $p[is_checked ? 'addClass' : 'removeClass']('highlight');
            });
        });

        // Replace Checboxes
        $(".pagination a").click(function (ev)
        {
            replaceCheckboxes();
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#delete1").show();
        $("#delete").hide();
        $("#close1").show();
        $("#close").hide();
        $("#cancel1").show();
        $("#cancel").hide();
        $("#all_check").click(function () {
            $('.check').attr('checked', this.checked);
            if($(".check:checked").length == 0){
                $("#delete1").show();
                $("#delete").hide();
                $("#close1").show();
                $("#close").hide();
                $("#cancel1").show();
                $("#cancel").hide();
            }else{
            $("#delete1").hide();
            $("#delete").show();
            $("#close1").hide();
            $("#close").show();
            $("#cancel1").hide();
            $("#cancel").show();
            }
            
        });
         $(".check").click(function(){
            if(($(".check:checked").length)!=0){
            $("#delete1").hide();
            $("#delete").show();
            $("#close1").hide();
            $("#close").show();
            $("#cancel1").hide();
            $("#cancel").show();
        if($(".check").length == $(".check:checked").length) {
            $("#all_check").attr("checked", "checked");
        } else {
            $("#all_check").removeAttr("checked");
        }
    }else{
        $("#delete1").show();
        $("#delete").hide();
        $("#close1").show();
        $("#close").hide();
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
<!-- <div class="row">
    <div class="col-md-12">
        <h4 class="col-sm-12"><?php echo get_phrase("TODAY'S APPOINTMENTS"); ?></h4>
            <div style="clear:both;"></div>
<table class="table table-bordered table-striped datatable" id="table-2">  
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
        <?php $i++;} ?>
    </tbody>
</table>
    </div> -->
    <?php }?>
<?php if($account_type == 'users'){?>
<div class="row">
    <div class="col-md-12">
        <h4 class="col-sm-12"><?php echo get_phrase('OUTSTANDING PRESCRIPTIONS FOR MEDICINES'); ?></h4>
            <div style="clear:both;"></div>
<table class="table table-bordered table-striped datatable" id="table-2">  
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
        <?php $i++;} ?>
    </tbody>
</table>
    </div>
    <br/>
    <hr/>
    <br/>
    <div class="col-md-12">
        <h4 class="col-sm-12"><?php echo get_phrase('OUTSTANDING PRESCRIPTIONS FOR MEDICAL TESTS'); ?></h4>
            <div style="clear:both;"></div>
<table class="table table-bordered table-striped datatable" id="table-2">  
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
        <?php $i++;} ?>
    </tbody>
</table>
    </div>
</div>
<?php }?>
<?php if($account_type == 'medicalstores' || $account_type == 'medicallabs'){?>
<div class="row">
    <div class="col-md-12">
        <h4 class="col-sm-12"><?php 
if($account_type == 'medicalstores'){
        echo get_phrase('OUTSTANDING ORDERS FOR MEDICINES');
    }
if($account_type == 'medicallabs'){
    echo get_phrase('OUTSTANDING ORDERS FOR LAB TESTS');
}
         ?></h4>
            <div style="clear:both;"></div>
<table class="table table-bordered table-striped datatable" id="table-2">  
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
                <td><?php echo $i?></td>
                <td><?php $doc=$this->db->where('doctor_id',$prescription_info['doctor_id'])->get('doctors')->row();echo $this->db->where('hospital_id',$doc->hospital_id)->get('hospitals')->row()->name.' / '.$doc->name?></td>
                <td><?php echo $user1['name'] ?></td>
                <td><?php echo $user1['phone'] ?></td>
                <td><?php echo $user1['address'] ?></td>
                <td><?php if($row1['status']==1){echo "Completed";}elseif($row1['status']==2){echo "Pending";} ?></td>
                <td><a href="<?php echo base_url(); ?>main/ordered_prescription_history/<?php echo $row1['order_id'].'/'.$row1['order_type'] ?>" class="hiper"><i class="fa fa-file"></i></a></td>
                <td>
  <a href="<?php echo base_url(); ?>main/add_receipt/<?= $row1['prescription_id'].'/'.$row1['order_id'];?>" class="hiper">Upload Receipt</a>
                </td>
            </tr>
            
        <?php } $i++;} ?>
    </tbody>
</table>
    </div>
</div>
<?php }?>