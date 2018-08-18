<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification
{
    public function __construct(){
        //Load library
        $this->CI =& get_instance();
    }
//$this->notification->saveNotification(1,"text");
    public function saveNotification($uid=0,$msg,$action=null){
		date_default_timezone_set('Asia/Kolkata');
        $notification['created_by'] = $this->CI->auth->getUserid();
        $notification['user_id'] = $uid;
        $notification['text'] = $msg;
        $notification['action'] = $action;
		$notification['created_date'] = date('Y-m-d H:i:s');
		
        $this->CI->load->model('notification_model');
        $this->CI->notification_model->saveNotification($notification);
    }

    public function getTopNotification($top=5){
        $this->CI->load->model('notification_model');
        $user_id = $this->CI->auth->getUserid();
        return $this->CI->notification_model->getTopNotification($user_id,$top);
    }

    public function getAllNotification(){
        $this->CI->load->model('notification_model');
        $user_id = $this->CI->auth->getUserid();
        return $this->CI->notification_model->getTopNotification($user_id);
    }

    public function getUnreadNotificationCount(){
        $this->CI->load->model('notification_model');
        $user_id = $this->CI->auth->getUserid();
        return $this->CI->notification_model->getUnreadNotificationCount($user_id);
    }

    public function time_elapsed_string($ptime)
    {
        //echo strtotime($ptime);exit;
        date_default_timezone_set('Asia/Kolkata');

        $etime = time() - strtotime($ptime);
        //echo $etime;exit;
        if ($etime < 1)
        {
            return '0 seconds';
        }

        $a = array( 365 * 24 * 60 * 60  =>  'year',
            30 * 24 * 60 * 60  =>  'month',
            24 * 60 * 60  =>  'day',
            60 * 60  =>  'hour',
            60  =>  'minute',
            1  =>  'second'
        );

        $a_plural = array( 'year'   => 'years',
            'month'  => 'months',
            'day'    => 'days',
            'hour'   => 'hours',
            'minute' => 'minutes',
            'second' => 'seconds'
        );

        foreach ($a as $secs => $str)
        {
            $d = $etime / $secs;
            if ($d >= 1)
            {
                $r = round($d);
                return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
            }
        }
    }
}