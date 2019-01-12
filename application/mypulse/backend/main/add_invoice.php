<?php 
$order_info=$this->crud_model->select_order_info_id($order_id);
$prescription_info = $this->db->get_where('prescription', array('prescription_id' =>$order_info['prescription_id']))->row_array();
if($order_info['order_type']==0){
$store_info=$this->db->where('store_id',$order_info['store_id'])->get('medicalstores')->row_array();
}elseif($order_info['order_type']==1){
$store_info=$this->db->where('lab_id',$order_info['lab_id'])->get('medicallabs')->row_array();
}
if($prescription_info!=''){
$user_info=$this->db->where('user_id',$prescription_info['user_id'])->get('users')->row_array();
}else{
$user_info=$this->db->where('user_id',$order_info['user_id'])->get('users')->row_array();
}
$hospital_info=$this->db->where('hospital_id',$doctor_info['hospital_id'])->get('hospitals')->row_array();
$prescription_data=explode('|',$this->encryption->decrypt($prescription_info['prescription_data']));
$order_data=explode('|',$this->encryption->decrypt($order_info['order_data']));
?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">   
            <div class="panel-body">
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
    <td align="left"><h3>Title :- <?php if($prescription_data[0]!=''){echo $prescription_data[0];}else{echo $order_data[0];}?></h3></td>
            </tr>
        </tbody>
    </table>
</div>
</div>
<div class="row">
    <div class="col-md-12">
    <table width="100%" border="0">    
            <tbody><tr>
                <td align="right"></td>
            </tr>
            <tr>
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
                <td align="left"><h3><u><?php if($order_info['order_type']==0){echo "Medical Store";}elseif($order_info['order_type']==1){echo "Medical Lab";}?></u></h3></td>
                <td align="right"><h3><u>Patient</u></h3></td>
            </tr>

            <tr>
                <td align="left" valign="top">
<h3><?php echo $store_info['name'] .' ('.$store_info['unique_id'].')';?></h3>
<h4><i class="fa fa-phone m-r-xs"></i>&nbsp;&nbsp;<?php echo $store_info['phone'];?></h4>
<h4><i class="fa fa-envelope m-r-xs"></i>&nbsp;&nbsp;<?php echo $store_info['email'];?></h4>
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
<form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/add_receipt/<?php echo $order_info['order_type'];?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="order_id" value="<?= $order_info['order_id'];?>">
    
