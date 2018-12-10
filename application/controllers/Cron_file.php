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
    }
    public function index() {
        $this->cron_model->hospital_license();
        $this->cron_model->applications();
        $this->cron_model->applications_notifications();
        $this->cron_model->delete_notifications();
        $this->cron_model->delete_messages();
    }
}