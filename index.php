<?php
	$servername = "localhost";
	$username = "id19887505_user";
	$password = "e3q)/e\+_+EK2}lt";
	$dbname = "id19887505_acodb";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$sql = "SELECT id FROM Paths";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
		//	echo "id: " . $row["id"];
		}
	} else {
		echo "0 results";
	}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
<title>Page Title</title>
<link rel="stylesheet" href="main.css">
<meta charset="utf-8">
</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<body>

<h1>Ścieżki rowerowe</h1>
<p>Badanie efektywności ACO</p>
<p>Badanie</p>
<div id="map"></div>
  <form id="formoid" title="" method="post"> 
    <input type="text" id="pointA" name="pointA" /> 
    <br/> 
    <input type="text" id="pointB" name="pointB" /> 
    <br/>
    <input type="submit" id="submitButton" name="submitButton" value="Generuj">
  </form>

<p>Trasa od punktu </p>
<div id="result"></div>
<p>do punktu </p>
<div id="result2"></div>
<p>Trasa</p>
<div id="path"></div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXtVW9PGrt3c7vRbWtkdcA3-K3IT7PpjA&callback=initMap&libraries=&v=weekly" async></script>
<script>
    let map;
    const labels = ["A1", "B1", "A2", "B2", "C2", "D2", "E2", "F2", "G2", "H2"];
    let labelIndex = 0;

    function initMap() {
       const A1 = { lat: 53.12505506282493, lng: 22.963490150668637 };
       const B1 = { lat: 53.12814017847637, lng: 23.08763854448744 };
       
       const A2 = { lat: 53.122329, lng: 23.099703 };
       const B2 = { lat: 53.122254, lng: 23.100253 };
       const C2 = { lat: 53.122617, lng: 23.100406 };
       const D2 = { lat: 53.122332, lng: 23.102326 };
       const E2 = { lat: 53.122885, lng: 23.102064 };
       const F2 = { lat: 53.122323, lng: 23.102687 };
       const G2 = { lat: 53.121546, lng: 23.102785 };
       const H2 = { lat: 53.122324, lng: 23.104139 };
       map = new google.maps.Map(document.getElementById("map"), {
         center: { lat: 53.13304821627044, lng: 23.16756746020692 },
         zoom: 12
       });
       
       const bikeLayer = new google.maps.BicyclingLayer();

      bikeLayer.setMap(map);
      google.maps.event.addListener(map, "click", (event) => {
        addMarker(event.latLng, map);
      });
      
      addMarker(A1, map);
      addMarker(B1, map);
      
      addMarker(A2, map);
      addMarker(B2, map);
      addMarker(C2, map);
      addMarker(D2, map);
      addMarker(E2, map);
      addMarker(F2, map);
      addMarker(G2, map);
      addMarker(H2, map);
    }
    
function addMarker(location, map) {
  new google.maps.Marker({
    position: location,
    label: labels[labelIndex++ % labels.length],
    map: map,
  });
}
    
</script>

<script type="text/javascript">
$("#formoid").submit(function(event) {
console.log('Wchodzi');
  event.preventDefault();

  var $form = $(this),
    url = $form.attr('action');

  var posting = $.post(url, {
    pointA: $('#pointA').val(),
    pointB: $('#pointB').val()
  });
  if ($('#pointA').val().length != 2) {
      posting.done(function() {
        $('#result').text('Podany błędny punkt');
        $('#result2').text('Podany błędny punkt');
      });
  } else {
      posting.done(function(data) {
        $('#result').text($('#pointA').val());
        $('#result2').text($('#pointB').val());
      });
  }
  
  
  posting.fail(function() {
    $('#result').text('failed');
  });
  console.log($('#pointA').val()[1]);
});

fetch("paths.json")
  .then(response => response.json())
  .then(json => $('#result').text(json.paths[0].name));
</script>

</body>
</html>