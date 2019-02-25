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
        $this->sms_model->send_sms('Your MyPulse OTP code is '.$otp.'. Please use the code within 2 minutes.',$_POST['phone']);
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
        
        echo ucfirst($this->db->where('language_id',$this->session->userdata('website_language_google'))->get('language')->row()->name);
    }
    
    /***************AJAX GET FUNCTIONS****************/
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
    function get_bed($ward_id)
    {
        $ward = $this->db->get_where('bed' , array('ward_id'=>$ward_id,'bed_status'=>'1'))->result_array();
        echo '<option value=""> Select Bed </option>';
        foreach ($ward as $row) {
            echo '<option value="' . $row['bed_id'] . '">' . $row['name'] . '</option>';
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
        echo '<input type="hidden" name="user_id" id="user_id" value="'.$users['user_id'].'">';
        }else{
            echo '<input type="text" name="user" class="form-control"  autocomplete="off" id="user" list="users" placeholder="e.g. Enter User Email, Mobile Number or User ID" data-validate="required" data-message-required="Value Required" value="" onchange="return get_user_data(this.value)"><span style="color:red;">No User Available</span>';
        }
    }
    function check_inpatient()   
    {
    $user_value=$_POST['user'];
    $where = "email='".$user_value."' OR phone='".$user_value."' OR unique_id='".$user_value."'";
    $qry=$this->db->where($where)->get('users')->row()->user_id;
    $in_patient=$this->db->get_where('inpatient',array('user_id'=>$qry,'status'=>'1'))->num_rows();
    if($in_patient>0){
    echo "This User Already InPatient";
    }
    }
    function get_department_doctors($department_id='')   
    {

        $users=$this->db->where('department_id',$department_id)->get('doctors')->result_array();
        foreach ($users as $row) {
            $spee=explode(',',$row['specializations']);
            $spe='';
            for($i=0;$i<count($spee);$i++) {
             $spe=$this->db->where('specializations_id',$spee[$i])->get('specializations')->row()->name.','.$spe;   
            }
echo '<option value="'.$row['unique_id'].'">Dr. '.ucfirst($row['name']).' ('.$spe.')</option>';
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
        $users=$this->db->get('doctors')->result_array();
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
    }
    function get_city_stores($id='')   
    {
        
            
if($id != 0){
       $store=$this->db->where('city',$id)->get('medicalstores')->result_array(); 
 }
if($id == 0){
 $store=$this->db->get('medicalstores')->result_array(); 
}

foreach($store as $spe) { 
echo '<option value="'.$spe['store_id'].'">'.$spe['unique_id'].' / '.$spe['name'].'</option>';
 }
    }
    function get_city_labs($id='')   
    { 
if($id != 0){
       $store=$this->db->where('city',$id)->get('medicallabs')->result_array(); 
 }
if($id == 0){
 $store=$this->db->get('medicallabs')->result_array(); 
}

foreach($store as $spe) { 
echo '<option value="'.$spe['lab_id'].'">'.$spe['unique_id'].' / '.$spe['name'].'</option>';
 }
    }
     function get_doctor($department_id='',$department_id1 = '')   
    {
        if($department_id == 'all'){
            $doctor = $this->db->get_where('doctors' , array(
            'branch_id' => $department_id1,'status'=>1
        ))->result_array();
        }else{
        $doctor = $this->db->get_where('doctors' , array(
            'department_id' => $department_id,'status'=>1
        ))->result_array();
        
    }
    
    foreach ($doctor as $row) {
            echo '<option value="' . $row['doctor_id'] . '">' . $row['name'] . '</option>';
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
        $doctor_availability= $this->db->get_where('availability_slot' , array(
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

        }else{
            if((date('m/d/Y')==$date_val && strtotime(date('h:i a'))<=$start_time1) || date('m/d/Y')!=$date_val){
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
    function get_appointment_status($id){
        echo $_GET['sd'];
       $account_type=$this->session->userdata('login_type');

if($account_type == 'superadmin'){
if($id=='all'){
$patient_info=$this->db->order_by('appointment_id','desc')->get('appointments')->result_array();
}elseif($id!='all'){
  $patient_info=$this->db->order_by('appointment_id','desc')->get_where('appointments',array('status'=>$id))->result_array();
}
}elseif($account_type == 'hospitaladmins'){
if($id=='all'){
$patient_info=$this->db->where('hospital_id',$this->session->userdata('hospital_id'))->order_by('appointment_id','desc')->get('appointments')->result_array();
}elseif($id!='all'){
  $patient_info=$this->db->where('hospital_id',$this->session->userdata('hospital_id'))->order_by('appointment_id','desc')->get_where('appointments',array('status'=>$id))->result_array();
}
}elseif($account_type == 'doctors'){
    if($id=='all'){
$patient_info=$this->db->where('doctor_id',$this->session->userdata('login_user_id'))->order_by('appointment_id','desc')->get('appointments')->result_array();
}elseif($id!='all'){
    $patient_info=$this->db->where('doctor_id',$this->session->userdata('login_user_id'))->order_by('appointment_id','desc')->get_where('appointments',array('status'=>$id))->result_array();
}
}elseif($account_type == 'users'){
       if($id=='all'){
$patient_info=$this->db->where('user_id',$this->session->userdata('login_user_id'))->order_by('appointment_id','desc')->get('appointments')->result_array();
}elseif($id!='all'){
    $patient_info=$this->db->where('user_id',$this->session->userdata('login_user_id'))->order_by('appointment_id','desc')->get_where('appointments',array('status'=>$id))->result_array();
}
}elseif($account_type == 'nurse'){
    $res=explode(',',$this->db->where('nurse_id',$this->session->userdata('login_user_id'))->get('nurse')->row()->doctor_id);
    for($n=0;$n<count($res);$n++){
        if($id=='all'){
        $inpatient=$this->db->order_by('appointment_id','desc')->where('doctor_id',$res[$n])->get('appointments')->result_array();
        }elseif($id!='all'){
        $inpatient=$this->db->order_by('appointment_id','desc')->where('doctor_id',$res[$n])->get_where('appointments',array('status'=>$id))->result_array();
        }
        if($inpatient!=''){
            $inpatient1[]=$inpatient;
        }
    }
     for($i=0;$i<count($inpatient1);$i++){
    for($j=0;$j<count($inpatient1[$i]);$j++){
 $patient_info[]=$inpatient1[$i][$j];
 }   
}
}elseif($account_type == 'receptionist'){
    $res=explode(',',$this->db->where('receptionist_id',$this->session->userdata('login_user_id'))->get('receptionist')->row()->doctor_id);
    for($n=0;$n<count($res);$n++){
        if($id=='all'){
        $inpatient=$this->db->order_by('appointment_id','desc')->where('doctor_id',$res[$n])->get('appointments')->result_array();
        }elseif($id!='all'){
        $inpatient=$this->db->order_by('appointment_id','desc')->where('doctor_id',$res[$n])->get_where('appointments',array('status'=>$id))->result_array();
        }
        if($inpatient!=''){
            $inpatient1[]=$inpatient;
        }
    }
      for($i=0;$i<count($inpatient1);$i++){
    for($j=0;$j<count($inpatient1[$i]);$j++){
 $patient_info[]=$inpatient1[$i][$j];
 }   
}

}$i=1;foreach ($patient_info as $row) {
    if($row != ''){ ?>
    <tr>
                <td><input type="checkbox" name="check[]" class="check" id="check_<?php echo $i;?>" value="<?php echo $row['appointment_id'] ?>"></td>
                 <td><a href="<?php echo base_url(); ?>main/edit_appointment/<?php echo $row['appointment_id'] ?>" class="hiper"><?php echo $row['appointment_number'] ?></a></td>
                <td>
                   <!-- <a href="<?php echo base_url();?>main/edit_user/<?php echo $row['user_id']?>" class="hiper"> <?php $name = $this->db->get_where('users' , array('user_id' => $row['user_id'] ))->row()->unique_id;
                        echo $name;?></a> -->
             <a href="<?php echo base_url();?>main/edit_user/<?php echo $row['user_id']?>" class="hiper"><?php $name = $this->db->get_where('users' , array('user_id' => $row['user_id'] ))->row()->name;
                        echo $name;?></a>
                </td>
                 <td>
                    <!-- <a href="<?php echo base_url(); ?>main/edit_doctor/<?php echo $row['doctor_id'] ?>" class="hiper"><?php $name = $this->db->get_where('doctors' , array('doctor_id' => $row['doctor_id'] ))->row()->unique_id;
                        echo $name;?></a> -->
                <a href="<?php echo base_url();?>main/edit_doctor/<?php echo $row['doctor_id']?>" class="hiper"><?php $name = $this->db->get_where('doctors' , array('doctor_id' => $row['doctor_id'] ))->row()->name;
                        echo $name;?></a>
                </td>
                <td>
                    <?php 
                    $branch=$this->db->get_where('branch' , array('branch_id' => $this->db->where('doctor_id',$row['doctor_id'])->get('doctors')->row()->branch_id))->row();
                    $hospital=$this->db->get_where('hospitals' , array('hospital_id' => $this->db->where('branch_id',$branch->branch_id)->get('branch')->row()->hospital_id))->row();
                    if($row['department_id'] == 0){$name='All Departments';}else{$name = $this->db->get_where('department' , array('department_id' => $row['department_id'] ))->row()->name;}
                        echo $hospital->name.' - '.$branch->name.' - '.$name;?>
                </td>
                 <td><?php echo $this->db->where('city_id',$branch->city)->get('city')->row()->name;?></td> 
                <td><?php echo date("d M, Y",strtotime($row['appointment_date']));?><br/><?php echo date("h:i A", strtotime($row['appointment_time_start'])).' - '.date("h:i A", strtotime($row['appointment_time_end']));?></td>
                <td><?php if($row['status'] == 1){echo "<button type='button' class='btn-danger'>Pending</button>";   
                 }
                 elseif($row['status'] == 2){ echo "<button type='button' class='btn-success'>Confirmed</button>";}
                 elseif($row['status'] == 3){ echo "<button type='button' class='btn-info'>Cancelled</button>";}
                 elseif($row['status'] == 4){ echo "<button type='button' class='btn-warning'>Closed</button>";}
                 ?>
                     
                 </td>
                <td>
                    <?php if($account_type=='superadmin'){?>
                    <a href="#" onclick="confirm_modal('<?php echo base_url();?>main/appointment/delete/<?php echo $row['appointment_id']?>');" id="dellink_2" class="delbtn" data-toggle="modal" data-target=".bs-example-modal-sm" data-id="2" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
                    <!-- <a href="#" onclick="confirm_modal('<?php echo base_url();?>main/appointment/close/<?php echo $row['appointment_id']?>');" id="dellink_2" class="delbtn" data-toggle="modal" data-target=".bs-example-modal-sm" data-id="2" title="Close"><i class="glyphicon glyphicon-ban-circle"></i></a> -->
                    <?php }?>&nbsp;&nbsp;
                    <?php if($row['status']==2 && $account_type != 'users'){if($row['attended_status']==1){?><a href="<?php echo base_url(); ?>main/appointment/attended_status/<?= $row['appointment_id'];?>/0"><span style="color: green"><i class="fa fa-dot-circle-o fa-lg" aria-hidden="true" title="Attended"></i>&nbsp;&nbsp;</span></a><?php }elseif($row['attended_status']==0){?><a href="<?php echo base_url(); ?>main/appointment/attended_status/<?= $row['appointment_id'];?>/1"><span style="color: red"><i class="fa fa-dot-circle-o fa-lg" aria-hidden="true" title="Not-Attended"></i>&nbsp;&nbsp;</span></a><?php }}elseif($row['status']!=2 || $account_type == 'users'){if($row['attended_status']==1){?><span style="color: brown;"><i class="fa fa-dot-circle-o fa-lg" aria-hidden="true" title="Attended"></i>&nbsp;&nbsp;</span><?php }elseif($row['attended_status']==0){?><span style="color: brown"><i class="fa fa-dot-circle-o fa-lg" aria-hidden="true" title="Not-Attended"></i>&nbsp;&nbsp;</span><?php }}?>
                </td>
            </tr>
    <?php 
    }
    }
}
    function get_inpatient_status($id){
    $account_type=$this->session->userdata('login_type');

if($account_type == 'superadmin'){
if($id=='all'){
$patient_info=$this->db->order_by('id','desc')->get('inpatient')->result_array();
}elseif($id!='all'){
  $patient_info=$this->db->order_by('id','desc')->get_where('inpatient',array('status'=>$id))->result_array();
}
}elseif($account_type == 'hospitaladmins'){
if($id=='all'){
$patient_info=$this->db->where('hospital_id',$this->session->userdata('hospital_id'))->order_by('id','desc')->get('inpatient')->result_array();
}elseif($id!='all'){
  $patient_info=$this->db->where('hospital_id',$this->session->userdata('hospital_id'))->order_by('id','desc')->get_where('inpatient',array('status'=>$id))->result_array();
}
}elseif($account_type == 'doctors'){
    if($id=='all'){
$patient_info=$this->db->where('doctor_id',$this->session->userdata('login_user_id'))->order_by('id','desc')->get('inpatient')->result_array();
}elseif($id!='all'){
    $patient_info=$this->db->where('doctor_id',$this->session->userdata('login_user_id'))->order_by('id','desc')->get_where('inpatient',array('status'=>$id))->result_array();
}
}elseif($account_type == 'users'){
       if($id=='all'){
$patient_info=$this->db->where('user_id',$this->session->userdata('login_user_id'))->order_by('id','desc')->get('inpatient')->result_array();
}elseif($id!='all'){
    $patient_info=$this->db->where('user_id',$this->session->userdata('login_user_id'))->order_by('id','desc')->get_where('inpatient',array('status'=>$id))->result_array();
}
}elseif($account_type == 'nurse'){
    $res=explode(',',$this->db->where('nurse_id',$this->session->userdata('login_user_id'))->get('nurse')->row()->doctor_id);
    for($n=0;$n<count($res);$n++){
        if($id=='all'){
        $inpatient=$this->db->order_by('id','desc')->where('doctor_id',$res[$n])->get('inpatient')->result_array();
        }elseif($id!='all'){
        $inpatient=$this->db->order_by('id','desc')->where('doctor_id',$res[$n])->get_where('inpatient',array('status'=>$id))->result_array();
        }
        if($inpatient!=''){
            $inpatient1[]=$inpatient;
        }
    }
     for($i=0;$i<count($inpatient1);$i++){
    for($j=0;$j<count($inpatient1[$i]);$j++){
 $patient_info[]=$inpatient1[$i][$j];
 }   
}
}elseif($account_type == 'receptionist'){
    $res=explode(',',$this->db->where('receptionist_id',$this->session->userdata('login_user_id'))->get('receptionist')->row()->doctor_id);
    for($n=0;$n<count($res);$n++){
        if($id=='all'){
        $inpatient=$this->db->order_by('id','desc')->where('doctor_id',$res[$n])->get('inpatient')->result_array();
        }elseif($id!='all'){
        $inpatient=$this->db->order_by('id','desc')->where('doctor_id',$res[$n])->get_where('inpatient',array('status'=>$id))->result_array();
        }
        if($inpatient!=''){
            $inpatient1[]=$inpatient;
        }
    }
      for($i=0;$i<count($inpatient1);$i++){
    for($j=0;$j<count($inpatient1[$i]);$j++){
 $patient_info[]=$inpatient1[$i][$j];
 }   
}

}$i=1;foreach ($patient_info as $row) {
    if($row!=''){
?>
<tr>
                <td><input type="checkbox" name="check[]" class="check" id="check" value="<?php echo $row['lab_id'] ?>"></td>
                <!-- <td><?= $i;?></td> -->
                <td><?php $user=$this->db->where('user_id',$row['user_id'])->get('users')->row();
                if($account_type != 'users'){?><a href="<?php echo base_url()?>main/edit_inpatient/<?= $row['id']?>" class="hiper"><?php echo $user->name.' / '.$user->unique_id;?></a><?php }elseif($account_type == 'users'){?><?php echo $user->name.' / '.$user->unique_id;}?></td>
                 <td><?php echo $this->db->where('hospital_id',$row['hospital_id'])->get('hospitals')->row()->name;?></a></td>
                <td><?php echo $this->db->where('doctor_id',$row['doctor_id'])->get('doctors')->row()->name;?></td>
                <td><?php echo date('M d,Y',strtotime($row['created_date']));?></td>
                <td><?php echo $row['reason']; ?></td>
                <td><?php echo $this->db->get_where('bed',array('bed_id'=>$row['bed_id']))->row()->name; ?></td>
                 <td><?php if($row['status'] == 0){echo "Recommended";}elseif($row['status'] == 1){ echo "Admitted";}elseif($row['status'] == 2){ echo "Discharged";}?></td>
                <?php if($account_type=='users'){?>
                <td><?php if($row['show_status']==1){?><a href="<?php echo base_url(); ?>main/inpatient/status/<?= $row['id'];?>/2"><span style="color: green"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo "Visible";?></span></a><?php }elseif($row['show_status']==2){?><a href="<?php echo base_url(); ?>main/inpatient/status/<?= $row['id'];?>/1"><span style="color: red"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo "Hidden";?></span></a><?php }?></td><?php }?> 
               <td>
              <a href="<?php echo base_url();?>main/inpatient_history/<?php echo $row['id']?>" title="View History"><i class="menu-icon fa fa-eye"></i>
              </a>&nbsp;&nbsp; 
                      <?php if(($account_type=='superadmin' || $account_type=='hospitaladmins' || $account_type=='doctors' || $account_type=='users') && $row['status']==0){?>
              <a href="#" onclick="confirm_modal('<?php echo base_url();?>main/inpatient/delete/<?php echo $row['id']?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a><?php }?>
                </td>
            </tr>
<?php
}$i++;}
    }
    function get_ajax_message(){
$account_type   = $this->session->userdata('login_type');
$account_details=$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id');
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
$account_details=array($this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id'));
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
$account_details=$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id');
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
$account_details=$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id');
        $notification_data=$this->crud_model->select_notification();
        $j=0;foreach($notification_data as $row){
            if($row['isRead']==2){
                $j=$j+1;
            }
    }
    echo '<span class="label label-info">'.$j.'</span>';
    }
    function get_ajax_appointments(){
        $account_type   = $this->session->userdata('login_type');
$account_details=$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id');
         
    if(($_GET['sd']!='' && $_GET['ed']!='' && $_GET['status_id']!='') || ($_GET['sd']!='' && $_GET['ed']!='' && $_GET['status_id']=='') || ($_GET['sd']=='' && $_GET['ed']=='' && $_GET['status_id']!='')){
            $appointment_info=$this->crud_model->select_appointment_info_by_date($_GET['sd'],$_GET['ed'],$_GET['status_id']);
        }else{$appointment_info=$this->crud_model->select_appointment_info();}?>
         <thead>
        <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value=""></th>
            <th data-field="id" data-sortable="true"><?php echo get_phrase('appointment_no.');?></th> 
            <th data-field="user" data-sortable="true"><?php echo get_phrase('user');?></th>
            <th data-field="doctor" data-sortable="true"><?php echo get_phrase('doctor');?></th>
            <th data-field="hospital" data-sortable="true"><?php echo get_phrase('Hospital-Branch-Department');?></th>  
            <th data-field="city" data-sortable="true"><?php echo get_phrase('city');?></th> 
            <th data-field="date" data-sortable="true"><?php echo get_phrase('date & time');?></th>
            <th data-field="status" data-sortable="true"><?php echo get_phrase('status'); ?></th>
            <th><?php echo get_phrase('options');?></th>
        </tr> 
    </thead>
    <tbody>
        <?php $i=1;foreach ($appointment_info as $row) {
            ?>  
            <tr>
                <td><input type="checkbox" name="check[]" class="check" id="check_<?php echo $i;?>" value="<?php echo $row['appointment_id'] ?>"></td>
                 <td><a href="<?php echo base_url(); ?>main/edit_appointment/<?php echo $row['appointment_id'] ?>" class="hiper"><?php echo $row['appointment_number'] ?></a></td>
                <td>
             <a href="<?php echo base_url();?>main/edit_user/<?php echo $row['user_id']?>" class="hiper"><?php $name = $this->db->get_where('users' , array('user_id' => $row['user_id'] ))->row()->name;
                        echo $name;?></a>
                </td>
                 <td>
                <a href="<?php echo base_url();?>main/edit_doctor/<?php echo $row['doctor_id']?>" class="hiper"><?php $name = $this->db->get_where('doctors' , array('doctor_id' => $row['doctor_id'] ))->row()->name;
                        echo $name;?></a>
                </td>
                <td>
                    <?php 
                    $branch=$this->db->get_where('branch' , array('branch_id' => $this->db->where('doctor_id',$row['doctor_id'])->get('doctors')->row()->branch_id))->row();
                    $hospital=$this->db->get_where('hospitals' , array('hospital_id' => $this->db->where('branch_id',$branch->branch_id)->get('branch')->row()->hospital_id))->row();
                    if($row['department_id'] == 0){$name='All Departments';}else{$name = $this->db->get_where('department' , array('department_id' => $row['department_id'] ))->row()->name;}
                        echo $hospital->name.' - '.$branch->name.' - '.$name;?>
                </td>
                 <td><?php echo $this->db->where('city_id',$branch->city)->get('city')->row()->name;?></td> 
                <td><?php echo date("d M, Y",strtotime($row['appointment_date']));?><br/><?php echo date("h:i A", strtotime($row['appointment_time_start'])).' - '.date("h:i A", strtotime($row['appointment_time_end']));?></td>
                <td><?php if($row['status'] == 1){echo "<button type='button' class='btn-danger'>Pending</button>";   
                 }
                 elseif($row['status'] == 2){ echo "<button type='button' class='btn-success'>Confirmed</button>";}
                 elseif($row['status'] == 3){ echo "<button type='button' class='btn-info'>Cancelled</button>";}
                 elseif($row['status'] == 4){ echo "<button type='button' class='btn-warning'>Closed</button>";}
                 ?>
                     
                 </td>
                <td>
                    <?php if($account_type=='superadmin'){?>
                    <a href="#" onclick="confirm_modal('<?php echo base_url();?>main/appointment/delete/<?php echo $row['appointment_id']?>');" id="dellink_2" class="delbtn" data-toggle="modal" data-target=".bs-example-modal-sm" data-id="2" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
                    <?php }?>
                    <?php if($row['status']==2 && $account_type != 'users'){if($row['attended_status']==1){?><a href="<?php echo base_url(); ?>main/appointment/attended_status/<?= $row['appointment_id'];?>/0"><span style="color: green"><i class="fa fa-dot-circle-o fa-lg" aria-hidden="true" title="Attended"></i>&nbsp;&nbsp;</span></a><?php }elseif($row['attended_status']==0){?><a href="<?php echo base_url(); ?>main/appointment/attended_status/<?= $row['appointment_id'];?>/1"><span style="color: red"><i class="fa fa-dot-circle-o fa-lg" aria-hidden="true" title="Not-Attended"></i>&nbsp;&nbsp;</span></a><?php }}elseif($row['status']!=2 || $account_type == 'users'){if($row['attended_status']==1){?><span style="color: brown;"><i class="fa fa-dot-circle-o fa-lg" aria-hidden="true" title="Attended"></i>&nbsp;&nbsp;</span><?php }elseif($row['attended_status']==0){?><span style="color: brown"><i class="fa fa-dot-circle-o fa-lg" aria-hidden="true" title="Not-Attended"></i>&nbsp;&nbsp;</span><?php }}?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
        <script>
    $(document).ready(function(){
        $("#delete1").show();
        $("#delete").hide();
        $("#close1").show();
        $("#close").hide();
        $("#cancel1").show();
        $("#cancel").hide();
 $(".all_check").click(function () {
    if($(this).prop("checked") == true){
                $("#delete1").hide();
                $("#delete").show();
                $("#close1").hide();
                $("#close").show();
                $("#cancel1").hide();
                $("#cancel").show();
            }
            else if($(this).prop("checked") == false){
                $("#delete1").show();
                $("#delete").hide();
                $("#close1").show();
                $("#close").hide();
                $("#cancel1").show();
                $("#cancel").hide();
            }
     $('input:checkbox').not(this).prop('checked', this.checked);
 });
         $(".check").click(function(){
            if(($(".check:checked").length)!=0){
            $("#delete1").hide();
            $("#delete").show();
            $("#close1").hide();
            $("#close").show();
            $("#cancel1").hide();
            $("#cancel").show();
        if($(".check").length == $(".check:checked").length) {
            $("#all_check").attr("checked", "checked");
        } else {
            $("#all_check").removeAttr("checked");
        }
    }else{
        $("#delete1").show();
        $("#delete").hide();
        $("#close1").show();
        $("#close").hide();
        $("#cancel1").show();
        $("#cancel").hide();
    }
    });
    });
</script>
        <?php 
    }
}
?>
