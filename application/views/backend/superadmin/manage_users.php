<?php 
$this->session->set_userdata('last_page', current_url());
?>
<form action="<?php echo base_url()?>index.php?superadmin/users/delete_multiple/" method="post">
<button type="button" onClick="confSubmit(this.form);" 
    class="btn btn-danger pull-right">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onclick="window.location.href = '<?php echo base_url();?>index.php?superadmin/add_user/'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_myPulse_user'); ?>
</button>
<div style="clear:both;"></div>
<br>
<table class="table table-bordered table-striped datatable" id="table-2">    
    <thead>
        <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value="" onclick="toggle(this);"></th>
            <th><?php echo get_phrase('user_id');?></th>
            <th><?php echo get_phrase('user_name');?></th>
            <th><?php echo get_phrase('email');?></th>
            <th><?php echo get_phrase('status');?></th>
            <th><?php echo get_phrase('options');?></th>
        </tr>
    </thead>

    <tbody>
        <?php $i=1;foreach ($patient_info as $row) { ?>   
            <tr>
                <td><input type="checkbox" name="check[]" class="check" id="check" value="<?php echo $row['user_id'] ?>"></td>
                 <td><?php echo $row['unique_id']?></td>
                <td><a href="<?php echo base_url();?>index.php?superadmin/edit_user/<?php echo $row['user_id']?>" class="hiper"><?php echo $row['name'] ?></a></td>
                <td><?php echo $row['email']?></td>
                <td><?php if($row['status'] == 1){echo "<button type='button' class='btn-success'>Active</button>";   
                 }
                 else if(
                 $row['status'] == 0){ echo "<button type='button' class='btn-danger'>Inactive</button>";}?></td> 
                <td>
                   <!--  <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                            Action <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                            <li>
                                <a onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/patient_profile/<?php echo $row['patient_id']?>');">
                                    <i class="entypo-user"></i>
                                    <?php echo get_phrase('profile'); ?>
                                </a>
                            </li>
                            <li>
                                <a onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/medication_history/<?php echo $row['patient_id']?>');">
                                   <i class="entypo-eye"></i>
                                    <?php echo get_phrase('medication history'); ?>
                                </a>
                            </li>
                            <li>
                                <a onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/diagnosis_report/<?php echo $row['patient_id']; ?>');">
                               <!-- <a href="<?php echo base_url();?>index.php?modal/popup/diagnosis_report/<?php echo $row['patient_id']; ?>">
                                    <i class="fa fa-medkit"></i>
                                    <?php echo get_phrase('diagnosis report'); ?>
                                </a>
                            </li>
                            
                            <li>
                                <a onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/bed_allotment_history/<?php echo $row['patient_id']?>');">
                                   <i class="fa fa-hdd-o"></i>
                                    <?php echo get_phrase('bed allotment history'); ?>
                                </a>
                            </li>
                            <li>
                                <a  onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/edit_patient/<?php echo $row['patient_id']?>');" 
                                    <i class="entypo-pencil"></i>
                                    <?php echo get_phrase('edit'); ?>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?php echo base_url();?>index.php?superadmin/user/delete/<?php echo $row['patient_id']?>" 
                                    onclick="return checkDelete();">
                                        <i class="entypo-cancel"></i>
                                        <?php echo get_phrase('delete'); ?>
                                </a>
                            </li>
                        </ul>
                    </div> -->
                    <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?superadmin/users/delete/<?php echo $row['user_id']?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a> 
                </td>
            </tr>
        <?php } ?>
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