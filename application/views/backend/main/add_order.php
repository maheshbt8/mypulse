<div class="row">
    <div class="col-lg-12">
<div class="panel panel-default">
    <div class="panel-body">
<div class="my_pulse">  
    <div class="col-md-12" style="background-color: #40403fe8;">
    <center style="padding:5px;"><img src="<?php echo base_url();?>assets/logo.png"  style="max-height:45px; margin: 0px;"/></center>
    </div>
</div>
</div>
<div class="panel-body">
<form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/add_order/<?php echo $order_type;?>" method="post" enctype="multipart/form-data">
<div class="col-sm-7">
        <div class="form-group">
        <label for="field-ta" class="col-sm-3"><?php echo get_phrase('Title'); ?></label>
                            <div class="col-sm-9">
           <input type="text" name="title" placeholder="Title" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php set_value('title');?>" >
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
<h2 class="col-sm-12"><?php echo get_phrase('Medicine'); ?></h2>
<div class="col-md-12"> 
  <table class="table container_p">
    <thead>
   <tr class="element"  id="div_0">
        <th>Sl No</th>
        <th>Drug</th>
        <th>Strength</th>
        <th>Quantity</th>
        <th><button type="button" class="add"><i class='fa fa-plus'></i></button></th>
      </tr>
      </thead>
    <tbody>
        
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
    <h2 class="col-sm-12"><?php echo get_phrase('tests'); ?></h2>
   
  <table class="table container1">
    <thead>
      <tr class="element1"  id="div1_0">
      <th>Sl No</th>
      <th>Title</th>
      <th>Description</th>
      <th><button type="button" class="add1"><i class='fa fa-plus'></i></button></th>
      </tr>
    </thead>
    <tbody>
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
<script type="text/javascript">

$(document).ready(function(){

 // Add new element
 $(".add").click(function(){

  // Finding total number of elements added
  var total_element = $(".element").length;
 
  // last <div> with element class id
  var lastid = $(".element:last").attr("id");
  var split_id = lastid.split("_");
  var nextindex = Number(split_id[1]) + 1;

  var max = 11;
  // Check total number elements
  if(total_element < max ){
   // Adding new div container after last occurance of element class
   $(".element:last").after("<tr class='element' id='div_"+ nextindex +"'></tr>");
 
   // Adding element to <div>
   $("#div_" + nextindex).append('<td>'+nextindex+'</td><td><input type="text" name="drug[]"  placeholder="" class="form-control" value="<?php set_value('drug');?>"/></td><td><input type="text" name="strength[]"  placeholder="" class="form-control" value="<?php set_value('strength');?>"/></td><td><input type="text" name="quantity[]"  placeholder="1" class="form-control" value="<?php set_value('quantity');?>"/></td><td><button type="button" id="remove_'+nextindex+'" class="remove" onclick="return remove()" ><i class="fa fa-minus"></i></button></td>');
  }
 
 });

 // Remove element
 $('.container_p').on('click','.remove',function(){
 
  var id = this.id;
  var split_id = id.split("_");
  var deleteindex = split_id[1];

  // Remove <div> with id
  $("#div_" + deleteindex).remove();

 });



  // Add new element
 $(".add1").click(function(){

  // Finding total number of elements added
  var total_element = $(".element1").length;
 
  // last <div> with element class id
  var lastid = $(".element1:last").attr("id");
  var split_id = lastid.split("_");
  var nextindex = Number(split_id[1]) + 1;

  var max = 11;
  // Check total number elements
  if(total_element < max ){
   // Adding new div container after last occurance of element class
   $(".element1:last").after("<tr class='element1' id='div1_"+ nextindex +"'></tr>");
 
   // Adding element to <div>
   $("#div1_" + nextindex).append('<td>'+nextindex+'</td><td><input type="text" name="test_title[]"  placeholder="" class="form-control" value="<?php set_value('title');?>"/></td><td><input type="text" name="description[]"  placeholder="" class="form-control" value="<?php set_value('description');?>"/></td><td><button type="button" id="remove1_'+nextindex+'" class="remove1" onclick="return remove()" ><i class="fa fa-minus"></i></button></td>');
   
 
  }
 
 });

 // Remove element
 $('.container1').on('click','.remove1',function(){
 
  var id = this.id;
  var split_id = id.split("_");
  var deleteindex = split_id[1];

  // Remove <div> with id
  $("#div1_" + deleteindex).remove();

 }); 
});
</script>