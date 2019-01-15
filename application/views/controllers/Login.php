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
            $ha=$this->db->where('hospital_id',$row->hospital_id)->get('hospitals')->row();
            $this->session->set_userdata('hospital_name', $ha->name);
            $this->session->set_userdata('license', $ha->license);
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
             $ha=$this->db->where('hospital_id',$row->hospital_id)->get('hospitals')->row();
            $this->session->set_userdata('hospital_name', $ha->name);
            $this->session->set_userdata('license', $ha->license);
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
             $ha=$this->db->where('hospital_id',$row->hospital_id)->get('hospitals')->row();
            $this->session->set_userdata('hospital_name', $ha->name);
            $this->session->set_userdata('license', $ha->license);
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
             $ha=$this->db->where('hospital_id',$row->hospital_id)->get('hospitals')->row();
            $this->session->set_userdata('hospital_name', $ha->name);
            $this->session->set_userdata('license', $ha->license);
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
             $ha=$this->db->where('hospital_id',$row->hospital_id)->get('hospitals')->row();
            $this->session->set_userdata('hospital_name', $ha->name);
            $this->session->set_userdata('license', $ha->license);
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
             $ha=$this->db->where('hospital_id',$row->hospital_id)->get('hospitals')->row();
            $this->session->set_userdata('hospital_name', $ha->name);
            $this->session->set_userdata('license', $ha->license);
            $this->session->set_userdata('unique_id', $row->unique_id);
            $this->session->set_userdata('login_type', 'medicalstores');
            $this->session->set_userdata('type_id', 'store');
        }

     if ($this->session->userdata('login_type')!='') {
         $account_type=$this->session->userdata('login_type');
if($account_type !='superadmin' && $account_type!='users'){
$license_status=$this->db->get_where('hospitals',array('hospital_id'=>$this->session->userdata('hospital_id')))->row()->license_status;
    if($this->session->userdata('hospital_id')){
    if($license_status == 1){
    $this->session->set_userdata('login', '1');
    redirect(base_url() . 'main', 'refresh');
    }else{
        $this->session->set_flashdata('login_error', 'Login Failed Due To License Expire Please Contact Your Hospital Admin');
         redirect(base_url() . 'login', 'refresh');
        }
    }elseif($account_type =='superadmin' || $account_type=='users'){
            $this->session->set_userdata('login', '1');
            redirect(base_url() . 'main', 'refresh');
        }
        }else{
            $this->session->set_userdata('login', '1');
            redirect(base_url() . 'main', 'refresh');
        }
    }
}
        $this->session->set_flashdata('login_error', 'Please Enter Valid Login Details !!!');
         redirect(base_url() . 'login', 'refresh');
    }
