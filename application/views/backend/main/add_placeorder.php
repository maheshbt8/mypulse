<?php 
$prescription_info = $this->db->get_where('prescription', array('prescription_id' =>$prescription_id))->row_array();
$doctor_info=$this->db->where('doctor_id',$prescription_info['doctor_id'])->get('doctors')->row_array();
$user_info=$this->db->where('user_id',$prescription_info['user_id'])->get('users')->row_array();
$hospital_info=$this->db->where('hospital_id',$doctor_info['hospital_id'])->get('hospitals')->row_array();
$prescription_data=explode('|',$this->encryption->decrypt($prescription_info['prescription_data']));
?>
<div class="row" id="print_div">  
<div class="col-md-12">
<div class="my_pulse">  
    <div class="col-md-12" style="background-color: #40403fe8;">
    <center style="padding:5px;"><img src="<?php echo base_url();?>assets/logo.png"  style="max-height:45px; margin: 0px;"/></center>
    </div>
</div>
    <hr/>
<div class="row">
    <div class="col-md-12">
    <table width="100%" border="0">    
            <tbody><tr>
    <td align="left"><h3>Title :- <?php echo $prescription_data[0];?></h3></td>
            </tr>
        </tbody>
    </table>
</div>
</div>
<div class="row">
    <div class="col-md-12">
    <table width="100%" border="0">    
            <tbody><tr>
                <td align="left"><img src="<?php echo base_url();?>uploads/hospitallogs/<?= $doctor_info['hospital_id'];?>.png"  style="max-height:45px; margin: 0px;"/></td>
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
</div>
<div class="row">
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
</div>
</div>
<br/>
<hr/>
<br/>
<form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/prescription/order/<?php echo $type_order;?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="prescription_id" value="<?= $prescription_info['prescription_id'];?>">
    <input type="hidden" name="user_id" value="<?= $prescription_info['user_id'];?>">
<?php if($type_order == 0){?>
<div class="row">
<div class="col-md-4"> 
<div class="form-group">
<label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('location'); ?></label>
<div class="col-sm-10"> 
<select name="city" class="form-control select2" id="city"value="" onchange="return get_city_stores(this.value)">
<option value="0"><?php echo get_phrase('ALL'); ?></option>
<?php $store=$this->db->get('city')->result(); 
foreach ($store as $spe) { ?>     
<option value="<?php echo $spe->city_id;?>"><?php echo $spe->name; ?></option>
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
<?php $store=$this->db->get('medicalstores')->result(); 
foreach ($store as $spe) { ?>     
<option value="<?php echo $spe->store_id;?>"><?php echo $spe->unique_id.' / '.$spe->name; ?></option>
<?php }?>
</select>
</div>
</div>

</div>
</div>
<div class="row">


<div class="col-md-12">
    <h2 class="col-sm-3"><?php echo get_phrase('Medicine'); ?></h2>
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
        $quantity=explode(',',$prescription_data[5]);
        $note=explode(',',$prescription_data[6]);
        ?>
        <?php for($i1=0;$i1<count($drug);$i1++){?>
      <tr>
        <th scope="row"><?= $i1+1;?></th>
        <td><?= $drug[$i1];?></td>
        <td><?= $strength[$i1];?></td>
        <td><?= $dosage[$i1];?></td>
        <td><?= $duration[$i1];?></td>
        <td><input type="text" name="quantity[]" value="<?= $quantity[$i1];?>"/></td>
        <td><?= $note[$i1];?></td>
      </tr>
      <?php }?>
    </tbody>
  </table>
</div>
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
<?php $store=$this->db->get('city')->result(); 
foreach ($store as $spe) { ?>     
<option value="<?php echo $spe->city_id;?>"><?php echo $spe->name; ?></option>
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
<?php $store=$this->db->get('medicallabs')->result(); 
foreach ($store as $spe) { ?>     
<option value="<?php echo $spe->lab_id;?>"><?php echo $spe->unique_id.' / '.$spe->name; ?></option>
<?php }?>
</select>
</div>
</div>

</div>
</div>
<div class="row">
<div class="col-md-12">
    <h2 class="col-sm-3"><?php echo get_phrase('tests'); ?></h2>
    <div class="table-responsive">
    
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
        ?>
        <input type="hidden" name="count" value="<?= count($test_title)?>">
        <?php for($i1=0;$i1<count($test_title);$i1++){?>
      <tr>
        <th scope="row"><?= $i1+1;?></th>
        <td><?= $test_title[$i1];?></td>
        <td><?= $description[$i1];?></td>
        <td><input type="checkbox" name="tests[<?= $i1;?>]" value="<?= $i1;?>" checked></td>
      </tr>
      <?php }?>
    </tbody>
  </table>
</div>
</div>

</div>

<?php }?>
<div class="col-sm-3 control-label col-sm-offset-9">
                        <input type="submit" class="btn btn-success" value="<?php echo get_phrase('submit'); ?>">&nbsp;&nbsp;
                        <input type="button" class="btn btn-info" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
                    </div>
</form> 
<br/><br/><br/>
</div>
</div>
<br/><br/>

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