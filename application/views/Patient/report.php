<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
$this->load->view("template/header.php");
$this->load->view("template/left.php");
?>
	<input type="hidden" id="left_active_menu" value="12" />
    <input type="hidden" id="left_active_sub_menu" value="1201" />
		<div id="main-wrapper">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="panel panel-white">
	                    
	                    <div class="panel-heading clearfix">
							<div class="">
								<div class="custome_col8">
									<h4 class="panel-title panel_heading_custome"><?php echo $this->lang->line('patient_report');?></h4>
								</div>
								<br>
							</div>
	                    </div>
	                    <div class="panel-body panel_body_custome">
							<div class="col-md-12">
                                <!-- <div class="form-group col-md-4">
                                    <label><?php echo $this->lang->line('labels')['select_date'];?></label>
                                    <input id="sel_date" class=" form-control date-picker" /> 
                                </div> -->
                            </div>
							<div class="col-md-12">
								<div class="table-responsive">
									<table id="report" class="display table" cellspacing="0" width="100%">
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
	        </div>
	    </div><!-- Main Wrapper -->

		
	
<?php
$this->load->view("template/footer.php");
?>
<script type="text/javascript">
		
	$(document).ready(function(){
		
		function loadTable(date){	
			$("#report").dataTable().fnDestroy();
			$("#report").DataTable();
			$(".dataTables_filter").attr("style","display: flex;float: right");
		}

		loadTable("");

	});

</script>