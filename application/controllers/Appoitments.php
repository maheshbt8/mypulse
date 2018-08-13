<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Appoitments extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('appoitments_model');
        $this->load->model('hospitals_model');
        $this->load->model("branches_model");
        $this->load->model("departments_model");
        $this->load->model("users_model");
        $this->load->model("doctors_model");
        $this->load->model("receptionist_model");
		$this->load->model("dashboard_model");
    }
    public function index() {
        $data["page_title"] = $this->lang->line("appoitments");
        $data["breadcrumb"] = array(site_url() => $this->lang->line("home"), null => $this->lang->line("appoitments"));
        if ($this->auth->isLoggedIn() && $this->auth->isPatient()) {
		    $data['states'] = $this->dashboard_model->getPatientStates($this->auth->getUserid());    
            $this->load->view('Appoitments/index', $data);
        }else if ($this->auth->isLoggedIn() && $this->auth->isSuperAdmin() ) {
		    $data['states'] = $this->dashboard_model->getPatientStates($this->auth->getUserid());    
            $this->load->view('Appoitments/superadmin', $data);
        }
        else if($this->auth->isLoggedIn() && ($this->auth->isReceptinest()  || $this->auth->isHospitalAdmin())){
		    $data['Doctors'] = $this->users_model->GetActiveDoctors($this->auth->getUserid());
            $this->load->view('Appoitments/receptionist', $data);
        }
        else if($this->auth->isLoggedIn() && $this->auth->isDoctor()){
            $this->load->view('Appoitments/doctor', $data);
        }
         else redirect('index/login');
    }
    public function report(){
        if($this->auth->isLoggedIn() && $this->auth->isSuperAdmin()){
            $data["page_title"] = $this->lang->line("reports");
            $data["breadcrumb"] = array(site_url() => $this->lang->line("home"), null => $this->lang->line("appoitment_report"));
            $data['reports'] = $this->appoitments_model->getReport();
            $this->load->view('Appoitments/report',$data);
        }else{
            redirect('index/login');
        }
    }
    public function getreportchart(){
        if($this->auth->isLoggedIn() && $this->auth->isSuperAdmin()){
            $data['data'] = $this->appoitments_model->getreportchart();
            echo json_encode($data);
        }
    }
	public function hareport(){
        if($this->auth->isLoggedIn() && $this->auth->isHospitalAdmin()){
            $data["page_title"] = $this->lang->line("reports");
            $data["breadcrumb"] = array(site_url() => $this->lang->line("home"), null => $this->lang->line("appoitment_report"));
            $data['hareports'] = $this->appoitments_model->getHAReport();
            $this->load->view('Appoitments/hareport',$data);
        }else{
            redirect('index/login');
        }
    }
    public function gethareportchart(){
        if($this->auth->isLoggedIn() && $this->auth->isHospitalAdmin()){
            $data['data'] = $this->appoitments_model->getHAreportchart();
            echo json_encode($data);
        }
    }
    public function search() {
        if ($this->auth->isLoggedIn()) {
            $q = $this->input->get("q", null, "");
            $f = $this->input->get("f", null, "");
            $result = $this->appoitments_model->search($q, $f);
            echo json_encode($result);
        }
    }
    public function add() {
	
        if ($this->auth->isLoggedIn()) {
            if ($this->appoitments_model->add()) {
                $data['success'] = array($this->lang->line("msg_appoitment_added"));
            } else {
                $data['errors'] = array($this->lang->line("msg_try_again"));
            }
            $this->session->set_flashdata('data', $data);
            redirect('appoitments/index');
        } else redirect('index/login');
    }
    public function update() {
        if ($this->auth->isLoggedIn()) {
            $data = array();
            $id = $this->input->post('eidt_gf_id');
            if ($this->appoitments_model->update($id)) {
                $data['success'] = array($this->lang->line("msg_appoitment_updated"));
            } else {
                $data['errors'] = array($this->lang->line("msg_try_again"));
            }
            $this->session->set_flashdata('data', $data);
            redirect('appoitments/index');
        } else redirect('index/login');
    }
    public function delete() {
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo $this->appoitments_model->delete($id);
        }
    }
    public function cancel() {
      
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo $this->appoitments_model->cancel($id);
        }
    }

    public function reject() {
      
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo $this->appoitments_model->reject($id);
            //$this->session->set_flashdata('data', $id);
           // redirect('appoitments/doctor');
        }
    }

    public function approve(){
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo $this->appoitments_model->approve($id);
            //$this->session->set_flashdata('data', $id);
            //redirect('appoitments/doctor');
        }
    }

    public function getappoitments() {
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo json_encode($this->appoitments_model->getappoitmentsById($id));
        }
    }
	
	public function getrecommendappoitments() {
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo json_encode($this->appoitments_model->getrecommendappoitmentsById($id));
        }
    }

    public function getNewSloat(){
        if($this->auth->isLoggedIn()){
            
            $did = $_POST['did'];
            $date = date("Y-m-d",strtotime($_POST['date']));

            echo json_encode($this->appoitments_model->getTimeSloats($did,$date));exit;
        }
    }

    public function udpateremark(){
        if($this->auth->isLoggedIn()){
            echo json_encode($this->appoitments_model->udpateremark());exit;
        }
    }

    public function getDTappoitments() {
        if ($this->auth->isLoggedIn()) {
            $hid = isset($_GET['hid']) ? $_GET['hid']!="" ? intval($_GET['hid']) : null : null;
            $bid = isset($_GET['bid']) ? $_GET['bid']!="" ? intval($_GET['bid']) : null : null;
            $sdate = isset($_GET['sd']) ? $_GET['sd'] != "" ? date("Y-m-d",strtotime($_GET['sd'])) : null : null;
            $edate = isset($_GET['ed']) ? $_GET['ed'] != "" ? date("Y-m-d",strtotime($_GET['ed'])) : null : null;
			
            if($hid == "all")
                $hid = null;

            $show  = $this->input->get('s',null,false);
            $cond = array("hms_appoitments.isDeleted=0");

            if($this->auth->isPatient()){
                $uid = $this->auth->getUserid();
                $cond[] = 'hms_appoitments.user_id='.$uid;
            }

            $up = isset($_GET['up']) ? $_GET['up'] : false;
            if($up){
                $cond[] = "hms_appoitments.appoitment_date >= '".date("Y-m-d")."'";
                $cond[] = "hms_appoitments.status = 0";
            }else if($sdate != null && $edate != null){
                $cond[] = "hms_appoitments.appoitment_date between '$sdate' and '$edate'";
            }   

            //New Library
            $this->datatables
            ->showCheckbox(true)
            ->from('hms_appoitments')
            ->select('hms_appoitments.id as mainid, hms_appoitments.appoitment_number as apt_no, CONCAT(hms_hospitals.name," - ",hms_branches.branch_name) as h_b_name, hms_departments.department_name as dname, CONCAT(hms_users.first_name," ",hms_users.last_name) as docname, hms_appoitments.appoitment_date as apt_date, CONCAT(hms_appoitments.appoitment_time_start," to ",hms_appoitments.appoitment_time_end) as time_slot, case when hms_appoitments.status=0 then "'.$this->lang->line('labels')['pending'].'" when hms_appoitments.status=1 then "'.$this->lang->line('labels')['approved'].'" when hms_appoitments.status=2 then "'.$this->lang->line('labels')['rejected'].'" when hms_appoitments.status=3 then "'.$this->lang->line('labels')['closed'].'" when hms_appoitments.status=4 then "'.$this->lang->line('labels')['canceled'].'" end as status, hms_appoitments.id as appt_action_id, hms_appoitments.status as appt_action_status, hms_appoitments.appoitment_date as appt_action_date', false)
            ->join('hms_departments','hms_appoitments.department_id = hms_departments.id','left')
            ->join('hms_branches','hms_departments.branch_id = hms_branches.id','left')
            ->join('hms_hospitals','hms_branches.hospital_id = hms_hospitals.id','left')
            ->join('hms_doctors','hms_appoitments.doctor_id = hms_doctors.id','left')
            ->join('hms_users','hms_doctors.user_id = hms_users.id','left')
            ->unset_column('appt_action_status')
            ->unset_column('appt_action_date');

            
            if($show || $up){
                //New Library
                $this->datatables
                ->showIndex(true)
                ->unset_column('appt_action_id');
            }

             //Set condition to new library
             foreach($cond as $con){
                $this->datatables->where($con);
            }
            //Call new library for output
            echo $this->datatables->generate('json');
            
        }
    }

    public function getDTRespappoitments(){
        if ($this->auth->isLoggedIn()) {          
            $st = isset($_GET['st']) ? $_GET['st']!="" ? $_GET['st'] : null : null;
            $sc = isset($_GET['sc']) ? intval($_GET['sc']) : 0;
            $hid = isset($_GET['hid']) ? $_GET['hid']!="" ? $_GET['hid'] : null : null;
            $did = isset($_GET['did']) ? $_GET['did']!="" ? $_GET['did'] : null : null;
            $appt_date = isset($_GET['d']) ? $_GET['d'] != "" ? date("Y-m-d",strtotime($_GET['d'])) : null : null;
            $sdate = isset($_GET['sd']) ? $_GET['sd'] != "" ? date("Y-m-d",strtotime($_GET['sd'])) : null : null;
            $edate = isset($_GET['ed']) ? $_GET['ed'] != "" ? date("Y-m-d",strtotime($_GET['ed'])) : null : null;
            
            if($hid === "all")
                $hid = null;
            if($did === "all")
                $did = null;
            if($st === "all"){    
                $st = null;
				$all_status = array(0,1,2,4);
            }
			
			if($st === "all_inc_closed"){    
                $st = null;
				$all_status = array(0,1,2,3,4);
            }
            
            
            $status = array();
            if($st !== null){
                $status[] = $st;
            }else{
                $status = $all_status;
            }

            if($sc==1){
                $status[] = 3;
            }  

            $show  = $this->input->get('s',null,false);
            $cond = array("hms_appoitments.isDeleted=0");

            if($sdate != null && $edate != null){
                $cond[] = "hms_appoitments.appoitment_date between '$sdate' and '$edate'";
            }
            if($appt_date != null){
                $cond[] = "hms_appoitments.appoitment_date='{$appt_date}'";
            }
            
            if(count($status) > 0){
                $cond[] = "hms_appoitments.status in (".implode(",",$status).")";
            }else{
                $cond[] = "hms_appoitments.status in (".implode(",",$all_status).")";
            }

            if($hid != null){
                $_dids = $this->departments_model->getDepartmentIdsFromHospital($hid);
                if(count($_dids) == 0){ $_dids[] = -1;}
                $_dids = implode(",",$_dids);
                $cond[] = "hms_appoitments.department_id in (".$_dids.")";
            }

            if($did != null){
                $cond[] = "hms_appoitments.doctor_id=$did";
            }
            else if($this->auth->isReceptinest()){
                $dids = $this->receptionist_model->getDoctorsIds();
                if(count($dids) == 0){ $dids[] = -1;}
                $dids = implode(",",$dids);
                $cond[] = "hms_appoitments.doctor_id in (".$dids.")";
            }else if($this->auth->isHospitalAdmin()){
                $dids = $this->doctors_model->getDoctorsIdsByHospital();
                if(count($dids) == 0){ $dids[] = -1;}
                $dids = implode(",",$dids);
                $cond[] = "hms_appoitments.doctor_id in (".$dids.")";
            }
            //New Library
            $this->datatables
            ->showCheckbox(true)
            ->from('hms_appoitments')
            ->select('hms_appoitments.id as mainid, hms_appoitments.appoitment_number as apt_no, CONCAT(hms_users.first_name," ",hms_users.last_name) as patient, CONCAT(hms_hospitals.name," - ",hms_branches.branch_name," - ",hms_departments.department_name) as h_b_d_name, CONCAT(docusers.first_name," ",docusers.last_name) as docname, hms_appoitments.appoitment_date as apt_date, CONCAT(hms_appoitments.appoitment_time_start," to ",hms_appoitments.appoitment_time_end) as time_slot, case when hms_appoitments.status=0 then "'.$this->lang->line('labels')['pending'].'" when hms_appoitments.status=1 then "'.$this->lang->line('labels')['approved'].'" when hms_appoitments.status=2 then "'.$this->lang->line('labels')['rejected'].'" when hms_appoitments.status=3 then "'.$this->lang->line('labels')['closed'].'" when hms_appoitments.status=4 then "'.$this->lang->line('labels')['canceled'].'" end as status, hms_appoitments.id as appt_action_id, hms_appoitments.status as appt_action_status, hms_appoitments.appoitment_date as appt_action_date', false)
            ->join('hms_users','hms_appoitments.user_id = hms_users.id','left')
            ->join('hms_departments','hms_appoitments.department_id = hms_departments.id','left')
            ->join('hms_branches','hms_departments.branch_id = hms_branches.id','left')
            ->join('hms_hospitals','hms_branches.hospital_id = hms_hospitals.id','left')
            ->join('hms_doctors','hms_appoitments.doctor_id = hms_doctors.id','left')
            ->join('hms_users as docusers','hms_doctors.user_id = docusers.id','left')
            ->unset_column('appt_action_status')
            ->unset_column('appt_action_date');
            

			$isToday = isset($_GET['tod']) ? intval($_GET['tod']) : false;
			if($isToday && $isToday === 1){
				date_default_timezone_get("Asia/Kolkata");
                $cond[] = "hms_appoitments.appoitment_date='".date("Y-m-d")."'";
                
                //New library
                $this->datatables
                    ->unset_column('apt_date')
                    ->showCheckbox(true);  

            }
            
            //Set condition to new library
            foreach($cond as $con){
                $this->datatables->where($con);
            }
            //Call new library for output
            echo $this->datatables->generate('json');
        }    
    }

    public function getDTDocpappoitments(){
        if ($this->auth->isLoggedIn()) {

            $st = isset($_GET['st']) ? $_GET['st']!="" ? $_GET['st'] : null : null;
            $sc = isset($_GET['sc']) ? intval($_GET['sc']) : 0;
            $hid = isset($_GET['hid']) ? $_GET['hid']!="" ? $_GET['hid'] : null : null;
            $sdate = isset($_GET['sd']) ? $_GET['sd'] != "" ? date("Y-m-d",strtotime($_GET['sd'])) : null : null;
            $edate = isset($_GET['ed']) ? $_GET['ed'] != "" ? date("Y-m-d",strtotime($_GET['ed'])) : null : null;

            if($hid === "all")
                $hid = null;
            
            if($st === "all"){    
                $st = null;
				$all_status = array(0,1,2,4);
            }
			
			if($st === "all_inc_closed"){    
                $st = null;
				$all_status = array(0,1,2,3,4);
            }

            $status = array();
            if($st !== null){
                $status[] = $st;
            }else{
                $status = $all_status;
            }

            if($sc==1){
                $status[] = 3;
            }    

            $show  = $this->input->get('s',null,false);
            $cond = array("hms_appoitments.isDeleted=0");
            $cond[] = "hms_appoitments.doctor_id = ".$this->auth->getDoctorId();

			if($sdate != null && $edate != null){
                $cond[] = "hms_appoitments.appoitment_date between '$sdate' and '$edate'";
            }
        
            if(count($status) > 0){
                $cond[] = "hms_appoitments.status in (".implode(",",$status).")";
            }else{
                $cond[] = "hms_appoitments.status in (".implode(",",$all_status).")";
            }

            if($hid != null){
                $_dids = $this->departments_model->getDepartmentIdsFromHospital($hid);
                if(count($_dids) == 0){ $_dids[] = -1;}
                $_dids = implode(",",$_dids);
                $cond[] = "hms_appoitments.department_id in (".$_dids.")";
            }

            //New Library
            $this->datatables
                ->showCheckbox(true)
                ->from('hms_appoitments')
                ->select('hms_appoitments.id as mainid, hms_appoitments.appoitment_number as apt_no, CONCAT(hms_users.first_name," ",hms_users.last_name) as patient, hms_appoitments.reason as reason, hms_appoitments.appoitment_date as apt_date, CONCAT(hms_appoitments.appoitment_time_start," to ",hms_appoitments.appoitment_time_end) as time_slot, case when hms_appoitments.status=0 then "'.$this->lang->line('labels')['pending'].'" when hms_appoitments.status=1 then "'.$this->lang->line('labels')['approved'].'" when hms_appoitments.status=2 then "'.$this->lang->line('labels')['rejected'].'" when hms_appoitments.status=3 then "'.$this->lang->line('labels')['closed'].'" when hms_appoitments.status=4 then "'.$this->lang->line('labels')['canceled'].'" end as status, hms_appoitments.id as appt_action_id, hms_appoitments.status as appt_action_status, hms_appoitments.appoitment_date as appt_action_date', false)
                ->join('hms_users','hms_appoitments.user_id = hms_users.id','left')
                ->unset_column('appt_action_status')
                ->unset_column('appt_action_date');
                

            $isToday = isset($_GET['td']) ? intval($_GET['td']) : 0;
			if($isToday===1){   
                
                $cond[] = "DATE(hms_appoitments.appoitment_date)='".date("Y-m-d")."'";
                

                //New Library
                $this->datatables
                    ->showIndex(true)
                    ->unset_column('apt_date');
            }
            
            //Set condition to new library
            foreach($cond as $con){
                $this->datatables->where($con);
            }
            //Call new library for output
            echo $this->datatables->generate('json');
        }    
    }

    public function getDTTodayspappoitments(){
        if ($this->auth->isLoggedIn()) {

            $st = isset($_GET['st']) ? $_GET['st']!="" ? $_GET['st'] : null : null;
            $sc = isset($_GET['sc']) ? intval($_GET['sc']) : 0;
            $hid = isset($_GET['hid']) ? $_GET['hid']!="" ? $_GET['hid'] : null : null;
            $sdate = isset($_GET['sd']) ? $_GET['sd'] != "" ? date("Y-m-d",strtotime($_GET['sd'])) : null : null;
            $edate = isset($_GET['ed']) ? $_GET['ed'] != "" ? date("Y-m-d",strtotime($_GET['ed'])) : null : null;

            if($hid === "all")
                $hid = null;
            
            if($st === "all")    
                $st = null;

            $all_status = array(0,1,2,4);
            $status = array();
            if($st !== null){
                $status[] = $st;
            }else{
                $status = $all_status;
            }

            if($sc==1){
                $status[] = 3;
            }    

            $show  = $this->input->get('s',null,false);
            $cond = array("hms_appoitments.isDeleted=0");

			if($sdate != null && $edate != null){
                $cond[] = "hms_appoitments.appoitment_date between '$sdate' and '$edate'";
            }
        
            if(count($status) > 0){
                $cond[] = "hms_appoitments.status in (".implode(",",$status).")";
            }else{
                $cond[] = "hms_appoitments.status in (".implode(",",$all_status).")";
            }

            if($hid != null){
                $_dids = $this->departments_model->getDepartmentIdsFromHospital($hid);
                if(count($_dids) == 0){ $_dids[] = -1;}
                $_dids = implode(",",$_dids);
                $cond[] = "hms_appoitments.department_id in (".$_dids.")";
            }

            $isToday = isset($_GET['td']) ? intval($_GET['td']) : 0;

            $cond[] = "DATE(hms_appoitments.appoitment_date)='".date("Y-m-d")."'";
            $cond[] = "hms_appoitments.doctor_id = ".$this->auth->getDoctorId();

            //New Library
            //
            $this->datatables
                ->showIndex(true)
                ->from('hms_appoitments')
                ->select('hms_appoitments.id as mainid, hms_appoitments.appoitment_number as apt_no, CONCAT(hms_users.first_name," ",hms_users.last_name) as patient, hms_appoitments.reason as reason, CONCAT(hms_appoitments.appoitment_time_start," to ",hms_appoitments.appoitment_time_end) as time_slot, case when hms_appoitments.status=0 then "'.$this->lang->line('labels')['pending'].'" when hms_appoitments.status=1 then "'.$this->lang->line('labels')['approved'].'" when hms_appoitments.status=2 then "'.$this->lang->line('labels')['rejected'].'" when hms_appoitments.status=3 then "'.$this->lang->line('labels')['closed'].'" when hms_appoitments.status=4 then "'.$this->lang->line('labels')['canceled'].'" end as status, hms_appoitments.id as appt_action_id, hms_appoitments.status as appt_action_status, hms_appoitments.appoitment_date as appt_action_date', false)
                ->join('hms_users','hms_appoitments.user_id = hms_users.id','left')
                ->unset_column('appt_action_status')
                ->unset_column('appt_action_date');


            //Set condition to new library
            foreach($cond as $con){
                $this->datatables->where($con);
            }
            //Call new library for output
            echo $this->datatables->generate('json');

            
        }    
    }

}
