<?php 
$department_info = $this->db->get('department')->result_array();
$single_doctor_info = $this->db->get_where('doctors', array('doctor_id' => $doctor_id))->result_array();
foreach ($single_doctor_info as $row) {
    
?>
 
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
         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>index.php?superadmin/doctor/update/<?php echo $row['doctor_id']; ?>" method="post" enctype="multipart/form-data">
             
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
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['fname'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="fname" class="form-control" id="field-1" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?=$row['name']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['mname'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="mname" class="form-control" id="field-2"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?=$row['mname']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['lname'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="lname" class="form-control" id="field-4"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?=$row['lname']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['description'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="description" class="form-control" id="field-5"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?=$row['description']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['email'];?></label>

                        <div class="col-sm-8">
                            <input type="email" name="email" class="form-control" id="field-7"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?=$row['email']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['phone_number'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="mobile" class="form-control" id="field-9"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?=$row['phone']?>">  
                        </div>
                    </div>
                 
                  <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectHospital'];?></label> 

                        <div class="col-sm-8">
                            <select name="hospital" class="form-control" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value=""  onchange="return get_branch(this.value)">
                                <option value=""><?php echo $this->lang->line('labels')['select_hospital'];?></option>
                                <?php 
                                $admins = $this->db->get_where('hospitals',array('status'=>1))->result_array();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['hospital_id'] ?>" <?php if($row1['hospital_id']==$row['hospital_id']){echo 'selected';}?>><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
                               
                            </select>
                        </div>
                    </div>
                  <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectBranch'];?></label>
                            <div class="col-sm-8">
                                <select name="branch" class="form-control" id="select_branch"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value=""  onchange="return get_department(this.value)">
                                    <option value=""><?php echo $this->lang->line('labels')['select_hospital_first'];?></option>
                                    <?php 
                                $admins = $this->db->get('branch')->result_array();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['branch_id'] ?>" <?php if($row1['branch_id']==$row['branch_id']){echo 'selected';}?>><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
                                </select>
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['description'];?></label>
                            <div class="col-sm-8">
                                <select name="department" class="form-control" id="select_department"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="">
                                    <option value=""><?php echo $this->lang->line('labels')['select_branch_first'];?></option>
                                     <?php 
                                $admins = $this->db->get('department')->result_array();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['department_id'] ?>" <?php if($row1['department_id']==$row['department_id']){echo 'selected';}?>><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
                                </select>
                            </div>
                    </div>
                 
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['status'];?></label>

                        <div class="col-sm-8">
                            <select name="status" class="form-control" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="">
                                <option value=""><?php echo $this->lang->line('labels')['select_status'];?></option>
                                <option value="1"  <?php if($row['status']=='1'){echo 'selected';}?>><?php echo $this->lang->line('labels')['active'];?></option>
                                <option value="2"  <?php if($row['status']=='2'){echo 'selected';}?>><?php echo $this->lang->line('labels')['inactive'];?></option>
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
                            <select name="gender" class="form-control" value="">
                                <option value=""><?php echo get_phrase('select_gender'); ?></option>
                                <option value="male" <?php if($row['gender']=='male'){echo 'selected';}?>><?php echo $this->lang->line('labels')['male'];?></option>
                                <option value="female"  <?php if($row['gender']=='female'){echo 'selected';}?>><?php echo $this->lang->line('labels')['female'];?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['dob'];?></label>

                        <div class="col-sm-8">
                            <input type="date" name="dob" class="form-control" id="field-2" value="<?php echo $row['dob']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['aadharNumber'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="aadhar" class="form-control" id="field-4" value="<?php echo $row['aadhar']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['address'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="address" class="form-control" id="field-5"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo $row['address']; ?>">
                        </div>
                    </div>
                   <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectCountry'];?></label> 

                        <div class="col-sm-8">
                            <select name="country" class="form-control" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value=""  onchange="return get_state(this.value)">
                                <option value=""><?php echo $this->lang->line('labels')['select_country'];?></option>
                                <?php 
                                $admins = $this->db->get_where('country')->result_array();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['country_id'] ?>" <?php if($row1['country_id'] == $row['country']){echo 'selected';}?>><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
                               
                            </select>
                        </div>
                    </div> 
                    
                    
                       <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectState'];?></label>
                            <div class="col-sm-8">
                                <select name="state" class="form-control" id="select_state" value=""  onchange="return get_district(this.value)">
                                    <option value=""><?php echo $this->lang->line('labels')['select_country_first'];?></option>
                                    <?php 
                                $admins = $this->db->get_where('state')->result_array();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['state_id'] ?>" <?php if($row1['state_id'] == $row['state']){echo 'selected';}?>><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
                                </select>   
                            </div>
                    </div>
                    
                    
                       <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectDistrict'];?></label>
                            <div class="col-sm-8">
                                <select name="district" class="form-control" id="select_district"  value=""  onchange="return get_city(this.value)">
                                    <option value=""><?php echo $this->lang->line('labels')['select_state_first'];?></option>
                                    <?php 
                                $admins = $this->db->get_where('district')->result_array();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['district_id'] ?>" <?php if($row1['district_id'] == $row['district']){echo 'selected';}?>><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
                                </select>
                            </div>   
                    </div>
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectCity'];?></label>
                            <div class="col-sm-8">
                                <select name="city" class="form-control" id="select_city"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value=""  >
                                    <option value=""><?php echo $this->lang->line('labels')['select_district_first'];?></option>
                                    <?php 
                                $admins = $this->db->get_where('city')->result_array();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['city_id'] ?>" <?php if($row1['city_id'] == $row['city']){echo 'selected';}?>><?php echo $row1['name'] ?></option>
                                <?php } ?>
                                </select>
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['profilePic'];?></label>

                        <div class="col-sm-5">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                    <img src="<?php echo base_url(); ?>uploads/doctor_image/<?php echo $row['doctor_id']; ?>.jpg" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileinput-new"><?php echo $this->lang->line('labels')['select_image'];?></span>
                                        <span class="fileinput-exists"><?php echo $this->lang->line('labels')['change'];?></span>
                                        <input type="file" name="userfile" accept="image/*">
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
                            <input type="text" name="qualification" class="form-control" id="field-2" value="<?php echo $row['qualification']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['specializations'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="specializations" class="form-control" id="field-4" value="<?php echo $row['specializations']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['experience'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="experience" class="form-control" id="field-5" value="<?php echo $row['experience']; ?>">
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







<?php } ?>

<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      

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