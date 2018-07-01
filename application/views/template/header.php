<!DOCTYPE html>
<html>
    
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="MyPulse" />
    <meta name="author" content="techcrsita.in" />
    <title><?php echo $this->config->item('title');?></title>
        
        <!-- Styles -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        
        <link href="<?php echo base_url();?>public/assets/js/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>public/assets/js/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url();?>public/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url();?>public/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/> 
        <link href="<?php echo base_url();?>public/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css"/>    
        <link href="<?php echo base_url();?>public/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" rel="stylesheet" />
        <link href="<?php echo base_url();?>public/plugins/bootstrap-datetimepicker/css/daterangepicker.css" rel="stylesheet" rel="stylesheet" />
        <!--<link href="<?php echo base_url();?>public/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet" type="text/css"/>-->
        <!--<link href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>-->
        <!--<link href="<?php echo base_url();?>public/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet" type="text/css"/>-->
        <link href="<?php echo base_url();?>public/assets/js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url();?>public/plugins/summernote-master/summernote.css" rel="stylesheet" type="text/css"/>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/assets/css/bootstrap-datetimepicker.min.css">
        <link href="<?php echo base_url();?>public/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.css" />
        
        <link href="<?php echo base_url();?>public/assets/css/theme_style.css" rel="stylesheet" id="rt_style_components" type="text/css" />
        <link href="<?php echo base_url();?>public/assets/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>public/assets/css/style.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>public/assets/css/formlayout.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>public/assets/css/responsive.css" rel="stylesheet" type="text/css" />

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
        <link href="<?php echo base_url();?>public/plugins/selectize/css/selectize.css" rel="stylesheet" rel="stylesheet" />
        <link href="<?php echo base_url();?>public/plugins/select2/css/select2.css" rel="stylesheet" rel="stylesheet" />
        <style type="text/css">
            textarea{
                height:135px !important; overflow:hidden
            }
            .selectize-control {
                width: 100%;
                padding: 0px !important;
                border-radius: 0px !important;
            }
            .selectize-input{
                border-radius: 0;
                box-shadow: none;
                border-color: #d2d6de;
                height: 40px !important;
                padding: 10px;
				width:309px;
            }

            .selectize-input:focus{
                border-color: #3c8dbc;
                box-shadow: none
            }
            .selectize-dropdown, .selectize-dropdown.form-control{
                border: 2px solid #ccc;
                -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
                box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
            }
            .selectize-dropdown-content{
                overflow-y: auto;
                overflow-x: auto;
                max-height: 200px;
                background-color: #fff !important;
                border: 1px solid #ccc;
            }
            .custome_card_header{
                float:right; margin-top:5px; margin-right:10px
            }
            .select2-selection select2-selection--single{
                height:30px !important;
            }
            .swal2-container{
                z-index: 99999 !important;
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
                display:none;
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
                height: 45px;
                padding-top : 13px;
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
            .image-preview-clear{
                margin-top:0px;
                margin-left:0px;
                margin-bottom:0px;
                margin-right: 1px;
                height: 45px;
                border-right: 1px solid #ccc;
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
            .error{
                color:#F96A74;
            }
        </style>
        
    </head>
     <body class="page-header-fixed sidemenu-closed-hidelogo page-container-bg-solid page-content-white page-md" >
     <div class="page-wrapper">
        <!-- start header -->
        <div class="page-header navbar navbar-fixed-top">
            <div class="page-header-inner ">
                <!-- logo start -->
                <div class="page-logo">
                    <a href="<?php echo site_url();?>">
                        <?php
                            $logo = $this->auth->getHospitalLogo();
                        ?>
                        <img src="<?php echo $logo;?>" alt="logo" class="logo-default" style="margin:13px 0 0" />
                    </a>
                    <div class="menu-toggler sidebar-toggler">
                        <span></span>
                    </div>
                </div>
                <!-- logo end -->
             
                <!-- start mobile menu -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                    <span></span>
                </a>
               <!-- end mobile menu -->
                <!-- start header menu -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <!-- start language menu -->
                        <li class="dropdown language-switch">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <img src="<?php echo base_url();?>public/images/flags/gb.png" class="position-left" alt=""> English <span class="fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu">
                                
                                <li>
                                    <a class="english"><img src="<?php echo base_url();?>public/images/flags/gb.png" alt=""> English</a>
                                </li>
                            </ul>
                        </li>
                        <!-- end language menu -->
                        <!-- start notification dropdown -->
                        <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="fa fa-bell-o"></i>
                                <?php
                                    $notificationCount = $this->notification->getUnreadNotificationCount();
                                ?>
                                <?php if($notificationCount > 0) { ?>
                                <span id="not_cont_span" class="badge orange-bgcolor"><?php echo $notificationCount; ?></span>
                                <?php } ?>
                                
                            </a>
                            <ul class="dropdown-menu nonclose-dropdown-menu">
                                <li class="external">
                                    <h3><span class="bold">Notifications</span></h3>
                                    <!-- <span class="notification-label purple-bgcolor">New <?php //echo $notificationCount;?></span> -->
                                </li>
                                <li>
                                    <ul class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283">
                                        
                                        <?php
                                            $topNotifications = $this->notification->getAllNotification();
                                            foreach ($topNotifications as $notification){
                                            ?>
                                            <li class="rm">
                                                <a href="javascript:void(0);">
                                                    <span class="time" data-id="<?php echo $notification['id'];?>" class="task_read"  style="margin-left: 5px; border-radius: 25px; border: 1px solid"><i class="fa fa-remove"></i></span>
                                                    <span class="time"><?php echo $this->notification->time_elapsed_string($notification['created_date']);?></span>
                                                    
                                                    <span class="details">
                                                        <?php echo $notification['text'];?>
                                                        <br>
                                                        <span><?php echo $notification['first_name'];?></span>
                                                    </span>
                                                </a>
                                            </li>
                                            <?php
                                            }
                                            if(count($topNotifications) == 0){
                                                ?> 
                                                <li>
                                                    <a href="#">
                                                        <p class="details">Your notification list is empty.</p>
                                                    </a>    
                                                </li>
                                                <?php
                                            }
                                        ?>
                                    </ul>
                                    <div class="dropdown-menu-footer">
                                        <a href="<?php echo site_url();?>/index/readAllnotification">Mark as read all notifications</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- end notification dropdown -->
                        <!-- start message dropdown -->
                        <?php
                            $msgCount = $this->messages->getUnreadMessageCount();
                        ?>
                        <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="fa fa-envelope-o"></i>
                                <?php if($msgCount > 0) { ?>
                                <span id="msg_count" class="badge cyan-bgcolor"> <?php echo $msgCount;?> </span>
                                <?php } ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="external">
                                    <h3><span class="bold">Messages</span></h3>
                                    <!-- <span class="notification-label cyan-bgcolor">New <?php //echo $msgCount;?></span> -->
                                </li>
                                <li>
                                    <ul class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283">
                                        
                                        <?php
                                            $msgs = $this->messages->getTopMessages();
                                            foreach ($msgs as $msg){
                                                ?>
                                                <li class="rm">
                                                    <a href="<?php echo site_url();?>/index/messages/<?php echo $msg['id'];?>">
                                                        <!--<span class="photo"><img src="img/doc/doc2.svg" class="img-circle" alt=""> </span>-->
                                                        <span class="subject">
                                                            <span class="from"><?php echo $msg['first_name']; ?></span>
															<!--<span class="time task_read" data-id="<?php echo $msg['id'];?>" style="margin-left: 5px; padding:0px 2px 0px 2px; border-radius: 25px; border: 1px solid"><i class="fa fa-remove"></i></span>-->
                                                            <span class="time"><?php echo $this->notification->time_elapsed_string($msg['created_date']);?></span>
                                                        </span>
                                                        <span class="message"> <?php echo $msg['title'];?> </span>
												    </a>
                                                </li>
												<?php
                                            }
                                            if(count($msgs) == 0){ ?>
                                                <li>
                                                    <a href="#">
                                                        <!--<div class="msg-img"><div class="online on"></div><img class="img-circle" src="<?php echo $this->auth->getProfileImg();?>" alt=""></div>
                                                        -->
                                                        <p class="message">Message box is empty!</p>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                        ?>
                                    </ul>
                                    <div class="dropdown-menu-footer">
                                        <a href="<?php echo site_url();?>/index/messages"> All Messages </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- end message dropdown -->
                        <!-- start manage user dropdown -->
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <img alt="" class="img-circle " src="<?php echo $this->auth->getProfileImg();?>" />
                                <span class="username username-hide-on-mobile"> <?php echo $this->auth->getUsername();?> </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="<?php echo site_url();?>/index/profile"><i class="fa fa-user"></i><?php echo $_SESSION['menu']['profile'];?></a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url();?>/index/changepassword"><i class="fa fa-lock"></i><?php echo $_SESSION['menu']['changePassword'];?></a>
                                </li>
                                <li class="divider"> </li>
                                <li>
                                    <a href="<?php echo site_url();?>/index/logout"><i class="icon-logout"></i><?php echo $_SESSION['menu']['logout'];?></a>
                                </li>
                            </ul>
                        </li>
                        <!-- end manage user dropdown -->
                        
                    </ul>
                </div>
            </div>
        </div>
        <!-- end header -->
         <div class="clearfix"> </div>