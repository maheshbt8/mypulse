<?php 
$this->session->set_userdata('last_page', current_url());
?>
<form action="<?php echo base_url()?>index.php?superadmin/doctor/delete_multiple/" method="post">
<button type="button" onClick="confSubmit(this.form);" id="delete" class="btn btn-danger pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onClick="checkone(this.form);" id="delete1" class="btn btn-danger pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onclick="window.location.href = '<?php echo base_url();?>index.php?superadmin/add_doctor'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_doctor'); ?>
</button>

<div style="clear:both;"></div>
<br>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value="" onchange="toggle(this);"></th>
            <th><?php echo get_phrase('doctor_id');?></th>
            <th><?php echo get_phrase('doctor_name');?></th>
            <th><?php echo get_phrase('hospital');?></th>
            <th><?php echo get_phrase('branch');?></th>
            <th><?php echo get_phrase('department');?></th>
            <th><?php echo get_phrase('status'); ?></th> 
            <th><?php echo get_phrase('options');?></th>   
        </tr>
    </thead>

    <tbody>
        <?php foreach ($doctor_info as $row) { ?>   
            <tr>
                <td><input type="checkbox" name="check[]" class="check" id="check_<?php echo $i;?>" value="<?php echo $row['doctor_id'] ?>"></td>
                <td><?php echo $row['unique_id'];?></td>
                <td><a href="<?php echo base_url(); ?>index.php?superadmin/edit_doctor/<?php echo $row['doctor_id'] ?>" class="hiper"><?php echo $row['name'] ?></a></td>
                 <td>
                    <?php $name = $this->db->get_where('hospitals' , array('hospital_id' => $row['hospital_id'] ))->row()->name;
                        echo $name;?>
                </td>
                 <td>
                    <?php $name = $this->db->get_where('branch' , array('branch_id' => $row['branch_id'] ))->row()->name;
                        echo $name;?>
                </td>
                <td>
                    <?php $name = $this->db->get_where('department' , array('department_id' => $row['department_id'] ))->row()->name;
                        echo $name;?>
                </td>
                <td><?php if($row['status'] == 1){echo "<button type='button' class='btn-success'>Active</button>";   
                 }
                 else if(
                 $row['status'] == 2){ echo "<button type='button' class='btn-danger'>Inactive</button>";}?></td>
                
               <td>
                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?superadmin/doctor/delete/<?php echo $row['doctor_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
                <a href="<?php echo base_url(); ?>index.php?superadmin/doctor_availability/<?php echo $row['doctor_id'] ?>" title="Availability"><i class="glyphicon glyphicon-calendar"></i></a>
                 <?php if($row['is_email'] == '2'){?>
                <a href="<?php echo base_url(); ?>index.php?superadmin/resend_email_verification/doctors/doctor/<?php echo $row['unique_id'] ?>" title="Verification Mail"><i class="glyphicon glyphicon-envelope"></i></a><?php }?>
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

        $("#delete").hide();
         $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                $("#delete").show();
                $("#delete1").hide();
            }
            else if($(this).prop("checked") == false){
               $("#delete").hide();
               $("#delete1").show();
            }
        });
    });
    function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}

</script>