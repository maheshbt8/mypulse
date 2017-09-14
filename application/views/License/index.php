<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
$this->load->view("template/header.php");
$this->load->view("template/left.php");
?>
		<input type="hidden" id="left_active_menu" value="13" />
		<input type="hidden" id="left_active_sub_menu" value="1301" />
		<div id="main-wrapper">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="panel panel-white">
	                    
	                    <div class="panel-heading clearfix">
							<div class="">
								<div class="custome_col8">
									<h4 class="panel-title panel_heading_custome"><?php echo $this->lang->line('license');?></h4>
								</div>
								<div class="custome_col4">
									<div class="panel_button_top_right">
										<a class="btn btn-success m-b-sm addbtn" data-toggle="tooltip"   href="javascript:void(0);" data-toggle="modal" data-target="#edit" style=""><?php echo $this->lang->line('buttons')['addNew'];?></a>
										<a class="btn btn-danger m-b-sm multiDeleteBtn" data-at="license"  href="javascript:void(0);"  style="margin-left:10px"><?php echo $this->lang->line('buttons')['delete'];?></a>
										<?php $this->load->view('template/exbtn');?>
									</div>
								</div>
								<br>
							</div>
	                    </div>
	                    <div class="panel-body panel_body_custome">
	                       <div class="table-responsive">
	                            <table id="license" class="display table" cellspacing="0" width="100%">
	                                <thead>
	                                    <tr><th style="width:10px"></th><th><?php echo $this->lang->line('tableHeaders')['licenseCode'];?></th><th><?php echo $this->lang->line('tableHeaders')['name'];?></th><th width="20px">#</th>
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
				<form action="<?php echo site_url(); ?>/license/update" method="post" id="form">
				<input type="hidden" name="eidt_gf_id" id="eidt_gf_id">
				<div class="modal-content">
				  	<div class="modal-header">
					  	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					  	<h4 class="modal-title custom_align" id="Edit-Heading"></h4>
					</div>
				  	<div class="modal-body">
				  		<div class="row">
				  			<div class="col-md-12">
				  				<div class="form-group col-md-6">
									<label><?php echo $this->lang->line('labels')['licenseCode'];?></label>
									<input class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['licenseCode'];?>" name="license_code" id="license_code" />
								</div>
								<div class="form-group col-md-6">
									<label><?php echo $this->lang->line('labels')['name'];?></label>
									<input class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['name'];?>" name="name" id="name" />
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

				var validator = $("#form").validate({
					
			        rules: {
						license_code:{
							required : true
						},
			        	name: {
			        		required : true
			        	}
					},
			        messages: {
			        	name:{
			        		required: "<?php echo $this->lang->line('validation')['requiredLicenseName'];?>"
			        	},
						license_code:{
			        		required: "<?php echo $this->lang->line('validation')['requiredLicenseCode'];?>"
			        	}
					},
					invalidHandler: validationInvalidHandler,
					errorPlacement: validationErrorPlacement
				});

				var dt = $("#license").DataTable({
		            "processing": true,
		            "serverSide": true,
		            "ajax": "<?php echo site_url(); ?>/license/getDTlicense"
		        });
				<?php $this->load->view('template/exdt');?>

				$(".dataTables_filter").attr("style","display: flex;float: right");
				

			    $("[data-toggle=tooltip]").tooltip();

			    $(".addbtn").click(function(){
					resetForm(validator);
			    	$("#Edit-Heading").html("<?php echo $this->lang->line('headings')['addNewLicense'];?>");
			    	$("#action-update-btn").parent().hide();
			    	$("#action-add-btn").parent().show();
			    	$("#form")[0].reset();
			    	$("#form input").attr("disabled",false);
			    	$("#form").attr("action","<?php echo site_url(); ?>/license/add");
			    	$("#edit").modal("show");
			    });

				$("#license").on("click",".editbtn",function(){
					resetForm(validator);
			    	var id = $(this).attr("data-id");
			    	$("#eidt_gf_id").val(id);
			    	loadData(id);
			    	$("#form").attr("action","<?php echo site_url(); ?>/license/update");
			    	$("#form input").attr("disabled",false);
			    	$("#Edit-Heading").html("<?php echo $this->lang->line('headings')['editData'];?>");
			    	$("#action-add-btn").parent().hide();
			    	$("#action-update-btn").parent().show();
			    });

			    function loadData(id){
			    	$.post("<?php echo site_url(); ?>/license/getlicense",{ id: id },function(data){
			    		var data = JSON.parse(data);
			    		
						$("#license_code").val(data.license_code);
					
						$("#name").val(data.name);
					
			    	});
			    }

			    $("#license").on("click",".viewbtn",function(){
					resetForm(validator);
			    	loadData($(this).attr("data-id"));
			    	$("#form input").attr("disabled",true);
			    	$("#form").attr("action","");
					$("#action-add-btn").parent().hide();
					$("#action-update-btn").parent().hide();
			    	$("#Edit-Heading").html("<?php echo $this->lang->line('headings')['detailedView'];?>");

			    });


				$("#license").on("click",".delbtn",function(){
					var id = $(this).attr("data-id");
					swal(swalDeleteConfig).then(function () {
						$.post("<?php echo site_url(); ?>/license/delete",{id:id},function(data){
							delResFunc(data,id);
						});
					});
			    });
			    

			});

		</script>