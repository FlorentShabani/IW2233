<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: denied.php");
    exit();
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <meta name="google" content="notranslate">
    <title>Users | Dashboard</title>
</head>

<body>
    <div class="container">
        <?php include 'headfoot/sidebar.php' ?>
        <div class="welcome-card">
            <h1>Welcome to the Dashboard</h1>
            <p>You have successfully logged in and can now manage your account and access the dashboard features.</p>
        </div>
    </div>
    </div>
</body>

</html>