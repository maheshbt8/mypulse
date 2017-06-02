<!DOCTYPE html>
<html>
    
<head>
        
        <!-- Title -->
        <title><?php echo $this->config->item('title'); ?></title>
        
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
        <link href="<?php echo base_url();?>public/assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>  
        <link href="<?php echo base_url();?>public/assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url();?>public/assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/> 
        <link href="<?php echo base_url();?>public/assets/plugins/weather-icons-master/css/weather-icons.min.css" rel="stylesheet" type="text/css"/>   
        <link href="<?php echo base_url();?>public/assets/plugins/metrojs/MetroJs.min.css" rel="stylesheet" type="text/css"/>  
        <link href="<?php echo base_url();?>public/assets/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css"/>    
        <link href="<?php echo base_url();?>public/assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" rel="stylesheet" />
        <link href="<?php echo base_url();?>public/assets/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet" type="text/css"/> 
        <link href="<?php echo base_url();?>public/assets/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet" type="text/css"/>     
        <!-- Theme Styles -->
        <link href="<?php echo base_url();?>public/assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url();?>public/assets/css/themes/white.css" class="theme-color" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url();?>public/assets/css/custom.css" rel="stylesheet" type="text/css"/>
        
        <script src="<?php echo base_url();?>public/assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
        <link href="<?php echo base_url();?>public/assets/plugins/selectize/css/selectize.css" rel="stylesheet" rel="stylesheet" />
        <style type="text/css">
            .selectize-control {
                width: 100%;
                padding: 0px !important;
                border-radius: 0px !important;
            }
        </style>
        <style type="text/css">
            .content_img {
                width: 250px;
                height: 250px;
                overflow:hidden;
            }
            .cimg {
                height: 100%;
                min-width: 100%;
                left: 50%;
                position: relative;
                transform: translateX(-50%);
            }
            .selectize-control {
                width: 100%;
                padding: 0px !important;
                border-radius: 0px !important;
            }
            .image-preview-input {
                position: relative;
                overflow: hidden;
                margin: 0px;    
                color: #333;
                background-color: #fff;
                border-color: #ccc;    
            }
            .image-preview-input input[type=file] {
                position: absolute;
                top: 0;
                right: 0;
                margin: 0;
                padding: 0;
                font-size: 20px;
                cursor: pointer;
                opacity: 0;
                filter: alpha(opacity=0);
            }
            .image-preview-input-title {
                margin-left:2px;
            }

            .image-attach-input {
                position: relative;
                overflow: hidden;
                margin: 0px;    
                color: #333;
                background-color: #fff;
                border-color: #ccc;    
            }
            .image-attach-input input[type=file] {
                position: absolute;
                top: 0;
                right: 0;
                margin: 0;
                padding: 0;
                font-size: 20px;
                cursor: pointer;
                opacity: 0;
                filter: alpha(opacity=0);
            }
            .image-attach-input-title {
                margin-left:2px;
            }
            .sm{

            }
            .negstock{
                color: red;
            }
        </style>

    </head>
    <body class="page-header-fixed">
        <div class="overlay"></div>
        
        
        <main class="page-content content-wrap">
            <div class="navbar">
                <div class="navbar-inner">
                    <div class="sidebar-pusher">
                        <a href="javascript:void(0);" class="waves-effect waves-button waves-classic push-sidebar">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                    <div class="logo-box">
                        <a href="<?php echo site_url();?>" class="logo-text"><span><?php echo $this->config->item('title');?></span></a>
                    </div><!-- Logo Box -->
                  
                    <div class="topmenu-outer">
                        <div class="top-menu">
                            <ul class="nav navbar-nav navbar-left">
                                <li>        
                                    <a class="waves-effect waves-button waves-classic sidebar-toggle" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
                                </li>
                                <li>        
                                    <a class="waves-effect waves-button waves-classic toggle-fullscreen" href="javascript:void(0);"><i class="fa fa-expand"></i></a>
                                </li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                               
                                <li class="dropdown">
                                   <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown"><i class="fa fa-bell"></i>
                                   
                                   <span class="badge badge-success pull-right">1</span></a>
                               
                                   <ul class="dropdown-menu title-caret dropdown-lg" role="menu">
                                       <li><p class="drop-title">Notifications !</p></li>
                                       <li class="dropdown-menu-list slimscroll tasks">
                                           <ul class="list-unstyled">
                                               <li>
                                                   <a href="#">
                                                       <div class="task-icon badge badge-success"><i class="icon-user"></i></div>
                                                       <!--<span class="badge badge-roundless badge-default pull-right">1min ago</span>-->
                                                       <p class="task-details">Welcome to HMS.</p>
                                                   </a>
                                               </li>
                                           </ul>
                                       </li>
                                   </ul>
                               </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                                        <span class="user-name"><?php echo $this->auth->getUsername();?><i class="fa fa-angle-down"></i></span>
                                        <img class="img-circle avatar" src="<?php echo $this->auth->getProfileImg();?>" width="40" height="40" alt="">
                                    </a>
                                    <ul class="dropdown-menu dropdown-list" role="menu">
                                        <li role="presentation"><a href=href="<?php echo site_url();?>/index/"><i class="fa fa-user"></i><?php echo $_SESSION['menu']['profile'];?></a></li>
                                        <li role="presentation" class="divider"></li>
                                        <li role="presentation"><a href="<?php echo site_url();?>/index/logout"><i class="fa fa-sign-out m-r-xs"></i><?php echo $_SESSION['menu']['logout'];?></a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="<?php echo site_url();?>/index/logout" class="log-out waves-effect waves-button waves-classic">
                                        <span><i class="fa fa-sign-out m-r-xs"></i><?php echo $_SESSION['menu']['logout'];?></span>
                                    </a>
                                </li>
                            </ul><!-- Nav -->
                        </div><!-- Top Menu -->
                    </div>
                </div>
            </div><!-- Navbar -->