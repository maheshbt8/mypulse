<style type="text/css" id="page-css">
.goog-te-banner-frame.skiptranslate {
    display: none !important;
    } 
body {
    top: 0px !important; 
    }
    .language-menu{
    /*border: 1px solid;*/
    height:0px;
    top: 5px;
    padding-bottom: 40px;
    border-radius: 8px;
    }
#lang_select ul {
  border-radius: 12px;
  height: 150px;
  overflow-y: scroll;
}
#lang_select .dropdown-menu.option > li {
  float: left;
  width: 100%;
}
#lang_select .option img {
  float: left;
  height: 18px;
  margin-right: 5px !important;
  width: 25px;
}
.selected.lang_selected > img {
  height: 18px;
  width: 25px;
}
ul.dropdown-menu.notification{
border-radius:4px;
height:250px;
width:250px;
background-color:#f1f1f1;
}
li.notification-header{
  border:1px solid;
  text-align:center;
  background-color:#d6d6d4bf;
}
hr{
  margin-top: 0px;
  margin-bottom: 5px;
  border-top:2px solid #e7e7e7;
}
div.notification-body{
  height:180px;
  overflow-y: scroll;
}
li.notification-list{
border: 1px solid #d6d2d2a3;
padding: 10px;
}
.nav > li{
  float: left;
}
</style>

<?php 
$website_language_google = $this->session->userdata('website_language_google') != NULL ? $this->session->userdata('website_language_google') : '1';
/*$website_language_image = '<img src="'.FRONT_ASSETS.'images/lang_flag/'.$website_language_google.'.png" style="margin-right:15px;" alt="'.$website_language_google.'"> '.$website_language_google;*/ 
?>
<nav class="navbar navbar-default ">
  <div class="container-fluid">
    <div class="navbar-header">
       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <span style="font-weight:200; margin:0px;font-size: 30px;"><?php if($this->session->userdata('login_type') == 'superadmin'){echo '';}else{echo $this->db->where('hospital_id',$this->db->where('admin_id',$this->session->userdata('login_user_id'))->get('hospitaladmins')->row()->hospital_id)->get('hospitals')->row()->name;} ?></span>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav navbar-right"  style="font-size: 15px;">
       <li class="dropdown language-menu select" id="lang_select">
        <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#" style="background-color: none !important;bottom:7px;">
      <span id="selected" class="notranslate"><?php if($this->session->userdata('website_language_google')!=''){echo ucfirst($this->db->where('language_id',$this->session->userdata('website_language_google'))->get('language')->row()->name);}else{echo "English";}?></span>&nbsp;<span class="caret"></span></a>
         <ul class="dropdown-menu language" id="lang_scroll_div">
         <?php 
         $lang_array=$this->db->get('language')->result();
