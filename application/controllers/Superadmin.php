<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Superadmin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();   
        $this->load->library('session');    
        error_reporting(0);  
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        if ($this->session->userdata('superadmin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
    }

    /*     * *default function, redirects to login page if no admin logged in yet** */

    public function index() {
        
        if ($this->session->userdata('superadmin_login') != 1) 
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('superadmin_login') == 1)
            redirect(base_url() . 'index.php?superadmin/dashboard', 'refresh');
    }

    /*     * *ADMIN DASHBOARD** */

    function dashboard() {
       
        $page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('superadmin_dashboard');
        $this->load->view('backend/index', $page_data);
    }

    /*     * ***LANGUAGE SETTINGS******** */
    function languages()
    {
        $data['lang'] = $this->session->userdata('language');
       extract($_POST);
       $this->session->set_userdata('language', $dlang);
       $redirect_url = base_url().$current;
       redirect($redirect_url); 
    
    }
    function manage_language($param1 = '', $param2 = '', $param3 = '') {
        

        if ($param1 == 'edit_phrase') {
            $page_data['edit_profile'] = $param2;
        }
        if ($param1 == 'update_phrase') {
            $language = $param2;
            $total_phrase = $this->input->post('total_phrase');
            for ($i = 1; $i < $total_phrase; $i++) {
                //$data[$language]	=	$this->input->post('phrase').$i;
                $this->db->where('phrase_id', $i);
                $this->db->update('language', array($language => $this->input->post('phrase' . $i)));
            }
            redirect(base_url() . 'index.php?superadmin/manage_language/edit_phrase/' . $language, 'refresh');
        }
        if ($param1 == 'do_update') {
            $language = $this->input->post('language');
            $data[$language] = $this->input->post('phrase');
            $this->db->where('phrase_id', $param2);
            $this->db->update('language', $data);
            $this->session->set_flashdata('message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?superadmin/manage_language/', 'refresh');
        }
        if ($param1 == 'add_phrase') {
            $data['phrase'] = $this->input->post('phrase');
            $this->db->insert('language', $data);
            $this->session->set_flashdata('message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?superadmin/manage_language/', 'refresh');
        }
        if ($param1 == 'add_language') {
            $language = $this->input->post('language');
            $this->load->dbforge();
            $fields = array(
                $language => array(
                    'type' => 'LONGTEXT'
                )
            );
            $this->dbforge->add_column('language', $fields);

            $this->session->set_flashdata('message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?superadmin/manage_language/', 'refresh');
        }
        if ($param1 == 'delete_language') {
            $language = $param2;
            $this->load->dbforge();
            $this->dbforge->drop_column('language', $language);
            $this->session->set_flashdata('message', get_phrase('settings_updated'));

            redirect(base_url() . 'index.php?superadmin/manage_language/', 'refresh');
        }
        $page_data['page_name'] = 'manage_language';
        $page_data['page_title'] = get_phrase('manage_language');
        //$page_data['language_phrases'] = $this->db->get('language')->result_array();
        $this->load->view('backend/index', $page_data);
    }
   /* function languages()
    {

       extract($_POST);
       $data['lang'] = $this->session->userdata('language');
       $this->session->set_userdata('language', $dlang);
       $redirect_url = base_url().$current;
       redirect($redirect_url); 
    
    }*/
    /*     * ***SITE/SYSTEM SETTINGS******** */

    function system_settings($param1 = '', $param2 = '', $param3 = '') {
        

        if ($param1 == 'do_update') {
            $this->crud_model->update_system_settings();
            $this->session->set_flashdata('message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?superadmin/system_settings/', 'refresh');
        }
        if ($param1 == 'upload_logo') {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
            $this->session->set_flashdata('message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?superadmin/system_settings/', 'refresh');
        }
        $page_data['page_name'] = 'system_settings';
        $page_data['page_title'] = get_phrase('system_settings');
        $page_data['settings'] = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    // SMS settings.
    function sms_settings($param1 = '') {


        if ($param1 == 'do_update') {
            $this->crud_model->update_sms_settings();
            $this->session->set_flashdata('message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?superadmin/sms_settings/', 'refresh');
        }

        $page_data['page_name'] = 'sms_settings';
        $page_data['page_title'] = get_phrase('sms_settings');
        $this->load->view('backend/index', $page_data);
    }
    
    /*     * ****MANAGE OWN PROFILE AND CHANGE PASSWORD** */

    function profile($param1 = '', $param2 = '', $param3 = '') {
      

        if ($param1 == 'update_profile_info') {
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');

            $this->db->where('admin_id', $this->session->userdata('login_user_id'));
            $this->db->update('admin', $data);

            $this->session->set_flashdata('message', get_phrase('profile_info_updated_successfuly'));
            redirect(base_url() . 'index.php?superadmin/manage_profile');
        }
        if ($param1 == 'change_password') {
            $current_password_input = sha1($this->input->post('password'));
            $new_password = sha1($this->input->post('new_password'));
            $confirm_new_password = sha1($this->input->post('confirm_new_password'));

            $current_password_db = $this->db->get_where('admin', array('admin_id' =>
                        $this->session->userdata('login_user_id')))->row()->password;

            if ($current_password_db == $current_password_input && $new_password == $confirm_new_password) {
                $this->db->where('admin_id', $this->session->userdata('login_user_id'));
                $this->db->update('admin', array('password' => $new_password));

                $this->session->set_flashdata('message', get_phrase('password_info_updated_successfuly'));
                redirect(base_url() . 'index.php?superadmin/manage_profile');
            } else {
                $this->session->set_flashdata('message', get_phrase('password_update_failed'));
                redirect(base_url() . 'index.php?superadmin/manage_profile');
            }
        }
        $page_data['page_name'] = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data'] = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('login_user_id')))->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    /*******************GENERAL SETTINGS*********************/
    function country($param1 = '', $param2 = '', $param3 = '') {
        if ($param1 == "create") {
            
            $this->crud_model->save_country_info();
            $this->session->set_flashdata('message', get_phrase('country_info_saved_successfuly'));
            redirect(base_url() . 'index.php?superadmin/country');
        }
        if ($param1 == "update") {
            
            $this->crud_model->update_country_info($param2);
            $this->session->set_flashdata('message', get_phrase('country_info_updated_successfuly'));
            redirect(base_url() . 'index.php?superadmin/country');
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
            redirect(base_url() . 'index.php?superadmin/state');
        }
         if ($param1 == "update") {
            
            $this->crud_model->update_state_info($param2);
            $this->session->set_flashdata('message', get_phrase('state_info_updated_successfuly'));
            redirect(base_url() . 'index.php?superadmin/state');
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
            redirect(base_url() . 'index.php?superadmin/district');
        }
         if ($param1 == "update") {
            
            $this->crud_model->update_district_info($param2);
            $this->session->set_flashdata('message', get_phrase('district_info_updated_successfuly'));
            redirect(base_url() . 'index.php?superadmin/district');
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
            redirect(base_url() . 'index.php?superadmin/city');
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
            redirect(base_url() . 'index.php?superadmin/license');
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
            redirect(base_url() . 'index.php?superadmin/health_insurance_provider');
        }
        $page_data['page_name'] = 'health_insurance_provider';
        $page_data['page_title'] = get_phrase('health_insurance_provider');
        $page_data['health_insurance_provider'] = $this->db->get('health_insurance_provider')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    /******GET STATES****/
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
    
     function get_doctor($department_id)   
    {
        $doctor = $this->db->get_where('doctors' , array(
            'department_id' => $department_id,'status'=>1
        ))->result_array();
        echo '<option value=""> Select Doctor </option>';  
        foreach ($doctor as $row) {
            echo '<option value="' . $row['doctor_id'] . '">' . $row['name'] . '</option>';
        }
    }
    
    
    /**********SINGLE DATA GET WITH ID*************/
    public function get_hospital_history($hospital_id){
       /* $data['branch_info'] = $this->db->where('hospital_id',$hospital_id)->get('branch')->result_array();
        $data['branch_info'] = $this->db->where('hospital_id',$hospital_id)->get('branch')->result_array();*/
        $data['hospital_id']=$hospital_id;
        $data['page_name'] = 'hospital_history';
        $data['page_title'] = get_phrase('hospital_history');
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
        if ($this->session->userdata('superadmin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
       
    $data['ward_info'] = $this->db->where('department_id',$department_id)->get('ward')->result_array();
    $data['department_id']=$department_id;
        $data['page_name'] = 'manage_ward';
        $data['page_title'] = get_phrase('ward');
        $this->load->view('backend/index', $data);
    }
     public function get_hospital_bed($ward_id='') {   
        if ($this->session->userdata('superadmin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
       
    $data['bed_info'] = $this->db->where('ward_id',$ward_id)->get('bed')->result_array();
    $data['ward_id']=$ward_id;
        $data['page_name'] = 'manage_bed';
        $data['page_title'] = get_phrase('bed');
        $this->load->view('backend/index', $data);
    }
    /*HOSPITAL*/
    
    public function add_hospital() {  

    if ($this->input->post()) {
        $config = array(
        array('field' => 'name','label' => 'Name','rules' => 'required'),
        array('field' => 'address','label' => 'Address','rules' => 'required'),
        array('field' => 'phone_number','label' => 'Phone Number','rules' => 'required'),
        array('field' => 'email','label' => 'Email','rules' => 'required'),
        array('field' => 'country','label' => 'Country','rules' => 'required'),
        array('field' => 'state','label' => 'State','rules' => 'required'),
        array('field' => 'district','label' => 'District','rules' => 'required'),
        array('field' => 'city','label' => 'City','rules' => 'required'),
        array('field' => 'md_name','label' => 'MD Name','rules' => 'required'),
        array('field' => 'md_phone','label' => 'MD Phone','rules' => 'required|valid_email'),
        array('field' => 'status','label' => 'Status','rules' => 'required'),
        );
        $this->form_validation->set_rules($config);
         if ($this->form_validation->run() == TRUE)
                {
                        $this->crud_model->save_hospital_info();
            $this->session->set_flashdata('message', get_phrase('hospital_info_saved_successfuly'));
            redirect(base_url() . 'index.php?superadmin/hospital');
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
            redirect(base_url() . 'index.php?superadmin/hospital');
                }
         }
         $data['hospital_id'] = $hospital_id;
        $data['page_name'] = 'edit_hospital';
        $data['page_title'] = get_phrase('edit_hospital');
       
        $this->load->view('backend/index', $data);
        }
    function hospital($task = "", $hospital_id = "") {
       /* if ($this->session->userdata('superadmin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }*/
        
        /*if ($task == "create") {
            $this->crud_model->save_hospital_info();
            $this->session->set_flashdata('message', get_phrase('hospital_info_saved_successfuly'));
            redirect(base_url() . 'index.php?superadmin/hospital');
        }*/
       
        /*if ($task == "update") {
            $this->crud_model->update_hospital_info($hospital_id);
            $this->session->set_flashdata('message', get_phrase('hospital_info_updated_successfuly'));
            redirect(base_url() . 'index.php?superadmin/hospital');
        }*/

        if ($task == "delete") {
            $this->crud_model->delete_hospital_info($hospital_id);
            $this->session->set_flashdata('message', get_phrase('hospital_info_deleted_successfuly'));
            redirect(base_url() . 'index.php?superadmin/hospital');
        }
        if ($task == "delete_multiple") {
            print_r($_POST);die;
           $this->crud_model->delete_multiple_hospital_info();
            $this->session->set_flashdata('message', get_phrase('hospitals_info_deleted_successfuly'));
            redirect(base_url() . 'index.php?superadmin/hospital');
        }
        $data['hospital_info'] = $this->crud_model->select_hospital_info();
        $data['page_name'] = 'manage_hospital';
        $data['page_title'] = get_phrase('hospitals');
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
            redirect(base_url() . 'index.php?superadmin/hospital_admins');
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
        
        $data['admin_id'] = $id;
        $data['page_name'] = 'edit_hospital_admin';
        $data['page_title'] = get_phrase('edit_hospital_admins');
       
        $this->load->view('backend/index', $data);
        }
    function hospital_admins($task = "", $admin_id = "") {
        
       /* if ($this->session->userdata('superadmin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        
        if ($task == "create") {
            
           $email = $this->input->post('email');
           
           $validation = email_validation($email);
           
            if ($validation == 1) {
                $this->crud_model->save_hospitaladmins_info();
                $this->session->set_flashdata('message', get_phrase('admin_info_saved_successfuly'));
            } else {
                $this->session->set_flashdata('message', get_phrase('duplicate_email'));
            }
           
            redirect(base_url() . 'index.php?superadmin/hospital_admins');
        }*/
   
        if ($task == "update") {
            $email  = $this->input->post('email');

            $validation = email_validation_for_edit($email, $admin_id, 'admin');
            if($validation == 1)
			{
              $this->crud_model->update_hospitaladmins_info($admin_id);
            $this->session->set_flashdata('message', get_phrase('admin_info_updated_successfuly'));
            }
            else
			{
                $this->session->set_flashdata('error_message' , 'duplicate_email');
            }
            
            redirect(base_url() . 'index.php?superadmin/hospital_admins');
        }

        if ($task == "delete") {
            $this->crud_model->delete_hospitaladmins_info($admin_id);
            $this->session->set_flashdata('message', get_phrase('admin_info_deleted_successfuly'));
            redirect(base_url() . 'index.php?superadmin/hospital_admins');
        }

        $data['admin_info'] = $this->crud_model->select_hospitaladmins_info();
        
        $data['page_name'] = 'manage_admins';
        $data['page_title'] = get_phrase('hospital_admins');
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
        
        if ($this->session->userdata('superadmin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
       
        if ($task == "create") {
            $hospital=$this->input->post('hospital');
            $this->crud_model->save_branch_info();
            $this->session->set_flashdata('message', get_phrase('branch_info_saved_successfuly'));
            redirect(base_url() . 'index.php?superadmin/get_hospital_branch/'.$hospital);
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
            redirect(base_url() . 'index.php?superadmin/branch');
        }

        if ($task == "delete") {
            $this->crud_model->delete_branch_info($branch_id);
            redirect(base_url() . 'index.php?superadmin/branch');
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
        if ($this->session->userdata('superadmin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $branch=$this->input->post('branch');
            $this->crud_model->save_department_info();
            $this->session->set_flashdata('message', get_phrase('department_info_saved_successfuly'));
            redirect(base_url() . 'index.php?superadmin/get_hospital_department/'.$branch);
        }

        if ($task == "update") {
            $this->crud_model->update_department_info($department_id);
            $this->session->set_flashdata('message', get_phrase('department_info_updated_successfuly'));
            redirect(base_url() . 'index.php?superadmin/department');
        }

        if ($task == "delete") {
            $this->crud_model->delete_department_info($department_id);
            redirect(base_url() . 'index.php?superadmin/department');
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
            redirect(base_url() . 'index.php?superadmin/get_hospital_ward/'.$department);
        }

        if ($task == "update") {
            $this->crud_model->update_ward_info($ward_id);
            $this->session->set_flashdata('message', get_phrase('ward_info_updated_successfuly'));
            redirect(base_url() . 'index.php?superadmin/ward');
        }

        if ($task == "delete") {
            $this->crud_model->delete_ward_info($ward_id);
            redirect(base_url() . 'index.php?superadmin/ward');
        }

        $data['ward_info'] = $this->crud_model->select_ward_info();
        $data['page_name'] = 'manage_ward';
        $data['page_title'] = get_phrase('ward');
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
            $this->email_model->account_opening_email('doctors','doctor', $email,$pwd);
            redirect(base_url() . 'index.php?superadmin/doctor');
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
            redirect(base_url() . 'index.php?superadmin/doctor');
        }else{
            $this->session->set_flashdata('message', get_phrase('duplicate_phone_number'));
        }
            }else {
                $this->session->set_flashdata('message', get_phrase('duplicate_email'));
            }
        }
        }
     /*      if ($task == "update") {
                $email  = $this->input->post('email');

            $validation = email_validation_for_edit($email, $doctor_id, 'doctor');
            if($validation == 1)
            {
               $this->crud_model->update_doctor_info($doctor_id);
               $this->session->set_flashdata('message', get_phrase('doctor_info_updated_successfuly'));
            }
            else
            {
                $this->session->set_flashdata('error_message' , 'duplicate_email');
            }
               
            
                redirect(base_url() . 'index.php?superadmin/doctor');
        }*/
        $data['doctor_id']=$id;
        $data['page_name'] = 'edit_doctor';
        $data['page_title'] = get_phrase('edit_doctor');
        $this->load->view('backend/index', $data);
        
        
    }
    function doctor($task = "", $doctor_id = "") {
        /* if ($this->session->userdata('superadmin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

       if ($task == "create") {
               $email = $this->input->post('email');
           
           $validation = email_validation($email);
           
            if ($validation == 1) {
                $this->crud_model->save_doctor_info();
                $this->session->set_flashdata('message', get_phrase('doctor_info_saved_successfuly'));
            } else {
                $this->session->set_flashdata('message', get_phrase('duplicate_email'));
            }
            redirect(base_url() . 'index.php?superadmin/doctor');
        }*/

     /*   if ($task == "update") {
                $email  = $this->input->post('email');

            $validation = email_validation_for_edit($email, $doctor_id, 'doctor');
            if($validation == 1)
			{
               $this->crud_model->update_doctor_info($doctor_id);
               $this->session->set_flashdata('message', get_phrase('doctor_info_updated_successfuly'));
            }
            else
			{
                $this->session->set_flashdata('error_message' , 'duplicate_email');
            }
               
            
                redirect(base_url() . 'index.php?superadmin/doctor');
        }*/

        if ($task == "delete") {
            $this->crud_model->delete_doctor_info($doctor_id);
            redirect(base_url() . 'index.php?superadmin/doctor');
        }
        $data['doctor_info'] = $this->crud_model->select_doctor_info();
        $data['page_name'] = 'manage_doctor';
        $data['page_title'] = get_phrase('doctors');
        $this->load->view('backend/index', $data);
    }
    

    function doctor_availability($task = "",$id='')
    {
        if ($this->session->userdata('superadmin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($task == "update") {
                $this->crud_model->update_doctor_availability_info($id);
                $this->session->set_flashdata('message', get_phrase('doctor_availability_info_saved_successfuly'));
            redirect(base_url() . 'index.php?superadmin/doctor_availability/'.$id);
        }
   
        $data['doctor_id']=$task;
        $data['page_name'] = 'add_availability';
        $data['page_title'] = get_phrase('add_availability');
        $this->load->view('backend/index', $data);
    }
    function doctor_new_availability($task = "",$id='')
    {
     if ($this->session->userdata('superadmin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        } 
        if ($task == "new_availability") {
            
                $this->crud_model->update_doctor_new_availability_info($id);
                $this->session->set_flashdata('message', get_phrase('doctor_availability_info_saved_successfuly'));
            redirect(base_url() . 'index.php?superadmin/doctor_availability/'.$id);
        }
        $data['doctor_id']=$task;
        $data['page_name'] = 'add_dcoavailability';
        $data['page_title'] = get_phrase('add_availability');
        $this->load->view('backend/index', $data);
    }
    function edit_doctor_new_availability($task = "",$id='',$id1='')
    {
      if ($this->session->userdata('superadmin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($task == "update_availability") {
            
                $this->crud_model->update_doc_availability_info($id1);
                $this->session->set_flashdata('message', get_phrase('doctor_availability_updated_successfuly'));
            redirect(base_url() . 'index.php?superadmin/doctor_availability/'.$id);
        }
        if ($task == "delete") {
            
                $this->crud_model->delete_doc_availability_info($id1);
                $this->session->set_flashdata('message', get_phrase('doctor_availability_deleted_successfuly'));
            redirect(base_url() . 'index.php?superadmin/doctor_availability/'.$id);
        }
        if ($task == "delete_all") {
            
                $this->crud_model->delete_all_doc_availability_info($id1);
                $this->session->set_flashdata('message', get_phrase('doctor_availability_deleted_successfuly'));
            redirect(base_url() . 'index.php?superadmin/doctor_availability/'.$id);
        }
        $data['slat_id']=$id;
        $data['page_name'] = 'edit_dcoavailability';
        $data['page_title'] = get_phrase('edit_availability');
        $this->load->view('backend/index', $data);
    }

     
    function add_user($task = "", $patient_id = "") {
       
        $data['page_name'] = 'add_user';
        $data['page_title'] = get_phrase('add_mypulse_users');
        $this->load->view('backend/index', $data);
    }

    function users($task = "", $patient_id = "") {
        
        if ($task == "create") {
                 $email = $this->input->post('email');
           
           $validation = email_validation($email);
           
            if ($validation == 1) {
                $this->crud_model->save_patient_info();
                $this->session->set_flashdata('message', get_phrase('inpatient_info_saved_successfuly'));
            } else {
                $this->session->set_flashdata('message', get_phrase('duplicate_email'));
            }
   
            redirect(base_url() . 'index.php?superadmin/patient');
        }
            

        if ($task == "update") {
                $this->crud_model->update_patient_info($patient_id);
                $this->session->set_flashdata('message', get_phrase('inpatient_info_updated_successfuly'));
                redirect(base_url() . 'index.php?superadmin/patient');
        }

        if ($task == "delete") {
            $this->crud_model->delete_patient_info($patient_id);
            redirect(base_url() . 'index.php?superadmin/patient');
        }
        if ($task == "dj_report") {
             $this->crud_model->select_prescription_info_by_patient($patient_id);
             redirect(base_url() . 'index.php?superadmin/patient');
        }
        $patient='inpatient';
        $data['patient_info'] = $this->crud_model->select_patient_info();
        $data['page_name'] = 'manage_users';
        $data['page_title'] = get_phrase('myPulse_users');
        $this->load->view('backend/index', $data);
    }
    
    
    function add_stores()
    {
        if($this->input->post()){

            $email = $this->input->post('email');
            $pwd="stores";
           $validation = email_validation($email);
           
            if ($validation == 1) {
                $this->crud_model->save_medicalstores_info();
        $this->session->set_flashdata('message', get_phrase('medical_stores_info_saved_successfuly'));
                $this->email_model->account_opening_email('medicalstores','store', $email,$pwd);
                redirect(base_url() . 'index.php?superadmin/medical_stores');
            } else {
                $this->session->set_flashdata('message', get_phrase('duplicate_email'));
            }
            
       
       }
      
        $data['page_name'] = 'add_stores';
        $data['page_title'] = get_phrase('Add medical store');
        $this->load->view('backend/index', $data);
        
    }
    
   /*  function add_()
    {
       // $data['hos_info'] = $this->crud_model->select_hos_info($patient);
        // $data['branch_info'] = $this->crud_model->select_branch_info($patient);
        $data['page_name'] = 'add_stores';
        $data['page_title'] = get_phrase('Add medical store');
        $this->load->view('backend/index', $data);
        
    }*/
     function add_labs()
    {
         if($this->input->post()){

            $email = $this->input->post('email');
            $pwd="stores";
           $validation = email_validation($email);
           
            if ($validation == 1) {
                 $this->crud_model->save_medicallabs_info();
                $this->session->set_flashdata('message', get_phrase('medical_lab_info_saved_successfuly'));
                $this->email_model->account_opening_email('medicallabs','lab', $email,$pwd);
                redirect(base_url() . 'index.php?superadmin/medical_labs');
            } else {
                $this->session->set_flashdata('message', get_phrase('duplicate_email'));
            }
       }
        $data['page_name'] = 'add_labs';
        $data['page_title'] = get_phrase('Add medical labs');
        $this->load->view('backend/index', $data);
        
    }
    
     function add_nurse()
    {

       if($this->input->post()){

            $email = $this->input->post('email');
            $pwd="nurse";
           $validation = email_validation($email);
           
            if ($validation == 1) {
                $this->crud_model->save_nurse_info();
                $this->session->set_flashdata('message', get_phrase('nurse_info_saved_successfuly'));
                $this->email_model->account_opening_email('nurse','nurse', $email,$pwd);
                redirect(base_url() . 'index.php?superadmin/nurse');
            } else {
                $this->session->set_flashdata('message', get_phrase('duplicate_email'));
            }
            
       
       }
        $data['page_name'] = 'add_nurse';
        $data['page_title'] = get_phrase('Add nurse');
        $this->load->view('backend/index', $data);
        
    }
    
     function edit_stores($id)
    {
        if ($this->session->userdata('superadmin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
       // $data['hos_info'] = $this->crud_model->select_hos_info($patient);
        // $data['branch_info'] = $this->crud_model->select_branch_info($patient);
        $data['id']=$id;
        $data['page_name'] = 'edit_stores';
        $data['page_title'] = get_phrase('Edit medical store');
        $this->load->view('backend/index', $data);
        
    }
    
     function edit_labs($id)
    {
        if ($this->session->userdata('superadmin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
       // $data['hos_info'] = $this->crud_model->select_hos_info($patient);
        // $data['branch_info'] = $this->crud_model->select_branch_info($patient);
        $data['id']=$id;
        $data['page_name'] = 'edit_labs';
        $data['page_title'] = get_phrase('Edit medical labs');
        $this->load->view('backend/index', $data);
        
    }
    
    
    
     function medical_labs($task = "", $patient_id = "") {
        if ($this->session->userdata('superadmin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        /*if ($task == "create") {
            
           
                $this->crud_model->save_medicallabs_info();
                $this->session->set_flashdata('message', get_phrase('medical_lab_info_saved_successfuly'));
           
            redirect(base_url() . 'index.php?superadmin/medical_labs');
        }*/
            

        if ($task == "update") {
                $this->crud_model->update_medicallabs_info($patient_id);
                $this->session->set_flashdata('message', get_phrase('medical_lab__info_updated_successfuly'));
                redirect(base_url() . 'index.php?superadmin/medical_labs');
        }

        if ($task == "delete") {
            $this->crud_model->delete_lab_info($patient_id);
            redirect(base_url() . 'index.php?superadmin/medical_labs');
        }
       
      
        $data['lab_info'] = $this->crud_model->select_lab_info($patient);
        $data['page_name'] = 'manage_labs';
        $data['page_title'] = get_phrase('Medical labs');
        $this->load->view('backend/index', $data);
    }
    
    
    
    
    function medical_stores($task = "", $patient_id = "") {
        if ($this->session->userdata('superadmin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        /*if ($task == "create") {
            
           
                $this->crud_model->save_medicalstores_info();
                $this->session->set_flashdata('message', get_phrase('medical_stores_info_saved_successfuly'));
           
            redirect(base_url() . 'index.php?superadmin/medical_stores');
        }*/
            

        if ($task == "update") {
                $this->crud_model->update_medicalstores_info($patient_id);
                $this->session->set_flashdata('message', get_phrase('medical_store__info_updated_successfuly'));
                redirect(base_url() . 'index.php?superadmin/medical_stores');
        }

        if ($task == "delete") {
            $this->crud_model->delete_store_info($patient_id);
            redirect(base_url() . 'index.php?superadmin/medical_stores');
        }
       
      
        $data['store_info'] = $this->crud_model->select_store_info($patient);
        $data['page_name'] = 'manage_stores';
        $data['page_title'] = get_phrase('Medical stores');
        $this->load->view('backend/index', $data);
    }
    
     function add_bed($ward_id='',$task = "", $id = "") {
        if ($this->session->userdata('superadmin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $data['ward_id']=$ward_id;
         $data['page_name'] = 'add_bed';
        $data['page_title'] = get_phrase('add_bed');
        $this->load->view('backend/index', $data);
    }
    function edit_bed($task = "", $id = "") {
        if ($this->session->userdata('superadmin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        
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
           
            redirect(base_url() . 'index.php?superadmin/get_hospital_bed/'.$ward);
        }
            

        if ($task == "update") {
                $this->crud_model->update_beds_info($id);
                $this->session->set_flashdata('message', get_phrase('beds_info_updated_successfuly'));
                redirect(base_url() . 'index.php?superadmin/bed');
        }

        if ($task == "delete") {
            $this->crud_model->delete_beds_info($id);
            redirect(base_url() . 'index.php?superadmin/bed');
        }

        $data['bed_info'] = $this->crud_model->select_beds_info();
        $data['page_name'] = 'manage_bed';
        $data['page_title'] = get_phrase('beds');
        $this->load->view('backend/index', $data);
    }
    
    function nurse($task = "", $nurse_id = "") {
        /*if ($this->session->userdata('superadmin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $email = $this->input->post('email');
           
           $validation = email_validation($email);
           
            if ($validation == 1) {
                $this->crud_model->save_nurse_info();
                $this->session->set_flashdata('message', get_phrase('nurse_info_saved_successfuly'));
            } else {
                $this->session->set_flashdata('message', get_phrase('duplicate_email'));
            }
            redirect(base_url() . 'index.php?superadmin/nurse');
        }*/

        if ($task == "update") {
                $this->crud_model->update_nurse_info($nurse_id);
                $this->session->set_flashdata('message', get_phrase('nurse_info_updated_successfuly'));
                redirect(base_url() . 'index.php?superadmin/nurse');
        }

        if ($task == "delete") {
            $this->crud_model->delete_nurse_info($nurse_id);
            redirect(base_url() . 'index.php?superadmin/nurse');
        }

        $data['nurse_info'] = $this->crud_model->select_nurse_info();
        $data['page_name'] = 'manage_nurse';
        $data['page_title'] = get_phrase('nurses');
        $this->load->view('backend/index', $data);
    }

 

   
    function add_receptionist($task = "", $receptionist_id = "") {

       if($this->input->post()){

            $email = $this->input->post('email');
           $pwd="receptionist";
           $validation = email_validation($email);
           
            if ($validation == 1) {
                 $this->crud_model->save_receptionist_info();
                $this->session->set_flashdata('message', get_phrase('receptionist_info_saved_successfuly'));
                $this->email_model->account_opening_email('receptionist','receptionist', $email,$pwd);
                redirect(base_url() . 'index.php?superadmin/receptionist');
            } else {
                $this->session->set_flashdata('message', get_phrase('duplicate_email'));
            }
            
       
       }
      
        $data['page_name'] = 'add_receptionist';
        $data['page_title'] = get_phrase('add_receptionist');
        $this->load->view('backend/index', $data);
        
    }
    function receptionist($task = "", $receptionist_id = "") {
        /*if ($this->session->userdata('superadmin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $email = $_POST['email'];
            $receptionist = $this->db->get_where('receptionist', array('email' => $email))->row()->name;
            if ($receptionist == null) {
                $this->crud_model->save_receptionist_info();
                $this->session->set_flashdata('message', get_phrase('receptionist_info_saved_successfuly'));
            } else {
                $this->session->set_flashdata('message', get_phrase('duplicate_email'));
            }
            redirect(base_url() . 'index.php?superadmin/receptionist');
        }*/

        if ($task == "update") {
                $this->crud_model->update_receptionist_info($receptionist_id);
                $this->session->set_flashdata('message', get_phrase('receptionist_info_updated_successfuly'));
                redirect(base_url() . 'index.php?superadmin/receptionist');
        }

        if ($task == "delete") {
            $this->crud_model->delete_receptionist_info($receptionist_id);
            redirect(base_url() . 'index.php?superadmin/receptionist');
        }

        $data['receptionist_info'] = $this->crud_model->select_receptionist_info();
        $data['page_name'] = 'manage_receptionist';
        $data['page_title'] = get_phrase('receptionists');
        $this->load->view('backend/index', $data);
    }


    function notice($task = "", $notice_id = "") {
        if ($this->session->userdata('superadmin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $this->crud_model->save_notice_info();
            $this->session->set_flashdata('message', get_phrase('notice_info_saved_successfuly'));
            redirect(base_url() . 'index.php?superadmin/notice');
        }

        if ($task == "update") {
            $this->crud_model->update_notice_info($notice_id);
            $this->session->set_flashdata('message', get_phrase('notice_info_updated_successfuly'));
            redirect(base_url() . 'index.php?superadmin/notice');
        }

        if ($task == "delete") {
            $this->crud_model->delete_notice_info($notice_id);
            redirect(base_url() . 'index.php?superadmin/notice');
        }

        $data['notice_info'] = $this->crud_model->select_notice_info();
        $data['page_name'] = 'manage_notice';
        $data['page_title'] = get_phrase('noticeboard');
        $this->load->view('backend/index', $data);
    }

 

}
