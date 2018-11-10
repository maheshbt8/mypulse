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
            <th><?php echo get_phrase('hospital / doctor'); ?></th>
            <th><?php echo get_phrase('patient'); ?></th>
            <th><?php echo get_phrase('contact_number'); ?></th>
            <th><?php echo get_phrase('address'); ?></th>
            <th><?php echo get_phrase('status'); ?></th>
            <th><?php echo get_phrase('prescription'); ?></th>
            <th><?php echo get_phrase('options'); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php  
        /*$prescription_info=$this->db->get_where('prescription',array('user_id'=>$user_data['user_id'],'status'=>1))->result_array();*/
        $i=1;foreach ($order as $row1) {
            /*$user_info=$this->db->where('user_id',$row1);*/
           $user_info=$this->crud_model->select_user_information($row1['user_id']);
           $prescription_info=$this->crud_model->select_prescription_information($row1['prescription_id']);
           foreach ($user_info as $user1) {
             
            ?>
            <tr>
                <td><?php echo $i?></td>
                <td><?php $doc=$this->db->where('doctor_id',$prescription_info['doctor_id'])->get('doctors')->row();echo $this->db->where('hospital_id',$doc->hospital_id)->get('hospitals')->row()->name.' / '.$doc->name?></td>
                <td><?php echo $user1['name'] ?></td>
                <td><?php echo $user1['phone'] ?></td>
                <td><?php echo $user1['address'] ?></td>
                <td><?php if($row1['status']==1){echo "Completed";}elseif($row1['status']==2){echo "Pending";} ?></td>
                <td><a href="<?php echo base_url(); ?>main/prescription_history/<?php echo $row1['prescription_id'] ?>" class="hiper"><i class="fa fa-file"></i></a></td>
                <td><a href="#" class="hiper">Receipt</a></td>
            </tr>
        <?php }$i++;} ?>
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