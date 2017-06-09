<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class License extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('license_model');
    }
    public function index() {
        if ($this->auth->isLoggedIn()) {
            $data['licenses'] = $this->license_model->getAlllicense();
            $data["page_title"] = $this->lang->line('license');
            $data["breadcrumb"] = array(site_url() => $this->lang->line('home'), null => $this->lang->line('license'));
            $this->load->view('License/index', $data);
        } else redirect('index/login');
    }
    public function search() {
        if ($this->auth->isLoggedIn()) {
            $q = $this->input->get("q", null, "");
            $f = $this->input->get("f", null, "");
            $result = $this->license_model->search($q, $f);
            echo json_encode($result);
        }
    }
    public function add() {
        if ($this->auth->isLoggedIn()) {
            if ($this->license_model->add()) {
                $data['success'] = array($this->lang->line('msg_license_added'));
            } else {
                $data['errors'] = array($this->lang->line('msg_license_updated'));
            }
            $this->session->set_flashdata('data', $data);
            redirect('license/index');
        } else redirect('index/login');
    }
    public function update() {
        if ($this->auth->isLoggedIn()) {
            $data = array();
            $id = $this->input->post('eidt_gf_id');
            if ($this->license_model->update($id)) {
                $data['success'] = array($this->lang->line('msg_try_again'));
            } else {
                $data['errors'] = array($this->lang->line('msg_try_again'));
            }
            $this->session->set_flashdata('data', $data);
            redirect('license/index');
        } else redirect('index/login');
    }
    public function delete() {
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo $this->license_model->delete($id);
        }
    }
    public function getlicense() {
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo json_encode($this->license_model->getlicenseById($id));
        }
    }
    public function getDTlicense() {
        if ($this->auth->isLoggedIn()) {
            $this->load->library("tbl");
            $table = "hms_license";
            $primaryKey = "id";
            $columns = array(array("db" => "license_code", "dt" => 0, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "name", "dt" => 1, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "id", "dt" => 2, "formatter" => function ($d, $row) {
                return "<button class=\"btn btn-info editbtn\" data-toggle=\"modal\" data-target=\"#edit\" type=\"button\" data-toggle=\"tooltip\" data-id=\"$d\" title=\"Edit\"><i class=\"fa fa-edit\"></i></button>
		        	<button class=\"btn btn-danger delbtn\" id=\"dellink_".$d."\" type=\"button\" data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Delete\"><i class=\"fa fa-trash-o\"></i></button>
		        	<button class=\"btn btn-info viewbtn\" type=\"button\" data-toggle=\"modal\" data-target=\"#edit\" data-toggle=\"tooltip\" data-id=\"$d\" title=\"View\"><i class=\"fa fa-binoculars\"></i></button><span id=\"tr_$d\"></span>";
            }));
            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }
}
