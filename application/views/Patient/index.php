<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
$this->load->view("template/header.php");
$this->load->view("template/left.php");
?>
			<input type="hidden" id="left_active_menu" value="7" />
		<div id="main-wrapper">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="panel panel-white">
	                    <div class="panel-heading clearfix">
							<div class="">
								<div class="custome_col8">
									<h4 class="panel-title panel_heading_custome"><?php echo $this->lang->line('patients');?></h4>
								</div>
								<div class="custome_col4">
									<div class="panel_button_top_right">
										<a class="btn btn-success m-b-sm addbtn" data-toggle="tooltip" href="javascript:void(0);" data-toggle="modal" data-target="#edit" style=""><?php echo $this->lang->line('buttons')['addNew'];?></a>
										<a class="btn btn-danger m-b-sm multiDeleteBtn" data-at="patient" href="javascript:void(0);"  style="margin-left:10px"><?php echo $this->lang->line('buttons')['delete'];?></a>
										<a class="btn btn-primary m-b-sm exportBtn" data-at="patient" href="javascript:void(0);" data-toggle="modal" data-target="#export" style="margin-left:10px"><?php echo $this->lang->line('buttons')['export'];?></a>
									</div>
								</div>
								<br>
							</div>
	                    </div>
	                    <div class="panel-body panel_body_custome">
	                       <div class="table-responsive">
	                            <table id="users" class="display table" cellspacing="0" width="100%">
	                                <thead>
	                                    <tr>
											<th style="width:10px"></th>
											<th><?php echo $this->lang->line('tableHeaders')['name'];?></th>
											<th><?php echo $this->lang->line('tableHeaders')['email'];?></th>
											<th><?php echo $this->lang->line('tableHeaders')['status'];?></th>
											<th style="width: 20px">#</th>
	                                    </tr>
	                                </thead>
	                                <tbody>
	                                </tbody>
	                            </table>  
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <input type="hidden" id="cur_del">
	    </div><!-- Main Wrapper -->

	    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<form action="<?php echo site_url(); ?>/patients/update" method="post" id="form" enctype="multipart/form-data">
					<input type="hidden" name="eidt_gf_id" id="eidt_gf_id">
					<input type="hidden" name="role" value="<?php echo $this->auth->getPatientRoleType(); ?>">
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
										<li role="presentation"><a href="#tab2" aria-controls="other" role="tab" data-toggle="tab"><?php echo $this->lang->line('labels')['otherProfile'];?></a></li>
										<li role="presentation"><a href="#tab3" aria-controls="patient" role="tab" data-toggle="tab"><?php echo $this->lang->line('labels')['healthInfo'];?></a></li>
									</ul>
									<div class="tab-content">
										<div role="tabpanel" class="tab-pane active fade in" id="tab1">
											<div class="col-md-12">
												<div class="col-md-6">
													<div class="form-group">
														<label><?php echo $this->lang->line('labels')['fname'];?></label>
														<input class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['fname'];?>" name="first_name" id="first_name" />
													</div>
													<div class="form-group">
														<label><?php echo $this->lang->line('labels')['lname'];?></label>
														<input class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['lname'];?>" name="last_name" id="last_name" />
													</div>
												</div>
												<div class="form-group col-md-6">
													<label><?php echo $this->lang->line('labels')['aboutMe'];?></label>
													<textarea class="form-control" rows="5"  placeholder="<?php echo $this->lang->line('labels')['aboutMePlaceholder'];?>" name="description" id="description"></textarea>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group col-md-6">
													<label><?php echo $this->lang->line('labels')['email'];?></label>
													<input class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['email'];?>" name="useremail" id="useremail" />
												</div>
												<div class="form-group col-md-6">
													<label><?php echo $this->lang->line('labels')['password'];?></label>
													<input class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['password'];?>" name="password" id="password" />
													<span id="passwordhint" style="display: none"><?php echo $this->lang->line('labels')['passwordHind'];?></span>
												</div>
											</div>
											<div class="col-md-12">
												
												<div class="form-group col-md-6">
													<label><?php echo $this->lang->line('labels')['aadharNumber'];?></label>
													<input class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['aadharNumber'];?>" name="aadhaar_number" id="aadhaar_number" />
												</div>
												<div class="form-group col-md-6">
													<label><?php echo $this->lang->line('labels')['mobile'];?></label>
													<input class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['mobile'];?>" name="mobile" id="mobile" />
												</div>
												
											</div>
											
										</div>
										<div role="tabpanel" class="tab-pane fade in" id="tab2">
											<div class="col-md-12">
												<div class="form-group col-md-6">
													<label><?php echo $this->lang->line('labels')['gender'];?></label>
													<select class="form-control " name="gender" id="gender" />
														<option value="M"><?php echo $this->lang->line('labels')['male'];?></option>
														<option value="F"><?php echo $this->lang->line('labels')['female'];?></option>
													</select>
												</div>
												<div class="form-group col-md-6">
													<label><?php echo $this->lang->line('labels')['dob'];?></label>
													<input class="form-control date-picker" type="text" placeholder="<?php echo $this->lang->line('labels')['dob'];?>" name="date_of_birth" id="date_of_birth" />
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group col-md-6">
													<label><?php echo $this->lang->line('labels')['address'];?></label>
													<input class="form-control" type="text" placeholder="<?php echo $this->lang->line('labels')['address'];?>" name="address" id="address" />
												</div>
												
												<div class="form-group col-md-6">
													<label><?php echo $this->lang->line('labels')['alternateNumber'];?></label>
													<input class="form-control" type="text" placeholder="<?php echo $this->lang->line('labels')['alternateNumber'];?>" name="alternate_mobile_numberstate" id="alternate_mobile_number" />
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group col-md-3">
													<label><?php echo $this->lang->line('labels')['selectCountry'];?></label>
													<select name="country"  id="country" class=" form-control" style="width: 100%"></select>
												</div>
												<div class="form-group col-md-3">
													<label><?php echo $this->lang->line('labels')['selectState'];?></label>
													<select name="state"  id="state" class=" form-control" style="width: 100%"></select>
												</div>
												<div class="form-group col-md-3">
													<label><?php echo $this->lang->line('labels')['selectDistrict'];?></label>
													<select name="district"  id="district" class=" form-control" style="width: 100%"></select>
												</div>
												<div class="form-group col-md-3">
													<label><?php echo $this->lang->line('labels')['selectCity'];?></label>
													<select name="city"  id="city" class=" form-control" style="width: 100%"></select>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group  col-md-6">
													<label for="input-Default" class="col-sm-4 control-label"><?php echo $this->lang->line('labels')['profilePic'];?></label>
													<div class="col-sm-8">
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
										</div>
										<div role="tabpanel" class="tab-pane fade in" id="tab3">
											<div class="col-md-12">
												<div class="form-group col-md-6">
													<label><?php echo $this->lang->line('labels')['bloodPressure'];?></label>
													<select class="form-control" name1="boold_group" id="boold_group">
														<option value="OPVE">O +</option>
														<option value="ONVE">O -</option>
														<option value="APVE">A +</option>
														<option value="ANVE">A -</option>
														<option value="BPVE">B +</option>
														<option value="BNVE">B -</option>
														<option value="ABPVE">AB +</option>
														<option value="ABNVE">AB -</option>
													</select>
												</div>
												<div class="form-group col-md-6">
													<label><?php echo $this->lang->line('labels')['height'];?></label>
													<input class="form-control" type="text" placeholder="<?php echo $this->lang->line('labels')['height'];?>" name1="height" id="height" />
												</div>
												<div class="form-group col-md-6">
													<label><?php echo $this->lang->line('labels')['weight'];?></label>
													<input class="form-control" type="text" placeholder="<?php echo $this->lang->line('labels')['weight'];?>" name1="weight" id="weight" />
												</div>
												<div class="form-group col-md-6">
													<label><?php echo $this->lang->line('labels')['bloodPressure'];?></label>
													<input class="form-control" type="text" placeholder="<?php echo $this->lang->line('labels')['bloodPressure'];?>" name1="blood_pressure" id="blood_pressure" />
												</div>
												<div class="form-group col-md-6">
													<label><?php echo $this->lang->line('labels')['sugarLevel'];?></label>
													<input class="form-control" type="text" placeholder="<?php echo $this->lang->line('labels')['sugarLevel'];?>" name1="sugar_level" id="sugar_level" />
												</div>
												<div class="form-group col-md-6">
													<label><?php echo $this->lang->line('labels')['healthInsuranceProvider'];?></label>
													<input class="form-control" type="text" placeholder="<?php echo $this->lang->line('labels')['healthInsuranceProvider'];?>" name1="health_insurance_provider" id="health_insurance_provider" />
												</div>
												<div class="form-group col-md-6">
													<label><?php echo $this->lang->line('labels')['healthInsuranceId'];?></label>
													<input class="form-control" type="text" placeholder="<?php echo $this->lang->line('labels')['healthInsuranceId'];?>" name1="health_insurance_id" id="health_insurance_id" />
												</div>
												<div class="form-group col-md-6">
													<label><?php echo $this->lang->line('labels')['familyHistory'];?></label>
													<textarea class="form-control" placeholder="<?php echo $this->lang->line('labels')['familyHistoryPlaceholder'];?>" id="family_history" name1="family_history" ></textarea>
												</div>
												<div class="form-group col-md-12">
													<label><?php echo $this->lang->line('labels')['pastMedicalHistory'];?></label>
													<textarea class="form-control" placeholder="<?php echo $this->lang->line('labels')['pastMedicalHistoryPlaceholder'];?>" id="past_medical_history" name1="past_medical_history" ></textarea>
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

	    <?php
