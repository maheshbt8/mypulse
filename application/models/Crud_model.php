<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
   
class Crud_model extends CI_Model {

    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
    }

    function clear_cache() {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    } 
      
    function get_type_name_by_id($type, $type_id = '', $field = 'name') {
        $this->db->where($type . '_id', $type_id);
        $query = $this->db->get($type);    
        $result = $query->result_array();
        foreach ($result as $row)
            return $row[$field];
        //return	$this->db->get_where($type,array($type.'_id'=>$type_id))->row()->$field;	
    }
function email_verification($task="",$id="")
    {
    $is_email=$this->db->get_where($task, array('unique_id' => $id))->row();
    $created_at=$is_email->created_at;
    $past_time = strtotime($is_email->modified_at);
    $current_time = time();
    $difference = $current_time - $past_time;
    $difference_minute =  $difference/60;
    
    if(intval($difference_minute)<30){
            if($is_email->is_email==2){
            $yes=$this->db->where('unique_id',$id)->update($task,array('is_email' =>1));
        if($task != 'users')
        {
        if($yes){
        redirect(base_url() . 'login/set_password/'.$task.'/'.$id, 'refresh');
        }
        }else{
            echo "YOUR Email Verified Successfully"."<br/>";
            echo "<a href='".base_url()."'>Go To Home</a>";
        }
        }else{
            echo "YOU Already Verified Your Email"."<br/>";
            echo "<a href='".base_url()."'>Go To Home</a>";
        }
        }else{
            echo "Your Link Was Expired"."<br/>";
            echo "<a href='".base_url()."'>Go To Home</a>";
        }
    }
    function reset_password($task="",$id="")
    {
    $user_data=$this->db->get_where($task, array('unique_id' => $id))->row();
    $past_time = strtotime($this->session->userdata('password_time'));
    $current_time = time();
    $difference = $current_time - $past_time;
    $difference_minute =  $difference/60;
    if(intval($difference_minute)<30){
        redirect(base_url() . 'login/set_password/'.$task.'/'.$id, 'refresh');
        }else{
            echo "Your Link Was Expired"."<br/>";
            echo "<a href='".base_url()."'>Go To Home</a>";
        }
    }

