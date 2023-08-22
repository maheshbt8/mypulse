<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
   
class Crud_model extends CI_Model {

    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
    }

    function clear_cache() {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }
      
    /*function get_type_name_by_id($type, $type_id = '', $field = 'name') {
        $this->db->where($type . '_id', $type_id);
        $query = $this->db->get($type);    
        $result = $query->result_array();
        foreach ($result as $row)
            return $row[$field];	
    }*/
    function validate_login($email,$password){
        $where = "(email='".$email."' OR phone='".$email."') AND password='".hash ( "sha256",$password)."' AND row_status_cd='1' AND email_verify='1'";
        $user_array = array('superadmin','hospitaladmins', 'doctors', 'nurse','receptionist','medicalstores','medicallabs', 'users');
        $size = sizeof($user_array);
        for($i = 0; $i < $size; $i++){
            if($user_array[$i]=='users'){
                $where = "(email='".$email."' OR phone='".$email."') AND password='".hash ( "sha256",$password)."' AND row_status_cd='1'  AND mobile_verify='1'";
            }
            $data = $this->db->where($where)->get($user_array[$i]);
            if($data->num_rows()>0){
                return $data;exit();
            }
        }
        return false;
    }
function login_details(){
    $unique_id=$this->session->userdata('unique_id');
    $users_data=$this->db->get_where('login_details',array('unique_id'=>$unique_id));
    if($users_data->num_rows()>0){
        $data['login_at']=date('Y-m-d H:i:s');
        return $this->db->where('unique_id',$unique_id)->update('login_details',$data);
    }else{
        $data['unique_id']=$unique_id;
        $data['login_at']=date('Y-m-d H:i:s');
        $yes=$this->db->insert('login_details',$data);
        if($yes){
            $notification['user_id']=$unique_id;
            $notification['title']='Welcome To MyPulse';
            $notification['notification_text']='MyPulse Heartly Welcoming You <b>Mr/Mrs '.ucwords($this->session->userdata('name')).'</b>';
            return $this->db->insert('notification',$notification);
        }
    }
}
function logout_details(){
    $unique_id=$this->session->userdata('unique_id');
        $data['logout_at']=date('Y-m-d H:i:s');
        return $this->db->where('unique_id',$unique_id)->update('login_details',$data);
}
function email_verification($data="")
    {
    $email_data=explode('/',$this->crud_model->generate_decryption_key($data));
    $task=$email_data[0];
    $id=$email_data[1];
    $email_verify=$this->db->get_where($task, array('unique_id' => $id))->row();
    $created_at=$email_verify->created_at;
    $past_time = strtotime($email_verify->modified_at);
    $current_time = time();
    $difference = $current_time - $past_time;
    $difference_minute =  $difference/60;
    
    if(intval($difference_minute)<30){
            if($email_verify->email_verify==2){
            $yes=$this->db->where('unique_id',$id)->update($task,array('email_verify' =>1));
        if($task != 'users')
        {
        if($yes){
        $data=$this->crud_model->generate_encryption_key($task.'/'.$id.'/'.$email_verify->modified_at);
        redirect(base_url() . 'login/set_password/'.$data, 'refresh');
        }
        }else{
            echo "YOUR Email Verified Successfully"."<br/>";
            echo "<a href='".base_url('Login')."'>Login to MyPulse</a> / <a href='".base_url()."'>Visit MyPulse home</a>";
        }
        }else{
            echo "YOU Already Verified Your Email"."<br/>";
            echo "<a href='".base_url('Login')."'>Login to MyPulse</a> / <a href='".base_url()."'>Visit MyPulse home</a>";
        }
        }else{
            echo "Your Email Verification Link Expired"."<br/>";
            echo "<a href='".base_url('Login')."'>Login to MyPulse</a> / <a href='".base_url()."'>Visit MyPulse home</a>";
        }
    }
    function forgot_password($email){
        $where=array('email'=>$email);
        $user_array = array('superadmin','hospitaladmins', 'doctors', 'nurse', 'users','receptionist','medicalstores','medicallabs');
        $size = sizeof($user_array);
        for($i = 0; $i < $size; $i++){
            $this->db->where($where);
            $data = $this->db->get($user_array[$i]);
            if($data->num_rows() > 0){
                $row=$data->row_array();
                $data1['userdetails']=$row;
                $data1['role']=$user_array[$i];
            }
        }
        if($data1!=''){
        return $data1;
        }else{
        return FALSE;
        }
    }
    function reset_password($data="")
    {
    $email_data=explode('/',$this->crud_model->generate_decryption_key($data));
    $task=$email_data[0];
    $id=$email_data[1];
    $password_time=$email_data[2];
    $user_data=$this->db->get_where($task, array('unique_id' => $id))->row();
    $past_time = strtotime($password_time);
    $current_time = time();
    $difference = $current_time - $past_time;
    $difference_minute =  $difference/60;
    if(intval($difference_minute)<30){
        redirect(base_url() . 'login/set_password/'.$data, 'refresh');
        }else{
            echo "Your Link Has Expired"."<br/>";
            echo "<a href='".base_url('Login')."'>Login to MyPulse</a> / <a href='".base_url()."'>Visit MyPulse home</a>";
        }
    }
    //////system settings//////
    function update_system_settings() {
        $data['description'] = $this->input->post('system_name');
        $this->db->where('setting_type', 'system_name');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('system_title');
        $this->db->where('setting_type', 'system_title');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('address');
        $this->db->where('setting_type', 'address');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('phone');
        $this->db->where('setting_type', 'phone');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('system_email');
        $this->db->where('setting_type', 'system_email');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('email_password');
        $this->db->where('setting_type', 'email_password');
        $this->db->update('settings', $data);
    }
    
    // SMS settings.
    function update_sms_settings() {
        
        $data['description'] = $this->input->post('sms_username');
        $this->db->where('setting_type', 'sms_username');
        $this->db->update('settings', $data);
        
        $data['description'] = $this->input->post('sms_sender');
        $this->db->where('setting_type', 'sms_sender');
        $this->db->update('settings', $data);
        
        $data['description'] = $this->input->post('sms_hash');
        $this->db->where('setting_type', 'sms_hash');
        $this->db->update('settings', $data);
    }
    function get_feedback_info(){
        return $this->db->where('row_status_cd',1)->get('feedback')->result_array();
    }
    function save_feedback() {
        $data['customer_id'] = $this->input->post('customer');
        $data['feedback'] = $this->input->post('feedback');
        $this->db->insert('feedback', $data);
        $id=$this->db->insert_id();
        $this->crud_model->update_created_info('feedback','id',$id);
    }
    function update_feedback($id) {
        $data['customer_id'] = $this->input->post('customer');
        $data['feedback'] = $this->input->post('feedback');
        $this->db->where('id', $id);
        $this->db->update('feedback', $data);
        $this->crud_model->update_modified_info('feedback','id',$id);
    }
    function delete_feedback($id) {
        $data['row_status_cd']='0';
        $this->db->where('id', $id);
        $this->db->update('feedback', $data);
        $this->crud_model->update_modified_info('feedback','id',$id);
    }

    /////creates log/////
   /* function create_log($data) {
        $data['timestamp'] = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));
        $data['ip'] = $_SERVER["REMOTE_ADDR"];
        $location = new SimpleXMLElement(file_get_contents('http://freegeoip.net/xml/' . $_SERVER["REMOTE_ADDR"]));
        $data['location'] = $location->City . ' , ' . $location->CountryName;
        $this->db->insert('log', $data);
    }*/

    ////////BACKUP RESTORE/////////
/*    function create_backup($type) {
        $this->load->dbutil();
        $options = array(
            'format' => 'txt', // gzip, zip, txt
            'add_drop' => TRUE, // Whether to add DROP TABLE statements to backup file
            'add_insert' => TRUE, // Whether to add INSERT data to backup file
            'newline' => "\n"               // Newline character used in backup file
        );


        if ($type == 'all') {
            $tables = array('');
            $file_name = 'system_backup';
        } else {
            $tables = array('tables' => array($type));
            $file_name = 'backup_' . $type;
        }

        $backup = & $this->dbutil->backup(array_merge($options, $tables));


        $this->load->helper('download');
        force_download($file_name . '.sql', $backup);
    }*/

    /////////RESTORE TOTAL DB/ DB TABLE FROM UPLOADED BACKUP SQL FILE//////////
/*    function restore_backup() {
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/backup.sql');
        $this->load->dbutil();
        $prefs = array(
            'filepath' => 'uploads/backup.sql',
            'delete_after_upload' => TRUE,
            'delimiter' => ';'
        );
        $restore = & $this->dbutil->restore($prefs);
        unlink($prefs['filepath']);
    }*/

    /////////DELETE DATA FROM TABLES///////////////
    /*function truncate($type) {
        if ($type == 'all') {
            $this->db->truncate('student');
            $this->db->truncate('mark');
            $this->db->truncate('teacher');
            $this->db->truncate('subject');
            $this->db->truncate('class');
            $this->db->truncate('exam');
            $this->db->truncate('grade');
        }else{
            $this->db->truncate($type);
        }
    }*/

    ////////IMAGE URL//////////
    /*
    function get_mypulse_logo_url($type = '', $id = '') {
         if (file_exists('assets/logo.png')){
            $image_url ='assets/logo.png';
        }
    $img_binary = fread(fopen($image_url, "r"), filesize($image_url));
    $image_url = base64_encode($img_binary);
    return $image_url;
    }
    function get_hospitals_logo_url($id) {
         if (file_exists('uploads/hospitallogos/'.$id.'.png')){
            $image_url ='uploads/hospitallogos/'.$id.'.png';
        }
    $img_binary = fread(fopen($image_url, "r"), filesize($image_url));
    $image_url = base64_encode($img_binary);
    return $image_url;
    }
    function get_report_url($year,$unique_id,$report,$ext) {
        if (file_exists('uploads/reports/' . $year . '/' . $unique_id.'/'. $report . '.'.$ext)){
            $image_url ='uploads/reports/' . $year . '/' . $unique_id.'/'. $report . '.'.$ext;
        }
    $img_binary = fread(fopen($image_url, "r"), filesize($image_url));
    $image_url = base64_encode($img_binary);
        return $image_url;
    }*/
    function get_image_url($type = '', $id = '') {
         if (file_exists('uploads/' . $type . '/' . $id . '.jpg')){
            $image_url ='uploads/' . $type . '/' . $id . '.jpg';
        }else{
            $image_url ='uploads/user.jpg';
        }
        return $image_url;
    }
    function generate_encryption_key($string){
    $ret=$this->encryption->encrypt($string);
if ( !empty($string) )
    {
        $ret = strtr(
                $ret,
                array(
                    '+' => '.',
                    '=' => '-',
                    '/' => '~'
                )
            );
    }
    return $ret;
    }
     function generate_decryption_key($string){
         $string = strtr(
            $string,
            array(
                '.' => '+',
                '-' => '=',
                '~' => '/'
            )
    );
    $ret=$this->encryption->decrypt($string);
    return $ret;
    }
    function get_role($role){
        $where = "role_id='".$role."' OR role='".$role."' OR type='".$role."' OR code='".$role."'";
$role=$this->db->where($where)->get('roles')->row_array();
return $role;
    }
    function get_last_unique_id($table_name){
        return $this->db->get_where('tables', array('table_name' => $table_name))->row()->unique_id;
    }
    function update_last_unique_id($table_name,$unique_id){
        $data['unique_id'] = $unique_id;
        $this->db->where('table_name',$table_name);
        return $this->db->update('tables', $data);
    }
    function get_tables_code($table_name){
        return $this->db->get_where('tables', array('table_name' => $table_name))->row()->code;
    }
    function generate_unique_id($lid,$table){
if($lid==1){
$num=100001;
}elseif($lid!=1){
$my=explode('_',$this->crud_model->get_last_unique_id($table));
$year=substr($my[0], -2);
if($year==date('y')){
$num=$my[1]+1;
}else{
$num=100001;
}
}
$code=$this->crud_model->get_tables_code($table);
$pid=$code.date('y').'_'.$num;
$this->crud_model->update_last_unique_id($table,$pid);
return $pid;
    }
    function update_created_info($table,$type_id,$id){
        $data['created_at']=date('Y-m-d H:i:s');
        $data['created_by']=$this->session->userdata('unique_id');
        return $this->db->where($type_id,$id)->update($table,$data);
    }
    function update_modified_info($table,$type_id,$id){
        $data['modified_at']=date('Y-m-d H:i:s');
        $data['modified_by']=$this->session->userdata('unique_id');
        return $this->db->where($type_id,$id)->update($table,$data);
    }
    /*HOSPITAL MANAGEMENT*/
function save_hospital_info()
    {
        $data['name']       = $this->input->post('name');
        $data['description']    = $this->input->post('description');
        $data['address']    = $this->input->post('address');
        if($this->input->post('longitude')!=''){
        $data['longitude']    = $this->input->post('longitude');
        }
        if($this->input->post('latitude')!=''){
        $data['latitude']    = $this->input->post('latitude');
        }
        $data['phone_number']    = $this->input->post('phone_number');
        $data['email']    = $this->input->post('email');
        $data['country_id']    = $this->input->post('country');
        $data['state_id']    = $this->input->post('state');
        $data['district_id']    = $this->input->post('district');
        $data['city_id']    = $this->input->post('city');
        $data['md_name']    = $this->input->post('md_name');   
        $data['md_contact_number']    = $this->input->post('md_phone');
        $data['license']    = $this->input->post('license');
        $data['row_status_cd']    = $this->input->post('license_status');   
        $data['from_date']    = date('Y-m-d',strtotime($this->input->post('from_date')));
        $data['till_date']    = date('Y-m-d',strtotime($this->input->post('till_date')));
        $insert=$this->db->insert('hospitals',$data);
        if($insert)
        {
$lid=$this->db->insert_id();
$this->crud_model->update_created_info('hospitals','hospital_id',$lid);
$pid=$this->crud_model->generate_unique_id($lid,'hospitals');
$this->db->where('hospital_id',$lid)->update('hospitals',array('unique_id'=>$pid));
        }
    }
