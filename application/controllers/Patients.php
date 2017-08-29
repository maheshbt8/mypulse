<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Patients extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->model('patient_model');
        $this->load->model('doctors_model');
        $this->load->model('beds_model'); 
        $this->load->model('healthinsuranceprovider_model');
    }
    public function index() {
        if ($this->auth->isLoggedIn()) {
            if($this->auth->isPatient()){
                redirect('index');
            }else if($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin()){
                $data["page_title"] = "Patients";
                $data["breadcrumb"] = array(site_url() => "Home", null => "Patients");
                $this->load->view('Patient/index', $data);
            }
        } else redirect('index/login');
    }
     
    public function cancelPrescriptionOutOrder(){
        $presId = $_REQUEST['prescId'];
       echo $this->patient_model->canOutPrescptionOrder($presId); 
    
    }
    public function addplaceorder($id){
        $data["page_title"] = $this->lang->line('addplaceorder');
        $data["breadcrumb"] = array(site_url() => $this->lang->line('home'), null => $this->lang->line('addplaceorder'));
        $data['pres_data'] = $this->doctors_model->getPrescription($id);

        $this->db->where('id',$this->auth->getUserid());
        $user = $this->db->get('hms_users');
        $user = $user->row_array();
        $data['profile'] = $user;
        $data['profile']['country_name'] = $this->auth->getCountryName($user['country']);

        //$data['pres_data'] = $this->patient_model->addplaceorder($id);
        $this->load->view('patient/addplaceorder',$data);
    }

    public function placemedorder(){
        $patient_id = $this->auth->getUserId();
        $prec_id = isset($_POST['pid']) ? $_POST['pid'] : 0;
        $med_id = isset($_POST['medicalStore']) ? $_POST['medicalStore'] : 0;
        for($i=0; $i<count($_POST['qty']); $i++){
            $item_id = $_POST['item_id'][$i];
            $item['order_qty'] = $_POST['qty'][$i];
            $item = $this->auth->my_encrypt_array($item,$patient_id);   
            $this->patient_model->updateMedOrder($item_id,$item);
        }
        $this->patient_model->placeMedOrder($prec_id,$med_id);
        $data['success'] = array($this->lang->line('medOrderPlaced'));
        $this->session->set_flashdata('data', $data);
        redirect('index');
    }

    public function inpatient(){
        if($this->auth->isLoggedIn() && ($this->auth->isPatient())){
            $data["page_title"] = $this->lang->line('patients');
            $data["breadcrumb"] = array(site_url() => $this->lang->line('home'), null => $this->lang->line('patient'));
                $this->load->view('patient/patient',$data);
        }
        else{
            redirect('index/login');
        }
    }

    public function updateItemQuantity(){     
        $this->patient_model->Updateitemquantity();
        echo true;
    }

    public function profile(){
        if ($this->auth->isLoggedIn()) {
            $data['page_title'] = $this->lang->line('patients');
            $data['hip'] = $this->healthinsuranceprovider_model->getAllhealthinsuranceprovider();
            $data['breadcrumb'] = array(site_url()=>$this->lang->line('home'),null=>$this->lang->line('profile'));
            $data['profile'] = $this->patient_model->getProfile($this->auth->getUserid());
            $this->load->view('Patient/profile',$data);
        } else redirect('index/login');
    }

    public function add() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $res = $this->users_model->add();
            $data = $this->auth->parseUserResult($res,$this->lang->line('msg_user_added'));
            $this->session->set_flashdata('data', $data);
            redirect('Patients/index');
            
        } else redirect('index/login');
    }

    public function updatemyprofile(){
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('eidt_gf_id');
            if(isset($_POST['isDoc']) && $_POST['isDoc'] == 1){
                $this->patient_model->updateHealthData($id);
                $aid = $_POST['appt_id'];
                $data['success'] = array($this->lang->line('msg_patient_updated'));
                $this->session->set_flashdata('data', $data);
                redirect('doctors/patientRecord/'.$aid);
            }else{
                $res = $this->patient_model->update($id);
                $data = $this->auth->parseUserResult($res,$this->lang->line('msg_patient_updated'));
                $this->session->set_flashdata('data', $data);
                redirect('Patients/profile');
            }
        } else redirect('index/login');
    }

    public function selectml(){
        if($this->auth->isLoggedIn()){
            $this->patient_model->selectml();
            $data['success'] = array($this->lang->line('msg_patient_ml_saved'));
            $this->session->set_flashdata('data', $data);
            redirect('index');
        }else{
            redirect('index/login');
        }
    }

    public function update() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $data = array();
            $id = $this->input->post('eidt_gf_id');
            $res = $this->users_model->update($id);
            if($res === -1){
                $data['errors'] = array($this->lang->line('msg_email_exist'));
            }else if($res === false){
                $data['errors'] = array($this->lang->line('msg_try_again'));
            }else{
                $data['success'] = array($this->lang->line('msg_user_updated'));
            }
            $this->session->set_flashdata('data', $data);
            redirect('Patients/index');
        } else redirect('index/login');
    }


    public function getDTusers() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $this->load->library("tbl");
            $table = "hms_users";
            $primaryKey = "id";
            $columns = array(array("db" => "first_name", "dt" => 0, "formatter" => function ($d, $row) {
                $user = $this->users_model->getusersById($row['id']);
                $name = "";
                if(isset($user['first_name'])){
                    $name = $user['first_name'];
                }
                if(isset($user['last_name'])){
                    $name .= " ".$user['last_name'];
                }
                return $name;
            }), array("db" => "useremail", "dt" => 1, "formatter" => function ($d, $row) {
                return "<a href='#' data-id='$row[id]' class='editbtn' data-toggle='modal' data-target='#edit' data-toggle='tooltip' title='Edit'>".$d."</a>";
            }), array("db" => "isActive", "dt" => 2, "formatter" => function ($d, $row) {
               return $this->auth->getActiveStatus($d);
            }), array("db" => "id", "dt" => 3, "formatter" => function ($d, $row) {
                 return "<a href=\"#\" id=\"dellink_".$d."\" class=\"delbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Delete\"><i class=\"glyphicon glyphicon-remove\"></i></button>";
            }));

            if($this->auth->isHospitalAdmin()){

            }
            else{
            }
            $this->tbl->setTwID("role=".$this->auth->getPatientRoleType());
            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }

