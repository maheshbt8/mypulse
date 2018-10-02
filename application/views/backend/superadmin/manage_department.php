<?php 
$this->session->set_userdata('last_page', current_url());
?>
<form action="<?php echo base_url()?>index.php?superadmin/department/delete_multiple/" method="post">
<button type="button" onClick="confSubmit(this.form);" 
    class="btn btn-danger pull-right">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onclick="window.location.href = '<?php echo base_url(); ?>index.php?superadmin/add_department/<?= $branch_id?>'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_department'); ?>
</button>
<div style="clear:both;"></div>

<br>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value="" onclick="toggle(this);"></th>
            <th><?php echo get_phrase('name'); ?></th>
            <th><?php echo get_phrase('hospital_name'); ?></th>
            <th><?php echo get_phrase('branch_name'); ?></th>
            <th><?php echo get_phrase('wards'); ?></th>
            <th><?php echo get_phrase('options'); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php $i=1;foreach ($department_info as $row) { ?>   
            <tr>  
                <td><input type="checkbox" name="check[]" class="check" id="check_<?php echo $i;?>" value="<?php echo $row['department_id'] ?>"></td>
                <td><a href="<?php echo base_url(); ?>index.php?superadmin/edit_department/<?php echo $row['department_id'] ?>" class="hiper"><?php echo $row['name'] ?></a></td>
                <td><?php echo $this->db->where('hospital_id',$row['hospital_id'])->get('hospitals')->row()->name; ?></td>
                <td><?php echo $this->db->where('branch_id',$row['branch_id'])->get('branch')->row()->name; ?></td>
                <td><a href="<?php echo base_url(); ?>index.php?superadmin/get_hospital_ward/<?php echo $row['department_id'] ?>" title="Wards"><i class="glyphicon glyphicon-eye-open"></i></a></td>
                <td>
              <!-- <a href="<?php echo base_url(); ?>index.php?superadmin/edit_department/<?php echo $row['department_id'] ?>" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a> -->
            
            <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?superadmin/department/delete/<?php echo $row['department_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
           
                </td>
            </tr>
        <?php $i++;} ?>
    </tbody>
</table>

<script type="text/javascript">
    jQuery(window).load(function ()
    {
        var $ = jQuery;

        $("#table-2").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-3 col-md-3 col-left'l><'col-xs-9 col-md-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-md-3 col-left'i><'col-xs-9 col-md-9 col-right'p>>"
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
if (confirm("Are you sure you want to Delete ?")) {
form.submit();
}
}
</script>