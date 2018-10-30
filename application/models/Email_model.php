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
        $email_msg = "Welcome to " . $system_name . "<br />";
        $email_msg .= "Dear User <br/> Your ID is : " . $id . "<br />";
        $email_msg .= "Is This Your Email Plese Verify : <button style='color:white'><a href=\"http://ec2-18-236-66-199.us-west-2.compute.amazonaws.com/login/email_verification/$account_type/$id\"> YES </a></button> <br />";
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
        $email_msg = "Welcome to " . $system_name . "<br />";
        $email_msg .= "Dear User <br/> Your ID is : " . $id . "<br />";
        $email_msg .= "Is This Your Email Plese Verify : <button style='color:white'><a href=\"http://ec2-18-236-66-199.us-west-2.compute.amazonaws.com/login/email_verification/$account_type/$id\"> YES </a></button> <br />";
        //$email_msg .= "Login Here : " . base_url() . "<br/>";

        /*echo $email_msg;die;*/
        $email_sub = "Account Reverification Email";
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
        $config = array();
        $config['useragent']    = "CodeIgniter";
        /*$config['mailpath']     = "ssl://smtp.gmail.com";*/ // or "/usr/sbin/sendmail"
        $config['protocol']     = "smtp";
        $config['smtp_host']    = "ssl://smtp.gmail.com";
        $config['smtp_user'] = 'mypulsecare@gmail.com';//raisingravi518@gmail.com
        $config['smtp_pass'] = 'Mypulse123';//ravikumar@518
        $config['smtp_port']    = 465;
        $config['mailtype']     = 'html';
        $config['charset']      = 'utf-8';
        $config['newline']      = "\r\n";
        $config['wordwrap']     = TRUE;
        $this->load->library('email');
        $this->email->initialize($config);

        $system_name = 'MyPulse'/*$this->db->get_where('settings', array('type' => 'system_name'))->row()->description*/;
        /*if ($from == NULL)*/
            $from = 'hospitalsystem160@gmail.com'/*$this->db->get_where('settings', array('type' => 'system_email'))->row()->description*/;

        $this->email->from($from, $system_name);
        $this->email->from($from, $system_name);
        $this->email->to($to);
        $this->email->subject($sub);

        $msg = $msg . "<br /><br /><br /><br /><br /><br /><br /><hr /><center><a href=\"http://ec2-18-236-66-199.us-west-2.compute.amazonaws.com\">&copy; 2018 JagruMs Technologies </a></center>";
        $this->email->message($msg);

        $this->email->send();

        /*echo $this->email->print_debugger();die;*/
        
    }

}