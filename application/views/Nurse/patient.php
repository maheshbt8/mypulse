<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
$this->load->view("template/header.php");
$this->load->view("template/left.php");
?>
		<input type="hidden" id="left_active_menu" value="4" />
		<div id="main-wrapper">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="panel panel-white">
	                    
	                    <div class="panel-heading clearfix">
							<div class="">
								<div class="custome_col8">
									<h4 id="div_title" class="panel-title panel_heading_custome"><?php echo $this->lang->line('patients');?></h4>
								</div>
								<div class="custome_col4">
                                <div class="panel_button_top_right">
                                    <a class="btn btn-primary m-b-sm " id="editBtn" style="display:none" data-toggle="tooltip" href="javascript:void(0);" ><?php echo $this->lang->line('buttons')['edit'];?></a>
                                    <a class="btn btn-success m-b-sm " style="display:none" id="addPrescriptionBtn" data-toggle="tooltip" href="javascript:void(0);" ><?php echo $this->lang->line('buttons')['newPrescription'];?></a>
                                    <!-- <a class="btn btn-success m-b-sm " style="display:none" id="inPatientBtn" data-toggle="tooltip" href="javascript:void(0);" ><?php echo $this->lang->line('buttons')['newpatient'];?></a> -->
                                    <a class="btn btn-success m-b-sm " style="display:none" id="add_noteBtn" data-toggle="modal" data-target="#AddNewNote" href="javascript:void(0);" ><?php echo $this->lang->line('buttons')['new_note'];?></a>&nbsp
                                    <button type="button" id="canPatientBtnHist" class="btn btn-warning pull-right" style="display:none"><i class="fa fa-remove"></i> &nbsp; Cancel</button>
                                    <a class="btn btn-default m-b-sm " id="cancelBtn" data-toggle="tooltip" style="display:none" href="javascript:void(0);" ><?php echo $this->lang->line('buttons')['cancel'];?></a>
                                </div>
                            </div>
                             <br>
							</div>
	                    </div>
	                    <div class="panel-body panel_body_custome">
	                       <div class="table-responsive"  id="patientRecordTbl" >
	                            <table id="patients" class="display table" cellspacing="0" width="100%">
	                                <thead>
	                                    <tr>
											<th style="width:10px"></th>
											<th><?php echo $this->lang->line('tableHeaders')['name'];?></th>
											<th><?php echo $this->lang->line('tableHeaders')['email'];?></th>
											<th><?php echo $this->lang->line('tableHeaders')['action'];?></th>
	                                    </tr>
	                                </thead>
	                                
	                                <tbody>
	                                </tbody>
	                            </table>  
	                        </div>
	                        <div class="col-md-12">
                                        <div class="table-responsive" id="inPatientTblDiv" style="display: none;">
                                            <table id="inPatientTbl" class="display table" cellspacing="0" width="100%">
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
                                        <div class="table-responsive" id="inPatientTblHistoryDiv" style="display: none;">
                                           <div class="Histry_record" style="margin-left: 50px;">                                              
                                              <h4>Bed :  <small id="bed_no"></small></h4>
                                              <h4>Join-Date:  <small id="jdate"></small></h4>
                                              <h4>Status:  <small id="hs_status"></small></h4>
                                              <h4>Reason:  <small id="hs_reason"></small></h4>
                                              <h4>Left-Date:  <small id="hs_ldate"></small></h4>
                                           </div>
                                             <table id="inPatientTblHistory" class="display table" cellspacing="0" width="100%">
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
                              <form id="patientform" method="post" action="<?php echo site_url();?>/doctors/addinpatient">
                                <input type="hidden" name="appt_id" value='<?php echo $appoitment['id'];?>' />
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
                                         <option value="1">Yes</option>
                                         <option selected value="0">No</option>
                                      </select>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="PatientReason"><?php echo $this->lang->line('labels')['reason']; ?></label>
                                    <textarea class="form-control"  rows="6" name="inPatientReason" id="patient_reason"></textarea>
                                  </div><br>
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
        <div class="modal fade" id="AddNewNote" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Add New Note
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <form method="post" action="<?php echo site_url(); ?>/inpatient/add_note" class="form-horizontal" role="form" id="new_noteform">
                <input type="hidden" name="appt_id" value='<?php echo $appoitment['id'];?>' />
                <input type="hidden" name="hsinpatientadd_id" id="hsinpatientadd_id">
                <input type="hidden" name="hsinpatientEdit_id" id="hsinpatientEdit_id">
                  <div class="form-group">
                    <label  class="col-sm-2 control-label"
                              for="">New Note</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" 
                      name="new_note"   id="Hsnew_note" placeholder="Write Note" rows="5"></textarea>
                    </div>
                  </div>
                  <div class="form-group text-center">
                  <button  type="submit" class="btn btn-primary" >
                    <i class="glyphicon glyphicon-plus"></i> Save </button>
                   <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <i class="fa fa-remove"></i>  Cancel </button>                    
                  </div>
                </form>                  
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">                
            </div>
        </div>
    </div>
