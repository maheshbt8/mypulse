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
                <option value="0/2">All Hospital Admins</option>
                <?php }
                if($account_type != 'doctors'){ ?>
                <option value="0/3">All Doctors</option><?php }?>
                <option value="0/4">All Nurses</option>
                <option value="0/5">All Receptionists</option>
                <?php if($account_type!='doctors'){ ?>
                <option value="0/7">All Medical Labs</option>
                <option value="0/6">All Medical Stores</option>
            <?php }?>
                <option value="0/8"><?php if($account_type=='superadmin'){ echo 'All MyPulse Users';}elseif($account_type=='hospitaladmins' || $account_type=='doctors'){ echo 'All Patients';}?></option>
            </optgroup>
            <?php if($account_type=='superadmin' || $account_type=='doctors'){?>
            <optgroup label="<?php echo get_phrase('hospital_admins'); ?>">
                <?php
                if($account_type !='doctors'){
                $users = $this->db->select('admin_id,unique_id,name,email')->get_where('hospitaladmins',array('row_status_cd'=>'1'))->result_array();
            }elseif($account_type == 'doctors'){
               $users = $this->db->select('admin_id,unique_id,name,email')->where('hospital_id',$this->session->userdata('hospital_id'))->get_where('hospitaladmins',array('row_status_cd'=>'1'))->result_array(); 
            }
                foreach ($users as $row):
                    ?>
                    <option value="1/<?=$row['unique_id'];?>">
                        <?php echo $row['unique_id'].' - '.$row['name'].' ( '.$row['email'].' )'; ?></option>
                <?php endforeach; ?>
            </optgroup>
            <?php }elseif($account_type=='hospitaladmins'){?>
            <optgroup label="<?php echo get_phrase('super_admins'); ?>">    
                     <?php
                $super = $this->db->select('superadmin_id,unique_id,name,email')->get('superadmin')->result_array();
                foreach ($super as $row):
                    ?>
                    <option value="1/<?=$row['unique_id'];?>">
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
                    <option value="1/<?=$row['unique_id'];?>">
                        <?php echo $row['unique_id'].' - '.$row['name'].' ( '.$row['email'].' )'; ?></option>
                <?php endforeach; ?>
            </optgroup><?php }?>
            <optgroup label="<?php echo get_phrase('nurse'); ?>">
                <?php
                $users=$this->crud_model->select_nurse_info();
                foreach ($users as $row):
                    ?>
                    <option value="1/<?=$row['unique_id'];?>">
                        <?php echo $row['unique_id'].' - '.$row['name'].' ( '.$row['email'].' )'; ?></option>
                <?php endforeach; ?>
            </optgroup>
            <optgroup label="<?php echo get_phrase('receptionists'); ?>">
                <?php
                $users=$this->crud_model->select_receptionist_info();
                foreach ($users as $row):
                    ?>
                    <option value="1/<?=$row['unique_id'];?>">
                        <?php echo $row['unique_id'].' - '.$row['name'].' ( '.$row['email'].' )'; ?></option>
                <?php endforeach; ?>
            </optgroup>
            <?php if($account_type == 'superadmin' || $account_type=='hospitaladmins'){ ?>
            <optgroup label="<?php echo get_phrase('medical_stores'); ?>">
                <?php
                $users=$this->crud_model->select_store_info();
                foreach ($users as $row):
                    ?>
                    <option value="1/<?=$row['unique_id'];?>">
                        <?php echo $row['unique_id'].' - '.$row['name'].' ( '.$row['email'].' )'; ?></option>
                <?php endforeach; ?>
            </optgroup>
            <optgroup label="<?php echo get_phrase('medical_labs'); ?>">
                <?php
                $users=$this->crud_model->select_lab_info();
                foreach ($users as $row):
                    ?>
                    <option value="1/<?=$row['unique_id'];?>">
                        <?php echo $row['unique_id'].' - '.$row['name'].' ( '.$row['email'].' )'; ?></option>
                <?php endforeach; ?>
            </optgroup><?php }?>
            <?php if($account_type == 'superadmin'){?>
            <optgroup label="<?php echo get_phrase('myPulse_users'); ?>">
                <?php
                $users = $this->db->select('user_id,name,email,unique_id')->get('users')->result_array();
                foreach ($users as $row):
                    ?>
                    <option value="1/<?=$row['unique_id'];?>">
                        <?php echo $row['unique_id'].' - '.$row['name'].' ( '.$row['email'].' )'; ?></option>
                <?php endforeach; ?>
            </optgroup>
        <?php }elseif($account_type == 'hospitaladmins' || $account_type == 'doctors'){?>
            <optgroup label="<?php echo get_phrase('Patients'); ?>">
                <?php
               $users=$this->crud_model->select_patient_info();
                foreach ($users as $row):
                    $user=$this->db->select('user_id,name,email,unique_id')->where('user_id',$row->user_id)->get('users')->row_array();
                    ?>
                    <option value="1/<?=$user['unique_id'];?>">
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
  <script>
  $( function() {
    $( ".email-check" ).checkboxradio({
      icon: false
    });
  } );
  </script> 