/*     * *Licence Status**** */

    function license_status() {
        $this->load->view('backend/email');
    }
    /*     * *DEFAULT NOR FOUND PAGE**** */

    function four_zero_four() {
        $this->load->view('four_zero_four');
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
        $this->session->set_flashdata('error', '');
        $data['name']       = $this->input->post('username');
        $data['email']      = $this->input->post('email');
        $data['password']       = sha1($this->input->post('pass'));
        $data['phone']          = $this->input->post('phone');
        $data['status']   = 1;
        $user_name   =   $data['name'];
        if($this->session->userdata('otp')==''){
        $num="12345678901234567890";
        $shu=str_shuffle($num);
        $otp=substr($shu, 14);
        $this->session->set_userdata('otp_time',date('Y-m-d H:i:s'));
        $this->session->set_userdata('otp',$otp);
        }
        $this->session->set_flashdata('success','OTP Send To :'.$data['phone']);
            $message='Dear '. ucfirst($user_name) . ', Welcome To MyPulse Your OPT Number :' . $this->session->userdata('otp') ;
            $receiver_phone =   $data['phone'];
            $this->sms_model->send_sms($message, $data['phone']);
    $past_time=strtotime($this->session->userdata('otp_time'));
    $current_time = time();
    $difference = $current_time - $past_time;
    $difference_minute =  $difference/60;
    if(intval($difference_minute)<3){
    if($this->input->post('otp')){
        if($this->input->post('otp') == $this->session->userdata('otp')){
        $insert=$this->db->insert('users',$data);
        if($insert)
        {
        $this->session->set_userdata('otp','');
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
        $this->session->set_flashdata('success','Registration Completed Successfully');
        /*redirect(base_url('login') , 'refresh');*/
        $this->email_model->account_opening_email('users','user', $data['email']);
        
        }
        }else{
        $this->session->set_flashdata('error', 'OTP Not Correct');
    }
}
    }else{
        $this->session->sess_destroy();
        redirect(base_url('login/register'), 'refresh');
        $this->session->set_flashdata('error', 'OTP Time Was Experied');
    }
            }else{
                 $this->session->set_flashdata('error', 'Please Confirm password, does not match');
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
    /*function user_register(){
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
           $num=100000+$lid;
        $pid='MPU'.date('y').'_'.$num;
            $this->db->where('patient_id',$lid)->update('patient',array('unique_id'=>$pid)); 
        }
                $this->session->set_flashdata('msg_registration_complete', $this->lang->line('msg_registration_complete'));
            }else{
                 $this->session->set_flashdata('cpass_error', $this->lang->line('validation')['passwordNotMatch']);
            }} else {

                $this->session->set_flashdata('email_error', $this->lang->line('msg_email_exist') );
            }
        $this->load->view('backend/register');
        
    }*/
     function email_verification()
    {
        $task=str_replace(['%2F', '%3A'], ['/', ':'],urlencode($_GET['id']));
        $this->crud_model->email_verification($task);
    }
    function reset_password()
    {
        $task=str_replace(['%2F', '%3A'], ['/', ':'],urlencode($_GET['id']));
        $this->crud_model->reset_password($task);
    }
 function forgot_password($task="",$id="")
    {
        if($this->input->post()){
        $email=$this->input->post('email');
        $where=array('email'=>$email);
        $data=$this->db->get_where('superadmin',$where);
        if($data->num_rows()>0){
            $row=$data->row_array();
        $this->session->set_userdata('login_id', $row['superadmin_id']);
        $this->session->set_userdata('login_type', 'superadmin');
        $this->session->set_userdata('type_id', 'superadmin'); 
        }
        $data=$this->db->get_where('hospitaladmins',$where);
        if($data->num_rows()>0){
            $row=$data->row_array();
        $this->session->set_userdata('login_id', $row['admin_id']);
        $this->session->set_userdata('login_type', 'hospitaladmins');
        $this->session->set_userdata('type_id', 'admin'); 
        }
        $data=$this->db->get_where('users',$where);
        if($data->num_rows()>0){
            $row=$data->row_array();
        $this->session->set_userdata('login_id', $row['user_id']);
        $this->session->set_userdata('login_type', 'users');
        $this->session->set_userdata('type_id', 'user'); 
        }
        $data=$this->db->get_where('doctors',$where);
        if($data->num_rows()>0){
            $row=$data->row_array();
        $this->session->set_userdata('login_id', $row['doctor_id']);
        $this->session->set_userdata('login_type', 'doctors');
        $this->session->set_userdata('type_id', 'doctor'); 
        }
        $data=$this->db->get_where('nurse',$where);
        if($data->num_rows()>0){
            $row=$data->row_array();
        $this->session->set_userdata('login_id', $row['nurse_id']);
        $this->session->set_userdata('login_type', 'nurse');
        $this->session->set_userdata('type_id', 'nurse'); 
        }
        $data=$this->db->get_where('receptionist',$where);
        if($data->num_rows()>0){
            $row=$data->row_array();
        $this->session->set_userdata('login_id', $row['receptionist_id']);
        $this->session->set_userdata('login_type', 'receptionist');
        $this->session->set_userdata('type_id', 'receptionist'); 
        }
        $data=$this->db->get_where('medicalstores',$where);
        if($data->num_rows()>0){
            $row=$data->row_array();
        $this->session->set_userdata('login_id', $row['store_id']);
        $this->session->set_userdata('login_type', 'medicalstores');
        $this->session->set_userdata('type_id', 'store'); 
        }
        $data=$this->db->get_where('medicallabs',$where);
        if($data->num_rows()>0){
            $row=$data->row_array();
        $this->session->set_userdata('login_id', $row['lab_id']);
        $this->session->set_userdata('login_type', 'medicallabs');
        $this->session->set_userdata('type_id', 'lab'); 
        }
        if($this->session->userdata('login_id')!=''){
        $this->session->set_userdata('password_time',date('Y-m-d H:i:s'));
        $this->session->set_flashdata('email_success', 'Password Reset Link Send To Your Email');
        $this->email_model->forgot_password($email);
        }else{
        $this->session->set_flashdata('email_error', 'Email Not Found');
        }
        }
    $this->load->view('backend/forgot_password');
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
        $this->session->set_flashdata('success','password reset successed. please login...');
        redirect(base_url('login') , 'refresh');
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
     /** *RESET AND SEND PASSWORD TO REQUESTED EMAIL*** */
    /*function reset_password() {
        $account_type = $this->input->post('account_type');
        if ($account_type == "") {
            redirect(base_url('login'), 'refresh');
        }
        $email = $this->input->post('email');
        $result = $this->email_model->password_reset_email($account_type, $email);
        if ($result == true) {
            $this->session->set_flashdata('flash_message', get_phrase('password_sent'));
        } else if ($result == false) {
            $this->session->set_flashdata('flash_message', get_phrase('account_not_found'));
        }
        redirect(base_url('login'), 'refresh');
    }*/
      /************Privacy & Policy ,Terms & Conditions****************/
    function privacy($param1 = '', $param2 = '', $param3 = '') {
        if($param1 == 1){
            $page_data['privacy'] = $this->db->get_where('settings', array('type' => 'privacy'))->row()->description;
            $page_data['page_title'] = get_phrase('Privacy & Policy');
        }elseif($param1 == 2){
            $page_data['privacy'] = $this->db->get_where('settings', array('type' => 'terms'))->row()->description;
            $page_data['page_title'] = get_phrase('Terms & Conditions');
        }
        $page_data['page_name'] = 'privacy';
        
        $this->load->view('backend/main/privacy', $page_data);
    }
 /*     * *****LOGOUT FUNCTION ****** */
    function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url('login'), 'refresh');
    }

}
