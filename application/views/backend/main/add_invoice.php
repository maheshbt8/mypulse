<?php 
$prescription_info = $this->db->get_where('prescription', array('prescription_id' =>$prescription_id))->row_array();
$order_info=$this->crud_model->select_order_info_id($order_id);
if($order_info['order_type']==0){
$store_info=$this->db->where('store_id',$order_info['store_id'])->get('medicalstores')->row_array();
}elseif($order_info['order_type']==1){
$store_info=$this->db->where('lab_id',$order_info['lab_id'])->get('medicallabs')->row_array();
}
$user_info=$this->db->where('user_id',$prescription_info['user_id'])->get('users')->row_array();
$hospital_info=$this->db->where('hospital_id',$doctor_info['hospital_id'])->get('hospitals')->row_array();
/*print_r($prescription_info);die;*/
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
    <td align="left"><h3>Title :- <?php echo $this->encryption->decrypt($prescription_info['title']);?></h3></td>
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
<div class="row">
<div class="col-md-12">
    <h2 class="col-sm-3"><?php echo get_phrase('Medicine'); ?></h2>
    <div class="table-responsive">
    
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Drug</th>
        <th scope="col">Quantity</th>
        <th scope="col" formula="cost*qty"summary="sum">Price</th>
      </tr>
    </thead>
    <tbody>
        <?php 
        $drug=explode(',',$this->encryption->decrypt($prescription_info['drug']));
        if($account_type!='medicalstores'){
        $quantity=explode(',',$this->encryption->decrypt($prescription_info['quantity']));
        }elseif($account_type=='medicalstores'){
        $quantity=explode(',',$order_info['quantity']); 
        }
        ?>
        <?php for($i1=0;$i1<count($drug);$i1++){?>
      <tr>
        <th scope="row"><?= $i1+1;?></th>
        <td><?= $drug[$i1];?></td>
        <td><?= $quantity[$i1];?></td>
        <td><input type="text" id="price<?=$i1+1;?>" name="price[]" value=""  data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" autocomplete="off"/></td>
      </tr>
      <?php }?>
    </tbody>
    <thead>
        <tr> <th colspan="3" scope="col"><label>Total</label> : </th><td><input type="text" readonly="readonly" name="total" id="total" />&nbsp;<input class="btn btn-info"type="button" value="Total" onclick="totalIt()" /></td></tr>
    </thead>
  </table>
</div>
</div>
</div>
<?php }?>
<?php if($order_info['order_type'] == 1){?>

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
        <th scope="col" formula="cost*qty"summary="sum">Price</th>
      </tr>
    </thead>
    <tbody>
        <?php 
        $test_title=explode(',',$this->encryption->decrypt($prescription_info['test_title']));
        $description=explode(',',$this->encryption->decrypt($prescription_info['description']));
        $tests=explode(',',$order_info['tests']); 
        ?>
        <input type="hidden" name="count" value="<?= count($test_title)?>">
        <?php for($i1=0;$i1<count($test_title);$i1++){
            if($tests[$i1]==1){
            ?>
      <tr>
        <th scope="row"><?= $i1+1;?></th>
        <td><?= $test_title[$i1];?></td>
        <td><?= $description[$i1];?></td>
        <td><input type="text" id="price<?=$i1+1;?>" name="price[]" value=""  data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" autocomplete="off"/></td>
      </tr>
      <?php }
        }?>
    </tbody>
    <thead>
        <tr> <th colspan="3" scope="col"><label>Total</label> : </th><td><input type="text" readonly="readonly" name="total" id="total" />&nbsp;<input class="btn btn-info"type="button" value="Total" onclick="totalIt()" /></td></tr>
    </thead>
  </table>

<!-- 

 <INPUT type="button" value="Add Row" onclick="addRow('dataTable')" />

            <INPUT type="button" value="Delete Row" onclick="deleteRow('dataTable')" />
        <form action="" method="post" enctype="multipart/form-data">
        invoice:<INPUT type="text" name="invoice id"/>

            <TABLE id="dataTable" width="350px" border="1" style="border-collapse:collapse;">
        <TR>
        <TH>Select</TH>
        <TH>Sr. No.</TH>
        <TH>Item</TH>
        <TH>Qty</TH>
        <TH>Cost</TH>
        <TH formula="cost*qty"summary="sum">Price</TH>
        </TR>
                <TR>
                    <TD><INPUT type="checkbox" name="chk[]"/></TD>
                    <TD> 1 </TD>
                    <TD> <INPUT type="text" name="item[] "/> </TD>
                    <TD> <INPUT type="text" id="qty1" name="qty[]"/> </TD>
                    <TD> <INPUT type="text" id="cost1" name="cost[]" /> </TD>
                    <TD> <INPUT type="text" id="price1" name="price[]" /> </TD>
                </TR>

            </TABLE>
            total: <input type="text" readonly="readonly" id="total" /><br/>
        <input type="button" value="Total" onclick="totalIt()" /><input type="submit" />
 </form> -->





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