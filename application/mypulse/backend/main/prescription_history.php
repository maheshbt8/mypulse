<?php 
if($prescription_id==''){
$order_info=$this->crud_model->select_order_info_id($order_id);
if($order_info['type_of_order']==0){
$prescription_info = $this->db->get_where('prescription', array('prescription_id' =>$order_info['prescription_id']))->row_array();
}
}
if($prescription_id!=''){
$prescription_info = $this->db->get_where('prescription', array('prescription_id' =>$prescription_id))->row_array();
}
$doctor_info=$this->crud_model->select_doctor_info_id($prescription_info['doctor_id']);
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
            <div class="panel-heading">
<div class="row">
    <div class="col-sm-2 pull-right">
    <input type="button" onclick="printDiv('print_div')" class="btn btn-primary" value="Print">
    <input type="button" class="btn btn-info" value="<?php echo get_phrase('close'); ?>" onclick="window.location.href = '<?php if($account_type=='users'){echo $this->session->userdata('last_page'); }else{echo $this->session->userdata('last_page1');}?>'">
</div>
</div>
</div>
<div class="panel-body">

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
            <tbody>
                <tr>
                <td align="left"><h3>Title :- <?php if($prescription_data[0]!=''){echo $prescription_data[0];}else{echo $order_data[0];}?></h3></td>
                <td align="right"></td>
            </tr>
                <tr>
                <?php if($prescription_info!=''){?><td align="left"><img src="<?php echo base_url();?>uploads/hospitallogs/<?= $doctor_info['hospital_id'];?>.png"  style="max-height:45px; margin: 0px;"/></td><?php }?>
                <!-- <td align="right"></td> -->
            </tr>

            <tr>
                <?php if($prescription_info!=''){?><td align="left" valign="top">
                    <h3><?php echo $hospital_info['name'];?></h3>
<h4><i class="fa fa-map-marker m-r-xs"></i>&nbsp;&nbsp;<?php echo $hospital_info['address'];?></h4>
<h4><i class="fa fa-envelope m-r-xs"></i>&nbsp;&nbsp;<?php echo $hospital_info['email'];?></h4>          
                </td><?php }?>
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
                <?php if($prescription_info!=''){?>
                <td align="left"><h3><u>Doctor</u></h3></td><?php }?>
                <td align="right"><h3><u>Patient</u></h3></td>
            </tr>

            <tr>
            <?php if($prescription_info!=''){?>
                <td align="left" valign="top">
         <h3>Dr. <?php echo $doctor_info['name'] .' ('.$doctor_info['unique_id'].')';?></h3>
<h4><i class="fa fa-phone m-r-xs"></i>&nbsp;&nbsp;<?php echo $doctor_info['phone'];?></h4>
<h4><i class="fa fa-envelope m-r-xs"></i>&nbsp;&nbsp;<?php echo $doctor_info['email'];?></h4>
                </td><?php }?>
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

<div class="row">
<?php if($order_type == 0 || $account_type=='doctors' || $account_type=='nurse' ||($order_type=='' && $account_type=='users')){
if($prescription_data[1]!='' || $order_data[1]!=''){
        ?>
<h2 class="col-sm-12"><?php echo get_phrase('prescription_for_medicines'); ?></h2>
<div class="col-md-12">
    <div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Drug</th>
        <th>Strength</th>
        <?php if($prescription_data[1]!=''){?>
        <th>Dosage</th>
        <th>Duration</th><?php }?>
        <th>Quantity</th>
        <?php if($prescription_data[1]!=''){?><th>Note</th><?php }?>
      </tr>
    </thead>
    <tbody>
        <?php
        if($prescription_data[1]!=''){ 
        $drug=explode(',',$prescription_data[1]);}else{$drug=explode(',',$order_data[1]);}
        if($prescription_data[1]!=''){
        $strength=explode(',',$prescription_data[2]);}else{$strength=explode(',',$order_data[2]);}
        if($prescription_data[1]!=''){
        $dosage=explode(',',$prescription_data[3]);
        $duration=explode(',',$prescription_data[4]);
        }
        if($prescription_data[1]!=''){
        if($order_id == ''){
        $quantity=explode(',',$prescription_data[5]);
        }elseif($order_id != ''){
        $quantity=explode(',',$order_info['quantity']); 
        }
        }else{
        $quantity=explode(',',$order_data[3]);
        }
        $note=explode(',',$prescription_data[6]);
        ?>
        <?php for($i1=0;$i1<count($drug);$i1++){
            ?>
      <tr>
        <th><?= $i1+1;?></th>
        <td><?= $drug[$i1];?></td>
        <td><?= $strength[$i1];?></td>
        <?php if($prescription_data[1]!=''){?>
        <td><?= $dosage[$i1];?></td>
        <td><?= $duration[$i1];?></td><?php }?>
        <td><?= $quantity[$i1];?></td>
      <?php if($prescription_data[1]!=''){?><td><?= $note[$i1];?></td><?php }?>
      </tr>
      <?php }?>
    </tbody>
  </table>
</div>
</div>
<?php }}
if($order_type == 1 || $account_type=='doctors' || $account_type=='nurse' ||($order_type=='' && $account_type=='users')){
    if($prescription_data[7]!='' || $order_data[1]!=''){?>
<h2 class="col-sm-12"><?php echo get_phrase('prescription_for_medical_tests'); ?></h2>
<div class="col-md-12">
    <div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
      </tr>
    </thead>
    <tbody>
        <?php 
        if($prescription_data[7]!=''){
            $test_title=explode(',',$prescription_data[7]);
        }else{
        $test_title=explode(',',$order_data[1]);}
        if($prescription_data[7]!=''){
            $description=explode(',',$prescription_data[8]);
        }else{
        $description=explode(',',$order_data[2]);
        }
        
        if($account_type == 'medicallabs'){
        $tests=explode(',',$order_info['tests']); 
        }
        ?>
        <?php for($i1=0;$i1<count($test_title);$i1++){
            if($account_type == 'medicallabs'){
                if($tests[$i1]==1){
            ?>
      <tr>
        <th><?= $i1+1;?></th>
        <td><?= $test_title[$i1];?></td>
        <td><?= $description[$i1];?></td>
      </tr>
      <?php }}elseif($account_type != 'medicallabs'){ ?>
<tr>
        <th><?= $i1+1;?></th>
        <td><?= $test_title[$i1];?></td>
        <td><?= $description[$i1];?></td>
      </tr>
      <?php } }?>
    </tbody>
  </table>
</div>
</div>
<?php }}?>
</div>
<?php if($prescription_info!=''){?>
<div class="row">
    <div class="col-md-12">
    <table width="100%" border="0">    
            <tbody>
                <tr>
                <td align="left"><h3>Additional Note </h3> <?php echo $prescription_data[9];?></td>
            </tr>
        </tbody>
    </table>
</div>
</div>
<?php }?>
<br/><br/><br/>

<footer>
<hr/>
<span style="font-size:8.0pt;mso-bidi-font-size:9.0pt;font-family:&quot;times new roman&quot;,serif;mso-fareast-font-family:&quot;times new roman&quot;mso-ansi-language:en-us;mso-fareast-language:en-us;mso-bidi-language:ar-sa" lang="EN-US">&nbsp; <span style="white-space:pre" class="Apple-tab-span"> </span>&nbsp;© This document Compiled by MyPulse.</span>
</footer>
</div>
</div>
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
