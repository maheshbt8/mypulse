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
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/js/pages/previewimage.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.js"></script>
        <script type="text/javascript">
        $(function() {
                //phone_number.match(/^(1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
            jQuery.validator.addMethod("phoneUS", function(phone_number, element) {
                phone_number = phone_number.replace(/\s+/g, ""); 
                return this.optional(element) || phone_number.length > 9 &&
                    phone_number.match(/^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/);
            }, "Please specify a valid phone number");


            setTimeout(function() {
                toastr.options = {
                    closeButton: false,
                    progressBar: false,
                    showMethod: 'fadeIn',
                    positionClass : "toast-top-center",
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

            $(".date-time-picker").datetimepicker({
                format: 'D-M-Y hh:mm A'
            });

            var pos = $("#left_active_menu").val();
            $("#li"+pos).addClass('active');
            if($("#li"+pos).find('ul').length > 0) {
                $("#li"+pos).children()[0].click();
                $("#li"+$("#left_active_sub_menu").val()).addClass("active");
            }

            

            $(document).on('click','.multiDeleteBtn',function(){
                var at = $(this).data('at');
                var selected = [];
                $('.multiselect').each(function() {
                    if ($(this).is(":checked")) {
                        selected.push($(this).data('id'));
                    }
                });
                if(selected.length == 0){
                    swal({
                        animation: "slide-from-top",
                        text: 'Please select checkbox.'
                        });
                }else{
                    swal({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then(function () {
                        $.post(BASEURL+"/"+at+"/delete",{ id : selected },function(data){
                            if(data==1){
                                for(var i=0; i<selected.length; i++){
                                    var temp = selected[i];
                                    $("#dellink_"+temp).parents('tr').remove();	
                                }
                                toastr.success('selected item(s) deleted.');
                            }else{
                                toastr.error('Please try again.');
                            }
                        });
                    });
                    
                }
            });


        });
    </script>
    </body>

</html>