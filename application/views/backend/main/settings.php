<style>
  .icon{
    font-size:100px;
  }
</style>
<div class="row">
<a href="<?php echo base_url(); ?>main/system_settings">
<div class="col-sm-2">
  <h3><?php echo get_phrase('system_settings'); ?></h3><br>
  <i class="icon fa fa-cog"></i>
</div>
</a>
<?php if($account_type=='superadmin'){?>
<a href="<?php echo base_url(); ?>main/country">
<div class="col-sm-2">
  <h3><?php echo get_phrase('countries'); ?></h3><br>
  <i class="icon fa fa-flag"></i>
</div>
</a>
<a href="<?php echo base_url(); ?>main/state">
<div class="col-sm-2">
  <h3><?php echo get_phrase('states'); ?></h3><br>
  <i class="icon fa fa-flag"></i>
</div>
</a>
<a href="<?php echo base_url(); ?>main/district">
<div class="col-sm-2">
  <h3><?php echo get_phrase('districts'); ?></h3><br>
  <i class="icon fa fa-flag"></i>
</div>
</a>
<a href="<?php echo base_url(); ?>main/city">
<div class="col-sm-2">
  <h3><?php echo get_phrase('cities'); ?></h3><br>
  <i class="icon fa fa-flag"></i>
</div>
</a>
<a href="<?php echo base_url(); ?>main/specialization">
<div class="col-sm-2">
  <h3><?php echo get_phrase('specializations'); ?></h3><br>
  <i class="icon fa fa-plus-square"></i>
</div>
</a>
<br/><br/>
<a href="<?php echo base_url(); ?>main/language">
<div class="col-sm-3">
  <h3><?php echo get_phrase('languages');?></h3><br>
  <i class="icon fa fa-desktop"></i>
</div>
</a>
<a href="<?php echo base_url(); ?>main/license">
<div class="col-sm-3">
  <h3><?php echo get_phrase('license_categories');?></h3><br>
  <i class="icon fa fa-desktop"></i>
</div>
</a>
<a href="<?php echo base_url(); ?>main/health_insurance_provider">
<div class="col-sm-3">
  <h3><?php echo get_phrase('health_insurance_providers');?></h3><br>
  <i class="icon fa fa-user"></i>
</div>
</a>
<a href="<?php echo base_url(); ?>main/manage_privacy">
<div class="col-sm-3">
  <h3><?php echo get_phrase('privacy & terms');?></h3><br>
  <i class="icon fa fa-lock"></i>
</div>
</a>
<?php }?>

</div>