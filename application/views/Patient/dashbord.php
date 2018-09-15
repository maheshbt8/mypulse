<?php
    $this->load->view('template/header.php');
    $this->load->view('template/left.php');
?>    
    <input type="hidden" id="left_active_menu" value="1" />
    <div id="main-wrapper">
    <div class="row">
        <div class="state-overview">
            <div class="col-lg-3 col-sm-6">
                <a href="<?php echo site_url();?>/patients/hospital">
                <div class="overview-panel purple">
                    <div class="symbol">
                        <i class="fa fa-hospital-o"></i>
                    </div>
                    <div class="value white">
                        <p class="sbold addr-font-h1" data-counter="counterup" data-value="<?php echo $states['tot_hos'];?>"><?php echo $states['tot_hos'];?></p>
                        <p><?php echo $this->lang->line('hospitals');?></p>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-lg-3 col-sm-6">
                <a href="<?php echo site_url();?>/patients/medicalstore">
                <div class="overview-panel green-bgcolor">
                    <div class="symbol">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="value white">
                        <p class="sbold addr-font-h1" data-counter="counterup" data-value="<?php echo $states['tot_medStore'];?>"><?php echo $states['tot_medStore'];?></p>
                        <p><?php echo $this->lang->line('medicalStoreFull');?></p>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-lg-3 col-sm-6">
                <a href="<?php echo site_url();?>/patients/medicallab">
                <div class="overview-panel orange">
                    <div class="symbol">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="value white">
                        <p class="sbold addr-font-h1" data-counter="counterup" data-value="<?php echo $states['tot_medLab'];?>"><?php echo $states['tot_medLab'];?></p>
                        <p><?php echo $this->lang->line('medicalLabFull');?></p>
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
            <div class="card">      
                <div class="card-head">
                    <header><?php echo $this->lang->line('upcomingappoitments');?></header>
                    <div class="custome_card_header">
					<a class="btn btn-success m-b-sm addbtn" data-toggle="tooltip"   href="javascript:void(0);" data-toggle="modal" data-target="#edit" style=""><?php echo $this->lang->line('buttons')['bookAppoitment'];?></a>
                    </div>
                </div>
                    
                <div class="card-body">
					<div class="col-md-12">
                                <div class="form-group col-md-3">
                                    <label><?php echo $this->lang->line('labels')['select_date'];?></label>
                                    <input id="sel_date" class=" form-control" /> 
								</div>
								<div class="form-group col-md-4">
                                    <label><?php echo $this->lang->line('labels')['status'];?></label>
                                    <select id="status" class=" form-control" >
										<option value="all"><?php echo $this->lang->line('labels')['all_except_closed'];?></option>
										<option value="0"><?php echo  $this->lang->line('labels')['pending']; ?></option>
                                		<option value="1"><?php echo  $this->lang->line('labels')['approved']; ?></option>
										<option value="4"><?php echo  $this->lang->line('labels')['canceled']; ?></option>
										<option value="3"><?php echo  $this->lang->line('labels')['closed']; ?></option>
										<!--<option value="2"><?php echo  $this->lang->line('labels')['rejected']; ?></option>-->
										<option value="all_inc_closed"><?php echo  $this->lang->line('labels')['all_include_closed']; ?></option>
                                		
					                </select>
                                </div>
							</div>
                    <table id="appoitments" class="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
                        <thead>
                            <tr>
                            <th style="width:10px"></th>
                            <th><?php echo $this->lang->line('tableHeaders')['appoitment_no'];?></th>
                            <th><?php echo $this->lang->line('tableHeaders')['hospital_branch'];?></th>
                            <th><?php echo $this->lang->line('tableHeaders')['department'];?></th>
                            <th><?php echo $this->lang->line('tableHeaders')['doctor'];?></th>
                            <th><?php echo $this->lang->line('tableHeaders')['appoitment_date'];?></th>
                            <th><?php echo $this->lang->line('tableHeaders')['appoitment_sloat'];?></th>
                            <th><?php echo $this->lang->line('tableHeaders')['status']; ?></th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        </tbody>
                    </table>  
                </div>
            </div>
        </div>    
    </div>

		<!--Recommed Next Appointment List -->
       
        <div class="row">
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
												<td>
												<a  title="Cancel" data-id='<?=$ra['id'];?>' class='delbtn' style="color:red"><i class="glyphicon glyphicon-remove"></i></a> &nbsp;
												<button class="btn btn-info bookAppointment"  data-id="<?php echo $ra['id'];?>" data-toggle="modal" data-target="#edit">Book Appointment</button>
												
												</td>
												
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
        </div>
       
	
        <!--OutStanding Prescription Orders -->
        <?php if(count($states['orders']) > 0) { ?>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-head">
                        <header><?php echo $this->lang->line('labels')['patientOutstendingOrders'];?></header>
                        <div class="custome_card_header">
                            
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="  project-stats">  
                           <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
                               <thead>
                                   <tr>
                                       <th>#</th>
                                       <th>Title</th>
                                       <th>Doctore</th>
                                       <th>Prescription</th>
                                       <th>Action</th>
                                   </tr>
                               </thead>
                               <tbody>
                                    <?php
                                        $cnt = 1;
                                        foreach($states['orders'] as $mr){
                                            ?>
                                            <tr>
                                                <th scope="row"><?=$cnt;?></th>
                                                <td><?=$mr['title'];?></td>
                                                <td><?=$mr['doctor_name'];?></td>
                                                <td><a data-url='doctors/previewprescription/<?=$mr['id'];?>' data-id='<?=$mr['id'];?>' class='previewtem'><i class="fa fa-file"></i></a></td>
                                                <td>
                                                    <a href="<?php echo site_url().'/patients/addplaceorder/'.$mr['id'];?>" data-id='<?=$mr['id'];?>' class='PlacePresOrderBtn'><i class="glyphicon glyphicon-plus"></i></a>
                                                    &nbsp; 
                                                    <a  title="Cancel" data-id='<?=$mr['id'];?>' class='CanPresOrderBtn'><i class="glyphicon glyphicon-remove"></i></a> 
                                                </td>
                                            </tr>
                                            <?php
                                            $cnt++;
                                        }
                                    ?>
                                   
                                   
                               </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

        <!--OutStanding Med Reports -->
        <?php if(count($states['medical_reports']) > 0) { ?>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                   
                    <div class="card-head">
                        <header><?php echo $this->lang->line('labels')['patientOutstendingPLT'];?></header>
                        <div class="custome_card_header">
                            
                        </div>
                    </div>
                    <div class="card-body">
                        <div class=" project-stats">  
                           <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
                               <thead>
                                   <tr>
                                       <th>#</th>
                                       <th>Title</th>
                                       <th>Description</th>
                                       <th>Action</th>
                                   </tr>
                               </thead>
                               <tbody>
                                    <?php
                                        $cnt = 1;
                                        foreach($states['medical_reports'] as $mr){
                                            ?>
                                            <tr>
                                                <th scope="row"><?=$cnt;?></th>
                                                <td><?=$mr['title'];?></td>
                                                <td><?=$mr['description'];?></td>
                                                <td><button data-toggle="modal" data-target="#selectML" class="btn btn-primary sml" data-id="<?=$mr['id'];?>">Select Medical Lab</button></td>
                                            </tr>
                                            <?php
                                            $cnt++;
                                        }
                                    ?>
                                   
                                   
                               </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div><!-- Main Wrapper -->

    <div class="modal fade" id="selectML" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
		<div class="modal-dialog modal-sm">
		    <form action="<?php echo site_url(); ?>/patients/selectml" method="post" id="form" enctype="multipart/form-data">
			    <input type="hidden" name="mrid" id="mrid">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="modal-title custom_align" id="">Select Medical Lab</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('labels')['selectCountry'];?></label>
                            <select name="country"  id="country" class=" form-control" style="width: 100%"></select>
                        </div>
                        <div class="form-group">
                            <label><?php echo $this->lang->line('labels')['selectState'];?></label>
                            <select name="state"  id="state" class=" form-control" style="width: 100%"></select>
                        </div>
                        <div class="form-group">
                            <label><?php echo $this->lang->line('labels')['selectDistrict'];?></label>
                            <select name="district"  id="district" class=" form-control" style="width: 100%"></select>
                        </div>
                        <div class="form-group">
                            <label><?php echo $this->lang->line('labels')['selectCity'];?></label>
                            <select name="city"  id="city" class=" form-control" style="width: 100%"></select>
                        </div>
                        <div class="form-group ">
                            <label><?php echo $this->lang->line('labels')['medicalLab'];?></label>
                            <select class="form-control " name="medicalLab" id="medicalLab" required />
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-defualt" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-success"  style="margin-left:10px" type="submit">Select</button>
                        
                    </div>
                </div>
            </form>
        </div>
    </div>
	
	<!--Book appointments model-->
	<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<form action="<?php echo site_url(); ?>/appoitments/add" method="post" id="apptform">
				<input type="hidden" name="eidt_gf_id" id="eidt_gf_id">
				<input type="hidden" name="recommend_id" id="recommend_id" />
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
                                    <select id="hospital_id" class=" form-control" style="width: 100%">
					                </select>
                                </div>
								<div class="form-group col-md-6">
                                    <label><?php echo $this->lang->line('labels')['selectBranch'];?></label>
                                    <select id="branch_id" class=" form-control" style="width: 100%">
					                </select>
                                </div>
							</div>
							<div class="col-md-12 hide">
								<div class="form-group col-md-6">
                                    <label><?php echo $this->lang->line('labels')['selectDepartment'];?></label>
                                    <select id="department_id" class=" form-control" style="width: 100%">
					                </select>
                                </div>
								<div class="form-group col-md-6">
									<label><?php echo $this->lang->line('labels')['selectDoctor'];?></label>
									<select id="doctor_id" class=" form-control" style="width: 100%">
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
									<input class="allowalphanumeric date-picker-nopast" type="text" placeholder="<?php echo $this->lang->line('labels')['appoitment_date'];?>" name="appoitment_date" id="appoitment_date" />
								</div>
								<div class="form-group col-md-6">
									<label><?php echo $this->lang->line('labels')['appoitment_sloat'];?></label>
									<select class="allowalphanumeric form-control" type="text" name="appoitment_sloat" id="appoitment_sloat">
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
									<textarea  class="form-control allowalphanumeric " type="text" placeholder="<?php echo $this->lang->line('labels')['patientRemarkPlace'];?>" name="remarks" id="remarks" rows="3"></textarea><br />
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
		                        <button type="button" class="btn btn-success btn-lg appt_submit" id="action-add-btn" style="width: 100%;"><span style="margin: 5px" class="fa fa-plus"></span><?php echo $this->lang->line('buttons')['bookAppoitment'];?></button>
		                    </div>

                            <div class="form-group col-md-6">
		                        <button type="button" class="btn btn-info btn-lg appt_submit"  id="action-update-btn" style="width: 100%;"><span style="margin: 5px" class="fa fa-check"></span><?php echo $this->lang->line('buttons')['update'];?></button>
		                    </div>
		                </div>
					</div>
				</div>
				</form>
			<!-- /.modal-content --> 
			</div>
		<!-- /.modal-dialog --> 
		</div>
		
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
    $this->load->view('template/footer.php');
?>
<script src="<?php echo base_url();?>public/assets/js/pages/dashboard.js"></script>

<script type="text/javascript">
    $( document ).ready(function() {
	  var _sd = "<?php echo date('Y-m-d'); ?>"; 
	  var _ed = "<?php echo date('Y-m-d'); ?>";
	  var st = $("#status").val();		  
        $("#appoitments").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "<?php echo site_url(); ?>/appoitments/getDTappoitments?&sd="+_sd+"&ed="+_ed+"&st="+st
        });
       
        var validator = $("#form").validate({
            ignore: [],
            rules: {
                medicalLab: {
                    required : true
                }
            },
            messages: {
                medicalLab:{
                    required: "<?php echo $this->lang->line('validation')['requiredMedicalLab'];?>"
                },
            },
            invalidHandler: validationInvalidHandler,
            errorPlacement: validationErrorPlacement
            
        });

        $(document).on('click','.sml',function(){
            var id = $(this).data('id');
            $("#mrid").val(id);
        });

        var loc_sid = null;
        var loc_did = null;
        var loc_cid = null; 
		var cur_v = null;
        var xhr_1;

        var $selectize_medicalLab = $("#medicalLab").selectize({
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
                if (!query.length) return callback(); 

                var cid = $("#city").val();

                $.ajax({
                    url: "<?php echo site_url(); ?>/medical_lab/search",
                    type: "GET",
                    data: {"q":query,"city":cid, "f": "name"},
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
            }
        });
        

        var $selectize_city = $("#city").selectize({
            valueField: "id",
            labelField: "name",
            searchField: "name",
            preload:true,
            create: false,
            render: {
                option: function(item, escape) {
                    return "<div><span class='title'>" +
                            escape(item.name)+
                        "</span>" +   
                    "</div>";
                }
            },
            load: function(query, callback) {
                if (!query.length) return callback(); 

                var did = $("#district").val();

                $.ajax({
                    url: "<?php echo site_url(); ?>/general/getCities",
                    type: "GET",
                    data: {"q":query,"did":did},
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
                $selectize_medicalLab[0].selectize.disable();
                $selectize_medicalLab[0].selectize.clearOptions();
                $selectize_medicalLab[0].selectize.load(function(callback) {
                    xhr_1 && xhr_1.abort();
                    xhr_1 = $.ajax({
                        url: "<?php echo site_url(); ?>/medical_lab/search/",
                        type: "GET",
                        data: {"city":value,"f":"name"},
                        success: function(results) {
                            
                            var res = $.parseJSON(results);
                            callback(res);
                            $selectize_medicalLab[0].selectize.enable();
                        },
                        error: function() {
                            callback();
                        }
                    })
                });
            }
        });

        var $selectize_district = $("#district").selectize({
            valueField: "id",
            labelField: "name",
            searchField: "name",
            preload:true,
            create: false,
            render: {
                option: function(item, escape) {
                    return "<div><span class='title'>" +
                            escape(item.name)+
                        "</span>" +   
                    "</div>";
                }
            },
            load: function(query, callback) {
                if (!query.length) return callback(); 

                var sid = $("#state").val();

                $.ajax({
                    url: "<?php echo site_url(); ?>/general/getDistricts",
                    type: "GET",
                    data: {"q":query,"sid":sid},
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

                $selectize_city[0].selectize.disable();
                $selectize_city[0].selectize.clearOptions();
                $selectize_city[0].selectize.load(function(callback) {
                    xhr_1 && xhr_1.abort();
                    xhr_1 = $.ajax({
                        url: "<?php echo site_url(); ?>/general/getCities/",
                        type: "GET",
                        data: {"did":value},
                        success: function(results) {
                            
                            var res = $.parseJSON(results);
                            callback(res);
                            if(loc_cid != null){
                                var tempselectize_city = $selectize_city[0].selectize;
                                tempselectize_city.addOption([{"id":loc_cid,"text":loc_cid}]);
                                tempselectize_city.refreshItems();
                                tempselectize_city.setValue(loc_cid);	
                                loc_cid = null;
                            }

                            $selectize_city[0].selectize.enable();
                        },
                        error: function() {
                            callback();
                        }
                    })
                });
            }
        });

        var $selectize_state = $("#state").selectize({
            valueField: "id",
            labelField: "name",
            searchField: "name",
            preload:true,
            create: false,
            render: {
                option: function(item, escape) {
                    return "<div><span class='title'>" +
                            escape(item.name)+
                        "</span>" +   
                    "</div>";
                }
            },
            onChange: function(value) {
                if (!value.length) return;

                $selectize_district[0].selectize.disable();
                $selectize_district[0].selectize.clearOptions();
                $selectize_district[0].selectize.load(function(callback) {
                    xhr_1 && xhr_1.abort();
                    xhr_1 = $.ajax({
                        url: "<?php echo site_url(); ?>/general/getDistricts/",
                        type: "GET",
                        data: {"sid":value},
                        success: function(results) {
                            
                            var res = $.parseJSON(results);
                            callback(res);
                            if(loc_did != null){
                                var tempselectize_district = $selectize_district[0].selectize;
                                tempselectize_district.addOption([{"id":loc_sid,"text":loc_did}]);
                                tempselectize_district.refreshItems();
                                tempselectize_district.setValue(loc_did);	
                                loc_did = null;
                            }
                            
                            $selectize_district[0].selectize.enable();
                        },
                        error: function() {
                            callback();
                        }
                    })
                });
            }
        });

        $selectize_state[0].selectize.disable();
        $selectize_district[0].selectize.disable();
        $selectize_city[0].selectize.disable();
        
        var $selectize_country = $("#country").selectize({
            valueField: "id",
            labelField: "name",
            searchField: "name",
            preload:true,
            create: false,
            render: {
                option: function(item, escape) {
                    return "<div><span class='title'>" +
                            escape(item.name)+
                        "</span>" +   
                    "</div>";
                }
            },
            load: function(query, callback) {
                $.ajax({
                    url: "<?php echo site_url(); ?>/general/getCountries",
                    type: "GET",
                    data: {"q":query},
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

                $selectize_state[0].selectize.disable();
                $selectize_state[0].selectize.clearOptions();
                $selectize_state[0].selectize.load(function(callback) {
                    xhr_1 && xhr_1.abort();
                    xhr_1 = $.ajax({
                        url: "<?php echo site_url(); ?>/general/getStates/",
                        type: "GET",
                        data: {"cid":value},
                        success: function(results) {
                           
                            var res = $.parseJSON(results);
                            callback(res);
                            if(loc_sid != null){
                                var tempselectize_state = $selectize_state[0].selectize;
                                tempselectize_state.addOption([{"id":loc_sid,"text":loc_sid}]);
                                tempselectize_state.refreshItems();
                                tempselectize_state.setValue(loc_sid);	
                                loc_sid = null;
                            }
                            $selectize_state[0].selectize.enable();
                            
                        },
                        error: function() {
                            callback();
                        }
                    })
                });
            }
        });

        function resetLocation(){
            $selectize_city[0].selectize.clearOptions();
            $selectize_state[0].selectize.clearOptions();
            $selectize_district[0].selectize.clearOptions();
            $selectize_country[0].selectize.clear();
        }

        var country = "<?php echo $states['profile']['country'];?>";
        var country_name = '<?php echo trim(preg_replace("/\s\s+/", " ", $states['profile']["country_name"]));?>';
        if(country != null && country!=undefined && country != "" && country > 0){
            loc_cid = "<?php echo $states['profile']['city'];?>";
            loc_did = "<?php echo $states['profile']['district'];?>";
            loc_sid = "<?php echo $states['profile']['state'];?>";
            var tempselectize_selectize_country = $selectize_country[0].selectize;
            tempselectize_selectize_country.addOption([{"id":country,"name":country_name}]);
            tempselectize_selectize_country.refreshItems();
            tempselectize_selectize_country.setValue(country);
        }
        $(document).on('click','.CanPresOrderBtn',function(){
            var id = $(this).data('id');
            var btn = $(this);
            swal({
                title: 'Are you sure?',
                text: "You want to Cancel This Order!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then(function () {
              $.ajax({
                    url: "<?php echo site_url(); ?>/patients/cancelPrescriptionOutOrder",
                    type: "GET",
                    data: {prescId:id},
                    error: function() {
                        callback();
                    },
                    success: function(res) {
                        console.log(res);
                        if(res==1){
                            toastr.success('Order Cancelled','');
                            $(btn).parents('tr').remove();
                        }
                        else{
                            toastr.error('Unable to Cancel Order','');
                        }
                    }
                });                
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

		$("#appoitment_date").change(function(){
			var d = $("#appoitment_date").val();
			var did = t_oid;
			if(did == null){
				did = $("#doctor_id").val();
			}
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
		
		var t_bid = null;
		var t_did = null;
		var t_oid = null;

		var validator_appt = $("#apptform").validate({
			ignore: [],
			rules: {
				hospital_id:{
					required: false
				},
				department_id:{
					required: false
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
			if(validator_appt.form() && appst != null && appst != undefined) {
				$("#apptform").submit();
			}
		});
		
		$(document).on("click",".bookAppointment",function(){
			
			resetForm(validator);
			$("#docAvailability").html("");
			$(".viewappthistory").hide();
			var id = $(this).attr("data-id");
			loadData(id);
			$("#form input").attr("disabled",false);
			
			<?php if($this->auth->isPatient()){
				?>
				$("#remarks").attr("disabled",true);
			<?php
			}
			?>
			
		});
		
		$(".addbtn").click(function(){
			resetForm(validator);
			$(".DoctorName").attr('readonly', false);
			$("#suggesstion-box").hide();
			$(".apptidentifier").hide();
			$(".viewappthistory").hide();
			$("#docAvailability").html("");
			$("#appoitment_sloat").html("");
			$(".DoctorName").val("");
			$(".DoctorID").val("");
			$("#appoitment_date").val("");
			$("#remarks").val("");
			$("#reason").val("");
			$("#Edit-Heading").html("<?php echo $this->lang->line('headings')['addNewAppoitment'];?>");
			$(".apptidentifier").hide();
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

        $(document).on("click",".editbtn",function(){
			resetForm(validator);
			$("#docAvailability").html("");
			var id = $(this).attr("data-id");
			$("#suggesstion-box").hide();
			$(".apptidentifier").show();
			$(".viewappthistory").show();
			$(".DoctorName").attr('readonly',true);
			$("#eidt_gf_id").val(id);
			loadDataAppt(id);
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

        function loadDataAppt(id){
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
				
				
				$("#appoitment_sloat").append('<option selected value="'+data.timesloat_val+'">'+data.timesloat_txt+'</option>');
				$("#DoctorID").val(data.doctor_id);
				$(".DoctorName").val(data.doctor_name);
				$("#reason").val(data.reason);
				//$("#appoitment_date").datepicker("setDate",data.appoitment_date);
				$("#appoitment_date").val(data.appoitment_date);
				//$("#appoitment_date").trigger("change");
				//$("#appoitment_sloat").trigger("change");

				$("#remarks").val(data.remarks);
				$(".apptidentifier").html(data.appoitment_number);
			
				$("#appoitment_date").prop("disabled", true);
				$("#reason").prop("disabled", false);
				$selectize_hospital_id[0].selectize.disable();
			});
		}

		function loadData(id){
			$.post("<?php echo site_url(); ?>/appoitments/getrecommendappoitments",{ id: id },function(data){
				var data = JSON.parse(data);
	
                
				t_bid = data.branch_id;
				t_did = data.department_id;
				t_oid = data.doctor_id;

                $("#DoctorID").val(data.doctor_id);
				$(".DoctorName").val(data.doctor_name);
                $("#recommend_id").val(id);
				var tempselectize_hospital_id = $selectize_hospital_id[0].selectize;
				tempselectize_hospital_id.addOption([{"id":data.hospital_id,"text":data.hospital_id}]);
				tempselectize_hospital_id.refreshItems();
				tempselectize_hospital_id.setValue(data.hospital_id);
				$("#appoitment_date").val(data.recommend_appointment_date);
				
				//$("#appoitment_date").datepicker("setDate",data.recommend_appointment_date);
				$selectize_hospital_id[0].selectize.disable();
			});
		}
		
		var dt;
	$(".delbtn").on("click",function(){
			var id = $(this).attr("data-id");
			var curdel = $(this);
			var s = swalDeleteConfig;
			s.text = '<?=$this->lang->line('labels')['delRecmndAppt'];?>';
			var msg = $(this).data('msg');
			if(msg!=undefined)
				s.text = msg;
			swal(s).then(function () {
				$.post("<?php echo site_url(); ?>/appoitments/cancelrecommendapptmt",{id:id},function(data){
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
		});	

function cb(start, end) {
			//console.log(start.format('MM D, YYYY') + ' - ' + end.format('MM D, YYYY'));
			//window.location.href = '<?php echo site_url();?>appoitments/report?sd='+start.format('YYYY-MM-D')+"&ed="+end.format('YYYY-MM-D');
			_sd = start.format('YYYY-MM-D');
			_ed = end.format('YYYY-MM-D');
			loadTable($("#hospital_id1").val(),$("#branch_id1").val());
		}

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
			var st = $("#status").val();
			dt = $("#appoitments").DataTable({
				"processing": true,
				"serverSide": true,
				"ajax": "<?php echo site_url(); ?>/appoitments/getDTappoitments?&sd="+_sd+"&ed="+_ed+"&hid="+hid+"&bid="+bid+"&st="+st
			});

			<?php $this->load->view('template/exdt');?>

			$(".dataTables_filter").attr("style","display: flex;float: right");
			//$(".dataTables_filter").append("<a class=\"btn btn-success m-b-sm addbtn\" data-toggle=\"tooltip\" title=\"Add\"  href=\"javascript:void(0);\" data-title=\"Add\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Add New</a>");
			//$(".dataTables_filter").append("<a class=\"btn btn-danger m-b-sm multiDeleteBtn\" data-at=\"charges\" data-toggle=\"tooltip\" title=\"Delete\"  href=\"javascript:void(0);\" data-title=\"Delete\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Delete</a>");
		}
$("#status").change(function(){
			loadTable($("#hospital_id1").val(),$("#doctor_id1").val());
		});		

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
	 //$("#appthistory").modal({backdrop: "static"});
	 
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