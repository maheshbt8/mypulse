<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Ajax extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();   
        $this->load->library('session');
        date_default_timezone_set('Asia/Kolkata');    
        error_reporting(0);  
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
       /* if ($this->session->userdata('superadmin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }*/
    }
    function get_otp()
    {
        $date_val=$_POST['phone'];
        $num="12345678901234567890";
        $shu=str_shuffle($num);
        $otp=substr($shu, 14);
        $this->session->set_userdata('otp_time',date('Y-m-d H:i:s'));
        $this->session->set_userdata('otp',$otp);
        echo $this->session->userdata('otp');
    }
    function get_email()
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
        $ward = $this->db->get_where('bed' , array('ward_id' => $ward_id
        ))->result_array();
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
        echo '<input type="hidden" name="user_id" value="'.$users['user_id'].'">';
        }else{
            echo '<input type="text" name="user" class="form-control"  autocomplete="off" id="user" list="users" placeholder="e.g. Enter User Email, Mobile Number or User ID" data-validate="required" data-message-required="Value Required" value="" onchange="return get_user_data(this.value)"><span style="color:red;">No User Available</span>';
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
            echo '<option value="'.date('h:i a',$start_time1) .' - '.date('h:i a', $start_time2).'" >' . date('h:i a',$start_time1) .' - '.date('h:i a', $start_time2).'</option>';
        }
            
            $start_time1=$start_time2;
        }

        }
        }else{
        echo '<option value=""> No Slot Available In This Date </option>';
    }
    }
    function get_inpatient_status($id){
    $account_type=$this->session->userdata('login_type');
          if($account_type == 'superadmin'){
  $patient_info=$this->db->order_by('id','desc')->get_where('inpatient',array('status'=>$id))->result_array();
}elseif($account_type == 'hospitaladmins'){
  $patient_info=$this->db->where('hospital_id',$this->session->userdata('hospital_id'))->order_by('id','desc')->get_where('inpatient',array('status'=>$id))->result_array();
}elseif($account_type == 'doctors'){
    $patient_info=$this->db->where('doctor_id',$this->session->userdata('login_user_id'))->order_by('id','desc')->get_where('inpatient',array('status'=>$id))->result_array();
}elseif($account_type == 'users'){
    $patient_info=$this->db->where('user_id',$this->session->userdata('login_user_id'))->order_by('id','desc')->get_where('inpatient',array('status'=>$id))->result_array();
}elseif($account_type == 'nurse'){
    $res=explode(',',$this->db->where('nurse_id',$this->session->userdata('login_user_id'))->get('nurse')->row()->doctor_id);
    for($n=0;$n<count($res);$n++){
        $patient_info[]=$this->db->where('doctor_id',$res[$n])->get_where('inpatient',array('status'=>$id))->row_array();
    }
}elseif($account_type == 'receptionist'){
    $res=explode(',',$this->db->where('receptionist_id',$this->session->userdata('login_user_id'))->get('receptionist')->row()->doctor_id);
    for($n=0;$n<count($res);$n++){
        $inpatient=$this->db->where('doctor_id',$res[$n])->get_where('inpatient',array('status'=>$id))->row_array();
        if($inpatient!=''){
            $patient_info[]=$inpatient;
        }
    }
}
$i=1;foreach ($patient_info as $row) {
    if($row!=''){
?>
<tr><!-- 
                <td><input type="checkbox" name="check[]" class="check" id="check" value="<?php echo $row['lab_id'] ?>"></td> -->
                <td><?= $i;?></td>
                <td><?php $user=$this->db->where('user_id',$row['user_id'])->get('users')->row();
                if($account_type != 'users'){?><a href="<?php echo base_url()?>main/edit_inpatient/<?= $row['id']?>" class="hiper"><?php echo $user->name.' / '.$user->unique_id;?></a><?php }elseif($account_type == 'users'){?><?php echo $user->name.' / '.$user->unique_id;}?></td>
                 <td><?php echo $this->db->where('hospital_id',$row['hospital_id'])->get('hospitals')->row()->name;?></a></td>
                <td><?php echo $this->db->where('doctor_id',$row['doctor_id'])->get('doctors')->row()->name;?></td>
                <td><?php echo date('M d,Y',strtotime($row['created_date']));?></td>
                <td><?php echo $row['reason']; ?></td>
                <td><?php echo $this->db->get_where('bed',array('bed_id'=>$row['bed_id']))->row()->name; ?></td>
                 <td><?php if($row['status'] == 0){echo "Recommended";}elseif($row['status'] == 1){ echo "Admitted";}elseif($row['status'] == 2){ echo "Discharged";}?></td> 
               <td>
              <a href="<?php echo base_url();?>main/inpatient_history/<?php echo $row['id']?>" title="View History"><i class="menu-icon fa fa-eye"></i></a> 
                </td>
            </tr>
<?php
}$i++;}
/*elseif($account_type == 'hospitaladmins'){
  return $this->db->where('hospital_id',$this->session->userdata('hospital_id'))->order_by('id','desc')->get_where('inpatient',array('status'=>1))->result_array();
}elseif($account_type == 'doctors'){
    return $this->db->where('doctor_id',$this->session->userdata('login_user_id'))->order_by('id','desc')->get_where('inpatient',array('status'=>1))->result_array();
}elseif($account_type == 'users'){
    return $this->db->where('user_id',$this->session->userdata('login_user_id'))->order_by('id','desc')->get_where('inpatient',array('status'=>1))->result_array();
}elseif($account_type == 'nurse'){
    $res=explode(',',$this->db->where('nurse_id',$this->session->userdata('login_user_id'))->get('nurse')->row()->doctor_id);
    for($n=0;$n<count($res);$n++){
        $inpatient[]=$this->db->where('doctor_id',$res[$n])->get_where('inpatient',array('status'=>1))->row_array();
    }
    return $inpatient;
}elseif($account_type == 'receptionist'){
    $res=explode(',',$this->db->where('receptionist_id',$this->session->userdata('login_user_id'))->get('receptionist')->row()->doctor_id);
    for($n=0;$n<count($res);$n++){
        $inpatient=$this->db->where('doctor_id',$res[$n])->get_where('inpatient',array('status'=>1))->row_array();
        if($inpatient!=''){
            $inpatient1[]=$inpatient;
        }
    }
    return $inpatient1;
}*/
    }
}
?>