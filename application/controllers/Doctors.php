<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Doctors extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('doctors_model');
    }
    public function index() {
        if ($this->auth->isLoggedIn()) {
            $data['doctorss'] = $this->doctors_model->getAlldoctors();
            $data["page_title"] = "Doctors";
            $data["breadcrumb"] = array(site_url() => "Home", null => "Doctors");
            $this->load->view('Doctors/index', $data);
        } else redirect('index/login');
    }
    public function search() {
        if ($this->auth->isLoggedIn()) {
            $q = $this->input->get("q", null, "");
            $f = $this->input->get("f", null, "");
            $result = $this->doctors_model->search($q, $f);
            echo json_encode($result);
        }
    }
    public function add() {
        if ($this->auth->isLoggedIn()) {
            if ($this->doctors_model->add()) {
                $data['success'] = array("Doctors Added Successfully");
            } else {
                $data['errors'] = array("Please again later");
            }
            $this->session->set_flashdata('data', $data);
            redirect('doctors/index');
        } else redirect('index/login');
    }
    public function update() {
        if ($this->auth->isLoggedIn()) {
            $data = array();
            $id = $this->input->post('eidt_gf_id');
            if ($this->doctors_model->update($id)) {
                $data['success'] = array("Doctors Updated Successfully");
            } else {
                $data['errors'] = array("Please again later");
            }
            $this->session->set_flashdata('data', $data);
            redirect('doctors/index');
        } else redirect('index/login');
    }
    public function delete() {
        if ($this->auth->isLoggedIn()) {
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
    public function getDTdoctors() {
        if ($this->auth->isLoggedIn()) {
            $this->load->library("tbl");
            $table = "hms_doctors";
            $primaryKey = "id";
            $columns = array(array("db" => "user_id", "dt" => 0, "formatter" => function ($d, $row) {
                $this->load->model("users_model");
                $temp = $this->users_model->getusersById($d);
                return $temp["users"];
            }), array("db" => "hospital_id", "dt" => 1, "formatter" => function ($d, $row) {
                $this->load->model("hospitals_model");
                $temp = $this->hospitals_model->gethospitalsById($d);
                return $temp["hospitals"];
            }), array("db" => "id", "dt" => 2, "formatter" => function ($d, $row) {
                return "<button class=\"btn btn-info editbtn\" data-toggle=\"modal\" data-target=\"#edit\" type=\"button\" data-toggle=\"tooltip\" data-id=\"$d\" title=\"Edit\"><i class=\"fa fa-edit\"></i></button>
		        	<button class=\"btn btn-danger delbtn\" type=\"button\" data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Delete\"><i class=\"fa fa-trash-o\"></i></button>
		        	<button class=\"btn btn-info viewbtn\" type=\"button\" data-toggle=\"modal\" data-target=\"#edit\" data-toggle=\"tooltip\" data-id=\"$d\" title=\"View\"><i class=\"fa fa-binoculars\"></i></button><span id=\"tr_$d\"></span>";
            }));
            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }
}
