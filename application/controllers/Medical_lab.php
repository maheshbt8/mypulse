<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Medical_lab extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('medical_lab_model');
        $this->load->model('hospitals_model');
        $this->load->model("branches_model");
        $this->load->model("users_model");
        $this->load->model("doctors_model");
    }
	public function patient(){
        if ($this->auth->isLoggedIn()) {
            $this->load->view('Medical_lab/patient');
        }
        else{
            redirect('index');
        }
    }
    public function index() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $data['medical_labs'] = $this->medical_lab_model->getAllmedical_lab();
            $data["page_title"] = $this->lang->line('medicalLabFull');
            $data["breadcrumb"] = array(site_url() => $this->lang->line('home'), null => $this->lang->line('medicalLabFull'));
            $this->load->view('Medical_lab/index', $data);
        } else redirect('index/login');
    }
    public function search() {
        if ($this->auth->isLoggedIn()) {
            $q = $this->input->get("q", null, "");
            $f = $this->input->get("f", null, "");
            $ci = $this->input->get('city',null,null);
            $result = $this->medical_lab_model->search($q, $f, $ci);
            echo json_encode($result);
        }
    }
    public function add() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $res = $this->medical_lab_model->add();
            $data = $this->auth->parseUserResult($res,$this->lang->line('msg_medlab_added'));
            $this->session->set_flashdata('data', $data);
            redirect('medical_lab/index');
        } else redirect('index/login');
    }
    public function update() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $id = $this->input->post('eidt_gf_id');
            $res = $this->medical_lab_model->update($id);
            $data = $this->auth->parseUserResult($res,$this->lang->line('msg_medlab_updated'));
            $this->session->set_flashdata('data', $data);
            redirect('medical_lab/index');
        } else redirect('index/login');
    }
    public function updateabout(){
        if ($this->auth->isLoggedIn() && $this->auth->isMedicalLab()){
            $id = $this->input->post('eidt_gf_id');
            $this->medical_lab_model->update($id);
            $data['success'] = array($this->lang->line('msg_medlab_updated'));
            $this->session->set_flashdata('data', $data);
            redirect('medical_lab/about');   
        }
        else redirect('index/login');   
    }
    public function about(){
        if ($this->auth->isLoggedIn()){
            $data["page_title"] = $this->lang->line('medicalLabFull');
            $data["breadcrumb"] = array(site_url() => $this->lang->line('home'), null => $this->lang->line('about'));
            $id = $this->medical_lab_model->getMyLabId();
            $data['about'] = $this->medical_lab_model->getmedical_labById($id);
            $this->load->view('Medical_lab/about',$data);
        }else{
            redirect('index/login');
        }
    }
    public function reports(){
        if ($this->auth->isLoggedIn()){
            $data["page_title"] = $this->lang->line('medicalLabFull');
            $data["breadcrumb"] = array(site_url() => $this->lang->line('home'), null => $this->lang->line('testreports'));
            
            $this->load->view('Medical_lab/reports',$data);
        }
    }
    public function removereportfile(){
        if ($this->auth->isLoggedIn()){
            $id = isset($_POST['id']) ? $_POST['id'] : 0;
            $this->medical_lab_model->deleteMedicalReportFile($id);
        }
    }
    public function getreportspreview($id){
        if ($this->auth->isLoggedIn()){
            $data = $this->medical_lab_model->getMedicalReportFiles($id);
            
            $urls = array();
            foreach($data as $d){
                $urls[] = array('url'=>$d['file_url'], 'id'=>$d['id']);
            }
            echo json_encode($urls);exit;
        }
    }
    public function uploadreport(){
       
        if ($this->auth->isLoggedIn()){
            $id = isset($_POST['id']) ? $_POST['id'] : 0;
			if(is_array($_FILES) && isset($_FILES['files'])) 
			{
                $urls = array();
                $paths = array();
                $types = array();
                for($i=0; $i<count($_FILES['files']['name']); $i++){
                    if(is_uploaded_file($_FILES['files']['tmp_name'][$i])) {
                        $sourcePath = $_FILES['files']['tmp_name'][$i];
                        $fname = time()."_".$id.".png";
                        $url = base_url()."/public/reports/".$fname;
                        $bash = dirname(APPPATH)."/public/reports/".$fname;
                        
                        if(move_uploaded_file($sourcePath,$bash)) {
                            $urls[$i] = $url;
                            $paths[$i] = $bash;
                            $types[$i] = $_FILES['files']['type'][$i];
                        }
                    }
                }
                $this->medical_lab_model->addReportUrl($id,$urls,$paths,$types);
                $data = $this->medical_lab_model->getMedicalReportFiles($id);
                $urls = array();
                foreach($data as $d){
                    $urls[] = array('url'=>$d['file_url'], 'id'=>$d['id']);
                }
                echo json_encode($urls);exit;
			}
        }
        else{
            redirect('index/login');
        }
    }
    public function delete() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $id = $this->input->post('id');
            echo $this->medical_lab_model->delete($id);
        }
    }
    public function getmedical_lab() {
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo json_encode($this->medical_lab_model->getmedical_labById($id));
        }
    }

    public function getDTPReports($paitnet_id=0){
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
            $cond[] = "patient_id=".$paitnet_id;			
            $this->tbl->setCheckboxColumn(false);
            $this->tbl->setIndexColumn(true);
            $this->tbl->setTwID(implode(' AND ',$cond));
            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }

    public function getDTreports(){
        if ($this->auth->isLoggedIn()) {
          
            $cond = array("hms_medical_report.isDeleted=0");
            $cond[] = "hms_medical_report.medical_lab_id=".$this->auth->getMyLabId();
			$status = isset($_GET['s']) ? $_GET['s'] : false;
			if($status !== false && $status != ""){
				$cond[] = "hms_medical_report.status=$status";
            }
            
            //New Library
            $this->datatables
            ->from('hms_medical_report')
            ->select('hms_medical_report.title as title, hms_medical_report.description as description, CONCAT(docusers.first_name," ",docusers.last_name) as docname, CONCAT(hms_users.first_name," ",hms_users.last_name) as patient, case when hms_medical_report.status=0 then "'.$this->lang->line('labels')['pending'].'" when hms_medical_report.status=1 then "'.$this->lang->line('labels')['completed'].'" end as status, hms_medical_report.id as action_report_id', false)
            ->join('hms_users','hms_medical_report.patient_id = hms_users.id','left')
            ->join('hms_doctors','hms_medical_report.doctor_id = hms_doctors.id','left')
            ->join('hms_users as docusers','hms_doctors.user_id = docusers.id','left')
            ->edit_column('title', '<a href="#" class="btnup" data-id="$1" data-toggle="modal" data-target="#uploadMR">$2</a>', 'action_report_id, title')
            ->unset_column('action_report_id');
            
            //Set condition to new library
            foreach($cond as $con){
                $this->datatables->where($con);
            }
            //Call new library for output
            echo $this->datatables->generate('json');
        }
    }
    
    public function getDTmedical_lab() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            
            $hospital_id = $this->input->get('hid',null,null);
            $show  = $this->input->get('s',null,false);
            $cond = array("hms_medical_lab.isDeleted=0");

            if($this->auth->isHospitalAdmin()){
                $ids = $this->auth->getBranchIds();
                $ids = implode(",", $ids);
                $cond[] = "hms_medical_lab.branch_id in (".$ids.")";
            }else if($hospital_id!=null){
                $ids = $this->branches_model->getBracheIds($hospital_id);
                if(count($ids) == 0){
                    $ids[] = -1;
                }
                $ids = implode(",", $ids);
                $cond[] = "hms_medical_lab.branch_id in (".$ids.")";
            }
            
            //New library
            $this->datatables
            ->showCheckbox(true)
            ->from('hms_medical_lab')
            ->select('hms_medical_lab.id as mainid, hms_medical_lab.name as mlname, hms_medical_lab.owner_name as owname, hms_medical_lab.owner_contact_number as contact, hms_hospitals.name as hname, hms_branches.branch_name as bname, hms_medical_lab.id as action_lab_id', false)
            ->join('hms_branches','hms_medical_lab.branch_id = hms_branches.id', 'left')
            ->join('hms_hospitals','hms_branches.hospital_id = hms_hospitals.id','left');
        

            if($show){
                $this->datatables->unset_column('hname');
                $this->datatables
                    ->showIndex(true);            
            }else{
                $this->datatables
                    ->edit_column('mlname','<a href="#" data-id="$1" class="editbtn" data-toggle="modal" data-target="#edit" data-toggle="tooltip" title="Edit">$2</a>', 'action_lab_id, mlname')
                    ->add_column('edit','<a href="#" id="dellink_$1" class="delbtn"  data-toggle="modal" data-target=".bs-example-modal-sm" data-id="$1" data-toggle="tooltip" title="Delete"><i class="glyphicon glyphicon-remove"></i></button>', 'action_lab_id')
                    ->unset_column('action_lab_id');
            }

            //Set condition to new library
            foreach($cond as $con){
                $this->datatables->where($con);
            }
            //Call new library for output
            echo $this->datatables->generate('json');
        }
    }
	
	public function getDTPatients() {
        if ($this->auth->isLoggedIn() ) {
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
                return "<a href='mailto:$d' >".$d."</a>";
            }), array("db" => "mobile", "dt" => 2, "formatter" => function ($d, $row) {
               return $d;
            }));
            $cond = array("role=".$this->auth->getPatientRoleType());
            
			$ids = $this->medical_lab_model->getMyPatientsIds();
			if(count($ids) == 0) { $ids[] = -1; }
			$ids = implode(",",$ids);
			$cond[] = "id in ($ids)";

			$this->tbl->setCheckboxColumn(false);
            $this->tbl->setIndexColumn(true);
			
            $this->tbl->setTwID(implode(' AND ',$cond));
            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }
}
