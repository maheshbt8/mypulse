<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logger
{
    public function __construct()
    {
        //Load library
        $this->CI =& get_instance();
    }

    public function log($description='',$type=null,$id=null){
        $log['description'] = $description;
        $log['item_type'] = $type;
        $log['item_id'] = $id;
        $log['user_id'] = $this->CI->auth->getUserid();
        $log['user_name'] = $this->CI->auth->getUsername();
        $log['created_at'] = date("Y-m-d H:i:s");
        $this->CI->db->insert('hms_activitylog',$log);
    }
}
