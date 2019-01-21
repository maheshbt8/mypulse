<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class LogViewerController extends CI_Controller {
	 public function __construct() {  
        parent::__construct();
        /*$this->logViewer = new \CILogViewer\CILogViewer();*/
        $this->load->model('crud_model');
        $this->load->database();
        $this->load->library('session');
        date_default_timezone_set('Asia/Kolkata');
    }
	 public function index() {  
        $data['title'] = 'Error Log';
        $data['clear'] = site_url('tool/error_log/clear');
        $data['log'] = '';

         // Current Filename;
        $file = APPPATH . 'logs/' . 'log-'.date('Y-m-d').'.php';
        /*$file = APPPATH . 'logs/' . 'log-2019-01-16.php';*/
        if (file_exists($file)) {
            $size = filesize($file);
            if ($size >= 5242880) {
                $suffix = array(
                    'B',
                    'KB',
                    'MB',
                    'GB',
                    'TB',
                    'PB',
                    'EB',
                    'ZB',
                    'YB'
                );
                $i = 0;
                while (($size / 1024) > 1) {
                    $size = $size / 1024;
                    $i++;
                }
                $error_warning = 'Warning: Your error log file %s is %s!';
                $data['error_warning'] = sprintf($error_warning, basename($file), round(substr($size, 0, strpos($size, '.') + 4), 2) . $suffix[$i]);
            } else {

                 // Updated from comment

                $log = file_get_contents($file, FILE_USE_INCLUDE_PATH, null);

                $lines = explode("\n", $log); 
                /*$content = implode("\n", array_slice($lines, 1));*/ 
                $data['log'] = $lines;
                /*print_r($data);die;*/
            }
        }
/*print_r($data);die;*/
        /*$this->load->view('header', $data)*/
        $this->load->view('error_log', $data);
        /*$this->load->view('footer');*/
    }

/*	private $logViewer;

    public function __construct() {  
        parent::__construct();
        $this->logViewer = new \CILogViewer\CILogViewer();
        $this->load->model('crud_model');
        $this->load->database();
        $this->load->library('session');
        date_default_timezone_set('Asia/Kolkata');
    }
    public function index() {
    echo $this->logViewer->showLogs();
    return;
}*/
}