<table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
<tr>
<th><?php echo $this->lang->line('tableHeaders')['date']; ?></th>&nbsp;&nbsp;&nbsp;
<th>Time</th>
<th><?php echo $this->lang->line('labels')['role']; ?></th>
<th><?php echo $this->lang->line('labels')['user']; ?></th>
<th><?php echo $this->lang->line('tableHeaders')['action'];?></th>
<th><?php echo $this->lang->line('tableHeaders')['message'];?></th>
</tr>
<?php foreach($GetapptHistory as $Row){
$UserRole = $this->auth->GetUserRoleByUserID($Row->CreatedBy);
if($UserRole == '1'){
$RoleName = 'Admin';
}elseif($UserRole == '2'){
$RoleName = 'Hospital Admin';
}elseif($UserRole == '3'){
$RoleName = 'Doctor';
}elseif($UserRole == '4'){
$RoleName = 'Nurse';
}elseif($UserRole == '5'){
$RoleName = 'Receptionist';
}elseif($UserRole == '6'){
$RoleName = 'MyPulse User';
}
 ?>
<tr>

<td><?php echo date('d-m-Y', strtotime($Row->CreatedDate)); ?></td>
<td><?php echo date('H:i:s A', strtotime($Row->CreatedDate)); ?></td>
<td><?php echo $RoleName; ?></td>
<td><?php echo $this->auth->GetuserNameByID($Row->CreatedBy); ?></td>
<td><?php  echo $Row->Action; ?></td>
<td><?php  echo $Row->Message.' '.$Row->AppointmentDate.' '.$Row->AppointmentTimeStart.'-'.$Row->AppointmentTimeEnd; ?></td>

</tr>
<?php } ?>
</table>