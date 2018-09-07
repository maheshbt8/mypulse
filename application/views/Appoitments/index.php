<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
$this->load->view("template/header.php");
$this->load->view("template/left.php");
?>
	<?php
		if($this->auth->isPatient()){
			echo '<input type="hidden" id="left_active_menu" value="52" />';
		}
	?>
		<div id="main-wrapper">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="card  ">
	                    
	                    <div class="card-head">
							<header><?php echo $this->lang->line('appoitments');?></header>
							<div class="custome_card_header">
								<a class="btn btn-success m-b-sm addbtn" data-toggle="tooltip"   href="javascript:void(0);" data-toggle="modal" data-target="#edit" style=""><?php echo $this->lang->line('buttons')['bookAppoitment'];?></a>
								<a class="btn btn-danger m-b-sm multiCancelBtn" data-msg="<?=$this->lang->line('msg_want_to_cancel_appts');?>" data-at="appoitments"  href="javascript:void(0);"  style="margin-left:10px"><?php echo $this->lang->line('buttons')['cancel'];?></a>
								<?php $this->load->view('template/exbtn');?>
							</div>
	                    </div>
	                    <div class="card-body ">
							<div class="col-md-12">
                                <div class="form-group col-md-3">
                                    <label><?php echo $this->lang->line('labels')['select_date'];?></label>
                                    <input id="sel_date" class=" form-control" /> 
								</div>
							</div>	
							<table id="appoitments" class="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
								<thead>
									<tr>
									<th style="width:10px"></th>
									<!--<th><?php echo $this->lang->line('tableHeaders')['appoitment_no'];?></th>-->
									<th>No.</th>
									<th><?php echo $this->lang->line('tableHeaders')['hospital_branch'];?></th>
									<th><?php echo $this->lang->line('tableHeaders')['department'];?></th>
									<th><?php echo $this->lang->line('tableHeaders')['doctor'];?></th>
									<th><?php echo $this->lang->line('tableHeaders')['appoitment_date'];?></th>
									<th><?php echo $this->lang->line('tableHeaders')['appoitment_sloat'];?></th>
									<th><?php echo $this->lang->line('tableHeaders')['status']; ?></th>
									<th width="20px">#</th>
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
				<form action="<?php echo site_url(); ?>/appoitments/update" method="post" id="form" autocomplete="off">
				<input type="hidden" name="eidt_gf_id" id="eidt_gf_id">
				
				<div class="modal-content">
				  	<div class="modal-header">
					  	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					  	<h4 class="modal-title custom_align" id="Edit-Heading"></h4><h4 class="apptidentifier" style="position:absolute;top:9px;left:195px;"></h4>
					</div>
				  	<div class="modal-body">
				  		<div class="row">
                        	<div class="col-md-12">
                            	<div class="form-group col-md-6">
									<label><?php echo $this->lang->line('validation')['selectDoctor'];?></label>
									<input type="text" placeholder="<?php echo $this->lang->line('SearchForUsers');?>" name="" class="DoctorName form-control allowalphanumeric" value=""  />                             <input type="hidden" name="doctor_id" id="DoctorID" class="DoctorID" value=""  />
                                    <div id="suggesstion-box"></div>
								</div>
                            </div>
				  			<div class="col-md-12 hide">
								<!--<div class="form-group col-md-6">
									<label>User</label>
									<select name="user_id" id="user_id" class=" form-control" style="width: 100%">
									</select>
								</div>-->
								<div class="form-group col-md-6">
                                    <label><?php echo $this->lang->line('labels')['selectHospital'];?></label>
                                    <select id="hospital_id" class=" form-control allowalphanumeric" >
									<option value="">Please Select</option>
					                </select>
                                </div>
								<div class="form-group col-md-6">
                                    <label><?php echo $this->lang->line('labels')['selectBranch'];?></label>
                                    <select id="branch_id" class=" form-control allowalphanumeric" >
									<option value="">Please Select</option>
					                </select>
                                </div>
							</div>
							<div class="col-md-12 hide">
								<div class="form-group col-md-6">
                                    <label><?php echo $this->lang->line('labels')['selectDepartment'];?></label>
                                    <select id="department_id" name="department_id" class=" form-control allowalphanumeric">
									<option value="">Please Select</option>
					                </select>
                                </div>
								<div class="form-group col-md-6">
									<label><?php echo $this->lang->line('labels')['selectDoctor'];?></label>
									<select name="doctor_id" id="doctor_id" class=" form-control allowalphanumeric" >
									<option value="">Please Select</option>
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group col-md-12">
									<label><?php echo $this->lang->line('labels')['doctorAvailability'];?></label>
									<br>
									<span id="docAvailability"></span>
								</div>
							</div>
							<div class="col-md-12">	
								<div class="form-group col-md-6">
									<label><?php echo $this->lang->line('labels')['appoitment_date'];?></label>
									<input class="form-control date-picker-nopast allowalphanumeric" type="text" placeholder="<?php echo $this->lang->line('labels')['appoitment_date'];?>" name="appoitment_date" id="appoitment_date" />
								</div>
								<div class="form-group col-md-6">
									<label><?php echo $this->lang->line('labels')['appoitment_sloat'];?></label>
									<select class="form-control allowalphanumeric" type="text" name="appoitment_sloat" id="appoitment_sloat">
									<option value="">Please Select</option>
									</select>
									<span id="noApptTimeSloat" style='color:#BC4442;display:none'><?php echo $this->lang->line('labels')['noApptTimeSloat'];?></span>
								</div>
							</div>
							
							<div class="col-md-12">
								<div class="form-group col-md-6">
									<label><?php echo $this->lang->line('labels')['appoitment_reason'];?></label>
									<textarea class="form-control allowalphanumeric " type="text" placeholder="<?php echo $this->lang->line('labels')['appoitment_reason'];?>" name="reason" id="reason" rows="3"></textarea>
								</div>
								<div class="form-group col-md-6">
									<label><?php echo $this->lang->line('labels')['remark'];?></label>
									<textarea  class="form-control allowalphanumeric " type="text" placeholder="<?php echo $this->lang->line('labels')['patientRemarkPlace'];?>" name="remarks" id="remarks" rows="3" readonly="readonly"></textarea><br />
									<a href="javascript:void(0);" class="viewappthistory" data-toggle="modal" data-target="#appthistory"><?php echo $this->lang->line('labels')['ViewAppointmentHisoty'];?></a>
								</div>
							</div>				  		
						</div>
					</div>
				  	<div>
				  		<hr>
				  		<div class="row">
					  		<div class="form-group col-md-6">
		                         <button type="button" class="btn btn-default btn-lg" data-dismiss="modal" style="width: 100%;"><span class="fa fa-remove" style="margin: 5px"></span><?php echo $this->lang->line('buttons')['cancel'];?></button>
		                    </div>

		                    <div class="form-group col-md-6">
		                        <button type="button" class="btn btn-info btn-lg appt_submit"  id="action-update-btn" style="width: 100%;"><span style="margin: 5px" class="fa fa-check"></span><?php echo $this->lang->line('buttons')['update'];?></button>
		                    </div>
		                    
		                    <div class="form-group col-md-6" style="display:none">
		                        <button type="button" class="btn btn-success btn-lg appt_submit" id="action-add-btn" style="width: 100%;"><span style="margin: 5px" class="fa fa-plus"></span><?php echo $this->lang->line('buttons')['bookAppoitment'];?></button>
		                    </div>
		                </div>
					</div>
				</div>
				</form>
			<!-- /.modal-content --> 
			</div>
		<!-- /.modal-dialog --> 
		</div>
		
		<!--Recommed Next Appointment List -->
        
        <?php /*?><div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-head">
                        <header><?php echo $this->lang->line('recommend_appointment');?></header>
                        <div class="custome_card_header">
                            
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="  project-stats">  
                           <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Hospital-Branch</th>
										<th>Department</th>
										<th>Doctor</th>
                                        <th>Recommed Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php if(count($states['recommend_appointment']) > 0) { ?>
                                    <?php
                                        $cnt = 1;
                                        foreach($states['recommend_appointment'] as $ra){
                                            ?>
                                            <tr>
                                                <th scope="row"><?=$cnt;?></th>
                                                <td><?=$ra['hbname'];?></td>
												<td><?=$ra['dpname'];?></td>
												<td><?=$ra['dname'];?></td>
                                                <td><?=date('d-M-Y',strtotime($ra['recommend_appointment_date']));?></td>
												<td><!--<button class="btn btn-info bookAppointment"  data-id="<?php echo $ra['id'];?>" data-toggle="modal" data-target="#edit">Book Appointment</button>--></td>
												<!--<a class="btn btn-success m-b-sm addbtn" data-toggle="tooltip"   href="javascript:void(0);" data-toggle="modal" data-target="#edit" style=""><?php echo $this->lang->line('buttons')['bookAppoitment'];?></a>-->
                                                <!--<td><a href='#' data-url='doctors/previewprescription/<?=$mr['id'];?>' data-id='<?=$mr['id'];?>' class='previewtem'><i class="fa fa-file"></i></a></td>-->
                                            </tr>
                                            <?php
                                            $cnt++;
                                        }
                                    ?>
									<?php }else{ ?>
                                   <tr><th></th><td>No data available in table</td></tr>
								   <?php } ?>
                                   
                               </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><?php */?>
        

