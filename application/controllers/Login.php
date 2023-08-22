<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Login extends CI_Controller {
    function __construct() {  
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
        error_reporting(0);
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    public function index() {
        if ($this->session->userdata('login') == 1)
        {
            $this->crud_model->login_details();
            redirect(base_url() . 'Dashboard', 'refresh');
        }
    $this->load->view('backend/login');
}
function validate_login() {
    if($this->input->post()){
        $email = $this->input->post('username');
        $password = $this->input->post('password');
        $query=$this->crud_model->validate_login($email,$password);
        if($query){
            $row = $query->row_array();
            $unique_id=$row['unique_id'];
            $code=divide_unique_id($unique_id);
            $role=$this->crud_model->get_role($code);
            $this->session->set_userdata('login_user_id', $row[$role['type_id'].'_id']);
            $this->session->set_userdata('unique_id', $row['unique_id']);
            $this->session->set_userdata('name', $row['name']);
            $this->session->set_userdata('login_type', $role['type']);
            $this->session->set_userdata('type_id', $role['type_id']);
            if($code=="MPSA" || $code=="MPU"){
                $this->session->set_userdata('login', '1');
            }
            if($code=='MPHA' || $code=='MPD' || $code=='MPN' || $code=='MPR' || $code=='MPL' || $code=='MPS'){
            $this->session->set_userdata('hospital_id', $row['hospital_id']);
            $ha=$this->db->select('name,license')->where('hospital_id',$row['hospital_id'])->get('hospitals')->row();
            $this->session->set_userdata('hospital_name', $ha->name);
            $this->session->set_userdata('license', $ha->license);
            if($code=='MPD' || $code=='MPN' || $code=='MPR'){
                $this->session->set_userdata('branch_id', $row['branch_id']);
                $this->session->set_userdata('department_id', $row['department_id']);
            }
            }
            if ($this->session->userdata('login_type')!='') {
         $account_type=$this->session->userdata('login_type');
if($account_type !='superadmin' && $account_type!='users'){
$hospital_details=$this->db->select('row_status_cd')->get_where('hospitals',array('hospital_id'=>$this->session->userdata('hospital_id')))->row();
$license_status=$hospital_details->row_status_cd;
    if($this->session->userdata('hospital_id')){
    if($license_status == 1){
    $this->session->set_userdata('login', '1');
    }else{
    $this->session->set_flashdata('login_error', 'Login Failed Due To License Expire Please Contact Your Hospital Admin');
         redirect(base_url() . 'login', 'refresh');
        }
    }else{
        $this->session->set_userdata('login', '1');
    }
    }else{
        $this->session->set_userdata('login', '1');
    }
    }
    }
    }
    $this->session->set_flashdata('login_error', 'Please Enter Valid Login Details !!!');
    redirect(base_url() . 'Login', 'refresh');
}
/*     * *Licence Status**** */

    function license_status() {
        $this->load->view('backend/email');
    }
    /*     * *DEFAULT NOR FOUND PAGE**** */

    function four_zero_four() {
        $this->load->view('four_zero_four');
    }
    function four_zero_three() {
        $this->load->view('four_zero_three');
    }
    function register($task='')
    {
        if($this->input->post()){
        $phone = $this->input->post('phone');
           $validation_phone = mobile_validation($phone);
        if($validation_phone==0){
           $check_users=$this->db->get_where('users',array('phone'=>$phone))->row_array();
        }
    if($validation_phone == 1 || $check_users['reg_status']=='2'){
            $email = $this->input->post('email');
           $validation = email_validation($email);
            if($validation_phone==0){
           $check_email=$this->db->get_where('users',array('email'=>$email))->row_array();
            }
    if ($validation == 1 || ($check_email['phone']==$phone && $check_email['reg_status']=='2')) {
    if($this->input->post('pass') == $this->input->post('cpass')){
        $this->session->set_flashdata('error', '');
        $data['name']       = $this->input->post('username');
        if($this->input->post('email')!=''){
        $data['email']      = $this->input->post('email');
        }
        $data['password']       = hash ( "sha256",$this->input->post('pass'));
        $data['phone']          = $this->input->post('phone');
        $user_name   =   $data['name'];
        if($this->session->userdata('otp')==''){
        $otp=otp_generate();
        $this->session->set_userdata('otp_time',date('Y-m-d H:i:s'));
        $this->session->set_userdata('otp',$otp);
        $this->session->set_userdata('otp_sended','');
        }
        $this->session->set_flashdata('success','OTP Sent To :'.$data['phone']);
            /*$message='Dear '. ucfirst($user_name) . ', Welcome To MyPulse. Your OPT Number: ' . $this->session->userdata('otp').'. Please use the code within 2 minutes.' ;*/
            $message= 'Thank you for registering with MyPulse. Your
verification code is ' . $this->session->userdata('otp').'.';

            $receiver_phone =   $data['phone'];
        if($this->session->userdata('otp_sended')==''){  
            $this->sms_model->send_sms($message, $data['phone']);
            $this->session->set_userdata('otp_sended','1');
        }
    $past_time=strtotime($this->session->userdata('otp_time'));
    $current_time = time();
    $difference = $current_time - $past_time;
    $difference_minute =  $difference/60;
    if(intval($difference_minute)<3){
    if($this->input->post('otp')){
        if($this->input->post('otp') == $this->session->userdata('otp')){
        $data['mobile_verify']   = 1;
        if($validation_phone==1){
        $insert=$this->db->insert('users',$data);
        $lid=$this->db->insert_id();
        $pid=$this->crud_model->generate_unique_id($lid,'users');
        $this->db->where('user_id',$lid)->update('users',array('unique_id'=>$pid));
        $this->crud_model->update_modified_info('users','user_id',$lid);
        }elseif($validation_phone!=1){
        $data['reg_status']   = '1';
        $insert=$this->db->where('phone',$phone)->update('users',$data);
        }
        if($insert)
        {
        $this->session->set_userdata('otp','');
        $this->session->set_userdata('otp_time','');
        $this->session->set_userdata('otp_sended','');
        $this->email_model->account_opening_email('users','user', $data['email']);
        $this->session->set_flashdata('success','Registration Completed Successfully');
        redirect(base_url() . 'login', 'refresh');
        }
        }else{
        $this->session->set_flashdata('error', 'OTP Not Correct');
    }
}
    }else{
        $this->session->sess_destroy();
        $this->session->set_flashdata('error', 'OTP Time Was Experied');
        redirect(base_url('login/register'), 'refresh');
    }
    }else{
                 $this->session->set_flashdata('error', 'Please Confirm password, does not match');
            }
            
        }else {
        $this->session->set_flashdata('error', 'This email id is already registered with us.');
            }
            }else {
                 $this->session->set_flashdata('error', 'Mobile Number Already registered' );
        }
        }
        $this->load->view('backend/register');
    }

     function email_verification()
    {
        $task=$_GET['id'];
        $this->crud_model->email_verification($task);
    }
    function reset_password()
    {
        $task=$_GET['id'];
        $this->crud_model->reset_password($task);
    }
 function forgot_password($task="",$id="")
    {
        if($this->input->post()){
        $email=$this->input->post('email');
        $return=$this->crud_model->forgot_password($email);
        $row=$return['userdetails'];
        $role_type=$return['role'];
        $role=$this->crud_model->get_role($role_type);
        $this->session->set_userdata('login_id', $row[$role['type_id'].'_id']);
        $this->session->set_userdata('login_type', $role['type']);
        $this->session->set_userdata('type_id', $role['type_id']);
        $this->session->set_userdata('email_verify', $row['email_verify']);
        if($this->session->userdata('login_id')!='' && $this->session->userdata('email_verify')==1){
        $this->email_model->forgot_password($email);
        $this->session->set_flashdata('success', 'Password Reset Link Sent To Your Email');
        redirect(base_url('login'));
        }elseif($this->session->userdata('login_id')!='' && $this->session->userdata('email_verify')==2){
        $this->session->set_flashdata('email_error', 'Email Not Verified');
        }else{
        $this->session->set_flashdata('email_error', 'Email Not Found');
        }
        }
    $this->load->view('backend/forgot_password');
    }
    function set_password($data='')
    {
    $email_data=explode('/',$this->crud_model->generate_decryption_key($data));
    $task=$email_data[0];
    $id=$email_data[1];
    $password_time=$email_data[2];
    $user_data=$this->db->get_where($task, array('unique_id' => $id))->row();
    $past_time = strtotime($password_time);
    $current_time = time();
    $difference = $current_time - $past_time;
    $difference_minute =  $difference/60;
    if(intval($difference_minute)<30){
         if($this->input->post()){
$this->form_validation->set_rules('pass', 'Password', 'required|min_length[5]|max_length[8]');
$this->form_validation->set_rules('cpass', 'Password Confirmation', 'required|matches[pass]');
if ($this->form_validation->run() == TRUE){
            $email_verify=$user_data->email_verify;
        if($email_verify==1){
$yes=$this->db->where('unique_id',$id)->update($task,array('password' =>hash ( "sha256",$this->input->post('pass'))));
        if($yes){
        $this->session->set_flashdata('success','Password reset is successful. Please login...');
        redirect(base_url('login'));
        }
        }else{
            $this->session->set_flashdata('cpass_error','Email Not Verified');
        }
    }
    }
    $data_my['task']=$data;
    $this->load->view('backend/set_password',$data_my);
        }else{
            echo "Your Link Has Expired"."<br/>";
            echo "<a href='".base_url('Login')."'>Login to MyPulse</a> / <a href='".base_url()."'>Visit MyPulse home</a>";
        }
      
    }
      /************Privacy & Policy ,Terms & Conditions****************/
    function privacy($param1 = '', $param2 = '', $param3 = '') {
        if($param1 == 1){
            $page_data['privacy'] = $this->db->get_where('settings', array('setting_type' => 'privacy'))->row()->description;
            $page_data['page_title'] = get_phrase('Privacy & Policy');
        }elseif($param1 == 2){
            $page_data['privacy'] = $this->db->get_where('settings', array('setting_type' => 'terms'))->row()->description;
            $page_data['page_title'] = get_phrase('Terms & Conditions');
        }
        $page_data['page_name'] = 'privacy';
        
        $this->load->view('backend/main/privacy', $page_data);
    }

    /*Error */
    function errors(){
        $this->load->view('backend/email');
        //$this->load->view('errors/html/error_php');
    }
 /*     * *****LOGOUT FUNCTION ****** */
    function otp_cancel() {
        /*$this->session->set_userdata('otp','');
        $this->session->set_userdata('otp_sended','');*/
        $this->session->sess_destroy();
        return true;
        //redirect(base_url('login/register'),'refresh');
    }

    function logout() {
        if ($this->session->userdata('login') == 1)
        {
            $this->crud_model->logout_details();
        }
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url('login'), 'refresh');
    }
    function logout_to_home() {
        $this->session->sess_destroy();
        redirect(base_url(), 'refresh');
    }
}
