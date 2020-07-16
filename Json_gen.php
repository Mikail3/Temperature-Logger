<?php 

$connect = mysqli_connect("localhost","pxleai1q_11800892","passwordXXX","pxleai1q_11800892");
$sql = "SELECT * FROM DataSensor LEFT JOIN Sensor ON DataSensor.Sensor_ID = Sensor.ID";
$result = mysqli_query($connect, $sql);

$Timestamp = array();
$ID = array();
$Name = array();
$Value = array();

while( $data = mysqli_fetch_array($result) ) { 
	$Timestamp[] = $data['Timestamp'];
	$ID[] = $data['ID']; 
	$Name[] = $data['Name'];
	$Value[] = $data['Value'];
}

mysqli_close($connect);
$json = array('Timestamp' => $Timestamp, 'ID' => $ID, 'Name' => $Name, 'Value' => $Value);
echo json_encode($json);

?>
