<style>
    .goog-te-banner-frame.skiptranslate {
    display: none !important;
    } 
body {
    top: 0px !important; 
    }
    .language-menu{
    border: 1px solid;
    border-radius: 43px;
    }
</style> 

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <span style="font-weight:200; margin:0px;font-size: 30px;"><?php if($this->session->userdata('login_type') == 'superadmin'){echo $system_name;}else{echo $this->db->where('hospital_id',$this->db->where('admin_id',$this->session->userdata('login_user_id'))->get('hospitaladmins')->row()->hospital_id)->get('hospitals')->row()->name;} ?></span>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav navbar-right"  style="font-size: 15px;">
      <li id="google_translate_element"></li>
     <!--  <li>
        <select name="hospital" class="form-control" value="<?php echo set_value('hospital'); ?>"  onchange="return get_branch(this.value)">
            <option value="">select</option>
            <option value="">telugu</option>
        </select>
      </li> -->
      <li class="dropdown language-menu">
        <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#" style="background-color: none !important;">
      <span id="selected" class="notranslate">Chose Language</span><span class="caret"></span></a>
         <ul class="dropdown-menu language">
    <li><a href="#" class="english notranslate" data-lang="English">English</a></li>
    <li class="divider"></li>
    <li><a href="#" class="hindi notranslate" data-lang="Hindi">Hindi</a></li>
    <li class="divider"></li>
    <li><a href="#" class="telugu notranslate" data-lang="Telugu">Telugu</a></li>
    <li class="divider"></li>
  </ul>
      </li>
   
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-bell"></i>
                            <span class="info">5</span></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url()?>index.php?<?= $account_type?>/manage_profile">
                          <i class="entypo-info"></i>
              <span>Edit_profile</span>
            </a></li>
          <li><a href="<?php echo base_url()?>index.php?<?= $account_type?>/manage_profile">
                          <i class="entypo-key"></i>
              <span>Change_password</span>
            </a></li>
          
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="glyphicon glyphicon-envelope"></i>
                            <span class="info">5</span></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url()?>index.php?<?= $account_type?>/manage_profile">
                          <i class="entypo-info"></i>
              <span>Edit_profile</span>
            </a></li>
          <li><a href="<?php echo base_url()?>index.php?<?= $account_type?>/manage_profile">
                          <i class="entypo-key"></i>
              <span>Change_password</span>
            </a></li>
          
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="entypo-user"></i>
        <?php echo $this->session->userdata('login_type'); ?>
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url()?>index.php?<?= $account_type?>/manage_profile">
                          <i class="entypo-info"></i>
              <span>Edit_profile</span>
            </a></li>
            <li class="divider"></li>
          <li><a href="<?php echo base_url()?>index.php?<?= $account_type?>/manage_profile">
                          <i class="entypo-key"></i>
              <span>Change_password</span>
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

 <script>
   $('.language a').click(function(){
    $('#selected').text($(this).text());
  });
 </script>
 <script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'am,ar,bn,de,el,en,fr,hi,ml,mr,ta,te,ur', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false, multilanguagePage: true}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<!-- Flag click handler -->
<script type="text/javascript">
    $('.language a').click(function() {
      var lang = $(this).data('lang');
      var $frame = $('.goog-te-menu-frame:first');
      if (!$frame.size()) {
        alert("Error: Could not find Google translate frame.");
        return false;
      }
      $frame.contents().find('.goog-te-menu2-item span.text:contains('+lang+')').get(0).click();
      return false;
    });
</script>