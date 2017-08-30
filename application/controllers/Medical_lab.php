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
            $this->load->library("tbl");
            $table = "hms_medical_report";
            $primaryKey = "id";
            $columns = array(array("db" => "title", "dt" => 0, "formatter" => function ($d, $row) {
                return "<a href='#' class='btnup' data-id='$row[id]' data-toggle='modal' data-target='#uploadMR'>$d</a>";
            }), array("db" => "description", "dt" => 1, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "doctor_id", "dt" => 2, "formatter" => function ($d, $row) {
                $uid = $this->doctors_model->getMyUserId($d);
                $data = $this->users_model->getProfile($uid);
                return $this->auth->getUName($data);
            }), array("db" => "patient_id", "dt" => 3, "formatter" => function ($d, $row) {
                $data = $this->users_model->getProfile($d);
                return $this->auth->getUName($data);
            }), array("db" => "status", "dt" => 4, "formatter" => function ($d, $row) {
                if($d=="0"){
                    return '<span class="label label-info">Pending</span>';
                }else{
                    return '<span class="label label-success">Completed</span>';
                }
            }));
            $cond[] = "isDeleted=0";
            $cond[] = "medical_lab_id=".$this->auth->getMyLabId();
            $this->tbl->setCheckboxColumn(false);
            $this->tbl->setIndexColumn(false);
            $this->tbl->setTwID(implode(' AND ',$cond));
            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }
    
    public function getDTmedical_lab() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $this->load->library("tbl");
            $table = "hms_medical_lab";
            $primaryKey = "id";
            $columns = array(array("db" => "name", "dt" => 0, "formatter" => function ($d, $row) {
                return "<a href='#' data-id='$row[id]' class='editbtn' data-toggle='modal' data-target='#edit' data-toggle='tooltip' title='Edit'>$d</a>";
            }), array("db" => "owner_name", "dt" => 1, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "owner_contact_number", "dt" => 2, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "branch_id", "dt" => 3, "formatter" => function ($d, $row) {
                $temp = $this->branches_model->getbranchesById($d);
                if(!isset($temp['hospital_id']))
                    return "-";
                $hospital = $this->hospitals_model->gethospitalsById($temp['hospital_id']);
                if(!isset($hospital['name']))
                    return "-";
                return $hospital["name"];
            }), array("db" => "branch_id", "dt" => 4, "formatter" => function ($d, $row) {
                $temp = $this->branches_model->getbranchesById($d);
                if(!isset($temp['branch_name']))
                    return "-";
                return $temp["branch_name"];
            }), array("db" => "id", "dt" => 5, "formatter" => function ($d, $row) {
                return "<a href=\"#\" id=\"dellink_".$d."\" class=\"delbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Delete\"><i class=\"glyphicon glyphicon-remove\"></i></button>";
            }));

            $hospital_id = $this->input->get('hid',null,null);
            $show  = $this->input->get('s',null,false);
            $cond = array("isDeleted=0");
            if($this->auth->isHospitalAdmin()){
                $ids = $this->auth->getBranchIds();
                $ids = implode(",", $ids);
                $cond[] = "branch_id in (".$ids.")";
            }else if($hospital_id!=null){
                $ids = $this->branches_model->getBracheIds($hospital_id);
                if(count($ids) == 0){
                    $ids[] = -1;
                }
                $ids = implode(",", $ids);
                $cond[] = "branch_id in (".$ids.")";
            }
            
            if($show){
                $this->tbl->setCheckboxColumn(false);
                $columns = array($columns[0],$columns[1],$columns[2],$columns[4]);
                $columns[0]["dt"] = 0;
                $columns[1]["dt"] = 1;
                $columns[2]['dt'] = 2;
                $columns[3]['dt'] = 3;
                $columns[0]['formatter'] =  function ($d, $row) {
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
