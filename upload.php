<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	    <title>Docshare</title>
	    <link rel="stylesheet" type="css" href="upload.css">
	    <link rel="stylesheet" type="css" href="foundation-5.2.1/css/foundation.css">
      	<link rel="stylesheet" type="css" href="foundation-5.2.1/css/normalize.css">

		<link href="http://fonts.googleapis.com/css?family=Lato:300|Grand+Hotel" rel="stylesheet" type="text/css" />
		<link href='http://fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script type="text/javascript" src="upload.js"></script>
</head>
<body>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="upload.js"></script>
  <script src="foundation-5.2.1/js/vendor/jquery.js"></script>
  <script src="foundation-5.2.1/js/foundation.min.js"></script>

<?php
	$host = "localhost";
	$user = "root";
	$pass = "password";
	$directory = "ubica";

	$mysqli = new mysqli($host, $user, $pass, $directory);

?>

<nav class="top-bar" data-topbar>
  <section class="top-bar-section">
    <!-- Right Nav Section -->
    <ul class="left">
      <li style = "max-width:1200px; height:45px"><a href="upload.php"><img src="newlogo.gif"></a></li>
    </ul>
    <ul class="right">
      <li><a href="index.html">Logout</a></li>
    </ul>
  </section>
</nav>

<br />
<br />
<!-- <div class="row"> -->
<div id="form">
	<div class="row">
		<form action="upload.php?uid= <?php echo $_GET['uid']; ?>" method="post" enctype="multipart/form-data">
			<div class="large-4 columns">
			<label for="where">Upload to</label>
			<select name ="folders" id="folders" onchange="Report(this.value)">
				<option default>--Select a folder--</option>
				<?php

					$mysqli = new mysqli($host, $user, $pass, $directory);
					$uid = $_GET['uid'];
				    $current = "SELECT folder FROM folders WHERE uid='$uid'";
				   	$result = mysqli_query($mysqli,$current);

					while ($row = mysqli_fetch_row($result)){
				?>
				    <option value="<?php echo $row[0]; ?>">
				    <?php echo $row[0];         ?>     
				    </option>
				<?php    
				}
				// echo "</select>";
				?>
				<option value="New Folder"> New Folder </option>
			</select>
			</div>
			<div class="large-3 columns">
				<br />
				<!-- <input type="file" name="file" id="file"> -->
				<label class="choose" id="labelfile" for="file">Select a file to upload</label>
				<input class = "actual" type="file" name="file" id="file" onchange="CopyMe(this, 'txtFileName');">
			</div>
			<div class="large-3 columns">
				<br />
				<input id="txtFileName" type="text" readonly="readonly" />
			</div>
			<div class = "large-2 columns">
			<br />
			<!-- <br />
			<br /> -->
			<input class= "uploadb" type="submit" name="submit" value="Upload" onclick="Submit();">
<?php
	if ($mysqli->connect_errno) {
	    printf("Connect failed: %s\n", $mysqli->connect_error);
	    exit();
	}
    if(isset($_POST)) {
    	$allowedExts = array("pdf");
		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = end($temp);
		if ($_FILES["file"]["type"] == "application/pdf") {
			if ($_FILES["file"]["error"] > 0) {
			    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
			    }
			else {
				$folder = $_POST["folders"];
				if ($folder == 'New Folder') {
					$newpass = $mysqli->real_escape_string($_POST["whisper"]);
					$folder = $mysqli->real_escape_string($_POST["new"]);

					// $create = "CREATE TABLE $folder (
					// 	Name VARCHAR(255) NOT NULL UNIQUE PRIMARY KEY,
					// 	Version INT(11) NOT NULL DEFAULT 0,
					// 	DateModified timestamp DEFAULT CURRENT_TIMESTAMP)";
						
					// mysqli_query($mysqli,$create);

					$insert= "INSERT INTO folders VALUES ('$uid', '$newpass', '$folder')";
					mysqli_query($mysqli, $insert);
				}
				$folder = $mysqli->real_escape_string($folder);
				$name = $mysqli->real_escape_string($_FILES["file"]["name"]);
				if (!file_exists($folder)) {
				    mkdir($folder);
				}

				move_uploaded_file($_FILES["file"]["tmp_name"], $folder . "/". $name);

				$current = "SELECT Version FROM files WHERE Name='$name' AND folder='$folder'";
				$result = mysqli_query($mysqli,$current);
				$row = mysqli_fetch_row($result);
				if (mysqli_num_rows($result) != 0) {
					$version = $row[0] + 1;
	      			$sql = "UPDATE Files SET Version ='$version', DateModified =CURRENT_TIMESTAMP WHERE Name='$name' AND folder='$folder'";
	      			mysqli_query($mysqli,$sql);
	      			mysqli_free_result($result);
				}
				else {
					$sql="INSERT INTO files (folder, Name, Version, DateModified) VALUES ('$folder','$name', '0', CURRENT_TIMESTAMP)";
					mysqli_query($mysqli,$sql);
				}
	      		echo "<div id='confirmation'><p>Upload complete</p></div>";
			}
		}
		else{
			    // echo "<div id='confirmation'><p>Invalid file</p></div>";

		}
	}

	// $mysqli->close();
?>
			</div>
	</div>
	<div class="row">
			<div id="hidden" style="display:none">
<!-- 				<br />
				<br />
				<br /> -->
				<div class="row">
					<div class="large-4 columns">
						<div class="large-6 columns">
						     <input class="text" name="new" type="text" placeholder="Folder name">
						</div>
						<div class="large-6 columns">
						     <input class="text" name="whisper" type="password" placeholder="Folder password">
						</div>
					</div>
				</div>
				<div class="row">
					
				</div>
			</div>

	</div>
</div>
	<br />

</form>
</div>
<!-- </div> -->

<!-- <hr /> -->

<?php
	$select = "SELECT folder from folders WHERE uid='$uid'";
	$return = mysqli_query($mysqli, $select);

	while ($row1 = mysqli_fetch_row($return)) {
		$folder = $row1[0];

		$select = "SELECT * from files WHERE folder='$folder'";
		$return2 = mysqli_query($mysqli, $select);


		while($row = mysqli_fetch_array($return2)) {
				$files[] = $row;
		}
	}
	echo "<table border='1'>
	<tr>
	<th>Folder</th>
	<th>Name</th>
	<th>Version</th>
	<th>Date Modified</th>
	</tr>";

	$i = 0;
	while($files[$i]) {
		  echo "<tr>";
		  echo "<td>" . $files[$i]['folder'] . "</td>";
		  echo "<td>" . $files[$i]['Name'] . "</td>";
		  echo "<td>" . $files[$i]['Version'] . "</td>";
		  echo "<td>" . $files[$i]['DateModified'] . "</td>";
		  echo "</tr>";
		  $i += 1;	
	}
	echo "</table>";

?>

</body>
</html>