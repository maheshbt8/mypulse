<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
   
class Crud_model extends CI_Model {

    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
    }
    function applications(){
   $appointment_data=$this->db->order_by('appointment_number','DESC')->get_where('appointments',array('appointment_date<'=>date('m/d/Y')))->result_array();
   print_r($appointment_data);die;
    }
}