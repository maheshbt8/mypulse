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

}

/* End of file Someclass.php */