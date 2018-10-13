<?php
$edit_data		=	$this->db->get_where('license' , array('license_id' => $param2) )->result_array();
?>

<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php echo form_open(base_url() . 'index.php?superadmin/license/update/'.$row['license_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
            <div class="padded">
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('license_code');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="license_code" value="<?php echo $row['license_code'];?>" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('license_name');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="description" value="<?php echo $row['description'];?>" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" required/>
                    </div>
                </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-5">
                  <button type="submit" class="btn btn-info"><?php echo "Update";?></button>
              </div>
            </div>
        </form>
        <?php endforeach;?>
    </div>
</div>
