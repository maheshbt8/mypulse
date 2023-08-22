<?php 
  $order_info=$this->crud_model->select_order_info_id($order_id);
  if($order_info['order_type']==0){
    $store_id=$order_info['store_id'];
    }elseif($order_info['order_type']==1){
    $lab_id=$order_info['lab_id'];
    }
$order_type=$order_info['order_type'];
$order_data=explode('|',$this->encryption->decrypt($order_info['order_data']));
?>
<div class="row">
    <div class="col-lg-12">
<div class="panel panel-default">
    <div class="panel-body">
<div class="my_pulse">  
    <div class="col-md-12" style="background:-webkit-linear-gradient(bottom, #005bea, #00c6fb);">
    <center style="padding:5px;"><img draggable="false" src="<?=base_url('MyPulse-Logo');?>"  style="max-height:55px; margin: 2px;"/></center>
    </div>
</div>
</div>
<div class="panel-body">
<form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/re_order/<?php echo $order_type;?>" method="post" enctype="multipart/form-data">
<div class="col-sm-7">
        <div class="form-group">
        <label for="field-ta" class="col-sm-3"><?php echo get_phrase('Title'); ?></label>
                            <div class="col-sm-9">
           <input type="text" name="title" placeholder="Title" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?=$order_data[0];?>" >
                            </div>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3"><?php echo get_phrase('date & time'); ?></label>
                            <div class="col-sm-9">
          <input type="text" class="form-control" value="<?php echo date('M d,2018 h:i A')?>" readonly/>
                            </div>
                    </div>
                </div>
<?php if($order_type == 0){?>
<div class="col-md-4"> 
<div class="form-group">
<label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('location'); ?></label>
<div class="col-sm-10"> 
<select name="city" class="form-control select2" id="city"value="" onchange="return get_city_stores(this.value)">
<option value="0"><?php echo get_phrase('ALL'); ?></option>
<?php $store=$this->crud_model->select_city(); 
foreach ($store as $spe) { ?>     
<option value="<?php echo $spe['city_id'];?>"><?php echo $spe['city_name']; ?></option>
<?php }?>
</select>
</div>
</div>
</div>
<div class="col-md-8"> 
<div class="form-group">
<label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('medical_store'); ?></label>
<div class="col-sm-10"> 
<select name="store" class="form-control select2" id="store" value=""  data-validate="required" data-message-required="<?php echo 'Value Required';?>">
<option value=""> -- Select Medical Store -- </option>
<?php $store=$this->db->get_where('medicalstores',array('row_status_cd'=>1))->result(); 
foreach ($store as $spe) {
$license_status=$this->db->get_where('hospitals',array('hospital_id'=>$spe->hospital_id))->row()->row_status_cd;
  if($license_status==1){
  ?>     
<option value="<?php echo $spe->store_id;?>" <?php if($store_id!=''){if($store_id == $spe->store_id){echo "selected";}}?>><?php echo $spe->unique_id.' / '.$spe->name; ?></option>
<?php }}?>
</select>
</div>
</div>

</div>
<h2 class="col-sm-12"><?php echo get_phrase('Medicines'); ?></h2>
<div class="col-md-12"> 
  <table class="table container_p">
    <thead>
   <tr class="element"  id="div_0">
        <th>Sl No</th>
        <th>Drug</th>
        <th>Strength</th>
        <th>Quantity</th>
        <!-- <th><button type="button" class="add"><i class='fa fa-plus'></i></button></th> -->
      </tr>
      </thead>
    <tbody>
      <?php 
      $drug=explode(',',$order_data[1]);
      $strength=explode(',',$order_data[2]);
      $quantity=explode(',',$order_data[3]);
      for($i=0;$i<count($drug);$i++){
      ?>
      <tr>
        <td><?=$i+1;?></td>
        <td><input type="text" name="drug[]"  placeholder="" class="form-control" value="<?=$drug[$i];?>" data-validate="required" data-message-required="<?="Value Required";?>"/></td><td><input type="text" name="strength[]"  placeholder="" class="form-control" value="<?=$strength[$i];?>" data-validate="required" data-message-required="<?="Value Required";?>"/></td>
        <td><input type="number" min="1" name="quantity[]"  placeholder="1" class="form-control" value="<?=$quantity[$i];?>" data-validate="required" data-message-required="<?="Value Required";?>"/></td>
      </tr>
    <?php }?>
    </tbody>
  </table>
</div>
<?php }?>
<?php if($order_type == 1){?>
<div class="col-md-4"> 
<div class="form-group">
<label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('location'); ?></label>
<div class="col-sm-10"> 
<select name="city" class="form-control select2" id="city"value="" onchange="return get_city_labs(this.value)">
<option value="0"><?php echo get_phrase('ALL'); ?></option>
<?php $store=$this->crud_model->select_city(); 
foreach ($store as $spe) { ?>     
<option value="<?php echo $spe['city_id'];?>"><?php echo $spe['city_name']; ?></option>
<?php }?>
</select>
</div>
</div>
</div>
<div class="col-md-8"> 
<div class="form-group">
<label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('medical_lab'); ?></label>
<div class="col-sm-10"> 
<select name="lab" class="form-control select2" id="lab"value=""  data-validate="required" data-message-required="<?php echo 'Value Required';?>">
<option value=""> -- Select Medical Lab -- </option>
<?php $store=$this->db->get_where('medicallabs',array('row_status_cd'=>1))->result(); 
foreach ($store as $spe) { 
$license_status=$this->db->get_where('hospitals',array('hospital_id'=>$spe->hospital_id))->row()->row_status_cd;
  if($license_status==1){
  ?>     
<option value="<?php echo $spe->lab_id;?>" <?php if($lab_id!=''){if($lab_id == $spe->lab_id){echo "selected";}}?>><?php echo $spe->unique_id.' / '.$spe->name; ?></option>
<?php }}?>
</select>
</div>
</div>
</div>
    <h2 class="col-sm-12"><?php echo get_phrase('tests'); ?></h2>
   
  <table class="table container1">
    <thead>
      <tr class="element1"  id="div1_0">
      <th>Sl No</th>
      <th>Title</th>
      <th>Description</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $test_title=explode(',',$order_data[1]);
      $description=explode(',',$order_data[2]);
      for($i=0;$i<count($test_title);$i++){
      ?>
      <tr>
        <td><?=$i+1;?></td>
        <td><input type="text" name="test_title[]"  placeholder="" class="form-control" value="<?=$test_title[$i];?>" data-validate="required" data-message-required="<?="Value Required";?>"/></td>
        <td><input type="text" name="description[]"  placeholder="" class="form-control" value="<?=$description[$i];?>" data-validate="required" data-message-required="<?="Value Required";?>"/></td>
      </tr>
    <?php }?>
    </tbody>
  </table>
<?php }?>
<div class="col-sm-3 control-label col-sm-offset-9">
                        <input type="submit" class="btn btn-success" value="<?php echo get_phrase('submit'); ?>">&nbsp;&nbsp;
                        <input type="button" class="btn btn-info" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
</div>
</form> 
</div>
</div>
</div>
</div>
<script type="text/javascript">
function get_city_stores(id) {
    
        $.ajax({
            url: '<?php echo base_url();?>ajax/get_city_stores/' + id ,
            success: function(response)
            {
            jQuery('#store').html(response);
            }
        });

    }
    function get_city_labs(id) {
    
        $.ajax({
            url: '<?php echo base_url();?>ajax/get_city_labs/' + id ,
            success: function(response)
            {
            jQuery('#lab').html(response);
            }
        });

    }    
</script>
