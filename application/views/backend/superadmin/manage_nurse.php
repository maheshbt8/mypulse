 <a href="<?php echo base_url();?>index.php?superadmin/add_nurse"><button   class="btn btn-primary pull-right">
  
        <?php echo get_phrase('add_nurse'); ?>
</button></a>
<div style="clear:both;"></div>
<br>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><?php echo get_phrase('image');?></th>
            <th><?php echo get_phrase('name');?></th>
            <th><?php echo get_phrase('email');?></th>
            <th><?php echo get_phrase('address');?></th>   
            <th><?php echo get_phrase('phone');?></th>
            <th><?php echo get_phrase('options');?></th>
        </tr> 
    </thead>

    <tbody>
        <?php foreach ($nurse_info as $row) { ?>   
            <tr>
                <td><img src="<?php echo $this->crud_model->get_image_url('nurse' , $row['nurse_id']);?>" class="img-circle" width="40px" height="40px"></td>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['email']?></td>
                <td><?php echo $row['address']?></td>
                <td><?php echo $row['phone']?></td>
                <td>
                    
                    <a href="<?php echo base_url();?>index.php?superadmin/edit_nurse/<?php echo $row['nurse_id']?>" onclick="#" id="dellink_2" class="delbtn" data-toggle="modal" data-target=".bs-example-modal-sm" data-id="2" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                    <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?superadmin/nurse/delete/<?php echo $row['nurse_id']?>');" id="dellink_2" class="delbtn" data-toggle="modal" data-target=".bs-example-modal-sm" data-id="2" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
                   <!-- <a  onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/edit_nurse/<?php echo $row['nurse_id']?>');" 
                        class="btn btn-default btn-sm btn-icon icon-left">
                            <i class="entypo-pencil"></i>
                            Edit
                    </a>
                    <a href="<?php echo base_url();?>index.php?superadmin/nurse/delete/<?php echo $row['nurse_id']?>" 
                        class="btn btn-danger btn-sm btn-icon icon-left" onclick="return checkDelete();">
                            <i class="entypo-cancel"></i>
                            Delete
                    </a>-->
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