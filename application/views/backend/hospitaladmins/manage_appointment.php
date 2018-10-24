<?php 
$this->session->set_userdata('last_page', current_url());
?>
<form action="<?php echo base_url()?>index.php?hospitaladmins/appointment/delete_multiple/" method="post">
<!-- <button type="button" onClick="confclose(this.form);" id="close" class="btn btn-warning pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('close'); ?>
</button>
<button type="button" onClick="checkone(this.form);" id="close1" class="btn btn-warning pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('close'); ?>
</button> -->
<button type="button" onClick="confSubmit(this.form);" id="delete" class="btn btn-danger pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onClick="checkone(this.form);" id="delete1" class="btn btn-danger pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onclick="window.location.href = '<?php echo base_url();?>index.php?hospitaladmins/add_appointment'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_appointment'); ?>
</button>
<div style="clear:both;"></div>
<br>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value=""></th>
            <th><?php echo get_phrase('appointment_no');?></th> 
            <th><?php echo get_phrase('user');?></th>
            <th><?php echo get_phrase('doctor');?></th>
            <th><?php echo get_phrase('Hospital-Branch-Department');?></th>  
            <th><?php echo get_phrase('city');?></th> 
            <th><?php echo get_phrase('date & time');?></th>
            <th><?php echo get_phrase('status'); ?></th>
            <th><?php echo get_phrase('options');?></th>
        </tr> 
    </thead>

    <tbody>
        <?php $i=1;foreach ($appointment_info as $row) { 
           /* print_r($row);die;*/
            if(strtotime($row['appointment_date']) < strtotime(date('m/d/Y')))
            {
                $count=$this->db->get_where('appointments',array('appointment_id' => $row['appointment_id'],'status'=>2 ))->num_rows();
                if($count>0){
                $array=array('appointment_id'=>$row['appointment_id'],'status'=>2);
                $this->db->where($array)->update('appointments',array('status'=>'4'));
                $this->db->insert('appointment_history',array('appointment_id'=>$row['appointment_id'],'action'=>7,'created_type'=>'System','created_by'=>'MyPulse'));
            /*$notification['created_by']=$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id');
            $notification['user_id']='users-user-'.$data['user_id'];
            $notification['title']='Appointment Booking';
            $notification['text']='Hi User Your Appointment is Booked Please Wait For The Confirmation.';
                $this->db->insert('notification',);*/
                }
            }
            ?>   
            <tr>
                <td><input type="checkbox" name="check[]" class="check" value="<?php echo $row['appointment_id'] ?>"></td>
                 <td><a href="<?php echo base_url(); ?>index.php?hospitaladmins/edit_appointment/<?php echo $row['appointment_id'] ?>" class="hiper"><?php echo $row['appointment_number'] ?></a></td>
                <td>
                   <!-- <a href="<?php echo base_url();?>index.php?superadmin/edit_user/<?php echo $row['user_id']?>" class="hiper"> <?php $name = $this->db->get_where('users' , array('user_id' => $row['user_id'] ))->row()->unique_id;
                        echo $name;?></a> -->
             <?php $name = $this->db->get_where('users' , array('user_id' => $row['user_id'] ))->row()->name;
                        echo $name;?>
                </td>
                 <td>
                    <!-- <a href="<?php echo base_url(); ?>index.php?superadmin/edit_doctor/<?php echo $row['doctor_id'] ?>" class="hiper"><?php $name = $this->db->get_where('doctors' , array('doctor_id' => $row['doctor_id'] ))->row()->unique_id;
                        echo $name;?></a> -->
                <?php $name = $this->db->get_where('doctors' , array('doctor_id' => $row['doctor_id'] ))->row()->name;
                        echo $name;?>
                </td>
                <td>
                    <?php 
                    $branch=$this->db->get_where('branch' , array('branch_id' => $this->db->where('doctor_id',$row['doctor_id'])->get('doctors')->row()->branch_id))->row();
                    $hospital=$this->db->get_where('hospitals' , array('hospital_id' => $this->db->where('branch_id',$branch->branch_id)->get('branch')->row()->hospital_id))->row();
                    if($row['department_id'] == 0){$name='All Departments';}else{$name = $this->db->get_where('department' , array('department_id' => $row['department_id'] ))->row()->name;}
                        echo $hospital->name.' - '.$branch->name.' - '.$name;?>
                </td>
                 <td><?php echo $this->db->where('city_id',$branch->city)->get('city')->row()->name;?></td> 
                <td><?php echo date("d M, Y",strtotime($row['appointment_date']));?><br/><?php echo date("h:i A", strtotime($row['appointment_time_start'])).' - '.date("h:i A", strtotime($row['appointment_time_end']));?></td>
                <td><?php if($row['status'] == 1){echo "<button type='button' class='btn-danger'>Pending</button>";   
                 }
                 elseif($row['status'] == 2){ echo "<button type='button' class='btn-success'>Confirmed</button>";}
                 elseif($row['status'] == 3){ echo "<button type='button' class='btn-info'>Cancelled</button>";}
                 elseif($row['status'] == 4){ echo "<button type='button' class='btn-warning'>Closed</button>";}
                 ?>
                     
                 </td>
                <td>
                    <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?hospitaladmins/appointment/delete/<?php echo $row['appointment_id']?>');" id="dellink_2" class="delbtn" data-toggle="modal" data-target=".bs-example-modal-sm" data-id="2" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</form>
<script type="text/javascript">   
    jQuery(window).load(function ()
    {
        var $ = jQuery;

        $("#table-2").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-md-3 col-xs-12 col-left'l><'col-md-9 col-xs-12  col-right'<'export-data'T>f>r>t<'row'<' col-md-3 col-xs-12 col-left'i><'col-md-9 col-xs-12 col-right'p>>"
        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });

        // Highlighted rows
        $("#table-2 tbody input[type=checkbox]").each(function (i, el)
        {
            var $this = $(el),
                    $p = $this.closest('tr');

            $(el).on('change', function ()
            {
                var is_checked = $this.is(':checked');

                $p[is_checked ? 'addClass' : 'removeClass']('highlight');
            });
        });

        // Replace Checboxes
        $(".pagination a").click(function (ev)
        {
            replaceCheckboxes();
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#delete1").show();
        $("#delete").hide();
        $("#close1").show();
        $("#close").hide();
        $("#all_check").click(function () {
            $('.check').attr('checked', this.checked);
            if($(".check:checked").length == 0){
                $("#delete1").show();
                $("#delete").hide();
                $("#close1").show();
                $("#close").hide();
            }else{
            $("#delete1").hide();
            $("#delete").show();
            $("#close1").hide();
            $("#close").show();
            }
            
        });
         $(".check").click(function(){
            if(($(".check:checked").length)!=0){
            $("#delete1").hide();
            $("#delete").show();
            $("#close1").hide();
            $("#close").show();
        if($(".check").length == $(".check:checked").length) {
            $("#all_check").attr("checked", "checked");
        } else {
            $("#all_check").removeAttr("checked");
        }
    }else{
        $("#delete1").show();
        $("#delete").hide();
        $("#close1").show();
        $("#close").hide();
    }
    });
    });
</script>