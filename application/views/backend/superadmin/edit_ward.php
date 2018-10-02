<?php
$single_ward_info = $this->db->get_where('ward', array('ward_id' => $id))->result_array();
foreach ($single_ward_info as $row) {
?>
    <div class="row">
        <div class="col-md-6">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        <h3><?php echo get_phrase('edit_ward'); ?></h3>
                    </div>
                </div>

                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?superadmin/ward/update/<?php echo $row['ward_id']; ?>" method="post" enctype="multipart/form-data">
   	<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label "><?php echo ucfirst('hospital');?></label>
                        
						<div class="col-sm-8">
							<select name="hospital" class="form-control selectbox">
                              <option value=""><?php echo ucfirst('select_hospital');?></option>
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
						<label for="field-2" class="col-sm-3 control-label "><?php echo ucfirst('branch');?></label>
                        
						<div class="col-sm-8">
							<select name="branch" class="form-control selectbox">
                              <option value=""><?php echo ucfirst('select_branch');?></option>
                              <?php
                              	$sections1 = $this->db->get('branch')->result_array();
                            
                              	foreach($sections1 as $row3): 
                              ?>  
                              <option value="<?php echo $row3['branch_id'];?>"
                              	<?php if($row['branch_id'] == $row3['branch_id']) echo   'selected';?>><?php echo $row3['name'];?></option>
                          <?php endforeach;?>
                          </select>
						</div> 
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label "><?php echo ucfirst('department');?></label>
                        
						<div class="col-sm-8">
							<select name="department" class="form-control selectbox">
                              <option value=""><?php echo ucfirst('select_department');?></option>
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
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" id="field-1" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?=$row['name']?>">
                        </div>
                       </div>

                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                            <div class="col-sm-8">
                                <textarea name="description" class="form-control"
                                    id="field-ta"><?php echo $row['description']; ?></textarea>
                            </div>
                        </div>

                        <div class="col-sm-6 control-label col-sm-offset-2">
                            <input type="submit" class="btn btn-success" value="Update">&nbsp;&nbsp;
                        <input type="button" class="btn btn-info" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
<?php } ?>