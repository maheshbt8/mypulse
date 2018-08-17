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
        $this->load->model('departments_model');
        $this->load->model('appoitments_model');   
        $this->load->model('receptionist_model');
        $this->load->model('medical_lab_model');
        $this->load->model('medical_store_model');
        $this->load->model('beds_model'); 
        $this->load->model("hospitals_model");
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
    public function report(){
        if($this->auth->isLoggedIn() && $this->auth->isSuperAdmin()){
            $data["page_title"] = $this->lang->line("reports");
            $data["breadcrumb"] = array(site_url() => $this->lang->line("home"), null => $this->lang->line("patient_report"));
            $data['reports'] = $this->patient_model->getReport();
            $this->load->view('Patient/report',$data);
        }else{
            redirect('index/login');
        }
    }
    public function getreportchart(){
        if($this->auth->isLoggedIn() && $this->auth->isSuperAdmin()){
            $data['data'] = $this->patient_model->getreportchart();
            echo json_encode($data);
        }
    }
	public function hareport(){
        if($this->auth->isLoggedIn() && $this->auth->isHospitalAdmin()){
            $data["page_title"] = $this->lang->line("reports");
            $data["breadcrumb"] = array(site_url() => $this->lang->line("home"), null => $this->lang->line("patient_report"));
            $data['hareports'] = $this->patient_model->getHAReport();
            $this->load->view('Patient/hareport',$data);
        }else{
            redirect('index/login');
        }
    }
	public function gethareportchart(){
        if($this->auth->isLoggedIn() && $this->auth->isHospitalAdmin()){
            $data['data'] = $this->patient_model->getHAreportchart();
            echo json_encode($data);
        }
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
        $this->load->view('Patient/addplaceorder',$data);
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
                $this->load->view('Patient/patient',$data);
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
            //echo "<pre>";var_dump($res);exit;
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

    public function hospital(){
        if($this->auth->isLoggedIn()){
            $this->load->view('Patient/hospital');
        }else{
            redirect('index');
        }
    }

    public function medicalstore(){
        if($this->auth->isLoggedIn()){
            $this->load->view('Patient/medicalstore');
        }else{
            redirect('index');
        }
    }

    public function medicallab(){
        if($this->auth->isLoggedIn()){
            $this->load->view('Patient/medicallab');
        }else{
            redirect('index');
        }
    }

    public function getDThospitals(){
        if ($this->auth->isLoggedIn() && $this->auth->isPatient()) {
            $this->load->library("tbl");
            $table = "hms_hospitals";
            $primaryKey = "id";
            $columns = array(array("db" => "name", "dt" => 0, "formatter" => function ($d, $row) {
                return $d;
            }), 
            array("db" => "address", "dt" => 1, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "phone_numbers", "dt" => 2, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }));

            $hids = $this->hospitals_model->getHospicalIds();
            if(count($hids) == 0) { $hids[] = -1;}
            $cond = array("id in (".implode(",",$hids).")");
            $this->tbl->setIndexColumn(true);
            $this->tbl->setCheckboxColumn(false);
            $this->tbl->setTwID(implode(' AND ',$cond));
            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }

    public function getDTmedical_lab(){
        if ($this->auth->isLoggedIn() && $this->auth->isPatient()) {
            $this->load->library("tbl");
            $table = "hms_medical_lab";
            $primaryKey = "id";
            $columns = array(array("db" => "name", "dt" => 0, "formatter" => function ($d, $row) {
                return $d;
            }), 
            array("db" => "address", "dt" => 1, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "phone_number", "dt" => 2, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }));

            $mids = $this->medical_lab_model->getMedLabIdsFromPatientId($this->auth->getUserid());
            if(count($mids) == 0) { $mids[] = -1;}
            $cond = array("id in (".implode(",",$mids).")");
            $this->tbl->setIndexColumn(true);
            $this->tbl->setCheckboxColumn(false);
            $this->tbl->setTwID(implode(' AND ',$cond));
            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }

    public function getDTmedical_store(){
        if ($this->auth->isLoggedIn() && $this->auth->isPatient()) {
            $this->load->library("tbl");
            $table = "hms_medical_store";
            $primaryKey = "id";
            $columns = array(array("db" => "name", "dt" => 0, "formatter" => function ($d, $row) {
                return $d;
            }), 
            array("db" => "address", "dt" => 1, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "phone_number", "dt" => 2, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }));

            $mids = $this->medical_store_model->getMedStoreIdsFromPatientId($this->auth->getUserid());
            if(count($mids) == 0) { $mids[] = -1;}
            $cond = array("id in (".implode(",",$mids).")");
            $this->tbl->setIndexColumn(true);
            $this->tbl->setCheckboxColumn(false);
            $this->tbl->setTwID(implode(' AND ',$cond));
            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }

    public function getDTusers() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isReceptinest() || $this->auth->isDoctor() || $this->auth->isHospitalAdmin())) {
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
                 return "";//"<a href=\"#\" id=\"dellink_".$d."\" class=\"delbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Delete\"><i class=\"glyphicon glyphicon-remove\"></i></button>";
            }));
            $cond = array("role=".$this->auth->getPatientRoleType());
            $this->tbl->setIndexColumn(true);
            $this->tbl->setCheckboxColumn(false);
            if($this->auth->isHospitalAdmin()){
                
                $dids = $this->departments_model->getDepartmentIds();
                $pids = $this->appoitments_model ->getPatientIdsFromDepartmentIds($dids);
                if(count($pids) == 0){ $pids[] = -1; }
                $cond[] = "id in (".implode(",",$pids).")";
            }
            else if($this->auth->isReceptinest() || $this->auth->isDoctor()){
                $this->tbl->setIndexColumn(true);
                $this->tbl->setCheckboxColumn(false);
                $did = array();
                if($this->auth->isReceptinest()){
                    $did = $this->receptionist_model->getDoctorsIds();
                }else{
                    $did = $this->auth->getDoctorId();
                }
                $pids = $this->patient_model->getPatientIdFromDoctorId($did);
                if(count($pids) == 0){ $pids[] = -1;}
                $cond[] = "id in (".implode(",",$pids).")";
                $columns[2] = array("db" => "mobile", "dt" => 2, "formatter" => function ($d, $row) {
                    return $d;
                });
                unset($columns[3]);
                /*$columns[3] = array("db" => "id", "dt" => 3, "formatter" => function ($d, $row) {
                    return "<a href='".site_url()."/doctors/patientRecord/".$d."'><i class='fa fa-list'></i></a>";
                });*/
            }

            $this->tbl->setTwID(implode(' AND ',$cond));
            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }

    public function getDTPatient() {


        if ($this->auth->isLoggedIn() && ($this->auth->isPatient())) {
            $uid = $this->auth->getuserid();
            $cond = array("hms_inpatient.isDeleted = 0");
            $cond[] = 'hms_inpatient.user_id ='.$uid; 

            //New Library
            $this->datatables
            ->showIndex(true)
            ->from('hms_inpatient')
            ->select('hms_inpatient.id as mainid, hms_hospitals.name as hname, CONCAT(hms_users.first_name," ",hms_users.last_name) as docname, CONCAT(hms_inpatient.join_date," to ",hms_inpatient.left_date) as date, hms_inpatient.reason as reason, hms_beds.bed as bed, case when hms_inpatient.status=0 then "'.$this->lang->line('not_admitted').'" when hms_inpatient.status=1 then "'.$this->lang->line('admitted').'" when hms_inpatient.status=2 then "'.$this->lang->line('discharged').'" end as status, hms_inpatient.id as a_id, hms_inpatient.join_date as a_jd, hms_inpatient.left_date as a_ld', false)
            ->join('hms_doctors','hms_inpatient.doctor_id = hms_doctors.id','left')
            ->join('hms_users','hms_doctors.user_id = hms_users.id','left')
            ->join('hms_departments','hms_doctors.department_id = hms_departments.id','left')
            ->join('hms_branches','hms_departments.branch_id = hms_branches.id','left')
            ->join('hms_hospitals','hms_branches.hospital_id = hms_hospitals.id','left')
            ->join('hms_beds','hms_inpatient.bed_id = hms_beds.id','left')
            ->add_column('edit', '<a href="#" id="Patient_$1" class="historyinpatient" data-toggle="modal" data-target=".bs-example-modal-sm" data-ldate="$2" data-id="$1" data-bno="$3" data-jdate="$4" data-status="$5" data-reason="$6" data-toggle="tooltip" title="Inpatient"><i class="glyphicon glyphicon-log-in"></i></a>', 'a_id, a_ld, bed, a_jd, status, reason')
            ->unset_column('a_id')
            ->unset_column('a_ld')
            ->unset_column('a_jd');
              
            //Set condition to new library
            foreach($cond as $con){
                $this->datatables->where($con);
            }
            //Call new library for output
            echo $this->datatables->generate('json');

        }
    }
	
