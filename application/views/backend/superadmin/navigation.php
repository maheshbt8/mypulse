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
                <img src="<?php echo $this->crud_model->get_image_url($this->session->userdata('login_type'), $this->session->userdata('login_user_id'));?>" alt="" class="img-circle" style="height:64px;">

                <!--<span><?php echo get_phrase('welcome'); ?>,</span>-->
                <strong><?php
                    echo $this->db->get_where($this->session->userdata('login_type'), array($this->session->userdata('login_type') . '_id' =>
                        $this->session->userdata('login_user_id')))->row()->name;
                    ?>
                </strong>
            </a>
        </div>

       
    </div>

 <?php
                                
                                $menu = $_SESSION['menu'];
                            ?>
    <div style="border-top:1px solid rgba(69, 74, 84, 0.7);"></div>	
    <ul id="main-menu" class="">
      
        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?superadmin/dashboard">
                <i class="glyphicon glyphicon-home"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'manage_hospital') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?superadmin/hospital">
                <i class="fa  fa-hospital-o "></i>
                <span><?php echo get_phrase('hospitals'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'manage_admins') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?superadmin/hospital_admins">
                <i class="fa fa-users"></i>
                <span><?php echo get_phrase('hospital_admins'); ?></span>
            </a>
        </li>
       <!-- 
         
     
        <li class="<?php if ($page_name == 'manage_branch') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?superadmin/branch">
                <i class="fa fa-sitemap"></i>
                <span><?php echo $menu['main_branches'];?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'manage_department') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?superadmin/department">
                <i class="fa fa-sitemap"></i>
                <span><?php echo $menu['main_departments'];?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'manage_ward') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?superadmin/ward">
                <i class="fa fa-sitemap"></i>
                <span><?php echo $menu['main_wards'];?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'manage_bed') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?superadmin/bed">
                <i class="fa fa-sitemap"></i>
                <span><?php echo $menu['main_beds'];?></span>
            </a>
        </li>
           
         -->
        
        <li class="<?php if ($page_name == 'manage_doctor') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>index.php?superadmin/doctor">
                <i class="fa fa-user-md"></i>
                <span><?php echo get_phrase('doctors'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'manage_nurse') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?superadmin/nurse">
                <i class="fa fa-user"></i>
                <span><?php echo get_phrase('nurses'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'manage_receptionist') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?superadmin/receptionist">
                <i class="fa fa-user"></i>
                <span><?php echo get_phrase('receptionists'); ?></span>
            </a>
        </li>
      
        
         <li class="<?php if ($page_name == 'manage_stores') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>index.php?superadmin/medical_stores">
                <i class="menu-icon fa fa-medkit "></i>
                <span><?php echo get_phrase('medical_stores'); ?></span>
            </a>
        </li>
        
        <li class="<?php if ($page_name == 'manage_labs') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>index.php?superadmin/medical_labs">
                <i class="menu-icon fa  fa-plus-square "></i>
                <span><?php echo get_phrase('medical_labs'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'manage_users') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>index.php?superadmin/users">
                <i class="fa fa-users"></i>
                <span><?php echo get_phrase('myPulse_users'); ?></span>
            </a>
        </li>
        <li class="#">
            <a href="">
                <i class="menu-icon fa fa-eye "></i>
                <span><?php echo get_phrase('inpatients'); ?></span>
            </a>
        </li>
        <li class="">
            <a href="<?php echo base_url(); ?>index.php?superadmin/add_appointment">
                <i class="menu-icon glyphicon glyphicon-list-alt"></i>
                <span><?php echo get_phrase('appointments'); ?></span>
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



       
        <li class="<?php if ($page_name == 'manage_notice') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?superadmin/notice">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('noticeboard'); ?></span>
            </a>
        </li>

        <!-- SETTINGS -->
   <!--      <li class="<?php if ($page_name == 'system_settings' || $page_name == 'manage_language' ||
                            $page_name == 'sms_settings') echo 'opened active';?> ">
            <a href="#">
                <i class="fa fa-wrench"></i>
                <span><?php echo $menu['main_settings'];?></span>
            </a>
            <ul>
               
            </ul>
        </li> -->

         <li class="">
            <a href="#">
                <i class="glyphicon glyphicon-stats"></i>
                <span><?php echo get_phrase('reports'); ?></span>
            </a>
            <ul>
                 <li class="#">
                    <a href="#">
                        <span><?php echo get_phrase('patient_report'); ?></span>
                    </a>
                </li>
                <li class="#">
                    <a href="#">
                        <span><?php echo get_phrase('appointment_report'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
             <!-- SETTINGS -->

        <li class="<?php if ($page_name == 'country' || $page_name == 'state' || $page_name == 'district' || $page_name == 'city'  || $page_name == 'license'  || $page_name == 'health_insurance_provider') echo 'opened active';?> ">
            <a href="#">
                <i class="fa fa-wrench"></i>
                <span><?php echo get_phrase('general_settings'); ?></span>
            </a>
            <ul>
                 <li class="<?php if ($page_name == 'system_settings') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?superadmin/system_settings">
                        <span><i class="fa fa-h-square"></i> <?php echo get_phrase('system_settings'); ?></span>
                    </a>
                </li>
               <!-- <li class="<?php if ($page_name == 'manage_language') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?superadmin/manage_language">
                        <span><i class="fa fa-globe"></i><?php echo $menu['language_settings'];?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'sms_settings') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?superadmin/sms_settings">
                        <span><i class="entypo-paper-plane"></i> <?php echo $menu['sms_settings'];?></span>
                    </a>
                </li>-->
                <li class="<?php if ($page_name == 'country') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?superadmin/country">
                        <span><i  class="entypo-paper-plane"></i><?php echo get_phrase('countries'); ?></span>
                    </a>
                </li>
               <li class="<?php if ($page_name == 'state') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?superadmin/state">
                        <span><i  class="entypo-paper-plane"></i> <?php echo get_phrase('states'); ?></span>  
                    </a>
                </li>
                <li class="<?php if ($page_name == 'district') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?superadmin/district">
                        <span><i class="entypo-paper-plane"></i> <?php echo get_phrase('districts'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'city') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?superadmin/city">
                        <span><i class="entypo-paper-plane"></i> <?php echo get_phrase('cities'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'license') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?superadmin/license">
                        <span><i class="entypo-paper-plane"></i> <?php echo get_phrase('license_categories'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'health_insurance_provider') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?superadmin/health_insurance_provider">
                        <span><i class="entypo-paper-plane"></i> <?php echo get_phrase('health_insurance_providers'); ?></span>
                    </a>
                </li>

            </ul>
        </li>
        <li class="#">
            <a href="<?php echo base_url(); ?>index.php?superadmin/db_backup">
                <i class="database"></i>
                <span>DB Backup</span>
            </a>
        </li>
        <!-- ACCOUNT -->
     <!--    <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?superadmin/profile">
                <i class="entypo-lock"></i>
                <span><?php echo $menu['main_account'];?></span>
            </a>
        </li> -->



    </ul>

</div>