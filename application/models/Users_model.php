<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Users_model extends CI_Model {
    var $tblname = "hms_users";
    
    function getAllusers() {
        $this->db->where("isDeleted", "0");
        $res = $this->db->get($this->tblname);
        if ($res->num_rows()) return $res->result_array();
        else return array();
    }
    
    function doLogin()
    {   

        $unm=$this->input->post('email_id');
        $pwd=$this->input->post('password');
        $pwd=md5($pwd);
        $query=$this->db->query("select * from $this->tblname where useremail=? and password=?",array($unm,$pwd));
        if($query->num_rows() > 0 )
        {
            foreach ($query->result() as $row)
            {
                if($row->isActive == 1){
                    $session_data = array(  'user_name' => $row->first_name.' '.$row->last_name,
                                            'email_id' => $row->useremail,
                                            'user_id' => $row->id,
                                            'role' => $row->role,
                                            'logged_in' => '1');
                    $session_set = $this->session->set_userdata($session_data);
                    return true;
                }else{
                    return -1;
                }
            }
        }
        else
            return false;
    }

    function getusersById($id) {
        $r = $this->db->query("select * from " . $this->tblname . " where id=$id and isDeleted=0");
        return $r->row_array();
    }

     public function getUsersByType($type=6){
        $this->db->where('isDeleted',0);
        $this->db->where('isActive',1);
        $this->db->where('role',$type);
        $res = $this->db->get($this->tblname);
        return $res->result_array();
    }

    function search($q, $field) {
        $field = explode(",", $field);
        foreach ($field as $f) {
            $this->db->like($f, $q);
        }
        $select = implode('`," ",`', $field);
        $this->db->select("id,CONCAT(`$select`) as text", false);
        $res = $this->db->get($this->tblname);
        return $res->result_array();
    }
    function add() {
        $data = $_POST;
        unset($data["eidt_gf_id"]);
        if (isset($data["role"])) $data["role"] = intval($data["role"]);
        if (isset($data["isActive"])) $data["isActive"] = intval($data["isActive"]);
        if ($this->db->insert($this->tblname, $data)) {
            return true;
        } else {
            return false;
        }
    }
    function update($id) {
        $data = $_POST;
        unset($data["eidt_gf_id"]);
        if (isset($data["role"])) $data["role"] = intval($data["role"]);
        if (isset($data["isActive"])) $data["isActive"] = intval($data["isActive"]);
        $this->db->where("id", $id);
        if ($this->db->update($this->tblname, $data)) {
            return true;
        } else {
            return false;
        }
    }
    function delete($id) {
        $this->db->where("id", $id);
        $d["isDeleted"] = 1;
        if ($this->db->update($this->tblname, $d)) {
            return true;
        } else return false;
    }

    function doReg(){
        if(isset($_POST)){

            $this->db->where('useremail',$_POST['useremail']);
            $this->db->where('isDeleted',0);
            $user = $this->db->get($this->tblname);

            if($user->num_rows() > 0){
                return -1;
            }else{
                $data = $_POST;
                $data['password'] = md5($data['password']);
                $data['created_date']= date('Y-m-d H:i:s');
                $name = explode(" ",$data['first_name']);
                
                $data['first_name'] = $name[0];
                if(isset($name[1])){
                    $data['last_name'] = $name[1];
                }

                $this->db->insert($this->tblname,$data);
                return true;
            }
        }
        else
            return false;
    }

    function saveImage(){
        try{
            
            
            $basepath = dirname(BASEPATH).'/assets/images/users/';
                
            $name = substr(md5(date("Y-m-d H:i:s")),0,rand(8,15));
            
            $ext = '.'.pathinfo($_FILES['pic']['name'], PATHINFO_EXTENSION);
            $temp = $basepath.$name.$ext;
            if(move_uploaded_file($_FILES['pic']['tmp_name'], $temp))
                return $name.$ext;
            else
                return "";
        }
        catch(Exception $e){
            return "";
        }
    }
    
    function validateUsername(){
        $email = $this->input->post('email_id');
        if($email!="")
        {
            $res = $this->db->query("select * from ".$this->tblname." where useremail=?",array($email));
            if($res->num_rows() > 0)
            {
                $key = strtoupper(bin2hex(openssl_random_pseudo_bytes(5)));
                $data = array('forgotPassCode'=>$key);
                $this->db->where('useremail',$email);
                $this->db->update($this->tblname,$data);
                $data = array();
                $data['body'] = "Reset password using following linke : ".base_url()."/index.php/index/resetPassword?key=".$key;
                $data['email']=$this->input->post('email');
                $data['subject']='Reset Password';
                return $data;
            }
            else
                return false;
        }
        else
            return false;
    }
    
    function resetPassword()
    {
        $key = $this->input->post('key');
        $pass = $this->input->post('password');
        $repass = $this->input->post('repassword');
        if($pass==$repass){
            $q = "update ".$this->tblname." set password=?,forgotPassCode=NULL where forgotPassCode=?";
            $rs=$this->db->query($q,array(md5($pass),$key));
            if($this->db->affected_rows()>0)
            {
                return true;
            }
            else
                return false;   
        }           
        return false;
    }   
    
    
    public function chechk_availability($username)
    {
        $this->db->where('email_id',$username);
        $query = $this->db->get_where($this->tblname);
        return $query->num_rows();
    }
    
    public function chechk_email_availability($email)
    {
        $this->db->where('email_id',$email);
        $query = $this->db->get_where($this->tblname);
        return $query->num_rows();
    }

    public function getProfile($id){
        $res = $this->db->query("select * from ".$this->tblname." where id=$id");
        return $res->row_array();
    }
}
