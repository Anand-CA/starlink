<?php
session_start();
include 'includes/db.php';

// check if user is logged in
if (!isset($_SESSION["user_id"])) {
	header("Location: login.php");
}

if($_SESSION["user_role"] !== 'user'){
	header("Location: login.php");
}

if (isset($_GET["logout-btn"])) {
	session_destroy();
	header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard</title>
	<link rel="stylesheet" href="css/dashboard.css">
</head>

<body>
	<!-- nav -->
	<?php include 'includes/header.php'; ?>

	<div class="content">
		<h2>Welcome to StarLink</h2>
		<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Assumenda, ea quo. Optio, quod tempore id reiciendis fugiat repellat aliquid eaque esse aperiam obcaecati magni? Placeat temporibus repellat in magnam eum.</p>
	</div>

</body>

</html>