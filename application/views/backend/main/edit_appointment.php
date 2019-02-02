<style type="text/css">
   
</style>
<?php 
$this->session->set_userdata('last_page1', current_url());
?>
<?php 
$single_appointment_info = $this->db->get_where('appointments', array('appointment_id' => $appointment_id))->result_array();
foreach ($single_appointment_info as $row) {
    $user_info=$this->db->where('user_id',$row['user_id'])->get('users')->row_array();
    if($account_type != 'doctors' && $account_type != 'nurse' || $row['status']!='2'){
?>

        <!------CONTROL TABS END------>
         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/edit_appointment/<?=$appointment_id;?>" method="post" enctype="multipart/form-data">
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">   
<div class="panel-body">
    <h4><?php echo '<b>User ID</b> : '.$user_info['unique_id'];?></h4>
<h4><?php echo '<b>User Name</b> : '.$user_info['name'];?></h4>
<h4><?php echo '<b>Status</b> : ';?><?php if($row['status'] == 1){echo "<button type='button' class='btn-danger'>Pending</button>";   
                 }
                 elseif($row['status'] == 2){ echo "<button type='button' class='btn-success'>Confirmed</button>";}
                 elseif($row['status'] == 3){ echo "<button type='button' class='btn-info'>Cancelled</button>";}
                 elseif($row['status'] == 4){ echo "<button type='button' class='btn-warning'>Closed</button>";}
                 ?></h4>
                        <div class="col-sm-6">
                        <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('doctor'); ?></label>
                        <div class="col-sm-8">
                            <input type="text" name="doctor" class="form-control"  autocomplete="off" id="doctor" list="doctors" placeholder="e.g. Hospital Name, Doctor Name or Specialisation" disabled="true" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php $doctor=$this->db->where('doctor_id',$row['doctor_id'])->get('doctors')->row_array(); echo $doctor['unique_id'].' / '.$doctor['name']; ?>" onchange="return get_doctor_ava(this.value)">
                            <input type="hidden" id="doctor_id"value="<?=$row['doctor_id'];?>">
    <datalist id="doctors">
        
        <?php 
        $users=$this->db->get('doctors')->result_array();
        foreach ($users as $row1) {
         ?>
<option value="<?php echo $row1['unique_id'];?>" <?php if($row1['doctor_id'] == $row['doctor_id']){echo 'selected';}?>><?php echo 'Dr. '.ucfirst($row1['name']).'('.$this->db->where('hospital_id',$row1['hospital_id'])->get('hospitals')->row()->name.' , '.$row1['specializations'].')';?></option>
<?php }?>
  </datalist>
                        </div>
                    </div>
                </div>
                        <div class="col-sm-6">
                              <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('user'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="user" class="form-control"  autocomplete="off" id="user" list="users" placeholder="e.g. Enter User Email, Mobile Number or User ID" disabled="true" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php $user=$this->db->where('user_id',$row['user_id'])->get('users')->row_array(); echo $user['name'].' '.$user['lname']; ?>">
    <datalist id="users">
    
        <?php 
        $users=$this->db->get('users')->result_array();
        foreach ($users as $row1) {
         ?>
    <option value="<?php echo $row1['name'].' '.$row1['lname'];?>" <?php if($row1['user_id'] == $row['user_id']){echo 'selected';}?>><?php echo $row1['unique_id'].'('.$row1['email'].')('.$row1['phone'].')';?><input type="hidden" name="user_id" value="<?php echo $row1['user_id'];?>"></option>
<?php }?>
  </datalist>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('doctor_availability'); ?></label>
                            <div class="col-sm-8" id="doc_ava">
                                <input type="text" name="doctor_availability" id="doctor_availability" placeholder="Please Select Doctor First" class="form-control" disabled="" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php $doctor=$this->db->where('doctor_id',$row['doctor_id'])->get('availability')->row_array(); echo $doctor['message']; ?>">  
                            </div>
                    </div>
                </div>
                <div class="col-sm-6">
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Appointment Date'); ?></label>
                        <div class="col-sm-8">
                            <input type="text" name="appointment_date" class="form-control"  autocomplete="off" placeholder="<?php echo get_phrase('Appointment Date'); ?>" id="appointment_date" value="<?php echo date('m/d/Y',strtotime($row['appointment_date'])); ?>" <?php if($row['status']!= 2){echo 'disabled';}?> onchange="return get_dco_date(this.value)" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" >
                        </div>
                    </div>
                </div>
                      <div class="col-sm-6">
                     <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('Available Time slot'); ?></label>
                            <div class="col-sm-8">
                                <select name="available_slot" class="form-control" id="available_slot" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo set_value('available_slot'); ?>"  onchange="return get_district(this.value)" disabled="true">

                                    <option value="<?php echo date('h:i A',strtotime($row['appointment_time_start'])) .' - '.date('h:i A',strtotime($row['appointment_time_end']));?>"><?php echo date('h:i A',strtotime($row['appointment_time_start'])) .' - '.date('h:i A',strtotime($row['appointment_time_end']));?></option>
                                </select>   
                            </div>
                    </div>
                   

              
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('Reason for Appointment'); ?></label>
                            <div class="col-sm-8">
                                <input type="text" name="reason" placeholder="Reason for Appointment" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo $row['reason']; ?>" disabled="true" >
                            </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('Remarks'); ?></label>
                            <div class="col-sm-8">
                                <textarea type="text" name="remark" placeholder="Remark to be updated by Hospital(Optional)" class="form-control" disabled="true" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" ><?php echo $row['remarks']; ?></textarea>
                            </div>
                    </div>
                </div>
                <div class="col-sm-6">
            <div class="col-sm-offset-3 col-sm-8">
<a href="<?php echo base_url();?>main/appointment_history/<?php echo $row['appointment_id'];?>" class="hiper">View Appointment History</a><br/>
<a href="<?=base_url('main/edit_user/').$user_info['user_id'];?>" class="hiper">View User Details</a>
            </div>
            </div>
            <div class="col-sm-3 control-label col-sm-offset-9">
                    <?php if($row['status']== 2){?>
                        <input type="submit" class="btn btn-success" value="<?php echo get_phrase('update'); ?>">&nbsp;&nbsp;
                    <?php }?>
                        <input type="button" class="btn btn-info pull-right" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
                    </div> 
            </div>
            </div>
        </div>
    </div> 
   </form>
<?php }else{ ?>
            <!----TABLE LISTING STARTS-->
<input type="button" class="btn btn-info pull-right" value="<?php echo get_phrase('close'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
<?php if($account_type=='doctors'){?>
<?php if($license_category=='MPHL_19002'){ ?>
<button type="button" onClick="confrecommend(this.form);" id="recommend" class="btn btn-warning pull-right" style="margin-left: 2px;width: auto;">
        <?php echo get_phrase('Recommend as Inpatient'); ?>
</button>
<?php }?>
<?php }?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">   
       <!-- <div class="panel-heading"></div> -->
<div class="panel-body">
    <div class="col-md-6">
<h4><?php echo '<b>User ID</b> : '.$user_info['unique_id'];?></h4>
<h4><?php echo '<b>User Name</b> : '.$user_info['name'];?></h4>
<h4><b>Appointment Date : </b><?php echo date('M ,d-Y',strtotime($row['appointment_date']));?></h4>
<h4><b>Appointment Slot : </b><?php echo date('h:i A',strtotime($row['appointment_time_start'])) .' - '.date('h:i A',strtotime($row['appointment_time_end'])) ;?></h4>
<h4><b>Reason : </b><?php echo $row['reason'];?></h4>
<h4><b>Status : </b><?php if($row['status'] == 1){echo "<button type='button' class='btn-danger'>Pending</button>";   
                 }
                 elseif($row['status'] == 2){ echo "<button type='button' class='btn-success'>Confirmed</button>";}
                 elseif($row['status'] == 3){ echo "<button type='button' class='btn-info'>Cancelled</button>";}
                 elseif($row['status'] == 4){ echo "<button type='button' class='btn-warning'>Closed</button>";};?></h4>   
    <h4><a href="<?php echo base_url();?>main/appointment_history/<?php echo $row['appointment_id'];?>" class="hiper">View Appointment History</a><br/>
    </h4> 
    <a href="<?=base_url('main/edit_user/').$user_info['user_id'];?>" class="hiper">View User Details</a>
        </div>
   
    <div class="col-md-6">
        <form action="<?php echo base_url()?>main/appointment/update_remark/<?php echo $row['appointment_id'];?>" method="post" class="form-horizontal form-groups-bordered validate" id="form1" enctype="multipart/form-data">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('Remarks'); ?></label>
                            <div class="col-sm-8" id="remark">
                                <textarea type="text" name="remark" placeholder="Remark to be updated by Hospital" class="form-control" <?php if($account_type!='doctors'){echo 'disabled';}?>><?php echo $row['remarks'];?></textarea>
                            </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('Next appointment Date'); ?></label>
                            <div class="col-sm-8" id="remark">
                                <input type="text" name="next_appointment" placeholder="Next Appointment Date" class="form-control" id="start_on" value="<?php if($row['next_appointment']!=''){echo date('m/d/Y',strtotime($row['next_appointment']));}?>" autocomplete="off"  <?php if($account_type!='doctors'){echo 'disabled';}?>>
                            </div>
                    </div>
                </div> 
                <?php if($account_type == 'doctors'){?>
                <div class="col-sm-11 control-label">
                        <input type="submit" class="btn btn-success" value="<?php echo get_phrase('update'); ?>">&nbsp;&nbsp;
                </div>
            <?php }?>
        </form>
    </div>
</div>
</div>
</div>
</div>
<?php $data['user_id']=$row['user_id'];$this->load->view('backend/main/user_history',$data);?>
<?php }} ?>
<script type="text/javascript">
     function get_email(email_value) {
     $.ajax({
            type : "POST",
            url: '<?php echo base_url();?>ajax/get_email/' ,
            data : {email : email_value},
            success: function(response)
            {
                jQuery('#email_error').html(response);        
            } 
        });
   
    }
     function get_phone(phone_value) {
     $.ajax({
            type : "POST",
            url: '<?php echo base_url();?>ajax/get_phone/' ,
            data : {phone : phone_value},
            success: function(response)
            {
                jQuery('#phone_error').html(response);        
            } 
        });
   
    }
 
   function get_doctor_ava(unique_id) {
     $.ajax({
            url: '<?php echo base_url();?>ajax/get_doctor_data/' + unique_id ,
            success: function(response)
            {
                jQuery('#doc_ava').html(response);
                if('<?php echo $row['status'];?>'==2){
                document.getElementById("appointment_date").disabled = false;}
                
            } 
        });
   
    }  
    <?php if($account_type == 'doctors'){?>
        $(document).ready(function(){
           var unique_id=$('#doctor').val();
           /*alert(unique_id);*/
           $.ajax({
            url: '<?php echo base_url();?>ajax/get_doctor_data/' + unique_id ,
            success: function(response)
            {
                if('<?php echo $row['status'];?>'==2){
                document.getElementById("appointment_date").disabled = false;}
                
            } 
        });
        });
    <?php }?>
        $(document).ready(function(){
        var date = new Date();
        date.setDate(date.getDate());
        $('#appointment_date').datepicker({ 
        startDate: date
        });
        });
   function get_dco_date(date_value) {
    var doctor_id=$('#doctor_id').val();
     $.ajax({
            type : "POST",
            url: '<?php echo base_url();?>ajax/get_dco_date/' + doctor_id,
            data : {date_val : date_value},
            success: function(response)
            {
               jQuery('#available_slot').html(response);
               document.getElementById("available_slot").disabled = false;
            } 
        });
   
    }  
          
</script>
<script type="text/javascript">

    function get_user_data(user_value) {
     $.ajax({
            type : "POST",
            url: '<?php echo base_url();?>ajax/get_user_data/' ,
            data : {user : user_value},
            success: function(response)
            {
                jQuery('#user_data').html(response);        
            } 
        });
    }
    function get_specializations_doctors(id) {
        $.ajax({
            url: '<?php echo base_url();?>ajax/get_specializations_doctors/' + id ,
            success: function(response)
            {
            jQuery('#doctors').html(response);
            }
        });
    }
    function get_city_doctors(id) {
    
        $.ajax({
            url: '<?php echo base_url();?>ajax/get_city_doctors/' + id ,
            success: function(response)
            {
            jQuery('#doctors').html(response);
            }
        });

    }
</script>


 <script>
            function confrecommend(form) {
            /*form.submit();*/
            var id='<?=$single_appointment_info[0]["user_id"]?>';
            $.ajax({
            type: 'post',
            url: '<?php echo base_url();?>main/appointment/recommend/'+id,
            success: function (response) {
                window.location.reload();
            }
          });  
}
 </script>
 <script type="text/javascript">
                    $(document).ready(function(){
                    var date = new Date();
                    date.setDate(date.getDate());

                    $('#start_on').datepicker({ 
                    startDate: date

                    });
                    } );                  

</script>