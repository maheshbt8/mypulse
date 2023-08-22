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
   /* function doctors(){
        $data['page_name'] = 'doctors';
        $data['page_title'] = 'Doctors';
        $this->load->view('front/doctors', $data);
    }*/
    function about(){
        $data['page_name'] = 'about';
        $data['page_title'] = 'About-Us';
        $this->load->view('front/index', $data);
    }
    function doctors(){
        $data['page_name'] = 'doctors';
        $data['page_title'] = 'Doctors';
        $this->load->view('front/index', $data);
    }
    function contact(){
        $data['page_name'] = 'contact';
        $data['page_title'] = 'Contact-Us';
        $this->load->view('front/index', $data);
    }
    function comming_soon(){
        $data['page_name'] = 'comming';
        $this->load->view('front/index', $data);
    }
    function leave_message(){
        $first_name=trim($this->input->post('first_name'));
        $last_name=trim($this->input->post('last_name'));
        $email=trim($this->input->post('email'));
        $mobile=trim($this->input->post('mobile'));
        $message=trim($this->input->post('message'));
        if($first_name && $last_name && $email && $mobile && $message)
        {
        $data=array('first_name'=>$first_name,'last_name'=>$last_name,'email'=>$email,'mobile'=>$mobile,'message'=>$message);
        $data=$this->db->insert('leave_message',$data);
        echo "1";
        }else{
        echo "0";
        //echo '<div class="alert alert-danger"><p>Please select all required field.</p></div>';
        }
    }
}