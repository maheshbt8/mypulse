<script src="<?= base_url('assets/backend/')?>js/jquery-1.11.1.min.js"></script>
<script src="<?= base_url('assets/backend/')?>js/bootstrap.min.js"></script>
<script src="<?= base_url('assets/backend/')?>js/bootstrap-table.min.js"></script>
<script src="<?= base_url('assets/backend/')?>js/chart.min.js"></script>
<script src="<?= base_url('assets/backend/')?>js/jquery.validate.min.js"></script>
<script src="<?= base_url('assets/backend/')?>js/toastr.js"></script>
<script src="<?= base_url('assets/backend/')?>js/fullcalendar.min.js"></script>
<script src="<?= base_url('assets/backend/')?>js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="<?= base_url('assets/backend/')?>js/daterangepicker/daterangepicker-bs3.css">
<script src="<?= base_url('assets/backend/')?>js/daterangepicker/daterangepicker.js"></script>
<script src="<?= base_url('assets/backend/')?>js/daterangepicker/moment.min.js"></script>
<!--Select Multimple -->
<script src="<?= base_url('assets/backend/')?>js/select2.min.js"></script>
<link rel="stylesheet" href="<?= base_url('assets/backend/')?>js/select2-bootstrap.css">
<link rel="stylesheet" href="<?= base_url('assets/backend/')?>js/select2.css">
<script src="<?= base_url('assets/backend/')?>js/main-gsap.js"></script>
<script src="<?= base_url('assets/backend/')?>js/neon-custom.js"></script>
<script src="<?= base_url('assets/backend/')?>js/resizeable.js"></script>

<!--Select Multimple -->
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

<script type="text/javascript">
/*  jQuery(document).ready(function(){
  $.get("response.php", function(data) {
    $("#some_div").html(data);
    window.setTimeout(update,50000);
  });
});*/
/*function loadlink(){
    $('#refresh_data').load('index.php',function () {
         $(this).unwrap();
    });
}

loadlink(); // This will run on page load
setInterval(function(){
    loadlink() // this will run after every 5 seconds
}, 5000);*/

</script>




    <!-- <script src="<?= base_url('assets/backend/')?>js/chart.min.js"></script> -->
<!-- <script src="<?= base_url('assets/backend/')?>js/chart-data.js"></script> -->
             

  <!--  <script language="javascript">
      window.onload = function () {
        var chart1 = document.getElementById("line-chart").getContext("2d");
        window.myLine = new Chart(chart1).Line(lineChartData, {
        responsive: true,
        scaleLineColor: "rgba(0,0,0,.2)",
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleFontColor: "#c5c7cc"
        });
      };
    </script> -->
    <script language="JavaScript">
  /**
    * Disable right-click of mouse, F12 key, and save key combinations on page
    * By Arthur Gareginyan (arthurgareginyan@gmail.com)
    * For full source code, visit https://mycyberuniverse.com
    */
  window.onload = function() {
    document.addEventListener("contextmenu", function(e){
      e.preventDefault();
    }, false);
    document.addEventListener("keydown", function(e) {
    //document.onkeydown = function(e) {
      // "I" key
      if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
        disabledEvent(e);
      }
      // "J" key
      if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
        disabledEvent(e);
      }
      // "S" key + macOS
      if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
        disabledEvent(e);
      }
      // "U" key
      if (e.ctrlKey && e.keyCode == 85) {
        disabledEvent(e);
      }
      // "F12" key
      if (event.keyCode == 123) {
        disabledEvent(e);
      }
    }, false);
    function disabledEvent(e){
      if (e.stopPropagation){
        e.stopPropagation();
      } else if (window.event){
        window.event.cancelBubble = true;
      }
      e.preventDefault();
      return false;
    }

    /*Chart */
    var chart1 = document.getElementById("line-chart").getContext("2d");
        window.myLine = new Chart(chart1).Line(lineChartData, {
        responsive: true,
        scaleLineColor: "rgba(0,0,0,.2)",
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleFontColor: "#c5c7cc"
        });
        /*Chart End*/
  };
</script>

  <script src="<?= base_url('assets/backend/')?>js/fileinput.js"></script>