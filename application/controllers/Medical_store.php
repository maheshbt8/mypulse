<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Medical_store extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('medical_store_model');
        $this->load->model('hospitals_model');
        $this->load->model("branches_model");
    }
    public function index() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $data['medical_stores'] = $this->medical_store_model->getAllmedical_store();
            $data["page_title"] = $this->lang->line('medicalStoreFull');
            $data["breadcrumb"] = array(site_url() => $this->lang->line('home'), null => $this->lang->line('medicalStoreFull'));
            $this->load->view('Medical_store/index', $data);
        } else redirect('index/login');
    }
    public function search() {
        if ($this->auth->isLoggedIn()) {
            $q = $this->input->get("q", null, "");
            $f = $this->input->get("f", null, "");
            $result = $this->medical_store_model->search($q, $f);
            echo json_encode($result);
        }
    }
    public function add() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $res = $this->medical_store_model->add();
            $data = $this->auth->parseUserResult($res,$this->lang->line('msg_medstore_added'));
           
            $this->session->set_flashdata('data', $data);
            redirect('medical_store/index');
        } else redirect('index/login');
    }
    public function update() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            
            $id = $this->input->post('eidt_gf_id');
            $res = $this->medical_store_model->update($id);
            $data = $this->auth->parseUserResult($res,$this->lang->line('msg_medstore_updated'));
            
            $this->session->set_flashdata('data', $data);
            redirect('medical_store/index');
        } else redirect('index/login');
    }
    public function delete() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $id = $this->input->post('id');
            echo $this->medical_store_model->delete($id);
        }
    }
    public function getmedical_store() {
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo json_encode($this->medical_store_model->getmedical_storeById($id));
        }
    }
    public function getDTmedical_store() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $this->load->library("tbl");
            $table = "hms_medical_store";
            $primaryKey = "id";
            $columns = array(array("db" => "name", "dt" => 0, "formatter" => function ($d, $row) {
                return "<a href='#' data-id='$row[id]' class='editbtn' data-toggle='modal' data-target='#edit' data-toggle='tooltip' title='Edit'>$d</a>";
            }), array("db" => "owner_name", "dt" => 1, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "owner_contact_number", "dt" => 2, "formatter" => function ($d, $row) {
                return ($d == "" || $d == null) ? "-" : $d;
            }), array("db" => "branch_id", "dt" => 3, "formatter" => function ($d, $row) {
                $temp = $this->branches_model->getbranchesById($d);
                if(!isset($temp['hospital_id']))
                    return "-";
                $hospital = $this->hospitals_model->gethospitalsById($temp['hospital_id']);
                if(!isset($hospital['name']))
                    return "-";
                return $hospital["name"];
            }),array("db" => "branch_id", "dt" => 4, "formatter" => function ($d, $row) {
                $temp = $this->branches_model->getbranchesById($d);
                if(!isset($temp['branch_name']))
                    return "-";
                return $temp["branch_name"];
            }), array("db" => "id", "dt" => 5, "formatter" => function ($d, $row) {
                return "<a href=\"#\" id=\"dellink_".$d."\" class=\"delbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Delete\"><i class=\"glyphicon glyphicon-remove\"></i></button>";
            }));

            $hospital_id = $this->input->get('hid',null,null);
            $show  = $this->input->get('s',null,false);
            $cond = array("isDeleted=0");
            if($this->auth->isHospitalAdmin()){
                $ids = $this->auth->getBranchIds();
                $ids = implode(",", $ids);
                $cond[] = "branch_id in (".$ids.")";
            }else if($hospital_id!=null){
                $ids = $this->branches_model->getBracheIds($hospital_id);
                if(count($ids) == 0){
                    $ids[] = -1;
                }
                $ids = implode(",", $ids);
                $cond[] = "branch_id in (".$ids.")";
            }

            if($show){
                $this->tbl->setCheckboxColumn(false);
                $columns = array($columns[0],$columns[1],$columns[2],$columns[4]);
                $columns[0]["dt"] = 0;
                $columns[1]["dt"] = 1;
                $columns[2]['dt'] = 2;
                $columns[3]['dt'] = 3;
                $columns[0]['formatter'] =  function ($d, $row) {
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
