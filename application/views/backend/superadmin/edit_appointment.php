<style>
    .modal-backdrop.in{
        z-index: auto;
    }
</style>
<?php 
$single_appointment_info = $this->db->get_where('appointments', array('appointment_id' => $appointment_id))->result_array();
foreach ($single_appointment_info as $row) {
?>
<div class="row">
    <div class="col-md-12">
    
       
        <!------CONTROL TABS END------>
         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>index.php?superadmin/edit_appointment/" method="post" enctype="multipart/form-data">
             
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
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('doctors'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="doctor" class="form-control"  autocomplete="off" id="doctor" list="doctors" placeholder="e.g. Hospital Name, Doctor Name or Specialisation" disabled="true" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php $doctor=$this->db->where('doctor_id',$row['doctor_id'])->get('doctors')->row_array(); echo $doctor['unique_id']; ?>" onchange="return get_doctor_ava(this.value)">
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
                                <input type="text" name="remark" placeholder="Remark to be updated by Hospital(Optional)" class="form-control" disabled="true" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php set_value('remark');?>">
                            </div>
                    </div>
                </div>
                <div class="col-sm-6">
                <!-- <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/appointment_history/<?php echo $row['appointment_id'];?>');" class="hiper">View Appointment History</a> -->

<div class="container">
  <!-- <h2>Modal Example</h2> -->
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">View Appointment History</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="background-color:#fbfafa;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Appointment Details</h4>
        </div>
        <div class="modal-body">
 
    <div id="invoice_print">
        <table width="100%" border="1">
            <tr>
    <td align="center"><h5><?php echo ucfirst('appointment_id'); ?> </h5></td><td align="center">
                    <h5><?php echo $row['appointment_number'];?></h5></td>
            </tr>
            <tr>
    <td align="center"><h5><?php echo ucfirst('creation_date'); ?> </h5></td><td align="center">
                    <h5><?php echo date('d M,Y', strtotime($row['modified_at']));?></h5></td>
            </tr>
            <tr>
    <td align="center"><h5><?php echo ucfirst('creation_time'); ?> </h5></td><td align="center">
                    <h5><?php echo date('h : m A', strtotime($row['modified_at']));?></h5></td>
            </tr>
            <tr>
    <td align="center"><h5><?php echo ucfirst('Role'); ?> </h5></td><td align="center">
                    <h5><?php echo $row['created_type'];?></h5></td>
            </tr>
            <tr>
    <td align="center"><h5><?php echo ucfirst('Name'); ?> </h5></td><td align="center">
                    <h5><?php echo $row['created_by'];?></h5></td>
            </tr>
            <tr>
    <td align="center"><h5><?php echo ucfirst('action'); ?> </h5></td><td align="center">
                    <h5><?php echo 'Created';?></h5></td>
            </tr>
            <tr>
    <td align="center"><h5><?php echo ucfirst('message'); ?> </h5></td><td align="center">
                    <h5><?php echo 'Appointment Created for '.date('d M,Y', strtotime($row['appointment_date'])).' - '.date('h : m A', strtotime($row['appointment_time_start'])).' - '.date('h : m A', strtotime($row['appointment_time_end']));?></h5></td>
            </tr>
            </tr>
        </table>
        
    </div>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
                  <!-- Trigger the modal with a button -->
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
                        <input type="submit" class="btn btn-success" value="<?php echo get_phrase('submit'); ?>">&nbsp;&nbsp;
                        <input type="button" class="btn btn-info" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
                    </div>  
   </form>
    </div>
</div>
<?php } ?>
<script type="text/javascript">
    
   function get_doctor_ava(unique_id) {
     $.ajax({
            url: '<?php echo base_url();?>index.php?superadmin/get_doctor_data/' + unique_id ,
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
            url: '<?php echo base_url();?>index.php?superadmin/get_dco_date/' + doctor_id,
            data : {date_val : date_value},
            success: function(response)
            {
               jQuery('#available_slot').html(response);
               document.getElementById("available_slot").disabled = false;
               
            } 
        });
   
    }  
          
</script>
