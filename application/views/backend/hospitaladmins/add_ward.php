
<?php $department=$this->db->where('department_id',$department_id)->get('department')->row_array();?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>index.php?superadmin/ward/create" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectHospital'];?></label>

                        <div class="col-sm-5">
                            <select name="hospital" class="form-control" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="" onchange="return get_branch(this.value)">
                                <option value=""><?php echo $this->lang->line('labels')['select_hospital'];?></option>
                               <?php 
                               $hospital_info=$this->db->where('status','1')->get('hospitals')->result_array();
                               foreach ($hospital_info as $row) { ?>
                                    <option value="<?php echo $row['hospital_id']; ?>" <?php if($row['hospital_id'] == $department['hospital_id']){echo 'selected';}?>><?php echo $row['name']; ?></option>
                                <?php } ?>
                                
                            </select>
                        </div>   
                    </div>
                    <div class="form-group">
						<label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectBranch'];?></label>
		                    <div class="col-sm-5">
		                        <select name="branch" class="form-control" id="select_branch"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="" onchange="return get_department(this.value)">
		                            <option value=""><?php echo $this->lang->line('labels')['select_hospital_first'];?></option>
                                      <?php 
                               $hospital_info=$this->db->get('branch')->result_array();
                               foreach ($hospital_info as $row) { ?>
                                    <option value="<?php echo $row['branch_id']; ?>" <?php if($row['branch_id'] == $department['branch_id']){echo 'selected';}?>><?php echo $row['name']; ?></option>
                                <?php } ?>
			                    </select>
			                </div>
					</div>
					<div class="form-group">
						<label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectDepartment'];?></label>
		                    <div class="col-sm-5">
		                        <select name="department" class="form-control" id="select_department" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="">
		                            <option value=""><?php echo $this->lang->line('labels')['select_branch_first'];?></option>
                                    <?php 
                               $hospital_info=$this->db->get('department')->result_array();
                               foreach ($hospital_info as $row) { ?>
                                    <option value="<?php echo $row['department_id']; ?>" <?php if($row['department_id'] == $department['department_id']){echo 'selected';}?>><?php echo $row['name']; ?></option>
                                <?php } ?>
			                    </select>
			                </div>
					</div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['name'];?></label>

                        <div class="col-sm-5">
                            <input type="text" name="name" class="form-control" id="name"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['description'];?></label>

                        <div class="col-sm-9">
                            <textarea name="description" class="form-control" id="field-ta"></textarea>
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

</script>