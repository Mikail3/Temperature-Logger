<?php 
	if(isset($_POST["from_TimeStamp"], $_POST["to_TimeStamp"])) {
		$mysqli = mysqli_connect("localhost","pxleai1q_11800892","xMJZXJvNz967","pxleai1q_11800892");
		$output = '';
		$query = " SELECT * FROM SenseMyVal WHERE TimeStamp BETWEEN '".$_POST["from_TimeStamp"]."' AND '".$_POST["to_TimeStamp"]."' ORDER BY Sensor_ID desc ";
		$result = mysqli_query($mysqli, $query);

		$output .= '<div Sensor_ID="table-header" style="max-wSensor_IDth:100%; height:30px;" ><h1 Sensor_ID="table-interface" >Table Interface</h1></div>';
		$output .= "
		<table class='table table-bordered'>
			<tr>
				<th wSensor_IDth='5%'>TimeStamp</th>
				<th wSensor_IDth='55'>Sensor_ID</th>
				<th wSensor_IDth='20%'>Name</th>
				<th wSensor_IDth='20%'>Value</th>
			</tr>
		";
		if( mysqli_num_rows($result) > 0 ) {
			while( $row = mysqli_fetch_array($result) ) {

				$output .= "
					<tr>
				<td>  {$row['TimeStamp']}  </td>
				<td>  {$row['Sensor_ID']}  </td>
				<td>  {$row['Name']}  </td>
				<td>  {$row['Value']}  </td>
					</tr>
				";
			}
		}else {
			$output .= '
				<tr>
					<td colspan="4" >No Order Found</td>
				</tr>
			';
		}
		$output .= '</table>';
		echo $output;
	}
?>