
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
<input type="button" class="btn btn-orange pull-right" value="<?php echo get_phrase('back'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
</div>
<div class="panel-body">
<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">
    <thead>  
        <tr>
    <th data-field="logs" data-sortable="true"><?php echo get_phrase('logs');?></th>
        </tr>
    </thead>
    <tbody id="data_table">
  <div id="refresh_data">
       <?php
    if($_GET['sd']!=''){
        $log_info=$this->crud_model->select_inpatient_info_by_date($_GET['sd'],$_GET['ed'],$_GET['status_id']);
        }else{$log_info=$log;}?>
</div>
        <?php $i=0;foreach ($log_info as $row) { 
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