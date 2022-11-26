<?php
session_start();
	$name=$_POST['name'];
	$email=$_POST['email'];
    $phno=$_POST['phno'];
	$password=MD5($_POST['password']);
	$dbhost="localhost";
	$dbuser="root";
	$dbpass="";

	
	$con=mysqli_connect($dbhost,$dbuser,$dbpass,"3dprinting");
		if($con->connect_error)
		{
			die("connection failed".$con->connect_error);
		}
		else
		{
			echo "connection successfull";
		}
        $sql="SELECT * FROM users WHERE email='".$_POST["email"]."' AND password='".$_POST["password"]."'";
        $result=$con->query($sql);
        if(mysqli_num_rows($result)>0){
            echo "Success";
            $_SESSION["user"]=$_POST["email"];
        }
        ?>