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
        }else{
            $hr['user_id'] = $id;
            $this->db->insert($this->healthTbl,$hr);
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
}