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
	                <div class="card  ">
						<div class="card-head">
							<header><?php echo $this->lang->line('branches');?></header>
							<div class="custome_card_header">
								<a class="btn btn-success m-b-sm addbtn" data-toggle="tooltip"   href="javascript:void(0);" data-toggle="modal" data-target="#edit" style=""><?php echo $this->lang->line('buttons')['addNew'];?></a>
								<a class="btn btn-danger m-b-sm multiDeleteBtn" data-at="branches"  href="javascript:void(0);"  style="margin-left:10px"><?php echo $this->lang->line('buttons')['delete'];?></a>
								<?php $this->load->view('template/exbtn');?>
							</div>
						</div>
	                    <div class="card-body">
							<div class="col-md-12">
                                <div class="form-group col-md-6">
                                    <label><?php echo $this->lang->line('labels')['selectHospital'];?></label>
                                    <select id="hospital_id1" class=" form-control" style="width: 100%">
										<option value="all"><?php echo $this->lang->line('labels')['all'];?></option>
					                </select>
                                </div>
                            </div>
                            <div class="col-md-12">
								<table id="branches" class="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
									<thead>
										<tr><th style="width:10px"></th><th><?php echo $this->lang->line('tableHeaders')['branch'];?></th><th><?php echo $this->lang->line('tableHeaders')['phoneNumber'];?></th><th><?php echo $this->lang->line('tableHeaders')['city'];?></th><th width="20px">#</th>
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
				<input type="hidden" name="eidt_gf_id" id="eidt_gf_id" />
				<input type="hidden" name="selected_hid" id="selected_hid" />
				<div class="modal-content">
				  	<div class="modal-header">
					  	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					  	<h4 class="modal-title custom_align" id="Edit-Heading"></h4>
					</div>
				  	<div class="modal-body">
				  		<div class="row">
				  			<div class="col-md-12">
				  				<div class="form-group col-md-6">
									<label><?php echo $this->lang->line('labels')['selectHospital'];?></label>
									<select name="hospital_id" id="hospital_id" class=" form-control" style="width: 100%"></select>
								</div>
								<div class="form-group col-md-6">
									<label><?php echo $this->lang->line('labels')['branchName'];?></label>
									<input class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['branchName'];?>" name="branch_name" id="branch_name" />
								</div>
				  			</div>
				  			<div class="col-md-12">
				  				<div class="form-group col-md-6">
									<label><?php echo $this->lang->line('labels')['phoneNumber'];?></label>
									<input class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['phoneNumber'];?>" name="phone_number" id="phone_number" />
								</div>
								<div class="form-group col-md-6">
									<label><?php echo $this->lang->line('labels')['email'];?></label>
									<input class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['email'];?>" name="email" id="email" />
								</div>
				  			</div>
				  			<div class="col-md-12">
				  				<div class="form-group col-md-6">
									<label><?php echo $this->lang->line('labels')['address'];?></label>
									<input class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['address'];?>" name="address" id="address" />
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group col-md-3">
									<label><?php echo $this->lang->line('labels')['selectCountry'];?></label>
									<select name="country"  id="country" class=" form-control" style="width: 100%"></select>
								</div>
								<div class="form-group col-md-3">
									<label><?php echo $this->lang->line('labels')['selectState'];?></label>
									<select name="state"  id="state" class=" form-control" style="width: 100%"></select>
								</div>
								<div class="form-group col-md-3">
									<label><?php echo $this->lang->line('labels')['selectDistrict'];?></label>
									<select name="district"  id="district" class=" form-control" style="width: 100%"></select>
								</div>
								<div class="form-group col-md-3">
									<label><?php echo $this->lang->line('labels')['selectCity'];?></label>
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
		                        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal" style="width: 100%;"><span class="fa fa-remove" style="margin: 5px"></span><?php echo $this->lang->line('buttons')['cancel'];?></button>
		                    </div>

		                    <div class="form-group col-md-6">
		                        <button type="submit" class="btn btn-info btn-lg" id="action-update-btn" style="width: 100%;"><span style="margin: 5px" class="fa fa-check"></span><?php echo $this->lang->line('buttons')['update'];?></button>
		                    </div>
		                    
		                    <div class="form-group col-md-6" style="display:none">
		                        <button type="submit" class="btn btn-success btn-lg" id="action-add-btn" style="width: 100%;"><span style="margin: 5px" class="fa fa-plus"></span><?php echo $this->lang->line('buttons')['add'];?></button>
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
			        		required: "<?php echo $this->lang->line('validation')['selectHospital'];?>"
			        	},
			        	branch_name:{
			        		required: "<?php echo $this->lang->line('validation')['requiredBranch'];?>"
			        	},
						address:{
			        		required: "<?php echo $this->lang->line('validation')['requriedAddress'];?>"
			        	},
			        	email:{
			        		required: "<?php echo $this->lang->line('validation')['requiredEmail'];?>",
			        		email: "<?php echo $this->lang->line('validation')['invalidEmail'];?>"
			        	},
			        	phone_number:{
			        		required: "<?php echo $this->lang->line('validation')['requriedPhone'];?>",
							phoneUS: "<?php echo $this->lang->line('validation')['invalidPhone'];?>"
			        	},
			        	country:{
			        		required:"<?php echo $this->lang->line('validation')['selectCountry'];?>"
			        	},
			        	state:{
			        		required:"<?php echo $this->lang->line('validation')['selectState'];?>"
			        	},
			        	district:{
			        		required:"<?php echo $this->lang->line('validation')['selectDistrict'];?>"
			        	},
			        	city:{
			        		required:"<?php echo $this->lang->line('validation')['selectCity'];?>"
			        	}
			        },
					invalidHandler: validationInvalidHandler,
					errorPlacement: validationErrorPlacement
					
				});
				
			    $("[data-toggle=tooltip]").tooltip();

			    $(document).on('click','.addbtn', function(){
					resetForm(validator);
					resetLocation();
					$("#Edit-Heading").html("<?php echo $this->lang->line('headings')['addNewBranch'];?>");
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
					resetForm(validator);
					resetLocation();
			    	var id = $(this).attr("data-id");
			    	$("#eidt_gf_id").val(id);
			    	loadData(id);
			    	$("#form").attr("action","<?php echo site_url(); ?>/branches/update");
			    	$("#form input").attr("disabled",false);
			    	$("#Edit-Heading").html("<?php echo $this->lang->line('headings')['editData'];?>");
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
					resetForm(validator);
					resetLocation();
			    	loadData($(this).attr("data-id"));
			    	$("#form input").attr("disabled",true);
			    	$("#form").attr("action","");
					$("#action-add-btn").parent().hide();
					$("#action-update-btn").parent().hide();
			    	$("#Edit-Heading").html("<?php echo $this->lang->line('headings')['detailedView'];?>");

			    });


			    $("#branches").on("click",".delbtn",function(){
					var id = $(this).attr("data-id");
					swal(swalDeleteConfig).then(function () {
						$.post("<?php echo site_url(); ?>/branches/delete",{id:id},function(data){
							delResFunc(data,id);
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
                    var dt = $("#branches").DataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": "<?php echo site_url(); ?>/branches/getDTbranches?hid="+id
                    });

					<?php $this->load->view('template/exdt');?>

                    $(".dataTables_filter").attr("style","display: flex;float: right");
                    //$(".dataTables_filter").append("<a class=\"btn btn-success m-b-sm addbtn\" data-toggle=\"tooltip\" title=\"Add\"  href=\"javascript:void(0);\" data-title=\"Add\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Add New</a>");
					//$(".dataTables_filter").append("<a class=\"btn btn-danger m-b-sm multiDeleteBtn\" data-at=\"branches\" data-toggle=\"tooltip\" title=\"Delete\"  href=\"javascript:void(0);\" data-title=\"Delete\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Delete</a>");
				
                }
                loadTable('all');
			});

		</script>