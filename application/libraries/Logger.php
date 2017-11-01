<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logger
{
	const Hospital = "Hospital";
	const Department = "Department";
	const Appointment = "Appointment";
	const Bed = "Bed";
    const Branch = "Branch";
	const Charge = "Charge";
	const Doctor = "Doctor";
	const Availability = "Availability";
	const Prescription = "Prescription";
	const Inpatient = "Inpatient";
	const Medicalreport = "Medicalreport";
	const Prescription_items = "Prescription_items";
	const HealthInsuranceProvider = "HealthInsuranceProvider";
	const HospitalAdmin = "HospitalAdmin";
	const License = "License";
	const MedicalLab = "MedicalLab";
	const MedicalStore = "MedicalStore";
	const Nurse = "Nurse";
	const Patient = "Patient";
	const Receptionist = "Receptionist";
	const TestReport = "TestReport";
	const User = "User";
	const Ward = "Ward";
	const RecommnedDate = "RecommnedDate";

    public function __construct()
    {
        //Load library
        $this->CI =& get_instance();
    }

    public function log($description='',$type=null,$id=null){
        $log['description'] = $description;
        $log['item_type'] = $type;
        $log['item_id'] = $id;
        $log['user_id'] = $this->CI->auth->getUserid();
        $log['user_name'] = $this->CI->auth->getUsername();
        $log['created_at'] = date("Y-m-d H:i:s");
        $this->CI->db->insert('hms_activitylog',$log);
    }
}
