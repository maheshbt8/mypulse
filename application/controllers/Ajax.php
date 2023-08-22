<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Ajax extends CI_Controller {

    function __construct() {
        parent::__construct();
        /*$this->load->database();   
        $this->load->library('session');*/
        date_default_timezone_set('Asia/Kolkata');    
        error_reporting(0);  
        /* cache control */
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
       /* if ($this->session->userdata('superadmin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }*/
    }
    function test(){
        //$this->session->unset_userdata('json');
        $account_type   = $this->session->userdata('login_type');
$account_details=$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id');
    if(($_GET['sd']!='' && $_GET['ed']!='' && $_GET['status_id']!='') || ($_GET['sd']!='' && $_GET['ed']!='' && $_GET['status_id']=='') || ($_GET['sd']=='' && $_GET['ed']=='' && $_GET['status_id']!='')){
            $appointment_info=$this->crud_model->select_appointment_info_by_date($_GET['sd'],$_GET['ed'],$_GET['status_id']);
        }else{$appointment_info=$this->crud_model->select_appointment_info();}
        //return json_encode($appointment_info);
        //$this->session->set_userdata('json',"string11");
        //$this->session->set_flashdata('json','ll');
        //echo "string";
        //echo json_encode($appointment_info);
        //return $appointment_info['appointment_info'];
    }
    function get_otp()
    {
        $date_val=$_POST['phone'];
        $num="12345678901234567890";
        $shu=str_shuffle($num);
        $otp=substr($shu, 14);
        $this->session->set_userdata('otp_time',date('Y-m-d H:i:s'));
        $this->session->set_userdata('otp',$otp);
        $message= 'Thank you for registering with MyPulse. Your
verification code is ' . $otp.'.';
        $this->sms_model->send_sms($message,$_POST['phone']);
        $this->session->set_userdata('otp_sended','1');
        /*echo $this->session->userdata('otp');*/

    }
    function get_email()
    {
        $email=$_POST['email'];
        $validation = email_validation($email);
        if($validation == 0){
        echo '<span style="color:red"> This Email Already Registered </span>';    
        }
    }
     function get_phone()
    {
        $phone=$_POST['phone'];
        $validation = mobile_validation($phone);
        if($validation == 0){
         echo '<span style="color:red"> This Phone Number Already Registered </span>';
        }
    }
    function get_email_reg()
    {
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $validation = email_validation($email);
        /*echo $phone.'/'.$email.'/'.$validation;*/
        if($validation == 0){
        $check_users=$this->db->get_where('users',array('email'=>$email));
        if($check_users->num_rows()>0){
        $data=$check_users->row_array(); 
        if($data['phone']!=$phone && $data['reg_status']!='2'){
         echo '<span style="color:red"> This Email Already Registered </span>';   
        }
        }
        }
    }
     function get_phone_reg()
    {
        $phone=$_POST['phone'];
        $validation = mobile_validation($phone);
        if($validation == 0){
        $check_users=$this->db->get_where('users',array('phone'=>$phone));
        if($check_users->num_rows()>0){
        $data=$check_users->row_array(); 
        if($data['reg_status']!='2'){
         echo '<span style="color:red"> This Phone Number Already Registered </span>';   
        }
        }
        }

    }
    function get_lang($lang_id)
    {
        $this->session->set_userdata('website_language_google',$lang_id);
        echo ucfirst($this->db->where('language_id',$this->session->userdata('website_language_google'))->get('language')->row()->lang_name);
    }
    
    /***************AJAX GET FUNCTIONS****************/
     /******GET DISTRICT****/
    function get_country()
    {
        $country = $this->crud_model->select_country();
        echo '<option value=""> Select Country </option>';
        foreach ($country as $row) {
            echo '<option value="'.$row['country_id'].'">'.$row['country_name'].'</option>';
        }
    }
    function get_state($country_id)
    {
        $state = $this->crud_model->select_state($country_id);
        echo '<option value=""> Select State </option>';
        foreach ($state as $row2) {
            echo '<option value="' . $row2['state_id'] . '">' . $row2['state_name'] . '</option>';
        }
    }
     /******GET DISTRICT****/
    function get_district($state_id)
    {
        $district = $this->crud_model->select_district($state_id);
        echo '<option value=""> Select District </option>';
        foreach ($district as $row3) {
            echo '<option value="' . $row3['district_id'] . '">' . $row3['dist_name'] . '</option>';
        }
    }
     function get_city($district_id)
    {
        $state = $this->crud_model->select_city($district_id);
        echo '<option value=""> Select city </option>';
        foreach ($state as $row2) {
            echo '<option value="' . $row2['city_id'] . '">' . $row2['city_name'] . '</option>';
        }
    }
    /*GET BRANCH*/
    function get_hospital()
    {
        $branch = $this->crud_model->select_all_hospitals();
        echo '<option value=""> Select Hospital </option>';
        foreach ($branch as $row) {
            echo '<option value="' . $row['hospital_id'] . '">' . $row['name'] . '</option>';
        }
    }
    function get_branch($hospital_id)
    {
        $branch = $this->crud_model->select_branch($hospital_id);
        echo '<option value=""> Select Branch </option>';
        foreach ($branch as $row) {
            echo '<option value="' . $row['branch_id'] . '">' . $row['branch_name'] . '</option>';
        }
    }
     /*GET DEPARTMENT*/
      function get_department_all($branch_id)
    {
        $department = $this->db->get_where('department' , array('branch_id' => $branch_id,'row_status_cd'=>'1'))->result_array();
        echo '<option value=""> Select Department </option>';
        echo '<option value="all"> All Department </option>';
        foreach ($department as $row) {
            echo '<option value="' . $row['department_id'] . '">' . $row['dept_name'] . '</option>';
        }
    }
    function get_department($branch_id)
    {
        $department = $this->db->get_where('department' , array('branch_id' => $branch_id,'row_status_cd'=>'1'))->result_array();
        echo '<option value=""> Select Department </option>';
        foreach ($department as $row) {
            echo '<option value="' . $row['department_id'] . '">' . $row['dept_name'] . '</option>';
        }
    }
    function get_ward($department_id)
    {
        $ward = $this->db->get_where('ward' , array('department_id' => $department_id,'row_status_cd'=>'1'))->result_array();
        echo '<option value=""> Select Ward </option>';
        foreach ($ward as $row) {
            echo '<option value="' . $row['ward_id'] . '">' . $row['ward_name'] . '</option>';
        }
    }
    function get_bed($ward_id)
    {
        $ward = $this->db->get_where('bed' , array('ward_id'=>$ward_id,'bed_status'=>'1','row_status_cd'=>'1'))->result_array();
        echo '<option value=""> Select Bed </option>';
        foreach ($ward as $row) {
            echo '<option value="' . $row['bed_id'] . '">' . $row['bed_name'] . '</option>';
        }
    }
     function get_user_data()   
    {
    $user_value=$_POST['user'];
        $where = "(email='".$user_value."' OR phone='".$user_value."' OR unique_id='".$user_value."')";
        $qry=$this->db->where($where)->get_where('users',array('row_status_cd'=>'1'));
        $users=$qry->row_array();
        if($qry->num_rows()>0){
        echo '<input type="text" name="user" class="form-control"  autocomplete="off" id="user" list="users" placeholder="e.g. Enter User Email, Mobile Number or User ID" data-validate="required" data-message-required="Value Required" value="'.$users['name'].' '.$users['lname'].'" onchange="return get_user_data(this.value)">';
        echo '<input type="hidden" name="user_id" id="user_id" value="'.$users['user_id'].'">';
        }else{
            echo '<input type="text" name="user" class="form-control"  autocomplete="off" id="user" list="users" placeholder="e.g. Enter User Email, Mobile Number or User ID" data-validate="required" data-message-required="Value Required" value="" onchange="return get_user_data(this.value)"><span style="color:red;">No User Available</span>';
        }
    }
    function get_persons_data(){
       $user_value=$_POST['user'];
       $where = "email='".$user_value."' OR phone='".$user_value."' OR unique_id='".$user_value."'";
        $user_array = array('hospitaladmins', 'doctors', 'nurse', 'users','receptionist','medicalstores','medicallabs');
        $size = sizeof($user_array);
        for($i = 0; $i < $size; $i++){
            $this->db->where($where);
            $data = $this->db->get($user_array[$i]);
            if($data->num_rows() > 0){
                $user_info=$data->row_array();
                $role=$this->crud_model->get_role($user_array[$i]);
                echo '<table class="table table-bordered"><tbody>';
                echo '<tr><td>Role </td><td>'.$role['role'].'</td></tr>';
                echo '<tr><td>Unique ID </td><td>'.$user_info['unique_id'].'</td></tr>';
                echo '<tr><td>Name </td><td>'.ucwords($user_info['name']).'</td></tr>';
                echo '<tr><td>Email </td><td>'.$user_info['email'].'</td></tr>';
                echo '<tr><td>Mobile </td><td>'.$user_info['phone'].'</td></tr>';
                echo '</tbody></table>';
                echo '<input type="hidden" name="person_info" value="'.$role['type'].'/'.$role['type_id'].'/'.$user_info[$role['type_id'].'_id'].'"/>';exit();
            }
        }
        echo '<span class="error">No Data Found</span>';
    }
    
    function check_inpatient()   
    {
    $user_value=$_POST['user'];
    $where = "email='".$user_value."' OR phone='".$user_value."' OR unique_id='".$user_value."'";
    $qry=$this->db->where($where)->get('users')->row()->user_id;
    $in_patient=$this->db->get_where('inpatient',array('user_id'=>$qry,'inpatient_status'=>'1'))->num_rows();
    if($in_patient>0){
    echo "This User Already InPatient";
    }
    }
    function get_department_doctors($department_id='')   
    {
        $users=$this->db->where('department_id',$department_id)->get_where('doctors',array('row_status_cd'=>'1'))->result_array();
        foreach ($users as $row) {
            $spee=explode(',',$row['specializations']);
            //$spe='';
            for($i=0;$i<count($spee);$i++) {
                
             $spec[]=$this->db->where('specializations_id',$spee[$i])->get('specializations')->row()->specializations_name;
            }
            $spe=implode(',',$spec);
echo '<option value="'.$row['unique_id'].'/ Dr. '.ucfirst($row['name']).'">('.$spe.')</option>';
 }
    }
    function get_hospital_doctors($hospital_id='')   
    {
$users=$this->db->where('hospital_id',$hospital_id)->get_where('doctors',array('row_status_cd'=>'1'))->result_array();
    foreach ($users as $row) {
            $spee=explode(',',$row['specializations']);
            $spe='';
            for($i=0;$i<count($spee);$i++) {
             $spe=$this->db->where('specializations_id',$spee[$i])->get('specializations')->row()->specializations_name.','.$spe;   
            }
echo '<option value="'.$row['unique_id'].'">Dr. '.ucfirst($row['name']).'('.$this->db->where('hospital_id',$row['hospital_id'])->get('hospitals')->row()->name.','.$spe.')</option>';
 }
}
/*    function get_specializations_doctors($id='')   
    {
        $users=$this->crud_model->select_doctor_info();
        foreach ($users as $row) {
    $license_status=$this->db->get_where('hospitals',array('hospital_id'=>$row['hospital_id']))->row()->license_status;
  if($license_status==1){
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
    }
    function get_city_doctors($id='')   
    {
        $users=$this->crud_model->select_doctor_info();
        foreach ($users as $row) {
        $license_status=$this->db->get_where('hospitals',array('hospital_id'=>$row['hospital_id']))->row()->license_status;
  if($license_status==1){
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
    }*/
    function get_doctors_SC(){
    $specialization_id=$_POST['specialization'];
    $city_id=$_POST['city'];
    $users=$this->crud_model->select_doctor_info();
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
for($i=0;$i<count($spee);$i++){
$spe1[$c][]=$this->db->where('specializations_id',$spee[$i])->get('specializations')->row()->specializations_name;   
}
$spe=implode(',',$spe1[$c]);
echo '<option value="'.$row['unique_id'].'/ Dr. '.ucfirst($row['name']).'">('.$hospital->name.'/'.$branch->branch_name.'/'.$spe.')</option>';
} 
} 
}
}
if($specialization_id !=0 && $city_id == 0){
            for($j=0;$j<count($spee);$j++) {
                if($specialization_id == $spee[$j])
                {
            for($i=0;$i<count($spee);$i++){
             $spe1[$c][]=$this->db->where('specializations_id',$spee[$i])->get('specializations')->row()->specializations_name;   
    }
        $spe=implode(',',$spe1[$c]);
echo '<option value="'.$row['unique_id'].'/ Dr. '.ucfirst($row['name']).'">('.$hospital->name.'/'.$branch->branch_name.'/'.$spe.')</option>';
 } 
} 
}
if($specialization_id==0 && $city_id != 0){
    if($city_id == $branch->city)
    {
for($i=0;$i<count($spee);$i++){
             $spe1[$c][]=$this->db->where('specializations_id',$spee[$i])->get('specializations')->row()->specializations_name;   
    }
        $spe=implode(',',$spe1[$c]);
echo '<option value="'.$row['unique_id'].'/ Dr. '.ucfirst($row['name']).'">('.$hospital->name.'/'.$branch->branch_name.'/'.$spe.')</option>';
 } 
}
if($specialization_id==0 && $city_id==0){
        for($i=0;$i<count($spee);$i++) {
             $spe1[$c][]=$this->db->where('specializations_id',$spee[$i])->get('specializations')->row()->specializations_name;   
        }
        $spe=implode(',',$spe1[$c]);
echo '<option value="'.$row['unique_id'].'/ Dr. '.ucfirst($row['name']).'">('.$hospital->name.'/'.$branch->branch_name.'/'.$spe.')</option>';
}
}
$c++;}
}
function get_city_stores($id='')   
{          
if($id != 0){
       $store=$this->db->where('city_id',$id)->get_where('medicalstores',array('row_status_cd'=>'1'))->result_array(); 
 }
if($id == 0){
 $store=$this->db->get_where('medicalstores',array('row_status_cd'=>'1'))->result_array(); 
}

foreach($store as $spe) { 
echo '<option value="'.$spe['store_id'].'">'.$spe['unique_id'].' / '.$spe['name'].'</option>';
 }
    }
    function get_city_labs($id='')   
    { 
if($id != 0){
       $store=$this->db->where('city_id',$id)->get_where('medicallabs',array('row_status_cd'=>'1'))->result_array(); 
 }
if($id == 0){
 $store=$this->db->get_where('medicallabs',array('row_status_cd'=>'1'))->result_array(); 
}

foreach($store as $spe) { 
echo '<option value="'.$spe['lab_id'].'">'.$spe['unique_id'].' / '.$spe['name'].'</option>';
 }
    }
     function get_doctor($department_id='',$department_id1 = '')   
    {
        if($department_id == 'all'){
            $doctor = $this->db->get_where('doctors' , array(
            'branch_id' => $department_id1,'row_status_cd'=>1
        ))->result_array();
        }else{
        $doctor = $this->db->get_where('doctors' , array(
            'department_id' => $department_id,'row_status_cd'=>1
        ))->result_array();
        
    }
    
    foreach ($doctor as $row) {
            echo '<option value="' . $row['doctor_id'] . '">' . $row['name'] . '</option>';
        }
   
    }

    function get_doctor_data($unique_id)
    {
        $doctor_data = $this->db->select('doctor_id,unique_id,branch_id')->get_where('doctors',array('unique_id' => $unique_id))->row_array();
        $doctor_id=$doctor_data['doctor_id'];
        $doctor_unique_id=$doctor_data['unique_id'];
        $doctor_message=$this->db->where('doctor_id',$doctor_id)->get('availability')->row()->message;
        $branch=$this->db->select('address')->where('branch_id',$doctor_data['branch_id'])->get('branch')->row();
        echo '<div class="form-group"><b><label for="field-ta" class="col-sm-2 control-label">'.get_phrase('doctor_availability').'</label></b><div class="col-sm-10"><label class="control-label">'.$doctor_message.'</label></div></div>';
        echo '<div class="form-group"><b><label for="field-ta" class="col-sm-2 control-label">'.get_phrase('Address').'</label></b><div class="col-sm-10"><label class="control-label">'.$branch->address.'</label></div></div>';
        echo '<input type="hidden" value="'.$doctor_id.'" class="form-control" name="doctor_id" id="doctor_id">';
        echo '<input type="hidden" value="'.$doctor_unique_id.'" class="form-control" name="doctor_unique_id" id="doctor_unique_id">';
        
    }
     public function get_dco_date($doctor_id)
    {
    $date_val=date("Y-m-d", strtotime($_POST['date_val']));
        $doctor_availability= $this->db->get_where('availability_slot' , array('doctor_id' => $doctor_id,'date'=>$date_val,'row_status_cd'=>1));
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

        }else{
            if((date('Y-m-d')==$date_val && strtotime(date('h:i a'))<=$start_time1) || date('Y-m-d')!=$date_val){
            echo '<option value="'.date('h:i a',$start_time1) .' - '.date('h:i a', $start_time2).'" >' . date('h:i a',$start_time1) .' - '.date('h:i a', $start_time2).'</option>';
        }
        }
            
            $start_time1=$start_time2;
        }

        }
        }else{
        echo '<option value=""> No Slot Available In This Date </option>';
    }
    }
    function count_no_appointments($user_id){
    $user= $user_id;
    $appointment_date=$_POST['date_val'];
    $perday=$this->db->get_where('appointments', array('user_id' => $user,'created_at>='=>date('Y-m-d 00:00:00'),'created_at<='=>date('Y-m-d 23:59:59')))->num_rows();
    if($perday<2){
    $count=$this->db->get_where('appointments', array('user_id' => $user,'appointment_date'=>$appointment_date))->num_rows();
     if($count >=2 ){
      echo "<span style='color:red;'>You Can not Book More Than 2 Appointments Per Day</span>"; 
    }
    }else{
        echo "<span style='color:red;'>You Can Book a maximum of 2 Appointments Per Day</span>";
    }
    }

    function get_ajax_message(){
$account_type   = $this->session->userdata('login_type');
$account_details=$this->session->userdata('unique_id');
$message_data=$this->crud_model->select_message();
if($message_data!=''){
    foreach ($message_data as $row) {
      $count=explode(',',$row['is_read']);
    $s=0;
    for($m2=0;$m2<count($count);$m2++){
        if($account_details == $count[$m2]){
                $s=1;
                break;
        }
        }
    ?>
<a href="<?php echo base_url()?>Message/<?= $row['message_id'];?>">
        <li>
        <div class="dropdown-messages-box">
<div class="message-body">
  <?php if($s==0){ ?> <strong><?php }?>
&nbsp;&nbsp;<?= $row['title'];?>.
<br/>
&nbsp;&nbsp;<small class="text-muted"><?= date('h:i A - d/m/Y',strtotime($row['created_at']));?></small>
<?php if($s==0){ ?></strong><?php }?>
</div>

</div>
</li>
<li class="divider"></li>
</a>
<?php }}else{?>
<li>
<div class="all-button">
    <br/>
<center><strong>No Messages Available</strong></center></div>
</li>
<li class="divider"></li>
<?php }
          
    }
    function get_message_count(){
$account_type   = $this->session->userdata('login_type');
$account_details=array($this->session->userdata('unique_id'));
$message_data=$this->crud_model->select_message();
$j=0;foreach($message_data as $row){
    if($row['is_read']!=''){
    $count=explode(',',$row['is_read']);
    $docs=array_intersect($account_details,$count);
    if(count($docs)==0){
        $j=$j+1;
    }
    }else{
        $j=$j+1;
    }
        }
        echo '<span class="label label-info">'.$j.'</span>';
    }
    function get_ajax_notification(){
$account_type   = $this->session->userdata('login_type');
$account_details=$this->session->userdata('unique_id');
$notification_data=$this->crud_model->select_notification();
if(count($notification_data) > 0){
    foreach ($notification_data as $row) {
    ?>
<li>

<div class="dropdown-messages-box">
<a href="<?php echo base_url()?>Notification/<?= $row['id'];?>">
<div class="message-body">
<?php if($row['isRead']==2){ ?><strong> <?php }?><?= $row['title'];?>.
<br/>
<small class="text-muted"><?= date('h:i A - d/m/Y',strtotime($row['created_at']));?></small>
<?php if($row['isRead']==2){ ?></strong> <?php }?>
</div>
</a>
<a href="<?=base_url('main/notification/delete/').$row['id'];?>"><b class="pull-right" style="font-size: 20px;"><i class="fa fa-times-circle-o"></i></b>
</a>
</div>
</li>
<li class="divider"></li>
<?php }?><?php }else{
    ?>
<li>
<div class="all-button">
    <br/>
<center><strong>No Notifications</strong></center></div>
</li>
<li class="divider"></li>
<?php }
          
    }
    function get_notification_count(){
        $account_type   = $this->session->userdata('login_type');
$account_details=$this->session->userdata('unique_id');
        $notification_data=$this->crud_model->select_notification();
        $j=0;foreach($notification_data as $row){
            if($row['isRead']==2){
                $j=$j+1;
            }
    }
    echo '<span class="label label-info">'.$j.'</span>';
    }
}
?>
