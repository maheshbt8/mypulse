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
        $this->load->model('hospitals_model');
    }
    public function index() {
        if ($this->auth->isLoggedIn()) {
            $data['nurses'] = $this->nurse_model->getAllnurse();
            $data["page_title"] = "Nurse";
            $data["breadcrumb"] = array(site_url() => "Home", null => "Nurse");
            $this->load->view('Nurse/index', $data);
        } else redirect('index/login');
    }
    public function search() {
        if ($this->auth->isLoggedIn()) {
            $q = $this->input->get("q", null, "");
            $f = $this->input->get("f", null, "");
            $result = $this->nurse_model->search($q, $f);
            echo json_encode($result);
        }
    }
    public function add() {
        if ($this->auth->isLoggedIn()) {
            $nur = $this->nurse_model->add();
            $data = array();
            if ($nur===true) {
                $data['success'] = array("Nurse Added Successfully");
            } else {
                $errors = array();
                if($nur === -1){
                    $errors[] = "Please use another email.";
                }else{
                    $errors[] = "Please again later";
                }
                $data['errors'] = $errors;
            }
            $this->session->set_flashdata('data', $data);
            redirect('nurse/index');
        } else redirect('index/login');
    }
    public function update() {
        if ($this->auth->isLoggedIn()) {
            $data = array();
            $id = $this->input->post('eidt_gf_id');
            $res = $this->nurse_model->update($id);
            if($res === true){
                $data['success'] = array("Nurse Updated Successfully");
            }
            else if ($res === -1) {
                $data['errors'] = array("Please use another email.");
            } else {
                $data['errors'] = array("Please again later");
            }
            $this->session->set_flashdata('data', $data);
            redirect('nurse/index');
        } else redirect('index/login');
    }
    public function delete() {
        if ($this->auth->isLoggedIn()) {
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
    public function getDTnurse() {
        if ($this->auth->isLoggedIn()) {
            $this->load->library("tbl");
            $table = "hms_nurse";
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
                $branch = $this->branches_model->getbranchesById($temp['branch_id']);
                if(!isset($branch['hospital_id']))
                    return "-";
                $hospital = $this->hospitals_model->gethospitalsById($branch['hospital_id']);
                 if(!isset($hospital['name']))
                    return "-";
                return $hospital["name"];
            }), array("db" => "department_id", "dt" => 2, "formatter" => function ($d, $row) {
                $temp = $this->departments_model->getdepartmentsById($d);
                 if(!isset($temp['branch_id']))
                    return "-";
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
                return "<a href=\"#\" class=\"delbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Delete\"><i class=\"glyphicon glyphicon-remove\"></i></button>";
            }));
            if($this->auth->isHospitalAdmin()){
                $ids = $this->auth->getAllDepartmentsIds();
                $ids = implode(",", $ids);
                $this->tbl->setTwID("department_id in (".$ids.")");
            }
            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }
}
