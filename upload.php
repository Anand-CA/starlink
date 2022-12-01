<?php
session_start();
include './includes/db.php';

if (isset($_POST["place-order-btn"])) {
    $name = $_FILES["file"]["name"];
    $tmp_name = $_FILES["file"]["tmp_name"];
    $address = $_POST["address"];
    $payment = $_POST["payment"];
    $username = $_SESSION["user_name"];
    $folder = "./uploads/" . $name;
    // place order
    $sql = "INSERT INTO orders (address,user,file,payment) VALUES ('$address', '$username', '$folder','$payment')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        if (move_uploaded_file($tmp_name, $folder)) {
            echo '<script>alert("Order placed successfully")</script>';
        }
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
    <link rel="stylesheet" href="css/upload.css">
    <link rel="stylesheet" href="css/header.css">
    <title>Upload</title>
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <form action="" method="POST" enctype="multipart/form-data" class="container">
        <div id="screen1">
            <input type="file" onchange="handleFile()" name="file" id="file">
            <label class="upload-btn" for="file">
                Upload File
            </label>
            <div id="stl_cont" style="
        width: 35vh;
        height: 35vh;
        margin: 0;
        background: #ebebeb;
      ">

            </div>
            <p id="fileName"></p>
            <button type="button" onclick="nextPage()">Next</button>
        </div>
        <div id="screen2">
            <input name="address" class="address-input" type="text" placeholder="enter address">
            <input name="payment" class="address-input" value="500" type="number" placeholder="amount">
            <button type="submit" name="place-order-btn" class="place-order-btn">Place Order</button>
            <button type="button" onclick="prevPage()">Previous</button>
        </div>
    </form>
</body>
<script src="stl_viewer/stl_viewer.min.js"></script>
<script>
    document.getElementById("screen2").style.display = "none";
    const nextPage = () => {
        const file = document.getElementById("file").files[0];
        if (!file) {
            document.getElementById("fileName").innerHTML = "Please select a file";
            return;
        }
        document.getElementById("screen1").style.display = "none";
        document.getElementById("screen2").style.display = "flex";
    }
    const prevPage = () => {
        document.getElementById("screen1").style.display = "flex";
        document.getElementById("screen2").style.display = "none";
    }
    document.getElementById("fileName").style.display = "none";
    document.getElementById("stl_cont").style.display = "none";
    const handleFile = () => {
        document.getElementById("stl_cont").style.display = "block";
        const file = document.getElementById("file").files[0];
        if (file) {
            document.getElementById("fileName").style.display = "block";
            document.getElementById("fileName").innerHTML = file.name;
            const stl_viewer = new StlViewer(document.getElementById("stl_cont"), {
                singleModel: true,
            });
            stl_viewer.add_model({
                local_file: file
            });
        }

    }
</script>

</html>