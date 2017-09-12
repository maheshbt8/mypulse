<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Message_model extends CI_Model
{
    var $tblname = "hms_messages";

    function saveMessage($message){
        $e = $this->db->insert($this->tblname,$message);
        return $this->db->insert_id();
    }

    function getTopMessages($uid,$top){
        $this->db->select('hms_messages.*,hms_users.first_name,hms_users.last_name,hms_users.profile_photo');
        $this->db->where('hms_messages.user_id',$uid);
        $this->db->where('hms_messages.isDeleted',0);
        $this->db->where('hms_messages.isRead',0);
        $this->db->join('hms_users','hms_messages.created_by=hms_users.id');
        $this->db->limit($top,0);
        $this->db->order_by('created_date','DESC');
        $messages = $this->db->get($this->tblname);
        return $messages->result_array();
    }

    function getUnreadMessageCount($uid){
        $res = $this->db->query("select count(*) as cnt from $this->tblname where user_id=$uid and isRead=0 and isDeleted=0")->row_array();
        return isset($res['cnt']) ? $res['cnt'] : 0;
    }

    function markAsRead($mid,$uid){
        $this->db->where('user_id',$uid);
        $this->db->where('id',$mid);
        $this->db->update($this->tblname, array('isRead'=>1));

        $message = $this->db->query('SELECT m.*,CONCAT(u1.first_name,\' \',u1.last_name) as toname, CONCAT(u2.first_name,\' \',u2.last_name) as fromname  from hms_messages m left join hms_users u1 on u1.id = m.user_id left join hms_users u2 on u2.id = m.created_by where m.user_id = '.$uid.' and m.id='.$mid)->row_array();

        return $message;
    }
}