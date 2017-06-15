<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
$this->load->view("template/header.php");
$this->load->view("template/left.php");
?>
		<input type="hidden" id="left_active_menu" value="5" />
		<div id="main-wrapper">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="panel panel-white">
	                    <div class="panel-heading clearfix">
	                        <h4 class="panel-title">Nurse</h4>
	                    </div>
	                    <div class="panel-body">
	                       <div class="table-responsive">
	                            <table id="nurse" class="display table" cellspacing="0" width="100%">
	                                <thead>
	                                    <tr><th style="width:10px"></th><th>Nurse</th><th>Hospital</th><th>Branch</th><th>Department</th><th>Status</th><th width="20px">#</th>
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
				<form action="<?php echo site_url(); ?>/nurse/update" method="post" id="form" enctype="multipart/form-data">
				<input type="hidden" name="eidt_gf_id" id="eidt_gf_id">
				<div class="modal-content">
				  	<div class="modal-header">
					  	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					  	<h4 class="modal-title custom_align" id="Edit-Heading">Edit Your Detail</h4>
					</div>
				  	<div class="modal-body">
				  		<div class="row">
						  	<div role="tabpanel">
                                <ul class="nav  nav-pills" role="tablist">
                                    <li role="presentation" class="active"><a href="#tab1" aria-controls="gen" role="tab" data-toggle="tab">Basic</a></li>
									<li role="presentation"><a href="#tab2" aria-controls="ha" role="tab" data-toggle="tab">Hospital Association</a></li>
									<li role="presentation"><a href="#tab3" aria-controls="other" role="tab" data-toggle="tab">Other Profile Info.</a></li>
									<li role="presentation"><a href="#tab4" aria-controls="prof" role="tab" data-toggle="tab">Profession Info.</a></li>
								</ul>
								<div class="tab-content">
                                	<div role="tabpanel" class="tab-pane active fade in" id="tab1">
										<div class="col-md-12">
											<div class="col-md-6">
												<div class="form-group ">
													<label>First Name</label>
													<input class="form-control " type="text" placeholder="First Name" name="first_name" id="first_name" />
												</div>
												<div class="form-group">
													<label>Last Name</label>
													<input class="form-control " type="text" placeholder="Last Name" name="last_name" id="last_name" />
												</div>
											</div>	
											<div class="form-group col-md-6">
												<label>About Me</label>
												<textarea class="form-control" rows="5"  placeholder="Write Few Words about your self." name="description" id="description"></textarea>
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
										</div>
										
									</div>
									<div role="tabpanel" class="tab-pane fade in" id="tab2">
										<div class="col-md-12">
											<div class="form-group col-md-4">
                                                <label>Select Hospital</label>
                                                <select name="hospital_id"  id="hospital_id" class=" form-control" style="width: 100%">
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Select Branch</label>
                                                <select name="branch_id" id="branch_id" class=" form-control" style="width: 100%">
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Select Department</label>
                                                <select name="department_id" id="department_id" class=" form-control" style="width: 100%">
                                                </select>
                                            </div>
										</div>
									</div>
									<div role="tabpanel" class="tab-pane fade in" id="tab3">
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
												<label>Alternate Mobile Number</label>
												<input class="form-control" type="text" placeholder="Alternate Mobile Number" name="alternate_mobile_numberstate" id="alternate_mobile_number" />
											</div>
										</div>
										<div class="col-md-12">
							  				<div class="form-group col-md-3">
												<label>Select Country</label>
												<select name="country"  id="country" class=" form-control" style="width: 100%"></select>
											</div>
											<div class="form-group col-md-3">
												<label>Select State</label>
												<select name="state"  id="state" class=" form-control" style="width: 100%"></select>
											</div>
							  				<div class="form-group col-md-3">
												<label>Select District</label>
												<select name="district"  id="district" class=" form-control" style="width: 100%"></select>
											</div>
											<div class="form-group col-md-3">
												<label>Select City</label>
												<select name="city"  id="city" class=" form-control" style="width: 100%"></select>
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
									<div role="tabpanel" class="tab-pane fade in" id="tab4">
										<div class="col-md-12">
											<div class="form-group col-md-6">
												<label>Qualification</label>
												<input class="form-control" type="text" placeholder="Qualification" name1="qualification" id="qualification" />
											</div>
											<div class="form-group col-md-6">
												<label>Experience</label>
												<input class="form-control" type="text" placeholder="Experience" name1="experience" id="experience" />
											</div>
										</div>	
										<div class="col-md-12">
											
											<div class="form-group col-md-6">
												<label>Availability</label>
												<textarea class="form-control" type="text" placeholder="Availability" name1="availability" id="availability" ></textarea>
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
	    <?php
