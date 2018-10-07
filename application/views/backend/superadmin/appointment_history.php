<?php 
$appointment_info = $this->db->get_where('appointments', array('appointment_id' => $param2))->result_array();

    /*print_r($row);*/
?>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value="" onclick="toggle(this);"></th>
            <th><?php echo get_phrase('appointment_no');?></th> 
            <th><?php echo get_phrase('user');?></th>
            <th><?php echo get_phrase('doctor');?></th>
            <th><?php echo get_phrase('department');?></th>  
            <th><?php echo get_phrase('time');?></th>
            <th><?php echo get_phrase('date');?></th>
            <th><?php echo get_phrase('status'); ?></th>
            <th><?php echo get_phrase('options');?></th>
        </tr> 
    </thead>

    <tbody>
        <?php $i=1;foreach ($appointment_info as $row) { ?>   
            <tr>
                <td><input type="checkbox" name="check[]" class="check" id="check_<?php echo $i;?>" value="<?php echo $row['appointment_id'] ?>"></td>
                 <td><a href="<?php echo base_url(); ?>index.php?superadmin/edit_appointment/<?php echo $row['appointment_id'] ?>" class="hiper"><?php echo $row['appointment_number'] ?></a></td>
                <td>
                   <a href="<?php echo base_url();?>index.php?superadmin/edit_user/<?php echo $row['user_id']?>" class="hiper"> <?php $name = $this->db->get_where('users' , array('user_id' => $row['user_id'] ))->row()->unique_id;
                        echo $name;?></a>
                </td>
                 <td>
                    <a href="<?php echo base_url(); ?>index.php?superadmin/edit_doctor/<?php echo $row['doctor_id'] ?>" class="hiper"><?php $name = $this->db->get_where('doctors' , array('doctor_id' => $row['doctor_id'] ))->row()->unique_id;
                        echo $name;?></a>
                </td>
                <td>
                    <?php if($row['department_id'] == 0){$name='All Departments';}else{$name = $this->db->get_where('department' , array('department_id' => $row['department_id'] ))->row()->name;}
                        echo $name;?>
                </td>
                <td><?php echo date("h:i A", strtotime($row['appointment_time_start'])).' - '.date("h:i A", strtotime($row['appointment_time_end']));?></td>
                <td><?php echo date("M d/Y",strtotime($row['appointment_date']));?></td>
                <td><?php if($row['status'] == 1){echo "<button type='button' class='btn-danger'>Pending</button>";   
                 }
                 elseif($row['status'] == 2){ echo "<button type='button' class='btn-success'>Confirmed</button>";}
                 elseif($row['status'] == 3){ echo "<button type='button' class='btn-info'>Cancelled</button>";}
                 elseif($row['status'] == 4){ echo "<button type='button' class='btn-warning'>Colsed</button>";}
                 ?>
                     
                 </td>
                <td>
                    <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?superadmin/appointment/delete/<?php echo $row['appointment_id']?>');" id="dellink_2" class="delbtn" data-toggle="modal" data-target=".bs-example-modal-sm" data-id="2" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
