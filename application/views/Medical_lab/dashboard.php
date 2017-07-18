<?php
    $this->load->view('template/header.php');
    $this->load->view('template/left.php');
?>    
    <input type="hidden" id="left_active_menu" value="1" />
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-6">
                <div class="panel info-box panel-white">
                    <div class="panel-body">
                        <div class="info-box-stats">
                            <p class="counter"><?php echo $states['tot_rep'];?></p>
                            <span class="info-box-title"><?php echo $this->lang->line('reports');?></span>
                        </div>
                        <div class="info-box-icon">
                            <i class="fa fa-hospital-o"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel info-box panel-white">
                    <div class="panel-body">
                        <div class="info-box-stats">
                            <p><span class="counter"><?php echo $states['tot_users'];?></span></p>
                            <span class="info-box-title"><?php echo $this->lang->line('customers');?></span>
                        </div>
                        <div class="info-box-icon">
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!--<div class="col-lg-3 col-md-6">
                <div class="panel info-box panel-white">
                    <div class="panel-body">
                        <div class="info-box-stats">
                            <p><span class="counter"><?php //echo $states['tot_medLab'];?></span></p>
                            <span class="info-box-title"><?php //echo $this->lang->line('medicalLabFull');?></span>
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
                            <p class="counter"><?php //echo $states['tot_app'];?></p>
                            <span class="info-box-title"><?php //echo $this->lang->line('appointments');?></span>
                        </div>
                        <div class="info-box-icon">
                            <i class="icon-envelope"></i>
                        </div>
                    </div>
                </div>
            </div>-->
        </div><!-- Row -->
        <!--OutStanding Med Reports -->
        <?php if(count($states['medical_reports']) > 0) { ?>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <h4 class="panel-title">Medical Reports Requests</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive project-stats">  
                           <table class="table">
                               <thead>
                                   <tr>
                                       <th>#</th>
                                       <th>Title</th>
                                       <th>Description</th>
                                       <th>Doctor</th>
                                       <th>Patient</th>
                                       <th>Status</th>
                                       <th>Action</th>
                                   </tr>
                               </thead>
                               <tbody>
                                    <?php
                                        $cnt = 1;
                                        foreach($states['medical_reports'] as $mr){
                                            ?>
                                            <tr>
                                                <th scope="row"><?=$cnt;?></th>
                                                <td><?=$mr['title'];?></td>
                                                <td><?=$mr['description'];?></td>
                                                <td><?=$mr['doctor_name'];?></td>
                                                <td><?=$mr['patient_name'];?></td>
                                                <td><span class="label label-info">Pending</span></td>
                                                <td><button class="btn btn-primary">Upload Report</button></td>
                                            </tr>
                                            <?php
                                            $cnt++;
                                        }
                                    ?>
                                   
                                   
                               </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div><!-- Main Wrapper -->
<?php
    $this->load->view('template/footer.php');
?>
<script src="<?php echo base_url();?>public/assets/js/pages/dashboard.js"></script>

<script type="text/javascript">
    $( document ).ready(function() {
    
    });
</script>