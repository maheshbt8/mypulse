<?php 
$this->session->set_userdata('last_page', current_url());
?>
<form action="<?php echo base_url()?>main/medical_labs/delete_multiple/" method="post">
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">   
            <div class="panel-heading">
<div class="col-sm-5">
                  <div class="form-group">     
                        <span for="field-ta" class="col-sm-2 control-label"> <?php echo get_phrase('status'); ?></span> 
                        <div class="col-sm-6">
                            <select name="hospital" class="form-control" onchange="return get_inpatient(this.value)">
    <option value="">Select</option>
    <option value="1"><?php echo get_phrase('Admitted'); ?></option>
    <option value="2"><?php echo get_phrase('Discharged'); ?></option>
    <option value="0"><?php echo get_phrase('Recommended'); ?></option>
                            </select>
                        </div>
                    </div>
    </div>
<?php if($account_type == 'superadmin' || $account_type == 'hospitaladmins' || $account_type == 'doctors' ){?>
<button type="button" onclick="window.location.href = '<?php echo base_url();?>main/add_inpatient'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_in-Patient'); ?>
</button>
<?php }?>
</div>
<div class="panel-body">
<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">
    <thead>  
        <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value="" onclick="toggle(this);"></th>
            <!-- <th><?php echo get_phrase('sl_no');?></th> -->
            <th data-field="patient" data-sortable="true"><?php echo get_phrase('patient');?></th>
            <th data-field="hospital" data-sortable="true"><?php echo get_phrase('hospital');?></th>   
            <th data-field="doctor" data-sortable="true"><?php echo get_phrase('doctor');?></th>
            <th data-field="date" data-sortable="true"><?php echo get_phrase('date');?></th>
            <th data-field="reason" data-sortable="true"><?php echo get_phrase('reason');?></th> 
            <th data-field="bed" data-sortable="true"><?php echo get_phrase('bed');?></th>
            <th data-field="status" data-sortable="true"><?php echo get_phrase('status');?></th>
            <?php if($account_type=='users'){ ?>
            <th data-field="Visibility" data-sortable="true"><?php echo get_phrase('Visibility');?></th><?php }?>
            <th><?php echo get_phrase('action');?></th>
        </tr>
    </thead>

    <tbody id="data_table">

        <?php $i=1;foreach ($patient_info as $row) { 
            ?>   
            <tr>
                <td><input type="checkbox" name="check[]" class="check" id="check" value="<?php echo $row['lab_id'] ?>"></td>
                
                <td><?php $user=$this->db->where('user_id',$row['user_id'])->get('users')->row();
                if($account_type != 'users'){?><a href="<?php echo base_url()?>main/edit_inpatient/<?= $row['id']?>" class="hiper"><?php echo $user->name.' / '.$user->unique_id;?></a><?php }elseif($account_type == 'users'){?><?php echo $user->name.' / '.$user->unique_id;}?></td>
                 <td><?php echo $this->db->where('hospital_id',$row['hospital_id'])->get('hospitals')->row()->name;?></a></td>
                <td><?php echo $this->db->where('doctor_id',$row['doctor_id'])->get('doctors')->row()->name;?></td>
                <td><?php echo date('M d,Y',strtotime($row['created_date']));?></td>
                <td><?php echo $row['reason']; ?></td>
                <td><?php echo $this->db->get_where('bed',array('bed_id'=>$row['bed_id']))->row()->name; ?></td>
                 <td><?php if($row['status'] == 0){echo "Recommended";}elseif($row['status'] == 1){ echo "Admitted";}elseif($row['status'] == 2){ echo "Discharged";}?></td>
                 <?php if($account_type=='users'){?>
                <td><?php if($row['show_status']==1){?><a href="<?php echo base_url(); ?>main/inpatient/status/<?= $row['id'];?>/2"><span style="color: green"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo "Visible";?></span></a><?php }elseif($row['show_status']==2){?><a href="<?php echo base_url(); ?>main/inpatient/status/<?= $row['id'];?>/1"><span style="color: red"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo "Hidden";?></span></a><?php }?></td><?php }?> 
               <td>
              <a href="<?php echo base_url();?>main/inpatient_history/<?php echo $row['id']?>" title="View History"><i class="menu-icon fa fa-eye"></i></a> 
                </td>
            </tr>
        <?php $i++;} ?>
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
 $(".all_check").click(function () {
    if($(this).prop("checked") == true){
                $("#delete1").hide();
                $("#delete").show();
            }
            else if($(this).prop("checked") == false){
                $("#delete1").show();
                $("#delete").hide();
            }
     $('input:checkbox').not(this).prop('checked', this.checked);
 });
         $(".check").click(function(){
            if(($(".check:checked").length)!=0){
            $("#delete1").hide();
            $("#delete").show();
        if($(".check").length == $(".check:checked").length) {
            $("#all_check").attr("checked", "checked");
        } else {
            $("#all_check").removeAttr("checked");
        }
    }else{
        $("#delete1").show();
        $("#delete").hide();
    }
    });
    });
</script>
<script type="text/javascript">
    function get_inpatient(id) {
        $.ajax({
            url: '<?php echo base_url();?>ajax/get_inpatient_status/' + id ,
            success: function(response)
            {
                jQuery('#data_table').html(response);
                loadTable();
            }
        });
    }
</script>