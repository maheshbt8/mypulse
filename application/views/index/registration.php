<!DOCTYPE html>
<html>
    

<head>
        <!-- Title -->
        <title><?php echo $this->config->item('title');?> | Sign Up</title>
        
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="author" content="http://techcrista.in" />
        
        <!-- Styles -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        <link href="<?php echo base_url();?>public/assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
        <link href="<?php echo base_url();?>public/assets/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
        <link href="<?php echo base_url();?>public/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url();?>public/assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url();?>public/assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/> 
        <link href="<?php echo base_url();?>public/assets/plugins/offcanvasmenueffects/css/menu_cornerbox.css" rel="stylesheet" type="text/css"/>  
        <link href="<?php echo base_url();?>public/assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>  
        <link href="<?php echo base_url();?>public/assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url();?>public/assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/> 
        
        <!-- Theme Styles -->
        <link href="<?php echo base_url();?>public/assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url();?>public/assets/css/themes/white.css" class="theme-color" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url();?>public/assets/css/custom.css" rel="stylesheet" type="text/css"/>
        
        <script src="<?php echo base_url();?>public/assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
    </head>
    <body class="page-register">
        <div class="page-content">
            <div class="page-inner">
                <div id="main-wrapper">
                    <div class="row">
                        <div class="col-md-3 center">
                            <div class="login-box">
                               <?php
                                  $this->load->view('template/alert');
                                ?>
                                <a href="<?php echo site_url();?>" class="logo-name text-lg text-center"><?php echo ucfirst($this->config->item('title'));?></a>
                                <p class="text-center m-t-md">Create a account</p>
                                <form class="m-t-md"  method="post" id="reg_form" action="<?php echo site_url().'/index/doReg' ?>">
                                    <!-- <div class="form-group">
                                        <label>Register As</label>
                                        <select class="form-control" name="role" id="role">
                                            <option value="2">Hospital Admin</option>
                                            <option value="3">Doctor</option>
                                            <option value="4">Nurse</option>
                                            <option value="5">Receptienst</option>
                                            <option value="6">Patient</option>
                                        </select>
                                    </div> -->
                                    <input type="hidden" name="role" value="-1">
                                    <div class="form-group">
                                        <input type="text" name="first_name" class="form-control" placeholder="Name*" >
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="mobile" class="form-control" placeholder="Mobile Number*" >
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="useremail" class="form-control" placeholder="Email*" >
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" placeholder="Password*" >
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="re_password" class="form-control" placeholder="Confirm Password*" >
                                    </div>
                                    <label>
                                        <input name="agrree" type="checkbox"> Agree the terms and policy
                                    </label>
                                    <p class="mandatory" >* are mandatory</p>
                                    <button type="submit" class="btn btn-success btn-block m-t-xs">Submit</button>
                                    <p class="text-center m-t-xs text-sm">Already have an account?</p>
                                    <a href="<?php echo site_url();?>" class="btn btn-default btn-block m-t-xs">Login</a>
                                </form>
                                <p class="text-center m-t-xs text-sm"><?php echo date('Y'); ?> &copy; JagruMs Technologies.</p>
                            </div>
                        </div>
                    </div><!-- Row -->
                </div><!-- Main Wrapper -->
            </div><!-- Page Inner -->
        </div><!-- Page Content -->
    


        <!-- Javascripts -->
        <script src="<?php echo base_url();?>public/assets/plugins/jquery/jquery-2.1.3.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/pace-master/pace.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/switchery/switchery.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/uniform/jquery.uniform.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/offcanvasmenueffects/js/classie.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/offcanvasmenueffects/js/main.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/waves/waves.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/3d-bold-navigation/js/main.js"></script>
        <script src="<?php echo base_url();?>public/assets/js/modern.min.js"></script>
        <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                jQuery.validator.addMethod("phoneUS", function(phone_number, element) {
                    phone_number = phone_number.replace(/\s+/g, ""); 
                    return this.optional(element) || phone_number.length > 9 &&
                        phone_number.match(/^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/);
                }, "Please specify a valid phone number");

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
                    error.appendTo($("#weekerror"));
                } else {
                    error.insertAfter(element);
                }
            };  

                var validatorCreate = $("#reg_form").validate({
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
                            equalTo: '[name="password"]'
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

<!-- Mirrored from lambdathemes.in/modern/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Apr 2015 11:11:14 GMT -->
</html>