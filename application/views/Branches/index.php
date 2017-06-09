<?php
/**
 * @author Ramesh Patel
 * @email  ramesh@techcrista.in
 */
$this->load->view("template/header.php");
$this->load->view("template/left.php");
?>
			<input type="hidden" id="left_active_menu" value="13" />
		<div id="main-wrapper">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="panel panel-white">
	                    <div class="panel-heading clearfix">
	                        <h4 class="panel-title">Branches</h4>
	                    </div>
	                    <div class="panel-body">
	                       <div class="table-responsive">
	                            <table id="branches" class="display table" cellspacing="0" width="100%">
	                                <thead>
	                                    <tr><th>Hospital </th><th>Branch Name</th><th>Phone Number</th><th>City</th><th width="20px">#</th>
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
				<form action="<?php echo site_url(); ?>/branches/update" method="post" id="form">
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
					<label>Hospital</label>
					<select name="hospital_id" id="hospital_id" class=" form-control" style="width: 100%">
					</select>
					
		</div><div class="form-group col-md-6">
					<label>Branch Name</label>
					<input class="form-control " type="text" placeholder="Branch Name" name="branch_name" id="branch_name" />
					
		</div>
				  					</div>
				  					<div class="col-md-12">
				  				<div class="form-group col-md-6">
					<label>Phone Number</label>
					<input class="form-control " type="text" placeholder="Phone Number" name="phone_number" id="phone_number" />
					
		</div><div class="form-group col-md-6">
					<label>Email</label>
					<input class="form-control " type="text" placeholder="Email" name="email" id="email" />
					
		</div>
				  					</div>
				  					<div class="col-md-12">
				  				<div class="form-group col-md-6">
					<label>Address</label>
					<input class="form-control " type="text" placeholder="Address" name="address" id="address" />
					
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

				var validator = $("#form").validate({
					ignore: [],
			        rules: {
			        	
			        	hospital_id: {
			        		required : true
			        	},
			        	branch_name: {
			        		required: true
			        	},
						address: {
			        		required: true
			        	},
			        	email:{
			        		required:true,
			        		email:true
			        	},
			        	phone_number:{
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
			        	
			        	hospital_id:{
			        		required: "Select Hospital"
			        	},
			        	branch_name:{
			        		required: "Enter branch name"
			        	},
						address:{
			        		required: "Enter hospital address"
			        	},
			        	email:{
			        		required: "Enter email address",
			        		email: "Enter valid email address"
			        	},
			        	phone_number:{
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

				$("#branches").DataTable({
		            "processing": true,
		            "serverSide": true,
		            "ajax": "<?php echo site_url(); ?>/branches/getDTbranches"
		        });

				$(".dataTables_filter").attr("style","display: flex;float: right");
				$(".dataTables_filter").append("<a class=\"btn btn-success m-b-sm addbtn\" data-toggle=\"tooltip\" title=\"Add\"  href=\"javascript:void(0);\" data-title=\"Add\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Add New</a>");
				
			    $("[data-toggle=tooltip]").tooltip();

			    $(".addbtn").click(function(){
			    	$("#Edit-Heading").html("Add New Branch");
			    	$("#action-update-btn").parent().hide();
			    	$("#action-add-btn").parent().show();
			    	$("#form")[0].reset();
			    	$("#form input").attr("disabled",false);
			    	$("#form").attr("action","<?php echo site_url(); ?>/branches/add");
			    	$("#edit").modal("show");
			    });

				$("#branches").on("click",".editbtn",function(){
			    	var id = $(this).attr("data-id");
			    	$("#eidt_gf_id").val(id);
			    	loadData(id);
			    	$("#form").attr("action","<?php echo site_url(); ?>/branches/update");
			    	$("#form input").attr("disabled",false);
			    	$("#Edit-Heading").html("Edit Branch Details");
			    	$("#action-add-btn").parent().hide();
			    	$("#action-update-btn").parent().show();
			    });

			    function loadData(id){
			    	$.post("<?php echo site_url(); ?>/branches/getbranches",{ id: id },function(data){
			    		var data = JSON.parse(data);
			    		
						var tempselectize_hospital_id = $selectize_hospital_id[0].selectize;
						tempselectize_hospital_id.addOption([{"id":data.hospital_id,"text":data.hospital_id}]);
						tempselectize_hospital_id.refreshItems();
						tempselectize_hospital_id.setValue(data.hospital_id);
						
						$("#branch_name").val(data.branch_name);
						
						$("#phone_number").val(data.phone_number);
						
						$("#email").val(data.email);
						
						$("#address").val(data.address);
						
						$("#city").val(data.city);
						
						$("#district").val(data.district);
						
						$("#state").val(data.state);
						
						$("#country").val(data.country);
						
			    	});
			    }

			    $("#branches").on("click",".viewbtn",function(){
			    	loadData($(this).attr("data-id"));
			    	$("#form input").attr("disabled",true);
			    	$("#form").attr("action","");
					$("#action-add-btn").parent().hide();
					$("#action-update-btn").parent().hide();
			    	$("#Edit-Heading").html("Branch Details");

			    });


			    $("#branches").on("click",".delbtn",function(){
			    	$("#cur_del").val($(this).attr("data-id"));
			    });
			    
			    $("#del_yes").click(function(){
			    	var id = $("#cur_del").val();
			    	if(id!==""){
			    		$.post("<?php echo site_url(); ?>/branches/delete",{id:id},function(){
			    			$("#dellink_"+$("#cur_del").val()).parents('tr').remove();
			    			$("#delete").modal("hide");	
			    		});
			    	}
			    	else{
			    		$("#delete").modal("hide");
			    	}
			    	$(".modal-backdrop").hide();
			    });

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
				    }
				});

					

			});

		</script>