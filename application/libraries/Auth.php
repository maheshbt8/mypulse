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

    public function isMedicalLab(){
        $role = $this->CI->session->userdata('role');
        if($role==$this->getMedicalLabRoleType()){
            return true;
        }
        return false;
    }

    public function isMedicalStore(){
        $role = $this->CI->session->userdata('role');
        if($role==$this->getMedicalStoreRoleType()){
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
        $uid = isset($u['role']) ? $u['role'] : 6;
        return $this->CI->lang->line('roles')[$uid];
    }

    public function getRole(){
        $u = $this->CI->session->all_userdata();
        if(isset($u['role']))
            return $u['role'];
        return 0;   
    }

    public function getProfileImg(){
      $u = $this->CI->session->all_userdata();
      if(isset($u['profile_img']) && $u['profile_img'] != "")
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

    public function getDoctorId(){
        $this->CI->load->model('doctors_model');
        return $this->CI->doctors_model->getMyId();
    }

    public function getDoctorUserId($id){
        $this->CI->load->model('doctors_model');
        return $this->CI->doctors_model->getMyUserId($id);
    }

    public function getReceptinestId(){
        $this->CI->load->model('receptionist_model');
        return $this->CI->receptionist_model->getMyId();
    }

    public function getNurseId(){
        $this->CI->load->model('nurse_model');
        return $this->CI->nurse_model->getMyId();
    }
    
    public function getUserid(){
        $u = $this->CI->session->all_userdata();
        return $u['user_id'];
    }

    public function getMyKey(){
        $u = $this->CI->session->all_userdata();
        return $u['my_key'];
    }
    
    public function getUserIdFromRoleId($id=0,$role=0){
        switch($role){
            case $this->getDoctorRoleType():
                $this->CI->load->model('doctors_model');
                return $this->CI->doctors_model->getMyUserId($id);
                break;
            default:
                return 0;
        }
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

    public function getCountryName($con_id=0){
        $this->CI->load->model('general_model');
        return $this->CI->general_model->getCountryName($con_id);
    }

    public function getBranchIds($hospital_id=null){
        if($hospital_id == null)
            $hospital_id = $this->getHospitalId();
        $this->CI->load->model('branches_model');
        $ids = $this->CI->branches_model->getBranchesIds($hospital_id);
        if(count($ids) == 0){
            $ids[] = -1;
        }
        return $ids;
    }   

    public function getAllHospitalIds(){
        $this->CI->load->model('hospitals_model');
        $ids = $this->CI->hospitals_model->getHospicalIds();
        
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

    public function getDocIdsFromRecpId($id=false){
        $this->CI->load->model('receptionist_model');
        $ids = $this->CI->receptionist_model->getDoctorsIds($id);
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
                $text = $this->CI->lang->line('labels')['active'];
                break;
            case 0: 
                $class = "label label-danger";
                $text = $this->CI->lang->line('labels')['inactive'];
                break;
        }
        if($onlytax){
            return $text;
        }else{
            return "<span class='$class'>$text</span>";
        }
    }

    public function getUName($p){
        $name = "";
        if(isset($p['first_name'])){
            $name = $p['first_name']." ";
        }
        if(isset($p['last_name'])){
            $name .= $p['last_name'];
        }
        return $name;
    }

    public function getMyLabId(){
        $this->CI->load->model('medical_lab_model');
        return $this->CI->medical_lab_model->getMyLabId();
    }

    public function getMyStoreId(){
        $this->CI->load->model('medical_store_model');
        return $this->CI->medical_store_model->getMyStoreId();
    }

    public function getAppoitmentStatus($status=0,$onlytax = false){
        
        $status = intval($status);
        $text = "";
        $class = "";
        switch ($status) {
            case 1: 
                $class = "label label-primary";
                $text = $this->CI->lang->line('labels')['approved'];
                break;
            case 2: 
                $class = "label label-danger";
                $text = $this->CI->lang->line('labels')['rejected'];
                break;
            case 3: 
                $class = "label label-success";
                $text = $this->CI->lang->line('labels')['closed'];
                break;
            case 4: 
                $class = "label label-warning";
                $text = $this->CI->lang->line('labels')['canceled'];
                break;    
            default: 
                $class = "label label-info";
                $text = $this->CI->lang->line('labels')['pending'];
                break;
        }
        if($onlytax){
            return $text;
        }else{
            return "<span class='$class'>$text</span>";
        }
    }

    function my_encrypt_array($data,$uid){
        $key = $this->getKeyFromUid($uid);
        $encryption_key = base64_decode($key);

        foreach($data as $k=>$value){
            $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
            $encrypted = openssl_encrypt($value, 'aes-256-cbc', $encryption_key, 0, $iv);    
            $data[$k] = base64_encode($encrypted . '::' . $iv);
        }
        return $data;
    }

    function my_decrypt_array($data,$uid){
        $key = $this->getKeyFromUid($uid);
        $encryption_key = base64_decode($key);
        foreach($data as $k=>$value){
            list($encrypted_data, $iv) = explode('::', base64_decode($value), 2);
            $data[$k] = openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
        }
        return $data;
    }

    function my_encrypt($data, $uid) {
        $key = $this->getKeyFromUid($uid);
        $encryption_key = base64_decode($key);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
        return base64_encode($encrypted . '::' . $iv);
    }

    function my_decrypt($data, $uid) {
        $key = $this->getKeyFromUid($uid);
        $encryption_key = base64_decode($key);
        list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
    }

    public function getKeyFromUid($uid){
        if(!$this->isLoggedIn()){
            return "";
        }
        if($this->isPatient()){
            return $this->getMyKey();
        }else{
            $this->CI->load->model('users_model');
            return $this->CI->users_model->getUserKey($uid);
        }
    }

    public function parseUserResult($res,$msg=false){
        //echo "<pre>";var_dump($res,$msg);exit;
        if($msg === false){
            $msg = $this->CI->lang->line('msg_user_added');
        }
        $data = array();
        if($res === -1){
            $data['errors'] = array($this->CI->lang->line('msg_email_exist'));
        }else if($res === -2){
            $data['errors'] = array($this->CI->lang->line('msg_mobile_exist'));
        }else if($res === -3){
            $data['errors'] = array($this->CI->lang->line('msg_aadharnumber_exist'));
        }else if($res === false){
            $data['errors'] = array($this->CI->lang->line('msg_try_again'));
        }else{
            $data['success'] = array($msg);
        }
        return $data;
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

        /*if($email == null || $email==""){
            return 0;
        }*/

        if(isset($data['password']) && $data['password'] != ""){
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
            }else if($g == "o" || $g == "other"){
                $user['gender'] = "O";
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
        if(isset($data['district'])){
            $user['district'] = $data['district'];
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

        if($uid !== false && $uid > 0){
            
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