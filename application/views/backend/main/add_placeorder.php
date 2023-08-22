<?php 
if($order_id!=''){
    $order_info=$this->crud_model->select_order_info_id($order_id);
  $id=$order_id;
  if($order_info['type_of_order']==0){
    $type_order = $order_info['order_type'];
    if($order_info['order_type']==0){
    $store_id=$order_info['store_id'];
    }elseif($order_info['order_type']==1){
    $lab_id=$order_info['lab_id'];
    }
    $prescription_id=$order_info['prescription_id'];
}
}
$prescription_info = $this->db->get_where('prescription', array('prescription_id' =>$prescription_id))->row_array();
$doctor_info=$this->db->where('doctor_id',$prescription_info['doctor_id'])->get('doctors')->row_array();
$user_info=$this->db->where('user_id',$prescription_info['user_id'])->get('users')->row_array();
$hospital_info=$this->db->where('hospital_id',$doctor_info['hospital_id'])->get('hospitals')->row_array();
$prescription_data=explode('|',$this->encryption->decrypt($prescription_info['prescription_data']));
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
    <hr/>
    <div class="col-md-12">
    <table width="100%" border="0">    
            <tbody><tr>
    <td align="left"><h3>Title :- <?php echo $prescription_data[0];?></h3></td>
            </tr>
        </tbody>
    </table>
</div>
    <div class="col-md-12">
    <table width="100%" border="0">    
            <tbody><tr>
                <td align="left"><img src="<?=base_url('Hospital-Logo/').$doctor_info['hospital_id'];?>"  style="max-height:45px; margin: 0px;"/></td>
                <td align="right"></td>
            </tr>

            <tr>
                <td align="left" valign="top">
                    <h3><?php echo $hospital_info['name'];?></h3>
<h4><i class="fa fa-map-marker m-r-xs"></i>&nbsp;&nbsp;<?php echo $hospital_info['address'];?></h4>
<h4><i class="fa fa-envelope m-r-xs"></i>&nbsp;&nbsp;<?php echo $hospital_info['email'];?></h4>          
                </td>
                <td align="right" valign="top">
                    <h4><b>Date : </b><?php echo date('M ,d-Y h:i A',strtotime($prescription_info['created_at']));?></h4>
                    
                </td>
            </tr>
        </tbody>
    </table>
</div>

    <div class="col-md-12">
    <table width="100%" border="0">    
            <tbody><tr>
                <td align="left"><h3><u>Doctor</u></h3></td>
                <td align="right"><h3><u>Patient</u></h3></td>
            </tr>

            <tr>
                <td align="left" valign="top">
         <h3><?php echo $doctor_info['name'] .' ('.$doctor_info['unique_id'].')';?></h3>
<h4><i class="fa fa-phone m-r-xs"></i>&nbsp;&nbsp;<?php echo $doctor_info['phone'];?></h4>
<h4><i class="fa fa-envelope m-r-xs"></i>&nbsp;&nbsp;<?php echo $doctor_info['email'];?></h4>
                </td>
                <td align="right" valign="top">
    <h3><?php echo $user_info['name'] .' ('.$user_info['unique_id'].')';?></h3>
<h4><i class="fa fa-phone m-r-xs"></i>&nbsp;&nbsp;<?php echo $user_info['phone'];?></h4>
<h4><i class="fa fa-envelope m-r-xs"></i>&nbsp;&nbsp;<?php echo $user_info['email'];?></h4> 

                </td>
            </tr>
        </tbody>
    </table>
    <hr/>
</div>
<form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/prescription/order/<?php echo $type_order;?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="prescription_id" value="<?= $prescription_info['prescription_id'];?>">
    <input type="hidden" name="user_id" value="<?= $prescription_info['user_id'];?>">
