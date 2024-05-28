<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "digital_dynasty";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{

	die("failed to connect!");
}

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "digital_dynasty";

// $conn = new mysqli($servername, $username, $password, $dbname);

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

?>
