<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<title>CB's HW6 & The First PHP Page</title>
	<style> 
		:root{
			--green:	rgb(57,169,64);
			--blue:		rgb(98,197,242);
			--blue2:    rgb(160,201,236);
			--blue3:	rgb(81,157,195);
			--gray:		rgb(170,170,170);
			--gray2:	rgb(240,240,240);
			--qin:		#9DD2DB;
		}
		/*TIMES NEW ROMAN*/
		/*DEFAULT*/
		p{font-family: TIMES NEW ROMAN; margin: 0px; font-weight: 800; color: white;}
		/*DEFAULT*/
		p.title{font-size: 50px; margin-bottom: 5px;
			font-weight: 100; font-style: italic;}
		p.context{font-size: 20px;}
		p.white{color: white;}
		p.card_title{font-size: 40px; margin-bottom: -5px;}
		p.card_zone{font-size: 18px; font-weight: 100; margin-top: 5px;}
		p.card_temperature{ font-size: 100px; margin: -10px auto; margin-left: 0px;}
		p.card_F{font-size: 50px; margin: -10px auto; margin-left: 0px;/*border: 5px solid white;*/}
		p.card_summary{ font-size: 45px; margin-bottom: 3px;}
		p.card_feature{ font-size: 20px; }
		p.error{ font-size: 20px; color: black;}

		p.summary_temp{font-size: 100px; margin-left: 20px;}
		p.summary_F{font-size: 70px; margin-top: 26px;}
		p.summary_title{font-size: 40px; color: black;}
		p.summary_sum{font-size: 30px; margin-top: 60px; margin-left: 20px;}
		p.summary_data{font-size: 20px; margin: 3px;}
		p.summary_data1{font-size: 25px; margin: 0px;}
		p.summary_symbol{font-size: 15px; margin-top: 10px; margin-left: 3px; margin-right: 3px;}
		body{text-align:center}
		html, body {
			width: 100%;  height: 100%;
			padding: 0;
		}
		table {
			border-collapse: collapse;
			margin: auto;
			width: 820px;
		}
		table, th, td{
			border: 2px solid var(--blue3);
			background-color: var(--blue2);
			color: white;
			font-family:TIMES NEW ROMAN;
			font-weight: 800;
			font-size: 18px;
		}

		.weathersearch {
			display: flex;
			flex-direction: column;
			align-self: center;
			margin: 30px auto;
			border-radius: 24px;
			width: 740px;
			height: 250px;
			background-color: var(--green);	
		}
		.searchbox{
			display: flex;
			align-self: center;
			width: 640px;
			height: 130px;
			margin:0 auto;
			margin-top: 0px;
			margin-bottom: 20px;
			/*border: 5px solid red ;*/
		}
		.column{
			display: flex;
			flex-direction: column;
			align-self: center;
			height: 130px;
			margin:0 auto;
			margin-top: 0px;
		}
		.box1{
			width: 55.00%;
			border-right: 5px solid white;
		}
		.box2{
			width: 45.00%;
		}
		.row{
			display: flex;
			flex-direction: row;
			align-self: left;
			margin: 5px;
		}
		.row1{
			display: flex;
			flex-direction: row;
			align-self: left;
			margin: 0px;
		}
		.weathercard{
			display: flex;
			flex-direction: column;
			align-self: center;
			margin: 30px auto;
			border-radius: 24px;
			width: 500px;
			height: 320px;
			background-color: var(--blue);
		}
		.card{
			display: flex;
			flex-direction: column;
			text-align: left;
			margin: auto;
			width: 90%;
			height: 90%;
		}
		.feature_row{
			display: flex;
			flex-direction: row;
			text-align: center;
		}
		.feature_col{
			display: flex;
			flex-direction: column;
			text-align: center;
			width: 20%;
		}
		img{ margin: auto; }
		.weathertable{
			display: flex;
			flex-direction: column;
			align-self: center;
			margin: 30px auto;
			width: 840px;
			height: 300px;
		}
		.error_handle{
			display: flex;
			flex-direction: column;
			align-self: center;
			text-align: center;
			margin: 0px auto;
			width: 400px;
			height: 25px;
			background-color: var(--gray2);
			border: 3px solid var(--gray);
		}
		.summary_col1{
			display: flex;
			flex-direction: column;
			text-align: left;
			width: 50%;
		}
		.summary_link{
			cursor: pointer;
		}
		.summary_card{
			display: flex;
			flex-direction: column;
			align-self: center;
			margin: 30px auto;
			border-radius: 24px;
			width: 450px;
			height: 400px;
			background-color: var(--qin);
		}
		.chart{
			display: flex;
			flex-direction: column;
			align-self: center;
			margin: auto;
		}
	</style>

	<script type="text/javascript">
	function cb_check(){
		var check = document.getElementsByName("current_location")[0];
		var street = document.getElementsByName('street')[0];
		var city = document.getElementsByName('city')[0];
		var state = document.getElementsByName('state')[0];
		if (check.checked){
			street.value = "";
			city.value = "";
			state.value = "";
			street.disabled = true;
			city.disabled = true;
			state.disabled = true;
			getJSON();
		} else {
			street.disabled = false;
			city.disabled = false;
			state.disabled = false;
		}	
	}
	function getJSON(){
		var url = "http://ip-api.com/json";
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var response = JSON.parse(this.responseText);
				if(response.status !== 'success') {
					console.log('query failed: ' + response.message);
					return
				}
				saveJSON(response);
			}
		};
		xhr.open('GET', url, true);
		xhr.send();
		function saveJSON(arr) {
			var lat = arr.lat;
			var lng = arr.lon;
			var city = arr.city;
			document.getElementsByName('lat')[0].value = lat;
			document.getElementsByName('lng')[0].value = lng;
			document.getElementsByName('curr_city')[0].value = city;
		}
	}
	function show_summary(num){
		var is_summary = document.getElementsByName('is_summary')[0];
		var arror = document.getElementsByName('arror')[0];
		var chart = document.getElementById('chart_div');
		is_summary.value = num;
		arror.value = 'true';
		chart.display = false;
		var frm = document.getElementById('location');
		frm.submit();
	}
	function chart_status(){
		var arror = document.getElementsByName('arror')[0];
		// window.alert(arror.value);
		var chart = document.getElementById('chart_div');
		if (arror.value == 'true') { arror.value = ''; chart.display=true; chart.style.height = 250;}
		else { arror.value = 'true';  chart.display=false; }
		var frm = document.getElementById('location');
		frm.submit();
	}
	function go_back(){
		var is_summary = document.getElementsByName('is_summary')[0];
		is_summary.value = 'false';
	}
	function cb_clear(){
		var check = document.getElementsByName("current_location")[0];
		var street = document.getElementsByName('street')[0];
		var city = document.getElementsByName('city')[0];
		var state = document.getElementsByName('state')[0];
		var clear = document.getElementsByName('clear')[0];
		clear.value = "true";

		check.checked = false;
		street.value = "";
		city.value = "";
		state.value = "";

		street.disabled = false;
		city.disabled = false;
		state.disabled = false;

		var frm = document.getElementById('location');
		frm.submit();
	}

	</script>
