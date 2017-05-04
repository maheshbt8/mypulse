<?php

class sendRestKey
{
	function sendRegMail($data)
	{
		require APPPATH.'libraries/PHPMailer/class.phpmailer.php';
			
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->Host     = "ssl://smtp.gmail.com";
		$mail->Port     = 465;
		$mail->Username = "hospitalsystem160@gmail.com";
		$mail->Password = "@641f81cd1&295a01";
		$mail->From = "hospitalsystem160@gmail.com";
		$mail->FromName = "Hospital Managment System";
		$mail->Subject  = $data['subject'];
		$mail->Body     = $data['body'];
		$mail->AddAddress($data['email']);
		if(!$mail->Send()){
			return false;
		}else{
			return true;
		}			
	}
}
?>