<!-- <!DOCTYPE html> 
<html lang="en">
<head>
   <meta charset="utf-8">
   <title>ERROR 40 - NOT FOUND</title>
 <link href="<?= base_url('assets/backend/')?>css/bootstrap.min.css" rel="stylesheet">
 <script src="<?= base_url('assets/backend/')?>js/jquery-1.11.1.min.js"></script>
</head>
<body> -->
 <br/>
 <center>
 <div class="container">
  <div class="jumbotron">
   		<h1>ERROR 404 - NOT FOUND</h1>
 <h2>This page isn't available</h2>
           <h4><a href="<?php echo base_url(); ?>">Go Back to Home</a></h4>
           <h4><a href="<?php echo base_url('login'); ?>">Go Back to Login</a></h4>
  </div>
</div>
 </center>

 <!-- Right click disable in this site!! -->
<!-- <script type="text/javascript">
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
</html> -->