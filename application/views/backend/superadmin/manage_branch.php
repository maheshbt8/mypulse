<a href="<?php echo base_url(); ?>index.php?superadmin/add_branch/<?php echo $hospital_id;?>"><button onclick="" 
    class="btn btn-primary pull-right">
        <?php echo get_phrase('add_branch'); ?>
</button></a>

<div style="clear:both;"></div>
<br>
<table class="table table-bordered table-striped datatable" id="table-2">  
    <thead>
        <tr>
            <th><?php echo get_phrase('sl_no'); ?></th>
            <th><?php echo get_phrase('name'); ?></th>
           <!--  <th><?php echo get_phrase('hospital'); ?></th>
            <th><?php echo get_phrase('address'); ?></th> -->
            <th><?php echo get_phrase('email'); ?></th>
            <th><?php echo get_phrase('phone'); ?></th>
            <th><?php echo get_phrase('departments'); ?></th>
            <th><?php echo get_phrase('options'); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php  $i=1;foreach ($branch_info as $row) {?>
        
            <tr>
                <td><?php echo $i?></td>
                <td><?php echo $row['name'] ?></td>
               <!--  <td><?php echo $this->db->where('hospital_id',$row['hospital_id'])->get('hospitals')->row()->name; ?></td>
                <td><?php echo $row['address'] ?></td>   -->
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['phone'] ?></td>
                <td>
            <a href="<?php echo base_url(); ?>index.php?superadmin/get_hospital_departments/<?php echo $row['branch_id'] ?>" title="Departments"><i class="glyphicon glyphicon-eye-open"></i></a>
                </td>
                <td>
            <a href="<?php echo base_url(); ?>index.php?superadmin/edit_branch/<?php echo $row['branch_id'] ?>" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
            <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?superadmin/branch/delete/<?php echo $row['branch_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
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