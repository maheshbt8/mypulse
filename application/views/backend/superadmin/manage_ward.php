<a href="<?php echo base_url(); ?>index.php?superadmin/add_ward/<?= $department_id;?>"><button  
    class="btn btn-primary pull-right">
        <?php echo get_phrase('add_ward'); ?>
</button></a>
<div style="clear:both;"></div>

<br>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
           <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value="" onclick="toggle(this);"></th>
            <th><?php echo get_phrase('name'); ?></th>
            <th><?php echo get_phrase('hospital_name'); ?></th>
            <th><?php echo get_phrase('branch_name'); ?></th>
            <th><?php echo get_phrase('department_name'); ?></th>
            <th><?php echo get_phrase('beds'); ?></th>
            <th><?php echo get_phrase('options'); ?></th>
        </tr>
    </thead>

    <tbody>
        
        <?php $i=1;foreach ($ward_info as $row) { ?>   
            <tr>  
                <td><input type="checkbox" name="check[]" class="check" id="check" value="<?php echo $row['ward_id'] ?>"></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $this->db->where('hospital_id',$row['hospital_id'])->get('hospitals')->row()->name; ?></td>
                <td><?php echo $this->db->where('branch_id',$row['branch_id'])->get('branch')->row()->name; ?></td>
                <td><?php echo $this->db->where('department_id',$row['department_id'])->get('department')->row()->name; ?></td>
                <td><a href="<?php echo base_url(); ?>index.php?superadmin/get_hospital_bed/<?php echo $row['ward_id'] ?>" title="Beds"><i class="glyphicon glyphicon-eye-open"></i></a></td>
                <td>
             <a href="<?php echo base_url(); ?>index.php?superadmin/edit_ward/<?php echo $row['ward_id'] ?>" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
            <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?superadmin/ward/delete/<?php echo $row['ward_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
                 
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
</script>