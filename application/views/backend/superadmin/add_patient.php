
<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------>   
		<ul class="nav nav-tabs bordered"> 
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo 'Basic_info';?>
                </a>
			</li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>  
					<?php echo 'General_info';?>
                </a>
			</li>
				<li>
            	<a href="#pro" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo 'Health_info';?> 
                </a>
			</li>
		</ul>
    	<!------CONTROL TABS END------>
         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>index.php?superadmin/patient/create" method="post" enctype="multipart/form-data">
             
		<div class="tab-content">
		   
        <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
				
				<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_basic_info'); ?></h3>
                </div>
            </div>

            <div class="panel-body">

                
                    <div class="row">
                        <div class="col-sm-12">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('first name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="fname" class="form-control" id="field-1" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('middle name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="mname" class="form-control" id="field-2"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('last name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="lname" class="form-control" id="field-4"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="description" class="form-control" id="field-5"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email'); ?></label>

                        <div class="col-sm-8">
                            <input type="email" name="email" class="form-control" id="field-7"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase(' Phone_number'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="mobile" class="form-control" id="field-9"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">  
                        </div>
                    </div>
                 
                 
                 
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('status'); ?></label>

                        <div class="col-sm-8">
                            <select name="status" class="form-control" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                                <option value=""><?php echo get_phrase('select_status'); ?></option>
                                <option value="1"><?php echo get_phrase('active'); ?></option>
                                <option value="2"><?php echo get_phrase('inactive'); ?></option>
                            </select>
                        </div>
                    </div>
                   
                </div>
                    </div>
                    <!--<div class="col-sm-3 control-label col-sm-offset-2">
                        <input type="submit" class="btn btn-success" value="Submit">
                    </div>
               -->

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

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_general_info'); ?></h3>
                </div>
            </div>

            <div class="panel-body">
                
                         
                    <div class="row">
                        <div class="col-sm-12">
                             <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('city'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="city" class="form-control" id=""  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('gender'); ?></label>

                        <div class="col-sm-8">
                            <select name="gender" class="form-control" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                                <option value=""><?php echo get_phrase('select_gender'); ?></option>
                                <option value="male"><?php echo get_phrase('male'); ?></option>
                                <option value="female"><?php echo get_phrase('female'); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Date of birth'); ?></label>

                        <div class="col-sm-8">
                            <input type="date" name="dob" class="form-control" id="field-2"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('aadhar'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="aadhar" class="form-control" id="field-4"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('address'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="address" class="form-control" id="field-5"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                        </div>
                    </div>
                            <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('country'); ?></label> 

                        <div class="col-sm-8">
                            <select name="country" class="form-control" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value=""  onchange="return get_state(this.value)">
                                <option value=""><?php echo get_phrase('select_country'); ?></option>
                                <?php 
                                $admins = $this->db->get_where('country')->result_array();
                                foreach($admins as $row){?>
                                <option value="<?php echo $row['country_id'] ?>"><?php echo $row['name'] ?></option>
                                
                                <?php } ?>
                               
                            </select>
                        </div>
                    </div> 
                    
                    
                       <div class="form-group">
						<label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('state'); ?></label>
		                    <div class="col-sm-8">
		                        <select name="state" class="form-control" id="select_state"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value=""  onchange="return get_district(this.value)">
		                            <option value=""><?php echo get_phrase('select_country_first');?></option>

			                    </select>   
			                </div>
					</div>
					
					
					   <div class="form-group">
						<label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('district'); ?></label>
		                    <div class="col-sm-8">
		                        <select name="city" class="form-control" id="select_district"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value=""  onchange="return get_city(this.value)">
		                            <option value=""><?php echo get_phrase('select_state_first');?></option>

			                    </select>
			                </div>
					</div>
					
					<div class="form-group">
						<label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('city'); ?></label>
		                    <div class="col-sm-8">
		                        <select name="city" class="form-control" id="select_city"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value=""  >
		                            <option value=""><?php echo get_phrase('select_district_first');?></option>

			                    </select>
			                </div>
					</div>
                   
                   
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo 'Photo';?></label>

						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="http://placehold.it/200x200" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Select image</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="userfile" accept="image/*">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
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
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_health_info'); ?></h3>
                </div>
            </div>

            <div class="panel-body">
                
                        
                    <div class="row">
                        <div class="col-md-12">
                  <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('blood_group'); ?></label>

                        <div class="col-sm-8">
                            <select name="blood_group" class="form-control" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                                <option value=""><?php echo get_phrase('select_blood_group'); ?></option>
                                    <option value="o+"><?php echo get_phrase('A+'); ?></option>
                                    <option value="o+"><?php echo get_phrase('A-'); ?></option>
                                    <option value="o+"><?php echo get_phrase('B+'); ?></option>
                                    <option value="o+"><?php echo get_phrase('B-'); ?></option>
                                    <option value="o+"><?php echo get_phrase('AB+'); ?></option>
                                    <option value="o+"><?php echo get_phrase('AB-'); ?></option>
                                    <option value="o+"><?php echo get_phrase('o+'); ?></option>
                                    <option value="o+"><?php echo get_phrase('o-'); ?></option>
                                   
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('age'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="age" class="form-control" id=""  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('height'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="height" class="form-control" id="field-2"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('weight'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="weight" class="form-control" id="field-4"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('blood_pressure'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="blood_pressure" class="form-control" id="field-5"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('sugar_level'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="sugar_level" class="form-control" id="field-6"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('health_insurance_provider'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="health_insurance_provider" class="form-control" id="field-7"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('health_insurance_id'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="health_insurance_id" class="form-control" id="field-8"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('family_history'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="family_history" class="form-control" id="field-9"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                        </div>
                    </div>
                   <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('past_medical_history'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="past_medical_history" class="form-control" id="field-9"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                        </div>
                    </div>
				     
                   
                </div>
                    </div>    
                    </div>
                  
                          
			</div  
			</div></div></div>
                
                    </div>
                     <div class="col-sm-3 control-label col-sm-offset-2">
                        <input type="submit" class="btn btn-success" value="Submit">
                    </div> 
   
			
		   
			<!----CREATION FORM ENDS-->
		</div>
		</form>
	</div>
</div>




<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable();
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
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



