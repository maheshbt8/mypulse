<a href="<?php echo base_url();?>index.php?superadmin/add_user/"><button onclick="#" 
    class="btn btn-primary pull-right">
        <?php echo get_phrase(' Add my pulse users'); ?>
</button></a>
<div style="clear:both;"></div>
<br>
<table class="table table-bordered table-striped datatable" id="table-2">    
    <thead>
        <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value="" onchange="return upall()"></th>
            <th><?php echo get_phrase('image');?></th>
            <th><?php echo get_phrase('unique id');?></th>
            <th><?php echo get_phrase('name');?></th>
            <th><?php echo get_phrase('email');?></th>
            <th><?php echo get_phrase('options');?></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($patient_info as $row) { ?>   
            <tr>
                <td><input type="checkbox" name="check[]" class="check" id="check_<?php echo $i;?>" value="<?php echo $row['doctor_id'] ?>" onchange="return upall()"></td>
                <td><img src="<?php echo $this->crud_model->get_image_url('patient' , $row['patient_id']);?>" class="img-circle" width="40px" height="40px"></td>
                 <td><?php echo $row['unique_id']?></td>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['email']?></td>
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
                     <a href="<?php echo base_url();?>index.php?superadmin/edit_user/<?php echo $row['user_id']?>" onclick="#" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                    <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?superadmin/users/delete/<?php echo $row['user_id']?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a> 
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