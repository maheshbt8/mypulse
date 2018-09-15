<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V12</title>
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
<body>
	  
	<div class="limiter">
		<div class="container-login100" style="background-image: url('<?php echo base_url();?>assets/assets1/images/images.jpg');">
			<div class="wrap-login100 p-t-190 p-b-30">
				<form class="login100-form validate-form">
					<div class="login100-form-avatar">  
						<img src="<?php echo base_url(); ?>assets/logo.png" alt="AVATAR">
					</div>

					<span class="login100-form-title p-t-20 p-b-45">
				  
					</span>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Username is required">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>
						<div class="wrap-input100 validate-input m-b-10" data-validate = "Mobile number is required">
						<input class="input100" type="text" name="mobile" placeholder="Mobile number">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>
					
						<div class="wrap-input100 validate-input m-b-10" data-validate = "Email is required">
						<input class="input100" type="email" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>
						<div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" placeholder=" Re-enter Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>

					<div class="container-login100-form-btn p-t-10">
						<button class="login100-form-btn">
							Register
						</button>
					</div>

					<div class="text-center w-full p-t-25 p-b-230">
					
						 
						 <br>
							<a class="txt1" href="<?php echo base_url();?>index.php?login" ><h5 style="color:white;">
						Already a member?&nbsp;&nbsp;Login here!</h5>
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