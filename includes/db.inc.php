<?php

$servername = "localhost";
$username = "phpteszt";
$password = "123456";
$dbname = "ulesrend";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";

?>
