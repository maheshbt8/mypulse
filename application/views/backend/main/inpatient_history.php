<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
<button type="button" onclick="window.location.href = '<?php echo $this->session->userdata('last_page');?>'" class="btn btn-orange pull-right">
        <?php echo get_phrase('back'); ?>
</button>
</div>
<div class="panel-body">

	<div class="col-sm-8">
        	<h4><?php echo '<b>Bed</b> : '.$this->db->where('bed_id',$inpatient->bed_id)->get('bed')->row()->name;?></h4>
        	<h4><?php if($inpatient->status == 0){$status='Not Admitted';}elseif($inpatient->status == 1){$status='Admitted';}elseif($inpatient->status == 2){$status='Discharged';}echo '<b>Status</b> : '.$status;?></h4>
        	<h4><?php echo '<b>Admitted Date & Time</b> : '.$inpatient->join_date;?></h4>
        	<h4><?php echo '<b>Reason</b> : '.$inpatient->reason;?></h4>
        	<h4><?php echo '<b>Discharged Date & Time</b> : '.$inpatient->discharged_date;?></h4>

	</div>
</div>
<div class="panel-body">
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>  
        <tr><!-- 
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value="" onclick="toggle(this);"></th> -->
            <th><?php echo get_phrase('sl_no');?></th>
            <th><?php echo get_phrase('note');?></th>
            <th><?php echo get_phrase('date');?></th>
        </tr>
    </thead>

    <tbody>
        <?php $i=1;foreach ($inpatient_history as $row) {
            ?>   
            <tr>
                <td><?= $i;?></td>
                <td><?php echo $row['note'];?></td>
                 <td><?php echo date('M d,Y h:i A',$row['created_date']);?></a></td>
            </tr>
        <?php $i++;} ?>
    </tbody>
</table>

</div>
</div>
</div>
</div><!-- 
<script type="text/javascript">
    jQuery(window).load(function ()
    {
        var $ = jQuery;

        $("#table-2").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "tp"
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
</script> -->
