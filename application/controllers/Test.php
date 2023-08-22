<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Test extends CI_Controller {

    function __construct() {
        parent::__construct();
        /*$this->load->database();   
        $this->load->library('session');*/
        
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
    public function index(){
    	echo "This is for testing of loading multipul data";
    }
    public function hospitals($starts,$limit){
for($i=$starts;$i<=$limit;$i++){
$_POST=Array ( 'name'=>'Hospital'.$i,'description' =>'Description'.$i ,'address' =>'Address'.$i,'email' =>'mahesh'.$i.'@g.com','phone_number' =>'1231231231' ,'status' => '1','md_name' => 'Mahi'.$i,'md_phone' =>'1231231231', 'country' =>'1', 'state' =>'2', 'district' =>'1', 'city' =>'1', 'license' =>'1', 'license_status' =>'1', 'from_date' =>'03/08/2019', 'till_date' => '03/08/2020');
	$this->crud_model->save_hospital_info();
	}
	}
	public function hospital_admins(){
		$data=$this->db->get('hospitals')->num_rows();
		for($i=1;$i<=$data;$i++){
	$_POST=Array ('fname'=>'Hospital Admin'.$i,'lname'=>'Hospital Admin'.$i,'mname'=>'Hospital Admin'.$i,'address'=>'address'.$i,'description' =>'Description'.$i,'email'=>'ha'.$i.'@g.com','phone_number'=>'1233123311','hospital'=>$i,'status'=>1,'gender'=>'','dob'=>'','aadhar'=>'','qualification'=>'','experience'=>'','registration'=>'','country'=>'','state'=>'','district'=>'','city'=>'','profession'=>'');
	$this->crud_model->save_hospitaladmins_info();
		}
	}
	public function branches($starts,$limit){
for($i=$starts;$i<=$limit;$i++){
	$hos=rand(1,10);
$_POST=Array ( 'hospital'=>$hos,'name'=>'Branch'.$i,'address' =>'Address'.$i,'email' =>'mahesh'.$i.'@g.com','phone_number' =>'1231231231', 'country' =>'1', 'state' =>'1', 'district' =>'1', 'city' =>'1');
	$this->crud_model->save_branch_info();
	}
	}
	public function departmets($starts,$limit){
for($i=$starts;$i<=$limit;$i++){
	$hos=rand(1,10);
	$bra=$this->db->where('branch_id',$hos)->get('branch')->row_array();
	$_POST=Array ( 'hospital'=>$bra['hospital_id'],'branch'=>$bra['branch_id'],'name'=>'Department'.$i,'description' =>'Description'.$i);
	$this->crud_model->save_department_info();
	}
	}
	public function wards($starts,$limit){
for($i=$starts;$i<=$limit;$i++){
	$hos=rand(1,10);
	$bra=$this->db->where('department_id',$hos)->get('department')->row_array();
	$_POST=Array ( 'hospital'=>$bra['hospital_id'],'branch'=>$bra['branch_id'],'department'=>$bra['department_id'],'name'=>'Ward'.$i,'description' =>'Description'.$i);
	$this->crud_model->save_ward_info();
	}
	}
	public function beds($starts,$limit){
for($i=$starts;$i<=$limit;$i++){
	$hos=rand(1,10);
	$bra=$this->db->where('ward_id',$hos)->get('ward')->row_array();
	$_POST=Array ('hospital'=>$bra['hospital_id'],'branch'=>$bra['branch_id'],'department'=>$bra['department_id'],'ward'=>$bra['ward_id'],'name'=>'Bed'.$i,'bed_status' =>1);
	$this->crud_model->save_bed_info();
	}
	}
	public function doctors($starts,$limit){
for($i=$starts;$i<=$limit;$i++){
	$hos=rand(1,10);
	$bra=$this->db->where('department_id',$hos)->get('department')->row_array();
	$_POST=Array ('fname'=>'Doctor'.$i,'lname'=>'Doctor'.$i,'mname'=>'Doctor'.$i,'address'=>'address'.$i,'description' =>'Description'.$i,'email'=>'doc'.$i.'@g.com','mobile'=>'1233123311','hospital'=>$bra['hospital_id'],'branch'=>$bra['branch_id'],'department'=>$bra['department_id'],'status'=>1,'gender'=>'','dob'=>'','aadhar'=>'','qualification'=>'','experience'=>'','registration'=>'','country'=>'','state'=>'','district'=>'','city'=>'');
	$this->crud_model->save_doctor_info();
	}
	}
	public function nurses($starts,$limit){
for($i=$starts;$i<=$limit;$i++){
	$hos=rand(1,10);
	$bra=$this->db->where('department_id',$hos)->get('department')->row_array();
	$doc=$this->db->select('doctor_id')->where('department_id',$hos)->get('doctors')->result_array();
	for($j=0;$j<count($doc);$j++){
	$doctor[$j]=$doc[$j]['doctor_id'];
	}
	$_POST=Array ('fname'=>'Nurse'.$i,'lname'=>'Nurse'.$i,'mname'=>'Nurse'.$i,'address'=>'address'.$i,'description' =>'Description'.$i,'email'=>'nurse'.$i.'@g.com','mobile'=>'1233123311','hospital'=>$bra['hospital_id'],'branch'=>$bra['branch_id'],'department'=>$bra['department_id'],'doctor'=>$doctor,'status'=>1,'gender'=>'','dob'=>'','aadhar'=>'','qualification'=>'','experience'=>'','country'=>'','state'=>'','district'=>'','city'=>'');
	$this->crud_model->save_nurse_info();
	}
	}
	public function receptionists($starts,$limit){
for($i=$starts;$i<=$limit;$i++){
	$hos=rand(1,10);
	$bra=$this->db->where('department_id',$hos)->get('department')->row_array();
	$doc=$this->db->select('doctor_id')->where('department_id',$hos)->get('doctors')->result_array();
	for($j=0;$j<count($doc);$j++){
	$doctor[$j]=$doc[$j]['doctor_id'];
	}
	$_POST=Array ('fname'=>'Receptionist'.$i,'lname'=>'Receptionist'.$i,'mname'=>'Receptionist'.$i,'address'=>'address'.$i,'description' =>'Description'.$i,'email'=>'receptionist'.$i.'@g.com','mobile'=>'1233123311','hospital'=>$bra['hospital_id'],'branch'=>$bra['branch_id'],'department'=>$bra['department_id'],'doctor'=>$doctor,'status'=>1,'gender'=>'','dob'=>'','aadhar'=>'','qualification'=>'','experience'=>'','country'=>'','state'=>'','district'=>'','city'=>'');
	$this->crud_model->save_receptionist_info();
	}
	}
	public function medical_stores($starts,$limit){
for($i=$starts;$i<=$limit;$i++){
	$hos=rand(1,10);
	$bra=$this->db->where('branch_id',$hos)->get('branch')->row_array();
	$_POST=Array ('name'=>'Store'.$i,'owner_name'=>'Store'.$i,'owner_mobile'=>'1231231231','fname'=>'Store'.$i,'lname'=>'Store'.$i,'address'=>'address'.$i,'description' =>'Description'.$i,'email'=>'store'.$i.'@g.com','phone_number'=>'1233123311','hospital'=>$bra['hospital_id'],'branch'=>$bra['branch_id'],'status'=>1,'gender'=>'','dob'=>'','aadhar'=>'','qualification'=>'','experience'=>'','country'=>'','state'=>'','district'=>'','city'=>'','in_address'=>'');
	$this->crud_model->save_medicalstores_info();
	}
	}
	public function medical_labs($starts,$limit){
for($i=$starts;$i<=$limit;$i++){
	$hos=rand(1,10);
	$bra=$this->db->where('branch_id',$hos)->get('branch')->row_array();
	$_POST=Array ('name'=>'Lab'.$i,'owner_name'=>'Lab'.$i,'owner_mobile'=>'1231231231','fname'=>'Lab'.$i,'lname'=>'Store'.$i,'address'=>'address'.$i,'description' =>'Description'.$i,'email'=>'store'.$i.'@g.com','phone_number'=>'1233123311','hospital'=>$bra['hospital_id'],'branch'=>$bra['branch_id'],'status'=>1,'gender'=>'','dob'=>'','aadhar'=>'','qualification'=>'','experience'=>'','country'=>'','state'=>'','district'=>'','city'=>'','in_address'=>'','in_mobile'=>'');
	$this->crud_model->save_medicallabs_info();
	}
	}
	public function users($starts,$limit){
for($i=$starts;$i<=$limit;$i++){
	$_POST=Array ('fname'=>'MyPulse User'.$i,'lname'=>'MyPulse User'.$i,'mname'=>'MyPulse User'.$i,'address'=>'address'.$i,'description' =>'Description'.$i,'email'=>'user'.$i.'@g.com','mobile'=>'1233123311','status'=>1,'gender'=>'','dob'=>'','age'=>'','blood_group'=>'','sugar_level'=>'','health_insurance_provider'=>'','health_insurance_id'=>'','family_history'=>'','past_medical_history'=>'','height'=>'','weight'=>'','blood_pressure'=>'' ,'aadhar'=>'','country'=>'','state'=>'','district'=>'','city'=>'');
	$this->crud_model->save_user_info();
	}
	}
	public function appointments($starts,$limit){
for($i=$starts;$i<=$limit;$i++){
	$_POST=Array ( 'doctor' => 'MPD19_100004/ Dr. Test Doctor 1', 'user' => 'Test User 1 Test User 1', 'user_id' => '6', 'doctor_id' => '4', 'doctor_unique_id' => 'MPD19_100004', 'appointment_date' => '03/15/2019', 'available_slot' => '06:00 pm - 06:30 pm', 'reason' => 'Appointment Test '.$i);
	$this->crud_model->save_appointment_info();
	}
	}
}