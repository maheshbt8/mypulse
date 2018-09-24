
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
					 <?php echo $this->lang->line('labels')['professionInfo'];?>
                </a>
			</li>
		</ul>
    	<!------CONTROL TABS END------>
         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>index.php?superadmin/add_nurse/" method="post" enctype="multipart/form-data">
             
		<div class="tab-content">
		   
        <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
				
				<div class="row">
    <div class="col-md-8">

        <div class="panel panel-primary" data-collapsed="0">


            <div class="panel-body">

                
                    <div class="row">
                        <div class="col-sm-12">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"> <?php echo $this->lang->line('labels')['fname'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="fname" class="form-control" id="field-1" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('fname'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"> <?php echo $this->lang->line('labels')['mname'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="mname" class="form-control" id="field-2"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('mname'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"> <?php echo $this->lang->line('labels')['lname'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="lname" class="form-control" id="field-3"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('lname'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"> <?php echo $this->lang->line('labels')['description'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="description" class="form-control" id="field-4" value="<?php echo set_value('description'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"> <?php echo $this->lang->line('labels')['email'];?></label>

                        <div class="col-sm-8">
                            <input type="email" name="email" class="form-control" id="field-5"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('email'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"> <?php echo $this->lang->line('labels')['phone_number'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="mobile" class="form-control" id="field-6"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('mobile'); ?>">  
                        </div>
                    </div>
                 
                  <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"> <?php echo $this->lang->line('labels')['selectHospital'];?></label> 

                        <div class="col-sm-8">
                            <select name="hospital" class="form-control" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('hospital'); ?>"  onchange="return get_branch(this.value)">
                                <option value=""> <?php echo $this->lang->line('labels')['select_hospital'];?></option>
                                <?php 
                                $admins = $this->db->get_where('hospitals',array('status'=>1))->result_array();
                                foreach($admins as $row){?>
                                <option value="<?php echo $row['hospital_id'] ?>"><?php echo $row['name'] ?></option>
                                
                                <?php } ?>
                               
                            </select>
                        </div>
                    </div>
                  <div class="form-group">
						<label for="field-ta" class="col-sm-3 control-label"> <?php echo $this->lang->line('labels')['selectBranch'];?></label>
		                    <div class="col-sm-8">
		                        <select name="branch" class="form-control" id="select_branch"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('branch'); ?>"  onchange="return get_department(this.value)">
		                            <option value=""> <?php echo $this->lang->line('labels')['select_hospital_first'];?></option>

			                    </select>
			                </div>
					</div>
                    <div class="form-group">
						<label for="field-ta" class="col-sm-3 control-label"> <?php echo $this->lang->line('labels')['selectDepartment'];?></label>
		                    <div class="col-sm-8">
		                        <select name="department" class="form-control" id="select_department"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('department'); ?>"  onchange="return get_doctor(this.value)">
		                            <option value=""> <?php echo $this->lang->line('labels')['select_branch_first'];?></option>

			                    </select>
			                </div>
					</div>  
					
					
					
					  <div class="form-group">
						<label for="field-ta" class="col-sm-3 control-label"> <?php echo $this->lang->line('labels')['selectDoctor'];?></label>
		                    <div class="col-sm-8">
		                        <select multiple name="doctor[]" class="form-control" id="select_doctor"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('doctor[]'); ?>">
		                            <option value=""><?php echo $this->lang->line('labels')['select_department_first'];?></option>

			                    </select>
			                </div>
					</div>
					
                 
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"> <?php echo $this->lang->line('labels')['status'];?></label>

                        <div class="col-sm-8">
                            <select name="status" class="form-control" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('status'); ?>">
                                <option value=""> <?php echo $this->lang->line('labels')['select_status'];?></option>
                                <option value="1"> <?php echo $this->lang->line('labels')['active'];?></option>
                                <option value="2"> <?php echo $this->lang->line('labels')['inactive'];?></option>
                            </select>
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
    <div class="col-md-8">

        <div class="panel panel-primary" data-collapsed="0">
     <div class="panel-body">
                
                         
                    <div class="row">
                        <div class="col-sm-12">
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['gender'];?></label>

                        <div class="col-sm-8">
                            <select name="gender" class="form-control" value="<?php echo set_value('gender'); ?>">
                                <option value=""><?php echo $this->lang->line('labels')['select_gender'];?></option>
                                <option value="male"><?php echo $this->lang->line('labels')['male'];?></option>
                                <option value="female"><?php echo $this->lang->line('labels')['female'];?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['dob'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="dob" class="form-control datepicker" id="field-7" value="<?php echo set_value('dob'); ?>" placeholder="<?php echo $this->lang->line('labels')['dob'];?>" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['aadharNumber'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="aadhar" class="form-control" id="field-8" value="<?php echo set_value('aadhar'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['address'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="address" class="form-control" id="field-9" value="<?php echo set_value('address'); ?>">
                        </div>
                    </div>
                    
                    
                    
                            <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectCountry'];?></label> 

                        <div class="col-sm-8">
                            <select name="country" class="form-control" value="<?php echo set_value('country'); ?>"  onchange="return get_state(this.value)">
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
										<input type="file" name="userfile" accept="image/*" value="<?php echo set_value('userfile'); ?>">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo $this->lang->line('labels')['remove'];?></a>
								</div>
							</div>
						</div>
					</div>
                   
                </div>
                    </div>
                    
                            
			</div>
			</div></div></div></div>
			<!----CREATION FORM ENDS-->
	
		
			<div class="tab-pane box" id="pro" style="padding: 5px">
               	<div class="row">
    <div class="col-md-8">

        <div class="panel panel-primary" data-collapsed="0">
        <div class="panel-body">
                
                        
                    <div class="row">
                        <div class="col-md-12">
                 
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['qualification'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="qualification" class="form-control" id="field-10" value="<?php echo set_value('qualification'); ?>">
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['experience'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="experience" class="form-control" id="field-11" value="<?php echo set_value('experience'); ?>">
                        </div>
                    </div>
                   
				     
                   
                </div>
                    </div>    
                    </div>
                  
                     </div></div></div>
                
                    </div>
                     <div class="col-sm-3 control-label col-sm-offset-2">
                        <input type="submit" class="btn btn-success" value="<?php echo $this->lang->line('buttons')['submit'];?>">
                    </div> 
                    </div>
   </form>
			
		   
			<!----CREATION FORM ENDS-->
		</div>
	</div>






<script type="text/javascript">

	function get_branch(hospital_id) {
    
    	$.ajax({
            url: '<?php echo base_url();?>index.php?superadmin/get_branch/' + hospital_id ,
            success: function(response)
            {
                jQuery('#select_branch').html(response);
            }
        });

    }
    
    function get_department(branch_id) {

    	$.ajax({
            url: '<?php echo base_url();?>index.php?superadmin/get_department/' + branch_id ,
            success: function(response)
            {
                jQuery('#select_department').html(response);
            }
        });

    }
    
      function get_doctor(branch_id) {

    	$.ajax({
            url: '<?php echo base_url();?>index.php?superadmin/get_doctor/' + branch_id ,
            success: function(response)
            {
                jQuery('#select_doctor').html(response);
            }
        });

    }

</script>


<script type="text/javascript">

	
	function get_state(country_id) {
    
    	$.ajax({
            url: '<?php echo base_url();?>index.php?superadmin/get_state/' + country_id ,
            success: function(response)
            {
                jQuery('#select_state').html(response);
            }
        });

    }
    
    function get_city(state_id) {

    	$.ajax({
            url: '<?php echo base_url();?>index.php?superadmin/get_city/' + state_id ,
            success: function(response)
            {
                jQuery('#select_city').html(response);
            }
        });   

    }
    
     function get_district(city_id) {

    	$.ajax({
            url: '<?php echo base_url();?>index.php?superadmin/get_district/' + city_id ,
            success: function(response)
            {
                jQuery('#select_district').html(response);
            }
        });

    }

</script>


