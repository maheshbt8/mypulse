<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth {

	public function __construct(){
	//Load library
        $this->CI =& get_instance();
    	$this->CI->load->library('session');
    	
	}
	
    public function isLoggedIn()
    {
    	$userdata =  $this->CI->session->userdata('user_id');
    	$login = $this->CI->session->userdata('logged_in');
    	if($userdata==true && $login=='1'){
    		return true;
    	}else{
    		return false;
    	}
    }

    public function isSuperAdmin(){
        
        $role = $this->CI->session->userdata('role');
        if($role==$this->getAdminRoleType()){
            return true;
        }
        return false;
    }

    public function isHospitalAdmin(){
        
        $role = $this->CI->session->userdata('role');
        if($role==$this->getHospitalAdminRoleType()){
            return true;
        }
        return false;
    }


    public function isDoctor(){
        
        $role = $this->CI->session->userdata('role');
        if($role==$this->getDoctorRoleType()){
            return true;
        }
        return false;
    }

    public function isNurse(){
        
        $role = $this->CI->session->userdata('role');
        if($role==$this->getNurseRoleType()){
            return true;
        }
        return false;
    }

    public function isReceptinest(){
        
        $role = $this->CI->session->userdata('role');
        if($role==$this->getReceptienstRoleType()){
            return true;
        }
        return false;
    }

    public function isPatient(){
        
        $role = $this->CI->session->userdata('role');
        if($role==$this->getPatientRoleType()){
            return true;
        }
        return false;
    }
    
    public function getAuthData(){
    	return $this->CI->session->all_userdata();
    }

    public function getUsername(){
      $u = $this->CI->session->all_userdata();
      return $u['user_name'];
    }

    public function getRoleText(){
        $u = $this->CI->session->all_userdata();
        if(isset($u['role']))
            return $u['role'];
        return "";
    }

    public function getRole(){
        $u = $this->CI->session->all_userdata();
        if(isset($u['role']))
            return $u['role'];
        return 0;   
    }

    public function getProfileImg(){
      $u = $this->CI->session->all_userdata();
      if(isset($u['profile_img']))
        return $u['profile_img'];
      else
        return base_url()."public/assets/images/user.png";
    }    

    public function getHospitalId(){
        $u = $this->CI->session->all_userdata();
        if(isset($u['hospital_id'])){
            return $u['hospital_id'];
        }
        return 0;
    }

    public function getUserid(){
      $u = $this->CI->session->all_userdata();
      return $u['user_id'];
    }
    
    public function LoggedOut()
    {
   		$array_items = array('user_name' => '',
							 'user_id' => '',
							 'logged_in' => '0'
                            );
	   	$this->CI->session->unset_userdata($array_items);
	    $this->CI->session->sess_destroy();
		return true;
    }

    public function getAdminRoleType(){
        return 1;
    }

    public function getHospitalAdminRoleType(){
        return 2;
    }

    public function getDoctorRoleType(){
        return 3;
    }

    public function getNurseRoleType(){
        return 4;
    }

    public function getReceptienstRoleType(){
        return 5;
    }

    public function getPatientRoleType(){
        return 6;
    }

    public function getMedicalStoreRoleType(){
        return 7;
    }

    public function getMedicalLabRoleType(){
        return 8;
    }

    public function getBranchIds($hospital_id=null){
        if($hospital_id == null)
            $hospital_id = $this->getHospitalId();
        $this->CI->load->model('branches_model');
        $ids = $this->CI->branches_model->getBracheIds($hospital_id);
        if(count($ids) == 0){
            $ids[] = -1;
        }
        return $ids;
    }   

    public function getDepartmentsIdsByBranch(){

    }

    public function getAllDepartmentsIds(){
        $hospital_id = $this->getHospitalId();
        $this->CI->load->model('departments_model');
        $ids = $this->CI->departments_model->getDepartmentIdsFromHospital($hospital_id);
        if(count($ids) == 0){
            $ids[] = -1;
        }
        return $ids;
    }

    public function getAllWardsIds(){
        $hospital_id = $this->getHospitalId();
        $this->CI->load->model('wards_model');
        $ids = $this->CI->wards_model->getWardIdsFromHospital($hospital_id);
        if(count($ids) == 0){
            $ids[] = -1;
        }
        return $ids;
    }

    public function getAllDoctorsByHospitals(){
        $this->CI->load->model('doctors_model');
        $ids = $this->CI->doctors_model->getDoctorsIdsByHospital();
        if(count($ids) == 0){
            $ids[] = -1;
        }
        return $ids;
    }

    public function getActiveStatus($status,$onlytax = false){
        $status = intval($status);
        $text = "";
        $class = "";
        switch ($status) {
            case 1: 
                $class = "label label-success";
                $text = "Active";
                break;
            case 0: 
                $class = "label label-danger";
                $text = "Inactive";
                break;
        }
        if($onlytax){
            return $text;
        }else{
            return "<span class='$class'>$text</span>";
        }
    }


    public function addUser($data,$user_id=false){
        $user = array();

        if(isset($data['first_name'])){
            $user['first_name'] = $data['first_name'];
        }
        if(isset($data['last_name'])){
            $user['last_name'] = $data['last_name'];
        }
        $email = "";
        if(isset($data['useremail'])){
            $user['useremail'] = $data['useremail'];
            $email = $data['useremail'];
        }

        if($email == null || $email==""){
            return 0;
        }

        if(isset($data['password'])){
            $user['password'] = md5($data['password']);
        }
        if(isset($data['address'])){
            $user['address'] = $data['address'];
        }
        if(isset($data['mobile'])){
            $user['mobile'] = $data['mobile'];
        }
        if(isset($data['phone'])){
            $user['phone'] = $data['phone'];
        }
        if(isset($data['role'])){
            $user['role'] = $data['role'];
        }
        if(isset($data['aadhaar_number'])){
            $user['aadhaar_number'] = $data['aadhaar_number'];
        }
        if(isset($data['gender'])){
            $g = strtolower($data['gender']);
            if($g == "m" || $g == "male"){
                $user['gender'] = "M";
            }else if($g == "f" || $g == "female"){
                $user['gender'] = "F";
            }
        }
        if(isset($data['date_of_birth'])){
            $user['date_of_birth'] = date("Y-m-d",strtotime($data['date_of_birth']));
        }
        if(isset($data['address'])){
            $user['address'] = $data['address'];
        }
        if(isset($data['city'])){
            $user['city'] = $data['city'];
        }
        if(isset($data['state'])){
            $user['state'] = $data['state'];
        }
        if(isset($data['country'])){
            $user['country'] = $data['country'];
        }
        if(isset($data['alternate_mobile_number'])){
            $user['alternate_mobile_number'] = $data['alternate_mobile_number'];
        }
        if(isset($data['description'])){
            $user['description'] = $data['description'];
        }

        $this->CI->load->model('users_model');
        $uid = false;
        if($user_id){
            $uid = $this->CI->users_model->update($user_id,$user);
        }else{
            $uid = $this->CI->users_model->add($user);
        }

        if($uid !== false && $uid !== -1){
            
            if(isset($_FILES["profile_photo"]) && $_FILES['profile_photo']['error'] == 0){
                $url = base_url().'public/images/ux/'.$uid.".png";
                $path = dirname(BASEPATH)."/public/images/ux/".$uid.".png";
                move_uploaded_file($_FILES["profile_photo"]['tmp_name'],$path);
                $new_user['profile_photo'] = $url;
                $uid = $this->CI->users_model->update($uid,$new_user);
            }
        }

        return $uid;
    }

}

/* End of file Someclass.php */