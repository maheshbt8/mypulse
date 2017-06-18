<?php
/**
 * @author Ramesh Patel
 * @email  ramesh@techcrista.in
 */
$this->load->view("template/header.php");
$this->load->view("template/left.php");
?>
		<?php 
			if($this->auth->isSuperAdmin()){
				echo '<input type="hidden" id="left_active_menu" value="2" />
					  <input type="hidden" id="left_active_sub_menu" value="202" />';
			}else if($this->auth->isHospitalAdmin()){
				echo '<input type="hidden" id="left_active_menu" value="13" />';
			}
		?>
		<div id="main-wrapper">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="panel panel-white">
						
	                    <div class="panel-heading clearfix">
							<div class="">
								<div class="custome_col8">
									<h4 class="panel-title panel_heading_custome">Branches</h4>
								</div>
								<div class="custome_col4">
									<div class="panel_button_top_right">
										<a class="btn btn-success m-b-sm addbtn" data-toggle="tooltip" title="Add"  href="javascript:void(0);" data-title="Add" data-toggle="modal" data-target="#edit" style="">Add New</a>
										<a class="btn btn-danger m-b-sm multiDeleteBtn" data-at="hospitals" data-toggle="tooltip" title="Delete"  href="javascript:void(0);" data-title="Delete" data-toggle="modal" data-target="#edit" style="margin-left:10px">Delete</a>
									</div>
								</div>
								<br>
							</div>
	                    </div>
	                    <div class="panel-body panel_body_custome">
							<div class="col-md-12">
                                <div class="form-group col-md-6">
                                    <label>Select Hospital</label>
                                    <select id="hospital_id1" class=" form-control" style="width: 100%">
										<option value="all">ALL</option>
					                </select>
                                </div>
                            </div>
                            <div class="col-md-12">
								<div class="table-responsive">
										<table id="branches" class="display table" cellspacing="0" width="100%">
											<thead>
												<tr><th style="width:10px"></th><th>Branch Name</th><th>Phone Number</th><th>City</th><th width="20px">#</th>
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
	        </div>
	        <input type="hidden" id="cur_del">
	    </div><!-- Main Wrapper -->

	    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<form action="<?php echo site_url(); ?>/branches/update" method="post" id="form">
				<input type="hidden" name="eidt_gf_id" id="eidt_gf_id" />
				<input type="hidden" name="selected_hid" id="selected_hid" />
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
									<select name="hospital_id" id="hospital_id" class=" form-control" style="width: 100%"></select>
								</div>
								<div class="form-group col-md-6">
									<label>Branch Name</label>
									<input class="form-control " type="text" placeholder="Branch Name" name="branch_name" id="branch_name" />
								</div>
				  			</div>
				  			<div class="col-md-12">
				  				<div class="form-group col-md-6">
									<label>Phone Number</label>
									<input class="form-control " type="text" placeholder="Phone Number" name="phone_number" id="phone_number" />
								</div>
								<div class="form-group col-md-6">
									<label>Email</label>
									<input class="form-control " type="text" placeholder="Email" name="email" id="email" />
								</div>
				  			</div>
				  			<div class="col-md-12">
				  				<div class="form-group col-md-6">
									<label>Address</label>
									<input class="form-control " type="text" placeholder="Address" name="address" id="address" />
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
?><script type="text/javascript">
		
			$(document).ready(function(){

				<?php
					$this->load->view("template/location");
				?>
				
				var hid = null;
				<?php
					if(isset($_GET['hid'])){
						?>
						hid = '<?php echo $_GET["hid"];?>';
						<?php
					}
				?>

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
			        		required:true,
							phoneUS:true
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
			        		required: "Enter phone number",
							phoneUS: "Enter valid phone number"
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
				
			    $("[data-toggle=tooltip]").tooltip();

			    $(document).on('click','.addbtn', function(){
					resetLocation();
			    	$("#Edit-Heading").html("Add New Branch");
			    	$("#action-update-btn").parent().hide();
			    	$("#action-add-btn").parent().show();
			    	$("#form")[0].reset();
			    	$("#form input").attr("disabled",false);
			    	$("#form").attr("action","<?php echo site_url(); ?>/branches/add");
			    	$("#edit").modal("show");
					var thid = $("#hospital_id1").val();
					$("#selected_hid").val(thid);
					if(thid != "all"){
						var tempselectize_hospital_id = $selectize_hospital_id[0].selectize;
						tempselectize_hospital_id.addOption([{"id":thid,"text":thid}]);
						tempselectize_hospital_id.refreshItems();
						tempselectize_hospital_id.setValue(thid);
					}
			    });

				$("#branches").on("click",".editbtn",function(){
					resetLocation();
			    	var id = $(this).attr("data-id");
			    	$("#eidt_gf_id").val(id);
			    	loadData(id);
			    	$("#form").attr("action","<?php echo site_url(); ?>/branches/update");
			    	$("#form input").attr("disabled",false);
			    	$("#Edit-Heading").html("Edit Branch Details");
			    	$("#action-add-btn").parent().hide();
			    	$("#action-update-btn").parent().show();
					$("#selected_hid").val($("#hospital_id1").val());
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

			    $("#branches").on("click",".viewbtn",function(){
			    	loadData($(this).attr("data-id"));
			    	$("#form input").attr("disabled",true);
			    	$("#form").attr("action","");
					$("#action-add-btn").parent().hide();
					$("#action-update-btn").parent().hide();
			    	$("#Edit-Heading").html("Branch Details");

			    });


			    $("#branches").on("click",".delbtn",function(){
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
						
						$.post("<?php echo site_url(); ?>/branches/delete",{id:id},function(data){
							if(data==1){
								$("#dellink_"+id).parents('tr').remove();	
								toastr.success('selected item(s) deleted.');
							}else{
								toastr.error('Please try again.');
							}
						});
					});
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

				var $selectize_hospital_id1 = $("#hospital_id1").selectize({
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
								if(hid!=null){
									var tempselectize_hospital_id1 = $selectize_hospital_id1[0].selectize;
									tempselectize_hospital_id1.addOption([{"id":hid,"text":hid}]);
									tempselectize_hospital_id1.refreshItems();
									tempselectize_hospital_id1.setValue(hid);
								}
				            }
				        });
				    },
                    onChange: function(value) {
                        if (!value.length) return;
                        loadTable(value);                        
                    }
				});
            
                function loadTable(id){
                    if(id=="all"){
						id="";
					}
                    $("#branches").dataTable().fnDestroy();
                    $("#branches").DataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": "<?php echo site_url(); ?>/branches/getDTbranches?hid="+id
                    });

                    $(".dataTables_filter").attr("style","display: flex;float: right");
                    //$(".dataTables_filter").append("<a class=\"btn btn-success m-b-sm addbtn\" data-toggle=\"tooltip\" title=\"Add\"  href=\"javascript:void(0);\" data-title=\"Add\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Add New</a>");
					//$(".dataTables_filter").append("<a class=\"btn btn-danger m-b-sm multiDeleteBtn\" data-at=\"branches\" data-toggle=\"tooltip\" title=\"Delete\"  href=\"javascript:void(0);\" data-title=\"Delete\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Delete</a>");
				
                }
                loadTable('all');
			});

		</script>