<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Departments_model extends CI_Model {
    var $tblname = "hms_departments";
    function getAlldepartments() {
        $this->db->where("isDeleted", "0");
        if($this->auth->isHospitalAdmin()){
            $this->db->where_in('branch_id',$bids = $this->auth->getBranchIds());
        }
        $res = $this->db->get($this->tblname);
        if ($res->num_rows()) return $res->result_array();
        else return array();
    }
    function getdepartmentsById($id) {
        $r = $this->db->query("select * from " . $this->tblname . " where id=$id and isDeleted=0");
        $r = $r->row_array();
        $r['hospital_id'] = 0;
        $r['branch_name'] = "";
        if(isset($r['branch_id'])){
            $hid = $this->db->query("select * from hms_branches where id=$r[branch_id]");
            $hid = $hid->row_array();
            $r['hospital_id'] = $hid['hospital_id'];
            $r['branch_name'] = $hid['branch_name'];
        }
        return $r;
    }
    function search($q, $field,$hospital_id=-1,$branch_id=-1) {
        $field = explode(",", $field);

        $dids = array();
        if($this->auth->isDoctor() || $this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin() || $this->auth->isReceptinest()){
            $dids = $this->getDepartmentIds();        
        }
        

        $bids = array();
        if($hospital_id > 0){
            $bids = $this->auth->getBranchIds($hospital_id);
        }else{
             $bids = $this->auth->getBranchIds();
        }


        if($branch_id > 0){
            if(in_array($branch_id,$bids))
                $this->db->where('branch_id',$branch_id);
            else if($this->auth->isPatient())
                $this->db->where('branch_id',$branch_id);
            else
                $this->db->where('branch_id',-1);
        }else if($hospital_id > 0){
            $this->db->where_in('branch_id',$bids);
        }else{
            $hids = $this->auth->getAllHospitalIds();
            $bids = $this->auth->getBranchIds($hids);
            $this->db->where_in('branch_id',$bids);
        }

        if($this->auth->isDoctor() || $this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin() || $this->auth->isReceptinest()){
            $this->db->where_in("id",$dids);
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
        //echo "<pre>";
        //var_dump($data);
        //exit();
        unset($data["eidt_gf_id"]);
        unset($data['selected_hid']);
        unset($data['selected_bid']);
        $data["created_at"] = date("Y-m-d H:i:s");
        if ($this->db->insert($this->tblname, $data)) {
			$id = $this->db->insert_id();
			$this->logger->log("New department: ".$data['department_name']." created", Logger::Department, $id);
			
            if($this->auth->isSuperAdmin()) {
                //find branch name
                $this->db->where('id', $data['branch_id']);
                $branch = $this->db->get('hms_branches')->row_array();
                //find hospital admin
                $this->db->where('hospital_id', $branch['hospital_id']);
                $hadmin = $this->db->get('hms_hospital_admin')->row_array();
                //sent notification to hospital admin
                $this->notification->saveNotification($hadmin['user_id'], "New department <b>".$data['department_name']."</b> is added in <b>" . $branch['branch_name'] . "</b> branch");
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
        unset($data['selected_bid']);
        $this->db->where("id", $id);
        if ($this->db->update($this->tblname, $data)) {
			$this->logger->log("Department: ".$data['department_name']." updated", Logger::Department, $id);
			
            if($this->auth->isSuperAdmin()) {
                //find branch name
                $this->db->where('id', $data['branch_id']);
                $branch = $this->db->get('hms_branches')->row_array();
                //find hospital admin
                $this->db->where('hospital_id', $branch['hospital_id']);
                $hadmin = $this->db->get('hms_hospital_admin')->row_array();
                //sent notification to hospital admin
                $this->notification->saveNotification($hadmin['user_id'], "Department <b>" . $data['department_name'] . "</b> information is updated in <b>" . $branch['branch_name'] . "</b> branch");
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
			if(is_array($id)){
				foreach($id as $i){
					$this->logger->log("Department soft deleted", Logger::Department, $i);
				}
			}else{
				$this->logger->log("Department soft deleted", Logger::Department, $id);
			}
            return true;
        } else return false;
    }

    function getDepartmentIdsFromHospital($hospital_id=0){
        $res = array();
        if(is_array($hospital_id)){
            if(count($hospital_id) > 0){
                $hospital_id = implode(",",$hospital_id);
                $res = $this->db->query("select d.id from hms_branches b,hms_departments d where b.hospital_id in ($hospital_id) and b.id=d.branch_id and d.isDeleted=0");
                if($res)
					$res = $res->result_array();
            }
        }else{
			if($hospital_id=="" && $hospital_id!="undefined"){ $hospital_id = -1;}
            $res = $this->db->query("select d.id from hms_branches b,hms_departments d where b.hospital_id=$hospital_id and b.id=d.branch_id and d.isDeleted=0");
            if($res)
				$res = $res->result_array();
        }
        $ids = array();
		if($res){
			foreach ($res as $key => $value) {
				$ids[] = $value['id'];
			}
		}
        return $ids;
    }

    function getDepartmentIdsFromBranch($branch_id=0){
        $res = array();
        if(is_array($branch_id)){
            if(count($branch_id) > 0){
                $branch_id = implode(",",$branch_id);
                $res = $this->db->query("select d.id from hms_departments d where d.branch_id in ($branch_id) and d.isDeleted=0");
                $res = $res->result_array();
            }
        }else{
            $res = $this->db->query("select d.id from hms_departments d where d.branch_id='$branch_id' and d.isDeleted=0");
            $res = $res->result_array();
        }
        $ids = array();
        foreach ($res as $key => $value) {
            $ids[] = $value['id'];
        }
        return $ids;
    }

    function getBranch($department_id=0){
        $this->db->where('id',$department_id);
        $this->db->where('isActive',1);
        $this->db->where('isDeleted',0);
        $res = $this->db->get($this->tblname);
        $res = $res->row_array();
        $bid = -1;
        if(isset($res['branch_id']))
            $bid = $res['branch_id'];
        $this->db->where('id',$bid);
        $this->db->where('isActive',1);
        $this->db->where('isDeleted',0);
        $branch = $this->db->get("hms_branches");
        $branch = $branch->row_array();
        return $branch;
    }

    function getDepartmentIds(){
        $qry = "";
        if($this->auth->isSuperAdmin()){
            $qry = "select id from $this->tblname where isDeleted=0";
        }else if($this->auth->isHospitalAdmin()){
            $uid = $this->auth->getUserid();
            $qry = "select d.id as id from hms_hospital_admin a,hms_branches b,hms_departments d where a.user_id=$uid and a.isDeleted=0 and a.hospital_id=b.hospital_id and b.id = d.branch_id";            
        }else if($this->auth->isReceptinest()){
            $uid = $this->auth->getUserid();
            $qry = "select DISTINCT d.department_id as id from hms_receptionist r,hms_doctors d where r.user_id=$uid and r.isDeleted=0 and r.doc_id=d.id";
        }else if($this->auth->isDoctor()){
            $uid = $this->auth->getDoctorId();
            $qry = "select DISTINCT d.department_id as id from  hms_doctors d where d.isDeleted=0 and d.id=$uid ";
        }else if($this->auth->isNurse()){
            $uid = $this->auth->getUserid();
            $qry = 'select DISTINCT department_id as id from `hms_nurse`  where isDeleted = 0 and isActive = 1 and user_id='.$uid;
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
