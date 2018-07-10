<!DOCTYPE html>
<html>

<!-- Mirrored from www.radixtouch.in/hospital/source/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Sep 2017 12:49:50 GMT -->
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="MyPulse" />
    <meta name="author" content="techcrista.in" />
    <title><?php echo $this->config->item('title');?> </title>

    <!-- google font -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />

    <!-- icons -->
    <link href="<?php echo base_url();?>public/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

    <!-- bootstrap -->
    <link href="<?php echo base_url();?>public/assets/js/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <!-- style -->
    <link rel="stylesheet" href="<?php echo base_url();?>public/assets/css/login.css">
	<link href="<?php echo base_url();?>public/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css"/>    
    <style>
        .error{
            color:#F96A74;
        }
    </style>
	<script src="<?php echo base_url();?>public/assets/js/custom.js"></script>
</head>
<body>
<div class="form-title">
    <?php
        $_l = base_url()."public/assets/images/logo.png";
        if(isset($logo) && $logo != ""){
            $_l = $logo;
            if($isHos)
                $showPower = true;
        }else{
            $showPower = false;
        }
    ?>
    <img style="width:300px;margin-top:100px;max-height:100px" src="<?php echo $_l;?>" />
    <?php if($showPower){ ?>
    <br><span>Powered by MyPulse</span>
    <?php } ?>
</div>
<!-- Login Form-->

<div style="width: 300px; margin: 0 auto">
<?php if($this->session->flashdata('regdata')){ ?>
	
	<div class="alert alert-success alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong><?php echo $this->lang->line('mobile_verification_complete'); ?></strong>
</div>
	
	
	
 <?php } ?>
<?php
    $this->load->view('template/alert');
?>
</div>



<div class="login-form text-center">
   
    <div class="toggle" style="width:50px; height: 50px"><i class="fa fa-user-plus" style="font-size: 25px; margin-top: 10px;margin-left: 4px;"></i>
    </div>
    <div class="form formLogin">
        <h2><?php echo $this->lang->line('login_to_your_account');?></h2>
        <form id="loginform"  action="<?php echo site_url();?>/index/doLogin" method="post">
            <input type="text" placeholder="<?php echo $this->lang->line('login_mobile_email'); ?>" name="email_id" class="email_id" maxlength="50" />
            <div class="verifyaccount" style="display:none;"><a href="javascript:void(0)">verify account</a><br>
            </div>
			<input type="password" placeholder="Password" name="password" maxlength="50"/>
            <div class="remember text-left">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox2" type="checkbox" checked>
                    <label for="checkbox2"><?php echo $this->lang->line('remember_me');?></label>
                </div>
            </div>
            <button><?php echo $this->lang->line('buttons')['login'];?></button>
            <div class="forgetPassword">
			<a href="javascript:void(0);" style="color:#337ab7;"><?php echo $this->lang->line('forgot_your_password');?></a>
            </div>
            <div class="signup"><a href="javascript:void(0)"><?php echo $this->lang->line('do_not_have_account');?></a>
            </div>
        </form>
    </div>
    <div class="form formRegister">
        <h2><?php echo $this->lang->line('labels')['create_account'];?></h2>
        <form autocomplete="off" method="post" id="reg_newform" action="<?php echo site_url().'/index/doReg' ?>">
            <input type="text" name="first_name" placeholder="Name*" >
            <input type="text" name="mobile" class="mobile_number allowonlynumber" placeholder="Mobile Number*" maxlength="10" >
            <input type="email" name="useremail" class="email_check" placeholder="Email*" >
            <input type="password" id="reg_password" name="password" class="password"  placeholder="Password*" >
            <input type="password" name="re_password" placeholder="Confirm Password*" >
            <div class="remember text-left">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox3" type="checkbox" name="agrree">
                    <label for="checkbox3">
                        <a href="<?php echo base_url('index/terms_conditions'); ?>" target="_blank"><?php echo $this->lang->line('labels')['agree_terms_policy'];?></a>
					</label>
					<input id="checkbox4" type="checkbox" name="agrree">
					
                </div>
            </div>
            <div id="checkbox_err"></div>
            <button class="regsubmitform" type="button"><?php echo $this->lang->line('buttons')['register'];?></button><br/><br/>
			
             <a href="<?php echo base_url('index/privacy_policy'); ?>" target="_blank" style="text-align:right;"><?php echo $this->lang->line('labels')['privacy_policy'];?></a>
			
        </form>
    </div>
    <div class="form formReset">
        <h2><?php echo $this->lang->line('reset_password');?></h2>
        <form id="forgotform"  action="<?php echo site_url();?>/index/sendResetKey" method="post">
            <input type="email" placeholder="Email Address" name="email_id"/>
            <button><?php echo $this->lang->line('buttons')['send_verification_email'];?></button>
        </form>
    </div>
	<div class="form userVerification">
        <h2>User Verification</h2>
            <button class="sendnewotp">Send Verification OTP</button>
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
          <p>
		  <label>OTP Number : </label>
		  <input type="text" name="txt_votp" class="txt_votp">
		  <label class="showerrortext notverified"></label>
		  </p>
		</div>
        <div class="modal-footer">
		<button type="text" class="chkverify_otp btn btn-success">Submit</button>
		  <button type="text" class="btn btn-danger regcancel">Cancel</button>
          <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        </div>
      </div>
      
    </div>
  </div>



