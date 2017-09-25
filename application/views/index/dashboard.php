<?php
    $this->load->view('template/header.php');
    $this->load->view('template/left.php');
?>    
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <h3>Select Role</h3>
                <form class=""  method="post" id="reg_form" action="<?php echo site_url().'/index/updaterole' ?>">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Register As</label>
                            <select class="form-control" name="role" id="role">
                                <option value="<?php echo $this->auth->getPatientRoleType();?>">Patient</option>
                                <option value="<?php echo $this->auth->getHospitalAdminRoleType();?>">Hospital Admin</option>
                                <option value="<?php echo $this->auth->getDoctorRoleType();?>">Doctor</option>
                                <option value="<?php echo $this->auth->getNurseRoleType();?>">Nurse</option>
                                <option value="<?php echo $this->auth->getReceptienstRoleType();?>">Receptienst</option>
								<option value="<?php echo $this->auth->getMedicalStoreRoleType();?>">Medical Store</option>
								<option value="<?php echo $this->auth->getMedicalLabRoleType();?>">Medical Lab</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" >
                        <div class="form-group col-md-6" id="hdiv" style="display:none">
                            <label><?php echo $this->lang->line('labels')['selectHospital'];?></label>
                            <select id="hospital_id" name="hospital_id" class=" form-control" style="width: 100%">
                            </select>
                        </div>
                        <div class="form-group col-md-6" id="bdiv" style="display:none">
                            <label><?php echo $this->lang->line('labels')['selectBranch'];?></label>
                            <select id="branch_id" name="branch_id" class=" form-control" style="width: 100%">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6" id="ddiv" style="display:none">
                            <label><?php echo $this->lang->line('labels')['selectDepartment'];?></label>
                            <select id="department_id" name="department_id" class=" form-control" style="width: 100%">
                            </select>
                        </div>
                        <div class="form-group col-md-6" id="dddiv" style="display:none">
                            <label><?php echo $this->lang->line('labels')['selectDoctor'];?></label>
                            <select name="doctor_id" id="doctor_id" class=" form-control" style="width: 100%">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <button class="btn btn-primary" style="margin-left:15px" type="submit">Save</button>
                    </div>
					<p>
						<span style="font-size: 12px"><i>Complete registration by selection your User role.</i></span>
					</p>
                </form>
            </div>
        </div>
    </div>
<?php
    $this->load->view('template/footer.php');
?>
<script type="text/javascript">
		
	$(document).ready(function(){

        var validator = $("#reg_form").validate({
            ignore: [],
            rules: {
                
            },
            messages: {
                
            },
            invalidHandler: validationInvalidHandler,
            errorPlacement: validationErrorPlacement
            
        });
        
        //$("#roldiv").hide();

        $('#role').change(function(){
            
            var r = $(this).val();
            var role = parseInt(r);
            console.log(typeof(role));
            //$($selectize_doctor_id).hide();
            
            
            $("#hospital_id").rules("add", {
                required:true,
                messages: {
                    required: "<?php echo $this->lang->line('validation')['selectHospital'];?>"
                }
            });
            $("#branch_id").rules("add", {
                required:true,
                messages: {
                    required: "<?php echo $this->lang->line('validation')['selectBranch'];?>"
                }
            });
            $("#department_id").rules("add", {
                required:true,
                messages: {
                    required: "<?php echo $this->lang->line('validation')['selectDepartment'];?>"
                }
            });
            $("#doctor_id").rules("add", {
                required:true,
                messages: {
                    required: "<?php echo $this->lang->line('validation')['selectDoctor'];?>"
                }
            });
            $("#hdiv").hide();
            $("#bdiv").hide();
            $("#ddiv").hide();
            $("#dddiv").hide();

            switch(role){
                case 6:
                    $("#hospital_id").rules("remove","required");
                    $("#branch_id").rules("remove","required");
                    $("#department_id").rules("remove","required");
                    $("#doctor_id").rules("remove","required");
                    break;
                case 2:
                    $("#hdiv").show();
                    $("#branch_id").rules("remove","required");
                    $("#department_id").rules("remove","required");
                    $("#doctor_id").rules("remove","required");
                    break;
                case 3:
                    $("#hdiv").show();
                    $("#bdiv").show();
                    $("#ddiv").show();
                    $("#doctor_id").rules("remove","required");
                    break;
                case 4:
                    $("#hdiv").show();
                    $("#bdiv").show();
                    $("#ddiv").show();
                    $("#doctor_id").rules("remove","required");
                    break;        
                case 5:
                    $("#hdiv").show();
                    $("#bdiv").show();
                    $("#ddiv").show();
                    $("#dddiv").show();
                    break;
				case 7:
				case 8:
					$("#department_id").rules("remove","required");
                    $("#doctor_id").rules("remove","required");
					$("#hdiv").show();
                    $("#bdiv").show();
					break;	
            }
            
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
							/* if(t_oid != null){
								var tempsselectize_doctor_id = $selectize_doctor_id[0].selectize;
								tempsselectize_doctor_id.addOption([{"id":t_oid,"text":t_oid}]);
								tempsselectize_doctor_id.refreshItems();
								tempsselectize_doctor_id.setValue(t_oid);
								t_oid = null;
							}else{ */
								$selectize_doctor_id[0].selectize.enable();
							//}
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
							/* if(t_did != null){
								var tempsselectize_department_id = $selectize_department_id[0].selectize;
								tempsselectize_department_id.addOption([{"id":t_did,"text":t_did}]);
								tempsselectize_department_id.refreshItems();
								tempsselectize_department_id.setValue(t_did);
								t_did = null;
							}else{ */
								$selectize_department_id[0].selectize.enable();
							//}
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
							/* if(t_bid != null){
								var tempselectize_branch_id = $selectize_branch_id[0].selectize;
								tempselectize_branch_id.addOption([{"id":t_bid,"text":t_bid}]);
								tempselectize_branch_id.refreshItems();
								tempselectize_branch_id.setValue(t_bid);
								t_bid = null;
							}else{ */
								$selectize_branch_id[0].selectize.enable();
							//}
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