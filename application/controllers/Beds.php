<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Beds extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('beds_model');
        $this->load->model('branches_model');
        $this->load->model('departments_model');
        $this->load->model('hospitals_model');
        $this->load->model('wards_model');
    }
    public function index() {
        if ($this->auth->isLoggedIn()) {
            $data['bedss'] = $this->beds_model->getAllbeds();
            $data["page_title"] = "Beds";
            $data["breadcrumb"] = array(site_url() => "Home", null => "Beds");
            $this->load->view('Beds/index', $data);
        } else redirect('index/login');
    }
    public function search() {
        if ($this->auth->isLoggedIn()) {
            $q = $this->input->get("q", null, "");
            $f = $this->input->get("f", null, "");
            $result = $this->beds_model->search($q, $f);
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
            if(isset($_POST['selected_did'])){
                $query[] = "did=".$_POST['selected_did'];
            }
            
            if ($this->beds_model->add()) {
                $data['success'] = array("Bed Added Successfully");
            } else {
                $data['errors'] = array("Please again later");
            }
            $this->session->set_flashdata('data', $data);
            $qry = implode("&",$query);
            redirect('beds/index?'.$qry);
        } else redirect('index/login');
    }
    public function update() {
        if ($this->auth->isLoggedIn()) {
            $query =array();
            if(isset($_POST['selected_hid'])){
                $query[] = "hid=".$_POST['selected_hid'];
            }
            if(isset($_POST['selected_bid'])){
                $query[] = "bid=".$_POST['selected_bid'];
            }
            if(isset($_POST['selected_did'])){
                $query[] = "did=".$_POST['selected_did'];
            }
            $data = array();
            $id = $this->input->post('eidt_gf_id');
            if ($this->beds_model->update($id)) {
                $data['success'] = array("Bed Updated Successfully");
            } else {
                $data['errors'] = array("Please again later");
            }
            $this->session->set_flashdata('data', $data);
            $qry = implode("&",$query);
            redirect('beds/index?'.$qry);
        } else redirect('index/login');
    }
    public function delete() {
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo $this->beds_model->delete($id);
        }
    }
    public function getbeds() {
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo json_encode($this->beds_model->getbedsById($id));
        }
    }
    public function getDTbeds() {
        if ($this->auth->isLoggedIn()) {
            $this->load->library("tbl");
            $table = "hms_beds";
            $primaryKey = "id";
            $columns = array(array("db" => "ward_id", "dt" => 0, "formatter" => function ($d, $row) {
                $this->load->model("wards_model");
                $temp = $this->wards_model->getwardsById($d);
                return $temp['ward_name'];
            }), array("db" => "bed", "dt" => 1, "formatter" => function ($d, $row) {
                return "<a href='#' data-id='$row[id]' class='editbtn' data-toggle='modal' data-target='#edit' data-toggle='tooltip' title='Edit'>".$d."</a>";
            }), array("db" => "id", "dt" => 2, "formatter" => function ($d, $row) {
                return "<a href=\"#\" id=\"dellink_".$d."\" class=\"delbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Delete\"><i class=\"glyphicon glyphicon-remove\"></i></button>";
            }));

            $hid = isset($_GET['hid']) ? $_GET['hid']!="" ? intval($_GET['hid']) : null : null;
            $bid = isset($_GET['bid']) ? $_GET['bid']!="" ? intval($_GET['bid']) : null : null;
            $did = isset($_GET['did']) ? $_GET['did']!="" ? intval($_GET['did']) : null : null;
            $cond = array();

            if($hid == "all")
                $hid = null;
            
            if($did != "all" && $did != null){
                $wids = $this->wards_model->getWardIdsFromDepartment($did);
                if(count($wids) == 0){
                    //If no department created.
                    //Add dummy id to return nothing
                    $wids[] = -1;
                }
                $ids = implode(",", $wids);
                $cond[] = "ward_id in (".$ids.")";
            }else if($bid == "all"){
                $bids = $this->branches_model->getBracheIds($hid);
                $ids = $this->wards_model->getWardIdsFromBranch($bids);
                if(count($ids) == 0){
                    //If no department created.
                    //Add dummy id to return nothing
                    $ids[] = -1;
                }
                $ids = implode(",", $ids);
                $cond[] = "ward_id in (".$ids.")";
            }else if($bid != null){
                $ids = $this->wards_model->getWardIdsFromBranch($bid);
                if(count($ids) == 0){
                    //If no department created.
                    //Add dummy id to return nothing
                    $ids[] = -1;
                }
                $ids = implode(",", $ids);
                $cond[] = "ward_id in (".$ids.")";
            }else if($hid!=null){
                $ids = $this->wards_model->getWardIdsFromHospital($hid);
                if(count($ids) == 0){
                    //If no department created.
                    //Add dummy id to return nothing
                    $ids[] = -1;
                }
                $ids = implode(",", $ids);
                $cond[] = "ward_id in (".$ids.")";
            }else{
                $hids = $this->hospitals_model->getHospicalIds();
                $ids = $this->wards_model->getWardIdsFromHospital($hids);
                $ids = implode(",",$ids);
                $cond[] = "ward_id in (".$ids.")";
            }

            $show = $this->input->get("s",null,false);
            if($show){
                $this->tbl->setCheckboxColumn(false);
                $columns[1]['formatter'] = function ($d, $row) { return $d; };
                unset($columns[2]);
                $this->tbl->setIndexColumn(true);
            }
            
            $this->tbl->setTwID(implode(" AND ",$cond));
            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }

    public function getDTbedsOld($hospital_id=null) {
        if ($this->auth->isLoggedIn()) {
            $this->load->library("tbl");
            $table = "hms_beds";
            $primaryKey = "id";
            $columns = array(array("db" => "ward_id", "dt" => 0, "formatter" => function ($d, $row) {
                $this->load->model("wards_model");
                $temp = $this->wards_model->getwardsById($d);
                return $temp['ward_name'];
            }), array("db" => "bed", "dt" => 1, "formatter" => function ($d, $row) {
                return "<a href='#' data-id='$row[id]' class='editbtn' data-toggle='modal' data-target='#edit' data-toggle='tooltip' title='Edit'>".$d."</a>";
            }), array("db" => "id", "dt" => 2, "formatter" => function ($d, $row) {
                return "<a href=\"#\" id=\"dellink_".$d."\" class=\"delbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Delete\"><i class=\"glyphicon glyphicon-remove\"></i></button>";
            }));
            if($hospital_id!=null){
                $ids = $this->departments_model->getDepartmentIdsFromHospital($hospital_id);
                if(count($ids) == 0){
                    //If no department created.
                    //Add dummy id to return nothing
                    $ids[] = -1;
                }
                $ids = implode(",", $ids);
                $this->tbl->setTwID("department_id in (".$ids.")");
                $columns = array(
                    array("db" => "department_id", "dt" => 0, "formatter" => function ($d, $row) {
                        $this->load->model("departments_model");
                        $temp = $this->departments_model->getBranch($d);
                        return $temp['branch_name'];
                    }),      
                    $columns[0],$columns[1]
                );
                $columns[1]['dt'] = 1;
                $columns[2]['dt'] = 2;
                $columns[1]['formatter'] =  function ($d, $row) {
                    $this->load->model("departments_model");
                    $temp = $this->departments_model->getdepartmentsById($d);
                    return $temp['department_name'];
                };
                $this->tbl->setIndexColumn(true);
            }

            if($this->auth->isHospitalAdmin()){
                $ids = implode(",", $this->auth->getAllDepartmentsIds());
                $this->tbl->setTwID("department_id in (".$ids.")");
            }

            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }
}
