<?php

session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: denied.php");
    exit();
}

require_once('CRUD/productsCRUD.php');

//creates a db connection
$config = new config();

//sends the db informations to the constructor for further functions
$pdo = $config->connDB();
$productsCRUD = new productsCRUD($pdo);

if (isset($_POST['update'])) {
    $id = $_POST['update'];
    $prod = $productsCRUD->getProdById($id);
}

//if update button pressed then send it to database with all attributes
if (isset($_POST['renew'])) {
    $prodid = $_POST['prodid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    $user_added = 'fs57325';
    $date_added = date('Y-m-d');

    $message = $productsCRUD->updateProduct($prodid, $name, $price, $description, $image, $user_added, $date_added);

    header('Location: productsDash.php');
}


?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/productsUpdate.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <meta name="google" content="notranslate">
    <script src="js/validate.js"></script>
    <title>Update Product | Dashboard</title>
</head>

<body>
    <div class="container">
        <?php include 'headfoot/sidebar.php' ?>
        <div class="registration-form">
            <h1>UPDATE USER</h1>
            <?php
            echo '<form action="productsUpdate.php" method="POST" onsubmit="return validateProduct()" enctype="multipart/form-data">';
            echo "<input type='hidden' name='prodid' value='" . $prod['prodid'] . "'>";
            echo '<p>Product Name:</p>';
            echo '<input type="text" id="name" name="name" value="' . $prod['name'] . '">';
            echo '<p>Price:</p>';
            echo '<input type="text" id="price" name="price" value="' . $prod['price'] . '">';
            echo '<p>Description:</p>';
            echo '<input type="text" id="description" name="description" value="' . $prod['description'] . '">';
            echo '<p>Upload Picture:</p>';
            echo '<input type ="file" id="image" name="image">';
            echo '<input type="submit" name="renew" id="renew" value="UPDATE"><br>';
            echo '</form>';
            ?>
            <?php
            if (!empty($message)) {
                echo '<p>' . $message . '</p>';
            }
            ?>
        </div>
    </div>
</body>

</html>