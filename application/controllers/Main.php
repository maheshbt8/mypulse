<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Main extends CI_Controller {
    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');    
        error_reporting(0);  
$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

            if ($this->session->userdata('login') != 1) {
                $this->session->set_userdata('last_page', current_url());
                redirect(base_url('login'), 'refresh');
            }
    }

    public function index() {
        if ($this->session->userdata('login') != 1){ 
            redirect(base_url() . 'login', 'refresh');
        }
        if ($this->session->userdata('login') == 1){
            redirect(base_url() . 'Dashboard', 'refresh');
        }
    }
     function getAddress($latitude,$longitude){
    if(!empty($latitude) && !empty($longitude)){
        //Send request and receive json data by address
        /*$geocodeFromLatLong = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyAZ-5bkYW9Wb5k2JLBoaas0HSx7ZBkMwAM&latlng='.trim($latitude).','.trim($longitude).'&sensor=false');*/ 
        $geocodeFromLatLong = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.$latitude.','.$longitude.'&key=AIzaSyAZ-5bkYW9Wb5k2JLBoaas0HSx7ZBkMwAM');
        //print_r($geocodeFromLatLong);die;
        $output = json_decode($geocodeFromLatLong);
        $status = $output->status;
        //Get address from json data
        $address = ($status=="OK")?$output->results[1]->formatted_address:'';
        //Return address of the given latitude and longitudee
        echo $address;
        /*if(!empty($address)){
            return $address;
        }else{
            return false;
        }*/
    }else{
        echo "string";
        //return false;   
    }
    }
    public function dashboard() {
        $page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('dashboard');
        $this->load->view('backend/index', $page_data);
    }
    public function image_url($type,$id){
    if (file_exists('uploads/' . $type . '/' . $id . '.jpg')){
            $image_url ='uploads/' . $type . '/' . $id . '.jpg';
        }else{
            $image_url ='uploads/user.jpg';
        }
    $im = file_get_contents($image_url);
    header('content-type: image/png');
    echo $im;
    }
    public function hospital_logo_url($id){
    if (file_exists('uploads/hospitallogos/'.$id . '.png')){
            $image_url ='uploads/hospitallogos/'.$id. '.png';
        }
    $im = file_get_contents($image_url);
    header('content-type: image/png');
    echo $im;
    }
