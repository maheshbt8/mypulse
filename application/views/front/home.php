                      <!-- Baner Starts Here -->
                        <!-- About Area Start Here -->
                         <!-- Slider Area Start Here -->
        <div class="slider-area slider-layout1 bg-light-primary slider-top-margin">
            <div class="bend niceties preview-1">
                <div id="ensign-nivoslider-1" class="slides">
                    <img src="<?=base_url();?>assets/frontend/img/slider/slide1-1.jpg" alt="slider" title="#slider-direction-1" />
                    <img src="<?=base_url();?>assets/frontend/img/slider/slide1-2.jpg" alt="slider" title="#slider-direction-2" />
                    <img src="<?=base_url();?>assets/frontend/img/slider/slide1-3.jpg" alt="slider" title="#slider-direction-3" />
                </div>
                <div id="slider-direction-1" class="t-cn slider-direction">
                    <div class="slider-content s-tb slide-1">
                        <div class="text-left title-container s-tb-c">
                            <div class="container">
                                <h3 class="slider-big-text padding-right">An Integrated Healthcare Solution That Automates And Simplifies How Healthcare Services are Delivered and Consumed, Thus Providing Seamless Experience For Both Healthcare Providers And Consumers.</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="slider-direction-2" class="t-cn slider-direction">
                    <div class="slider-content s-tb slide-2">
                        <div class="text-left title-container s-tb-c">
                            <div class="container">
                               <h3 class="slider-big-text padding-right">Your digital file for Healthcare, That Keeps Track Of All Your Critical Health Records and your entire Health history.</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="slider-direction-3" class="t-cn slider-direction">
                    <div class="slider-content s-tb slide-3">
                        <div class="text-left title-container s-tb-c">
                            <div class="container">
                               <h3 class="slider-big-text padding-right">Health Records That Can Be Accessed And Shared With Your Doctor Whenever Required/Wherever required. Your health history is along with you wherever you go.</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Slider Area End Here -->
        <!-- About Area Start Here -->
        <section class="progress-wrap-layout2 bg-overlay bg-overlay-primary80 bg-common parallaxie" data-bg-image="<?=base_url('assets/frontend/')?>img/figure/figure1.jpg" style="background-image: url(&quot;<?=base_url('assets/frontend/')?>img/figure/figure1.jpg&quot;); background-size: cover; background-repeat: no-repeat; background-attachment: fixed; background-position: center 102.231px;">
            <div class="container">
                <div class="row">
                    <div class="progress-box-layout2  col-md-2">
                        <div class="inner-item">
                            <div class="counting-text counter" data-num="<?=$this->db->count_all('hospitals');?>"><?=$this->db->count_all('hospitals');?></div>
                            <p>Hospitals</p>
                        </div>
                    </div>
                    <div class="progress-box-layout2 col-md-2">
                        <div class="inner-item">
                            <div class="counting-text counter" data-num="<?=$this->db->count_all('doctors');?>"><?=$this->db->count_all('doctors');?></div>
                            <p>Doctors</p>
                        </div>
                    </div>
                    <div class="progress-box-layout2 col-md-2">
                        <div class="inner-item">
                            <div class="counting-text counter" data-num="<?=$this->db->count_all('medicalstores');?>"><?=$this->db->count_all('medicalstores');?></div>
                            <p>Medical Stores</p>
                        </div>
                    </div>
                    <div class="progress-box-layout2 col-md-2">
                        <div class="inner-item">
                            <div class="counting-text counter" data-num="<?=$this->db->count_all('medicallabs');?>"><?=$this->db->count_all('medicallabs');?></div>
                            <p>Medical Labs</p>
                        </div>
                    </div>
                    <div class="progress-box-layout2 col-md-2">
                        <div class="inner-item">
                            <div class="counting-text counter" data-num="<?=$this->db->count_all('users');?>"><?=$this->db->count_all('users');?></div>
                            <p>MyPulse Users</p>
                        </div>
                    </div>
                    <div class="progress-box-layout2  col-md-2">
                        <div class="inner-item">
                            <div class="counting-text counter" data-num="<?=$this->db->count_all('appointments');?>"><?=$this->db->count_all('appointments');?></div>
                            <p>Appointments</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="about-wrap-layout2" id="what-we-offer">
            <div class="container">
                <div class="row">
                    <!-- <div class="col-lg-4 col-12">
                        <div class="about-box-layout3">
                            <h2 class="item-title">Welcome To Medilink <span>Central Hospital.</span></h2>
                            <p>On the other hand we denounce with righteous indignation and dislike mr turet suscipit
                                lobortis nisl ut aliquip erat volutpat autem vel eum iriure dolor in hendrerit in
                                vulputate velit esse molestie consequat, vel illum dolore
                                eu feugiate.pat autem vel eum iriure dolor in hendrerite.</p>
                        </div>
                    </div> -->
                <div class="section-heading heading-dark text-left heading-layout1">
                    <h2>What We Offer</h2>
                </div>
                    <div class="col-lg-12 col-12">
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <div class="about-box-layout4">
                                    <div class="media">
                                        <div class="item-icon">
                                            <i class="fa fa-plus-square"></i>
                                        </div>
                                        <div class="media-body space-md">
                                            <h3 class="item-title">Appointment handling</h3>
                                            <p>Users should be able to seamlessly book appointments with our Hospitals and the appointments are confirmed by the System automatically. Also, appointments can be rescheduled/cancelled as reqd. And Hospitals & Clinics will be able to track all their scheduled appointments easily.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="about-box-layout4">
                                    <div class="media">
                                        <div class="item-icon">
                                            <i class="fa fa-heartbeat"></i>
                                        </div>
                                        <div class="media-body space-md">
                                            <h3 class="item-title">Managing health records</h3>
                                            <p>Health records are stored, protected and managed in electronic form across the Hospitals and eliminating the risk of missing/misplacement of Health records.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="about-box-layout4">
                                    <div class="media">
                                        <div class="item-icon">
                                            <i class="far fa-user"></i>
                                        </div>
                                        <div class="media-body space-md">
                                            <h3 class="item-title">Patient management</h3>
                                            <p>Hospitals will be able to track and manage all of their OutPatients and InPatients easily. And Users will be able to track their entire appointment and InPatient history.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="about-box-layout4">
                                    <div class="media">
                                        <div class="item-icon">
                                             <i class="flaticon-first-aid-kit"></i>
                                        </div>
                                        <div class="media-body space-md">
                                            <h3 class="item-title">Orders for Medicines and Medical Tests</h3>
                                            <p>Users should be able to seamlessly order medicines and Medical Tests based on prescriptions. And receipts and reports are uploaded and tracked easily.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="about-box-layout4">
                                    <div class="media">
                                        <div class="item-icon">
                                            <i class="far fa-envelope"></i>
                                        </div>
                                        <div class="media-body space-md">
                                            <h3 class="item-title">Notifications and Messages</h3>
                                            <p>Users are notified about important activities and reminders for the same. And, simple messages can be sent/received among the users.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="about-box-layout4">
                                    <div class="media">
                                        <div class="item-icon">
                                            <i class="fas fa-mobile"></i>
                                        </div>
                                        <div class="media-body space-md">
                                            <h3 class="item-title">Web & Android Apps</h3>
                                            <p>Simple and easy to use Web and Android apps that provide users seamless access to our services.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Banrer End Here -->
        <hr/>
                      <!-- About Area End Here -->
        <section class="about-wrap-layout1" data-bg-image="<?=base_url();?>assets/frontend/img/figure/figure7.jpg">
            <div class="container">
                <div class="row">
                    <div class="about-box-layout1 order-xl-1 col-xl-8 col-12">
                        <div class="item-content">
                            <h2 class="item-title">Welcome To MyPulse.</h2>
