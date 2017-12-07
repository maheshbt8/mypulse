<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Hospitals_model extends CI_Model {
    var $tblname = "hms_hospitals";
    function getAllhospitals() {
        $this->db->where("isDeleted", "0");
        $res = $this->db->get($this->tblname);
        if ($res->num_rows()) return $res->result_array();
        else return array();
    }

    function gethospitalsById($id) {
        if($id == "")
            $id = 0;
        $r = $this->db->query("select * from " . $this->tblname . " where id=$id and isDeleted=0");
        $r = $r->row_array();
        if(isset($r['license_category'])){
            $this->db->where('license_code',$r['license_category']);
            $l = $this->db->get('hms_license');
            $l = $l->row_array();
            $r['license'] = $l;
        }else{
            $r['license']['name'] = "Not Found";
        }
        $c_name = "";
        if(isset($r['country'])){
            $c_name = $this->auth->getCountryName($r['country']);
        }
        $r['country_name'] = $c_name;
        $this->load->model('hospital_admin_model');
        $r['hospital_admin'] = $this->hospital_admin_model->getHAFromHospital($r['id']);

        //echo "<pre>";var_dump($r['country_name']);exit;
        return $r;
    }

    function getHospitalLogo($hid=0){
        
        $this->db->select('logo');
        $this->db->where('id',$hid);
        $this->db->where('isDeleted',0);
        $h = $this->db->get($this->tblname);
        if($h){
            $h = $h->row_array();
            if(isset($h['logo']) && $h['logo'] != "" && $h['logo'] != null){
                return $h['logo'];
            }
        }
        return base_url()."public/assets/images/logo.png";
    }

    function checkSlug($slug){
        $slug = str_replace('http://www.mypulse.com/','',$slug);
        $this->db->where('slug',$slug);
        $slug = $this->db->get($this->tblname);
        if($slug->num_rows() == 0){
            return false;
        }
        return true;
    }

    function search($q, $field) {
        $field = explode(",", $field);
        
        if($this->auth->isHospitalAdmin()){
            $hid = $this->auth->getHospitalId();
            $this->db->where('id',$hid);
        }else if($this->auth->isReceptinest()){
            $hids = $this->getHospicalIds();
            $this->db->where_in('id',$hids);
        }else if($this->auth->isNurse()){
            $hids = $this->getHospicalIds();
            $this->db->where_in('id',$hids);
        }else if($this->auth->isDoctor()){
            $hids = $this->getHospicalIds();
            $this->db->where_in('id',$hids);
        }

        foreach ($field as $f) {
            $this->db->like($f, $q);
        }
        
        $select = implode('`," ",`', $field);
        $this->db->where("isDeleted",0);
        //if(!$this->auth->isSuperAdmin()){   
            $this->db->where('license_status',1);
            $this->db->where('isActive',1);
        //}
        $this->db->select("id,CONCAT(`$select`) as text", false);
        $res = $this->db->get($this->tblname);
        if($res)
            return $res->result_array();
        else
            return array();
    }

    function add() {
        $data = $_POST;
        //echo "<pre>";var_dump($data);exit;
        unset($data["eidt_gf_id"]);
        if (isset($data["license_status"])) $data["license_status"] = intval($data["license_status"]);
        if (isset($data["isActive"])) $data["isActive"] = intval($data["isActive"]);

        if(isset($_POST['slug'])){
            $slug = str_replace('http://www.mypulse.com/','',$_POST['slug']);
            $_POST['slug'] = $slug;
        }

        if(isset($_POST['hospital_id']) && $_POST['hospital_id'] != -1){

        }else{
            unset($data['hospital_id']);
        }
        unset($data['ha_name']);

        $data["created_at"] = date("Y-m-d H:i:s");
        if ($this->db->insert($this->tblname, $data)) {
			$hid = $this->db->insert_id();
			$this->logger->log("New hospital created",Logger::Hospital,$hid);
			return true;
        } else {
            return false;
        }
    }

    function update($id) {
        $data = $_POST;
        
        unset($data["eidt_gf_id"]);

        if(isset($_FILES["logo"]) && $_FILES['logo']['error'] == 0){
            $n = time()."_".$id.".png";
            $url = base_url().'public/images/hl/'.$n;
            $path = dirname(BASEPATH)."/public/images/hl/".$n;
            move_uploaded_file($_FILES["logo"]['tmp_name'],$path);
            $data['logo'] = $url;
        }

        if(isset($_POST['slug']) && $_POST['slug'] != ""){
            $slug = str_replace('http://www.mypulse.com/','',$_POST['slug']);
            $_POST['slug'] = $slug;
        }
        
        if (isset($data["license_status"])) $data["license_status"] = intval($data["license_status"]);
        if (isset($data["isActive"])) $data["isActive"] = intval($data["isActive"]);
       
        //Update hospital admin 
        unset($data['hospital_id']);
    
        $this->db->where("id", $id);
        if ($this->db->update($this->tblname, $data)) {
			$this->logger->log("Hospital details updated", Logger::Hospital, $id);
            return true;
        } else {
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
			$this->logger->log("Hospital soft deleted", Logger::Hospital, $id);
            return true;
        } else return false;
    }
    
    function getLogoFromSlug($slug){
        $this->db->where('slug',$slug);
        $s = $this->db->get($this->tblname)->row_array();
        if(isset($s['logo']) && $s['logo'] != null && $s['logo'] !=""){
            return $s['logo'];
        }
        return "";
    }

    function getHospicalIds(){
        $qry = "";
        if($this->auth->isSuperAdmin()){
            $qry = "select id from $this->tblname where isDeleted=0 and isActive=1";
        }else if($this->auth->isHospitalAdmin()){
            $uid = $this->auth->getUserid();
            $qry = "select ha.hospital_id as id from hms_hospital_admin ha, hms_hospitals h where ha.user_id=$uid and ha.isDeleted=0 and h.isActive=1";            
        }else if($this->auth->isReceptinest()){
            $uid = $this->auth->getUserid();
            $qry = "select b.hospital_id as id from hms_receptionist r,hms_doctors d,hms_departments m,hms_branches b,hms_hospitals h where r.user_id=$uid and r.isDeleted=0 and r.doc_id=d.id and d.department_id=m.id and m.branch_id=b.id and b.hospital_id=h.id and h.isActive=1";
        }else if($this->auth->isNurse()){
            $uid = $this->auth->getUserid();
            $qry = "select b.hospital_id as id from  hms_nurse d,hms_departments m,hms_branches b,hms_hospitals h where d.isDeleted=0 and d.user_id=$uid and d.department_id=m.id and m.branch_id=b.id and b.hospital_id=h.id and h.isActive=1";
        }else if($this->auth->isDoctor()){
            $uid = $this->auth->getDoctorId();
            $qry = "select b.hospital_id as id from  hms_doctors d,hms_departments m,hms_branches b,hms_hospitals h where d.isDeleted=0 and d.id=$uid and d.department_id=m.id and m.branch_id=b.id and b.hospital_id=h.id and h.isActive=1";
        }else if($this->auth->isPatient()){
            $uid = $this->auth->getUserId();
            $docs = $this->db->query("SELECT DISTINCT doctor_id as did FROM `hms_prescription` where patient_id=$uid and isDeleted=0")->result_array();
            $doc_ids = array();
            foreach($docs as $doc){
                $doc_ids[] = $doc['did'];
            }
            if(count($doc_ids) == 0) { $doc_ids[] = -1;}
            $str_dids = implode(",",$doc_ids);
            $qry = "select b.hospital_id as id from  hms_doctors d,hms_departments m,hms_branches b,hms_hospitals h where d.isDeleted=0 and d.id in (".$str_dids.") and d.department_id=m.id and m.branch_id=b.id and b.hospital_id=h.id and h.isActive=1";
        }
        else{
            $qry = "select * from $this->tblname where id=-1";
        }
        $res = $this->db->query($qry);
        $res = $res->result_array();
        $ids = array();
        foreach($res as $r){
            $ids[] = $r['id'];
        }
        return $ids;
    }
}
