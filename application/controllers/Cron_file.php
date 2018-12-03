<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Cron_file extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();   
        $this->load->library('session');
        
        date_default_timezone_set('Asia/Kolkata');    
        error_reporting(0);  
        /* cache control */
       /* $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');*/
        /*if ($this->session->userdata('login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url('login'), 'refresh');
        }*/
        $this->load->model('cron_model');
    }
    public function index() {
        $this->cron_model->applications();
    }
}