function update_hospital_info($hospital_id)
    {
        $data['name']       = $this->input->post('name');
        $data['description']    = $this->input->post('description');
        $data['address']    = $this->input->post('address');
        if($this->input->post('longitude')!=''){
        $data['longitude']    = $this->input->post('longitude');
        }
        if($this->input->post('latitude')!=''){
        $data['latitude']    = $this->input->post('latitude');
        }
        $data['phone_number']    = $this->input->post('phone_number');
        $data['email']    = $this->input->post('email');
        $data['country_id']    = $this->input->post('country');
        $data['state_id']    = $this->input->post('state');
        $data['district_id']    = $this->input->post('district');
        $data['city_id']    = $this->input->post('city');
        $data['md_name']    = $this->input->post('md_name');   
        $data['md_contact_number']    = $this->input->post('md_phone');
        $data['license']    = $this->input->post('license');
        $data['row_status_cd']    = $this->input->post('license_status');   
        $data['from_date']    = date('Y-m-d',strtotime($this->input->post('from_date')));
        $data['till_date']    = date('Y-m-d',strtotime($this->input->post('till_date')));
        $this->db->where('hospital_id',$hospital_id);
        $this->db->update('hospitals',$data);
        $this->crud_model->update_modified_info('hospitals','hospital_id',$hospital_id);
        if($_FILES['userfile']['tmp_name']!=''){
        unlink('uploads/hospitallogos/'. $hospital_id.  '.png');
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/hospitallogos/'. $hospital_id.  '.png');
        }
    }
    function select_hospital_info()
    {
        $account_type=$this->session->userdata('login_type');
        if($account_type=='superadmin'){
        $hospi=$this->db->get('hospitals')->result_array();
        }elseif($account_type == 'users'){
        $hospital=$this->db->where('user_id',$this->session->userdata('login_user_id'))->get('patient')->row()->hospital_ids;
        if($hospital>0){
        $hospital_ids=explode(',',$hospital);
        if($hospital_ids != ''){
        for($i=0;$i<count($hospital_ids);$i++){
            $hos=$this->db->get_where('hospitals',array('hospital_id'=>$hospital_ids[$i]));
                $hospi[]=$hos->row_array();
            }
        }
        }
        } 
        return $hospi;
    }
    public function select_hospital()
    {
        return $this->db->get_where('hospitals',array('row_status_cd'=>1))->result_array();
    }
    function select_hospital_info_by_id($hospital_id){
        return $this->db->get_where('hospitals', array('hospital_id' => $hospital_id))->result_array();
    }
    function delete_hospital_info($hospital_id)
    {
        $data['row_status_cd']= '0';
        $this->db->where('hospital_id',$hospital_id);
        $yes=$this->db->update('hospitals',$data);
        if($yes){
        $this->db->where('hospital_id',$hospital_id);
        $a=$this->db->update('branch',$data);
        if($a){
        $this->db->where('hospital_id',$hospital_id);
        $b=$this->db->update('department',$data);
        if($b){
        $this->db->where('hospital_id',$hospital_id);
        $c=$this->db->update('ward',$data);
        if($c){
        $data1['bed_status']    = '2';
        $data1['row_status_cd']    = '0';
        $this->db->where('hospital_id',$hospital_id);
        $d=$this->db->update('bed',$data1);
        }
        }
        }
        }
    }
    function delete_multiple_hospital_info()
    {
        $check=$_POST['check'];
        for($i=0;$i<count($check);$i++){
        $hospital_id=$check[$i];
        $data['row_status_cd']    = '0';
        $this->db->where('hospital_id',$hospital_id);
        $yes=$this->db->update('hospitals',$data);
        if($yes){
        $this->db->where('hospital_id',$hospital_id);
        $a=$this->db->update('branch',$data);
        if($a){
        $this->db->where('hospital_id',$hospital_id);
        $b=$this->db->update('department',$data);
        if($b){
        $this->db->where('hospital_id',$hospital_id);
        $c=$this->db->update('ward',$data);
        if($c){
        $data1['bed_status']    = '2';
        $data1['row_status_cd']    = '0';
        $this->db->where('hospital_id',$hospital_id);
        $d=$this->db->update('bed',$data1);
        }
        }
        }
        }
        }
    }
    function select_single_hospital($hospital_id){
        return $this->db->where('hospital_id',$hospital_id)->get('hospitals')->row_array();
    }
    function select_all_hospitals(){
       return $this->db->get_where('hospitals',array('row_status_cd'=>'1'))->result_array();
    }
    /*BRANCH MANAGEMENT*/
    function save_branch_info()
    {
        $data['branch_name']       = $this->input->post('name');
        $data['hospital_id']    = $this->input->post('hospital');
        $data['address']    = $this->input->post('address');
        if($this->input->post('longitude')!=''){
        $data['longitude']    = $this->input->post('longitude');
        }
        if($this->input->post('latitude')!=''){
        $data['latitude']    = $this->input->post('latitude');
        }
        $data['phone']    = $this->input->post('phone_number');
        $data['email']    = $this->input->post('email');
        $data['country_id']    = $this->input->post('country');
        $data['state_id']    = $this->input->post('state');
        $data['district_id']    = $this->input->post('district');  
        $data['city_id']    = $this->input->post('city');
        $this->db->insert('branch',$data);
        $lid=$this->db->insert_id();
        $this->crud_model->update_created_info('branch','branch_id',$lid);
    }
    function update_branch_info($branch_id)
    {
        $data['branch_name']       = $this->input->post('name');
        $data['hospital_id']    = $this->input->post('hospital');
        $data['address']    = $this->input->post('address');
        if($this->input->post('longitude')!=''){
        $data['longitude']    = $this->input->post('longitude');
        }
        if($this->input->post('latitude')!=''){
        $data['latitude']    = $this->input->post('latitude');
        }
        $data['phone']    = $this->input->post('phone_number');
        $data['email']    = $this->input->post('email');
        $data['country_id']    = $this->input->post('country');
        $data['state_id']    = $this->input->post('state');
        $data['district_id']    = $this->input->post('district');
        $data['city_id']    = $this->input->post('city');
        $data['row_status_cd']    = $this->input->post('status');
        $this->db->where('branch_id',$branch_id);
        $this->db->update('branch',$data);
        $this->crud_model->update_modified_info('branch','branch_id',$branch_id);
    }
    
    function delete_branch_info($branch_id)
    {
        $data['row_status_cd']    = '0';
        $this->db->where('branch_id',$branch_id);
        $a=$this->db->update('branch',$data);
        if($a){
        $this->db->where('branch_id',$branch_id);
        $b=$this->db->update('department',$data);
        if($b){
        $this->db->where('branch_id',$branch_id);
        $c=$this->db->update('ward',$data);
        if($c){
        $data1['bed_status']    = '2';
        $data1['row_status_cd']    = '0';
        $this->db->where('branch_id',$branch_id);
        $d=$this->db->update('bed',$data1);
        }
        }
        }
    }
    function delete_multiple_branch_info()
    {
        $check=$_POST['check'];
        for($i=0;$i<count($check);$i++){
        $branch_id=$check[$i];
        $data['row_status_cd']    = '0';
        $this->db->where('branch_id',$branch_id);
        $a=$this->db->update('branch',$data);
        if($a){
        $this->db->where('branch_id',$branch_id);
        $b=$this->db->update('department',$data);
        if($b){
        $this->db->where('branch_id',$branch_id);
        $c=$this->db->update('ward',$data);
        if($c){
        $data1['bed_status']    = '2';
        $data1['row_status_cd']    = '0';
        $this->db->where('branch_id',$branch_id);
        $d=$this->db->update('bed',$data1);
        }
        }
        }
        }
    }
    function select_branch_info()
    {
        return $this->db->get_where('branch',array('row_status_cd'=>'1'))->result_array();
    }
    function select_branch($hospital_id)
    {
        return $this->db->get_where('branch',array('row_status_cd'=>'1','hospital_id'=>$hospital_id))->result_array();
    }
    function select_branch_info_by_hospital_id($hospital_id){
       return $this->db->where('hospital_id',$hospital_id)->get_where('branch',array('row_status_cd'=>'1'))->result_array();
    }
    function select_single_branch($branch_id){
        return $this->db->where('branch_id',$branch_id)->get('branch')->row_array();
    }
    function select_branch_table_hospital_id($hospital_id){
       return $this->db->where('hospital_id',$hospital_id)->get_where('branch')->result_array();
    }
    /*DEPARTMENT MANAGEMENT*/
    function save_department_info()
    {
        $data['hospital_id']=$this->input->post('hospital');
        $data['branch_id']=$this->input->post('branch');
        $data['dept_name']       = $this->input->post('name');
        $data['description']    = $this->input->post('description');
        $this->db->insert('department',$data);
        $lid=$this->db->insert_id();
        $this->crud_model->update_created_info('department','department_id',$lid);
    }
    function update_department_info($department_id)
    {
        $data['hospital_id']=$this->input->post('hospital');
        $data['branch_id']=$this->input->post('branch');
        $data['dept_name']       = $this->input->post('name');
        $data['description']    = $this->input->post('description');
        $data['row_status_cd']    = $this->input->post('status');
        $this->db->where('department_id',$department_id);
        $this->db->update('department',$data);
        $this->crud_model->update_created_info('department','department_id',$department_id);
    }
    
    function delete_department_info($department_id)
    {
        $data['row_status_cd']    = '0';
        $this->db->where('department_id',$department_id);
        $b=$this->db->update('department',$data);
        if($b){
        $this->db->where('department_id',$department_id);
        $c=$this->db->update('ward',$data);
        if($c){
        $data1['bed_status']    = '2';
        $data1['row_status_cd']    = '0';
        $this->db->where('department_id',$department_id);
        $d=$this->db->update('bed',$data1);
        }
        }
    }
    function delete_multiple_department_info()
    {
        $check=$_POST['check'];
        for($i=0;$i<count($check);$i++){
            $department_id=$check[$i];
        $data['row_status_cd']    = '0';
        $this->db->where('department_id',$department_id);
        $b=$this->db->update('department',$data);
        if($b){
        $this->db->where('department_id',$department_id);
        $c=$this->db->update('ward',$data);
        if($c){
        $data1['bed_status']    = '2';
        $data1['row_status_cd']    = '0';
        $this->db->where('department_id',$department_id);
        $d=$this->db->update('bed',$data1);
        }
        }
        }
    }
    function select_department_info()
    {
        return $this->db->get('department')->result_array();
    }
    function select_department_info_by_hospital_id($hospital_id){
       return $this->db->where('hospital_id',$hospital_id)->get('department')->result_array();
    }
    function select_single_department($department_id){
        return $this->db->where('department_id',$department_id)->get('department')->row_array();
    }
    function select_department_info_by_branch_id($branch_id){
       return $this->db->where('branch_id',$branch_id)->get_where('department',array('row_status_cd'=>'1'))->result_array();
    }
    /*WARD MANAGEMENT*/
     function save_ward_info()
    {
        $data['hospital_id']=$this->input->post('hospital');
        $data['branch_id']=$this->input->post('branch');
        $data['department_id']=$this->input->post('department');
        $data['ward_name']       = $this->input->post('name');
        $data['description']    = $this->input->post('description');
        $this->db->insert('ward',$data);
        $lid=$this->db->insert_id();
        $this->crud_model->update_created_info('ward','ward_id',$lid);
    }
    function update_ward_info($ward_id)
    {
        $data['hospital_id']=$this->input->post('hospital');
        $data['branch_id']=$this->input->post('branch');
        $data['department_id']=$this->input->post('department');
        $data['ward_name']       = $this->input->post('name');
        $data['description']    = $this->input->post('description');
        $data['row_status_cd']    = $this->input->post('status');
        $this->db->where('ward_id',$ward_id);
        $this->db->update('ward',$data);
        $this->crud_model->update_modified_info('ward','ward_id',$ward_id);
    }
    
    function delete_ward_info($ward_id)
    {
        $data['row_status_cd']    = '0';
        $this->db->where('ward_id',$ward_id);
        $c=$this->db->update('ward',$data);
        if($c){
        $data1['bed_status']    = '2';
        $data1['row_status_cd']    = '0';
        $this->db->where('ward_id',$ward_id);
        $d=$this->db->update('bed',$data1);
        }
    }
    function delete_multiple_ward_info()
    {
        $check=$_POST['check'];
        for($i=0;$i<count($check);$i++){
            $ward_id=$check[$i];
        $data['row_status_cd']    = '0';
        $this->db->where('ward_id',$ward_id);
        $c=$this->db->update('ward',$data);
        if($c){
        $data1['bed_status']    = '2';
        $data1['row_status_cd']    = '0';
        $this->db->where('ward_id',$ward_id);
        $d=$this->db->update('bed',$data1);
        }
        }
    }
    function select_ward_info()
    {
        return $this->db->get_where('ward',array('row_status_cd'=>'1'))->result_array();
    }
    function select_ward_info_by_hospital_id($hospital_id){
       return $this->db->where('hospital_id',$hospital_id)->get('ward')->result_array();
    }
    function select_single_ward($ward_id){
        return $this->db->get_where('ward',array('ward_id'=>$ward_id))->row_array();
    }
    function select_ward_info_by_department_id($department_id){
      return $this->db->get_where('ward' , array('department_id' => $department_id,'row_status_cd'=>'1'))->result_array();
    }
    /*BED MANAGEMENT*/
    function save_bed_info()
    {
        $data['hospital_id']=$this->input->post('hospital');
        $data['branch_id']=$this->input->post('branch');
        $data['department_id']=$this->input->post('department');
        $data['ward_id']=$this->input->post('ward');
        $data['bed_name']       = $this->input->post('name');
        $data['bed_status']    = $this->input->post('bed_status');
        $this->db->insert('bed',$data);
        $lid=$this->db->insert_id();
        $this->crud_model->update_created_info('bed','bed_id',$lid);
    }
    function select_beds_info()
    {
        $account_type=$this->session->userdata('login_type');
        if($account_type == 'hospitaladmins'){
        return $this->db->where('hospital_id',$this->session->userdata('hospital_id'))->get_where('bed',array('bed_status'=>'1','row_status_cd'=>'1'))->result_array();
        }elseif($account_type == 'nurse'){
return $this->db->where('hospital_id',$this->session->userdata('hospital_id'))->get_where('bed',array('bed_status'=>'1','row_status_cd'=>'1'))->result_array();
        }
    }
    function update_bed_info($bed_id)
    {
        $data['hospital_id']=$this->input->post('hospital');
        $data['branch_id']=$this->input->post('branch');
        $data['department_id']=$this->input->post('department');
        $data['ward_id']=$this->input->post('ward');
        $data['bed_name']       = $this->input->post('name');
        $data['bed_status']    = $this->input->post('bed_status');
        $this->db->where('bed_id',$bed_id);
        $this->db->update('bed',$data);
        $this->crud_model->update_created_info('bed','bed_id',$bed_id);
    }
    
    function delete_bed_info($bed_id)
    {
        $data1['row_status_cd']    = '0';
        $this->db->where('bed_id',$bed_id);
        $this->db->update('bed',$data1);
    }
     function delete_multiple_bed_info()
    {
       $data1['row_status_cd']    = '0';
        $check=$_POST['check'];
        for($i=0;$i<count($check);$i++){
            $this->db->where('bed_id',$check[$i]);
            $this->db->update('bed',$data1);
        }
    }
    function select_bed_info_by_hospital_id($hospital_id){
       return $this->db->where('hospital_id',$hospital_id)->get_where('bed',array('bed_status'=>'1','row_status_cd'=>'1'))->result_array();
    }
    function select_single_bed($bed_id){
        return $this->db->where('bed_id',$bed_id)->get('bed')->row_array();
    }
    /*Hospital Admins Management*/
    function save_hospitaladmins_info()
    {
        $data['name']       = $this->input->post('fname');
        $data['mname']      = $this->input->post('mname');
        $data['lname']      = $this->input->post('lname');
        $data['description']    = $this->input->post('description');
        $data['email']    = $this->input->post('email');   
        $data['phone']    = $this->input->post('phone_number');
        $data['hospital_id']    = $this->input->post('hospital');
        $data['row_status_cd']    = $this->input->post('status');
        $data['gender']    = $this->input->post('gender');
        if($this->input->post('dob')!=''){
        $data['dob']    = date('Y-m-d',strtotime($this->input->post('dob')));
        }
        $data['address']    = $this->input->post('address');
        if($this->input->post('longitude')!=''){
        $data['longitude']    = $this->input->post('longitude');
        }
        if($this->input->post('latitude')!=''){
        $data['latitude']    = $this->input->post('latitude');
        } 
        $data['qualification']    = $this->input->post('qualification');
        $data['profession']    = $this->input->post('profession');
        $data['experience']    = $this->input->post('experience');
        if($this->input->post('country')!=''){
        $data['country_id']    = $this->input->post('country');
        }
        if($this->input->post('state')!=''){
        $data['state_id']    = $this->input->post('state');
        }
        if($this->input->post('district')!=''){
        $data['district_id']    = $this->input->post('district'); 
        }
        if($this->input->post('city')!=''){ 
        $data['city_id']    = $this->input->post('city');
        }
       $insert=$this->db->insert('hospitaladmins',$data);
       if($insert)
        {
$lid=$this->db->insert_id();
$this->crud_model->update_created_info('hospitaladmins','admin_id',$lid);
$pid=$this->crud_model->generate_unique_id($lid,'hospitaladmins');
    $this->db->where('admin_id',$lid)->update('hospitaladmins',array('unique_id'=>$pid,'modified_at'=>date('Y-m-d H:i:s')));
    move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/hospitaladmin_image/'. $lid.  '.jpg');
       }
    }
    function select_hospitaladmins_info()
    {
        return $this->db->select('name,email,unique_id,admin_id,row_status_cd,email_verify,hospital_id')->get_where('hospitaladmins',array('row_status_cd'=>'1'))->result_array();
    }
    function select_hospitaladmins_table_info()
    {
        return $this->db->select('name,email,unique_id,admin_id,row_status_cd,email_verify,hospital_id')->get_where('hospitaladmins')->result_array();
    }
    function update_hospitaladmins_info($admin_id)
    {
        $check_email=$this->db->get_where('hospitaladmins',array('admin_id'=>$admin_id))->row();
        if($check_email->email!=$this->input->post('email')){
        $this->email_model->account_reverification_email('hospitaladmins','admin',$check_email->unique_id);
        }
             $data['name']      = $this->input->post('fname');
             $data['mname']         = $this->input->post('mname');
             $data['lname']         = $this->input->post('lname');
             $data['description']    = $this->input->post('description');
             $data['email']    = $this->input->post('email');   
             $data['phone']    = $this->input->post('mobile');
             $data['hospital_id']    = $this->input->post('hospital');
             $data['row_status_cd']    = $this->input->post('status');
             $data['gender']    = $this->input->post('gender');
             if($this->input->post('dob')!=''){
        $data['dob']    = date('Y-m-d',strtotime($this->input->post('dob')));
        }
             $data['address']    = $this->input->post('address');
           if($this->input->post('longitude')!=''){
        $data['longitude']    = $this->input->post('longitude');
        }
        if($this->input->post('latitude')!=''){
        $data['latitude']    = $this->input->post('latitude');
        }
             if($this->input->post('country')!=''){
        $data['country_id']    = $this->input->post('country');
        }
        if($this->input->post('state')!=''){
        $data['state_id']    = $this->input->post('state');
        }
        if($this->input->post('district')!=''){
        $data['district_id']    = $this->input->post('district'); 
        }
        if($this->input->post('city')!=''){ 
        $data['city_id']    = $this->input->post('city');
        }  
             $data['qualification']    = $this->input->post('qualification');
             $data['profession']    = $this->input->post('profession');
             $data['experience']    = $this->input->post('experience');
        $this->db->where('admin_id',$admin_id);
        $query= $this->db->update('hospitaladmins',$data);
       if($query)
       {
        $this->crud_model->update_modified_info('hospitaladmins','admin_id',$admin_id);
        if($_FILES['userfile']['tmp_name']!=''){
            unlink('uploads/hospitaladmin_image/'. $admin_id.  '.jpg');
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/hospitaladmin_image/'. $admin_id.  '.jpg');
        }
           
       }
    }
    function delete_hospitaladmins_info($admin_id)
    {
        $data['row_status_cd']    = '0';
        $this->db->where('admin_id',$admin_id);
        $this->db->update('hospitaladmins',$data);
    }
    function delete_multiple_hospital_admins_info()
    {
        $check=$_POST['check'];
        for($i=0;$i<count($check);$i++){
        $data['row_status_cd']    = '0';
        $this->db->where('admin_id',$check[$i]);
        $this->db->update('hospitaladmins',$data);
        }
    }

    /*DOCTORS MANAGEMENT*/
    function save_doctor_info()
    {
        $data['name']       = $this->input->post('fname');
        $data['mname']      = $this->input->post('mname');
        $data['lname']      = $this->input->post('lname');
        $data['description']        = $this->input->post('description');
        $data['email']      = $this->input->post('email');
        $data['address']    = $this->input->post('address');
        if($this->input->post('longitude')!=''){
        $data['longitude']    = $this->input->post('longitude');
        }
        if($this->input->post('latitude')!=''){
        $data['latitude']    = $this->input->post('latitude');
        }
        $data['phone']          = $this->input->post('mobile');
        $data['hospital_id']    = $this->input->post('hospital');
        $data['branch_id']  = $this->input->post('branch');
        $data['department_id']  = $this->input->post('department');
        $data['gender']     = $this->input->post('gender');
        if($this->input->post('dob')!=''){
        $data['dob']    = date('Y-m-d',strtotime($this->input->post('dob')));
        }
        $data['qualification']  = $this->input->post('qualification');
        if($this->input->post('specializations')!=''){
         $data['specializations']   = implode(',',$this->input->post('specializations'));
     }
          $data['experience']   = $this->input->post('experience');
          $data['registration']   = $this->input->post('registration');
          if($this->input->post('country')!=''){
          $data['country_id']    = $this->input->post('country');
      }
      if($this->input->post('state')!=''){
        $data['state_id']    = $this->input->post('state');
    }
    if($this->input->post('district')!=''){
        $data['district_id']    = $this->input->post('district'); 
        }
        if($this->input->post('city')!=''){ 
        $data['city_id']    = $this->input->post('city');
    }
        $insert=$this->db->insert('doctors',$data);
        
        if($insert)
        {
$lid=$this->db->insert_id();
$this->crud_model->update_created_info('doctors','doctor_id',$lid);
$pid=$this->crud_model->generate_unique_id($lid,'doctors');
$this->db->where('doctor_id',$lid)->update('doctors',array('unique_id'=>$pid,'modified_at'=>date('Y-m-d H:i:s')));
move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/doctor_image/" . $lid . '.jpg');
    }
    }
     function update_doctor_info($doctor_id)
    {           
        $check_email=$this->db->get_where('doctors',array('doctor_id'=>$doctor_id))->row();
        if($check_email->email!=$this->input->post('email')){
        $this->email_model->account_reverification_email('doctors','doctor',$check_email->unique_id);
        }
        $data['name']       = $this->input->post('fname');
        $data['mname']      = $this->input->post('mname');
        $data['lname']      = $this->input->post('lname');
        $data['description']        = $this->input->post('description');
        $data['email']      = $this->input->post('email');
        $data['address']    = $this->input->post('address');
        if($this->input->post('longitude')!=''){
        $data['longitude']    = $this->input->post('longitude');
        }
        if($this->input->post('latitude')!=''){
        $data['latitude']    = $this->input->post('latitude');
        }
        $data['phone']          = $this->input->post('mobile');
        $data['hospital_id']    = $this->input->post('hospital');
        $data['branch_id']  = $this->input->post('branch');
        $data['department_id']  = $this->input->post('department');
        $data['row_status_cd']     = $this->input->post('status');
        $data['gender']     = $this->input->post('gender');
        if($this->input->post('dob')!=''){
        $data['dob']    = date('Y-m-d',strtotime($this->input->post('dob')));
        }
        $data['qualification']  = $this->input->post('qualification');
        if($this->input->post('specializations')!=''){
         $data['specializations']   = implode(',', $this->input->post('specializations'));
        }
        $data['experience']   = $this->input->post('experience');
        $data['registration']   = $this->input->post('registration');
        if($this->input->post('country')!=''){
          $data['country_id']    = $this->input->post('country');
      }
      if($this->input->post('state')!=''){
        $data['state_id']    = $this->input->post('state');
    }
    if($this->input->post('district')!=''){
        $data['district_id']    = $this->input->post('district'); 
        }
        if($this->input->post('city')!=''){ 
        $data['city_id']    = $this->input->post('city');
    }
        $this->db->where('doctor_id',$doctor_id);
        $this->db->update('doctors',$data);
        $this->crud_model->update_modified_info('doctors','doctor_id',$doctor_id);
        if($_FILES['userfile']['tmp_name']!=''){
        unlink('uploads/doctor_image/'. $doctor_id.  '.jpg');
        move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/doctor_image/" . $doctor_id . '.jpg');
        }
    }  
    function select_doctor_info_table($hospital_id = '')
    {
    $account_type=$this->session->userdata('login_type');
if($account_type == 'superadmin'){
  return $this->db->select('name,email,unique_id,specializations,doctor_id,row_status_cd,email_verify,hospital_id,branch_id,department_id')->get('doctors')->result_array();
}elseif($account_type == 'hospitaladmins'){
  return $this->db->select('name,email,unique_id,specializations,doctor_id,row_status_cd,email_verify,hospital_id,branch_id,department_id')->where('hospital_id',$this->session->userdata('hospital_id'))->get('doctors')->result_array();
    }
    }
    function select_doctor_info($hospital_id = '')
    {
$account_type=$this->session->userdata('login_type');
if($account_type == 'superadmin'){
  return $this->db->select('name,email,unique_id,specializations,doctor_id,row_status_cd,email_verify,hospital_id,branch_id,department_id')->get_where('doctors',array('row_status_cd'=>'1'))->result_array();
}elseif($account_type == 'hospitaladmins'){
  return $this->db->select('name,email,unique_id,specializations,doctor_id,row_status_cd,email_verify,hospital_id,branch_id,department_id')->where('hospital_id',$this->session->userdata('hospital_id'))->get_where('doctors',array('row_status_cd'=>'1'))->result_array();
}elseif($account_type == 'nurse'){
  $doc=$this->db->where('nurse_id',$this->session->userdata('login_user_id'))->get('nurse')->row()->doctor_id;
  $doc_id=explode(',', $doc);
  if($doc_id!=''){
  for($i=0;$i<count($doc_id);$i++){
    $doct=$this->db->select('name,email,unique_id,specializations,doctor_id,row_status_cd,email_verify,hospital_id,branch_id,department_id')->where('doctor_id',$doc_id[$i])->get_where('doctors',array('row_status_cd'=>'1'));
    if($doct->num_rows()>0){
        $doctors[$i]=$doct->row_array();
    }
  }
  return $doctors;
}
}elseif($account_type == 'receptionist'){
  $doc=$this->db->where('receptionist_id',$this->session->userdata('login_user_id'))->get('receptionist')->row()->doctor_id;
  $doc_id=explode(',', $doc);
  for($i=0;$i<count($doc_id);$i++){
    $doct=$this->db->select('name,email,unique_id,specializations,doctor_id,row_status_cd,email_verify,hospital_id,branch_id,department_id')->where('doctor_id',$doc_id[$i])->get_where('doctors',array('row_status_cd'=>'1'));
    if($doct->num_rows()>0){
        $doctors[$i]=$doct->row_array();
    }
  }
  return $doctors;
}elseif($account_type == 'users'){
$doctor=$this->db->where('user_id',$this->session->userdata('login_user_id'))->get('patient')->row();
        if($doctor>0){
        $doctor_ids=explode(',',$doctor->doctor_ids);
        for($i=0;$i<count($doctor_ids);$i++){
            if($doctor_ids[$i]!=''){
            $doct=$this->db->select('name,email,unique_id,specializations,doctor_id,row_status_cd,email_verify,hospital_id,branch_id,department_id')->where('doctor_id',$doctor_ids[$i])->get_where('doctors',array('row_status_cd'=>'1'));
        if($doct->num_rows()>0){
        $doctors[$i]=$doct->row_array();
        }
            }
        }
        }
        return $doctors;
    }
    }
    function delete_doctor_info($doctor_id)
    {
        $data['row_status_cd']    = '0';
        $this->db->where('doctor_id',$doctor_id);
        $this->db->update('doctors',$data);
    }
    function delete_multiple_doctor_info()
    {
        $check=$_POST['check'];
        for($i=0;$i<count($check);$i++){
            $data['row_status_cd']    = '0';
            $this->db->where('doctor_id',$check[$i]);
            $this->db->update('doctors',$data);
        }
    }
    function select_doctor_info_id($doctor_id)
    {
        return $this->db->where('doctor_id',$doctor_id)->get_where('doctors',array('row_status_cd'=>'1'))->row_array();
    }
    function select_doctors_info_by_branch_id($branch_id){
       return $this->db->where('branch_id',$branch_id)->get_where('doctors',array('row_status_cd'=>'1'))->result_array();
    }
    function select_doctors_info_by_department_id($department_id){
       return $this->db->where('department_id',$department_id)->get_where('doctors',array('row_status_cd'=>'1'))->result_array();
    }
    function update_doctor_availability_info($doctor_id)
    {
        $data['message']        = $this->input->post('message');
        $data['no_appt_handle']         = $this->input->post('no_appt_handle');
        $check=$this->db->where('doctor_id',$doctor_id)->get('availability')->num_rows();
        if($check>0){
        $this->db->where('doctor_id',$doctor_id);
        $data=$this->db->update('availability',$data);
        $this->crud_model->update_modified_info('availability','doctor_id',$doctor_id);
        }else{
            $data['doctor_id']      = $doctor_id;
            $data=$this->db->insert('availability',$data);
            $lid=$this->db->insert_id();
            $this->crud_model->update_created_info('availability','doctor_id',$lid);
        }    
        return $data;
    }
    function update_doctor_new_availability_info($doctor_id)
    {
$start = new DateTime($this->input->post('start_on'));
$end = (new DateTime($this->input->post('end_on')))->modify('+1 day');
$interval = new DateInterval('P1D');
$period   = new DatePeriod($start, $interval, $end);
if($this->input->post('repeat_interval') == 0){
        $day=$this->input->post('repeat_on');
        $data['repeat_on']      = implode(',',$this->input->post('repeat_on'));
        }elseif($this->input->post('repeat_interval') == 1){
        $day= array('0','1','2','3','4','5','6');
        $data['repeat_on']      = '0,1,2,3,4,5,6';
        }
$days=array(0=>'Sun',1=>'Mon',2=>'Tue',3=>'Wed',4=>'Thu',5=>'Fri',6=>'Sat');
$unik=$this->crud_model->get_last_unique_id('availability_slot');
if($unik==0){
$shuffel='1'.date('y');
}else{
$unique=substr($unik,-2);
if(date('y')==$unique){
$unik1=substr($unik,0,-2)+1;
}else{
$unik1=1;
}
$shuffel=$unik1.date('y');
}
foreach ($period as $dt) {
$data['unik']=$shuffel;
$data['date']=$dt->format("Y-m-d");
$data['doctor_id']= $doctor_id;
$data['start_date']= date("Y-m-d", strtotime($this->input->post('start_on')));
$data['end_date']= date("Y-m-d", strtotime($this->input->post('end_on')));
$data['start_time']= date("H:i", strtotime($this->input->post('time_start').':'.$this->input->post('time_start_min').' '.$this->input->post('starting_ampm')));
$data['end_time']= date("H:i", strtotime($this->input->post('time_end').':'.$this->input->post('time_end_min').' '.$this->input->post('ending_ampm')));
$data['repeat_interval']= $this->input->post('repeat_interval');
$data['row_status_cd']=2;
for($i=0;$i<count($day);$i++){
for($j=0;$j<count($days);$j++){
    if($dt->format("D")==$days[$j] && $day[$i]==$j){
        $data['row_status_cd']=1;
    }
    }
    }
   $que=$this->db->insert('availability_slot',$data);
   $lid=$this->db->insert_id();
   $this->crud_model->update_created_info('availability_slot','id',$lid);
   $this->crud_model->update_last_unique_id('availability_slot',$shuffel);
    }
        return $que;
    }
