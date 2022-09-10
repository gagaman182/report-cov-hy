<?php
header('Content-Type:application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization');
$data = json_decode(file_get_contents('php://input'), true);

// $cmu = $data['cmu'];


include 'conn.php';


$sql = "SELECT
DATE_FORMAT(OPD_DATE,'%d-%m-%Y') AS OPD_DATE,
COUNT(CASE WHEN TYPE =  '#OPDSI'  THEN HN END) AS 'OPDSI',
COUNT(CASE WHEN TYPE =  'ICD10'  THEN HN END) AS 'ICD10',
COUNT(CASE WHEN TYPE =  'FUOP'  THEN HN END) AS 'FUOP'
FROM
	monitor_opdsi

GROUP BY OPD_DATE
ORDER BY DATE_FORMAT(OPD_DATE,'%Y-%m-%d')  DESC
      
     
      ";





$return_arr = array();

if ($result = mysqli_query($conn, $sql)) {
	while ($row = mysqli_fetch_assoc($result)) {

		array_push($return_arr, $row);
	}
}

mysqli_close($conn);

echo json_encode($return_arr);