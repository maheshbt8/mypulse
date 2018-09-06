<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
require APPPATH.'libraries/REST_Controller.php';   

class Index extends REST_Controller {
    protected $client_request = NULL;
	function __construct(){
		//error_reporting(0);
		header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
            die();
			
		}
		parent::__construct();
		
		$this->load->model('mobiles/index_model');
		//$this->load->helper('mobile/mobile_track_helper');
		$this->client_request = new stdClass();
		$this->client_request = json_decode(file_get_contents('php://input', true));
	}
	
	
	public function sendOTPtoRegisteredMobile_post(){
	
		$user_input = $this->client_request;
		
		$UserMobile = $user_input->MobileNumber;
		$checkmob = $this->index_model->checkMobileExist($UserMobile);
		if(!empty($checkmob)){
			$response = array('Status' => 0,
						  	  "Message" => $this->lang->line('msg_mobile_exist')
						  	  );
		}else{
		$otpid = $this->index_model->sendRegisterOTPtoMobile($UserMobile);
			$response = array('Status' => 1, 
							  'OTPID'=>$otpid,		
							  'Message' => $this->lang->line('register_otp_msg').' '.$UserMobile.' '.$this->lang->line('register_otp_msg1')
							  );
		}
		
		$this->response($response);	
	
	}
	
	public function VerifyOTPNumber_post(){
		$user_input = $this->client_request;
		
		$otpnumber = $user_input->OTPNumber;
		$otpid = $user_input->OTPID;
		
		$response = $this->index_model->VerifyNewOTPNumber($otpnumber,$otpid);
		
		$this->response($response);
		
	}	
		
	public function checkMobileExist_post(){
		
		$user_input = $this->client_request;
		
		$Mobile = $user_input->MobileNumber;
		
		$response = $this->index_model->checkMobileExist($Mobile);
		
		$this->response($response);	
	
	}
	
  public function checkEmailExist_post(){
		$user_input = $this->client_request;
		
		$EmailID = $user_input->EmailID;
		
		$response = $this->index_model->checkEmailExist($EmailID);
		
		echo json_encode($response);
		
	}
	
public function doReg_post(){
		$user_input = $this->client_request;
		
		
        $name = explode(" ",$user_input->FullName);
		$EmailID = $user_input->EmailID;
		$MobileNumber = $user_input->MobileNumber;
		$password = md5($user_input->Password);
		$first_name = $name[0];
		if(isset($name[1])){
			$last_name = $name[1];
		}
		$key = strtoupper(bin2hex(openssl_random_pseudo_bytes(5)));
		$forgotPassCode = $key;

		$my_key = base64_encode((bin2hex(openssl_random_pseudo_bytes(32))));
        $role = 6;
		$isActive = 1;
		$MobileVerified = 1;
		$isRegister = 1;
								  
		$CheckEmail = $this->index_model->checkEmailExist($EmailID);
		if(!empty($CheckEmail)){
			$response = array('Status' => 0,
						  	  "Message" => $this->lang->line('msg_email_exist')
						  	  );
		}else{
		$RegistrationData = array('first_name'=>$first_name,
								  'last_name'=>$last_name,
								  'useremail'=>$EmailID,
								  'password'=>$password,
								  'my_key'=>$my_key,
								  'mobile'=>$MobileNumber,
								  'role'=>$role,
								  'isActive'=>$isActive,
								  'isDeleted'=>'0',
								  'created_at'=>date('Y-m-d H:i:s'),
								  'forgotPassCode'=>$forgotPassCode,
								  'isRegister'=>$isRegister,
								  'EmailVerified'=>'0',
								  'MobileVerified'=>$MobileVerified,	
								  );
		
		$uid = $this->index_model->doReg($RegistrationData);
		if ($uid){
					$this->logger->log("New user created", Logger::User, $uid);
					$email = $EmailID;
					$mobile = $MobileNumber;
                    $this->load->library('sendmail');
                    $enc = $key.":".$email;
                    $url = site_url().'/index/vacc?k='.base64_encode($enc);
                    $mail_data['body'] = 'Welcome to MyPulse,<br>To complete your MyPulse profile. Please verify your account by click on following link <br> <a href="'.$url.'">Verify Account</a>';
                    $mail_data['subject'] = 'MyPulse Registration ';
                    $mail_data['email'] = $email;
                    $this->sendmail->send($mail_data);
                                        
                $response = array("Status" => 1,
						  "Message" => $this->lang->line('reg_completed')
						  );
				}else{
				$response = array("Status"=>0,
								  "Message"=>'Some thing went wrong'
								  );
				}
				
			}
		$this->response($response);
		}
            
	
				
}

?>