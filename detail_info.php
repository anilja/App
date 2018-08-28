<?php  
mysql_connect("localhost","instowfv_user1","Uma_35128");
mysql_select_db("instowfv_instops"); 
extract($_REQUEST);
$res1=mysql_fetch_assoc(mysql_query("SELECT * from routs_info where rid='$rid'"));
$nameQry=mysql_query("SELECT * FROM `routs_info` RIGHT JOIN stages_info ON routs_info.rid=stages_info.rid where routs_info.rid='$rid' AND routs_info.route_no='$bno' AND routs_info.rid!=''");
?>
 <?php require_once('header.php'); ?>
 
  <style> 
 .bar {
  list-style: none;

}
.bar >li {
  position: relative;
    overflow:hidden;

    }
.bar>li:before {
  content: '\25CF';
  margin-right: 10px;
  font-size: 30px;
}
.bar>li:after {
  position: absolute;
  left: 0;
  top: 0;
  content: '';
  border-left: 2px solid white;
  margin-left: 7.5px;
  height: 100%;
}
.bar >li:first-of-type:after {
  display: inline-block;
  top: 50%;
}
.bar >li:last-of-type:after {
  top: -50%;
}
   

 </style>   

    <div class="container">
      <div class="row-eq-height">
        <div id="mySidenav" class="sidenav">
          <a href="index.php">Home
          </a>
          <a href="about-us.php">Company
          </a>
          <a href="bus/">Bus Tickets
          </a>
          <a href="train-tickets.php">Trains
          </a>
          <a href="flights.php">Flights
          </a>
          <a href="#"><img src="images/android1.png">&nbsp;&nbsp;Android App
          </a>
          <a href="#"><img src="images/apple.png">&nbsp;&nbsp;IoS App
          </a>
        </div>
         <div class="col-sm-6 col-md-6 main">
              <div class="panel panel-primary">
              <div class="panel-heading">
                <form action="" method="POST" id="frmBusSearch" name="frmBusSearch">
                <input type="hidden" name="from_buses11" id="from_buses11" value="<?php echo $res1['source_search'];?>">
                <input type="hidden" name="to_buses11" id="to_buses11" value="<?php echo $res1['destination_search'];?>">
                </form>
			 <table id="table" data-toggle="table" data-toolbar="#toolbar" width="100%">
                                    <thead>
                                        <tr>
						<!--<th>S.No</th>-->
						<th><i class="fa fa-bus"></i>&nbsp;&nbsp;<?php echo $res1['route_no'];?> - Route Information</th>
                                        </tr>
                                    </thead>
                                    </table>
                                    
                                        <ul class ="bar">

                                    <?php
					$i=1;
					$gpsTrack='';
				 	while($getTo=mysql_fetch_assoc($nameQry)){
				 		//$gpsTrack.="{name:'".$getTo['stage_name']."',lat:".$getTo['stage_lat'].",lng:".$getTo['stage_lang']."},";
				 		$gpsTrack.="['".$getTo['stage_name']."',".$getTo['stage_lat'].",".$getTo['stage_lang']."],";
				 		$ext='';
				 		if($getTo['stage_time']!=''){ $ext=" ( Departure Time : ".$getTo['stage_time']." )";}
					 ?>
							<!--<td><?php echo $i;?></td>-->
							<li><?php echo $getTo['stage_search'].$ext;?></li> 
				  <?php 
				  	$i=$i+1;
				  	}
				  ?>
                                    </ul>
		</div>
		</div>
	</div>	
	
	        <div class="col-sm-6 col-md-6 main">
			<div class="col-sm-12 col-md-12 col-sm-12 ">
				<div class="panel panel-primary" id="map" style="width:100%;height:290;min-height: 290px;position: relative;overflow: hidden;">
				</div>
				<button type ="button" class="btn btn-primary btn-lg" onclick="history.go(-1);"><<<--- Back</button>
			</div>
		</div>
   
        </div>
      </div>
    </div>
     <?php require_once('footer.php'); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/ie10-viewport-bug-workaround.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyGcD5Ra8qIeE82FqrrkW3WfMrXiji2uQ&library=places&callback=initMap" async defer></script>    
   <script type="text/javascript">
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), 
        {
          zoom: 12,
          center: {lat: 17.398729, lng: 78.477011}  // Australia.
        });


 	
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer({
          draggable: false,
          map: map,
          panel: document.getElementById('directionsPanel')
        });
        


        directionsDisplay.addListener('directions_changed', function() {
          computeTotalDistance(directionsDisplay.getDirections());
        });
        
		//var s2='16.732975,82.2115587';
		//var d2='16.7371561,82.2150916';
		
		var s2=document.getElementById('from_buses11').value;
		var d2=document.getElementById('to_buses11').value;

		
        displayRoute(s2, d2, directionsService,
            directionsDisplay);
      }

 
      
 
      function displayRoute(origin, destination, service, display) {
        service.route({
          origin: origin,
          destination: destination,
          travelMode: 'TRANSIT',
          provideRouteAlternatives: true,
          avoidTolls: true
        }, function(response, status) {
          if (status === 'OK') {
	    display.setDirections(response);
          } 
          else {
            alert('Could not display directions due to: ' + status);
          }
        });
      }

      function computeTotalDistance(result) {
        var total = 0;
        var myroute = result.routes[0];
        for (var i = 0; i < myroute.legs.length; i++) {
          total += myroute.legs[i].distance.value;
        }
        total = total / 1000;
        document.getElementById('total').innerHTML = total + ' km';
      }
    </script>
