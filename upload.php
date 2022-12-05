<?php
session_start();
include './includes/db.php';

if (isset($_POST["place-order-btn"])) {
    $name = $_FILES["file"]["name"];
    $tmp_name = $_FILES["file"]["tmp_name"];
    $username = $_SESSION["user_name"];
    $folder = "./uploads/" . $name;

    $address = mysqli_real_escape_string($conn, $_POST["address"]);
    $amount = mysqli_real_escape_string($conn, $_POST["amount"]);
    $fullname = mysqli_real_escape_string($conn, $_POST["fullname"]);
    $city = mysqli_real_escape_string($conn, $_POST["city"]);
    $state = mysqli_real_escape_string($conn, $_POST["state"]);
    $pincode = mysqli_real_escape_string($conn, $_POST["pincode"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $card_name = mysqli_real_escape_string($conn, $_POST["card_name"]);
    $card_no = mysqli_real_escape_string($conn, $_POST["card_no"]);
    $card_cvv = mysqli_real_escape_string($conn, $_POST["card_cvv"]);

    // store details in json
    $jsondata = array(
        "address" => $address,
        "amount" => $amount,
        "fullname" => $fullname,
        "city" => $city,
        "state" => $state,
        "pincode" => $pincode,
        "email" => $email,
        "card_name" => $card_name,
        "card_no" => $card_no,
        "card_cvv" => $card_cvv
    );

    $jsondata = json_encode($jsondata);

    $sql = "INSERT INTO orders (address,user,file,payment) VALUES ('$jsondata', '$username', '$folder','$amount')";
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
            <div>
                <h2>Billing Address</h2>
                <input name="fullname" class="address-input" type="text" placeholder="Full Name">
                <input name="email" class="address-input" type="text" placeholder="Email">
                <input name="address" class="address-input" type="text" placeholder="Address">
                <input name="city" class="address-input" type="text" placeholder="City">
                <input name="state" class="address-input" type="text" placeholder="State">
                <input name="pincode" class="address-input" type="text" placeholder="Pincode">
            </div>

            <div>
                <h2>Payment</h2>
                <input name="card_name" class="address-input" type="text" placeholder="Name on card">
                <input name="card_no" class="address-input" type="text" placeholder="Card no.">
                <input name="cvv" class="address-input" type="text" placeholder="CVV">
                <input name="amount" hidden class="address-input" value="500" type="number" placeholder="amount">
            </div>

            <div>

                <button type="submit" name="place-order-btn" class="place-order-btn">Place Order</button>
                <button type="button" onclick="prevPage()">Previous</button>
                <p>Order Total: 500rs</p>
            </div>
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