/*    $lang_array = array("English","Bengali","Hindi","Telugu");*/
    foreach($lang_array as $lng){ ?>
      <li class="notranslate" onclick="return get_lang(this.value)" value="<?php echo ucfirst($lng->language_id);?>">
        <a href="javascript:void(0);" data-value="<?php echo ucfirst($lng->name);?>">
           <!--<img src="https://cmkt-image-prd.global.ssl.fastly.net/0.1.0/ps/1465289/580/386/m1/fpnw/wm0/untitled-1-o-f-.png?1468935112&s=e27502b7e45bfc6d7f1cc26f6696109d" style="margin-right:15px;height:20px;" alt="<?php echo $lng_name;?>">--><?php echo ucfirst($lng->name);?>
        </a>
      </li>
    <?php }?>
  </ul>
      </li>
      <li class="dropdown">
        <?php 
        $user_id=$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id');
          $noti_read=$this->db->get_where('notification',array('user_id'=>$user_id,'isRead'=>2));
        ?>
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-bell"></i>
        <span class="info"><!-- <?php echo $noti_read->num_rows();?> --></span></a>
        <ul class="dropdown-menu notification">
          <li class="notification-header"><h4>Notifications</h4></li>
          <div class="notification-body">
          <?php 
          $private_message_data=$noti_read->result_array();/*$this->crud_model->select_notification()*/
            $i=1;foreach ($private_message_data as $row) {
            if(date('Y-m-d',strtotime($row['created_at']))==date('Y-m-d'))
              {
                ?>
          <a href="<?php echo base_url()?>index.php?<?= $account_type?>/read_notification/<?= $row['message_id'];?>"><li class="notification-list"><span><?= $row['title']?></span></li></a>
          <?php }
          }?>
          </div>
          <hr/>
          <a href="<?php echo base_url()?>index.php?<?= $account_type?>/notification" class="hiper"><center>All Notifications</center></a>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="glyphicon glyphicon-envelope"></i>
        <!-- <span class="info">5</span> --></a>
        <ul class="dropdown-menu notification">
          <li class="notification-header"><h4>Messages</h4></li>
          <div class="notification-body">
          <?php $message_data=$this->crud_model->select_message();

            $i=0;foreach ($message_data as $row) {
       $message1=explode(',',$row['user_to']);
       $message2=explode(',',$row['user_too']);
        for($m1=0;$m1<count($message1);$m1++){
            
    if($message1[$m1] == 1){
    $hospi='hospitaladmins';    
    }elseif($message1[$m1] == 2){
    $hospi='medicallabs';
    }elseif($message1[$m1] == 3){
    $hospi='medicalstores';
    }elseif($message1[$m1] == 4){
    $hospi='doctors';
    }elseif($message1[$m1] == 5){
    $hospi='nurse';
    }elseif($message1[$m1] == 6){
    $hospi='receptionist';
    }elseif($message1[$m1] == 7){
    $hospi='users';
    }
    if((($row['user_too']==$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id')) or $hospi==$this->session->userdata('login_type')) and (date('Y-m-d',strtotime($row['created_at']))==date('Y-m-d')))
              {
               ?>
               <a href="<?php echo base_url()?>index.php?<?= $account_type?>/read_message/<?= $row['message_id'];?>"><li class="notification-list"><span><?= $row['title']?></span>
               </li>
              </a>
               <?php 
              }
            }

          $i++;}?> 
          </div>
          <hr/>
          <a href="<?php echo base_url()?>index.php?<?= $account_type?>/message" class="hiper"><center>All Messages</center></a>
        </ul>
       
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="entypo-user"></i>
        <?php
        if($account_type == 'superadmin'){
  $user_role='Super Admin';
}elseif($account_type == 'hospitaladmins'){
  $user_role='Hospital Admin';
}elseif($account_type == 'doctors'){
  $user_role='Doctor';
}elseif($account_type == 'nurse'){
  $user_role='Nurse';
}elseif($account_type == 'receptionist'){
  $user_role='Receptionist';
}elseif($account_type == 'medicalstores'){
  $user_role='Pharmacist';
}elseif($account_type == 'medicallabs'){
  $user_role='Laboratorist';
}elseif($account_type == 'users'){
  $user_role='MyPulse Users';
}
        echo $user_role; ?>
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url()?>index.php?<?= $account_type?>/manage_profile">
                          <i class="entypo-info"></i>
              <span>Profile</span>
            </a></li>
            <li class="divider"></li>
          <li><a href="<?php echo base_url()?>index.php?<?= $account_type?>/manage_password">
                          <i class="entypo-key"></i>
              <span>Change Password</span>
            </a></li>
          
        </ul>
      </li>
      <li><a href="<?php echo base_url(); ?>index.php?login/logout">
                    Log Out <i class="entypo-logout right"></i>
                </a></li>
    </ul>
  </div>
  </div>
</nav>  


<?php $website_lang_int_google = $this->session->userdata('website_lang_int_google') != NULL ? trim($this->session->userdata('website_lang_int_google')) : 'en';?>
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script>
<div id="google_translate_element" style="display:none;"></div>

<script type="text/javascript">
function googleTranslateElementInit() { 
  new google.translate.TranslateElement({pageLanguage:'',autoDisplay: false},'google_translate_element'); //remove the layout
}
</script>

<script type="text/javascript">
function triggerHtmlEvent(element, eventName)
{
  
    var event;
    if(document.createEvent)
  {
        event = document.createEvent('HTMLEvents');
        event.initEvent(eventName, true, true);
        element.dispatchEvent(event);
    }
    else
  {
      event = document.createEventObject();
        event.eventType = eventName;
        element.fireEvent('on' + event.eventType, event);
    }
  //window.location.reload();
}


$('ul#lang_scroll_div li a').on('click',function(){
  
  var lang = $(this).attr('data-value');
  var selected_str = '<img src="<?php echo FRONT_ASSETS ?>images/lang_flag/'+lang+'.png" style="margin-right:15px;width:25px;height:18px;"> '+lang;
  $('.lang_selected').html(selected_str);
  
  /*$('#lang_scroll_div').hide();*/
  
  var language = lang;
  $('#google_translate_element select option').each(function(){
      if($(this).text().indexOf(lang) > -1){ 
      $(this).parent().val($(this).val());  
      var container = document.getElementById('google_translate_element');
      var select = container.getElementsByTagName('select')[0];
      triggerHtmlEvent(select, 'change');
      var lang_int = $(this).val();

    /*  jQuery.ajax({
        type: 'POST',
        url: SITE_URL + 'ajax/switch_lang_google/'+language+'/'+lang_int,
        data: '',
        success: function(result) {  
         $(".translated-ltr").attr("lang",result);
        }
      });*/
      }
    });
});


$("#google_translate_element").hide();
 function get_lang(lang_id) {
     $.ajax({
            url: '<?php echo base_url();?>index.php?ajax/get_lang/' + lang_id ,
            success: function(response)
            {
                jQuery('#selected').html(response);
            } 
        });
   
    } 
</script>

