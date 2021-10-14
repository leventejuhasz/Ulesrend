<?php

	$servername = "localhost";
	$username = "php";
	$password = "Nq8re1yu3mWXfPTe";
	$dbname = "ulesrend";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
	}
?>