function update_doc_availability_info($id)
    {
if($this->input->post('existDays')!='' && $this->input->post('existDays')=='yes'){
    $del_data['row_status_cd']='0';          
  $this->db->where('unik',$this->input->post('unik'))->update('availability_slot',$del_data);
$start    = new DateTime($this->input->post('start_on'));
$end      = (new DateTime($this->input->post('end_on')))->modify('+1 day');
$interval = new DateInterval('P1D');
$period   = new DatePeriod($start, $interval, $end);
if($this->input->post('repeat_interval') == 0){
        $day=$this->input->post('repeat_on');
        $data['repeat_on']      = implode(',',$this->input->post('repeat_on'));
        }elseif($this->input->post('repeat_interval') == 1){
        $day= array('0','1','2','3','4','5','6');
        $data['repeat_on']      = '0,1,2,3,4,5,6';
        }

$days=array(0=>'Sun',1=>'Mon',2=>'Tue',3=>'Wed',4=>'Thu',5=>'Fri',6=>'Sat');
$unik=$this->crud_model->get_last_unique_id('availability_slot');
if($unik==0){
$shuffel='1'.date('y');
}else{
$unique=substr($unik,-2);
if(date('y')==$unique){
$unik1=substr($unik,0,-2)+1;
}else{
$unik1=1;
}
$shuffel=$unik1.date('y');
}
foreach ($period as $dt) {
$data['unik']=$shuffel; 
$data['date']=$dt->format("Y-m-d");
$data['doctor_id']      = $this->input->post('doctor_id');
$data['start_date']         = date("Y-m-d", strtotime($this->input->post('start_on')));
$data['end_date']       = date("Y-m-d", strtotime($this->input->post('end_on')));
$data['start_time']         = date("H:i", strtotime($this->input->post('time_start').':'.$this->input->post('time_start_min').' '.$this->input->post('starting_ampm')));
$data['end_time']       = date("H:i", strtotime($this->input->post('time_end').':'.$this->input->post('time_end_min').' '.$this->input->post('ending_ampm')));
$data['repeat_interval']        = $this->input->post('repeat_interval');
$data['row_status_cd']=2;
for($i=0;$i<count($day);$i++){
for($j=0;$j<count($days);$j++){
    if($dt->format("D")==$days[$j] && $day[$i]==$j){
        $data['row_status_cd']=1;
    }
    }
    }
$que=$this->db->insert('availability_slot',$data);
$lid=$this->db->insert_id();
$this->crud_model->update_created_info('availability_slot','id',$lid);
$this->crud_model->update_last_unique_id('availability_slot',$shuffel);
    }
    return $que;
        }else{
        $data['start_time']         = date("H:i", strtotime($this->input->post('time_start').':'.$this->input->post('time_start_min').' '.$this->input->post('starting_ampm')));
        $data['end_time']       = date("H:i", strtotime($this->input->post('time_end').':'.$this->input->post('time_end_min').' '.$this->input->post('ending_ampm')));
            $que=$this->db->where('id',$id)->update('availability_slot',$data);
            $this->crud_model->update_modified_info('availability_slot','id',$id);
            return $que;
        }
        
    }
    function delete_doc_availability_info($id){
        $data['row_status_cd']='0';
        return $this->db->where('id',$id)->update('availability_slot',$data);
    }
    function delete_all_doc_availability_info($id){
        $data['row_status_cd']='0';
        return $this->db->where('unik',$this->db->where('id',$id)->get('availability_slot')->row()->unik)->update('availability_slot',$data);
    }
    /*RECEPTIONIST MANAGEMENT*/
    function save_receptionist_info()
    {
        $data['name']       = $this->input->post('fname');
        $data['mname']      = $this->input->post('mname');
        $data['lname']      = $this->input->post('lname');
        $data['description']        = $this->input->post('description');
        $data['email']      = $this->input->post('email');
        $data['address']    = $this->input->post('address');
        if($this->input->post('longitude')!=''){
        $data['longitude']    = $this->input->post('longitude');
        }
        if($this->input->post('latitude')!=''){
        $data['latitude']    = $this->input->post('latitude');
        }
        $data['phone']          = $this->input->post('mobile');
        $data['hospital_id']    = $this->input->post('hospital');
        $data['branch_id']  = $this->input->post('branch');
        $data['department_id']  = $this->input->post('department');
        $data['row_status_cd']     = $this->input->post('status');
        $data['gender']     = $this->input->post('gender');
       if($this->input->post('dob')!=''){
        $data['dob']    = date('Y-m-d',strtotime($this->input->post('dob')));
        }
        $data['qualification']  = $this->input->post('qualification');
        $data['experience']     = $this->input->post('experience');
        $data['doctor_id']  = implode(',',$this->input->post('doctor'));
        if($this->input->post('country')!=''){
          $data['country_id']    = $this->input->post('country');
      }
      if($this->input->post('state')!=''){
        $data['state_id']    = $this->input->post('state');
    }
    if($this->input->post('district')!=''){
        $data['district_id']    = $this->input->post('district'); 
        }
        if($this->input->post('city')!=''){ 
        $data['city_id']    = $this->input->post('city');
    }
        $insert=$this->db->insert('receptionist',$data);
        if($insert)
        {
          $lid=$this->db->insert_id();
        $this->crud_model->update_created_info('receptionist','receptionist_id',$lid);
$pid=$this->crud_model->generate_unique_id($lid,'receptionist');
            $this->db->where('receptionist_id',$lid)->update('receptionist',array('unique_id'=>$pid,'modified_at'=>date('Y-m-d H:i:s')));
        move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/receptionist_image/" . $lid . '.jpg');
   }
   }
    function update_receptionist_info($receptionist_id)
    {
        $check_email=$this->db->get_where('receptionist',array('receptionist_id'=>$receptionist_id))->row();
        if($check_email->email!=$this->input->post('email')){
        $this->email_model->account_reverification_email('receptionist','receptionist',$check_email->unique_id);
        }
        $data['name']       = $this->input->post('fname');
        $data['mname']      = $this->input->post('mname');
        $data['lname']      = $this->input->post('lname');
        $data['description']        = $this->input->post('description');
        $data['email']      = $this->input->post('email');
        $data['doctor_id']  = implode(',',$this->input->post('doctor'));
        $data['address']    = $this->input->post('address');
        if($this->input->post('longitude')!=''){
        $data['longitude']    = $this->input->post('longitude');
        }
        if($this->input->post('latitude')!=''){
        $data['latitude']    = $this->input->post('latitude');
        }
        $data['phone']          = $this->input->post('mobile');
        $data['hospital_id']    = $this->input->post('hospital');
        $data['branch_id']  = $this->input->post('branch');
        $data['department_id']  = $this->input->post('department');
        $data['row_status_cd']     = $this->input->post('status');
        $data['gender']     = $this->input->post('gender');
        if($this->input->post('dob')!=''){
        $data['dob']    = date('Y-m-d',strtotime($this->input->post('dob')));
        }
        $data['aadhar']     = $this->input->post('aadhar');
        $data['qualification']  = $this->input->post('qualification');
        $data['experience']     = $this->input->post('experience');
        $data['doctor_id']  = implode(',',$this->input->post('doctor'));
        $data['modified_at']=date('Y-m-d H:i:s');
        if($this->input->post('country')!=''){
          $data['country_id']    = $this->input->post('country');
      }
      if($this->input->post('state')!=''){
        $data['state_id']    = $this->input->post('state');
    }
    if($this->input->post('district')!=''){
        $data['district_id']    = $this->input->post('district'); 
        }
        if($this->input->post('city')!=''){ 
        $data['city_id']    = $this->input->post('city');
    }
        $this->db->where('receptionist_id',$receptionist_id);
        $this->db->update('receptionist',$data);
        $this->crud_model->update_modified_info('receptionist','receptionist_id',$receptionist_id);
        if($_FILES['userfile']['tmp_name']!=''){
        unlink('uploads/receptionist_image/'. $receptionist_id.  '.jpg');
        move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/receptionist_image/" . $receptionist_id . '.jpg');
        }
    }
    function delete_receptionist_info($receptionist_id)
    {
        $data['row_status_cd']    = '0';
        $this->db->where('receptionist_id',$receptionist_id);
        $this->db->update('receptionist',$data);
    }
     function delete_multiple_receptionist_info()
    {
        $check=$_POST['check'];
        for($i=0;$i<count($check);$i++){
        $data['row_status_cd']    = '0';
        $this->db->where('receptionist_id',$check[$i]);
        $this->db->update('receptionist',$data);
        }
    }
     function select_receptionist_info_table($hospital_id='')
    {
$account_type=$this->session->userdata('login_type');
if($account_type == 'superadmin'){
  return $this->db->select('name,email,unique_id,receptionist_id,row_status_cd,email_verify,hospital_id,branch_id,department_id')->order_by('receptionist_id','DESC')->get('receptionist')->result_array();
}elseif($account_type == 'hospitaladmins'){
  return $this->db->select('name,email,unique_id,receptionist_id,row_status_cd,email_verify,hospital_id,branch_id,department_id')->order_by('receptionist_id','DESC')->where('hospital_id',$this->session->userdata('hospital_id'))->get('receptionist')->result_array();
}
}
    function select_receptionist_info($hospital_id='')
    {
$account_type=$this->session->userdata('login_type');
if($account_type == 'superadmin'){
  return $this->db->select('name,email,unique_id,receptionist_id,row_status_cd,email_verify,hospital_id,branch_id,department_id')->order_by('receptionist_id','DESC')->get_where('receptionist',array('row_status_cd'=>'1'))->result_array();
}elseif($account_type == 'hospitaladmins'){
  return $this->db->select('name,email,unique_id,receptionist_id,row_status_cd,email_verify,hospital_id,branch_id,department_id')->order_by('receptionist_id','DESC')->where('hospital_id',$this->session->userdata('hospital_id'))->get_where('receptionist',array('row_status_cd'=>'1'))->result_array();
}elseif($account_type == 'doctors'){
    $receptionist=$this->db->select('name,email,unique_id,receptionist_id,row_status_cd,email_verify,hospital_id,branch_id,department_id,doctor_id')->where('branch_id',$this->session->userdata('branch_id'))->order_by('receptionist_id','DESC')->get_where('receptionist',array('row_status_cd'=>'1'))->result_array();
    for($i=0;$i<count($receptionist);$i++){
        $rec=explode(',',$receptionist[$i]['doctor_id']);
        for($j=0;$j<count($rec);$j++){
            if($rec[$j] == $this->session->userdata('login_user_id')){
             $recep[$i]=$receptionist[$i];
            }
        }
  }
  return $recep;
}
}
    /*NURSE MANAGEMENT*/
    function save_nurse_info()
    {
        $data['name']       = $this->input->post('fname');
        $data['mname']      = $this->input->post('mname');
        $data['lname']      = $this->input->post('lname');
        $data['description']        = $this->input->post('description');
        $data['email']      = $this->input->post('email');
        $data['address']    = $this->input->post('address');
        if($this->input->post('longitude')!=''){
        $data['longitude']    = $this->input->post('longitude');
        }
        if($this->input->post('latitude')!=''){
        $data['latitude']    = $this->input->post('latitude');
        }
        $data['phone']          = $this->input->post('mobile');
        $data['hospital_id']    = $this->input->post('hospital');
        $data['branch_id']  = $this->input->post('branch');
        $data['department_id']  = $this->input->post('department');
        $data['doctor_id']  = implode(',',$this->input->post('doctor'));
        $data['row_status_cd']     = $this->input->post('status');
        $data['gender']     = $this->input->post('gender');
        if($this->input->post('dob')!=''){
        $data['dob']    = date('Y-m-d',strtotime($this->input->post('dob')));
        }
        $data['qualification']  = $this->input->post('qualification');
        $data['experience']     = $this->input->post('experience');
        if($this->input->post('country')!=''){
          $data['country_id']    = $this->input->post('country');
      }
      if($this->input->post('state')!=''){
        $data['state_id']    = $this->input->post('state');
    }
    if($this->input->post('district')!=''){
        $data['district_id']    = $this->input->post('district'); 
        }
        if($this->input->post('city')!=''){ 
        $data['city_id']    = $this->input->post('city');
    }
       $insert= $this->db->insert('nurse',$data);
        if($insert)
        {
    $lid=$this->db->insert_id();
    $this->crud_model->update_created_info('nurse','nurse_id',$lid);
$pid=$this->crud_model->generate_unique_id($lid,'nurse');
            $this->db->where('nurse_id',$lid)->update('nurse',array('unique_id'=>$pid,'modified_at'=>date('Y-m-d H:i:s')));
        move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/nurse_image/" . $lid . '.jpg');
    }
    }
    function update_nurse_info($nurse_id)
    {
        $check_email=$this->db->get_where('nurse',array('nurse_id'=>$nurse_id))->row();
        if($check_email->email!=$this->input->post('email')){
        $this->email_model->account_reverification_email('nurse','nurse',$check_email->unique_id);
        }
        $data['name']       = $this->input->post('fname');
        $data['mname']      = $this->input->post('mname');
        $data['lname']      = $this->input->post('lname');
        $data['description']        = $this->input->post('description');
        $data['email']      = $this->input->post('email');
        $data['address']    = $this->input->post('address');
        if($this->input->post('longitude')!=''){
        $data['longitude']    = $this->input->post('longitude');
        }
        if($this->input->post('latitude')!=''){
        $data['latitude']    = $this->input->post('latitude');
        }
        $data['phone']          = $this->input->post('mobile');
        $data['hospital_id']    = $this->input->post('hospital');
        $data['branch_id']  = $this->input->post('branch');
        $data['department_id']  = $this->input->post('department');
        $data['doctor_id']  = implode(',',$this->input->post('doctor'));
        $data['row_status_cd']     = $this->input->post('status');
        $data['gender']     = $this->input->post('gender');
        if($this->input->post('dob')!=''){
        $data['dob']    = date('Y-m-d',strtotime($this->input->post('dob')));
        }
        $data['aadhar']     = $this->input->post('aadhar');
        $data['qualification']  = $this->input->post('qualification');
        $data['experience']     = $this->input->post('experience');
        if($this->input->post('country')!=''){
          $data['country_id']    = $this->input->post('country');
      }
      if($this->input->post('state')!=''){
        $data['state_id']    = $this->input->post('state');
    }
    if($this->input->post('district')!=''){
        $data['district_id']    = $this->input->post('district'); 
        }
        if($this->input->post('city')!=''){ 
        $data['city_id']    = $this->input->post('city');
    }
        $this->db->where('nurse_id',$nurse_id);
        $this->db->update('nurse',$data);
        $this->crud_model->update_modified_info('nurse','nurse_id',$nurse_id);
        if($_FILES['userfile']['tmp_name']!=''){
        unlink('uploads/nurse_image/'. $nurse_id.  '.jpg');
        move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/nurse_image/" . $nurse_id . '.jpg');
        }
    }
    
    function delete_nurse_info($nurse_id)
    {
        $data['row_status_cd']    = '0';
        $this->db->where('nurse_id',$nurse_id);
        $this->db->update('nurse',$data);
    }
    function delete_multiple_nurse_info()
    {
        $check=$_POST['check'];
        for($i=0;$i<count($check);$i++){
        $data['row_status_cd']    = '0';
        $this->db->where('nurse_id',$check[$i]);
        $this->db->update('nurse',$data);
        }
    }
    function select_nurse_info_table($hospital_id='')
    {
        $account_type=$this->session->userdata('login_type');
        if($account_type == 'superadmin'){
  return $this->db->select('name,email,unique_id,nurse_id,row_status_cd,email_verify,hospital_id,branch_id,department_id')->get('nurse')->result_array();
}elseif($account_type == 'hospitaladmins'){
  return $this->db->select('name,email,unique_id,nurse_id,row_status_cd,email_verify,hospital_id,branch_id,department_id')->where('hospital_id',$this->session->userdata('hospital_id'))->get('nurse')->result_array();
}
}
    function select_nurse_info($hospital_id='')
    {
        $account_type=$this->session->userdata('login_type');
        if($account_type == 'superadmin'){
  return $this->db->select('name,email,unique_id,nurse_id,row_status_cd,email_verify,hospital_id,branch_id,department_id')->get_where('nurse',array('row_status_cd'=>'1'))->result_array();
}elseif($account_type == 'hospitaladmins'){
  return $this->db->select('name,email,unique_id,nurse_id,row_status_cd,email_verify,hospital_id,branch_id,department_id')->where('hospital_id',$this->session->userdata('hospital_id'))->get_where('nurse',array('row_status_cd'=>'1'))->result_array();
}elseif($account_type == 'doctors'){
    $nurse=$this->db->select('name,email,unique_id,nurse_id,row_status_cd,email_verify,hospital_id,branch_id,department_id,doctor_id')->where('branch_id',$this->session->userdata('branch_id'))->get_where('nurse',array('row_status_cd'=>'1'))->result_array();
    for($i=0;$i<count($nurse);$i++){
        $nu=explode(',',$nurse[$i]['doctor_id']);
        for($j=0;$j<count($nu);$j++){
            if($nu[$j] == $this->session->userdata('login_user_id')){
             $nurs[$i]=$nurse[$i];
            }
        }
  }
  return $nurs;
}
    }
    /*MEDICAL STORES MANAGEMENT*/
    function save_medicalstores_info()
    {
        $data['name']         = $this->input->post('name');
        $data['description']      = $this->input->post('description');
        $data['address']        = $this->input->post('address');
        if($this->input->post('longitude')!=''){
        $data['longitude']    = $this->input->post('longitude');
        }
        if($this->input->post('latitude')!=''){
        $data['latitude']    = $this->input->post('latitude');
        }
        $data['phone']    = $this->input->post('phone_number');
        $data['owner_name']    = $this->input->post('owner_name');   
        $data['owner_mobile']    = $this->input->post('owner_mobile');
        $data['hospital_id']    = $this->input->post('hospital');
        $data['row_status_cd']    = $this->input->post('status');
        $data['branch_id']    = $this->input->post('branch');
        $data['fname']    = $this->input->post('fname');
        $data['lname']    = $this->input->post('lname');
        $data['email']    = $this->input->post('email');
        $data['gender']    = $this->input->post('gender');
        if($this->input->post('dob')!=''){
        $data['dob']    = date('Y-m-d',strtotime($this->input->post('dob')));
        }
        $data['in_address']    = $this->input->post('in_address');
        if($this->input->post('country')!=''){
          $data['country_id']    = $this->input->post('country');
      }
      if($this->input->post('state')!=''){
        $data['state_id']    = $this->input->post('state');
    }
    if($this->input->post('district')!=''){
        $data['district_id']    = $this->input->post('district'); 
        }
        if($this->input->post('city')!=''){ 
        $data['city_id']    = $this->input->post('city');
    }
        $data['experience']    = $this->input->post('experience');
        $data['qualification']    = $this->input->post('qualification');
       $insert=$this->db->insert('medicalstores',$data); 
        if($insert)
        {
            $lid=$this->db->insert_id();
    $this->crud_model->update_created_info('medicalstores','store_id',$lid);
$pid=$this->crud_model->generate_unique_id($lid,'medicalstores');
            $this->db->where('store_id',$lid)->update('medicalstores',array('unique_id'=>$pid,'modified_at'=>date('Y-m-d H:i:s')));
           move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/medical_stores/'. $lid.  '.jpg');
       
   } 
    }
    
    
      function update_medicalstores_info($patient_id)
    {
        $check_email=$this->db->get_where('medicalstores',array('store_id'=>$patient_id))->row();
        if($check_email->email!=$this->input->post('email')){
        $this->email_model->account_reverification_email('medicalstores','store',$check_email->unique_id);
        }
        $data['name']         = $this->input->post('name');
        $data['description']      = $this->input->post('description');
        $data['address']        = $this->input->post('address');
        if($this->input->post('longitude')!=''){
        $data['longitude']    = $this->input->post('longitude');
        }
        if($this->input->post('latitude')!=''){
        $data['latitude']    = $this->input->post('latitude');
        }
        $data['phone']    = $this->input->post('phone_number');
        $data['owner_name']    = $this->input->post('owner_name');   
        $data['owner_mobile']    = $this->input->post('owner_mobile');
        $data['hospital_id']    = $this->input->post('hospital');
        $data['branch_id']    = $this->input->post('branch');
        $data['fname']    = $this->input->post('fname');
        $data['lname']    = $this->input->post('lname');
        $data['email']    = $this->input->post('email');  
        $data['aadhar']    = $this->input->post('aadhar');
        $data['gender']    = $this->input->post('gender');
        if($this->input->post('dob')!=''){
        $data['dob']    = date('Y-m-d',strtotime($this->input->post('dob')));
        }
        $data['in_address']    = $this->input->post('in_address');
        if($this->input->post('country')!=''){
          $data['country_id']    = $this->input->post('country');
      }
      if($this->input->post('state')!=''){
        $data['state_id']    = $this->input->post('state');
    }
    if($this->input->post('district')!=''){
        $data['district_id']    = $this->input->post('district'); 
        }
        if($this->input->post('city')!=''){ 
        $data['city_id']    = $this->input->post('city');
    }
        $data['experience']    = $this->input->post('experience');
        $data['qualification']    = $this->input->post('qualification');
        $this->db->where('store_id',$patient_id);
        $query= $this->db->update('medicalstores',$data);
        $this->crud_model->update_created_info('medicalstores','store_id',$patient_id);
       if($query)
       {
        if($_FILES['userfile']['tmp_name']!=''){
        unlink('uploads/medical_stores/'. $patient_id.  '.jpg');
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/medical_stores/'. $patient_id.  '.jpg');
        }  
       }
    }
     function delete_store_info($store_id)
    {
        $data['row_status_cd']    = '0';
        $this->db->where('store_id',$store_id);
        $this->db->update('medicalstores',$data);
    }
    
     function delete_multiple_store_info()
    {
        $check=$_POST['check'];
        for($i=0;$i<count($check);$i++){
        $data['row_status_cd']    = '0';
        $this->db->where('store_id',$check[$i]);
        $this->db->update('medicalstores',$data);
        }
    }
    function select_store_info_table($hospital_id='')
    {
    $account_type=$this->session->userdata('login_type');
    if($account_type == 'superadmin'){
    return $this->db->select('name,email,unique_id,store_id,row_status_cd,email_verify,hospital_id,branch_id,owner_name,owner_mobile')->get('medicalstores')->result_array();
    }elseif($account_type == 'hospitaladmins'){
  return $this->db->select('name,email,unique_id,store_id,row_status_cd,email_verify,hospital_id,branch_id,owner_name,owner_mobile')->where('hospital_id',$this->session->userdata('hospital_id'))->get('medicalstores')->result_array();
    }
    }
    function select_store_info_by_hospital_id($hospital_id){
       return $this->db->where('hospital_id',$hospital_id)->get('medicalstores')->result_array();
    }
     function select_store_info($hospital_id='')
    {
    $account_type=$this->session->userdata('login_type');
    if($account_type == 'superadmin'){
  return $this->db->select('name,email,unique_id,store_id,row_status_cd,email_verify,hospital_id,branch_id,owner_name,owner_mobile')->get_where('medicalstores',array('row_status_cd'=>'1'))->result_array();
}elseif($account_type == 'hospitaladmins'){
  return $this->db->select('name,email,unique_id,store_id,row_status_cd,email_verify,hospital_id,branch_id,owner_name,owner_mobile')->where('hospital_id',$this->session->userdata('hospital_id'))->get_where('medicalstores',array('row_status_cd'=>'1'))->result_array();
}elseif($account_type == 'users'){
        $store=$this->db->where('user_id',$this->session->userdata('login_user_id'))->get('patient')->row()->store_ids;
        
        if($store!=''){
            $store_ids=explode(',',$store);
        for($i=0;$i<count($store_ids);$i++){
            $stores[$i]=$this->db->select('name,email,unique_id,store_id,row_status_cd,email_verify,hospital_id,branch_id,owner_name,owner_mobile')->where('store_id',$store_ids[$i])->get_where('medicalstores',array('row_status_cd'=>'1'))->row_array();
            }
        }
    return $stores;

}
    }
    /*MEDICAL LABS MANAGEMENT*/
     function save_medicallabs_info()
    {
        $data['name']         = $this->input->post('name');
        $data['description']      = $this->input->post('description');
        $data['phone']    = $this->input->post('phone_number');
        $data['address']        = $this->input->post('address');
        if($this->input->post('longitude')!=''){
        $data['longitude']    = $this->input->post('longitude');
        }
        if($this->input->post('latitude')!=''){
        $data['latitude']    = $this->input->post('latitude');
        }
        $data['owner_name']    = $this->input->post('owner_name');   
        $data['owner_mobile']    = $this->input->post('owner_mobile');
        $data['hospital_id']    = $this->input->post('hospital');
        $data['row_status_cd']    = $this->input->post('status');
        $data['branch_id']    = $this->input->post('branch');
        $data['fname']    = $this->input->post('fname');
        $data['lname']    = $this->input->post('lname');
        $data['email']    = $this->input->post('email');  
        $data['in_mobile']    = $this->input->post('in_mobile');
        $data['aadhar']    = $this->input->post('aadhar');
          $data['gender']    = $this->input->post('gender');
            if($this->input->post('dob')!=''){
        $data['dob']    = date('Y-m-d',strtotime($this->input->post('dob')));
        }
             $data['in_address']    = $this->input->post('in_address');
             if($this->input->post('country')!=''){
          $data['country_id']    = $this->input->post('country');
      }
      if($this->input->post('state')!=''){
        $data['state_id']    = $this->input->post('state');
    }
    if($this->input->post('district')!=''){
        $data['district_id']    = $this->input->post('district'); 
        }
        if($this->input->post('city')!=''){ 
        $data['city_id']    = $this->input->post('city');
    }
            $data['experience']    = $this->input->post('experience');
             $data['qualification']    = $this->input->post('qualification');
            $data['created_at']=date('Y-m-d H:i:s');
        $data['modified_at']=date('Y-m-d H:i:s');
        
       $insert=$this->db->insert('medicallabs',$data); 
       if($insert)
        {
$lid=$this->db->insert_id();
$pid=$this->crud_model->generate_unique_id($lid,'medicallabs');
            $this->db->where('lab_id',$lid)->update('medicallabs',array('unique_id'=>$pid,'modified_at'=>date('Y-m-d H:i:s')));
           move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/medical_labs/'. $lid.  '.jpg');
      }  
    }
       function update_medicallabs_info($id)
    {
        $check_email=$this->db->get_where('medicallabs',array('lab_id'=>$id))->row();
        if($check_email->email!=$this->input->post('email')){
        $this->email_model->account_reverification_email('medicallabs','lab_id',$check_email->unique_id);
        }
        $data['name']         = $this->input->post('name');
        $data['description']      = $this->input->post('description');
        $data['address']        = $this->input->post('address');
        if($this->input->post('longitude')!=''){
        $data['longitude']    = $this->input->post('longitude');
        }
        if($this->input->post('latitude')!=''){
        $data['latitude']    = $this->input->post('latitude');
        }
        $data['phone']    = $this->input->post('phone_number');
        $data['owner_name']    = $this->input->post('owner_name');   
        $data['owner_mobile']    = $this->input->post('owner_mobile');
        if($this->input->post('country')!=''){
          $data['country_id']    = $this->input->post('country');
      }
      if($this->input->post('state')!=''){
        $data['state_id']    = $this->input->post('state');
    }
    if($this->input->post('district')!=''){
        $data['district_id']    = $this->input->post('district'); 
        }
        if($this->input->post('city')!=''){ 
        $data['city_id']    = $this->input->post('city');
    }
        $data['hospital_id']    = $this->input->post('hospital');
        $data['row_status_cd']    = $this->input->post('status');
        $data['branch_id']    = $this->input->post('branch');
        $data['fname']    = $this->input->post('fname');
        $data['lname']    = $this->input->post('lname');
        $data['email']    = $this->input->post('email');
        $data['gender']    = $this->input->post('gender');
        if($this->input->post('dob')!=''){
        $data['dob']    = date('Y-m-d',strtotime($this->input->post('dob')));
        }
        $data['in_address']    = $this->input->post('in_address');
        $data['experience']    = $this->input->post('experience');
        $data['qualification']    = $this->input->post('qualification');
        $this->db->where('lab_id',$id);
        $query= $this->db->update('medicallabs',$data);
        $this->crud_model->update_modified_info('medicallabs','lab_id',$id);
       if($query)
       {
        if($_FILES['userfile']['tmp_name']!=''){
        unlink('uploads/medical_labs/'. $id.  '.jpg');
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/medical_labs/'. $id.  '.jpg');
           }
       }
    }
     function delete_lab_info($lab_id)
    {
        $data['row_status_cd']    = '0';
        $this->db->where('lab_id',$lab_id);
        $this->db->update('medicallabs',$data);
    }
    
    function delete_multiple_lab_info()
    {
        $check=$_POST['check'];
        for($i=0;$i<count($check);$i++){
        $data['row_status_cd']    = '0';
        $this->db->where('lab_id',$check[$i]);
        $this->db->update('medicallabs',$data);
        }
    }
     function select_lab_info_table($hospital_id='')
    {
$account_type=$this->session->userdata('login_type');
if($account_type == 'superadmin'){
  return $this->db->select('name,email,unique_id,lab_id,row_status_cd,email_verify,hospital_id,branch_id,owner_name,owner_mobile')->get('medicallabs')->result_array();
}elseif($account_type == 'hospitaladmins'){
  return $this->db->select('name,email,unique_id,lab_id,row_status_cd,email_verify,hospital_id,branch_id,owner_name,owner_mobile')->where('hospital_id',$this->session->userdata('hospital_id'))->get('medicallabs')->result_array();
}
}
function select_lab_info_by_hospital_id($hospital_id){
       return $this->db->where('hospital_id',$hospital_id)->get('medicallabs')->result_array();
    }
     function select_lab_info($hospital_id='')
    {
           $account_type=$this->session->userdata('login_type');
    if($account_type == 'superadmin'){
  return $this->db->select('name,email,unique_id,lab_id,row_status_cd,email_verify,hospital_id,branch_id,owner_name,owner_mobile')->get_where('medicallabs',array('row_status_cd'=>'1'))->result_array();
}elseif($account_type == 'hospitaladmins'){
  return $this->db->select('name,email,unique_id,lab_id,row_status_cd,email_verify,hospital_id,branch_id,owner_name,owner_mobile')->where('hospital_id',$this->session->userdata('hospital_id'))->get_where('medicallabs',array('row_status_cd'=>'1'))->result_array();
}elseif($account_type == 'users'){
        $lab=$this->db->where('user_id',$this->session->userdata('login_user_id'))->get('patient')->row()->lab_ids;
        if($lab!=''){ 
        $lab_ids=explode(',',$lab);
        for($i=0;$i<count($lab_ids);$i++){
            $labs[$i]=$this->db->select('name,email,unique_id,lab_id,row_status_cd,email_verify,hospital_id,branch_id,owner_name,owner_mobile')->where('lab_id',$lab_ids[$i])->get_where('medicallabs',array('row_status_cd'=>'1'))->row_array();
            }
    return $labs;
}
}
    }
    /*MYPULSE USERS MANAGEMENT*/
    function save_unuser_info()
    {
        $data['name']       = $this->input->post('fname');
        $data['lname']      = $this->input->post('lname');
        if($this->input->post('email')!=''){
        $data['email']      = $this->input->post('email');
        }
        $data['phone']      = $this->input->post('mobile');
        $data['reg_status']= 2;
        $insert=$this->db->insert('users',$data);
        if($insert)
        {
$lid=$this->db->insert_id();
$this->crud_model->update_created_info('users','user_id',$lid);
$pid=$this->crud_model->generate_unique_id($lid,'users');
$this->db->where('user_id',$lid)->update('users',array('unique_id'=>$pid,'modified_at'=>date('Y-m-d H:i:s')));   
        }
        $patient_id  =   $this->db->insert_id();
        move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/user_image/" . $patient_id . '.jpg');
    }
    function save_user_info()
    {
        $data['name']       = $this->input->post('fname');
        $data['mname']      = $this->input->post('mname');
        $data['lname']      = $this->input->post('lname');
        if($this->input->post('email')!=''){
        $data['email']      = $this->input->post('email');
        }
        $data['description']       = $this->input->post('description');
        if($this->input->post('country')!=''){
          $data['country_id']    = $this->input->post('country');
      }
      if($this->input->post('state')!=''){
        $data['state_id']    = $this->input->post('state');
    }
    if($this->input->post('district')!=''){
        $data['district_id']    = $this->input->post('district'); 
        }
        if($this->input->post('city')!=''){ 
        $data['city_id']    = $this->input->post('city');
    }
        $data['address']    = $this->input->post('address');
        if($this->input->post('longitude')!=''){
        $data['longitude']    = $this->input->post('longitude');
        }
        if($this->input->post('latitude')!=''){
        $data['latitude']    = $this->input->post('latitude');
        }
        $data['phone']          = $this->input->post('mobile');
        $data['gender']            = $this->input->post('gender');
        if($this->input->post('dob')!=''){
        $data['dob']    = date('Y-m-d',strtotime($this->input->post('dob')));
        }
        $data['age']            = $this->input->post('age');
        $data['blood_group']    = $this->input->post('blood_group');
        $data['aadhar']     = $this->input->post('aadhar');
        $data['height']     = $this->input->post('height');
        $data['weight']     = $this->input->post('weight');
        $data['blood_pressure']     = $this->input->post('blood_pressure');
        $data['sugar_level']    = $this->input->post('sugar_level');
        $data['health_insurance_provider']  = $this->input->post('health_insurance_provider');
        $data['health_insurance_id']    = $this->input->post('health_insurance_id');
        $data['family_history']     = $this->input->post('family_history');
         $data['past_medical_history']  = $this->input->post('past_medical_history');
          $data['row_status_cd']   = $this->input->post('status');
        $insert=$this->db->insert('users',$data);
        if($insert)
        {
$lid=$this->db->insert_id();
$this->crud_model->update_created_info('users','user_id',$lid);
$pid=$this->crud_model->generate_unique_id($lid,'users');
$this->db->where('user_id',$lid)->update('users',array('unique_id'=>$pid,'modified_at'=>date('Y-m-d H:i:s')));
move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/user_image/" . $lid . '.jpg');
    }
}
function update_user_info($user_id)
    {
        $check_email=$this->db->get_where('users',array('user_id'=>$user_id))->row();
        if($check_email->email!=$this->input->post('email')){
        $this->email_model->account_reverification_email('users','user',$check_email->unique_id);
        }
        $data['name']      = $this->input->post('fname');
        $data['mname']      = $this->input->post('mname');
        $data['lname']      = $this->input->post('lname');
        if($this->input->post('email')!=''){
        $data['email']      = $this->input->post('email');
        }
        $data['description']       = $this->input->post('description');
        if($this->input->post('country')!=''){
          $data['country_id']    = $this->input->post('country');
      }
      if($this->input->post('state')!=''){
        $data['state_id']    = $this->input->post('state');
    }
    if($this->input->post('district')!=''){
        $data['district_id']    = $this->input->post('district'); 
        }
        if($this->input->post('city')!=''){ 
        $data['city_id']    = $this->input->post('city');
    }
        $data['address']    = $this->input->post('address');
        if($this->input->post('longitude')!=''){
        $data['longitude']    = $this->input->post('longitude');
        }
        if($this->input->post('latitude')!=''){
        $data['latitude']    = $this->input->post('latitude');
        }
        $data['phone']          = $this->input->post('mobile');
        $data['gender']            = $this->input->post('gender');
        if($this->input->post('dob')!=''){
        $data['dob']    = date('Y-m-d',strtotime($this->input->post('dob')));
        }
        $data['age']            = $this->input->post('age');
        $data['blood_group']    = $this->input->post('blood_group');
        $data['aadhar']     = $this->input->post('aadhar');
        $data['height']     = $this->input->post('height');
        $data['weight']     = $this->input->post('weight');
        $data['blood_pressure']     = $this->input->post('blood_pressure');
        $data['sugar_level']    = $this->input->post('sugar_level');
        $data['health_insurance_provider']  = $this->input->post('health_insurance_provider');
        $data['health_insurance_id']    = $this->input->post('health_insurance_id');
        $data['family_history']     = $this->input->post('family_history');
         $data['past_medical_history']  = $this->input->post('past_medical_history');
          $data['row_status_cd']   = $this->input->post('status');
        $this->db->where('user_id',$user_id);
        $this->db->update('users',$data);
        $this->crud_model->update_modified_info('users','user_id',$user_id);
        if($_FILES['userfile']['tmp_name']!=''){
        unlink('uploads/user_image/'. $user_id.  '.jpg');
        move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/user_image/" . $user_id . '.jpg');
    }
    }
    function user_update_info($user_id)
    {
        $data['age']            = $this->input->post('age');
        $data['blood_group']    = $this->input->post('blood_group');
        $data['height']     = $this->input->post('height');
        $data['weight']     = $this->input->post('weight');
        $data['blood_pressure']     = $this->input->post('blood_pressure');
        $data['sugar_level']    = $this->input->post('sugar_level');
        $data['health_insurance_provider']  = $this->input->post('health_insurance_provider');
        $data['health_insurance_id']    = $this->input->post('health_insurance_id');
        $data['family_history']     = $this->input->post('family_history');
         $data['past_medical_history']  = $this->input->post('past_medical_history');
        $data['modified_at']=date('Y-m-d H:i:s');
        $this->db->where('user_id',$user_id);
        $this->db->update('users',$data);
        $this->crud_model->update_modified_info('users','user_id',$user_id);
    }
    function delete_user_info($user_id)
    {
        $data['row_status_cd']    = '0';
        $this->db->where('user_id',$user_id);
        $this->db->update('users',$data);
    }
    function delete_multiple_user_info()
    {
        $check=$_POST['check'];
        for($i=0;$i<count($check);$i++){
        $data['row_status_cd']    = '0';
        $this->db->where('user_id',$check[$i]);
        $this->db->update('users',$data);
        }
    }
