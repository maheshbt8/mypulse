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
        $this->load->model('beds_model');
    }
    public function index() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $data['wardss'] = $this->wards_model->getAllwards();
            $data["page_title"] = $this->lang->line('wards');
            $data["breadcrumb"] = array(site_url() => $this->lang->line('home'), null => $this->lang->line('wards'));
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
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
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
                $data['success'] = array($this->lang->line('msg_ward_added'));
            } else {
                $data['errors'] = array($this->lang->line('msg_try_again'));
            }
            $this->session->set_flashdata('data', $data);
            redirect('wards/index?'.$qry);
        } else redirect('index/login');
    }
    public function update() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
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
                $data['success'] = array($this->lang->line('msg_ward_updated'));
            } else {
                $data['errors'] = array($this->lang->line('msg_try_again'));
            }
            $this->session->set_flashdata('data', $data);
            redirect('wards/index?'.$qry);
        } else redirect('index/login');
    }
    public function delete() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
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
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $this->load->library("tbl");
            $table = "hms_wards";
            $primaryKey = "id";
            $columns = array( array("db" => "ward_name", "dt" => 0, "formatter" => function ($d, $row) {
                return "<a href='#' data-id='$row[id]' class='editbtn' data-toggle='modal' data-target='#edit' data-toggle='tooltip' title='Edit'>".$d."</a>";
            }), array("db" => "id", "dt" => 1, "formatter" => function ($d, $row) {
                return $this->beds_model->getTotalBedsByWard($d);
            }),array("db" => "id", "dt" => 2, "formatter" => function ($d, $row) {
                return $this->beds_model->getTotalAvailableBedsByWard($d);
            }),array("db" => "id", "dt" => 3, "formatter" => function ($d, $row) {
			if($this->session->userdata('hospital_id')){
				$hospitalid = $this->session->userdata('hospital_id');
					}else{
			    $hospitalid = $this->input->get('hid');
				}
                return "<a href=".base_url("beds/index/?hid=".$hospitalid."&&bid=".$this->input->get('bid')."&&did=".$this->input->get('did')."")." id=\"dellink_".$d."\" title=\"View Beds\"><i class=\"glyphicon glyphicon-eye-open\"></i></button>";
            }),array("db" => "id", "dt" => 4, "formatter" => function ($d, $row) {
                return "<a href=\"#\" id=\"dellink_".$d."\" class=\"delbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Delete\"><i class=\"glyphicon glyphicon-remove\"></i></button>";
            }));

            $hid = isset($_GET['hid']) ? $_GET['hid']!="" ? $_GET['hid'] : null : null;
            $bid = isset($_GET['bid']) ? $_GET['bid']!="" ? $_GET['bid'] : null : null;
            $did = isset($_GET['did']) ? $_GET['did']!="" ? $_GET['did'] : null : null;
            $show  = $this->input->get('s',null,false);
            $cond = array("isDeleted=0");

            if($hid == "all")
                $hid = null;

            if($did != "all" && $did != null){
                $cond[] = "department_id = '$did'";
            }else if($bid == "all"){
                $bids = $this->branches_model->getBracheIds($hid);
                $ids = $this->departments_model->getDepartmentIdsFromBranch($bids);
                if(count($ids) == 0){
                    //If no department created.
                    //Add dummy id to return nothing
                    $ids[] = -1;
                }
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
                if(count($ids) == 0){
                    $ids[] = -1;
                }
                $ids = implode(",",$ids);
                $cond[] = "department_id in (".$ids.")";
            }

            if($show){
                $this->tbl->setCheckboxColumn(false);
                $columns = array(
                    array("db" => "department_id", "dt" => 0, "formatter" => function ($d, $row) {
                        $temp = $this->departments_model->getdepartmentsById($d);
                        return $temp['department_name'];
                    }),$columns[0],$columns[1],$columns[2]);
                $columns[1]["dt"] = 1;
                $columns[2]["dt"] = 2;
                $columns[3]["dt"] = 3;
                $columns[1]['formatter'] = function($d,$row){return $d;};
                $this->tbl->setIndexColumn(true);
            }

            $this->tbl->setTwID(implode(" AND ",$cond));

            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }
	
	public function getDTNursewards() {
        if ($this->auth->isLoggedIn() ) {

            $hid = isset($_GET['hid']) ? $_GET['hid']!="" ? intval($_GET['hid']) : null : null;
            $bid = isset($_GET['bid']) ? $_GET['bid']!="" ? intval($_GET['bid']) : null : null;
            $did = isset($_GET['did']) ? $_GET['did']!="" ? intval($_GET['did']) : null : null;
            $cond = array("hms_beds.isDeleted = 0");

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
                $cond[] = "hms_beds.ward_id in (".$ids.")";
            }else if($bid == "all"){
                $bids = $this->branches_model->getBracheIds($hid);
                $ids = $this->wards_model->getWardIdsFromBranch($bids);
                if(count($ids) == 0){
                    //If no department created.
                    //Add dummy id to return nothing
                    $ids[] = -1;
                }
                $ids = implode(",", $ids);
                $cond[] = "hms_beds.ward_id in (".$ids.")";
            }else if($bid != null){
                $ids = $this->wards_model->getWardIdsFromBranch($bid);
                if(count($ids) == 0){
                    //If no department created.
                    //Add dummy id to return nothing
                    $ids[] = -1;
                }
                $ids = implode(",", $ids);
                $cond[] = "hms_beds.ward_id in (".$ids.")";
            }else if($hid!=null){
                $ids = $this->wards_model->getWardIdsFromHospital($hid);
                if(count($ids) == 0){
                    //If no department created.
                    //Add dummy id to return nothing
                    $ids[] = -1;
                }
                $ids = implode(",", $ids);
                $cond[] = "hms_beds.ward_id in (".$ids.")";
            }else{
                $hids = $this->hospitals_model->getHospicalIds();
                $ids = $this->wards_model->getWardIdsFromHospital($hids);
                if(count($ids) == 0){
                    //If no department created.
                    //Add dummy id to return nothing
                    $ids[] = -1;
                }
                $ids = implode(",",$ids);
                $cond[] = "hms_beds.ward_id in (".$ids.")";
            }

            //New Library
            $this->load->library('datatables');		
            $this->datatables
                ->showIndex(true)
                ->from('hms_beds')
                ->select('hms_beds.id as mainid,hms_wards.ward_name as wname, hms_beds.bed as bed, case when hms_beds.isAvailable=0 then "No" when hms_beds.isAvailable=1 then "Yes" end as status, CONCAT(hms_users.first_name," ",hms_users.last_name) as pname, hms_inpatient.id as action_pid',false)
                ->join('hms_wards','hms_beds.ward_id = hms_wards.id','left')
                ->join('hms_inpatient','hms_beds.id = hms_inpatient.bed_id','left')
                ->join('hms_users','hms_inpatient.user_id = hms_users.id','left')
                ->edit_column('pname','<a href="'.site_url().'nurse/inpatient?sip=1&pid=$1">$2</a>','action_pid, pname')
                ->unset_column('action_pid');
            
            //Set condition to new library
            foreach($cond as $con){
                $this->datatables->where($con);
            }

            //Call new library for output
            echo $this->datatables->generate('json');

        }
    }
}
