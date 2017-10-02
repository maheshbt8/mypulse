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
	                <div class="card ">
						<div class="card-head">
							<header><?php echo $this->lang->line('receptionists');?></header>
							<div class="custome_card_header">
								
							</div>
						</div>
	                    <div class="card-body ">
	                       
							<table id="receptionist" class="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
								<thead>
									<tr>
										<th style="width:10px"></th>
										<th><?php echo $this->lang->line('tableHeaders')['receptionist'];?></th>
										<th><?php echo $this->lang->line('tableHeaders')['hospital'];?></th>
										<th><?php echo $this->lang->line('tableHeaders')['branch'];?></th>
										<th><?php echo $this->lang->line('tableHeaders')['department'];?></th>
										<th><?php echo $this->lang->line('tableHeaders')['doctor'];?></th>
									</tr>
								</thead>
								
								<tbody>
								</tbody>
							</table>  
	                    </div>
	                </div>
	            </div>
	        </div>
	        <input type="hidden" id="cur_del">
	    </div><!-- Main Wrapper -->

<?php
    $this->load->view("template/footer.php");
?>
    <script type="text/javascript">
		
			$(document).ready(function(){

				
				var dt = $("#receptionist").DataTable({
		            "processing": true,
		            "serverSide": true,
		            "ajax": "<?php echo site_url(); ?>/receptionist/getDTreceptionist"
		        });
				
				$(".dataTables_filter").attr("style","display: flex;float: right");
					

			});

		</script>