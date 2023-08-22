<?php 
$appointment_info = $this->db->get_where('appointment_history', array('appointment_id' => $appointment_id))->result_array();
$user = $this->db->get_where('appointments', array('appointment_id' => $appointment_id))->row()->user_id;
$user_info=$this->db->where('user_id',$user)->get('users')->row_array();
?>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">   
<div class="panel-heading">
 <input type="button" class="btn btn-orange pull-right" value="<?php echo get_phrase('back'); ?>" onclick="window.location.href = '<?= base_url('main/edit_appointment/').$appointment_id; ?>'">
</div>
<div class="panel-body">
  <h4><?php echo '<b>User ID</b> : '.$user_info['unique_id'];?></h4>
<h4><?php echo '<b>User Name</b> : '.$user_info['name'];?></h4>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><?php echo get_phrase('date');?></th> 
            <th><?php echo get_phrase('time');?></th>
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
if($row['created_by']!='MyPulse'){
$hos=explode('_',$row['created_by']);
$code=substr($hos[0], 0,-2);
$role_data=$this->crud_model->get_role($code);
$user_role=$role_data['role'];
}
                ?>
                 <td><?php echo date('d M,Y', strtotime($row['created_at']));?></td>
                <td><?php echo date('h:i A', strtotime($row['created_at']));?></td>
                 <td><?php if($row['created_by']!='MyPulse'){echo $user_role;}else{echo 'System';}?></td>
                <td><?php if($row['created_by']!='MyPulse'){echo $this->db->where('unique_id',$row['created_by'])->get($role_data['type'])->row()->name;}else{echo $row['created_by'];}?></td>
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
                elseif($row['action'] == 2){ echo "Appointment Was Pending";}
                elseif($row['action'] == 3){ echo "Appointment Was Confirmed";}
                elseif($row['action'] == 4){ echo "Appointment Updated for".date('d M,Y', strtotime($row['appointment_date'])).' - '.date('h:m A', strtotime($row['appointment_time_start'])).' - '.date('h:m A', strtotime($row['appointment_time_end']));}
                elseif($row['action'] == 5){ echo "Appointment Rescheduled for ".date('d M,Y', strtotime($row['appointment_date'])).' - '.date('h:i A', strtotime($row['appointment_time_start'])).' - '.date('h:i A', strtotime($row['appointment_time_end']));}
                elseif($row['action'] == 6){ echo "Appointment Was Cancelled Because Of ".$row['reason'];}
                elseif($row['action'] == 7){ echo "Appointment Was Closed";}else{
                  echo $row['reason'];
                }
                ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>
</div>
</div>
</div>