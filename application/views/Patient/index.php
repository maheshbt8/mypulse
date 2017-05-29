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
				<form action="<?php echo site_url(); ?>/users/update" method="post" id="form">
					<input type="hidden" name="eidt_gf_id" id="eidt_gf_id">
					<input type="hidden" name="role" value="<?php echo $this->auth->getPatientRoleType(); ?>">
					<div class="modal-content">
				  		<div class="modal-header">
						  	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					  		<h4 class="modal-title custom_align" id="Edit-Heading">Edit User Detail</h4>
						</div>
				  		<div class="modal-body">
				  			<div class="row">
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
										<label>User Email</label>
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
				$("#users").DataTable({
		            "processing": true,
		            "serverSide": true,
		            "ajax": "<?php echo site_url(); ?>/patients/getDTusers"
		        });

				$(".dataTables_filter").attr("style","display: flex;float: right");
				$(".dataTables_filter").append("<a class=\"btn btn-success m-b-sm addbtn\" data-toggle=\"tooltip\" title=\"Add\"  href=\"javascript:void(0);\" data-title=\"Add\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Add New</a>");
				
			    $("[data-toggle=tooltip]").tooltip();

			    $(".addbtn").click(function(){
			    	$("#Edit-Heading").html("Add New Patient");
			    	$("#action-update-btn").parent().hide();
			    	$("#action-add-btn").parent().show();
			    	$("#form")[0].reset();
			    	$("#passwordhint").hide();
			    	$("#form input").attr("disabled",false);
			    	$("#form").attr("action","<?php echo site_url(); ?>/users/add");
			    	$("#edit").modal("show");
			    });

				$("#users").on("click",".editbtn",function(){
			    	var id = $(this).attr("data-id");
			    	$("#eidt_gf_id").val(id);
			    	loadData(id);
			    	$("#passwordhint").show();
			    	$("#form").attr("action","<?php echo site_url(); ?>/users/update");
			    	$("#form input").attr("disabled",false);
			    	$("#Edit-Heading").html("Edit Patient Details");
			    	$("#action-add-btn").parent().hide();
			    	$("#action-update-btn").parent().show();
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
					

			    	});
			    }

			    $("#users").on("click",".viewbtn",function(){
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