<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Appoitments extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('appoitments_model');
        $this->load->model('hospitals_model');
        $this->load->model("branches_model");
        $this->load->model("departments_model");
        $this->load->model("users_model");
        $this->load->model("doctors_model");
        $this->load->model("receptionist_model");
    }
    public function index() {
        $data["page_title"] = $this->lang->line("appoitments");
        $data["breadcrumb"] = array(site_url() => $this->lang->line("home"), null => $this->lang->line("appoitments"));
        if ($this->auth->isLoggedIn() && $this->auth->isPatient()) {    
            $this->load->view('Appoitments/index', $data);
        }
        else if($this->auth->isLoggedIn() && ($this->auth->isReceptinest() || $this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())){
            $this->load->view('Appoitments/receptionist', $data);
        }
        else if($this->auth->isLoggedIn() && $this->auth->isDoctor()){
            $this->load->view('Appoitments/doctor', $data);
        }
         else redirect('index/login');
    }
    public function report(){
        if($this->auth->isLoggedIn() && $this->auth->isSuperAdmin()){
            $data["page_title"] = $this->lang->line("reports");
            $data["breadcrumb"] = array(site_url() => $this->lang->line("home"), null => $this->lang->line("appoitment_report"));
            $data['reports'] = $this->appoitments_model->getReport();
            $this->load->view('Appoitments/report',$data);
        }else{
            redirect('index/login');
        }
    }
    public function getreportchart(){
        if($this->auth->isLoggedIn() && $this->auth->isSuperAdmin()){
            $data['data'] = $this->appoitments_model->getreportchart();
            echo json_encode($data);
        }
    }
	public function hareport(){
        if($this->auth->isLoggedIn() && $this->auth->isHospitalAdmin()){
            $data["page_title"] = $this->lang->line("reports");
            $data["breadcrumb"] = array(site_url() => $this->lang->line("home"), null => $this->lang->line("appoitment_report"));
            $data['hareports'] = $this->appoitments_model->getHAReport();
            $this->load->view('Appoitments/hareport',$data);
        }else{
            redirect('index/login');
        }
    }
    public function gethareportchart(){
        if($this->auth->isLoggedIn() && $this->auth->isHospitalAdmin()){
            $data['data'] = $this->appoitments_model->getHAreportchart();
            echo json_encode($data);
        }
    }
    public function search() {
        if ($this->auth->isLoggedIn()) {
            $q = $this->input->get("q", null, "");
            $f = $this->input->get("f", null, "");
            $result = $this->appoitments_model->search($q, $f);
            echo json_encode($result);
        }
    }
    public function add() {
        if ($this->auth->isLoggedIn()) {
            if ($this->appoitments_model->add()) {
                $data['success'] = array($this->lang->line("msg_appoitment_added"));
            } else {
                $data['errors'] = array($this->lang->line("msg_try_again"));
            }
            $this->session->set_flashdata('data', $data);
            redirect('appoitments/index');
        } else redirect('index/login');
    }
    public function update() {

        if ($this->auth->isLoggedIn()) {
            $data = array();
            $id = $this->input->post('eidt_gf_id');
            if ($this->appoitments_model->update($id)) {
                $data['success'] = array($this->lang->line("msg_appoitment_updated"));
            } else {
                $data['errors'] = array($this->lang->line("msg_try_again"));
            }
            $this->session->set_flashdata('data', $data);
            redirect('appoitments/index');
        } else redirect('index/login');
    }
    public function delete() {
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo $this->appoitments_model->delete($id);
        }
    }
    public function cancel() {
      
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo $this->appoitments_model->cancel($id);
        }
    }

    public function reject() {
      
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo $this->appoitments_model->reject($id);
        }
    }

    public function approve(){
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo $this->appoitments_model->approve($id);
        }
    }

    public function getappoitments() {
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo json_encode($this->appoitments_model->getappoitmentsById($id));
        }
    }

    public function getNewSloat(){
        if($this->auth->isLoggedIn()){
            
            $did = $_POST['did'];
            $date = date("Y-m-d",strtotime($_POST['date']));

            echo json_encode($this->appoitments_model->getTimeSloats($did,$date));exit;
        }
    }

    public function udpateremark(){
        if($this->auth->isLoggedIn()){
            echo json_encode($this->appoitments_model->udpateremark());exit;
        }
    }

    public function getDTappoitments() {
        if ($this->auth->isLoggedIn()) {
            $this->load->library("tbl");
            $table = "hms_appoitments";
            $primaryKey = "id";
            $columns = array(array("db" => "appoitment_number", "dt" => 0, "formatter" => function ($d, $row) {
                
                if($row['status'] == 3){
                    $prescription_id = $this->doctors_model->getPrescriptionIdFromApptid($row['id']);
                    return "<a href='#' data-url='doctors/previewprescription/".$prescription_id."' data-id='$row[id]' class='previewtem'>".$d."</a>";
                }else{
                    return "<a href='#' data-id='$row[id]' class='editbtn' data-toggle='modal' data-target='#edit' data-toggle='tooltip' title='Edit'>".$d."</a>";
                }
            }), array("db" => "department_id", "dt" => 1, "formatter" => function ($d, $row) {
                $dep = $this->departments_model->getdepartmentsById($d);
                $hos = $this->hospitals_model->gethospitalsById($dep['hospital_id']);
                $name = "";
                if(isset($hos['name']))
                    $name = $hos['name'];
                if(isset($dep['branch_name'])){
                    $name .= " - ".$dep['branch_name'];
                }
                return $name;
            }), array("db" => "doctor_id", "dt" => 2, "formatter" => function ($d, $row) {
                $dep = $this->departments_model->getdepartmentsById($d);
                return $dep['department_name'];
            }),array("db" => "doctor_id", "dt" => 3, "formatter" => function ($d, $row) {
                $d = $this->auth->getUserIdFromRoleId($d,$this->auth->getDoctorRoleType());
                $temp = $this->users_model->getusersById($d);
                $name = $temp["first_name"]." ".$temp["last_name"];
                return $name;
            }), array("db" => "appoitment_date", "dt" => 4, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : date("d-M-Y",strtotime($d));
            }), array("db" => "id", "dt" => 5, "formatter" => function ($d, $row) {
                $a = $this->appoitments_model->getappoitmentsById($d);
                return date('h:i A',strtotime($a['appoitment_time_start'])).' to '.date('h:i A',strtotime($a['appoitment_time_end']));
            }), array("db" => "status", "dt" => 6, "formatter" => function ($d, $row) {
                return $this->auth->getAppoitmentStatus($d);
            }), array("db" => "id", "dt" => 7, "formatter" => function ($d, $row) {
                if($row['status']==3)
                    return "";
                if($row['status']!=4)
                    return "<a href=\"#\" id=\"dellink_".$d."\" class=\"delbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" data-msg='".$this->lang->line('msg_want_to_cancel_appt')."' title=\"Cancel\"><i class=\"glyphicon glyphicon-remove\"></i></button>";
                return "";
            }));

            $hid = isset($_GET['hid']) ? $_GET['hid']!="" ? intval($_GET['hid']) : null : null;
            $bid = isset($_GET['bid']) ? $_GET['bid']!="" ? intval($_GET['bid']) : null : null;
            $sdate = isset($_GET['sd']) ? $_GET['sd'] != "" ? date("Y-m-d",strtotime($_GET['sd'])) : null : null;
            $edate = isset($_GET['ed']) ? $_GET['ed'] != "" ? date("Y-m-d",strtotime($_GET['ed'])) : null : null;
			
            if($hid == "all")
                $hid = null;
            $show  = $this->input->get('s',null,false);
            $cond = array("isDeleted=0");

            if($this->auth->isPatient()){
                $uid = $this->auth->getUserid();
                $cond[] = 'user_id='.$uid;
            }

            if($show){
                $this->tbl->setCheckboxColumn(false);
                $columns = array($columns[0],$columns[1],$columns[2],$columns[3]);
                $columns[0]['formatter'] = function ($d, $row) {
                    return $d;
                };
                
                $this->tbl->setIndexColumn(true);
            }

            $up = isset($_GET['up']) ? $_GET['up'] : false;
            if($up){
                $this->tbl->setIndexColumn(true);
                $this->tbl->setCheckboxColumn(false);
                $cond[] = "appoitment_date >= '".date("Y-m-d")."'";
                unset($columns[7]);
                $columns[0] = array("db" => "appoitment_number", "dt" => 0, "formatter" => function ($d, $row) {
                    return $d;
                });
            }else if($sdate != null && $edate != null){
                $cond[] = "appoitment_date between '$sdate' and '$edate'";
            }

            $isExport = isset($_GET['ex']) ? $_GET['ex'] : false;
            if($isExport){
                $this->tbl->setIndexColumn(true);
                $this->tbl->setCheckboxColumn(false);
                $columns[0] = array("db" => "appoitment_number", "dt" => 0, "formatter" => function ($d, $row) {
                    return $d;
                });
                $columns[6] = array("db" => "status", "dt" => 6, "formatter" => function ($d, $row) {
                    return $this->auth->getAppoitmentStatus($d,true);
                });
                $columns[7] = array("db" => "id", "dt" => 7, "formatter" => function ($d, $row) {
                    return "";
                });
            }

            $this->tbl->setTwID(implode(' AND ',$cond));

            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }

    public function getDTRespappoitments(){
        if ($this->auth->isLoggedIn()) {
            $this->load->library("tbl");
            $table = "hms_appoitments";
            $primaryKey = "id";
            $columns = array(array("db" => "appoitment_number", "dt" => 0, "formatter" => function ($d, $row) {
                if($row['status'] == 3){
                    $prescription_id = $this->doctors_model->getPrescriptionIdFromApptid($row['id']);
                    return "<a href='#' data-url='doctors/previewprescription/".$prescription_id."' data-id='$row[id]' class='previewtem'>".$d."</a>";
                }else{
                    return "<a href='#' data-id='$row[id]' class='editbtn' data-toggle='modal' data-target='#edit' data-toggle='tooltip' title='Edit'>".$d."</a>";
                }
                
            }), array("db" => "user_id", "dt" => 1, "formatter" => function ($d, $row) {
                $temp = $this->users_model->getusersById($d);
                $name = $temp["first_name"]." ".$temp["last_name"];
                return $name;
            }), array("db" => "department_id", "dt" => 2, "formatter" => function ($d, $row) {
                $dep = $this->departments_model->getdepartmentsById($d);
                $hos = $this->hospitals_model->gethospitalsById($dep['hospital_id']);
                $name = "";
                if(isset($hos['name']))
                    $name = $hos['name'];
                if(isset($dep['branch_name'])){
                    $name .= " - ".$dep['branch_name'];
                }
                return $name." - ".$dep['department_name'];
            }),array("db" => "doctor_id", "dt" => 3, "formatter" => function ($d, $row) {
                $temp = $this->users_model->getusersById($d);
                $name = $temp["first_name"]." ".$temp["last_name"];
                return $name;
            }), array("db" => "appoitment_date", "dt" => 4, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : date("d-M-Y",strtotime($d));
            }), array("db" => "id", "dt" => 5, "formatter" => function ($d, $row) {
                $a = $this->appoitments_model->getappoitmentsById($d);
                return date('h:i A',strtotime($a['appoitment_time_start'])).' to '.date('h:i A',strtotime($a['appoitment_time_end']));
            }), array("db" => "status", "dt" => 6, "formatter" => function ($d, $row) {
                return $this->auth->getAppoitmentStatus($d);
            }), array("db" => "id", "dt" => 7, "formatter" => function ($d, $row) {
                if($row['status'] == 3 || $row['status'] == 4){
                    return "-";
                }
                $html = "<span style='display:inline-flex'>";
                if($row['status'] != 2){
                    $html .= "<a href=\"#\" id=\"dellink_".$d."\" class=\"delbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Reject\" data-msg='".$this->lang->line('msg_want_to_reject_appt')."' style='color:red'><i class=\"glyphicon glyphicon-remove\"></i></button>";
                }
                if($row['status'] !=3){
                    $html .= "<a href=\"#\" id=\"apprlink_".$d."\" class=\"apprbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Approve\" data-msg='".$this->lang->line('msg_want_to_approve_appt')."' style='color:green;margin-left:10px'><i class=\"glyphicon glyphicon-ok\"></i></button>";
                }
                $html .= "</span>";
                return $html;
            }));
            
            $st = isset($_GET['st']) ? $_GET['st']!="" ? $_GET['st'] : null : null;
            $sc = isset($_GET['sc']) ? intval($_GET['sc']) : 0;
            $hid = isset($_GET['hid']) ? $_GET['hid']!="" ? $_GET['hid'] : null : null;
            $did = isset($_GET['did']) ? $_GET['did']!="" ? $_GET['did'] : null : null;
			$sdate = isset($_GET['sd']) ? $_GET['sd'] != "" ? date("Y-m-d",strtotime($_GET['sd'])) : null : null;
            $edate = isset($_GET['ed']) ? $_GET['ed'] != "" ? date("Y-m-d",strtotime($_GET['ed'])) : null : null;
            
            if($hid === "all")
                $hid = null;
            if($did === "all")
                $did = null;
            if($st === "all"){    
                $st = null;
            }
            

            $all_status = array(0,1,2,4);
            $status = array();
            if($st !== null){
                $status[] = $st;
            }else{
                $status = $all_status;
            }

            if($sc==1){
                $status[] = 3;
            }  

            $show  = $this->input->get('s',null,false);
            $cond = array("isDeleted=0");

            if($sdate != null && $edate != null){
                $cond[] = "appoitment_date between '$sdate' and '$edate'";
            }
            
            if(count($status) > 0){
                $cond[] = "status in (".implode(",",$status).")";
            }else{
                $cond[] = "status in (".implode(",",$all_status).")";
            }

            if($hid != null){
                $_dids = $this->departments_model->getDepartmentIdsFromHospital($hid);
                if(count($_dids) == 0){ $_dids[] = -1;}
                $_dids = implode(",",$_dids);
                $cond[] = "department_id in (".$_dids.")";
            }

            if($did != null){
                $cond[] = "doctor_id=$did";
            }
            else if($this->auth->isReceptinest()){
                $dids = $this->receptionist_model->getDoctorsIds();
                if(count($dids) == 0){ $dids[] = -1;}
                $dids = implode(",",$dids);
                $cond[] = "doctor_id in (".$dids.")";
            }else if($this->auth->isHospitalAdmin()){
                $dids = $this->doctors_model->getDoctorsIdsByHospital();
                if(count($dids) == 0){ $dids[] = -1;}
                $dids = implode(",",$dids);
                $cond[] = "doctor_id in (".$dids.")";
            }
			
			$isToday = isset($_GET['tod']) ? intval($_GET['tod']) : false;
			if($isToday && $isToday === 1){
				date_default_timezone_get("Asia/Kolkata");
				$cond[] = "appoitment_date='".date("Y-m-d")."'";
			}

            if($show){
                $this->tbl->setCheckboxColumn(false);
                $columns = array($columns[0],$columns[1],$columns[2],$columns[3]);
                $columns[0]['formatter'] = function ($d, $row) {
                    return $d;
                };
                
                $this->tbl->setIndexColumn(true);
            }
            $this->tbl->setTwID(implode(' AND ',$cond));

            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }    
    }

    public function getDTDocpappoitments(){
        if ($this->auth->isLoggedIn()) {
            $this->load->library("tbl");
            $table = "hms_appoitments";
            $primaryKey = "id";
            $isToday = isset($_GET['td']) ? intval($_GET['td']) : -1;
            $this->isT = $isToday;
            $columns = array(array("db" => "appoitment_number", "dt" => 0, "formatter" => function ($d, $row) {
                if($row['status'] == 3){
                    $prescription_id = $this->doctors_model->getPrescriptionIdFromApptid($row['id']);
                    return "<a href='#' data-url='doctors/previewprescription/".$prescription_id."' data-id='$row[id]' class='previewtem'>".$d."</a>";
                }else{
                    //return "<a href='#' data-id='$row[id]' class='editbtn' data-toggle='modal' data-target='#edit' data-toggle='tooltip' title='Edit'>".$d."</a>";
                    return "<a href='".site_url()."/doctors/patientRecord/".$row['id']."' >".$d."</a>";
                }
            }), array("db" => "user_id", "dt" => 1, "formatter" => function ($d, $row) {
                $temp = $this->users_model->getusersById($d);
                $name = $temp["first_name"]." ".$temp["last_name"];
                return $name;
            }), array("db" => "reason", "dt" => 2, "formatter" => function ($d, $row) {
                return $d;
            }),array("db" => "appoitment_date", "dt" => 3, "formatter" => function ($d, $row) {
                if($this->isT == 1){
                    $a = $this->appoitments_model->getappoitmentsById($row['id']);
                    return date('h:i A',strtotime($a['appoitment_time_start'])).' to '.date('h:i A',strtotime($a['appoitment_time_end']));
                }else{
                    return ($d == "" || $d == null) ? "-" : date("d-M-Y",strtotime($d));
                }
            }), array("db" => "id", "dt" => 4, "formatter" => function ($d, $row) {
                $a = $this->appoitments_model->getappoitmentsById($d);
                return date('h:i A',strtotime($a['appoitment_time_start'])).' to '.date('h:i A',strtotime($a['appoitment_time_end']));
            }),array("db" => "status", "dt" => 5, "formatter" => function ($d, $row) {
                return $this->auth->getAppoitmentStatus($d);
            }), array("db" => "id", "dt" => 6, "formatter" => function ($d, $row) {
                if($row['status'] == 3 || $row['status']=='4'){
                    if($row['status'] == 3){

                    }
                    return "<a href='".site_url()."/doctors/patientRecord/".$row['id']."' >".'Record'."</a>";
                }
                $html = "<span style='display:inline-flex'>";
                if($row['status'] != 2){
                    $html .= "<a href=\"#\" id=\"dellink_".$d."\" class=\"delbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" data-msg='".$this->lang->line('msg_want_to_reject_appt')."' title=\"Reject\" style='color:red'><i class=\"glyphicon glyphicon-remove\"></i></button>";
                }
                if($row['status'] !=3){
                    $html .= "<a href=\"#\" id=\"apprlink_".$d."\" class=\"apprbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" data-msg='".$this->lang->line('msg_want_to_approve_appt')."' title=\"Approve\" style='color:green;margin-left:10px'><i class=\"glyphicon glyphicon-ok\"></i></button>";
                }
                $html .=  "<a href='#' data-id='$row[id]' class='editbtn' data-toggle='modal' data-target='#edit' data-toggle='tooltip' title='Edit' style='margin-left:10px'><i class='fa fa-pencil'></i></a>";
                $html .= "</span>";
                return $html;
            }));

            $st = isset($_GET['st']) ? $_GET['st']!="" ? $_GET['st'] : null : null;
            $sc = isset($_GET['sc']) ? intval($_GET['sc']) : 0;
            $hid = isset($_GET['hid']) ? $_GET['hid']!="" ? $_GET['hid'] : null : null;
            $sdate = isset($_GET['sd']) ? $_GET['sd'] != "" ? date("Y-m-d",strtotime($_GET['sd'])) : null : null;
            $edate = isset($_GET['ed']) ? $_GET['ed'] != "" ? date("Y-m-d",strtotime($_GET['ed'])) : null : null;

            if($hid === "all")
                $hid = null;
            
            if($st === "all")    
                $st = null;

            $all_status = array(0,1,2,4);
            $status = array();
            if($st !== null){
                $status[] = $st;
            }else{
                $status = $all_status;
            }

            if($sc==1){
                $status[] = 3;
            }    

            $show  = $this->input->get('s',null,false);
            $cond = array("isDeleted=0");

			if($sdate != null && $edate != null){
                $cond[] = "appoitment_date between '$sdate' and '$edate'";
            }
        
            if(count($status) > 0){
                $cond[] = "status in (".implode(",",$status).")";
            }else{
                $cond[] = "status in (".implode(",",$all_status).")";
            }

            if($hid != null){
                $_dids = $this->departments_model->getDepartmentIdsFromHospital($hid);
                if(count($_dids) == 0){ $_dids[] = -1;}
                $_dids = implode(",",$_dids);
                $cond[] = "department_id in (".$_dids.")";
            }

            $isToday = isset($_GET['td']) ? intval($_GET['td']) : 0;
            if($isToday===1){   
                $this->tbl->setCheckboxColumn(false);
                $this->tbl->setIndexColumn(true);
                $cond[] = "DATE(appoitment_date)='".date("Y-m-d")."'";
                $columns[6] = array("db" => "id", "dt" => 6, "formatter" => function ($d, $row) {
                    if($row['status'] == 3 || $row['status']=='4'){
                        if($row['status'] == 3){

                        }
                        return "<a href='".site_url()."/doctors/patientRecord/".$row['id']."' >".'Record'."</a>";
                    }
                    $html = "<span style='display:inline-flex'>";
                    if($row['status'] != 2){
                        $html .= "<a href=\"#\" id=\"dellink_".$d."\" class=\"delbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" data-msg='".$this->lang->line('msg_want_to_reject_appt')."' title=\"Reject\" style='color:red'><i class=\"glyphicon glyphicon-remove\"></i></button>";
                    }
                    if($row['status'] !=3){
                        $html .= "<a href=\"#\" id=\"apprlink_".$d."\" class=\"apprbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" data-msg='".$this->lang->line('msg_want_to_approve_appt')."' title=\"Approve\" style='color:green;margin-left:10px'><i class=\"glyphicon glyphicon-ok\"></i></button>";
                    }
                    $html .= "</span>";
                    return $html;
                });
            }
            $cond[] = "doctor_id = ".$this->auth->getDoctorId();
            
            if($show){
                $this->tbl->setCheckboxColumn(false);
                $columns = array($columns[0],$columns[1],$columns[2],$columns[3]);
                $columns[0]['formatter'] = function ($d, $row) {
                    return $d;
                };
                
                $this->tbl->setIndexColumn(true);
            }
            $this->tbl->setTwID(implode(' AND ',$cond));

            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }    
    }

}
