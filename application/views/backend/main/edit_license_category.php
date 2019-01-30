<?php
$edit_data		=	$this->db->get_where('license_category' , array('license_category_id' => $param2) )->result_array();
?>

<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php echo form_open(base_url() . 'main/license_category/update/'.$row['license_category_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
            <div class="padded">
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('license_category_code');?></label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="license_category_code" value="<?php echo $row['license_category_code'];?>" data-validate="required" data-message-required="Value Required" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('license_category_name');?></label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="license_category_name" value="<?php echo $row['name'];?>" data-validate="required" data-message-required="Value Required" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('license_category_description');?></label>
                    <div class="col-sm-7">
                        <textarea type="text" class="form-control" name="license_category_description" value="" data-validate="required" data-message-required="Value Required" required><?php echo $row['description'];?>
                        </textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-8">
                  <button type="submit" class="btn btn-success pull-right"><?php echo "Update";?></button>
              </div>
            </div>
        </form>
        <?php endforeach;?>
    </div>
</div>
