<?php 
$this->session->set_userdata('last_page', current_url());
?>
<form action="<?php echo base_url()?>main/medical_labs/delete_multiple/" method="post">
<div style="clear:both;"></div>
<br>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>  
        <tr>
            <th><?php echo get_phrase('sl_no');?></th>
            <th><?php echo get_phrase('patient_id');?></th>
            <th><?php echo get_phrase('name');?></th>   
            <th><?php echo get_phrase('email');?></th>
            <th><?php echo get_phrase('status');?></th>
        </tr>
    </thead>

    <tbody>
        <?php  $j=1;
            foreach ($patient_info as $user) {
              
            ?>   
            <tr>
                <td><?= $j;?></td>
                <td><?php echo $user->unique_id;?></td>
                 <td><a href="<?php echo base_url();?>main/edit_user/<?php echo $user->user_id;?>" class="hiper"><?php echo $user->name;?></a></td>
                <td><?php echo $user->email;?></td>
                <td><?php if($user->status == 1){echo "<button type='button' class='btn-success'>Active</button>";}elseif($user->status == 2){ echo "<button type='button' class='btn-danger'>Inactive</button>";}?></td>
            </tr>
        <?php  $j++;}?>
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
