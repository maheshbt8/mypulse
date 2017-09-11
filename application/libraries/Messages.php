<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages
{
    public function __construct()
    {
        //Load library
        $this->CI =& get_instance();
        $this->CI->load->model('message_model');
    }

    public function saveMessage($uid=0,$msg,$title,$action=null){

        //$this->CI->load->model('message_model');

        $notification['created_by'] = $this->CI->auth->getUserid();
        $notification['body'] = trim($msg);
        $notification['title'] = $title;
        $notification['created_date'] = date('Y-m-d H:i');
        if(is_array($uid)){
            foreach ($uid as $u){
                $notification['user_id'] = $u;
                $i = $this->CI->message_model->saveMessage($notification);
            }
        }else{
            $notification['user_id'] = $uid;
            $this->CI->message_model->saveMessage($notification);
        }
    }

    public function getTopMessages($top=5){
        //$this->CI->load->model('message_model');
        $user_id = $this->CI->auth->getUserid();
        return $this->CI->message_model->getTopMessages($user_id,$top);
    }

    public function getUnreadMessageCount(){
        $user_id = $this->CI->auth->getUserid();
        return $this->CI->message_model->getUnreadMessageCount($user_id);
    }

    public function markRead($mid){
        $user_id = $this->CI->auth->getUserid();
        return $this->CI->message_model->markAsRead($mid,$user_id);
    }

}