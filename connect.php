<?php
	$mysqli = new mysqli("localhost","root","password","ubica");
	$current = "SELECT folder FROM folders";
	$result = mysqli_query($mysqli,$current);
	while($row=mysqli_fetch_row($result)) {
		$array = array();
		$now = $row[0];
		$data = array();
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