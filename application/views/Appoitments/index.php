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
	                <div class="panel panel-white">
	                    
	                    <div class="panel-heading clearfix">
							<div class="">
								<div class="custome_col8">
									<h4 class="panel-title panel_heading_custome"><?php echo $this->lang->line('appoitments');?></h4>
								</div>
								<div class="custome_col4">
									<div class="panel_button_top_right">
										<a class="btn btn-success m-b-sm addbtn" data-toggle="tooltip"   href="javascript:void(0);" data-toggle="modal" data-target="#edit" style=""><?php echo $this->lang->line('buttons')['bookAppoitment'];?></a>
										<a class="btn btn-danger m-b-sm multiCancelBtn" data-at="appoitments"  href="javascript:void(0);"  style="margin-left:10px"><?php echo $this->lang->line('buttons')['cancel'];?></a>
										<a class="btn btn-primary m-b-sm exportBtn" data-at="appoitments" href="javascript:void(0);" data-toggle="modal" data-target="#export" style="margin-left:10px"><?php echo $this->lang->line('buttons')['export'];?></a>
									</div>
								</div>
								<br>
							</div>
	                    </div>
	                    <div class="panel-body panel_body_custome">
	                       <div class="table-responsive">
	                            <table id="appoitments" class="display table" cellspacing="0" width="100%">
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
	        </div>
	        <input type="hidden" id="cur_del">
	    </div><!-- Main Wrapper -->

	    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<form action="<?php echo site_url(); ?>/appoitments/update" method="post" id="form">
				<input type="hidden" name="eidt_gf_id" id="eidt_gf_id">
				
				<div class="modal-content">
				  	<div class="modal-header">
					  	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					  	<h4 class="modal-title custom_align" id="Edit-Heading"></h4>
					</div>
				  	<div class="modal-body">
				  		<div class="row">
				  			<div class="col-md-12">
								<!--<div class="form-group col-md-6">
									<label>User</label>
									<select name="user_id" id="user_id" class=" form-control" style="width: 100%">
									</select>
								</div>-->
								<div class="form-group col-md-6">
                                    <label><?php echo $this->lang->line('labels')['selectHospital'];?></label>
                                    <select id="hospital_id" class=" form-control" style="width: 100%">
					                </select>
                                </div>
								<div class="form-group col-md-6">
                                    <label><?php echo $this->lang->line('labels')['selectBranch'];?></label>
                                    <select id="branch_id" class=" form-control" style="width: 100%">
					                </select>
                                </div>
							</div>
							<div class="col-md-12">
								<div class="form-group col-md-6">
                                    <label><?php echo $this->lang->line('labels')['selectDepartment'];?></label>
                                    <select id="department_id" name="department_id" class=" form-control" style="width: 100%">
					                </select>
                                </div>
								<div class="form-group col-md-6">
									<label><?php echo $this->lang->line('labels')['selectDoctor'];?></label>
									<select name="doctor_id" id="doctor_id" class=" form-control" style="width: 100%">
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
									<input class="form-control date-picker-nopast" type="text" placeholder="<?php echo $this->lang->line('labels')['appoitment_date'];?>" name="appoitment_date" id="appoitment_date" />
								</div>
								<div class="form-group col-md-6">
									<label><?php echo $this->lang->line('labels')['appoitment_sloat'];?></label>
									<select class="form-control" type="text" name="appoitment_sloat" id="appoitment_sloat">
									</select>
									<span id="noApptTimeSloat" style='color:#BC4442;display:none'><?php echo $this->lang->line('labels')['noApptTimeSloat'];?></span>
								</div>
							</div>
							
							<div class="col-md-12">
								<div class="form-group col-md-6">
									<label><?php echo $this->lang->line('labels')['appoitment_reason'];?></label>
									<textarea class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['appoitment_reason'];?>" name="reason" id="reason" rows="3"></textarea>
								</div>
								<div class="form-group col-md-6">
									<label><?php echo $this->lang->line('labels')['remark'];?></label>
									<textarea  class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['patientRemarkPlace'];?>" name="remarks" id="remarks" rows="3"></textarea>
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
		                        <button type="submit" class="btn btn-info btn-lg" id="action-update-btn" style="width: 100%;"><span style="margin: 5px" class="fa fa-check"></span><?php echo $this->lang->line('buttons')['update'];?></button>
		                    </div>
		                    
		                    <div class="form-group col-md-6" style="display:none">
		                        <button type="submit" class="btn btn-success btn-lg" id="action-add-btn" style="width: 100%;"><span style="margin: 5px" class="fa fa-plus"></span><?php echo $this->lang->line('buttons')['bookAppoitment'];?></button>
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
				}
				
			},
			invalidHandler: validationInvalidHandler,
			errorPlacement: validationErrorPlacement
			
		});

	
		$("[data-toggle=tooltip]").tooltip();

		$(".addbtn").click(function(){
			resetForm(validator);
			$("#docAvailability").html("");
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
			var id = $(this).attr("data-id");
			$("#eidt_gf_id").val(id);
			loadData(id);
			$("#form").attr("action","<?php echo site_url(); ?>/appoitments/update");
			$("#form input").attr("disabled",false);
			$("#Edit-Heading").html("<?php echo $this->lang->line('headings')['editData'];?>");
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

				t_bid = data.branch_id;
				t_did = data.department_id;
				t_oid = data.doctor_id;

				var tempselectize_hospital_id = $selectize_hospital_id[0].selectize;
				tempselectize_hospital_id.addOption([{"id":data.hospital_id,"text":data.hospital_id}]);
				tempselectize_hospital_id.refreshItems();
				tempselectize_hospital_id.setValue(data.hospital_id);
				cur_v = data.timesloat;
				
				
				$("#appoitment_date").val(data.appoitment_date);
				$("#appoitment_sloat").append('<option selected value="'+data.timesloat_val+'">'+data.timesloat_txt+'</option>');
				$("#reason").val(data.reason);
				$("#appoitment_date").datepicker("setDate",data.appoitment_date);
				$("#remarks").val(data.remarks);
			
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
			var curdel = $(this);
			var s = swalDeleteConfig;
			s.text = '<?=$this->lang->line('labels')['delSureAppt'];?>';
			swal(s).then(function () {
				$.post("<?php echo site_url(); ?>/appoitments/cancel",{id:id},function(data){
					if(data==1){
						$($("#dellink_"+id).parents('td').siblings()[6]).html('<span class="label label-warning"><?php echo $this->lang->line("labels")["canceled"]?></span>');
						toastr.success("<?php echo $this->lang->line('headings')['cancelSuccess'];?>");
					}else{
						toastr.error("<?php echo $this->lang->line('headings')['tryAgain'];?>");
					}
				});
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
				swal({
					title: 'Are you sure?',
					text: "<?=$this->lang->line('labels')['delSureAppt'];?>",
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes'
				}).then(function () {
					$.post(BASEURL+"/"+at+"/cancel",{ id : selected },function(data){
						if(data==1){
							for(var i=0; i<selected.length; i++){
								var temp = selected[i];
								$($("#dellink_"+temp).parents('td').siblings()[6]).html('<span class="label label-warning"><?php echo $this->lang->line("labels")["canceled"]?></span>');
							}
							toastr.success('selected item(s) cancled.');
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
			$.post("<?php echo site_url(); ?>/appoitments/getNewSloat",{date:d,did:$("#doctor_id").val()},function(data){
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

		

			

		function loadTable(hid,bid){	
			$("#appoitments").dataTable().fnDestroy();
			$("#appoitments").DataTable({
				"processing": true,
				"serverSide": true,
				"ajax": "<?php echo site_url(); ?>/appoitments/getDTappoitments?hid="+hid+"&bid="+bid
			});

			$(".dataTables_filter").attr("style","display: flex;float: right");
			//$(".dataTables_filter").append("<a class=\"btn btn-success m-b-sm addbtn\" data-toggle=\"tooltip\" title=\"Add\"  href=\"javascript:void(0);\" data-title=\"Add\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Add New</a>");
			//$(".dataTables_filter").append("<a class=\"btn btn-danger m-b-sm multiDeleteBtn\" data-at=\"charges\" data-toggle=\"tooltip\" title=\"Delete\"  href=\"javascript:void(0);\" data-title=\"Delete\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Delete</a>");
		}
		loadTable("all","");	

	});

</script>