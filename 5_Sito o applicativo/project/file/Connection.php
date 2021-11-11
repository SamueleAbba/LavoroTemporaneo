<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "lavoro_temporaneo";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if($conn->connect_error){
		die("Database connection non ok: " . $conn->connect_error);
	}
?>