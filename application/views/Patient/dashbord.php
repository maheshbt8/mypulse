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
                            <p><span class="counter"><?php echo $states['tot_medStore'];?></span></p>
                            <span class="info-box-title"><?php echo $this->lang->line('medicalStoreFull');?></span>
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
                            <p><span class="counter"><?php echo $states['tot_medLab'];?></span></p>
                            <span class="info-box-title"><?php echo $this->lang->line('medicalLabFull');?></span>
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
        <!--OutStanding Med Reports -->
        <?php if(count($states['medical_reports']) > 0) { ?>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <h4 class="panel-title"><?=$this->lang->line('labels')['patientOutstendingPLT'];?></h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive project-stats">  
                           <table class="table">
                               <thead>
                                   <tr>
                                       <th>#</th>
                                       <th>Title</th>
                                       <th>Description</th>
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
                                                <td><button data-toggle="modal" data-target="#selectML" class="btn btn-primary sml" data-id="<?=$mr['id'];?>">Select Medical Lab</button></td>
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

    <div class="modal fade" id="selectML" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
		<div class="modal-dialog modal-sm">
		    <form action="<?php echo site_url(); ?>/patients/selectml" method="post" id="form" enctype="multipart/form-data">
			    <input type="hidden" name="mrid" id="mrid">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="modal-title custom_align" id="Edit-Heading">Select Medical Lab</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group ">
                            <label><?php echo $this->lang->line('labels')['medicalLab'];?></label>
                            <select class="form-control " name="medicalLab" id="medicalLab" />
                                <?php
                                    foreach($medicalLab as $m){
                                        echo "<option value='$m[id]'>$m[name]</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-defualt" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-success"  style="margin-left:10px" type="submit">Select</button>
                        
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php
    $this->load->view('template/footer.php');
?>
<script src="<?php echo base_url();?>public/assets/js/pages/dashboard.js"></script>

<script type="text/javascript">
    $( document ).ready(function() {
        $(document).on('click','.sml',function(){
            var id = $(this).data('id');
            $("#mrid").val(id);
        });
    });
</script>