<?php
    $this->load->view('template/header.php');
    $this->load->view('template/left.php');
?>    
    <input type="hidden" id="left_active_menu" value="1" />
    <div id="main-wrapper">
    <div class="row">
            <div class="state-overview">
                <div class="col-lg-3 col-sm-6">
                    <a href="<?php echo site_url();?>/doctors/nurse">
                    <div class="overview-panel purple">
                        <div class="symbol">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="value white">
                            <p class="sbold addr-font-h1" data-counter="counterup" data-value="<?php echo $states['tot_nus'];?>"><?php echo $states['tot_nus'];?></p>
                            <p><?php echo $this->lang->line('nurses');?></p>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="<?php echo site_url();?>/doctors/receptionist">
                    <div class="overview-panel green-bgcolor">
                        <div class="symbol">
                            <i class="fa fa-user-md"></i>
                        </div>
                        <div class="value white">
                            <p class="sbold addr-font-h1" data-counter="counterup" data-value="<?php echo $states['tot_rec'];?>"><?php echo $states['tot_rec'];?></p>
                            <p><?php echo $this->lang->line('receptionists');?></p>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="<?php echo site_url();?>/doctors/patient">
                    <div class="overview-panel orange">
                        <div class="symbol">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="value white">
                            <p class="sbold addr-font-h1" data-counter="counterup" data-value="<?php echo $states['tot_pat'];?>"><?php echo $states['tot_pat'];?></p>
                            <p><?php echo $this->lang->line('patients');?></p>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="<?php echo site_url();?>/appoitments">
                    <div class="overview-panel blue-bgcolor">
                        <div class="symbol">
                            <i class="icon-envelope"></i>
                        </div>
                        <div class="value white">
                            <p class="sbold addr-font-h1" data-counter="counterup" data-value="<?php echo $states['tot_app'];?>"><?php echo $states['tot_app'];?></p>
                            <p><?php echo $this->lang->line('appointments');?></p>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card">      
                <div class="card-head">
				<?php echo $date = date('H:i:s', time()); ?>
                    <header><?php echo $this->lang->line('todaysappoitments');?></header>
                    <div class="custome_card_header">
						<a class="btn btn-primary" id="menualrefresh"><i class="fa fa-refresh"></i></a>
                    </div>
                </div>
                    
                <div class="card-body">
                    <table id="appoitments" class="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
                        <thead>
                            <tr>
                                <th style="width:10px"></th>
                                <th><?php echo $this->lang->line('tableHeaders')['appoitment_no'];?></th>
                                <th><?php echo $this->lang->line('tableHeaders')['patient'];?></th>
                                <th><?php echo $this->lang->line('tableHeaders')['reason'];?></th>
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
								<div class="form-group col-md-6">
									<label>User</label>
									<select name="user_id" id="user_id" class="form-control" style="width: 100%;">
									</select>
								</div>
								<div class="form-group col-md-6">
                                    <label><?php echo $this->lang->line('labels')['selectHospital'];?></label>
                                    <select id="hospital_id" class=" form-control" style="width: 100%">
					                </select>
                                </div>
							</div>
							<div class="col-md-12">
								<div class="form-group col-md-6">
                                    <label><?php echo $this->lang->line('labels')['selectBranch'];?></label>
                                    <select id="branch_id" class=" form-control" style="width: 100%">
					                </select>
                                </div>
								<div class="form-group col-md-6">
                                    <label><?php echo $this->lang->line('labels')['selectDepartment'];?></label>
                                    <select id="department_id" name="department_id" class=" form-control" style="width: 100%">
					                </select>
                                </div>
								<input type="hidden" name="doctor_id" id="doctor_id" value="<?php echo $this->auth->getDoctorId();?>" />
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
									<br>
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
									<textarea  class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['remark'];?>" name="remarks" id="remarks" rows="3"></textarea>
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
		                        <button type="button" class="btn btn-info btn-lg appt_submit" id="action-update-btn" style="width: 100%;"><span style="margin: 5px" class="fa fa-check"></span><?php echo $this->lang->line('buttons')['update'];?></button>
		                    </div>
		                    
		                    <div class="form-group col-md-6" style="display:none">
		                        <button type="button" class="btn btn-success btn-lg appt_submit" id="action-add-btn" style="width: 100%;"><span style="margin: 5px" class="fa fa-plus"></span><?php echo $this->lang->line('buttons')['add'];?></button>
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
    $this->load->view('template/footer.php');
