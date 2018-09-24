<a href="<?php echo base_url(); ?>index.php?superadmin/add_department/<?= $branch_id?>"><button  
    class="btn btn-primary pull-right">
        <?php echo get_phrase('add_department'); ?>
</button></a>
<div style="clear:both;"></div>

<br>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><?php echo get_phrase('sl_no'); ?></th>
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
                <td><?php echo $i;?></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $this->db->where('hospital_id',$row['hospital_id'])->get('hospitals')->row()->name; ?></td>
                <td><?php echo $this->db->where('branch_id',$row['branch_id'])->get('branch')->row()->name; ?></td>
                <td><a href="<?php echo base_url(); ?>index.php?superadmin/get_hospital_ward/<?php echo $row['department_id'] ?>" title="Wards"><i class="glyphicon glyphicon-eye-open"></i></a></td>
                <td>
              <a href="<?php echo base_url(); ?>index.php?superadmin/edit_department/<?php echo $row['department_id'] ?>" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
            
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