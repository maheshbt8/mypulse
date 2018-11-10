<?php
$system_name    = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
$system_title   = $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;
$text_align     = $this->db->get_where('settings', array('type' => 'text_align'))->row()->description;
$account_type   = $this->session->userdata('login_type');
$account_details=$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id');
?>

<!DOCTYPE html>
<html lang="en" dir="<?php if ($text_align == 'right-to-left') echo 'rtl'; ?>">
    <head>

        <title><?php echo $system_title; ?> - <?php echo $page_title; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!-- <meta charset="utf-8"> -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Mahesh BT" />
        <meta name="author" content="Mahesh BT" />



        <?php include 'includes_top.php'; ?> 
<!-- <script type="text/javascript"> 
function display_c(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('display_ct()',refresh)
}

function display_ct() {
var x = new Date()
var x1=x.getMonth() + 1+ "/" + x.getDate() + "/" + x.getYear(); 
x1 = x1 + " - " +  x.getHours( )+ ":" +  x.getMinutes() + ":" +  x.getSeconds();
document.getElementById('ct').innerHTML = x1;
display_c();
 }
</script> -->
    </head>
    <body class="page-body" onload=display_ct();>
        <div class="page-container " >
            
            <?php include 'main/navigation.php'; ?> 
            <div class="main-content">

                <?php include 'header.php'; ?>

                <h3 style="margin:20px 0px; color:#000; font-weight:200;">
                    <i class="entypo-right-circled"></i> 
                    <?php echo $page_title; ?><!-- <span id='ct' ></span> -->
                </h3>

                <?php include 'main/' . $page_name . '.php'; ?>

                <?php include 'footer.php'; ?>

            </div>

        </div>
        <?php include 'modal.php'; ?>
        <?php include 'includes_bottom.php'; ?>

    </body>
</html>