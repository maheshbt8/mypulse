<?php
    $this->load->view('template/header.php');
    $this->load->view('template/left.php');
?>
    <input type="hidden" id="left_active_menu" value="1" />
    <div id="main-wrapper">
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <a href="<?php echo site_url();?>/hospitals">
                <div class="panel info-box panel-white">
                    <div class="panel-body">
                        <div class="info-box-stats">
                            <p class="counter"><?php echo $states['tot_hos'];?></p>
                            <span class="info-box-title"><?php echo $this->lang->line('hospitals');?></span>
                        </div>
                        <div class="info-box-icon">
                            <i class="fa fa-hospital-o"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6">
            <a href="<?php echo site_url();?>/doctors">
                <div class="panel info-box panel-white">
                    <div class="panel-body">
                        <div class="info-box-stats">
                            <p class="counter"><?php echo $states['tot_doc'];?></p>
                            <span class="info-box-title"><?php echo $this->lang->line('doctors');?></span>
                        </div>
                        <div class="info-box-icon">
                            <i class="fa fa-user-md"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6">
            <a href="<?php echo site_url();?>/patients">
                <div class="panel info-box panel-white">
                    <div class="panel-body">
                        <div class="info-box-stats">
                            <p><span class="counter"><?php echo $states['tot_pat'];?></span></p>
                            <span class="info-box-title"><?php echo $this->lang->line('patients');?></span>
                        </div>
                        <div class="info-box-icon">
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6">
            <a href="<?php echo site_url();?>/appoitments">
                <div class="panel info-box panel-white">
                    <div class="panel-body">
                        <div class="info-box-stats">
                            <p class="counter"><?php echo $states['tot_app'];?></p>
                            <span class="info-box-title"><?php echo $this->lang->line('appointments');?></span>
                        </div>
                        <div class="info-box-icon">
                            <i class="icon-envelope"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
<?php
    $this->load->view('template/footer.php');
?>