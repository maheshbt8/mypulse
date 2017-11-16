<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Medical_store extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('medical_store_model');
        $this->load->model('hospitals_model');
        $this->load->model("branches_model");
        $this->load->model('doctors_model');
        $this->load->model('users_model');
    }
	
	public function patient(){
        if ($this->auth->isLoggedIn()) {
            $this->load->view('Medical_store/patient');
        }
        else{
            redirect('index');
        }
    }
	
    public function index() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $data['medical_stores'] = $this->medical_store_model->getAllmedical_store();
            $data["page_title"] = $this->lang->line('medicalStoreFull');
            $data["breadcrumb"] = array(site_url() => $this->lang->line('home'), null => $this->lang->line('medicalStoreFull'));
            $this->load->view('Medical_store/index', $data);
        } else redirect('index/login');
    }
    public function search() {
        if ($this->auth->isLoggedIn()) {
            $q = $this->input->get("q", null, "");
            $f = $this->input->get("f", null, "");
            $ci = $this->input->get('city',null,null);
            $result = $this->medical_store_model->search($q, $f, $ci);
            echo json_encode($result);
        }
    }
    public function add() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $res = $this->medical_store_model->add();
            $data = $this->auth->parseUserResult($res,$this->lang->line('msg_medstore_added'));
           
            $this->session->set_flashdata('data', $data);
            redirect('medical_store/index');
        } else redirect('index/login');
    }
    public function update() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            
            $id = $this->input->post('eidt_gf_id');
            $res = $this->medical_store_model->update($id);
            $data = $this->auth->parseUserResult($res,$this->lang->line('msg_medstore_updated'));
            
            $this->session->set_flashdata('data', $data);
            redirect('medical_store/index');
        } else redirect('index/login');
    }
    public function about(){
        if ($this->auth->isLoggedIn()){
            $data["page_title"] = $this->lang->line('medicalStoreFull');
            $data["breadcrumb"] = array(site_url() => $this->lang->line('home'), null => $this->lang->line('about'));
            $id = $this->medical_store_model->getMyStoreId();
            $data['about'] = $this->medical_store_model->getmedical_storeById($id);
            $this->load->view('Medical_store/about',$data);
        }else{
            redirect('index/login');
        }
    }
    public function updateabout(){
        if ($this->auth->isLoggedIn() && $this->auth->isMedicalStore()){
            $id = $this->input->post('eidt_gf_id');
            $this->medical_store_model->update($id);
            $data['success'] = array($this->lang->line('msg_medstore_updated'));
            $this->session->set_flashdata('data', $data);
            redirect('medical_store/about');   
        }
        else redirect('index/login');   
    }
    public function orders(){
        if ($this->auth->isLoggedIn()){
            $data["page_title"] = $this->lang->line('medicalStoreFull');
            $data["breadcrumb"] = array(site_url() => $this->lang->line('home'), null => $this->lang->line('orders'));
            
            $this->load->view('Medical_store/orders',$data);
        }
    }
    public function delete() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            $id = $this->input->post('id');
            echo $this->medical_store_model->delete($id);
        }
    }
    public function getmedical_store() {
        if ($this->auth->isLoggedIn()) {
            $id = $this->input->post('id');
            echo json_encode($this->medical_store_model->getmedical_storeById($id));
        }
    }

    public function previewprescription($prescription_id){
        if($this->auth->isLoggedIn()){
            $prescription = $this->doctors_model->getPrescription($prescription_id);
            $prescription['isMedStore'] = true;
            $return['html'] = $this->load->view('template/prescription',array("data"=>$prescription),true);
            $btn = '';        
            $btn .= '<a href="#" class="btn btn-primary printtem" data-url="doctors/previewprescription/'.$prescription_id.'">Print</a>&nbsp;&nbsp;';
            $return['btns'] = $btn;
            echo json_encode($return);
        }
    }

    public function getDTmedical_store() {
        if ($this->auth->isLoggedIn() && ($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin())) {
            
            $hospital_id = $this->input->get('hid',null,null);
            $show  = $this->input->get('s',null,false);
            $cond = array("hms_medical_store.isDeleted=0");
            
            if($this->auth->isHospitalAdmin()){
                $ids = $this->auth->getBranchIds();
                $ids = implode(",", $ids);
                $cond[] = "hms_medical_store.branch_id in (".$ids.")";
            }else if($hospital_id!=null){
                $ids = $this->branches_model->getBracheIds($hospital_id);
                if(count($ids) == 0){
                    $ids[] = -1;
                }
                $ids = implode(",", $ids);
                $cond[] = "hms_medical_store.branch_id in (".$ids.")";
            }
            
            //New library
            $this->datatables
                ->showCheckbox(true)
                ->from('hms_medical_store')
                ->select('hms_medical_store.id as mainid, hms_medical_store.name as msname, hms_medical_store.owner_name as owname, hms_medical_store.owner_contact_number as contact, hms_hospitals.name as hname, hms_branches.branch_name as bname', false)
                ->join('hms_branches','hms_medical_store.branch_id = hms_branches.id', 'left')
                ->join('hms_hospitals','hms_branches.hospital_id = hms_hospitals.id','left');          

            if($show){
                $this->datatables->unset_column('hname');
                $this->datatables
                    ->showIndex(true);            
            }else{
                $this->datatables
                    ->edit_column('msname','<a href="#" data-id="$1" class="editbtn" data-toggle="modal" data-target="#edit" data-toggle="tooltip" title="Edit">$2</a>', 'hms_medical_store.id, msname')
                    ->add_column('edit','<a href="#" id="dellink_$1" class="delbtn"  data-toggle="modal" data-target=".bs-example-modal-sm" data-id="$1" data-toggle="tooltip" title="Delete"><i class="glyphicon glyphicon-remove"></i></button>', 'hms_medical_store.id');
            }

            //Set condition to new library
            foreach($cond as $con){
                $this->datatables->where($con);
            }
            //Call new library for output
            echo $this->datatables->generate('json');
        }
    }

    public function getDTorders(){
        if ($this->auth->isLoggedIn()) {
                      
            $cond = array("hms_prescription.isDeleted = 0");
            $cond[] = "store_id=".$this->auth->getMyStoreId();
            $status = isset($_GET['s']) ? $_GET['s'] : false;
			if($status !== false && $status != ""){
				$cond[] = "hms_prescription.order_status=$status";
            }
            
            //New Library
            $this->datatables
            ->from('hms_prescription')
            ->select('CONCAT(docusers.first_name," ",docusers.last_name) as docname, CONCAT(hms_users.first_name," ",hms_users.last_name) as patient, hms_users.mobile as contact, hms_users.address as address, case when hms_prescription.order_status=0 then "'.$this->lang->line('labels')['pending'].'" when hms_prescription.order_status=1 then "'.$this->lang->line('labels')['completed'].'" end as status, hms_prescription.id as pre_id', false)
            ->join('hms_users','hms_prescription.patient_id = hms_users.id','left')
            ->join('hms_doctors','hms_prescription.doctor_id = hms_doctors.id','left')
            ->join('hms_users as docusers','hms_doctors.user_id = docusers.id','left')
            ->add_column('prescription', '<a href="#" data-url="medical_store/previewprescription/$1" data-id="$1" class="previewtem"><i class="fa fa-file"></i></a>', 'pre_id')
            ->add_column('receipt', '<a href="#" class="btnup" data-id="$1" data-toggle="modal" data-target="#uploadMR">Receipt</a>', 'pre_id')
            ->unset_column('pre_id');
            
            //Set condition to new library
            foreach($cond as $con){
                $this->datatables->where($con);
            }
            //Call new library for output
            echo $this->datatables->generate('json');
        }
    }

    public function uploadreceipt(){
        if ($this->auth->isLoggedIn()){
            $id = isset($_POST['id']) ? $_POST['id'] : 0;

			if(is_array($_FILES) && isset($_FILES['files'])) 
			{
                $urls = array();
                $paths = array();
                $types = array();
                for($i=0; $i<count($_FILES['files']['name']); $i++){
                    if(is_uploaded_file($_FILES['files']['tmp_name'][$i])) {
                        $sourcePath = $_FILES['files']['tmp_name'][$i];
                        $fname = time()."_".$id.".png";
                        $url = base_url()."/public/receipt/".$fname;
                        $bash = dirname(APPPATH)."/public/receipt/".$fname;
                        
                        if(move_uploaded_file($sourcePath,$bash)) {
                            $urls[$i] = $url;
                            $paths[$i] = $bash;
                            $types[$i] = $_FILES['files']['type'][$i];
                        }
                    }
                }
                $this->medical_store_model->addReceiptUrl($id,$urls,$paths,$types);
                $data = $this->medical_store_model->getMedicalReceiptFiles($id);
                $urls = array();
                foreach($data as $d){
                    $urls[] = array('url'=>$d['file_url'], 'id'=>$d['id']);
                }
                echo json_encode($urls);exit;
			}
        }
        else{
            redirect('index/login');
        }
    }

    public function removereceiptfile(){
        if ($this->auth->isLoggedIn()){
            $id = isset($_POST['id']) ? $_POST['id'] : 0;
            $this->medical_store_model->deleteMedicalReceiptFile($id);
        }
    }
    public function getreceiptpreview($id){
        if ($this->auth->isLoggedIn()){
            $data = $this->medical_store_model->getMedicalReceiptFiles($id);
            
            $urls = array();
            foreach($data as $d){
                $urls[] = array('url'=>$d['file_url'], 'id'=>$d['id']);
            }
            echo json_encode($urls);exit;
        }
    }
	
	public function getDTPatients() {
        if ($this->auth->isLoggedIn() ) {
            $this->load->library("tbl");
            $table = "hms_users";
            $primaryKey = "id";
            $columns = array(array("db" => "first_name", "dt" => 0, "formatter" => function ($d, $row) {
                $user = $this->users_model->getusersById($row['id']);
                $name = "";
                if(isset($user['first_name'])){
                    $name = $user['first_name'];
                }
                if(isset($user['last_name'])){
                    $name .= " ".$user['last_name'];
                }
                return $name;
            }), array("db" => "useremail", "dt" => 1, "formatter" => function ($d, $row) {
                return "<a href='mailto:$d' >".$d."</a>";
            }), array("db" => "mobile", "dt" => 2, "formatter" => function ($d, $row) {
               return $d;
            }));
            $cond = array("role=".$this->auth->getPatientRoleType());
            
			$ids = $this->medical_store_model->getMyPatientsIds();
			if(count($ids) == 0) { $ids[] = -1; }
			$ids = implode(",",$ids);
			$cond[] = "id in ($ids)";

			$this->tbl->setCheckboxColumn(false);
            $this->tbl->setIndexColumn(true);
			
            $this->tbl->setTwID(implode(' AND ',$cond));
            // SQL server connection informationhostname" => "localhost",
            $sql_details = array("user" => $this->config->item("db_user"), "pass" => $this->config->item("db_password"), "db" => $this->config->item("db_name"), "host" => $this->config->item("db_host"));
            echo json_encode($this->tbl->simple($_GET, $sql_details, $table, $primaryKey, $columns));
        }
    }
}
