<a href="<?php echo base_url();?>index.php?superadmin/add_stores"
    class="btn btn-primary pull-right">
        <?php echo get_phrase('add_medical_store'); ?>
</button></a>
<div style="clear:both;"></div>
<br>
<div style="width: 100%;  
    overflow-x: auto;
    overflow-y: hidden; 
    border: 1px solid #e7ecf1;
    margin: 10px 0!important;">
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><?php echo get_phrase('name');?></th>   
            <th><?php echo get_phrase('owner name');?></th>
            <th><?php echo get_phrase('owner phone number');?></th>
            <th><?php echo get_phrase('hospital');?></th>
             <th><?php echo get_phrase('branch');?></th>
            <th><?php echo get_phrase('status');?></th>
            <th><?php echo get_phrase('options');?></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($store_info as $row) { ?>   
            <tr>
                
                 <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['owner_name'] ?></td>
                <td><?php echo $row['owner_mobile'] ?></td>
                <td><?php echo $this->db->get_where('hospitals',array('hospital_id'=>$row['hospital']))->row()->name; ?></td>
                <td><?php echo $this->db->get_where('branch',array('branch_id'=>$row['branch']))->row()->name; ?></td>
                <td><?php if($row['status'] == 1){echo "active";   
                 }
                 else if(
                 $row['status ']== 0){ echo "inactive";}?></td>
              
                
               <td>
                  <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                        
                                        <!-- teacher EDITING LINK -->
                                        <li>
                                        	<a href="<?php echo base_url(); ?>index.php?superadmin/edit_stores/<?php echo $row['store_id'] ?>">
                                            	<i class="entypo-pencil"></i>
													Edit                                               	</a>
                                        				</li>
                                        <li class="divider"></li>
                                        
                                        <!-- teacher DELETION LINK -->
                                        <li>
                                        	<a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?superadmin/medical_stores/delete/<?php echo $row['store_id'] ?>');">
                                            	<i class="entypo-trash"></i>
													Delete                                               	</a>
													
                                        				</li>
                                    </ul>
                                </div>
                
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>

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