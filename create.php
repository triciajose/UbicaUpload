<?php 

	$host = "localhost";
	$user = "dawood";
	$pass = "1234dawood";
	$directory = "ubica";

	$mysqli = new mysqli($host, $user, $pass, $directory);

	$admin = "CREATE TABLE admin (
		uid INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE,
		email VARCHAR(255) NOT NULL UNIQUE,
		password VARCHAR(244) NOT NULL))"

	$folders = "CREATE TABLE admin (
		uid INT(11),
		key VARCHAR(255) NOT NULL PRIMARY KEY UNIQUE,
		folder VARCHAR(244) NOT NULL UNIQUE))"

	mysqli_query($mysqli,$admin);
	mysqli_query($mysqli,$folders);



?>