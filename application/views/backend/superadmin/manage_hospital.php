<form action="<?php echo base_url()?>index.php?superadmin/hospital/delete_multiple/" method="post">
<button type="button" onClick="confSubmit(this.form);" 
    class="btn btn-danger pull-right">
        <?php echo get_phrase('delete'); ?>
</button>
<!-- onclick="confirm_modal('<?php echo base_url()?>index.php?superadmin/hospital/delete_multiple/');" -->
<a href="<?php echo base_url(); ?>index.php?superadmin/add_hospital/"><button type="button" onclick="" 
    class="btn btn-primary pull-right">
        <?php echo get_phrase('add_hospital'); ?>
</button></a>
<div style="clear:both;"></div>
<br>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value="" onclick="toggle(this);"></th>
            <th><?php echo get_phrase('name'); ?></th>
            <th><?php echo get_phrase('license_status'); ?></th>
            <th><?php echo get_phrase('branches'); ?></th>
            <!-- <th><?php echo get_phrase('address'); ?></th>
            <th><?php echo get_phrase('email'); ?></th>
            <th><?php echo get_phrase('phone'); ?></th> -->
            <th><?php echo get_phrase('options'); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php  $i=1;foreach ($hospital_info as $row) {?>   
            <tr>
                <td><input type="checkbox" name="check[]" class="check" id="check_<?php echo $i;?>" value="<?php echo $row['hospital_id'] ?>"></td>
                <td><a href="<?php echo base_url();?>index.php?superadmin/get_hospital_history/<?php echo $row['hospital_id'];?>"><?php echo $row['name'] ?></a></td>
                <td><?php echo $this->db->where('license_id',$row['license'])->get('license')->row()->license_code .' - ';if($row['license_status']==1){echo 'Active';}elseif($row['license_status']==2){echo 'Inactive';}  ?></td>
                <!-- <td><?php echo $row['address'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['phone_number'] ?></td> -->
                 <td>
            <a href="<?php echo base_url(); ?>index.php?superadmin/get_hospital_branch/<?php echo $row['hospital_id'] ?>" title="Branches"><i class="glyphicon glyphicon-eye-open"></i></a>     
                </td>
                <td>
            <a href="<?php echo base_url(); ?>index.php?superadmin/edit_hospital/<?php echo $row['hospital_id'] ?>" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
            <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?superadmin/hospital/delete/<?php echo $row['hospital_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
                
                
                </td>
            </tr>
        <?php $i++;} ?>
    </tbody>
</table>
</form>
<!-- <'row'<'col-md-3 col-sm-12 col-xs-12 col-left'l><'col-md-6 col-sm-12 col-xs-12  col-left'<'export-data'T>r>t<'col-md-3 col-sm-12 col-xs-12  col-right'f>r>t<'row'<' col-md-3 col-xs-12 col-left'i><'col-md-9 col-xs-12 col-right'p>> -->
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


function confSubmit(form) {
if (confirm("Are you sure you want to Delete All?")) {
form.submit();
}
}
</script>