<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Hospital_admin_model extends CI_Model {
    var $tblname = "hms_hospital_admin";
    function getAllhospital_admin() {
        $this->db->where("isDeleted", "0");
        $res = $this->db->get($this->tblname);
        if ($res->num_rows()) return $res->result_array();
        else return array();
    }
    public function getMyId(){
        $this->db->where('user_id',$this->auth->getUserid());
        $this->db->where('isDeleted',0);
        $this->db->where('isActive',1);
        $doc = $this->db->get($this->tblname);
        $doc = $doc->row_array();
        if(isset($doc['id'])){
            return $doc['id'];
        }
        return 0;
    }
    function gethospital_adminById($id) {
        $r = $this->db->query("select *,isActive as curIsActive from " . $this->tblname . " where id=$id and isDeleted=0");
        $r =  $r->row_array();

        $this->db->where('id',$r['user_id']);
        $data = $this->db->get('hms_users');
        $data = $data->row_array();
        if(is_array($data)){
            foreach ($data as $key => $value) {
                $r[$key] = $value;
            }
        }

        $this->db->where('id',$r['hospital_id']);
        $this->db->where('isActive',1);
        $this->db->where('isDeleted',0);
        $hosp  = $this->db->get('hms_hospitals')->row_array();
        $r['hospital_name'] = isset($hosp['name']) ? $hosp['name'] : "";

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
        $data['role'] = $this->auth->getHospitalAdminRoleType();
        
        $ha_id = $this->auth->addUser($data);
        
        if($ha_id === false){
            return false;
        }else if($ha_id < 0){
            return $ha_id;
        }
        else{
            $had = array();
            $had['user_id'] = $ha_id;
            $had['hospital_id'] = isset($data['hospital_id']) ? $data['hospital_id'] : -1;
            $had['created_at'] = date("Y-m-d H:i:s");
            if ($this->db->insert($this->tblname, $had)) {
                //get hospital name
                $hname = $this->db->query("select name from hms_hospitals where id = $had[hospital_id]")->row_array();
                //sent notification to hadmin
                $this->notification->saveNotification($had['user_id'], "You are linked with <b>".$hname['name']."</b> hospital as Hospital admin");
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
        $ha = $this->db->get($this->tblname);
        $ha = $ha->row_array();

        $ha_id = isset($ha["user_id"]) ? $ha['user_id'] : 0;
        $ha_id = $this->auth->addUser($data,$ha_id);

        if($ha_id === false){
            return false;
        }else if($ha_id < 0){
            return $ha_id;
        }
        else{
            $had = array();
            if(isset($data['hospital_id']))
                $had['hospital_id'] = $data['hospital_id'];
            if(isset($data['isActive']))
                $had['isActive'] = intval($data['isActive']);
            
            if(count($had) > 0){
                $this->db->where("id", $id);
                if ($this->db->update($this->tblname, $had)) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        return true;
    }
    function delete($id) {
        $this->db->where("id", $id);
        $d["isDeleted"] = 1;
        if ($this->db->update($this->tblname, $d)) {
            return true;
        } else return false;
    }
    
}
