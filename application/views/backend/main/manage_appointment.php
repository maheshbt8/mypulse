<style>
    .modal-backdrop.in{
        z-index: auto;
    }
</style>
<?php 
$this->session->set_userdata('last_page', current_url());
?>
<form action="<?php echo base_url()?>main/appointment/delete_multiple/" method="post">
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">   
            <div class="panel-heading">
<div class="col-sm-5">
                  <div class="form-group">
         <span for="field-ta" class="col-sm-3 control-label"><b> <?php echo get_phrase('date_range'); ?></b></span> 
         <div class="col-sm-7">
        <input  class="form-control" onclick="return get_report_data(this.value)" name="report" id="reportrange" value="<?php if((isset($_GET['sd']) && $_GET['sd'] != "") AND (isset($_GET['ed']) && $_GET['ed'] != "")){echo date('M d,Y',strtotime($_GET['sd'])).' - '.date('M d,Y',strtotime($_GET['ed']));}else{echo 'Select Date Range';}?>"/>
        </div>
                </div>
</div>

<?php if($account_type=='superadmin'){?>
<button type="button" onClick="confclose1(this.form);" id="close" class="btn btn-warning pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('close'); ?>
</button>
<button type="button" onClick="checkone(this.form);" id="close1" class="btn btn-warning pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('close'); ?>
</button>
<?php }?>

<button type="button" data-toggle="modal" data-target="#myModal" onClick="confcancel1(this.form);" id="cancel" class="btn btn-warning pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('cancel'); ?>
</button>
<button type="button" onClick="checkone(this.form);" id="cancel1" class="btn btn-warning pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('cancel'); ?>
</button>

