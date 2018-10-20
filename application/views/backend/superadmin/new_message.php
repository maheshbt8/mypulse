<?php $ward=$this->db->where('ward_id',$ward_id)->get('ward')->row_array();
?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-head">


            </div>
            <div class="panel-body">

                <?php echo form_open(base_url() . 'index.php?superadmin/new_message/' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
            <div class="padded">
                <div class="col-md-12"> 
                    <div class="form-group">
                        <input type="hidden" name="hospital_id" class="hospital_id" id="hospital_id" value="0">
                        <label for="field-ta" class="col-sm-1 control-label"><?php echo get_phrase('to'); ?></label>
                        <div class="col-sm-11">
                            <select name="message_type" class="form-control" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="" onchange="return show_repete(this.value)">
                                
                                <option value="0"><?php echo "Group Message";?></option>
                                <option value="1"><?php echo "Private Message";?></option>
                            </select>
                        </div><br/><br/>
    <div class="col-sm-1"> </div>
    <div class="col-sm-11" id="to_all"> 
    <label for="alls">To All Staff</label>
    <input type="checkbox" name="user_to[]" class="email-check" id="alls" value="0">
    <label for="ha">All Hospital Admins</label>
    <input type="checkbox" name="user_to[]" class="email-check" id="ha" value="1">
    <label for="ml">All Medical Labs</label>
    <input type="checkbox" name="user_to[]" class="email-check" id="ml" value="2">
    <label for="ms">All Medical Stores</label>
    <input type="checkbox" name="user_to[]" class="email-check" id="ms" value="3">
    <label for="hd">All Doctors</label>
    <input type="checkbox" name="user_to[]" class="email-check" id="hd" value="6">
    <label for="hn">All Nurses</label>
    <input type="checkbox" name="user_to[]" class="email-check" id="hn" value="4">
    <label for="hr">All Receptionists</label>
    <input type="checkbox" name="user_to[]" class="email-check" id="hr" value="5">
    <label for="hp">All Patients</label>
    <input type="checkbox" name="user_to[]" class="email-check" id="hp" value="7">
    </div>
    <div class="col-sm-8" id="to_ind"> 
    <select class="form-control select2" name="reciever[]"  data-validate="required" data-message-required="<?php echo 'Please Select Any User';?>" required multiple>

            <option value=""><?php echo get_phrase('select'); ?></option>
            <optgroup label="<?php echo get_phrase('hospital_admins'); ?>">
                <?php
                $users = $this->db->get('hospitaladmins')->result_array();
                foreach ($users as $row):
                    ?>
                    <option value="hospitaladmins-admin-<?php echo $row['admin_id']; ?>">
                        <?php echo $row['unique_id'].' - '.$row['name'].' ( '.$row['email'].' )'; ?></option>
                <?php endforeach; ?>
            </optgroup>
            <optgroup label="<?php echo get_phrase('doctors'); ?>">
                <?php
                $users = $this->db->get('doctors')->result_array();
                foreach ($users as $row):
                    ?>
                    <option value="doctors-doctor-<?php echo $row['docotr_id']; ?>">
                        <?php echo $row['unique_id'].' - '.$row['name'].' ( '.$row['email'].' )'; ?></option>
                <?php endforeach; ?>
            </optgroup>
            <optgroup label="<?php echo get_phrase('nurse'); ?>">
                <?php
                $users = $this->db->get('nurse')->result_array();
                foreach ($users as $row):
                    ?>
                    <option value="nurse-nurse-<?php echo $row['nurse_id']; ?>">
                        <?php echo $row['unique_id'].' - '.$row['name'].' ( '.$row['email'].' )'; ?></option>
                <?php endforeach; ?>
            </optgroup>
            <optgroup label="<?php echo get_phrase('receptionists'); ?>">
                <?php
                $users = $this->db->get('nurse')->result_array();
                foreach ($users as $row):
                    ?>
                    <option value="receptionist-receptionist-<?php echo $row['receptionist_id']; ?>">
                        <?php echo $row['unique_id'].' - '.$row['name'].' ( '.$row['email'].' )'; ?></option>
                <?php endforeach; ?>
            </optgroup>
            <optgroup label="<?php echo get_phrase('medical_stores'); ?>">
                <?php
                $users = $this->db->get('medicalstores')->result_array();
                foreach ($users as $row):
                    ?>
                    <option value="medicalstores-store-<?php echo $row['store_id']; ?>">
                        <?php echo $row['unique_id'].' - '.$row['name'].' ( '.$row['email'].' )'; ?></option>
                <?php endforeach; ?>
            </optgroup>
            <optgroup label="<?php echo get_phrase('medical_labs'); ?>">
                <?php
                $users = $this->db->get('medicallabs')->result_array();
                foreach ($users as $row):
                    ?>
                    <option value="medicallabs-lab-<?php echo $row['lab_id']; ?>">
                        <?php echo $row['unique_id'].' - '.$row['name'].' ( '.$row['email'].' )'; ?></option>
                <?php endforeach; ?>
            </optgroup>
            <optgroup label="<?php echo get_phrase('users'); ?>">
                <?php
                $users = $this->db->get('users')->result_array();
                foreach ($users as $row):
                    ?>
                    <option value="users-user-<?php echo $row['user_id']; ?>">
                        <?php echo $row['unique_id'].' - '.$row['name'].' ( '.$row['email'].' )'; ?></option>
                <?php endforeach; ?>
            </optgroup>
            
    </select>
    </div> 
                    </div>     
                </div>
                <div class="col-md-12"> 
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-1 control-label"><?php echo get_phrase('title'); ?></label>
                             <div class="col-sm-8"> 
<input type="text" class="form-control" name="title" value="" data-validate="required" data-message-required="<?php echo ucfirst('value_required');?>" required>
                            </div>
                    </div>
                    
                </div>
                <div class="col-md-12"> 
                    <div class="form-group">
                <label for="field-ta" class="col-sm-1 control-label"><?php echo get_phrase('message'); ?></label>
            </div>
            </div>
             <div class="form-group">

                    <div class="col-sm-12">
            <textarea type="text" class="form-control" name="message" value=""data-validate="required" data-message-required="<?php echo ucfirst('value_required');?>" required></textarea>
                    </div>
                </div>
               
            </div>
            <div class="form-group">
              <div class="col-sm-offset-10 col-sm-2">
                  <input type="submit" class="btn btn-success" value="Submit">&nbsp;&nbsp;<input type="button" class="btn btn-info" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
              </div>
            </div>
        </form>
            </div>

        </div>

    </div>
</div>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/js/ckeditor/ckeditor.js"></script> 

<script type="text/javascript">
    $(document).ready(function(){
    $("#to_ind").hide();
    });
    function show_repete(id) {
        if(id == 1){
        $("#to_ind").show();
        $("#to_all").hide();
        }
        if(id == 0){
        $("#to_ind").hide();
        $("#to_all").show();
        }
    }

</script>
<script>
    CKEDITOR.replace( 'message' );
</script>
  <script>
  $( function() {
    $( ".email-check" ).checkboxradio({
      icon: false
    });
  } );
  </script> 
