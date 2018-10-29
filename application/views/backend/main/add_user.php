
<div class="row">
	<div class="col-md-12">
    
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
    	<!------CONTROL TABS END------>
         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/add_user/" method="post" enctype="multipart/form-data">
             
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
                            <input type="text" name="fname" class="form-control" id="fname" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('fname'); ?>">
                            <span ><?php echo form_error('fname'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['mname'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="mname" class="form-control" id="mname" value="<?php echo set_value('mname'); ?>">
                            <span ><?php echo form_error('mname'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['lname'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="lname" class="form-control" id="lname"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('lname'); ?>">
                            <span ><?php echo form_error('lname'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['description'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="description" class="form-control" id="description"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('description'); ?>">
                            <span ><?php echo form_error('description'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['email'];?></label>

                        <div class="col-sm-8">
                            <input type="email" name="email" class="form-control" id="email"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('email'); ?>">
                            <span ><?php echo form_error('email'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['phone_number'];?></label>

                        <div class="col-sm-8">
                            <input type="number" name="mobile" class="form-control" id="mobile"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('mobile'); ?>" minlength="10" maxlength="10">
                            <span ><?php echo form_error('mobile'); ?></span>  
                        </div>
                    </div>
                 
                 
                 
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['status'];?></label>

                        <div class="col-sm-8">
                            <select name="status" class="form-control" id="status" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="">
                                <option value=""><?php echo $this->lang->line('labels')['select_status'];?></option>
                                <option value="1" selected=""><?php echo $this->lang->line('labels')['active'];?></option>
                                <option value="2"><?php echo $this->lang->line('labels')['inactive'];?></option>
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
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['gender'];?></label>

                        <div class="col-sm-8">
                            <select name="gender" class="form-control" id="gender" value="<?php echo set_value('gender'); ?>">
                                <option value=""><?php echo $this->lang->line('labels')['select_gender'];?></option>
                                <option value="male"><?php echo $this->lang->line('labels')['male'];?></option>
                                <option value="female"><?php echo $this->lang->line('labels')['female'];?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['dob'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="dob" class="form-control" id="dob" placeholder="<?php echo $this->lang->line('labels')['dob'];?>" value="<?php echo set_value('dob'); ?>" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group" hidden="">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['aadharNumber'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="aadhar" class="form-control" id="aadhar" value="<?php echo set_value('aadhar'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['address'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="address" class="form-control" id="address" value="<?php echo set_value('address'); ?>">
                        </div>
                    </div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['profilePic'];?></label>

						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="http://placehold.it/200x200" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new"><?php echo $this->lang->line('labels')['select_image'];?></span>
										<span class="fileinput-exists"><?php echo $this->lang->line('labels')['change'];?></span>
										<input type="file" name="userfile" id="userfile" accept="image/*" id="userfile" value="<?php echo set_value('userfile'); ?>">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo $this->lang->line('labels')['remove'];?></a>
								</div>
							</div>
						</div>
					</div>
                   
                </div>
                <div class="col-sm-6">
                            <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectCountry'];?></label> 

                        <div class="col-sm-8">
                            <select name="country" class="form-control" id="country" value="<?php echo set_value('country'); ?>"  onchange="return get_state(this.value)">
                                <option value=""><?php echo $this->lang->line('labels')['select_country'];?></option>
                                <?php 
                                $admins = $this->db->get_where('country')->result_array();
                                foreach($admins as $row){?>
                                <option value="<?php echo $row['country_id'] ?>"><?php echo $row['name'] ?></option>
                                
                                <?php } ?>
                               
                            </select>
                        </div>
                    </div> 
                       <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectState'];?></label>
                            <div class="col-sm-8">
                                <select name="state" class="form-control" id="select_state" value="<?php echo set_value('state'); ?>"  onchange="return get_district(this.value)">
                                    <option value=""><?php echo $this->lang->line('labels')['select_country_first'];?></option>

                                </select>   
                            </div>
                    </div>
                    
                    
                       <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectDistrict'];?></label>
                            <div class="col-sm-8">
                                <select name="district" class="form-control" id="select_district" value="<?php echo set_value('district'); ?>"  onchange="return get_city(this.value)">
                                    <option value=""><?php echo $this->lang->line('labels')['select_state_first'];?></option>

                                </select>
                            </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectCity'];?></label>
                            <div class="col-sm-8">
                                <select name="city" class="form-control" id="select_city" value="<?php echo set_value('city'); ?>"  >
                                    <option value=""><?php echo $this->lang->line('labels')['select_district_first'];?></option>

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
                            <select name="blood_group" class="form-control" id="blood_group" value="<?php echo set_value('blood_group'); ?>">
                                <option value=""><?php echo $this->lang->line('labels')['selectBloodGroup'];?></option>
                                    <option value="A+"><?php echo get_phrase('A+'); ?></option>
                                    <option value="A-"><?php echo get_phrase('A-'); ?></option>
                                    <option value="B+"><?php echo get_phrase('B+'); ?></option>
                                    <option value="B-"><?php echo get_phrase('B-'); ?></option>
                                    <option value="AB+"><?php echo get_phrase('AB+'); ?></option>
                                    <option value="AB-"><?php echo get_phrase('AB-'); ?></option>
                                    <option value="O+"><?php echo get_phrase('o+'); ?></option>
                                    <option value="O-"><?php echo get_phrase('o-'); ?></option>
                                   
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['age'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="age" class="form-control" id="age" value="<?php echo set_value('age'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['height'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="height" class="form-control" id="height" value="<?php echo set_value('height'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['weight'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="weight" class="form-control" id="weight" value="<?php echo set_value('weight'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['bloodPressure'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="blood_pressure" class="form-control" id="blood_pressure" value="<?php echo set_value('blood_pressure'); ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['sugarLevel'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="sugar_level" class="form-control" id="sugar_level" value="<?php echo set_value('sugar_level'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['healthInsuranceProvider'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="health_insurance_provider" class="form-control" id="health_insurance_provider" value="<?php echo set_value('health_insurance_provider'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['healthInsuranceId'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="health_insurance_id" class="form-control" id="health_insurance_id" value="<?php echo set_value('health_insurance_id'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['familyHistory'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="family_history" class="form-control" id="family_history" value="<?php echo set_value('family_history'); ?>">
                        </div>
                    </div>
                   <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['pastMedicalHistory'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="past_medical_history" class="form-control" id="past_medical_history" value="<?php echo set_value('past_medical_history'); ?>">
                        </div>
                    </div>
                     
                   
                </div>
                    </div>    
                    </div>
                  
                          
			</div>  
			</div></div>
                    </div>
                     <div class="col-sm-3 control-label col-sm-offset-9">
                        <input type="submit" class="btn btn-success" value="<?php echo $this->lang->line('buttons')['submit'];?>">&nbsp;&nbsp;
                        <input type="button" class="btn btn-info" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
                    </div> 
		</div>
		</form>
	</div>
</div>


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



