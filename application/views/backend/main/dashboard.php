<style>
    .tile-stats .icon{
        bottom: 50px;
    }
</style>
<!-- <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-comment w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>52</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Messages</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-eye w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>99</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Views</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-share-alt w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>23</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Shares</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>50</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Users</h4>
      </div>
    </div>
  </div> -->
<div class="row">
<?php if($account_type=='superadmin' || $account_type=='users'){?>
      <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>main/hospital">
            <div class="tile-stats tile-white-gray  tile-white-primary">
                <div class="icon"><i class="fa fa-hospital-o"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php echo $this->db->count_all('hospitals'); ?>" data-duration="1500" data-delay="0">0</div>
                <h3 style="padding-left: 65px;"><?php echo 'Hospitals';?></h3>
            </div>
        </a>
    </div>
<?php }elseif($account_type=='hospitaladmins'){?>
    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>main/get_hospital_branch/<?php echo $this->session->userdata('hospital_id');?>">
            <div class="tile-stats tile-white-gray  tile-white-primary">
                <div class="icon"><i class="fa fa-hospital-o"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php echo $this->db->where('hospital_id',$this->session->userdata('hospital_id'))->get('branch')->num_rows(); ?>" data-duration="1500" data-delay="0">0</div>
                <h3 style="padding-left: 65px;"><?php echo 'Branches';?></h3>
            </div>
        </a>
    </div>
<?php }elseif($account_type=='nurse' || $account_type=='receptionist'){?>
    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>main/get_hospital_branch/<?php echo $this->session->userdata('hospital_id');?>">
            <div class="tile-stats tile-white-gray  tile-white-primary">
                <div class="icon"><i class="fa fa-hospital-o"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php if($account_type=='nurse'){$dt=$this->db->where('nurse_id',$this->session->userdata('login_user_id'))->get('nurse')->row(); if($dt->department_id==0){echo $this->db->where('branch_id',$dt->branch_id)->get('department')->num_rows();}else{echo explode(',',$dt->department_id);}}elseif($account_type=='receptionist'){$dt=$this->db->where('receptionist_id',$this->session->userdata('login_user_id'))->get('receptionist')->row(); if($dt->department_id==0){echo $this->db->where('branch_id',$dt->branch_id)->get('department')->num_rows();}else{echo explode(',',$dt->department_id);}}?>" data-duration="1500" data-delay="0">0</div>
                <h3 style="padding-left: 65px;"><?php echo 'Departments';?></h3>
            </div>
        </a>
    </div>
<?php }?>
<?php if($account_type=='superadmin' || $account_type=='hospitaladmins'|| $account_type=='nurse'|| $account_type=='receptionist'){?>
    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>main/doctor">
            <div class="tile-stats tile-white tile-white-primary">
                <div class="icon"><i class="fa fa-user-md"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php if($account_type=='superadmin'){echo $this->db->count_all('doctors');}elseif($account_type=='hospitaladmins'){echo $this->db->where('hospital_id',$this->session->userdata('hospital_id'))->get('doctors')->num_rows();}elseif($account_type=='nurse'){echo count(explode(',',$this->db->where('nurse_id',$this->session->userdata('login_user_id'))->get('nurse')->row()->doctor_id));}elseif($account_type=='receptionist'){echo count(explode(',',$this->db->where('receptionist_id',$this->session->userdata('login_user_id'))->get('receptionist')->row()->doctor_id));} ?>"
                     data-duration="1500" data-delay="0">0 </div>
                <h3 style="padding-left: 65px;"><?php echo 'Doctors';?> </h3>
            </div>
        </a>
    </div>
   <?php }?>
   <?php if($account_type=='superadmin'){?>
      <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>index.php?superadmin/users">
            <div class="tile-stats tile-white-red">
                <div class="icon"><i class="fa fa-users"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php echo $this->db->count_all('users'); ?>" 
                     data-duration="1500" data-delay="0">0 </div>
                <h3 style="padding-left: 65px;"><?php echo 'Users';?></h3>
            </div>
        </a>
        </div>
    <?php }?>
    <?php if($account_type != 'superadmin' && $account_type != 'users'){?>
    <div class="col-sm-3">
        <a href="#">
            <div class="tile-stats tile-white-red">
                <div class="icon"><i class="fa fa-users"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php echo $this->db->where('hospital_id',$this->session->userdata('hospital_id'))->get('inpatient')->num_rows(); ?>" 
                     data-duration="1500" data-delay="0">0 </div>
                <h3 style="padding-left: 65px;"><?php echo 'Patients';?></h3>
            </div>
        </a>
    </div>
<?php }?>
   <?php if($account_type == 'users'){?>
    <div class="col-sm-3">
        <a href="#">
            <div class="tile-stats tile-white-red">
                <div class="icon"><i class="fa fa-users"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php echo $this->db->where('hospital_id',$this->session->userdata('hospital_id'))->get('inpatient')->num_rows(); ?>" 
                     data-duration="1500" data-delay="0">0 </div>
                <h3 style="padding-left: 65px;"><?php echo 'Medical Labs';?></h3>
            </div>
        </a>
    </div>
<?php }?>
<?php if($account_type != 'medicalstores' && $account_type != 'medicallabs'){?>
        <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>main/appointment">
            <div class="tile-stats tile-white-aqua">
               <div class="icon"><i class="fa fa-envelope"></i></div>
                <div class="num pull-right" data-start="0" data-end="
                <?php if($account_type=='superadmin'){ echo $this->db->count_all('appointments'); }elseif($account_type=='hospitaladmins'){echo $this->db->where('hospital_id',$this->session->userdata('hospital_id'))->get('appointments')->num_rows();}elseif($account_type=='doctors'){echo $this->db->where('doctor_id',$this->session->userdata('login_user_id'))->get('appointments')->num_rows();}?>" 
                     data-duration="1500" data-delay="0">0 </div>
                <h3 style="padding-left: 65px;"><?php echo $this->lang->line('appointments');?> </h3>
            </div>
        </a>
        </div>
 <?php }?>
 <?php if($account_type=='medicalstores' || $account_type=='medicallabs'){?>
      <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>main/hospital">
            <div class="tile-stats tile-white-gray  tile-white-primary">
                <div class="icon"><i class="fa fa-hospital-o"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php echo $this->db->count_all('hospitals'); ?>" data-duration="1500" data-delay="0">0</div>
                <h3 style="padding-left: 65px;"><?php if($account_type=='medicalstores'){echo 'Outstanding Orders';}elseif( $account_type=='medicallabs'){echo 'Outstanding Reports';}?></h3>
            </div>
        </a>
    </div>
    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>main/doctor">
            <div class="tile-stats tile-white tile-white-primary">
                <div class="icon"><i class="fa fa-user-md"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php echo $this->db->count_all('hospitals'); ?>"
                     data-duration="1500" data-delay="0">0 </div>
                <h3 style="padding-left: 65px;"><?php if($account_type=='medicalstores'){echo 'Complete Orders';}elseif( $account_type=='medicallabs'){echo 'Complete Reports';}?> </h3>
            </div>
        </a>
    </div>
<?php }?>
</div>
