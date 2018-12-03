<?php if (! defined('BASEPATH')) {
 exit('No direct script access allowed');
}
class Cron extends CI_Controller
{

 public function __construct()
 {
   parent::__construct();
   if (!$this->input->is_cli_request()) {
   show_error('Direct access is not allowed');
   }
 }
 public function index()
 {
 	echo "string";
 }
 public function run()
 {
    $this->load->library('core/CronRunner');
    $cron = new CronRunner();
    $cron->run();
 }
}