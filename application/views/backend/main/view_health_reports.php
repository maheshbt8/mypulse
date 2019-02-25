<?php 
$reports=$this->db->where('report_id',$report_id)->get('reports')->row_array();
if($reports['order_type']==0){
$order_data=$this->db->where('order_id',$reports['order_id'])->get('prescription_order')->row_array();
if($order_data['type_of_order']==0){
$prescription_data=$this->db->where('prescription_id',$order_data['prescription_id'])->get('prescription')->row_array();
$presc_data=explode('|',$this->encryption->decrypt($prescription_data['prescription_data']));
$get_data=$this->db->where('order_id',$order_data['order_id'])->get('reports')->result_array();
$prec=explode(',',$presc_data[7]);
$i=0;foreach($get_data as $data){
if($data['report_id']==$report_id){
$title=$prec[$i];
}
}
}elseif($order_data['type_of_order']==1){
$presc_data=explode('|',$this->encryption->decrypt($order_data['order_data']))[0];
}

}elseif($reports['order_type']==1){
$title=$reports['title'];	
}
$unique_id=$this->crud_model->select_user_unique_id($reports['user_id']);
?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">   
            <div class="panel-heading">
            	<?=$title?>
            	<div class="col-sm-3 pull-right">
<?php if($reports['extension']!='pdf'){?>
    <input type="button" onclick="printDiv('ext_file')" class="btn btn-primary" value="Print">
<?php }?>
<a href="<?=base_url('uploads/reports/').date('Y',strtotime($reports['created_at'])).'/'.$unique_id.'/Report'.$report_id.'_'.date('YmdHis',strtotime($reports['created_at'])).'.'.$reports['extension']?>" download="<?='Report'.$report_id.'_'.date('YmdHis',strtotime($reports['created_at'])).'.'.$reports['extension']?>" class="btn btn-success"><?php echo get_phrase('download'); ?>
</a>
    <input type="button" class="btn btn-info" value="<?php echo get_phrase('close'); ?>" onclick="window.location.href = '<?php if($account_type!='users'){echo $this->session->userdata('last_page1');}else{echo $this->session->userdata('last_page');} ?>'">
</div>
</div>
            <div class="panel-body" id="ext_file">
 <!-- <object width="100%" height="900px;" data="<?=base_url('uploads/reports/').date('Y',strtotime($reports['created_at'])).'/'.$unique_id.'/Report'.$report_id.'_'.date('YmdHis',strtotime($reports['created_at'])).'.'.$reports['extension']?>"></object> -->
 <object width="100%" height="900px;" data="data:<?php if($reports['extension']!='pdf'){echo 'image/'.$reports['extension'];}elseif($reports['extension']=='pdf'){echo 'application/'.$reports['extension'];}?>;base64,<?=$this->crud_model->get_report_url(date('Y',strtotime($reports['created_at'])),$unique_id,'Report'.$report_id.'_'.date('YmdHis',strtotime($reports['created_at'])),$reports['extension'])?>"></object>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
   function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;
}
</script>
