        <div class="page-footer">
            <div class="row">
            <span class="no-s"><?php echo date("Y");?> &copy; JagruMs Technologies Pvt Limited</span>
            <span class="pull-right" style="display: none">Developed By : <a href="http://techcrista.in">Techcrista</a></span>
            </div>
        </div>
    </div><!-- Page Inner -->
    </main><!-- Page Content -->
        
        <div class="cd-overlay"></div>

        <!-- Javascripts -->
        <script src="<?php echo base_url();?>public/assets/plugins/jquery/jquery-2.1.3.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/pace-master/pace.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/switchery/switchery.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/uniform/jquery.uniform.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/waves/waves.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/3d-bold-navigation/js/main.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/waypoints/jquery.waypoints.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/jquery-counterup/jquery.counterup.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/toastr/toastr.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/flot/jquery.flot.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/flot/jquery.flot.time.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/flot/jquery.flot.symbol.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/flot/jquery.flot.resize.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/curvedlines/curvedLines.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/metrojs/MetroJs.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/js/modern.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/datatables/js/jquery.datatables.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/selectize/js/selectize.min.js"></script>
        <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
        <script type="text/javascript">
        $(function() {

            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: false,
                    showMethod: 'fadeIn',
                    hideMethod: 'fadeOut',
                    timeOut: 5000
                };
                <?php
                    @extract($this->session->flashdata('data'));
                    if(isset($errors)){
                        foreach ($errors as $e) {
                            ?>
                                toastr.error('<?php echo $e;?>', 'Oops!');                
                            <?php
                        }
                    }

                    if(isset($infos)){
                        foreach ($infos as $e) {
                            ?>
                                toastr.info('<?php echo $e;?>', '');                
                            <?php
                        }
                    }

                    if(isset($warnings)){
                        foreach ($warnings as $e) {
                            ?>
                                toastr.warning('<?php echo $e;?>', '');                
                            <?php
                        }
                    }

                    if(isset($success)){
                        foreach ($success as $e) {
                            ?>
                                toastr.success('<?php echo $e;?>', '');                
                            <?php
                        }
                    }
                ?>
            }, 1000);

            $('.date-picker').datepicker({
                todayHighlight: true,
                format: 'dd-mm-yyyy',
                orientation: "top auto",
                autoclose: true
            });
            var pos = $("#left_active_menu").val();
            $("#li"+pos).addClass('active');
            if($("#li"+pos).find('ul').length > 0) {
                $("#li"+pos).children()[0].click();
                $("#li"+$("#left_active_sub_menu").val()).addClass("active");
            }




        });
    </script>
    </body>

</html>