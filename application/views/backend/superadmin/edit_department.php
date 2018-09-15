<?php
$single_department_info = $this->db->get_where('department', array('department_id' => $id))->result_array();
foreach ($single_department_info as $row) {
?>
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        <h3><?php echo get_phrase('edit_department'); ?></h3>
                    </div>
                </div>

                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?superadmin/department/update/<?php echo $row['department_id']; ?>" method="post" enctype="multipart/form-data">
   	<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label "><?php echo ucfirst('hospital');?></label>
                        
						<div class="col-sm-8">
							<select name="hospital" class="form-control selectboxit">
                              <option value=""><?php echo ucfirst('select_hospital');?></option>
                              <?php
                              	$sections = $this->db->get_where('hospitals' , array('status' => 1))->result_array();
                            
                            	//echo $hospital;
                            	//die;
                              
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
							<select name="branch" class="form-control selectboxit">
                              <option value=""><?php echo ucfirst('select_branch');?></option>
                              <?php
                              	$sections1 = $this->db->get('branch')->result_array();
                            
                            	//echo $hospital;
                            	//die;
                              
                              	foreach($sections1 as $row3): 
                              ?>  
                              <option value="<?php echo $row3['branch_id'];?>"
                              	<?php if($row['branch_id'] == $row3['branch_id']) echo   'selected';?>><?php echo $row3['name'];?></option>
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

                            <div class="col-sm-9">
                                <textarea name="description" class="form-control"
                                    id="field-ta"><?php echo $row['description']; ?></textarea>
                            </div>
                        </div>

                        <div class="col-sm-3 control-label col-sm-offset-2">
                            <input type="submit" class="btn btn-success" value="Update">
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
<?php } ?>