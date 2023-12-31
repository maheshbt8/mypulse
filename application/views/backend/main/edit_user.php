<style>
    .modal-backdrop.in{
        z-index: auto;
    }
</style>
<?php 
$account_type= $this->session->userdata('login_type');
$single_user_info = $this->db->get_where('users', array('user_id' => $id))->result_array();
foreach ($single_user_info as $row) {  
?>

<div class="row">
    <div class="col-lg-12">
<?php if($row['row_status_cd']=='0'){?>
<div class="alert alert-danger">
  <strong>MyPulse User Deleted</strong>
</div>
<?php }?>
        <!------CONTROL TABS START------>   
        <ul class="nav nav-tabs bordered"> 
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo $this->lang->line('labels')['basic_info'];?> 
                </a>
            </li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>  
                     <?php echo $this->lang->line('labels')['general_info'];?>
                </a>
            </li>
                <li>
                <a href="#pro" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo $this->lang->line('labels')['healthInfo'];?>

                </a>
            </li>
        </ul>
        <div class="panel panel-default">
         <div class="panel-body">
        <!------CONTROL TABS END------>
         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/edit_user/<?php echo $id;?>" method="post" enctype="multipart/form-data">
             
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
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['fname'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="fname" class="form-control" id="fname" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?=$row['name']?>" <?php if(($account_type != 'superadmin' && $account_type != 'users')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                            <span ><?php echo form_error('fname'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['mname'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="mname" class="form-control" id="mname" value="<?=$row['mname']?>"<?php if(($account_type != 'superadmin' && $account_type != 'users')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['lname'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="lname" class="form-control" id="lname" value="<?=$row['lname']?>"<?php if(($account_type != 'superadmin' && $account_type != 'users')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['description'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="description" class="form-control" id="description" value="<?=$row['description']?>"<?php if(($account_type != 'superadmin' && $account_type != 'users')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                        </div>
                    </div>
                   
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['email'];?></label>

                        <div class="col-sm-8">
                            <input type="email" name="email" class="form-control" id="email" value="<?=$row['email']?>" <?php if($row['email_verify']==1 || ($account_type != 'superadmin' && $account_type != 'users')){echo "readonly";}?>>
            <?php if($account_type == 'superadmin' || $account_type == 'hospitaladmins' || $account_type == 'users'){
                if($row['email_verify']==1){?>
                <span class="verifiedsuccess">Email Verified</span>
                <?php }elseif($row['email']!='' && $row['email_verify']==2){?>
                <span class="notverified">Email Not Verified <a href="<?php echo base_url(); ?>main/resend_email_verification/users/user/<?php echo $row['unique_id'] ?>" title="Verification Mail" class="hiper">Re-Send Verification Mail</a></span>
                <?php }}?>
                            <span ><?php echo form_error('email'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['phone_number'];?></label>

                        <div class="col-sm-8">
                            <input type="number" name="mobile" class="form-control" id="mobile"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?=$row['phone']?>" minlength="10" maxlength="10" readonly>
        <?php if($account_type == 'superadmin' || $account_type == 'hospitaladmins' || $account_type == 'users'){
                if($row['mobile_verify']==1){?>
                <span class="verifiedsuccess">Mobile Verified</span>
                <?php }elseif($row['mobile_verify']==2){?>
                <span class="notverified">Mobile Not Verified 
                    <?php if(($row['user_id']==$this->session->userdata('login_user_id')) && ('users'==$account_type)){ ?><a href="" class="hiper"  data-toggle="modal" data-target="#myModal" onclick="return get_otp()">Send OTP</a><?php }?></span>
                <?php }?> <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Enter OTP</h4>
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
                        <label for="field-1" class="col-sm-offset-2 control-label">An OTP has been sent to your mobile <?= $row['phone']?>.<br/> Please submit OTP to continue.</label>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo "OTP";?></label>
                        <div class="col-sm-8">
                            <input type="text" name="otp" class="form-control" id="otp"  data-validate="required" data-message-required="Value Required" value="" autocomplete="off">
                            <input type="hidden" name="user_id" id="user_id" value="<?=$row['user_id'];?>">
                            <!-- <input type="hidden" name="otp_time" id="otp_time" value="<?php echo $this->session->userdata('otp_time')?>"> -->
                            <span id="otp_error"></span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-10 control-label col-sm-offset-2">
                        <input type="button" class="btn btn-success" value="Submit" onClick="opt_submit(this.form);">
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
  </div><?php }?>
                            <span ><?php echo form_error('mobile'); ?></span>  
                        </div>
                    </div>
                 
                 
                 
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label">Status</label>
                        <div class="col-sm-8">
                            <select name="status" class="form-control" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value=""<?php if(($account_type != 'superadmin')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                                <option value=""><?php echo $this->lang->line('labels')['select_status'];?></option>
                                <option value="1"  <?php if($row['row_status_cd']=='1'){echo 'selected';}?>><?php echo get_phrase('active'); ?></option>
                                <option value="2"  <?php if($row['row_status_cd']=='2'){echo 'selected';}?>><?php echo get_phrase('inactive'); ?></option>
                            </select>
                            <?php if($account_type=='users'){ ?><input type="text" hidden="" name="status" value="1"><?php }?>
                            <span ><?php echo form_error('status'); ?></span>
                        </div>
                    </div>
                   
                </div>
                    </div>
                </div>

        </div>

    </div>
</div>
                
              
            </div>
            <!----TABLE LISTING ENDS--->
            
            
            <!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="add" style="padding: 5px">
                    <div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-body">
                
                         
                    <div class="row">
                        <div class="col-sm-6">
                            
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label">Gender</label>

                        <div class="col-sm-8">
                            <select name="gender" class="form-control" id="gender" value=""<?php if(($account_type != 'superadmin' && $account_type != 'users')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                                <option value="">Select Gender</option>
                                 <option value="M" <?php if($row['gender']=='M'){echo 'selected';}?>><?php echo get_phrase('male'); ?></option>
                                <option value="F"  <?php if($row['gender']=='F'){echo 'selected';}?>><?php echo get_phrase('female'); ?></option>
                                <option value="T" <?php if($row['gender']=='T'){echo 'selected';}?>>Other / Transgender</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['dob'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="dob" class="form-control" id="dob" placeholder="<?php echo $this->lang->line('labels')['dob'];?>" onchange="return calculate_age(this.value)" value="<?=$row['dob']?>" autocomplete="off"<?php if(($account_type != 'superadmin' && $account_type != 'users')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                        </div>
                    </div>
                    <div class="form-group" hidden="">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['aadharNumber'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="aadhar" class="form-control" id="aadhar" value="<?=$row['address']?>"<?php if(($account_type != 'superadmin' && $account_type != 'users')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                            <input type="hidden" name="latitude" id="lat" value="">
                            <input type="hidden" name="longitude" id="lng" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['address'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="address" class="form-control" id="address" value="<?=$row['address']?>"<?php if(($account_type != 'superadmin' && $account_type != 'users')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                            <span id="location-get-latlng">
                            <input type="hidden" name="latitude" id="lat" value="<?=$row['latitude']?>">
                            <input type="hidden" name="longitude" id="lng" value="<?=$row['longitude']?>">
                        </span>
                            <input type="button" class="btn btn-info btn-sm" value="Get Current location" onclick="getLocation()" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['profilePic'];?></label>

                        <div class="col-sm-5">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
            <img src="<?=base_url('User-Image/'.$row['user_id']);?>" alt="..." value="">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileinput-new"><?php echo $this->lang->line('labels')['select_image'];?></span>
                                        <span class="fileinput-exists"><?php echo $this->lang->line('labels')['change'];?></span>
                                        <input type="file" name="userfile" accept="image/*" id="userfile" <?php if(($account_type != 'superadmin' && $account_type != 'users')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                                    </span>
                                    <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo $this->lang->line('labels')['remove'];?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
                <div class="col-sm-6">
                    <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('country'); ?></label> 

                        <div class="col-sm-8">
                            <select name="country" class="form-control select2" value=""  onchange="return get_state(this.value)"<?php if(($account_type != 'superadmin' && $account_type != 'users')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                                <option value=""><?php echo get_phrase('select_country'); ?></option>
                                <?php 
                                $admins = $this->crud_model->select_country();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['country_id'] ?>" <?php if($row1['country_id'] == $row['country_id']){echo 'selected';}?>><?php echo $row1['country_name'] ?></option>
                                
                                <?php } ?>
                               
                            </select>
                        </div>
                    </div> 
                    
                    
                       <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('state'); ?></label>
                            <div class="col-sm-8">
                                <select name="state" class="form-control select2" id="state" value=""  onchange="return get_district(this.value)"<?php if(($account_type != 'superadmin' && $account_type != 'users')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                                    <option value=""><?php echo get_phrase('select_state'); ?></option>
                                    <?php 
                                $admins = $this->crud_model->select_state($row['country_id']);
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['state_id'] ?>" <?php if($row1['state_id'] == $row['state_id']){echo 'selected';}?>><?php echo $row1['state_name'] ?></option>
                                
                                <?php } ?>
                                </select>   
                            </div>
                    </div>
                    
                    
                       <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('district'); ?></label>
                            <div class="col-sm-8">
                                <select name="district" class="form-control select2" id="district"  value=""  onchange="return get_city(this.value)"<?php if(($account_type != 'superadmin' && $account_type != 'users')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                                    <option value=""><?php echo get_phrase('select_district'); ?></option>
                                    <?php 
                                $admins = $this->crud_model->select_district($row['state_id']);
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['district_id'] ?>" <?php if($row1['district_id'] == $row['district_id']){echo 'selected';}?>><?php echo $row1['dist_name'] ?></option>
                                
                                <?php } ?>
                                </select>
                            </div>   
                    </div>
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('city'); ?></label>
                            <div class="col-sm-8">
                                <select name="city" class="form-control select2" id="city" value="" <?php if(($account_type != 'superadmin' && $account_type != 'users')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                                    <option value=""><?php echo get_phrase('select_city'); ?></option>
                                    <?php 
                                $admins = $this->crud_model->select_city($row['district_id']);
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['city_id'] ?>" <?php if($row1['city_id'] == $row['city_id']){echo 'selected';}?>><?php echo $row1['city_name'] ?></option>
                                <?php } ?>
                                </select>
                            </div>
                    </div>
                </div>
                    </div>
                   
                            
            </div>
            </div></div></div></div>
            <!----CREATION FORM ENDS-->
    
        
            <div class="tab-pane box" id="pro" style="padding: 5px">
                <div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">
         <div class="panel-body">
                <div class="row">
                        <div class="col-md-6">
                  <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['bloodGroup'];?></label>

                        <div class="col-sm-8">
                            <select name="blood_group" class="form-control select2 notranslate" id="blood_group" value="" <?php if(($account_type != 'superadmin' && $account_type != 'users')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                                <option value="">Select Blood Group</option>
                                    <option class="notranslate" value="A+"<?php if($row['blood_group']=='A+'){echo 'selected';}?>>A+</option>
                                    <option class="notranslate" value="A-"<?php if($row['blood_group']=='A-'){echo 'selected';}?>>A-</option>
                                    <option class="notranslate" value="B+"<?php if($row['blood_group']=='B+'){echo 'selected';}?>>B+</option>
                                    <option class="notranslate" value="B-"<?php if($row['blood_group']=='B-'){echo 'selected';}?>>B-</option>
                                    <option class="notranslate" value="AB+"<?php if($row['blood_group']=='AB+'){echo 'selected';}?>>AB+</option>
                                    <option class="notranslate" value="AB-"<?php if($row['blood_group']=='AB-'){echo 'selected';}?>>AB-</option>
                                    <option class="notranslate" value="O+"<?php if($row['blood_group']=='O+'){echo 'selected';}?>>O+</option>
                                    <option class="notranslate" value="O-"<?php if($row['blood_group']=='O-'){echo 'selected';}?>>O-</option>
                                   
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['age'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="age" class="form-control" id="age" value="<?=$row['age']?>" readonly <?php if(($account_type != 'superadmin' && $account_type != 'users')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['height'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="height" class="form-control" id="height" value="<?=$row['height']?>" <?php if(($account_type != 'superadmin' && $account_type != 'users')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['weight'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="weight" class="form-control" id="weight" value="<?=$row['weight']?>" <?php if(($account_type != 'superadmin' && $account_type != 'users')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['bloodPressure'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="blood_pressure" class="form-control" id="blood_pressure" value="<?=$row['blood_pressure']?>" <?php if(($account_type != 'superadmin' && $account_type != 'users')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['sugarLevel'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="sugar_level" class="form-control" id="sugar_level" value="<?=$row['sugar_level']?>" <?php if(($account_type != 'superadmin' && $account_type != 'users')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['healthInsuranceProvider'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="health_insurance_provider" class="form-control" id="health_insurance_provider" value="<?=$row['health_insurance_provider']?>" <?php if(($account_type != 'superadmin' && $account_type != 'users')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['healthInsuranceId'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="health_insurance_id" class="form-control" id="health_insurance_id" value="<?=$row['health_insurance_id']?>" <?php if(($account_type != 'superadmin' && $account_type != 'users')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['familyHistory'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="family_history" class="form-control" id="family_history" value="<?=$row['family_history']?>" <?php if(($account_type != 'superadmin' && $account_type != 'users')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                        </div>
                    </div>
                   <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['pastMedicalHistory'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="past_medical_history" class="form-control" id="past_medical_history" value="<?=$row['past_medical_history']?>" <?php if(($account_type != 'superadmin' && $account_type != 'users')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                        </div>
                    </div>
                     
                   
                </div>
                    </div>    
                    </div>
                  
                          
            </div>  
            </div></div>
                    </div>
                     <div class="col-sm-3 control-label col-sm-offset-9">
        <?php if(($account_type == 'superadmin' || $account_type == 'users')&&$row['row_status_cd']=='1'){?>
                        <input type="submit" class="btn btn-success" value="Update"><?php }?>&nbsp;&nbsp;
                        <input type="button" class="btn btn-info" value="<?php if(($account_type == 'superadmin' || $account_type == 'users')&&$row['row_status_cd']=='1'){echo get_phrase('cancel');}else{echo get_phrase('close');} ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
                    </div> 
        </div>
        </form>
    </div>
</div>
 </div>
</div>
<?php }?>

<script>
      function get_otp() {
        var phone_number=$('#mobile').val();
     $.ajax({
            type : "POST",
            url: '<?php echo base_url();?>ajax/get_otp/' ,
            data : {phone : phone_number},
            success: function(response)
            {    
            } 
        });
    }
       function opt_submit(form) {
            $.ajax({
            type: 'post',
            url: '<?php echo base_url();?>main/opt_verification/users/user/',
            data: $('form').serialize(),
            success: function (response) {
                if(response == 1){
                window.location.reload();
                }else{
                jQuery('#otp_error').html(response);
                }
            }
          });  
}
   </script>


