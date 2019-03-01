<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Index extends CI_Controller {

    function __construct() {
        parent::__construct();
        error_reporting(0);
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }
    function index(){
    	$data['page_name'] = 'home';
        $data['page_title'] = 'Home';
        $this->load->view('front/index', $data);
    }
     public function mypulse_logo(){
    $im = file_get_contents('assets/logo.png');
    header('content-type: image/png');
    echo $im;
    }
     public function feedback_url($type,$id){
    if (file_exists('uploads/' . $type . '/' . $id . '.jpg')){
            $image_url ='uploads/' . $type . '/' . $id . '.jpg';
        }else{
            $image_url ='uploads/user.jpg';
        }
    $im = file_get_contents($image_url);
    header('content-type: image/png');
    echo $im;
    }
}