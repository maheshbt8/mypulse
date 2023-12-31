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
        $emailormobile = $this->post('emailormobile');
        $password = $this->post('password');
            $user = $this->index_model->user_login($emailormobile,$password);
            if($user){
                $this->response([
                    'status' => TRUE,
                    'message' => 'User login successful.',
                    'data' => $user
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => FALSE,
                    'message' => 'Invalid Login Details.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
    }
    function logout_post(){
        $user_id = $this->post('user_id');
        $user = $this->index_model->logout_details($user_id);
        if($user){
                $this->response([
                    'status' => TRUE,
                    'message' => 'User logout successful.'
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => FALSE,
                    'message' => 'Not Loged Out.'
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
                    'message' => 'Mobile Number Already Registered.'
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
        $otp=otp_generate();
        $data['phone']=$phone;
        /*$message='Dear '. ucfirst($name) . ', Welcome To MyPulse. Your OPT Number: ' . $otp.'. Please use the code within 2 minutes.' ;*/
        $message= 'Thank you for registering with MyPulse. Your
verification code is ' . $otp.'.';
        $this->load->model('sms_model');
        $send=$this->sms_model->send_sms($message, $data['phone']);
        $this->response([
                    'status' => TRUE,
                    'sent_otp' => $otp,
                    'otp_time'=>date('Y-m-d H:i:s'),
                    'message'=>'OTP Send To :'.$data['phone']
                ], REST_Controller::HTTP_OK);
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
        $name = strip_tags($this->post('name'));
        $phone = strip_tags($this->post('mobilenumber'));
        $email = strip_tags($this->post('email'));
        $password = $this->post('password');
        if(!empty($name)&&!empty($phone)&& !empty($email)&&!empty($password))
        {
        $validation_phone = mobile_validation($phone);
        $data['name']       = $name;
        $data['email']      = $email;
        $data['password']   = hash ( "sha256",$password);
        $data['phone']      = $phone;
        $data['mobile_verify']   = 1;
        if($validation_phone==1){
        $insert=$this->db->insert('users',$data);
        $lid=$this->db->insert_id();
$pid=$this->crud_model->generate_unique_id($lid,'users');
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
                    'user_id'=>$lid,
                    'unique_id'=>$pid,
                    'name'   => $name,
                    'email'  => $email,
                    'password'=>$password,
                    'phone' => $phone,
                    'message' => 'Registration Completed Successfully.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'Registration Not Completed.'
                ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }else{
        $this->response([
                    'status' => FALSE,
                    'message' => 'Enter All Fields.'
                ], REST_Controller::HTTP_BAD_REQUEST);
    }
    }
    public function UserMobileExist_post(){
        $phone = $this->post('mobilenumber');
        $validation_phone = mobile_validation($phone);
        if($validation_phone==0){
           $check_users=$this->db->get_where('users',array('phone'=>$phone))->row_array();
        }
    if($validation_phone == 0 && $check_users['reg_status']=='1'){
        $this->response([
                    'status' => TRUE
                ], REST_Controller::HTTP_OK);
        }else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Mobile Number Not Registered.'
                ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function ForgotOTP_post(){
        $phone = $this->post('mobilenumber');
        $otp=otp_generate();
        $data['phone']=$phone;
        $message= 'Thank you for registering with MyPulse. Your
verification code is ' . $otp.'.';
        $this->load->model('sms_model');
        $send=$this->sms_model->send_sms($message, $data['phone']);
        $this->response([
                    'status' => TRUE,
                    'sent_otp' => $otp,
                    'otp_time'=>date('Y-m-d H:i:s'),
                    'message'=>'OTP Send To :'.$data['phone']
                ], REST_Controller::HTTP_OK);
    }
    public function ForgotOTPVerify_post(){
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
    public function ForgotPassword_post(){
        $phone = strip_tags($this->post('mobilenumber'));
        $new_password = hash ( "sha256",$this->post('new_password'));
    $confirm_new_password = hash ( "sha256",$this->post('confirm_new_password'));
$current_password_db = $this->db->get_where('users', array('phone' =>$phone))->row();
if($new_password == $confirm_new_password) {
$result = $this->index_model->change_password($current_password_db->user_id,$new_password);
    if($result){
        $this->response([
        'status' => TRUE,
        'message' => 'Password Update Successfully.'
        ], REST_Controller::HTTP_OK);
    }else{
       $this->response([
        'status' => FALSE,
        'message' => 'Password Update Failed.'
        ], REST_Controller::HTTP_BAD_REQUEST); 
    }
    }else{
        $this->response([
        'status' => FALSE,
        'message' => 'Password Not Matched.'
        ], REST_Controller::HTTP_BAD_REQUEST);
    }
    }
    /*********************Header*******************************/
     public function languages_get(){
        $languages = $this->index_model->get_languages();
        if($languages){
            $this->response([
                    'status' => TRUE,
                    'languages'=>$languages,
                    'message' => 'All Languages.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }
     public function notifications_get(){
        $user_id=$this->get('user_id');
        $notification = $this->index_model->get_notifications($user_id);
        $notification_count = $this->index_model->get_notification_count($user_id);
        if($notification){
            $this->response([
                    'status' => TRUE,
                    'notifications'=>$notification,
                    'unread_notifications'=>$notification_count,
                    'message' => 'All Notifications and Number of Un-read Notification count.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'unread_notifications'=>'0',
                    'message' => 'No Data Found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }
    public function notification_get(){
        $notification_id=$this->get('notification_id');
        $notification = $this->index_model->read_notification($notification_id);
        if($notification){
            $this->response([
                    'status' => TRUE,
                    'notification'=>$notification,
                    'message' => 'Single notification Details.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }
    public function messages_get(){
        $user_id=$this->get('user_id');
        $message = $this->index_model->get_messages($user_id);
        if($message){
        $account_details=$this->db->get_where('users',array('user_id'=>$user_id))->row()->unique_id;
               $c=0;
    foreach ($message as $row) {
      $count=explode(',',$row['is_read']);
    $s=0;
    for($m2=0;$m2<count($count);$m2++){
        if($account_details == $count[$m2]){
                $s=1;
                break;
        }
        }
        if($s==1){
            $a=TRUE;
        }elseif($s==0){
            $c++;
            $a=FALSE;
        }
        $row['is_read']=$a;
        $results[]=$row;
    }
            $this->response([
                    'status' => TRUE,
                    'messages'=>$results,
                    'unread_messages'=>$c,
                    'message' => 'All Messages and Number of Un-read Message count.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'unread_messages'=>'0',
                    'message' => 'No Data Found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }    
public function message_get(){
    $user_id=$this->get('user_id');
    $message_id=$this->get('message_id');
        $message = $this->index_model->read_message($user_id,$message_id);
        if($message){
            $this->response([
                    'status' => TRUE,
                    'messages'=>$message,
                    'message' => 'Single Message Details.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }
public function userProfile_get(){
     $user_id=$this->get('user_id');
    $result = $this->index_model->select_user_info($user_id);
    if($result){
        $this->response([
        'status' => TRUE,
        'user'=>$result,
        'message' => 'User Information.'
        ], REST_Controller::HTTP_OK);
    }else{
       $this->response([
        'status' => FALSE,
        'message' => 'No Data Found.'
        ], REST_Controller::HTTP_BAD_REQUEST); 
    }
}
 public function image_get(){
    $user_id=$this->get('user_id');
    if (file_exists('uploads/user_image/' . $user_id . '.jpg')){
            $image_url ='uploads/user_image/'. $user_id . '.jpg';
        }else{
            $image_url ='uploads/user.jpg';
        }
    /*$im = file_get_contents($image_url);
    header('content-type: image/png');*/
    echo $image_url;
    }
    public function upload_profile_post(){
        $user_id= $this->post('user_id');
        if($_FILES['userfile']['tmp_name']!=''){
        unlink('uploads/user_image/'. $user_id.  '.jpg');
        $file=move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/user_image/" . $user_id . '.jpg');
        }
        if($file){
            $this->response([
                    'status' => TRUE,
                    'message' => 'Profile Updated Successfully.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'Profile Not Updated.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }
public function profile_post(){
    $email = $this->post('email');
        $validation_email = email_validation($email);
     if($validation_email==0){
       $result = $this->index_model->update_user_info();
    if($result){
        $this->response([
        'status' => TRUE,
        'message' => 'User Information Updated Successfully.'
        ], REST_Controller::HTTP_OK);
    }else{
       $this->response([
        'status' => FALSE,
        'message' => 'User Information Not Updated.'
        ], REST_Controller::HTTP_BAD_REQUEST); 
    }
        }else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'This email id is already registered with us.'
                ], REST_Controller::HTTP_BAD_REQUEST);
        }
    
}
public function changePassword_post(){
    $user_id=$this->post('user_id');
    $current_password_input = hash ( "sha256",$this->post('password'));
    $new_password = hash ( "sha256",$this->post('new_password'));
    /*$confirm_new_password = hash ( "sha256",$this->post('confirm_new_password'));*/

$current_password_db = $this->db->get_where('users', array('user_id' =>$user_id))->row()->password;
if($current_password_db == $current_password_input) {
$result = $this->index_model->change_password($user_id,$new_password);
    if($result){
        $this->response([
        'status' => TRUE,
        'message' => 'Password Update Successfully.'
        ], REST_Controller::HTTP_OK);
    }else{
       $this->response([
        'status' => FALSE,
        'message' => 'Password Update Failed.'
        ], REST_Controller::HTTP_BAD_REQUEST); 
    }
    }else{
        $this->response([
        'status' => FALSE,
        'message' => 'Password Update Failed.'
        ], REST_Controller::HTTP_BAD_REQUEST);
    }
}
/******************************Basic Requireds***************************/
public function countries_get(){
    $countrys = $this->index_model->get_country();
        if($countrys){
            $this->response([
                    'status' => TRUE,
                    'countrys'=>$countrys,
                    'message' => 'Countrys.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.',
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
}
public function states_get(){
    $country_id=$this->get('country_id');
    $states = $this->index_model->get_state($country_id);
        if($states){
            $this->response([
                    'status' => TRUE,
                    'states'=>$states,
                    'message' => 'States.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.',
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
}
public function districts_get(){
    $state_id=$this->get('state_id');
    $districts = $this->index_model->get_district($state_id);
        if($districts){
            $this->response([
                    'status' => TRUE,
                    'districts'=>$districts,
                    'message' => 'Districts.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.',
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
}
public function cities_get(){
    $district_id=$this->get('district_id');
    $cities = $this->index_model->get_city($district_id);
        if($cities){
            $this->response([
                    'status' => TRUE,
                    'cities'=>$cities,
                    'message' => 'Cities.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.',
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
}
public function MedicalStoresForOrders_get(){
    $medicalstores = $this->index_model->get_medicalstores_info();
        if($medicalstores){
            $this->response([
                    'status' => TRUE,
                    'medicalstores'=>$medicalstores,
                    'message' => 'Medical Stores for Orders.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.',
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
}
public function MedicalLabsForOrders_get(){
    $medicallabs = $this->index_model->get_medicallabs_info();
        if($medicallabs){
            $this->response([
                    'status' => TRUE,
                    'medicallabs'=>$medicallabs,
                    'message' => 'Medical Labs for Orders.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.',
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
}
public function Specializations_get(){
    $specializations = $this->index_model->get_specializations_info();
        if($specializations){
            $this->response([
                    'status' => TRUE,
                    'medicallabs'=>$specializations,
                    'message' => 'All Specializations.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.',
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
}
    /*************************Dashboard**********************************/
    public function dashboard_get(){
        $user_id=$this->get('user_id');
        $hospitals = $this->index_model->select_hospitals_info($user_id);
        if($hospitals!=''){
            $hospitals=count($hospitals);
        }else{
            $hospitals=0;
        }
        $doctors = $this->index_model->select_doctors_info($user_id);
        if($doctors!=''){
            $doctors=count($doctors);
        }else{
            $doctors=0;
        }
        $stores = $this->index_model->select_stores_info($user_id);
        if($stores!=''){
            $stores=count($stores);
        }else{
            $stores=0;
        }
        $labs = $this->index_model->select_labs_info($user_id);
        if($labs!=''){
            $labs=count($labs);
        }else{
            $labs=0;
        }
        $appointments=$this->db->where('user_id',$user_id)->get('appointments')->num_rows();
        $notification_count = $this->index_model->get_notification_count($user_id);
        $message = $this->index_model->get_messages($user_id);
        $account_details=$this->db->get_where('users',array('user_id'=>$user_id))->row()->unique_id;
               $c=0;
    foreach ($message as $row) {
      $count=explode(',',$row['is_read']);
    $s=0;
    for($m2=0;$m2<count($count);$m2++){
        if($account_details == $count[$m2]){
                $s=1;
                break;
        }
        }
        if($s==1){
            $a=TRUE;
        }elseif($s==0){
            $c++;
            $a=FALSE;
        }
        $row['is_read']=$a;
        $results[]=$row;
    } 
    $message_count=$c;
            $this->response([
                    'status' => TRUE,
                    'hospitals_count'=>$hospitals,
                    'doctors_count'=>$doctors,
                    'medicalstores_count'=>$stores,
                    'medicallabs_count'=>$labs,
                    'appointments_count'=>$appointments,
                    'notifications_count'=>$notification_count,
                    'messages_count'=>$message_count,
                    'message' => 'All Hospitals, Doctors, Medical Stores, Medical Labs & Appointments count.'
                ], REST_Controller::HTTP_OK);
    }
    public function upcomingAppointments_get(){
        $user_id=$this->get('user_id');
        $appointments = $this->index_model->select_upcoming_appointments($user_id);
        if($appointments){
            $this->response([
                    'status' => TRUE,
                    'upcoming_appointments'=>$appointments,
                    'message' => 'Upcoming Appointments.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.',
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }
     public function recommendAppointments_get(){
        $user_id=$this->get('user_id');
        $appointments = $this->index_model->select_recommend_appointments($user_id);
        if($appointments){
            $this->response([
                    'status' => TRUE,
                    'recommend_appointments'=>$appointments,
                    'message' => 'Recommend Appointments.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.',
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }
     public function OutstandingMedicines_get(){
        $user_id=$this->get('user_id');
        $prescriptions = $this->index_model->outstanding_prescriptions_medicines($user_id);
        if($prescriptions){
            
            $this->response([
                    'status' => TRUE,
                    'outstanding_prescriptions'=>$prescriptions,
                    'message' => 'OUTSTANDING PRESCRIPTIONS FOR MEDICINES.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.',
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }
      public function OutstandingTests_get(){
        $user_id=$this->get('user_id');
        $prescriptions = $this->index_model->outstanding_prescriptions_tests($user_id);
        if($prescriptions){
           
            $this->response([
                    'status' => TRUE,
                    'outstanding_prescriptions'=>$prescriptions,
                    'message' => 'OUTSTANDING PRESCRIPTIONS FOR MEDICAL TESTS.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.',
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }
    /*********************Hospitals*******************************/
    public function hospitals_get(){
        $user_id=$this->get('user_id');
        $hospitals = $this->index_model->select_hospitals_info($user_id);
        if($hospitals){
            $this->response([
                    'status' => TRUE,
                    'hospitals'=>$hospitals,
                    'hospitals_count'=>count($hospitals),
                    'message' => 'All Hospitals and Number of hospitals count.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.',
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }
    public function hospital_get(){
        $hospital_id=$this->get('hospital_id');
        $hospitals = $this->index_model->select_hospital_info($hospital_id);
        if($hospitals){
            $this->response([
                    'status' => TRUE,
                    'hospitals'=>$hospitals,
                    'message' => 'Single Hospital Details.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }
    public function hospital_delete($id,$hospital_id){
        $hospitals = $this->index_model->delete_patient_hospital($id,$hospital_id);
        if($hospitals){
            $this->response([
                    'status' => TRUE,
                    'message' => 'Hospital Deleted Successfully.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'Hospital Not Deleted.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }
    
    /*********************Doctors*******************************/
    public function doctors_get(){
        $user_id=$this->get('user_id');
        $doctors = $this->index_model->select_doctors_info($user_id);
        if($doctors){
            $this->response([
                    'status' => TRUE,
                    'doctors'=>$doctors,
                    'doctors_count'=>count($doctors),
                    'message' => 'All doctors and Number of doctors count.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
    
    }
    public function doctor_get(){
        $doctor_id=$this->get('doctor_id');
        $doctors = $this->index_model->select_doctor_info($doctor_id);
        if($doctors){
            $this->response([
                    'status' => TRUE,
                    'doctors'=>$doctors,
                    'message' => 'Single Doctors Details.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }
    public function doctor_delete($id,$doctor_id){
        $doctor = $this->index_model->delete_patient_doctor($id,$doctor_id);
        if($doctor){
            $this->response([
                    'status' => TRUE,
                    'message' => 'Doctor Deleted Successfully.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'Doctor Not Deleted.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }
    /*********************Medical Stores*******************************/
    public function medicalstores_get(){
        $user_id=$this->get('user_id');
        $stores = $this->index_model->select_stores_info($user_id);
        if($stores){
            $this->response([
                    'status' => TRUE,
                    'stores'=>$stores,
                    'stores_count'=>count($stores),
                    'message' => 'All Medical stores and Number of Medical stores count.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }
    public function medicalstore_get(){
        $store_id=$this->get('store_id');
        $store = $this->index_model->select_store_info($store_id);
        if($store){
            $this->response([
                    'status' => TRUE,
                    'store'=>$store,
                    'message' => 'Single Medical Store Details.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }
    public function medicalstore_delete($id,$store_id){
        $store = $this->index_model->delete_patient_store($id,$store_id);
        if($store){
            $this->response([
                    'status' => TRUE,
                    'message' => 'Medical Store Deleted Successfully.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'Medical Store Not Deleted.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }
    /*********************Medical Labs*******************************/
    public function medicallabs_get(){
        $user_id=$this->get('user_id');
        $labs = $this->index_model->select_labs_info($user_id);
        if($labs){
            $this->response([
                    'status' => TRUE,
                    'labs'=>$labs,
                    'labs_count'=>count($labs),
                    'message' => 'All Medical labs and Number of Medical labs count.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function medicallab_get(){
        $lab_id=$this->get('lab_id');
        $lab = $this->index_model->select_lab_info($lab_id);
        if($lab){
            $this->response([
                    'status' => TRUE,
                    'lab'=>$lab,
                    'message' => 'Single Medical lab Details.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }
    public function medicallab_delete($id,$lab_id){
        $lab = $this->index_model->delete_patient_lab($id,$lab_id);
        if($lab){
            $this->response([
                    'status' => TRUE,
                    'message' => 'Medical Lab Deleted Successfully.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'Medical Lab Not Deleted.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }

    /*********************Appointments*******************************/
    public function appointments_get(){
        $user_id=$this->get('user_id');
        $sd=$this->get('sd');
        $ed=$this->get('ed');
        $status=$this->get('status_id');
        $appointments = $this->index_model->select_appointments_info($sd,$ed,$status,$user_id);
        $count=$this->db->where('user_id',$user_id)->get('appointments')->num_rows();
        if($appointments){
            $this->response([
                    'status' => TRUE,
                    'appointments'=>$appointments,
                    'appointments_count'=>$count,
                    'message' => 'All Appointments Details of Login User.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'appointments'=>'',
                    'message' => 'No Data Found.'
                ], REST_Controller::HTTP_OK);
        }
    }
    public function appointment_get(){
        $appointment_id=$this->get('appointment_id');
        $appointment = $this->index_model->select_appointment_info($appointment_id);
        if($appointment){
            $this->response([
                    'status' => TRUE,
                    'appointment_details'=>$appointment,
                    'message' => 'Single Appointment Details.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function appointmentHistory_get(){
        $appointment_id=$this->get('appointment_id');
        $appointment_history = $this->index_model->select_appointment_history_info($appointment_id);
        if($appointment_history){
            $this->response([
                    'status' => TRUE,
                    'appointment_history'=>$appointment_history,
                    'message' => 'History Appointment Details of Login User.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    function cancelAppointment_post(){
            $appointment=$this->index_model->cancel_appointment_info();
            if($appointment){
            $this->response([
                    'status' => TRUE,
                    'message' => 'Appointment Cancled Successfuly.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'Appointment Not Cancled.'
                ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    function appointment_post(){
            $appointment=$this->index_model->update_appointment_info();
            if($appointment){
            $this->response([
                    'status' => TRUE,
                    'message' => 'Appointment Updated Successfuly.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'Appointment Not Updated.'
                ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    /*Booking Appointment*/
    public function doctorsForAppointment_get(){
        $specialization_id=$this->get('specialization_id');
        $city_id=$this->get('city_id');
        $doctors = $this->index_model->select_doctor_info_appointment($specialization_id,$city_id);
        if($doctors){
            $this->response([
                    'status' => TRUE,
                    'doctors'=>$doctors,
                    'message' => 'Doctors List for Appointments.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    function AvailabilityTimeSlots_post()
    {
        $doctor= $this->post('doctor_id');
        $user= $this->post('user_id');
        $appointment_date=$this->post('appointment_date');
        $perday=$this->db->get_where('appointments', array('user_id' => $user,'created_at>='=>date('Y-m-d 00:00:00'),'created_at<='=>date('Y-m-d 23:59:59')))->num_rows();
        if($perday<2){
        $count=$this->db->get_where('appointments', array('user_id' => $user,'appointment_date'=>$appointment_date))->num_rows();
      if($count < 2 ){ 
        $appointment_history = $this->index_model->get_dco_available_slots($doctor,$appointment_date);
        if($appointment_history){
            $this->response([
                    'status' => TRUE,
                    'available_time_slot'=>$appointment_history,
                    'message' => 'Doctor Available Time Slot.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Slot Available In This Date.'
                ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }else{
        $this->response([
                    'status' => FALSE,
                    'message' => 'You Can not Book More Than 2 Appointments Per Day.'
                ], REST_Controller::HTTP_BAD_REQUEST);
    }
}else{
    $this->response([
                    'status' => FALSE,
                    'message' => 'You Can Book a maximum of 2 Appointments Per Day.'
                ], REST_Controller::HTTP_BAD_REQUEST);
    }
    }
        function CheckAppointmentConstraint_post()
    {
        $doctor= $this->post('doctor_id');
        $user= $this->post('user_id');
        $appointment_date=$this->post('appointment_date');
        $perday=$this->db->get_where('appointments', array('user_id' => $user,'created_at>='=>date('Y-m-d 00:00:00'),'created_at<='=>date('Y-m-d 23:59:59')))->num_rows();
        if($perday<2){
        $count=$this->db->get_where('appointments', array('user_id' => $user,'appointment_date'=>$appointment_date))->num_rows();
      if($count < 2 ){ 
    $this->response([
                    'status' => TRUE
                ], REST_Controller::HTTP_OK);
    }else{
        $this->response([
                    'status' => FALSE,
                    'message' => 'You Can not Book More Than 2 Appointments Per Day.'
                ], REST_Controller::HTTP_BAD_REQUEST);
    }
}else{
    $this->response([
                    'status' => FALSE,
                    'message' => 'You Can Book a maximum of 2 Appointments Per Day.'
                ], REST_Controller::HTTP_BAD_REQUEST);
    }
    }
    public function availableTimeSlot_post(){
        $doctor= $this->post('doctor_id');
        $date=$this->post('date');
        $appointment_history = $this->index_model->get_dco_available_slots($doctor,$date);
        if($appointment_history){
            $this->response([
                    'status' => TRUE,
                    'available_time_slot'=>$appointment_history,
                    'message' => 'Doctor Available Time Slot.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Slot Available In This Date.'
                ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function addAppointment_post(){
                $doctor= $this->post('doctor_id');
        $user= $this->post('user_id');
        $appointment_date=$this->post('appointment_date');
        $perday=$this->db->get_where('appointments', array('user_id' => $user,'created_at>='=>date('Y-m-d 00:00:00'),'created_at<='=>date('Y-m-d 23:59:59')))->num_rows();
        if($perday<2){
        $count=$this->db->get_where('appointments', array('user_id' => $user,'appointment_date'=>$appointment_date))->num_rows();
      if($count < 2 ){ 
   $hospitals = $this->index_model->save_appointment_info();
        if($hospitals){
            $this->response([
                    'status' => TRUE,
                    'message' => 'Appointment Save Successfully.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'Appointment Not Save.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }else{
        $this->response([
                    'status' => FALSE,
                    'message' => 'You Can not Book More Than 2 Appointments Per Day.'
                ], REST_Controller::HTTP_BAD_REQUEST);
    }
}else{
    $this->response([
                    'status' => FALSE,
                    'message' => 'You Can Book a maximum of 2 Appointments Per Day.'
                ], REST_Controller::HTTP_BAD_REQUEST);
    }
    }
        /*********************InPatient*******************************/
    public function inpatients_get(){
        $id=$this->get('user_id');
        $sd=$this->get('sd');
        $ed=$this->get('ed');
        $status=$this->get('status_id');
        $inpatient = $this->index_model->select_inpatients_info($sd,$ed,$status,$id);
        if($inpatient){
            $this->response([
                    'status' => TRUE,
                    'inpatient'=>$inpatient,
                    'message' => 'All Inpatient Details of Login User.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function inpatient_get(){
        $inpatient_id=$this->get('inpatient_id');
        $inpatient = $this->index_model->select_inpatient_info($inpatient_id);
        if($inpatient){
            $this->response([
                    'status' => TRUE,
                    'inpatient'=>$inpatient,
                    'message' => 'Single Inpatient Details.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function inpatientHistory_get(){
        $inpatient_id=$this->get('inpatient_id');
        $inpatient_history = $this->index_model->select_inpatient_history_info($inpatient_id);
        if($inpatient_history){
            $this->response([
                    'status' => TRUE,
                    'inpatient_history'=>$inpatient_history,
                    'message' => 'History Inpatient Details of Login User.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
   
    /********************Health Records************************/
    /********************Prescriptions************************/
    public function prescriptions_get(){
    $user_id=$this->get('user_id');
     $prescriptions = $this->index_model->select_prescriptions_info($user_id);
        if($prescriptions){
            $this->response([
                    'status' => TRUE,
                    'prescriptions'=>$prescriptions,
                    'message' => 'Prescriptions.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }   
    }
    public function prescription_get(){
        $prescription_id=$this->get('prescription_id');
        $order_type=$this->get('order_type');
     $prescriptions = $this->index_model->ReadPrescription_info($prescription_id,$order_type);
        if($prescriptions){
            $this->response([
                    'status' => TRUE,
                    'prescriptions'=>$prescriptions,
                    'message' => 'Prescriptions.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }   
    }
    public function prescription_delete($prescription_id){
     $prescriptions = $this->index_model->delete_prescription($prescription_id);
        if($prescriptions){
            $this->response([
                    'status' => TRUE,
                    'message' => 'Prescription Deleted Successfully.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'Prescription Not Deleted.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }   
    }
        public function prescriptionStatus_put($prescription_id,$status){
     $prescriptions = $this->index_model->update_prescription_status($prescription_id,$status);
        if($prescriptions){
            $this->response([
                    'status' => TRUE,
                    'message' => 'Prescription Status Updated Successfully.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'Prescription Not Updated.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }   
    }
     /********************Prognosis************************/
    public function prognoses_get(){
    $user_id=$this->get('user_id');
     $Prognosis = $this->index_model->select_prognosis_info($user_id);
        if($Prognosis){
            $this->response([
                    'status' => TRUE,
                    'prognosis'=>$Prognosis,
                    'message' => 'Prognosis.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }   
    }
    public function prognosis_get(){
        $prognosis_id=$this->get('prognosis_id');
     $Prognosis = $this->index_model->select_prognosis_information($prognosis_id);
        if($Prognosis){
            $this->response([
                    'status' => TRUE,
                    'Prognosis'=>$Prognosis,
                    'message' => 'Prognosis.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }   
    }
    public function prognosis_delete($Prognosis_id=''){
     $Prognosis = $this->index_model->delete_prognosis($Prognosis_id);
        if($Prognosis){
            $this->response([
                    'status' => TRUE,
                    'message' => 'Prognosis Deleted Successfully.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'Prognosis Not Deleted.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }   
    }
        public function prognosisStatus_put($prognosis_id,$status){
     $Prognosis = $this->index_model->update_prognosis_status($prognosis_id,$status);
        if($Prognosis){
            $this->response([
                    'status' => TRUE,
                    'message' => 'Prognosis Status Updated Successfully.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'Prognosis Not Updated.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }   
    }
         /********************Health Reports************************/
    public function HealthReportsByLabs_get(){
        $user_id=$this->get('user_id');
     $reports = $this->index_model->select_medical_reports_by_labs($user_id);
        if($reports){
            $this->response([
                    'status' => TRUE,
                    'health_reports'=>$reports,
                    'message' => 'Health Reports.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }   
    }
    public function HealthReportsByDoctors_get(){
        $user_id=$this->get('user_id');
     $reports = $this->index_model->select_medical_reports_by_doctors($user_id);
        if($reports){
            $this->response([
                    'status' => TRUE,
                    'health_reports'=>$reports,
                    'message' => 'Health Reports.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }   
    }
    public function HealthReport_delete($report_id=''){
     $report = $this->index_model->delete_medical_reports($report_id);
        if($report){
            $this->response([
                    'status' => TRUE,
                    'message' => 'Health Report Deleted Successfully.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'Health Report Not Deleted.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }   
    }
        public function HealthReportStatus_put($report,$status){
     $report = $this->index_model->update_medical_reports_status($report,$status);
        if($report){
            $this->response([
                    'status' => TRUE,
                    'message' => 'Health Report Status Updated Successfully.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'Health Report Not Updated.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }   
    }
     /*********************Booking Order*************************/
    public function OrderPrescription_post(){
            $appointment=$this->index_model->save_prescription_order();
            if($appointment){
            $this->response([
                    'status' => TRUE,
                    'message' => 'Prescription Ordered Successfuly.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'Prescription Not Ordered.'
                ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function BookOrders_post(){
        $hospitals = $this->index_model->book_order();
        if($hospitals){
            $this->response([
                    'status' => TRUE,
                    'message' => 'Order Booked Successfully.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'Order Not Booked.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }
      /********************* Orders *************************/
    public function Orders_get(){
        $user_id=$this->get('user_id');
        $order_type=$this->get('order_type');
        $orders = $this->index_model->select_orders_info($user_id,$order_type);
        if($orders){
            $this->response([
                    'status' => TRUE,
                    'orders'=>$orders,
                    'message' => 'Orders.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }
    public function Order_get(){
        $order_id=$this->get('order_id');
        $orders = $this->index_model->select_order_info($order_id);
        if($orders){
            $this->response([
                    'status' => TRUE,
                    'orders'=>$orders,
                    'message' => 'Order Details.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }
    public function receipt_get(){
        $order_id=$this->get('order_id');
        $receipt = $this->index_model->select_receipt_info($order_id);
        if($receipt){
            $this->response([
                    'status' => TRUE,
                    'receipt'=>$receipt,
                    'message' => 'Receipt.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }
}
