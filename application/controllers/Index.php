<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	var $index_page = 'index/dashboard';
	var $login_page = 'index/login';

	function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->model('dashboard_model');
		$this->load->model('patient_model');
		$this->load->model('healthinsuranceprovider_model');
		$this->load->model('medical_lab_model');
	}

	function index()
	{
		//$this->users_model->updateKeys();
		//echo "Updateed";exit;
		if($this->auth->isLoggedIn()){
			$data['page_title'] = $this->lang->line('dashboard');
			$data['breadcrumb'] = array(site_url()=>$this->lang->line('home'),null=>$this->lang->line('dashboard'));
			if($this->auth->isSuperAdmin()){
				$data['states'] = $this->dashboard_model->getSuperAdminStates();
				$this->load->view($this->index_page,$data);
			}
			else if($this->auth->isHospitalAdmin()){
				$data['states'] = $this->dashboard_model->getHospitalAdminStates($this->auth->getHospitalId());
				$this->load->view('index/admindashboard',$data);
			}else if($this->auth->isPatient()){
				$data['states'] = $this->dashboard_model->getPatientStates($this->auth->getUserid());
				//$data['medicalLab'] = $this->medical_lab_model->getAllmedical_lab();
				$this->load->view('Patient/dashbord',$data);
			}else if($this->auth->isReceptinest()){
				$data['states'] = $this->dashboard_model->getReceptinestStates($this->auth->getUserid());
				$this->load->view('Receptionist/dashboard',$data);
			}else if($this->auth->isDoctor()){
				$data['states'] = $this->dashboard_model->getDoctorStates($this->auth->getUserid());
				$this->load->view('Doctors/dashboard',$data);
			}else if($this->auth->isMedicalLab()){
				$data['states'] = $this->dashboard_model->getMedicalLabStates($this->auth->getUserid());
				$this->load->view('Medical_lab/dashboard',$data);
			}else if($this->auth->isMedicalStore()){
				$data['states'] = $this->dashboard_model->getMedicalStoreStates($this->auth->getUserid());
				$this->load->view('Medical_store/dashboard',$data);
			}else if($this->auth->isNurse()){
				$data['states'] = $this->dashboard_model->getNurseStates($this->auth->getUserid());
				$this->load->view('Nurse/dashboard',$data);
			}
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
			redirect('index');
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

	function changepassword(){
		if($this->auth->isLoggedIn()){
		
			if(isset($_POST['password'])){
					
				$temp = array();
				if($_POST['password'] != $_POST['repassword']){
					$temp['errors'] = array($this->lang->line('msg_new_password_notmatch'));
				}else{
					$res = $this->users_model->changePassword($_POST['oldpassword'],$_POST['password']);
					if($res === -1){
						$temp['errors'] = array($this->lang->line('msg_old_password_notmatch'));
					}else if($res === false){
						$temp['errors'] = array($this->lang->line('msg_try_again'));
					}else{
						$temp['success'] = array($this->lang->line('msg_password_change'));
					}
				}
				//echo "<pre>";print_r($temp);exit;
				$this->session->set_flashdata('data', $temp);
				redirect('index/changepassword');
				return;
			}
			$data['page_title'] = $this->lang->line('changePassword');
			$data['breadcrumb'] = array(site_url()=>$this->lang->line('home'),null=>$this->lang->line('changePassword'));
			$this->load->view('index/changePassword',$data);
		}
		else{
			redirect($this->login_page);
		}
		
	}

	function profile(){
		if ($this->auth->isLoggedIn()) {
            $data['page_title'] = $this->lang->line('profile');
            $data['breadcrumb'] = array(site_url()=>$this->lang->line('home'),null=>$this->lang->line('profile'));
			$uid = $this->auth->getUserid();
			$data['profile'] = array();
			switch($this->auth->getRole()){
				case $this->auth->getPatientRoleType():
					$data['hip'] = $this->healthinsuranceprovider_model->getAllhealthinsuranceprovider();
					$data['profile'] = $this->patient_model->getProfile($this->auth->getUserid());
					$this->load->view('Patient/profile',$data);
					break;
				default: 
					$data['profile'] = $this->patient_model->getProfile($uid);
					// echo "<pre>";print_r($data);exit;
					$this->load->view('index/profile',$data);
			}
        } else redirect('index/login');
	}

	function updateprofile(){
		if ($this->auth->isLoggedIn()) {
			$data = array();
            $id = $this->input->post('eidt_gf_id');
            $res = $this->auth->addUser($_POST,$id);
            
            if($res === -1){
                $data['errors'] = array($this->lang->line('msg_email_exist'));
            }else if($res === false){
                $data['errors'] = array($this->lang->line('msg_try_again'));
            }else{
                $data['success'] = array($this->lang->line('msg_profile_updated'));
            }
            $this->session->set_flashdata('data', $data);
            redirect('index/profile');
		} else redirect('index/login');
	}

	
}

?>