<?php

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

require_once('CRUD\usersCRUD.php');

$config = new config();
$pdo = $config->connDB();

$usersCRUD = new usersCRUD($pdo);

$message = '';

if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $birthdate = $_POST['birthdate'];
    $password = $_POST['password'];
    $role = $_POST['roles'];

    $message = $usersCRUD->createUser($fullname, $username, $email, $birthdate, $password, $role);

}

?>


<html>

<head>
    <title>Sign up</title>
    <link rel="stylesheet" type="text/css" href="style/register.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script defer src="js/validate.js"></script>
    <meta name="google" content="notranslate">
</head>

<body>
    <div class="registration-form">
        <h1>Sign up | Stitch</h1>
        <form action="register.php" method="POST" onsubmit="return validateRegister()">
            <p>Full Name:</p>
            <input type="text" id="fullname" name="fullname" placeholder="Enter Full Name">
            <p>Username:</p>
            <input type="text" id="username" name="username" placeholder="Enter Username">
            <p>Email:</p>
            <input type="text" id="email" name="email" placeholder="Enter Email">
            <p>Date of Birth:</p>
            <input type="text" id="birthdate" name="birthdate" placeholder="Enter Date (YYYY.MM.DD)">
            <p>Password:</p>
            <input type="password" id="password" name="password" placeholder="Enter Password">
            <p>Confirm Password:</p>
            <input type="password" id="cpassword" name="cpassword" placeholder="Confirm Password">
            <input type='hidden' name='roles' value='user'>
            <input type="submit" name="submit" id="send" value="SIGN UP"><br>
            <a href="login.php"> Already have an account?</a>
        </form>
        <?php
        if (!empty($message)) {
            echo '<p>' . $message . '</p>';
        }
        ?>
    </div>
</body>

</html>