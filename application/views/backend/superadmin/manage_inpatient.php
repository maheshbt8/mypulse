<?php 
$this->session->set_userdata('last_page', current_url());
?>
<form action="<?php echo base_url()?>index.php?superadmin/medical_labs/delete_multiple/" method="post">
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
            <th><?php echo get_phrase('action');?></th>
        </tr>
    </thead>

    <tbody>
        <?php $i=1;foreach ($lab_info as $row) { ?>   
            <tr><!-- 
                <td><input type="checkbox" name="check[]" class="check" id="check" value="<?php echo $row['lab_id'] ?>"></td> -->
                <td><?= $i;?></td>
                <td><?php echo $row['unique_id'];?></td>
                 <td><a href="<?php echo base_url();?>index.php?superadmin/edit_labs/<?php echo $row['lab_id']?>" class="hiper"><?php echo $row['name'] ?></a></td>
                <td><?php echo $row['owner_name'] ?></td>
                <td><?php echo $row['owner_mobile'] ?></td>
                <td><?php echo $this->db->get_where('hospitals',array('hospital_id'=>$row['hospital']))->row()->name; ?></td>
                <td><?php echo $this->db->get_where('branch',array('branch_id'=>$row['branch']))->row()->name; ?></td>
                 <td><?php if($row['status'] == 1){echo "active";   
                 }
                 else if(
                 $row['status'] == 0){ echo "inactive";}?></td> 
               <td>
              <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?superadmin/medical_labs/delete/<?php echo $row['lab_id']?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a> 
               <?php if($row['is_email'] == '2'){?>
                <a href="<?php echo base_url(); ?>index.php?superadmin/resend_email_verification/medicallabs/lab/<?php echo $row['unique_id'] ?>" title="Verification Mail"><i class="glyphicon glyphicon-envelope"></i></a><?php }?>
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
    function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}

</script>