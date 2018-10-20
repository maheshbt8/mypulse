<style>
	canvas.canvasjs-chart-canvas{
		margin-top:35px;
	}
	a.canvasjs-chart-credit{
		display: none;
	}
	div#chartContainer{
		margin-top: 40px;
	}
	canvas.canvasjs-chart-canvas{
		position: relative;
	}
	button{
		margin-top: 50px;
	}
</style>
<?php $color = dechex(rand(0x000000, 0xFFFFFF)); ?>
<?php

$hospital_count=count($hospital_id);
for($h=0;$h<$hospital_count;$h++){
$row=$this->db->where('hospital_id',$hospital_id[$h])->get('hospitals')->row_array();
$hospital_name[]=$row['name'];
$last=date('Y-m-d', strtotime('last month'));
$date1=date_create($sd);
$date2=date_create($ed);
$diff=date_diff($date1,$date2);
$count=$diff->format("%a");
$j=0;
for($i=1;$i<=$count;$i++){
$currmonth = date('Y-m-d', strtotime('-'.$i.' day'));
if($report_id == 1){
$qry=$this->db->get_where('inpatient', array('hospital_id' => $hospital_id[$h],'created_date'=>date('m/d/Y', strtotime('-'.$i.' day'))))->num_rows();
}elseif($report_id == 2){
$qry=$this->db->get_where('appointments', array('hospital_id' => $hospital_id[$h],'appointment_date'=>date('m/d/Y', strtotime('-'.$i.' day'))))->num_rows();
}
$j++;
$data[$j]=array('x'=>strtotime($currmonth)*1000,'y'=>$qry);
}
$color = dechex(rand(0x000000, 0xFFFFFF));
$dataPoints[$h]=array_reverse($data);
	$data_points[]= '{
		type: "spline",
		name: "'.$row['name'].'",
		showInLegend: "true",
		color: "#'.$color.'",
		xValueType: "dateTime",
		xValueFormatString: "DD MMM",
		yValueFormatString: "#,##0",
		dataPoints:  '.json_encode($dataPoints[$h]).'
	}';
}
$data_list='['.implode(',',$data_points).']';
?>
<script>
window.onload = function () {

/*for(var i=0;i<count;i++){
datalist[i]={
		type: "spline",//splineArea
		color: "#6599FF",
		xValueType: "dateTime",
		xValueFormatString: "DD MMM",
		yValueFormatString: "#,##0",
		dataPoints: <?php echo json_encode($dataPoints[+i]); ?>
	}
}*/

var chart = new CanvasJS.Chart("chartContainer", {

	animationEnabled: true,
	exportEnabled: true,
	theme: "dark3",
	title:{
		responsive: true,
		text: '<?php print_r(implode(' vs ',$hospital_name));?>'
	},
	subtitles: [{
		text: "<?php echo ' ( '.$sd.' To '.$ed.' ) ';?>",
		fontSize: 18
	}],
	axisX: {
		valueFormatString: "DD MMM"
	},
	axisY: {
		title: '<?php echo $title;?>',
		suffix: "",
		/*maximum: 10000*/
	},

	data: <?php echo $data_list;?>/*[{
		type: "spline",//splineArea
		color: "#6599FF",
		xValueType: "dateTime",
		xValueFormatString: "DD MMM",
		yValueFormatString: "#,##0",
		dataPoints: <?php echo json_encode($dataPoints[+i]); ?>
	}]*/
});
 
chart.render();
function toggleDataSeries(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart.render();
}
}

</script>
<div class="control-label">
  <input type="button" class="btn btn-info pull-right" value="<?php echo get_phrase('close'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
</div>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>

<!-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->
<script src="assets/js/canvasjs.min.js"></script>