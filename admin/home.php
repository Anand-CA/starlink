<?php
session_start();
    if($_SESSION["user_role"] !== 'admin'){
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
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/admin/home.css">
    <title>Admin</title>
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="container">
        

        <table border="2">
            <thead>
                <tr>
                    <th>order Id</th>
                    <th>Address</th>
                    <th>Username</th>
                    <th>File</th>
                    <th>Payment</th>
                </tr>
            </thead>

            <tbody>
                <?php 
        include '../includes/db.php';
            // veiw all orders here
            $sql = "SELECT * FROM orders";
            $result = mysqli_query($conn, $sql);
            // if result is greater than 0 
            if(mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_assoc($result)){
                    echo '
                    <tr>
                        <td>'.$row["id"].'</td>
                        <td>'.$row["address"].'</td>
                        <td>'.$row["user"].'</td>
                        <td>'.$row["file"].'</td>
                        <td>'.$row["payment"].' Rs</td>
                    </tr>';
                }
            }
        ?>
            </tbody>
        </table>
    </div>
</body>

</html>