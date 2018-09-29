<form action="<?php echo base_url()?>index.php?superadmin/hospital_admins/delete_multiple/" method="post">
<a href="#"><button type="submit" onclick="confirm_modal('<?php echo base_url()?>index.php?superadmin/hospital/delete_multiple/');" 
    class="btn btn-danger pull-right" >
        <?php echo get_phrase('delete'); ?>
</button></a>
<a href='<?php echo base_url(); ?>index.php?superadmin/add_hospital_admins'><button class="btn btn-primary pull-right" type="button"><?php echo get_phrase('add_hospital_admin'); ?>
</button></a>

<div style="clear:both;"></div>
<br>

<table class="table table-bordered table-striped datatable" id="table-2" >
    <thead>  
        <tr>   
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value="" onclick="toggle(this);"></th>
            <th><?php echo get_phrase('image'); ?></th>
            <th><?php echo get_phrase('name'); ?></th> 
            <th><?php echo get_phrase('hospital'); ?></th>
            
             <th><?php echo get_phrase('status'); ?></th> 
            <th><?php echo get_phrase('options'); ?></th>   
        </tr>
    </thead>
  
    <tbody>
        <?php  $i=1;foreach ($admin_info as $row) {
       
        ?>   
            <tr>
                <td><input type="checkbox" name="check[]" class="check" id="check" value="<?php echo $row['admin_id'] ?>"></td>
                <td><img src="<?php echo $this->crud_model->get_image_url('hospitaladmin' , $row['admin_id']);?>" 
                         class="img-circle" width="40px" height="40px">
                </td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $this->db->get_where('hospitals',array('hospital_id'=>$row['hospital_id']))->row()->name; ?></td>
               
                 <td><?php if($row['status'] == 1){echo "active";  
                 }
                 else if(
                 $row['status == 0']){ echo "inactive";}?></td>
                <td>
                <a href="<?php echo base_url(); ?>index.php?superadmin/edit_hospital_admins/<?php echo $row['admin_id'] ?>" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?superadmin/hospital_admins/delete/<?php echo $row['admin_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
                
                
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
            "sDom": "<'row'<'col-xs-12 col-md-3 col-left'l><'col-xs-12  col-md-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-12 col-md-3 col-left'i><'col-xs-12 col-md-9 col-right'p>>"
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