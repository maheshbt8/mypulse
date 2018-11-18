
<div class="row">
   
    <div class="col-md-12">
        <!------CONTROL TABS END------>
         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/add_prescription/" method="post" enctype="multipart/form-data">
             
        <div class="tab-content">
           
        <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                
                <div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            
            <div class="panel-body">
                <div class="row">
                <div class="col-sm-7">
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3"><?php echo get_phrase('Title (Prescription for)'); ?></label>
                            <div class="col-sm-9">
           <input type="hidden" name="user_id" value="<?=$user_id;?>">
           <input type="hidden" name="doctor_id" value="<?=$doctor_id;?>">
           <input type="text" name="title" placeholder="Title For Prescription" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php set_value('title');?>" >
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
                <label><b>Prescription for Medicines</b></label>
               
                <div class="col-sm-12">
                    <div class="form-group container">
                        <table  class="table table-bordered table-striped">
                            <tr class="element"  id="div_0">
                                <th>Sl No</th>
                                <th>Drug</th>
                                <th>Strength</th>
                                <th>Dosage</th>
                                <th>Duration</th>
                                <th>Quantity</th>
                                <th>Note</th>
                                <th><button type="button" class="add"><i class='fa fa-plus'></i></button></th>
                            </tr>
                        </table>
                    </div>
                </div>
             <label><b>Prescription for Medical Tests</b></label>
               
                <div class="col-sm-12">
                    <div class="form-group container container1">
                        <table  class="table table-bordered table-striped">
                            <tr class="element1"  id="div1_0">
                                <th>Sl No</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th><button type="button" class="add1"><i class='fa fa-plus'></i></button></th>
                            </tr>
                        </table>
                    </div>
                </div>
                 <div class="col-sm-12">
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-2"><?php echo get_phrase('additional_note'); ?></label>
                            <div class="col-sm-9">
                                <textarea type="text" name="additional_note" placeholder="Additional Note" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="" rows="4" cols="50"></textarea>
                            </div>
                    </div>
                </div>
            </div>
                    </div>
            </div>

        </div>

    </div>
</div>
            </div>   
                    <div class="col-sm-3 control-label col-sm-offset-9 ">
                        <input type="submit" class="btn btn-success" value="<?php echo get_phrase('submit'); ?>">&nbsp;&nbsp;
                        <input type="button" class="btn btn-info" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page1'); ?>'">
                    </div>  
                   
   </form>

    </div>
</div>
<br/><br/>
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
   $("#div_" + nextindex).append('<td>'+nextindex+'</td><td><input type="text" name="drug[]"  placeholder="" class="form-control" value="<?php set_value('drug');?>"/></td><td><input type="text" name="strength[]"  placeholder="" class="form-control" value="<?php set_value('strength');?>"/></td><td><input type="text" name="dosage[]"  placeholder="1-0-1" class="form-control" value="<?php set_value('dosage');?>"/></td><td><input type="text" name="duration[]"  placeholder="30 Days" class="form-control" value="<?php set_value('duration');?>"/></td><td><input type="text" name="quantity[]"  placeholder="1" class="form-control" value="<?php set_value('quantity');?>"/></td><td><input type="text" name="note[]"  placeholder="After Food" class="form-control" value="<?php set_value('note');?>"/></td><td><button type="button" id="remove_'+nextindex+'" class="remove" onclick="return remove()" ><i class="fa fa-minus"></i></button></td>');
   
 
  }
 
 });

 // Remove element
 $('.container').on('click','.remove',function(){
 
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