<p>An Integrated Healthcare Solution That Automates And Simplifies How Healthcare Services are Delivered and Consumed, Thus Providing Seamless Experience For Both Healthcare Providers And Consumers.</p>
<p>Your digital file for Healthcare, That Keeps Track Of All Your Critical Health Records and your entire Health history.</p>
<p>Health Records That Can Be Accessed And Shared With Your Doctor Whenever Required/Wherever required. Your health history is along with you wherever you go.</p>
<!-- <img src="<?=base_url();?>assets/frontend/img/raj.png" alt="sign" class="img-fluid"  draggable="false"> -->
<br/>
<i><h1><p style="color: #3062e4;">MyPulse Team</p></h1></i>
<!-- <p class="a"><i><b style="color: #3062e4;transform: rotate(-10deg);"><h2>MyPulse Team</h2></b></i></p> -->
                        </div>
                    </div>
                    <div class="about-box-layout2 order-xl-2 col-xl-4 col-lg-7 col-12">
                        <ul>
                            <li><a href="Register"><i class="far fa-user"></i>MyPulse Registration</a></li>
                            <li><a href="MyPulse-Doctors"><i class="fa fa-user-md"></i>Find Doctors</a></li>
                            <li><a href="Contact-Us"><i class="fas fa-map-marker-alt"></i>Find Locations</a></li>
                            <li><a href="Comming-Soon"><i class="fas fa-mobile"></i>Download App</a></li>
                        </ul>
                    </div>
                    <!-- <div class="about-box-layout2 order-xl-3 col-xl-3 col-lg-5 col-12">
                        <div class="item-img">
                            <img src="<?=base_url();?>assets/frontend/img/about/about1.png" alt="about" class="img-fluid">
                        </div>
                    </div> -->
                </div>
            </div>
        </section>
        <!-- About Area End Here -->
                             <!-- Testimonial Area Start Here -->
        <section class="testmonial-wrap-layout2 bg-common" data-bg-image="<?=base_url('assets/frontend/')?>img/testimonial/testimonial-bg1.jpg">
            <div class="container">
                <div class="rc-carousel dot-control-layout2" data-loop="true" data-items="1" data-margin="30" data-autoplay="true" data-autoplay-timeout="5000"
                    data-smart-speed="2000" data-dots="true" data-nav="false" data-nav-speed="false" data-r-x-small="1" data-r-x-small-nav="false"
                    data-r-x-small-dots="true" data-r-x-medium="1" data-r-x-medium-nav="false" data-r-x-medium-dots="true" data-r-small="1"
                    data-r-small-nav="false" data-r-small-dots="true" data-r-medium="1" data-r-medium-nav="false" data-r-medium-dots="true"
                    data-r-large="1" data-r-large-nav="false" data-r-large-dots="true" data-r-extra-large="1" data-r-extra-large-nav="false"
                    data-r-extra-large-dots="true">
                    <?php $result=$this->db->get('feedback')->result_array();
                    foreach ($result as $row) {
                        $customer=explode('_',$row['customer_id']);
                        $customer_type=substr($customer[0],0,-2);
$role=$this->crud_model->get_role($customer_type);
$img_path=$role['image_path'];
$img_type=$role['role'];
$doc=$this->db->get_where($role['type'],array('unique_id'=>$row['customer_id']))->row_array();
                    ?>
                    <div class="testmonial-box-layout3">
                        <div class="item-img">
                            <img src="<?=base_url('Front/'.$img_path.'/'.$doc[$role['type_id'].'_id']);?>" class="img-fulid rounded-circle" alt="Robert Addison">
                        </div>
                        <div class="item-content">
                            <p><?=$row['feedback'];?></p>
                            <h3 class="item-title"><?=$doc['name'];?></h3>
                            <h4 class="sub-title"><?=$img_type;?></h4>
                        </div>
                    </div>
                <?php }?>
                </div>
            </div>
        </section>
        <!-- Testimonial Area End Here -->
                     <!-- Departments Area Start Here -->
        <section class="departments-wrap-layout2 bg-light-secondary100">
            <img class="left-img img-fluid" src="<?=base_url();?>assets/frontend/img/figure/figure8.png" alt="figure">
            <div class="container">
                <div class="section-heading heading-dark text-left heading-layout1">
                    <h2>Our Departments</h2>
                    <p>Dedicated Services</p>
                    <div id="owl-nav1" class="owl-nav-layout1">
                        <span class="rt-prev">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                        <span class="rt-next">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    </div>
                </div>
                <div class="rc-carousel nav-control-layout2" data-loop="true" data-items="4" data-margin="20"
                    data-autoplay="false" data-autoplay-timeout="5000" data-custom-nav="#owl-nav1" data-smart-speed="2000"
                    data-dots="false" data-nav="false" data-nav-speed="false" data-r-x-small="1" data-r-x-small-nav="true"
                    data-r-x-small-dots="false" data-r-x-medium="2" data-r-x-medium-nav="false" data-r-x-medium-dots="false"
                    data-r-small="2" data-r-small-nav="false" data-r-small-dots="false" data-r-medium="3"
                    data-r-medium-nav="false" data-r-medium-dots="false" data-r-large="4" data-r-large-nav="false"
                    data-r-large-dots="false" data-r-extra-large="4" data-r-extra-large-nav="false"
                    data-r-extra-large-dots="false">
                    <div class="departments-box-layout2">
                        <span class="departments-sl">01.</span>



                        <div class="item-icon"><i class="flaticon-medical"></i></div>
                        <h3 class="item-title"><a href="Comming-Soon">Dental Care</a></h3>
                        <p>The best Dental Specialists of the most reputed dental hospitals.</p>
                <!-- <a class="item-btn" href="#">READ MORE<i class="fas fa-long-arrow-alt-right"></i></a> -->
                    </div>
                    <div class="departments-box-layout2">
                        <span class="departments-sl">02.</span>
                        <div class="item-icon"><i class="flaticon-pills"></i></div>
                        <h3 class="item-title"><a href="Comming-Soon">General Medicine</a></h3>
                        <p>The best and quality Medicines from most reputed Medical Stores.</p>
                <!-- <a class="item-btn" href="#">READ MORE<i class="fas fa-long-arrow-alt-right"></i></a> -->
                    </div>
                    <div class="departments-box-layout2">
                        <span class="departments-sl">03.</span>
                        <div class="item-icon"><i class="flaticon-medical-5"></i></div>
                        <h3 class="item-title"><a href="Comming-Soon">Cardiology</a></h3>
                        <p>The best and experienced cardiology Specialists are available in MyPulse.</p>
                <!-- <a class="item-btn" href="#">READ MORE<i class="fas fa-long-arrow-alt-right"></i></a> -->
                    </div>
                    <div class="departments-box-layout2">
                        <span class="departments-sl">04.</span>
                        <div class="item-icon"><i class="flaticon-human-hip"></i></div>
                        <h3 class="item-title"><a href="Comming-Soon">Orthopedic</a></h3>
                        <p>The best and experienced Orthopedic Specialists are available in MyPulse.</p>
                <!-- <a class="item-btn" href="#">READ MORE<i class="fas fa-long-arrow-alt-right"></i></a> -->
                    </div>
                </div>
            </div>
        </section>
        <!-- Departments Area End Here -->
        <!-- Our vision -->
