<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
$this->load->view("template/header.php");
$this->load->view("template/left.php");
?>
	<input type="hidden" id="left_active_menu" value="12" />
    <input type="hidden" id="left_active_sub_menu" value="1202" />
		<div id="main-wrapper">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="card ">
	                    
	                    <div class="card-head">
							<header><?php echo $this->lang->line('appoitment_report');?></header>
							<div class="custome_card_header">
								<?php $this->load->view('template/exbtn');?>
							</div>
	                    </div>
	                    <div class="card-body">
							<div class="col-md-12">
                                <!-- <div class="form-group col-md-4">
                                    <label><?php echo $this->lang->line('labels')['select_date'];?></label>
                                    <input id="sel_date" class=" form-control date-picker" /> 
                                </div> -->
                            </div>
							<div class="col-md-12">
								
								<table id="report" class="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
									<thead>
										<tr>
											<th style="width:10px"></th>
											<th><?php echo $this->lang->line('tableHeaders')['hospital'];?></th>
											<th><?php echo $this->lang->line('tableHeaders')['numOFAppt'];?></th>
										</tr>
									</thead>
									<tbody>
										<?php
											foreach($reports as $res){
												?>
												<tr>
													<td><?=$res['ind'];?></td>
													<td><?=$res['name'];?></td>
													<td><?=$res['count'];?></td>
												</tr>
												<?php
											}
										?>
									</tbody>
								</table>  
								
							</div>	
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div><!-- Main Wrapper -->

		
	
<?php
$this->load->view("template/footer.php");
?>
<script type="text/javascript">
		
	$(document).ready(function(){
		
		function loadTable(date){	
			$("#report").dataTable().fnDestroy();

			var dt = $("#report").DataTable();
			<?php $this->load->view('template/exdt');?>
			$(".dataTables_filter").attr("style","display: flex;float: right");
		}

		loadTable("");

	});

</script>