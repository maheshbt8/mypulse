<!-- <style>
  .exam_chart {
    width       : 100%;
    height      : 265px;
    font-size   : 11px;
  }
</style> -->
 <?php $account_type=$this->session->userdata('login_type');?>
<?php
 $single_hospital_info = $this->db->get_where('hospitals', array('hospital_id' => $hospital_id))->result_array();
foreach ($single_hospital_info as $row) :      
?>
 <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/edit_hospital/<?php echo $row['hospital_id']; ?>" method="post" enctype="multipart/form-data">
    <div class="col-md-12">
        <input type="button" class="btn btn-info pull-right" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab1" data-toggle="tab" class="btn btn-default">
                    <span class="visible-xs"><i class="entypo-home"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('basic_info'); ?></span>
                </a>
            </li>
             <li class="">
                <a href="#tab2" data-toggle="tab" class="btn btn-default">
                    <span class="visible-xs"><i class="entypo-user"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('license_info'); ?></span>
                </a>
            </li>
           <li class="">
                <a href="#tab3" data-toggle="tab" class="btn btn-default">
                    <span class="visible-xs"><i class="entypo-mail"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('branches'); ?></span>
                </a>
            </li> 
            <li class="">
                <a href="#tab4" data-toggle="tab" class="btn btn-default">
                    <span class="visible-xs"><i class="entypo-mail"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('departments'); ?></span>
                </a>
            </li> 
            <li class="">
                <a href="#tab5" data-toggle="tab" class="btn btn-default">
                    <span class="visible-xs"><i class="entypo-mail"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('wards'); ?></span>
                </a>
            </li> 
            <li class="">
                <a href="#tab6" data-toggle="tab" class="btn btn-default">
                    <span class="visible-xs"><i class="entypo-mail"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('beds'); ?></span>
                </a>
            </li> 
        </ul>
<div class="panel panel-default">
            <div class="panel-body">
        <div class="tab-content">
            <?php
