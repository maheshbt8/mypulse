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
	                                    <tr><th>Name</th><th>License Status</th><th>City</th><th>Action</th>
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
				  			<div class="col-md-12">
				  			<div class="form-group col-md-6">
					<label>Name</label>
					<input class="form-control " type="text" placeholder="Name" name="name" id="name" />
					
		</div><div class="form-group col-md-6">
					<label>Address</label>
					<input class="form-control " type="text" placeholder="Address" name="address" id="address" />
					
		</div>
				  					</div>
				  					<div class="col-md-12">
				  				<div class="form-group col-md-6">
					<label>Logo</label>
					<input class="form-control " type="text" placeholder="Logo" name="logo" id="logo" />
					
		</div><div class="form-group col-md-6">
					<label>Phone Numbers</label>
					<input class="form-control " type="text" placeholder="Phone Numbers" name="phone_numbers" id="phone_numbers" />
					
		</div>
				  					</div>
				  					<div class="col-md-12">
				  				<div class="form-group col-md-6">
					<label>Email</label>
					<input class="form-control " type="text" placeholder="Email" name="email" id="email" />
					
		</div><div class="form-group col-md-6">
					<label>City</label>
					<input class="form-control " type="text" placeholder="City" name="city" id="city" />
					
		</div>
				  					</div>
				  					<div class="col-md-12">
				  				<div class="form-group col-md-6">
					<label>District</label>
					<input class="form-control " type="text" placeholder="District" name="district" id="district" />
					
		</div><div class="form-group col-md-6">
					<label>State</label>
					<input class="form-control " type="text" placeholder="State" name="state" id="state" />
					
		</div><div class="form-group col-md-6">
					<label>Country</label>
					<input class="form-control " type="text" placeholder="Country" name="country" id="country" />
					
		</div>
				  		</div>
				  		
					</div></div>
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
				$("#hospitals").DataTable({
		            "processing": true,
		            "serverSide": true,
		            "ajax": "<?php echo site_url(); ?>/hospitals/getDThospitals"
		        });

				$(".dataTables_filter").attr("style","display: flex;float: right");
				$(".dataTables_filter").append("<a class=\"btn btn-success m-b-sm addbtn\" data-toggle=\"tooltip\" title=\"Add\"  href=\"javascript:void(0);\" data-title=\"Add\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Add New</a>");
				
			    $("[data-toggle=tooltip]").tooltip();

			    $(".addbtn").click(function(){
			    	$("#Edit-Heading").html("Add New Record");
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
			    	loadData(id);
			    	$("#form").attr("action","<?php echo site_url(); ?>/hospitals/update");
			    	$("#form input").attr("disabled",false);
			    	$("#Edit-Heading").html("Edit Your Data");
			    	$("#action-add-btn").parent().hide();
			    	$("#action-update-btn").parent().show();
			    });

			    function loadData(id){
			    	$.post("<?php echo site_url(); ?>/hospitals/gethospitals",{ id: id },function(data){
			    		var data = JSON.parse(data);
			    		
					$("#name").val(data.name);
					
					$("#address").val(data.address);
					
					$("#logo").val(data.logo);
					
					$("#phone_numbers").val(data.phone_numbers);
					
					$("#email").val(data.email);
					
					$("#city").val(data.city);
					
					$("#district").val(data.district);
					
					$("#state").val(data.state);
					
					$("#country").val(data.country);
					

			    		/*$.each(JSON.parse(data), function(key, value){
						    $("#"+key).val(value);
						});*/
			    	});
			    }

			    $("#hospitals").on("click",".viewbtn",function(){
			    	loadData($(this).attr("data-id"));
			    	$("#form input").attr("disabled",true);
			    	$("#form").attr("action","");
					$("#action-add-btn").parent().hide();
					$("#action-update-btn").parent().hide();
			    	$("#Edit-Heading").html("Detailed View");

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