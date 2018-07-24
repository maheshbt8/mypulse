<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Receptionist_model extends CI_Model {
    var $tblname = "hms_receptionist";
    function getAllreceptionist() {
        $this->db->where("isDeleted", "0");
        $res = $this->db->get($this->tblname);
        if ($res->num_rows()) return $res->result_array();
        else return array();
    }

    function getreceptionistById($id) {
        $r = $this->db->query("select *,isActive as curIsActive from " . $this->tblname . " where id=$id and isDeleted=0");
        $r = $r->row_array();
        $this->db->where('id',$r['user_id']);
        $data = $this->db->get('hms_users');
        $data = $data->row_array();
        if(is_array($data)){
            foreach ($data as $key => $value) {
                $r[$key] = $value;
            }
        }

        if(isset($r['doc_id'])){
            $this->db->where('id',$r['doc_id']);
            $this->db->where('isActive',1);
            $this->db->where("isDeleted",0);
            $doctor = $this->db->get('hms_doctors');
            $doctor =$doctor->row_array();
            $r['department_id'] = $doctor['department_id'];

            $this->db->where('id',$doctor['user_id']);
            $usr = $this->db->get("hms_users")->row_array();
            $r['doctor_name'] = $this->auth->getUName($usr);

            $this->db->where('id',$r['department_id']);
            $this->db->where('isActive',1);
            $this->db->where("isDeleted",0);
            $department = $this->db->get('hms_departments');
            $department =$department->row_array();
            $r['branch_id'] = $department['branch_id'];
            $r['department_name'] = $department['department_name'];



            $this->db->where('id',$r['branch_id']);
            $this->db->where('isActive',1);
            $this->db->where("isDeleted",0);
            $branch = $this->db->get('hms_branches');
            $branch =$branch->row_array();
            $r['hospital_id'] = $branch['hospital_id'];
            $r['branch_name'] = $branch['branch_name'];

            $this->db->where('id',$r['hospital_id']);
            $this->db->where('isActive',1);
            $this->db->where('isDeleted',0);
            $hosp  = $this->db->get('hms_hospitals')->row_array();
            $r['hospital_name'] = isset($hosp['name']) ? $hosp['name'] : "";
        }else{
            $r['doc_id'] = 0;
            $r['department_id'] = 0;
            $r['branch_id'] = 0;
            $r['hospital_id'] = 0;
        }

        return $r;
    }

    function search($q, $field) {
        
        if($this->auth->isHospitalAdmin()){
            $dids = $this->auth->getAllDoctorsByHospitals();
            $this->db->where_in("hms_receptionist.doc_id",$dids);
        }

        $this->db->like("hms_users.first_name",$q);
        $this->db->like("hms_users.last_name",$q);
        $this->db->where("hms_users.isDeleted",0);
        $this->db->where("hms_users.isActive",1);
        $this->db->where("hms_users.role",$this->auth->getDoctorRoleType());
        $this->db->select("hms_receptionist.id,CONCAT(`first_name`,`last_name`) as text", false);
        $this->db->where("hms_receptionist.isDeleted",0);
        $this->db->where("hms_receptionist.isActive",1);
        $this->db->from($this->tblname);

        $this->db->join("hms_users","hms_receptionist.user_id=hms_users.id");
        
        
        $res = $this->db->get();
        return $res->result_array();


    }

    function add() {
        $data = $_POST;
        $data['role'] = $this->auth->getReceptienstRoleType();
        $rec_id = $this->auth->addUser($data);
        
        if($rec_id === false){
            return false;
        }else if($rec_id < 0){
            return $rec_id;
        }
        else{
            $rec = array();
            $rec['user_id'] = $rec_id;
            $rec['doc_id'] = isset($data['doc_id']) ? $data['doc_id'] : 0;
            if(isset($data['qualification']))
                $rec['qualification'] = $data['qualification'];
            if(isset($data['experience']))
                $rec['experience'] = $data['experience'];
            $rec['created_at'] = date("Y-m-d H:i:s");
            if(isset($data['isActive']))
                $rec['isActive'] = intval($data['isActive']);
            if ($this->db->insert($this->tblname, $rec)) {
				$id = $this->db->insert_id();
                $this->logger->log("New receptionist added", Logger::Receptionist, $id);
                
				if(isset($data['doc_id']) && $data['doc_id'] != ""){
                    //find doctor user_id which is linked with this receptionist
                    $this->db->where('id', $data['doc_id']);
                    $doctor = $this->db->get('hms_doctors')->row_array();
                    //find doctor name from user table
                    $this->db->where('id', $doctor['user_id']);
                    $dname = $this->db->get('hms_users')->row_array();

                    //sent notification to doctor
                    $this->notification->saveNotification($doctor['user_id'],"New receptionist <b>".$data['first_name']." ".$data['last_name']."</b> is linked with you");

                    if(isset($rec['user_id']) && $rec['user_id'] != ""){
                        //sent notification to receptionist
                        $this->notification->saveNotification($rec['user_id'], "You are linked with <b>".$dname['first_name']." ".$dname['last_name']."</b> doctor as Receptionist");              
                    }

                    if($this->auth->isSuperAdmin()){
                        if(isset($data['hospital_id']) && $data['hospital_id'] != ""){
                            //find hospital admin
                            $this->db->where('hospital_id', $data['hospital_id']);
                            $hadmin = $this->db->get('hms_hospital_admin')->row_array();
                            //sent notification to hospital admin
                            $this->notification->saveNotification($hadmin['user_id'], "New receptionist <b>".$data['first_name']." ".$data['last_name']."</b> is linked with doctor: <b>".$dname['first_name']." ".$dname['last_name']."</b>");
                        }
                    }
                }
                return true;
            } else {
                return false;
            }
        }
        return true;
    }
	
	function addreceptionist() {
        $data = $_POST;
        $data['role'] = $this->auth->getReceptienstRoleType();
        $rec_id = $this->auth->addUser($data);
		//print_r($this->input->post('doc_id'));exit;
        
        if($rec_id === false){
            return false;
        }else if($rec_id < 0){
            return $rec_id;
        }
        else{
            $rec = array();
            $rec['user_id'] = $rec_id;
            //$rec['doc_id'] = isset($data['doc_id']) ? $data['doc_id'] : 0;
            if(isset($data['qualification']))
                $rec['qualification'] = $data['qualification'];
            if(isset($data['experience']))
                $rec['experience'] = $data['experience'];
            $rec['created_at'] = date("Y-m-d H:i:s");
            if(isset($data['isActive']))
                $rec['isActive'] = intval($data['isActive']);
				$doctorsid = $this->input->post('doc_id') ? $this->input->post('doc_id') : 0;
				if($doctorsid){
            foreach ($doctorsid as $did) {
			    $rec['doc_id'] = $did;
			    $this->db->insert($this->tblname, $rec);
				$id = $this->db->insert_id();
                $this->logger->log("New receptionist added", Logger::Receptionist, $id);
                
				if(isset($did) && $did != ""){
                    //find doctor user_id which is linked with this receptionist
                    $this->db->where('id', $did);
                    $doctor = $this->db->get('hms_doctors')->row_array();
                    //find doctor name from user table
                    $this->db->where('id', $doctor['user_id']);
                    $dname = $this->db->get('hms_users')->row_array();

                    //sent notification to doctor
                    $this->notification->saveNotification($doctor['user_id'],"New receptionist <b>".$data['first_name']." ".$data['last_name']."</b> is linked with you");

                    if(isset($rec['user_id']) && $rec['user_id'] != ""){
                        //sent notification to receptionist
                        $this->notification->saveNotification($rec['user_id'], "You are linked with <b>".$dname['first_name']." ".$dname['last_name']."</b> doctor as Receptionist");              
                    }

                    if($this->auth->isSuperAdmin()){
                        if(isset($data['hospital_id']) && $data['hospital_id'] != ""){
                            //find hospital admin
                            $this->db->where('hospital_id', $data['hospital_id']);
                            $hadmin = $this->db->get('hms_hospital_admin')->row_array();
                            //sent notification to hospital admin
                            $this->notification->saveNotification($hadmin['user_id'], "New receptionist <b>".$data['first_name']." ".$data['last_name']."</b> is linked with doctor: <b>".$dname['first_name']." ".$dname['last_name']."</b>");
                        }
                    }
                }
                
            }
			return true;
			 } else {
                return false;
            }
        }
        return true;
    }
    
    function update($id) {
        $data = $_POST;
        $this->db->where("id", $id);
        $rec = $this->db->get($this->tblname);
        $rec = $rec->row_array();

        $rec_id = isset($rec["user_id"]) ? $rec['user_id'] : 0;
        $rec_id = $this->auth->addUser($data,$rec_id);

        if($rec_id === false){
            return false;
        }else if($rec_id < 0){
            return $rec_id;
        }
        else{
            $rec = array();
            if(isset($data['doc_id']))
                $rec['doc_id'] = $data['doc_id'];
            if(isset($data['isActive']))
                $rec['isActive'] = intval($data['isActive']);
            if(isset($data['qualification']))
                $rec['qualification'] = $data['qualification'];
            if(isset($data['experience']))
                $rec['experience'] = $data['experience'];
            if(count($rec) > 0){
                $this->db->where("id", $id);
                if ($this->db->update($this->tblname, $rec)) {
                    $this->logger->log("Receptionist details updated", Logger::Receptionist, $id);
                    
                    if(!$this->auth->isReceptinest()){
                        if(isset($rec['user_id']) && $rec['user_id'] != ""){
                            //sent notification to receptionist
                            $this->notification->saveNotification($rec['user_id'], "Your profile is updated");
                        }
                        if(isset($data['doc_id']) && $data['doc_id'] != ""){
                            //find doctor user_id which is linked with this receptionist
                            $this->db->where('id', $data['doc_id']);
                            $doctor = $this->db->get('hms_doctors')->row_array();
                            
                            //sent notification to doctor
                            $this->notification->saveNotification($doctor['user_id'],"Receptionist <b>".$data['first_name']." ".$data['last_name']."</b> profile updated");
        
                            if($this->auth->isSuperAdmin()){
                                if(isset($data['hospital_id']) && $data['hospital_id'] != ""){
                                    //find hospital admin
                                    $this->db->where('hospital_id', $data['hospital_id']);
                                    $hadmin = $this->db->get('hms_hospital_admin')->row_array();
                                    //find doctor name from user table
                                    $this->db->where('id', $doctor['user_id']);
                                    $dname = $this->db->get('hms_users')->row_array();
                                    //sent notification to hospital admin
                                    $this->notification->saveNotification($hadmin['user_id'], "Receptionist <b>".$data['first_name']." ".$data['last_name']."</b> profile is updated. <br>Doctor: <b>".$dname['first_name']." ".$dname['last_name']."</b>");
                                }
                            }
                        }
                    }
                    return true;
                } else {
                    return false;
                }
            }
        }
        return true;
    }

    function delete($id) {
        if(is_array($id)){
            $this->db->where_in('id',$id);
        }else{
            $this->db->where("id", $id);
        }
        $d["isDeleted"] = 1;
        if ($this->db->update($this->tblname, $d)) {
			$this->logger->log("Receptionist details soft deleted", Logger::Receptionist, $id);
            return true;
        } else return false;
    }

    function getDoctorsIds($id=false){
        if($id===false){
            $id = $this->auth->getUserid();
        }
        
        $this->db->where('user_id',$id);
        $this->db->where('isDeleted',0);
        $this->db->where('isActive',1);
        $rep = $this->db->get($this->tblname);
        if($rep)
            $rep = $rep->result_array();
        else 
            $rep = array();
        $ids = array();
        foreach($rep as $p){
            $ids[] = $p['doc_id'];
        }
        return $ids;
    }

    public function getMyId(){
        $this->db->where('user_id',$this->auth->getUserid());
        $this->db->where('isDeleted',0);
        $this->db->where('isActive',1);
        $doc = $this->db->get($this->tblname);
        $doc = $doc->row_array();
        if(isset($doc['id'])){
            return $doc['id'];
        }
        return 0;   
    }

    public function getMyProfile(){
        $id = $this->getMyId();
        $this->db->where('id',$id);
        return $this->db->get($this->tblname)->row_array();
    }

    public function updateOtherProfile($id){
        $arr = array();
        $data = $_POST;
        if(isset($data['qualification']))
            $arr['qualification'] = $data['qualification'];
        if(isset($data['experience']))
            $arr['experience'] = $data['experience'];

        if(count($arr) > 0){
            $this->db->where("id", $id);
            if ($this->db->update($this->tblname, $arr)) {
				$this->logger->log("Receptionist details updated", Logger::Receptionist, $id);
                return true;
            }
        }
        return false;
    }
public function GetReceptionistDoctorsByID($id = NULL){
       
	   $RecpUserID = $this->db->query('SELECT `user_id` FROM `hms_receptionist` WHERE `id`='.$id.'')->row();
	   $Result = $this->db->query("SELECT rec.`id`,rec.`user_id`,rec.`doc_id`,dep.`id` AS deptid,brc.`id` AS branchid,CONCAT_WS(' ',usr.`first_name`,usr.`MiddleName`,usr.`last_name`) AS DocName FROM `hms_receptionist` AS rec
INNER JOIN `hms_doctors` AS doc ON doc.`id`=rec.doc_id
INNER JOIN `hms_departments` AS dep ON dep.`id`=doc.`department_id`
INNER JOIN `hms_branches` AS brc ON brc.`id`= dep.`branch_id`
INNER JOIN `hms_users` AS usr ON usr.`id`=doc.`user_id`
WHERE rec.`user_id`='$RecpUserID->user_id' GROUP BY doc.id")->result();
     if($Result){
	    return $Result;
	    }else{
		return false;
		}
	
	}

public function updaterecepdoctors($id) {
        $data = $_POST;
        $data['role'] = $this->auth->getReceptienstRoleType();
        $rec_id = $id;
		//print_r($this->input->post('doc_id'));exit;
        
        if($rec_id === false){
            return false;
        }else if($rec_id < 0){
            return $rec_id;
        }
        else{
            $rec = array();
			$rec['user_id'] = $recuser_id = $data['receptionistuserid'];
			                         $this->db->where('user_id',$recuser_id);
			$RemovePreviousDoctors = $this->db->delete('hms_receptionist');
            //$rec['doc_id'] = isset($data['doc_id']) ? $data['doc_id'] : 0;
            $rec['created_at'] = date("Y-m-d H:i:s");
			$rec['modified_at'] = date("Y-m-d H:i:s");
                $doctorsid = $this->input->post('doc_id') ? $this->input->post('doc_id') : 0;
				if($doctorsid){
            foreach ($doctorsid as $did) {
			    $rec['doc_id'] = $did;
			    $this->db->insert($this->tblname, $rec);
				$id = $this->db->insert_id();
                $this->logger->log("receptionist Doctor Updated", Logger::Receptionist, $id);
                
				if(isset($did) && $did != ""){
                    //find doctor user_id which is linked with this receptionist
                    $this->db->where('id', $did);
                    $doctor = $this->db->get('hms_doctors')->row_array();
                    //find doctor name from user table
                    $this->db->where('id', $doctor['user_id']);
                    $dname = $this->db->get('hms_users')->row_array();

                    //sent notification to doctor
                    //$this->notification->saveNotification($doctor['user_id'],"receptionist <b>".$data['first_name']." ".$data['last_name']."</b> is linked with you");

                    if(isset($rec['user_id']) && $rec['user_id'] != ""){
                        //sent notification to receptionist
                        $this->notification->saveNotification($rec['user_id'], "You are linked with <b>".$dname['first_name']." ".$dname['last_name']."</b> doctor as Receptionist");              
                    }

                    if($this->auth->isSuperAdmin()){
                        if(isset($data['hospital_id']) && $data['hospital_id'] != ""){
                            //find hospital admin
                            $this->db->where('hospital_id', $data['hospital_id']);
                            $hadmin = $this->db->get('hms_hospital_admin')->row_array();
                            //sent notification to hospital admin
                            $this->notification->saveNotification($hadmin['user_id'], "New receptionist <b>".$data['first_name']." ".$data['last_name']."</b> is linked with doctor: <b>".$dname['first_name']." ".$dname['last_name']."</b>");
                        }
                    }
                }
                
            }
			return true;
			 } else {
                return false;
            }
        }
        return true;
    }

}
