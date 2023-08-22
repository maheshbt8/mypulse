<style>
    .modal-backdrop.in{
        z-index: auto;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">   
            <div class="panel-body">
         <!------CONTROL TABS END------>
         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/add_inpatient/" method="post" enctype="multipart/form-data">
<div class="col-sm-12"><span class="col-sm-offset-2" id="inpatient_check" style="color: red;"></span></div>
<div class="row">
<div class="col-sm-6">
                              <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('user'); ?></label>

                        <div class="col-sm-8" id="user_data">
                            <input type="text" name="user" class="form-control"  autocomplete="off" id="user" list="users" placeholder="e.g. Enter User Email, Mobile Number or User ID" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo set_value('user'); ?>" onchange="return get_user_data(this.value)">
                        </div>
                    </div>
                </div>
        <div class="col-sm-6">
                <?php if($account_type=='superadmin'){?>
                  <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('hospital'); ?></label> 

                        <div class="col-sm-8">
                            <select name="hospital" class="form-control select2" id="hospital"  data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo set_value('hospital'); ?>"  onchange="return get_branch(this.value)">
                                <option value=""><?php echo get_phrase('select_hospital'); ?></option>
                            </select>
                            <span ><?php echo form_error('hospital'); ?></span>
                        </div>
                    </div>
                    <?php }elseif($account_type=='hospitaladmins' || $account_type=='doctors'){?>
                <input type="hidden" name="hospital" value="<?php echo $this->session->userdata('hospital_id');?>"/>
                <?php }?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?php if($account_type=='superadmin' || $account_type=='hospitaladmins'){?>
                              <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('branch'); ?></label>
                            <div class="col-sm-8">
                                <select name="branch" class="form-control select2" id="branch"  data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo set_value('branch'); ?>"  onchange="return get_department(this.value)">
                    <?php if($account_type=='superadmin'){?>
                    <option value=""><?php echo get_phrase('select_branch'); ?></option>
                    <?php }elseif($account_type=='hospitaladmins'){?>
                    <option value=""><?php echo get_phrase('select_branch'); ?></option>
                 <?php 
                    $hospital_info=$this->crud_model->select_branch_info_by_hospital_id($this->session->userdata('hospital_id'));
                foreach ($hospital_info as $row1) { ?>
                <option value="<?php echo $row1['branch_id']; ?>" <?php if($row1['branch_id'] == $branch['branch_id']){echo 'selected';}?>><?php echo $row1['branch_name']; ?></option>
                                <?php } ?>
                <?php }?>
                                </select>
                                <span ><?php echo form_error('branch'); ?></span>
                            </div>
                    </div>
                <?php }elseif($account_type=='doctors'){?>
                <input type="hidden" name="branch" value="<?php echo $this->session->userdata('branch_id');?>"/>
                <?php }?>
        </div>
        <div class="col-sm-6">
            <?php if($account_type=='superadmin' || $account_type=='hospitaladmins'){?>
                                <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('department'); ?></label>
                            <div class="col-sm-8">
                                <select name="department" class="form-control select2" id="department"  data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo set_value('department'); ?>" onchange="return get_ward1(this.value)">
                                    <option value=""><?php echo get_phrase('select_department'); ?></option>

                                </select>
                                <span ><?php echo form_error('department'); ?></span>
                            </div>
                    </div>
                <?php }elseif($account_type=='doctors'){?>
                <input type="hidden" name="department" value="<?php echo $this->session->userdata('department_id');?>"/>
                <?php }?>
        </div>
        <div class="col-sm-6">
                        <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectWard'];?></label>
                            <div class="col-sm-8">
                                <select name="ward" class="form-control select2" id="ward"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="" onchange="return get_bed(this.value)">
                    <?php if($account_type=='superadmin' || $account_type=='hospitaladmins'){ ?>
                                    <option value=""><?php echo get_phrase('select_ward'); ?></option>
                    <?php }elseif($account_type=='doctors'){
$ward = $this->crud_model->select_ward_info_by_department_id($this->session->userdata('department_id'));?>

        <option value=""> Select Ward </option>
        <?php 
        foreach ($ward as $row) {
        ?>
        <option value="<?= $row['ward_id'];?>"><?= $row['ward_name'];?></option> <?php } }?>
                                </select>
                            </div>
                    </div>
        </div>
        <div class="col-sm-6">
                        <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo 'Bed';?></label>
                            <div class="col-sm-8">
                                <select name="bed" class="form-control select2" id="bed"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                                    <option value=""><?php echo get_phrase('select_bed'); ?></option>
                                </select>
                            </div>
                    </div>
        </div>
        
                <div class="col-sm-6">
            <?php if($account_type == 'superadmin' || $account_type == 'hospitaladmins'){ ?>
                                 <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('doctor'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="doctor" class="form-control"  autocomplete="off" id="doctor" list="doctors" placeholder="e.g. Hospital Name, Doctor Name or Specialisation " data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo set_value('doctor'); ?>" onchange="return get_doctor_ava(this.value)">
    <datalist id="doctors">
  </datalist>
                        </div>
                    </div>
                    <?php }elseif($account_type == 'doctors'){ ?>
                    <input type="hidden" name="doctor" id="doctor" value="<?php echo $this->session->userdata('unique_id');?>"> 
                  <?php }?>
                </div>

                                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('Reason'); ?></label>
                            <div class="col-sm-8" id="reason">
                                <input type="text" name="reason" placeholder="Reason" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php set_value('reason');?>" >
                            </div>
                    </div>
                </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo 'Status';?></label>
                            <div class="col-sm-8">
                                <select name="status" class="form-control" id="status"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                                    <option value="1" selected=""><?php echo get_phrase('admitted'); ?></option>
                                    <option value="0"><?php echo get_phrase('Recommended'); ?></option>
                                </select>
                            </div>
                    </div>
        </div>   
        </div>       
          
        


                    
                     
                    <div class="col-sm-3 control-label col-sm-offset-9 ">
                        <input type="submit" class="btn btn-success" value="<?php echo get_phrase('submit'); ?>">&nbsp;&nbsp;
                        <input type="button" class="btn btn-info" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
                    </div>  
                   
   </form>
</div>
</div>   
</div>
</div>
<script type="text/javascript">
    function get_user_data(user_value) {
     $.ajax({
            type : "POST",
            url: '<?php echo base_url();?>ajax/get_user_data/' ,
            data : {user : user_value},
            success: function(response)
            {
                jQuery('#user_data').html(response);        
            } 
        });
     $.ajax({
            type : "POST",
            url: '<?php echo base_url();?>ajax/check_inpatient/' ,
            data : {user : user_value},
            success: function(response)
            {
                jQuery('#inpatient_check').html(response);        
            } 
        });
    }
</script>
<script type="text/javascript">
        function get_ward1(department_id) {
        $.ajax({
            url: '<?php echo base_url();?>ajax/get_ward/' + department_id ,
            success: function(response)
            {
                jQuery('#ward').html(response);
            }
        });
                $.ajax({
            url: '<?php echo base_url();?>ajax/get_department_doctors/' + department_id ,
            success: function(response)
            {
            jQuery('#doctors').html(response);
            }
        });

    }
       
</script>