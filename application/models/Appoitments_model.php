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

    function getReport(){
        $start_date = isset($_GET['sd']) ? date("Y-m-d",strtotime($_GET['sd'])) : date('Y-m-d',(strtotime ( '-29 day' , time() ) ));
        $end_date = isset($_GET['ed']) ? date("Y-m-d",strtotime($_GET['ed'])) : date("Y-m-d");
        if($start_date != "" && $end_date != ""){
            $qry = 'SELECT @s:=@s+1 as ind,COUNT(a.id) as count,h.name,h.id as hid FROM `hms_appoitments` a, (SELECT @s:= 0) AS s,hms_departments d,hms_branches b,hms_hospitals h where a.appoitment_date >= "'.$start_date.'" and a.appoitment_date <= "'.$end_date.'" and a.department_id=d.id and d.branch_id=b.id and b.hospital_id = h.id GROUP by h.id';
        }else if($start_date != ""){
            $qry = 'SELECT @s:=@s+1 as ind,COUNT(a.id) as count,h.name,h.id as hid FROM `hms_appoitments` a, (SELECT @s:= 0) AS s,hms_departments d,hms_branches b,hms_hospitals h where a.appoitment_date >= "'.$start_date.'" and a.department_id=d.id and d.branch_id=b.id and b.hospital_id = h.id GROUP by h.id';
        }else if($end_date != ""){
            $qry = 'SELECT @s:=@s+1 as ind,COUNT(a.id) as count,h.name,h.id as hid FROM `hms_appoitments` a, (SELECT @s:= 0) AS s,hms_departments d,hms_branches b,hms_hospitals h where a.appoitment_date <= "'.$end_date.'" and a.department_id=d.id and d.branch_id=b.id and b.hospital_id = h.id GROUP by h.id';
        }else{
            $qry = 'SELECT @s:=@s+1 as ind,COUNT(a.id) as count,h.name,h.id as hid FROM `hms_appoitments` a, (SELECT @s:= 0) AS s,hms_departments d,hms_branches b,hms_hospitals h where a.department_id=d.id and d.branch_id=b.id and b.hospital_id = h.id GROUP by h.id';
        }
        return $this->db->query($qry)->result_array();
    }

    function getreportchart(){
        $hid = isset($_GET['hid']) ? explode(",",$_GET['hid']) : 0;
        $start_date = isset($_GET['sd']) ? date("Y-m-d",strtotime($_GET['sd'])) : date('Y-m-d',(strtotime ( '-29 day' , time() ) ));
        $end_date = isset($_GET['ed']) ? date("Y-m-d",strtotime($_GET['ed'])) : date("Y-m-d");

        
        $date1 = new DateTime($start_date);
        $date2 = new DateTime($end_date);
        
        $days = $date2->diff($date1)->format("%a");
        $data = array();
        
        if($days < 30){
            //Date wise
            $temp = array();
            $period = new DatePeriod(
                new DateTime($start_date),
                new DateInterval('P1D'),
                new DateTime($end_date)
           );
           $_labls = array();
           foreach($period as $p){
               $_labls[] = $p->format("d-M");
           }
           $data['labels'] = $_labls;
           $data['title'] = $date1->format("d-M")." to ".$date2->format("d-M-Y");
           foreach($hid as $h){
               $this->db->where('id',$h);
               $this->db->select('name');
               $hres = $this->db->get('hms_hospitals')->row_array();
               $hname = isset($hres['name']) ? $hres['name'] : "Hospital";
               $_data = array();
               foreach($period as $d){
                    $qry = 'SELECT @s:=@s+1 as ind,COUNT(a.id) as count,h.name,h.id as hid FROM `hms_appoitments` a, (SELECT @s:= 0) AS s,hms_departments d,hms_branches b,hms_hospitals h where a.appoitment_date="'.$d->format("Y-m-d").'" and a.department_id=d.id and d.branch_id=b.id and b.hospital_id = h.id GROUP by h.id HAVING h.id='.$h;
                    $res = $this->db->query($qry)->row_array();
                    $_data[] = isset($res['count']) ? $res['count'] : 0;
               }
               $temp[] = array(
                   'label' => $hname,
                   'data' => $_data
               );
           }
           $data['data'] = $temp;
        }else if($days < 365){
            //Month Wise
            $temp = array();
            $period = new DatePeriod(
                new DateTime($start_date),
                new DateInterval('P1M'),
                new DateTime($end_date)
           );
           $_labls = array();
           foreach($period as $p){
               $_labls[] = $p->format("M");
           }
           $data['labels'] = $_labls;
           $data['title'] = $date1->format("M")." to ".$date2->format("M-Y");
           foreach($hid as $h){
               $this->db->where('id',$h);
               $this->db->select('name');
               $hres = $this->db->get('hms_hospitals')->row_array();
               $hname = isset($hres['name']) ? $hres['name'] : "Hospital";
               $_data = array();
               foreach($period as $d){
                    $qry = 'SELECT @s:=@s+1 as ind,COUNT(a.id) as count,h.name,h.id as hid FROM `hms_appoitments` a, (SELECT @s:= 0) AS s,hms_departments d,hms_branches b,hms_hospitals h where MONTH(a.appoitment_date)="'.$d->format("m").'" and a.department_id=d.id and d.branch_id=b.id and b.hospital_id = h.id GROUP by h.id HAVING h.id='.$h;
                    $res = $this->db->query($qry)->row_array();
                    $_data[] = isset($res['count']) ? $res['count'] : 0;
               }
               $temp[] = array(
                   'label' => $hname,
                   'data' => $_data
               );
           }
           $data['data'] = $temp;
        }else{
            //Year wise
            $temp = array();
            $period = new DatePeriod(
                new DateTime($start_date),
                new DateInterval('P1Y'),
                new DateTime($end_date)
           );
           $_labls = array();
           foreach($period as $p){
               $_labls[] = $p->format("Y");
           }
           $data['labels'] = $_labls;
           $data['title'] = $date1->format("Y")." to ".$date2->format("Y");
           foreach($hid as $h){
               $this->db->where('id',$h);
               $this->db->select('name');
               $hres = $this->db->get('hms_hospitals')->row_array();
               $hname = isset($hres['name']) ? $hres['name'] : "Hospital";
               $_data = array();
               foreach($period as $d){
                    $qry = 'SELECT @s:=@s+1 as ind,COUNT(a.id) as count,h.name,h.id as hid FROM `hms_appoitments` a, (SELECT @s:= 0) AS s,hms_departments d,hms_branches b,hms_hospitals h where YEAR(a.appoitment_date)="'.$d->format("Y").'" and a.department_id=d.id and d.branch_id=b.id and b.hospital_id = h.id GROUP by h.id HAVING h.id='.$h;
                    $res = $this->db->query($qry)->row_array();
                    $_data[] = isset($res['count']) ? $res['count'] : 0;
               }
               $temp[] = array(
                   'label' => $hname,
                   'data' => $_data
               );
           }
           $data['data'] = $temp;
        }
        return $data;
    }
	
	function getHAReport(){
        $start_date = isset($_GET['sd']) ? date("Y-m-d",strtotime($_GET['sd'])) : date('Y-m-d',(strtotime ( '-29 day' , time() ) ));
        $end_date = isset($_GET['ed']) ? date("Y-m-d",strtotime($_GET['ed'])) : date("Y-m-d");
        if($start_date != "" && $end_date != ""){
            $qry = 'SELECT @s:=@s+1 as ind,COUNT(a.id) as count,b.branch_name,b.id as bid FROM `hms_appoitments` a, (SELECT @s:= 0) AS s,hms_departments d,hms_branches b,hms_hospitals h where a.appoitment_date >= "'.$start_date.'" and a.appoitment_date <= "'.$end_date.'" and a.department_id=d.id and d.branch_id=b.id and b.hospital_id = h.id GROUP by b.id';
        }else if($start_date != ""){
            $qry = 'SELECT @s:=@s+1 as ind,COUNT(a.id) as count,b.branch_name,b.id as bid FROM `hms_appoitments` a, (SELECT @s:= 0) AS s,hms_departments d,hms_branches b,hms_hospitals h where a.appoitment_date >= "'.$start_date.'" and a.department_id=d.id and d.branch_id=b.id and b.hospital_id = h.id GROUP by b.id';
        }else if($end_date != ""){
            $qry = 'SELECT @s:=@s+1 as ind,COUNT(a.id) as count,b.branch_name,b.id as bid FROM `hms_appoitments` a, (SELECT @s:= 0) AS s,hms_departments d,hms_branches b,hms_hospitals h where a.appoitment_date <= "'.$end_date.'" and a.department_id=d.id and d.branch_id=b.id and b.hospital_id = h.id GROUP by b.id';
        }else{
            $qry = 'SELECT @s:=@s+1 as ind,COUNT(a.id) as count,b.branch_name,b.id as bid FROM `hms_appoitments` a, (SELECT @s:= 0) AS s,hms_departments d,hms_branches b,hms_hospitals h where a.department_id=d.id and d.branch_id=b.id and b.hospital_id = h.id GROUP by b.id';
        }
        return $this->db->query($qry)->result_array();
    }

    function getHAreportchart(){
        $bid = isset($_GET['bid']) ? explode(",",$_GET['bid']) : 0;
        $start_date = isset($_GET['sd']) ? date("Y-m-d",strtotime($_GET['sd'])) : date('Y-m-d',(strtotime ( '-29 day' , time() ) ));
        $end_date = isset($_GET['ed']) ? date("Y-m-d",strtotime($_GET['ed'])) : date("Y-m-d");

        
        $date1 = new DateTime($start_date);
        $date2 = new DateTime($end_date);
        
        $days = $date2->diff($date1)->format("%a");
        $data = array();
        
        if($days < 30){
            //Date wise
            $temp = array();
            $period = new DatePeriod(
                new DateTime($start_date),
                new DateInterval('P1D'),
                new DateTime($end_date)
           );
           $_labls = array();
           foreach($period as $p){
               $_labls[] = $p->format("d-M");
           }
           $data['labels'] = $_labls;
           $data['title'] = $date1->format("d-M")." to ".$date2->format("d-M-Y");
           foreach($bid as $b){
               $this->db->where('id',$b);
               $this->db->select('branch_name');
               $bres = $this->db->get('hms_branches')->row_array();
               $bname = isset($bres['branch_name']) ? $bres['branch_name'] : "Branch";
               $_data = array();
               foreach($period as $d){
                    $qry = 'SELECT @s:=@s+1 as ind,COUNT(a.id) as count,b.branch_name,b.id as bid FROM `hms_appoitments` a, (SELECT @s:= 0) AS s,hms_departments d,hms_branches b,hms_hospitals h where a.appoitment_date="'.$d->format("Y-m-d").'" and a.department_id=d.id and d.branch_id=b.id and b.hospital_id = h.id GROUP by b.id HAVING b.id='.$b;
                    $res = $this->db->query($qry)->row_array();
                    $_data[] = isset($res['count']) ? $res['count'] : 0;
               }
               $temp[] = array(
                   'label' => $bname,
                   'data' => $_data
               );
           }
           $data['data'] = $temp;
        }else if($days < 365){
            //Month Wise
            $temp = array();
            $period = new DatePeriod(
                new DateTime($start_date),
                new DateInterval('P1M'),
                new DateTime($end_date)
           );
           $_labls = array();
           foreach($period as $p){
               $_labls[] = $p->format("M");
           }
           $data['labels'] = $_labls;
           $data['title'] = $date1->format("M")." to ".$date2->format("M-Y");
           foreach($bid as $b){
               $this->db->where('id',$b);
               $this->db->select('branch_name');
               $bres = $this->db->get('hms_branches')->row_array();
               $bname = isset($bres['branch_name']) ? $bres['branch_name'] : "Branch";
               $_data = array();
               foreach($period as $d){
                    $qry = 'SELECT @s:=@s+1 as ind,COUNT(a.id) as count,b.branch_name,b.id as bid FROM `hms_appoitments` a, (SELECT @s:= 0) AS s,hms_departments d,hms_branches b,hms_hospitals h where MONTH(a.appoitment_date)="'.$d->format("m").'" and a.department_id=d.id and d.branch_id=b.id and b.hospital_id = h.id GROUP by b.id HAVING b.id='.$b;
                    $res = $this->db->query($qry)->row_array();
                    $_data[] = isset($res['count']) ? $res['count'] : 0;
               }
               $temp[] = array(
                   'label' => $bname,
                   'data' => $_data
               );
           }
           $data['data'] = $temp;
        }else{
            //Year wise
            $temp = array();
            $period = new DatePeriod(
                new DateTime($start_date),
                new DateInterval('P1Y'),
                new DateTime($end_date)
           );
           $_labls = array();
           foreach($period as $p){
               $_labls[] = $p->format("Y");
           }
           $data['labels'] = $_labls;
           $data['title'] = $date1->format("Y")." to ".$date2->format("Y");
           foreach($bid as $b){
               $this->db->where('id',$b);
               $this->db->select('branch_name');
               $bres = $this->db->get('hms_branches')->row_array();
               $bname = isset($bres['branch_name']) ? $bres['branch_name'] : "Branch";
               $_data = array();
               foreach($period as $d){
                    $qry = 'SELECT @s:=@s+1 as ind,COUNT(a.id) as count,b.branch_name,b.id as bid FROM `hms_appoitments` a, (SELECT @s:= 0) AS s,hms_departments d,hms_branches b,hms_hospitals h where YEAR(a.appoitment_date)="'.$d->format("Y").'" and a.department_id=d.id and d.branch_id=b.id and b.hospital_id = h.id GROUP by b.id HAVING b.id='.$b;
                    $res = $this->db->query($qry)->row_array();
                    $_data[] = isset($res['count']) ? $res['count'] : 0;
               }
               $temp[] = array(
                   'label' => $bname,
                   'data' => $_data
               );
           }
           $data['data'] = $temp;
        }
        return $data;
    }

    function getappoitmentsById($id) {
        $r = $this->db->query("select * from " . $this->tblname . " where id=$id and isDeleted=0");
        $r =  $r->row_array();
           if(count($r) == 0){
                  return 0;
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
        $r['user_name'] = "";
        if(isset($r['user_id'])){
            $this->db->select('id,first_name,last_name');
            $this->db->where('id',$r['user_id']);
            $u = $this->db->get('hms_users');
            $u = $u->row_array();
            $r['user_name'] = $this->auth->getUName($u);
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
        if(isset($r['appoitment_date']))
            $r['appoitment_date'] = date("d-m-Y",strtotime($r['appoitment_date']));
        $time_vl = "";
        $time_tx = "";
        $_st = "";
        $_et = "";
        if(isset($r['appoitment_time_start']))
            $_st= date("h:i A",strtotime($r['appoitment_time_start']));
        if(isset($r['appoitment_time_end']))    
            $_et= date("h:i A",strtotime($r['appoitment_time_end']));
        $time_vl = $_st."-".$_et;
        $time_tx = $_st." to ".$_et;
        $r['timesloat_val'] = $time_vl;
        $r['timesloat_txt'] = $time_tx;
        return $r;

    }
	
	function getrecommendappoitmentsById($id) {
        $r = $this->db->query("select * from hms_recommend_appointments where id=$id and isDeleted=0");
        $r =  $r->row_array();
        if(count($r) == 0){
			return 0;
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
        $r['user_name'] = "";
        if(isset($r['user_id'])){
            $this->db->select('id,first_name,last_name');
            $this->db->where('id',$r['user_id']);
            $u = $this->db->get('hms_users');
            $u = $u->row_array();
            $r['user_name'] = $this->auth->getUName($u);
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
        if(isset($r['recommend_appointment_date']))
            $r['recommend_appointment_date'] = date("d-m-Y",strtotime($r['recommend_appointment_date']));
        
        return $r;

    }

    function udpateremark(){
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        $r = isset($_POST['remark']) ? $_POST['remark'] : "";

        $this->db->where('id',$id);
        $this->db->update($this->tblname,array('remarks'=>$r));
		
		$this->logger->log("Appointment updated", Logger::Appointment, $id);
        
        if($id !=""){
            //get appointment data
            $this->db->where('id',$id);
            $appointment = $this->db->get($this->tblname)->row_array();
            //get receptionists which are linked with this->$appointment['doctor_id'] doctor
            $this->db->where('doc_id', $appointment['doctor_id']);
            $receptionists = $this->db->get('hms_receptionist')->result_array();
            //sent notification to patient
            $this->notification->saveNotification($appointment['user_id'], "Remark added in your appointment <b>".$appointment['appoitment_number']."</b>");
            foreach ($receptionists as $receptionist){
                //sent notification to receptionist
                $this->notification->saveNotification($receptionist['user_id'], "Remark added in appointment: <b>".$appointment['appoitment_number']."</b>");
            }
        }
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
        //echo "<pre>";
        //print_r($data);exit;
		date_default_timezone_set('Asia/Kolkata');
        
        if(isset($_POST['recommend_id']) && $_POST['recommend_id'] !=''){
            $recommend_id = $_POST['recommend_id'];
            $sql=$this->db->query("update hms_recommend_appointments set status=1 where id=".$_POST['recommend_id']);
        }
        unset($data['recommend_id']);
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
			$docid = $data['doctor_id'];
			$GetDocDepartmentID = $this->db->query("SELECT department_id FROM hms_doctors WHERE id=$docid ")->row();
			$DepartmentID = $GetDocDepartmentID->department_id;
			$data['department_id'] = $DepartmentID;
        }else{
            $data['user_id'] = intval($data['user_id']);
			$docid = $data['doctor_id'];
			$GetDocDepartmentID = $this->db->query("SELECT department_id FROM hms_doctors WHERE id=$docid ")->row();
			$DepartmentID = $GetDocDepartmentID->department_id;
			$data['department_id'] = $DepartmentID;
        }
		if ($this->db->insert($this->tblname, $data)) {
            $id = $this->db->insert_id();
			$this->logger->log("New appointment created", Logger::Appointment, $id);

            $this->db->where('id',$id);
            $apt_no ='APT'.$id;
            $this->db->update($this->tblname,array('appoitment_number'=> $apt_no));
			if($id){
				$HistoryData = array("AppointmentFKID"=>$id,
									 "Action"=>"Created",
									 "Reason"=>$data['reason'],
									 "Remark"=>$data['remarks'] ? $data['remarks'] : "",
									 "Message"=>"Appointment Created for ",
									 "AppointmentDate"=>date("Y-m-d H:i:s", strtotime($data["appoitment_date"])),
									 "AppointmentTimeStart"=>date('H:i',strtotime($tsloat[0])),
									 "AppointmentTimeEnd"=>date('H:i',strtotime($tsloat[1])),
									 "CreatedBy"=>$this->session->userdata('user_id'),
									 "CreatedDate"=>date('Y-m-d H:i:s'),
									 "ModifiedBy"=>$this->session->userdata('user_id'),
									 "ModifiedDate"=>date('Y-m-d H:i:s')
									 );
									 
					$HID = $this->db->insert('hms_appointment_history',$HistoryData);				 
			}
            if(!$this->auth->isPatient()){
                if(isset($data['user_id']) && $data['user_id'] != ""){
                    //sent notification to patient
                    $this->notification->saveNotification($data['user_id'],"Your appointment is booked.<br> Appointment number:<b> $apt_no </b>");
                }
            }

            if(isset($data['doctor_id']) && $data['doctor_id'] != ""){
                //find doctor user_id
                $this->db->where('id', $data['doctor_id']);
                $doctor = $this->db->get('hms_doctors')->row_array();
                //find receptionists which are linked with with this doctor
                $this->db->where('doc_id', $data['doctor_id']);
                $receptionists = $this->db->get('hms_receptionist')->result_array(); 
                
                if(!$this->auth->isPatient()){
                
                    if ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin()){
                        //sent notification to doctor
                        $this->notification->saveNotification($doctor['user_id'],"New appointment is booked.<br> Appointment number:<b> $apt_no </b>");
                        //sent notification to receptionist
                        foreach ($receptionists as $receptionist) {
                            $this->notification->saveNotification($receptionist['user_id'], "New appointment is booked.<br> Appointment number:<b> $apt_no </b>");
                        }
                    }elseif ($this->auth->isReceptinest()){
                        //sent notification to doctor
                        $this->notification->saveNotification($doctor['user_id'],"New appointment is booked.<br> Appointment number:<b> $apt_no </b>");
                    }elseif ($this->auth->isDoctor()){
                        //sent notification to receptionist
                        foreach ($receptionists as $receptionist) {
                            $this->notification->saveNotification($receptionist['user_id'], "New appointment is booked.<br> Appointment number:<b> $apt_no </b>");
                        }
                    }
                }else{
                    //sent notification to doctor
                    $this->notification->saveNotification($doctor['user_id'],"New appointment is booked.<br> Appointment number:<b> $apt_no </b>");
                    //sent notification to receptionist
                    foreach ($receptionists as $receptionist) {
                        $this->notification->saveNotification($receptionist['user_id'], "New appointment is booked.<br> Appointment number:<b> $apt_no </b>");
                    }
                
                }
            }
            return true;
        } else {
            return false;
        }
    }

    function update($id) {

        date_default_timezone_set('Asia/Kolkata');
		$data = $_POST;

        unset($data["eidt_gf_id"]);
        if (isset($data["appoitment_date"])) $data["appoitment_date"] = date("Y-m-d H:i:s", strtotime($data["appoitment_date"]));
        if (isset($data["status"])) $data["status"] = intval($data["status"]);
        if (isset($data['appoitment_sloat'])){
            $tsloat = $data['appoitment_sloat'];
            unset($data['appoitment_sloat']);
            $tsloat = explode('-',$tsloat);
            $data['appoitment_time_start'] = date('H:i',strtotime($tsloat[0]));
            $data['appoitment_time_end'] = date('H:i',strtotime($tsloat[1]));
        }
		
		if (isset($data["appoitment_date"]) && $tsloat){
				$this->db->where('id',$id);
				$apptdata = $this->db->get('hms_appoitments')->row();
				
				 $aptmntdate = date("Y-m-d", strtotime($data["appoitment_date"]));
				 $aptmntstart = date('H:i:s',strtotime($tsloat[0]));
				 $aptmntend = date('H:i:s',strtotime($tsloat[1]));
				 if(($apptdata->appoitment_date == $aptmntdate) && ($apptdata->appoitment_time_start == $aptmntstart)){
					$Message = "Appointment Updated ";
				}else{
					$Message = "Appointment rescheduled to  ";
				}
			}else{
				 $aptmntdate = '';
				 $aptmntstart = '';
				 $aptmntend =  '';
				 }
				 
        $this->db->where("id", $id);
        if ($this->db->update($this->tblname, $data)) {
            $this->logger->log("Appointment updated", Logger::Appointment, $id);
			
				if (isset($data["reason"])){ 
				$data["reason"] = $data['reason'];
				}else{
				$data['reason'] = "";
				}
				
				$HistoryData = array("AppointmentFKID"=>$id,
									 "Action"=>"Updated",
									 "Message"=>$Message,
									 "AppointmentDate"=>$aptmntdate,
									 "AppointmentTimeStart"=>$aptmntstart,
									 "AppointmentTimeEnd"=>$aptmntend,
									 "Remark"=>$data['remarks'],
									 "Reason"=>$data['reason'],
									 "CreatedBy"=>$this->session->userdata('user_id'),
									 "CreatedDate"=>date('Y-m-d H:i:s'),
									 "ModifiedBy"=>$this->session->userdata('user_id'),
									 "ModifiedDate"=>date('Y-m-d H:i:s'),
									 );
									 
					$HID = $this->db->insert('hms_appointment_history',$HistoryData);
				
            //get appt using $id;
            if(!$this->auth->isPatient()) {
                //find appoitment data
                $this->db->where("id", $id);
                $appointment = $this->db->get($this->tblname);
                $appointment = $appointment->row_array();
                //sent notification to patient
                $this->notification->saveNotification($appointment['user_id'], "Remark added in your appointment: <b>".$appointment['appoitment_number']."</b>");

                //find doctor user_id
                $this->db->where('id', $appointment['doctor_id']);
                $doctor = $this->db->get('hms_doctors')->row_array();
                //find receptionists which are linked with with this doctor
                $this->db->where('doc_id', $appointment['doctor_id']);
                $receptionists = $this->db->get('hms_receptionist')->result_array();

                if ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin()){
                    //sent notification to doctor
                    $this->notification->saveNotification($doctor['user_id'],"Remark added in appointment: <b>".$appointment['appoitment_number']."</b>");
                    //sent notification to receptionist
                    foreach ($receptionists as $receptionist) {
                        $this->notification->saveNotification($receptionist['user_id'], "Remark added in appointment: <b>".$appointment['appoitment_number']."</b>");
                    }
                }elseif ($this->auth->isReceptinest()){
                    //sent notification to doctor
                    $this->notification->saveNotification($doctor['user_id'],"Remark added in appointment: <b>".$appointment['appoitment_number']."</b>");
                }elseif ($this->auth->isDoctor()){
                    //sent notification to receptionist
                    foreach ($receptionists as $receptionist) {
                        $this->notification->saveNotification($receptionist['user_id'], "Remark added in appointment: <b>".$appointment['appoitment_number']."</b>");
                    }
                }
            }
            return true;
        } else {
            return false;
        }
    }

    function delete($id) {
        $this->db->where("id", $id);
        $d["isDeleted"] = 1;
        if ($this->db->update($this->tblname, $d)) {
            $this->logger->log("Appointment soft deleted", Logger::Appointment, $id);
            return true;
        } else return false;
    }
    
    function cancel($id)
    {
        if ($this->updateStatus($id, 4)) {
            $ids = array();
            if(is_array($id)){
                $ids = $id;
            }else{
                $ids[] = $id;
            }
            foreach($ids as $id)
                $this->logger->log("Appointment canceled", Logger::Appointment, $id);
            return true;
        }
        return false;
    }

    function reject($id)
    {
        if ($this->updateStatus($id, 2)) {
            $ids = array();
            if(is_array($id)){
                $ids = $id;
            }else{
                $ids[] = $id;
            }
            foreach($ids as $id)
                $this->logger->log("Appointment rejected", Logger::Appointment, $id);
            return true;
        }else{
            return false;
        }
    }

    function approve($id){
        if($this->updateStatus($id,1)){
            $ids = array();
            if(is_array($id)){
                $ids = $id;
            }else{
                $ids[] = $id;
            }
            foreach($ids as $id)
                $this->logger->log("Appointment approved", Logger::Appointment, $id);
            return true;
        }else{
            return false;
        }
    }

    function updateStatus($id,$status=0){
        $d["status"] = intval($status);
        if(is_array($id)){
            $this->db->where_in('id',$id);
        }else{
            $this->db->where("id", $id);
        }
        date_default_timezone_set('Asia/Kolkata');
        $today = date("Y-m-d");
        $this->db->where("appoitment_date >=", $today);

        if ($this->db->update($this->tblname, $d)) {
            //get appointment data
            $ids = array();
            if(is_array($id)){
                $ids = $id;
            }else{
                $ids[] = $id;
            }
            
            foreach($ids as $id){
                $apt = $this->db->query("select * from $this->tblname where id = $id")->row_array();
                if(isset($apt['id']) && $apt['id'] !=""){
                    $msg = $this->auth->getAppoitmentStatus($status,true);
                    //sent notification to patient
                    $this->notification->saveNotification($apt['user_id'],"Your appointment <b>".$apt['appoitment_number']."</b> has been ".$msg);
                    //find doctor user_id
                    $this->db->where('id', $apt['doctor_id']);
                    $doctor = $this->db->get('hms_doctors')->row_array();
                    //find  receptionists which are linked with with this doctor
                    $this->db->where('doc_id', $apt['doctor_id']);
                    $receptionists = $this->db->get('hms_receptionist')->result_array();

                    if($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin()){
                        //sent notification to doctor
                        $this->notification->saveNotification($doctor['user_id']," Appointment <b>".$apt['appoitment_number']."</b> has been ".$msg);
                        //sent notification to receptionist
                        foreach ($receptionists as $receptionist){
                            $this->notification->saveNotification($receptionist['user_id']," Appointment <b>".$apt['appoitment_number']."</b> has been ".$msg);
                        }
                    }elseif ($this->auth->isDoctor()){
                        //sent notification to receptionist
                        foreach ($receptionists as $receptionist){
                            $this->notification->saveNotification($receptionist['user_id']," Appointment <b>".$apt['appoitment_number']."</b> has been ".$msg);
                        }
                    }elseif ($this->auth->isReceptinest()){
                        //sent notification to doctor
                        $this->notification->saveNotification($doctor['user_id']," Appointment <b>".$apt['appoitment_number']."</b> has been ".$msg);
                    }

                }
            }
            return true;
        } else return false;
    }

    function isDoctorAvailable($doc_id=0,$date){
        $this->db->where('doctor_id',$doc_id);
        $this->db->where('status',0);
    }

    //For Patient
    function getTimeSloats($doc_id=0,$date){
		date_default_timezone_set('Asia/Kolkata');
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
		if($noAppt == 0)
			$noAppt = 1;
        $apptInterval = floor(30/$noAppt);

        //Get TimeSloats
        $timeSloats = array();
        foreach($data as $d){
            $end = $d['end'];
            $start = $d['start'];
            while($start <= $end){
                $s = $start;
                $start += 30 * 60;
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
		$CurrentTIme = date('H:i');
		$CurrentDay = date('d');
		$SelectedDay = date('d', strtotime($date));
		
        foreach($timeSloats as $slot){
		$slotstarttime = date('H:i',strtotime($slot['start']));
		//print_r($CurrentTIme);exit;
		if(($SelectedDay == $CurrentDay ) && ($slotstarttime > $CurrentTIme)){
            $st = strtotime($slot['start']);
            $et = strtotime($slot['end']);
            $mins = $et - $st;
            $mins = floor($mins/60);

            $tot_appt = floor($mins/$apptInterval);

            $this->db->where('doctor_id',$doc_id);
            $this->db->where('appoitment_date',$date);
            $this->db->where('appoitment_time_start',date('H:i:s',$st));
            $this->db->where('appoitment_time_end',date('H:i:s',$et));
            $this->db->where('status',1);
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
		  }elseif($SelectedDay > $CurrentDay ){
		  
            $st = strtotime($slot['start']);
            $et = strtotime($slot['end']);
            $mins = $et - $st;
            $mins = floor($mins/60);

            $tot_appt = floor($mins/$apptInterval);

            $this->db->where('doctor_id',$doc_id);
            $this->db->where('appoitment_date',$date);
            $this->db->where('appoitment_time_start',date('H:i:s',$st));
            $this->db->where('appoitment_time_end',date('H:i:s',$et));
            $this->db->where('status',1);
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
        }
        return $availableTimeSloats;
    }

    public function getPatientIdsFromDepartmentIds($id=0){
        $this->db->distinct();        
        $this->db->select("user_id");
        if(is_array($id)){
            if(count($id) == 0){ $id[] = -1; }
            $this->db->where_in('department_id',$id);
        }else{
            $this->db->where('department_id',$id);
        }
        $this->db->where('isDeleted',0);
        $appts = $this->db->get($this->tblname)->result_array();
        $ids = array();
        foreach($appts as $ap){
            $ids[] = $ap['user_id'];
        }
        return $ids;
    }
	
	public function cancelrecommendapptmt($id) {
        $this->db->where("id", $id);
        $d["isDeleted"] = 1;
        if ($this->db->update('hms_recommend_appointments', $d)) {
            $this->logger->log("Recommended Appointment deleted", Logger::Appointment, $id);
            return true;
        } else return false;
    }
}
