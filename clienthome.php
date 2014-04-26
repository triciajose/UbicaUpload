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
?>

<nav class="top-bar" data-topbar>
  <section class="top-bar-section">
    <!-- Right Nav Section -->
    <ul class="left">
      <li style = "max-width:1200px; height:45px"><img src="newlogo.gif"></a></li>
    </ul>
    <ul class="right">
      <li><a href="client.php">Logout</a></li>
    </ul>
  </section>
</nav>


<?php
	$password = $mysqli->real_escape_string($_POST["password"]);

	$select = "SELECT folder from folders WHERE key1='$password'";
	$return = mysqli_query($mysqli, $select);

	while ($row1 = mysqli_fetch_row($return)) {
		$folder = $row1[0];

		$select = "SELECT * from files WHERE folder='$folder'";
		$return2 = mysqli_query($mysqli, $select);


		while($row = mysqli_fetch_array($return2)) {
				$files[] = $row;
		}
	}echo "<table border='1'>
	<tr> 	
	<th>Name</th>
	<th>Version</th>
	<th>Date Modified</th>
	</tr>";


	$i = 0;
	while($files[$i]) {
		$name = $files[$i]['folder'];
		$select = "SELECT * from folders WHERE folder='$name'";
		$return = mysqli_query($mysqli, $select);
		$row = mysqli_fetch_row($return);
		$key = $row[1];
		  echo "<tr>";		  
		  echo '<td><a href="http://142.103.25.29/UbicaUpload/' . $name . '/' . $files[$i]['Name'] . '" >' . $files[$i]['Name'] . '</a></td>';
		  echo "<td>" . $files[$i]['Version'] . "</td>";
		  echo "<td>" . $files[$i]['DateModified'] . "</td>";
		  echo "</tr>";
		  $i += 1;	
	}
	echo "</table>";


?>

</body>
</html>