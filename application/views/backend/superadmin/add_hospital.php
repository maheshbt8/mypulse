
<div class="row">
    <div class="col-md-12">
    
        <!------CONTROL TABS START------>   
        <ul class="nav nav-tabs bordered"> 
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo $this->lang->line('labels')['general_info'];?>  
                </a>  
            </li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>  
                    <?php echo $this->lang->line('labels')['licenseInfo'];?>
                </a>
            </li>
              
        </ul>
        <!------CONTROL TABS END------>
         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>index.php?superadmin/hospital/create" method="post" enctype="multipart/form-data">
             
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
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['name'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" id="field-1" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['description'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="description" class="form-control" id="field-10">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['address'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="address" class="form-control" id="field-2"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['email'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="email" class="form-control" id="field-3"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['phone_number'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="phone_number" class="form-control" id="field-4"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="">
                        </div>
                    </div>
                    
                    
                     <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectCountry'];?></label> 

                        <div class="col-sm-8">
                            <select name="country" class="form-control" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value=""  onchange="return get_state(this.value)">
                                <option value=""><?php echo $this->lang->line('labels')['select_country'];?></option>
                                <?php 
                                $admins = $this->db->get_where('country')->result_array();
                                foreach($admins as $row){?>
                                <option value="<?php echo $row['country_id'] ?>"><?php echo $row['name'] ?></option>
                                
                                <?php } ?>
                               
                            </select>
                        </div>
                    </div> 
                    
                    
                       <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectState'];?></label>
                            <div class="col-sm-8">
                                <select name="state" class="form-control" id="select_state"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value=""  onchange="return get_district(this.value)">
                                    <option value=""><?php echo $this->lang->line('labels')['select_country_first'];?></option>

                                </select>   
                            </div>
                    </div>
                    
                    
                       <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectDistrict'];?></label>
                            <div class="col-sm-8">
                                <select name="city" class="form-control" id="select_district"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value=""  onchange="return get_city(this.value)">
                                    <option value=""><?php echo $this->lang->line('labels')['select_state_first'];?></option>

                                </select>
                            </div>   
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectCity'];?></label>
                            <div class="col-sm-8">
                                <select name="city" class="form-control" id="select_city"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value=""  >
                                    <option value=""><?php echo $this->lang->line('labels')['select_district_first'];?></option>

                                </select>
                            </div>
                    </div>
                   
                   
                 
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['ownerName'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="md_name" class="form-control" id="field-8"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['ownerNumber'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="md_phone" class="form-control" id="field-9"  data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="">
                        </div>
                    </div>
                <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['status'];?></label>

                        <div class="col-sm-8">
                            <select name="status" class="form-control" data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" value="">
                                <option value=""><?php echo $this->lang->line('labels')['select_status'];?></option>
                                <option value="1"><?php echo $this->lang->line('active');?></option>
                                <option value="2"><?php echo $this->lang->line('inactive');?></option>
                            </select>
                        </div>
                    </div>  
                  
                   
                </div>
                    </div>
                   

            </div>

        </div>

    </div>
</div>
                
              
            </div>
            <!----TABLE LISTING ENDS--->
            
            
            <!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="add" style="padding: 5px">
                    <div class="row">
    <div class="col-md-6">

        <div class="panel panel-primary" data-collapsed="0">


            <div class="panel-body">
                
                         
                    <div class="row">
                        <div class="col-sm-12">
                
                  <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['license'];?></label> 

                        <div class="col-sm-8">
                            <select name="license" class="form-control"  value="">
                                <option value=""><?php echo $this->lang->line('labels')['select_license'];?></option>
                                <?php 
                                $license = $this->db->get_where('license')->result_array();
                                foreach($license as $row){?>
                                <option value="<?php echo $row['license_id'] ?>"><?php echo $row['name'] ?></option>
                                
                                <?php } ?>
                               
                            </select>
                        </div>
                    </div> 
                   <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['licenseStatus'];?></label>

                        <div class="col-sm-8">
                            <select name="license_status" class="form-control" value="">
                                <option value=""><?php echo $this->lang->line('labels')['select_status'];?></option>
                                <option value="1"><?php echo $this->lang->line('labels')['active'];?></option>
                                <option value="2"><?php echo $this->lang->line('labels')['inactive'];?></option>
                            </select>
                        </div>
                    </div>  
                    
                    
                            
                             <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['from_date'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="from_date" class="form-control datepicker"  autocomplete="off" placeholder="<?php echo $this->lang->line('labels')['selectFromDdate'];?>" id="field-5"   value="">
                        </div>
                    </div>
                            
                   
                        
                        
                        
                     
                             <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['to_date'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="till_date" class="form-control datepicker"  autocomplete="off" placeholder="<?php echo $this->lang->line('labels')['selectToDdate'];?>" id="field-5"   value="">
                        </div>
                    </div>
                     
                   
                </div>
                    </div>
                  
            </div>
            </div></div></div></div>
            <!----CREATION FORM ENDS-->
    
        
            <div class="tab-pane box" id="pro" style="padding: 5px">
                <div class="row">
    <div class="col-md-6">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_general_info'); ?></h3>
                </div>
            </div>

            <div class="panel-body">
                
                        
                    <div class="row">
                        <div class="col-md-12">
                 
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('qualification'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="qualification" class="form-control" id="field-2"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('experience'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="experience" class="form-control" id="field-5"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                        </div>
                    </div>
                   
                     
                   
                </div>
                    </div>    
                    </div>
                  
                          
            </div  
            </div></div></div>
                
                    </div>
                     <div class="col-sm-3 control-label col-sm-offset-2">
                        <input type="submit" class="btn btn-success" value="<?php echo $this->lang->line('buttons')['submit'];?>">
                    </div> 
                    </div>
   </form>
            
           
            <!----CREATION FORM ENDS-->
        
    </div>
</div>



<script type="text/javascript">

    
    function get_state(country_id) {
    
        $.ajax({
            url: '<?php echo base_url();?>index.php?superadmin/get_state/' + country_id ,
            success: function(response)
            {
                jQuery('#select_state').html(response);
            } 
        });

    }
    
    function get_city(state_id) {

        $.ajax({
            url: '<?php echo base_url();?>index.php?superadmin/get_city/' + state_id ,
            success: function(response)
            {
                jQuery('#select_city').html(response);
            }
        });   

    }
    
     function get_district(city_id) {

        $.ajax({
            url: '<?php echo base_url();?>index.php?superadmin/get_district/' + city_id ,
            success: function(response)
            {
                jQuery('#select_district').html(response);
            }
        });

    }

</script>

