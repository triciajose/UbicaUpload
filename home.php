<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
</head>
<body>
<?php

	$host = "localhost";
	$user = "dawood";
	$pass = "1234dawood";
	$directory = "ubica";

	$mysqli = new mysqli($host, $user, $pass, $directory);
	if ($mysqli->connect_errno) {
	    printf("Connect failed: %s\n", $mysqli->connect_error);
	    exit();
	}
    if(isset($_POST)) {
    	// CHECK USER PERMS
    	$username = $mysqli->real_escape_string($_POST["username"]);
    	$password = $mysqli->real_escape_string($_POST["password"]);

    	$current = "SELECT uid FROM admin WHERE email='$username' AND password='$password'";
    	$result = mysqli_query($mysqli,$current);

    	if (mysqli_num_rows($result) != 0) {
    		$row = mysqli_fetch_row($result);
    		$uid = $row[0];
    		header("Location: upload.php?uid=" . $uid);
    		
    	}
    	else {
    		header("Location: index.php?error=yes");
    	}
    mysqli_free_result($result);
	$mysqli->close();
	}
?>

</body>
</html>