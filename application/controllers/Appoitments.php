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

    public function getDTappoitments() {
        if ($this->auth->isLoggedIn()) {
            $this->load->library("tbl");
            $table = "hms_appoitments";
            $primaryKey = "id";
            $columns = array(array("db" => "appoitment_number", "dt" => 0, "formatter" => function ($d, $row) {
                if($row['status'] == 3){
                    return "<a href='#' data-url='doctors/previewprescription/".$row['id']."' data-id='$row[id]' class='previewtem'>".$d."</a>";
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
                return "<a href=\"#\" id=\"dellink_".$d."\" class=\"delbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Cancel\"><i class=\"glyphicon glyphicon-remove\"></i></button>";
            }));

            $hid = isset($_GET['hid']) ? $_GET['hid']!="" ? intval($_GET['hid']) : null : null;
            $bid = isset($_GET['bid']) ? $_GET['bid']!="" ? intval($_GET['bid']) : null : null;
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
                return "<a href='#' data-id='$row[id]' class='editbtn' data-toggle='modal' data-target='#edit' data-toggle='tooltip' title='Edit'>".$d."</a>";
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
                if($row['status'] == 3){
                    return "-";
                }
                return "
                <span style='display:inline-flex'>
                <a href=\"#\" id=\"dellink_".$d."\" class=\"delbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Cancel\" style='color:red'><i class=\"glyphicon glyphicon-remove\"></i></button>

                <a href=\"#\" id=\"apprlink_".$d."\" class=\"apprbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Approve\" style='color:green;margin-left:10px'><i class=\"glyphicon glyphicon-ok\"></i></button>
                </span>
                ";
            }));

            $hid = isset($_GET['hid']) ? $_GET['hid']!="" ? intval($_GET['hid']) : null : null;
            $did = isset($_GET['did']) ? $_GET['did']!="" ? intval($_GET['did']) : null : null;
            $date = isset($_GET['d']) ? $_GET['d'] != "" ? date("Y-m-d",strtotime($_GET['d'])) : null : null;
            if($hid == "all")
                $hid = null;
            if($did == "all")
                $did = null;

            $show  = $this->input->get('s',null,false);
            $cond = array("isDeleted=0");

            if($date != null){
                $cond[] = "appoitment_date='$date'";
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
                return "<a href='".site_url()."/doctors/patientRecord/".$row['id']."' >".$d."</a>";
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
            }));

            $hid = isset($_GET['hid']) ? $_GET['hid']!="" ? intval($_GET['hid']) : null : null;
            $bid = isset($_GET['bid']) ? $_GET['bid']!="" ? intval($_GET['bid']) : null : null;
            $status = isset($_GET['status']) ? intval($_GET['status']) : -1;
            
            if($hid == "all")
                $hid = null;
                
            $show  = $this->input->get('s',null,false);
            $cond = array("isDeleted=0");
            if($status > 0){
                $cond[] = "status = ".$status;
            }
            if($isToday===1){   
                $this->tbl->setCheckboxColumn(false);
                $this->tbl->setIndexColumn(true);
                $cond[] = "DATE(appoitment_date)='".date("Y-m-d")."'";
            }
            $cond[] = "doctor_id = ".$this->auth->getDoctorId();
            //echo "<pre>";
            //var_dump($cond);exit;
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