<?php if($type_order == 0){?>
<div class="col-md-4"> 
<div class="form-group">
<label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('location'); ?></label>
<div class="col-sm-10"> 
<select name="city" class="form-control select2" id="city"value="" onchange="return get_city_stores(this.value)">
<option value="0"><?php echo get_phrase('ALL'); ?></option>
<?php $store=$this->crud_model->select_city(); 
foreach ($store as $spe) { ?>     
<option value="<?php echo $spe->city_id;?>"><?php echo $spe->city_name; ?></option>
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
<?php $store=$this->db->get_where('medicalstores',array('row_status_cd'=>'1'))->result(); 
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
<h2 class="col-sm-12"><?php echo get_phrase('Medicine'); ?></h2>
<div class="col-md-12"> 
    <div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Drug</th>
        <th scope="col">Strength</th>
        <th scope="col">Dosage</th>
        <th scope="col">Duration</th>
        <th scope="col">Quantity</th>
        <th scope="col">Note</th>
      </tr>
    </thead>
    <tbody>
        <?php 
        $drug=explode(',',$prescription_data[1]);
        $strength=explode(',',$prescription_data[2]);
        $dosage=explode(',',$prescription_data[3]);
        $duration=explode(',',$prescription_data[4]);
        if($order_id == ''){
        $quantity=explode(',',$prescription_data[5]);
        }elseif($order_id != ''){
        $quantity=explode(',',$order_info['quantity']); 
        }
        $note=explode(',',$prescription_data[6]);
        ?>
        <?php for($i1=0;$i1<count($drug);$i1++){?>
      <tr>
        <th scope="row"><?= $i1+1;?></th>
        <td><?= $drug[$i1];?></td>
        <td><?= $strength[$i1];?></td>
        <td><?= $dosage[$i1];?></td>
        <td><?= $duration[$i1];?></td>
        <td><input type="number" name="quantity[<?=$i1?>]" value="<?= $quantity[$i1];?>" data-validate="required" data-message-required="<?php echo 'Value Required';?>" min="1"/></td>
        <td><?= $note[$i1];?></td>
      </tr>
      <?php }?>
    </tbody>
  </table>
</div>
</div>
<?php }?>
<?php if($type_order == 1){?>
<div class="row">
<div class="col-md-4"> 
<div class="form-group">
<label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('location'); ?></label>
<div class="col-sm-10"> 
<select name="city" class="form-control select2" id="city"value="" onchange="return get_city_labs(this.value)">
<option value="0"><?php echo get_phrase('ALL'); ?></option>
<?php $store=$this->crud_model->select_city(); 
foreach ($store as $spe) { ?>     
<option value="<?php echo $spe->city_id;?>"><?php echo $spe->city_name; ?></option>
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
<?php $store=$this->db->get_where('medicallabs',array('row_status_cd'=>'1'))->result(); 
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
</div>
    <h2 class="col-sm-12"><?php echo get_phrase('tests'); ?></h2>
   
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col">Select Test</th>
      </tr>
    </thead>
    <tbody>
        <?php 
        $test_title=explode(',',$prescription_data[7]);
        $description=explode(',',$prescription_data[8]);
        if($order_info != ''){
        $tests=explode(',',$order_info['tests']); 
        }
        ?>
        <input type="hidden" name="count" value="<?= count($test_title)?>">
        <?php for($i1=0;$i1<count($test_title);$i1++){
            if($prescription_data[7]!=''){
                if($tests[$i1]==1 || $order_info ==''){
            ?>
      <tr>
        <th scope="row"><?= $i1+1;?></th>
        <td><?= $test_title[$i1];?></td>
        <td><?= $description[$i1];?></td>
        <td><input type="checkbox" class="myCheckBox" name="tests[<?= $i1;?>]" value="<?= $i1;?>" checked></td>
      </tr>
      <?php }}}?>
    </tbody>
  </table>
<?php }?>
<span id="error-check" class="pull-right" style="color: red;"></span>
<div class="col-sm-3 control-label col-sm-offset-9" >
                        <input type="submit" id="submit" class="btn btn-success" value="<?php echo get_phrase('submit'); ?>">&nbsp;&nbsp;
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
var checkBoxes = $('tbody .myCheckBox');
checkBoxes.change(function () {
    $('#submit').prop('disabled', checkBoxes.filter(':checked').length < 1);
    if(checkBoxes.filter(':checked').length > 0){
    $("#error-check").empty();
    }else if(checkBoxes.filter(':checked').length < 1){
    $("#error-check").html('Please select atleast one checkbox');
    }
});
$('tbody .myCheckBox').change();
</script>