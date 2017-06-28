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
                            $img = $profile['profile_photo'];
                        }
                    ?>
                    <img src="<?php echo $img;?>" alt="" style="width:200px;height:auto;padding-left:10px">
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
                                                <input value="<?php echo $profile['first_name'];?>" class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['fname'];?>" name="first_name" id="first_name" />
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('labels')['lname'];?></label>
                                                <input value="<?php echo $profile['last_name'];?>" class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['lname'];?>" name="last_name" id="last_name" />
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['aboutMe'];?></label>
                                            <textarea class="form-control" rows="5"  placeholder="<?php echo $this->lang->line('labels')['aboutMePlaceholder'];?>" name="description" id="description"><?php echo $profile['description'];?></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['aadharNumber'];?></label>
                                            <input value="<?php echo $profile['aadhaar_number'];?>" class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['aadharNumber'];?>" name="aadhaar_number" id="aadhaar_number" />
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
                                            <select class="form-control " name="gender" id="gender" />

                                                <option <?php if($profile['gender']=="M") { echo "selected";}?>  value="M"><?php echo $this->lang->line('labels')['male'];?></option>
                                                <option <?php if($profile['gender']=="F") { echo "selected";}?> value="F"><?php echo $this->lang->line('labels')['female'];?></option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['dob'];?></label>
                                            <input value="<?php echo date("d-m-Y",strtotime($profile['date_of_birth']));?>" class="form-control date-picker" type="text" placeholder="<?php echo $this->lang->line('labels')['dob'];?>" name="date_of_birth" id="date_of_birth" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['address'];?></label>
                                            <input value="<?php echo $profile['address'];?>" class="form-control" type="text" placeholder="<?php echo $this->lang->line('labels')['address'];?>" name="address" id="address" />
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['alternateNumber'];?></label>
                                            <input value="<?php echo $profile['alternate_mobile_number'];?>" class="form-control" type="text" placeholder="<?php echo $this->lang->line('labels')['alternateNumber'];?>" name="alternate_mobile_number" id="alternate_mobile_number" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group col-md-3">
                                            <label><?php echo $this->lang->line('labels')['selectCountry'];?></label>
                                            <select name="country"  id="country" class=" form-control" style="width: 100%"></select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label><?php echo $this->lang->line('labels')['selectState'];?></label>
                                            <select name="state"  id="state" class=" form-control" style="width: 100%"></select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label><?php echo $this->lang->line('labels')['selectDistrict'];?></label>
                                            <select name="district"  id="district" class=" form-control" style="width: 100%"></select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label><?php echo $this->lang->line('labels')['selectCity'];?></label>
                                            <select name="city"  id="city" class=" form-control" style="width: 100%"></select>
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
                                                            <input type="file" accept="image/png, image/jpeg" name="profile_photo" id="profile_photo" />
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
                                            <div>
                                                <div class="form-group col-md-6">
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
                                                <div class="form-group  col-md-6" >
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
                                            <div>
                                            <div class="col-md-6">
                                                <?php $hb =$profile['high_blood_pressure'];
                                                    if($hb == 0){
                                                        $hb = "";
                                                    }
                                                ?>
                                                <input value="<?php echo $hb;?>" class="form-control" type="text" placeholder="<?php echo $this->lang->line('labels')['highBloodPressure'];?>" name="high_blood_pressure" id="high_blood_pressure" />
                                            </div>
                                            <div class="col-md-6">
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
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
$this->load->view("template/footer.php");
?>
<script type="text/javascript">
    $(document).ready(function(){

        <?php
            $this->load->view("template/location");
        ?>

        var country = "<?php echo $profile['country'];?>";

        if(country != null && country!=undefined && country != "" && country > 0){
            loc_cid = "<?php echo $profile['city'];?>";
            loc_did = "<?php echo $profile['district'];?>";
            loc_sid = "<?php echo $profile['state'];?>";
            var tempselectize_selectize_country = $selectize_country[0].selectize;
            tempselectize_selectize_country.addOption([{"id":country,"text":country}]);
            tempselectize_selectize_country.refreshItems();
            tempselectize_selectize_country.setValue(country);
        }
        shwoImgFromUrl("<?php echo $profile['profile_photo'];?>");
        
        $("#editBtn").click(function(){
            toggleEditButton();
        });

        $("#cancelBtn").click(function(){
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
                saveData();
                $("#cancelBtn").hide();
                
            }else{
                $(eb).data('isEdit','1');
                $(eb).removeClass('btn-primary');
                $(eb).addClass('btn-success');
                $(eb).html('Save');
                enableFields();
                $("#cancelBtn").show();
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
    });
</script>