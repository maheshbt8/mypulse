<style>
    .modal-backdrop.in{
        z-index: auto;
    }
</style>
<?php
$account_type= $this->session->userdata('login_type'); 
$single_store_info = $this->db->get_where('medicalstores', array('store_id' => $id))->result_array();
foreach ($single_store_info as $row) {
    
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
					<?php echo get_phrase('incharge_info'); ?>
                </a>
			</li>
				<li>
            	<a href="#pro" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('profession_info'); ?> 
                </a>
			</li>
		</ul>
    	<!------CONTROL TABS END------>
         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/edit_stores/<?php echo $id ?>" method="post" enctype="multipart/form-data">
             
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
                            <input type="text" name="name" class="form-control" id="name" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?=$row['name']?>">
                            <span ><?php echo form_error('name'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="description" class="form-control" id="description"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?=$row['description']?>"><span ><?php echo form_error('description'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('address'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="address" class="form-control" id="address"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?=$row['address']?>">
                            <span ><?php echo form_error('address'); ?></span>
                        </div>
                    </div>
              
                       <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Phone_number'); ?></label>

                        <div class="col-sm-8">
                            <input type="number" name="phone_number" class="form-control" id="phone_number"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?=$row['phone']?>"  minlength="10" maxlength="10" readonly> 
<?php if($account_type == 'superadmin' || $account_type == 'hospitaladmins' || $account_type == 'medicalstores'){
                if($row['is_mobile']==1){?>
                <span class="verifiedsuccess">Mobile Verified</span>
                <?php }elseif($row['is_mobile']==2){?>
                <span class="notverified">Mobile Not Verified <a href="" class="hiper"  data-toggle="modal" data-target="#myModal" onclick="return get_otp()">Send OTP</a></span>
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
                        <label for="field-1" class="control-label">An OTP has been sent to your mobile <?= $row['phone']?>.<br/> Please submit OTP to continue.</label>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo "OTP";?></label>
                        <div class="col-sm-8">
                            <input type="text" name="otp" class="form-control" id="otp"  data-validate="required" data-message-required="Value Required" value="<?php echo set_value('otp'); ?>" autocomplete="off">
                            <input type="hidden" name="user_id" id="user_id" value="<?=$row['store_id'];?>">
                            <input type="hidden" name="otp_time" id="otp_time" value="<?php echo $this->session->userdata('otp_time')?>">
                            <span id="otp_error"></span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 control-label col-sm-offset-2">
                        <input type="button" class="btn btn-success" value="Submit" onClick="opt_submit(this.form);">
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
  </div>  <?php }?>
                            <span ><?php echo form_error('phone_number'); ?></span> 
                        </div>
                    </div>
           
					
						<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label "><?php echo ucfirst('status');?></label>
                        
						<div class="col-sm-8">
						     
						 <select name="status" class="form-control selectbox" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                               <option value=""><?php echo get_phrase('select_status'); ?></option>
                                 <option value="1"  <?php if($row['status']=='1'){echo 'selected';}?>><?php echo get_phrase('active'); ?></option>
                                <option value="2"  <?php if($row['status']=='2'){echo 'selected';}?>><?php echo get_phrase('inactive'); ?></option>
                            </select>
                            <span ><?php echo form_error('status'); ?></span>
						</div> 
					</div>
                   
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('owner/md name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="owner_name" class="form-control" id="owner_name"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?=$row['owner_name']?>">
                            <span ><?php echo form_error('owner_name'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('owner/md mobile number'); ?></label>

                        <div class="col-sm-8">
                            <input type="number" name="owner_mobile" class="form-control" id="owner_mobile"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?=$row['owner_mobile']?>"  minlength="10" maxlength="10">
                            <span ><?php echo form_error('owner_mobile'); ?></span>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email'); ?></label>

                        <div class="col-sm-8">
                            <input type="email" name="email" class="form-control" id="email"  data-validate="required" data-message-required="<?php echo 'Value_required';?>"value="<?=$row['email']?>" readonly>
                <?php if($account_type == 'superadmin' || $account_type == 'hospitaladmins' || $account_type == 'medicalstores'){
                if($row['is_email']==1){?>
                <span class="verifiedsuccess">Email Verified</span>
                <?php }elseif($row['is_email']==2){?>
                <span class="notverified">Email Not Verified <a href="<?php echo base_url(); ?>main/resend_email_verification/medicalstores/store/<?php echo $row['unique_id'] ?>" title="Verification Mail" class="hiper">Re-Send Verification Mail</a></span>
                <?php }}?>
                            <span ><?php echo form_error('email'); ?></span>
                        </div>
                    </div>
                 
            <?php if($account_type=='superadmin'){?>
            <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label "><?php echo ucfirst('hospital');?></label>
                        
                        <div class="col-sm-8">
                            <select name="hospital" class="form-control selectbox"  onchange="return get_branch(this.value)">
                              <?php 
                                $admins = $this->db->get_where('hospitals',array('status'=>1))->result_array();
                               
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['hospital_id'] ?>"<?php if($row1['hospital_id']==$row['hospital']){echo 'selected';}?> ><?php echo $row1['name'] ?></option>
                                
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
                            <select name="branch" class="form-control selectbox" id="branch">
                             <?php 
                                $admins = $this->db->where('hospital_id',$row['hospital'])->get('branch')->result_array();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['branch_id'] ?>" <?php if($row1['branch_id']==$row['branch']){echo 'selected';}?>><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
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
                            <input type="text" name="fname" class="form-control" id="fname" value="<?=$row['fname']?>">
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Last name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="lname" class="form-control" id="lname" value="<?=$row['lname']?>">
                        </div>
                    </div>
                    
                    <div class="form-group" hidden="">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('aadhar'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="aadhar" class="form-control" id="aadhar" value="<?=$row['aadhar']?>">
                        </div>
                    </div>
                    
                     	<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label "><?php echo ucfirst('gender');?></label>
                        
						<div class="col-sm-8">
							<select name="gender" class="form-control selectbox" id="gender">
                              <option value=""><?php echo ucfirst('select_gender');?></option>
                              <option value="male" <?php if($row['gender']=='male'){echo 'selected';}?>><?php echo get_phrase('male'); ?></option>
                                <option value="female"  <?php if($row['gender']=='female'){echo 'selected';}?>><?php echo get_phrase('female'); ?></option>  
                          </select>
						</div> 
					</div>
                     
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo 'Photo';?></label>

                        <div class="col-sm-5">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                    <img src="<?php echo base_url(); ?>uploads/medical_stores/<?php echo $row['store_id']; ?>.jpg" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="userfile" accept="image/*" id="userfile">
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
                            <input type="text" name="dob" class="form-control" id="dob" value="<?=$row['dob']?>" autocomplete="off">
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Incharge address'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="in_address" class="form-control" id="in_address" value="<?=$row['in_address']?>">
                        </div>
                    </div>
                    <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('country'); ?></label> 

                        <div class="col-sm-8">
                            <select name="country" class="form-control" id="country" value=""  onchange="return get_state(this.value)">
                                <option value=""><?php echo get_phrase('select_country'); ?></option>
                                <?php 
                                $admins = $this->db->get_where('country')->result_array();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['country_id'] ?>" <?php if($row1['country_id'] == $row['country']){echo 'selected';}?>><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
                               
                            </select>
                        </div>
                    </div> 
                    
                    
                       <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('state'); ?></label>
                            <div class="col-sm-8">
                                <select name="state" class="form-control" id="select_state" value=""  onchange="return get_district(this.value)">
                                    <option value=""><?php echo get_phrase('select_country_first'); ?></option>
                                    <?php 
                                $admins = $this->db->get_where('state',array('country_id'=>$row['country']))->result_array();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['state_id'] ?>" <?php if($row1['state_id'] == $row['state']){echo 'selected';}?>><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
                                </select>   
                            </div>
                    </div>
                    
                    
                       <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('district'); ?></label>
                            <div class="col-sm-8">
                                <select name="district" class="form-control" id="select_district"  value=""  onchange="return get_city(this.value)">
                                    <option value=""><?php echo get_phrase('select_state_first'); ?></option>
                                    <?php 
                                $state = $this->db->get_where('district',array('state_id'=>$row['state']))->result_array();
                                foreach($state as $row1){?>
                                <option value="<?php echo $row1['district_id'] ?>" <?php if($row1['district_id'] == $row['district']){echo 'selected';}?>><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
                                </select>
                            </div>   
                    </div>
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('city'); ?></label>
                            <div class="col-sm-8">
                                <select name="city" class="form-control" id="select_city" value=""  >
                                    <option value=""><?php echo get_phrase('select_district_first'); ?></option>
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
                            <input type="text" name="qualification" class="form-control" id="qualification" value="<?=$row['qualification']?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('experience'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="experience" class="form-control" id="experience" value="<?=$row['experience']?>">
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
<?php if($account_type == 'superadmin' || $account_type == 'hospitaladmins' || $account_type == 'medicalstores'){?>
                        <input type="submit" class="btn btn-success" value="Update"><?php }?>&nbsp;&nbsp;
                        <input type="button" class="btn btn-info" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
                    </div>   
 </form>
</div>

</div>
</div>
<?php }?>

                    
<script type="text/javascript">
 function get_branch(hospital_id) {    
        $.ajax({
            url: '<?php echo base_url();?>ajax/get_branch/' + hospital_id ,
            success: function(response)
            {
                jQuery('#branch').html(response);
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
                alert(response);      
            } 
        });
    }
       function opt_submit(form) {
            $.ajax({
            type: 'post',
            url: '<?php echo base_url();?>main/opt_verification/medicalstores/store/',
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