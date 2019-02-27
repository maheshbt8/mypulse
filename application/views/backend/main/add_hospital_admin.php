
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
                    <?php echo get_phrase('professional_info'); ?>
                </a>
            </li>
        </ul>
        <div class="panel panel-default">   
            <div class="panel-body">
        <!------CONTROL TABS END------>
         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/add_hospital_admins/" method="post" enctype="multipart/form-data">
             
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
                            <input type="text" name="fname" class="form-control" id="fname" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo set_value('fname'); ?>" >
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
                            <input type="text" name="lname" class="form-control" id="lname" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo set_value('lname'); ?>">
                            <span ><?php echo form_error('lname'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="description" class="form-control" id="description" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo set_value('description'); ?>">
                            <span ><?php echo form_error('description'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email'); ?></label>

                        <div class="col-sm-8">
                            <input type="email" name="email" class="form-control" id="email" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo set_value('email'); ?>">
                            <span ><?php echo form_error('email'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('phone_number'); ?></label>

                        <div class="col-sm-8">
                            <input type="number" name="phone_number" class="form-control" id="phone_number" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo set_value('phone_number'); ?>" minlength="10" maxlength="10">
                            <span ><?php echo form_error('phone_number'); ?></span>  
                        </div>
                    </div>
                 
                  <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('hospital'); ?></label> 

                        <div class="col-sm-8">
                            <select name="hospital" class="form-control select2" id="hospital" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo set_value('hospital'); ?>">
                                <option value=""><?php echo get_phrase('select_hospital'); ?></option>
                                <?php 
                                $admins = $this->crud_model->select_all_hospitals();
                                foreach($admins as $row){?>
                                <option value="<?php echo $row['hospital_id'] ?>"><?php echo $row['name'] ?></option>
                                
                                <?php } ?>
                               
                            </select>
                            <span ><?php echo form_error('hospital'); ?></span>
                        </div>
                    </div>
                  
                    
                 
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('status'); ?></label>

                        <div class="col-sm-8">
                            <select name="status" class="form-control" id="status" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo set_value('status'); ?>">
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
                            <select name="gender" class="form-control" id="gender" value="<?php echo set_value('gender'); ?>">
                                <option value=""><?php echo get_phrase('select_gender'); ?></option>
                                <option value="male"><?php echo get_phrase('male'); ?></option>
                                <option value="female"><?php echo get_phrase('female'); ?></option>
                                <option value="others">Other / Transgender</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('date_of_birth'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="dob" class="form-control" id="dob" value="<?php echo set_value('dob'); ?>" placeholder="<?php echo get_phrase('date_of_birth'); ?>" autocomplete="off">
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
                                        <input type="file" name="userfile" accept="image/*" value="userfile">
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
            </div>
        </div>
    </div>
</div>
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
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('profession'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="profession" class="form-control" id="profession" value="<?php echo set_value('profession'); ?>">
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
                  
                          
            </div>  
            </div>
        </div>
    </div>
                
                    </div>
                     <div class="col-sm-3 control-label col-sm-offset-9">
                        <input type="submit" class="btn btn-success" value="<?php echo get_phrase('submit'); ?>">&nbsp;&nbsp;
                        <input type="button" class="btn btn-info" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
                    </div> 
                    
   </form>
            </div>
        </div>
           
            <!----CREATION FORM ENDS-->
        
    </div>
</div>

<script type="text/javascript">

    
    function get_state(country_id) {
    
        $.ajax({
            url: '<?php echo base_url();?>ajax/get_state/' + country_id ,
            success: function(response)
            {
                jQuery('#state').html(response);
            }
        });

    }
    
    function get_city(state_id) {

        $.ajax({
            url: '<?php echo base_url();?>ajax/get_city/' + state_id ,
            success: function(response)
            {
                jQuery('#city').html(response);
            }
        });   

    }
    
     function get_district(city_id) {

        $.ajax({
            url: '<?php echo base_url();?>ajax/get_district/' + city_id ,
            success: function(response)
            {
                jQuery('#district').html(response);
            }
        });

    }

</script>