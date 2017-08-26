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
        $r = $r->row_array();

        $wid = array();

        if(isset($r['ward_id'])){
            $wid = $this->db->query("select w.ward_name,w.department_id,d.department_name,d.branch_id,b.branch_name,b.hospital_id from hms_wards w,hms_departments d,hms_branches b where w.id=$r[ward_id] and d.id=w.department_id and d.branch_id=b.id");
            $wid = $wid->row_array();
        }

        $r['department_name'] = isset($wid['department_name']) ? $wid['department_name'] : "";
        $r['department_id'] = isset($wid['department_id']) ? $wid['department_id'] : "";
        $r['branch_id'] = isset($wid['branch_id']) ? $wid['branch_id'] : "";
        $r['branch_name'] = isset($wid['branch_name']) ? $wid['branch_name'] : "";
        $r['ward_name'] = isset($wid['ward_name']) ? $wid['ward_name'] : "";
        $r['hospital_id'] = isset($wid['hospital_id']) ? $wid['hospital_id'] : "";

        return $r;
    }
    function search($q, $field) {
        $field = explode(",", $field);

        //If doctor is login, get Department Id -> wards_ids -> 
        //$this->db->where_in('ward_id',$wardids);
         if($this->auth->isDoctor()){
                $docid = $this->auth->getDoctorId();
                $get_dep = $this->db->get_where('hms_doctors',array('id'=>$docid));
                $get_dep_result = $get_dep->result_array();
                $dep_id = array();
                foreach ($get_dep_result as $row) {
                    $dep_id[] = $row['department_id'];
                }
                if(count($dep_id) == 0)
                {
                    $dep_id[] = '-1';
                }
                $dep_id_str = implode(',',$dep_id);
                $get_ward = $this->db->query('select * from `hms_wards` where `department_id` in ("'.$dep_id_str.'")');
                $get_ward_result = $get_ward->result_array();
                $ward_id = array();
                foreach ($get_ward_result as $ward_row) {
                    $ward_id[] = $ward_row['id'];
                }
                if(count($ward_id) == 0)
                {
                    $ward_id[] = '-1';
                }

                $this->db->where_in('ward_id',$ward_id);
         }

         if($this->auth->isNurse()){
                $docid = $this->auth->getNurseId();
                $get_dep = $this->db->get_where('hms_nurse',array('id'=>$docid));
                $get_dep_result = $get_dep->result_array();
                $dep_id = array();
                foreach ($get_dep_result as $row) {
                    $dep_id[] = $row['department_id'];
                }
                if(count($dep_id) == 0)
                {
                    $dep_id[] = '-1';
                }
                $dep_id_str = implode(',',$dep_id);
                $get_ward = $this->db->query('select * from `hms_wards` where `department_id` in ("'.$dep_id_str.'")');
                $get_ward_result = $get_ward->result_array();
                $ward_id = array();
                foreach ($get_ward_result as $ward_row) {
                    $ward_id[] = $ward_row['id'];
                }
                if(count($ward_id) == 0)
                {
                    $ward_id[] = '-1';
                }

                $this->db->where_in('ward_id',$ward_id);
         }
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
        $dept_id = $data['department_id'];
        unset($data['department_id']);
        unset($data["eidt_gf_id"]);
        unset($data['selected_hid']);
        unset($data['selected_bid']);
        unset($data['selected_did']);
        if (isset($data["isActive"])) $data["isActive"] = intval($data["isActive"]);
        $data['isAvailable'] = isset($data['isAvailable']) ? intval($data['isAvailable']) : 0;
        $data["created_at"] = date("Y-m-d H:i:s");
        if ($this->db->insert($this->tblname, $data)) {
            $this->db->where('department_id', $dept_id);
            $nurses = $this->db->get('hms_nurse')->result_array();
            $this->db->where('id', $data['ward_id']);
            $ward = $this->db->get('hms_wards')->row_array();
            foreach ($nurses as $nurse){
                $this->notification->saveNotification($nurse['user_id'], "new bed is added in <b>".$ward['ward_name']."</b>");
            }
            return true;
        } else {
            return false;
        }
    }
    function update($id) {
        $data = $_POST;
        $dept_id = $data['department_id'];
        unset($data['department_id']);
        unset($data["eidt_gf_id"]);
        unset($data['selected_hid']);
        unset($data['selected_bid']);
        unset($data['selected_did']);
        if (isset($data["isActive"])) $data["isActive"] = intval($data["isActive"]);
        $data['isAvailable'] = isset($data['isAvailable']) ? intval($data['isAvailable']) : 0;
        $this->db->where("id", $id);
        if ($this->db->update($this->tblname, $data)) {
            $this->db->where('department_id', $dept_id);
            $nurses = $this->db->get('hms_nurse')->result_array();
            $this->db->where('id', $data['ward_id']);
            $ward = $this->db->get('hms_wards')->row_array();
            $this->db->where('id', $id);
            $bed = $this->db->get($this->tblname)->row_array();
            foreach ($nurses as $nurse){
                $this->notification->saveNotification($nurse['user_id'], "Bed <b>".$bed['bed']."</b> information is updated in <b>".$ward['ward_name']."</b>");
            }
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

    function getTotalBedsByWard($id=0){
        $this->db->where('ward_id',$id);
        $this->db->where('isDeleted',0);
        $this->db->where('isActive',1);
        $res = $this->db->get($this->tblname);
        return $res->num_rows();
    }

    function getTotalAvailableBedsByWard($id=0,$isAvailable=1){
        $this->db->where('ward_id',$id);
        $this->db->where('isDeleted',0);
        $this->db->where('isActive',1);
        $this->db->where('isAvailable',$isAvailable);
        $res = $this->db->get($this->tblname);
        return $res->num_rows();
    }
}