</head>

<body>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	<div class="weathersearch">
		<p class="title white">Weather Search</p>
		<form name="form" method="POST" id="location" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
			<input type="text" name="lat" value="<?php if(isset($_POST["lat"])) {echo $_POST["lat"];} ?>" style="display: none;">
			<input type="text" name="lng" value="<?php if(isset($_POST["lng"])) {echo $_POST["lng"];} ?>" style="display: none;">
			<input type="text" name="curr_city" value="<?php if(isset($_POST["curr_city"])) {echo $_POST["curr_city"];} ?>" style="display: none;">
			<input type="text" name="is_summary" 
				value="<?php if(isset($_POST["is_summary"])) {echo $_POST["is_summary"];} ?>" style="display: none;">
			<input type="text" name="arror" 
			value="<?php if(isset($_POST["arror"])) {echo $_POST["arror"];} else{echo "true";}?>" style="display: none;">
			<input type="text" name="clear" value="false" style="display: none;">

			<div class="searchbox">
				<div class="column box1">
					<div class="row">
						<p class="context">Street</p>
						<!-- 1184 W 30th st -->
						<input type="text" name="street" value="<?php if(isset($_POST["street"])) {echo $_POST["street"];} ?>" 
						<?php if(isset($_POST["current_location"])){echo "disabled";} ?>
							style="height: 20px; margin-top: 0px; margin-left: 13px;">
					</div>
					<div class="row">
						<p class="context">City</p>
						<!-- Los Angeles -->
						<input type="text" name="city" value="<?php if(isset($_POST["city"])) {echo $_POST["city"];} ?>"
							  <?php if(isset($_POST["current_location"])){echo "disabled";} ?>
							  style="height: 20px; margin-top: 0px; margin-left: 26px;">
					</div>
					<!-- States -->
					<div class="row">
						<p class="context">State</p>
						<?php 
							$state_array = array("AL" => "Alabama", "AK" => "Alaska", "AZ" => "Arizona", "AR" => "Arkansas", "CA" => "California", "CO" => "Colorado", "CT" => "Connecticut", "DE" => "Delaware", "DC" => "District Of Columbia", "FL" => "Florida", "GA" => "Georgia", "HI" => "Hawaii", "ID" => "Idaho", "IL" => "Illinois", "IN" => "Indiana", "IA" => "Iowa", "KS" => "Kansas", "KY" => "Kentucky", "LA" => "Louisiana", "ME" => "Maine", "MD" => "Maryland", "MA" => "Massachusetts", "MI" => "Michigan", "MN" => "Minnesota", "MS" => "Mississippi", "MO" => "Missouri", "MT" => "Montana", "NE" => "Nebraska", "NV" => "Nevada", "NH" => "New Hampshire", "NJ" => "New Jersey", "NM" => "New Mexico", "NY" => "New York", "NC" => "North Carolina", "ND" => "North Dakota", "OH" => "Ohio", "OK" => "Oklahoma", "OR" => "Oregon", "PA" => "Pennsylvania", "RI" => "Rhode Island", "SC" => "South Carolina", "SD" => "South Dakota", "TN" => "Tennessee", "TX" => "Texas", "UT" => "Utah", "VT" => "Vermont", "VA" => "Virginia", "WA" => "Washington", "WV" => "West Virginia", "WI" => "Wisconsin", "WY" => "Wyoming", );
						?>
						<select name="state"  <?php if(isset($_POST["current_location"])){echo "disabled";} ?>
								style="height: 20px; width: 250px; margin-top: 3px; margin-left: 10px;">
						<option value="" <?php if(isset($_POST["state"])){if($_POST["state"] == ""){echo "selected='selected'";}} ?> >State</option>
						<optgroup label="----------------------------------"></optgroup>
						<?php
							foreach ($state_array as $key => $value) {
								$state_out = "<option value='".$key."'";
								if (isset($_POST["state"])) {
									if ($_POST["state"] == $key) {
										$state_out .= " selected='selected'";
									}
								}
								echo $state_out.">".$value."</option>";
							}
						?>
						</select> 
					</div>
				</div>
				<div class="column box2">
					<div class="row">
						<input type="checkbox" name="current_location" style="height:20px;width:20px; margin-left: 100px"
						<?php if(isset($_POST["current_location"])){echo "checked";} ?> onclick="cb_check()">
						<p class="context">Current Location</p>
					</div>
				</div>
				
			</div>
			<div class="row" style=" margin-left: 270px">
				<input type="submit" name="search" value="search" onclick="go_back()">
				<input type="button" name="clear" value="clear" onclick="cb_clear()">
			</div>

		</form>
	</div>

	<?php 
		$street = $city = $state = "";
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			if (isset($_POST["street"])) { $street = urlencode($_POST["street"]); }
			if (isset($_POST["city"])) { $city = $_POST["city"]; }
			if (isset($_POST["state"])) { $state = urlencode($_POST["state"]); }

			if (isset($_POST["current_location"])) {
				// get lat and lng by current location.
				$lat = $_POST["lat"];
				$lng = $_POST["lng"];
				$city = $_POST["curr_city"];
				$content = get_content($lat, $lng);
				// draw summary
				if ($_POST["is_summary"] != "false"){
					draw_summary($lat, $lng, $content);
				}
				else{ 
					$content = weathercard($city, $content);
					$daily = $content[daily][data];
					drawTable($daily); 
				}
			}else if (isset($_POST["clear"]) && $_POST["clear"]=="true"){ pass;
			}else if ($city == "" || $street == "" || $state =="") {
				error_handle();
			}else{
				// get lat and lng by city, street and state.
				$latlng = get_geo($city, $street, $state);
				$content = get_content($latlng[0], $latlng[1]);
				// draw summary
				if ($_POST["is_summary"] != "false"){
					draw_summary($latlng[0], $latlng[1], $content);
				}
				else{ 
					$content = weathercard($city, $content);
					$daily = $content[daily][data];
					drawTable($daily);
				}
			}
		}
	?>
	<div class='chart' id='chart_div' style='width: 700px; height: 0px;'></div>
