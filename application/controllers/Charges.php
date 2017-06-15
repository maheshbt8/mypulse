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
            $selected_hid = "";
            if(isset($_POST['selected_hid'])){
                $selected_hid = $_POST['selected_hid'];
            }
            if ($this->charges_model->add()) {
                $data['success'] = array("Charge Added Successfully");
            } else {
                $data['errors'] = array("Please again later");
            }
            $this->session->set_flashdata('data', $data);
            redirect('charges/index?hid='.$selected_hid);
        } else redirect('index/login');
    }
    public function update() {
        if ($this->auth->isLoggedIn()) {
            $data = array();
            $selected_hid = "";
            if(isset($_POST['selected_hid'])){
                $selected_hid = $_POST['selected_hid'];
            }
            $id = $this->input->post('eidt_gf_id');
            if ($this->charges_model->update($id)) {
                $data['success'] = array("Charge Updated Successfully");
            } else {
                $data['errors'] = array("Please again later");
            }
            $this->session->set_flashdata('data', $data);
            redirect('charges/index?hid='.$selected_hid);
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
    public function getDTcharges() {
        if ($this->auth->isLoggedIn()) {
            $this->load->library("tbl");
            $table = "hms_charges";
            $primaryKey = "id";
            $columns = array(array("db" => "title", "dt" => 0, "formatter" => function ($d, $row) {
                return "<a href='#' data-id='$row[id]' class='editbtn' data-toggle='modal' data-target='#edit' data-toggle='tooltip' title='Edit'>$d</a>";
            }), array("db" => "charge_type", "dt" => 1, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "description", "dt" => 2, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "charge", "dt" => 3, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "id", "dt" => 4, "formatter" => function ($d, $row) {
                return "<a href=\"#\" id=\"dellink_".$d."\" class=\"delbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Delete\"><i class=\"glyphicon glyphicon-remove\"></i></button>";
            }));

            $hospital_id = $this->input->get('hid',null,null);
            $show  = $this->input->get('s',null,false);
            $cond = array("isDeleted=0");
            if($this->auth->isHospitalAdmin()){
                $hid = $this->auth->getHospitalId();
                $cond[] = "hospital_id=".$hid;
            }else if($hospital_id!=null){
                $cond[] = "hospital_id=".$hospital_id;
            }
            
            if($show){
                $this->tbl->setCheckboxColumn(false);
                $columns = array($columns[0],$columns[1],$columns[2],$columns[3]);
                $columns[0]['formatter'] = function ($d, $row) {
                    return $d;
                };
                
                $this->tbl->setIndexColumn(true);
            }
            $this->tbl->setTwID(implode(' AND ',$cond));

            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }
}
