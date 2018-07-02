<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Branches extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('branches_model');
        $this->load->model('general_model');
        $this->load->model('hospitals_model');
    }
    public function index() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $data['branchess'] = $this->branches_model->getAllbranches();
            $data["page_title"] = $this->lang->line('branches');
            $data["breadcrumb"] = array(site_url() => $this->lang->line('home'), null => $this->lang->line('branches'));
            $this->load->view('Branches/index', $data);    
        } else redirect('index/login');
    }
    
    public function search() {
        if ($this->auth->isLoggedIn()) {
            $q = $this->input->get("q", null, "");
            $f = $this->input->get("f", null, "");
            $hid = $this->input->get("hospital_id",null,-1);
            if($hid == -1 && !$this->auth->isSuperAdmin()){
                $hid = $this->auth->getHospitalId();
            }
            
            $result = $this->branches_model->search($q,$f,$hid);
            echo json_encode($result);
        }
    }

    public function add() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $selected_hid = "";
            if(isset($_POST['selected_hid'])){
                $selected_hid = $_POST['selected_hid'];
            }
            if ($this->branches_model->add()) {
                $data['success'] = array($this->lang->line('msg_branch_added'));
            } else {
                $data['errors'] = array($this->lang->line('msg_try_again'));
            }
            $this->session->set_flashdata('data', $data);
            redirect('branches/index?hid='.$selected_hid);
        } else redirect('index/login');
    }
    public function update() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $data = array();
            $selected_hid = "";
            if(isset($_POST['selected_hid'])){
                $selected_hid = $_POST['selected_hid'];
            }
            $id = $this->input->post('eidt_gf_id');
            if ($this->branches_model->update($id)) {
                $data['success'] = array($this->lang->line('msg_branch_updated'));
            } else {
                $data['errors'] = array($this->lang->line('msg_try_again'));
            }
            $this->session->set_flashdata('data', $data);
            redirect('branches/index?hid='.$selected_hid);
        } else redirect('index/login');
    }
    public function delete() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $id = $this->input->post('id');
            echo $this->branches_model->delete($id);
        }
    }
    public function getbranches() {
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo json_encode($this->branches_model->getbranchesById($id));
        }
    }
    public function getDTbranches() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $this->load->library("tbl");
            $table = "hms_branches";
            $primaryKey = "id";
            $columns = array( array("db" => "branch_name", "dt" => 0, "formatter" => function ($d, $row) {
                //return ($d == "" || $d == null) ? "-" : $d;
                return "<a href='#' data-id='$row[id]' class='editbtn' data-toggle='modal' data-target='#edit' data-toggle='tooltip' title='Edit'>".$d."</a>";
            }), array("db" => "phone_number", "dt" => 1, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "city", "dt" => 2, "formatter" => function ($d, $row) {
                return $this->general_model->getCityName($d);
            }), array("db" => "id", "dt" => 3, "formatter" => function ($d, $row) {
                return "<a href=\"#\" id=\"dellink_".$d."\" class=\"delbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Delete\"><i class=\"glyphicon glyphicon-remove\"></i></button>";
            }));
            
            $hospital_id = $this->input->get('hid',null,null);
            if($hospital_id == "all")
                $hospital_id = null;
            $show  = $this->input->get('s',null,false);
            $cond = array("isDeleted=0");
            if($this->auth->isHospitalAdmin()){
                $hid = $this->auth->getHospitalId();
                $cond[] = "hospital_id=".$hid;
            }
            else if($hospital_id!=null){
                $cond[] = "hospital_id=$hospital_id";
            }else{
                $hids = $this->hospitals_model->getHospicalIds();
                if(count($hids) == 0){ $hids[] = -1; }
                $hids = implode(",",$hids);
                $cond[] = "hospital_id in ($hids)";
            }
            
            if($show){
                $this->tbl->setCheckboxColumn(false);
                $columns = array($columns[0],$columns[1],$columns[2]);
                $columns[0]["dt"] = 0;
                $columns[1]["dt"] = 1;
                $columns[2]["dt"] = 2;
                $columns[0]['formatter'] = function($d,$row){return $d;};
                $this->tbl->setIndexColumn(true);
            }
            $this->tbl->setTwID(implode(' AND ',$cond));

            $isExport = isset($_GET['ex']) ? $_GET['ex'] : false;
            if($isExport){
                $this->tbl->setIndexColumn(true);
                $this->tbl->setCheckboxColumn(false);
                $columns[0]['formatter'] = function($d,$row){ return $d;};
                $columns[3] = array("db" => "id", "dt" => 7, "formatter" => function ($d, $row) {
                    return "";
                });
            }

            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }

    public function getDTbranchesSuper($hospital_id=null) {
        if ($this->auth->isLoggedIn()) {
            $this->load->library("tbl");
            $table = "hms_branches";
            $primaryKey = "id";
            $columns = array(array("db" => "branch_name", "dt" => 0, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "phone_number", "dt" => 1, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "city", "dt" => 2, "formatter" => function ($d, $row) {
                return $this->general_model->getCityName($d);
            }), array("db" => "id", "dt" => 3, "formatter" => function ($d, $row) {
                return "<a href=\"#\" id=\"dellink_".$d."\" class=\"delbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Delete\"><i class=\"glyphicon glyphicon-remove\"></i></button>";
            }));
            if($hospital_id!=null){
                $this->tbl->setTwID("hospital_id=$hospital_id");

            }
            if($this->auth->isHospitalAdmin()){
                $hid = $this->auth->getHospitalId();
                $this->tbl->setTwID("hospital_id=".$hid);
            }

            $isExport = isset($_GET['ex']) ? $_GET['ex'] : false;
            if($isExport){
                $this->tbl->setIndexColumn(true);
                $this->tbl->setCheckboxColumn(false);
                $columns[3] = array("db" => "id", "dt" => 7, "formatter" => function ($d, $row) {
                    return "";
                });
            }


            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }
}
