<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Hospitaladmins extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();   
        $this->load->library('session');    
        error_reporting(0);  
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        if ($this->session->userdata('hospitaladmin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
    }

    /*     * *default function, redirects to login page if no admin logged in yet** */

    public function index() {
        if ($this->session->userdata('hospitaladmin_login') != 1) 
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('hospitaladmin_login') == 1)
            redirect(base_url() . 'index.php?hospitaladmins/dashboard', 'refresh');
    }
function get_state($country_id)
    {
        $state = $this->db->get_where('state' , array(
            'country_id' => $country_id))->result_array();
        echo '<option value=""> Select State </option>';
        foreach ($state as $row2) {
            echo '<option value="' . $row2['state_id'] . '">' . $row2['name'] . '</option>';
        }
    }
    
    
     function get_city($state_id)
    {
        $state = $this->db->get_where('city' , array(
            'state_id' => $state_id))->result_array();
        echo '<option value=""> Select city </option>';
        foreach ($state as $row2) {
            echo '<option value="' . $row2['city_id'] . '">' . $row2['name'] . '</option>';
        }
    }
     /******GET DISTRICT****/
    function get_district($city_id)
    {
        $district = $this->db->get_where('district' , array(
            'state_id' => $city_id))->result_array();
        echo '<option value=""> Select District </option>';
        foreach ($district as $row3) {
            echo '<option value="' . $row3['district_id'] . '">' . $row3['name'] . '</option>';
        }
    }
    /*GET BRANCH*/
    function get_branch($hospital_id)
    {
        $branch = $this->db->get_where('branch' , array(
            'hospital_id' => $hospital_id
        ))->result_array();
        echo '<option value=""> Select Branch </option>';
        foreach ($branch as $row) {
            echo '<option value="' . $row['branch_id'] . '">' . $row['name'] . '</option>';
        }
    }
    
     /*GET DEPARTMENT*/
    function get_department($branch_id)
    {
        $department = $this->db->get_where('department' , array(
            'branch_id' => $branch_id
        ))->result_array();
        echo '<option value=""> Select Department </option>';
        echo '<option value="all"> All Department </option>';
        foreach ($department as $row) {
            echo '<option value="' . $row['department_id'] . '">' . $row['name'] . '</option>';
        }
    }
    function get_ward($department_id)
    {
        $ward = $this->db->get_where('ward' , array(
            'department_id' => $department_id
        ))->result_array();
        echo '<option value=""> Select Ward </option>';
        foreach ($ward as $row) {
            echo '<option value="' . $row['ward_id'] . '">' . $row['name'] . '</option>';
        }
    }
    
     function get_doctor($department_id,$department_id1)   
    {
        if($department_id == 'all'){
            $doctor = $this->db->get_where('doctors' , array(
            'branch_id' => $department_id1,'status'=>1
        ))->result_array();
        echo '<option value=""> Select Doctor </option>';  
        foreach ($doctor as $row) {
            echo '<option value="' . $row['doctor_id'] . '">' . $row['name'] . '</option>';
        }
        }else{
        $doctor = $this->db->get_where('doctors' , array(
            'department_id' => $department_id,'status'=>1
        ))->result_array();
        echo '<option value=""> Select Doctor </option>';  
        foreach ($doctor as $row) {
            echo '<option value="' . $row['doctor_id'] . '">' . $row['name'] . '</option>';
        }
    }
    }
    /*     * *ADMIN DASHBOARD** */
 public function get_hospital_branch($hospital_id='') {   
      
        $data['branch_info'] = $this->db->where('hospital_id',$hospital_id)->get('branch')->result_array();
        $data['hospital_id']=$hospital_id;
        $data['page_name'] = 'manage_branch';
        $data['page_title'] = get_phrase('branch');
        $this->load->view('backend/index', $data);
    }
    
    public function get_hospital_departments($branch_id='') {   
       
    $data['department_info'] = $this->db->where('branch_id',$branch_id)->get('department')->result_array();
    $data['branch_id']=$branch_id;
        $data['page_name'] = 'manage_department';
        $data['page_title'] = get_phrase('department');
        $this->load->view('backend/index', $data);
    }
    public function get_hospital_ward($department_id='') {   
       
    $data['ward_info'] = $this->db->where('department_id',$department_id)->get('ward')->result_array();
    $data['department_id']=$department_id;
        $data['page_name'] = 'manage_ward';
        $data['page_title'] = get_phrase('ward');
        $this->load->view('backend/index', $data);
    }
     public function get_hospital_bed($ward_id='') {   
      
    $data['bed_info'] = $this->db->where('ward_id',$ward_id)->get('bed')->result_array();
    $data['ward_id']=$ward_id;
        $data['page_name'] = 'manage_bed';
        $data['page_title'] = get_phrase('bed');
        $this->load->view('backend/index', $data);
    }

    function dashboard() {
       
        $page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('hospitadmin_dashboard');
        $this->load->view('backend/index', $page_data);
    }

    function add_branch($hospital_id='')
    {
        
         $data['page_name'] = 'add_branch';
         $data['hospital_id'] = $hospital_id;
        $data['page_title'] = get_phrase('add_branch');
        $this->load->view('backend/index', $data);
        
    }
    function edit_branch($id)
    {
       $data['branch_id']=$id;
        
         $data['page_name'] = 'edit_branch';
        $data['page_title'] = get_phrase('edit_branch');
        $this->load->view('backend/index', $data);
        
    }
     function branch($task = "", $branch_id = "") {
      
        if ($task == "create") {
            $hospital=$this->input->post('hospital');
            $this->crud_model->save_branch_info();
            $this->session->set_flashdata('message', get_phrase('branch_info_saved_successfuly'));
            redirect(base_url() . 'index.php?hospitaladmins/get_hospital_branch/'.$hospital);
        }
        if ($task == "edit") {
        $data['branch_id'] = $branch_id;
        $data['page_name'] = 'edit_branch';
        $data['page_title'] = get_phrase('edit_branch');
       
        $this->load->view('backend/index', $data);
        }
        if ($task == "update") {
            $this->crud_model->update_branch_info($branch_id);
            $this->session->set_flashdata('message', get_phrase('branch_info_updated_successfuly'));
            redirect(base_url() . 'index.php?hospitaladmins/branch');
        }

        if ($task == "delete") {
            $this->crud_model->delete_branch_info($branch_id);
            redirect(base_url() . 'index.php?hospitaladmins/branch');
        }

        $data['branch_info'] = $this->crud_model->select_branch_info();
        $data['page_name'] = 'manage_branch';
        $data['page_title'] = get_phrase('branch');
        $this->load->view('backend/index', $data);
    }
     function add_department($branch_id='')
    {
     $data['branch_id'] = $branch_id;
    $data['page_name'] = 'add_department';
    $data['page_title'] = get_phrase('add_department');
    $this->load->view('backend/index', $data);
        
        
    }
    
     function edit_department($id)
     {
        
        $data['id']=$id;
          $data['page_name'] = 'edit_department';
        $data['page_title'] = get_phrase('edit_department');
        $this->load->view('backend/index', $data);
        
        
    }
    function department($task = "", $department_id = "") {
        
        if ($task == "create") {
            $branch=$this->input->post('branch');
            $this->crud_model->save_department_info();
            $this->session->set_flashdata('message', get_phrase('department_info_saved_successfuly'));
            redirect(base_url() . 'index.php?hospitaladmins/get_hospital_departments/'.$branch);
        }

        if ($task == "update") {
            $branch=$this->db->where('department_id',$department_id)->get('department')->row()->branch_id;
            $this->crud_model->update_department_info($department_id);
            $this->session->set_flashdata('message', get_phrase('department_info_updated_successfuly'));
            redirect(base_url() . 'index.php?hospitaladmins/get_hospital_departments/'.$branch);
        }

        if ($task == "delete") {
            $branch=$this->db->where('department_id',$department_id)->get('department')->row()->branch_id;
            $this->crud_model->delete_department_info($department_id);
            redirect(base_url() . 'index.php?hospitaladmins/get_hospital_departments/'.$branch);
        }

        $data['department_info'] = $this->crud_model->select_department_info();
        $data['page_name'] = 'manage_department';
        $data['page_title'] = get_phrase('department');
        $this->load->view('backend/index', $data);
    }
    
     function add_ward($department_id='')
    {
        $data['department_id']=$department_id;
        $data['page_name'] = 'add_ward';
        $data['page_title'] = get_phrase('add_ward');
        $this->load->view('backend/index', $data);
    }
    
     function edit_ward($id)
     {
        $data['id']=$id;
        $data['page_name'] = 'edit_ward';
        $data['page_title'] = get_phrase('edit_ward');
        $this->load->view('backend/index', $data);
        
        
    }
    
    function ward($task = "", $ward_id = "") {
       
        if ($task == "create") {
            $department=$this->input->post('department');
            $this->crud_model->save_ward_info();
            $this->session->set_flashdata('message', get_phrase('ward_info_saved_successfuly'));
            redirect(base_url() . 'index.php?hospitaladmins/get_hospital_ward/'.$department);
        }

        if ($task == "update") {
            $this->crud_model->update_ward_info($ward_id);
            $this->session->set_flashdata('message', get_phrase('ward_info_updated_successfuly'));
            redirect(base_url() . 'index.php?hospitaladmins/ward');
        }

        if ($task == "delete") {
            $this->crud_model->delete_ward_info($ward_id);
            redirect(base_url() . 'index.php?hospitaladmins/ward');
        }

        $data['ward_info'] = $this->crud_model->select_ward_info();
        $data['page_name'] = 'manage_ward';
        $data['page_title'] = get_phrase('ward');
        $this->load->view('backend/index', $data);
    }
    
}