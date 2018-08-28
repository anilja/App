<?php require_once('header.php');   
mysql_connect("localhost","instowfv_user1","Uma_35128");
mysql_select_db("instowfv_instops"); 
 
extract($_REQUEST);

 /* Get Lat lang*/
 
 		$fAdd=urlencode($from_cab);
		$tAdd=urlencode($to_cab);
		$url= "https://maps.googleapis.com/maps/api/geocode/json?address=$fAdd&key=AIzaSyDDYt0AfLoYzYx5yJapP8SDga4JT4jkAXQ";

		$ch = curl_init();
		// Disable SSL verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Set the url
		curl_setopt($ch, CURLOPT_URL,$url);
		// Execute
		$result=curl_exec($ch);
		// Closing
		curl_close($ch);
		
		$result_array=json_decode($result);
		$obj = json_decode($result, TRUE);
		
		$slat = $obj['results'][0]['geometry']['location']['lat'];
		$slng = $obj['results'][0]['geometry']['location']['lng'];
		
		$url2= "https://maps.googleapis.com/maps/api/geocode/json?address=$tAdd&key=AIzaSyDDYt0AfLoYzYx5yJapP8SDga4JT4jkAXQ";

		$ch = curl_init();
		// Disable SSL verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Set the url
		curl_setopt($ch, CURLOPT_URL,$url2);
		// Execute
		$result2=curl_exec($ch);
		// Closing
		curl_close($ch);
		
		$result_array=json_decode($result2);
		$obj2 = json_decode($result2, TRUE);
		
		$dlat = $obj2['results'][0]['geometry']['location']['lat'];
		$dlng = $obj2['results'][0]['geometry']['location']['lng'];
		
		
 /* Get Lat Lang*/

 
 // echo " From : ".$slat.",".$slng;
 // echo " To : ".$dlat.",".$dlng;
 
//$access_key="KA.eyJ2ZXJzaW9uIjoyLCJpZCI6IktweUFrVnZwU2txdVB0RFRnTFVZRHc9PSIsImV4cGlyZXNfYXQiOjE1MTYwMjczNjgsInBpcGVsaW5lX2tleV9pZCI6Ik1RPT0iLCJwaXBlbGluZV9pZCI6MX0.tzoFcm0_xE8Mcmu2onslO4HvRdbCqF0ltzzBE6YcmFE";

$access_key="KA.eyJ2ZXJzaW9uIjoyLCJpZCI6ImlQd0xOTVNoU05PWGtueld6QmxXZXc9PSIsImV4cGlyZXNfYXQiOjE1MzMzNjMwOTksInBpcGVsaW5lX2tleV9pZCI6Ik1RPT0iLCJwaXBlbGluZV9pZCI6MX0.2arckNS05kIupqRV_KqBa1WkHNgkWVky28wbKbMl3fo";
//$access_key="KA.eyJ2ZXJzaW9uIjoyLCJpZCI6ImI5RjVabTZLU2p5ZjQrNkdJdlNxbUE9PSIsImV4cGlyZXNfYXQiOjE1MzAyNTc1ODMsInBpcGVsaW5lX2tleV9pZCI6Ik1RPT0iLCJwaXBlbGluZV9pZCI6MX0.9d1NL02iHP96ij0H7oy9pLiCkIN2IXYwQueY8RFMTl8";
// $start_latitude;
// $start_longitude;
// $end_latitude;
// $end_longitude;
$url= "https://api.uber.com/v1.2/estimates/price?start_latitude=$slat&start_longitude=$slng&end_latitude=$dlat&end_longitude=$dlng&access_token=$access_key";
 

    $ch = curl_init();
    // Disable SSL verification 
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // Will return the response, if false it print the response
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Set the url
    curl_setopt($ch, CURLOPT_URL,$url);
    // Execute
    $result=curl_exec($ch);
    // Closing
    curl_close($ch);

    $result_array=json_decode($result);
    $obj = json_decode($result, TRUE);
	  $sizeAry=sizeof($obj['prices']);
 $newObj=$obj['prices'];
 
 //$distance = $obj['rows'][0]['elements'][0]['distance']['text'];
 //$time = $obj['rows'][0]['elements'][0]['duration']['text'];
