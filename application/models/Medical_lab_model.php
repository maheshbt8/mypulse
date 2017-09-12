<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Medical_lab_model extends CI_Model {
    var $tblname = "hms_medical_lab";
    function getAllmedical_lab() {
        $this->db->where("isDeleted", "0");
        $res = $this->db->get($this->tblname);
        if ($res->num_rows()) return $res->result_array();
        else return array();
    }
    function getMyLabId(){
        $this->db->where('user_id',$this->auth->getUserid());
        $this->db->where('isDeleted',0);
        $ml = $this->db->get($this->tblname);
        $ml = $ml->row_array();
        return isset($ml['id']) ? $ml['id'] : 0;
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
    function getmedical_labById($id) {
        $r = $this->db->query("select *,isActive as curIsActive from " . $this->tblname . " where id=$id and isDeleted=0");
        $r = $r->row_array();
        $this->db->where('id',$r['user_id']);
        $user = $this->db->get('hms_users');
        $user = $user->row_array();
        $r['user'] = $user;
        $r['branch_name'] = "";
        $r['hospital_name'] = "";
        if(isset($r['branch_id'])){
            $this->db->where('id',$r['branch_id']);
            $this->db->where('isActive',1);
            $this->db->where("isDeleted",0);
            $branch = $this->db->get('hms_branches');
            $branch =$branch->row_array();
            $r['branch_name'] = $branch['branch_name'];
            $r['hospital_id'] = $branch['hospital_id'];
            $this->db->where('id',$branch['hospital_id']);
            $hos = $this->db->get('hms_hospitals');
            $hos = $hos->row_array();
            $r['hospital_name'] = $hos['name'];
        }
        $r['country_name'] = $this->auth->getCountryName($r['country']);
        return $r;
    }
    function search($q, $field,$city) {
        $field = explode(",", $field);
        if($city!=null){
            $this->db->where('city',$city);
        }
        foreach ($field as $f) {
            $this->db->like($f, $q);
        }
        $select = implode('`," ",`', $field);
        $this->db->where("isDeleted",0);
        $this->db->select("id,CONCAT(`$select`) as text", false);
        $res = $this->db->get($this->tblname);
        return $res->result_array();
    }
    function addReportUrl($id,$urls,$paths,$types){
        for($i=0; $i<count($urls); $i++){
            $d['medical_report_id'] = $id;
            $d['file_url'] = $urls[$i];
            $d['file_path'] = $paths[$i];
            $d['file_type'] = $types[$i];
            $this->db->insert('hms_medical_report_file',$d);
        }
        if(count($urls) > 0){
            $this->db->where('id',$id);
            $this->db->update('hms_medical_report',array('status'=>1));
            //find patient
            $this->db->where('id', $id);
            $report = $this->db->get('hms_medical_report')->row_array();
            //find appointment_no
            $this->db->where('user_id', $report['patient_id']);
            $app_no = $this->db->get('hms_appoitments')->row_array();
            //find doctor
            $this->db->where('id', $report['doctor_id']);
            $doctor = $this->db->get('hms_doctors')->row_array();
            //sent notification to patient
            $this->notification->saveNotification($report['patient_id'], "Your medical report is uploded");
            //sent notification to doctor
            $this->notification->saveNotification($doctor['user_id'], "Medical report is uploaded of Patient_Appointment_No: <b>".$app_no['appoitment_number']."</b>");
        }
    }
    function getMedicalReportFiles($id){
        $this->db->where('medical_report_id',$id);
        $r = $this->db->get('hms_medical_report_file');
        $r = $r->result_array();
        return $r;
    }
    function deleteMedicalReportFile($id){
        $this->db->where('id',$id);
        $d = $this->db->get('hms_medical_report_file');
        $d = $d->row_array();
        $med_r_id = $d['medical_report_id'];

        @unlink($d['file_path']);
        $this->db->query("delete from hms_medical_report_file where id=$id");

        $this->db->where('medical_report_id',$med_r_id);
        $c = $this->db->get('hms_medical_report_file');
        if($c->num_rows() == 0){
            $this->db->where('id',$med_r_id);
            $this->db->update('hms_medical_report',array('status'=>0));
        }
    }
    function add() {
        $data = $_POST;
        $data['role'] = $this->auth->getMedicalLabRoleType();
        $uid = $this->auth->addUser($data);
        
        if($uid === false){
            return false;
        }else if($uid < 0){
            return $uid;
        }else{
            $mlab['user_id'] = $uid;
            $mlab['name'] = $data['name'];
            if(isset($data['country']))
                $mlab['country'] = $data['country'];
            if(isset($data['state']))
                $mlab['state'] = $data['state'];
            if(isset($data['district']))
                $mlab['district'] = $data['district'];
            if(isset($data['city']))
                $mlab['city'] = $data['city'];
            $mlab['description'] = $data['md_description'];
            $mlab['owner_name'] = $data['owner_name'];
            $mlab['owner_contact_number'] = $data['owner_contact_number'];
            $mlab['branch_id'] = isset($data['branch_id']) ? $data['branch_id'] : -1;
            $mlab['created_at'] = date("Y-m-d H:i:s");
            if(isset($data['isActive']))
                $mlab['isActive'] = intval($data['isActive']);
            if ($this->db->insert($this->tblname, $mlab)) {
                //find hospital name
                $this->db->where('id', $data['hospital_id']);
                $hospital = $this->db->get('hms_hospitals')->row_array();
                //sent notification to medical lab
                $this->notification->saveNotification($mlab['user_id'], "You are linked with <b>".$hospital['name']."</b> hospital");

                if($this->auth->isSuperAdmin()){
                    //find branch name
                    $this->db->where('id',$data['branch_id']);
                    $branch = $this->db->get('hms_branches')->row_array();
                    //find hospital admin
                    $this->db->where('hospital_id', $data['hospital_id']);
                    $hadmin = $this->db->get('hms_hospital_admin')->row_array();
                    //sent notification to hospital admin
                    $this->notification->saveNotification($hadmin['user_id'], "New medical lab <b>".$data['name']."</b> is linked with branch: <b>".$branch['branch_name']."</b>");
                }
                return true;
            } else {
                return false;
            }
        }
    }
    function update($id) {
        $data = $_POST;

        $this->db->where("id", $id);
        $usr = $this->db->get($this->tblname);
        $usr = $usr->row_array();

        $uid = isset($usr["user_id"]) ? $usr['user_id'] : 0;
        $uid = $this->auth->addUser($data,$uid);

        if($uid === false){
            return false;
        }else if($uid < 0){
            return $uid;
        }
        else{
            $mlab = array();
            if(isset($data['name']))
                $mlab['name'] = $data['name'];
            if(isset($data['country']))
                $mlab['country'] = $data['country'];
            if(isset($data['state']))
                $mlab['state'] = $data['state'];
            if(isset($data['district']))
                $mlab['district'] = $data['district'];
            if(isset($data['city']))
                $mlab['city'] = $data['city'];            
            if(isset($data['owner_name']))
                $mlab['owner_name'] = $data['owner_name'];
            if(isset($data['owner_contact_number']))
                $mlab['owner_contact_number'] = $data['owner_contact_number'];
            if(isset($data['branch_id']))
                $mlab['branch_id'] = $data['branch_id'];        
            if(isset($data['md_description'])){
                $mlab['description'] = $data['md_description'];
            }
            if(isset($data['isActive']))
                $mlab['isActive'] = intval($data['isActive']);
            if(count($mlab) > 0){
                $this->db->where("id", $id);
                if ($this->db->update($this->tblname, $mlab)) {
                    if (!$this->auth->isMedicalLab()) {
                        // sent notification to medical_lab incharge
                        $this->notification->saveNotification($usr['user_id'], "Your profile is updated");
                    }
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
}
