<?php require_once('header.php');
header("Cache-Control: max-age=300, must-revalidate");
extract($_REQUEST);
 
$fcity=urlencode(trim($from_buses11));
$tcity=urlencode(trim($to_buses11));
$url= "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$fcity&destinations=$tcity&key=AIzaSyDDYt0AfLoYzYx5yJapP8SDga4JT4jkAXQ&sensor=false&alternatives=true";
//echo "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$fromCity&destinations=$searchTextField&key=AIzaSyAFt3QcoFJmKxntUni-NxGxrwcSAJhRgUc&sensor=false&alternatives=true";

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
//print_r($obj);
$distance = $obj['rows'][0]['elements'][0]['distance']['text'];
$time = $obj['rows'][0]['elements'][0]['duration']['text'];
?>
<style>
#list-from{float:left;list-style:none;margin-top:-10px;padding:0;width:94%;position: absolute;z-index:1000;}
#list-from li { padding: 5px; background: #FFF;border-bottom: #bbb9b9 1px solid;width: 96%; color: black; border-right: #bbb9b9 1px solid; border-left: #bbb9b9 1px solid;}
/*#list-from li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;width:100%;color:black;}*/
#list-from li:hover{background:#ece3d2;cursor: pointer;}
#from_buses11{padding: 10px;border: #a8d4b1 1px solid;border-radius:4px;}
#list-to{float:left;list-style:none;margin-top:-10px;padding:0;width:94%;position: absolute;z-index:1000;}
#list-to li{ padding: 5px; background: #FFF;border-bottom: #bbb9b9 1px solid;width: 96%; color: black; border-right: #bbb9b9 1px solid; border-left: #bbb9b9 1px solid;}
/* #list-to li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;width:100%;color:black;}*/
#list-to li:hover{background:#ece3d2;cursor: pointer;}
#to_buses11{padding: 10px;border: #a8d4b1 1px solid;border-radius:4px;}
</style>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
$("#from_buses11").keyup(function(){
    $.ajax({
        type: "POST",
        url: "getData.php",
        data:'keyword='+$(this).val(),
        minlength: 3,
        beforeSend: function(){
            $("#from_buses11").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
        },
        
        success: function(data){
            //alert('From');
            $("#suggesstion-box-from").show();
            $("#suggesstion-box-from").html(data);
            $("#from_buses11").css("background","#FFF");
        }
    });
        if($("#from_buses11").val()=='')
            $("#suggesstion-box-from").hide();
});

$("#to_buses11").keyup(function(){
    $.ajax({
        type: "POST",
        url: "getData2.php",
        data:'keyword='+$(this).val(),
        beforeSend: function(){
            $("#to_buses11").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
        },
        success: function(data){
            $("#suggesstion-box-to").show();
            $("#suggesstion-box-to").html(data);
            $("#to_buses11").css("background","#FFF");
        }
    });
        if($("#to_buses11").val()=='')
            $("#suggesstion-box-to").hide();
});

});
function selectFrom(val) {
    $("#from_buses11").val(val);
    $("#suggesstion-box-from").hide();
}
function selectTo(val) {
    $("#to_buses11").val(val);
    $("#suggesstion-box-to").hide();
}
</script>-->
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
         <div class="col-sm-12 col-md-6 col-sm-6 ">
            <div class="panel panel-primary">
              <div class="panel-heading">
			  <?php if($transType==1){ ?>
                <span id="fontawe">
                  <i class="fa fa-map-signs" aria-hidden="true">
                  </i>&nbsp;&nbsp;
                  <i class="fa fa-map-marker" aria-hidden="true">
                  </i>
                </span>
                &nbsp;&nbsp;
                <span id="tabfon">Local City Transit
                </span>
			  <?php }elseif($transType==2){?>
				<span id="fontawe">
                  <i class="fa fa-train" aria-hidden="true">
                  </i>
                </span>
                <span id="tabfon">Metro Train Services
                </span>
			  <?php }elseif($transType==3){?>
				<span id="fontawe">
                  <i class="fa fa-train" aria-hidden="true">
                  </i>
                </span>
                <span id="tabfon">Local Train Services
                </span>
			  <?php }?>
			  
			  </div>
              <div class="panel-body">
                <form action="search.php" method="POST" id="frmBusSearch" name="frmBusSearch">
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control" required  id="from_buses11" name="from_buses11"  autocomplete="off"  value="<?php echo $from_buses11; ?>" placeholder="Enter an origin location">
                        <div id="suggesstion-box-from"></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12"> 
                      <input type="text" class="form-control" required  id="to_buses11"  name="to_buses11"  autocomplete="off"  value="<?php echo $to_buses11; ?>" placeholder="Enter a destination location">
                        <div id="suggesstion-box-to"></div>
                    </div>
                  </div>
				  <div class="form-group">
                    <div class="cc-selector" style="color:#000"> 
                     <div class="col-xs-3 col-md-3 col-sm-6 "> <input type="radio"  id="bus" name="transType" onclick="changeSearch()" value="1" <?php if($transType==1){ ?> checked <?php }?>/><label class="drinkcard-cc bus" for="bus"></label></div>
					   <div class="col-xs-3 col-md-3 col-sm-6 "> <input type="radio"  id="metro" name="transType" onclick="changeSearch()" value="2" <?php if($transType==2){ ?> checked <?php }?>/><label class="drinkcard-cc metro"for="metro"></label></div>
					  <div class="col-xs-3 col-md-3 col-sm-6 ">  <input type="radio"  id="mmts" name="transType" onclick="changeSearch()" value="3" <?php if($transType==3){ ?> checked <?php }?>/><label class="drinkcard-cc train" for="mmts"></label></div>
					   <div class="col-xs-3 col-md-3 col-sm-6 ">  <input type="radio"  id="cabs" name="transType" onclick="changeSearch()" value="4" <?php if($transType==4){ ?> checked <?php }?>/><label class="drinkcard-cc cab" for="cabs"></label></div>
                    </div>
                  </div>
 
				  <input type="submit" id="busSearch" name="busSearch" class="btn btn-success pull-right" value="Go">
                </form>
                
              </div>
            </div>
          </div>
		  <div class="col-sm-12 col-md-6 col-sm-6 ">
            <div class="panel panel-primary" id="map" style="width:100%;height:290;min-height: 290px;position: relative;overflow: hidden;">
               
            </div>
          </div>
          &nbsp;&nbsp;&nbsp;
          
	