<?php if($account_type=='superadmin'){?>
<button type="button" onClick="confSubmit(this.form);" id="delete" class="btn btn-danger pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onClick="checkone(this.form);" id="delete1" class="btn btn-danger pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<?php }?>
<button type="button" onclick="window.location.href = '<?php echo base_url();?>main/add_appointment'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_appointment'); ?>
</button>
</div>
<div class="panel-body">
<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">
    <thead>
        <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value=""></th>
            <th data-field="id" data-sortable="true"><?php echo get_phrase('appointment_no.');?></th> 
            <th data-field="user" data-sortable="true"><?php echo get_phrase('user');?></th>
            <th data-field="doctor" data-sortable="true"><?php echo get_phrase('doctor');?></th>
            <th data-field="hospital" data-sortable="true"><?php echo get_phrase('Hospital-Branch-Department');?></th>  
            <th data-field="city" data-sortable="true"><?php echo get_phrase('city');?></th> 
            <th data-field="date" data-sortable="true"><?php echo get_phrase('date & time');?></th>
            <th data-field="status" data-sortable="true"><?php echo get_phrase('status'); ?></th>
            <th><?php echo get_phrase('options');?></th>
        </tr> 
    </thead>

    <tbody>
        <?php if($_GET['sd']!='' && $_GET['ed']!=''){
            $appointment_info=$this->crud_model->select_appointment_info_by_date($_GET['sd'],$_GET['ed']);}else{$appointment_info;}
        $i=1;foreach ($appointment_info as $row) {
            ?>   
            <tr>
                <td><input type="checkbox" name="check[]" class="check" id="check_<?php echo $i;?>" value="<?php echo $row['appointment_id'] ?>"></td>
                 <td><a href="<?php echo base_url(); ?>main/edit_appointment/<?php echo $row['appointment_id'] ?>" class="hiper"><?php echo $row['appointment_number'] ?></a></td>
                <td>
                   <!-- <a href="<?php echo base_url();?>main/edit_user/<?php echo $row['user_id']?>" class="hiper"> <?php $name = $this->db->get_where('users' , array('user_id' => $row['user_id'] ))->row()->unique_id;
                        echo $name;?></a> -->
             <a href="<?php echo base_url();?>main/edit_user/<?php echo $row['user_id']?>" class="hiper"><?php $name = $this->db->get_where('users' , array('user_id' => $row['user_id'] ))->row()->name;
                        echo $name;?></a>
                </td>
                 <td>
                    <!-- <a href="<?php echo base_url(); ?>main/edit_doctor/<?php echo $row['doctor_id'] ?>" class="hiper"><?php $name = $this->db->get_where('doctors' , array('doctor_id' => $row['doctor_id'] ))->row()->unique_id;
                        echo $name;?></a> -->
                <a href="<?php echo base_url();?>main/edit_doctor/<?php echo $row['doctor_id']?>" class="hiper"><?php $name = $this->db->get_where('doctors' , array('doctor_id' => $row['doctor_id'] ))->row()->name;
                        echo $name;?></a>
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
                    <?php if($account_type=='superadmin'){?>
                    <a href="#" onclick="confirm_modal('<?php echo base_url();?>main/appointment/delete/<?php echo $row['appointment_id']?>');" id="dellink_2" class="delbtn" data-toggle="modal" data-target=".bs-example-modal-sm" data-id="2" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
                    <!-- <a href="#" onclick="confirm_modal('<?php echo base_url();?>main/appointment/close/<?php echo $row['appointment_id']?>');" id="dellink_2" class="delbtn" data-toggle="modal" data-target=".bs-example-modal-sm" data-id="2" title="Close"><i class="glyphicon glyphicon-ban-circle"></i></a> -->
                    <?php }?>&nbsp;&nbsp;
                    <?php if($row['status']==2 && $account_type != 'users'){if($row['attended_status']==1){?><a href="<?php echo base_url(); ?>main/appointment/attended_status/<?= $row['appointment_id'];?>/0"><span style="color: green"><i class="fa fa-dot-circle-o fa-lg" aria-hidden="true" title="Attended"></i>&nbsp;&nbsp;</span></a><?php }elseif($row['attended_status']==0){?><a href="<?php echo base_url(); ?>main/appointment/attended_status/<?= $row['appointment_id'];?>/1"><span style="color: red"><i class="fa fa-dot-circle-o fa-lg" aria-hidden="true" title="Not-Attended"></i>&nbsp;&nbsp;</span></a><?php }}elseif($row['status']!=2 || $account_type == 'users'){if($row['attended_status']==1){?><span style="color: brown;"><i class="fa fa-dot-circle-o fa-lg" aria-hidden="true" title="Attended"></i>&nbsp;&nbsp;</span><?php }elseif($row['attended_status']==0){?><span style="color: brown"><i class="fa fa-dot-circle-o fa-lg" aria-hidden="true" title="Not-Attended"></i>&nbsp;&nbsp;</span><?php }}?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>
</div>
 </div>
</div>
</form>
<script>
    $(document).ready(function(){
        $("#delete1").show();
        $("#delete").hide();
        $("#close1").show();
        $("#close").hide();
        $("#cancel1").show();
        $("#cancel").hide();
 $(".all_check").click(function () {
    if($(this).prop("checked") == true){
                $("#delete1").hide();
                $("#delete").show();
                $("#close1").hide();
                $("#close").show();
                $("#cancel1").hide();
                $("#cancel").show();
            }
            else if($(this).prop("checked") == false){
                $("#delete1").show();
                $("#delete").hide();
                $("#close1").show();
                $("#close").hide();
                $("#cancel1").show();
                $("#cancel").hide();
            }
     $('input:checkbox').not(this).prop('checked', this.checked);
 });
         $(".check").click(function(){
            if(($(".check:checked").length)!=0){
            $("#delete1").hide();
            $("#delete").show();
            $("#close1").hide();
            $("#close").show();
            $("#cancel1").hide();
            $("#cancel").show();
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
        $("#cancel1").show();
        $("#cancel").hide();
    }
    });
    });
</script>

 <script>
       function confclose1(form) {
            /*form.submit();*/
            $.ajax({
            type: 'post',
            url: '<?php echo base_url();?>main/appointment/close_multiple/',
            data: $('form').serialize(),
            success: function (response) {
                window.location.reload();
            }
          });  
}
 function opt_submit(form) {
            $.ajax({
            type: 'post',
            url: '<?php echo base_url();?>main/appointment_cancel/cancel_multiple/',
            data: $('form').serialize(),
            success: function (response) {
               /* alert(response);*/
                if(response == 1){
                window.location.reload();
                }else{
                jQuery('#reason_error').html(response);
                }
            }
          });  
}
   </script>
   

    <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Reason</h4>
        </div>
        <div class="modal-body">
         <form role="form" class="form-horizontal form-groups-bordered validate" action="" method="post" enctype="multipart/form-data">
                <div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">
         <div class="panel-body">
                <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo "Reason";?></label>
                        <div class="col-sm-8">
                            <input type="text" name="cancel_reason" class="form-control" id="cancel_reason"  data-validate="required" data-message-required="Value Required" value="<?php echo set_value('otp'); ?>" autocomplete="off">
                            <span id="reason_error"></span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 control-label col-sm-offset-2">
                        <input type="button" class="btn btn-success" value="Submit" onClick="opt_submit(this.form);">
                </div>
                </div>
                </div>
        </div>
    </div>
</div>
        </form>
        </div>
      </div>   
    </div>
  </div>  
  <script type="text/javascript">
        
    $(document).ready(function(){
        var start = moment();
        var end = moment();

        <?php
        if(isset($_GET['sd']) && $_GET['sd'] != ""){
            ?>
            start = moment('<?php echo $_GET['sd'];?>');
            <?php
        }
        ?>

        <?php
        if(isset($_GET['ed']) && $_GET['ed'] != ""){
            ?>
            end = moment('<?php echo $_GET['ed'];?>');
            <?php
        }
        ?>
        function cb(start, end) {
            window.location.href = '<?php echo base_url();?>main/appointment?sd='+start.format('YYYY-MM-DD')+"&ed="+end.format('YYYY-MM-DD');

        }
        
        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            locale: { 
                applyLabel : '<?php echo $this->lang->line('apply');?>',
                cancelLabel: '<?php echo $this->lang->line('clear');?>',
                "customRangeLabel": "<?php echo $this->lang->line('custom');?>",
            },  
            ranges: {
                '<?php echo 'Today';?>': [moment(), moment()],
                '<?php echo 'Tomorrow';?>': [moment().add(1, 'days'), moment().add(1, 'days')],
                '<?php echo 'Upcoming 7 day';?>': [moment(),moment().add(6, 'days')],
                '<?php echo 'Upcoming 30 day';?>': [moment(),moment().add(29, 'days'),],
                '<?php echo 'This Month';?>': [moment().startOf('month'), moment().endOf('month')],
                '<?php echo 'Next Month';?>': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf('month')]
            }
        },cb);

    });

</script>