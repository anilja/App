<?php  
mysql_connect("localhost","instowfv_user1","Uma_35128");
mysql_select_db("instowfv_instops"); 

/*$cityName='';
//$nameQry=mysql_query("SELECT DISTINCT(stage_search) FROM `stages_info`");
while($getRouteinfo=mysql_fetch_assoc($nameQry))
{
	$cityName.='"'.ucwords($getRouteinfo['stage_search']).'",';
}
$newCityNameStr=substr($cityName,0,-1);*/
?>
<style>
#list-from{float:left;list-style:none;margin-top:-10px;padding:0;width:94%;position: absolute;z-index:1000;}
/*#list-from li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;width:100%;color:black;}*/
#list-from li { padding: 5px; background: #FFF;border-bottom: #bbb9b9 1px solid;width: 96%; color: black; border-right: #bbb9b9 1px solid; border-left: #bbb9b9 1px solid;}
#list-from li:hover{background:#ece3d2;cursor: pointer;}
#from_buses11{padding: 10px;border: #a8d4b1 1px solid;border-radius:4px;}
#list-to{float:left;list-style:none;margin-top:-10px;padding:0;width:94%;position: absolute;z-index:1000;}
#list-to li{ padding: 5px; background: #FFF;border-bottom: #bbb9b9 1px solid;width: 96%; color: black; border-right: #bbb9b9 1px solid; border-left: #bbb9b9 1px solid;}
/*{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;width:100%;color:black;}*/
#list-to li:hover{background:#ece3d2;cursor: pointer;}
#to_buses11{padding: 10px;border: #a8d4b1 1px solid;border-radius:4px;}
</style>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <?php require_once('header.php'); ?>
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
        &nbsp;&nbsp;
        <br>

        <div class="col-sm-12 col-md-12 main" "w-75 p-3">
          
          <div class="col-sm-12 col-md-4 col-sm-6 ">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <span id="fontawe">
                  <i class="fa fa-bus" aria-hidden="true">
                  </i>
                  &nbsp;&nbsp;
                </span>
                <span id="tabfon">Local City Transit
                </span>
              </div>
              <div class="panel-body">
                <form action="search.php" method="POST" id="frmBusSearch" name="frmBusSearch">
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control" required id="from_buses11" name="from_buses11" autocomplete="off" placeholder="Enter an origin location">
                        <div id="suggesstion-box-from"></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12"> 
                      <input type="text" class="form-control" required id="to_buses11" name="to_buses11"  autocomplete="off"  placeholder="Enter a destination location">
                        <div id="suggesstion-box-to"></div>
                    </div>
                  </div>
				  <div class="form-group">
                    <div class="cc-selector" style="color:#000"> 
                     <div class="col-xs-3 col-md-3 col-sm-3 "> <input type="radio"  id="bus" name="transType" onclick="changeSearch()" value="1" checked /><label class="drinkcard-cc bus" for="bus"></label></div>
					   <div class="col-xs-3 col-md-3 col-sm-3 "> <input type="radio"  id="metro" name="transType" onclick="changeSearch()" value="2"/><label class="drinkcard-cc metro"for="metro"></label></div>
					  <div class="col-xs-3 col-md-3 col-sm-3 ">  <input type="radio"  id="mmts" name="transType" onclick="changeSearch()" value="3"/><label class="drinkcard-cc train" for="mmts"></label></div>
					   <div class="col-xs-3 col-md-3 col-sm-3 ">  <input type="radio"  id="cabs" name="transType" onclick="changeSearch()" value="4"/><label class="drinkcard-cc cab" for="cabs"></label></div>
                    </div>
                  </div> 
				  <input type="submit" id="busSearch" name="busSearch" class="btn btn-success pull-right" value="Go">
                </form> 
              </div>
            </div>
          </div>
          
          
          <div class="col-md-4 col-sm-6 panel panel-primary" id="map" style="min-height:300px"></div>
          
          
         <div class="col-sm-12 col-md-4 col-sm-6 ">
               <div class="panel panel-primary">
                  <div class="panel-heading">
                    <a href="http://www.instops.com/bus"> <span id="fontawe">
                      <i class="fa fa-bus" aria-hidden="true">
                      </i>
                      &nbsp;&nbsp;
                    </span>
                    <span id="tabfon">Book Bus Tickets
                    </span></a>
                  </div> 
               </div>
				&nbsp;&nbsp;
			   <div class="panel panel-primary">
                  <div class="panel-heading">
                     <a href="train-tickets.php"><span id="fontawe">
                      <i class="fa fa-train" aria-hidden="true">
                      </i>
                      &nbsp;&nbsp;
                    </span>
                    <span id="tabfon">Train Search
                    </span></a>
                  </div> 
                </div>
                &nbsp;&nbsp;
				<div class="panel panel-primary">
                  <div class="panel-heading">
                    <a href="flights.php"><span id="fontawe">
                      <i class="fa fa-plane" aria-hidden="true">
                      </i>
                      &nbsp;&nbsp;
                    </span>
                    <span id="tabfon">Book Flight Tickets</span>
					</a>
                  </div> 
                </div>
          </div>
          &nbsp;&nbsp;

