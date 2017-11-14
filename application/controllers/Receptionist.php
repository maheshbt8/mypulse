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
            if($this->auth->isReceptinest()){
                redirect('index');
            }else if($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin()){
                $data['receptionists'] = $this->receptionist_model->getAllreceptionist();
                $data["page_title"] = $this->lang->line('receptionists');
                $data["breadcrumb"] = array(site_url() => $this->lang->line('home'), null => $this->lang->line('receptionists'));
                $this->load->view('Receptionist/index', $data);
            }
        } else redirect('index/login');
    }
    public function patient() {
        if ($this->auth->isLoggedIn()) {
            if($this->auth->isReceptinest()){
                $this->load->view('Patient/doctor');
            }
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
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $res = $this->receptionist_model->add();
            $data = $this->auth->parseUserResult($res,$this->lang->line('msg_receptionist_added'));
            $this->session->set_flashdata('data', $data);
            redirect('receptionist/index');
        } else redirect('index/login');
    }
    public function update() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $id = $this->input->post('eidt_gf_id');
            $res = $this->receptionist_model->update($id);
            $data = $this->auth->parseUserResult($res,$this->lang->line('msg_receptionist_updated'));
            $this->session->set_flashdata('data', $data);
            redirect('receptionist/index');
        } else redirect('index/login');
    }
    public function delete() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
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
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isDoctor() || $this->auth->isHospitalAdmin())) {
            // $this->load->library("tbl");
            // $table = "hms_receptionist";
            // $primaryKey = "id";
            // $columns = array(array("db" => "user_id", "dt" => 0, "formatter" => function ($d, $row) {
            //     $this->load->model("users_model");
            //     $temp = $this->users_model->getusersById($d);
            //     $name = $temp["first_name"]." ".$temp["last_name"];
            //     return "<a href='#' data-id='$row[id]' class='editbtn' data-toggle='modal' data-target='#edit' data-toggle='tooltip' title='Edit'>".$name."</a>";
            // }), array("db" => "doc_id", "dt" => 1, "formatter" => function ($d, $row) {
                
            //     $doc = $this->doctors_model->getdoctorsById($d);
            //     if(!isset($doc['department_id']))
            //         return "-";   
            //     $temp = $this->departments_model->getdepartmentsById($doc['department_id']);
            //     if(!isset($temp['branch_id']))
            //         return "-"; 
            //     $branch = $this->branches_model->getbranchesById($temp['branch_id']);
            //     if(!isset($branch['hospital_id']))
            //         return "-"; 
            //     $hospital = $this->hospitals_model->gethospitalsById($branch['hospital_id']);
            //     if(!isset($hospital['name']))
            //         return "-"; 
            //     return $hospital["name"];

            // }), array("db" => "doc_id", "dt" => 2, "formatter" => function ($d, $row) {
            //     $doc = $this->doctors_model->getdoctorsById($d);
            //     if(!isset($doc['department_id']))
            //         return "-"; 
            //     $temp = $this->departments_model->getdepartmentsById($doc['department_id']);
            //     if(!isset($temp['branch_id']))
            //         return "-"; 
            //     $branch = $this->branches_model->getbranchesById($temp['branch_id']);
            //     if(!isset($branch['branch_name']))
            //         return "-"; 
            //     return $branch["branch_name"];

            // }), array("db" => "doc_id", "dt" => 3, "formatter" => function ($d, $row) {
            //     $doc = $this->doctors_model->getdoctorsById($d);
            //     if(!isset($doc['department_id']))
            //         return "-"; 
            //     $temp = $this->departments_model->getdepartmentsById($doc['department_id']);
            //     if(!isset($temp['department_name']))
            //         return "-"; 
            //     return $temp["department_name"];
            // }),array("db" => "doc_id", "dt" => 4, "formatter" => function ($d, $row) {
            //     $temp = $this->doctors_model->getdoctorsById($d);
            //     $name = "-";
            //     if(isset($temp['first_name'])){
            //         $name = $temp['first_name'].' '.$temp['last_name'];
            //     }
            //     return $name;
            // }),array("db" => "isActive", "dt" => 5, "formatter" => function ($d, $row) {
            //     return $this->auth->getActiveStatus($d);
            // }), array("db" => "id", "dt" => 6, "formatter" => function ($d, $row) {
            //     return "<a href=\"#\" id=\"dellink_".$d."\" class=\"delbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Delete\"><i class=\"glyphicon glyphicon-remove\"></i></button>";
            // }));

            $hospital_id = $this->input->get('hid',null,null);
            $show  = $this->input->get('s',null,false);
            $cond = array("hms_receptionist.isDeleted=0");
            if($this->auth->isHospitalAdmin()){
                $ids = $this->doctors_model->getDoctorsIdsByHospitalId($this->auth->getHospitalId());
                $ids = implode(",", $ids);
                $cond[] = "hms_receptionist.doc_id in (".$ids.")";
            }else if($this->auth->isDoctor()){
                $did = $this->auth->getDoctorId();
                $cond[] = "hms_receptionist.doc_id=".$did;
                
            }else if($hospital_id!=null){
                $ids = $this->doctors_model->getDoctorsIdsByHospitalId($hospital_id);
                if(count($ids) == 0){
                    $ids[] = -1;
                }
                $ids = implode(",", $ids);
                $cond[] = "hms_receptionist.doc_id in (".$ids.")";
            }

            // if($show){
            //     $this->tbl->setCheckboxColumn(false);
            //     $columns = array($columns[0],$columns[2],$columns[3],$columns[4],$columns[5]);
            //     $columns[0]["dt"] = 0;
            //     $columns[1]["dt"] = 1;
            //     $columns[2]['dt'] = 2;
            //     $columns[3]['dt'] = 3;
            //     $columns[4]['dt'] = 4;
            //     $columns[0]['formatter'] =  function ($d, $row) {
            //         $this->load->model("users_model");
            //         $temp = $this->users_model->getusersById($d);
            //         $name = $temp["first_name"]." ".$temp["last_name"];
            //         return $name;
            //     };
            //     $this->tbl->setIndexColumn(true);
            // }
            


            if($show){
                $this->datatables
                    ->showIndex(true)
                    ->from('hms_receptionist') 
                    ->select('hms_receptionist.id as mainid, CONCAT(hms_users.first_name," ",hms_users.last_name) as repname,  hms_branches.branch_name as bname, hms_departments.department_name as dname, CONCAT(docuser.first_name," ",docuser.last_name) as docname, case when hms_receptionist.isActive=1 THEN "'.$this->lang->line('active').'" when hms_receptionist.isActive=0 THEN "'.$this->lang->line('inactive').'" end as status', false)
                    ->join('hms_doctors','hms_receptionist.doc_id = hms_doctors.id','left')
                    ->join('hms_users','hms_receptionist.user_id = hms_users.id','left')
                    ->join('hms_users as docuser','hms_doctors.user_id = docuser.id','left')
                    ->join('hms_departments','hms_doctors.department_id = hms_departments.id','left')
                    ->join('hms_branches','hms_departments.branch_id = hms_branches.id','left');

            }else if($this->auth->isDoctor()){
                $this->datatables
                    ->showIndex(true)   
                    ->from('hms_receptionist') 
                    ->select('hms_receptionist.id as mainid, CONCAT(hms_users.first_name," ",hms_users.last_name) as repname, hms_hospitals.name as hname, hms_branches.branch_name as bname, hms_departments.department_name as dname, case when hms_receptionist.isActive=1 THEN "'.$this->lang->line('active').'" when hms_receptionist.isActive=0 THEN "'.$this->lang->line('inactive').'" end as status', false)
                    ->join('hms_doctors','hms_receptionist.doc_id = hms_doctors.id','left')
                    ->join('hms_users','hms_receptionist.user_id = hms_users.id','left')
                    ->join('hms_departments','hms_doctors.department_id = hms_departments.id','left')
                    ->join('hms_branches','hms_departments.branch_id = hms_branches.id','left')
                    ->join('hms_hospitals','hms_branches.hospital_id = hms_hospitals.id','left');
            }else{
                $this->datatables
                    ->showCheckbox(true)
                    ->from('hms_receptionist') 
                    ->select('hms_receptionist.id as mainid, CONCAT(hms_users.first_name," ",hms_users.last_name) as repname, hms_hospitals.name as hname, hms_branches.branch_name as bname, hms_departments.department_name as dname, CONCAT(docuser.first_name," ",docuser.last_name) as docname, case when hms_receptionist.isActive=1 THEN "'.$this->lang->line('active').'" when hms_receptionist.isActive=0 THEN "'.$this->lang->line('inactive').'" end as status', false)
                    ->join('hms_doctors','hms_receptionist.doc_id = hms_doctors.id','left')
                    ->join('hms_users','hms_receptionist.user_id = hms_users.id','left')
                    ->join('hms_users as docuser','hms_doctors.user_id = docuser.id','left')
                    ->join('hms_departments','hms_doctors.department_id = hms_departments.id','left')
                    ->join('hms_branches','hms_departments.branch_id = hms_branches.id','left')
                    ->join('hms_hospitals','hms_branches.hospital_id = hms_hospitals.id','left')
                    ->add_column('edit', '<a href="#" id="dellink_$1" class="delbtn"  data-toggle="modal" data-target=".bs-example-modal-sm" data-id="$1" data-toggle="tooltip" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>', 'hms_receptionist.id')
                    ->edit_column('repname', "<a href='#' data-id='$1' class='editbtn' data-toggle='modal' data-target='#edit' data-toggle='tooltip' title='Edit'>$2</a>", 'hms_receptionist.id, repname');
            }

            //Set condition to new library
            foreach($cond as $con){
                $this->datatables->where($con);
            }
            //Call new library for output
            echo $this->datatables->generate('json');
        }
    }
}
