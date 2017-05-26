<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Users extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('users_model');
    }
    public function index() {
        if ($this->auth->isLoggedIn()) {
            $data['userss'] = $this->users_model->getAllusers();
            $data["page_title"] = $this->lang->line('users');
            $data["breadcrumb"] = array(site_url() => $this->lang->line('home'), null => $this->lang->line('users'));
            $this->load->view('Users/index', $data);
        } else redirect('index/login');
    }
    public function search($role=0) {
        if ($this->auth->isLoggedIn()) {
            $q = $this->input->get("q", null, "");
            $f = $this->input->get("f", null, "");
            $result = $this->users_model->search($q, $f,$role);
            echo json_encode($result);
        }
    }
    public function add() {
        if ($this->auth->isLoggedIn()) {
            $res = $this->users_model->add();

            if ($res === true) {
                $data['success'] = array($this->lang->line('msg_user_added'));
            } else if($res === -1){
                $data['errors'] = array($this->lang->line('msg_email_exist'));
            } else {
                $data['errors'] = array($this->lang->line('msg_try_again'));
            }
            $this->session->set_flashdata('data', $data);
            redirect('users/index');
            
        } else redirect('index/login');
    }
    public function update() {
        if ($this->auth->isLoggedIn()) {
            $data = array();
            $id = $this->input->post('eidt_gf_id');
            if ($this->users_model->update($id)) {
                $data['success'] = array($this->lang->line('msg_user_updated'));
            } else {
                $data['errors'] = array($this->lang->line('msg_try_again'));
            }
            $this->session->set_flashdata('data', $data);
            redirect('users/index');
        } else redirect('index/login');
    }
    public function delete() {
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo $this->users_model->delete($id);
        }
    }
    public function getusers() {
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo json_encode($this->users_model->getusersById($id));
        }
    }

   

    public function getDTusers() {
        if ($this->auth->isLoggedIn()) {
            $this->load->library("tbl");
            $table = "hms_users";
            $primaryKey = "id";
            $columns = array(array("db" => "first_name", "dt" => 0, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "last_name", "dt" => 1, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "usernemail", "dt" => 2, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "address", "dt" => 3, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "mobile", "dt" => 4, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "phone", "dt" => 5, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "profile_photo", "dt" => 6, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "role", "dt" => 7, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "id", "dt" => 8, "formatter" => function ($d, $row) {
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
