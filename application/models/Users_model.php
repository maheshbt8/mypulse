<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Users_model extends CI_Model {
    var $tblname = "hms_users";
    function getAllusers() {
        $this->db->where("isDeleted", "0");
        $res = $this->db->get($this->tblname);
        if ($res->num_rows()) return $res->result_array();
        else return array();
    }

    public function getSuperAdmin(){
        $this->db->where('role', '1');
        $sadmin = $this->db->get('hms_users')->result_array();
        return $sadmin;
    }

    function updateKeys(){
        $this->db->select('id');
        $users = $this->db->get($this->tblname);
        $users = $users->result_array();
        foreach($users as $u){
            $this->db->where('id',$u['id']);
            $key = base64_encode((bin2hex(openssl_random_pseudo_bytes(32))));
            $this->db->update($this->tblname,array("my_key"=>$key));
			$this->logger->log("User key updated", Logger::User, $u['id']);
        }
    }
    
    /*function doLogin()
    {   

        $unm=$this->input->post('email_id');
        $pwd=$this->input->post('password');
        $pwd=md5($pwd);
        $query=$this->db->query("select * from $this->tblname where useremail=? and password=?",array($unm,$pwd));
        if($query->num_rows() > 0 )
        {
            foreach ($query->result() as $row)
            {
                if($row->isActive == 1 && ($row->EmailVerified==1 || $row->MobileVerified==1)){
                    $this->setSessionData($row);
                    return true;
                }else{
                    return -1;
                }
            }
        }
        else
            return false;
    }*/
	
	function doLogin()
    {   

        $unm=$this->input->post('email_id');
        $pwd=$this->input->post('password');
        $pwd=md5($pwd);
        $query=$this->db->query("select * from $this->tblname where useremail=? and password=?",array($unm,$pwd))->result();
		//print_r()
		if(empty($query)){
		    $query = $this->db->query("select * from $this->tblname where mobile=? and password=?",array($unm,$pwd))->result();
		}
        if(!empty($query))
        {
            foreach ($query as $row)
            {
                if($row->isActive == 1 && ($row->EmailVerified==1 || $row->MobileVerified==1)){
				      if($row->useremail){
					  $this->db->query("UPDATE $this->tblname SET LastLogintime= '".date("Y-m-d H:i:s")."' WHERE useremail= '".$row->useremail."' ");
					  }
                    $this->setSessionData($row);
                    return true;
                }else{
                    return -1;
                }
            }
        }
        else
            return false;
    }

    function setSessionData($row){
       
        $session_data = array( 
            'user_name' => $row->first_name.' '.$row->last_name,
            'email_id' => $row->useremail,
            'user_id' => $row->id,
            'role' => $row->role,
            'my_key' => $row->my_key,
            'profile_img' => $row->profile_photo,
            'logged_in' => '1'
        );

        $RoletblName = "";
        switch ($row->role) {
            case $this->auth->getHospitalAdminRoleType(): $RoletblName = "hms_hospital_admin"; break;
            case $this->auth->getDoctorRoleType(): $RoletblName = "hms_doctors"; break;
            case $this->auth->getReceptienstRoleType(): $RoletblName = "hms_receptionist"; break;
            case $this->auth->getNurseRoleType(): $RoletblName = "hms_nurse"; break;            
            case $this->auth->getMedicalStoreRoleType(): $RoletblName = "hms_medical_store"; break;            
            case $this->auth->getMedicalLabRoleType(): $RoletblName = "hms_medical_lab"; break;            
        }

        //Check assigned role is active or not. iF not active set user role as Patient.
        if($RoletblName != ""){
            $res = $this->db->query("select * from {$RoletblName} where user_id={$row->id} and isDeleted=0 and isActive=1");
            if(!$res || $res->num_rows() == 0){
                $session_data['role'] = $this->auth->getPatientRoleType();   
            }
        }

        if($row->role == $this->auth->getHospitalAdminRoleType()){
            $this->db->where('user_id',$row->id);
            $this->db->where('isActive',1);
            $this->db->where('isDeleted',0);
            $adminRecord = $this->db->get('hms_hospital_admin');
            $adminRecord = $adminRecord->result_array();
            if(isset($adminRecord[0]) && isset($adminRecord[0]['hospital_id'])){
                $session_data['hospital_id'] = $adminRecord[0]['hospital_id'];
            }
        }else if($row->role == $this->auth->getDoctorRoleType()){
            $uid = $row->id;
            $doc = $this->db->query("select b.hospital_id from hms_doctors d,hms_departments p,hms_branches b where d.user_id=$uid and d.department_id = p.id and p.branch_id = b.id")->row_array();
            if(isset($doc['hospital_id'])){
                $session_data['hospital_id'] = $doc['hospital_id'];
            }
        }else if($row->role == $this->auth->getReceptienstRoleType()){
            $uid = $row->id;
            $doc = $this->db->query("select b.hospital_id from hms_receptionist r,hms_doctors d,hms_departments p,hms_branches b where r.user_id=$uid and r.doc_id=d.id and d.department_id = p.id and p.branch_id = b.id")->row_array();
            if(isset($doc['hospital_id'])){
                $session_data['hospital_id'] = $doc['hospital_id'];
            }
        }else if($row->role == $this->auth->getNurseRoleType()){
            $uid = $row->id;
            $doc = $this->db->query("select b.hospital_id from hms_nurse d,hms_departments p,hms_branches b where d.user_id=$uid and d.department_id = p.id and p.branch_id = b.id")->row_array();
            if(isset($doc['hospital_id'])){
                $session_data['hospital_id'] = $doc['hospital_id'];
            }
        }   
        $session_set = $this->session->set_userdata($session_data);
    }

    function getUserKey($id){
        $this->db->where("id",$id);
        $this->db->select("my_key");
        $u = $this->db->get($this->tblname);
        $u = $u->row_array();
        return isset($u['my_key']) ? $u['my_key'] : "";
    }
    function getusersById($id) {    
        $r = $this->db->query("select * from " . $this->tblname . " where id=$id and isDeleted=0");
        return $r->row_array();
    }

     public function getUsersByType($type=6){
        $this->db->where('isDeleted',0);
        $this->db->where('isActive',1);
        $this->db->where('role',$type);
        $res = $this->db->get($this->tblname);
        return $res->result_array();
    }

    function search($q, $field,$role) {
        $field = explode(",", $field);
        for($i=0; $i<count($field); $i++){ $field[$i] = "hms_users.".$field[$i]; }
        $select = implode('`," ",`', $field);
        if(isset($_GET['m']) && $_GET['m']==1){
            $field[] = 'hms_users.useremail';
        }
        if($role > 0){
            $this->db->where('hms_users.role',$role);
        }
        foreach ($field as $f) {
            $this->db->like($f, $q);
        }
        $this->db->from($this->tblname);
        if(!$this->auth->isHospitalAdmin()){
            if($role == 3){ // Doc
                $bids = $this->auth->getBranchIds();
                $this->db->where_in("hms_doctors.branch_id",$bids);
                $this->db->join("hms_doctors","hms_users.id=hms_doctors.user_id");
            }else if($role == 4){ //Nurse
                $ids = $this->auth->getAllDepartmentsIds();
                $this->db->where_in("hms_nurse.department_id",$bids);
                $this->db->join("hms_nurse","hms_users.id=hms_nurse.user_id");
            }else if($role == 5){ // Receptionist
                $ids = $this->auth->getAllDoctorsByHospitals();
                $this->db->where_in("hms_receptionist.doc_id",$ids);
                $this->db->join("hms_receptionist","hms_users.id=hms_receptionist.user_id");
            }
        }


        $this->db->where("hms_users.isDeleted",0);
        $this->db->select("hms_users.id,CONCAT(`$select`) as text,hms_users.useremail as email", false);
        $res = $this->db->get('hms_users');
        if($res)
            return $res->result_array();
        else    
            return array();
    }
    function searchPatient($q){
        $res = $this->db->query("select id,CONCAT(`first_name`,' ',`last_name`) as text from $this->tblname where isDeleted=0 and role=6 and (useremail='$q' OR mobile='$q' OR aadhaar_number='$q')");
        return $res->result_array();
    }
    function searchPatientByPID($q, $field){
        if(strlen($q)>0){
            $q = substr($q,1,strlen($q));
        }
        //echo $q;exit;
        $res = $this->db->query("select id,CONCAT(`first_name`,' ',`last_name`) as text from $this->tblname where isDeleted=0 and role=6 and mobile='$q'");
        return $res->result_array();
    }
    function checkEmail($email){
        $this->db->where('useremail',$email);
        $user = $this->db->get($this->tblname);
        if($user->num_rows() == 0){
            return false;
        }
        return true;
    }

    function searchmail($q=""){
        $res = null;
        if($this->auth->isSuperAdmin()){
            $res = $this->db->query("SELECT id, CONCAT(first_name,' ',last_name) as name, useremail as email from hms_users where first_name LIKE '%$q%' OR last_name LIKE '%$q%' OR useremail LIKE '%$q%' and isDeleted=0");
        }else if($this->auth->isHospitalAdmin() || $this->auth->isDoctor()){

            $this->load->model('hospitals_model');
            $this->load->model('branches_model');
            $this->load->model('departments_model');
            $this->load->model('doctors_model');

            $hids = $this->hospitals_model->getHospicalIds();
            $bids = $this->branches_model->getBracheIds($hids);
            $dids = $this->departments_model->getDepartmentIdsFromBranch($bids);
            $docIds = $this->doctors_model->getDoctorsIdsByDeppartmentId($dids);

            $uids = array();

            $mlres = $this->db->query("select DISTINCT user_id from hms_medical_lab where branch_id in (".implode(",",$bids).") and isDeleted=0 and isActive=1")->result_array();
            foreach ($mlres as $res){
                $uids[] = $res['user_id'];
            }

            $msres = $this->db->query("select DISTINCT user_id from hms_medical_store where branch_id in (".implode(",",$bids).") and isDeleted=0 and isActive=1")->result_array();
            foreach ($msres as $res){
                $uids[] = $res['user_id'];
            }

            $dres = $this->db->query("select DISTINCT user_id from hms_doctors where department_id in (".implode(",",$dids).") and isDeleted=0 and isActive=1")->result_array();
            foreach ($dres as $res){
                $uids[] = $res['user_id'];
            }

            $nres = $this->db->query("select DISTINCT user_id from hms_nurse where department_id in (".implode(",",$dids).") and isDeleted=0 and isActive=1")->result_array();
            foreach ($nres as $res){
                $uids[] = $res['user_id'];
            }

            $rres = $this->db->query("select DISTINCT user_id from hms_receptionist where doc_id in (".implode(",",$docIds).") and isDeleted=0 and isActive=1")->result_array();
            foreach ($rres as $res){
                $uids[] = $res['user_id'];
            }

            $pres = $this->db->query("select DISTINCT patient_id from hms_prescription where doctor_id in (".implode(",",$docIds).") and isDeleted=0 ")->result_array();
            foreach ($pres as $res){
                $uids[] = $res['patient_id'];
            }

            $sres = $this->db->query("select id from hms_users where role=1 and isActive=1 and isDeleted=0")->result_array();
            foreach ($sres as $res){
                $uids[] = $res['id'];
            }

            $hres = $this->db->query("select id from hms_users where role=2 and isActive=0 and isDeleted=0")->result_array();
            foreach ($hres as $res){
                $uids[] = $res['id'];
            }

            $uids = implode(",",$uids);
            $res = $this->db->query("SELECT id, CONCAT(first_name,' ',last_name) as name, useremail as email from hms_users where (first_name LIKE '%$q%' OR last_name LIKE '%$q%' OR useremail LIKE '%$q%') and isDeleted=0 and id in ($uids)");
        }
        return $res->result_array();
    }

    //Return list of user ids of given role.
    function getUserIdsForMultiMessage($role=0){
        $this->load->model('hospitals_model');
        $this->load->model('branches_model');
        $this->load->model('departments_model');
        $this->load->model('doctors_model');

        $hids = $this->hospitals_model->getHospicalIds();
        $bids = $this->branches_model->getBracheIds($hids);
        $dids = $this->departments_model->getDepartmentIdsFromBranch($bids);
        $docIds = $this->doctors_model->getDoctorsIdsByDeppartmentId($dids);

        $uids = array();
        if($role == 8){
            $mlres = $this->db->query("select DISTINCT user_id from hms_medical_lab where branch_id in (".implode(",",$bids).") and isDeleted=0 and isActive=1")->result_array();
            foreach ($mlres as $res){
                $uids[] = $res['user_id'];
            }
        }else if($role == 7){
            $msres = $this->db->query("select DISTINCT user_id from hms_medical_store where branch_id in (".implode(",",$bids).") and isDeleted=0 and isActive=1")->result_array();
            foreach ($msres as $res){
                $uids[] = $res['user_id'];
            }
        }else if($role == 3){
            $dres = $this->db->query("select DISTINCT user_id from hms_doctors where department_id in (".implode(",",$dids).") and isDeleted=0 and isActive=1")->result_array();
            foreach ($dres as $res){
                $uids[] = $res['user_id'];
            }
        }else if($role == 4){
            $nres = $this->db->query("select DISTINCT user_id from hms_nurse where department_id in (".implode(",",$dids).") and isDeleted=0 and isActive=1")->result_array();
            foreach ($nres as $res){
                $uids[] = $res['user_id'];
            }
        }else if($role == 5){
            $rres = $this->db->query("select DISTINCT user_id from hms_receptionist where doc_id in (".implode(",",$docIds).") and isDeleted=0 and isActive=1")->result_array();
            foreach ($rres as $res){
                $uids[] = $res['user_id'];
            }
        }else if($role == 6){
            $pres = $this->db->query("select DISTINCT patient_id from hms_prescription where doctor_id in (".implode(",",$docIds).") and isDeleted=0 ")->result_array();
            foreach ($pres as $res){
                $uids[] = $res['patient_id'];
            }
        }
        return $uids;
    }

    function checkMobile($mobile){
        $this->db->where('mobile',$mobile);
        $user = $this->db->get($this->tblname);
        if($user->num_rows() == 0){
            return false;
        }
        return true;
    }
    function regUsers(){
        $data['useremail'] = isset($_POST['useremail']) ? $_POST['useremail'] : "";
        $data['mobile'] = isset($_POST['mobile']) ? $_POST['mobile'] : "";
        $data['first_name'] = isset($_POST['first_name']) ? $_POST['first_name'] : "";
        $data['last_name'] = isset($_POST['last_name']) ? $_POST['last_name'] : "";
        $data["role"] = 6;
        $data['isRegister'] = 0;
        $data['created_at'] = date("Y-m-d H:i:s");
        $data['my_key'] = base64_encode((bin2hex(openssl_random_pseudo_bytes(32))));
        $this->db->insert($this->tblname,$data);
        $uid = $this->db->insert_id();
		//check log
		$this->logger->log("New user registered", Logger::User, $uid);
        return $uid;
    }
    function add($user=null) {
        $data = array();
        if($user==null)
            $data = $_POST;
        else
            $data = $user;

        unset($data["eidt_gf_id"]);
        if (isset($data["role"])) $data["role"] = intval($data["role"]);
        if (isset($data["isActive"])) $data["isActive"] = intval($data["isActive"]);
        $key = "";
        if($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin()){
            $key = strtoupper(bin2hex(openssl_random_pseudo_bytes(5)));
            $data['forgotPassCode'] = $key;
        }

        $data['created_at'] = date("Y-m-d H:i:s");
        $data['my_key'] = base64_encode((bin2hex(openssl_random_pseudo_bytes(32))));
        if ($this->db->insert($this->tblname, $data)) {
            $_uid = $this->db->insert_id();
			//check log
			$this->logger->log("New user created", Logger::User, $_uid);
			
            $email = $data['useremail'];
            $this->load->library('sendmail');
            $enc = $key.":".$email;
            $url = site_url().'/index/setStaffPassword?k='.base64_encode($enc);
            $username = $this->auth->getUsername();
            $role = $this->lang->line('roles')[$data['role']];
            $mail_data['body'] = 'Welcome to MyPulse,<br>'.$username.' has register you as '.$role.'<br>To complete your MyPulse profile. Please verify your account by click on following link and update your password <br> <a href="'.$url.'">Verify Account</a>';
            $mail_data['subject'] = 'MyPulse Registration';
            $mail_data['email'] = $data['useremail'];
            $this->sendmail->send($mail_data);
			$mobno = $data['mobile'];
            $SMSText = ' Welcome to MyPulse. '.$username.' has register you as '.$role.' To complete your MyPulse profile. Please verify your email '.$email.'';
$json = json_decode(file_get_contents("https://smsapi.engineeringtgr.com/send/?Mobile=9739195391&Password=mypulse123&Message=".urlencode($SMSText)."&To=".urlencode($mobno)."&Key=vrredbqiVYIctT1koQxs2E"),true);
            return $_uid;
        } else {
            $err = $this->db->error();
            //echo "<pre>";print_r($err);
            if($err['code'] == 1062){
                $a = $err['message'];
                if (strpos($a, 'usernemail') !== false) {
                    return -1;
                }else if(strpos($a, 'mobile') !== false) {
                    return -2;
                }else if(strpos($a, 'aadhaar_number') !== false){
                    return -3;
                }
                return -4;
            }
            return false;
        }
    }
    function update($id,$usr=null) {
        
        $data = array();
        if($usr==null)
            $data = $_POST;
        else
            $data = $usr;

        $this->db->where('id',$id);
        $this->db->where('isDeleted',0);
        $user = $this->db->get($this->tblname);
        $user = $user->row_array();
        //echo "<pre>";
        $isDataChanged = $this->auth->compareDataWithPost($user,$data);

        //var_dump($user);
        //var_dump($data);
        //var_dump($isDataChanged);exit;
        if(!$isDataChanged)
            return $id;

        if(isset($data['useremail'])){
            if(isset($user['id'])){
                if($user['useremail'] == $data['useremail']){
                    unset($data['useremail']);
                }
            }
        }
        
        if(isset($data['mobile'])){
            if(isset($user['id'])){
                if($user['mobile'] == $data['mobile']){
                    unset($data['mobile']);
                }
            }
        }

        if(isset($data['aadhaar_number'])){
            if(isset($user['id'])){
                if($user['aadhaar_number'] == $data['aadhaar_number']){
                    unset($data['aadhaar_number']);
                }
            }
        }
        
        unset($data["eidt_gf_id"]);
        if (isset($data["role"])) $data["role"] = intval($data["role"]);
        if (isset($data["date_of_birth"])) $data["date_of_birth"] = date("Y-m-d",strtotime($data["date_of_birth"]));
        if (isset($data["isActive"])) $data["isActive"] = intval($data["isActive"]);
        $this->db->where("id", $id);
        
        if ($this->db->update($this->tblname, $data)) {
			//check log
			$this->logger->log("User details updated", Logger::User, $id);
			
            if ($this->auth->getUserId() != $id) {
                //sent notification to any user
                $this->notification->saveNotification($id, "Your Profile is updated");
            }else{
                $query = $this->db->query("select * from $this->tblname where id=?", array($id));
                if ($query->num_rows() > 0) {
                    foreach ($query->result() as $row) {
                        $this->setSessionData($row);
                    }
                }
            }
            return $id;
        } else {
            $err = $this->db->error();
            if($err['code'] == 1062){
                $a = $err['message'];
                if (strpos($a, 'usernemail') !== false) {
                    return -1;
                }else if(strpos($a, 'mobile') !== false) {
                    return -2;
                }else if(strpos($a, 'aadhaar_number') !== false){
                    return -3;
                }
                return -4;
            }
            return false;
        }
    }

    function delete($id) {
        if(is_array($id)){
            $this->db->where_in('id',$id);
        }else{
            $this->db->where("id", $id);
        }
        $d["isDeleted"] = 1;
        if ($this->db->update($this->tblname, $d)) {
			//check log
			$this->logger->log("User soft deleted", Logger::User, $id);
            return true;
        } else return false;
    }

    function doReg(){
        if(isset($_POST)){
            $this->db->where('useremail',$_POST['useremail']);
            $this->db->where('isDeleted',0);
			$this->db->where('isRegister !=',0);
            $user = $this->db->get($this->tblname);
			if($user->num_rows() > 0){
                return -1;
            }else{
                $data = $_POST;

                $data['password'] = md5($data['password']);
                $name = explode(" ",$data['first_name']);
                unset($data['agrree']);
                unset($data['re_password']);
                $data['first_name'] = $name[0];
                if(isset($name[1])){
                    $data['last_name'] = $name[1];
                }
                $key = strtoupper(bin2hex(openssl_random_pseudo_bytes(5)));
                $data['forgotPassCode'] = $key;

                $data['my_key'] = base64_encode((bin2hex(openssl_random_pseudo_bytes(32))));
                $data['role'] = 6;
				$data['isActive'] = 1;
				$data['MobileVerified'] = 1;
				$checkmobile = $this->db->query("SELECT `id` FROM `hms_users` WHERE `mobile` = '".$data['mobile']."'  AND `isRegister` ='0'")->row();
				if($checkmobile){
				    $data['updated_at']= date('Y-m-d H:i:s');
					$data['isRegister']= 1;
				    $this->db->where('id', $checkmobile->id);
					$this->db->update($this->tblname, $data);
					$uid = $this->db->affected_rows();
					}else {
					$data['created_at']= date('Y-m-d H:i:s');
					$this->db->insert($this->tblname, $data);
					$uid = $this->db->insert_id();
					}
                if ($uid) {
					//$uid = $this->db->insert_id();
					
					/*$otp = rand(100000,999999);
							$otpdata = array(
							'user_id' => $uid,
							'OTPNumber' => $otp,
							'CreatedDate' => date('Y-m-d H:i:s'),
							'Status' => 0,
							);
							$this->db->insert("hms_users_otp", $otpdata); */
					
					
					//check log
					$this->logger->log("New user created", Logger::User, $uid);
					
                    $email = $data['useremail'];
					$mobile = $data['mobile'];
                    $this->load->library('sendmail');
                    $enc = $key.":".$email;
                    $url = site_url().'/index/vacc?k='.base64_encode($enc);
                    $mail_data['body'] = 'Welcome to MyPulse,<br>To complete your MyPulse profile. Please verify your account by click on following link <br> <a href="'.$url.'">Verify Account</a>';
                    $mail_data['subject'] = 'MyPulse Registration ';
                    $mail_data['email'] = $data['useremail'];
                    $this->sendmail->send($mail_data);
                    //return true;
					        
					/*$msg = $otp.' is your OTP Number to login';
$json = json_decode(file_get_contents("https://smsapi.engineeringtgr.com/send/?Mobile=9739195391&Password=mypulse123&Message=".urlencode($msg)."&To=".urlencode($mobile)."&Key=raisiVvTbgKISshQjnMNGr"),true);*/
                    return $this->db->insert_id();
                } else {
                    $err = $this->db->error();
                    echo "<pre>";print_r($err);exit;
                    if($err['code'] == 1062){
                        $a = $err['message'];
                        if (strpos($a, 'usernemail') !== false) {
                            return -1;
                        }else if(strpos($a, 'mobile') !== false) {
                            return -2;
                        }else if(strpos($a, 'aadhaar_number') !== false){
                            return -3;
                        }
                        return -4;
                    }
                    return false;
                }
            }
        }
        else
            return false;
    }

    function verifyAccouunt($key){
        $this->db->where("forgotPassCode",$key[0]);
		$this->db->where("useremail",$key[1]);
        $user = $this->db->get($this->tblname)->row_array();
		$createddate = strtotime($user['created_at']);
		if (time() - $createddate > 60 * 60) {
		
				return  false;
			}
        if(isset($user['id'])){
            $this->db->where("id",$user['id']);
            $this->db->update($this->tblname,array("forgotPassCode"=>null,"isActive"=>1,"EmailVerified"=>1));
			//check log
			$this->logger->log("User profile verfied", Logger::User, $user['id']);
            return true;
        }else{
            return false;
        }
    }

    function saveImage(){
        try{
                       
            $basepath = dirname(BASEPATH).'/assets/images/users/';
                
            $name = substr(md5(date("Y-m-d H:i:s")),0,rand(8,15));
            
            $ext = '.'.pathinfo($_FILES['pic']['name'], PATHINFO_EXTENSION);
            $temp = $basepath.$name.$ext;
            if(move_uploaded_file($_FILES['pic']['tmp_name'], $temp)){
				return $name.$ext;
			}
            else
                return "";
        }
        catch(Exception $e){
            return "";
        }
    }

    function canUpdateMyRole($uid){
        $this->db->where('id',$uid);
        $user = $this->db->get($this->tblname)->row_array();
        if($user['hasSelectedRole'] == 0)
            return true;
        return false;
    }

    function updateMyRole($uid){
        
        $role = isset($_POST['role']) ? $_POST['role'] : $this->auth->getPatientRoleType();
        switch($role){
            case $this->auth->getHospitalAdminRoleType():
                $roleText = $this->lang->line('roles')[2];
                $hospital_id = isset($_POST['hospital_id']) ? $_POST['hospital_id'] : 0;
                $this->db->insert('hms_hospital_admin',array('hospital_id'=>$hospital_id, 'user_id'=> $uid, 'isActive'=> 0));
                $sadmins = $this->getSuperAdmin();
                //get username
                $this->db->where('id', $uid);
                $user = $this->db->get('hms_users')->row_array();
                //get hospital name
                $hospital = $this->db->query("select name from hms_hospitals where id = $hospital_id")->row_array();
                //sent notification to super admin
                foreach ($sadmins as $sadmin){
                    $this->notification->saveNotification($sadmin['id'], "<b>".$user['first_name']." ".$user['last_name']."</b> is successfully registered as <b>".$roleText."</b> in Hospital: <b>".$hospital['name']."</b>");
                }
                break;
            case $this->auth->getDoctorRoleType():
                $roleText = $this->lang->line('roles')[3];
                $hospital_id = $_POST['hospital_id'];
                $department_id = isset($_POST['department_id']) ? $_POST['department_id'] : 0;
                $this->db->insert('hms_doctors',array('department_id'=>$department_id, 'user_id'=> $uid, 'isActive'=> 0));
                $this->sendNotificationForUpdateMyRole($roleText, $uid, $hospital_id, 0, $department_id, 0);
                break;
            case $this->auth->getNurseRoleType():
                $roleText = $this->lang->line('roles')[4];
                $hospital_id = $_POST['hospital_id'];
                $department_id = isset($_POST['department_id']) ? $_POST['department_id'] : 0;
                $this->db->insert('hms_nurse',array('department_id'=>$department_id, 'user_id'=> $uid, 'isActive'=> 0));
                $this->sendNotificationForUpdateMyRole($roleText, $uid, $hospital_id, 0, $department_id, 0);
                break;      
            case $this->auth->getReceptienstRoleType():
                $roleText = $this->lang->line('roles')[5];
                $hospital_id = $_POST['hospital_id'];
                $doctor_id = isset($_POST['doctor_id']) ? $_POST['doctor_id'] : 0;
                $this->db->insert('hms_receptionist',array('doc_id'=>$doctor_id, 'user_id'=> $uid, 'isActive'=> 0));
                $this->sendNotificationForUpdateMyRole($roleText, $uid, $hospital_id, 0, 0, $doctor_id);
                break;    
            case $this->auth->getPatientRoleType():
                break;
            case $this->auth->getMedicalStoreRoleType():
                $roleText = $this->lang->line('roles')[7];
                $hospital_id = $_POST['hospital_id'];
                $branch_id = isset($_POST['branch_id']) ? $_POST['branch_id'] : 0;
                $name = isset($_POST['store_name']) ? $_POST['store_name'] : "New Medical Store";
                $this->db->insert('hms_medical_store',array('branch_id'=>$branch_id, 'user_id'=> $uid, 'isActive'=> 0, 'name'=> $name));
                $this->sendNotificationForUpdateMyRole($roleText, $uid, $hospital_id, $branch_id, 0, 0);
                break;    
            case $this->auth->getMedicalLabRoleType():
                $roleText = $this->lang->line('roles')[8];
                $hospital_id = $_POST['hospital_id'];
                $branch_id = isset($_POST['branch_id']) ? $_POST['branch_id'] : 0;
                $name = isset($_POST['lab_name']) ? $_POST['lab_name'] : "New Medical Lab";
                $this->db->insert('hms_medical_lab',array('branch_id'=>$branch_id, 'user_id'=> $uid, 'isActive'=> 0, 'name' => $name));
                $this->sendNotificationForUpdateMyRole($roleText, $uid, $hospital_id, $branch_id, 0, 0);
                break;    
        }
        
        $this->db->where('id',$uid);
        $this->db->update($this->tblname,array('role'=>$role));
		//check log
		$this->logger->log("User role updated", Logger::User, $uid);
        return true;
    }
    
    function validateUsername(){
        $email = $this->input->post('email_id');
        if($email!="")
        {
            $res = $this->db->query("select * from ".$this->tblname." where useremail=?",array($email));
            if($res->num_rows() > 0)
            {
                $key = strtoupper(bin2hex(openssl_random_pseudo_bytes(5)));
                 $data = array('forgotPassCode'=>$key,'updated_at'=>date('Y-m-d H:i:s'));
                $this->db->where('useremail',$email);
                $this->db->update($this->tblname,$data);
                $data = array();
                $data['body'] = "Reset password using following link : ".base_url()."/index/resetPassword?key=".$key;
                $data['email']=$this->input->post('email_id');
                $data['subject']='Reset Password';
                return $data;
            }
            else
                return false;
        }
        else
            return false;
    }
    
    function resetPassword()
    {
        $key = $this->input->post('key');
        $pass = $this->input->post('password');
        $repass = $this->input->post('repassword');
        if($pass==$repass){
			$this->db->where('forgotPassCode', $key);
			$id = $this->db->get($this->tblname)->row_array();
			$id = isset($id['id']) ? $id['id'] : 0;
            $q = "update ".$this->tblname." set password=?,forgotPassCode=NULL where forgotPassCode=?";
            $rs=$this->db->query($q,array(md5($pass),$key));
            if($this->db->affected_rows()>0)
            {
				$this->logger->log("Password reset", Logger::User, $id);
                return true;
            }
            else
                return false;   
        }           
        return false;
    }   
    
    
    public function chechk_availability($username)
    {
        $this->db->where('email_id',$username);
        $query = $this->db->get_where($this->tblname);
        return $query->num_rows();
    }
    
    public function chechk_email_availability($email)
    {
        $this->db->where('email_id',$email);
        $query = $this->db->get_where($this->tblname);
        return $query->num_rows();
    }

    public function getProfile($id){
        $res = $this->db->query("select * from ".$this->tblname." where id=$id");
        $res = $res->row_array();
        $con = $this->db->query("select * from hms_country where id = $res[country]");
        if($con->num_rows() > 0){
            $con = $con->row_array();
            $res['country_name'] = $con['name'];
        }else{
            $res['country_name'] = '';
        }
        return $res;
    }

    public function changePassword($op,$np){
        $id = $this->auth->getUserid();
        $this->db->where('id',$id);
        $this->db->where('password',md5($op));
        $user = $this->db->get($this->tblname);
        if($user->num_rows() == 0)
            return -1;
        else{
            $this->db->where('id',$id);
            if($this->db->update($this->tblname,array('password'=>md5($np)))){
				//check log
				$this->logger->log("User password chanaged", Logger::User, $id);
				return true;
			}
        }
    }

    public function sendNotificationForUpdateMyRole($role, $uid, $hid, $bid, $did, $doid){
        //get h.admin user_id
        $hadmin = $this->db->query("select user_id from hms_hospital_admin where hospital_id = $hid")->row_array();
        //get user name
        $this->db->where('id', $uid);
        $user = $this->db->get('hms_users')->row_array();
        if($bid == 0 && $doid == 0){
            //get department name
            $deptname = $this->db->query("select department_name from hms_departments where id = $did")->row_array();

            $this->notification->saveNotification($hadmin['user_id'], "<b>".$user['first_name']." ".$user['last_name']."</b> is successfully registered as <b>".$role."</b> in Department: <b>".$deptname['department_name']."</b>");
        }
        if($bid == 0 && $did == 0){
            //get doctor user_id
            $doctor = $this->db->query("select department_name from hms_departments where id = $did")->row_array();
            //get doctor name
            $this->db->where('id', $doctor['user_id']);
            $docname = $this->db->get('hms_users')->row_array();

            $this->notification->saveNotification($hadmin['user_id'], "<b>".$user['first_name']." ".$user['last_name']."</b> is successfully registered as <b>".$role."</b> <br> Linked with doctor: <b>".$docname['first_name']." ".$docname['last_name']."</b>");
        }
        if($did == 0 && $doid == 0){
            //get branch name
            $bname = $this->db->query("select branch_name from hms_branches where id = $bid")->row_array();

            $this->notification->saveNotification($hadmin['user_id'], "<b>".$user['first_name']." ".$user['last_name']."</b> is successfully registered as <b>".$role."</b> in Branch: <b>".$bname['branch_name']."</b>");
        }

    }
	
	public function validateOTPNumber($otpnumber, $itemid){
		
		$checkuser = $this->db->query("SELECT `item_id` FROM `hms_activitylog` WHERE `id` = '$itemid'")->row();
		$userid = $checkuser->item_id;
		
		
		$getotpnumber = $this->db->query("SELECT * FROM `hms_users_otp` WHERE `user_id` = '$userid' AND Status = 0 ORDER BY `OTPID` DESC
")->row();
		
		if(!empty($getotpnumber->OTPNumber == $otpnumber)){
			
			$otpdata = array(
							'ModifiedDate' => date('Y-m-d H:i:s'),
							'Status' => 1,
							);
							
							$this->db->where('OTPID', $getotpnumber->OTPID);
							$this->db->update("hms_users_otp", $otpdata);
							
			$userdata = array(
							'updated_at' => date('Y-m-d H:i:s'),
							'isActive' => 1,
							'MobileVerified' => 1
							);
							
							$this->db->where('id', $userid);
							$this->db->update("hms_users", $userdata);
							
			return  array('Status' => 1);
		}
		else{
			return  array('Status' => 0);
		}
	}
	
	public function CheckVerifyMobileNumber($emailid){
		
		$verifyuser = $this->db->query("SELECT * FROM `hms_users` WHERE `useremail`  = '$emailid'")->row();
		
		
		if($verifyuser->isActive == 1 && ($verifyuser->EmailVerified==1 || $verifyuser->MobileVerified==1)){
			return  array('Status' => 1);
			
		}
		else{
			return  array('Status' => 0);
		}
	}
	
	public function sendOTPtoMobileNumber($emailid){
		
		$verifyuser = $this->db->query("SELECT * FROM `hms_users` WHERE `useremail`  = '$emailid'")->row();
		
		
		if(!empty($verifyuser)){
						$otp = rand(100000,999999);
							$otpdata = array(
							'user_id' => $verifyuser->id,
							'OTPNumber' => $otp,
							'CreatedDate' => date('Y-m-d H:i:s'),
							'Status' => 0,
							);
							$this->db->insert("hms_users_otp", $otpdata);
			
			return  array('Status' => 1, 'userid' => $verifyuser->id);
			
		}
		else{
			return  array('Status' => 0);
		}
	}
	
	public function VerifyNewOTPNumber($otpnumber, $otpid){
		
		
		
		$getotpnumber = $this->db->query("SELECT * FROM `hms_users_otp` WHERE `OTPID` = '$otpid' AND Status = 0 ORDER BY `OTPID` DESC
")->row();
		//print_r($getotpnumber);
		
		$dbdate = strtotime($getotpnumber->CreatedDate);
			if (time() - $dbdate > 10 * 60) {
				return  array('Status' => 2, 'message' => $this->lang->line('otp_verification_incomplete'));
			}
		
		else if($getotpnumber->OTPNumber == $otpnumber){
			
			/*$otpdata = array(
							'ModifiedDate' => date('Y-m-d H:i:s'),
							'Status' => 1,
							);
							
							$this->db->where('OTPID', $getotpnumber->OTPID);
							$this->db->update("hms_users_otp", $otpdata); */
							
							$this->db->delete('hms_users_otp', array('OTPID'=>$otpid));
							
			return  array('Status' => 1);
		}
		else{
			return  array('Status' => 0);
		}
	}
	
	public function sendRegisterOTPtoMobile($mobno){
		                
						extract($_POST);
						$otp = rand(100000,999999);
						
							//$msg = $otp.' is your OTP Number to login';
							//$json = json_decode(file_get_contents("https://smsapi.engineeringtgr.com/send/?Mobile=9739195391&Password=mypulse123&Message=".urlencode($msg)."&To=".urlencode($mobno)."&Key=vrredbqiVYIctT1koQxs2E"),true);
							$mobile="$mobno";
							$message="$otp is your OTP Number to login";
							//$json = json_decode(file_get_contents("https://smsapi.engineeringtgr.com/send/?Mobile=8686824761&Password=9502016142&Message=".urlencode($message)."&To=".urlencode($mobile)."&Key=raisiVvTbgKISshQjnMNGr"),true);
							$otpdata = array(
							'MobileNumber' => $mobno,
							'EmailID' => $useremail,
							'Name' => $name,
							'OTPNumber' => $otp,
							'CreatedDate' => date('Y-m-d H:i:s'),
							'Status' => 0,
							);
							$this->db->insert("hms_users_otp", $otpdata);
				$idata = $this->db->insert_id();
			
			if($idata){
				
			return  array('Status' => 1, 'otpid' => $idata);
			
		}
		else{
			return  array('Status' => 0);
		}
	}
	
	public function CancelRegOTP($otpid){		
		
		
		$getotpnumber = $this->db->query("SELECT * FROM `hms_users_otp` WHERE `OTPID` = '$otpid' AND Status = 0 ORDER BY `OTPID` DESC
")->row();
		//print_r($getotpnumber);
		
		if(!empty($getotpnumber)){
			
							$this->db->delete('hms_users_otp', array('OTPID'=>$otpid));
							
			return  array('Status' => 1);
		}
		else{
			return  array('Status' => 0);
		}
	}
	
public function verifyStaffMobile($StaffID, $otpnumber, $otpid){
		
		
		
		$getotpnumber = $this->db->query("SELECT * FROM `hms_users_otp` WHERE `OTPID` = '$otpid' AND Status = 0 ORDER BY `OTPID` DESC
")->row();
		//print_r($getotpnumber);
		
		$dbdate = strtotime($getotpnumber->CreatedDate);
			if (time() - $dbdate > 10 * 60) {
				return  array('Status' => 2, 'message' => $this->lang->line('otp_verification_incomplete'));
			}
		
		else if($getotpnumber->OTPNumber == $otpnumber){
			
			$otpdata = array(
							'updated_at' => date('Y-m-d H:i:s'),
							'MobileVerified' => 1,
							);
							
							$this->db->where('id', $StaffID);
							$this->db->update("hms_users", $otpdata); 
							
							$this->db->delete('hms_users_otp', array('OTPID'=>$otpid));
							
			return  array('Status' => 1);
		}
		else{
			return  array('Status' => 0);
		}
	}  

public function sendRegisterVerfEmail($mobno){
		extract($_POST);
		$mail_data = array();
		$key = strtoupper(bin2hex(openssl_random_pseudo_bytes(5)));
		$my_key = base64_encode((bin2hex(openssl_random_pseudo_bytes(32))));
		$email = $useremail;
		$this->db->query("UPDATE hms_users SET my_key='".$my_key."',updated_at='".date('Y-m-d H:i:s')."',forgotPassCode='".$key."' WHERE useremail = '".$email."'");
		$updateid = $this->db->affected_rows();
		$this->load->library('sendmail');
		$enc = $key.":".$email;
		$url = site_url().'/index/vacc?k='.base64_encode($enc);
		$mail_data['body'] = 'Please verify your account by click on following link <br> <a href="'.$url.'">Verify Account</a>';
		$mail_data['subject'] = 'MyPulse Registration ';
		$mail_data['email'] = $email;
		$this->sendmail->send($mail_data);
                    					                
		if($updateid){
			return true;
		}else{
			return false;
		}
		
	}
	
public function verifyStaffAccount($key){
        $this->db->where("forgotPassCode",$key[0]);
		$this->db->where("useremail",$key[1]);
        $user = $this->db->get($this->tblname)->row_array();
		$createddate = strtotime($user['created_at']);
		if (time() - $createddate > 60 * 60) {
		
				return  false;
			}
        if(isset($user['id'])){
            $this->db->where("id",$user['id']);
            $this->db->update($this->tblname,array("isActive"=>1,"EmailVerified"=>1));
			//check log
			$this->logger->log("User profile verified", Logger::User, $user['id']);
            return true;
        }else{
            return false;
        }
    }
	
public function updateStaffPassword()
    {   
	    $key = $this->input->post('key');
		$k = base64_decode($key);
		$decode = explode(":",$k);
        $pass = $this->input->post('password');
        $repass = $this->input->post('repassword');
		if($pass==$repass){
			$this->db->where('forgotPassCode', $decode[0]);
			$id = $this->db->get($this->tblname)->row_array();
			$id = isset($id['id']) ? $id['id'] : 0;
            $q = "update ".$this->tblname." set password=?,forgotPassCode=NULL where forgotPassCode=?";
            $rs=$this->db->query($q,array(md5($pass),$decode[0]));
            if($this->db->affected_rows()>0)
            {
				$this->logger->log("Password reset", Logger::User, $id);
                return true;
            }
            else
                return false;   
        }           
        return false;
    }
	
public function searchDoctor($q = NULL){
       
	  // $search = explode(' ',$q);
		//$ocusearch = count($search);
		/*if($ocusearch > '1'){
		
$Result = $this->db->query("SELECT doc.`id`,CONCAT_WS(' ',users.`first_name`,users.`MiddleName`,users.`last_name`) AS FullName,spec.`SpecializationName`,hos.`name` FROM `hms_doctors` AS doc INNER JOIN `hms_users` AS users ON users.`id`=doc.user_id INNER JOIN `hms_departments` AS dept ON dept.`id` = doc.`department_id` 
INNER JOIN `hms_branches` AS bran ON bran.`id`=dept.`branch_id` INNER JOIN `hms_hospitals` AS hos ON hos.`id`=bran.`hospital_id` INNER JOIN `hms_doctors_specialization`,hos.`name`  AS docspec ON docspec.`doc_id`= doc.`id` INNER JOIN `hms_mstr_specializations`  AS spec ON spec.`SpecializationID`= docspec.`SpecializationFKID` WHERE users.`first_name` LIKE '%".$search[0]."%' OR users.`MiddleName` LIKE '%".$search[1]."%' OR users.`last_name` LIKE '%".$search[1]."%' OR spec.`SpecializationName` LIKE '%".$search[1]."%' AND users.isDeleted='0' AND users.isActive='1' AND doc.isDeleted='0' AND doc.isActive='1' AND hos.id = '".$this->session->userdata('hospital_id')."' AND users.role='3' GROUP BY doc.`user_id` ");
		}else{*/
			
			$Result = $this->db->query("SELECT doc.`id`,CONCAT_WS(' ',users.`first_name`,users.`MiddleName`,users.`last_name`) AS FullName, spec.`SpecializationName`,hos.`name` FROM `hms_doctors` AS doc INNER JOIN `hms_users` AS users ON users.`id`=doc.user_id INNER JOIN `hms_departments` AS dept ON dept.`id` = doc.`department_id` INNER JOIN `hms_branches` AS bran ON bran.`id`=dept.`branch_id` INNER JOIN `hms_hospitals` AS hos ON hos.`id`=bran.`hospital_id` LEFT JOIN `hms_doctors_specialization`  AS docspec ON docspec.`doc_id`= doc.`id` LEFT JOIN `hms_mstr_specializations`  AS spec ON spec.`SpecializationID`= docspec.`SpecializationFKID` WHERE users.`first_name` LIKE '%".$q."%' OR users.`MiddleName` LIKE '%".$q."%' OR users.`last_name` LIKE '%".$q."%' OR spec.`SpecializationName` LIKE '%".$q."%' AND users.isDeleted='0' AND users.isActive='1' AND doc.isDeleted='0' AND doc.isActive='1' AND hos.id = '".$this->session->userdata('hospital_id')."' AND users.role='3' GROUP BY doc.`user_id` ");
			//}
			
			
		if($Result->num_rows() > 0){
		    return $Result->result();
		}else{
			$Result = $this->db->query("SELECT doc.`id`,CONCAT_WS(' ',users.`first_name`,users.`MiddleName`,users.`last_name`) AS FullName,spec.`SpecializationName`,hos.`name` FROM `hms_doctors` AS doc INNER JOIN `hms_users` AS users ON users.`id`=doc.user_id INNER JOIN `hms_departments` AS dept ON dept.`id` = doc.`department_id` INNER JOIN `hms_branches` AS bran ON bran.`id`=dept.`branch_id` INNER JOIN `hms_hospitals` AS hos ON hos.`id`=bran.`hospital_id` INNER JOIN `hms_doctors_specialization`  AS docspec ON docspec.`doc_id`= doc.`id` INNER JOIN `hms_mstr_specializations`  AS spec ON spec.`SpecializationID`= docspec.`SpecializationFKID` WHERE spec.`SpecializationName` LIKE '%".$q."%' AND users.isDeleted='0' AND users.isActive='1' AND doc.isDeleted='0' AND doc.isActive='1' AND users.role='3' GROUP BY doc.`user_id` ");
		  if($Result->num_rows() > 0){
		    return $Result->result();
		}else{
			$Result = $this->db->query("SELECT doc.`id`,CONCAT_WS(' ',users.`first_name`,users.`MiddleName`,users.`last_name`) AS FullName,spec.`SpecializationName`,hos.`name` FROM `hms_doctors` AS doc INNER JOIN `hms_users` AS users ON users.`id`=doc.user_id INNER JOIN `hms_departments` AS dept ON dept.`id` = doc.`department_id` INNER JOIN `hms_branches` AS bran ON bran.`id`=dept.`branch_id` INNER JOIN `hms_hospitals` AS hos ON hos.`id`=bran.`hospital_id` LEFT JOIN `hms_doctors_specialization`  AS docspec ON docspec.`doc_id`= doc.`id` LEFT JOIN `hms_mstr_specializations`  AS spec ON spec.`SpecializationID`= docspec.`SpecializationFKID` WHERE hos.`name` LIKE '%".$q."%' AND users.isDeleted='0' AND users.isActive='1' AND doc.isDeleted='0' AND doc.isActive='1' AND users.role='3' GROUP BY doc.`user_id` ");
		  if($Result->num_rows() > 0){
		    return $Result->result();
		}else{
			return false;
			}
			}
		}	
	}
	
public function DepartmentsByBranchID($BranchID = NULL){

    $Result =  $this->db->query("SELECT `id`,`department_name` FROM `hms_departments` WHERE `isActive`='1' AND `isDeleted`='0' AND `branch_id`='$BranchID'")->result();
    if($Result){
		return $Result;	  
	   }else{
	    return false; 
	   }
    }				
  	
public function getdoctorsByDepartmentID($DeptID = NULL,$BRID = NULL){
	if($DeptID=="all"){
	$Result = $this->db->query("SELECT doc.`id`,doc.`user_id`,CONCAT_WS(' ',usr.`first_name`,usr.`MiddleName`,usr.`last_name`) AS FullName FROM `hms_doctors` AS doc
								INNER JOIN `hms_users` AS usr ON usr.`id`=doc.`user_id`
								INNER JOIN `hms_departments` AS dep ON dep.`id`=doc.`department_id` 
								INNER JOIN `hms_branches` AS br ON br.`id`=dep.`branch_id`
								WHERE usr.`isActive`='1' AND usr.`isDeleted`='0' AND doc.`isActive`='1' AND doc.`isDeleted`='0' AND br.`id`='$BRID' GROUP BY doc.user_id ")->result();
	}else{
    $Result =  $this->db->query("SELECT doc.`id`,doc.`user_id`,CONCAT_WS(' ',usr.`first_name`,usr.`MiddleName`,usr.`last_name`) AS FullName FROM `hms_doctors` AS doc INNER JOIN `hms_users` AS usr ON usr.`id`=doc.`user_id` WHERE usr.`isActive`='1' AND usr.`isDeleted`='0' AND doc.`isActive`='1' AND doc.`isDeleted`='0' AND doc.`department_id`='$DeptID' GROUP BY doc.user_id ")->result();
    }
	
	if($Result){
		return $Result;	  
	   }else{
	    return false; 
	   }
    }
	
public function GetActiveDoctors($ID = NULL){
		if($this->auth->isReceptinest() && $ID){
		$Result = $this->db->query("SELECT doc.`id`,doc.`user_id`,CONCAT_WS(' ',usr.`first_name`,usr.`MiddleName`,usr.`last_name`) AS FullName FROM `hms_doctors` AS doc
								  	INNER JOIN hms_users AS usr ON usr.id = doc.user_id
									INNER JOIN hms_receptionist AS rec ON rec.doc_id = doc.id
									WHERE rec.`user_id`='".$ID."' AND doc.`isActive`='1' AND doc.`isDeleted`='0' GROUP BY rec.`doc_id`
								   ")->result();
			if($Result){
				return $Result;
			}else{
			return false;
			}
		}elseif($this->auth->isHospitalAdmin() && $ID){
		$Result = $this->db->query("SELECT doc.`id`,doc.`user_id`,CONCAT_WS(' ',usr.`first_name`,usr.`MiddleName`,usr.`last_name`) AS FullName FROM `hms_doctors` AS doc
								  	INNER JOIN hms_users AS usr ON usr.id = doc.user_id
									INNER JOIN `hms_departments` AS dep ON dep.`id` = doc.`department_id`
									INNER JOIN `hms_branches` AS brn ON brn.`id` = dep.`branch_id`
									INNER JOIN `hms_hospitals` AS hos ON hos.`id` = brn.`hospital_id`
									WHERE hos.`id`='".$this->auth->getHospitalId()."' AND doc.`isActive`='1' AND doc.`isDeleted`='0'
								   ")->result();
			if($Result){
			return $Result;
			}else{
			return false;
			}					   
		}elseif($this->auth->isSuperAdmin()){
		$Result = $this->db->query("SELECT doc.`id`,doc.`user_id`,CONCAT_WS(' ',usr.`first_name`,usr.`MiddleName`,usr.`last_name`) AS FullName FROM `hms_doctors` AS doc
								  	INNER JOIN hms_users AS usr ON usr.id = doc.user_id
									INNER JOIN `hms_departments` AS dep ON dep.`id` = doc.`department_id`
									INNER JOIN `hms_branches` AS brn ON brn.`id` = dep.`branch_id`
									INNER JOIN `hms_hospitals` AS hos ON hos.`id` = brn.`hospital_id`
									WHERE doc.`isActive`='1' AND doc.`isDeleted`='0'
								   ")->result();
			if($Result){
			return $Result;
			}else{
			return false;
			}					   
		}else{
		return false;
		}
	}		
	
}
