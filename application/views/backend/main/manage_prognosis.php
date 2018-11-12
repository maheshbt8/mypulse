<?php 
$this->session->set_userdata('last_page', current_url());
?>
<div class="row">
    <div class="col-md-12">
            <div style="clear:both;"></div>
<table class="table table-bordered table-striped datatable" id="table-2">  
    <thead>
        <tr>
            <th><?php echo get_phrase('sl_no'); ?></th>
            <th><?php echo get_phrase('title'); ?></th>
            <th><?php echo get_phrase('case_history'); ?></th>
            <th><?php echo get_phrase('hospital / doctor'); ?></th>
            <th><?php echo get_phrase('date'); ?></th>
            <th><?php echo get_phrase('visibility'); ?></th>
            <?php if($account_type == 'users'){?>
            <th><?php echo get_phrase('options'); ?></th><?php }?>
        </tr>
    </thead>

    <tbody>
        <?php
        $i=1;foreach ($prognosis as $row1) {
            ?>
            <tr>
                <td><?php echo $i?></td>
                <td><?php echo $this->encryption->decrypt($row1['title']);?></td>
                <td><?php echo $this->encryption->decrypt($row1['case_history']);?></td>
                <td><?php $doc=$this->db->where('doctor_id',$row1['doctor_id'])->get('doctors')->row();echo $this->db->where('hospital_id',$doc->hospital_id)->get('hospitals')->row()->name.' / '.$doc->name?></td>
                <td><?php echo $row1['created_at'] ?></td>
                <td><?php if($row1['status']==1){?><a href="<?php echo base_url(); ?>main/prognosis/status/<?= $row1['prognosis_id'];?>/2"><span style="color: green"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo "Visible";?></span></a><?php }elseif($row1['status']==2){?><a href="<?php echo base_url(); ?>main/prognosis/status/<?= $row1['prognosis_id'];?>/1"><span style="color: red"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo "Hidden";?></span></a><?php }?></td>
               <?php if($account_type == 'users'){?>
                <td> 
            <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>main/prognosis/delete/<?php echo $row1['prognosis_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>&nbsp;
            
                </td><?php }?>
            </tr>
        <?php $i++;} ?>
    </tbody>
</table>
 </div>
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