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
        $message='Dear '. ucfirst($name) . ', Welcome To MyPulse. Your OPT Number: ' . $otp.'. Please use the code within 2 minutes.' ;
        $this->load->model('sms_model');
        $send=$this->sms_model->send_sms($message, $data['phone']);
        $this->response([
                    'status' => TRUE,
                    'sent_otp' => $otp,
                    'otp_time'=>date('Y-m-d H:i:s'),
                    'message'=>'OTP Send To :'.$data['phone']
                ], REST_Controller::HTTP_OK);
      /*  if($send){
        $this->response([
                    'status' => TRUE,
                    'sent_otp' => $otp,
                    'otp_time'=>date('Y-m-d H:i:s'),
                    'message'=>'OTP Send To :'.$data['phone']
                ], REST_Controller::HTTP_OK);
        }else{
        $this->response([
                    'status' => FALSE,
                    'message'=>'OTP Not Send'
                ], REST_Controller::HTTP_BAD_REQUEST);
        }*/
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
    /*********************Header*******************************/
     public function Languages_get(){
        $languages = $this->index_model->get_languages();
        if($languages){
            $this->response([
                    'status' => TRUE,
                    'notifications'=>$languages,
                    'message' => 'All Languages.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
    }
     public function notifications_get($id=''){
        $notification = $this->index_model->get_notifications($id);
        $notification_count = $this->index_model->get_notification_count($id);
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
    public function notificationRead_get($notification_id){
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
    public function messages_get($id){
        $message = $this->index_model->get_messages($id);
        //$message_count = $this->index_model->get_message_count($id);
        if($message){
        $account_details='users-user-'.$id;
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
public function messageRead_get($user_id,$message_id){
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
public function userProfile_get($user_id){
    $result = $this->index_model->select_user_info($user_id);
    if($result){
        $this->response([
        'status' => TRUE,
        'user'=>$result,
        'message' => 'User Information.'
        ], REST_Controller::HTTP_BAD_REQUEST);
    }else{
       $this->response([
        'status' => FALSE,
        'message' => 'No Data Found.'
        ], REST_Controller::HTTP_BAD_REQUEST); 
    }
}
public function updateProfile_post($user_id){
    $result = $this->index_model->select_user_info($user_id);
    if($result){
        $this->response([
        'status' => TRUE,
        'user'=>$result,
        'message' => 'User Information.'
        ], REST_Controller::HTTP_BAD_REQUEST);
    }else{
       $this->response([
        'status' => FALSE,
        'message' => 'No Data Found.'
        ], REST_Controller::HTTP_BAD_REQUEST); 
    }
}
public function changePassword_post($user_id){
    $current_password_input = sha1($this->post('password'));
    $new_password = sha1($this->post('new_password'));
    /*$confirm_new_password = sha1($this->post('confirm_new_password'));*/

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
public function states_get($country_id){
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
public function districts_get($state_id){
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
public function cities_get($district_id){
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
public function MedicalStores_for_Orders_get(){
    $medicalstores = $this->index_model->get_medicalstores_info();
        if($medicalstores){
            $this->response([
                    'status' => TRUE,
                    'medicalstores'=>$MedicalStores,
                    'message' => 'Medical Stores for Orders.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.',
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
}
public function Medicallabs_for_Orders_get(){
    $medicallabs = $this->index_model->get_medicallabs_info();
        if($medicallabs){
            $this->response([
                    'status' => TRUE,
                    'medicallabs'=>$Medicallabs,
                    'message' => 'Medical Labs for Orders.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.',
                ], REST_Controller::HTTP_BAD_REQUEST);
            
        }
}
    /*************************Dashboard**********************************/
    public function upcomingAppointments_get($user_id){
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
     public function recommendAppointments_get($user_id){
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
     public function OutstandingPre_medicines_get($user_id){
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
      public function OutstandingPre_tests_get($user_id){
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
    public function hospitals_get($id=''){
        $hospitals = $this->index_model->select_hospitals_info($id);
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
    public function hospital_get($id=''){
        $hospitals = $this->index_model->select_hospital_info($id);
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
    public function hospitalDelete_delete($id,$hospital_id){
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
    public function doctors_get($id=''){
        $doctors = $this->index_model->select_doctors_info($id);
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
    public function doctor_get($id=''){
        $doctors = $this->index_model->select_doctor_info($id);
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
    public function doctorDelete_delete($id,$doctor_id){
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
    public function medicalstores_get($id=''){
        $stores = $this->index_model->select_stores_info($id);
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
    public function medicalstore_get($id=''){
        $store = $this->index_model->select_store_info($id);
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
    public function medicalstoreDelete_delete($id,$store_id){
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
    public function medicallabs_get($id=''){
        $labs = $this->index_model->select_labs_info($id);
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
    public function medicallab_get($id=''){
        $lab = $this->index_model->select_lab_info($id);
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
    public function medicallabDelete_delete($id,$lab_id){
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
    /*********************InPatient*******************************/
    public function inpatient_get($id=''){
        $sd=$_GET['sd'];
        $ed=$_GET['ed'];
        $status=$_GET['status_id'];
        $inpatient = $this->index_model->select_inpatient_info($sd,$ed,$status,$id);
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
    public function inpatient_history_get($id=''){
        $inpatient_history = $this->index_model->select_inpatient_history_info($id);
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
    /*********************Appointments*******************************/
    public function appointments_get($id=''){
        $sd=$_GET['sd'];
        $ed=$_GET['ed'];
        $status=$_GET['status_id'];
        $appointments = $this->index_model->select_appointments_info($sd,$ed,$status,$id);
        if($appointments){
            $this->response([
                    'status' => TRUE,
                    'appointments'=>$appointments,
                    'appointments_count'=>count($appointments),
                    'message' => 'All Appointments Details of Login User.'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                    'status' => FALSE,
                    'message' => 'No Data Found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function appointment_history_get($id=''){
        $appointment_history = $this->index_model->select_appointment_history_info($id);
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
    /*Booking Appointment*/
    public function doctors_for_appointment_get(){
        $doctors = $this->index_model->select_doctor_info_appointment();
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
    public function available_time_slot_post($doctor){
        $date=$_POST['date'];
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
      function appointmentCheck_post()
    {
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
    public function addAppointment_post(){
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
    }
    /*********************Booking Order*************************/
    public function BookOrder_post(){
        $hospitals = $this->index_model->book_order();
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
    }
    /********************Health Records************************/
    /********************Prescriptions************************/
    public function prescriptions_get($user_id){
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
    public function ReadPrescription_get($prescription_id='',$order_type=''){
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
    public function DeletePrescription_get($prescription_id=''){
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
        public function PrescriptionStatus_get($prescription_id,$status){
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
    public function Prognosis_get($user_id){
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
    public function ReadPrognosis_get($prognosis_id=''){
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

}