function select_user_unique_id($id)
    {
        return $this->db->get_where('users',array('user_id'=>$id))->row()->unique_id;
    }
    function select_users_info_table()
    {
$account_type=$this->session->userdata('login_type');
    if($account_type=='superadmin'){
        $this->db->select('name,email,unique_id,user_id,row_status_cd,email_verify');
        return $this->db->get('users')->result_array();
    }
if($account_type == 'hospitaladmins'){
$patient_info=$this->db->order_by('id','desc')->get('patient')->result_array();
foreach ($patient_info as $row){
                $hospital=explode(',',$row['hospital_ids']);
                for($ha1=0;$ha1<count($hospital);$ha1++){
            if($hospital[$ha1] == $this->session->userdata('hospital_id')){
            $users[]=$this->db->where('user_id',$row['user_id'])->get_where('users',array('row_status_cd'=>'1'))->row();
            }
            }
            }
            return $users;
    }
    }
    function select_user_info()
    {
        return $this->db->get_where('users',array('row_status_cd'=>'1'))->result_array();
    }
function select_user_information($patient_id="")
    {
       return $this->db->get_where('users', array('user_id' => $patient_id))->result_array();
    }
    
    /*INPATIENT MANAGEMENT*/
    function select_inpatient_info()
    {
      $account_type=$this->session->userdata('login_type');
    if($account_type == 'superadmin'){
  return $this->db->order_by('id','desc')->get_where('inpatient',array('inpatient_status'=>1,'row_status_cd'=>'1'))->result_array();
}elseif($account_type == 'hospitaladmins'){
  return $this->db->where('hospital_id',$this->session->userdata('hospital_id'))->order_by('id','desc')->get_where('inpatient',array('inpatient_status'=>1,'row_status_cd'=>'1'))->result_array();
}elseif($account_type == 'doctors'){
    return $this->db->where('doctor_id',$this->session->userdata('login_user_id'))->order_by('id','desc')->get_where('inpatient',array('inpatient_status'=>1,'row_status_cd'=>'1'))->result_array();
}elseif($account_type == 'users'){
    return $this->db->where('user_id',$this->session->userdata('login_user_id'))->order_by('id','desc')->get_where('inpatient',array('inpatient_status'=>1,'row_status_cd'=>'1'))->result_array();
}elseif($account_type == 'nurse'){
    $res=explode(',',$this->db->where('nurse_id',$this->session->userdata('login_user_id'))->get('nurse')->row()->doctor_id);
    for($n=0;$n<count($res);$n++){
        $inpatient=$this->db->order_by('id','desc')->where('doctor_id',$res[$n])->get_where('inpatient',array('inpatient_status'=>1,'row_status_cd'=>'1'))->result_array();
        if($inpatient!=''){
            $inpatient1[]=$inpatient;
        }
    }
    for($i=0;$i<count($inpatient1);$i++){
    for($j=0;$j<count($inpatient1[$i]);$j++){
 $return[]=$inpatient1[$i][$j];
 }   
}
    return $return;
}elseif($account_type == 'receptionist'){
    $res=explode(',',$this->db->where('receptionist_id',$this->session->userdata('login_user_id'))->get('receptionist')->row()->doctor_id);
    for($n=0;$n<count($res);$n++){
        $inpatient=$this->db->order_by('id','desc')->where('doctor_id',$res[$n])->get_where('inpatient',array('inpatient_status'=>1,'row_status_cd'=>'1'))->result_array();
        if($inpatient!=''){
            $inpatient1[]=$inpatient;
        }
    }  
    for($i=0;$i<count($inpatient1);$i++){
    for($j=0;$j<count($inpatient1[$i]);$j++){
 $return[]=$inpatient1[$i][$j];
 }   
}
    return $return;
}
    }
