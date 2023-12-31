<style>
    .modal-backdrop.in{
        z-index: auto;
    }
</style>
<?php 
$account_type= $this->session->userdata('login_type');
$single_labs_info = $this->db->get_where('medicallabs', array('lab_id' => $id))->result_array();
foreach ($single_labs_info as $row) {
    if($this->session->userdata('hospital_id')==$row['hospital_id'] || $account_type=='superadmin' || $account_type=='users' || $account_type=='medicallabs'){
?>
<div class="row">
    <div class="col-md-12">
        <?php if($row['row_status_cd']=='0'){?>
<div class="alert alert-danger">
  <strong>Medical Lab Deleted</strong>
</div>
<?php }?>
        <!------CONTROL TABS START------>   
        <ul class="nav nav-tabs bordered"> 
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('basic_info'); ?> 
                </a>
            </li>  
            <?php if($account_type!='users'){ ?>    
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>  
                    <?php echo get_phrase('incharge_info'); ?>
                </a>
            </li><?php }?>
                <li>
                <a href="#pro" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('profession_info'); ?> 
                </a>
            </li>
        </ul>
        <!------CONTROL TABS END------>
         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/edit_labs/<?php echo $id ?>" method="post" enctype="multipart/form-data">
           <div class="panel panel-default">   
            <div class="panel-body">  
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
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase(' name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" id="name" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?=$row['name']?>"<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins' && $account_type != 'medicallabs')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                            <span ><?php echo form_error('name'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="description" class="form-control" id="description"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?=$row['description']?>"<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins' && $account_type != 'medicallabs')||$row['row_status_cd']=='0'){echo "disabled";}?>><span ><?php echo form_error('description'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('address'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="address" class="form-control" id="address"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?=$row['address']?>"<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins' && $account_type != 'medicallabs')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                            <span ><?php echo form_error('address'); ?></span>
                        </div>
                    </div>
                       <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Phone_number'); ?></label>

                        <div class="col-sm-8">
                            <input type="number" name="phone_number" class="form-control" id="phone_number"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?=$row['phone']?>"  minlength="10" maxlength="10" readonly>
                <?php if($account_type == 'superadmin' || $account_type == 'hospitaladmins' || $account_type == 'medicallabs'){
                if($row['is_mobile']==1){?>
                <span class="verifiedsuccess">Mobile Verified</span>
                <?php }elseif($row['is_mobile']==2){?>
                <span class="notverified">Mobile Not Verified <?php if(($row['lab_id']==$this->session->userdata('login_user_id')) && ('medicallabs'==$account_type)){ ?><a href="" class="hiper"  data-toggle="modal" data-target="#myModal" onclick="return get_otp()">Send OTP</a><?php }?></span>
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
                            <input type="hidden" name="user_id" id="user_id" value="<?=$row['lab_id'];?>">
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
  </div> 
        <?php }?>
         <span ><?php echo form_error('phone_number'); ?></span> 
                        </div>
                    </div>
                <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label "><?php echo ucfirst('status');?></label>
                        
                        <div class="col-sm-8">
                             
                         <select name="status" class="form-control selectbox" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value=""<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins')|| $row['row_status_cd']=='0'){echo "disabled";}?>>
                               <option value=""><?php echo get_phrase('select_status'); ?></option>
                                 <option value="1"  <?php if($row['row_status_cd']=='1'){echo 'selected';}?>><?php echo get_phrase('active'); ?></option>
                                <option value="2"  <?php if($row['row_status_cd']=='2'){echo 'selected';}?>><?php echo get_phrase('inactive'); ?></option>
                            </select>
                            <span ><?php echo form_error('status'); ?></span>
                        </div> 
                    </div>
                   
                </div>
                <div class="col-sm-6">
            <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('owner/md name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="owner_name" class="form-control" id="owner_name"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?=$row['owner_name']?>"<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins' && $account_type != 'medicallabs')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                            <span ><?php echo form_error('owner_name'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('owner/md mobile number'); ?></label>

                        <div class="col-sm-8">
                            <input type="number" name="owner_mobile" class="form-control" id="owner_mobile"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?=$row['owner_mobile']?>"  minlength="10" maxlength="10"<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins' && $account_type != 'medicallabs')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                            <span ><?php echo form_error('owner_mobile'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email'); ?></label>

                        <div class="col-sm-8">
                            <input type="email" name="email" class="form-control" id="email"  data-validate="required" data-message-required="<?php echo 'Value_required';?>"value="<?=$row['email']?>" <?php if($row['email_verify']==1 || ($account_type != 'superadmin' && $account_type != 'hospitaladmins' && $account_type != 'medicallabs')){echo 'readonly';}?>>
                <?php if($account_type == 'superadmin' || $account_type == 'hospitaladmins' || $account_type == 'medicallabs'){
                if($row['is_email']==1){?>
                <span class="verifiedsuccess">Email Verified</span>
                <?php }elseif($row['is_email']==2){?>
                <span class="notverified">Email Not Verified <a href="<?php echo base_url(); ?>main/resend_email_verification/medicallabs/lab/<?php echo $row['unique_id'] ?>" title="Verification Mail" class="hiper">Re-Send Verification Mail</a></span>
                <?php }}?>
                            <span ><?php echo form_error('email'); ?></span>
                        </div>
                    </div>
            <?php if($account_type=='superadmin' || $account_type=='users'){?>
            <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label "><?php echo ucfirst('hospital');?></label>
                        
                        <div class="col-sm-8">
                            <select name="hospital" class="form-control select2" onchange="return get_branch(this.value)"<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins' && $account_type != 'medicallabs')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                              <option value=""><?php echo ucfirst('select_hospital');?></option>
                              <?php 
                                $admins = $this->crud_model->select_all_hospitals();
                               
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['hospital_id'] ?>"<?php if($row1['hospital_id']==$row['hospital_id']){echo 'selected';}?> ><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
                          
                          </select>
                          <span ><?php echo form_error('hospital'); ?></span>
                        </div> 
                    </div>
                    <?php }elseif($account_type=='hospitaladmins'){?>
                <input type="hidden" name="hospital" value="<?php echo $row['hospital'];?>"/>
                <?php }?>
                        <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label "><?php echo ucfirst('branch');?></label>
                        
                        <div class="col-sm-8">
                            <select name="branch" class="form-control select2" id="branch"<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                            <?php 
                                $admins =  $this->crud_model->select_branch_info_by_hospital_id($row['hospital_id']);
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['branch_id'] ?>" <?php if($row1['branch_id']==$row['branch_id']){echo 'selected';}?>><?php echo $row1['branch_name'] ?></option>
                                
                                <?php }?>
                          </select>
                          <span ><?php echo form_error('branch'); ?></span>
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
   <?php if($account_type=='medicallabs'){?>
<input type="hidden" name="hospital" value="<?php echo $row['hospital_id'];?>"/>
<input type="hidden" name="branch" value="<?php echo $row['branch_id'];?>"/>
<input type="hidden" name="status" value="<?php echo $row['row_status_cd'];?>"/>
<?php }?>           
            
            <!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="add" style="padding: 5px">
                    <div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">
          <div class="panel-body">
                
                         
                    <div class="row">
                        <div class="col-sm-6">
                
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('first name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="fname" class="form-control" id="fname" value="<?=$row['fname']?>"<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Last name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="lname" class="form-control" id="lname" value="<?=$row['lname']?>"<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                        </div>
                    </div>
                    
                    <div class="form-group" hidden="">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('aadhar'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="aadhar" class="form-control" id="aadhar" value="<?=$row['aadhar']?>"<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                        </div>
                    </div>
                    
                        <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label "><?php echo ucfirst('gender');?></label>
                        
                        <div class="col-sm-8">
                            <select name="gender" class="form-control selectbox" id="gender"<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                              <option value="">Select Gender</option>
                              <option value="M" <?php if($row['gender']=='M'){echo 'selected';}?>><?php echo get_phrase('male'); ?></option>
                                <option value="F"  <?php if($row['gender']=='F'){echo 'selected';}?>><?php echo get_phrase('female'); ?></option>
                                <option value="T"<?php if($row['gender']=='T'){echo "selected";}?>>Other / Transgender</option>
                          </select>
                        </div> 
                    </div>
                      
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo 'Photo';?></label>

                        <div class="col-sm-5">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                    <img src="<?=base_url('Medical-Lab-Image/'.$row['lab_id']);?>" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="userfile" accept="image/*" id="userfile"<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                                    </span>
                                    <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Date of birth'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="dob" class="form-control" autocomplete="off" id="dob" value="<?=$row['dob']?>"<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Incharge address'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="in_address" class="form-control" id="in_address" value="<?=$row['in_address']?>"<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins')||$row['row_status_cd']=='0'){echo "disabled";}?>>
                        </div>
                    </div>
                   <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('country'); ?></label> 

                        <div class="col-sm-8">
                            <select name="country" class="form-control select2"  value=""  onchange="return get_state(this.value)"<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins')||$row['row_status_cd']=='0'){echo "disabled";}?>>
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
                                <select name="state" class="form-control select2" id="state" value=""  onchange="return get_district(this.value)"<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins')||$row['row_status_cd']=='0'){echo "disabled";}?>>
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
                                <select name="district" class="form-control select2" id="district"  value=""  onchange="return get_city(this.value)"<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins')||$row['row_status_cd']=='0'){echo "disabled";}?>>
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
                                <select name="city" class="form-control select2" id="city" value="" <?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins')||$row['row_status_cd']=='0'){echo "disabled";}?>>
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
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('qualification'); ?></label>

                        <div class="col-sm-8">
    <input type="text" name="qualification" class="form-control" id="qualification" value="<?=$row['qualification']?>"<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins') || $row['row_status_cd']=='0'){echo "disabled";}?>>
                        </div>
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('experience'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="experience" class="form-control" id="experience" value="<?=$row['experience']?>"<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins')||$row['row_status_cd']=='0'){echo "disabled";}?>>
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
            <?php if(($account_type == 'superadmin' || $account_type == 'hospitaladmins' || $account_type == 'medicallabs')&& $row['row_status_cd']!='0'){?>
        <input type="submit" class="btn btn-success" value="Update"><?php }?>&nbsp;&nbsp;
                        <input type="button" class="btn btn-info" value="<?php if(($account_type == 'superadmin' || $account_type == 'hospitaladmins' || $account_type == 'medicallabs')&& $row['row_status_cd']!='0'){echo get_phrase('cancel');}else{echo get_phrase('close');} ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
                    </div>
                    </div>
                    </div>   
 </form>
</div>

</div>
</div>
<?php }else{
    $this->load->view('four_zero_four');
}?>
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
            url: '<?php echo base_url();?>main/opt_verification/medicallabs/lab/',
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
