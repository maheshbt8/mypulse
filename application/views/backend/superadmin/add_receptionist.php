
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
         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>index.php?superadmin/add_receptionist/" method="post" enctype="multipart/form-data">
             
		<div class="tab-content">
		   
        <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
				
				<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">
             <div class="panel-body">
                 <div class="row">
                        <div class="col-sm-12">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('first_name'); ?></label>

                        <div class="col-sm-6">
                            <input type="text" name="fname" class="form-control" id="fname" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo set_value('fname'); ?>">
                            <span ><?php echo form_error('fname'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('middle_name'); ?></label>

                        <div class="col-sm-6">
                            <input type="text" name="mname" class="form-control" id="mname"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('mname'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('last_name'); ?></label>

                        <div class="col-sm-6">
                            <input type="text" name="lname" class="form-control" id="lname"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('lname'); ?>">
                            <span ><?php echo form_error('lname'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                        <div class="col-sm-6">
                            <input type="text" name="description" class="form-control" id="description" value="<?php echo set_value('description'); ?>">
                            <span ><?php echo form_error('description'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email'); ?></label>

                        <div class="col-sm-6">
                            <input type="email" name="email" class="form-control" id="email"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('email'); ?>">
                            <span ><?php echo form_error('email'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('phone_number'); ?></label>

                        <div class="col-sm-6">
                            <input type="text" name="mobile" class="form-control" id="mobile"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('mobile'); ?>">  
                            <span ><?php echo form_error('mobile'); ?></span>
                        </div>
                    </div>
                 
                  <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('hospital'); ?></label> 

                        <div class="col-sm-6">
                            <select name="hospital" class="form-control" id="hospital" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('hospital'); ?>"  onchange="return get_branch(this.value)">
                                <option value=""><?php echo get_phrase('select_hospital'); ?></option>
                                <?php 
                                $admins = $this->db->get_where('hospitals',array('status'=>1))->result_array();
                                foreach($admins as $row){?>
                                <option value="<?php echo $row['hospital_id'] ?>"><?php echo $row['name'] ?></option>
                                
                                <?php } ?>
                               
                            </select>
                            <span ><?php echo form_error('hospital'); ?></span>
                        </div>
                    </div>
                  <div class="form-group">
						<label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('branch'); ?></label>
		                    <div class="col-sm-6">
		                        <select name="branch" class="form-control" id="select_branch"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('branch'); ?>"  onchange="return get_department(this.value)">
		                            <option value=""><?php echo get_phrase('select_hospital_first'); ?></option>

			                    </select>
                                <span ><?php echo form_error('branch'); ?></span>
			                </div>
					</div>
                    <div class="form-group">
						<label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('department'); ?></label>
		                    <div class="col-sm-6">
		                        <select name="department" class="form-control" id="select_department"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('department'); ?>"  onchange="return get_doctor(this.value)">
		                            <option value=""><?php echo get_phrase('select_branch_first'); ?></option>

			                    </select>
                                <span ><?php echo form_error('department'); ?></span>
			                </div>
					</div>  
					
					
					
					  <div class="form-group">
						<label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('doctor'); ?></label>
		                    <div class="col-sm-6">
		                        <select multiple name="doctor[]" class="form-control" id="select_doctor"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('doctor[]'); ?>">
		                            <option value=""><?php echo get_phrase('select_department_first'); ?></option>

			                    </select>
                                <span ><?php echo form_error('doctor[]'); ?></span>
			                </div>
					</div>
					
                 
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('status'); ?></label>

                        <div class="col-sm-6">
                            <select name="status" class="form-control" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('status'); ?>">
                                <option value=""><?php echo get_phrase('select_status'); ?></option>
                                <option value="1"><?php echo get_phrase('active'); ?></option>
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
                        <div class="col-sm-12">
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('gender'); ?></label>

                        <div class="col-sm-6">
                            <select name="gender" class="form-control" value="<?php echo set_value('gender'); ?>">
                                <option value=""><?php echo get_phrase('select_gender'); ?></option>
                                <option value="male"><?php echo get_phrase('male'); ?></option>
                                <option value="female"><?php echo get_phrase('female'); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('date_of_birth'); ?></label>

                        <div class="col-sm-6">
                            <input type="text" name="dob" class="form-control datepicker" id="dob" value="<?php echo set_value('dob'); ?>" placeholder="<?php echo get_phrase('date_of_birth'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('aadhar_number'); ?></label>

                        <div class="col-sm-6">
                            <input type="text" name="aadhar" class="form-control" id="aadhar" value="<?php echo set_value('aadhar'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('address'); ?></label>

                        <div class="col-sm-6">
                            <input type="text" name="address" class="form-control" id="address" value="<?php echo set_value('address'); ?>">
                        </div>
                    </div>
                    
                    
                    
                            <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('country'); ?></label> 

                        <div class="col-sm-6">
                            <select name="country" class="form-control" id="country" value="<?php echo set_value('country'); ?>"  onchange="return get_state(this.value)">
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
		                    <div class="col-sm-6">
		                        <select name="state" class="form-control" id="select_state" value="<?php echo set_value('state'); ?>"  onchange="return get_district(this.value)">
		                            <option value=""><?php echo get_phrase('select_country_first'); ?></option>

			                    </select>   
			                </div>  
					</div>
					
					
					   <div class="form-group">
						<label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('district'); ?></label>
		                    <div class="col-sm-6">
		                        <select name="district" class="form-control" id="select_district" value="<?php echo set_value('district'); ?>"  onchange="return get_city(this.value)">
		                            <option value=""><?php echo get_phrase('select_state_first'); ?></option>

			                    </select>
			                </div>
					</div>
					
					<div class="form-group">
						<label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('city'); ?></label>
		                    <div class="col-sm-6">
		                        <select name="city" class="form-control" id="select_city" value="<?php echo set_value('city'); ?>"  >
		                            <option value=""><?php echo get_phrase('select_district_first'); ?></option>

			                    </select>
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
                        <div class="col-md-12">
                 
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('qualification'); ?></label>

                        <div class="col-sm-6">
                            <input type="text" name="qualification" class="form-control" id="qualification" value="<?php echo set_value('qualification'); ?>">
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('experience'); ?></label>

                        <div class="col-sm-6">
                            <input type="text" name="experience" class="form-control" id="experience" value="<?php echo set_value('experience'); ?>">
                        </div>
                    </div>
                   
				     
                   
                </div>
                    </div>    
                    </div>
                  
                          
			
			</div></div></div>
                
                    </div>
                     <div class="col-sm-3 control-label col-sm-offset-2">
                        <input type="submit" class="btn btn-success" value="<?php echo get_phrase('submit'); ?>">
                    </div> 
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

