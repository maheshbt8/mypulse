<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
$this->load->view("template/header.php");
$this->load->view("template/left.php");
?>
		<input type="hidden" id="left_active_menu" value="2" />
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
	                                    <tr><th>Name</th><th>License Status</th><th>City</th><th  width="20px">#</th>
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

				  			 <div role="tabpanel">
                                <ul class="nav  nav-pills" role="tablist">
                                    <li role="presentation" class="active"><a href="#tab1" aria-controls="home" role="tab" data-toggle="tab">General</a></li>
									<li role="presentation"><a href="#tab12" aria-controls="license" role="tab" data-toggle="tab">License</a></li>
                                    <li role="presentation"><a href="#tab2" aria-controls="branches" role="tab" data-toggle="tab" class="tab_tbl" data-tblid="tbl_branches" data-url="branches/getDTbranches/">Branches</a></li>
                                    <li role="presentation"><a href="#tab3" id="deplin" aria-controls="departments" role="tab" data-toggle="tab">Departments</a></li>
                                    <!-- <li role="presentation"><a href="#tab4" aria-controls="wards" role="tab" data-toggle="tab" class="tab_tbl" data-tblid="tbl_wards" data-url="">Wards</a></li> -->
                                    <li role="presentation"><a href="#tab5" aria-controls="beds" role="tab" data-toggle="tab" class="tab_tbl" data-tblid="tbl_beds" data-url="beds/getDTbeds/">Beds</a></li>
                                    <li role="presentation"><a href="#tab6" aria-controls="doctors" role="tab" data-toggle="tab" class="tab_tbl" data-tblid="tbl_doctors" data-url="">Doctors</a></li>
                                    <li role="presentation"><a href="#tab7" aria-controls="nurses" role="tab" data-toggle="tab" class="tab_tbl" data-tblid="tbl_nurses" data-url="">Nurses</a></li>
                                    <li role="presentation"><a href="#tab8" aria-controls="receptionis" role="tab" data-toggle="tab" class="tab_tbl" data-tblid="tbl_receptionist" data-url="">Receptionists</a></li>
                                    <li role="presentation"><a href="#tab9" aria-controls="med_stores" role="tab" data-toggle="tab" class="tab_tbl" data-tblid="tbl_medstore" data-url="">Med. Stores</a></li>
                                    <li role="presentation"><a href="#tab10" aria-controls="med_labs" role="tab" data-toggle="tab" class="tab_tbl" data-tblid="tbl_medlabs" data-url="">Med. Labs</a></li>
									<li role="presentation"><a href="#tab11" aria-controls="charges" role="tab" data-toggle="tab" class="tab_tbl" data-tblid="tbl_charges" data-url="charges/getDTcharges/">Charges</a></li>
                                </ul>
                                <div class="tab-content">
                                	<div role="tabpanel" class="tab-pane active fade in" id="tab1">
                            			<div class="col-md-12">
							  				<div class="form-group col-md-6">
												<label>Name</label>
												<input class="form-control " type="text" placeholder="Name" name="name" id="name" />
											</div>
											<div class="form-group col-md-6">
												<label>Address</label>
												<input class="form-control " type="text" placeholder="Address" name="address" id="address" />
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
							  				<div class="form-group col-md-6">
												<label>Country</label>
												<input class="form-control " type="text" placeholder="Country" name="country" id="country" />
											</div>
											
											<div class="form-group col-md-6">
												<label>State</label>
												<input class="form-control " type="text" placeholder="State" name="state" id="state" />
											</div>
							  			</div>
							  			<div class="col-md-12">
							  				<div class="form-group col-md-6">
												<label>District</label>
												<input class="form-control " type="text" placeholder="District" name="district" id="district" />					
											</div>
											<div class="form-group col-md-6">
												<label>City</label>
												<input class="form-control " type="text" placeholder="City" name="city" id="city" />
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
												<input type="text" class="form-control date-picker" id="validity" value="<?php echo date('d-m-Y', strtotime('+30 days')); ?>" ></input>
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
                                    	<table id="departments" class="display table table-bordered" cellspacing="0" width="100%">
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
			                                    <tr><th>#</th><th>Branch</th><th>Department</th><th>Bed</th></tr>
			                                </thead>
			                                <tbody>
			                                </tbody>
			                            </table> 
                                    </div>
                                    <div role="tabpanel" class="tab-pane  fade in" id="tab6">
                                    	<table id="tbl_doctors" class="display table table-bordered" cellspacing="0" width="100%">
			                                <thead>
			                                    <tr><th>#</th><th>Name</th><th>Department</th><th>Specilization</th></tr>
			                                </thead>
			                                <tbody>
			                                </tbody>
			                            </table> 
                                    </div>
                                    <div role="tabpanel" class="tab-pane  fade in" id="tab7">
                                    	<table id="tbl_nurses" class="display table table-bordered" cellspacing="0" width="100%">
			                                <thead>
			                                    <tr><th>#</th><th>Name</th><th>Department</th><th>Associated Doctor</th></tr>
			                                </thead>
			                                <tbody>
			                                </tbody>
			                            </table> 
                                    </div>
                                    <div role="tabpanel" class="tab-pane  fade in" id="tab8">
                                    	<table id="tbl_receptionist" class="display table table-bordered" cellspacing="0" width="100%">
			                                <thead>
			                                    <tr><th>#</th><th>Name</th><th>Department</th></tr>
			                                </thead>
			                                <tbody>
			                                </tbody>
			                            </table> 
                                    </div>
                                    <div role="tabpanel" class="tab-pane  fade in" id="tab9">
                                    	<table id="tbl_medstore" class="display table table-bordered" cellspacing="0" width="100%">
			                                <thead>
			                                    <tr><th>#</th><th>Name</th><th>Department</th></tr>
			                                </thead>
			                                <tbody>
			                                </tbody>
			                            </table> 
                                    </div>
                                    <div role="tabpanel" class="tab-pane  fade in" id="tab10">
                                    	<table id="tbl_medlabs" class="display table table-bordered" cellspacing="0" width="100%">
			                                <thead>
			                                    <tr><th>#</th><th>Name</th><th>Department</th></tr>
			                                </thead>
			                                <tbody>
			                                </tbody>
			                            </table> 
                                    </div>
									<div role="tabpanel" class="tab-pane  fade in" id="tab11">
                                    	<table id="tbl_charges" class="display table table-bordered" cellspacing="0" width="100%">
			                                <thead>
			                                    <tr><th>#</th><th>Title</th><th>Type Of Charge</th><th>Charge</th></tr>
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
		</div><div class="modal fade bs-example-modal-sm" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
	      	<div class="modal-dialog modal-sm">
	    		<div class="modal-content">
	          		<div class="modal-header">
	        			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
	        			<h4 class="modal-title custom_align" id="Heading">Delete Item</h4>
	      			</div>
	          		<div class="modal-body">
	       				<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure? You want to delete this Item?</div>

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

				$("#deplin").click(function(){
					var id = $("#eidt_gf_id").val();
					$("#departments").dataTable().fnDestroy();
					$("#departments").DataTable({
						"processing": true,
			            "serverSide": true,
			            "paging":   false,
				        "ordering": false,
				        "info":     false,
			            "ajax": "<?php echo site_url(); ?>/departments/getDTdepartments/"+id
					});
					$("#departments_filter").hide();
				});

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
				            "ajax": '<?php echo site_url();?>/'+url+$("#eidt_gf_id").val()
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
			        		required:"Enter country"
			        	},
			        	state:{
			        		required:"Enter state"
			        	},
			        	district:{
			        		required:"Enter district"
			        	},
			        	city:{
			        		required:"Enter city"
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
				
			    $("[data-toggle=tooltip]").tooltip();

			    $(".addbtn").click(function(){
			    	$("#Edit-Heading").html("Add New Hospital");
			    	$("#action-update-btn").parent().hide();
			    	$("#action-add-btn").parent().show();
			    	$("#form")[0].reset();
			    	$("#form input").attr("disabled",false);
			    	$("#form").attr("action","<?php echo site_url(); ?>/hospitals/add");
			    	$("#edit").modal("show");
			    });

				$("#hospitals").on("click",".editbtn",function(){
			    	var id = $(this).attr("data-id");
			    	$("#eidt_gf_id").val(id);
			    	loadData(id,true);
			    	$("#form").attr("action","<?php echo site_url(); ?>/hospitals/update");
			    	$("#form input").attr("disabled",false);
			    	$("#Edit-Heading").html("Edit Hospital Data");
			    	$("#action-add-btn").parent().hide();
			    	$("#action-update-btn").parent().show();
			    });

			    function loadData(id,isEdit){
			    	$.post("<?php echo site_url(); ?>/hospitals/gethospitals",{ id: id },function(data){
			    		var data = JSON.parse(data);
			    		
						$("#name").val(data.name);
						if(isEdit)
							$("#Edit-Heading").html("Edit "+data.name+" Information");
						else
							$("#Edit-Heading").html(data.name+" Information");

						$("#address").val(data.address);
						
						$("#logo").val(data.logo);
						
						$("#phone_numbers").val(data.phone_numbers);
						
						$("#email").val(data.email);
						
						$("#city").val(data.city);
						
						$("#district").val(data.district);
						
						$("#state").val(data.state);
						
						$("#country").val(data.country);
					
			    	});
			    }

			    $("#hospitals").on("click",".viewbtn",function(){
			    	$("#form input").attr("disabled",true);
			    	$("#form").attr("action","");
					$("#action-add-btn").parent().hide();
					$("#action-update-btn").parent().hide();
			    	$("#Edit-Heading").html("Detailed View");
			    	loadData($(this).attr("data-id"),false);

			    });


			    $("#hospitals").on("click",".delbtn",function(){
			    	$("#cur_del").val($(this).attr("data-id"));
			    });
			    
			    $("#del_yes").click(function(){
			    	var id = $("#cur_del").val();
			    	if(id!==""){
			    		$.post("<?php echo site_url(); ?>/hospitals/delete",{id:id},function(){
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