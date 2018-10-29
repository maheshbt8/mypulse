<?php $branch=$this->db->where('branch_id',$branch_id)->get('branch')->row_array();?>
<div class="row">
    <div class="col-md-6">

        <div class="panel panel-primary" data-collapsed="0">
        <div class="panel-body">

                <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/department/create" method="post" enctype="multipart/form-data">
                    <?php if($account_type=='superadmin'){?>
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectHospital'];?></label>

                        <div class="col-sm-8">
                            <select name="hospital" class="form-control" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="" onchange="return get_branch(this.value)">
                                <option value=""><?php echo $this->lang->line('labels')['select_hospital'];?></option>
                               <?php 
                               $hospital_info=$this->db->where('status','1')->get('hospitals')->result_array();
                               foreach ($hospital_info as $row) { ?>
                                    <option value="<?php echo $row['hospital_id']; ?>" <?php if($row['hospital_id'] == $branch['hospital_id']){echo 'selected';}?>><?php echo $row['name']; ?></option>
                                <?php } ?>
                                
                            </select>
                        </div>   
                    </div>
                <?php }elseif($account_type=='hospitaladmins'){?>
                <input type="hidden" name="hospital" value="<?php echo $this->session->userdata('hospital_id');?>"/>
                <?php }?>
                    <div class="form-group">
						<label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectBranch'];?></label>
		                    <div class="col-sm-8">
		                        <select name="branch" class="form-control" id="select_branch"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="">
		                            <option value=""><?php echo $this->lang->line('labels')['select_hospital_first'];?></option>
                                     <?php 
                               $hospital_info=$this->db->where('hospital_id',$branch['hospital_id'])->get('branch')->result_array();
                               foreach ($hospital_info as $row) { ?>
                                    <option value="<?php echo $row['branch_id']; ?>" <?php if($row['branch_id'] == $branch['branch_id']){echo 'selected';}?>><?php echo $row['name']; ?></option>
                                <?php } ?>
			                    </select>
			                </div>
					</div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['name'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" id="field-1" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['description'];?></label>

                        <div class="col-sm-8">
                            <textarea name="description" class="form-control" id="field-ta"></textarea>
                        </div>
                    </div>

                    <div class="col-sm-6 control-label col-sm-offset-6">
                        <input type="submit" class="btn btn-success" value="<?php echo $this->lang->line('buttons')['submit'];?>">&nbsp;&nbsp;
                        <input type="button" class="btn btn-info" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>


<script type="text/javascript">

	function get_branch(hospital_id) {

    	$.ajax({
            url: '<?php echo base_url();?>ajax/get_branch/' + hospital_id ,
            success: function(response)
            {
               
                jQuery('#select_branch').html(response);
            }
        });

    }

</script>