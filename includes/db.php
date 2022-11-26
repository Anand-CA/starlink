<?php
		$servername = "localhost";
		$user = "root";
		// empty pass if using windows
		$password = "root";
		$dbname = "starlink";
        
		$conn = mysqli_connect($servername, $user, $password, $dbname);
		if (!$conn) {
		  die("Connection failed: " . mysqli_connect_error());
		}
?>