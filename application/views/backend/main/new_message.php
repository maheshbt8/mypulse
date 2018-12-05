<?php 
$ward=$this->db->where('ward_id',$ward_id)->get('ward')->row_array();
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-body">
<?php echo form_open(base_url() . 'main/new_message/' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
            <div class="padded">
                <div class="col-md-12"> 
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-1 control-label"><?php echo get_phrase('to'); ?></label>
    <div class="col-sm-11" id="to_ind">
    <?php if($account_type=='superadmin'){?>
<input type="hidden" name="hospital_id" value="0">
<?php }elseif($account_type=='hospitaladmins' || $account_type=='doctors'){?>
<input type="hidden" name="hospital_id" value="<?= $this->session->userdata('hospital_id');?>"><?php }?> 
    <select class="form-control select2" name="reciever[]"  data-validate="required" data-message-required="<?php echo 'Please Select Any User';?>" required multiple>
            <optgroup label="<?php echo get_phrase('Group_message'); ?>"><?php if($account_type=='superadmin'){?>
                <option value="0/1">All Hospital Admins</option>
                <?php }
                if($account_type != 'doctors'){ ?>
                <option value="0/4">All Doctors</option><?php }?>
                <option value="0/5">All Nurses</option>
                <option value="0/6">All Receptionists</option>
                <?php if($account_type!='doctors'){ ?>
                <option value="0/2">All Medical Labs</option>
                <option value="0/3">All Medical Stores</option>
            <?php }?>
                <option value="0/7"><?php if($account_type=='superadmin'){ echo 'All MyPulse Users';}elseif($account_type=='hospitaladmins' || $account_type=='doctors'){ echo 'All Patients';}?></option>
            </optgroup>
            <?php if($account_type=='superadmin' || $account_type=='doctors'){?>
            <optgroup label="<?php echo get_phrase('hospital_admins'); ?>">
                <?php
                if($account_type !='doctors'){
                $users = $this->db->get('hospitaladmins')->result_array();
            }elseif($account_type == 'doctors'){
               $users = $this->db->where('hospital_id',$this->session->userdata('hospital_id'))->get('hospitaladmins')->result_array(); 
            }
                foreach ($users as $row):
                    ?>
                    <option value="1/hospitaladmins-admin-<?php echo $row['admin_id']; ?>">
                        <?php echo $row['unique_id'].' - '.$row['name'].' ( '.$row['email'].' )'; ?></option>
                <?php endforeach; ?>
            </optgroup>
            <?php }elseif($account_type=='hospitaladmins'){?>
            <optgroup label="<?php echo get_phrase('super_admins'); ?>">    
                     <?php
                $super = $this->db->get('superadmin')->result_array();
                foreach ($super as $row):
                    ?>
                    <option value="1/superadmin-superadmin-<?php echo $row['superadmin_id']; ?>">
                        <?php echo $row['name'].' ( '.$row['email'].' )'; ?></option>
                <?php endforeach; ?>
                </optgroup>
                <?php }?>
            <?php
                if($account_type !='doctors'){ ?>
            <optgroup label="<?php echo get_phrase('doctors'); ?>">
                <?php
                $users=$this->crud_model->select_doctor_info();
                foreach ($users as $row):
                    ?>
                    <option value="1/doctors-doctor-<?php echo $row['doctor_id']; ?>">
                        <?php echo $row['unique_id'].' - '.$row['name'].' ( '.$row['email'].' )'; ?></option>
                <?php endforeach; ?>
            </optgroup><?php }?>
            <optgroup label="<?php echo get_phrase('nurse'); ?>">
                <?php
                $users=$this->crud_model->select_nurse_info();
                foreach ($users as $row):
                    ?>
                    <option value="1/nurse-nurse-<?php echo $row['nurse_id']; ?>">
                        <?php echo $row['unique_id'].' - '.$row['name'].' ( '.$row['email'].' )'; ?></option>
                <?php endforeach; ?>
            </optgroup>
            <optgroup label="<?php echo get_phrase('receptionists'); ?>">
                <?php
                $users=$this->crud_model->select_receptionist_info();
                foreach ($users as $row):
                    ?>
                    <option value="1/receptionist-receptionist-<?php echo $row['receptionist_id']; ?>">
                        <?php echo $row['unique_id'].' - '.$row['name'].' ( '.$row['email'].' )'; ?></option>
                <?php endforeach; ?>
            </optgroup>
            <?php if($account_type == 'superadmin' || $account_type=='hospitaladmins'){ ?>
            <optgroup label="<?php echo get_phrase('medical_stores'); ?>">
                <?php
                $users=$this->crud_model->select_store_info();
                foreach ($users as $row):
                    ?>
                    <option value="1/medicalstores-store-<?php echo $row['store_id']; ?>">
                        <?php echo $row['unique_id'].' - '.$row['name'].' ( '.$row['email'].' )'; ?></option>
                <?php endforeach; ?>
            </optgroup>
            <optgroup label="<?php echo get_phrase('medical_labs'); ?>">
                <?php
                $users=$this->crud_model->select_lab_info();
                foreach ($users as $row):
                    ?>
                    <option value="1/medicallabs-lab-<?php echo $row['lab_id']; ?>">
                        <?php echo $row['unique_id'].' - '.$row['name'].' ( '.$row['email'].' )'; ?></option>
                <?php endforeach; ?>
            </optgroup><?php }?>
            <?php if($account_type == 'superadmin'){?>
            <optgroup label="<?php echo get_phrase('myPulse_users'); ?>">
                <?php
                $users = $this->db->get('users')->result_array();
                foreach ($users as $row):
                    ?>
                    <option value="1/users-user-<?php echo $row['user_id']; ?>">
                        <?php echo $row['unique_id'].' - '.$row['name'].' ( '.$row['email'].' )'; ?></option>
                <?php endforeach; ?>
            </optgroup>
        <?php }elseif($account_type == 'hospitaladmins' || $account_type == 'doctors'){?>
            <optgroup label="<?php echo get_phrase('Patients'); ?>">
                <?php
               $users=$this->crud_model->select_patient_info();
                foreach ($users as $row):
                    $user=$this->db->where('user_id',$row->user_id)->get('users')->row_array();
                    ?>
                    <option value="1/users-user-<?php echo $user['user_id']; ?>">
                        <?php echo $user['unique_id'].' - '.$user['name'].' ( '.$user['email'].' )'; ?></option>
                <?php endforeach; ?>
            </optgroup>
        <?php }?>
            
    </select>
    </div> 
                    </div>     
                </div>
                <div class="col-md-12"> 
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-1 control-label"><?php echo get_phrase('title'); ?></label>
                             <div class="col-sm-11"> 
<input type="text" class="form-control" name="title" value="" data-validate="required" data-message-required="<?php echo ucfirst('value_required');?>" required>
                            </div>
                    </div>
                    
                </div>
                <div class="col-md-12"> 
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-1 control-label"><?php echo get_phrase('message'); ?></label>
                             <div class="col-sm-11"> 
<textarea type="text" class="form-control" name="message" value=""data-validate="required" data-message-required="<?php echo ucfirst('value_required');?>"rows="10" cols="50" required></textarea>
                            </div>
                    </div>
                    
                </div>
               <!--  <div class="col-md-12"> 
                    <div class="form-group">
                <label for="field-ta" class="col-sm-1 control-label"><?php echo get_phrase('message'); ?></label>
            </div>
            </div> -->
             <!-- <div class="form-group">

                    <div class="col-sm-12">
            <label for="field-ta" class="col-sm-1 control-label"><?php echo get_phrase('message'); ?></label>    
            <textarea type="text" class="form-control" name="message" value=""data-validate="required" data-message-required="<?php echo ucfirst('value_required');?>"rows="10" cols="50" required></textarea>
                    </div>
                </div> -->
               
            </div>
            <div class="form-group">
              <div class="col-sm-offset-10 col-sm-2">
                  <input type="submit" class="btn btn-success" value="Send">&nbsp;&nbsp;<input type="button" class="btn btn-info" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
              </div>
            </div>
        </form>
            </div>

        </div>

    </div>
</div>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- <script type="text/javascript" src="<?php echo base_url();?>/assets/js/ckeditor/ckeditor.js"></script> --> 
<!-- <script>
    CKEDITOR.replace( 'message' );
</script> -->
  <script>
  $( function() {
    $( ".email-check" ).checkboxradio({
      icon: false
    });
  } );
  </script> 
