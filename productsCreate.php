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

//if create button pressed then send it to database with all attributes
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    $user_added = 'fs57325';
    $date_added = date('Y-m-d');

    $message = $productsCRUD->addProduct($name, $price, $description, $image, $user_added, $date_added);

    header('Location: productsDash.php');
}


?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/productsCreate.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <meta name="google" content="notranslate">
    <script src="js/validate.js"></script>
    <title>Products | Dashboard</title>
</head>

<body>
    <div class="container">
        <?php include 'headfoot/sidebar.php' ?>
        <div class="registration-form">
            <h1>Create Product</h1>
            <form onsubmit="return validateProduct()" action="productsCreate.php" method="POST" enctype="multipart/form-data">
                <p>Product Name:</p>
                <input type="text" id="name" name="name" placeholder="Enter Product Name">
                <p>Price:</p>
                <input type="text" id="price" name="price" placeholder="Enter Price">
                <p>Description:</p>
                <input type="text" id="description" name="description" placeholder="Enter Description (100 Characters)">
                <p>Upload Image:</p>
                <input type ="file" id="image" name="image">
                <input type="submit" name="submit" id="send" value="SUBMIT"><br>
            </form>
            <?php
            if (!empty($message)) {
                echo '<p>' . $message . '</p>';
            }
            ?>
        </div>
    </div>
</body>

</html>