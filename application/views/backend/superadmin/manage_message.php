<?php 
$this->session->set_userdata('last_page', current_url());
?>
<style type="text/css">
    .newsDate {
    font-weight: 100;
    text-align: right;
}
</style>
<form action="<?php echo base_url()?>index.php?superadmin/message/delete_multiple/" method="post">
<button type="button" onClick="confSubmit(this.form);" id="delete" class="btn btn-danger pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onClick="checkone(this.form);" id="delete1" class="btn btn-danger pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onclick="window.location.href = '<?php echo base_url();?>index.php?superadmin/new_message'" class="btn btn-primary pull-right">
        <?php echo get_phrase('new_message'); ?>
</button>
<div style="clear:both;"></div>
<br>
<!-- <table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value="" style="width: 20px;"></th>
            <th><?php echo get_phrase('title');?></th>
            <th><?php echo get_phrase('options');?></th> 
        </tr> 
    </thead>

    <tbody>
        <?php $i=1;foreach ($message_data as $row) { ?>   
            <tr>
                <td><input type="checkbox" name="check[]" class="check" id="check_<?php echo $i;?>" value="<?php echo $row['nurse_id'] ?>" style="width: 20px;"></td>
                <td><?php echo $row['title'];?></td>
                <td>
                    <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?superadmin/nurse/delete/<?php echo $row['nurse_id']?>');" id="dellink_2" class="delbtn" data-toggle="modal" data-target=".bs-example-modal-sm" data-id="2" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
                    <?php if($row['is_email'] == '2'){?>
                <a href="<?php echo base_url(); ?>index.php?superadmin/resend_email_verification/nurse/nurse/<?php echo $row['unique_id'] ?>" title="Verification Mail"><i class="glyphicon glyphicon-envelope"></i></a><?php }?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table> -->
<div class="list-group">
    <?php $i=1;foreach ($message_data as $row) { ?>
    <a href="#" class="list-group-item"><input type="checkbox" name="check[]" class="check" id="check_<?php echo $i;?>" value="<?php echo $row['nurse_id'] ?>" style="width: 20px;"><label><?php echo $row['title'];?> </label><span class="newsDate" style="">10/10/2018</span></a>
    <?php } ?>
</div>

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