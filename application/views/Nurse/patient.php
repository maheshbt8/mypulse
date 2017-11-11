<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
$this->load->view("template/header.php");
$this->load->view("template/left.php");
?>
		<input type="hidden" id="left_active_menu" value="6" />
		<div id="main-wrapper">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="card">
	                    <div class="card-head">
							<header><?php echo $this->lang->line('patients');?></header>
							<div class="custome_card_header">
								 <a class="btn btn-primary m-b-sm " id="editBtn" style="display:none" data-toggle="tooltip" href="javascript:void(0);" ><?php echo $this->lang->line('buttons')['edit'];?></a>
                                <a class="btn btn-success m-b-sm " style="display:none" id="addPrescriptionBtn" data-toggle="tooltip" href="javascript:void(0);" ><?php echo $this->lang->line('buttons')['newPrescription'];?></a>
                                <!-- <a class="btn btn-success m-b-sm " style="display:none" id="inPatientBtn" data-toggle="tooltip" href="javascript:void(0);" ><?php echo $this->lang->line('buttons')['newpatient'];?></a> -->
                                <a class="btn btn-success m-b-sm " style="display:none" id="add_noteBtn" data-toggle="modal" data-target="#AddNewNote" href="javascript:void(0);" ><?php echo $this->lang->line('buttons')['new_note'];?></a>&nbsp
                                <button type="button" id="canPatientBtnHist" class="btn btn-warning pull-right" style="display:none"><i class="fa fa-remove"></i> &nbsp; Cancel</button>
                                <a class="btn btn-default m-b-sm " id="cancelBtn" data-toggle="tooltip" style="display:none" href="javascript:void(0);" ><?php echo $this->lang->line('buttons')['cancel'];?></a>
							</div>
						</div>
	                    <div class="card-body ">
	                        <div class="col-md-12">
                                <div class="col-md-12" id="inpatient_filters">
                                    <div class="form-group col-md-4">
                                        <label><?php echo $this->lang->line('labels')['select_join_date'];?></label>
                                        <input id="sel_join_date" class="dates form-control" /> 
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label><?php echo $this->lang->line('labels')['select_left_date'];?></label>
                                        <input id="sel_left_date" class="dates form-control" /> 
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label><?php echo $this->lang->line('labels')['status'];?></label>
                                        <select id="status" class=" form-control" style="width: 100%">
                                            <option value=""><?php echo $this->lang->line('labels')['all'];?></option>
                                            <option value="0"><?php echo  $this->lang->line('labels')['notAdmitted']; ?></option>
                                            <option value="1"><?php echo  $this->lang->line('labels')['admitted']; ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class=""  id="patientRecordTbl" >
                                    <table id="patients" class="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
                                        <thead>
                                            <tr>
                                                <th style="width:10px"></th>
                                                <th><?php echo $this->lang->line('tableHeaders')['name'];?></th>								
                                                <th><?php echo $this->lang->line('tableHeaders')['doctor'];?></th>
                                                <th><?php echo $this->lang->line('tableHeaders')['join_date'];?></th>
                                                <th><?php echo $this->lang->line('tableHeaders')['reason'];?></th>
                                                <th><?php echo $this->lang->line('tableHeaders')['bed'];?></th>
                                                <th><?php echo $this->lang->line('tableHeaders')['status'];?></th>
                                                <th><?php echo $this->lang->line('tableHeaders')['action'];?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>  
                                </div>
                                <div class="t" id="inPatientTblDiv" style="display: none;">
                                    <table id="inPatientTbl" class="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
                                        <thead>
                                            <tr>
                                                <th style="width:10px"></th>
                                                <th><?php echo $this->lang->line('tableHeaders')['bed no'];?></th>
                                                <th><?php echo $this->lang->line('tableHeaders')['join_date'];?></th>
                                                <th><?php echo $this->lang->line('tableHeaders')['left_date'];?></th>
                                                <th><?php echo $this->lang->line('tableHeaders')['reason'];?></th>
                                                <th><?php echo $this->lang->line('tableHeaders')['status'];?></th>
                                                <th><?php echo $this->lang->line('tableHeaders')['action'];?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    
                                </div>
                                <div class="" id="inPatientTblHistoryDiv" style="display: none;">
                                    <div class="Histry_record" style="margin-left: 50px;">                                              
                                        <h4>Bed :  <small id="bed_no"></small></h4>
                                        <h4>Join-Date:  <small id="jdate"></small></h4>
                                        <h4>Status:  <small id="hs_status"></small></h4>
                                        <h4>Reason:  <small id="hs_reason"></small></h4>
                                        <!-- <h4>Left-Date:  <small id="hs_ldate"></small></h4> -->
                                    </div>
                                        <table id="inPatientTblHistory" class="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
                                        <thead>
                                            <tr>
                                                <th style="width:10px"></th>
                                                <th><?php echo $this->lang->line('tableHeaders')['note'];?></th>
                                                <th><?php echo $this->lang->line('tableHeaders')['date'];?></th>
                                                <th><?php echo $this->lang->line('tableHeaders')['action'];?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>                                                
                                    </table>
                                </div>
                            </div>
                            <div class="row" id="inPatientDiv" style="display:none">
                                <div class="col-md-12"> 
                                    <form id="patientform" method="post" action="<?php echo site_url();?>/nurse/addinpatient">
                                    <!-- <input type="hidden" name="patient_id" value="<?php echo $profile['id'];?>" /> -->
                                        <input type="hidden" name="inpatient_update_id" id="inpatient_id" />
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="Patientbed"><?php echo $this->lang->line('labels')['bed']; ?></label>
                                                <select id="Patientbed" class="form-control" name="Patientbed" id="Patientbed">
                                                </select>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="JoinDate"><?php echo $this->lang->line('labels')['join_date']; ?></label>
                                                <input type="text" class="form-control date-picker" name="join_date" id="datepicker">
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="PatientStatus"><?php echo $this->lang->line('labels')['patientStatus']; ?></label>
                                                <select class="form-control" name="ptStatus" id="ptStatus">
                                                    <option selected value="0">Not Admitted</option>
                                                    <option value="1">Admitted</option>
                                                    <option value="2">Discharged</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="PatientReason"><?php echo $this->lang->line('labels')['reason']; ?></label>
                                                <textarea class="form-control"  rows="6" name="inPatientReason" id="patient_reason"></textarea>
                                            </div>
                                            <br>
                                            <div class="form-group">                                  
                                                <button type="button" id="canPatientBtn" class="btn btn-warning pull-right"><i class="fa fa-remove" ></i>Cancel
                                                </button>
                                                <button type="submit" class="btn btn-success pull-right" name="inpatient_up_form" id="inpatient_update" style="margin-right: 10px"><i class="fa fa-check"></i> Save</button>
                                            </div>
                                        </div>
                                    </form>  
                                </div>    
                            </div>
	                    </div>
	                </div>
	            </div>
	        </div>                        
	    </div><!-- Main Wrapper -->
        <div class="modal fade" id="AddNewNote" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">
                            Add New Note
                        </h4>
                    </div>
                
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form method="post" action="<?php echo site_url(); ?>/inpatient/add_noteByNurse" class="form-horizontal" role="form" id="new_noteform">
                            <input type="hidden" name="hsinpatientadd_id" id="hsinpatientadd_id">
                            <input type="hidden" name="hsinpatientEdit_id" id="hsinpatientEdit_id">
                            <div class="form-group">
                                <label  class="col-sm-2 control-label" for="">New Note</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="new_note"   id="Hsnew_note" placeholder="Write Note" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button  type="submit" class="btn btn-primary" >
                                    <i class="glyphicon glyphicon-plus"></i> Save </button>
                                <button type="button" class="btn btn-warning" data-dismiss="modal">
                                    <i class="fa fa-remove"></i>  Cancel 
                                </button>                    
                            </div>
                        </form>                  
                    </div>
                
                    <!-- Modal Footer -->
                    <div class="modal-footer">                
                    </div>
                </div>
            </div>
        </div>
		
