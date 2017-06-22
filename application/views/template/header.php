<!DOCTYPE html>
<html>
    
<head>
        <!-- Title -->
        <title><?php echo $this->config->item('validation')['my']; ?></title>
        
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.css" />
        <script src="<?php echo base_url();?>public/assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
        <script>
            var BASEURL = '<?php echo site_url();?>';
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
						} else {
							error.insertAfter(element);
						}
					};  

            var swalDeleteConfig = {
                title: "<?php echo $this->lang->line('headings')['areYouSure'];?>",
                text: "<?php echo $this->lang->line('headings')['deleteMessage'];?>",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "<?php echo $this->lang->line('buttons')['yes'];?>",
                cancelButtonText: "<?php echo $this->lang->line('buttons')['no'];?>"
            };              
            var delResFunc = function(data,id){
                if(data==1){
                    $("#dellink_"+id).parents('tr').remove();	
                    toastr.success("<?php echo $this->lang->line('headings')['deleteSuccess'];?>");
                }else{
                    toastr.error("<?php echo $this->lang->line('headings')['tryAgain'];?>");
                }
            };
            
            function resetForm(validator){
                validator.resetForm();
                $("div.error").hide();
                
            }
        </script>
        <link href="<?php echo base_url();?>public/assets/plugins/selectize/css/selectize.css" rel="stylesheet" rel="stylesheet" />
        <style type="text/css">
            .selectize-control {
                width: 100%;
                padding: 0px !important;
                border-radius: 0px !important;
            }
        </style>
        <style type="text/css">
            #tabs a{
                padding: 10px 8px !important;
            }
            .custome_col8{
                width:66.66666667%
            }
            .custome_col4{
                
            }
            .panel_button_top_right{
                float:right;
            }
            .panel_heading_custome{
                max-width:100px;overflow:hidden;white-space: nowrap;text-overflow: ellipsis;
            }
            .panel_body_custome{
                margin-top:15px;
            }
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
            .model_error{
                
                margin-right: 50px;
                color: #AC4A42;
                font-size: 15px;
                float: right;
                margin-bottom: 10px;

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
                                    <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope"></i><span class="badge badge-success pull-right">1</span></a>
                                    <ul class="dropdown-menu title-caret dropdown-lg" role="menu">
                                        <li><p class="drop-title">You have 1 new  messages !</p></li>
                                        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;"><li class="dropdown-menu-list slimscroll messages" style="overflow: hidden; width: auto; height: 100%;">
                                            <ul class="list-unstyled">
                                                <li>
                                                    <a href="#">
                                                        <div class="msg-img"><div class="online on"></div><img class="img-circle" src="<?php echo $this->auth->getProfileImg();?>" alt=""></div>
                                                        <p class="msg-name">Admin</p>
                                                        <p class="msg-text">Hey ! Welcome, to HMS.</p>
                                                        <p class="msg-time">1 day ago</p>
                                                    </a>
                                                </li>
                                                
                                            </ul>
                                        </li><div class="slimScrollBar" style="background: rgb(204, 204, 204); width: 7px; position: absolute; top: 0px; opacity: 0.3; display: none; border-radius: 0px; z-index: 99; right: 0px; height: 180.723px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 0px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 0px;"></div></div>
                                        <li class="drop-all"><a href="#" class="text-center">All Messages</a></li>
                                    </ul>
                                </li>
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
                                        <!--<li role="presentation"><a href=href="<?php //echo site_url();?>/index/"><i class="fa fa-user"></i><?php //echo $_SESSION['menu']['profile'];?></a></li>-->
                                        <!--<li role="presentation" class="divider"></li>-->
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