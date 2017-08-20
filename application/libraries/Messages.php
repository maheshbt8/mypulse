<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages
{
    public function __construct()
    {
        //Load library
        $this->CI =& get_instance();
    }

    public function saveMessage($uid=0,$msg,$action=null){
        $notification['created_by'] = $this->CI->auth->getUserid();
        $notification['user_id'] = $uid;
        $notification['text'] = $msg;
        $notification['action'] = $action;
        $this->CI->load->model('message_model');
        $this->CI->message_model->saveMessage($notification);
    }

    public function getTopMessages($top=5){
        $this->CI->load->model('message_model');
        $user_id = $this->CI->auth->getUserid();
        return $this->CI->message_model->getTopMessages($user_id,$top);
    }

    public function getUnreadMessageCount(){
        $this->CI->load->model('message_model');
        $user_id = $this->CI->auth->getUserid();
        return $this->CI->message_model->getUnreadMessageCount($user_id);
    }
}