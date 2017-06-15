<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
$this->load->view("template/header.php");
$this->load->view("template/left.php");
?>
			<input type="hidden" id="left_active_menu" value="1" />
		<div id="main-wrapper">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="panel panel-white">
	                    <div class="panel-heading clearfix">
	                        <h4 class="panel-title">Users</h4>
	                    </div>
	                    <div class="panel-body">
	                       <div class="table-responsive">
	                            <table id="users" class="display table" cellspacing="0" width="100%">
	                                <thead>
	                                    <tr><th style="width:10px"></th><th>First Name</th><th>Last Name</th><th>Usernemail</th><th>Address</th><th>Mobile</th><th>Phone</th><th>Profile Photo</th><th>Role</th><th>Action</th>
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
									</div>
				  				</div>
				  				<div class="col-md-12">
								  	<div class="form-group col-md-6">
										<label>Address</label>
										<input class="form-control " type="text" placeholder="Address" name="address" id="address" />
									</div>
									<div class="form-group col-md-6">
										<label>Mobile</label>
										<input class="form-control " type="text" placeholder="Mobile" name="mobile" id="mobile" />
									</div>
				  				</div>
				  				<div class="col-md-12">
				  					<div class="form-group col-md-6">
										<label>Phone</label>
										<input class="form-control " type="text" placeholder="Phone" name="phone" id="phone" />
									</div>
									<div class="form-group col-md-6">
										<label>Profile Photo</label>
										<input class="form-control " type="text" placeholder="Profile Photo" name="profile_photo" id="profile_photo" />
									</div>
									<div class="form-group col-md-6">
										<label>Role</label>
										<input class="form-control " type="text" placeholder="Role" name="role" id="role" />					
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

	    <?php
$this->load->view("template/footer.php");
?><script type="text/javascript">
		
			$(document).ready(function(){
				$("#users").DataTable({
		            "processing": true,
		            "serverSide": true,
		            "ajax": "<?php echo site_url(); ?>/users/getDTusers"
		        });

				$(".dataTables_filter").attr("style","display: flex;float: right");
				$(".dataTables_filter").append("<a class=\"btn btn-success m-b-sm addbtn\" data-toggle=\"tooltip\" title=\"Add\"  href=\"javascript:void(0);\" data-title=\"Add\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Add New</a>");
				$(".dataTables_filter").append("<a class=\"btn btn-danger m-b-sm multiDeleteBtn\" data-at=\"users\" data-toggle=\"tooltip\" title=\"Delete\"  href=\"javascript:void(0);\" data-title=\"Delete\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Delete</a>");

			    $("[data-toggle=tooltip]").tooltip();

			    $(".addbtn").click(function(){
			    	$("#Edit-Heading").html("Add New Record");
			    	$("#action-update-btn").parent().hide();
			    	$("#action-add-btn").parent().show();
			    	$("#form")[0].reset();
			    	$("#form input").attr("disabled",false);
			    	$("#form").attr("action","<?php echo site_url(); ?>/users/add");
			    	$("#edit").modal("show");
			    });

				$("#users").on("click",".editbtn",function(){
			    	var id = $(this).attr("data-id");
			    	$("#eidt_gf_id").val(id);
			    	loadData(id);
			    	$("#form").attr("action","<?php echo site_url(); ?>/users/update");
			    	$("#form input").attr("disabled",false);
			    	$("#Edit-Heading").html("Edit Your Data");
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
			    	$("#Edit-Heading").html("Detailed View");

			    });


			    $("#users").on("click",".delbtn",function(){
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
						
						$.post("<?php echo site_url(); ?>/users/delete",{id:id},function(data){
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