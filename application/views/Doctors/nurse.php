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
	                <div class="card ">
						<div class="card-head">
							<header><?php echo $this->lang->line('doctors');?></header>
							<div class="custome_card_header">
							</div>
						</div>
	                   
	                    <div class="card-body ">
	                       
							<table id="doctors" class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" >
								<thead>
									<tr>
										<th style="width:10px"></th>
										<th><?php echo $this->lang->line('tableHeaders')['name'];?></th>
										<th><?php echo $this->lang->line('tableHeaders')['branch'];?></th>
										<th><?php echo $this->lang->line('tableHeaders')['department'];?></th>
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
?><script type="text/javascript">
		
			$(document).ready(function(){
				var branch_id = null;
				var department_id = null;
				$("#doctors").DataTable({
		            "processing": true,
		            "serverSide": true,
		            "ajax": "<?php echo site_url(); ?>/doctors/getDTdoctors"
		        });

				$(".dataTables_filter").attr("style","display: flex;float: right");
				//$(".dataTables_filter").append("<a class=\"btn btn-success m-b-sm addbtn\" data-toggle=\"tooltip\" title=\"Add\"  href=\"javascript:void(0);\" data-title=\"Add\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Add New</a>");
				//$(".dataTables_filter").append("<a class=\"btn btn-danger m-b-sm multiDeleteBtn\" data-at=\"doctors\" data-toggle=\"tooltip\" title=\"Delete\"  href=\"javascript:void(0);\" data-title=\"Delete\" data-toggle=\"modal\" data-target=\"#edit\" style=\"margin-left:10px\">Delete</a>");

			    $("[data-toggle=tooltip]").tooltip();

			    
			});

		</script>