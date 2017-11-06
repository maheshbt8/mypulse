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
    <h1><?php echo $this->lang->line('my_pulse');?></h1>
</div>
<!-- Login Form-->
<div style="width: 300px; margin: 0 auto">
<?php
    $this->load->view('template/alert');
?>
</div>
<div class="login-form text-center">
    <div class="toggle" style="width:50px; height: 50px;display:none"><i class="fa fa-user-plus" style="font-size: 25px; margin-top: 10px;margin-left: 4px;"></i>
    </div>
    <div class="form formLogin">
        <h2><?php echo $this->lang->line('reset_password');?></h2>
        <form id="re_form"  action="<?php echo site_url();?>/index/changePass" method="post">
            <input type="password" name="password"  placeholder="Password" />
            <input type="password" name="repassword" placeholder="Confirm Password" />
            <input type="hidden" name="key" value="<?php echo $key;?>" />
            <button type="submit"><?php echo $this->lang->line('buttons')['reset'];?></button>
            <div class=""><a href="<?php echo site_url();?>"><?php echo $this->lang->line('buttons')['login'];?></a>
            </div>
        </form>
    </div>
    
</div>

<p class="text-center m-t-xs text-sm" style="color:white"><?php echo date('Y'); ?> &copy; JagruMs Technologies.</p>

<!-- start js include path -->
<script src="<?php echo base_url();?>public/assets/js/jquery.min.js" type="text/javascript"></script>

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

        
        var validatorCreate = $("#re_form").validate({
            ignore: [],
            rules: {
                password: {
                    required: true
                },
                repassword: {
                    required: true,
                    equalTo: '[name="password"]'
                }
            },
            messages: {
                password:{
                    required: "<?php echo $this->lang->line('validation')['requiredPassword'];?>"
                },
                repassword:{
                    required: "<?php echo $this->lang->line('validation')['requiredConfirmPassword'];?>",
                    equalTo: "<?php echo $this->lang->line('validation')['passwordNotMatch'];?>"
                }
            },
            invalidHandler: validationInvalidHandler,
            errorPlacement: validationErrorPlacement
        });
    });
</script>
</body>

</html>