	<head>
		<link href="css/current.css" rel="stylesheet">
		<script type="text/javascript" src="js/current.js"></script>
		
	</head>
	<body>
		
<script language="javascript">
 
var GETDATA = new Array();
 
// Get the string that follows the "?" in the window's location.
var sGet = window.location.search;
if (sGet) // if has a value...
{
    // Drop the leading "?"
    sGet = sGet.substr(1);
     
    // Generate a string array of the name value pairs.
    // Each array element will have the form "foo=bar"
    var sNVPairs = sGet.split("&");
     
    // Now, for each name-value pair, we need to extract
    // the name and value.
    for (var i = 0; i < sNVPairs.length; i++)
    {
        // So, sNVPairs[i] contains the current element...
        // Split it at the equals sign.
        var sNV = sNVPairs[i].split("=");
         
        // Assign the pair to the GETDATA array.
        var sName = sNV[0];
        var sValue = sNV[1];
        GETDATA[sName] = sValue;
    }
}
   
var namarum = GETDATA["nama_outlet"];
var namavar = "";
if(typeof(namarum) != "undefined")
{ 
namavar= namarum;
var res = namavar.split("%5E");
lat = res[1];
long = res[2];
}
//alert(lat);
</script>

		<div id="google_canvas"></div>
		<div id='tujuan'>
		<form name="form1" id="form1" method="post" action="?p=current">
			<input type="Hidden" id="media" name="media" value="">
			<input type="hidden" id="media2" name="media2" value="">
		</form>
		</div>
		<script src="//maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script>

	    <script>
	    (function() {
	    
	    	if(!!navigator.geolocation) {
	    	
	    		var map;
	    	
		    	var mapOptions = {
		    		zoom: 15,
		    		mapTypeId: google.maps.MapTypeId.ROADMAP
		    	};
		    	
		    	map = new google.maps.Map(document.getElementById('google_canvas'), mapOptions);
	    	
	    		navigator.geolocation.getCurrentPosition(function(position) {
	    		
		    		var geolocate = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
				var a = position.coords.latitude-lat;
				var b = position.coords.longitude-long;
		    		var infowindow = new google.maps.InfoWindow({
		    			map: map,		    			
					position: geolocate,
		    			content:
		    				'<h1>Lokasi Anda!</h1>' +
		    				'<h2>Latitude: ' + position.coords.latitude + '</h2>' +
		    				'<h2>Longitude: ' + position.coords.longitude + '</h2>'+
		    				'<h2>Selisih Latitude: ' + a + '</h2>' +
		    				'<h2>Selisih Longitude: ' + b + '</h2>'
		    		});
		    		document.login.lat.value = position.coords.latitude;
				document.login.long.value = position.coords.longitude;
					
		    		map.setCenter(geolocate);
		    		
if(a>0.0002 || a< -0.0002 ){
// alert("Peringatan!! Posisi anda sangat jauh dari Outlet Quick &' Clean.");
// location.href="http://localhost/qnc_new/";
}
	    		});
	    		
	    	} else {
	    		document.getElementById('google_canvas').innerHTML = 'No Geolocation Support.';
	    	}
	    	
	    })();		
	    </script>
		<script>
			var _gaq=[['_setAccount','UA-20440416-10'],['_trackPageview']];
			(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
			g.src='//www.google-analytics.com/ga.js';
			s.parentNode.insertBefore(g,s)})(document,'script');
		</script>