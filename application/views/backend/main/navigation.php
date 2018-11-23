		<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
			<a href="<?=base_url('main/manage_profile')?>"><div class="profile-sidebar">
				<div class="profile-userpic">
					<img src="<?php echo $image_url;?>" width="50" class="img-responsive" alt="">
				</div>
				<div class="profile-usertitle">
                    <div class="profile-usertitle-status"><span><?php
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
  $user_role='MyPulse User';
}
echo $user_role; ?></span></div>
					<div class="profile-usertitle-name">
					<?php
                    echo $this->session->userdata('unique_id').'<br/>'.$this->db->get_where($this->session->userdata('login_type'), array($this->session->userdata('type_id') . '_id' =>$this->session->userdata('login_user_id')))->row()->name;
                    ?>	
					</div>
					
				</div>
				<div class="clear"></div>
			</div></a>
			<div class="divider"></div>
			<ul class="nav menu">
				<li class="<?php if ($page_name == 'dashboard') echo 'active'; ?>"><a href="<?php echo base_url(); ?>main/dashboard"><i class="fa fa-dashboard">&nbsp;</i> <?php echo get_phrase('dashboard'); ?></a></li>
				<?php if($account_type=='superadmin' || $account_type=='users'){?>
      <li class="<?php if ($page_name == 'manage_hospital') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>main/hospital">
                <i class="fa  fa-hospital-o ">&nbsp;</i>
                <span><?php echo get_phrase('hospitals'); ?></span>
            </a>
        </li>
    <?php }?>
    <?php if($account_type=='superadmin'){?>
        <li class="<?php if ($page_name == 'manage_admins') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>main/hospital_admins">
                <i class="fa fa-users">&nbsp;</i>
                <span><?php echo get_phrase('hospital_admins'); ?></span>
            </a>
        </li>
<?php }elseif($account_type=='hospitaladmins'){?>
        <li class="<?php if ($page_name == 'manage_branch') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>main/get_hospital_branch/<?= $this->session->userdata('hospital_id');?>">
                <i class="fa  fa-hospital-o ">&nbsp;</i>
                <span><?php echo get_phrase('branches'); ?></span>
            </a>
        </li>
    <?php }?>
        <?php if($account_type=='superadmin' || $account_type=='hospitaladmins' || $account_type=='nurse' || $account_type=='receptionist' || $account_type=='users'){?>
        <li class="<?php if ($page_name == 'manage_doctor') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>main/doctor">
                <i class="fa fa-user-md">&nbsp;</i>
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
                <i class="fa fa-user">&nbsp;</i>
                <span><?php echo get_phrase('nurses'); ?></span>
            </a>
        </li>
    <?php }?>
        <?php if($account_type=='superadmin' || $account_type=='hospitaladmins' || $account_type=='users'){?>
         <li class="<?php if ($page_name == 'manage_stores') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>main/medical_stores">
                <i class="menu-icon fa fa-medkit ">&nbsp;</i>
                <span><?php echo get_phrase('medical_stores'); ?></span>
            </a>
        </li>
        
        <li class="<?php if ($page_name == 'manage_labs') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>main/medical_labs">
                <i class="menu-icon fa  fa-plus-square ">&nbsp;</i>
                <span><?php echo get_phrase('medical_labs'); ?></span>
            </a>
        </li>
    <?php }?>
        <?php if($account_type=='superadmin'){?>
        <li class="<?php if ($page_name == 'manage_users') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>main/users">
                <i class="fa fa-users">&nbsp;</i>
                <span><?php echo get_phrase('myPulse_users'); ?></span>
            </a>
        </li>
    <?php }?>
    <?php if($account_type=='medicalstores' || $account_type=='medicallabs'){?>
        <li class="<?php if ($page_name == 'manage_order') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>main/orders">
                <i class="menu-icon glyphicon glyphicon-list-alt">&nbsp;</i>
                <span><?php echo get_phrase('orders'); ?></span>
            </a>
        </li>
    <?php }?>
    <?php if($account_type=='users'){?>
        <li class="parent <?php if ($page_name == 'manage_order') echo 'active'; ?>"><a data-toggle="collapse" href="#sub-item-1">
                    <i class="glyphicon glyphicon-list-alt">&nbsp;</i> <?php echo get_phrase('orders'); ?> <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><i class="fa fa-plus"></i></span>
                    </a>
                    <ul class="children collapse" id="sub-item-1">
                <li class="#">
                    <a href="<?php echo base_url(); ?>main/orders/0">
                        <span><?php echo get_phrase('medicines'); ?></span>
                    </a>
                </li>
                <li class="#">
                    <a href="<?php echo base_url(); ?>main/orders/1">
                        <span><?php echo get_phrase('medical_tests'); ?></span>
                    </a>
                </li>
                    </ul>
        </li>
        <?php }?>
    <?php if($account_type=='medicallabs'){?>
        <li class="<?php if ($page_name == '') echo 'active'; ?>">
            <a href="#">
                <i class="menu-icon glyphicon glyphicon-list-alt">&nbsp;</i>
                <span><?php echo get_phrase('reports'); ?></span>
            </a>
        </li>
    <?php }?>
    <?php if($account_type=='hospitaladmins' || $account_type=='doctors' || $account_type=='medicalstores' || $account_type=='medicallabs'){?>
        <li class="<?php if ($page_name == 'manage_patient') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>main/patient">
                <i class="fa fa-users">&nbsp;</i>
                <span><?php echo get_phrase('Patients'); ?></span>
            </a>
        </li>
    <?php }?>
    <?php if($account_type=='nurse'){?>
        <li class="<?php if ($page_name == 'manage_ward') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>main/get_hospital_ward/<?=$this->session->userdata('department_id')?>">
                <i class="fa fa-users">&nbsp;</i>
                <span><?php echo get_phrase('wards'); ?></span>
            </a>
        </li>
    <?php }?>
    <?php if($account_type=='nurse'){?>
    <!--     <li class="<?php if ($page_name == 'manage_beds') echo 'active'; ?>">
            <a href="#">
                <i class="fa fa-users">&nbsp;</i>
                <span><?php echo get_phrase('beds'); ?></span>
            </a>
        </li> -->
    <?php }?>
    <?php if($account_type=='superadmin' || $account_type=='hospitaladmins' || $account_type=='doctors' || $account_type=='users'  || $account_type=='nurse' || $account_type=='receptionist'){?>
        <li class="<?php if ($page_name == 'manage_inpatient') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>main/inpatient">
                <i class="menu-icon fa fa-eye">&nbsp;</i>
                <span><?php if($account_type == 'users'){echo get_phrase('in-Patient_history');}else{echo get_phrase('in-Patients'); }?></span>
            </a>
        </li>
    <?php }?>
    <?php if($account_type=='superadmin' || $account_type=='hospitaladmins' || $account_type=='doctors' || $account_type=='users' || $account_type=='receptionist' || $account_type=='nurse'){?>
        <li class="<?php if ($page_name == 'manage_appointment') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>main/appointment">
                <i class="menu-icon glyphicon glyphicon-list-alt">&nbsp;</i>
                <span><?php echo get_phrase('appointments'); ?></span>
            </a>
        </li>
    <?php }?>
    <?php if($account_type=='users'){?>
        <li class="parent <?php if ($page_name == 'manage_prescription' || $page_name == 'manage_prognosis' || $page_name == 'manage_health_reports') echo 'active';?>"><a data-toggle="collapse" href="#sub-item-2">
                    <i class="fa fa-hospital-o">&nbsp;</i> <?php echo get_phrase('health_records'); ?> <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><i class="fa fa-plus"></i></span>
                    </a>
                    <ul class="children collapse" id="sub-item-2">
                <li class="#">
                    <a href="<?php echo base_url(); ?>main/prescription">
                        <span><?php echo get_phrase('prescriptions'); ?></span>
                    </a>
                </li>
                <li class="#">
                    <a href="<?php echo base_url(); ?>main/prognosis">
                        <span><?php echo get_phrase('prognosis'); ?></span>
                    </a>
                </li>
                <li class="#">
                    <a href="<?php echo base_url(); ?>main/health_reports">
                        <span><?php echo get_phrase('health_reports'); ?></span>
                    </a>
                </li>
                    </ul>
        </li>
        <?php }?>
        <?php if($account_type=='doctors'){?>
            <li class="<?php if ($page_name == 'add_availability') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>main/doctor_availability/<?php echo $this->session->userdata('login_user_id');?>">
                <i class="glyphicon glyphicon-calendar">&nbsp;</i>
                <span><?php echo get_phrase('availability'); ?></span>
            </a>
        </li>
        <?php }?>

    <?php if($account_type=='superadmin' || $account_type=='hospitaladmins'){?>
		<li class="parent"><a data-toggle="collapse" href="#sub-item-1">
					<i class="glyphicon glyphicon-stats">&nbsp;</i> <?php echo get_phrase('reports'); ?> <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><i class="fa fa-plus"></i></span>
					</a>
					<ul class="children collapse" id="sub-item-1">
						<li class="<?php if ($page_name == 'manage_prognosis') echo 'active'; ?>">
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
        <?php if($account_type=='superadmin' || $account_type == 'hospitaladmins'){?>
    <li class="<?php if ($page_name == 'settings') echo 'active'; ?>">
    <a href="<?php echo base_url(); ?>main/settings">
    <i class="fa fa-wrench">&nbsp;</i>
    <span><?php echo get_phrase('settings'); ?></span>
    </a>
    </li>
        <?php }?>
        <?php if($account_type=='superadmin'){?>
    <li class="#">
    <a href="<?php echo base_url(); ?>main/db_backup">
    <i class="fa fa-database">&nbsp;</i>
    <span><?php echo get_phrase('DB Backup'); ?></span>
    </a>
    </li>
        <?php }?>
	</ul>
</div><!--/.sidebar-->