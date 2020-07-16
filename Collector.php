<?php
$IP = $_SERVER['REMOTE_ADDR'];
$servername = "localhost";
$username = "pxleai1q_11800892";
$password = "x";
$dbname = "pxleai1q_11800892";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_GET["Sensor_ID"]) || isset($_GET["Value"]) )
{
	$sql = "INSERT INTO Data (`Sensor_ID`, `Value`)
	VALUES ('".$_GET["Sensor_ID"]."', '".$_GET["Value"]."')";

	if ($conn->query($sql) === TRUE) {
	    echo "Inserted ";
	} else {
	    echo "Not insterted" . $sql . "<br>" . $conn->error;
	}


	$sql = "UPDATE Sensor SET External_IP = '".$IP ."', LastKnownTimestamp = now() WHERE ID = '" . $_GET["Sensor_ID"]. "'";
	if ($conn->query($sql) === TRUE) {
	    echo "Updated ";
	} else {
	    echo "Not Updated" . $sql . "<br>" . $conn->error;
	}

}
?>
