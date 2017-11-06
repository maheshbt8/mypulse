<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Medical_store_model extends CI_Model {
    var $tblname = "hms_medical_store";
    function getAllmedical_store() {
        $this->db->where("isDeleted", "0");
        $res = $this->db->get($this->tblname);
        if ($res->num_rows()) return $res->result_array();
        else return array();
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
    function getmedical_storeById($id) {
        $r = $this->db->query("select *,isActive as curIsActive from " . $this->tblname . " where id=$id and isDeleted=0");
        $r = $r->row_array();
        $this->db->where('id',$r['user_id']);
        $user = $this->db->get('hms_users');
        $user = $user->row_array();
        $r['user'] = $user;
        $r['branch_name'] = "";
        $r['hospital_name'] = "";
        if(isset($r['branch_id'])){
            $this->db->where('id',$r['branch_id']);
            $this->db->where('isActive',1);
            $this->db->where("isDeleted",0);
            $branch = $this->db->get('hms_branches');
            $branch =$branch->row_array();
            $r['branch_name'] = $branch['branch_name'];
            $r['hospital_id'] = $branch['hospital_id'];
            $this->db->where('id',$branch['hospital_id']);
            $hos = $this->db->get('hms_hospitals');
            $hos = $hos->row_array();
            $r['hospital_name'] = $hos['name'];
        }
        $r['country_name'] = $this->auth->getCountryName($r['country']);
        return $r;
    }
    function search($q, $field, $city) {
        $field = explode(",", $field);
        if($city!=null){
            $this->db->where('city',$city);
        }
        foreach ($field as $f) {
            $this->db->like($f, $q);
        }
        $select = implode('`," ",`', $field);
        $this->db->where("isDeleted",0);
        $this->db->select("id,CONCAT(`$select`) as text", false);
        $res = $this->db->get($this->tblname);
        return $res->result_array();
    }
    function add() {

        $data = $_POST;
        $data['role'] = $this->auth->getMedicalStoreRoleType();
        $uid = $this->auth->addUser($data);
        
        if($uid === false){
            return false;
        }else if($uid < -1){
            return $uid;
        }else{
            $mstore['user_id'] = $uid;
            $mstore['name'] = $data['name'];
            if(isset($data['country']))
                $mstore['country'] = $data['country'];
            if(isset($data['state']))
                $mstore['state'] = $data['state'];
            if(isset($data['district']))
                $mstore['district'] = $data['district'];
            if(isset($data['city']))
                $mstore['city'] = $data['city'];    
            $mstore['owner_name'] = $data['owner_name'];

            if(isset($data['md_description'])){
                $mstore['description'] = $data['md_description'];
            }
            else if(isset($data['description'])){
                $mstore['description'] = $data['description'];
            }

            if(isset($data['address'])){
                $mstore['address'] = $data['address'];
            }else if(isset($data['m_address'])){
                $mstore['address'] = $data['m_address'];
            }

            if(isset($data['phone_number'])){
                $mstore['phone_number'] = $data['phone_number'];
            }else if(isset($data['m_phone_number'])){
                $mstore['phone_number'] = $data['m_phone_number'];
            }

            $mstore['owner_contact_number'] = $data['owner_contact_number'];
            $mstore['branch_id'] = isset($data['branch_id']) ? $data['branch_id'] : -1;
            $mstore['created_at'] = date("Y-m-d H:i:s");
            if(isset($data['isActive']))
                $mstore['isActive'] = intval($data['isActive']);
            if ($this->db->insert($this->tblname, $mstore)) {
				$id = $this->db->insert_id();
				$this->logger->log("New medical store added", Logger::MedicalStore, $id);
				
                //find hospital name
                $this->db->where('id', $data['hospital_id']);
                $hospital = $this->db->get('hms_hospitals')->row_array();
                //sent notification to medical store
                $this->notification->saveNotification($mstore['user_id'], "You are linked with <b>".$hospital['name']."</b> hospital");

                if($this->auth->isSuperAdmin()){
                    //find branch name
                    $this->db->where('id',$data['branch_id']);
                    $branch = $this->db->get('hms_branches')->row_array();
                    //find hospital admin
                    $this->db->where('hospital_id', $data['hospital_id']);
                    $hadmin = $this->db->get('hms_hospital_admin')->row_array();
                    //sent notification to hospital admin
                    $this->notification->saveNotification($hadmin['user_id'], "New medical store <b>".$data['name']."</b> is linked with branch: <b>".$branch['branch_name']."</b>");
                }
                return true;
            } else {
                return false;
            }
        }
    }
    function update($id) {

        $data = $_POST;
        $this->db->where("id", $id);
        $usr = $this->db->get($this->tblname);
        $usr = $usr->row_array();

        $uid = isset($usr["user_id"]) ? $usr["user_id"] : 0;
        $uid = $this->auth->addUser($data,$uid);

        if($uid === false){
            return false;
        }else if($uid < 0){
            return $uid;
        }
        else{
            $mstore = array();
            if(isset($data['name']))
                $mstore['name'] = $data['name'];
            if(isset($data['country']))
                $mstore['country'] = $data['country'];
            if(isset($data['state']))
                $mstore['state'] = $data['state'];
            if(isset($data['district']))
                $mstore['district'] = $data['district'];
            if(isset($data['city']))
                $mstore['city'] = $data['city'];    
            if(isset($data['owner_name']))
                $mstore['owner_name'] = $data['owner_name'];
            if(isset($data['owner_contact_number']))
                $mstore['owner_contact_number'] = $data['owner_contact_number'];
            if(isset($data['branch_id']))
                $mstore['branch_id'] = $data['branch_id'];
            if(isset($data['md_description'])){
                $mstore['description'] = $data['md_description'];
            }
            else if(isset($data['description'])){
                $mstore['description'] = $data['description'];
            }
            
            if(isset($data['address'])){
                $mstore['address'] = $data['address'];
            }else if(isset($data['m_address'])){
                $mstore['address'] = $data['m_address'];
            }

            if(isset($data['phone_number'])){
                $mstore['phone_number'] = $data['phone_number'];
            }else if(isset($data['m_phone_number'])){
                $mstore['phone_number'] = $data['m_phone_number'];
            }

            if(isset($data['isActive']))
                $mstore['isActive'] = intval($data['isActive']);
            if(count($mstore) > 0){
                $this->db->where("id", $id);
                if ($this->db->update($this->tblname, $mstore)) {
					$this->logger->log("Medical store details updated", Logger::MedicalStore, $id);
					
                    if(!$this->auth->isMedicalStore()){
                        // sent notification to medical_store incharge
                        $this->notification->saveNotification($usr['user_id'],"Your profile is updated");
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
			$this->logger->log("Medical store deleted", Logger::MedicalStore, $id);
            return true;
        } else return false;
    }

    function getMyStoreId(){
        $this->db->where('user_id',$this->auth->getUserid());
        $this->db->where('isDeleted',0);
        $ml = $this->db->get($this->tblname);
        $ml = $ml->row_array();
        return isset($ml['id']) ? $ml['id'] : 0;
    }
    function getMyPatientsIds(){
		$store_id = $this->getMyStoreId();
		$this->db->distinct();
		$this->db->where('store_id',$store_id);
		$this->db->where("isDeleted",0);
		$this->db->select('patient_id');
		$pids = $this->db->get('hms_prescription');
		$pids = $pids->result_array();
		$ids = array();
		foreach($pids as $p){
			$ids[] = $p['patient_id'];
		}
		return $ids;
	}
    function addReceiptUrl($id,$urls,$paths,$types){
        for($i=0; $i<count($urls); $i++){
            $d['prescription_id'] = $id;
            $d['file_url'] = $urls[$i];
            $d['file_path'] = $paths[$i];
            $d['file_type'] = $types[$i];
            $this->db->insert('hms_prescription_order_receipt',$d);
			$id = $this->db->insert_id();
			$this->logger->log("Prescription order receipt added", Logger::MedicalStore, $id);
        }
        if(count($urls) > 0){
            $this->db->where('id',$id);
            $this->db->update('hms_prescription',array('order_status'=>1));
        }
    }
    function getMedicalReceiptFiles($id){
        $this->db->where('prescription_id',$id);
        $r = $this->db->get('hms_prescription_order_receipt');
        $r = $r->result_array();
        return $r;
    }
    function deleteMedicalReceiptFile($id){
        $this->db->where('id',$id);
        $d = $this->db->get('hms_prescription_order_receipt');
        $d = $d->row_array();
        $med_r_id = $d['prescription_id'];

        @unlink($d['file_path']);
        $this->db->query("delete from hms_prescription_order_receipt where id=$id");
		$this->logger->log("Prescription order receipt deletd", Logger::MedicalStore, $id);
		
        $this->db->where('prescription_id',$med_r_id);
        $c = $this->db->get('hms_prescription_order_receipt');
        if($c->num_rows() == 0){
            $this->db->where('id',$med_r_id);
            $this->db->update('hms_prescription',array('order_status'=>0));
        }
    }

    function getMedStoreIdsFromPatientId($id=0){
        $this->db->distinct();
        $this->db->select('store_id');
        if(is_array($id)){
            if(count($id) == 0){$id[] = -1;}
            $this->db->where_in('patient_id',$id);
        }else{
            $this->db->where('patient_id',$id);
        }
        $this->db->where('store_id > ',0);
        $this->db->where('isDeleted',0);
        $res = $this->db->get('hms_prescription')->result_array();
        $ids = array();
        foreach($res as $r){
            $ids[] = $r['store_id'];
        }
        return $ids;
    }
}
