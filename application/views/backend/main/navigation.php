<div class="sidebar-menu">
    <header class="logo-env" >

        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url();?>assets/logo.png"  style="max-height:45px; margin: -15px;"/>
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

        <div class="sui-normal user-link">
           <?php
if($account_type == 'superadmin'){
  $img_type='superadmin_image';
}elseif($account_type == 'hospitaladmins'){
  $img_type='hospitaladmin_image';
}elseif($account_type == 'doctors'){
  $img_type='doctor_image';
}elseif($account_type == 'nurse'){
  $img_type='nurse_image';
}elseif($account_type == 'receptionist'){
  $img_type='receptionist_image';
}elseif($account_type == 'medicalstores'){
  $img_type='medical_stores';
}elseif($account_type == 'medicallabs'){
  $img_type='medical_labs';
}elseif($account_type == 'users'){
  $img_type='user_image';
}
if (file_exists('uploads/' . $img_type.'/' . $this->session->userdata('login_user_id') . '.jpg'))
      $image_url = base_url() . 'uploads/' . $img_type.'/' . $this->session->userdata('login_user_id') . '.jpg';
else
    $image_url = base_url() . 'uploads/user.jpg';
?>
               <a href="<?php echo base_url()?>main/manage_profile">
<img src="<?php echo $image_url;?>" alt="" class="img-circle" style="height:64px;">
<span> <?php
if($account_type == 'superadmin'){
  $user_role='Super Admin';
}elseif($account_type == 'hospitaladmins'){
  $user_role='Hospital Admin';
}elseif($account_type == 'doctors'){
  $user_role='Doctor';
}elseif($account_type == 'nurse'){
  $user_role='Nurse';
}elseif($account_type == 'receptionist'){
  $user_role='Receptionist';
}elseif($account_type == 'medicalstores'){
  $user_role='Pharmacist';
}elseif($account_type == 'medicallabs'){
  $user_role='Laboratorist';
}elseif($account_type == 'users'){
  $user_role='MyPulse Users';
}
echo $user_role; ?>
</span>
                <strong><?php
                    echo $this->db->get_where($this->session->userdata('login_type'), array($this->session->userdata('type_id') . '_id' =>
                        $this->session->userdata('login_user_id')))->row()->name;
                    ?>
                </strong></a>
                </div>
    </div>

 <?php $menu = $_SESSION['menu'];?>
    <div style="border-top:1px solid rgba(69, 74, 84, 0.7);"></div>	
    <ul id="main-menu" class="">
      
        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>main/dashboard">
                <i class="glyphicon glyphicon-home"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>
        <?php if($account_type=='superadmin' || $account_type=='users'){?>
      <li class="<?php if ($page_name == 'manage_hospital') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>main/hospital">
                <i class="fa  fa-hospital-o "></i>
                <span><?php echo get_phrase('hospitals'); ?></span>
            </a>
        </li>
    <?php }?>
        <?php if($account_type=='superadmin'){?>
        <li class="<?php if ($page_name == 'manage_admins') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>main/hospital_admins">
                <i class="fa fa-users"></i>
                <span><?php echo get_phrase('hospital_admins'); ?></span>
            </a>
        </li>
<?php }elseif($account_type=='hospitaladmins'){?>
        <li class="<?php if ($page_name == 'manage_branch') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>main/get_hospital_branch/<?= $this->session->userdata('hospital_id');?>">
                <i class="fa  fa-hospital-o "></i>
                <span><?php echo get_phrase('branches'); ?></span>
            </a>
        </li>
    <?php }?>
        <?php if($account_type=='superadmin' || $account_type=='hospitaladmins' || $account_type=='nurse' || $account_type=='receptionist' || $account_type=='users'){?>
        <li class="<?php if ($page_name == 'manage_doctor') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>main/doctor">
                <i class="fa fa-user-md"></i>
                <span><?php echo get_phrase('doctors'); ?></span>
            </a>
        </li>
    <?php }?>
    <?php if($account_type=='superadmin' || $account_type=='hospitaladmins' || $account_type=='doctors'){?>
        <li class="<?php if ($page_name == 'manage_receptionist') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>main/receptionist">
                <i class="fa fa-user"></i>
                <span><?php echo get_phrase('receptionists'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'manage_nurse') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>main/nurse">
                <i class="fa fa-user"></i>
                <span><?php echo get_phrase('nurses'); ?></span>
            </a>
        </li>
    <?php }?>
        <?php if($account_type=='superadmin' || $account_type=='hospitaladmins' || $account_type=='users'){?>
         <li class="<?php if ($page_name == 'manage_stores') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>main/medical_stores">
                <i class="menu-icon fa fa-medkit "></i>
                <span><?php echo get_phrase('medical_stores'); ?></span>
            </a>
        </li>
        
        <li class="<?php if ($page_name == 'manage_labs') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>main/medical_labs">
                <i class="menu-icon fa  fa-plus-square "></i>
                <span><?php echo get_phrase('medical_labs'); ?></span>
            </a>
        </li>
    <?php }?>
        <?php if($account_type=='superadmin'){?>
        <li class="<?php if ($page_name == 'manage_users') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>main/users">
                <i class="fa fa-users"></i>
                <span><?php echo get_phrase('myPulse_users'); ?></span>
            </a>
        </li>
    <?php }?>
    <?php if($account_type=='medicalstores' || $account_type=='medicallabs'){?>
        <li class="<?php if ($page_name == 'manage_order') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>main/orders">
                <i class="menu-icon glyphicon glyphicon-list-alt"></i>
                <span><?php echo get_phrase('orders'); ?></span>
            </a>
        </li>
    <?php }?>
    <?php if($account_type=='users'){?>
        <li class="<?php if ($page_name == 'manage_order') echo 'opened active';?> "">
            <a href="#">
                <i class="menu-icon glyphicon glyphicon-list-alt"></i>
                <span><?php echo get_phrase('orders'); ?></span>
            </a>
            <ul>
                 <li class="<?php if ($page_name == 'manage_order') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>main/orders/0">
                        <span><?php echo get_phrase('medicines'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'manage_order') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>main/orders/1">
                        <span><?php echo get_phrase('medical_tests'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- <li class="<?php if ($page_name == 'manage_order') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>main/orders">
                <i class="menu-icon glyphicon glyphicon-list-alt"></i>
                <span><?php echo get_phrase('orders'); ?></span>
            </a>
        </li> -->
    <?php }?>
    <?php if($account_type=='medicallabs'){?>
        <li class="<?php if ($page_name == '') echo 'active'; ?>">
            <a href="#">
                <i class="menu-icon glyphicon glyphicon-list-alt"></i>
                <span><?php echo get_phrase('reports'); ?></span>
            </a>
        </li>
    <?php }?>
    <?php if($account_type=='hospitaladmins' || $account_type=='doctors' || $account_type=='medicalstores' || $account_type=='medicallabs'){?>
        <li class="<?php if ($page_name == 'manage_patient') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>main/patient">
                <i class="fa fa-users"></i>
                <span><?php echo get_phrase('Patients'); ?></span>
            </a>
        </li>
    <?php }?>
    <?php if($account_type=='nurse'){?>
        <li class="<?php if ($page_name == 'manage_ward') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>main/get_hospital_ward/<?=$this->session->userdata('department_id')?>">
                <i class="fa fa-users"></i>
                <span><?php echo get_phrase('wards'); ?></span>
            </a>
        </li>
    <?php }?>
    <?php if($account_type=='nurse'){?>
    <!--     <li class="<?php if ($page_name == 'manage_beds') echo 'active'; ?>">
            <a href="#">
                <i class="fa fa-users"></i>
                <span><?php echo get_phrase('beds'); ?></span>
            </a>
        </li> -->
    <?php }?>
    <?php if($account_type=='superadmin' || $account_type=='hospitaladmins' || $account_type=='doctors' || $account_type=='users'  || $account_type=='nurse' || $account_type=='receptionist'){?>
        <li class="<?php if ($page_name == 'manage_inpatient') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>main/inpatient">
                <i class="menu-icon fa fa-eye"></i>
                <span><?php if($account_type == 'users'){echo get_phrase('in-Patient_history');}else{echo get_phrase('in-Patients'); }?></span>
            </a>
        </li>
    <?php }?>
    <?php if($account_type=='superadmin' || $account_type=='hospitaladmins' || $account_type=='doctors' || $account_type=='users' || $account_type=='receptionist' || $account_type=='nurse'){?>
        <li class="<?php if ($page_name == 'manage_appointment') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>main/appointment">
                <i class="menu-icon glyphicon glyphicon-list-alt"></i>
                <span><?php echo get_phrase('appointments'); ?></span>
            </a>
        </li>
    <?php }?>
        <?php if($account_type=='doctors'){?>
            <li class="<?php if ($page_name == 'add_availability') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>main/doctor_availability/<?php echo $this->session->userdata('login_user_id');?>">
                <i class="glyphicon glyphicon-calendar"></i>
                <span><?php echo get_phrase('availability'); ?></span>
            </a>
        </li>
        <?php }?>
        <!-- patient -->
        <!--<li class="<?php if ($page_name == 'manage_patient' || $page_name == 'manage_outpatient') echo 'opened active';?> ">
            <a href="#">
                <i class="fa fa-user"></i>
                <span><?php echo get_phrase('patient Details'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'manage_patient') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>main/patient">
                        <span> <i class="fa fa-user"></i> <?php echo get_phrase('inpatient'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'manage_outpatient') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>main/outpatient">
                        <span> <i class="fa fa-user"></i> <?php echo get_phrase('outpatient'); ?></span>
                    </a>
                </li>
               
            </ul>
        </li>-->

<?php if($account_type=='superadmin' || $account_type=='hospitaladmins'){?>
         <li class="<?php if ($page_name == 'manage_reports') echo 'opened active';?> "">
            <a href="#">
                <i class="glyphicon glyphicon-stats"></i>
                <span><?php echo get_phrase('reports'); ?></span>
            </a>
            <ul>
                 <li class="#">
                    <a href="<?php echo base_url(); ?>main/report/1">
                        <span><?php echo get_phrase('patient_report'); ?></span>
                    </a>
                </li>
                <li class="#">
                    <a href="<?php echo base_url(); ?>main/report/2">
                        <span><?php echo get_phrase('appointment_report'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
    <?php }?>
    <?php if($account_type=='users'){?>
    <li class="<?php if ($page_name == 'manage_prescription' || $page_name == 'manage_prognosis' || $page_name == 'manage_health_reports') echo 'opened active';?> ">
            <a href="#">
                <i class="fa  fa-hospital-o"></i>
                <span><?php echo get_phrase('health_records'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'manage_prescription') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>main/prescription">
                        <span>  <?php echo get_phrase('prescriptions'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'manage_prognosis') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>main/prognosis">
                        <span> <?php echo get_phrase('prognosis'); ?></span>
                    </a>
                </li>
                 <li class="<?php if ($page_name == 'manage_health_reports') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>main/health_reports">
                        <span><?php echo get_phrase('Health Reports'); ?></span>
                    </a>
                </li>
               
            </ul>
        </li>

       <!--  <li class="<?php if ($page_name == 'manage_appointment') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>main/doctor_availability/<?php echo $this->session->userdata('login_user_id');?>">
                <i class="menu-icon fa fa-eye"></i>
                <span><?php echo get_phrase('in-Patient_history'); ?></span>
            </a>
        </li> -->
        <?php }?>
             <!-- SETTINGS -->
        <!-- <?php if($account_type=='superadmin' || $account_type == 'hospitaladmins'){?>
        <li class="<?php if ($page_name == 'country' || $page_name == 'state' || $page_name == 'district' || $page_name == 'city'  || $page_name == 'license'  || $page_name == 'health_insurance_provider' || $page_name == 'specializations' || $page_name == 'language') echo 'opened active';?> ">
            <a href="#">
                <i class="fa fa-wrench"></i>
                <span><?php echo get_phrase('settings'); ?></span>
            </a>
            <ul>
                 <li class="<?php if ($page_name == 'system_settings') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>main/system_settings">
                        <span><i class="fa fa-h-square"></i> <?php echo get_phrase('system_settings'); ?></span>
                    </a>
                </li>
                <?php if($account_type=='superadmin'){?>
                <li class="<?php if ($page_name == 'manage_language') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>main/manage_language">
                        <span><i class="fa fa-globe"></i><?php echo $menu['language_settings'];?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'sms_settings') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>main/sms_settings">
                        <span><i class="entypo-paper-plane"></i> <?php echo $menu['sms_settings'];?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'country') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>main/country">
                        <span><i  class="entypo-paper-plane"></i><?php echo get_phrase('countries'); ?></span>
                    </a>
                </li>
               <li class="<?php if ($page_name == 'state') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>main/state">
                        <span><i  class="entypo-paper-plane"></i> <?php echo get_phrase('states'); ?></span>  
                    </a>
                </li>
                <li class="<?php if ($page_name == 'district') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>main/district">
                        <span><i class="entypo-paper-plane"></i> <?php echo get_phrase('districts'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'city') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>main/city">
                        <span><i class="entypo-paper-plane"></i> <?php echo get_phrase('cities'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'specializations') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>main/specialization">
                        <span><i  class="entypo-paper-plane"></i><?php echo get_phrase('specializations'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'language') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>main/language">
                        <span><i class="entypo-paper-plane"></i><?php echo get_phrase('languages');?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'license') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>main/license">
                        <span><i class="entypo-paper-plane"></i> <?php echo get_phrase('license_categories'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'health_insurance_provider') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>main/health_insurance_provider">
                        <span><i class="entypo-paper-plane"></i> <?php echo get_phrase('health_insurance_providers'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'manage_privacy') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>main/manage_privacy">
                        <span><i  class="entypo-paper-plane"></i><?php echo get_phrase('privacy & terms'); ?></span>
                    </a>
                </li>
                <?php }?>
            </ul>
        </li>
        <?php }?> -->
        <?php if($account_type=='superadmin'  || $account_type == 'hospitaladmins'){?>
        <li class="#">
            <a href="<?php echo base_url(); ?>main/settings">
                <i class="fa fa-wrench"></i>
                <span><?php echo get_phrase('settings'); ?></span>
            </a>
        </li>
        <?php }?>
        <?php if($account_type=='superadmin'){?>
        <li class="#">
            <a href="<?php echo base_url(); ?>main/db_backup">
                <i class="fa fa-database"></i>
                <span>DB Backup</span>
            </a>
        </li>
    <?php }?>
    </ul>

</div>