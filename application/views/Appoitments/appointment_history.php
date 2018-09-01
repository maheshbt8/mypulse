

test<table>
												<tr>
												<th><?php echo $this->lang->line('DateTime'); ?></th>
												<th><?php echo $this->lang->line('labels')['role']; ?></th>
												<th><?php echo $this->lang->line('labels')['message'];?></th>
												</tr>
												<?php foreach($GetapptHistory as $Row){ ?>
												<tr>
												
												<td><?php echo date('d-m-Y H:i:s A', strtotime($Row->created_at)); ?></td>
												<td><?php echo $this->auth->GetuserNameByID($Row->CreatedBy); ?></td>
												<td><?php  echo $Row->description; ?></td>
												
												</tr>
												<?php } ?>
												</table>