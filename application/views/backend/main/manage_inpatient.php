<?php 
$this->session->set_userdata('last_page', current_url());
?>
<form action="<?php echo base_url()?>main/medical_labs/delete_multiple/" method="post">
<?php if($account_type == 'superadmin' || $account_type == 'hospitaladmins' || $account_type == 'doctors' ){?>
<button type="button" onclick="window.location.href = '<?php echo base_url();?>main/add_inpatient'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_in-Patient'); ?>
</button>
<?php }?>
<div class="row">
    <div class="col-sm-5">
                  <div class="form-group">     
                        <label for="field-ta" class="col-sm-2 control-label"> <?php echo get_phrase('status'); ?></label> 
                        <div class="col-sm-6">
                            <select name="hospital" class="form-control" onchange="return get_inpatient(this.value)">
    <option value="">Select</option>
    <option value="1"><?php echo get_phrase('Admitted'); ?></option>
    <option value="0"><?php echo get_phrase('Recommended'); ?></option>
    <option value="2"><?php echo get_phrase('Discharged'); ?></option>
                            </select>
                        </div>
                    </div>
    </div>
</div>
<div style="clear:both;"></div>
<br>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>  
        <tr><!-- 
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value="" onclick="toggle(this);"></th> -->
            <th><?php echo get_phrase('sl_no');?></th>
            <th><?php echo get_phrase('patient');?></th>
            <th><?php echo get_phrase('hospital');?></th>   
            <th><?php echo get_phrase('doctor');?></th>
            <th><?php echo get_phrase('date');?></th>
            <th><?php echo get_phrase('reason');?></th> 
            <th><?php echo get_phrase('bed');?></th>
            <th><?php echo get_phrase('status');?></th>
            <?php if($account_type=='users'){?>
            <th><?php echo get_phrase('visibility'); ?></th>
            <?php }?>
            <th><?php echo get_phrase('action');?></th>
        </tr>
    </thead>

    <tbody id="data_table">
        <?php $i=1;foreach ($patient_info as $row) { 
            ?>   
            <tr><!-- 
                <td><input type="checkbox" name="check[]" class="check" id="check" value="<?php echo $row['lab_id'] ?>"></td> -->
                <td><?= $i;?></td>
                <td><?php $user=$this->db->where('user_id',$row['user_id'])->get('users')->row();
                if($account_type != 'users'){?><a href="<?php echo base_url()?>main/edit_inpatient/<?= $row['id']?>" class="hiper"><?php echo $user->name.' / '.$user->unique_id;?></a><?php }elseif($account_type == 'users'){?><?php echo $user->name.' / '.$user->unique_id;}?></td>
                 <td><?php echo $this->db->where('hospital_id',$row['hospital_id'])->get('hospitals')->row()->name;?></a></td>
                <td><?php echo $this->db->where('doctor_id',$row['doctor_id'])->get('doctors')->row()->name;?></td>
                <td><?php echo date('M d,Y',strtotime($row['created_date']));?></td>
                <td><?php echo $row['reason']; ?></td>
                <td><?php echo $this->db->get_where('bed',array('bed_id'=>$row['bed_id']))->row()->name; ?></td>
                 <td><?php if($row['status'] == 0){echo "Recommended";}elseif($row['status'] == 1){ echo "Admitted";}elseif($row['status'] == 2){ echo "Discharged";}?></td> 
               
                <?php if($account_type=='users'){?>
                <td><?php if($row['show_status']==1){?><a href="<?php echo base_url(); ?>main/inpatient/status/<?= $row['id'];?>/2"><span style="color: green"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo "Visible";?></span></a><?php }elseif($row['show_status']==2){?><a href="<?php echo base_url(); ?>main/inpatient/status/<?= $row['id'];?>/1"><span style="color: red"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo "Hidden";?></span></a><?php }?></td>
              
                <?php }?>
                <td>
              <a href="<?php echo base_url();?>main/inpatient_history/<?php echo $row['id']?>" title="View History"><i class="menu-icon fa fa-eye"></i></a>
              <?php if($account_type=='users' && $row['show_status']==0){?>
              <a href="#" onclick="confirm_modal('<?php echo base_url();?>main/inpatient/delete/<?php echo $row['id']?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a><?php }?> 
                </td>
            </tr>
        <?php $i++;} ?>
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
    function get_inpatient(id) {
        $.ajax({
            url: '<?php echo base_url();?>ajax/get_inpatient_status/' + id ,
            success: function(response)
            {
                /*alert(response);*/
                /*$patient_info=response;*/
                /*alert($patient_info);*/
                /*return $patient_info=json_decode(response);*/
               /* alert($data);*/
                /*alert('<?php $patient_info=json_decode(response)?>');*/
            /*$character = json_decode(response);*/
                jQuery('#data_table').html(response);
            }
        });
    }
</script>