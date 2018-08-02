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
        <?php /*?><div class="row">
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
            
           
        </div><?php */?>
    </div><!-- Main Wrapper -->

    <?php /*?><div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
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
		</div><?php */?>
		
		<div id="main-wrapper">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="card">
	                    
	                    <div class="card-head clearfix">
							<header><?php echo $this->lang->line('upcomingappoitments');?></header>
							<div class="custome_card_header" style="">
								<a class="btn btn-success m-b-sm" id="bookNew" data-toggle="tooltip" href="javascript:void(0);" data-toggle="modal" data-target="#edit" style=""><?php echo $this->lang->line('buttons')['bookAppoitment'];?></a>
								<?php /*?><a class="btn btn-info m-b-sm multiApprBtn" data-msg="<?=$this->lang->line('msg_want_to_approve_appts');?>" data-at="appoitments"  href="javascript:void(0);"  style="margin-left:10px"><?php echo $this->lang->line('buttons')['approve'];?></a>
								<a class="btn btn-danger m-b-sm multiCancelBtn" data-msg="<?=$this->lang->line('msg_want_to_reject_appts');?>" data-at="appoitments"  href="javascript:void(0);"  style="margin-left:10px"><?php echo $this->lang->line('buttons')['reject'];?></a>
								<?php $this->load->view('template/exbtn');?><?php */?>
							</div>
	                    </div>
	                    <div class="card-body ">
							<div class="col-md-12">
                                <div class="form-group col-md-4">
                                    <label><?php echo $this->lang->line('labels')['select_date'];?></label>
                                    <input id="sel_date" class=" form-control" /> 
                                </div>
								<div class="form-group col-md-4">
                                    <label><?php echo $this->lang->line('labels')['selectHospital'];?></label>
                                    <select id="hospital_id1" class=" form-control" style="width: 100%">
										<option value="all"><?php echo $this->lang->line('labels')['all'];?></option>
					                </select>
                                </div>
								<div class="form-group col-md-4">
                                    <label><?php echo $this->lang->line('labels')['status'];?></label>
                                    <select id="status" class=" form-control" style="width: 100%">
										<option value="all"><?php echo $this->lang->line('labels')['all_except_closed'];?></option>
										<!--<option value="0"><?php echo  $this->lang->line('labels')['pending']; ?></option>-->
                                		<option value="1"><?php echo  $this->lang->line('labels')['approved']; ?></option>
										<option value="4"><?php echo  $this->lang->line('labels')['canceled']; ?></option>
										<option value="3"><?php echo  $this->lang->line('labels')['closed']; ?></option>
										<!--<option value="2"><?php echo  $this->lang->line('labels')['rejected']; ?></option>-->
										<option value="all_inc_closed"><?php echo  $this->lang->line('labels')['all_include_closed']; ?></option>
					                </select>
                                </div>
								<!--<div class="col-md-12">
									<div class="checkbox checkbox-icon-black pull-right">
										<input type="checkbox" id="showClosed">
										<label for="showClosed">
											<?php echo $this->lang->line('labels')['ShowClosedAppt'];?>
										</label>
									</div>
								</div>-->
                            </div>
							<div class="col-md-12">
								<div class="">
									<table id="appoitments" class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" >
										<thead>
											<tr>
												<th style="width:10px"></th>
												<th><?php echo $this->lang->line('tableHeaders')['appoitment_no'];?></th>
												<th><?php echo $this->lang->line('tableHeaders')['patient'];?></th>
												<th><?php echo $this->lang->line('tableHeaders')['reason'];?></th>
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
								<div class="form-group col-md-6">
									<label>User</label>
									<select name="user_id" id="user_id" class="form-control" style="width: 100%;">
									</select>
								</div>
								<input type="hidden" name="doctor_id" id="doctor_id" value="<?php echo $this->auth->getDoctorId();?>" />
								<div class="form-group col-md-6">
									<label><?php echo $this->lang->line('labels')['doctorAvailability'];?></label>
									<br>
									<span id="docAvailability"></span>
								</div>
								<div class="form-group col-md-6 hide">
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
								
							</div>
								
							<div class="col-md-12">
								<div class="form-group col-md-6">
									<label><?php echo $this->lang->line('labels')['appoitment_date'];?></label>
									<input class="form-control allowalphanumeric  date-picker-nopast" type="text" placeholder="<?php echo $this->lang->line('labels')['appoitment_date'];?>" name="appoitment_date" id="appoitment_date" />
								</div>
								<div class="form-group col-md-6">
									<label><?php echo $this->lang->line('labels')['appoitment_sloat'];?></label>
									<select class="form-control allowalphanumeric" type="text" name="appoitment_sloat" id="appoitment_sloat">
									</select>
									<br>
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
					  	<h4 class="modal-title custom_align" id="Edit-Heading"><?=$this->lang->line('unregUser');?></h4>
					</div>
				  	<div class="modal-body">
				  		<div class="row">
							<div class="form-group col-md-12">
								<label><?=$this->lang->line('labels')['fname']?>*</label>
								<input name="first_name" id="first_name" class="form-control"  placeholder="First Name"/>
							</div><br>
							<div class="form-group col-md-12">
								<label><?=$this->lang->line('labels')['lname']?>*</label>
								<input name="last_name" id="last_name" class="form-control"  placeholder="Last Name"/>
							</div><br>
							<div class="form-group col-md-12">
								<label><?=$this->lang->line('labels')['mobile']?>*</label>
								<input name="mobile" id="mobile" class="form-control"  placeholder="Mobile"/>
							</div><br>
							<div class="form-group col-md-12">
								<label><?=$this->lang->line('labels')['user_email']?></label>
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
<script src="<?php echo base_url();?>public/assets/js/pages/dashboard.js"></script>
<?php /*?><script>
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
</script><?php */?>
<script type="text/javascript">
		
	$(document).ready(function(){
		$(".js-example-basic-multiple").select2();

		var _sd = "<?php echo date('Y-m-d'); ?>"; 
		var _ed = "<?php echo date('Y-m-d'); ?>";
		
		
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
					//required:true,
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
					//required: "<?php echo $this->lang->line('validation')['requiredEmail'];?>",
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


		$.get("<?php echo site_url(); ?>/doctors/getAvailabilityText",{id:$("#doctor_id").val()},function(data){
			$("#docAvailability").html(data);
		});
		$("#appoitment_date").attr('disabled',false);
	
		$("[data-toggle=tooltip]").tooltip();

		$("#bookNew").click(function(){
			resetForm(validator);
			
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
			isEdit = false;
			$selectize_department_id[0].selectize.disable();
			$selectize_department_id[0].selectize.clear();
			$selectize_branch_id[0].selectize.disable();
			$selectize_branch_id[0].selectize.clear();
			$selectize_hospital_id[0].selectize.enable();
			$selectize_hospital_id[0].selectize.clear();
			$selectize_user_id[0].selectize.enable();
			$selectize_user_id[0].selectize.clear();
			//$("#appoitment_date").attr('disabled',true);
			$("#appoitment_sloat").attr('disabled',true);
			$("#appoitment_sloat").html('');
			$("#reason").attr('disabled',false);
		});

		$(".addbtn").click(function(){
			resetForm(validator);
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
			$selectize_department_id[0].selectize.disable();
			$selectize_department_id[0].selectize.clear();
			$selectize_branch_id[0].selectize.disable();
			$selectize_branch_id[0].selectize.clear();
			$selectize_hospital_id[0].selectize.clear();
			$("#appoitment_date").attr('disabled',true);
			$("#appoitment_sloat").attr('disabled',true);
		});

		$("#appoitments").on("click",".editbtn",function(){
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
							// 	var temp = selected[i];
                            //     $($("#apprlink_"+id).parents('td').siblings()[6]).html('<span class="label label-primary"><?php echo $this->lang->line("labels")["approved"]?></span>');
							// }
							toastr.success("<?php echo $this->lang->line('headings')['approvedSuccess'];?>");
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
							// 	var temp = selected[i];
							// 	$($("#dellink_"+temp).parents('td').siblings()[6]).html('<span class="label label-danger"><?php echo $this->lang->line("labels")["rejected"]?></span>');
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

		/*$("#user_id").select2({
			ajax: {
				url: "<?php echo site_url(); ?>/users/searchPatient/",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						q: params.term,
					};
				},
				processResults: function (data, params) {
					return {
						results: data.items,
						pagination: {
							more: false
						}
					};
				},
				cache: true
			},
			escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
			minimumInputLength: 1,
			templateResult: formatRepo, // omitted for brevity, see the source of this page
			templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
		});*/

		function formatRepo (repo) {
			if (repo.loading) return repo.text;
			var markup = "<div><span class='title'>" +repo.text+"</span></div>"
			return markup;
		}

		function formatRepoSelection (user) {
			return user.text;
		}

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
			placeholder: "Enter User Email or Mobile number",
			preload:true,
			create: function(input,callback){
				userCreateCallBack = callback;
				resetForm(validatorCreate);
				$("#createUser").modal();
				$("#createUseerform").trigger('reset');
				//$("#useremail").val(input);
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

		/*var $selectize_doctor_id = $("#doctor_id").selectize({
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
			}
		});*/

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

		
		$("#sel_date").change(function(){
			var date = $("#sel_date").val();
			loadTable($("#hospital_id1").val());
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
				loadTable($("#hospital_id1").val());
			}
		});

		$("#status").change(function(){
			loadTable($("#hospital_id1").val());
		});
			
		$("#showClosed").change(function(){
			loadTable($("#hospital_id1").val());
		});

		var dt;
		function loadTable(hid){	
			var st = $("#status").val();
			var showClosed = 0;
			if($("#showClosed").is(":checked")){
				showClosed = 1;
			}
			$("#appoitments").dataTable().fnDestroy();
				dt = $("#appoitments").DataTable({
					"processing": true,
					"serverSide": true,
					"ajax": "<?php echo site_url(); ?>/appoitments/getDTDocpappoitments?hid="+hid+"&sd="+_sd+"&ed="+_ed+"&st="+st+"&sc="+showClosed
			});

			<?php $this->load->view('template/exdt');?>

			$(".dataTables_filter").attr("style","display: flex;float: right");
			//$(".dataTables_filter").append("<a class=\"btn btn-success m-b-sm addbtn\" data-toggle=\"tooltip\" title=\"Add\"  href=\"javascript:void(0);\" data-title=\"Add\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Add New</a>");
			//$(".dataTables_filter").append("<a class=\"btn btn-danger m-b-sm multiDeleteBtn\" data-at=\"charges\" data-toggle=\"tooltip\" title=\"Delete\"  href=\"javascript:void(0);\" data-title=\"Delete\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Delete</a>");
		}
		
		function cb(start, end) {
			//console.log(start.format('MM D, YYYY') + ' - ' + end.format('MM D, YYYY'));
			//window.location.href = '<?php echo site_url();?>appoitments/report?sd='+start.format('YYYY-MM-D')+"&ed="+end.format('YYYY-MM-D');
			_sd = start.format('YYYY-MM-D');
			_ed = end.format('YYYY-MM-D');
			loadTable($("#hospital_id1").val());
		}
		
		//var start = moment().subtract(29, 'days');
		var start = moment().subtract(0, 'days');
		var end = moment();
		
		$('#sel_date').daterangepicker({
			startDate: start,
			endDate: end,
			locale: { 
				applyLabel : '<?php echo $this->lang->line('apply');?>',
				cancelLabel: '<?php echo $this->lang->line('clear');?>',
				"customRangeLabel": "<?php echo $this->lang->line('custom');?>",
			},  
			/*Previous dates data*/
			/*ranges: {
				'<?php echo $this->lang->line('today');?>': [moment(), moment()],
				'<?php echo $this->lang->line('yesterday');?>': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				'<?php echo $this->lang->line('last_7_day');?>': [moment().subtract(6, 'days'), moment()],
				'<?php echo $this->lang->line('last_30_day');?>': [moment().subtract(29, 'days'), moment()],
				'<?php echo $this->lang->line('this_month');?>': [moment().startOf('month'), moment().endOf('month')],
				'<?php echo $this->lang->line('last_month');?>': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			}*/
			/* future dates data*/
			ranges: {
				'<?php echo $this->lang->line('today');?>': [moment(), moment()],
				'<?php echo $this->lang->line('tomorrow');?>': [moment().add(1, 'days'), moment().add(1, 'days')],
				'<?php echo $this->lang->line('next_7_day');?>': [moment().add(1, 'days'), moment().add(7, 'days')],
				'<?php echo $this->lang->line('next_30_day');?>': [moment().add(1, 'days'), moment().add(30, 'days')],
				'<?php echo $this->lang->line('this_month');?>': [moment().startOf('month'), moment().endOf('month')],
				'<?php echo $this->lang->line('next_month');?>': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf('month')]
			}
		},cb);
		
		$('#sel_date').on('cancel.daterangepicker', function(ev, picker) {
			//do something, like clearing an input
			$('#sel_date').val('');
			_sd = "";
			_ed = "";
			loadTable($("#hospital_id1").val());
		});
		
		$("#sel_date").val("");	
		loadTable("all");

	});

</script>