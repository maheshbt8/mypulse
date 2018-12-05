<?php
$system_name    = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
$system_title   = $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;
$text_align     = $this->db->get_where('settings', array('type' => 'text_align'))->row()->description;
$account_type   = $this->session->userdata('login_type');
$account_details=$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id');
?>
<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $system_title; ?> - <?php echo $page_title; ?></title>
		<meta name="author" content="Mahesh BT" />
		
		<!--Custom Font-->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

		<!--Theme Switcher-->
		<!-- <style id="hide-theme">
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
		</script> -->
		<?php include 'includes_top.php'; ?>
</head>
<body style="">

	<?php include 'main/header.php'; ?>
	<?php include 'main/navigation.php'; ?>
		<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header">
                    <i class="fa fa-arrow-circle-o-right">&nbsp;</i><?php echo $page_title; ?></h2>
				</div>
			</div><!--/.row-->
			
			<?php include 'main/' . $page_name . '.php'; ?>
		<?php include 'footer.php'; ?>
		</div>	<!--/.main-->

		<?php include 'modal.php'; ?>
	<?php include 'includes_bottom.php'; ?>
</body>
</html>