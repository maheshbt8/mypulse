<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
$this->load->view("template/header.php");
$this->load->view("template/left.php");
?>
		<input type="hidden" id="left_active_menu" value="7" />
		<div id="main-wrapper">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="card">
						<div class="card-head">
							<header><?php echo $this->lang->line('patients');?></header>
							<div class="custome_card_header">
								
							</div>
						</div>
	                    <div class="card-body  ">	                     
							<table id="users" class="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
								<thead>
									<tr>
										<th style="width:10px"></th>
										<th><?php echo $this->lang->line('tableHeaders')['name'];?></th>
										<th><?php echo $this->lang->line('tableHeaders')['email'];?></th>
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
	        <input type="hidden" id="cur_del">
	    </div><!-- Main Wrapper -->

	    <?php
$this->load->view("template/footer.php");
?><script type="text/javascript">
		
			$(document).ready(function(){

				
				var dt = $("#users").DataTable({
		            "processing": true,
		            "serverSide": true,
		            "ajax": "<?php echo site_url(); ?>/patients/getDTusers"
		        });
				
				$(".dataTables_filter").attr("style","display: flex;float: right");
				//$(".dataTables_filter").append("<a class=\"btn btn-success m-b-sm addbtn\" data-toggle=\"tooltip\" title=\"Add\"  href=\"javascript:void(0);\" data-title=\"Add\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Add New</a>");
				//$(".dataTables_filter").append("<a class=\"btn btn-danger m-b-sm multiDeleteBtn\" data-at=\"patient\" data-toggle=\"tooltip\" title=\"Delete\"  href=\"javascript:void(0);\" data-title=\"Delete\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Delete</a>");

			    
			});

		</script>