<div class="col-sm-12 col-md-4 col-sm-6 "> 
				<div class="panel panel-primary">
                  <div class="panel-heading">
                    <a href="directions.php"> <span id="fontawe">
                      <i class="fa fa-street-view" style="font-size:24px" aria-hidden="true">
                      </i>
                      &nbsp;&nbsp;
                    </span>
                    <span id="tabfon">Let's Drive
                    </span>
                  </div> 
                </div>
				 <div class="panel panel-primary">           
					 <div class="panel-heading"> 
					  
						<span id="fontawe">Connect
						&nbsp;&nbsp;
						   <a href="https://www.facebook.com/instops.india/?view_public_for=286372758575494">
						       <i class="fa fa-facebook-square" style="font-size:24px"></i></a>&nbsp;&nbsp;
						   <a href="https://twitter.com/instops_india"><i class="fa fa-twitter-square" style="font-size:24px"></i></a> &nbsp;&nbsp;
						   <a href="#"><i class="fa fa-google" style="font-size:24px"></i></a> &nbsp;&nbsp;
						</span>
						<span id="tabfon">
						</span>
						 
					  </div>  
			   </div>
			   <div class="panel panel-primary">           
					<div class="panel-heading"> 
					  
						<span id="fontawe">Download
						&nbsp;&nbsp;
						  <a href="https://play.google.com/store/apps/details?id=com.anil"><img src="images/android1.png"  aria-hidden="true"></i>&nbsp;&nbsp;</a> 
						  <a href="#"><img src="images/apple.png"></i>&nbsp;&nbsp;</a>
						  </span>
						<span id="tabfon"> </span>
						 
					</div>  
			   </div> 
		    </div> 
	   <div class="col-sm-12 col-md-4 col-sm-6 ">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <span id="fontawe">
                  <i class="fa fa-cab" aria-hidden="true">
                  </i>
                  &nbsp;&nbsp;
                </span>
                <span id="tabfon"> City Cabs
                </span>
              </div>
              <div class="panel-body">
                <form class="form-horizontal" action="cab_search.php" method="POST" id="cabSrch" name="cabSrch">
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control" id="from_cab" name="from_cab" placeholder="Enter an origin location" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12"> 
                      <input type="text" class="form-control" id="to_cab" name="to_cab" placeholder="Enter a destination location" required>
                    </div>
                  </div> 
                <input type="submit" class="btn btn-success pull-right" value="Go" id="go" name="go" />
				  </form>
            </div>
          </div>   
           </div>

       &nbsp &nbsp 
<body>       
	   <div class="col-sm-12 col-md-4 col-sm-6 ">
            <div class="panel panel-primary"data-toggle="collapse" data-target="#collapseExample" aria-expanded="true" aria-controls="collapseExample">
              <div class="panel-heading">
                <span id="fontawe">
                  <i class="fa fa-map" aria-hidden="true">
                  </i>&nbsp &nbsp
                </span>
                <span id="tabfon">City Transit Available In
                </span>
              </div>
            <div class="collapse" id="collapseExample">
              <div class="panel-body">
                <div class="col-sm-12 col-md-4 col-sm-4 "><i><img src="images/hyd.png"></i></div>
                <div class="col-sm-12 col-md-4 col-sm-4 "><i><img src="images/del.png"></i></div>
                <div class="col-sm-12 col-md-4 col-sm-4 "><i><img src="images/mum.png"></i></div>
                <div class="col-sm-12 col-md-4 col-sm-4 "><i><img src="images/blr.png"></i></div>
                <div class="col-sm-12 col-md-4 col-sm-4 "><i><img src="images/chn.png"></i></div>
                <div class="col-sm-12 col-md-4 col-sm-4 "><i><img src="images/kol.png"></i></div>
                <div class="col-sm-12 col-md-4 col-sm-4 ">  <i><img src="images/pune.png"></i></div>
                <div class="col-sm-12 col-md-4 col-sm-4 "><i><img src="images/jaipur.png"></i></div>
                <div class="col-sm-12 col-md-4 col-sm-4 "><i><img src="images/ahm.png"></i></div>
                <div class="col-sm-12 col-md-4 col-sm-4 "><i><img src="images/kochi.PNG"></i></div>
                <div class="col-sm-12 col-md-4 col-sm-4 "><i><img src="images/bellary.png"></i></div>
                <div class="col-sm-12 col-md-4 col-sm-4 "><i><img src="images/bhopal.png"></i></div>
                <div class="col-sm-12 col-md-4 col-sm-4 "><i><img src="images/bhubaneshwar.png"></i></div>
                <div class="col-sm-12 col-md-4 col-sm-4 "><i><img src="images/chandigarh.png"></i></div>
                <div class="col-sm-12 col-md-4 col-sm-4 "><i><img src="images/coimbatore.png"></i></div>
                <div class="col-sm-12 col-md-4 col-sm-4 "><i><img src="images/faridabad.png"></i></div>
                <div class="col-sm-12 col-md-4 col-sm-4 "><i><img src="images/indore.png"></i></div>
                <div class="col-sm-12 col-md-4 col-sm-4 "><i><img src="images/lucknow.png"></i></div>
                <div class="col-sm-12 col-md-4 col-sm-4 "><i><img src="images/madurai.png"></i></div>
                <div class="col-sm-12 col-md-4 col-sm-4 "><i><img src="images/mangalore.png"></i></div>
                <div class="col-sm-12 col-md-4 col-sm-4 "><i><img src="images/mysore.png"></i></div>
                <div class="col-sm-12 col-md-4 col-sm-4 "><i><img src="images/patna.png"></i></div>
                <div class="col-sm-12 col-md-4 col-sm-4 "><i><img src="images/surat.png"></i></div>
                <div class="col-sm-12 col-md-4 col-sm-4 "><i><img src="images/vadodara.png"></i></div>
                <div class="col-sm-12 col-md-4 col-sm-4 "><i><img src="images/vijayawada.png"></i></div>
                <div class="col-sm-12 col-md-4 col-sm-4 "><i><img src="images/vizag.png"></i></div>
              </div>
            </div>
          </div>
           </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>-->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/ie10-viewport-bug-workaround.js"></script>