$this->load->view("template/footer.php");
?><script type="text/javascript">
		
			$(document).ready(function(){
				<?php
					$this->load->view("template/location");
				?>
				var branch_id = null;
				var department_id = null;

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
			        		required:"Enter mobile number",
							phoneUS: "Enter valid phone number"
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

				$("#nurse").DataTable({
		            "processing": true,
		            "serverSide": true,
		            "ajax": "<?php echo site_url(); ?>/nurse/getDTnurse"
		        });

				$(".dataTables_filter").attr("style","display: flex;float: right");
				$(".dataTables_filter").append("<a class=\"btn btn-success m-b-sm addbtn\" data-toggle=\"tooltip\" title=\"Add\"  href=\"javascript:void(0);\" data-title=\"Add\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Add New</a>");
				$(".dataTables_filter").append("<a class=\"btn btn-danger m-b-sm multiDeleteBtn\" data-at=\"nurse\" data-toggle=\"tooltip\" title=\"Delete\"  href=\"javascript:void(0);\" data-title=\"Delete\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Delete</a>");

			    $("[data-toggle=tooltip]").tooltip();

			    $(".addbtn").click(function(){
					validator.resetForm();
					resetLocation();
					$("div.error").hide();
			    	$("#Edit-Heading").html("Add New Nurse");
			    	$("#action-update-btn").parent().hide();
			    	$("#action-add-btn").parent().show();
			    	$("#form")[0].reset();
			    	$("#passwordhint").hide();
			    	$("#form input").attr("disabled",false);
			    	$("#form").attr("action","<?php echo site_url(); ?>/nurse/add");
			    	$("#edit").modal("show");
					$("#password").rules("add", {
						required:true,
						messages: {
								required: "Please Enter Password."
						}
					});
			    });

				$("#nurse").on("click",".editbtn",function(){
					validator.resetForm();
					resetLocation();
					$("div.error").hide();
			    	var id = $(this).attr("data-id");
			    	$("#eidt_gf_id").val(id);
			    	loadData(id);
			    	$("#passwordhint").show();
			    	$("#form").attr("action","<?php echo site_url(); ?>/nurse/update");
			    	$("#form input").attr("disabled",false);
			    	$("#Edit-Heading").html("Edit Nurse Details");
			    	$("#action-add-btn").parent().hide();
			    	$("#action-update-btn").parent().show();
					$("#password").rules("remove","required");
			    });

			    function loadData(id){
			    	$.post("<?php echo site_url(); ?>/nurse/getnurse",{ id: id },function(data){
			    		var data = JSON.parse(data);
			    		
						/*var tempselectize_department_id = $selectize_department_id[0].selectize;
						tempselectize_department_id.addOption([{"id":data.department_id,"text":data.department_id}]);
						tempselectize_department_id.refreshItems();
						tempselectize_department_id.setValue(data.department_id);*/

						var tempselectize_hospital_id = $selectize_hospital_id[0].selectize;
						tempselectize_hospital_id.addOption([{"id":data.hospital_id,"text":data.hospital_id}]);
						tempselectize_hospital_id.refreshItems();
						tempselectize_hospital_id.setValue(data.hospital_id);

						branch_id = data.branch_id;
						department_id = data.department_id;
					
						$("#first_name").val(data.first_name);
						
						$("#last_name").val(data.last_name);
						
						$("#useremail").val(data.useremail);
						
						$("#address").val(data.address);
						
						$("#mobile").val(data.mobile);
						$("#aadhaar_number").val(data.aadhaar_number);
						$("#phone").val(data.phone);

						$("#gender").val(data.gender);
						
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

			    $("#nurse").on("click",".viewbtn",function(){
					validator.resetForm();
					$("div.error").hide();
			    	loadData($(this).attr("data-id"));
			    	$("#form input").attr("disabled",true);
			    	$("#form").attr("action","");
					$("#action-add-btn").parent().hide();
					$("#action-update-btn").parent().hide();
			    	$("#Edit-Heading").html("Nurse Details");

			    });


			    $("#nurse").on("click",".delbtn",function(){
			    	var id = $(this).attr("data-id");
					swal({
						title: 'Are you sure?',
						text: "You won't be able to revert this!",
						type: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Yes'
					}).then(function () {
						
						$.post("<?php echo site_url(); ?>/nurse/delete",{id:id},function(data){
							if(data==1){
								$("#dellink_"+id).parents('tr').remove();	
								toastr.success('selected item(s) deleted.');
							}else{
								toastr.error('Please try again.');
							}
						});
					});
			    });
			    
			    var xhr;


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
				                    if(department_id != null){
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
				    }
				});

				$selectize_branch_id[0].selectize.disable();
				$selectize_department_id[0].selectize.disable();

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
				                    if(branch_id != null){
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

					

			});

		</script>