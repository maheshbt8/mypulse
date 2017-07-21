<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Dashboard_model extends CI_Model {

    function getSuperAdminStates(){
        $res['tot_hos'] = 0;
        $res['tot_doc'] = 0;
        $res['tot_pat'] = 0;
        $res['tot_app'] = 0;

        $h = $this->db->query("select count(id) as cnt from hms_hospitals where isDeleted=0");
        $h = $h->row_array();
        $res['tot_hos'] = $h['cnt'];

        $h = $this->db->query("select count(id) as cnt from hms_doctors where isDeleted=0");
        $h = $h->row_array();
        $res['tot_doc'] = $h['cnt'];

        $h = $this->db->query("select count(id) as cnt from hms_users where isDeleted=0 and role=".$this->auth->getPatientRoleType());
        $h = $h->row_array();
        $res['tot_pat'] = $h['cnt'];

        return $res;
    }

    function getHospitalAdminStates($hosptial_id){
        $res['tot_bra'] = 0;
        $res['tot_doc'] = 0;
        $res['tot_pat'] = 0;
        $res['tot_app'] = 0;

        $bids = $this->auth->getBranchIds();
        if(in_array(-1,$bids)){
            $res['tot_bra'] = 0;
        }else{
            $res['tot_bra'] = count($bids);
        }
        

        $dids = $this->auth->getAllDepartmentsIds();
        $dids = implode(",",$dids);
        $h = $this->db->query("select count(id) as cnt from hms_doctors where isDeleted=0 and department_id in ($dids)");
        $h = $h->row_array();
        $res['tot_doc'] = $h['cnt'];

        //$h = $this->db->query("select count(id) as cnt from hms_users where isDeleted=0 and role=".$this->auth->getPatientRoleType());
        //$h = $h->row_array();
        $res['tot_pat'] = 0;//$h['cnt'];

        return $res;
    }

    function getPatientStates(){
        $res['tot_hos'] = 0;
        $res['tot_doc'] = 0;
        $res['tot_medStore'] = 0;
        $res['tot_medLab'] = 0;
        $res['tot_app'] = 0;
        
        $res['medical_reports'] = array();
        $this->db->where('patient_id',$this->auth->getUserid());
        $this->db->where('status',0);
        $this->db->where('medical_lab_id',0);
        $reports = $this->db->get('hms_medical_report');
        if($reports){
            $res['medical_reports'] = $reports->result_array();
        }
        
        return $res;
    }

    function getReceptinestStates(){
        $uid = $this->auth->getUserid();
        $rid = $this->auth->getReceptinestId();

        $res['tot_hos'] = 0;
        $docs = $this->db->query("select DISTINCT doc_id as doc_id from hms_receptionist where isDeleted=0 and isActive=1 and user_id=".$uid);
        $docs = $docs->row_array();

        $res['tot_doc'] = count($docs);

        $dids = array();
        foreach($docs as $d){
            $dids[] = $d;
        }

        $h = $this->db->query("select count(DISTINCT department_id) as cnt from hms_doctors where isDeleted=0 and isActive=1 and id in (".implode(",",$dids).")");
        $h = $h->row_array();

        if(isset($h['cnt']))
            $res['tot_hos'] = $h['cnt'];

        $res['tot_pat'] = 0;
        $p = $this->db->query("select COUNT(DISTINCT user_id) as cnt from hms_appoitments where isDeleted=0 and doctor_id in (".implode(",",$dids).") ");
        $p = $p->row_array();
        if(isset($p['cnt']))
            $res['tot_pat'] = $p['cnt'];
        
        $res['tot_app'] = 0;
        $a = $this->db->query("select COUNT(id) as cnt from hms_appoitments where isDeleted=0 and doctor_id in (".implode(",",$dids).") ");
        $a = $a->row_array();
        if(isset($a['cnt']))
            $res['tot_app'] = $a['cnt'];
        return $res;
    }

    function getDoctorStates(){
        $res['tot_hos'] = 0;
        $res['tot_nus'] = 0;
        $uid = $this->auth->getUserid();
        $h = $this->db->query("select count(id) as cnt from hms_doctors where isDeleted=0 and isActive=1 and user_id=".$uid);
        $h = $h->row_array();
        if(isset($h['cnt']))
            $res['tot_hos'] = $h['cnt'];

        $did = $this->auth->getDoctorId();
        $res['tot_rec'] = 0;
        $r = $this->db->query("select count(id) as cnt from hms_receptionist where isDeleted=0 and isActive=1 and doc_id=".$did);
        $r = $r->row_array();
        if(isset($r['cnt']))
            $res['tot_rec'] = $r['cnt'];

        $res['tot_pat'] = 0;
        $p = $this->db->query("select COUNT(DISTINCT user_id) as cnt from hms_appoitments where isDeleted=0 and doctor_id=".$did);
        $p = $p->row_array();
        if(isset($p['cnt']))
            $res['tot_pat'] = $p['cnt'];

        $res['tot_app'] = 0;
        $a = $this->db->query("select COUNT(id) as cnt from hms_appoitments where isDeleted=0 and doctor_id=".$did);
        $a = $a->row_array();
        if(isset($a['cnt']))
            $res['tot_app'] = $a['cnt'];

        return $res;
    }

    function getMedicalLabStates(){
        $res = array();
        $res['tot_rep'] = 0;
        $res['tot_users'] = 0;
        $mid = $this->auth->getMyLabId();
        $medical_reports = array();
        $this->db->where('status',0);
        $this->db->where('medical_lab_id', $mid);
        $reports = $this->db->get('hms_medical_report');
        if($reports){
            $medical_reports = $reports->result_array();
        }

        for($i=0; $i<count($medical_reports); $i++){
            $mr = $medical_reports[$i];

            $this->db->where('id',$mr['patient_id']);
            $p = $this->db->get('hms_users');
            $p = $p->row_array();
            $mr['patient_name'] = $this->auth->getUName($p);
            
            $doc = $this->db->query("select * from hms_users u,hms_doctors d where d.id=$mr[doctor_id] and d.user_id=u.id");
            $doc = $doc->row_array();
            $mr['doctor_name'] = $this->auth->getUName($doc);

            $medical_reports[$i] = $mr;
        }
        $res['medical_reports'] = $medical_reports;
        return $res;
    }
}