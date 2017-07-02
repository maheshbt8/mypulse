<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Receptionist_model extends CI_Model {
    var $tblname = "hms_receptionist";
    function getAllreceptionist() {
        $this->db->where("isDeleted", "0");
        $res = $this->db->get($this->tblname);
        if ($res->num_rows()) return $res->result_array();
        else return array();
    }
    function getreceptionistById($id) {
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

        if(isset($r['doc_id'])){
            $this->db->where('id',$r['doc_id']);
            $this->db->where('isActive',1);
            $this->db->where("isDeleted",0);
            $doctor = $this->db->get('hms_doctors');
            $doctor =$doctor->row_array();
            $r['department_id'] = $doctor['department_id'];

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
            $r['doc_id'] = 0;
            $r['department_id'] = 0;
            $r['branch_id'] = 0;
            $r['hospital_id'] = 0;
        }

        return $r;
    }
    function search($q, $field) {
        
        if($this->auth->isHospitalAdmin()){
            $dids = $this->auth->getAllDoctorsByHospitals();
            $this->db->where_in("hms_receptionist.doc_id",$dids);
        }

        $this->db->like("hms_users.first_name",$q);
        $this->db->like("hms_users.last_name",$q);
        $this->db->where("hms_users.isDeleted",0);
        $this->db->where("hms_users.role",$this->auth->getDoctorRoleType());
        $this->db->select("hms_receptionist.id,CONCAT(`first_name`,`last_name`) as text", false);
        $this->db->where("hms_receptionist.isDeleted",0);
        $this->db->from($this->tblname);

        $this->db->join("hms_users","hms_receptionist.user_id=hms_users.id");
        
        
        $res = $this->db->get();
        return $res->result_array();


    }
    function add() {
        $data = $_POST;
        $data['role'] = $this->auth->getReceptienstRoleType();
        $rec_id = $this->auth->addUser($data);
        
        if($rec_id === false){
            return false;
        }else if($rec_id < 0){
            return $rec_id;
        }
        else{
            $rec = array();
            $rec['user_id'] = $rec_id;
            $rec['doc_id'] = isset($data['doc_id']) ? $data['doc_id'] : 0;
            $rec['created_at'] = date("Y-m-d H:i:s");
            if ($this->db->insert($this->tblname, $rec)) {
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
        $rec = $this->db->get($this->tblname);
        $rec = $rec->row_array();

        $rec_id = isset($rec["user_id"]) ? $rec['user_id'] : 0;
        $rec_id = $this->auth->addUser($data,$rec_id);

        if($rec_id === false){
            return false;
        }else if($rec_id < 0){
            return $rec_id;
        }
        else{
            $rec = array();
            if(isset($data['doc_id']))
                $rec['doc_id'] = $data['doc_id'];
            if(isset($data['isActive']))
                $rec['isActive'] = intval($data['isActive']);
            if(count($res) > 0){
                if ($this->db->update($this->tblname, $rec)) {
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

    function getDoctorsIds($id=false){
        if($id===false){
            $id = $this->auth->getUserid();
        }
        $this->db->where('user_id',$id);
        $this->db->where('isDeleted',0);
        $this->db->where('isActive',1);
        $rep = $this->db->get($this->tblname);
        $rep = $rep->result_array();
        $ids = array();
        foreach($rep as $p){
            $ids[] = $p['doc_id'];
        }
        return $ids;
    }
}
