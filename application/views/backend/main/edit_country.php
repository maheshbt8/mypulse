<?php
$row		=	$this->crud_model->select_country_info_id($param2);
?>
<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php echo form_open(base_url() . 'main/country/update/'.$row['country_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
            <div class="padded">
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo 'Country';?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="name" value="<?php echo $row['country_name'];?>"
                            data-validate="required" data-message-required="<?php echo 'Value Required';?>" required/>
                    </div>
                </div>
               
            </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-5">
                  <button type="submit" class="btn btn-success pull-right"><?php echo 'Update';?></button>
              </div>
            </div>
        </form>
    </div>
</div>
