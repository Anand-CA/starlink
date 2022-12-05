<?php
session_start();
include '../includes/db.php';
if ($_SESSION["user_role"] !== 'admin') {
    header("Location: login.php");
}

if (isset($_GET["logout-btn"])) {
    session_destroy();
    header("Location: login.php");
}

if (isset($_POST["delete-btn"])) {
    $id = $_POST["id"];
    $sql1 = "DELETE FROM `orders` WHERE id = '$id'";
    $result1 = mysqli_query($conn, $sql1);
    if ($result1) {
        echo '<script>alert("Order deleted successfully")</script>';
    } else {
        echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
    }
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
                    <th>actions</th>
                </tr>
            </thead>

            <tbody>
                <?php
                include '../includes/db.php';
                // veiw all orders here
                $sql = "SELECT * FROM orders";
                $result = mysqli_query($conn, $sql);
                // if result is greater than 0 
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $arr = json_decode($row["address"], true);
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $arr["address"] . ", " . $arr["state"] . ", " . $arr["pincode"] . "</td>";
                        echo "<td>" . $row["user"] . "</td>";
                        echo "<td>" . $row["file"] . "</td>";
                        echo "<td>₹ " . $row["payment"] . "</td>";
                        echo "<td>
                            <form action='' method='POST'>
                                <input type='number' hidden name='id' value='" . $row["id"] . "'>
                                <input type='submit' name='delete-btn' value='Delete'>
                            </form>
                        </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>