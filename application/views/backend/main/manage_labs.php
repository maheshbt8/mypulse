<?php 
$this->session->set_userdata('last_page', current_url());
?>
<form action="<?php echo base_url()?>main/medical_labs/delete_multiple/" method="post">
<button type="button" onClick="confSubmit(this.form);" id="delete" class="btn btn-danger pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onClick="checkone(this.form);" id="delete1" class="btn btn-danger pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onclick="window.location.href = '<?php echo base_url();?>main/add_labs'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_medical_labs'); ?>
</button>

<div style="clear:both;"></div>
<br>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>  
        <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value=""></th>
            <th><?php echo get_phrase('lab_id');?></th>
            <th><?php echo get_phrase('name');?></th>   
            <th><?php echo get_phrase('owner name');?></th>
            <th><?php echo get_phrase('owner phone number');?></th>
            <th><?php echo get_phrase('hospital');?></th> 
             <th><?php echo get_phrase('branch');?></th>
            <!-- <th><?php echo get_phrase('status');?></th> -->
            <th><?php echo get_phrase('options');?></th>
        </tr>
    </thead>

    <tbody>
        <?php $i=1;foreach ($lab_info as $row) { ?>   
            <tr>
                <td><input type="checkbox" name="check[]" class="check" id="check" value="<?php echo $row['lab_id'] ?>"></td>
                <td><?php echo $row['unique_id'];?></td>
                 <td><a href="<?php echo base_url();?>main/edit_labs/<?php echo $row['lab_id']?>" class="hiper"><?php echo $row['name'] ?></a></td>
                <td><?php echo $row['owner_name'] ?></td>
                <td><?php echo $row['owner_mobile'] ?></td>
                <td><?php echo $this->db->get_where('hospitals',array('hospital_id'=>$row['hospital']))->row()->name; ?></td>
                <td><?php echo $this->db->get_where('branch',array('branch_id'=>$row['branch']))->row()->name; ?></td>
                <!-- <td><?php if($row['status'] == 1){echo "active";   
                 }
                 else if(
                 $row['status'] == 0){ echo "inactive";}?></td>  -->
               <td>
              <a href="#" onclick="confirm_modal('<?php echo base_url();?>main/medical_labs/delete/<?php echo $row['lab_id']?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a> 
               <?php if($row['is_email'] == '2'){?>
                <a href="<?php echo base_url(); ?>main/resend_email_verification/medicallabs/lab/<?php echo $row['unique_id'] ?>" title="Verification Mail"><i class="glyphicon glyphicon-envelope"></i></a><?php }?>
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