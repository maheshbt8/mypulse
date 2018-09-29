<a href="<?php echo base_url();?>index.php?superadmin/add_bed/<?= $ward_id;?>"><button onclick="" 
    class="btn btn-primary pull-right">
        <?php echo get_phrase('add_bed'); ?>
</button></a>
<div style="clear:both;"></div>
<br>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><?php echo get_phrase('Sl_no');?></th>
            <th><?php echo get_phrase('name'); ?></th>
            <th><?php echo get_phrase('hospital_name'); ?></th>
            <th><?php echo get_phrase('branch_name'); ?></th>
            <th><?php echo get_phrase('department_name'); ?></th>
            <th><?php echo get_phrase('ward_name'); ?></th>
            
            <th><?php echo get_phrase('options'); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php 
        $i=1;
        foreach ($bed_info as $row) { ?>   
            <tr>
             
                <td><?php echo $i;?></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $this->db->where('hospital_id',$row['hospital_id'])->get('hospitals')->row()->name; ?></td>
                <td><?php echo $this->db->where('branch_id',$row['branch_id'])->get('branch')->row()->name; ?></td>
                <td><?php echo $this->db->where('branch_id',$row['department_id'])->get('department')->row()->name; ?></td>
                <td><?php echo $this->db->where('ward_id',$row['ward_id'])->get('ward')->row()->name; ?></td>
                
                <td>
            <a href="<?php echo base_url(); ?>index.php?superadmin/edit_bed/<?php echo $row['bed_id'] ?>" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
            <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?superadmin/bed/delete/<?php echo $row['bed_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
                </td>
            </tr>
       <?php $i++; } ?>
    </tbody>
</table>

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