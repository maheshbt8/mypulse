<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Beds_model extends CI_Model {
    var $tblname = "hms_beds";
    function getAllbeds() {
        $this->db->where("isDeleted", "0");
        if($this->auth->isHospitalAdmin()){
            $ward_ids = $this->auth->getAllWardsIds();
            $this->db->where_in("ward_id",$ward_ids);
        }
        $res = $this->db->get($this->tblname);
        if ($res->num_rows()) return $res->result_array();
        else return array();
    }
    function getbedsById($id) {
        $qry = "select * from " . $this->tblname . " where id=$id and isDeleted=0";
        $r = $this->db->query($qry);
        return $r->row_array();
    }
    function search($q, $field) {
        $field = explode(",", $field);
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
        unset($data["eidt_gf_id"]);
        unset($data['selected_hid']);
        unset($data['selected_bid']);
        unset($data['selected_did']);
        if (isset($data["isActive"])) $data["isActive"] = intval($data["isActive"]);
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
}
