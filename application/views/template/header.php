<!DOCTYPE html>
<html>
    
<head>
        <!-- Title -->
        <!--<title><?php //echo $this->config->item('validation')['my']; ?></title>-->
        <title><?php echo $this->config->item('title');?></title>
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
        <!--<link href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>-->
        <link href="<?php echo base_url();?>public/assets/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet" type="text/css"/>

        <link href="<?php echo base_url();?>public/assets/plugins/summernote-master/summernote.css" rel="stylesheet" type="text/css"/>
        <!-- Theme Styles -->
        <link href="<?php echo base_url();?>public/assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url();?>public/assets/css/themes/white.css" class="theme-color" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url();?>public/assets/css/custom.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.css" />
        <script src="<?php echo base_url();?>public/assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
        <link href="<?php echo base_url();?>public/assets/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
        <!--<link href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
        <link href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.print.css" rel="stylesheet" type="text/css"/>-->
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.css" />
        
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
						} else if(element.attr("type") == "checkbox"){
                            error.appendTo($("#weekerror"));
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
                if(validator!=undefined)
                    validator.resetForm();
                $("div.error").hide();
                
            }
        </script>
        <link href="<?php echo base_url();?>public/assets/plugins/selectize/css/selectize.css" rel="stylesheet" rel="stylesheet" />
        <link href="<?php echo base_url();?>public/assets/plugins/select2/css/select2.css" rel="stylesheet" rel="stylesheet" />
        <style type="text/css">
            .selectize-control {
                width: 100%;
                padding: 0px !important;
                border-radius: 0px !important;
            }
            .select2-selection select2-selection--single{
                height:30px !important;
            }
            .swal2-container{
                z-index: 9999 !important;
            }
            .fc-time{
                display:none !important;
            }
            .fc-event-container{
                cursor: pointer;
            }
            .panel-group .panel {
                overflow: visible;
            }
            .panel .panel-heading{
                overflow: visible !important;
            }
            .dt-buttons a {
                width:100%;
                display : block;
                font-weight : normal;
                text-decoration: none;
            }
            .dt-buttons a:hover{
                font-weight:bold;
            }
            form label {font-weight:bold}
            .drop-area
            {
                height:200px;
                background-color:white;
                border:1px dashed #ccc;
            }
            .drop-text
            {
                margin-top:80px;
                color:grey;
                text-align: center; 
            }
            .drop-area img
            {
                max-width:100px;
                min-width:100px;
                display:flow-root;
                margin: 0 auto;
                max-height: 100px;
                min-height: 100px;
                margin-top: 5%;
            }
        </style>
        <style type="text/css">
            .equalDivParent{
                display:flex;
                width:100%;
            }
            .equalDivChild{
                flex-basis:95%
            }
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
                max-width:180px;overflow:hidden;white-space: nowrap;text-overflow: ellipsis;
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
            .bold{
                font-weight: 700;
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
                            <?php
                                $msgCount = $this->messages->getUnreadMessageCount();
                            ?>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope"></i>
                                        <?php if($msgCount > 0) { ?>
                                        <span id="msg_count" class="badge badge-success pull-right"><?php echo $msgCount; ?></span>
                                        <?php } ?>
                                    </a>
                                    <ul class="dropdown-menu title-caret dropdown-lg" role="menu">
                                        <li><p class="drop-title">You have <?php echo $msgCount; ?> new  messages !</p></li>
                                        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
                                            <li class="dropdown-menu-list slimscroll messages" style="overflow: hidden; width: auto; height: 100%;">
                                                <ul class="list-unstyled">
                                                    <?php
                                                        $msgs = $this->messages->getTopMessages();
                                                        foreach ($msgs as $msg){
                                                            ?>
                                                            <li>
                                                                <a href="<?php echo site_url();?>/index/messages/<?php echo $msg['id'];?>">
                                                                    <!--<div class="msg-img"><div class="online on"></div><img class="img-circle" src="<?php echo $this->auth->getProfileImg();?>" alt=""></div>
                                                                    -->
                                                                    <p class="msg-name"><?php echo $msg['first_name']; ?></p>
                                                                    <p class="msg-text"><?php echo $msg['title'];?></p>
                                                                    <p style="width: auto" class="msg-time"><?php echo $this->notification->time_elapsed_string($msg['created_date']);?></M></p>
                                                                </a>
                                                            </li>
                                                            <?php
                                                        }
                                                        if(count($msgs) == 0){ ?>
                                                            <li>
                                                                <a href="#">
                                                                    <!--<div class="msg-img"><div class="online on"></div><img class="img-circle" src="<?php echo $this->auth->getProfileImg();?>" alt=""></div>
                                                                    -->
                                                                    <p class="msg-name">Message box is empty!</p>
                                                                </a>
                                                            </li>
                                                            <?php
                                                        }
                                                    ?>

                                                </ul>
                                            </li>
                                            <div class="slimScrollBar" style="background: rgb(204, 204, 204); width: 7px; position: absolute; top: 0px; opacity: 0.3; display: none; border-radius: 0px; z-index: 99; right: 0px; height: 180.723px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 0px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 0px;"></div>
                                        </div>
                                        <li class="drop-all"><a href="<?php echo site_url();?>/index/messages" class="text-center">All Messages</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown" ><i class="fa fa-bell"></i>
                                        <?php $notificationCount = $this->notification->getUnreadNotificationCount(); if($notificationCount > 0) { ?>
                                        <span id="not_cont_span" class="badge badge-success pull-right"><?php echo $notificationCount; ?></span>
                                        <?php } ?>
                                    </a>
                                    <ul class="nonclose-dropdown-menu dropdown-menu title-caret dropdown-lg" role="menu">
                                        <li><p class="drop-title">Notifications !</p></li>
                                        <div class="notislimScrollDiv" class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
                                            <li class="dropdown-menu-list slimscroll tasks" style="overflow: hidden; width: auto; height: 100%;">
                                                <ul class="list-unstyled">
                                                    <?php
                                                        $topNotifications = $this->notification->getAllNotification();
                                                        foreach ($topNotifications as $notification){
                                                            ?>
                                                            <li class='rm'>
                                                                <a href="#">
                                                                    <div data-id="<?php echo $notification['id'];?>" class="task_read task-icon badge pull-right" style="vertical-align: middle; width: 25px; height: 25px; margin-top: 10px;"><i class="glyphicon glyphicon-remove" style="margin: 0 auto;"></i></div>
                                                                    <span class="badge badge-roundless badge-default pull-right"><?php echo $this->notification->time_elapsed_string($notification['created_date']);?></span>
                                                                    <p class="msg-name" style="margin: 0px;"><?php echo $notification['first_name']; ?></p>
                                                                    <p class="task-details" style="width: auto;"><?php echo $notification['text'];?></p>
                                                                </a>
                                                            </li>
                                                            <?php
                                                        }
                                                        if(count($topNotifications) == 0){ ?>
                                                            <li>
                                                                <a href="#">
                                                                    <!--<div class="msg-img"><div class="online on"></div><img class="img-circle" src="<?php echo $this->auth->getProfileImg();?>" alt=""></div>
                                                                    -->
                                                                    <p class="msg-name">Your notification list is empty.</p>
                                                                </a>
                                                            </li>
                                                            <?php
                                                        }
                                                    ?>

                                                </ul>
                                            </li>
                                            <div class="slimScrollBar" style="background: rgb(204, 204, 204); width: 7px; position: absolute; top: 0px; opacity: 0.3; display: none; border-radius: 0px; z-index: 99; right: 0px; height: 180.723px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 0px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 0px;"></div>
                                        </div>
                                        <li class="drop-all"><a href="<?php echo site_url();?>/index/readAllnotification" class="text-center">Mark as read all notifications</a></li>
                                    </ul>
                                </li>
                               
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                                        <span class="user-name"><?php echo $this->auth->getUsername();?><i class="fa fa-angle-down"></i></span>
                                        <img class="img-circle avatar" src="<?php echo $this->auth->getProfileImg();?>" width="40" height="40" alt="">
                                    </a>
                                    <ul class="dropdown-menu dropdown-list" role="menu">
                                        <li role="presentation"><a href="<?php echo site_url();?>/index/profile"><i class="fa fa-user"></i><?php echo $_SESSION['menu']['profile'];?></a></li>
                                        <li role="presentation"><a href="<?php echo site_url();?>/index/changepassword"><i class="fa fa-lock"></i><?php echo $_SESSION['menu']['changePassword'];?></a>
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