<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {  
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->database();
        $this->load->library('session');
        /* cache control */
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
    }

    //Default function, redirects to logged in user area
    public function index() {

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
            redirect(base_url() . 'index.php?medicalstores', 'refresh');

        $this->load->view('backend/login');
    }
/*
    //Ajax login function 
    function ajax_login() {

       
        $response = array();

        

        //Recieving post input of email, password from ajax request
        $email = $_POST["email"];
        $password = $_POST["password"];
        $response['submitted_data'] = $_POST;

        //Validating login
        $login_status = $this->validate_login($email, $password);
        $response['login_status'] = $login_status;
        if ($login_status == 'success') {
            $response['redirect_url'] = $this->session->userdata('last_page');
        }

        //Replying ajax request with validation response
        echo json_encode($response);
    }*/

    //Validating login from ajax request
    function validate_login() {
     
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $credential = array('email' => $email, 'password' => sha1($password),'status'=>'1');
     
        // Checking login credential for admin
        
        $query = $this->db->get_where('superadmin', $credential);//print($query->num_rows());exit;
        if ($query->num_rows() > 0) {
            $row = $query->row();

            $this->session->set_userdata('superadmin_login', '1');
            $this->session->set_userdata('login_user_id', $row->superadmin_id);
            $this->session->set_userdata('name', $row->name);
           	$this->session->set_userdata('login_type', 'superadmin');
            $this->session->set_userdata('type_id', 'superadmin');
            redirect(base_url() . 'index.php?superadmin/dashboard', 'refresh');
        }
        
        $query = $this->db->get_where('hospitaladmins', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('hospitaladmin_login', '1');
            $this->session->set_userdata('login_user_id', $row->admin_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('hospital_id', $row->hospital_id);
            $this->session->set_userdata('login_type', 'hospitaladmins');
            $this->session->set_userdata('type_id', 'admin');

            redirect(base_url() . 'index.php?hospitaladmins/dashboard', 'refresh');
        }
        
    
        $query = $this->db->get_where('doctors', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('doctor_login', '1');
            $this->session->set_userdata('login_user_id', $row->doctor_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'doctors');
            redirect(base_url() . 'index.php?doctors/dashboard', 'refresh');
        }
        
        $query = $this->db->get_where('users', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('user_login', '1');
            $this->session->set_userdata('login_user_id', $row->user_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'users');
            redirect(base_url() . 'index.php?users/dashboard', 'refresh');
        }
        
        $query = $this->db->get_where('nurse', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('nurse_login', '1');
            $this->session->set_userdata('login_user_id', $row->nurse_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'nurse');
            redirect(base_url() . 'index.php?nurse/dashboard', 'refresh');
        }
       
        
        $query = $this->db->get_where('receptionist', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('receptionist_login', '1');
            $this->session->set_userdata('login_user_id', $row->receptionist_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'receptionist');
            redirect(base_url() . 'index.php?receptionist/dashboard', 'refresh');
        }
        $query = $this->db->get_where('medicallabs', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('lab_login', '1');
            $this->session->set_userdata('login_user_id', $row->lab_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'medicallabs');
            redirect(base_url() . 'index.php?medicallabs/dashboard', 'refresh');
        }
        $query = $this->db->get_where('medicalstores', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('store_login', '1');
            $this->session->set_userdata('login_user_id', $row->store_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'medicalstores');
            redirect(base_url() . 'index.php?medicalstores/dashboard', 'refresh');
        }
        $this->session->set_flashdata('login_error', 'Invalid_login');
         redirect(base_url() . 'index.php?login', 'refresh');
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

    /*     * *****LOGOUT FUNCTION ****** */
    
    function register()
    {
        if($this->input->post()){
            $email = $this->input->post('email');
            $password=$this->input->post('password');
           $validation = email_validation($email);
           
            if ($validation == 1) {
                if($this->input->post('pass') == $this->input->post('cpass')){
        $data['name']       = $this->input->post('username');
        $data['email']      = $this->input->post('email');
        $data['password']       = sha1($this->input->post('pass'));
        $data['phone']          = $this->input->post('mobile');
        $data['status']   = 2;
        
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
                $this->email_model->account_opening_email($this->lang->line('roles')[6], $data['email']);
            }else{
                 $this->session->set_flashdata('cpass_error', $this->lang->line('validation')['passwordNotMatch']);
            }} else {

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
        $data['status']   = $this->input->post('status');
        
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

    function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url(), 'refresh');
    }

}