<!--    <section class="team-wrap-layout1 bg-light-secondary100" data-bg-image="<?=base_url()?>assets/frontend/img/vision&mission1.png" style="background-repeat: no-repeat;background-size: 100%;">
            <div class="container" style="margin-top:15%;">
                <div class="row">
                <div class="col-xl-6 col-lg-12 col-12">
                    <div class="team-box-layout2">
                                    <div class="item-specialist">
                                                    <div class="media media-none--xs">
                                                        <div class="media-body">
                                                <h4 class="item-title"><a href="Comming-Soon">Our Vision:</a></h4>
                                                            <p>Be the de facto/one stop shop solution for Healthcare for everyone across the globe. (If you have MyPulse, you dont need anything else.)</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="col-xl-6 col-lg-12 col-12">
                                        <div class="team-box-layout2">
                                                <div class="item-specialist">
                                                    <div class="media media-none--xs">
                                                        <div class="media-body">
                                                            <h4 class="item-title"><a href="Comming-Soon">Our Mission:</a></h4>
                                                            <p>To make your healthcare experience “awesome”. (Make it so easy to manage Healthcare for everyone)</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
            </div>
        </section> -->
        <!-- Our vision -->
        <!-- Featured Area Start Here -->
<!--         <section class="features-wrap-layout1">
            <div class="features-box-layout1 d-lg-flex bg-primary100">
                <div class="item-inner-wrapper">
                    <div class="item-content d-flex align-items-center">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="item-content-inner content-light">
                                        <h2 class="item-title">Choose the best for your health</h2>
                                        <p>Dwisi enim ad minim veniam, quis laore nostrud exerci tation ulm hedi corper
                                            turet suscipit lobortis.</p>
                                        <ul class="list-item">
                                            <li>Free Consultation</li>
                                            <li>Quality Doctors</li>
                                            <li>Professional Experts</li>
                                            <li>Affordable Price</li>
                                            <li>24/7 Opened</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item-inner-wrapper">
                    <img src="<?=base_url();?>assets/frontend/img/figure/figure8.jpg" class="img-responsive" alt="figure">
                </div>
            </div>
            <div class="features-box-layout1 d-lg-flex flex-lg-row-reverse">
                <div class="item-inner-wrapper">
                    <div class="item-content d-flex align-items-center">
                        <div class="container">
                            <div class="row justify-content-end">
                                <div class="col-lg-6 col-sm-12 col-12">
                                    <div class="item-content-inner inner-title-dark">
                                        <h2 class="item-title">We are the trusted experts things simple</h2>
                                        <p>Dwisi enim ad minim veniam, quis laore nostrud exerci tation area ulm hedi
                                            corper turet suscipit lobortis nisl ut aliquip erat volutpat autem vel eum
                                            iriure dolor in hendrerit in vulputate.
                                        </p>
                                        <div class="skill-layout1">
                                            <div class="progress">
                                                <div class="lead">Efficency</div>
                                                <div style="width: 80%; visibility: visible; animation-duration: 1.5s; animation-delay: 0.4s;"
                                                    data-progress="95%" class="progress-bar progress-bar-striped wow fadeInLeft animated">
                                                    <span>80%</span>
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <div class="lead">Experience</div>
                                                <div style="width: 95%; visibility: visible; animation-duration: 1.5s; animation-delay: 0.6s;"
                                                    data-progress="85%" class="progress-bar progress-bar-striped wow fadeInLeft animated">
                                                    <span>95%</span>
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <div class="lead">Experience</div>
                                                <div style="width: 75%; visibility: visible; animation-duration: 1.5s; animation-delay: 0.8s;"
                                                    data-progress="99%" class="progress-bar progress-bar-striped wow fadeInLeft animated">
                                                    <span>75%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item-inner-wrapper">
                    <img src="<?=base_url();?>assets/frontend/img/figure/figure9.jpg" class="img-responsive" alt="figure">
                </div>
            </div>
        </section> -->
        <!-- Featured Area End Here -->
             <!-- Brand Area Start Here -->
   <!--      <section class="brand-wrap-layout1 bg-primary100">
            <div class="container">
                <div class="row">
                    <div class="brand-box-layout1 col-xl-7 col-lg-6 col-md-12 col-12">
                        <h2 class="item-title">We Are Certified Award Winning Hospital.</h2>
                    </div>
                    <div class="brand-box-layout2 col-xl-5 col-lg-6 col-md-12 col-12">
                        <img src="<?=base_url();?>assets/frontend/img/brand/brand-bg1.png" alt="brand" class="img-fluid d-none d-lg-block">
                        <ul>
                            <li>
                                <img src="<?=base_url();?>assets/frontend/img/brand/brand1.png" alt="brand" class="img-fluid">
                            </li>
                            <li>
                                <img src="<?=base_url();?>assets/frontend/img/brand/brand2.png" alt="brand" class="img-fluid">
                            </li>
                            <li>
                                <img src="<?=base_url();?>assets/frontend/img/brand/brand3.png" alt="brand" class="img-fluid">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- Brand Area End Here -->
  
          <!-- Banner Area Start Here -->
     <!--    <section class="banner-wrap-layout1 parallaxie" data-bg-image="<?=base_url()?>assets/frontend/img/figure/figure6.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-8 col-md-10 col-12">
                        <div class="banner-box-layout1">
                            <h2 class="item-title">For Emergency Cases</h2>
                            <h3 class="phone-number">1-800-555-0120</h3>
                            <p>Building a healthy environment that supports development for the community. Your
                                personal case manager will ensure that you receive the best possible care.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- Banner End Here -->
  <!-- Blog and Testimonial Area Start Here -->
