<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
   
class Cron_model extends CI_Model {

    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
    }
    function applications(){
    $list=$this->db->get_where('appointments',array('appointment_date<'=>date('m/d/Y'),'status'=>2))->result_array();
    foreach ($list as $row){
    $this->db->where('appointment_id',$row['appointment_id'])->update('appointments',array('status'=>4));
   $this->db->insert('appointment_history',array('appointment_id'=>$row['appointment_id'],'action'=>7,'created_type'=>'System','created_by'=>'MyPulse'));
    }
    }
    function delete_notifications(){
$notification=$this->db->where('created_at<',date('Y-m-d 00:00:00', strtotime('-7 days')))->delete('notification');
    }
    function delete_messages(){
$notification=$this->db->where('created_at<',date('Y-m-d 00:00:00', strtotime('-29 days')))->delete('messages');
    }
}