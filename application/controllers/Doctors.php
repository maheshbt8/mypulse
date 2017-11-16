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
        $this->load->model('nurse_model');   
		$this->load->model('users_model');
		$this->load->model('beds_model');
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
        else if($this->auth->isLoggedIn() && $this->auth->isNurse()){
            $this->load->view('Doctors/nurse', $data);
        }
        else redirect('index/login');
    }
    public function nurse() {
        if ($this->auth->isLoggedIn()) {
            $this->load->view('Nurse/doctor');
        }
        else{
            redirect('index');
        }
    }

    public function receptionist() {
        if ($this->auth->isLoggedIn()) {
            $this->load->view('Receptionist/doctor');
        }
        else{
            redirect('index');
        }
    }

    public function patient(){
        if ($this->auth->isLoggedIn()) {
            $this->load->view('Patient/doctor');
        }
        else{
            redirect('index');
        }
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
            if(isset($_POST['edit_ri'])){
                $_POST['repeat_interval'] = $_POST['edit_ri'];
            }
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
  public function getinpatient($id){
           echo $id;
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
	public function recommendnextdate(){
		if($this->auth->isLoggedIn() && $this->auth->isDoctor()){
			$data['appointment_id'] = isset($_POST['appointment_id']) ? $_POST['appointment_id'] : 0;
			$data['recommend_appointment_date'] = isset($_POST['recommend_date']) ? date("Y-m-d",strtotime($_POST['recommend_date'])) : "";
			$data['user_id'] = isset($_POST['user_id']) ? $_POST['user_id'] : 0;
			$data['department_id'] = isset($_POST['department_id']) ? $_POST['department_id'] : 0;
			$data['doctor_id'] = isset($_POST['doctor_id']) ? $_POST['doctor_id'] : 0;
			if(isset($_POST['recommend_date']) && $_POST['recommend_date'] != "" ){
				$this->doctors_model->addRecommendNextDate($data);
				$d['success'] = array($this->lang->line('msg_recommendNextDate_added'));
				$this->session->set_flashdata('data', $d);
				redirect('doctors/patientRecord/'.$data['appointment_id']);	
			}else{
				$d['errors'] = array($this->lang->line('msg_recommendNextDate_error'));
				$this->session->set_flashdata('data', $d);
				redirect('doctors/patientRecord/'.$data['appointment_id']);	
			}
		}else{
            redirect('index/login');
        }
	}

    public function addinpatient(){
        if($this->auth->isLoggedIn() && $this->auth->isDoctor()){
            
			if(isset($_POST['inpatient_update_id']) && $_POST['inpatient_update_id'] != ''){
				$appt_id = $_POST['appt_id'];            
                $this->doctors_model->UpdateInPatient();
				$d['success'] = array($this->lang->line('msg_inpatien_updated'));
                $this->session->set_flashdata('data', $d);
                redirect('doctors/patientRecord/'.$appt_id.'?p=2');                 
            }
            else{
                $appt_id = $_POST['appt_id'];
                $message = $this->doctors_model->addPatient();
                if($this->doctors_model->addPatient() == 0){
                    $d['errors'] = array($this->lang->line('msg_inpatien_error'));
                    $this->session->set_flashdata('data', $d);
                    redirect('doctors/patientRecord/'.$appt_id.'?p=2');
                }else{
                    $d['success'] = array($this->lang->line('msg_inpatien_saved'));
                    $this->session->set_flashdata('data', $d);
                    redirect('doctors/patientRecord/'.$appt_id.'?p=2');    
                }
                
            }
        }else{
			exit;
            redirect('index/login');
        }
		exit;
    }
	
	public function inpatient(){
        if($this->auth->isLoggedIn() && ($this->auth->isDoctor())){
            $data["page_title"] = $this->lang->line('patients');
            $data["breadcrumb"] = array(site_url() => $this->lang->line('home'), null => $this->lang->line('patients'));
                $this->load->view('Doctors/inpatient',$data);
        }
        else{
            redirect('index/login');
        }
    }

    public function getDTdoctors() {
        if ($this->auth->isLoggedIn()) {
                        
            $hospital_id = $this->input->get('hid',null,null);
            $show  = $this->input->get('s',null,false);
            $cond = array("hms_doctors.isDeleted=0");
            
            if($this->auth->isReceptinest()){
                $show = true;
                $ids = $this->receptionist_model->getDoctorsIds();
                if(count($ids) == 0) { $ids[] = -1;}
                $ids = implode(",", $ids);
                $cond[] = "hms_doctors.id in (".$ids.")";
            }
            else if($this->auth->isNurse()){
                 $show = true;
                $ids = $this->nurse_model->getDepartmentIds();
                if(count($ids) == 0) { $ids[] = -1;}
                $ids = implode(",", $ids);
                $cond[] = "hms_doctors.department_id in (".$ids.")";
            }
            else if($this->auth->isHospitalAdmin()){
                $ids = $this->auth->getAllDepartmentsIds();
                $ids = implode(",", $ids);
                $cond[] = "hms_doctors.department_id in (".$ids.")";
            }else if($hospital_id!=null){
                $ids = $this->departments_model->getDepartmentIdsFromHospital($hospital_id);
                if(count($ids) == 0){
                    $ids[] = -1;
                }
                $ids = implode(",", $ids);
                $cond[] = "hms_doctors.department_id in (".$ids.")";
            }

            //New Library
            if($show && $this->auth->isReceptinest()){
                $this->datatables
                    ->showIndex(true)
                    ->from('hms_doctors')
                    ->select('hms_doctors.id as mainid, CONCAT(hms_users.first_name," ",hms_users.last_name) as docname, hms_branches.branch_name as bname, hms_departments.department_name as dname', false)
                    ->join('hms_users','hms_doctors.user_id = hms_users.id','left')
                    ->join('hms_departments','hms_doctors.department_id = hms_departments.id','left')
                    ->join('hms_branches','hms_departments.branch_id = hms_branches.id','left')
                    ->add_column('edit', '<span class="equalDivParent"><a style="margin-right:5px" href="'.site_url().'doctors/availability/$1"  class=""  data-toggle="tooltip" title="Availability"><i class="glyphicon glyphicon-calendar"></i></button></span>', 'hms_doctors.id');
           
            }else if($show && $this->auth->isNurse()){
                $this->datatables
                    ->showIndex(true)
                    ->from('hms_doctors')
                    ->select('hms_doctors.id as mainid, CONCAT(hms_users.first_name," ",hms_users.last_name) as docname, hms_branches.branch_name as bname, hms_departments.department_name as dname', false)
                    ->join('hms_users','hms_doctors.user_id = hms_users.id','left')
                    ->join('hms_departments','hms_doctors.department_id = hms_departments.id','left')
                    ->join('hms_branches','hms_departments.branch_id = hms_branches.id','left');

            }else{	
                $this->datatables
                    ->showCheckbox(true)
                    ->from('hms_doctors')
                    ->select('hms_doctors.id as mainid, CONCAT(hms_users.first_name," ",hms_users.last_name) as docname, hms_hospitals.name as hname, hms_branches.branch_name as bname, hms_departments.department_name as dname, case when hms_doctors.isActive=1 then "'.$this->lang->line('active').'" when hms_doctors.isActive=0 THEN "'.$this->lang->line('active').'" end as status', false)
                    ->join('hms_users','hms_doctors.user_id = hms_users.id','left')
                    ->join('hms_departments','hms_doctors.department_id = hms_departments.id','left')
                    ->join('hms_branches','hms_departments.branch_id = hms_branches.id','left')
                    ->join('hms_hospitals','hms_branches.hospital_id = hms_hospitals.id','left')
                    ->add_column('edit', '<span class="equalDivParent"><a style="margin-right:5px" href="'.site_url().'doctors/availability/$1"  class=""  data-toggle="tooltip" title="Availability"><i class="glyphicon glyphicon-calendar"></i></button> <a href="#" id="dellink_$1" class="delbtn"  data-toggle="modal" data-target=".bs-example-modal-sm" data-id="$1" data-toggle="tooltip" title="Delete"><i class="glyphicon glyphicon-remove"></i></button></span>', 'hms_doctors.id')
                    ->edit_column('docname', '<a href="#" data-id="$1" class="editbtn" data-toggle="modal" data-target="#edit" data-toggle="tooltip" title="Edit">$2</a>','hms_doctors.id, docname');
            }
            
            //Set condition to new library
            foreach($cond as $con){
                $this->datatables->where($con);
            }
            //Call new library for output
            echo $this->datatables->generate('json');
        }
    }

    public function getprescription($pid=0){
        if($this->auth->isLoggedin()){
            $prescription = $this->doctors_model->getPrescription($pid);
            echo json_encode($prescription);
        }
    }

    public function previewprescription($prescription_id = 0){
        $prescription = $this->doctors_model->getPrescription($prescription_id);
        $return['html'] = $this->load->view('template/prescription',array("data"=>$prescription),true);
        $btn = '';        
        $btn .= '<a href="#" class="btn btn-primary printtem" data-url="doctors/previewprescription/'.$prescription_id.'">Print</a>&nbsp;&nbsp;';
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
                $temp = $this->appoitments_model->getappoitmentsById($row['appoitment_id']);
                $did = isset($temp['doctor_id'] ) ? $temp['doctor_id'] : 0;
                if($did == $this->auth->getDoctorId()){
                    return "<a href=\"#\" class=\"editbtn1\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Edit\"><i class=\"glyphicon glyphicon-pencil\"></i></a>";
                }else if($this->auth->isPatient()){
                    return "<a href='#' class='btnup_receipt' data-id='$d' data-toggle='modal' data-target='#uploadReceipt'>Receipt</a>";
                }
                return "";
            }));
            
            $hospital_id = $this->input->get('hid',null,null);
            $show  = $this->input->get('s',null,false);
            $cond = array("isDeleted=0");
            $cond[] = "patient_id=".$pid;
          
            $this->tbl->setIndexColumn(true);
            $this->tbl->setCheckboxColumn(false);

            if(!isset($_GET['order'])){
                $_GET['order'] = array(array('column'=>3,'dir'=>'DESC'));
            }
            $this->tbl->setTwID(implode(' AND ',$cond));
            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }

	
	public function getDTInPatient() {
        if ($this->auth->isLoggedIn() && ( $this->auth->isDoctor())) {
  
            $st = isset($_GET['st']) ? $_GET['st']!="" ? intval($_GET['st']) : null : null;
			$join_sdate = isset($_GET['j_sd']) ? $_GET['j_sd'] != "" ? date("Y-m-d",strtotime($_GET['j_sd'])) : null : null;
            $join_edate = isset($_GET['j_ed']) ? $_GET['j_ed'] != "" ? date("Y-m-d",strtotime($_GET['j_ed'])) : null : null;
            $left_sdate = isset($_GET['l_sd']) ? $_GET['l_sd'] != "" ? date("Y-m-d",strtotime($_GET['l_sd'])) : null : null;
            $left_edate = isset($_GET['l_ed']) ? $_GET['l_ed'] != "" ? date("Y-m-d",strtotime($_GET['l_ed'])) : null : null;
            $cond = array("hms_inpatient.isDeleted = 0");
            
            if($st !== null){
                $cond[] = "hms_inpatient.status=$st";
            }

            if($join_sdate != null && $join_edate != null){
                $cond[] = "DATE(hms_inpatient.join_date) between '$join_sdate' and '$join_edate'";
            }

            if($left_sdate != null && $left_edate != null){
                $cond[] = "DATE(hms_inpatient.left_date) between '$left_sdate' and '$left_edate'";
            }

            //New Library
            $this->datatables
            ->showIndex(true)
            ->from('hms_inpatient')
            ->select('hms_inpatient.id as mainid, CONCAT(hms_users.first_name," ",hms_users.last_name) as pname, hms_inpatient.join_date as jdate, hms_inpatient.reason as reason, hms_beds.bed as bed, case when hms_inpatient.status=0 then "'.$this->lang->line('not_admitted').'" when hms_inpatient.status=1 then "'.$this->lang->line('admitted').'" when hms_inpatient.status=2 then "'.$this->lang->line('discharged').'" end as status, hms_inpatient.id as a_id, hms_inpatient.join_date as a_jd, hms_inpatient.user_id as a_uid, hms_inpatient.doctor_id as a_did, hms_inpatient.bed_id as a_bid', false)
            ->join('hms_users','hms_inpatient.user_id = hms_users.id','left')
            ->join('hms_beds','hms_inpatient.bed_id = hms_beds.id','left')
            ->add_column('edit','<a href="javascript:void()" class="editinpatient" data-bname="$1" data-id="$2" data-bed_id="$3"  data-userid="$4" data-docid="$5" data-toggle="tooltip" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a> &nbsp <a href="#" id="Patient_$2" class="historyinpatient"  data-toggle="modal" data-target=".bs-example-modal-sm" data-id="$2" data-bno="$1" data-jdate="$6" data-status="$7" data-reason="$8" data-toggle="tooltip" title="Inpatient"><i class="fa fa-eye"></i></a>','bed, a_id, a_bid, a_uid, a_did, a_jd, status, reason')
            ->unset_column('a_id')
            ->unset_column('a_did')
            ->unset_column('a_uid')
            ->unset_column('a_bid')
            ->unset_column('a_jd');
              
            //Set condition to new library
            foreach($cond as $con){
                $this->datatables->where($con);
            }
            //Call new library for output
            echo $this->datatables->generate('json');

        
        }
    }
	
}
