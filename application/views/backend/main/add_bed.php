<?php $ward=$this->crud_model->select_single_ward($ward_id);?>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-body">
                <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/bed/create" method="post" enctype="multipart/form-data">
                     <?php if($account_type=='superadmin'){?>
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label">Hospital</label>
                        <div class="col-sm-8">
                            <select name="hospital" id="hospital_id" class="form-control select2" data-validate="required" data-message-required="<?php echo 'Value Required';?>" value="" onchange="return get_branch(this.value)">
                                <option value=""><?php echo 'Select Hospital';?></option>
                               <?php 
                               $hospital_info=$this->crud_model->select_all_hospitals();
                               foreach ($hospital_info as $row) { ?>
                                    <option value="<?php echo $row['hospital_id']; ?>" <?php if($row['hospital_id'] == $ward['hospital_id']){echo 'selected';}?>><?php echo $row['name']; ?></option>
                                <?php } ?>
                                
                            </select>
                        </div>   
                    </div>
                    <?php }elseif($account_type=='hospitaladmins'){?>
                <input type="hidden" name="hospital" value="<?php echo $this->session->userdata('hospital_id');?>"/>
                <?php }?>
                    <div class="form-group">
						<label for="field-ta" class="col-sm-3 control-label">Branch</label>
		                    <div class="col-sm-8">
		              <select name="branch" class="form-control select2" id="branch"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="" onchange="return get_department(this.value)">
                        <option value="">Select Branch</option>
		      <?php  if($ward['hospital_id'] != ''){$hospital_id=$ward['hospital_id'];}else{$hospital_id=$this->session->userdata('hospital_id');}
                               $branch_info=$this->crud_model->select_branch_info_by_hospital_id($hospital_id);
                               foreach ($branch_info as $row) { 
                                ?>
                                    <option value="<?php echo $row['branch_id']; ?>" <?php if($row['branch_id'] == $ward['branch_id']){echo 'selected';}?>><?php echo $row['branch_name']; ?></option>
                                <?php } ?>

			                    </select>
			                </div>
					</div>
					<div class="form-group">
						<label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectDepartment'];?></label>
		                    <div class="col-sm-8">
		                        <select name="department" class="form-control select2" id="department"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="" onchange="return get_ward(this.value)">
                                    <option value="">Select Department</option>
		                             <?php 
                               $hospital_info=$this->crud_model->select_department_info_by_branch_id($ward['branch_id']);
                               foreach ($hospital_info as $row) { ?>
                                    <option value="<?php echo $row['department_id']; ?>" <?php if($row['department_id'] == $ward['department_id']){echo 'selected';}?>><?php echo $row['dept_name']; ?></option>
                                <?php } ?>

			                    </select>
			                </div>
					</div>
						<div class="form-group">
						<label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectWard'];?></label>
		                    <div class="col-sm-8">
		                        <select name="ward" class="form-control select2" id="ward"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                                    <option value="">Select Ward</option>
                                     <?php 
                               $hospital_info=$this->crud_model->select_ward_info_by_department_id($ward['department_id']);
                               foreach ($hospital_info as $row) { ?>
                                    <option value="<?php echo $row['ward_id']; ?>" <?php if($row['ward_id'] == $ward['ward_id']){echo 'selected';}?>><?php echo $row['ward_name']; ?></option>
                                <?php } ?>
			                    </select>
			                </div>
					</div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['name'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" id="name"  data-validate="required" data-message-required="<?php echo 'Value_required';?>">
                        </div>
                    </div>
                    <div class="form-group">
						<label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['bed_status'];?></label>
		                    <div class="col-sm-8">
		                        <select name="bed_status" class="form-control" id="status"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
		                            <option value=""><?php echo $this->lang->line('labels')['select_status'];?></option>
		                            <option value="1" selected>Available</option>
                                    <option value="2">Not Available</option>
			                    </select>
			                </div>
					</div>
                    <div class="col-sm-6 control-label col-sm-offset-6">
                        <input type="submit" class="btn btn-success" value="Submit">&nbsp;&nbsp;
                        <input type="button" class="btn btn-info" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
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