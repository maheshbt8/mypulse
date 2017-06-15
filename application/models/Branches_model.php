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

        foreach ($field as $f) {
            if($q!="")
                $this->db->like($f, $q);
        }

        if($hospital_id > 0){
            $this->db->where('hospital_id',$hospital_id);
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
        if(is_array($hospital_id))
            $this->db->where_in('hospital_id',$hospital_id);
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
}
