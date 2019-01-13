<style type="text/css" id="page-css">
.goog-te-banner-frame.skiptranslate {
    display: none !important;
    }
#lang_select ul {
  border-radius: 12px;
  height: 150px;
  overflow-y: scroll;
}
.user-profile img{
    width: 29px;
    height: 29px;
    border-radius: 50%;
    margin-right: 15px;
}
.list-body{
  height: 250px;
  overflow-x: auto;
}
</style>

    <?php
if($account_type == 'superadmin'){
  $img_type='superadmin_image';
}elseif($account_type == 'hospitaladmins'){
  $img_type='hospitaladmin_image';
}elseif($account_type == 'doctors'){
  $img_type='doctor_image';
}elseif($account_type == 'nurse'){
  $img_type='nurse_image';
}elseif($account_type == 'receptionist'){
  $img_type='receptionist_image';
}elseif($account_type == 'medicalstores'){
  $img_type='medical_stores';
}elseif($account_type == 'medicallabs'){
  $img_type='medical_labs';
}elseif($account_type == 'users'){
  $img_type='user_image';
}
if (file_exists('uploads/' . $img_type.'/' . $this->session->userdata('login_user_id') . '.jpg'))
      $image_url = base_url() . 'uploads/' . $img_type.'/' . $this->session->userdata('login_user_id') . '.jpg';
else
    $image_url = base_url() . 'uploads/user.jpg';
?>
    	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span></button>
					<a class="navbar-brand" href="<?php echo base_url('main'); ?>">
            <span>
                <img src="<?php echo base_url();?>assets/logo.png"  style="max-height:45px; margin: -15px;"/>
            </span>
                </a>
              <?php if($account_type != 'superadmin' && $account_type != 'users'){?>
      <span style="margin:5%;font-size: 35px;color: #fff;"><img src="<?php echo base_url();?>uploads/hospitallogs/<?= $this->session->userdata('hospital_id');?>.png"  style="max-height:45px; margin: -15px;"/>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->db->where('hospital_id',$this->session->userdata('hospital_id'))->get('hospitals')->row()->name; ?></span><?php }?>
<ul class="nav navbar-top-links navbar-right">
<li class="dropdown language-menu select" id="lang_select">
        <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#" style="width: 100%">
      <span id="selected" class="notranslate"><?php if($this->session->userdata('website_language_google')!=''){echo ucfirst($this->db->where('language_id',$this->session->userdata('website_language_google'))->get('language')->row()->name);}else{echo "English";}?></span><em class="fa fa-angle-down pull-right"></em>
  </a>
         <ul class="dropdown-menu language" id="lang_scroll_div">
         <?php 
         $lang_array=$this->db->get('language')->result();
    foreach($lang_array as $lng){ ?>
      <li class="notranslate" onclick="return get_lang(this.value)" value="<?php echo ucfirst($lng->language_id);?>">
        <a href="javascript:void(0);" data-value="<?php echo ucfirst($lng->name);?>"><?php echo ucfirst($lng->name);?>
        </a>
      </li>
    <?php }?>
  </ul>
      </li>
    <li class="dropdown">
    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
<em class="fa fa-bell"></em><span id="notification_count"></span>
    </a>
       <ul class="dropdown-menu dropdown-messages">
  <div class="list-body">
<?php $notification_data=$this->crud_model->select_notification();
if(count($notification_data) > 0){
    foreach ($notification_data as $row) {
    ?>
<li>

<div class="dropdown-messages-box">
<a href="<?php echo base_url()?>main/read_notification/<?= $row['id'];?>"><div class="message-body">
<strong><?= $row['title'];?></strong>.
 <?php
        if($row['isRead']==1){?><span style="color: green">&nbsp;&nbsp;<i class="fa fa-dot-circle-o fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;</span><?php }elseif($row['isRead']==2){?><span style="color: red">&nbsp;&nbsp;<i class="fa fa-dot-circle-o fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;</span><?php }?>
<br />
<small class="text-muted"><?= date('h:i A - d/m/Y',strtotime($row['created_at']));?></small>
</div>
</a>
<a href="<?=base_url('main/notification/delete/').$row['id'];?>"><b class="pull-right" style="font-size: 20px;"><i class="fa fa-times-circle-o"></i></b>
</a>
</div>
</li>
<li class="divider"></li>
<?php }?><?php }else{
    ?>
<li>
<div class="all-button">
    <br/>
<center><strong>No Notifications</strong></center></div>
</li>
<li class="divider"></li>
<?php }
          ?> 
