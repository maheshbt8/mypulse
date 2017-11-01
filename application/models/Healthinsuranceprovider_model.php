<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Healthinsuranceprovider_model extends CI_Model {
    var $tblname = "hms_healthinsuranceprovider";
    function getAllhealthinsuranceprovider() {
        $this->db->where("isDeleted", "0");
        $res = $this->db->get($this->tblname);
        if ($res->num_rows()) return $res->result_array();
        else return array();
    }
    function gethealthinsuranceproviderById($id) {
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
        if ($this->db->insert($this->tblname, $data)) {
			$id = $this->db->insert_id();
			$this->logger->log("HealthInsuranceProvider added", Logger::HealthInsuranceProvider, $id);
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
			$this->logger->log("HealthInsuranceProvider updated", Logger::HealthInsuranceProvider, $id);
            return true;
        } else {
            return false;
        }
    }
    function delete($id) {
        $this->db->where("id", $id);
        $d["isDeleted"] = 1;
        if ($this->db->update($this->tblname, $d)) {
			$this->logger->log("HealthInsuranceProvider soft deleted", Logger::HealthInsuranceProvider, $id);
            return true;
        } else return false;
    }
}
