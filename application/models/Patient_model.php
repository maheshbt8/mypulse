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
            //sent notification to patient
            $this->notification->saveNotification($id,"Your health information is updated");
        }else{
            $hr['user_id'] = $id;
            $this->db->insert($this->healthTbl,$hr);
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
        return $this->db->query('SELECT  @s:=@s+1 as ind, COUNT(DISTINCT a.user_id ) as count,h.name FROM `hms_appoitments` a, (SELECT @s:= 0) AS s,hms_departments d,hms_branches b,hms_hospitals h where a.department_id=d.id and d.branch_id=b.id and b.hospital_id = h.id GROUP by h.id')->result_array();
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

}