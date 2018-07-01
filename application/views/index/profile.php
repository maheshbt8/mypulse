<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
$this->load->view("template/header.php");
$this->load->view("template/left.php");
?>
<link href="<?php echo base_url();?>public/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css"/> 
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
					$name .= isset($profile['MiddleName']) ? $profile['MiddleName'] : "";
                    $name .= isset($profile['last_name']) ? " ".$profile['last_name'] : "";
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
                                <?php
                                $showHA = "display:none";
                                $showDoc= "display:none";
                                $showNur= "display:none";
                                $showRep= "display:none";
                                if($this->auth->isHospitalAdmin() || $this->auth->isMedicalStore() || $this->auth->isMedicalLab() || $this->auth->isDoctor() || $this->auth->isNurse() || $this->auth->isReceptinest()){
                                    $showHA = "";
                                }
                                if($this->auth->isDoctor()){
                                    $showDoc = "";
                                }
                                if($this->auth->isNurse()){
                                    $showNur = "";
                                }
                                if($this->auth->isReceptinest()){
                                    $showRep = "";
                                }
                                ?>
                                <li style="<?php echo $showHA;?>" role="presentation"><a href="#tab4" aria-controls="ha" role="tab" data-toggle="tab"><?php echo $this->lang->line('labels')['hospitalAssociation'];?></a></li>

                                <li style="<?php echo $showDoc;?>" role="presentation"><a href="#tab_doc" aria-controls="doc" role="tab" data-toggle="tab"><?php echo $this->lang->line('labels')['other'];?></a></li>
                                <li style="<?php echo $showNur;?>" role="presentation"><a href="#tab_nur" aria-controls="nur" role="tab" data-toggle="tab"><?php echo $this->lang->line('labels')['other'];?></a></li>
                                <li style="<?php echo $showRep;?>" role="presentation"><a href="#tab_rep" aria-controls="rep" role="tab" data-toggle="tab"><?php echo $this->lang->line('labels')['other'];?></a></li>
                                
                            </ul>
                            <!-- Tab panes -->
                            <form action="<?php echo site_url(); ?>/index/updateprofile" method="post" id="form" enctype="multipart/form-data">
                            <input type="hidden" name="eidt_gf_id" value="<?php echo $profile['id'];?>" />
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="tab1">
                                    <div class="col-md-12">
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('labels')['fname'];?></label>
                                                <input data-ori="<?php echo $profile['first_name'];?>" value="<?php echo $profile['first_name'];?>" class="textinputfields " type="text" placeholder="<?php echo $this->lang->line('labels')['fname'];?>"  name="first_name" id="first_name" />
                                            </div>
											<div class="">
                                                <label><?php echo $this->lang->line('labels')['lname'];?></label>
                                                <input data-ori="<?php echo $profile['last_name'];?>" value="<?php echo $profile['last_name'];?>" class="textinputfields " type="text" placeholder="<?php echo $this->lang->line('labels')['lname'];?>" name="last_name" id="last_name" />
                                            </div>
                                            
                                        </div>
                                        <div class="form-group col-md-6">
										   <div class="form-group ">
                                                <label><?php echo $this->lang->line('labels')['mname'];?></label>
                                                <input data-ori="<?php echo $profile['MiddleName'];?>" value="<?php echo $profile['MiddleName'];?>" class="textinputfields " type="text" placeholder="<?php echo $this->lang->line('labels')['mname'];?>" name="middle_name" id="middle_name" />
                                            </div>
										   
											<div class="">
                                            <label><?php echo $this->lang->line('labels')['aboutMe'];?></label>
                                            <textarea class="form-control" rows="5" data-ori="<?php echo $profile['description'];?>"  placeholder="<?php echo $this->lang->line('labels')['aboutMePlaceholder'];?>" name="description" id="description" style="width: 310px;"><?php echo $profile['description'];?></textarea>
											</div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        
										<div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['email'];?></label>
											<span class="<?php if($profile['EmailVerified']==1){echo "verifiedsuccess";}else{echo "notverified";} ?>">
											<?php if($profile['EmailVerified']==1){echo "Email Verified";}else{echo "Email Not Verified";} ?>
											  </span>
                                            <input value="<?php echo $profile['useremail'];?>" class="textinputmobilefields " type="text" placeholder="<?php echo $this->lang->line('labels')['email'];?>"  id="useremail" name="EmailID" />
											
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['mobile'];?></label>
											<span class="<?php if($profile['MobileVerified']==1){echo "verifiedsuccess";}else{echo "notverified";} ?>">
											<?php if($profile['MobileVerified']==1){echo "Mobile Verified";}else{echo "Mobile Not Verified";} ?></span>
											<?php if($profile['MobileVerified'] !=1){ ?>
											<!--<a href="javascript:void(0);" class="regsubmitform"></a>-->
											<button class="sendotp" type="button">Send OTP</button> 
											<?php }?>
                                            <input value="<?php echo $profile['mobile'];?>" class="textinputmobilefields " type="text" placeholder="<?php echo $this->lang->line('labels')['mobile'];?>" name="mobile" id="mobile" />
											
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <label><?php echo $this->lang->line('labels')['aadharNumber'];?></label>
                                            <input data-ori="<?php echo $profile['aadhaar_number'];?>" value="<?php echo $profile['aadhaar_number'];?>" class="textinputfields " type="text" placeholder="<?php echo $this->lang->line('labels')['aadharNumber'];?>" name="aadhaar_number" id="aadhaar_number" />
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
                                            <select class="form-control wid75 " name="gender" id="gender" data-ori="<?php echo $profile['gender'];?>" />
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
                                            <input data-ori="<?php echo $dob;?>" value="<?php echo $dob;?>" class="textinputfields date-picker" type="text" placeholder="<?php echo $this->lang->line('labels')['dob'];?>" name="date_of_birth" id="date_of_birth" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['address'];?></label>
                                            <input data-ori="<?php echo $profile['address'];?>" value="<?php echo $profile['address'];?>" class="textinputfields" type="text" placeholder="<?php echo $this->lang->line('labels')['address'];?>" name="address" id="address" />
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['alternateNumber'];?></label>
                                            <input data-ori="<?php echo $profile['alternate_mobile_number'];?>" value="<?php echo $profile['alternate_mobile_number'];?>" class="textinputfields" type="text" placeholder="<?php echo $this->lang->line('labels')['alternateNumber'];?>" name="alternate_mobile_number" id="alternate_mobile_number" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['selectCountry'];?></label>
                                            <select data-ori="<?php echo $profile['country'];?>" name="country"  id="country" class="form-control wid75" ></select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['selectState'];?></label>
                                            <select data-ori="<?php echo $profile['state'];?>" name="state"  id="state" class="form-control wid75"></select>
                                        </div>
                                        
                                    </div>
									<div class="col-md-12">
									<div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['selectDistrict'];?></label>
                                            <select data-ori="<?php echo $profile['district'];?>" name="district"  id="district" class=" form-control wid75" ></select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['selectCity'];?></label>
                                            <select data-ori="<?php echo $profile['city'];?>" name="city"  id="city" class="form-control wid75" ></select>
                                        </div>
									</div>
                                    <div class="col-md-12">
                                        <div class="form-group  col-md-12">
                                            <label for="input-Default" class="col-sm-4 control-label"><?php echo $this->lang->line('labels')['profilePic'];?></label>
                                            <div class="col-sm-8">
                                                <div class=" input-group image-preview">
                                                    <input type="text" class="textinputfields image-preview-filename" id="prephoto" disabled="disabled"> 
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
                                <div role="tabpanel" class="tab-pane" id="tab_doc">
                                    <?php if($this->auth->isDoctor()) { ?>
                                    <div class="col-md-12">
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['qualification'];?></label>
                                            <input class="textinputfields" type="text" placeholder="<?php echo $this->lang->line('labels')['qualification'];?>" name="qualification" id="qualification" data-ori="<?php echo $data['qualification']; ?>" value="<?php echo $data['qualification']; ?>" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['experience'];?></label>
                                            <input class="textinputfields" type="text" placeholder="<?php echo $this->lang->line('labels')['experience'];?>" name="experience" id="experience" data-ori="<?php echo $data['experience']; ?>" value="<?php echo $data['experience']; ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['specilization'];?></label>
                                            <input class="textinputfields" type="text" placeholder="<?php echo $this->lang->line('labels')['specilization'];?>" name="specialization" id="specialization" data-ori="<?php echo $data['specialization']; ?>" value="<?php echo $data['specialization']; ?>" />
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="tab_nur">
                                    <?php if($this->auth->isNurse()) { ?>
                                        <div class="col-md-12">
                                            <div class="form-group col-md-6">
                                                <label><?php echo $this->lang->line('labels')['qualification'];?></label>
                                                <input class="textinputfields" type="text" placeholder="<?php echo $this->lang->line('labels')['qualification'];?>" name="qualification" id="qualification" data-ori="<?php echo $data['qualification']; ?>" value="<?php echo $data['qualification']; ?>" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label><?php echo $this->lang->line('labels')['experience'];?></label>
                                                <input class="textinputfields" type="text" placeholder="<?php echo $this->lang->line('labels')['experience'];?>" name="experience" id="experience" data-ori="<?php echo $data['experience']; ?>" value="<?php echo $data['experience']; ?>"/>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="tab_rep">
                                    <?php if($this->auth->isReceptinest()) { ?>
                                        <div class="col-md-12">
                                            <div class="form-group col-md-6">
                                                <label><?php echo $this->lang->line('labels')['qualification'];?></label>
                                                <input class="textinputfields" type="text" placeholder="<?php echo $this->lang->line('labels')['qualification'];?>" name="qualification" id="qualification" data-ori="<?php echo $data['qualification']; ?>" value="<?php echo $data['qualification']; ?>" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label><?php echo $this->lang->line('labels')['experience'];?></label>
                                                <input class="textinputfields" type="text" placeholder="<?php echo $this->lang->line('labels')['experience'];?>" name="experience" id="experience" data-ori="<?php echo $data['experience']; ?>" value="<?php echo $data['experience']; ?>"/>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="tab4">
                                    <div class="col-md-12">
									<div class="col-md-12">
                                        
										<div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['hospital'];?></label>
											<input value="<?php echo isset($data['hospital_name']) ? $data['hospital_name'] : "";?>" class="textinputfields " type="text"  />
											
                                        </div>
										<?php if(!$this->auth->isHospitalAdmin()){ ?>
										<div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['branch'];?></label>
                                            <input value="<?php echo isset($data['branch_name']) ? $data['branch_name'] : "";?>" class="textinputfields " type="text" />
											
                                        </div>
                                        
                                        <?php } ?>
                                        
                                    </div>
									 
									 <div class="col-md-12">
                                        <?php if(!$this->auth->isHospitalAdmin()){ ?>
										<?php if(!$this->auth->isMedicalLab() && !$this->auth->isMedicalStore()){?>
										<div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['department'];?></label>
                                            <input value="<?php echo isset($data['department_name']) ? $data['department_name'] : "";?>" class="textinputfields " type="text" />
											
                                        </div>
										
										<?php if($this->auth->isReceptinest()){ ?>
										<div class="form-group col-md-6">
                                            <label><?php echo $this->lang->line('labels')['doctor'];?></label>
                                            <input value="<?php echo isset($data['doctor_name']) ? $data['doctor_name'] : "";?>" class="textinputfields " type="text" />
											
                                        </div>
										<?php } ?>
                                        <?php  } } ?>
                                        
                                        
                                    </div>
                                        <?php /*?><div class="form-horizontal">
                                            <div class="form-group">
                                                <label for="input-Default" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['hospital'];?> : </label>
                                                <label class="col-sm-8 " style="padding-top:7px; font-weight: 500"><?php echo isset($data['hospital_name']) ? $data['hospital_name'] : "";?></label>
                                            </div>
                                            <?php if(!$this->auth->isHospitalAdmin()){
                                                ?>
                                                <div class="form-group">
                                                    <label for="input-Default" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['branch'];?> : </label>
                                                    <label class="col-sm-8 " style="padding-top:7px; font-weight: 500"><?php echo isset($data['branch_name']) ? $data['branch_name'] : "";?></label>
                                                </div>
                                                <?php if(!$this->auth->isMedicalLab() && !$this->auth->isMedicalStore()){?>
                                                    <div class="form-group">
                                                        <label for="input-Default" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['department'];?> : </label>
                                                        <label class="col-sm-8 " style="padding-top:7px; font-weight: 500"><?php echo isset($data['department_name']) ? $data['department_name'] : "";?></label>
                                                    </div>
                                                    <?php if($this->auth->isReceptinest()){ ?>
                                                        <div class="form-group">
                                                            <label for="input-Default" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['doctor'];?> : </label>
                                                            <label class="col-sm-8 " style="padding-top:7px; font-weight: 500"><?php echo isset($data['doctor_name']) ? $data['doctor_name'] : "";?></label>
                                                        </div>
                                                    <?php
                                                    } ?>
                                                <?php
                                                }?>
                                                <?php
                                            }?>

                                        </div><?php */?>
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
	<div class="modal fade" id="otpverificationModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
          <h4 class="modal-title">Enter OTP</h4>
        </div>
        <div class="modal-body">
			<input type="hidden" name="hid_otpid" class="hid_otpid" value="">
			<input type="hidden" name="txt_mobile" class="txt_mobile" readonly="">
		  <label><?php echo $this->lang->line('register_otp_msg'); ?></label>&nbsp;&nbsp;<label class="usergivenmobilenumber"></label>&nbsp;<label><?php echo $this->lang->line('register_otp_msg1'); ?></label>
          <p><label>OTP Number</label><input type="text" name="txt_votp" class="txt_votp"></p>
		</div>
        <div class="modal-footer">
		<button type="text" class="chkverify_otp btn btn-success">Submit</button>
		  <button type="text" class="btn btn-danger regcancel">Cancel</button>
          <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        </div>
      </div>
      
    </div>
  </div>
<?php
$this->load->view("template/footer.php");
?>

<script type="text/javascript">
    $(document).ready(function(){
        
		toastr.options = {
			  "positionClass": "toast-bottom-right",
		}
		 
        var validator = $("#form").validate({
            ignore: [],
            rules: {
                first_name: {
                    required : true
                },
                last_name: {
                    required: true
                },
                aadhaar_number:{
                    required:true,
                    aadhaar: true
                },
            },
            messages: {
                
                first_name:{
                    required: "<?php echo $this->lang->line('validation')['requiredFname'];?>"
                },
                last_name:{
                    required: "<?php echo $this->lang->line('validation')['requiredLname'];?>"
                },
                aadhaar_number:{
                    required: "<?php echo $this->lang->line('validation')['requiredAadhar'];?>"
                }
            },
            invalidHandler: validationInvalidHandler,
            errorPlacement: validationErrorPlacement
            
        });

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
                    console.log(item);
                    return "<div><span class='title'>" +
                            escape(item.name)+
                        "</span>" +   
                    "</div>";
                }
            },
            load: function(query, callback){
                $.ajax({
                    url: "<?php echo site_url(); ?>/general/getCountries/",
                    data: { 'q': query },
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        return callback(response);
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
        }else{
            var tempselectize_selectize_country = $selectize_country[0].selectize;
            tempselectize_selectize_country.refreshItems();
        }

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
            $("#profileBody button").prop("disabled", true);

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
            $("#profileBody button").prop("disabled", false);

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
    
$('.sendotp').on('click', function(){
            
            //$('#otpverificationModal').modal('show');
			$.ajax({
						url : "<?php echo site_url(); ?>/index/sendRegisterOTPtoMobile",
						data : {'mobno' : $('input[name="mobile"]').val(),'useremail':$('input[name="EmailID"]').val(),'name':$('input[name="first_name"]').val()},
						dataType : "JSON",
						async:false,
						type : "POST",
						success : function(res){
							if(res.Status==1){
							    var mobile_num = $('input[name="mobile"]').val();
								$('.usergivenmobilenumber').text(mobile_num);
								//$('input[name="txt_mobile"]').val(mobile_num);
								$('#otpverificationModal').modal('show');
								$('input[name="hid_otpid"]').val(res.otpid);
								
							}
							
						}
					
				});
        });
		$(".sendotp").removeAttr("disabled");
		
$('.chkverify_otp').on('click', function(){
				var number = $('input[name="txt_votp"]').val();
				var itemid = $('input[name="hid_otpid"]').val();
				var staffid = $('input[name="eidt_gf_id"]').val();
								
				if(number){
					$.ajax({
						url : "<?php echo site_url(); ?>/index/verifyStaffMobile",
						data : {'StaffID' : staffid, 'otpnumber' : number, 'otpid' : itemid},
						dataType : "JSON",
						async:false,
						type : "POST",
						success : function(res){
							if(res.Status==0){
								toastr.error("Please enter valid otp");
								
							}
							else if(res.Status==1){
							    toastr.success("Verfication Done");
								$('#otpverificationModal').modal('hide');
								location.reload();
							}
							else if(res.Status==2){
								toastr.error(res.message);
								
							}
							
						}
					});
					
				}
				
            });
			
$('.regcancel').on('click', function(){
				var itemid = $('input[name="hid_otpid"]').val();
				if(itemid){
					$.ajax({
						url : "<?php echo site_url(); ?>/index/CancelRegOTP",
						data : {'otpid' : itemid},
						dataType : "JSON",
						async:false,
						type : "POST",
						success : function(res){
							if(res.Status==1){
								$('#otpverificationModal').modal('hide');
								
							}
							
							
						}
					});
					
				}
				
            });						
	
	});
</script>