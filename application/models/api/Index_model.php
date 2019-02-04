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
            $hospi[$i]=$this->db->where('hospital_id',$hospital_ids[$i])->get('hospitals')->row_array();
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
        	$this->db->select('hospital_id,unique_id,name,email,phone_number,address');
    $hospi=$this->db->where('hospital_id',$id)->get('hospitals')->row_array();
        if($hospi){
		return $hospi; 
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
            $this->db->select('doctor_id,unique_id,name');
            $doctors[$i]=$this->db->where('doctor_id',$doctor_ids[$i])->get('doctors')->row_array();
            }
        }
        } 
       	if($doctors){
		return $doctors; 
		}else{
		return false;
		}
    }
    public function select_stores_info($id = ''){
	$stores=$this->db->where('user_id',$id)->get('patient')->row()->store_ids;
        if($stores!=''){
            $store_ids=explode(',',$stores);
        for($i=0;$i<count($store_ids);$i++){
        	$this->db->select('store_id,unique_id,name');
            $stores[$i]=$this->db->where('store_id',$store_ids[$i])->get('medicalstores')->row_array();
            }
        } 
       	if($stores){
		return $stores; 
		}else{
		return false;
		}
    }
    public function select_labs_info($id = ''){
	 $labs=$this->db->where('user_id',$id)->get('patient')->row()->lab_ids;
        if($labs!=''){ 
        $lab_ids=explode(',',$labs);
        for($i=0;$i<count($lab_ids);$i++){
        	$this->db->select('lab_id,unique_id,name');
            $labs[$i]=$this->db->where('lab_id',$lab_ids[$i])->get('medicallabs')->row_array();
            }
		} 
       	if($labs){
		return $labs; 
		}else{
		return false;
		}
    }
    /*public function select_inpatient_info($id = ''){
	 $inpatient=$this->db->where('user_id',$id)->order_by('id','desc')->get_where('inpatient',array('status'=>1))->result_array();
       	if($inpatient){
		return $inpatient; 
		}else{
		return false;
		}
    }*/
    function select_inpatient_info($param1 = '', $param2 = '',$param3='',$param4='')
    {
    if($param3=='all'){
    return $this->db->order_by('id','desc')->get_where('inpatient',array('user_id'=>$param4,'created_date >='=>date('Y-m-d 00:00:00',strtotime($param1)),'created_date <='=>date('Y-m-d 23:59:59',strtotime($param2))))->result_array();
    }elseif($param3!='all'){
     return $this->db->order_by('id','desc')->get_where('inpatient',array('user_id'=>$param4,'created_date >='=>date('Y-m-d 00:00:00',strtotime($param1)),'created_date <='=>date('Y-m-d 23:59:59',strtotime($param2)),'status'=>$param3))->result_array();
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
    return $this->db->order_by('appointment_number','DESC')->get_where('appointments',array('user_id'=>$param4,'appointment_date >='=>$param1,'appointment_date <='=>$param2))->result_array();
    }elseif($param3!='all'){
     return $this->db->order_by('appointment_number','DESC')->get_where('appointments',array('user_id'=>$param4,'appointment_date >='=>$param1,'appointment_date <='=>$param2,'status'=>$param3))->result_array();   
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
}
?>