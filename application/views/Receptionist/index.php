<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
$this->load->view("template/header.php");
$this->load->view("template/left.php");
?>
			<input type="hidden" id="left_active_menu" value="6" />
		<div id="main-wrapper">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="card ">
						<div class="card-head">
							<header><?php echo $this->lang->line('receptionists');?></header>
							<div class="custome_card_header">
								<a class="btn btn-success m-b-sm addbtn getbranches" data-toggle="tooltip" href="javascript:void(0);" data-toggle="modal" data-target="#edit" style=""><?php echo $this->lang->line('buttons')['addNew'];?></a>
								<a class="btn btn-danger m-b-sm multiDeleteBtn" data-at="receptionist" href="javascript:void(0);"  style="margin-left:10px"><?php echo $this->lang->line('buttons')['delete'];?></a>
								<?php $this->load->view('template/exbtn');?>
							</div>
						</div>
	                    <div class="card-body ">
	                       
							<table id="receptionist" class="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
								<thead>
									<tr>
										<th style="width:10px"></th>
										<th><?php echo $this->lang->line('tableHeaders')['receptionist'];?></th>
										<th><?php echo $this->lang->line('tableHeaders')['hospital'];?></th>
										<th><?php echo $this->lang->line('tableHeaders')['branch'];?></th>
										<th><?php echo $this->lang->line('tableHeaders')['department'];?></th>
										<th><?php echo $this->lang->line('tableHeaders')['doctor'];?></th>
										<th><?php echo $this->lang->line('tableHeaders')['status'];?></th>
										<th width="20px">#</th>
									</tr>
								</thead>
								
								<tbody>
								</tbody>
							</table>  
	                    </div>
	                </div>
	            </div>
	        </div>
	        <input type="hidden" id="cur_del">
	    </div><!-- Main Wrapper -->

	    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<form action="<?php echo site_url(); ?>/receptionist/update" method="post" id="form" autocomplete="off">
				<input type="hidden" name="eidt_gf_id" id="eidt_gf_id">
				<div class="modal-content">
				  	<div class="modal-header">
					  	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					  	<h4 class="modal-title custom_align" id="Edit-Heading"></h4>
					</div>
				  	<div class="modal-body">
				  		<div class="row" id="tabs">
						  	<div role="tabpanel">
                                <ul class="nav  nav-pills" role="tablist">
                                    <li role="presentation" class="active"><a href="#tab1" aria-controls="gen" role="tab" data-toggle="tab"><?php echo $this->lang->line('labels')['basic'];?></a></li>
									<?php /*?><li role="presentation"><a href="#tab2" aria-controls="ha" role="tab" data-toggle="tab"><?php echo $this->lang->line('labels')['hospitalAssociation'];?></a></li><?php */?>
									<li role="presentation"><a href="#tab3" aria-controls="other" role="tab" data-toggle="tab"><?php echo $this->lang->line('labels')['otherProfile'];?></a></li>
									<li role="presentation"><a href="#tab4" aria-controls="prof" role="tab" data-toggle="tab"><?php echo $this->lang->line('labels')['professionInfo'];?></a></li>
								</ul>
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane active fade in" id="tab1">
										<div class="col-md-12">
											
												<div class="col-md-6 form-group">
													<label><?php echo $this->lang->line('labels')['fname'];?>*</label>
													<input class="form-control textinputfields" type="text" placeholder="<?php echo $this->lang->line('labels')['fname'];?>" name="first_name" id="first_name" />
												</div>
												<div class=" col-md-6 form-group">
													<label><?php echo $this->lang->line('labels')['mname'];?></label>
													<input class="form-control textinputfields" type="text" placeholder="<?php echo $this->lang->line('labels')['mname'];?>" name="middle_name" id="middle_name" />
												</div>
											
										</div>
										
										<div class="col-md-12">
											<div class="form-group col-md-6">
												<label><?php echo $this->lang->line('labels')['lname'];?>*</label>
												<input class="form-control textinputfields" type="text" placeholder="<?php echo $this->lang->line('labels')['lname'];?>" name="last_name" id="last_name" />
											</div>
											<div class="form-group col-md-6">
												<label><?php echo $this->lang->line('labels')['aboutMe'];?>*</label>
												<textarea class="form-control" rows="5"  placeholder="<?php echo $this->lang->line('labels')['aboutMePlaceholder'];?>" name="description" id="description" style="width: 77%"></textarea>
												
											</div>
										</div>
										
										<div class="col-md-12">
											<div class="form-group col-md-6">
												<label><?php echo $this->lang->line('labels')['email'];?>*</label>
												<input class="form-control email_check textinputmobilefields" type="text" placeholder="<?php echo $this->lang->line('labels')['email'];?>" name="useremail" id="useremail" />
											</div>
											<div class="form-group col-md-6">
												<label><?php echo $this->lang->line('labels')['mobile'];?>*</label>
												<input class="form-control mobile_number textinputmobilefields allowonlynumber" type="text" placeholder="<?php echo $this->lang->line('labels')['mobile'];?>" name="mobile" id="mobile" maxlength="10" />
											</div>
											<div class="form-group col-md-6 hide">
												<label><?php echo $this->lang->line('labels')['password'];?>*</label>
												<input class="form-control textinputfields" type="password" placeholder="<?php echo $this->lang->line('labels')['password'];?>" name="password" id="password" />
												<span id="passwordhint" style="display: none"><?php echo $this->lang->line('labels')['passwordHind'];?></span>
											</div>
										</div>
										
										<div class="panel panel-default hideinedit" style="color:#1d3bde">
  											<div class="panel-body"><?php echo $this->lang->line('labels')['hospitalAssociation'];?></div>
										</div>
										<div class="col-md-12">
										    <div class="form-group col-md-6 hide">
												<label><?php echo $this->lang->line('labels')['selectHospital'];?>*</label>
												<select name="hospital_id"  id="hospital_id" class=" form-control textinputfields" style="width: 77%">
												<option value="">Please Select</option>
                                                </select>
											</div>
											<div class="form-group col-md-6 hide " >
												<label><?php echo $this->lang->line('labels')['selectBranch'];?>*</label>
												<div id="branches-list">
												<select name="branch_idss" id="branch_id" class="form-control allowalphanumeric" style="width: 77%">
												<option value="">Please Select</option>
                                                </select>
												
												</div>
											</div>
											<div class="form-group col-md-6 hideinedit " >
												<label><?php echo $this->lang->line('labels')['selectBranch'];?>*</label>
												<select name="branch_id" class="branch_id form-control allowalphanumeric" style="width: 77%" >
												<option value="">Please Select</option>
												<?php 
												foreach($Branches as $br){
												?>
												<option value="<?php echo $br->id; ?>"><?php echo $br->text; ?></option>
												<?php } ?>
												</select>
											</div>
											
											<div class="form-group col-md-6 hide ">
												<label><?php echo $this->lang->line('labels')['selectDepartment'];?>*</label>
												<select name="department_idssss" id="department_id" class="  form-control allowalphanumeric" style="width: 77%">
												<option value="all">Frontdesk / All Departments</option>
                                                </select>
												
											</div>
											
											<div class="form-group col-md-6 hideinedit ">
												<label><?php echo $this->lang->line('labels')['selectDepartment'];?>*</label>
												<div class="ddepartment-list">
												<select name="department_id"  class="DepartmentID form-control allowalphanumeric department_id" style="width: 77%">
												<option value="">Please Select</option>
                                                </select>
												</div>
											</div>
											
										</div>
										<div class="form-group col-md-6 hide">
                                               <label><?php echo $this->lang->line('labels')['selectDoctor'];?></label>
                                                <select name="doc_idsss" id="doc_id" class=" form-control" style="width: 100%">
												<option value="">Please Select</option>
                                                </select>
												
                                            </div>
										<div class="col-md-12 hideinedit">
											<label><?php echo $this->lang->line('labels')['selectDoctor'];?></label>
											<div class="doctors-list">
											
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group col-md-6">
												<label><?php echo $this->lang->line('labels')['status'];?></label>
												<select class="form-control allowalphanumeric" name="isActive" id="isActive">
													<option value="1"><?php echo $this->lang->line('labels')['active'];?></option>
													<option value="0"><?php echo $this->lang->line('labels')['inactive'];?></option>
												</select>
											</div>
										</div>
										
									</div>
									<?php /*?><div role="tabpanel" class="tab-pane fade in" id="tab2">
										<div class="col-md-12">
											<div class="form-group col-md-4">
                                                <label><?php echo $this->lang->line('labels')['selectHospital'];?></label>
                                                <select name="hospital_id"  id="hospital_id" class=" form-control" style="width: 100%">
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label><?php echo $this->lang->line('labels')['selectBranch'];?></label>
                                                <select name="branch_id" id="branch_id" class=" form-control" style="width: 100%">
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                               <label><?php echo $this->lang->line('labels')['selectDepartment'];?></label>
                                                <select name="department_id" id="department_id" class=" form-control" style="width: 100%">
                                                </select>
                                            </div>
											<div class="form-group col-md-4">
                                               <label><?php echo $this->lang->line('labels')['selectDoctor'];?></label>
                                                <select name="doc_id" id="doc_id" class=" form-control" style="width: 100%">
                                                </select>
                                            </div>
										</div>
									</div><?php */?>
									
									<div role="tabpanel" class="tab-pane fade in" id="tab3">
										<div class="col-md-12">
											<div class="form-group col-md-6">
												<label><?php echo $this->lang->line('labels')['gender'];?></label>
												<select class="form-control wid75 textinputfields " name="gender" id="gender" />
													<option value="M"><?php echo $this->lang->line('labels')['male'];?></option>
													<option value="F"><?php echo $this->lang->line('labels')['female'];?></option>
													<option value="O"><?php echo $this->lang->line('labels')['othergender'];?></option>
												</select>
											</div>
											<div class="form-group col-md-6">
												<label><?php echo $this->lang->line('labels')['dob'];?></label>
												<input class="form-control textinputfields date-picker" type="text" placeholder="<?php echo $this->lang->line('labels')['dob'];?>" name="date_of_birth" id="date_of_birth" />
											</div>
										</div>
										<div class="col-md-12">
										    
											<div class="form-group col-md-6">
												<label><?php echo $this->lang->line('labels')['aadharNumber'];?></label>
												<input class="form-control aadhaar_number textinputfields" type="text" placeholder="<?php echo $this->lang->line('labels')['aadharNumber'];?>" name="aadhaar_number" id="aadhaar_number" />
											</div>
											
											<div class="form-group col-md-6">
												<label><?php echo $this->lang->line('labels')['alternateNumber'];?></label>
												<input class="form-control textinputmobilefields allowonlynumber" type="text" placeholder="<?php echo $this->lang->line('labels')['alternateNumber'];?>" name="alternate_mobile_number" id="alternate_mobile_number" maxlength="10" />
											</div>
										</div>
										<div class="col-md-12">
											
											<div class="form-group col-md-6">
												<label><?php echo $this->lang->line('labels')['address'];?></label>
												<input class="form-control textinputfields" type="text" placeholder="<?php echo $this->lang->line('labels')['address'];?>" name="address" id="address" />
											</div>
											<div class="form-group col-md-6">
												<label><?php echo $this->lang->line('labels')['selectCountry'];?></label>
												<select name="country"  id="country" class=" form-control textinputfields wid75" >
												<option value="">Please Select</option>
												</select>
											</div>
											
										</div>
										<div class="col-md-12">
							  				
											<div class="form-group col-md-6">
												<label><?php echo $this->lang->line('labels')['selectState'];?></label>
												<select name="state"  id="state" class=" form-control textinputfields wid75" >
												<option value="">Please Select</option>
												</select>
											</div>
											<div class="form-group col-md-6">
												<label><?php echo $this->lang->line('labels')['selectDistrict'];?></label>
												<select name="district"  id="district" class=" form-control wid75" >
												<option value="">Please Select</option>
												</select>
											</div>
							  				
							  			</div>
										<div class="col-md-12">
										
											<div class="form-group col-md-6">
												<label><?php echo $this->lang->line('labels')['selectCity'];?></label>
												<select name="city"  id="city" class=" form-control wid75" >
												<option value="">Please Select</option>
												</select>
											</div>
											<div class="form-group col-md-6">
												<label><?php echo $this->lang->line('labels')['profilePic'];?></label>
	                                            
													<div class=" input-group image-preview">
										                <input type="text" class="form-control image-preview-filename" id="prephoto" disabled="disabled"> 
										                <span class="input-group-btn">
										                    <!-- image-preview-clear button -->
										                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
										                        <span class="glyphicon glyphicon-remove"></span> <?php echo $this->lang->line('labels')['clear'];?>
										                    </button>
										                    <!-- image-preview-input -->
										                    <div class="btn btn-default image-preview-input">
										                        <span class="glyphicon glyphicon-folder-open"></span>
										                        <span class="image-preview-input-title"><?php echo $this->lang->line('labels')['browse'];?></span>
										                        <input type="file" accept="image/png, image/jpeg" name="profile_photo" id="profile_photo" />
										                    </div>
										                </span>
										            
									            </div>
								            </div>
										</div>
									</div>
									<div role="tabpanel" class="tab-pane fade in" id="tab4">
										<div class="col-md-12">
											<div class="form-group col-md-6">
												<label><?php echo $this->lang->line('labels')['qualification'];?></label>
												<input class="form-control textinputfields" type="text" placeholder="<?php echo $this->lang->line('labels')['qualification'];?>" name="qualification" id="qualification" />
											</div>
											<div class="form-group col-md-6">
												<label><?php echo $this->lang->line('labels')['experience'];?></label>
												<input class="form-control textinputfields" type="text" placeholder="<?php echo $this->lang->line('labels')['experience'];?>" name="experience" id="experience" />
											</div>
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
		                        <button type="submit" class="btn btn-info btn-lg" id="action-update-btn" style="width: 100%;"><span style="margin: 5px" class="fa fa-check"></span><?php echo $this->lang->line('buttons')['update'];?></button>
		                    </div>
		                    
		                    <div class="form-group col-md-6" style="display:none">
		                        <button type="submit" class="btn btn-success btn-lg" id="action-add-btn" style="width: 100%;"><span style="margin: 5px" class="fa fa-plus"></span><?php echo $this->lang->line('buttons')['add'];?></button>
		                    </div>
		                </div>
					</div>
				</div>
				</form>
			<!-- /.modal-content --> 
			</div>
		<!-- /.modal-dialog --> 
		</div>
        
        <div class="modal fade GetDoctorsByRECPID" tabindex="-1" role="dialog" aria-labelledby="GetDoctorsByRECPID" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				
			<!-- /.modal-content --> 
			</div>
		<!-- /.modal-dialog --> 
		</div>
        <div id="viewdoctrs" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Doctors</h4>
      </div>
      <div class="modal-body">
        
      		 <div id="load"></div>
        
      </div>
      
    </div>

  </div>
