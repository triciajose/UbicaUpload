<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
</head>
<body>
<?php

	//  mysql credentials
    $host = "localhost";
    $user = "root";
    $pass = "password";
    $directory = "ubica";

    // connect to mysql
	$mysqli = new mysqli($host, $user, $pass, $directory);
	if ($mysqli->connect_errno) {
	    printf("Connect failed: %s\n", $mysqli->connect_error);
	    exit();
	}
    if(isset($_POST)) {
    	// CHECK USER PERMS
    	$password = $mysqli->real_escape_string($_POST["password"]);

    	$current = "SELECT uid FROM admin WHERE password='$password'";
    	$result = mysqli_query($mysqli,$current);

        // if user has access, set uid and redirect to main page
    	if (mysqli_num_rows($result) != 0) {
    		$row = mysqli_fetch_row($result);
    		$uid = $row[0];
    		header("Location: upload.php?uid=" . $uid);
    		
    	}
        // if user input is incorrect, send them to login page
    	else {
    		header("Location: index.php?error=yes");
    	}
    mysqli_free_result($result);
	$mysqli->close();
	}
?>

</body>
</html>