
<div class="row">
    <div class="col-md-12">
    
       
        <!------CONTROL TABS END------>
         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>index.php?superadmin/add_appointment/" method="post" enctype="multipart/form-data">
             
        <div class="tab-content">
           
        <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                
                <div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            
            <div class="panel-body">
    
                
                    <div class="row">
                        <div class="col-sm-6">
                              <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('user'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="user" class="form-control"  autocomplete="off" id="user" list="users" placeholder="e.g. Enter User Email, Mobile Number or User ID" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo set_value('name'); ?>">
    <datalist id="users">
    <option value="UNREGISTERED USER" onchange="return get_register(this.value)">
        <?php 
        $users=$this->db->get('users')->result_array();
        foreach ($users as $row) {
         ?>
<option value="<?php echo $row['name'].' '.$row['lname'];?>"><?php echo $row['unique_id'].'('.$row['email'].')('.$row['phone'].')';?><input type="hidden" name="user_id" value="<?php echo $row['user_id'];?>"></option>
<?php }?>
  </datalist>
                        </div>
                    </div>
<!-- <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('country'); ?></label> 

                        <div class="col-sm-8">
                            <select name="country" class="form-control" id="country" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo set_value('country'); ?>"  onchange="return get_state(this.value)">
                                <option value=""><?php echo get_phrase('select_country'); ?></option>
                                <?php 
                                $admins = $this->db->get_where('country')->result_array();
                                foreach($admins as $row){?>
                                <option value="<?php echo $row['country_id'] ?>"><?php echo $row['name'] ?></option>
                                
                                <?php } ?>
                               
                            </select>
                            <span ><?php echo form_error('country'); ?></span>
                        </div>
                    </div> 
                    
                    
                       <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('state'); ?></label>
                            <div class="col-sm-8">
                                <select name="state" class="form-control" id="state" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo set_value('state'); ?>"  onchange="return get_district(this.value)">
                                    <option value=""><?php echo get_phrase('select_country_first'); ?></option>

                                </select> 
                                <span ><?php echo form_error('state'); ?></span>  
                            </div>
                    </div>
                    
                    
                       <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('district'); ?></label>
                            <div class="col-sm-8">
                                <select name="district" class="form-control" id="district" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo set_value('district'); ?>"  onchange="return get_city(this.value)">
                                    <option value=""><?php echo get_phrase('select_state_first'); ?></option>

                                </select>
                                <span ><?php echo form_error('district'); ?></span>
                            </div>   
                    </div> -->
              
                </div>
                <div class="col-sm-6">
                                 <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('doctor'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="doctor" class="form-control"  autocomplete="off" id="doctor" list="doctors" placeholder="e.g. Hospital Name, Doctor Name or Specialisation " data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo set_value('doctor'); ?>">
    <datalist id="doctors">
        
        <?php 
        $users=$this->db->get('doctors')->result_array();
        foreach ($users as $row) {
         ?>
<option value="<?php echo $row['first_name'];?>"><?php echo $row['id'].'('.$row['useremail'].')('.$row['mobile'].')';?><input type="hidden" name="user_id" value="<?php echo $row['id'];?>"></option>
<?php }?>

  </datalist>
                        </div>
                    </div>

                       <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('from_date'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="from_date" class="form-control datepicker"  autocomplete="off" placeholder="<?php echo get_phrase('from_date'); ?>" id="from_date"   value="<?php echo set_value('from_date'); ?>">
                        </div>
                    </div>
                   
                </div>
                    </div>
                   

            </div>

        </div>

    </div>
</div>
            </div>
           
            <!----CREATION FORM ENDS-->

                
                    </div>
                     <div class="col-sm-3 control-label col-sm-offset-2">
                        <input type="submit" class="btn btn-success" value="<?php echo get_phrase('submit'); ?>">
                    </div> 
                   
   </form>
    </div>
</div>
<script type="text/javascript">
    function get_register(register) {
    alert(register);
    /*
        $.ajax({
            url: '<?php echo base_url();?>index.php?superadmin/get_state/' + country_id ,
            success: function(response)
            {
                jQuery('#state').html(response);
            } 
        });
*/
    }
</script>
<!-- <script type="text/javascript">

    
    function get_state(country_id) {
    
        $.ajax({
            url: '<?php echo base_url();?>index.php?superadmin/get_state/' + country_id ,
            success: function(response)
            {
                jQuery('#state').html(response);
            } 
        });

    }
    function get_district(city_id) {

        $.ajax({
            url: '<?php echo base_url();?>index.php?superadmin/get_district/' + city_id ,
            success: function(response)
            {
                jQuery('#district').html(response);
            }
        });

    }
    function get_city(state_id) {

        $.ajax({
            url: '<?php echo base_url();?>index.php?superadmin/get_city/' + state_id ,
            success: function(response)
            {
                jQuery('#city').html(response);
            }
        });   

    }

</script> -->
