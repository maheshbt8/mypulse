<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Medicalstores extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();   
        $this->load->library('session');    
        error_reporting(0);  
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        if ($this->session->userdata('store_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
    }

    /*     * *default function, redirects to login page if no admin logged in yet** */

    public function index() {
        if ($this->session->userdata('store_login') != 1) 
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('store_login') == 1)
            redirect(base_url() . 'index.php?Medicalstores/dashboard', 'refresh');
    }

    /*     * *ADMIN DASHBOARD** */

    function dashboard() {
       
        $page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('medicallabs_dashboard');
        $this->load->view('backend/index', $page_data);
    }
}