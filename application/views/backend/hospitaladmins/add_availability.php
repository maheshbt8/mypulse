<?php $doctor=$this->db->where('doctor_id',$doctor_id)->get('doctors')->row();
$availability=$this->db->where('doctor_id',$doctor_id)->get('availability')->row();
$availability_slat=$this->db->get_where('availability_slat',array('doctor_id'=>$doctor_id,'status'=>1))->result_array();
?>

<div class="row">
    <div class="col-md-3">
			<center>
        <a href="#">
  				<img src="<?php echo base_url()?>uploads/doctor_image/<?php echo $doctor->doctor_id.'.jpg';?>" class="img-circle" style="width: 60%;">
  			</a>
        <br>
        <h3><?php echo $doctor->name;?></h3>
        <br>
        <span>
        <?php echo $doctor->description;?></span>
      </center>
		</div>
   
    <div class="col-md-8">
        <form action="<?php echo base_url()?>index.php?superadmin/doctor_availability/update/<?php echo $doctor->doctor_id;?>" method="post" class="form-horizontal form-groups-bordered validate" id="form1" enctype="multipart/form-data">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <div class="">
                            <div class="custome_col8">
                                <h3 class="panel-title panel_heading_custome"><?php echo $this->lang->line('availability'); ?></h3>
                               <button onclick="" class="btn btn-primary pull-right"><?php echo $this->lang->line('buttons')['save'];?></button>
                               
                            </div>
                            
                            <br>
                        </div>
                    </div>
                    <div class="panel-body" id="profileBody">
                       
                            
							<input type="hidden" name="doctor_id" class="DoctorID" value="<?php echo $doctor->doctor_id;?>">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('labels')['noAppInterval'];?>30 Minutes</label>
                                    <input style="width:80px" value="<?php echo $availability->no_appt_handle;?>" class="form-control" type="number" name="no_appt_handle" id="no_appt_handle" minlength="1" maxlength="1">
                                </div>
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('labels')['availabilityText'];?></label>
                                    <textarea class="form-control " placeholder="<?php echo $this->lang->line('labels')['availabilityTextPlace'];?>" name="message" id="availability_text"><?php echo $availability->message;?></textarea>
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
                            <?php echo $this->lang->line('labels')['doctor_availability_schedule'];?>
                            
                        </div>
                    </div>
                    <div class="panel-body" style="padding:0px;">
                        <div class="calendar-env">
                            <div class="calendar-body"><a href="<?php echo base_url();?>index.php?superadmin/doctor_new_availability/<?php echo $doctor->doctor_id;?>"><button class="btn btn-primary pull-right"><?php echo $this->lang->line('buttons')['addNew'];?></button></a>
       
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
    
						?>
						{
						    url:"<?php echo base_url();?>index.php?superadmin/edit_doctor_new_availability/<?php echo $doctor_id.'/'.$row['id'];?>",
						    title: "<?php echo $row['start_time'].'-'.$row['end_time'];?>",
							start: new Date(<?php echo date('Y',strtotime($row['date']));?>, <?php echo date('m',strtotime($row['date']))-1;?>, <?php echo date('d',strtotime($row['date']));?>),
					
						},
						<?php

						endforeach
						?>

					]

				});
	});
  </script>
  
  
  
