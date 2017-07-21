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
                            <p class="counter"><?php echo $states['tot_nus'];?></p>
                            <span class="info-box-title"><?php echo $this->lang->line('nurses');?></span>
                        </div>
                        <div class="info-box-icon">
                            <i class="fa fa-user"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel info-box panel-white">
                    <div class="panel-body">
                        <div class="info-box-stats">
                            <p class="counter"><?php echo $states['tot_rec'];?></p>
                            <span class="info-box-title"><?php echo $this->lang->line('receptionists');?></span>
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
                            <p><span class="counter"><?php echo $states['tot_pat'];?></span></p>
                            <span class="info-box-title"><?php echo $this->lang->line('patients');?></span>
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
            <div class="panel panel-white">      
                <div class="panel-heading clearfix">
                    <div class="">
                        <div class="custome_col8">
                            <h4 class="panel-title panel_heading_custome"><?php echo $this->lang->line('todaysappoitments');?></h4>
                        </div>
                        <div class="custome_col4">
                            <div class="panel_button_top_right">
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
                <div class="panel-body panel_body_custome">
                    <div class="table-responsive">
                        <table id="appoitments" class="display table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th style="width:10px"></th>
									<th><?php echo $this->lang->line('tableHeaders')['appoitment_no'];?></th>
                                    <th><?php echo $this->lang->line('tableHeaders')['patient'];?></th>
                                    <th><?php echo $this->lang->line('tableHeaders')['reason'];?></th>
                                    <th><?php echo $this->lang->line('tableHeaders')['appoitment_date'];?></th>
                                    <th><?php echo $this->lang->line('tableHeaders')['appoitment_sloat'];?></th>
                                    <th><?php echo $this->lang->line('tableHeaders')['status']; ?></th>
                                    <th width="20px">#</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            </tbody>
                        </table>  
                    </div>
                </div>
            </div>
            
           
        </div>
    </div><!-- Main Wrapper -->
<?php
    $this->load->view('template/footer.php');
?>
<script src="<?php echo base_url();?>public/assets/js/pages/dashboard.js"></script>
<script>
    $(document).ready(function(){
        //$("#appoitments").dataTable().fnDestroy();
        $("#appoitments").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "<?php echo site_url(); ?>/appoitments/getDTDocpappoitments?td=1"
        });
        $(".dataTables_filter").hide();
    });
</script>