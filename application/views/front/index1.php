<!DOCTYPE HTML>
<html lang="en">

<head>
	<title>MYPULSE - <?=$page_title;?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
  <meta name="description" content="type_your_description_here">
	<meta name="keywords" content="Home Loan Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<?php include 'includes_top.php'; ?>
</head>

<body>
	
	<?php include 'navigation.php'; ?>
	<?php include $page_name . '.php'; ?>
   <!-- services -->
        <div class="agileits-services py-5 position-relative" id="services">
            <span class="icon-trans">s</span>
            <div class="container py-lg-5">
                <div class="title-wthree text-center">
                    <h3 class="agile-title   text-white">
                        our services
                    </h3>
                    <span></span>
                </div>
                <div class="agileits-services-row row  py-md-5 pb-5">
                    <div class="col-lg-4">
                        <div class="agileits-services-grids">
                            <i class="fab fa-sellcast"></i>
                            <h4 class="sec-title">Service 1
                            </h4>
                            <span></span>
                            <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="agileits-services-grids mt-lg-0 mt-5">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <h4 class="sec-title">Service 2
                            </h4>
                            <span></span>
                            <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="agileits-services-grids mt-lg-0 mt-5">
                            <i class="fas fa-globe"></i>
                            <h4 class="sec-title">Service 3
                            </h4>
                            <span></span>
                            <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.</p>
                        </div>
                    </div>
                </div>
                <div class="agileits-services-row row  pb-md-5">
                    <div class="col-lg-4">
                        <div class="agileits-services-grids">
                            <i class="fas fa-briefcase"></i>
                            <h4 class="sec-title">Service 4
                            </h4>
                            <span></span>
                            <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="agileits-services-grids mt-lg-0 mt-5">
                            <i class="far fa-image"></i>
                            <h4 class="sec-title">Service 5
                            </h4>
                            <span></span>
                            <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="agileits-services-grids mt-lg-0 mt-5">
                            <i class="far fa-paper-plane"></i>
                            <h4 class="sec-title">Service 6
                            </h4>
                            <span></span>
                            <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- //services -->

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


<!-- Modal -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Login Here</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <form role="form" action="<?=base_url('login/validate_login');?>" method="post">
      <div class="modal-body">
     <div class="agileits-w3layouts-info">
      <div class="form-group">
  <label for="usr">Email :</label>
  <input type="text" class="form-control" id="email" name="email" onchange="return get_email(this.value)">
</div>
<div class="form-group">
  <label for="pwd">Password :</label>
  <input type="password" class="form-control" id="password" name="password">
</div>
<div class="form-group">
  <input type="button" class="form-control" id="password" value="Login" onlick="login();">
</div>
    </div>
  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onClick="login(this.form);">Login</button>
      </div>
  </form>
    </div>
  </div>
</div>
<!-- //Modal -->
<?php include 'includes_bottom.php'; ?>
<script>
     $(document).ready(function(){
     function get_email(email_value) {
      
     $.ajax({
            type : "POST",
            url: '<?php echo base_url();?>ajax/get_email/' ,
            data : {email : email_value},
            success: function(response)
            {
                jQuery('#email_error').html(response);        
            } 
        });
   
    }
     function get_phone(phone_value) {
     $.ajax({
            type : "POST",
            url: '<?php echo base_url();?>ajax/get_phone/' ,
            data : {phone : phone_value},
            success: function(response)
            {
                jQuery('#phone_error').html(response);        
            } 
        });
   
    }
});
</script>
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
    <?php include 'footer.php'; ?>
</body>
</html>