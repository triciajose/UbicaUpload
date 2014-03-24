<?php
	$mysqli = new mysqli("localhost","dawood","1234dawood","ubica");
	$current = "SELECT * FROM files";
	$result = mysqli_query($mysqli,$current);
	while($row=mysqli_fetch_assoc($result)) {
		$output[] = $row;
	}
	print(json_encode($output));// this will print the output in json
	$mysqli->close();
?>