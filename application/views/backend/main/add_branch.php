<div class="row">
    <div class="col-md-12">
  
        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/branch/create" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                    <?php if($account_type=='superadmin'){?>
                     <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectHospital'];?></label>

                        <div class="col-sm-8">
                            <select name="hospital" class="form-control" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                                <option value=""><?php echo $this->lang->line('labels')['select_hospital'];?></option>
                               <?php 
                               $hospital_info=$this->db->where('status','1')->get('hospitals')->result_array();
                               foreach ($hospital_info as $row) { ?>
                                    <option value="<?php echo $row['hospital_id']; ?>" <?php if($row['hospital_id'] == $hospital_id){echo 'selected';}?>><?php echo $row['name']; ?></option>
                                <?php } ?>
                                
                            </select>
                        </div>
                    </div>
                <?php }elseif($account_type=='hospitaladmins'){?>
                <input type="hidden" name="hospital" value="<?php echo $this->session->userdata('hospital_id');?>"/>
                <?php }?>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['name'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" id="field-1" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['email'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="email" class="form-control" id="field-3"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['phone_number'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="phone_number" class="form-control" id="field-4"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['address'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="address" class="form-control" id="field-2"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                        </div>
                    </div>
                
                  
                 </div>
                 <div class="col-sm-6">
                  
                   
                       <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectCountry'];?></label> 

                        <div class="col-sm-8">
                            <select name="country" class="form-control" value=""  onchange="return get_state(this.value)">
                                <option value=""><?php echo $this->lang->line('labels')['select_country'];?></option>
                                <?php 
                                $admins = $this->db->get_where('country')->result_array();
                                foreach($admins as $row){?>
                                <option value="<?php echo $row['country_id'] ?>"><?php echo $row['name'] ?></option>
                                
                                <?php } ?>
                               
                            </select>
                        </div>
                    </div> 
                    
                    
                       <div class="form-group">
						<label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectState'];?></label>
		                    <div class="col-sm-8">
		                        <select name="state" class="form-control" id="select_state" value=""  onchange="return get_district(this.value)">
		                            <option value=""><?php echo $this->lang->line('labels')['select_country_first'];?></option>

			                    </select>   
			                </div>  
					</div>
					
					
					   <div class="form-group">
						<label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectDistrict'];?></label>
		                    <div class="col-sm-8">
		                        <select name="district" class="form-control" id="select_district" value=""  onchange="return get_city(this.value)">
		                            <option value=""><?php echo $this->lang->line('labels')['select_state_first'];?></option>

			                    </select>
			                </div>
					</div>
					
					<div class="form-group">
						<label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectCity'];?></label>
		                    <div class="col-sm-8">
		                        <select name="city" class="form-control" id="select_city" value=""  >
		                            <option value=""><?php echo $this->lang->line('labels')['select_district_first'];?></option>

			                    </select>
			                </div>
					</div>
              
                   </div>
                
                    </div>
                    <div class="col-sm-3 control-label col-sm-offset-9">
                        <input type="submit" class="btn btn-success" value="<?php echo $this->lang->line('buttons')['submit'];?>">&nbsp;&nbsp;
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