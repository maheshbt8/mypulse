<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class Patient_model extends CI_Model {
    var $tblname = "hms_users";
    var $healthTbl = "hms_healthrecords";

    function updateHealthData($id){
        $hr = array();

        if(isset($_POST['blood_group'])){
            $hr['blood_group'] = $_POST['blood_group'];
        }

        if(isset($_POST['height_feet'])){
            $hr['height_feet'] = intval($_POST['height_feet']);
        }

        if(isset($_POST['height_inch'])){
            $hr['height_inch'] = intval($_POST['height_inch']);
        }

        if(isset($_POST['weight'])){
            $hr['weight'] = floatval($_POST['weight']);
        }

        if(isset($_POST['high_blood_pressure'])){
            $hr['high_blood_pressure'] = $_POST['high_blood_pressure'];
        }

        if(isset($_POST['low_blood_pressure'])){
            $hr['low_blood_pressure'] = $_POST['low_blood_pressure'];
        }

        if(isset($_POST['sugar_level'])){
            $hr['sugar_level'] = $_POST['sugar_level'];
        }

        if(isset($_POST['health_insurance_provider'])){
            $hr['health_insurance_provider'] = $_POST['health_insurance_provider'];
        }

        if(isset($_POST['health_insurance_id'])){
            $hr['health_insurance_id'] = $_POST['health_insurance_id'];
        }

        if(isset($_POST['family_history'])){
            $hr['family_history'] = $_POST['family_history'];
        }

        if(isset($_POST['past_medical_history'])){
            $hr['past_medical_history'] = $_POST['past_medical_history'];
        }

        $this->db->where('user_id',$id);
        $temp = $this->db->get($this->healthTbl);
        if($temp->num_rows() > 0){
            $this->db->where('user_id',$id);
            $this->db->update($this->healthTbl,$hr);
			$this->logger->log("Patient health information updated", Logger::Patient, $id);
			
            //sent notification to patient
            $this->notification->saveNotification($id,"Your health information is updated");
        }else{
            $hr['user_id'] = $id;
            $this->db->insert($this->healthTbl,$hr);
			$this->logger->log("Patient health information added", Logger::Patient, $$hr['user_id']);
            //sent notification to patient
            $this->notification->saveNotification($id,"Some health data are added in your helth information");
        }   
        return true;
    }

    function update($id) {

        $hr = array();

        if(isset($_POST['blood_group'])){
            $hr['blood_group'] = $_POST['blood_group'];
        }

        if(isset($_POST['height_feet'])){
            $hr['height_feet'] = intval($_POST['height_feet']);
        }

        if(isset($_POST['height_inch'])){
            $hr['height_inch'] = intval($_POST['height_inch']);
        }

        if(isset($_POST['weight'])){
            $hr['weight'] = floatval($_POST['weight']);
        }

        if(isset($_POST['blood_pressure'])){
            $hr['blood_pressure'] = $_POST['blood_pressure'];
        }

        if(isset($_POST['sugar_level'])){
            $hr['sugar_level'] = $_POST['sugar_level'];
        }

        if(isset($_POST['health_insurance_provider'])){
            $hr['health_insurance_provider'] = $_POST['health_insurance_provider'];
        }

        if(isset($_POST['health_insurance_id'])){
            $hr['health_insurance_id'] = $_POST['health_insurance_id'];
        }

        if(isset($_POST['family_history'])){
            $hr['family_history'] = $_POST['family_history'];
        }

        if(isset($_POST['past_medical_history'])){
            $hr['past_medical_history'] = $_POST['past_medical_history'];
        }

        $this->db->where('user_id',$id);
        $temp = $this->db->get($this->healthTbl);
        if($temp->num_rows() > 0){
            $this->db->where('user_id',$id);
            $this->db->update($this->healthTbl,$hr);
        }else{
            $hr['user_id'] = $id;
            $this->db->insert($this->healthTbl,$hr);
        }

        $data = $_POST;
        //echo "<pre>";
        //print_r($id);
        //print_r($data);

        $patient_id = $this->auth->addUser($data,$id);
        //print_r($patient_id);
        //echo "hi";
        //exit;
        if($patient_id === false){
            return false;
        }else if($patient_id < 0){
            return $patient_id;
        }
        return true;

    }

    function getProfile($id){
        $res = $this->db->query("select * from hms_users where id=$id");
        $res =  $res->row_array();

        $h = $this->db->query("select * from $this->healthTbl where user_id=$id");
        $found = true;
        if($h->num_rows() == 0){
            $found = false;
            $h = $this->db->query("select * from $this->healthTbl limit 1");
        }
        $h = $h->row_array();
        foreach($h as $key=> $value){
            if(!$found)
                $value = "";
            if($key=="id")
                $res['health_id'] = $value;
            else
                $res[$key] = $value;
        }

        $con = $this->db->query("select * from hms_country where id = $res[country]");
        if($con->num_rows() > 0){
            $con = $con->row_array();
            $res['country_name'] = $con['name'];
        }else{
            $res['country_name'] = '';
        }

        return $res;
    }

    //Select Medical Lab. For medical Report created by doctor at the time of prescription.
    public function selectml(){
        $mrid = isset($_POST['mrid']) ? $_POST['mrid'] : 0;
        $this->db->where('id',$mrid);
        $this->db->where('patient_id',$this->auth->getUserid());
        $data['medical_lab_id'] = isset($_POST['medicalLab']) ? $_POST['medicalLab'] : 0;
        $this->db->update('hms_medical_report',$data);
        $this->db->where('id', $data['medical_lab_id']);
        $medicallab = $this->db->get('hms_medical_lab')->row_array();
        $this->notification->saveNotification($medicallab['user_id'], "Patient request for test the medical report");
    }

    function getReport(){
        $start_date = isset($_GET['sd']) ? date("Y-m-d",strtotime($_GET['sd'])) : date('Y-m-d',(strtotime ( '-29 day' , time() ) ));
        $end_date = isset($_GET['ed']) ? date("Y-m-d",strtotime($_GET['ed'])) : date("Y-m-d");
        if($start_date != "" && $end_date != ""){
            $qry = 'SELECT  @s:=@s+1 as ind, COUNT(DISTINCT a.user_id ) as count,h.name,h.id as hid FROM `hms_appoitments` a, (SELECT @s:= 0) AS s,hms_departments d,hms_branches b,hms_hospitals h where a.appoitment_date >= "'.$start_date.'" and a.appoitment_date <= "'.$end_date.'" and a.department_id=d.id and d.branch_id=b.id and b.hospital_id = h.id GROUP by h.id';
        }else if($start_date != ""){
            $qry = 'SELECT  @s:=@s+1 as ind, COUNT(DISTINCT a.user_id ) as count,h.name,h.id as hid FROM `hms_appoitments` a, (SELECT @s:= 0) AS s,hms_departments d,hms_branches b,hms_hospitals h where a.appoitment_date >= "'.$start_date.'" and a.department_id=d.id and d.branch_id=b.id and b.hospital_id = h.id GROUP by h.id';
        }else if($end_date != ""){
            $qry = 'SELECT  @s:=@s+1 as ind, COUNT(DISTINCT a.user_id ) as count,h.name,h.id as hid FROM `hms_appoitments` a, (SELECT @s:= 0) AS s,hms_departments d,hms_branches b,hms_hospitals h where a.appoitment_date <= "'.$end_date.'" and a.department_id=d.id and d.branch_id=b.id and b.hospital_id = h.id GROUP by h.id';
        }else{
            $qry = 'SELECT  @s:=@s+1 as ind, COUNT(DISTINCT a.user_id ) as count,h.name,h.id as hid FROM `hms_appoitments` a, (SELECT @s:= 0) AS s,hms_departments d,hms_branches b,hms_hospitals h where a.department_id=d.id and d.branch_id=b.id and b.hospital_id = h.id GROUP by h.id';
        }
        return $this->db->query($qry)->result_array();
    }

    function getreportchart(){
        $hid = isset($_GET['hid']) ? explode(",",$_GET['hid']) : 0;
        $start_date = isset($_GET['sd']) ? date("Y-m-d",strtotime($_GET['sd'])) : date('Y-m-d',(strtotime ( '-29 day' , time() ) ));
        $end_date = isset($_GET['ed']) ? date("Y-m-d",strtotime($_GET['ed'])) : date("Y-m-d");

        
        $date1 = new DateTime($start_date);
        $date2 = new DateTime($end_date);
        
        $days = $date2->diff($date1)->format("%a");
        $data = array();
        
        if($days < 30){
            //Date wise
            $temp = array();
            $period = new DatePeriod(
                new DateTime($start_date),
                new DateInterval('P1D'),
                new DateTime($end_date)
           );
           $_labls = array();
           foreach($period as $p){
               $_labls[] = $p->format("d-M");
           }
           $data['labels'] = $_labls;
           $data['title'] = $date1->format("d-M")." to ".$date2->format("d-M-Y");
           foreach($hid as $h){
               $this->db->where('id',$h);
               $this->db->select('name');
               $hres = $this->db->get('hms_hospitals')->row_array();
               $hname = isset($hres['name']) ? $hres['name'] : "Hospital";
               $_data = array();
               foreach($period as $d){
                    $qry = 'SELECT  @s:=@s+1 as ind, COUNT(DISTINCT a.user_id ) as count,h.name,h.id as hid FROM `hms_appoitments` a, (SELECT @s:= 0) AS s,hms_departments d,hms_branches b,hms_hospitals h where a.appoitment_date="'.$d->format("Y-m-d").'" and a.department_id=d.id and d.branch_id=b.id and b.hospital_id = h.id GROUP by h.id HAVING h.id='.$h;
                    $res = $this->db->query($qry)->row_array();
                    $_data[] = isset($res['count']) ? $res['count'] : 0;
               }
               $temp[] = array(
                   'label' => $hname,
                   'data' => $_data
               );
           }
           $data['data'] = $temp;
        }else if($days < 365){
            //Month Wise
            $temp = array();
            $period = new DatePeriod(
                new DateTime($start_date),
                new DateInterval('P1M'),
                new DateTime($end_date)
           );
           $_labls = array();
           foreach($period as $p){
               $_labls[] = $p->format("M");
           }
           $data['labels'] = $_labls;
           $data['title'] = $date1->format("M")." to ".$date2->format("M-Y");
           foreach($hid as $h){
               $this->db->where('id',$h);
               $this->db->select('name');
               $hres = $this->db->get('hms_hospitals')->row_array();
               $hname = isset($hres['name']) ? $hres['name'] : "Hospital";
               $_data = array();
               foreach($period as $d){
                    $qry = 'SELECT  @s:=@s+1 as ind, COUNT(DISTINCT a.user_id ) as count,h.name,h.id as hid FROM `hms_appoitments` a, (SELECT @s:= 0) AS s,hms_departments d,hms_branches b,hms_hospitals h where MONTH(a.appoitment_date)="'.$d->format("m").'" and a.department_id=d.id and d.branch_id=b.id and b.hospital_id = h.id GROUP by h.id HAVING h.id='.$h;
                    $res = $this->db->query($qry)->row_array();
                    $_data[] = isset($res['count']) ? $res['count'] : 0;
               }
               $temp[] = array(
                   'label' => $hname,
                   'data' => $_data
               );
           }
           $data['data'] = $temp;
        }else{
            //Year wise
            $temp = array();
            $period = new DatePeriod(
                new DateTime($start_date),
                new DateInterval('P1Y'),
                new DateTime($end_date)
           );
           $_labls = array();
           foreach($period as $p){
               $_labls[] = $p->format("Y");
           }
           $data['labels'] = $_labls;
           $data['title'] = $date1->format("Y")." to ".$date2->format("Y");
           foreach($hid as $h){
               $this->db->where('id',$h);
               $this->db->select('name');
               $hres = $this->db->get('hms_hospitals')->row_array();
               $hname = isset($hres['name']) ? $hres['name'] : "Hospital";
               $_data = array();
               foreach($period as $d){
                    $qry = 'SELECT  @s:=@s+1 as ind, COUNT(DISTINCT a.user_id ) as count,h.name,h.id as hid FROM `hms_appoitments` a, (SELECT @s:= 0) AS s,hms_departments d,hms_branches b,hms_hospitals h where YEAR(a.appoitment_date)="'.$d->format("Y").'" and a.department_id=d.id and d.branch_id=b.id and b.hospital_id = h.id GROUP by h.id HAVING h.id='.$h;
                    $res = $this->db->query($qry)->row_array();
                    $_data[] = isset($res['count']) ? $res['count'] : 0;
               }
               $temp[] = array(
                   'label' => $hname,
                   'data' => $_data
               );
           }
           $data['data'] = $temp;
        }
        return $data;
    }
	
	function getHAReport(){
        $start_date = isset($_GET['sd']) ? date("Y-m-d",strtotime($_GET['sd'])) : date('Y-m-d',(strtotime ( '-29 day' , time() ) ));
        $end_date = isset($_GET['ed']) ? date("Y-m-d",strtotime($_GET['ed'])) : date("Y-m-d");
        if($start_date != "" && $end_date != ""){
			$qry = 'SELECT  @s:=@s+1 as ind, COUNT(DISTINCT a.user_id ) as count,b.branch_name,b.id as bid FROM `hms_appoitments` a, (SELECT @s:= 0) AS s,hms_departments d,hms_branches b,hms_hospitals h where a.appoitment_date >= "'.$start_date.'" and a.appoitment_date <= "'.$end_date.'" and a.department_id=d.id and d.branch_id=b.id and b.hospital_id=h.id GROUP by b.id';
        }else if($start_date != ""){
            $qry = 'SELECT  @s:=@s+1 as ind, COUNT(DISTINCT a.user_id ) as count,b.branch_name,b.id as bid FROM `hms_appoitments` a, (SELECT @s:= 0) AS s,hms_departments d,hms_branches b,hms_hospitals h where a.appoitment_date >= "'.$start_date.'" and a.department_id=d.id and d.branch_id=b.id and b.hospital_id = h.id GROUP by b.id';
        }else if($end_date != ""){
            $qry = 'SELECT  @s:=@s+1 as ind, COUNT(DISTINCT a.user_id ) as count,b.branch_name,b.id as bid FROM `hms_appoitments` a, (SELECT @s:= 0) AS s,hms_departments d,hms_branches b,hms_hospitals h where a.appoitment_date <= "'.$end_date.'" and a.department_id=d.id and d.branch_id=b.id and b.hospital_id = h.id GROUP by b.id';
        }else{
            $qry = 'SELECT  @s:=@s+1 as ind, COUNT(DISTINCT a.user_id ) as count,b.branch_name,b.id as bid FROM `hms_appoitments` a, (SELECT @s:= 0) AS s,hms_departments d,hms_branches b,hms_hospitals h where a.department_id=d.id and d.branch_id=b.id and b.hospital_id = h.id GROUP by b.id';
        }
        return $this->db->query($qry)->result_array();
    }
	
	function getHAreportchart(){
        $bid = isset($_GET['bid']) ? explode(",",$_GET['bid']) : 0;
        $start_date = isset($_GET['sd']) ? date("Y-m-d",strtotime($_GET['sd'])) : date('Y-m-d',(strtotime ( '-29 day' , time() ) ));
        $end_date = isset($_GET['ed']) ? date("Y-m-d",strtotime($_GET['ed'])) : date("Y-m-d");

        
        $date1 = new DateTime($start_date);
        $date2 = new DateTime($end_date);
        
        $days = $date2->diff($date1)->format("%a");
        $data = array();
        
        if($days < 30){
            //Date wise
            $temp = array();
            $period = new DatePeriod(
                new DateTime($start_date),
                new DateInterval('P1D'),
                new DateTime($end_date)
           );
           $_labls = array();
           foreach($period as $p){
               $_labls[] = $p->format("d-M");
           }
           $data['labels'] = $_labls;
           $data['title'] = $date1->format("d-M")." to ".$date2->format("d-M-Y");
           foreach($bid as $b){
               $this->db->where('id',$b);
               $this->db->select('branch_name');
               $bres = $this->db->get('hms_branches')->row_array();
               $bname = isset($bres['branch_name']) ? $bres['branch_name'] : "Branch";
               $_data = array();
               foreach($period as $d){
                    $qry = 'SELECT  @s:=@s+1 as ind, COUNT(DISTINCT a.user_id ) as count,b.branch_name,b.id as bid FROM `hms_appoitments` a, (SELECT @s:= 0) AS s,hms_departments d,hms_branches b,hms_hospitals h where a.appoitment_date="'.$d->format("Y-m-d").'" and a.department_id=d.id and d.branch_id=b.id and b.hospital_id = h.id GROUP by b.id HAVING b.id='.$b;
                    $res = $this->db->query($qry)->row_array();
                    $_data[] = isset($res['count']) ? $res['count'] : 0;
               }
               $temp[] = array(
                   'label' => $bname,
                   'data' => $_data
               );
           }
           $data['data'] = $temp;
        }else if($days < 365){
            //Month Wise
            $temp = array();
            $period = new DatePeriod(
                new DateTime($start_date),
                new DateInterval('P1M'),
                new DateTime($end_date)
           );
           $_labls = array();
           foreach($period as $p){
               $_labls[] = $p->format("M");
           }
           $data['labels'] = $_labls;
           $data['title'] = $date1->format("M")." to ".$date2->format("M-Y");
           foreach($bid as $b){
               $this->db->where('id',$b);
               $this->db->select('branch_name');
               $bres = $this->db->get('hms_branches')->row_array();
               $bname = isset($bres['branch_name']) ? $hres['branch_name'] : "Branch";
               $_data = array();
               foreach($period as $d){
                    $qry = 'SELECT  @s:=@s+1 as ind, COUNT(DISTINCT a.user_id ) as count,b.branch_name,b.id as bid FROM `hms_appoitments` a, (SELECT @s:= 0) AS s,hms_departments d,hms_branches b,hms_hospitals h where MONTH(a.appoitment_date)="'.$d->format("m").'" and a.department_id=d.id and d.branch_id=b.id and b.hospital_id = h.id GROUP by b.id HAVING b.id='.$b;
                    $res = $this->db->query($qry)->row_array();
                    $_data[] = isset($res['count']) ? $res['count'] : 0;
               }
               $temp[] = array(
                   'label' => $bname,
                   'data' => $_data
               );
           }
           $data['data'] = $temp;
        }else{
            //Year wise
            $temp = array();
            $period = new DatePeriod(
                new DateTime($start_date),
                new DateInterval('P1Y'),
                new DateTime($end_date)
           );
           $_labls = array();
           foreach($period as $p){
               $_labls[] = $p->format("Y");
           }
           $data['labels'] = $_labls;
           $data['title'] = $date1->format("Y")." to ".$date2->format("Y");
           foreach($bid as $b){
               $this->db->where('id',$b);
               $this->db->select('branch_name');
               $bres = $this->db->get('hms_branches')->row_array();
               $bname = isset($hres['branch_name']) ? $hres['branch_name'] : "Branch";
               $_data = array();
               foreach($period as $d){
                    $qry = 'SELECT  @s:=@s+1 as ind, COUNT(DISTINCT a.user_id ) as count,b.branch_name,b.id as bid FROM `hms_appoitments` a, (SELECT @s:= 0) AS s,hms_departments d,hms_branches b,hms_hospitals h where YEAR(a.appoitment_date)="'.$d->format("Y").'" and a.department_id=d.id and d.branch_id=b.id and b.hospital_id = h.id GROUP by b.id HAVING b.id='.$b;
                    $res = $this->db->query($qry)->row_array();
                    $_data[] = isset($res['count']) ? $res['count'] : 0;
               }
               $temp[] = array(
                   'label' => $bname,
                   'data' => $_data
               );
           }
           $data['data'] = $temp;
        }
        return $data;
    }
    
    public function updateMedOrder($id,$item){
        $this->db->where('id',$id);
        $this->db->update('hms_prescription_item',$item);
		
    }

    public function placeMedOrder($pric_id,$med_id){
        $this->db->where('id',$pric_id);
        $this->db->update('hms_prescription',array('store_id'=>$med_id));
    }

    public function prescriptionByApp_id($app_id){
        

         $query = $this->db->query("select * from hms_prescription where appoitment_id = $app_id");
          $pres_query =  $query->result_array();
         $pres_ids = array();
         foreach ($pres_query as $row) {
             $pres_ids[] = $row['id'];
         }
          return $pres_ids;
    }
    public function getHospitalnameBybedId($userId){

        $query = $this->db->query("select hms_inpatient.bed_id, hms_beds.ward_id,hms_wards.department_id,hms_departments.branch_id,hms_branches.hospital_id, hms_hospitals.name from hms_inpatient,hms_beds,hms_wards,hms_departments,hms_branches,hms_hospitals where hms_inpatient.user_id = $userId and hms_inpatient.bed_id = hms_beds.id and hms_beds.ward_id = hms_wards.id and hms_departments.id = hms_wards.department_id AND hms_departments.branch_id = hms_branches.id AND hms_hospitals.id = hms_branches.hospital_id");
        return $query->row_array();


    }

    public function canOutPrescptionOrder($id){
         $data = array(
             'order_status'=> 3
            ); 
        $this->db->where('id', $id);
       if ($this->db->update('hms_prescription', $data)) {
           return true;
       }
        
    }

    public function addplaceorder($id){

       $query = $this->db->query("select hms_users.first_name,hms_users.last_name,hms_doctors.user_id,hms_prescription.* from hms_prescription,hms_doctors,hms_users where hms_prescription.id = $id and hms_doctors.id = hms_prescription.doctor_id and hms_doctors.user_id = hms_users.id");
       return $query->result_array();
    }

    public function Updateitemquantity(){
        $id = $_REQUEST['id'];
        $data = array(

            'qty' => $_REQUEST['quantity']

            );
        $item = $this->auth->my_encrypt_array($data,$p = 0);
        $this->db->where('id', $id);
           if ($this->db->update('hms_prescription_item', $item)) {
               return true;
           }        
    }

    public function getPatientIdFromDoctorId($doc_id = 0){
        $p = array();
        if(is_array($doc_id)){
            if(count($doc_id) == 0){ $doc_id[] = -1; }
            $dids = implode(",",$doc_id);
            $p = $this->db->query("select DISTINCT user_id as pid from hms_appoitments where isDeleted=0 and doctor_id in (".$dids.")")->result_array();
        }else{
            $p = $this->db->query("select DISTINCT user_id as pid from hms_appoitments where isDeleted=0 and doctor_id=".$doc_id)->result_array();
        }
        $pids = array();
        foreach($p as $_p){
            $pids[] = $_p['pid'];
        }
        return $pids;
    }
}