<!-- <script language="javascript" type="text/javascript">
 function lanfTrans(lan)
 {
   switch(lan)
   {
   case 'en': document.getElementById('dlang').value='en';document.langForm.submit(); break;
   case 'fr': document.getElementById('dlang').value='fr'; document.langForm.submit(); break;
   case 'es': document.getElementById('dlang').value='es'; document.langForm.submit(); break;
   } 
 }
</script>
<form name="langForm" id="langForm" action="<?php echo base_url().'index.php?superadmin/languages';?>" method="post"> 

<?php // 'welcome' - [Home page controller] ?>

<input type="hidden" name="dlang" id="dlang"> 

<?php // 'dlang' - [Language choosen] ?>

<input type="hidden" name="current" id="current" value="<?php echo substr(uri_string(),1,strlen(uri_string()));?>">

<?php // 'current' - [Current page url] ?>

<?php // [Language images] ?>
 
<img src="<?=base_url()?>images/fr.png" onClick="lanfTrans('fr');" width="16" height="11" title="To French"> &nbsp; 

<img src="<?=base_url()?>images/en.png" onClick="lanfTrans('en');" width="16" height="11" title="To English"> &nbsp;
<img src="<?=base_url()?>images/es_flag.gif" onClick="lanfTrans('es');" width="16" height="11" title="To Spanish"> &nbsp;

<?php echo form_close(); ?>
<?php translate("Welcome to codeigniter",$lang);?> -->




<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout, Display: false}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script> 
<div class="row">
    <!-- Use CSS to replace link text with flag icons -->
<!-- <ul class="translation-links">
  <li><a href="#" class="spanish" data-lang="Spanish">Spanish</a></li>
  <li><a href="#" class="german" data-lang="German">German</a></li>
</ul> -->

<!-- Code provided by Google -->
<!-- <div id="google_translate_element"></div>
<script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');
  }
</script>
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script> -->

<!-- Flag click handler -->
<!-- <script type="text/javascript">
    $('.translation-links a').click(function() {
      var lang = $(this).data('lang');
      var $frame = $('.goog-te-menu-frame:first');
      if (!$frame.size()) {
        alert("Error: Could not find Google translate frame.");
        return false;
      }
      $frame.contents().find('.goog-te-menu2-item span.text:contains('+lang+')').get(0).click();
      return false;
    });
</script> -->
   
    <div class="col-md-12 col-sm-12 clearfix" style="text-align:center;">

        <span style="font-weight:200; margin:0px;font-size: 30px;"><?php if($this->session->userdata('login_type') == 'superadmin'){echo $system_name;}else{echo $this->db->where('hospital_id',$this->db->where('admin_id',$this->session->userdata('login_user_id'))->get('hospitaladmins')->row()->hospital_id)->get('hospitals')->row()->name;} ?></span>
   
        <ul class="list-inline links-list pull-right">
         <li class="dropdown language-selector"> <div id="google_translate_element"></div> </li> 
             <li class="dropdown language-selector">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true" aria-expanded="false">
                            <i class="glyphicon glyphicon-bell"></i>
                            <span class="info">5</span>
                <!-- <?php echo $this->session->userdata('login_type'); ?></a> -->

                                <ul class="dropdown-menu pull-left">
                    <li>
                        <a href="http://localhost/college/index.php/admin/manage_profile">
                            <i class="entypo-info"></i>
                            <span>Edit_profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="http://localhost/college/index.php/admin/manage_profile">
                            <i class="entypo-key"></i>
                            <span>Change_password</span>
                        </a>
                    </li>
                </ul>
                                            </li>
            <li class="dropdown language-selector">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true" aria-expanded="false">
                            <i class="glyphicon glyphicon-envelope"></i>
                            <span class="info">5</span>
                <!-- <?php echo $this->session->userdata('login_type'); ?></a> -->

                                <ul class="dropdown-menu pull-left">
                    <li>
                        <a href="http://localhost/college/index.php/admin/manage_profile">
                            <i class="entypo-info"></i>
                            <span>Edit_profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="http://localhost/college/index.php/admin/manage_profile">
                            <i class="entypo-key"></i>
                            <span>Change_password</span>
                        </a>
                    </li>
                </ul>
                                            </li>
            <li class="dropdown language-selector">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true" aria-expanded="false">
                        	<i class="entypo-user"></i>
				<?php echo $this->session->userdata('login_type'); ?></a>

								<ul class="dropdown-menu pull-left">
					<li>
						<a href="http://localhost/college/index.php/admin/manage_profile">
                        	<i class="entypo-info"></i>
							<span>Edit_profile</span>
						</a>
					</li>
					<li>
						<a href="http://localhost/college/index.php/admin/manage_profile">
                        	<i class="entypo-key"></i>
							<span>Change_password</span>
						</a>
					</li>
				</ul>
											</li>
            <li>
                <a href="<?php echo base_url(); ?>index.php?login/logout">
                    Log Out <i class="entypo-logout right"></i>
                </a>
            </li>
        </ul>
    </div>

</div>

<hr style="margin-top:0px;" />