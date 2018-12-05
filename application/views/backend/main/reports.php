<style>
	canvas.canvasjs-chart-canvas{
		position: relative;
	}
</style>

<?php
$hospital_count=count($hospital_id);
for($h=0;$h<$hospital_count;$h++){
	if($account_type == 'superadmin')
  {
$row=$this->db->where('hospital_id',$hospital_id[$h])->get('hospitals')->row_array();
}elseif($account_type == 'hospitaladmins'){
$row=$this->db->where('branch_id',$hospital_id[$h])->get('branch')->row_array();	
}
$hospital_name[]=$row['name'];
$last=date('Y-m-d', strtotime('last month'));
$date1=date_create($sd);
$date2=date_create($ed);
$diff=date_diff($date1,$date2);
$count=$diff->format("%a");
$j=0;
for($i=0;$i<$count;$i++){
$currmonth = date('Y-m-d', strtotime('-'.$i.' day'));
if($report_id == 1){
	if($account_type == 'superadmin'){
$qry=$this->db->get_where('inpatient', array('hospital_id' => $hospital_id[$h],'status!='=>0,'created_date>='=>date('Y-m-d 00:00:00', strtotime('-'.$i.' day')),'created_date<='=>date('Y-m-d 23:59:59', strtotime('-'.$i.' day'))))->num_rows();
	}elseif($account_type == 'hospitaladmins'){
		$this->db->where('branch_id', $hospital_id[$h]);
        $no=$this->db->get('doctors')->result_array();
            $qry=0;
            for($da=0;$da<count($no);$da++){
                $qry=$qry+$this->db->get_where('inpatient', array('doctor_id' => $no[$da]['doctor_id'],'status!='=>0,'created_date>='=>date('Y-m-d 00:00:00', strtotime('-'.$i.' day')),'created_date<='=>date('Y-m-d 23:59:59', strtotime('-'.$i.' day'))))->num_rows();   
            }
	}

}elseif($report_id == 2){
		if($account_type == 'superadmin'){
$qry=$this->db->get_where('appointments', array('hospital_id' => $hospital_id[$h],'appointment_date'=>date('m/d/Y', strtotime('-'.$i.' day')),'status'=>2))->num_rows();
	}elseif($account_type == 'hospitaladmins'){
		$this->db->where('branch_id', $hospital_id[$h]);
            $no=$this->db->get('doctors')->result_array();
            $cou=0;
            for($da=0;$da<count($no);$da++){
                $cou=$cou+$this->db->get_where('appointments', array('doctor_id' => $no[$da]['doctor_id'],'appointment_date'=>date('m/d/Y', strtotime('-'.$i.' day')),'status'=>2))->num_rows();
            }
            $qry=$cou;
	}

}
$data[$j]=array('x'=>strtotime($currmonth)*1000,'y'=>$qry);
$j++;
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
	},

	data: <?php echo $data_list;?>
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
<div class="row">
    <div class="col-md-12">
                <div class="panel panel-default">   
            <div class="panel-heading">
<div class="control-label">
  <input type="button" class="btn btn-info pull-right" value="<?php echo get_phrase('close'); ?>" onclick="window.location.href = '<?= base_url('main/report/').$report_id; ?>'">
</div>
</div>
<div class="panel-body">
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
</div>
</div>
</div>
</div>
<!-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->
<!-- <script src="<?php echo base_url();?>assets/js/canvasjs.min.js"></script> -->