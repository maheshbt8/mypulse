<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Index_model extends CI_Model {
	
public function checkMobileExist($mobnumber = NULL){
		
		$checkmob = $this->db->query("SELECT `id` FROM `hms_users` WHERE `mobile` = '$mobnumber' AND `isRegister` !='0'")->row();
		if($checkmob){
		return $checkmob; 
		}else{
		return false;
		}
	}
	
public function checkEmailExist($EmailID = NULL){
				
		$checkemail = $this->db->query("SELECT `id` FROM `hms_users` WHERE `useremail` = '$EmailID'  AND `isRegister` !='0'")->row();
		if($checkemail){
		return $checkemail; 
		}else{
		return false;
		}
	}	

public function sendRegisterOTPtoMobile($mobno = NULL){
		$otp = rand(100000,999999);
		$message="$otp is your OTP Number to login";
		$json = json_decode(file_get_contents("https://smsapi.engineeringtgr.com/send/?Mobile=9739195391&Password=mypulse123&Message=".urlencode($message)."&To=".urlencode($mobno)."&Key=vrredbqiVYIctT1koQxs2E"),true);
		$mobile="$mobno";
		$otpdata = array(
		'MobileNumber' => $mobno,
		'OTPNumber' => $otp,
		'CreatedDate' => date('Y-m-d H:i:s'),
		'Status' => 0,
		);
		$this->db->insert("hms_users_otp", $otpdata);
		$idata = $this->db->insert_id();
		
		if($idata){
		
		return $idata;
		}
		
		}
		
public function VerifyNewOTPNumber($otpnumber = NULL, $otpid = NULL){

		$getotpnumber = $this->db->query("SELECT * FROM `hms_users_otp` WHERE `OTPID` = '$otpid' AND Status = 0 ORDER BY `OTPID` DESC ")->row();
		$dbdate = strtotime($getotpnumber->CreatedDate);
		if (time() - $dbdate > 10 * 60) {
		return  array('Status' => 2, 'message' => $this->lang->line('otp_verification_incomplete'));
		}else if($getotpnumber->OTPNumber == $otpnumber){
		
		$this->db->delete('hms_users_otp', array('OTPID'=>$otpid));
		
		return  array('Status' => 1);
		}
		else{
		return  array('Status' => 0,'Message'=>'Please enter valid otp');
		}
	}
	
public function doReg($RegistrationData = NULL){
		if($RegistrationData){
		$this->db->insert('hms_users',$RegistrationData);
		$uid = $this->db->insert_id();
		if($uid){
		return $uid;
		}else{
			return false;
			}
		}else{
			return false;
		}

	}	
		

}
?>