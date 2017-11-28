<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Charges_model extends CI_Model {
    var $tblname = "hms_charges";
    function getAllcharges() {
        $this->db->where("isDeleted", "0");
        $res = $this->db->get($this->tblname);
        if ($res->num_rows()) return $res->result_array();
        else return array();
    }

    function getchargesById($id) {
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
        if (isset($data["charge"])) $data["charge"] = floatval($data["charge"]);
        $data["created_at"] = date("Y-m-d H:i:s");
        //$data['hospital_id'] = $this->auth->getHospitalId();
        if ($this->db->insert($this->tblname, $data)) {
			$id = $this->db->insert_id();
			$this->logger->log("New charge created", Logger::Charge, $id);
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
        if (isset($data["charge"])) $data["charge"] = floatval($data["charge"]);
        $this->db->where("id", $id);
        if ($this->db->update($this->tblname, $data)) {
			$this->logger->log("Charge updated", Logger::Charge, $id);
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
					$this->logger->log("Charge soft deleted", Logger::Charge, $i);
				}
			}else{
				$this->logger->log("Charge soft deleted", Logger::Charge, $id);
			}
			return true;
        } else return false;
    }
}
