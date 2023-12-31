<?php
$system_name    = $this->db->get_where('settings', array('setting_type' => 'system_name'))->row()->description;
$system_title   = $this->db->get_where('settings', array('setting_type' => 'system_title'))->row()->description;
$text_align     = $this->db->get_where('settings', array('setting_type' => 'text_align'))->row()->description;
$account_type   = $this->session->userdata('login_type');
$account_details=$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id');
$unique_id=$this->session->userdata('unique_id');
$license_category=$this->db->where('license_category_id',$this->db->where('license_id',$this->session->userdata('license'))->get('license')->row()->license_category_id)->get('license_category')->row()->license_category_code;

?>
<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $system_title; ?> - <?php echo $page_title; ?></title>
<meta name="description" content="Create an account or login to MyPulse. Book appointments, Manage prescriptions and health records across the hospitals, Order Medicines and Medical Tests.">
	<meta name="keywords" content="Healthcare, MyPulse, Book appointments, Manage health records, Prescriptions, Order medicines, Order Medical tests" />

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
		<?php include 'get_ajax_data.php'; ?>
	<?php include 'includes_bottom.php'; ?>

</body>
</html>