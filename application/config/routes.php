<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'index';
$route['404_override'] = 'login/four_zero_four';//error/page_missing
$route['translate_uri_dashes'] = FALSE;
//$route['403_override'] = 'login/four_zero_three';
//$routep['uploads/user_image/']='login/four_zero_three';

$route['Privacy&Policy'] ='login/privacy/1';
$route['Terms&Coditions'] ='login/privacy/2';

/*********Login, LogOut, Registration, OTP Cancel, Forgot Password, Set Password.**************/
$route['Login'] ='login';
$route['Register'] ='login/register';
$route['Logout'] ='login/logout';
$route['Forgot_Password'] ='login/forgot_password';
$route['OTP_Cancel'] ='login/register/otp_cancel';
$route['Set_Password/(:any)'] = 'login/set_password';
/*********MyPulse Menus.**************/
$route['Dashboard'] = 'main/dashboard';
$route['Hospitals'] = 'main/hospital';
$route['Hospital_Admins'] = 'main/hospital_admins';
$route['Doctors'] = 'main/doctor';
$route['Receptionists'] = 'main/receptionist';
$route['Nurses'] = 'main/nurse';
$route['Medical_Stores'] = 'main/medical_stores';
$route['Medical_Labs'] = 'main/medical_labs';
$route['MyPulse_Users'] = 'main/users';
$route['Appointments'] = 'main/appointment';
$route['Out_Patient'] = 'main/patient';
$route['In-Patient'] = 'main/inpatient';
$route['Orders'] = 'main/orders';
$route['Ordered_Medicines'] = 'main/orders/0';
$route['Ordered_Medical_Tests'] = 'main/orders/1';
$route['In-Patient_Trend'] = 'main/report/1';
$route['Appointment_Trend'] = 'main/report/2';
$route['Settings'] = 'main/settings';
$route['DB-Backup'] = 'main/db_backup';
$route['Prescriptions'] = 'main/prescription';
$route['Prognosis'] = 'main/prognosis';
$route['Health_Reports'] = 'main/health_reports';
/*$route['Orders/(:num)'] = 'main/inpatient';
$route['Trends/(:num)'] = 'main/inpatient';*/


/*********MyPulse Functional.**************/
$route['Hospital/(:any)'] = 'main/get_hospital_history/$1';
$route['Hospital_Edit/(:any)'] = 'main/edit_hospital/$1';
$route['Prescription/(:any)'] = 'main/prescription_history/$1';
$route['prescription_for_medicine/(:any)'] = 'main/prescription_history/$1/0';
$route['prescription_for_medical_test/(:any)'] = 'main/prescription_history/$1/1';
$route['Prognosis/(:any)'] = 'main/prognosis_history/$1';
//$route['Hospital_Edit/(:any)'] = 'main/edit_hospital/$1';
/*$route['product/(:any)'] = 'catalog/product_lookup';
$route['product/(:num)'] = 'catalog/product_lookup_by_id/$1';*/