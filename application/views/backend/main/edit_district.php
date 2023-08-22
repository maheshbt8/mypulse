<?php
$row=$this->crud_model->select_district_info_id($param2);
?>
<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php echo form_open(base_url() . 'main/district/update/'.$row['district_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
            <div class="padded">
                	<div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo 'Country';?></label> 

                        <div class="col-sm-5">
            <select name="country_id" class="form-control select2" data-validate="required" data-message-required="<?php echo 'Value Required';?>" value=""  onchange="return get_state1(this.value)">
                                <?php 
                                $country = $this->crud_model->select_country_info();
                                foreach($country as $row1){?>
                                <option value="<?php echo $row1['country_id'] ?>" <?php if($row1['country_id']==$row['country_id']){echo 'selected';}?>><?php echo $row1['country_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                      <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo 'State';?></label> 

                        <div class="col-sm-5">
                            <select name="state_id" class="form-control select2" data-validate="required" data-message-required="<?php echo 'Value Required';?>" id="state_edit"   value="">
                                <option value="">Select State</option>
                                <?php 
                                $state = $this->crud_model->select_state($row['country_id']);
                                foreach($state as $row2){?>
                                <option value="<?php echo $row2['state_id'] ?>" <?php if($row2['state_id']==$row['state_id']){echo 'selected';}?>><?php echo $row2['state_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                          
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo 'District';?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="name" value="<?php echo $row['dist_name'];?>"
                            data-validate="required" data-message-required="<?php echo ucfirst('Value Required');?>" required/>
                    </div>
                </div>
               
            </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-5">
                  <button type="submit" class="btn btn-success pull-right"><?php echo 'Submit';?></button>
              </div>
            </div>
        </form>
    </div>
</div>
