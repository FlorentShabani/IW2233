<?php

session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: denied.php");
    exit();
}

require_once('CRUD/productsCRUD.php');

$config = new config();

$pdo = $config->connDB();

$prodCRUD = new productsCRUD($pdo);
$products = $prodCRUD->shfaqTeGjithaProduktet();
if (isset($_POST['update'])) {
    header('Location: productsUpdate.php');
    exit;
}

if (isset($_POST['prodid'])) {
    $prodid = $_POST['prodid'];

    $prodCRUD->deleteProduct($prodid);
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/productsDash.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <meta name="google" content="notranslate">
    <title>Products | Dashboard</title>
</head>

<body>
    <div class = "container">
        <?php include 'headfoot/sidebar.php' ?>
            <div class="product-create">
                <p>Do you want to create a product?</p>
                <form action="productsCreate.php">
                <button type="submit">Create</button>
                </form>
            </div>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Added from</th>
                            <th>Date added</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($products as $prod) {
                            echo "<tr>";
                            echo "<td>{$prod['name']}</td>";
                            echo "<td>€{$prod['price']}</td>";
                            echo "<td>{$prod['description']}</td>";
                            echo "<td>{$prod['image']}</td>";
                            echo "<td>{$prod['user_added']}</td>";
                            echo "<td>{$prod['date_added']}</td>";
                            echo "<td>";
                            echo "<form method='POST' action='productsUpdate.php'>";
                            echo "<input type='hidden' name='update' value='{$prod['prodid']}'>";
                            echo "<button type='submit'>Update</button></form>";
                            echo "<form method='POST' action='productsDash.php'>";
                            echo "<input type='hidden' name='prodid' value='{$prod['prodid']}'>";
                            echo "<button type='submit'>Delete</button>";
                            echo "</form></td>";
                            echo "</tr>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
    </div>
</body>

</html>