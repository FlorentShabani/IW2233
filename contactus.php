<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once('CRUD/contactusCRUD.php');

if (isset($_POST['submit'])) {
    $config = new config();

    $pdo = $config->connDB();
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $contactCRUD = new contactusCRUD($pdo);

    $message = $contactCRUD->saveToDatabase($fullname, $email, $subject, $message);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact us | Stitch</title>
    <link rel="stylesheet" href="style/contactus.css">
    <link rel="stylesheet" href="style/dropdown.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script defer src="js/validate.js"></script>
    <meta name="google" content="notranslate">
</head>

<body>
    <?php include 'headfoot/header.php' ?>

    <div class="wrapper">
        <div class="contactus">
            <h1>Contact us</h1>
            <form onsubmit="return validateContact()" action="contactus.php" method="POST">
                <p>Full Name</p>
                <input type="text" id="fullname" name="fullname" placeholder="Enter Full Name">
                <p>Email</p>
                <input type="text" id="email" name="email" placeholder="Enter Email">
                <p>Subject</p>
                <input type="text" id="subject" name="subject" placeholder="Enter Subject (100 Characters)">
                <p>Send us a message</p>
                <input type="text" id="message" name="message" placeholder="Enter Message (480 Characters)">
                <input type="submit" name="submit" value="Contact us"><br>
            </form>
            <?php
            if (!empty($message)) {
                echo '<p>' . $message . '</p>';
            }
            ?>
        </div>
    </div>

    <?php include 'headfoot/footer.php' ?>
</body>

</html>