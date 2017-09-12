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
      
      
        $r = $this->db->query("select *,isActive as curIsActive from " . $this->tblname . " where id=$id and isDeleted=0");
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
            $r['department_name'] = $department['department_name'];

            $this->db->where('id',$r['branch_id']);
            $this->db->where('isActive',1);
            $this->db->where("isDeleted",0);
            $branch = $this->db->get('hms_branches');
            $branch =$branch->row_array();
            $r['hospital_id'] = $branch['hospital_id'];
            $r['branch_name'] = $branch['branch_name'];

            $this->db->where('id',$r['hospital_id']);
            $this->db->where('isActive',1);
            $this->db->where('isDeleted',0);
            $hosp  = $this->db->get('hms_hospitals')->row_array();
            $r['hospital_name'] = isset($hosp['name']) ? $hosp['name'] : "";
        }else{
            $r['department_id'] = 0;
            $r['branch_id'] = 0;
            $r['hospital_id'] = 0;
        }

        return $r;
    }
    function search($q, $field,$did = -1) {

        $dids = $this->auth->getAllDepartmentsIds();

        if($this->auth->isReceptinest()){
            $_dids = $this->auth->getDocIdsFromRecpId();
            if(count($_dids) > 0)
                $this->db->where_in("hms_doctors.id",$_dids);
        }

        if($did > 0){
            $this->db->where("hms_doctors.department_id",$did);
        }else if($this->auth->isHospitalAdmin()){
            $this->db->where_in("hms_doctors.department_id",$dids);
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
            if(isset($data['qualification']))
                $doc['qualification'] = $data['qualification'];
            if(isset($data['experience']))
                $doc['experience'] = $data['experience'];
            if(isset($data['specialization']))
                $doc['specialization'] = $data['specialization'];
            $doc['created_at'] = date("Y-m-d H:i:s");
            if(isset($data['isActive']))
                $doc['isActive'] = intval($data['isActive']);
            if ($this->db->insert($this->tblname, $doc)) {
                //get hospital name
                $hname = $this->db->query("select name from hms_hospitals where id = $data[hospital_id]")->row_array();
                //sent notification to doctor
                $this->notification->saveNotification($doc['user_id'], "You are linked with <b>".$hname['name']."</b> hospital as Doctor");

                //find nurses
                $this->db->where('department_id', $data['department_id']);
                $nurses = $this->db->get('hms_nurse')->result_array();
                //find department name
                $this->db->where('id', $data['department_id']);
                $dep = $this->db->get('hms_departments')->row_array();
                foreach ($nurses as $nurse){
                    //sent notification to nurse
                    $this->notification->saveNotification($nurse['user_id'], "New doctor <b>".$data['first_name']." ".$data['last_name']."</b> is added in your department <b>".$dep['department_name']."</b>");
                }

                if($this->auth->isSuperAdmin()){
                    //find branch
                    $this->db->where('id', $data['branch_id']);
                    $branch = $this->db->get('hms_branches')->row_array();
                    //find hospital admin
                    $this->db->where('hospital_id', $data['hospital_id']);
                    $hadmin = $this->db->get('hms_hospital_admin')->row_array();
                    //sent notification to hospital admin
                    $this->notification->saveNotification($hadmin['user_id'], "New doctor <b>".$data['first_name']." ".$data['last_name']."</b> is added in department: <b>".$dep['department_name']."</b><br>Branch: <b>".$branch['branch_name']."</b>");
                }
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

            if(isset($data['qualification']))
                $doc['qualification'] = $data['qualification'];
            if(isset($data['experience']))
                $doc['experience'] = $data['experience'];
            if(isset($data['specialization']))
                $doc['specialization'] = $data['specialization'];

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

    function updateOtherProfile($id){
        $doc = array();
        $data = $_POST;

        if(isset($data['qualification']))
            $doc['qualification'] = $data['qualification'];
        if(isset($data['experience']))
            $doc['experience'] = $data['experience'];
        if(isset($data['specialization']))
            $doc['specialization'] = $data['specialization'];

        if(count($doc) > 0){
            $this->db->where("id", $id);
            if ($this->db->update($this->tblname, $doc)) {
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

    function deleteavalibalityForOne($id){
        $this->db->where('id',$id);
        $data = $this->db->get('hms_availability');
        $data = $data->row_array();

        $new['repeat_interval'] = 4;
        $new['user_id'] = $data['user_id'];
        $new['start_date'] = $data['start_date'];
        return $this->db->insert('hms_availability',$new);
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

    function getDoctorsIdsByDeppartmentId($dep_id=0){
        if(is_array($dep_id)){
            if(count($dep_id) == 0){$dep_id[] = -1;}
            $this->db->where_in("department_id",$dep_id);
        }
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
        if($doc){
            $doc = $doc->row_array();
            if(isset($doc['id'])){
                return $doc['id'];
            }
        }
        return 0;   
    }

    public function getMyProfile(){
        $id = $this->getMyId();
        $this->db->where('id',$id);
        return $this->db->get($this->tblname)->row_array();
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
        $isOnlyOne = false;

        //code for send notification
        //find doctor user_id
        $this->db->where('id', $docid);
        $doctor = $this->db->get($this->tblname)->row_array();
        //find doctor name whose userid=$doctor['user_id']
        $this->db->where('id', $doctor['user_id']);
        $user = $this->db->get('hms_users')->row_array();
        //find receptionists which are linked with this doctor ->$docid
        $this->db->where('doc_id', $docid);
        $receptionists = $this->db->get('hms_receptionist')->result_array();

        if(isset($_POST['onlyOne']) && $_POST['onlyOne']=='yes'){
            $isOnlyOne = true;
            $sd = date("Y-m-d",strtotime($_POST['today']));
            $st = date("H:i:s",strtotime($_POST['start_time']));
            $et = date("H:i:s",strtotime($_POST['end_time']));
            $res = $this->db->query("select * from hms_availability where user_id=$docid and repeat_interval=2 and start_date='$sd' and end_date='$sd' and ( (start_time <= '$st' and end_time >= '$st') OR (start_time <= '$et' and end_time >= '$et') )");
            $data['user_id'] = $docid;
            $data['repeat_interval'] = 2;
            $data['start_date'] = $sd;
            $data['end_date'] = $sd;
            $data['start_time'] = $st;
            $data['end_time'] = $et;
            //echo "<pre>";

            if($res->num_rows() > 0){
                $res = $res->row_array();
                //var_dump($res);
                $this->db->where('id',$res['id']);
                $this->db->update('hms_availability',$data);
                if($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin()){
                    //send notification to doctor
                    $this->notification->saveNotification($doctor['user_id'], "Your Availability is updated");
                    //send notification to receptionists
                    foreach ($receptionists as $receptionist){
                        $this->notification->saveNotification($receptionist['user_id'], $user['first_name']." ".$user['last_name']." Availability is updated");
                    }
                }elseif ($this->auth->isDoctor()){
                    //send notification to receptionists
                    foreach ($receptionists as $receptionist){
                        $this->notification->saveNotification($receptionist['user_id'], $user['first_name']." ".$user['last_name']." Availability is updated");
                    }
                }elseif ($this->auth->isReceptinest()){
                    //send notification to doctor
                    $this->notification->saveNotification($doctor['user_id'], "Your Availability is updated");
                }
            }else{
                //var_dump($data);
                $this->db->insert('hms_availability',$data);
                if($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin()){
                    //send notification to doctor
                    $this->notification->saveNotification($doctor['user_id'], "Your new availability is added ");
                    //send notification to receptionists
                    foreach ($receptionists as $receptionist){
                        $this->notification->saveNotification($receptionist['user_id'], $user['first_name']." ".$user['last_name']." added new availability");
                    }
                }elseif ($this->auth->isDoctor()){
                    //send notification to receptionists
                    foreach ($receptionists as $receptionist){
                        $this->notification->saveNotification($receptionist['user_id'], $user['first_name']." ".$user['last_name']." added new availability");
                    }
                }elseif ($this->auth->isReceptinest()){
                    //send notification to doctor
                    $this->notification->saveNotification($doctor['user_id'], "Your new availability is added");
                }
            }
            //exit;
        }else{
            if($_POST['repeat_interval'] == 0){
                //Weekly
                for($i=0; $i<count($_POST['repeat_on']); $i++){
                    $data['user_id'] = $docid;//$this->getDoctorIdFromUserId($this->auth->getUserid());
                    $data['repeat_interval'] = $_POST['repeat_interval'];
                    $data['day'] = $_POST['repeat_on'][$i];
                    $data['end_date'] = date("Y-m-d",strtotime($_POST['end_on']));
                    $data['start_time'] = date("H:i", strtotime($_POST['start_time']));
                    $data['end_time'] = date("H:i", strtotime($_POST['end_time']));
                    $data['start_date'] = date("Y-m-d",strtotime($_POST['date']));
                    if(isset($_POST['eidt_gf_id']) && $_POST['eidt_gf_id'] != 0){
                        $this->db->where('id',$_POST['eidt_gf_id']);
                        $this->db->update('hms_availability',$data);
                        if($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin()){
                            //send notification to doctor
                            $this->notification->saveNotification($doctor['user_id'], "Your Availability is updated");
                            //send notification to receptionists
                            foreach ($receptionists as $receptionist){
                                $this->notification->saveNotification($receptionist['user_id'], $user['first_name']." ".$user['last_name']." Availability is updated");
                            }
                        }elseif ($this->auth->isDoctor()){
                            //send notification to receptionists
                            foreach ($receptionists as $receptionist){
                                $this->notification->saveNotification($receptionist['user_id'], $user['first_name']." ".$user['last_name']." Availability is updated");
                            }
                        }elseif ($this->auth->isReceptinest()){
                            //send notification to doctor
                            $this->notification->saveNotification($doctor['user_id'], "Your Availability is updated");
                        }
                    }
                    else{
                        $this->db->insert('hms_availability',$data);
                        if($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin()){
                            //send notification to doctor
                            $this->notification->saveNotification($doctor['user_id'], "Your new availability is added ");
                            //send notification to receptionists
                            foreach ($receptionists as $receptionist){
                                $this->notification->saveNotification($receptionist['user_id'], $user['first_name']." ".$user['last_name']." added new availability");
                            }
                        }elseif ($this->auth->isDoctor()){
                            //send notification to receptionists
                            foreach ($receptionists as $receptionist){
                                $this->notification->saveNotification($receptionist['user_id'], $user['first_name']." ".$user['last_name']." added new availability");
                            }
                        }elseif ($this->auth->isReceptinest()){
                            //send notification to doctor
                            $this->notification->saveNotification($doctor['user_id'], "Your new availability is added");
                        }
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
                $data['start_date'] = date("Y-m-d",strtotime($_POST['date']));
                if(isset($_POST['eidt_gf_id']) && $_POST['eidt_gf_id'] != 0){
                    $this->db->where('id',$_POST['eidt_gf_id']);
                    $this->db->update('hms_availability',$data);
                    if($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin()){
                        //send notification to doctor
                        $this->notification->saveNotification($doctor['user_id'], "Your Availability is updated");
                        //send notification to receptionists
                        foreach ($receptionists as $receptionist){
                            $this->notification->saveNotification($receptionist['user_id'], $user['first_name']." ".$user['last_name']." Availability is updated");
                        }
                    }elseif ($this->auth->isDoctor()){
                        //send notification to receptionists
                        foreach ($receptionists as $receptionist){
                            $this->notification->saveNotification($receptionist['user_id'], $user['first_name']." ".$user['last_name']." Availability is updated");
                        }
                    }elseif ($this->auth->isReceptinest()){
                        //send notification to doctor
                        $this->notification->saveNotification($doctor['user_id'], "Your Availability is updated");
                    }
                }
                else{
                    $this->db->insert('hms_availability',$data);
                    if($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin()){
                        //send notification to doctor
                        $this->notification->saveNotification($doctor['user_id'], "Your new availability is added ");
                        //send notification to receptionists
                        foreach ($receptionists as $receptionist){
                            $this->notification->saveNotification($receptionist['user_id'], $user['first_name']." ".$user['last_name']." added new availability");
                        }
                    }elseif ($this->auth->isDoctor()){
                        //send notification to receptionists
                        foreach ($receptionists as $receptionist){
                            $this->notification->saveNotification($receptionist['user_id'], $user['first_name']." ".$user['last_name']." added new availability");
                        }
                    }elseif ($this->auth->isReceptinest()){
                        //send notification to doctor
                        $this->notification->saveNotification($doctor['user_id'], "Your new availability is added");
                    }
                }
            }else if($_POST['repeat_interval'] == 2){
                //Custum
                $data['user_id'] = $docid;//$this->getDoctorIdFromUserId($this->auth->getUserid());
                $data['repeat_interval'] = $_POST['repeat_interval'];
                $data['start_date'] = date("Y-m-d",strtotime($_POST['date']));
                $data['end_date'] = date("Y-m-d",strtotime($_POST['date']));
                $data['start_time'] = date("H:i", strtotime($_POST['start_time']));
                $data['end_time'] = date("H:i", strtotime($_POST['end_time']));
                if(isset($_POST['eidt_gf_id']) && $_POST['eidt_gf_id'] != 0){
                    $this->db->where('id',$_POST['eidt_gf_id']);
                    $this->db->update('hms_availability',$data);
                    if($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin()){
                        //send notification to doctor
                        $this->notification->saveNotification($doctor['user_id'], "Your Availability is updated");
                        //send notification to receptionists
                        foreach ($receptionists as $receptionist){
                            $this->notification->saveNotification($receptionist['user_id'], $user['first_name']." ".$user['last_name']." Availability is updated");
                        }
                    }elseif ($this->auth->isDoctor()){
                        //send notification to receptionists
                        foreach ($receptionists as $receptionist){
                            $this->notification->saveNotification($receptionist['user_id'], $user['first_name']." ".$user['last_name']." Availability is updated");
                        }
                    }elseif ($this->auth->isReceptinest()){
                        //send notification to doctor
                        $this->notification->saveNotification($doctor['user_id'], "Your Availability is updated");
                    }
                }
                else{
                    $this->db->insert('hms_availability',$data);
                    if($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin()){
                        //send notification to doctor
                        $this->notification->saveNotification($doctor['user_id'], "Your new availability is added ");
                        //send notification to receptionists
                        foreach ($receptionists as $receptionist){
                            $this->notification->saveNotification($receptionist['user_id'], $user['first_name']." ".$user['last_name']." added new availability");
                        }
                    }elseif ($this->auth->isDoctor()){
                        //send notification to receptionists
                        foreach ($receptionists as $receptionist){
                            $this->notification->saveNotification($receptionist['user_id'], $user['first_name']." ".$user['last_name']." added new availability");
                        }
                    }elseif ($this->auth->isReceptinest()){
                        //send notification to doctor
                        $this->notification->saveNotification($doctor['user_id'], "Your new availability is added");
                    }
                }   
            }
        }
        
    }

    //For Calendar View
    public function getDoctorAvailabilties($doc_id=0,$start_date,$end_date){
        $this->db->where('user_id',$doc_id);
        $this->db->where('isDeleted',0);
        $red = $this->db->get('hms_availability');
        $red = $red->result_array();
        $data = array();

        $cnt = 1;
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
                //Get Dates when doctor is not available
                $this->db->where('user_id',$doc_id);
                $this->db->where('repeat_interval',4);
                $this->db->where('start_date',$date->format("Y-m-d"));
                $notAvailable = $this->db->get('hms_availability');
                
                if($notAvailable->num_rows() > 0){
                    $can = false;
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
                        'cnt' => $cnt,
                        'interval_id' => $r['id'],
                        'date' => $date->format('d-m-Y'),
                        'start_time' => $r['start_time'],
                        'end_time' => $r['end_time'],
                        'startDate' => $date->format('Y-m-d').' '.$r['start_time'],
                        'endDate' => $date->format('Y-m-d').' '.$r['end_time'],
                        'title' => date('h:i A',strtotime($r['start_time']))." to ".date('h:i A',strtotime($r['end_time']))
                    );
                    //echo "<Pre>";
                    //var_dump($data);exit;
                    $cnt++;
                }
            }
            
        }

        $result = array();
        $sec_datset = $data;
        $dupArr = array();
        foreach($data as $d){
            $isDup = false;
            for($j=0; $j<count($sec_datset); $j++){
                $item = $sec_datset[$j];
                if($item['date'] == $d['date']){
                    $st = $d['start_time'];
                    $et = $d['end_time'];
                    if(($item['start_time'] <= $st && $item['end_time'] >= $st) ||
                        $item['start_time'] <= $et && $item['end_time'] >= $et
                     ){
                        if($item['cnt'] != $d['cnt']){
                            $isDup = true;
                            $hasDup = false;
                            foreach($dupArr as $t){
                                $_st = $t['start_time'];
                                $_et = $t['end_time'];
                                if(($item['start_time'] <= $_st && $item['end_time'] >= $_st) ||
                                    $item['start_time'] <= $_et && $item['end_time'] >= $_et
                                ){
                                    $hasDup = true;
                                }
                            }
                            if(!$hasDup){
                                $result[] = $d;
                                $dupArr[] =$d;
                            }
                            
                        }
                    }
                }
            }
            if(!$isDup){
                $result[] = $d;
            }
        }
        return $result;
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

        //find doctor user_id
        $this->db->where('id', $docid);
        $doctor = $this->db->get($this->tblname)->row_array();
        //find doctor name whose userid=$doctor['user_id']
        $this->db->where('id', $doctor['user_id']);
        $user = $this->db->get('hms_users')->row_array();
        //find receptionists which are linked with this doctor ->$docid
        $this->db->where('doc_id', $docid);
        $receptionists = $this->db->get('hms_receptionist')->result_array();

        if ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin()){
            //send notification to doctor
            $this->notification->saveNotification($doctor['user_id'], "Your Other settings regarding availability is updated");
            //send notification to receptionists
            foreach ($receptionists as $receptionist){
                $this->notification->saveNotification($receptionist['user_id'], $user['first_name']." ".$user['last_name']." Other settings regarding availability is updated");
            }
        }elseif ($this->auth->isReceptinest()){
            //send notification to doctor
            $this->notification->saveNotification($doctor['user_id'], "Your Other settings regarding availability is updated");
        }elseif ($this->auth->isDoctor()){
            //send notification to receptionists
            foreach ($receptionists as $receptionist){
                $this->notification->saveNotification($receptionist['user_id'], $user['first_name']." ".$user['last_name']." Other settings regarding availability is updated");
            }
        }
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
        $pre = array();
        $isEdit = false;
        $pid = 0;
        $patient_id = 0;
        if(isset($_POST['edit_id']) && $_POST['edit_id'] != ""){
            $isEdit = true;
            $pid = $_POST['edit_id'];
            $this->db->select('patient_id');
            $this->db->where('id',$pid);
            $_pre = $this->db->get('hms_prescription');
            $_pre = $_pre->row_array();
            $patient_id = isset($_pre['patient_id']) ? $_pre['patient_id'] : 0;
        }else{
            $pre['doctor_id'] = $this->auth->getDoctorid();
            $pre['patient_id'] = $_POST['patient_id'];
            $patient_id = $_POST['patient_id'];
            $pre['appoitment_id'] = $_POST['appt_id'];
            $pre['created_at'] = date("Y-m-d H:i:s");
        }
        if(isset($_POST['title']))
            $pre['title'] = $_POST['title'];
        if(isset($_POST['note']))
            $pre['note'] = $_POST['note'];
        
        if(!$isEdit){
            $this->db->insert('hms_prescription',$pre);
            $pid = $this->db->insert_id();
            $this->db->where('id',$pre['appoitment_id']);
            $this->db->update('hms_appoitments',array('status'=>3));
            $pre['patient_id']=$_POST['patient_id'];
            $this->notification->saveNotification($pre['patient_id'],"Some prescriptions are added in your profile ");
        }else{
            $this->db->where('id',$pid);
            $this->db->update('hms_prescription',$pre);
            $pre['patient_id']=$_POST['patient_id'];
            $this->notification->saveNotification($pre['patient_id'],"Your prescription information is updated");
        }
        $this->addPrescriptionItems($pid,$patient_id);
        $this->addMedicalReport($pid);
       
    }

    public function addPatient(){
        $uid = $this->auth->getDoctorId();
        $userid = $this->input->post('patient_id',null,0);
        $patientquery = $this->db->query('select * from hms_inpatient where user_id = '.$userid.'  and status in (0,1)');
        $checkpatient = $patientquery->result_array(); 
        if(count($checkpatient) > 0)
        {
            return 0;
        }
        else
        {
            $data =array(
                'user_id' =>$this->input->post('patient_id'), 
                'bed_id' => $this->input->post('Patientbed'),
                'doctor_id' => $uid,
                'appointment_id' => $this->input->post('appt_id'),
                'join_date' => date('Y-m-d', strtotime($this->input->post('join_date'))),
                'reason' => $this->input->post('inPatientReason'),
                'status'=>$this->input->post('ptStatus')
                );
            $this->db->insert('hms_inpatient',$data);

            // get patient name using user_id from user tbl
            $this->db->where('id', $data['user_id']);
            $pname = $this->db->get('hms_users')->row_array();
            // get department_id and doctor user_id using doctor_id
            $this->db->where('id', $uid);
            $doctor = $this->db->get('hms_doctors')->row_array();
            // get nurses which are linked with this $dept_id
            $nurses = $this->db->query("select user_id from hms_nurse where department_id = $doctor[department_id]")->result_array();
            // sent notification to nurse
            foreach ($nurses as $nurse){
                $this->notification->saveNotification($nurse['user_id'], "New patient <b>".$pname['first_name']." ".$pname['last_name']."</b> is added in Inpatient");
            }
            // sent notification to patient
            $this->notification->saveNotification($data['user_id'], "You added in Inpatient");

        }
    }

    public function UpdateInPatient(){
        $uid = $this->auth->getDoctorId(); 
        $id = $this->input->post('inpatient_update_id');
            $data =array(
                // 'id' => $this->input->post('inpatient_update_id'),
                'user_id' =>$this->input->post('patient_id'),
                'bed_id' => $this->input->post('Patientbed'),
                'doctor_id' => $uid,
                'join_date' => date('Y-m-d', strtotime($this->input->post('join_date'))),
                'reason' => $this->input->post('inPatientReason'),
                'status'=>$this->input->post('ptStatus')
                );
            $this->db->set($data);
            $this->db->where('id',$id);
            $this->db->update('hms_inpatient');
            // $this->db->replace('hms_inpatient', $data);

            // get patient name using user_id from user tbl
            $this->db->where('id', $data['user_id']);
            $pname = $this->db->get('hms_users')->row_array();
            // get department_id and doctor user_id using doctor_id
            $this->db->where('id', $uid);
            $doctor = $this->db->get('hms_doctors')->row_array();
            // get nurses which are linked with this $dept_id
            $nurses = $this->db->query("select user_id from hms_nurse where department_id = $doctor[department_id]")->result_array();
            // sent notification to nurse
            foreach ($nurses as $nurse){
                $this->notification->saveNotification($nurse['user_id'], "Inpatient history of patient <b>".$pname['first_name']." ".$pname['last_name']."</b> is updated");
            }
            // sent notification to patient
            $this->notification->saveNotification($data['user_id'], "Your Inpatient history is updated");
    }

    function addMedicalReport($pid=0){
        if(!isset($_POST['mr_tit']))
            return;

        for($i=0; $i<count($_POST['mr_tit']); $i++){
            $item['title'] = $_POST['mr_tit'][$i];
            $item['description'] = $_POST['mr_des'][$i];
            $item['patient_id'] = $_POST['patient_id'];
            $item['doctor_id'] = $this->auth->getDoctorid();
            $item['prescription_id'] = $pid;
            $item['created_at'] = date('Y-m-d H:i:s');
            if(isset($_POST['item_id'][$i]) && $_POST['item_id'][$i]!=""){
                $this->db->where('id',$_POST['item_id'][$i]);
                $this->db->update('hms_medical_report',$item);
            }else{
                $this->db->insert('hms_medical_report',$item);
            }
        }
    }

    function addPrescriptionItems($pid=0,$patient_id=0){
        //print_r($_POST['quantity']);
        //exit();
        for($i=0; $i<count($_POST['item_id']); $i++){
            $item['drug'] = $_POST['drug'][$i];
            $item['strength'] = $_POST['strength'][$i];
            $item['dosage'] = $_POST['dosage'][$i];
            $item['duration'] = $_POST['duration'][$i];
            $item['qty'] = $_POST['quantity'][$i];
            $item['note'] = $_POST['note'][$i];

            $item = $this->auth->my_encrypt_array($item,$patient_id);

            $item['prescription_id'] = $pid;
            if(isset($_POST['item_id'][$i]) && $_POST['item_id'][$i]!=""){
                $this->db->where('id',$_POST['item_id'][$i]);
                $this->db->update('hms_prescription_item',$item);
            }else{
                $this->db->insert('hms_prescription_item',$item);
            }
        }
    }

    function getPrescriptionIdFromApptid($appt=0){
        $this->db->where('appoitment_id',$appt);
        $this->db->where('isDeleted',0);
        $p = $this->db->get('hms_prescription');
        if($p){
            $p = $p->row_array();
            return isset($p['id']) ? $p['id'] : 0;
        }
        return 0;
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
        $pre['patient_contact'] = isset($patient['mobile']) ? $patient['mobile'] : '';
        $pre['patient_email'] = isset($patient['useremail']) ? $patient['useremail'] : '';
        $doc_id = isset($pre['doctor_id']) ? $pre['doctor_id'] : 0;
        $duid = $this->getMyUserId($doc_id);
        $this->db->where('id',$duid);
        $doctor = $this->db->get('hms_users');
        $doctor = $doctor->row_array();
        $doctor_name = "";
        $doctor_name = isset($doctor['first_name']) ? $doctor['first_name']." " : "";
        $doctor_name .= isset($doctor['last_name']) ? $doctor['last_name'] : "";
        $pre['doctor_name'] = $doctor_name;
        $pre['doctor_contact'] = isset($doctor['mobile']) ? $doctor['mobile'] : ''; 

        $hospital = $this->getMyHospital($doc_id);
        $pre['hospital_name'] = isset($hospital['name']) ? $hospital['name'] : '';
        $pre['hospital_address'] = isset($hospital['address']) ? $hospital['address'] : '';
        $pre['hospital_email'] =  isset($hospital['email']) ? $hospital['email'] : '';
        
        $this->db->where('prescription_id',$pid);
        $items = $this->db->get('hms_prescription_item');
        $items = $items->result_array();
        $pre['date'] = "-";
        if(isset($pre['created_at']))
            $pre['date'] = date("d-m-Y",strtotime($pre['created_at']));

        for($i=0; $i<count($items); $i++){
            $_item = $items[$i];
            $id = $_item['id'];unset($_item['id']);
            $prescription_id = $_item['prescription_id'];unset($_item['prescription_id']);
            $_item = $this->auth->my_decrypt_array($_item,$pre['patient_id']);
            $_item['prescription_id'] = $prescription_id;
            $_item['id'] = $id;
            $items[$i] = $_item;
        }

        $pre['items'] = $items;

        $this->db->where('prescription_id',$pid);
        $this->db->where('isDeleted',0);
        $reports = $this->db->get('hms_medical_report');
        $reports = $reports->result_array();
        for($i=0; $i<count($reports); $i++){
            $_rep = $reports[$i];
            $this->db->where("medical_report_id",$_rep['id']);
            $files = $this->db->get("hms_medical_report_file");
            $files = $files->result_array();
            $_rep['files'] = $files;
            $reports[$i] = $_rep;
        }
        $pre['reports'] = $reports;
        
        return $pre;
    }

    function getMyHospital($doc_id=0){
        $hospital = $this->db->query("select h.* from hms_doctors d,hms_departments t,hms_branches b,hms_hospitals h where d.id = $doc_id and d.department_id=t.id and t.branch_id=b.id and h.id=b.hospital_id");
        $hospital = $hospital->row_array();
        return $hospital;
    }
}
