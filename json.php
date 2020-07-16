<html>
<head>
<title>Json generation pagina</title>
</head>
<body>
 <?php

$servername = "localhost";
$username = "pxleai1q_11800892";
$password = "xMJZXJvNz967";
$dbname = "pxleai1q_11800892";

$conn = new mysqli($servername, $username, $password, $dbname);


  if ($conn->connect_errno) {
     printf("Failed to connect to database");
     exit();
  }


  $result = $conn->query("SELECT sensor_ID, Value, TimeStamp FROM Data order by TimeStamp");


  $conn = array();
  $json = array();

  while ( $row = $result->fetch_assoc())  {
	$conn[]=$row;
    $json[$row["sensor_ID"]][] = array($row["Value"],(int)$row["TimeStamp"]);
  }

  $json_array = array();
  foreach ($json as $value) {
  	$json_array[] = $value;
  }
 
$fp = fopen('databank.json', 'w');
fwrite($fp, json_encode($conn));
fclose($fp);
echo json_encode($json_array);


?>
</body>
</html>