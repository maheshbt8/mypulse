<style>
    .modal-backdrop.in{
        z-index: auto;
    }
</style>
<?php $user_info=$this->crud_model->select_inpatient_id_info($patient_id);
$user_data=$this->db->where('user_id',$user_info->user_id)->get('users')->row_array();
$bed_info=$this->db->where('bed_id',$user_info->bed_id)->get('bed')->row();
?>
<div class="row">
    <div class="col-md-12">
         <!------CONTROL TABS END------>
         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/edit_inpatient/<?=$patient_id?>" method="post" enctype="multipart/form-data">
             
        <div class="tab-content">
           
        <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                
                <div class="row">
    <div class="col-md-3">
<h4><?php echo '<b>Bed</b> : '.$bed_info->name;?></h4>
<h4><?php if($user_info->status == 0){$status='Not Admitted';}elseif($user_info->status == 1){$status='Admitted';}elseif($user_info->status == 2){$status='Discharged';}echo '<b>Status</b> : '.$status;?></h4>
<h4><?php echo '<b>Admitted Date & Time</b> : '.$user_info->join_date;?></h4>
<h4><?php echo '<b>Reason</b> : '.$user_info->reason;?></h4>
<h4><?php echo '<b>Discharged Date & Time</b> : '.$user_info->discharged_date;?></h4>
<!-- <h4><b>Join Date : </b><?php echo date('M ,d-Y',strtotime($row['appointment_date']));?></h4>
<h4><b>Discharged Date : </b></h4>
<h4><b>Reason : </b><?php echo $row['reason'];?></h4>
<h4><b>Reason : </b><?php if($row['status'] == 1){echo "<button type='button' class='btn-danger'>Pending</button>";   
                 }
                 elseif($row['status'] == 2){ echo "<button type='button' class='btn-success'>Confirmed</button>";}
                 elseif($row['status'] == 3){ echo "<button type='button' class='btn-info'>Cancelled</button>";}
                 elseif($row['status'] == 4){ echo "<button type='button' class='btn-warning'>Closed</button>";};?></h4>   
    <h4><a href="<?php echo base_url();?>main/appointment_history/<?php echo $row['appointment_id'];?>" class="hiper">View Appointment History</a></h4>  -->
        </div>
    <div class="col-md-9">

        <div class="panel panel-primary" data-collapsed="0">

            
            <div class="panel-body">
                    <div class="row">
                                  <div class="col-sm-6">
                              <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('user'); ?></label>

                        <div class="col-sm-8" id="user_data">
                            <input type="text" name="user" class="form-control"  autocomplete="off" id="user" list="users" placeholder="e.g. Enter User Email, Mobile Number or User ID" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?=$user_data['name'].' '.$user_data['lname']?>" onchange="return get_user_data(this.value)" disabled>
                            <input type="hidden" name="user_id" value="<?=$user_info->user_id?>">
                        </div>
                    </div>
                </div> 
        <div class="col-sm-6">
                <?php if($account_type=='superadmin'){?>
                  <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('hospital'); ?></label> 

                        <div class="col-sm-8">
                            <select name="hospital" class="form-control" id="hospital"  data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo set_value('hospital'); ?>"  onchange="return get_branch(this.value)">
                                <?php 
                                $admins = $this->db->get_where('hospitals',array('status'=>1))->result_array();
                                foreach($admins as $row){?>
                                <option value="<?php echo $row['hospital_id'] ?>" <?php if($row['hospital_id']==$user_info->hospital_id){echo 'selected';}?>><?php echo $row['name'] ?></option>
                                
                                <?php } ?>
                               
                            </select>
                            <span ><?php echo form_error('hospital'); ?></span>
                        </div>
                    </div>
                    <?php }elseif($account_type=='hospitaladmins' || $account_type=='doctors'){?>
                <input type="hidden" name="hospital" value="<?=$user_info->hospital_id;?>"/>
                <?php }?>
        </div>
        <div class="col-sm-6">
            <?php if($account_type=='superadmin' || $account_type=='hospitaladmins'){?>
                              <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('branch'); ?></label>
                            <div class="col-sm-8">
                                <select name="branch" class="form-control" id="select_branch"  data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo set_value('branch'); ?>"  onchange="return get_department(this.value)">
            <?php $hospital_info=$this->db->where('hospital_id',$user_info->hospital_id)->get('branch')->result_array();?>
                    <?php if($account_type=='superadmin'){?>
                      <?php 
                    $hospital_info=$this->db->where('hospital_id',$user_info->hospital_id)->get('branch')->result_array();
                foreach ($hospital_info as $row1) { ?>
                <option value="<?php echo $row1['branch_id']; ?>" <?php if($row1['branch_id'] == $bed_info->branch_id){echo 'selected';}?>><?php echo $row1['name']; ?></option>
                                <?php } ?>
                    <?php }elseif($account_type=='hospitaladmins'){?>
                 <?php 
                foreach ($hospital_info as $row1) { ?>
                <option value="<?php echo $row1['branch_id']; ?>" <?php if($row1['branch_id'] == $bed_info->branch_id){echo 'selected';}?>><?php echo $row1['name']; ?></option>
                                <?php } ?>
                <?php }?> 
                                </select>
                                <span ><?php echo form_error('branch'); ?></span>
                            </div>
                    </div>
                <?php }elseif($account_type=='doctors'){?>
                <input type="hidden" name="branch" value="<?php echo $bed_info->branch_id;?>"/>
                <?php }?>
        </div>
        <div class="col-sm-6">
            <?php if($account_type=='superadmin' || $account_type=='hospitaladmins'){?>
                                <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('department'); ?></label>
                            <div class="col-sm-8">
                                <select name="department" class="form-control" id="select_department"  data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo set_value('department'); ?>" onchange="return get_ward(this.value)">
                                
              <?php 
              $dep_info=$this->db->where('branch_id',$bed_info->branch_id)->get('department')->result_array();
                foreach ($dep_info as $row1) { ?>
                <option value="<?php echo $row1['department_id']; ?>" <?php if($row1['department_id'] == $bed_info->department_id){echo 'selected';}?>><?php echo $row1['name']; ?></option>
                                <?php } ?>
                                </select>
                                <span ><?php echo form_error('department'); ?></span>
                            </div>
                    </div>
                <?php }elseif($account_type=='doctors'){?>
                <input type="hidden" name="department" value="<?php echo $bed_info->department_id;?>"/>
                <?php }?>
        </div>
        <div class="col-sm-6">
                        <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectWard'];?></label>
                            <div class="col-sm-8">
                                <select name="ward" class="form-control" id="select_ward"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="" onchange="return get_bed(this.value)">
            <?php $ward_info=$this->db->where('department_id',$bed_info->department_id)->get('ward')->result_array();?>
                                <?php if($account_type=='superadmin' || $account_type=='hospitaladmins'){?>
                                    <?php 
                foreach ($ward_info as $row1) { ?>
                <option value="<?php echo $row1['ward_id']; ?>" <?php if($row1['ward_id'] == $bed_info->ward_id){echo 'selected';}?>><?php echo $row1['name']; ?></option>
                                <?php } ?>
                    <?php }elseif($account_type=='doctors'){ ?>
        <?php 
        foreach ($ward_info as $row) {
        ?>
        <option value="<?= $row['ward_id'];?>" <?php if($row['ward_id'] == $bed_info->ward_id){echo 'selected';}?>><?= $row['name'];?></option> <?php } }?>
                                </select>
                            </div>
                    </div>
        </div>
        <div class="col-sm-6">
                        <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo 'Bed';?></label>
                            <div class="col-sm-8">
                                <select name="bed" class="form-control" id="select_bed"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                        <?php
                $bed_info1=$this->db->where('ward_id',$bed_info->ward_id)->get('bed')->result_array(); 
                foreach ($bed_info1 as $row1) { ?>
                <option value="<?php echo $row1['bed_id']; ?>" <?php if($row1['bed_id'] == $bed_info->bed_id){echo 'selected';}?>><?php echo $row1['name']; ?></option>
                                <?php } ?>
                                </select>
                            </div>
                    </div>
        </div>
        
                <div class="col-sm-6">
            <?php if($account_type == 'superadmin' || $account_type == 'hospitaladmins'){ ?>
                                 <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('doctor'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="doctor" class="form-control"  autocomplete="off" id="doctor" list="doctors" placeholder="e.g. Hospital Name, Doctor Name or Specialisation " data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo $this->db->where('doctor_id',$user_info->doctor_id)->get('doctors')->row()->unique_id; ?>" onchange="return get_doctor_ava(this.value)">
    <datalist id="doctors">
        <?php $users=$this->db->where('department_id',$bed_info->department_id)->get('doctors')->result_array();
        foreach ($users as $row) {
            $spee=explode(',',$row['specializations']);
            $spe='';
            for($i=0;$i<count($spee);$i++) {
             $spe=$this->db->where('specializations_id',$spee[$i])->get('specializations')->row()->name.','.$spe;   
            }?>
<option value="<?= $row['unique_id'];?>">Dr. <?=ucfirst($row['name']).' ('.$spe.')';?></option>
<?php }?>
  </datalist>
                        </div>
                    </div>
                    <?php }elseif($account_type == 'doctors'){ ?>
                    <input type="hidden" name="doctor" id="doctor" value="<?php echo $user_info->doctor_id;?>"> 
                  <?php }?>
                </div>

                                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('Reason'); ?></label>
                            <div class="col-sm-8" id="reason">
                                <input type="text" name="reason" placeholder="Reason" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?=$user_info->reason;?>" >
                            </div>
                    </div>
                </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo 'Status';?></label>
                            <div class="col-sm-8">
                                <select name="status" class="form-control" id="status"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                                    <option value="1"<?php if($user_info->status==1){echo 'selected';}?>><?php echo get_phrase('admitted'); ?></option>
                                    <option value="2"<?php if($user_info->status==2){echo 'selected';}?>><?php echo get_phrase('discharged'); ?></option>
                                </select>
                            </div>
                    </div>
        </div>
        <!-- <span id="doc_ava"></span> -->
            </div>            
            </div>
            </div>
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
<div class="row">
    <div class="col-md-2">
            <center>
        <a href="#">
                <img src="<?php echo base_url('uploads/user_image/').$user_data['user_id'].'.jpg';?>" class="img-circle" style="width: 35%;">
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
<script type="text/javascript">

    function get_branch(hospital_id) {
    
        $.ajax({
            url: '<?php echo base_url();?>ajax/get_branch/' + hospital_id ,
            success: function(response)
            {
                jQuery('#select_branch').html(response);
            }
        });

    }
    
    function get_department(branch_id) {

        $.ajax({
            url: '<?php echo base_url();?>ajax/get_department/' + branch_id ,
            success: function(response)
            {
                jQuery('#select_department').html(response);
            }
        });
    }
        function get_ward(department_id) {
        $.ajax({
            url: '<?php echo base_url();?>ajax/get_ward/' + department_id ,
            success: function(response)
            {
                jQuery('#select_ward').html(response);
            }
        });
                $.ajax({
            url: '<?php echo base_url();?>ajax/get_department_doctors/' + department_id ,
            success: function(response)
            {
            jQuery('#doctors').html(response);
            }
        });

    }
       function get_bed(ward_id) {

        $.ajax({
            url: '<?php echo base_url();?>ajax/get_bed/' + ward_id ,
            success: function(response)
            {
                jQuery('#select_bed').html(response);
            }
        });

    }

</script>