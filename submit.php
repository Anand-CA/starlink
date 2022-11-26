<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Creating Database</title>
</head>
<body>
<?php
	$name=$_POST['name'];
	$email=$_POST['email'];
    $phno=$_POST['phno'];
	$password=MD5($_POST['password']);
	$dbhost="localhost";
	$dbuser="root";
	$dbpass="";

	
	$con=mysqli_connect($dbhost,$dbuser,$dbpass,"starlink");
		if($con->connect_error)
		{
			die("connection failed".$con->connect_error);
		}
		else
		{
			echo "connection successfull";
		}
	     $sql="INSERT INTO user(name,email,phno,pass)
		 VALUES('$name','$email','$phno','$password')";
		 if(mysqli_query($con,$sql))
		 {
			 	header("Location:model.php");
		 }
		 else
		 {
			 echo ("error in insertion");
		 }
		 mysqli_close();
		 ?>
</body>
</html>