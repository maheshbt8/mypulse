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
                <img src="<?php echo $this->crud_model->get_image_url('receptionist', $this->session->userdata('login_user_id'));?>" alt="" class="img-circle" style="height:44px;">

                <!--<span><?php echo get_phrase('welcome'); ?>,</span>-->
                <strong><?php
                    echo $this->db->get_where($this->session->userdata('login_type'), array('receptionist_id' =>
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
        <li class="<?php if ($page_name == 'manage_branch') echo 'active'; ?> ">
            <a href="#">
                <i class="fa  fa-hospital-o "></i>
                <span><?php echo get_phrase('branches'); ?></span>
            </a>
        </li>
       
        



          



    </ul>

</div>