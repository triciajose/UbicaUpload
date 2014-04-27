<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	    <title>UbiCADocshare</title>
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

	if (empty($_GET['uid'])) {
		header("Location: index.html");
	}
?>

<nav class="top-bar" data-topbar>
  <section class="top-bar-section">
    <!-- Right Nav Section -->
    <ul class="left">
      <li style = "max-width:1200px; height:45px"><a href="upload.php?uid= <?php echo $_GET['uid']; ?>"><img src="newlogo.gif"></a></li>
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
		<form  method="post" enctype="multipart/form-data">
			<div class="large-4 columns">
				<div class = "row">
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
				<div class="row">
					<div id="hidden" style="display:none">
						<br />
					
						<div class="row">
							<div class="large-10 columns">
								<div class="large-6 columns">
								     <input class="text" name="new" type="text" autocomplete="off" placeholder="Folder name">
								</div>
								<div class="large-6 columns">
								     <input class="text" name="whisper" type="password" autocomplete="off" placeholder="Folder password">
								</div>
							</div>
						</div>
						<div class="row">
							
						</div>
					</div>

				</div>

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
    	if ($_POST["folders"] == '--Select a folder--') {
    		echo '<script language="javascript">';
			echo 'alert("Please select or add a folder")';
			echo '</script>';
    	}
    	else {
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

						$check = "SELECT folder from folders WHERE key1='$newpass'";
						$return = mysqli_query($mysqli, $check);
						$row = mysqli_fetch_row($return);
						if (mysqli_num_rows($return) != 0) {
							$error = 1;
							echo '<script language="javascript">';
							echo 'alert("Please select a different folder password")';
							echo '</script>';
						}
						
						$check = "SELECT folder from folders WHERE folder='$folder'";
						$return = mysqli_query($mysqli, $check);
						$row = mysqli_fetch_row($return);
						if (mysqli_num_rows($return) == 0) {
							$insert= "INSERT INTO folders VALUES ('$uid', '$newpass', '$folder')";
							mysqli_query($mysqli, $insert);
						}
						else {
							$error = 1;
							echo '<script language="javascript">';
							echo 'alert("Please select a different folder name")';
							echo '</script>';
						}
					}
					if ($error !=1 ) {
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
			}
			else{
				// echo '<script language="javascript">';
				// echo 'alert("Invalid file type")';
				// echo '</script>';

			}
		}
	}

	// $mysqli->close();
?>
			</div>
	</div>
	<!-- HIDDEN -->
</div>
	<br />

</form>
</div>
<!-- </div> -->

<!-- <hr /> -->
<div style= "position:relative">

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
	}echo "<form action ='delete.php?uid=" .  $_GET['uid'] . "' method='post'><table border='1'>
	<tr> 	
	<th>Folder</th>
	<th>Folder Password</th>
	<th>Name</th>
	<th>Version</th>
	<th>Date Modified</th>
	<th> </th>
	</tr>";


	$i = 0;
	while($files[$i]) {
		$name = $files[$i]['folder'];
		$select = "SELECT * from folders WHERE folder='$name'";
		$return = mysqli_query($mysqli, $select);
		$row = mysqli_fetch_row($return);
		$key = $row[1];
		  echo "<tr>";		  
		  echo "<td>" . $name . "</td>";
		  echo "<td>" . $key . "</td>";
		  echo '<td><a href="http://142.103.25.29/UbicaUpload/' . $name . '/' . $files[$i]['Name'] . '" >' . $files[$i]['Name'] . '</a></td>';
		  echo "<td>" . $files[$i]['Version'] . "</td>";
		  echo "<td>" . $files[$i]['DateModified'] . "</td>";
		  echo "<td> <input type='radio' name='what' value='" . $files[$i]['Name'] ."'></td>";
		  echo "</tr>";
		  $i += 1;	
	}
	echo "</table><input class= 'choose right' type='submit' name='delete' value='Delete'>
	</form>";


?>
</div>
</body>
</html>