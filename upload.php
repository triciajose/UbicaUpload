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
	<input class = "actual" type="file" name="file" id="file" onchange="CopyMe(this, 'txtFileName');">
	<!-- <br/> -->
	<input id="txtFileName" type="text" readonly="readonly" />
	<br/>
	<br/>	
	<input class= "uploadb" type="submit" name="submit" value="Upload" onclick="Submit();">
</form>

<?php
	$con = mysqli_connect("localhost","root","password","ubica");
	if (mysqli_connect_errno()) {
    	die('Could not connect: ' . mysqli_connect_error());
	}
	$allowedExts = array("pdf");
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);
	if ($_FILES["file"]["type"] == "application/pdf") {
		if ($_FILES["file"]["error"] > 0) {
		    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
		    }
		else {
			$name = $_FILES["file"]["name"];
			$time = date("Y-m-d", time());
			move_uploaded_file($_FILES["file"]["tmp_name"], "files/" . $name);
			$result = mysqli_query($con, "SELECT $version FROM Files WHERE Name='$name'");
      		// mysqli_query($con, "INSERT INTO Files (Name, Date Modifed, Version) VALUES ('test', '1992-03-23', '0')");

			if ($result) {
				$version = $result + 1;
      			mysqli_query($con, "UPDATE Files SET Version=$version AND Date Modified='$time' WHERE Name='$name'");

			}
			else {
				$version = 0;
      			mysqli_query($con, "INSERT INTO Files (Name, Date Modifed, Version) VALUES ('$name', '$time', '$version')");
			}
      		echo "<div id='confirmation'><p>Upload complete</p></div>";
		}
	}
	else{
		    echo "<div id='confirmation'><p>Invalid file</p></div>";

	}    
	mysqli_close($con);

    
?>

</body>
</html>