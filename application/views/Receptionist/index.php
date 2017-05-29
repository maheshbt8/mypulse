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
	                <div class="panel panel-white">
	                    <div class="panel-heading clearfix">
	                        <h4 class="panel-title">Receptionist</h4>
	                    </div>
	                    <div class="panel-body">
	                       <div class="table-responsive">
	                            <table id="receptionist" class="display table" cellspacing="0" width="100%">
	                                <thead>
	                                    <tr><th>Receptionist</th><th>Doctor</th><th>Status</th><th width="20px">#</th>
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
				<form action="<?php echo site_url(); ?>/receptionist/update" method="post" id="form">
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
									<label>Doctor</label>
									<select name="doc_id" id="doc_id" class=" form-control" style="width: 100%">
									</select>
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
				$("#receptionist").DataTable({
		            "processing": true,
		            "serverSide": true,
		            "ajax": "<?php echo site_url(); ?>/receptionist/getDTreceptionist"
		        });

				$(".dataTables_filter").attr("style","display: flex;float: right");
				$(".dataTables_filter").append("<a class=\"btn btn-success m-b-sm addbtn\" data-toggle=\"tooltip\" title=\"Add\"  href=\"javascript:void(0);\" data-title=\"Add\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Add New</a>");
				
			    $("[data-toggle=tooltip]").tooltip();

			    $(".addbtn").click(function(){
			    	$("#Edit-Heading").html("Add New Receptionist");
			    	$("#action-update-btn").parent().hide();
			    	$("#action-add-btn").parent().show();
			    	$("#form")[0].reset();
			    	$("#passwordhint").hide();
			    	$("#form input").attr("disabled",false);
			    	$("#form").attr("action","<?php echo site_url(); ?>/receptionist/add");
			    	$("#edit").modal("show");
			    });

				$("#receptionist").on("click",".editbtn",function(){
			    	var id = $(this).attr("data-id");
			    	$("#eidt_gf_id").val(id);
			    	loadData(id);
			    	$("#passwordhint").show();
			    	$("#form").attr("action","<?php echo site_url(); ?>/receptionist/update");
			    	$("#form input").attr("disabled",false);
			    	$("#Edit-Heading").html("Edit Receptionist Details");
			    	$("#action-add-btn").parent().hide();
			    	$("#action-update-btn").parent().show();
			    });

			    function loadData(id){
			    	$.post("<?php echo site_url(); ?>/receptionist/getreceptionist",{ id: id },function(data){
			    		var data = JSON.parse(data);
			    		
						var tempselectize_doc_id = $selectize_doc_id[0].selectize;
						tempselectize_doc_id.addOption([{"id":data.doc_id,"text":data.doc_id}]);
						tempselectize_doc_id.refreshItems();
						tempselectize_doc_id.setValue(data.doc_id);
						$("#first_name").val(data.first_name);
						
						$("#last_name").val(data.last_name);
						
						$("#useremail").val(data.useremail);
						
						
						$("#address").val(data.address);
						
						$("#mobile").val(data.mobile);
						
						$("#phone").val(data.phone);

			    		
			    	});
			    }

			    $("#receptionist").on("click",".viewbtn",function(){
			    	loadData($(this).attr("data-id"));
			    	$("#form input").attr("disabled",true);
			    	$("#form").attr("action","");
					$("#action-add-btn").parent().hide();
					$("#action-update-btn").parent().hide();
			    	$("#Edit-Heading").html("Receptionist Details");

			    });


			    $("#receptionist").on("click",".delbtn",function(){
			    	$("#cur_del").val($(this).attr("data-id"));
			    });
			    
			    $("#del_yes").click(function(){
			    	var id = $("#cur_del").val();
			    	if(id!==""){
			    		$.post("<?php echo site_url(); ?>/receptionist/delete",{id:id},function(){
			    			$("#tr_"+$("#cur_del").val()).parent().parent().hide();
			    			$("#delete").modal("hide");	
			    		});
			    	}
			    	else{
			    		$("#delete").modal("hide");
			    	}
			    	$(".modal-backdrop").hide();
			    });

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
				    },
				    load: function(query, callback) {
				        //if (!query.length) return callback();
				        $.ajax({
				            url: "<?php echo site_url(); ?>/doctors/search",
				            type: "GET",
				            data: {"q":query,"f":"id"},
				            error: function() {
				                callback();
				            },
				            success: function(res) {
				                callback($.parseJSON(res));
				            }
				        });
				    }
				});

					

			});

		</script>