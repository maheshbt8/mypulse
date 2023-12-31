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
        $this->load->model('cron_model');
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }
    public function index() {
        $this->cron_model->hospital_license();
        $this->cron_model->appointments();
        $this->cron_model->appointments_notifications();
        $this->cron_model->delete_notifications();
        $this->cron_model->delete_messages();
        $this->cron_model->delete_logs();
        $this->cron_model->db_backup();
    }
}