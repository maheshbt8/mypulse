
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout, Display: false}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>  
<div class="row">
   
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
                        <a href="<?php echo base_url()?>index.php?.$account_type./manage_profile">
                            <i class="entypo-info"></i>
                            <span>Edit_profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>index.php?admin/manage_profile">
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
						<a href="<?php echo base_url()?>index.php?<?= $account_type?>/manage_profile">
                        	<i class="entypo-info"></i>
							<span>Edit_profile</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url()?>index.php?<?= $account_type?>/manage_profile">
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