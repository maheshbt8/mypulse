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
            <th><?php echo get_phrase('health_report'); ?></th>
            <th><?php echo get_phrase('date'); ?></th>
            <th><?php echo get_phrase('visibility'); ?></th>
            <?php if($account_type == 'users'){?>
            <th><?php echo get_phrase('options'); ?></th><?php }?>
        </tr>
    </thead>

    <tbody>
        <?php
        $i=1;foreach ($health_reports as $row1) {
        $rep_data=$this->db->get_where('prescription',array('prescription_id'=>$row1['prescription_id']))->row_array();
        $rep_exp=explode('|',$this->encryption->decrypt($rep_data['prescription_data']));
         $rep_exp_data=explode(',',$rep_exp[7]);
         for($j=0;$j<count($rep_exp_data);$j++) {
        $report=$this->db->get_where('reports',array('order_id'=>$row1['order_id']))->result_array();
             if($report[$j]['extension']!=''){
            ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $rep_exp_data[$j];?></td>
                <td><?php if($report[$j]['extension']!=''){?><a href="<?=base_url('uploads/reports/').$report[$j]['report_id'].'.'.$report[$j]['extension'];?>" class="hiper" download><i class="fa fa-download"></i></a><?php }?></td>
                <td><?php echo $report[$j]['created_at'] ?></td>
                <td><?php if($report[$j]['status']==1){?><a href="<?php echo base_url(); ?>main/health_reports/status/<?= $report[$j]['report_id'];?>/2"><span style="color: green"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo "Visible";?></span></a><?php }elseif($report[$j]['status']==2){?><a href="<?php echo base_url(); ?>main/health_reports/status/<?= $report[$j]['report_id'];?>/1"><span style="color: red"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo "Hidden";?></span></a><?php }?></td>
               <?php if($account_type == 'users'){?>
                <td> 
            <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>main/health_reports/delete/<?= $report[$j]['report_id'];?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>&nbsp;
            
                </td><?php }?>
            </tr>
        <?php $i++;} }}?>
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