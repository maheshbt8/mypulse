

<div class="row">
      <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>index.php?superadmin/hospital">
            <div class="tile-stats tile-white-gray  tile-white-primary">
                <div class="icon"><i class="fa fa-h-square"></i></div>
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('hospitals'); ?>"
                     data-duration="1500" data-delay="0">0 </div>
                <h3><?php echo $this->lang->line('hospitals');?></h3>
            </div>
        </a>
    </div>
    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>index.php?superadmin/doctor">
            <div class="tile-stats tile-white tile-white-primary">
                <div class="icon"><i class="fa fa-user-md"></i></div>
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('doctors'); ?>"
                     data-duration="1500" data-delay="0">0 </div>
                <h3><?php echo $this->lang->line('doctors');?></h3>
            </div>
        </a>
    </div>
   
    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>index.php?superadmin/patient">
            <div class="tile-stats tile-white-red">
                <div class="icon"><i class="fa fa-user"></i></div>
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('users'); ?>" 
                     data-duration="1500" data-delay="0">0 </div>
                <h3><?php echo $this->lang->line('mypulse_users');?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-3">
        <a href="#">
            <div class="tile-stats tile-white-aqua">
                <div class="icon"><i class="fa fa-plus-square"></i></div>
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('appointments'); ?>" 
                     data-duration="1500" data-delay="0">0 </div>
                <h3><?php echo $this->lang->line('appointments');?></h3>
            </div>
        </a>
    </div>

</div>
<?php
$date_val='10/08/2018';
    
        $doctor_availability= $this->db->get_where('availability_slat' , array(
            'doctor_id' => 10,'date'=>$date_val,'status'=>1));
        $doctor_ava=$doctor_availability->result_array();
         
        /* print_r($doctor_ava);die;*/
         if($doctor_availability->num_rows()>0){
            echo '<option value=""> Select Slot </option>';
        foreach ($doctor_ava as $row) {
            $sdate=$row['start_time'];
            $edate=$row['end_time'];
            $count=((((strtotime($edate)-strtotime($sdate))/60)/60)*2);
            $start_time1=strtotime($sdate);
            for($i=1;$i<=$count;$i++){
                $start_time2=strtotime("+30 minutes", $start_time1);
                /*echo date('H:i',$start_time1);
                echo date('H:i',$start_time2);*/
                $appointments=$this->db->get_where('appointments' , array('doctor_id' => 10,'appointment_date'=>$date_val,'appointment_time_start'=>date('H:i',$start_time1),'appointment_time_end'=>date('H:i',$start_time2)))->num_rows();
         echo $appointments;
         if($appointments >= 3){
            echo '<option value="'.date('h:i a',$start_time1) .' - '.date('h:i a', $start_time2).'" disabled>' . date('h:i a',$start_time1) .' - '.date('h:i a', $start_time2).'</option>';
        }else{
            echo '<option value="'.date('h:i a',$start_time1) .' - '.date('h:i a', $start_time2).'" >' . date('h:i a',$start_time1) .' - '.date('h:i a', $start_time2).'</option>';
        }
            $start_time1=$start_time2;
        }

        }
        }
    
?>