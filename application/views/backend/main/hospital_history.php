<?php 
$account_type=$this->session->userdata('login_type');?>
<?php
/*$hospital_id=$this->crud_model->generate_decryption_key($hospital_id);*/
if($this->session->userdata('hospital_id')==$hospital_id || $account_type=='superadmin'){
 $single_hospital_info = $this->crud_model->select_hospital_info_by_id($hospital_id);
foreach ($single_hospital_info as $row) :  
?>
    <div class="col-md-12">
        <!-- <input type="button" class="btn btn-info pull-right" value="<?php echo get_phrase('close'); ?>" onclick="window.location.href = '<?php if($account_type=='hospitaladmins'){echo $this->session->userdata('last_page1');}else{echo $this->session->userdata('last_page');} ?>'"> -->
        <?php if($account_type!='hospitaladmins'){?>
        <input type="button" class="btn btn-info pull-right" value="<?php echo get_phrase('close'); ?>" onclick="window.location.href = '<?=$this->session->userdata('last_page');?>'">
    <?php }?>
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab1" data-toggle="tab" class="btn btn-default">
                    <span class="visible-xs"><i class="entypo-home"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('hospital_info'); ?></span>
                </a>
            </li>
            <?php if($account_type!='users'){ ?>
            <!--  <li class="">
                <a href="#tab2" data-toggle="tab" class="btn btn-default">
                    <span class="visible-xs"><i class="entypo-user"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('license_info'); ?></span>
                </a>
            </li> -->
           <li class="">
                <a href="#tab3" data-toggle="tab" class="btn btn-default">
                    <span class="visible-xs"><i class="entypo-mail"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('branches'); ?></span>
                </a>
            </li> 
            <li class="">
                <a href="#tab4" data-toggle="tab" class="btn btn-default">
                    <span class="visible-xs"><i class="entypo-mail"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('departments'); ?></span>
                </a>
            </li> 
            <?php if($license_category=='' || $license_category=='MPHL_19002'){ ?>
            <li class="">
                <a href="#tab5" data-toggle="tab" class="btn btn-default">
                    <span class="visible-xs"><i class="entypo-mail"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('wards'); ?></span>
                </a>
            </li> 
            <li class="">
                <a href="#tab6" data-toggle="tab" class="btn btn-default">
                    <span class="visible-xs"><i class="entypo-mail"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('beds'); ?></span>
                </a>
            </li>
            <?php }
            ?>
            <li class="">
                <a href="#tab7" data-toggle="tab" class="btn btn-default">
                    <span class="visible-xs"><i class="entypo-mail"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('medical_stores'); ?></span>
                </a>
            </li> 
            <li class="">
                <a href="#tab8" data-toggle="tab" class="btn btn-default">
                    <span class="visible-xs"><i class="entypo-mail"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('medical_labs'); ?></span>
                </a>
            </li>
        <?php }?> 
        </ul>
<div class="panel panel-default">
            <div class="panel-body">
        <div class="tab-content">
            <?php
$country_info=$this->db->get('country')->result_array();
$single_hospital_info = $this->db->get_where('hospitals', array('hospital_id' => $hospital_id))->result_array();
foreach ($single_hospital_info as $row) {
?>
            <div class="tab-pane box active" id="tab1">
                <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>Hospital_Edit/<?=$row['hospital_id'];?>" method="post" enctype="multipart/form-data">
                <div class="row">
    <div class="col-md-12">
        <label class="control-label">Basic Info</label>
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                      <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" id="name" value="<?php echo $row['name']; ?>" <?php if($account_type != 'superadmin' && $account_type != 'hospitaladmins'){ echo 'disabled';}?>>
                            <span style="color: red"><?php echo form_error('name'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>

                        <div class="col-sm-8">
                            <input type="text" name="description" class="form-control" id="description" value="<?php echo $row['description']; ?>" <?php if($account_type != 'superadmin' && $account_type != 'hospitaladmins'){ echo 'disabled';}?>>
                        </div>
                    </div>
                   <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('address'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="address" class="form-control" id="address" value="<?php echo $row['address']; ?>" <?php if($account_type != 'superadmin' && $account_type != 'hospitaladmins'){ echo 'disabled';}?>>
                            <span style="color: red"><?php echo form_error('address'); ?></span>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email'); ?></label>

                        <div class="col-sm-8">
                            <input type="email" name="email" class="form-control" id="email" value="<?php echo $row['email']; ?>" <?php if($account_type != 'superadmin' && $account_type != 'hospitaladmins'){ echo 'disabled';}?>>
                            <span style="color: red"><?php echo form_error('email'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('phone_number'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="phone_number" class="form-control" id="phone_number" value="<?php echo $row['phone_number']; ?>" <?php if($account_type != 'superadmin' && $account_type != 'hospitaladmins'){ echo 'disabled';}?>>
                            <span style="color: red"><?php echo form_error('phone_number'); ?></span>
                        </div>
                    </div>
                <div class="form-group"> 
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('status'); ?></label>

                        <div class="col-sm-8">
                            <select name="status" class="form-control" id="status" value="" <?php if($account_type != 'superadmin' && $account_type != 'hospitaladmins'){ echo 'disabled';}?>>
                                <option value=""><?php echo get_phrase('select_status'); ?></option>
                                <option value="1" <?php if($row['status']==1){echo 'selected';}?>><?php echo get_phrase('active'); ?></option>
                                <option value="2" <?php if($row['status']==2){echo 'selected';}?>><?php echo get_phrase('inactive'); ?></option>
                            </select>
                            <span ><?php echo form_error('status'); ?></span>
                        </div>
                    </div>
                  
                   
                </div>
                <div class="col-sm-6">
                      <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('owner/MD_name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="md_name" class="form-control" id="md_name" value="<?php echo $row['md_name']; ?>" <?php if($account_type != 'superadmin' && $account_type != 'hospitaladmins'){ echo 'disabled';}?>>
                            <span ><?php echo form_error('md_name'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('owner/MD_phone_number'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="md_phone" class="form-control" id="md_phone" value="<?php echo $row['md_contact_number']; ?>" <?php if($account_type != 'superadmin' && $account_type != 'hospitaladmins'){ echo 'disabled';}?>>
                            <span ><?php echo form_error('md_phone'); ?></span>
                        </div>
                    </div>
                     <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('country'); ?></label> 

                        <div class="col-sm-8">
                            <select name="country" class="form-control select2" id="country" onchange="return get_state(this.value)" <?php if($account_type != 'superadmin' && $account_type != 'hospitaladmins'){ echo 'disabled';}?>>
                                <option value=""><span ><?php echo get_phrase('select_country'); ?></span></option>
                                <?php 
                                $admins = $this->db->get('country')->result_array();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['country_id'] ?>" <?php if($row1['country_id'] == $row['country']){echo 'selected';}?>><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
                               
                            </select>
                            <span ><?php echo form_error('country'); ?></span>
                        </div>
                    </div> 
                    
                    
                       <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('state'); ?></label>
                            <div class="col-sm-8">
                                <select name="state" class="form-control select2" id="state" onchange="return get_district(this.value)" <?php if($account_type != 'superadmin' && $account_type != 'hospitaladmins'){ echo 'disabled';}?>>
                                    <option value=""><span ><?php echo get_phrase('select_country_first'); ?></span></option>
                                    <?php 
                                $state = $this->db->where('country_id',$row['country'])->get('state')->result_array();
                                foreach($state as $row2){?>
                                <option value="<?php echo $row2['state_id'] ?>" <?php if($row2['state_id'] == $row['state']){echo 'selected';}?>><?php echo $row2['name'] ?></option>
                                
                                <?php } ?>
                                </select>   
                                <span ><?php echo form_error('state'); ?></span>
                            </div>
                    </div>
                    
                    
                       <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('district'); ?></label>
                            <div class="col-sm-8">
                                <select name="district" class="form-control select2" id="district" onchange="return get_city(this.value)" <?php if($account_type != 'superadmin' && $account_type != 'hospitaladmins'){ echo 'disabled';}?>>
                                    <option value=""><span ><?php echo form_error('select_state_first'); ?></span></option>
                                    <?php 
                                $district = $this->db->where('state_id',$row['state'])->get('district')->result_array();
                                foreach($district as $row3){?>
                                <option value="<?php echo $row3['district_id'] ?>" <?php if($row3['district_id'] == $row['district']){echo 'selected';}?>><?php echo $row3['name'] ?></option>
                                
                                <?php } ?>
                                </select>
                                <span ><?php echo form_error('district'); ?></span>
                            </div>   
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('city'); ?></label>
                            <div class="col-sm-8">
                                <select name="city" class="form-control select2" id="city" <?php if($account_type != 'superadmin' && $account_type != 'hospitaladmins'){ echo 'disabled';}?>>
                                    <option value=""><span ><?php echo form_error('select_district_first'); ?></span></option>
                                    <?php 
                                $admins = $this->db->where('district_id',$row['district'])->get('city')->result_array();
                                foreach($admins as $row4){
                                    ?>
                                <option value="<?php echo $row4['city_id'] ?>" <?php if($row4['city_id'] == $row['city']){echo 'selected';}?>><?php echo $row4['name'] ?></option>
                                <?php } ?>
                                </select>
                                <span ><?php echo form_error('city'); ?></span>
                            </div>
                    </div>

              </div>
             <!--  <div class="col-sm-3 control-label col-sm-offset-9">
                <?php if($account_type == 'superadmin' || $account_type == 'hospitaladmins'){?>
                        <input type="submit" class="btn btn-success" value="Update"><?php }?>
                    </div> -->
                    </div>
                   

            </div>

        </div>

    </div>
    
</div>
<!-- </div>
            <div class="tab-pane box" id="tab2" style="padding: 5px"> -->
                    <div class="row">
    <div class="col-md-12">
<label class="control-label">License Info</label>
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-body">
                    <div class="row">
                        <?php if($account_type=='superadmin' || $account_type=='hospitaladmins'){?>
                        <div class="col-sm-6">
                
                         <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('license'); ?></label> 

                        <div class="col-sm-8">
                        
                        <select name="license" class="form-control select2" id="license" value="" <?php if($account_type!='superadmin'){echo 'disabled';}?>>
                                <option value=""><?php echo get_phrase('select_lisense'); ?></option>
                                <?php 
                                $license = $this->db->get_where('license')->result_array();
                                foreach($license as $row1){?>
                                <option value="<?php echo $row1['license_id'] ?>"<?php if($row['license']== $row1['license_id'] ){ echo 'selected';} ?>><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
                               
                        </select>
                        
                        </div>
                    </div> 
                   <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('license status'); ?></label>

                        <div class="col-sm-8">
                        
                        <select name="license_status" class="form-control" id="license_status" value=""<?php if($account_type!='superadmin'){echo 'disabled';}?>>
                                <option value=""><?php echo get_phrase('select_status'); ?></option>
                                <option value="1" <?php if($row['license_status']==1){echo 'selected';}?>><?php echo get_phrase('active'); ?></option>
                                <option value="2" <?php if($row['license_status']==2){echo 'selected';}?>><?php echo get_phrase('inactive'); ?></option>
                        </select>
                      
                        </div>
                    </div>        
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('from_date'); ?></label>
                        <div class="col-sm-8">
                       
                            <input type="text" name="from_date" class="form-control" id="from_date" value="<?php echo  $row['from_date'] ?>" autocomplete="off"<?php if($account_type!='superadmin'){echo 'disabled';}?>>
                        
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('to_date'); ?></label>

                        <div class="col-sm-8">
                           
                            <input type="text" name="till_date" class="form-control" id="till_date" value="<?php echo $row['till_date']?>" autocomplete="off"<?php if($account_type!='superadmin'){echo 'disabled';}?>>
                        
                        </div>
                    </div>
                   
                </div>
            <?php }?>
                <div class="col-sm-6">
                <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo 'Logo';?></label>

                        <div class="col-sm-5">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                    <img src="data:image/gif;base64,<?=$this->crud_model->get_hospitals_logo_url($row['hospital_id']);?>">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileinput-new">Select Logo</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="userfile" accept="image/*" id="userfile" <?php if($account_type!='superadmin' && $account_type!='hospitaladmins'){echo 'disabled';}?>>
                                    </span>
                                    <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    </div>
  <?php if($account_type=='hospitaladmins'){?>
<input type="hidden" name="license" value="<?php echo $row['license'];?>"/>
<input type="hidden" name="license_status" value="<?php echo $row['license_status'];?>"/>
<input type="hidden" name="from_date" value="<?php echo $row['from_date'];?>"/>
<input type="hidden" name="till_date" value="<?php echo $row['till_date'];?>"/>
<?php }?>                
            </div>
            </div>
          
        </div>

    </div>
    <div class="col-sm-3 control-label col-sm-offset-9">
                    <?php if($account_type == 'superadmin'||$account_type == 'hospitaladmins'){?>
                        <input type="submit" class="btn btn-success" value="Update">
                    <?php }?>
                    </div>
    </form>
</div>
            <div class="tab-pane" id="tab3">
                <?php $data['account_type']=$account_type;$data['branch_info']=$this->crud_model->select_branch_info_by_hospital_id($row['hospital_id']);
                $this->load->view('backend/main/manage_branch',$data);?>
            </div>
            <div class="tab-pane" id="tab4">
                <?php $data['account_type']=$account_type;$data['department_info']=$this->crud_model->select_department_info_by_hospital_id($row['hospital_id']);
                $this->load->view('backend/main/manage_department',$data);?>
            </div>
            <div class="tab-pane" id="tab5">
        <?php $data['account_type']=$account_type;$data['ward_info']=$this->crud_model->select_ward_info_by_hospital_id($row['hospital_id']);
                $this->load->view('backend/main/manage_ward',$data);?>
            </div>
            <div class="tab-pane" id="tab6">
        <?php $data['account_type']=$account_type;$data['bed_info']=$this->crud_model->select_bed_info_by_hospital_id($row['hospital_id']);
                $this->load->view('backend/main/manage_bed',$data);?>
            </div>
            <div class="tab-pane" id="tab7">
        <?php   $data['account_type']=$account_type;
        $data['store_info']=$this->crud_model->select_store_info_by_hospital_id($row['hospital_id']);
        $this->load->view('backend/main/manage_stores',$data);?>
            </div>
            <div class="tab-pane" id="tab8">
        <?php $data['account_type']=$account_type;
        $data['lab_info']=$this->crud_model->select_lab_info_by_hospital_id($row['hospital_id']);
                $this->load->view('backend/main/manage_labs',$data);?>
            </div>
        
        </div>
</div>
</div>
  </div>  

    <?php } ?>
<?php endforeach; ?>
<?php }else{
    //redirect('404_override');
    $this->load->view('four_zero_four');
}?>
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

<script type="text/javascript">
                    $(document).ready(function(){
                    var date = new Date();
                    date.setDate(date.getDate());

                    $('#from_date').datepicker({ 
                    startDate: date

                    });

                    $('#till_date').datepicker({ 
                    startDate: date

                    });

                    } );                  

</script>
