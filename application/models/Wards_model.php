<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Wards_model extends CI_Model {
    var $tblname = "hms_wards";
    function getAllwards() {
        $this->db->where("isDeleted", "0");
        $res = $this->db->get($this->tblname);
        if ($res->num_rows()) return $res->result_array();
        else return array();
    }
    function getwardsById($id) {
        $r = $this->db->query("select * from " . $this->tblname . " where id=$id and isDeleted=0");
        $r = $r->row_array();
        $did = array();
        if(isset($r['department_id'])){
            $did = $this->db->query("select d.department_name,d.branch_id,b.branch_name,b.hospital_id from hms_departments d,hms_branches b where d.id=$r[department_id] and d.branch_id=b.id");
            $did = $did->row_array();
        }

        $r['department_name'] = isset($did['department_name']) ? $did['department_name'] : "";
        $r['branch_id'] = isset($did['branch_id']) ? $did['branch_id'] : "";
        $r['branch_name'] = isset($did['branch_name']) ? $did['branch_name'] : "";
        $r['hospital_id'] = isset($did['hospital_id']) ? $did['hospital_id'] : "";
        

        return $r;
    }
    function search($q, $field, $did=0) {
        $field = explode(",", $field);
        foreach ($field as $f) {
            $this->db->like($f, $q);
        }
        if($did > 0){
            $this->db->where("department_id",$did);
        }
        $select = implode('`," ",`', $field);
        $this->db->select("id,CONCAT(`$select`) as text", false);
        $res = $this->db->get($this->tblname);
        return $res->result_array();
    }
    function add() {
        $data = $_POST;
        unset($data["eidt_gf_id"]);
        unset($data['selected_hid']);
        unset($data['selected_bid']);
        unset($data['selected_did']);
        if (isset($data["isActive"])) $data["isActive"] = intval($data["isActive"]);
        if ($this->db->insert($this->tblname, $data)) {
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
        unset($data['selected_did']);
        if (isset($data["isActive"])) $data["isActive"] = intval($data["isActive"]);
        $this->db->where("id", $id);
        if ($this->db->update($this->tblname, $data)) {
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

    function getWardIdsFromHospital($hospital_id=0){
        $res = array();
        if(is_array($hospital_id)){
            if(count($hospital_id) > 0){
                $hospital_id = implode(",",$hospital_id);
                $res = $this->db->query("select w.id from hms_branches b,hms_departments d,hms_wards w where b.hospital_id in ($hospital_id) and b.id=d.branch_id and d.id=w.department_id and d.isDeleted=0");
                $res = $res->result_array();
            }
        }else{
            $res = $this->db->query("select w.id from hms_branches b,hms_departments d,hms_wards w where b.hospital_id=$hospital_id and b.id=d.branch_id and d.id=w.department_id and d.isDeleted=0");
            $res = $res->result_array();
        }
        $ids = array();
        foreach ($res as $key => $value) {
            $ids[] = $value['id'];
        }
        return $ids;
    }

    function getWardIdsFromBranch($branch_id=0){
        $res = array();
        if(is_array($branch_id)){
            if(count($branch_id) > 0){
                $branch_id = implode(",",$branch_id);
                $res = $this->db->query("select w.id from hms_departments d,hms_wards w where d.branch_id in ($branch_id) and d.id=w.department_id and d.isDeleted=0");    
                $res = $res->result_array();
            }
        }else{
            $res = $this->db->query("select w.id from hms_departments d,hms_wards w where d.branch_id=$branch_id and d.id=w.department_id and d.isDeleted=0");
            $res = $res->result_array();
        }        
        $ids = array();
        foreach ($res as $key => $value) {
            $ids[] = $value['id'];
        }
        return $ids;
    }

    function getWardIdsFromDepartment($department_id=0){
        $res = array();
        if(is_array($department_id)){
            if(count($department_id) > 0){
                $department_id = implode(",",$department_id);
                $res = $this->db->query("select w.id from hms_wards w where w.department_id in ($department_id) and d.isDeleted=0");
                $res = $res->result_array();
            }
        }else{
            $department_id = intval($department_id);
            $res = $this->db->query("select w.id from hms_wards w where w.department_id=$department_id and w.isDeleted=0");
            $res = $res->result_array();
        }
        $ids = array();
        foreach ($res as $key => $value) {
            $ids[] = $value['id'];
        }
        return $ids;
    }
}
