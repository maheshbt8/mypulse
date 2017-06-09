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
        return $r->row_array();
    }
    function search($q, $field,$branch_id=-1) {
        $field = explode(",", $field);
        foreach ($field as $f) {
            if($q!="")
                $this->db->like($f, $q);
        }

        if($branch_id > 0){
            $this->db->where('branch_id',$branch_id);
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
        $data["created_at"] = date("Y-m-d H:i:s");
        if ($this->db->insert($this->tblname, $data)) {
            return true;
        } else {
            return false;
        }
    }
    function update($id) {
        $data = $_POST;
        unset($data["eidt_gf_id"]);
        
        $this->db->where("id", $id);
        if ($this->db->update($this->tblname, $data)) {
            return true;
        } else {
            return false;
        }
    }
    function delete($id) {
        $this->db->where("id", $id);
        $d["isDeleted"] = 1;
        if ($this->db->update($this->tblname, $d)) {
            return true;
        } else return false;
    }

    function getDepartmentIdsFromHospital($hospital_id=0){
        $res = $this->db->query("select d.id from hms_branches b,hms_departments d where b.hospital_id=$hospital_id and b.id=d.branch_id and d.isDeleted=0");
        $res = $res->result_array();
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

        $this->db->where('id',$res['branch_id']);
        $this->db->where('isActive',1);
        $this->db->where('isDeleted',0);
        $branch = $this->db->get("hms_branches");
        $branch = $branch->row_array();
        return $branch;
    }
}
