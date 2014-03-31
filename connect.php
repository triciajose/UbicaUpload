<?php

	$host = "localhost";
	$user = "root";
	$pass = "password";
	$directory = "ubica";

	$mysqli = new mysqli($host, $user, $pass, $directory);

	$current = "SELECT folder FROM folders";
	$result = mysqli_query($mysqli,$current);
	while($row=mysqli_fetch_row($result)) {
		$array = array();
		$now = $row[0];
		$current = "SELECT Name,Version, DateModified FROM files WHERE folder = '$now'";
		// die($current);
		$internal = mysqli_query($mysqli,$current);
		while($new=mysqli_fetch_assoc($internal)) {
			$array[] = $new;
		}
		$output[] = array($now => $array);
	}

	print(json_encode($output));
	$mysqli->close();
?>