<p class="text-center m-t-xs text-sm" style="color:white"><?php echo date('Y'); ?> &copy; JagruMs Technologies.</p>

<!-- start js include path -->
<script src="<?php echo base_url();?>public/assets/js/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>public/assets/js/login.js"></script>
<script src="<?php echo base_url();?>public/assets/js/pages.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>public/plugins/toastr/toastr.min.js"></script>
<!-- end js include path -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/assets/js/bootstrap/js/bootstrap.min.js"></script>

<?php if($this->session->flashdata('regdata')){ ?>
<script type="text/javascript">
	//$('#otpModal').modal('show');
	</script>
<?php } ?>
<script type="text/javascript">
    $(document).ready(function() {
		toastr.options = {
			  "positionClass": "toast-bottom-right",
		}
		
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
								$('input[name="txt_votp"]').val("");
								$('.showerrortext').addClass('hide');
								$('.showerrortext').removeClass('show');
								
							}
							
							
						}
					});
					
				}
				
            });
		
		$('.mobile_number').on('change', function(){
				var number = $('input[name="mobile"]').val();
				if(number){
					$.ajax({
						url : "<?php echo site_url(); ?>/doctors/validateMobileNumber",
						data : {'mobnumber' : number},
						dataType : "JSON",
						async:false,
						type : "POST",
						success : function(res){
							if(res.Status==1){
								toastr.error("<?php echo $this->lang->line('validation')['takenPhone'];?>");
								$('input[name="mobile"]').val('');
							}/*else if(res.Status==0){
								toastr.error("<?php echo $this->lang->line('validation')['invalidPhone'];?>");
								$('input[name="mobile"]').val('');
							}*/
							
						}
					});
					
				}
				
            });
			
			$('.email_check').on('change', function(){
				var eval = $('input[name="useremail"]').val();
				if(eval){
					$.ajax({
						url : "<?php echo site_url(); ?>/doctors/validateEmailAvailable",
						data : {'emailval' : eval},
						dataType : "JSON",
						async:false,
						type : "POST",
						success : function(res){
							if(res.Status==1){
								toastr.error("<?php echo $this->lang->line('validation')['takenEmail'];?>");
								$('input[name="useremail"]').val('');
							}
							
						}
					});
					
				}
				
            });
		
		$('.regsubmitform').on('click', function(){
			
			if($('input[name="first_name"]').val() == ''){
				toastr.error("<?php echo $this->lang->line('validation')['requiredFname'];?>");
				return false;
			}
			if($('input[name="mobile"]').val() == ''){
				toastr.error("<?php echo $this->lang->line('validation')['requriedPhone'];?>");
				return false;
			}
			
			if(!$('input[name="mobile"]').val().match('[0-9]{10}'))  {
                toastr.error("<?php echo $this->lang->line('validation')['invalidPhone'];?>");
                return false;
            }  
			if($('input[name="useremail"]').val() == ''){
				toastr.error("<?php echo $this->lang->line('validation')['requiredEmail'];?>");
				return false;
			}
			if( !isEmail($('input[name="useremail"]').val())) { 
				toastr.error("<?php echo $this->lang->line('validation')['invalidEmail'];?>");
				return false;
			}
			if($('.password').val() == ''){
				toastr.error("<?php echo $this->lang->line('validation')['requiredPassword'];?>");
				return false;
			}
			if($('input[name="re_password"]').val() == ''){
				toastr.error("<?php echo $this->lang->line('validation')['requiredConfirmPassword'];?>");
				return false;
			}
			if($('input[name="re_password"]').val() != $('.password').val()){
				toastr.error("<?php echo $this->lang->line('validation')['passwordNotMatch'];?>");
				return false;
			}
			if (!$("#checkbox3").is(":checked")) {
				toastr.error("<?php echo $this->lang->line('validation')['requiredTermsCond'];?>");
				return false;
			}
			
			$.ajax({
						url : "<?php echo site_url(); ?>/index/sendRegisterOTPtoMobile",
						data : {'mobno' : $('input[name="mobile"]').val(),'useremail':$('input[name="useremail"]').val(),'name':$('input[name="first_name"]').val()},
						dataType : "JSON",
						async:false,
						type : "POST",
						success : function(res){
							if(res.Status==1){
							    var mobile_num = $('input[name="mobile"]').val();
								$('.usergivenmobilenumber').text(mobile_num+'.');
								//$('input[name="txt_mobile"]').val(mobile_num);
								$('#otpverificationModal').modal('show');
								$('input[name="hid_otpid"]').val(res.otpid);
								
							}
							
						}
					
				});
		});
		
		$('.chkverify_otp').on('click', function(){
				var number = $('input[name="txt_votp"]').val();
				var itemid = $('input[name="hid_otpid"]').val();
				if(number){
					$.ajax({
						url : "<?php echo site_url(); ?>/index/VerifyNewOTPNumber",
						data : {'otpnumber' : number, 'otpid' : itemid},
						dataType : "JSON",
						async:false,
						type : "POST",
						success : function(res){
							if(res.Status==0){
								//toastr.error("Please enter valid otp");
								$('.showerrortext').text('Please enter valid otp');
								$('.showerrortext').addClass('show');
								$('.showerrortext').removeClass('hide');
								
							}
							else if(res.Status==1){
								$('form#reg_newform').submit();
							}
							else if(res.Status==2){
								toastr.error(res.message);
								
							}
							
						}
					});
					
				}
				
            });
		
		$('.sendnewotp').on('click',function(){
			if($('.email_id').val()){
					
					$.ajax({
						url : "<?php echo site_url(); ?>/index/sendOTPtoMobileNumber",
						data : {'emailid' : $('.email_id').val()},
						dataType : "JSON",
						async:false,
						type : "POST",
						success : function(res){
							if(res.Status==1){
								$('#otpverificationModal').modal('show');
								$('input[name="hid_userid"]').val(res.userid);
								
							}
							
						}
					
				});
				}
			
		});
		
		
		function isEmail(email) {
			var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		return regex.test(email);
		}
		
		/*$('.email_id').on('change', function(){
				if($('.email_id').val()){
					
					$.ajax({
						url : "<?php echo site_url(); ?>/index/CheckVerifyMobileNumber",
						data : {'emailid' : $('.email_id').val()},
						dataType : "JSON",
						async:false,
						type : "POST",
						success : function(res){
							if(res.Status==0){
								$('.verifyaccount').show();
								
							}
							
						}
					
				});
				}
		});*/
		
		$('.chk_otp').on('click', function(){
				var number = $('input[name="txt_otp"]').val();
				var itemid = $('input[name="hid_itemid"]').val();
				if(number){
					$.ajax({
						url : "<?php echo site_url(); ?>/index/validateOTPNumber",
						data : {'otpnumber' : number, 'itemid' : itemid},
						dataType : "JSON",
						async:false,
						type : "POST",
						success : function(res){
							if(res.Status==0){
								alert("Please enter valid otp");
								
							}
							else if(res.Status==1){
								location.reload();
							}
							
						}
					});
					
				}
				
            });
		
        jQuery.validator.addMethod("phoneUS", function(phone_number, element) {
            phone_number = phone_number.replace(/\s+/g, "");
            return this.optional(element) || phone_number.length > 9 &&
                phone_number.match(/^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/);
        }, "Enter a valid phone number");

        jQuery.validator.addMethod("email", function(email, element) {
            email = email.replace(/\s+/g, "");
            return this.optional(element) || 
            email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
        }, "Enter a valid email");

        var validationInvalidHandler = function(event, validator) {
            // 'this' refers to the form
            var errors = validator.numberOfInvalids();
            if (errors) {
                var message = errors == 1 ? "<?php echo $this->lang->line('validation')['missedOne'];?>" : "<?php echo $this->lang->line('validation')['youMissed'];?>" + errors + "<?php echo $this->lang->line('validation')['filedsHighLighed'];?>";
                $("div.error span").html(message);
                $("div.error").show();
            } else {
                $("div.error").hide();
            }
        };
        var validationErrorPlacement = function(error, element) {
            if (element.hasClass("selectized")) {
                var e = element.siblings(2)
                error.insertAfter(e[1]);
            } else if(element.attr("type") == "checkbox"){
                console.log(element);
                console.log("Inside Checkbox");
                error.appendTo($("#checkbox_err"));
            } else {
                console.log(element);
                console.log("Inside else");
                error.insertAfter(element);
            }
        };

        var validatorCreate = $("#loginform").validate({
		    ignore: [],
            rules: {

                password: {
                    required: true
                },
                email_id:{
                    required:true,
                    email:true
                },
            },
            messages: {

                password:{
                    required: "<?php echo $this->lang->line('validation')['requiredPassword'];?>"
                },
                email_id:{
                    //required: "<?php echo $this->lang->line('validation')['requiredEmail'];?>",
                    email: "<?php echo $this->lang->line('validation')['invalidEmail'];?>",
                }
            },
            invalidHandler: validationInvalidHandler,
            errorPlacement: validationErrorPlacement
        });

        var validatorForgot = $("#forgotform").validate({
            ignore: [],
            rules: {

                email_id:{
                    required:true,
                    email:true
                },
            },
            messages: {
                email_id:{
                    required: "<?php echo $this->lang->line('validation')['requiredEmail'];?>",
                    email: "<?php echo $this->lang->line('validation')['invalidEmail'];?>",
                }
            },
            invalidHandler: validationInvalidHandler,
            errorPlacement: validationErrorPlacement
        });

        var validatorReg = $("#reg_form").validate({
            ignore: [],
            rules: {
                first_name: {
                    required : true
                },
                password: {
                    required: true
                },
                re_password: {
                    required: true,
                    equalTo: '[id="reg_password"]'
                },
                agrree:{
                    required: true
                },
                useremail:{
                    //required:true,
                    email:true,
                    remote: "<?php echo site_url();?>/users/checkemail"
                },
                mobile:{
                    required:true,
                    phoneUS:true,
                    remote: "<?php echo site_url();?>/users/checkmobile"
                },
            },
            messages: {
                first_name:{
                    required: "<?php echo $this->lang->line('validation')['requiredFname'];?>"
                },
                password:{
                    required: "<?php echo $this->lang->line('validation')['requiredPassword'];?>"
                },
                re_password:{
                    required: "<?php echo $this->lang->line('validation')['requiredConfirmPassword'];?>",
                    equalTo: "<?php echo $this->lang->line('validation')['passwordNotMatch'];?>"
                },
                agrree:{
                    required: "<?php echo $this->lang->line('validation')['requiredTermsCond'];?>"
                },
                useremail:{
                    //required: "<?php echo $this->lang->line('validation')['requiredEmail'];?>",
                    email: "<?php echo $this->lang->line('validation')['invalidEmail'];?>",
                    remote:"<?php echo $this->lang->line('validation')['takenEmail'];?>"
                },
                mobile:{
                    required: "<?php echo $this->lang->line('validation')['requriedPhone'];?>",
                    phoneUS: "<?php echo $this->lang->line('validation')['invalidPhone'];?>",
                    remote:"<?php echo $this->lang->line('validation')['takenPhone'];?>"
                }
            },
            invalidHandler: validationInvalidHandler,
            errorPlacement: validationErrorPlacement
        });

$('.allowonlynumber').keydown(function(e){
								 
// Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
});
		
    });
</script>
</body>

</html>

