<?php
$country_info=$this->db->get('country')->result_array();
$single_hospital_info = $this->db->get_where('hospitals', array('hospital_id' => $hospital_id))->result_array();
foreach ($single_hospital_info as $row) {
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
                    <?php echo get_phrase('license_info'); ?>
                </a>
            </li>
              
        </ul>
        <!------CONTROL TABS END------>
         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>index.php?superadmin/edit_hospital/<?php echo $row['hospital_id']; ?>" method="post" enctype="multipart/form-data">
             
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
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" id="name" value="<?php echo $row['name']; ?>">
                            <span style="color: red"><?php echo form_error('name'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>

                        <div class="col-sm-8">
                            <input type="text" name="description" class="form-control" id="description" value="<?php echo $row['description']; ?>">
                        </div>
                    </div>
                   <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('address'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="address" class="form-control" id="address" value="<?php echo $row['address']; ?>">
                            <span style="color: red"><?php echo form_error('address'); ?></span>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email'); ?></label>

                        <div class="col-sm-8">
                            <input type="email" name="email" class="form-control" id="email" value="<?php echo $row['email']; ?>">
                            <span style="color: red"><?php echo form_error('email'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('phone_number'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="phone_number" class="form-control" id="phone_number" value="<?php echo $row['phone_number']; ?>">
                            <span style="color: red"><?php echo form_error('phone_number'); ?></span>
                        </div>
                    </div>
                <div class="form-group"> 
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('status'); ?></label>

                        <div class="col-sm-8">
                            <select name="status" class="form-control" id="status" value="">
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
                            <input type="text" name="md_name" class="form-control" id="md_name" value="<?php echo $row['md_name']; ?>">
                            <span ><?php echo form_error('md_name'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('owner/MD_phone_number'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="md_phone" class="form-control" id="md_phone" value="<?php echo $row['md_contact_number']; ?>">
                            <span ><?php echo form_error('md_phone'); ?></span>
                        </div>
                    </div>
                     <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('country'); ?></label> 

                        <div class="col-sm-8">
                            <select name="country" class="form-control" id="country" onchange="return get_state(this.value)">
                                <option value=""><span ><?php echo get_phrase('select_country'); ?></span></option>
                                <?php 
                                $admins = $this->db->get_where('country')->result_array();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['country_id'] ?>" <?php if($row1['country_id'] == $row['country']){echo 'selected';}?>><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
                               
                            </select>
                            <span ><?php echo form_error('country'); ?></span>
                        </div>
                    </div> 
                    
                    
                       <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('select_state'); ?></label>
                            <div class="col-sm-8">
                                <select name="state" class="form-control" id="state" onchange="return get_district(this.value)">
                                    <option value=""><span ><?php echo get_phrase('select_country_first'); ?></span></option>
                                    <?php 
                                $admins = $this->db->get_where('state')->result_array();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['state_id'] ?>" <?php if($row1['state_id'] == $row['state']){echo 'selected';}?>><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
                                </select>   
                                <span ><?php echo form_error('state'); ?></span>
                            </div>
                    </div>
                    
                    
                       <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('district'); ?></label>
                            <div class="col-sm-8">
                                <select name="district" class="form-control" id="district" onchange="return get_city(this.value)">
                                    <option value=""><span ><?php echo form_error('select_state_first'); ?></span></option>
                                    <?php 
                                $admins = $this->db->get_where('district')->result_array();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['district_id'] ?>" <?php if($row1['district_id'] == $row['district']){echo 'selected';}?>><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
                                </select>
                                <span ><?php echo form_error('district'); ?></span>
                            </div>   
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo form_error('city'); ?></label>
                            <div class="col-sm-8">
                                <select name="city" class="form-control" id="city">
                                    <option value=""><span ><?php echo form_error('select_district_first'); ?></span></option>
                                    <?php 
                                $admins = $this->db->get_where('city')->result_array();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['city_id'] ?>" <?php if($row1['city_id'] == $row['city']){echo 'selected';}?>><?php echo $row1['name'] ?></option>
                                <?php } ?>
                                </select>
                                <span ><?php echo form_error('city'); ?></span>
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
    <div class="col-md-6">

        <div class="panel panel-primary" data-collapsed="0">


            <div class="panel-body">
                
                         
                    <div class="row">
                        <div class="col-sm-12">
                
                         <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('license'); ?></label> 

                        <div class="col-sm-8">
                            <select name="license" class="form-control" id="license" value="">
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
                            <select name="license_status" class="form-control" id="license_status" value="">
                                <option value=""><?php echo get_phrase('select_status'); ?></option>
                                <option value="1" <?php if($row['status']==1){echo 'selected';}?>><?php echo get_phrase('active'); ?></option>
                                <option value="2" <?php if($row['status']==2){echo 'selected';}?>><?php echo get_phrase('inactive'); ?></option>
                            </select>
                        </div>
                    </div>
                    
                    
                            
                             <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('from_date'); ?></label>

                        <div class="col-sm-8">
                            <input type="date" name="from_date" class="form-control" id="from_date" value="<?php echo  $row['from_date'] ?>">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('to_date'); ?></label>

                        <div class="col-sm-8">
                            <input type="date" name="till_date" class="form-control" id="till_date" value="<?php echo $row['till_date']?>">
                        </div>
                    </div>
                   
                </div>
                    </div>
                  
            </div>
            </div></div></div></div>
            <!----CREATION FORM ENDS-->

                
                    </div>
                     <div class="col-sm-3 control-label col-sm-offset-2">
                        <input type="submit" class="btn btn-success" value="<?php echo $this->lang->line('buttons')['submit'];?>">
                    </div> 
                   
   </form>
            
          
            <!----CREATION FORM ENDS-->
        
    </div>
</div>


<?php } ?>




<script type="text/javascript">

	
	function get_state(country_id) {
    
    	$.ajax({
            url: '<?php echo base_url();?>index.php?superadmin/get_state/' + country_id ,
            success: function(response)
            {
                jQuery('#state').html(response);
            } 
        });

    }
    
    function get_city(state_id) {

    	$.ajax({
            url: '<?php echo base_url();?>index.php?superadmin/get_city/' + state_id ,
            success: function(response)
            {
                jQuery('#city').html(response);
            }
        });   

    }
    
     function get_district(city_id) {

    	$.ajax({
            url: '<?php echo base_url();?>index.php?superadmin/get_district/' + city_id ,
            success: function(response)
            {
                jQuery('#district').html(response);
            }
        });

    }

</script>