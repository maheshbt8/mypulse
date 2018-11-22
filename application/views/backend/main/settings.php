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
   <?php if($account_type=='superadmin' || $account_type == 'hospitaladmins'){?>
  <a href="<?php echo base_url(); ?>main/system_settings" class="list-group-item"><i class="icon fa fa-cog"></i>&nbsp;&nbsp;<?php echo get_phrase('system_settings'); ?></a><?php }?>
  <?php if($account_type=='superadmin'){?>
  <a href="<?php echo base_url(); ?>main/license" class="list-group-item"><i class="icon fa fa-desktop"></i>&nbsp;&nbsp;<?php echo get_phrase('license_categories');?></a>
  <a href="<?php echo base_url(); ?>main/health_insurance_provider" class="list-group-item"><i class="icon fa fa-user"></i>&nbsp;&nbsp;<?php echo get_phrase('health_insurance_providers');?></a>
  <a href="<?php echo base_url(); ?>main/language" class="list-group-item"><i class="icon fa fa-cog"></i>&nbsp;&nbsp;<?php echo get_phrase('languages');?></a>
  <a href="<?php echo base_url(); ?>main/manage_privacy" class="list-group-item"><i class="icon fa fa-lock"></i>&nbsp;&nbsp;<?php echo get_phrase('privacy & terms');?></a>
<?php }?>
</div>
  </div>
  <div class="col-sm-6">
  <div class="list-group">
  <?php if($account_type=='superadmin'){?>
  <a href="<?php echo base_url(); ?>main/country" class="list-group-item"><i class="icon fa fa-flag"></i>&nbsp;&nbsp;<?php echo get_phrase('countries'); ?></a>
  <a href="<?php echo base_url(); ?>main/state" class="list-group-item"><i class="icon fa fa-flag"></i>&nbsp;&nbsp;<?php echo get_phrase('states'); ?></a>
  <a href="<?php echo base_url(); ?>main/district" class="list-group-item"><i class="icon fa fa-flag"></i>&nbsp;&nbsp;<?php echo get_phrase('districts'); ?></a>
  <a href="<?php echo base_url(); ?>main/city" class="list-group-item"><i class="icon fa fa-flag"></i>&nbsp;&nbsp;<?php echo get_phrase('cities'); ?></a>
  <a href="<?php echo base_url(); ?>main/specialization" class="list-group-item"><i class="icon fa fa-flag"></i>&nbsp;&nbsp;<?php echo get_phrase('specializations'); ?></a><?php }?>
</div>

  </div>
</div>