<div class="col-sm-12 col-md-6 col-sm-6 ">
           <div class="panel panel-primary">
              <div class="panel-heading"><b>
          	<!--<p>From Location : <?php echo $_REQUEST['from_buses11'];?></p>
          	<p>To Location : <?php echo $_REQUEST['to_buses11'];?>
          	<p>Estimated Distance : <?php echo $distance;?> & Time : <?php echo $time;?></p></b> -->
			<?php if($transType==1){ ?>
          	Below are the Current buses for your Route
			  <?php }elseif($transType==2){?>
          	Below are the Metro Trains for your Route
			  <?php }elseif($transType==3){?>
          	Below are the Local Trains for your Route
			  <?php }?>
			<div id="directionsPanel"></div>
          </div>
          </div>
          </div>
          
	
        
			<div class="col-sm-4 col-md-6">
			<div class="panel panel-primary">
			<div class="panel-heading">
			   <div class="table-responsive "> OTHER BUSES FOR YOUR ROUTE
				 <table class="table table-bordered" id="table" data-toggle="table" data-toolbar="#toolbar" width="100%">
				 	    <div class="col-sm-4 col-md-6 ">
                                            <thead>
                                                <tr>
							<!--<th>S.No</th>-->
							<?php if($transType==1){ ?>
								<th>Your Buses</th>
							  <?php }elseif($transType==2){?>
							<th>Your Metro</th>
							  <?php }elseif($transType==3){?>
							<th>Your MMTS</th>
							 <?php }elseif($transType==4){?>
							<th>Your Transport</th>
							  <?php }?>
						
							<th>Starts From</th>
							<th>Destination</th>
							<!--<th>Estimated Travel Time</th>
							<th>Estimated Distance(Km)</th>-->
                                                </tr>
                                            </thead>
                                            <tbody>
                                
						<?php 
						$rids='';$trids='';
					//echo "SELECT DISTINCT(rid) FROM `stages_info` WHERE `stage_search` LIKE '%$from_buses11%' AND rid IN (SELECT DISTINCT(rid) FROM `stages_info` WHERE `stage_search` LIKE '%$to_buses11%')";
					    $toQ1=mysql_query("SELECT DISTINCT(rid) FROM `stages_info` WHERE `stage_search` LIKE '%$to_buses11%'");
					    while($gettoQ1=mysql_fetch_assoc($toQ1)){
							$trids.=$gettoQ1['rid'].",";
						}
						$trids=substr($trids,0,-1);
						//$startQry=mysql_query("SELECT DISTINCT(rid) FROM `stages_info` WHERE `stage_search` LIKE '%$from_buses11%' AND rid IN (SELECT DISTINCT(rid) FROM `stages_info` WHERE `stage_search` LIKE '%$to_buses11%')");
				// 		echo "SELECT DISTINCT(rid) FROM `stages_info` WHERE `stage_search` LIKE '%$from_buses11%' AND rid IN ($trids)";
						$startQry=mysql_query("SELECT DISTINCT(rid) FROM `stages_info` WHERE `stage_search` LIKE '%$from_buses11%' AND rid IN ($trids)");
						while($getstart=mysql_fetch_assoc($startQry)){
							$rids.=$getstart['rid'].",";
						}
					$i=1;
				 $new_rids= substr($rids, 0, -1);
			 
				 if($transType==4){
					$getNumRows=mysql_num_rows(mysql_query("SELECT * FROM `routs_info` WHERE rid IN ($new_rids) "));
				}else{
					//echo "SELECT * FROM `routs_info` WHERE rid IN ($new_rids) AND tid=$transType AND destination_search LIKE '%$to_buses11%'";
					//$getNumRows=mysql_num_rows(mysql_query("SELECT * FROM `routs_info` WHERE rid IN ($new_rids) AND tid=$transType AND destination_search LIKE '%$to_buses11%'"));
					$getNumRows=mysql_num_rows(mysql_query("SELECT * FROM `routs_info` WHERE rid IN ($new_rids) AND tid=$transType"));
				}
				if($getNumRows>0){
				//$toQry=mysql_query("SELECT DISTINCT(rid) FROM `stages_info` WHERE `stage_search` LIKE '%$to_buses11%' AND rid IN ($new_rids)");
				if($transType==4)
				{
					$toQry=mysql_query("SELECT DISTINCT(stages_info.rid) FROM `stages_info` RIGHT JOIN `routs_info` ON routs_info.rid=stages_info.rid WHERE  stages_info.rid IN ($new_rids) AND stages_info.sid!=''");
				}
				else
				{
					$toQry=mysql_query("SELECT DISTINCT(stages_info.rid) FROM `stages_info` RIGHT JOIN `routs_info` ON routs_info.rid=stages_info.rid WHERE stages_info.rid IN ($new_rids) AND stages_info.sid!='' AND routs_info.tid=$transType");
				}
				while($getTo=mysql_fetch_assoc($toQry)){
					$getRouteinfo=mysql_fetch_assoc(mysql_query("SELECT * FROM `routs_info` WHERE rid=".$getTo['rid']));
					$f1=mysql_fetch_assoc(mysql_query("SELECT sid FROM `stages_info` WHERE `stage_search` LIKE '%$from_buses11%' AND rid IN ($new_rids)"));
					$t1=mysql_fetch_assoc(mysql_query("SELECT sid FROM `stages_info` WHERE `stage_search` LIKE '%$to_buses11%' AND rid IN ($new_rids)"));
					 ?> 
						<tr>   
							<td><a class="btn btn-primary btn-sm"href="detail_info.php?bno=<?php echo $getRouteinfo['route_no'];?>&rid=<?php echo $getRouteinfo['rid'];?>&fsid=<?php echo $f1['sid'];?>&tsid=<?php echo $t1['sid'];?>"><?php echo $getRouteinfo['route_no'];?>&nbsp;&nbsp;<i class="fa fa-bus"></i></a></td>
							<td><?php echo $getRouteinfo['source'];?></td>
							<td><?php echo $getRouteinfo['destination'];?></td>
						</tr>
				  <?php $i=$i+1;}
				}
				else{?>
					<tr>   
							<td colspan=3><h4>Sorry!!! No Records are Found...!</h4></td>
					</tr>
							
				<?php }
				  ?>
                                            </tbody>
                                            </div>
                                            </div>
                                        </table>
                                        </div>
				</div>	 
			</div><p>Click on Bus Number for Complete Route Details</p>
			</div>
			
          </div>
        </div>
      </div>
    </div>
    
  
    <?php require_once('footer.php'); ?>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>-->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/ie10-viewport-bug-workaround.js"></script>
	
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyGcD5Ra8qIeE82FqrrkW3WfMrXiji2uQ&library=places&callback=initMap" async defer>
    </script>

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
        
        

		//var s1=[{location:new google.maps.LatLng(16.7356779,82.2094136),stopover:false}];
		//var d1=[{location:new google.maps.LatLng(16.8456779,82.4094136),stopover:false}];
		
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
          //waypoints: [{location:new google.maps.LatLng(16.732141,82.2148758),stopover:false},{location:new google.maps.LatLng(16.7331335,82.211544),stopover:false}],
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
  </body>
</html>
