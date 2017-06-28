<?php
    $this->load->view('template/header.php');
    $this->load->view('template/left.php');
?>    
    <input type="hidden" id="left_active_menu" value="1" />
    <div id="main-wrapper">
        <div class="row">
            <div class="col-lg-3 col-md-6">
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
            </div>
            <div class="col-lg-3 col-md-6">
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
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel info-box panel-white">
                    <div class="panel-body">
                        <div class="info-box-stats">
                            <p><span class="counter"><?php echo $states['tot_medStoreLab'];?></span></p>
                            <span class="info-box-title"><?php echo $this->lang->line('medStoreLabs');?></span>
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
                            <p class="counter"><?php echo $states['tot_app'];?></p>
                            <span class="info-box-title"><?php echo $this->lang->line('appointments');?></span>
                        </div>
                        <div class="info-box-icon">
                            <i class="icon-envelope"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Row -->
        <div class="row">
           
            
            <!-- <div class="col-lg-12 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <h4 class="panel-title">Project Stats</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive project-stats">  
                           <table class="table">
                               <thead>
                                   <tr>
                                       <th>#</th>
                                       <th>Project</th>
                                       <th>Status</th>
                                       <th>Manager</th>
                                       <th>Progress</th>
                                   </tr>
                               </thead>
                               <tbody>
                                   <tr>
                                       <th scope="row">452</th>
                                       <td>Mailbox Template</td>
                                       <td><span class="label label-info">Pending</span></td>
                                       <td>David Green</td>
                                       <td>
                                           <div class="progress progress-sm">
                                               <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                               </div>
                                           </div>
                                       </td>
                                   </tr>
                                   <tr>
                                       <th scope="row">327</th>
                                       <td>Wordpress Theme</td>
                                       <td><span class="label label-primary">In Progress</span></td>
                                       <td>Sandra Smith</td>
                                       <td>
                                           <div class="progress progress-sm">
                                               <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                               </div>
                                           </div>
                                       </td>
                                   </tr>
                                   <tr>
                                       <th scope="row">226</th>
                                       <td>Modern Admin Template</td>
                                       <td><span class="label label-success">Finished</span></td>
                                       <td>Chritopher Palmer</td>
                                       <td>
                                           <div class="progress progress-sm">
                                               <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                               </div>
                                           </div>
                                       </td>
                                   </tr>
                                   <tr>
                                       <th scope="row">178</th>
                                       <td>eCommerce template</td>
                                       <td><span class="label label-danger">Canceled</span></td>
                                       <td>Amily Lee</td>
                                       <td>
                                           <div class="progress progress-sm">
                                               <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                               </div>
                                           </div>
                                       </td>
                                   </tr>
                                   <tr>
                                       <th scope="row">157</th>
                                       <td>Website PSD</td>
                                       <td><span class="label label-info">Testing</span></td>
                                       <td>Nick Doe</td>
                                       <td>
                                           <div class="progress progress-sm">
                                               <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                                               </div>
                                           </div>
                                       </td>
                                   </tr>
                                   <tr>
                                       <th scope="row">157</th>
                                       <td>Fronted Theme</td>
                                       <td><span class="label label-warning">Waiting</span></td>
                                       <td>David Green</td>
                                       <td>
                                           <div class="progress progress-sm">
                                               <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                                               </div>
                                           </div>
                                       </td>
                                   </tr>
                               </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div><!-- Main Wrapper -->
<?php
    $this->load->view('template/footer.php');
?>
<script src="<?php echo base_url();?>public/assets/js/pages/dashboard.js"></script>