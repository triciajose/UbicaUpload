<?php 
	// script to create mysql table structure
	$host = "localhost";
	$user = "dawood";
	$pass = "1234dawood";
	$directory = "ubica";

	$mysqli = new mysqli($host, $user, $pass, $directory);

	$admin = "CREATE TABLE admin (
		uid INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE,
		email VARCHAR(255) NOT NULL UNIQUE,
		password VARCHAR(255) NOT NULL
		)";

	$folders = "CREATE TABLE folders (
		uid INT(11),
		passkey VARCHAR(255) NOT NULL PRIMARY KEY UNIQUE,
		folder VARCHAR(255) NOT NULL UNIQUE
		)";	

	if (mysqli_query($mysqli,$admin) && mysqli_query($mysqli,$folders)) {
		echo "Success";
	}



?>