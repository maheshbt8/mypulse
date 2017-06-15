<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Departments extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('departments_model');
        $this->load->model('branches_model');
        $this->load->model('hospitals_model');
    }
    public function index() {
        if ($this->auth->isLoggedIn()) {
            $data['departmentss'] = $this->departments_model->getAlldepartments();
            $data["page_title"] = "Departments";
            $data["breadcrumb"] = array(site_url() => "Home", null => "Departments");
           
            $this->load->view('Departments/index', $data);
        } else redirect('index/login');
    }
    public function search() {
        if ($this->auth->isLoggedIn()) {
            $q = $this->input->get("q", null, "");
            $f = $this->input->get("f", null, "");
            $hid = $this->input->get("hospital_id",null,-1);
            $bid = $this->input->get("branch_id",null,-1);

            /*if(!$this->auth->isSuperAdmin()){
                $hid = $this->auth->getHospitalId();
            }*/

            $result = $this->departments_model->search($q, $f,$hid,$bid);
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
            if ($this->departments_model->add()) {
                $data['success'] = array("Department Added Successfully");
            } else {
                $data['errors'] = array("Please again later");
            }
            $this->session->set_flashdata('data', $data);
            $qry = implode("&",$query);
            redirect('departments/index?='.$qry);
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
            if ($this->departments_model->update($id)) {
                $data['success'] = array("Department Updated Successfully");
            } else {
                $data['errors'] = array("Please again later");
            }
            $this->session->set_flashdata('data', $data);
            $qry = implode("&",$query);
            redirect('departments/index?='.$qry);
        } else redirect('index/login');
    }
    public function delete() {
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo $this->departments_model->delete($id);
        }
    }
    public function getdepartments() {
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo json_encode($this->departments_model->getdepartmentsById($id));
        }
    }
    public function getDTdepartments() {
        if ($this->auth->isLoggedIn()) {
            $this->load->library("tbl");
            $table = "hms_departments";
            $primaryKey = "id";
            $columns = array( array("db" => "department_name", "dt" => 0, "formatter" => function ($d, $row) {
                return "<a href='#' data-id='$row[id]' class='editbtn' data-toggle='modal' data-target='#edit' data-toggle='tooltip' title='Edit'>".$d."</a>";
            }), array("db" => "id", "dt" => 1, "formatter" => function ($d, $row) {
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
                $columns = array(
                    array("db" => "branch_id", "dt" => 0, "formatter" => function ($d, $row) {
                        $this->load->model("branches_model");
                        $temp = $this->branches_model->getbranchesById($d);
                        return $temp['branch_name'];
                    }),$columns[0]);
                $columns[1]["dt"] = 1;
                $columns[1]['formatter'] = function($d,$row){return $d;};
                $this->tbl->setIndexColumn(true);
            }
            $this->tbl->setTwID(implode(' AND ',$cond));

            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }

    public function getDTdepartmentsSuper(){
        if ($this->auth->isLoggedIn()) {
            $this->load->library("tbl");
            $table = "hms_departments";
            $primaryKey = "id";
            $columns = array(array("db" => "branch_id", "dt" => 0, "formatter" => function ($d, $row) {
                $this->load->model("branches_model");
                $temp = $this->branches_model->getbranchesById($d);
                return $temp['branch_name'];
            }), array("db" => "department_name", "dt" => 1, "formatter" => function ($d, $row) {
                return "<a href='#' data-id='$row[id]' class='editbtn' data-toggle='modal' data-target='#edit' data-toggle='tooltip' title='Edit'>".$d."</a>";
            }), array("db" => "id", "dt" => 2, "formatter" => function ($d, $row) {
                return "<a href=\"#\" id=\"dellink_".$d."\" class=\"delbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Delete\"><i class=\"glyphicon glyphicon-remove\"></i></button>";
            }));
            
            $hospital_id = $this->input->get('hid',null,null);
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
            else if($hospital_id!=null){
                $ids = $this->branches_model->getBracheIds($hospital_id);
                if(count($ids) == 0){
                    //If no Branche created.
                    //Add dummy id to return nothing
                    $ids[] = -1;
                }
                $ids = implode(",", $ids);
                $cond[] = "branch_id in (".$ids.")";
            }

            if($show){
                $this->tbl->setCheckboxColumn(false);
                $columns = array($columns[0],$columns[1]);
                $columns[0]["dt"] = 0;
                $columns[1]["dt"] = 1;
                $columns[1]['formatter'] = function($d,$row){return $d;};
                $this->tbl->setIndexColumn(true);
            }
            $this->tbl->setTwID(implode(' AND ',$cond));
            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }
}
