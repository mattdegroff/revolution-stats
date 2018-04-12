<?php
$host_name  = "166.62.75.228";
$database   = "revolutionStats";
$user_name  = "mh37tmo638xn";
$password   = "#UVMI3Kr4";

  //mh37tmo638xn
  //#UVMI3Kr4

	$conn = mysqli_connect($host_name, $user_name, $password, $database);

	if ($conn->connect_error) {
		echo '<script>console.log("Connection failed: "' . $conn->connect_error . '");</script>';
	}
	else {
		echo '<script>console.log("Connection Established");</script>';
	}
?>
