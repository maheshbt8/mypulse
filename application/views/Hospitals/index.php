<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
$this->load->view("template/header.php");
$this->load->view("template/left.php");
?>
		<input type="hidden" id="left_active_menu" value="2" />
		<input type="hidden" id="left_active_sub_menu" value="201" />
		<div id="main-wrapper">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="card">
						<div class="card-head">
							<header><?php echo $this->lang->line('hospitals');?></header>
							<div class="custome_card_header">
								<a class="btn btn-success m-b-sm addbtn" data-toggle="tooltip"   href="javascript:void(0);" data-toggle="modal" data-target="#edit" style=""><?php echo $this->lang->line('buttons')['addNew'];?></a>
								<a class="btn btn-danger m-b-sm multiDeleteBtn" data-at="hospitals"  href="javascript:void(0);"  style="margin-left:10px"><?php echo $this->lang->line('buttons')['delete'];?></a>
								<?php $this->load->view('template/exbtn');?>
							</div>
						</div>
	                    <div class="card-body">
	                       
							<table id="hospitals" class="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
								<thead>
									<tr><th style="width:10px"></th><th><?php echo $this->lang->line('tableHeaders')['name'];?></th><th><?php echo $this->lang->line('tableHeaders')['licenseStatus'];?></th><th><?php echo $this->lang->line('tableHeaders')['city'];?></th><th  width="20px">#</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>  
	                       
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
					  	<h4 class="modal-title custom_align" id="Edit-Heading"></h4>
					</div>
				  	<div class="modal-body">
				  		<div class="row">

				  			 <div role="tabpanel" id="tabs">
                                <ul class="nav  nav-pills" role="tablist">
                                    <li role="presentation" class="addTab active"><a href="#tab1" aria-controls="home" role="tab" data-toggle="tab">General</a></li>
									<li role="presentation" class="addTab"><a href="#tab12" aria-controls="license" role="tab" data-toggle="tab">License</a></li>
                                    <li role="presentation" class="showTab"><a href="#tab2" aria-controls="branches" role="tab" data-toggle="tab" class="tab_tbl" data-tblid="tbl_branches" data-url="branches/getDTbranches/"><?php echo $this->lang->line('branches');?></a></li>
                                    <li role="presentation" class="showTab"><a href="#tab3" aria-controls="departments" role="tab" data-toggle="tab" class="tab_tbl" data-tblid="tbl_departments" data-url="departments/getDTdepartments/"><?php echo $this->lang->line('departments');?></a></li>
                                    <li role="presentation" class="showTab"><a href="#tab4" aria-controls="wards" role="tab" data-toggle="tab" class="tab_tbl" data-tblid="tbl_wards" data-url="wards/getDTwards/"><?php echo $this->lang->line('wards');?></a></li>
                                    <li role="presentation" class="showTab"><a href="#tab5" aria-controls="beds" role="tab" data-toggle="tab" class="tab_tbl" data-tblid="tbl_beds" data-url="beds/getDTbeds/"><?php echo $this->lang->line('beds');?></a></li>
                                    <li role="presentation" class="showTab"><a href="#tab6" aria-controls="doctors" role="tab" data-toggle="tab" class="tab_tbl" data-tblid="tbl_doctors" data-url="doctors/getDTdoctors/"><?php echo $this->lang->line('doctors');?></a></li>
                                    <li role="presentation" class="showTab"><a href="#tab7" aria-controls="nurses" role="tab" data-toggle="tab" class="tab_tbl" data-tblid="tbl_nurses" data-url="nurse/getDTnurse/"><?php echo $this->lang->line('nurses');?></a></li>
                                    <li role="presentation" class="showTab"><a href="#tab8" aria-controls="receptionis" role="tab" data-toggle="tab" class="tab_tbl" data-tblid="tbl_receptionist" data-url="receptionist/getDTreceptionist/"><?php echo $this->lang->line('receptionists');?></a></li>
                                    <li role="presentation" class="showTab"><a href="#tab9" aria-controls="med_stores" role="tab" data-toggle="tab" class="tab_tbl" data-tblid="tbl_medstore" data-url="medical_store/getDTmedical_store/"><?php echo $this->lang->line('medicalStore');?></a></li>
                                    <li role="presentation" class="showTab"><a href="#tab10" aria-controls="med_labs" role="tab" data-toggle="tab" class="tab_tbl" data-tblid="tbl_medlabs" data-url="medical_lab/getDTmedical_lab/"><?php echo $this->lang->line('medicalLab');?></a></li>
									<li role="presentation" class="showTab"><a href="#tab11" aria-controls="charges" role="tab" data-toggle="tab" class="tab_tbl" data-tblid="tbl_charges" data-url="charges/getDTcharges/"><?php echo $this->lang->line('charges');?></a></li>
                                </ul>
                                <div class="tab-content">
                                	<div role="tabpanel" class="tab-pane active fade in" id="tab1">
                            			<div class="col-md-12">
											<div class ="col-md-6">
												<div class="form-group ">
													<label><?php echo $this->lang->line('labels')['name'];?></label>
													<input class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['name'];?>" name="name" id="name" />
												</div>
												<div class="form-group">
													<label><?php echo $this->lang->line('labels')['address'];?></label>
													<input class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['address'];?>" name="address" id="address" />
												</div>
											</div>
											<div class="form-group col-md-6">
												<label><?php echo $this->lang->line('labels')['description'];?></label>
												<textarea class="form-control " rows="5" placeholder="<?php echo $this->lang->line('labels')['description'];?>" name="description" id="description" ></textarea>					
											</div>
							  			</div>
							  			<div class="col-md-12">
							  				<!-- <div class="form-group col-md-6">
													<label>Logo</label>
													<input class="form-control " type="text" placeholder="Logo" name="logo" id="logo" />					
												</div> -->
											<div class="form-group col-md-6">
												<label><?php echo $this->lang->line('labels')['email'];?></label>
												<input class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['email'];?>" name="email" id="email" />
											</div>	
											<div class="form-group col-md-6">
												<label><?php echo $this->lang->line('labels')['phoneNumber'];?></label>
												<input class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['phoneNumber'];?>" name="phone_numbers" id="phone_numbers" />
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
							  			
							  			
							  			<div class="col-md-12">
							  			<hr>
							  				<div class="form-group col-md-6">
												<label><?php echo $this->lang->line('labels')['ownerName'];?></label>
												<input class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['ownerName'];?>" name="md_name" id="md_name" />
											</div>
											<div class="form-group col-md-6">
												<label><?php echo $this->lang->line('labels')['ownerNumber'];?></label>
												<input class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['ownerNumber'];?>" name="md_contact_number" id="md_contact_number" />
											</div>
							  			</div>
							  			<div class="col-md-12">
							  				<div class="col-md-6 form-group">
							  					<label><?php echo $this->lang->line('labels')['selectHospitalAdmin'];?></label>
												<input class="form-control" type="text" placeholder="<?php echo $this->lang->line('labels')['selectHospitalAdmin'];?>" name="ha_name" id="ha_name" disabled/>
							  				</div>
							  				
							  			</div>            
                                    </div>
									<div role="tabpanel" class="tab-pane fade in" id="tab12">
										<div class="col-md-12">
							  				<div class="form-group col-md-6">
												<label><?php echo $this->lang->line('labels')['license'];?></label>
												<select class="form-control" name="license_category" id="license_category">					
													<?php 
														foreach ($license as $key => $value) {
															echo "<option value='$value[license_code]'>$value[name]</option>";
														}
													?>
												</select>
											</div>
											<div class="form-group col-md-6">
												<label><?php echo $this->lang->line('labels')['licenseStatus'];?></label>
												<select class="form-control" name="license_status" id="license_status">
													<option value="1"><?php echo $this->lang->line('labels')['active'];?></option>
													<option value="0"><?php echo $this->lang->line('labels')['inactive'];?></option>
												</select>
											</div>
											<div class="form-group col-md-6">
												<label><?php echo $this->lang->line('labels')['licenseValidity'];?></label>
												<div class="col-md-12">
													<div class="col-md-5">
														<input type="text" class="form-control date-picker" id="validity_start" value="<?php echo date('d-m-Y'); ?>" ></input>
													</div>
													<div class="col-md-2">
													to
													</div>
													<div class="col-md-5">
														<input type="text" class="form-control date-picker" id="validity_end" value="<?php echo date('d-m-Y', strtotime('+30 days')); ?>" ></input>
													</div>
												</div>
												
											</div>
							  			</div>
									</div>
                                    <div role="tabpanel" class="tab-pane fade in" id="tab2">
                                    	<table id="tbl_branches" class="display table table-bordered" cellspacing="0" width="100%">
			                                <thead>
			                                    <tr><th>#</th><th><?php echo $this->lang->line('tableHeaders')['branch'];?></th><th><?php echo $this->lang->line('tableHeaders')['phoneNumber'];?></th><th><?php echo $this->lang->line('tableHeaders')['city'];?></th></tr>
			                                </thead>
			                                <tbody>
			                                </tbody>
			                            </table> 
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade in" id="tab3">
                                    	<table id="tbl_departments" class="display table table-bordered" cellspacing="0" width="100%">
			                                <thead>
			                                    <tr><th>#</th><th><?php echo $this->lang->line('tableHeaders')['branch'];?></th><th><?php echo $this->lang->line('tableHeaders')['department'];?></th></tr>
			                                </thead>
			                                <tbody>
			                                </tbody>
			                            </table>  
                                    </div>
                                    <div role="tabpanel" class="tab-pane  fade in" id="tab4">
                                    	<table id="tbl_wards" class="display table table-bordered" cellspacing="0" width="100%">
			                                <thead>
			                                    <tr><th>#</th><th><?php echo $this->lang->line('tableHeaders')['department'];?></th><th><?php echo $this->lang->line('tableHeaders')['ward'];?></th><th><?php echo $this->lang->line('tableHeaders')['totalBeds'];?></th><th><?php echo $this->lang->line('tableHeaders')['availableBeds'];?></th> </tr>
			                                </thead>
			                                <tbody>
			                                </tbody>
			                            </table> 
                                    </div>
                                    <div role="tabpanel" class="tab-pane  fade in" id="tab5">
                                    	<table id="tbl_beds" class="display table table-bordered" cellspacing="0" width="100%">
			                                <thead>
			                                    <tr><th>#</th><th><?php echo $this->lang->line('tableHeaders')['ward'];?></th><th><?php echo $this->lang->line('tableHeaders')['bed'];?></th><th><?php echo $this->lang->line('tableHeaders')['isOccupied'];?></th></tr>
			                                </thead>
			                                <tbody>
			                                </tbody>
			                            </table> 
                                    </div>
                                    <div role="tabpanel" class="tab-pane  fade in" id="tab6">
                                    	<table id="tbl_doctors" class="display table table-bordered" cellspacing="0" width="100%">
			                                <thead>
			                                    <tr><th>#</th><th><?php echo $this->lang->line('tableHeaders')['name'];?></th><th><?php echo $this->lang->line('tableHeaders')['branch'];?></th><th><?php echo $this->lang->line('tableHeaders')['department'];?></th><th><?php echo $this->lang->line('tableHeaders')['status'];?></th></tr>
			                                </thead>
			                                <tbody>
			                                </tbody>
			                            </table> 
                                    </div>
                                    <div role="tabpanel" class="tab-pane  fade in" id="tab7">
                                    	<table id="tbl_nurses" class="display table table-bordered" cellspacing="0" width="100%">
			                                <thead>
												<tr><th>#</th><th><?php echo $this->lang->line('tableHeaders')['name'];?></th><th><?php echo $this->lang->line('tableHeaders')['branch'];?></th><th><?php echo $this->lang->line('tableHeaders')['department'];?></th><th><?php echo $this->lang->line('tableHeaders')['status'];?></th></tr>
			                                </thead>
			                                <tbody>
			                                </tbody>
			                            </table> 
                                    </div>
                                    <div role="tabpanel" class="tab-pane  fade in" id="tab8">
                                    	<table id="tbl_receptionist" class="display table table-bordered" cellspacing="0" width="100%">
			                                <thead>
												<tr><th>#</th><th><?php echo $this->lang->line('tableHeaders')['name'];?></th><th><?php echo $this->lang->line('tableHeaders')['branch'];?></th><th><?php echo $this->lang->line('tableHeaders')['department'];?></th><th><?php echo $this->lang->line('tableHeaders')['doctor'];?></th><th><?php echo $this->lang->line('tableHeaders')['status'];?></th></tr>
			                                </thead>
			                                <tbody>
			                                </tbody>
			                            </table> 
                                    </div>
                                    <div role="tabpanel" class="tab-pane  fade in" id="tab9">
                                    	<table id="tbl_medstore" class="display table table-bordered" cellspacing="0" width="100%">
			                                <thead>
			                                    <tr><th>#</th><th><?php echo $this->lang->line('tableHeaders')['name'];?></th><th><?php echo $this->lang->line('tableHeaders')['ownerName'];?></th><th><?php echo $this->lang->line('tableHeaders')['ownerNumber'];?></th><th><?php echo $this->lang->line('tableHeaders')['branch'];?></th></tr>
			                                </thead>
			                                <tbody>
			                                </tbody>
			                            </table> 
                                    </div>
                                    <div role="tabpanel" class="tab-pane  fade in" id="tab10">
                                    	<table id="tbl_medlabs" class="display table table-bordered" cellspacing="0" width="100%">
			                                <thead>
			                                    <tr><th>#</th><th><?php echo $this->lang->line('tableHeaders')['name'];?></th><th><?php echo $this->lang->line('tableHeaders')['ownerName'];?></th><th><?php echo $this->lang->line('tableHeaders')['ownerNumber'];?></th><th><?php echo $this->lang->line('tableHeaders')['branch'];?></th></tr>
			                                </thead>
			                                <tbody>
			                                </tbody>
			                            </table> 
                                    </div>
									<div role="tabpanel" class="tab-pane  fade in" id="tab11">
                                    	<table id="tbl_charges" class="display table table-bordered" cellspacing="0" width="100%">
			                                <thead>
			                                    <tr><th>#</th><th><?php echo $this->lang->line('tableHeaders')['title'];?></th><th><?php echo $this->lang->line('tableHeaders')['typeOfCharge'];?></th><th><?php echo $this->lang->line('tableHeaders')['description'];?></th><th><?php echo $this->lang->line('tableHeaders')['charge'];?></th></tr>
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
?>
	<script type="text/javascript">
		
			$(document).ready(function(){

				<?php
					$this->load->view("template/location");
				?>
				
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
				            "ajax": '<?php echo site_url();?>/'+url+"?s=1&hid="+$("#eidt_gf_id").val()
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
			        		required:true,
							phoneUS: true
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
			        		required: "<?php echo $this->lang->line('validation')['requiredHospitalName'];?>"
			        	},
			        	address:{
			        		required: "<?php echo $this->lang->line('validation')['requiredHospitalAddress'];?>"
			        	},
			        	email:{
			        		required: "<?php echo $this->lang->line('validation')['requiredEmail'];?>",
			        		email: "<?php echo $this->lang->line('validation')['invalidEmail'];?>"
			        	},
			        	phone_numbers:{
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

			
				jQuery.fn.DataTable.Api.register( 'buttons.exportData()', function ( options ) {
					if ( this.context.length ) {
						var jsonResult = $.ajax({
							url: "<?php echo site_url(); ?>/hospitals/getDThospitals?ex=1",
							success: function (result) {
								//Do nothing
							},
							async: false
						});
						var data = jQuery.parseJSON(jsonResult.responseText).data;
						console.log(data);
						return {body: data, header: $("#hospitals thead tr th").map(function() { return this.innerHTML; }).get()};
					}
				} );

				var dt = $("#hospitals").DataTable({
		            "processing": true,
		            "serverSide": true,
		            "ajax": "<?php echo site_url(); ?>/hospitals/getDThospitals"
		        });
				<?php $this->load->view('template/exdt');?>

				$(".dataTables_filter").attr("style","display: flex;float: right");
				//$(".dataTables_filter").append("");
				//$(".dataTables_filter").append("");
				
				
			    $("[data-toggle=tooltip]").tooltip();

			    $(".addbtn").click(function(){
					resetForm(validator);
					resetLocation();
					$(".showTab").hide();
					$(".addTabl").show();
			    	$("#Edit-Heading").html("<?php echo $this->lang->line('headings')['addNewHospital'];?>");
			    	$("#action-update-btn").parent().hide();
			    	$("#action-add-btn").parent().show();
			    	$("#form")[0].reset();
			    	$("#form input").attr("disabled",false);
			    	$("#form").attr("action","<?php echo site_url(); ?>/hospitals/add");
			    	$("#edit").modal("show");
					$('#tabs a[href="#tab1"]').click();
			    });

				$("#hospitals").on("click",".editbtn",function(){
					resetForm(validator);
					resetLocation();
			    	var id = $(this).attr("data-id");
			    	$("#eidt_gf_id").val(id);
			    	loadData(id,true);
			    	$("#form").attr("action","<?php echo site_url(); ?>/hospitals/update");
			    	$("#form input").attr("disabled",false);
			    	$("#Edit-Heading").html("<?php echo $this->lang->line('headings')['editData'];?>");
			    	$("#action-add-btn").parent().hide();
			    	$("#action-update-btn").parent().show();
					$('#tabs a[href="#tab1"]').click();
					$("#ha_name").attr("disabled",true);
			    });

			    function loadData(id,isEdit){
					$(".showTab").show();
					$(".addTabl").show();
					$("#ha_name").val("");
			    	$.post("<?php echo site_url(); ?>/hospitals/gethospitals",{ id: id },function(data){
						
			    		var data = JSON.parse(data);
						console.log(data);
						$("#name").val(data.name);
						$("#Edit-Heading").html(data.name+" <?php echo $this->lang->line('headings')['info'];?>");
						$("#address").val(data.address);
						$("#logo").val(data.logo);
						$("#phone_numbers").val(data.phone_numbers);
						$("#email").val(data.email);
						$("#license_status").val(data.license_status);
						if(data.hospital_admin != null && data.hospital_admin != undefined){
							$("#ha_name").val(data.hospital_admin.fname+" "+data.hospital_admin.lname);
						}
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

			    $("#hospitals").on("click",".viewbtn",function(){
					resetForm(validator);
					resetLocation();
			    	$("#form input").attr("disabled",true);
			    	$("#form").attr("action","");
					$("#action-add-btn").parent().hide();
					$("#action-update-btn").parent().hide();
			    	$("#Edit-Heading").html("<?php echo $this->lang->line('headings')['detailedView'];?>");
			    	loadData($(this).attr("data-id"),false);
					$('#tabs a[href="#tab1"]').click();

			    });


			    $("#hospitals").on("click",".delbtn",function(){
					var id = $(this).attr("data-id");
					swal(swalDeleteConfig).then(function () {
						$.post("<?php echo site_url(); ?>/hospitals/delete",{id:id},function(data){
							delResFunc(data,id);
						});
					});
			    });
			

			});

		</script>