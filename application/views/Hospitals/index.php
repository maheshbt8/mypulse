<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
$this->load->view("template/header.php");
$this->load->view("template/left.php");
?>
		<input type="hidden" id="left_active_menu" value="2" />
		<input type="hidden" id="left_active_sub_menu" value="201" />
		<div id="main-wrapper">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="panel panel-white">
	                    <div class="panel-heading clearfix">
	                        <h4 class="panel-title">Hospitals</h4>
	                    </div>
	                    <div class="panel-body">
	                       <div class="table-responsive">
	                            <table id="hospitals" class="display table" cellspacing="0" width="100%">
	                                <thead>
	                                    <tr><th style="width:10px"></th><th>Name</th><th>License Status</th><th>City</th><th  width="20px">#</th>
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
				<form action="<?php echo site_url(); ?>/hospitals/update" method="post" id="form">
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
									<li role="presentation"><a href="#tab12" aria-controls="license" role="tab" data-toggle="tab">License</a></li>
                                    <li role="presentation"><a href="#tab2" aria-controls="branches" role="tab" data-toggle="tab" class="tab_tbl" data-tblid="tbl_branches" data-url="branches/getDTbranches/">Branches</a></li>
                                    <li role="presentation"><a href="#tab3" aria-controls="departments" role="tab" data-toggle="tab" class="tab_tbl" data-tblid="tbl_departments" data-url="departments/getDTdepartments/">Departments</a></li>
                                    <!-- <li role="presentation"><a href="#tab4" aria-controls="wards" role="tab" data-toggle="tab" class="tab_tbl" data-tblid="tbl_wards" data-url="">Wards</a></li> -->
                                    <li role="presentation"><a href="#tab5" aria-controls="beds" role="tab" data-toggle="tab" class="tab_tbl" data-tblid="tbl_beds" data-url="beds/getDTbeds/">Beds</a></li>
                                    <li role="presentation"><a href="#tab6" aria-controls="doctors" role="tab" data-toggle="tab" class="tab_tbl" data-tblid="tbl_doctors" data-url="doctors/getDTdoctors/">Doctors</a></li>
                                    <li role="presentation"><a href="#tab7" aria-controls="nurses" role="tab" data-toggle="tab" class="tab_tbl" data-tblid="tbl_nurses" data-url="nurse/getDTnurse/">Nurses</a></li>
                                    <li role="presentation"><a href="#tab8" aria-controls="receptionis" role="tab" data-toggle="tab" class="tab_tbl" data-tblid="tbl_receptionist" data-url="receptionist/getDTreceptionist/">Receptionists</a></li>
                                    <li role="presentation"><a href="#tab9" aria-controls="med_stores" role="tab" data-toggle="tab" class="tab_tbl" data-tblid="tbl_medstore" data-url="medical_store/getDTmedical_store/">Med. Stores</a></li>
                                    <li role="presentation"><a href="#tab10" aria-controls="med_labs" role="tab" data-toggle="tab" class="tab_tbl" data-tblid="tbl_medlabs" data-url="medical_lab/getDTmedical_lab/">Med. Labs</a></li>
									<li role="presentation"><a href="#tab11" aria-controls="charges" role="tab" data-toggle="tab" class="tab_tbl" data-tblid="tbl_charges" data-url="charges/getDTcharges/">Charges</a></li>
                                </ul>
                                <div class="tab-content">
                                	<div role="tabpanel" class="tab-pane active fade in" id="tab1">
                            			<div class="col-md-12">
											<div class ="col-md-6">
												<div class="form-group ">
													<label>Name</label>
													<input class="form-control " type="text" placeholder="Name" name="name" id="name" />
												</div>
												<div class="form-group">
													<label>Address</label>
													<input class="form-control " type="text" placeholder="Address" name="address" id="address" />
												</div>
											</div>
											<div class="form-group col-md-6">
												<label>Description</label>
												<textarea class="form-control " rows="5" placeholder="Description" name="description" id="description" ></textarea>					
											</div>
							  			</div>
							  			<div class="col-md-12">
							  				<!-- <div class="form-group col-md-6">
													<label>Logo</label>
													<input class="form-control " type="text" placeholder="Logo" name="logo" id="logo" />					
												</div> -->
											<div class="form-group col-md-6">
												<label>Email</label>
												<input class="form-control " type="text" placeholder="Email" name="email" id="email" />
											</div>	
											<div class="form-group col-md-6">
												<label>Phone Numbers</label>
												<input class="form-control " type="text" placeholder="Phone Numbers" name="phone_numbers" id="phone_numbers" />
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
							  			<hr>
							  				<div class="form-group col-md-6">
												<label>Owner/MD Name</label>
												<input class="form-control " type="text" placeholder="Owner/MD Name" name="md_name" id="md_name" />
											</div>
											<div class="form-group col-md-6">
												<label>Owner/MD Phone number</label>
												<input class="form-control " type="text" placeholder="Owner/MD Phone Numbers" name="md_contact_number" id="md_contact_number" />
											</div>
							  			</div>
							  			<div class="col-md-12">
							  				<div class="col-md-6 form-group">
							  					<label>Hospital Admin</label>
							  					<select name="hospital_id" id="hospital_id" class=" form-control">
							  						<option value="-1">Hospital Admin</option>
							  						<?php
							  							foreach ($hospital_admins as $key => $value) {
							  								echo "<option value='$value[id]'>$value[first_name] $value[last_name]</option>";
							  							}
							  						?>
												</select>
							  				</div>
							  				
							  			</div>            
                                    </div>
									<div role="tabpanel" class="tab-pane fade in" id="tab12">
										<div class="col-md-12">
							  				<div class="form-group col-md-6">
												<label>License</label>
												<select class="form-control" name="license_category" id="license_category">					
													<?php 
														foreach ($license as $key => $value) {
															echo "<option value='$value[license_code]'>$value[name]</option>";
														}
													?>
												</select>
											</div>
											<div class="form-group col-md-6">
												<label>License Status</label>
												<select class="form-control" name="license_status" id="license_status">
													<option value="1">Active</option>
													<option value="0">In-Active</option>
												</select>
											</div>
											<div class="form-group col-md-6">
												<label>License Validity</label>
												<div class="col-md-12">
													<div class="col-md-5">
														<input type="text" class="form-control date-picker" id="validity_start" value="<?php echo date('d-m-Y'); ?>" ></input>
													</div>
													<div class="col-md-2">
													to
													</div>
													<div class="col-md-5">
														<input type="text" class="form-control date-picker" id="validity_end" value="<?php echo date('d-m-Y', strtotime('+30 days')); ?>" ></input>
													</div>
												</div>
												
											</div>
							  			</div>
									</div>
                                    <div role="tabpanel" class="tab-pane fade in" id="tab2">
                                    	<table id="tbl_branches" class="display table table-bordered" cellspacing="0" width="100%">
			                                <thead>
			                                    <tr><th>#</th><th>Branche Name</th><th>Phone Number</th><th>City</th></tr>
			                                </thead>
			                                <tbody>
			                                </tbody>
			                            </table> 
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade in" id="tab3">
                                    	<table id="tbl_departments" class="display table table-bordered" cellspacing="0" width="100%">
			                                <thead>
			                                    <tr><th>#</th><th>Branche Name</th><th>Department Name</th></tr>
			                                </thead>
			                                <tbody>
			                                </tbody>
			                            </table>  
                                    </div>
                                    <div role="tabpanel" class="tab-pane  fade in" id="tab4">
                                    	<table id="tbl_wards" class="display table table-bordered" cellspacing="0" width="100%">
			                                <thead>
			                                    <tr><th>#</th><th>Ward</th></tr>
			                                </thead>
			                                <tbody>
			                                </tbody>
			                            </table> 
                                    </div>
                                    <div role="tabpanel" class="tab-pane  fade in" id="tab5">
                                    	<table id="tbl_beds" class="display table table-bordered" cellspacing="0" width="100%">
			                                <thead>
			                                    <tr><th>#</th><th>Ward</th><th>Bed</th></tr>
			                                </thead>
			                                <tbody>
			                                </tbody>
			                            </table> 
                                    </div>
                                    <div role="tabpanel" class="tab-pane  fade in" id="tab6">
                                    	<table id="tbl_doctors" class="display table table-bordered" cellspacing="0" width="100%">
			                                <thead>
			                                    <tr><th>#</th><th>Name</th><th>Branch</th><th>Department</th><th>Status</th></tr>
			                                </thead>
			                                <tbody>
			                                </tbody>
			                            </table> 
                                    </div>
                                    <div role="tabpanel" class="tab-pane  fade in" id="tab7">
                                    	<table id="tbl_nurses" class="display table table-bordered" cellspacing="0" width="100%">
			                                <thead>
			                                    <tr><th>#</th><th>Name</th><th>Branch</th><th>Department</th><th>Status</th></tr>
			                                </thead>
			                                <tbody>
			                                </tbody>
			                            </table> 
                                    </div>
                                    <div role="tabpanel" class="tab-pane  fade in" id="tab8">
                                    	<table id="tbl_receptionist" class="display table table-bordered" cellspacing="0" width="100%">
			                                <thead>
			                                    <tr><th>#</th><th>Name</th><th>Branch</th><th>Department</th><th>Doctor</th><th>Status</th></tr>
			                                </thead>
			                                <tbody>
			                                </tbody>
			                            </table> 
                                    </div>
                                    <div role="tabpanel" class="tab-pane  fade in" id="tab9">
                                    	<table id="tbl_medstore" class="display table table-bordered" cellspacing="0" width="100%">
			                                <thead>
			                                    <tr><th>#</th><th>Name</th><th>Owner Name</th><th>Owner Contact Number</th><th>Branch</th></tr>
			                                </thead>
			                                <tbody>
			                                </tbody>
			                            </table> 
                                    </div>
                                    <div role="tabpanel" class="tab-pane  fade in" id="tab10">
                                    	<table id="tbl_medlabs" class="display table table-bordered" cellspacing="0" width="100%">
			                                <thead>
			                                    <tr><th>#</th><th>Name</th><th>Owner Name</th><th>Owner Contact Number</th><th>Branch</th></tr>
			                                </thead>
			                                <tbody>
			                                </tbody>
			                            </table> 
                                    </div>
									<div role="tabpanel" class="tab-pane  fade in" id="tab11">
                                    	<table id="tbl_charges" class="display table table-bordered" cellspacing="0" width="100%">
			                                <thead>
			                                    <tr><th>#</th><th>Title</th><th>Type Of Charge</th><th>Description</th><th>Charge</th></tr>
			                                </thead>
			                                <tbody>
			                                </tbody>
			                            </table> 
                                    </div>
                                </div>
                            </div>                
				  			
						</div>
					</div>
				  	<div>
				  		<hr>
						<div class="col-md-12 error">
							<span class="model_error"></span>
						</div>
				  		<div class="row">
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
?>
	<script type="text/javascript">
		
			$(document).ready(function(){

				<?php
					$this->load->view("template/location");
				?>
				
				$(".tab_tbl").click(function(){
					var id = $(this).data('tblid');
					var url = $(this).data('url');
					$("#"+id).dataTable().fnDestroy();
					if(url == ""){
						$("#"+id).DataTable({
							"paging":   false,
					        "ordering": false,
					        "info":     false
						});	
					}else{
						$("#"+id).DataTable({
							"processing": true,
				            "serverSide": true,
				            "paging":   false,
					        "ordering": false,
					        "info":     false,
				            "ajax": '<?php echo site_url();?>/'+url+"?s=1&hid="+$("#eidt_gf_id").val()
						});
					}
					$("#"+id+"_filter").hide();
				});

				var validator = $("#form").validate({
					
			        rules: {
			        	
			        	name: {
			        		required : true
			        	},
			        	address: {
			        		required: true
			        	},
			        	email:{
			        		required:true,
			        		email:true
			        	},
			        	phone_numbers:{
			        		required:true
			        	},
			        	country:{
			        		required:true
			        	},
			        	state:{
			        		required:true
			        	},
			        	district:{
			        		required:true
			        	},
			        	city:{
			        		required:true
			        	}
			        },
			        messages: {
			        	
			        	name:{
			        		required: "Enter hospital name"
			        	},
			        	address:{
			        		required: "Enter hospital address"
			        	},
			        	email:{
			        		required: "Enter email address",
			        		email: "Enter valid email address"
			        	},
			        	phone_numbers:{
			        		required: "Enter phone number"
			        	},
			        	country:{
			        		required:"Select country"
			        	},
			        	state:{
			        		required:"Select state"
			        	},
			        	district:{
			        		required:"Select district"
			        	},
			        	city:{
			        		required:"Select city"
			        	}
			        }
				});


				$("#hospitals").DataTable({
		            "processing": true,
		            "serverSide": true,
		            "ajax": "<?php echo site_url(); ?>/hospitals/getDThospitals"
		        });

				$(".dataTables_filter").attr("style","display: flex;float: right");
				$(".dataTables_filter").append("<a class=\"btn btn-success m-b-sm addbtn\" data-toggle=\"tooltip\" title=\"Add\"  href=\"javascript:void(0);\" data-title=\"Add\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Add New</a>");
				$(".dataTables_filter").append("<a class=\"btn btn-danger m-b-sm multiDeleteBtn\" data-at=\"hospitals\" data-toggle=\"tooltip\" title=\"Delete\"  href=\"javascript:void(0);\" data-title=\"Delete\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Delete</a>");
				
				
			    $("[data-toggle=tooltip]").tooltip();

			    $(".addbtn").click(function(){
					validator.resetForm();
					resetLocation();
			    	$("#Edit-Heading").html("Add New Hospital");
			    	$("#action-update-btn").parent().hide();
			    	$("#action-add-btn").parent().show();
			    	$("#form")[0].reset();
			    	$("#form input").attr("disabled",false);
			    	$("#form").attr("action","<?php echo site_url(); ?>/hospitals/add");
			    	$("#edit").modal("show");
					$('#tabs a[href="#tab1"]').click();
			    });

				$("#hospitals").on("click",".editbtn",function(){
					validator.resetForm();
					resetLocation();
			    	var id = $(this).attr("data-id");
			    	$("#eidt_gf_id").val(id);
			    	loadData(id,true);
			    	$("#form").attr("action","<?php echo site_url(); ?>/hospitals/update");
			    	$("#form input").attr("disabled",false);
			    	$("#Edit-Heading").html("Hospital Data");
			    	$("#action-add-btn").parent().hide();
			    	$("#action-update-btn").parent().show();
					$('#tabs a[href="#tab1"]').click();
			    });

			    function loadData(id,isEdit){
			    	$.post("<?php echo site_url(); ?>/hospitals/gethospitals",{ id: id },function(data){
			    		var data = JSON.parse(data);
						$("#name").val(data.name);
						$("#Edit-Heading").html(data.name+" Information");
						$("#address").val(data.address);
						$("#logo").val(data.logo);
						$("#phone_numbers").val(data.phone_numbers);
						$("#email").val(data.email);
						$("#license_status").val(data.license_status);
						if(data.country != null && data.country!=undefined && data.country != "" && data.country > 0){
							loc_cid = data.city;
							loc_did = data.district;
							loc_sid = data.state;
							var tempselectize_selectize_country = $selectize_country[0].selectize;
							tempselectize_selectize_country.addOption([{"id":data.country,"text":data.country}]);
							tempselectize_selectize_country.refreshItems();
							tempselectize_selectize_country.setValue(data.country);
						}
			    	});
			    }

			    $("#hospitals").on("click",".viewbtn",function(){
					validator.resetForm();
			    	$("#form input").attr("disabled",true);
			    	$("#form").attr("action","");
					$("#action-add-btn").parent().hide();
					$("#action-update-btn").parent().hide();
			    	$("#Edit-Heading").html("Detailed View");
			    	loadData($(this).attr("data-id"),false);
					$('#tabs a[href="#tab1"]').click();

			    });


			    $("#hospitals").on("click",".delbtn",function(){
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
						
						$.post("<?php echo site_url(); ?>/hospitals/delete",{id:id},function(data){
							if(data==1){
								$("#dellink_"+id).parents('tr').remove();	
								toastr.success('selected item(s) deleted.');
							}else{
								toastr.error('Please try again.');
							}
						});
					});
			    });
			

			});

		</script>