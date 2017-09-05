<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Nurse_model extends CI_Model {
    var $tblname = "hms_nurse";
    function getAllnurse() {
        $this->db->where("isDeleted", "0");
        $res = $this->db->get($this->tblname);
        if ($res->num_rows()) return $res->result_array();
        else return array();
    }
    function getnurseById($id) {
        if($id=="")
            $id = 0;
        $r = $this->db->query("select * from " . $this->tblname . " where id=$id and isDeleted=0");
        $r = $r->row_array();
        $this->db->where('id',$r['user_id']);
        $data = $this->db->get('hms_users');
        $data = $data->row_array();
        if(is_array($data)){
            foreach ($data as $key => $value) {
                $r[$key] = $value;
            }
        }

        if(isset($r['department_id'])){
            $this->db->where('id',$r['department_id']);
            $this->db->where('isActive',1);
            $this->db->where("isDeleted",0);
            $department = $this->db->get('hms_departments');
            $department =$department->row_array();
            $r['branch_id'] = $department['branch_id'];


            $this->db->where('id',$r['branch_id']);
            $this->db->where('isActive',1);
            $this->db->where("isDeleted",0);
            $branch = $this->db->get('hms_branches');
            $branch =$branch->row_array();
            $r['hospital_id'] = $branch['hospital_id'];
        }else{
            $r['department_id'] = 0;
            $r['branch_id'] = 0;
            $r['hospital_id'] = 0;
        }

        return $r;
    }
    function search($q, $field) {

        if($this->auth->isHospitalAdmin()){
            $dids = $this->auth->getAllDepartmentsIds();
            $this->db->where_in("hms_nurse.department_id",$dids);
        }

        $this->db->like("hms_users.first_name",$q);
        $this->db->like("hms_users.last_name",$q);
        $this->db->where("hms_users.isDeleted",0);
        $this->db->where("hms_users.role",$this->auth->getNurseRoleType());
        $this->db->select("hms_nurse.id,CONCAT(`first_name`,`last_name`) as text", false);
        $this->db->where("hms_nurse.isDeleted",0);
        $this->db->from($this->tblname);
        $this->db->join("hms_users","hms_nurse.user_id=hms_users.id");
               
        $res = $this->db->get();
        return $res->result_array();
    }
    function add() {
        $data = $_POST;
        /*echo "<pre>";
        var_dump($data);
        exit(); */
        $data['role'] = $this->auth->getNurseRoleType();
        $nid = $this->auth->addUser($data);
        
        if($nid === false){
            return false;
        }else if($nid < 0){
            return $nid;
        }else{
            $nurse['user_id'] = $nid;
            $nurse['department_id'] = isset($data['department_id']) ? $data['department_id'] : -1;
            $nurse['created_at'] = date("Y-m-d H:i:s");
            if ($this->db->insert($this->tblname, $nurse)) {
                //get hospital name
                $hname = $this->db->query("select name from hms_hospitals where id = $data[hospital_id]")->row_array();
                //sent notification to nurse
                $this->notification->saveNotification($nurse['user_id'], "You are linked with <b>".$hname['name']."</b> hospital as Nurse");

                if($this->auth->isSuperAdmin()){
                    //find department name
                    $this->db->where('id', $data['department_id']);
                    $dept = $this->db->get('hms_departments')->row_array();
                    //find branch name
                    $this->db->where('id', $data['branch_id']);
                    $branch = $this->db->get('hms_branches')->row_array();
                    //find hospital admin
                    $this->db->where('hospital_id', $data['hospital_id']);
                    $hadmin = $this->db->get('hms_hospital_admin')->row_array();
                    //sent notification to hospital Admin
                    $this->notification->saveNotification($hadmin['user_id'], "New nurse <b>".$data['first_name']." ".$data['last_name']."</b> is added in department: <b>".$dept['department_name']."</b><br>Branch: <b>".$branch['branch_name']."</b>");
                }
                return true;
            } else {
                return false;
            }
            
        }
        return true;
    }
    function update($id) {
        $data = $_POST;

        $this->db->where("id", $id);
        $nus = $this->db->get($this->tblname);
        $nus = $nus->row_array();

        $nid = isset($nus["user_id"]) ? $nus['user_id'] : 0;
        $nid = $this->auth->addUser($data,$nid);

        if($nid === false){
            return false;
        }else if($nid < 0){
            return $nid;
        }
        else{
            $nus = array();
            if(isset($data['department_id']))
                $nus['department_id'] = $data['department_id'];
            if(isset($data['isActive']))
                $nus['isActive'] = intval($data['isActive']);
            if(count($nus) > 0){
                $this->db->where("id", $id);
                if ($this->db->update($this->tblname, $nus)) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        return true;
    }
    function delete($id) {
        if(is_array($id)){
            $this->db->where_in('id',$id);
        }else{
            $this->db->where("id", $id);
        }
        $d["isDeleted"] = 1;
        if ($this->db->update($this->tblname, $d)) {
            return true;
        } else return false;
    }

    public function getMyId(){
        $this->db->where('user_id',$this->auth->getUserid());
        $this->db->where('isDeleted',0);
        $this->db->where('isActive',1);
        $doc = $this->db->get($this->tblname);
        $doc = $doc->row_array();
        if(isset($doc['id'])){
            return $doc['id'];
        }
        return 0;   
    }

    public function getDepartmentIds(){
        $uid = $this->auth->getUserId();
        $query = $this->db->get_where('hms_nurse' , array('user_id' => $uid));
        $result = $query->result_array(); 
       // $res = count($result);
          $dep_ids = array();
        foreach ($result as $row) {
            $dep_ids[] = $row['department_id'];
        }     
       return $dep_ids; 
    }
    public function getpatient($userid){
            $query = $this->db->get_where('hms_nurse',array('user_id'=>$userid));
          $result = $query->result_array();
          // $result[0]['department_id'];
             $dep_ids = array();
        foreach ($result as $row) {
            $dep_ids[] = $row['department_id'];
        }     
        if(count($dep_ids) == 0){
            $dep_ids[] = '-1';
        }

        //$strdep_id = implode(',',$dep_ids);
        $doc_ids = array(); 
        $this->db->where_in('department_id',$dep_ids);
        $query1 = $this->db->get('hms_doctors');
        $doc_result = $query1->result_array();        
        foreach ($doc_result as $doc_row) {
            $doc_ids[] = $doc_row['id'];
        }     
        if(count($doc_ids) == 0){
            $doc_ids[] = '-1';
        }
        //$doc_ids[]=12;
          // echo $str_docids = implode(',',$doc_ids);
        $query2 = $this->db->query("SELECT DISTINCT `user_id` FROM `hms_inpatient` WHERE `doctor_id` IN (".implode(',',$doc_ids).")");
        
        $patient_result = $query2->result_array();
         $patient_ids = array();
        foreach ($patient_result as $userrow) {
            $patient_ids[] = $userrow['user_id'];
        }     
        return $patient_ids;
    }

     public function UpdateInPatient(){
         $id = $this->input->post('inpatient_update_id');
         $data =array(
             'bed_id' => $this->input->post('Patientbed'),
            );
         $this->db->set($data);
         $this->db->where('id',$id);
         $this->db->update('hms_inpatient');

         //get inpatient data where id=in_patient_id
         $this->db->where('id', $id);
         $inpatient = $this->db->get('hms_inpatient')->row_array();
         // get patient name using user_id from user tbl
         $this->db->where('id', $inpatient['user_id']);
         $pname = $this->db->get('hms_users')->row_array();
         // get doctor's user_id using doctor_id
         $this->db->where('id', $inpatient['doctor_id']);
         $doctor = $this->db->get('hms_doctors')->row_array();
         //sent notification to doctor
         $this->notification->saveNotification($doctor['user_id'], "Inpatient history of patient <b>".$pname['first_name']." ".$pname['last_name']."</b> is updated");


     }

    public function getDoctorIds($userid){
           
    $query = $this->db->get_where('hms_nurse',array('user_id'=>$userid));
          $result = $query->result_array();
          // $result[0]['department_id'];
             $dep_ids = array();
        foreach ($result as $row) {
            $dep_ids[] = $row['department_id'];
        }     
        if(count($dep_ids) == 0){
            $dep_ids[] = '-1';
        }

        //$strdep_id = implode(',',$dep_ids);
        $doc_ids = array(); 
        $this->db->where_in('department_id',$dep_ids);
        $query1 = $this->db->get('hms_doctors');
        $doc_result = $query1->result_array();        
        foreach ($doc_result as $doc_row) {
            $doc_ids[] = $doc_row['id'];
        }     
        return $doc_ids;
    }
}
