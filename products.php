<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once('CRUD/productsCRUD.php');

$config = new config();
$pdo = $config->connDB();
$productsCRUD = new productsCRUD($pdo);
$products = $productsCRUD->shfaqTeGjithaProduktet();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | Stitch</title>
    <link rel="stylesheet" href="style/products.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <meta name="google" content="notranslate">
</head>

<body>
    <?php include 'headfoot/header.php'?>

    <div class="wrapper">
        <div class="shoppingbox">
            <?php
            foreach ($products as $product) {
            ?>
                <div class="product1">
                    <img src="<?php echo $product['image']; ?>"  style="width:100%">
                    <h1><?php echo $product['name']; ?></h1>
                    <p class="price1">€<?php echo $product['price']; ?></p>
                    <p><?php echo $product['description']; ?></p>
                    <p><button>Add to Cart</button></p>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <?php include 'headfoot/footer.php'?>
</body>

</html>