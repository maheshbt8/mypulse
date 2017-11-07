<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Inpatient extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('inpatient_model');
        $this->load->model("beds_model");
        $this->load->model('doctors_model');
        $this->load->model('patient_model');
        $this->load->model('wards_model');
        $this->load->model('hospitals_model');
    }
    public function index() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $data['inpatients'] = $this->inpatient_model->getAllinpatient();
            $data["page_title"] = "Inpatient";
            $data["breadcrumb"] = array(site_url() => "Home", null => "Inpatient");
            $this->load->view('Inpatient/index', $data);
        } else redirect('index/login');
    }
    public function search() {
        if ($this->auth->isLoggedIn()) {
            $q = $this->input->get("q", null, "");
            $f = $this->input->get("f", null, "");
            $result = $this->inpatient_model->search($q, $f);
            echo json_encode($result);
        }
    }
    public function add() {
        if ($this->auth->isLoggedIn()) {
            if ($this->inpatient_model->add()) {
                $data['success'] = array("Inpatient Added Successfully");
            } else {
                $data['errors'] = array("Please again later");
            }
            $this->session->set_flashdata('data', $data);
            redirect('inpatient/index');
        }
         else {
            redirect('index/login');
        }
    }
    public function add_note(){
        if($this->auth->isLoggedIn() && $this->auth->isDoctor()){
            $appt_id = $_POST['appt_id'];

            if(isset($_POST['hsinpatientEdit_id']) && $_POST['hsinpatientEdit_id'] != '' && $_POST['hsinpatientEdit_id'] != null)
            {
                $data = array(
                    'id' => $this->input->post('hsinpatientEdit_id'),
                    'in_patient_id' => $this->input->post('hsinpatientadd_id'),
                    'datetime' => date('Y-m-d H:i:s',time()),
                    'note' => $this->input->post('new_note')
                    );
                if ($this->inpatient_model->update_new_note($data)) {
                    $data['success'] = array("Inpatient  Note Updated Successfully");
                } else {
                    $data['errors'] = array("Please again later");
                }
                $this->session->set_flashdata('data', $data);
                redirect('doctors/patientRecord/'.$appt_id.'?p=2');
            }
            $data = array(
                'in_patient_id' => $this->input->post('hsinpatientadd_id'),
                'datetime' => date('Y-m-d H:i:s',time()),
                'note' => $this->input->post('new_note')
                );
            if ($this->inpatient_model->add_new_note($data)) {
                $data['success'] = array("Inpatient  Note Added Successfully");
            } else {
                $data['errors'] = array("Please again later");
            }
            $this->session->set_flashdata('data', $data);
            redirect('doctors/patientRecord/'.$appt_id.'?p=2');
            }
            else{
                redirect('index/login');
            }
        
    }

    public function add_noteByNurse(){
        print_r($_POST);
            if($this->auth->isLoggedIn() && $this->auth->isNurse()){

                if(isset($_POST['hsinpatientEdit_id']) && $_POST['hsinpatientEdit_id'] != '' && $_POST['hsinpatientEdit_id'] != null)
                {
                    $data = array(
                        'id' => $this->input->post('hsinpatientEdit_id'),
                        'in_patient_id' => $this->input->post('hsinpatientadd_id'),
                        'datetime' => date('Y-m-d H:i:s',time()),
                        'note' => $this->input->post('new_note')
                        );
                    if ($this->inpatient_model->update_new_note($data)) {
                        $data['success'] = array("Inpatient  Note Updated Successfully");
                    } else {
                        $data['errors'] = array("Please again later");
                    }
                    $this->session->set_flashdata('data', $data);
                    redirect('nurse/inpatient');
                }
                else
                {
                    $data = array(
                        'in_patient_id' => $this->input->post('hsinpatientadd_id'),
                        'datetime' => date('Y-m-d H:i:s',time()),
                        'note' => $this->input->post('new_note')
                        );
                    if ($this->inpatient_model->add_new_note($data)) {
                        $data['success'] = array("Inpatient  Note Added Successfully");
                    } else {
                        $data['errors'] = array("Please again later");
                    }
                    $this->session->set_flashdata('data', $data);
                    redirect('nurse/inpatient');
                }
            }
            else{
                redirect('index/login');
            }
        
    }

    public function update() {
        if ($this->auth->isLoggedIn()) {
            $data = array();
            $id = $this->input->post('eidt_gf_id');
            if ($this->inpatient_model->update($id)) {
                $data['success'] = array("Inpatient Updated Successfully");
            } else {
                $data['errors'] = array("Please again later");
            }
            $this->session->set_flashdata('data', $data);
            redirect('inpatient/index');
        } else redirect('index/login');
    }
    public function delete() {
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo $this->inpatient_model->delete($id);
        }
    }
    public function getinpatient() {
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo json_encode($this->inpatient_model->getinpatientById($id));
        }
    }

    public function getDTinpatient() {
        if ($this->auth->isLoggedIn()) {
            $this->load->library("tbl");
            $table = "hms_inpatient";
            $primaryKey = "id";
            $columns = array(array("db" => "user_id", "dt" => 0, "formatter" => function ($d, $row) {
                $this->load->model("users_model");
                $temp = $this->users_model->getusersById($d);
                return $this->auth->getUName($temp);
            }), array("db" => "user_id", "dt" => 1, "formatter" => function ($d, $row) {
                
                $hosp_name = $this->patient_model->getHospitalnameBybedId($row['user_id']);
                $hospitalName = '';
                if(isset($hosp_name['name']))
                {
                    $hospitalName = $hosp_name['name'];
                }    
                return $hospitalName;
            }), array("db" => "doctor_id", "dt" => 2, "formatter" => function ($d, $row) {
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
            }), array("db" => "join_date", "dt" => 3, "formatter" => function ($d, $row) {
                $l_date = $row['left_date'];
                $period = '';
                if($l_date == '' || $l_date == null){
                 $period = date("d-M",strtotime($d));   
                }
                else{
                 $period = date("d-M",strtotime($d)).' to '.date("d-M-Y",strtotime($l_date));   
                }
                return $period; 
            }), array("db" => "reason", "dt" => 4, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "bed_id", "dt" => 5, "formatter" => function ($d, $row) {
                
                $temp = $this->beds_model->getbedsById($d);
                return $temp["bed"];
            }), array("db" => "status", "dt" => 6, "formatter" => function ($d, $row) {
                return $this->auth->getInpatientStatus($d);
            }), array("db" => "id", "dt" => 7, "formatter" => function ($d, $row) {
                $bed = $this->beds_model->getbedsById($row['bed_id']);
                $bedName = "";
                if(isset($bed['bed']))
                    $bedName = $bed['bed'];
                $jdate = ($row['join_date'] == "" || $row['join_date'] == null) ? "-" : date("d-M-Y h:i A",strtotime($row['join_date']));
                $status = addslashes($this->auth->getInpatientStatus($row['status'],true));
                $reason = ($row['reason'] == "" || $row['reason'] == null) ? "-" : $row['reason'];
                $doc_id = $row['doctor_id'];
                $bed_id = $row['bed_id'];  
                $user_id = $row['user_id'];
                $ldate = ($row['left_date']== "" || $row['left_date']== null) ? "-" : date("d-M-Y h:i A",strtotime($row['left_date']));    
                return "<a href=\"#\" id=\"Patient_id\" class=\"historyinpatient\"  data-ldate='$ldate' data-id=\"$d\" data-bno='$bedName' data-jdate='$jdate' data-status='$status' data-reason='$reason' data-toggle=\"tooltip\" title=\"Inpatient\"><i class=\"fa fa-eye\"></i></a>";
            }));
            $this->tbl->setCheckboxColumn(false);                
            $this->tbl->setIndexColumn(true);
            
            $hids = $this->hospitals_model->getHospicalIds();
            $ids = $this->wards_model->getWardIdsFromHospital($hids);
            if(count($ids) == 0){
                //If no department created.
                //Add dummy id to return nothing
                $ids[] = -1;
            }
            $bids = $this->beds_model->getBedIdsFromWardId($ids);
            if(count($bids) == 0){
                //If no department created.
                //Add dummy id to return nothing
                $bids[] = -1;
            }
            $bids = implode(",",$bids);
            $cond = array();
            $cond[] = "id in (".$bids.")";
            $this->tbl->setTwID(implode(" AND ",$cond));

            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }

    public function getDTPatientinpatient($patient_id = 0) {
        if ($this->auth->isLoggedIn()) {
            $this->load->library("tbl");
            $table = "hms_inpatient";
            $primaryKey = "id";
            $columns = array(array("db" => "bed_id", "dt" => 0, "formatter" => function ($d, $row) {
                
                $temp = $this->beds_model->getbedsById($d);

                if(isset($temp["bed"])){
                 return $temp["bed"];    
                }                
                else
                {
                    return "-" ;
                }
            }), array("db" => "join_date", "dt" => 1, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : date("d-M-Y h:i A",strtotime($d));
            }), array("db" => "left_date", "dt" => 2, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : date("d-M-Y h:i A",strtotime($d));
            }), array("db" => "reason", "dt" => 3, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "status", "dt" => 4, "formatter" => function ($d, $row) {
                return $this->auth->getInpatientStatus($d);
            }),array("db" => "id", "dt" => 5, "formatter" => function ($d, $row) {
                $temp = $this->beds_model->getbedsById($row['bed_id']);
                $bedno = '-';

                if(isset($temp["bed"])){
                 $bedno =  $temp["bed"];    
                }                
               
               $jdate = ($row['join_date'] == "" || $row['join_date'] == null) ? "-" : date("d-M-Y h:i A",strtotime($row['join_date']));
               $status = addslashes($this->auth->getInpatientStatus($row['status'],true));
               $reason = ($row['reason'] == "" || $row['reason'] == null) ? "-" : $row['reason'];
                $ldate = ($row['left_date']== "" || $row['left_date']== null) ? "-" : date("d-M-Y h:i A",strtotime($row['left_date']));
                return "<a href=\"javascript:void()\" class=\"editinpatient\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Edit\"><i class=\"glyphicon glyphicon-pencil\"></i></a> &nbsp  <a href=\"javascript:void()\" class=\"historyinpatient\" data-id=\"$d\" data-bno='$bedno' data-jdate='$jdate' data-status='$status' data-reason='$reason' data-ldate='$ldate' data-toggle=\"tooltip\" title=\"History\"><i class=\"glyphicon glyphicon-th-list\"></i></a>";
            }));
            $this->tbl->setCheckboxColumn(false);                
            $this->tbl->setIndexColumn(true);
            $cond[] = "user_id = $patient_id";
            $this->tbl->setTwID(implode(" AND ",$cond));
            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host")); 
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }

    public function getDTHistoryinpatient($prf_id){

        if ($this->auth->isLoggedIn()) {
            $this->load->library("tbl");
            $table = "hms_inpatient_history";
            $primaryKey = "id";
            $columns = array(array("db" => "note", "dt" => 0, "formatter" => function ($d, $row) {
                return $d;
            }), array("db" => "datetime", "dt" => 1, "formatter" => function ($d, $row) {
                return date("d-M-Y h:i A",strtotime($d));
            }), array("db" => "id", "dt" => 2, "formatter" => function ($d, $row) {
                $hsEditnote = $row['note'];
                return "<a href=\"javascript:void()\" class=\"editinpatientHistory\" data-id=\"$d\" data-note=\"$hsEditnote\" data-toggle=\"modal\" data-target=\"#AddNewNote\" title=\"Edit\"><i class=\"glyphicon glyphicon-pencil\"></i></a>";
            }));
            $this->tbl->setCheckboxColumn(false);                
            $this->tbl->setIndexColumn(true);
            $cond[] = "in_patient_id = $prf_id";
            if($this->auth->isPatient()){
                unset($columns[2]);
            }
            $this->tbl->setTwID(implode(" AND ",$cond));           
            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host")); 
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
              
        }
    }
}
