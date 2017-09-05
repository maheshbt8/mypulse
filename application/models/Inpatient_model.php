<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Inpatient_model extends CI_Model {
    var $tblname = "hms_inpatient";
    function getAllinpatient() {
        $this->db->where("isDeleted", "0");
        $res = $this->db->get($this->tblname);
        if ($res->num_rows()) return $res->result_array();
        else return array();
    }

    function getinpatientById($id) {
        $r = $this->db->query("select * from " . $this->tblname . " where id=$id and isDeleted=0");
        $r = $r->row_array();
        $r['join_date'] = date("d-m-Y",strtotime($r['join_date']));
        return $r;
    }

    function getinpatientBybedId($id) {
        $r = $this->db->query("select * from " . $this->tblname . " where bed_id = $id and isDeleted=0 and status in (0,1)");
        if($r->num_rows() > 0)
            return $r->row_array();
        else 
            return false;
    }

    function search($q, $field) {
        $uid = $this->auth->getUserid();
        $field = explode(",", $field);
        foreach ($field as $f) {
            $this->db->like($f, $q);
        }
        $select = implode('`," ",`', $field);
        $this->db->select("id,CONCAT(`$select`) as text", false);
        $res = $this->db->get_where($this->tblname,array('doctor_id' => $uid));
        return $res->result_array();
    }

    function add() {
        $data = $_POST;
        unset($data["eidt_gf_id"]);
        if (isset($data["join_date"])) $data["join_date"] = date("Y-m-d", strtotime($data["join_date"]));
        if (isset($data["left_date"])) $data["left_date"] = date("Y-m-d", strtotime($data["left_date"]));
        if (isset($data["status"])) $data["status"] = intval($data["status"]);
        if (isset($data["isActive"])) $data["isActive"] = intval($data["isActive"]);
        if ($this->db->insert($this->tblname, $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function add_new_note($data){
        $hsdata = $this->db->insert('hms_inpatient_history',$data);

        //get inpatient data where id=in_patient_id
        $this->db->where('id', $data['in_patient_id']);
        $inpatient = $this->db->get('hms_inpatient')->row_array();
        // get patient name using user_id from user tbl
        $this->db->where('id', $inpatient['user_id']);
        $pname = $this->db->get('hms_users')->row_array();
        // get department_id and doctor user_id using doctor_id
        $this->db->where('id', $inpatient['doctor_id']);
        $doctor = $this->db->get('hms_doctors')->row_array();

        if($this->auth->isDoctor()){
            // get nurses which are linked with this $dept_id
            $nurses = $this->db->query("select user_id from hms_nurse where department_id = $doctor[department_id]")->result_array();
            // sent notification to nurse
            foreach ($nurses as $nurse){
                $this->notification->saveNotification($nurse['user_id'], "New note is added in Inpatient history of patient <b>".$pname['first_name']." ".$pname['last_name']."</b>");
            }
        }elseif ($this->auth->isNurse()){
            //sent notification to doctor
            $this->notification->saveNotification($doctor['user_id'], "New note is added in Inpatient history of patient <b>".$pname['first_name']." ".$pname['last_name']."</b>");
        }

        if ($hsdata) {
            return true;
        }
        else
        {
          return false;
        }
    }

    public function update_new_note($data){
        $hsdata = $this->db->replace('hms_inpatient_history',$data);

        //get inpatient data where id=in_patient_id
        $this->db->where('id', $data['in_patient_id']);
        $inpatient = $this->db->get('hms_inpatient')->row_array();
        // get patient name using user_id from user tbl
        $this->db->where('id', $inpatient['user_id']);
        $pname = $this->db->get('hms_users')->row_array();
        // get department_id and doctor user_id using doctor_id
        $this->db->where('id', $inpatient['doctor_id']);
        $doctor = $this->db->get('hms_doctors')->row_array();

        if($this->auth->isDoctor()){
            // get nurses which are linked with this $dept_id
            $nurses = $this->db->query("select user_id from hms_nurse where department_id = $doctor[department_id]")->result_array();
            // sent notification to nurse
            foreach ($nurses as $nurse){
                $this->notification->saveNotification($nurse['user_id'], "Note is updated in Inpatient history of patient <b>".$pname['first_name']." ".$pname['last_name']."</b>");
            }
        }elseif ($this->auth->isNurse()){
            //sent notification to doctor
            $this->notification->saveNotification($doctor['user_id'], "Note is updated in Inpatient history of patient <b>".$pname['first_name']." ".$pname['last_name']."</b>");
        }

        if ($hsdata) {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function update($id) {
        $data = $_POST;
        unset($data["eidt_gf_id"]);
        if (isset($data["join_date"])) $data["join_date"] = date("Y-m-d", $data["join_date"]);
        if (isset($data["left_date"])) $data["left_date"] = date("Y-m-d", $data["left_date"]);
        if (isset($data["status"])) $data["status"] = intval($data["status"]);
        if (isset($data["isActive"])) $data["isActive"] = intval($data["isActive"]);
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
}
