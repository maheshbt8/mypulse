<?php 
$doctor=$this->db->where('doctor_id',$doctor_id)->get('doctors')->row();
$availability=$this->db->where('doctor_id',$doctor_id)->get('availability')->row();
$availability_slot=$this->db->get_where('availability_slot',array('doctor_id'=>$doctor_id,'row_status_cd'=>1))->result_array();
$this->session->set_userdata('last_page1', current_url());
?>
<?php if($availability->no_appt_handle==0 && $availability->message==''){?>
<div class="alert alert-danger">
  <strong>To Add Available Timings You have to add Availability Details First</strong>
</div>
<?php }?>

<input type="button" class="btn btn-info pull-right" value="<?php echo get_phrase('close'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'" style="margin-left: 2px;">
<div class="row">
    <div class="">
            <div class="panel-body">
    <div class="col-md-3">
			<center>
        <a href="#">
  				<img src="<?=base_url().$this->crud_model->get_image_url('doctor' , $doctor->doctor_id);?>" class="img-circle" style="width: 50%;">
  			</a>
        <br>
        <h3><?php echo 'Dr.'.$doctor->name;?></h3>
        <br>
        <span>
        <b style="font-size: 15px;"><?php echo $this->db->where('hospital_id',$doctor->hospital_id)->get('hospitals')->row()->name.' / '.$this->db->where('branch_id',$doctor->branch_id)->get('branch')->row()->name.' / '.$this->db->where('department_id',$doctor->department_id)->get('department')->row()->name;?></b></span>
        <span>
        <?php $spe=explode(',', $doctor->specializations);
            for($i=0;$i<count($spe);$i++){
                $specializations[]=$this->db->where('specializations_id',$spe[$i])->get('specializations')->row()->name;
            }
            echo implode(',',$specializations);
        ?>
            
        </span>
      </center>
		</div>
   
    <div class="col-md-8">
        <form action="<?php echo base_url()?>main/doctor_availability/update/<?php echo $doctor->doctor_id;?>" method="post" class="form-horizontal form-groups-bordered validate" id="form1" enctype="multipart/form-data">
                <div class="panel panel-white">
                    <div class="panel-heading ">
                            <div class="custome_col8">
                                <h3 class="panel-title panel_heading_custome"><?php echo $this->lang->line('availability'); ?></h3>
                            </div>
                    </div>
                    <div class="panel-body" id="profileBody">
							<input type="hidden" name="doctor_id" class="DoctorID" value="<?php echo $doctor->doctor_id;?>">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('labels')['noAppInterval'];?>30 Minutes</label>
                                    <input style="width:80px" value="<?php echo $availability->no_appt_handle;?>" class="form-control" type="number" name="no_appt_handle" id="no_appt_handle" min="1" max="30">
                                </div>
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('labels')['availabilityText'];?></label>
                                    <textarea class="form-control " placeholder="<?php echo $this->lang->line('labels')['availabilityTextPlace'];?>" name="message" id="availability_text"><?php echo $availability->message;?></textarea>
                                </div>
                                <?php if($account_type != 'users'){?>
                               <input type="submit" onclick="" class="btn btn-primary pull-right" value="Save">
                               <?php }?>
                            </div>  
                    </div>
                </div>
        </form>
    </div>
</div>
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
                             <?php if($account_type != 'users'){?>
                                <button class="btn btn-primary pull-right" onclick="window.location.href = '<?php echo base_url();?>main/doctor_new_availability/<?php echo $doctor->doctor_id;?>'" <?php if($availability->no_appt_handle==0 && $availability->message==''){echo 'disabled';}?>>Add New</button>
                            <?php }?>
                        </div>
                    </div>
                    <div class="panel-body" style="padding:0px;">
                        <div class="calendar-env">
                            <div class="calendar-body">
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
					
						foreach($availability_slot as $row):    
    
						?>
						{
						    url:"<?php echo base_url();?>main/edit_doctor_new_availability/<?php echo $doctor_id.'/'.$row['id'];?>",
						    title: "<?php echo date("h:i a", strtotime($row['start_time'])).'-'.date("h:i a", strtotime($row['end_time']));?>",
							start: new Date(<?php echo date('Y',strtotime($row['date']));?>, <?php echo date('m',strtotime($row['date']))-1;?>, <?php echo date('d',strtotime($row['date']));?>),
					
						},
						<?php

						endforeach
						?>

					]

				});
	});
  </script>
  
  
  
