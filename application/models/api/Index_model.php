<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class Index_model extends CI_Model {

public function user_login($unm = '', $pwd = ''){
        $where = "(email='".$unm."' OR phone='".$unm."') AND password='".sha1($pwd)."' AND status='1'  AND is_mobile='1' AND isDeleted='1'";
        $this->db->select('user_id, name,unique_id,email');
        $query = $this->db->where($where)->get('users')->row_array();
        if(!empty($query))
        {
        return $query;
        }else{
		return false;
		}
	}
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
    public function select_hospital_info($id = ''){
$this->db->select('h.hospital_id,h.unique_id,h.name,h.email,h.phone_number,h.address,h.description,h.md_name,h.md_contact_number,c.name as country_name,s.name as state_name,d.name as district_name,ci.name as city_name');
$this->db->from('hospitals as h')->join('country as c', 'c.country_id = h.country')->join('state as s', 's.state_id = h.state')->join('district as d', 'd.district_id = h.district')->join('city as ci', 'ci.city_id = h.city');
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
   public function select_inpatient_info($param1 = '', $param2 = '',$param3='',$param4='')
    {
    if($param3=='all'){
    return $this->db->order_by('id','desc')->get_where('inpatient',array('user_id'=>$param4,'created_date >='=>date('Y-m-d 00:00:00',strtotime($param1)),'created_date <='=>date('Y-m-d 23:59:59',strtotime($param2))))->result_array();
    }elseif($param3!='all'){
    $where=array('i.user_id'=>$param4,'i.created_date >='=>date('Y-m-d 00:00:00',strtotime($param1)),'i.created_date <='=>date('Y-m-d 23:59:59',strtotime($param2)),'i.status'=>$param3);
$this->db->select('i.id,i.created_date,i.reason,i.status,d.name as doctor_name,h.name as hospital_name,bed.name as bed_name');
$this->db->from('inpatient as i')->join('doctors as d', 'd.doctor_id = i.doctor_id')->join('hospitals as h', 'h.hospital_id = i.hospital_id')->join('bed as bed', 'bed.bed_id = i.bed_id');
return $this->db->order_by('id','DESC')->where($where)->get()->result_array();

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
$this->db->select('a.appointment_id,a.appointment_number,a.doctor_id,a.appointment_date,d.name as doctor_name,h.name as hospital_name,b.name as branch_name,dep.name as department_name');
$this->db->from('appointments as a')->join('doctors as d', 'd.doctor_id = a.doctor_id')->join('hospitals as h', 'h.hospital_id = d.hospital_id')->join('branch as b', 'b.branch_id = d.branch_id')->join('department as dep', 'dep.department_id = d.department_id');
return $this->db->order_by('appointment_number','DESC')->where($where)->get()->result_array();  
    }elseif($param3!='all'){
$where=array('a.user_id'=>$param4,'a.appointment_date >='=>$param1,'a.appointment_date <='=>$param2,'a.status'=>$param3);
$this->db->select('a.appointment_id,a.appointment_number,a.doctor_id,a.appointment_date,d.name as doctor_name,h.name as hospital_name,b.name as branch_name,dep.name as department_name');
$this->db->from('appointments as a')->join('doctors as d', 'd.doctor_id = a.doctor_id')->join('hospitals as h', 'h.hospital_id = d.hospital_id')->join('branch as b', 'b.branch_id = d.branch_id')->join('department as dep', 'dep.department_id = d.department_id');
return $this->db->order_by('appointment_number','DESC')->where($where)->get()->result_array();   
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
}
?>