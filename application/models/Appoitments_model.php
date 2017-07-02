<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Appoitments_model extends CI_Model {
    var $tblname = "hms_appoitments";
    function getAllappoitments() {
        $this->db->where("isDeleted", "0");
        $res = $this->db->get($this->tblname);
        if ($res->num_rows()) return $res->result_array();
        else return array();
    }
    function getappoitmentsById($id) {
        $r = $this->db->query("select * from " . $this->tblname . " where id=$id and isDeleted=0");
        $r =  $r->row_array();

        if(isset($r['department_id'])){
            $this->db->where('id',$r['department_id']);
            $this->db->where('isActive',1);
            $this->db->where("isDeleted",0);
            $department = $this->db->get('hms_departments');
            $department =$department->row_array();
            $r['branch_id'] = $department['branch_id'];

            $this->db->where('id',$r['branch_id']);
            $this->db->where('isActive',1);
            $this->db->where("isDeleted",0);
            $branch = $this->db->get('hms_branches');
            $branch =$branch->row_array();
            $r['hospital_id'] = $branch['hospital_id'];
        }else{
            $r['department_id'] = 0;
            $r['branch_id'] = 0;
            $r['hospital_id'] = 0;
        } 

        return $r;
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
        if (isset($data["appoitment_date"])) $data["appoitment_date"] = date("Y-m-d H:i:s", strtotime($data["appoitment_date"]));
        if (isset($data["status"])) $data["status"] = intval($data["status"]);
        $data['user_id'] = $this->auth->getUserid();
        if ($this->db->insert($this->tblname, $data)) {
            $id = $this->db->insert_id();
            $this->db->where('id',$id);
            $this->db->update($this->tblname,array('appoitment_number'=> 'APT'.$id));
            return true;
        } else {
            return false;
        }
    }
    function update($id) {
        $data = $_POST;
        unset($data["eidt_gf_id"]);
        if (isset($data["appoitment_date"])) $data["appoitment_date"] = date("Y-m-d H:i:s", $data["appoitment_date"]);
        if (isset($data["status"])) $data["status"] = intval($data["status"]);
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
    function cancel($id){
        return $this->updateStatus($id,4);
    }

    function approve($id){
        return $this->updateStatus($id,1);
    }

    function updateStatus($id,$status=0){
        $d["status"] = intval($status);
        if(is_array($id)){
            $this->db->where_in('id',$id);
        }else{
            $this->db->where("id", $id);
        }
        if ($this->db->update($this->tblname, $d)) {
            return true;
        } else return false;
    }
}
