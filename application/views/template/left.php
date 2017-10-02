 <!-- start page container -->
        <div class="page-container">
            <!-- start sidebar menu -->
            <div class="sidebar-container">
                <div class="sidemenu-container navbar-collapse collapse fixed-menu">
                    <div id="remove-scroll">
                        <ul class="sidemenu  page-header-fixed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                            <li class="sidebar-toggler-wrapper hide">
                                <div class="sidebar-toggler">
                                    <span></span>
                                </div>
                            </li>
                            <li class="sidebar-user-panel">

                                    <div class="user-panel">
                                        <div class="pull-left image">
                                            <img src="<?php echo $this->auth->getProfileImg();?>" class="img-circle user-img-circle" alt="User Image" />
                                        </div>
                                        <div class="pull-left info">
                                            <p> <?php echo $this->auth->getUsername(); ?></p>
                                            <a href="#"><span class="txtOnline"> <?php echo $this->auth->getRoleText();?></span></a>
                                        </div>
                                    </div>

                            </li>
                            <?php
                                
                                $menu = $_SESSION['menu'];
                            ?>
                            <li id="li1" class="nav-item"><a href="<?php echo site_url();?>" class="nav-link"><i class="glyphicon glyphicon-home"></i><span class="title"><?php echo $menu['main_dashboard'];?></span></a></li>
                            <?php

                            switch ($this->auth->getRole()) {
                                case $this->auth->getAdminRoleType():
                                //Super Admin
                            ?>
                                
                                <li id="li2" class="nav-item">
                                    <a href="#" class="nav-link nav-toggle">
                                        <i class="fa fa-hospital-o"></i>
                                        <span><?php echo $menu['main_hospitals'];?></span><span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li id="li201" class="nav-item"><a class="nav-link " href="<?php echo site_url();?>hospitals"><?php echo $menu['main_hospitals'];?></a></li>
                                        <li id="li202" class="nav-item"><a class="nav-link " href="<?php echo site_url();?>branches" ><?php echo $menu['main_branches'];?></a></li>
                                        <li id="li203" class="nav-item"><a class="nav-link " href="<?php echo site_url();?>departments" ><?php echo $menu['main_departments'];?></a></li>
                                        <li id="li206" class="nav-item"><a class="nav-link " href="<?php echo site_url();?>wards" ><?php echo $menu['main_wards'];?></a></li> 
                                        <li id="li204" class="nav-item"><a class="nav-link " href="<?php echo site_url();?>beds" ><?php echo $menu['main_beds'];?></a></li>
                                        <li id="li205" class="nav-item"><a class="nav-link " href="<?php echo site_url();?>charges" ><?php echo $menu['main_charges'];?></a></li> 
                                    </ul>
                                </li>
                                <li id="li14" class="nav-item"><a href="<?php echo site_url();?>hospital_admin" class="nav-link"><i class="fa  fa-users "></i><span class="title"><?php echo $menu['main_hospital_admin'];?></span></a></li> 
                                <li id="li4" class="nav-item"><a href="<?php echo site_url();?>doctors" class="nav-link"><i class="menu-icon fa  fa-stethoscope "></i><span class="title"><?php echo $menu['main_dectors'];?> </span></a></li>
                                <li id="li5" class="nav-item"><a href="<?php echo site_url();?>nurse" class="nav-link"><i class="menu-icon  icon-user "></i><span class="title"><?php echo $menu['main_nurses'];?></span></a></li>
                                <li id="li6" class="nav-item"><a href="<?php echo site_url();?>receptionist" class="nav-link"><i class="menu-icon  icon-user-following "></i><span class="title"><?php echo $menu['main_receptionists'];?></span></a></li>
                                <li id="li7" class="nav-item"><a href="<?php echo site_url();?>patients" class="nav-link"><i class="menu-icon icon-users "></i><span class="title"><?php echo $menu['main_patients'];?></span></a></li>
                                <li id="li8" class="nav-item"><a href="<?php echo site_url();?>medical_store" class="nav-link"><i class="menu-icon fa fa-medkit "></i><span class="title"><?php echo $menu['main_medical_stores'];?></span></a></li>
                                <li id="li9" class="nav-item"><a href="<?php echo site_url();?>medical_lab" class="nav-link"><i class="menu-icon fa  fa-plus-square "></i><span class="title"><?php echo $menu['main_medical_labs'];?></span></a></li>
                                <li id="li52" class="nav-item"><a href="<?php echo site_url();?>appoitments" class="nav-link"><i class="menu-icon glyphicon glyphicon-list-alt"></i><span class="title"><?php echo $menu['appoitments'];?></span></a></li>
                                <li id="li11" class="nav-item"><a href="<?php echo site_url();?>" class="nav-link"><i class="menu-icon fa fa-credit-card "></i><span class="title"><?php echo $menu['main_payments'];?></span></a></li>

                                <li id="li12" class="nav-item">
                                    <a href="#" class="nav-link nav-toggle">
                                        <i class="icon-bar-chart"></i>
                                        <span><?php echo $menu['main_reports'];?></span><span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li id="li1201" class="nav-item"><a class="nav-link " href="<?php echo site_url();?>patients/report"><?php echo $menu['main_patient_report'];?></a></li>
                                        <li id="li1202" class="nav-item"><a class="nav-link " href="<?php echo site_url();?>appoitments/report" ><?php echo $menu['main_appoitment_report'];?></a></li>
                                        
                                    </ul>
                                </li>

                                <li id="li13" class="nav-item">
                                    <a href="#" class="nav-link nav-toggle">
                                        <i class="glyphicon glyphicon-cog"></i>
                                        <span><?php echo $menu['main_settings'];?></span><span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li id="li1301" class="nav-item"><a class="nav-link " href="<?php echo site_url();?>license"><?php echo $menu['main_license_category'];?></a></li>
                                        <li id="li1302" class="nav-item"><a class="nav-link " href="<?php echo site_url();?>healthinsuranceprovider" ><?php echo $menu['main_healthinsuranceprovider'];?></a></li>
                                        
                                    </ul>
                                </li>
                                
                            <?php
                                break;
                                case $this->auth->getHospitalAdminRoleType():
                                //Hospital Admin                                
                            ?>
                                <li class="nav-item" id="li13">
                                    <a href="<?php echo site_url();?>branches" class="nav-link"><i class=" glyphicon glyphicon-plus-sign"></i><span class="title"><?php echo $menu['main_branches'];?></span>
                                    </a>
                                </li>
                                <li class="nav-item" id="li3">
                                    <a href="<?php echo site_url();?>departments" class="nav-link"><i class=" glyphicon glyphicon-plus-sign"></i><span class="title"><?php echo $menu['main_departments'];?></span>
                                    </a>
                                </li>
                                <li class="nav-item" id="li14">
                                    <a href="<?php echo site_url();?>beds" class="nav-link"><i class=" glyphicon glyphicon-plus-sign"></i><span class="title"><?php echo $menu['main_beds'];?></span>
                                    </a>
                                </li>
                                <li class="nav-item" id="li18">
                                    <a href="<?php echo site_url();?>wards" class="nav-link"><i class=" glyphicon glyphicon-plus-sign"></i><span class="title"><?php echo $menu['main_wards'];?></span>
                                    </a>
                                </li> 
                                <li class="nav-item" id="li4">
                                    <a href="<?php echo site_url();?>doctors" class="nav-link"><i class=" fa  fa-stethoscope "></i><span class="title"><?php echo $menu['main_dectors'];?> </span>
                                    </a>
                                </li>
                                <li class="nav-item" id="li5">
                                    <a href="<?php echo site_url();?>nurse" class="nav-link"><i class="icon  icon-user "></i><span class="title"><?php echo $menu['main_nurses'];?></span>
                                    </a>
                                </li>
                                <li class="nav-item" id="li6">
                                    <a href="<?php echo site_url();?>receptionist" class="nav-link"><i class="  icon-user-following "></i><span class="title"><?php echo $menu['main_receptionists'];?></span>
                                    </a>
                                </li>
                                <li class="nav-item" id="li7">
                                    <a href="<?php echo site_url();?>patients" class="nav-link"><i class="icon icon-users "></i><span class="title"><?php echo $menu['main_patients'];?></span>
                                    </a>
                                </li>
                                <li class="nav-item" id="li8">
                                    <a href="<?php echo site_url();?>medical_store" class="nav-link"><i class=" fa fa-medkit "></i><span class="title"><?php echo $menu['main_medical_stores'];?></span>
                                    </a>
                                </li>
                                <li class="nav-item" id="li9">
                                    <a href="<?php echo site_url();?>medical_lab" class="nav-link"><i class=" fa-plus-square "></i><span class="title"><?php echo $menu['main_medical_labs'];?></span>
                                    </a>
                                </li>
                                <li class="nav-item" id="li52">
                                    <a href="<?php echo site_url();?>appoitments" class="nav-link"><i class=" glyphicon glyphicon-list-alt"></i><span class="title"><?php echo $menu['appoitments'];?></span>
                                    </a>
                                </li>
                                <li class="nav-item" id="li11">
                                    <a href="<?php echo site_url();?>" class="nav-link"><i class="fa-credit-card "></i><span class="title"><?php echo $menu['main_payments'];?></span>
                                    </a>
                                </li>
                                <!--<li class="nav-item" id="li12">
                                    <a href="<?php echo site_url();?>" class="nav-link"><i class="  icon-bar-chart "></i><span class="title"><?php echo $menu['main_reports'];?></span>
                                    </a>
                                </li>-->
                          

                                <!--<li id="li12" class="nav-item">
                                    <a href="#" class="nav-link nav-toggle">
                                        <i class="glyphicon glyphicon-bullhorn"></i>
                                        <span><?php echo $menu['main_services'];?></span><span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li id="li1201" class="nav-item"><a class="nav-link " href="<?php echo site_url();?>"><?php echo $menu['main_ambulance'];?></a></li>
                                        <li id="li1201" class="nav-item"><a class="nav-link " href="<?php echo site_url();?>" ><?php echo $menu['main_bood_bank'];?></a></li>
                                        <li id="li1201" class="nav-item"><a class="nav-link " href="<?php echo site_url();?>" ><?php echo $menu['main_insurance'];?></a></li>
                                        
                                    </ul>
                                </li>-->

                                <li id="li17" class="nav-item">
                                    <a href="#" class="nav-link nav-toggle">
                                        <i class="glyphicon glyphicon-cog"></i>
                                        <span><?php echo $menu['main_settings'];?></span><span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li id="li1701" class="nav-item"><a class="nav-link " href="<?php echo site_url();?>charges"><?php echo $menu['main_charges'];?></a></li>
                                        <li id="li1702" class="nav-item"><a class="nav-link " href="<?php echo site_url();?>hospitals/about"><?php echo $menu['main_about'];?></a></li>
                                    </ul>
                                </li>

                            <?php
                                break;
                                case $this->auth->getPatientRoleType():
                            ?>
                                <li class="nav-item" id="li52">
                                    <a href="<?php echo site_url();?>appoitments" class="nav-link"><i class="  glyphicon glyphicon-list-alt "></i><span class="title"><?php echo $menu['appoitments'];?></span>
                                    </a>
                                </li>
                                <li class="nav-item" id="li55">
                                    <a href="<?php echo site_url();?>patients/inpatient" class="nav-link"><i class="  fa fa-credit-card"></i><span class="title"><?php echo $menu['main_inpatient_history'];?></span>
                                    </a>
                                </li>
                                <!--<li id="li51"><a href="<?php //echo site_url();?>patients/profile" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-user"></span><p><?php //echo $menu['profile'];?></p></a></li>-->
                                <!--<li id="li53"><a href="<?php echo site_url();?>" class="waves-effect waves-button"><span class="menu-icon fa fa-credit-card "></span><p><?php echo $menu['main_payments'];?></p></a></li>-->
                               
                                <!--<li id="li54" class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-cog"></span><p><?php echo $menu['main_settings'];?></p><span class="arrow"></span></a>
                                    <ul class="sub-menu">
                                        
                                    </ul>
                                </li>-->
                            <?php    
                                break;
                                case $this->auth->getReceptienstRoleType():
                            ?>
                                <li class="nav-item" id="li4">
                                    <a href="<?php echo site_url();?>doctors" class="nav-link"><i class="  fa  fa-stethoscope "></i><span class="title"><?php echo $menu['main_dectors'];?></span>
                                    </a>
                                </li>
                                <li class="nav-item" id="li52">
                                    <a href="<?php echo site_url();?>appoitments" class="nav-link"><i class="  glyphicon glyphicon-list-alt"></i><span class="title"><?php echo $menu['appoitments'];?></span>
                                    </a>
                                </li>
                            <?php
                                break;
                                case $this->auth->getNurseRoleType():
                            ?>
                                 <li class="nav-item" id="li4">
                                    <a href="<?php echo site_url();?>doctors" class="nav-link"><i class="  fa  fa-stethoscope "></i><span class="title"><?php echo $menu['main_dectors'];?></span>
                                    </a>
                                </li>
                                <li class="nav-item" id="li5">
                                    <a href="<?php echo site_url();?>nurse/beds" class="nav-link"><i class="  fa fa-bed"></i><span class="title"><?php echo $menu['main_beds'];?></span>
                                    </a>
                                </li>
                                <li class="nav-item" id="li6">
                                    <a href="<?php echo site_url();?>nurse/inpatient" class="nav-link"><i class="  fa fa-users"></i><span class="title"><?php echo $menu['main_patients'];?></span>
                                    </a>
                                </li>
                            <?php
                                    
                                break;
                                case $this->auth->getDoctorRoleType():
                            ?>
                                <li class="nav-item" id="li52">
                                    <a href="<?php echo site_url();?>appoitments" class="nav-link"><i class=" glyphicon glyphicon-list-alt"></i><span class="title"><?php echo $menu['appoitments'];?></span>
                                    </a>
                                </li>

                                <li id="li60" class="nav-item">
                                    <a href="#" class="nav-link nav-toggle">
                                        <i class="glyphicon glyphicon-cog"></i>
                                        <span><?php echo $menu['main_settings'];?></span><span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li id="li601" class="nav-item"><a class="nav-link " href="<?php echo site_url();?>doctors/availability"><?php echo $menu['main_availability'];?></a></li>
                                    </ul>
                                </li>
                            <?php
                                break;
                                case $this->auth->getMedicalLabRoleType():
                            ?>
                                
                                <li class="nav-item" id="li81">
                                    <a href="<?php echo site_url();?>medical_lab/reports" class="nav-link"><i class=" glyphicon glyphicon-list-alt"></i><span class="title"><?php echo $menu['reports'];?></span>
                                    </a>
                                </li>
                                
                                <li id="li80" class="nav-item">
                                    <a href="#" class="nav-link nav-toggle">
                                        <i class="glyphicon glyphicon-cog"></i>
                                        <span><?php echo $menu['main_settings'];?></span><span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li id="li801" class="nav-item"><a class="nav-link " href="<?php echo site_url();?>medical_lab/about"><?php echo $menu['main_about'];?></a></li>
                                       
                                    </ul>
                                </li>
                            <?php
                                break;
                                case $this->auth->getMedicalStoreRoleType():
                            ?>
                    
                                <li class="nav-item" id="li81">
                                    <a href="<?php echo site_url();?>medical_store/orders" class="nav-link"><i class=" glyphicon glyphicon-list-alt"></i><span class="title"><?php echo $menu['orders'];?></span>
                                    </a>
                                </li>
                                <li id="li80" class="nav-item">
                                    <a href="#" class="nav-link nav-toggle">
                                        <i class="glyphicon glyphicon-cog"></i>
                                        <span><?php echo $menu['main_settings'];?></span><span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li id="li801" class="nav-item"><a class="nav-link " href="<?php echo site_url();?>medical_store/about"><?php echo $menu['main_about'];?></a></li>
                                       
                                    </ul>
                                </li>
                            <?php
                                break;
                                default:
                                    break;
                            }

                            ?>
                            
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end sidebar menu --> 

            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content" id="_pageContent_" >
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <!--<div class=" pull-left">
                                <div class="page-title"><?php //echo $page_title; ?></div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <?php 
                                    //foreach ($breadcrumb as $key => $value) {
                                    //    if($key == null)
                                    //        echo "<li class='active'><a>$value</a></li>";
                                    //    else
                                    //        echo "<li><a href='$key'>$value</a></li>";
                                    //}
                                ?>
                            </ol>-->
                        </div>
                    </div>