<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Hospital_admin extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('hospital_admin_model');
        $this->load->model("hospitals_model");
        $this->load->model("users_model");
    }
    public function index() {
        if ($this->auth->isLoggedIn() && $this->auth->isSuperAdmin()) {
            $data['hospital_admins'] = $this->hospital_admin_model->getAllhospital_admin();
            $data["page_title"] = $this->lang->line('hospital_admin');
            $data["breadcrumb"] = array(site_url() => $this->lang->line('home'), null => $this->lang->line('hospital_admin'));
            $this->load->view('Hospital_admin/index', $data);
        } else redirect('index/login');
    }
    public function search() {
        if ($this->auth->isLoggedIn() && $this->auth->isSuperAdmin()) {
            $q = $this->input->get("q", null, "");
            $f = $this->input->get("f", null, "");
            $result = $this->hospital_admin_model->search($q, $f);
            echo json_encode($result);
        }
    }
    public function add() {
        if ($this->auth->isLoggedIn() && $this->auth->isSuperAdmin()) {
            $res = $this->hospital_admin_model->add();
            $data = $this->auth->parseUserResult($res,$this->lang->line('msg_hospitaladmin_added'));
            $this->session->set_flashdata('data', $data);
            redirect('hospital_admin/index');
        } else redirect('index/login');
    }
    public function update() {
        if ($this->auth->isLoggedIn() && $this->auth->isSuperAdmin()) {
            $data = array();
            $id = $this->input->post('eidt_gf_id');
            $res = $this->hospital_admin_model->update($id);
            $data = $this->auth->parseUserResult($res,$this->lang->line('msg_hospitaladmin_updated'));
            $this->session->set_flashdata('data', $data);
            redirect('hospital_admin/index');
        } else redirect('index/login');
    }
    public function delete() {
        if ($this->auth->isLoggedIn() && $this->auth->isSuperAdmin()) {
            $id = $this->input->post('id');
            echo $this->hospital_admin_model->delete($id);
        }
    }
    public function gethospital_admin() {
        if ($this->auth->isLoggedIn() && $this->auth->isSuperAdmin()) {
            $id = $this->input->post('id');
            echo json_encode($this->hospital_admin_model->gethospital_adminById($id));
        }
    }
    public function getDThospital_admin() {
        if ($this->auth->isLoggedIn() && $this->auth->isSuperAdmin()) {
            /*
                $this->load->library("tbl");
                $table = "hms_hospital_admin";
                $primaryKey = "id";
                $columns = array(array("db" => "user_id", "dt" => 0, "formatter" => function ($d, $row) {
                    $temp = $this->users_model->getusersById($d);
                    $name = $temp["first_name"]." ".$temp["last_name"];
                    return "<a href='#' data-id='$row[id]' class='editbtn' data-toggle='modal' data-target='#edit' data-toggle='tooltip' title='Edit'>".$name."</a>";
                }), array("db" => "hospital_id", "dt" => 1, "formatter" => function ($d, $row) {
                    $hospital = $this->hospitals_model->gethospitalsById($d);
                    if(!isset($hospital['name']))
                        return "-"; 

                    return $hospital["name"];
                }), array("db" => "isActive", "dt" => 2, "formatter" => function ($d, $row) {
                    return $this->auth->getActiveStatus($d);
                }), array("db" => "id", "dt" => 3, "formatter" => function ($d, $row) {
                    return "<a href=\"#\"  id=\"dellink_".$d."\" class=\"delbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Delete\"><i class=\"glyphicon glyphicon-remove\"></i></button>";
                }));
                // SQL server connection informationhostname" => "localhost",
                $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
                echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
            */

            $cond = array("hms_hospital_admin.isDeleted=0");

            //New library
            $this->load->library('datatables');		
            $this->datatables
                ->showCheckbox(true)
                ->from('hms_hospital_admin')
                ->select('hms_hospital_admin.id as mainid, CONCAT(hms_users.first_name," ",hms_users.last_name) as hadmin, hms_hospitals.name as hname, case when hms_hospital_admin.isActive=0 then "In-Active" when hms_hospital_admin.isActive=1 then "Active" end as status, hms_hospital_admin.id as id',false)
                ->join('hms_users', 'hms_hospital_admin.user_id = hms_users.id','left')
                ->join('hms_hospitals', 'hms_hospital_admin.hospital_id = hms_hospitals.id','left')
                ->add_column('edit', '<a href="#" id="dellink_$1" class="delbtn"  data-toggle="modal" data-target=".bs-example-modal-sm" data-id="$1" data-toggle="tooltip" title="Delete"><i class="glyphicon glyphicon-remove"></i></button>', 'id')
                ->edit_column('hadmin', '<a href="#" data-id="$1" class="editbtn" data-toggle="modal" data-target="#edit" data-toggle="tooltip" title="Edit">$2</a>', 'id, hadmin')
				->unset_column('id');
            //Set condition to new library
            foreach($cond as $con){
                $this->datatables->where($con);
            }
            //Call new library for output
            echo $this->datatables->generate('json');
        }
    }
}
