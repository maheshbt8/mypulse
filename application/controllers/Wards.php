<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Wards extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('wards_model');
        $this->load->model('departments_model');
        $this->load->model('branches_model');
        $this->load->model('hospitals_model');
    }
    public function index() {
        if ($this->auth->isLoggedIn()) {
            $data['wardss'] = $this->wards_model->getAllwards();
            $data["page_title"] = "Wards";
            $data["breadcrumb"] = array(site_url() => "Home", null => "Wards");
            $this->load->view('Wards/index', $data);
        } else redirect('index/login');
    }
    public function search() {
        if ($this->auth->isLoggedIn()) {
            $q = $this->input->get("q", null, "");
            $f = $this->input->get("f", null, "");
            $did = $this->input->get("department_id",null,0);
            $result = $this->wards_model->search($q, $f, $did);
            echo json_encode($result);
        }
    }
    public function add() {
        if ($this->auth->isLoggedIn()) {
            $query = array();
            if(isset($_POST['selected_hid'])){
                $query[] = "hid=".$_POST['selected_hid'];
            }
            if(isset($_POST['selected_bid'])){
                $query[] = "bid=".$_POST['selected_bid'];
            }
            if(isset($_POST['selected_did'])){
                $query[] = "did=".$_POST['selected_did'];
            }
            $qry = implode("&",$query);
            if ($this->wards_model->add()) {
                $data['success'] = array("Wards Added Successfully");
            } else {
                $data['errors'] = array("Please again later");
            }
            $this->session->set_flashdata('data', $data);
            redirect('wards/index?'.$qry);
        } else redirect('index/login');
    }
    public function update() {
        if ($this->auth->isLoggedIn()) {
            $query = array();
            if(isset($_POST['selected_hid'])){
                $query[] = "hid=".$_POST['selected_hid'];
            }
            if(isset($_POST['selected_bid'])){
                $query[] = "bid=".$_POST['selected_bid'];
            }
            if(isset($_POST['selected_did'])){
                $query[] = "did=".$_POST['selected_did'];
            }
            $qry = implode("&",$query);
            $data = array();
            $id = $this->input->post('eidt_gf_id');
            if ($this->wards_model->update($id)) {
                $data['success'] = array("Wards Updated Successfully");
            } else {
                $data['errors'] = array("Please again later");
            }
            $this->session->set_flashdata('data', $data);
            redirect('wards/index?'.$qry);
        } else redirect('index/login');
    }
    public function delete() {
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo $this->wards_model->delete($id);
        }
    }
    public function getwards() {
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo json_encode($this->wards_model->getwardsById($id));
        }
    }
    public function getDTwards() {
        if ($this->auth->isLoggedIn()) {
            $this->load->library("tbl");
            $table = "hms_wards";
            $primaryKey = "id";
            $columns = array( array("db" => "ward_name", "dt" => 0, "formatter" => function ($d, $row) {
                return "<a href='#' data-id='$row[id]' class='editbtn' data-toggle='modal' data-target='#edit' data-toggle='tooltip' title='Edit'>".$d."</a>";
            }), array("db" => "id", "dt" => 1, "formatter" => function ($d, $row) {
                return "<a href=\"#\" id=\"dellink_".$d."\" class=\"delbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Delete\"><i class=\"glyphicon glyphicon-remove\"></i></button>";
            }));

            $hid = isset($_GET['hid']) ? $_GET['hid']!="" ? $_GET['hid'] : null : null;
            $bid = isset($_GET['bid']) ? $_GET['bid']!="" ? $_GET['bid'] : null : null;
            $did = isset($_GET['did']) ? $_GET['did']!="" ? $_GET['did'] : null : null;
            $cond = array();

            if($hid == "all")
                $hid = null;

            if($did != "all" && $did != null){
                $cond[] = "department_id = '$did'";
            }else if($bid == "all"){
                $bids = $this->branches_model->getBracheIds($hid);
                $ids = $this->departments_model->getDepartmentIdsFromBranch($bids);
                $ids = implode(",", $ids);
                $cond[] = "department_id in (".$ids.")";
            }else if($bid != null){
                $ids = $this->departments_model->getDepartmentIdsFromBranch($bid);
                if(count($ids) == 0){
                    //If no department created.
                    //Add dummy id to return nothing
                    $ids[] = -1;
                }
                $ids = implode(",", $ids);
                $cond[] = "department_id in (".$ids.")";
            }else if($hid!=null){
                $ids = $this->departments_model->getDepartmentIdsFromHospital($hid);
                if(count($ids) == 0){
                    //If no department created.
                    //Add dummy id to return nothing
                    $ids[] = -1;
                }
                $ids = implode(",", $ids);
                $cond[] = "department_id in (".$ids.")";
            }else{
                $hids = $this->hospitals_model->getHospicalIds();
                $ids = $this->departments_model->getDepartmentIdsFromHospital($hids);
                $ids = implode(",",$ids);
                $cond[] = "department_id in (".$ids.")";
            }
            
            $this->tbl->setTwID(implode(" AND ",$cond));

            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }
}
