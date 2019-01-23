<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Index_model extends CI_Model {

public function user_login($unm = '', $pwd = ''){
		$where = "email='".$unm."' OR phone='".$unm."' AND password='".sha1($pwd)."' AND status='1'  AND is_mobile='1'";
        $query = $this->db->where($where)->get('users')->row_array();
        if(!empty($query))
        {
        return $query;
        }else{
		return false;
		}
	}
	public function select_hospitals_info($id = ''){
	$hospital=$this->db->where('user_id',$id)->get('patient')->row()->hospital_ids;
        if($hospital>0){
        $hospital_ids=explode(',',$hospital);
        if($hospital_ids != ''){
        for($i=0;$i<count($hospital_ids);$i++){
            $hospi[$i]=$this->db->where('hospital_id',$hospital_ids[$i])->get('hospitals')->row_array();
            }
        }
        }
        if($hospi){
		return $hospi; 
		}else{
		return false;
		}
    }
    public function select_doctors_info($id = ''){
	$doctor=$this->db->where('user_id',$this->session->userdata('login_user_id'))->get('patient')->row();
        if($doctor>0){
        $doctor_ids=explode(',',$doctor->doctor_ids);
        for($i=0;$i<count($doctor_ids);$i++){
            if($doctor_ids[$i]!=''){
            $doctors[$i]=$this->db->where('doctor_id',$doctor_ids[$i])->get('doctors')->row_array();
            }
        }
        } 
       	if($doctors){
		return $doctors; 
		}else{
		return false;
		}
    }
    public function select_stores_info($id = ''){
	$stores=$this->db->where('user_id',$id)->get('patient')->row()->store_ids;
        if($stores!=''){
            $store_ids=explode(',',$stores);
        for($i=0;$i<count($store_ids);$i++){
            $stores[$i]=$this->db->where('store_id',$store_ids[$i])->get('medicalstores')->row_array();
            }
        } 
       	if($stores){
		return $stores; 
		}else{
		return false;
		}
    }
    public function select_labs_info($id = ''){
	 $labs=$this->db->where('user_id',$id)->get('patient')->row()->lab_ids;
        if($labs!=''){ 
        $lab_ids=explode(',',$labs);
        for($i=0;$i<count($lab_ids);$i++){
            $labs[$i]=$this->db->where('lab_id',$lab_ids[$i])->get('medicallabs')->row_array();
            }
		} 
       	if($labs){
		return $labs; 
		}else{
		return false;
		}
    }
    public function select_inpatient_info($id = ''){
	 $inpatient=$this->db->where('user_id',$id)->order_by('id','desc')->get_where('inpatient',array('status'=>1))->result_array();
       	if($inpatient){
		return $inpatient; 
		}else{
		return false;
		}
    }
    public function select_inpatient_history_info($id = ''){
	 $inpatient=$this->db->order_by('id','desc')->where('in_patient_id',$id)->get('inpatient_history')->result_array();
       	if($inpatient){
		return $inpatient; 
		}else{
		return false;
		}
    }
    public function select_appointments_info($id = ''){
	 $appointments=$this->db->order_by('appointment_number','DESC')->where('user_id',$id)->get('appointments')->result_array();
       	if($appointments){
		return $appointments; 
		}else{
		return false;
		}
    }
    public function select_appointment_info_by_date($id = '',$param1 = '', $param2 = '',$param3=''){
	 if($param1!='' && $param2!='' && $param3!=''){
    if($param3=='all'){
    return $this->db->get_where('appointments',array('user_id'=>$id,'appointment_date >='=>date('m/d/Y',strtotime($param1)),'appointment_date <='=>date('m/d/Y',strtotime($param2))))->result_array();
    }elseif($param3!='all'){
     return $this->db->get_where('appointments',array('user_id'=>$id,'appointment_date >='=>date('m/d/Y',strtotime($param1)),'appointment_date <='=>date('m/d/Y',strtotime($param2)),'status'=>$param3))->result_array();   
    }
        }elseif($param1!='' && $param2!='' && $param3==''){
    if($param3=='all'){
    return $this->db->get_where('appointments',array('user_id'=>$id,'appointment_date >='=>date('m/d/Y',strtotime($param1)),'appointment_date <='=>date('m/d/Y',strtotime($param2))))->result_array();
    }elseif($param3!='all'){
        return $this->db->get_where('appointments',array('user_id'=>$id,'appointment_date >='=>date('m/d/Y',strtotime($param1)),'appointment_date <='=>date('m/d/Y',strtotime($param2))))->result_array();
    }
        }elseif($param1=='' && $param2=='' && $param3!=''){
        if($param3=='all'){
        return $this->db->get_where('appointments',array('user_id'=>$id))->result_array();
        }elseif($param3!='all'){
        return $this->db->get_where('appointments',array('user_id'=>$id,'status'=>$param3))->result_array();
        }
        }
       	if($appointments){
		return $appointments; 
		}else{
		return false;
		}
    }

    /*Testing*/
public function select_hospital_info($id = ''){
		$hospitals=$this->db->get('hospitals')->result_array();
		if($hospitals){
		return $hospitals; 
		}else{
		return false;
		}
	}

public function checkMobileExists($mobnumber = NULL){
		
		$checkmob = $this->db->query("SELECT `user_id` FROM `users` WHERE `mobile` = '$mobnumber'")->row();
		if($checkmob){
		return $checkmob; 
		}else{
		return false;
		}
	}

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
	
		
	
}
?>