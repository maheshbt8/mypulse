<style>
    .modal-backdrop.in{
        z-index: auto;
    }
</style>
<?php 
$account_type= $this->session->userdata('login_type');
$single_doctor_info = $this->db->get_where('doctors', array('doctor_id' => $doctor_id))->result_array();
foreach ($single_doctor_info as $row) {
    if($this->session->userdata('hospital_id')==$row['hospital_id'] || $account_type=='superadmin'){
?>
 
<div class="row">
    <div class="col-md-12">
        <!------CONTROL TABS START------>   
        <ul class="nav nav-tabs bordered"> 
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                     <?php echo get_phrase('basic_info'); ?> 
                </a>
            </li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>  
                     <?php echo get_phrase('general_info'); ?>
                </a>
            </li>
                <li>
                <a href="#pro" data-toggle="tab"><i class="entypo-plus-circled"></i>
                     <?php echo get_phrase('profession_info'); ?>
                </a>
            </li>
        </ul>
        <!------CONTROL TABS END------>
         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/edit_doctor/<?php echo $row['doctor_id']; ?>" method="post" enctype="multipart/form-data">
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
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('first_name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="fname" class="form-control" id="fname" value="<?=$row['name']?>" <?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins' && $account_type != 'doctors')||$row['isDeleted']=='2'||$row['isDeleted']=='2'){echo "disabled";}?>>
                            <span ><?php echo form_error('fname'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('middle_name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="mname" class="form-control" id="mname" value="<?=$row['mname']?>"<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins' && $account_type != 'doctors')||$row['isDeleted']=='2'){echo "disabled";}?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('last_name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="lname" class="form-control" id="lname" value="<?=$row['lname']?>"<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins' && $account_type != 'doctors')||$row['isDeleted']=='2'){echo "disabled";}?>>
                            <span ><?php echo form_error('lname'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="description" class="form-control" id="description" value="<?=$row['description']?>"<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins' && $account_type != 'doctors')||$row['isDeleted']=='2'){echo "disabled";}?>>
                            <span ><?php echo form_error('description'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email'); ?></label>

                        <div class="col-sm-8">
                            <input type="email" name="email" class="form-control" id="email" value="<?=$row['email']?>" readonly>
                <?php if($account_type == 'superadmin' || $account_type == 'hospitaladmins' || $account_type == 'doctors'){
                if($row['is_email']==1){?>
                <span class="verifiedsuccess">Email Verified</span>
                <?php }elseif($row['is_email']==2){?>
                <span class="notverified">Email Not Verified <a href="<?php echo base_url(); ?>main/resend_email_verification/doctors/doctor/<?php echo $row['unique_id'] ?>" title="Verification Mail" class="hiper">Re-Send Verification Mail</a></span>
                <?php }}?>
                            <span ><?php echo form_error('email'); ?></span>
                        </div>
                    </div>  
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('phone_number'); ?></label>

                        <div class="col-sm-8">
                            <input type="number" name="mobile" class="form-control" id="mobile" value="<?=$row['phone']?>" minlength="10" maxlength="10"readonly>
                <?php if($account_type == 'superadmin' || $account_type == 'hospitaladmins' || $account_type == 'doctors'){ 
                if($row['is_mobile']==1){?>
                <span class="verifiedsuccess">Mobile Verified</span>
                <?php }elseif($row['is_mobile']==2){?>
                <span class="notverified">Mobile Not Verified <?php if(($row['doctor_id']==$this->session->userdata('login_user_id')) && ('doctors'==$account_type)){ ?><a href="" class="hiper"  data-toggle="modal" data-target="#myModal" onclick="return get_otp()">Send OTP</a><?php }?></span>
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
                            <input type="hidden" name="user_id" id="user_id" value="<?=$row['doctor_id'];?>">
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
                            <span ><?php echo form_error('mobile'); ?></span>
                        </div>
                    </div>
                 <?php if($account_type=='superadmin' || $account_type=='users'){?>
                  <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('hospital'); ?></label> 

                        <div class="col-sm-8">
                            <select name="hospital" class="form-control select2" id="hospital" value=""  onchange="return get_branch(this.value)" <?php if($account_type=='users' || $row['isDeleted']=='2'){echo 'disabled';}?>>
                                <option value=""><?php echo get_phrase('select_hospital'); ?></option>
                                <?php 
                                $admins = $this->db->get_where('hospitals',array('status'=>1))->result_array();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['hospital_id'] ?>" <?php if($row1['hospital_id']==$row['hospital_id']){echo 'selected';}?>><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
                               
                            </select>
                             <span ><?php echo form_error('hospital'); ?></span>
                        </div>
                    </div>
                    <?php }elseif($account_type=='hospitaladmins'){?>
                <input type="hidden" name="hospital" value="<?php echo $row['hospital_id'];?>"/>
                <?php }?>
                  <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('branch'); ?></label>
                            <div class="col-sm-8">
                                <select name="branch" class="form-control select2" id="select_branch" value=""  onchange="return get_department(this.value)"<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins')||$row['isDeleted']=='2'){echo "disabled";}?>>
                                    <option value=""><?php echo get_phrase('select_branch'); ?></option>
                                    <?php 
                                $admins = $this->db->where('hospital_id',$row['hospital_id'])->get('branch')->result_array();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['branch_id'] ?>" <?php if($row1['branch_id']==$row['branch_id']){echo 'selected';}?>><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
                                </select>
                                 <span ><?php echo form_error('branch'); ?></span>
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('department'); ?></label>
                            <div class="col-sm-8">
                                <select name="department" class="form-control select2" id="select_department" value=""<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins')||$row['isDeleted']=='2'){echo "disabled";}?>>
                                    <option value=""><?php echo get_phrase('select_department'); ?></option>
                                     <?php 
                                $admins = $this->db->where('branch_id',$row['branch_id'])->get('department')->result_array();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['department_id'] ?>" <?php if($row1['department_id']==$row['department_id']){echo 'selected';}?>><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
                                </select>
                                 <span ><?php echo form_error('department'); ?></span>
                            </div>
                    </div>
                 
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('status'); ?></label>

                        <div class="col-sm-8">
                            <select name="status" class="form-control" id="status" value=""<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins')||$row['isDeleted']=='2'){echo "disabled";}?>>
                                <option value=""><?php echo get_phrase('select_status'); ?></option>
                                <option value="1"  <?php if($row['status']=='1'){echo 'selected';}?>><?php echo get_phrase('active'); ?></option>
                                <option value="2"  <?php if($row['status']=='2'){echo 'selected';}?>><?php echo get_phrase('inactive'); ?></option>
                            </select>
                             <span ><?php echo form_error('status'); ?></span>
                        </div>
                    </div>
<?php if($account_type=='doctors'){?>
<input type="hidden" name="hospital" value="<?php echo $row['hospital_id'];?>"/>
<input type="hidden" name="branch" value="<?php echo $row['branch_id'];?>"/>
<input type="hidden" name="department" value="<?php echo $row['department_id'];?>"/>
<input type="hidden" name="status" value="<?php echo $row['status'];?>"/>
<?php }?>
                   
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
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['gender'];?></label>

                        <div class="col-sm-8">
                            <select name="gender" class="form-control" id="gender" value=""<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins' && $account_type != 'doctors')||$row['isDeleted']=='2'){echo "disabled";}?>>
                                <option value=""><?php echo get_phrase('select_gender'); ?></option>
                                <option value="male" <?php if($row['gender']=='male'){echo 'selected';}?>><?php echo get_phrase('male'); ?></option>
                                <option value="female"  <?php if($row['gender']=='female'){echo 'selected';}?>><?php echo get_phrase('female'); ?></option>
                                <option value="others"<?php if($row['gender']=='others'){echo "selected";}?>>Other / Transgender</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('date_of_birth'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="dob" class="form-control" id="dob" placeholder="<?php echo get_phrase('date_of_birth'); ?>" autocomplete="off" value="<?php echo $row['dob']; ?>"<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins' && $account_type != 'doctors')||$row['isDeleted']=='2'){echo "disabled";}?>>
                        </div>
                    </div>
                    <div class="form-group" hidden="">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('aadhar_number'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="aadhar" class="form-control" id="aadhar" value="<?php echo $row['aadhar']; ?>"<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins' && $account_type != 'doctors')||$row['isDeleted']=='2'){echo "disabled";}?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('address'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="address" class="form-control" id="address" value="<?php echo $row['address']; ?>"<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins' && $account_type != 'doctors')||$row['isDeleted']=='2'){echo "disabled";}?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('profile_picture'); ?></label>

                        <div class="col-sm-5">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                    <img src="data:image/gif;base64,<?=$this->crud_model->get_image_url('doctor_image',$row['doctor_id']);?>" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileinput-new"><?php echo get_phrase('select_profile'); ?></span>
                                        <span class="fileinput-exists"><?php echo get_phrase('change'); ?></span>
                                        <input type="file" name="userfile" id="userfile" accept="image/*"<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins' && $account_type != 'doctors')||$row['isDeleted']=='2'){echo "disabled";}?>>
                                    </span>
                                    <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('remove'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>

                   
                </div>
                <div class="col-sm-6">
                    
                   <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('country'); ?></label> 

                        <div class="col-sm-8">
                            <select name="country" class="form-control select2" id="country" value=""  onchange="return get_state(this.value)"<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins' && $account_type != 'doctors')||$row['isDeleted']=='2'){echo "disabled";}?>>
                                <option value=""><?php echo get_phrase('select_country'); ?></option>
                                <?php 
                                $country = $this->db->get_where('country')->result_array();
                                foreach($country as $row1){?>
                                <option value="<?php echo $row1['country_id'] ?>" <?php if($row1['country_id'] == $row['country']){echo 'selected';}?>><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
                               
                            </select>
                        </div>
                    </div> 
                    
                    
                       <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('state'); ?></label>
                            <div class="col-sm-8">
                                <select name="state" class="form-control select2" id="select_state" value=""  onchange="return get_district(this.value)"<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins' && $account_type != 'doctors')||$row['isDeleted']=='2'){echo "disabled";}?>>
                                    <option value=""><?php echo get_phrase('select_state'); ?></option>
                                    <?php 
                                $state = $this->db->get_where('state',array('country_id'=>$row['country']))->result_array();
                                foreach($state as $row2){?>
                                <option value="<?php echo $row2['state_id'] ?>" <?php if($row2['state_id'] == $row['state']){echo 'selected';}?>><?php echo $row2['name'] ?></option>
                                
                                <?php } ?>
                                </select>   
                            </div>
                    </div>
                    
                    
                       <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('district'); ?></label>
                            <div class="col-sm-8">
                                <select name="district" class="form-control select2" id="select_district"  value=""  onchange="return get_city(this.value)"<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins' && $account_type != 'doctors')||$row['isDeleted']=='2'){echo "disabled";}?>>
                                    <option value=""><?php echo get_phrase('select_district'); ?></option>
                                    <?php 
                                $district = $this->db->get_where('district',array('state_id'=>$row['state']))->result_array();
                                foreach($district as $row3){?>
                                <option value="<?php echo $row3['district_id'] ?>" <?php if($row3['district_id'] == $row['district']){echo 'selected';}?>><?php echo $row3['name'] ?></option>
                                
                                <?php } ?>
                                </select>
                            </div>   
                    </div>
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('city'); ?></label>
                            <div class="col-sm-8">
                                <select name="city" class="form-control select2" id="select_city" value="" <?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins' && $account_type != 'doctors')||$row['isDeleted']=='2'){echo "disabled";}?>>
                                    <option value=""><?php echo get_phrase('select_city'); ?></option>
                                    <?php 
                                $admins = $this->db->get_where('city',array('district_id'=>$row['district']))->result_array();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['city_id'] ?>" <?php if($row1['city_id'] == $row['city']){echo 'selected';}?>><?php echo $row1['name'] ?></option>
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
                            <input type="text" name="qualification" class="form-control" id="qualification" value="<?php echo $row['qualification']; ?>" <?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins' && $account_type != 'doctors')||$row['isDeleted']=='2'){echo "disabled";}?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('experience'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="experience" class="form-control" id="experience" value="<?php echo $row['experience']; ?>" <?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins' && $account_type != 'doctors')||$row['isDeleted']=='2'){echo "disabled";}?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('registration_number'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="registration" class="form-control" id="registration" value="<?php echo $row['registration']; ?>"<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins' && $account_type != 'doctors')||$row['isDeleted']=='2'){echo "disabled";}?>>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('specializations'); ?></label>
                            <div class="col-sm-8">
                                <select multiple name="specializations[]" class="form-control  select2" id="select_doctor" value="<?php echo set_value('specializations[]'); ?>"<?php if(($account_type != 'superadmin' && $account_type != 'hospitaladmins' && $account_type != 'doctors')||$row['isDeleted']=='2'){echo "disabled";}?>>
                                      <?php 
                                    $admins = $this->db->get('specializations')->result_array();
                                foreach($admins as $row1){
                                    $doc=explode(',',$row['specializations']);
                                    ?>
                                <option value="<?php echo $row1['specializations_id'] ?>" <?php for($i=0;$i<count($doc);$i++){if($doc[$i] == $row1['specializations_id']){echo 'selected';}}?>><?php echo $row1['name']; ?></option>
                                
                                <?php } ?>
                                </select>
                                <span ><?php echo form_error('doctor'); ?></span>
                            </div>
                    </div>
                    
                </div>
                    </div>    
                    </div>
                  
                     </div></div></div>
                
                    </div>
                     <div class="col-sm-3 control-label col-sm-offset-9">
                        <?php if(($account_type == 'superadmin' || $account_type == 'hospitaladmins' || $account_type == 'doctors')&&$row['isDeleted']=='1'){?>
                        <input type="submit" class="btn btn-success" value="<?php echo get_phrase('update'); ?>">
                    <?php }?>
                        &nbsp;&nbsp;
                        <input type="button" class="btn btn-info" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
                    </div> 
                    </div>
                    </div> 
                    </div>
   </form>
            
           
            <!----CREATION FORM ENDS-->
        </div>
    </div>





  <?php }else{
    $this->load->view('four_zero_four');
}?>

<?php } ?>

<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      

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

</script>


<script type="text/javascript">

	
	function get_state(country_id) {
    
    	$.ajax({
            url: '<?php echo base_url();?>ajax/get_state/' + country_id ,
            success: function(response)
            {
                jQuery('#select_state').html(response);
            } 
        });

    }
    
    function get_city(state_id) {

    	$.ajax({
            url: '<?php echo base_url();?>ajax/get_city/' + state_id ,
            success: function(response)
            {
                jQuery('#select_city').html(response);
            }
        });   

    }
    
     function get_district(city_id) {

    	$.ajax({
            url: '<?php echo base_url();?>ajax/get_district/' + city_id ,
            success: function(response)
            {
                jQuery('#select_district').html(response);
            }
        });

    }
</script>
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
            url: '<?php echo base_url();?>main/opt_verification/doctors/doctor/',
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

 