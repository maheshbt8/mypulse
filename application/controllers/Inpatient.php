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
            if($this->auth->isLoggedIn() && ($this->auth->isNurse() || $this->auth->isDoctor())){

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
                    if($this->auth->isNurse())
                        redirect('nurse/inpatient');
                    else
                        redirect('doctors/inpatient');
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
                    if($this->auth->isNurse())
                        redirect('nurse/inpatient');
                    else
                        redirect('doctors/inpatient');
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
            
            $st = isset($_GET['st']) ? $_GET['st']!="" ? intval($_GET['st']) : null : null;
			$join_sdate = isset($_GET['j_sd']) ? $_GET['j_sd'] != "" ? date("Y-m-d",strtotime($_GET['j_sd'])) : null : null;
            $join_edate = isset($_GET['j_ed']) ? $_GET['j_ed'] != "" ? date("Y-m-d",strtotime($_GET['j_ed'])) : null : null;
            $left_sdate = isset($_GET['l_sd']) ? $_GET['l_sd'] != "" ? date("Y-m-d",strtotime($_GET['l_sd'])) : null : null;
            $left_edate = isset($_GET['l_ed']) ? $_GET['l_ed'] != "" ? date("Y-m-d",strtotime($_GET['l_ed'])) : null : null;
            $cond = array("hms_inpatient.isDeleted=0");

            if($st !== null){
                $cond[] = "hms_inpatient.status=$st";
            }

            if($join_sdate != null && $join_edate != null){
                $cond[] = "DATE(hms_inpatient.join_date) between '$join_sdate' and '$join_edate'";
            }

            if($left_sdate != null && $left_edate != null){
                $cond[] = "DATE(hms_inpatient.left_date) between '$left_sdate' and '$left_edate'";
            }

            
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
            
            //$cond = array();
            $cond[] = "hms_inpatient.bed_id in (".$bids.")";

            //New Library
            $this->datatables
                ->showCheckbox(true)
                ->from('hms_inpatient')
                ->select('hms_inpatient.id as mainid, CONCAT(hms_users.first_name," ",hms_users.last_name) as pname, hms_hospitals.name as hname, CONCAT(docuser.first_name," ",docuser.last_name) as docname, CONCAT(hms_inpatient.join_date," to ",hms_inpatient.left_date) as date, hms_inpatient.reason as reason, hms_beds.bed as bed, case when hms_inpatient.status=0 then "'.$this->lang->line('not_admitted').'" when hms_inpatient.status=1 then "'.$this->lang->line('admitted').'" when hms_inpatient.status=2 then "'.$this->lang->line('discharged').'" end as status, hms_inpatient.id as a_id, hms_inpatient.join_date as a_jd, hms_inpatient.left_date as a_ld', false)
                ->join('hms_users','hms_inpatient.user_id = hms_users.id','left')
                ->join('hms_doctors','hms_inpatient.doctor_id = hms_doctors.id','left')
                ->join('hms_users as docuser','hms_doctors.user_id = docuser.id','left')
                ->join('hms_departments','hms_doctors.department_id = hms_departments.id','left')
                ->join('hms_branches','hms_departments.branch_id = hms_branches.id','left')
                ->join('hms_hospitals','hms_branches.hospital_id = hms_hospitals.id','left')
                ->join('hms_beds', 'hms_inpatient.bed_id = hms_beds.id','left')
                ->add_column('edit',"<a href='#' id='Patient_$1' class='historyinpatient'  data-ldate='$3' data-id='$1' data-bno='$6' data-jdate='$2' data-status='$4' data-reason='$5' data-toggle='tooltip' title='Inpatient'><i class='fa fa-eye'></i></a>", "a_id, a_jd, a_ld, status, reason, bed")
                ->unset_column('a_id')
                ->unset_column('a_jd')
                ->unset_column('a_ld');
                  
            //Set condition to new library
            foreach($cond as $con){
                $this->datatables->where($con);
            }
            //Call new library for output
            echo $this->datatables->generate('json');

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
            if(!isset($_GET['order'])){
                $_GET['order'] = array(array('column'=>3,'dir'=>'DESC'));
            }

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