<!--         <section class="both-side-half-bg">
            <div class="single-item">
                <div class="section-heading heading-dark heading-layout5">
                    <h2>Our Latest News</h2>
                </div>
                <div class="blog-box-layout1">
                    <h3 class="item-title"><a href="single-news.html">My dental office need a blog area galley
                            printingdern care to ailing dear.</a></h3>
                    <ul class="entry-meta">
                        <li><i class="far fa-calendar-alt"></i>21 July, 20 18</li>
                        <li><i class="fas fa-user"></i>Posted by <a href="#">admin</a></li>
                    </ul>
                </div>
                <div class="blog-box-layout1">
                    <h3 class="item-title"><a href="single-news.html">My dental office need a blog area galley
                            printingdern care to ailing dear.</a></h3>
                    <ul class="entry-meta">
                        <li><i class="far fa-calendar-alt"></i>21 July, 20 18</li>
                        <li><i class="fas fa-user"></i>Posted by <a href="#">admin</a></li>
                    </ul>
                </div>
                <a class="blog-btn" href="news1.html">SEE ALL NEWS<i class="fas fa-chevron-right"></i></a>
            </div>
            <div class="single-item bg-common" data-bg-image="img/figure/figure9.png">
                <div class="section-heading heading-light heading-layout5">
                    <h2>Testimonials</h2>
                    <div id="owl-nav3" class="owl-nav-layout2">
                        <span class="rt-prev">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                        <span class="rt-next">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    </div>
                </div>
                <div class="rc-carousel nav-control-layout7" data-loop="true" data-items="4" data-margin="30"
                    data-autoplay="false" data-autoplay-timeout="5000" data-custom-nav="#owl-nav3" data-smart-speed="2000"
                    data-dots="false" data-nav="false" data-nav-speed="false" data-r-x-small="1" data-r-x-small-nav="true"
                    data-r-x-small-dots="false" data-r-x-medium="1" data-r-x-medium-nav="false" data-r-x-medium-dots="false"
                    data-r-small="1" data-r-small-nav="false" data-r-small-dots="false" data-r-medium="1"
                    data-r-medium-nav="false" data-r-medium-dots="false" data-r-large="1" data-r-large-nav="false"
                    data-r-large-dots="false" data-r-extra-large="1" data-r-extra-large-nav="false"
                    data-r-extra-large-dots="false">
                    <div class="item">
                        <div class="testmonial-box-layout2">
                            <h4 class="item-title">Josef Ardogan <span>/ CEO Artland</span></h4>
                            <ul class="rating">
                                <li>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </li>
                                <li>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </li>
                                <li>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </li>
                                <li>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </li>
                                <li>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </li>
                            </ul>
                            <p>"Eodem modo typi, qui nunc nobis videntur parum clar fiant sollemnes in futurum. Lorem
                                ipsum dolor sit amet tetuer adipiscing elit, sed diam nonu."</p>
                        </div>
                        <div class="testmonial-box-layout2">
                            <h4 class="item-title">Josef Ardogan <span>/ CEO Artland</span></h4>
                            <ul class="rating">
                                <li>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </li>
                                <li>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </li>
                                <li>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </li>
                                <li>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </li>
                                <li>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </li>
                            </ul>
                            <p>"Eodem modo typi, qui nunc nobis videntur parum clar fiant sollemnes in futurum."</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testmonial-box-layout2">
                            <h4 class="item-title">Josef Ardogan <span>/ CEO Artland</span></h4>
                            <ul class="rating">
                                <li>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </li>
                                <li>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </li>
                                <li>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </li>
                                <li>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </li>
                                <li>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </li>
                            </ul>
                            <p>"Eodem modo typi, qui nunc nobis videntur parum clar fiant sollemnes in futurum. Lorem
                                ipsum dolor sit amet tetuer adipiscing elit, sed diam nonu."</p>
                        </div>
                        <div class="testmonial-box-layout2">
                            <h4 class="item-title">Josef Ardogan <span>/ CEO Artland</span></h4>
                            <ul class="rating">
                                <li>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </li>
                                <li>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </li>
                                <li>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </li>
                                <li>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </li>
                                <li>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </li>
                            </ul>
                            <p>"Eodem modo typi, qui nunc nobis videntur parum clar fiant sollemnes in futurum."</p>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- Blog and Testimonial Area End Here -->
        <!-- Call to Action Area Start Here -->
        <!-- <section class="call-to-action-wrap-layout4">
            <div class="item-img">
                <img src="<?=base_url();?>assets/frontend/img/figure/figure7.png" alt="figure" class="img-fluid">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-8 col-md-8 col-12">
                        <div class="call-to-action-box-layout4">
                            <h2 class="item-title">We Provide the highest level of satisfaction care &amp; services to
                                our patients.</h2>
                            <div class="call-to-action-phone">
                                <a href="tel:+12344092888"><i class="fas fa-phone"></i>+123 44092 888</a>
                            </div>
                            <div class="call-to-action-btn">
                                <a href="#" class="item-btn">Make an Appointment</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- Call to Action End Here -->