<?php if($order_info['order_type'] == 0){?>
<h2 class="col-sm-12"><?php echo get_phrase('Medicine'); ?></h2>
<div class="col-md-12">
    <div class="table-responsive">
    
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Drug</th>
        <th scope="col">Quantity</th>
        <th scope="col">Price/unit</th>
        <th scope="col" formula="cost*qty"summary="sum">Total Price</th>
      </tr>
    </thead>
    <tbody>
        <?php 
        if($prescription_data[1]!=''){$drug=explode(',',$prescription_data[1]);}else{$drug=explode(',',$order_data[1]);}
        if($account_type!='medicalstores'){
        if($prescription_data[1]!=''){$quantity=explode(',',$prescription_data[5]);}else{$quantity=explode(',',$order_data[3]);}
        }elseif($account_type=='medicalstores'){
        if($prescription_data[1]!=''){$quantity=explode(',',$order_info['quantity']);}else{$quantity=explode(',',$order_data[3]);}
        }
        ?>
        <?php for($i1=0;$i1<count($drug);$i1++){?>
      <tr>
        <th scope="row"><?= $i1+1;?></th>
        <td><?= $drug[$i1];?></td>
        <td><?= $quantity[$i1];?></td>
        <td><input type="type" name="cost[]" id="cost_<?= $i1+1;?>" onchange="return get_cost(<?= $i1+1;?>);">
            <input type="hidden" id="quantity_<?= $i1+1;?>" value="<?= $quantity[$i1];?>">
        </td>
        <td><input type="text" id="price<?=$i1+1;?>" name="price[]" value=""  data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" readonly="" autocomplete="off"/></td>
      </tr>
      <?php }?>
    </tbody>
    <thead>
        <tr> <th colspan="4" scope="col"><label>Total</label> : </th><td><input type="text" name="total" id="total"readonly="" />&nbsp;<input class="btn btn-info"type="button" value="Total"  onclick="totalIt()"  /></td></tr>
    </thead>
  </table>
</div>
</div>
<?php }?>
<?php if($order_info['order_type'] == 1){?>

<h2 class="col-sm-12"><?php echo get_phrase('tests'); ?></h2>
<div class="col-md-12">
    <div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col">Reports</th>
        <th scope="col" formula="cost*qty"summary="sum">Price</th>
      </tr>
    </thead>
    <tbody>
        <?php 
        if($prescription_data[7]!=''){$test_title=explode(',',$prescription_data[7]);}else{$test_title=explode(',',$order_data[1]);}
        if($prescription_data[7]!=''){$description=explode(',',$prescription_data[8]);}else{$description=explode(',',$order_data[2]);}
        $tests=explode(',',$order_info['tests']);
        ?>
        <input type="hidden" name="count" value="<?= count($test_title)?>">
<?php for($i1=0;$i1<count($test_title);$i1++){
   if(($tests[$i1]==1 && $order_info['type_of_order']==0) || $order_info['type_of_order']==1){   ?>
      <tr>
        <th scope="row"><?= $i1+1;?></th>
        <td><?= $test_title[$i1];?></td>
        <td><?= $description[$i1];?></td>
        <td><div class="col-sm-12">
        <input type="file" name="userfile[]" id="userfile" value="<?php echo set_value('userfile'); ?>">
<!--                             <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                <div>
                                    <span class="btn btn-blue btn-file">
                                        <span class="fileinput-new"><?php echo get_phrase('select_report'); ?></span>
                                        <span class="fileinput-exists"><?php echo get_phrase('change'); ?></span>
                                        <input type="file" name="userfile[]" id="userfile" value="<?php echo set_value('userfile'); ?>">
                                    </span>
<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('remove'); ?></a>
                                </div>
                            </div> -->
                        </div>
            </td>
        <td><input type="text" id="price<?=$i1+1;?>" name="price[]" value=""  data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" autocomplete="off"/></td>
      </tr>
      <?php }
        }?>
    </tbody>
    <thead>
        <tr> <th colspan="4" scope="col"><label class="pull-right">Total : </label>  </th><td><input type="text" readonly="readonly" name="total" id="total" />&nbsp;<input class="btn btn-info"type="button" value="Total" onclick="totalIt()" /></td></tr>
    </thead>
  </table>
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
</div>
</div>
<br/><br/>
<script>
    function get_cost($i) {
    var quantity=$('#quantity_'+$i).val();
    var cost=$('#cost_'+$i).val();
    var total=quantity*cost;
    $('#price'+$i).val(total);
    }
</script>
<script>
    function totalIt() {
  var count = document.getElementsByName("price[]");
  var total=0;
  for (var i=1;i<=count.length;i++) { 
    var price = parseFloat(document.getElementById("price"+i).value);
    total += isNaN(price)?0:price;
  }
  document.getElementById("total").value=isNaN(total)?"0.00":total.toFixed(2);                        
}
/*function get_cost(cost){
var quantity = document.getElementsByName("quantity[]");
  var total=0;
  for (var i=1;i<=quantity.length;i++) { 
    var cost = $("#cost"+i).value;
    var price = $("#price"+i).value;
    total += isNaN(price)?0:price;
  }
    alert(cost);
} */
</script>
<!-- 
<script>
    function calc(idx) {
        alert(idx);
  var price = parseFloat(document.getElementById("price"+idx).value);/**
              parseFloat(document.getElementById("qty"+idx).value);*/
   alert(idx+":"+price);  
  document.getElementById("price"+idx).value= isNaN(price)?"0.00":price.toFixed(2);
   
}

function totalIt() {
  var qtys = document.getElementsByName("qty[]");
  var total=0;
  for (var i=1;i<=qtys.length;i++) {
    calc(i);  
    var price = parseFloat(document.getElementById("price"+i).value);
    total += isNaN(price)?0:price;
  }
  document.getElementById("total").value=isNaN(total)?"0.00":total.toFixed(2);                        
}      

window.onload=function() {
  document.getElementsByName("qty[]")[0].onkeyup=function() {calc(1)};
  document.getElementsByName("cost[]")[0].onkeyup=function() {calc(1)};
}

var rowCount =0;
    function addRow(tableID) {

        var table = document.getElementById(tableID);

        var rowCount = table.rows.length;
        var row = table.insertRow(rowCount);

        var cell1 = row.insertCell(0);
        var element1 = document.createElement("input");
        element1.type = "checkbox";
        element1.name = "chk[]";
        cell1.appendChild(element1);

        var cell2 = row.insertCell(1);
        cell2.innerHTML = rowCount;

        var cell3 = row.insertCell(2);
        var element3 = document.createElement("input");
        element3.type = "text";
        element3.name = "item[]";
        element3.required = "required";
        cell3.appendChild(element3);

        var cell4 = row.insertCell(3);
        var element4 = document.createElement("input");
        element4.type = "text";
        element4.name = "qty[]";
        element4.id = "qty"+rowCount;
        element4.onkeyup=function() {calc(rowCount);}
        cell4.appendChild(element4);

        var cell5 = row.insertCell(4);
        var element5 = document.createElement("input");
        element5.type = "text";
        element5.name = "cost[]";
        element5.id = "cost"+rowCount;
        element5.onkeyup=function() {calc(rowCount);}
        cell5.appendChild(element5);

        var cell6 = row.insertCell(5);
        var element6 = document.createElement("input");
        element6.type = "text";
        element6.name = "price[]";
        element6.id = "price"+rowCount
        cell6.appendChild(element6);



    }

    function deleteRow(tableID) {
        try {
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;

        for(var i=0; i<rowCount; i++) {
            var row = table.rows[i];
            var chkbox = row.cells[0].childNodes[0];
            if(null != chkbox && true == chkbox.checked) {
                table.deleteRow(i);
                rowCount--;
                i--;
            }


        }
        }catch(e) {
            alert(e);
        }
    }

</script> -->