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
                                        <td style='width:30%' align="right" valign="top"><strong><?php echo $this->lang->line('appointment#');?></strong></td>
                                        <td style="width:2%">&nbsp;</td>
                                        <td style='width:69%' align="left" valign="center"><?php echo $appoitment['appoitment_number'];?></td>
                                    </tr>
                                    <tr>
                                        <td style='width:30%' align="right" valign="top"><strong><?php echo $this->lang->line('appointment_date');?></strong></td>
                                        <td style="width:2%">&nbsp;</td>
                                        <td style='width:69%' align="left" valign="center"><?php echo date('d-M-Y',strtotime($appoitment['appoitment_date']));?></td>
                                    </tr>
                                    <tr>
                                        <td style='width:30%' align="right"><strong><?php echo $this->lang->line('appointment_sloat');?></strong></td>
                                        <td style="width:2%">&nbsp;</td>
                                        <td style='width:69%' align="left"><?php echo date('h:i A',strtotime($appoitment['appoitment_time_start'])).' to '.date('h:i A',strtotime($appoitment['appoitment_time_end']));?></td>
                                    </tr>
                                    <tr>
                                        <td style='width:30%' align="right"><strong><?php echo $this->lang->line('appointment_reason');?></strong></td>
                                        <td style="width:2%">&nbsp;</td>
                                        <td style='width:69%' align="left"><?php echo $appoitment['reason'];?></td>
                                    </tr>
                                    <tr>
                                        <td style='width:30%' align="right"><strong><?php echo $this->lang->line('appointment_status');?></strong></td>
                                        <td style="width:2%">&nbsp;</td>
                                        <td style='width:69%' align="left"><?php echo $this->auth->getAppoitmentStatus($appoitment['status']);?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
								<div class="row">
									<div class="form-group col-md-12">
										<label for="input-Default" class="control-label"><?php echo $this->lang->line('labels')['remarks'];?></label>
									</div>
								</div>
                                <div class="row">
									<div class="col-md-8">
										<div class="form-group">
											<textarea class="form-control" id="apt_remark" placeholder="<?php echo $this->lang->line('labels')['patientRecordRemark'];?>" <?php if($appoitment['status'] == 3) { echo "disabled"; } ?>><?php echo $appoitment['remarks'];?></textarea>
										</div>
									</div>	
									<div class="col-md-4">
										<div class="form-group">
										<label>&nbsp;</label>
										<?php if($appoitment['status'] != 3) { ?>
										<button class="btn btn-success pull-" data-id="<?php echo $appoitment['id'];?>" id="saveaptr">Save</button>
										<?php } ?>
										</div>
									</div>	
								</div>
								<form method="post" action="<?php echo site_url(); ?>/doctors/recommendnextdate">
								<input type="hidden" name="appointment_id" value="<?php echo $appoitment['id'];?>" />
								<input type="hidden" name="user_id" value="<?php echo $appoitment['user_id'];?>" />
								<input type="hidden" name="department_id" value="<?php echo $appoitment['department_id'];?>" />
								<input type="hidden" name="doctor_id" value="<?php echo $appoitment['doctor_id'];?>" />
								<div class="row">
									<div class="form-group col-md-12">
										<label for="RecommendDate"><?php echo $this->lang->line('recommend_date'); ?></label>
									</div>
								</div>
								<div class="row">
									<div class="col-md-8">
										<div class="form-group">
											<input type="text" class="form-control date-picker" name="recommend_date" placeholder="<?php echo $this->lang->line('addRecommendDate'); ?>" >
										</div>
									</div>
									<div class="col-md-4">
										<label>&nbsp;</label>
										<?php //if($appoitment['status'] != 3) { ?>
										<button class="btn btn-info pull-"  type="submit"><?php echo $this->lang->line('recommend');?></button>
										<?php //} ?>
									</div>
								</div>
								</form>
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
                            $img = $profile['profile_photo']."?t=".time();
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
                                    <a class="btn btn-primary m-b-sm " id="editBtn" data-toggle="tooltip" href="javascript:void(0);" ><?php echo $this->lang->line('buttons')['edit'];?></a>
                                    <a class="btn btn-success m-b-sm " style="display:none" id="addPrescriptionBtn" data-toggle="tooltip" href="javascript:void(0);" ><?php echo $this->lang->line('buttons')['newPrescription'];?></a>
                                    <a class="btn btn-success m-b-sm " style="display:none" id="inPatientBtn" data-toggle="tooltip" href="javascript:void(0);" ><?php echo $this->lang->line('buttons')['newpatient'];?></a>
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
                                 <li role="presentation" class=""><a href="#tab4" aria-controls="home" role="tab" data-toggle="tab"><?php echo $this->lang->line('labels')['inpatient_records'];?></a></li>
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
                                              <h4><?php echo $this->lang->line('labels')['bed'];?> :  <small id="bed_no"></small></h4>
                                              <h4><?php echo $this->lang->line('labels')['join_date'];?> :  <small id="jdate"></small></h4>
                                              <h4><?php echo $this->lang->line('labels')['status'];?> :  <small id="hs_status"></small></h4>
                                              <h4><?php echo $this->lang->line('labels')['reason'];?> :  <small id="hs_reason"></small></h4>
                                              <h4><?php echo $this->lang->line('labels')['left_date'];?> :  <small id="hs_ldate"></small></h4>
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
                                            <input type="text" class="form-control date-time-picker" name="join_date" id="join_date">
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="PatientStatus"><?php echo $this->lang->line('labels')['patientStatus']; ?></label>
                                            <select class="form-control" name="ptStatus" id="ptStatus">
                                                <option selected value="0"><?php echo $this->lang->line('not_admitted'); ?></option>
                                                <option value="1"><?php echo $this->lang->line('admitted'); ?></option>
                                                <option value="2"><?php echo $this->lang->line('discharged'); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="PatientReason"><?php echo $this->lang->line('labels')['reason']; ?></label>
                                            <textarea class="form-control"  rows="6" name="inPatientReason" id="patient_reason"></textarea>
                                        </div><br>
                                        <div class="form-group">
                                            <button type="button" id="canPatientBtn" class="btn btn-warning pull-right"><i class="fa fa-remove" ></i>Cancel</button>
                                            <button type="submit" class="btn btn-success pull-right" name="inpatient_up_form" id="inpatient_update" style="margin-right: 10px"><i class="fa fa-check"></i> Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                        </div>         

                        <div class="row" id="preDiv" style="display:none">
                            <lable class="control-label" ><h3 style="font-weight:bold;margin-left:20px"><?php echo $this->lang->line('addNewPrescription');?></h3></label><br>
                            <form action="<?php echo site_url();?>/doctors/newprescription" method="post" id="pre_form">
                                <input type="hidden" name="edit_id" id="edit_id" value='' />
                                <input type="hidden" name="appt_id" value='<?php echo $appoitment['id'];?>' />
                                <input type="hidden" name="patient_id" id="patient_id" value="<?php echo $profile['id'];?>" />
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        
                                        <div class="form-group col-md-6">
                                            <label for="input-Default" class="col-sm4 control-label"><?php echo $this->lang->line('tableHeaders')['prescriptionFor'];?></label>
                                            <div class="8">
                                                <input class="form-control  " type="text" id="title" name="title" placeholder="<?php echo $this->lang->line('tableHeaders')['prescriptionFor'];?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="input-Default" class="col-s-4 control-label"><?php echo $this->lang->line('tableHeaders')['date'];?></label>
                                            <div class="">
                                                <input class="form-control  date-picker" type="text" id="date" name="date" disabled placeholder="Date"  value="<?php echo date('d-m-Y');?>" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <lable class="control-label"><h4><?php echo $this->lang->line('prescriptionForMedicines');?></h4></label><br>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?php echo $this->lang->line('drug');?></th>
                                                <th><?php echo $this->lang->line('strength');?></th>
                                                <th><?php echo $this->lang->line('dosage');?></th>
                                                <th><?php echo $this->lang->line('duration');?></th>
                                                <th><?php echo $this->lang->line('quantity');?></th>
                                                <th><?php echo $this->lang->line('note');?></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody">
                                            <tr data-row="1" id="row_1">
                                                <td class='drug_nos'>
                                                    <input type="hidden" name="item_id[]" name="item_id[]" id="item_id_1"></input>1
                                                </td>
                                                <td>
                                                    <input type="text" data-row="1" name="drug[]" value="" class="form-control" id="drug_1"></input>
                                                </td>
                                                <td>
                                                    <input type="text" data-row="1" name="strength[]" value="" class="form-control" id="strength_1"></input>
                                                </td>
                                                <td>
                                                    <input type="text" data-row="1" name="dosage[]" value="" class="form-control dosage" id="dosage_1" placeholder="1-0-1"></input>
                                                </td>
                                                <td>
                                                    <input type="text" data-row="1" name="duration[]" value="" class="form-control" id="duration_1" placeholder="30 Days"></input>
                                                </td>
                                                <td>
                                                    <input type="text" data-row="1" name="quantity[]" value="" class="form-control" id="quantity_1" placeholder="1"></input>
                                                </td>
                                                <td>
                                                    <input type="text" data-row="1" name="note[]" value="" class="form-control" id="note_1" placeholder="After Food" />
                                                </td>
                                                <td>
                                                    <button type="button" id="remove_id_1" data-len="1" class="btn removeitemrow"><i class="fa fa-minus"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="button" id="item_btn_1" class="btn additemrow pull-right" style=""><i class="fa fa-plus"></i> &nbsp; Add Another Item</button>   
                                </div> 
                                <Br><br>
                                <div class="col-md-12" id="medReportDiv">
                                    <lable class="control-label" ><h4><?php echo $this->lang->line('prescriptionForMedicalTests');?></h4></label><br>
                                    <table width="100%" id="medRepTbl" class="table table-bordered">
										<thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?php echo $this->lang->line('tableHeaders')['title'];?></th>
                                                <th><?php echo $this->lang->line('tableHeaders')['description'];?></th>
                                                <th></th>
                                            </tr>
                                        </thead>
										<tbody>
                                        </tbody>
                                    </table>
                                <div>
                                <Br><br>
                                <div class="row">
									<div class="col-md-12">
										<button type="button" id="addireport" data-toggle="modal" data-target="#medReportModal" class="btn btn-primary addireport pull-right" style="margin:-45px 0px 45px 0px;"><i class="fa fa-plus"></i> &nbsp; <?php echo $this->lang->line('buttons')['add_medical_report'];?></button>   
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<textarea class="form-control" id="note" name="note" placeholder="<?php echo $this->lang->line('additional_note');?>"></textarea>
									</div>
                                </div><br><br>
                                <div class="row">
                                    <div class="col-md-12 pull-right" >
                                        <button type="button" id="canPrescriptionBtn" class="btn btn-warning pull-right"><i class="fa fa-remove"></i> &nbsp; <?php echo $this->lang->line('buttons')['cancel'];?></button>
                                        <button type="submit" id="submitbtn" class="btn btn-success pull-right" style="margin-right:10px"><i class="fa fa-check"></i> &nbsp; <span id="sbtn"><?php echo $this->lang->line('buttons')['save'];?></span></button>
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
        <div class="modal-dialog modal-sm" style="width:325px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Edit-Heading"><?php echo $this->lang->line('add_medical_report');?></h4>
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
                    <button type="button" data-dismiss="modal" class="btn btn-warning pull-right"><?php echo $this->lang->line('buttons')['cancel'];?></button>
                    <button type="button" data-dismiss="modal" id="addMRBtn" class="btn btn-success pull-right" style="margin-right:10px"><?php echo $this->lang->line('buttons')['add'];?></button>
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
                       <span class="sr-only"><?php echo $this->lang->line('buttons')['close'];?></span>
                </button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('add_new_note');?></h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <form method="post" action="<?php echo site_url(); ?>/inpatient/add_note" class="form-horizontal" role="form" id="new_noteform">
                <input type="hidden" name="appt_id" value='<?php echo $appoitment['id'];?>' />
                <input type="hidden" name="hsinpatientadd_id" id="hsinpatientadd_id">
                <input type="hidden" name="hsinpatientEdit_id" id="hsinpatientEdit_id">
                  <div class="form-group">
                    <label  class="col-sm-2 control-label" for=""><?php echo $this->lang->line('new_note');?></label>
                    <div class="col-sm-10">
                    <textarea class="form-control" 
                      name="new_note"   id="Hsnew_note" placeholder="Write Note" rows="5"></textarea>
                    </div>
                  </div>
                  <div class="form-group text-center">
                  <button  type="submit" class="btn btn-primary" >
                    <i class="glyphicon glyphicon-plus"></i> <?php echo $this->lang->line('buttons')['save'];?> </button>
                   <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <i class="fa fa-remove"></i>  <?php echo $this->lang->line('buttons')['cancel'];?> </button>                    
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
                        <h4 class="modal-title custom_align" id="Edit-Heading">Test Report<?php echo $this->lang->line('new_note');?></h4>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div class="drop-area" id="dparea">
                                <h4 class="drop-text"><?php echo $this->lang->line('no_test_report_uploaded_yet');?></h4>        
                            </div>
                            <div style="z-index:1000; position:fixed;top:0;bottom:0;left:0;right:0;display:none" id="loading-img">
                                <img style="margin: 0 auto;display: flow-root;background: white;margin-top: 15%;padding: 20px;" src="<?php echo base_url();?>public/images/loading.gif"  />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-defualt" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel');?></button>
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
			if(tit!="" && des !=""){				
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
			}else{
				toastr.error('Please add title and discription');
			}
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
                'duration[]' :{ required : true },
                'quantity[]' :{ required : true }
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
                },
                'quantity[]':{
                    required: "<?php echo $this->lang->line('validation')['requiredQuantity'];?>"
                } 
            },
            invalidHandler: validationInvalidHandler,
            errorPlacement: validationErrorPlacement
            
        });
           $('#pre_form').submit(function(event) {

            event.preventDefault(); //this will prevent the default submit
            
            if($(this).valid()){
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

        var inPatientFormvalidator = $("#patientform").validate({
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
            if(inPatientFormvalidator.valid()){
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

        var isEdit = false;
        var gotoP = 0;
        gotoP = '<?php if(isset($_GET["p"]) && $_GET["p"]==1){ echo 1;}else{ echo 0;} ?>';
        gotoP = '<?php if(isset($_GET["p"]) && $_GET["p"]==2){ echo 2;}else{ echo 0;} ?>';
        if(gotoP == 1){
            $('#tabDiv a[href="#tab2"]').click();
            updateTabshow('#tab2');
        }
        else if(gotoP == 2){
            $('#tabDiv a[href="#tab4"]').click();
            updateTabshow('#tab4');
        }

        $("#editBtn").click(function(){
            toggleEditButton();
        });

        $("#cancelBtn").click(function(){
            isEdit = false;
             var eb = $("#editBtn");
            $("#cancelBtn").hide();
            disableFields();
            $(eb).data('isEdit','0');
            $(eb).addClass('btn-primary');
            $(eb).removeClass('btn-success');
            $(eb).html('Edit');
            disableFields();
        });

        function toggleEditButton(){
            var eb = $("#editBtn");
            if($(eb).data('isEdit') == "1"){
                isEdit = false;
                saveData();
                $("#cancelBtn").hide();
            }else{
                isEdit = true;
                $(eb).data('isEdit','1');
                $(eb).removeClass('btn-primary');
                $(eb).addClass('btn-success');
                $(eb).html('Save');
                enableFields();
                $("#cancelBtn").show();
            }
        }

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
                $("#editBtn").show();
                $("#inPatientBtn").hide();
                $("#cancelBtn").hide();
                $("#add_noteBtn").hide();
                $("#addPrescriptionBtn").hide();
                $("#canPatientBtnHist").hide();    
            }else if(target == "#tab2"){
                $("#inPatientBtn").hide();
                $("#editBtn").hide();
                $("#cancelBtn").hide();
                $("#add_noteBtn").hide();
                $("#addPrescriptionBtn").show();
                $("#canPatientBtnHist").hide();
            }else if(target == "#tab3"){
                $("#editBtn").hide();
                $("#inPatientBtn").hide();
                $("#cancelBtn").hide();
                $("#add_noteBtn").hide();
                $("#addPrescriptionBtn").hide();
                $("#canPatientBtnHist").hide();
            }else if(target == "#tab4"){
                $("#editBtn").hide();
                $("#cancelBtn").hide();
                $("#addPrescriptionBtn").hide();
                $("#inPatientBtn").show();
                $("#inPatientTblDiv").show();
                $("#inPatientTblHistoryDiv").hide();
                $("#canPatientBtnHist").hide();
            }
        }

        $("#addPrescriptionBtn").click(function(){
            $("#addPrescriptionBtn").hide();
            $("#tabDiv").hide();
            $("#preDiv").show();
            $("#date").val(moment().format("DD-MM-YYYY"));
            $("#title").val("");
            $("#edit_id").val("");
            $("#tbody").html("");
            $("#sbtn").html("Save");
            //addNewItemRow();
            $("#div_title").html("<?php echo $this->lang->line('newPrescription');?>");
        });
        $("#inPatientBtn").click(function(){
            $("#inPatientBtn").hide();
            $("#addPrescriptionBtn").hide();
            $("#tabDiv").hide();
            $("#inPatientDiv").show();
          //   $("#datepicker").val(moment().format("DD-MM-YYYY"));
            // $("#title").val("");
            // $("#edit_id").val("");
            // $("#tbody").html("");
          //  $("#sbtn").html("Save");
           // addNewItemRow();
            $("#div_title").html("<?php echo $this->lang->line('newinPatient');?>");
        });
        $('#canPatientBtnHist').click(function(){
          $('#canPatientBtnHist').hide();
          $('#add_noteBtn').hide();
          $('#inPatientTblHistoryDiv').hide();
          $('#inPatientTblDiv').show();
          $('#inPatientBtn').show();
        });

        $(document).on('click','.editbtn1', function(){
            var id = $(this).data('id');            
            $("#edit_id").val(id);
            $.get('<?php echo site_url();?>/doctors/getprescription/'+id,{}, function(data) {
                $("#addPrescriptionBtn").hide();
                $("#tabDiv").hide();
                $("#preDiv").show();
                $("#sbtn").html("Update");

                $("#div_title").html("<?php echo $this->lang->line('newPrescription');?>");
                data = JSON.parse(data);
                
                $("#date").val(data.date);
                $("#title").val(data.title);
                $("#note").val(data.note);
                
                $("#tbody").html("");
                
                for(var i=1; i<=data.items.length; i++){
                    var item = data.items[i-1];
                    addNewItemRow();
                    $("#drug_"+i).val(item.drug);
                    $("#strength_"+i).val(item.strength);
                    $("#dosage_"+i).val(item.dosage);
                    $("#duration_"+i).val(item.duration);
                    $("#quantity"+i).val(item.qty);
                    $("#note_"+i).val(item.note);
                    $("#item_id_"+i).val(item.id);
                }

                if(data.reports!=undefined){
                    var cnt =1;
                    for(var i=0; i<data.reports.length; i++){
                        var _rep = data.reports[i];
                        var report = "<tr>";
                        report += "<td style='width:20px' valign='top'><span class='mr_cnt'>"+cnt+"</span></td>";
                        report += "<td style='width:20%' valign='top'><span class='mr_tit'>"+_rep.title+"</span></td>";
                        report += "<td valign='top'><span class='mr_des'>"+_rep.description+"</span>";
                        for(var j=0; j<_rep.files.length; j++){
                            var f = _rep.files[j];
                            report += "<br>";
                            report += "<span><a data-fancybox='gallery' title='Report - "+(j+1)+"' href='"+f.file_url+"'>Report - "+(j+1)+"</a></span><br><br>";
                        }
                        report += "</td>";
                        report += '<td valign="top" style="width:10px"></td>';
                        report += "</tr>";
                        $("#medRepTbl").append(report);
                        cnt++;
                    }
                    updateMrCnt();  
                }
            });
        });
        $(document).on('click','.editinpatient',function(){
            var id = $(this).data('id');
            $('#inpatient_id').val(id);
            $("#inPatientDiv").show();   

            $("#inPatientBtn").hide();
            $("#tabDiv").hide();

            $("#div_title").html('Edit Inpatient');       
            $("#inpatient_update").html("Update");
            $.ajax({
                url: "<?php echo site_url(); ?>/inpatient/getinpatient/",
                type: "POST",
                data: {id:id},
                success: function(res) {
                    var inpatient_data = $.parseJSON(res);

                    var tempselectize_bed_ID = $selectize_bed_id[0].selectize;
                    tempselectize_bed_ID.addOption([{"id":inpatient_data.bed_id,"text":inpatient_data.bed_id}]);
                    tempselectize_bed_ID.refreshItems();
                    tempselectize_bed_ID.setValue(inpatient_data.bed_id);
                    $('#join_date').val(inpatient_data.join_date);
                    //$('#join_date').datepicker('setDate',inpatient_data.join_date);

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
            //console.log($(this).data('bno'));
            $('#bed_no').text(bed_no);
            $('#jdate').text(hs_jdate);
            $('#hs_status').text(hs_status);
            $('#hs_reason').text(hs_reason);
            $('#hs_ldate').text(ldate);
                //row.find(".historyinpatient").hide();
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
            $("#addPrescriptionBtn").show();
            $("#tabDiv").show();
            $("#preDiv").hide();

            $("#div_title").html("<?php echo $this->lang->line('patientInfo');?>");
        });
        $('#add_noteBtn').click(function(){
         $("form").trigger("reset");
        });
        $("#canPatientBtn").click(function(){
            $("#inPatientBtn").show();
            $("#tabDiv").show();
            $("#inPatientDiv").hide();
            $("#div_title").html("<?php echo $this->lang->line('newPatient');?>");
        });

        $(document).on('click','.additemrow',function(){
            addNewItemRow();
        });

        function addNewItemRow(){
            $("#tbody").append(getRow());
            $(".dosage").inputmask("*{+}-*{+}-*{+}");
            updateDrugNo();
        }
        
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

        function getRow() {
            var length = $("#tbody").children().length;
            length += 1;
            var tr = "";
            tr = '<tr id="row_'+length+'">';
            tr += '<td class="drug_nos"><input type="hidden" name="item_id[]" name="item_id[]" id="item_id_'+length+'"></input><span id="pnum_'+length+'">'+length+'</span></td>';
            tr += '<td><input type="text" data-row="'+length+'" name="drug[]" value="" class="form-control" id="drug_'+length+'"></input></td>';
            tr += '<td><input type="text" data-row="'+length+'" name="strength[]" value="" class="form-control" id="strength_'+length+'"></input></td>';
            tr += '<td><input type="text" data-row="'+length+'" name="dosage[]" value="" class="form-control dosage" id="dosage_'+length+'" placeholder="1-0-1"></input></td>';
            tr += '<td><input type="text" data-row="'+length+'" name="duration[]" value="" class="form-control" id="duration_'+length+'" placeholder="30 Days"></input></td>';
            tr += '<td><input type="text" data-row="'+length+'" name="quantity[]" value="" class="form-control" id="quantity_'+length+'" placeholder="1"></input></td>';
            tr += '<td><input type="text" data-row="'+length+'" name="note[]" value="" class="form-control" id="note_'+length+'" placeholder="After Food" /></td>';
            tr += '<td><button type="button" id="remove_id_'+length+'" data-len="'+length+'" class="btn removeitemrow"><i class="fa fa-minus"></i></button></td>';
            tr += '</tr>';
            return tr;
        }

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
            "ajax": '<?php echo site_url();?>/doctors/getDTPrescription/'+"<?php echo $profile['id'];?>"
        });
        $("#prescriptionTbl_filter").hide();
        $("#prescriptionTbl_length").hide();

        $("#reportTbl").DataTable({
            "processing": true,
            "serverSide": true,
            "paging":   true,
            "ordering": false,
            "info":     false,
            "ajax": '<?php echo site_url();?>/medical_lab/getDTPReports/'+"<?php echo $profile['id'];?>"
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