</div>
		
	    <?php
$this->load->view("template/footer.php");
?><script type="text/javascript">
		
			$(document).ready(function(){
				var branch_id = null;
				var department_id = null;
				$("#patients").DataTable({
		            "processing": true,
		            "serverSide": true,
		            "ajax": "<?php echo site_url(); ?>/nurse/getDTpatient"
		        });

				$(".dataTables_filter").attr("style","display: flex;float: right");
				//$(".dataTables_filter").append("<a class=\"btn btn-success m-b-sm addbtn\" data-toggle=\"tooltip\" title=\"Add\"  href=\"javascript:void(0);\" data-title=\"Add\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Add New</a>");
				//$(".dataTables_filter").append("<a class=\"btn btn-danger m-b-sm multiDeleteBtn\" data-at=\"doctors\" data-toggle=\"tooltip\" title=\"Delete\"  href=\"javascript:void(0);\" data-title=\"Delete\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Delete</a>");

			    $("[data-toggle=tooltip]").tooltip();

                $(document).on('click','.InPatientBtn',function(){
                	     $('#inPatientTblDiv').show();
                	     $('#patientRecordTbl').hide();
                         var inpatient_id = $(this).data('id');                          
				        $("#inPatientTbl").DataTable({
				            "processing": true,
				            "serverSide": true,
				            "paging":   true,
				            "ordering": false,
				            "info":     false,
				            "ajax": '<?php echo site_url();?>/inpatient/getDTPatientinpatient/'+inpatient_id
				        });
				        $("#inPatientTbl_filter").hide();
				        $("#inPatientTbl_length").hide();
                        });
			 
		    $(document).on('click','.historyinpatient',function(){
			               var patient_id= $(this).data('id');
                         $('#inPatientTblDiv').hide();
                	     $('#patientRecordTbl').hide();
                	     $('#inPatientTblHistoryDiv').show();
			              //  $('#hsinpatientadd_id').val(patient_id);
			              //  var bed_no = $(this).data('bno');
			              //  var hs_jdate = $(this).data('jdate');
			              //  var hs_status = $(this).data('status');
			              //  var hs_reason = $(this).data('reason');
			              //  var ldate= $(this).data('ldate');
			              //   console.log($(this).data('bno'));
			              //   $('#bed_no').text(bed_no);
			              //   $('#jdate').text(hs_jdate);
			              //   $('#hs_status').text(hs_status);
			              //   $('#hs_reason').text(hs_reason);
			              //   $('#hs_ldate').text(ldate);
			              //   //row.find(".historyinpatient").hide();
			              // $('#inPatientTblDiv').hide();
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

                                var tempselectize_bed_ID = $selectize_bed_id[0].selectize;
                                tempselectize_bed_ID.addOption([{"id":inpatient_data.bed_id,"text":inpatient_data.bed_id}]);
                                tempselectize_bed_ID.refreshItems();
                                tempselectize_bed_ID.setValue(inpatient_data.bed_id);
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
             
		        $('#canPatientBtnHist').click(function(){
		          $('#canPatientBtnHist').hide();
		          $('#add_noteBtn').hide();
		          $('#inPatientTblHistoryDiv').hide();
		          $('#inPatientTblDiv').show();
		        });

	           $("#canPatientBtn").click(function(){
	             $("#inPatientBtn").show();
	             $("#tabDiv").show();
	             $("#inPatientDiv").hide();
	             $('#inPatientTblDiv').show();
	            $("#div_title").html("<?php echo $this->lang->line('newPatient');?>");
              });
		});

		</script>