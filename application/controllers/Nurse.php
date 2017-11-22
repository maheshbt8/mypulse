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
    public function department() {
        if($this->auth->isNurse()){
            $this->load->view('nurse/department');
        }
        else redirect('index/login');
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
        if($this->auth->isLoggedIn() && ($this->auth->isNurse() || $this->auth->isDoctor() )){
            if(isset($_POST['inpatient_update_id']) && $_POST['inpatient_update_id'] != ''){           
                $this->nurse_model->UpdateInPatient();
                $d['success'] = array($this->lang->line('msg_inpatien_updated'));
                $this->session->set_flashdata('data', $d);
                if($this->auth->isNurse())
                    redirect('nurse/inpatient');                 
                else
                    redirect('doctors/inpatient');
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
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isDoctor() || $this->auth->isHospitalAdmin())) {
            
            $hospital_id = $this->input->get('hid',null,null);
            $show  = $this->input->get('s',null,false);
            $cond = array("hms_nurse.isDeleted=0");
            if($this->auth->isHospitalAdmin()){
                $ids = $this->auth->getAllDepartmentsIds();
                $ids = implode(",", $ids);
                $cond[] = "hms_nurse.department_id in (".$ids.")";
            }else if($this->auth->isDoctor()){
                $did = $this->auth->getDoctorId();
                $dep_id = $this->doctors_model->getDepartmentId($did);
                $cond[] = "hms_nurse.department_id=".$dep_id;
            }else if($hospital_id!=null){
                $ids = $this->departments_model->getDepartmentIdsFromHospital($hospital_id);
                if(count($ids) == 0){
                    $ids[] = -1;
                }
                $ids = implode(",", $ids);
                $cond[] = "hms_nurse.department_id in (".$ids.")";
            }

            if($show){
                $this->datatables
                    ->showIndex(true)
                    ->from('hms_nurse')
                    ->select('hms_nurse.id as mainid, CONCAT(hms_users.first_name," ",hms_users.last_name) as nursename, hms_branches.branch_name as bname, hms_departments.department_name as dname, case when hms_nurse.isActive=1 THEN "'.$this->lang->line('active').'" when hms_nurse.isActive=0 THEN "'.$this->lang->line('inactive').'" end as status', false)
                    ->join('hms_users','hms_nurse.user_id = hms_users.id','left')
                    ->join('hms_departments','hms_nurse.department_id = hms_departments.id','left')
                    ->join('hms_branches','hms_departments.branch_id = hms_branches.id','left');

            }else if($this->auth->isDoctor()){
                $this->datatables
                    ->showIndex(true)
                    ->from('hms_nurse')
                    ->select('hms_nurse.id as mainid, CONCAT(hms_users.first_name," ",hms_users.last_name) as nursename, hms_hospitals.name as hname, hms_branches.branch_name as bname, hms_departments.department_name as dname', false)
                    ->join('hms_users','hms_nurse.user_id = hms_users.id','left')
                    ->join('hms_departments','hms_nurse.department_id = hms_departments.id','left')
                    ->join('hms_branches','hms_departments.branch_id = hms_branches.id','left')
                    ->join('hms_hospitals','hms_branches.hospital_id = hms_hospitals.id','left');
            }else{
                $this->datatables
                    ->showCheckbox(true)
                    ->from('hms_nurse')
                    ->select('hms_nurse.id as mainid, CONCAT(hms_users.first_name," ",hms_users.last_name) as nursename, hms_hospitals.name as hname, hms_branches.branch_name as bname, hms_departments.department_name as dname,case when hms_nurse.isActive=1 THEN "'.$this->lang->line('active').'" when hms_nurse.isActive=0 THEN "'.$this->lang->line('inactive').'" end as status, hms_nurse.id as action_nurse_id', false)
                    ->join('hms_users','hms_nurse.user_id = hms_users.id','left')
                    ->join('hms_departments','hms_nurse.department_id = hms_departments.id','left')
                    ->join('hms_branches','hms_departments.branch_id = hms_branches.id','left')
                    ->join('hms_hospitals','hms_branches.hospital_id = hms_hospitals.id','left')
                    ->add_column('edit', '<a href="#" id="dellink_$1" class="delbtn"  data-toggle="modal" data-target=".bs-example-modal-sm" data-id="$1" data-toggle="tooltip" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>', 'action_nurse_id')
                    ->edit_column('nursename', "<a href='#' data-id='$1' class='editbtn' data-toggle='modal' data-target='#edit' data-toggle='tooltip' title='Edit'>$2</a>", 'action_nurse_id, nursename')
                    ->unset_column('action_nurse_id');
            }

            //Set condition to new library
            foreach($cond as $con){
                $this->datatables->where($con);
            }
            //Call new library for output
            echo $this->datatables->generate('json');
        }
    }

    public function getDTPatient() {
        if ($this->auth->isLoggedIn() && ($this->auth->isNurse() || $this->auth->isDoctor())) {
            $uid = $this->auth->getuserid();   
            $patients_ids =  $this->nurse_model->getDoctorIds($uid);

            $st = isset($_GET['st']) ? $_GET['st']!="" ? intval($_GET['st']) : null : null;
			$join_sdate = isset($_GET['j_sd']) ? $_GET['j_sd'] != "" ? date("Y-m-d",strtotime($_GET['j_sd'])) : null : null;
            $join_edate = isset($_GET['j_ed']) ? $_GET['j_ed'] != "" ? date("Y-m-d",strtotime($_GET['j_ed'])) : null : null;
            $left_sdate = isset($_GET['l_sd']) ? $_GET['l_sd'] != "" ? date("Y-m-d",strtotime($_GET['l_sd'])) : null : null;
            $left_edate = isset($_GET['l_ed']) ? $_GET['l_ed'] != "" ? date("Y-m-d",strtotime($_GET['l_ed'])) : null : null;

            if($st !== null){
                $cond[] = "hms_inpatient.status=$st";
            }

            if($join_sdate != null && $join_edate != null){
                $cond[] = "DATE(hms_inpatient.join_date) between '$join_sdate' and '$join_edate'";
            }

            if($left_sdate != null && $left_edate != null){
                $cond[] = "DATE(hms_inpatient.left_date) between '$left_sdate' and '$left_edate'";
            }

            if(count($patients_ids) == 0){
                $patients_ids[] = '-1';
            }   
            $strpatient_ids = implode(',',$patients_ids);
            $cond[] = 'hms_inpatient.doctor_id in ('.$strpatient_ids.')';                                   
            $cond[] = 'hms_inpatient.status in (0,1)';

            //New Library
            $this->datatables
            ->showIndex(true)
            ->from('hms_inpatient')
            ->select('hms_inpatient.id as mainid, CONCAT(hms_users.first_name," ",hms_users.last_name) as pname, CONCAT(docuser.first_name," ",docuser.last_name) as docname, hms_inpatient.join_date as jdate, hms_inpatient.reason as reason, hms_beds.bed as bed, case when hms_inpatient.status=0 then "'.$this->lang->line('not_admitted').'" when hms_inpatient.status=1 then "'.$this->lang->line('admitted').'" when hms_inpatient.status=2 then "'.$this->lang->line('discharged').'" end as status, hms_inpatient.id as a_id, hms_inpatient.join_date as a_jd, hms_inpatient.user_id as a_uid, hms_inpatient.doctor_id as a_did, hms_inpatient.bed_id as a_bid, hms_inpatient.appointment_id as apt_id', false)
            ->join('hms_users','hms_inpatient.user_id = hms_users.id','left')
            ->join('hms_doctors','hms_inpatient.doctor_id = hms_doctors.id','left')
            ->join('hms_users as docuser','hms_doctors.user_id = docuser.id','left')
            ->join('hms_beds','hms_inpatient.bed_id = hms_beds.id','left')
            ->edit_column('pname', '<a href="'.site_url().'/nurse/patientRecord/$1" data-url="doctors/previewprescription/$2" data-id="$2" class="previewtem">$3</a>', 'apt_id, a_id, pname')
            ->add_column('edit', '<a href="javascript:void()" class="editinpatient" data-bname="$1" data-id="$2" data-bed_id="$3"  data-userid="$4" data-docid="$5" data-toggle="tooltip" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a> &nbsp <a href="#" id="Patient_$2" class="historyinpatient"  data-toggle="modal" data-target=".bs-example-modal-sm" data-id="$2" data-bno="$1" data-jdate="$6" data-status="$7" data-reason="$8" data-toggle="tooltip" title="Inpatient"><i class="fa fa-eye"></i></a>','bed, a_id, a_bid, a_uid, a_did, a_jd, status, reason')
            ->unset_column('a_id')
            ->unset_column('a_did')
            ->unset_column('a_uid')
            ->unset_column('a_bid')
            ->unset_column('a_jd')
            ->unset_column('apt_id');
              
            //Set condition to new library
            foreach($cond as $con){
                $this->datatables->where($con);
            }
            //Call new library for output
            echo $this->datatables->generate('json');

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

            if(!isset($_GET['order'])){
                $_GET['order'] = array(array('column'=>2,'dir'=>'DESC'));
            }
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

    public function getDTdepartments() {
        if ($this->auth->isLoggedIn()) {
            
            $cond = array("hms_departments.isDeleted=0");

            $dids = $this->departments_model->getDepartmentIds();
            if(count($dids) == 0 ){ $dids[] = -1; }

            $cond[] = 'hms_departments.id in ('.implode(',',$dids).')';

            //New Library
            $this->datatables
            ->showIndex(true)
            ->from('hms_departments')
            ->select('hms_departments.id as mainid, hms_branches.branch_name as bname, hms_departments.department_name as dname', false)
            ->join('hms_branches','hms_departments.branch_id = hms_branches.id','left');   
              
            //Set condition to new library
            foreach($cond as $con){
                $this->datatables->where($con);
            }

            //Call new library for output
            echo $this->datatables->generate('json');

        }
    }

    
}
