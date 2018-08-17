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
                    </div>
                </div>
                    
                <div class="card-body">
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
        <?php if(count($states['recommend_appointment']) > 0) { ?>
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
                                   
                                   
                               </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
	
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
                        <h4 class="modal-title custom_align" id="Edit-Heading">Select Medical Lab</h4>
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
				<input type="hidden" name="doctor_id" id="hd_doctor_id" />
                <input type="hidden" name="department_id" id="hd_department_id" />
                <input type="hidden" name="recommend_id" id="recommend_id" />
				<div class="modal-content">
				  	<div class="modal-header">
					  	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					  	<h4 class="modal-title custom_align" id="Edit-Heading"><?php echo $this->lang->line('labels')['bookAppoitment'];?></h4>
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

<?php
    $this->load->view('template/footer.php');
?>
<script src="<?php echo base_url();?>public/assets/js/pages/dashboard.js"></script>

<script type="text/javascript">
    $( document ).ready(function() {

        $("#appoitments").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "<?php echo site_url(); ?>/appoitments/getDTappoitments?up=1"
        });
        $(".dataTables_filter").hide();

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
			$.post("<?php echo site_url(); ?>/appoitments/getNewSloat",{date:d,did:did},function(data){
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
			if(validator_appt.form() && appst != null && appst != undefined) {
				$("#apptform").submit();
			}
		});
		
		$(document).on("click",".bookAppointment",function(){
			
			resetForm(validator);
			$("#docAvailability").html("");
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

        $(document).on("click",".editbtn",function(){
			resetForm(validator);
			$("#docAvailability").html("");
			var id = $(this).attr("data-id");
			$("#eidt_gf_id").val(id);
			loadDataAppt(id);
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
				$("#reason").val(data.reason);
				$("#appoitment_date").datepicker("setDate",data.appoitment_date);
				$("#appoitment_date").val(data.appoitment_date);
				$("#appoitment_date").trigger("change");

				$("#remarks").val(data.remarks);
			
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

                $("#hd_doctor_id").val(data.doctor_id);
                $("#hd_department_id").val(data.department_id);
                $("#recommend_id").val(id);
				var tempselectize_hospital_id = $selectize_hospital_id[0].selectize;
				tempselectize_hospital_id.addOption([{"id":data.hospital_id,"text":data.hospital_id}]);
				tempselectize_hospital_id.refreshItems();
				tempselectize_hospital_id.setValue(data.hospital_id);
				
				
				$("#appoitment_date").datepicker("setDate",data.recommend_appointment_date);
				$selectize_hospital_id[0].selectize.disable();
			});
		}
		
		var dt;
	$(".delbtn").on("click",function(){
			var id = $(this).attr("data-id");
			var curdel = $(this);
			var s = swalDeleteConfig;
			s.text = '<?=$this->lang->line('labels')['delSureAppt'];?>';
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
		
		
    });
</script>