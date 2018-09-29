<?php 
$single_labs_info = $this->db->get_where('medicallabs', array('lab_id' => $id))->result_array();
foreach ($single_labs_info as $row) {
    
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
         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>index.php?superadmin/edit_labs/<?php echo $id ?>" method="post" enctype="multipart/form-data">
             
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
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email'); ?></label>

                        <div class="col-sm-8">
                            <input type="email" name="email" class="form-control" id="email"  data-validate="required" data-message-required="<?php echo 'Value_required';?>"value="<?=$row['email']?>">
                            <span ><?php echo form_error('email'); ?></span>
                        </div>
                    </div>
                       <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Phone_number'); ?></label>

                        <div class="col-sm-8">
                            <input type="number" name="phone_number" class="form-control" id="phone_number"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?=$row['phone']?>"  minlength="10" maxlength="10"> 
                            <span ><?php echo form_error('phone_number'); ?></span> 
                        </div>
                    </div>
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
                        <label for="field-2" class="col-sm-3 control-label "><?php echo ucfirst('hospital');?></label>
                        
                        <div class="col-sm-8">
                            <select name="hospital" class="form-control selectbox">
                              <option value=""><?php echo ucfirst('select_hospital');?></option>
                              <?php 
                                $admins = $this->db->get_where('hospitals',array('status'=>1))->result_array();
                               
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['hospital_id'] ?>"<?php if($row1['hospital_id']==$row['hospital']){echo 'selected';}?> ><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
                          
                          </select>
                          <span ><?php echo form_error('hospital'); ?></span>
                        </div> 
                    </div>
                    
                        <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label "><?php echo ucfirst('branch');?></label>
                        
                        <div class="col-sm-8">
                            <select name="branch" class="form-control selectbox">
                              <option value=""><?php echo ucfirst('select_branch');?></option>
                             <?php 
                                $admins = $this->db->get('branch')->result_array();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['branch_id'] ?>" <?php if($row1['branch_id']==$row['branch']){echo 'selected';}?>><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
                          </select>
                          <span ><?php echo form_error('branch'); ?></span>
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
    <div class="col-md-6">

        <div class="panel panel-primary" data-collapsed="0">
          <div class="panel-body">
                
                         
                    <div class="row">
                        <div class="col-sm-12">
                
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
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Date of birth'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="dob" class="form-control datepicker" id="dob" value="<?=$row['dob']?>">
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Incharge address'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="in_address" class="form-control" id="in_address" value="<?=$row['in_address']?>">
                        </div>
                    </div>
                    
                   
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo 'Photo';?></label>

                        <div class="col-sm-5">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                    <img src="<?php echo base_url(); ?>uploads/medical_stores_image/<?php echo $row['store_id']; ?>.jpg" alt="...">
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
                    </div>
                    <!--<div class="col-sm-3 control-label col-sm-offset-2">-->
                    <!--    <input type="submit" class="btn btn-success" value="Submit">-->
                    <!--</div>-->
                            
            </div>
            </div></div></div></div>
            <!----CREATION FORM ENDS-->
    
        
            <div class="tab-pane box" id="pro" style="padding: 5px">
                <div class="row">
    <div class="col-md-6">

        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-body">
                
                        
                    <div class="row">
                        <div class="col-md-12">
                 
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('qualification'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="qualification" class="form-control" id="qualification" value="<?=$row['qualification']?>">
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('profession'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="profession" class="form-control" id="profession"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?=$row['profession']?>">
                        </div>
                    </div> -->
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
 <div class="col-sm-3 control-label col-sm-offset-2">
                        <input type="submit" class="btn btn-success" value="Submit">
                    </div>   
 </form>
</div>

</div>
</div>
<?php }?>


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