<?php 
$servername = "localhost";
$username = "pxleai1q_11800892";
$password = "";
$dbname = "pxleai1q_11800892";

$conn = new mysqli($servername, $username, $password, $dbname);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Data from sensors</title>
	<style type="text/css">
		h3{
			display: inline-block;
		}
	</style>
	<script type="text/javascript">

		function filter()
		{
			var ajax = new XMLHttpRequest();
			ajax.onreadystatechange = function() 
			{
    			if (this.readyState == 4 && this.status == 200) 
    			{
     				document.getElementById("tabel").innerHTML = this.responseText;
    			}
  			};
			ajax.open("Get", "Ajaxfilter.php?Sensor_ID="+ document.getElementById("Sensor_ID").value, true);
			ajax.send();
		}

		function ajax()
		{
			var ajax = new XMLHttpRequest();
			ajax.onreadystatechange = function() 
			{
    			if (this.readyState == 4 && this.status == 200) 
    			{
     				document.getElementById("java").innerHTML = this.responseText;
    			}
  			};
			ajax.open("Get", "Collector.php?Sensor_ID="+ document.getElementById("Sensor_ID").value+"&Value="+ document.getElementById("Value").value, true);
			ajax.send();
		}
	</script>
</head>
<body>


	<h1>Enter the values of the sensors</h1>
	<h2>Sensor</h2>
	<h3>ID</h3>
	<input type="text" id="Sensor_ID"><br>
	<h3>Value </h3>
	<input type="text" id="Value"><br>


	<button onclick= "ajax()">Enter values</button>
	<button onclick="filter()">filter</button>

<p id= "java"> </p>

<table id="tabel" border="1">
</table>

</body>
</html>
