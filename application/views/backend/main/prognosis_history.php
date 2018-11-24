<?php 
$prognosis_info = $this->db->get_where('prognosis', array('prognosis_id' =>$prognosis_id))->row_array();
$doctor_info=$this->crud_model->select_doctor_info_id($prognosis_info['doctor_id']);

$user_info=$this->db->where('user_id',$prognosis_info['user_id'])->get('users')->row_array();
$hospital_info=$this->db->where('hospital_id',$doctor_info['hospital_id'])->get('hospitals')->row_array();
$prescription_data=explode('|',$this->encryption->decrypt($prognosis_info['prognosis_data']));
?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">   
            <div class="panel-heading">
<div class="row">
    <div class="col-sm-2 pull-right">
    <input type="button" onclick="printDiv('print_div')" class="btn btn-primary" value="Print">
    <input type="button" class="btn btn-info" value="<?php echo get_phrase('close'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
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
                <td align="left"><h3>Title :- <?php echo $prescription_data[0];?></h3></td>
                <td align="right"></td>
            </tr>
                <tr>
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
         <h3>Dr. <?php echo $doctor_info['name'] .' ('.$doctor_info['unique_id'].')';?></h3>
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
<div class="row">
    <div class="col-md-12">
    <table width="100%" border="0">    
            <tbody>
                <tr>
                <td align="left"><h3>Case History</h3> <?php echo $prescription_data[1];?></td>
            </tr>
        </tbody>
    </table>
</div>
</div>
<br/><br/><br/>

<footer>
    <hr/>
    <span style="font-size:8.0pt;mso-bidi-font-size:
                                            9.0pt;font-family:&quot;times new roman&quot;,serif;mso-fareast-font-family:&quot;times new roman&quot;;
                                            mso-ansi-language:en-us;mso-fareast-language:en-us;mso-bidi-language:ar-sa" lang="EN-US">&nbsp; <span style="white-space:pre" class="Apple-tab-span"> </span>&nbsp;© This document Compiled by MyPulse.</span>

</footer>

</div>
</div>
</div>
</div>
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
