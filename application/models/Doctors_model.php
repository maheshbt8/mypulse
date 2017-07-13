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
    function search($q, $field,$did = -1) {

        $dids = $this->auth->getAllDepartmentsIds();

        if($did > 0){
            $this->db->where("hms_doctors.department_id",$did);
        }else if($this->auth->isHospitalAdmin()){
            $this->db->where_in("hms_doctors.department_id",$bids);
        }

        $this->db->like("hms_users.first_name",$q);
        $this->db->like("hms_users.last_name",$q);
        $this->db->where("hms_users.isDeleted",0);
        $this->db->where("hms_users.role",$this->auth->getDoctorRoleType());
        $this->db->select("hms_doctors.id,CONCAT(`first_name`,`last_name`) as text,description", false);
        $this->db->where("hms_doctors.isDeleted",0);
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
        }else if($doc_id < 0){
            return $doc_id;
        }
        else{
            $doc = array();
            $doc['user_id'] = $doc_id;
            $doc['department_id'] = isset($data['department_id']) ? $data['department_id'] : -1;
            $doc['created_at'] = date("Y-m-d H:i:s");
            if ($this->db->insert($this->tblname, $doc)) {
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
        $doc = $this->db->get($this->tblname);
        $doc = $doc->row_array();

        $doc_id = isset($doc["user_id"]) ? $doc['user_id'] : 0;
        $doc_id = $this->auth->addUser($data,$doc_id);

        if($doc_id === false){
            return false;
        }else if($doc_id < 0){
            return $doc_id;
        }
        else{
            $doc = array();
            if(isset($data['department_id']))
                $doc['department_id'] = $data['department_id'];
            if(isset($data['isActive']))
                $doc['isActive'] = intval($data['isActive']);
            
            if(count($doc) > 0){
                $this->db->where("id", $id);
                if ($this->db->update($this->tblname, $doc)) {
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

    function deleteavalibality($id){
        if(is_array($id)){
            $this->db->where_in('id',$id);
        }else{
            $this->db->where("id", $id);
        }
        $d["isDeleted"] = 1;
        if ($this->db->update("hms_availability", $d)) {
            return true;
        } else return false;
    }

    function getDoctorsIdsByHospitalId($hospital_id=0){
        $bids = $this->auth->getBranchIds($hospital_id);

        $this->db->where_in('branch_id',$bids);
        $this->db->where("isDeleted",0);
        $this->db->where("isActive",1);
        $dids = $this->db->get("hms_departments");
        $dids = $dids->result_array();
        $tids = array();
        foreach ($dids as $key => $value) {
            $tids[] = $value['id'];
        }
        if(count($tids) == 0) { $tids[] = -1;}
        $this->db->where_in("department_id",$tids);
        $this->db->where("isDeleted",0);
        $this->db->where("isActive",1);

        $res = $this->db->get($this->tblname);
        $res = $res->result_array();
        $ids = array();
        foreach ($res as $key => $value) {
            $ids[] = $value['id'];
        }
        return $ids;
    }

    function getDoctorsIdsByHospital(){
        $bids = $this->auth->getBranchIds();
        $this->db->where_in('branch_id',$bids);
        $this->db->where("isDeleted",0);
        $this->db->where("isActive",1);
        $dids = $this->db->get("hms_departments");
        $dids = $dids->result_array();
        $tids = array();
        foreach ($dids as $key => $value) {
            $tids[] = $value['id'];
        }
        if(count($tids) == 0) { $tids[] = -1;}
        $this->db->where_in("department_id",$tids);
        $this->db->where("isDeleted",0);
        $this->db->where("isActive",1);

        $res = $this->db->get($this->tblname);
        $res = $res->result_array();
        $ids = array();
        foreach ($res as $key => $value) {
            $ids[] = $value['id'];
        }
        return $ids;
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

    public function getMyUserId($id=0){
        $this->db->where('id',$id);
        $this->db->where('isDeleted',0);
        $this->db->where('isActive',1);
        $d = $this->db->get($this->tblname);
        $d = $d->row_array();
        if(isset($d['user_id']))
            return $d['user_id'];
        return 0;
    }

    public function getDoctorIdFromUserId($uid=0){
        $this->db->where('user_id',$uid);
        $this->db->where('isDeleted',0);
        $this->db->where('isActive',1);
        $d = $this->db->get($this->tblname);
        $d = $d->row_array();
        if(isset($d['id']))
            return $d['id'];
        return 0;
    }

    public function addAvailability($docid=0){
        $data = array();
        if($_POST['repeat_interval'] == 0){
            //Weekly
            for($i=0; $i<count($_POST['repeat_on']); $i++){
                $data['user_id'] = $docid;//$this->getDoctorIdFromUserId($this->auth->getUserid());
                $data['repeat_interval'] = $_POST['repeat_interval'];
                $data['day'] = $_POST['repeat_on'][$i];
                $data['end_date'] = date("Y-m-d",strtotime($_POST['end_on']));
                $data['start_time'] = date("H:i", strtotime($_POST['start_time']));
                $data['end_time'] = date("H:i", strtotime($_POST['end_time']));
                if(isset($_POST['eidt_gf_id']) && $_POST['eidt_gf_id'] != 0){
                    $this->db->where('id',$_POST['eidt_gf_id']);
                    $this->db->update('hms_availability',$data);
                }
                else{
                    $data['start_date'] = date("Y-m-d");
                    $this->db->insert('hms_availability',$data);
                }   
            }
        }else if($_POST['repeat_interval'] == 1){
            //Monthly
            $data['user_id'] = $docid;//$this->getDoctorIdFromUserId($this->auth->getUserid());
            $data['repeat_interval'] = $_POST['repeat_interval'];
            $data['day'] = $_POST['day_of_month'];
            $data['end_date'] = date("Y-m-d",strtotime($_POST['end_on']));
            $data['start_time'] = date("H:i", strtotime($_POST['start_time']));
            $data['end_time'] = date("H:i", strtotime($_POST['end_time']));
            if(isset($_POST['eidt_gf_id']) && $_POST['eidt_gf_id'] != 0){
                $this->db->where('id',$_POST['eidt_gf_id']);
                $this->db->update('hms_availability',$data);
            }
            else{
                $data['start_date'] = date("Y-m-d");
                $this->db->insert('hms_availability',$data);
            }
        }else if($_POST['repeat_interval'] == 2){
            //Custum
            $data['user_id'] = $docid;//$this->getDoctorIdFromUserId($this->auth->getUserid());
            $data['repeat_interval'] = $_POST['repeat_interval'];
            $data['start_date'] = date("Y-m-d",strtotime($_POST['date']));
            $data['end_date'] = date("Y-m-d",strtotime($_POST['end_on']));
            $data['start_time'] = date("H:i", strtotime($_POST['start_time']));
            $data['end_time'] = date("H:i", strtotime($_POST['end_time']));
            if(isset($_POST['eidt_gf_id']) && $_POST['eidt_gf_id'] != 0){
                $this->db->where('id',$_POST['eidt_gf_id']);
                $this->db->update('hms_availability',$data);
            }
            else{
                $this->db->insert('hms_availability',$data);
            }   
        }
        
    }

    public function getDoctorAvailabilties($doc_id=0,$start_date,$end_date){
        $this->db->where('user_id',$doc_id);
        $this->db->where('isDeleted',0);
        $red = $this->db->get('hms_availability');
        $red = $red->result_array();
        $data = array();
        foreach($red as $r){
            
            $period = new DatePeriod(
                new DateTime($start_date),
                new DateInterval('P1D'),
                new DateTime($end_date)
            );
            
            foreach($period as $date){
                $c = strtotime($date->format("Y-m-d"));
                $s = strtotime($r['start_date']);
                $e = strtotime($r['end_date']);
                $can = false;
                if($c >= $s && $c <= $e){
                    $can = true;
                }
                if(!$can)
                    continue;

                $_day = 0;
                if($r['repeat_interval'] == 0){
                    //Weekly
                    $_day = $date->format("w");
                }else if($r['repeat_interval']==1){
                    //Monthly
                    $_day = $date->format("j");
                }
                if($_day == $r['day']){
                    $data[] = array(
                        'interval_id' => $r['id'],
                        'date' => $date->format('d-m-Y'),
                        'start_time' => $r['start_time'],
                        'end_time' => $r['end_time'],
                        'startDate' => strtotime($date->format('d-m-Y').' '.$r['start_time']),
                        'endDate' => strtotime($date->format('d-m-Y').' '.$r['end_time']),
                        'title' => date('h:i A',strtotime($r['start_time']))." to ".date('h:i A',strtotime($r['end_time']))
                    );
                }
            }
            
        }
        return $data;
    }

    function getAvailabilityById($id){
        $this->db->where('id',$id);
        $this->db->where('isDeleted',0);
        $av = $this->db->get('hms_availability');
        return $av->row_array();
    }

    function updateSettings($docid=0){
        //$docid = $this->getDoctorIdFromUserId($this->auth->getUserid());
        $data['no_appt_handle'] = intval($_POST['no_appt_handle']);
        $data['availability_text'] = $_POST['availability_text'];
        $this->db->where('id',$docid);
        $this->db->update($this->tblname,$data);
    }

    function getSetting($docid){
        $this->db->where('id',$docid);
        $s = $this->db->get($this->tblname);
        $s = $s->row_array();
        return $s;
    }

    function getAvailibaliryInterval($docid=0){
        $this->db->where('user_id',$docid);
        $this->db->where('isDeleted',0);
        $ava = $this->db->get('hms_availability');
        return $ava->result_array();
    }

    function getDocAppInterval($docid=0){
        $this->db->where('id',$docid);
        $doc = $this->db->get($this->tblname);
        $doc = $doc->row_array();
        return $doc['no_appt_handle'];
    }

    public function addPrescription(){
        $pre['doctor_id'] = $this->auth->getDoctorid();
        $pre['patient_id'] = $_POST['patient_id'];
        $pre['appoitment_id'] = $_POST['appt_id'];
        $pre['created_at'] = date("Y-m-d H:i:s");
        $pre['title'] = $_POST['title'];
        $this->db->insert('hms_prescription',$pre);

        $this->db->where('id',$pre['appoitment_id']);
        $this->db->update('hms_appoitments',array('status'=>3));

        $pid = $this->db->insert_id();
        $this->addPrescriptionItems($pid);
    }

    function addPrescriptionItems($pid=0){
        for($i=0; $i<count($_POST['item_id']); $i++){
            $item['drug'] = $_POST['drug'][$i];
            $item['prescription_id'] = $pid;
            $item['strength'] = $_POST['strength'][$i];
            $item['dosage'] = $_POST['dosage'][$i];
            $item['duration'] = $_POST['duration'][$i];
            $item['note'] = $_POST['note'][$i];

            if(isset($_POST['item_id'][$i]) && $_POST['item_id'][$i]!=""){
                $this->db->where('id',$_POST['item'][$i]);
                $this->db->update('hms_prescription_item',$item);
            }else{
                $this->db->insert('hms_prescription_item',$item);
            }

        }
    }

    function getPrescription($pid = 0){
        $this->db->where('id',$pid);
        $this->db->where('isDeleted',0);
        $pre = $this->db->get('hms_prescription');
        $pre = $pre->row_array();

        $this->db->where('id',$pre['patient_id']);
        $patient = $this->db->get('hms_users');
        $patient = $patient->row_array();
        $patient_name = "";
        $patient_name = isset($patient['first_name']) ? $patient['first_name']." " : "";
        $patient_name .= isset($patient['last_name']) ? $patient['last_name'] : "";
        $pre['patient_name'] = $patient_name;

        $duid = $this->getMyUserId($pre['doctor_id']);
        $this->db->where('id',$duid);
        $doctor = $this->db->get('hms_users');
        $doctor = $doctor->row_array();
        $doctor_name = "";
        $doctor_name = isset($doctor['first_name']) ? $doctor['first_name']." " : "";
        $doctor_name .= isset($doctor['last_name']) ? $doctor['last_name'] : "";
        $pre['doctor_name'] = $doctor_name;

        $this->db->where('prescription_id',$pid);
        $items = $this->db->get('hms_prescription_item');
        $items = $items->result_array();

        $pre['items'] = $items;
        return $pre;
    }
}
