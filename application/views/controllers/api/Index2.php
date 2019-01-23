<?php 
use Restserver\Libraries\REST_Controller;
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/*require APPPATH.'libraries/REST_Controller.php';*/   
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Index extends REST_Controller {
    protected $client_request = NULL;
	function __construct(){
		error_reporting(E_ALL);
		header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
            die();
		}
		parent::__construct();
		$this->load->model('mobiles/index_model');
		$this->load->model('api/index_model');
		//$this->load->helper('mobile/mobile_track_helper');
		$this->client_request = new stdClass();
		$this->client_request = json_decode(file_get_contents('php://input', true));
	}
	public function userlogins_post(){
        $emailormobile = $this->input->post('username');
        $password = $this->input->post('password');
        $logindata = $this->index_model->user_login($emailormobile,$password);
        if($logindata){
            $response = array("Status"=>1,
                              "logindata"=>$logindata
                              );
        }else{
            $response = array("Status"=>0,
                              "Message"=>'Invalid Login Details',
                              );
            
        }
    $this->response($response);
    }
     public function hospitals_get($id=''){
        $hospitals = $this->index_model->select_hospitalls_info($id);
        if($hospitals){
            $response = array("Status"=>1,
                              "hospitals"=>$hospitals,
                              "hospitals_count"=>count($hospitals)
                              );
        }else{
            $response = array("Status"=>0,
                              "Message"=>'No Data Found',
                              "hospitals_count"=>0
                              );
            
        }
    $this->response($response);
    }
	public function userlogin_post(){
		$emailormobile = $this->post('emailormobile');
		$password = md5($this->post('password'));
		
		$logindata = $this->index_model->getlogindata($emailormobile,$password);
		if($logindata){
			//$data['infos']= array( sprintf($this->lang->line('msg_welcome'),$this->auth->getUsername()));
			$response = array("Status"=>1,
							  "logindata"=>$logindata
							  );
		}else{
			$response = array("Status"=>0,
							  "Message"=>$this->lang->line('usr_acc_invalid_credential'),
							  );
			
		}
		
		$this->response($response);

	}
	public function users_get()
    {
        // Users from a data store e.g. database
        $users = [
            ['id' => 1, 'name' => 'John', 'email' => 'john@example.com', 'fact' => 'Loves coding'],
            ['id' => 2, 'name' => 'Jim', 'email' => 'jim@example.com', 'fact' => 'Developed on CodeIgniter'],
            ['id' => 3, 'name' => 'Jane', 'email' => 'jane@example.com', 'fact' => 'Lives in the USA', ['hobbies' => ['guitar', 'cycling']]],
        ];

        $id = $this->get('id');

        // If the id parameter doesn't exist return all the users

        if ($id === NULL)
        {
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($users)
            {
                // Set the response and exit
                $this->response($users, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No users were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        // Find and return a single record for a particular user.

        $id = (int) $id;

        // Validate the id.
        if ($id <= 0)
        {
            // Invalid id, set the response and exit.
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // Get the user from the array, using the id as key for retrieval.
        // Usually a model is to be used for this.

        $user = NULL;

        if (!empty($users))
        {
            foreach ($users as $key => $value)
            {
                if (isset($value['id']) && $value['id'] === $id)
                {
                    $user = $value;
                }
            }
        }

        if (!empty($user))
        {
            $this->set_response($user, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'User could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }
	public function test_get(){
		$mobilenumber = '8121815502'/*$this->post('mobilenumber')*/;
		$checkmobile = $this->index_model->checkMobileExists($mobilenumber);
		if($checkmobile){
			$otpid = $this->index_model->sendRegisterOTPtoMobile($mobilenumber);
			$otpnumber = $this->db->query("SELECT OTPNumber FROM hms_users_otp WHERE OTPID = '".$otpid."'")->row();
			$response = array('Status' => 1, 
							  'OTPID'=>$otpid,
							  'OTPNumber'=>$otpnumber->OTPNumber,		
							  'Message' => $this->lang->line('register_otp_msg').' '.$UserMobile.' '.$this->lang->line('register_otp_msg1')
							  );
		}else{
			 $response = array('Status' => 0,
						  	  "Message" => 'Mobile Not Exists'
						  	  );
		}
		
		$this->response($response);

	}
		/****MANAGE STUDENTS CLASSWISE*****/
/*	function exactive_add()
	{
    $status=0;
			$array=array(
			'exactive_name'=>$this->input->post('name'),
			'exactive_sex'=>$this->input->post('sex'),
			'exactive_address'=>$this->input->post('address'),
			'exactive_phone'=>$this->input->post('phone'),
			'exactive_email'=>$this->input->post('email'),
			'exactive_password'=>sha1($this->input->post('password')),
			'manager_id'=>$this->input->post('manager_id'),
			'added_by'=>$this->input->post('login_type'),
			'status'=>'1',
			);
			$qry=$this->db->insert('exactive',$array);
			if($qry){
			$exactive=$this->db->insert_id();
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/exactive_image/' . $exactive . '.jpg');
			$status =1;
			
			}
			
			if($status==0)
                 {
                    $mainarray['status']=$status;
                    $mainarray['message']="Data Not Added";
                 }
                else
                {
                    $mainarray['status']=$status;
                    $mainarray['message']="Data Added Successfully";
                 }
                 
                 $ar['status']=$status;
   $ajson = array();
   $ajson[] = $mainarray;
   $finalresult=json_encode($ajson);
   echo $finalresult;
		
		
	}*/

	public function hospitals_get(){
	$hospital_data=$this->index_model->select_hospital_info();
	if(!empty($hospital_data)){
			$response = array('Status' => 1, 		
							  'Message' => 'Hospital Data',
							  'hospital_data'=>$hospital_data
							  );
		}else{
			$response = array('Status' => 0,
						  	  "Message" => 'No Data'
						  	  );
		}
	echo json_encode($response);
	}
	/*public function sendOTPtoRegisteredMobile_post(){
		//$user_input = $this->client_request;
		$UserMobile = $this->post('mobilenumber');
		$checkmob = $this->index_model->checkMobileExist($UserMobile);
		if(!empty($checkmob)){
			$response = array('Status' => 0,
						  	  "Message" => $this->lang->line('msg_mobile_exist')
						  	  );
		}else{
		$otpid = $this->index_model->sendRegisterOTPtoMobile($UserMobile);
		$otpnumber = $this->db->query("SELECT OTPNumber FROM hms_users_otp WHERE OTPID = '".$otpid."'")->row();
			$response = array('Status' => 1, 
							  'OTPID'=>$otpid,
							  'OTPNumber'=>$otpnumber->OTPNumber,		
							  'Message' => $this->lang->line('register_otp_msg').' '.$UserMobile.' '.$this->lang->line('register_otp_msg1')
							  );
		}
		
		$this->response($response);	
	
	}
	
	public function verifyOTPNumber_post(){
		//$user_input = $this->client_request;
		
		//$otpnumber = $user_input->OTPNumber;
		$otpid = $this->post('otpid');
		$otpnumber = $this->post('otpnumber');
		$response = $this->index_model->VerifyNewOTPNumber($otpnumber,$otpid);
		
		$this->response($response);
		
	}	
		
	public function checkMobileExist_post(){
		
		
		$UserMobile = $this->post('mobilenumber');
		
		$response = $this->index_model->checkMobileExist($Mobile);
		
		$this->response($response);	
	
	}
	
  public function checkEmailExist_post(){
		$user_input = $this->client_request;
		
		$UserMobile = $this->post('emailid');
		
		$response = $this->index_model->checkEmailExist($EmailID);
		
		echo json_encode($response);
		
	}
	
public function doRegistration_post(){
		$user_input = $this->client_request;
		
		
        $name = explode(" ",$this->post('fullname'));
		$EmailID = $this->post('emailid');
		$MobileNumber = $this->post('mobilenumber');
		$password = md5($this->post('password'));
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
            
public function cancelRegistration_post(){
	
		$otpid = $this->post('otpid');
		$response = $this->index_model->cancelRegOTP($otpid);
		
		$this->response($response);
		
	}
	
public function userlogin_post(){
		
		$emailormobile = $this->post('emailormobile');
		$password = md5($this->post('password'));
		
		$logindata = $this->index_model->getlogindata($emailormobile,$password);
		if($logindata){
			//$data['infos']= array( sprintf($this->lang->line('msg_welcome'),$this->auth->getUsername()));
			$response = array("Status"=>1,
							  "logindata"=>$logindata
							  );
		}else{
			$response = array("Status"=>0,
							  "Message"=>$this->lang->line('usr_acc_invalid_credential'),
							  );
			
		}
		
		$this->response($response);

	}
	
public function forgotPassword_post(){
		
		$mobilenumber = $this->post('mobilenumber');
		$checkmobile = $this->index_model->checkMobileExist($mobilenumber);
		if($checkmobile){
			$otpid = $this->index_model->sendRegisterOTPtoMobile($mobilenumber);
			$otpnumber = $this->db->query("SELECT OTPNumber FROM hms_users_otp WHERE OTPID = '".$otpid."'")->row();
			$response = array('Status' => 1, 
							  'OTPID'=>$otpid,
							  'OTPNumber'=>$otpnumber->OTPNumber,		
							  'Message' => $this->lang->line('register_otp_msg').' '.$UserMobile.' '.$this->lang->line('register_otp_msg1')
							  );
		}else{
			 $response = array('Status' => 0,
						  	  "Message" => $this->lang->line('msg_mobile_notexist')
						  	  );
		}
		
		$this->response($response);

	}
	
public function resetPassword_post(){
		$mobilenumber = $this->post('mobilenumber');
		$password = md5($this->post('password'));
		$setpassword = $this->index_model->resetPassword($mobilenumber,$password);
		if($setpassword){
			$response = array("Status"=>1,"Message"=>$this->lang->line('msg_password_change'));
		}else{
		
			$response = array("Status"=>0,"Message"=>'Something went wrong');
		}
		
		$this->response($response);
		
	}		*/
	
			
				
}

?>