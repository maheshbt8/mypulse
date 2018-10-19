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
                        <label for="field-ta" class="col-sm-1 control-label"><?php echo get_phrase('to'); ?></label>
                             <div class="col-sm-11"> 
      
    <label for="alls">To All Staff</label>
    <input type="checkbox" name="user_to[]" class="email-check" id="alls" value="0">
    <label for="ha">All Hospital Admins</label>
    <input type="checkbox" name="user_to[]" class="email-check" id="ha" value="1">
    <label for="ml">All Medical Labs</label>
    <input type="checkbox" name="user_to[]" class="email-check" id="ml" value="2">
    <label for="ms">All Medical Stores</label>
    <input type="checkbox" name="user_to[]" class="email-check" id="ms" value="3">
    <label for="hn">All Nurses</label>
    <input type="checkbox" name="user_to[]" class="email-check" id="hn" value="4">
    <label for="hr">All Receptionists</label>
    <input type="checkbox" name="user_to[]" class="email-check" id="hr" value="5">
    <label for="hd">All Doctors</label>
    <input type="checkbox" name="user_to[]" class="email-check" id="hd" value="6">
    <label for="hp">All Patients</label>
    <input type="checkbox" name="user_to[]" class="email-check" id="hp" value="7">
    

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