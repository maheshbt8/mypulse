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
$start = new DateTime($sd);
$end = (new DateTime($ed))->modify('+1 day');
$interval = new DateInterval('P1D');
$period   = new DatePeriod($start, $interval, $end);
$j=0;
foreach ($period as $dt) {
$date=$dt->format("m/d/Y");
$currmonth = $dt->format('Y-m-d');
if($report_id == 1){
	if($account_type == 'superadmin'){
$qry=$this->db->get_where('inpatient', array('hospital_id' => $hospital_id[$h],'status!='=>0,'created_date>='=>$currmonth.' 00:00:00','created_date<='=>$currmonth.' 23:59:59'))->num_rows();
	}elseif($account_type == 'hospitaladmins'){
		$this->db->where('branch_id', $hospital_id[$h]);
        $no=$this->db->get('doctors')->result_array();
            $qry=0;
            for($da=0;$da<count($no);$da++){
                $qry=$qry+$this->db->get_where('inpatient', array('doctor_id' => $no[$da]['doctor_id'],'status!='=>0,'created_date>='=>$currmonth.' 00:00:00','created_date<='=>$currmonth.' 23:59:59'))->num_rows();
            }
	}
}elseif($report_id == 2){
		if($account_type == 'superadmin'){
$qry=$this->db->get_where('appointments', array('hospital_id' => $hospital_id[$h],'appointment_date'=>$date))->num_rows();
	}elseif($account_type == 'hospitaladmins'){
		$this->db->where('branch_id', $hospital_id[$h]);
            $no=$this->db->get('doctors')->result_array();
            $cou=0;
            for($da=0;$da<count($no);$da++){
                $cou=$cou+$this->db->get_where('appointments', array('doctor_id' => $no[$da]['doctor_id'],'appointment_date'=>$date))->num_rows();
            }
            $qry=$cou;
	}
}
$dates[$j]='"'.date('M d-Y',strtotime($currmonth)).'"';
$data[$j]=$qry;
$j++;
}
$color = dechex(rand(0xBDBDBD, 0x323232));
$dataPoints[$h]=$data;
	$data_points[]= '{
		label: "'.$row['name'].'",
        fillColor : "#'.$color.'",
        strokeColor : "#'.$color.'",
        pointColor : "#'.$color.'",
        pointStrokeColor : "#fff",
        pointHighlightFill : "#fff",
        pointHighlightStroke : "rgba(48, 164, 255, 1)",
        data : '.json_encode($dataPoints[$h]).'
	}';
	$colors[]=$color;
}
$trend_dates=implode(',', $dates);
$data_list=implode(',',$data_points);

?>
  <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">

           <center><small class="pull-left"><?php echo ' ( '.$sd.' To '.$ed.' ) ';?></small>
                    <?php print_r(implode(' vs ',$hospital_name));?>
                      <input type="button" class="btn btn-info pull-right" value="<?php echo get_phrase('close'); ?>" onclick="window.location.href = '<?= base_url('main/report/').$report_id; ?>'">
                      <!-- <ul class="pull-right panel-settings panel-button-tab-right">
                                <li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
                                    <em class="fa fa-cogs"></em>
                                </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <ul class="dropdown-settings">
                                                <li><a href="#">
                                                    <em class="fa fa-cog"></em> Settings 1
                                                </a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">
                                                    <em class="fa fa-cog"></em> Settings 2
                                                </a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">
                                                    <em class="fa fa-cog"></em> Settings 3
                                                </a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul> -->
                  </center>
                          </div>
                        <div class="panel-body">
                            <div class="canvas-wrapper">
                                <canvas class="chart" id="line-chart" height="200" width="600"></canvas>
                            </div>
<?php
for($col=0;$col<count($hospital_name);$col++){
?>
<span style="color:#<?=$colors[$col];?>"><i class="fa fa-dot-circle-o fa-lg" aria-hidden="true" title="Not-Attended"></i>&nbsp;&nbsp;<?=$hospital_name[$col];?></span><br/>
<?php } ?>
                        </div>
                    </div>
                </div>
            </div><!--/.row-->
<script>
var randomScalingFactor = function(){ return Math.round(Math.random())};
var lineChartData = {
labels : [<?=$trend_dates;?>],
datasets : [<?=$data_list;?>
]
}
</script>
