<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        $system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
        $system_title = $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;
        ?>  
<title><?php echo $system_title; ?> - <?php echo $this->lang->line('labels')['login'];?> </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include'login_top.php';?>
<style>
    ..p-b-230{
        padding-bottom:0px;
    }
</style>
<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('<?php echo base_url();?>assets/assets1/images/images.jpg');height:auto;">
			<div class="wrap-login100 p-t-190 p-b-30"> 
				<form class="login100-form validate-form" action="<?php echo base_url();?>login/validate_login" method="post">
					<div class="login100-form-avatar">
						<img class="img-responsive" src="<?php echo base_url(); ?>assets/logo.png" alt="AVATAR" style="width:100%;">
					</div>
	<span class="login100-form-title p-t-20 p-b-45"></span>
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
						<button class="login100-form-btn"><?php echo 'Login';?></button>
					</div>
 
					<div class="text-center w-full p-t-25 p-b-230">
<a href="<?=base_url()?>" class="txt1"><?php echo 'Back To Home';?></a>
						 <br>
<a href="#" class="txt1"><?php echo 'Forgot Your Password';?></a>
						 <br>
<a class="txt1" href="<?php echo base_url(); ?>login/register" ><h5 style="color:white;">
<?php echo "Don't Have Account? Sign Up";?></h5>
<i class="fa fa-long-arrow-right"></i></a>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php include'login_bottom.php';?>
</body>
</html>