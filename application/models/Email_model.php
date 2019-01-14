<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Email_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function account_opening_email($account_type = '',$id_type = '', $email = '') {
        $system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
        $query = $this->db->get_where($account_type, array('email' => $email));
        $type=$id_type.'_id';
        $id = $query->row()->unique_id;//$type
        $task=$this->encryption->encrypt($account_type.'/'.$id);
        $data['id']=$id;
        $data['task']=$task;
        $data['message']="Is This Your Email Plese Verify : ";
        $data['url']='email_verification';
        $data['button']='Yes';
        $email_msg=$this->load->view('backend/email',$data,true);
       /* $email_msg = "Welcome to " . $system_name . "<br />";
        $email_msg .= "Dear User <br/> Your ID is : " . $id . "<br />";
        $email_msg .= "Is This Your Email Plese Verify : <button style='color:white'><a href=\"".base_url()."login/email_verification?id=$task\"> YES </a></button> <br />";*/
        //$email_msg .= "Login Here : " . base_url() . "<br/>";

        /*echo $email_msg;die;*/
        $email_sub = "Account Opening Email";
        $email_to = $email;

        $this->do_email($email_msg, $email_sub, $email_to);
    }
    
    function account_reverification_email($account_type = '',$id_type = '', $unique_id = '') {
        $system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
        $email = $this->db->get_where($account_type, array('unique_id' => $unique_id))->row()->email;
        $id = $unique_id;
        $task=$this->encryption->encrypt($account_type.'/'.$id);
        $data['id']=$id;
        $data['task']=$task;
        $data['message']="Is This Your Email Plese Verify : ";
        $data['url']='email_verification';
        $data['button']='Yes';
        $email_msg=$this->load->view('backend/email',$data,true);
        $email_sub = "Account Reverification Email";
        $email_to = $email;

        $this->do_email($email_msg, $email_sub, $email_to);
    }
    function forgot_password($email=''){
        $account_type=$this->session->userdata('login_type');
    $query = $this->db->get_where($account_type, array($this->session->userdata('type_id').'_id'=> $this->session->userdata('login_id')));
        $id = $query->row()->unique_id;
        $task=$this->encryption->encrypt($account_type.'/'.$id);
        $data['id']=$id;
        $data['task']=$task;
        $data['message']="You Can Reset Your Password Here : ";
        $data['url']='reset_password';
        $data['button']='Reset Password';
        $email_msg=$this->load->view('backend/email',$data,true);
        $email_sub = "Reset Password Email";
        $email_to = $email;
        $this->do_email($email_msg, $email_sub, $email_to);
    }
    function password_reset_email($account_type = '', $email = '') {
        $query = $this->db->get_where($account_type, array('email' => $email));
        if ($query->num_rows() > 0) {
            $id = $query->row()->$account_type.'_id';
            $email_msg = "Your account type is : " . $account_type . "<br />";
            $email_msg .= "Your password is : " . $password . "<br />";

            $email_sub = "Password reset request";
            $email_to = $email;
            $this->do_email($email_msg, $email_sub, $email_to);
            return true;
        } else {
            return false;
        }
    }

    /*     * *custom email sender*** */

    function do_email($msg = NULL, $sub = NULL, $to = NULL, $from = NULL) {
        $system_email=$this->db->get_where('settings', array('type' => 'system_email'))->row()->description;
        $config = array();
        $config['useragent']    = "CodeIgniter";
        /*$config['mailpath']     = "ssl://smtp.gmail.com";*/ // or "/usr/sbin/sendmail"
        $config['protocol']     = "smtp";
        $config['smtp_host']    = "ssl://smtp.gmail.com";
        $config['smtp_user'] = $system_email;//'mypulsecare@gmail.com'
        $config['smtp_pass'] = 'Mypulse123';//ravikumar@518
        $config['smtp_port']    = 465;
        $config['mailtype']     = 'html';
        $config['charset']      = 'utf-8';
        $config['newline']      = "\r\n";
        $config['wordwrap']     = TRUE;
        $this->load->library('email');
        $this->email->initialize($config);
        $system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
            $from = $system_email;
        $this->email->from($from, $system_name);
        $this->email->from($from, $system_name);
        $this->email->to($to);
        $this->email->subject($sub);
        $msg = $msg;
        $this->email->message($msg);

        $this->email->send();

        /*echo $this->email->print_debugger();die;*/
        
    }

}