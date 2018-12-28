<script src="<?= base_url('assets/backend/')?>js/jquery-1.11.1.min.js"></script>
<script src="<?= base_url('assets/backend/')?>js/bootstrap.min.js"></script>
<script src="<?= base_url('assets/backend/')?>js/bootstrap-table.min.js"></script>
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

    function calculate_age(dob){
dob = new Date(dob);
var today = new Date();
var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
jQuery('#age').attr('value',age);
}                 

</script>

