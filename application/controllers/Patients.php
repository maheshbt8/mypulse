<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Patients extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('users_model');
    }
    public function index() {
        if ($this->auth->isLoggedIn()) {
           
            $data["page_title"] = "Patients";
            $data["breadcrumb"] = array(site_url() => "Home", null => "Patients");
            $this->load->view('Patient/index', $data);
        } else redirect('index/login');
    }

    public function add() {
        if ($this->auth->isLoggedIn()) {
            $res = $this->users_model->add();

            if($res === -1){
                $data['errors'] = array($this->lang->line('msg_email_exist'));
            }else if($res === false){
                $data['errors'] = array($this->lang->line('msg_try_again'));
            }else{
                $data['success'] = array($this->lang->line('msg_user_added'));
            }
            $this->session->set_flashdata('data', $data);
            redirect('Patients/index');
            
        } else redirect('index/login');
    }
    public function update() {
        if ($this->auth->isLoggedIn()) {
            $data = array();
            $id = $this->input->post('eidt_gf_id');
            $res = $this->users_model->update($id);
            if($res === -1){
                $data['errors'] = array($this->lang->line('msg_email_exist'));
            }else if($res === false){
                $data['errors'] = array($this->lang->line('msg_try_again'));
            }else{
                $data['success'] = array($this->lang->line('msg_user_added'));
            }
            $this->session->set_flashdata('data', $data);
            redirect('Patients/index');
        } else redirect('index/login');
    }


    public function getDTusers() {
        if ($this->auth->isLoggedIn()) {
            $this->load->library("tbl");
            $table = "hms_users";
            $primaryKey = "id";
            $columns = array(array("db" => "first_name", "dt" => 0, "formatter" => function ($d, $row) {
                $user = $this->users_model->getusersById($row['id']);
                $name = "";
                if(isset($user['first_name'])){
                    $name = $user['first_name'];
                }
                if(isset($user['last_name'])){
                    $name .= " ".$user['last_name'];
                }
                return $name;
            }), array("db" => "useremail", "dt" => 1, "formatter" => function ($d, $row) {
                return "<a href='#' data-id='$row[id]' class='editbtn' data-toggle='modal' data-target='#edit' data-toggle='tooltip' title='Edit'>".$d."</a>";
            }), array("db" => "isActive", "dt" => 2, "formatter" => function ($d, $row) {
               return $this->auth->getActiveStatus($d);
            }), array("db" => "id", "dt" => 3, "formatter" => function ($d, $row) {
                 return "<a href=\"#\" id=\"dellink_".$d."\" class=\"delbtn\"  data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" data-id=\"$d\" data-toggle=\"tooltip\" title=\"Delete\"><i class=\"glyphicon glyphicon-remove\"></i></button>";
            }));

            if($this->auth->isHospitalAdmin()){

            }
            else{
            }
            $this->tbl->setTwID("role=".$this->auth->getPatientRoleType());
            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }

}
?>