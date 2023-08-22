<?php
$s_lat=$_GET['start_lat'];
$s_lng=$_GET['start_lng'];
$e_lat=$_GET['end_lat'];
$e_lng=$_GET['end_lng'];
?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">   
            <div class="panel-heading">
            </div>
            <div class="panel-body">
                <div id="googleMap" style="width:100%;height:400px;"></div>
    <script>
      function initMap() {
/*        var s_lat='<?=$s_lat;?>';
        var s_lng='<?=$s_lng;?>';
        var e_lat='<?=$e_lat;?>';
        var e_lng='<?=$e_lng;?>';*/
        var s_lat=17.4381005;
        var s_lng=78.4416118;
        var e_lat=17.4504102;
        var e_lng=78.3788495;
        var map = new google.maps.Map(document.getElementById('googleMap'), {
          zoom: 11,
          center: {lat: 17.3850, lng: 78.4867},
          mapTypeId: 'terrain'
        });

        var flightPlanCoordinates = [
          {lat: s_lat, lng: s_lng},
          {lat: e_lat, lng: e_lng}
          /*{lat: 17.4381005, lng: 78.4416118},
          {lat: 17.4504102, lng: 78.3788495}*/
        ];
        var flightPath = new google.maps.Polyline({
          path: flightPlanCoordinates,
          geodesic: true,
          strokeColor: '#FF0000',
          strokeOpacity: 1.0,
          strokeWeight: 2
        });

        flightPath.setMap(map);
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZ-5bkYW9Wb5k2JLBoaas0HSx7ZBkMwAM&callback=initMap">
    </script>
                </div>
            </div>
        </div>
    </div>