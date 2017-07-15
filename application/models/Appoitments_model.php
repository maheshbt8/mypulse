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

        if(isset($r['doctor_id'])){
            $uid = $this->auth->getDoctorUserId($r['doctor_id']);
            $this->db->where('id',$uid);
            $u = $this->db->get('hms_users');
            $u = $u->row_array();
            $na = "";
            if(isset($u['first_name']))
                $na .=$u['first_name']." ";
            if(isset($u['last_name']))
                $na .= $u['last_name'];
            $r['doctor_name'] = $na;
        }else{
            $r['doctor_name'] = "";
        }
        $r['appoitment_date'] = date("d-m-Y",strtotime($r['appoitment_date']));
        $time_vl = "";
        $time_tx = "";
        $_st= date("h:i A",strtotime($r['appoitment_time_start']));
        $_et= date("h:i A",strtotime($r['appoitment_time_end']));
        $time_vl = $_st."-".$_et;
        $time_tx = $_st." to ".$_et;
        $r['timesloat_val'] = $time_vl;
        $r['timesloat_txt'] = $time_tx;
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
        $tsloat = $data['appoitment_sloat'];
        unset($data['appoitment_sloat']);
        $tsloat = explode('-',$tsloat);
        $data['appoitment_time_start'] = date('H:i',strtotime($tsloat[0]));
        $data['appoitment_time_end'] = date('H:i',strtotime($tsloat[1]));
        if($this->auth->isPatient()){
            $data['user_id'] = $this->auth->getUserid();
        }else{
            $data['user_id'] = intval($data['user_id']);
        }
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

    function isDoctorAvailable($doc_id=0,$date){
        $this->db->where('doctor_id',$doc_id);
        $this->db->where('status',0);
    }

    //For Patient
    function getTimeSloats($doc_id=0,$date){
        $this->db->where('user_id',$doc_id);
        $this->db->where('isDeleted',0);
        $availability = $this->db->get('hms_availability');
        $availability = $availability->result_array();

        //Get Available Date time
        $data = array();
        foreach($availability as $r){
            $c = strtotime($date);
            $s = strtotime($r['start_date']);
            $e = strtotime($r['end_date']);
            $can = false;
            if($c >= $s && $c <= $e){
                $can = true;
            }
            //Get Dates when doctor is not available
            $this->db->where('user_id',$doc_id);
            $this->db->where('repeat_interval',4);
            $this->db->where('start_date',$date);
            $notAvailable = $this->db->get('hms_availability');
            
            if($notAvailable->num_rows() > 0){
                $can = false;
            }
            if(!$can)
                continue;

            $_day = 0; 
            if($r['repeat_interval'] == 0){
                $_day = date("w",strtotime($date));
            }else if($r['repeat_interval'] == 1){
                $_day = date("j",strtotime($date));
            }
            if($_day == $r['day']){
                $data[] = array(
                    'start' => strtotime($date.' '.$r['start_time']),
                    'end' => strtotime($date.' '.$r['end_time'])
                );
            }
        }
        //Get Doctor Settings
        $this->db->where('id',$doc_id);
        $doc_set = $this->db->get('hms_doctors');
        $doc_set = $doc_set->row_array();
        $noAppt = $doc_set['no_appt_handle'];
        $apptInterval = floor(60/$noAppt);

        //Get TimeSloats
        $timeSloats = array();
        foreach($data as $d){
            $end = $d['end'];
            $start = $d['start'];
            while($start <= $end){
                $s = $start;
                $start += 60 * 60;
                $_e = $start;
                if($_e > $end){
                    $_e = $end;
                }
                $timeSloats[] = array(
                    's' => $s,
                    'e' => $_e,
                    'start' => date('h:i A',$s),
                    'end' => date('h:i A',$_e),
                    'title' => date('h:i A',$s)." to ".date('h:i A',$_e)
                );
            }
        }
        
        //Get Available TimeSloats
        $availableTimeSloats = array();
        foreach($timeSloats as $slot){
            $st = strtotime($slot['start']);
            $et = strtotime($slot['end']);
            $mins = $et - $st;
            $mins = floor($mins/60);

            $tot_appt = floor($mins/$apptInterval);

            $this->db->where('doctor_id',$doc_id);
            $this->db->where('appoitment_date',$date);
            $this->db->where('appoitment_time_start',date('H:i:s',$st));
            $this->db->where('appoitment_time_end',date('H:i:s',$et));
            $this->db->where('status',0);
            $this->db->where('isDeleted',0);

            $appt = $this->db->get($this->tblname);
            $appt = $appt->result_array();
            if(count($appt) < $tot_appt){
                $slot['remaining'] = $tot_appt - count($appt);
                $hasSlot = false;
                foreach($availableTimeSloats as $temp){
                    $_s = $temp['s'];
                    $_e = $temp['e'];
                    if( ($slot['s'] <= $_s && $slot['e'] >= $_s) ||
                        ($slot['e'] <= $_e && $slot['e'] >= $_e) 
                    ){
                        $hasSlot = true;
                    }
                }
                if(!$hasSlot){
                    $availableTimeSloats[] = $slot;
                }
            }
        }
        return $availableTimeSloats;
    }
}