public function doctors(){
		$data["page_title"] =  $this->lang->line('doctors');
        $data["breadcrumb"] = array(site_url() =>  $this->lang->line('home'), null =>  $this->lang->line('doctors'));
		$data["Specializations"] = $this->auth->AllSpecializations();
		if ($this->auth->isLoggedIn() && $this->auth->isPatient()) {
            $this->load->view('Patient/doctors', $data);
        }
	}
	
public function getDTdoctors() {
        if ($this->auth->isLoggedIn()) {
                        
            $hospital_id = $this->input->get('hid',null,null);
            $show  = $this->input->get('s',null,false);
            $cond = array("hms_doctors.isDeleted=0","hms_doctors.isActive=1","hms_hospitals.isActive=1");
            
                $this->datatables
                   // ->showCheckbox(true)
                    ->from('hms_doctors')
                    ->select('hms_doctors.id as mainid, CONCAT(hms_users.first_name," ",hms_users.last_name) as docname, hms_hospitals.name as hname, hms_branches.branch_name as bname, hms_departments.department_name as dname, case when hms_doctors.isActive=1 then "'.$this->lang->line('active').'" when hms_doctors.isActive=0 then "'.$this->lang->line('inactive').'" end as status, hms_doctors.id as edit_action_id', false)
                    ->join('hms_users','hms_doctors.user_id = hms_users.id','inner')
                    ->join('hms_departments','hms_doctors.department_id = hms_departments.id','left')
                    ->join('hms_branches','hms_departments.branch_id = hms_branches.id','left')
                    ->join('hms_hospitals','hms_branches.hospital_id = hms_hospitals.id','left');
					/*->add_column('edit', '<span class="equalDivParent"><a style="margin-right:5px" href="'.site_url().'doctors/availability/$1"  class=""  data-toggle="tooltip" title="Availability"><i class="glyphicon glyphicon-calendar"></i></button> <a href="#" id="dellink_$1" class="delbtn"  data-toggle="modal" data-target=".bs-example-modal-sm" data-id="$1" data-toggle="tooltip" title="Delete"><i class="glyphicon glyphicon-remove"></i></button></span>', 'edit_action_id')
					->edit_column('docname', '<a href="#" data-id="$1" class="editbtn" data-toggle="modal" data-target="#edit" data-toggle="tooltip" title="Edit">$2</a>','edit_action_id, docname')
					->unset_column('edit_action_id')*/
            //Set condition to new library
            foreach($cond as $con){
                $this->datatables->where($con);
            }
            //Call new library for output
            echo $this->datatables->generate('json');
        }
    }		

}
?>