<?php echo form_open(base_url() . 'main/sms_settings/do_update', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top'));
?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" >

            <div class="panel-heading">
                <div class="panel-title">
                    <?php echo get_phrase('sms_settings'); ?>
                </div>
            </div>

            <div class="panel-body">

                <div class="form-group">
                    <label  class="col-sm-3 control-label"><?php echo get_phrase('sms_username'); ?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="sms_username" value="<?php echo $this->db->get_where('settings', array('type' => 'sms_username'))->row()->description; ?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <label  class="col-sm-3 control-label"><?php echo get_phrase('sms_sender'); ?></label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" name="sms_sender" value="<?php echo $this->db->get_where('settings', array('type' => 'sms_sender'))->row()->description; ?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <label  class="col-sm-3 control-label"><?php echo get_phrase('sms_hash_key'); ?></label>
                    <div class="col-sm-5">
<input type="text" class="form-control" name="sms_hash"value="<?php echo $this->db->get_where('settings', array('type' => 'sms_hash'))->row()->description; ?>"/>
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