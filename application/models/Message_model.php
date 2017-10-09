<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Message_model extends CI_Model
{
    var $tblname = "hms_messages";

    function saveMessage($message){
        $uid = $message['user_id'];
        if($uid > 0){
            $e = $this->db->insert($this->tblname,$message);
            return $this->db->insert_id();
        }else{
            $users = array();
            $role = 0;
            switch($uid){
                case -1: $role= 2;break;
                case -2: $role= 4;break;
                case -3: $role= 5;break;
                case -4: $role= 3;break;
                case -5: $role= 8;break;
                case -6: $role= 7;break;
                case -7: $role= 6;break;
            }
            $this->load->model('users_model');
            $users = $this->users_model->getUserIdsForMultiMessage($role);
            
            foreach($users as $user){
                $message['user_id'] = $user;
                $e = $this->db->insert($this->tblname,$message);
            }
            return true;
        }
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