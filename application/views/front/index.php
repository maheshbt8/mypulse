<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>MyPulse | <?=$page_title;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Welcome to MyPulse, Healthcare solution that provides a seamless experience for Hospitals and end users. Book appointments, Manage prescriptions and health records across the hospitals, Order Medicines and Medical Tests.">
    <meta name="keywords" content="Healthcare, MyPulse, Book appointments, Manage health records, Prescriptions, Order medicines, Order Medical tests" />
<?php include('header_links.php');?>
</head>

<body>
    <!-- Preloader Start Here -->
    <!-- <div id="preloader"></div> -->
    <!-- Preloader End Here -->
    <!-- scrollUp Start Here -->
    <a href="#wrapper" data-type="section-switch" class="scrollUp">
        <i class="fas fa-angle-double-up"></i>
    </a>
    <!-- scrollUp End Here -->
    <div id="wrapper" class="wrapper">
       <?php include('header_menu.php');?>
       <?php include $page_name . '.php'; ?>
        <!-- Footer Area Start Here -->
        <footer>
            <section class="footer-top-wrap">
                <div class="container">
                    <div class="row">
                        <div class="single-item col-lg-3 col-md-6 col-12">
                            <div class="footer-box">
                                <div class="footer-logo">
                                    <a href="<?=base_url()?>"><img src="<?=base_url('MyPulse-Logo');?>" class="img-fluid" alt="footer-logo" draggable="false"></a>
                                </div>
                                <!-- <div class="footer-about">
                                    <p>We are ipsum dolor sit amet aeeatt consectetuer adipiscing elitseder diam
                                        nonummy.
                                    </p>
                                </div> -->
                                <div class="footer-contact-info">
                                    <ul>
                                        <li><i class="fas fa-map-marker-alt"></i><?=$this->db->get_where('settings', array('setting_type' => 'address'))->row()->description;?>
                                    </li>
                                        <li><i class="fas fa-phone"></i><?=$this->db->get_where('settings', array('setting_type' => 'phone'))->row()->description;?></li>
                                        <li><i class="far fa-envelope"></i><?=$this->db->get_where('settings', array('setting_type' => 'system_email'))->row()->description;?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="single-item col-lg-3 col-md-6 col-12">
                            <div class="footer-box">
                                <div class="footer-header">
                                    <h3>Departments</h3>
                                </div>
                                <div class="footer-departments">
                                    <ul>
                                        <li><a href="Comming-Soon">Dental Care</a></li>
                                        <li><a href="Comming-Soon">General Medicine</a></li>
                                        <li><a href="Comming-Soon">Cardiology</a></li>
                                        <li><a href="Comming-Soon">Orthopedic</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div> -->
                        <div class="single-item col-lg-3 col-md-6 col-12"></div>
                        <div class="single-item col-lg-3 col-md-6 col-12"></div>
                        <div class="single-item col-lg-3 col-md-6 col-12">
                            <div class="footer-box">
                                <div class="footer-header">
                                    <h3>Quick Links</h3>
                                </div>
                                <div class="footer-quick-link">
                                    <ul>
                                        <li><a href="<?=base_url()?>">Home</a></li>
                                        <li><a href="<?=base_url()?>#what-we-offer">What We Offer</a></li>
                                        <li><a href="Comming-Soon">Faq’s</a></li>
                                        <li><a href="Contact-Us">Contact-Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="single-item col-lg-3 col-md-6 col-12">
                            <div class="footer-box">
                                <div class="footer-header">
                                    <h3>Follow Us:</h3>
                                </div>
                                <div class="footer-social">
                                    <ul>
                                        <li><img src="<?=base_url('assets/frontend/img/fb.png');?>"/></li>
                                        <li><img src="<?=base_url('assets/frontend/img/insta.png');?>"/></li>
                                        <li><img src="<?=base_url('assets/frontend/img/g+.png');?>"/></li><br/><br/>
                                        <li><img src="<?=base_url('assets/frontend/img/linkedin.png');?>"/></li>
                                        <li><img src="<?=base_url('assets/frontend/img/twitter.png');?>"/></li>
                                        <li><img src="<?=base_url('assets/frontend/img/youtube.png');?>"/></li>
                                    </ul>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </section>
            <!-- <section class="footer-center-wrap">
                <div class="container">
                    <div class="row no-gutters">
                        <div class="col-lg-4 col-12">
                            <div class="footer-social">
                                <ul>
                                    <li>Follow Us:</li>
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                    <li><a href="#"><i class="fab fa-skype"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-8 col-12">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="newsletter-title">
                                        <h4 class="item-title">Stay informed and healthy</h4>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="newsletter-form">
                                        <div class="input-group stylish-input-group">
                                            <input type="text" class="form-control" placeholder="Enter your e-mail">
                                            <span class="input-group-addon">
                                                <button type="submit">
                                                    <span aria-hidden="true">SIGN UP!</span>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->
            <section class="footer-bottom-wrap">
                <div class="copyright" style="color: #fff;">© 2019 JagruMs Technologies - All Rights Reserved.&nbsp;&nbsp;<a href="<?=base_url('Terms&Coditions')?>" target="_blank">Terms & Conditions</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                <a href="<?=base_url('Privacy&Policy');?>" target="_blank">Privacy & Policy</a></div>
            </section>
        </footer>
        <!-- Footer Area End Here -->
    </div>
    <?php include('footer_links.php');?>
</body>
</html>