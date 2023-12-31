
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
        <div class="panel panel-default">   
            <div class="panel-body">
    	<!------CONTROL TABS END------>
         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/add_receptionist/" method="post" enctype="multipart/form-data">
             
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
                            <input type="text" name="fname" class="form-control" id="fname" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo set_value('fname'); ?>">
                            <span ><?php echo form_error('fname'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('middle_name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="mname" class="form-control" id="mname" value="<?php echo set_value('mname'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('last_name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="lname" class="form-control" id="lname" value="<?php echo set_value('lname'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="description" class="form-control" id="description" value="<?php echo set_value('description'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email'); ?></label>

                        <div class="col-sm-8">
                            <input type="email" name="email" class="form-control" id="email"  data-validate="required" data-message-required="Value Required" value="<?php echo set_value('email'); ?>">
                            <span ><?php echo form_error('email'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('phone_number'); ?></label>

                        <div class="col-sm-8">
                            <input type="number" name="mobile" class="form-control" id="mobile"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('mobile'); ?>"   minlength="10" maxlength="10">  
                            <span ><?php echo form_error('mobile'); ?></span>
                        </div>
                    </div>
                 
                   
                </div>
                <div class="col-sm-6">
                    <?php if($account_type=='superadmin'){?>
                  <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('hospital'); ?></label> 

                        <div class="col-sm-8">
                            <select name="hospital" class="form-control select2" id="hospital" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('hospital'); ?>"  onchange="return get_branch(this.value)">
                                <option value=""><?php echo get_phrase('select_hospital'); ?></option>
                            </select>
                            <span ><?php echo form_error('hospital'); ?></span>
                        </div>
                    </div>
                    <?php }elseif($account_type=='hospitaladmins'){?>
                <input type="hidden" name="hospital" value="<?php echo $this->session->userdata('hospital_id');?>"/>
                <?php }?>
                  <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('branch'); ?></label>
                            <div class="col-sm-8">
                                <select name="branch" class="form-control select2" id="branch"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('branch'); ?>"  onchange="return get_department_all(this.value)">
                                      
                                 <?php if($account_type=='superadmin'){?>
                    <option value=""><?php echo get_phrase('select_branch'); ?></option>
                    <?php }elseif($account_type=='hospitaladmins'){?>
                    <option value=""><?php echo get_phrase('select_branch'); ?></option>
                 <?php 
                    $hospital_info=$this->crud_model->select_branch_info_by_hospital_id($this->session->userdata('hospital_id'));
                foreach ($hospital_info as $row1) { ?>
                <option value="<?php echo $row1['branch_id']; ?>" <?php if($row1['branch_id'] == $branch['branch_id']){echo 'selected';}?>><?php echo $row1['branch_name']; ?></option>
                                <?php } ?>
                <?php }?>
                                </select>
                                <span ><?php echo form_error('branch'); ?></span>
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('department'); ?></label>
                            <div class="col-sm-8">
                                <select name="department" class="form-control select2" id="department"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('department'); ?>"  onchange="return get_doctor(this.value)">
                                    <option value=""><?php echo get_phrase('select_department'); ?></option>

                                </select>
                                <span ><?php echo form_error('department'); ?></span>
                            </div>
                    </div>  
                      <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('doctor'); ?></label>
                            <div class="col-sm-8">
                                <select multiple name="doctor[]" class="form-control select2" id="select_doctor"  data-validate="required" data-message-required="Value Required" value="<?php echo set_value('doctor[]'); ?>">
                                </select>
                                <span ><?php echo form_error('doctor[]'); ?></span>
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('status'); ?></label>
                        <div class="col-sm-8">
                            <select name="status" class="form-control" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('status'); ?>">
                                <option value=""><?php echo get_phrase('select_status'); ?></option>
                                <option value="1" selected=""><?php echo get_phrase('active'); ?></option>
                                <option value="2"><?php echo get_phrase('inactive'); ?></option>
                            </select>
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
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('gender'); ?></label>

                        <div class="col-sm-8">
                            <select name="gender" class="form-control" value="<?php echo set_value('gender'); ?>">
                                <option value=""><?php echo get_phrase('select_gender'); ?></option>
                                <option value="M"><?php echo get_phrase('male'); ?></option>
                                <option value="F"><?php echo get_phrase('female'); ?></option>
                                <option value="T">Other / Transgender</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('date_of_birth'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="dob" class="form-control" autocomplete="off" id="dob" value="<?php echo set_value('dob'); ?>" placeholder="<?php echo get_phrase('date_of_birth'); ?>">
                        </div>
                    </div>
                    <div class="form-group" hidden="">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('aadhar_number'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="aadhar" class="form-control" id="aadhar" value="<?php echo set_value('aadhar'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('address'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="address" class="form-control" id="address" value="<?php echo set_value('address'); ?>">
                            <span id="location-get-latlng">
                            <input type="hidden" name="latitude" id="lat" value="">
                            <input type="hidden" name="longitude" id="lng" value="">
                        </span>
                            <input type="button" class="btn btn-info btn-sm" value="Get Current location" onclick="getLocation()" />
                        </div>
                    </div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('profile_picture'); ?></label>

						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="http://placehold.it/200x200" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new"><?php echo get_phrase('select_picture'); ?></span>
										<span class="fileinput-exists"><?php echo get_phrase('change'); ?></span>
										<input type="file" name="userfile" accept="image/*" id="userfile" value="<?php echo set_value('userfile'); ?>">
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
                            <select name="country" class="form-control select2" id="country" value="<?php echo set_value('country'); ?>"  onchange="return get_state(this.value)">
                                <option value=""><?php echo get_phrase('select_country'); ?></option>
                            </select>
                        </div>
                    </div> 
                    
                    
                       <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('state'); ?></label>
                            <div class="col-sm-8">
                                <select name="state" class="form-control select2" id="state" value="<?php echo set_value('state'); ?>"  onchange="return get_district(this.value)">
                                    <option value=""><?php echo get_phrase('select_state'); ?></option>

                                </select>   
                            </div>  
                    </div>
                    
                    
                       <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('district'); ?></label>
                            <div class="col-sm-8">
                                <select name="district" class="form-control select2" id="district" value="<?php echo set_value('district'); ?>"  onchange="return get_city(this.value)">
                                    <option value=""><?php echo get_phrase('select_district'); ?></option>

                                </select>
                            </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('city'); ?></label>
                            <div class="col-sm-8">
                                <select name="city" class="form-control select2" id="city" value="<?php echo set_value('city'); ?>"  >
                                    <option value=""><?php echo get_phrase('select_city'); ?></option>

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
                            <input type="text" name="qualification" class="form-control" id="qualification" value="<?php echo set_value('qualification'); ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('experience'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="experience" class="form-control" id="experience" value="<?php echo set_value('experience'); ?>">
                        </div>
                    </div>
                </div>
                    </div>    
                    </div>
                  
                          
			
			</div></div></div>
                
                    </div>
                     <div class="col-sm-3 control-label col-sm-offset-9">
                        <input type="submit" class="btn btn-success" value="<?php echo get_phrase('submit'); ?>">&nbsp;&nbsp;
                        <input type="button" class="btn btn-info" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
                    </div> 
                    </div>
   </form>
</div>
</div>
		</div>
	</div>






<script type="text/javascript">

    
      function get_doctor(branch_id) {

    	$.ajax({
            url: '<?php echo base_url();?>ajax/get_doctor/' + branch_id ,
            success: function(response)
            {
                jQuery('#select_doctor').html(response);
            }
        });

    }
      function get_doctor(department_id) {
if(department_id == 'all'){
    var branch_id=$('#branch').val();
    $.ajax({
            url: '<?php echo base_url();?>ajax/get_doctor/all/' + branch_id ,
            success: function(response)
            {
                jQuery('#select_doctor').html(response);
            }
        });
}else{
        $.ajax({
            url: '<?php echo base_url();?>ajax/get_doctor/' + department_id ,
            success: function(response)
            {
                jQuery('#select_doctor').html(response);
            }
        });
}
    }
</script>


