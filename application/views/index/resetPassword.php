<!DOCTYPE html>
<html>
    
<head>
        
        <!-- Title -->
        <title><?php echo $this->config->item('title');?> | Login - Forgot Password</title>
        
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">

        <!-- Title -->
        
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
    <body class="page-forgot">
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
                                <p class="text-center m-t-md">Reset Password</p>
                                <form class="m-t-md" action="<?php echo site_url();?>/index/changePass" method="post">
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" name="password" placeholder="Password" required/>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="repassword" class="form-control" name="repassword" placeholder="Password" required />
                                    </div>
                                    <input type="hidden" name="key" value="<?php echo $key;?>" />
                                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                    <a href="<?php echo site_url();?>" class="btn btn-default btn-block m-t-md">Login</a>
                                </form>
                                <p class="text-center m-t-xs text-sm"><?php echo date('Y'); ?> &copy; JagruMs Technologies.</p>
                            </div>
                        </div>
                    </div><!-- Row -->
                </div><!-- Main Wrapper -->
            </div><!-- Page Inner -->
        </main><!-- Page Content -->
  

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
        
    </body>
</html>
