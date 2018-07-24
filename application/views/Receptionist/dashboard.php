<?php
    $this->load->view('template/header.php');
    $this->load->view('template/left.php');
?>    
    <input type="hidden" id="left_active_menu" value="1" />
    <div class="row">
        <div class="state-overview">

            <div class="col-lg-3 col-sm-6">
                <a href="<?php echo site_url();?>/doctors">
                    <div class="overview-panel green-bgcolor">
                        <div class="symbol">
                            <i class="fa fa-user-md"></i>
                        </div>
                        <div class="value white">
                            <p class="sbold addr-font-h1" data-counter="counterup" data-value="<?php echo $states['tot_doc'];?>"><?php echo $states['tot_doc'];?></p>
                            <p><?php echo $this->lang->line('doctors');?></p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-sm-6">
                <a href="<?php echo site_url();?>/receptionist/patient">
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
        <div class="col-md-12">
            <div class="card ">
                
                <div class="card-head">
                    <header><?php echo $this->lang->line('todaysappoitments');?></header>
                    <div class="custome_card_header">
                        <!--<a class="btn btn-success m-b-sm addbtn" data-toggle="tooltip"   href="javascript:void(0);" data-toggle="modal" data-target="#edit" style=""><?php echo $this->lang->line('buttons')['addNew'];?></a>-->
                        <a class="btn btn-success m-b-sm bookNew" data-toggle="tooltip" href="javascript:void(0);" data-toggle="modal" data-target="#edit" style=""><?php echo $this->lang->line('buttons')['bookAppoitment'];?></a>
                        <a class="btn btn-info m-b-sm multiApprBtn" data-msg="<?=$this->lang->line('msg_want_to_approve_appts');?>" data-at="appoitments"  href="javascript:void(0);"  style="margin-left:10px"><?php echo $this->lang->line('buttons')['approve'];?></a>
                        <a class="btn btn-danger m-b-sm multiCancelBtn" data-msg="<?=$this->lang->line('msg_want_to_reject_appts');?>" data-at="appoitments"  href="javascript:void(0);"  style="margin-left:10px"><?php echo $this->lang->line('buttons')['reject'];?></a>
	                    <?php $this->load->view('template/exbtn');?>
						<a class="btn btn-primary" id="menualrefresh"><i class="fa fa-refresh"></i></a>
                    </div>
                </div>
                <div class="card-body ">
                    <div class="col-md-12">
                        
                        <div class="form-group col-md-4">
                            <label><?php echo $this->lang->line('labels')['selectHospital'];?></label>
                            <select id="hospital_id2" class=" form-control" style="width: 100%">
                                <option value="all"><?php echo $this->lang->line('labels')['all'];?></option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label><?php echo $this->lang->line('labels')['selectDoctor'];?></label>
                            <select id="doctor_id2" class=" form-control" style="width: 100%">
                                <option value="all"><?php echo $this->lang->line('labels')['all'];?></option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label><?php echo $this->lang->line('labels')['status'];?></label>
                            <select id="status2" class=" form-control" style="width: 100%">
                                <option value="all"><?php echo $this->lang->line('labels')['all'];?></option>
                                <option value="0"><?php echo  $this->lang->line('labels')['pending']; ?></option>
                                <option value="1"><?php echo  $this->lang->line('labels')['approved']; ?></option>
                                <option value="2"><?php echo  $this->lang->line('labels')['rejected']; ?></option>
                                <option value="4"><?php echo  $this->lang->line('labels')['canceled']; ?></option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox checkbox-icon-black pull-right">
                                <input type="checkbox" id="showClosed2">
                                <label for="showClosed2">
                                    <?php echo $this->lang->line('labels')['ShowClosedAppt'];?>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        
                        <table id="today_appoitments" class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" >
                            <thead>
                                    <tr>
                                    <th style="width:10px"></th>
                                    <th><?php echo $this->lang->line('tableHeaders')['number_short'];?></th>
                                    <th><?php echo $this->lang->line('tableHeaders')['patient'];?></th>
                                    <th><?php echo $this->lang->line('tableHeaders')['hospital_branch_department'];?></th>
                                    <th><?php echo $this->lang->line('tableHeaders')['doctor'];?></th>
                                    <!--<th><?php echo $this->lang->line('tableHeaders')['appoitment_date'];?></th>-->
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
	
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                
                <div class="card-head">
                    <header><?php echo $this->lang->line('appoitments');?></header>
                    <div class="custome_card_header">
                        <!--<a class="btn btn-success m-b-sm addbtn" data-toggle="tooltip"   href="javascript:void(0);" data-toggle="modal" data-target="#edit" style=""><?php echo $this->lang->line('buttons')['addNew'];?></a>-->
                        <a class="btn btn-success m-b-sm bookNew"  data-toggle="tooltip" href="javascript:void(0);" data-toggle="modal" data-target="#edit" style=""><?php echo $this->lang->line('buttons')['bookAppoitment'];?></a>
                        <a class="btn btn-info m-b-sm multiApprBtn" data-msg="<?=$this->lang->line('msg_want_to_approve_appts');?>" data-at="appoitments"  href="javascript:void(0);"  style="margin-left:10px"><?php echo $this->lang->line('buttons')['approve'];?></a>
                        <a class="btn btn-danger m-b-sm multiCancelBtn" data-msg="<?=$this->lang->line('msg_want_to_reject_appts');?>" data-at="appoitments"  href="javascript:void(0);"  style="margin-left:10px"><?php echo $this->lang->line('buttons')['reject'];?></a>
                       	<?php $this->load->view('template/exbtn');?>
						<a class="btn btn-primary" id="menualrefresh1"><i class="fa fa-refresh"></i></a>
                    </div>
                </div>
                <div class="card-body ">
                    <div class="col-md-12">
                        <div class="form-group col-md-3">
                            <label><?php echo $this->lang->line('labels')['select_date'];?></label>
                            <input id="sel_date" class=" form-control date-picker" /> 
                        </div>
                        <div class="form-group col-md-3">
                            <label><?php echo $this->lang->line('labels')['selectHospital'];?></label>
                            <select id="hospital_id1" class=" form-control" style="width: 100%">
                                <option value="all"><?php echo $this->lang->line('labels')['all'];?></option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label><?php echo $this->lang->line('labels')['selectDoctor'];?></label>
                            <select id="doctor_id1" class=" form-control" style="width: 100%">
                                <option value="all"><?php echo $this->lang->line('labels')['all'];?></option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label><?php echo $this->lang->line('labels')['status'];?></label>
                            <select id="status" class=" form-control" style="width: 100%">
                                <option value="all"><?php echo $this->lang->line('labels')['all'];?></option>
                                <option value="0"><?php echo  $this->lang->line('labels')['pending']; ?></option>
                                <option value="1"><?php echo  $this->lang->line('labels')['approved']; ?></option>
                                <option value="2"><?php echo  $this->lang->line('labels')['rejected']; ?></option>
                                <option value="4"><?php echo  $this->lang->line('labels')['canceled']; ?></option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox checkbox-icon-black pull-right">
                                <input type="checkbox" id="showClosed">
                                <label for="showClosed">
                                    <?php echo $this->lang->line('labels')['ShowClosedAppt'];?>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        
                        <table id="appoitments" class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" >
                            <thead>
                                    <tr>
                                    <th style="width:10px"></th>
                                    <th><?php echo $this->lang->line('tableHeaders')['number_short'];?></th>
                                    <th><?php echo $this->lang->line('tableHeaders')['patient'];?></th>
                                    <th><?php echo $this->lang->line('tableHeaders')['hospital_branch_department'];?></th>
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
                                <select name="user_id" id="user_id" class=" form-control" style="width: 100%">
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label><?php echo $this->lang->line('labels')['selectHospital'];?></label>
                                <select id="hospital_id" class=" form-control" style="width: 100%">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group col-md-6 hide">
                                <label><?php echo $this->lang->line('labels')['selectBranch'];?></label>
                                <select id="branch_id" class=" form-control" style="width: 100%">
                                </select>
                            </div>
                            <div class="form-group col-md-6 hide">
                                <label><?php echo $this->lang->line('labels')['selectDepartment'];?></label>
                                <select id="department_id" name="department_id" class=" form-control" style="width: 100%">
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label><?php echo $this->lang->line('labels')['selectDoctor'];?></label>
                                <select name="doctor_id" id="doctor_id" class=" form-control" style="width: 100%">
                                </select>
                            </div>
							<div class="form-group col-md-6">
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
                                <textarea  class="form-control allowalphanumeric " type="text" placeholder="<?php echo $this->lang->line('labels')['remark'];?>" name="remarks" id="remarks" rows="3"></textarea>
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

    <div class="modal fade" id="createUser" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <form action="<?php echo site_url(); ?>/users/regUsers" method="post" id="createUseerform">
            <div class="modal-content" style="box-shadow: 0px 0px 50px 0px rgba(0,0,0,30.67)">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Edit-Heading"><?=$this->lang->line('unregUser');?></h4></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        
                        <div class="form-group col-md-12">
                            <label>First Name</label>
                            <input name="first_name" id="first_name" class="form-control"  placeholder="First Name"/>
                        </div><br>
                        <div class="form-group col-md-12">
                            <label>Last Name</label>
                            <input name="last_name" id="last_name" class="form-control"  placeholder="Last Name"/>
                        </div><br>
                        <div class="form-group col-md-12">
                            <label>Mobile</label>
                            <input name="mobile" id="mobile" class="form-control"  placeholder="Mobile"/>
                        </div><br>
                        <div class="form-group col-md-12">
                            <label>Useremail</label>
                            <input name="useremail" id="useremail" class="form-control"  placeholder="User emailid"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal"><?=$this->lang->line('buttons')['cancel']?></button>
                    <button class="btn btn-success" id="create_user"><?=$this->lang->line('buttons')['done']?></button>
                </div>
            </div>
        </div>
    </div>
            
