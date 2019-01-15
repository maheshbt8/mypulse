<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Track extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		
	}
	
	function index(){
		$this->db->limit(30);
		$this->db->order_by('track_date', 'desc');
		$res = $this->db->get('work_mobile_response');
		
		echo '<pre>';
		if($res->num_rows() > 0) foreach($res->result() as $r){
			echo 'Track ID: '.$r->track_id.'<br>';
			echo 'Track Date: '.$r->track_date.'<br>';
			
			echo 'Request: <br>';
			print_r(unserialize($r->track_req));
			
			echo 'Response: <br>';
			print_r(unserialize($r->track_res));
			echo '<br><br><hr><br>';
		}
	}
}