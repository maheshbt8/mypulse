
<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------>   
		<ul class="nav nav-tabs bordered"> 
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo 'Basic_info';?> 
                </a>
			</li>      
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>  
					<?php echo 'Medical_store_incharge_info';?>
                </a>
			</li>
				<li>
            	<a href="#pro" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo 'Professional_info';?> 
                </a>
			</li>
		</ul>
    	<!------CONTROL TABS END------>
         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>index.php?superadmin/medical_stores/update/<?php echo $id ?>" method="post" enctype="multipart/form-data">
             
		<div class="tab-content">
		   
        <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
				
				<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_basic_info'); ?></h3>
                </div>
            </div>

            <div class="panel-body">
    
                
                    <div class="row">
                        <div class="col-sm-6">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase(' name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" id="field-1" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo $this->db->get_where('medical_stores',array('store_id'=>$id))->row()->name ?>">
                        </div>
                    </div>
                   
                  
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="description" class="form-control" id="field-5"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo $this->db->get_where('medical_stores',array('store_id'=>$id))->row()->description ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('address'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="address" class="form-control" id="field-5"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo $this->db->get_where('medical_stores',array('store_id'=>$id))->row()->address ?>">
                        </div>
                    </div>
                    
                       <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase(' Phone_number'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="phone_number" class="form-control" id="field-9"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo $this->db->get_where('medical_stores',array('store_id'=>$id))->row()->phone ?>">  
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('owner/md name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="owner_name" class="form-control" id="field-5"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo $this->db->get_where('medical_stores',array('store_id'=>$id))->row()->owner_name ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('owner/md mobile number'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="owner_mobile" class="form-control" id="field-5"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo $this->db->get_where('medical_stores',array('store_id'=>$id))->row()->owner_mobile ?>">
                        </div>
                    </div>
                  
                 
                 
           	<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label "><?php echo ucfirst('hospital');?></label>
                        
						<div class="col-sm-8">
							<select name="hospital" class="form-control selectboxit">
                              <option value=""><?php echo ucfirst('select_hospital');?></option>
                              <?php
                              	$sections = $this->db->get_where('hospitals' , array('status' => 1))->result_array();
                            	$hospital= $this->db->get_where('medical_stores',array('store_id'=>$id))->row()->hospital;
                            	//echo $hospital;
                            	//die;
                              
                              	foreach($sections as $row2):
                              ?>  
                              <option value="<?php echo $row2['hospital_id'];?>"
                              	<?php if($hospital == $row2['hospital_id']) echo 'selected';?>><?php echo $row2['name'];?></option>
                          <?php endforeach;?>
                          </select>
						</div> 
					</div>
					
						<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label "><?php echo ucfirst('branch');?></label>
                        
						<div class="col-sm-8">
							<select name="branch" class="form-control selectboxit">
                              <option value=""><?php echo ucfirst('select_branch');?></option>
                              <?php
                              	$sections1 = $this->db->get_where('branch' , array('status' => 1))->result_array();
                            	$branch= $this->db->get_where('medical_stores',array('store_id'=>$id))->row()->branch;
                            	//echo $hospital;
                            	//die;
                              
                              	foreach($sections1 as $row3):
                              ?>  
                              <option value="<?php echo $row3['branch_id'];?>"
                              	<?php if($branch == $row3['branch_id']) echo 'selected';?>><?php echo $row3['name'];?></option>
                          <?php endforeach;?>
                          </select>
						</div>   
					</div>
					
					<!--	<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label "><?php echo ucfirst('status');?></label>
                        
						<div class="col-sm-8">
						     <?php  $status= $this->db->get_where('medical_stores',array('store_id'=>$id))->row()->status; ?>
						 <select name="status" class="form-control selectboxit" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                                <option value=""><?php echo get_phrase('select_status'); ?></option>
                                <option value="1"  <?php if($status == 1){ echo 'selected';} ?>><?php echo get_phrase('active'); ?></option>
                                <option value="0" <?php  if($status == 0){ echo 'selected';}?>><?php echo get_phrase('inactive'); ?></option>
                            </select>
						</div> 
					</div>-->
                   
                </div>
                    </div>
                    <!--<div class="col-sm-3 control-label col-sm-offset-2">
                        <input type="submit" class="btn btn-success" value="Submit">
                    </div>
               -->

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

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_general_info'); ?></h3>
                </div>
            </div>

            <div class="panel-body">
                
                         
                    <div class="row">
                        <div class="col-sm-12">
                
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('first name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="fname" class="form-control" id="field-2"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo $this->db->get_where('medical_stores',array('store_id'=>$id))->row()->fname ?>">
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Last name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="lname" class="form-control" id="field-2"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo $this->db->get_where('medical_stores',array('store_id'=>$id))->row()->fname ?>">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email'); ?></label>

                        <div class="col-sm-8">
                            <input type="email" name="email" class="form-control" id="field-7"  data-validate="required" data-message-required="<?php echo 'Value_required';?>"value="<?php echo $this->db->get_where('medical_stores',array('store_id'=>$id))->row()->fname ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('aadhar'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="aadhar" class="form-control" id="field-4"  data-validate="required" data-message-required="<?php echo 'Value_required';?>"value="<?php echo $this->db->get_where('medical_stores',array('store_id'=>$id))->row()->fname ?>">
                        </div>
                    </div>
                    
                     	<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label "><?php echo ucfirst('gender');?></label>
                        
						<div class="col-sm-8">
						     <?php
                              	
                            	$gender= $this->db->get_where('medical_stores',array('store_id'=>$id))->row()->gender;
                            	
                            	
                            ?>
							<select name="gender" class="form-control selectboxit">
                              <option value=""><?php echo ucfirst('select_gender');?></option>
                              <option value="male" <?php if($gender == 'male'){ echo 'selected';} ?>><?php echo ucfirst('male');?></option>
                              <option value="female" <?php if($gender == 'female'){ echo 'selected';} ?>><?php echo ucfirst('female');?></option>
                             
                                
                          </select>
						</div> 
					</div>
                      <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Date of birth'); ?></label>

                        <div class="col-sm-8">
                            <input type="date" name="dob" class="form-control" id="field-2"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo $this->db->get_where('medical_stores',array('store_id'=>$id))->row()->dob ?>">
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Incharge address'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="in_address" class="form-control" id="field-5"  data-validate="required" data-message-required="<?php echo 'Value_required';?>"value="<?php echo $this->db->get_where('medical_stores',array('store_id'=>$id))->row()->in_address ?>">
                        </div>
                    </div>
                    
                   
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo 'Photo';?></label>

						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="http://placehold.it/200x200" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Select image</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="userfile" accept="image/*">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>
                   
                </div>
                    </div>
                    <!--<div class="col-sm-3 control-label col-sm-offset-2">-->
                    <!--    <input type="submit" class="btn btn-success" value="Submit">-->
                    <!--</div>-->
                            
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
                            <input type="text" name="qualification" class="form-control" id="field-2"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo $this->db->get_where('medical_stores',array('store_id'=>$id))->row()->qualification ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('profession'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="profession" class="form-control" id="field-4"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo $this->db->get_where('medical_stores',array('store_id'=>$id))->row()->profession ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('experience'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="experience" class="form-control" id="field-5"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo $this->db->get_where('medical_stores',array('store_id'=>$id))->row()->experience ?>">
                        </div>
                    </div>
                   
				     
                   
                </div>
                    </div>    
                    </div>
                  
                          
			</div  
			</div></div></div>
                
                    </div>
                     <div class="col-sm-3 control-label col-sm-offset-2">
                        <input type="submit" class="btn btn-success" value="Submit">
                    </div> 
   </form
			
		   
			<!----CREATION FORM ENDS-->
		</div>
	</div>
</div>
</div>
</div>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable();
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script>