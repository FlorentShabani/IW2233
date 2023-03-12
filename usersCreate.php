<?php

session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: denied.php");
    exit();
}

require_once('CRUD/usersCRUD.php');

//creates a db connection
$config = new config();

//sends the db informations to the constructor for further functions
$pdo = $config->connDB();
$usersCRUD = new usersCRUD($pdo);

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

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/usersCreate.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <meta name="google" content="notranslate">
    <script defer src="js/validate.js"></script>
    <title>Users | Dashboard</title>
</head>

<body>
    <div class="container">
        <?php include 'headfoot/sidebar.php' ?>
        <div class="registration-form">
            <h1>Create User</h1>
            <form action="usersCreate.php" method="POST" onsubmit="return validateRegister()">
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
                <p>User Role:</p>
                <select id="roles" name="roles">
                    <option value="user" selected>User</option>
                    <option value="admin">Admin</option>
                    <option value="employee">Employee</option>
                </select>
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