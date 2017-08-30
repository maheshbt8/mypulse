<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Message_model extends CI_Model
{
    var $tblname = "hms_messages";

    function saveMessage($message){
        $this->db->insert($this->tblname,$message);
        return $this->db->insert_id();
    }

    function getTopMessages($uid,$top){
        $this->db->select('hms_messages.*,hms_users.first_name,hms_users.last_name,hms_users.profile_photo');
        $this->db->where('hms_messages.user_id',$uid);
        $this->db->where('hms_messages.isDeleted',0);
        $this->db->join('hms_users','hms_messages.created_by=hms_users.id');
        $this->db->limit($top,0);
        $messages = $this->db->get($this->tblname);
        return $messages->result_array();
    }

    function getUnreadMessageCount($uid){
        $res = $this->db->query("select count(*) as cnt from $this->tblname where user_id=$uid and isRead=0 and isDeleted=0")->row_array();
        return isset($res['cnt']) ? $res['cnt'] : 0;
    }
}