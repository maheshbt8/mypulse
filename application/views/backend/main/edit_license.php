<?php
$row=$this->crud_model->select_license_id($param2);
?>
<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php echo form_open(base_url() . 'main/license/update/'.$row['license_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
            <div class="padded">
                <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('license_category');?></label>
    <div class="col-sm-5">
        <select class="form-control select2" name="license_category" data-validate="required" data-message-required="<?php echo 'Value_required';?>"  <?php if($row['row_status_cd']==0){echo "disabled";}?>>
                <?php 
                $admins = $this->crud_model->select_license_category();
                foreach($admins as $row1){?>
                <option value="<?php echo $row1['license_category_id'] ?>" <?php if($row1['license_category_id']==$row['license_category_id']){echo 'selected';}?>><?php echo $row1['license_category_code'].' / '.$row1['lic_category_name'] ?></option>
                                
                                <?php } ?>
                                    </select>
                                </div>
                            </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('license_code');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="license_code" value="<?php echo $row['license_code'];?>" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" required  <?php if($row['row_status_cd']==0){echo "disabled";}?>/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('license_name');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="name" value="<?php echo $row['license_name'];?>" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" required  <?php if($row['row_status_cd']==0){echo "disabled";}?>/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                    <div class="col-sm-5">
                        <textarea type="text" class="form-control" name="description" value="" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" required <?php if($row['row_status_cd']==0){echo "disabled";}?>><?php echo $row['description'];?></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-5">
                <?php if($row['row_status_cd']!=0){?>
                  <button type="submit" class="btn btn-success pull-right"><?php echo "Update";?></button><?php }?>
              </div>
            </div>
        </form>
    </div>
</div>
