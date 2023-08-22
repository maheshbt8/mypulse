<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-body">
<?php echo form_open(base_url() . 'main/send_feedback/' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top','method'=>'post'));?>
            <div class="padded">
                <div class="col-md-12"> 
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-1 control-label"><?php echo get_phrase('feedback'); ?></label>
                             <div class="col-sm-11"> 
<textarea type="text" class="form-control" name="feedback" value=""data-validate="required" data-message-required="<?php echo ucfirst('value_required');?>"rows="10" cols="50" required></textarea>
                            </div>
                    </div>
                    
                </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-10 col-sm-2">
                  <input type="submit" class="btn btn-success" value="Send">&nbsp;&nbsp;<input type="button" class="btn btn-info" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
              </div>
            </div>
        </form>
            </div>
        </div>
    </div>
</div> 