?>
<script src="<?php echo base_url();?>public/assets/js/pages/dashboard.js"></script>
<script>
    $(document).ready(function(){
        //$("#appoitments").dataTable().fnDestroy();
        var dt;
		function loadTable(){
            $("#appoitments").dataTable().fnDestroy();
            dt = $("#appoitments").DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "<?php echo site_url(); ?>/appoitments/getDTTodayspappoitments"
            });
            $(".dataTables_filter").hide();
        }

        setInterval(function() {
            loadTable();
        }, 60000);
		
		$("#menualrefresh").click(function(){
			loadTable();
		});
		
        loadTable();

        $(document).on('click','.apprbtn',function(){
            var id = $(this).attr("data-id");
            var curdel = $(this);
            var s = swalDeleteConfig;
            var msg = $(this).data('msg');
            if(msg!=undefined)
                s.text = msg;
            swal(s).then(function () {
                $.post("<?php echo site_url(); ?>/appoitments/approve",{id:id},function(data){
                    if(data==1){
                        $($("#apprlink_"+id).parents('td').siblings()[6]).html('<span class="label label-primary"><?php echo $this->lang->line("labels")["approved"]?></span>');
                        //$("#dellink_"+id).parents('tr').remove();
                        toastr.success("<?php echo $this->lang->line('headings')['approvedSuccess'];?>");
                        if(dt != undefined){
                            dt.ajax.reload();
                        }
                    }else{
                        toastr.error("<?php echo $this->lang->line('headings')['tryAgain'];?>");
                    }
                });
            });
        });

        $(document).on("click",".delbtn",function(){
            var id = $(this).attr("data-id");
            var curdel = $(this);
            var s = swalDeleteConfig;
            var msg = $(this).data('msg');
            if(msg!=undefined)
                s.text = msg;
            swal(s).then(function () {
                $.post("<?php echo site_url(); ?>/appoitments/reject",{id:id},function(data){
                    if(data==1){
                        $($("#dellink_"+id).parents('td').siblings()[6]).html('<span class="label label-danger"><?php echo $this->lang->line("labels")["rejected"]?></span>');
                        toastr.success("<?php echo $this->lang->line('headings')['rejectSuccess'];?>");
                        if(dt != undefined){
                            dt.ajax.reload();
                        }
                    }else{
                        toastr.error("<?php echo $this->lang->line('headings')['tryAgain'];?>");
                    }
                });
            });
        });

        $(document).on('click','.multiApprBtn',function(){
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
                var txt = "<?=$this->lang->line('headings')['deleteMessage']?>";
                var msg = $(this).data('msg');
                if(msg!=undefined)
                    txt = msg;
                swal({
                    title: '<?=$this->lang->line('headings')['areYouSure']?>',
                    text: txt,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then(function () {
                    $.post(BASEURL+"/"+at+"/approve",{ id : selected },function(data){
                        if(data==1){
                            // for(var i=0; i<selected.length; i++){
                            //     var temp = selected[i];
                            //     $($("#apprlink_"+id).parents('td').siblings()[6]).html('<span class="label label-primary"><?php echo $this->lang->line("labels")["approved"]?></span>');
                            // }
                            if(dt != undefined){
								dt.ajax.reload();
							}
                            toastr.success("<?php echo $this->lang->line('headings')['approvedSuccess'];?>");
                        }else{
                            toastr.error('Please try again.');
                        }
                    });
                });

            }
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
                var txt = "<?=$this->lang->line('headings')['deleteMessage']?>";
                var msg = $(this).data('msg');
                if(msg!=undefined)
                    txt = msg;
                swal({
                    title: '<?=$this->lang->line('headings')['areYouSure']?>',
                    text: txt,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then(function () {
                    $.post(BASEURL+"/"+at+"/reject",{ id : selected },function(data){
                        if(data==1){
                            // for(var i=0; i<selected.length; i++){
                            //     var temp = selected[i];
                            //     $($("#dellink_"+temp).parents('td').siblings()[6]).html('<span class="label label-danger"><?php echo $this->lang->line("labels")["rejected"]?></span>');
                            // }
                            if(dt != undefined){
								dt.ajax.reload();
							}
                            toastr.success('selected item(s) cancled.');
                        }else{
                            toastr.error('Please try again.');
                        }
                    });
                });

            }
        });

        //Edit Appt.
        var t_bid = null;
		var t_did = null;
		var t_oid = null;
		var cur_v = null;
		var isEdit = false;
        var validator = $("#form").validate({
			ignore: [],
			rules: {
				user_id:{
					required: true
				},
				hospital_id:{
					required: true
				},
				department_id:{
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
					required : true
				}
			},
			messages: {
				user_id:{
					required:  "<?php echo $this->lang->line('validation')['selectPatient'];?>"
				},
				appoitment_date:{
					required:  "<?php echo $this->lang->line('validation')['requiredAppoitmentDate'];?>"
				},
				appoitment_sloat:{
					required: "<?php echo $this->lang->line('validation')['requiredAppoitmentSloat']; ?>"
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

        $(".appt_submit").click(function(){
			var appst = $("#appoitment_sloat").val();

			if(validator.form() && appst != null && appst != undefined) {
				$("#form").submit();
			}
		});

        $(document).on("click",".editbtn",function(){
			resetForm(validator);
			var id = $(this).attr("data-id");
			
			$("#eidt_gf_id").val(id);
			loadData(id);
			$("#form").attr("action","<?php echo site_url(); ?>/appoitments/update");
			$("#form input").attr("disabled",false);
			$("#Edit-Heading").html("<?php echo $this->lang->line('headings')['editData'];?>");
			$("#action-add-btn").parent().hide();
			$("#action-update-btn").parent().show();

			$("#selected_hid").val($("#hospital_id1").val());
			$("#selected_bid").val($("#branch_id1").val());
		});

        function loadData(id){
			$.post("<?php echo site_url(); ?>/appoitments/getappoitments",{ id: id },function(data){
				var data = JSON.parse(data);
				var tempselectize_user_id = $selectize_user_id[0].selectize;
				tempselectize_user_id.addOption([{"id":data.user_id,"text":data.user_name}]);
				tempselectize_user_id.refreshItems();
				tempselectize_user_id.setValue(data.user_id);
				isEdit = true;
				t_bid = data.branch_id;
				t_did = data.department_id;
				t_oid = data.doctor_id;

				var tempselectize_hospital_id = $selectize_hospital_id[0].selectize;
				tempselectize_hospital_id.addOption([{"id":data.hospital_id,"text":data.hospital_id}]);
				tempselectize_hospital_id.refreshItems();
				tempselectize_hospital_id.setValue(data.hospital_id);

				
				$("#appoitment_sloat").append('<option selected value="'+data.timesloat_val+'">'+data.timesloat_txt+'</option>');
				$("#appoitment_date").datepicker("setDate",data.appoitment_date);
                $("#appoitment_date").val(data.appoitment_date);
				$("#appoitment_date").trigger("change");

				$("#reason").val(data.reason);
				
				$("#remarks").val(data.remarks);
			
				$("#appoitment_date").attr("disabled", true);
				$("#appoitment_sloat").attr("disabled", true);
				$("#reason").attr("disabled", true);
				$selectize_hospital_id[0].selectize.disable();
				$selectize_user_id[0].selectize.disable();
				

			});
		}

        $("#appoitment_date").change(function(){
			var d = $("#appoitment_date").val();
			$.post("<?php echo site_url(); ?>/appoitments/getNewSloat",{date:d,did:$("#doctor_id").val()},function(data){
				data = JSON.parse(data);
				$("#appoitment_sloat").html("");
				$("#noApptTimeSloat").hide();
				if(data.length == 0){
					$("#noApptTimeSloat").show();
				}else{
					if(isEdit){
						$("#appoitment_date").attr("disabled", true);
					}else{
						$("#appoitment_sloat").attr('disabled',false);
					}
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

        var $selectize_user_id = $("#user_id").selectize({
			valueField: "id",
			labelField: "text",
			searchField: "text",
			loadThrottle: 500,
			placeholder: "Enter user Email or Mobile number or Aadhaar number",
			preload:true,
			render: {
				option_create: function(data, escape) {
					return '<div class="create"><strong><?=$this->lang->line('unregUser');?></strong></div>';
				},
				option: function(item, escape) {
					console.log(item);
					return "<div><span class='title'>" +
							escape(item.text)+
						"</span>" +   
					"</div>";
				}
			},
			load: function(query, callback) {
				if (!query.length) return callback();
				$selectize_user_id[0].selectize.clearOptions();
				$.ajax({
					url: "<?php echo site_url(); ?>/users/searchPatientuea/",
					type: "GET",
					data: {"q":query},
					error: function() {
						callback();
					},
					success: function(res) {
						res = $.parseJSON(res);
						callback(res);
						if(res.length > 0){
							selectFirst($selectize_user_id,res[0].id,res[0].text);
						}
					}
				});
			}
		});

        function selectFirst(sel,id,value){
			var tempsselectize = sel[0].selectize;
			tempsselectize.addOption([{"id":id,"text":value}]);
			tempsselectize.refreshItems();
			tempsselectize.setValue(id);
		}

        var xhr;

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
				if(isEdit){
					$("#appoitment_date").prop("disabled", true);
				}else{
					$("#appoitment_date").prop("disabled", false);
				}
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
								selectFirst($selectize_department_id,t_did,t_did);
								t_did = null;
							}else{
								$selectize_department_id[0].selectize.enable();
								if(res.length > 0){
									selectFirst($selectize_department_id,res[0].id,res[0].text);
								}
							}
							if(isEdit){
								$selectize_department_id[0].selectize.disable();
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
						res = $.parseJSON(res);
						callback(res);
						if(res.length > 0){
							setTimeout(function() {
								selectFirst($selectize_hospital_id,res[0].id,res[0].text);	
							}, 2000);
						}
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
								selectFirst($selectize_branch_id,t_bid,t_bid);
								t_bid = null;
							}else{
								$selectize_branch_id[0].selectize.enable();
								if(res.length > 0){
									selectFirst($selectize_branch_id,res[0].id,res[0].text);
								}
							}
							if(isEdit){
								$selectize_department_id[0].selectize.disable();
							}
						},
						error: function() {
							callback();
						}
					})
				});                 
			}
		});
    });
</script>