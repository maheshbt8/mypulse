<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Receptionist extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('receptionist_model');
        $this->load->model('departments_model');
        $this->load->model('branches_model');
        $this->load->model('doctors_model');
        $this->load->model('hospitals_model');
    }
    public function index() {
        if ($this->auth->isLoggedIn()) {
            $data['receptionists'] = $this->receptionist_model->getAllreceptionist();
            $data["page_title"] = "Receptionist";
            $data["breadcrumb"] = array(site_url() => "Home", null => "Receptionist");
            $this->load->view('Receptionist/index', $data);
        } else redirect('index/login');
    }
    public function search() {
        if ($this->auth->isLoggedIn()) {
            $q = $this->input->get("q", null, "");
            $f = $this->input->get("f", null, "");
            $result = $this->receptionist_model->search($q, $f);
            echo json_encode($result);
        }
    }
    public function add() {
        if ($this->auth->isLoggedIn()) {
            $nid = $this->receptionist_model->add();
            if ($nid === true) {
                $data['success'] = array("Receptionist Added Successfully");
            } else if($nid === -1){
                $data['errors'] = array("Please use another email.");
            } else {
                $data['errors'] = array("Please again later");
            }
            $this->session->set_flashdata('data', $data);
            redirect('receptionist/index');
        } else redirect('index/login');
    }
    public function update() {
        if ($this->auth->isLoggedIn()) {
            $data = array();
            $id = $this->input->post('eidt_gf_id');
            $res = $this->receptionist_model->update($id);
            if ($res === true) {
                $data['success'] = array("Receptionist Updated Successfully");
            } else if($res === -1){
                $data['errors'] = array("Please use another email.");
            } else {
                $data['errors'] = array("Please again later");
            }
            $this->session->set_flashdata('data', $data);
            redirect('receptionist/index');
        } else redirect('index/login');
    }
    public function delete() {
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo $this->receptionist_model->delete($id);
        }
    }
    public function getreceptionist() {
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo json_encode($this->receptionist_model->getreceptionistById($id));
        }
    }
    public function getDTreceptionist() {
        if ($this->auth->isLoggedIn()) {
            $this->load->library("tbl");
            $table = "hms_receptionist";
            $primaryKey = "id";
            $columns = array(array("db" => "user_id", "dt" => 0, "formatter" => function ($d, $row) {
                $this->load->model("users_model");
                $temp = $this->users_model->getusersById($d);
                $name = $temp["first_name"]." ".$temp["last_name"];
                return "<a href='#' data-id='$row[id]' class='editbtn' data-toggle='modal' data-target='#edit' data-toggle='tooltip' title='Edit'>".$name."</a>";
            }), array("db" => "doc_id", "dt" => 1, "formatter" => function ($d, $row) {
                
                $doc = $this->doctors_model->getdoctorsById($d);
                   
                $temp = $this->departments_model->getdepartmentsById($doc['department_id']);

                $branch = $this->branches_model->getbranchesById($temp['branch_id']);

                $hospital = $this->hospitals_model->gethospitalsById($branch['hospital_id']);

                return $hospital["name"];

            }), array("db" => "doc_id", "dt" => 2, "formatter" => function ($d, $row) {
                $doc = $this->doctors_model->getdoctorsById($d);
                $temp = $this->departments_model->getdepartmentsById($doc['department_id']);
                $branch = $this->branches_model->getbranchesById($temp['branch_id']);
                return $branch["branch_name"];

            }), array("db" => "doc_id", "dt" => 3, "formatter" => function ($d, $row) {
                $doc = $this->doctors_model->getdoctorsById($d);
                $temp = $this->departments_model->getdepartmentsById($doc['department_id']);
                return $temp["department_name"];
            }),array("db" => "doc_id", "dt" => 4, "formatter" => function ($d, $row) {
                $temp = $this->doctors_model->getdoctorsById($d);
                return $temp["first_name"]." ".$temp["last_name"];
            }),array("db" => "isActive", "dt" => 5, "formatter" => function ($d, $row) {
                return $this->auth->getActiveStatus($d);
            }), array("db" => "id", "dt" => 6, "formatter" => function ($d, $row) {
                return "<a href=\"#\" class=\"delbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Delete\"><i class=\"glyphicon glyphicon-remove\"></i></button>";
            }));
            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }
}
