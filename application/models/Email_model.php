<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Email_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function account_opening_email($account_type = '',$id_type = '', $email = '') {
        $system_name = $this->db->get_where('settings', array('setting_type' => 'system_name'))->row()->description;
        $query = $this->db->get_where($account_type, array('email' => $email));
        $type=$id_type.'_id';
        $id = $query->row()->unique_id;
        $task=$this->crud_model->generate_encryption_key($account_type.'/'.$id);
        $data['id']=$id;
        $data['task']=$task;
        $data['message']="Thanks for registering with MyPulse. Please click this button to complete your registration:";
        $data['url']='email_verification';
        $data['button']='Yes';
        $email_msg=$this->load->view('backend/email',$data,true);
        $email_sub = "Activate your MyPulse Account";
        $email_to = $email;

        $this->do_email($email_msg, $email_sub, $email_to);
    }

    function account_reverification_email($account_type = '',$id_type = '', $unique_id = '') {
        $system_name = $this->db->get_where('settings', array('setting_type' => 'system_name'))->row()->description;
        $email = $this->db->get_where($account_type, array('unique_id' => $unique_id))->row()->email;
        $id = $unique_id;
        /*$task=$this->encryption->encrypt($account_type.'/'.$id);*/
        $task=$this->crud_model->generate_encryption_key($account_type.'/'.$id);
        $data['id']=$id;
        $data['task']=$task;
        $data['message']="Thanks for registering with MyPulse. Please click this button to complete your registration:";
        $data['url']='email_verification';
        $data['button']='Yes';
        $email_msg=$this->load->view('backend/email',$data,true);
        $email_sub = "Activate your MyPulse Account";
        $email_to = $email;
        $this->do_email($email_msg, $email_sub, $email_to);
    }
    function forgot_password($email=''){
        $account_type=$this->session->userdata('login_type');
    $query = $this->db->get_where($account_type, array($this->session->userdata('type_id').'_id'=> $this->session->userdata('login_id')));
        $id = $query->row()->unique_id;
        $task=$this->crud_model->generate_encryption_key($account_type.'/'.$id.'/'.date('Y-m-d H:i:s'));
        $data['id']=$id;
        $data['task']=$task;
        $data['message']="Thanks for requesting to reset your MyPulse Password. Please click this button to reset password:";
        $data['url']='reset_password';
        $data['button']='Reset Password';
        $email_msg=$this->load->view('backend/email',$data,true);
        $email_sub = "Reset your MyPulse Password";
        $email_to = $email;
        $this->do_email($email_msg, $email_sub, $email_to);
    }
    /*     * *custom email sender*** */

    function do_email($msg = NULL, $sub = NULL, $to = NULL, $from = NULL) {
        $system_email=$this->db->get_where('settings', array('setting_type' => 'system_email'))->row()->description;
        $email_password=$this->db->get_where('settings', array('setting_type' => 'email_password'))->row()->description;
$config = array(
 'protocol' => 'smtp',
 'smtp_host' => 'ssl://smtp.googlemail.com',
 'smtp_port' => 465, 
 'smtp_user' => $system_email,
 'smtp_pass' => $email_password,
 'mailtype' => 'html',
     'charset' => 'utf-8',
     'wordwrap' => TRUE
 );
$config['useragent']    = "CodeIgniter";
 $this->load->library('email'); 
 $this->email->initialize($config);
 
 $this->email->set_newline("\r\n");

$system_name = $this->db->get_where('settings', array('setting_type' => 'system_name'))->row()->description;
            $from = $system_email;

        $this->email->from($system_email, $system_name);
        $this->email->to($to);
        //$this->email->reply_to($from, $system_name);
        $this->email->subject($sub);
        $msg = $msg;
        $this->email->message($msg);
 $this->email->send();
 /*if($this->email->send())
 {echo "string";die;
//  return true;
 }
 else
 {
 show_error($this->email->print_debugger());
 }*/
    }

}