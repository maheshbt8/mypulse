<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
   
class Cron_model extends CI_Model {

    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
    }
    function hospital_license(){
        $list=$this->db->get_where('hospitals',array('till_date'=>date('Y-m-d',strtotime('+3 month')),'row_status_cd'=>1))->result_array();
       foreach ($list as $row) {
            $admin=$this->db->get_where('hospitaladmins',array('hospital_id'=>$row['hospital_id']))->row();
            $notification['user_id']=$admin->unique_id;
            $notification['title']='License Expire';
            $notification['notification_text']='MyPulse license for your hospital will expire in 3 months. Please renew your license.';
            $this->db->insert('notification',$notification);
       }
       $list1=$this->db->get_where('hospitals',array('till_date'=>date('Y-m-d',strtotime('+2 month')),'row_status_cd'=>1))->result_array();
       foreach ($list1 as $row1) {
            $admin1=$this->db->get_where('hospitaladmins',array('hospital_id'=>$row1['hospital_id']))->row();
            $notification['user_id']=$admin1->unique_id;
            $notification['title']='License Expiry';
            $notification['notification_text']='MyPulse license for your hospital will expire in 2 months. Please renew your license.';
            $this->db->insert('notification',$notification);
       }
       $list2=$this->db->get_where('hospitals',array('till_date'=>date('Y-m-d',strtotime('+1 month')),'row_status_cd'=>1))->result_array();
       foreach ($list2 as $row2) {
            $admin2=$this->db->get_where('hospitaladmins',array('hospital_id'=>$row2['hospital_id']))->row();
            $notification['user_id']=$admin2->unique_id;
            $notification['title']='License Expiry';
            $notification['notification_text']='MyPulse license for your hospital will expire in 1 months. Please renew your license.';
            $this->db->insert('notification',$notification);
       }
       for($i=7;$i>=0;$i--){
        if($i!=0){
       $list3=$this->db->get_where('hospitals',array('till_date'=>date('Y-m-d',strtotime('+'.$i.' days')),'row_status_cd'=>1))->result_array();
       foreach ($list3 as $row3) {
        $admin3=$this->db->get_where('hospitaladmins',array('hospital_id'=>$row3['hospital_id']))->row();
        $notification['user_id']=$admin3->unique_id;
        $notification['title']='License Expire';
        $notification['notification_text']='MyPulse license for your hospital will expire in '.$i.' days. Please renew your license.';
        $this->db->insert('notification',$notification);
        }
      }elseif($i==0){
        $this->db->where('till_date<',date('Y-m-d'))->update('hospitals',array('row_status_cd'=>2));
      }
       }
       return TRUE;
    }
    function appointments(){
    $list=$this->db->get_where('appointments',array('appointment_date<'=>date('Y-m-d'),'appointment_status'=>2))->result_array();
    foreach ($list as $row){
    $this->db->where('appointment_id',$row['appointment_id'])->update('appointments',array('appointment_status'=>4));
   $this->db->insert('appointment_history',array('appointment_id'=>$row['appointment_id'],'action'=>7,'created_by'=>'MyPulse'));
    }
    return TRUE;
    }
    function appointments_notifications(){
    $doctors=$this->db->get('doctors')->result_array();
    foreach($doctors as $doctor) {
    $list=$this->db->get_where('appointments',array('appointment_date'=>date('Y-m-d'),'doctor_id'=>$doctor['doctor_id'],'appointment_status'=>2))->num_rows();
    if($list>0){
        $notification['user_id']=$doctor['unique_id'];
        $notification['title']='Today Appointments : '.$list;
        $notification['notification_text']='You have '.$list.' Appointments Today.';
        $this->db->insert('notification',$notification);
      }
    }
    return TRUE;
    }
    function delete_notifications(){
$notification=$this->db->where('created_at<',date('Y-m-d 00:00:00', strtotime('-7 days')))->delete('notification');
  return TRUE;
    }
    function delete_messages(){
$notification=$this->db->where('created_at<',date('Y-m-d 00:00:00', strtotime('-29 days')))->delete('messages');
  return TRUE;
    }
    function delete_logs(){
              /*Log Delete */
$path='logs/log-'.date('Y-m-d',strtotime('-7 days')).'.php';
$this->load->helper("file"); // load the helper
unlink(APPPATH . $path); // delete all files/folders
        /*Log Delete*/
        return TRUE;
    }
    function db_backup(){
              /*Db BackUps*/
$path='backups/MyPulse-DB'.date('Ymd',strtotime('-7 days')).'.sql';
$this->load->helper("file"); // load the helper
unlink(FCPATH . $path); // delete all files/folders

$this->load->dbutil();
$prefs = array(     
    'format'      => 'sql',             
    'filename'    => 'my_db_backup.sql'
    );
$backup =& $this->dbutil->backup($prefs); 
$db_name = 'MyPulse-DB'.date('Ymd').'.sql';
$save = FCPATH.'backups/'.$db_name;
$this->load->helper('file');
write_file($save, $backup); 
$this->load->helper('download');
force_download($db_name, $backup);
        /*Db Backups End*/
    }
}













