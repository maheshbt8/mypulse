<style>
    .modal-backdrop.in{
        z-index: auto;
    }
    datalist { 
  display: none;
}
</style>
<div class="row">
    <div class="col-md-12">
                <div class="panel panel-default">   
            <div class="panel-heading">
    <div class="col-sm-5">
                  <div class="form-group">     
                        <span for="field-ta" class="col-sm-3 control-label"> <?php echo get_phrase('specialization'); ?></span> 
                        <div class="col-sm-8">
                            <select name="hospital" class="form-control" onchange="return get_specializations_doctors(this.value)">
                                <option value="0"><?php echo get_phrase('ALL'); ?></option>
                                <?php 
                                $admins = $this->db->get_where('specializations')->result_array();
                                foreach($admins as $row){?>
                                <option value="<?php echo $row['specializations_id'] ?>"><?php echo $row['name'] ?></option>
                                
                                <?php } ?>
                            </select>
                        </div>
                    </div>
    </div>
    <div class="col-sm-4">
                  <div class="form-group">     
                        <span for="field-ta" class="col-sm-3 control-label"> <?php echo get_phrase('location'); ?></span> 

                        <div class="col-sm-8">
                            <select name="hospital" class="form-control" value="<?php echo set_value('location'); ?>" onchange="return get_city_doctors(this.value)">
                                <option value="0"><?php echo get_phrase('ALL'); ?></option>
                                <?php 
                                $admins = $this->db->get('city')->result_array();
                                foreach($admins as $row){?>
                                <option value="<?php echo $row['city_id'] ?>"><?php echo $row['name'] ?></option>
                                
                                <?php } ?>
                               
                            </select>
                           
                        </div>
                    </div>
    </div>
    <?php if($account_type != 'users'){?>
       <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">UNREGISTERED USER</button><?php }?>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">UNREGISTERED USER</h4>
        </div>
        <div class="modal-body">
         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/unuser/" method="post" enctype="multipart/form-data">
                <div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">
         <div class="panel-body">
                <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label">First Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="fname" class="form-control" id="fname" data-validate="required" data-message-required="Value Required" value="">
                           
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">Last Name</label>

                        <div class="col-sm-8">
                            <input type="text" name="lname" class="form-control" id="lname"  data-validate="required" data-message-required="Value Required" value="">
                          
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">Email</label>

                        <div class="col-sm-8">
                            <input type="email" name="email" class="form-control" id="email"  data-validate="required" data-message-required="Value Required" value=""  onchange="return get_email(this.value)">
                            <span id="email_error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Mobile Number');?></label>

                        <div class="col-sm-8">
                            <input type="number" name="mobile" class="form-control" id="mobile"  data-validate="required" data-message-required="Value Required" value="" minlength="10" maxlength="10" onchange="return get_phone(this.value)">
                             <span id="phone_error"></span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-10 control-label col-sm-offset-2">
                        <input type="submit" class="btn btn-success" value="Submit">
                        <input type="button" class="btn btn-info" value="Cancel" data-dismiss="modal">
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
</div>
<div class="panel-body">
        <!------CONTROL TABS END------>
         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/add_appointment/" method="post" enctype="multipart/form-data">
                    <div class="row">
                <?php if($account_type == 'superadmin' || $account_type == 'hospitaladmins' || $account_type == 'users' || $account_type=='nurse' || $account_type=='receptionist'){?>
                <div class="col-sm-6">
                
                                 <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('doctor'); ?></label>

<div class="col-sm-8">
<?php if($doctor_id==''){ ?>
<input type="text" name="doctor" class="form-control"  autocomplete="off" id="doctor" list="doctors" placeholder="e.g. Hospital Name, Doctor Name or Specialisation " data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo set_value('doctor'); ?>" onchange="return get_doctor_ava(this.value)"><?php }elseif ($doctor_id!='') { ?>
<input type="text" name="doctor" class="form-control"  autocomplete="off" id="doctor" list="doctors" placeholder="e.g. Hospital Name, Doctor Name or Specialisation " data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php $d=$this->db->get_where('doctors',array('doctor_id'=>$doctor_id))->row_array();echo $d['unique_id'].'/ Dr. '.$d['name'];?>" onchange="return get_doctor_ava(this.value)">
<?php }?>
    <datalist id="doctors">
        <?php
        if($account_type!='users'){
        $doctors_details=$this->crud_model->select_doctor_info();
        }elseif($account_type=='users'){
        $doctors_details=$this->db->get_where('doctors',array('status'=>'1','isDeleted'=>'1'))->result_array();
        }
        
        foreach ($doctors_details as $row) {
$license_status=$this->db->get_where('hospitals',array('hospital_id'=>$row['hospital_id']))->row()->license_status;
  if($license_status==1){ 
            $spee=explode(',',$row['specializations']);
            $spe='';
            for($i=0;$i<count($spee);$i++) {
             $spe=$this->db->where('specializations_id',$spee[$i])->get('specializations')->row()->name.','.$spe;   
            }
         ?>
<option value="<?php echo $row['unique_id'].'/ Dr. '.ucfirst($row['name']);?>"><?php echo '('.$this->db->where('hospital_id',$row['hospital_id'])->get('hospitals')->row()->name.' / '.$spe.')';?></option>
<?php }}?>

  </datalist>
                        </div>
                    </div>
                </div>
                <?php }elseif($account_type == 'doctors'){ ?>
                    <input type="hidden" name="doctor_id" value="<?= $this->session->userdata('login_user_id');?>">
                    <input type="hidden" name="doctor" id="doctor" value="<?= $this->session->userdata('unique_id');?>">
                <?php } ?>
                
                  <div class="col-sm-6">
                    <?php if($account_type != 'users'){?>
                              <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('user'); ?></label>

                        <div class="col-sm-8" id="user_data">
                            <input type="text" name="user" class="form-control"  autocomplete="off" id="user" list="users" placeholder="e.g. Enter User Email, Mobile Number or User ID" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo set_value('user'); ?>" onchange="return get_user_data(this.value)">
                            
                        </div>
                    </div>
                
            <?php }else{ ?>
                    <input type="hidden" name="user_id" id="user_id" value="<?= $this->session->userdata('login_user_id');?>">
                    <!-- <input type="hidden" name="user" id="doctor" value="<?= $this->session->userdata('unique_id');?>"> -->
                <?php } ?>
                </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <span id="doc_ava"></span>
                    </div>
                </div>
                <div class="row">
                <div class="col-sm-6">
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Appointment Date'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="appointment_date" class="form-control"  autocomplete="off" placeholder="<?php echo get_phrase('Appointment Date'); ?>" id="appointment_date" value="<?php echo set_value('Appointment Date'); ?>" disabled="true" onchange="return get_dco_date(this.value)" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" >
                            <span style="color:red;" id="appointment_date_error"></span>
                            <span style="color:red;"><?php if($this->session->flashdata('appointment_date_error') != ''){echo $this->session->flashdata('appointment_date_error');}?></span>
                        </div>
                    </div>
                   
                </div>
                      <div class="col-sm-6">
                     <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('Available Time slot'); ?></label>
                            <div class="col-sm-8">
                                <select name="available_slot" class="form-control" id="available_slot" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo set_value('available_slot'); ?>"  onchange="return get_district(this.value)" disabled="true">
                                    <option value=""><?php echo get_phrase('Select_date_first'); ?></option>

                                </select>   
                            </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('Reason for Appointment'); ?></label>
                            <div class="col-sm-8" id="reason">
                                <input type="text" name="reason" placeholder="Reason for Appointment" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php set_value('reason');?>" >
                            </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('Remark'); ?></label>
                            <div class="col-sm-8" id="remark">
                                <input type="text" name="remark" placeholder="Remark to be updated by Hospital(Optional)" class="form-control" disabled="true" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php set_value('remark');?>">
                            </div>
                    </div>
                </div>
                </div>
            <div class="col-sm-3 control-label col-sm-offset-9 ">
                        <input type="submit" class="btn btn-success" value="<?php echo get_phrase('submit'); ?>">&nbsp;&nbsp;
                        <input type="button" class="btn btn-info" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
                    </div>         
   </form>
   </div>
</div>
    </div>
</div>

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

        $(document).ready(function(){
        var unique_id=$('#doctor').val();
        $.ajax({
            url: '<?php echo base_url();?>ajax/get_doctor_data/' + unique_id ,
            success: function(response)
            {
                jQuery('#doc_ava').html(response);
                document.getElementById("appointment_date").disabled = false;
                
            } 
        });
        });
   function get_doctor_ava(unique_id) {
    
     $.ajax({
            url: '<?php echo base_url();?>ajax/get_doctor_data/' + unique_id ,
            success: function(response)
            {
                jQuery('#doc_ava').html(response);
                document.getElementById("appointment_date").disabled = false;
                
            } 
        });
   }
    
    <?php if($account_type == 'doctors'){?>
        $(document).ready(function(){
           var unique_id=$('#doctor').val();
          /* alert(unique_id);*/
           $.ajax({
            url: '<?php echo base_url();?>ajax/get_doctor_data/' + unique_id ,
            success: function(response)
            {
                /*alert(response);*/
                jQuery('#doc_ava').html(response);
                document.getElementById("appointment_date").disabled = false;
                
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
    var user_id=$('#user_id').val();
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
     $.ajax({
            type : "POST",
            url: '<?php echo base_url();?>ajax/count_no_appointments/' + user_id,
            data : {date_val : date_value},
            success: function(response)
            {
               jQuery('#appointment_date_error').html(response);
            } 
        });
   
    }  
          
</script>
<script type="text/javascript">

    /*function get_hospital_doctors(hospital_id) {
    
        $.ajax({
            url: '<?php echo base_url();?>main/get_hospital_doctors/' + hospital_id ,
            success: function(response)
            {

                jQuery('#doctors').html(response);
            }
        });

    }*/
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