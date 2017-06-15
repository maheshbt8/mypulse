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
					  <input type="hidden" id="left_active_sub_menu" value="204" />';
			}else if($this->auth->isHospitalAdmin()){
				echo '<input type="hidden" id="left_active_menu" value="14" />';
			}
		?>
		<div id="main-wrapper">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="panel panel-white">
	                    <div class="panel-heading clearfix">
	                        <h4 class="panel-title">Beds</h4>
	                    </div>
	                    <div class="panel-body">
							<div class="col-md-12">
                                <div class="form-group col-md-6">
                                    <label>Select Hospital</label>
                                    <select id="hospital_id1" class=" form-control" style="width: 100%">
										<option value="all">ALL</option>
					                </select>
                                </div>
								<div class="form-group col-md-6">
                                    <label>Select Branch</label>
                                    <select id="branch_id1" class=" form-control" style="width: 100%">
					                </select>
                                </div>
								<div class="form-group col-md-6">
                                    <label>Select Departmenet</label>
                                    <select id="department_id1" class=" form-control" style="width: 100%">
					                </select>
                                </div>
                            </div>
                            <div class="col-md-12">
								<div class="table-responsive">
									<table id="beds" class="display table" cellspacing="0" width="100%">
										<thead>
											<tr><th style="width:10px"></th><th>Ward</th><th>Bed</th><th width="20px">#</th>
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
				<form action="<?php echo site_url(); ?>/beds/update" method="post" id="form">
				<input type="hidden" name="eidt_gf_id" id="eidt_gf_id">
				<input type="hidden" name="selected_hid" id="selected_hid" />
				<input type="hidden" name="selected_bid" id="selected_bid" />
				<input type="hidden" name="selected_did" id="selected_did" />
				<div class="modal-content">
				  	<div class="modal-header">
					  	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					  	<h4 class="modal-title custom_align" id="Edit-Heading">Edit Your Detail</h4>
					</div>
				  	<div class="modal-body">
				  		<div class="row">
				  			<div class="col-md-12">
				  			<div class="form-group col-md-6">
					<label>Ward</label>
					<select name="ward_id" id="ward_id" class=" form-control" style="width: 100%">
					</select>
					
		</div><div class="form-group col-md-6">
					<label>Bed</label>
					<input class="form-control " type="text" placeholder="Bed" name="bed" id="bed" />
					
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
		</div>
	    <?php
