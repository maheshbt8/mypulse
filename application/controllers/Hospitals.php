<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Hospitals extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('hospitals_model');
        $this->load->model('license_model');
        $this->load->model('users_model');
    }
    public function index() {
        if ($this->auth->isLoggedIn()) {
            $data['license'] = $this->license_model->getAlllicense();
            $data['hospital_admins'] = $this->users_model->getUsersByType($this->auth->getHospitalAdminRoleType());
            $data["page_title"] = $this->lang->line('hospitals');
            $data["breadcrumb"] = array(site_url() => $this->lang->line('home'), null => $this->lang->line('hospitals'));
            $this->load->view('Hospitals/index', $data);
        } else redirect('index/login');
    }
    public function search() {
        if ($this->auth->isLoggedIn()) {
            $q = $this->input->get("q", null, "");
            $f = $this->input->get("f", null, "");
            $result = $this->hospitals_model->search($q, $f);
            echo json_encode($result);
        }
    }
    public function add() {
        if ($this->auth->isLoggedIn()) {
            if ($this->hospitals_model->add()) {
                $data['success'] = array($this->lang->line('msg_hospital_added'));
            } else {
                $data['errors'] = array($this->lang->line('msg_try_again'));
            }
            $this->session->set_flashdata('data', $data);
            redirect('hospitals/index');
        } else redirect('index/login');
    }
    public function update() {
        if ($this->auth->isLoggedIn()) {
            $data = array();
            $id = $this->input->post('eidt_gf_id');
            if ($this->hospitals_model->update($id)) {
                $data['success'] = array($this->lang->line('msg_hospital_updated'));
            } else {
                $data['errors'] = array($this->lang->line('msg_try_again'));
            }
            $this->session->set_flashdata('data', $data);
            redirect('hospitals/index');
        } else redirect('index/login');
    }
    public function delete() {
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo $this->hospitals_model->delete($id);
        }
    }
    public function gethospitals() {
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo json_encode($this->hospitals_model->gethospitalsById($id));
        }
    }
    public function getDThospitals() {
        if ($this->auth->isLoggedIn()) {
            $this->load->library("tbl");
            $table = "hms_hospitals";
            $primaryKey = "id";
            $columns = array(array("db" => "name", "dt" => 0, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "license_status", "dt" => 1, "formatter" => function ($d, $row) {
                return '<span class="label label-info">Not Register</span>';
                //return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "city", "dt" => 2, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "id", "dt" => 3, "formatter" => function ($d, $row) {
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
