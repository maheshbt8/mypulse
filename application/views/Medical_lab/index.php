<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
$this->load->view("template/header.php");
$this->load->view("template/left.php");
?>
			<input type="hidden" id="left_active_menu" value="9" />
		<div id="main-wrapper">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="panel panel-white">
	                    <div class="panel-heading clearfix">
	                        <h4 class="panel-title">Medical Lab</h4>
	                    </div>
	                    <div class="panel-body">
	                       <div class="table-responsive">
	                            <table id="medical_lab" class="display table" cellspacing="0" width="100%">
	                                <thead>
	                                    <tr><th style="width:10px"></th><th>Name</th><th>Owner Name</th><th>Owner Contact Number</th><th>Hospital</th><th>Branch</th><th width="20px">#</th>
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

				<form action="<?php echo site_url(); ?>/medical_lab/update" method="post" id="form">
				<input type="hidden" name="eidt_gf_id" id="eidt_gf_id">
				<div class="modal-content">
				  	<div class="modal-header">
					  	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					  	<h4 class="modal-title custom_align" id="Edit-Heading">Edit Your Detail</h4>
					</div>
				  	<div class="modal-body">
						<div class="row">

				  			 <div role="tabpanel" id="tabs">
                                <ul class="nav  nav-pills" role="tablist">
                                    <li role="presentation" class="active"><a href="#tab1" aria-controls="home" role="tab" data-toggle="tab">General</a></li>
									<li role="presentation"><a href="#tab2" aria-controls="ha" role="tab" data-toggle="tab">Hospital Association</a></li>
                                    <li role="presentation"><a href="#tab3" aria-controls="incharge" role="tab" data-toggle="tab">Medical Lab Incharge</a></li>
									<li role="presentation"><a href="#tab4" aria-controls="prof" role="tab" data-toggle="tab">Profession Info.</a></li>
								</ul>
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane active fade in" id="tab1">
										<div class="col-md-12">
											<div class="form-group col-md-6">
												<label>Name</label>
												<input class="form-control " type="text" placeholder="Name" name="name" id="name" />
											</div>
											<div class="form-group col-md-6">
												<label>Description</label>
												<textarea class="form-control"  placeholder="Description" name="md_description" id="md_description"></textarea>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group col-md-6">
												<label>Owner Name</label>
												<input class="form-control " type="text" placeholder="Owner Name" name="owner_name" id="owner_name" />
											</div>
											<div class="form-group col-md-6">
												<label>Owner Contact Number</label>
												<input class="form-control " type="text" placeholder="Owner Contact Number" name="owner_contact_number" id="owner_contact_number" />
											</div>
										</div>
										
									</div>
									<div role="tabpanel" class="tab-pane fade in" id="tab2">
										<div class="col-md-12">	
											<div class="form-group col-md-6">
												<label>Select Hospital</label>
												<select name="hospital_id" id="hospital_id" class=" form-control" style="width: 100%">
												</select>
											</div>
											<div class="form-group col-md-6">
												<label>Branch</label>
												<select name="branch_id" id="branch_id" class=" form-control" style="width: 100%">
												</select>
											</div>
										</div>
									</div>
                                	<div role="tabpanel" class="tab-pane fade in" id="tab3">
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
												<input class="form-control " type="text" placeholder="Usernemail" name="useremail" id="useremail" />
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
											<div class="form-group col-md-6">
												<label>Description</label>
												<textarea class="form-control"  placeholder="Description" name="description" id="description"></textarea>
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

				var validator = $("#form").validate({
					ignore: [],
			        rules: {
			        	name:{
							required:true
						},
						owner_name:{
							required : true
						},
						owner_contact_number:{
							required : true,
							phoneUS: true
						},
						description:{
							required : true							
						}
			        	
			        },
			        messages: {
			        	name:{
							required:"Enter Medical Lab name"
						},
						owner_name:{
							required : "Enter Medical Lab Owner's name"
						},
						description:{
							required : "Enter Description"
						},
						owner_contact_number:{
							required : "Enter Medical Lab Owner's Contact Number",
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

				$("#medical_lab").DataTable({
		            "processing": true,
		            "serverSide": true,
		            "ajax": "<?php echo site_url(); ?>/medical_lab/getDTmedical_lab"
		        });

				$(".dataTables_filter").attr("style","display: flex;float: right");
				$(".dataTables_filter").append("<a class=\"btn btn-success m-b-sm addbtn\" data-toggle=\"tooltip\" title=\"Add\"  href=\"javascript:void(0);\" data-title=\"Add\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Add New</a>");
				$(".dataTables_filter").append("<a class=\"btn btn-danger m-b-sm multiDeleteBtn\" data-at=\"medical_lab\" data-toggle=\"tooltip\" title=\"Delete\"  href=\"javascript:void(0);\" data-title=\"Delete\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Delete</a>");

			    $("[data-toggle=tooltip]").tooltip();

			    $(".addbtn").click(function(){
					validator.resetForm();
					resetLocation();
					$("div.error").hide();
			    	$("#Edit-Heading").html("Add New Medical Lab");
			    	$("#action-update-btn").parent().hide();
			    	$("#action-add-btn").parent().show();
			    	$("#form")[0].reset();
					$("#passwordhint").hide();
			    	$("#form input").attr("disabled",false);
			    	$("#form").attr("action","<?php echo site_url(); ?>/medical_lab/add");
			    	$("#edit").modal("show");
					$('#tabs a[href="#tab1"]').click();
					
			    });

				$("#medical_lab").on("click",".editbtn",function(){
					validator.resetForm();
					resetLocation();
					$("div.error").hide();
			    	var id = $(this).attr("data-id");
			    	$("#eidt_gf_id").val(id);
			    	loadData(id);
					$("#passwordhint").show();
			    	$("#form").attr("action","<?php echo site_url(); ?>/medical_lab/update");
			    	$("#form input").attr("disabled",false);
			    	$("#Edit-Heading").html("Edit Details");
			    	$("#action-add-btn").parent().hide();
			    	$("#action-update-btn").parent().show();
					$('#tabs a[href="#tab1"]').click();
					
			    });

			    function loadData(id){
			    	$.post("<?php echo site_url(); ?>/medical_lab/getmedical_lab",{ id: id },function(data){
			    		var data = JSON.parse(data);
			    		
						$("#name").val(data.name);
						
						$("#owner_name").val(data.owner_name);
						$("#md_description").val(data.description);
						$("#owner_contact_number").val(data.owner_contact_number);
						
						branch_id = data.branch_id;

						var tempselectize_hospital_id = $selectize_hospital_id[0].selectize;
						tempselectize_hospital_id.addOption([{"id":data.hospital_id,"text":data.hospital_id}]);
						tempselectize_hospital_id.refreshItems();
						tempselectize_hospital_id.setValue(data.hospital_id);
						
						var user = data.user;
						if(user != null && user!= undefined){
							if(user.first_name != undefined)
								$("#first_name").val(user.first_name);
							if(user.last_name != undefined)
								$("#last_name").val(user.last_name);
							if(user.useremail != undefined)
								$("#useremail").val(user.useremail);
							if(user.address != undefined)
								$("#address").val(user.address);
							if(user.mobile != undefined)
								$("#mobile").val(user.mobile);
							if(user.phone != undefined)
								$("#phone").val(user.phone);
							if(user.aadhaar_number != undefined)
								$("#aadhaar_number").val(user.aadhaar_number);
							if(user.gender != undefined)
								$("#gender").val(user.gender);	
							if(user.description != undefined)
								$("#description").val(user.description);
							if(user.alternate_mobile_number != undefined)	
								$("#alternate_mobile_number").val(user.alternate_mobile_number);
							if(user.date_of_birth!= undefined &&  user.date_of_birth != "" && user.date_of_birth != "0000-00-00"){
								$("#date_of_birth").datepicker("update", new Date(user.date_of_birth));
							}

							if(user.country != null && user.country!=undefined && user.country != "" && user.country > 0){
								loc_cid = user.city;
								loc_did = user.district;
								loc_sid = user.state;
								var tempselectize_selectize_country = $selectize_country[0].selectize;
								tempselectize_selectize_country.addOption([{"id":user.country,"text":user.country}]);
								tempselectize_selectize_country.refreshItems();
								tempselectize_selectize_country.setValue(user.country);
							}
							shwoImgFromUrl(user.profile_photo);
						}

			    	});
			    }

			    $("#medical_lab").on("click",".viewbtn",function(){
					validator.resetForm();
					resetLocation();
					$("div.error").hide();
			    	loadData($(this).attr("data-id"));
			    	$("#form input").attr("disabled",true);
			    	$("#form").attr("action","");
					$("#action-add-btn").parent().hide();
					$("#action-update-btn").parent().hide();
			    	$("#Edit-Heading").html("View Details");
					$('#tabs a[href="#tab1"]').click();
			    });


			    $("#medical_lab").on("click",".delbtn",function(){
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
						
						$.post("<?php echo site_url(); ?>/medical_lab/delete",{id:id},function(data){
							if(data==1){
								$("#dellink_"+id).parents('tr').remove();	
								toastr.success('selected item(s) deleted.');
							}else{
								toastr.error('Please try again.');
							}
						});
					});
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
				    }
				});

				$selectize_branch_id[0].selectize.disable();
				var xhr;	
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
				                    if(branch_id != null && branch_id > 0){
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