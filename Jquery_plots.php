<!DOCTYPE html>

<html>

<head>
  <title>Grafiek JQ Plots</title>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script type="text/javascript" src="JQ/jquery.jqplot.js"></script>
  <script type="text/javascript" src="JQ/plugins/jqplot.canvasTextRenderer.js"></script>
  <script type="text/javascript" src="JQ/plugins/jqplot.canvasAxisLabelRenderer.js"></script>
  <script type="text/javascript" src="JQ/plugins/jqplot.dateAxisRenderer.js"></script>
  <link rel="stylesheet" type="text/css" href="JQ/jquery.jqplot.css" />
</head>

<body>

<h1 align="center">Grafiek JQplots</h1>

<div id = "Grafiek"></div>

<script>

  $(document).ready(function()

  {

    var plot1 = $.jqplot('Grafiek', <?php 
$servername = "localhost";
$username = "pxleai1q_11800892";
$password = ""; 
$dbname = "pxleai1q_11800892";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_errno) {
     printf("Failed to connect to database");
     exit();
  }


  $result = $conn->query("SELECT Sensor_ID, Value, TimeStamp FROM Data order by TimeStamp");

if($result ==  false){
  die(mysqli_error($conn));
}

  $dbdata = array();
  $json = array();

  while ( $row = $result->fetch_assoc())  {
  $dbdata[]=$row;
    $json[$row["Sensor_ID"]][] = array($row["TimeStamp"],(int)$row["Value"]);

  }

   $json_array = array();
  foreach ($json as $value) {
    $json_array[] = $value;
  }


$fp = fopen('databank.json', 'w');

fwrite($fp, json_encode($dbdata));

fclose($fp);

echo json_encode($json_array);

?>, { axes:{
        xaxis:{
            renderer:$.jqplot.DateAxisRenderer
        }
    }});

  });

</script>

</body>

</html>
