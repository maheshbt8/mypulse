<!DOCTYPE html> 
<html lang="en">
<head>
   <meta charset="utf-8">
   <title>ERROR 403 - FORBIDDEN</title>
 <link href="<?= base_url('assets/backend/')?>css/bootstrap.min.css" rel="stylesheet">
 <script src="<?= base_url('assets/backend/')?>js/jquery-1.11.1.min.js"></script>
  <script src="<?= base_url('assets/backend/')?>js/bootstrap.min.js"></script>

</head>
<body>
 <br/>
 <center>
 <div class="container">
  <div class="jumbotron">
   		<h1>ERROR 403 - FORBIDDEN</h1>
  <a type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo1">Why am I seeing this page?</a>
  <div id="demo1" class="collapse">
    <p>403 errors usually mean that the server does not have permission to view the requested file or resource.These errors are often caused by IP Deny rules, File protections, or permission problems.</p>
									<p>In many cases this is not an indication of an actual problem with the server itself but rather a problem with the information the server has been instructed to access as a result of the request. This error is often caused by an issue on your site which may require additional review by our support teams.</p>
									<p>Our support staff will be happy to assist you in resolving this issue. Please contact our Live Support or reply to any Tickets you may have received from our technicians for further assistance.</p>
  </div>

  
           <h4><a href="<?php echo base_url(); ?>">Go Back to Home</a></h4>
           <h4><a href="<?php echo base_url('login'); ?>">Go Back to Login</a></h4>
  </div>
</div>
 </center>
 <!-- Right click disable in this site!! -->
<script type="text/javascript">
jQuery(document).ready(function(){
    //Disable mouse right click
    $("body").on("contextmenu",function(e){
        return false;
    });
    document.onkeydown = function(e){
        if (e.ctrlKey &&
            (e.keyCode === 67 ||
                e.keyCode === 86 ||
                e.keyCode === 85 ||
                e.keyCode === 117)) {
            return false;
        } else {
            return true;
        }
    };
});
</script>

</body>
</html>

