<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
$this->load->view("template/header.php");
$this->load->view("template/left.php");
?>
			<input type="hidden" id="left_active_menu" value="53" />
		<div id="main-wrapper">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="card">
	                    
						<div class="card-head">
							<header>Inpatient</header>
							<div class="custome_card_header">
								<button type="button" id="canPatientBtnHist" class="btn btn-warning pull-right" style="display:none"><i class="fa fa-arrow-left"></i> &nbsp; Back</button>
                                
							</div>
						</div>

	                    <div class="card-body">
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
										<option value="2"><?php echo  $this->lang->line('labels')['discharged']; ?></option>
									</select>
                                </div>
							</div>
							<div id="patientRecordTbl">
								<table id="inpatient" class="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
									<thead>
										<tr>
											<th style="width:10px"></th>
											<th><?php echo $this->lang->line('tableHeaders')['patient'];?></th>								
											<th><?php echo $this->lang->line('tableHeaders')['hospital'];?></th>								
											<th><?php echo $this->lang->line('tableHeaders')['doctor'];?></th>
											<th><?php echo $this->lang->line('tableHeaders')['date'];?></th>
											<th><?php echo $this->lang->line('tableHeaders')['reason'];?></th>
											<th><?php echo $this->lang->line('tableHeaders')['bed'];?></th>
											<th><?php echo $this->lang->line('tableHeaders')['status'];?></th>
											<th style="width:10px"><?php echo $this->lang->line('tableHeaders')['action'];?></th>
										</tr>
									</thead>
									
									<tbody>
									</tbody>
								</table>  
							</div>
							<div class="" id="inPatientTblHistoryDiv" style="display: none;">
								<div class="Histry_record" style="margin-left: 50px;">                                              
									<h4><?php echo $this->lang->line('labels')['bed'];?> :  <small id="bed_no"></small></h4>
									<h4><?php echo $this->lang->line('labels')['join_date'];?> :  <small id="jdate"></small></h4>
									<h4><?php echo $this->lang->line('labels')['status'];?> :  <small id="hs_status"></small></h4>
									<h4><?php echo $this->lang->line('labels')['reason'];?> :  <small id="hs_reason"></small></h4>
									<h4><?php echo $this->lang->line('labels')['left_date'];?> :  <small id="hs_ldate"></small></h4>

									
								</div>
									<table id="inPatientTblHistory" class="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
									<thead>
										<tr>
											<th style="width:10px"></th>
											<th><?php echo $this->lang->line('tableHeaders')['note'];?></th>
											<th><?php echo $this->lang->line('tableHeaders')['date'];?></th>
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
				<form action="<?php echo site_url(); ?>/inpatient/update" method="post" id="form">
				<input type="hidden" name="eidt_gf_id" id="eidt_gf_id">
				<div class="modal-content">
				  	<div class="modal-header">
					  	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					  	<h4 class="modal-title custom_align" id="Edit-Heading">Edit Your Detail</h4>
					</div>
				  	<div class="modal-body">
				  		<div class="row">
				  			<div class="col-md-12">
				  			<div class="form-group col-md-6">
					<label>User Id</label>
					<select name="user_id" id="user_id" class=" form-control" style="width: 100%">
					</select>
					
		</div><div class="form-group col-md-6">
					<label>Bed Id</label>
					<select name="bed_id" id="bed_id" class=" form-control" style="width: 100%">
					</select>
					
		</div>
				  					</div>
				  					<div class="col-md-12">
				  				<div class="form-group col-md-6">
					<label>Join Date</label>
					<input class="form-control date-picker" type="text" placeholder="Join Date" name="join_date" id="join_date" />
					
		</div><div class="form-group col-md-6">
					<label>Reason</label>
					<input class="form-control " type="text" placeholder="Reason" name="reason" id="reason" />
					
		</div><div class="form-group col-md-6">
					<label>Status</label>
					<input class="form-control " type="text" placeholder="Status" name="status" id="status" />
					
		</div>
				  		</div>
				  		
					</div></div>
				  	<div>
				  		<hr>
				  		<div class="row">
					  		<div class="form-group col-md-6">
		                        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal" style="width: 100%;"><span class="fa fa-remove" style="margin: 5px"></span>CANCEL</button>
		                    </div>

		                    <div class="form-group col-md-6">
		                        <button type="submit" class="btn btn-info btn-lg" id="action-update-btn" style="width: 100%;"><span style="margin: 5px" class="fa fa-check"></span>UPDATE</button>
		                    </div>
		                    
		                    <div class="form-group col-md-6" style="display:none">
		                        <button type="submit" class="btn btn-success btn-lg" id="action-add-btn" style="width: 100%;"><span style="margin: 5px" class="fa fa-plus"></span>ADD</button>
		                    </div>
		                </div>
					</div>
				</div>
				</form>
			<!-- /.modal-content --> 
			</div>
		<!-- /.modal-dialog --> 
		</div><div class="modal fade bs-example-modal-sm" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
	      	<div class="modal-dialog modal-sm">
	    		<div class="modal-content">
	          		<div class="modal-header">
	        			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
	        			<h4 class="modal-title custom_align" id="Heading">Delete Item</h4>
	      			</div>
	          		<div class="modal-body">
	       				<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure? You want to delete this Item?</div>

	      			</div>
	        		<div class="modal-footer ">
	        			<button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
	                    <button type="button" id="del_yes" class="btn btn-danger">YES</button>
	      			</div>
	        	</div>
	    	<!-- /.modal-content --> 
	  		</div>
		</div>
	    <!-- /.modal-dialog -->
	    <?php
