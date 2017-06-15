<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Medical_store_model extends CI_Model {
    var $tblname = "hms_medical_store";
    function getAllmedical_store() {
        $this->db->where("isDeleted", "0");
        $res = $this->db->get($this->tblname);
        if ($res->num_rows()) return $res->result_array();
        else return array();
    }
    function getmedical_storeById($id) {
        $r = $this->db->query("select * from " . $this->tblname . " where id=$id and isDeleted=0");
        $r = $r->row_array();
        $this->db->where('id',$r['user_id']);
        $user = $this->db->get('hms_users');
        $user = $user->row_array();
        $r['user'] = $user;
        if(isset($r['branch_id'])){
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
        $data['role'] = $this->auth->getMedicalStoreRoleType();
        $uid = $this->auth->addUser($data);
        
        if($uid === false){
            return false;
        }else if($uid === -1){
            return -1;
        }else{
            $mstore['user_id'] = $uid;
            $mstore['name'] = $data['name'];
            $mstore['owner_name'] = $data['owner_name'];
            $mstore['owner_contact_number'] = $data['owner_contact_number'];
            $mstore['branch_id'] = isset($data['branch_id']) ? $data['branch_id'] : -1;
            $mstore['created_at'] = date("Y-m-d H:i:s");
            if ($this->db->insert($this->tblname, $mstore)) {
                return true;
            } else {
                return false;
            }
        }
    }
    function update($id) {

        $data = $_POST;

        $this->db->where("id", $id);
        $usr = $this->db->get($this->tblname);
        $usr = $usr->row_array();

        $uid = isset($usr["user_id"]) ? $usr['user_id'] : 0;
        $uid = $this->auth->addUser($data,$uid);

        if($uid === false){
            return false;
        }else if($uid === -1){
            return -1;
        }
        else{
            $mstore = array();
            if(isset($data['name']))
                $mstore['name'] = $data['name'];
            if(isset($data['owner_name']))
                $mstore['owner_name'] = $data['owner_name'];
            if(isset($data['owner_contact_number']))
                $mstore['owner_contact_number'] = $data['owner_contact_number'];
            if(isset($data['branch_id']))
                $mstore['branch_id'] = $data['branch_id'];        


            $this->db->where("id", $id);
            if ($this->db->update($this->tblname, $mstore)) {
                return true;
            } else {
                return false;
            }
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
