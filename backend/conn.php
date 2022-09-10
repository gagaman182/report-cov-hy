<?php
// 4.3
// $servername = "localhost";
// $username = "root";
// $password = "1234";
// $dbname = "cmu_chronic";
//  $port = "3306";
// // localhost
// // $servername = "localhost";
// // $username = "root";
// // $password = "123456789";
// // $dbname = "epidem";
// //  $port = "3306";



// takis 3
//$servername = "61.19.25.207"; //dev mode
$servername = "localhost";
$username = "takis";
$password = "skho@00866";
$dbname = "data_hinfo";
$port = "3306";



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8");