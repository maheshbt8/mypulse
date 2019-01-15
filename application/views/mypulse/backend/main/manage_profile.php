<?php 
$this->session->set_userdata('last_page', current_url());
?>
<?php foreach($edit_data as $row): ?>
<div class="row">
    <div class="col-md-2">
            <center>
                         <?php
if($account_type == 'superadmin'){
  $img_type='superadmin_image';
}elseif($account_type == 'hospitaladmins'){
  $img_type='hospitaladmin_image';
}elseif($account_type == 'doctors'){
  $img_type='doctor_image';
}elseif($account_type == 'nurse'){
  $img_type='nurse_image';
}elseif($account_type == 'receptionist'){
  $img_type='receptionist_image';
}elseif($account_type == 'medicalstores'){
  $img_type='medical_stores';
}elseif($account_type == 'medicallabs'){
  $img_type='medical_labs';
}elseif($account_type == 'users'){
  $img_type='user_image';
}
if (file_exists('uploads/' . $img_type.'/' . $this->session->userdata('login_user_id') . '.jpg'))
      $image_url = base_url() . 'uploads/' . $img_type.'/' . $this->session->userdata('login_user_id') . '.jpg';
else
    $image_url = base_url() . 'uploads/user.jpg';
?>
            <img src="<?php echo $image_url;?>" class="img-circle" style="width: 60%;">
                <!-- <img src="<?php echo $this->crud_model->get_image_url('superadmin' , $row['superadmin_id']);?>" class="img-circle" style="width: 60%;"> -->
        <br>
        <h3><?php echo $row['name'];?></h3>
        <h4><?php echo $row['unique_id'];?></h4>
        <br>
        <h4><i class="fa fa-map-marker m-r-xs"></i>&nbsp;&nbsp;<?php echo $row['address'];?></h4>
        <h4><i class="fa fa-envelope m-r-xs"></i>&nbsp;&nbsp;<?php echo $row['email'];?></h4>
        <h4><i class="fa fa-phone m-r-xs"></i>&nbsp;&nbsp;<?php echo $row['phone'];?></h4>
      </center>
        </div>
   
    <div class="col-md-10">
        <?php if($account_type == 'superadmin'){?>
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
              
        </ul>
        <div class="panel panel-default">   
            <div class="panel-body">
        <!------CONTROL TABS END------>
         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/manage_profile/update_profile_info" method="post" enctype="multipart/form-data">
             
        <div class="tab-content">
           
        <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                
                <div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-8">
                    <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('middle_name');?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="mname" value="<?php echo $row['mname'];?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('last_name');?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="lname" value="<?php echo $row['lname'];?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="email" value="<?php echo $row['email'];?>" readonly=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="description" value="<?php echo $row['description'];?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('mobile_number');?></label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="phone" value="<?php echo $row['phone'];?>" minlength="10" maxlength="10" readonly=""/>
                            </div>
                        </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                    <img src="<?php echo $image_url;?>" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileinput-new"><?php echo get_phrase('select_profile'); ?></span>
                                        <span class="fileinput-exists"><?php echo get_phrase('change'); ?></span>
                                        <input type="file" name="userfile" id="userfile" accept="image/*">
                                    </span>
                                    <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('remove'); ?></a>
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
                            <select name="gender" class="form-control" id="gender" value="">
                                <option value=""><?php echo get_phrase('select_gender'); ?></option>
                                <option value="male"<?php if($row['gender']=='male'){echo "selected";}?>><?php echo get_phrase('male'); ?></option>
                                <option value="female"<?php if($row['gender']=='female'){echo "selected";}?>><?php echo get_phrase('female'); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Date of birth'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="dob" class="form-control" id="dob" value="<?=$row['dob']?>" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group" hidden="">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('aadhar'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="aadhar" class="form-control" id="aadhar" value="<?=$row['aadhar']?>">
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('address'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="address" class="form-control" id="address"value="<?=$row['address']?>">
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
            </div>
        </div>
    </div>
</div>
            <!----CREATION FORM ENDS-->
                       <div class="col-sm-3 control-label col-sm-offset-9">
                        <input type="submit" class="btn btn-success" value="<?php echo get_phrase('submit'); ?>">&nbsp;&nbsp;
                        <input type="button" class="btn btn-info" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
                    </div> 
                   
                
                    </div>
   </form>
</div>
</div>
<?php }else{
    if($account_type == 'hospitaladmins'){
    $edit_name='edit_hospital_admin';
    $data['admin_id']=$this->session->userdata('login_user_id');
    }elseif($account_type == 'doctors'){
    $edit_name='edit_doctor';
    $data['doctor_id']=$this->session->userdata('login_user_id');
    }elseif($account_type == 'nurse'){
    $edit_name='edit_nurse';
    $data['nurse_id']=$this->session->userdata('login_user_id');
    }elseif($account_type == 'receptionist'){
    $edit_name='edit_receptionist';
    $data['receptionist_id']=$this->session->userdata('login_user_id');
    }elseif($account_type == 'medicalstores'){
    $edit_name='edit_stores';
    $data['id']=$this->session->userdata('login_user_id');
    }elseif($account_type == 'medicallabs'){
    $edit_name='edit_labs';
    $data['id']=$this->session->userdata('login_user_id');
    }elseif($account_type == 'users'){
    $edit_name='edit_user';
    $data['id']=$this->session->userdata('login_user_id');
    }
    $this->load->view('backend/main/'.$edit_name,$data);
}?>

    </div>
</div>
	
 <?php
                endforeach;
                ?>


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