<?php
    $this->load->view('template/footer.php');
?>
<script type="text/javascript">
		
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

		var t_bid = null;
		var t_did = null;
		var t_oid = null;
		var cur_v = null;
		var isEdit = false;

		var validatorCreate = $("#createUseerform").validate({
			ignore: [],
			rules: {
				first_name: {
					required : true
				},
				last_name: {
					required: true
				},
				useremail:{
					required:true,
					email:true,
					remote: "<?php echo site_url();?>/users/checkemail"
				},
				mobile:{
					required:true,
					phoneUS:true,
					remote: "<?php echo site_url();?>/users/checkmobile"
				},
			},
			messages: {
				first_name:{
					required: "<?php echo $this->lang->line('validation')['requiredFname'];?>"
				},
				last_name:{
					required: "<?php echo $this->lang->line('validation')['requiredLname'];?>"
				},
				useremail:{
					required: "<?php echo $this->lang->line('validation')['requiredEmail'];?>",
					email: "<?php echo $this->lang->line('validation')['invalidEmail'];?>",
					remote:"<?php echo $this->lang->line('validation')['takenEmail'];?>"
				},
				mobile:{
					required: "<?php echo $this->lang->line('validation')['requriedPhone'];?>",
					phoneUS: "<?php echo $this->lang->line('validation')['invalidPhone'];?>",
					remote:"<?php echo $this->lang->line('validation')['takenPhone'];?>"
				}
			},
			invalidHandler: validationInvalidHandler,
			errorPlacement: validationErrorPlacement
		});

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
				appoitment_sloat: {
					required : true
				}
			},
			messages: {
				user_id:{
					required:  "<?php echo $this->lang->line('validation')['selectPatient'];?>"
				},
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
				appoitment_sloat:{
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

		$(".bookNew").click(function(){
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
			isEdit = false;
			var tbid = $("#branch_id1").val();
			$("#selected_bid").val(tbid);
			$selectize_doctor_id[0].selectize.disable();
			$selectize_doctor_id[0].selectize.clear();
			$selectize_department_id[0].selectize.disable();
			$selectize_department_id[0].selectize.clear();
			$selectize_branch_id[0].selectize.disable();
			$selectize_branch_id[0].selectize.clear();
			$selectize_hospital_id[0].selectize.enable();
			$selectize_hospital_id[0].selectize.clear();
			$selectize_user_id[0].selectize.enable();
			$selectize_user_id[0].selectize.clear();
			$("#appoitment_date").attr('disabled',true);
			$("#appoitment_sloat").attr('disabled',true);
			$("#appoitment_sloat").html('');
			$("#reason").attr('disabled',false);
		});

		$(document).on("click",".editbtn",function(){
			resetForm(validator);
			var id = $(this).attr("data-id");
			$("#docAvailability").html("");
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
		$("#appoitment_date").val("");
		function loadData(id){
			$.post("<?php echo site_url(); ?>/appoitments/getappoitments",{ id: id },function(data){
				var data = JSON.parse(data);
				var tempselectize_user_id = $selectize_user_id[0].selectize;
				tempselectize_user_id.addOption([{"id":data.user_id,"text":data.user_name}]);
				tempselectize_user_id.refreshItems();
				tempselectize_user_id.setValue(data.user_id);

				t_bid = data.branch_id;
				t_did = data.department_id;
				t_oid = data.doctor_id;

				var tempselectize_hospital_id = $selectize_hospital_id[0].selectize;
				tempselectize_hospital_id.addOption([{"id":data.hospital_id,"text":data.hospital_id}]);
				tempselectize_hospital_id.refreshItems();
				tempselectize_hospital_id.setValue(data.hospital_id);
				cur_v = data.timesloat;
				
				$("#appoitment_sloat").append('<option selected value="'+data.timesloat_val+'">'+data.timesloat_txt+'</option>');
				//$("#appoitment_date").datepicker("setDate",data.appoitment_date);
				$("#appoitment_date").val(data.appoitment_date);
				$("#appoitment_date").trigger("change");

				$("#reason").val(data.reason);
				
				$("#remarks").val(data.remarks);
			
				$("#appoitment_date").attr("disabled", true);
				$("#reason").attr("disabled", true);
				$("#appoitment_sloat").attr("disabled", true);
				isEdit = true;
				
				$selectize_hospital_id[0].selectize.disable();
				$selectize_user_id[0].selectize.disable();
				
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
						//$($("#dellink_"+id).parents('td').siblings()[6]).html('<span class="label label-danger"><?php echo $this->lang->line("labels")["rejected"]?></span>');
						toastr.success("<?php echo $this->lang->line('headings')['rejectSuccess'];?>");
						loadTable($("#sel_date").val(),$("#hospital_id1").val(),$("#doctor_id1").val());
						loadTable1($("#hospital_id2").val(),$("#doctor_id2").val());
					}else{
						toastr.error("<?php echo $this->lang->line('headings')['tryAgain'];?>");
					}
				});
			});
		});

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
						//$($("#apprlink_"+id).parents('td').siblings()[6]).html('<span class="label label-primary"><?php echo $this->lang->line("labels")["approved"]?></span>');
						//$("#dellink_"+id).parents('tr').remove();	
						toastr.success("<?php echo $this->lang->line('headings')['approvedSuccess'];?>");
						loadTable($("#sel_date").val(),$("#hospital_id1").val(),$("#doctor_id1").val());
						loadTable1($("#hospital_id2").val(),$("#doctor_id2").val());
						//if(dt != undefined){
						//	dt.ajax.reload();
						//}
					}else{
						toastr.error("<?php echo $this->lang->line('headings')['tryAgain'];?>");
					}
				});
			});
        });

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
						$("#appoitment_sloat").attr('disabled',true);	
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
							//for(var i=0; i<selected.length; i++){
							//	var temp = selected[i];
							//	$($("#dellink_"+temp).parents('td').siblings()[6]).html('<span class="label label-danger"><?php echo $this->lang->line("labels")["rejected"]?></span>');
							//}
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
		
		var userCreateCallBack = null;

		$("#createUser").on('hide.bs.modal',function(e){
			if(userCreateCallBack!=null){
				userCreateCallBack();
				userCreateCallBack = null;
			}
		});

		$("#createUseerform").on("submit",function(e){
			if(validatorCreate.valid()){
				e.preventDefault();
				$.ajax({
					method: "POST",
					url : $(this).attr('action'),
					data: $(this).serialize(),
					success:function(response){
						userCreateCallBack($.parseJSON(response));		
						userCreateCallBack = null;
						$("#createUser").modal("toggle");
					}
				});
			}
		});

		var $selectize_user_id = $("#user_id").selectize({
			valueField: "id",
			labelField: "text",
			searchField: "text",
			loadThrottle: 500,
			placeholder: "Enter user Email or Mobile number",
			preload:true,
			create: function(input,callback){
				userCreateCallBack = callback;
				resetForm(validatorCreate);
				$("#createUser").modal();
				$("#createUseerform").trigger('reset');
				///$("#useremail").val(input);
			},
			render: {
				option_create: function(data, escape) {
					return '<div class="create"><strong style="color:red;"><?=$this->lang->line('unregUser');?></strong></div>';
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
				if(isEdit){
					$("#appoitment_date").attr('disabled',true);
				}else{
					$("#appoitment_date").attr('disabled',false);
				}
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
								selectFirst($selectize_doctor_id,t_oid,t_oid);
								t_oid = null;
							}else{
								$selectize_doctor_id[0].selectize.enable();
								if(res.length > 0){
									selectFirst($selectize_doctor_id,res[0].id,res[0].text);
								}
							}

							if(isEdit){
								$selectize_doctor_id[0].selectize.disable();
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
								$selectize_branch_id[0].selectize.disable();
							}
						},
						error: function() {
							callback();
						}
					})
				});                 
			}
		});

		
		$("#sel_date").change(function(){
			var date = $("#sel_date").val();
			loadTable(date,$("#hospital_id1").val(),$("#doctor_id1").val());
		});
			
		var $selectize_doctor_id1 = $("#doctor_id1").selectize({
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
					return "<div><span class='title' style='font-size:14px'>" +
							escape(item.text)+
						"</span></div>";
				}
			},
			load: function(query, callback) {
				$.ajax({
					url: "<?php echo site_url(); ?>/doctors/search/",
					type: "GET",
					data: {"q":query,"f":""},
					error: function() {
						callback();
					},
					success: function(res) {
						callback($.parseJSON(res));
					}
				});
			},
			onChange: function(value){
				if(!value.length) return;
				loadTable($("#sel_date").val(),$("#hospital_id1").val(),$("#doctor_id1").val());
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
					}
				});
			},
			onChange: function(value) {
				if (!value.length) return;
				loadTable($("#sel_date").val(),$("#hospital_id1").val(),$("#doctor_id1").val());
			}
		});

		$("#status").change(function(){
			loadTable($("#sel_date").val(),$("#hospital_id1").val(),$("#doctor_id1").val());
		});

		$("#showClosed").change(function(){
			loadTable($("#sel_date").val(),$("#hospital_id1").val(),$("#doctor_id1").val());
		});

		function loadTable(date,hid,did){	
			var st = $("#status").val();
			var showClosed = 0;
			if($("#showClosed").is(":checked")){
				showClosed = 1;
			}
			$("#appoitments").dataTable().fnDestroy();

			var dt = $("#appoitments").DataTable({
				"processing": true,
				"serverSide": true,
				"ajax": "<?php echo site_url(); ?>/appoitments/getDTRespappoitments?hid="+hid+"&did="+did+"&d="+date+"&st="+st+"&sc="+showClosed
			});

			<?php $this->load->view('template/exdt');?>
			
			$(".dataTables_filter").attr("style","display: flex;float: right");
			//$(".dataTables_filter").append("<a class=\"btn btn-success m-b-sm addbtn\" data-toggle=\"tooltip\" title=\"Add\"  href=\"javascript:void(0);\" data-title=\"Add\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Add New</a>");
			//$(".dataTables_filter").append("<a class=\"btn btn-danger m-b-sm multiDeleteBtn\" data-at=\"charges\" data-toggle=\"tooltip\" title=\"Delete\"  href=\"javascript:void(0);\" data-title=\"Delete\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Delete</a>");
		}
		
		loadTable("","all","all");	

        setInterval(function() {
            loadTable($("#sel_date").val(),$("#hospital_id1").val(),$("#doctor_id1").val());
        }, 60000);
		
		$("#menualrefresh1").click(function(){			
			loadTable($("#sel_date").val(),$("#hospital_id1").val(),$("#doctor_id1").val());
		});
		
		var $selectize_doctor_id2 = $("#doctor_id2").selectize({
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
					return "<div><span class='title' style='font-size:14px'>" +
							escape(item.text)+
						"</span></div>";
				}
			},
			load: function(query, callback) {
				$.ajax({
					url: "<?php echo site_url(); ?>/doctors/search/",
					type: "GET",
					data: {"q":query,"f":""},
					error: function() {
						callback();
					},
					success: function(res) {
						callback($.parseJSON(res));
					}
				});
			},
			onChange: function(value){
				if(!value.length) return;
				loadTable1($("#hospital_id2").val(),$("#doctor_id2").val());
			}
		});	

		var $selectize_hospital_id2 = $("#hospital_id2").selectize({
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
				loadTable1($("#hospital_id2").val(),$("#doctor_id2").val());
			}
		});

		$("#status2").change(function(){
			loadTable1($("#hospital_id2").val(),$("#doctor_id2").val());
		});

		$("#showClosed2").change(function(){
			loadTable1($("#hospital_id2").val(),$("#doctor_id2").val());
		});
		var dt;
		function loadTable1(hid,did){	
			var st = $("#status2").val();
			var showClosed = 0;
			if($("#showClosed1").is(":checked")){
				showClosed = 1;
			}
			$("#today_appoitments").dataTable().fnDestroy();
			dt = $("#today_appoitments").DataTable({
				"processing": true,
				"serverSide": true,
				"ajax": "<?php echo site_url(); ?>/appoitments/getDTRespappoitments?tod=1&st="+st+"&hid="+hid+"&did="+did+"&sc="+showClosed
			});

			<?php $this->load->view('template/exdt');?>
			
			$(".dataTables_filter").attr("style","display: flex;float: right");
			//$(".dataTables_filter").append("<a class=\"btn btn-success m-b-sm addbtn\" data-toggle=\"tooltip\" title=\"Add\"  href=\"javascript:void(0);\" data-title=\"Add\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Add New</a>");
			//$(".dataTables_filter").append("<a class=\"btn btn-danger m-b-sm multiDeleteBtn\" data-at=\"charges\" data-toggle=\"tooltip\" title=\"Delete\"  href=\"javascript:void(0);\" data-title=\"Delete\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Delete</a>");
		}
		loadTable1("","all","all");	
		
		setInterval(function() {
            loadTable1($("#hospital_id2").val(),$("#doctor_id2").val());
        }, 60000);
		
		$("#menualrefresh").click(function(){
			loadTable1($("#hospital_id2").val(),$("#doctor_id2").val());
		});
		
		
		
	});

</script>
