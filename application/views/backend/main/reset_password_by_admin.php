
<!--password-->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" >
            <div class="panel-heading">
                <div class="panel-title">
                   Reset Password
                </div>
            </div>
            <div class="panel-body">
                <?php echo form_open(base_url().'Password-Reset' , array('class' => 'form-horizontal form-groups validate','target'=>'_top'));?>
                <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Search Person</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control" name="user_value" id="user_value" required="" value="<?=set_value('user_value');?>" onchange="return get_user_data(this.value)" autocomplete="off" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">New Password</label>
                                <div class="col-sm-9">
                            <input type="password" class="form-control" name="new_password" value="" required="" minlength="6" maxlength="10"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('confirm_new_password');?></label>
                                <div class="col-sm-9">
                                <input type="password" class="form-control" name="confirm_new_password" value="" required=""/>
                                    <p><?=$this->session->userdata('con_pass_error');?></p>
                                </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-9">
                                <input type="button" class="btn btn-info pull-right" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
                                  <button type="submit" class="btn btn-success pull-right"><?php echo get_phrase('update_password');?></button>
                              </div>
								</div>
                        </div>
                        <div class="col-md-6">
                            <div id="user_info">
                                <?php if($this->session->flashdata('user_error')!=''){echo '<span class="error">No Data Found</span>';}?>
                            </div>
                        </div>
                        </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        var user_value=$('#user_value').val();
        if(user_value!=''){
        get_user_data(user_value);
        }
    });
    function get_user_data(user_value) {
     $.ajax({
            type : "POST",
            url: '<?php echo base_url();?>ajax/get_persons_data/' ,
            data : {user : user_value},
            success: function(response)
            {
                jQuery('#user_info').html(response);        
            } 
        });
    }
</script>