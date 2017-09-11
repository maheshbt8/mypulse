<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Notification_model extends CI_Model
{
    var $tblname = "hms_notification";

    function saveNotification($notification){
        $this->db->insert($this->tblname,$notification);
        return $this->db->insert_id();
    }

    function getTopNotification($uid,$top=-1){
        $this->db->select('hms_notification.*,hms_users.first_name,hms_users.last_name,hms_users.profile_photo');
        $this->db->where('hms_notification.user_id',$uid);
        $this->db->where('hms_notification.isRead', 0);
        $this->db->where('hms_notification.isDeleted',0);
        $this->db->join('hms_users','hms_notification.created_by=hms_users.id');
        $this->db->order_by("created_date", "desc");
        if($top > 0)
            $this->db->limit($top,0);
        //select hms_notification.*,hms_users.first_name from hms_notification,hms_users where hms_notification.isDeleted=0 and hms_notification.user_id=$uid and hms_notification.created_by=hms_users.id order by created_date desc
        $notifications = $this->db->get($this->tblname);
        return $notifications->result_array();
    }

    function getUnreadNotificationCount($uid){
        $res = $this->db->query("select count(*) as cnt from $this->tblname where user_id=$uid and isRead=0 and isDeleted=0")->row_array();
        return isset($res['cnt']) ? $res['cnt'] : 0;
    }

    function markAsRead($id){
        $this->db->where('id',$id);
        $this->db->where('user_id',$this->auth->getUserid());
        return $this->db->update($this->tblname,array('isRead'=>1));
    }

    function markAllAsRead(){
        $this->db->where('user_id',$this->auth->getUserid());
        return $this->db->update($this->tblname,array('isRead'=>1));
    }
}