$this->load->view("template/footer.php");
?><script type="text/javascript">
		
			$(document).ready(function(){

				var hid = null;
				<?php
					if(isset($_GET['hid'])){
						?>
						hid = '<?php echo $_GET["hid"];?>';
						<?php
					}
				?>

				var bid = null;
				<?php
					if(isset($_GET['bid'])){
						?>
						bid = '<?php echo $_GET["bid"];?>';
						<?php
					}
				?>

				var did = null;
				<?php
					if(isset($_GET['did'])){
						?>
						did = '<?php echo $_GET["did"];?>';
						<?php
					}
				?>

				var validator = $("#form").validate({
					ignore: [],
			        rules: {
			        	
			        	ward_id: {
			        		required : true
			        	},
			        	bed: {
			        		required: true
			        	}
			        },
			        messages: {
			        	
			        	ward_id:{
			        		required: "Select ward"
			        	},
			        	bed:{
			        		required: "Enter bed number"
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
			    	$("#Edit-Heading").html("Add New Bed");
			    	$("#action-update-btn").parent().hide();
			    	$("#action-add-btn").parent().show();
			    	$("#form")[0].reset();
			    	$("#form input").attr("disabled",false);
			    	$("#form").attr("action","<?php echo site_url(); ?>/beds/add");
			    	$("#edit").modal("show");
					var thid = $("#hospital_id1").val();
					var tbid = $("#branch_id1").val();
					var tdid = $("#department_id1").val();
					$("#selected_hid").val(thid);
					$("#selected_bid").val(tbid);
					$("#selected_did").val(tdid);
					
			    });

				$("#beds").on("click",".editbtn",function(){
			    	var id = $(this).attr("data-id");
			    	$("#eidt_gf_id").val(id);
			    	loadData(id);
			    	$("#form").attr("action","<?php echo site_url(); ?>/beds/update");
			    	$("#form input").attr("disabled",false);
			    	$("#Edit-Heading").html("Edit Bed Detail");
			    	$("#action-add-btn").parent().hide();
			    	$("#action-update-btn").parent().show();
					$("#selected_hid").val($("#hospital_id1").val());
					$("#selected_bid").val($("#branch_id1").val());
					$("#selected_did").val($("#department_id1").val());
			    });

			    function loadData(id){
			    	$.post("<?php echo site_url(); ?>/beds/getbeds",{ id: id },function(data){
			    		var data = JSON.parse(data);
			    		
						var tempselectize_ward_id = $selectize_ward_id[0].selectize;
						tempselectize_ward_id.addOption([{"id":data.ward_id,"text":data.ward_id}]);
						tempselectize_ward_id.refreshItems();
						tempselectize_ward_id.setValue(data.ward_id);
						
						$("#bed").val(data.bed);
						

			    		/*$.each(JSON.parse(data), function(key, value){
						    $("#"+key).val(value);
						});*/
			    	});
			    }

			    $("#beds").on("click",".viewbtn",function(){
			    	loadData($(this).attr("data-id"));
			    	$("#form input").attr("disabled",true);
			    	$("#form").attr("action","");
					$("#action-add-btn").parent().hide();
					$("#action-update-btn").parent().hide();
			    	$("#Edit-Heading").html("Bed Detail");

			    });


			    $("#beds").on("click",".delbtn",function(){
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
						
						$.post("<?php echo site_url(); ?>/beds/delete",{id:id},function(data){
							if(data==1){
								$("#dellink_"+id).parents('tr').remove();	
								toastr.success('selected item(s) deleted.');
							}else{
								toastr.error('Please try again.');
							}
						});
					});
			    });
			 

				var $selectize_ward_id = $("#ward_id").selectize({
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
						if($("#department_id1").val() == null || $("#department_id1").val()=="")
							return;
				        $.ajax({
				            url: "<?php echo site_url(); ?>/wards/search",
				            type: "GET",
				            data: {"q":query,"f":"ward_name","department_id":$("#department_id1").val()},
				            error: function() {
				                callback();
				            },
				            success: function(res) {
				                callback($.parseJSON(res));
				            }
				        });
				    }
				});

				var xhr;

				var $selectize_department_id1 = $("#department_id1").selectize({
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
					onChange: function(value) {
				        if (!value.length) return;
						loadTable($("#hospital_id1").val(),$("#branch_id1").val(),value);
					}
				});

				var $selectize_branch_id1 = $("#branch_id1").selectize({
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
					onChange: function(value) {
				        if (!value.length) return;
						if($("#hospital_id1").val() != "all" && $("#hospital_id1").val() != "-1"){
							$selectize_department_id1[0].selectize.disable();
							$selectize_department_id1[0].selectize.clearOptions();
							$selectize_department_id1[0].selectize.load(function(callback) {
								xhr && xhr.abort();
								xhr = $.ajax({
									url: "<?php echo site_url(); ?>/departments/search/",
									type: "GET",
									data: { "branch_id":value,"f":"department_name","hospital_id":$("#hospital_id1").val()},
									success: function(results) {
										$selectize_department_id1[0].selectize.enable();
										var res = $.parseJSON(results);
										res.push({id:"all",text:"ALL"});
										callback(res);
										if(bid==null || bid == undefined){
											did ="all";
										}
										if(did != null){
											var tempselectize_department_id1 = $selectize_department_id1[0].selectize;
											tempselectize_department_id1.addOption([{"id":did,"text":did}]);
											tempselectize_department_id1.refreshItems();
											tempselectize_department_id1.setValue(did);	
											did = null;
										}
									},
									error: function() {
										callback();
									}
								})
							});
						}
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
						
						loadTable(value,"");

				        $selectize_branch_id1[0].selectize.disable();
				        $selectize_branch_id1[0].selectize.clearOptions();
				        $selectize_branch_id1[0].selectize.load(function(callback) {
				            xhr && xhr.abort();
				            xhr = $.ajax({
				                url: "<?php echo site_url(); ?>/branches/search/",
				                type: "GET",
				                data: { "hospital_id":value,"f":"branch_name"},
				                success: function(results) {
				                    $selectize_branch_id1[0].selectize.enable();
									var res = $.parseJSON(results);
									res.push({id:"all",text:"ALL"});
				                    callback(res);
									if(bid==null || bid == undefined){
										bid ="all";
									}
				                    if(bid != null){
				    					var tempselectize_branch_id1 = $selectize_branch_id1[0].selectize;
										tempselectize_branch_id1.addOption([{"id":bid,"text":bid}]);
										tempselectize_branch_id1.refreshItems();
										tempselectize_branch_id1.setValue(bid);	
										bid = null;
				    				}
				                },
				                error: function() {
				                    callback();
				                }
				            })
				        });
				    }
				});
            
                function loadTable(hid,bid,did){
										
                    $("#beds").dataTable().fnDestroy();
                    $("#beds").DataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": "<?php echo site_url(); ?>/beds/getDTbeds?hid="+hid+"&bid="+bid+"&did="+did
                    });

                    $(".dataTables_filter").attr("style","display: flex;float: right");
                    $(".dataTables_filter").append("<a class=\"btn btn-success m-b-sm addbtn\" data-toggle=\"tooltip\" title=\"Add\"  href=\"javascript:void(0);\" data-title=\"Add\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Add New</a>");
					$(".dataTables_filter").append("<a class=\"btn btn-danger m-b-sm multiDeleteBtn\" data-at=\"beds\" data-toggle=\"tooltip\" title=\"Delete\"  href=\"javascript:void(0);\" data-title=\"Delete\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Delete</a>");
                }

                loadTable("all","", "");	

			});

		</script>