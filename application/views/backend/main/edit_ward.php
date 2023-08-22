<?php
$row = $this->crud_model->select_single_ward($id);
?>
    <div class="row">
        <div class="col-md-6">
<?php if($row['row_status_cd']=='0'){?>
<div class="alert alert-danger">
  <strong>Ward Deleted</strong>
</div>
<?php }?>
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/ward/update/<?php echo $row['ward_id']; ?>" method="post" enctype="multipart/form-data">
        <?php if($account_type=='superadmin'){?>
   	<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label "><?php echo ucfirst('hospital');?></label>
                        
						<div class="col-sm-8">
							<select name="hospital" class="form-control select2"  data-validate="required" data-message-required="Value Required" onchange="return get_branch(this.value)"<?php if(($account_type!='superadmin' && $account_type!='hospitaladmins') || $row['row_status_cd']=='0'){ echo "disabled"; }?>>
                             
                              <?php
                              	$sections = $this->crud_model->select_all_hospitals();
                              	foreach($sections as $row2):
                              ?>  
                              <option value="<?php echo $row2['hospital_id'];?>"
                              	<?php if($row['hospital_id'] == $row2['hospital_id']) echo 'selected';?>><?php echo $row2['name'];?></option>
                          <?php endforeach;?>
                          </select>
						</div> 
					</div>
					<?php }elseif($account_type=='hospitaladmins'){?>
                <input type="hidden" name="hospital" value="<?php echo $row['hospital_id'];?>"/>
                <?php }?>
						<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label "><?php echo ucfirst('branch');?></label>
                        
						<div class="col-sm-8">
							<select name="branch" class="form-control select2"  data-validate="required" data-message-required="Value Required" onchange="return get_department(this.value)" id="branch" <?php if(($account_type!='superadmin' && $account_type!='hospitaladmins') || $row['row_status_cd']=='0'){ echo "disabled"; }?>>
                              <?php
                              	$sections1 = $this->crud_model->select_branch_info_by_hospital_id($row['hospital_id']);
                              	foreach($sections1 as $row3): 
                              ?>  
                              <option value="<?php echo $row3['branch_id'];?>"
                              	<?php if($row['branch_id'] == $row3['branch_id']) echo   'selected';?>><?php echo $row3['branch_name'];?></option>
                          <?php endforeach;?>
                          </select>
						</div> 
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label "><?php echo ucfirst('department');?></label>
                        
						<div class="col-sm-8">
							<select name="department" class="form-control select2"  data-validate="required" data-message-required="Value Required" id="department"<?php if(($account_type!='superadmin' && $account_type!='hospitaladmins') || $row['row_status_cd']=='0'){ echo "disabled"; }?>>
                              <?php
                              	$sections1 = $this->crud_model->select_department_info_by_branch_id($row['branch_id']);
                              	foreach($sections1 as $row4): 
                              ?>  
                              <option value="<?php echo $row4['department_id'];?>"
                              	<?php if($row['department_id'] == $row4['department_id']) echo   'selected';?>><?php echo $row4['dept_name'];?></option>
                          <?php endforeach;?>
                          </select>
						</div> 
					</div>
					
						<div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('ward_name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control"  data-validate="required" data-message-required="Value Required" id="name" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?=$row['ward_name']?>"<?php if(($account_type!='superadmin' && $account_type!='hospitaladmins') || $row['row_status_cd']=='0'){ echo "disabled"; }?>>
                        </div>
                       </div>

                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                            <div class="col-sm-8">
                                <textarea name="description" class="form-control"
                                    id="field-ta"<?php if(($account_type!='superadmin' && $account_type!='hospitaladmins') || $row['row_status_cd']=='0'){ echo "disabled"; }?>><?php echo $row['description']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group"> 
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('status'); ?></label>

                        <div class="col-sm-8">
                            <select name="status" class="form-control"  data-validate="required" data-message-required="Value Required" id="status" value="" <?php if($row['row_status_cd']=='0'){echo "disabled";}?>>
                                <option value=""><?php echo get_phrase('select_status'); ?></option>
                                <option value="1" <?php if($row['row_status_cd']==1){echo 'selected';}?>><?php echo get_phrase('active'); ?></option>
                                <option value="2" <?php if($row['row_status_cd']==2){echo 'selected';}?>><?php echo get_phrase('inactive'); ?></option>
                            </select>
                            <span ><?php echo form_error('status'); ?></span>
                        </div>
                    </div>
                        <div class="col-sm-6 control-label col-sm-offset-6">
          <?php if(($account_type=='superadmin' || $account_type=='hospitaladmins')&& $row['row_status_cd']=='1'){?><input type="submit" class="btn btn-success" value="Update"><?php }?>&nbsp;&nbsp;
                        <input type="button" class="btn btn-info" value="<?php if(($account_type=='superadmin' || $account_type=='hospitaladmins')&& $row['row_status_cd']=='1'){echo get_phrase('cancel');}else{echo get_phrase('close');} ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>

<!-- <script type="text/javascript">

  function get_branch(hospital_id) {

      $.ajax({
            url: '<?php echo base_url();?>ajax/get_branch/' + hospital_id ,
            success: function(response)
            {
               
                jQuery('#branch').html(response);
            }
        });

    }
    function get_department(branch_id) {

      $.ajax({
            url: '<?php echo base_url();?>ajax/get_department/' + branch_id ,
            success: function(response)
            {
               
                jQuery('#department').html(response);
            }
        });

    }

</script> -->