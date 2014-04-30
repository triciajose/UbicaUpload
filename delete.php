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
        // find what to delete
        $name = $mysqli->real_escape_string($_POST["what"]);

        // remove entry from db
        $select = "SELECT * from files WHERE Name='$name'";
        $return = mysqli_query($mysqli, $select);
        $row = mysqli_fetch_row($return);
        $folder = $row[0];

        // remove document from server
        $delete = "DELETE FROM files WHERE Name = '$name'";
        mysqli_query($mysqli,$delete);
        $target = $folder . "/" . $name;
        unlink($target);

	}
    // redirect to main page
    header("Location: upload.php?uid=" . $_GET['uid']);
?>

</body>
</html>