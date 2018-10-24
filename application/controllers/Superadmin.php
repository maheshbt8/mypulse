<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Superadmin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();   
        $this->load->library('session');
        date_default_timezone_set('Asia/Kolkata');    
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
    function dashboard() {
        $page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('superadmin_dashboard');
        $this->load->view('backend/index', $page_data);
    }

    /********************MESSAGE********************/
        /* private messaging */
    function new_message($param1 = '', $param2 = '', $param3 = '') {
       
        if($this->input->post()){
           $this->crud_model->save_new_message();
            $this->session->set_flashdata('message', get_phrase('message_sent_successfuly'));
            redirect(base_url() . 'index.php?superadmin/message/', 'refresh');
        }
        $page_data['page_name'] = 'new_message';
        $page_data['page_title'] = get_phrase('messages');
        $this->load->view('backend/index', $page_data);
    }
    function read_message($param1 = '', $param2 = '', $param3 = '') 
    {
        $page_data['messagedata']=$this->crud_model->read_message($param1);
        /*print_r($page_data);die;*/
        /*$page_data['message_type']=$param1;*/
        $page_data['message_id']=$param1;
        $page_data['page_name'] = 'message_read';
        $page_data['page_title'] = get_phrase('messages');
        $this->load->view('backend/index', $page_data);
    }
    /*function read_message($param1 = '', $param2 = '', $param3 = '') 
    {
        $page_data['message_data']=$this->crud_model->read_message($param1,$param2);
        $page_data['message_type']=$param1;
        $page_data['message_id']=$param2;
        $page_data['page_name'] = 'message_read';
        $page_data['page_title'] = get_phrase('messages');
        $this->load->view('backend/index', $page_data);
    }*/
    function message($param1 = '', $param2 = '', $param3 = '') {
       
        $page_data['message_data']=$this->crud_model->select_message();
        $page_data['private_message_data']=$this->crud_model->select_private_message();
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

   /* function message($param1 = 'message_home', $param2 = '', $param3 = '') {
        $max_size = 2097152;
        if ($param1 == 'send_new') {
            if (!file_exists('uploads/private_messaging_attached_file/')) {
              $oldmask = umask(0);  // helpful when used in linux server
              mkdir ('uploads/private_messaging_attached_file/', 0777);
            }
            if ($_FILES['attached_file_on_messaging']['name'] != "") {
              if($_FILES['attached_file_on_messaging']['size'] > $max_size){
                $this->session->set_flashdata('error_message' , 'File_size_can_not_be_larger_that_2_Megabyte');
                redirect(base_url() . 'index.php?superadmin/message/message_new/', 'refresh');
              }
              else{
                $file_path = 'uploads/private_messaging_attached_file/'.$_FILES['attached_file_on_messaging']['name'];
                move_uploaded_file($_FILES['attached_file_on_messaging']['tmp_name'], $file_path);
              }
            }

            $message_thread_code = $this->crud_model->send_new_private_message();
            $this->session->set_flashdata('flash_message', 'Message_sent!');
            redirect(base_url() . 'index.php?superadmin/message/message_read/' . $message_thread_code, 'refresh');
        }

        if ($param1 == 'send_reply') {

            if (!file_exists('uploads/private_messaging_attached_file/')) {
              $oldmask = umask(0);  // helpful when used in linux server
              mkdir ('uploads/private_messaging_attached_file/', 0777);
            }
            if ($_FILES['attached_file_on_messaging']['name'] != "") {
              if($_FILES['attached_file_on_messaging']['size'] > $max_size){
                $this->session->set_flashdata('error_message' , 'File_size_can_not_be_larger_that_2_Megabyte');
                redirect(base_url() . 'index.php?superadmin/message/message_read/' . $param2, 'refresh');
              }
              else{
                $file_path = 'uploads/private_messaging_attached_file/'.$_FILES['attached_file_on_messaging']['name'];
                move_uploaded_file($_FILES['attached_file_on_messaging']['tmp_name'], $file_path);
              }
            }

            $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
            $this->session->set_flashdata('flash_message', 'Message_sent!');
            redirect(base_url() . 'index.php?superadmin/message/message_read/' . $param2, 'refresh');
        }

        if ($param1 == 'message_read') {
            $page_data['current_message_thread_code'] = $param2;  // $param2 = message_thread_code
            $this->crud_model->mark_thread_messages_read($param2);
        }

        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'message';
        $page_data['page_title']                = 'Private_messaging';
        $this->load->view('backend/index', $page_data);
    }

    function group_message($param1 = "group_message_home", $param2 = ""){
      $max_size = 2097152;
      if ($param1 == "create_group") {
        $this->crud_model->create_group();
      }
      elseif ($param1 == "edit_group") {
        $this->crud_model->update_group($param2);
      }
      elseif ($param1 == 'group_message_read') {
        $page_data['current_message_thread_code'] = $param2;
      }
      else if($param1 == 'send_reply'){
        if (!file_exists('uploads/group_messaging_attached_file/')) {
          $oldmask = umask(0);  // helpful when used in linux server
          mkdir ('uploads/group_messaging_attached_file/', 0777);
        }
        if ($_FILES['attached_file_on_messaging']['name'] != "") {
          if($_FILES['attached_file_on_messaging']['size'] > $max_size){
            $this->session->set_flashdata('error_message' , 'File_size_can_not_be_larger_that_2_Megabyte');
            redirect(base_url() . 'index.php/superadmin/group_message/group_message_read/' . $param2, 'refresh');
          }
          else{
            $file_path = 'uploads/group_messaging_attached_file/'.$_FILES['attached_file_on_messaging']['name'];
            move_uploaded_file($_FILES['attached_file_on_messaging']['tmp_name'], $file_path);
          }
        }

        $this->crud_model->send_reply_group_message($param2);  //$param2 = message_thread_code
        $this->session->set_flashdata('flash_message', 'Message_sent!');
        redirect(base_url() . 'index.php?superadmin/group_message/group_message_read/' . $param2, 'refresh');
      }
      $page_data['message_inner_page_name']   = $param1;
      $page_data['page_name']                 = 'group_message';
      $page_data['page_title']                = 'Group_messaging';
      $this->load->view('backend/index', $page_data);
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

    function manage_profile($param1 = '', $param2 = '', $param3 = '') {
      

        if ($param1 == 'update_profile_info') {
            $data['name'] = $this->input->post('name');
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
            redirect(base_url() . 'index.php?superadmin/manage_profile');
        }
        if ($param1 == 'change_password') {
            $current_password_input = sha1($this->input->post('password'));
            $new_password = sha1($this->input->post('new_password'));
            $confirm_new_password = sha1($this->input->post('confirm_new_password'));

            $current_password_db = $this->db->get_where('superadmin', array('superadmin_id' =>
                        $this->session->userdata('login_user_id')))->row()->password;

            if ($current_password_db == $current_password_input && $new_password == $confirm_new_password) {
                $this->db->where('superadmin_id', $this->session->userdata('login_user_id'));
                $this->db->update('superadmin', array('password' => $new_password));

                $this->session->set_flashdata('message', get_phrase('password_info_updated_successfuly'));
                redirect(base_url() . 'index.php?superadmin/manage_profile');
            } else {
                $this->session->set_flashdata('message', get_phrase('password_update_failed'));
                redirect(base_url() . 'index.php?superadmin/manage_profile');
            }
        }
        $page_data['page_name'] = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data'] = $this->db->get_where('superadmin', array('superadmin_id' => $this->session->userdata('login_user_id')))->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    function manage_password($param1 = '', $param2 = '', $param3 = '') {
        if ($param1 == 'change_password') {
            $current_password_input = sha1($this->input->post('password'));
            $new_password = sha1($this->input->post('new_password'));
            $confirm_new_password = sha1($this->input->post('confirm_new_password'));

            $current_password_db = $this->db->get_where('superadmin', array('superadmin_id' =>
                        $this->session->userdata('login_user_id')))->row()->password;

            if ($current_password_db == $current_password_input && $new_password == $confirm_new_password) {
                $this->db->where('superadmin_id', $this->session->userdata('login_user_id'));
                $this->db->update('superadmin', array('password' => $new_password));

                $this->session->set_flashdata('message', get_phrase('password_info_updated_successfuly'));
                redirect(base_url() . 'index.php?superadmin/manage_password');
            } else {
                $this->session->set_flashdata('message', get_phrase('password_update_failed'));
                redirect(base_url() . 'index.php?superadmin/manage_password');
            }
        }
        $page_data['page_name'] = 'manage_password';
        $page_data['page_title'] = get_phrase('manage_password');
        $page_data['edit_data'] = $this->db->get_where('superadmin', array('superadmin_id' => $this->session->userdata('login_user_id')))->result_array();
        $this->load->view('backend/index', $page_data);
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
            redirect(base_url() . 'index.php?superadmin/language');
        }
        if ($param1 == "delete") {
            $this->crud_model->delete_language($param2);
            redirect(base_url() . 'index.php?superadmin/language');
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
            redirect(base_url() . 'index.php?superadmin/specialization');
        }
        if ($param1 == "delete") {
            $this->crud_model->delete_specialization($param2);
            redirect(base_url() . 'index.php?superadmin/specialization');
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
         if ($param1 == "update") {
            
            $this->crud_model->update_city_info($param2);
            $this->session->set_flashdata('message', get_phrase('city_info_updated_successfuly'));
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
        if ($param1 == "update") {
            $this->crud_model->update_license_info($param2);
            $this->session->set_flashdata('message', get_phrase('license_info_updated_successfuly'));
            redirect(base_url() . 'index.php?superadmin/license');
        }
        if ($task == "delete") {
            $this->crud_model->delete_license($param2);
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
        if ($task == "delete") {
            $this->crud_model->delete_health_insurance_provider($param2);
            redirect(base_url() . 'index.php?superadmin/health_insurance_provider');
        }
        $page_data['page_name'] = 'health_insurance_provider';
        $page_data['page_title'] = get_phrase('health_insurance_provider');
        $page_data['health_insurance_provider'] = $this->db->get('health_insurance_provider')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    /******GET STATES****/
    /*function get_email()
    {
        $email=$_POST['email'];
        $validation = email_validation($email);
        if($validation == 0){
        echo '<span style="color:red"> This Email Already Existed </span>';    
        }
    }
     function get_phone()
    {
        $phone=$_POST['phone'];
        $validation = mobile_validation($phone);
        if($validation == 0){
        echo '<span style="color:red"> This Phone Number Already Existed </span>';    
        }
    }*/
    function get_state($country_id)
    {
        $state = $this->db->get_where('state' , array(
            'country_id' => $country_id))->result_array();
        echo '<option value=""> Select State </option>';
        foreach ($state as $row2) {
            echo '<option value="' . $row2['state_id'] . '">' . $row2['name'] . '</option>';
        }
    }
    
    
     function get_city($district_id)
    {
        $state = $this->db->get_where('city' , array(
            'district_id' => $district_id))->result_array();
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
      function get_department_all($branch_id)
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
     function get_user_data()   
    {
    $user_value=$_POST['user'];
        $where = "email='".$user_value."' OR phone='".$user_value."' OR unique_id='".$user_value."'";
        $qry=$this->db->where($where)->get('users');
        $users=$qry->row_array();
        if($qry->num_rows()>0){
        echo '<input type="text" name="user" class="form-control"  autocomplete="off" id="user" list="users" placeholder="e.g. Enter User Email, Mobile Number or User ID" data-validate="required" data-message-required="Value Required" value="'.$users['name'].' '.$users['lname'].'" onchange="return get_user_data(this.value)">';
        echo '<input type="hidden" name="user_id" value="'.$users['user_id'].'">';
        }else{
            echo '<input type="text" name="user" class="form-control"  autocomplete="off" id="user" list="users" placeholder="e.g. Enter User Email, Mobile Number or User ID" data-validate="required" data-message-required="Value Required" value="" onchange="return get_user_data(this.value)"><span style="color:red;">No User Available</span>';
        }
    }
    function get_hospital_doctors($hospital_id='')   
    {

        $users=$this->db->where('hospital_id',$hospital_id)->get('doctors')->result_array();
        foreach ($users as $row) {
            $spee=explode(',',$row['specializations']);
            $spe='';
            for($i=0;$i<count($spee);$i++) {
             $spe=$this->db->where('specializations_id',$spee[$i])->get('specializations')->row()->name.','.$spe;   
            }
echo '<option value="'.$row['unique_id'].'">Dr. '.ucfirst($row['name']).'('.$this->db->where('hospital_id',$row['hospital_id'])->get('hospitals')->row()->name.','.$spe.')</option>';
 }
    }
    function get_specializations_doctors($id='')   
    {
        $users=$this->db->get('doctors')->result_array();
        foreach ($users as $row) {
            $spee=explode(',',$row['specializations']);
            if($id != 0){
            for($j=0;$j<count($spee);$j++) {
                if($id == $spee[$j])
                {
            $spe='';
            for($i=0;$i<count($spee);$i++) {
             $spe=$this->db->where('specializations_id',$spee[$i])->get('specializations')->row()->name.','.$spe;   
            }
echo '<option value="'.$row['unique_id'].'">Dr. '.ucfirst($row['name']).'('.$this->db->where('hospital_id',$row['hospital_id'])->get('hospitals')->row()->name.','.$spe.')</option>';
 } 
}
}
if($id == 0){
    $spe='';
            for($i=0;$i<count($spee);$i++) {
             $spe=$this->db->where('specializations_id',$spee[$i])->get('specializations')->row()->name.','.$spe;   
            }
echo '<option value="'.$row['unique_id'].'">Dr. '.ucfirst($row['name']).'('.$this->db->where('hospital_id',$row['hospital_id'])->get('hospitals')->row()->name.','.$spe.')</option>';
}
}
    }
    function get_city_doctors($id='')   
    {
        $users=$this->db->get('doctors')->result_array();
        foreach ($users as $row) {
            $spee=explode(',',$row['specializations']);
            if($id != 0){
            $city=$this->db->where('branch_id',$row['branch_id'])->get('branch')->row()->city;
                if($id == $city)
                {
            $spe='';
            for($i=0;$i<count($spee);$i++) {
             $spe=$this->db->where('specializations_id',$spee[$i])->get('specializations')->row()->name.','.$spe;   
            }
echo '<option value="'.$row['unique_id'].'">Dr. '.ucfirst($row['name']).'('.$this->db->where('hospital_id',$row['hospital_id'])->get('hospitals')->row()->name.','.$spe.')</option>';
 } 
}
if($id == 0){
    $spe='';
            for($i=0;$i<count($spee);$i++) {
             $spe=$this->db->where('specializations_id',$spee[$i])->get('specializations')->row()->name.','.$spe;   
            }
echo '<option value="'.$row['unique_id'].'">Dr. '.ucfirst($row['name']).'('.$this->db->where('hospital_id',$row['hospital_id'])->get('hospitals')->row()->name.','.$spe.')</option>';
}
}
    }
     function get_doctor($department_id='',$department_id1 = '')   
    {
        if($department_id == 'all'){
            $doctor = $this->db->get_where('doctors' , array(
            'branch_id' => $department_id1,'status'=>1
        ))->result_array();  
        foreach ($doctor as $row) {
            echo '<option value="' . $row['doctor_id'] . '">' . $row['name'] . '</option>';
        }
        }else{
        $doctor = $this->db->get_where('doctors' , array(
            'department_id' => $department_id,'status'=>1
        ))->result_array();
        foreach ($doctor as $row) {
            echo '<option value="' . $row['doctor_id'] . '">' . $row['name'] . '</option>';
        }
    }
    }
    
    function get_doctor_data($unique_id)
    {
        $doctor_data = $this->db->get_where('doctors' , array(
            'unique_id' => $unique_id))->row_array();
        $doctor_id=$doctor_data['doctor_id'];
        $doctor_unique_id=$doctor_data['unique_id'];
        $doctor_message=$this->db->where('doctor_id',$doctor_id)->get('availability')->row()->message;
        echo '<div class="form-group"><b><label for="field-ta" class="col-sm-2 control-label">'.get_phrase('doctor_availability').'</label></b><div class="col-sm-10"><label class="control-label">'.$doctor_message.'</label></div></div>';
        echo '<input type="hidden" value="'.$doctor_id.'" class="form-control" name="doctor_id" id="doctor_id">';
        echo '<input type="hidden" value="'.$doctor_unique_id.'" class="form-control" name="doctor_unique_id" id="doctor_unique_id">';
        
    }
     public function get_dco_date($doctor_id)
    {
     
    $date_val=$_POST['date_val'];
    
        $doctor_availability= $this->db->get_where('availability_slat' , array(
            'doctor_id' => $doctor_id,'date'=>$date_val,'status'=>1));
        $doctor_ava=$doctor_availability->result_array();
         $appointments=$this->db->get_where('appointments' , array('doctor_id' => $doctor_id,'appointment_date'=>$date_val))->num_rows();
         if($doctor_availability->num_rows()>0){
            echo '<option value=""> Select Slot </option>';
        foreach ($doctor_ava as $row) {
            $sdate=$row['start_time'];
            $edate=$row['end_time'];
            $count=((((strtotime($edate)-strtotime($sdate))/60)/60)*2);
            $start_time1=strtotime($sdate);
            for($i=1;$i<=$count;$i++){
                $start_time2=strtotime("+30 minutes", $start_time1);
                $appointments=$this->db->get_where('appointments' , array('doctor_id' => $doctor_id,'appointment_date'=>$date_val,'appointment_time_start'=>date('H:i',$start_time1),'appointment_time_end'=>date('H:i',$start_time2)))->num_rows();
        $no_appt_handle=$this->db->get_where('availability' , array('doctor_id' => $doctor_id))->row()->no_appt_handle;
         if($appointments >= $no_appt_handle){
           /* echo '<option value="'.date('h:i a',$start_time1) .' - '.date('h:i a', $start_time2).'" disabled>' . date('h:i a',$start_time1) .' - '.date('h:i a', $start_time2).'</option>';*/
        }else{
            echo '<option value="'.date('h:i a',$start_time1) .' - '.date('h:i a', $start_time2).'" >' . date('h:i a',$start_time1) .' - '.date('h:i a', $start_time2).'</option>';
        }
            
            $start_time1=$start_time2;
        }

        }
        }else{
        echo '<option value=""> No Slot Available In This Date </option>';
    }
    }
    public function resend_email_verification($task='',$type_id='',$id='')
    {
    $this->db->where('unique_id',$id)->update($task,array('modified_at'=>date('Y-m-d H:i:s')));
    $this->email_model->account_reverification_email($task,$type_id, $id);
        redirect($this->session->userdata('last_page'));
    }
    /**********SINGLE DATA GET WITH ID*************/
    public function get_hospital_history($hospital_id){
       /* $data['branch_info'] = $this->db->where('hospital_id',$hospital_id)->get('branch')->result_array();
        $data['branch_info'] = $this->db->where('hospital_id',$hospital_id)->get('branch')->result_array();*/
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
            redirect(base_url() . 'index.php?superadmin/hospital_admins');
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
            redirect(base_url() . 'index.php?superadmin/hospital_admins');
        }
        if ($task == "delete_multiple") {
           $this->crud_model->delete_multiple_hospital_admins_info();
            $this->session->set_flashdata('message', get_phrase('hospitaladmins_info_deleted_successfuly'));
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
            redirect(base_url() . 'index.php?superadmin/get_hospital_departments/'.$branch);
        }

        if ($task == "update") {
            $this->crud_model->update_department_info($department_id);
            $this->session->set_flashdata('message', get_phrase('department_info_updated_successfuly'));
            redirect($this->session->userdata('last_page'));
        }

        if ($task == "delete") {
            $this->crud_model->delete_department_info($department_id);
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
            redirect(base_url() . 'index.php?superadmin/get_hospital_ward/'.$department);
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
    function view_doctors($task = "", $id = "") {
       
        if ($task == "nurse") {
            $doctor=$this->db->where('nurse_id',$id)->get('nurse')->row();
        }
        if ($task == "receptionist") {
            $doctor=$this->db->where('receptionist_id',$id)->get('receptionist')->row();
            /*$doctor_id=explode(',', $doctor);
            for($i=0;$i<count($doctor_id);$i++){
            $doctor_data[]=$this->db->where('doctor_id',$doctor_id[$i])->get('doctors')->row();
            }*/
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
    /* if ($this->session->userdata('superadmin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        } */
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
     /* if ($this->session->userdata('superadmin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }*/
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
        $data['page_title'] = get_phrase('edit_myPulse_users');
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
        if ($task == "dj_report") {
             $this->crud_model->select_prescription_info_by_patient($patient_id);
             redirect(base_url() . 'index.php?superadmin/patient');
        }
        $data['patient_info'] = $this->crud_model->select_user_info();
        $data['page_name'] = 'manage_users';
        $data['page_title'] = get_phrase('myPulse_users');
        $this->load->view('backend/index', $data);
    }
       function unuser(){
           
           $this->crud_model->save_unuser_info();
            $this->session->set_flashdata('message', get_phrase('unregistered_user_info_saved_successfuly'));
           /* $this->email_model->account_opening_email('users','user', $email);*/
            redirect(base_url() . 'index.php?superadmin/add_appointment');
    }
    function inpatient($task = "", $patient_id = "") {
        $data['patient_info'] = $this->crud_model->select_inpatient_info();
        $data['page_name'] = 'manage_inpatient';
        $data['page_title'] = get_phrase('inpatients');
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
       
        $data['appointment_info'] = $this->crud_model->select_appointment_info();
        $data['page_name'] = 'manage_appointment';
        $data['page_title'] = get_phrase('manage_appointments');
        $this->load->view('backend/index', $data);
    }
    function report($report_id = "") {
        $data['report_id']=$report_id;
        $data['hospital_info'] = $this->crud_model->select_hospital_info();
        $data['page_name'] = 'manage_reports';
        if($report_id==1){
        $this->crud_model->getReport();
        $data['page_title'] = get_phrase('patient_reports');
        }elseif($report_id==2){
        $this->crud_model->getReport();
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
                redirect(base_url() . 'index.php?superadmin/nurse');
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
            redirect(base_url() . 'index.php?superadmin/nurse');
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
                redirect(base_url() . 'index.php?superadmin/medical_stores');
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
                redirect(base_url() . 'index.php?superadmin/medical_labs');
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
                redirect(base_url() . 'index.php?superadmin/medical_stores');
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
                redirect(base_url() . 'index.php?superadmin/medical_labs');
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
            redirect(base_url() . 'index.php?superadmin/medical_labs');
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
    
    
    
    
    function medical_stores($task = "", $patient_id = "") {
        if ($this->session->userdata('superadmin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

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

    /*function notice($task = "", $notice_id = "") {
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
    }*/

 

}
