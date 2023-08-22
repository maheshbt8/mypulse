<?php
$feed_data=$this->db->get_where('feedback',array('id'=>$id))->row_array();
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-body">
<?php echo form_open(base_url() . 'main/feedback/do_update/'.$id , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top','method'=>'post'));?>
            <div class="padded">
                <div class="col-md-12"> 
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-1 control-label"><?php echo get_phrase('customer'); ?></label>
    <div class="col-sm-11" id="to_ind">
    <select class="form-control select2" name="customer"  data-validate="required" data-message-required="<?php echo 'Please Select Any User';?>" required>
            <optgroup label="<?php echo get_phrase('hospital_admins'); ?>">
                <?php
                $users = $this->db->get('hospitaladmins')->result_array();
                foreach ($users as $row):
                    ?>
                    <option value="<?=$row['unique_id']; ?>" <?php if($feed_data['customer_id']==$row['unique_id']){echo 'selected';}?>>
                        <?php echo $row['unique_id'].' - '.$row['name'].' ( '.$row['email'].' )'; ?></option>
                <?php endforeach; ?>
            </optgroup>
            <optgroup label="<?php echo get_phrase('doctors'); ?>">
                <?php
                $users=$this->crud_model->select_doctor_info();
                foreach ($users as $row):
                    ?>
                    <option value="<?=$row['unique_id'];?>" <?php if($feed_data['customer_id']==$row['unique_id']){echo 'selected';}?>>
                        <?php echo $row['unique_id'].' - '.$row['name'].' ( '.$row['email'].' )'; ?></option>
                <?php endforeach; ?>
            </optgroup>
            <optgroup label="<?php echo get_phrase('nurse'); ?>">
                <?php
                $users=$this->crud_model->select_nurse_info();
                foreach ($users as $row):
                    ?>
                    <option value="<?=$row['unique_id']; ?>" <?php if($feed_data['customer_id']==$row['unique_id']){echo 'selected';}?>>
                        <?php echo $row['unique_id'].' - '.$row['name'].' ( '.$row['email'].' )'; ?></option>
                <?php endforeach; ?>
            </optgroup>
            <optgroup label="<?php echo get_phrase('receptionists'); ?>">
                <?php
                $users=$this->crud_model->select_receptionist_info();
                foreach ($users as $row):
                    ?>
                    <option value="<?=$row['unique_id']; ?>" <?php if($feed_data['customer_id']==$row['unique_id']){echo 'selected';}?>>
                        <?php echo $row['unique_id'].' - '.$row['name'].' ( '.$row['email'].' )'; ?></option>
                <?php endforeach; ?>
            </optgroup>
            <optgroup label="<?php echo get_phrase('medical_stores'); ?>">
                <?php
                $users=$this->crud_model->select_store_info();
                foreach ($users as $row):
                    ?>
                    <option value="<?=$row['unique_id']; ?>" <?php if($feed_data['customer_id']==$row['unique_id']){echo 'selected';}?>>
                        <?php echo $row['unique_id'].' - '.$row['name'].' ( '.$row['email'].' )'; ?></option>
                <?php endforeach; ?>
            </optgroup>
            <optgroup label="<?php echo get_phrase('medical_labs'); ?>">
                <?php
                $users=$this->crud_model->select_lab_info();
                foreach ($users as $row):
                    ?>
                    <option value="<?=$row['unique_id'];?>" <?php if($feed_data['customer_id']==$row['unique_id']){echo 'selected';}?>>
                        <?php echo $row['unique_id'].' - '.$row['name'].' ( '.$row['email'].' )'; ?></option>
                <?php endforeach; ?>
            </optgroup>            
    </select>
    </div> 
                    </div>     
                </div>
                <div class="col-md-12"> 
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-1 control-label"><?php echo get_phrase('feedback'); ?></label>
                             <div class="col-sm-11"> 
<textarea type="text" class="form-control" name="feedback" value=""data-validate="required" data-message-required="<?php echo ucfirst('value_required');?>"rows="10" cols="50" required><?=$feed_data['feedback'];?></textarea>
                            </div>
                    </div>
                    
                </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-10 col-sm-2">
                  <input type="submit" class="btn btn-success" value="Send">&nbsp;&nbsp;<input type="button" class="btn btn-info" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page1'); ?>'">
              </div>
            </div>
        </form>
            </div>
        </div>
    </div>
</div> 
