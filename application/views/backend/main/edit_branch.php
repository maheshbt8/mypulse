<?php 
$row=$this->db->get_where('branch',array('branch_id'=>$branch_id))->row_array(); 
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">  
            <div class="panel-body">
                <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/branch/update/<?php echo $branch_id; ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                    <?php if($account_type=='superadmin'){?>
                    <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo 'Hospital';?></label> 

                        <div class="col-sm-8">
                            <select name="hospital" class="form-control select2" data-validate="required" data-message-required="<?php echo 'Value Required';?>" value=""<?php if($row['isDeleted']=='2'){echo "disabled";}?>>
                                <option value=""><?php echo 'Select Hospital';?></option>
                                <?php  
                                $admins = $this->db->get_where('hospitals', array('status' => 1,'isDeleted'=>1))->result_array();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['hospital_id'] ?>"<?php if($row1['hospital_id']==$row['hospital_id']){echo "selected";}?>><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
                               
                            </select>
                        </div>
                    </div>
                    <?php }elseif($account_type=='hospitaladmins'){?>
                <input type="hidden" name="hospital" value="<?php echo $row['hospital_id'];?>"/>
                <?php }?>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo 'Branch';?></label>

                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" id="field-1" data-validate="required" data-message-required="<?php echo 'Value Required';?>" value="<?php echo $row['name']; ?>" <?php if($row['isDeleted']=='2'){echo "disabled";}?>>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo 'Email';?></label>

                        <div class="col-sm-8">
                            <input type="text" name="email" class="form-control" id="field-3"  data-validate="required" data-message-required="<?php echo 'Value Required';?>" value="<?php echo $row['email']; ?>"<?php if($row['isDeleted']=='2'){echo "disabled";}?>>
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['phone_number'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="phone_number" class="form-control" id="field-4"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo $row['phone']; ?>"<?php if($row['isDeleted']=='2'){echo "disabled";}?>>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['address'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="address" class="form-control" id="field-2"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?php echo $row['address'];?>"<?php if($row['isDeleted']=='2'){echo "disabled";}?>>
                        </div>
                    </div>
                  
                 </div>
                 <div class="col-sm-6">
                   <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectCountry'];?></label> 

                        <div class="col-sm-8">
                            <select name="country" class="form-control select2" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value=""  onchange="return get_state(this.value)"<?php if($row['isDeleted']=='2'){echo "disabled";}?>>
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
                                <select name="state" class="form-control select2" id="select_state"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value=""  onchange="return get_district(this.value)"<?php if($row['isDeleted']=='2'){echo "disabled";}?>>
                                    <option value=""><?php echo 'Select State';?></option>
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
                                <select name="district" class="form-control select2" id="select_district"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value=""  onchange="return get_city(this.value)"<?php if($row['isDeleted']=='2'){echo "disabled";}?>>
                                    <option value=""><?php echo 'select District';?></option>
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
                                <select name="city" class="form-control select2" id="select_city"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="" <?php if($row['isDeleted']=='2'){echo "disabled";}?>>
        <option value=""><?php echo 'Select City';?></option>
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
                    <div class="col-sm-3 control-label col-sm-offset-9">
 <?php if(($account_type=='superadmin' || $account_type=='hospitaladmins')&& $row['isDeleted']=='1'){?><input type="submit" class="btn btn-success" value="Update"><?php }?>&nbsp;&nbsp;
                        <input type="button" class="btn btn-info" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>





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