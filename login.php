<?php
session_start();
include 'includes/db.php';

if (isset($_POST["login-btn"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];
  $hash_pass = md5($password);

  $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$hash_pass'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  if ($row) {
    $_SESSION["user_id"] = $row["id"];
    $_SESSION["user_name"] = $row["name"];
    $_SESSION["user_email"] = $row["email"];
    $_SESSION["user_role"] = $row["role"];
    header("Location: dashboard.php");
  } else {
    echo "Invalid email or password";
  }
}
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login Page</title>
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
        <h2>Login</h2>
        <input type="email" name="email" placeholder="Enter Email Here" required>
        <input type="password" name="password" placeholder="Enter Password Here" required>

        <button name="login-btn" class="btnn">Login</button>
      </form>
      <p class="account">Don't have an account<br> Join Us</p>
      <button class="signupbtnn"><a href="register.php">Sign Up</a></button>
    </div>
  </div>
</body>

</html>