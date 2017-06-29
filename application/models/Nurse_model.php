<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Nurse_model extends CI_Model {
    var $tblname = "hms_nurse";
    function getAllnurse() {
        $this->db->where("isDeleted", "0");
        $res = $this->db->get($this->tblname);
        if ($res->num_rows()) return $res->result_array();
        else return array();
    }
    function getnurseById($id) {
        if($id=="")
            $id = 0;
        $r = $this->db->query("select * from " . $this->tblname . " where id=$id and isDeleted=0");
        $r = $r->row_array();
        $this->db->where('id',$r['user_id']);
        $data = $this->db->get('hms_users');
        $data = $data->row_array();
        if(is_array($data)){
            foreach ($data as $key => $value) {
                $r[$key] = $value;
            }
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
        }else{
            $r['department_id'] = 0;
            $r['branch_id'] = 0;
            $r['hospital_id'] = 0;
        }

        return $r;
    }
    function search($q, $field) {

        if($this->auth->isHospitalAdmin()){
            $ids = $this->auth->getAllDepartmentsIds();
            $this->db->where_in("hms_nurse.department_id",$bids);
        }

        $this->db->like("hms_users.first_name",$q);
        $this->db->like("hms_users.last_name",$q);
        $this->db->where("hms_users.isDeleted",0);
        $this->db->where("hms_users.role",$this->auth->getNurseRoleType());
        $this->db->select("hms_nurse.id,CONCAT(`first_name`,`last_name`) as text", false);
        $this->db->where("hms_nurse.isDeleted",0);
        $this->db->from($this->tblname);
        $this->db->join("hms_users","hms_nurse.user_id=hms_users.id");
               
        $res = $this->db->get();
        return $res->result_array();
    }
    function add() {
        $data = $_POST;
        $data['role'] = $this->auth->getNurseRoleType();
        $nid = $this->auth->addUser($data);
        
        if($nid === false){
            return false;
        }else if($nid < 0){
            return $nid;
        }else{
            $nurse['user_id'] = $nid;
            $nurse['department_id'] = isset($data['department_id']) ? $data['department_id'] : -1;
            $nurse['created_at'] = date("Y-m-d H:i:s");
            if ($this->db->insert($this->tblname, $nurse)) {
                return true;
            } else {
                return false;
            }
            
        }
        return true;
    }
    function update($id) {
        $data = $_POST;

        $this->db->where("id", $id);
        $nus = $this->db->get($this->tblname);
        $nus = $nus->row_array();

        $nid = isset($nus["user_id"]) ? $nus['user_id'] : 0;
        $nid = $this->auth->addUser($data,$nid);

        if($nid === false){
            return false;
        }else if($nid < 0){
            return $nid;
        }
        else{
            $nus = array();
            if(isset($data['department_id']))
                $nus['department_id'] = $data['department_id'];
            if(isset($data['isActive']))
                $nus['isActive'] = intval($data['isActive']);
            if(count($nus) > 0){
                $this->db->where("id", $id);
                if ($this->db->update($this->tblname, $nus)) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        return true;
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
