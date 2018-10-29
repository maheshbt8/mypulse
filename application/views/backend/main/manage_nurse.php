<?php 
$this->session->set_userdata('last_page', current_url());
?>
<form action="<?php echo base_url()?>main/nurse/delete_multiple/" method="post">
<button type="button" onClick="confSubmit(this.form);" id="delete" class="btn btn-danger pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onClick="checkone(this.form);" id="delete1" class="btn btn-danger pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onclick="window.location.href = '<?php echo base_url();?>main/add_nurse'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_nurse'); ?>
</button>
<div style="clear:both;"></div>
<br>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value=""></th>
            <th><?php echo get_phrase('nurse_id');?></th>
            <th><?php echo get_phrase('nurse_name');?></th> 
             <th><?php echo get_phrase('hospital');?></th>
            <th><?php echo get_phrase('branch');?></th>
            <th><?php echo get_phrase('department');?></th>  
            <th><?php echo get_phrase('doctor');?></th>
            <th><?php echo get_phrase('status'); ?></th>
            <th><?php echo get_phrase('options');?></th>
        </tr> 
    </thead>

    <tbody>
        <?php $i=1;foreach ($nurse_info as $row) { ?>   
            <tr>
                <td><input type="checkbox" name="check[]" class="check" id="check_<?php echo $i;?>" value="<?php echo $row['nurse_id'] ?>"></td>
                <td><?php echo $row['unique_id'];?></td>
                 <td><a href="<?php echo base_url(); ?>main/edit_nurse/<?php echo $row['nurse_id'] ?>" class="hiper"><?php echo $row['name'] ?></a></td>
                <td>
                    <?php $name = $this->db->get_where('hospitals' , array('hospital_id' => $row['hospital_id'] ))->row()->name;
                        echo $name;?>
                </td>
                 <td>
                    <?php $name = $this->db->get_where('branch' , array('branch_id' => $row['branch_id'] ))->row()->name;
                        echo $name;?>
                </td>
                <td>
                    <?php if($row['department_id'] == 0){$name='All Departments';}else{$name = $this->db->get_where('department' , array('department_id' => $row['department_id'] ))->row()->name;}
                        echo $name;?>
                </td>
                <td><a href="<?php echo base_url();?>main/view_doctors/nurse/<?php echo $row['nurse_id']?>" class="hiper">View Doctors</a></td>
                <td><?php if($row['status'] == 1){echo "<button type='button' class='btn-success'>Active</button>";   
                 }
                 else if(
                 $row['status'] == 2){ echo "<button type='button' class='btn-danger'>Inactive</button>";}?>
                     
                 </td>
                <td>
                    <?php if($row['is_email'] == '2'){?>
                <a href="<?php echo base_url(); ?>main/resend_email_verification/nurse/nurse/<?php echo $row['unique_id'] ?>" title="Verification Mail"><i class="glyphicon glyphicon-envelope"></i></a><?php }?>
                <a href="#" onclick="confirm_modal('<?php echo base_url();?>main/nurse/delete/<?php echo $row['nurse_id']?>');" id="dellink_2" class="delbtn" data-toggle="modal" data-target=".bs-example-modal-sm" data-id="2" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
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