
<!--password-->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" >
            <div class="panel-heading">
                <div class="panel-title">
                    <?php echo get_phrase('change_password');?>
                </div>
            </div>
            <div class="panel-body">
                        <?php echo form_open(base_url().'Manage_Password' , array('class' => 'form-horizontal form-groups validate','target'=>'_top'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('current_password');?></label>
                                <div class="col-sm-5">
                                <input type="password" class="form-control" name="password" required="" value="<?=set_value('password');?>"/>
                                    <p><?=$this->session->userdata('old_pass_error');?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('new_password');?></label>
                                <div class="col-sm-5">
                            <input type="password" class="form-control" name="new_password" value="<?=set_value('new_password');?>" required="" minlength="6" maxlength="128"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('confirm_new_password');?></label>
                                <div class="col-sm-5">
                                <input type="password" class="form-control" name="confirm_new_password" value="<?=set_value('confirm_new_password');?>" required=""  minlength="6" maxlength="128"/>
                                    <p><?=$this->session->userdata('con_pass_error');?></p>
                                </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                <input type="button" class="btn btn-info pull-right" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
                                  <button type="submit" class="btn btn-success pull-right"><?php echo get_phrase('update_password');?></button>
                              </div>
								</div>
                        </form>
            </div>
        </div>
    </div>
</div>