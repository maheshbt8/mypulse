<!DOCTYPE HTML>
<html lang="en">

<head>
	<title>MyPulse - <?=$page_title;?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
  <meta name="description" content="type_your_description_here">
	<meta name="keywords" content="Home Loan Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<?php include 'includes_top.php'; ?>
<style>
</style>
<!--  -->
</head>

<body>
	<style type="text/css">
  header{
    background: -webkit-linear-gradient(bottom, #005bea, #00c6fb);
  }
</style>
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
              <li><a href="<?=base_url('login');?>"><button type="button" class="btn btn-sm btn-info">Log In</button></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="container"  style="background-color: -webkit-linear-gradient(bottom, #005bea, #00c6fb);">
      <nav class="navbar navbar-expand-lg navbar-light">
        <h1>
          <a class="navbar-brand text-capitalize" href="">
            <img src="<?=base_url('assets/logo.png')?>"  style="max-height:60px; margin: -35px;"/>
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
            <li class="nav-item  mr-lg-3 mt-lg-0 mt-3">
              <a class="nav-link scroll" href="#about">about</a>
            </li>
            <li class="nav-item  mr-lg-3 mt-lg-0 mt-3">
              <a class="nav-link scroll" href="#services">services</a>
            </li>
            <li class="nav-item  mr-lg-3 mt-lg-0 mt-3">
              <a class="nav-link scroll" href="#pricing">pricing plans</a>
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
              <p class="text-white mb-3">MyPulse is an integrated healthcare solution that automates and simplifies various Hospital/Clinical services and provides seamless experience for Healthcare consumers and Healthcare providers.</p>
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

  <!-- about -->
  <div id="about">
  <section class="welcome py-5">
    <div class="container py-md-4 mt-md-3">
      <h3 class="heading-agileinfo">About MyPulse<span></span></h3>
      <div class="row about-tp mt-md-5 pt-5">
        <div class="col-lg-6 welcome-left">
          <h3>Welcome</h3>
          <h4>MyPulse is an integrated healthcare solution that automates and simplifies various Hospital/Clinical services and provides seamless experience for Healthcare consumers and Healthcare providers.</h4>
          <p><b>Our Vision :-</b> MyPulse to be the de facto Healthcare solution for everybody.</p>
        </div>
        <div class="col-lg-6 welcome-right">
          <div class="welcome-right-top">
            <img src="<?=base_url('assets/front/');?>images/myimage.jpg" alt="" class="img-fluid">
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- //about -->
<!-- about-team -->
  <section class="team py-5">
    <div class="container py-md-4 mt-md-3">
      <h3 class="heading-agileinfo">Our Team<span></span></h3>
      <span class="w3-line black"></span>
      <div class="row team-row-agileinfo mt-md-5 pt-5">
        <div class="col-lg-3 col-md-6 col-sm-6 team-grids">
          <div class="thumbnail team-agileits">
            <img src="<?=base_url('assets/front/');?>images/te1.jpg" class="img-fluid" alt="" />
            <div class="effectd-caption">
              <h4 class="mb-3">Rajasekhar Reddy</h4>
              <div class="social-lsicon">
                <a href="#" class="social-button twitter">
                  <span class="fab fa-twitter"></span>
                </a>
                <a href="#" class="social-button facebook">
                  <span class="fab fa-facebook-f"></span>
                </a>
                <a href="#" class="social-button google">
                  <span class="fab fa-google-plus-g"></span>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 team-grids">
          <div class="thumbnail team-agileits">
            <img src="<?=base_url('assets/front/');?>images/te2.jpg" class="img-fluid" alt="" />
            <div class="effectd-caption">
              <h4 class="mb-3">Mahesh</h4>
              <div class="social-lsicon">
                <a href="#" class="social-button twitter">
                  <span class="fab fa-twitter"></span>
                </a>
                <a href="#" class="social-button facebook">
                  <span class="fab fa-facebook-f"></span>
                </a>
                <a href="#" class="social-button google">
                  <span class="fab fa-google-plus-g"></span>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 team-grids">
          <div class="thumbnail team-agileits">
            <img src="<?=base_url('assets/front/');?>images/te3.jpg" class="img-fluid" alt="" />
            <div class="effectd-caption">
              <h4 class="mb-3">Chunk Erson</h4>
              <div class="social-lsicon">
                <a href="#" class="social-button twitter">
                  <span class="fab fa-twitter"></span>
                </a>
                <a href="#" class="social-button facebook">
                  <span class="fab fa-facebook-f"></span>
                </a>
                <a href="#" class="social-button google">
                  <span class="fab fa-google-plus-g"></span>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 team-grids">
          <div class="thumbnail team-agileits">
            <img src="<?=base_url('assets/front/');?>images/te4.jpg" class="img-fluid" alt="" />
            <div class="effectd-caption">
              <h4 class="mb-3">Goes Marry</h4>
              <div class="social-lsicon">
                <a href="#" class="social-button twitter">
                  <span class="fab fa-twitter"></span>
                </a>
                <a href="#" class="social-button facebook">
                  <span class="fab fa-facebook-f"></span>
                </a>
                <a href="#" class="social-button google">
                  <span class="fab fa-google-plus-g"></span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- //about-team -->
</div>
   <!-- services -->
        <div class="agileits-services py-5 position-relative" id="services">
            <span class="icon-trans">MyPulse</span>
            <div class="container py-lg-5">
                <div class="title-wthree text-center">
                    <h3 class="agile-title   text-white">
                        our services
                    </h3>
                    <span></span>
                </div>
                <!-- details -->
  <section class="details-books py-5">
    <div class="container py-md-4 mt-md-3">
    <h2 class="heading-agileinfo">Services Overview<span></span></h2>
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
                <h6>MyPulse provides following services to hospitals:</h6>
              <ul>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>Simplification of Patient management(Both out-patient and in-patient)</li>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>Creates a branding for your Hospital along with unique URL</li>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>Ease of communication among hospital staff</li>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>Ease with which Patients can associate with your Hospital (Booking of appointments, tracking of patients, prescriptions and medical records etc)</li>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>Large pool of MyPulse user base to access your hospital services seamlessly</li>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>Seamless integration with your Medical Store and Medical Lab for ordering of medicines and lab tests.</li>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>No Hardware requirement and no hassles of having to install and maintain the hardware/software (We do it for you :)</li>

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
              <h6>MyPulse provides following services to End-Users:</h6>
              <ul>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>Management of your Health records across the Hospitals</li>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>No more paper work. No more missing/misplacement of critical health records/history</li>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>Health records are protected and secured with AES encryption</li>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>Simplification of Patient life cycle Management - Booking appointments, tracking your hospitals, doctors, appointments, prescriptions, health records, tracking in-patient history etc.</li>
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
              <h6>MyPulse provides following services to Medical Stores:</h6>
              <ul>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>Healthcare solution that integrates seamlessly with your medical store</li>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>Helps to review prescriptions/track orders for medicines</li>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>Helps to process the orders for medicines and deliver the same</li>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>Seamless access to your medical store by large set of user base across the country</li>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>No Hardware reqmt and no hassles of having to install and maintain the hardware/software (We do it for you :)</li>
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
        <h6>MyPulse provides following services to Medical Labs:</h6>
              <ul>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>Healthcare solution that integrates seamlessly with your medical lab</li>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>Be able to review prescriptions/orders for medical tests</li>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>Process orders for medical tests and upload reports for the patient.</li>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>Seamless access to your medical lab from large set of user base across the country</li>
<li><span class="fa fa-arrow-right mr-2" aria-hidden="true">&nbsp;</span>No Hardware reqmt and no hassles of having to install and maintain the hardware/software (We do it for you :)</li>

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
        </div>
        <!-- //services -->
         <!-- process -->
        <section class="wthree-row py-lg-5 position-relative" id="process">
            <span class="letter-02">w</span>
            <div class="container py-5">
                <div class="title-wthree text-center py-lg-5">
                    <h3 class="agile-title">
                        how it works
                    </h3>
                    <span></span>
                </div>
                <div class="row abbot-main py-lg-5 py-4 mb-sm-5">
                    <div class="col-lg-4 abbot-right">
                        <img src="<?=base_url('assets/front/')?>images/p1.png" class="img-fluid rounded-circle" alt="" />
                    </div>
                    <div class="offset-lg-2"></div>
                    <div class="col-lg-6 about-text-grid position-relative mt-lg-0 mt-5">
                        <div class="d-flex">
                            <span class="process-circle"></span>
                            <h4 class="sec-title1">Buy Stack</h4>
                        </div>
                        <p class="mt-md-5 mb-3 mt-3">Donec mi nulla, auctor nec sem a, ornare auctor m faucibus orci luctus et ultrices posuere cubilia
                            Curai. Sed mi tortor, commodo a felis in, fringilla tincidunt nulla. </p>
                        <p>fringilla tincidunt nulla onec mi nulla, auctor nec sem a, ornare auctor m faucibus orci luctus et
                            ultrices posuere cubilia Curai. Sed mi tortor, commodo a felis in. </p>
                        <div class="process-direction"></div>
                    </div>
                </div>
                <div class="row abbot-main py-lg-5 py-4 my-md-5">
                    <div class="col-lg-6 about-text-grid">
                        <div class="d-flex">
                            <h4 class="sec-title1 flow-odd">Prototyping
                            </h4>
                            <span class="process-circle"></span>
                        </div>
                        <ul class="list-group mt-md-3 my-3">
                            <li class="list-group-item border-0">
                                <i class="fas fa-check mr-3"></i>Cras justo odio</li>
                            <li class="list-group-item border-0">
                                <i class="fas fa-check mr-3"></i>Dapibus ac facilisis</li>
                            <li class="list-group-item border-0">
                                <i class="fas fa-check mr-3"></i>Morbi leo risus</li>
                            <li class="list-group-item border-0">
                                <i class="fas fa-check mr-3"></i>Porta ac consectetur</li>
                            <li class="list-group-item border-0">
                                <i class="fas fa-check mr-3"></i>Vestibulum at eros</li>
                        </ul>
                    </div>
                    <div class="col-lg-4 abbot-right">
                        <img src="<?=base_url('assets/front/')?>images/p2.png" class="img-fluid" alt="" />
                    </div>
                </div>
                <div class="row abbot-main py-lg-5 py-4 mb-sm-5">
                    <div class="col-lg-4 abbot-right">
                        <img src="<?=base_url('assets/front/')?>images/p3.png" class="img-fluid" alt="" />
                    </div>
                    <div class="offset-lg-2"></div>
                    <div class="col-lg-6 about-text-grid position-relative">
                        <div class="d-flex">
                            <span class="process-circle"></span>
                            <h4 class="sec-title1">production</h4>
                        </div>
                        <p class="mt-md-5 mb-3 mt-3">Fringilla tincidunt nulla onec mi nulla, auctor nec sem a, ornare auctor m faucibus orci luctus et
                            ultrices posuere cubilia Curai. Sed mi tortor, commodo a felis in. </p>
                        <p>Donec mi nulla, auctor nec sem a, ornare auctor m faucibus orci luctus et ultrices posuere cubilia
                            Curai. Sed mi tortor, commodo a felis in, fringilla tincidunt nulla. </p>
                        <div class="process-direction2"></div>
                    </div>
                </div>
                <div class="row abbot-main py-lg-5">
                    <div class="col-lg-6 about-text-grid">
                        <div class="d-flex">
                            <h4 class="sec-title1 flow-odd">visual design</h4>
                            <span class="process-circle"></span>
                        </div>
                        <ul class="list-group mt-md-3 my-3">
                            <li class="list-group-item border-0">
                                <i class="fas fa-check mr-3"></i>Cras justo odio</li>
                            <li class="list-group-item border-0">
                                <i class="fas fa-check mr-3"></i>Dapibus ac facilisis</li>
                            <li class="list-group-item border-0">
                                <i class="fas fa-check mr-3"></i>Morbi leo risus</li>
                            <li class="list-group-item border-0">
                                <i class="fas fa-check mr-3"></i>Porta ac consectetur</li>
                            <li class="list-group-item border-0">
                                <i class="fas fa-check mr-3"></i>Vestibulum at eros</li>
                        </ul>
                        <div class="process-direction-last"></div>
                    </div>
                    <div class="col-lg-4 abbot-right">
                        <img src="<?=base_url('assets/front/')?>images/p4.jpg" class="img-fluid rounded-circle" alt="" />
                    </div>
                </div>
            </div>
        </section>
        <!-- //process -->
        <!-- pricing plans -->
        <section class="wthree-row pb-lg-5 position-relative" id="pricing">
            <span class="icon-trans">p</span>
            <div class="container py-5">
                <div class="title-wthree text-center py-lg-5">
                    <h3 class="agile-title text-white">
                        plans & Pricing
                    </h3>
                    <span></span>
                </div>
                <div class="pricing card-deck flex-column flex-lg-row mb-sm-3">
                    <div class="card card-pricing text-center px-3 mb-4">
                        <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom btn-theme text-white shadow-sm">Starter</span>
                        <div class="bg-transparent card-header pt-4 border-0">
                            <h6 class="h6 font-weight-normal text-primary text-center mb-0" data-pricing-value="15">
                                <sup>$</sup>
                                <span class="price">30</span>
                                <span class="h6 text-muted ml-2">/ month</span>
                            </h6>
                        </div>
                        <div class="card-body pt-0">
                            <ul class="list-unstyled mb-4">
                                <li>Up to 5 users</li>
                                <li>Basic support</li>
                                <li>Monthly updates</li>
                                <li>Free cancellation</li>
                                <li>Add one more Feature</li>
                            </ul>
                            <button type="button" class="btn btn-outline-secondary mb-3 btn-change5" data-toggle="modal" aria-pressed="false" data-target="#exampleModal">Order now</button>
                        </div>
                    </div>
                    <div class="card card-pricing popular shadow text-center px-3 mb-4">
                        <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom btn-theme text-white shadow-sm">Professional</span>
                        <div class="bg-transparent card-header pt-4 border-0">
                            <h6 class="h6 font-weight-normal text-primary text-center mb-0" data-pricing-value="30">
                                <sup>$</sup>
                                <span class="price">40</span>
                                <span class="h6 text-muted ml-2">/ month</span>
                            </h6>
                        </div>
                        <div class="card-body pt-0">
                            <ul class="list-unstyled mb-4">
                                <li>Up to 5 users</li>
                                <li>Basic support</li>
                                <li>Monthly updates</li>
                                <li>Free cancellation</li>
                            </ul>
                            <button type="button" class="btn btn-outline-secondary mb-3 btn-change5" data-toggle="modal" aria-pressed="false" data-target="#exampleModal">Order now</button>
                        </div>
                    </div>
                    <div class="card card-pricing text-center px-3 mb-4">
                        <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom btn-theme text-white shadow-sm">Business</span>
                        <div class="bg-transparent card-header pt-4 border-0">
                            <h6 class="h6 font-weight-normal text-primary text-center mb-0" data-pricing-value="45">
                                <sup>$</sup>
                                <span class="price">75</span>
                                <span class="h6 text-muted ml-2">/ month</span>
                            </h6>
                        </div>
                        <div class="card-body pt-0">
                            <ul class="list-unstyled mb-4">
                                <li>Up to 5 users</li>
                                <li>Basic support</li>
                                <li>Monthly updates</li>
                                <li>Free cancellation</li>
                            </ul>
                            <button type="button" class="btn btn-outline-secondary mb-3 btn-change5" data-toggle="modal" aria-pressed="false" data-target="#exampleModal">Order now</button>
                        </div>
                    </div>
                    <div class="card card-pricing text-center px-3 mb-4">
                        <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom btn-theme text-white shadow-sm">Enterprise</span>
                        <div class="bg-transparent card-header pt-4 border-0">
                            <h6 class="h6 font-weight-normal text-primary text-center mb-0" data-pricing-value="60">
                                <sup>$</sup>
                                <span class="price">90</span>
                                <span class="h6 text-muted ml-2">/ month</span>
                            </h6>
                        </div>
                        <div class="card-body pt-0">
                            <ul class="list-unstyled mb-4">
                                <li>Up to 5 users</li>
                                <li>Basic support</li>
                                <li>Monthly updates</li>
                                <li>Free cancellation</li>
                                <li>Add one more Feature</li>
                            </ul>
                            <button type="button" class="btn btn-outline-secondary mb-3 btn-change5" data-toggle="modal" aria-pressed="false" data-target="#exampleModal">Order now</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- //pricing plans -->
        <!-- contact -->
        <div class="contact-wthree position-relative" id="contact">
            <span class="letter-02">c</span>
            <div class="container py-sm-5">
                <div class="row py-lg-5 py-4">
                    <div class="col-lg-6">
                        <div class="title-wthree">
                            <h3 class="agile-title">
                                contact
                            </h3>
                            <span></span>
                        </div>
                        <div class="map-responsive">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7612.569324584898!2d78.43960212369728!3d17.446084237504024!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb90e76b6662c5%3A0x9ad96c95b077cb8e!2sSanjeeva+Reddy+Nagar%2C+Hyderabad%2C+Telangana+500038!5e0!3m2!1sen!2sin!4v1544389951019" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                          </div>
                    </div>
                    <!-- <div class="offset-2"></div> -->
                    <div class="col-lg-6 mt-lg-0 mt-5">
                        <!-- register form grid -->
                        <div class="register-top1">
                            <form action="#" method="get" class="register-wthree">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2 d-md-flex align-items-end justify-content-end px-md-0">
                                            <label class="mb-0">
                                                <span class="fas fa-user"></span>
                                            </label>
                                        </div>
                                        <div class="col-md-5">
                                            <label>
                                                First name
                                            </label>
                                            <input class="form-control" type="text" placeholder="Johnson" name="email" required="">
                                        </div>
                                        <div class="col-md-5">
                                            <label>
                                                Last name
                                            </label>
                                            <input class="form-control" type="text" placeholder="Kc" name="email" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2 d-md-flex align-items-end justify-content-end px-md-0">
                                            <label class="mb-0">
                                                <span class="fas fa-envelope-open"></span>
                                            </label>
                                        </div>
                                        <div class="col-md-10">
                                            <label>
                                                Email
                                            </label>
                                            <input class="form-control" type="email" placeholder="example@email.com" name="email" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2 d-md-flex align-items-end justify-content-end px-md-0">
                                            <label class="mb-0">
                                                <span class="far fa-edit"></span>
                                            </label>
                                        </div>
                                        <div class="col-md-10">
                                            <label>
                                                Your message
                                            </label>
                                            <textarea placeholder="Type your message here" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-lg-5 mt-3">
                                    <div class="offset-2"></div>
                                    <div class="col-md-10">
                                        <button type="submit" class="btn btn-agile btn-block w-100 btn-success">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--  //register form grid ends here -->
                    </div>
                </div>
            </div>
        </div>
        <!-- //contact -->
<?php include 'footer.php'; ?>
	<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Home Loan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		 <div class="agileits-w3layouts-info">
			<img src="<?=base_url('assets/front/')?>images/g6.jpg" class="img-fluid" alt="" />
			<p>Duis venenatis, turpis eu bibendum porttitor, sapien quam ultricies tellus, ac rhoncus risus odio eget nunc. Pellentesque ac fermentum diam. Integer eu facilisis nunc, a iaculis felis. Pellentesque pellentesque tempor enim, in dapibus turpis porttitor quis. </p>
		</div>
	</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- //Modal -->
<!-- js -->
<script src="<?=base_url('assets/front/')?>js/jquery-2.2.3.min.js"></script>
   <script src="<?=base_url('assets/front/')?>js/move-top.js"></script>
    <script src="<?=base_url('assets/front/')?>js/easing.js"></script>
<!--     <script src="<?=base_url('assets/front/new/')?>js/bootstrap.js"></script> -->
   
    <!-- //testimonials  Responsiveslides -->
    <!-- start-smooth-scrolling -->
   
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
    <!-- //end-smooth-scrolling -->
    <!-- smooth-scrolling-of-move-up -->
    <script>
        $(document).ready(function () {
             $().UItoTop({
                easingType: 'easeOutQuart'
            });

        });
    </script>
    <script src="<?=base_url('assets/front/')?>js/SmoothScroll.min.js"></script>
    <!-- //smooth-scrolling-of-move-up -->
    <!-- Bootstrap core JavaScript
================================================== -->
<!-- scroll up -->
<a class="scrolltop" style="cursor:pointer;"><img src="<?=base_url('assets/front/images/scrollup.png');?>" height="50"/></a>
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
</body>
</html>