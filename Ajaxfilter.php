<tr><th>sensor ID</th><th>Value</th></tr>

<?php 

$servername = "localhost";

$username = "pxleai1q_11800892";

$password = "";

$dbname = "pxleai1q_11800892";



$conn = new mysqli($servername, $username, $password, $dbname);



$sql = "SELECT Sensor_ID,Value FROM Data WHERE Sensor_ID=".$_GET["Sensor_ID"];

$result = $conn->query($sql);

if ($result == false)

{

	echo "oh jeejmineej: ".$conn->error;

}

if ($result->num_rows > 0) {

    // output data of each row

    while($row = $result->fetch_assoc()) {

        echo "<tr><td>" . $row["Sensor_ID"]. "</td><td> " . $row["Value"]. " </td></tr>";

    }

} else {

    echo "";

}



$conn->close();



?>

 
