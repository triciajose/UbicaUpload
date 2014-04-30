<?php

	//  mysql credentials
	$host = "localhost";
	$user = "root";
	$pass = "password";
	$directory = "ubica";

	// connect to mysql
	$mysqli = new mysqli($host, $user, $pass, $directory);

	// select folders
	$current = "SELECT folder FROM folders";
	$result = mysqli_query($mysqli,$current);
	while($row=mysqli_fetch_row($result)) {
		$array = array();
		$now = $row[0];
		// display contents of folder
		$current = "SELECT Name,Version, DateModified FROM files WHERE folder = '$now'";
		$internal = mysqli_query($mysqli,$current);
		while($new=mysqli_fetch_assoc($internal)) {
			$array[] = $new;
		}
		$output[] = array($now => $array);
	}
	// print in json
	print(json_encode($output));
	$mysqli->close();
?>