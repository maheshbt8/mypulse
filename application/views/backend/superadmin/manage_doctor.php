<a href="#"><button type="button" onclick="confirm_modal('<?php echo base_url()?>index.php?superadmin/hospital/delete_multiple/');" 
    class="btn btn-danger pull-right">
        <?php echo get_phrase('delete'); ?>
</button></a>
<a href="<?php echo base_url();?>index.php?superadmin/add_doctor"><button  
    class="btn btn-primary pull-right">
        <?php echo get_phrase('add_doctor'); ?>
</button></a>
<div style="clear:both;"></div>
<br>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value="" onchange="toggle(this);"></th>
            <th><?php echo get_phrase('image');?></th>
            <th><?php echo get_phrase('name');?></th>
            <th><?php echo get_phrase('hospital');?></th>
            <th><?php echo get_phrase('branch');?></th>
            <th><?php echo get_phrase('department');?></th>
            <th><?php echo get_phrase('options');?></th>   
        </tr>
    </thead>

    <tbody>
        <?php foreach ($doctor_info as $row) { ?>   
            <tr>
                <td><input type="checkbox" name="check[]" class="check" id="check_<?php echo $i;?>" value="<?php echo $row['doctor_id'] ?>"></td>
                <td>
                    <img src="<?php echo $this->crud_model->get_image_url('doctor' , $row['doctor_id']);?>" 
                         class="img-circle" width="40px" height="40px">
                </td>
                <td><?php echo $row['name']?></td>
                
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
                
               <td>
                <a href="<?php echo base_url(); ?>index.php?superadmin/edit_doctor/<?php echo $row['doctor_id'] ?>" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?superadmin/doctor/delete/<?php echo $row['doctor_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
                <a href="<?php echo base_url(); ?>index.php?superadmin/doctor_availability/<?php echo $row['doctor_id'] ?>" title="Availability"><i class="glyphicon glyphicon-calendar"></i></a>
                 
                </td>
            </tr>
        <?php } ?>
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
<script type="text/javascript">
    function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}
</script>