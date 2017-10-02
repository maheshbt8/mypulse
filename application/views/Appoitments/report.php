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
								<a href="#" data-toggle='modal' data-target="#chart" class="btn btn-primary chartsbtn"><i class="fa fa-bar-chart-o"></i></a>
								<?php $this->load->view('template/exbtn');?>
							</div>
	                    </div>
	                    <div class="card-body">
							<div class="col-md-12">
								<div class="form-group col-md-4">
									<label><?php echo $this->lang->line('labels')['selectFromDdate'];?></label>
									<input id="sel_from_date" class="dates form-control" /> 
								</div>
                            </div>
							<div class="col-md-12">
								
								<table id="report" class="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
									<thead>
										<tr>
											<th style="width:10px"></th>
											<th><?php echo $this->lang->line('tableHeaders')['hospital'];?></th>
											<th><?php echo $this->lang->line('tableHeaders')['numOFAppt'];?></th>
											<th><?php echo $this->lang->line('tableHeaders')['action'];?></th>
										</tr>
									</thead>
									<tbody>
										<?php
											foreach($reports as $res){
												?>
												<tr>
													<td>
														<input type="checkbox" class="chk" data-id="<?=$res['hid'];?>">
													</td>
													<td><?=$res['name'];?></td>
													<td><?=$res['count'];?></td>
													<td><a href="#" data-toggle='modal' data-id="<?=$res['hid'];?>" data-target="#chart" class="btn btn-primary chartbtns"><i class="fa fa-bar-chart-o"></i></a></td>
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



		<div class="modal fade" id="chart" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				
				<div class="modal-content">
				  	<div class="modal-header">
					  	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					  	<h4 class="modal-title custom_align" id="Edit-Heading">Patient trend</h4>
					</div>
				  	<div class="modal-body" id="chartjs_line_parent">
					  	<div class="row">
							<div class="col-md-12">
					  			<canvas id="chartjs_line"></canvas>
								<span id="herr" style="display:none">Select at least one hospital.</span>  
							</div>	  
				  		</div>
					</div>
				</div>
			</div>
		</div>											
		
	
<?php
$this->load->view("template/footer.php");
?>

<script src="<?php echo base_url();?>public/assets/js/chart-js/Chart.bundle.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>public/assets/js/chart-js/utils.js" type="text/javascript"></script>


<script type="text/javascript">
		
	$(document).ready(function(){
		
		function loadTable(date){	
			$("#report").dataTable().fnDestroy();

			var dt = $("#report").DataTable();
			<?php $this->load->view('template/exdt');?>
			$(".dataTables_filter").attr("style","display: flex;float: right");
		}

		loadTable("");

		var start = moment().subtract(29, 'days');
		var end = moment();

		<?php
		if(isset($_GET['sd']) && $_GET['sd'] != ""){
			?>
			start = moment('<?php echo $_GET['sd'];?>');
			<?php
		}
		?>

		<?php
		if(isset($_GET['ed']) && $_GET['ed'] != ""){
			?>
			end = moment('<?php echo $_GET['ed'];?>');
			<?php
		}
		?>

		$(document).on('click','.chartsbtn',function(){
			$("#herr").hide();
			$("#chartjs_line").hide();
			
			var selected = [];
			$('.chk').each(function() {
				if ($(this).is(":checked")) {
					selected.push($(this).data('id'));
				}
			});
			if(selected.length == 0){
				$("#herr").show();
			}else{
				updateChart(selected.join());
			}		
		});

		$(document).on('click','.chartbtns',function(){
			$("#herr").hide();
			$("#chartjs_line").hide();
			var hid = $(this).data('id');
			updateChart(hid);
		});

		var randomColorGenerator = function () { 
			return '#' + (Math.random().toString(16) + '0000000').slice(2, 8); 
		}

		function updateChart(hid){
			var sd = $('#sel_from_date').data('daterangepicker').startDate.format("YYYY-MM-DD");
			var ed = $('#sel_from_date').data('daterangepicker').endDate.format("YYYY-MM-DD");
			
			$.get('<?php echo site_url();?>appoitments/getreportchart',{hid, hid,sd: sd, ed:ed},function(d){
				var _data = $.parseJSON(d);
				_data =_data.data;
				var _datasets = [];
				for(var i=0; i<_data.data.length; i++){
					var temp = _data.data[i];
					var rndC = randomColorGenerator();
					var t = {
						label: temp.label,
						backgroundColor: rndC,
						borderColor: rndC,
						data: temp.data,
						fill: false,
					};
					_datasets.push(t);
				}
				var config = {
					type: 'line',
					data: {
						labels: _data.labels,
						datasets: _datasets
					},
					options: {
						responsive: true,
						title:{
							display:true,
							text:'Patient trend ( '+_data.title+' )'
						},
						tooltips: {
							mode: 'index',
							intersect: false,
						},
						hover: {
							mode: 'nearest',
							intersect: true
						},
						scales: {
							xAxes: [{
								display: true,
								scaleLabel: {
									display: true,
									labelString: 'Time'
								}
							}],
							yAxes: [{
								display: true,
								scaleLabel: {
									display: true,
									labelString: 'Patients'
								}
							}]
						}
					}
				};
				var ctx = document.getElementById("chartjs_line").getContext("2d");

				window.myLine = new Chart(ctx, config);		
				$("#chartjs_line").show();
			});
		}

		function cb(start, end) {
			//console.log(start.format('MM D, YYYY') + ' - ' + end.format('MM D, YYYY'));
			window.location.href = '<?php echo site_url();?>appoitments/report?sd='+start.format('YYYY-MM-D')+"&ed="+end.format('YYYY-MM-D');
		}
		
		$('#sel_from_date').daterangepicker({
			startDate: start,
			endDate: end,
			ranges: {
				'Today': [moment(), moment()],
				'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				'Last 7 Days': [moment().subtract(6, 'days'), moment()],
				'Last 30 Days': [moment().subtract(29, 'days'), moment()],
				'This Month': [moment().startOf('month'), moment().endOf('month')],
				'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			}
		},cb);

	});

</script>