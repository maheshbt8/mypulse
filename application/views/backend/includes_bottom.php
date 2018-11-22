<script src="<?= base_url('assets/backend/')?>js/jquery-1.11.1.min.js"></script>
<script src="<?= base_url('assets/backend/')?>js/bootstrap.min.js"></script>
<script src="<?= base_url('assets/backend/')?>js/bootstrap-table.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script src="<?= base_url('assets/backend/')?>js/canvasjs.min.js"></script>
<script src="<?= base_url('assets/backend/')?>js/jquery.validate.min.js"></script>
<script src="<?= base_url('assets/backend/')?>js/toastr.js"></script>
<script src="<?= base_url('assets/backend/')?>js/fullcalendar.min.js"></script>
<script src="<?= base_url('assets/backend/')?>js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="<?= base_url('assets/backend/')?>js/daterangepicker/daterangepicker-bs3.css">
<script src="<?= base_url('assets/backend/')?>js/daterangepicker/daterangepicker.js"></script>
<script src="<?= base_url('assets/backend/')?>js/daterangepicker/moment.min.js"></script>
<script src="<?= base_url('assets/backend/')?>js/select2.min.js"></script>
<link rel="stylesheet" href="<?= base_url('assets/backend/')?>js/select2-bootstrap.css">
<link rel="stylesheet" href="<?= base_url('assets/backend/')?>js/select2.css">
<script src="<?= base_url('assets/backend/')?>js/main-gsap.js"></script>
<script src="<?= base_url('assets/backend/')?>js/neon-custom.js"></script>
<script src="<?= base_url('assets/backend/')?>js/resizeable.js"></script>
<!-- <script src="<?= base_url('assets/backend/')?>js/bootstrap-datepicker.js"></script>
<script src="<?= base_url('assets/backend/')?>js/jquery-1.11.0.min.js"></script> -->	

<!-- <script src="<?php echo base_url()?>assets/js/gsap/main-gsap.js"></script> -->
<!-- <script src="http://code.jquery.com/jquery-latest.min.js"></script> -->

<!---*******************Want files***********************-->


<?php if ($this->session->flashdata('message') != ""){ ?>
    <script>
        toastr.info('<?php echo $this->session->flashdata('message');?>');
    </script>
<?php } ?> 
<script type="text/javascript">
                    $(document).ready(function(){
                    var date = new Date();
                    date.setDate(date.getDate());

                    $('#dob').datepicker({ 
                    endDate: date

                    });

                    } );                  

</script>


<!-- <div id="toast-container" class="toast-top-right"><div class="toast toast-info" style=""><div class="toast-message">Doctor Availability Info Saved Successfuly</div></div></div> -->



<!-- ************************************ -->
<!-- <link rel="stylesheet" href="<?php echo base_url()?>assets/js/daterangepicker/daterangepicker-bs3.css">

<link rel="stylesheet" href="<?php echo base_url()?>assets/js/selectboxit/jquery.selectBoxIt.css">

<link rel="stylesheet" href="<?php echo base_url()?>assets/js/wysihtml5/bootstrap-wysihtml5.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/js/selectboxit/jquery.selectBoxIt.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/js/datatables/responsive/css/datatables.responsive.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/js/select2/select2-bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/js/select2/select2.css"> -->

<!-- Bottom Scripts -->

<!-- <script src="<?php echo base_url()?>assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script> -->
<!-- <script src="<?php echo base_url()?>assets/js/bootstrap.js"></script> -->
<!-- <script src="<?php echo base_url()?>assets/js/joinable.js"></script> -->

<!-- <script src="<?php echo base_url()?>assets/js/neon-api.js"></script> -->
<!-- <script src="<?php echo base_url()?>assets/js/bootstrap-switch.min.js"></script> -->
<!-- <script src="<?php echo base_url()?>assets/js/toastr.js"></script> -->
<!-- <script src="<?php echo base_url()?>assets/js/jquery.validate.min.js"></script> -->
<!-- <script src="<?php echo base_url()?>assets/js/fullcalendar/fullcalendar.min.js"></script> -->
<!-- <script src="<?php echo base_url()?>assets/js/bootstrap-datepicker.js"></script> -->
<!-- <script src="<?php echo base_url();?>assets/js/bootstrap-timepicker.min.js"></script> -->
<!-- <script src="<?php echo base_url()?>assets/js/fileinput.js"></script> -->
<!-- <script src="<?php echo base_url()?>assets/js/wysihtml5/wysihtml5-0.4.0pre.min.js"></script> -->
<!-- <script src="<?php echo base_url()?>assets/js/wysihtml5/bootstrap-wysihtml5.js"></script> -->
<!-- <script src="<?php echo base_url()?>assets/js/jquery.multi-select.js"></script> -->
<!-- <script src="<?php echo base_url()?>assets/js/jquery.knob.js"></script> -->
<!-- <script src="<?php echo base_url()?>assets/js/selectboxit/jquery.selectBoxIt.min.js"></script> -->
<!-- <script src="<?php echo base_url()?>assets/js/jquery.inputmask.bundle.min.js"></script> -->
<!-- <script src="<?php echo base_url()?>assets/js/daterangepicker/moment.min.js"></script> -->
<!-- <script src="<?php echo base_url()?>assets/js/daterangepicker/daterangepicker.js"></script> -->

<!-- <link rel="stylesheet" href="<?php echo base_url()?>assets/js/dropzone/dropzone.css"> -->
<!-- <script src="<?php echo base_url()?>assets/js/dropzone/dropzone.js"></script> -->

<!-- <script src="<?php echo base_url()?>assets/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="<?php echo base_url()?>assets/js/datatables/TableTools.min.js"></script> -->
<!-- <script src="<?php echo base_url()?>assets/js/dataTables.bootstrap.js"></script> -->
<!-- <script src="<?php echo base_url()?>assets/js/datatables/jquery.dataTables.columnFilter.js"></script> -->
<!-- <script src="<?php echo base_url()?>assets/js/datatables/lodash.min.js"></script> -->
<!-- <script src="<?php echo base_url()?>assets/js/datatables/responsive/js/datatables.responsive.js"></script> -->
<!--<script src="<?php echo base_url()?>assets/js/select2/select2.min.js"></script>

<script src="<?php echo base_url()?>assets/js/neon-calendar.js"></script>
 <script src="<?php echo base_url()?>assets/js/neon-chat.js"></script> -->

<!--<script src="<?php echo base_url()?>assets/js/neon-demo.js"></script>
<script src="<?php echo base_url()?>assets/js/neon-notes.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery.form.js"></script>
 
<script src="<?php echo base_url()?>assets/js/ajax-form-submission.js"></script>
 -->