<div class="modal fade appointthistory" tabindex="-1" role="dialog" aria-labelledby="appointthistory" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				
			<!-- /.modal-content --> 
			</div>
		<!-- /.modal-dialog --> 
		</div>
<div id="appthistory" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo $this->lang->line('labels')['AppointmentHisoty'];?></h4>
      </div>
      <div class="modal-body">
        
      		 <div id="load"></div>
        
      </div>
      
    </div>

  </div>
</div>
		
<?php
$this->load->view("template/footer.php");
?>
<script type="text/javascript">
		
	$(document).ready(function(){

		var _sd = "";
		var _ed = "";
		
		var hid = null;
		var cur_v = null;
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

		var t_bid = null;
		var t_did = null;
		var t_oid = null;

		var validator = $("#form").validate({
			ignore: [],
			rules: {
				hospital_id:{
					required: true
				},
				department_id:{
					required: true
				},
				doctor_id:{
					required: true
				},
				appoitment_date:{
					required: true
				},
				reason:{
					required: true
				},
				branch_id: {
					required : true
				},
				appoitment_sloat:{
					required: true
				}
			},
			messages: {
				doctor_id:{
					required:  "<?php echo $this->lang->line('validation')['selectDoctor'];?>"
				},
				appoitment_date:{
					required:  "<?php echo $this->lang->line('validation')['requiredAppoitmentDate'];?>"
				},
				reason:{
					required:  "<?php echo $this->lang->line('validation')['requiredReason'];?>"
				},
				branch_id:{
					required: "<?php echo $this->lang->line('validation')['selectBranch'];?>"
				},
				hospital_id:{
					required: "<?php echo $this->lang->line('validation')['selectHospital'];?>"
				},
				department_id:{
					required: "<?php echo $this->lang->line('validation')['selectDepartment'];?>"
				},
				appoitment_sloat: {
					required: "<?php echo $this->lang->line('validation')['requiredAppoitmentSloat']; ?>"
				}
				
			},
			invalidHandler: validationInvalidHandler,
			errorPlacement: validationErrorPlacement
			
		});


		$(".appt_submit").click(function(){
			var appst = $("#appoitment_sloat").val();
			if(validator.form() && appst != null && appst != undefined) {
				$("#form").submit();
			}
		});


		$("[data-toggle=tooltip]").tooltip();

		$(".addbtn").click(function(){
			resetForm(validator);
			$(".DoctorName").attr('readonly', false);
			$("#suggesstion-box").hide();
			$(".apptidentifier").hide();
			$(".viewappthistory").hide();
			$("#noApptTimeSloat").hide();
			$("#docAvailability").html("");
			$("#appoitment_sloat").html("");
			$("#Edit-Heading").html("<?php echo $this->lang->line('headings')['addNewAppoitment'];?>");
			$("#action-update-btn").parent().hide();
			$("#action-add-btn").parent().show();
			$("#form")[0].reset();
			$("#form input").attr("disabled",false);
			$("#form").attr("action","<?php echo site_url(); ?>/appoitments/add");
			$("#edit").modal("show");
			var thid = $("#hospital_id1").val();
			$("#selected_hid").val(thid);
			
			var tbid = $("#branch_id1").val();
			$("#selected_bid").val(tbid);
			$selectize_doctor_id[0].selectize.disable();
			$selectize_doctor_id[0].selectize.clear();
			$selectize_department_id[0].selectize.disable();
			$selectize_department_id[0].selectize.clear();
			$selectize_branch_id[0].selectize.disable();
			$selectize_branch_id[0].selectize.clear();
			$selectize_hospital_id[0].selectize.clear();
			$selectize_hospital_id[0].selectize.enable();
			$("#appoitment_date").attr('disabled',true);
			$("#appoitment_sloat").attr('disabled',true);
			<?php if($this->auth->isPatient()){
				?>
				$("#remarks").attr("disabled",true);
				<?php
			}?>
		});

		$("#appoitments").on("click",".editbtn",function(){
			resetForm(validator);
			$("#docAvailability").html("");
			$("#suggesstion-box").hide();
			$(".apptidentifier").show();
			$(".viewappthistory").show();
			$(".DoctorName").attr('readonly',true);
			var id = $(this).attr("data-id");
			$("#eidt_gf_id").val(id);
			loadData(id);
			$("#form").attr("action","<?php echo site_url(); ?>/appoitments/update");
			$("#form input").attr("disabled",false);
			$("#Edit-Heading").html("<?php echo $this->lang->line('headings')['EditappointmentHeading'];?>");
			$("#action-add-btn").parent().hide();
			$("#action-update-btn").parent().show();
			<?php if($this->auth->isPatient()){
				?>
				$("#remarks").attr("disabled",true);
				<?php
			}?>
			$("#selected_hid").val($("#hospital_id1").val());
			$("#selected_bid").val($("#branch_id1").val());
		});

		function loadData(id){
			$.post("<?php echo site_url(); ?>/appoitments/getappoitments",{ id: id },function(data){
				var data = JSON.parse(data);
				/*var tempselectize_user_id = $selectize_user_id[0].selectize;
				tempselectize_user_id.addOption([{"id":data.user_id,"text":data.user_id}]);
				tempselectize_user_id.refreshItems();
				tempselectize_user_id.setValue(data.user_id);*/

				$
				t_bid = data.branch_id;
				t_did = data.department_id;
				t_oid = data.doctor_id;

				var tempselectize_hospital_id = $selectize_hospital_id[0].selectize;
				tempselectize_hospital_id.addOption([{"id":data.hospital_id,"text":data.hospital_id}]);
				tempselectize_hospital_id.refreshItems();
				tempselectize_hospital_id.setValue(data.hospital_id);
				cur_v = data.timesloat;
				
				
				$("#appoitment_sloat").html('<option selected value="'+data.timesloat_val+'">'+data.timesloat_txt+'</option>');
				$("#DoctorID").val(data.doctor_id);
				$(".DoctorName").val(data.doctor_name);
				$("#reason").val(data.reason);
				$("#appoitment_date").datepicker("setDate",data.appoitment_date);
				$("#appoitment_date").val(data.appoitment_date);
				$("#appoitment_date").trigger("change");
				$("#appoitment_sloat").trigger("change");

				$("#remarks").val(data.remarks);
				$(".apptidentifier").html(data.appoitment_number);
			
				$("#appoitment_date").prop("disabled", true);
				$("#reason").prop("disabled", false);
				$selectize_hospital_id[0].selectize.disable();
			});
		}

		$("#appoitments").on("click",".viewbtn",function(){
			resetForm(validator);
			loadData($(this).attr("data-id"));
			$("#form input").attr("disabled",true);
			$("#form").attr("action","");
			$("#action-add-btn").parent().hide();
			$("#action-update-btn").parent().hide();
			$("#Edit-Heading").html("<?php echo $this->lang->line('headings')['detailedView'];?>");

		});
		
		 $("#appoitments").on("click",".delbtn",function(){
			var id = $(this).attr("data-id");
			$.ajax({
				url: "<?php echo site_url(); ?>/appoitments/checkAppointmentCancelTime/",
					type: "POST",
					data: {"q":id},
					error: function() {
						callback();
					},
					success: function(res) {
						if(res==0){
						toastr.error("<?php echo $this->lang->line('headings')['canceltimeexceed'];?>");
						}else{
							var curdel = $(this);
			var s = swalDeleteConfig;
			s.text = '<?=$this->lang->line('labels')['delSureAppt'];?>';
			var msg = $(this).data('msg');
			if(msg!=undefined)
				s.text = msg;
			swal(s).then(function () {
				$.post("<?php echo site_url(); ?>/appoitments/cancel",{id:id},function(data){
					if(data==1){
						$($("#dellink_"+id).parents('td').siblings()[6]).html('<span class="label label-warning"><?php echo $this->lang->line("labels")["canceled"]?></span>');
						toastr.success("<?php echo $this->lang->line('headings')['cancelSuccess'];?>");
						if(dt != undefined){
							dt.ajax.reload();
						}
					}else{
						toastr.error("<?php echo $this->lang->line('headings')['tryAgain'];?>");
					}
				});
			});
						}
					}
			});
			
		});

		$(document).on('click','.multiCancelBtn',function(){
			var at = $(this).data('at');
			var selected = [];
			$('.multiselect').each(function() {
				if ($(this).is(":checked")) {
					selected.push($(this).data('id'));
				}
			});
			if(selected.length == 0){
				swal({
					animation: "slide-from-top",
					text: 'Please select checkbox.'
					});
			}else{
				var txt = "<?=$this->lang->line('labels')['delSureAppt'];?>";
				var msg = $(this).data('msg');
				if(msg!=undefined)
					txt = msg;
				swal({
					title: 'Are you sure?',
					text: txt,
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes'
				}).then(function () {
					$.post(BASEURL+"/"+at+"/cancel",{ id : selected },function(data){
						if(data==1){
							// for(var i=0; i<selected.length; i++){
							// 	var temp = selected[i];
							// 	$($("#dellink_"+temp).parents('td').siblings()[6]).html('<span class="label label-warning"><?php echo $this->lang->line("labels")["canceled"]?></span>');
							// }
							toastr.success('selected item(s) cancled.');
							if(dt != undefined){
								dt.ajax.reload();
							}
						}else{
							toastr.error('Please try again.');
						}
					});
				});
				
			}
		});
		
		/*var $selectize_user_id = $("#user_id").selectize({
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
					url: "<?php echo site_url(); ?>/users/search",
					type: "GET",
					data: {"q":query,"f":"first_name,last_name"},
					error: function() {
						callback();
					},
					success: function(res) {
						callback($.parseJSON(res));
					}
				});
			}
		});*/
		

		$("#appoitment_date").change(function(){
			var d = $("#appoitment_date").val();
			console.log("Gettig Time SLot for : "+d);
			$.post("<?php echo site_url(); ?>/appoitments/getNewSloat",{date:d,did:$("#DoctorID").val()},function(data){
				data = JSON.parse(data);
				$("#appoitment_sloat").html("");
				$("#noApptTimeSloat").hide();
				if(data.length == 0){
					$("#noApptTimeSloat").show();
				}else{
					$("#appoitment_sloat").attr('disabled',false);
					for(var i=0; i<data.length; i++){
						var item = data[i];
						var v = item.start+'-'+item.end;
						var sel = "";
						if(cur_v != null && cur_v != undefined){
							if(cur_v == v){
								sel = "selected";
							}
						}
						var ht = '<option '+sel+' value="'+v+'">'+item.title+'</option>';
						$("#appoitment_sloat").append(ht);
					}
				}
			});
		});

		var xhr;

		var $selectize_doctor_id = $("#doctor_id").selectize({
			valueField: "id",
			labelField: "text",
			searchField: "text",
			preload:true,
			create: false,
			render: {
				option: function(item, escape) {
					
					var dis = "";
					if(item.description != undefined)
						dis = item.description;
					return "<div><span class='title' style='font-size:14px'><b>" +
							escape(item.text)+
						"</b></span><br><span style='font-size:12px;'><i>"+
						escape(dis)+
						"</i></span>" +   
					"</div>";
				}
			},
			onChange: function(value){
				if(!value.length) return;
				$.get("<?php echo site_url(); ?>/doctors/getAvailabilityText",{id:value},function(data){
					$("#docAvailability").html(data);
				});
				$("#appoitment_date").attr('disabled',false);
			}
		});

		var $selectize_department_id = $("#department_id").selectize({
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
			onChange: function(value){
				if(!value.length) return;

				$selectize_doctor_id[0].selectize.disable();
				$selectize_doctor_id[0].selectize.clearOptions();
				$selectize_doctor_id[0].selectize.load(function(callback) {
					xhr && xhr.abort();
					xhr = $.ajax({
						url: "<?php echo site_url(); ?>/doctors/search/",
						type: "GET",
						data: { "department_id":value,"f":""},
						success: function(results) {
							
							var res = $.parseJSON(results);
							callback(res);
							if(t_oid != null){
								var tempsselectize_doctor_id = $selectize_doctor_id[0].selectize;
								tempsselectize_doctor_id.addOption([{"id":t_oid,"text":t_oid}]);
								tempsselectize_doctor_id.refreshItems();
								tempsselectize_doctor_id.setValue(t_oid);
								t_oid = null;
							}else{
								$selectize_doctor_id[0].selectize.enable();
							}
						},
						error: function() {
							callback();
						}
					})
				}); 
			}
		});

		var $selectize_branch_id = $("#branch_id").selectize({
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
				
				$selectize_department_id[0].selectize.disable();
				$selectize_department_id[0].selectize.clearOptions();
				$selectize_department_id[0].selectize.load(function(callback) {
					xhr && xhr.abort();
					xhr = $.ajax({
						url: "<?php echo site_url(); ?>/departments/search/",
						type: "GET",
						data: { "branch_id":value,"f":"department_name"},
						success: function(results) {
							
							var res = $.parseJSON(results);
							callback(res);
							if(t_did != null){
								var tempsselectize_department_id = $selectize_department_id[0].selectize;
								tempsselectize_department_id.addOption([{"id":t_did,"text":t_did}]);
								tempsselectize_department_id.refreshItems();
								tempsselectize_department_id.setValue(t_did);
								t_did = null;
							}else{
								$selectize_department_id[0].selectize.enable();
							}
						},
						error: function() {
							callback();
						}
					})
				}); 
				
			}
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
			},
			onChange: function(value) {
				if (!value.length) return;
				
				$selectize_branch_id[0].selectize.disable();
				$selectize_branch_id[0].selectize.clearOptions();
				$selectize_branch_id[0].selectize.load(function(callback) {
					xhr && xhr.abort();
					xhr = $.ajax({
						url: "<?php echo site_url(); ?>/branches/search/",
						type: "GET",
						data: { "hospital_id":value,"f":"branch_name"},
						success: function(results) {
							
							var res = $.parseJSON(results);
							callback(res);
							if(t_bid != null){
								var tempselectize_branch_id = $selectize_branch_id[0].selectize;
								tempselectize_branch_id.addOption([{"id":t_bid,"text":t_bid}]);
								tempselectize_branch_id.refreshItems();
								tempselectize_branch_id.setValue(t_bid);
								t_bid = null;
							}else{
								$selectize_branch_id[0].selectize.enable();
							}
						},
						error: function() {
							callback();
						}
					})
				});                 
			}
		});

		var dt;
		function loadTable(hid,bid){	

			jQuery.fn.DataTable.Api.register( 'buttons.exportData()', function ( options ) {
				if ( this.context.length ) {
					var jsonResult = $.ajax({
						url: "<?php echo site_url(); ?>/appoitments/getDTappoitments?ex=1&sd="+_sd+"&ed="+_ed+"&hid="+hid+"&bid="+bid,
						success: function (result) {
							//Do nothing
						},
						async: false
					});
					var data = jQuery.parseJSON(jsonResult.responseText).data;
					return {body: data, header: $("#appoitments thead tr th").map(function() { return this.innerHTML; }).get()};
				}
			} );

			$("#appoitments").dataTable().fnDestroy();
			dt = $("#appoitments").DataTable({
				"processing": true,
				"serverSide": true,
				"ajax": "<?php echo site_url(); ?>/appoitments/getDTappoitments?&sd="+_sd+"&ed="+_ed+"&hid="+hid+"&bid="+bid
			});

			<?php $this->load->view('template/exdt');?>

			$(".dataTables_filter").attr("style","display: flex;float: right");
			//$(".dataTables_filter").append("<a class=\"btn btn-success m-b-sm addbtn\" data-toggle=\"tooltip\" title=\"Add\"  href=\"javascript:void(0);\" data-title=\"Add\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Add New</a>");
			//$(".dataTables_filter").append("<a class=\"btn btn-danger m-b-sm multiDeleteBtn\" data-at=\"charges\" data-toggle=\"tooltip\" title=\"Delete\"  href=\"javascript:void(0);\" data-title=\"Delete\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Delete</a>");
		}
			

		$("#sel_date").change(function(){
			var date = $("#sel_date").val();
			loadTable("all","");
		});
		
		function cb(start, end) {
			//console.log(start.format('MM D, YYYY') + ' - ' + end.format('MM D, YYYY'));
			//window.location.href = '<?php echo site_url();?>appoitments/report?sd='+start.format('YYYY-MM-D')+"&ed="+end.format('YYYY-MM-D');
			_sd = start.format('YYYY-MM-D');
			_ed = end.format('YYYY-MM-D');
			loadTable($("#hospital_id1").val(),$("#branch_id1").val());
		}
		
		var start = moment().subtract(29, 'days');
		var end = moment();
		
		$('#sel_date').daterangepicker({
			startDate: start,
			endDate: end,
			locale: { 
				applyLabel : '<?php echo $this->lang->line('apply');?>',
				cancelLabel: '<?php echo $this->lang->line('clear');?>',
				"customRangeLabel": "<?php echo $this->lang->line('custom');?>",
			},  
			ranges: {
				'<?php echo $this->lang->line('today');?>': [moment(), moment()],
				'<?php echo $this->lang->line('tomorrow');?>': [moment().add(1, 'days'), moment().add(1, 'days')],
				'<?php echo $this->lang->line('next_7_day');?>': [moment().add(1, 'days'), moment().add(7, 'days')],
				'<?php echo $this->lang->line('next_30_day');?>': [moment().add(1, 'days'), moment().add(30, 'days')],
				'<?php echo $this->lang->line('this_month');?>': [moment().startOf('month'), moment().endOf('month')],
				'<?php echo $this->lang->line('next_month');?>': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf('month')],
				'<?php echo $this->lang->line('last_7_day');?>': [moment().subtract(6, 'days'), moment()],
				'<?php echo $this->lang->line('last_30_day');?>': [moment().subtract(29, 'days'), moment()],
				'<?php echo $this->lang->line('this_month');?>': [moment().startOf('month'), moment().endOf('month')],
				'<?php echo $this->lang->line('last_month');?>': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			}
		},cb);
		
		$('#sel_date').on('cancel.daterangepicker', function(ev, picker) {
			//do something, like clearing an input
			$('#sel_date').val('');
			_sd = "";
			_ed = "";
			loadTable($("#hospital_id1").val(),$("#branch_id1").val());
		});
		
		$("#sel_date").val("");	
		loadTable("all","");
		
		$('.DoctorName').on('keyup', function(){
		   $SearchTerm = $(this).val();
		   if($SearchTerm.length > 2){
		   $.ajax({
					url: "<?php echo site_url(); ?>/index/searchDoctor/",
					type: "POST",
					data: {"q":$SearchTerm},
					error: function() {
						callback();
					},
					success: function(res) {
						//res = $.parseJSON(res);
						/*$.each($.parseJSON(res), function(k, v) {
   						 //alert(k['id'] + ' is ' + v['id']);
						});*/
						if(res){
						$("#suggesstion-box").show();
			$("#suggesstion-box").html(res);
			$(".DoctorName").css("background","#FFF");
						}else{
							$(".DoctorID").val('');
							$("#suggesstion-box").hide();
							}
					}
				});
		   }else{
		   $("#suggesstion-box").hide();
		   }
		});
		$('body').delegate('.selected-docotr','click',function(){
			//alert($(this).attr('rel'));
			selectDoctor($(this).attr('rel'),$(this).attr('rel1'));
			});
		function selectDoctor(DName,DID) {
		$(".DoctorName").val(DName);
		$(".DoctorID").val(DID);
		$("#suggesstion-box").hide();
		}
		
		$('body').delegate('.selected-docotr','click',function(){
		
			//if(!value.length) return;
			
				$.get("<?php echo site_url(); ?>/doctors/getAvailabilityText",{id:$(this).attr('rel1')},function(data){
					$("#docAvailability").html(data);
				});
				$("#appoitment_date").attr('disabled',false);
				
		});
		
	$('.viewappthistory').on('click', function(e){
		
	 $appointmentid = $('#eidt_gf_id').val();
	 
	 e.preventDefault();
	 
		$.ajax({
				type: "POST",
				url: "<?php echo site_url(); ?>/appoitments/GetAppointmentHistory/",
				data: {"appointmentid":$appointmentid},
				success:function(result){
					if(result != 0){
						
						$("#load").html(result);
						$("#load").prop('disabled', false);	
						
					} else {
						
						$("#load").html(result);
						$("#load").prop('disabled', false);
						
					}
				}
			});
	});		

	});

</script>