public function report_url($information){
    $account_type = $this->session->userdata('login_type');
    $data=explode('/',base64_decode($information));
    $year=$data[0];
    $unique_id=$data[1];
    $report=$data[2];
    $report_info=$this->crud_model->get_single_report_info($report);
    if($report_info['order_type']=='1'){
        $user_id=$report_info['user_id'];
    }elseif($report_info['order_type']=='0'){
        $user_id=$this->db->get_where('prescription_order',array('order_id'=>$report_info['order_id']))->row()->user_id;
    }
    $inpatient=$this->db->get_where('inpatient',array('user_id'=>$user_id,'inpatient_status'=>'1'));
    $appointment=$this->db->get_where('appointments',array('user_id'=>$user_id,'appointment_status'=>'2'));
if(($account_type=='users' && $this->session->userdata('login_user_id')==$user_id) || (($account_type=='doctors' && $report_info['row_status_cd']=='1') && (($inpatient->num_rows()>0 && $inpatient->row()->doctor_id==$this->session->userdata('login_user_id')) || ($appointment->num_rows()>0 && $appointment->row()->doctor_id==$this->session->userdata('login_user_id'))))){
    $datetime=date('YmdHis',strtotime($report_info['created_at']));
    $ext=$report_info['extension'];
if (file_exists('uploads/reports/' . $year . '/' . $unique_id.'/'. $report. '.'.$ext)){
    
    $image_url ='uploads/reports/' . $year . '/' . $unique_id.'/'. $report. '.'.$ext;
    if($ext!='pdf'){
        $content='image/'.$ext;
    }elseif($ext=='pdf'){
        $content='application/'.$ext;
    }
}else{
    redirect('four_zero_four');
}
}else{
    redirect('four_zero_four');   
}
    $im = file_get_contents($image_url);
    header('content-type: '.$content);
    echo $im;
    }
    public function report_download($information){
    $account_type = $this->session->userdata('login_type');
    $data=explode('/',base64_decode($information));
    $year=$data[0];
    $unique_id=$data[1];
    $report=$data[2];
    $report_info=$this->crud_model->get_single_report_info($report);
    $datetime=date('YmdHis',strtotime($report_info['created_at']));
    $ext=$report_info['extension'];
if(file_exists('uploads/reports/' . $year . '/' . $unique_id.'/'. $report . '.'.$ext)){
     $image_url ='uploads/reports/' . $year . '/' . $unique_id.'/'. $report . '.'.$ext;
     $file_name = 'Report'. $report .'_'.$datetime. '.'.$ext;
$this->load->helper('download');
$data = file_get_contents($image_url);
force_download($file_name, $data);
}
return TRUE;
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
        array('field' => 'license','label' => 'License','rules' => 'required'),
        array('field' => 'license_status','label' => 'License Status','rules' => 'required'),
        array('field' => 'from_date','label' => 'From Date','rules' => 'required'),
        array('field' => 'till_date','label' => 'To Date','rules' => 'required'),
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
            $account_type=$this->session->userdata('login_type');
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
        array('field' => 'license','label' => 'License','rules' => 'required'),
        array('field' => 'license_status','label' => 'License Status','rules' => 'required'),
        array('field' => 'from_date','label' => 'From Date','rules' => 'required'),
        array('field' => 'till_date','label' => 'To Date','rules' => 'required'),
        );
        $this->form_validation->set_rules($config);

         if ($this->form_validation->run() == TRUE){
         /*$hospital_id=$this->crud_model->generate_decryption_key($hospital_id); */
            $this->crud_model->update_hospital_info($hospital_id);
            $this->session->set_flashdata('message', get_phrase('hospital_info_updated_successfuly'));
            if($account_type!='hospitaladmins'){
            redirect('Hospitals/');
        }elseif($account_type=='hospitaladmins'){
            redirect('Hospital/'.$hospital_id);
        }//redirect($this->session->userdata('last_page'));
                }
         }else{
           redirect('Hospital/'.$hospital_id);
        }
        $data['hospital_id'] = $hospital_id;
        $data['page_name'] = 'hospital_history';
        $data['page_title'] = get_phrase('Hospital Details');
       
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
        if ($task == "delete_hospital") {
            $this->crud_model->delete_patient_hospital($hospital_id);
            $this->session->set_flashdata('message', get_phrase('hospital_deleted_successfuly'));
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
        $data['page_title'] = get_phrase('branch');
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
            redirect($this->session->userdata('last_page'));
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
    public function get_hospital_branch1($hospital_id='') {   
        $data['branch_info'] = $this->db->where('hospital_id',$hospital_id)->get('branch')->result_array();
        $data['hospital_id']=$hospital_id;
        /*$data['page_name'] = 'manage_branch';
        $data['page_title'] = get_phrase('branch');*/
        $this->load->view('backend/main/manage_branch', $data);
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
        $page_data['admins'] = $this->db->get_where('hospitals',array('row_status_cd'=>1))->result_array();
        $this->load->view('backend/index', $page_data);
        
    }
       public function edit_hospital_admins($id) {
        if($this->input->post())
        {
        $config = array(
        array('field' => 'fname','label' => 'First Name','rules' => 'required'),
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
           $phone_number = $this->input->post('mobile');
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
        }else{
           redirect($this->session->userdata('last_page')); 
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
        $data['admin_info'] = $this->crud_model->select_hospitaladmins_table_info();
        $data['page_name'] = 'manage_admins';
        $data['page_title'] = get_phrase('hospital_admins');
        $this->load->view('backend/index', $data);
    }
        function view_doctors($task = "", $id = "") {
        if ($task == "nurse") {
            $doctor=$this->db->select('doctor_id,name')->where('nurse_id',$id)->get('nurse')->row();
        }
        if ($task == "receptionist") {
            $doctor=$this->db->select('doctor_id,name')->where('receptionist_id',$id)->get('receptionist')->row();
        }
        if($doctor->doctor_id!=''){
        $doctor_id=explode(',', $doctor->doctor_id);
        for($i=0;$i<count($doctor_id);$i++){
        $doctor_data[]=$this->db->where('doctor_id',$doctor_id[$i])->get('doctors')->row_array();
        }
        }
        $data['doctor_info'] = $doctor_data;
        $data['task'] = $task;
        $data['page_name'] = 'manage_doctor';
        $data['page_title'] = get_phrase('Doctors - '.$doctor->name);
        $this->load->view('backend/index', $data);
    }
    function add_doctor()
    {
        if($this->input->post()){
        $config = array(
        array('field' => 'fname','label' => 'First Name','rules' => 'required'),
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
        $data['page_title'] = 'Doctor - '.$this->db->where('doctor_id',$id)->get('doctors')->row()->name;
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
        if ($task == "delete_doctor") {
            $this->crud_model->delete_patient_doctor($doctor_id);
            $this->session->set_flashdata('message', get_phrase('doctor_deleted_successfuly'));
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
        $data['page_title'] = get_phrase('medical lab');
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
        if ($task == "delete_lab") {
            $this->crud_model->delete_patient_lab($patient_id);
            $this->session->set_flashdata('message', get_phrase('medical_lab_deleted_successfuly'));
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
        $data['page_title'] = get_phrase('medical store');
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
        if ($task == "delete_store") {
            $this->crud_model->delete_patient_store($patient_id);
            $this->session->set_flashdata('message', get_phrase('medical_store_deleted_successfuly'));
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
        if ($task == "user_update") {
            $this->crud_model->user_update_info($patient_id);
            $this->session->set_flashdata('message', get_phrase('user_info_updated_successfuly'));
            redirect($this->session->userdata('last_page1'));
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
    $phone = $this->input->post('mobile');
     $email = $this->input->post('email');
    $validation_phone = mobile_validation($phone);
    $validation = email_validation($email);
    if($validation_phone == 1 && $validation == 1){
        $this->crud_model->save_unuser_info();
        $this->session->set_flashdata('message', get_phrase('unregistered_user_info_saved_successfuly'));
        }else{
        $this->session->set_flashdata('message', get_phrase('unregistered user registration failed'));
        }
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

    function inpatient($task = "", $patient_id = "",$status='') {
        $account_type=$this->session->userdata('login_type');
        if ($task == "status") {
            $this->crud_model->update_inpatient_status($patient_id,$status);
            $this->session->set_flashdata('message', get_phrase('inpatient_status_updated_successfuly'));
            redirect($this->session->userdata('last_page'));
        } 
        if ($task == "delete") {
            $this->crud_model->delete_inpatient_info($patient_id);
            $this->session->set_flashdata('message', get_phrase('inpatient_deleted_successfuly'));
            redirect($this->session->userdata('last_page'));
        }
        //$data['patient_info'] = $this->crud_model->select_inpatient_info();
        $data['page_name'] = 'manage_inpatient';
        if($account_type!='users'){
        $data['page_title'] = get_phrase('inpatients');
        }else{
        $data['page_title'] = 'InPatient History';
        }
        $this->load->view('backend/index', $data);
    }
    function inpatient_history($task = "", $patient_id = "") {
        if($task=='delete'){
            $this->crud_model->delete_inpatient_history_info($patient_id);
            $this->session->set_flashdata('message', get_phrase('inpatient_history_info_deleted_successfuly'));
            redirect($this->session->userdata('last_page1'));
        }
        $data['inpatient'] = $this->crud_model->select_inpatient_id_info($task);
        $data['inpatient_history'] = $this->crud_model->select_inpatient_history_info($task);
        $name=$this->db->where('user_id',$data['inpatient']->user_id)->get('users')->row_array();
        $data['page_name'] = 'inpatient_history';
        $data['page_title'] = get_phrase('inpatient - ').$name['name'].' ('.$name['unique_id'].')';
        $this->load->view('backend/index', $data);
    }
    function add_inpatient_history(){
        $this->crud_model->save_inpatient_history();
        $this->session->set_flashdata('message', get_phrase('inpatient_history_added_successfuly'));
        redirect($this->session->userdata('last_page1'));
    }
    function patient($task = "", $patient_id = "") {
        $data['patient_info'] = $this->crud_model->select_patient_info();
        $data['page_name'] = 'manage_patient';
        $data['page_title'] = get_phrase('patients');
        $this->load->view('backend/index', $data);
    }
      function add_appointment($id="")
    {
    if($this->input->post()){
        $user= $this->input->post('user_id');
        $appointment_date=$this->input->post('appointment_date');
        $perday=$this->db->get_where('appointments', array('user_id' => $user,'created_at>='=>date('Y-m-d 00:00:00'),'created_at<='=>date('Y-m-d 23:59:59')))->num_rows();
        if($perday<2){
        $count=$this->db->get_where('appointments', array('user_id' => $user,'appointment_date'=>$appointment_date))->num_rows();
      if($count < 2 ){ 
    $this->crud_model->save_appointment_info();
    $this->session->set_flashdata('message', get_phrase('appointment_info_saved_successfuly'));
    redirect($this->session->userdata('last_page'));
    }else{
       $this->session->set_flashdata('appointment_date_error',"You Can not Book More Than 2 Appointments Per Day");
    }
}else{
    $this->session->set_flashdata('appointment_date_error',"You Can Book a maximum of 2 Appointments Per Day");
    }
    }
        if($id!=''){
        $data['doctor_id'] = $id;
        }
        $data['page_name'] = 'add_appointment';
        $data['page_title'] = get_phrase('book_Appointment');
        $this->load->view('backend/index', $data);
    }
    function edit_appointment($appointment_id = "")
    {
    if($this->input->post()){     
    $this->crud_model->update_appointment_info($appointment_id);
    $this->session->set_flashdata('message', get_phrase('appointment_info_updated_successfuly'));
    redirect($this->session->userdata('last_page'));
    }
    $unique_id=$this->db->where('appointment_id',$appointment_id)->get('appointments')->row()->appointment_number;
    
        $data['appointment_id']=$appointment_id;
        $data['page_name'] = 'edit_appointment';
        $data['page_title'] = get_phrase('Appointment - ').$unique_id;
        $this->load->view('backend/index', $data);
    }
    /*function appointment_date(){
        $data['page_name']=$this->crud_model->select_appointment_info_date($_GET['sd'],$_GET['ed']);
        $data['page_name'] = 'dashboard';
        $data['page_title'] = get_phrase('dashboard');
        $this->load->view('backend/index', $data);
    }*/
    function appointment($task = "", $appointment_id = "",$status="") {
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
        if($this->input->post('remark') !='' || $this->input->post('next_appointment')){
            $this->crud_model->update_appointment_remark($appointment_id);
            $this->session->set_flashdata('message', get_phrase('appointment_updated_successfuly'));
        }
            redirect($this->session->userdata('last_page1'));
        }
        if ($task == "recommend") {
            $this->crud_model->recommend_inpatient($appointment_id);
            $this->session->set_flashdata('message', get_phrase('recommended_as_inpatient_successfuly'));
            /*redirect($this->session->userdata('last_page1'));*/
        }
        if ($task == "attended_status") {
            $this->crud_model->update_appointment_attended_status($appointment_id,$status);
            $this->session->set_flashdata('message', get_phrase('appointment_updated_successfuly'));
            redirect($this->session->userdata('last_page'));
        }
        //$data['appointment_info'] = $this->crud_model->select_appointment_info();
        $data['page_name'] = 'manage_appointment';
        $data['page_title'] = get_phrase('manage_appointments');
        $this->load->view('backend/index', $data);
    }
    function appointment_cancel($task =''){
        if ($task == "cancel_multiple") {
        if($_POST['cancel_reason'] != ''){
            $d=$this->crud_model->cancel_multiple_appointment_info();
            if($d){
            $this->session->set_flashdata('message', get_phrase('appointment_cancled_successfuly'));echo TRUE;
        }
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
     function add_prescription($doctor_id='',$user_id='')
    {
    if($this->input->post()){
    $this->crud_model->save_prescription_info();
    $this->session->set_flashdata('message', get_phrase('prescription_info_saved_successfuly'));
    redirect($this->session->userdata('last_page1'));
    
    }
        $data['doctor_id'] = $doctor_id;
        $data['user_id'] = $user_id;
        $data['page_name'] = 'add_prescription';
        $data['page_title'] = get_phrase('add_prescription');
        $this->load->view('backend/index', $data);
    }
    function edit_prescription($prescription_id='')
    {
    if($this->input->post()){
    $this->crud_model->update_prescription_info($prescription_id);
    $this->session->set_flashdata('message', get_phrase('prescription_info_updated_successfuly'));
    redirect($this->session->userdata('last_page1'));
    
    }
        $data['prescription_id'] = $prescription_id;
        $data['page_name'] = 'edit_prescription';
        $data['page_title'] = get_phrase('prescription');
        $this->load->view('backend/index', $data);
    }
    /*function prescription_history($prescription_id='',$order_id='')
    {
        if($order_id != ''){
        $data['order_id'] = $order_id;    
        }
        $data['prescription_id'] = $prescription_id;
        $data['page_name'] = 'prescription_history';
        $data['page_title'] = get_phrase('prescription');
        $this->load->view('backend/index', $data);
    }*/
    function ordered_prescription_history($order_id='',$order_type='')
    {
        $data['order_type']=$order_type;
        $data['order_id'] = $order_id;
        $data['page_name'] = 'prescription_history';
        $data['page_title'] = get_phrase('prescription');
        $this->load->view('backend/index', $data);
    }
    function prescription_history($prescription_id='',$order_type='')
    {
        $data['order_type']=$order_type;
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
    function prescription_re_order($order_id='')
    {
        $data['order_id'] = $order_id;
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
        $data['prescription']=$this->crud_model->select_prescription_info_user();
        $data['page_name'] = 'manage_prescription';
        $data['page_title'] = get_phrase('prescriptions');
        $this->load->view('backend/index', $data);
    }
    function add_receipt($param1='',$param2='',$param3=''){
        if($this->input->post()){
        $this->crud_model->upload_prescription_receipt($param1);
        $this->session->set_flashdata('message', get_phrase('receipt_added_successfuly'));
        redirect($this->session->userdata('last_page'));
        }
       /*$data['prescription_id']=$param1;*/
       $data['order_id']=$param1;
        $data['page_name'] = 'add_invoice';
        $data['page_title'] = get_phrase('Receipt');
        $this->load->view('backend/index', $data);
    }
    function add_prescription_reports($param1='',$param2='',$param3=''){
        if($this->input->post()){
        $this->crud_model->upload_prescription_reports($param1);
        $this->session->set_flashdata('message', get_phrase('reports_added_successfuly'));
        redirect($this->session->userdata('last_page'));
        }
       $data['order_id']=$param1;
        $data['page_name'] = 'add_prescription_reports';
        $data['page_title'] = get_phrase('Reports');
        $this->load->view('backend/index', $data);
    }
    function receipt($param1='',$param2='',$param3=''){
       $data['order_id']=$param1;
        $data['page_name'] = 'receipt';
        $data['page_title'] = get_phrase('Receipt');
        $this->load->view('backend/index', $data);
    }
    /********Add Prognosis*********/
     function add_prognosis($doctor_id='',$user_id='')
    {
    if($this->input->post()){
    $this->crud_model->save_prognosis_info();
    $this->session->set_flashdata('message', get_phrase('prognosis_info_saved_successfuly'));
    redirect($this->session->userdata('last_page1'));
    
    }
        $data['doctor_id'] = $doctor_id;
        $data['user_id'] = $user_id;
        $data['appointment_id'] = $appointment_id;
        $data['page_name'] = 'add_prognosis';
        $data['page_title'] = get_phrase('add_prognosis');
        $this->load->view('backend/index', $data);
    }
    function edit_prognosis($prognosis_id='')
    {
    if($this->input->post()){
    $this->crud_model->update_prognosis_info($prognosis_id);
    $this->session->set_flashdata('message', get_phrase('prognosis_info_updated_successfuly'));
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
    function prognosis_history($prognosis_id='',$order_type='')
    {
        $data['prognosis_id'] = $prognosis_id;
        $data['page_name'] = 'prognosis_history';
        $data['page_title'] = get_phrase('prognosis');
        $this->load->view('backend/index', $data);
    }
    function orders($param1='',$param2='',$param3='')
    {
        if ($param1 == "order") {
            $this->crud_model->save_prescription_order($param2);
            $this->session->set_flashdata('message', get_phrase('prescription_ordered_successfuly'));
            redirect($this->session->userdata('last_page'));
        }   
        if ($param1 == "delete") {
            $this->crud_model->delete_prescription($param2);
            $this->session->set_flashdata('message', get_phrase('prescription_info_deleted_successfuly'));
            redirect($this->session->userdata('last_page'));
        }
        if($param1 == 'order_status'){
            $this->crud_model->update_order_status($param2,$param3);
            $this->session->set_flashdata('message', get_phrase('order_status_updated'));
            redirect($this->session->userdata('last_page'));
        }
        $account_type=$this->session->userdata('login_type');
        if($account_type == 'users' || $account_type == 'superadmin' || $account_type == 'hospitaladmins'){
        $data['order_type']=$param1;
        }
        if($account_type == 'medicalstores'){
        $data['order_type']=0;
        }
        if($account_type == 'medicallabs'){
        $data['order_type']=1;
        }
        if($data['order_type']==0){$page=get_phrase('medicine_orders');}elseif($data['order_type']==1){$page=get_phrase('medicaltest_orders');}
        $data['order']=$this->crud_model->select_order_info($param1);
        $data['page_name'] = 'manage_order';
        $data['page_title'] = $page;
        $this->load->view('backend/index', $data);
    }
    function add_order($param1='',$param2=''){
        if($this->input->post()){
        $this->crud_model->book_order($param1);
        $this->session->set_flashdata('message', get_phrase('ordered_successfuly'));
        redirect($this->session->userdata('last_page'));
        }
        if($param1==0){$page=get_phrase('order_medicines');}elseif($param1==1){$page=get_phrase('order_medicaltest');}
        if($param2!=''){
        $data['id'] = $param2;    
        }
        $data['order_type'] = $param1;
        $data['page_name'] = 'add_order';
        $data['page_title'] = $page;
        $this->load->view('backend/index', $data);   
    }
    function re_order($param1='',$param2=''){
        if($this->input->post()){
        $this->crud_model->book_order($param1);
        $this->session->set_flashdata('message', get_phrase('ordered_successfuly'));
        redirect($this->session->userdata('last_page'));
        }
        $order_info=$this->crud_model->select_order_info_id($param1);
        if($order_info['order_type']==0){$page=get_phrase('order_medicines');}elseif($order_info['order_type']==1){$page=get_phrase('order_medicaltest');}
        $data['order_id'] = $param1;
        $data['page_name'] = 're_order';
        $data['page_title'] = $page;
        $this->load->view('backend/index', $data);   
    }
    function add_health_reports($param1='',$param2='',$param3='')
    {   
        $account_type=$this->session->userdata('login_type');
        if($this->input->post()){
        $data['health_reports']=$this->crud_model->save_medical_reports();
        $this->session->set_flashdata('message', get_phrase('reports_added_successfuly'));
        if($account_type=='users'){
        redirect($this->session->userdata('last_page'));
        }
        if($account_type=='doctors'){
        redirect($this->session->userdata('last_page1'));
        }
        }
        $data['user_id'] = $param1;
        $data['page_name'] = 'add_reports';
        $data['page_title'] = get_phrase('health_reports');
        $this->load->view('backend/index', $data);
    }
    function health_reports($param1='',$param2='',$param3='')
    {   
        if ($param1 == "delete") {
            $this->crud_model->delete_medical_reports($param2);
            $this->session->set_flashdata('message', get_phrase('medical_report_info_deleted_successfuly'));
            redirect($this->session->userdata('last_page'));
        }
        if ($param1 == "status") {
            $this->crud_model->update_medical_reports_status($param2,$param3);
            $this->session->set_flashdata('message', get_phrase('medical_report_status_updated_successfuly'));
            redirect($this->session->userdata('last_page'));
        } 
        $data['health_reports']=$this->crud_model->select_medical_reports();
        $data['page_name'] = 'manage_health_reports';
        $data['page_title'] = get_phrase('health_reports');
        $this->load->view('backend/index', $data);
    }
    function reports_view($report_id = ""){
        $data['report_id']=$report_id;
        $data['page_name'] = 'view_health_reports';
        $data['page_title'] = get_phrase('health_report');
        $this->load->view('backend/index', $data);
    }
    function report($report_id = "") {
        $data['report_id']=$report_id;
        $data['hospital_info'] = $this->crud_model->select_report_info();
        $data['page_name'] = 'manage_reports';
        if($report_id==1){
        /*$this->crud_model->getReport();*/
        $data['page_title'] = get_phrase('in-Patient_reports');
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
        $data['page_title'] = get_phrase('in-Patient_trend');
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
        $data['page_title'] = get_phrase('in-Patient_trend');
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
        $this->db->where('setting_type', 'privacy');
        $this->db->update('settings', $data_list);
        $this->session->set_flashdata('message', get_phrase('data_updated_successfuly'));
        redirect($this->session->userdata('last_page1'));
            }
    $page_data['id']=$param1;
    $page_data['privacy'] = $this->db->get_where('settings', array('setting_type' => 'privacy'))->row()->description;
    $page_data['page_title'] = get_phrase('Edit Privacy & Policy');
        }elseif($param1 == 2){
            if($this->input->post()){
        $data_list['description'] = $this->input->post('name');
        $this->db->where('setting_type', 'terms');
        $this->db->update('settings', $data_list);
        $this->session->set_flashdata('message', get_phrase('data_updated_successfuly'));
        redirect($this->session->userdata('last_page1'));
            }
            $page_data['id']=$param1;
            $page_data['privacy'] = $this->db->get_where('settings', array('setting_type' => 'terms'))->row()->description;
    $page_data['page_title'] = get_phrase('Edit Terms & Conditions');
        }
        $page_data['page_name'] = 'edit_privacy';
        
        $this->load->view('backend/index', $page_data);
    }
    function manage_privacy($param1 = '', $param2 = '', $param3 = '') {
        if($param1 == 1){
            $page_data['privacy'] = $this->db->get_where('settings', array('setting_type' => 'privacy'))->row()->description;
            
        }elseif($param1 == 2){
            $page_data['privacy'] = $this->db->get_where('settings', array('setting_type' => 'terms'))->row()->description;
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
        $page_data['country'] = $this->crud_model->select_language_info();
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
        $page_data['specializations'] = $this->crud_model->select_specializations_info();
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
         if ($param1 == "delete") {
            
            $this->crud_model->delete_country_info($param2);
            $this->session->set_flashdata('message', get_phrase('country_info_deleted_successfuly'));
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
        if ($param1 == "delete") {
            $this->crud_model->delete_state_info($param2);
            $this->session->set_flashdata('message', get_phrase('state_info_deleted_successfuly'));
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
        if ($param1 == "delete") {
            
            $this->crud_model->delete_district_info($param2);
            $this->session->set_flashdata('message', get_phrase('district_info_deleted_successfuly'));
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
        if ($param1 == "delete") {
            
            $this->crud_model->delete_city_info($param2);
            $this->session->set_flashdata('message', get_phrase('city_info_deleted_successfuly'));
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
        }
        if ($param1 == "update") {
            $this->crud_model->update_license_info($param2);
            $this->session->set_flashdata('message', get_phrase('license_info_updated_successfuly'));
        }
        if ($param1 == "delete") {
            $this->crud_model->delete_license($param2);
            $this->session->set_flashdata('message', 'License Info Deleted Successfuly');
        }
        $page_data['page_name'] = 'license';
        $page_data['page_title'] = get_phrase('license');
        $page_data['license'] = $this->db->get('license')->result_array();
        $this->load->view('backend/index', $page_data);
    }
      function license_category($param1 = '', $param2 = '', $param3 = '') {
        if ($param1 == "create"){
            $this->crud_model->save_license_category_info();
            $this->session->set_flashdata('message', get_phrase('license_category_info_saved_successfuly'));
            redirect(base_url() . 'main/license');
        }
        if ($param1 == "update") {
            $this->crud_model->update_license_category_info($param2);
            $this->session->set_flashdata('message', get_phrase('license_category_info_updated_successfuly'));
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
        if ($param1 == "delete") {
            $this->crud_model->delete_health_insurance_provider($param2);
            redirect(base_url() . 'main/health_insurance_provider');
        }
        $page_data['page_name'] = 'health_insurance_provider';
        $page_data['page_title'] = get_phrase('health_insurance_provider');
        $page_data['health_insurance_provider'] = $this->crud_model->select_health__insurance_provider_info();
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
        $page_data['page_title'] = get_phrase('new_message');
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
        $page_data['page_name'] = 'manage_message';
        $page_data['page_title'] = get_phrase('messages');
        $this->load->view('backend/index', $page_data);
    }
    function read_notification($param1 = '', $param2 = '', $param3 = '') 
    {
        $page_data['notifications']=$this->crud_model->read_notification($param1);
        $page_data['notification_id']=$param1;
        $page_data['page_name'] = 'notification_read';
        $page_data['page_title'] = get_phrase('notifications');
        $this->load->view('backend/index', $page_data);
    }
    function notification($param1 = '', $param2 = '', $param3 = '') {
        if($param1=='delete'){
        $this->crud_model->delete_notification($param2);
        $this->session->set_flashdata('message', get_phrase('notification_removed_successfuly'));
        redirect($this->session->userdata('last_page'));
        }
        if($param1=='delete_all'){
        $this->crud_model->delete_all_notifications();
        $this->session->set_flashdata('message', get_phrase('notifications_removed_successfuly'));
        redirect($this->session->userdata('last_page'));
        }
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
            unlink('uploads/logo.png');
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
$this->load->dbutil();
$prefs = array(     
    'format'      => 'sql',             
    'filename'    => 'my_db_backup.sql'
    );
$backup =& $this->dbutil->backup($prefs); 
$db_name = 'MyPulse-DB'.date('Ymd').'.'.'sql';
$save = 'pathtobkfolder/'.$db_name;
$this->load->helper('file');
write_file($save, $backup); 
$this->load->helper('download');
force_download($db_name, $backup);
    }
    /************Privacy & Policy ,Terms & Conditions****************/
    function privacy($param1 = '', $param2 = '', $param3 = '') {
        if($param1 == 1){
            $page_data['privacy'] = $this->db->get_where('settings', array('setting_type' => 'privacy'))->row()->description;
            $page_data['page_title'] = get_phrase('Privacy & Policy');
        }elseif($param1 == 2){
            $page_data['privacy'] = $this->db->get_where('settings', array('setting_type' => 'terms'))->row()->description;
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
            if($this->input->post('dob')!=''){
            $data['dob'] = date('Y-m-d',strtotime($this->input->post('dob')));
            }
            $data['gender'] = $this->input->post('gender');
            $data['country_id'] = $this->input->post('country');
            $data['state_id'] = $this->input->post('state');
            $data['district_id'] = $this->input->post('district');
            $data['city_id'] = $this->input->post('city');
            $data['address'] = $this->input->post('address');
            if($this->input->post('longitude')!=''){
        $data['longitude']    = $this->input->post('longitude');
        }
        if($this->input->post('latitude')!=''){
        $data['latitude']    = $this->input->post('latitude');
        }

            $this->db->where('superadmin_id', $this->session->userdata('login_user_id'));
            $this->db->update('superadmin', $data);
            if($_FILES['userfile']['tmp_name']!=''){
            unlink('uploads/superadmin_image/'.$this->session->userdata('login_user_id').  '.jpg');
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/superadmin_image/'.$this->session->userdata('login_user_id').'.jpg');
            }
            $this->session->set_flashdata('message', get_phrase('profile_info_updated_successfuly'));
            redirect($this->session->userdata('last_page'));
        }
        $page_data['page_name'] = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data'] = $this->db->get_where($this->session->userdata('login_type'), array($this->session->userdata('type_id').'_id' => $this->session->userdata('login_user_id')))->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    function manage_password($param1 = '', $param2 = '', $param3 = '') {
        if ($this->input->post()){
            $current_password_input = hash ( "sha256",$this->input->post('password'));
            $new_password = hash ( "sha256",$this->input->post('new_password'));
            $confirm_new_password = hash ( "sha256",$this->input->post('confirm_new_password'));
            $current_password_db = $this->db->get_where($this->session->userdata('login_type'), array($this->session->userdata('type_id').'_id' =>$this->session->userdata('login_user_id')))->row()->password;
            if($new_password == $confirm_new_password){
            if ($current_password_db == $current_password_input) {
            $this->db->where($this->session->userdata('type_id').'_id', $this->session->userdata('login_user_id'));
            $this->db->update($this->session->userdata('login_type'), array('password' => $new_password));
            $this->session->set_flashdata('message', get_phrase('password_info_updated_successfuly'));
            redirect($this->session->userdata('last_page'));
            }else{
                /*$this->session->set_flashdata('message', get_phrase('password_update_failed'));
                redirect(base_url() . 'main/manage_password');*/
                $this->session->set_flashdata('old_pass_error','Old Password Not Match');
            }
            }else{
                $this->session->set_flashdata('con_pass_error','New Password and Confirm Password Not Match');
            }
        }
        $page_data['page_name'] = 'manage_password';
        $page_data['page_title'] = get_phrase('manage_password');
        $page_data['edit_data'] = $this->db->get_where('superadmin', array('superadmin_id' => $this->session->userdata('login_user_id')))->result_array();
        $this->load->view('backend/index', $page_data);
    }
    function opt_verification($param1 = '', $param2 = '', $param3 = '')
    {
    $past_time=strtotime($this->session->userdata('otp_time'));
    $current_time = time();
    $difference = $current_time - $past_time;
    $difference_minute =  $difference/60;
    if(intval($difference_minute)<3){
        $otp_form=$this->input->post('otp');
        $otp=$this->session->userdata('otp');
        if($otp_form == $otp){
            $this->db->where($param2.'_id',$_POST['user_id']);
            $s=$this->db->update($param1, array('mobile_verify' =>1));
            if($s){
            $this->session->set_flashdata('message', get_phrase('Your Mobile Number Verified Successfully'));
            echo TRUE;
            }
        }else{
            echo '<span id="otp_error" style="color:red;">OTP Incorect</span>';
        }
    }else{
        echo '<span id="otp_error" style="color:red;">OTP Time Was Experied</span>';
    }
    }
    function leave_us_messages($task='',$id='',$status=''){
        if($task=='status'){
            $data['row_status_cd']=$status;
            $this->db->where('id',$id);
            $this->db->update('leave_message',$data);
            //echo $this->db->last_query();die;
            redirect($this->session->userdata('last_page'));
        }
        $page_data['page_name'] = 'leave_us_messages';
        $page_data['page_title'] = get_phrase('Feedbacks');
        $this->load->view('backend/index', $page_data);
    }
    function settings($param1 = '', $param2 = '', $param3 = '') {
        $page_data['page_name'] = 'settings';
        $page_data['page_title'] = get_phrase('settings');
        $this->load->view('backend/index', $page_data);
    }
    /*Password Reset By Admin Every Persons and Users*/
    function password_reset_admin($param1='')
    {
      if ($this->input->post()){
            if($this->input->post('person_info')!=''){
            $person_info = explode('/',$this->input->post('person_info'));
            $new_password = hash ( "sha256",$this->input->post('new_password'));
            $confirm_new_password = hash ( "sha256",$this->input->post('confirm_new_password'));
            if($new_password == $confirm_new_password){
            $this->db->where($person_info[1].'_id', $person_info[2]);
            $yes=$this->db->update($person_info[0], array('password' => $new_password));
            if($yes){
            $this->session->set_flashdata('message', get_phrase('password_updated_successfuly'));
            }else{
            $this->session->set_flashdata('message', get_phrase('password_not_updated'));
            }
            }else{
            $this->session->set_flashdata('con_pass_error','New Password and Confirm Password Not Match');
            }
        }else{
            $this->session->set_flashdata('user_error','No Data Found');
        }
        }
        $page_data['page_name'] = 'reset_password_by_admin';
        $page_data['page_title'] = 'Reset Password';
        $this->load->view('backend/index', $page_data);
    }
       // SMS settings.
    function sms_settings($param1 = '') {
        if ($param1 == 'do_update') {
            $this->crud_model->update_sms_settings();
            $this->session->set_flashdata('message', get_phrase('settings_updated'));
            redirect(base_url() . 'main/sms_settings/', 'refresh');
        }

        $page_data['page_name'] = 'sms_settings';
        $page_data['page_title'] = get_phrase('sms_settings');
        $this->load->view('backend/index', $page_data);
    }

       // feedback.
    function feedback($param1 = '', $param2 = '') {
        if ($param1 == 'do_update') {
            $this->crud_model->update_feedback($param2);
            $this->session->set_flashdata('message', get_phrase('feedback_updated'));
            redirect(base_url() . 'main/feedback/', 'refresh');
        }
        if ($param1 == 'add') {
            $this->crud_model->save_feedback();
            $this->session->set_flashdata('message', get_phrase('feedback_saved_successfully'));
            redirect(base_url() . 'main/feedback/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->crud_model->delete_feedback($param2);
            $this->session->set_flashdata('message', get_phrase('feedback_deleted_successfully'));
            redirect(base_url() . 'main/feedback/', 'refresh');
        }
        $page_data['page_name'] = 'feedback';
        $page_data['page_title'] = get_phrase('feedback');
        $this->load->view('backend/index', $page_data);
    }
    function add_feedback() {
        $page_data['page_name'] = 'add_feedback';
        $page_data['page_title'] = get_phrase('feedback');
        $this->load->view('backend/index', $page_data);
    }
   
    function send_feedback() {
        if($this->input->post()){
            $input=$this->input->post();
            $unique_id=$this->session->userdata('unique_id');
            /*$code=divide_unique_id($row['unique_id']);
            $role=$this->crud_model->get_role($code);
            $u_data=$this->db->get_where($role['type'],array('unique_id',$row['unique_id']))->row_array();*/
            $data['message']=$input['feedback'];
            $data['unique_id']=$unique_id;
            $this->db->insert('leave_message',$data);
        }
        $page_data['page_name'] = 'send_feedback';
        $page_data['page_title'] = get_phrase('send_feedback');
        $this->load->view('backend/index', $page_data);
    }
    function get_location() {
        $page_data['page_name'] = 'get_location';
        $page_data['page_title'] = get_phrase('get_location');
        $this->load->view('backend/index', $page_data);
    }
    function edit_feedback($param1 = '') {
        $page_data['id']=$param1;
        $page_data['page_name'] = 'edit_feedback';
        $page_data['page_title'] = get_phrase('feedback');
        $this->load->view('backend/index', $page_data);
    }
    public function errors_logs($param1 = '', $param2 = '', $param3 = '') {  
        $data['title'] = 'Error Log';
        $data['clear'] = site_url('tool/error_log/clear');
        $data['log'] = '';
        if($_GET['date']!=''){
        $date=date('Y-m-d',strtotime($_GET['date']));
        }else{
        $date=date('Y-m-d');
        }
         // Current Filename;
        $file = APPPATH . 'logs/' . 'log-'.$date.'.php';
        /*$file = APPPATH . 'logs/' . 'log-2019-01-16.php';*/
        if (file_exists($file)) {
            $size = filesize($file);
            if ($size >= 5242880) {
                $suffix = array(
                    'B',
                    'KB',
                    'MB',
                    'GB',
                    'TB',
                    'PB',
                    'EB',
                    'ZB',
                    'YB'
                );
                $i = 0;
                while (($size / 1024) > 1) {
                    $size = $size / 1024;
                    $i++;
                }
                $error_warning = 'Warning: Your error log file %s is %s!';
                $data['error_warning'] = sprintf($error_warning, basename($file), round(substr($size, 0, strpos($size, '.') + 4), 2) . $suffix[$i]);
            } else {
                 // Updated from comment
                $log = file_get_contents($file, FILE_USE_INCLUDE_PATH, null);
                $lines = explode("\n", $log); 
                /*$content = implode("\n", array_slice($lines, 1));*/ 
                $data['log'] = $lines;
            }
        }
        $data['page_name'] = 'logs';
        $data['page_title'] = get_phrase('logs');
        $this->load->view('backend/index', $data);
    }

}
?>