</body>
</html>
	

<?php
	function error_handle(){
		echo "<div class='error_handle'>";
		echo 	"<P class='error'>Please check the input address.</p>";
		echo "</div>";
	}
	function get_geo($city, $street, $state){
		$city_ur = urlencode($city);
		$google_api = "AIzaSyCAMqEaly9tgqc5ZZ67ShdPoro6-YZH-cA";
		$url = "https://maps.googleapis.com/maps/api/geocode/xml?address=[".$street.",".$city_ur.",".$state."]&key=".$google_api;
		// echo "url = ".$url."<br>";
		$content = file_get_contents($url);
		$content = simplexml_load_string($content) or die("Failed to load");
		$location = $content->result->geometry->location;
		$lat = $location->lat;
		$lng = $location->lng;
		return array($lat, $lng);
	}
	function get_content($lat, $lng){
		$dark_api = "da17781f45552e437387c0ebfff1948f";
		$url = "https://api.forecast.io/forecast/".$dark_api."/".$lat.",".$lng."?exclude=minutely,hourly,alerts,flags";
		// echo $url;
		$content = file_get_contents($url);
		$content = json_decode($content, true);
		return $content;
	}
	function weathercard($city, $content){
		echo "<div class='weathercard'><div class='card'>";

		$timezone = $content[timezone];
		$current = $content[currently];

		$temperature = round($current[temperature]);
		$summary = $current[summary];

		echo "<p class='card_title'>".$city."</p>";
		echo "<p class='card_zone'>".$timezone."</p>";
		echo "<div class='row'>";
		echo 	"<p class='card_temperature'>".$temperature."</p>";
		echo 	"<img src='https://cdn3.iconfinder.com/data/icons/virtual-notebook/16/button_shape_oval-512.png'";
		echo 	"width='15' height='15' style='margin-left: -295px; margin-top: 0px; margin-right: 0px'>";
		echo 	"<p class='card_F' style='margin-left: 0px; margin-top: 35px'>F</p>";
		echo "</div>";
		echo "<p class='card_summary'>".$summary."</p>";

		$feature = array("humidity", "pressure", "windSpeed", "visibility", "cloudCover", "ozone");
		$feature_title = array("Humidity", "Pressure", "WindSpeed", "Visibility", "CloudCover", "Ozone");
		$feature_icon = array("https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-16-512.png",
							"https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-25-512.png",
							"https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-27-512.png",
							"https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-30-512.png",
							"https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-28-512.png",
							"https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-24-512.png");
		echo "<div class='feature_row'>";
		foreach ($feature as $key => $value) {
			echo "<div class='feature_col'>";
			echo "<img src='".$feature_icon[$key]."'"."width=40 height=40 title=".$feature_title[$key].">";
			echo "<p class='card_feature'>".$current[$value]."</p>";
			echo "</div>";
		}
		echo "</div></div></div>";
		return $content;
	}

	function drawTable($daily){
		echo "<div class='weathertable'>";
		$rows = 8;
		$cols = 6;
		echo "<table>";
		echo "<tr>";
		$titles = array("Date", "Status", "Summary", "TemperatureHigh", "TemperatureLow", "Wind Speed");
		$js_titles = array('time', 'icon', 'summary', 'temperatureHigh', 'temperatureLow', "windSpeed");
		$icon = array("https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-12-512.png",
					"https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-04-512.png",
					"https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-19-512.png",
					"https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-07-512.png",
					"https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-27-512.png",
					"https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-28-512.png",
					"https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-01-512.png",
					"https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-02-512.png");
		$icon_dict = array("clear-day"=>0, "clear-night"=>0, "rain"=>1, "snow"=>2, "sleet"=>3, "wind"=>4,
						"fog"=>5, "cloudy"=>6, "partly-cloudy-day"=>7, "partly-cloudy-night"=>7);
		foreach ($titles as $value) {
			echo "<td align='center'>".$value."</td>";
		}
		echo "</tr>";
		for($tr=0;$tr<=$rows-1;$tr++){
			echo "<tr>";
			foreach ($js_titles as $value) {
				// get data
				$data = $daily[$tr][$value];
				// if it is date.
				if ($value=='time') { $data = date('Y-m-d', $data); }
				// if it is status. change the width and height
				if ($value=='icon') { $data = "<img src='".$icon[$icon_dict[$data]]."'"."width=50 height=50>"; }
				// if it is summary, just do it!
				if ($value=='summary') { $data = "<div class='summary_link' onclick='show_summary(".$tr.")'>".$data."</div>"; }
				echo "<td align='center'>".$data."</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
		echo "</div>";
	}
	function summary_card($content){
		date_default_timezone_set($content[timezone]);
		$daily = $content[daily];
		$content = $content[currently];
		$summary = $content[summary];
		$temperature = round($content[temperature]);
		$icon = $content[icon];
		$precipitation = $content[precipIntensity];
		$rain = $content[precipProbability] * 100;
		$windspeed = $content[windSpeed];
		$humidity = $content[humidity] * 100;
		$visibility = $content[visibility];
		$sunrise = $daily[data][0][sunriseTime];
		$sunset = $daily[data][0][sunsetTime];
		$sunriseT = date('g', $sunrise);
		$sunriseA = date('A', $sunrise);
		$sunsetT = date('g', $sunset);
		$sunsetA = date('A', $sunset);
		// $precipitation is good ;
		$precipitation = ($precipitation<=0.001) ? "None" :
						 (($precipitation<=0.015) ? "Very Light" :
						 (($precipitation<=0.05) ? "Light" :
						 (($precipitation<=0.1) ? "Moderate" : "Heavy")));

		$icon_arr = array("https://cdn3.iconfinder.com/data/icons/weather-344/142/sun-512.png",
					"https://cdn3.iconfinder.com/data/icons/weather-344/142/rain-512.png",
					"https://cdn3.iconfinder.com/data/icons/weather-344/142/snow-512.png",
					"https://cdn3.iconfinder.com/data/icons/weather-344/142/lightning-512.png",
					"https://cdn4.iconfinder.com/data/icons/the-weather-is-nice-today/64/weather_10512.png",
					"https://cdn3.iconfinder.com/data/icons/weather-344/142/cloudy-512.png",
					"https://cdn3.iconfinder.com/data/icons/weather-344/142/cloud-512.png",
					"https://cdn3.iconfinder.com/data/icons/weather-344/142/sunny-512.png");
		$icon_dict = array("clear-day"=>0, "clear-night"=>0, "rain"=>1, "snow"=>2, "sleet"=>3, "wind"=>4,
						"fog"=>5, "cloudy"=>6, "partly-cloudy-day"=>7, "partly-cloudy-night"=>7);

		echo "<p class='summary_title'>Daily Weather Detail</p>";
		echo "<div class='summary_card'>";
			echo "<div class='feature_row'  style='height: 50%;'>";
				echo "<div class='summary_col1'>";
					echo "<p class='summary_sum'>".$summary."</p>";
					echo "<div class='row' >";
						echo "<p class='summary_temp'>".$temperature."</p>";
						echo "<img src='https://cdn3.iconfinder.com/data/icons/virtual-notebook/16/button_shape_oval-512.png'";
						echo "width='15' height='15' style='margin-left: 0px; margin-top: 10px; margin-right: 0px;'>";
						echo "<p class='summary_F'>F</p>";
					echo "</div>";
				echo "</div>";
				echo "<div class='summary_col1'>";
					echo "<img src='".$icon_arr[$icon_dict[$icon]]."'"."width=210 height=210>";
				echo "</div>";
			echo "</div>";
			echo "<div class='feature_row'  style='height: 50%;'>";
				echo "<div class='summary_col1' style='width: 65%; text-align: right;'>";
					echo "<p class='summary_data'>Precipitation:</p>";
					echo "<p class='summary_data'>Chance of Rain:</p>";
					echo "<p class='summary_data'>Wind Speed:</p>";
					echo "<p class='summary_data'>Humidity:</p>";
					echo "<p class='summary_data'>Visibility:</p>";
					echo "<p class='summary_data'>Sunrise/Sunset:</p>";		
				echo "</div>";
				echo "<div class='summary_col1' style='width: 35%; text-align: left;'>";
					echo "<p class='summary_data1'>".$precipitation."</p>";
					echo "<div class='row1'><p class='summary_data1'>".$rain."</p>".
						"<p class='summary_symbol'>%</p>"."</div>";
					echo "<div class='row1'><p class='summary_data1'>".$windspeed."</p>".
						"<p class='summary_symbol'>mph</p>"."</div>";
					echo "<div class='row1'><p class='summary_data1'>".$humidity."</p>".
						"<p class='summary_symbol'>%</p>"."</div>";
					echo "<div class='row1'><p class='summary_data1'>".$visibility."</p>".
						"<p class='summary_symbol'>mi</p>"."</div>";
					echo "<div class='row' style='margin: 0px;'>";
					echo "<p class='summary_data1'>".$sunriseT."</p><p class='summary_symbol'>".$sunriseA."/</p>".
							"<p class='summary_data1'>".$sunsetT."</p><p class='summary_symbol'>".$sunsetA."</p>";
					echo "</div>";
				echo "</div>";
			echo "</div>";
		echo "</div>";
		echo "<p class='summary_title'>Day's Hourly Weather</p>";

	function get_hour_temp($content){
		$hour = $content[hourly][data];
		$arr = array();
		for ($i=0; $i < 24; $i++) { 
			array_push($arr, $hour[$i][temperature]);
		}
		return $arr;
	}

	}
	function get_summary($lat, $lng, $time){
		$dark_api = "da17781f45552e437387c0ebfff1948f";
		$url = "https://api.darksky.net/forecast/".$dark_api."/".$lat.",".$lng.",".$time."?exclude=minutely";
		$content = file_get_contents($url);
		$content = json_decode($content, true);
		return $content;
	}
	function draw_summary($lat, $lng, $content){
		$time = $content[daily][data][$_POST["is_summary"]][time];
		$content = get_summary($lat, $lng, $time);
		summary_card($content);
		$hour_temp = get_hour_temp($content);
		if ($_POST["arror"] == 'true') {
			echo "<img src='https://cdn4.iconfinder.com/data/icons/geosm-e-commerce/18/point-down-512.png'
			height='50' width='50' onclick='chart_status()' style='cursor: pointer;'>";
		} else {
			echo "<img src='https://cdn4.iconfinder.com/data/icons/geosm-e-commerce/18/point-up-512.png'
			height='50' width='50' onclick='chart_status()' style='cursor: pointer;'>";
			echo "<script type='text/javascript'> ; 
			google.charts.load('current', {packages: ['corechart', 'line']});
			google.charts.setOnLoadCallback(drawChart);
			function drawChart() {
				var data = new google.visualization.DataTable();
				data.addColumn('number', 'H');
				data.addColumn('number', 'T');
				var arr = ".json_encode($hour_temp)."
				for (var i = 0; i < arr.length; i++) {
					data.addRow([i,arr[i]]);
				}
				var options = {
					curveType: 'function',
					hAxis: { title: 'Time' },
					vAxis: { title: 'Temperature', textPosition: 'none'},
					colors: ['#9DD2DB']
				};
				var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
				chart.draw(data, options);
	    	}
			</script>";
		}
	}
?>