function select_inpatient_info_by_date($param1 = '', $param2 = '',$param3='')
    {
$account_type=$this->session->userdata('login_type');
if($param1 != '0NaN-NaN-NaN' && $param2 != '0NaN-NaN-NaN'){
if($param3=='all'){
$where=array('created_at >='=>date('Y-m-d 00:00:00',strtotime($param1)),'created_at <='=>date('Y-m-d 23:59:59',strtotime($param2)),'row_status_cd'=>'1');
}elseif($param3!='all'){
$where=array('created_at >='=>date('Y-m-d 00:00:00',strtotime($param1)),'created_at <='=>date('Y-m-d 23:59:59',strtotime($param2)),'inpatient_status'=>$param3,'row_status_cd'=>'1');
}
}else{
if($param3=='all'){
$where=array('row_status_cd'=>'1');
}elseif($param3!='all'){
$where=array('inpatient_status'=>$param3,'row_status_cd'=>'1');
}
}
if($account_type == 'superadmin'){
    return $this->db->order_by('id','desc')->get_where('inpatient',$where)->result_array();  
}elseif($account_type == 'hospitaladmins'){
    return $this->db->order_by('id','desc')->where($where)->get_where('inpatient',array('hospital_id'=>$this->session->userdata('hospital_id')))->result_array();    
}elseif($account_type == 'doctors'){
     return $this->db->order_by('id','desc')->where($where)->get_where('inpatient',array('doctor_id'=>$this->session->userdata('login_user_id')))->result_array();
}elseif($account_type == 'users'){
    return $this->db->order_by('id','desc')->where('user_id',$this->session->userdata('login_user_id'))->where($where)->or_where('row_status_cd','2')->get('inpatient')->result_array();
}elseif($account_type == 'receptionist'){
    $receptionist=$this->db->where('receptionist_id',$this->session->userdata('login_user_id'))->get('receptionist')->row();
    $doctor_id=explode(',',$receptionist->doctor_id);
for($doc=0;$doc<count($doctor_id);$doc++){
    $result[]=$this->db->order_by('id','desc')->where($where)->get_where('inpatient',array('doctor_id'=>$doctor_id[$doc]))->result_array();  
}
for($i=0;$i<count($result);$i++){
    for($j=0;$j<count($result[$i]);$j++){
 $return[]=$result[$i][$j];
 }   
}
return $return;
}elseif($account_type == 'nurse'){
    $nurse=$this->db->where('nurse_id',$this->session->userdata('login_user_id'))->get('nurse')->row();
    $doctor_id=explode(',',$nurse->doctor_id);
for($doc=0;$doc<count($doctor_id);$doc++){
    $result[]=$this->db->order_by('id','desc')->where($where)->get_where('inpatient',array('doctor_id'=>$doctor_id[$doc]))->result_array();
}
for($i=0;$i<count($result);$i++){
    for($j=0;$j<count($result[$i]);$j++){
 $return[]=$result[$i][$j];
 }   
}
return $return;
}   
    }

    function select_inpatient_id_info($id)
    {
  return $this->db->where('id',$id)->get('inpatient')->row();
    }
    function select_inpatient_id_doctor_info($user_id='',$doctor_id='')
    {
  return $this->db->order_by('id','desc')->get_where('inpatient',array('doctor_id'=>$this->session->userdata('login_user_id'),'user_id'=>$user_id))->result_array();
    }
    function select_inpatient_id_information($user_id='')
    {
  return $this->db->order_by('id','desc')->get_where('inpatient',array('user_id'=>$user_id,'row_status_cd'=>'1'))->result_array();
    }
    function select_inpatient_history_info($id)
    {
  return $this->db->order_by('id','desc')->where('in_patient_id',$id)->get_where('inpatient_history',array('row_status_cd' => 1))->result_array();
    }
    function save_inpatient_history(){
         $in_patient['in_patient_id']=$this->input->post('patient_id');
         $in_patient['created_at']=date('Y-m-d H:i:s');
         $in_patient['note']=$this->input->post('note');
         $this->db->insert('inpatient_history',$in_patient);
    }
    function delete_inpatient_history_info($id){
        $data['row_status_cd']='0';
        $this->db->where('id',$id);
        $this->db->update('inpatient_history',$data);
    }
    function save_inpatient_info()
    {
        $doctor=explode('/',$this->input->post('doctor'));
    $data['user_id']       = $this->input->post('user_id');
    $data['doctor_id']       = $this->db->where('unique_id',$doctor[0])->get('doctors')->row()->doctor_id;
    $data['hospital_id']       = $this->input->post('hospital');
    $data['bed_id']       = $this->input->post('bed');
    $data['reason']       = $this->input->post('reason');
    $data['inpatient_status']       = $this->input->post('status');
    if($data['inpatient_status'] == 1){
    $data['join_date']=date('Y-m-d H:i:s');
    }
    $insert=$this->db->insert('inpatient',$data);
        if($insert)
        {
            $lid=$this->db->insert_id();
            $this->crud_model->update_created_info('inpatient','id',$lid);
            /***********Bed Status**************/
        if($this->input->post('bed')!=''){
        $this->db->where('bed_id',$this->input->post('bed'));
        $this->db->update('bed',array('bed_status'=>2));
        }
        /******Notification Message******/
        if($data['inpatient_status'] == 1){$status='Admitted';}elseif($data['inpatient_status'] == 0){$status='Not Admitted';}
         $in_patient['in_patient_id']=$lid;
         /*$in_patient['created_at']=date('Y-m-d H:i:s');*/
         $in_patient['note']='Joined As In-Patient and Status as '.$status.'.';
         $this->db->insert('inpatient_history',$in_patient);
         $lid1=$this->db->insert_id();
         $this->crud_model->update_created_info('inpatient_history','id',$lid1);
        }
    }
    function update_inpatient_info($patient_id)
    {
    $data['user_id']       = $this->input->post('user_id');
    if($this->input->post('doctor')!=''){
        $doctor=explode('/',$this->input->post('doctor'));
    $data['doctor_id']       = $this->db->where('unique_id',$doctor[0])->get('doctors')->row()->doctor_id;}
    if($this->input->post('doctor')!=''){
    $data['hospital_id']       = $this->input->post('hospital');}
    $data['bed_id']       = $this->input->post('bed');
    $data['reason']       = $this->input->post('reason');
    $data['inpatient_status']       = $this->input->post('status');
    /*$data['created_by']       = $this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id');
    $data['modified_date']=date('Y-m-d H:i:s');*/
    $status=$this->db->where('id',$patient_id)->get('inpatient')->row_array();
    if($status['bed_id']!=$this->input->post('bed'))
    {
    $this->db->where('bed_id',$status['bed_id']);
    $this->db->update('bed',array('bed_status'=>1));
    $this->db->where('bed_id',$this->input->post('bed'));
    $this->db->update('bed',array('bed_status'=>2)); 
    }
    if($status['inpatient_status'] != $data['inpatient_status'] && $data['inpatient_status']==1){
    $data['join_date']=date('Y-m-d H:i:s');
    }
    if($data['inpatient_status'] == 2){
    $data['discharged_date']=date('Y-m-d H:i:s');
    }
    $insert=$this->db->where('id',$patient_id)->update('inpatient',$data);
        if($insert)
        {
            $this->crud_model->update_modified_info('inpatient','id',$patient_id);
              /***********Bed Status**************/
        if($data['inpatient_status']==2){
        $this->db->where('bed_id',$this->input->post('bed'));
        $this->db->update('bed',array('bed_status'=>1));
        }
            if($data['inpatient_status'] == 2){$status='Discharged';}
         $in_patient['in_patient_id']=$patient_id;
         /*$in_patient['created_at']=$data['modified_date'];*/
         $in_patient['note']='In-Patient Updated';
         $this->db->insert('inpatient_history',$in_patient);
         $lid=$this->db->insert_id();
         $this->crud_model->update_created_info('inpatient_history','id',$lid);
        }
    }
    function update_inpatient_status($id='',$status='')
    {
        $data['row_status_cd']=$status;
        $this->db->where('id',$id);
        $this->db->update('inpatient',$data);
        
    }
    function delete_inpatient_info($id)
    {
        $data['row_status_cd']='0';
        $this->db->where('id',$id);
        $this->db->update('inpatient',$data);
    }       
    









    /*PATIENT MANAGEMENT*/
    function select_patient_info()
    {
      $account_type=$this->session->userdata('login_type');
$patient_info=$this->db->order_by('id','desc')->get('patient')->result_array();
foreach ($patient_info as $row){
if($account_type == 'hospitaladmins'){
                $hospital=explode(',',$row['hospital_ids']);
                for($ha1=0;$ha1<count($hospital);$ha1++){
            if($hospital[$ha1] == $this->session->userdata('hospital_id')){
            $users[]=$this->db->where('user_id',$row['user_id'])->get_where('users',array('row_status_cd'=>'1'))->row();
            }
            }
            }
            if($account_type == 'doctors'){
                $doctor=explode(',',$row['doctor_ids']);
            for($doc1=0;$doc1<count($doctor);$doc1++){
            if($doctor[$doc1] == $this->session->userdata('login_user_id')){
            $users[]=$this->db->where('user_id',$row['user_id'])->get_where('users',array('row_status_cd'=>'1'))->row();
            }
            }
            }
            if($account_type == 'nurse'){
                $doctor=explode(',',$row['doctor_ids']);
            for($doc1=0;$doc1<count($doctor);$doc1++){
                $doctor1=explode(',',$this->db->where('nurse_id',$this->session->userdata('login_user_id'))->get_where('nurse',array('row_status_cd'=>'1'))->row()->doctor_id);
                for($doc2=0;$doc2<count($doctor1);$doc2++){
                    if($doctor[$doc1] == $doctor1[$doc2]){
            $users[]=$this->db->where('user_id',$row['user_id'])->get_where('users',array('row_status_cd'=>'1'))->row();
            }
                }
            }
            }
            if($account_type == 'receptionist'){
                $doctor=explode(',',$row['doctor_ids']);
            for($doc1=0;$doc1<count($doctor);$doc1++){
                $doctor1=explode(',',$this->db->where('receptionist_id',$this->session->userdata('login_user_id'))->get_where('receptionist',array('row_status_cd'=>'1'))->row()->doctor_id);
                for($doc2=0;$doc2<count($doctor1);$doc2++){
                    if($doctor[$doc1] == $doctor1[$doc2]){
            $users[]=$this->db->where('user_id',$row['user_id'])->get_where('users',array('row_status_cd'=>'1'))->row();
            }
                }
            }
            }
            if($account_type == 'medicallabs'){
                $lab=explode(',',$row['lab_ids']);
            for($lab1=0;$lab1<count($lab);$lab1++){
            if($lab[$lab1] == $this->session->userdata('login_user_id')){
            $users[]=$this->db->where('user_id',$row['user_id'])->get_where('users',array('row_status_cd'=>'1'))->row();
            }
            }
            }
if($account_type == 'medicalstores'){
                $store=explode(',',$row['store_ids']);
            for($sto1=0;$sto1<count($store);$sto1++){
            if($store[$sto1] == $this->session->userdata('login_user_id')){
            $users[]=$this->db->where('user_id',$row['user_id'])->get_where('users',array('row_status_cd'=>'1'))->row();
            }
            }
            }
        }
        return $users;

    }
    function delete_patient_hospital($hospital_id)
    {
$patient_data=$this->db->get_where('patient',array('user_id'=>$this->session->userdata('login_user_id')))->row();
$hospital_doctors=$this->db->select('doctor_id')->get_where('doctors',array('hospital_id'=>$hospital_id))->result_array();
$hospital_stores=$this->db->select('store_id')->get_where('medicalstores',array('hospital_id'=>$hospital_id))->result_array();
$hospital_labs=$this->db->select('lab_id')->get_where('medicallabs',array('hospital_id'=>$hospital_id))->result_array();
if($patient_data->hospital_ids!=''){
$hospital_ids=explode(',',$patient_data->hospital_ids);
for($h=0;$h<count($hospital_ids);$h++){
    if($hospital_ids[$h]!= $hospital_id){
        $hospi[]=$hospital_ids[$h];
    }
}
}
if($patient_data->doctor_ids!=''){
$doctor_ids=explode(',',$patient_data->doctor_ids);
for($d1=0;$d1<count($hospital_doctors);$d1++){
    $doc[]=$hospital_doctors[$d1]['doctor_id'];
}
$docs=array_diff($doctor_ids, $doc);
}
if($patient_data->store_ids!=''){
$store_ids=explode(',',$patient_data->store_ids);
for($d1=0;$d1<count($hospital_stores);$d1++){
    $sto[]=$hospital_stores[$d1]['store_id'];
}
$store=array_diff($store_ids, $sto);
}
if($patient_data->lab_ids!=''){
$lab_ids=explode(',',$patient_data->lab_ids);
for($d1=0;$d1<count($hospital_labs);$d1++){
    $la[]=$hospital_labs[$d1]['lab_id'];
}
$lab=array_diff($lab_ids, $la);
}
$this->db->where('user_id',$this->session->userdata('login_user_id'));
$yes=$this->db->update('patient',array('hospital_ids'=>implode(',',$hospi),'doctor_ids'=>implode(',',$docs),'store_ids'=>implode(',',$store),'lab_ids'=>implode(',',$lab)));
    }
    function delete_patient_doctor($doctor_id)
    {
$doctor_ids=explode(',',$this->db->get_where('patient',array('user_id'=>$this->session->userdata('login_user_id')))->row()->doctor_ids);
for($h=0;$h<count($doctor_ids);$h++){
    if($doctor_ids[$h]!=$doctor_id){
        $doc[]=$doctor_ids[$h];
    }
}
$this->db->where('user_id',$this->session->userdata('login_user_id'));
$yes=$this->db->update('patient',array('doctor_ids'=>implode(',',$doc)));
    }

