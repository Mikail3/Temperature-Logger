<html>
<head>
<title>Connector page & Save Last</title>
</head>
<body>
<?php
	ini_set('display_errors', 1);
	error_reporting(~0);
	
	$ID1 = $_GET["Sensor_ID"];
	$ID2 = $_GET["ID"];
	$Name = $_GET["naam"];
	$Value = $_GET["Value"];
	
	$IP = $_SERVER['REMOTE_ADDR'];

	$servername = "localhost";
	$username = "pxleai1q_11800892";
	$password = "";
	$dbname = "pxleai1q_11800892";
	
	
	$date = date('Y-m-d h:i:s', time());

	$sql = "INSERT INTO Data (`Sensor_ID`,  `Value`, `TimeStamp`) 
	VALUES ('".$_GET["Sensor_ID"]."','".$_GET["Value"]."',now() )";
	

	$conn = mysqli_connect($servername,$username,$password,$dbname);
	$query = mysqli_query($conn,$sql);
	
	///$sql = "UPDATE Sensor SET Sensor_ID = '$Sensor_ID2', Name = '$Name',IP = '$IP';";
	$query = mysqli_query($conn,$sql);
	echo $sql;
	mysqli_close($conn);

?>
</body>
</html>
