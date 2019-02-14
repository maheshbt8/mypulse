<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Index_model extends CI_Model {

public function user_login($unm = '', $pwd = ''){
        $where = "(email='".$unm."' OR phone='".$unm."') AND password='".sha1($pwd)."' AND status='1'  AND is_mobile='1' AND isDeleted='1'";
        $this->db->select('user_id,name,unique_id,email');
        $query = $this->db->where($where)->get('users')->row_array();
        if(!empty($query))
        {
        return $query;
        }else{
		return false;
		}
	}
    /**********************Basic Required*****************************/
    public function get_country(){
        $this->db->select('country_id,name as country_name');
        $country = $this->db->get('country')->result_array();
        if(!empty($country))
        {
        return $country;
        }else{
        return false;
        } 
    }
        function get_state($country_id)
    {
        $this->db->select('state_id,name as state_name');
        $state = $this->db->get_where('state' , array('country_id' => $country_id))->result_array();
        if(!empty($state))
        {
        return $state;
        }else{
        return false;
        } 
    }
    function get_district($state_id)
    {
        $this->db->select('district_id,name as district_name');
        $district = $this->db->get_where('district' , array('state_id' => $state_id))->result_array();
        if(!empty($district))
        {
        return $district;
        }else{
        return false;
        } 
    }
     function get_city($district_id)
    {
        $this->db->select('city_id,name as city_name');
        $city = $this->db->get_where('city' , array('district_id' => $district_id))->result_array();
        if(!empty($city))
        {
        return $city;
        }else{
        return false;
        } 
    }
     function get_medicalstores_info()
    {
        $this->db->select('store_id,unique_id,name as store_name');
        $medicalstores = $this->db->get_where('medicalstores' , array('status' =>'1','isDeleted'=>'1'))->result_array();
        if(!empty($medicalstores))
        {
        return $medicalstores;
        }else{
        return false;
        } 
    }
      function get_medicallabs_info()
    {
        $this->db->select('lab_id,unique_id,name as lab_name');
        $medicallabs = $this->db->get_where('medicallabs' , array('status' =>'1','isDeleted'=>'1'))->result_array();
        if(!empty($medicallabs))
        {
        return $medicallabs;
        }else{
        return false;
        } 
    }
    /**********************Header*****************************/
    function get_languages(){
        $this->db->select('language_id,name as language_name');
        $data=$this->db->get('language')->result_array();
        if(!empty($data)){
            return $data;
        }else{
            return false;
        }
    }
    function get_messages($id)
    {
$account_type   = 'users';
$account_details='users-user-'.$id;
    $message_data=$this->db->order_by('message_id','DESC')->get('messages')->result_array();
    $i=0;$j=0; foreach ($message_data as $row) {
    $created_by=explode('-',$row['created_by']);
    $message1=explode(',',$row['group_ids']);
    $message2=explode(',',$row['user_ids']);
    $hospi='';
    for($m1=0;$m1<count($message1);$m1++){
    if($message1[$m1] == 1){
    $hospi='hospitaladmins';    
    }elseif($message1[$m1] == 2){
    $hospi='medicallabs';
    }elseif($message1[$m1] == 3){
    $hospi='medicalstores';
    }elseif($message1[$m1] == 4){
    $hospi='doctors';
    }elseif($message1[$m1] == 5){
    $hospi='nurse';
    }elseif($message1[$m1] == 6){
    $hospi='receptionist';
    }elseif($message1[$m1] == 7){
    $hospi='users';
    }
    $hospi1='';
        /*$created_by=explode('-',$row['created_by']);*/
if($created_by[0] == 'superadmin'){
  $user_role='Super Admin';
}elseif($created_by[0] == 'hospitaladmins'){
  $user_role='Hospital Admin';
}elseif($created_by[0] == 'doctors'){
  $user_role='Doctor';
}elseif($created_by[0] == 'nurse'){
  $user_role='Nurse';
}elseif($created_by[0] == 'receptionist'){
  $user_role='Receptionist';
}elseif($created_by[0] == 'medicalstores'){
  $user_role='Pharmacist';
}elseif($created_by[0] == 'medicallabs'){
  $user_role='Laboratorist';
}elseif($created_by[0] == 'users'){
  $user_role='MyPulse Users';
}
$created=$user_role.' - '.$this->db->where($created_by[1].'_id',$created_by[2])->get($created_by[0])->row()->name;

  for($m2=0;$m2<count($message2);$m2++){
    if($message2[$m2] == $account_details){
    $hospi1=$message2[$m2];    
    }
  }
    if($account_type == 'superadmin'){
    if($hospi1 == $account_details || $hospi==$account_type)
              {
            $row['created_by']=$created;
             $result[]=$row;   
              }  
    }elseif($created_by[0] != 'doctors'){
    if(($hospi1 == $account_details || $hospi==$account_type) && (($row['hospital_id'] == 0 || $row['hospital_id'] == $this->session->userdata('hospital_id')) || $account_type=='users'))
              {
                $row['created_by']=$created;
    $result[]=$row;
        }
        }elseif($created_by[0] == 'doctors'){
             $doctor=$this->db->where('user_id',$id)->get('patient')->row();
        if($doctor>0){
        $doctor_ids=explode(',',$doctor->doctor_ids);
        for($i=0;$i<count($doctor_ids);$i++){
            if($doctor_ids[$i]!=''){
            $doct=$this->db->where('doctor_id',$doctor_ids[$i])->get_where('doctors',array('status'=>'1','isDeleted'=>'1'));
        if($doct->num_rows()>0){
        $doctors[$i]=$doct->row_array();
        }
            }
        }
        }
        $users=$doctors;
        //$users=$this->crud_model->select_doctor_info();
        foreach ($users as $user) {
    if(($hospi1 == $account_details || $hospi==$account_type) &&  $row['created_by'] == 'doctors-doctor-'.$user['doctor_id'])
        {
            $row['created_by']=$created;
        $result[]=$row;
        }
        }
    }
    $i++;}

      }
      if(!empty($result))
        {
        return $result;
        }else{
        return false;
        } 
    }
function read_message($id,$message_id)
    {
$account_details='users-user'.$id;
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
    $yes=$this->db->where('message_id',$message_id)->update('messages',$data);
    if($yes){
        $this->db->select('message_id,created_by,title,message,created_at');
        $message=$this->db->where('message_id',$message_id)->get('messages')->row_array();
        $created_by=explode('-',$message['created_by']);
if($created_by[0] == 'superadmin'){
  $user_role='Super Admin';
}elseif($created_by[0] == 'hospitaladmins'){
  $user_role='Hospital Admin';
}elseif($created_by[0] == 'doctors'){
  $user_role='Doctor';
}elseif($created_by[0] == 'nurse'){
  $user_role='Nurse';
}elseif($created_by[0] == 'receptionist'){
  $user_role='Receptionist';
}elseif($created_by[0] == 'medicalstores'){
  $user_role='Pharmacist';
}elseif($created_by[0] == 'medicallabs'){
  $user_role='Laboratorist';
}elseif($created_by[0] == 'users'){
  $user_role='MyPulse Users';
}
$message['created_by']=$user_role.' - '.$this->db->where($created_by[1].'_id',$created_by[2])->get($created_by[0])->row()->name;
    return $message;
    }else{
    return FALSE;
    }
    }
function get_notifications($id){
$account_details='users-user-'.$id;
$this->db->select('id,title,text,isRead,created_at');
$notification_data=$this->db->order_by('id','desc')->get_where('notification',array('user_id'=>$account_details))->result_array();
    if(!empty($notification_data))
        {
            foreach ($notification_data as $row) {
                if($row['isRead']==1){
                    $a=TRUE;
                }elseif($row['isRead']==2){
                    $a=FALSE;
                }
                $row['isRead']=$a;
                $results[]=$row;
            }
        return $results;
        }else{
        return false;
        }
}
    function get_notification_count($id){
$account_details='users-user-'.$id;
$notification_data=$this->db->order_by('id','desc')->get_where('notification',array('user_id'=>$account_details,'isRead'=>2))->num_rows();
    return $notification_data;
    }
function read_notification($notification_id)
    {
        $result=$this->db->where('id',$notification_id)->get('notification')->row_array();
        if($result['isRead']=='2'){
        $this->db->where('id',$notification_id)->update('notification',array('isRead'=>'1'));
        }
        if(!empty($result))
        {
            $this->db->select('id,title,text,created_at');
        $result=$this->db->where('id',$notification_id)->get('notification')->row_array();
        return $result;
        }else{
        return false;
        }
    }
    public function select_user_info($user_id){
    $this->db->select('u.user_id,u.unique_id,u.name,u.mname,u.lname,u.description,u.email,u.phone,u.gender,u.dob,u.address,u.country,u.state,u.district,u.city,u.blood_group,u.age,u.height,u.weight,u.blood_pressure,u.sugar_level,u.health_insurance_provider,u.health_insurance_id,u.family_history,u.past_medical_history,c.name as country_name,s.name as state_name,d.name as district_name,ci.name as city_name');
    $this->db->from('users as u')->join('country as c', 'c.country_id = u.country')->join('state as s', 's.state_id = u.state')->join('district as d', 'd.district_id = u.district')->join('city as ci', 'ci.city_id = u.city');;
    $this->db->where('user_id', $user_id);
    $yes=$this->db->get()->row_array();
    if(!empty($yes))
    {
    return $yes;
        }else{
        return false;
        }
    }
     function update_user_info()
    {
        $user_id   = $this->post('user_id');
        $data['name']      = $this->post('fname');
        $data['mname']      = $this->post('mname');
        $data['lname']      = $this->post('lname');
        $data['email']      = $this->post('email');
        $data['description'] = $this->post('description');
        $data['country']   = $this->post('country');
        $data['state']   = $this->post('state');
        $data['district']   = $this->post('district');
        $data['city']   = $this->post('city');
        $data['address']    = $this->post('address');
        $data['phone']          = $this->post('mobile');
        $data['gender']            = $this->post('gender');
        $data['dob']     = date('m/d/Y',strtotime($this->post('dob')));
        $data['age']            = $this->post('age');
        $data['blood_group']    = $this->post('blood_group');
        //$data['aadhar']     = $this->post('aadhar');
        $data['height']     = $this->post('height');
        $data['weight']     = $this->post('weight');
        $data['blood_pressure'] = $this->post('blood_pressure');
        $data['sugar_level']    = $this->post('sugar_level');
        $data['health_insurance_provider']  = $this->post('health_insurance_provider');
        $data['health_insurance_id']    = $this->post('health_insurance_id');
        $data['family_history']     = $this->post('family_history');
         $data['past_medical_history']  = $this->post('past_medical_history');
          $data['status']   = '1';
        $data['modified_at']=date('Y-m-d H:i:s');
        $this->db->where('user_id',$user_id);
        $update=$this->db->update('users',$data);
        if($update){
        if($_FILES['userfile']['tmp_name']!=''){
        unlink('uploads/user_image/'. $user_id.  '.jpg');
        move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/user_image/" . $user_id . '.jpg');
        }
        return true;
        }else{
            return false;
        }
    }
    public function change_password($user_id, $new_password){         
    $this->db->where('user_id', $user_id);
    $yes=$this->db->update('users', array('password' => $new_password));
    if($yes)
    {
    return TRUE;
        }else{
        return false;
        }
    }
    /**********************Dashboard**********************/
    function select_upcoming_appointments($id){
$where=array('a.user_id'=>$id,'a.appointment_date >='=>date('Y-m-d'),'a.status'=>'2');
$this->db->select('a.appointment_id,a.appointment_number,a.doctor_id,a.appointment_date,a.appointment_time_start,a.appointment_time_end,d.name as doctor_name,h.name as hospital_name,b.name as branch_name,dep.name as department_name');
$this->db->from('appointments as a')->join('doctors as d', 'd.doctor_id = a.doctor_id')->join('hospitals as h', 'h.hospital_id = d.hospital_id')->join('branch as b', 'b.branch_id = d.branch_id')->join('department as dep', 'dep.department_id = d.department_id');
$results=$this->db->order_by('appointment_number','DESC')->where($where)->get()->result_array();
if(!empty($results)){
        return $results; 
        }else{
        return false;
        }
    }
function select_recommend_appointments($id){
$where=array('a.user_id'=>$id,'a.next_appointment!='=>'','a.next_appointment>='=>date('Y-m-d'));
$this->db->select('a.appointment_id,a.appointment_number,a.doctor_id,a.next_appointment,d.name as doctor_name,h.name as hospital_name,b.name as branch_name,dep.name as department_name');
$this->db->from('appointments as a')->join('doctors as d', 'd.doctor_id = a.doctor_id')->join('hospitals as h', 'h.hospital_id = d.hospital_id')->join('branch as b', 'b.branch_id = d.branch_id')->join('department as dep', 'dep.department_id = d.department_id');
$results=$this->db->order_by('appointment_number','DESC')->where($where)->get()->result_array();
if(!empty($results)){
        return $results; 
        }else{
        return false;
        }
    }
    function outstanding_prescriptions_medicines($id){
        $this->db->select('prescription_id,prescription_data,created_at');
$prescription_info=$this->db->order_by('prescription_id','desc')->get_where('prescription',array('user_id'=>$id,'medicin_status'=>2))->result_array();
 foreach ($prescription_info as $row1) {
            $prescription_data=explode('|',$this->encryption->decrypt($row1['prescription_data']));
            $out_pre['prescription_id']=$row1['prescription_id'];
            if($prescription_data[1]!=''){
                $out_pre['prescription_title']=$prescription_data[0];
            }
            $out_pre['created_at']=$row1['created_at'];
            $data[]=$out_pre;
        }
if(!empty($data)){
        return $data; 
        }else{
        return false;
        }
    }
      function outstanding_prescriptions_tests($id){
        $this->db->select('prescription_id,prescription_data,created_at');
$prescription_info=$this->db->order_by('prescription_id','desc')->get_where('prescription',array('user_id'=>$id,'test_status'=>2))->result_array();
  foreach ($prescription_info as $row1) {
            $prescription_data=explode('|',$this->encryption->decrypt($row1['prescription_data']));
            $out_pre['prescription_id']=$row1['prescription_id'];
            if($prescription_data[7]!=''){
                $out_pre['prescription_title']=$prescription_data[0];
            }
            $out_pre['created_at']=$row1['created_at'];
            $data[]=$out_pre;
        }
if(!empty($data)){
        return $data; 
        }else{
        return false;
        }
    }
    /**********************MENU*****************************/
	public function select_hospitals_info($id = ''){
	$hospital=$this->db->where('user_id',$id)->get('patient')->row()->hospital_ids;
        if($hospital>0){
        $hospital_ids=explode(',',$hospital);
        if($hospital_ids != ''){
        for($i=0;$i<count($hospital_ids);$i++){
        	$this->db->select('hospital_id,unique_id,name');
            $hospital=$this->db->where('hospital_id',$hospital_ids[$i])->get('hospitals');
            if($hospital->num_rows()>0){
                $hospi[$i]=$hospital->row_array();
            }
            }
        }
        }
        if($hospi){
		return $hospi; 
		}else{
		return false;
		}
    }
    public function select_hospital_info($id = '',$limit=null, $start=null){
$this->db->select('h.hospital_id,h.unique_id,h.name,h.email,h.phone_number,h.address,h.description,h.md_name,h.md_contact_number,c.name as country_name,s.name as state_name,d.name as district_name,ci.name as city_name');
$this->db->from('hospitals as h')->join('country as c', 'c.country_id = h.country')->join('state as s', 's.state_id = h.state')->join('district as d', 'd.district_id = h.district')->join('city as ci', 'ci.city_id = h.city');
/*$this->db->limit($limit, $start);*/
$hospi=$this->db->where('hospital_id',$id)->get()->row_array();
        if($hospi){
		return $hospi; 
		}else{
		return false;
		}
    }
    function delete_patient_hospital($id,$hospital_id)
    {
$patient_data=$this->db->get_where('patient',array('user_id'=>$id))->row();
$hospital_doctors=$this->db->select('doctor_id')->get_where('doctors',array('hospital_id'=>$hospital_id))->result_array();
$hospital_stores=$this->db->select('store_id')->get_where('medicalstores',array('hospital'=>$hospital_id))->result_array();
$hospital_labs=$this->db->select('lab_id')->get_where('medicallabs',array('hospital'=>$hospital_id))->result_array();
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
$this->db->where('user_id',$id);
$yes=$this->db->update('patient',array('hospital_ids'=>implode(',',$hospi),'doctor_ids'=>implode(',',$docs),'store_ids'=>implode(',',$store),'lab_ids'=>implode(',',$lab)));
if($doctors){
        return TRUE; 
        }else{
        return false;
        }
}
    public function select_doctors_info($id = ''){
	$doctor=$this->db->where('user_id',$id)->get('patient')->row();
        if($doctor>0){
        $doctor_ids=explode(',',$doctor->doctor_ids);
        for($i=0;$i<count($doctor_ids);$i++){
            if($doctor_ids[$i]!=''){
                $where=array('doctor_id'=>$doctor_ids[$i],'d.status'=>'1','d.isDeleted'=>'1');
            $this->db->select('d.doctor_id,d.unique_id,d.name,h.name as hospital_name,b.name as branch_name,dep.name as department_name');
            $this->db->from('doctors as d')->join('hospitals as h', 'h.hospital_id = d.hospital_id')->join('branch as b', 'b.branch_id = d.branch_id')->join('department as dep', 'dep.department_id = d.department_id');
            $doc=$this->db->where($where)->get();
            if($doc->num_rows()>0){
            $doctors[$i]=$doc->row_array();
            }
            }
        }
        } 
       	if($doctors){
		return $doctors; 
		}else{
		return false;
		}
    }
    public function select_doctor_info($id = ''){
$this->db->select('d.doctor_id,d.unique_id,d.name,d.mname,d.lname,d.description,d.email,d.phone,d.gender,d.dob,d.address,d.qualification,d.specializations,d.experience,d.registration,h.name as hospital_name,b.name as branch_name,dep.name as department_name,c.name as country_name,s.name as state_name,dis.name as district_name,ci.name as city_name');
$this->db->from('doctors as d')->join('hospitals as h', 'h.hospital_id = d.hospital_id')->join('branch as b', 'b.branch_id = d.branch_id')->join('department as dep', 'dep.department_id = d.department_id')->join('country as c', 'c.country_id = d.country', 'left')->join('state as s', 's.state_id = d.state', 'left')->join('district as dis', 'dis.district_id = d.district', 'left')->join('city as ci', 'ci.city_id = d.city', 'left');
$doctor=$this->db->where('doctor_id',$id)->get()->row_array();
$spe=explode(',',$doctor['specializations']);
for($i=0;$i<count($spe);$i++){
    $doc[$i]=$this->db->where('specializations_id',$spe[$i])->get('specializations')->row()->name;
        }
$doctor['specializations']=implode(',',$doc);
$doctor['availability']=$this->db->where('doctor_id',$id)->get('availability')->row()->message;
        if($doctor){
        return $doctor; 
        }else{
        return false;
        }
    }
     function delete_patient_doctor($id,$doctor_id)
    {
$doctor_ids=explode(',',$this->db->get_where('patient',array('user_id'=>$id))->row()->doctor_ids);
for($h=0;$h<count($doctor_ids);$h++){
    if($doctor_ids[$h]!=$doctor_id){
        $doc[]=$doctor_ids[$h];
    }
}
$this->db->where('user_id',$id);
$yes=$this->db->update('patient',array('doctor_ids'=>implode(',',$doc)));
    }
    public function select_stores_info($id = ''){
	$store=$this->db->where('user_id',$id)->get('patient')->row()->store_ids;
        if($store!=''){
            $store_ids=explode(',',$store);
        for($i=0;$i<count($store_ids);$i++){
        	/*$this->db->select('store_id,unique_id,name');*/
            $this->db->select('sto.store_id,sto.unique_id,sto.name,sto.owner_name,sto.owner_mobile,h.name as hospital_name,b.name as branch_name');
$this->db->from('medicalstores as sto')->join('hospitals as h', 'h.hospital_id = sto.hospital')->join('branch as b', 'b.branch_id = sto.branch');
        $stores[$i]=$this->db->where('store_id',$store_ids[$i])->get()->row_array();
            }
        } 
       	if($stores){
		return $stores; 
		}else{
		return false;
		}
    }
      public function select_store_info($id = ''){
$this->db->select('sto.store_id,sto.unique_id,sto.name,sto.description,sto.owner_name,sto.owner_mobile,sto.in_address as incharge_address,sto.fname as incharge_fname,sto.lname as incharge_lname,sto.email,sto.phone,sto.gender,sto.dob,sto.address,sto.qualification,sto.experience,h.name as hospital_name,b.name as branch_name,c.name as country_name,s.name as state_name,dis.name as district_name,ci.name as city_name');
$this->db->from('medicalstores as sto')->join('hospitals as h', 'h.hospital_id = sto.hospital')->join('branch as b', 'b.branch_id = sto.branch')->join('country as c', 'c.country_id = sto.country', 'left')->join('state as s', 's.state_id = sto.state', 'left')->join('district as dis', 'dis.district_id = sto.district', 'left')->join('city as ci', 'ci.city_id = sto.city', 'left');
$store=$this->db->where('store_id',$id)->get()->row_array();
        if($store){
        return $store; 
        }else{
        return false;
        }
    }
    public function delete_patient_store($id,$store_id)
    {
$store_ids=explode(',',$this->db->get_where('patient',array('user_id'=>$id))->row()->store_ids);
for($h=0;$h<count($store_ids);$h++){
    if($store_ids[$h]!=$store_id){
        $doc[]=$store_ids[$h];
    }
}
$this->db->where('user_id',$id);
$yes=$this->db->update('patient',array('store_ids'=>implode(',',$doc)));
    }
    public function select_labs_info($id = ''){
	 $lab=$this->db->where('user_id',$id)->get('patient')->row()->lab_ids;
        if($lab!=''){ 
        $lab_ids=explode(',',$lab);
        for($i=0;$i<count($lab_ids);$i++){
        	/*$this->db->select('lab_id,unique_id,name');*/
$this->db->select('lab.lab_id,lab.unique_id,lab.name,lab.owner_name,lab.owner_mobile,h.name as hospital_name,b.name as branch_name');
$this->db->from('medicallabs as lab')->join('hospitals as h', 'h.hospital_id = lab.hospital')->join('branch as b', 'b.branch_id = lab.branch');
            $labs[$i]=$this->db->where('lab_id',$lab_ids[$i])->get()->row_array();
            }
		} 
       	if($labs){
		return $labs; 
		}else{
		return false;
		}
    }
         public function select_lab_info($id = ''){
$this->db->select('lab.lab_id,lab.unique_id,lab.name,lab.description,lab.owner_name,lab.owner_mobile,lab.in_address as incharge_address,lab.fname as incharge_fname,lab.lname as incharge_lname,lab.email,lab.phone,lab.gender,lab.dob,lab.address,lab.qualification,lab.experience,h.name as hospital_name,b.name as branch_name,c.name as country_name,s.name as state_name,dis.name as district_name,ci.name as city_name');
$this->db->from('medicallabs as lab')->join('hospitals as h', 'h.hospital_id = lab.hospital')->join('branch as b', 'b.branch_id = lab.branch')->join('country as c', 'c.country_id = lab.country', 'left')->join('state as s', 's.state_id = lab.state', 'left')->join('district as dis', 'dis.district_id = lab.district', 'left')->join('city as ci', 'ci.city_id = lab.city', 'left');
$lab=$this->db->where('lab_id',$id)->get()->row_array();
        if($lab){
        return $lab; 
        }else{
        return false;
        }
    }
   public function delete_patient_lab($id,$lab_id)
    {
$lab_ids=explode(',',$this->db->get_where('patient',array('user_id'=>$id))->row()->lab_ids);
for($h=0;$h<count($lab_ids);$h++){
    if($lab_ids[$h]!=$lab_id){
        $doc[]=$lab_ids[$h];
    }
}
$this->db->where('user_id',$id);
$yes=$this->db->update('patient',array('lab_ids'=>implode(',',$doc)));
    }
      public function select_inpatients_info($param1 = '', $param2 = '',$param3='',$param4='')
    {
    if($param3=='all'){
    $data=$this->db->order_by('id','desc')->get_where('inpatient',array('user_id'=>$param4,'created_date >='=>date('Y-m-d 00:00:00',strtotime($param1)),'created_date <='=>date('Y-m-d 23:59:59',strtotime($param2))))->result_array();
    }elseif($param3!='all'){
    $where=array('i.user_id'=>$param4,'i.created_date >='=>date('Y-m-d 00:00:00',strtotime($param1)),'i.created_date <='=>date('Y-m-d 23:59:59',strtotime($param2)),'i.status'=>$param3);
$this->db->select('i.id,i.created_date,i.reason,i.status,d.name as doctor_name,h.name as hospital_name,bed.name as bed_name');
$this->db->from('inpatient as i')->join('doctors as d', 'd.doctor_id = i.doctor_id')->join('hospitals as h', 'h.hospital_id = i.hospital_id')->join('bed as bed', 'bed.bed_id = i.bed_id');
    $data=$this->db->order_by('id','DESC')->where($where)->get()->result_array();

    }   
} 
   public function select_inpatient_info($param1 = '')
    {
    $data=$this->db->get_where('inpatient',array('id'=>$param4))->row_array();
    if(!empty($data)){
        return $data;
    }else{
        return false;
    }
    }   

    public function select_inpatient_history_info($id = ''){
	 $inpatient=$this->db->where('in_patient_id',$id)->get('inpatient_history')->result_array();
       	if($inpatient){
		return $inpatient; 
		}else{
		return false;
		}
    }
    public function select_appointments_info($param1 = '', $param2 = '',$param3='',$param4=''){
	 if($param3=='all'){
    $where=array('a.user_id'=>$param4,'a.appointment_date >='=>$param1,'a.appointment_date <='=>$param2);
$this->db->select('a.appointment_id,a.appointment_number,a.doctor_id,a.appointment_date,a.appointment_time_start,a.appointment_time_end,d.name as doctor_name,h.name as hospital_name,b.name as branch_name,dep.name as department_name');
$this->db->from('appointments as a')->join('doctors as d', 'd.doctor_id = a.doctor_id')->join('hospitals as h', 'h.hospital_id = d.hospital_id')->join('branch as b', 'b.branch_id = d.branch_id')->join('department as dep', 'dep.department_id = d.department_id');
$results=$this->db->order_by('appointment_number','DESC')->where($where)->get()->result_array();  
    }elseif($param3!='all'){
$where=array('a.user_id'=>$param4,'a.appointment_date >='=>$param1,'a.appointment_date <='=>$param2,'a.status'=>$param3);
$this->db->select('a.appointment_id,a.appointment_number,a.doctor_id,a.appointment_date,d.name as doctor_name,h.name as hospital_name,b.name as branch_name,dep.name as department_name');
$this->db->from('appointments as a')->join('doctors as d', 'd.doctor_id = a.doctor_id')->join('hospitals as h', 'h.hospital_id = d.hospital_id')->join('branch as b', 'b.branch_id = d.branch_id')->join('department as dep', 'dep.department_id = d.department_id');
$results=$this->db->order_by('appointment_number','DESC')->where($where)->get()->result_array();   
    }
    if(!empty($results)){
        return $results;
    }else{
        return false;
    }
    }
    public function select_appointment_info($appointment_id){
    $where=array('a.user_id'=>$appointment_id);
$this->db->select('a.appointment_id,a.appointment_number,a.doctor_id,a.appointment_date,a.appointment_time_start,a.appointment_time_end,d.name as doctor_name,h.name as hospital_name,b.name as branch_name,dep.name as department_name');
$this->db->from('appointments as a')->join('doctors as d', 'd.doctor_id = a.doctor_id')->join('hospitals as h', 'h.hospital_id = d.hospital_id')->join('branch as b', 'b.branch_id = d.branch_id')->join('department as dep', 'dep.department_id = d.department_id');
$results=$this->db->order_by('appointment_number','DESC')->where($where)->get()->row_array();  
    if(!empty($results)){
        return $results;
    }else{
        return false;
    }
    }
    public function select_appointment_history_info($id = ''){
	 $appointment_history=$this->db->where('appointment_id',$id)->get('appointment_history')->result_array();
       	if($appointment_history){
		return $appointment_history;
		}else{
		return false;
		}
    }
        function update_appointment_info()
    {
        $appointment_id=$this->post('appointment_id');
    if($this->post('available_slot')!=''){
    $time=explode('-',$this->post('available_slot'));
    $data['appointment_time_start']       = date("H:i", strtotime($time[0]));
    $data['appointment_time_end']       = date("H:i", strtotime($time[1]));
    $data['appointment_date']= date('Y-m-d',strtotime($this->post('appointment_date')));
    $yes=$this->db->where('appointment_id',$appointment_id)->update('appointments',$data);
    if($yes){
        /*******Appointment History********/
        $history['appointment_id']=$appointment_id;
            $history['appointment_date']=$data['appointment_date'];
            $history['appointment_time_start']=$data['appointment_time_start'];
            $history['appointment_time_end']=$data['appointment_time_end'];
            $history['created_by']='users-user'.$this->post('user_id');
            $data['created_time']=date('Y-m-d H:i:s');
            $history_ins=$this->db->insert('appointment_history',$history);
            if($history_ins){
                $last_id=$this->db->insert_id();
                $this->db->where('appointment_history_id',$last_id)->update('appointment_history',array('action'=>5));
            }
    }
    }
    }
    /*Appointment Booking*/
    public function select_doctor_info_appointment(){
        $where=array('d.status'=>'1','d.isDeleted'=>'1');
        $this->db->select('d.doctor_id,d.unique_id,d.name,d.specializations,h.name as hospital_name');
        $this->db->from('doctors as d');
        $this->db->join('hospitals as h','h.hospital_id = d.hospital_id');
    $doctors_details=$this->db->where($where)->get()->result_array();
    foreach($doctors_details as $row){
$row['availability']=$this->db->where('doctor_id',$row['doctor_id'])->get('availability')->row()->message;
        if($row['specializations']!=''){
$spe=explode(',',$row['specializations']);
for($i=0;$i<count($spe);$i++){
$doc[$i]=$this->db->where('specializations_id',$spe[$i])->get('specializations')->row()->name;
        }
$row['specializations']=implode(',',$doc);
}
//$doctor[]=$row;
$doctors[]=$row;
    }
        if($doctors){
        return $doctors;
        }else{
        return false;
        }
    }

    public function get_dco_available_slots($doctor_id,$date_val)
    {
        $date_val=date('m/d/Y',strtotime($date_val));
        $doctor_availability= $this->db->get_where('availability_slot' , array(
            'doctor_id' => $doctor_id,'date'=>$date_val,'status'=>1));
        $doctor_ava=$doctor_availability->result_array();
         $appointments=$this->db->get_where('appointments' , array('doctor_id' => $doctor_id,'appointment_date'=>$date_val))->num_rows();
         if($doctor_availability->num_rows()>0){
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
    $availability[]=date('h:i a',$start_time1) .' - '.date('h:i a', $start_time2);
        }
        }
            $start_time1=$start_time2;
        }

        }
        return $availability;
        }else{
        return false;
    }
    }
    function save_appointment_info()
    {
        //print_r($_POST);die;
        $time=explode('-',$this->post('available_slot'));
        $department=$this->db->where('doctor_id',$this->post('doctor_id'))->get('doctors')->row();
        $data['user_id']       = $this->post('user_id');
        $data['doctor_id']       = $this->post('doctor_id');
        $data['appointment_date']= date('Y-m-d',strtotime($this->post('appointment_date')));
        $data['hospital_id']       = $department->hospital_id;
        $data['department_id']       = $department->department_id;
        $data['appointment_time_start']       = date("H:i", strtotime($time[0]));
        $data['appointment_time_end']       = date("H:i", strtotime($time[1]));
        $data['reason']       = $this->post('reason');
        if($this->post('remarks')){
        $data['remarks']       = $this->post('remarks');
        }
        $data['created_by']       = 'users-user-'.$this->post('user_id');
        $data['created_at']=date('Y-m-d H:i:s');
        $data['modified_at']=date('Y-m-d H:i:s');
        $insert=$this->db->insert('appointments',$data);
        if($insert)
        {
            $lid=$this->db->insert_id();
        /*********** Patient **************/
     $patient_data['user_id']=$this->post('user_id');
    $patient=$this->db->where('user_id',$patient_data['user_id'])->get('patient')->row_array();
if($patient==''){
$patient_data['doctor_ids']=$this->post('doctor_id');
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
$patient_data['doctor_ids']=$this->post('doctor_id');
}elseif($patient['doctor_ids']!=''){
$doc_ar=explode(',',$patient['doctor_ids']);
    for($ho=0;$ho<count($doc_ar);$ho++){
    if($doc_ar[$ho]==$this->post('doctor_id')){
    $patient_data['doctor_ids']=$patient['doctor_ids'];
    break;
    }else{
    $patient_data['doctor_ids']=$patient['doctor_ids'].','.$this->post('doctor_id');
    }
    }
}
$this->db->where('user_id',$this->post('user_id'));
$this->db->update('patient',$patient_data);
}
        /********Appointment Unique Id Generate*****************/
if($lid==1){
$num=100001;
}elseif($lid!=1){
$my=explode('_',$this->db->where('appointment_id',$lid-1)->get('appointments')->row()->appointment_number);
$year=substr ($my[0], -2);
if($year==date('y')){
$num=$my[1]+1;
}else{
$num=100001;
}
}
$pid='MPA'.date('y').'_'.$num;
            $this->db->where('appointment_id',$lid)->update('appointments',array('appointment_number'=>$pid,'status'=>2));
            $history['appointment_id']=$lid;
            $history['appointment_date']=$data['appointment_date'];
            $history['appointment_time_start']=$data['appointment_time_start'];
            $history['appointment_time_end']=$data['appointment_time_end'];
            $history['created_time']=date('Y-m-d H:i:s');
            $history['created_by']=$data['created_by'];
            $history_ins=$this->db->insert('appointment_history',$history);
            if($history_ins){
                $last_id=$this->db->insert_id();
                $ret=$this->db->where('appointment_history_id',$last_id)->update('appointment_history',array('action'=>1));
                if($ret){
                    return TRUE;
                }else{
                    return false;
                }
            }
        }else{
            return false;
        }
    }
       function cancel_appointment_info()
    {
$account_type='users';
$user_role='MyPulse Users';
 $account_details='users-user'.$this->post('user_id');
        $check=$this->post('appointment_ids');
        $reason=$this->post('cancel_reason');
        for($i=0;$i<count($check);$i++){
    $appointment_data=$this->db->where('appointment_id',$check[$i])->get('appointments')->row();
    $appointment_date_time=$appointment_data->appointment_date.' '.$appointment_data->appointment_time_start;
$current_time=date('Y-m-d H:i');
$appointment_date_time_less=date('Y-m-d H:i', strtotime('-2 hours', strtotime($appointment_date_time)));
    if(strtotime($current_time)<strtotime($appointment_date_time_less)){
    $appointment_number=$appointment_data->appointment_number;
    $name=$this->db->where('user_id',$this->post('user_id'))->get('users')->row()->name;
        $this->db->where('appointment_id',$check[$i]);
        $this->db->where('status',2);
        $s=$this->db->update('appointments',array('status'=>'3','remarks'=>'Appointment was cancelled by: "'.$user_role.' - '.$name.'" for the reason: " '.$reason.'".'));
        if($s){
        $this->db->insert('appointment_history',array('appointment_id'=>$check[$i],'action'=>6,'created_by'=>$account_details,'reason'=>$reason));
            /**********Notification***********/
    $appointment_data=$this->db->where('appointment_id',$check[$i])->get('appointments')->row_array();
        $user_id[]='users-user-'.$appointment_data['user_id'];
        $user_id[]='doctors-doctor-'.$appointment_data['doctor_id'];
        $notification['title']=$appointment_number.' Appointment Canceled';
        $notification['text']='Hi User Your Appointment No '.$appointment_number.' was Canceled for the Reason " '.$reason.' " .';
    for($u=0;$u<count($user_id);$u++){
        $notification['user_id']=$user_id[$u];
        $n=$this->db->insert('notification',$notification);
        }
        }
    }
    }
    if($n){
        return TRUE;
    }else{
        return FALSE;
    }
    }
    function save_prescription_order()
    {
        $id  = $this->post('order_type');
        $data['user_id']     = $this->post('user_id');
        $data['prescription_id']     = $this->post('prescription_id');
        $data['order_type']     = $id;
        if($id == 0){
        $data['quantity']     = implode(',',$this->post('quantity'));
        $data['store_id']     = $this->post('store');
        }
        if($id == 1){
            $te=$this->post('tests');
            for($c=0;$c<$this->post('count');$c++){
            if($te[$c]!=''){
                $st[$c]=1;
            }else{
                $st[$c]=0;
            }
            }
        $data['tests']     = implode(',',$st);
        $data['lab_id']     = $this->post('lab');
        }
        $data['created_at']=date('Y-m-d H:i:s');
        $yes=$this->db->insert('prescription_order',$data);
        if($yes){
            /*********** Patient **************/
        $patient_data['user_id']=$this->post('user_id');
        $patient=$this->db->where('user_id',$patient_data['user_id'])->get('patient');
        if($patient->num_rows()==1){
            if($id == 0){
        $hos=$patient->row()->store_ids;
        $hos_ar=explode(',', $hos);
        for($ho=0;$ho<count($hos_ar);$ho++){
            if($hos_ar[$ho] == $data['store_id']){
                $s1='1';
            }else{
                $s1='0';
            }
        }
        if($s1==0){
    $patient_data['store_ids']=$hos.','.$data['store_id']; 
        }
        }
        if($id == 1){
        $hos=$patient->row()->lab_ids;
        $hos_ar=explode(',', $hos);
        for($ho=0;$ho<count($hos_ar);$ho++){
            if($hos_ar[$ho] == $data['lab_id']){
                $s1='1';
            }else{
                $s1='0';
            }
        }
        if($s1==0){
    $patient_data['lab_ids']=$hos.','.$data['lab_id']; 
        }
        }
        $this->db->where('user_id',$this->post('user_id'));
        $this->db->update('patient',$patient_data);
        }else{
        if($id == 0){
        $patient_data['store_ids']=$this->post('store');
        }
        if($id == 1){
        $patient_data['lab_ids']=$this->post('lab');
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
        }

    }
    function select_medical_reports_by_labs($user_id)
    {
       $health_reports=$this->db->get_where('prescription_order',array('user_id'=>$user_id,'order_type'=>1,'status'=>1))->result_array();
       $i=1;foreach ($health_reports as $row1){
if($row1['type_of_order']==0){
        $rep_data=$this->db->get_where('prescription',array('prescription_id'=>$row1['prescription_id']))->row_array();
        $rep_exp1=explode('|',$this->encryption->decrypt($rep_data['prescription_data']));
        $rep_exp_data=explode(',',$rep_exp1[7]);
    }elseif($row1['type_of_order']==1){
        $rep_exp2=explode('|',$this->encryption->decrypt($row1['order_data']));
        $rep_exp_data=explode(',',$rep_exp2[1]);
    }
         for($j=0;$j<count($rep_exp_data);$j++) {
        $report=$this->db->get_where('reports',array('order_id'=>$row1['order_id']))->result_array();
        $results['title']=$rep_exp_data[$j];
        $results['created_at']=$report[$j]['created_at'];
        if($report[$j]['status']==1){
        $results['status_type']="Visible";
        }elseif($report[$j]['status']==2){
        $results['status_type']="Hidden";
        }
        $results['status']=$report[$j]['status'];
        if($report[$j]['extension']!=''){
        $results['report_id']=$report[$j]['report_id'];}
        $i++;
            $allresults[]=$results;
    }
    }
       if(!empty($allresults)){
        return $allresults;
       }else{
        return FALSE;
       }
    }
     function select_medical_reports_by_doctors($user_id)
    {
        $report=$this->db->get_where('reports',array('user_id'=>$user_id))->result_array();
        $i=1;foreach ($report as $row) {  
           $results['title']=$row['title'];
           $exp=explode('-',$row['created_by']);
                if($exp[0]=='doctors'){
                $doc=$this->db->get_where($exp[0],array($exp[1].'_id'=>$exp[2]))->row();
    $results['created_by']=$this->db->where('hospital_id',$doc->hospital_id)->get('hospitals')->row()->name.' / '.$doc->name;}elseif($exp[0]=='users'){
        $results['created_by']='Created By Me';}
        $results['created_at']=$row['created_at'];
        if($row['status']==1){
            $results['status_type']="Visible";
        }elseif($row['status']==2){
            $results['status_type']="Hidden";
        }
        $results['status']=$row['status'];
        if($row['extension']!=''){
            $results['report_id']=$row['report_id'];
        }
        $i++;
        $allresults[]=$results;
    }
       if(!empty($allresults)){
        return $allresults;
       }else{
        return FALSE;
       }
    }
    function delete_medical_reports($report_id)
    {
        $this->db->where('report_id',$report_id);
        $this->db->delete('reports');
    }
    function update_medical_reports_status($report_id='',$status='')
    {
        $data['status']=$status;
        $this->db->where('report_id',$report_id);
        $this->db->update('reports',$data); 
    }
    /*********************Booking Order*************************/
        function book_order(){
    $order_type=$this->post('order_type');
    $data['user_id']=$this->post('user_id');
    $data['order_type']=$order_type;
    $data['type_of_order']=1;
    if($order_type==0){
    $data['store_id']=$this->post('store');
    $data['order_data'] =$this->encryption->encrypt($this->post('title').'|'.implode(',',$this->post('drug')).'|'.implode(',',$this->post('strength')).'|'.implode(',',$this->post('quantity')));
    }elseif($order_type==1){
        $data['lab_id']=$this->post('lab');
        $data['order_data'] =$this->encryption->encrypt($this->post('title').'|'.implode(',',$this->post('test_title')).'|'.implode(',',$this->post('description')));
    }
    $data['created_at']=date('Y-m-d H:i:s');
   $yes=$this->db->insert('prescription_order',$data);
    if($yes){
            /*********** Patient **************/
        $patient_data['user_id']=$data['user_id'];
        $patient=$this->db->where('user_id',$patient_data['user_id'])->get('patient')->row_array();
if($patient==''){
if($order_type == 0){
$patient_data['store_ids']=$this->post('store');
}
if($order_type == 1){
$patient_data['lab_ids']=$this->post('lab');
}
$this->db->insert('patient',$patient_data);
}elseif($patient!=''){
if($order_type == 0){
if($patient['store_ids']==''){
$patient_data['store_ids']=$this->post('store');
}elseif($patient['store_ids']!=''){
$hos_ar=explode(',',$patient['store_ids']);
    for($ho=0;$ho<count($hos_ar);$ho++){
    if($hos_ar[$ho]==$this->post('store')){
    $patient_data['store_ids']=$patient['store_ids'];
    break;
    }else{
    $patient_data['store_ids']=$hos_ar[$ho].','.$this->post('store');
    }
    }
}
}
if($order_type == 1){
if($patient['lab_ids']==''){
$patient_data['lab_ids']=$this->post('lab');
}elseif($patient['lab_ids']!=''){
$hos_ar=explode(',',$patient['lab_ids']);
    for($ho=0;$ho<count($hos_ar);$ho++){
    if($hos_ar[$ho]==$this->post('lab')){
    $patient_data['lab_ids']=$patient['lab_ids'];
    break;
    }else{
    $patient_data['lab_ids']=$hos_ar[$ho].','.$this->post('lab');
    }
    }
}
}
$this->db->where('user_id',$data['user_id']);
$updated=$this->db->update('patient',$patient_data);
}
    }
    if($updated){
        return true;
    }else{
        return false;
    }

    }
    /********************Prescriptions************************/
        function select_prescriptions_info($id){
        $this->db->select('p.prescription_id,p.prescription_data,p.created_at,p.doctor_id,p.status,d.name as doctor_name,h.name as hospital_name');
        $this->db->from('prescription as p')->join('doctors as d', 'd.doctor_id = p.doctor_id')->join('hospitals as h', 'h.hospital_id = d.hospital_id');
$prescription_info=$this->db->order_by('prescription_id','desc')->where('user_id',$id)->get()->result_array();
 foreach ($prescription_info as $row1) {
            $prescription_data=explode('|',$this->encryption->decrypt($row1['prescription_data']));
            if($prescription_data[1]!=''){
                $row1['prescription_data']=$prescription_data[0];
            }
            if($row1['status']==1){
            $row1['status_type']='Visible';
            }elseif($row1['status']==2){
            $row1['status_type']='Hidden';
            }
            $pres[]=$row1;
        }
if(!empty($pres)){
        return $pres; 
        }else{
        return false;
        }
    }
     function ReadPrescription_info($prescription_id='',$order_type=''){
        $account_type='users';
       if($prescription_id==''){
$order_info=$this->db->get_where('prescription_order',array('order_id'=>$order_id))->row_array();
//$this->crud_model->select_order_info_id($order_id);
if($order_info['type_of_order']==0){
$prescription_info = $this->db->get_where('prescription', array('prescription_id' =>$order_info['prescription_id']))->row_array();
}
}
if($prescription_id!=''){
$prescription_info = $this->db->get_where('prescription', array('prescription_id' =>$prescription_id))->row_array();
}
$doctor_info=$this->db->where('doctor_id',$prescription_info['doctor_id'])->get_where('doctors',array('status'=>'1','isDeleted'=>'1'))->row_array();
//$this->crud_model->select_doctor_info_id($prescription_info['doctor_id']);
if($prescription_info!=''){
$user_info=$this->db->where('user_id',$prescription_info['user_id'])->get('users')->row_array();
}else{
$user_info=$this->db->where('user_id',$order_info['user_id'])->get('users')->row_array();
}
$hospital_info=$this->db->where('hospital_id',$doctor_info['hospital_id'])->get('hospitals')->row_array();
$prescription_data=explode('|',$this->encryption->decrypt($prescription_info['prescription_data']));
$order_data=explode('|',$this->encryption->decrypt($order_info['order_data']));
if($prescription_data[0]!=''){
    $row['title']=$prescription_data[0];
}else{
    $row['title']=$order_data[0];
}
if($prescription_info!=''){
    $row['hospital_logo']=base_url().'uploads/hospitallogs/'.$doctor_info['hospital_id'].'.png';
}
if($prescription_info!=''){
$row['hospital_name']=$hospital_info['name'];
$row['hospital_address']=$hospital_info['address'];
$row['hospital_email']=$hospital_info['email'];
$row['prescription_date']=date('M ,d-Y h:i A',strtotime($prescription_info['created_at']));
}
if($prescription_info!=''){
$row['doctor_name']='Dr.'.$doctor_info['name'];
$row['doctor_uniue_id']=$doctor_info['unique_id'];
$row['doctor_mobile_number']=$doctor_info['phone'];
$row['doctor_email']=$doctor_info['email'];
}
$row['patient_name']=$user_info['name'];
$row['patient_unique_id']=$user_info['unique_id'];
$row['patient_mobile_number']=$user_info['phone'];
$row['patient_email']=$user_info['email'];

if($order_type == 0 || $account_type=='doctors' || $account_type=='nurse' ||($order_type=='' && $account_type=='users')){
if($prescription_data[1]!='' || $order_data[1]!=''){
        if($prescription_data[1]!=''){ 
        $drug=explode(',',$prescription_data[1]);}else{$drug=explode(',',$order_data[1]);}
        if($prescription_data[1]!=''){
        $strength=explode(',',$prescription_data[2]);}else{$strength=explode(',',$order_data[2]);}
        if($prescription_data[1]!=''){
        $dosage=explode(',',$prescription_data[3]);
        $duration=explode(',',$prescription_data[4]);
        }
        if($prescription_data[1]!=''){
        if($order_id == ''){
        $quantity=explode(',',$prescription_data[5]);
        }elseif($order_id != ''){
        $quantity=explode(',',$order_info['quantity']); 
        }
        }else{
        $quantity=explode(',',$order_data[3]);
        }
        $note=explode(',',$prescription_data[6]);
for($i1=0;$i1<count($drug);$i1++){
        $medicen['drug']=$drug[$i1];
        $medicen['strength']=$strength[$i1];
        if($prescription_data[1]!=''){
         $medicen['dosage']=$dosage[$i1];
         $medicen['duration']=$duration[$i1];
         }
        $medicen['quantity']=$quantity[$i1];
      if($prescription_data[1]!=''){
       $medicen['note']=$note[$i1];
      }
      $medicines[]=$medicen;
       }
       $row['medicines']=$medicines;
  }
}
if($order_type == 1 || $account_type=='doctors' || $account_type=='nurse' ||($order_type=='' && $account_type=='users')){
    if($prescription_data[7]!='' || $order_data[1]!=''){
        if($prescription_data[7]!=''){
            $test_title=explode(',',$prescription_data[7]);
        }else{
        $test_title=explode(',',$order_data[1]);}
        if($prescription_data[7]!=''){
            $description=explode(',',$prescription_data[8]);
        }else{
        $description=explode(',',$order_data[2]);
        }    
        if($account_type == 'medicallabs'){
        $tests=explode(',',$order_info['tests']); 
        }
    for($i1=0;$i1<count($test_title);$i1++){
            if($account_type == 'medicallabs'){
        $test_title[$i1];
        $description[$i1];
    }elseif($account_type != 'medicallabs'){
        $test['title']=$test_title[$i1];
        $test['description']=$description[$i1];
    }
    $tests[]=$test; 
  }
  $row['medical_tests']=$tests;
  }
}
if($prescription_info!=''){
    $row['additional_note']=$prescription_data[9];
            }

if(!empty($row)){
        return $row; 
        }else{
        return false;
        }
}
 function delete_prescription($prescription_id)
    {
        $this->db->where('prescription_id',$prescription_id);
        $deleted=$this->db->delete('prescription');
        if($deleted){
            echo TRUE;
        }else{
            echo FALSE;
        }
    }
    function update_prescription_status($prescription_id,$status)
    {
        $data['status']=$status;
        $this->db->where('prescription_id',$prescription_id);
        $update=$this->db->update('prescription',$data);
        if($update){
            echo TRUE;
        }else{
            echo FALSE;
        }
    }
    /********************Prognosis************************/
    function select_prognosis_info($user_id)
    {
      $data=$this->db->get_where('prognosis', array('user_id' => $user_id))->result_array();
      foreach ($data as $row1) {
    $row['prognosis_id']=$row1['prognosis_id'];
    $row['prognosis_title']=explode('|',$this->encryption->decrypt($row1['prognosis_data']))[0];
    $doc=$this->db->where('doctor_id',$row1['doctor_id'])->get('doctors')->row();
$row['hospital']=$this->db->where('hospital_id',$doc->hospital_id)->get('hospitals')->row()->name;
$row['doctor']=$doc->name;
$row['created_at']=$row1['created_at'];
$row['status']=$row1['status'];
if($row1['status']==1){
            $row['status_type']='Visible';
            }elseif($row1['status']==2){
            $row['status_type']='Hidden';
            }
$prognosis[]=$row;
      }
      if(!empty($prognosis)){
        return $prognosis;
      }else{
        return false;
      }
    }
    function select_prognosis_information($prognosis_id='')
    {
$prognosis_info=$this->db->get_where('prognosis',array('prognosis_id' =>$prognosis_id))->row_array();
$doctor_info=$this->db->where('doctor_id',$prescription_info['doctor_id'])->get_where('doctors',array('status'=>'1','isDeleted'=>'1'))->row_array();
//$this->crud_model->select_doctor_info_id($prognosis_info['doctor_id']);
$user_info=$this->db->where('user_id',$prognosis_info['user_id'])->get('users')->row_array();
$hospital_info=$this->db->where('hospital_id',$doctor_info['hospital_id'])->get('hospitals')->row_array();
$prescription_data=explode('|',$this->encryption->decrypt($prognosis_info['prognosis_data']));
$row['title']=$prescription_data[0];
$row['hispital_name']=$hospital_info['name'];
$row['hispital_address']=$hospital_info['address'];
$row['hispital_email']=$hospital_info['email'];
$row['created_at']=$prognosis_info['created_at'];
$row['doctor_name']=$doctor_info['name'];
$row['doctor_uniue_id']=$doctor_info['unique_id'];
$row['doctor_mobile_number']=$doctor_info['phone'];
$row['doctor_email']=$doctor_info['email'];
$row['patient_name']=$user_info['name'];
$row['patient_unique_id']=$user_info['unique_id'];
$row['patient_mobile_number']=$user_info['phone'];
$row['patient_email']=$user_info['email'];
$row['case_history']=$prescription_data[1];
        if(!empty($row)){
        return $row;
      }else{
        return false;
      }
    }
     function delete_prognosis($prognosis_id)
    {
        $this->db->where('prognosis_id',$prognosis_id);
        $deleted=$this->db->delete('prognosis');
        if($deleted){
            echo TRUE;
        }else{
            echo FALSE;
        }
    }
    function update_prognosis_status($prognosis_id='',$status='')
    {
        $data['status']=$status;
        $this->db->where('prognosis_id',$prognosis_id);
        $update=$this->db->update('prognosis',$data);
        if($update){
            echo TRUE;
        }else{
            echo FALSE;
        }
    }
    /******************** Orders ************************/
     function select_order_info($user_id,$order_type)
    {
        $order=$this->db->order_by('order_id','DESC')->get_where('prescription_order', array('user_id' => $user_id))->result_array();
        $i=1;foreach ($order as $row1) {
            $user_info=$this->db->get_where('users', array('user_id' => $row1['user_id']))->result_array();
           $prescription_info=$this->db->get_where('prescription', array('prescription_id' => $row1['prescription_id']))->row_array();
        if($order_type==$row1['order_type'] && $row1['type_of_order']==0){
           foreach ($user_info as $user1) {
            $doc=$this->db->where('doctor_id',$prescription_info['doctor_id'])->get('doctors')->row();
            $hospital_name=$this->db->where('hospital_id',$doc->hospital_id)->get('hospitals')->row()->name;
            $data['hospital_name']=$hospital_name;
            $data['doctor_name']=$doc->name;
            $data['patient_name']=$user1['name'];
                if($order_type==0){
            $data['store_name']=get_phrase($this->db->where('store_id',$row1['store_id'])->get('medicalstores')->row()->name);
                }elseif($order_type==1){ 
            $data['lab_name']=get_phrase($this->db->where('lab_id',$row1['lab_id'])->get('medicallabs')->row()->name);
                }
                if($row1['status']==1){
                $data['status_type']="Completed";
                }elseif($row1['status']==2){
                $data['status_type']="Pending";
                }
                $data['status']=$row1['status'];
                $data['created_at']=date('d M,Y h:i A',strtotime($row1['created_at']));
                $data['order_id']=$row1['order_id'];
                $data['order_type']=$row1['order_type'];
                if($row1['status']==1){
                $data['order_status']="Receipt";
            }elseif($row1['status']==2){
                $data['order_status']="Receipt Not Upload";
            }
            $with_prescription[]=$data;
        }
        $i++;
        $results_data['orders_with_prescription']=$with_prescription;
    }
    if($order_type==$row1['order_type'] && $row1['type_of_order']==1){
           foreach ($user_info as $user1){
           $data['patient_name']=$user1['name'];
           if($order_type==0){ 
            $data['store_id']=$row1['store_id'];
            $data['store_name']=get_phrase($this->db->where('store_id',$row1['store_id'])->get('medicalstores')->row()->name);
            }elseif($order_type==1){
            $data['lab_id']=$row1['lab_id'];
            $data['lab_name']=get_phrase($this->db->where('lab_id',$row1['lab_id'])->get('medicallabs')->row()->name);
            }
            if($row1['status']==1){
                $data['status_type']="Completed";
            }elseif($row1['status']==2){
                $data['status_type']="Pending";
            }
            $data['status']=$row1['status'];
            $data['created_at']=date('d M,Y h:i A',strtotime($row1['created_at']));
            $data['order_id']=$row1['order_id'];
            $data['order_type']=$row1['order_type'];
            if($row1['status']==1){
                $data['order_status']="Receipt";
            }elseif($row1['status']==2){
                $data['order_status']="Receipt Not Upload";
            }
        $without_prescription[]=$data;
        }$i++;
        $results_data['orders_without_prescription']=$without_prescription;
    }
    }
    if(!empty($results_data)){
        return $results_data;
    }else{
        return false;
    }
    }
    function select_receipt_info($order_id){
$order_info=$this->db->get_where('prescription_order',array('order_id'=>$order_id))->row_array();
$report_info=$this->db->get_where('reports', array('order_id' => $order_id))->result_array();
$prescription_info = $this->db->get_where('prescription', array('prescription_id' =>$order_info['prescription_id']))->row_array();
if($order_info['order_type']==0){
$store_info=$this->db->where('store_id',$order_info['store_id'])->get('medicalstores')->row_array();
}elseif($order_info['order_type']==1){
$store_info=$this->db->where('lab_id',$order_info['lab_id'])->get('medicallabs')->row_array();
}
if($prescription_info!=''){
$user_info=$this->db->where('user_id',$prescription_info['user_id'])->get('users')->row_array();
}else{
$user_info=$this->db->where('user_id',$order_info['user_id'])->get('users')->row_array();
}
$prescription_data=explode('|',$this->encryption->decrypt($prescription_info['prescription_data']));
$order_data=explode('|',$this->encryption->decrypt($order_info['order_data']));
if($prescription_data[0]!=''){
    $title=$prescription_data[0];
}else{
    $title=$order_data[0];
}
$data['title']=$title;
$data['receipt_created_at']=date('M ,d-Y h:i A',strtotime($order_info['receipt_created_at']));
if($order_info['order_type']==0){
$data['store_name']=$store_info['name'];
$data['store_unique_id']=$store_info['unique_id'];
$data['store_mobile_number']=$store_info['phone'];
$data['store_email']=$store_info['email'];
}elseif($order_info['order_type']==1){
$data['lab_name']=$store_info['name'];
$data['lab_unique_id']=$store_info['unique_id'];
$data['lab_mobile_number']=$store_info['phone'];
$data['lab_email']=$store_info['email'];
}
/*$data['patient_name']=$user_info['name'];
$data['patient_unique_id']=$user_info['unique_id'];
$data['patient_mobile_number']=$user_info['phone'];
$data['patient_email']=$user_info['email'];*/
if($order_info['order_type'] == 0){
      if($prescription_data[1]!=''){
        $drug=explode(',',$prescription_data[1]);
        }else{
        $drug=explode(',',$order_data[1]);
        }
        if($prescription_data[1]!=''){
        $quantity=explode(',',$order_info['quantity']);
        }else{
        $quantity=explode(',',$order_data[3]);
        }
        $cost=explode(',',$order_info['cost']);
        $price=explode(',',$order_info['price']);
    for($i1=0;$i1<count($drug);$i1++){
    $data1['drug']=$drug[$i1];
    $data1['quantity']=$quantity[$i1];
    $data1['cost']=$cost[$i1];
    $data1['price']=$price[$i1];
    $data2[]=$data1;
    }
    $data['orders']=$data2;
    $data['total']=$order_info['total'];
}
if($order_info['order_type'] == 1){ 
    if($prescription_data[7]!=''){
            $test_title=explode(',',$prescription_data[7]);
        }else{
        $test_title=explode(',',$order_data[1]);}
        if($prescription_data[7]!=''){
            $description=explode(',',$prescription_data[8]);
        }else{
        $description=explode(',',$order_data[2]);
        }
        $tests=explode(',',$order_info['tests']);
        $price=explode(',',$order_info['price']);
    for($i1=0;$i1<count($test_title);$i1++){
    $data1['test_title']=$test_title[$i1];
    $data1['description']=$description[$i1];
    if($report_info[$i1]['extension']!=''){
        $data1['report_file']=$report_info[$i1]['report_id'].'.'.$report_info[$i1]['extension'];
    }
    $data1['price']=$price[$i1];
    $data2[]=$data1;
        }
    $data['orders']=$data2;
    $data['total']=$order_info['total'];
    }
    if(!empty($data)){
        return $data;
    }else{
        return false;
    }
}
}
?>