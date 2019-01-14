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
        $this->cron_model->appointments();
        $this->cron_model->appointments_notifications();
        $this->cron_model->delete_notifications();
        $this->cron_model->delete_messages();

        /*Db BackUps*/
$path='backups/MyPulse-DB'.date('Ymd',strtotime('-7 days')).'.sql';
$this->load->helper("file"); // load the helper
unlink(FCPATH . $path); // delete all files/folders


// Load the DB utility class
$this->load->dbutil();

// Backup your entire database and assign it to a variable
$backup = $this->dbutil->backup();

// Load the file helper and write the file to your server
$this->load->helper('file');
$db_name = 'MyPulse-DB'.date('Ymd').'.sql';
$save = FCPATH'backups/'.$db_name;
write_file($save, $backup);

// Load the download helper and send the file to your desktop
$this->load->helper('download');
force_download($db_name, $backup);
        /*Db Backups End*/
    }
}