<!--    <script>
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          center: {lat: 17.398729, lng: 78.477011}  // Australia.
        }); 
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer({
          draggable: false,
          suppressMarkers: true,
          map: map,
          panel: document.getElementById('right-panel')
        }); 
        directionsDisplay.addListener('directions_changed', function() {
          computeTotalDistance(directionsDisplay.getDirections());
        });
		
		//var s2='16.732975,82.2115587';
		//var d2='16.7371561,82.2150916';
		
		var s2=document.getElementById('from_buses11').value;
		var d2=document.getElementById('to_buses11').value;
		
        displayRoute(s2, d2, directionsService,
            directionsDisplay);
      }

      function displayRoute(origin, destination, service, display) {
        service.route({
          origin: origin,
          destination: destination,
          // waypoints: [{location: 'Adelaide, SA'}, {location: 'Broken Hill, NSW'}],
          //waypoints: [{location:new google.maps.LatLng(16.732141,82.2148758),stopover:false},{location:new google.maps.LatLng(16.7331335,82.211544),stopover:false}], DRIVING
          travelMode: 'TRANSIT',
          avoidTolls: true
        }, function(response, status) {
          if (status === 'OK') {
            display.setDirections(response);
          } else {
            alert('Could not display directions due to: ' + status);
          }
        });
      }

      function computeTotalDistance(result) {
        var total = 0;
        var myroute = result.routes[0];
        for (var i = 0; i < myroute.legs.length; i++) {
          total += myroute.legs[i].distance.value;
        }
        total = total / 1000;
        document.getElementById('total').innerHTML = total + ' km';
      }
    </script>-->
<!--
<script>
var map;
var infoWindow;

// markersData variable stores the information necessary to each marker
var markersData = [
   /*{
      lat: 17.368824865313737,
      lng: 78.42925071716309,
      name: "Camping Praia da Barra"
      // address1:"Rua Diogo Cão, 125",
      // address2: "Praia da Barra",
      // postalCode: "3830-772 Gafanha da Nazaré" // don't insert comma in the last item of each marker
   },
   {
      lat: 17.380948188586636,
      lng: 78.42916488647461,
      name: "Camping Costa Nova"
      // address1:"Quinta dos Patos, n.º 2",
      // address2: "Praia da Costa Nova",
      // postalCode: "3830-453 Gafanha da Encarnação" // don't insert comma in the last item of each marker
   },
   {
      lat: 17.395568831245786,
      lng: 78.4317398071289,
      name: "Camping Gafanha da Nazaré"
      // address1:"Rua dos Balneários do Complexo Desportivo",
      // address2: "Gafanha da Nazaré",
      // postalCode: "3830-225 Gafanha da Nazaré" // don't insert comma in the last item of each marker
   } // don't insert comma in the last item*/
  
];


function initialize() {
   var mapOptions = {
      center: new google.maps.LatLng(17.432571, 78.427097),
      zoom: 9,
      mapTypeId: 'roadmap',
   };

   map = new google.maps.Map(document.getElementById('map'), mapOptions);

   // a new Info Window is created
   infoWindow = new google.maps.InfoWindow();

   // Event that closes the Info Window with a click on the map
   google.maps.event.addListener(map, 'click', function() {
      infoWindow.close();
   });

   // Finally displayMarkers() function is called to begin the markers creation
   displayMarkers();
}
google.maps.event.addDomListener(window, 'load', initialize);


// This function will iterate over markersData array
// creating markers with createMarker function
function displayMarkers(){

   // this variable sets the map bounds according to markers position
   var bounds = new google.maps.LatLngBounds();
   
   // for loop traverses markersData array calling createMarker function for each marker 
   for (var i = 0; i < markersData.length; i++){

      var latlng = new google.maps.LatLng(markersData[i].lat, markersData[i].lng);
      var name = markersData[i].name;
      var address1 = markersData[i].address1;
      var address2 = markersData[i].address2;
      var postalCode = markersData[i].postalCode;

      createMarker(latlng, name, address1, address2, postalCode);

      // marker position is added to bounds variable
      bounds.extend(latlng);  
   }

   // Finally the bounds variable is used to set the map bounds
   // with fitBounds() function
   map.fitBounds(bounds);
}

// This function creates each marker and it sets their Info Window content
function createMarker(latlng, name){
   var marker = new google.maps.Marker({
      map: map,
      position: latlng,
      title: name
   });

   // This event expects a click on a marker
   // When this event is fired the Info Window content is created
   // and the Info Window is opened.
   google.maps.event.addListener(marker, 'click', function() {
      
      // Creating the content to be inserted in the infowindow
      var iwContent = '<div id="iw_container"><div class="iw_title" style="color:black;">' + name + '</div></div>';
      
      // including content to the Info Window.
      infoWindow.setContent(iwContent);

      // opening the Info Window in the current map and at the current marker location.
      infoWindow.open(map, marker);
   });
}
</script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyGcD5Ra8qIeE82FqrrkW3WfMrXiji2uQ&callback=initialize">
    </script>
-->
  </body>
</html>
