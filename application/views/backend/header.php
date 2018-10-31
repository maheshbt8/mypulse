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
width:300px;
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
.span-title{
    display: inline-block;
    width: 250px;
    white-space: nowrap;
    overflow: hidden !important;
    text-overflow: ellipsis;
}
.navbar{
  border-radius: 0px;
  margin-left: -1px;
  background-color: #263238;
}
.container-fluid{
  padding-bottom: 9px;
}
</style>

<?php 
$website_language_google = $this->session->userdata('website_language_google') != NULL ? $this->session->userdata('website_language_google') : '1';
/*$website_language_image = '<img src="'.FRONT_ASSETS.'images/lang_flag/'.$website_language_google.'.png" style="margin-right:15px;" alt="'.$website_language_google.'"> '.$website_language_google;*/ 
?>

<nav class="navbar">
  <div class="container-fluid">
    <div class="navbar-header">
       <button type="button" class="navbar-toggle" style="border-color: #fff" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar" style="background-color: #fff"></span>
        <span class="icon-bar" style="background-color: #fff"></span>
        <span class="icon-bar" style="background-color: #fff"></span>                        
      </button>
      <?php if($account_type != 'superadmin' && $account_type != 'users'){?>
      <span style="font-weight:200; margin:12px;font-size: 30px;color: #fff;"><img src="<?php echo base_url();?>uploads/hospitallogs/<?= $this->session->userdata('hospital_id');?>.png"  style="max-height:45px; margin: -15px;"/>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->db->where('hospital_id',$this->session->userdata('hospital_id'))->get('hospitals')->row()->name; ?></span><?php }?>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav navbar-right"  style="font-size: 15px;">
       <li class="dropdown language-menu select" id="lang_select">
        <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#" style="background-color: none !important;bottom:7px;color: #fff;">
      <span id="selected" class="notranslate"><?php if($this->session->userdata('website_language_google')!=''){echo ucfirst($this->db->where('language_id',$this->session->userdata('website_language_google'))->get('language')->row()->name);}else{echo "English";}?></span><span class="entypo-down-open"></span></a>
         <ul class="dropdown-menu language" id="lang_scroll_div">
         <?php 
         $lang_array=$this->db->get('language')->result();
/*    $lang_array = array("English","Bengali","Hindi","Telugu");*/
    foreach($lang_array as $lng){ ?>
      <li class="notranslate" onclick="return get_lang(this.value)" value="<?php echo ucfirst($lng->language_id);?>">
        <a href="javascript:void(0);" data-value="<?php echo ucfirst($lng->name);?>">
           <!--<img src="#" style="margin-right:15px;height:20px;" alt="<?php echo $lng_name;?>">--><?php echo ucfirst($lng->name);?>
        </a>
      </li>
    <?php }?>
  </ul>
      </li>
      <li class="dropdown">
        <?php 
          $noti_read=$this->db->get_where('notification',array('user_id'=>$account_details,'isRead'=>2));
        ?>
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: #fff;"><i class="glyphicon glyphicon-bell"></i>
        <span class="info"><!-- <?php echo $noti_read->num_rows();?> --></span></a>
        <ul class="dropdown-menu notification">
          <li class="notification-header"><h4>Notifications</h4></li>
          <div class="notification-body">
          <?php 
          $private_message_data=$noti_read->result_array();
            $i=1;foreach ($private_message_data as $row) {
            if(date('Y-m-d',strtotime($row['created_at']))==date('Y-m-d'))
              {
                ?>
          <a href="<?php echo base_url()?>main/read_notification/<?= $row['message_id'];?>"><li class="notification-list"><span class="span-title"><?= $row['title']?></span></li></a>
          <?php }
          }?>
          </div>
          <hr/>
          <a href="<?php echo base_url()?>main/notification" class="hiper"><center>All Notifications</center></a>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"  style="color: #fff;"> <i class="glyphicon glyphicon-envelope"></i>
        <!-- <span class="info">5</span> --></a>
        <ul class="dropdown-menu notification">
          <li class="notification-header"><h4>Messages</h4></li>
          <div class="notification-body">
          <?php $message_data=$this->crud_model->select_message();
            $i=0;foreach ($message_data as $row) {
       $message1=explode(',',$row['user_to']);
       $message2=explode(',',$row['user_too']);
       $hospi='';
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
  
  $hospi1='';
  for($m2=0;$m2<count($message2);$m2++){
    if($message2[$m2] == $account_details){
    $hospi1=$message2[$m2];    
    }
    if($account_type == 'superadmin'){
    if($hospi1 == $account_details || $hospi==$account_type)
              {
               ?>
               <a href="<?php echo base_url()?>index.php?<?= $account_type?>/read_message/<?= $row['message_id'];?>"><li class="notification-list"><span class="span-title"><?= $row['title'];?></span>
               </li>
              </a>
               <?php 
              }  
    }else{
    if(($hospi1 == $account_details || $hospi==$account_type) && ($row['hospital_id'] == 0 || $row['hospital_id'] == $this->session->userdata('hospital_id')))
              {
               ?>
               <a href="<?php echo base_url()?>index.php?<?= $account_type?>/read_message/<?= $row['message_id'];?>"><li class="notification-list"><span class="span-title"><?= $row['title'];?></span>
               </li>
              </a>
               <?php 
              }
            }

          $i++;}}}?> 
          </div>
          <hr/>
          <a href="<?php echo base_url()?>main/message" class="hiper"><center>All Messages</center></a>
        </ul>
       
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"  style="color: #fff;"><i class="entypo-user"></i><span>
<?php echo $this->db->where($this->session->userdata('type_id').'_id',$this->session->userdata('login_user_id'))->get($account_type)->row()->name;?></span><i class="entypo-down-open"></i></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url()?>main/manage_profile">
                          <i class="entypo-info"></i>
              <span>Profile</span>
            </a></li>
            <li class="divider"></li>
          <li><a href="<?php echo base_url()?>main/manage_password">
                          <i class="entypo-key"></i>
              <span>Change Password</span>
            </a></li>
          
        </ul>
      </li>
      <li><a href="<?php echo base_url(); ?>login/logout" style="color: #fff;">
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
            url: '<?php echo base_url();?>ajax/get_lang/' + lang_id ,
            success: function(response)
            {
                jQuery('#selected').html(response);
            } 
        });
   
    } 
</script>

