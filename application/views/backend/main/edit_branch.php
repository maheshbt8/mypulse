<?php 
$row=$this->db->get_where('branch',array('branch_id'=>$branch_id))->row_array(); 
?>
<div class="row">
    <div class="col-md-12">
        <?php if($row['row_status_cd']=='0'){?>
<div class="alert alert-danger">
  <strong>Branch Deleted</strong>
</div>
<?php }?>
        <div class="panel panel-primary" data-collapsed="0">  
            <div class="panel-body">
                <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/branch/update/<?php echo $branch_id; ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                
                    <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo 'Hospital';?></label> 

                        <div class="col-sm-8">
                            <select name="hospital" id="hospital_id" class="form-control select2" data-validate="required" data-message-required="<?php echo 'Value Required';?>" value=""<?php if($account_type!='superadmin' || $row['row_status_cd']=='0'){echo "disabled";}?>>
                                <option value=""><?php echo 'Select Hospital';?></option>
                                <?php  
                                $admins = $this->crud_model->select_all_hospitals();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['hospital_id'] ?>"<?php if($row1['hospital_id']==$row['hospital_id']){echo "selected";}?>><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
                               
                            </select>
                        </div>
                    </div>
                    <?php   if($account_type=='hospitaladmins'){?>
                <input type="hidden" name="hospital" value="<?php echo $row['hospital_id'];?>"/>
                <?php }?>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo 'Branch Name';?></label>
                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" id="field-1" data-validate="required" data-message-required="<?php echo 'Value Required';?>" value="<?php echo $row['branch_name']; ?>" <?php if($account_type=='users' || $row['row_status_cd']=='0'){echo "disabled";}?>>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo 'Email';?></label>

                        <div class="col-sm-8">
                            <input type="text" name="email" class="form-control" id="field-3"  data-validate="required" data-message-required="<?php echo 'Value Required';?>" value="<?php echo $row['email']; ?>"<?php if($account_type=='users' || $row['row_status_cd']=='0'){echo "disabled";}?>>
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">Phone Number</label>

                        <div class="col-sm-8">
                            <input type="text" name="phone_number" class="form-control" id="field-4"  data-validate="required" data-message-required="Value Required" value="<?php echo $row['phone']; ?>"<?php if($account_type=='users' || $row['row_status_cd']=='0'){echo "disabled";}?>>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">Address</label>

                        <div class="col-sm-8">
                            <input type="text" name="address" class="form-control" id="address"  data-validate="required" data-message-required="Value Required" value="<?php echo $row['address'];?>"<?php if($account_type=='users' || $row['row_status_cd']=='0'){echo "disabled";}?>>
                            <span id="location-get-latlng">
                            <input type="hidden" name="latitude" id="lat" value="<?=$row['latitude']?>">
                            <input type="hidden" name="longitude" id="lng" value="<?=$row['longitude']?>">
                        </span>
                            <input type="button" class="btn btn-info btn-sm" value="Get Current location" onclick="getLocation()" />
                        </div>
                    </div>
                  
                 </div>
                 <div class="col-sm-6">
                   <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label">Country</label> 
                        <div class="col-sm-8">
                            <select name="country" class="form-control select2" data-validate="required" data-message-required="Value Required" value="" onchange="return get_state(this.value)"<?php if($account_type=='users' || $row['row_status_cd']=='0'){echo "disabled";}?>>
                                <option value="">Select Country</option>
                                <?php 
                                $admins = $this->crud_model->select_country();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['country_id'] ?>" <?php if($row1['country_id'] == $row['country_id']){echo 'selected';}?>><?php echo $row1['country_name'] ?></option>
                                
                                <?php } ?>
                               
                            </select>
                        </div>
                    </div> 
                    
                    
                       <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectState'];?></label>
                            <div class="col-sm-8">
                                <select name="state" class="form-control select2" id="state"  data-validate="required" data-message-required="Value Required" value=""  onchange="return get_district(this.value)"<?php if($account_type=='users' || $row['row_status_cd']=='0'){echo "disabled";}?>>
                                    <option value=""><?php echo 'Select State';?></option>
                                    <?php 
                                $admins = $this->crud_model->select_state();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['state_id'] ?>" <?php if($row1['state_id'] == $row['state_id']){echo 'selected';}?>><?php echo $row1['state_name'] ?></option>
                                
                                <?php } ?>
                                </select>   
                            </div>
                    </div>
                    
                    
                       <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectDistrict'];?></label>
                            <div class="col-sm-8">
                                <select name="district" class="form-control select2" id="district"  data-validate="required" data-message-required="Value Required" value=""  onchange="return get_city(this.value)"<?php if($account_type=='users' || $row['row_status_cd']=='0'){echo "disabled";}?>>
                                    <option value=""><?php echo 'select District';?></option>
                                    <?php 
                                $admins = $this->crud_model->select_district();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['district_id'] ?>" <?php if($row1['district_id'] == $row['district_id']){echo 'selected';}?>><?php echo $row1['dist_name'] ?></option>
                                
                                <?php } ?>
                                </select>
                            </div>   
                    </div>
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectCity'];?></label>
                            <div class="col-sm-8">
                                <select name="city" class="form-control select2" id="city"  data-validate="required" data-message-required="Value Required" value="" <?php if($account_type=='users' || $row['row_status_cd']=='0'){echo "disabled";}?>>
        <option value=""><?php echo 'Select City';?></option>
                                    <?php 
                                $admins = $this->crud_model->select_city();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['city_id'] ?>" <?php if($row1['city_id'] == $row['city_id']){echo 'selected';}?>><?php echo $row1['city_name'] ?></option>
                                <?php } ?>
                                </select>
                            </div>
                    </div>
                    <div class="form-group"> 
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('status'); ?></label>

                        <div class="col-sm-8">
                            <select name="status" class="form-control" id="status" value="" <?php if($account_type=='users' || $row['row_status_cd']=='0'){echo "disabled";}?>>
                                <option value=""><?php echo get_phrase('select_status'); ?></option>
                                <option value="1" <?php if($row['row_status_cd']==1){echo 'selected';}?>><?php echo get_phrase('active'); ?></option>
                                <option value="2" <?php if($row['row_status_cd']==2){echo 'selected';}?>><?php echo get_phrase('inactive'); ?></option>
                            </select>
                            <span ><?php echo form_error('status'); ?></span>
                        </div>
                    </div>
                   </div>
                
                    </div>
                    <div class="col-sm-3 control-label col-sm-offset-9">
 <?php if(($account_type=='superadmin' || $account_type=='hospitaladmins')&& $row['row_status_cd']!='0'){?><input type="submit" class="btn btn-success" value="Update"><?php }?>&nbsp;&nbsp;
                        <input type="button" class="btn btn-info" value="<?php if(($account_type=='superadmin' || $account_type=='hospitaladmins')&& $row['row_status_cd']!='0'){echo get_phrase('cancel');}else{echo get_phrase('close');} ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>




<!-- 
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

</script> -->