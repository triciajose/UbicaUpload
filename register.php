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
    	$username = $mysqli->real_escape_string($_POST["username"]);
    	$password = $mysqli->real_escape_string($_POST["password"]);

        $new = "INSERT INTO admin (email, password) VALUES ('$username', '$password') ";
        mysqli_query($mysqli,$new);

        // check for duplicates
    	$current = "SELECT uid FROM admin WHERE email='$username' AND OR password='$password'";
    	$result = mysqli_query($mysqli,$current);

        // if no duplicates, send to main page with proper uid
    	if (mysqli_num_rows($result) != 0) {
    		$row = mysqli_fetch_row($result);
    		$uid = $row[0];
    		header("Location: upload.php?uid=" . $uid);
    		
    	}
        // return to register page with error
    	else {
    		header("Location: new.php?error=old");
    	}
    mysqli_free_result($result);
	$mysqli->close();
	}
?>

</body>
</html>