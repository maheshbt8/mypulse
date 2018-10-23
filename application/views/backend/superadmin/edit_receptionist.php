<?php 
/*$department_info = $this->db->get('department')->result_array();*/
$single_receptionist_info = $this->db->get_where('receptionist', array('receptionist_id' => $receptionist_id))->result_array();
foreach ($single_receptionist_info as $row) {
    
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
         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>index.php?superadmin/edit_receptionist/<?php echo $receptionist_id; ?>" method="post" enctype="multipart/form-data">
             
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
                        <input type="text" name="fname" class="form-control" id="fname" value="<?=$row['name']?>">
                            <span ><?php echo form_error('fname'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"> <?php echo get_phrase('middle_name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="mname" class="form-control" id="field-2" value="<?=$row['mname']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"> <?php echo get_phrase('last_name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="lname" class="form-control" id="field-3" value="<?=$row['lname']?>">
                              <span ><?php echo form_error('lname'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"> <?php echo get_phrase('description'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="description" class="form-control" id="field-4" value="<?=$row['description']?>">
                            <span ><?php echo form_error('description'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">  <?php echo get_phrase('email'); ?></label>

                        <div class="col-sm-8">
                            <input type="email" name="email" class="form-control" id="field-5" value="<?=$row['email']?>" readonly>
                             <span ><?php echo form_error('email'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('phone_number'); ?></label>

                        <div class="col-sm-8">
                            <input type="number" name="mobile" class="form-control" id="field-6" value="<?=$row['phone']?>"   minlength="10" maxlength="10" readonly>  
                            <span ><?php echo form_error('mobile'); ?></span>
                        </div>
                    </div>
                 
                   
                </div>
                <div class="col-sm-6">
                  <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"> <?php echo get_phrase('hospital'); ?></label> 

                        <div class="col-sm-8">
                            <select name="hospital" class="form-control" value="<?php echo set_value('hospital'); ?>"  onchange="return get_branch(this.value)">
                                <option value=""><?php echo get_phrase('select_hospital'); ?></option>
                                <?php 
                                $admins = $this->db->get_where('hospitals',array('status'=>1))->result_array();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['hospital_id'] ?>"<?php if($row1['hospital_id']==$row['hospital_id']){echo 'selected';}?> ><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
                               
                            </select>
                            <span ><?php echo form_error('hospital'); ?></span>
                        </div>
                    </div>
                  <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"> <?php echo get_phrase('branch'); ?></label>
                            <div class="col-sm-8">
                                <select name="branch" class="form-control" id="select_branch"   value="<?php echo set_value('branch'); ?>"  onchange="return get_department(this.value)">
                                    <option value=""><?php echo get_phrase('select_hospital_first'); ?></option>
                                     <?php 
                                $admins = $this->db->get('branch')->result_array();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['branch_id'] ?>" <?php if($row1['branch_id']==$row['branch_id']){echo 'selected';}?>><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
                                </select>
                                <span ><?php echo form_error('branch'); ?></span>
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"> <?php echo get_phrase('department'); ?></label>
                            <div class="col-sm-8">
                                <select name="department" class="form-control" id="select_department" value="<?php echo set_value('department'); ?>"  onchange="return get_doctor(this.value)">
                                    <option value=""> <?php echo get_phrase('select_branch_first'); ?></option>
                                     <?php 
                                $admins = $this->db->get('department')->result_array();
                                ?>
                                <option value="all" <?php if($row['department_id'] == '0'){echo 'selected';}?>><?php echo 'All Departments';?></option>
                                <?php
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['department_id'] ?>" <?php if($row1['department_id']==$row['department_id']){echo 'selected';}?>><?php echo $row1['name'] ?></option>
                                <?php } ?>
                                </select>
                                 <span ><?php echo form_error('department'); ?></span>
                            </div>
                    </div>  
                    
                      <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('doctor'); ?></label>
                            <div class="col-sm-8">
                                <select multiple name="doctor[]" class="form-control select2" id="select_doctor" value="<?php echo set_value('doctor[]'); ?>">
                                   
                                      <?php 
                                  if($row['department_id'] == '0'){ 
                                $admins = $this->db->where('branch_id',$row['branch_id'])->get('doctors')->result_array();
                                }else{
                                    $admins = $this->db->where('department_id',$row['department_id'])->get('doctors')->result_array();
                                }

                                foreach($admins as $row1){
                                    $doc=explode(',',$row['doctor_id']);
                                    ?>
                                <option value="<?php echo $row1['doctor_id'] ?>" <?php for($i=0;$i<count($doc);$i++){if($doc[$i] == $row1['doctor_id']){echo 'selected';}}?>><?php echo $row1['name']; ?></option>
                                
                                <?php } ?>
                                </select>
                                <span ><?php echo form_error('doctor'); ?></span>
                            </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('status'); ?></label>

                        <div class="col-sm-8">
                            <select name="status" class="form-control" id="status" value="<?php echo set_value('status'); ?>">
                                <option value=""><?php echo get_phrase('select_status'); ?></option>
                                 <option value="1"  <?php if($row['status']=='1'){echo 'selected';}?>><?php echo get_phrase('active'); ?></option>
                                <option value="2"  <?php if($row['status']=='2'){echo 'selected';}?>><?php echo get_phrase('inactive'); ?></option>
                            </select>
                            <?php echo form_error('status'); ?>
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
                            <select name="gender" class="form-control" id="gender" value="<?php echo set_value('gender'); ?>">
                                <option value=""><?php echo get_phrase('select_gender'); ?></option>
                                <option value="male"<?php if($row['gender']=='male'){echo "selected";}?>><?php echo get_phrase('male'); ?></option>
                                <option value="female"<?php if($row['gender']=='female'){echo "selected";}?>><?php echo get_phrase('female'); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('date_of_birth'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="dob" class="form-control" id="dob" value="<?=$row['dob']?>" placeholder="<?php echo get_phrase('date_of_birth'); ?>" autocomplete="off">
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
                            <input type="text" name="address" class="form-control" id="address" value="<?=$row['address']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('profile_picture'); ?></label>

                        <div class="col-sm-5">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                    <img src="<?php echo base_url('uploads/receptionist_image/').$row['receptionist_id'].'.jpg'?>" alt="...">
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
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectCountry'];?></label> 

                        <div class="col-sm-8">
                            <select name="country" class="form-control" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value=""  onchange="return get_state(this.value)">
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
                                <select name="state" class="form-control" id="select_state"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value=""  onchange="return get_district(this.value)">
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
                                <select name="district" class="form-control" id="select_district"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value=""  onchange="return get_city(this.value)">
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
                                <select name="city" class="form-control" id="select_city"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value=""  >
                                    <option value=""><?php echo $this->lang->line('labels')['select_district_first'];?></option>
                                    <?php 
                                $admins = $this->db->get_where('city')->result_array();
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
                  
                     </div></div></div>
                
                    </div>
                     <div class="col-sm-3 control-label col-sm-offset-9">
                        <input type="submit" class="btn btn-success" value="Update">&nbsp;&nbsp;
                        <input type="button" class="btn btn-info" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
                    </div> 
                    </div>
   </form>
            
           
            <!----CREATION FORM ENDS-->
        </div>
    </div>
<?php } ?>





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
    
      function get_doctor(department_id) {

if(department_id == 'all'){
    var branch_id=$('#select_branch').val();
    $.ajax({
            url: '<?php echo base_url();?>index.php?superadmin/get_doctor/all/' + branch_id ,
            success: function(response)
            {
                jQuery('#select_doctor').html(response);
            }
        });
}else{
        $.ajax({
            url: '<?php echo base_url();?>index.php?superadmin/get_doctor/' + department_id ,
            success: function(response)
            {
                jQuery('#select_doctor').html(response);
            }
        });
}
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