function delete_patient_store($store_id)
    {
$store_ids=explode(',',$this->db->get_where('patient',array('user_id'=>$this->session->userdata('login_user_id')))->row()->store_ids);
for($h=0;$h<count($store_ids);$h++){
    if($store_ids[$h]!=$store_id){
        $doc[]=$store_ids[$h];
    }
}
$this->db->where('user_id',$this->session->userdata('login_user_id'));
$yes=$this->db->update('patient',array('store_ids'=>implode(',',$doc)));
    }
    function delete_patient_lab($lab_id)
    {
$lab_ids=explode(',',$this->db->get_where('patient',array('user_id'=>$this->session->userdata('login_user_id')))->row()->lab_ids);
for($h=0;$h<count($lab_ids);$h++){
    if($lab_ids[$h]!=$lab_id){
        $doc[]=$lab_ids[$h];
    }
}
$this->db->where('user_id',$this->session->userdata('login_user_id'));
$yes=$this->db->update('patient',array('lab_ids'=>implode(',',$doc)));
    }


























    /************GENERAL SETTINGS***********/
     function save_specialization_info()
    {
        $data['specializations_name']       = $this->input->post('name');
        $this->db->insert('specializations',$data);
        $lid=$this->db->insert_id();
        $this->crud_model->update_created_info('specializations','specializations_id',$lid);
    }
    function select_specializations_info(){
        return $this->db->get('specializations')->result_array();
    }
    function select_specializations(){
        return $this->db->where('row_status_cd',1)->get('specializations')->result_array();
    }
    function delete_specialization($specialization)
    {
        $data['row_status_cd']='0';
        $this->db->where('specializations_id',$specialization);
        $this->db->update('specializations',$data);
        $this->crud_model->update_modified_info('specializations','specializations_id',$specialization);
    }
     function save_language_info()
    {
        $data['lang_name']       = $this->input->post('name');
        $this->db->insert('language',$data);
    }
    function select_language_info(){
       return $this->db->get('language')->result_array(); 
    }
    function select_language(){
       return $this->db->get_where('language',array('row_status_cd' => 1))->result_array(); 
    }
     function delete_language($language)
    {
        $data['row_status_cd']='0';
        $this->db->where('language_id',$language);
        $this->db->update('language',$data);
    }
      function save_country_info()
    {
        $data['country_name'] 		= $this->input->post('name'); 
        $this->db->insert('country',$data);
        $lid=$this->db->insert_id();
        $this->crud_model->update_created_info('country','country_id',$lid);
    }
    function update_country_info($country_id)
    {
        $data['country_name'] 		= $this->input->post('name');
        $this->db->where('country_id',$country_id);
        $this->db->update('country',$data);
        $this->crud_model->update_modified_info('country','country_id',$country_id);
    }
    function select_country_info(){
       return $this->db->get('country')->result_array(); 
    }
    function select_country(){
       return $this->db->get_where('country',array('row_status_cd' => 1))->result_array(); 
    }
    function select_country_info_id($country_id){
       return $this->db->get_where('country',array('country_id'=>$country_id))->row_array(); 
    }
    function delete_country_info($country_id)
    {
        $data['row_status_cd']='0';
        $a=$this->db->where('country_id',$country_id)->update('country',$data);
        if($a){
            $b=$this->db->where('country_id',$country_id)->update('state',$data);
            if($b){
            $c=$this->db->where('country_id',$country_id)->update('district',$data);
             if($c){
            $d=$this->db->where('country_id',$country_id)->update('city',$data);
        }
        }
        }
    }
      function save_state_info()
    {
        $data['state_name'] 		= $this->input->post('name');
        $data['country_id'] 		= $this->input->post('country_id');   
        $this->db->insert('state',$data);
        $lid=$this->db->insert_id();
        $this->crud_model->update_created_info('state','state_id',$lid);
    }
    function update_state_info($state_id)
    {
        $data['state_name'] 		= $this->input->post('name');
        $data['country_id'] 		= $this->input->post('country_id'); 
        $this->db->where('state_id',$state_id);
        $this->db->update('state',$data);
        $this->crud_model->update_modified_info('state','state_id',$state_id);
    }
    function delete_state_info($state_id)
    {
        $data['row_status_cd']='0';
        $b=$this->db->where('state_id',$state_id)->update('state',$data);
        if($b){
        $c=$this->db->where('state_id',$state_id)->update('district',$data);
        if($c){
        $d=$this->db->where('state_id',$state_id)->update('city',$data);
        }
        }
    }
    function select_state_info(){
       return $this->db->get('state')->result_array(); 
    }
    function select_state($country_id=''){
        if($country_id!=''){
       return $this->db->get_where('state',array('country_id'=>$country_id,'row_status_cd' => 1))->result_array(); 
        }else{
    return $this->db->get_where('state',array('row_status_cd' => 1))->result_array(); 
        } 
    }
    function select_state_info_id($state_id){
       return $this->db->get_where('state',array('state_id'=>$state_id))->row_array(); 
    }
     function save_district_info()
    {
        $data['dist_name'] 		= $this->input->post('name');
        $data['country_id'] 		= $this->input->post('country_id');
        $data['state_id'] 		= $this->input->post('state_id');
        $this->db->insert('district',$data);
        $lid=$this->db->insert_id();
        $this->crud_model->update_created_info('district','district_id',$lid);
    }
   
    function update_district_info($district_id)
    {
        $data['dist_name'] 		= $this->input->post('name');
        $data['country_id'] 		= $this->input->post('country_id');
        $data['state_id'] 		= $this->input->post('state_id');
        
        $this->db->where('district_id',$district_id);
        $this->db->update('district',$data);
        $this->crud_model->update_modified_info('district','district_id',$district_id);
    }
    function delete_district_info($district_id)
    {
        $data['row_status_cd']='0';
            $c=$this->db->where('district_id',$district_id)->update('district',$data);
             if($c){
            $d=$this->db->where('district_id',$district_id)->update('city',$data);
        }
    }
    function select_district_info(){
       return $this->db->get('district')->result_array(); 
    }
    function select_district($state_id=''){
        if($state_id!=''){
            return $this->db->get_where('district',array('state_id'=>$state_id,'row_status_cd' => 1))->result_array(); 
        }else{
       return $this->db->get_where('district',array('row_status_cd' => 1))->result_array(); 
        }
    }
    function select_district_info_id($district_id){
       return $this->db->get_where('district',array('district_id'=>$district_id))->row_array(); 
    }
     function save_city_info()
    {
        $data['city_name'] 		= $this->input->post('name');
        $data['country_id'] 		= $this->input->post('country_id');
        $data['state_id'] 		= $this->input->post('state_id');
        $data['district_id'] 		= $this->input->post('district_id');
        $this->db->insert('city',$data);
        $lid=$this->db->insert_id();
        $this->crud_model->update_created_info('city','city_id',$lid);
    }
   
    function update_city_info($city_id)
    {
        $data['city_name'] 		= $this->input->post('name');
        $data['country_id'] 		= $this->input->post('country_id');
        $data['state_id'] 		= $this->input->post('state_id');
        $data['district_id'] 		= $this->input->post('district_id');
        
        $this->db->where('city_id',$city_id);
        $this->db->update('city',$data);
        $this->crud_model->update_modified_info('city','city_id',$city_id);
    }
    function delete_city_info($city_id)
    {
        $data['row_status_cd']='0';
            $d=$this->db->where('city_id',$city_id)->update('city',$data);
    }
    function select_city_info(){
       return $this->db->get('city')->result_array(); 
    }
    function select_city($district_id=''){
        if($district_id!=''){
       return $this->db->get_where('city',array('district_id'=>$district_id,'row_status_cd' => 1))->result_array(); }else{
        return $this->db->get_where('city',array('row_status_cd'=>1))->result_array();
       }
    }
    function select_city_info_id($city_id){
       return $this->db->get_where('city',array('city_id'=>$city_id))->row_array(); 
    }
    function save_license_category_info()
    {
        $data['lic_category_name']       = $this->input->post('license_category_name');
        $data['description']       = $this->input->post('license_category_description');
        $data['license_category_code']       = $this->input->post('license_category_code');
        $this->db->insert('license_category',$data);
        $lid=$this->db->insert_id();
        $this->crud_model->update_created_info('license_category','license_category_id',$lid);
    }
    function select_license_category_info()
    {
        return $this->db->get('license_category')->result_array();
    }
    function select_license_category()
    {
        return $this->db->where('row_status_cd','1')->get('license_category')->result_array();
    }
    function select_license_category_id($id)
    {
        return $this->db->where('license_category_id',$id)->get('license_category')->row_array();
    }
    function update_license_category_info($license_id)
    {
       
        $data['lic_category_name']       = $this->input->post('license_category_name');
        $data['description']       = $this->input->post('license_category_description');
        $data['license_category_code']       = $this->input->post('license_category_code');
        $this->db->where('license_category_id',$license_id);
        $this->db->update('license_category',$data);
        $this->crud_model->update_modified_info('license_category','license_category_id',$license_id);
    }
    function save_license_info()
    {
        $data['license_category_id']       = $this->input->post('license_category');
        $data['license_name'] 		= $this->input->post('name');
        $data['description']       = $this->input->post('description');
        $data['license_code'] 		= $this->input->post('license_code');
        
        $this->db->insert('license',$data);
        $lid=$this->db->insert_id();
        $this->crud_model->update_created_info('license','license_id',$lid);
    }
    function select_license_info()
    {
        return $this->db->get('license')->result_array();
    }
    function select_license()
    {
        return $this->db->where('row_status_cd','1')->get('license')->result_array();
    }
    function select_license_id($id)
    {
        return $this->db->where('license_id',$id)->get('license')->row_array();
    }
    function delete_license($license_id)
    {
        $data['row_status_cd']='0';
        $this->db->where('license_id',$license_id);
        $this->db->update('license',$data);
    }
    function update_license_info($license_id)
    {
        $data['license_category_id']       = $this->input->post('license_category');
        $data['license_name'] 		= $this->input->post('name');
        $data['description']       = $this->input->post('description');
        $data['license_code'] 		= $this->input->post('license_code');
        
        $this->db->where('license_id',$license_id);
        $this->db->update('license',$data);
        $this->crud_model->update_modified_info('license','license_id',$license_id);
    }
      function save_health_insurance_provider_info()
    {
        $data['health_ins_prov_name'] 		= $this->input->post('name'); 
        $this->db->insert('health_insurance_provider',$data);
        $lid=$this->db->insert_id();
        $this->crud_model->update_created_info('health_insurance_provider','health_insurance_provider_id',$lid);
    }
    function select_health__insurance_provider_info(){
        return $this->db->get('health_insurance_provider')->result_array();
    }
    function delete_health_insurance_provider($health_insurance_provider_id)
    {
        $data['row_status_cd']='0';
        $this->db->where('health_insurance_provider_id',$health_insurance_provider_id);
        $this->db->update('health_insurance_provider',$data);
    }
    
    
    
    
    
    
    
    
    
    
   
    
    
    
    
    
    
    
    
    
     
    function update_outpatient_info($patient_id)
    {
        $data['name'] 		= $this->input->post('name');
        $data['email'] 		= $this->input->post('email');
        $data['city'] 	= $this->input->post('city');
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('phone');
        $data['sex']            = $this->input->post('sex');
        $data['birth_date']     = strtotime($this->input->post('birth_date'));
        $data['age']            = $this->input->post('age');
        $data['in_time']            = $this->input->post('in_time');
        $data['patient_type']            = $this->input->post('patient_type');
        $data['blood_group'] 	= $this->input->post('blood_group');
        
        $this->db->where('patient_id',$patient_id);
        $this->db->update('patient',$data);
    }

    
    function delete_outpatient_info($patient_id)
    {
        $data['row_status_cd']='0';
        $this->db->where('patient_id',$patient_id);
        $this->db->update('patient',$data);
    }
    
    
    function getReport(){
        $start_date = isset($_GET['sd']) ? date("Y-m-d",strtotime($_GET['sd'])) : date('Y-m-d',(strtotime ( '-29 day' , time() ) ));
        $end_date = isset($_GET['ed']) ? date("Y-m-d",strtotime($_GET['ed'])) : date("Y-m-d");
        if($start_date != "" && $end_date != ""){
            $qry=$this->db->get_where('appointments',array('row_status_cd'=>'1'));  
        }else if($start_date != ""){
            $qry=$this->db->get_where('appointments',array('row_status_cd'=>'1'));
        }else if($end_date != ""){
            $qry=$this->db->get_where('appointments',array('row_status_cd'=>'1'));
        }else{
            $qry=$this->db->get_where('appointments',array('row_status_cd'=>'1'));
        }
        return $this->db->query($qry)->result_array();
    }    

    function select_report_info()
    {
        $account_type=$this->session->userdata('login_type');
        if($account_type == 'superadmin'){
        return $this->db->get_where('hospitals',array('row_status_cd'=>'1'))->result_array();
        }elseif($account_type == 'hospitaladmins'){
        return $this->db->where('hospital_id',$this->session->userdata('hospital_id'))->get_where('branch',array('row_status_cd'=>'1'))->result_array();
        }
    }
    
        
    function save_appointment_info()
    {
        $time=explode('-',$this->input->post('available_slot'));
        $department=$this->db->where('doctor_id',$this->input->post('doctor_id'))->get('doctors')->row();
        $data['user_id']       = $this->input->post('user_id');
        $data['doctor_id']       = $this->input->post('doctor_id');
        $data['appointment_date']= date('Y-m-d',strtotime($this->input->post('appointment_date')));
        $data['hospital_id']       = $department->hospital_id;
        $data['department_id']       = $department->department_id;
        $data['appointment_time_start']       = date("H:i", strtotime($time[0]));
        $data['appointment_time_end']       = date("H:i", strtotime($time[1]));
        $data['reason']       = $this->input->post('reason');
        if($this->input->post('remarks')){
        $data['remarks']       = $this->input->post('remarks');
        }
        $insert=$this->db->insert('appointments',$data);
        if($insert)
        {
            $lid=$this->db->insert_id();
        $this->crud_model->update_created_info('appointments','appointment_id',$lid);
        /*********** Patient **************/
     $patient_data['user_id']=$this->input->post('user_id');
    $patient=$this->db->where('user_id',$patient_data['user_id'])->get('patient')->row_array();
if($patient==''){
$patient_data['doctor_ids']=$this->input->post('doctor_id');
$patient_data['hospital_ids']=$department->hospital_id;
$this->db->insert('patient',$patient_data);
}elseif($patient!=''){
if($patient['hospital_ids']==''){
$patient_data['hospital_ids']=$department->hospital_id;
}elseif($patient['hospital_ids']!=''){
$hos_ar=explode(',',$patient['hospital_ids']);
    for($ho=0;$ho<count($hos_ar);$ho++){
    if($hos_ar[$ho]==$department->hospital_id){
    $patient_data['hospital_ids']=$patient['hospital_ids'];
    break;
    }else{
    $patient_data['hospital_ids']=$hos_ar[$ho].','.$department->hospital_id;
    }
    }
}
if($patient['doctor_ids']==''){
$patient_data['doctor_ids']=$this->input->post('doctor_id');
}elseif($patient['doctor_ids']!=''){
$doc_ar=explode(',',$patient['doctor_ids']);
    for($ho=0;$ho<count($doc_ar);$ho++){
    if($doc_ar[$ho]==$this->input->post('doctor_id')){
    $patient_data['doctor_ids']=$patient['doctor_ids'];
    break;
    }else{
    $patient_data['doctor_ids']=$patient['doctor_ids'].','.$this->input->post('doctor_id');
    }
    }
}
$this->db->where('user_id',$this->input->post('user_id'));
$this->db->update('patient',$patient_data);
}
        /********Appointment Unique Id Generate*****************/
$pid=$this->crud_model->generate_unique_id($lid,'appointments');
$this->db->where('appointment_id',$lid)->update('appointments',array('appointment_number'=>$pid,'appointment_status'=>2));
            $history['appointment_id']=$lid;
            $history['appointment_date']=$data['appointment_date'];
            $history['appointment_time_start']=$data['appointment_time_start'];
            $history['appointment_time_end']=$data['appointment_time_end'];
            $history_ins=$this->db->insert('appointment_history',$history);
            if($history_ins){
                $last_id=$this->db->insert_id();
                $this->db->where('appointment_history_id',$last_id)->update('appointment_history',array('action'=>1));
                $this->crud_model->update_created_info('appointment_history','appointment_history_id',$last_id);
            $doctor=$this->db->where('doctor_id',$data['doctor_id'])->get('doctors')->row();
            $appointments=$this->db->where('appointment_id',$lid)->get('appointments')->row();
            }
        }
    }
    function update_appointment_info($appointment_id='')
    {
    if($this->input->post('available_slot')!=''){
    $time=explode('-',$this->input->post('available_slot'));
    $data['appointment_time_start']       = date("H:i", strtotime($time[0]));
    $data['appointment_time_end']       = date("H:i", strtotime($time[1]));
    $data['appointment_date']= date('Y-m-d',strtotime($this->input->post('appointment_date')));
    $yes=$this->db->where('appointment_id',$appointment_id)->update('appointments',$data);
    if($yes){
        $this->crud_model->update_modified_info('appointments','appointment_id',$appointment_id);
        /*******Appointment History********/
        $history['appointment_id']=$appointment_id;
            $history['appointment_date']=$data['appointment_date'];
            $history['appointment_time_start']=$data['appointment_time_start'];
            $history['appointment_time_end']=$data['appointment_time_end'];
            $history_ins=$this->db->insert('appointment_history',$history);
            if($history_ins){
                $last_id=$this->db->insert_id();
                $this->db->where('appointment_history_id',$last_id)->update('appointment_history',array('action'=>5));
                $this->crud_model->update_created_info('appointment_history','appointment_history_id',$last_id);
            }
    }
    }
    }
    function update_appointment_attended_status($appointment_id='',$status='')
    {
        $data['attended_status']=$status;
        $this->db->where('appointment_status',2);
        $this->db->where('appointment_id',$appointment_id);
        $yes=$this->db->update('appointments',$data);
        if($yes){
            $this->crud_model->update_modified_info('appointments','appointment_id',$appointment_id);
        if($status == 0){
        $this->db->insert('appointment_history',array('appointment_id'=>$appointment_id,'reason'=>'You are Attended For This Appointment Thanks.','created_by'=>'MyPulse'));
        }
        if($status == 1){
        $this->db->insert('appointment_history',array('appointment_id'=>$appointment_id,'reason'=>'You are Not Attended For This Appointment.','created_by'=>'MyPulse'));
        }
        $lid=$this->db->insert_id();
        $this->crud_model->update_created_info('appointment_history','appointment_history_id',$lid);
    }
    }
    function select_appointment_info($doctor_id = '', $start_timestamp = '', $end_timestamp = '')
    {
      $account_type=$this->session->userdata('login_type');
if($account_type == 'superadmin'){
  return $this->db->order_by('appointment_number','DESC')->get_where('appointments',array('row_status_cd'=>'1'))->result_array();
}elseif($account_type == 'hospitaladmins'){
  return $this->db->order_by('appointment_number','DESC')->where('hospital_id',$this->session->userdata('hospital_id'))->get_where('appointments',array('row_status_cd'=>'1'))->result_array();
}elseif($account_type == 'doctors'){
  return $this->db->order_by('appointment_number','DESC')->where('doctor_id',$this->session->userdata('login_user_id'))->get_where('appointments',array('row_status_cd'=>'1'))->result_array();
}elseif($account_type == 'users'){
  return $this->db->order_by('appointment_number','DESC')->where('user_id',$this->session->userdata('login_user_id'))->get_where('appointments',array('row_status_cd'=>'1'))->result_array();
}elseif($account_type == 'receptionist'){
    $receptionist=$this->db->where('receptionist_id',$this->session->userdata('login_user_id'))->get('receptionist')->row();
    $doctor_id=explode(',',$receptionist->doctor_id);
for($doc=0;$doc<count($doctor_id);$doc++){
  $result[]=$this->db->order_by('appointment_number','DESC')->where('doctor_id',$doctor_id[$doc])->get_where('appointments',array('row_status_cd'=>'1'))->result_array();
}
for($i=0;$i<count($result);$i++){
    for($j=0;$j<count($result[$i]);$j++){
 $return[]=$result[$i][$j];
 }   
}
return $return;
}elseif($account_type == 'nurse'){
    $nurse=$this->db->where('nurse_id',$this->session->userdata('login_user_id'))->get('nurse')->row();
    $doctor_id=explode(',',$nurse->doctor_id);
for($doc=0;$doc<count($doctor_id);$doc++){
  $result[]=$this->db->order_by('appointment_number','DESC')->where('doctor_id',$doctor_id[$doc])->get_where('appointments',array('row_status_cd'=>'1'))->result_array();
}
for($i=0;$i<count($result);$i++){
    for($j=0;$j<count($result[$i]);$j++){
 $return[]=$result[$i][$j];
 }   
}
return $return;
}
}
    function dashboard_appointment_count()
    {
$account_type=$this->session->userdata('login_type');
if($account_type == 'superadmin'){
  return $this->db->where(array('row_status_cd'=>'1'))->count_all_results('appointments');
}elseif($account_type == 'hospitaladmins'){
  return $this->db->where(array('hospital_id'=>$this->session->userdata('hospital_id'),'row_status_cd'=>'1'))->count_all_results('appointments');
}elseif($account_type == 'doctors'){
  return $this->db->where(array('doctor_id'=>$this->session->userdata('login_user_id'),'row_status_cd'=>'1'))->count_all_results('appointments');
}elseif($account_type == 'users'){
  return $this->db->where(array('user_id'=>$this->session->userdata('login_user_id'),'row_status_cd'=>'1'))->count_all_results('appointments');
}elseif($account_type == 'receptionist'){
    $receptionist=$this->db->select('doctor_id')->where('receptionist_id',$this->session->userdata('login_user_id'))->get('receptionist')->row();
    $doctor_id=explode(',',$receptionist->doctor_id);
    $result='';
for($doc=0;$doc<count($doctor_id);$doc++){
  $result=$result+$this->db->where(array('doctor_id'=>$doctor_id[$doc],'row_status_cd'=>'1'))->count_all_results('appointments');
}
return $result;
}elseif($account_type == 'nurse'){
    $nurse=$this->db->select('doctor_id')->where('nurse_id',$this->session->userdata('login_user_id'))->get('nurse')->row();
    $doctor_id=explode(',',$nurse->doctor_id);
    $result='';
for($doc=0;$doc<count($doctor_id);$doc++){
  $result=$result+$this->db->where(array('doctor_id'=>$doctor_id[$doc],'row_status_cd'=>'1'))->count_all_results('appointments');
}
return $result;
}
}
function select_upcoming_appointments($status=''){
    $id=$this->session->userdata('login_user_id');
return $this->db->order_by('appointment_number','DESC')->get_where('appointments',array('user_id'=>$id,'appointment_date>='=>date('Y-m-d'),'appointment_status'=>$status,'row_status_cd'=>'1'))->result_array();
    }
