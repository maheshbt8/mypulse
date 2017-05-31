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
    }
    public function index() {
        if ($this->auth->isLoggedIn()) {
            $data['medical_labs'] = $this->medical_lab_model->getAllmedical_lab();
            $data["page_title"] = "Medical lab";
            $data["breadcrumb"] = array(site_url() => "Home", null => "Medical lab");
            $this->load->view('Medical_lab/index', $data);
        } else redirect('index/login');
    }
    public function search() {
        if ($this->auth->isLoggedIn()) {
            $q = $this->input->get("q", null, "");
            $f = $this->input->get("f", null, "");
            $result = $this->medical_lab_model->search($q, $f);
            echo json_encode($result);
        }
    }
    public function add() {
        if ($this->auth->isLoggedIn()) {
            $res = $this->medical_lab_model->add();
            $data = array();
            if ($res===true) {
                $data['success'] = array("Medical lab Added Successfully");
            } else if($res === -1) {
                $data['errors'] = array("Please use another email.");
            }else{
                $data['errors'] = array("Please again later");
            }
            $this->session->set_flashdata('data', $data);
            redirect('medical_lab/index');
        } else redirect('index/login');
    }
    public function update() {
        if ($this->auth->isLoggedIn()) {
            $data = array();
            $id = $this->input->post('eidt_gf_id');
            $res = $this->medical_lab_model->update($id);
            $data = array();
            if ($res===true) {
                $data['success'] = array("Medical lab Updated Successfully");
            } else if($res === -1) {
                $data['errors'] = array("Please use another email.");
            }else{
                $data['errors'] = array("Please again later");
            }
            $this->session->set_flashdata('data', $data);
            redirect('medical_lab/index');
        } else redirect('index/login');
    }
    public function delete() {
        if ($this->auth->isLoggedIn()) {
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
    public function getDTmedical_lab() {
        if ($this->auth->isLoggedIn()) {
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
                $hospital = $this->hospitals_model->gethospitalsById($temp['hospital_id']);
                return $hospital["name"];
            }), array("db" => "branch_id", "dt" => 4, "formatter" => function ($d, $row) {
                $temp = $this->branches_model->getbranchesById($d);
                return $temp["branch_name"];
            }), array("db" => "id", "dt" => 5, "formatter" => function ($d, $row) {
                return "<a href=\"#\" class=\"delbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Delete\"><i class=\"glyphicon glyphicon-remove\"></i></button>";
            }));
            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }
}
