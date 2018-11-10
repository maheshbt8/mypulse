<div class="row" >
<?php 
$this->session->set_userdata('last_page1', current_url());
?>
<?php 
$single_appointment_info = $this->db->get_where('appointments', array('appointment_id' => $appointment_id))->result_array();
foreach ($single_appointment_info as $row) {
    $user_data=$this->db->where('user_id',$row['user_id'])->get('users')->row_array();
    if($account_type != 'doctors' || $row['status']!='2'){
?>

<div class="row">
    <div class="col-md-12">
    
       
        <!------CONTROL TABS END------>
         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/edit_appointment/" method="post" enctype="multipart/form-data">
             
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
<a href="<?php echo base_url();?>main/appointment_history/<?php echo $row['appointment_id'];?>" class="hiper">View Appointment History</a>
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
<?php }else{ ?>

            <!----TABLE LISTING STARTS--> 
<div class="row">
    <div class="col-md-12">
      <input type="button" class="btn btn-info pull-right" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
  </div> 
</div>
<br/>
<div class="row">  
<div class="col-md-12">
<div class="panel panel-primary" data-collapsed="0">
<div class="panel-body">
    <div class="col-md-4">
            
<h4><b>Appointment Date : </b><?php echo date('M ,d-Y',strtotime($row['appointment_date']));?></h4>
<h4><b>Appointment Slot : </b><?php echo date('h:i A',strtotime($row['appointment_time_starte'])) .' - '.date('h:i A',strtotime($row['appointment_time_end'])) ;?></h4>
<h4><b>Reason : </b><?php echo $row['reason'];?></h4>
<h4><b>Reason : </b><?php if($row['status'] == 1){echo "<button type='button' class='btn-danger'>Pending</button>";   
                 }
                 elseif($row['status'] == 2){ echo "<button type='button' class='btn-success'>Confirmed</button>";}
                 elseif($row['status'] == 3){ echo "<button type='button' class='btn-info'>Cancelled</button>";}
                 elseif($row['status'] == 4){ echo "<button type='button' class='btn-warning'>Closed</button>";};?></h4>   
    <h4><a href="<?php echo base_url();?>main/appointment_history/<?php echo $row['appointment_id'];?>" class="hiper">View Appointment History</a></h4> 
        </div>
   
    <div class="col-md-6">
        <form action="<?php echo base_url()?>main/appointment/update_remark/<?php echo $row['appointment_id'];?>" method="post" class="form-horizontal form-groups-bordered validate" id="form1" enctype="multipart/form-data">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('Remark'); ?></label>
                            <div class="col-sm-8" id="remark">
                                <textarea type="text" name="remark" placeholder="Remark to be updated by Hospital" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>"><?php echo $row['remarks'];?></textarea>
                            </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('Date'); ?></label>
                            <div class="col-sm-8" id="remark">
                                <input type="text" name="next_appointment" placeholder="Next Appointment Date" class="form-control" id="start_on" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo $row['next_appointment'];?>" autocomplete="off">
                            </div>
                    </div>
                </div>
                <div class="col-sm-11 control-label">
                        <input type="submit" class="btn btn-success" value="<?php echo get_phrase('update'); ?>">&nbsp;&nbsp;
                        
                </div>
        </form>
    </div>

</div>
</div>
</div>
</div>
<div class="row">
    <div class="col-md-2">
            <center>
        <a href="#">
                <img src="<?php echo base_url('uploads/user_image/').$row['user_id'].'.jpg';?>" class="img-circle" style="width: 35%;">
            </a>
        <br>
        <h3><?php echo 'Mr/Mrs.'.$user_data['name'];?></h3>
        <br>
        <span>
       <h4><i class="fa fa-map-marker m-r-xs"></i>&nbsp;&nbsp;<?php echo $user_data['address'];?></h4>
        <h4><i class="fa fa-envelope m-r-xs"></i>&nbsp;&nbsp;<?php echo $user_data['email'];?></h4>
        <h4><i class="fa fa-phone m-r-xs"></i>&nbsp;&nbsp;<?php echo $user_data['phone'];?></h4> 
        </span>
      </center>
        </div>
   
    <div class="col-md-10">
  
<div class="row">
    <div class="col-md-12">
    
        <!------CONTROL TABS START------>   
        <ul class="nav nav-tabs bordered"> 
            <li class="active">
                <a href="#h1" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo 'Health Info';?>

                </a>
            </li>
            <li>
                <a href="#h2" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo 'Prescriptions';?>

                </a>
            </li>
            <li>
                <a href="#h3" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo 'Prognosis';?>

                </a>
            </li>
            <li>
                <a href="#h4" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo 'Inpatien';?>

                </a>
            </li>
        </ul>
        <!------CONTROL TABS END------>
         
             
        <div class="tab-content">
        <br>
            <!----CREATION FORM ENDS-->
            <div class="tab-pane box active" id="h1" style="padding: 5px">
                <div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">
         <div class="panel-body">
            <form role="form" class="form-horizontal form-groups-bordered validate" action="#" method="post" enctype="multipart/form-data">
                <div class="row">
                        <div class="col-md-6">
                  <div class="form-group">
                        <label for="field-ta" class="col-sm-4 control-label"><?php echo $this->lang->line('labels')['bloodGroup'];?></label>

                        <div class="col-sm-8">
                            <select name="blood_group" class="form-control" id="blood_group" value="" disabled="">
                                <option value=""><?php echo $this->lang->line('labels')['selectBloodGroup'];?></option>
                                    <option value="A+"<?php if($user_data['blood_group']=='A+'){echo 'selected';}?>><?php echo get_phrase('A+'); ?></option>
                                    <option value="A-"<?php if($user_data['blood_group']=='A-'){echo 'selected';}?>><?php echo get_phrase('A-'); ?></option>
                                    <option value="B+"<?php if($user_data['blood_group']=='B+'){echo 'selected';}?>><?php echo get_phrase('B+'); ?></option>
                                    <option value="B-"<?php if($user_data['blood_group']=='B-'){echo 'selected';}?>><?php echo get_phrase('B-'); ?></option>
                                    <option value="AB+"<?php if($user_data['blood_group']=='AB+'){echo 'selected';}?>><?php echo get_phrase('AB+'); ?></option>
                                    <option value="AB-"<?php if($user_data['blood_group']=='AB-'){echo 'selected';}?>><?php echo get_phrase('AB-'); ?></option>
                                    <option value="O+"<?php if($user_data['blood_group']=='O-'){echo 'selected';}?>><?php echo get_phrase('o+'); ?></option>
                                    <option value="O-"<?php if($user_data['blood_group']=='O-'){echo 'selected';}?>><?php echo get_phrase('o-'); ?></option>
                                   
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-4 control-label"><?php echo $this->lang->line('labels')['age'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="age" class="form-control" id="age" value="<?=$user_data['age']?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-4 control-label"><?php echo $this->lang->line('labels')['height'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="height" class="form-control" id="height" value="<?=$user_data['height']?>"disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-4 control-label"><?php echo $this->lang->line('labels')['weight'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="weight" class="form-control" id="weight" value="<?=$user_data['weight']?>"disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-4 control-label"><?php echo $this->lang->line('labels')['bloodPressure'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="blood_pressure" class="form-control" id="blood_pressure" value="<?=$user_data['blood_pressure']?>"disabled>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-4 control-label"><?php echo $this->lang->line('labels')['sugarLevel'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="sugar_level" class="form-control" id="sugar_level" value="<?=$user_data['sugar_level']?>"disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-4 control-label"><?php echo $this->lang->line('labels')['healthInsuranceProvider'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="health_insurance_provider" class="form-control" id="health_insurance_provider" value="<?=$user_data['health_insurance_provider']?>"disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-4 control-label"><?php echo $this->lang->line('labels')['healthInsuranceId'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="health_insurance_id" class="form-control" id="health_insurance_id" value="<?=$user_data['health_insurance_id']?>"disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-4 control-label"><?php echo $this->lang->line('labels')['familyHistory'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="family_history" class="form-control" id="family_history" value="<?=$user_data['family_history']?>"disabled>
                        </div>
                    </div>
                   <div class="form-group">
                        <label for="field-1" class="col-sm-4 control-label"><?php echo $this->lang->line('labels')['pastMedicalHistory'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="past_medical_history" class="form-control" id="past_medical_history" value="<?=$user_data['past_medical_history']?>"disabled>
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
        <div class="tab-pane box" id="h2" style="padding: 5px">
                <div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">
         <div class="panel-body">
            <div style="clear:both;"></div>
<button type="button" onclick="window.location.href = '<?php echo base_url(); ?>main/add_prescription/<?= $row['appointment_id'];?>'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_prescription'); ?>
</button>

<table class="table table-bordered table-striped datatable" id="table-2">  
    <thead>
        <tr>
            <th><?php echo get_phrase('sl_no'); ?></th>
            <th><?php echo get_phrase('title (Prescription_for)'); ?></th>
            <th><?php echo get_phrase('hospital / doctor'); ?></th>
            <th><?php echo get_phrase('date'); ?></th>
            <?php if($account_type == 'doctors'){?>
            <th><?php echo get_phrase('options'); ?></th><?php }?>
        </tr>
    </thead>

    <tbody>
        <?php  
        $prescription_info=$this->db->get_where('prescription',array('user_id'=>$user_data['user_id'],'status'=>1))->result_array();
        $i=1;foreach ($prescription_info as $row1) {
            ?>
            <tr>
                <td><?php echo $i?></td>
                <td><a href="<?php echo base_url(); ?>main/prescription_history/<?php echo $row1['prescription_id'] ?>" class="hiper"><!-- <a href="#"onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/prescription_history/<?php echo $row1['prescription_id'] ?>');" class="hiper"> --><?php echo $row1['title'] ?></a></td>
                <td><?php $doc=$this->db->where('doctor_id',$row1['doctor_id'])->get('doctors')->row();echo $this->db->where('hospital_id',$doc->hospital_id)->get('hospitals')->row()->name.' / '.$doc->name?></td>
                <td><?php echo $row1['created_at'] ?></td>
               <?php if($account_type == 'doctors'){?>
                <td>
<?php if($row1['doctor_id'] == $this->session->userdata('login_user_id')){?>
            <a href="<?php echo base_url(); ?>main/edit_prescription/<?php echo $row1['prescription_id'] ?>" title="Edit"><i class="glyphicon glyphicon-pencil"></i>
            </a><?php }?>
                </td><?php }?>
            </tr>
        <?php $i++;} ?>
    </tbody>
</table>
         </div>
     </div>
 </div>
</div>
</div>
<div class="tab-pane box" id="h3" style="padding: 5px">
                <div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">
         <div class="panel-body">
            <div style="clear:both;"></div>
<button type="button" onclick="window.location.href = '<?php echo base_url(); ?>main/add_prognosis/<?= $row['appointment_id'];?>'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_prognosis'); ?>
</button>
<table class="table table-bordered table-striped datatable" id="table-2">  
    <thead>
        <tr>
            <th><?php echo get_phrase('sl_no'); ?></th>
            <th><?php echo get_phrase('title'); ?></th>
            <th><?php echo get_phrase('case_history'); ?></th>
            <th><?php echo get_phrase('date'); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php  
        $prognosis_info=$this->db->get_where('prognosis',array('user_id'=>$user_data['user_id'],'status'=>1))->result_array();
        $i=1;foreach ($prognosis_info as $row2) {
            ?>
            <tr>
                <td><?php echo $i?></td>
                <td><a href="<?php echo base_url(); ?>main/edit_prognosis/<?php echo $row2['prognosis_id'] ?>" class="hiper"><?php echo $row2['title'] ?></a></td>
                <td><?php echo $row2['case_history'] ?></td>
                <td><?php echo $row2['created_at'] ?></td>
            </tr>
        <?php $i++;} ?>
    </tbody>
</table>
         </div>
     </div>
 </div>
</div>
</div>
<div class="tab-pane box" id="h4" style="padding: 5px">
                <div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">
         <div class="panel-body">
            <div style="clear:both;"></div>
<!-- <button type="button" onclick="window.location.href = '<?php echo base_url(); ?>main/add_prescription/<?= $row['appointment_id'];?>'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_prescription'); ?>
</button> -->
<!-- <button type="button" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/add_prescription');" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_prescription'); ?>
</button> -->

<table class="table table-bordered table-striped datatable" id="table-2">  
    <thead>
        <tr>
            <th><?php echo get_phrase('sl_no'); ?></th>
            <th><?php echo get_phrase('bed'); ?></th>
            <th><?php echo get_phrase('admitted_date & time'); ?></th>
            <th><?php echo get_phrase('discharged_date & time'); ?></th>
            <th><?php echo get_phrase('reason'); ?></th>
            <th><?php echo get_phrase('status'); ?></th>
            <!-- <th><?php echo get_phrase('action'); ?></th> -->
        </tr>
    </thead>

    <tbody>
        <?php  
        $in_pa=$this->crud_model->select_inpatient_id_doctor_info($user_data['user_id']);
        $i=1;foreach ($in_pa as $in_pa1) {
            
            ?>
            <tr>
                <td><?php echo $i?></td>
                <td><?php echo $this->db->where('bed_id',$in_pa1['bed_id'])->get('bed')->row()->name; ?></td>
                <td><?php echo date('M ,d-Y h:i A',strtotime($in_pa1['join_date'])); ?></td>
               <td><?php if($in_pa1['discharged_date'] != ''){ echo date('M ,d-Y h:i A',strtotime($in_pa1['discharged_date']));}?></td>
               <td><?php echo $in_pa1['reason'] ?></td>
               <td><?php if($in_pa1['status']==1){echo "Admited";}elseif($in_pa1['status']==2){echo "Discharged";} ?></td>
                <!-- <td>
            <a href="<?php echo base_url(); ?>main/edit_prescription/<?php echo $row1['prescription_id'] ?>" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                </td> -->
            </tr>
        <?php $i++;} ?>
    </tbody>
</table>
         </div>
     </div>
 </div>
</div>
</div>

        </div>
        
    </div>
</div>


    </div>
</div>
<br/><br/>
<?php }} ?>
</div>
<!-- <script type="text/javascript">
    
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
 -->
 <script type="text/javascript">
                    $(document).ready(function(){
                    var date = new Date();
                    date.setDate(date.getDate());

                    $('#start_on').datepicker({ 
                    startDate: date

                    });
                    } );                  

</script>