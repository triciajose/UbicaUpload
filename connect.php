<?php
	$mysqli = new mysqli("localhost","root","password","ubica");
	$current = "SELECT * FROM files";
	$result = mysqli_query($mysqli,$current);
	while($row=mysqli_fetch_assoc($result)) {
		$output[] = $row;
	}
	print(json_encode($output));// this will print the output in json
	$mysqli->close();
?>