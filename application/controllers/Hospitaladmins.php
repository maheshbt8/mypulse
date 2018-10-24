<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Hospitaladmins extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();   
        $this->load->library('session');
        date_default_timezone_set('Asia/Kolkata');    
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
/*function get_state($country_id)
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
    
    function get_district($city_id)
    {
        $district = $this->db->get_where('district' , array(
            'state_id' => $city_id))->result_array();
        echo '<option value=""> Select District </option>';
        foreach ($district as $row3) {
            echo '<option value="' . $row3['district_id'] . '">' . $row3['name'] . '</option>';
        }
    }
    
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
    }*/
    public function resend_email_verification($task='',$type_id='',$id='')
    {
    $this->db->where('unique_id',$id)->update($task,array('modified_at'=>date('Y-m-d H:i:s')));
    $this->email_model->account_reverification_email($task,$type_id, $id);
        redirect($this->session->userdata('last_page'));
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

    /*********Doctors**********/
    function add_doctor()
    {
        if($this->input->post()){
        $config = array(
        array('field' => 'fname','label' => 'First Name','rules' => 'required'),
        array('field' => 'lname','label' => 'Last Name','rules' => 'required'),
        array('field' => 'description','label' => 'Description','rules' => 'required'),
        array('field' => 'email','label' => 'Email','rules' => 'required|valid_email'),
         array('field' => 'mobile','label' => 'Phone Number','rules' => 'required'),
        array('field' => 'hospital','label' => 'Hospital','rules' => 'required'),
        array('field' => 'branch','label' => 'Branch','rules' => 'required'),
        array('field' => 'department','label' => 'Department','rules' => 'required'),
        array('field' => 'status','label' => 'Status','rules' => 'required'),
        );
        $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == TRUE){
           $email = $this->input->post('email');
           $validation = email_validation($email);
            if ($validation == 1) {
           $phone_number = $this->input->post('mobile');
           $phone = mobile_validation($phone_number);
           
           if($phone == 1){

           $this->crud_model->save_doctor_info();
            $this->session->set_flashdata('message', get_phrase('doctor_info_saved_successfuly'));
            $this->email_model->account_opening_email('doctors','doctor', $email);
            redirect($this->session->userdata('last_page'));
        
        }else{
            $this->session->set_flashdata('message', get_phrase('duplicate_phone_number'));
        }
            }else {
                $this->session->set_flashdata('message', get_phrase('duplicate_email'));
            }
        }
    }

        $data['page_name'] = 'add_doctor';
        $data['page_title'] = get_phrase('add_doctor');
        $this->load->view('backend/index', $data);
        
        
    }
    function edit_doctor($id)
    {
        if($this->input->post()){
            $config = array(
        array('field' => 'fname','label' => 'First Name','rules' => 'required'),
        array('field' => 'lname','label' => 'Last Name','rules' => 'required'),
        array('field' => 'description','label' => 'Description','rules' => 'required'),
        array('field' => 'email','label' => 'Email','rules' => 'required|valid_email'),
         array('field' => 'mobile','label' => 'Phone Number','rules' => 'required'),
        array('field' => 'hospital','label' => 'Hospital','rules' => 'required'),
        array('field' => 'branch','label' => 'Branch','rules' => 'required'),
        array('field' => 'department','label' => 'Department','rules' => 'required'),
        array('field' => 'status','label' => 'Status','rules' => 'required'),
        );
        $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == TRUE){
           $email = $this->input->post('email');
           $validation = email_validation_for_edit($email, $id, 'doctors','doctor');
          // echo $validation;die;
            if ($validation == 1) {
           $phone_number = $this->input->post('mobile');
           $phone = mobile_validation_for_edit($phone_number,$id,'doctors','doctor');
           
           if($phone == 1){
           $this->crud_model->update_doctor_info($id);
               $this->session->set_flashdata('message', get_phrase('doctor_info_updated_successfuly'));
            redirect($this->session->userdata('last_page'));
        }else{
            $this->session->set_flashdata('message', get_phrase('duplicate_phone_number'));
        }
            }else {
                $this->session->set_flashdata('message', get_phrase('duplicate_email'));
            }
        }
        }
     
        $data['doctor_id']=$id;
        $data['page_name'] = 'edit_doctor';
        $data['page_title'] = get_phrase('edit_doctor');
        $this->load->view('backend/index', $data); 
    }

    function doctor($task, $doctor_id = "") {
       
        if ($task == "delete") {
            $this->crud_model->delete_doctor_info($doctor_id);
            redirect($this->session->userdata('last_page'));
        }
        if ($task == "delete_multiple") {
           $this->crud_model->delete_multiple_doctor_info();
            $this->session->set_flashdata('message', get_phrase('doctor_info_deleted_successfuly'));
            redirect($this->session->userdata('last_page'));
        }
        $data['doctor_info'] = $this->crud_model->select_doctor_info($task);
        $data['page_name'] = 'manage_doctor';
        $data['page_title'] = get_phrase('doctors');
        $this->load->view('backend/index', $data);
    }
    

    function doctor_availability($task = "",$id='')
    {
        if ($task == "update") {
                $this->crud_model->update_doctor_availability_info($id);
                $this->session->set_flashdata('message', get_phrase('doctor_availability_info_saved_successfuly'));
            redirect(base_url() . 'index.php?hospitaladmins/doctor_availability/'.$id);
        }
   
        $data['doctor_id']=$task;
        $data['page_name'] = 'add_availability';
        $data['page_title'] = get_phrase('add_availability');
        $this->load->view('backend/index', $data);
    }
    function doctor_new_availability($task = "",$id='')
    {
        if ($task == "new_availability") {
            
                $this->crud_model->update_doctor_new_availability_info($id);
                $this->session->set_flashdata('message', get_phrase('doctor_availability_info_saved_successfuly'));
            redirect(base_url() . 'index.php?hospitaladmins/doctor_availability/'.$id);
        }
        $data['doctor_id']=$task;
        $data['page_name'] = 'add_dcoavailability';
        $data['page_title'] = get_phrase('add_availability');
        $this->load->view('backend/index', $data);
    }
    function edit_doctor_new_availability($task = "",$id='',$id1='')
    {
        if ($task == "update_availability") {
            
                $this->crud_model->update_doc_availability_info($id1);
                $this->session->set_flashdata('message', get_phrase('doctor_availability_updated_successfuly'));
            redirect(base_url() . 'index.php?hospitaladmins/doctor_availability/'.$id);
        }
        if ($task == "delete") {
            
                $this->crud_model->delete_doc_availability_info($id1);
                $this->session->set_flashdata('message', get_phrase('doctor_availability_deleted_successfuly'));
            redirect(base_url() . 'index.php?hospitaladmins/doctor_availability/'.$id);
        }
        if ($task == "delete_all") {
            
                $this->crud_model->delete_all_doc_availability_info($id1);
                $this->session->set_flashdata('message', get_phrase('doctor_availability_deleted_successfuly'));
            redirect(base_url() . 'index.php?hospitaladmins/doctor_availability/'.$id);
        }
        $data['slat_id']=$id;
        $data['page_name'] = 'edit_dcoavailability';
        $data['page_title'] = get_phrase('edit_availability');
        $this->load->view('backend/index', $data);
    }
    function add_nurse()
    {

       if($this->input->post()){
         $config = array(
        array('field' => 'fname','label' => 'First Name','rules' => 'required'),
        array('field' => 'lname','label' => 'Last Name','rules' => 'required'),
        array('field' => 'description','label' => 'Description','rules' => 'required'),
        array('field' => 'email','label' => 'Email','rules' => 'required|valid_email'),
         array('field' => 'mobile','label' => 'Phone Number','rules' => 'required'),
        array('field' => 'hospital','label' => 'Hospital','rules' => 'required'),
        array('field' => 'branch','label' => 'Branch','rules' => 'required'),
        array('field' => 'department','label' => 'Department','rules' => 'required'),
        array('field' => 'doctor[]','label' => 'Doctor','rules' => 'required'),
        array('field' => 'status','label' => 'Status','rules' => 'required'),
        );
        $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == TRUE){
           $email = $this->input->post('email');
           $validation = email_validation($email);
            if ($validation == 1) {
           $phone_number = $this->input->post('mobile');
           $phone = mobile_validation($phone_number);
           
           if($phone == 1){
             $this->crud_model->save_nurse_info();
                $this->session->set_flashdata('message', get_phrase('nurse_info_saved_successfuly'));
                $this->email_model->account_opening_email('nurse','nurse', $email);
                redirect($this->session->userdata('last_page'));
        }else{
            $this->session->set_flashdata('message', get_phrase('duplicate_phone_number'));
        }
            }else {
                $this->session->set_flashdata('message', get_phrase('duplicate_email'));
            }
        }
        
       }
        $data['page_name'] = 'add_nurse';
        $data['page_title'] = get_phrase('Add nurse');
        $this->load->view('backend/index', $data);
        
    } 
    function edit_nurse($id)
    {
        if($this->input->post()){
             $config = array(
        array('field' => 'fname','label' => 'First Name','rules' => 'required'),
        array('field' => 'lname','label' => 'Last Name','rules' => 'required'),
        array('field' => 'description','label' => 'Description','rules' => 'required'),
        array('field' => 'email','label' => 'Email','rules' => 'required|valid_email'),
         array('field' => 'mobile','label' => 'Phone Number','rules' => 'required'),
        array('field' => 'hospital','label' => 'Hospital','rules' => 'required'),
        array('field' => 'branch','label' => 'Branch','rules' => 'required'),
        array('field' => 'department','label' => 'Department','rules' => 'required'),
        array('field' => 'doctor[]','label' => 'Doctor','rules' => 'required'),
        array('field' => 'status','label' => 'Status','rules' => 'required'),
        );
        $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == TRUE){
           $email = $this->input->post('email');
           $validation = email_validation_for_edit($email, $id, 'nurse','nurse');
            if ($validation == 1) {
           $phone_number = $this->input->post('mobile');
           $phone = mobile_validation_for_edit($phone_number,$id,'nurse','nurse');
           if($phone == 1){
            $this->crud_model->update_nurse_info($id);
            $this->session->set_flashdata('message', get_phrase('nurse_info_updated_successfuly'));
            redirect($this->session->userdata('last_page'));
        }else{
            $this->session->set_flashdata('message', get_phrase('duplicate_phone_number'));
        }
            }else {
                $this->session->set_flashdata('message', get_phrase('duplicate_email'));
            }
        }
        }
        $data['nurse_id']=$id;
        $data['page_name'] = 'edit_nurse';
        $data['page_title'] = get_phrase('edit_nurse');
        $this->load->view('backend/index', $data);
        
        
    }
    function nurse($task = "", $nurse_id = "") {
        if ($task == "delete") {
            $this->crud_model->delete_nurse_info($nurse_id);
            redirect($this->session->userdata('last_page'));
        }
        if ($task == "delete_multiple") {
           $this->crud_model->delete_multiple_nurse_info();
            $this->session->set_flashdata('message', get_phrase('nurse_info_deleted_successfuly'));
            redirect($this->session->userdata('last_page'));
        }

        $data['nurse_info'] = $this->crud_model->select_nurse_info($task);
        $data['page_name'] = 'manage_nurse';
        $data['page_title'] = get_phrase('nurses');
        $this->load->view('backend/index', $data);
    }

 

   
    function add_receptionist($task = "", $receptionist_id = "") {

       if($this->input->post()){
        $config = array(
        array('field' => 'fname','label' => 'First Name','rules' => 'required'),
        array('field' => 'lname','label' => 'Last Name','rules' => 'required'),
        array('field' => 'description','label' => 'Description','rules' => 'required'),
        array('field' => 'email','label' => 'Email','rules' => 'required|valid_email'),
         array('field' => 'mobile','label' => 'Phone Number','rules' => 'required'),
        array('field' => 'hospital','label' => 'Hospital','rules' => 'required'),
        array('field' => 'branch','label' => 'Branch','rules' => 'required'),
        array('field' => 'department','label' => 'Department','rules' => 'required'),
        array('field' => 'doctor[]','label' => 'Doctor','rules' => 'required'),
        array('field' => 'status','label' => 'Status','rules' => 'required'),
        );
        $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == TRUE){
           $email = $this->input->post('email');
           $validation = email_validation($email);
            if ($validation == 1) {
           $phone_number = $this->input->post('mobile');
           $phone = mobile_validation($phone_number);
           
           if($phone == 1){
             $this->crud_model->save_receptionist_info();
                $this->session->set_flashdata('message', get_phrase('receptionist_info_saved_successfuly'));
                $this->email_model->account_opening_email('receptionist','receptionist', $email);
                redirect($this->session->userdata('last_page'));
        }else{
            $this->session->set_flashdata('message', get_phrase('duplicate_phone_number'));
        }
            }else {
                $this->session->set_flashdata('message', get_phrase('duplicate_email'));
            }

           } 
       
       }
      
        $data['page_name'] = 'add_receptionist';
        $data['page_title'] = get_phrase('add_receptionist');
        $this->load->view('backend/index', $data);
        
    }
    function edit_receptionist($id)
    {
        if($this->input->post()){
             $config = array(
        array('field' => 'fname','label' => 'First Name','rules' => 'required'),
        array('field' => 'lname','label' => 'Last Name','rules' => 'required'),
        array('field' => 'description','label' => 'Description','rules' => 'required'),
        array('field' => 'email','label' => 'Email','rules' => 'required|valid_email'),
         array('field' => 'mobile','label' => 'Phone Number','rules' => 'required'),
        array('field' => 'hospital','label' => 'Hospital','rules' => 'required'),
        array('field' => 'branch','label' => 'Branch','rules' => 'required'),
        array('field' => 'department','label' => 'Department','rules' => 'required'),
        array('field' => 'doctor[]','label' => 'Doctor','rules' => 'required'),
        array('field' => 'status','label' => 'Status','rules' => 'required'),
        );
        $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == TRUE){
           $email = $this->input->post('email');
           $validation = email_validation_for_edit($email, $id, 'receptionist','receptionist');
            if ($validation == 1) {
           $phone_number = $this->input->post('mobile');
           $phone = mobile_validation_for_edit($phone_number,$id,'receptionist','receptionist');
           if($phone == 1){

            $this->crud_model->update_receptionist_info($id);
            $this->session->set_flashdata('message', get_phrase('receptionist_info_updated_successfuly'));
            redirect($this->session->userdata('last_page'));
        }else{
            $this->session->set_flashdata('message', get_phrase('duplicate_phone_number'));
        }
            }else {
                $this->session->set_flashdata('message', get_phrase('duplicate_email'));
            }
        }
        }
        $data['receptionist_id']=$id;
        $data['page_name'] = 'edit_receptionist';
        $data['page_title'] = get_phrase('edit_receptionist');
        $this->load->view('backend/index', $data);
        
        
    }
    function receptionist($task = "", $receptionist_id = "") {
        
        if ($task == "delete") {
            $this->crud_model->delete_receptionist_info($receptionist_id);
            redirect($this->session->userdata('last_page'));
        }
        if ($task == "delete_multiple") {
           $this->crud_model->delete_multiple_receptionist_info();
            $this->session->set_flashdata('message', get_phrase('receptionist_info_deleted_successfuly'));
            redirect($this->session->userdata('last_page'));
        }
        $data['receptionist_info'] = $this->crud_model->select_receptionist_info($task);
        $data['page_name'] = 'manage_receptionist';
        $data['page_title'] = get_phrase('receptionists');
        $this->load->view('backend/index', $data);
    }
    function add_stores()
    {
        if($this->input->post()){
        $config = array(
        array('field' => 'name','label' => 'First Name','rules' => 'required'),
        array('field' => 'description','label' => 'Description','rules' => 'required'),
        array('field' => 'address','label' => 'Address','rules' => 'required'),
        array('field' => 'phone_number','label' => 'Phone Number','rules' => 'required'),
        array('field' => 'owner_name','label' => 'Owner/MD Name','rules' => 'required'),
        array('field' => 'owner_mobile','label' => 'Owner/MD Phone Number','rules' => 'required'),
        array('field' => 'email','label' => 'Email','rules' => 'required|valid_email'),
        array('field' => 'hospital','label' => 'Hospital','rules' => 'required'),
        array('field' => 'branch','label' => 'Branch','rules' => 'required'),
        array('field' => 'status','label' => 'Status','rules' => 'required'),
        );
        $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == TRUE){
           $email = $this->input->post('email');
           $validation = email_validation($email);
            if ($validation == 1) {
           $phone_number = $this->input->post('phone_number');
           $phone = mobile_validation($phone_number);
           
           if($phone == 1){
           $this->crud_model->save_medicalstores_info();
                $this->session->set_flashdata('message', get_phrase('medical_stores_info_saved_successfuly'));
                $this->email_model->account_opening_email('medicalstores','store', $email);
              redirect($this->session->userdata('last_page'));
        }else{
            $this->session->set_flashdata('message', get_phrase('duplicate_phone_number'));
        }
            }else {
                $this->session->set_flashdata('message', get_phrase('duplicate_email'));
            }
        }
    }
      
        $data['page_name'] = 'add_stores';
        $data['page_title'] = get_phrase('Add medical store');
        $this->load->view('backend/index', $data);
        
    }
    
  
     function add_labs()
    {
     
       if($this->input->post()){
        $config = array(
        array('field' => 'name','label' => 'First Name','rules' => 'required'),
        array('field' => 'description','label' => 'Description','rules' => 'required'),
        array('field' => 'address','label' => 'Address','rules' => 'required'),
        array('field' => 'phone_number','label' => 'Phone Number','rules' => 'required'),
        array('field' => 'owner_name','label' => 'Owner/MD Name','rules' => 'required'),
        array('field' => 'owner_mobile','label' => 'Owner/MD Phone Number','rules' => 'required'),
        array('field' => 'email','label' => 'Email','rules' => 'required|valid_email'),
        array('field' => 'hospital','label' => 'Hospital','rules' => 'required'),
        array('field' => 'branch','label' => 'Branch','rules' => 'required'),
        array('field' => 'status','label' => 'Status','rules' => 'required'),
        );
        $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == TRUE){
           $email = $this->input->post('email');
           $validation = email_validation($email);
            if ($validation == 1) {
           $phone_number = $this->input->post('phone_number');
           $phone = mobile_validation($phone_number);
           
           if($phone == 1){
            $this->crud_model->save_medicallabs_info();
                $this->session->set_flashdata('message', get_phrase('medical_lab_info_saved_successfuly'));
                $this->email_model->account_opening_email('medicallabs','lab', $email);
              redirect($this->session->userdata('last_page'));
        }else{
            $this->session->set_flashdata('message', get_phrase('duplicate_phone_number'));
        }
            }else {
                $this->session->set_flashdata('message', get_phrase('duplicate_email'));
            }
        }
    }
        $data['page_name'] = 'add_labs';
        $data['page_title'] = get_phrase('Add medical labs');
        $this->load->view('backend/index', $data);
        
    }
    
     
    
     function edit_stores($id)
    {
        if($this->input->post()){
            $config = array(
        array('field' => 'name','label' => 'First Name','rules' => 'required'),
        array('field' => 'description','label' => 'Description','rules' => 'required'),
        array('field' => 'address','label' => 'Address','rules' => 'required'),
        array('field' => 'phone_number','label' => 'Phone Number','rules' => 'required'),
        array('field' => 'owner_name','label' => 'Owner/MD Name','rules' => 'required'),
        array('field' => 'owner_mobile','label' => 'Owner/MD Phone Number','rules' => 'required'),
        array('field' => 'email','label' => 'Email','rules' => 'required|valid_email'),
        array('field' => 'hospital','label' => 'Hospital','rules' => 'required'),
        array('field' => 'branch','label' => 'Branch','rules' => 'required'),
        array('field' => 'status','label' => 'Status','rules' => 'required'),
        );
        $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == TRUE){
           $email = $this->input->post('email');
           $validation = email_validation_for_edit($email, $id, 'medicalstores','store');
            if ($validation == 1) {
           $phone_number = $this->input->post('phone_number');
           $phone = mobile_validation_for_edit($phone_number,$id,'medicalstores','store');
           if($phone == 1){
            $this->crud_model->update_medicalstores_info($id);
                $this->session->set_flashdata('message', get_phrase('medical_store__info_updated_successfuly'));
              redirect($this->session->userdata('last_page'));
        }else{
            $this->session->set_flashdata('message', get_phrase('duplicate_phone_number'));
        }
            }else {
                $this->session->set_flashdata('message', get_phrase('duplicate_email'));
            }
        }
        }
       
        $data['id']=$id;
        $data['page_name'] = 'edit_stores';
        $data['page_title'] = get_phrase('Edit medical store');
        $this->load->view('backend/index', $data);
        
    }
    
     function edit_labs($id)
    {
        if($this->input->post()){
            $config = array(
        array('field' => 'name','label' => 'First Name','rules' => 'required'),
        array('field' => 'description','label' => 'Description','rules' => 'required'),
        array('field' => 'address','label' => 'Address','rules' => 'required'),
        array('field' => 'phone_number','label' => 'Phone Number','rules' => 'required'),
        array('field' => 'owner_name','label' => 'Owner/MD Name','rules' => 'required'),
        array('field' => 'owner_mobile','label' => 'Owner/MD Phone Number','rules' => 'required'),
        array('field' => 'email','label' => 'Email','rules' => 'required|valid_email'),
        array('field' => 'hospital','label' => 'Hospital','rules' => 'required'),
        array('field' => 'branch','label' => 'Branch','rules' => 'required'),
        array('field' => 'status','label' => 'Status','rules' => 'required'),
        );
        $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == TRUE){
           $email = $this->input->post('email');
           $validation = email_validation_for_edit($email, $id, 'medicallabs','lab');
            if ($validation == 1) {
           $phone_number = $this->input->post('phone_number');
           $phone = mobile_validation_for_edit($phone_number,$id,'medicallabs','lab');
           if($phone == 1){
            $this->crud_model->update_medicallabs_info($id);
                $this->session->set_flashdata('message', get_phrase('medical_lab__info_updated_successfuly'));
            redirect($this->session->userdata('last_page'));
        }else{
            $this->session->set_flashdata('message', get_phrase('duplicate_phone_number'));
        }
            }else {
                $this->session->set_flashdata('message', get_phrase('duplicate_email'));
            }
        }
        }
       
        $data['id']=$id;
        $data['page_name'] = 'edit_labs';
        $data['page_title'] = get_phrase('Edit medical labs');
        $this->load->view('backend/index', $data);
        
    }
    
    
    
     function medical_labs($task = "", $patient_id = "") {
       
        if ($task == "delete") {
            $this->crud_model->delete_lab_info($patient_id);
           redirect($this->session->userdata('last_page'));
        }
       
      if ($task == "delete_multiple") {
           $this->crud_model->delete_multiple_lab_info();
            $this->session->set_flashdata('message', get_phrase('medical_labs_info_deleted_successfuly'));
            redirect($this->session->userdata('last_page'));
        }
        $data['lab_info'] = $this->crud_model->select_lab_info($task);
        $data['page_name'] = 'manage_labs';
        $data['page_title'] = get_phrase('Medical labs');
        $this->load->view('backend/index', $data);
    }
    
    
    
    
    function medical_stores($task = "", $patient_id = "") {
       

        if ($task == "delete") {
            $this->crud_model->delete_store_info($patient_id);
            redirect($this->session->userdata('last_page'));
        }
       if ($task == "delete_multiple") {
           $this->crud_model->delete_multiple_store_info();
            $this->session->set_flashdata('message', get_phrase('medical_stores_info_deleted_successfuly'));
            redirect($this->session->userdata('last_page'));
        }
      
        $data['store_info'] = $this->crud_model->select_store_info($task);
        $data['page_name'] = 'manage_stores';
        $data['page_title'] = get_phrase('Medical stores');
        $this->load->view('backend/index', $data);
    }
      function add_appointment()
    {

        if($this->input->post()){
            $user= $this->input->post('user_id');
            $appointment_date=$this->input->post('appointment_date');
            $count=$this->db->get_where('appointments', array('user_id' => $user,'appointment_date'=>$appointment_date))->num_rows();
      if($count < 2 ){  
    $this->crud_model->save_appointment_info();
    $this->session->set_flashdata('message', get_phrase('appointment_info_saved_successfuly'));
    redirect($this->session->userdata('last_page'));
    }else{
       $this->session->set_flashdata('appointment_date_error',"You Can not Book More Than 2 Appointments Per Day");
    }
    }

        $data['page_name'] = 'add_appointment';
        $data['page_title'] = get_phrase('book_Appointment');
        $this->load->view('backend/index', $data);
    }
    function edit_appointment($appointment_id = "")
    {
        if($this->input->post()){
           
    $this->crud_model->update_appointment_info();
    $this->session->set_flashdata('message', get_phrase('appointment_info_updated_successfuly'));
    redirect($this->session->userdata('last_page'));
    }
    $unique_id=$this->db->where('appointment_id',$appointment_id)->get('appointments')->row()->appointment_number;
    
        $data['appointment_id']=$appointment_id;
        $data['page_name'] = 'edit_appointment';
        $data['page_title'] = get_phrase('Appointment - ').$unique_id;
        $this->load->view('backend/index', $data);
    }
    function appointment($task = "", $appointment_id = "") {
        
      
        if ($task == "delete") {

            $this->crud_model->delete_appointment_info($appointment_id);
            $this->session->set_flashdata('message', get_phrase('appointment_info_deleted_successfuly'));
            redirect($this->session->userdata('last_page'));
        }
        if ($task == "delete_multiple") {
           $this->crud_model->delete_multiple_appointment_info();
            $this->session->set_flashdata('message', get_phrase('appointment_info_deleted_successfuly'));
    if ($this->session->flashdata('message') != ""){
    echo "<script>".
        toastr.info('<?php echo $this->session->flashdata("message");?>')."</script>";
     }
            redirect($this->session->userdata('last_page'));
        }
        if ($task == "close_multiple") {
            $this->crud_model->close_multiple_appointment_info();
            $this->session->set_flashdata('message', get_phrase('appointment_info_closed_successfuly'));
            redirect($this->session->userdata('last_page'));
        }
       
        $data['appointment_info'] = $this->crud_model->select_appointment_info($task);
        $data['page_name'] = 'manage_appointment';
        $data['page_title'] = get_phrase('manage_appointments');
        $this->load->view('backend/index', $data);
    }
    
}