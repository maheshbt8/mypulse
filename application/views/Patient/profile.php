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
                                <h3 class="panel-title panel_heading_custome"><?php echo $this->lang->line('patientInfo');?></h3>
                            </div>
                            <div class="custome_col4">
                                <div class="panel_button_top_right">
                                    <a class="btn btn-primary m-b-sm " id="editBtn" data-toggle="tooltip" href="javascript:void(0);" ><?php echo $this->lang->line('buttons')['edit'];?></a>
                                    <a class="btn btn-default m-b-sm " id="cancelBtn" data-toggle="tooltip" style="display:none" href="javascript:void(0);" ><?php echo $this->lang->line('buttons')['cancel'];?></a>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                    <div class="panel-body" id="profileBody">
                        <div role="tabpanel">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#tab1" aria-controls="home" role="tab" data-toggle="tab"><?php echo $this->lang->line('labels')['basic'];?></a></li>
                                <li role="presentation"><a href="#tab2" aria-controls="profile" role="tab" data-toggle="tab"><?php echo $this->lang->line('labels')['otherProfile'];?></a></li>
                                <li role="presentation"><a href="#tab3" aria-controls="messages" role="tab" data-toggle="tab"><?php echo $this->lang->line('labels')['healthInfo'];?></a></li>
                                <li role="presentation"><a href="#tab4"  aria-controls="home" role="tab" data-toggle="tab"><?php echo $this->lang->line('labels')['prescription'];?></a></li>
                                <li role="presentation"><a href="#tab5" aria-controls="home" role="tab" data-toggle="tab"><?php echo $this->lang->line('labels')['health_records'];?></a></li>
                            </ul>
                            <!-- Tab panes -->
                            <form action="<?php echo site_url(); ?>/patients/updatemyprofile" method="post" id="form" enctype="multipart/form-data">
                            <input type="hidden" name="eidt_gf_id" value="<?php echo $profile['id'];?>" />
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="tab1">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('labels')['fname'];?></label>
                                                <input data-ori="<?php echo $profile['first_name'];?>" value="<?php echo $profile['first_name'];?>" class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['fname'];?>" name="first_name" id="first_name" />
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('labels')['lname'];?></label>
                                                <input data-ori="<?php echo $profile['last_name'];?>" value="<?php echo $profile['last_name'];?>" class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['lname'];?>" name="last_name" id="last_name" />
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['aboutMe'];?></label>
                                            <textarea data-ori="<?php echo $profile['description'];?>" class="form-control" rows="5"  placeholder="<?php echo $this->lang->line('labels')['aboutMePlaceholder'];?>" name="description" id="description"><?php echo $profile['description'];?></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['aadharNumber'];?></label>
                                            <input data-ori="<?php echo $profile['aadhaar_number'];?>" value="<?php echo $profile['aadhaar_number'];?>" class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['aadharNumber'];?>" name="aadhaar_number" id="aadhaar_number" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['mobile'];?></label>
                                            <input value="<?php echo $profile['mobile'];?>" class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['mobile'];?>" name="mobile" id="mobile" />
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['email'];?></label>
                                            <input value="<?php echo $profile['useremail'];?>" class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['email'];?>"  id="useremail" />
                                        </div>
                                        <!--<div class="form-group col-md-6">
                                            <label><?php //echo $this->lang->line('labels')['password'];?></label>
                                            <input class="form-control" type="text" placeholder="<?php //echo $this->lang->line('labels')['password'];?>" name="password" id="password" />
                                            <span id="passwordhint" style="display: none"><?php //echo $this->lang->line('labels')['passwordHind'];?></span>
                                        </div>-->
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="tab2">
                                    <div class="col-md-12">
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['gender'];?></label>
                                            <select class="form-control " name="gender" id="gender" data-ori="<?php echo $profile['gender'];?>" />
                                                <option  value=""></option>
                                                <option <?php if($profile['gender']=="M") { echo "selected";}?>  value="M"><?php echo $this->lang->line('labels')['male'];?></option>
                                                <option <?php if($profile['gender']=="F") { echo "selected";}?> value="F"><?php echo $this->lang->line('labels')['female'];?></option>
                                                <option <?php if($profile['gender']=="O") { echo "selected";}?> value="O"><?php echo $this->lang->line('labels')['other'];?></option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['dob'];?></label>
                                            <?php
                                                $dob = "";
                                                if($profile['date_of_birth'] != '0000-00-00') {
                                                    $dob = date("d-m-Y",strtotime($profile['date_of_birth']));
                                                }
                                            ?>
                                            <input data-ori="<?php echo $dob;?>" value="<?php echo $dob;?>" class="form-control date-picker" type="text" placeholder="<?php echo $this->lang->line('labels')['dob'];?>" name="date_of_birth" id="date_of_birth" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['address'];?></label>
                                            <input data-ori="<?php echo $profile['address'];?>" value="<?php echo $profile['address'];?>" class="form-control" type="text" placeholder="<?php echo $this->lang->line('labels')['address'];?>" name="address" id="address" />
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['alternateNumber'];?></label>
                                            <input data-ori="<?php echo $profile['alternate_mobile_number'];?>" value="<?php echo $profile['alternate_mobile_number'];?>" class="form-control" type="text" placeholder="<?php echo $this->lang->line('labels')['alternateNumber'];?>" name="alternate_mobile_number" id="alternate_mobile_number" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group col-md-3">
                                            <label><?php echo $this->lang->line('labels')['selectCountry'];?></label>
                                            <select  data-ori="<?php echo $profile['country'];?>" name="country"  id="country" class=" form-control" style="width: 100%"></select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label><?php echo $this->lang->line('labels')['selectState'];?></label>
                                            <select  data-ori="<?php echo $profile['state'];?>" name="state"  id="state" class=" form-control" style="width: 100%"></select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label><?php echo $this->lang->line('labels')['selectDistrict'];?></label>
                                            <select  data-ori="<?php echo $profile['district'];?>" name="district"  id="district" class=" form-control" style="width: 100%"></select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label><?php echo $this->lang->line('labels')['selectCity'];?></label>
                                            <select data-ori="<?php echo $profile['city'];?>" name="city"  id="city" class=" form-control" style="width: 100%"></select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group  col-md-12">
                                            <label for="input-Default" class="col-sm-4 control-label"><?php echo $this->lang->line('labels')['profilePic'];?></label>
                                            <div class="col-sm-8">
                                                <div class=" input-group image-preview">
                                                    <input type="text" class="form-control image-preview-filename" id="prephoto" disabled="disabled"> 
                                                    <span class="input-group-btn">
                                                        <!-- image-preview-clear button -->
                                                        <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                                            <span class="glyphicon glyphicon-remove"></span> <?php echo $this->lang->line('labels')['clear'];?>
                                                        </button>
                                                        <!-- image-preview-input -->
                                                        <div class="btn btn-default image-preview-input">
                                                            <span class="glyphicon glyphicon-folder-open"></span>
                                                            <span class="image-preview-input-title"><?php echo $this->lang->line('labels')['browse'];?></span>
                                                            <input data-ori="<?php echo $profile['profile_photo'];?>" type="file" accept="image/png, image/jpeg" name="profile_photo" id="profile_photo" />
                                                        </div>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="tab3">
                                    <div class="col-md-12">
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['selectBloodGroup'];?></label>
                                            <select class="form-control" name="blood_group" id="blood_group" data-ori="<?php echo $profile['blood_group'];?>">
                                                <option <?php if($profile['blood_group']=="OPVE") { echo "selected";}?> value="OPVE">O +</option>
                                                <option <?php if($profile['blood_group']=="ONVE") { echo "selected";}?> value="ONVE">O -</option>
                                                <option <?php if($profile['blood_group']=="APVE") { echo "selected";}?> value="APVE">A +</option>
                                                <option <?php if($profile['blood_group']=="ANVE") { echo "selected";}?> value="ANVE">A -</option>
                                                <option <?php if($profile['blood_group']=="BPVE") { echo "selected";}?> value="BPVE">B +</option>
                                                <option <?php if($profile['blood_group']=="BNVE") { echo "selected";}?> value="BNVE">B -</option>
                                                <option <?php if($profile['blood_group']=="ABPVE") { echo "selected";}?> value="ABPVE">AB +</option>
                                                <option <?php if($profile['blood_group']=="ABNVE") { echo "selected";}?> value="ABNVE">AB -</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['height'];?></label>
                                            <div>
                                                <div class="form-group col-md-6">
                                                    <!--<label><?php //echo $this->lang->line('labels')['selectHeightFt'];?></label>-->
                                                    <select class="form-control" name="height_feet" id="height_feet" data-ori="<?php echo $profile['height_feet'];?>">
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
                                                <div class="form-group  col-md-6" >
                                                    <!--<label><?php //echo $this->lang->line('labels')['selectHeightIc'];?></label>-->
                                                    <select class="form-control" name="height_inch" id="height_inch" data-ori="<?php echo $profile['height_inch'];?>">
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
                                            <input value="<?php echo $profile['weight'];?>" class="form-control" type="text" placeholder="<?php echo $this->lang->line('labels')['weight'];?>" name="weight" id="weight" data-ori="<?php echo $profile['weight'];?>" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['bloodPressure'];?></label>
                                            <div>
                                            <div class="col-md-6">
                                                <?php $hb =$profile['high_blood_pressure'];
                                                    if($hb == 0){
                                                        $hb = "";
                                                    }
                                                ?>
                                                <input value="<?php echo $hb;?>" class="form-control" type="text" placeholder="<?php echo $this->lang->line('labels')['highBloodPressure'];?>" name="high_blood_pressure" id="high_blood_pressure" data-ori="<?php echo $profile['high_blood_pressure'];?>" />
                                            </div>
                                            <div class="col-md-6">
                                                <?php $lb =$profile['low_blood_pressure'];
                                                    if($lb == 0){
                                                        $lb = "";
                                                    }
                                                ?>
                                                <input value="<?php echo $lb;?>" class="form-control" type="text" placeholder="<?php echo $this->lang->line('labels')['lowBloodPressure'];?>" name="low_blood_pressure" id="low_blood_pressure" data-ori="<?php echo $profile['low_blood_pressure'];?>" />
                                            </div>
                                            </div>  
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['sugarLevel'];?></label>
                                            <input value="<?php echo $profile['sugar_level'];?>" class="form-control" type="text" placeholder="<?php echo $this->lang->line('labels')['sugarLevel'];?>" name="sugar_level" id="sugar_level" data-ori="<?php echo $profile['sugar_level'];?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">    
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['selectHealthInsuranceProvider'];?></label>
                                            <select class="form-control"   name="health_insurance_provider" id="health_insurance_provider" data-ori="<?php echo $profile['health_insurance_provider'];?>" >
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
                                            <input value="<?php echo $profile['health_insurance_id'];?>" class="form-control" type="text" placeholder="<?php echo $this->lang->line('labels')['healthInsuranceId'];?>" name="health_insurance_id" id="health_insurance_id" data-ori="<?php echo $profile['health_insurance_id'];?>" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['familyHistory'];?></label>
                                            <textarea data-ori="<?php echo $profile['family_history'];?>" class="form-control" placeholder="<?php echo $this->lang->line('labels')['familyHistoryPlaceholder'];?>" id="family_history" name="family_history" ><?php echo $profile['family_history'];?></textarea>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['pastMedicalHistory'];?></label>
                                            <textarea data-ori="<?php echo $profile['past_medical_history'];?>" class="form-control" placeholder="<?php echo $this->lang->line('labels')['pastMedicalHistoryPlaceholder'];?>" id="past_medical_history" name="past_medical_history" ><?php echo $profile['past_medical_history'];?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane " id="tab4">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table id="prescriptionTbl" class="display table" cellspacing="0" width="100%">
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
                                <div role="tabpanel" class="tab-pane" id="tab5">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table id="reportTbl" class="display table" cellspacing="0" width="100%">
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
                            </div>
                            </form>
                        </div>
                    </div>
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

    <div class="modal fade" id="uploadReceipt" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
		<div class="modal-dialog modal-m">
		    <form action="<?php echo site_url(); ?>/medical_lab/uploadreceipt" method="post" id="form" enctype="multipart/form-data">
			    
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="modal-title custom_align" id="Edit-Heading">Receipt</h4>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div class="drop-area" id="dparea-receipt">
                                <h4 class="drop-text">No Receipt Uploaded Yet</h4>        
                            </div>
                            <div style="z-index:1000; position:fixed;top:0;bottom:0;left:0;right:0;display:none" id="loading-img-receipt">
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

        var loc_sid = null;
        var loc_did = null;
        var loc_cid = null; 
        var isEdit = false;

        var xhr_1;

        

        var $selectize_city = $("#city").selectize({
            valueField: "id",
            labelField: "name",
            searchField: "name",
            preload:true,
            create: false,
            render: {
                option: function(item, escape) {
                    return "<div><span class='title'>" +
                            escape(item.name)+
                        "</span>" +   
                    "</div>";
                }
            },
            load: function(query, callback) {
                if (!query.length) return callback(); 

                var did = $("#district").val();

                $.ajax({
                    url: "<?php echo site_url(); ?>/general/getCities",
                    type: "GET",
                    data: {"q":query,"did":did},
                    error: function() {
                        callback();
                    },
                    success: function(res) {
                        callback($.parseJSON(res));
                    }
                });
            },
            onChange: function(value) {
                if (!value.length) return;
            }
        });

        var $selectize_district = $("#district").selectize({
            valueField: "id",
            labelField: "name",
            searchField: "name",
            preload:true,
            create: false,
            render: {
                option: function(item, escape) {
                    return "<div><span class='title'>" +
                            escape(item.name)+
                        "</span>" +   
                    "</div>";
                }
            },
            load: function(query, callback) {
                if (!query.length) return callback(); 

                var sid = $("#state").val();

                $.ajax({
                    url: "<?php echo site_url(); ?>/general/getDistricts",
                    type: "GET",
                    data: {"q":query,"sid":sid},
                    error: function() {
                        callback();
                    },
                    success: function(res) {
                        callback($.parseJSON(res));
                    }
                });
            },
            onChange: function(value) {
                if (!value.length) return;

                $selectize_city[0].selectize.disable();
                $selectize_city[0].selectize.clearOptions();
                $selectize_city[0].selectize.load(function(callback) {
                    xhr_1 && xhr_1.abort();
                    xhr_1 = $.ajax({
                        url: "<?php echo site_url(); ?>/general/getCities/",
                        type: "GET",
                        data: {"did":value},
                        success: function(results) {
                            
                            var res = $.parseJSON(results);
                            callback(res);
                            if(loc_cid != null){
                                var tempselectize_city = $selectize_city[0].selectize;
                                tempselectize_city.addOption([{"id":loc_cid,"text":loc_cid}]);
                                tempselectize_city.refreshItems();
                                tempselectize_city.setValue(loc_cid);	
                                loc_cid = null;
                            }

                            if(isEdit){
                                $selectize_city[0].selectize.enable();
                            }else{
                                $selectize_city[0].selectize.disable();
                            }
                        },
                        error: function() {
                            callback();
                        }
                    })
                });
            }
        });

        var $selectize_state = $("#state").selectize({
            valueField: "id",
            labelField: "name",
            searchField: "name",
            preload:true,
            create: false,
            render: {
                option: function(item, escape) {
                    return "<div><span class='title'>" +
                            escape(item.name)+
                        "</span>" +   
                    "</div>";
                }
            },
            onChange: function(value) {
                if (!value.length) return;

                $selectize_district[0].selectize.disable();
                $selectize_district[0].selectize.clearOptions();
                $selectize_district[0].selectize.load(function(callback) {
                    xhr_1 && xhr_1.abort();
                    xhr_1 = $.ajax({
                        url: "<?php echo site_url(); ?>/general/getDistricts/",
                        type: "GET",
                        data: {"sid":value},
                        success: function(results) {
                            
                            var res = $.parseJSON(results);
                            callback(res);
                            if(loc_did != null){
                                var tempselectize_district = $selectize_district[0].selectize;
                                tempselectize_district.addOption([{"id":loc_sid,"text":loc_did}]);
                                tempselectize_district.refreshItems();
                                tempselectize_district.setValue(loc_did);	
                                loc_did = null;
                            }
                            if(isEdit){
                                $selectize_district[0].selectize.enable();
                            }else{
                                $selectize_district[0].selectize.disable();
                            }
                        },
                        error: function() {
                            callback();
                        }
                    })
                });
            }
        });

        $selectize_state[0].selectize.disable();
        $selectize_district[0].selectize.disable();
        $selectize_city[0].selectize.disable();
        
        var $selectize_country = $("#country").selectize({
            valueField: "id",
            labelField: "name",
            searchField: "name",
            preload:true,
            create: false,
            render: {
                option: function(item, escape) {
                    return "<div><span class='title'>" +
                            escape(item.name)+
                        "</span>" +   
                    "</div>";
                }
            },
            load: function(query, callback) {
                $.ajax({
                    url: "<?php echo site_url(); ?>/general/getCountries",
                    type: "GET",
                    data: {"q":query},
                    error: function() {
                        callback();
                    },
                    success: function(res) {
                        callback($.parseJSON(res));
                    }
                });
            },
            onChange: function(value) {
                if (!value.length) return;

                $selectize_state[0].selectize.disable();
                $selectize_state[0].selectize.clearOptions();
                $selectize_state[0].selectize.load(function(callback) {
                    xhr_1 && xhr_1.abort();
                    xhr_1 = $.ajax({
                        url: "<?php echo site_url(); ?>/general/getStates/",
                        type: "GET",
                        data: {"cid":value},
                        success: function(results) {
                           
                            var res = $.parseJSON(results);
                            callback(res);
                            if(loc_sid != null){
                                var tempselectize_state = $selectize_state[0].selectize;
                                tempselectize_state.addOption([{"id":loc_sid,"text":loc_sid}]);
                                tempselectize_state.refreshItems();
                                tempselectize_state.setValue(loc_sid);	
                                loc_sid = null;
                            }
                            if(isEdit){
                                $selectize_state[0].selectize.enable();
                            }else{
                                $selectize_state[0].selectize.disable();
                            }
                        },
                        error: function() {
                            callback();
                        }
                    })
                });
            }
        });

        function resetLocation(){
            $selectize_city[0].selectize.clearOptions();
            $selectize_state[0].selectize.clearOptions();
            $selectize_district[0].selectize.clearOptions();
            $selectize_country[0].selectize.clear();
        }

        var country = "<?php echo $profile['country'];?>";
        var country_name = '<?php echo trim(preg_replace("/\s\s+/", " ", $profile["country_name"]));?>';
        if(country != null && country!=undefined && country != "" && country > 0){
            loc_cid = "<?php echo $profile['city'];?>";
            loc_did = "<?php echo $profile['district'];?>";
            loc_sid = "<?php echo $profile['state'];?>";
            var tempselectize_selectize_country = $selectize_country[0].selectize;
            tempselectize_selectize_country.addOption([{"id":country,"name":country_name}]);
            tempselectize_selectize_country.refreshItems();
            tempselectize_selectize_country.setValue(country);
        }
        $selectize_country[0].selectize.disable();
        shwoImgFromUrl("<?php echo $profile['profile_photo'];?>");
        
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
            resetForm();
        });

        function toggleEditButton(){
            var eb = $("#editBtn");
            if($(eb).data('isEdit') == "1"){
                isEdit = false;
                saveData();
                $("#cancelBtn").hide();
                $('.image-preview-clear').attr('disabled',true);
            }else{
                isEdit = true;
                $(eb).data('isEdit','1');
                $(eb).removeClass('btn-primary');
                $(eb).addClass('btn-success');
                $(eb).html('Save');
                enableFields();
                $("#cancelBtn").show();
                $('.image-preview-clear').attr('disabled',false);
            }
        }

        function disableFields(){
            $("#profileBody input").prop("disabled", true);
            $("#profileBody textarea").prop("disabled", true);
            $("#profileBody select").prop("disabled", true);

            $selectize_city[0].selectize.disable();
            $selectize_state[0].selectize.disable();
            $selectize_district[0].selectize.disable();
            $selectize_country[0].selectize.disable();

            //$("#passwordhint").hide();
        }

        function enableFields(){
            $("#profileBody input").prop("disabled", false);
            $("#profileBody textarea").prop("disabled", false);
            $("#profileBody select").prop("disabled", false);

            $selectize_city[0].selectize.enable();
            $selectize_state[0].selectize.enable();
            $selectize_district[0].selectize.enable();
            $selectize_country[0].selectize.enable();
            //$("#passwordhint").show();
            $("#useremail").prop("disabled",true);
            $("#mobile").prop("disabled",true);
        }

        disableFields();

        function saveData(){
            $("#form").submit();
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

        $(document).on('click','.btnup',function(){
            var current_id = $(this).data('id');
            var url = '<?php echo site_url();?>/medical_lab/getreportspreview/'+current_id;
            $("#loading-img").show();
            $.get(url,function(data){ 
                showImages(data);
            });
        });

        $(document).on('click','.btnup_receipt',function(){
            var current_id = $(this).data('id');
            var url = '<?php echo site_url();?>/medical_store/getreceiptpreview/'+current_id;
            $("#loading-img-receipt").show();
            $.get(url,function(data){ 
                showReceipt(data);
            });
        });

        function resetForm(){
            $("#form input[type=text]").each(function() {
                if($(this).data('ori') != undefined){
                    $(this).val($(this).data('ori'));
                }
            });

            $("#form textarea").each(function() {
                if($(this).data('ori') != undefined){
                    $(this).val($(this).data('ori'));
                }
                $(this).attr('disabled',true);
            });

            $("#form select").each(function() {
                if($(this).data('ori') != undefined){
                    $(this).val($(this).data('ori'));
                }
            });

            $("#date_of_birth").datepicker('setDate',$("#date_of_birth").data('ori'));
            loc_sid = $("#state").data('ori');
            loc_did = $("#district").data('ori');
            loc_cid = $("#city").data('ori');

            var tempselectize_selectize_country = $selectize_country[0].selectize;
            tempselectize_selectize_country.addOption([{"id":$("#country").data('ori'),"name":$("#country").data('ori')}]);
            tempselectize_selectize_country.refreshItems();
            tempselectize_selectize_country.setValue($("#country").data('ori'));
            isEdit = false;
            shwoImgFromUrl($("#profile_photo").data('ori'));
        }

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

        

        function showReceipt(data){
            data = $.parseJSON(data);
            $("#loading-img-receipt").hide();
            $("#dparea-receipt").html('<h4 class="drop-text">No Receipt Uploaded Yet</h4>');
            var imgList= "<div style='display:flex'>";
            if(data.length == 0)
                return;

            $.each(data, function () {
                imgList += '<div id="imgdiv_'+this.id+'" style="margin:0 auto"><img src= "' + this.url + '" /><div style="text-align:center"><a style="font-size:20px" href="javascript:void(0)" onclick="window.open(\''+this.url+'\');return false;"><i class="fa fa-download"></i></a></div></div>';
            });
            imgList += "</div>";
            $("#dparea-receipt").html(imgList);
        }

    });
</script>