<?php
	
	//  mysql credentials
	$host = "localhost";
	$user = "root";
	$pass = "password";
	$directory = "ubica";

	// connect to mysql
	$mysqli = new mysqli($host, $user, $pass, $directory);

	// fetch folder and folder passkeys
	$current = "SELECT * FROM folders";
	$result = mysqli_query($mysqli,$current);
	while($row=mysqli_fetch_row($result)) {
		$data = array();
		$data[] = array("pass" => $row[1],"table" => $row[2]);
		$output[] = array("key" => $data);
	}
	// print in json
	print(json_encode($output));
	$mysqli->close();
?>