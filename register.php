<?php
session_start();
include 'includes/db.php';

if (isset($_POST["register-btn"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $hash_pass = md5($password);

    $sql = "INSERT INTO users (name, email, phone,password, role) VALUES ('$name', '$email', '$phone', '$hash_pass', 'user')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./logincss.css">

    <style>
        .signupdiv {
            width: 100%;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.5)50%, rgba(0, 0, 0, 0.5)50%), url(Background3d.jpg);
            text-align: center;
            background-position: center;
            background-size: cover;
            height: 100vh;
            animation-name: smooth;
            animation-duration: 1s;
        }

        @keyframes smooth {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <div class="signupdiv" id="signup">
        <div class="form1">
            <form action="" method="POST">
                <h2>REGISTER</h2>
                <input required type="text" class="signup" required name="name" placeholder="Name"><br><br>
                <input required type="email" class="signup" required name="email" placeholder="Email"><br><br>
                <input required type="number" class="signup" required name="phone" placeholder="PH.NO"><br><br>
                <input required type="password" class="signup" required name="password" placeholder="Password"><br><br>
                <button name="register-btn" class="btnn">SIGN UP</a></button>
            </form>
            <p class="account">Already have an account<br></p>
            <button class="signupbtnn"><a href="login.php">Sign In</a></button>
        </div>
    </div>

</body>

</html>