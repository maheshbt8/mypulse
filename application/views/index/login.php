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

    <style>
        .error{
            color:#F96A74;
        }
    </style>
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
            <input type="text" placeholder="Username" name="email_id" />
            <input type="password" placeholder="Password" name="password"/>
            <div class="remember text-left">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox2" type="checkbox" checked>
                    <label for="checkbox2"><?php echo $this->lang->line('remember_me');?></label>
                </div>
            </div>
            <button><?php echo $this->lang->line('buttons')['login'];?></button>
            <div class="forgetPassword"><a href="javascript:void(0)"><?php echo $this->lang->line('forgot_your_password');?></a>
            </div>
            <div class="signup"><a href="javascript:void(0)"><?php echo $this->lang->line('do_not_have_account');?></a>
            </div>
        </form>
    </div>
    <div class="form formRegister">
        <h2><?php echo $this->lang->line('labels')['create_account'];?></h2>
        <form method="post" id="reg_form" action="<?php echo site_url().'/index/doReg' ?>">
            <input type="text" name="first_name" placeholder="Name*" >
            <input type="text" name="mobile" placeholder="Mobile Number*" >
            <input type="email" name="useremail" placeholder="Email*" >
            <input type="password" id="reg_password" name="password"  placeholder="Password*" >
            <input type="password" name="re_password" placeholder="Confirm Password*" >
            <div class="remember text-left">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox3" type="checkbox" name="agrree">
                    <label for="checkbox3">
                        <?php echo $this->lang->line('labels')['agree_terms_policy'];?>
					</label>
                </div>
            </div>
            <div id="checkbox_err"></div>
            <button><?php echo $this->lang->line('buttons')['register'];?></button>
        </form>
    </div>
    <div class="form formReset">
        <h2><?php echo $this->lang->line('reset_password');?></h2>
        <form id="forgotform"  action="<?php echo site_url();?>/index/sendResetKey" method="post">
            <input type="email" placeholder="Email Address" name="email_id"/>
            <button><?php echo $this->lang->line('buttons')['send_verification_email'];?></button>
        </form>
    </div>
</div>

<p class="text-center m-t-xs text-sm" style="color:white"><?php echo date('Y'); ?> &copy; JagruMs Technologies.</p>

<!-- start js include path -->
<script src="<?php echo base_url();?>public/assets/js/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>public/assets/js/login.js"></script>
<script src="<?php echo base_url();?>public/assets/js/pages.js" type="text/javascript"></script>
<!-- end js include path -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
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
                    required: "<?php echo $this->lang->line('validation')['requiredEmail'];?>",
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
                    required:true,
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
                    required: "<?php echo $this->lang->line('validation')['requiredEmail'];?>",
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
    });
</script>
</body>

</html>

