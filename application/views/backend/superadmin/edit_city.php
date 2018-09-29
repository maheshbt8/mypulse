<?php
$edit_data=	$this->db->get_where('city' , array('city_id' => $param2) )->result_array();

?>

<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php echo form_open(base_url() . 'index.php?superadmin/district/update/'.$row['district_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
            <div class="padded">
                	<div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectCountry'];?></label> 

                        <div class="col-sm-5">
                            <select name="country_id" class="form-control" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value=""  onchange="return get_state(this.value)">
                                <option value=""><?php echo $this->lang->line('labels')['select_country'];?></option>
                                <?php 
                                $country = $this->db->get('country')->result_array();
                                foreach($country as $row1){?>
                                <option value="<?php echo $row1['country_id'] ?>" <?php if($row1['country_id']==$row['country_id']){echo 'selected';}?>><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
                               
                            </select>
                        </div>
                    </div>
                      <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectState'];?></label> 

                        <div class="col-sm-5">
                            <select name="state_id" class="form-control" data-validate="required" data-message-required="<?php echo 'Value_required';?>" id="state"   value=""  onchange="return get_branch(this.value)">
                                <option value=""><?php echo $this->lang->line('labels')['select_country_first'];?></option>
                                <?php 
                                $state = $this->db->where('country_id',$row['country_id'])->get('state')->result_array();
                                foreach($state as $row2){?>
                                <option value="<?php echo $row2['state_id'] ?>" <?php if($row2['state_id']==$row['state_id']){echo 'selected';}?>><?php echo $row2['name'] ?></option>
                                
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectState'];?></label> 

                        <div class="col-sm-5">
                            <select name="state_id" class="form-control" data-validate="required" data-message-required="<?php echo 'Value_required';?>" id="state"   value=""  onchange="return get_branch(this.value)">
                                <option value=""><?php echo $this->lang->line('labels')['select_country_first'];?></option>
                                <?php 
                                $state = $this->db->where('state_id',$row['state_id'])->get('district')->result_array();
                                foreach($state as $row2){?>
                                <option value="<?php echo $row2['district_id'] ?>" <?php if($row2['district_id']==$row['district_id']){echo 'selected';}?>><?php echo $row2['name'] ?></option>
                                
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                          
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectCity'];?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"
                            data-validate="required" data-message-required="<?php echo ucfirst('value_required');?>" required/>
                    </div>
                </div>
               
            </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-5">
                  <button type="submit" class="btn btn-info"><?php echo $this->lang->line('buttons')['submit'];?></button>
              </div>
            </div>
        </form>
        <?php endforeach;?>
    </div>
</div>

<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      

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
        function get_district(state_id) {
   
        $.ajax({
            url: '<?php echo base_url();?>index.php?superadmin/get_district/' + state_id ,
            success: function(response)
            {
                jQuery('#select_district').html(response);
            }
        });

    }
    
 

</script>