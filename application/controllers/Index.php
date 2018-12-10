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
    function my(){
        $data['page_name'] = 'my';
        $data['page_title'] = 'my';
        $this->load->view('front/my', $data);
    }
    function about(){
    	$data['page_name'] = 'about';
        $data['page_title'] = 'About Us';
        $this->load->view('front/index', $data);
    }
    function services(){
    	$data['page_name'] = 'services';
        $data['page_title'] = 'Services';
        $this->load->view('front/index', $data);
    }
    function contact(){
    	$data['page_name'] = 'contact';
        $data['page_title'] = 'Contact Us';
        $this->load->view('front/index', $data);
    }
}