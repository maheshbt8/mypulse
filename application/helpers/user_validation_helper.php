<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */


if ( ! function_exists('email_validation'))
{
	function email_validation($email){
		$ci=& get_instance();
		$num_rows = 0;
		$user_array = array('superadmin','hospitaladmins', 'doctors', 'nurse', 'users','receptionist','medicalstores','medicallabs');
		$size = sizeof($user_array);

		for($i = 0; $i < $size; $i++){
			$ci->db->where('email', $email);
			$num_rows = $ci->db->get($user_array[$i])->num_rows();
			if($num_rows > 0){
				return 0;
			}
		}
		return 1;
	}
}

if ( ! function_exists('email_validation_for_edit')){
	function email_validation_for_edit($email, $id, $type,$type_id){
		$num_rows = 0;
		$ci=& get_instance();
		$user_array = array('superadmin','hospitaladmins', 'doctors', 'nurse', 'users','receptionist','medicalstores','medicallabs');
		$size = sizeof($user_array);
		for($i = 0; $i < $size; $i++){
			if($type == $user_array[$i]){
				$ci->db->where_not_in($type_id.'_id', $id);
				$ci->db->where('email', $email);
				$num_rows = $ci->db->get($user_array[$i])->num_rows();
				
				if($num_rows > 0){
					return 0;
				}
			}
			else{
				$ci->db->where('email', $email);
				$num_rows = $ci->db->get($user_array[$i])->num_rows();
				if($num_rows > 0){
					return 0;
				}
			}
		}
		return 1;
	}
}


if ( ! function_exists('mobile_validation'))
{
	function mobile_validation($mobile){
		$ci=& get_instance();
		$num_rows = 0;
		$user_array = array('superadmin','hospitaladmins', 'doctors', 'nurse', 'users','receptionist','medicalstores','medicallabs');
		$size = sizeof($user_array);

		for($i = 0; $i < $size; $i++){
			$ci->db->where('phone', $mobile);
			$num_rows = $ci->db->get($user_array[$i])->num_rows();
			if($num_rows > 0){
				return 0;
			}
		}
		return 1;
	}
}
if ( ! function_exists('mobile_validation_for_edit')){
	function mobile_validation_for_edit($mobile, $id, $type,$type_id){
		$num_rows = 0;
		$ci=& get_instance();
		$user_array = array('superadmin','hospitaladmins', 'doctors', 'nurse', 'users','receptionist','medicalstores','medicallabs');
		$size = sizeof($user_array);

		for($i = 0; $i < $size; $i++){
			if($type == $user_array[$i]){
				$ci->db->where_not_in($type_id.'_id', $id);
				$ci->db->where('phone', $mobile);
				$num_rows = $ci->db->get($user_array[$i])->num_rows();

				if($num_rows > 0){
					return 0;
				}
			}
			else{
				$ci->db->where('phone', $mobile);
				$num_rows = $ci->db->get($user_array[$i])->num_rows();
				if($num_rows > 0){
					return 0;
				}
			}
		}
		return 1;
	}
}


if ( ! function_exists('divide_unique_id'))
{
	function divide_unique_id($unique_id){
		$exp=explode('_',$unique_id);
        $code=substr($exp[0],0,-2);
        return $code;
	}
}
if ( ! function_exists('otp_generate'))
{
	function otp_generate(){
		$num="12345678901234567890";
        $shu=str_shuffle($num);
        $otp=substr($shu, 14);
        return $otp;
	}
}
