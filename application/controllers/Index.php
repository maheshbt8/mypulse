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
        $this->load->model('hospital_admin_model');
        $this->load->model('medical_lab_model');
        $this->load->model('medical_store_model');
        $this->load->model('doctors_model');
        $this->load->model('nurse_model');
		$this->load->model('receptionist_model');
		$this->load->model('hospitals_model');
		$this->load->model('branches_model');
	}

	function index($slug=null)
	{
		if(!$this->auth->isLoggedIn() && $slug != null && $slug!="index"){
			$data['logo'] = $this->hospitals_model->getLogoFromSlug($slug);
			$data['isHos'] = true;
			$this->load->view('index/login',$data);
			return;
		}
		//$this->users_model->updateKeys();
		//echo "Updateed";exit;
		if($this->auth->isLoggedIn()){
			$data['page_title'] = $this->lang->line('dashboard');
			$data['breadcrumb'] = array(site_url()=>$this->lang->line('home'),null=>$this->lang->line('dashboard'));
			if($this->auth->isSuperAdmin()){
				$data['states'] = $this->dashboard_model->getSuperAdminStates();
				$this->load->view('index/superadmindashboard',$data);
			}
			else if($this->auth->isHospitalAdmin()){
				$data['states'] = $this->dashboard_model->getHospitalAdminStates($this->auth->getHospitalId());
				$this->load->view('index/admindashboard',$data);
			}else if($this->auth->isPatient()){
				$data['states'] = $this->dashboard_model->getPatientStates($this->auth->getUserid());
				//$data['medicalLab'] = $this->medical_lab_model->getAllmedical_lab();
				$this->load->view('Patient/dashbord',$data);
			}else if($this->auth->isReceptinest()){
				$data['Doctors'] = $this->users_model->GetActiveDoctors($this->auth->getUserid());
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
			}else if($this->auth->isLoggedIn()){
				$data['states'] = $this->dashboard_model->getPatientStates($this->auth->getUserid());
				$this->load->view('Patient/dashbord',$data);

				/* $uid = $this->auth->getUserid();
				if(!$this->users_model->canUpdateMyRole($uid)){
					$_data['infos'] = array("We are processing your request. You will be notify once your request is completed.");
					$this->session->set_flashdata('data', $_data);
					$data['profile'] = $this->patient_model->getProfile($uid);
					$this->load->view('index/profile',$data);
				}else{
					$_data['infos'] = array($this->lang->line("select_your_role"));
					$this->session->set_flashdata('data', $_data);
					$data['page_title'] = $this->lang->line('profile');
					$data['breadcrumb'] = array(site_url()=>$this->lang->line('home'),null=>$this->lang->line('profile'));
					$this->load->view('index/dashboard',$data);
				} */
				
			}else{
				redirect($this->login_page);
			}
		}
		else{
			redirect($this->login_page);
		}
	}

	function testdt(){
		$this->load->view('testdt');
	}

	function getDataTabedoctors(){
		$this->load->library('datatables');		
		$this->datatables
			->select('CONCAT(hms_users.first_name," ",hms_users.last_name) as user_id, hms_hospitals.name as hname, hms_branches.branch_name as bname, hms_departments.department_name as dname, case when hms_doctors.isActive=1 then "Active" when hms_doctors.isActive=0 THEN "In-Active" end as Status, hms_doctors.id', false)
			->from('hms_doctors')
			->join('hms_users','hms_doctors.user_id = hms_users.id','left')
			->join('hms_departments','hms_doctors.department_id = hms_departments.id','left')
			->join('hms_branches','hms_departments.branch_id = hms_branches.id','left')
			->join('hms_hospitals','hms_branches.hospital_id = hms_hospitals.id','left')
			->add_column('edit', '<span class="equalDivParent"><a style="margin-right:5px" href="'.site_url().'doctors/availability/$1"  class=""  data-toggle="tooltip" title="Availability"><i class="glyphicon glyphicon-calendar"></i></button> <a href="#" id="dellink_$1" class="delbtn"  data-toggle="modal" data-target=".bs-example-modal-sm" data-id="$1" data-toggle="tooltip" title="Delete"><i class="glyphicon glyphicon-remove"></i></button></span>', 'id');

		//$this->datatables->select("id,name");
		//$this->datatables->from("hms_dcotors");


		echo $this->datatables->generate('json');
	}

	function sendmsg()
    {
        if($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin() || $this->auth->isDoctor() )){
            $uid = isset($_POST['to']) ? explode(",",$_POST['to']) : array();
            $msg = isset($_POST['message']) ? $_POST['message'] : "";
            $title = isset($_POST['title']) ? $_POST['title'] : "";
            $this->messages->saveMessage($uid,$msg,$title);

            $msg = "Message sent successfully";
            $data['success'] = array($msg);
            $this->session->set_flashdata('data', $data);

            //$data['page_title'] = $this->lang->line('messages');
            //$data['breadcrumb'] = array(site_url()=>$this->lang->line('home'),null=>$this->lang->line('messages'));
            //$this->load->view('index/messages',$data);
            redirect('index/messages');
        }
        else{
            redirect('index');
        }
    }


    function readmsg(){
        if($this->auth->isLoggedIn()) {
            $mid = $this->input->post('mid');
            $msg = $this->messages->markRead($mid);
            $mcount = $this->messages->getUnreadMessageCount();
            echo json_encode(array("message" => $msg, "count"=>$mcount));exit;
        }
    }

	function messages($id=0){
	    if($this->auth->isLoggedIn()){
            $data['page_title'] = $this->lang->line('messages');
            $data['breadcrumb'] = array(site_url()=>$this->lang->line('home'),null=>$this->lang->line('messages'));
            if($id > 0){
                $data['message'] = $this->messages->markRead($id);
            }
            $this->load->view('index/messages',$data);
        }else{
            redirect($this->login_page);
        }
    }

    function readnotification(){
        if($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            $this->load->model('notification_model');
            $this->notification_model->markAsRead($id);
            echo $this->notification_model->getUnreadNotificationCount($this->auth->getUserid());
        }
    }

    function readAllnotification(){
        if($this->auth->isLoggedIn()) {
            $this->load->model('notification_model');
            $this->notification_model->markAllAsRead();
            redirect($_SERVER["HTTP_REFERER"]);
        }
    }
	
	function updaterole(){
		if(!$this->auth->isLoggedIn()){
			redirect($this->login_page);
		}
		$uid = $this->auth->getUserid();
		if(!$this->users_model->canUpdateMyRole($uid)){
			redirect('index');
		}

		$this->users_model->updateMyRole($uid);
		$role = isset($_POST['role']) ? $_POST['role'] : $this->auth->getPatientRoleType();
		
		//if($role == $this->auth->getPatientRoleType()){
		//	$this->session->set_userdata('role', $role);
		//	$msg = "You have successfully register as MyPulse user";
		//	$data['success'] = array($msg);
		//}else{
			$msg = "We are processing your request. You will be notify once your request is completed.";
			$data['infos'] = array($msg);
		//}
		$this->session->set_flashdata('data', $data);
		redirect('index');
	}
	
	function registration(){
		if($this->auth->isLoggedIn()){
			$data['page_title'] = $this->lang->line('dashboard');
			$data['breadcrumb'] = array(site_url()=>$this->lang->line('home'),null=>$this->lang->line('dashboard'));
			$this->load->view($this->index_page,$data);
		}
		else{
			$this->load->view('index/login');
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
		$data = $this->auth->parseUserResult($cn,$this->lang->line('msg_registration_complete'));
		$this->session->set_flashdata('regdata', $cn);
		redirect('index/registration');
		/* if($cn === true){
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
		} */
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

	/* function mail(){
		$this->load->library('sendmail');
		$mail_data['body'] = 'To complete your MyPulse profile. Please verify your accout by click on following link <br> <a href="www.google.com">Verify Account</a>';
		$mail_data['subject'] = 'MyPulse Registration Complete';
		$mail_data['email'] = 'patelyogesh093@gmail.com';
		echo "<pre>";
		var_dump($this->sendmail->send($mail_data));exit;
	} */

	function vacc(){
		$k = isset($_GET['k']) ? $_GET['k'] : false;
		if($k === false)
			redirect('index');

		$k = base64_decode($k);
		$key = explode(":",$k);
		if(count($key) < 2)	{
			redirect('index');
		}

		if($this->users_model->verifyAccouunt($key)){
			$data['success']=array($this->lang->line('verification_complete'));
		}else{
			$data['errors']=array($this->lang->line('msg_unable_to_verify'));
		}
		$this->session->set_flashdata('data', $data);
		$this->load->view('index/login');
	}
	
	function forgot()
	{
		$this->load->view('index/login');
	}
	
	function sendResetKey()
	{
		$data = $this->users_model->validateUsername();

		if($data)
		{
			//require APPPATH.'libraries/phpMailer/sendMail.php';
			//$mail = new sendRestKey();
			
			$this->load->library('sendmail');
			
			if($this->sendmail->send($data))
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
		redirect('index/login');		
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
                    if($this->auth->isDoctor()){
						$data['DocSpec'] = $this->auth->getdoctorsSpecializationsById($this->doctors_model->getMyId());
                        $data['data'] = $this->doctors_model->getdoctorsById($this->doctors_model->getMyId());
                    }
                    if($this->auth->isNurse()){
                        $data['data'] = $this->nurse_model->getnurseById($this->nurse_model->getMyId());
                    }
                    if($this->auth->isReceptinest()){
                        $data['data'] = $this->receptionist_model->getreceptionistById($this->receptionist_model->getMyId());
                    }
                    if($this->auth->isHospitalAdmin()){
                        $data['data'] = $this->hospital_admin_model->gethospital_adminById($this->hospital_admin_model->getMyId());
                    }
                    if($this->auth->isMedicalStore()){
                        $data['data'] = $this->medical_store_model->getmedical_storeById($this->medical_store_model->getMyId());
                    }
                    if($this->auth->isMedicalLab()){
                        $data['data'] = $this->medical_lab_model->getmedical_labById($this->medical_lab_model->getMyId());
                    }
					$this->load->view('index/profile',$data);
			}
        } else redirect('index/login');
	}

	function updateprofile(){
		if ($this->auth->isLoggedIn()) {
			$data = array();
            $id = $this->input->post('eidt_gf_id');
            $res = $this->auth->addUser($_POST,$id);

            if($this->auth->isDoctor()){
                $doc_id = $this->doctors_model->getMyId();
                $this->doctors_model->updateOtherProfile($doc_id);
            }
            if($this->auth->isNurse()){
                $nid = $this->nurse_model->getMyId();
                $this->nurse_model->updateOtherProfile($nid);
            }
            if($this->auth->isReceptinest()){
                $rid = $this->receptionist_model->getMyId();
                $this->receptionist_model->updateOtherProfile($rid);
            }
			if($this->auth->isHospitalAdmin()){
                $HAid = $this->hospital_admin_model->getMyId();
                $this->hospital_admin_model->updateOtherProfile($HAid);
            }
            
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

    public function getDTMessages() {
        if ($this->auth->isLoggedIn() ) {
            $this->load->library("tbl");
            $table = "hms_messages";
            $primaryKey = "id";
            $columns = array(array("db" => "created_by", "dt" => 0, "formatter" => function ($d, $row) {
                $temp = $this->users_model->getusersById($d);
                $html = "<span class='msg_row' data-id='$row[id]'>";
                $html .= $this->auth->getUName($temp);
                $html .= "</span>";
                return $html;
            }), array("db" => "title", "dt" => 1, "formatter" => function ($d, $row) {
                $cls = "";
                if($row['isRead'] == 0) {
                    $cls = "bold";
                }
                $html = "<span class='msg_row $cls' data-id='$row[id]'>$d</span>";
                return $html;
            }), array("db" => "created_date", "dt" => 2, "formatter" => function ($d, $row) {
                $html = "<span class='msg_row' data-id='$row[id]'>";
                $html .= date("d-M-Y h:i A",strtotime($d));
                $html .= "</span>";
                return $html;
            }), array("db" => "id", "dt" => 3, "formatter" => function ($d, $row) {
                return "<a href=\"#\" data-id='$d' class=\"delbtn\" id='dellink_$d' data-toggle=\"tooltip\" title=\"Delete\"><i class=\"glyphicon glyphicon-remove\"></i></button>";
            }));

            $cond = array();
            $cond[] = "isDeleted=0";
            $cond[] = "user_id=".$this->auth->getUserid();
            $this->tbl->setCheckboxColumn(false);
            $this->tbl->setIndexColumn(true);
            $this->tbl->setTwID(implode(" AND ",$cond));
            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }
	
	public function deleteMessages(){
		if($this->auth->isLoggedIn()){
			$msg_id = isset($_POST['id']) ? $_POST['id'] : 0;
			$this->message_model->deleteMessages($msg_id);
			echo 1;	
		}else{
			echo 0;
		} 
		
	}
	
	public function deleteAllMessages(){
		if($this->auth->isLoggedIn()){
			$this->message_model->deleteAllMessages();
			echo 1;	
		}else{
			echo 0;
		}
	}
	
	public function validateOTPNumber(){
		extract($_POST);
		
		$response = $this->users_model->validateOTPNumber($otpnumber, $itemid);
		
		echo json_encode($response);
		
	}
	
	public function CheckVerifyMobileNumber(){
		extract($_POST);
		
		$response = $this->users_model->CheckVerifyMobileNumber($emailid);
		
		echo json_encode($response);
		
	}
	
	public function sendOTPtoMobileNumber(){
		extract($_POST);
		
		$response = $this->users_model->sendOTPtoMobileNumber($emailid);
		
		echo json_encode($response);
		
	}
	
	public function VerifyNewOTPNumber(){
		extract($_POST);
		
		$response = $this->users_model->VerifyNewOTPNumber($otpnumber, $otpid);
		
		echo json_encode($response);
		
	}
	
	public function sendRegisterOTPtoMobile(){
		extract($_POST);
		
		$response = $this->users_model->sendRegisterOTPtoMobile($mobno);
		
		echo json_encode($response);
		
	}
	
	public function CancelRegOTP(){
		extract($_POST);
		
		$response = $this->users_model->CancelRegOTP($otpid);
		
		echo json_encode($response);
		
	}

public function verifyStaffMobile(){
		extract($_POST);
		
		$response = $this->users_model->verifyStaffMobile($StaffID, $otpnumber, $otpid);
		
		echo json_encode($response);
		
	}
	
public function sendRegisterVerfEmail(){
		extract($_POST);
		
		$response = $this->users_model->sendRegisterVerfEmail($useremail);
		
		echo json_encode($response);
		
	}
	
public function setStaffPassword(){
		$k = isset($_GET['k']) ? $_GET['k'] : false;
		if($k === false)
			redirect('index');

		$k = base64_decode($k);
		$key = explode(":",$k);
		if(count($key) < 2)	{
			redirect('index');
		}

		if($this->users_model->verifyStaffAccount($key)){
			$data['success']=array($this->lang->line('verification_complete'));
			$this->session->set_flashdata('data', $data);
			$temp = array('key'=>$this->input->get('k'));
			$this->load->view('index/setPassword',$temp);
		}else{
			$data['errors']=array($this->lang->line('msg_unable_to_verify'));
			$this->session->set_flashdata('data', $data);
			$temp = array('key'=>$this->input->get('k'));
			$this->load->view('index/login',$temp);
		}
		
	}	
	
public function updateStaffPassword()
	{
		$temp = array();
		if($this->users_model->updateStaffPassword()){
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
	
public function terms_conditions(){

	   $this->load->view('index/termsconditions');
	
	}
	
public function privacy_policy(){

	   $this->load->view('index/privacy_policy');
	
	}
	
public function searchDoctor() {
        if ($this->auth->isLoggedIn()) {
		
            $q = $this->input->post("q");
			$this->load->model('users_model');
            $result = $this->users_model->searchDoctor($q);
            //$searcresult = $result;
			if($result){
			echo "<ul class='searchlist'>";
			foreach($result as $Row){
				echo "<li class='selected-docotr' rel='$Row->FullName' rel1='$Row->id'>".$Row->FullName.'('.$Row->name.', '.$Row->SpecializationName.')'."</li>";
				}
				echo "</ul>";
			}else{
				//return false;
				echo "<ul class='selected-docotr'><li class='selected-docotr'>No Doctor Found</li></ul>";
				}
        }
    }
	
public function searchBranches() {
        if ($this->auth->isLoggedIn()) {
            $q = $this->input->get("q", null, "");
            $f = $this->input->get("f", null, "");
            $hid = $this->input->get("hospital_id",null,-1);
            if($hid == -1 && !$this->auth->isSuperAdmin()){
                $hid = $this->auth->getHospitalId();
            }
            $result = $this->branches_model->search($q,$f,$hid);
			//print_r($result);exit;
            echo "<select name='branch_id' class='BranchID allowalphanumeric form-control'>";
			foreach($result as $Row){
			echo "<option value='$Row[id]'>$Row[text]</option>";
			}
			echo "</select>";
        }
    }
	
public function searchDepartment() {
       //error_reporting(0);
        if ($this->auth->isLoggedIn()) {
           
            $result = $this->users_model->DepartmentsByBranchID($this->input->get("branch_id"));
			//print_r($result);exit;
            echo "<select name='department_id' class='DepartmentID allowalphanumeric form-control'>
			      <option value=''>Please Select</option>
				  <option value='all'>Frontdesk / All Departments</option>";
			foreach($result as $Row){
			echo "<option value='$Row->id'>$Row->department_name</option>";
			}
			echo "</select>";
        }
    }
	
public function searchDepartmentDoctor() {
       //error_reporting(0);
        if ($this->auth->isLoggedIn()) {
            $result = $this->users_model->getdoctorsByDepartmentID($this->input->get("dept_id"),$this->input->get("branch_id"));
			if($result){
			echo "<select name='doc_id[]' class='DoctorID  allowalphanumeric'  multiple='multiple'>
			      ";
			foreach($result as $Row){
			echo "<option value='$Row->id'>$Row->FullName</option>";
			}
			echo "</select>";
			}else{
			echo "No Doctors Found.";
			}
			
        }
    }
	
public function getRecDoctors(){
       $data['ReceptionistID'] = $ReceptionistID = $this->input->get('ID');
	   $data['RecpUserID']= $RecpUserID = $this->db->query('SELECT `user_id`,IsForAllDoctors FROM `hms_receptionist` WHERE `id`='.$ReceptionistID.'')->row();
	   $data['Branches'] = $this->branches_model->getHospitalBranches($this->auth->getHospitalId());
	   $data['Result'] = $this->db->query("SELECT rec.`id`,rec.`user_id`,rec.`doc_id`,rec.`IsForAllDoctors`,dep.`id` AS deptid,brc.`id` AS branchid FROM `hms_receptionist` AS rec
INNER JOIN `hms_doctors` AS doc ON doc.`id`=rec.doc_id
INNER JOIN `hms_departments` AS dep ON dep.`id`=doc.`department_id`
INNER JOIN `hms_branches` AS brc ON brc.`id`= dep.`branch_id`
WHERE rec.`user_id`='$RecpUserID->user_id' GROUP BY doc.id")->result();
       $data['Departments'] = $this->db->query("SELECT dept.`id` AS deptid,dept.department_name FROM `hms_departments` AS dept WHERE dept.`branch_id`='". $data['Result'][0]->branchid."'  ")->result();
	   if($RecpUserID->IsForAllDoctors=='1'){
	   $DeptID="all";
	   $data['Doctors'] = $this->users_model->getdoctorsByDepartmentID($DeptID,$data['Result'][0]->branchid);
	   }else{
	   $data['Doctors'] = $this->users_model->getdoctorsByDepartmentID($data['Departments'][0]->deptid);
	   } 
	 /*if($Result){
	    $response = array('Status'=>1,'data'=>$Result);
	    }else{
		$response = array('Status'=>0);
		}*/
		echo $this->load->view('Receptionist/receptionist_doctors',$data,TRUE);
	   

  }							

public function getNurseDoctors(){
       error_reporting(0);
       $data['NurseID'] = $NurseID = $this->input->get('ID');
	   $data['NurseUserID']= $NurseUserID = $this->db->query('SELECT `user_id` FROM `hms_nurse` WHERE `id`='.$NurseID.'')->row();
	   $data['Branches'] = $this->branches_model->getHospitalBranches($this->auth->getHospitalId());
	   $data['Result'] = $this->db->query("SELECT nur.`id`,nur.`user_id`,nur.`doc_id`,dep.`id` AS deptid,brc.`id` AS branchid FROM `hms_nurse` AS nur
INNER JOIN `hms_doctors` AS doc ON doc.`id`=nur.doc_id
INNER JOIN `hms_departments` AS dep ON dep.`id`=doc.`department_id`
INNER JOIN `hms_branches` AS brc ON brc.`id`= dep.`branch_id`
WHERE nur.`user_id`='$NurseUserID->user_id' GROUP BY doc.id")->result();
       $data['Departments'] = $this->db->query("SELECT dept.`id` AS deptid,dept.department_name FROM `hms_departments` AS dept WHERE dept.`branch_id`='". $data['Result'][0]->branchid."'  ")->result();
	   $data['Doctors'] = $this->users_model->getdoctorsByDepartmentID($data['Departments'][0]->deptid); 
	 /*if($Result){
	    $response = array('Status'=>1,'data'=>$Result);
	    }else{
		$response = array('Status'=>0);
		}*/
		echo $this->load->view('Nurse/nurse_doctors',$data,TRUE);
	   

  }

}




?>