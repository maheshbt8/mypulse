
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
        <div class="panel panel-default">   
            <div class="panel-body">
    	<!------CONTROL TABS END------>
         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/add_stores/" method="post" enctype="multipart/form-data">
             
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
                        <label for="field-1" class="col-sm-3 control-label"> <?php echo get_phrase('name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" id="name" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('name'); ?>">
                            <span ><?php echo form_error('name'); ?></span>
                        </div>
                    </div>
                   
                  
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"> <?php echo get_phrase('description'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="description" class="form-control" id="description"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('description'); ?>">
                            <span ><?php echo form_error('description'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"> <?php echo get_phrase('address'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="address" class="form-control" id="address"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('address'); ?>">
                            <span ><?php echo form_error('address'); ?></span>
                        </div>
                    </div>
                    
                       <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"> <?php echo get_phrase('phone_number'); ?></label>

                        <div class="col-sm-8">
                            <input type="number" name="phone_number" class="form-control" id="phone_number"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('phone_number'); ?>" minlength="10" maxlength="10">  
                            <span ><?php echo form_error('phone_number'); ?></span>
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['status'];?></label>

                        <div class="col-sm-8">
                            <select name="status" class="form-control" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('status'); ?>">
                                <option value=""><?php echo $this->lang->line('labels')['select_status'];?></option>
                                <option value="1" selected=""><?php echo $this->lang->line('labels')['active'];?></option>
                                <option value="2"><?php echo $this->lang->line('labels')['inactive'];?></option>
                            </select>
                            <span ><?php echo form_error('status'); ?></span>
                        </div>
                    </div>
                   
                </div>
                 <div class="col-sm-6">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"> <?php echo get_phrase('owner/MD_name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="owner_name" class="form-control" id="owner_name"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('owner_name'); ?>">
                            <span ><?php echo form_error('owner_name'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"> <?php echo get_phrase('owner/MD_phone_number'); ?></label>

                        <div class="col-sm-8">
                            <input type="number" name="owner_mobile" class="form-control" id="owner_mobile"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('owner_mobile'); ?>" minlength="10" maxlength="10">
                            <span ><?php echo form_error('owner_mobile'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"> <?php echo get_phrase('email'); ?></label>

                        <div class="col-sm-8">
                            <input type="email" name="email" class="form-control" id="email"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo set_value('email'); ?>">
                            <span ><?php echo form_error('email'); ?></span>
                        </div>
                    </div>
                  <?php if($account_type=='superadmin'){?>
                  <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"> <?php echo get_phrase('hospital'); ?></label> 

                        <div class="col-sm-8">
                            <select name="hospital" class="form-control" id="hospital" value="<?php echo set_value('hospital'); ?>"  onchange="return get_branch(this.value)">
                                <option value=""><?php echo $this->lang->line('labels')['select_hospital'];?></option>
                                <?php 
                                $admins = $this->db->get_where('hospitals',array('status'=>1))->result_array();
                                foreach($admins as $row){?>
                                <option value="<?php echo $row['hospital_id'] ?>"><?php echo $row['name'] ?></option>
                                
                                <?php } ?>
                               
                            </select>
                            <span ><?php echo form_error('hospital'); ?></span>
                        </div>
                    </div>
                    <?php }elseif($account_type=='hospitaladmins'){?>
                <input type="hidden" name="hospital" value="<?php echo $this->session->userdata('hospital_id');?>"/>
                <?php }?>
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"> <?php echo get_phrase('branch'); ?></label>
                            <div class="col-sm-8">
                                <select name="branch" class="form-control" id="select_branch" value="<?php echo set_value('branch'); ?>"  onchange="return get_department(this.value)">
                    <?php if($account_type=='superadmin'){?>
                    <option value=""><?php echo get_phrase('select_hospital_first'); ?></option>
                    <?php }elseif($account_type=='hospitaladmins'){?>
                    <option value=""><?php echo get_phrase('select_branch'); ?></option>
                 <?php 
                    $hospital_info=$this->db->where('hospital_id',$this->session->userdata('hospital_id'))->get('branch')->result_array();
                foreach ($hospital_info as $row1) { ?>
                <option value="<?php echo $row1['branch_id']; ?>" <?php if($row1['branch_id'] == $branch['branch_id']){echo 'selected';}?>><?php echo $row1['name']; ?></option>
                                <?php } ?>
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
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                	<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">
             <div class="panel-body">
                
                         
                    <div class="row">
                        <div class="col-sm-6">
                
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['fname'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="fname" class="form-control" id="fname" value="<?php echo set_value('fname'); ?>">
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['lname'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="lname" class="form-control" id="lname" value="<?php echo set_value('lname'); ?>">
                        </div>
                    </div>
                     
                    <div class="form-group" hidden="">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['aadharNumber'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="aadhar" class="form-control" id="aadhar" value="<?php echo set_value('aadhar'); ?>">
                        </div>
                    </div>
                    
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
                                        <input type="file" name="userfile" accept="image/*" id="userfile" value="userfile">
                                    </span>
                                    <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo $this->lang->line('labels')['remove'];?></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-6">
                                          <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['dob'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="dob" class="form-control" autocomplete="off" id="dob" value="<?php echo set_value('dob'); ?>">
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['address'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="in_address" class="form-control" id="in_address" value="<?php echo set_value('in_address'); ?>">
                        </div>
                    </div>
                             <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('country'); ?></label> 

                        <div class="col-sm-8">
                            <select name="country" class="form-control" value="<?php echo set_value('country'); ?>"  onchange="return get_state(this.value)">
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
                                <select name="state" class="form-control" id="select_state" value="<?php echo set_value('state'); ?>"  onchange="return get_district(this.value)">
                                    <option value=""><?php echo get_phrase('select_country_first'); ?></option>

                                </select>   
                            </div>  
                    </div>
                    
                    
                       <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('district'); ?></label>
                            <div class="col-sm-8">
                                <select name="district" class="form-control" id="select_district" value="<?php echo set_value('district'); ?>"  onchange="return get_city(this.value)">
                                    <option value=""><?php echo get_phrase('select_state_first'); ?></option>

                                </select>
                            </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('city'); ?></label>
                            <div class="col-sm-8">
                                <select name="city" class="form-control" id="select_city" value="<?php echo set_value('city'); ?>"  >
                                    <option value=""><?php echo get_phrase('select_district_first'); ?></option>

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
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['qualification'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="qualification" class="form-control" id="qualification" value="<?php echo set_value('qualification'); ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['experience'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="experience" class="form-control" id="experience" value="<?php echo set_value('experience'); ?>">
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
                        <input type="submit" class="btn btn-success" value="<?php echo $this->lang->line('buttons')['submit'];?>">&nbsp;&nbsp;
                        <input type="button" class="btn btn-info" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
                    </div> 
        </div>
   </form>
</div>
</div>
	</div>
</div>


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