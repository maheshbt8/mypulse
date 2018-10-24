<style>
   /* .modal-backdrop.in{
        z-index: auto;
    }*/
    .modal-content {
    width: 155%;
}
</style>
<?php 
$single_appointment_info = $this->db->get_where('appointments', array('appointment_id' => $appointment_id))->result_array();
foreach ($single_appointment_info as $row) {
?>
<div class="row">
    <div class="col-md-12">
    
       
        <!------CONTROL TABS END------>
         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>index.php?hospitaladmins/edit_appointment/" method="post" enctype="multipart/form-data">
             
        <div class="tab-content">
           
        <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                
                <div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            
            <div class="panel-body">
    
                
                    <div class="row">
                        <div class="col-sm-6">
                        <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('doctor'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="doctor" class="form-control"  autocomplete="off" id="doctor" list="doctors" placeholder="e.g. Hospital Name, Doctor Name or Specialisation" disabled="true" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php $doctor=$this->db->where('doctor_id',$row['doctor_id'])->get('doctors')->row_array(); echo $doctor['unique_id'].' / '.$doctor['name']; ?>" onchange="return get_doctor_ava(this.value)">
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
                            <input type="text" name="appointment_date" class="form-control"  autocomplete="off" placeholder="<?php echo get_phrase('Appointment Date'); ?>" id="appointment_date" value="<?php echo $row['appointment_date']; ?>" disabled="true" onchange="return get_dco_date(this.value)" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" >
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
                            <div class="col-sm-8" id="doc_ava">
                                <input type="text" name="reason" placeholder="Reason for Appointment" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo $row['reason']; ?>" disabled="true" >
                            </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('Remark'); ?></label>
                            <div class="col-sm-8" id="doc_ava">
                                <input type="text" name="remark" placeholder="Remark to be updated by Hospital(Optional)" class="form-control" disabled="true" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo $row['remark']; ?>">
                            </div>
                    </div>
                </div>
                <div class="col-sm-6">
            <div class="col-sm-offset-3 col-sm-8" id="doc_ava">
<a href="#" class="hiper"onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/appointment_history/<?php echo $row['appointment_id'];?>');">View Appointment History</a>
            </div>
            </div>
            </div>
                    </div>
            </div>

        </div>

    </div>
</div>
            
                    </div>   
                    <div class="col-sm-3 control-label col-sm-offset-9">
                        <!-- <input type="submit" class="btn btn-success" value="<?php echo get_phrase('submit'); ?>">&nbsp;&nbsp; -->
                        <input type="button" class="btn btn-info pull-right" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
                    </div>  
   </form>
   
    </div>
</div>
<?php } ?>
<script type="text/javascript">
    
   function get_doctor_ava(unique_id) {
     $.ajax({
            url: '<?php echo base_url();?>index.php?ajax/get_doctor_data/' + unique_id ,
            success: function(response)
            {
                jQuery('#doc_ava').html(response);
                document.getElementById("appointment_date").disabled = false;
                
            } 
        });
   
    }  

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
            url: '<?php echo base_url();?>index.php?ajax/get_dco_date/' + doctor_id,
            data : {date_val : date_value},
            success: function(response)
            {
               jQuery('#available_slot').html(response);
               document.getElementById("available_slot").disabled = false;
               
            } 
        });
   
    }  
          
</script>
