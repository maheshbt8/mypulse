<?php 
$this->session->set_userdata('last_page1', current_url());
?>
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
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <input type="button" class="btn btn-info pull-right" value="<?php echo get_phrase('close'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/edit_inpatient/<?=$patient_id?>" method="post" enctype="multipart/form-data">
    <div class="col-md-3">
<h4><?php echo '<b>User ID</b> : '.$user_data['unique_id'];?></h4>
<h4><?php echo '<b>User Name</b> : '.$user_data['name'];?></h4>
<h4><?php echo '<b>Bed</b> : '.$bed_info->name;?></h4>
<h4><?php if($user_info->status == 0){$status='Recommended';}elseif($user_info->status == 1){$status='Admitted';}elseif($user_info->status == 2){$status='Discharged';}echo '<b>Status</b> : '.$status;?></h4>
<h4><?php echo '<b>Admitted Date & Time</b> : '.$user_info->join_date;?></h4>
<h4><?php echo '<b>Reason</b> : '.$user_info->reason;?></h4>
<h4><?php echo '<b>Discharged Date & Time</b> : '.$user_info->discharged_date;?></h4>
<a href="<?=base_url('main/edit_user/').$user_info->user_id?>" class="hiper">View User Details</a>
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
                            <select name="hospital" class="form-control select2" id="hospital"  data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo set_value('hospital'); ?>"  onchange="return get_branch(this.value)">
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
                                <select name="branch" class="form-control select2" id="select_branch"  data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo set_value('branch'); ?>"  onchange="return get_department(this.value)">
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
                                <select name="department" class="form-control select2" id="select_department"  data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo set_value('department'); ?>" onchange="return get_ward(this.value)">
                                
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
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo 'Ward';?></label>
                            <div class="col-sm-8">
                                <select name="ward" class="form-control select2" id="select_ward"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="" onchange="return get_bed(this.value)">
            <?php $ward_info=$this->db->where('department_id',$bed_info->department_id)->get('ward')->result_array();?>
                                <?php if($account_type=='superadmin' || $account_type=='hospitaladmins'){?>
                                    <?php 
                foreach ($ward_info as $row1) { ?>
                <option value="<?php echo $row1['ward_id']; ?>" <?php if($row1['ward_id'] == $bed_info->ward_id){echo 'selected';}?>><?php echo $row1['name']; ?></option>
                                <?php } ?>
<?php }elseif($account_type=='doctors' || $account_type=='nurse'){ ?>
                        <option value=""> Select Ward </option>
        <?php 
        if($account_type=='doctors'){
        $ward_info=$this->db->where('department_id',$this->session->userdata('department_id'))->get('ward')->result_array();
        }elseif($account_type=='nurse'){
            if($this->session->userdata('department_id')==0){
            $ward_info=$this->db->where('branch_id',$this->session->userdata('branch_id'))->get('ward')->result_array();
            }else{
             $ward_info=$this->db->where('department_id',$this->session->userdata('department_id'))->get('ward')->result_array();   
            }
        }
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
                                <select name="bed" class="form-control select2" id="select_bed"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
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
                    <input type="hidden" name="doctor" id="doctor" value="<?php echo $this->db->where('doctor_id',$user_info->doctor_id)->get('doctors')->row()->unique_id;?>"> 
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
                                    <option value="1"<?php if($user_info->status==0){echo 'selected';}?>><?php echo get_phrase('recommended'); ?></option>
                                    <option value="1"<?php if($user_info->status==1){echo 'selected';}?>><?php echo get_phrase('admitted'); ?></option>
                                    <option value="2"<?php if($user_info->status==2){echo 'selected';}?>><?php echo get_phrase('discharged'); ?></option>
                                </select>
                            </div>
                    </div>
        </div>
            </div>            
            </div>
            </div>
        </div> 
                    <div class="col-sm-3 control-label col-sm-offset-9 ">
                        <input type="submit" class="btn btn-success" value="<?php echo get_phrase('submit'); ?>">&nbsp;&nbsp;
                    </div>  
                   
   </form>
   
    </div>
</div>
 </div>
</div>
<?php if(($account_type == 'doctors' || $account_type == 'nurse') && $user_info->status==1){
if($user_info->status == 1){?>
<?php $data['user_id']=$user_info->user_id;$this->load->view('backend/main/user_history',$data);?>
<?php }}?>

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