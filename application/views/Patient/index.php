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
	                        <h4 class="panel-title">Patients</h4>
	                    </div>
	                    <div class="panel-body">
	                       <div class="table-responsive">
	                            <table id="users" class="display table" cellspacing="0" width="100%">
	                                <thead>
	                                    <tr><th>First Name</th><th>Last Name</th><th>Usernemail</th><th>Status</th><th style="width: 20px">#</th>
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
				<form action="<?php echo site_url(); ?>/users/update" method="post" id="form" enctype="multipart/form-data">
					<input type="hidden" name="eidt_gf_id" id="eidt_gf_id">
					<input type="hidden" name="role" value="<?php echo $this->auth->getPatientRoleType(); ?>">
					<div class="modal-content">
				  		<div class="modal-header">
						  	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					  		<h4 class="modal-title custom_align" id="Edit-Heading">Edit User Detail</h4>
						</div>
				  		<div class="modal-body">
				  			
							<div class="row">
								<div role="tabpanel">
									<ul class="nav  nav-pills" role="tablist">
										<li role="presentation" class="active"><a href="#tab1" aria-controls="gen" role="tab" data-toggle="tab">Basic</a></li>
										<li role="presentation"><a href="#tab2" aria-controls="other" role="tab" data-toggle="tab">Other Profile Info.</a></li>
									</ul>
									<div class="tab-content">
										<div role="tabpanel" class="tab-pane active fade in" id="tab1">
											<div class="col-md-12">
												<div class="form-group col-md-6">
													<label>First Name</label>
													<input class="form-control " type="text" placeholder="First Name" name="first_name" id="first_name" />
												</div>
												<div class="form-group col-md-6">
													<label>Last Name</label>
													<input class="form-control " type="text" placeholder="Last Name" name="last_name" id="last_name" />
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group col-md-6">
													<label>Email</label>
													<input class="form-control " type="text" placeholder="Email Address" name="useremail" id="useremail" />
												</div>
												<div class="form-group col-md-6">
													<label>Password</label>
													<input class="form-control " type="text" placeholder="Password" name="password" id="password" />
													<span id="passwordhint" style="display: none">Leave it empty if you don't want to update the password.</span>
												</div>
											</div>
											<div class="col-md-12">

												<div class="form-group col-md-6">
													<label>Aadhar Number</label>
													<input class="form-control " type="text" placeholder="Aadhar Number" name="aadhaar_number" id="aadhaar_number" />
												</div>
												<div class="form-group col-md-6">
													<label>Mobile</label>
													<input class="form-control " type="text" placeholder="Mobile" name="mobile" id="mobile" />
												</div>
												<div class="form-group col-md-6">
													<label>About Me</label>
													<textarea class="form-control"  placeholder="Write Few Words about your self." name="description" id="description"></textarea>
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane fade in" id="tab2">
											<div class="col-md-12">
												<div class="form-group col-md-6">
													<label>Gender</label>
													<select class="form-control " name="gender" id="gender" />
														<option value="M">Male</option>
														<option value="F">Female</option>
													</select>
												</div>
												<div class="form-group col-md-6">
													<label>Date of Birth</label>
													<input class="form-control date-picker" type="text" placeholder="Date of birth" name="date_of_birth" id="date_of_birth" />
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group col-md-6">
													<label>Address</label>
													<input class="form-control" type="text" placeholder="Address" name="address" id="address" />
												</div>
												<div class="form-group col-md-6">
													<label>City</label>
													<input class="form-control" type="text" placeholder="City" name="city" id="city" />
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group col-md-6">
													<label>State</label>
													<input class="form-control" type="text" placeholder="State" name="state" id="state" />
												</div>
												<div class="form-group col-md-6">
													<label>Country</label>
													<input class="form-control" type="text" placeholder="Country" name="country" id="country" />
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group col-md-6">
													<label>Alternate Mobile Number</label>
													<input class="form-control" type="text" placeholder="Alternate Mobile Number" name="alternate_mobile_numberstate" id="alternate_mobile_number" />
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group  col-md-6">
													<label for="input-Default" class="col-sm-4 control-label">Profile Picture</label>
													<div class="col-sm-8">
														<div class=" input-group image-preview">
															<input type="text" class="form-control image-preview-filename" id="prephoto" disabled="disabled"> 
															<span class="input-group-btn">
																<!-- image-preview-clear button -->
																<button type="button" class="btn btn-default image-preview-clear" style="display:none;">
																	<span class="glyphicon glyphicon-remove"></span> Clear
																</button>
																<!-- image-preview-input -->
																<div class="btn btn-default image-preview-input">
																	<span class="glyphicon glyphicon-folder-open"></span>
																	<span class="image-preview-input-title">Browse</span>
																	<input type="file" accept="image/png, image/jpeg" name="profile_photo" id="profile_photo" />
																</div>
															</span>
														</div>
													</div>
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
			                        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal" style="width: 100%;"><span class="fa fa-remove" style="margin: 5px"></span>CANCEL</button>
			                    </div>

			                    <div class="form-group col-md-6">
			                        <button type="submit" class="btn btn-info btn-lg" id="action-update-btn" style="width: 100%;"><span style="margin: 5px" class="fa fa-check"></span>UPDATE</button>
			                    </div>
			                    
			                    <div class="form-group col-md-6" style="display:none">
			                        <button type="submit" class="btn btn-success btn-lg" id="action-add-btn" style="width: 100%;"><span style="margin: 5px" class="fa fa-plus"></span>ADD</button>
			                    </div>
			                </div>
						</div>
					</div>
				</form>
			<!-- /.modal-content --> 
			</div>
		<!-- /.modal-dialog --> 
		</div>

		<div class="modal fade bs-example-modal-sm" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
	      	<div class="modal-dialog modal-sm">
	    		<div class="modal-content">
	          		<div class="modal-header">
	        			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
	        			<h4 class="modal-title custom_align" id="Heading">Delete Item</h4>
	      			</div>
	          		<div class="modal-body">
	       				<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure? You want to delete this User?</div>

	      			</div>
	        		<div class="modal-footer ">
	        			<button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
	                    <button type="button" id="del_yes" class="btn btn-danger">YES</button>
	      			</div>
	        	</div>
	    	<!-- /.modal-content --> 
	  		</div>
		</div>
	    <!-- /.modal-dialog -->
	    <?php
