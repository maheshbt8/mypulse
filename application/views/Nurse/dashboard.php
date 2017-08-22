<?php
    $this->load->view('template/header.php');
    $this->load->view('template/left.php');
?>    
    <input type="hidden" id="left_active_menu" value="1" />
    <div id="main-wrapper">
        <div class="row">    
        </div><!-- Row -->
        <div class="row">
        <div class="col-lg-3 col-md-6">
                <div class="panel info-box panel-white">
                    <div class="panel-body">
                        <div class="info-box-stats">
                            <p class="counter"><?php echo $states['doc_count'];?></p>
                            <span class="info-box-title"><?php echo $this->lang->line('doctors');?></span>
                        </div>
                        <div class="info-box-icon">
                            <i class="fa fa-user-md"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel info-box panel-white">
                    <div class="panel-body">
                        <div class="info-box-stats">
                            <p><span class="counter"><?php echo $states['dep_count'];?></span></p>
                            <span class="info-box-title"><?php echo $this->lang->line('departments');?></span>
                        </div>
                        <div class="info-box-icon">
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel info-box panel-white">
                    <div class="panel-body">
                        <div class="info-box-stats">
                            <p class="counter"><?php  echo $states['patient_count'];?></p>
                            <span class="info-box-title"><?php echo $this->lang->line('users');?></span>
                        </div>
                        <div class="info-box-icon">
                            <i class="icon-user"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div><!-- Main Wrapper -->
<?php
    $this->load->view('template/footer.php');
?>
<script src="<?php echo base_url();?>public/assets/js/pages/dashboard.js"></script>