function select_recommend_appointments(){
    $id=$this->session->userdata('login_user_id');
return $this->db->order_by('appointment_number','DESC')->get_where('appointments',array('user_id'=>$id,'next_appointment!='=>'','next_appointment>='=>date('Y-m-d'),'row_status_cd'=>'1'))->result_array();
    }
    
function select_today_appointment_info_by_doctor($status=''){
$account_type=$this->session->userdata('login_type');
    if($account_type=='doctors'){
return $this->db->order_by('appointment_number','DESC')->get_where('appointments',array('doctor_id'=>$this->session->userdata('login_user_id'),'appointment_date'=>date('Y-m-d'),'appointment_status'=>2,'row_status_cd'=>'1'))->result_array();

    }elseif($account_type=='receptionist'){
    $receptionist=$this->db->where('receptionist_id',$this->session->userdata('login_user_id'))->get('receptionist')->row();
    $doctor_id=explode(',',$receptionist->doctor_id);
for($doc=0;$doc<count($doctor_id);$doc++){
$result[]=$this->db->order_by('appointment_number','DESC')->get_where('appointments',array('doctor_id'=>$doctor_id[$doc],'appointment_date'=>date('Y-m-d'),'appointment_status'=>2,'row_status_cd'=>'1'))->result_array();
}
for($i=0;$i<count($result);$i++){
    for($j=0;$j<count($result[$i]);$j++){
 $return[]=$result[$i][$j];
 }   
}
return $return;
    }
    }
