<div class="page-sidebar sidebar">
                <div class="page-sidebar-inner slimscroll">
                    <div class="sidebar-header">
                        <div class="sidebar-profile">
                            <a href="<?php echo site_url();?>/index/profile" id="profile-menu-link">
                                <div class="sidebar-profile-image">
                                    <img src="<?php echo $this->auth->getProfileImg();?>" class="img-circle img-responsive" alt="">
                                </div>
                                <div class="sidebar-profile-details">
                                    <span><?php echo $this->auth->getUsername(); ?><br><small><?php echo $this->auth->getRoleText();?></small></span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php
                        $menu = $_SESSION['menu'];
                    ?>
                    <ul class="menu accordion-menu">
                        <li id="li1"><a href="<?php echo site_url();?>" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p><?php echo $menu['main_dashboard'];?></p></a></li>
                        <?php

                        switch ($this->auth->getRole()) {
                            case $this->auth->getAdminRoleType():
                            //Super Admin
                        ?>
                            
                            <li id="li2" class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon fa fa-hospital-o"></span><p><?php echo $menu['main_hospitals'];?></p><span class="arrow"></span></a>
                                <ul class="sub-menu">
                                    <li id="li201"><a href="<?php echo site_url();?>/hospitals"><?php echo $menu['main_hospitals'];?></a></li>
                                    <li id="li202"><a href="<?php echo site_url();?>/branches" ><?php echo $menu['main_branches'];?></a></li>
                                    <li id="li203"><a href="<?php echo site_url();?>/departments" ><?php echo $menu['main_departments'];?></a></li>
                                    <li id="li206"><a href="<?php echo site_url();?>/wards/" ><?php echo $menu['main_wards'];?></a></li> 
                                    <li id="li204"><a href="<?php echo site_url();?>/beds" ><?php echo $menu['main_beds'];?></a></li>
                                    <li id="li205"><a href="<?php echo site_url();?>/charges/" ><?php echo $menu['main_charges'];?></a></li> 
                                </ul>
                            </li>
                            <li id="li14"><a href="<?php echo site_url();?>/hospital_admin" class="waves-effect waves-button"><span class="menu-icon fa  fa-users "></span><p><?php echo $menu['main_hospital_admin'];?></p></a></li> 
                            <li id="li4"><a href="<?php echo site_url();?>/doctors" class="waves-effect waves-button"><span class="menu-icon fa  fa-stethoscope "></span><p><?php echo $menu['main_dectors'];?> </p></a></li>
                            <li id="li5"><a href="<?php echo site_url();?>/nurse" class="waves-effect waves-button"><span class="menu-icon  icon-user "></span><p><?php echo $menu['main_nurses'];?></p></a></li>
                            <li id="li6"><a href="<?php echo site_url();?>/receptionist" class="waves-effect waves-button"><span class="menu-icon  icon-user-following "></span><p><?php echo $menu['main_receptionists'];?></p></a></li>
                            <li id="li7"><a href="<?php echo site_url();?>/patients" class="waves-effect waves-button"><span class="menu-icon icon-users "></span><p><?php echo $menu['main_patients'];?></p></a></li>
                            <li id="li8"><a href="<?php echo site_url();?>/medical_store" class="waves-effect waves-button"><span class="menu-icon fa fa-medkit "></span><p><?php echo $menu['main_medical_stores'];?></p></a></li>
                            <li id="li9"><a href="<?php echo site_url();?>/medical_lab" class="waves-effect waves-button"><span class="menu-icon fa  fa-plus-square "></span><p><?php echo $menu['main_medical_labs'];?></p></a></li>
                            <li id="li52"><a href="<?php echo site_url();?>/appoitments" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-list-alt"></span><p><?php echo $menu['appoitments'];?></p></a></li>
                            <li id="li11"><a href="<?php echo site_url();?>" class="waves-effect waves-button"><span class="menu-icon fa fa-credit-card "></span><p><?php echo $menu['main_payments'];?></p></a></li>
                            <li id="li12"><a href="<?php echo site_url();?>" class="waves-effect waves-button"><span class="menu-icon  icon-bar-chart "></span><p><?php echo $menu['main_reports'];?></p></a></li>
                      
                            <li id="li12" class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon  glyphicon glyphicon-bullhorn"></span><p><?php echo $menu['main_services'];?></p><span class="arrow"></span></a>
                                <ul class="sub-menu">
                                    <li id="li1201"><a href="<?php echo site_url();?>/" ><?php echo $menu['main_ambulance'];?></a></li>
                                    <li id="li1201"><a href="<?php echo site_url();?>/" ><?php echo $menu['main_bood_bank'];?></a></li>
                                    <li id="li1201"><a href="<?php echo site_url();?>/" ><?php echo $menu['main_insurance'];?></a></li>
                                </ul>
                            </li>

                            <li id="li13" class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-cog"></span><p><?php echo $menu['main_settings'];?></p><span class="arrow"></span></a>
                                <ul class="sub-menu">
                                    <li id="li1301"><a href="<?php echo site_url();?>/license/" ><?php echo $menu['main_license_category'];?></a></li>
                                    <li id="li1302"><a href="<?php echo site_url();?>/healthinsuranceprovider/" ><?php echo $menu['main_healthinsuranceprovider'];?></a></li>
                                </ul>
                            </li>
                            
                        <?php
                            break;
                            case $this->auth->getHospitalAdminRoleType():
                            //Hospital Admin                                
                        ?>
                            <li id="li13"><a href="<?php echo site_url();?>/branches" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-plus-sign"></span><p><?php echo $menu['main_branches'];?></p></a></li>
                            <li id="li3"><a href="<?php echo site_url();?>/departments" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-plus-sign"></span><p><?php echo $menu['main_departments'];?></p></a></li>
                            <li id="li14"><a href="<?php echo site_url();?>/beds" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-plus-sign"></span><p><?php echo $menu['main_beds'];?></p></a></li>
                            <li id="li18"><a href="<?php echo site_url();?>/wards/" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-plus-sign"></span><p><?php echo $menu['main_wards'];?></p></a></li> 
                            <li id="li4"><a href="<?php echo site_url();?>/doctors" class="waves-effect waves-button"><span class="menu-icon fa  fa-stethoscope "></span><p><?php echo $menu['main_dectors'];?> </p></a></li>
                            <li id="li5"><a href="<?php echo site_url();?>/nurse" class="waves-effect waves-button"><span class="menu-icon  icon-user "></span><p><?php echo $menu['main_nurses'];?></p></a></li>
                            <li id="li6"><a href="<?php echo site_url();?>/receptionist" class="waves-effect waves-button"><span class="menu-icon  icon-user-following "></span><p><?php echo $menu['main_receptionists'];?></p></a></li>
                            <li id="li7"><a href="<?php echo site_url();?>/patients" class="waves-effect waves-button"><span class="menu-icon icon-users "></span><p><?php echo $menu['main_patients'];?></p></a></li>
                            <li id="li8"><a href="<?php echo site_url();?>/medical_store" class="waves-effect waves-button"><span class="menu-icon fa fa-medkit "></span><p><?php echo $menu['main_medical_stores'];?></p></a></li>
                            <li id="li9"><a href="<?php echo site_url();?>/medical_lab" class="waves-effect waves-button"><span class="menu-icon fa  fa-plus-square "></span><p><?php echo $menu['main_medical_labs'];?></p></a></li>
                            <li id="li52"><a href="<?php echo site_url();?>/appoitments" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-list-alt"></span><p><?php echo $menu['appoitments'];?></p></a></li>
                            <li id="li11"><a href="<?php echo site_url();?>" class="waves-effect waves-button"><span class="menu-icon fa fa-credit-card "></span><p><?php echo $menu['main_payments'];?></p></a></li>
                            <li id="li12"><a href="<?php echo site_url();?>" class="waves-effect waves-button"><span class="menu-icon  icon-bar-chart "></span><p><?php echo $menu['main_reports'];?></p></a></li>
                      
                            <li id="li12" class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon  glyphicon glyphicon-bullhorn"></span><p><?php echo $menu['main_services'];?></p><span class="arrow"></span></a>
                                <ul class="sub-menu">
                                    <li id="li1201"><a href="<?php echo site_url();?>/" ><?php echo $menu['main_ambulance'];?></a></li>
                                    <li id="li1201"><a href="<?php echo site_url();?>/" ><?php echo $menu['main_bood_bank'];?></a></li>
                                    <li id="li1201"><a href="<?php echo site_url();?>/" ><?php echo $menu['main_insurance'];?></a></li>
                                </ul>
                            </li>

                            <li id="li17" class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-cog"></span><p><?php echo $menu['main_settings'];?></p><span class="arrow"></span></a>
                                <ul class="sub-menu">
                                    <li id="li1701"><a href="<?php echo site_url();?>/charges/" ><?php echo $menu['main_charges'];?></a></li> 
                                </ul>
                            </li>
                        <?php
                            break;
                            case $this->auth->getPatientRoleType():
                        ?>
                            <!--<li id="li51"><a href="<?php //echo site_url();?>/patients/profile" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-user"></span><p><?php //echo $menu['profile'];?></p></a></li>-->
                            <li id="li52"><a href="<?php echo site_url();?>/appoitments" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-list-alt"></span><p><?php echo $menu['appoitments'];?></p></a></li>
                            <!--<li id="li53"><a href="<?php echo site_url();?>" class="waves-effect waves-button"><span class="menu-icon fa fa-credit-card "></span><p><?php echo $menu['main_payments'];?></p></a></li>-->
                            <li id="li55"><a href="<?php echo site_url();?>/patients/inpatient" class="waves-effect waves-button"><span class="menu-icon fa fa-credit-card "></span><p><?php echo $menu['main_inpatient_history'];?></p></a></li>
                            <li id="li55"><a href="<?php echo site_url();?>" class="waves-effect waves-button"><span class="menu-icon fa fa-credit-card "></span><p><?php echo $menu['main_inpatient_history'];?></p></a></li>

                            <!--<li id="li54" class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-cog"></span><p><?php echo $menu['main_settings'];?></p><span class="arrow"></span></a>
                                <ul class="sub-menu">
                                    
                                </ul>
                            </li>-->
                        <?php    
                            break;
                            case $this->auth->getReceptienstRoleType():
                        ?>
                            <li id="li4"><a href="<?php echo site_url();?>/doctors" class="waves-effect waves-button"><span class="menu-icon fa  fa-stethoscope "></span><p><?php echo $menu['main_dectors'];?> </p></a></li>
                            <li id="li52"><a href="<?php echo site_url();?>/appoitments" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-list-alt"></span><p><?php echo $menu['appoitments'];?></p></a></li>
                        <?php
                            break;
                            case $this->auth->getNurseRoleType():
                        ?>
                            <li id="li4"><a href="<?php echo site_url();?>/doctors" class="waves-effect waves-button"><span class="menu-icon fa  fa-stethoscope "></span><p><?php echo $menu['main_dectors'];?> </p></a></li>
                            <li id="li5"><a href="<?php echo site_url();?>/nurse/beds" class="waves-effect waves-button"><span class="menu-icon fa  fa-bed "></span><p><?php echo $menu['main_beds'];?> </p></a></li>
                            <li id="li6"><a href="<?php echo site_url();?>/nurse/inpatient" class="waves-effect waves-button"><span class="menu-icon fa fa-users "></span><p><?php echo $menu['main_patients'];?> </p></a></li>
                        <?php
                                
                            break;
                            case $this->auth->getDoctorRoleType():
                        ?>
                            <li id="li52"><a href="<?php echo site_url();?>/appoitments" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-list-alt"></span><p><?php echo $menu['appoitments'];?></p></a></li>
                            <li id="li60" class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-cog"></span><p><?php echo $menu['main_settings'];?></p><span class="arrow"></span></a>
                                <ul class="sub-menu">
                                    <li id="li601"><a href="<?php echo site_url();?>/doctors/availability" ><?php echo $menu['main_availability'];?></a></li>
                                    <!--<li id="li602"><a href="<?php //echo site_url();?>/doctors/othersetting" ><?php e//cho $menu['main_other'];?></a></li>-->
                                </ul>
                            </li>
                        <?php
                            break;
                            case $this->auth->getMedicalLabRoleType():
                        ?>
                            <li id="li81"><a href="<?php echo site_url();?>/medical_lab/reports" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-list-alt"></span><p><?php echo $menu['reports'];?></p></a></li>
                            <li id="li80" class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-cog"></span><p><?php echo $menu['main_settings'];?></p><span class="arrow"></span></a>
                                <ul class="sub-menu">
                                    <li id="li801"><a href="<?php echo site_url();?>/medical_lab/about" ><?php echo $menu['main_about'];?></a></li>
                                    <!--<li id="li602"><a href="<?php //echo site_url();?>/doctors/othersetting" ><?php e//cho $menu['main_other'];?></a></li>-->
                                </ul>
                            </li>
                        <?php
                            break;
                            case $this->auth->getMedicalStoreRoleType():
                        ?>
                            <li id="li81"><a href="<?php echo site_url();?>/medical_store/orders" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-list-alt"></span><p><?php echo $menu['orders'];?></p></a></li>
                            <li id="li80" class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-cog"></span><p><?php echo $menu['main_settings'];?></p><span class="arrow"></span></a>
                                <ul class="sub-menu">
                                    <li id="li801"><a href="<?php echo site_url();?>/medical_store/about" ><?php echo $menu['main_about'];?></a></li>
                                    <!--<li id="li602"><a href="<?php //echo site_url();?>/doctors/othersetting" ><?php e//cho $menu['main_other'];?></a></li>-->
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

                <!--<div class="" style="margin-left: 50px;margin-right: 50px;margin-top: 20px"> 
                    <?php //$this->load->view('template/alert'); ?>
                </div>-->