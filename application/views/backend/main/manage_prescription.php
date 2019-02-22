<?php 
$this->session->set_userdata('last_page', current_url());
?>
<div class="row">
    <div class="col-lg-12">
         <div class="panel panel-default">   
            <div class="panel-heading">
            </div>
<div class="panel-body">
<table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">  
    <thead>
        <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value=""></th>
            <th data-field="title" data-sortable="true"><?php echo get_phrase('title (Prescription_for)'); ?></th>
            <th data-field="hospital" data-sortable="true"><?php echo get_phrase('hospital / doctor'); ?></th>
            <th data-field="date" data-sortable="true"><?php echo get_phrase('date'); ?></th>
            <th><?php echo get_phrase('visibility'); ?></th>
            <?php if($account_type == 'users'){?>
            <th><?php echo get_phrase('options'); ?></th><?php }?>
        </tr>
    </thead>

    <tbody>
        <?php
        $i=1;foreach ($prescription as $row1) {
            $prescription_data=explode('|',$this->encryption->decrypt($row1['prescription_data']));
            ?>
            <tr>
                <td><input type="checkbox" name="check[]" class="check" id="check_<?php echo $i;?>" value="<?php echo $row1['prescription_id']; ?>"></td>
                <td><a href="<?php echo base_url(); ?>main/prescription_history/<?php echo $row1['prescription_id'] ?>" class="hiper"><?php echo $prescription_data[0];?></a></td>
                <td><?php $doc=$this->db->where('doctor_id',$row1['doctor_id'])->get('doctors')->row();echo $this->db->where('hospital_id',$doc->hospital_id)->get('hospitals')->row()->name.' / '.$doc->name?></td>
                <td><?php echo $row1['created_at'] ?></td>
                <td><?php if($row1['status']==1){?><a href="<?php echo base_url(); ?>main/prescription/status/<?= $row1['prescription_id'];?>/2"><span style="color: green"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo "Visible";?></span></a><?php }elseif($row1['status']==2){?><a href="<?php echo base_url(); ?>main/prescription/status/<?= $row1['prescription_id'];?>/1"><span style="color: red"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo "Hidden";?></span></a><?php }?></td>
               <?php if($account_type == 'users'){?>
                <td>
            <?php if($prescription_data[1]!=''){?> 
              <a href="<?php echo base_url(); ?>main/prescription_order/<?php echo $row1['prescription_id'] ?>/0" title="Order Medicine"><em class="fa fa-sm fa-medkit color-blue"></em>
            </a>&nbsp;<?php }?>
            <?php if($prescription_data[7]!=''){?>
            <a href="<?php echo base_url(); ?>main/prescription_order/<?php echo $row1['prescription_id'] ?>/1" title="Order Medical Tests"><em class="fa fa-sm fa-plus-square color-red"></em>
            </a>&nbsp;<?php }?>
            <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>main/prescription/delete/<?php echo $row1['prescription_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>&nbsp;
                </td><?php }?>
            </tr>
        <?php $i++;} ?>
    </tbody>
</table>
 </div>
</div>
</div>
</div>
<script>
    $(document).ready(function(){
        $("#delete1").show();
        $("#delete").hide();
 $(".all_check").click(function () {
    if($(this).prop("checked") == true){
                $("#delete1").hide();
                $("#delete").show();
            }
            else if($(this).prop("checked") == false){
                $("#delete1").show();
                $("#delete").hide();
            }
     $('input:checkbox').not(this).prop('checked', this.checked);
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
<!-- <script>
    function status_inactive(id) {
            $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>main/prescription/status/'+id+'/2',
            success: function (response) {
                $("#sta").load(" #sta > *");
               /* window.location.reload();*/
            }
          });  
}
</script> -->