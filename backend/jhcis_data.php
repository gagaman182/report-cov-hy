<?php
header('Content-Type:application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization');
$data = json_decode(file_get_contents('php://input'), true);

// $cmu = $data['cmu'];


include 'conn.php';


$sql = "SELECT
DATE_FORMAT(f43_service.DATE_SERV,'%d-%m-%Y')  as DATE_SERV,
count(case when  CHIEFCOMP like '%# OPDSI%' OR CHIEFCOMP like '%#OPDSI%' OR CHIEFCOMP like '%OPDSI%'  then f43_service.SEQ end)  as OPDSI,
count(case when  f43_service.CHIEFCOMP not like ' %#OPDSI ติดตามครั้งที่ %' then f43_service.SEQ end) as OPDSI_FU
FROM
	f43_service
left join mas_hospital_new on f43_service.HOSPCODE = mas_hospital_new.HOSCODE5
left join mas_rigth on  f43_service.INSTYPE = mas_rigth.INSTYPE_4
left join f43_diagnosis_op on f43_service.HOSPCODE = f43_diagnosis_op.HOSPCODE and f43_service.SEQ = f43_diagnosis_op.SEQ
where f43_service.DATE_SERV BETWEEN '20220410'  and '20220910'
and f43_diagnosis_op.DIAGCODE in ('U071','U072')


GROUP BY f43_service.DATE_SERV desc

      
     
      ";





$return_arr = array();

if ($result = mysqli_query($conn, $sql)) {
	while ($row = mysqli_fetch_assoc($result)) {

		array_push($return_arr, $row);
	}
}

mysqli_close($conn);

echo json_encode($return_arr);