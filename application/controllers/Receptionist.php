<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Receptionist extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('receptionist_model');
        $this->load->model('departments_model');
        $this->load->model('branches_model');
        $this->load->model('doctors_model');
        $this->load->model('hospitals_model');
    }
    public function index() {
        if ($this->auth->isLoggedIn()) {
            $data['receptionists'] = $this->receptionist_model->getAllreceptionist();
            $data["page_title"] = "Receptionist";
            $data["breadcrumb"] = array(site_url() => "Home", null => "Receptionist");
            $this->load->view('Receptionist/index', $data);
        } else redirect('index/login');
    }
    public function search() {
        if ($this->auth->isLoggedIn()) {
            $q = $this->input->get("q", null, "");
            $f = $this->input->get("f", null, "");
            $result = $this->receptionist_model->search($q, $f);
            echo json_encode($result);
        }
    }
    public function add() {
        if ($this->auth->isLoggedIn()) {
            $res = $this->receptionist_model->add();
            if($res === -1){
                $data['errors'] = array($this->lang->line('msg_email_exist'));
            }else if($res === false){
                $data['errors'] = array($this->lang->line('msg_try_again'));
            }else{
                $data['success'] = array("Receptionist Added Successfully");
            }
            $this->session->set_flashdata('data', $data);
            redirect('receptionist/index');
        } else redirect('index/login');
    }
    public function update() {
        if ($this->auth->isLoggedIn()) {
            $data = array();
            $id = $this->input->post('eidt_gf_id');
            $res = $this->receptionist_model->update($id);
            if($res === -1){
                $data['errors'] = array($this->lang->line('msg_email_exist'));
            }else if($res === false){
                $data['errors'] = array($this->lang->line('msg_try_again'));
            }else{
                $data['success'] = array("Receptionist updated Successfully");
            }
            $this->session->set_flashdata('data', $data);
            redirect('receptionist/index');
        } else redirect('index/login');
    }
    public function delete() {
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo $this->receptionist_model->delete($id);
        }
    }
    public function getreceptionist() {
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo json_encode($this->receptionist_model->getreceptionistById($id));
        }
    }
    public function getDTreceptionist() {
        if ($this->auth->isLoggedIn()) {
            $this->load->library("tbl");
            $table = "hms_receptionist";
            $primaryKey = "id";
            $columns = array(array("db" => "user_id", "dt" => 0, "formatter" => function ($d, $row) {
                $this->load->model("users_model");
                $temp = $this->users_model->getusersById($d);
                $name = $temp["first_name"]." ".$temp["last_name"];
                return "<a href='#' data-id='$row[id]' class='editbtn' data-toggle='modal' data-target='#edit' data-toggle='tooltip' title='Edit'>".$name."</a>";
            }), array("db" => "doc_id", "dt" => 1, "formatter" => function ($d, $row) {
                
                $doc = $this->doctors_model->getdoctorsById($d);
                if(!isset($doc['department_id']))
                    return "-";   
                $temp = $this->departments_model->getdepartmentsById($doc['department_id']);
                if(!isset($temp['branch_id']))
                    return "-"; 
                $branch = $this->branches_model->getbranchesById($temp['branch_id']);
                if(!isset($branch['hospital_id']))
                    return "-"; 
                $hospital = $this->hospitals_model->gethospitalsById($branch['hospital_id']);
                if(!isset($hospital['name']))
                    return "-"; 
                return $hospital["name"];

            }), array("db" => "doc_id", "dt" => 2, "formatter" => function ($d, $row) {
                $doc = $this->doctors_model->getdoctorsById($d);
                if(!isset($doc['department_id']))
                    return "-"; 
                $temp = $this->departments_model->getdepartmentsById($doc['department_id']);
                if(!isset($temp['branch_id']))
                    return "-"; 
                $branch = $this->branches_model->getbranchesById($temp['branch_id']);
                if(!isset($branch['branch_name']))
                    return "-"; 
                return $branch["branch_name"];

            }), array("db" => "doc_id", "dt" => 3, "formatter" => function ($d, $row) {
                $doc = $this->doctors_model->getdoctorsById($d);
                if(!isset($doc['department_id']))
                    return "-"; 
                $temp = $this->departments_model->getdepartmentsById($doc['department_id']);
                if(!isset($temp['department_name']))
                    return "-"; 
                return $temp["department_name"];
            }),array("db" => "doc_id", "dt" => 4, "formatter" => function ($d, $row) {
                $temp = $this->doctors_model->getdoctorsById($d);
                $name = "-";
                if(isset($temp['first_name'])){
                    $name = $temp['first_name'].' '.$temp['last_name'];
                }
                return $name;
            }),array("db" => "isActive", "dt" => 5, "formatter" => function ($d, $row) {
                return $this->auth->getActiveStatus($d);
            }), array("db" => "id", "dt" => 6, "formatter" => function ($d, $row) {
                return "<a href=\"#\" id=\"dellink_".$d."\" class=\"delbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Delete\"><i class=\"glyphicon glyphicon-remove\"></i></button>";
            }));

            $hospital_id = $this->input->get('hid',null,null);
            $show  = $this->input->get('s',null,false);
            $cond = array("isDeleted=0");
            if($this->auth->isHospitalAdmin()){
                $ids = $this->doctors_model->getDoctorsIdsByHospitalId($this->auth->getHospitalId());
                $ids = implode(",", $ids);
                $cond[] = "doc_id in (".$ids.")";
            }else if($hospital_id!=null){
                $ids = $this->doctors_model->getDoctorsIdsByHospitalId($hospital_id);
                if(count($ids) == 0){
                    $ids[] = -1;
                }
                $ids = implode(",", $ids);
                $cond[] = "doc_id in (".$ids.")";
            }

            if($show){
                $this->tbl->setCheckboxColumn(false);
                $columns = array($columns[0],$columns[2],$columns[3],$columns[4],$columns[5]);
                $columns[0]["dt"] = 0;
                $columns[1]["dt"] = 1;
                $columns[2]['dt'] = 2;
                $columns[3]['dt'] = 3;
                $columns[4]['dt'] = 4;
                $columns[0]['formatter'] =  function ($d, $row) {
                    $this->load->model("users_model");
                    $temp = $this->users_model->getusersById($d);
                    $name = $temp["first_name"]." ".$temp["last_name"];
                    return $name;
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
