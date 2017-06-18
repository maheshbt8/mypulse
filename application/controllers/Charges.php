<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Charges extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('charges_model');
        $this->load->model('branches_model');
        $this->load->model('hospitals_model');
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
            $query =array();
            if(isset($_POST['selected_hid'])){
                $query[] = "hid=".$_POST['selected_hid'];
            }
            if(isset($_POST['selected_bid'])){
                $query[] = "bid=".$_POST['selected_bid'];
            }
            if ($this->charges_model->add()) {
                $data['success'] = array("Charge Added Successfully");
            } else {
                $data['errors'] = array("Please again later");
            }
            $this->session->set_flashdata('data', $data);
            $qry = implode("&",$query);
            redirect('charges/index?'.$qry);
        } else redirect('index/login');
    }
    public function update() {
        if ($this->auth->isLoggedIn()) {
            $data = array();
            $query =array();
            if(isset($_POST['selected_hid'])){
                $query[] = "hid=".$_POST['selected_hid'];
            }
            if(isset($_POST['selected_bid'])){
                $query[] = "bid=".$_POST['selected_bid'];
            }
            $id = $this->input->post('eidt_gf_id');
            if ($this->charges_model->update($id)) {
                $data['success'] = array("Charge Updated Successfully");
            } else {
                $data['errors'] = array("Please again later");
            }
            $this->session->set_flashdata('data', $data);
             $qry = implode("&",$query);
            redirect('charges/index?'.$qry);
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

            $hid = isset($_GET['hid']) ? $_GET['hid']!="" ? intval($_GET['hid']) : null : null;
            $bid = isset($_GET['bid']) ? $_GET['bid']!="" ? intval($_GET['bid']) : null : null;
            if($hid == "all")
                $hid = null;
            $show  = $this->input->get('s',null,false);
            $cond = array("isDeleted=0");

            if($this->auth->isHospitalAdmin()){
                $hid = $this->auth->getHospitalId();
                $ids = $this->branches_model->getBracheIds($hid);
                if(count($ids) == 0){
                    //If no Branche created.
                    //Add dummy id to return nothing
                    $ids[] = -1;
                }
                $ids = implode(",", $ids);
                $cond[] = "branch_id in (".$ids.")";
            }
            if($bid == "all"){
                $ids = $this->branches_model->getBracheIds($hid);
                
                if(count($ids) == 0){
                    //If no department created.
                    //Add dummy id to return nothing
                    $ids[] = -1;
                }
                $ids = implode(",", $ids);
                $cond[] = "branch_id in (".$ids.")";
            }else if($bid != null){
                $cond[] = "branch_id = ".$bid;
            }else if($hid!=null){
                $ids = $this->branches_model->getBracheIds($hid);
                if(count($ids) == 0){
                    //If no department created.
                    //Add dummy id to return nothing
                    $ids[] = -1;
                }
                $ids = implode(",", $ids);
                $cond[] = "branch_id in (".$ids.")";
            }else{
                $hids = $this->hospitals_model->getHospicalIds();
                $ids = $this->branches_model->getBracheIds($hids);
                $ids = implode(",",$ids);
                $cond[] = "branch_id in (".$ids.")";
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
