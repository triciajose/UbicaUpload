<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
</head>
<body>
<?php

    $host = "localhost";
    $user = "root";
    $pass = "password";
    $directory = "ubica";

	$mysqli = new mysqli($host, $user, $pass, $directory);
	if ($mysqli->connect_errno) {
	    printf("Connect failed: %s\n", $mysqli->connect_error);
	    exit();
	}
    if(isset($_POST)) {
    	// CHECK USER PERMS

        $name = $mysqli->real_escape_string($_POST["what"]);

        $select = "SELECT * from files WHERE Name='$name'";
        $return = mysqli_query($mysqli, $select);
        $row = mysqli_fetch_row($return);
        $folder = $row[0];

        $delete = "DELETE FROM files WHERE Name = '$name'";
        mysqli_query($mysqli,$delete);
        $target = $folder . "/" . $name;
        unlink($target);

	}
    header("Location: upload.php?uid=" . $_GET['uid']);
?>

</body>
</html>