function select_appointment_info_by_date($param1 = '', $param2 = '',$param3='')
    {
$account_type=$this->session->userdata('login_type');

if($param1 != '0NaN-NaN-NaN' && $param2 != '0NaN-NaN-NaN'){
if($param3=='all'){
$where=array('appointment_date >='=>$param1,'appointment_date <='=>$param2,'row_status_cd'=>'1');
}elseif($param3!='all'){
$where=array('appointment_date >='=>$param1,'appointment_date <='=>$param2,'appointment_status'=>$param3,'row_status_cd'=>'1');
}
}else{
if($param3=='all'){
$where=array('row_status_cd'=>'1');
}elseif($param3!='all'){
$where=array('appointment_status'=>$param3,'row_status_cd'=>'1');
}
}
if($account_type == 'superadmin'){
    return $this->db->order_by('appointment_number','DESC')->get_where('appointments',$where)->result_array();  
}elseif($account_type == 'hospitaladmins'){
     return $this->db->order_by('appointment_number','DESC')->where($where)->get_where('appointments',array('hospital_id'=>$this->session->userdata('hospital_id')))->result_array();
}elseif($account_type == 'doctors'){
     return $this->db->order_by('appointment_number','DESC')->where($where)->get_where('appointments',array('doctor_id'=>$this->session->userdata('login_user_id')))->result_array();
}elseif($account_type == 'users'){
     return $this->db->order_by('appointment_number','DESC')->where($where)->get_where('appointments',array('user_id'=>$this->session->userdata('login_user_id')))->result_array();   
}elseif($account_type == 'receptionist'){
    $receptionist=$this->db->where('receptionist_id',$this->session->userdata('login_user_id'))->get('receptionist')->row();
    $doctor_id=explode(',',$receptionist->doctor_id);
for($doc=0;$doc<count($doctor_id);$doc++){
     $result[]=$this->db->order_by('appointment_number','DESC')->where($where)->get_where('appointments',array('doctor_id'=>$doctor_id[$doc]))->result_array();
}
for($i=0;$i<count($result);$i++){
    for($j=0;$j<count($result[$i]);$j++){
 $return[]=$result[$i][$j];
 }   
}
return $return;
}elseif($account_type == 'nurse'){
    $nurse=$this->db->where('nurse_id',$this->session->userdata('login_user_id'))->get('nurse')->row();
    $doctor_id=explode(',',$nurse->doctor_id);
for($doc=0;$doc<count($doctor_id);$doc++){
     $result[]=$this->db->order_by('appointment_number','DESC')->where($where)->get_where('appointments',array('doctor_id'=>$doctor_id[$doc]))->result_array();   
}
for($i=0;$i<count($result);$i++){
    for($j=0;$j<count($result[$i]);$j++){
 $return[]=$result[$i][$j];
 }   
}
return $return;
}   
    }

    function recommend_inpatient($user_id)
    {
    $data['user_id']= $user_id;
    $data['doctor_id']= $this->session->userdata('login_user_id');
    $data['hospital_id']= $this->session->userdata('hospital_id');
    $data['inpatient_status']= 0;
    $insert=$this->db->insert('inpatient',$data);
        if($insert)
        {
        $lid=$this->db->insert_id();
        $this->crud_model->update_created_info('inpatient','id',$lid);
        if($data['inpatient_status'] == 0){$status='recommended';}elseif($data['inpatient_status'] == 1){$status='Admitted';}elseif($data['inpatient_status'] == 0){$status='Not Admitted';}
         $in_patient['in_patient_id']=$lid;
         $in_patient['note']='Joined As In-Patient and Status as '.$status.'.';
         $this->db->insert('inpatient_history',$in_patient);
         $l_id=$this->db->insert_id();
         $this->crud_model->update_created_info('inpatient_history','id',$l_id);
        }
        return TRUE;
    }
    function delete_appointment_info($appointment_id)
    {
        $data['row_status_cd']    = '0';
        $this->db->where('appointment_id',$appointment_id);
        $this->db->update('appointments',$data);
    }
     function delete_multiple_appointment_info()
    {
        $check=$_POST['check'];
        $data['row_status_cd']    = '0';
        for($i=0;$i<count($check);$i++){
        $this->db->where('appointment_id',$check[$i]);
        $this->db->update('appointments',$data);
        }
    }
     function close_multiple_appointment_info()
    {
        $check=$_POST['check'];
        for($i=0;$i<count($check);$i++){
        $this->db->where('appointment_id',$check[$i]);
        $this->db->update('appointments',array('appointment_status'=>'4'));
        $this->crud_model->update_modified_info('appointments','appointment_id',$check[$i]);
        $this->db->insert('appointment_history',array('appointment_id'=>$check[$i],'action'=>7,'created_by'=>'MyPulse'));
        $lid=$this->db->insert_id();
        $this->crud_model->update_created_info('appointment_history','appointment_history_id',$lid);
        }
        return TRUE;
    }
    function cancel_multiple_appointment_info()
    {
$account_type=$this->session->userdata('login_type');
$role=$this->crud_model->get_role($account_type);
$user_role=$role['role'];
        $check=$_POST['check'];
        $reason=$_POST['cancel_reason'];
        for($i=0;$i<count($check);$i++){
$appointment_data=$this->db->where('appointment_id',$check[$i])->get('appointments')->row();
$appointment_date_time=$appointment_data->appointment_date.' '.$appointment_data->appointment_time_start;
$current_time=date('Y-m-d H:i');
$appointment_date_time_less=date('Y-m-d H:i', strtotime('-2 hours', strtotime($appointment_date_time)));
    if(strtotime($current_time)<strtotime($appointment_date_time_less)){
    $appointment_number=$appointment_data->appointment_number;
    $name=$this->db->where($this->session->userdata('type_id').'_id',$this->session->userdata('login_user_id'))->get($this->session->userdata('login_type'))->row()->name;
        $this->db->where('appointment_id',$check[$i]);
        $this->db->where('appointment_status',2);
        $s=$this->db->update('appointments',array('appointment_status'=>'3','remarks'=>'Appointment was cancelled by: "'.$user_role.' - '.$name.'" for the reason: " '.$reason.'".'));
        if($s){
        $this->crud_model->update_modified_info('appointments','appointment_id',$check[$i]);
        $this->db->insert('appointment_history',array('appointment_id'=>$check[$i],'action'=>6,'reason'=>$reason));
        $lid=$this->db->insert_id();
        $this->crud_model->update_created_info('appointment_history','appointment_history_id',$lid);
            /**********Notification***********/
    $appointment_data=$this->db->where('appointment_id',$check[$i])->get('appointments')->row_array();
        $user_id[]=$this->db->get('users',array('user_id'=>$appointment_data['user_id']))->row()->unique_id;
        $user_id[]=$this->db->get('doctors',array('doctor_id'=>$appointment_data['doctor_id']))->row()->unique_id;
        $notification['title']=$appointment_number.' Appointment Canceled';
        $notification['notification_text']='Hi User Your Appointment No '.$appointment_number.' was Canceled for the Reason " '.$reason.' " .';
    for($u=0;$u<count($user_id);$u++){
        $notification['user_id']=$user_id[$u];
        $this->db->insert('notification',$notification);
        }
    /**********End Notification***********/
        }
    }
    }
        return TRUE;

    }
    function update_appointment_remark($id='')
    {
        $data['remarks']     = $this->input->post('remark');
        $data['next_appointment']     = date('Y-m-d',strtotime($this->input->post('next_appointment')));
        $data['modified_at'] = date('Y-m-d H:i:s');
        $this->db->where('appointment_id',$id)->update('appointments',$data);
    }
    function save_prescription_info()
    {
        $data['user_id']= $this->input->post('user_id');
        $data['doctor_id']= $this->session->userdata('login_user_id');
        $drugs=$this->input->post('drug');
        for($i=0;$i<count($drugs);$i++){
            if($drugs[$i] != ''){
    $drug[]=$this->input->post('drug')[$i];
    $strength[]=$this->input->post('strength')[$i];
    $dosage[]=$this->input->post('dosage')[$i];
    $duration[]=$this->input->post('duration')[$i];
    $quantity[]=$this->input->post('quantity')[$i];
    $note[]=$this->input->post('note')[$i];
            }
        }
        $test_titles=$this->input->post('test_title');
        for($i=0;$i<count($test_titles);$i++){
            if($drugs[$i] != ''){
    $test_title[]=$this->input->post('test_title')[$i];
    $description[]=$this->input->post('description')[$i];
            }
        }
        $data['prescription_data'] =$this->encryption->encrypt($this->input->post('title').'|'.implode(',',$drug).'|'.implode(',',$strength).'|'.implode(',',$dosage).'|'.implode(',',$duration).'|'.implode(',',$quantity).'|'.implode(',',$note).'|'.implode(',',$test_title).'|'.implode(',',$description).'|'.$this->input->post('additional_note'));
        $data['created_at']=date('Y-m-d H:i:s');
        $this->db->insert('prescription',$data);
        $lid=$this->db->insert_id();
        $this->crud_model->update_created_info('prescription','prescription_id',$lid);
    }
    function update_prescription_info($prescription_id='')
    {
        $data['user_id']     = $this->input->post('user_id');
        $data['doctor_id']      = $this->input->post('doctor_id');
        $drugs=$this->input->post('drug');
        for($i=0;$i<count($drugs);$i++){
            if($drugs[$i] != ''){
    $drug[]=$this->input->post('drug')[$i];
    $strength[]=$this->input->post('strength')[$i];
    $dosage[]=$this->input->post('dosage')[$i];
    $duration[]=$this->input->post('duration')[$i];
    $quantity[]=$this->input->post('quantity')[$i];
    $note[]=$this->input->post('note')[$i];
            }
        }
        $test_titles=$this->input->post('test_title');
        for($i=0;$i<count($test_titles);$i++){
            if($drugs[$i] != ''){
    $test_title[]=$this->input->post('test_title')[$i];
    $description[]=$this->input->post('description')[$i];
            }
        }
         $data['prescription_data'] =$this->encryption->encrypt($this->input->post('title').'|'.implode(',',$drug).'|'.implode(',',$strength).'|'.implode(',',$dosage).'|'.implode(',',$duration).'|'.implode(',',$quantity).'|'.implode(',',$note).'|'.implode(',',$test_title).'|'.implode(',',$description).'|'.$this->input->post('additional_note'));
        $data['modified_at']=date('Y-m-d H:i:s');
        $this->db->where('prescription_id',$prescription_id);
        $this->db->update('prescription',$data);
        $this->crud_model->update_modified_info('prescription','prescription_id',$prescription_id);
    }
    function select_prescription_info()
    {
        $user_id = $this->session->userdata('login_user_id');
        return $this->db->get_where('prescription', array('user_id' => $user_id,'row_status_cd'=>1))->result_array();
    }
    function select_prescription_info_user()
    {
        $user_id = $this->session->userdata('login_user_id');
        return $this->db->get_where('prescription', array('user_id' => $user_id,'row_status_cd !='=>0))->result_array();
    }
    function select_prescription_information($prescription_id='')
    {
        return $this->db->get_where('prescription', array('prescription_id' => $prescription_id))->row_array();
    }
    function delete_prescription($prescription_id)
    { 
        $data['row_status_cd']='0';
        $this->db->where('prescription_id',$prescription_id);
        $deleted=$this->db->update('prescription',$data);
        $this->crud_model->update_modified_info('prescription','prescription_id',$prescription_id);
        if($deleted){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    function update_prescription_status($prescription_id='',$status='')
    {
        $data['row_status_cd']=$status;
        $this->db->where('prescription_id',$prescription_id);
        $updated=$this->db->update('prescription',$data);
        $this->crud_model->update_modified_info('prescription','prescription_id',$prescription_id);
        if($updated){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    function upload_prescription_receipt($order_type){
        $order_id=$this->input->post('order_id');
        if($this->input->post('cost')!=''){
        $data['cost']= implode(',',$this->input->post('cost'));
        }
        $data['price']= implode(',',$this->input->post('price'));
        $data['total']=$this->input->post('total');
        $data['receipt_created_at']=date('Y-m-d H:i:s');
        $rid=$this->crud_model->generate_unique_id($order_id,'order_receipt');
        $data['receipt_id']=$rid;
        $this->db->where('order_id',$order_id);
        $s=$this->db->update('prescription_order',$data);
        if($s){
        $this->crud_model->update_modified_info('prescription_order','order_id',$order_id);
        if($order_type==0){$stat=8;}elseif($order_type==1){$stat=3;}
        $this->db->where('order_id',$order_id)->update('prescription_order',array('status'=>$stat));
        }     
    }
    function upload_prescription_reports($order_type){
        $order_id=$this->input->post('order_id');
    $prescription_details=$this->db->where('order_id',$order_id)->get('prescription_order')->row();
    $prescription_data=$this->db->where('prescription_id',$prescription_details->prescription_id)->get('prescription')->row()->prescription_data;
$pre_data=explode('|',$this->encryption->decrypt($prescription_data));
$title_data=explode(',',$pre_data[7]);
        for($j=0;$j<count($_FILES["userfile"]["name"]);$j++){
            $report['order_id']=$order_id;
            $report['created_at']=date('Y-m-d H:i:s');
            $report['extension']=end(explode('.',$_FILES["userfile"]["name"][$j]));
            $insert=$this->db->insert('reports',$report);
            if($insert){
            $lid=$this->db->insert_id();
$folder=date('Y');
$directory = FCPATH . 'uploads/reports/';
$mypath=FCPATH.'uploads/reports/'.$folder;
    $file = file_get_contents(base_url('uploads/index.html'));
    if(!is_dir($mypath)){
        mkdir($directory . '/' . $folder, 0777);
        write_file(FCPATH.'uploads/reports/'. $folder.'/index.html', $file);
    }

    $unique_id=$this->crud_model->select_user_unique_id($prescription_details->user_id);
    $user_path=FCPATH.'uploads/reports/'.$folder.'/'.$unique_id;
    if(!is_dir($user_path)){
        mkdir($mypath . '/' . $unique_id, 0777);
        write_file(FCPATH.'uploads/reports/'. $folder.'/'.$unique_id.'/index.html', $file);
    }
    move_uploaded_file($_FILES["userfile"]["tmp_name"][$j], "uploads/reports/". $folder.'/'.$unique_id.'/'.$lid.'.'.$report['extension']);
            }
        } 
        $report_data['status']=6;
        $this->db->where('order_id',$order_id)->update('prescription_order',$report_data); 
        $this->crud_model->update_modified_info('prescription_order','order_id',$order_id);  
    }
    function select_prognosis_info()
    {
        $user_id = $this->session->userdata('login_user_id');
        return $this->db->get_where('prognosis', array('user_id' => $user_id,'row_status_cd!='=>0))->result_array();
    }
    function select_prognosis_information($prognosis_id='')
    {
        return $this->db->get_where('prognosis', array('prognosis_id' => $prognosis_id))->row_array();
    }
    function save_prognosis_info()
    {
        $data['user_id']     = $this->input->post('user_id');
        $data['doctor_id']      = $this->input->post('doctor_id');
        $data['prognosis_data']     = $this->encryption->encrypt($this->input->post('title').'|'.$this->input->post('case_history'));
        $this->db->insert('prognosis',$data);
        $lid=$this->db->insert_id();
        $this->crud_model->update_created_info('prognosis','prognosis_id',$lid);
    }
    function update_prognosis_info($prognosis_id='')
    {
        $data['prognosis_data']     = $this->encryption->encrypt($this->input->post('title').'|'.$this->input->post('case_history'));
        $data['modified_at']=date('Y-m-d H:i:s');
        $this->db->where('prognosis_id',$prognosis_id);
        $this->db->update('prognosis',$data);
        $this->crud_model->update_modified_info('prognosis','prognosis_id',$prognosis_id);
    }
     function delete_prognosis($prognosis_id)
    {
        $data['row_status_cd']='0';
        $this->db->where('prognosis_id',$prognosis_id);
        $updated=$this->db->update('prognosis',$data);
        $this->crud_model->update_modified_info('prognosis','prognosis_id',$prognosis_id);
        if($updated){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    function update_prognosis_status($prognosis_id='',$status='')
    {
        $data['row_status_cd']=$status;
        $this->db->where('prognosis_id',$prognosis_id);
        $updated=$this->db->update('prognosis',$data);
        $this->crud_model->update_modified_info('prognosis','prognosis_id',$prognosis_id);
        if($updated){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    function save_medical_reports()
    {
        $account_details=$this->session->userdata('unique_id');
        $data['created_by']=$account_details;
        $data['user_id'] = $this->input->post('user_id');
        $data['order_type']='1';
        for($j=0;$j<count($_FILES["report"]["name"]);$j++){
            if($this->input->post('title')[$j] !=''){
            $data['title']=$this->input->post('title')[$j];
            $data['created_at']=date('Y-m-d H:i:s');
            $data['extension']=end(explode('.',$_FILES["report"]["name"][$j]));
            $insert=$this->db->insert('reports',$data);
            if($insert){
            $lid=$this->db->insert_id(); 
$folder=date('Y');
$directory = FCPATH . 'uploads/reports/';
$mypath=FCPATH.'uploads/reports/'.$folder;
 $file = file_get_contents(base_url('uploads/index.html')); 
    if(!is_dir($mypath)){
        mkdir($directory . '/' . $folder, 0777);
        write_file(FCPATH.'uploads/reports/'. $folder.'/index.html', $file);
    }
    $unique_id=$this->crud_model->select_user_unique_id($data['user_id']);
     $user_path=FCPATH.'uploads/reports/'.$folder.'/'.$unique_id;
    if(!is_dir($user_path)){
        mkdir($mypath . '/' . $unique_id, 0777);
        write_file(FCPATH.'uploads/reports/'. $folder.'/'.$unique_id.'/index.html', $file);
    }
    move_uploaded_file($_FILES["report"]["tmp_name"][$j], "uploads/reports/". $folder.'/'.$unique_id.'/'.$lid.'.'.$data['extension']);
            }
        }
        }
        
    }
    function select_medical_reports()
    {
        $user_id = $this->session->userdata('login_user_id');
       return $this->db->get_where('prescription_order',array('user_id'=>$user_id,'order_type'=>1,'status'=>7))->result_array();
    }
    function select_medical_reports_information($order_id='')
    {
        return $this->db->get_where('reports', array('order_id' => $order_id))->result_array();
    }
    function delete_medical_reports($report_id)
    {
        $data['row_status_cd']    = '0';
        $this->db->where('report_id',$report_id);
        $this->db->update('reports',$data);
    }
    function update_medical_reports_status($report_id='',$status='')
    {
        $data['row_status_cd']=$status;
        $this->db->where('report_id',$report_id);
        return $this->db->update('reports',$data);
    }
function get_single_report_info($report_id)
    {
        return $this->db->get_where('reports',array('report_id'=>$report_id))->row_array();   
    }
    function save_prescription_order($id='')
    {
        $data['user_id']     = $this->input->post('user_id');
        $data['prescription_id']     = $this->input->post('prescription_id');
        $data['order_type']     = $id;
        if($id == 0){
        $data['quantity']     = implode(',',$this->input->post('quantity'));
        $data['store_id']     = $this->input->post('store');
        }
        if($id == 1){
            $te=$this->input->post('tests');
            for($c=0;$c<$_POST['count'];$c++){
            if($te[$c]!=''){
                $st[$c]=1;
            }else{
                $st[$c]=0;
            }
            }
        $data['tests']     = implode(',',$st);
        $data['lab_id']     = $this->input->post('lab');
        }
        $data['created_at']=date('Y-m-d H:i:s');
        $yes=$this->db->insert('prescription_order',$data);
        if($yes){
        $lid=$this->db->insert_id();
$pid=$this->crud_model->generate_unique_id($lid,'prescription_order');
$this->db->where('order_id',$lid)->update('prescription_order',array('unique_id'=>$pid,'status'=>'2'));
$this->crud_model->update_created_info('prescription_order','order_id',$lid);
            /*********** Patient **************/
        $patient_data['user_id']=$this->input->post('user_id');
        $patient=$this->db->where('user_id',$patient_data['user_id'])->get('patient');
        if($patient->num_rows()==1){
            if($id == 0){
        $hos=$patient->row()->store_ids;
        if($hos!=''){
$store_ids=explode(',',$hos);
$sto[]=$data['store_id'];
$union =array_merge(array_intersect($store_ids, $sto),array_diff($sto, $store_ids),array_diff($store_ids, $sto));
$patient_data['store_ids']=implode(',',$union);
        }else{
         $patient_data['store_ids']=$data['store_id'];   
        }
        }
        if($id == 1){
        $hos=$patient->row()->lab_ids;
        if($hos!=''){
        $lab_ids=explode(',',$hos);
$sto[]=$data['lab_id'];
$union =array_merge(array_intersect($lab_ids, $sto),array_diff($sto, $lab_ids),array_diff($lab_ids, $sto));
$patient_data['lab_ids']=implode(',',$union);
        }else{
         $patient_data['lab_ids']=$data['lab_id'];   
        }
        }
        $this->db->where('user_id',$this->input->post('user_id'));
        $this->db->update('patient',$patient_data);
        }else{
        if($id == 0){
        $patient_data['store_ids']=$this->input->post('store');
        }
        if($id == 1){
        $patient_data['lab_ids']=$this->input->post('lab');
        }
        $this->db->insert('patient',$patient_data);
        }

           if($id == 0){
        $data1['medicin_status']     = 1;
        }
        if($id == 1){
        $data1['test_status']     = 1;
        }
        $this->db->where('prescription_id',$data['prescription_id'])->update('prescription',$data1);
        $this->crud_model->update_modified_info('prescription','prescription_id',$data['prescription_id']);
        }

    }
    function update_order_status($order_id,$status){
        $data['status']=$status;
        return $this->db->where('order_id',$order_id)->update('prescription_order',$data);
    }
    function select_order_info()
    {
        $account_type = $this->session->userdata('login_type');
        $user_id = $this->session->userdata('login_user_id');
    if($account_type=='superadmin'){
        return $this->db->order_by('order_id','DESC')->get('prescription_order')->result_array();
    }
    if($account_type=='hospitaladmins'){
        $store_ids=$this->db->select('store_id')->where('hospital_id',$this->session->userdata('hospital_id'))->get('medicalstores')->result_array();
        $lab_ids=$this->db->select('lab_id')->where('hospital_id',$this->session->userdata('hospital_id'))->get('medicallabs')->result_array();
        
        if($store_ids!=''){
        for($i=0;$i<count($store_ids);$i++){
        $store=$this->db->order_by('order_id','DESC')->get_where('prescription_order', array('store_id' => $store_ids[$i]['store_id']))->result_array();
        if($store){
                $data[]=$store;
            }
        }
        }
        if($lab_ids!=''){
        for($j=0;$j<count($lab_ids);$j++){
            $lab=$this->db->order_by('order_id','DESC')->get_where('prescription_order', array('lab_id' => $lab_ids[$j]['lab_id']))->result_array();
            if($lab){
                $data[]=$lab;
            }
        }
        }
        for($k=0;$k<count($data);$k++){
            for($k1=0;$k1<count($data[$k]);$k1++){
            $result[]=$data[$k][$k1];
        }
        }
        return $result;
    }
    if($account_type=='users'){
        return $this->db->order_by('order_id','DESC')->get_where('prescription_order', array('user_id' => $user_id))->result_array();
    }
    if($account_type=='medicalstores'){
        
        return $this->db->order_by('order_id','DESC')->get_where('prescription_order', array('store_id' => $user_id))->result_array();

    }
    if($account_type=='medicallabs'){
        return $this->db->order_by('order_id','DESC')->get_where('prescription_order', array('lab_id' => $user_id))->result_array();
    }
    }
    function select_outstanding_order_info(){
        $account_type = $this->session->userdata('login_type');
        if($account_type == 'medicalstores'){
       return $this->db->order_by('order_id','desc')->get_where('prescription_order',array('store_id'=>$this->session->userdata('login_user_id'),'status!='=>1,'status!='=>7))->result_array();
        }
        if($account_type == 'medicallabs'){
        return $this->db->order_by('order_id','desc')->get_where('prescription_order',array('lab_id'=>$this->session->userdata('login_user_id'),'status!='=>1,'status!='=>7))->result_array();
        }
    }
    function select_completed_order_info(){
        $account_type = $this->session->userdata('login_type');
        if($account_type == 'medicalstores'){
       return $this->db->order_by('order_id','desc')->get_where('prescription_order',array('store_id'=>$this->session->userdata('login_user_id'),'status'=>1))->result_array();
        }
        if($account_type == 'medicallabs'){
        return $this->db->order_by('order_id','desc')->get_where('prescription_order',array('lab_id'=>$this->session->userdata('login_user_id'),'status'=>1))->result_array();
        }
    }
    function select_order_info_id($order_id=''){
return $this->db->get_where('prescription_order',array('order_id'=>$order_id))->row_array(); 
    }
    function book_order($order_type){
    $data['user_id']=$this->session->userdata('login_user_id');
    $data['order_type']=$order_type;
    $data['type_of_order']=1;
    if($order_type==0){
    $data['store_id']=$this->input->post('store');
    $data['order_data'] =$this->encryption->encrypt($this->input->post('title').'|'.implode(',',$this->input->post('drug')).'|'.implode(',',$this->input->post('strength')).'|'.implode(',',$this->input->post('quantity')));
    }elseif($order_type==1){
        $data['lab_id']=$this->input->post('lab');
        $data['order_data'] =$this->encryption->encrypt($this->input->post('title').'|'.implode(',',$this->input->post('test_title')).'|'.implode(',',$this->input->post('description')));
    }
   $yes=$this->db->insert('prescription_order',$data);
    if($yes){
$lid=$this->db->insert_id();
$this->crud_model->update_created_info('prescription_order','order_id',$lid);
$pid=$this->crud_model->generate_unique_id($lid,'prescription_order');
$this->db->where('order_id',$lid)->update('prescription_order',array('unique_id'=>$pid,'status'=>'2'));
            /*********** Patient **************/
        $patient_data['user_id']=$data['user_id'];
        $patient=$this->db->where('user_id',$patient_data['user_id'])->get('patient');
        if($patient->num_rows()==1){
            if($order_type == 0){
        $hos=$patient->row()->store_ids;
        if($hos!=''){
        $store_ids=explode(',',$hos);
$sto[]=$data['store_id'];
$union =array_merge(array_intersect($store_ids, $sto),array_diff($sto, $store_ids),array_diff($store_ids, $sto));
$patient_data['store_ids']=implode(',',$union);
        }else{
         $patient_data['store_ids']=$data['store_id'];   
        }
        }
        if($order_type == 1){
        $hos=$patient->row()->lab_ids;
        if($hos!=''){
        $lab_ids=explode(',',$hos);
$sto[]=$data['lab_id'];
$union =array_merge(array_intersect($lab_ids, $sto),array_diff($sto, $lab_ids),array_diff($lab_ids, $sto));
$patient_data['lab_ids']=implode(',',$union);
        }else{
         $patient_data['lab_ids']=$data['lab_id'];   
        }
        }
        $this->db->where('user_id',$patient_data['user_id']);
        $this->db->update('patient',$patient_data);
        }else{
        if($order_type == 0){
        $patient_data['store_ids']=$this->input->post('store');
        }
        if($order_type == 1){
        $patient_data['lab_ids']=$this->input->post('lab');
        }
        $this->db->insert('patient',$patient_data);
        }

    }
    }

    function read_message($message_id)
    {
    $account_details=$this->session->userdata('unique_id');
   $msg=$this->db->where('message_id',$message_id)->get('messages')->row_array();
   if($msg['is_read']==''){
    $data['is_read']=$account_details;
   }elseif($msg['is_read']!=''){
    $message_read=explode(',',$msg['is_read']);
    for($m=0;$m<count($message_read);$m++){
       if($message_read[$m]==$account_details){
        $data['is_read']=$msg['is_read'];
        }else{
        $data['is_read']=$msg['is_read'].','.$account_details;
        }
    }
    }
    $this->db->where('message_id',$message_id)->update('messages',$data);
   return $msg;
    }
    function select_message()
    {
$account_type   = $this->session->userdata('login_type');
$account_details=$this->session->userdata('unique_id');
    $message_data=$this->db->order_by('message_id','DESC')->get_where('messages' , array('row_status_cd'=>1))->result_array();
    $i=0;$j=0; foreach ($message_data as $row){
    $created_by=explode('_',$row['created_by']);
    $created_type=substr($created_by[0],0,-2);
    $role_data=$this->crud_model->get_role($created_type);
    $message1=explode(',',$row['group_ids']);
    $message2=explode(',',$row['user_ids']);
    $hospi='';
    for($m1=0;$m1<count($message1);$m1++){
    $role_data1=$this->crud_model->get_role($message1[$m1]);
    $hospi=$role_data1['type'];
    $hospi1='';
  for($m2=0;$m2<count($message2);$m2++){
    if($message2[$m2] == $account_details){
    $hospi1=$message2[$m2];    
    }
  } 
   
    $i++;}
    if($account_type == 'superadmin'){
    if($hospi1 == $account_details || $hospi==$account_type)
              {
             $result[]=$row;   
              }  
    }elseif($role_data['type'] != 'doctors'){
    if(($hospi1 == $account_details || $hospi==$account_type) && (($row['hospital_id'] == 0 || $row['hospital_id'] == $this->session->userdata('hospital_id')) || $account_type=='users'))
              {
    $result[]=$row;
        }
        }elseif($role_data['type'] == 'doctors'){
        $users=$this->crud_model->select_doctor_info();
        //$users=$this->db->get_where('doctors',array('row_status_cd'=>'1'))->result_array();
        foreach ($users as $user) {
    if(($hospi1 == $account_details || $hospi==$account_type) &&  $row['created_by'] == $user['unique_id'])
        {
        $result[]=$row;
        }
        }
    }
    }
      return $result;
    }

function save_new_message()
    {
     $count=count($this->input->post('reciever'));
    for($i=0;$i<$count;$i++){
            $arr=explode('/',$_POST['reciever'][$i]);
            if($arr[0]=='0'){
                $mess1=0;
                $group[]=$arr[1];
            }elseif($arr[0]=='1'){
                $mess2=1;
                $ind[]=$arr[1];
            }
        }
    $data['group_ids']=implode(',',$group);
    $data['user_ids']=implode(',',$ind);
    $data['hospital_id']=$this->input->post('hospital_id');;
    $data['title']  = $this->input->post('title');
    $data['message'] = $this->input->post('message');
    $data['created_by'] = $this->session->userdata('unique_id');
    $data['created_at']=date('Y-m-d H:i:s');
    $insert=$this->db->insert('messages',$data);
    }
    function read_notification($notification_id)
    {
        $result=$this->db->where('id',$notification_id)->get('notification')->row_array();
        if($result['isRead']=='2'){
        $this->db->where('id',$notification_id)->update('notification',array('isRead'=>'1'));
        }
        return $result;
    }
    function select_notification()
    {
$account_details=$this->session->userdata('unique_id');
    return $this->db->order_by('id','desc')->get_where('notification',array('user_id'=>$account_details,'row_status_cd'=>1))->result_array();
    }
    function delete_notification($id){
    $data['row_status_cd']='0';
    $this->db->where('id',$id);
    $this->db->update('notification',$data);
    }
    function delete_all_notifications(){
$account_details=$this->session->userdata('unique_id');
$data['row_status_cd']='0';
    $this->db->where('user_id',$account_details);
    $this->db->update('notification',$data);
    }
    /*Front Page*/
    
        function get_doctors_SC_front($specialization_id,$city_id){
            $users=$this->db->select('doctor_id,name,hospital_id,branch_id,department_id,specializations')->order_by('name','asc')->get_where('doctors',array('row_status_cd'=>1))->result_array();
        $c=0;foreach ($users as $row) {
    $hospital=$this->db->select('hospital_id,name,row_status_cd')->get_where('hospitals',array('hospital_id'=>$row['hospital_id']))->row();
    $branch=$this->db->select('branch_id,branch_name,row_status_cd,city_id')->where('branch_id',$row['branch_id'])->get('branch')->row();
$department=$this->db->select('row_status_cd')->where('department_id',$row['department_id'])->get('department')->row();
  if($hospital->row_status_cd==1 && $branch->row_status_cd==1 && $department->row_status_cd==1){
            $spee=explode(',',$row['specializations']);
if($specialization_id !=0 && $city_id != 0){
    if($city_id == $branch->city)
    {
for($j=0;$j<count($spee);$j++) {
if($specialization_id == $spee[$j])
{
/*for($i=0;$i<count($spee);$i++){
$spe1[$c][]=$this->db->where('specializations_id',$spee[$i])->get('specializations')->row()->specializations_name;   
}
$spe=implode(',',$spe1[$c]);
echo '<option value="'.$row['unique_id'].'/ Dr. '.ucfirst($row['name']).'">('.$hospital->name.'/'.$branch->branch_name.'/'.$spe.')</option>';*/
$doc[]=$row;
} 
} 
}
}
if($specialization_id !=0 && $city_id == 0){
            for($j=0;$j<count($spee);$j++) {
                if($specialization_id == $spee[$j])
                {
           /* for($i=0;$i<count($spee);$i++){
             $spe1[$c][]=$this->db->where('specializations_id',$spee[$i])->get('specializations')->row()->specializations_name;   
    }
        $spe=implode(',',$spe1[$c]);
echo '<option value="'.$row['unique_id'].'/ Dr. '.ucfirst($row['name']).'">('.$hospital->name.'/'.$branch->branch_name.'/'.$spe.')</option>';*/
$doc[]=$row;
 } 
} 
}
if($specialization_id==0 && $city_id != 0){
    if($city_id == $branch->city)
    {
/*for($i=0;$i<count($spee);$i++){
             $spe1[$c][]=$this->db->where('specializations_id',$spee[$i])->get('specializations')->row()->specializations_name;   
    }
        $spe=implode(',',$spe1[$c]);
echo '<option value="'.$row['unique_id'].'/ Dr. '.ucfirst($row['name']).'">('.$hospital->name.'/'.$branch->branch_name.'/'.$spe.')</option>';*/
$doc[]=$row;
 } 
}
if($specialization_id==0 && $city_id==0){
       /* for($i=0;$i<count($spee);$i++) {
             $spe1[$c][]=$this->db->where('specializations_id',$spee[$i])->get('specializations')->row()->specializations_name;   
        }
        $spe=implode(',',$spe1[$c]);
echo '<option value="'.$row['unique_id'].'/ Dr. '.ucfirst($row['name']).'">('.$hospital->name.'/'.$branch->branch_name.'/'.$spe.')</option>';*/
$doc[]=$row;
}
}
$c++;}
return $doc;
}
}
