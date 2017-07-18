<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Doctors extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('doctors_model');
        $this->load->model("departments_model");
        $this->load->model("receptionist_model");
        $this->load->model("patient_model");
        $this->load->model("appoitments_model");
    }
    public function index() {
        $data["page_title"] =  $this->lang->line('doctors');
        $data["breadcrumb"] = array(site_url() =>  $this->lang->line('home'), null =>  $this->lang->line('doctors'));
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $this->load->view('Doctors/index', $data);
        } 
        else if($this->auth->isLoggedIn() && $this->auth->isReceptinest()){
            $this->load->view('Doctors/receptionist', $data);
        }
        else redirect('index/login');
    }
    public function search() {
        if ($this->auth->isLoggedIn()) {
            $q = $this->input->get("q", null, "");
            $f = $this->input->get("f", null, "");

            $did = $this->input->get("department_id",null,-1);
            $result = $this->doctors_model->search($q, $f,$did);
            echo json_encode($result);
        }
    }
    public function add() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $res = $this->doctors_model->add();
            $data = $this->auth->parseUserResult($res,$this->lang->line('msg_doctor_added'));
            $this->session->set_flashdata('data', $data);
            redirect('doctors/index');
        } else redirect('index/login');
    }
    public function update() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $id = $this->input->post('eidt_gf_id');
            $res = $this->doctors_model->update($id);
            $data = $this->auth->parseUserResult($res,$this->lang->line('msg_doctor_updated'));
            $this->session->set_flashdata('data', $data);
            redirect('doctors/index');
        } else redirect('index/login');
    }
    public function delete() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $id = $this->input->post('id');
            echo $this->doctors_model->delete($id);
        }
    }
    public function getdoctors() {
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo json_encode($this->doctors_model->getdoctorsById($id));
        }
    }
    public function availability($did=0){
        if ($this->auth->isLoggedIn()
            &&(
                $this->auth->isSuperAdmin() || 
                $this->auth->isHospitalAdmin() || 
                $this->auth->isReceptinest() ||
                $this->auth->isDoctor()
            )
        ) {
            $doc_id= 0;
            if($this->auth->isDoctor()){
                $doc_id = $this->doctors_model->getDoctorIdFromUserId($this->auth->getUserid());
            }else{
                $doc_id = $did;
            }

            $data["page_title"] =  $this->lang->line('doctors');
            $data["breadcrumb"] = array(site_url() =>  $this->lang->line('home'), null =>  $this->lang->line('availability'));
            $data['doc_id'] = $doc_id;
            $s = $this->doctors_model->getSetting($doc_id);
            $data['no_appt_handle'] = isset($s['no_appt_handle']) ? $s['no_appt_handle'] : 5;
            $data['availabilityText'] = isset($s['availability_text']) ? $s['availability_text'] : "";
            $data['availabilty'] = $this->doctors_model->getAvailibaliryInterval($doc_id);
            if(isset($_POST['repeat_interval'])){
                $this->doctors_model->addAvailability($doc_id);
            }

            $this->load->view('Doctors/availability', $data);
        }else{
            redirect('index/login');
        }
    }

    public function deleteavalibality(){
        if ($this->auth->isLoggedIn() && ($this->auth->isReceptinest() || $this->auth->isDoctor() || $this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $id = $this->input->post('id');
            $isOne = $this->input->post('isOne',null,false);
            
            if($isOne=="true"){
                //Add Delete Entry;
                echo $this->doctors_model->deleteavalibalityForOne($id);
            }else{
                echo $this->doctors_model->deleteavalibality($id);
            }
        }
    }

    public function getAvailability($doid=0){
        if($this->auth->isLoggedIn()){
            $start = $_POST['start'];
            $end = $_POST['end'];
            $data = $this->doctors_model->getDoctorAvailabilties($doid,$start,$end);
            echo json_encode($data);exit;
        }
    }

    public function getAvailabilityById(){
        if($this->auth->isLoggedIn()){
            $id = $_GET['id'];
            $av = $this->doctors_model->getAvailabilityById($id);
            if(isset($av['start_date'])){
                $av['start_date'] = date("d-m-Y",strtotime($av['start_date']));
            }
            if(isset($av['end_date'])){
                $av['end_date'] = date("d-m-Y",strtotime($av['end_date']));
            }
            if(isset($av['start_time'])){
                $av['start_time'] = date("h:i A",strtotime($av['start_time']));
            }
            if(isset($av['end_time'])){
                $av['end_time'] = date("h:i A",strtotime($av['end_time']));
            }
            
            echo json_encode($av);
        }
    }

    public function getAvailabilityText(){
        if($this->auth->isLoggedIn()){
            $id = isset($_GET['id']) ? $_GET['id'] : 0;
            $s = $this->doctors_model->getSetting($id);
            $t = isset($s['availability_text']) ? $s['availability_text'] : "";
            echo $t;exit;
        }else{
            echo "";
        }
    }

    public function othersetting(){
        if($this->auth->isLoggedIn()){
            //$data["page_title"] =  $this->lang->line('doctors');
            //$data["breadcrumb"] = array(site_url() =>  $this->lang->line('home'), null =>  $this->lang->line('othersetting'));
            $doid = isset($_POST['eidt_gf_id']) ? $_POST['eidt_gf_id'] : 0;
            $this->doctors_model->updateSettings($doid);
            $d['success'] = array($this->lang->line('msg_setting_saved'));
            $this->session->set_flashdata('data', $d);
            redirect('doctors/availability/'.$doid);
        }
    }

    public function patientRecord($appoitment_id=0){
        if($this->auth->isLoggedIn() && $this->auth->isDoctor()){
            $data["page_title"] =  $this->lang->line('doctors');
            $data["breadcrumb"] = array(site_url() =>  $this->lang->line('home'), null =>  $this->lang->line('patientrecord'));
            $data['appoitment'] = $this->appoitments_model->getappoitmentsById($appoitment_id);
            $pid = $data['appoitment']['user_id'];
            $data['profile'] = $this->patient_model->getProfile($pid);
            $this->load->view('Doctors/patientrecord',$data);
        }else{
            redirect('index/login');
        }
    }

    public function newprescription(){
        if($this->auth->isLoggedIn() && $this->auth->isDoctor()){
            $appt_id = $_POST['appt_id'];
            $this->doctors_model->addPrescription();
            $d['success'] = array($this->lang->line('msg_prescriptioned_saved'));
            $this->session->set_flashdata('data', $d);
            redirect('doctors/patientRecord/'.$appt_id.'?p=1');
        }else{
            redirect('index/login');
        }
    }

    public function getDTdoctors() {
        if ($this->auth->isLoggedIn()) {
            $this->load->library("tbl");
            $table = "hms_doctors";
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

                $this->load->model("branches_model");
                $branch = $this->branches_model->getbranchesById($temp['branch_id']);
                if(!isset($branch['hospital_id']))
                    return "-";                    

                $this->load->model("hospitals_model");
                $hospital = $this->hospitals_model->gethospitalsById($branch['hospital_id']);
                if(!isset($hospital['name']))
                    return "-"; 

                return $hospital["name"];

            }), array("db" => "department_id", "dt" => 2, "formatter" => function ($d, $row) {
                $this->load->model("departments_model");
                $temp = $this->departments_model->getdepartmentsById($d);
                if(!isset($temp['branch_id']))
                    return "-";
                $this->load->model("branches_model");
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
                return "<span class='equalDivParent'><a style='margin-right:5px' href=\"".site_url()."/doctors/availability/".$d."\"  class=\"\"  data-toggle=\"tooltip\" title=\"Availability\"><i class=\"glyphicon glyphicon-calendar\"></i></button>
                <a href=\"#\" id=\"dellink_".$d."\" class=\"delbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Delete\"><i class=\"glyphicon glyphicon-remove\"></i></button></span>";
            }));
            
            $hospital_id = $this->input->get('hid',null,null);
            $show  = $this->input->get('s',null,false);
            $cond = array("isDeleted=0");
            
            if($this->auth->isReceptinest()){
                $show = true;
                $ids = $this->receptionist_model->getDoctorsIds();
                if(count($ids) == 0) { $ids[] = -1;}
                $ids = implode(",", $ids);
                $cond[] = "id in (".$ids.")";
            }
            else if($this->auth->isHospitalAdmin()){
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

                if($this->auth->isReceptinest()){
                    $columns[3] = array("db" => "id", "dt" => 3, "formatter" => function ($d, $row) {
                        return "<span class='equalDivParent'><a style='margin-right:5px' href=\"".site_url()."/doctors/availability/".$d."\"  class=\"\"  data-toggle=\"tooltip\" title=\"Availability\"><i class=\"glyphicon glyphicon-calendar\"></i></button></span>";
                    });
                }

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

    public function getprescription($pid=0){
        if($this->auth->isLoggedin()){
            $prescription = $this->doctors_model->getPrescription($pid);
            echo json_encode($prescription);
        }
    }

    public function previewprescription($apptid = 0){
        $pid = $this->doctors_model->getPrescriptionIdFromApptid($apptid);
        $prescription = $this->doctors_model->getPrescription($pid);
        $return['html'] = $this->load->view('template/prescription',array("data"=>$prescription),true);
        $btn = '';        
        $btn .= '<a href="#" class="btn btn-primary printtem" data-url="doctors/previewprescription/'.$pid.'">Print</a>&nbsp;&nbsp;';
        $return['btns'] = $btn;
        echo json_encode($return);
    }

    public function getDTPrescription($pid=0) {
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
                $temp = $this->appoitments_model->getappoitmentsById($d);
                $did = isset($temp['doctor_id'] ) ? $temp['doctor_id'] : 0;
                if($did== $this->auth->getDoctorId()){
                    return "<a href=\"#\" class=\"editbtn1\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Edit\"><i class=\"glyphicon glyphicon-pencil\"></i></a>";
                }
                return "-";
            }));
            
            $hospital_id = $this->input->get('hid',null,null);
            $show  = $this->input->get('s',null,false);
            $cond = array("isDeleted=0");
            $cond = array("patient_id=".$pid);
            
            $this->tbl->setIndexColumn(true);
            $this->tbl->setCheckboxColumn(false);

            
            $this->tbl->setTwID(implode(' AND ',$cond));
            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }
}
