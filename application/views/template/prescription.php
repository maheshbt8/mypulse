<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <div style="top:0;" class="scroll-y fill body">
            <div style="position: relative">
                <div style="min-width: 650px;" class="details-page ">
                    <div style="min-height: 800px;" class="details-container clearfix">
                        <div>
                            <style media="all" type="text/css">
                                .pcs-template {
                                font-family: Ubuntu;
                                font-size: 9pt;
                                color: #333333;
                                background:  #ffffff ;
                                }
                                .pcs-header-content {
                                font-size: 9pt;
                                color: #333333;
                                background-color: #ffffff;
                                }
                                .pcs-template-body {
                                padding: 0 0.400000in 0 0.550000in;
                                }
                                .pcs-template-footer {
                                height: 0.700000in;
                                font-size: 6pt;
                                color: #aaaaaa;
                                padding: 0 0.400000in 0 0.550000in;
                                background-color: #ffffff;
                                }
                                .pcs-footer-content {
                                word-wrap: break-word;
                                color: #aaaaaa;
                                border-top: 1px solid #e3e3e3;
                                }
                                .pcs-label {
                                color: #817d7d;
                                }
                                .pcs-entity-title {
                                font-size: 28pt;
                                color: #000000;
                                }
                                .pcs-orgname {
                                font-size: 10pt;
                                color: #333333;
                                }
                                .pcs-customer-name {
                                font-size: 9pt;
                                color: #333333;
                                }
                                .pcs-itemtable-header {
                                font-size: 9pt;
                                color: #ffffff;
                                background-color: #3c3d3a;
                                }
                                .pcs-taxtable-header {
                                font-size: 9pt;
                                color: #000;
                                background-color: #f5f4f3;
                                }
                                .itemBody tr {
                                page-break-inside: avoid;
                                page-break-after:auto;
                                }
                                .pcs-item-row {
                                font-size: 8pt;
                                border-bottom: 1px solid #e3e3e3;
                                background-color: #ffffff;
                                color: #000000;
                                }
                                .pcs-item-sku {
                                margin-top: 2px;
                                font-size: 10px;
                                color: #545454;
                                }
                                .pcs-item-desc {
                                color: #727272;
                                font-size: 8pt;
                                }
                                .pcs-balance {
                                background-color: #f5f4f3;
                                font-size: 9pt;
                                color: #000000;
                                }
                                .pcs-totals {
                                font-size: 9pt;
                                color: #000000;
                                background-color: #ffffff;
                                }
                                .pcs-notes {
                                font-size: 8pt;
                                }
                                .pcs-terms {
                                font-size: 8pt;
                                }
                                .pcs-header-first {
                                background-color: #ffffff;
                                font-size: 9pt;
                                color: #333333;
                                height: auto;
                                }
                                .pcs-status {
                                color: ;
                                font-size: 15pt;
                                border: 3px solid ;
                                padding: 3px 8px;
                                }
                                @page :first {
                                @top-center {
                                content: element(header);
                                }
                                margin-top: 0.700000in;
                                }
                                .pcs-template-header {
                                padding: 0 0.400000in 0 0.550000in;
                                height: 0.700000in;
                                }
                            </style>
                            <div class="pcs-template">
                                <div class="pcs-template-header pcs-header-content" id="header"></div>
                                <div class="pcs-template-body" style="min-height: 240mm;">
                                    <table style="width:100%;table-layout: fixed;">
                                        <tbody>
                                            <tr>
                                                <td style="vertical-align: top; width:50%;">
                                                    <span class="pcs-entity-title">
														<img style="width:250px;max-height:100px" src="<?php echo base_url()."public/assets/images/logo.png";?>" />
													</span>
                                                </td>
                                                <td style="vertical-align: top; text-align:right;width:50%;">
                                                    <span class="pcs-entity-title">
														<?php 
															if(isset($data['hospital_logo']) && $data['hospital_logo'] != ""){
														?>
                                                        <img src="<?php echo $data['hospital_logo'];?>" style="width:250px;max-height:100px;" id="logo_content">
														<?php } ?>
														    <!--<img style="width:250px;max-height:100px" src="<?php echo base_url()."public/assets/images/logo.png";?>" />-->
													</span><br>
                                                    <span id="tmp_entity_number" style="font-size: 10pt;" class="pcs-label"><b></b></span>
                                                    <div style="clear:both;margin-top:20px;">
                                                        <label style="font-size: 10pt;" class="pcs-label">Hospital</label>
                                                        <br>
                                                        <span class="pcs-customer-name" id="zb-pdf-customer-detail"><?php echo $data['hospital_name'];?></span><br>
                                                        <span class="pcs-customer-name" id="zb-pdf-customer-detail"><i class="fa fa-map-marker"></i> &nbsp;<?php echo $data['hospital_address'];?></span><br>
                                                        <span class="pcs-customer-name" id="zb-pdf-customer-detail"><i class="fa fa-envelope-o"></i> &nbsp;<?php echo $data['hospital_email'];?></span><br>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table style="width:100%;margin-top:30px;table-layout:fixed;">
                                        <tbody>
                                            <tr>
                                                <td style="width:55%;vertical-align:top;word-wrap: break-word;">
                                                    <div>
                                                        <label style="font-size: 10pt;" class="pcs-label">Doctor</label>
                                                        <br>
                                                        <span class="pcs-customer-name" id="zb-pdf-customer-detail"><?php echo $data['doctor_name'];?></span><br>
                                                        <span class="pcs-customer-name" id="zb-pdf-customer-detail"><i class="fa fa-phone"></i> &nbsp;<?php echo $data['doctor_contact'];?></span><br>
                                                    </div>
                                                    <div style="clear:both;width:50%;font-size:10pt;margin-top: 20px;">
                                                        <label style="font-size: 10pt;" id="tmp_shipping_address_label" class="pcs-label">Prescription for </label>
                                                        <br>
                                                        <span style="white-space: pre-wrap;" id="tmp_shipping_address"><?php echo $data['patient_name'];?></span><br>
                                                        <span style="white-space: pre-wrap;" id="tmp_shipping_address"><i class="fa fa-phone"></i> &nbsp;<?php echo $data['patient_contact'];?></span><br>
                                                        <span style="white-space: pre-wrap;" id="tmp_shipping_address"><i class="fa fa-envelope-o"></i> &nbsp;<?php echo $data['patient_email'];?></span>
                                                    </div>
                                                </td>
                                                <td style="vertical-align:bottom;width: 45%;" align="right">
                                                    <table style="float:right;width: 100%;table-layout: fixed;word-wrap: break-word;" cellspacing="0" cellpadding="0" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="text-align:right;padding:5px 10px 5px 0px;font-size:10pt;width:60%;">
                                                                    <span class="pcs-label">Date :</span>
                                                                </td>
                                                                <td style="text-align:right;width:40%;">
                                                                    <span id="tmp_entity_date"><?php echo date("d M Y",strtotime($data['date']));?></span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
									<?php $isMedStore = isset($data['isMedStore']) ? $data['isMedStore'] === true : false; 
									if(isset($data['items']) && count($data['items']) > 0) { 
									?>
                                    <h3>Medicine</h3>
                                    <table style="width:100%;margin-top:20px;table-layout:fixed;" class="pcs-itemtable" cellspacing="0" cellpadding="0" border="0">
                                        <thead>
                                            <tr style="height:32px;">
                                                <td style="padding:5px 0 5px 5px;text-align: center;word-wrap: break-word;width: 5%;" class="pcs-itemtable-header">
                                                    #
                                                </td>
                                                <td style="padding:5px 10px 5px 20px;word-wrap: break-word;" class="pcs-itemtable-header pcs-itemtable-description">
                                                    Drug
                                                </td>
                                                <td style="padding:5px 10px 5px 5px;word-wrap: break-word;width: 11%;" class="pcs-itemtable-header" align="right">
                                                    Strength
                                                </td>
                                                <td style="padding:5px 10px 5px 5px;word-wrap: break-word;width: 11%;" class="pcs-itemtable-header" align="right">
                                                    Dosage
                                                </td>
                                                <td style="padding:5px 10px 5px 5px;word-wrap: break-word;width:120px;" class="pcs-itemtable-header" align="right">
                                                    Duration
                                                </td>
                                                <td style="padding:5px 10px 5px 5px;word-wrap: break-word;width:120px;" class="pcs-itemtable-header" align="right">
                                                    Quantity
                                                </td>
                                                <td style="padding:5px 10px 5px 5px;word-wrap: break-word;width:120px;" class="pcs-itemtable-header" align="right">
                                                    Note
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody class="itemBody">
                                            <?php
                                                $cnt = 1;
                                                foreach ($data['items'] as $key => $item) {
                                                    ?>
                                                    <tr>
                                                        <td style="padding: 10px 0 10px 5px;text-align: center;word-wrap: break-word;" class="pcs-item-row" valign="top"><?php echo $cnt;?></td>
                                                        <td style="padding: 10px 0px 10px 20px;" class="pcs-item-row" valign="top">
                                                            <span id="tmp_item_qty"><?php echo $item['drug']; ?></span>
                                                        </td>
                                                        <td style="padding: 10px 10px 5px 10px;text-align:right;word-wrap: break-word;" class="pcs-item-row" valign="top">
                                                            <span id="tmp_item_qty"><?php echo $item['strength']; ?></span>
                                                        </td>
                                                        <td style="padding: 10px 10px 5px 10px;text-align:right;word-wrap: break-word;" class="pcs-item-row" valign="top">
                                                            <span id="tmp_item_qty"><?php echo $item['dosage']; ?></span>
                                                        </td>
                                                        <td style="text-align:right;padding: 10px 10px 10px 5px;word-wrap: break-word;" class="pcs-item-row" valign="top">
                                                            <span id="tmp_item_qty"><?php echo $item['duration']; ?></span>
                                                        </td>
                                                        <td style="text-align:right;padding: 10px 10px 10px 5px;word-wrap: break-word;" class="pcs-item-row" valign="top">
                                                            <span id="tmp_item_qty"><?php 
                                                                if($isMedStore){
                                                                    echo $item['order_qty']; 
                                                                }else{
                                                                    echo $item['qty']; 
                                                                }
                                                            ?></span>
                                                        </td>
                                                        <td style="text-align:right;padding: 10px 10px 10px 5px;word-wrap: break-word;" class="pcs-item-row" valign="top">
                                                            <span id="tmp_item_qty"><?php echo $item['note']; ?></span>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $cnt++;
                                                }
                                            ?>
                                        </tbody>
                                    </table>
									<?php } ?>
                            <?php
                                if(count($data['reports']) > 0 && !$isMedStore){ 
                                    echo '<h3>Medical Test Reports</h3>';
                                    $cnt = 1;
                                    foreach($data['reports'] as $report){
                                        $rowSpan = 1;
                                        if(count($report['files']) > 0){
                                            $rowSpan = count($report['files']);
                                        }
                                    ?>
                                    <table style="width:100%;margin-top:20px;table-layout:fixed;" class="pcs-itemtable" cellspacing="0" cellpadding="0" border="0">
                                        <thead>
                                            <tr style="height:32px;">
                                                <td style="padding:5px 0 5px 5px;text-align: center;word-wrap: break-word;width: 5%;" class="pcs-itemtable-header">
                                                    #
                                                </td>
                                                <td style="padding:5px 10px 5px 20px;word-wrap: break-word;" class="pcs-itemtable-header pcs-itemtable-description">
                                                    Title
                                                </td>
                                                <td style="padding:5px 10px 5px 5px;word-wrap: break-word;width: 11%;" class="pcs-itemtable-header" align="right">
                                                    Description
                                                </td>
                                                <td style="padding:5px 10px 5px 5px;word-wrap: break-word;width: 11%;" class="pcs-itemtable-header" align="right">
                                                    Report(s)
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody class="itemBody">
                                            <tr>
                                                <td style="padding: 10px 0 10px 5px;text-align: center;word-wrap: break-word;" class="pcs-item-row" valign="top"><?php echo $cnt;?></td>
                                                <td style="padding: 10px 0px 10px 20px;" class="pcs-item-row" valign="top">
                                                    <span ><?php echo $report['title']; ?></span>
                                                </td>
                                                <td style="padding: 10px 10px 5px 10px;text-align:right;word-wrap: break-word;" class="pcs-item-row" valign="top">
                                                    <span><?php echo $report['description']; ?></span>
                                                </td>
                                                <td style="padding: 10px 10px 5px 10px;text-align:right;word-wrap: break-word;" class="pcs-item-row" valign="top">
                                                    <?php
                                                    $r=1;
                                                    foreach($report['files'] as $file){
                                                        echo '<span><a data-fancybox="gallery" title="Report - '.$r.'" href="'.$file['file_url'].'">Report - '.$r.'</a></span><br><br>';
                                                        $r++;
                                                    }
                                                    ?>                                                    
                                                </td>    
                                            </tr>
                                        </tbody>
                                    </table>
                                    <?php
                                        $cnt++;
                                    }
                            
                                } ?>
                                    <br><br>
									<?php 
										if(isset($data['note']) && $data['note'] != ""){
									?>
										<label style="font-size: 10pt;" class="pcs-label"><?php echo $this->lang->line('additional_note');?></label>
										<br>
										<span class="pcs-customer-name" id="zb-pdf-customer-detail"><?php if(isset($data['note'])) { echo $data['note']; }?></span><br>
									<?php } ?>
								</div>
                                <div class="pcs-template-footer">
                                    <div class="pcs-footer-content">
                                        <span style="font-size:8.0pt;mso-bidi-font-size:
                                            9.0pt;font-family:&quot;times new roman&quot;,serif;mso-fareast-font-family:&quot;times new roman&quot;;
                                            mso-ansi-language:en-us;mso-fareast-language:en-us;mso-bidi-language:ar-sa" lang="EN-US">&nbsp; <span style="white-space:pre" class="Apple-tab-span"> </span>&nbsp;&copy; This document Compiled by MyPulse.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

