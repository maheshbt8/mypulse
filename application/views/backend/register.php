<!DOCTYPE html>
<html lang="en">
<head>
	<?php
        $system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
        $system_title = $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;
        ?>  
	<title><?php echo $this->lang->line('labels')['sign_up'];?> | <?php echo $system_title; ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<?php include'login_top.php';?>
</head>  
<body>
	  
	<div class="limiter">
		<div class="container-login100" style="background-image: url('<?php echo base_url();?>assets/assets1/images/images.jpg');">
			<div class="wrap-login100 p-t-190 p-b-30">
				<form class="login100-form validate-form" action="<?php echo base_url();?>login/register" method="post">
					<div class="login100-form-avatar">  
						<img src="<?php echo base_url(); ?>assets/logo.png" alt="AVATAR">
					</div>

					<span class="login100-form-title p-t-20 p-b-45">
				  
					</span>
						   <?php if($this->session->flashdata('msg_registration_complete')!=''){?>
		<div class="alert alert-success alert-dismissible" role="alert" style="padding: 0.06rem 1.25rem;">
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><?php echo $this->session->flashdata('msg_registration_complete'); ?></div>
		<?php }
		if($this->session->flashdata('success')!=''){?>
		<div class="alert alert-success alert-dismissible" role="alert" style="padding: 0.06rem 1.25rem;">
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><?php echo $this->session->flashdata('success'); ?></div>
		<?php }
					  if($this->session->flashdata('error')!=''){?>
		<div class="alert alert-danger alert-dismissible" role="alert" style="padding: 0.06rem 1.25rem;">
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><?php echo $this->session->flashdata('error'); ?></div>
		<?php }
		 /*if($this->session->flashdata('cpass_error')!=''){?>
		<div class="alert alert-danger alert-dismissible" role="alert" style="padding: 0.06rem 1.25rem;">
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><?php echo $this->session->flashdata('cpass_error'); ?></div>
		<?php }*/?>
		<span id="email_error"></span><span id="phone_error"></span>
		<?php
		if($this->session->flashdata('otp')!=''){
			?>
			<div class="wrap-input100 validate-input m-b-10" data-validate = "<?php echo $this->lang->line('validation')['requiredFname'];?>">
						<input class="input100" type="text" name="otp" placeholder="<?php echo 'OTP';?>*" value="<?php echo set_value('otp'); ?>" autocomplete="off">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>
			<?php
		}
		?>
					<div class="wrap-input100 validate-input m-b-10" data-validate = "<?php echo $this->lang->line('validation')['requiredFname'];?>">
						<input class="input100" type="text" name="username" placeholder="<?php echo $this->lang->line('labels')['name'];?>*" value="<?php echo set_value('username'); ?>" autocomplete="off">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>
						<div class="wrap-input100 validate-input m-b-10" data-validate = "<?php echo $this->lang->line('validation')['requriedPhone'];?>">
						<input class="input100" type="text" name="phone" placeholder="<?php echo 'Mobile Number';?>*" value="<?php echo set_value('mobile'); ?>" onchange="return get_phone(this.value)" autocomplete="off"minlength="10" maxlength="10">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>
					
						<div class="wrap-input100 validate-input m-b-10" data-validate = "<?php echo $this->lang->line('validation')['requiredEmail'];?><?php if($this->session->flashdata('email_error')!=''){echo "Duplicate";}?>">
						<input class="input100" type="email" name="email" placeholder="<?php echo $this->lang->line('labels')['email'];?>*" value="<?php echo set_value('email'); ?>" onchange="return get_email(this.value)" autocomplete="off">
						
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "<?php echo $this->lang->line('validation')['requiredPassword'];?>">
						<input class="input100" type="password" name="pass" placeholder="<?php echo 'Password';?>*" value="<?php echo set_value('pass'); ?>"minlength="6" maxlength="10">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>
						<div class="wrap-input100 validate-input m-b-10" data-validate = "<?php echo $this->lang->line('validation')['requiredConfirmPassword'];?>">
						<input class="input100" type="password" name="cpass" placeholder="<?php echo $this->lang->line('labels')['confirm_password'];?>*" value="<?php echo set_value('cpass'); ?>"minlength="6" maxlength="10">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>

					<div class="container-login100-form-btn p-t-10">
						<button class="login100-form-btn"><?php echo $this->lang->line('buttons')['submit'];?></button>
					</div>

					<div class="text-center w-full p-t-25 p-b-230">
<a class="txt1" href="<?php echo base_url();?>login" ><h5 style="color:white;"><?php echo get_phrase('already_have_an_account?_login');?></h5>
<i class="fa fa-long-arrow-right"></i>						
</a>
<br>
<a href="<?=base_url()?>" class="txt1"><?php echo 'Back To Home';?></a> 
</div>
</form>
</div>
</div>
</div>
<?php include'login_bottom.php';?>
<script type="text/javascript">
function get_email(email_value){
	$.ajax({
            type : "POST",
            url: '<?php echo base_url();?>ajax/get_email/' ,
            data : {email : email_value},
            success: function(response)
            {
                jQuery('#email_error').html(response);        
            } 
        });
    }
function get_phone(phone_value) {
    $.ajax({
            type : "POST",
            url: '<?php echo base_url();?>ajax/get_phone/' ,
            data : {phone : phone_value},
            success: function(response)
            {
                jQuery('#phone_error').html(response);        
            } 
        });
}
</script>
</body>
</html>