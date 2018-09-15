<?php $doctor=$this->db->where('doctor_id',$doctor_id)->get('doctor')->row();
$availability=$this->db->where('doctor_id',$doctor_id)->get('availability')->row();
$availability_slat=$this->db->where('doctor_id',$doctor_id)->get('availability_slat')->result_array();

?>
<hr />
<div class="row">
    <div class="col-md-3">
			<center>
        <a href="#">
  				<img src="<?php echo base_url()?>uploads/doctor_image/<?php echo $doctor->doctor_id.'.jpg';?>" class="img-circle" style="width: 60%;">
  			</a>
        <br>
        <h3><?php echo $doctor->name;?></h3>
        <br>
        <span></span>
        <p><?php echo $doctor->description;?></p>
      </center>
		</div>
   
    <div class="col-md-8">
        <form action="<?php echo base_url()?>index.php?superadmin/doctor_availability/update/<?php echo $doctor->doctor_id;?>" method="post" id="form1" enctype="multipart/form-data">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <div class="">
                            <div class="custome_col8">
                                <h3 class="panel-title panel_heading_custome">Other Settings</h3>
                               <button onclick="" class="btn btn-primary pull-right">save</button>
                               
                            </div>
                            
                            <br>
                        </div>
                    </div>
                    <div class="panel-body" id="profileBody">
                       
                            
							<input type="hidden" name="doctor_id" class="DoctorID" value="<?php echo $doctor->doctor_id;?>">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Number of patients that can be handled in 30 Minutes</label>
                                    <input style="width:50px" value="<?php echo $availability->no_appt_handle;?>" class="form-control" type="text" name="no_appt_handle" id="no_appt_handle" >
                                </div>
                                <div class="form-group">
                                    <label>Availability message(For Patients)</label>
                                    <textarea class="form-control " placeholder="E.g. Available on every Monday to Friday." name="message" id="availability_text"><?php echo $availability->message;?></textarea>
                                </div>
                            </div>    
                        
                    </div>
                </div>
        </form>
    </div>
</div>
<div class="row">
	<div class="col-md-12">
    	<div class="row">
            <!-- CALENDAR-->
            
            <div class="col-md-12 col-xs-12">
                <div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-calendar"></i>
                            <?php echo get_phrase('doctor_availability_schedule'); ?>
                            
                        </div>
                    </div>
                    <div class="panel-body" style="padding:0px;">
                        <div class="calendar-env">
                            <div class="calendar-body"><a href="<?php echo base_url();?>index.php?superadmin/doctor_new_availability/<?php echo $doctor->doctor_id;?>"><button class="btn btn-primary pull-right">
        Add New</button></a>
       
                                <div id="notice_calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

	

</div>



    <script>
  $(document).ready(function() {

	  var calendar = $('#notice_calendar');

				$('#notice_calendar').fullCalendar({
					header: {
						left: 'title',
						right: 'today prev,next'
					},

					//defaultView: 'basicWeek',

					editable: false,
					firstDay: 0,
					height: 530,
					droppable: false,

					events: [
						<?php
					
						foreach($availability_slat as $row):
					    
$start    = new DateTime($row['start_date']);
$end      = (new DateTime($row['end_date']))->modify('+1 day');
$interval = new DateInterval('P1D');
$period   = new DatePeriod($start, $interval, $end);
$day=explode(',',$row['repeat_on']);
$days=array(0=>'Sun',1=>'Mon',2=>'Tue',3=>'Wed',4=>'Thu',5=>'Fri',6=>'Sat');
foreach ($period as $dt) {
  for($i=0;$i<count($day);$i++){
     for($j=0;$j<count($days);$j++){
     if(($dt->format("D")==$days[$j]) && ($day[$i] == $j)){
    
    

						?>
						{
						    url:"<?php echo base_url();?>index.php?superadmin/edit_doctor_new_availability/<?php echo $doctor_id.'/'.$row['id'];?>",
						    title: "<?php echo $row['start_time'].'-'.$row['end_time'];?>",
							start: new Date(<?php echo date('Y',strtotime($dt->format("m/d/Y")));?>, <?php echo date('m',strtotime($dt->format("m/d/Y")))-1;?>, <?php echo date('d',strtotime($dt->format("m/d/Y")));?>),
					
						},
						<?php
}}
    }
   
    }
						endforeach
						?>

					]

				});
	});
  </script>
  
  
  