$country_info=$this->db->get('country')->result_array();
$single_hospital_info = $this->db->get_where('hospitals', array('hospital_id' => $hospital_id))->result_array();
foreach ($single_hospital_info as $row) {
?>
            <div class="tab-pane box active" id="tab1">
                <div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-body">
    
                
                    <div class="row">
                        <div class="col-sm-6">
                      <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" id="name" value="<?php echo $row['name']; ?>">
                            <span style="color: red"><?php echo form_error('name'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>

                        <div class="col-sm-8">
                            <input type="text" name="description" class="form-control" id="description" value="<?php echo $row['description']; ?>">
                        </div>
                    </div>
                   <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('address'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="address" class="form-control" id="address" value="<?php echo $row['address']; ?>">
                            <span style="color: red"><?php echo form_error('address'); ?></span>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email'); ?></label>

                        <div class="col-sm-8">
                            <input type="email" name="email" class="form-control" id="email" value="<?php echo $row['email']; ?>">
                            <span style="color: red"><?php echo form_error('email'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('phone_number'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="phone_number" class="form-control" id="phone_number" value="<?php echo $row['phone_number']; ?>">
                            <span style="color: red"><?php echo form_error('phone_number'); ?></span>
                        </div>
                    </div>
                <div class="form-group"> 
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('status'); ?></label>

                        <div class="col-sm-8">
                            <select name="status" class="form-control" id="status" value="">
                                <option value=""><?php echo get_phrase('select_status'); ?></option>
                                <option value="1" <?php if($row['status']==1){echo 'selected';}?>><?php echo get_phrase('active'); ?></option>
                                <option value="2" <?php if($row['status']==2){echo 'selected';}?>><?php echo get_phrase('inactive'); ?></option>
                            </select>
                            <span ><?php echo form_error('status'); ?></span>
                        </div>
                    </div>
                  
                   
                </div>
                <div class="col-sm-6">
                      <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('owner/MD_name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="md_name" class="form-control" id="md_name" value="<?php echo $row['md_name']; ?>">
                            <span ><?php echo form_error('md_name'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('owner/MD_phone_number'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="md_phone" class="form-control" id="md_phone" value="<?php echo $row['md_contact_number']; ?>">
                            <span ><?php echo form_error('md_phone'); ?></span>
                        </div>
                    </div>
                     <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('country'); ?></label> 

                        <div class="col-sm-8">
                            <select name="country" class="form-control" id="country" onchange="return get_state(this.value)">
                                <option value=""><span ><?php echo get_phrase('select_country'); ?></span></option>
                                <?php 
                                $admins = $this->db->get('country')->result_array();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['country_id'] ?>" <?php if($row1['country_id'] == $row['country']){echo 'selected';}?>><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
                               
                            </select>
                            <span ><?php echo form_error('country'); ?></span>
                        </div>
                    </div> 
                    
                    
                       <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('state'); ?></label>
                            <div class="col-sm-8">
                                <select name="state" class="form-control" id="state" onchange="return get_district(this.value)">
                                    <option value=""><span ><?php echo get_phrase('select_country_first'); ?></span></option>
                                    <?php 
                                $state = $this->db->where('country_id',$row['country'])->get('state')->result_array();
                                foreach($state as $row2){?>
                                <option value="<?php echo $row2['state_id'] ?>" <?php if($row2['state_id'] == $row['state']){echo 'selected';}?>><?php echo $row2['name'] ?></option>
                                
                                <?php } ?>
                                </select>   
                                <span ><?php echo form_error('state'); ?></span>
                            </div>
                    </div>
                    
                    
                       <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('district'); ?></label>
                            <div class="col-sm-8">
                                <select name="district" class="form-control" id="district" onchange="return get_city(this.value)">
                                    <option value=""><span ><?php echo form_error('select_state_first'); ?></span></option>
                                    <?php 
                                $district = $this->db->where('state_id',$row['state'])->get('district')->result_array();
                                foreach($district as $row3){?>
                                <option value="<?php echo $row3['district_id'] ?>" <?php if($row3['district_id'] == $row['district']){echo 'selected';}?>><?php echo $row3['name'] ?></option>
                                
                                <?php } ?>
                                </select>
                                <span ><?php echo form_error('district'); ?></span>
                            </div>   
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('city'); ?></label>
                            <div class="col-sm-8">
                                <select name="city" class="form-control" id="city">
                                    <option value=""><span ><?php echo form_error('select_district_first'); ?></span></option>
                                    <?php 
                                $admins = $this->db->where('district_id',$row['district'])->get('city')->result_array();
                                foreach($admins as $row4){
                                    ?>
                                <option value="<?php echo $row4['city_id'] ?>" <?php if($row4['city_id'] == $row['city']){echo 'selected';}?>><?php echo $row4['name'] ?></option>
                                <?php } ?>
                                </select>
                                <span ><?php echo form_error('city'); ?></span>
                            </div>
                    </div>

              </div>
              <div class="col-sm-3 control-label col-sm-offset-9">
                <?php if($account_type == 'superadmin' || $account_type == 'hospitaladmins'){?>
                        <input type="submit" class="btn btn-success" value="Update"><?php }?>
                    </div>
                    </div>
                   

            </div>

        </div>

    </div>
    
</div>
</div>
            <div class="tab-pane box" id="tab2" style="padding: 5px">
                    <div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">


            <div class="panel-body">
                
                         
                    <div class="row">
                        <div class="col-sm-6">
                
                         <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('license'); ?></label> 

                        <div class="col-sm-8">
                        
                        <select name="license" class="form-control" id="license" value="" <?php if($account_type!='superadmin'){echo 'disabled';}?>>
                                <option value=""><?php echo get_phrase('select_lisense'); ?></option>
                                <?php 
                                $license = $this->db->get_where('license')->result_array();
                                foreach($license as $row1){?>
                                <option value="<?php echo $row1['license_id'] ?>"<?php if($row['license']== $row1['license_id'] ){ echo 'selected';} ?>><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
                               
                        </select>
                        
                        </div>
                    </div> 
                   <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('license status'); ?></label>

                        <div class="col-sm-8">
                        
                        <select name="license_status" class="form-control" id="license_status" value=""<?php if($account_type!='superadmin'){echo 'disabled';}?>>
                                <option value=""><?php echo get_phrase('select_status'); ?></option>
                                <option value="1" <?php if($row['license_status']==1){echo 'selected';}?>><?php echo get_phrase('active'); ?></option>
                                <option value="2" <?php if($row['license_status']==2){echo 'selected';}?>><?php echo get_phrase('inactive'); ?></option>
                        </select>
                      
                        </div>
                    </div>        
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('from_date'); ?></label>
                        <div class="col-sm-8">
                       
                            <input type="text" name="from_date" class="form-control" id="from_date" value="<?php echo  $row['from_date'] ?>" autocomplete="off"<?php if($account_type!='superadmin'){echo 'disabled';}?>>
                        
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('to_date'); ?></label>

                        <div class="col-sm-8">
                           
                            <input type="text" name="till_date" class="form-control" id="till_date" value="<?php echo $row['till_date']?>" autocomplete="off"<?php if($account_type!='superadmin'){echo 'disabled';}?>>
                        
                        </div>
                    </div>
                   
                </div>
                <div class="col-sm-6">
                                        <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo 'Logo';?></label>

                        <div class="col-sm-5">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                    <img src="<?php echo base_url('uploads/hospitallogs/').$row['hospital_id'].'.png'?>" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileinput-new">Select Logo</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="userfile" accept="image/*" id="userfile">
                                    </span>
                                    <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                  <div class="col-sm-3 control-label col-sm-offset-9">
                    <?php if($account_type == 'superadmin'||$account_type == 'hospitaladmins'){?>
                        <input type="submit" class="btn btn-success" value="Update">
                    <?php }?>
                    </div>
                    </div>
  <?php if($account_type=='hospitaladmins'){?>
<input type="hidden" name="license" value="<?php echo $row['license'];?>"/>
<input type="hidden" name="license_status" value="<?php echo $row['license_status'];?>"/>
<input type="hidden" name="from_date" value="<?php echo $row['from_date'];?>"/>
<input type="hidden" name="till_date" value="<?php echo $row['till_date'];?>"/>
<?php }?>                
            </div>
            </div>
          
        </div>

    </div>
</div>
                   
   
            <div class="tab-pane" id="tab3">
<div style="clear:both;"></div>

<table class="table table-bordered table-striped datatable" id="table-2">  
    <thead>
        <tr>
            <th><?php echo get_phrase('sl_no'); ?></th>
            <th><?php echo get_phrase('name'); ?></th>
            <th><?php echo get_phrase('email'); ?></th>
            <th><?php echo get_phrase('phone'); ?></th>
            <th><?php echo get_phrase('departments'); ?></th>
            <?php if($account_type == 'superadmin'){?>
            <th><?php echo get_phrase('options'); ?></th><?php }?>
        </tr>
    </thead>

    <tbody>
        <?php  
        $branch_info=$this->db->where('hospital_id',$row['hospital_id'])->get('branch')->result_array();
        $i=1;foreach ($branch_info as $row) {
            
            ?>
        
            <tr>
                <td><?php echo $i?></td>
                <td><a href="<?php echo base_url(); ?>main/edit_branch/<?php echo $row['branch_id'] ?>" class="hiper"><?php echo $row['name'] ?></a></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['phone'] ?></td>
                <td>
            <a href="<?php echo base_url(); ?>main/get_hospital_departments/<?php echo $row['branch_id'] ?>" title="Departments"><i class="glyphicon glyphicon-eye-open"></i></a>
                </td><?php if($account_type == 'superadmin'){?>
                <td>
            <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>main/branch/delete/<?php echo $row['branch_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
                </td><?php }?>
            </tr>
        <?php $i++;} ?>
    </tbody>
</table>
            </div>
            <div class="tab-pane" id="tab4">

<div style="clear:both;"></div>

<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><?php echo get_phrase('sl_no'); ?></th>
            <th><?php echo get_phrase('name'); ?></th>
            <th><?php echo get_phrase('hospital_name'); ?></th>
            <th><?php echo get_phrase('branch_name'); ?></th>
            <th><?php echo get_phrase('wards'); ?></th>
            <?php if($account_type == 'superadmin'){?>
            <th><?php echo get_phrase('options'); ?></th><?php }?>
        </tr>
    </thead>

    <tbody>
        <?php
        $department_info=$this->db->where('hospital_id',$row['hospital_id'])->get('department')->result_array();
         $i=1;foreach ($department_info as $row) { ?>   
            <tr>  
                <td><?php echo $i;?></td>
                <td><a href="<?php echo base_url(); ?>main/edit_department/<?php echo $row['department_id'] ?>" class="hiper"><?php echo $row['name'] ?></a></td>
                <td><?php echo $this->db->where('hospital_id',$row['hospital_id'])->get('hospitals')->row()->name; ?></td>
                <td><?php echo $this->db->where('branch_id',$row['branch_id'])->get('branch')->row()->name; ?></td>
                <td><a href="<?php echo base_url(); ?>main/get_hospital_ward/<?php echo $row['department_id'] ?>" title="Wards"><i class="glyphicon glyphicon-eye-open"></i></a></td>
                <?php if($account_type == 'superadmin'){?>
                <td>
            <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>main/department/delete/<?php echo $row['department_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
           
                </td>
            <?php }?>
            </tr>
        <?php $i++;} ?>
    </tbody>
</table>
            </div>
            <div class="tab-pane" id="tab5">

<!--  <a href="<?php echo base_url(); ?>main/add_ward/<?= $department_id;?>"><button  
    class="btn btn-primary pull-right">
        <?php echo get_phrase('add_ward'); ?>
</button></a> -->
<div style="clear:both;"></div>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><?php echo get_phrase('sl_no'); ?></th>
            <th><?php echo get_phrase('name'); ?></th>
            <th><?php echo get_phrase('hospital_name'); ?></th>
            <th><?php echo get_phrase('branch_name'); ?></th>
            <th><?php echo get_phrase('department_name'); ?></th>
            <th><?php echo get_phrase('beds'); ?></th>
            <?php if($account_type == 'superadmin'){?>
            <th><?php echo get_phrase('options'); ?></th><?php }?>
        </tr>
    </thead>

    <tbody>
        
        <?php 
        $ward_info=$this->db->where('hospital_id',$row['hospital_id'])->get('ward')->result_array();
        $i=1;foreach ($ward_info as $row) { ?>   
            <tr>  
                <td><?php echo $i;?></td>
                <td><a href="<?php echo base_url(); ?>main/edit_ward/<?php echo $row['ward_id'] ?>" class="hiper"><?php echo $row['name'] ?></a></td>
                <td><?php echo $this->db->where('hospital_id',$row['hospital_id'])->get('hospitals')->row()->name; ?></td>
                <td><?php echo $this->db->where('branch_id',$row['branch_id'])->get('branch')->row()->name; ?></td>
                <td><?php echo $this->db->where('department_id',$row['department_id'])->get('department')->row()->name; ?></td>
                <td><a href="<?php echo base_url(); ?>main/get_hospital_bed/<?php echo $row['ward_id'] ?>" title="Beds"><i class="glyphicon glyphicon-eye-open"></i></a></td>
                <?php if($account_type == 'superadmin'){?>
                <td>
            <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>main/ward/delete/<?php echo $row['ward_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
                 
                </td><?php }?>
            </tr>
        <?php $i++;} ?>
    </tbody>
</table>

            </div>
            <div class="tab-pane" id="tab6">
<div style="clear:both;"></div>

<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><?php echo get_phrase('Sl_no');?></th>
            <th><?php echo get_phrase('name'); ?></th>
            <th><?php echo get_phrase('hospital_name'); ?></th>
            <th><?php echo get_phrase('branch_name'); ?></th>
            <th><?php echo get_phrase('department_name'); ?></th>
            <th><?php echo get_phrase('ward_name'); ?></th>
            <th><?php echo get_phrase('status'); ?></th>
            <?php if($account_type == 'superadmin'){?>
            <th><?php echo get_phrase('options'); ?></th><?php }?>
        </tr>
    </thead>

    <tbody>
        <?php
        $bed_info=$this->db->where('hospital_id',$row['hospital_id'])->get('bed')->result_array(); 
        $i=1;
        foreach ($bed_info as $row) { ?>   
            <tr>
             
                <td><?php echo $i;?></td>
                <td><a href="<?php echo base_url(); ?>main/edit_bed/<?php echo $row['bed_id'] ?>" class="hiper"><?php echo $row['name'] ?></a></td>
                <td><?php echo $this->db->where('hospital_id',$row['hospital_id'])->get('hospitals')->row()->name; ?></td>
                <td><?php echo $this->db->where('branch_id',$row['branch_id'])->get('branch')->row()->name; ?></td>
                <td><?php echo $this->db->where('branch_id',$row['department_id'])->get('department')->row()->name; ?></td>
                <td><?php echo $this->db->where('ward_id',$row['ward_id'])->get('ward')->row()->name; ?></td>
                <td><?php if($row['bed_status']==1){echo "Available";}elseif($row['bed_status']==2){echo "Not - Available";} ?></td>
                <?php if($account_type == 'superadmin'){?>
                <td>
            <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>main/bed/delete/<?php echo $row['bed_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
                </td><?php }?>
            </tr>
       <?php $i++; } ?>
    </tbody>
</table>

            </div>
        
        </div>
</div>
</div>
  </div>  
</form>
    <?php } ?>
<?php endforeach; ?>

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
    
    function get_city(state_id) {

        $.ajax({
            url: '<?php echo base_url();?>ajax/get_city/' + state_id ,
            success: function(response)
            {
                jQuery('#city').html(response);
            }
        });   

    }
    
     function get_district(city_id) {

        $.ajax({
            url: '<?php echo base_url();?>ajax/get_district/' + city_id ,
            success: function(response)
            {
                jQuery('#district').html(response);
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