$this->load->view("template/footer.php");
?><script type="text/javascript">
		
			$(document).ready(function(){

				<?php
					$this->load->view("template/location");
				?>

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
			        		required:true
			        	},
			        	mobile:{
			        		required:true,
							phoneUS:true
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
			        		required: "<?php echo $this->lang->line('validation')['requiredAadhar'];?>"
			        	},
			        	mobile:{
			        		required:"<?php echo $this->lang->line('validation')['requriedPhone'];?>",
							phoneUS: "<?php echo $this->lang->line('validation')['invalidPhone'];?>"
			        	}
			        },
					invalidHandler: validationInvalidHandler,
					errorPlacement: validationErrorPlacement
					
				});

				$("#users").DataTable({
		            "processing": true,
		            "serverSide": true,
		            "ajax": "<?php echo site_url(); ?>/patients/getDTusers"
		        });

				$(".dataTables_filter").attr("style","display: flex;float: right");
				//$(".dataTables_filter").append("<a class=\"btn btn-success m-b-sm addbtn\" data-toggle=\"tooltip\" title=\"Add\"  href=\"javascript:void(0);\" data-title=\"Add\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Add New</a>");
				//$(".dataTables_filter").append("<a class=\"btn btn-danger m-b-sm multiDeleteBtn\" data-at=\"patient\" data-toggle=\"tooltip\" title=\"Delete\"  href=\"javascript:void(0);\" data-title=\"Delete\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Delete</a>");

			    $("[data-toggle=tooltip]").tooltip();

			    $(".addbtn").click(function(){
					resetForm(validator);
					resetLocation();
			    	$("#Edit-Heading").html("<?php echo $this->lang->line('headings')['addNewPatient'];?>");
			    	$("#action-update-btn").parent().hide();
			    	$("#action-add-btn").parent().show();
			    	$("#form")[0].reset();
			    	$("#passwordhint").hide();
			    	$("#form input").attr("disabled",false);
			    	$("#form").attr("action","<?php echo site_url(); ?>/patients/add");
			    	$("#edit").modal("show");
					$("#password").rules("add", {
						required:true,
						messages: {
								required: "<?php echo $this->lang->line('validation')['requiredPassword'];?>"
						}
					});
					$('#tabs a[href="#tab1"]').click();
			    });

				$("#users").on("click",".editbtn",function(){
					resetForm(validator);
					resetLocation();
			    	var id = $(this).attr("data-id");
			    	$("#eidt_gf_id").val(id);
			    	loadData(id);
			    	$("#passwordhint").show();
			    	$("#form").attr("action","<?php echo site_url(); ?>/patients/update");
			    	$("#form input").attr("disabled",false);
			    	$("#Edit-Heading").html("<?php echo $this->lang->line('headings')['editData'];?>");
			    	$("#action-add-btn").parent().hide();
			    	$("#action-update-btn").parent().show();
					$("#password").rules("remove","required");
					$('#tabs a[href="#tab1"]').click();
			    });

				function clearSelection(){
					
				}

			    function loadData(id){
			    	$.post("<?php echo site_url(); ?>/users/getusers",{ id: id },function(data){
			    		var data = JSON.parse(data);
			    		
						$("#first_name").val(data.first_name);
						
						$("#last_name").val(data.last_name);
						
						$("#useremail").val(data.useremail);
						$("#address").val(data.address);
						$("#aadhaar_number").val(data.aadhaar_number);
						$("#mobile").val(data.mobile);
						
						$("#phone").val(data.phone);
						
						$("#profile_photo").val(data.profile_photo);
						
						$("#role").val(data.role);
						
						$("#gender").val(data.gender);
						$("#city").val(data.city);
						$("#state").val(data.state);
						$("#country").val(data.country);
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

			    $("#users").on("click",".viewbtn",function(){
					resetForm(validator);
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


			    $("#users").on("click",".delbtn",function(){
			    	var id = $(this).attr("data-id");
					swal(swalDeleteConfig).then(function () {
						$.post("<?php echo site_url(); ?>/users/delete",{id:id},function(data){
							delResFunc(data,id);
						});
					});
			    });
			    

			});

		</script>