<div class="page-sidebar sidebar">
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
                            <li id="li2"><a href="<?php echo site_url();?>/hospitals" class="waves-effect waves-button"><span class="menu-icon fa  fa-hospital-o"></span><p>Hospitals</p></a></li>
                            <li id="li3"><a href="<?php echo site_url();?>/departments" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-plus-sign"></span><p>Departments</p></a></li>
                            <li id="li4"><a href="<?php echo site_url();?>" class="waves-effect waves-button"><span class="menu-icon fa  fa-stethoscope "></span><p>Doctors</p></a></li>
                            <li id="li5"><a href="<?php echo site_url();?>" class="waves-effect waves-button"><span class="menu-icon  icon-user "></span><p>Nurses</p></a></li>
                            <li id="li6"><a href="<?php echo site_url();?>" class="waves-effect waves-button"><span class="menu-icon  icon-user-following "></span><p>Receptionists</p></a></li>
                            <li id="li7"><a href="<?php echo site_url();?>" class="waves-effect waves-button"><span class="menu-icon icon-users "></span><p>Patients</p></a></li>
                            <li id="li8"><a href="<?php echo site_url();?>" class="waves-effect waves-button"><span class="menu-icon fa fa-medkit "></span><p>Medical Stores</p></a></li>
                            <li id="li9"><a href="<?php echo site_url();?>" class="waves-effect waves-button"><span class="menu-icon fa  fa-plus-square "></span><p>Medical Labs</p></a></li>
                            <li id="li10"><a href="<?php echo site_url();?>" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-edit "></span><p>Appointments</p></a></li>
                            <li id="li11"><a href="<?php echo site_url();?>" class="waves-effect waves-button"><span class="menu-icon fa fa-credit-card "></span><p>Payments</p></a></li>
                            <li id="li12"><a href="<?php echo site_url();?>" class="waves-effect waves-button"><span class="menu-icon  icon-bar-chart "></span><p>Reports and Services</p></a></li>
                            
                            <li id="li13" class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-cog"></span><p>Settings</p><span class="arrow"></span></a>
                                <ul class="sub-menu">
                                    <li id="li1301"><a href="<?php echo site_url();?>/license/" >License Category</a></li>
                                </ul>
                            </li>
                            
                        <?php                                
                                break;
                            default:
                                break;
                        }

                        ?>
                        
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