<?php $this->load->view("template/footer.php"); ?>
    <script type="text/javascript">
		
        $(document).ready(function(){
            
            var _j_sd = "";
            var _j_ed = "";
            var _l_sd = "";
            var _l_ed = "";
            var isShowIn = "";
            var intPatId = "";
            <?php
            
            if(isset($_GET['sip']) && $_GET['sip'] != ""){	
            ?>
                isShowIn = '<?php echo $_GET['sip']; ?>';
                
            <?php 
            }
            ?>
            <?php
            if(isset($_GET['pid']) && $_GET['pid'] != ""){	
            ?>
                intPatId = '<?php echo $_GET['pid']; ?>';
                
            <?php 
            }
            ?>
            
            console.log(isShowIn);
            console.log(isShowIn==1);
            console.log(isShowIn=="1");
            
            if(isShowIn=="1"){
                $.post("<?php echo site_url();?>/inpatient/getinpatient",{id : intPatId}, function(data){
                    data = JSON.parse(data);
                    console.log(data);
                
                    //Show Inpatient
                    var patient_id= intPatId;
                    $('#hsinpatientadd_id').val(patient_id);
                    $('#inPatientTblDiv').hide();
                    $('#inpatient_filters').hide();
                    $('#patientRecordTbl').hide();
                    $('#inPatientTblHistoryDiv').show();
                    var bed_no = data.bed_name;
                    var hs_jdate = data.join_date;
                    var hs_status = data.status_txt;
                    var hs_reason = data.reason;
                    $('#bed_no').text(bed_no);
                    $('#jdate').text(hs_jdate);
                    $('#hs_status').text(hs_status);
                    $('#hs_reason').text(hs_reason);
                    //   row.find(".historyinpatient").hide();
                    //   $('#inPatientTblDiv').hide();
                    $('#canPatientBtnHist').show();
                    // $('#inPatientBtn').hide();
                    $("#add_noteBtn").show();
                    // $('#inPatientTblHistoryDiv').show();

                    $("#inPatientTblHistory").dataTable().fnDestroy();
                    $('#inPatientTblHistory').DataTable({ 
                        "processing": true,
                        "serverSide": true,
                        "paging":   true,
                        "ordering": false,
                        "info":     false,
                        "ajax": {
                                "url":'<?php echo site_url();?>/inpatient/getDTHistoryinpatient/'+patient_id,
                                }              
                    });

                    $("#inPatientTblHistory_filter").hide();
                    $("#inPatientTblHistory_length").hide();
                
                });
            }
            
            var branch_id = null;
            var department_id = null;
            
            function loadTable(){

                var st = $("#status").val();
                $("#patients").dataTable().fnDestroy();
                $("#patients").DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "<?php echo site_url(); ?>/nurse/getDTPatient?j_sd="+_j_sd+"&j_ed="+_j_ed+"&l_sd="+_l_sd+"&l_ed="+_l_ed+"&st="+st
                });

                $(".dataTables_filter").attr("style","display: flex;float: right");
                //$(".dataTables_filter").append("<a class=\"btn btn-success m-b-sm addbtn\" data-toggle=\"tooltip\" title=\"Add\"  href=\"javascript:void(0);\" data-title=\"Add\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Add New</a>");
                //$(".dataTables_filter").append("<a class=\"btn btn-danger m-b-sm multiDeleteBtn\" data-at=\"doctors\" data-toggle=\"tooltip\" title=\"Delete\"  href=\"javascript:void(0);\" data-title=\"Delete\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Delete</a>");
            }

            $("[data-toggle=tooltip]").tooltip();

            //     $(document).on('click','.InPatientBtn',function(){
            //     	     $('#inPatientTblDiv').show();
            //     	     $('#patientRecordTbl').hide();
            //              var inpatient_id = $(this).data('id');                          
                        // $("#inPatientTblHistory").DataTable({
                        //     "processing": true,
                        //     "serverSide": true,
                        //     "paging":   true,
                        //     "ordering": false,
                        //     "info":     false,
                        //     "ajax": '<?php echo site_url();?>/inpatient/getDTPatientinpatient/'+inpatient_id
                        // });
                        // $("#inPatientTbl_filter").hide();
                        // $("#inPatientTbl_length").hide();
            //             });
            
            $(document).on('click','.historyinpatient',function(){
                var patient_id= $(this).data('id');
                $('#hsinpatientadd_id').val(patient_id);
                $('#inPatientTblDiv').hide();
                $('#inpatient_filters').hide();
                $('#patientRecordTbl').hide();
                $('#inPatientTblHistoryDiv').show();
                var bed_no = $(this).data('bno');
                var hs_jdate = $(this).data('jdate');
                var hs_status = $(this).data('status');
                var hs_reason = $(this).data('reason');
                $('#bed_no').text(bed_no);
                $('#jdate').text(hs_jdate);
                $('#hs_status').text(hs_status);
                $('#hs_reason').text(hs_reason);
                //   row.find(".historyinpatient").hide();
                //   $('#inPatientTblDiv').hide();
                $('#canPatientBtnHist').show();
                // $('#inPatientBtn').hide();
                $("#add_noteBtn").show();
                // $('#inPatientTblHistoryDiv').show();

                $("#inPatientTblHistory").dataTable().fnDestroy();
                    $('#inPatientTblHistory').DataTable({ 
                    "processing": true,
                    "serverSide": true,
                    "paging":   true,
                    "ordering": false,
                    "info":     false,
                    "ajax": {
                        "url":'<?php echo site_url();?>/inpatient/getDTHistoryinpatient/'+patient_id,
                            }              
                });

                $("#inPatientTblHistory_filter").hide();
                $("#inPatientTblHistory_length").hide(); 

            }); 

            var $selectize_bed_id = $("#Patientbed").selectize({
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
                        url: "<?php echo site_url(); ?>/beds/search",
                        type: "GET",
                        data: {"q":query,"f":"bed"},
                        error: function() {
                            callback();
                        },
                        success: function(res) {
                            callback($.parseJSON(res));
                        }
                    });
                }
            });

            $(document).on('click','.editinpatient',function(){
                var id = $(this).data('id');
                $('#inpatient_id').val(id);
                $("#inPatientDiv").show(); 
                $('#inpatient_filters').hide();  
                $('#patientRecordTbl').hide();
                // $("#inPatientTbl").hide();
                $("#inPatientBtn").hide();

                $("#tabDiv").hide();
                $("#inPatientTblDiv").hide(); 
                // $("#inPatientDiv").hide(); 
                $("#div_title").html('Edit Inpatient');       
                $("#inpatient_update").html("Update");
                $.ajax({
                        url: "<?php echo site_url(); ?>/inpatient/getinpatient/",
                        type: "POST",
                        data: {id:id},
                        error: function() {
                            callback();
                        },
                        success: function(res) {
                            console.log(res);
                            var inpatient_data = $.parseJSON(res);
                            if(inpatient_data.bed_id > 0){
                                var tempselectize_bed_ID = $selectize_bed_id[0].selectize;
                                tempselectize_bed_ID.addOption([{"id":inpatient_data.bed_id,"text":inpatient_data.bed_name}]);
                                tempselectize_bed_ID.refreshItems();
                                tempselectize_bed_ID.setValue(inpatient_data.bed_id);
                            }
                            $('#datepicker').val(inpatient_data.join_date);
                            $('#ptStatus').val(inpatient_data.status);
                            $('#patient_reason').val(inpatient_data.reason); 
                            $( "#patient_reason" ).prop( "disabled", true );
                            $( "#ptStatus" ).prop( "disabled", true );
                            $( "#datepicker" ).prop( "disabled", true );
                        //   callback($.parseJSON(res));
                        }
                    });
                // }
            });

            $(document).on('click','.editinpatientHistory',function(){
                var inpHisEdit_id = $(this).data('id');
                var inpHisEdit_note = $(this).data('note');
                $('#hsinpatientEdit_id').val(inpHisEdit_id);
                $('#Hsnew_note').val(inpHisEdit_note);
            }); 

            $('#canPatientBtnHist').click(function(){
                $('#canPatientBtnHist').hide();
                $('#add_noteBtn').hide();		          
                $('#inPatientTblDiv').hide();
                $('#inPatientTblHistoryDiv').hide();
                $('#inpatient_filters').show();
                $('#patientRecordTbl').show(); 
            });

            $("#canPatientBtn").click(function(){
                $("#inPatientBtn").show();
                $("#inPatientDiv").hide();
                $('#inpatient_filters').show();
                $('#patientRecordTbl').show();
                $("#div_title").html("<?php echo $this->lang->line('newPatient');?>");
            });

            var validator = $("#new_noteform").validate({
                ignore: [],
                rules: {
                    
                    new_note: {
                        required : true
                    }
                },
                messages: {                
                    new_note:{
                        required: "<?php echo $this->lang->line('validation')['requiredNote'];?>"
                    }                
                },
                invalidHandler: validationInvalidHandler,
                errorPlacement: validationErrorPlacement
            });

            $('#add_noteBtn').click(function(){
                $("form").trigger("reset");
            });

            $("#status").change(function(){
					loadTable();
				});

				function cb(j_start, j_end) {
					//console.log(start.format('MM D, YYYY') + ' - ' + end.format('MM D, YYYY'));
					//window.location.href = '<?php echo site_url();?>appoitments/report?sd='+start.format('YYYY-MM-D')+"&ed="+end.format('YYYY-MM-D');
					_j_sd = j_start.format('YYYY-MM-D');
					_j_ed = j_end.format('YYYY-MM-D');
					loadTable();
				}

				function cb1(l_start, l_end) {
					//console.log(start.format('MM D, YYYY') + ' - ' + end.format('MM D, YYYY'));
					//window.location.href = '<?php echo site_url();?>appoitments/report?sd='+start.format('YYYY-MM-D')+"&ed="+end.format('YYYY-MM-D');
					_l_sd = l_start.format('YYYY-MM-D');
					_l_ed = l_end.format('YYYY-MM-D');
					loadTable();
				}

				var j_start = moment().subtract(29, 'days');
				var j_end = moment();
				var l_start = moment().subtract(29, 'days');
				var l_end = moment();

				$('#sel_join_date').daterangepicker({
					startDate: j_start,
					endDate: j_end,
					locale: { 
						applyLabel : '<?php echo $this->lang->line('apply');?>',
						cancelLabel: '<?php echo $this->lang->line('clear');?>',
						"customRangeLabel": "<?php echo $this->lang->line('custom');?>",
					},  
					ranges: {
						'<?php echo $this->lang->line('today');?>': [moment(), moment()],
						'<?php echo $this->lang->line('yesterday');?>': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
						'<?php echo $this->lang->line('last_7_day');?>': [moment().subtract(6, 'days'), moment()],
						'<?php echo $this->lang->line('last_30_day');?>': [moment().subtract(29, 'days'), moment()],
						'<?php echo $this->lang->line('this_month');?>': [moment().startOf('month'), moment().endOf('month')],
						'<?php echo $this->lang->line('last_month');?>': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
					}
				},cb);

				$('#sel_left_date').daterangepicker({
					startDate: l_start,
					endDate: l_end,
					locale: { 
						applyLabel : '<?php echo $this->lang->line('apply');?>',
						cancelLabel: '<?php echo $this->lang->line('clear');?>',
						"customRangeLabel": "<?php echo $this->lang->line('custom');?>",
					},  
					ranges: {
						'<?php echo $this->lang->line('today');?>': [moment(), moment()],
						'<?php echo $this->lang->line('yesterday');?>': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
						'<?php echo $this->lang->line('last_7_day');?>': [moment().subtract(6, 'days'), moment()],
						'<?php echo $this->lang->line('last_30_day');?>': [moment().subtract(29, 'days'), moment()],
						'<?php echo $this->lang->line('this_month');?>': [moment().startOf('month'), moment().endOf('month')],
						'<?php echo $this->lang->line('last_month');?>': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
					}
				},cb1);
		
				$('#sel_join_date').on('cancel.daterangepicker', function(ev, picker) {
					//do something, like clearing an input
					$('#sel_join_date').val('');
					_j_sd = "";
					_j_ed = "";
					loadTable();
				});

				$('#sel_left_date').on('cancel.daterangepicker', function(ev, picker) {
					//do something, like clearing an input
					$('#sel_left_date').val('');
					_l_sd = "";
					_l_ed = "";
					loadTable();
				});
		
				$("#sel_join_date").val("");
				$("#sel_left_date").val("");	

				loadTable();	


        });

    </script>