?> 
<br>
<br>
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
        <div class="col-sm-12 col-md-12 main">
         <div class="col-sm-12 col-md-4 col-sm-4 ">
            <div class="panel panel-primary">
              <div class="panel-heading"> 
                <span id="fontawe">
                  <i class="fa fa-bus" aria-hidden="true">
                  </i>
                </span>
                <span id="tabfon">Cab Services
                </span> 
			  </div>
              <div class="panel-body">
                <form action="cab_search.php" method="POST" id="frmBusSearch" name="frmBusSearch">
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control" required  id="from_cab" name="from_cab" value="<?php echo $from_cab; ?>" placeholder="Enter an origin location">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12"> 
                      <input type="text" class="form-control" required  id="to_cab"  name="to_cab" value="<?php echo $to_cab; ?>" placeholder="Enter a destination location">
                    </div>
                  </div>
				  
 
				  <input type="submit" id="busSearch" name="busSearch" class="btn btn-success pull-right" value="Go">
                </form>
                
              </div>
            </div>
          </div>
          

			<div class="col-sm-8 col-md-8">
			<div class="panel panel-primary">
			<div class="panel-heading">
			<div class="table-responsive ">
				<table class="table table-bordered" id="table" data-toggle="table" data-toolbar="#toolbar" width="100%" >
				 	    <div class="col-sm-12 col-md-12 ">
                                            <thead>
                                                <tr> 
													<th>Transport</th> 
													<th>Kms</th>
												        <!--<th>Duration(Min)</th>-->
													<th>Estimate</th> 
													<!--<th>Low Price</th>-->
													<th>Request A Ride</th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                
						 <?php for($i=0;$i<$sizeAry;$i++){ 
						 
						 ?>
						<tr>   
							<td><a class="btn btn-primary btn-sm" href="https://m.uber.com/ul/?client_id=2Gb8Ni784FcbKIEu337So_olFFRYJ3ZW&action=setPickup&pickup[latitude]=<?php echo $slat; ?>&pickup[longitude]=<?php echo $slng; ?>&pickup[nickname]=<?php echo $newObj[$i]['display_name']; ?>&pickup[formatted_address]=<?php echo $from_cab; ?>&dropoff[latitude]=<?php echo $dlat; ?>&dropoff[longitude]=<?php echo $dlng; ?>&dropoff[nickname]=<?php echo $newObj[$i]['display_name']; ?>&dropoff[formatted_address]=<?php echo $to_cab; ?>&product_id=<?php echo $newObj[$i]['product_id']; ?>&link_text=Request A Ride&partner_deeplink=instops"><?php echo $newObj[$i]['display_name']; ?>&nbsp&nbsp<i class="fa fa-cab"></i>
							</a></td>
							<td><?php echo ($newObj[$i]['distance']*1.6); ?></td>
							<!--<td><?php echo ($newObj[$i]['duration']/60); ?></td>--> 
								<td><?php echo $newObj[$i]['estimate']; ?></td> 
							<td>
							<!--https://m.uber.com/?client_id=2Gb8Ni784FcbKIEu337So_olFFRYJ3ZW  product_id
https://m.uber.com/ul/?client_id=<CLIENT_ID>&action=setPickup&pickup[latitude]=37.775818&pickup[longitude]=-122.418028&pickup[nickname]=UberHQ&pickup[formatted_address]=1455%20Market%20St%2C%20San%20Francisco%2C%20CA%2094103&dropoff[latitude]=37.802374&dropoff[longitude]=-122.405818&dropoff[nickname]=Coit%20Tower&dropoff[formatted_address]=1%20Telegraph%20Hill%20Blvd%2C%20San%20Francisco%2C%20CA%2094133&product_id=a1111c8c-c720-46c3-8534-2fcdd730040d&link_text=View%20team%20roster&partner_deeplink=partner%3A%2F%2Fteam%2F9383--> 

							<a class="btn btn-primary btn-sm" href="https://m.uber.com/ul/?client_id=2Gb8Ni784FcbKIEu337So_olFFRYJ3ZW&action=setPickup&pickup[latitude]=<?php echo $slat; ?>&pickup[longitude]=<?php echo $slng; ?>&pickup[nickname]=<?php echo $newObj[$i]['display_name']; ?>&pickup[formatted_address]=<?php echo $from_cab; ?>&dropoff[latitude]=<?php echo $dlat; ?>&dropoff[longitude]=<?php echo $dlng; ?>&dropoff[nickname]=<?php echo $newObj[$i]['display_name']; ?>&dropoff[formatted_address]=<?php echo $to_cab; ?>&product_id=<?php echo $newObj[$i]['product_id']; ?>&link_text=Request A Ride&partner_deeplink=instops"target="_blank">Request A Ride</a>
							
							</td> 
							<!--<td><?php echo $newObj[$i]['high_estimate']; ?></td> -->
						
						</tr>
						 <?php }?>
					<!--<tr>   
							<td colspan=3><h4>Sorry!!! No Records are Found...!</h4></td>
					</tr>--> 
                                            </tbody>
                                            </div>
                                            </div>
                                        </table>
                                        </div>
				 
			</div>
			</div>
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
	
   //<script  type="application/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyA8gxPnUHsP62_qul6aOM1QEEPUSYEJSsY"></script>
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwMxo4Zne-NBl8A8h-MBYlgjxppC_5rLc&libraries=places&callback=initMap"async defer></script>
<script  type="application/javascript">
   function initialize() {

	   var options = {
		  
		  componentRestrictions: {country: "in"}
		 };
   
      var input = document.getElementById('from_cab');
      var autocomplete = new google.maps.places.Autocomplete(input,options);
	  
	   var input2 = document.getElementById('to_cab');
      var autocomplete = new google.maps.places.Autocomplete(input2,options);

  

   }
   google.maps.event.addDomListener(window, 'load', initialize);
</script>
 
  </body>
</html>
