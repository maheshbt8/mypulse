<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Inpatient extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('inpatient_model');
    }
    public function index() {
        if ($this->auth->isLoggedIn()) {
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
        } else redirect('index/login');
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
            $this->load->library("tbl");
            $table = "hms_inpatient";
            $primaryKey = "id";
            $columns = array(array("db" => "user_id", "dt" => 0, "formatter" => function ($d, $row) {
                $this->load->model("users_model");
                $temp = $this->users_model->getusersById($d);
                return $temp["users"];
            }), array("db" => "bed_id", "dt" => 1, "formatter" => function ($d, $row) {
                $this->load->model("beds_model");
                $temp = $this->beds_model->getbedsById($d);
                return $temp["beds"];
            }), array("db" => "join_date", "dt" => 2, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "reason", "dt" => 3, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "status", "dt" => 4, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "id", "dt" => 5, "formatter" => function ($d, $row) {
                return "<a href=\"#\" class=\"delbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Delete\"><i class=\"glyphicon glyphicon-remove\"></i></button>";
            }));
            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }
}
