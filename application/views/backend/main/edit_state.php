<?php
$edit_data		=	$this->db->get_where('state' , array('state_id' => $param2) )->result_array();

?>

<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php echo form_open(base_url() . 'index.php?superadmin/state/update/'.$row['state_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
            <div class="padded">
                	<div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('country_name'); ?></label> 

                        <div class="col-sm-5">
                            <select name="country_id" class="form-control" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value=""  onchange="return get_branch(this.value)">
                                <option value=""><?php echo get_phrase('select_country'); ?></option>
                                <?php 
                                $country = $this->db->get('country')->result_array();
                                foreach($country as $row1){?>
                                <option value="<?php echo $row1['country_id'] ?>" <?php if($row1['country_id']==$row['country_id']){echo 'selected';}?>><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
                               
                            </select>
                        </div>
                    </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ucfirst('state_name');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"
                            data-validate="required" data-message-required="<?php echo ucfirst('value_required');?>" required/>
                    </div>
                </div>
               
            </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-5">
                  <button type="submit" class="btn btn-info"><?php echo ucfirst('edit_state');?></button>
              </div>
            </div>
        </form>
        <?php endforeach;?>
    </div>
</div>
