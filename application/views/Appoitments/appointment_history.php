<table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
<tr>
<th><?php echo $this->lang->line('DateTime'); ?></th>
<th><?php echo $this->lang->line('Role_User'); ?></th>
<th><?php echo $this->lang->line('tableHeaders')['action'];?></th>
<th><?php echo $this->lang->line('tableHeaders')['message'];?></th>
</tr>
<?php foreach($GetapptHistory as $Row){
$Message = $Row->reason;
$Message .= $Row->remarks;
 ?>
<tr>

<td><?php echo date('d-m-Y H:i:s A', strtotime($Row->created_at)); ?></td>
<td><?php echo $this->auth->GetuserNameByID($Row->CreatedBy); ?></td>
<td><?php  echo $Row->description; ?></td>
<td><?php echo $Message; ?></td>

</tr>
<?php } ?>
</table>