$this->load->view("template/footer.php");
?><script type="text/javascript">
		
			$(document).ready(function(){

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
			        		required:true
			        	}
			        },
			        messages: {
			        	
			        	first_name:{
			        		required: "Enter first name"
			        	},
			        	last_name:{
			        		required: "Enter last name"
			        	},
			        	useremail:{
			        		required: "Enter email address",
			        		email: "Enter valid email address"
			        	},
			        	aadhaar_number:{
			        		required: "Enter Aadhaar number"
			        	},
			        	mobile:{
			        		required:"Enter mobile number"
			        	}
			        },
					invalidHandler: function(event, validator) {
						// 'this' refers to the form
						var errors = validator.numberOfInvalids();
						if (errors) {
							var message = errors == 1 ? 'You missed 1 field. It has been highlighted' : 'You missed ' + errors + ' fields. They have been highlighted';
							$("div.error span").html(message);
							$("div.error").show();
						} else {
							$("div.error").hide();
						}
					},
					errorPlacement: function(error, element) {
						if (element.hasClass("selectized")) {
							var e = element.siblings(2)
							error.insertAfter(e[1]);
						} else {
							error.insertAfter(element);
						}
					}
					
				});

				$("#users").DataTable({
		            "processing": true,
		            "serverSide": true,
		            "ajax": "<?php echo site_url(); ?>/patients/getDTusers"
		        });

				$(".dataTables_filter").attr("style","display: flex;float: right");
				$(".dataTables_filter").append("<a class=\"btn btn-success m-b-sm addbtn\" data-toggle=\"tooltip\" title=\"Add\"  href=\"javascript:void(0);\" data-title=\"Add\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Add New</a>");
				
			    $("[data-toggle=tooltip]").tooltip();

			    $(".addbtn").click(function(){
					validator.resetForm();
					$("div.error").hide();
			    	$("#Edit-Heading").html("Add New Patient");
			    	$("#action-update-btn").parent().hide();
			    	$("#action-add-btn").parent().show();
			    	$("#form")[0].reset();
			    	$("#passwordhint").hide();
			    	$("#form input").attr("disabled",false);
			    	$("#form").attr("action","<?php echo site_url(); ?>/users/add");
			    	$("#edit").modal("show");
					$("#password").rules("add", {
						required:true,
						messages: {
								required: "Please Enter Password."
						}
					});
			    });

				$("#users").on("click",".editbtn",function(){
						validator.resetForm();
					$("div.error").hide();
			    	var id = $(this).attr("data-id");
			    	$("#eidt_gf_id").val(id);
			    	loadData(id);
			    	$("#passwordhint").show();
			    	$("#form").attr("action","<?php echo site_url(); ?>/users/update");
			    	$("#form input").attr("disabled",false);
			    	$("#Edit-Heading").html("Edit Patient Details");
			    	$("#action-add-btn").parent().hide();
			    	$("#action-update-btn").parent().show();
					$("#password").rules("remove","required");
			    });

			    function loadData(id){
			    	$.post("<?php echo site_url(); ?>/users/getusers",{ id: id },function(data){
			    		var data = JSON.parse(data);
			    		
						$("#first_name").val(data.first_name);
						
						$("#last_name").val(data.last_name);
						
						$("#useremail").val(data.useremail);
						
						$("#password").val(data.password);
						
						$("#address").val(data.address);
						
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
						
						shwoImgFromUrl(data.profile_photo);

			    	});
			    }

			    $("#users").on("click",".viewbtn",function(){
					validator.resetForm();
					$("div.error").hide();
			    	loadData($(this).attr("data-id"));
			    	$("#form input").attr("disabled",true);
			    	$("#form").attr("action","");
					$("#action-add-btn").parent().hide();
					$("#action-update-btn").parent().hide();
			    	$("#Edit-Heading").html("Patients Details");

			    });


			    $("#users").on("click",".delbtn",function(){
			    	$("#cur_del").val($(this).attr("data-id"));
			    });
			    
			    $("#del_yes").click(function(){
			    	var id = $("#cur_del").val();
			    	if(id!==""){
			    		$.post("<?php echo site_url(); ?>/users/delete",{id:id},function(){
			    			$("#tr_"+$("#cur_del").val()).parent().parent().hide();
			    			$("#delete").modal("hide");	
			    		});
			    	}
			    	else{
			    		$("#delete").modal("hide");
			    	}
			    	$(".modal-backdrop").hide();
			    });

			});

		</script>