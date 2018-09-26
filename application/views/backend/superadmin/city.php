<hr />
<div class="row">
	<div class="col-md-12">
    
    	<!--CONTROL TABS START-->
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
				<?php echo $this->lang->line('labels')['citys_list'];?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
				<?php echo $this->lang->line('labels')['add_city'];?>
                    	</a></li>
		</ul>
    	<!--CONTROL TABS END-->
        
	
		<div class="tab-content">
        <br>
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box <?php if(!isset($edit_data))echo 'active';?>" id="list">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div><?php echo $this->lang->line('labels')['selectCountry'];?></div></th>
                    		<th><div><?php echo $this->lang->line('labels')['selectState'];?></div></th>
                    		<th><div><?php echo $this->lang->line('labels')['selectDistrict'];?></div></th>
                    		<th><div><?php echo $this->lang->line('labels')['selectCity'];?></div></th>
                    	    <th><div><?php echo $this->lang->line('labels')['options'];?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($country as $row):?>
                        <tr>
                            <td><?php echo $this->db->where('country_id',$row['country_id'])->get('country')->row()->name;?></td>
                            <td><?php echo $this->db->where('state_id',$row['state_id'])->get('state')->row()->name;?></td>
                            <td><?php echo $this->db->where('district_id',$row['district_id'])->get('district')->row()->name;?></td>
							<td><?php echo $row['name'];?></td>   
							<td>
                                 <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/edit_city/<?php echo $row['city_id'];?>');" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                           
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url() . 'index.php?superadmin/city/create/' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                	<div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectCountry'];?></label> 

                        <div class="col-sm-5">
                            <select name="country_id" class="form-control" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value=""  onchange="return get_state(this.value)">
                                <option value=""><?php echo $this->lang->line('labels')['select_country'];?></option>
                                <?php 
                                $country = $this->db->get('country')->result_array();
                                foreach($country as $row){?>
                                <option value="<?php echo $row['country_id'] ?>"><?php echo $row['name'] ?></option>
                                
                                <?php } ?>
                               
                            </select>
                        </div>
                    </div>
                    <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectState'];?></label> 

                        <div class="col-sm-5">
                            <select name="state_id" class="form-control" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" id="select_state"   value=""  onchange="return get_district(this.value)">
                                <option value=""><?php echo $this->lang->line('labels')['select_country_first'];?></option>
                              
                            </select>
                        </div>
                    </div>
                     <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectDistrict'];?></label> 

                        <div class="col-sm-5">
                            <select name="district_id" class="form-control" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" id="select_district"   value="" >
                                <option value=""><?php echo $this->lang->line('labels')['select_state_first'];?></option>
                              
                            </select>
                        </div>
                    </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectCity'];?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name"
                                        data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>"/>
                                </div>
                            </div>
                            
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo $this->lang->line('buttons')['submit'];?></button>
                              </div>
							</div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->
            
		</div>
	</div>
</div>




<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      

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