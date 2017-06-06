<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Charges extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('charges_model');
    }
    public function index() {
        if ($this->auth->isLoggedIn()) {
            $data['chargess'] = $this->charges_model->getAllcharges();
            $data["page_title"] = "Charges";
            $data["breadcrumb"] = array(site_url() => "Home", null => "Charges");
            $this->load->view('Charges/index', $data);
        } else redirect('index/login');
    }
    public function search() {
        if ($this->auth->isLoggedIn()) {
            $q = $this->input->get("q", null, "");
            $f = $this->input->get("f", null, "");
            $result = $this->charges_model->search($q, $f);
            echo json_encode($result);
        }
    }
    public function add() {
        if ($this->auth->isLoggedIn()) {
            
            if ($this->charges_model->add()) {
                $data['success'] = array("Charge Added Successfully");
            } else {
                $data['errors'] = array("Please again later");
            }
            $this->session->set_flashdata('data', $data);
            redirect('charges/index');
        } else redirect('index/login');
    }
    public function update() {
        if ($this->auth->isLoggedIn()) {
            $data = array();
            $id = $this->input->post('eidt_gf_id');
            if ($this->charges_model->update($id)) {
                $data['success'] = array("Charge Updated Successfully");
            } else {
                $data['errors'] = array("Please again later");
            }
            $this->session->set_flashdata('data', $data);
            redirect('charges/index');
        } else redirect('index/login');
    }
    public function delete() {
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo $this->charges_model->delete($id);
        }
    }
    public function getcharges() {
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo json_encode($this->charges_model->getchargesById($id));
        }
    }
    public function getDTcharges($hospital_id=null) {
        if ($this->auth->isLoggedIn()) {
            $this->load->library("tbl");
            $table = "hms_charges";
            $primaryKey = "id";
            $columns = array(array("db" => "title", "dt" => 0, "formatter" => function ($d, $row) {
                return "<a href='#' data-id='$row[id]' class='editbtn' data-toggle='modal' data-target='#edit' data-toggle='tooltip' title='Edit'>$d</a>";
            }), array("db" => "charge_type", "dt" => 1, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "charge", "dt" => 2, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "id", "dt" => 3, "formatter" => function ($d, $row) {
                return "<a href=\"#\" class=\"delbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Delete\"><i class=\"glyphicon glyphicon-remove\"></i></button>";
            }));
            if($hospital_id!=null){
                $this->tbl->setTwID("hospital_id=$hospital_id");
                $columns = array($columns[0],$columns[1],$columns[2]);
                $columns[0]['formatter'] = function ($d, $row) {
                    return $d;
                };
                $this->tbl->setIndexColumn(true);
            }
            if($this->auth->isHospitalAdmin()){
                $hid = $this->auth->getHospitalId();
                $this->tbl->setTwID("hospital_id=".$hid);
            }
            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }
}
