<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	    <title>Docshare</title>
	    <link rel="stylesheet" type="css" href="upload.css">
		<link href="http://fonts.googleapis.com/css?family=Lato:300|Grand+Hotel" rel="stylesheet" type="text/css" />
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script type="text/javascript" src="upload.js"></script>
</head>
<body>
<img id="logo" src="logo.gif">
<h2>Upload a document</h2>
<div id="form">
<form action="upload.php" method="post" enctype="multipart/form-data">
	<label class="choose" for="file">Select a file to upload</label>
	<!-- <br/> -->
	<input class ="actual" type="file" name="file" id="file" onchange="CopyMe(this, 'txtFileName');">
	<!-- <br/> -->
	<input id="txtFileName" type="text" readonly="readonly" />
	<br/>
	<br/>	
	<input class= "uploadb" type="submit" name="submit" value="Upload" onclick="Submit();">
</form>

<?php
	$mysqli = new mysqli("localhost","root","password","ubica");
	if ($mysqli->connect_errno) {
	    printf("Connect failed: %s\n", $mysqli->connect_error);
	    exit();
	}
	$allowedExts = array("pdf");
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);

	if ($_FILES["file"]["type"] == "application/pdf") {
		if ($_FILES["file"]["error"] > 0) {
		    echo "Return Co0de: " . $_FILES["file"]["error"] . "<br>";
		    }
		else {
			$name = $mysqli->real_escape_string($_FILES["file"]["name"]);
			move_uploaded_file($_FILES["file"]["tmp_name"], "files/" . $name);

			$current = "SELECT Version FROM files WHERE Name='$name'";
			$result = mysqli_query($mysqli,$current);
			$row = mysqli_fetch_row($result);
			if (mysqli_num_rows($result) != 0) {
				$version = $row[0] + 1;
      			$sql = "UPDATE Files SET Version ='$version', DateModified =CURRENT_TIMESTAMP WHERE Name='$name'";
      			mysqli_query($mysqli,$sql);
      			mysqli_free_result($result);
			}
			else {
				$sql="INSERT INTO files (Name, Version, DateModified) VALUES ('$name', '0', CURRENT_TIMESTAMP)";
				mysqli_query($mysqli,$sql);
			}
      		echo "<div id='confirmation'><p>Upload complete</p></div>";
		}
	}
	else{
		    echo "<div id='confirmation'><p>Invalid file</p></div>";

	}    
	$mysqli->close();

    
?>

</body>
</html>