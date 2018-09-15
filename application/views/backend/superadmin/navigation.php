<div class="sidebar-menu">
    <header class="logo-env" >

        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url();?>assets/logo.png"  style="max-height:44px;"/>
            </a>
        </div>  
    
        <!-- logo collapse icon -->   
        <div class="sidebar-collapse" style="">
            <a href="#" class="sidebar-collapse-icon with-animation">

                <i class="entypo-menu"></i>
            </a> 
        </div>   
  
        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
        <div class="sidebar-mobile-menu visible-xs">
            <a href="#" class="with-animation">
                <i class="entypo-menu"></i>
            </a>
        </div>
    </header>
    <div class="sidebar-user-info">

        <div class="sui-normal">
            <a href="#" class="user-link">
                <img src="<?php echo $this->crud_model->get_image_url($this->session->userdata('login_type'), $this->session->userdata('login_user_id'));?>" alt="" class="img-circle" style="height:44px;">

                <!--<span><?php echo get_phrase('welcome'); ?>,</span>-->
                <strong><?php
                    echo $this->db->get_where($this->session->userdata('login_type'), array($this->session->userdata('login_type') . '_id' =>
                        $this->session->userdata('login_user_id')))->row()->name;
                    ?>
                </strong>
            </a>
        </div>

       
    </div>


    <div style="border-top:1px solid rgba(69, 74, 84, 0.7);"></div>	
    <ul id="main-menu" class="">
      
        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?superadmin/dashboard">
                <i class="fa fa-desktop"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'manage_hospital') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?superadmin/hospital">
                <i class="fa fa-sitemap"></i>
                <span><?php echo get_phrase('hospitals'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'manage_admins') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?superadmin/hospital_admins">
                <i class="fa fa-sitemap"></i>
                <span><?php echo get_phrase('hospital_admins'); ?></span>
            </a>
        </li>
        <!-- SETTINGS -->
        <!--
         
        <li class="<?php if ($page_name == 'manage_hospital' || $page_name == 'manage_admins' || $page_name == 'manage_branch' || $page_name == 'manage_department' || $page_name == 'manage_ward' || $page_name == 'manage_bed') echo 'opened active';?> ">
            <a href="#">
                <i class="fa fa-wrench"></i>
                <span><?php echo get_phrase('manage_hospitals'); ?></span>
            </a>
            <ul>
                        <li class="<?php if ($page_name == 'manage_hospital') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?superadmin/hospital">
                <i class="fa fa-sitemap"></i>
                <span><?php echo get_phrase('hospitals'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'manage_admins') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?superadmin/hospital_admins">
                <i class="fa fa-sitemap"></i>
                <span><?php echo get_phrase('hospital_admins'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'manage_branch') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?superadmin/branch">
                <i class="fa fa-sitemap"></i>
                <span><?php echo get_phrase('branchs'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'manage_department') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?superadmin/department">
                <i class="fa fa-sitemap"></i>
                <span><?php echo get_phrase('departments'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'manage_ward') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?superadmin/ward">
                <i class="fa fa-sitemap"></i>
                <span><?php echo get_phrase('wards'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'manage_bed') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?superadmin/bed">
                <i class="fa fa-sitemap"></i>
                <span><?php echo get_phrase('beds'); ?></span>
            </a>
        </li>
            </ul>
        </li>-->
        
        
        <li class="<?php if ($page_name == 'manage_doctor') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>index.php?superadmin/doctor">
                <i class="fa fa-user-md"></i>
                <span><?php echo get_phrase('doctors'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'manage_nurse') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?superadmin/nurse">
                <i class="fa fa-plus-square"></i>
                <span><?php echo get_phrase('nurses'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'manage_receptionist') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?superadmin/receptionist">
                <i class="fa fa-plus-square"></i>
                <span><?php echo get_phrase('receptionists'); ?></span>
            </a>
        </li>
         <li class="<?php if ($page_name == 'manage_users') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>index.php?superadmin/patient">
                <i class="fa fa-user-md"></i>
                <span><?php echo get_phrase('mypulse_users'); ?></span>
            </a>
        </li>
        
         <li class="<?php if ($page_name == 'manage_stores') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>index.php?superadmin/medical_stores">
                <i class="fa fa-user-md"></i>
                <span><?php echo get_phrase('medical_stores'); ?></span>
            </a>
        </li>
        
        <li class="<?php if ($page_name == 'manage_labs') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>index.php?superadmin/medical_labs">
                <i class="fa fa-user-md"></i>
                <span><?php echo get_phrase('medical_labs'); ?></span>
            </a>
        </li>
        
        <!-- patient -->
        <!--<li class="<?php if ($page_name == 'manage_patient' || $page_name == 'manage_outpatient') echo 'opened active';?> ">
            <a href="#">
                <i class="fa fa-user"></i>
                <span><?php echo get_phrase('patient Details'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'manage_patient') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?superadmin/patient">
                        <span> <i class="fa fa-user"></i> <?php echo get_phrase('inpatient'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'manage_outpatient') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?superadmin/outpatient">
                        <span> <i class="fa fa-user"></i> <?php echo get_phrase('outpatient'); ?></span>
                    </a>
                </li>
               
            </ul>
        </li>-->
          <!--<li class="<?php if ($page_name == 'income / expense') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?superadmin/patient_expense">
                <i class="fa fa-user"></i>
                <span><?php echo get_phrase('income / expense'); ?></span>
            </a>
        </li>-->
        <!--<li class="<?php if ($page_name == 'manage_bed') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?superadmin/beds">
                <i class="fa fa-hdd-o"></i>
                <span><?php echo get_phrase('bed_/_ward'); ?></span>
            </a>
        </li>-->
        <!--<li class="<?php if ($page_name == 'health_checkup') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?superadmin/checkups">
                <i class="fa fa-user-md"></i>
                <span><?php echo get_phrase('health check-up list'); ?></span>
            </a>
        </li>-->
       
        
        
        <!--<li class="<?php if ($page_name == 'manage_pharmacist') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?superadmin/pharmacist">
                <i class="fa fa-medkit"></i>
                <span><?php echo get_phrase('pharmacist'); ?></span>
            </a>
        </li>-->
        
       <!-- <li class="<?php if ($page_name == 'manage_laboratorist') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?superadmin/laboratorist">
                <i class="fa fa-user"></i>
                <span><?php echo get_phrase('laboratorist'); ?></span>
            </a>
        </li>-->
        
        <!--<li class="<?php if ($page_name == 'manage_accountant') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?superadmin/accountant">
                <i class="fa fa-money"></i>
                <span><?php echo get_phrase('accountant'); ?></span>
            </a>
        </li>-->
        
        

       <!-- <li class="<?php if ($page_name == 'manage_rmp') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>index.php?superadmin/rmp">
                <i class="fa fa-user-md"></i>
                <span><?php echo get_phrase('rmp doctor'); ?></span>
            </a>
        </li>-->


        
   <!-- <li class="<?php if ($page_name == 'show_payment_history'   || $page_name == 'show_bed_allotment'
                            || $page_name == 'show_blood_bank'      || $page_name == 'show_blood_donor'
                            || $page_name == 'show_medicine'        || $page_name == 'show_operation_report' 
                            || $page_name == 'show_birth_report'    || $page_name == 'show_death_report') 
                        echo 'opened active';?> ">
            <a href="#">
                <i class="entypo-target"></i>
                <span><?php echo get_phrase('monitor_hospital'); ?></span>
            </a>-->
         <!--   <ul>
                <li class="<?php if ($page_name == 'show_payment_history') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?superadmin/payment_history">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('payment_history'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'show_bed_allotment') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?superadmin/bed_allotment">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('bed_allotment'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'show_blood_bank') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?superadmin/blood_bank">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('blood_bank'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'show_blood_donor') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?superadmin/blood_donor">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('blood_donor'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'show_medicine') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?superadmin/medicine">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('medicine'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'show_operation_report') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?superadmin/operation_report">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('operation_report'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'show_birth_report') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?superadmin/birth_report">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('birth_report'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'show_death_report') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?superadmin/death_report">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('death_report'); ?></span>
                    </a>
                </li>
            </ul>-->
        <!--</li>-->



       <!-- 
        <li class="<?php if ($page_name == 'manage_notice') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?superadmin/notice">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('noticeboard'); ?></span>
            </a>
        </li>-->

        <!-- SETTINGS -->
        <li class="<?php if ($page_name == 'system_settings' || $page_name == 'manage_language' ||
                            $page_name == 'sms_settings') echo 'opened active';?> ">
            <a href="#">
                <i class="fa fa-wrench"></i>
                <span><?php echo get_phrase('settings'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'system_settings') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?superadmin/system_settings">
                        <span><i class="fa fa-h-square"></i> <?php echo get_phrase('system_settings'); ?></span>
                    </a>
                </li>
               <!-- <li class="<?php if ($page_name == 'manage_language') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?superadmin/manage_language">
                        <span><i class="fa fa-globe"></i> <?php echo get_phrase('language_settings'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'sms_settings') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?superadmin/sms_settings">
                        <span><i class="entypo-paper-plane"></i> <?php echo get_phrase('sms_settings'); ?></span>
                    </a>
                </li>-->
            </ul>
        </li>
             <!-- SETTINGS -->
        <li class="<?php if ($page_name == 'country' || $page_name == 'state' || $page_name == 'district' || $page_name == 'city'  || $page_name == 'license'  || $page_name == 'health_insurance_provider') echo 'opened active';?> ">
            <a href="#">
                <i class="fa fa-wrench"></i>
                <span><?php echo get_phrase('general_settings'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'country') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?superadmin/country">
                        <span><i  class="entypo-paper-plane"></i> <?php echo get_phrase('country'); ?></span>
                    </a>
                </li>
               <li class="<?php if ($page_name == 'state') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?superadmin/state">
                        <span><i  class="entypo-paper-plane"></i> <?php echo get_phrase('state'); ?></span>  
                    </a>
                </li>
                <li class="<?php if ($page_name == 'district') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?superadmin/district">
                        <span><i class="entypo-paper-plane"></i> <?php echo get_phrase('district'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'city') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?superadmin/city">
                        <span><i class="entypo-paper-plane"></i> <?php echo get_phrase('city'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'license') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?superadmin/license">
                        <span><i class="entypo-paper-plane"></i> <?php echo get_phrase('license'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'health_insurance_provider') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?superadmin/health_insurance_provider">
                        <span><i class="entypo-paper-plane"></i> <?php echo get_phrase('health_insurance_provider'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- ACCOUNT -->
        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?superadmin/profile">
                <i class="entypo-lock"></i>
                <span><?php echo get_phrase('account'); ?></span>
            </a>
        </li>



    </ul>

</div>