</div>
	    <?php
$this->load->view("template/footer.php");
?><script type="text/javascript">
		
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
			        	
			        	first_name: {
			        		required : true
			        	},
			        	last_name: {
			        		required: true
			        	},
			        	useremail:{
			        		required:true,
			        		email:true
			        	},
			        	aadhaar_number:{
			        		//required:true,
			        		aadhaar: true
			        	},
			        	mobile:{
			        		required:true,
							phoneUS:true
			        	},
						branch_id:{
			        		required:true,
							
			        	},
						department_id:{
			        		required:true,
							
			        	}
			        },
			        messages: {
			        	
			        	first_name:{
			        		required: "<?php echo $this->lang->line('validation')['requiredFname'];?>"
			        	},
			        	last_name:{
			        		required: "<?php echo $this->lang->line('validation')['requiredLname'];?>"
			        	},
			        	useremail:{
			        		required: "<?php echo $this->lang->line('validation')['requiredEmail'];?>",
			        		email: "<?php echo $this->lang->line('validation')['invalidEmail'];?>"
			        	},
			        	aadhaar_number:{
			        		//required: "<?php echo $this->lang->line('validation')['requiredAadhar'];?>"
			        	},
			        	mobile:{
			        		required:"<?php echo $this->lang->line('validation')['requriedPhone'];?>",
							phoneUS: "<?php echo $this->lang->line('validation')['invalidPhone'];?>"
			        	},
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


				var dt = $("#receptionist").DataTable({
		            "processing": true,
		            "serverSide": true,
		            "ajax": "<?php echo site_url(); ?>/receptionist/getDTreceptionist",
					"columns": [
						{ name : '#',"searchable": false, "orderable": false },
						{ name : '<?php echo $this->lang->line('tableHeaders')['receptionist'];?>' },
						{ name : '<?php echo $this->lang->line('tableHeaders')['hospital'];?>' },
						{ name : '<?php echo $this->lang->line('tableHeaders')['branch'];?>' },
						{ name : '<?php echo $this->lang->line('tableHeaders')['department'];?>' },
						{ name : '<?php echo $this->lang->line('tableHeaders')['doctor'];?>' },
						{ name : '<?php echo $this->lang->line('tableHeaders')['status'];?>' },
						{ name : '#',"searchable": false, "orderable": false }	
					]
		        });
				<?php $this->load->view('template/exdt');?>

				$(".dataTables_filter").attr("style","display: flex;float: right");
				//$(".dataTables_filter").append("<a class=\"btn btn-success m-b-sm addbtn\" data-toggle=\"tooltip\" title=\"Add\"  href=\"javascript:void(0);\" data-title=\"Add\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Add New</a>");
				//$(".dataTables_filter").append("<a class=\"btn btn-danger m-b-sm multiDeleteBtn\" data-at=\"receptionist\" data-toggle=\"tooltip\" title=\"Delete\"  href=\"javascript:void(0);\" data-title=\"Delete\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Delete</a>");

			    $("[data-toggle=tooltip]").tooltip();

			    $(".addbtn").click(function(){
				    $('.hideinedit').show();
					resetForm(validator);
					resetLocation();
					clearSelection();
			    	$("#Edit-Heading").html("<?php echo $this->lang->line('headings')['addNewReceptionist'];?>");
			    	$("#action-update-btn").parent().hide();
			    	$("#action-add-btn").parent().show();
			    	$("#form")[0].reset();
			    	$("#passwordhint").hide();
			    	$("#form input").attr("disabled",false);
			    	$("#form").attr("action","<?php echo site_url(); ?>/receptionist/add");
			    	$("#edit").modal("show");
					/*$("#password").rules("add", {
						required:true,
						messages: {
								required: "<?php echo $this->lang->line('validation')['requiredPassword'];?>"
						}
					});*/
					$('#tabs a[href="#tab1"]').click();
			    });

				function clearSelection(){
					$selectize_doc_id[0].selectize.disable();
					$selectize_doc_id[0].selectize.clear();
					$selectize_department_id[0].selectize.disable();
					$selectize_department_id[0].selectize.clear();
					$selectize_branch_id[0].selectize.disable();
					$selectize_branch_id[0].selectize.clear();
					$selectize_hospital_id[0].selectize.clear();
				}

				$("#receptionist").on("click",".editbtn",function(){
					$('.hideinedit').hide();
					resetForm(validator);
					clearSelection();
					resetLocation();
					$("div.error").hide();
			    	var id = $(this).attr("data-id");
			    	$("#eidt_gf_id").val(id);
			    	loadData(id);
			    	$("#passwordhint").show();
			    	$("#form").attr("action","<?php echo site_url(); ?>/receptionist/update");
			    	$("#form input").attr("disabled",false);
			    	$("#Edit-Heading").html("<?php echo $this->lang->line('headings')['editData'];?>");
			    	$("#action-add-btn").parent().hide();
			    	$("#action-update-btn").parent().show();
					$("#password").rules("remove","required");
					$('#tabs a[href="#tab1"]').click();
			    });

			    function loadData(id){
			    	$.post("<?php echo site_url(); ?>/receptionist/getreceptionist",{ id: id },function(data){
			    		var data = JSON.parse(data);
			    		
						/*var tempselectize_doc_id = $selectize_doc_id[0].selectize;
						tempselectize_doc_id.addOption([{"id":data.doc_id,"text":data.doc_id}]);
						tempselectize_doc_id.refreshItems();
						tempselectize_doc_id.setValue(data.doc_id);*/

						var tempselectize_hospital_id = $selectize_hospital_id[0].selectize;
						tempselectize_hospital_id.addOption([{"id":data.hospital_id,"text":data.hospital_id}]);
						tempselectize_hospital_id.refreshItems();
						tempselectize_hospital_id.setValue(data.hospital_id);

						doctor_id = data.doc_id;
						department_id = data.department_id;
						branch_id = data.branch_id;

						$("#first_name").val(data.first_name);
						
						$("#middle_name").val(data.MiddleName);
						
						$("#last_name").val(data.last_name);
						
						$("#useremail").val(data.useremail);
						
						$("#isActive").val(data.curIsActive);
						$("#address").val(data.address);
						$("#aadhaar_number").val(data.aadhaar_number);
						$("#mobile").val(data.mobile);
						
						$("#phone").val(data.phone);

						$("#gender").val(data.gender);

						$("#qualification").val(data.qualification);
						$("#experience").val(data.experience);
						
						$("#address").val(data.address);
						$("#description").val(data.description);
						$("#alternate_mobile_number").val(data.alternate_mobile_number);
						if(data.date_of_birth != "" && data.date_of_birth != "0000-00-00"){
							$("#date_of_birth").datepicker("update", new Date(data.date_of_birth));
						}
						if(data.country != null && data.country!=undefined && data.country != "" && data.country > 0){
							console.log(data.country);
							loc_cid = data.city;
							loc_did = data.district;
							loc_sid = data.state;
							var tempselectize_selectize_country = $selectize_country[0].selectize;
							tempselectize_selectize_country.addOption([{"id":data.country,"text":data.country}]);
							tempselectize_selectize_country.refreshItems();
							tempselectize_selectize_country.setValue(data.country);
						}
						shwoImgFromUrl(data.profile_photo);

			    		
			    	});
			    }

			    $("#receptionist").on("click",".viewbtn",function(){
					resetForm(validator);
					clearSelection();
					resetLocation();
					$("div.error").hide();
			    	loadData($(this).attr("data-id"));
			    	$("#form input").attr("disabled",true);
			    	$("#form").attr("action","");
					$("#action-add-btn").parent().hide();
					$("#action-update-btn").parent().hide();
			    	$("#Edit-Heading").html("<?php echo $this->lang->line('headings')['detailedView'];?>");
					$('#tabs a[href="#tab1"]').click();

			    });


			    $("#receptionist").on("click",".delbtn",function(){
			    	var id = $(this).attr("data-id");
					swal(swalDeleteConfig).then(function () {
						$.post("<?php echo site_url(); ?>/receptionist/delete",{id:id},function(data){
							delResFunc(data,id);
						});
					});
			    });
			    
			    var xhr;
				

				var $selectize_doc_id = $("#doc_id").selectize({
				    valueField: "id",
				    labelField: "text",
				    searchField: "text",
				    preload:true,
				    create: false,
				    render: {
				        option: function(item, escape) {
				        	return "<div><span class='title'>" +
				                    escape(item.text)+
				                "</span>" +   
				            "</div>";
				        }
				    }
				});

				var $selectize_branch_id = $("#branch_id").selectize({
				    valueField: "id",
				    labelField: "text",
				    searchField: "text",
				    render: {
				        option: function(item, escape) {
				        	return "<div><span class='title'>" +
				                    escape(item.text)+
				                "</span>" +   
				            "</div>";
				        }
				    },
				    onChange: function(value) {
				        if (!value.length) return;

				        $selectize_department_id[0].selectize.disable();
				        $selectize_department_id[0].selectize.clearOptions();
				        $selectize_department_id[0].selectize.load(function(callback) {
				            xhr && xhr.abort();
				            xhr = $.ajax({
				                url: "<?php echo site_url(); ?>/departments/search/",
				                type: "GET",
				                data: { "branch_id":value,"f":"department_name"},
				                success: function(results) {
				                    $selectize_department_id[0].selectize.enable();
				                    callback($.parseJSON(results));
				                    if(department_id != null  && department_id > 0){
				    					var tempselectize_department_id = $selectize_department_id[0].selectize;
										tempselectize_department_id.addOption([{"id":department_id,"text":department_id}]);
										tempselectize_department_id.refreshItems();
										tempselectize_department_id.setValue(department_id);	
										department_id = null;
				    				}
				                },
				                error: function() {
				                    callback();
				                }
				            })
				        });
				    }
				});

				var $selectize_department_id = $("#department_id").selectize({
				    valueField: "id",
				    labelField: "text",
				    searchField: "text",
				    render: {
				        option: function(item, escape) {
				        	return "<div><span class='title'>" +
				                    escape(item.text)+
				                "</span>" +   
				            "</div>";
				        }
				    },
				    onChange: function(value) {
				        if (!value.length) return;

				        $selectize_doc_id[0].selectize.disable();
				        $selectize_doc_id[0].selectize.clearOptions();
				        $selectize_doc_id[0].selectize.load(function(callback) {
				            xhr && xhr.abort();
				            xhr = $.ajax({
				                url: "<?php echo site_url(); ?>/doctors/search/",
				                type: "GET",
				                data: { "department_id":value,"f":"department_name"},
				                success: function(results) {
				                    $selectize_doc_id[0].selectize.enable();
				                    callback($.parseJSON(results));
				                    if(doctor_id != null  && doctor_id > 0){
				    					var tempselectize_doctor_id = $selectize_doc_id[0].selectize;
										tempselectize_doctor_id.addOption([{"id":doctor_id,"text":doctor_id}]);
										tempselectize_doctor_id.refreshItems();
										tempselectize_doctor_id.setValue(doctor_id);	
										doctor_id = null;
				    				}
				                },
				                error: function() {
				                    callback();
				                }
				            })
				        });
				    }
				});

				$selectize_branch_id[0].selectize.disable();
				$selectize_department_id[0].selectize.disable();
				$selectize_doc_id[0].selectize.disable();

				var $selectize_hospital_id = $("#hospital_id").selectize({
				    valueField: "id",
				    labelField: "text",
				    searchField: "text",
				    preload:true,
				    create: false,
				    render: {
				        option: function(item, escape) {
				        	return "<div><span class='title'>" +
				                    escape(item.text)+
				                "</span>" +   
				            "</div>";
				        }
				    },
				    load: function(query, callback) {
				        //if (!query.length) return callback();
				        $.ajax({
				            url: "<?php echo site_url(); ?>/hospitals/search",
				            type: "GET",
				            data: {"q":query,"f":"name"},
				            error: function() {
				                callback();
				            },
				            success: function(res) {
				                callback($.parseJSON(res));
				            }
				        });
				    },
				    onChange: function(value) {
				        if (!value.length) return;

				        $selectize_branch_id[0].selectize.disable();
				        $selectize_branch_id[0].selectize.clearOptions();
				        $selectize_branch_id[0].selectize.load(function(callback) {
				            xhr && xhr.abort();
				            xhr = $.ajax({
				                url: "<?php echo site_url(); ?>/branches/search/",
				                type: "GET",
				                data: { "hospital_id":value,"f":"branch_name"},
				                success: function(results) {
				                    $selectize_branch_id[0].selectize.enable();
				                    callback($.parseJSON(results));
				                    if(branch_id != null &&  branch_id > 0){
				    					var tempselectize_branch_id = $selectize_branch_id[0].selectize;
										tempselectize_branch_id.addOption([{"id":branch_id,"text":branch_id}]);
										tempselectize_branch_id.refreshItems();
										tempselectize_branch_id.setValue(branch_id);	
										branch_id = null;
				    				}
				                },
				                error: function() {
				                    callback();
				                }
				            })
				        });
				    }
				});
				
/*$('.getbranches').on('click',function(){
	 $HospitalID = '<?php echo $this->session->userdata('hospital_id'); ?>';
	 $.ajax({
				url: "<?php echo site_url(); ?>/index/searchBranches/",
				type: "GET",
				data: { "hospital_id":$HospitalID,"f":"branch_name"},
				success: function(results) {
				$("#branches-list").show();
				$("#branches-list").html(results);
					
				},
				error: function() {
					callback();
				}
			})
  });*/
$('.branch_id').on('change',function(){
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
   $branchid = $(".branch_id").val();
   //$(".department_id").attr("disabled",false);
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
/*$('#receptionist').on('click', '.GetDoctorsByRECPID', function(){
	
	resetForm(validator);
					clearSelection();
					resetLocation();
					$("div.error").hide();
			    	var id = $(this).attr("data-id");
			    	$("#eidt_gf_id").val(id);
					$.ajax({
						url: "<?php echo site_url(); ?>/index/getRecDoctors",
				        type: "GET",
				        data: { "recpid":id},
				        success: function(results) {
						//alert(results['user_id']);
							},
						});
	
	});*/ 
	
$('#receptionist').on('click', '.GetDoctorsByRECPID', function(e){
		
	 var $ID =$(this).attr('data-id');
	 
	 var $action =$(this).attr('data-action');
	 e.preventDefault();
	 
		$.ajax({
				type: "GET",
				url: $action,
				data: {ID: $ID},
				success:function(result){
					if(result != 0){
						
						$("#load").html(result);
						$("#load").prop('disabled', false);	
						
					} else {
						
						$("#load").html(result);
						$("#load").prop('disabled', false);
						
					}
				}
			});
	});		

});

		</script>