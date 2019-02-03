<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Index extends REST_Controller {
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('api/index_model');
    }


/*Login For Users*/
    public function login_post() {
        // Get the post data
        $emailormobile = $this->post('emailormobile');
        $password = $this->post('password');
            // Check if any user exists with the given credentials
            $user = $this->index_model->user_login($emailormobile,$password);
            if($user){
                // Set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'User login successful.',
                    'data' => $user
                ], REST_Controller::HTTP_OK);
            }else{
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
                $this->response([
                    'status' => FALSE,
                    'message' => 'Invalid Login Details.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
    }
    public function checkMobileExist_post(){
        $phone = $this->post('mobilenumber');
        $validation_phone = mobile_validation($phone);
        if($validation_phone==0){
           $check_users=$this->db->get_where('users',array('phone'=>$phone))->row_array();
        }
    if($validation_phone == 1 || $check_users['reg_status']=='2'){
        $this->response([
                    'status' => TRUE
                ], REST_Controller::HTTP_OK);
        }else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Mobile Number Already Existed.'
                ], REST_Controller::HTTP_BAD_REQUEST);
        }
    
    }
    
  public function checkEmailExist_post(){
        $email = $this->post('email');
        $phone = $this->post('mobilenumber');
        $validation_email = email_validation($email);
        if($validation_email==0){
           $check_email=$this->db->get_where('users',array('email'=>$email))->row_array();
        }
    if($validation_email == 1 || ($check_email['phone']==$phone && $check_email['reg_status']=='2')){
        $this->response([
                    'status' => TRUE
                ], REST_Controller::HTTP_OK);
        }else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'This email id is already registered with us.'
                ], REST_Controller::HTTP_BAD_REQUEST);
        }
        
    }
    public function sendOTPtoMobile_post(){
        $phone = $this->post('mobilenumber');
        $name = strip_tags($this->post('name'));
        $num="12345678901234567890";
        $shu=str_shuffle($num);
        $otp=substr($shu, 14);
        $data['phone']=$phone;
        $message='Dear '. ucfirst($name) . ', Welcome To MyPulse Your OPT Number :' . $otp.'. Please use the code within 2 minutes.' ;  
        $send=$this->sms_model->send_sms($message, $data['phone']);
        if($send){
        $this->response([
                    'status' => TRUE,
                    'sent_otp' => $otp,
                    'otp_time'=>date('Y-m-d H:i:s'),
                    'message'=>'OTP Send To :'.$data['phone']
                ], REST_Controller::HTTP_OK);
        }
    }
    public function verifyOTPNumber_post(){
        $sent_otp = $this->post('sent_otp');
        $otpnumber = $this->post('otpnumber');
        $past_time = strtotime($this->post('otp_time'));
    $current_time = time();
    $difference = $current_time - $past_time;
    $difference_minute =  $difference/60;
    if(intval($difference_minute)<3){
        if($sent_otp == $otpnumber){
            $this->response([
                    'status' => TRUE
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'OTP Not Correct.'
                ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }else{
        $this->response([
                    'status' => FALSE,
                    'message' => 'OTP Time Was Experied.'
                ], REST_Controller::HTTP_BAD_REQUEST);
        }
        
    }
    public function registration_post() {
        // Get the post data
        $name = strip_tags($this->post('name'));
        $phone = strip_tags($this->post('mobilenumber'));
        $email = strip_tags($this->post('email'));
        $password = $this->post('password');
        $validation_phone = mobile_validation($phone);
        $data['name']       = $name;
        $data['email']      = $email;
        $data['password']   = sha1($password);
        $data['phone']      = $phone;
        $data['status']   = 1;
        $data['is_mobile']   = 1;
        if($validation_phone==1){
        $insert=$this->db->insert('users',$data);
        $lid=$this->db->insert_id();
if($lid==1){
$num=100001;
}elseif($lid!=1){
$my=explode('_',$this->db->where('user_id',$lid-1)->get('users')->row()->unique_id);
$year=substr ($my[0], -2);
if($year==date('y')){
$num=$my[1]+1;
}else{
$num=100001;
}
}
$pid='MPU'.date('y').'_'.$num;
        $this->db->where('user_id',$lid)->update('users',array('unique_id'=>$pid));
        }elseif($validation_phone!=1){
        $data['reg_status']   = '1';
        $insert=$this->db->where('phone',$phone)->update('users',$data);
        }
        if($insert)
        {
        $this->email_model->account_opening_email('users','user', $data['email']);
        $this->response([
                    'status' => TRUE,
                    'message' => 'Registration Completed Successfully.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'Registration Not Completed.'
                ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    
    public function hospitals_get($id=''){
        $hospitals = $this->index_model->select_hospitals_info($id);
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
    public function doctors_get($id=''){
        $doctors = $this->index_model->select_doctors_info($id);
        if($doctors){
            $response = array("Status"=>1,
                              "doctors"=>$doctors,
                              "doctors_count"=>count($doctors)
                              );
        }else{
            $response = array("Status"=>0,
                              "Message"=>'No Data Found',
                              "doctors_count"=>0
                              );
            
        }
    $this->response($response);
    }
    public function medicalstores_get($id=''){
        $stores = $this->index_model->select_stores_info($id);
        if($stores){
            $response = array("Status"=>1,
                              "stores"=>$stores,
                              "stores_count"=>count($stores)
                              );
        }else{
            $response = array("Status"=>0,
                              "Message"=>'No Data Found',
                              "stores_count"=>0
                              );
            
        }
    $this->response($response);
    }
    public function medicallabs_get($id=''){
        $labs = $this->index_model->select_labs_info($id);
        if($labs){
            $response = array("Status"=>1,
                              "labs"=>$labs,
                              "labs_count"=>count($labs)
                              );
        }else{
            $response = array("Status"=>0,
                              "Message"=>'No Data Found',
                              "labs_count"=>0
                              );
        }
    $this->response($response);
    }
    public function inpatient_get($id=''){
        $inpatient = $this->index_model->select_inpatient_info($id);
        if($inpatient){
            $response = array("Status"=>1,
                              "inpatient"=>$inpatient
                              );
        }else{
            $response = array("Status"=>0,
                              "Message"=>'No Data Found'
                              );
        }
    $this->response($response);
    }
    public function inpatient_history_get($id=''){
        $inpatient_history = $this->index_model->select_inpatient_history_info($id);
        if($inpatient_history){
            $response = array("Status"=>1,
                              "inpatient_history"=>$inpatient_history
                              );
        }else{
            $response = array("Status"=>0,
                              "Message"=>'No Data Found'
                              );
        }
    $this->response($response);
    }
    public function appointments_get($id=''){
        $appointments = $this->index_model->select_appointments_info($id);
        if($appointments){
            $response = array("Status"=>1,
                              "appointments"=>$appointments
                              );
        }else{
            $response = array("Status"=>0,
                              "Message"=>'No Data Found'
                              );
        }
    $this->response($response);
    }
    public function appointments_by_date_get($id = '',$param1 = '', $param2 = '',$param3=''){
        $appointments = $this->index_model->select_appointment_info_by_date($id);
        if($appointments){
            $response = array("Status"=>1,
                              "appointments"=>$appointments
                              );
        }else{
            $response = array("Status"=>0,
                              "Message"=>'No Data Found'
                              );
        }
    $this->response($response);
    }

/*Login For Users*/
    /*Testing Only*/
  /*  public function hospitals_get(){
    $hospital_data=$this->index_model->select_hospital_info();
      $id = $this->get('hospital_id');
        // If the id parameter doesn't exist return all the users
        if ($id === NULL)
        {
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($hospital_data)
            {
                // Set the response and exit
                $this->response($hospital_data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
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

        $hospital = NULL;

        if (!empty($hospital_data))
        {
            foreach ($hospital_data as $key => $value)
            {
                if (isset($value['hospital_id']) && $value['hospital_id'] === $id)
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
    }*/
    public function hospital_get(){
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
    public function hospitalls_get(){
    $hospital_data=$this->index_model->select_hospital_info();
    $status=0;
    if($hospital_data){
    $status=1;
    }
    if($status==0)
    {
        $mainarray['status']=$status;
        $mainarray['message']="Data Not Added";
    }else{
        $mainarray['status']=$status;
        $mainarray['result']=$hospital_data;
    }              
$ar['status']=$status;
   $ajson = array();
   $ajson[] = $mainarray;
   $finalresult=json_encode($ajson);
   echo $finalresult;
    }
}
