<?php
$row = $this->crud_model->select_single_bed($bed_id);
?>
    <div class="row">
        <div class="col-md-6">
<?php if($row['row_status_cd']=='0'){?>
<div class="alert alert-danger">
  <strong>Bed Deleted</strong>
</div>
<?php }?>
            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-body">
                    <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/bed/update/<?php echo $row['bed_id']; ?>" method="post" enctype="multipart/form-data">
      <?php if($account_type=='superadmin'){?>
   	<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label "><?php echo $this->lang->line('labels')['selectHospital'];?></label>
                        
						<div class="col-sm-8">
							<select name="hospital" class="form-control select2"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="" onchange="return get_branch(this.value)" <?php if(($account_type!='superadmin' && $account_type!='hospitaladmins')|| $row['row_status_cd']=='0'){ echo "disabled"; }?>>
                              <option value=""><?php echo $this->lang->line('labels')['select_hospital'];?></option>
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
						<label for="field-2" class="col-sm-3 control-label "><?php echo $this->lang->line('labels')['selectBranch'];?></label>
                        
						<div class="col-sm-8">
							<select name="branch" class="form-control select2" id="select_branch"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="" onchange="return get_department(this.value)"<?php if(($account_type!='superadmin' && $account_type!='hospitaladmins')|| $row['row_status_cd']=='0'){ echo "disabled"; }?>>
                              <?php
                              	$sections1 = $this->crud_model->select_branch_info_by_hospital_id($row['hospital_id']);
                              	foreach($sections1 as $row3): 
                              ?>  
                              <option value="<?php echo $row3['branch_id'];?>"
                              	<?php if($row['branch_id'] == $row3['branch_id']) echo 'selected';?>><?php echo $row3['branch_name'];?></option>
                          <?php endforeach;?>
                          </select>
						</div> 
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label "><?php echo $this->lang->line('labels')['selectDepartment'];?></label>
                        
						<div class="col-sm-8">
							<select name="department" class="form-control select2"  id="select_department"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="" onchange="return get_ward(this.value)"<?php if(($account_type!='superadmin' && $account_type!='hospitaladmins')|| $row['row_status_cd']=='0'){ echo "disabled"; }?>>
                              <?php
                              	$sections1 = $this->crud_model->select_department_info_by_branch_id($row['branch_id']);
                              	foreach($sections1 as $row4): 
                              ?>  
                              <option value="<?php echo $row4['branch_id'];?>"
                              	<?php if($row['department_id'] == $row4['department_id']) echo   'selected';?>><?php echo $row4['dept_name'];?></option>
                          <?php endforeach;?>
                          </select>
						</div> 
					</div>
						<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label "><?php echo $this->lang->line('labels')['selectWard'];?></label>
                        
						<div class="col-sm-8">
							<select name="ward" class="form-control select2" id="select_ward"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value=""<?php if(($account_type!='superadmin' && $account_type!='hospitaladmins')|| $row['row_status_cd']=='0'){ echo "disabled"; }?>>
                              <?php
                              	$sections1 = $this->crud_model->select_ward_info_by_department_id($row['department_id']);
                              	foreach($sections1 as $row4): 
                              ?>  
    <option value="<?php echo $row4['ward_id'];?>" <?php if($row['ward_id'] == $row4['ward_id']) echo 'selected';?>><?php echo $row4['ward_name'];?></option>
                          <?php endforeach;?>
                          </select>
						</div> 
					</div>
					
						<div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['name'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" id="field-1" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="<?=$row['bed_name']?>"<?php if(($account_type!='superadmin' && $account_type!='hospitaladmins')|| $row['row_status_cd']=='0'){ echo "disabled"; }?>>
                        </div>
                       </div>

                                            <div class="form-group">
            <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['bed_status'];?></label>
                        <div class="col-sm-8">
                            <select name="bed_status" class="form-control" id="status"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value=""<?php if(($account_type!='superadmin' && $account_type!='hospitaladmins')|| $row['row_status_cd']=='0'){ echo "disabled"; }?>>
                                <option value=""><?php echo $this->lang->line('labels')['select_status'];?></option>
                                <option value="1" <?php if($row['bed_status'] == 1){echo 'selected';}?>><?php echo $this->lang->line('available');?></option>
                                    <option value="2" <?php if($row['bed_status'] == 2){echo 'selected';}?>><?php echo $this->lang->line('not_available');?></option>
                          </select>
                      </div>
          </div>
                        <div class="col-sm-6 control-label col-sm-offset-6">
        <?php if(($account_type=='superadmin' || $account_type=='hospitaladmins')&& $row['row_status_cd']!='0'){?><input type="submit" class="btn btn-success" value="Update"><?php }?>&nbsp;&nbsp;
                        <input type="button" class="btn btn-info" value="<?php if(($account_type=='superadmin' || $account_type=='hospitaladmins')&& $row['row_status_cd']!='0'){echo get_phrase('cancel');}else{echo get_phrase('close');} ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
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
               
                jQuery('#select_branch').html(response);
            }
        });

    }
    function get_department(branch_id) {

      $.ajax({
            url: '<?php echo base_url();?>ajax/get_department/' + branch_id ,
            success: function(response)
            {
               
                jQuery('#select_department').html(response);
            }
        });

    }
    function get_ward(ward_id) {

      $.ajax({
            url: '<?php echo base_url();?>ajax/get_ward/' + ward_id ,
            success: function(response)
            {
               
                jQuery('#select_ward').html(response);
            }
        });

    }

</script> -->