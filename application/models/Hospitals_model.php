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
        $r = $this->db->query("select * from " . $this->tblname . " where id=$id and isDeleted=0");
        return $r->row_array();
    }
    function search($q, $field) {
        $field = explode(",", $field);
        foreach ($field as $f) {
            $this->db->like($f, $q);
        }
        $select = implode('`," ",`', $field);
        $this->db->select("id,CONCAT(`$select`) as text", false);
        $res = $this->db->get($this->tblname);
        return $res->result_array();
    }
    function add() {
        $data = $_POST;
        unset($data["eidt_gf_id"]);
        if (isset($data["license_category"])) $data["license_category"] = intval($data["license_category"]);
        if (isset($data["license_status"])) $data["license_status"] = intval($data["license_status"]);
        if (isset($data["isActive"])) $data["isActive"] = intval($data["isActive"]);
        if (isset($data["created_date"])) $data["created_date"] = date("Y-m-d H:i:s", strtotime($data["created_date"]));
        if ($this->db->insert($this->tblname, $data)) {
            return true;
        } else {
            return false;
        }
    }
    function update($id) {
        $data = $_POST;
        unset($data["eidt_gf_id"]);
        if (isset($data["license_category"])) $data["license_category"] = intval($data["license_category"]);
        if (isset($data["license_status"])) $data["license_status"] = intval($data["license_status"]);
        if (isset($data["isActive"])) $data["isActive"] = intval($data["isActive"]);
        if (isset($data["created_date"])) $data["created_date"] = date("Y-m-d H:i:s", $data["created_date"]);
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
}
