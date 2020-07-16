<?php //header('Content-type: application/xml'); 

define('DB_SERVER', 'localhost');
define('DB_USER', 'pxleai1q_11800892');
define('DB_PASSWORD', 'xMJZXJvNz967');
define('DB_NAME', 'pxleai1q_11800892');
 
$conn = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

echo "<rss version='2.0' xmlns:atom='http://www.w3.org/2005/Atom'>\n";
echo "<channel>\n";

echo "<title>Stats van tabel 'Data'</title>\n";
echo "<description>Showing the average, min and max Values of the sensors</description>\n";
echo "<link>http://11800892.pxl-ea-ict.be/Collector.php</link>\n";

$stmt = $conn->query("SELECT Sensor_ID, AVG(Value) AS avg, MIN(Value) AS min, MAX(Value)as max  FROM Data GROUP BY Sensor_ID");

while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
    
	echo "<item>\n";
		echo "<title>Stats of sensor $row->Sensor_ID</title>\n";
		echo "<description>Average = $row->avg<br/>\n";
    	echo "Min = $row->min<br/>\n";
    	echo "Max = $row->max</description>\n";
		echo "<link>http://11800892.pxl-ea-ict.be/Collector.php</link>\n";
 
    echo "</item>\n";
 
}
echo "</channel>\n";
echo "</rss>\n";
?>