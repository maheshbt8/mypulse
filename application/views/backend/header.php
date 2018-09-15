<div class="row">
    <div class="col-md-12 col-sm-12 clearfix" style="text-align:center;">
        <h2 style="font-weight:200; margin:0px;"><?php if($this->session->userdata('login_type') == 'superadmin'){echo $system_name;}else{echo $this->db->where('hospital_id',$this->db->where('admin_id',$this->session->userdata('login_user_id'))->get('admin')->row()->hospital_id)->get('hospitals')->row()->name;} ?></h2>
    </div>

    <!-- Raw Links -->
    <div class="col-md-12 col-sm-12 clearfix ">

        <ul class="list-inline links-list pull-right">
                        
            <li class="dropdown language-selector">
			<!--<a href="http://localhost/college/index.php/home" target="_blank">
				<i class="entypo-globe"></i> Website
			</a>-->
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