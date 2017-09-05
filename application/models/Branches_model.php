<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Branches_model extends CI_Model {
    var $tblname = "hms_branches";
    function getAllbranches() {
        $this->db->where("isDeleted", "0");
        if($this->auth->isHospitalAdmin()){
            $this->db->where('hospital_id',$this->auth->getHospitalId());
        }
        $res = $this->db->get($this->tblname);
        if ($res->num_rows()) return $res->result_array();
        else return array();
    }
    function getbranchesById($id) {
        $r = $this->db->query("select * from " . $this->tblname . " where id=$id and isDeleted=0");
        $r = $r->row_array();

        if(isset($r['hospital_id'])){
            $this->db->where('id',$r['hospital_id']);
            $this->db->where('isDeleted',0);
            $this->db->where('isActive',1);
            $hos = $this->db->get("hms_hospitals");
            $hos = $hos->row_array();
            $r['hospital'] = $hos;
        }

        return $r;
    }
    function search($q, $field,$hospital_id=-1) {
        $field = explode(",", $field);

        if($this->auth->isDoctor() || $this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin() || $this->auth->isReceptinest()){
            $bids = $this->getBranchesIds();
            $this->db->where_in("id",$bids);
        }

        if($hospital_id > 0){
            $this->db->where('hospital_id',$hospital_id);
        }else{
            $hids = $this->auth->getAllHospitalIds();
            if(count($hids) == 0){ $hids[] = -1;} 
            $this->db->where_in('hospital_id',$hids);
        }

        foreach ($field as $f) {
            if($q!="")
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

        unset($data["eidt_gf_id"]);
        unset($data['selected_hid']);
        if (isset($data["isActive"])) $data["isActive"] = intval($data["isActive"]);
        $data["created_at"] = date("Y-m-d H:i:s");
        if ($this->db->insert($this->tblname, $data)) {
            if($this->auth->isSuperAdmin()) {
                //find hospital admin
                $this->db->where('hospital_id', $data['hospital_id']);
                $hadmin = $this->db->get('hms_hospital_admin')->row_array();
                //sent notification to hospital admin
                $this->notification->saveNotification($hadmin['user_id'], "New branch <b>".$data['branch_name']."</b> is added");
            }
            return true;
        } else {
            return false;
        }
    }
    function update($id) {
        $data = $_POST;

        unset($data["eidt_gf_id"]);
        unset($data['selected_hid']);
        if (isset($data["isActive"])) $data["isActive"] = intval($data["isActive"]);
        
        $this->db->where("id", $id);
        if ($this->db->update($this->tblname, $data)) {
            if($this->auth->isSuperAdmin()) {
                //find hospital admin
                $this->db->where('hospital_id', $data['hospital_id']);
                $hadmin = $this->db->get('hms_hospital_admin')->row_array();
                //sent notification to hospital admin
                $this->notification->saveNotification($hadmin['user_id'], "Branch <b>" . $data['branch_name'] . "</b> information is updated");
            }
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
            return true;
        } else return false;
    }

    function getBracheIds($hospital_id = 0){
        if(is_array($hospital_id)){
            if(count($hospital_id) == 0) { $hospital_id[] = -1;}
            $this->db->where_in('hospital_id',$hospital_id);
        }
        else
            $this->db->where('hospital_id',$hospital_id);
        $this->db->where('isActive',1);
        $this->db->where('isDeleted',0);
        $res = $this->db->get($this->tblname);
        $res = $res->result_array();
        $ids = array();
        foreach ($res as $key => $value) {
            $ids[] = $value['id'];
        }
        return $ids;
    }
     
    function getBranchesIds($hid=null){
        $qry = "";
        if($this->auth->isSuperAdmin()){
            $qry = "select id from $this->tblname where isDeleted=0";
        }else if($this->auth->isHospitalAdmin()){
            $uid = $this->auth->getUserid();
            $qry = "select b.id as id from hms_hospital_admin a,hms_branches b where a.user_id=$uid and a.isDeleted=0 and a.hospital_id=b.hospital_id";            
        }else if($this->auth->isReceptinest()){
            $uid = $this->auth->getUserid();
            $qry = "select DISTINCT m.branch_id as id from hms_receptionist r,hms_doctors d,hms_departments m where r.user_id=$uid and r.isDeleted=0 and r.doc_id=d.id and d.department_id=m.id";
        }else if($this->auth->isDoctor()){
            $uid = $this->auth->getDoctorId();
            $qry = "select DISTINCT m.branch_id as id from  hms_doctors d,hms_departments m where d.isDeleted=0 and d.id=$uid and d.department_id=m.id";
        }
        else{
            $qry = "select * from $this->tblname ";
        }
        $res = $this->db->query($qry);
        $res = $res->result_array();
        $ids = array();
        foreach($res as $r){
            $ids[] = $r['id'];
        }
        
        if($hid!==null && $hid > 0){
            if(is_array($hid)){
                 if(count($hid) == 0) { $hid[] = -1;}
                $this->db->where_in("hospital_id",$hid);    
            }else{
                $this->db->where('hospital_id',$hid);
            }
            $this->db->where_in('id',$ids);
            $res = $this->db->get($this->tblname); 
            $res = $res->result_array();
            $ids = array();
            foreach($res as $r){
                $ids[] = $r['id'];
            }
        }
        return $ids;
    }
}
