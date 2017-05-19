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
			$data['page_title'] = $this->lang->line('dashboard');
			$data['breadcrumb'] = array(site_url()=>$this->lang->line('home'),null=>$this->lang->line('dashboard'));
			$this->load->view($this->index_page,$data);
		}
		else{
			redirect($this->login_page);
		}
	}
	
	function registration(){
		if($this->auth->isLoggedIn()){
			$data['page_title'] = $this->lang->line('dashboard');
			$data['breadcrumb'] = array(site_url()=>$this->lang->line('home'),null=>$this->lang->line('dashboard'));
			$this->load->view($this->index_page,$data);
		}
		else{
			$this->load->view('index/registration');
		}
	}
	
	function login(){
		if($this->auth->isLoggedIn()){
			$data['page_title'] = $this->lang->line('dashboard');
			$data['breadcrumb'] = array(site_url()=>$this->lang->line('home'),null=>$this->lang->line('dashboard'));
			$this->load->view($this->index_page,$data);
		}
		else
			$this->load->view($this->login_page);
	}
	
	function doLogin(){
		$st = $this->users_model->doLogin();
		if($st === true){
			$data['infos']= array( sprintf($this->lang->line('msg_welcome'),$this->auth->getUsername()));
			$this->session->set_flashdata('data', $data);
			redirect('index');
		}else if($st == -1){
			$data['errors'] = array($this->lang->line("user_account_verify"));
			$this->session->set_flashdata('data', $data);
			redirect($this->login_page);
		}
		else{
			$data['errors']=array($this->lang->line('usr_acc_invalid_credential'));
			$this->session->set_flashdata('data', $data);
			redirect($this->login_page);
		}
	}
	
	function doReg(){
		$cn = $this->users_model->doReg();
		if($cn === true){
			$data['success']=array($this->lang->line('reg_completed'));
			$this->session->set_flashdata('data', $data);
			redirect($this->login_page);
		}
		else if($cn == -1){
			$data['errors']=array($this->lang->line('msg_email_exist'));
			$this->session->set_flashdata('data', $data);
			$this->load->view('index/registration');
		}
		else{
			$data['errors']=array($this->lang->line('msg_try_again'));
			$this->session->set_flashdata('data', $data);
			$this->load->view('index/registration');
		}
	}

	function update(){
		if($this->auth->isLoggedIn()){
			if($this->users_model->update()){
				$data['success']=array($this->lang->line('msg_profile_udpated'));
			}
			else{
				$data['errors']=array($this->lang->line('msg_try_again'));
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
				$temp['success'] = array($this->lang->line('msg_check_email'));
				$this->session->set_flashdata('data', $temp);
				redirect($this->login_page);
			}
			else
				$temp['errors'] = array($this->lang->line('msg_email_send_error'));
		}
		else
			$temp['errors']=array($this->lang->line('usr_invalid_user'));
	
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
			$temp['success'] = array($this->lang->line('msg_password_change'));
			$this->session->set_flashdata('data', $temp);
			$this->load->view($this->login_page);
		}
		else{
			$temp['errors'] = array($this->lang->line('msg_key_not_match'));
			$temp['key']=null;
			$this->session->set_flashdata('data', $temp);
			$this->load->view('index/resetPassword',$temp);
		}
		
	}

	
}

?>