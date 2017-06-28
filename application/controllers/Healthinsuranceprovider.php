<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Healthinsuranceprovider extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('healthinsuranceprovider_model');
    }
    public function index() {
        if ($this->auth->isLoggedIn() && $this->auth->isSuperAdmin()) {
            $data['healthinsuranceproviders'] = $this->healthinsuranceprovider_model->getAllhealthinsuranceprovider();
            
            $data["page_title"] = $this->lang->line('healthinsuranceprovider');
            $data["breadcrumb"] = array(site_url() => $this->lang->line('home'), null => $this->lang->line('healthinsuranceprovider'));
            $this->load->view('Healthinsuranceprovider/index', $data);
        } else redirect('index/login');
    }
    public function search() {
        if ($this->auth->isLoggedIn() && $this->auth->isSuperAdmin()) {
            $q = $this->input->get("q", null, "");
            $f = $this->input->get("f", null, "");
            $result = $this->healthinsuranceprovider_model->search($q, $f);
            echo json_encode($result);
        }
    }
    public function add() {
        if ($this->auth->isLoggedIn() && $this->auth->isSuperAdmin()) {
            if ($this->healthinsuranceprovider_model->add()) {
                $data['success'] = array($this->lang->line('msg_hip_added'));
            } else {
                 $data['errors'] = array($this->lang->line('msg_try_again'));
            }
            $this->session->set_flashdata('data', $data);
            redirect('healthinsuranceprovider/index');
        } else redirect('index/login');
    }
    public function update() {
        if ($this->auth->isLoggedIn() && $this->auth->isSuperAdmin()) {
            $data = array();
            $id = $this->input->post('eidt_gf_id');
            if ($this->healthinsuranceprovider_model->update($id)) {
               $data['success'] = array($this->lang->line('msg_hip_updated'));
            } else {
                 $data['errors'] = array($this->lang->line('msg_try_again'));
            }
            $this->session->set_flashdata('data', $data);
            redirect('healthinsuranceprovider/index');
        } else redirect('index/login');
    }
    public function delete() {
        if ($this->auth->isLoggedIn() && $this->auth->isSuperAdmin()) {
            $id = $this->input->post('id');
            echo $this->healthinsuranceprovider_model->delete($id);
        }
    }
    public function gethealthinsuranceprovider() {
        if ($this->auth->isLoggedIn() && $this->auth->isSuperAdmin()) {
            $id = $this->input->post('id');
            echo json_encode($this->healthinsuranceprovider_model->gethealthinsuranceproviderById($id));
        }
    }
    public function getDThealthinsuranceprovider() {
        if ($this->auth->isLoggedIn() && $this->auth->isSuperAdmin()) {
            $this->load->library("tbl");
            $table = "hms_healthinsuranceprovider";
            $primaryKey = "id";
            $columns = array(array("db" => "name", "dt" => 0, "formatter" => function ($d, $row) {
                return "<a href='#' data-id='$row[id]' class='editbtn' data-toggle='modal' data-target='#edit' data-toggle='tooltip' title='Edit'>$d</a>";
            }), array("db" => "id", "dt" => 1, "formatter" => function ($d, $row) {
                return "<a href=\"#\" id=\"dellink_".$d."\" class=\"delbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Delete\"><i class=\"glyphicon glyphicon-remove\"></i></button>";
            }));
            
            //$this->tbl->setTwID(implode(" AND ",$cond));
            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }
}