/*
    function email_verification($task="",$id="")
    {
        if($task == 'hospitaladmins'){
    
    $is_email=$this->db->get_where('hospitaladmins', array('admin_id' => $id))->row();
    $past_time = strtotime($is_email->created_at);
    $current_time = time();
    $difference = $current_time - $past_time;
    $difference_minute =  $difference/60;
    
    if(intval($difference_minute)<30){
            if($is_email->is_email==2){
            $yes=$this->db->where('admin_id',$id)->update('hospitaladmins',array('is_email' =>1));
            if($yes){
            redirect(base_url() . 'index.php?login/set_password/hospitaladmins/'.$id, 'refresh');
        }
        }else{
            echo "YOU Already Verified Your Email"."<br/>";
            echo "<a href='".base_url()."'>Go To Home</a>";
        }
        }else{
            echo "Your Link Was Expired"."<br/>";
            echo "<a href='".base_url()."'>Go To Home</a>";
        }
        }
        if($task == 'doctors'){

            $is_email=$this->db->get_where('doctors', array('doctor_id' => $id))->row()->is_email;
            if($is_email->is_email==2){
            $yes=$this->db->where('doctor_id',$id)->update('doctors',array('is_email' =>1));
               if($yes){
            redirect(base_url() . 'index.php?login/set_password/doctors/'.$id);
        }
        }else{
            echo "YOU Already Verified Your Email"."<br/>";
            echo "<a href='".base_url()."'>Go To Home</a>";
        }
        }
        if($task == 'nurse'){
           $is_email=$this->db->get_where('nurse', array('nurse_id' => $id))->row()->is_email;
            if($is_email->is_email==2){
            $yes=$this->db->where('nurse_id',$id)->update('nurse',array('is_email' =>1));
               if($yes){
            redirect(base_url() . 'index.php?login/set_password/nurse/'.$id, 'refresh');
        }
        }else{
            echo "YOU Already Verified Your Email"."<br/>";
            echo "<a href='".base_url()."'>Go To Home</a>";
        }
        
        }
        if($task == 'receptionist'){
           $is_email=$this->db->get_where('receptionist', array('receptionist_id' => $id))->row()->is_email;
            if($is_email->is_email==2){
            $yes=$this->db->where('receptionist_id',$id)->update('receptionist',array('is_email' =>1));
               if($yes){
            redirect(base_url() . 'index.php?login/set_password/receptionist/'.$id, 'refresh');
        }
        }else{
            echo "YOU Already Verified Your Email"."<br/>";
            echo "<a href='".base_url()."'>Go To Home</a>";
        }
        
        }
        if($task == 'medicalstores'){
           $is_email=$this->db->get_where('medicalstores', array('store_id' => $id))->row()->is_email;
            if($is_email->is_email==2){
            $yes=$this->db->where('store_id',$id)->update('medicalstores',array('is_email' =>1));
               if($yes){
            redirect(base_url() . 'index.php?login/set_password/medicalstores/'.$id, 'refresh');
        }
        }else{
            echo "YOU Already Verified Your Email"."<br/>";
            echo "<a href='".base_url()."'>Go To Home</a>";
        }
        
        }
        if($task == 'medicallabs'){
           $is_email=$this->db->get_where('medicallabs', array('lab_id' => $id))->row()->is_email;
            if($is_email->is_email==2){
            $yes=$this->db->where('lab_id',$id)->update('medicallabs',array('is_email' =>1));
               if($yes){
            redirect(base_url() . 'index.php?login/set_password/medicallabs/'.$id, 'refresh');
        }
        }else{
            echo "YOU Already Verified Your Email"."<br/>";
            echo "<a href='".base_url()."'>Go To Home</a>";
        }
        
        }
        if($task == 'users'){
           $is_email=$this->db->get_where('users', array('user_id' => $id))->row()->is_email;
            if($is_email->is_email==2){
            $yes=$this->db->where('user_id',$id)->update('users',array('is_email' =>1));
               if($yes){
            redirect(base_url() . 'index.php?login/set_password/users/'.$id, 'refresh');
        }
        }else{
            echo "YOU Already Verified Your Email"."<br/>";
            echo "<a href='".base_url()."'>Go To Home</a>";
        }
        
        }
    }*/
    // Create a new invoice.
    function create_invoice() 
    {
        $data['title']              = $this->input->post('title');
        $data['invoice_number']     = $this->input->post('invoice_number');
        $data['patient_id']         = $this->input->post('patient_id');
        $data['creation_timestamp'] = $this->input->post('creation_timestamp');
        $data['due_timestamp']      = $this->input->post('due_timestamp');
        $data['vat_percentage']     = $this->input->post('vat_percentage');
        $data['discount_amount']    = $this->input->post('discount_amount');
       $data['status']             = $this->input->post('status');

        $invoice_entries            = array();
        $descriptions               = $this->input->post('entry_description');
        $amounts                    = $this->input->post('entry_amount');
        $number_of_entries          = sizeof($descriptions);
        
             
        for ($i = 0; $i < $number_of_entries; $i++)
        {
            if ($descriptions[$i] != "" && $amounts[$i] != "")
            {
                $new_entry          = array('description' => $descriptions[$i], 'amount' => $amounts[$i]);
                array_push($invoice_entries, $new_entry);
            }
        }
        $data['invoice_entries']    = json_encode($invoice_entries);
       // echo $data['invoice_entries'];die();
        
        
        $invoice_entries    = json_decode($data['invoice_entries']);
      //  print_r($invoice_entries);die();
                $i = 1;
                foreach ($invoice_entries as $invoice_entry)
                {
                    $total_amount += $invoice_entry->amount; 
                       $i++;
                 }
                 $vat=$this->input->post('vat_percentage');
                 $gst=$this->db->where(array('type' => 'GST'))->get('settings')->row()->description;
                 $dis=$this->input->post('discount_amount');
                 $total_amount;
                   $vat= ( $total_amount* $vat)/ 100;
                   $gst1= ( $total_amount* $gst)/ 100;
                   $amout=$total_amount+$vat+ $gst1;
                  $grand_total=$amout- $dis; 
                 $data['grand_total']    = $grand_total;
                // print_r($data);die();
        $this->db->insert('invoice', $data);
        
    }
    function create_payment() 
    {
        $data['invoice_number']              = $this->input->post   ('invoice_number');
        $data['total_amount']              = $this->input->post('total_amount');
          $data['amount']              = $this->input->post('amount');
            $data['timestamp']              = $this->input->post('timestamp');
             //$data['status']              = $this->input->post('status');
      
                $dis=$this->input->post('total_amount');
                 $amount=$this->input->post('amount');
                 $pending=$dis-$amount;
                   
                 $data['pending_amount']    = $pending;
                //print_r($data);die();

        $this->db->insert('payments', $data);
    }

    function create_expense() 
    {
        $data['expense']              = $this->input->post('expense');
      

        $this->db->insert('expenses', $data);
    }



    function create_expenses() 
    {
        $data['expense']              = $this->input->post('expense');
          $data['amount']              = $this->input->post('amount');
            $data['date']              = $this->input->post('creation_timestamp');
             $data['status']              = $this->input->post('status');
      
      

        $this->db->insert('add_expense', $data);
    }
    
    function select_invoice_info()
    {
        return $this->db->get('invoice')->result_array();
    }
    function select_expense_info()
    {
        return $this->db->get('add_expense')->result_array();
    }
    
    function select_invoice_info_by_patient_id()
    {
        $patient_id = $this->session->userdata('login_user_id');
        return $this->db->get_where('invoice', array('patient_id' => $patient_id))->result_array();
    }



    function update_expense($id)
    {
        $data['expense']              = $this->input->post('expense');
        $data['amount']     = $this->input->post('amount');
        //$data['patient_id']         = $this->input->post('patient_id');
        $data['date'] = $this->input->post('creation_timestamp');
      
        $data['status']             = $this->input->post('status');

      
       
      //  $number_of_entries          = sizeof($descriptions);
        
       

        $this->db->where('id', $id);
        $this->db->update('add_expense', $data);
    }

    function delete_invoice($invoice_id)
    {
        $this->db->where('invoice_id', $invoice_id);
        $this->db->delete('invoice');
    }

    function calculate_invoice_total_amount($expense)
    {
        //echo $expense;die();
        $total_amount           = 0;
        $invoice                = $this->db->get_where('add_expense', array('expense' => $expense))->result_array();
       
        foreach ($invoice as $row)
        {
            
          //print_r($row);die();
                $total_amount  += $row['amount'];
            
          
            $gst                = $total_amount * $this->db->where(array('type' => 'GST'))->get('settings')->row()->description/ 100;
            $grand_total        = $total_amount +$gst ;
            //print_r($grand_total);die();
        }

        return $grand_total;
        
    }

  

    //////system settings//////
    function update_system_settings() {
        $data['description'] = $this->input->post('system_name');
        $this->db->where('type', 'system_name');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('system_title');
        $this->db->where('type', 'system_title');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('address');
        $this->db->where('type', 'address');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('phone');
        $this->db->where('type', 'phone');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('paypal_email');
        $this->db->where('type', 'paypal_email');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('currency');
        $this->db->where('type', 'currency');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('system_email');
        $this->db->where('type', 'system_email');
        $this->db->update('settings', $data);

         $data['description'] = $this->input->post('gst');
        $this->db->where('type', 'GST');
        $this->db->update('settings', $data);

        /*$data['description'] = $this->input->post('buyer');
        $this->db->where('type', 'buyer');
        $this->db->update('settings', $data);*/

        $data['description'] = $this->input->post('system_name');
        $this->db->where('type', 'system_name');
        $this->db->update('settings', $data);

        /*$data['description'] = $this->input->post('purchase_code');
        $this->db->where('type', 'purchase_code');
        $this->db->update('settings', $data);*/

        $data['description'] = $this->input->post('language');
        $this->db->where('type', 'language');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('text_align');
        $this->db->where('type', 'text_align');
        $this->db->update('settings', $data);
    }
    
    // SMS settings.
    function update_sms_settings() {
        
        $data['description'] = $this->input->post('clickatell_user');
        $this->db->where('type', 'clickatell_user');
        $this->db->update('settings', $data);
        
        $data['description'] = $this->input->post('clickatell_password');
        $this->db->where('type', 'clickatell_password');
        $this->db->update('settings', $data);
        
        $data['description'] = $this->input->post('clickatell_api_id');
        $this->db->where('type', 'clickatell_api_id');
        $this->db->update('settings', $data);
    }

    /////creates log/////
    function create_log($data) {
        $data['timestamp'] = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));
        $data['ip'] = $_SERVER["REMOTE_ADDR"];
        $location = new SimpleXMLElement(file_get_contents('http://freegeoip.net/xml/' . $_SERVER["REMOTE_ADDR"]));
        $data['location'] = $location->City . ' , ' . $location->CountryName;
        $this->db->insert('log', $data);
    }

    ////////BACKUP RESTORE/////////
    function create_backup($type) {
        $this->load->dbutil();


        $options = array(
            'format' => 'txt', // gzip, zip, txt
            'add_drop' => TRUE, // Whether to add DROP TABLE statements to backup file
            'add_insert' => TRUE, // Whether to add INSERT data to backup file
            'newline' => "\n"               // Newline character used in backup file
        );


        if ($type == 'all') {
            $tables = array('');
            $file_name = 'system_backup';
        } else {
            $tables = array('tables' => array($type));
            $file_name = 'backup_' . $type;
        }

        $backup = & $this->dbutil->backup(array_merge($options, $tables));


        $this->load->helper('download');
        force_download($file_name . '.sql', $backup);
    }

    /////////RESTORE TOTAL DB/ DB TABLE FROM UPLOADED BACKUP SQL FILE//////////
    function restore_backup() {
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/backup.sql');
        $this->load->dbutil();


        $prefs = array(
            'filepath' => 'uploads/backup.sql',
            'delete_after_upload' => TRUE,
            'delimiter' => ';'
        );
        $restore = & $this->dbutil->restore($prefs);
        unlink($prefs['filepath']);
    }

    /////////DELETE DATA FROM TABLES///////////////
    function truncate($type) {
        if ($type == 'all') {
            $this->db->truncate('student');
            $this->db->truncate('mark');
            $this->db->truncate('teacher');
            $this->db->truncate('subject');
            $this->db->truncate('class');
            $this->db->truncate('exam');
            $this->db->truncate('grade');
        } else {
            $this->db->truncate($type);
        }
    }

    ////////IMAGE URL//////////
    function get_image_url($type = '', $id = '') {
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else
            $image_url = base_url() . 'uploads/user.jpg';

        return $image_url;
    }
    
    /************GENERAL SETTINGS***********/
    function delete_specialization($specialization)
    {
        $this->db->where('specializations_id',$specialization);
        $this->db->delete('specializations');
    }
     function save_specialization_info()
    {
        $data['name']       = $this->input->post('name');
        
        $this->db->insert('specializations',$data);
    }
   
     function save_language_info()
    {
        $data['name']       = $this->input->post('name');
        
        $this->db->insert('language',$data);
    }
     function delete_language($language)
    {
        $this->db->where('language_id',$language);
        $this->db->delete('language');
    }
      function save_country_info()
    {
        $data['name'] 		= $this->input->post('name');
        
        $this->db->insert('country',$data);
    }
   
    function update_country_info($country_id)
    {
        $data['name'] 		= $this->input->post('name');
        
        $this->db->where('country_id',$country_id);
        $this->db->update('country',$data);
    }
      function save_state_info()
    {
        
       
        $data['name'] 		= $this->input->post('name');
        $data['country_id'] 		= $this->input->post('country_id');
        
        $this->db->insert('state',$data);
    }
   
    function update_state_info($state_id)
    {
        $data['name'] 		= $this->input->post('name');
        $data['country_id'] 		= $this->input->post('country_id');
        
        $this->db->where('state_id',$state_id);
        $this->db->update('state',$data);
    }
     function save_district_info()
    {
        $data['name'] 		= $this->input->post('name');
        $data['country_id'] 		= $this->input->post('country_id');
        $data['state_id'] 		= $this->input->post('state_id');
        
        $this->db->insert('district',$data);
    }
   
    function update_district_info($district_id)
    {
        $data['name'] 		= $this->input->post('name');
        $data['country_id'] 		= $this->input->post('country_id');
        $data['state_id'] 		= $this->input->post('state_id');
        
        $this->db->where('district_id',$district_id);
        $this->db->update('district',$data);
    }
     function save_city_info()
    {
        $data['name'] 		= $this->input->post('name');
        $data['country_id'] 		= $this->input->post('country_id');
        $data['state_id'] 		= $this->input->post('state_id');
        $data['district_id'] 		= $this->input->post('district_id');
        
        $this->db->insert('city',$data);
    }
   
    function update_city_info($city_id)
    {
        $data['name'] 		= $this->input->post('name');
        $data['country_id'] 		= $this->input->post('country_id');
        $data['state_id'] 		= $this->input->post('state_id');
        $data['district_id'] 		= $this->input->post('district_id');
        
        $this->db->where('city_id',$city_id);
        $this->db->update('city',$data);
    }
    function save_license_info()
    {
        $data['name'] 		= $this->input->post('name');
        $data['description']       = $this->input->post('description');
        $data['license_code'] 		= $this->input->post('license_code');
        
        $this->db->insert('license',$data);
    }
    function delete_license($license_id)
    {
        $this->db->where('license_id',$license_id);
        $this->db->delete('license');
    }
    function update_license_info($license_id)
    {
        $data['name'] 		= $this->input->post('name');
        $data['description']       = $this->input->post('description');
        $data['license_code'] 		= $this->input->post('license_code');
        
        $this->db->where('license_id',$license_id);
        $this->db->update('license',$data);
    }
      function save_health_insurance_provider_info()
    {
        $data['name'] 		= $this->input->post('name'); 
        $this->db->insert('health_insurance_provider',$data);
    }
    function delete_health_insurance_provider($health_insurance_provider_id)
    {
        $this->db->where('health_insurance_provider_id',$health_insurance_provider_id);
        $this->db->delete('health_insurance_provider');
    }
   /* function select_profile_update($id)
    {
        if($account_type == 'superadmin'){
        return $this->db->get_where('superadmin', array('superadmin_id' => $this->session->userdata('login_user_id')))->result_array();
        }
    }*/
    /***************HOSPITALS*****************/
    
         function save_hospital_info()
    {
        $data['name'] 		= $this->input->post('name');
        $data['description']    = $this->input->post('description');
        $data['address']    = $this->input->post('address');
        $data['phone_number']    = $this->input->post('phone_number');
        $data['email']    = $this->input->post('email');
        $data['country']    = $this->input->post('country');
        $data['state']    = $this->input->post('state');
        $data['district']    = $this->input->post('district');
        $data['city']    = $this->input->post('city');
        $data['md_name']    = $this->input->post('md_name');   
        $data['md_contact_number']    = $this->input->post('md_phone');
        /*
        if($this->input->post('status') != null){*/
                  $data['status']       = $this->input->post('status');
           /*}else{
            $data['status']    = 2;
        }*/

        $data['license']    = $this->input->post('license');
        $data['license_status']    = $this->input->post('license_status');   
        $data['from_date']    = $this->input->post('from_date');
        $data['till_date']    = $this->input->post('till_date');
        
        $insert=$this->db->insert('hospitals',$data);
        if($insert)
        {
            
            $lid=$this->db->insert_id();
            $num=100000+$lid;
            /*$a="12345678901234567890";
            $sid=str_shuffle($a);
            $uid=substr($sid, 14);*/
            $pid='MPH'.date('y').'_'.$num;
            $this->db->where('hospital_id',$lid)->update('hospitals',array('unique_id'=>$pid));
            
        }

    }
    function select_hospital_info()
    {
        $account_type=$this->session->userdata('login_type');
        if($account_type=='superadmin'){
        $hospi=$this->db->get('hospitals')->result_array();
        }elseif($account_type == 'users'){
        $hospital=$this->db->where('user_id',$this->session->userdata('login_user_id'))->get('patient')->row()->hospital_ids;
        if($hospital>0){
        $hospital_ids=explode(',',$hospital);
        if($hospital_ids != ''){
        for($i=0;$i<count($hospital_ids);$i++){
            $hospi[$i]=$this->db->where('hospital_id',$hospital_ids[$i])->get('hospitals')->row_array();
            }
        }
        }
        }
        
        return $hospi;
    }   
    
   
    function update_hospital_info($hospital_id)
    {
        $data['name'] 		= $this->input->post('name');
        $data['description']    = $this->input->post('description');
        $data['address']    = $this->input->post('address');
        $data['phone_number']    = $this->input->post('phone_number');
        $data['email']    = $this->input->post('email');
        $data['country']    = $this->input->post('country');
        $data['state']    = $this->input->post('state');
        $data['district']    = $this->input->post('district');
        $data['city']    = $this->input->post('city');
        $data['md_name']    = $this->input->post('md_name');   
        $data['md_contact_number']    = $this->input->post('md_phone');
        $data['status']    = $this->input->post('status');
         $data['license']    = $this->input->post('license');
        $data['license_status']    = $this->input->post('license_status');   
        $data['from_date']    = $this->input->post('from_date');
        $data['till_date']    = $this->input->post('till_date');
        $this->db->where('hospital_id',$hospital_id);
        $this->db->update('hospitals',$data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/hospitallogs/'. $hospital_id.  '.png');
    }
    
    function delete_hospital_info($hospital_id)
    {
        $this->db->where('hospital_id',$hospital_id);
        $yes=$this->db->delete('hospitals');
    }
    function delete_patient_hospital($hospital_id)
    {
$hospital_ids=explode(',',$this->db->get_where('patient',array('user_id'=>$this->session->userdata('login_user_id')))->row()->hospital_ids);
for($h=0;$h<count($hospital_ids);$h++){
    if($hospital_ids[$h]!=$hospital_id){
        $hospi[]=$hospital_ids[$h];
    }
}
$this->db->where('user_id',$this->session->userdata('login_user_id'));
$yes=$this->db->update('patient',array('hospital_ids'=>implode(',',$hospi)));
    }
    
    function delete_multiple_hospital_info()
    {
        $check=$_POST['check'];
        for($i=0;$i<count($check);$i++){
            $this->db->where('hospital_id',$check[$i]);
            $this->db->delete('hospitals');
        }
    }
    
      function save_medicalstores_info()
    {
          $data['name'] 		= $this->input->post('name');
          $data['description'] 		= $this->input->post('description');
            $data['address'] 		= $this->input->post('address');
        $data['phone']    = $this->input->post('phone_number');
        $data['owner_name']    = $this->input->post('owner_name');   
        $data['owner_mobile']    = $this->input->post('owner_mobile');
       $data['password']=sha1('mypulse');
        $data['hospital']    = $this->input->post('hospital');
        $data['status']    = $this->input->post('status');
        $data['branch']    = $this->input->post('branch');
        $data['fname']    = $this->input->post('fname');
        $data['lname']    = $this->input->post('lname');
        $data['email']    = $this->input->post('email');  
        $data['aadhar']    = $this->input->post('aadhar');
          $data['gender']    = $this->input->post('gender');
            $data['dob']    = $this->input->post('dob');
             $data['in_address']    = $this->input->post('in_address');
           $data['country']    = $this->input->post('country');
        $data['state']    = $this->input->post('state');
        $data['district']    = $this->input->post('district');  
        $data['city']    = $this->input->post('city');
            $data['experience']    = $this->input->post('experience');
             $data['qualification']    = $this->input->post('qualification');
            $data['created_at']=date('Y-m-d H:i:s');
        $data['modified_at']=date('Y-m-d H:i:s');
        
       $insert=$this->db->insert('medicalstores',$data); 
        if($insert)
        {
            $lid=$this->db->insert_id();
            $num=100000+$lid;
            $pid='MPS'.date('y').'_'.$num;
            $this->db->where('store_id',$lid)->update('medicalstores',array('unique_id'=>$pid,'modified_at'=>date('Y-m-d H:i:s')));
        }
           $id=$this->db->insert_id();
           
           move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/medical_stores/'. $id.  '.jpg');
       
    }
    
    
      function update_medicalstores_info($patient_id)
    {
          $data['name'] 		= $this->input->post('name');
          $data['description'] 		= $this->input->post('description');
            $data['address'] 		= $this->input->post('address');
        $data['phone']    = $this->input->post('phone_number');
        $data['owner_name']    = $this->input->post('owner_name');   
        $data['owner_mobile']    = $this->input->post('owner_mobile');
       
        $data['hospital']    = $this->input->post('hospital');
       // $data['status']    = $this->input->post('status');
        $data['branch']    = $this->input->post('branch');
        $data['fname']    = $this->input->post('fname');
        $data['lname']    = $this->input->post('lname');
        $data['email']    = $this->input->post('email');  
        $data['aadhar']    = $this->input->post('aadhar');
          $data['gender']    = $this->input->post('gender');
            $data['dob']    = $this->input->post('dob');
             $data['in_address']    = $this->input->post('in_address');
            $data['country']    = $this->input->post('country');
        $data['state']    = $this->input->post('state');
        $data['district']    = $this->input->post('district');  
        $data['city']    = $this->input->post('city');
            $data['experience']    = $this->input->post('experience');
             $data['qualification']    = $this->input->post('qualification');
             $data['modified_at']=date('Y-m-d H:i:s');
            // print_r($data);
            // die;
        
           $this->db->where('store_id',$patient_id);
        $query= $this->db->update('medicalstores',$data);
       if($query)
       {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/medical_stores/'. $patient_id.  '.jpg');
           
       }
    }
    
    
      function update_medicallabs_info($id)
    {
          $data['name'] 		= $this->input->post('name');
          $data['description'] 		= $this->input->post('description');
            $data['address'] 		= $this->input->post('address');
        $data['phone']    = $this->input->post('phone_number');
        $data['owner_name']    = $this->input->post('owner_name');   
        $data['owner_mobile']    = $this->input->post('owner_mobile');
         $data['country']    = $this->input->post('country');
        $data['state']    = $this->input->post('state');
        $data['district']    = $this->input->post('district');  
        $data['city']    = $this->input->post('city');
        $data['hospital']    = $this->input->post('hospital');
       $data['status']    = $this->input->post('status');
        $data['branch']    = $this->input->post('branch');
        $data['fname']    = $this->input->post('fname');
        $data['lname']    = $this->input->post('lname');
        $data['email']    = $this->input->post('email');  
        $data['aadhar']    = $this->input->post('aadhar');
          $data['gender']    = $this->input->post('gender');
            $data['dob']    = $this->input->post('dob');
             $data['in_address']    = $this->input->post('in_address');
         /* $data['profession']    = $this->input->post('profession');*/
            $data['experience']    = $this->input->post('experience');
             $data['qualification']    = $this->input->post('qualification');
             $data['modified_at']=date('Y-m-d H:i:s');
            // print_r($data);
            // die;
        
           $this->db->where('lab_id',$id);
        $query= $this->db->update('medicallabs',$data);
       if($query)
       {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/medical_labs/'. $patient_id.  '.jpg');
           
       }
    }
    
    
    
         function save_hospitaladmins_info()
    {
        $data['name'] 		= $this->input->post('fname');
        $data['mname'] 		= $this->input->post('mname');
        $data['lname'] 		= $this->input->post('lname');
        $data['description']    = $this->input->post('description');
        $data['email']    = $this->input->post('email');   
        $data['phone']    = $this->input->post('phone_number');
        $data['password']=sha1('mypulse');
        $data['hospital_id']    = $this->input->post('hospital');
        $data['status']    = $this->input->post('status');
        $data['gender']    = $this->input->post('gender');
        $data['dob']    = $this->input->post('dob');
        $data['aadhar']    = $this->input->post('aadhar');
        $data['address']    = $this->input->post('address');  
        $data['qualification']    = $this->input->post('qualification');
        $data['profession']    = $this->input->post('profession');
        $data['experience']    = $this->input->post('experience');
        $data['created_at']=date('Y-m-d H:i:s');
        $data['modified_at']=date('Y-m-d H:i:s');
          
       $insert=$this->db->insert('hospitaladmins',$data);
       if($insert)
        {
            
            $lid=$this->db->insert_id();
            $num=100000+$lid;
            $pid='MPHA'.date('y').'_'.$num;
            $this->db->where('admin_id',$lid)->update('hospitaladmins',array('unique_id'=>$pid,'modified_at'=>date('Y-m-d H:i:s')));
            
        }
           $id=$this->db->insert_id();
           
           move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/hospitaladmin_image/'. $id.  '.jpg');
       
    }
    
    function select_hospitaladmins_info()
    {
        return $this->db->get('hospitaladmins')->result_array();
    }
    
   
    function update_hospitaladmins_info($admin_id)
    {
             $data['name'] 		= $this->input->post('fname');
             $data['mname'] 		= $this->input->post('mname');
             $data['lname'] 		= $this->input->post('lname');
             $data['description']    = $this->input->post('description');
             $data['email']    = $this->input->post('email');   
             $data['phone']    = $this->input->post('mobile');
             $data['hospital_id']    = $this->input->post('hospital');
             $data['status']    = $this->input->post('status');
             $data['gender']    = $this->input->post('gender');
             $data['dob']    = $this->input->post('dob');
             $data['aadhar']    = $this->input->post('aadhar');  
             $data['address']    = $this->input->post('address');
             $data['country']    = $this->input->post('country');
             $data['state']    = $this->input->post('state');
             $data['district']    = $this->input->post('district');
             $data['city']    = $this->input->post('city');  
             $data['qualification']    = $this->input->post('qualification');
             $data['profession']    = $this->input->post('profession');
             $data['experience']    = $this->input->post('experience');
             $data['modified_at']=date('Y-m-d H:i:s');
        $this->db->where('admin_id',$admin_id);
        $query= $this->db->update('hospitaladmins',$data);
       if($query)
       {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/hospitaladmin_image/'. $admin_id.  '.jpg');
           
       }
    }
    
    function delete_hospitaladmins_info($admin_id)
    {
        
        $this->db->where('admin_id',$admin_id);
        $this->db->delete('hospitaladmins');
    }
    function delete_multiple_hospital_admins_info()
    {
        $check=$_POST['check'];
        for($i=0;$i<count($check);$i++){
            $this->db->where('admin_id',$check[$i]);
            $this->db->delete('hospitaladmins');
        }
    }
    
         function save_branch_info()
    {
        $data['name'] 		= $this->input->post('name');
        $data['hospital_id']    = $this->input->post('hospital');
        $data['address']    = $this->input->post('address');
        $data['phone']    = $this->input->post('phone_number');
        $data['email']    = $this->input->post('email');
        $data['country']    = $this->input->post('country');
        $data['state']    = $this->input->post('state');
        $data['district']    = $this->input->post('district');  
        $data['city']    = $this->input->post('city');
       
        
        $this->db->insert('branch',$data);
    }
    function select_branch_info()
    {
        return $this->db->get('branch')->result_array();
    }
     function select_store_info($hospital_id='')
    {
    $account_type=$this->session->userdata('login_type');
    if($account_type == 'superadmin'){
  return $this->db->get('medicalstores')->result_array();
}elseif($account_type == 'hospitaladmins'){
  return $this->db->where('hospital',$this->session->userdata('hospital_id'))->get('medicalstores')->result_array();
}elseif($account_type == 'users'){
        $store=$this->db->where('user_id',$this->session->userdata('login_user_id'))->get('patient')->row()->store_ids;
        
        if($store!=''){
            $store_ids=explode(',',$store);
        for($i=0;$i<count($store_ids);$i++){
            $stores[$i]=$this->db->where('store_id',$store_ids[$i])->get('medicalstores')->row_array();
            }
        }
    return $stores;

}
    }
   
    function update_branch_info($branch_id)
    {
        $data['name'] 		= $this->input->post('name');
        $data['hospital_id']    = $this->input->post('hospital');
        $data['address']    = $this->input->post('address');
        $data['phone']    = $this->input->post('phone_number');
        $data['email']    = $this->input->post('email');
        $data['country']    = $this->input->post('country');
        $data['state']    = $this->input->post('state');
        $data['district']    = $this->input->post('district');
        $data['city']    = $this->input->post('city');
        $data['status']    = $this->input->post('status');
        
        $this->db->where('branch_id',$branch_id);
        $this->db->update('branch',$data);
    }
    
    function delete_branch_info($branch_id)
    {
        $this->db->where('branch_id',$branch_id);
        $this->db->delete('branch');
    }
    function delete_multiple_branch_info()
    {
        $check=$_POST['check'];
        for($i=0;$i<count($check);$i++){
            $this->db->where('branch_id',$check[$i]);
            $this->db->delete('branch');
        }
    }
    function save_department_info()
    {
        $data['hospital_id']=$this->input->post('hospital');
        $data['branch_id']=$this->input->post('branch');
        $data['name'] 		= $this->input->post('name');
        $data['description']    = $this->input->post('description');
        
        $this->db->insert('department',$data);
    }
    function select_department_info()
    {
        return $this->db->get('department')->result_array();
    }
    
   
    function update_department_info($department_id)
    {
        $data['hospital_id']=$this->input->post('hospital');
        $data['branch_id']=$this->input->post('branch');
        $data['name'] 		= $this->input->post('name');
        $data['description']    = $this->input->post('description');
        
        $this->db->where('department_id',$department_id);
        $this->db->update('department',$data);
    }
    
    function delete_department_info($department_id)
    {
        $this->db->where('department_id',$department_id);
        $this->db->delete('department');
    }
    function delete_multiple_department_info()
    {
        $check=$_POST['check'];
        for($i=0;$i<count($check);$i++){
            $this->db->where('department_id',$check[$i]);
            $this->db->delete('department');
        }
    }
     function save_ward_info()
    {
        $data['hospital_id']=$this->input->post('hospital');
        $data['branch_id']=$this->input->post('branch');
        $data['department_id']=$this->input->post('department');
        $data['name'] 		= $this->input->post('name');
        $data['description']    = $this->input->post('description');
        
        $this->db->insert('ward',$data);
    }
    function select_ward_info()
    {
        return $this->db->get('ward')->result_array();
    }
    
   
    function update_ward_info($ward_id)
    {
        $data['hospital_id']=$this->input->post('hospital');
        $data['branch_id']=$this->input->post('branch');
        $data['department_id']=$this->input->post('department');
        $data['name'] 		= $this->input->post('name');
        $data['description']    = $this->input->post('description');
        
        $this->db->where('ward_id',$ward_id);
        $this->db->update('ward',$data);
    }
    
    function delete_ward_info($ward_id)
    {
        $this->db->where('ward_id',$ward_id);
        $this->db->delete('ward');
    }
    function delete_multiple_ward_info()
    {
        $check=$_POST['check'];
        for($i=0;$i<count($check);$i++){
            $this->db->where('ward_id',$check[$i]);
            $this->db->delete('ward');
        }
    }
       function save_expense_info()
    {
        $data['name']       = $this->input->post('name');
        $data['amount']    = $this->input->post('description');
         $data['creation_timestamp']    = $this->input->post('creation_timestamp');
        
        
        $this->db->insert('add_expense',$data);
    }
     function delete_expense($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('add_expense');
    }
    
    function save_doctor_info()
    {
        $data['name'] 		= $this->input->post('fname');
        $data['mname'] 		= $this->input->post('mname');
        $data['lname'] 		= $this->input->post('lname');
        $data['description'] 		= $this->input->post('description');
        $data['email'] 		= $this->input->post('email');
        $data['password']       = sha1('mypulse');
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('mobile');
        $data['hospital_id'] 	= $this->input->post('hospital');
        $data['branch_id'] 	= $this->input->post('branch');
        $data['department_id'] 	= $this->input->post('department');
        $data['status'] 	= $this->input->post('status');
        $data['gender'] 	= $this->input->post('gender');
        $data['dob'] 	= $this->input->post('dob');
        $data['aadhar'] 	= $this->input->post('aadhar');
        $data['qualification'] 	= $this->input->post('qualification');
        if($this->input->post('specializations')!=''){
         $data['specializations'] 	= implode(',',$this->input->post('specializations'));
     }
          $data['experience'] 	= $this->input->post('experience');
          $data['registration']   = $this->input->post('registration');
          $data['country']    = $this->input->post('country');
        $data['state']    = $this->input->post('state');
        $data['district']    = $this->input->post('district');  
        $data['city']    = $this->input->post('city');
        $data['created_at']=date('Y-m-d H:i:s');
        $data['modified_at']=date('Y-m-d H:i:s');
        $insert=$this->db->insert('doctors',$data);
        
        if($insert)
        {
            $lid=$this->db->insert_id();
            $num=100000+$lid;
            $pid='MPD'.date('y').'_'.$num;
            $this->db->where('doctor_id',$lid)->update('doctors',array('unique_id'=>$pid,'modified_at'=>date('Y-m-d H:i:s')));
        }
        $doctor_id  =   $this->db->insert_id();
        move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/doctor_image/" . $doctor_id . '.jpg');
    }
    
    function select_doctor_info($hospital_id = '')
    {
$account_type=$this->session->userdata('login_type');
if($account_type == 'superadmin'){
  return $this->db->get('doctors')->result_array();
}elseif($account_type == 'hospitaladmins'){
  return $this->db->where('hospital_id',$this->session->userdata('hospital_id'))->get('doctors')->result_array();
}elseif($account_type == 'nurse'){
  $doc=$this->db->where('nurse_id',$this->session->userdata('login_user_id'))->get('nurse')->row()->doctor_id;
  $doc_id=explode(',', $doc);
  if($doc_id!=''){
  for($i=0;$i<count($doc_id);$i++){
    $doctors[$i]=$this->db->where('doctor_id',$doc_id[$i])->get('doctors')->row_array();
  }
  return $doctors;
}
  
}elseif($account_type == 'receptionist'){
  $doc=$this->db->where('receptionist_id',$this->session->userdata('login_user_id'))->get('receptionist')->row()->doctor_id;
  $doc_id=explode(',', $doc);
  for($i=0;$i<count($doc_id);$i++){
    $doctors[$i]=$this->db->where('doctor_id',$doc_id[$i])->get('doctors')->row_array();
  }
  return $doctors;
}elseif($account_type == 'users'){
        $doctor=$this->db->where('user_id',$this->session->userdata('login_user_id'))->get('patient')->row();
        if($doctor>0){
        $doctor_ids=explode(',',$doctor->doctor_ids);
        for($i=0;$i<count($doctor_ids);$i++){
            $doctors[$i]=$this->db->where('doctor_id',$doctor_ids[$i])->get('doctors')->row_array();
            }
        }
    return $doctors;
}

/*elseif($account_type == 'medicalstores'){
  $user_role='Pharmacist';
}elseif($account_type == 'medicallabs'){
  $user_role='Laboratorist';
}elseif($account_type == 'users'){
  $user_role='MyPulse Users';
}*/
       /* if($hospital_id !=''){
        return $this->db->where('hospital_id',$hospital_id)->get('doctors')->result_array();
        }else{
        return $this->db->get('doctors')->result_array();
        }*/
    }
    
       function update_doctor_availability_info($doctor_id)
    {
       
        $data['message'] 		= $this->input->post('message');
        $data['no_appt_handle'] 		= $this->input->post('no_appt_handle');
        
        $check=$this->db->where('doctor_id',$doctor_id)->get('availability')->num_rows();
        if($check>0){
        $this->db->where('doctor_id',$doctor_id);
            return $this->db->update('availability',$data);
        }{
            $data['doctor_id'] 		= $doctor_id;
            return $this->db->insert('availability',$data);
        }
        
    }
function update_doctor_new_availability_info($doctor_id)
    {        
$start = new DateTime($this->input->post('start_on'));
$end = (new DateTime($this->input->post('end_on')))->modify('+1 day');
$interval = new DateInterval('P1D');
$period   = new DatePeriod($start, $interval, $end);
if($this->input->post('repeat_interval') == 0){
        $day=$this->input->post('repeat_on');
        $data['repeat_on']      = implode(',',$this->input->post('repeat_on'));
        }elseif($this->input->post('repeat_interval') == 1){
        $day= array('0','1','2','3','4','5','6');
        $data['repeat_on']      = '0,1,2,3,4,5,6';
        }

$days=array(0=>'Sun',1=>'Mon',2=>'Tue',3=>'Wed',4=>'Thu',5=>'Fri',6=>'Sat');
$shuffel=rand(1000,9999);
foreach ($period as $dt) {
$data['unik']=$shuffel;
$data['date']=$dt->format("m/d/Y");
$data['doctor_id']= $doctor_id;
$data['start_date']= $this->input->post('start_on');
$data['end_date']= $this->input->post('end_on');
$data['start_time']= date("H:i", strtotime($this->input->post('time_start').':'.$this->input->post('time_start_min').' '.$this->input->post('starting_ampm')));
$data['end_time']= date("H:i", strtotime($this->input->post('time_end').':'.$this->input->post('time_end_min').' '.$this->input->post('ending_ampm')));
$data['repeat_interval']= $this->input->post('repeat_interval');
$data['status']=2;
for($i=0;$i<count($day);$i++){
for($j=0;$j<count($days);$j++){
    if($dt->format("D")==$days[$j] && $day[$i]==$j){
        $data['status']=1;
    }
    }
    }
   $que=$this->db->insert('availability_slot',$data);
    }

        return $que;
    }
function update_doc_availability_info($id)
    {
       
        if($this->input->post('existDays')!='' && $this->input->post('existDays')=='yes'){
          
  $this->db->where('unik',$this->input->post('unik'))->delete('availability_slot');
$start    = new DateTime($this->input->post('start_on'));
$end      = (new DateTime($this->input->post('end_on')))->modify('+1 day');
$interval = new DateInterval('P1D');
$period   = new DatePeriod($start, $interval, $end);
if($this->input->post('repeat_interval') == 0){
        $day=$this->input->post('repeat_on');
        $data['repeat_on']      = implode(',',$this->input->post('repeat_on'));
        }elseif($this->input->post('repeat_interval') == 1){
        $day= array('0','1','2','3','4','5','6');
        $data['repeat_on']      = '0,1,2,3,4,5,6';
        }

$days=array(0=>'Sun',1=>'Mon',2=>'Tue',3=>'Wed',4=>'Thu',5=>'Fri',6=>'Sat');
$shuffel=rand(1000,9999);
foreach ($period as $dt) {

$data['unik']=$shuffel; 
$data['date']=$dt->format("m/d/Y");
$data['doctor_id']      = $this->input->post('doctor_id');
$data['start_date']         = $this->input->post('start_on');
$data['end_date']       = $this->input->post('end_on');
$data['start_time']         = date("H:i", strtotime($this->input->post('time_start').':'.$this->input->post('time_start_min').' '.$this->input->post('starting_ampm')));
$data['end_time']       = date("H:i", strtotime($this->input->post('time_end').':'.$this->input->post('time_end_min').' '.$this->input->post('ending_ampm')));
$data['repeat_interval']        = $this->input->post('repeat_interval');
$data['status']=2;
for($i=0;$i<count($day);$i++){
for($j=0;$j<count($days);$j++){
    if($dt->format("D")==$days[$j] && $day[$i]==$j){
        $data['status']=1;
    }
    }
    }

$que=$this->db->insert('availability_slot',$data);
    }
    return $que;
        }else{
        $data['start_time'] 		= date("H:i", strtotime($this->input->post('time_start').':'.$this->input->post('time_start_min').' '.$this->input->post('starting_ampm')));
        $data['end_time'] 		= date("H:i", strtotime($this->input->post('time_end').':'.$this->input->post('time_end_min').' '.$this->input->post('ending_ampm')));
            return $this->db->where('id',$id)->update('availability_slot',$data);
        }
        
    }
    function delete_doc_availability_info($id){
        return $this->db->where('id',$id)->delete('availability_slot');
    }
    function delete_all_doc_availability_info($id){
        return $this->db->where('unik',$this->db->where('id',$id)->get('availability_slot')->row()->unik)->delete('availability_slot');
    }
    /*function save_rmp_info()
    {
        $data['name']       = $this->input->post('name');
        $data['commission']         = $this->input->post('commission');
        $data['date']       = $this->input->post('creation_timestamp');
       
        
       return $this->db->insert('rmp',$data);
        
       
    }


    function update_rmp_info($rmp_id)
    {
        $data['name']       = $this->input->post('name');
        $data['commission']   = $this->input->post('commission');
        $data['date']   = $this->input->post('creation_timestamp');
       
        
        $this->db->where('rmp_id',$rmp_id);
   return   $this->db->update('rmp',$data);
        
  

   }

 function select_rmp_info()
    {
        return $this->db->get('rmp')->result_array();
    }
    

    function delete_rmp_info($rmp_id)
    {
        $this->db->where('rmp_id',$rmp_id);
        return $this->db->delete('rmp');
    }*/
    
    function update_doctor_info($doctor_id)
    {
                   
         $data['name'] 		= $this->input->post('fname');
        $data['mname'] 		= $this->input->post('mname');
        $data['lname'] 		= $this->input->post('lname');
        $data['description'] 		= $this->input->post('description');
        $data['email'] 		= $this->input->post('email');
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('mobile');
        $data['hospital_id'] 	= $this->input->post('hospital');
        $data['branch_id'] 	= $this->input->post('branch');
        $data['department_id'] 	= $this->input->post('department');
        $data['status'] 	= $this->input->post('status');
        $data['gender'] 	= $this->input->post('gender');
        $data['dob'] 	= $this->input->post('dob');
        $data['aadhar'] 	= $this->input->post('aadhar');
        $data['qualification'] 	= $this->input->post('qualification');
        if($this->input->post('specializations')!=''){
         $data['specializations'] 	= implode(',', $this->input->post('specializations'));
     }
          $data['experience'] 	= $this->input->post('experience');
          $data['registration']   = $this->input->post('registration');
          $data['country']    = $this->input->post('country');
        $data['state']    = $this->input->post('state');
        $data['district']    = $this->input->post('district');  
        $data['city']    = $this->input->post('city');
        $data['modified_at']=date('Y-m-d H:i:s');
        $this->db->where('doctor_id',$doctor_id);
        $this->db->update('doctors',$data);
        
        move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/doctor_image/" . $doctor_id . '.jpg');
    }
    
    function delete_doctor_info($doctor_id)
    {
        $this->db->where('doctor_id',$doctor_id);
        $this->db->delete('doctors');
    }
    function delete_patient_doctor($doctor_id)
    {
$doctor_ids=explode(',',$this->db->get_where('patient',array('user_id'=>$this->session->userdata('login_user_id')))->row()->doctor_ids);
for($h=0;$h<count($doctor_ids);$h++){
    if($doctor_ids[$h]!=$doctor_id){
        $doc[]=$doctor_ids[$h];
    }
}
$this->db->where('user_id',$this->session->userdata('login_user_id'));
$yes=$this->db->update('patient',array('doctor_ids'=>implode(',',$doc)));
    }
    function select_doctor_info_id($doctor_id)
    {
        return $this->db->where('doctor_id',$doctor_id)->get('doctors')->row_array();

    }
    function delete_multiple_doctor_info()
    {
        $check=$_POST['check'];
        for($i=0;$i<count($check);$i++){
            $this->db->where('doctor_id',$check[$i]);
            $this->db->delete('doctors');
        }
    }
     function delete_store_info($patient_id)
    {
        $this->db->where('store_id',$patient_id);
        $this->db->delete('medicalstores');
    }
    function delete_patient_store($store_id)
    {
$store_ids=explode(',',$this->db->get_where('patient',array('user_id'=>$this->session->userdata('login_user_id')))->row()->store_ids);
for($h=0;$h<count($store_ids);$h++){
    if($store_ids[$h]!=$store_id){
        $doc[]=$store_ids[$h];
    }
}
$this->db->where('user_id',$this->session->userdata('login_user_id'));
$yes=$this->db->update('patient',array('store_ids'=>implode(',',$doc)));
    }
     function delete_multiple_store_info()
    {
        $check=$_POST['check'];
        for($i=0;$i<count($check);$i++){
            $this->db->where('store_id',$check[$i]);
            $this->db->delete('medicalstores');
        }
    }
     function save_medicallabs_info()
    {
          $data['name'] 		= $this->input->post('name');
          $data['description'] 		= $this->input->post('description');
            $data['address'] 		= $this->input->post('address');
        $data['phone']    = $this->input->post('phone_number');
        $data['owner_name']    = $this->input->post('owner_name');   
        $data['owner_mobile']    = $this->input->post('owner_mobile');
        $data['hospital']    = $this->input->post('hospital');
        $data['status']    = $this->input->post('status');
        $data['branch']    = $this->input->post('branch');
        $data['fname']    = $this->input->post('fname');
        $data['lname']    = $this->input->post('lname');
        $data['email']    = $this->input->post('email');  
        $data['in_mobile']    = $this->input->post('in_mobile');
        $data['aadhar']    = $this->input->post('aadhar');
          $data['gender']    = $this->input->post('gender');
            $data['dob']    = $this->input->post('dob');
             $data['in_address']    = $this->input->post('in_address');
           $data['country']    = $this->input->post('country');
        $data['state']    = $this->input->post('state');
        $data['district']    = $this->input->post('district');  
        $data['city']    = $this->input->post('city');
            $data['experience']    = $this->input->post('experience');
             $data['qualification']    = $this->input->post('qualification');
             $data['password']=sha1('mypulse');
            $data['created_at']=date('Y-m-d H:i:s');
        $data['modified_at']=date('Y-m-d H:i:s');
        
       $insert=$this->db->insert('medicallabs',$data); 
       if($insert)
        {
            
            $lid=$this->db->insert_id();
            $num=100000+$lid;
            $pid='MPL'.date('y').'_'.$num;
            $this->db->where('lab_id',$lid)->update('medicallabs',array('unique_id'=>$pid,'modified_at'=>date('Y-m-d H:i:s')));
            
        }
           $id=$this->db->insert_id();
           
           move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/medical_labs/'. $id.  '.jpg');
       
    }
    
    
     function delete_lab_info($patient_id)
    {
        $this->db->where('lab_id',$patient_id);
        $this->db->delete('medicallabs');
    }
    function delete_patient_lab($lab_id)
    {
$lab_ids=explode(',',$this->db->get_where('patient',array('user_id'=>$this->session->userdata('login_user_id')))->row()->lab_ids);
for($h=0;$h<count($lab_ids);$h++){
    if($lab_ids[$h]!=$lab_id){
        $doc[]=$lab_ids[$h];
    }
}
$this->db->where('user_id',$this->session->userdata('login_user_id'));
$yes=$this->db->update('patient',array('lab_ids'=>implode(',',$doc)));
    }
    function delete_multiple_lab_info()
    {
        $check=$_POST['check'];
        for($i=0;$i<count($check);$i++){
            $this->db->where('lab_id',$check[$i]);
            $this->db->delete('medicallabs');
        }
    }
    function save_unuser_info()
    {
        $data['name']       = $this->input->post('fname');
        $data['lname']      = $this->input->post('lname');
        $data['email']      = $this->input->post('email');
        $data['password']       = sha1('mypulse');
        $data['phone']          = $this->input->post('mobile');
        $data['reg_status']   = 2;
        $data['created_at']=date('Y-m-d H:i:s');
        $data['modified_at']=date('Y-m-d H:i:s');
        $insert=$this->db->insert('users',$data);
        if($insert)
        {
            
            $lid=$this->db->insert_id();
            $num=100000+$lid;
            $pid='MPU'.date('y').'_'.$num;
            $this->db->where('user_id',$lid)->update('users',array('unique_id'=>$pid,'modified_at'=>date('Y-m-d H:i:s')));
            
        }
        $patient_id  =   $this->db->insert_id();
        move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/user_image/" . $patient_id . '.jpg');
    }
    function save_user_info()
    {
        $data['name'] 		= $this->input->post('fname');
        $data['mname'] 		= $this->input->post('mname');
        $data['lname'] 		= $this->input->post('lname');
        $data['email'] 		= $this->input->post('email');
        $data['password']       = sha1('mypulse');
        $data['description']       = $this->input->post('description');
        $data['country']   = $this->input->post('country');
        $data['state']   = $this->input->post('state');
        $data['district']   = $this->input->post('district');
        $data['city'] 	= $this->input->post('city');
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('mobile');
        $data['gender']            = $this->input->post('gender');
        $data['dob']     = $this->input->post('dob');
        $data['age']            = $this->input->post('age');
        $data['blood_group'] 	= $this->input->post('blood_group');
        $data['aadhar'] 	= $this->input->post('aadhar');
        $data['height'] 	= $this->input->post('height');
        $data['weight'] 	= $this->input->post('weight');
        $data['blood_pressure'] 	= $this->input->post('blood_pressure');
        $data['sugar_level'] 	= $this->input->post('sugar_level');
        $data['health_insurance_provider'] 	= $this->input->post('health_insurance_provider');
        $data['health_insurance_id'] 	= $this->input->post('health_insurance_id');
        $data['family_history'] 	= $this->input->post('family_history');
         $data['past_medical_history'] 	= $this->input->post('past_medical_history');
          $data['status'] 	= $this->input->post('status');
        $data['created_at']=date('Y-m-d H:i:s');
        $data['modified_at']=date('Y-m-d H:i:s');
        $insert=$this->db->insert('users',$data);
        if($insert)
        {
            $lid=$this->db->insert_id();
            $num=100000+$lid;
            $pid='MPU'.date('y').'_'.$num;
            $this->db->where('user_id',$lid)->update('users',array('unique_id'=>$pid,'modified_at'=>date('Y-m-d H:i:s')));
            
        }
        $patient_id  =   $this->db->insert_id();
        move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/user_image/" . $patient_id . '.jpg');
    }
     /*function save_outpatient_info()
    {
        $data['name'] 		= $this->input->post('name');
        $data['email'] 		= $this->input->post('email');
        $data['password']       = sha1($this->input->post('password'));
         $data['city'] 	= $this->input->post('city');
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('phone');
        $data['sex']            = $this->input->post('sex');
        $data['birth_date']     = strtotime($this->input->post('birth_date'));
        $data['age']            = $this->input->post('age');
        $data['in_time']            = $this->input->post('in_time');
        $data['patient_type']            = $this->input->post('patient_type');
        $data['blood_group'] 	= $this->input->post('blood_group');
        
        $insert=$this->db->insert('patient',$data);
        if($insert)
        {
            
            $lid=$this->db->insert_id();
            $a="12345678901234567";
            $sid=str_shuffle($a);
            $uid=substr($sid, 15);
             $pid='ARA_'.$lid.$uid;
            $this->db->where('patient_id',$lid)->update('patient',array('unique_id'=>$pid));
            
        }
        $patient_id  =   $this->db->insert_id();
        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/user_image/" . $patient_id . '.jpg');
    }*/
   /*   function save_patientex_info()
    {
        
        $data['name'] 		= $this->input->post('name');
         $data['hospital'] 		= $this->input->post('hospital');
        $data['medicine'] 		= $this->input->post('medicine');
        $data['bed']       = $this->input->post('bed');
        $data['days']       = $this->input->post('days');
        $data['join_date'] 	= $this->input->post('join_date');
        $data['discharge_date']          = $this->input->post('discharge_date');
       
        
        $this->db->insert('patient_expenses',$data);
        
       
    }*/
/*
    function save_checkup_info()
    {
        $data['tests'] 		= $this->input->post('tests');
         $data['amount'] 		= $this->input->post('amount');
      
        $this->db->insert('checkups',$data);
        
       
    }*/
   /* function select_checkup_info()
    {
        return $this->db->get('checkups')->result_array();
    }*/
    
     function select_lab_info($hospital_id='')
    {
           $account_type=$this->session->userdata('login_type');
    if($account_type == 'superadmin'){
  return $this->db->get('medicallabs')->result_array();
}elseif($account_type == 'hospitaladmins'){
  return $this->db->where('hospital',$this->session->userdata('hospital_id'))->get('medicallabs')->result_array();
}elseif($account_type == 'users'){
        $lab=$this->db->where('user_id',$this->session->userdata('login_user_id'))->get('patient')->row()->lab_ids;
        if($lab!=''){ 
        $lab_ids=explode(',',$lab);
        for($i=0;$i<count($lab_ids);$i++){
            $labs[$i]=$this->db->where('lab_id',$lab_ids[$i])->get('medicallabs')->row_array();
            }
    return $labs;
}
}
    }
    
  /*  function select_checkup_infon()
    {
        return $this->db->get('users')->result_array();
    }*/
    function select_user_info()
    {
        
        return $this->db->get('users')->result_array();
    
    }
function select_user_information($patient_id="")
    {
       return $this->db->get_where('users', array('user_id' => $patient_id))->result_array();
    }
    function select_patient_info()
    {
      $account_type=$this->session->userdata('login_type');
   /* if($account_type == 'superadmin'){
  return $this->db->order_by('id','desc')->get('patient')->result_array();
}elseif($account_type == 'hospitaladmins'){*/
  /*return $this->db->order_by('id','desc')->get('patient')->result_array();*/

/*}*/
$patient_info=$this->db->order_by('id','desc')->get('patient')->result_array();
foreach ($patient_info as $row){
if($account_type == 'hospitaladmins'){
                $hospital=explode(',',$row['hospital_ids']);
                for($ha1=0;$ha1<count($hospital);$ha1++){
            if($hospital[$ha1] == $this->session->userdata('hospital_id')){
            $users[]=$this->db->where('user_id',$row['user_id'])->get('users')->row();
            }
            }
            }
            if($account_type == 'doctors'){
                $doctor=explode(',',$row['doctor_ids']);
            for($doc1=0;$doc1<count($doctor);$doc1++){
            if($doctor[$doc1] == $this->session->userdata('login_user_id')){
            $users[]=$this->db->where('user_id',$row['user_id'])->get('users')->row();
            }
            }
            }
            if($account_type == 'nurse'){
                $doctor=explode(',',$row['doctor_ids']);
            for($doc1=0;$doc1<count($doctor);$doc1++){
                $doctor1=explode(',',$this->db->where('nurse_id',$this->session->userdata('login_user_id'))->get('nurse')->row()->doctor_id);
                for($doc2=0;$doc2<count($doctor1);$doc2++){
                    if($doctor[$doc1] == $doctor1[$doc2]){
            $users[]=$this->db->where('user_id',$row['user_id'])->get('users')->row();
            }
                }
            }
            }
            if($account_type == 'receptionist'){
                $doctor=explode(',',$row['doctor_ids']);
            for($doc1=0;$doc1<count($doctor);$doc1++){
                $doctor1=explode(',',$this->db->where('receptionist_id',$this->session->userdata('login_user_id'))->get('receptionist')->row()->doctor_id);
                for($doc2=0;$doc2<count($doctor1);$doc2++){
                    if($doctor[$doc1] == $doctor1[$doc2]){
            $users[]=$this->db->where('user_id',$row['user_id'])->get('users')->row();
            }
                }
            }
            }
            if($account_type == 'medicallabs'){
                $lab=explode(',',$row['lab_ids']);
            for($lab1=0;$lab1<count($lab);$lab1++){
            if($lab[$lab1] == $this->session->userdata('login_user_id')){
            $users[]=$this->db->where('user_id',$row['user_id'])->get('users')->row();
            }
            }
            }
if($account_type == 'medicalstores'){
                $store=explode(',',$row['store_ids']);
            for($sto1=0;$sto1<count($store);$sto1++){
            if($store[$sto1] == $this->session->userdata('login_user_id')){
            $users[]=$this->db->where('user_id',$row['user_id'])->get('users')->row();
            }
            }
            }
        }
        return $users;

    }
    function select_inpatient_info()
    {
      $account_type=$this->session->userdata('login_type');
    if($account_type == 'superadmin'){
  return $this->db->order_by('id','desc')->get_where('inpatient',array('status!='=>0))->result_array();
}elseif($account_type == 'hospitaladmins'){
  return $this->db->where('hospital_id',$this->session->userdata('hospital_id'))->order_by('id','desc')->get_where('inpatient',array('status'=>1))->result_array();
}elseif($account_type == 'doctors'){
    return $this->db->where('doctor_id',$this->session->userdata('login_user_id'))->order_by('id','desc')->get_where('inpatient',array('status'=>1))->result_array();
}elseif($account_type == 'users'){
    return $this->db->where('user_id',$this->session->userdata('login_user_id'))->order_by('id','desc')->get_where('inpatient',array('status!='=>0))->result_array();
}elseif($account_type == 'nurse'){
    $res=explode(',',$this->db->where('nurse_id',$this->session->userdata('login_user_id'))->get('nurse')->row()->doctor_id);
    for($n=0;$n<count($res);$n++){
        $inpatient[]=$this->db->where('doctor_id',$res[$n])->get_where('inpatient',array('status'=>1))->row_array();
    }
    return $inpatient;
}elseif($account_type == 'receptionist'){
    $res=explode(',',$this->db->where('receptionist_id',$this->session->userdata('login_user_id'))->get('receptionist')->row()->doctor_id);
    for($n=0;$n<count($res);$n++){
        $inpatient=$this->db->where('doctor_id',$res[$n])->get_where('inpatient',array('status=='=>1))->row_array();
        if($inpatient!=''){
            $inpatient1[]=$inpatient;
        }
    }
    return $inpatient1;
}
    }
    function select_inpatient_id_info($id)
    {
  return $this->db->where('id',$id)->get('inpatient')->row();
    }
    function select_inpatient_id_doctor_info($user_id='',$doctor_id='')
    {
  return $this->db->order_by('id','desc')->get_where('inpatient',array('doctor_id'=>$this->session->userdata('login_user_id'),'user_id'=>$user_id))->result_array();
    }
    function select_inpatient_id_information($user_id='')
    {
  return $this->db->order_by('id','desc')->get_where('inpatient',array('user_id'=>$user_id,'show_status!='=>0))->result_array();
    }
    function select_inpatient_history_info($id)
    {
  return $this->db->order_by('id','desc')->where('in_patient_id',$id)->get('inpatient_history')->result_array();
    }
    function save_inpatient_info()
    {
    $data['user_id']       = $this->input->post('user_id');
    $data['doctor_id']       = $this->db->where('unique_id',$this->input->post('doctor'))->get('doctors')->row()->doctor_id;
    $data['hospital_id']       = $this->input->post('hospital');
    $data['bed_id']       = $this->input->post('bed');
    $data['reason']       = $this->input->post('reason');
    $data['status']       = $this->input->post('status');
    $data['created_by']       = $this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id');
    $data['created_date']=date('Y-m-d H:i:s');
    if($data['status'] == 1){
    $data['join_date']=date('Y-m-d H:i:s');
    }
    $insert=$this->db->insert('inpatient',$data);
        if($insert)
        {
            $lid=$this->db->insert_id();
            
            /***********Bed Status**************/
        if($this->input->post('bed')!=''){
        $this->db->where('bed_id',$this->input->post('bed'));
        $this->db->update('bed',array('bed_status'=>2));
        }

        /******Notification Message******/
        if($data['status'] == 1){$status='Admitted';}elseif($data['status'] == 0){$status='Not Admitted';}
            
            /*$notification['created_by']=$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id');
            $notification['user_id']='users-user-'.$data['user_id'];
            $notification['title']='Registered As In-Patient';
            $notification['text']='Hi User Your Considered As In-Patient Your Current Status is '.$status.'.';
         $this->db->insert('notification',$notification);*/
         $in_patient['in_patient_id']=$lid;
         $in_patient['created_date']=$data['created_date'];
         $in_patient['note']='Joined As In-Patient and Status as '.$status.'.';
         $this->db->insert('inpatient_history',$in_patient);
        }
    }
    function update_inpatient_info($patient_id)
    {
    $data['user_id']       = $this->input->post('user_id');
    $data['doctor_id']       = $this->db->where('unique_id',$this->input->post('doctor'))->get('doctors')->row()->doctor_id;
    $data['hospital_id']       = $this->input->post('hospital');
    $data['bed_id']       = $this->input->post('bed');
    $data['reason']       = $this->input->post('reason');
    $data['status']       = $this->input->post('status');
    $data['created_by']       = $this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id');
    $data['modified_date']=date('Y-m-d H:i:s');
    $status=$this->db->where('id',$patient_id)->get('inpatient')->row_array();
    if($status['bed_id']!=$this->input->post('bed'))
    {
    $this->db->where('bed_id',$status['bed_id']);
    $this->db->update('bed',array('bed_status'=>1));
    $this->db->where('bed_id',$this->input->post('bed'));
    $this->db->update('bed',array('bed_status'=>2)); 
    }
    if($status['status'] != $data['status'] && $data['status']==1){
    $data['join_date']=date('Y-m-d H:i:s');
    }
    if($data['status'] == 2){
    $data['discharged_date']=date('Y-m-d H:i:s');
    }
    $insert=$this->db->where('id',$patient_id)->update('inpatient',$data);
        if($insert)
        {
              /***********Bed Status**************/
        if($data['status']==2){
        $this->db->where('bed_id',$this->input->post('bed'));
        $this->db->update('bed',array('bed_status'=>1));
        }
            /*$lid=$this->db->insert_id();*/
            if($data['status'] == 2){$status='Discharged';}
            /******Notification Message******/
/*            $notification['created_by']=$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id');
            $notification['user_id']='users-user-'.$data['user_id'];
            $notification['title']='Updated In-Patient Details';
            $notification['text']='Hi User Your In-Patient Updated';
         $this->db->insert('notification',$notification);*/
         $in_patient['in_patient_id']=$patient_id;
         $in_patient['created_date']=$data['modified_date'];
         $in_patient['note']='In-Patient Updated';
         $this->db->insert('inpatient_history',$in_patient);
        }
    }
    function update_inpatient_status($id='',$status='')
    {
        $data['show_status']=$status;
        $this->db->where('id',$id);
        $this->db->update('inpatient',$data);
        
    }
    function delete_inpatient_info($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('inpatient');
    }
    /*function select_patient_inf($patient_id)
    {
        //return $this->db->where('patient_type','inpatient')->get_where('patient', array('patient_id' => $patient_id))->result_array();
        return $this->db->get_where('patient',array('status'=>'1'))->result_array();
        //echo $this->db->last_query(); die();
    
    }
    function select_outpatient_inf($patient_id)
    {
        //return $this->db->where('patient_type','inpatient')->get_where('patient', array('patient_id' => $patient_id))->result_array();
        return $this->db->get_where('patient',array('patient_type'=>'outpatient','patient_id'=>$patient_id))->result_array();
        //echo $this->db->last_query(); die();
    
    }
    function select_outpatient_info($patient)
    {
        return $this->db->where('patient_type','outpatient')->get('patient')->result_array();
    }
    
     
      function select_patientex_info()
    {
        return $this->db->get('payments')->result_array();
    }
    
    function select_beds_info()
    {
        return $this->db->get('bed')->result_array();
    }
    
    
    function select_patient_info_by_patient_id( $patient_id = '' )
    {
        return $this->db->get_where('patient', array('patient_id' => $patient_id))->result_array();
    }*/
            
    function update_user_info($user_id)
    {
        $data['name']      = $this->input->post('fname');
        $data['mname']      = $this->input->post('mname');
        $data['lname']      = $this->input->post('lname');
        $data['email']      = $this->input->post('email');
        $data['description']       = $this->input->post('description');
        $data['country']   = $this->input->post('country');
        $data['state']   = $this->input->post('state');
        $data['district']   = $this->input->post('district');
        $data['city']   = $this->input->post('city');
        $data['address']    = $this->input->post('address');
        $data['phone']          = $this->input->post('mobile');
        $data['gender']            = $this->input->post('gender');
        $data['dob']     = $this->input->post('dob');
        $data['age']            = $this->input->post('age');
        $data['blood_group']    = $this->input->post('blood_group');
        $data['aadhar']     = $this->input->post('aadhar');
        $data['height']     = $this->input->post('height');
        $data['weight']     = $this->input->post('weight');
        $data['blood_pressure']     = $this->input->post('blood_pressure');
        $data['sugar_level']    = $this->input->post('sugar_level');
        $data['health_insurance_provider']  = $this->input->post('health_insurance_provider');
        $data['health_insurance_id']    = $this->input->post('health_insurance_id');
        $data['family_history']     = $this->input->post('family_history');
         $data['past_medical_history']  = $this->input->post('past_medical_history');
          $data['status']   = $this->input->post('status');
        $data['modified_at']=date('Y-m-d H:i:s');
        $this->db->where('user_id',$user_id);
        $this->db->update('users',$data);
        
        move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/user_image/" . $user_id . '.jpg');
    }
    function user_update_info($user_id)
    {
        $data['age']            = $this->input->post('age');
        $data['blood_group']    = $this->input->post('blood_group');
        $data['height']     = $this->input->post('height');
        $data['weight']     = $this->input->post('weight');
        $data['blood_pressure']     = $this->input->post('blood_pressure');
        $data['sugar_level']    = $this->input->post('sugar_level');
        $data['health_insurance_provider']  = $this->input->post('health_insurance_provider');
        $data['health_insurance_id']    = $this->input->post('health_insurance_id');
        $data['family_history']     = $this->input->post('family_history');
         $data['past_medical_history']  = $this->input->post('past_medical_history');
        $data['modified_at']=date('Y-m-d H:i:s');
        $this->db->where('user_id',$user_id);
        $this->db->update('users',$data);
    }
    function update_outpatient_info($patient_id)
    {
        $data['name'] 		= $this->input->post('name');
        $data['email'] 		= $this->input->post('email');
        $data['city'] 	= $this->input->post('city');
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('phone');
        $data['sex']            = $this->input->post('sex');
        $data['birth_date']     = strtotime($this->input->post('birth_date'));
        $data['age']            = $this->input->post('age');
        $data['in_time']            = $this->input->post('in_time');
        $data['patient_type']            = $this->input->post('patient_type');
        $data['blood_group'] 	= $this->input->post('blood_group');
        
        $this->db->where('patient_id',$patient_id);
        $this->db->update('patient',$data);
        
        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/user_image/" . $patient_id . '.jpg');
    }
    
      function update_patientex_info($id)
    {
        $data['name'] 		= $this->input->post('name');
        $data['hospital'] 		= $this->input->post('hospital');
        $data['medicine'] 	= $this->input->post('medicine');
        $data['bed']          = $this->input->post('bed');
        $data['days']            = $this->input->post('days');
        $data['join_date']     = $this->input->post('join_date');
        $data['discharge_date']            = $this->input->post('discharge_date');
       
        
        $this->db->where('id',$id);
        $this->db->update('patient_expenses',$data);
        
    }
 
     function update_checkup_info($id)
    {
        $data['tests'] 		= $this->input->post('tests');
        $data['amount'] 		= $this->input->post('amount');
       
        
       
        $this->db->where('id',$id);
        $this->db->update('checkups',$data);
        
    }
    
    function delete_checkup_info($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('checkups');
    }
    function delete_user_info($user_id)
    {
        $this->db->where('user_id',$user_id);
        $this->db->delete('users');
    }
    function delete_multiple_user_info()
    {
        $check=$_POST['check'];
        for($i=0;$i<count($check);$i++){
            $this->db->where('user_id',$check[$i]);
            $this->db->delete('users');
        }
    }
    function delete_outpatient_info($patient_id)
    {
        $this->db->where('patient_id',$patient_id);
        $this->db->delete('patient');
    }
    
       function delete_patientex_info($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('patient_expenses');
    }
    
   
    function save_nurse_info()
    {
        $data['name'] 		= $this->input->post('fname');
        $data['mname'] 		= $this->input->post('mname');
        $data['lname'] 		= $this->input->post('lname');
        $data['description'] 		= $this->input->post('description');
        $data['email'] 		= $this->input->post('email');
        $data['password']       = sha1('mypulse');
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('mobile');
        $data['hospital_id'] 	= $this->input->post('hospital');
        $data['branch_id'] 	= $this->input->post('branch');
        $data['department_id'] 	= $this->input->post('department');
        $data['doctor_id'] 	= implode(',',$this->input->post('doctor'));
        $data['status'] 	= $this->input->post('status');
        $data['gender'] 	= $this->input->post('gender');
        $data['dob'] 	= $this->input->post('dob');
        $data['aadhar'] 	= $this->input->post('aadhar');
        $data['qualification'] 	= $this->input->post('qualification');
        $data['experience'] 	= $this->input->post('experience');
        $data['country']    = $this->input->post('country');
        $data['state']    = $this->input->post('state');
        $data['district']    = $this->input->post('district');  
        $data['city']    = $this->input->post('city');
        $data['created_at']=date('Y-m-d H:i:s');
        $data['modified_at']=date('Y-m-d H:i:s');
       $insert= $this->db->insert('nurse',$data);
        if($insert)
        {
            
            $lid=$this->db->insert_id();
            $num=100000+$lid;
            $pid='MPN'.date('y').'_'.$num;
            $this->db->where('nurse_id',$lid)->update('nurse',array('unique_id'=>$pid,'modified_at'=>date('Y-m-d H:i:s')));
            
        }
        $nurse_id  =   $this->db->insert_id();
        move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/nurse_image/" . $nurse_id . '.jpg');
    }
    
    function select_nurse_info($hospital_id='')
    {
        $account_type=$this->session->userdata('login_type');
        if($account_type == 'superadmin'){
  return $this->db->get('nurse')->result_array();
}elseif($account_type == 'hospitaladmins'){
  return $this->db->where('hospital_id',$this->session->userdata('hospital_id'))->get('nurse')->result_array();
}elseif($account_type == 'doctors'){
    $nurse=$this->db->where('branch_id',$this->session->userdata('branch_id'))->get('nurse')->result_array();
    for($i=0;$i<count($nurse);$i++){
        $nu=explode(',',$nurse[$i]['doctor_id']);
        for($j=0;$j<count($nu);$j++){
            if($nu[$j] == $this->session->userdata('login_user_id')){
             $nurs[$i]=$nurse[$i];
            }
        }
  }
  return $nurs;
}
    }
    
    function update_nurse_info($nurse_id)
    {
        
        $data['name']       = $this->input->post('fname');
        $data['mname']      = $this->input->post('mname');
        $data['lname']      = $this->input->post('lname');
        $data['description']        = $this->input->post('description');
        $data['email']      = $this->input->post('email');
        $data['address']    = $this->input->post('address');
        $data['phone']          = $this->input->post('mobile');
        $data['hospital_id']    = $this->input->post('hospital');
        $data['branch_id']  = $this->input->post('branch');
        $data['department_id']  = $this->input->post('department');
        $data['doctor_id']  = implode(',',$this->input->post('doctor'));
        $data['status']     = $this->input->post('status');
        $data['gender']     = $this->input->post('gender');
        $data['dob']    = $this->input->post('dob');
        $data['aadhar']     = $this->input->post('aadhar');
        $data['qualification']  = $this->input->post('qualification');
        $data['experience']     = $this->input->post('experience');
        $data['country']    = $this->input->post('country');
        $data['state']    = $this->input->post('state');
        $data['district']    = $this->input->post('district');  
        $data['city']    = $this->input->post('city');
        $data['modified_at']=date('Y-m-d H:i:s');
        $this->db->where('nurse_id',$nurse_id);
        $this->db->update('nurse',$data);
        
        move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/nurse_image/" . $nurse_id . '.jpg');
    }
    
    function delete_nurse_info($nurse_id)
    {
        $this->db->where('nurse_id',$nurse_id);
        $this->db->delete('nurse');
    }
    function delete_multiple_nurse_info()
    {
        $check=$_POST['check'];
        for($i=0;$i<count($check);$i++){
            $this->db->where('nurse_id',$check[$i]);
            $this->db->delete('nurse');
        }
    }
    /*function save_pharmacist_info()
    {
        $data['name'] 		= $this->input->post('name');
        $data['email'] 		= $this->input->post('email');
        $data['password']       = sha1($this->input->post('password'));
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('phone');
        
        $this->db->insert('pharmacist',$data);
        
        $pharmacist_id  =   $this->db->insert_id();
        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/pharmacist_image/" . $pharmacist_id . '.jpg');
    }
    
    function select_pharmacist_info()
    {
        return $this->db->get('pharmacist')->result_array();
    }
    
    function update_pharmacist_info($pharmacist_id)
    {
        $data['name'] 		= $this->input->post('name');
        $data['email'] 		= $this->input->post('email');
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('phone');
        
        $this->db->where('pharmacist_id',$pharmacist_id);
        $this->db->update('pharmacist',$data);
        
        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/pharmacist_image/" . $pharmacist_id . '.jpg');
    }
    
    function delete_pharmacist_info($pharmacist_id)
    {
        $this->db->where('pharmacist_id',$pharmacist_id);
        $this->db->delete('pharmacist');
    }
    
    function save_laboratorist_info()
    {
        $data['name'] 		= $this->input->post('name');
        $data['email'] 		= $this->input->post('email');
        $data['password']       = sha1($this->input->post('password'));
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('phone');
        
        $this->db->insert('laboratorist',$data);
        
        $laboratorist_id  =   $this->db->insert_id();
        move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/laboratorist_image/" . $laboratorist_id . '.jpg');
    }*/
    
    /*function select_laboratorist_info()
    {
        return $this->db->get('laboratorist')->result_array();
    }*/
    
   /* function update_laboratorist_info($laboratorist_id)
    {
        $data['name'] 		= $this->input->post('name');
        $data['email'] 		= $this->input->post('email');
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('phone');
        
        $this->db->where('laboratorist_id',$laboratorist_id);
        $this->db->update('laboratorist',$data);
        
        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/laboratorist_image/" . $laboratorist_id . '.jpg');
    }
    
    function delete_laboratorist_info($laboratorist_id)
    {
        $this->db->where('laboratorist_id',$laboratorist_id);
        $this->db->delete('laboratorist');
    }
    
    function save_accountant_info()
    {
        $data['name'] 		= $this->input->post('name');
        $data['email'] 		= $this->input->post('email');
        $data['password']       = sha1($this->input->post('password'));
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('phone');
        
        $this->db->insert('accountant',$data);
        
        $accountant_id  =   $this->db->insert_id();
        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/accountant_image/" . $accountant_id . '.jpg');
    }
    
    function select_accountant_info()
    {
        return $this->db->get('accountant')->result_array();
    }
    
    function update_accountant_info($accountant_id)
    {
        $data['name'] 		= $this->input->post('name');
        $data['email'] 		= $this->input->post('email');
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('phone');
        
        $this->db->where('accountant_id',$accountant_id);
        $this->db->update('accountant',$data);
        
        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/accountant_image/" . $accountant_id . '.jpg');
    }
    
    function delete_accountant_info($accountant_id)
    {
        $this->db->where('accountant_id',$accountant_id);
        $this->db->delete('accountant');
    }*/
    
    function save_receptionist_info()
    {
       
        $data['name'] 		= $this->input->post('fname');
        $data['mname'] 		= $this->input->post('mname');
        $data['lname'] 		= $this->input->post('lname');
        $data['description'] 		= $this->input->post('description');
        $data['email'] 		= $this->input->post('email');
        $data['password']       = sha1('mypulse');
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('mobile');
        $data['hospital_id'] 	= $this->input->post('hospital');
        $data['branch_id'] 	= $this->input->post('branch');
        $data['department_id'] 	= $this->input->post('department');
        $data['status'] 	= $this->input->post('status');
        $data['gender'] 	= $this->input->post('gender');
        $data['dob'] 	= $this->input->post('dob');
        $data['aadhar'] 	= $this->input->post('aadhar');
        $data['qualification'] 	= $this->input->post('qualification');
        $data['experience'] 	= $this->input->post('experience');
        $data['doctor_id']  = implode(',',$this->input->post('doctor'));
        $data['created_at']=date('Y-m-d H:i:s');
        $data['modified_at']=date('Y-m-d H:i:s');
        $insert=$this->db->insert('receptionist',$data);
        if($insert)
        {
            
            $lid=$this->db->insert_id();
            $num=100000+$lid;
            $pid='MPR'.date('y').'_'.$num;
            $this->db->where('receptionist_id',$lid)->update('receptionist',array('unique_id'=>$pid,'modified_at'=>date('Y-m-d H:i:s')));
            
        }
        $receptionist_id  =   $this->db->insert_id();
        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/receptionist_image/" . $receptionist_id . '.jpg');
    }
    
    function select_receptionist_info($hospital_id='')
    {
$account_type=$this->session->userdata('login_type');
if($account_type == 'superadmin'){
  return $this->db->get('receptionist')->result_array();
}elseif($account_type == 'hospitaladmins'){
  return $this->db->where('hospital_id',$this->session->userdata('hospital_id'))->get('receptionist')->result_array();
}elseif($account_type == 'doctors'){
    $receptionist=$this->db->where('branch_id',$this->session->userdata('branch_id'))->get('receptionist')->result_array();
    for($i=0;$i<count($receptionist);$i++){
        $rec=explode(',',$receptionist[$i]['doctor_id']);
        for($j=0;$j<count($rec);$j++){
            if($rec[$j] == $this->session->userdata('login_user_id')){
             $recep[$i]=$receptionist[$i];
            }
        }
  }
  return $recep;
}
 /*      $account_type=$this->session->userdata('login_type');
if($account_type == 'superadmin'){
  return $this->db->get('doctors')->result_array();
}elseif($account_type == 'hospitaladmins'){
  return $this->db->where('hospital_id',$this->session->userdata('hospital_id'))->get('doctors')->result_array();
}elseif($account_type == 'nurse'){
  $doc=$this->db->where('nurse_id',$this->session->userdata('login_user_id'))->get('nurse')->row()->doctor_id;
  $doc_id=explode(',', $doc);
  for($i=0;$i<count($doc_id);$i++){
    $doctors[$i]=$this->db->where('doctor_id',$doc_id[$i])->get('doctors')->row_array();
  }
  return $doctors;
  
}elseif($account_type == 'receptionist'){
  $doc=$this->db->where('receptionist_id',$this->session->userdata('login_user_id'))->get('receptionist')->row()->doctor_id;
  $doc_id=explode(',', $doc);
  for($i=0;$i<count($doc_id);$i++){
    $doctors[$i]=$this->db->where('doctor_id',$doc_id[$i])->get('doctors')->row_array();
  }
  return $doctors;
}*/
    }
    
    function update_receptionist_info($receptionist_id)
    {
        $data['name']       = $this->input->post('fname');
        $data['mname']      = $this->input->post('mname');
        $data['lname']      = $this->input->post('lname');
        $data['description']        = $this->input->post('description');
        $data['email']      = $this->input->post('email');
        $data['doctor_id']  = implode(',',$this->input->post('doctor'));
        $data['address']    = $this->input->post('address');
        $data['phone']          = $this->input->post('mobile');
        $data['hospital_id']    = $this->input->post('hospital');
        $data['branch_id']  = $this->input->post('branch');
        $data['department_id']  = $this->input->post('department');
        $data['status']     = $this->input->post('status');
        $data['gender']     = $this->input->post('gender');
        $data['dob']    = $this->input->post('dob');
        $data['aadhar']     = $this->input->post('aadhar');
        $data['qualification']  = $this->input->post('qualification');
        $data['experience']     = $this->input->post('experience');
        $data['doctor_id']  = implode(',',$this->input->post('doctor'));
        $data['modified_at']=date('Y-m-d H:i:s');
        $data['country']    = $this->input->post('country');
        $data['state']    = $this->input->post('state');
        $data['district']    = $this->input->post('district');  
        $data['city']    = $this->input->post('city');
        $this->db->where('receptionist_id',$receptionist_id);
        $this->db->update('receptionist',$data);
        move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/receptionist_image/" . $receptionist_id . '.jpg');
    }
    
    function delete_receptionist_info($receptionist_id)
    {
        $this->db->where('receptionist_id',$receptionist_id);
        $this->db->delete('receptionist');
    }
     function delete_multiple_receptionist_info()
    {
        $check=$_POST['check'];
        for($i=0;$i<count($check);$i++){
            $this->db->where('receptionist_id',$check[$i]);
            $this->db->delete('receptionist');
        }
    }

/*     function save_tests_allotment_info()
    {
        
        $data['tests'] 		    = $this->input->post('tests');
         $data['patient_id'] 		    = $this->input->post('patient_id');
        $data['allotment_time'] 		    = $this->input->post('allotment_time');
        
       $this->db->insert('outpatient_tests',$data);
    }
    
    function save_bed_allotment_info()
    {
        $data['bed_id']                 = $this->input->post('bed_id');
        $data['patient_id'] 		    = $this->input->post('patient_id');
        $data['tests'] 		    = $this->input->post('tests');
        $data['allotment_timestamp'] 	= strtotime($this->input->post('allotment_timestamp'));
        $data['discharge_timestamp']    = strtotime($this->input->post('discharge_timestamp'));
        
        $this->db->insert('bed_allotment',$data);
    }
    
    function update_tests_allotment_info($tests_id)
    {
        
        $data['tests'] 		= $this->input->post('tests');
        $data['allotment_time'] 	= strtotime($this->input->post('allotment_time'));
        $data['patient_id'] 		    = $this->input->post('patient_id');
        
        
        $this->db->where('tests_id',$tests_id);
        $this->db->update('outpatient_tests',$data);
    }
    function select_bed_allotment_info()
    {
        return $this->db->get('bed_allotment')->result_array();
    }
     function select_tests_allotment_info()
    {
        return $this->db->get('outpatient_tests')->result_array();
    }
    
    function update_bed_allotment_info($bed_allotment_id)
    {
        $data['bed_id']                 = $this->input->post('bed_id');
        $data['patient_id'] 		= $this->input->post('patient_id');
        $data['allotment_timestamp'] 	= strtotime($this->input->post('allotment_timestamp'));
        $data['discharge_timestamp']    = strtotime($this->input->post('discharge_timestamp'));
        
        $this->db->where('bed_allotment_id',$bed_allotment_id);
        $this->db->update('bed_allotment',$data);
    }
    
    function delete_bed_allotment_info($bed_allotment_id)
    {
        $this->db->where('bed_allotment_id',$bed_allotment_id);
        $this->db->delete('bed_allotment');
    }
    function delete_tests_allotment_info($tests_id)
    {
        $this->db->where('tests_id',$tests_id);
        $this->db->delete('outpatient_tests');
    }
    function select_blood_bank_info()
    {
        return $this->db->get('blood_bank')->result_array();
    }
    
    function update_blood_bank_info($blood_group_id)
    {
        $data['status']    = $this->input->post('status');
        
        $this->db->where('blood_group_id',$blood_group_id);
        $this->db->update('blood_bank',$data);
    }*/
    function getReport(){
        $start_date = isset($_GET['sd']) ? date("Y-m-d",strtotime($_GET['sd'])) : date('Y-m-d',(strtotime ( '-29 day' , time() ) ));
        $end_date = isset($_GET['ed']) ? date("Y-m-d",strtotime($_GET['ed'])) : date("Y-m-d");
        if($start_date != "" && $end_date != ""){
            $qry=$this->db->get('appointments');  
        }else if($start_date != ""){
            $qry=$this->db->get('appointments');
        }else if($end_date != ""){
            $qry=$this->db->get('appointments');
        }else{
            $qry=$this->db->get('appointments');
        }
        return $this->db->query($qry)->result_array();
    }
    /*function save_report_info()
    {
        $data['type'] 		= $this->input->post('type');
        $data['description']    = $this->input->post('description');
        $data['timestamp']      = strtotime($this->input->post('timestamp'));
        $data['patient_id']     = $this->input->post('patient_id');
        
        $login_type             = $this->session->userdata('login_type');
        if($login_type=='nurse')
            $data['doctor_id']  = $this->input->post('doctor_id');
        else $data['doctor_id'] = $this->session->userdata('login_user_id');
        
        $this->db->insert('report',$data);
    }
    
   
    
    function update_report_info($report_id)
    {
        $data['type'] 		= $this->input->post('type');
        $data['description']    = $this->input->post('description');
        $data['timestamp']      = strtotime($this->input->post('timestamp'));
        $data['patient_id']     = $this->input->post('patient_id');
        
        $login_type             = $this->session->userdata('login_type');
        if($login_type=='nurse')
            $data['doctor_id']  = $this->input->post('doctor_id');
        else $data['doctor_id'] = $this->session->userdata('login_user_id');
        
        $this->db->where('report_id',$report_id);
        $this->db->update('report',$data);
    }
    
    function delete_report_info($report_id)
    {
        $this->db->where('report_id',$report_id);
        $this->db->delete('report');
    }*/
    
    function save_bed_info()
    {
        $data['hospital_id']=$this->input->post('hospital');
        $data['branch_id']=$this->input->post('branch');
        $data['department_id']=$this->input->post('department');
        $data['ward_id']=$this->input->post('ward');
        $data['name'] 		= $this->input->post('name');
        $data['bed_status']    = $this->input->post('bed_status');
        
        $this->db->insert('bed',$data);
    }
    function select_beds_info()
    {
        $account_type=$this->session->userdata('login_type');
        if($account_type == 'hospitaladmins'){
        return $this->db->where('hospital_id',$this->session->userdata('hospital_id'))->get('bed')->result_array();
        }elseif($account_type == 'nurse'){
        return $this->db->where('hospital_id',$this->session->userdata('hospital_id'))->get('bed')->result_array();
        }
    }
    function select_report_info()
    {
        $account_type=$this->session->userdata('login_type');
        if($account_type == 'superadmin'){
        return $this->db->get_where('hospitals')->result_array();
        }elseif($account_type == 'hospitaladmins'){
        return $this->db->where('hospital_id',$this->session->userdata('hospital_id'))->get('branch')->result_array();
        }
    }
    
    function update_bed_info($bed_id)
    {
        $data['hospital_id']=$this->input->post('hospital');
        $data['branch_id']=$this->input->post('branch');
        $data['department_id']=$this->input->post('department');
        $data['ward_id']=$this->input->post('ward');
        $data['name']       = $this->input->post('name');
        $data['bed_status']    = $this->input->post('bed_status');
        $this->db->where('bed_id',$bed_id);
        $this->db->update('bed',$data);
    }
    
    function delete_bed_info($bed_id)
    {
        $this->db->where('bed_id',$bed_id);
        $this->db->delete('bed');
    }
     function delete_multiple_bed_info()
    {
        $check=$_POST['check'];
        for($i=0;$i<count($check);$i++){
            $this->db->where('bed_id',$check[$i]);
            $this->db->delete('bed');
        }
    }
    /*function save_blood_donor_info()
    {
        $data['name']                       = $this->input->post('name');
        $data['email']                      = $this->input->post('email');
        $data['address']                    = $this->input->post('address');
        $data['phone']                      = $this->input->post('phone');
        $data['sex']                        = $this->input->post('sex');
        $data['age']                        = $this->input->post('age');
        $data['blood_group']                = $this->input->post('blood_group');
        $data['last_donation_timestamp']    = strtotime($this->input->post('last_donation_timestamp'));
        
        $this->db->insert('blood_donor',$data);
    }
    
    function select_blood_donor_info()
    {
        return $this->db->get('blood_donor')->result_array();
    }
    
    function update_blood_donor_info($blood_donor_id)
    {
        $data['name']                       = $this->input->post('name');
        $data['email']                      = $this->input->post('email');
        $data['address']                    = $this->input->post('address');
        $data['phone']                      = $this->input->post('phone');
        $data['sex']                        = $this->input->post('sex');
        $data['age']                        = $this->input->post('age');
        $data['blood_group']                = $this->input->post('blood_group');
        $data['last_donation_timestamp']    = strtotime($this->input->post('last_donation_timestamp'));
        
        $this->db->where('blood_donor_id',$blood_donor_id);
        $this->db->update('blood_donor',$data);
    }
    
    function delete_blood_donor_info($blood_donor_id)
    {
        $this->db->where('blood_donor_id',$blood_donor_id);
        $this->db->delete('blood_donor');
    }
    
    function save_medicine_category_info()
    {
        $data['name'] 		= $this->input->post('name');
        $data['description']    = $this->input->post('description');
        
        $this->db->insert('medicine_category',$data);
    }
    
    function select_medicine_category_info()
    {
        return $this->db->get('medicine_category')->result_array();
    }
    
    function update_medicine_category_info($medicine_category_id)
    {
        $data['name'] 		= $this->input->post('name');
        $data['description'] 	= $this->input->post('description');
        
        $this->db->where('medicine_category_id',$medicine_category_id);
        $this->db->update('medicine_category',$data);
    }*/
    
    /*function delete_medicine_category_info($medicine_category_id)
    {
        $this->db->where('medicine_category_id',$medicine_category_id);
        $this->db->delete('medicine_category');
    }*/
    
    /*function save_medicine_info()
    {
        $data['name']                   = $this->input->post('name');
        $data['medicine_category_id']   = $this->input->post('medicine_category_id');
        $data['description']            = $this->input->post('description');
        $data['price']                  = $this->input->post('price');
        $data['manufacturing_company']  = $this->input->post('manufacturing_company');
        $data['status'] 		= $this->input->post('status');
        
        $this->db->insert('medicine',$data);
    }*/
    
    /*function select_medicine_info()
    {
        return $this->db->get('medicine')->result_array();
    }
    
    function update_medicine_info($medicine_id)
    {
        $data['name']                   = $this->input->post('name');
        $data['medicine_category_id']   = $this->input->post('medicine_category_id');
        $data['description']            = $this->input->post('description');
        $data['price']                  = $this->input->post('price');
        $data['manufacturing_company']  = $this->input->post('manufacturing_company');
        $data['status'] 		= $this->input->post('status');
        
        $this->db->where('medicine_id',$medicine_id);
        $this->db->update('medicine',$data);
    }*/
    
    /*function delete_medicine_info($medicine_id)
    {
        $this->db->where('medicine_id',$medicine_id);
        $this->db->delete('medicine');
    }*/
    
    function save_appointment_info()
    {
        $time=explode('-',$this->input->post('available_slot'));
        $department=$this->db->where('doctor_id',$this->input->post('doctor_id'))->get('doctors')->row();
        $data['user_id']       = $this->input->post('user_id');
        $data['doctor_id']       = $this->input->post('doctor_id');
        $data['appointment_date']= $this->input->post('appointment_date');
        $data['hospital_id']       = $department->hospital_id;
        $data['department_id']       = $department->department_id;
        $data['appointment_time_start']       = date("H:i", strtotime($time[0]));
        $data['appointment_time_end']       = date("H:i", strtotime($time[1]));
        $data['reason']       = $this->input->post('reason');
        if($this->input->post('remarks')){
        $data['remarks']       = $this->input->post('remarks');
        }

        $data['created_by']       = $this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id');
        $data['created_at']=date('Y-m-d H:i:s');
        $data['modified_at']=date('Y-m-d H:i:s');
        /***********************/
   /*$patient_data['user_id']=$this->input->post('user_id');
    $patient=$this->db->where('user_id',$patient_data['user_id'])->get('patient')->row_array();
if($patient==''){
$patient_data['doctor_ids']=$this->input->post('doctor_id');
$patient_data['hospital_ids']=$department->hospital_id;
$this->db->insert('patient',$patient_data);
}elseif($patient!=''){
if($patient['hospital_ids']==''){
$patient_data['hospital_ids']=$department->hospital_id;
}elseif($patient['hospital_ids']!=''){
$hos_ar=explode(',',$patient['hospital_ids']);
    for($ho=0;$ho<count($hos_ar);$ho++){
    if($hos_ar[$ho]==$department->hospital_id){
    $patient_data['hospital_ids']=$patient['hospital_ids'];
    break;
    }else{
    $patient_data['hospital_ids']=$hos_ar[$ho].','.$department->hospital_id;
    }
    }
}
if($patient['doctor_ids']==''){
$patient_data['doctor_ids']=$this->input->post('doctor_id');
}elseif($patient['doctor_ids']!=''){
$doc_ar=explode(',',$patient['doctor_ids']);
    for($ho=0;$ho<count($doc_ar);$ho++){
    if($doc_ar[$ho]==$this->input->post('doctor_id')){
    $patient_data['doctor_ids']=$patient['doctor_ids'];
    break;
    }else{
    $patient_data['doctor_ids']=$patient['doctor_ids'].','.$this->input->post('doctor_id');
    }
    }
}
}print_r($patient_data);die;*/
        /*****************************/
        $insert=$this->db->insert('appointments',$data);
        
        if($insert)
        {
            $lid=$this->db->insert_id();
        /******Notification Message******/
        /*$notification['user_id']='users-user-'.$data['user_id'];
        $notification['title']='Appointment Booking';
        $notification['text']='Hi User Your Appointment is Booked Please Wait For The Confirmation.';
        $this->db->insert('notification',$notification);*/


        /*********** Patient **************/
     $patient_data['user_id']=$this->input->post('user_id');
    $patient=$this->db->where('user_id',$patient_data['user_id'])->get('patient')->row_array();
if($patient==''){
$patient_data['doctor_ids']=$this->input->post('doctor_id');
$patient_data['hospital_ids']=$department->hospital_id;
$this->db->insert('patient',$patient_data);
}elseif($patient!=''){
if($patient['hospital_ids']==''){
$patient_data['hospital_ids']=$department->hospital_id;
}elseif($patient['hospital_ids']!=''){
$hos_ar=explode(',',$patient['hospital_ids']);
    for($ho=0;$ho<count($hos_ar);$ho++){
    if($hos_ar[$ho]==$department->hospital_id){
    $patient_data['hospital_ids']=$patient['hospital_ids'];
    break;
    }else{
    $patient_data['hospital_ids']=$hos_ar[$ho].','.$department->hospital_id;
    }
    }
}
if($patient['doctor_ids']==''){
$patient_data['doctor_ids']=$this->input->post('doctor_id');
}elseif($patient['doctor_ids']!=''){
$doc_ar=explode(',',$patient['doctor_ids']);
    for($ho=0;$ho<count($doc_ar);$ho++){
    if($doc_ar[$ho]==$this->input->post('doctor_id')){
    $patient_data['doctor_ids']=$patient['doctor_ids'];
    break;
    }else{
    $patient_data['doctor_ids']=$patient['doctor_ids'].','.$this->input->post('doctor_id');
    }
    }
}
$this->db->where('user_id',$this->input->post('user_id'));
$this->db->update('patient',$patient_data);
}
        /********Appointment Unique Id Generate*****************/
            $num=100000+$lid;
            $pid='MPA'.date('y').'_'.$num;
            $this->db->where('appointment_id',$lid)->update('appointments',array('appointment_number'=>$pid,'status'=>2));
            $history['appointment_id']=$lid;
            $history['appointment_date']=$data['appointment_date'];
            $history['appointment_time_start']=$data['appointment_time_start'];
            $history['appointment_time_end']=$data['appointment_time_end'];
            $history['created_time']=date('Y-m-d H:i:s');
            $history['created_by']=$data['created_by'];
            $history_ins=$this->db->insert('appointment_history',$history);
            if($history_ins){
                $last_id=$this->db->insert_id();
                $this->db->where('appointment_history_id',$last_id)->update('appointment_history',array('action'=>1));

            $doctor=$this->db->where('doctor_id',$data['doctor_id'])->get('doctors')->row();
            $appointments=$this->db->where('appointment_id',$lid)->get('appointments')->row();
            /*$notification['title']='Appointment Booking Confirmation';
            $notification['text']='Hi User Your Appointment is Confirmed <br/> Appointment Date : '.date('M d,Y',$history['appointment_date']).', <br/>Appointment Time : '. date('h:i A',strtotime($appointments->appointment_time_start)).' - '.date('h:i A',strtotime($appointments->appointment_time_end)).',<br/>Appointment ID : '. $pid.',<br/>Appointment With : Dr.'.$doctor->name.',<br/> Doctor ID : '.$doctor->unique_id.',<br/> From '.$this->db->where('hospital_id',$doctor->hospital_id)->get('hospitals')->row()->name.'.';
         $this->db->insert('notification',$notification);*/
            }
        }
    }
    function update_appointment_info($appointment_id='')
    {
    if($this->input->post('available_slot')!=''){
    $time=explode('-',$this->input->post('available_slot'));
    $data['appointment_time_start']       = date("H:i", strtotime($time[0]));
    $data['appointment_time_end']       = date("H:i", strtotime($time[1]));
    }
    $data['appointment_date']= $this->input->post('appointment_date');
    $yes=$this->db->where('appointment_id',$appointment_id)->update('appointments',$data);
    if($yes){
        /*******Appointment History********/
        $history['appointment_id']=$appointment_id;
            $history['appointment_date']=$data['appointment_date'];
            $history['appointment_time_start']=$data['appointment_time_start'];
            $history['appointment_time_end']=$data['appointment_time_end'];
            $history['created_by']=$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id');
            $data['created_time']=date('Y-m-d H:i:s');
            $history_ins=$this->db->insert('appointment_history',$history);
            if($history_ins){
                $last_id=$this->db->insert_id();
                $this->db->where('appointment_history_id',$last_id)->update('appointment_history',array('action'=>5));
            }
         /******Notification Message******/
          /*  $notification['created_by']=$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id');
            $notification['user_id']='users-user-'.$this->input->post('user_id');
            $notification['title']='Appointment Rescheduled     ';
            $notification['text']='Hi User Your Appointment is Booked Please Wait For The Confirmation.';
         $this->db->insert('notification',$notification);*/
    }
    }
    /*function save_requested_appointment_info()
    {
        $data['timestamp']  = strtotime($this->input->post('date_timestamp').' '.$this->input->post('time_timestamp') );
        $data['doctor_id']  = $this->input->post('doctor_id');
        $data['patient_id'] = $this->session->userdata('login_user_id');
        $data['status']     = 'pending';
        
        $this->db->insert('appointment',$data);
    }*/
    
    /*function select_appointment_info_by_doctor_id()
    {
        $doctor_id = $this->session->userdata('login_user_id');
        
        $this->db->order_by('timestamp' , 'desc');
        $this->db->where('doctor_id' , $doctor_id);
        $this->db->where('status' , 'approved');
        
        return $this->db->get('appointment')->result_array();
    }
    
    function select_appointment_info_by_patient_id()
    {
        $patient_id = $this->session->userdata('login_user_id');
        return $this->db->get_where('appointment', array('patient_id' => $patient_id, 'status' => 'approved'))->result_array();
    }*/
    function select_appointment_info($doctor_id = '', $start_timestamp = '', $end_timestamp = '')
    {
      $account_type=$this->session->userdata('login_type');
if($account_type == 'superadmin'){
  return $this->db->order_by('appointment_number','DESC')->get('appointments')->result_array();
}elseif($account_type == 'hospitaladmins'){
  return $this->db->order_by('appointment_number','DESC')->where('hospital_id',$this->session->userdata('hospital_id'))->get('appointments')->result_array();
}elseif($account_type == 'doctors'){
  return $this->db->order_by('appointment_number','DESC')->where('doctor_id',$this->session->userdata('login_user_id'))->get('appointments')->result_array();
}elseif($account_type == 'users'){
  return $this->db->order_by('appointment_number','DESC')->where('user_id',$this->session->userdata('login_user_id'))->get('appointments')->result_array();
}elseif($account_type == 'receptionist'){
    $receptionist=$this->db->where('receptionist_id',$this->session->userdata('login_user_id'))->get('receptionist')->row();
    $doctor_id=explode(',',$receptionist->doctor_id);
for($doc=0;$doc<count($doctor_id);$doc++){
  $result=$this->db->order_by('appointment_number','DESC')->where('doctor_id',$doctor_id[$doc])->get('appointments')->row_array();
  if($result!=''){
    $return[]=$result;
  }
}
return $return;
}elseif($account_type == 'nurse'){
    $nurse=$this->db->where('nurse_id',$this->session->userdata('login_user_id'))->get('nurse')->row();
    $doctor_id=explode(',',$nurse->doctor_id);
for($doc=0;$doc<count($doctor_id);$doc++){
  $result=$this->db->order_by('appointment_number','DESC')->where('doctor_id',$doctor_id[$doc])->get('appointments')->row_array();
  if($result!=''){
    $return[]=$result;
  }
}
return $return;
}
    }
function select_upcoming_appointments(){
    $id=$this->session->userdata('login_user_id');
return $this->db->get_where('appointments',array('user_id'=>$id,'appointment_date>='=>date('m/d/Y')))->result_array();
    }
function select_recommend_appointments(){
    $id=$this->session->userdata('login_user_id');
return $this->db->get_where('appointments',array('user_id'=>$id,'next_appointment!='=>'','next_appointment>='=>date('m/d/Y')))->result_array();
    }
    
function select_today_appointment_info_by_doctor(){
return $this->db->get_where('appointments',array('doctor_id'=>$this->session->userdata('login_user_id'),'appointment_date'=>date('m/d/Y')))->result_array();
    }
function select_appointment_info_by_date($sd = '', $ed = '')
    {
/*        $this->db->where('created_date >=', date('m/d/Y',strtotime($_GET['sd'])));
        $this->db->where('created_date <=', date('m/d/Y',strtotime($_GET['ed'])));*/
return $this->db->get_where('appointments',array('doctor_id'=>$this->session->userdata('login_user_id'),'appointment_date >='=>date('m/d/Y',strtotime($sd)),'appointment_date <='=>date('m/d/Y',strtotime($ed))))->result_array();
    }
/*function select_appointment_info($doctor_id = '', $start_timestamp = '', $end_timestamp = '')
    {
        $response = array();
        if($doctor_id == 'all') {
            $this->db->order_by('doctor_id', 'asc');
            $this->db->order_by('timestamp', 'desc');
            $appointments = $this->db->get_where('appointment', array('status' => 'approved'))->result_array();
            foreach ($appointments as $row) {
                if($row['appointment_date'] >= $start_timestamp && $row['appointment_date'] <= $end_timestamp)
                    array_push ($response, $row);
            }
        }else {
            $this->db->order_by('timestamp', 'desc');
            $appointments = $this->db->get_where('appointment', array('doctor_id' => $doctor_id, 'status' => 'approved'))->result_array();
            foreach ($appointments as $row) {
                if($row['timestamp'] >= $start_timestamp && $row['timestamp'] <= $end_timestamp)
                    array_push ($response, $row);
            }
        }
        return $response;
    }*/
    
    /*function select_pending_appointment_info_by_patient_id()
    {
        $patient_id = $this->session->userdata('login_user_id');
        return $this->db->get_where('appointment', array('patient_id' => $patient_id, 'status' => 'pending'))->result_array();
    }
    
    function select_requested_appointment_info_by_doctor_id()
    {
        $doctor_id = $this->session->userdata('login_user_id');
        return $this->db->get_where('appointment', array('doctor_id' => $doctor_id, 'status' => 'pending'))->result_array();
    }
    
    function select_requested_appointment_info()
    {
        $this->db->order_by('doctor_id', 'asc');
        return $this->db->get_where('appointment', array('status' => 'pending'))->result_array();
    }
    
    function select_patient_info_by_doctor_id()
    {
        $doctor_id = $this->session->userdata('login_user_id');
        
        $this->db->group_by('patient_id');
        return $this->db->get_where('appointment', array('doctor_id' => $doctor_id, 'status' => 'approved'))->result_array();
    }*/
    
    /*function select_appointments_between_loggedin_patient_and_doctor()
    {
        $patient_id = $this->session->userdata('login_user_id');
        
        $this->db->group_by('doctor_id');
        return $this->db->get_where('appointment', array('patient_id' => $patient_id, 'status' => 'approved'))->result_array();
    }
    */
    /*function update_appointment_info($appointment_id)
    {
        $data['timestamp']  = strtotime($this->input->post('date_timestamp').' '.$this->input->post('time_timestamp') );
        $data['patient_id'] = $this->input->post('patient_id');
        
        $this->db->where('appointment_id',$appointment_id);
        $this->db->update('appointment',$data);
        
        // Notify patient with sms.
        $notify = $this->input->post('notify');
        if($notify != '') {
            $doctor_id      =   $this->session->userdata('login_user_id');
            $patient_name   =   $this->db->get_where('patient',
                                array('patient_id' => $data['patient_id']))->row()->name;
            $doctor_name    =   $this->db->get_where('doctor',
                                array('doctor_id' => $doctor_id))->row()->name;
            $date           =   date('l, d F Y', $data['timestamp']);
            $time           =   date('g:i a', $data['timestamp']);
            $message        =   $patient_name . ', your appointment with doctor ' . $doctor_name . ' has been updated to ' . $date . ' at ' . $time . '.';
            $receiver_phone =   $this->db->get_where('patient',
                                array('patient_id' => $data['patient_id']))->row()->phone;
            
            $this->sms_model->send_sms($message, $receiver_phone);
        }
    }*/
    
   /* function approve_appointment_info($appointment_id)
    {
        $data['timestamp']  = strtotime($this->input->post('date_timestamp').' '.$this->input->post('time_timestamp') );
        $data['status']     = 'approved';
        
        if($this->session->userdata('login_type') == 'receptionist')
            $data['doctor_id'] = $this->input->post('doctor_id');
        
        $this->db->where('appointment_id',$appointment_id);
        $this->db->update('appointment',$data);
        
        // Notify patient with sms.
        $notify = $this->input->post('notify');
        if($notify != '') {
            $doctor_id      =   $this->db->get_where('appointment',
                                array('appointment_id' => $appointment_id))->row()->doctor_id;
            $patient_id     =   $this->db->get_where('appointment',
                                array('appointment_id' => $appointment_id))->row()->patient_id;
            $patient_name   =   $this->db->get_where('patient',
                                array('patient_id' => $patient_id))->row()->name;
            $doctor_name    =   $this->db->get_where('doctor',
                                array('doctor_id' => $doctor_id))->row()->name;
            $date           =   date('l, d F Y', $data['timestamp']);
            $time           =   date('g:i a', $data['timestamp']);
            $message        =   $patient_name . ', your requested appointment with doctor ' . $doctor_name . ' on ' . $date . ' at ' . $time . ' has been approved.';
            $receiver_phone =   $this->db->get_where('patient',
                                array('patient_id' => $patient_id))->row()->phone;
            
            $this->sms_model->send_sms($message, $receiver_phone);
        }
    }*/
    function recommend_inpatient($user_id)
    {
    $data['user_id']       = $user_id;
    $data['doctor_id']       = $this->session->userdata('login_user_id');
    $data['hospital_id']       = $this->session->userdata('hospital_id');
    $data['status']       = 0;
    $data['created_by']       = $this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id');
    $data['created_date']=date('Y-m-d H:i:s');
    $insert=$this->db->insert('inpatient',$data);
        if($insert)
        {
            $lid=$this->db->insert_id();
            if($data['status'] == 0){$status='recommended';}elseif($data['status'] == 1){$status='Admitted';}elseif($data['status'] == 0){$status='Not Admitted';}
            /******Notification Message******/
            /*$notification['created_by']=$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id');
            $notification['user_id']='users-user-'.$data['user_id'];
            $notification['title']='Registered As In-Patient';
            $notification['text']='Hi User Your Considered As In-Patient Your Current Status is '.$status.'.';
         $this->db->insert('notification',$notification);*/
         $in_patient['in_patient_id']=$lid;
         $in_patient['created_date']=$data['created_date'];
         $in_patient['note']='Joined As In-Patient and Status as '.$status.'.';
         $this->db->insert('inpatient_history',$in_patient);
        }
        return TRUE;
    }
    function delete_appointment_info($appointment_id)
    {
        $this->db->where('appointment_id',$appointment_id);
        $this->db->delete('appointments');
    }
     function delete_multiple_appointment_info()
    {
        $check=$_POST['check'];
        for($i=0;$i<count($check);$i++){
            $this->db->where('appointment_id',$check[$i]);
            $this->db->delete('appointments');
        }
    }
     function close_multiple_appointment_info()
    {
        $check=$_POST['check'];
        for($i=0;$i<count($check);$i++){
        $this->db->where('appointment_id',$check[$i]);
        $this->db->update('appointments',array('status'=>'4'));
        $this->db->insert('appointment_history',array('appointment_id'=>$check[$i],'action'=>7,'created_type'=>'System','created_by'=>'MyPulse'));
        }
        return TRUE;
    }
    function cancel_multiple_appointment_info()
    {
        $account_details=$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id');
        $check=$_POST['check'];
        $reason=$_POST['cancel_reason'];
        for($i=0;$i<count($check);$i++){
        $this->db->where('appointment_id',$check[$i]);
        $this->db->where('status',2);
        $s=$this->db->update('appointments',array('status'=>'3','remarks'=>'Canceled By The Reason " '.$reason.'" '));

        if($s){
        $this->db->insert('appointment_history',array('appointment_id'=>$check[$i],'action'=>6,'created_by'=>$account_details,'reason'=>$reason));
            /**********Notification***********/
    $appointment_data=$this->db->where('appointment_id',$check[$i])->get('appointments')->row_array();
        $user_id[]='users-user-'.$appointment_data['user_id'];
        $user_id[]='doctors-doctor-'.$appointment_data['doctor_id'];
        $notification['title']='Appointment Canceled';
        $notification['text']='Hi User Your Appointment Canceled The Reason " '.$reason.' " .';
    for($u=0;$u<count($user_id);$u++){
        $notification['user_id']=$user_id[$u];
        $this->db->insert('notification',$notification);
        }
    /**********End Notification***********/
        }
    }
        return TRUE;
    }
    function update_appointment_remark($id='')
    {
        $data['remarks']     = $this->input->post('remark');
        $data['next_appointment']     = $this->input->post('next_appointment');
        $this->db->where('appointment_id',$id)->update('appointments',$data);
    }
    function save_prescription_info()
    {
        $data['user_id']= $this->input->post('user_id');
        $data['doctor_id']= $this->session->userdata('login_user_id');
        $drugs=$this->input->post('drug');
        for($i=0;$i<count($drugs);$i++){
            if($drugs[$i] != ''){
    $drug[]=$this->input->post('drug')[$i];
    $strength[]=$this->input->post('strength')[$i];
    $dosage[]=$this->input->post('dosage')[$i];
    $duration[]=$this->input->post('duration')[$i];
    $quantity[]=$this->input->post('quantity')[$i];
    $note[]=$this->input->post('note')[$i];
            }
        }
        $test_titles=$this->input->post('test_title');
        for($i=0;$i<count($test_titles);$i++){
            if($drugs[$i] != ''){
    $test_title[]=$this->input->post('test_title')[$i];
    $description[]=$this->input->post('description')[$i];
            }
        }
        $data['prescription_data'] =$this->encryption->encrypt($this->input->post('title').'|'.implode(',',$drug).'|'.implode(',',$strength).'|'.implode(',',$dosage).'|'.implode(',',$duration).'|'.implode(',',$quantity).'|'.implode(',',$note).'|'.implode(',',$test_title).'|'.implode(',',$description).'|'.$this->input->post('additional_note'));
        $data['created_at']=date('Y-m-d H:i:s');
        $this->db->insert('prescription',$data);
    }
    function update_prescription_info($prescription_id='')
    {
        $data['user_id']     = $this->input->post('user_id');
        $data['doctor_id']      = $this->input->post('doctor_id');
        $drugs=$this->input->post('drug');
        for($i=0;$i<count($drugs);$i++){
            if($drugs[$i] != ''){
    $drug[]=$this->input->post('drug')[$i];
    $strength[]=$this->input->post('strength')[$i];
    $dosage[]=$this->input->post('dosage')[$i];
    $duration[]=$this->input->post('duration')[$i];
    $quantity[]=$this->input->post('quantity')[$i];
    $note[]=$this->input->post('note')[$i];
            }
        }
        $test_titles=$this->input->post('test_title');
        for($i=0;$i<count($test_titles);$i++){
            if($drugs[$i] != ''){
    $test_title[]=$this->input->post('test_title')[$i];
    $description[]=$this->input->post('description')[$i];
            }
        }
         $data['prescription_data'] =$this->encryption->encrypt($this->input->post('title').'|'.implode(',',$drug).'|'.implode(',',$strength).'|'.implode(',',$dosage).'|'.implode(',',$duration).'|'.implode(',',$quantity).'|'.implode(',',$note).'|'.implode(',',$test_title).'|'.implode(',',$description).'|'.$this->input->post('additional_note'));
        $data['modified_at']=date('Y-m-d H:i:s');
        $this->db->where('prescription_id',$prescription_id);
        $this->db->update('prescription',$data);
    }
    function select_prescription_info()
    {
        $user_id = $this->session->userdata('login_user_id');
        return $this->db->get_where('prescription', array('user_id' => $user_id))->result_array();
    }
    function select_prescription_information($prescription_id='')
    {
        return $this->db->get_where('prescription', array('prescription_id' => $prescription_id))->row_array();
    }
    function delete_prescription($prescription_id)
    {
        $this->db->where('prescription_id',$prescription_id);
        $this->db->delete('prescription');
    }
    function update_prescription_status($prescription_id='',$status='')
    {
        $data['status']=$status;
        $this->db->where('prescription_id',$prescription_id);
        $this->db->update('prescription',$data);
    }
    function upload_prescription_receipt($order_type){
        $order_id=$this->input->post('order_id');
        if($this->input->post('cost')!=''){
        $data['cost']= implode(',',$this->input->post('cost'));
        }
        $data['price']= implode(',',$this->input->post('price'));
        $data['total']=$this->input->post('total');
        $data['receipt_created_at']=date('Y-m-d H:i:s');
        $this->db->where('order_id',$order_id);
        $s=$this->db->update('prescription_order',$data);
        if($s){
        $this->db->where('order_id',$order_id)->update('prescription_order',array('status'=>1));
        for($j=0;$j<count($_FILES["userfile"]["name"]);$j++){
            $report['order_id']=$order_id;
            $report['created_at']=date('Y-m-d H:i:s');
            $report['extension']=end(explode('.',$_FILES["userfile"]["name"][$j]));
            $insert=$this->db->insert('reports',$report);
            if($insert){
            $lid=$this->db->insert_id();
            move_uploaded_file($_FILES["userfile"]["tmp_name"][$j], "uploads/reports/" . $lid . '.'.$report['extention']);
            }
        }
        }     
    }
    function select_prognosis_info()
    {
        $user_id = $this->session->userdata('login_user_id');
        return $this->db->get_where('prognosis', array('user_id' => $user_id))->result_array();
    }
    function select_prognosis_information($prognosis_id='')
    {
        return $this->db->get_where('prognosis', array('prognosis_id' => $prognosis_id))->row_array();
    }
    function save_prognosis_info()
    {
        $data['user_id']     = $this->input->post('user_id');
        $data['doctor_id']      = $this->input->post('doctor_id');
        $data['prognosis_data']     = $this->encryption->encrypt($this->input->post('title').'|'.$this->input->post('case_history'));
        $data['created_at']=date('Y-m-d H:i:s');
        $this->db->insert('prognosis',$data);
    }
    function update_prognosis_info($prognosis_id='')
    {
        $data['prognosis_data']     = $this->encryption->encrypt($this->input->post('title').'|'.$this->input->post('case_history'));
        /*$data['title']     = $this->encryption->encrypt($this->input->post('title'));
        $data['case_history']     = $this->encryption->decrypt($this->input->post('case_history'));*/
        $data['modified_at']=date('Y-m-d H:i:s');
        $this->db->where('prognosis_id',$prognosis_id);
        $this->db->update('prognosis',$data);
    }
     function delete_prognosis($prognosis_id)
    {
        $this->db->where('prognosis_id',$prognosis_id);
        $this->db->delete('prognosis');
    }
    function update_prognosis_status($prognosis_id='',$status='')
    {
        $data['status']=$status;
        $this->db->where('prognosis_id',$prognosis_id);
        $this->db->update('prognosis',$data);
    }
    function save_medical_reports()
    {
        $account_details=$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id');
        $data['created_by']=$account_details;
        $data['user_id'] = $this->input->post('user_id');
        $data['order_type']='1';
      
        for($j=0;$j<count($_FILES["report"]["name"]);$j++){
            if($this->input->post('title')[$j] !=''){
            $data['title']=$this->input->post('title')[$j];
            $data['created_at']=date('Y-m-d H:i:s');
            $data['extension']=end(explode('.',$_FILES["report"]["name"][$j]));
            $insert=$this->db->insert('reports',$data);
            if($insert){
            $lid=$this->db->insert_id();
            move_uploaded_file($_FILES["report"]["tmp_name"][$j], "uploads/reports/". $lid.'.'.$data['extension']);
            }
        }
        }
        
    }
    function select_medical_reports()
    {
        $user_id = $this->session->userdata('login_user_id');
       return $this->db->get_where('prescription_order',array('user_id'=>$user_id,'order_type'=>1,'status'=>1))->result_array();
    }
    function select_medical_reports_information($order_id='')
    {
        return $this->db->get_where('reports', array('order_id' => $order_id))->result_array();
    }
    function delete_medical_reports($report_id)
    {
        $this->db->where('report_id',$report_id);
        $this->db->delete('reports');
    }
    function update_medical_reports_status($report_id='',$status='')
    {
        $data['status']=$status;
        $this->db->where('report_id',$report_id);
        $this->db->update('reports',$data);
        
    }

    function save_prescription_order($id='')
    {
        $data['user_id']     = $this->input->post('user_id');
        $data['prescription_id']     = $this->input->post('prescription_id');
        $data['order_type']     = $id;
        if($id == 0){
        $data['quantity']     = implode(',',$this->input->post('quantity'));
        $data['store_id']     = $this->input->post('store');
        }
        if($id == 1){
            $te=$this->input->post('tests');
            for($c=0;$c<$_POST['count'];$c++){
            if($te[$c]!=''){
                $st[$c]=1;
            }else{
                $st[$c]=0;
            }
            }
        $data['tests']     = implode(',',$st);
        $data['lab_id']     = $this->input->post('lab');
        }
        $data['created_at']=date('Y-m-d H:i:s');
        $yes=$this->db->insert('prescription_order',$data);
        if($yes){
            /*********** Patient **************/
        $patient_data['user_id']=$this->input->post('user_id');
        $patient=$this->db->where('user_id',$patient_data['user_id'])->get('patient');
        if($patient->num_rows()==1){
            if($id == 0){
        $hos=$patient->row()->store_ids;
        $hos_ar=explode(',', $hos);
        for($ho=0;$ho<count($hos_ar);$ho++){
            if($hos_ar[$ho] == $data['store_id']){
                $s1='1';
            }else{
                $s1='0';
            }
        }
        if($s1==0){
    $patient_data['store_ids']=$hos.','.$data['store_id']; 
        }
        }
        if($id == 1){
        $hos=$patient->row()->lab_ids;
        $hos_ar=explode(',', $hos);
        for($ho=0;$ho<count($hos_ar);$ho++){
            if($hos_ar[$ho] == $data['lab_id']){
                $s1='1';
            }else{
                $s1='0';
            }
        }
        if($s1==0){
    $patient_data['lab_ids']=$hos.','.$data['lab_id']; 
        }
        }
        $this->db->where('user_id',$this->input->post('user_id'));
        $this->db->update('patient',$patient_data);
        }else{
        if($id == 0){
        $patient_data['store_ids']=$this->input->post('store');
        }
        if($id == 1){
        $patient_data['lab_ids']=$this->input->post('lab');
        }
        $this->db->insert('patient',$patient_data);
        }
           if($id == 0){
        $data1['medicin_status']     = 1;
        }
        if($id == 1){
        $data1['test_status']     = 1;
        }
        $this->db->where('prescription_id',$data['prescription_id'])->update('prescription',$data1);
        }

    }
    function select_order_info()
    {
        $account_type = $this->session->userdata('login_type');
        $user_id = $this->session->userdata('login_user_id');
    if($account_type=='superadmin'){
        return $this->db->order_by('order_id','DESC')->get('prescription_order')->result_array();
    }
    if($account_type=='hospitaladmins'){
        return $this->db->order_by('order_id','DESC')->get_where('prescription_order', array('user_id' => $this->session->userdata('hospital_id')))->result_array();
    }
    if($account_type=='users'){
        return $this->db->order_by('order_id','DESC')->get_where('prescription_order', array('user_id' => $user_id))->result_array();
    }
    if($account_type=='medicalstores'){
        return $this->db->order_by('order_id','DESC')->get_where('prescription_order', array('store_id' => $user_id))->result_array();
    }
    if($account_type=='medicallabs'){
        return $this->db->order_by('order_id','DESC')->get_where('prescription_order', array('lab_id' => $user_id))->result_array();
    }
    }
    function select_outstanding_order_info(){
        $account_type = $this->session->userdata('login_type');
        if($account_type == 'medicalstores'){
       return $this->db->order_by('order_id','desc')->get_where('prescription_order',array('store_id'=>$this->session->userdata('login_user_id'),'status'=>2))->result_array();
        }
        if($account_type == 'medicallabs'){
        return $this->db->order_by('order_id','desc')->get_where('prescription_order',array('lab_id'=>$this->session->userdata('login_user_id'),'status'=>2))->result_array();
        }
    }
    function select_completed_order_info(){
        $account_type = $this->session->userdata('login_type');
        if($account_type == 'medicalstores'){
       return $this->db->order_by('order_id','desc')->get_where('prescription_order',array('store_id'=>$this->session->userdata('login_user_id'),'status'=>1))->result_array();
        }
        if($account_type == 'medicallabs'){
        return $this->db->order_by('order_id','desc')->get_where('prescription_order',array('lab_id'=>$this->session->userdata('login_user_id'),'status'=>1))->result_array();
        }
    }
    function select_order_info_id($order_id=''){
return $this->db->get_where('prescription_order',array('order_id'=>$order_id))->row_array(); 
    }
    function book_order($order_type){
    $data['user_id']=$this->session->userdata('login_user_id');
    $data['order_type']=$order_type;
    $data['type_of_order']=1;
    if($order_type==0){
    $data['store_id']=$this->input->post('store');
    $data['order_data'] =$this->encryption->encrypt($this->input->post('title').'|'.implode(',',$this->input->post('drug')).'|'.implode(',',$this->input->post('strength')).'|'.implode(',',$this->input->post('quantity')));
    }elseif($order_type==1){
        $data['lab_id']=$this->input->post('lab');
        $data['order_data'] =$this->encryption->encrypt($this->input->post('title').'|'.implode(',',$this->input->post('test_title')).'|'.implode(',',$this->input->post('description')));
    }
    $data['created_at']=date('Y-m-d H:i:s');
   $yes=$this->db->insert('prescription_order',$data);
    if($yes){
            /*********** Patient **************/
        $patient_data['user_id']=$data['user_id'];
        $patient=$this->db->where('user_id',$patient_data['user_id'])->get('patient');
        if($patient->num_rows()==1){
            if($order_type == 0){
        $hos=$patient->row()->store_ids;
        $hos_ar=explode(',', $hos);
        for($ho=0;$ho<count($hos_ar);$ho++){
             if($hos_ar[$ho]==$data['store_id']){
        $patient_data['store_ids']=$hos;
        break;
        }else{
        $patient_data['store_ids']=$hos.','.$data['store_id'];
        }
            /*if($hos_ar[$ho] == $data['store_id']){
                $s1='1';
            }else{
                $s1='0';
            }*/
        }
        /*if($s1==0){
    $patient_data['store_ids']=$hos.','.$data['store_id']; 
        }*/
        }
        if($order_type == 1){
        $hos=$patient->row()->lab_ids;
        $hos_ar=explode(',', $hos);
        for($ho=0;$ho<count($hos_ar);$ho++){
        if($hos_ar[$ho]==$data['lab_id']){
        $patient_data['lab_ids']=$hos;
        break;
        }else{
        $patient_data['lab_ids']=$hos.','.$data['lab_id'];
        }
           /* if($hos_ar[$ho] == $data['lab_id']){
                $s1='1';
            }else{
                $s1='0';
            }*/
        }
      /*  if($s1==0){
    $patient_data['lab_ids']=$hos.','.$data['lab_id']; 
        }*/
        }
        $this->db->where('user_id',$data['user_id']);
        $this->db->update('patient',$patient_data);
        }else{
        if($order_type == 0){
        $patient_data['store_ids']=$this->input->post('store');
        }
        if($order_type == 1){
        $patient_data['lab_ids']=$this->input->post('lab');
        }
        $this->db->insert('patient',$patient_data);
        }
    }
    }
    /*function select_order_info_prescription_id($prescription_id=''){
        $account_type = $this->session->userdata('login_type');
        if($account_type == 'medicalstores'){
       return $this->db->order_by('order_id','desc')->get_where('prescription_order',array('store_id'=>$this->session->userdata('login_user_id'),'status'=>1))->result_array();
        }
        if($account_type == 'medicallabs'){
        return $this->db->order_by('order_id','desc')->get_where('prescription_order',array('lab_id'=>$this->session->userdata('login_user_id'),'status'=>1))->result_array();
        }
    }*/
    /*function save_prescription_info()
    {
        $data['timestamp']      = strtotime($this->input->post('date_timestamp').' '.$this->input->post('time_timestamp') );
        $data['patient_id']     = $this->input->post('patient_id');
        $data['case_history']   = $this->input->post('case_history');
        $data['medication']     = $this->input->post('medication');
        $data['note']           = $this->input->post('note');
        $data['doctor_id']      = $this->session->userdata('login_user_id');
        
        $this->db->insert('prescription',$data);
    }*/
    
    /*function select_prescription_info_by_doctor_id()
    {
        $doctor_id = $this->session->userdata('login_user_id');
        return $this->db->get_where('prescription', array('doctor_id' => $doctor_id))->result_array();
    }
    
    function select_medication_history( $patient_id = '' )
    {
        return $this->db->get_where('prescription', array('patient_id' => $patient_id))->result_array();
    }*/
    
    /*function select_prescription_info_by_patient_id()
    {
        $patient_id = $this->session->userdata('login_user_id');
        return $this->db->get_where('prescription', array('patient_id' => $patient_id))->result_array();
    }
    function select_prescription_info_by_patient($patient_id='')
    {
        //$patient_id = $this->session->userdata('login_user_id');
        return $this->db->get_where('prescription', array('patient_id' => $patient_id))->result_array();
    }
    
    function update_prescription_info($prescription_id)
    {
        $data['timestamp']      = strtotime($this->input->post('date_timestamp').' '.$this->input->post('time_timestamp') );
        $data['patient_id']     = $this->input->post('patient_id');
        $data['case_history']   = $this->input->post('case_history');
        $data['medication']     = $this->input->post('medication');
        $data['note']           = $this->input->post('note');
        $data['doctor_id']      = $this->session->userdata('login_user_id');
        
        $this->db->where('prescription_id',$prescription_id);
        $this->db->update('prescription',$data);
    }
    
    function delete_prescription_info($prescription_id)
    {
        $this->db->where('prescription_id',$prescription_id);
        $this->db->delete('prescription');
    }
    
    function save_diagnosis_report_info()
    {
        $data['timestamp']          = strtotime($this->input->post('date_timestamp').' '.$this->input->post('time_timestamp') );
        $data['report_type']        = $this->input->post('report_type');
        $data['file_name']          = $_FILES["file_name"]["name"];
        $data['document_type']      = $this->input->post('document_type');
        $data['description']        = $this->input->post('description');
        $data['prescription_id']    = $this->input->post('prescription_id');
        
        $this->db->insert('diagnosis_report',$data);
        
        $diagnosis_report_id        = $this->db->insert_id();
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/diagnosis_report/" . $_FILES["file_name"]["name"]);
    }
    
    function select_diagnosis_report_info()
    {
        return $this->db->get('diagnosis_report')->result_array();
    }
    
    function delete_diagnosis_report_info($diagnosis_report_id)
    {
        $this->db->where('diagnosis_report_id',$diagnosis_report_id);
        $this->db->delete('diagnosis_report');
    }*/
    
    /*function read_message($message_type,$message_id)
    {
    if($message_type == 0){
        return $this->db->where('message_id',$message_id)->get('messages')->row_array();
    }elseif($message_type == 1){
        return $this->db->where('message_id',$message_id)->get('private_messages')->row_array();
    }
    }*/
    function read_message($message_id)
    {
    $account_details=$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id');
   $msg=$this->db->where('message_id',$message_id)->get('messages')->row_array();
   if($msg['is_read']==''){
    $data['is_read']=$account_details;
   }elseif($msg['is_read']!=''){
    $message_read=explode(',',$msg['is_read']);
    for($m=0;$m<count($message_read);$m++){
       if($message_read[$m]==$account_details){
        $data['is_read']=$msg['is_read'];
        }else{
        $data['is_read']=$msg['is_read'].','.$account_details;
        }
    }
    }
    $this->db->where('message_id',$message_id)->update('messages',$data);
   return $msg;
    }
    function select_message()
    {
$account_type   = $this->session->userdata('login_type');
$account_details=$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id');
    $message_data=$this->db->order_by('message_id','DESC')->get('messages')->result_array();
    $i=0;$j=0; foreach ($message_data as $row) {
    $created_by=explode('-',$row['created_by']);
    $message1=explode(',',$row['user_to']);
    $message2=explode(',',$row['user_too']);
    $hospi='';
    for($m1=0;$m1<count($message1);$m1++){
    if($message1[$m1] == 1){
    $hospi='hospitaladmins';    
    }elseif($message1[$m1] == 2){
    $hospi='medicallabs';
    }elseif($message1[$m1] == 3){
    $hospi='medicalstores';
    }elseif($message1[$m1] == 4){
    $hospi='doctors';
    }elseif($message1[$m1] == 5){
    $hospi='nurse';
    }elseif($message1[$m1] == 6){
    $hospi='receptionist';
    }elseif($message1[$m1] == 7){
    $hospi='users';
    }
    $hospi1='';
  for($m2=0;$m2<count($message2);$m2++){
    if($message2[$m2] == $account_details){
    $hospi1=$message2[$m2];    
    }
  }
    if($account_type == 'superadmin'){
    if($hospi1 == $account_details || $hospi==$account_type)
              {
             $result[]=$row;   
              }  
    }elseif($created_by[0] != 'doctors'){
    if(($hospi1 == $account_details || $hospi==$account_type) && ($row['hospital_id'] == 0 || $row['hospital_id'] == $this->session->userdata('hospital_id')))
              {
    $result[]=$row;
        }
        }elseif($created_by[0] == 'doctors'){
        $users=$this->crud_model->select_doctor_info();
        foreach ($users as $user) {
    if(($hospi1 == $account_details || $hospi==$account_type) &&  $row['created_by'] == 'doctors-doctor-'.$user['doctor_id'])
        {
        $result[]=$row;
        }
        }
    }
    $i++;}
      }
      return $result;
    }
    /*function select_private_message()
    {
        return $this->db->order_by('message_id','DESC')->get('private_messages')->result_array();
    }*/
        function save_new_message()
    {
        $count=count($this->input->post('reciever'));
        for($i=0;$i<$count;$i++){
            $arr=explode('/', $_POST['reciever'][$i]);
            if($arr[0]=='0'){
                $mess1=0;
                $group[]=$arr[1];
            }elseif($arr[0]=='1'){
                $mess2=1;
                $ind[]=$arr[1];
            }
        }
    $data['user_to']=implode(',',$group);
    $data['user_too']=implode(',',$ind);
    $data['hospital_id']=$this->input->post('hospital_id');;
    $data['title']  = $this->input->post('title');
    $data['message'] = $this->input->post('message');
    $data['created_by'] = $this->session->userdata('login_type').'-'.$this->session->userdata('type_id') . '-' . $this->session->userdata('login_user_id');
    $data['created_at']=date('Y-m-d H:i:s');
    $insert=$this->db->insert('messages',$data);
    }
    function read_notification($notification_id)
    {
        $result=$this->db->where('id',$notification_id)->get('notification')->row_array();
        if($result['isRead']=='2'){
        $this->db->where('id',$notification_id)->update('notification',array('isRead'=>'1'));
        }
        return $result;
    }
    function select_notification()
    {
    $account_type   = $this->session->userdata('login_type');
$account_details=$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id');
    /*$result=*/return $this->db->get_where('notification',array('user_id'=>$account_details))->result_array();
    /*return $result;*/
    }
    function delete_notification($id){
/*$account_type   = $this->session->userdata('login_type');
$account_details=$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id');*/
    $this->db->where('id',$id);
    $this->db->delete('notification');
    }
    function delete_all_notifications(){
$account_type   = $this->session->userdata('login_type');
$account_details=$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id');
    $this->db->where('user_id',$account_details);
    $this->db->delete('notification');
    }
    /*function save_notice_info()
    {
        $data['title']              = $this->input->post('title');
        $data['description']        = $this->input->post('description');
        if($this->input->post('start_timestamp') != '')
            $data['start_timestamp']    = strtotime($this->input->post('start_timestamp'));
        else 
            $data['start_timestamp']    = '';
        if($this->input->post('end_timestamp') != '')
            $data['end_timestamp']      = strtotime($this->input->post('end_timestamp'));
        else
            $data['end_timestamp']      = $data['start_timestamp'];
        
        $this->db->insert('notice',$data);
    }
    
    function select_notice_info()
    {
        return $this->db->get('notice')->result_array();
    }
    
    function update_notice_info($notice_id)
    {
        $data['title']              = $this->input->post('title');
        $data['description']        = $this->input->post('description');
        if($this->input->post('start_timestamp') != '')
            $data['start_timestamp']    = strtotime($this->input->post('start_timestamp'));
        else 
            $data['start_timestamp']    = '';
        if($this->input->post('end_timestamp') != '')
            $data['end_timestamp']      = strtotime($this->input->post('end_timestamp'));
        else
            $data['end_timestamp']      = $data['start_timestamp'];
        
        $this->db->where('notice_id',$notice_id);
        $this->db->update('notice',$data);
    }
    
    function delete_notice_info($notice_id)
    {
        $this->db->where('notice_id',$notice_id);
        $this->db->delete('notice');
    }
    */
   /* ////////private message//////
    function send_new_private_message() {
        $message    = $this->input->post('message');
        $timestamp  = strtotime(date("Y-m-d H:i:s"));

        $reciever   = $this->input->post('reciever');
        $sender     = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');

        //check if the thread between those 2 users exists, if not create new thread
        $num1 = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->num_rows();
        $num2 = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->num_rows();

        if ($num1 == 0 && $num2 == 0) {
            $message_thread_code                        = substr(md5(rand(100000000, 20000000000)), 0, 15);
            $data_message_thread['message_thread_code'] = $message_thread_code;
            $data_message_thread['sender']              = $sender;
            $data_message_thread['reciever']            = $reciever;
            $this->db->insert('message_thread', $data_message_thread);
        }
        if ($num1 > 0)
            $message_thread_code = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->row()->message_thread_code;
        if ($num2 > 0)
            $message_thread_code = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->row()->message_thread_code;


        $data_message['message_thread_code']    = $message_thread_code;
        $data_message['message']                = $message;
        $data_message['sender']                 = $sender;
        $data_message['timestamp']              = $timestamp;
        $this->db->insert('message', $data_message);

        return $message_thread_code;
    }

    function send_reply_message($message_thread_code) {
        $message    = $this->input->post('message');
        $timestamp  = strtotime(date("Y-m-d H:i:s"));
        $sender     = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');


        $data_message['message_thread_code']    = $message_thread_code;
        $data_message['message']                = $message;
        $data_message['sender']                 = $sender;
        $data_message['timestamp']              = $timestamp;
        $this->db->insert('message', $data_message);
    }

    function mark_thread_messages_read($message_thread_code) {
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $this->db->where('sender !=', $current_user);
        $this->db->where('message_thread_code', $message_thread_code);
        $this->db->update('message', array('read_status' => 1));
    }

    function count_unread_message_of_thread($message_thread_code) {
        $unread_message_counter = 0;
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $messages = $this->db->get_where('message', array('message_thread_code' => $message_thread_code))->result_array();
        foreach ($messages as $row) {
            if ($row['sender'] != $current_user && $row['read_status'] == '0')
                $unread_message_counter++;
        }
        return $unread_message_counter;
    }*/
    /*function send_new_private_message() {
        $message    = $this->input->post('message');
        $timestamp  = strtotime(date("Y-m-d H:i:s"));

        $reciever   = $this->input->post('reciever');
        $sender     = $this->session->userdata('login_type').'-'.$this->session->userdata('type_id') . '-' . $this->session->userdata('login_user_id');

        //check if the thread between those 2 users exists, if not create new thread
        $num1 = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->num_rows();
        $num2 = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->num_rows();

        //check if file is attached or not
        if ($_FILES['attached_file_on_messaging']['name'] != "") {
          $data_message['attached_file_name'] = $_FILES['attached_file_on_messaging']['name'];
        }

        if ($num1 == 0 && $num2 == 0) {
            $message_thread_code= substr(md5(rand(100000000, 20000000000)), 0, 15);
            $data_message_thread['message_thread_code'] = $message_thread_code;
            $data_message_thread['sender']              = $sender;
            $data_message_thread['reciever']            = $reciever;
            $this->db->insert('message_thread', $data_message_thread);
        }
        if ($num1 > 0)
            $message_thread_code = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->row()->message_thread_code;
        if ($num2 > 0)
            $message_thread_code = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->row()->message_thread_code;


        $data_message['message_thread_code']    = $message_thread_code;
        $data_message['message']                = $message;
        $data_message['sender']                 = $sender;
        $data_message['timestamp']              = $timestamp;
        $this->db->insert('message', $data_message);

        // notify email to email reciever
        //$this->email_model->notify_email('new_message_notification', $this->db->insert_id());

        return $message_thread_code;
    }

    function send_reply_message($message_thread_code) {
        $message    = $this->input->post('message');
        $timestamp  = strtotime(date("Y-m-d H:i:s"));
        $sender     = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        //check if file is attached or not
        if ($_FILES['attached_file_on_messaging']['name'] != "") {
          $data_message['attached_file_name'] = $_FILES['attached_file_on_messaging']['name'];
        }
        $data_message['message_thread_code']    = $message_thread_code;
        $data_message['message']                = $message;
        $data_message['sender']                 = $sender;
        $data_message['timestamp']              = $timestamp;
        $this->db->insert('message', $data_message);

        // notify email to email reciever
        //$this->email_model->notify_email('new_message_notification', $this->db->insert_id());
    }

    function send_reply_group_message($message_thread_code) {
        $message    = $this->input->post('message');
        $timestamp  = strtotime(date("Y-m-d H:i:s"));
        $sender     = $this->session->userdata('login_type').'-'.$this->session->userdata('type_id') . '-' . $this->session->userdata('login_user_id');
        //check if file is attached or not
        if ($_FILES['attached_file_on_messaging']['name'] != "") {
          $data_message['attached_file_name'] = $_FILES['attached_file_on_messaging']['name'];
        }
        $data_message['group_message_thread_code']    = $message_thread_code;
        $data_message['message']                = $message;
        $data_message['sender']                 = $sender;
        $data_message['timestamp']              = $timestamp;
        $this->db->insert('group_message', $data_message);
    }

    function mark_thread_messages_read($message_thread_code) {
        // mark read only the oponnent messages of this thread, not currently logged in user's sent messages
        $current_user = $this->session->userdata('login_type').'-'.$this->session->userdata('type_id') . '-' . $this->session->userdata('login_user_id');
        $this->db->where('sender !=', $current_user);
        $this->db->where('message_thread_code', $message_thread_code);
        $this->db->update('message', array('read_status' => 1));
    }

    function count_unread_message_of_thread($message_thread_code) {
        $unread_message_counter = 0;
        $current_user = $this->session->userdata('login_type').'-'.$this->session->userdata('type_id') . '-' . $this->session->userdata('login_user_id');
        $messages = $this->db->get_where('message', array('message_thread_code' => $message_thread_code))->result_array();
        foreach ($messages as $row) {
            if ($row['sender'] != $current_user && $row['read_status'] == '0')
                $unread_message_counter++;
        }
        return $unread_message_counter;
    }*/
}
