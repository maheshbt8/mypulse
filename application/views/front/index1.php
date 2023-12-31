<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>MyPulse - <?=$page_title;?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
  <meta name="description" content="Welcome to MyPulse, Healthcare solution that provides a seamless experience for Hospitals and end users. Book appointments, Manage prescriptions and health records across the hospitals, Order Medicines and Medical Tests.">
	<meta name="keywords" content="Healthcare, MyPulse, Book appointments, Manage health records, Prescriptions, Order medicines, Order Medical tests" />
<?php include 'includes_top.php'; ?>
<style>
body{
  line-height: 0.5;
}
header{
    background: -webkit-linear-gradient(bottom, #005bea, #00c6fb);
  }
.isotop-btn {
    text-align: center;
    margin-bottom: 45px;
}
</style>
<!--  -->
</head>

<body>
	<!-- <style type="text/css">
  header{
    background: -webkit-linear-gradient(bottom, #005bea, #00c6fb);
  }
</style> -->
<!-- header -->
  <header>
  <div class="top">
      <div class="container">
        <div class="t-op row">
          <div class="col-sm-6 top-middle">
            <ul>
              <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
              <li><a href="#"><i class="fab fa-twitter"></i></a></li>
              <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
              <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
            </ul>
          </div>
          <div class="col-sm-6 top-left">
            <ul>
              <li><i class="fas fa-phone"></i> <?=$this->db->get_where('settings', array('type' => 'phone'))->row()->description;?></li>
              <li><a href="<?=base_url('Login');?>"><button type="button" class="btn btn-sm btn-info">Log In</button></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="container"  style="background-color: -webkit-linear-gradient(bottom, #005bea, #00c6fb);">
      <nav class="navbar navbar-expand-lg navbar-light">
        <h1>
          <a class="navbar-brand text-capitalize" href="">
            <img draggable="false" src="<?=base_url('MyPulse-Logo');?>"  style="max-height:60px; margin: -35px;"/>
          </a>
        </h1>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav text-center  ml-lg-auto">
            <li class="nav-item <?php if($page_name=='home'){echo 'active';}?>  mr-3">
              <a class="nav-link" href="<?=base_url()?>">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
           <!--  <li class="nav-item  mr-lg-3 mt-lg-0 mt-3">
              <a class="nav-link scroll" href="#about">about</a>
            </li>
 -->            <li class="nav-item  mr-lg-3 mt-lg-0 mt-3">
              <a class="nav-link scroll" href="#services">services</a>
            </li>
            <li class="nav-item  mr-lg-3 mt-lg-0 mt-3">
              <a class="nav-link scroll" href="#doctors">Doctors</a>
            </li>
           <!--  <li class="nav-item dropdown mr-lg-3 mt-lg-0 mt-3">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Dropdown
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item scroll" href="#process">Process</a>
                                    <a class="dropdown-item scroll" href="#pricing">Pricing Plans</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item scroll" href="#partners">Partners</a>
                                </div>
              </li> -->

            <li class="nav-item  mr-lg-3 mt-lg-0 mt-3">
              <a class="nav-link scroll" href="#contact">contact</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </header>
	<!--banner -->
  <section class="banner">
    <div class="callbacks_container">
      <ul class="rslides" id="slider3">
        <li>
          <div class="slider-info bg1">
            <div class="banner-text container">

              <h4 class="movetxt text-left mb-3 agile-title text-capitalize">MyPulse</h4>
              <p class="text-white mb-3">MyPulse Is A Cloud Hosted Integrated Healthcare Solution That Automates And Simplifies How Various Healthcare Services are Delivered and Consumed, Thus Providing Seamless Experience For Both Healthcare Providers And Consumers.</p>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </section>
  <!-- //banner -->
  <!-- stats -->
<section class="stats pb-5">
    <div class="container py-md-4 mt-md-3">
      <div class="row inner_w3l_agile_grids-1">
      <div class="col-lg-1">
      </div>
      <div class="col-lg-2 col-sm-6 w3layouts_stats_left w3_counter_grid1">
        <p class="counter"><?=$this->db->count_all('hospitals');?></p>
        <h3>Hospitals</h3>
      </div>
      <div class="col-lg-2 col-sm-6 w3layouts_stats_left w3_counter_grid">
        <p class="counter"><?=$this->db->count_all('doctors');?></p>
        <h3>Doctors</h3>
      </div>
      <div class="col-lg-2 col-sm-6 w3layouts_stats_left w3_counter_grid2">
        <p class="counter"><?=$this->db->count_all('medicalstores');?></p>
        <h3>Medical Stores</h3>
      </div>
      <div class="col-lg-2 col-sm-6 w3layouts_stats_left w3_counter_grid2">
        <p class="counter"><?=$this->db->count_all('medicallabs');?></p>
        <h3>Medical Labs</h3>
      </div>
      <div class="col-lg-2 col-sm-6 w3layouts_stats_left w3_counter_grid">
        <p class="counter"><?=$this->db->count_all('users');?></p>
        <h3>MyPulse Users</h3>
      </div>
    </div>
   </div> 
</section>
<!-- //stats -->
<div  id="services">
<!-- Products -->
  <section class="services py-5">
    <div class="container py-md-4 mt-md-3"> 
      <h2 class="heading-agileinfo">MyPulse - What we offer?</h2>
      <span class="w3-line black"></span>
      <div class="row about-main pt-5 mt-md-5">
        <div class="col-lg-12 about-left">
          <div class="stats1">
              <!-- testimonials -->
            <div class="w3_agile-section testimonials text-center" id="testimonials">
              <div class=" w3ls-team-info test-bg">
                <div class="testi-left">
                  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">
                      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
                      </ol>
                      <div class="carousel-inner">
                      <div class="carousel-item active">
                        <div class="row thumbnail adjust1">
                             <div class="col-md-12 col-sm-12">
                              <div class="caption testi-text">
                                  <h4>Appointment handling</h4>
                                </div>
                            </div>
                            <p class="mt-3">Users should be able to seamlessly book appointments with our Hospitals and the appointments are confirmed by the System automatically. Also, appointments are rescheduled/cancelled as reqd. And Hospitals will be able to track all their scheduled appointments easily.</p>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <div class="row thumbnail adjust1">
                             <div class="col-md-12 col-sm-12">
                              <div class="caption testi-text">
                                  <h4>Managing of health records</h4>
                                </div>
                            </div>
                            <p class="mt-3">
                              Health records across the Hospitals are stored, protected and managed in electronic form, reducing the paper work for both Hospitals and End users and eliminating the risk of missing/misplacement of Health records.
                            </p>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <div class="row thumbnail adjust1">
                             <div class="col-md-12 col-sm-12">
                              <div class="caption testi-text">
                                  <h4>Patient management</h4>
                                </div>
                            </div>
                            <p class="mt-3">
                              Hospitals/Clinics should be able to track and manage list of their patients easily(Both Out-patients and In-patents).
                            </p>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <div class="row thumbnail adjust1">
                             <div class="col-md-12 col-sm-12">
                              <div class="caption testi-text">
                                  <h4>Orders for Medicines and Medical Tests</h4>
                                </div>
                            </div>
                            <p class="mt-3">
                            Users should be able to order medicines and Medical Tests. And the the receipts and reports are made available to users.
                            </p>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <div class="row thumbnail adjust1">
                             <div class="col-md-12 col-sm-12">
                              <div class="caption testi-text">
                                  <h4>Notifications and Messages</h4>
                                </div>
                            </div>
                            <p class="mt-3">
                            Users are notified about important activities and reminders for the same. Also, simple messaging system for communication among various staff/users.
                            </p>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <div class="row thumbnail adjust1">
                             <div class="col-md-12 col-sm-12">
                              <div class="caption testi-text">
                                  <h4>Web & Android Apps</h4>
                                </div>
                            </div>
                            <p class="mt-3">
                            Simple and easy to use Web and Android apps that provide users access to our services.
                            </p>
                        </div>
                      </div>
                      </div>
                  </div>
                </div>
              </div>
          </div>
    <!-- //testimonials-->
        </div>
      </div>
    </div>
  </div>   
</section>
<!-- //Products -->

   <!-- services -->
 
  <section class="details-books py-5">
    <div class="container py-md-4 mt-md-3">
    <h2 class="heading-agileinfo">MyPulse - What it means?<span></span></h2>
      <span class="w3-line black"></span>
      <div class="row mt-md-5 pt-4">
      <div class="col-lg-12 agileits_updates_grid_right">
          <div id="accordion">
            <div class="card w3l-acd">
            <div class="card-header wl3_head" id="headingOne">
              <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
               <span class="fa fa-check mr-2" aria-hidden="true"></span>
                  For Hospitals
              </button>
              </h5>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="card-body">
               <!--  <h6>MyPulse provides following services to hospitals:</h6> -->
              <ul>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>Easily Track and manage list of all your Patients(Both out-patient, in-patient, their appointments, Inpatient data etc.)</li>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>Easy to communicate with your Hospital staff with our simple communication mechanism</li>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>Large pool of your MyPulse user base to access your hospital services seamlessly.</li>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>Ease with which Patients can associate with your Hospital (Ease of booking appointments, tracking of your prescriptions and medical records etc).</li>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>Seamless integration with your Medical Store and Medical Lab for ordering of medicines and Medical tests.</li>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>No Hardware requirement and no hassles to install and maintain the hardware/software (We take care of this for you :)</li>
<!-- <li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>No Hardware requirement and no hassles of having to install and maintain the hardware/software (We do it for you :)</li> -->
              </ul>
              </div>
            </div>
            </div>
            <div class="card w3l-acd">
            <div class="card-header wl3_head" id="headingTwo">
              <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
               <span class="fa fa-check mr-2" aria-hidden="true"></span>
                  For MyPulse Users
              </button>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="card-body">
              <!-- <h6>MyPulse provides following services to End-Users:</h6> -->
              <ul>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>Tracking and Managing of your Health records across the Hospitals</li>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>Eliminates the risk of missing/misplacement of critical health records/health history</li>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>Simplification of Patient life cycle Management - Booking appointments, tracking your hospitals, doctors, Appointments, prescriptions, health records, tracking in-patient history etc.</li>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>Seamless access to various hospitals and doctors across the country.</li>
              </ul>
              </div>
            </div>
            </div>

            <div class="card w3l-acd">
            <div class="card-header wl3_head" id="headingThree">
              <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
               <span class="fa fa-check mr-2" aria-hidden="true"></span>
                  For Medical Stores
              </button>
              </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
              <div class="card-body">
              <!-- <h6>MyPulse provides following services to Medical Stores:</h6> -->
              <ul>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>Integrates seamlessly with your medical Store to track orders for Medicines.</li>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>Provides access to prescriptions and helps to process the orders for Medicines and upload Receipts for Users.</li>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>No Hardware reqmt and no hassles to install and maintain the hardware/software (We take care of this for you :)</li>
              </ul>
              </div>
            </div>
            </div>
             <div class="card w3l-acd">
            <div class="card-header wl3_head" id="headingFour">
              <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
               <span class="fa fa-check mr-2" aria-hidden="true"></span>
                  For Medical Labs
              </button>
              </h5>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
              <div class="card-body">
        <!-- <h6>MyPulse provides following services to Medical Labs:</h6> -->
              <ul>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>Integrates seamlessly with your medical Lab to track orders for Medical Tests.</li>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>Provides access to prescriptions and helps to process the orders for Medical tests.</li>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>Helps to Upload receipts and health records for the users.</li>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>No Hardware reqmt and no hassles to install and maintain the hardware/software (We take care of this for you :)</li>
              </ul>
              </div>
            </div>
            </div>
          </div>
      </div>
      </div>
    </div>
  </section>
  <!-- //details -->
          
      </div>
        <!-- //services -->
         
<!-- clients -->
  <section class="features py-md-5">
    <div class="container py-md-4 mt-md-3">
      <h3 class="heading-agileinfo">Some important customers & Their feedback.</h3>
     
      <span class="w3-line black"></span>
      <div class="row about-main pt-5 mt-md-5">
        <div class="col-lg-12 about-left">
          <div class="stats1">
              <!-- testimonials -->
            <div class="w3_agile-section testimonials text-center" id="testimonials">
              <div class=" w3ls-team-info test-bg">
                <div class="testi-left">
                  <?php
                  $feedback=$this->db->get('feedback')->result_array();
                  ?>
                  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">
                        <?php
                        for($i=0;$i<count($feedback);$i++) {
                        ?>
                      <li data-target="#carouselExampleIndicators" data-slide-to="<?=$i;?>" class="<?php if($i==0){"active";}?>"></li>
                    <?php }?>
                      </ol>
                      <div class="carousel-inner">
                                  <?php
                        $j=0;
                        foreach ($feedback as $feed ) {
                          $customer=explode('-',$feed['customer_id']);
                        ?>
<?php
if($customer[0] == 'superadmin'){
  $img_type='superadmin_image';
  $account='Super Admin';
}elseif($customer[0] == 'hospitaladmins'){
  $img_type='hospitaladmin_image';
  $account='Hospital Admin';
}elseif($customer[0] == 'doctors'){
  $img_type='doctor_image';
  $account='Doctor';
}elseif($customer[0] == 'nurse'){
  $img_type='nurse_image';
  $account='Nurse';
}elseif($customer[0] == 'receptionist'){
  $img_type='receptionist_image';
  $account='Receptionist';
}elseif($customer[0] == 'medicalstores'){
  $img_type='medical_stores';
  $account='Medical Store';
}elseif($customer[0] == 'medicallabs'){
  $img_type='medical_labs';
  $account='Medical Lab';
}
?>
                      <div class="carousel-item <?php if($j==0){echo 'active';}?>">
                        <div class="row thumbnail adjust1">
                           <div class="col-md-3 col-sm-3">
                              <img draggable="false" class="media-object img-fluid img-thumbnail" src="<?=base_url('Front/'.$img_type.'/'.$customer[2]);?>" alt=""/>
                             </div>
                             <div class="col-md-9 col-sm-9">
                              <div class="caption testi-text">
              <h4><?php $ac='';
 if($account=='Doctor'){
  $ac='Dr.';
 }
 echo $ac.' '.$this->db->where($customer[1].'_id',$customer[2])->get($customer[0])->row()->name;?></h4>
                                  <h5><?=$account;?></h5>
                                </div>
                            </div>
                            <p class="mt-3">
                            <span class="fa fa-quote-left pr-3" aria-hidden="true"></span><?=$feed['feedback'];?> </p>
                        </div>
                      </div>
                    <?php $j++;}?>
                      </div>
                  </div>
                </div>
              </div>
          </div>
    <!-- //testimonials-->
        </div>
      </div>
    </div>
  </div>
</section>
<!-- clients -->
<!-- Doctors Info -->
<div id="doctors">
  <section class="features py-md-5">
    <div class="container-fluid py-md-4 mt-md-3">
      <h3 class="heading-agileinfo">Search For Doctor Information.</h3>
     
      <span class="w3-line black"></span>
      <div class="row about-main pt-5 mt-md-12">
        <div class="col-lg-12">
        <!-- stats -->
          <div class="stats1">
<input class="form-control" id="myInput" type="text" placeholder="Search for Doctor or Hospital or Branch or Specializations..">
  <br><br>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Doctor</th>
        <th>Hospital - Branch</th>
        <th>Specializations</th>
        <th>Available Status</th>
      </tr>
    </thead>
    <tbody id="myTable">
        <?php
$hospi=$this->db->order_by('name','asc')->get_where('doctors',array('status'=>1,'isDeleted'=>1))->result_array();
foreach ($hospi as $row) {
  ?>
  <tr>
    <td><?='Dr. '.$row['name'];?></td>
    <td><?php 
    $branch=$this->db->get_where('branch' , array('branch_id' => $row['branch_id']))->row();
    $hospital=$this->db->get_where('hospitals' , array('hospital_id' => $row['hospital_id']))->row();
    echo $hospital->name.' - '.$branch->name;
        ?>
        </td>
    <td><?php if($row['specializations']!=''){$spe=explode(',', $row['specializations']);
            for($i=0;$i<count($spe);$i++){
                $specializations[]=$this->db->where('specializations_id',$spe[$i])->get('specializations')->row()->name;
            }
            echo implode(',',$specializations);}?></td>
    <td><?php $message='';$data=$this->db->where('doctor_id',$row['doctor_id'])->get('availability')->row();if($data!=''){echo $data->message;}?></td>
  </tr>
<?php }?>
    </tbody>
  </table>
            
          </div>
          <!-- //stats -->

        </div>
        
    </div>
  </div>
</section>
<section class="team-wrap-layout2 bg-light-accent100">
            <div class="container">
                <div class="section-heading heading-dark text-center heading-layout4">
                    <h2>Find A Doctor</h2>
                    <p>Our find a doctor tool assists you in choosing from our diverse
                        pool of health specialists.</p>
                </div>
                <div class="isotope-wrap">
                    <div class="text-center">
                        <div class="isotope-classes-tab isotop-btn">
                            <a href="#" class="current nav-item" data-filter="*">All</a>
                            <a href="#" class="nav-item" data-filter=".dental">Dental</a>
                            <a href="#" class="nav-item" data-filter=".gynaecology">Gynaecology</a>
                            <a href="#" class="nav-item" data-filter=".eye">Eye</a>
                            <a href="#" class="nav-item" data-filter=".cardiology">Cardiology</a>
                            <a href="#" class="nav-item" data-filter=".orthopaedics">Orthopaedics</a>
                            <a href="#" class="nav-item" data-filter=".gastroenterology">Gastroenterology</a>
                            <a href="#" class="nav-item" data-filter=".neurology">Neurology</a>
                            <a href="#" class="nav-item" data-filter=".medicine">Medicine</a>
                        </div>
                    </div>
                    <div class="row featuredContainer" id="no-equal-gallery" style="position: relative; height: 1866px;">
                        <div class="no-equal-item col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 gastroenterology neurology" style="position: absolute; left: 0px; top: 0px;">
                            <div class="team-box-layout2">
                                <div class="item-img">
                                    <img src="<?=base_url('assets/front/')?>images/g6.jpg" alt="Team1" class="img-fluid rounded-circle">
                                    <ul class="item-icon">
                                        <li><a href="single-doctor.html"><i class="fas fa-plus"></i></a></li>
                                    </ul>
                                </div>
                                <div class="item-content">
                                    <h3 class="item-title"><a href="single-doctor.html">Dr. Zinia Zara</a></h3>
                                    <p>Gynaecology</p>
                                </div>
                                <div class="item-schedule">
                                    <ul>
                                        <li>Mon - Tues<span>08.00 :17.00</span></li>
                                        <li>Fri - Sat<span>09.00 :12.00</span></li>
                                        <li>Sun - Mon<span>08.00 :17.00</span></li>
                                    </ul>
                                    <a href="single-doctor.html" class="item-btn">MAKE AN APPOINTMENT</a>
                                </div>
                            </div>
                        </div>
                        <div class="no-equal-item col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 dental cardiology" style="position: absolute; left: 330px; top: 0px;">
                            <div class="team-box-layout2">
                                <div class="item-img">
                                    <img src="<?=base_url('assets/front/')?>images/g6.jpg" alt="Team1" class="img-fluid rounded-circle">
                                    <ul class="item-icon">
                                        <li><a href="single-doctor.html"><i class="fas fa-plus"></i></a></li>
                                    </ul>
                                </div>
                                <div class="item-content">
                                    <h3 class="item-title"><a href="single-doctor.html">Dr. Nadim Kamal</a></h3>
                                    <p>Orthopaedics</p>
                                </div>
                                <div class="item-schedule">
                                    <ul>
                                        <li>Mon - Tues<span>08.00 :17.00</span></li>
                                        <li>Fri - Sat<span>09.00 :12.00</span></li>
                                        <li>Sun - Mon<span>08.00 :17.00</span></li>
                                    </ul>
                                    <a href="single-doctor.html" class="item-btn">MAKE AN APPOINTMENT</a>
                                </div>
                            </div>
                        </div>
                        <div class="no-equal-item col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 gastroenterology medicine" style="position: absolute; left: 660px; top: 0px;">
                            <div class="team-box-layout2">
                                <div class="item-img">
                                    <img src="<?=base_url('assets/front/')?>images/g6.jpg" alt="Team1" class="img-fluid rounded-circle">
                                    <ul class="item-icon">
                                        <li><a href="single-doctor.html"><i class="fas fa-plus"></i></a></li>
                                    </ul>
                                </div>
                                <div class="item-content">
                                    <h3 class="item-title"><a href="single-doctor.html">Dr. Rihana Roy</a></h3>
                                    <p>Lense Expert</p>
                                </div>
                                <div class="item-schedule">
                                    <ul>
                                        <li>Mon - Tues<span>08.00 :17.00</span></li>
                                        <li>Fri - Sat<span>09.00 :12.00</span></li>
                                        <li>Sun - Mon<span>08.00 :17.00</span></li>
                                    </ul>
                                    <a href="single-doctor.html" class="item-btn">MAKE AN APPOINTMENT</a>
                                </div>
                            </div>
                        </div>
                        <div class="no-equal-item col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 dental orthopaedics medicine" style="position: absolute; left: 990px; top: 0px;">
                            <div class="team-box-layout2">
                                <div class="item-img">
                                    <img src="<?=base_url('assets/front/')?>images/g6.jpg" alt="Team1" class="img-fluid rounded-circle">
                                    <ul class="item-icon">
                                        <li><a href="single-doctor.html"><i class="fas fa-plus"></i></a></li>
                                    </ul>
                                </div>
                                <div class="item-content">
                                    <h3 class="item-title"><a href="single-doctor.html">Dr. Steven Roy</a></h3>
                                    <p>Cardiology</p>
                                </div>
                                <div class="item-schedule">
                                    <ul>
                                        <li>Mon - Tues<span>08.00 :17.00</span></li>
                                        <li>Fri - Sat<span>09.00 :12.00</span></li>
                                        <li>Sun - Mon<span>08.00 :17.00</span></li>
                                    </ul>
                                    <a href="single-doctor.html" class="item-btn">MAKE AN APPOINTMENT</a>
                                </div>
                            </div>
                        </div>
                        <div class="no-equal-item col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 eye gynaecology neurology" style="position: absolute; left: 0px; top: 621px;">
                            <div class="team-box-layout2">
                                <div class="item-img">
                                    <img src="<?=base_url('assets/front/')?>images/g6.jpg" alt="Team1" class="img-fluid rounded-circle">
                                    <ul class="item-icon">
                                        <li><a href="single-doctor.html"><i class="fas fa-plus"></i></a></li>
                                    </ul>
                                </div>
                                <div class="item-content">
                                    <h3 class="item-title"><a href="single-doctor.html">Dr. Johora Roy</a></h3>
                                    <p>Dental Consult</p>
                                </div>
                                <div class="item-schedule">
                                    <ul>
                                        <li>Mon - Tues<span>08.00 :17.00</span></li>
                                        <li>Fri - Sat<span>09.00 :12.00</span></li>
                                        <li>Sun - Mon<span>08.00 :17.00</span></li>
                                    </ul>
                                    <a href="single-doctor.html" class="item-btn">MAKE AN APPOINTMENT</a>
                                </div>
                            </div>
                        </div>
                        <div class="no-equal-item col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 cardiology medicine" style="position: absolute; left: 330px; top: 622px;">
                            <div class="team-box-layout2">
                                <div class="item-img">
                                    <img src="<?=base_url('assets/front/')?>images/g6.jpg" alt="Team1" class="img-fluid rounded-circle">
                                    <ul class="item-icon">
                                        <li><a href="single-doctor.html"><i class="fas fa-plus"></i></a></li>
                                    </ul>
                                </div>
                                <div class="item-content">
                                    <h3 class="item-title"><a href="single-doctor.html">Dr. Jason Roy</a></h3>
                                    <p>Associate Eye</p>
                                </div>
                                <div class="item-schedule">
                                    <ul>
                                        <li>Mon - Tues<span>08.00 :17.00</span></li>
                                        <li>Fri - Sat<span>09.00 :12.00</span></li>
                                        <li>Sun - Mon<span>08.00 :17.00</span></li>
                                    </ul>
                                    <a href="single-doctor.html" class="item-btn">MAKE AN APPOINTMENT</a>
                                </div>
                            </div>
                        </div>
                        <div class="no-equal-item col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 dental neurology" style="position: absolute; left: 660px; top: 622px;">
                            <div class="team-box-layout2">
                                <div class="item-img">
                                    <img src="<?=base_url('assets/front/')?>images/g6.jpg" alt="Team1" class="img-fluid rounded-circle">
                                    <ul class="item-icon">
                                        <li><a href="single-doctor.html"><i class="fas fa-plus"></i></a></li>
                                    </ul>
                                </div>
                                <div class="item-content">
                                    <h3 class="item-title"><a href="single-doctor.html">Dr. Maria</a></h3>
                                    <p>Gastroenterology</p>
                                </div>
                                <div class="item-schedule">
                                    <ul>
                                        <li>Mon - Tues<span>08.00 :17.00</span></li>
                                        <li>Fri - Sat<span>09.00 :12.00</span></li>
                                        <li>Sun - Mon<span>08.00 :17.00</span></li>
                                    </ul>
                                    <a href="single-doctor.html" class="item-btn">MAKE AN APPOINTMENT</a>
                                </div>
                            </div>
                        </div>
                        <div class="no-equal-item col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 gastroenterology orthopaedics" style="position: absolute; left: 990px; top: 622px;">
                            <div class="team-box-layout2">
                                <div class="item-img">
                                    <img src="<?=base_url('assets/front/')?>images/g6.jpg" alt="Team1" class="img-fluid rounded-circle">
                                    <ul class="item-icon">
                                        <li><a href="single-doctor.html"><i class="fas fa-plus"></i></a></li>
                                    </ul>
                                </div>
                                <div class="item-content">
                                    <h3 class="item-title"><a href="single-doctor.html">Dr. Tina Rahman</a></h3>
                                    <p>Gastroenterology</p>
                                </div>
                                <div class="item-schedule">
                                    <ul>
                                        <li>Mon - Tues<span>08.00 :17.00</span></li>
                                        <li>Fri - Sat<span>09.00 :12.00</span></li>
                                        <li>Sun - Mon<span>08.00 :17.00</span></li>
                                    </ul>
                                    <a href="single-doctor.html" class="item-btn">MAKE AN APPOINTMENT</a>
                                </div>
                            </div>
                        </div>
                        <div class="no-equal-item col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 eye neurology medicine" style="position: absolute; left: 0px; top: 1243px;">
                            <div class="team-box-layout2">
                                <div class="item-img">
                                    <img src="<?=base_url('assets/front/')?>images/g6.jpg" alt="Team1" class="img-fluid rounded-circle">
                                    <ul class="item-icon">
                                        <li><a href="single-doctor.html"><i class="fas fa-plus"></i></a></li>
                                    </ul>
                                </div>
                                <div class="item-content">
                                    <h3 class="item-title"><a href="single-doctor.html">Dr. Mark Willy</a></h3>
                                    <p>Gastroenterology</p>
                                </div>
                                <div class="item-schedule">
                                    <ul>
                                        <li>Mon - Tues<span>08.00 :17.00</span></li>
                                        <li>Fri - Sat<span>09.00 :12.00</span></li>
                                        <li>Sun - Mon<span>08.00 :17.00</span></li>
                                    </ul>
                                    <a href="single-doctor.html" class="item-btn">MAKE AN APPOINTMENT</a>
                                </div>
                            </div>
                        </div>
                        <div class="no-equal-item col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 cardiology gynaecology" style="position: absolute; left: 330px; top: 1244px;">
                            <div class="team-box-layout2">
                                <div class="item-img">
                                    <img src="<?=base_url('assets/front/')?>images/g6.jpg" alt="Team1" class="img-fluid rounded-circle">
                                    <ul class="item-icon">
                                        <li><a href="single-doctor.html"><i class="fas fa-plus"></i></a></li>
                                    </ul>
                                </div>
                                <div class="item-content">
                                    <h3 class="item-title"><a href="single-doctor.html">Dr. Zinia Zara</a></h3>
                                    <p>Associate Eye</p>
                                </div>
                                <div class="item-schedule">
                                    <ul>
                                        <li>Mon - Tues<span>08.00 :17.00</span></li>
                                        <li>Fri - Sat<span>09.00 :12.00</span></li>
                                        <li>Sun - Mon<span>08.00 :17.00</span></li>
                                    </ul>
                                    <a href="single-doctor.html" class="item-btn">MAKE AN APPOINTMENT</a>
                                </div>
                            </div>
                        </div>
                        <div class="no-equal-item col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 dental neurology cardiology" style="position: absolute; left: 660px; top: 1244px;">
                            <div class="team-box-layout2">
                                <div class="item-img">
                                    <img src="<?=base_url('assets/front/')?>images/g6.jpg" alt="Team1" class="img-fluid rounded-circle">
                                    <ul class="item-icon">
                                        <li><a href="single-doctor.html"><i class="fas fa-plus"></i></a></li>
                                    </ul>
                                </div>
                                <div class="item-content">
                                    <h3 class="item-title"><a href="single-doctor.html">Dr. Nadim Kamal</a></h3>
                                    <p>Associate Eye</p>
                                </div>
                                <div class="item-schedule">
                                    <ul>
                                        <li>Mon - Tues<span>08.00 :17.00</span></li>
                                        <li>Fri - Sat<span>09.00 :12.00</span></li>
                                        <li>Sun - Mon<span>08.00 :17.00</span></li>
                                    </ul>
                                    <a href="single-doctor.html" class="item-btn">MAKE AN APPOINTMENT</a>
                                </div>
                            </div>
                        </div>
                        <div class="no-equal-item col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 eye orthopaedics medicine neurology" style="position: absolute; left: 990px; top: 1244px;">
                            <div class="team-box-layout2">
                                <div class="item-img">
                                    <img src="<?=base_url('assets/front/')?>images/g6.jpg" alt="Team1" class="img-fluid rounded-circle">
                                    <ul class="item-icon">
                                        <li><a href="single-doctor.html"><i class="fas fa-plus"></i></a></li>
                                    </ul>
                                </div>
                                <div class="item-content">
                                    <h3 class="item-title"><a href="single-doctor.html">Dr. Johora Roy</a></h3>
                                    <p>Associate Eye</p>
                                </div>
                                <div class="item-schedule">
                                    <ul>
                                        <li>Mon - Tues<span>08.00 :17.00</span></li>
                                        <li>Fri - Sat<span>09.00 :12.00</span></li>
                                        <li>Sun - Mon<span>08.00 :17.00</span></li>
                                    </ul>
                                    <a href="single-doctor.html" class="item-btn">MAKE AN APPOINTMENT</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</div>
        <div class="contact-wthree position-relative" id="contact">
            <span class="letter-02">c</span>
            <div class="container py-sm-5">
                <div class="row py-lg-5 py-4">
                    <div class="col-lg-8">
                        <div class="title-wthree">
                            <h3 class="agile-title">
                                contact
                            </h3>
                            <span></span>
                        </div>
                        <div class="map-responsive">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7612.569324584898!2d78.43960212369728!3d17.446084237504024!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb90e76b6662c5%3A0x9ad96c95b077cb8e!2sSanjeeva+Reddy+Nagar%2C+Hyderabad%2C+Telangana+500038!5e0!3m2!1sen!2sin!4v1544389951019" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
                          </div>
                    </div>
                    <div class="col-lg-4 mt-lg-0 mt-5">
                      <div class="container" style="border-bottom:1px solid black">
                            <h3>MyPulse Customer care</h3>
                          </div>
                            <hr/>
                          <ul class="container details">
                            <li><i class="fas fa-phone"></i> <?=$this->db->get_where('settings', array('type' => 'phone'))->row()->description;?></li><br/>
                            <li><i class="fas fa-envelope"></i> <?=$this->db->get_where('settings', array('type' => 'system_email'))->row()->description;?></li><br/>
                            <li><i class="fas fa-map-marker"></i> <?=$this->db->get_where('settings', array('type' => 'address'))->row()->description;?></li><br/>
                            <li><p><span class="glyphicon glyphicon-new-window one" style="width:50px;"></span><a href="#">www.mypulse.in</p></a>
                          </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- //contact -->
<!--footer-->
  <div class="copyright py-3">
    <div class="container">
      <div class="copyrighttop">
        <ul>
          <li>
            <h4>Follow us on:</h4>
          </li>
          <li>
            <a class="facebook" href="#">
              <i class="fab fa-facebook-f"></i>
            </a>
          </li>
          <li>
            <a class="facebook" href="#">
              <i class="fab fa-twitter"></i>
            </a>
          </li>
          <li>
            <a class="facebook" href="#">
              <i class="fab fa-google-plus-g"></i>
            </a>
          </li>
          <li>
            <a class="facebook" href="#">
              <i class="fab fa-pinterest-p"></i>
            </a>
          </li>
        </ul>
      </div>
      <div class="copyrightbottom">
        <p>© 2019 JagruMs Technologies - All Rights Reserved.&nbsp;&nbsp;<small><a href="<?=base_url('Privacy&Policy')?>" style="color:#fff;text-decoration:underline;font-family:Helvetica,Arial,sans-serif" target="_blank">Privacy Policy</a> | <a href="<?=base_url('Terms&Coditions')?>" style="color:#fff;text-decoration:underline;font-family:Helvetica,Arial,sans-serif" target="_blank">Terms and Conditions</a></small>
        </p>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
<!-- footer -->
<!-- js -->
<script src="<?=base_url('assets/front/')?>js/jquery-2.2.3.min.js"></script>
    <script src="<?=base_url('assets/front/')?>js/easing.min.js"></script>
    <script>
        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();

                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 1000);
            });
        });
    </script>
    <script src="<?=base_url('assets/front/')?>js/SmoothScroll.min.js"></script>
<!-- scroll up -->
<a class="scrolltop" style="cursor:pointer;"><img draggable="false" src="<?=base_url('assets/front/images/scrollup.png');?>" height="50"/></a>
<style type="text/css">
.scrolltop{
  position:fixed;
  right:10px;
  bottom:10px;
  color:#fff;
}
</style>
  <script type="text/javascript">
  $(".scrolltop").click(function() {
  $("html, body").animate({ scrollTop: 0 }, "slow");
  return false;
});
  </script>

 <?php include 'includes_bottom.php'; ?>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
</body>
</html>