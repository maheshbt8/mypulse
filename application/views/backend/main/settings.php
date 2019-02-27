<?php 
$this->session->set_userdata('last_page', current_url());
?>
<style type="text/css">
  div .list-group{
    font-size: 20px;
  }
</style>
<div class="row">
  <div class="col-sm-6">
    <div class="list-group">
   <?php if($account_type=='superadmin'){?>
  <a href="<?php echo base_url(); ?>System_Settings" class="list-group-item"><i class="icon fa fa-cog"></i>&nbsp;&nbsp;<?php echo get_phrase('system_settings'); ?></a><?php }?>
  <?php if($account_type=='superadmin'){?>
  <a href="<?php echo base_url(); ?>Sms_Settings" class="list-group-item"><i class="icon fa fa-cog"></i>&nbsp;&nbsp;<?php echo get_phrase('SMS_settings'); ?></a><?php }?>
  <?php if($account_type=='superadmin'){?>
  <a href="<?php echo base_url(); ?>License" class="list-group-item"><i class="icon fa fa-desktop"></i>&nbsp;&nbsp;<?php echo get_phrase('license_categories');?></a>
  <a href="<?php echo base_url(); ?>Health_Insurance_Provider" class="list-group-item"><i class="icon fa fa-user"></i>&nbsp;&nbsp;<?php echo get_phrase('health_insurance_providers');?></a>
  <a href="<?php echo base_url(); ?>Language" class="list-group-item"><i class="icon fa fa-cog"></i>&nbsp;&nbsp;<?php echo get_phrase('languages');?></a>
  <a href="<?php echo base_url(); ?>Privacy-Terms" class="list-group-item"><i class="icon fa fa-lock"></i>&nbsp;&nbsp;<?php echo get_phrase('privacy & terms');?></a>
<?php }?>
</div>
  </div>
  <div class="col-sm-6">
  <div class="list-group">
  <?php if($account_type=='superadmin'){?>
  <a href="<?php echo base_url();?>Countries" class="list-group-item"><i class="icon fa fa-flag"></i>&nbsp;&nbsp;<?php echo get_phrase('countries'); ?></a>
  <a href="<?php echo base_url();?>States" class="list-group-item"><i class="icon fa fa-flag"></i>&nbsp;&nbsp;<?php echo get_phrase('states'); ?></a>
  <a href="<?php echo base_url();?>Districts" class="list-group-item"><i class="icon fa fa-flag"></i>&nbsp;&nbsp;<?php echo get_phrase('districts'); ?></a>
  <a href="<?php echo base_url();?>Cities" class="list-group-item"><i class="icon fa fa-flag"></i>&nbsp;&nbsp;<?php echo get_phrase('cities'); ?></a>
  <a href="<?php echo base_url();?>Specializations" class="list-group-item"><i class="icon fa fa-flag"></i>&nbsp;&nbsp;<?php echo get_phrase('specializations'); ?></a>
  <a href="<?php echo base_url();?>Logs" class="list-group-item"><i class="icon fa fa-cog"></i>&nbsp;&nbsp;<?php echo get_phrase('Logs'); ?></a>
  <a href="<?php echo base_url();?>Feedback" class="list-group-item"><i class="icon fa fa-cog"></i>&nbsp;&nbsp;<?php echo get_phrase('feedback'); ?></a>
<?php }?>
</div>

  </div>
</div>


