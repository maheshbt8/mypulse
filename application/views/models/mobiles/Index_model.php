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
	
public function cancelRegOTP($otpid){		
		
		
		$getotpnumber = $this->db->query("SELECT * FROM `hms_users_otp` WHERE `OTPID` = '$otpid' AND Status = 0 ORDER BY `OTPID` DESC
")->row();
		//print_r($getotpnumber);
		
		if(!empty($getotpnumber)){
			
							$this->db->delete('hms_users_otp', array('OTPID'=>$otpid));
							
			return  array('Status' => 1,"Message"=>$this->lang->line('reg_cancelled'));
		}
		else{
			return  array('Status' => 0,"Message"=>$this->lang->line('valid_otp_id'));
		}
	}
	
public function getlogindata($unm = NULL, $pwd = NULL){
		
		$query=$this->db->query("select id,first_name,MiddleName,last_name,useremail,mobile,isActive,EmailVerified,MobileVerified,role,my_key,profile_photo from hms_users where useremail=? and password=?",array($unm,$pwd))->result();
		//print_r()
		if(empty($query)){
		    $query = $this->db->query("select id,first_name,MiddleName,last_name,useremail,mobile,isActive,EmailVerified,MobileVerified,role,my_key,profile_photo from hms_users where mobile=? and password=?",array($unm,$pwd))->result();
		}
        if(!empty($query))
        {
            foreach ($query as $row)
            {
                if($row->isActive == 1 && ($row->EmailVerified==1 || $row->MobileVerified==1)){
				      if($row->useremail){
					  $this->db->query("UPDATE hms_users SET LastLogintime= '".date("Y-m-d H:i:s")."' WHERE useremail= '".$row->useremail."' ");
					  }
                    //$this->setSessionData($row);
                    return $query;
                }else{
                    return false;
                }
            }
        }
        else{
            return false;
			}
	}			
	
function setSessionData($row){
       
        $session_data = array( 
            'user_name' => $row->first_name.' '.$row->last_name,
            'email_id' => $row->useremail,
            'user_id' => $row->id,
            'role' => $row->role,
            'my_key' => $row->my_key,
            'profile_img' => $row->profile_photo,
            'logged_in' => '1'
        );

        $RoletblName = "";
        switch ($row->role) {
            case $this->auth->getHospitalAdminRoleType(): $RoletblName = "hms_hospital_admin"; break;
            case $this->auth->getDoctorRoleType(): $RoletblName = "hms_doctors"; break;
            case $this->auth->getReceptienstRoleType(): $RoletblName = "hms_receptionist"; break;
            case $this->auth->getNurseRoleType(): $RoletblName = "hms_nurse"; break;            
            case $this->auth->getMedicalStoreRoleType(): $RoletblName = "hms_medical_store"; break;            
            case $this->auth->getMedicalLabRoleType(): $RoletblName = "hms_medical_lab"; break;            
        }

        //Check assigned role is active or not. iF not active set user role as Patient.
        if($RoletblName != ""){
            $res = $this->db->query("select * from {$RoletblName} where user_id={$row->id} and isDeleted=0 and isActive=1");
            if(!$res || $res->num_rows() == 0){
                $session_data['role'] = $this->auth->getPatientRoleType();   
            }
        }

        if($row->role == $this->auth->getHospitalAdminRoleType()){
            $this->db->where('user_id',$row->id);
            $this->db->where('isActive',1);
            $this->db->where('isDeleted',0);
            $adminRecord = $this->db->get('hms_hospital_admin');
            $adminRecord = $adminRecord->result_array();
            if(isset($adminRecord[0]) && isset($adminRecord[0]['hospital_id'])){
                $session_data['hospital_id'] = $adminRecord[0]['hospital_id'];
            }
        }else if($row->role == $this->auth->getDoctorRoleType()){
            $uid = $row->id;
            $doc = $this->db->query("select b.hospital_id from hms_doctors d,hms_departments p,hms_branches b where d.user_id=$uid and d.department_id = p.id and p.branch_id = b.id")->row_array();
            if(isset($doc['hospital_id'])){
                $session_data['hospital_id'] = $doc['hospital_id'];
            }
        }else if($row->role == $this->auth->getReceptienstRoleType()){
            $uid = $row->id;
            $doc = $this->db->query("select b.hospital_id from hms_receptionist r,hms_doctors d,hms_departments p,hms_branches b where r.user_id=$uid and r.doc_id=d.id and d.department_id = p.id and p.branch_id = b.id")->row_array();
            if(isset($doc['hospital_id'])){
                $session_data['hospital_id'] = $doc['hospital_id'];
            }
        }else if($row->role == $this->auth->getNurseRoleType()){
            $uid = $row->id;
            $doc = $this->db->query("select b.hospital_id from hms_nurse d,hms_departments p,hms_branches b where d.user_id=$uid and d.department_id = p.id and p.branch_id = b.id")->row_array();
            if(isset($doc['hospital_id'])){
                $session_data['hospital_id'] = $doc['hospital_id'];
            }
        }   
        $session_set = $this->session->set_userdata($session_data);
    }
	
function resetPassword($mobilenumber = NULL,$password = NULL){
        
        	$q = $this->db->query("update hms_users set password='$password',updated_at='".date('Y-m-d H:i:s')."' where mobile='$mobilenumber'");
			//echo "update hms_users set password='$password' where mobile='$mobilenumber'";exit;
            if($this->db->affected_rows()>0)
            {
				//$this->logger->log("Password reset", Logger::User, $id);
                return true;
            }
            else{
                return false;
			}	   
        
    } 			

}
?>