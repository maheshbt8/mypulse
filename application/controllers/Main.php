<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Main extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();   
        $this->load->library('session');
        date_default_timezone_set('Asia/Kolkata');    
        error_reporting(0);  
        /* cache control */
       /* $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');*/
        if ($this->session->userdata('login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
    }
    public function index() {
        if ($this->session->userdata('login') != 1){ 
            redirect(base_url() . 'login', 'refresh');
        }
        if ($this->session->userdata('login') == 1){
            redirect(base_url() . 'main/dashboard', 'refresh');
        }
    }
    public function dashboard() {
        $page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('dashboard');
        $this->load->view('backend/index', $page_data);
    }
    /*HOSPITAL*/
    
    public function add_hospital() {  

    if ($this->input->post()) {
        $config = array(
        array('field' => 'name','label' => 'Name','rules' => 'required'),
        array('field' => 'address','label' => 'Address','rules' => 'required'),
        array('field' => 'phone_number','label' => 'Phone Number','rules' => 'required'),
        array('field' => 'email','label' => 'Email','rules' => 'required|valid_email'),
        array('field' => 'country','label' => 'Country','rules' => 'required'),
        array('field' => 'state','label' => 'State','rules' => 'required'),
        array('field' => 'district','label' => 'District','rules' => 'required'),
        array('field' => 'city','label' => 'City','rules' => 'required'),
        array('field' => 'md_name','label' => 'MD Name','rules' => 'required'),
        array('field' => 'md_phone','label' => 'MD Phone','rules' => 'required'),
        array('field' => 'status','label' => 'Status','rules' => 'required'),
        );
        $this->form_validation->set_rules($config);
         if ($this->form_validation->run() == TRUE)
                {
                        $this->crud_model->save_hospital_info();
            $this->session->set_flashdata('message', get_phrase('hospital_info_saved_successfuly'));
            redirect($this->session->userdata('last_page'));
                }
        } 
        $data['page_name'] = 'add_hospital';
        $data['page_title'] = get_phrase('add_hospital');
        $this->load->view('backend/index', $data);
        }
         public function edit_hospital($hospital_id) {
        if($this->input->post()){   
        $config = array(
        array('field' => 'name','label' => 'Name','rules' => 'required'),
        array('field' => 'address','label' => 'Address','rules' => 'required'),
        array('field' => 'phone_number','label' => 'Phone Number','rules' => 'required'),
        array('field' => 'email','label' => 'Email','rules' => 'required|valid_email'),
        array('field' => 'country','label' => 'Country','rules' => 'required'),
        array('field' => 'state','label' => 'State','rules' => 'required'),
        array('field' => 'district','label' => 'District','rules' => 'required'),
        array('field' => 'city','label' => 'City','rules' => 'required'),
        array('field' => 'md_name','label' => 'MD Name','rules' => 'required'),
        array('field' => 'md_phone','label' => 'MD Phone','rules' => 'required'),
        array('field' => 'status','label' => 'Status','rules' => 'required'),
        );
        $this->form_validation->set_rules($config);

         if ($this->form_validation->run() == TRUE){ 
            $this->crud_model->update_hospital_info($hospital_id);
            $this->session->set_flashdata('message', get_phrase('hospital_info_updated_successfuly'));
            redirect($this->session->userdata('last_page'));
                }
         }
         $data['hospital_id'] = $hospital_id;
        $data['page_name'] = 'edit_hospital';
        $data['page_title'] = get_phrase('edit_hospital');
       
        $this->load->view('backend/index', $data);
        }
    function hospital($task = "", $hospital_id = "") {
        if ($task == "delete") {
            $this->crud_model->delete_hospital_info($hospital_id);
            $this->session->set_flashdata('message', get_phrase('hospital_info_deleted_successfuly'));
            redirect(base_url() . 'main/hospital');
        }
        if ($task == "delete_multiple") {
           $this->crud_model->delete_multiple_hospital_info();
            $this->session->set_flashdata('message', get_phrase('hospitals_info_deleted_successfuly'));
            redirect(base_url() . 'main/hospital');
        }
        $data['hospital_info'] = $this->crud_model->select_hospital_info();
        $data['page_name'] = 'manage_hospital';
        $data['page_title'] = get_phrase('hospitals');
        $this->load->view('backend/index', $data);  
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
            /*redirect(base_url() . 'main/get_hospital_branch/'.$hospital);*/
            redirect($this->session->userdata('last_page'));
        }
        if ($task == "update") {
            $this->crud_model->update_branch_info($branch_id);
            $this->session->set_flashdata('message', get_phrase('branch_info_updated_successfuly'));
            redirect(base_url() . 'main/branch');
        }

        if ($task == "delete") {
            $this->crud_model->delete_branch_info($branch_id);
            redirect($this->session->userdata('last_page'));
        }
        if ($task == "delete_multiple") {
           $this->crud_model->delete_multiple_branch_info();
            $this->session->set_flashdata('message', get_phrase('branch_info_deleted_successfuly'));
            redirect($this->session->userdata('last_page'));
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
            /*redirect(base_url() . 'main/get_hospital_departments/'.$branch);*/
            redirect($this->session->userdata('last_page'));
        }

        if ($task == "update") {
            $this->crud_model->update_department_info($department_id);
            $this->session->set_flashdata('message', get_phrase('department_info_updated_successfuly'));
            redirect($this->session->userdata('last_page'));
        }

        if ($task == "delete") {
            $this->crud_model->delete_department_info($department_id);
            $this->session->set_flashdata('message', get_phrase('department_info_deleted_successfuly'));
            redirect($this->session->userdata('last_page'));
        }
        if ($task == "delete_multiple") {
           $this->crud_model->delete_multiple_department_info();
            $this->session->set_flashdata('message', get_phrase('department_info_deleted_successfuly'));
            redirect($this->session->userdata('last_page'));
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
            /*redirect(base_url() . 'main/get_hospital_ward/'.$department);*/
            redirect($this->session->userdata('last_page'));
        }

        if ($task == "update") {
            $this->crud_model->update_ward_info($ward_id);
            $this->session->set_flashdata('message', get_phrase('ward_info_updated_successfuly'));
            redirect($this->session->userdata('last_page'));
        }

        if ($task == "delete") {
            $this->crud_model->delete_ward_info($ward_id);
            redirect($this->session->userdata('last_page'));
        }
        if ($task == "delete_multiple") {
           $this->crud_model->delete_multiple_ward_info();
            $this->session->set_flashdata('message', get_phrase('ward_info_deleted_successfuly'));
            redirect($this->session->userdata('last_page'));
        }
        $data['ward_info'] = $this->crud_model->select_ward_info();
        $data['page_name'] = 'manage_ward';
        $data['page_title'] = get_phrase('ward');
        $this->load->view('backend/index', $data);
    }
    function add_bed($ward_id='',$task = "", $id = "") {
        $data['ward_id']=$ward_id;
         $data['page_name'] = 'add_bed';
        $data['page_title'] = get_phrase('add_bed');
        $this->load->view('backend/index', $data);
    }
    function edit_bed($task = "", $id = "") {
        $data['bed_id']=$task;
         $data['page_name'] = 'edit_bed';
        $data['page_title'] = get_phrase('edit_bed');
        $this->load->view('backend/index', $data);
    }
    function bed($task = "", $id = "") {
        
        if ($task == "create") {
            $ward=$this->input->post('ward');
            $this->crud_model->save_bed_info();
            $this->session->set_flashdata('message', get_phrase('beds_info_saved_successfuly'));
           redirect($this->session->userdata('last_page'));
          /*  redirect(base_url() . 'main/get_hospital_bed/'.$ward);*/
        }
        if ($task == "update") {
                $this->crud_model->update_bed_info($id);
                $this->session->set_flashdata('message', get_phrase('bed_info_updated_successfuly'));
                redirect($this->session->userdata('last_page'));
        }

        if ($task == "delete") {
            $this->crud_model->delete_bed_info($id);
            $this->session->set_flashdata('message', get_phrase('bed_info_deleted_successfuly'));
            redirect($this->session->userdata('last_page'));
        }
        if ($task == "delete_multiple") {
           $this->crud_model->delete_multiple_bed_info();
            $this->session->set_flashdata('message', get_phrase('bed_info_deleted_successfuly'));
            redirect($this->session->userdata('last_page'));
        }

        $data['bed_info'] = $this->crud_model->select_beds_info();
        $data['page_name'] = 'manage_bed';
        $data['page_title'] = get_phrase('beds');
        $this->load->view('backend/index', $data);
    }
     /**********SINGLE DATA GET WITH ID*************/
    public function get_hospital_history($hospital_id){
        $data['hospital_id']=$hospital_id;
        $data['page_name'] = 'hospital_history';
        $data['page_title'] = get_phrase('hospital_details');
        $this->load->view('backend/index', $data);
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
    /*HOSPITAL ADMINS*/
    function add_hospital_admins()
    {
    if($this->input->post())
        {
        $config = array(
        array('field' => 'fname','label' => 'First Name','rules' => 'required'),
        array('field' => 'lname','label' => 'Last Name','rules' => 'required'),
        array('field' => 'description','label' => 'Description','rules' => 'required'),
        array('field' => 'email','label' => 'Email','rules' => 'required|valid_email'),
         array('field' => 'phone_number','label' => 'Phone Number','rules' => 'required'),
        array('field' => 'hospital','label' => 'Hospital','rules' => 'required'),
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
            $this->crud_model->save_hospitaladmins_info();
            $this->session->set_flashdata('message', get_phrase('hospital_admin_info_added_successfuly'));
            $this->email_model->account_opening_email('hospitaladmins','admin', $email);
            /*redirect(base_url() . 'main/hospital_admins');*/
            redirect($this->session->userdata('last_page'));
        }else{
            $this->session->set_flashdata('message', get_phrase('duplicate_phone_number'));
        }
            }else {
                $this->session->set_flashdata('message', get_phrase('duplicate_email'));
            }
        }
    }
        $page_data['page_name'] = 'add_hospital_admin';
        $page_data['page_title'] = get_phrase('add_hospital_admins');
        $page_data['admins'] = $this->db->get_where('hospitals',array('status'=>1))->result_array();
        $this->load->view('backend/index', $page_data);
        
    }
       public function edit_hospital_admins($id) {
        if($this->input->post())
        {
        $config = array(
        array('field' => 'fname','label' => 'First Name','rules' => 'required'),
        array('field' => 'lname','label' => 'Last Name','rules' => 'required'),
        array('field' => 'description','label' => 'Description','rules' => 'required'),
        array('field' => 'email','label' => 'Email','rules' => 'required|valid_email'),
         array('field' => 'mobile','label' => 'Phone Number','rules' => 'required'),
        array('field' => 'hospital','label' => 'Hospital','rules' => 'required'),
        array('field' => 'status','label' => 'Status','rules' => 'required'),
        );
        $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == TRUE){
           $email = $this->input->post('email');
           $validation = $validation = email_validation_for_edit($email, $id,'hospitaladmins', 'admin');
            if ($validation == 1) {
           $phone_number = $this->input->post('phone_number');
           $phone = $validation = email_validation_for_edit($phone_number, $id, 'hospitaladmins','admin');
           
           if($phone == 1){
           $this->crud_model->update_hospitaladmins_info($id);
            $this->session->set_flashdata('message', get_phrase('hospita_admin_info_updated_successfuly'));
            /*redirect(base_url() . 'main/hospital_admins');*/
            redirect($this->session->userdata('last_page'));
        }else{
            $this->session->set_flashdata('message', get_phrase('duplicate_phone_number'));
        }
            }else {
                $this->session->set_flashdata('message', get_phrase('duplicate_email'));
            }
        }
    }
        $data['admin_id'] = $id;
        $data['page_name'] = 'edit_hospital_admin';
        $data['page_title'] = get_phrase('edit_hospital_admins');
       
        $this->load->view('backend/index', $data);
        }
    function hospital_admins($task = "", $admin_id = "") {
    
        if ($task == "delete") {
            $this->crud_model->delete_hospitaladmins_info($admin_id);
            $this->session->set_flashdata('message', get_phrase('admin_info_deleted_successfuly'));
            /*redirect(base_url() . 'main/hospital_admins');*/
            redirect($this->session->userdata('last_page'));redirect($this->session->userdata('last_page'));
        }
        if ($task == "delete_multiple") {
           $this->crud_model->delete_multiple_hospital_admins_info();
            $this->session->set_flashdata('message', get_phrase('hospitaladmins_info_deleted_successfuly'));
            /*redirect(base_url() . 'main/hospital_admins');*/
            redirect($this->session->userdata('last_page'));
        }
        $data['admin_info'] = $this->crud_model->select_hospitaladmins_info();
        $data['page_name'] = 'manage_admins';
        $data['page_title'] = get_phrase('hospital_admins');
        $this->load->view('backend/index', $data);
    }
        function view_doctors($task = "", $id = "") {
        if ($task == "nurse") {
            $doctor=$this->db->where('nurse_id',$id)->get('nurse')->row();
        }
        if ($task == "receptionist") {
            $doctor=$this->db->where('receptionist_id',$id)->get('receptionist')->row();
        }
        $doctor_id=explode(',', $doctor->doctor_id);
        for($i=0;$i<count($doctor_id);$i++){
        $doctor_data[]=$this->db->where('doctor_id',$doctor_id[$i])->get('doctors')->row_array();
        }
        $data['doctor_info'] = $doctor_data;
        $data['page_name'] = 'manage_doctor';
        $data['page_title'] = get_phrase('Doctors - '.$doctor->name);
        $this->load->view('backend/index', $data);
    }
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

    function doctor($task = "", $doctor_id = "") {
        if ($task == "delete") {
            $this->crud_model->delete_doctor_info($doctor_id);
            redirect($this->session->userdata('last_page'));
        }
        if ($task == "delete_multiple") {
           $this->crud_model->delete_multiple_doctor_info();
            $this->session->set_flashdata('message', get_phrase('doctor_info_deleted_successfuly'));
            redirect($this->session->userdata('last_page'));
        }
        $data['doctor_info'] = $this->crud_model->select_doctor_info();
        $data['page_name'] = 'manage_doctor';
        $data['page_title'] = get_phrase('doctors');
        $this->load->view('backend/index', $data);
    }
    

    function doctor_availability($task = "",$id='')
    {
        if ($task == "update") {
                $this->crud_model->update_doctor_availability_info($id);
                $this->session->set_flashdata('message', get_phrase('doctor_availability_info_saved_successfuly'));
            /*redirect(base_url() . 'main/doctor_availability/'.$id);*/
            redirect($this->session->userdata('last_page1'));
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
            /*redirect(base_url() . 'main/doctor_availability/'.$id);*/
            redirect($this->session->userdata('last_page1'));
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
            /*redirect(base_url() . 'main/doctor_availability/'.$id);*/
            redirect($this->session->userdata('last_page1'));
        }
        if ($task == "delete") {
            
                $this->crud_model->delete_doc_availability_info($id1);
                $this->session->set_flashdata('message', get_phrase('doctor_availability_deleted_successfuly'));
            /*redirect(base_url() . 'main/doctor_availability/'.$id);*/
            redirect($this->session->userdata('last_page1'));
        }
        if ($task == "delete_all") {
            
                $this->crud_model->delete_all_doc_availability_info($id1);
                $this->session->set_flashdata('message', get_phrase('doctor_availability_deleted_successfuly'));
           /* redirect(base_url() . 'main/doctor_availability/'.$id);*/
           redirect($this->session->userdata('last_page1'));
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

        $data['nurse_info'] = $this->crud_model->select_nurse_info();
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
        $data['receptionist_info'] = $this->crud_model->select_receptionist_info();
        $data['page_name'] = 'manage_receptionist';
        $data['page_title'] = get_phrase('receptionists');
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
        /*array('field' => 'hospital','label' => 'Hospital','rules' => 'required'),
        array('field' => 'branch','label' => 'Branch','rules' => 'required'),*/
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
        /*array('field' => 'hospital','label' => 'Hospital','rules' => 'required'),
        array('field' => 'branch','label' => 'Branch','rules' => 'required'),*/
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
        $data['lab_info'] = $this->crud_model->select_lab_info();
        $data['page_name'] = 'manage_labs';
        $data['page_title'] = get_phrase('Medical labs');
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
        /*array('field' => 'hospital','label' => 'Hospital','rules' => 'required'),
        array('field' => 'branch','label' => 'Branch','rules' => 'required'),*/
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
        /*array('field' => 'hospital','label' => 'Hospital','rules' => 'required'),
        array('field' => 'branch','label' => 'Branch','rules' => 'required'),*/
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
      
        $data['store_info'] = $this->crud_model->select_store_info();
        $data['page_name'] = 'manage_stores';
        $data['page_title'] = get_phrase('Medical stores');
        $this->load->view('backend/index', $data);
    }
    function add_user($user_id = "") {
        if($this->input->post()){
        $config = array(
        array('field' => 'fname','label' => 'First Name','rules' => 'required'),
        array('field' => 'lname','label' => 'Last Name','rules' => 'required'),
        array('field' => 'description','label' => 'Description','rules' => 'required'),
        array('field' => 'email','label' => 'Email','rules' => 'required|valid_email'),
        array('field' => 'mobile','label' => 'Phone Number','rules' => 'required'),
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
           $this->crud_model->save_user_info();
            $this->session->set_flashdata('message', get_phrase('user_info_saved_successfuly'));
            $this->email_model->account_opening_email('users','user', $email);
            redirect($this->session->userdata('last_page'));
        }else{
            $this->session->set_flashdata('message', get_phrase('duplicate_phone_number'));
        }
            }else {
                $this->session->set_flashdata('message', get_phrase('duplicate_email'));
            }
        }
    }
        $data['page_name'] = 'add_user';
        $data['page_title'] = get_phrase('add_mypulse_users');
        $this->load->view('backend/index', $data);
    }
    function edit_user($user_id = "") {
        if($this->input->post()){
        $config = array(
        array('field' => 'fname','label' => 'First Name','rules' => 'required'),
        array('field' => 'lname','label' => 'Last Name','rules' => 'required'),
        array('field' => 'description','label' => 'Description','rules' => 'required'),
        array('field' => 'email','label' => 'Email','rules' => 'required|valid_email'),
        array('field' => 'mobile','label' => 'Phone Number','rules' => 'required'),
        array('field' => 'status','label' => 'Status','rules' => 'required'),
        );
        $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == TRUE){
           $email = $this->input->post('email');
           $validation = email_validation_for_edit($email, $user_id, 'users','user');
            if ($validation == 1) {
           $phone_number = $this->input->post('mobile');
           $phone = mobile_validation_for_edit($phone_number,$user_id,'users','user');
           if($phone == 1){
            $this->crud_model->update_user_info($user_id);
                $this->session->set_flashdata('message', get_phrase('user_info_updated_successfuly'));
                redirect($this->session->userdata('last_page'));
        }else{
            $this->session->set_flashdata('message', get_phrase('duplicate_phone_number'));
        }
            }else {
                $this->session->set_flashdata('message', get_phrase('duplicate_email'));
            }
        }
    }
        $data['id']=$user_id;
        $data['page_name'] = 'edit_user';
        $data['page_title'] = get_phrase('myPulse_users');
        $this->load->view('backend/index', $data);
    }

    function users($task = "", $patient_id = "") {
        if ($task == "delete") {

            $this->crud_model->delete_user_info($patient_id);
            $this->session->set_flashdata('message', get_phrase('user_info_deleted_successfuly'));
            redirect($this->session->userdata('last_page'));
        }
        if ($task == "delete_multiple") {
           $this->crud_model->delete_multiple_user_info();
            $this->session->set_flashdata('message', get_phrase('user_info_deleted_successfuly'));
            redirect($this->session->userdata('last_page'));
        }
        /*if ($task == "dj_report") {
             $this->crud_model->select_prescription_info_by_patient($patient_id);
             redirect(base_url() . 'main/patient');
        }*/
        $data['patient_info'] = $this->crud_model->select_user_info();
        $data['page_name'] = 'manage_users';
        $data['page_title'] = get_phrase('myPulse_users');
        $this->load->view('backend/index', $data);
    }
       function unuser(){
           
           $this->crud_model->save_unuser_info();
            $this->session->set_flashdata('message', get_phrase('unregistered_user_info_saved_successfuly'));
           /* $this->email_model->account_opening_email('users','user', $email);*/
            redirect(base_url() . 'main/add_appointment');
    }
     function add_inpatient()
    {
    if($this->input->post()){
    $this->crud_model->save_inpatient_info();
    $this->session->set_flashdata('message', get_phrase('inpatient_info_saved_successfuly'));
    redirect($this->session->userdata('last_page'));
    
    }

        $data['page_name'] = 'add_inpatient';
        $data['page_title'] = get_phrase('add_in-Patient');
        $this->load->view('backend/index', $data);
    }
    function edit_inpatient($patient_id='')
    {
    if($this->input->post()){
    $this->crud_model->update_inpatient_info($patient_id);
    $this->session->set_flashdata('message', get_phrase('inpatient_info_updated_successfuly'));
    redirect($this->session->userdata('last_page'));
    
    }
        $data['patient_id'] = $patient_id;
        $data['page_name'] = 'edit_inpatient';
        $data['page_title'] = get_phrase('in-Patient');
        $this->load->view('backend/index', $data);
    }
    function inpatient($task = "", $patient_id = "") {
        $data['patient_info'] = $this->crud_model->select_inpatient_info();
        $data['page_name'] = 'manage_inpatient';
        $data['page_title'] = get_phrase('inpatients');
        $this->load->view('backend/index', $data);
    }
    function inpatient_history($task = "", $patient_id = "") {
        $data['inpatient'] = $this->crud_model->select_inpatient_id_info($task);
        $data['inpatient_history'] = $this->crud_model->select_inpatient_history_info($task);
        $name=$this->db->where('user_id',$data['inpatient']->user_id)->get('users')->row_array();
        $data['page_name'] = 'inpatient_history';
        $data['page_title'] = get_phrase('inpatient - ').$name['name'].' ('.$name['unique_id'].')';
        $this->load->view('backend/index', $data);
    }
    function patient($task = "", $patient_id = "") {
        $data['patient_info'] = $this->crud_model->select_patient_info();
        $data['page_name'] = 'manage_patient';
        $data['page_title'] = get_phrase('patients');
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
            redirect($this->session->userdata('last_page'));
        }
        if ($task == "close_multiple") {
            $this->crud_model->close_multiple_appointment_info();
            $this->session->set_flashdata('message', get_phrase('appointment_info_closed_successfuly'));
        }
        if ($task == "update_remark") {
            $this->crud_model->update_appointment_remark($appointment_id);
            $this->session->set_flashdata('message', get_phrase('remark_updated_successfuly'));
            redirect($this->session->userdata('last_page1'));
        }

        $data['appointment_info'] = $this->crud_model->select_appointment_info();
        $data['page_name'] = 'manage_appointment';
        $data['page_title'] = get_phrase('manage_appointments');
        $this->load->view('backend/index', $data);
    }
    function appointment_cancel($task =''){
        if ($task == "cancel_multiple") {
        if($_POST['cancel_reason'] != ''){
            $d=$this->crud_model->cancel_multiple_appointment_info();
            if($d){
            $this->session->set_flashdata('message', get_phrase('appointment_info_cancled_successfuly'));echo TRUE;}
        }else{
            echo '<span id="reason_error" style="color:red;">Reason Required</span>';
        }
        }
    }
    function appointment_history( $appointment_id = "") {
        $data['appointment_id'] = $appointment_id;
        $data['page_name'] = 'appointment_history';
        $data['page_title'] = get_phrase('Appointment Id : ').$this->db->where('appointment_id',$appointment_id)->get('appointments')->row()->appointment_number;
        $this->load->view('backend/index', $data);
    }
    /********Add Prescription*********/
     function add_prescription($appointment_id='')
    {
    if($this->input->post()){
    $this->crud_model->save_prescription_info();
    $this->session->set_flashdata('message', get_phrase('prescription_info_saved_successfuly'));
    redirect($this->session->userdata('last_page1'));
    
    }
        $data['appointment_id'] = $appointment_id;
        $data['page_name'] = 'add_prescription';
        $data['page_title'] = get_phrase('add_prescription');
        $this->load->view('backend/index', $data);
    }
    function edit_prescription($prescription_id='')
    {
    if($this->input->post()){
    $this->crud_model->update_prescription_info();
    $this->session->set_flashdata('message', get_phrase('prescription_info_updated_successfuly'));
    redirect($this->session->userdata('last_page1'));
    
    }
        $data['prescription_id'] = $prescription_id;
        $data['page_name'] = 'edit_prescription';
        $data['page_title'] = get_phrase('prescription');
        $this->load->view('backend/index', $data);
    }
    function prescription_history($prescription_id='',$order_id='')
    {
        if($order_id!=''){
        $data['order_id'] = $order_id;    
        }
        $data['prescription_id'] = $prescription_id;
        $data['page_name'] = 'prescription_history';
        $data['page_title'] = get_phrase('prescription');
        $this->load->view('backend/index', $data);
    }
    function prescription_order($prescription_id='',$type_order='')
    {
        $data['prescription_id'] = $prescription_id;
        $data['type_order'] = $type_order;
        $data['page_name'] = 'add_placeorder';
        $data['page_title'] = get_phrase('prescription');
        $this->load->view('backend/index', $data);
    }
    function prescription($param1='',$param2='',$param3='')
    {

        if ($param1 == "order") {
            $this->crud_model->save_prescription_order($param2);
            $this->session->set_flashdata('message', get_phrase('order_booked_successfuly'));
            redirect($this->session->userdata('last_page'));
        }   
        if ($param1 == "delete") {
            $this->crud_model->delete_prescription($param2);
            $this->session->set_flashdata('message', get_phrase('prescription_info_deleted_successfuly'));
            redirect($this->session->userdata('last_page'));
        }
        if ($param1 == "status") {
            $this->crud_model->update_prescription_status($param2,$param3);
            $this->session->set_flashdata('message', get_phrase('prescription_status_updated_successfuly'));
            redirect($this->session->userdata('last_page'));
        } 
        $data['prescription']=$this->crud_model->select_prescription_info();
        $data['page_name'] = 'manage_prescription';
        $data['page_title'] = get_phrase('prescriptions');
        $this->load->view('backend/index', $data);
    }
    function upload_receipt($param1){
        $this->crud_model->upload_prescription_receipt($param1);
        $this->session->set_flashdata('message', get_phrase('recipt_uploade_successfuly'));
        redirect($this->session->userdata('last_page'));
    }
    /********Add Prognosis*********/
     function add_prognosis($appointment_id='')
    {
    if($this->input->post()){
    $this->crud_model->save_prognosis_info();
    $this->session->set_flashdata('message', get_phrase('prognosis_info_saved_successfuly'));
    redirect($this->session->userdata('last_page1'));
    
    }
        $data['appointment_id'] = $appointment_id;
        $data['page_name'] = 'add_prognosis';
        $data['page_title'] = get_phrase('add_prognosis');
        $this->load->view('backend/index', $data);
    }
    function edit_prognosis($prognosis_id='')
    {
    if($this->input->post()){
    $this->crud_model->update_prognosis_info($prognosis_id);
    $this->session->set_flashdata('message', get_phrase('prescription_info_updated_successfuly'));
    redirect($this->session->userdata('last_page1'));
    
    }
        $data['prognosis_id'] = $prognosis_id;
        $data['page_name'] = 'edit_prognosis';
        $data['page_title'] = get_phrase('prognosis');
        $this->load->view('backend/index', $data);
    }
    function prognosis($param1='',$param2='',$param3='')
    {   
        if ($param1 == "delete") {
            $this->crud_model->delete_prognosis($param2);
            $this->session->set_flashdata('message', get_phrase('prognosis_info_deleted_successfuly'));
            redirect($this->session->userdata('last_page'));
        }
        if ($param1 == "status") {
            $this->crud_model->update_prognosis_status($param2,$param3);
            $this->session->set_flashdata('message', get_phrase('prognosis_status_updated_successfuly'));
            redirect($this->session->userdata('last_page'));
        } 
        $data['prognosis']=$this->crud_model->select_prognosis_info();
        $data['page_name'] = 'manage_prognosis';
        $data['page_title'] = get_phrase('prognosis');
        $this->load->view('backend/index', $data);
    }
    function orders($param1='',$param2='')
    {

        if ($param1 == "order") {
            $this->crud_model->save_prescription_order($param2);
            $this->session->set_flashdata('message', get_phrase('prognosis_ordered_successfuly'));
            redirect($this->session->userdata('last_page'));
        }   
        if ($param1 == "delete") {
            $this->crud_model->delete_prescription($param2);
            $this->session->set_flashdata('message', get_phrase('prognosis_info_deleted_successfuly'));
            redirect($this->session->userdata('last_page'));
        }
        $data['order']=$this->crud_model->select_order_info();
        $data['page_name'] = 'manage_order';
        $data['page_title'] = get_phrase('orders');
        $this->load->view('backend/index', $data);
    }
    function report($report_id = "") {
        $data['report_id']=$report_id;
        $data['hospital_info'] = $this->crud_model->select_report_info();
        $data['page_name'] = 'manage_reports';
        if($report_id==1){
        /*$this->crud_model->getReport();*/
        $data['page_title'] = get_phrase('patient_reports');
        }elseif($report_id==2){
        /*$this->crud_model->getReport();*/
        $data['page_title'] = get_phrase('appointment_reports');
        }
        $this->load->view('backend/index', $data);
    }
    function report_chart($report_id = "",$hospital_id = "",$sd = "",$ed = "") {
        if($report_id==1){
        $data['title']='Patients';
        $this->crud_model->getReport();
        $data['page_title'] = get_phrase('Patient_trend');
        }elseif($report_id==2){
        $data['title']='Appointments';
        $this->crud_model->getReport();
        $data['page_title'] = get_phrase('appointment_trend');
        }
        $data['sd'] = $sd;
        $data['ed'] = $ed;
        $data['report_id'] = $report_id;
        $data['hospital_id'] = array($hospital_id);
        $data['page_name'] = 'reports';
        $this->load->view('backend/index', $data);
    }
    function report_chart1($report_id = "",$hospital_id = "") {
        if($report_id==1){
        $data['title']='Patients';
        $this->crud_model->getReport();
        $data['page_title'] = get_phrase('Patient_trend');
        }elseif($report_id==2){
        $data['title']='Appointments';
        $this->crud_model->getReport();
        $data['page_title'] = get_phrase('appointment_trend');
        }
        $data['sd'] = $this->input->post('sd');
        $data['ed'] = $this->input->post('ed');
        $data['report_id'] = $report_id;
        $data['hospital_id'] = $this->input->post('check');
        $data['page_name'] = 'reports';
        $this->load->view('backend/index', $data);
    }
        /***************Privacy & Policy ,Terms & Conditions****************/
    function edit_privacy($param1 = '', $param2 = '', $param3 = '') {
        if($param1 == 1){
            if($this->input->post()){
        $data_list['description'] = $this->input->post('name');
        $this->db->where('type', 'privacy');
        $this->db->update('settings', $data_list);
        $this->session->set_flashdata('message', get_phrase('data_updated_successfuly'));
        redirect($this->session->userdata('last_page'));
            }
    $page_data['id']=$param1;
    $page_data['privacy'] = $this->db->get_where('settings', array('type' => 'privacy'))->row()->description;
    $page_data['page_title'] = get_phrase('Edit Privacy & Policy');
        }elseif($param1 == 2){
            if($this->input->post()){
        $data_list['description'] = $this->input->post('name');
        $this->db->where('type', 'terms');
        $this->db->update('settings', $data_list);
        $this->session->set_flashdata('message', get_phrase('data_updated_successfuly'));
        redirect($this->session->userdata('last_page'));
            }
            $page_data['id']=$param1;
            $page_data['privacy'] = $this->db->get_where('settings', array('type' => 'terms'))->row()->description;
    $page_data['page_title'] = get_phrase('Edit Terms & Conditions');
        }
        $page_data['page_name'] = 'edit_privacy';
        
        $this->load->view('backend/index', $page_data);
    }
    function manage_privacy($param1 = '', $param2 = '', $param3 = '') {
        if($param1 == 1){
            $page_data['privacy'] = $this->db->get_where('settings', array('type' => 'privacy'))->row()->description;
            
        }elseif($param1 == 2){
            $page_data['privacy'] = $this->db->get_where('settings', array('type' => 'terms'))->row()->description;
        }
        $page_data['page_name'] = 'manage_privacy';
        $page_data['page_title'] = get_phrase('Privacy & Policy , Terms & Conditions');
        $this->load->view('backend/index', $page_data);
    }
    /******************* Languages *********************/
    function language($param1 = '', $param2 = '', $param3 = '') {
        if ($param1 == "create") {
            $this->crud_model->save_language_info();
            $this->session->set_flashdata('message', get_phrase('language_info_saved_successfuly'));
            redirect(base_url() . 'main/language');
        }
        if ($param1 == "delete") {
            $this->crud_model->delete_language($param2);
            redirect(base_url() . 'main/language');
        }
        $page_data['page_name'] = 'language';
        $page_data['page_title'] = get_phrase('Languages');
        $page_data['country'] = $this->db->get('language')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    /*******************GENERAL SETTINGS*********************/
    function specialization($param1 = '', $param2 = '', $param3 = '') {
        if ($param1 == "create") {
            
            $this->crud_model->save_specialization_info();
            $this->session->set_flashdata('message', get_phrase('specialization_info_saved_successfuly'));
            redirect(base_url() . 'main/specialization');
        }
        if ($param1 == "delete") {
            $this->crud_model->delete_specialization($param2);
            redirect(base_url() . 'main/specialization');
        }
        $page_data['page_name'] = 'specializations';
        $page_data['page_title'] = get_phrase('Specializations');
        $page_data['country'] = $this->db->get('specializations')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    function country($param1 = '', $param2 = '', $param3 = '') {
        if ($param1 == "create") {
            
            $this->crud_model->save_country_info();
            $this->session->set_flashdata('message', get_phrase('country_info_saved_successfuly'));
            redirect(base_url() . 'main/country');
        }
        if ($param1 == "update") {
            
            $this->crud_model->update_country_info($param2);
            $this->session->set_flashdata('message', get_phrase('country_info_updated_successfuly'));
            redirect(base_url() . 'main/country');
        }
        $page_data['page_name'] = 'country';
        $page_data['page_title'] = get_phrase('country');
        $page_data['country'] = $this->db->get('country')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    function state($param1 = '', $param2 = '', $param3 = '') {
        if ($param1 == "create") {
            $this->crud_model->save_state_info();
            $this->session->set_flashdata('message', get_phrase('state_info_saved_successfuly'));
            redirect(base_url() . 'main/state');
        }
         if ($param1 == "update") {
            
            $this->crud_model->update_state_info($param2);
            $this->session->set_flashdata('message', get_phrase('state_info_updated_successfuly'));
            redirect(base_url() . 'main/state');
        }
        $page_data['page_name'] = 'state';
        $page_data['page_title'] = get_phrase('state');
        $page_data['country'] = $this->db->get('state')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    function district($param1 = '', $param2 = '', $param3 = '') {
        if ($param1 == "create") {
            $this->crud_model->save_district_info();
            $this->session->set_flashdata('message', get_phrase('district_info_saved_successfuly'));
            redirect(base_url() . 'main/district');
        }
         if ($param1 == "update") {
            
            $this->crud_model->update_district_info($param2);
            $this->session->set_flashdata('message', get_phrase('district_info_updated_successfuly'));
            redirect(base_url() . 'main/district');
        }
        $page_data['page_name'] = 'district';
        $page_data['page_title'] = get_phrase('district');
        $page_data['country'] = $this->db->get('district')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    function city($param1 = '', $param2 = '', $param3 = '') {
        if ($param1 == "create") {
            $this->crud_model->save_city_info();
            $this->session->set_flashdata('message', get_phrase('city_info_saved_successfuly'));
            redirect(base_url() . 'main/city');
        }
         if ($param1 == "update") {
            
            $this->crud_model->update_city_info($param2);
            $this->session->set_flashdata('message', get_phrase('city_info_updated_successfuly'));
            redirect(base_url() . 'main/city');
        }
        $page_data['page_name'] = 'city';
        $page_data['page_title'] = get_phrase('city');
        $page_data['country'] = $this->db->get('city')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    function license($param1 = '', $param2 = '', $param3 = '') {
        if ($param1 == "create") {
            $this->crud_model->save_license_info();
            $this->session->set_flashdata('message', get_phrase('license_info_saved_successfuly'));
            redirect(base_url() . 'main/license');
        }
        if ($param1 == "update") {
            $this->crud_model->update_license_info($param2);
            $this->session->set_flashdata('message', get_phrase('license_info_updated_successfuly'));
            redirect(base_url() . 'main/license');
        }
        if ($task == "delete") {
            $this->crud_model->delete_license($param2);
            redirect(base_url() . 'main/license');
        }
        $page_data['page_name'] = 'license';
        $page_data['page_title'] = get_phrase('license');
        $page_data['license'] = $this->db->get('license')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    function health_insurance_provider($param1 = '', $param2 = '', $param3 = '') {
        if ($param1 == "create") {
            $this->crud_model->save_health_insurance_provider_info();
            $this->session->set_flashdata('message', get_phrase('health_insurance_provider_info_saved_successfuly'));
            redirect(base_url() . 'main/health_insurance_provider');
        }
        if ($task == "delete") {
            $this->crud_model->delete_health_insurance_provider($param2);
            redirect(base_url() . 'main/health_insurance_provider');
        }
        $page_data['page_name'] = 'health_insurance_provider';
        $page_data['page_title'] = get_phrase('health_insurance_provider');
        $page_data['health_insurance_provider'] = $this->db->get('health_insurance_provider')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    /********************MESSAGE********************/
        /* private messaging */
    function new_message($param1 = '', $param2 = '', $param3 = '') {
       
        if($this->input->post()){
           $this->crud_model->save_new_message();
            $this->session->set_flashdata('message', get_phrase('message_sent_successfuly'));
            redirect(base_url() . 'main/message/', 'refresh');
        }
        $page_data['page_name'] = 'new_message';
        $page_data['page_title'] = get_phrase('messages');
        $this->load->view('backend/index', $page_data);
    }
    function read_message($param1 = '', $param2 = '', $param3 = '') 
    {
        $page_data['messagedata']=$this->crud_model->read_message($param1);
        $page_data['message_id']=$param1;
        $page_data['page_name'] = 'message_read';
        $page_data['page_title'] = get_phrase('messages');
        $this->load->view('backend/index', $page_data);
    }
    function message($param1 = '', $param2 = '', $param3 = '') {
        $page_data['message_data']=$this->crud_model->select_message();
        /*$page_data['private_message_data']=$this->crud_model->select_private_message();*/
        $page_data['page_name'] = 'manage_message';
        $page_data['page_title'] = get_phrase('messages');
        $this->load->view('backend/index', $page_data);
    }
    function read_notification($param1 = '', $param2 = '', $param3 = '') 
    {
        $page_data['notification_data']=$this->crud_model->read_notification($param1);
        $page_data['notification_id']=$param1;
        $page_data['page_name'] = 'notification_read';
        $page_data['page_title'] = get_phrase('notifications');
        $this->load->view('backend/index', $page_data);
    }
    function notification($param1 = '', $param2 = '', $param3 = '') {
        $page_data['notification_data']=$this->crud_model->select_notification();
        $page_data['page_name'] = 'manage_notification';
        $page_data['page_title'] = get_phrase('notifications');
        $this->load->view('backend/index', $page_data);
    }
    public function resend_email_verification($task='',$type_id='',$id='')
    {
    $this->db->where('unique_id',$id)->update($task,array('modified_at'=>date('Y-m-d H:i:s')));
    $this->email_model->account_reverification_email($task,$type_id, $id);
        $this->session->set_flashdata('message', get_phrase('Verification Email Sended Successfully'));
        redirect($this->session->userdata('last_page'));
    }
    function system_settings($param1 = '', $param2 = '', $param3 = '') {
        if ($param1 == 'do_update') {
            $this->crud_model->update_system_settings();
            $this->session->set_flashdata('message', get_phrase('settings_updated'));
            redirect(base_url() . 'main/system_settings/', 'refresh');
        }
        if ($param1 == 'upload_logo') {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
            $this->session->set_flashdata('message', get_phrase('settings_updated'));
            redirect(base_url() . 'main/system_settings/', 'refresh');
        }
        $page_data['page_name'] = 'system_settings';
        $page_data['page_title'] = get_phrase('system_settings');
        $page_data['settings'] = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }
        function db_backup(){
               // Load the DB utility class
$this->load->dbutil();

// Backup your entire database and assign it to a variable
$backup = $this->dbutil->backup();

// Load the file helper and write the file to your server
$this->load->helper('file');
write_file('/path/to/mybackup.gz', $backup);

// Load the download helper and send the file to your desktop
$this->load->helper('download');
force_download('MyPulse-DB'.date('Ymd').'.sql', $backup);
    }
    /************Privacy & Policy ,Terms & Conditions****************/
    function privacy($param1 = '', $param2 = '', $param3 = '') {
        if($param1 == 1){
            $page_data['privacy'] = $this->db->get_where('settings', array('type' => 'privacy'))->row()->description;
            $page_data['page_title'] = get_phrase('Privacy & Policy');
        }elseif($param1 == 2){
            $page_data['privacy'] = $this->db->get_where('settings', array('type' => 'terms'))->row()->description;
            $page_data['page_title'] = get_phrase('Terms & Conditions');
        }
        $page_data['page_name'] = 'privacy';
        
        $this->load->view('backend/index', $page_data);
    }
    /*     * ****MANAGE OWN PROFILE AND CHANGE PASSWORD** */

    function manage_profile($param1 = '', $param2 = '', $param3 = '') {
        if ($param1 == 'update_profile_info') {
            $data['name'] = $this->input->post('name');
            $data['mname'] = $this->input->post('mname');
            $data['lname'] = $this->input->post('lname');
            $data['email'] = $this->input->post('email');
            $data['description'] = $this->input->post('description');
            $data['phone'] = $this->input->post('phone');
            $data['dob'] = $this->input->post('dob');
            $data['gender'] = $this->input->post('gender');
            $data['country'] = $this->input->post('country');
            $data['state'] = $this->input->post('state');
            $data['district'] = $this->input->post('district');
            $data['city'] = $this->input->post('city');
            $data['address'] = $this->input->post('address');

            $this->db->where('superadmin_id', $this->session->userdata('login_user_id'));
            $this->db->update('superadmin', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/superadmin_image/'.$this->session->userdata('login_user_id').'.jpg');
            $this->session->set_flashdata('message', get_phrase('profile_info_updated_successfuly'));
            redirect($this->session->userdata('last_page'));
        }
        $page_data['page_name'] = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data'] = $this->db->get_where($this->session->userdata('login_type'), array($this->session->userdata('type_id').'_id' => $this->session->userdata('login_user_id')))->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    function manage_password($param1 = '', $param2 = '', $param3 = '') {
        if ($param1 == 'change_password') {
            $current_password_input = sha1($this->input->post('password'));
            $new_password = sha1($this->input->post('new_password'));
            $confirm_new_password = sha1($this->input->post('confirm_new_password'));

            $current_password_db = $this->db->get_where($this->session->userdata('login_type'), array($this->session->userdata('type_id').'_id' =>
                        $this->session->userdata('login_user_id')))->row()->password;

            if ($current_password_db == $current_password_input && $new_password == $confirm_new_password) {
                $this->db->where($this->session->userdata('type_id').'_id', $this->session->userdata('login_user_id'));
                $this->db->update($this->session->userdata('login_type'), array('password' => $new_password));

                $this->session->set_flashdata('message', get_phrase('password_info_updated_successfuly'));
                redirect(base_url() . 'main/manage_password');
            } else {
                $this->session->set_flashdata('message', get_phrase('password_update_failed'));
                redirect(base_url() . 'main/manage_password');
            }
        }
        $page_data['page_name'] = 'manage_password';
        $page_data['page_title'] = get_phrase('manage_password');
        $page_data['edit_data'] = $this->db->get_where('superadmin', array('superadmin_id' => $this->session->userdata('login_user_id')))->result_array();
        $this->load->view('backend/index', $page_data);
    }
    function opt_verification($param1 = '', $param2 = '', $param3 = '')
    {

    $past_time=strtotime($_POST['otp_time']);
    $current_time = time();
    $difference = $current_time - $past_time;
    $difference_minute =  $difference/60;
    if(intval($difference_minute)<3){
        $otp_form=$this->input->post('otp');
        $otp=$this->session->userdata('otp');
        if($otp_form == $otp){
            $this->db->where($param2.'_id',$_POST['user_id']);
            $s=$this->db->update($param1, array('is_mobile' =>1));
            if($s){$this->session->set_flashdata('message', get_phrase('Your Mobile Number Verified Successfully'));
            echo TRUE;
            /*redirect($this->session->userdata('last_page1'));*/
            }
        }else{
            echo '<span id="otp_error" style="color:red;">OTP Incorect</span>';
        }
    }else{
        echo '<span id="otp_error" style="color:red;">OTP Time Was Experied</span>';
    }
    }
    function settings($param1 = '', $param2 = '', $param3 = '') {
        $page_data['page_name'] = 'settings';
        $page_data['page_title'] = get_phrase('settings');
        $this->load->view('backend/index', $page_data);
    }

}
?>