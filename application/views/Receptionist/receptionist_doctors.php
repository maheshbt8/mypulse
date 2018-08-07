<?php 
$recdocids = array();
foreach($Result as $recdoc){ 
$recdocids[] = $recdoc->doc_id; 

?>
<?php }
$doctorslinkingstatus = $recdoc->IsForAllDoctors;
?>

				<form action="<?php echo base_url(); ?>receptionist/updaterecepdoctors" method="post" id="form" autocomplete="off">
				<input type="hidden" name="receptionistid" value="<?php echo $ReceptionistID; ?>" />
				<input type="hidden" name="receptionistuserid" value="<?php echo $RecpUserID->user_id; ?>" />
				
				<div class="modal-content">
				  	
				  	<div class="modal-body">
				  		<div class="row" id="tabs">
						  	<div role="tabpanel">
                                
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane active fade in" id="tab1">
										<div class="col-md-12">
										    
											<div class="form-group col-md-6  " >
												<label><?php echo $this->lang->line('labels')['selectBranch'];?>*</label>
												<select name="branch_id" class="BranchID form-control allowalphanumeric" style="width: 77%" >
												<option value="">Please Select</option>
												<?php 
												foreach($Branches as $br){
												?>
												<option value="<?php echo $br->id; ?>" <?php if($Result[0]->branchid == $br->id){echo "selected='selected'";} ?>><?php echo $br->text; ?></option>
												<?php } ?>
												</select>
											</div>
											
											<div class="form-group col-md-6 ">
												<label><?php echo $this->lang->line('labels')['selectDepartment'];?>*</label>
												<div class="ddepartment-list">
												<select name="department_id"  class="DepartmentID form-control allowalphanumeric department_id" style="width: 77%">
												<?php if($doctorslinkingstatus=='1'){ ?>
												<option value="all" selected="selected">Frontdesk / All Departments</option>
												<?php foreach($Departments as $Dep){ ?>
                                                <option value="<?php echo $Dep->deptid; ?>" ><?php echo $Dep->department_name; ?></option>
                                                <?php } ?>
												<?php }else{ ?>
												<option value="all" selected="selected">Frontdesk / All Departments</option>
                                                <?php foreach($Departments as $Dep){ ?>
                                                <option value="<?php echo $Dep->deptid; ?>" <?php if($Result[0]->deptid == $Dep->deptid){echo "selected='selected'";} ?>><?php echo $Dep->department_name; ?></option>
                                                <?php } } ?>
                                                </select>
												</div>
											</div>
											
										</div>
										<div class="col-md-12">
											
											<div class="form-group col-md-6">
											<label><?php echo $this->lang->line('labels')['selectDoctor'];?></label>
											<div class="doctors-list">
											<select name='doc_id[]' class='DoctorID allowalphanumeric'  multiple='multiple'>
											<?php foreach($Doctors as $Doc){ ?>
											<?php //foreach($Result as $recdoc){ ?>
											<option value="<?php echo $Doc->id; ?>" <?php if(in_array($Doc->id,$recdocids)){echo "selected='selected'";} ?>><?php echo $Doc->FullName;?></option>
											<?php } //} ?>
											</select> 
											</div>
											
										</div>
										<div class="col-md-12">
											
										</div>
										
									</div>
									
								</div>
							</div>	
				  			
				  		
						</div>
					</div>	
				  	<div>
				  		<hr>
				  		<div class="row">
						  	<div class="col-md-12 error">
							  	<span class="model_error"></span>
							</div>
					  		<div class="form-group col-md-6">
		                        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal" style="width: 100%;"><span class="fa fa-remove" style="margin: 5px"></span><?php echo $this->lang->line('buttons')['cancel'];?></button>
		                    </div>

		                    <div class="form-group col-md-6">
		                        <button type="submit" class="btn btn-info btn-lg action-update-btn" id="" style="width: 100%;"><span style="margin: 5px" class="fa fa-check"></span><?php echo $this->lang->line('buttons')['update'];?></button>
		                    </div>
		                    
		                </div>
					</div>
				</div>
				</form>
<script type="text/javascript">
		
			$(document).ready(function(){
<?php
					$this->load->view("template/location");
				?>
				var branch_id = null;
				var department_id = null;
				var doctor_id = null;

				var validator = $("#form").validate({
					ignore: [],
			        rules: {			        	
			        	branch_id:{
			        		required:true,
							
			        	},
						department_id:{
			        		required:true,
							
			        	}
			        },
			        messages: {
			        	
			        	branch_id:{
			        		required:"<?php echo $this->lang->line('validation')['selectBranch'];?>"
							
			        	},
			        	department_id:{
			        		required:"<?php echo $this->lang->line('validation')['selectDepartment'];?>"
							
			        	}
			        },
					invalidHandler: validationInvalidHandler,
					errorPlacement: validationErrorPlacement
					
				});
				
				
$('.BranchID').on('change',function(){
   $HospitalID = '<?php echo $this->session->userdata('hospital_id'); ?>';
   $branchid = $(this).val();
   //$(".department_id").attr("disabled",false);
   $.ajax({
				url: "<?php echo site_url(); ?>index/searchDepartment/",
				type: "GET",
				data: { "hospital_id":$HospitalID,"branch_id":$branchid,"f":"department_name"},
				success: function(results) {
				$(".ddepartment-list").html(results);
					
				},
				error: function() {
					callback();
				}
			})
			
  });
  
$(document).on('change','.DepartmentID',function(){
   $departmentid = $(this).val();
   //$branchid = (".branch_id").val();
   $branchid = $('.BranchID').find(":selected").attr('value');
   $.ajax({
				url: "<?php echo site_url(); ?>index/searchDepartmentDoctor/",
				type: "GET",
				data: {"dept_id":$departmentid,"branch_id":$branchid},
				success: function(results) {
				$(".doctors-list").html(results);
					
				},
				error: function() {
					callback();
				}
			})

});  
  /*$('.action-update-btn').on('click', function(){
	     $BranchID = $('.branch_id').val();
		 alert($BranchID);
		 $DepartmentID = $('.DepartmentID').val();
		 $DoctorID = $('.DoctorID').val();
		 if($DepartmentID==''){
		 alert('<?php echo $this->lang->line('validation')['selectBranch'];?>');
		 return false;
		 }else if($BranchID==''){
		 return false;
		 }else if($DoctorID==''){
		 return false;
		 } 
		 //if()
		}); */
});
</script>			