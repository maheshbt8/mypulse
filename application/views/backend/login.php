<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        $system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
        $system_title = $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;
        ?>  
<title><?php echo $this->lang->line('labels')['login'];?> | <?php echo $system_title; ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?php echo base_url();?>assets/assets1/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/assets1/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/assets1/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/assets1/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/assets1/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/assets1/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/assets1/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/assets1/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/assets1/css/main.css">
<!--===============================================================================================-->
</head>
<style>
    ..p-b-230{
        padding-bottom:0px;
    }
</style>
<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('<?php echo base_url();?>assets/assets1/images/images.jpg');height:auto;">
			<div class="wrap-login100 p-t-190 p-b-30"> 
				<form class="login100-form validate-form" action="<?php echo base_url();?>index.php?login/validate_login" method="post">
					<div class="login100-form-avatar">
						<img class="img-responsive" src="<?php echo base_url(); ?>assets/logo.png" alt="AVATAR" style="width:100%;">
					</div>

					<span class="login100-form-title p-t-20 p-b-45">
				
					</span>
                    <?php if($this->session->flashdata('login_error')!=''){?>
		<div class="alert alert-danger alert-dismissible" role="alert" style="padding: 0.06rem 1.25rem;">
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><?php echo $this->lang->line('usr_acc_invalid_credential'); ?></div>
		<?php }?>
					<div class="wrap-input100 validate-input m-b-10" data-validate = "<?php echo $this->lang->line('validation')['requiredEmail'];?>">
						<input class="input100" type="text" name="email" placeholder="<?php echo 'Email Or Mobile' ?>" autocomplete="off">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "<?php echo $this->lang->line('validation')['requiredPassword'];?>">
						<input class="input100" type="password" name="password" placeholder="<?php echo $this->lang->line('login_mobile_password'); ?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>  
					</div>

					<div class="container-login100-form-btn p-t-10">
						<button class="login100-form-btn"><?php echo $this->lang->line('buttons')['login'];?></button>
					</div>
 
					<div class="text-center w-full p-t-25 p-b-230">
						<a href="#" class="txt1">
							<?php echo $this->lang->line('forgot_your_password');?>
						</a>
						 
						 <br>
							<a class="txt1" href="<?php echo base_url(); ?>index.php?login/register" ><h5 style="color:white;">
							<?php echo $this->lang->line('do_not_have_account');?></h5>
							<i class="fa fa-long-arrow-right"></i>						
						</a>
					</div>

				
				</form>
			</div>
		</div>
	</div>

	
<!--===============================================================================================-->	
	<script src="<?php echo base_url();?>assets/assets1/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assets/assets1/vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo base_url();?>assets/assets1/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assets/assets1/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assets/assets1/js/main.js"></script>

</body>
</html>