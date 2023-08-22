<?php if($account_type == 'superadmin'){?>
<?php echo form_open(base_url() . 'main/system_settings/do_update', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top'));
?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" >

            <div class="panel-heading">
                <div class="panel-title">
                    <?php echo get_phrase('system_settings'); ?>
                </div>
            </div>

            <div class="panel-body">

                <div class="form-group">
                    <label  class="col-sm-3 control-label"><?php echo get_phrase('system_name'); ?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="system_name" 
                               value="<?php echo $this->db->get_where('settings', array('setting_type' => 'system_name'))->row()->description; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label  class="col-sm-3 control-label"><?php echo get_phrase('system_title'); ?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="system_title" 
                               value="<?php echo $this->db->get_where('settings', array('setting_type' => 'system_title'))->row()->description; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label  class="col-sm-3 control-label"><?php echo get_phrase('address'); ?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="address" 
                               value="<?php echo $this->db->get_where('settings', array('setting_type' => 'address'))->row()->description; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label  class="col-sm-3 control-label"><?php echo get_phrase('phone'); ?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="phone" 
                               value="<?php echo $this->db->get_where('settings', array('setting_type' => 'phone'))->row()->description; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label  class="col-sm-3 control-label"><?php echo get_phrase('system_email'); ?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="system_email" 
                               value="<?php echo $this->db->get_where('settings', array('setting_type' => 'system_email'))->row()->description; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label"><?php echo get_phrase('email_password'); ?></label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" name="email_password" 
                               value="<?php echo $this->db->get_where('settings', array('setting_type' => 'email_password'))->row()->description; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <input type="button" class="btn btn-info pull-right" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'"><button type="submit" class="btn btn-success pull-right"><?php echo get_phrase('update'); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<?php }?>
