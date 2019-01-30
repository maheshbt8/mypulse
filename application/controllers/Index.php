<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Index extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    function index(){
    	$data['page_name'] = 'home';
        $data['page_title'] = 'Home';
        $this->load->view('front/index', $data);
    }
}