public function getDTPatient() {


        if ($this->auth->isLoggedIn() && ($this->auth->isPatient())) {
            $uid = $this->auth->getuserid();               
            $this->load->library("tbl");
            $table = "hms_inpatient";
            $primaryKey = "id";
            $columns = array(array("db" => "user_id", "dt" => 0, "formatter" => function ($d, $row) {
              
               $hosp_name = $this->patient_model->getHospitalnameBybedId($row['user_id']);
              $hospitalName = '';
            if(isset($hosp_name['name']))
            {
              $hospitalName = $hosp_name['name'];
            }    
             return $hospitalName;
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
                $l_date = $row['left_date'];
                $period = '';
                if($l_date == '' || $l_date == null){
                 $period = date("d-M",strtotime($d));   
                }
                else{
                 $period = date("d-M",strtotime($d)).' to '.date("d-M-Y",strtotime($l_date));   
                }
                return $period; 
            }), array("db" => "reason", "dt" => 3, "formatter" => function ($d, $row) {
                return $d;                     
            }), array("db" => "bed_id", "dt" => 4, "formatter" => function ($d, $row) {
                $bed = $this->beds_model->getbedsById($d);
                return $bedName = $bed['bed'];   
            }), array("db" => "status", "dt" => 5, "formatter" => function ($d, $row) {
                $status = $this->auth->getInpatientStatus($d);
                return $status;                     
            }), array("db" => "id", "dt" => 6, "formatter" => function ($d, $row) {
                $bed = $this->beds_model->getbedsById($row['bed_id']);
                $bedName = $bed['bed']; 
                $jdate = ($row['join_date'] == "" || $row['join_date'] == null) ? "-" : date("d-M-Y",strtotime($row['join_date']));
                $status = addslashes($this->auth->getInpatientStatus($row['status'],true));
                $reason = ($row['reason'] == "" || $row['reason'] == null) ? "-" : $row['reason'];
                $doc_id = $row['doctor_id'];
                $bed_id = $row['bed_id'];  
                $user_id = $row['user_id'];    
                return "<a href=\"#\" id=\"Patient_id\" class=\"historyinpatient\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-bno='$bedName' data-jdate='$jdate' data-status='$status' data-reason='$reason' data-toggle=\"tooltip\" title=\"Inpatient\"><i class=\"glyphicon glyphicon-log-in\"></i></a>";
            }));

            //$cond[] = 'doctor_id in ('.$strpatient_ids.')';                                   
            $cond[] = 'user_id ='.$uid; 
            $query =  $this->tbl->setTwID(implode(' AND ',$cond));            
            $this->tbl->setIndexColumn(true);
            $this->tbl->setCheckboxColumn(false);
            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }

}
?>