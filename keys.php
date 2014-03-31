<?php

	$host = "localhost";
	$user = "root";
	$pass = "password";
	$directory = "ubica";

	$mysqli = new mysqli($host, $user, $pass, $directory);

	$current = "SELECT * FROM folders";
	$result = mysqli_query($mysqli,$current);
	while($row=mysqli_fetch_row($result)) {
		$data = array();
		$data[] = array("pass" => $row[1],"table" => $row[2]);
		$output[] = array("key" => $data);
	}
	print(json_encode($output));
	$mysqli->close();
?>