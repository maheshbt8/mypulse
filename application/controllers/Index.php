<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	var $index_page = 'index/dashboard';
	var $login_page = 'index/login';

	function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
	}

	function index()
	{
		if($this->auth->isLoggedIn()){
			$data['page_title'] = "Dashboard";
			$data['breadcrumb'] = array(site_url()=>"Home",null=>'Dashboard');
			$this->load->view($this->index_page,$data);
		}
		else{
			redirect($this->login_page);
		}
	}
	
	function registration(){
		if($this->auth->isLoggedIn()){
			$data['page_title'] = "Dashboard";
			$data['breadcrumb'] = array(site_url()=>"Home",null=>'Dashboard');
			$this->load->view($this->index_page,$data);
		}
		else{
			$this->load->view('index/registration');
		}
	}
	
	function login(){
		if($this->auth->isLoggedIn()){
			$data['page_title'] = "Dashboard";
			$data['breadcrumb'] = array(site_url()=>"Home",null=>'Dashboard');
			$this->load->view($this->index_page,$data);
		}
		else
			$this->load->view($this->login_page);
	}
	
	function doLogin(){
		$st = $this->users_model->doLogin();
		if($st === true){
			$data['infos']=array('Welcome '.$this->auth->getUsername());
			$this->session->set_flashdata('data', $data);
			redirect('index');
		}else if($st == -1){
			$data['errors']=array('Please verify your account.');
			$this->session->set_flashdata('data', $data);
			redirect($this->login_page);
		}
		else{
			$data['errors']=array('Please Enter Valid Username and Password !!!');
			$this->session->set_flashdata('data', $data);
			redirect($this->login_page);
		}
	}
	
	function doReg(){
		$cn = $this->users_model->doReg();
		if($cn === true){
			$data['success']=array('Registration completed successfully...!!!');
			$this->session->set_flashdata('data', $data);
			redirect($this->login_page);
		}
		else if($cn == -1){
			$data['errors']=array('This email id is already registration with us. Please try to login.');
			$this->session->set_flashdata('data', $data);
			$this->load->view('index/registration');
		}
		else{
			$data['errors']=array('Please Try Again...!!!');
			$this->session->set_flashdata('data', $data);
			$this->load->view('index/registration');
		}
	}

	function update(){
		if($this->auth->isLoggedIn()){
			if($this->users_model->update()){
				$data['success']=array('Profile updated successfully...!!!');
			}
			else{
				$data['errors']=array('Please Try Again...!!!');
			}
			$this->session->set_flashdata('data', $data);
			redirect('index');
		}
		else
			$this->load->view($this->login_page);
	}
	
	function logout(){

		$this->auth->LoggedOut();
		redirect('index');
	}
	
	function forgot()
	{
		$this->load->view('index/forgot');
	}
	
	function sendResetKey()
	{
		$data = $this->users_model->validateUsername();

		if($data)
		{
			require APPPATH.'libraries/phpMailer/sendMail.php';
			$mail = new sendRestKey();
			
			if($mail->sendRegMail($data))
			{
				$temp['success'] = array('Please Check Your Mailbox');
				$this->session->set_flashdata('data', $temp);
				redirect($this->login_page);
			}
			else
				$temp['errors'] = array('Unable to send you EMail. Please try again after sometime.');
		}
		else
			$temp['errors']=array('Please Enter Valid Username');
	
		$this->session->set_flashdata('data', $temp);
		redirect('index/forgot');		
	}

	
	function resetPassword()
	{
		$temp = array('key'=>$this->input->get('key'));
		$this->load->view('index/resetPassword',$temp);
	} 
	
	function changePass()
	{
		$temp = array();
		if($this->users_model->resetPassword()){
			$temp['success'] = array('Password Successfully Change');
			$this->session->set_flashdata('data', $temp);
			$this->load->view($this->login_page);
		}
		else{
			$temp['errors'] = array('Key Does Not Match');
			$temp['key']=null;
			$this->session->set_flashdata('data', $temp);
			$this->load->view('index/resetPassword',$temp);
		}
		
	}

	
}

?>