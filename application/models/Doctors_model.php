<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Doctors_model extends CI_Model {
    var $tblname = "hms_doctors";
    function getAlldoctors() {
        $this->db->where("isDeleted", "0");
        $res = $this->db->get($this->tblname);
        if ($res->num_rows()) return $res->result_array();
        else return array();
    }
    function getdoctorsById($id) {
        $r = $this->db->query("select * from " . $this->tblname . " where id=$id and isDeleted=0");
        $r = $r->row_array();
        $this->db->where('id',$r['user_id']);
        $data = $this->db->get('hms_users');
        $data = $data->row_array();
        foreach ($data as $key => $value) {
            $r[$key] = $value;
        }
        
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
        }

        return $r;
    }
    function search($q, $field) {

        if($this->auth->isHospitalAdmin()){
            $bids = $this->auth->getBranchIds();
            $this->db->where_in("hms_doctors.branch_id",$bids);
        }

        $this->db->like("hms_users.first_name",$q);
        $this->db->like("hms_users.last_name",$q);
        $this->db->where("hms_users.role",$this->auth->getDoctorRoleType());
        $this->db->select("hms_doctors.id,CONCAT(`first_name`,`last_name`) as text", false);
        $this->db->from($this->tblname);

        $this->db->join("hms_users","hms_doctors.user_id=hms_users.id");
        
        
        $res = $this->db->get();
        return $res->result_array();
    }
    function add() {
        $data = $_POST;
        $data['role'] = $this->auth->getDoctorRoleType();
        $doc_id = $this->auth->addUser($data);
        
        if($doc_id === false){
            return false;
        }else if($doc_id == -1){
            return -1;
        }
        else{
            $doc = array();
            $doc['user_id'] = $doc_id;
            $doc['branch_id'] = $data['branch_id'];
            $doc['created_at'] = date("Y-m-d H:i:s");
            if ($this->db->insert($this->tblname, $doc)) {
                return true;
            } else {
                return false;
            }
        }
    }
    function update($id) {
        $data = $_POST;

        $this->db->where("id", $id);
        $doc = $this->db->get($this->tblname);
        $doc = $doc->row_array();

        $doc_id = isset($doc["user_id"]) ? $doc['user_id'] : 0;
        $doc_id = $this->auth->addUser($data,$doc_id);

        if($doc_id === false){
            return false;
        }else if($doc_id === -1){
            return -1;
        }
        else{
            $doc = array();
            if(isset($data['branch_id']))
                $doc['branch_id'] = $data['branch_id'];
            if(isset($data['isActive']))
                $doc['isActive'] = intval($data['isActive']);
            
            $this->db->where("id", $id);
            if ($this->db->update($this->tblname, $doc)) {
                return true;
            } else {
                return false;
            }
        }

    }
    function delete($id) {
        $this->db->where("id", $id);
        $d["isDeleted"] = 1;
        if ($this->db->update($this->tblname, $d)) {
            return true;
        } else return false;
    }

    function getDoctorsIdsByHospital(){
        $bids = $this->auth->getBranchIds();
        $this->db->where_in("branch_id",$bids);
        $this->db->where("isDeleted",0);
        $this->db->where("isActive",1);

        $res = $this->db->get($this->tblname);
        $ids = array();
        foreach ($res as $key => $value) {
            $ids[] = $value['id'];
        }
        return $ids;
    }
}
