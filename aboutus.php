<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once('CRUD/usersCRUD.php');

$config = new config();
$pdo = $config->connDB();
$usersCRUD = new usersCRUD($pdo);
$emp = $usersCRUD->fetchEmployeeRoles();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | Stitch</title>
    <link rel="stylesheet" href="style/aboutus.css">
    <link rel="stylesheet" href="style/dropdown.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <meta name="google" content="notranslate">
</head>

<body>
    <script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
    <script src="js/app.js"></script>
    <?php include 'headfoot/header.php' ?>

    <div class="wrapper">
        <div class="emp">
            <p>Our Employees:</p>
        </div>
        <div id="slider">
            <?php
            echo '<ul>';
            foreach ($emp as $emps) {
                echo '<li>';
                echo '<img src="' . $emps['emp_picture'] . '" alt="">';
                echo '<div class="caption">' . $emps['fullname'] . '</div>';
                echo '</li>';
            }
            echo '</ul>';
            ?>
        </div>
        <div class="apply-card">
            <p>Are you passionate about what we do and want to be a part of our team? We're always</p>
            <p>looking for talented individuals who share our values and are committed to making a</p>
            <p>difference. Join us in our mission to suit people and help us create a better</p>
            <p>future for all. Check out our career opportunities and apply today!</p>
            <form action="contactus.php">
                <button type="submit">SEND US A MESSAGE!</button>
            </form>
        </div>
    </div>

    <?php include 'headfoot/footer.php' ?>
</body>

</html>