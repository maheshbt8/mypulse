
<?php 
$this->session->set_userdata('last_page', current_url());
?>
<form action="<?php echo base_url()?>index.php?superadmin/hospital/delete_multiple/" method="post">
<button type="button" onClick="confSubmit(this.form);" id="delete" class="btn btn-danger pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onClick="checkone(this.form);" id="delete1" class="btn btn-danger pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onclick="window.location.href = '<?php echo base_url(); ?>index.php?superadmin/add_hospital/'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_hospital'); ?>
</button>
<div style="clear:both;"></div>
<br>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value=""></th>
            <th><?php echo get_phrase('hospital_id');?></th>
            <th><?php echo get_phrase('hospital_name'); ?></th>
            <th><?php echo get_phrase('license_status'); ?></th>
            <th><?php echo get_phrase('branches'); ?></th>
            <th><?php echo get_phrase('options'); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php  $i=1;foreach ($hospital_info as $row) {?>   
            <tr>
                <td><input type="checkbox" name="check[]" class="check" id="check_<?php echo $i;?>" value="<?php echo $row['hospital_id'] ?>"></td>
                <td><?php echo $row['unique_id'];?></td>
                <td><a href="<?php echo base_url();?>index.php?superadmin/get_hospital_history/<?php echo $row['hospital_id'];?>" class="hiper"><?php echo $row['name'] ?></a></td>
                <td><?php $license_code=$this->db->where('license_id',$row['license'])->get('license')->row()->license_code;
                 if($row['license_status'] == 1){echo "<button type='button' class='btn-success'>".$license_code." - Active</button>";   
                 }
                 else if($row['license_status'] == 2){ echo "<button type='button' class='btn-danger'>".$license_code." - Inactive</button>";}?>
                </td>
                 <td>
            <a href="<?php echo base_url(); ?>index.php?superadmin/get_hospital_branch/<?php echo $row['hospital_id'] ?>" title="Branches"><i class="glyphicon glyphicon-eye-open"></i></a>     
                </td>
                <td>
            <!-- <a href="<?php echo base_url(); ?>index.php?superadmin/edit_hospital/<?php echo $row['hospital_id'] ?>" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a> -->
            <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?superadmin/hospital/delete/<?php echo $row['hospital_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
                
                
                </td>
            </tr>
        <?php $i++;} ?>
    </tbody>
</table>
</form>
<!-- <div class="modal fade" id="alldelete">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h4>
                </div>
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a href="#" class="btn btn-danger" id="delete_link_all"><?php echo 'Delete';?></a>
                    <button type="button" class="btn btn-info" data-dismiss="modal"><?php echo 'Cancel';?></button>
                </div>
            </div>
        </div>
</div> -->
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
    $(document).ready(function(){
        $("#delete1").show();
        $("#delete").hide();
        $("#all_check").click(function () {
            $('.check').attr('checked', this.checked);
            if($(".check:checked").length == 0){
                $("#delete1").show();
                $("#delete").hide();
            }else{
            $("#delete1").hide();
            $("#delete").show();
            }
            
        });
         $(".check").click(function(){
            if(($(".check:checked").length)!=0){
            $("#delete1").hide();
            $("#delete").show();
        if($(".check").length == $(".check:checked").length) {
            $("#all_check").attr("checked", "checked");
        } else {
            $("#all_check").removeAttr("checked");
        }
    }else{
        $("#delete1").show();
        $("#delete").hide();
    }
    });
    });
</script>
