<!DOCTYPE html>
<html lang="en">
<head>
	<?php
        $system_name = $this->db->get_where('settings', array('setting_type' => 'system_name'))->row()->description;
        $system_title = $this->db->get_where('settings', array('setting_type' => 'system_title'))->row()->description;
        ?>  
	<title><?php echo $system_title; ?> | Admin Registration</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Create an account or login to MyPulse. Book appointments, Manage prescriptions and health records across the hospitals, Order Medicines and Medical Tests.">
	<meta name="keywords" content="Healthcare, MyPulse, Book appointments, Manage health records, Prescriptions, Order medicines, Order Medical tests" />
<?php include'login_top.php';?>
</head>  
<body>
	<div class="limiter">
		<div class="container-login100" style="background-image: url('<?php echo base_url();?>assets/assets1/images/images.jpg');">
			<div class="wrap-login100 p-t-190 p-b-30">
				<form class="login100-form validate-form" action="<?php echo base_url();?>login" method="post">
					<div class="login100-form-avatar">  
						<img src="<?=base_url('MyPulse-Logo');?>" alt="MyPulse" draggable="false">
					</div>

					<span class="login100-form-title p-t-20 p-b-45">
					</span>
<?php if($this->session->flashdata('success')!=''){ ?>
		<div class="alert alert-success alert-dismissible" role="alert" style="padding: 0.06rem 1.25rem;">
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" >×</span></button><?php echo $this->session->flashdata('success'); ?></div>
		<?php }
		if($this->session->flashdata('error')!=''){?>
		<div class="alert alert-danger alert-dismissible" role="alert" style="padding: 0.06rem 1.25rem;">
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><?php echo $this->session->flashdata('error'); ?></div>
		<?php }?>
		<span id="phone_error"></span><span id="email_error"></span>
					<div class="wrap-input100 validate-input m-b-10 main_data" data-validate = "Enter Name">
						<input class="input100" type="text" name="username" placeholder="Name *" value="<?php echo set_value('username'); ?>" autocomplete="off">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input m-b-10 main_data" data-validate = "Enter Mobile Number">
						<input class="input100" type="text" name="phone" placeholder="Mobile Number *" value="<?php echo set_value('phone'); ?>" onchange="return get_phone(this.value)" autocomplete="off"minlength="10" maxlength="10" id="phone">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>
					
						<div class="wrap-input100 validate-input m-b-10 main_data" data-validate = "Enter Email <?php if($this->session->flashdata('email_error')!=''){echo "Duplicate";}?>">
						<input class="input100" type="email" name="email" placeholder="Email *" value="<?php echo set_value('email'); ?>" onchange="return get_email(this.value)" autocomplete="off">
						
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10 main_data" data-validate = "Enter Password">
						<input class="input100" type="password" name="pass" placeholder="<?php echo 'Password';?> *" value="<?php echo set_value('pass'); ?>" minlength="6" maxlength="10">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>
						<div class="wrap-input100 validate-input m-b-10 main_data" data-validate = "Confirm Password">
						<input class="input100" type="password" name="cpass" placeholder="Confirm Password *" value="<?php echo set_value('cpass'); ?>"minlength="6" maxlength="10">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>
					<div class="custom-control main_data">
<p style="color:#fff;">By signing up, you agree to our <a href="<?=base_url('Privacy&Policy')?>" style="color:#fff;" target="_blank">Privacy Policy</a> &nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?=base_url('Terms&Coditions')?>" style="color:#fff;" target="_blank">Terms & Conditions</a>
        </p>
					</div>
					<div class="container-login100-form-btn p-t-10">
						<button class="login100-form-btn">Sign-Up</button>
					</div>
					<div class="text-center w-full p-t-25 p-b-230">
<a class="txt1" href="<?php echo base_url();?>Logout" ><h5 style="color:white;">Already Have An Account? Login</h5>
<i class="fa fa-long-arrow-right"></i>						
</a>
<br>
<a href="<?=base_url('login/logout_to_home')?>" class="txt1"><?php echo 'Back To Home';?></a>
</div>
</form>
</div>
</div>
</div>
<?php include'login_bottom.php';?>
</body>
</html>