$this->load->view("template/footer.php");
?><script type="text/javascript">
		
			$(document).ready(function(){

				var _j_sd = "";
		        var _j_ed = "";
				var _l_sd = "";
				var _l_ed = "";

				function loadTable(){

					var st = $("#status").val();
					$("#inpatient").dataTable().fnDestroy();
					$("#inpatient").DataTable({
						"processing": true,
						"serverSide": true,
						"ajax": "<?php echo site_url(); ?>/inpatient/getDTinpatient?j_sd="+_j_sd+"&j_ed="+_j_ed+"&l_sd="+_l_sd+"&l_ed="+_l_ed+"&st="+st,
						"columns":[
									{ name: '#',"searchable": false, "orderable": false },
									{ name: '<?php echo $this->lang->line('tableHeaders')['patient'];?>' },
									{ name: '<?php echo $this->lang->line('tableHeaders')['hospital'];?>' },
									{ name: '<?php echo $this->lang->line('tableHeaders')['doctor'];?>' },
									{ name: '<?php echo $this->lang->line('tableHeaders')['date'];?>' },
									{ name: '<?php echo $this->lang->line('tableHeaders')['reason'];?>' },
									{ name: '<?php echo $this->lang->line('tableHeaders')['bed'];?>' },
									{ name: '<?php echo $this->lang->line('tableHeaders')['status'];?>' },
									{ name: '<?php echo $this->lang->line('tableHeaders')['action'];?>', "searchable": false, "orderable": false }
								]
					});

					$(".dataTables_filter").attr("style","display: flex;float: right");
					//$(".dataTables_filter").append("<a class=\"btn btn-success m-b-sm addbtn\" data-toggle=\"tooltip\" title=\"Add\"  href=\"javascript:void(0);\" data-title=\"Add\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Add New</a>");
				
				}

			    $("[data-toggle=tooltip]").tooltip();

				$(document).on('click','.historyinpatient',function(){
			        var patient_id= $(this).data('id');
                    $('#hsinpatientadd_id').val(patient_id);
					$('#inpatient_filters').hide();
                	$('#patientRecordTbl').hide();
					$('#inPatientTblHistoryDiv').show();
					var bed_no = $(this).data('bno');
					var hs_jdate = $(this).data('jdate');
					var hs_status = $(this).data('status');
					var hs_reason = $(this).data('reason');
					var ldate= $(this).data('ldate');
					$('#bed_no').text(bed_no);
					$('#jdate').text(hs_jdate);
					$('#hs_status').text(hs_status);
					$('#hs_reason').text(hs_reason);
					$('#hs_ldate').text(ldate);
			              
			    	$('#canPatientBtnHist').show();
			        
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

				$('#canPatientBtnHist').click(function(){
		          	$('#canPatientBtnHist').hide();
		          
		          	$('#inPatientTblHistoryDiv').hide();
					$('#inpatient_filters').show();  
		          	$('#patientRecordTbl').show(); 
		        });

			    $(".addbtn").click(function(){
			    	$("#Edit-Heading").html("Add New Record");
			    	$("#action-update-btn").parent().hide();
			    	$("#action-add-btn").parent().show();
			    	$("#form")[0].reset();
			    	$("#form input").attr("disabled",false);
			    	$("#form").attr("action","<?php echo site_url(); ?>/inpatient/add");
			    	$("#edit").modal("show");
			    });

				$("#inpatient").on("click",".editbtn",function(){
			    	var id = $(this).attr("data-id");
			    	$("#eidt_gf_id").val(id);
			    	loadData(id);
			    	$("#form").attr("action","<?php echo site_url(); ?>/inpatient/update");
			    	$("#form input").attr("disabled",false);
			    	$("#Edit-Heading").html("Edit Your Data");
			    	$("#action-add-btn").parent().hide();
			    	$("#action-update-btn").parent().show();
			    });

			    function loadData(id){
			    	$.post("<?php echo site_url(); ?>/inpatient/getinpatient",{ id: id },function(data){
			    		var data = JSON.parse(data);
			    		
					var tempselectize_user_id = $selectize_user_id[0].selectize;
					tempselectize_user_id.addOption([{"id":data.user_id,"text":data.user_id}]);
					tempselectize_user_id.refreshItems();
					tempselectize_user_id.setValue(data.user_id);
					
					var tempselectize_bed_id = $selectize_bed_id[0].selectize;
					tempselectize_bed_id.addOption([{"id":data.bed_id,"text":data.bed_id}]);
					tempselectize_bed_id.refreshItems();
					tempselectize_bed_id.setValue(data.bed_id);
					
					$("#join_date").val(data.join_date);
					
					$("#reason").val(data.reason);
					
					$("#status").val(data.status);
					

			    		/*$.each(JSON.parse(data), function(key, value){
						    $("#"+key).val(value);
						});*/
			    	});
			    }

			    $("#inpatient").on("click",".viewbtn",function(){
			    	loadData($(this).attr("data-id"));
			    	$("#form input").attr("disabled",true);
			    	$("#form").attr("action","");
					$("#action-add-btn").parent().hide();
					$("#action-update-btn").parent().hide();
			    	$("#Edit-Heading").html("Detailed View");

			    });


			    $("#inpatient").on("click",".delbtn",function(){
			    	$("#cur_del").val($(this).attr("data-id"));
			    });
			    
			    $("#del_yes").click(function(){
			    	var id = $("#cur_del").val();
			    	if(id!==""){
			    		$.post("<?php echo site_url(); ?>/inpatient/delete",{id:id},function(){
			    			$("#tr_"+$("#cur_del").val()).parent().parent().hide();
			    			$("#delete").modal("hide");	
			    		});
			    	}
			    	else{
			    		$("#delete").modal("hide");
			    	}
			    	$(".modal-backdrop").hide();
			    });

				var $selectize_user_id = $("#user_id").selectize({
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
				            data: {"q":query,"f":"id"},
				            error: function() {
				                callback();
				            },
				            success: function(res) {
				                callback($.parseJSON(res));
				            }
				        });
				    }
				});

					

				var $selectize_bed_id = $("#bed_id").selectize({
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
				            data: {"q":query,"f":"id"},
				            error: function() {
				                callback();
				            },
				            success: function(res) {
				                callback($.parseJSON(res));
				            }
				        });
				    }
				});

				var $selectize_doctor_id = $("#doctor_id").selectize({
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
				            url: "<?php echo site_url(); ?>/doctors/search",
				            type: "GET",
				            data: {"q":query,"f":"id"},
				            error: function() {
				                callback();
				            },
				            success: function(res) {
				                callback($.parseJSON(res));
				            }
				        });
				    }
				});

				/*$("#sel_date").change(function(){
					var date = $("#sel_date").val();
					loadTable($("#hospital_id1").val(),$("#doctor_id1").val());
				});*/

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