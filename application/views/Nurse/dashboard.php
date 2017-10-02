<?php
    $this->load->view('template/header.php');
    $this->load->view('template/left.php');
?>    
    <input type="hidden" id="left_active_menu" value="1" />
    <div class="row">
        <div class="state-overview">

            <div class="col-lg-3 col-sm-6">
                <a href="<?php echo site_url();?>/doctors">
                    <div class="overview-panel green-bgcolor">
                        <div class="symbol">
                            <i class="fa fa-user-md"></i>
                        </div>
                        <div class="value white">
                            <p class="sbold addr-font-h1" data-counter="counterup" data-value="<?php echo $states['doc_count'];?>"><?php echo $states['doc_count'];?></p>
                            <p><?php echo $this->lang->line('doctors');?></p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-sm-6">
                <a href="<?php echo site_url();?>/nurse/department">
                    <div class="overview-panel orange">
                        <div class="symbol">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="value white">
                            <p class="sbold addr-font-h1" data-counter="counterup" data-value="<?php echo $states['dep_count'];?>"><?php echo $states['dep_count'];?></p>
                            <p><?php echo $this->lang->line('departments');?></p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-sm-6">
                <a href="<?php echo site_url();?>/nurse/inpatient">
                    <div class="overview-panel blue-bgcolor">
                        <div class="symbol">
                            <i class="icon-user"></i>
                        </div>
                        <div class="value white">
                            <p class="sbold addr-font-h1" data-counter="counterup" data-value="<?php echo $states['patient_count'];?>"><?php echo $states['patient_count'];?></p>
                            <p><?php echo $this->lang->line('patients');?></p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
<?php
    $this->load->view('template/footer.php');
?>
<script src="<?php echo base_url();?>public/assets/js/pages/dashboard.js"></script>