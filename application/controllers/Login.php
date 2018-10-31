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
            redirect(base_url() . 'main/dashboard', 'refresh');
/*
        if ($this->session->userdata('superadmin_login') == 1)
            redirect(base_url() . 'index.php?superadmin/dashboard', 'refresh');
            
    if ($this->session->userdata('hospitaladmin_login') == 1)
            redirect(base_url() . 'index.php?hospitaladmins/dashboard', 'refresh');
        
            else if ($this->session->userdata('doctor_login') == 1)
            redirect(base_url() . 'index.php?doctors', 'refresh');
        
        else if ($this->session->userdata('user_login') == 1)
            redirect(base_url() . 'index.php?users', 'refresh');
        
        else if ($this->session->userdata('nurse_login') == 1)
            redirect(base_url() . 'index.php?nurse', 'refresh');
        
        else if ($this->session->userdata('receptionist_login') == 1)
            redirect(base_url() . 'index.php?receptionist', 'refresh');
        
        else if ($this->session->userdata('lab_login') == 1)
            redirect(base_url() . 'index.php?medicallabs', 'refresh');
        
        else if ($this->session->userdata('store_login') == 1)
            redirect(base_url() . 'index.php?medicalstores', 'refresh');*/

        $this->load->view('backend/login');
    }

    //Validating login from ajax request
    function validate_login() {
     
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
            $this->session->set_userdata('name', $row->name);
           	$this->session->set_userdata('login_type', 'superadmin');
            $this->session->set_userdata('type_id', 'superadmin');
            redirect(base_url() . 'main', 'refresh');
        }
        
        $query = $this->db->get_where('hospitaladmins', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('login', '1');
            $this->session->set_userdata('login_user_id', $row->admin_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('hospital_id', $row->hospital_id);
            $this->session->set_userdata('hospital_name', $this->db->where('hospital_id',$row->hospital_id)->get('hospitals')->row()->name);
            $this->session->set_userdata('login_type', 'hospitaladmins');
            $this->session->set_userdata('type_id', 'admin');

            redirect(base_url() . 'main', 'refresh');
        }
        
    
        $query = $this->db->get_where('doctors', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('login', '1');
            $this->session->set_userdata('login_user_id', $row->doctor_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('hospital_id', $row->hospital_id);
            $this->session->set_userdata('branch_id', $row->branch_id);
            $this->session->set_userdata('department_id', $row->department_id);
            $this->session->set_userdata('login_type', 'doctors');
            $this->session->set_userdata('type_id', 'doctor');
            redirect(base_url() . 'main', 'refresh');
        }
        
        $query = $this->db->get_where('users', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('login', '1');
            $this->session->set_userdata('login_user_id', $row->user_id);
            $this->session->set_userdata('name', $row->name);
            /*$this->session->set_userdata('hospital_id', $row->hospital_id);*/
            $this->session->set_userdata('login_type', 'users');
            $this->session->set_userdata('type_id', 'user');
            redirect(base_url() . 'main', 'refresh');
        }
        
        $query = $this->db->get_where('nurse', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('login', '1');
            $this->session->set_userdata('login_user_id', $row->nurse_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('hospital_id', $row->hospital_id);
            $this->session->set_userdata('login_type', 'nurse');
            $this->session->set_userdata('type_id', 'nurse');
            redirect(base_url() . 'main', 'refresh');
        }
       
        
        $query = $this->db->get_where('receptionist', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('login', '1');
            $this->session->set_userdata('login_user_id', $row->receptionist_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('hospital_id', $row->hospital_id);
            $this->session->set_userdata('login_type', 'receptionist');
            $this->session->set_userdata('type_id', 'receptionist');
            redirect(base_url() . 'main', 'refresh');
        }
        $query = $this->db->get_where('medicallabs', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('login', '1');
            $this->session->set_userdata('login_user_id', $row->lab_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('hospital_id', $row->hospital);
            $this->session->set_userdata('login_type', 'medicallabs');
            $this->session->set_userdata('type_id', 'lab');
            redirect(base_url() . 'main/dashboard', 'refresh');
        }
        $query = $this->db->get_where('medicalstores', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('login', '1');
            $this->session->set_userdata('login_user_id', $row->store_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('hospital_id', $row->hospital);
            $this->session->set_userdata('login_type', 'medicalstores');
            $this->session->set_userdata('type_id', 'store');
            redirect(base_url() . 'main/dashboard', 'refresh');
        }
        $this->session->set_flashdata('login_error', 'Invalid_login');
         redirect(base_url() . 'login', 'refresh');
    }

    /*     * *DEFAULT NOR FOUND PAGE**** */

    function four_zero_four() {
        $this->load->view('four_zero_four');
    }
  
    /*     * *RESET AND SEND PASSWORD TO REQUESTED EMAIL*** */

    function reset_password() {
        $account_type = $this->input->post('account_type');
        if ($account_type == "") {
            redirect(base_url(), 'refresh');
        }
        $email = $this->input->post('email');
        $result = $this->email_model->password_reset_email($account_type, $email); //SEND EMAIL ACCOUNT OPENING EMAIL
        if ($result == true) {
            $this->session->set_flashdata('flash_message', get_phrase('password_sent'));
        } else if ($result == false) {
            $this->session->set_flashdata('flash_message', get_phrase('account_not_found'));
        }

        redirect(base_url(), 'refresh');
    }

   
    
    function register()
    {
        if($this->input->post()){
            $email = $this->input->post('email');
           $validation = email_validation($email);
           
            if ($validation == 1) {
                $phone = $this->input->post('mobile');
           $validation_phone = mobile_validation($phone);
           if($validation_phone == 1){
                if($this->input->post('pass') == $this->input->post('cpass')){

        $data['name']       = $this->input->post('username');
        $data['email']      = $this->input->post('email');
        $data['password']       = sha1($this->input->post('pass'));
        $data['phone']          = $this->input->post('mobile');
        $data['status']   = 1;

            $user_name   =   $data['name'];
            if($this->session->flashdata('otp') == ''){
            $num="12345678901234567890";
            $shu=str_shuffle($num);
            $otp=substr($shu, 14);
            $this->session->set_flashdata('otp',$otp);
        }
            $this->session->set_flashdata('otp_message','OTP Send To :'.$data['phone'].'('.$this->session->flashdata('otp').')');
            $message        =  'Dear '. ucfirst($user_name) . ', Welcome To MyPulse Your OPT Number :' . $this->session->flashdata('otp') ;
            $receiver_phone =   $data['phone'];
            /*$this->sms_model->send_sms($message, $receiver_phone);*/
        if($this->input->post('otp')==$this->session->flashdata('otp')){
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
                 $this->session->set_flashdata('cpass_error', $this->lang->line('validation')['passwordNotMatch']);
            }
            }else {
                 $this->session->set_flashdata('email_error', 'Mobile Number Already Existed' );
        }
        }else {
        $this->session->set_flashdata('email_error', $this->lang->line('msg_email_exist') );
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
        /*if($task == 'hospitaladmins'){*/
            $is_email=$this->db->get_where($task, array('unique_id' => $id))->row()->is_email;
            if($is_email==1){
            $yes=$this->db->where('unique_id',$id)->update($task,array('password' =>sha1($this->input->post('pass'))));
            if($yes){
            redirect(base_url() , 'refresh');
        }
        }else{
            echo "Email Not Verified";
        }
       /* }*/
    }
    }
        $data['account']=$task;
        $data['id']=$id;
        $this->load->view('backend/set_password',$data);
    }
     /*function set_password($task="",$id="")
    {
        if($this->input->post()){
            $this->form_validation->set_rules('pass', 'Password', 'required|min_length[5]|max_length[8]');
$this->form_validation->set_rules('cpass', 'Password Confirmation', 'required|matches[pass]');
            
            if ($this->form_validation->run() == TRUE){
        if($task == 'hospitaladmins'){
             
            $is_email=$this->db->get_where('hospitaladmins', array('admin_id' => $id))->row()->is_email;
            if($is_email==1){
            $yes=$this->db->where('admin_id',$id)->update('hospitaladmins',array('password' =>sha1($this->input->post('pass'))));
            if($yes){
            redirect(base_url() , 'refresh');
        }
        }
   
        
        }
        if($task == 'doctors'){
      
            $is_email=$this->db->get_where('doctors', array('doctor_id' => $id))->row()->is_email;
            if($is_email==1){
            $yes=$this->db->where('doctor_id',$id)->update('doctors',array('password' =>sha1($this->input->post('pass'))));
            if($yes){
            redirect(base_url() , 'refresh');
        }
        }
    
        }
        if($task == 'nurse'){
         
            $is_email=$this->db->get_where('nurse', array('nurse_id' => $id))->row()->is_email;
            if($is_email==1){
            $yes=$this->db->where('nurse_id',$id)->update('nurse',array('password' =>sha1($this->input->post('pass'))));
            if($yes){
            redirect(base_url() , 'refresh');
        }
        }
    
        }
        if($task == 'receptionist'){
           
            $is_email=$this->db->get_where('receptionist', array('receptionist_id' => $id))->row()->is_email;
            if($is_email==1){
            $yes=$this->db->where('receptionist_id',$id)->update('receptionist',array('password' =>sha1($this->input->post('pass'))));
            if($yes){
            redirect(base_url() , 'refresh');
        }
        }
  
        
        }
        if($task == 'medicalstores'){
        
            $is_email=$this->db->get_where('medicalstores', array('store_id' => $id))->row()->is_email;
            if($is_email==1){
            $yes=$this->db->where('store_id',$id)->update('medicalstores',array('password' =>sha1($this->input->post('pass'))));
            if($yes){
            redirect(base_url() , 'refresh');
        }
        }
   
        }
        if($task == 'medicallabs'){
        
            $is_email=$this->db->get_where('medicallabs', array('lab_id' => $id))->row()->is_email;
            if($is_email==1){
            $yes=$this->db->where('lab_id',$id)->update('medicallabs',array('password' =>sha1($this->input->post('pass'))));
            if($yes){
            redirect(base_url() , 'refresh');
        }
        }
    
        }
        if($task == 'users'){
          
            $is_email=$this->db->get_where('users', array('user_id' => $id))->row()->is_email;
            if($is_email==1){
            $yes=$this->db->where('user_id',$id)->update('users',array('password' =>sha1($this->input->post('pass'))));
            if($yes){
            redirect(base_url() , 'refresh');
        }
        }
    
        } 
    }
    }
        $data['account']=$task;
        $data['id']=$id;
        $this->load->view('backend/set_password',$data);
    }*/
 /*     * *****LOGOUT FUNCTION ****** */
    function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url(), 'refresh');
    }

}
