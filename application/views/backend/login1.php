<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Lumino - Login</title>
		<link href="<?= base_url('assets/backend/')?>css/bootstrap.min.css" rel="stylesheet">
		<link href="<?= base_url('assets/backend/')?>css/styles.css" rel="stylesheet">
		
		<!--Theme Switcher-->
		<style id="hide-theme">
			body{
				display:none;
			}
		</style>
		<script type="text/javascript">
			function setTheme(name){
				var theme = document.getElementById('theme-css');
				var style = 'css/theme-' + name + '.css';
				if(theme){
					theme.setAttribute('href', style);
				} else {
					var head = document.getElementsByTagName('head')[0];
					theme = document.createElement("link");
					theme.setAttribute('rel', 'stylesheet');
					theme.setAttribute('href', style);
					theme.setAttribute('id', 'theme-css');
					head.appendChild(theme);
				}
				window.localStorage.setItem('lumino-theme', name);
			}
			var selectedTheme = window.localStorage.getItem('lumino-theme');
			if(selectedTheme) {
				setTheme(selectedTheme);
			}
			window.setTimeout(function(){
					var el = document.getElementById('hide-theme');
					el.parentNode.removeChild(el);
				}, 5);
		</script>
		<!-- End Theme Switcher -->

		<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
		<script src="js/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="row">
			<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				<div class="login-panel panel panel-default">
					<div class="panel-heading">Log in<span class="login_error pull-right" style="color:#ff0000;"><?php if(!empty($this->session->flashdata('login_error'))){echo $this->session->flashdata('login_error');}?></span></div>
					<div class="panel-body">
				<form role="form" action="<?=base_url('login/validate_login');?>" method="post">
							<fieldset>
								<div class="form-group">
		<input class="form-control" placeholder="E-mail" name="email" type="email" id="email" autofocus="off">
			<span class="email_error" style="color:#ff0000;"><?php if(!empty($this->session->flashdata('email_error'))){echo $this->session->flashdata('email_error');}?></span>
								</div>
								<div class="form-group">
						<input class="form-control" placeholder="Password" name="password" type="password" id="password" value="">
			<span class="password_error" style="color:#ff0000;"><?php if(!empty($this->session->flashdata('password_error'))){echo $this->session->flashdata('password_error');}?></span>
								</div>
								<div class="checkbox">
									<label>
										<input name="remember" type="checkbox" value="Remember Me">Remember Me
									</label>
								</div>
								<div class="text-center">
									<button class="btn btn-lg btn-primary">Login</button></fieldset>
								</div>
						</form>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->	
	
		<script src="<?= base_url('assets/backend/')?>js/jquery-1.11.1.min.js"></script>
		<script src="<?= base_url('assets/backend/')?>js/bootstrap.min.js"></script>
	</body>

<!-- Mirrored from medialoot.com/preview/lumino-premium/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 09 Nov 2018 17:59:35 GMT -->
</html>
