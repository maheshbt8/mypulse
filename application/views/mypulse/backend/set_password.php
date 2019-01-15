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

<meta name="author" content="Mahesh BT" />
<meta name="geo.region" content="IN-AP" />
<meta name="geo.placename" content="Hyderabad" />
<meta name="language" content="English">
<meta name="geo.position" content="17.41556;78.452628" />
<meta name="keywords" content="" />
<meta name="description" content=""/>
<link rel="canonical" href="<?php base_url('login/set_password');?>" />
<meta property="og:type" content="website" />
<meta property="og:title" content="MyPulse Reset Your Password Page." />
<meta property="og:description" content="" />
<meta property="og:url" content="<?php base_url('login/set_password');?>" />
<meta property="og:image" content="<?php base_url('assets/logo.png');?>"/>

<?php include'login_top.php';?>
</head>  
<body>
	  
	<div class="limiter">
		<div class="container-login100" style="background-image: url('<?php echo base_url();?>assets/assets1/images/images.jpg');">
			<div class="wrap-login100 p-t-190 p-b-30">
				<form class="login100-form validate-form" action="<?php echo base_url();?>login/set_password/<?php echo $account.'/'.$id?>" method="post">
					<div class="login100-form-avatar">  
						<img src="<?php echo base_url(); ?>assets/logo.png" alt="AVATAR">
					</div>

					<span class="login100-form-title p-t-20 p-b-45">
				  Set Your Password<br/><br/>
					</span>
		<?php if($this->session->flashdata('msg_registration_complete')!=''){?>
		<div class="alert alert-success alert-dismissible" role="alert" style="padding: 0.06rem 1.25rem;">
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><?php echo $this->session->flashdata('msg_registration_complete'); ?></div>
		<?php }		
		 if($this->session->flashdata('cpass_error')!=''){?>
		<div class="alert alert-danger alert-dismissible" role="alert" style="padding: 0.06rem 1.25rem;">
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><?php echo $this->session->flashdata('cpass_error'); ?></div>
		<?php }?>
		<?php if(validation_errors()!=''){?>
		<div class="alert alert-danger alert-dismissible" role="alert" style="padding: 0.06rem 1.25rem;">
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span style="color:red"><?php echo form_error('pass'); ?><?php echo form_error('cpass'); ?></span></div>
					<?php }?>
					<div class="wrap-input100 validate-input m-b-10" data-validate = "<?php echo $this->lang->line('validation')['requiredPassword'];?>">
						<input class="input100" type="password" name="pass" placeholder="<?php echo $this->lang->line('labels')['password'];?>*" value="<?php echo set_value('pass'); ?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
						
					</div>
						<div class="wrap-input100 validate-input m-b-10" data-validate = "<?php echo $this->lang->line('validation')['requiredConfirmPassword'];?>">
						<input class="input100" type="password" name="cpass" placeholder="<?php echo $this->lang->line('labels')['confirm_password'];?>*" value="<?php echo set_value('cpass'); ?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>

					<div class="container-login100-form-btn p-t-10">
						<button class="login100-form-btn"><?php echo $this->lang->line('buttons')['submit'];?></button>
					</div>
						<div class="text-center w-full p-t-25 p-b-230">
<a class="txt1" href="<?php echo base_url();?>login" ><h5 style="color:white;"><?php echo get_phrase('back to login');?></h5>
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
</body>
</html>