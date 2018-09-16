<?php
$country_info=$this->db->get('country')->result_array();
$single_hospital_info = $this->db->get_where('hospitals', array('hospital_id' => $hospital_id))->result_array();
foreach ($single_hospital_info as $row) {
?>
 <div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
					Add Hospital</div>
            </div>
			<div class="panel-body">

                <form action="<?php echo base_url(); ?>index.php?superadmin/hospital/update/<?php echo $row['hospital_id']; ?>" class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate="novalidate">
<div class="row">
    <div class="col-md-6">

        <div class="panel panel-primary" data-collapsed="0">     

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_general_info'); ?></h3>
                </div>
            </div>
            <div class="panel-body">

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" id="field-1" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo $row['name']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="description" class="form-control" id="field-10" value="<?php echo $row['description']; ?>">
                        </div>
                    </div>
                   <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('address'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="address" class="form-control" id="field-2"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo $row['address']; ?>">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="email" class="form-control" id="field-3"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo $row['email']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('phone_number'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="phone_number" class="form-control" id="field-4"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo $row['phone_number']; ?>">
                        </div>
                    </div>
                    
                     <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('country'); ?></label> 

                        <div class="col-sm-8">
                            <select name="country" class="form-control" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value=""  onchange="return get_state(this.value)">
                                <option value=""><?php echo get_phrase('select_country'); ?></option>
                                <?php 
                                $admins = $this->db->get_where('country')->result_array();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['country_id'] ?>" <?php if($row1['country_id'] == $row['country']){echo 'selected';}?>><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
                               
                            </select>
                        </div>
                    </div> 
                    
                    
                       <div class="form-group">
						<label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('state'); ?></label>
		                    <div class="col-sm-8">
		                        <select name="state" class="form-control" id="select_state"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value=""  onchange="return get_district(this.value)">
		                            <option value=""><?php echo get_phrase('select_country_first');?></option>
                                    <?php 
                                $admins = $this->db->get_where('state')->result_array();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['state_id'] ?>" <?php if($row1['state_id'] == $row['state']){echo 'selected';}?>><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
			                    </select>   
			                </div>
					</div>
					
					
					   <div class="form-group">
						<label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('district'); ?></label>
		                    <div class="col-sm-8">
		                        <select name="city" class="form-control" id="select_district"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value=""  onchange="return get_city(this.value)">
		                            <option value=""><?php echo get_phrase('select_state_first');?></option>
		                            <?php 
                                $admins = $this->db->get_where('district')->result_array();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['district_id'] ?>" <?php if($row1['district_id'] == $row['district']){echo 'selected';}?>><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
			                    </select>
			                </div>   
					</div>
					
					<div class="form-group">
						<label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('city'); ?></label>
		                    <div class="col-sm-8">
		                        <select name="city" class="form-control" id="select_city"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value=""  >
		                            <option value=""><?php echo get_phrase('select_district_first');?></option>
                                    <?php 
                                $admins = $this->db->get_where('city')->result_array();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['city_id'] ?>" <?php if($row1['city_id'] == $row['city']){echo 'selected';}?>><?php echo $row1['name'] ?></option>
                                <?php } ?>
			                    </select>
			                </div>
					</div>
                   
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Owner/MD Name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="md_name" class="form-control" id="field-8"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo $row['md_name']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Owner/MD Phone_number'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="md_phone" class="form-control" id="field-9"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo $row['md_contact_number']; ?>">
                        </div>
                    </div>
                <div class="form-group"> 
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('status'); ?></label>

                        <div class="col-sm-8">
                            <select name="status" class="form-control" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                                <option value=""><?php echo get_phrase('select_status'); ?></option>
                                <option value="1" <?php if($row['status']==1){echo 'selected';}?>><?php echo get_phrase('active'); ?></option>
                                <option value="2" <?php if($row['status']==2){echo 'selected';}?>><?php echo get_phrase('inactive'); ?></option>
                            </select>
                        </div>
                    </div>
				</div>

                    
                 </div>
                 </div>
                 <div class="col-md-6">

                  <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_liscense_info'); ?></h3>
                </div>
            </div>
            <div class="panel-body">
		 <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('license'); ?></label> 

                        <div class="col-sm-8">
                            <select name="license" class="form-control" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
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
                            <select name="license_status" class="form-control" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                                <option value=""><?php echo get_phrase('select_status'); ?></option>
                                <option value="1" <?php if($row['status']==1){echo 'selected';}?>><?php echo get_phrase('active'); ?></option>
                                <option value="2" <?php if($row['status']==2){echo 'selected';}?>><?php echo get_phrase('inactive'); ?></option>
                            </select>
                        </div>
                    </div>
                    
                    
                            
                             <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('From Date'); ?></label>

                        <div class="col-sm-8">
                            <input type="date" name="from_date" class="form-control" id="field-5"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo  $row['from_date'] ?>">
                        </div>
                    </div>
                            
                   
                        
                        
                        
                     
                             <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Till Date'); ?></label>

                        <div class="col-sm-8">
                            <input type="date" name="till_date" class="form-control" id="field-5"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo $row['till_date']?>">
                        </div>
                    </div>    
                 </div>
                 
                 
                 
                 
                 
                 
                 
                 </div>
                 </div>
                
                 <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info">Submit</button>
						</div>
					</div>
                 </form>           </div>
        </div>
    </div>  
    
</div>






<?php } ?>




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