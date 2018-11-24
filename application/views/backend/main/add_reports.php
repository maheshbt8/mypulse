
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">   
            <div class="panel-body">
        <!------CONTROL TABS END------>
         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/add_health_reports/" method="post" enctype="multipart/form-data">
             <input type="hidden" name="user_id" value="<?=$user_id?>">
        <div class="tab-content">
           
        <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                
                <div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-body">
                <div class="row">
                <div class="col-sm-12">
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3"><?php echo get_phrase('date & time'); ?></label>
                            <div class="col-sm-9">
          <input type="text" class="form-control" value="<?php echo date('M d,2018 h:i A')?>" readonly/>
                            </div>
                    </div>
                </div>
            </div>
                <label><b>Health Reports Add</b></label>
                <div class="col-sm-12">
                    <div class="form-group container1">
                        <table  class="table table-bordered table-striped">
                            <tr class="element1"  id="div1_0">
                                <th>Sl No</th>
                                <th>Title</th>
                                <th>Reports</th>
                                <th><button type="button" class="add1"><i class='fa fa-plus'></i></button></th>
                            </tr>
                        </table>
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
    </div>
</div>
<br/><br/>
<script type="text/javascript">

$(document).ready(function(){


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
   $("#div1_" + nextindex).append('<td>'+nextindex+'</td><td><input type="text" name="title[]"  placeholder="" class="form-control" value="<?php set_value('title');?>"/></td><td><input type="file" name="report[]"  placeholder=""  value="<?php set_value('report');?>"/></td><td><button type="button" id="remove1_'+nextindex+'" class="remove1" onclick="return remove()" ><i class="fa fa-minus"></i></button></td>');
   
 
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