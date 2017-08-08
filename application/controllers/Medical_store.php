<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Medical_store extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('medical_store_model');
        $this->load->model('hospitals_model');
        $this->load->model("branches_model");
    }
    public function index() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $data['medical_stores'] = $this->medical_store_model->getAllmedical_store();
            $data["page_title"] = $this->lang->line('medicalStoreFull');
            $data["breadcrumb"] = array(site_url() => $this->lang->line('home'), null => $this->lang->line('medicalStoreFull'));
            $this->load->view('Medical_store/index', $data);
        } else redirect('index/login');
    }
    public function search() {
        if ($this->auth->isLoggedIn()) {
            $q = $this->input->get("q", null, "");
            $f = $this->input->get("f", null, "");
            $result = $this->medical_store_model->search($q, $f);
            echo json_encode($result);
        }
    }
    public function add() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $res = $this->medical_store_model->add();
            $data = $this->auth->parseUserResult($res,$this->lang->line('msg_medstore_added'));
           
            $this->session->set_flashdata('data', $data);
            redirect('medical_store/index');
        } else redirect('index/login');
    }
    public function update() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            
            $id = $this->input->post('eidt_gf_id');
            $res = $this->medical_store_model->update($id);
            $data = $this->auth->parseUserResult($res,$this->lang->line('msg_medstore_updated'));
            
            $this->session->set_flashdata('data', $data);
            redirect('medical_store/index');
        } else redirect('index/login');
    }
    public function about(){
        if ($this->auth->isLoggedIn()){
            $data["page_title"] = $this->lang->line('medicalStoreFull');
            $data["breadcrumb"] = array(site_url() => $this->lang->line('home'), null => $this->lang->line('about'));
            $id = $this->medical_store_model->getMyStoreId();
            $data['about'] = $this->medical_store_model->getmedical_storeById($id);
            $this->load->view('Medical_store/about',$data);
        }else{
            redirect('index/login');
        }
    }
    public function updateabout(){
        if ($this->auth->isLoggedIn() && $this->auth->isMedicalStore()){
            $id = $this->input->post('eidt_gf_id');
            $this->medical_store_model->update($id);
            $data['success'] = array($this->lang->line('msg_medstore_updated'));
            $this->session->set_flashdata('data', $data);
            redirect('medical_store/about');   
        }
        else redirect('index/login');   
    }
    public function orders(){
        if ($this->auth->isLoggedIn()){
            $data["page_title"] = $this->lang->line('medicalStoreFull');
            $data["breadcrumb"] = array(site_url() => $this->lang->line('home'), null => $this->lang->line('orders'));
            
            $this->load->view('Medical_store/orders',$data);
        }
    }
    public function delete() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $id = $this->input->post('id');
            echo $this->medical_store_model->delete($id);
        }
    }
    public function getmedical_store() {
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo json_encode($this->medical_store_model->getmedical_storeById($id));
        }
    }
    public function getDTmedical_store() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $this->load->library("tbl");
            $table = "hms_medical_store";
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
            }),array("db" => "branch_id", "dt" => 4, "formatter" => function ($d, $row) {
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

    public function getDTorders(){
        if ($this->auth->isLoggedIn()) {
            $this->load->library("tbl");
            $table = "hms_prescription";
            $primaryKey = "id";
            $columns = array(array("db" => "doctor_id", "dt" => 0, "formatter" => function ($d, $row) {
                $uid = $this->doctors_model->getMyUserId($d);
                $data = $this->users_model->getProfile($uid);
                return $this->auth->getUName($data);
            }), array("db" => "patient_id", "dt" => 1, "formatter" => function ($d, $row) {
                $data = $this->users_model->getProfile($d);
                return $this->auth->getUName($data);
            }), array("db" => "patient_id", "dt" => 2, "formatter" => function ($d, $row) {
                $data = $this->users_model->getProfile($d);
                return isset($data['mobile']) ? $data['mobile'] : "";
            }), array("db" => "patient_id", "dt" => 3, "formatter" => function ($d, $row) {
                $data = $this->users_model->getProfile($d);
                return isset($data['address']) ? $data['address'] : "";
            }), array("db" => "order_status", "dt" => 4, "formatter" => function ($d, $row) {
                if($d=="0"){
                    return '<span class="label label-info">Pending</span>';
                }else{
                    return '<span class="label label-success">Completed</span>';
                }
            }), array("db" => "id", "dt" => 5, "formatter" => function ($d, $row) {
                return "<a href='#' data-url='doctors/previewprescription/".$row['id']."' data-id='$row[id]' class='previewtem'><i class='fa fa-file'></i></a>";
            }), array("db" => "id", "dt" => 6, "formatter" => function ($d, $row) {
                return "";
            }));
            
            $cond[] = "isDeleted=0";
            $cond[] = "store_id=".$this->auth->getMyStoreId();
            $this->tbl->setCheckboxColumn(false);
            $this->tbl->setIndexColumn(false);
            $this->tbl->setTwID(implode(' AND ',$cond));
            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }
}
