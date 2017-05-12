<!-- horizontal-bar -->
<div class="page-sidebar  sidebar">
                <div class="page-sidebar-inner slimscroll">
                    <div class="sidebar-header">
                        <div class="sidebar-profile">
                            <a href="javascript:void(0);" id="profile-menu-link">
                                <div class="sidebar-profile-image">
                                    <img src="<?php echo $this->auth->getProfileImg();?>" class="img-circle img-responsive" alt="">
                                </div>
                                <div class="sidebar-profile-details">
                                    <span><?php echo $this->auth->getUsername(); ?><br><small><?php //echo $this->auth->getRoleText();?></small></span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <ul class="menu accordion-menu">
                        <li id="li1"><a href="<?php echo site_url();?>" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Dashboard</p></a></li>

                        <?php

                        switch ($this->auth->getRole()) {
                            case 1:
                                //Admin
                        ?>
                            <li id="li2" class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-plus-sign"></span><p>Hospitals</p><span class="arrow"></span></a>
                                <ul class="sub-menu">
                                    <li><a href="<?php echo site_url();?>/hospitals">Hospitals</a></li>
                                    <li><a href="<?php echo site_url();?>">Departments</a></li>
                                    <li><a href="<?php echo site_url();?>">Nurshes</a></li>
                                    <li><a href="<?php echo site_url();?>">MedLab</a></li>
                                    <li><a href="<?php echo site_url();?>">Medical Store</a></li>
                                </ul>
                            </li>

                            <li id="li3" class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon fa fa-user-md"></span><p>Doctors</p><span class="arrow"></span></a>
                                <ul class="sub-menu">
                                    <li><a href="<?php echo site_url();?>">Doctors</a></li>
                                    <li><a href="<?php echo site_url();?>">Receptionist</a></li>
                                </ul>
                            </li>
                            <li id=""><a href="<?php echo site_url();?>" class="waves-effect waves-button"><span class="menu-icon fa fa-user "></span><p>Patients</p></a></li>
                            <li id=""><a href="<?php echo site_url();?>" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-cog "></span><p>Settings</p></a></li>
                        <?php                                
                                break;
                            default:
                                break;
                        }

                        ?>

                        <!-- <li><a href="<?php echo site_url();?>/index/profile" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-user"></span><p>Profile</p></a></li> -->

                        <!-- <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-envelope"></span><p>Mailbox</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
                                <li><a href="inbox.html">Inbox</a></li>
                                <li><a href="message-view.html">View Message</a></li>
                                <li><a href="compose.html">Compose</a></li>
                            </ul>
                        </li> -->
                        
                    </ul>
                </div><!-- Page Sidebar Inner -->
            </div><!-- Page Sidebar -->
            <div class="page-inner">
                <div class="page-title">
                    <h3><?php echo $page_title; ?></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <?php 
                                foreach ($breadcrumb as $key => $value) {
                                    if($key == null)
                                        echo "<li class='active'><a>$value</a></li>";
                                    else
                                        echo "<li><a href='$key'>$value</a></li>";
                                }
                            ?>
                        </ol>
                    </div>
                </div>

                <div class="" style="margin-left: 50px;margin-right: 50px;margin-top: 20px"> 
                    <?php $this->load->view('template/alert'); ?>
                </div>