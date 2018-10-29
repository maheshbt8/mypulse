<?php 
$this->session->set_userdata('last_page', current_url());
?>
<form action="<?php echo base_url()?>main/hospital_admins/delete_multiple/" method="post">
<button type="button" onClick="confSubmit(this.form);" id="delete" class="btn btn-danger pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onClick="checkone(this.form);" id="delete1" class="btn btn-danger pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onclick="window.location.href = '<?php echo base_url(); ?>main/add_hospital_admins'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_hospital_admin'); ?>
</button>
<div style="clear:both;"></div>
<br>

<table class="table table-bordered table-striped datatable" id="table-2" >
    <thead>  
        <tr>   
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value=""></th>
            <th><?php echo get_phrase('hospital_admin_id');?></th>
            <th><?php echo get_phrase('hospital_admin_name'); ?></th> 
            <th><?php echo get_phrase('hospital'); ?></th>
            <th><?php echo get_phrase('status'); ?></th> 
            <th><?php echo get_phrase('options'); ?></th>   
        </tr>
    </thead>
  
    <tbody>
        <?php  $i=1;foreach ($admin_info as $row) {
       
        ?>   
            <tr>
                <td><input type="checkbox" name="check[]" class="check" value="<?php echo $row['admin_id'] ?>"></td>
                <td><?php echo $row['unique_id'];?></td>
                <td><a href="<?php echo base_url(); ?>main/edit_hospital_admins/<?php echo $row['admin_id'] ?>" class="hiper"><?php echo $row['name'] ?></a></td>
                <td><?php echo $this->db->get_where('hospitals',array('hospital_id'=>$row['hospital_id']))->row()->name; ?></td>
               
                 <td><?php if($row['status'] == 1){echo "<button type='button' class='btn-success'>Active</button>";   
                 }
                 else if(
                 $row['status'] == 0){ echo "<button type='button' class='btn-danger'>Inactive</button>";}?></td>
                <td>
                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>main/hospital_admins/delete/<?php echo $row['admin_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i>
                </a>
                <?php if($row['is_email'] == '2'){?>
                <a href="<?php echo base_url(); ?>main/resend_email_verification/hospitaladmins/admin/<?php echo $row['unique_id'] ?>" title="Verification Mail"><i class="glyphicon glyphicon-envelope"></i></a><?php }?>
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