<script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      //<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places&sensor=false">
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          mapTypeControl: false,
          center: {lat: 17.398729, lng: 78.477011},
          zoom: 10
        });
        new AutocompleteDirectionsHandler(map);
      }
      var panel = document.getElementById("directionsPanel");

       /**
        * @constructor
       */
      function AutocompleteDirectionsHandler(map) {
        this.map = map;
        this.originPlaceId = null;
        this.destinationPlaceId = null;
        this.travelMode = 'DRIVING';
        var originInput = document.getElementById('from_cab');
        var destinationInput = document.getElementById('to_cab');
        var modeSelector = document.getElementById('mode-selector');
        this.directionsService = new google.maps.DirectionsService;
        this.directionsDisplay = new google.maps.DirectionsRenderer;
        this.directionsDisplay.setMap(map);
var options = {
		  types: ['(cities)'],
		  componentRestrictions: {country: "in"}
		 };
        var originAutocomplete = new google.maps.places.Autocomplete(
            originInput, {placeIdOnly: true},options);
        var destinationAutocomplete = new google.maps.places.Autocomplete(
            destinationInput, {placeIdOnly: true},options);
/* CABS AUTO COMPLETE*/

		var originCab = document.getElementById('from_cab');
		var destinationCab = document.getElementById('to_cab');
		var originAutocomplete = new google.maps.places.Autocomplete(originCab, {placeIdOnly: true},options);
		var originAutocomplete = new google.maps.places.Autocomplete(destinationCab, {placeIdOnly: true},options);


/* CABS AUTO COMPLETE*/
        this.setupClickListener('changemode-walking', 'WALKING');
        this.setupClickListener('changemode-transit', 'TRANSIT');
        this.setupClickListener('changemode-driving', 'DRIVING');

        this.setupPlaceChangedListener(originAutocomplete, 'ORIG');
        this.setupPlaceChangedListener(destinationAutocomplete, 'DEST');

     /* this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(originInput);
        this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(destinationInput);
        this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(modeSelector);
		*/
      }

      // Sets a listener on a radio button to change the filter type on Places
      // Autocomplete.
      AutocompleteDirectionsHandler.prototype.setupClickListener = function(id, mode) {
        var radioButton = document.getElementById(id);
        var me = this;
        radioButton.addEventListener('click', function() {
          me.travelMode = mode;
          me.route();
        });
      };

      AutocompleteDirectionsHandler.prototype.setupPlaceChangedListener = function(autocomplete, mode) {
        var me = this;
        autocomplete.bindTo('bounds', this.map);
        autocomplete.addListener('place_changed', function() {
          var place = autocomplete.getPlace();
          if (!place.place_id) {
            window.alert("Please select an option from the dropdown list.");
            return;
          }
          if (mode === 'ORIG') {
            me.originPlaceId = place.place_id;
          } else {
            me.destinationPlaceId = place.place_id;
          }
          me.route();
        });

      };

      AutocompleteDirectionsHandler.prototype.route = function() {
        if (!this.originPlaceId || !this.destinationPlaceId) {
          return;
        }
        var me = this;

        this.directionsService.route({
          origin: {'placeId': this.originPlaceId},
          destination: {'placeId': this.destinationPlaceId},
          travelMode: this.travelMode
        }, function(response, status) {
          if (status === 'OK') {
            me.directionsDisplay.setDirections(response);
            me.directionsDisplay.setPanel(panel);
          } else {
            window.alert('Directions request failed due to ' + status); 
			
          }
        });
      };

    </script> 
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyGcD5Ra8qIeE82FqrrkW3WfMrXiji2uQ&libraries=places&callback=initMap"
        async defer></script>
  </body>
   <?php require_once('footer.php'); ?>
</html>