<?php

if (isset($_SESSION['username'])) {
    header("Location: index.php");
    session_start();
}

require_once('CRUD\usersCRUD.php');

$config = new config();
$pdo = $config->connDB();

$usersCRUD = new usersCRUD($pdo);

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $message = $usersCRUD->login($username, $password);
}
?>

<html>

<head>
    <title>Login | Stitch</title>
    <link rel="stylesheet" type="text/css" href="style/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script defer src="js/validate.js"></script>
    <meta name="google" content="notranslate">
</head>

<body>
    <div class="loginbox">
        <h1>Log in</h1>
        <form onsubmit="return validateLogin()" action="login.php" method="POST">
            <p>Username</p>
            <input type="text" id="username" name="username" placeholder="Enter Username">
            <p>Password</p>
            <input type="password" id="password" name="password" placeholder="Enter Password">
            <input type="submit" name="submit" value="LOGIN"><br>
            <a href="register.php">Don't have an account?</a>
        </form>
        <?php
        if (!empty($message)) {
            echo '<p>' . $message . '</p>';
        }
        ?>
    </div>
</body>

</html>