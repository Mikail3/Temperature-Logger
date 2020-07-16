<!DOCTYPE html>
<html>
<head>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script type="text/javascript" src="JQ/jquery.jqplot.js"></script>
  <script type="text/javascript" src="JQ/plugins/jqplot.canvasTextRenderer.js"></script>
  <script type="text/javascript" src="JQ/plugins/jqplot.canvasAxisLabelRenderer.js"></script>
  <script type="text/javascript" src="JQ/plugins/jqplot.logAxisRenderer.js"></script>
  <script type="text/javascript" src="JQ/plugins/jqplot.canvasAxisTickRenderer.js"></script>
  <script type="text/javascript" src="JQ/plugins/jqplot.dateAxisRenderer.js"></script>
  <script type="text/javascript" src="JQ/plugins/jqplot.categoryAxisRenderer.js"></script>
<script type="text/javascript" src="JQ/plugins/jqplot.barRenderer.js"></script>
  <script type="text/javascript" src="JQ/plugins/jqplot.cursor.js"></script>
<script type="text/javascript" src="JQ/plugins/jqplot.highlighter.js"></script>
<script type="text/javascript" src="JQ/plugins/jqplot.enhancedLegendRenderer.js"></script>

  <link rel="stylesheet" type="text/css" href="JQ/jquery.jqplot.css" />

</head>
<body>
  <h1>JQuery Plot </h1>
  <h2> With toggle and filter function</h2>
  <div id="Data"></div>
  <script>
    $(document).ready(function(){
  
   $.jqplot.config.enablePlugins = true;
    // For these examples, don't show the to image button.
    $.jqplot._noToImageButton = true;
      

        var line1 =<?php
            $dbhost="localhost"; 
            $dbuser="pxleai1q_11800892"; 
            $dbpass="xMJZXJvNz967"; 
            $dbname="pxleai1q_11800892";

  $dblink = new mysqli($dbhost, $dbuser, $dbpass, $dbname);


  if ($dblink->connect_errno) {
     printf("Failed to connect to database");
     exit();
  }


  $result = $dblink->query("SELECT Sensor_ID, Value, TimeStamp FROM Data order by TimeStamp");


  $dbdata = array();
  $json = array();

  while ( $row = $result->fetch_assoc())  {
  $dbdata[]=$row;
    $json[$row["Sensor_ID"]][] = array($row["TimeStamp"],(int)$row["Value"]);
  }

  $json_array = array();
  foreach ($json as $Value) {
    $json_array[] = $Value;
  }
 
$fp = fopen('databank.json', 'w');
fwrite($fp, json_encode($dbdata));
fclose($fp);
echo json_encode($json_array);


?>;

        var plot1 = $.jqplot('Data', line1, { animation: true,

      title: 'RPI DATA',
     //seriesDefaults: {showMarker:false}, 
    series:[
				{label:'Sensor1 = Free CPU',markerOptions: {
					style: 'filledCircle'
				}},
				{label:'Sensor2 = CPU Temperature',markerOptions: {
					style: 'filledSquare'
				}}
			],
      cursor: {
				show: true,
				zoom: true,
				looseZoom: true,
		
       
        }, 
     	legend: { 
				show: true,
				location: 'nw',
				placement: 'insideGrid',
				renderer: $.jqplot.EnhancedLegendRenderer,
			
			},
        axes:{
            xaxis:{
                pad : 0 ,
                renderer:$.jqplot.DateAxisRenderer, 
                 tickRenderer:$.jqplot.CanvasAxisTickRenderer,
                tickOptions:{
                   angle: -15,
                  formatString:'%b %#d, %#I %p'  
                },
                min:'December 25, 2019 8:00AM', 
                tickInterval:'1 day',
                label: 'TimeStamp',
             labelOptions:{
            fontFamily:'Helvetica',
            fontSize: '14pt'
          },
          labelRenderer: $.jqplot.CanvasAxisLabelRenderer
              },
         yaxis:{
 
            tickOptions:{
                labelPosition: 'middle', 
            },
            labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
            labelOptions:{
                fontFamily:'Helvetica',
                fontSize: '14pt'
            },
            label:'Value'
          }
            }
          
      });

         $('.button-reset').click(function() { plot1.resetZoom() });
        });
    


  </script>
</body>
</html>