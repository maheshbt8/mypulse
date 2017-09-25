<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
$this->load->view("template/header.php");
$this->load->view("template/left.php");
?>
    <input type="hidden" id="left_active_menu" value="51" />
	<div id="main-wrapper">
	    <div class="row">

            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title "><?php echo $this->lang->line('appointment');?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="row"> 
                            <div class="col-md-12">
                            <div class="col-md-6">
                                <table width="100%" style="border-collapse:separate; border-spacing:0 8px;">
                                    <tr>
                                        <td style='width:30%' align="right" valign="top"><strong>Appoitment # : </strong></td>
                                        <td style="width:2%">&nbsp;</td>
                                        <td style='width:69%' align="left" valign="center"><?php echo $appoitment['appoitment_number'];?></td>
                                    </tr>
                                    <tr>
                                        <td style='width:30%' align="right" valign="top"><strong>Appoitment Date : </strong></td>
                                        <td style="width:2%">&nbsp;</td>
                                        <td style='width:69%' align="left" valign="center"><?php echo date('d-M-Y',strtotime($appoitment['appoitment_date']));?></td>
                                    </tr>
                                    <tr>
                                        <td style='width:30%' align="right"><strong>Appoitment Sloat : </strong></td>
                                        <td style="width:2%">&nbsp;</td>
                                        <td style='width:69%' align="left"><?php echo date('h:i A',strtotime($appoitment['appoitment_time_start'])).' to '.date('h:i A',strtotime($appoitment['appoitment_time_end']));?></td>
                                    </tr>
                                    <tr>
                                        <td style='width:30%' align="right"><strong>Reason : </strong></td>
                                        <td style="width:2%">&nbsp;</td>
                                        <td style='width:69%' align="left"><?php echo $appoitment['reason'];?></td>
                                    </tr>
                                    <tr>
                                        <td style='width:30%' align="right"><strong>Status : </strong></td>
                                        <td style="width:2%">&nbsp;</td>
                                        <td style='width:69%' align="left"><?php echo $this->auth->getAppoitmentStatus($appoitment['status']);?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="input-Default" class="control-label"><?php echo $this->lang->line('labels')['remarks'];?></label>
                                    <textarea class="form-control" id="apt_remark" placeholder="<?php echo $this->lang->line('labels')['patientRecordRemark'];?>" <?php if($appoitment['status'] == 3) { echo "disabled"; } ?>><?php echo $appoitment['remarks'];?></textarea>
                                </div>
                                <?php if($appoitment['status'] != 3) { ?>
                                <button class="btn btn-success pull-right" data-id="<?php echo $appoitment['id'];?>" id="saveaptr">Save</button>
                                <?php } ?>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 user-profile">
            
                <div class="profile-image-container" >
                    <?php
                        $img = base_url().'public/assets/images/user.png';
                        if($profile['profile_photo'] != ""){
                            $img = $profile['profile_photo'];
                        }
                    ?>
                    <img src="<?php echo $img;?>" alt="" style="width:200px;height:auto;display:block;margin:auto;">
                </div>
            
                <h3 class="text-center"><?php
                    $name = isset($profile['first_name']) ? $profile['first_name'] : "";
                    $name .= " ".isset($profile['last_name']) ? $profile['last_name'] : "";
                    echo $name;
                ?></h3>
                <!--<p class="text-center"><?php //echo $profile['description'];?></p>-->
                <hr>
                <ul class="list-unstyled text-center">
                    <li><p><i class="fa fa-map-marker m-r-xs"></i><?php echo $profile['address'];?></p></li>
                    <li><p><i class="fa fa-envelope m-r-xs"></i><a href="#"></a><?php echo $profile['useremail'];?></p></li>
                    <li><p><i class="fa fa-phone m-r-xs"></i><a href="#"></a><?php echo $profile['mobile'];?></p></li>
                </ul>
                <hr>
                
            </div>
            <div class="col-md-9 m-t-lg">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <div class="">
                            <div class="custome_col8">
                                <h3 id="div_title" class="panel-title panel_heading_custome"><?php echo $this->lang->line('patientInfo');?></h3>
                            </div>
                            <div class="custome_col4">
                                <div class="panel_button_top_right">
                                    <a class="btn btn-success m-b-sm " style="display:none" id="add_noteBtn" data-toggle="modal" data-target="#AddNewNote" href="javascript:void(0);" ><?php echo $this->lang->line('buttons')['new_note'];?></a>&nbsp
                                    <button type="button" id="canPatientBtnHist" class="btn btn-warning pull-right" style="display:none"><i class="fa fa-remove"></i> &nbsp; Cancel</button>
                                    <a class="btn btn-default m-b-sm " id="cancelBtn" data-toggle="tooltip" style="display:none" href="javascript:void(0);" ><?php echo $this->lang->line('buttons')['cancel'];?></a>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                    <div class="panel-body" id="profileBody">
                        <div id="tabDiv" role="tabpanel">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#tab1"  aria-controls="home" role="tab" data-toggle="tab"><?php echo $this->lang->line('labels')['healthInfo'];?></a></li>                                
                                <li role="presentation" class=""><a href="#tab2"  aria-controls="home" role="tab" data-toggle="tab"><?php echo $this->lang->line('labels')['prescriptions'];?></a></li>
                                <li role="presentation" class=""><a href="#tab3" aria-controls="home" role="tab" data-toggle="tab"><?php echo $this->lang->line('labels')['health_records'];?></a></li>
                                 <!-- <li role="presentation" class=""><a href="#tab4" aria-controls="home" role="tab" data-toggle="tab"><?php// echo $this->lang->line('labels')['inpatient_records'];?></a></li> -->
                            </ul>
                            <!-- Tab panes -->
                            <form action="<?php echo site_url(); ?>/patients/updatemyprofile" method="post" id="form" enctype="multipart/form-data">
                            <input type="hidden" name="eidt_gf_id" value="<?php echo $profile['id'];?>" />
                            <input type="hidden" name="isDoc" value='1' />
                            <input type="hidden" name="appt_id" value='<?php echo $appoitment['id'];?>' />
                            <div class="tab-content">
                               <div role="tabpanel" class="tab-pane active" id="tab1">
                                    <div class="col-md-12">
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['selectBloodGroup'];?></label>
                                            <select class="form-control" name="blood_group" id="blood_group">
                                                <option <?php if($profile['gender']=="OPVE") { echo "selected";}?> value="OPVE">O +</option>
                                                <option <?php if($profile['gender']=="ONVE") { echo "selected";}?> value="ONVE">O -</option>
                                                <option <?php if($profile['gender']=="APVE") { echo "selected";}?> value="APVE">A +</option>
                                                <option <?php if($profile['gender']=="ANVE") { echo "selected";}?> value="ANVE">A -</option>
                                                <option <?php if($profile['gender']=="BPVE") { echo "selected";}?> value="BPVE">B +</option>
                                                <option <?php if($profile['gender']=="BNVE") { echo "selected";}?> value="BNVE">B -</option>
                                                <option <?php if($profile['gender']=="ABPVE") { echo "selected";}?> value="ABPVE">AB +</option>
                                                <option <?php if($profile['gender']=="ABNVE") { echo "selected";}?> value="ABNVE">AB -</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['height'];?></label>
                                            <div class="equalDivParent">
                                                <div class="form-group col-md-  equalDivChild">
                                                    <!--<label><?php //echo $this->lang->line('labels')['selectHeightFt'];?></label>-->
                                                    <select class="form-control" name="height_feet" id="height_feet">
                                                        <option><?php echo $this->lang->line('labels')['selectHeightFt'];?></option>
                                                        <?php
                                                            for($i=1; $i<=10; $i++){
                                                                $sel = "";
                                                                if($profile['height_feet'] == $i){
                                                                    $sel = "selected";
                                                                }
                                                                echo "<option $sel value='$i'>$i</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group  col-md- equalDivChild" style="margin-left:10%">
                                                    <!--<label><?php //echo $this->lang->line('labels')['selectHeightIc'];?></label>-->
                                                    <select class="form-control" name="height_inch" id="height_inch">
                                                        <option><?php echo $this->lang->line('labels')['selectHeightIc'];?></option>
                                                        <?php
                                                            for($i=1; $i<=12; $i++){
                                                                $sel = "";
                                                                if($profile['height_inch'] == $i){
                                                                    $sel = "selected";
                                                                }
                                                                echo "<option $sel value='$i'>$i</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>    
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['weight'];?></label>
                                            <input value="<?php echo $profile['weight'];?>" class="form-control" type="text" placeholder="<?php echo $this->lang->line('labels')['weight'];?>" name="weight" id="weight" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['bloodPressure'];?></label>
                                            <div  class="equalDivParent">
                                            <div class="col-md- equalDivChild">
                                                <?php $hb =$profile['high_blood_pressure'];
                                                    if($hb == 0){
                                                        $hb = "";
                                                    }
                                                ?>
                                                <input value="<?php echo $hb;?>" class="form-control" type="text" placeholder="<?php echo $this->lang->line('labels')['highBloodPressure'];?>" name="high_blood_pressure" id="high_blood_pressure" />
                                            </div>
                                            <div class="col-md- equalDivChild" style="margin-left:10%">
                                                <?php $lb =$profile['low_blood_pressure'];
                                                    if($lb == 0){
                                                        $lb = "";
                                                    }
                                                ?>
                                                <input value="<?php echo $lb;?>" class="form-control" type="text" placeholder="<?php echo $this->lang->line('labels')['lowBloodPressure'];?>" name="low_blood_pressure" id="low_blood_pressure" />
                                            </div>
                                            </div>  
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['sugarLevel'];?></label>
                                            <input value="<?php echo $profile['sugar_level'];?>" class="form-control" type="text" placeholder="<?php echo $this->lang->line('labels')['sugarLevel'];?>" name="sugar_level" id="sugar_level" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">    
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['selectHealthInsuranceProvider'];?></label>
                                            <select class="form-control"   name="health_insurance_provider" id="health_insurance_provider" >
                                                <?php 
                                                foreach($hip as $h){
                                                    $sel = "";
                                                    if($profile['health_insurance_provider'] == $h['id']){
                                                        $sel = "selected";
                                                    }
                                                    echo "<option $sel value='$h[id]'>$h[name]</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['healthInsuranceId'];?></label>
                                            <input value="<?php echo $profile['health_insurance_id'];?>" class="form-control" type="text" placeholder="<?php echo $this->lang->line('labels')['healthInsuranceId'];?>" name="health_insurance_id" id="health_insurance_id" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['familyHistory'];?></label>
                                            <textarea class="form-control" placeholder="<?php echo $this->lang->line('labels')['familyHistoryPlaceholder'];?>" id="family_history" name="family_history" ><?php echo $profile['family_history'];?></textarea>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['pastMedicalHistory'];?></label>
                                            <textarea class="form-control" placeholder="<?php echo $this->lang->line('labels')['pastMedicalHistoryPlaceholder'];?>" id="past_medical_history" name="past_medical_history" ><?php echo $profile['past_medical_history'];?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane " id="tab2">
                                    <div class="col-md-12">
                                        <div class="">
                                            <table id="prescriptionTbl" class="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
                                                <thead>
                                                    <tr>
                                                        <th style="width:10px"></th>
                                                        <th><?php echo $this->lang->line('tableHeaders')['prescriptionFor'];?></th>
                                                        <th><?php echo $this->lang->line('tableHeaders')['doctor'];?></th>
                                                        <th><?php echo $this->lang->line('tableHeaders')['date'];?></th>
                                                        <th><?php echo $this->lang->line('tableHeaders')['remarks'];?></th>
                                                        <th  width="20px">#</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>  
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="tab3">
                                    <div class="col-md-12">
                                        <div class="">
                                            <table id="reportTbl" class="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
                                                <thead>
                                                    <tr>
                                                        <th style="width:10px"></th>
                                                        <th><?php echo $this->lang->line('tableHeaders')['title'];?></th>
                                                        <th><?php echo $this->lang->line('tableHeaders')['description'];?></th>
                                                        <th><?php echo $this->lang->line('tableHeaders')['status'];?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>  
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="tab4">
                                    <div class="col-md-12">
                                        <div class="" id="inPatientTblDiv">
                                            <table id="inPatientTbl" class="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
                                                <thead>
                                                    <tr>
                                                        <th style="width:10px"></th>
                                                        <th><?php echo $this->lang->line('tableHeaders')['bed no'];?></th>
                                                        <th><?php echo $this->lang->line('tableHeaders')['join_date'];?></th>
                                                        <th><?php echo $this->lang->line('tableHeaders')['left_date'];?></th>
                                                        <th><?php echo $this->lang->line('tableHeaders')['reason'];?></th>
                                                        <th><?php echo $this->lang->line('tableHeaders')['status'];?></th>
                                                        <th><?php echo $this->lang->line('tableHeaders')['action'];?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                           
                                        </div>
                                        <div class="" id="inPatientTblHistoryDiv">
                                           <div class="Histry_record" style="margin-left: 50px;">                                              
                                              <h4>Bed :  <small id="bed_no"></small></h4>
                                              <h4>Join-Date:  <small id="jdate"></small></h4>
                                              <h4>Status:  <small id="hs_status"></small></h4>
                                              <h4>Reason:  <small id="hs_reason"></small></h4>
                                              <h4>Left-Date:  <small id="hs_ldate"></small></h4>
                                           </div>
                                             <table id="inPatientTblHistory" class="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
                                                <thead>
                                                    <tr>
                                                        <th style="width:10px"></th>
                                                        <th><?php echo $this->lang->line('tableHeaders')['note'];?></th>
                                                        <th><?php echo $this->lang->line('tableHeaders')['date'];?></th>
                                                        <th><?php echo $this->lang->line('tableHeaders')['action'];?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>                                                
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                          
                        <div class="row" id="inPatientDiv" style="display:none">
                            <div class="col-md-12"> 
                              <form id="patientform" method="post" action="<?php echo site_url();?>/doctors/addinpatient">
                                <input type="hidden" name="appt_id" value='<?php echo $appoitment['id'];?>' />
                                <input type="hidden" name="patient_id" value="<?php echo $profile['id'];?>" />
                                 <input type="hidden" name="inpatient_update_id" id="inpatient_id" />
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="Patientbed"><?php echo $this->lang->line('labels')['bed']; ?></label>
                                      <select id="Patientbed" class="form-control" name="Patientbed" id="Patientbed">
                                      </select>
                                  </div>
                                  <br>
                                  <div class="form-group">
                                    <label for="JoinDate"><?php echo $this->lang->line('labels')['join_date']; ?></label>
                                    <input type="text" class="form-control date-picker" name="join_date" id="datepicker">
                                  </div>
                                  <br>
                                  <div class="form-group">
                                  <label for="PatientStatus"><?php echo $this->lang->line('labels')['patientStatus']; ?></label>
                                      <select class="form-control" name="ptStatus" id="ptStatus">
                                         <option value="1">Yes</option>
                                         <option selected value="0">No</option>
                                      </select>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="PatientReason"><?php echo $this->lang->line('labels')['reason']; ?></label>
                                    <textarea class="form-control"  rows="6" name="inPatientReason" id="patient_reason"></textarea>
                                  </div><br>
                                  <div class="form-group">                                  
                                  <button type="button" id="canPatientBtn" class="btn btn-warning pull-right"><i class="fa fa-remove" ></i>Cancel
                                  </button>
                                  <button type="submit" class="btn btn-success pull-right" name="inpatient_up_form" id="inpatient_update" style="margin-right: 10px"><i class="fa fa-check"></i> Save</button>
                                  </div>
                                </div>
                             </form>  
                            </div>    
                        </div>         

                        <div class="row" id="preDiv" style="display:none">
                            <form action="<?php echo site_url();?>/doctors/newprescription" method="post" id="pre_form">
                                <input type="hidden" name="edit_id" id="edit_id" value='' />
                                <input type="hidden" name="appt_id" value='<?php echo $appoitment['id'];?>' />
                                <input type="hidden" name="patient_id" id="patient_id" value="<?php echo $profile['id'];?>" />
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        
                                        <div class="form-group col-md-6">
                                            <label for="input-Default" class="col-sm4 control-label"><?php echo $this->lang->line('tableHeaders')['prescriptionFor'];?></label>
                                            <div class="8">
                                                <input class="form-control  " type="text" id="title" name="title" placeholder="<?php echo $this->lang->line('tableHeaders')['prescriptionFor'];?>"  />
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="input-Default" class="col-s-4 control-label"><?php echo $this->lang->line('tableHeaders')['date'];?></label>
                                            <div class="">
                                                <input class="form-control  date-picker" type="text" id="date" name="date" disabled placeholder="Date"  value="<?php echo date('d-m-Y');?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" id="medReportDiv">
                                    <lable class="control-label"><b><h3>Prescription for Medical Tests </h3></b></label><br>
                                    <table width="100%" id="medRepTbl">
                                    </table>
                                <div>
                                <Br><br>
                                <div class="row">
                                        <div class="col-md-4">
                                            <button type="button" id="addireport" data-toggle="modal" data-target="#medReportModal" class="btn btn-primary addireport"><i class="fa fa-plus"></i> &nbsp; Add Medical Report</button>   
                                        </div>
                                        <div class="col-md-8">
                                            <textarea class="form-control" id="note" name="note" placeholder="Note"></textarea>
                                        </div>
                                </div><br><br>
                                <div class="row">
                                    <div class="col-md-12 pull-right" >
                                        <button type="button" id="canPrescriptionBtn" class="btn btn-warning pull-right"><i class="fa fa-remove"></i> &nbsp; Cancel</button>
                                        <button type="submit" id="submitbtn" class="btn btn-success pull-right" style="margin-right:10px"><i class="fa fa-check"></i> &nbsp; <span id="sbtn">Save</span></button>
                                    </div>
                                </div>
                            </form>
                        </div> 

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="medReportModal" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Edit-Heading">Add Medical Report</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('labels')['title'];?></label>
                                <input type="text" class="form-control" name="title" id="mr_title" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('labels')['description'];?></label>
                                <textarea class="form-control" name="description" id="mr_description"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning pull-right">Cancel</button>
                    <button type="button" data-dismiss="modal" id="addMRBtn" class="btn btn-success pull-right" style="margin-right:10px">Add</button>
                </div>
            </div>    
        </div>
    </div>
     <!-- Modal -->
<div class="modal fade" id="AddNewNote" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Add New Note
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <form method="post" action="<?php echo site_url(); ?>/inpatient/add_note" class="form-horizontal" role="form" id="new_noteform">
                <input type="hidden" name="appt_id" value='<?php echo $appoitment['id'];?>' />
                <input type="hidden" name="hsinpatientadd_id" id="hsinpatientadd_id">
                <input type="hidden" name="hsinpatientEdit_id" id="hsinpatientEdit_id">
                  <div class="form-group">
                    <label  class="col-sm-2 control-label"
                              for="">New Note</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" 
                      name="new_note"   id="Hsnew_note" placeholder="Write Note" rows="5"></textarea>
                    </div>
                  </div>
                  <div class="form-group text-center">
                  <button  type="submit" class="btn btn-primary" >
                    <i class="glyphicon glyphicon-plus"></i> Save </button>
                   <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <i class="fa fa-remove"></i>  Cancel </button>                    
                  </div>
                </form>                  
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">                
            </div>
        </div>
    </div>
</div>

    <div class="modal fade" id="uploadMR" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
		<div class="modal-dialog modal-m">
		    <form action="<?php echo site_url(); ?>/medical_lab/uploadreport" method="post" id="form" enctype="multipart/form-data">
			    <input type="hidden" name="mrid" id="mrid">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="modal-title custom_align" id="Edit-Heading">Test Report</h4>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div class="drop-area" id="dparea">
                                <h4 class="drop-text">No Test-Report Uploaded Yet</h4>        
                            </div>
                            <div style="z-index:1000; position:fixed;top:0;bottom:0;left:0;right:0;display:none" id="loading-img">
                                <img style="margin: 0 auto;display: flow-root;background: white;margin-top: 15%;padding: 20px;" src="<?php echo base_url();?>public/images/loading.gif"  />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-defualt" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php
$this->load->view("template/footer.php");
?>
<script type="text/javascript">
    $(document).ready(function(){

        $("#saveaptr").click(function(){
            var id = $(this).data("id");
            $.post('<?php echo site_url();?>/appoitments/udpateremark', {id: id, remark: $("#apt_remark").val()}, function(data, textStatus, xhr) {
                toastr.success("Remark saved", '');  
            });
        });

        $("#addireport").click(function(){
            $("#mr_title").val("");
            $("#mr_description").val("");
        });

        $(document).on('click','.mr_remove',function(){
            $(this).parents('tr').remove();
            updateMrCnt(); 
        });

        $("#addMRBtn").click(function(){
            var tit = $("#mr_title").val();
            var des = $("#mr_description").val();
            var cnt = $("#medRepTbl").children().length;
            cnt += 1;
            var report = "<tr>";
            report += "<td style='width:20px' valign='top'><span class='mr_cnt'>"+cnt+"</span></td>";
            report += "<td style='width:20%' valign='top'><span class='mr_tit'>"+tit+"</span></td>";
            report += "<td valign='top'><span class='mr_des'>"+des+"</span></td>";
            report += '<td valign="top" style="width:10px"><a href="javascript:void(0)" class="mr_remove"><i class="fa fa-remove"></i></a></td>';
            report += "</tr>";
            $("#medRepTbl").append(report);
            updateMrCnt();
        });

        function updateMrCnt(){
            var cnts = $(".mr_cnt");
            for(var i=1; i<=cnts.length; i++){
                $(cnts[i-1]).html(i);
            }
        }
        

        var validator = $("#pre_form").validate({
            ignore: [],
            rules: {
                
                title: {
                    required : true
                },
                'drug[]':{ required : true },
                'strength[]' : { required : true },
                'dosage[]': { required : true },
                'duration[]' :{ required : true }
            },
            messages: {
                
                title:{
                    required: "<?php echo $this->lang->line('validation')['requiredTitle'];?>"
                },
                'drug[]':{
                    required: "<?php echo $this->lang->line('validation')['requiredDrug'];?>"
                },
                'strength[]':{
                    required: "<?php echo $this->lang->line('validation')['requriedStrength'];?>"
                },
                'dosage[]':{
                    required: "<?php echo $this->lang->line('validation')['requiredDosage'];?>"
                },
                'duration[]':{
                    required: "<?php echo $this->lang->line('validation')['requiredDuration'];?>"
                }
            },
            invalidHandler: validationInvalidHandler,
            errorPlacement: validationErrorPlacement
            
        });
           $('#pre_form').submit(function(event) {

            event.preventDefault(); //this will prevent the default submit
            if(validator.valid()){
                console.log("Here");
                var tits = $('.mr_tit');
                var des = $(".mr_des");
                for(var i=0; i<tits.length; i++){
                    var tin = '<input type="hidden" name="mr_tit[]" value="'+$(tits[i]).html()+'" />';
                    var din = '<input type="hidden" name="mr_des[]" value="'+$(des[i]).html()+'" />';
                    $("#pre_form").append(tin);
                    $("#pre_form").append(din);
                }
                $(this).unbind('submit').submit();
            }
            
        });
                       
                var $selectize_bed_id = $("#Patientbed").selectize({
                    valueField: "id",
                    labelField: "text",
                    searchField: "text",
                    preload:true,
                    create: false,
                    render: {
                        option: function(item, escape) {
                            return "<div><span class='title'>" +
                                    escape(item.text)+
                                "</span>" +   
                            "</div>";
                        }
                    },
                    load: function(query, callback) {
                        //if (!query.length) return callback();
                        $.ajax({
                            url: "<?php echo site_url(); ?>/beds/search",
                            type: "GET",
                            data: {"q":query,"f":"bed"},
                            error: function() {
                                callback();
                            },
                            success: function(res) {
                                callback($.parseJSON(res));
                            }
                        });
                    }
                });
        var validator = $("#patientform").validate({
            ignore: [],
            rules: {
                
                join_date:{ required : true },
                inPatientReason: { required : true }
            },
            messages: {
                
                join_date:{
                    required: "<?php echo $this->lang->line('validation')['required join date'];?>"
                },
                inPatientReason:{
                    required: "<?php echo $this->lang->line('validation')['patientreason'];?>"
                }
                
            },
            invalidHandler: validationInvalidHandler,
            errorPlacement: validationErrorPlacement
            
        });
        
        $('#patientform').submit(function(event) {

            event.preventDefault(); //this will prevent the default submit
            if(validator.valid()){
                console.log("Here");
                $(this).unbind('submit').submit();
            }
            
        });

        var validator = $("#new_noteform").validate({
            ignore: [],
            rules: {
                
                new_note: {
                    required : true
                }
            },
            messages: {                
                new_note:{
                    required: "<?php echo $this->lang->line('validation')['requiredNote'];?>"
                }                
            },
            invalidHandler: validationInvalidHandler,
            errorPlacement: validationErrorPlacement
            
        });
        
        $('#new_noteform').submit(function(event) {

            event.preventDefault(); //this will prevent the default submit
            if(validator.valid()){
                console.log("Here");
                $(this).unbind('submit').submit();
            }
            
        }); 

        function disableFields(){
            $("#tabDiv input").prop("disabled", true);
            $("#tabDiv textarea").prop("disabled", true);
            $("#tabDiv select").prop("disabled", true);

        }

        function enableFields(){
            $("#tabDiv input").prop("disabled", false);
            $("#tabDiv textarea").prop("disabled", false);
            $("#tabDiv select").prop("disabled", false);

            $("#health_insurance_provider").prop("disabled", true);
            $("#health_insurance_id").prop("disabled", true);
        }

        disableFields();

        function saveData(){
            $("#form").submit();
        }

        $('a[data-toggle="tab"]').on('shown.bs.tab',function(e){
            var target = $(e.target).attr('href');
            updateTabshow(target);
        });

        function updateTabshow(target){
            if(target == "#tab1"){
                $("#cancelBtn").hide();
                $("#add_noteBtn").hide();
                $("#canPatientBtnHist").hide();    
            }else if(target == "#tab2"){
                $("#cancelBtn").hide();
                $("#add_noteBtn").hide();
                $("#canPatientBtnHist").hide();
            }else if(target == "#tab3"){
                $("#cancelBtn").hide();
                $("#add_noteBtn").hide();
                $("#canPatientBtnHist").hide();
            }
        }

        $('#canPatientBtnHist').click(function(){
          $('#canPatientBtnHist').hide();
          $('#add_noteBtn').hide();
          $('#inPatientTblHistoryDiv').hide();
          $('#inPatientTblDiv').show();
          $('#inPatientBtn').show();
        });

     $(document).on('click','.editinpatient',function(){
        var id = $(this).data('id');
        $('#inpatient_id').val(id);
            $("#inPatientDiv").show();   
            // $("#inPatientTbl").hide();
            $("#inPatientBtn").hide();
            $("#tabDiv").hide();
           // $("#inPatientDiv").hide(); 
            $("#div_title").html('Edit Inpatient');       
            $("#inpatient_update").html("Update");
            $.ajax({
                            url: "<?php echo site_url(); ?>/inpatient/getinpatient/",
                            type: "POST",
                            data: {id:id},
                            error: function() {
                                callback();
                            },
                            success: function(res) {
                                console.log(res);
                                var inpatient_data = $.parseJSON(res);

                                var tempselectize_bed_ID = $selectize_bed_id[0].selectize;
                                tempselectize_bed_ID.addOption([{"id":inpatient_data.bed_id,"text":inpatient_data.bed_id}]);
                                tempselectize_bed_ID.refreshItems();
                                tempselectize_bed_ID.setValue(inpatient_data.bed_id);
                                 $('#datepicker').val(inpatient_data.join_date);
                                 $('#ptStatus').val(inpatient_data.status);
                                 $('#patient_reason').val(inpatient_data.reason);
                             //   callback($.parseJSON(res));
                            }
                        });

     });

     $(document).on('click','.historyinpatient',function(){
               var patient_id= $(this).data('id');
               $('#hsinpatientadd_id').val(patient_id);
               var bed_no = $(this).data('bno');
               var hs_jdate = $(this).data('jdate');
               var hs_status = $(this).data('status');
               var hs_reason = $(this).data('reason');
               var ldate= $(this).data('ldate');
                console.log($(this).data('bno'));
                $('#bed_no').text(bed_no);
                $('#jdate').text(hs_jdate);
                $('#hs_status').text(hs_status);
                $('#hs_reason').text(hs_reason);
                $('#hs_ldate').text(ldate);
              $('#inPatientTblDiv').hide();
              $('#canPatientBtnHist').show();
              $('#inPatientBtn').hide();
              $("#add_noteBtn").show();
              $('#inPatientTblHistoryDiv').show();
              $("#inPatientTblHistory").dataTable().fnDestroy();
                $('#inPatientTblHistory').DataTable({ 
                "processing": true,
                "serverSide": true,
                "paging":   true,
                "ordering": false,
                "info":     false,
                "ajax": {
                "url":'<?php echo site_url();?>/inpatient/getDTHistoryinpatient/'+patient_id,
                   }              
            });
                $("#inPatientTblHistory_filter").hide();
                $("#inPatientTblHistory_length").hide(); 

       });
    $(document).on('click','.editinpatientHistory',function(){
         var inpHisEdit_id = $(this).data('id');
         var inpHisEdit_note = $(this).data('note');
         $('#hsinpatientEdit_id').val(inpHisEdit_id);
         $('#Hsnew_note').val(inpHisEdit_note);
    }); 
        $("#canPrescriptionBtn").click(function(){
            $("#tabDiv").show();
            $("#preDiv").hide();

            $("#div_title").html("<?php echo $this->lang->line('patientInfo');?>");
        });
        $('#add_noteBtn').click(function(){
         $("form").trigger("reset");
        });
        $("#canPatientBtn").click(function(){
            // $("#inPatientBtn").show();
            $("#tabDiv").show();
            $("#inPatientDiv").hide();
            $("#div_title").html("<?php echo $this->lang->line('newPatient');?>");
        });

        $(document).on('click','.additemrow',function(){
            addNewItemRow();
        });

        
        $(document).on('click','.removeitemrow',function(){
            if($(this).data("id") == undefined){
                $(this).parents('tr').remove();
                updateDrugNo();
            }else{
                var link = $(this);
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this item!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes",
                    closeOnConfirm: true
                },
                function(){
                    $.post('<?php echo site_url();?>/po/deletePOItem', {id: $(link).data('id')}, function(data, textStatus, xhr) {
                        $(link).parents('tr').remove();
                        updateDrugNo();
                    });
                });
            }   
        });


        function updateDrugNo(){
            var all = $(".drug_nos");
            for(var i=1; i<=all.length; i++){
                //$(all[i-1]).html(i);
                $("#pnum_"+i).html(i);
            }
        }

        $("#prescriptionTbl").DataTable({
            "processing": true,
            "serverSide": true,
            "paging":   true,
            "ordering": false,
            "info":     false,
            "ajax": '<?php echo site_url();?>/nurse/getDTPrescription/'+"<?php echo $appoitment['id'];?>"
        });
        $("#prescriptionTbl_filter").hide();
        $("#prescriptionTbl_length").hide();

        $("#reportTbl").DataTable({
            "processing": true,
            "serverSide": true,
            "paging":   true,
            "ordering": false,
            "info":     false,
            "ajax": '<?php echo site_url();?>/nurse/getDTPReports/'+"<?php echo $appoitment['id'];?>"
        });
        $("#reportTbl_filter").hide();
        $("#reportTbl_length").hide();

        $("#inPatientTbl").DataTable({
            "processing": true,
            "serverSide": true,
            "paging":   true,
            "ordering": false,
            "info":     false,
            "ajax": '<?php echo site_url();?>/inpatient/getDTPatientinpatient/'+"<?php echo $profile['id'];?>"
        });
        $("#inPatientTbl_filter").hide();
        $("#inPatientTbl_length").hide();



        $(document).on('click','.btnup',function(){
            var current_id = $(this).data('id');
            var url = '<?php echo site_url();?>/medical_lab/getreportspreview/'+current_id;
            $("#loading-img").show();
            $.get(url,function(data){ 
                showImages(data);
            });
        });

        function showImages(data){
            data = $.parseJSON(data);
            $("#loading-img").hide();
            $("#dparea").html('<h4 class="drop-text">No Test-Report Uploaded Yet</h4>');
            var imgList= "<div style='display:flex'>";
            if(data.length == 0)
                return;

            $.each(data, function () {
                imgList += '<div id="imgdiv_'+this.id+'" style="margin:0 auto"><img src= "' + this.url + '" /><div style="text-align:center"><a style="font-size:20px" href="javascript:void(0)" onclick="window.open(\''+this.url+'\');return false;"><i class="fa fa-download"></i></a></div></div>';
            });
            imgList += "</div>";
            $("#dparea").html(imgList);
        }

    });
</script>