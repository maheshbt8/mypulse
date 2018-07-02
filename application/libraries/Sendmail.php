<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sendmail {

	public function __construct(){
	//Load library
        $this->CI =& get_instance();
    	require APPPATH.'libraries/PHPMailer/class.phpmailer.php';
    }
    
    public function send($data){
        $mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->Host     = "ssl://smtp.gmail.com";
		$mail->Port     = 465;
		/*$mail->Username = "hospitalsystem160@gmail.com";
		$mail->Password = "@641f81cd1&295a01";
		$mail->From = "hospitalsystem160@gmail.com";*/
		$mail->Username = "raisingravi518@gmail.com";
		$mail->Password = "ravikumar@518";
		$mail->From = "hospitalsystem160@gmail.com";
		$mail->FromName = "MyPulse";
        $mail->SMTPDebug = 2;
		$mail->Subject  = $data['subject'];
        $mail->Body     = $data['body'];
        $mail->IsHTML(true); 
		$mail->AddAddress($data['email']);
		if(!$mail->Send()){
            //var_dump($mail->ErrorInfo);exit;
			return false;
		}else{
			return true;
		}
    }
    
}
?>