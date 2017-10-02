<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
$this->load->view("template/header.php");
$this->load->view("template/left.php");
?>
		<input type="hidden" id="left_active_menu" value="2" />
		<input type="hidden" id="left_active_sub_menu" value="201" />
		<div id="main-wrapper">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="card">
						<div class="card-head">
							<header><?php echo $this->lang->line('hospitals');?></header>
							<div class="custome_card_header">
								
							</div>
						</div>
	                    <div class="card-body">
	                       
							<table id="hospitals" class="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
								<thead>
									<tr>
                                        <th style="width:10px"></th>
                                        <th><?php echo $this->lang->line('tableHeaders')['name'];?></th>
                                        <th><?php echo $this->lang->line('tableHeaders')['address'];?></th>
                                        <th><?php echo $this->lang->line('tableHeaders')['phoneNumber'];?></th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>  
	                       
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



				var dt = $("#hospitals").DataTable({
		            "processing": true,
		            "serverSide": true,
		            "ajax": "<?php echo site_url(); ?>/patients/getDThospitals"
		        });
				$(".dataTables_filter").attr("style","display: flex;float: right");

			

			});

		</script>