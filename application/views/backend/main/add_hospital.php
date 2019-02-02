
<div class="row">
    <div class="col-md-12">
    
        <!------CONTROL TABS START------>   
        <ul class="nav nav-tabs bordered"> 
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                   <?php echo get_phrase('basic_info'); ?>  
                </a>  
            </li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>  
                    <?php echo get_phrase('license_info'); ?>
                </a>
            </li>
              
        </ul>
        <!------CONTROL TABS END------>
         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/add_hospital/" method="post" enctype="multipart/form-data">
       <div class="panel panel-default">
            <div class="panel-body">      
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
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" id="name" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo set_value('name'); ?>" value="<?php echo set_value('name'); ?>">
                            <span ><?php echo form_error('name'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="description" class="form-control" id="description"data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo set_value('description'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('address'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="address" class="form-control" id="address" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo set_value('address'); ?>">
                            <span ><?php echo form_error('address'); ?></span>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email'); ?></label>

                        <div class="col-sm-8">
                            <input type="email" name="email" class="form-control" id="email" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo set_value('email'); ?>">
                            <span ><?php echo form_error('email'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('phone_number'); ?></label>

                        <div class="col-sm-8">
                            <input type="number" name="phone_number" class="form-control" id="phone_number" value="<?php echo set_value('phone_number'); ?>" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" minlength="10" maxlength="10">
                            <span ><?php echo form_error('phone_number'); ?></span>
                        </div>
                    </div>
                <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('status'); ?></label>

                        <div class="col-sm-8">
                            <select name="status" class="form-control" id="status" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo set_value('status'); ?>">
                                <option value=""><?php echo get_phrase('select_status'); ?></option>
                                <option value="1" selected=""><?php echo get_phrase('active'); ?></option>
                                <option value="2"><?php echo get_phrase('inactive'); ?></option>
                            </select>
                            <span ><?php echo form_error('status'); ?></span>
                        </div>
                    </div>  
                </div>
                <div class="col-sm-6">
                      
                                <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('owner/MD_name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="md_name" class="form-control" id="md_name" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo set_value('md_name'); ?>">
                            <span ><?php echo form_error('md_name'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('owner/MD_phone_number'); ?></label>

                        <div class="col-sm-8">
                            <input type="number" name="md_phone" class="form-control" id="md_phone"  data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo set_value('md_phone'); ?>"  minlength="10" maxlength="10">
                            <span ><?php echo form_error('md_phone'); ?></span>
                        </div>
                    </div>
         
                     <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('country'); ?></label> 

                        <div class="col-sm-8">
                            <select name="country" class="form-control select2" id="country" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo set_value('country'); ?>"  onchange="return get_state(this.value)">
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
                                <select name="state" class="form-control select2" id="state" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo set_value('state'); ?>"  onchange="return get_district(this.value)">
                                    <option value=""><?php echo get_phrase('select_state'); ?></option>

                                </select> 
                                <span ><?php echo form_error('state'); ?></span>  
                            </div>
                    </div>
                    
                    
                       <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('district'); ?></label>
                            <div class="col-sm-8">
                                <select name="district" class="form-control select2" id="district" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo set_value('district'); ?>"  onchange="return get_city(this.value)">
                                    <option value=""><?php echo get_phrase('select_district'); ?></option>

                                </select>
                                <span ><?php echo form_error('district'); ?></span>
                            </div>   
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('city'); ?></label>
                            <div class="col-sm-8">
                                <select name="city" class="form-control select2" id="city" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php echo set_value('city'); ?>"  >
                                    <option value=""><?php echo get_phrase('select_city'); ?></option>

                                </select>
                                <span ><?php echo form_error('city'); ?></span>
                            </div>
                    </div>
                   
                </div>
                    </div>
                   

            </div>

        </div>

    </div>
</div>
            </div>
            <div class="tab-pane box" id="add" style="padding: 5px">
                    <div class="row">
    <div class="col-md-6">

        <div class="panel panel-primary" data-collapsed="0">


            <div class="panel-body">
                
                         
                    <div class="row">
                        <div class="col-sm-12">
                
                  <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('license'); ?></label> 

                        <div class="col-sm-8">
                            <select name="license" class="form-control select2" id="license" value="<?php echo set_value('license'); ?>">
                                <option value=""><?php echo get_phrase('select_license'); ?></option>
                                <?php 
                                $license = $this->db->get_where('license')->result_array();
                                foreach($license as $row){?>
                                <option value="<?php echo $row['license_id'] ?>"><?php echo $row['name'] ?></option>
                                
                                <?php } ?>
                               
                            </select>
                        </div>
                    </div> 
                   <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('license_status'); ?></label>

                        <div class="col-sm-8">
                            <select name="license_status" class="form-control" id="license_status" value="<?php echo set_value('license_status'); ?>">
                                <option value=""><?php echo get_phrase('select_status'); ?></option>
                                <option value="1"><?php echo get_phrase('active'); ?></option>
                                <option value="2"><?php echo get_phrase('inactive'); ?></option>
                            </select>
                        </div>
                    </div>  
                    
                    
                            
                             <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('from_date'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="from_date" class="form-control datepicker"  autocomplete="off" placeholder="<?php echo get_phrase('from_date'); ?>" id="from_date"   value="<?php echo set_value('from_date'); ?>">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('to_date'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="till_date" class="form-control datepicker"  autocomplete="off" placeholder="<?php echo get_phrase('to_date'); ?>" id="till_date"   value="<?php echo set_value('till_date'); ?>">
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
                     <div class="col-sm-3 control-label col-sm-offset-9">
                        <input type="submit" class="btn btn-success" value="<?php echo get_phrase('submit'); ?>">&nbsp;&nbsp;
                        <input type="button" class="btn btn-info" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
                    </div> 
                   </div>
               </div>
   </form>
    </div>
</div>
<script type="text/javascript">

    
    function get_state(country_id) {
    
        $.ajax({
            url: '<?php echo base_url();?>ajax/get_state/' + country_id ,
            success: function(response)
            {
                jQuery('#state').html(response);
            } 
        });

    }
    function get_district(state_id) {

        $.ajax({
            url: '<?php echo base_url();?>ajax/get_district/' + state_id ,
            success: function(response)
            {
                jQuery('#district').html(response);
            }
        });

    }
    function get_city(district_id) {

        $.ajax({
            url: '<?php echo base_url();?>ajax/get_city/' + district_id ,
            success: function(response)
            {
                jQuery('#city').html(response);
            }
        });   

    }

</script>

<script type="text/javascript">
                    $(document).ready(function(){
                    var date = new Date();
                    date.setDate(date.getDate());

                    $('#from_date').datepicker({ 
                    startDate: date

                    });

                    $('#till_date').datepicker({ 
                    startDate: date

                    });

                    } );                  

</script>