
<form action="<?php echo base_url()?>main/medical_labs/delete_multiple/" method="post">
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">   
            <div class="panel-heading">
<div class="col-sm-8">
                  <div class="form-group">  
                  <span for="field-ta" class="col-sm-2"><?php echo get_phrase('date'); ?></span> 
         <div class="col-sm-4">
        <input type="text" class="form-control" onchange="return get_report_data(this.value)" id="dob" name="date" value="<?php if(isset($_GET['date']) && $_GET['date'] != ""){echo date('M d,Y',strtotime($_GET['date']));}else{echo date('M d,Y');}?>">
        </div>
                    </div>
</div>
<input type="button" class="btn btn-orange pull-right" value="<?=get_phrase('back');?>" onclick="window.location.href = '<?=$this->session->userdata('last_page'); ?>'">
<input type="button" onclick="printDiv('print_div')" class="btn btn-primary pull-right" value="Print">
</div>
<div class="panel-body" id="print_div">
<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">
    <thead>  
        <tr>
    <th data-field="logs" data-sortable="true"><?php echo get_phrase('logs');?></th>
        </tr>
    </thead>
    <tbody id="data_table">
        <?php $i=0;foreach ($log as $row) { 
            if(!empty($row)){
            ?>   
            <tr>
                 <td>
                    <?=$row;?>
                 </td>
            </tr>
        <?php $i++;}} ?>
    </tbody>
</table>
</div>
</div>
</div>
</div>
</form>


<script type="text/javascript">
function get_report_data(value){
    window.location.href = '<?php echo base_url();?>main/errors_logs?date='+value;
}
</script>
<script type="text/javascript">
   function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>