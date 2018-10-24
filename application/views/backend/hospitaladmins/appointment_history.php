<?php 
$appointment_info = $this->db->get_where('appointment_history', array('appointment_id' => $param2))->result_array();

    /*print_r($row);*/
?>
<center><b>Appointment Id : <?php echo $this->db->where('appointment_id',$param2)->get('appointments')->row()->appointment_number;?></b></center>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><?php echo get_phrase('creation_date');?></th> 
            <th><?php echo get_phrase('creation_time');?></th>
            <th><?php echo get_phrase('Role');?></th>
            <th><?php echo get_phrase('Name');?></th>  
            <th><?php echo get_phrase('action');?></th>
            <th><?php echo get_phrase('message');?></th>
        </tr> 
    </thead>

    <tbody>
        <?php $i=1;foreach ($appointment_info as $row) {
         ?>   
            <tr>
                <?php
$hos=explode('-', $row['created_by']);
if($hos[0] == 'superadmin'){
  $user_role='Super Admin';
}elseif($hos[0] == 'hospitaladmins'){
  $user_role='Hospital Admin';
}elseif($hos[0] == 'doctors'){
  $user_role='Doctor';
}elseif($hos[0] == 'nurse'){
  $user_role='Nurse';
}elseif($hos[0] == 'receptionist'){
  $user_role='Receptionist';
}elseif($hos[0] == 'medicalstores'){
  $user_role='Pharmacist';
}elseif($hos[0] == 'medicallabs'){
  $user_role='Laboratorist';
}elseif($hos[0] == 'users'){
  $user_role='MyPulse Users';
}

                ?>
                 <td><?php echo date('d M,Y', strtotime($row['created_time']));?></td>
                <td><?php echo date('h:i A', strtotime($row['created_time']));?></td>
                 <td><?php echo $user_role;?></td>
                <td><?php echo $this->db->where($hos[1].'_id',$hos[2])->get($hos[0])->row()->name;?></td>
                <td><?php 
                if($row['action'] == 1){echo "Created";}
                elseif($row['action'] == 2){ echo "Pending";}
                elseif($row['action'] == 3){ echo "Confirmed";}
                elseif($row['action'] == 4){ echo "Updated";}
                elseif($row['action'] == 5){ echo "Rescheduled";}
                elseif($row['action'] == 6){ echo "Cancelled";}
                elseif($row['action'] == 7){ echo "Colsed";}
                 ?></td>
                <td><?php if($row['action'] == 1){echo 'Appointment Created for '.date('d M,Y', strtotime($row['appointment_date'])).' - '.date('h:i A', strtotime($row['appointment_time_start'])).' - '.date('h:i A', strtotime($row['appointment_time_end']));}
                elseif($row['action'] == 2){ echo "This Appointment Was Pending";}
                elseif($row['action'] == 3){ echo "This Appointment Was Confirmed";}
                elseif($row['action'] == 4){ echo "Appointment Updated for".date('d M,Y', strtotime($row['appointment_date'])).' - '.date('h:m A', strtotime($row['appointment_time_start'])).' - '.date('h:m A', strtotime($row['appointment_time_end']));}
                elseif($row['action'] == 5){ echo "Appointment Rescheduled for".date('d M,Y', strtotime($row['appointment_date'])).' - '.date('h:m A', strtotime($row['appointment_time_start'])).' - '.date('h:m A', strtotime($row['appointment_time_end']));}
                elseif($row['action'] == 6){ echo "This Appointment Was Cancelled";}
                elseif($row['action'] == 7){ echo "This Appointment Was Closed";}
                ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
