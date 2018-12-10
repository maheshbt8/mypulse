<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
   
class Cron_model extends CI_Model {

    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
    }
    function hospital_license(){
        $list=$this->db->get_where('hospitals',array('till_date'=>date('m/d/Y',strtotime('+3 month')),'license_status'=>1))->result_array();
       foreach ($list as $row) {
            $admin=$this->db->get_where('hospitaladmins',array('hospitals'=>$row['hospital_id']))->row();
            $notification['user_id']='hospitaladmins-admin-'.$admin->admin_id;
            $notification['title']='License Expiry';
            $notification['text']='Your License Will be going to expiry with in 3 months. Please renewal your licens.';
            $this->db->insert('notification',$notification);
       }
       $list1=$this->db->get_where('hospitals',array('till_date'=>date('m/d/Y',strtotime('+2 month')),'license_status'=>1))->result_array();
       foreach ($list1 as $row1) {
            $admin1=$this->db->get_where('hospitaladmins',array('hospitals'=>$row1['hospital_id']))->row();
            $notification['user_id']='hospitaladmins-admin-'.$admin1->admin_id;
            $notification['title']='License Expiry';
            $notification['text']='Your License Will be going to expiry with in 2 months. Please renewal your licens.';
            $this->db->insert('notification',$notification);
       }
       $list2=$this->db->get_where('hospitals',array('till_date'=>date('m/d/Y',strtotime('+1 month')),'license_status'=>1))->result_array();
       foreach ($list2 as $row2) {
            $admin2=$this->db->get_where('hospitaladmins',array('hospitals'=>$row2['hospital_id']))->row();
            $notification['user_id']='hospitaladmins-admin-'.$admin2->admin_id;
            $notification['title']='License Expiry';
            $notification['text']='Your License Will be going to expiry with in 1 month. Please renewal your licens.';
            $this->db->insert('notification',$notification);
       }
       for($i=7;$i>=1;$i--){
       $list3=$this->db->get_where('hospitals',array('till_date'=>date('m/d/Y',strtotime('+'.$i.' days')),'license_status'=>1))->result_array();
       foreach ($list3 as $row3) {
        $admin3=$this->db->get_where('hospitaladmins',array('hospitals'=>$row3['hospital_id']))->row();
        $notification['user_id']='hospitaladmins-admin-'.$admin3->admin_id;
        $notification['title']='License Expiry';
        $notification['text']='Your License Will be going to expiry with in '.$i.' days. Please renewal your licens.';
        $this->db->insert('notification',$notification);
        }
       }
    }
    function applications(){
    $list=$this->db->get_where('appointments',array('appointment_date<'=>date('m/d/Y'),'status'=>2))->result_array();
    foreach ($list as $row){
    $this->db->where('appointment_id',$row['appointment_id'])->update('appointments',array('status'=>4));
   $this->db->insert('appointment_history',array('appointment_id'=>$row['appointment_id'],'action'=>7,'created_type'=>'System','created_by'=>'MyPulse'));
    }
    }
    function applications_notifications(){
    $doctors=$this->db->get('doctors')->result_array();
    foreach($doctors as $doctor) {
    $list=$this->db->get_where('appointments',array('appointment_date'=>date('m/d/Y'),'doctor_id'=>$doctor['doctor_id'],'status'=>2))->num_rows();
        $notification['user_id']='doctors-doctor-'.$doctor['doctor_id'];
        $notification['title']='Today Appointments : '.$list;
        $notification['text']='You have '.$list.' Appointments Today.';
        $this->db->insert('notification',$notification);
    }
    }
    function delete_notifications(){
$notification=$this->db->where('created_at<',date('Y-m-d 00:00:00', strtotime('-7 days')))->delete('notification');
    }
    function delete_messages(){
$notification=$this->db->where('created_at<',date('Y-m-d 00:00:00', strtotime('-29 days')))->delete('messages');
    }
}













