<?php
$single_bed_info = $this->db->get_where('bed', array('bed_id' => $bed_id))->result_array();

foreach ($single_bed_info as $row) {
?>
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?superadmin/bed/update/<?php echo $row['ward_id']; ?>" method="post" enctype="multipart/form-data">
   	<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label "><?php echo $this->lang->line('labels')['selectHospital'];?></label>
                        
						<div class="col-sm-8">
							<select name="hospital" class="form-control selectbox"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="" onchange="return get_branch(this.value)">
                              <option value=""><?php echo $this->lang->line('labels')['select_hospital'];?></option>
                              <?php
                              	$sections = $this->db->get_where('hospitals' , array('status' => 1))->result_array();
                            
                              	foreach($sections as $row2):
                              ?>  
                              <option value="<?php echo $row2['hospital_id'];?>"
                              	<?php if($row['hospital_id'] == $row2['hospital_id']) echo 'selected';?>><?php echo $row2['name'];?></option>
                          <?php endforeach;?>
                          </select>
						</div> 
					</div>
					
						<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label "><?php echo $this->lang->line('labels')['selectBranch'];?></label>
                        
						<div class="col-sm-8">
							<select name="branch" class="form-control selectbox" id="select_branch"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="" onchange="return get_department(this.value)">
                              <option value=""><?php echo $this->lang->line('labels')['select_hospital_first'];?></option>
                              <?php
                              	$sections1 = $this->db->get('branch')->result_array();
                            
                              	foreach($sections1 as $row3): 
                              ?>  
                              <option value="<?php echo $row3['branch_id'];?>"
                              	<?php if($row['branch_id'] == $row3['branch_id']) echo 'selected';?>><?php echo $row3['name'];?></option>
                          <?php endforeach;?>
                          </select>
						</div> 
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label "><?php echo $this->lang->line('labels')['selectDepartment'];?></label>
                        
						<div class="col-sm-8">
							<select name="department" class="form-control selectbox"  id="select_department"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="" onchange="return get_ward(this.value)">
                              <option value=""><?php echo $this->lang->line('labels')['select_branch_first'];?></option>
                              <?php
                              	$sections1 = $this->db->get('department')->result_array();
                            
                              	foreach($sections1 as $row4): 
                              ?>  
                              <option value="<?php echo $row4['branch_id'];?>"
                              	<?php if($row['department_id'] == $row4['department_id']) echo   'selected';?>><?php echo $row4['name'];?></option>
                          <?php endforeach;?>
                          </select>
						</div> 
					</div>
						<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label "><?php echo $this->lang->line('labels')['selectWard'];?></label>
                        
						<div class="col-sm-8">
							<select name="ward" class="form-control selectbox" id="select_ward"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="">
                              <option value=""><?php echo $this->lang->line('labels')['select_department_first'];?></option>
                              <?php
                              	$sections1 = $this->db->get('ward')->result_array();
                            
                              	foreach($sections1 as $row4): 
                              ?>  
                              <option value="<?php echo $row4['ward_id'];?>"
                              	<?php if($row['ward_id'] == $row4['ward_id']) echo   'selected';?>><?php echo $row4['name'];?></option>
                          <?php endforeach;?>
                          </select>
						</div> 
					</div>
					
						<div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['name'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" id="field-1" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?=$row['name']?>">
                        </div>
                       </div>


                        <div class="col-sm-3 control-label col-sm-offset-2">
                            <input type="submit" class="btn btn-success" value="<?php echo $this->lang->line('buttons')['submit'];?>">
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
<?php } ?>




<script type="text/javascript">

  function get_branch(hospital_id) {

      $.ajax({
            url: '<?php echo base_url();?>index.php?superadmin/get_branch/' + hospital_id ,
            success: function(response)
            {
               
                jQuery('#select_branch').html(response);
            }
        });

    }
    function get_department(branch_id) {

      $.ajax({
            url: '<?php echo base_url();?>index.php?superadmin/get_department/' + branch_id ,
            success: function(response)
            {
               
                jQuery('#select_department').html(response);
            }
        });

    }
    function get_ward(ward_id) {

      $.ajax({
            url: '<?php echo base_url();?>index.php?superadmin/get_ward/' + ward_id ,
            success: function(response)
            {
               
                jQuery('#select_ward').html(response);
            }
        });

    }

</script>