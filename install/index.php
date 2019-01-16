<?php
error_reporting(0); //Setting this to E_ALL showed that that cause of not redirecting were few blank lines added in some php files.

$db_config_path = '../application/views/config/database.php';

// Only load the classes in case the user submitted the form
if($_POST) {

	// Load the classes and create the new objects
	require_once('includes/core_class.php');
	require_once('includes/database_class.php');

	$core = new Core();
	$database = new Database();


	// Validate the post data
	if($core->validate_post($_POST) == true)
	{
        if($_POST['admin_password']=='MyPulse#@007'){
		// First create the database, then create tables, then write config file
		/*if($database->create_database($_POST) == false) {
			$message = $core->show_message('error',"The database could not be created, please verify your settings.");
		} else if ($database->create_tables($_POST) == false) {
			$message = $core->show_message('error',"The database tables could not be created, please verify your settings.");
		} else */if ($core->write_config($_POST) == false) {
			$message = $core->show_message('error',"The database configuration file could not be written, please chmod application/config/database.php file to 777");
		}
		// If no errors, redirect to registration page
		if(!isset($message)) {
		$redir = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
      $redir .= "://".$_SERVER['HTTP_HOST'];
      $redir .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
      $redir = str_replace('install/','',$redir); 
			header( 'Location:'.$redir) ;
		}
    }else{
        $message = $core->show_message('error','Admin Password Not Matched.');
    }
	}
	else {
		$message = $core->show_message('error','Not all fields have been filled in correctly. The admin password, host, username, password, and database name are required.');
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<title>MyPulse | Install</title>
        <link href="../assets/backend/css/bootstrap.min.css" rel='stylesheet' type='text/css'/>
		<style type="text/css">
		
		  
		  .error {
		    background: #ffd1d1;
		    border: 1px solid #ff5858;
        padding: 4px;
		  }
		</style>
	</head>
	<body style="background:#2C3E50">
    


<div class="container" style="margin-top:50px ">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"> <strong class="">MyPulse Installation</strong>

                </div>
                <div class="panel-body">

                	<?php if(is_writable($db_config_path)){?>

		  <?php if(isset($message)) {echo '<p class="error">' . $message . '</p>';}?>
		  			<h4>Database Seetings</h4>
		  			<hr/>
                   <form class="form-horizontal" id="install_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Admin Password</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="password" id="password" value="" class="input_text" name="admin_password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Hostname</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" id="hostname" value="localhost" class="input_text" name="hostname" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Database Username</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" id="username" class="input_text" name="username" autocomplete="off" >
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Database Password</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="password" id="password" class="input_text" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Database Name</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" id="database" class="input_text" name="database"  autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group last">
                            <div class="col-sm-offset-4 col-sm-8">
                                <button type="submit" class="btn btn-success btn-sm" id="submit">Install</button>
                                <button type="reset" class="btn btn-default btn-sm">Reset</button>
                            </div>
                        </div>
                    </form>

 <?php } else { ?>
      <p class="error">Please make the application/config/database.php file writable. <strong>Example</strong>:<br /><br /><code>chmod 777 application/config/database.php</code></p>
	  <?php } ?>

                </div>
                <div class="panel-footer">&copy 2019 JagruMs Technologies - All Rights Reserved
                </div>
            </div>
        </div>
    </div>
</div>
    <script language="JavaScript">
  /**
    * Disable right-click of mouse, F12 key, and save key combinations on page
    * By Arthur Gareginyan (arthurgareginyan@gmail.com)
    * For full source code, visit https://mycyberuniverse.com
    */
  window.onload = function() {
    document.addEventListener("contextmenu", function(e){
      e.preventDefault();
    }, false);
    document.addEventListener("keydown", function(e) {
    //document.onkeydown = function(e) {
      // "I" key
      if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
        disabledEvent(e);
      }
      // "J" key
      if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
        disabledEvent(e);
      }
      // "S" key + macOS
      if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
        disabledEvent(e);
      }
      // "U" key
      if (e.ctrlKey && e.keyCode == 85) {
        disabledEvent(e);
      }
      // "F12" key
      if (event.keyCode == 123) {
        disabledEvent(e);
      }
    }, false);
    function disabledEvent(e){
      if (e.stopPropagation){
        e.stopPropagation();
      } else if (window.event){
        window.event.cancelBubble = true;
      }
      e.preventDefault();
      return false;
    }
  };
</script>
</body>
</html>
