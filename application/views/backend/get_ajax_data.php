<script type="text/javascript">
$(document).ready(function(){
    $.ajax({
            url: '<?php echo base_url();?>ajax/get_country/',
            success: function(response)
            {
                jQuery('#country').html(response);
            } 
        });});
function get_state(country_id) {
        $.ajax({
            url: '<?php echo base_url();?>ajax/get_state/' + country_id ,
            success: function(response)
            {
                jQuery('#state').html(response);
            } 
        });
    }
function get_district(state_id) {
        $.ajax({
            url: '<?php echo base_url();?>ajax/get_district/' + state_id ,
            success: function(response)
            {
                jQuery('#district').html(response);
            }
        });
    }
function get_city(district_id) {
        $.ajax({
            url: '<?php echo base_url();?>ajax/get_city/' + district_id ,
            success: function(response)
            {
                jQuery('#city').html(response);
            }
        });   
    }
</script>
<script type="text/javascript">
$(document).ready(function(){
    $.ajax({
            url: '<?php echo base_url();?>ajax/get_hospital/',
            success: function(response)
            {
                jQuery('#hospital').html(response);
            } 
        });
});
function get_branch(hospital_id) {
        $.ajax({
            url: '<?php echo base_url();?>ajax/get_branch/' + hospital_id ,
            success: function(response)
            {
                jQuery('#branch').html(response);
            }
        });
    }
     function get_department(branch_id) {
        $.ajax({
            url: '<?php echo base_url();?>ajax/get_department/' + branch_id ,
            success: function(response)
            {
                jQuery('#department').html(response);
            }
        });

    }
    function get_department_all(branch_id) {
        $.ajax({
            url: '<?php echo base_url();?>ajax/get_department_all/' + branch_id ,
            success: function(response)
            {
                jQuery('#department').html(response);
            }
        });

    }
    function get_ward(ward_id) {
        $.ajax({
            url: '<?php echo base_url();?>ajax/get_ward/' + ward_id ,
            success: function(response)
            {
                jQuery('#ward').html(response);
            }
        });
    }
    function get_bed(ward_id) {
        $.ajax({
            url: '<?php echo base_url();?>ajax/get_bed/' + ward_id ,
            success: function(response)
            {
               
                jQuery('#bed').html(response);
            }
        });
    }
</script>
<script type="text/javascript">
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(getAddress);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}
  function getAddress(position){
    var lat=position.coords.latitude;
    var lng=position.coords.longitude;
        $.ajax({
            type: 'get',
            url: '<?php echo base_url();?>main/getAddress/'+lat+'/'+lng,
            success: function (response) {
                $("#address").val(response);
                $("#location-get-latlng").html('<input type="hidden" name="latitude" id="lat" value="'+lat+'"><input type="hidden" name="longitude" id="lng" value="'+lng+'">');
            }
          }); 
    }
</script>
<script type="text/javascript">
    $(document).ready(function(){
    var date = new Date();
    date.setDate(date.getDate());
    $('.feature_date').datepicker({ 
    startDate: date
    });
    } );                  
</script>