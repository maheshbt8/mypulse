<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Nurse extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('nurse_model');
        $this->load->model('receptionist_model');
        $this->load->model('departments_model');
        $this->load->model('branches_model');
        $this->load->model('doctors_model'); 
        $this->load->model('users_model');
        $this->load->model('hospitals_model');
        $this->load->model('beds_model');
        $this->load->model('appoitments_model');
        $this->load->model('patient_model');
    }
    public function index() {
        if($this->auth->isNurse()){
            redirect('index');
        }
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $data['nurses'] = $this->nurse_model->getAllnurse();
            $data["page_title"] = $this->lang->line('nurses');
            $data["breadcrumb"] = array(site_url() => $this->lang->line('home'), null => $this->lang->line('nurses'));
            $this->load->view('Nurse/index', $data);
        } else redirect('index/login');
    }
    public function beds() {
        if ($this->auth->isLoggedIn() && ($this->auth->isNurse())) {
            // $data['bedss'] = $this->beds_model->getAllbeds();
            $data["page_title"] = $this->lang->line('beds');
            $data["breadcrumb"] = array(site_url() => $this->lang->line('home'), null => $this->lang->line('beds'));
            $this->load->view('Nurse/beds', $data);
        } else redirect('index/login');
    }
    public function inpatient(){
        if($this->auth->isLoggedIn() && ($this->auth->isNurse())){
            $data["page_title"] = $this->lang->line('patients');
            $data["breadcrumb"] = array(site_url() => $this->lang->line('home'), null => $this->lang->line('patients'));
                $this->load->view('Nurse/patient',$data);
        }
        else{
            redirect('index/login');
        }
    }
    
    public function search() {
        if ($this->auth->isLoggedIn()) {
            $q = $this->input->get("q", null, "");
            $f = $this->input->get("f", null, "");
            $result = $this->nurse_model->search($q, $f);
            echo json_encode($result);
        }
    }
    public function addinpatient(){
        if($this->auth->isLoggedIn() && $this->auth->isNurse()){
            if(isset($_POST['inpatient_update_id']) && $_POST['inpatient_update_id'] != ''){           
                $this->nurse_model->UpdateInPatient();
                $d['success'] = array($this->lang->line('msg_inpatien_updated'));
                $this->session->set_flashdata('data', $d);
                redirect('nurse/inpatient');                 
            }
        }
    }
    public function add() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $res = $this->nurse_model->add();
            $data = $this->auth->parseUserResult($res,$this->lang->line('msg_nurse_added'));
            $this->session->set_flashdata('data', $data);
            redirect('nurse/index');
        } else redirect('index/login');
    }
    public function update() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $id = $this->input->post('eidt_gf_id');
            $res = $this->nurse_model->update($id);
            $data = $this->auth->parseUserResult($res,$this->lang->line('msg_nurse_updated'));
            $this->session->set_flashdata('data', $data);
            redirect('nurse/index');
        } else redirect('index/login');
    }
    public function delete() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $id = $this->input->post('id');
            echo $this->nurse_model->delete($id);
        }
    }
    public function getnurse() {
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo json_encode($this->nurse_model->getnurseById($id));
        }
    }

    public function patientRecord($appoitment_id=0){
        if($this->auth->isLoggedIn() && $this->auth->isNurse()){
            $data["page_title"] =  $this->lang->line('nurse');
            $data["breadcrumb"] = array(site_url() =>  $this->lang->line('home'), null =>  $this->lang->line('patientrecord'));
            $data['appoitment'] = $this->appoitments_model->getappoitmentsById($appoitment_id);  
                if(($data['appoitment']) == 0)
                {    
                    $d['success'] = array($this->lang->line('msg_inpatien_rec_error'));
                    $this->session->set_flashdata('data', $d);
                    redirect('nurse/inpatient',$data);                
                }                    
            $pid = $data['appoitment']['user_id'];
            $data['profile'] = $this->patient_model->getProfile($pid);
            $this->load->view('Nurse/patientrecord',$data);
        }else{
            redirect('index/login');
        }
    }
    public function getDTnurse() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $this->load->library("tbl");
            $table = "hms_nurse";
            $primaryKey = "id";
            $columns = array(array("db" => "user_id", "dt" => 0, "formatter" => function ($d, $row) {
                $this->load->model("users_model");
                $temp = $this->users_model->getusersById($d);
                $name = $temp["first_name"]." ".$temp["last_name"];
                return "<a href='#' data-id='$row[id]' class='editbtn' data-toggle='modal' data-target='#edit' data-toggle='tooltip' title='Edit'>".$name."</a>";
            }), array("db" => "department_id", "dt" => 1, "formatter" => function ($d, $row) {
                $temp = $this->departments_model->getdepartmentsById($d);
                if(!isset($temp['branch_id']))
                    return "-";
                $branch = $this->branches_model->getbranchesById($temp['branch_id']);
                if(!isset($branch['hospital_id']))
                    return "-";
                $hospital = $this->hospitals_model->gethospitalsById($branch['hospital_id']);
                 if(!isset($hospital['name']))
                    return "-";
                return $hospital["name"];
            }), array("db" => "department_id", "dt" => 2, "formatter" => function ($d, $row) {
                $temp = $this->departments_model->getdepartmentsById($d);
                 if(!isset($temp['branch_id']))
                    return "-";
                $branch = $this->branches_model->getbranchesById($temp['branch_id']);
                 if(!isset($branch['branch_name']))
                    return "-";
                return $branch["branch_name"];
            }), array("db" => "department_id", "dt" => 3, "formatter" => function ($d, $row) {
                $temp = $this->departments_model->getdepartmentsById($d);
                 if(!isset($temp['department_name']))
                    return "-";
                return $temp["department_name"];
            }),array("db" => "isActive", "dt" => 4, "formatter" => function ($d, $row) {
                return $this->auth->getActiveStatus($d);
            }), array("db" => "id", "dt" => 5, "formatter" => function ($d, $row) {
                return "<a href=\"#\" id=\"dellink_".$d."\" class=\"delbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Delete\"><i class=\"glyphicon glyphicon-remove\"></i></button>";
            }));
            

            $hospital_id = $this->input->get('hid',null,null);
            $show  = $this->input->get('s',null,false);
            $cond = array("isDeleted=0");
            if($this->auth->isHospitalAdmin()){
                $ids = $this->auth->getAllDepartmentsIds();
                $ids = implode(",", $ids);
                $cond[] = "department_id in (".$ids.")";
            }else if($hospital_id!=null){
                $ids = $this->departments_model->getDepartmentIdsFromHospital($hospital_id);
                if(count($ids) == 0){
                    $ids[] = -1;
                }
                $ids = implode(",", $ids);
                $cond[] = "department_id in (".$ids.")";
            }

            if($show){
                $this->tbl->setCheckboxColumn(false);
                $columns = array($columns[0],$columns[2],$columns[3],$columns[4]);
                $columns[0]["dt"] = 0;
                $columns[1]["dt"] = 1;
                $columns[2]['dt'] = 2;
                $columns[3]['dt'] = 3;
                $columns[0]['formatter'] =  function ($d, $row) {
                    $this->load->model("users_model");
                    $temp = $this->users_model->getusersById($d);
                    $name = $temp["first_name"]." ".$temp["last_name"];
                    return $name;
                };
                $this->tbl->setIndexColumn(true);
            }
            $this->tbl->setTwID(implode(' AND ',$cond));
            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }


  
    public function getDTPatient() {
        if ($this->auth->isLoggedIn() && ($this->auth->isNurse())) {
            $uid = $this->auth->getuserid();   
            $patients_ids =  $this->nurse_model->getDoctorIds($uid);
            
            $this->load->library("tbl");
            $table = "hms_inpatient";
            $primaryKey = "id";
            $columns = array(array("db" => "user_id", "dt" => 0, "formatter" => function ($d, $row) {
                $user = $this->users_model->getusersById($row['user_id']);
                $name = "";
                if(isset($user['first_name'])){
                    $name = $user['first_name'];
                }
                if(isset($user['last_name'])){
                    $name .= " ".$user['last_name'];
                }     
             return "<a href='".site_url()."/nurse/patientRecord/".$row['appointment_id']."' data-url='doctors/previewprescription/".$row['id']."' data-id='$row[id]' class='previewtem'>".$name."</a>";
            }), array("db" => "doctor_id", "dt" => 1, "formatter" => function ($d, $row) {
                $doctor = $this->doctors_model->getdoctorsById($d);  
                $user = $this->users_model->getusersById($doctor['user_id']);
                $name = "";
                if(isset($user['first_name'])){
                    $name = $user['first_name'];
                }
                if(isset($user['last_name'])){
                    $name .= " ".$user['last_name'];
                }
                return $name;
            }), array("db" => "join_date", "dt" => 2, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : date("d-M-Y",strtotime($d));                   
            }), array("db" => "reason", "dt" => 3, "formatter" => function ($d, $row) {
                return $d;                     
            }), array("db" => "bed_id", "dt" => 4, "formatter" => function ($d, $row) {
                $bed = $this->beds_model->getbedsById($d);
                if(isset($bed['bed']))
                    return $bedName = $bed['bed'];
                else
                    return "-";
            }), array("db" => "status", "dt" => 5, "formatter" => function ($d, $row) {
                $status = $this->auth->getInpatientStatus($d);
                return $status;                     
            }), array("db" => "id", "dt" => 6, "formatter" => function ($d, $row) {
                $bed = $this->beds_model->getbedsById($row['bed_id']);
                $bedName = "";
                if(isset($bed['bed']))
                    $bedName = $bed['bed'];
                $jdate = ($row['join_date'] == "" || $row['join_date'] == null) ? "-" : date("d-M-Y",strtotime($row['join_date']));
                $status = addslashes($this->auth->getInpatientStatus($row['status'],true));
                $reason = ($row['reason'] == "" || $row['reason'] == null) ? "-" : $row['reason'];
                $doc_id = $row['doctor_id'];
                $bed_id = $row['bed_id'];  
                $user_id = $row['user_id'];    
                return "<a href=\"javascript:void()\" class=\"editinpatient\" data-id=\"$d\" data-bed_id=\"$bed_id\"  data-userid=\"$user_id\" data-docid=\"$doc_id\" data-toggle=\"tooltip\" title=\"Edit\"><i class=\"glyphicon glyphicon-pencil\"></i></a> &nbsp <a href=\"#\" id=\"Patient_id\" class=\"historyinpatient\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-bno='$bedName' data-jdate='$jdate' data-status='$status' data-reason='$reason' data-toggle=\"tooltip\" title=\"Inpatient\"><i class=\"glyphicon glyphicon-log-in\"></i></a>";
            }));
            if(count($patients_ids) == 0){
                $patients_ids[] = '-1';
            }   
            $strpatient_ids = implode(',',$patients_ids);
            $cond[] = 'doctor_id in ('.$strpatient_ids.')';                                   
            $cond[] = 'status in (0,1)';
            $query =  $this->tbl->setTwID(implode(' AND ',$cond));            
            $this->tbl->setIndexColumn(true);
            $this->tbl->setCheckboxColumn(false);
            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }


     public function getDTPrescription($app_id) {     
        if ($this->auth->isLoggedIn()) {
            $this->load->library("tbl");
            $table = "hms_prescription";
            $primaryKey = "id";
            $columns = array(array("db" => "title", "dt" => 0, "formatter" => function ($d, $row) {
                return "<a href='#' data-url='doctors/previewprescription/".$row['id']."' data-id='$row[id]' class='previewtem'>".$d."</a>";
            }), array("db" => "appoitment_id", "dt" => 1, "formatter" => function ($d, $row) {
                $temp = $this->appoitments_model->getappoitmentsById($d);
                return isset($temp['doctor_name']) ? $temp['doctor_name'] : "-";
            }), array("db" => "appoitment_id", "dt" => 2, "formatter" => function ($d, $row) {
                $temp = $this->appoitments_model->getappoitmentsById($d);
                return isset($temp['appoitment_date']) ? date("d-M-Y",strtotime($temp['appoitment_date'])) : "-";
            }), array("db" => "appoitment_id", "dt" => 3, "formatter" => function ($d, $row) {
                $temp = $this->appoitments_model->getappoitmentsById($d);
                return isset($temp['remarks']) ? $temp['remarks'] : "-";
            }), array("db" => "id", "dt" => 4, "formatter" => function ($d, $row) {
                return "";
            }));
            
            $hospital_id = $this->input->get('hid',null,null);
            $show  = $this->input->get('s',null,false);
            $cond = array("isDeleted=0");
            $cond[] = "appoitment_id=".$app_id;
            
            $this->tbl->setIndexColumn(true);
            $this->tbl->setCheckboxColumn(false);

            
            $this->tbl->setTwID(implode(' AND ',$cond));
            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }

    public function getDTPReports($app_id){
        $pres_id = $this->patient_model->prescriptionByApp_id($app_id);
        if(count($pres_id) == 0 ){
            $pres_id[] = '-1';
        }
        $pres_ids = implode(',',$pres_id);

        if ($this->auth->isLoggedIn()) {
            $this->load->library("tbl");
            $table = "hms_medical_report";
            $primaryKey = "id";
            $columns = array(array("db" => "title", "dt" => 0, "formatter" => function ($d, $row) {
                return "<a href='#' class='btnup' data-id='$row[id]' data-toggle='modal' data-target='#uploadMR'>$d</a>";
            }), array("db" => "description", "dt" => 1, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "status", "dt" => 2, "formatter" => function ($d, $row) {
                if($d=="0"){
                    return '<span class="label label-info">Pending</span>';
                }else{
                    return '<span class="label label-success">Completed</span>';
                }
            }));
            $cond[] = "isDeleted=0";
            $cond[] = "prescription_id in (".$pres_ids.")";
            $this->tbl->setCheckboxColumn(false);
            $this->tbl->setIndexColumn(true);
            $this->tbl->setTwID(implode(' AND ',$cond));
            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }
}
