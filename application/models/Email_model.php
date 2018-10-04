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
        $id = $query->row()->doctor_id;
        $email_msg = "Welcome to " . $system_name . "<br />";
        $email_msg .= "Your account type : " . $account_type . "<br />";
        $email_msg .= "Is This Your Email Plese Verify : <button style='color:white'><a href=\"http://localhost/mypulse/curd_model/email_verify/$account_type/$id\"> YES </a></button> <br />";
        //$email_msg .= "Login Here : " . base_url() . "<br/>";

        /*echo $email_msg;die;*/
        $email_sub = "Account opening email";
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
        
        /*$config['protocol'] = 'smtp';
        $config['smtp_host'] = 'bh-67.webhostbox.net';
        $config['smtp_timeout'] = '20';
        $config['smtp_user'] = 'info@btmahesh.online';
        $config['smtp_pass'] = 'info@123';
        $config['smtp_port'] = 25;
        $config['mailtype']  = 'html';
        
        $config['charset']   = 'iso-8859-1';*/
        /*$mail = new PHPMailer();
        $mail->IsSMTP();*/
        $config['SMTPAuth'] = TRUE;
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com';
        $config['smtp_timeout'] = '20';
        $config['smtp_user'] = 'maheshbt8@gmail.com';/*raisingravi518@gmail.com*/
        $config['smtp_pass'] = 'm@hesh@dsp';/*ravikumar@518*/
        $config['smtp_port'] = 465;
        $config['mailtype']  = 'html';
        $config['wordwrap']  = TRUE;
        
        $config['charset']   = 'iso-8859-1';

        $this->load->library('email');

        $this->email->initialize($config);

        $system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
        if ($from == NULL)
            $from = $this->db->get_where('settings', array('type' => 'system_email'))->row()->description;

        $this->email->from($from, $system_name);
        $this->email->from($from, $system_name);
        $this->email->to($to);
        $this->email->subject($sub);

        $msg = $msg . "<br /><br /><br /><br /><br /><br /><br /><hr /><center><a href=\"http://codecanyon.net/item/ekattor-school-management-system-pro/6087521?ref=joyontaroy\">&copy; 2013 Ekattor School Management System Pro</a></center>";
        $this->email->message($msg);

        $this->email->send();

        //echo $this->email->print_debugger();
        
    }

}