</div>
<li class="divider"></li>
<li>
<div class="all-button"><!-- <a href="<?php echo base_url()?>main/notification/delete_all">
<strong>Clear All NotificationsAll Messages</strong></a> -->
  <a href="<?php echo base_url()?>main/notification">
<strong>View All Notifications</strong></a>
</div>
</li>
</ul>
</li>
<li class="dropdown">
    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
<em class="fa fa-envelope"></em><span id="message_count"></span>
	</a>
	   <ul class="dropdown-menu dropdown-messages">
  <div class="list-body">
<?php $message_data=$this->crud_model->select_message();
if($message_data!=''){
    foreach ($message_data as $row) {
    ?>
<a href="<?php echo base_url()?>main/read_message/<?= $row['message_id'];?>">
        <li>
        <div class="dropdown-messages-box">
<div class="message-body">
<strong><?= $row['title'];?></strong>.
    <?php $count=explode(',',$row['is_read']);
    $s=0;
    for($m2=0;$m2<count($count);$m2++){
        if($account_details == $count[$m2]){
                $s=1;
                break;
        }
        }
        if($s==1){?><span style="color: green">&nbsp;&nbsp;<i class="fa fa-dot-circle-o fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;</span><?php }elseif($s==0){?><span style="color: red">&nbsp;&nbsp;<i class="fa fa-dot-circle-o fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;</span><?php }?>
<br />
<small class="text-muted"><?= date('h:i A - d/m/Y',strtotime($row['created_at']));?></small>
</div>
</div>
</li>
<li class="divider"></li>
</a>
<?php }}else{?>
<li>
<div class="all-button">
    <br/>
<center><strong>No Messages Available</strong></center></div>
</li>
<li class="divider"></li>
<?php }
          ?> 
</div>
<li class="divider"></li>
<li>
<div class="all-button"><a href="<?php echo base_url()?>main/message">
<em class="fa fa-inbox"></em> <strong>All Messages</strong></a></div>
</li>
</ul>
</li>
<li class="dropdown">
<a class="dropdown-toggle user-profile" data-toggle="dropdown" href="#"  style="width: 100%;"><img src="<?=$image_url;?>" alt=""><span>
<?php $ac='';
 if($account_type=='doctors'){
  $ac='Dr.';
 }
 echo $ac.' '.$this->db->where($this->session->userdata('type_id').'_id',$this->session->userdata('login_user_id'))->get($account_type)->row()->name;?><em class="fa fa-angle-down"></em></span></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url()?>main/manage_profile"><em class="fa fa-user"></em><span>Profile</span>
            </a></li>
            <li class="divider"></li>
          <li><a href="<?php echo base_url()?>main/manage_password"><em class="fa fa-lock"></em><span>Change Password</span>
            </a></li>
            <li class="divider"></li>
          <li><a href="<?php echo base_url(); ?>login/logout">
              <em class="fa fa-sign-out"></em>
              <span>Log Out</span>
            </a></li>
          
        </ul>
      </li>
					</ul>
                                      <!--   <ul class="navbar-right theme-switcher">
                        <li><span>Choose Theme:</span></li>
                        <li><a href="#" title="Default" data-theme="default" class="theme-btn theme-btn-default">Default</a></li>
                        <li><a href="#" title="Iris" data-theme="iris" class="theme-btn theme-btn-iris">Iris</a></li>
                        <li><a href="#" title="Midnight" data-theme="midnight" class="theme-btn theme-btn-midnight">Midnight</a></li>
                        <li><a href="#" title="Lime" data-theme="lime"  class="theme-btn theme-btn-lime">Lime</a></li>
                        <li><a href="#" title="Rose" data-theme="rose" class="theme-btn theme-btn-rose">Rose</a></li>
                    </ul> -->
				</div>
			</div><!-- /.container-fluid -->
		</nav>
    
<?php $website_lang_int_google = $this->session->userdata('website_lang_int_google') != NULL ? trim($this->session->userdata('website_lang_int_google')) : 'en';?>
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script>
<div id="google_translate_element" style="display:none !important;"></div>

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
<script>
$( document ).ready(function() {
   $.ajax({
            url: '<?php echo base_url();?>ajax/get_message_count/',
            success: function(response)
            {
            jQuery('#message_count').html(response);
            } 
        });
   $.ajax({
            url: '<?php echo base_url();?>ajax/get_notification_count/',
            success: function(response)
            {
            jQuery('#notification_count').html(response);
            } 
        });
});
</script>