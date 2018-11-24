<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Login extends CI_Controller {
    function __construct() {  
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->database();
        $this->load->library('session');
        date_default_timezone_set('Asia/Kolkata');
        /* cache control */
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
    }
    //Default function, redirects to logged in user area
    public function index() {
        if ($this->session->userdata('login') == 1)
            redirect(base_url() . 'main', 'refresh');
        $this->load->view('backend/login');
    }
    //Validating login from ajax request
    function validate_login() {
        if($this->input->post()){
      $email = $this->input->post('email');
      $password = $this->input->post('password');/*
      $where = "email='".$user_value."' OR phone='".$user_value."' OR unique_id='".$user_value."'";*/
      $credential = array('email' => $email, 'password' => sha1($password),'status'=>'1','is_email'=>'1');
     
        // Checking login credential for admin
        
        $query = $this->db->get_where('superadmin', $credential);
        
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('login', '1');
            $this->session->set_userdata('login_user_id', $row->superadmin_id);
            $this->session->set_userdata('unique_id', $row->unique_id);
            $this->session->set_userdata('name', $row->name);
           	$this->session->set_userdata('login_type', 'superadmin');
            $this->session->set_userdata('type_id', 'superadmin');
            redirect(base_url() . 'main', 'refresh');
        }
        
        $query = $this->db->get_where('hospitaladmins', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            /*$this->session->set_userdata('login', '1');*/
            $this->session->set_userdata('login_user_id', $row->admin_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('hospital_id', $row->hospital_id);
            $this->session->set_userdata('unique_id', $row->unique_id);
            $this->session->set_userdata('hospital_name', $this->db->where('hospital_id',$row->hospital_id)->get('hospitals')->row()->name);
            $this->session->set_userdata('login_type', 'hospitaladmins');
            $this->session->set_userdata('type_id', 'admin');
        }
        
    
        $query = $this->db->get_where('doctors', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            /*$this->session->set_userdata('login', '1');*/
            $this->session->set_userdata('login_user_id', $row->doctor_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('hospital_id', $row->hospital_id);
            $this->session->set_userdata('unique_id', $row->unique_id);
            $this->session->set_userdata('branch_id', $row->branch_id);
            $this->session->set_userdata('department_id', $row->department_id);
            $this->session->set_userdata('login_type', 'doctors');
            $this->session->set_userdata('type_id', 'doctor');
         
        }
        
        $query = $this->db->get_where('users', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('login', '1');
            $this->session->set_userdata('login_user_id', $row->user_id);
            $this->session->set_userdata('unique_id', $row->unique_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'users');
            $this->session->set_userdata('type_id', 'user');
            redirect(base_url() . 'main', 'refresh');
        }
        
        $query = $this->db->get_where('nurse', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            /*$this->session->set_userdata('login', '1');*/
            $this->session->set_userdata('login_user_id', $row->nurse_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('hospital_id', $row->hospital_id);
            $this->session->set_userdata('branch_id', $row->branch_id);
            $this->session->set_userdata('department_id', $row->department_id);
            $this->session->set_userdata('unique_id', $row->unique_id);
            $this->session->set_userdata('login_type', 'nurse');
            $this->session->set_userdata('type_id', 'nurse');
           
        }
        
        $query = $this->db->get_where('receptionist', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            /*$this->session->set_userdata('login', '1');*/
            $this->session->set_userdata('login_user_id', $row->receptionist_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('hospital_id', $row->hospital_id);
            $this->session->set_userdata('unique_id', $row->unique_id);
            $this->session->set_userdata('login_type', 'receptionist');
            $this->session->set_userdata('type_id', 'receptionist');
          
        }
        $query = $this->db->get_where('medicallabs', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            /*$this->session->set_userdata('login', '1');*/
            $this->session->set_userdata('login_user_id', $row->lab_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('hospital_id', $row->hospital);
            $this->session->set_userdata('unique_id', $row->unique_id);
            $this->session->set_userdata('login_type', 'medicallabs');
            $this->session->set_userdata('type_id', 'lab');
      
        }
        $query = $this->db->get_where('medicalstores', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            /*$this->session->set_userdata('login', '1');*/
            $this->session->set_userdata('login_user_id', $row->store_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('hospital_id', $row->hospital);
            $this->session->set_userdata('unique_id', $row->unique_id);
            $this->session->set_userdata('login_type', 'medicalstores');
            $this->session->set_userdata('type_id', 'store');
        }
         $account_type=$this->session->userdata('login_type');
if($account_type!='superadmin' && $account_type!='users'){
    $license_status=$this->db->get_where('hospitals',array('hospital_id',$this->session->userdata('hospital_id')))->row()->license_status;
    if($this->session->userdata('hospital_id')){
    if($license_status==1){
    $this->session->set_userdata('login', '1');
    redirect(base_url() . 'main', 'refresh');
    }else{
        $this->session->set_flashdata('login_error', 'Login Failed Due To License Expire Please Contact Your Hospital Admin');
         redirect(base_url() . 'login', 'refresh');
        }
    }else{
            $this->session->set_userdata('login', '1');
            redirect(base_url() . 'main', 'refresh');
        }
        }else{
            $this->session->set_userdata('login', '1');
            redirect(base_url() . 'main', 'refresh');
        }
    }
        $this->session->set_flashdata('login_error', 'Please Enter Valid Login Details !!!');
         redirect(base_url() . 'login', 'refresh');
    }
/*     * *Licence Status**** */

    function license_status() {
        $this->load->view('backend/license_exp');
    }
    /*     * *DEFAULT NOR FOUND PAGE**** */

    function four_zero_four() {
        $this->load->view('four_zero_four');
    }
    /*     * *RESET AND SEND PASSWORD TO REQUESTED EMAIL*** */
    function reset_password() {
        $account_type = $this->input->post('account_type');
        if ($account_type == "") {
            redirect(base_url('login'), 'refresh');
        }
        $email = $this->input->post('email');
        $result = $this->email_model->password_reset_email($account_type, $email); //SEND EMAIL ACCOUNT OPENING EMAIL
        if ($result == true) {
            $this->session->set_flashdata('flash_message', get_phrase('password_sent'));
        } else if ($result == false) {
            $this->session->set_flashdata('flash_message', get_phrase('account_not_found'));
        }
        redirect(base_url('login'), 'refresh');
    }

    function register()
    {
        if($this->input->post()){
            $email = $this->input->post('email');
           $validation = email_validation($email);
            if ($validation == 1) {
                $phone = $this->input->post('phone');
           $validation_phone = mobile_validation($phone);
    if($validation_phone == 1){
    if($this->input->post('pass') == $this->input->post('cpass')){
        $data['name']       = $this->input->post('username');
        $data['email']      = $this->input->post('email');
        $data['password']       = sha1($this->input->post('pass'));
        $data['phone']          = $this->input->post('phone');
        $data['status']   = 1;
        $user_name   =   $data['name'];
        /*if($this->session->flashdata('otp') == ''){
            $num="12345678901234567890";
            $shu=str_shuffle($num);
            $otp=substr($shu, 14);
            $this->session->set_flashdata('otp',$otp);
        }*/
        if($this->session->userdata('otp')==''){
        $num="12345678901234567890";
        $shu=str_shuffle($num);
        $otp=substr($shu, 14);
        $this->session->set_userdata('otp_time',date('Y-m-d H:i:s'));
        $this->session->set_userdata('otp',$otp);
        }
        $this->session->set_flashdata('success','OTP Send To :'.$data['phone'].'('.$this->session->userdata('otp').')');
            $message='Dear '. ucfirst($user_name) . ', Welcome To MyPulse Your OPT Number :' . $this->session->userdata('otp') ;
            $receiver_phone =   $data['phone'];
            /*$this->sms_model->send_sms($message, $receiver_phone);*/
    $past_time=strtotime($this->session->userdata('otp_time'));
    $current_time = time();
    $difference = $current_time - $past_time;
    $difference_minute =  $difference/60;
    if(intval($difference_minute)<3){
        if($this->input->post('otp')==$this->session->userdata('otp')){
        $insert=$this->db->insert('users',$data);
        if($insert)
        {
            $lid=$this->db->insert_id();
            $a="12345678901234567890";
            $sid=str_shuffle($a);
            $uid=substr($sid, 14);
            $pid='MPU'.date('y').'_'.$uid;
            $this->db->where('user_id',$lid)->update('users',array('unique_id'=>$pid));
        /*
        $this->session->set_flashdata('msg_registration_complete', $this->lang->line('msg_registration_complete'));*/
        redirect(base_url() , 'refresh');
        $this->email_model->account_opening_email('users','user', $data['email']);
        }
        }else{
        $this->session->set_flashdata('error', 'OTP Not Correct');
    }
    }else{
        $this->session->set_flashdata('error', 'OTP Time Was Experied');
    }
            /*$user_name   =   $data['name'];
            $num="12345678901234567890";
            $shu=str_shuffle($num);
            $otp=substr($shu, 14);
            $this->session->set_flashdata('otp',$otp);
            $message        =  'Dear '. ucfirst($user_name) . ', Welcome To MyPulse Your OPT Number :' . $otp ;
            $receiver_phone =   $data['phone'];
            $this->sms_model->send_sms($message, $receiver_phone);*/
            }else{
                 $this->session->set_flashdata('error', $this->lang->line('validation')['passwordNotMatch']);
            }
            }else {
                 $this->session->set_flashdata('error', 'Mobile Number Already Existed' );
        }
        }else {
        $this->session->set_flashdata('error', $this->lang->line('msg_email_exist') );
            }
        }
        $this->load->view('backend/register');
    }
    function user_register(){
            $email = $this->input->post('email');
            $password=$this->input->post('password');
           $validation = email_validation($email);
           
            if ($validation == 1) {
                if($this->input->post('pass') == $this->input->post('cpass')){
        $data['name']       = $this->input->post('fname');
        $data['email']      = $this->input->post('email');
        $data['password']       = sha1($this->input->post('pass'));
        $data['phone']          = $this->input->post('mobile');
        $data['status']   = 1;
        
        $insert=$this->db->insert('patient',$data);
        if($insert)
        {  
            $lid=$this->db->insert_id();
            $a="12345678901234567";
            $sid=str_shuffle($a);
            $uid=substr($sid, 15);
            $pid='MYP_'.$lid.$uid;
            $this->db->where('patient_id',$lid)->update('patient',array('unique_id'=>$pid)); 
        }
                $this->session->set_flashdata('msg_registration_complete', $this->lang->line('msg_registration_complete'));
            }else{
                 $this->session->set_flashdata('cpass_error', $this->lang->line('validation')['passwordNotMatch']);
            }} else {

                $this->session->set_flashdata('email_error', $this->lang->line('msg_email_exist') );
            }
        $this->load->view('backend/register');
        
    }
     function email_verification($task="",$id="")
    {
        $this->crud_model->email_verification($task,$id);
    }
    function set_password($task="",$id="")
    {
        if($this->input->post()){
            $this->form_validation->set_rules('pass', 'Password', 'required|min_length[5]|max_length[8]');
$this->form_validation->set_rules('cpass', 'Password Confirmation', 'required|matches[pass]');
            if ($this->form_validation->run() == TRUE){
            $is_email=$this->db->get_where($task, array('unique_id' => $id))->row()->is_email;
            if($is_email==1){
            $yes=$this->db->where('unique_id',$id)->update($task,array('password' =>sha1($this->input->post('pass'))));
            if($yes){
            redirect(base_url() , 'refresh');
        }
        }else{
            echo "Email Not Verified";
        }
    }
    }
        $data['account']=$task;
        $data['id']=$id;
        $this->load->view('backend/set_password',$data);
    }
 /*     * *****LOGOUT FUNCTION ****** */
    function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url('login'), 'refresh');
    }

}
