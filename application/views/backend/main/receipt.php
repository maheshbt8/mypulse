<?php 
$order_info=$this->crud_model->select_order_info_id($order_id);
$report_info=$this->crud_model->select_medical_reports_information($order_id);
$prescription_info = $this->db->get_where('prescription', array('prescription_id' =>$order_info['prescription_id']))->row_array();
if($order_info['order_type']==0){
$store_info=$this->db->where('store_id',$order_info['store_id'])->get('medicalstores')->row_array();
}elseif($order_info['order_type']==1){
$store_info=$this->db->where('lab_id',$order_info['lab_id'])->get('medicallabs')->row_array();
}
$user_info=$this->db->where('user_id',$prescription_info['user_id'])->get('users')->row_array();
$hospital_info=$this->db->where('hospital_id',$doctor_info['hospital_id'])->get('hospitals')->row_array();
$prescription_data=explode('|',$this->encryption->decrypt($prescription_info['prescription_data']));
?>
<div class="row">
    <div class="col-sm-2 pull-right">
    <input type="button" onclick="printDiv('print_div')" class="btn btn-primary" value="Print">
    <input type="button" class="btn btn-info" value="<?php echo get_phrase('close'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
</div>
</div>
<br/>
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
        <th scope="col">Price</th>
      </tr>
    </thead>
    <tbody>
        <?php 
        $drug=explode(',',$prescription_data[1]);
        /*if($account_type!='medicalstores'){
        $quantity=explode(',',$this->encryption->decrypt($prescription_info['quantity']));*/
        /*}elseif($account_type=='medicalstores'){*/
        $quantity=explode(',',$order_info['quantity']); 
        /*}*/
        $price=explode(',',$order_info['price']);
        ?>
        <?php for($i1=0;$i1<count($drug);$i1++){?>
      <tr>
        <th scope="row"><?= $i1+1;?></th>
        <td><?= $drug[$i1];?></td>
        <td><?= $quantity[$i1];?></td>
        <td><?= $price[$i1];?></td>
      </tr>
      <?php }?>
    </tbody>
    <thead>
        <tr> <th colspan="3" scope="col"><label>Total</label> : </th><th><b><?= $order_info['total'];?></b></th></tr>
    </thead>
  </table>
</div>
</div>
</div>
<?php }?>
<?php if($order_info['order_type'] == 1){ ?>

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
        <th scope="col">Reports</th>
        <th scope="col">Price</th>
      </tr>
    </thead>
    <tbody>
        <?php 
        $test_title=explode(',',$prescription_data[7]);
        $description=explode(',',$prescription_data[8]);
        $tests=explode(',',$order_info['tests']);
        $price=explode(',',$order_info['price']);
        ?>
        <input type="hidden" name="count" value="<?= count($test_title)?>">
        <?php for($i1=0;$i1<count($test_title);$i1++){
            if($tests[$i1]==1){
            ?>
      <tr>
        <th scope="row"><?= $i1+1;?></th>
        <td><?= $test_title[$i1];?></td>
        <td><?= $description[$i1];?></td>
        <td><?php if($report_info[$i1]['extension']!=''){?><a href="<?=base_url('uploads/reports/').$report_info[$i1]['report_id'].'.'.$report_info[$i1]['extension'];?>" class="hiper" download><i class="fa fa-download"></i></a><?php }?></td>
        <td><?= $price[$i1];?></td>
      </tr>
      <?php }
        }?>
    </tbody>
    <thead>
        <tr> <th colspan="4" scope="col"><label>Total</label> : </th><th><b><?= $order_info['total'];?></b></th></tr>
    </thead>
  </table>
</div>
</div>

</div>

<?php }?>
</form> 
<br/><br/><br/>
</div>
</div>
<br/><br/>

<script type="text/javascript">
   function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>