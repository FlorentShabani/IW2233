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

if (isset($_POST['update'])) {
    $id = $_POST['update'];
    $user = $usersCRUD->getUserById($id);
}

if(isset($_POST['renew'])) {

    $id = $_POST['ID'];
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $birthdate = $_POST['birthdate'];
    $role = $_POST['roles'];
    $emp_picture = $_FILES['emp_picture']['name'];

    $usersCRUD->updateUser($id, $fullname, $username, $email, $birthdate, $role, $emp_picture);
    header('Location: usersDash.php');
}


?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/usersUpdate.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script defer src="js/validate.js"></script>
    <meta name="google" content="notranslate">
    <title>Users | Dashboard</title>
</head>

<body>
    <div class="container">
        <?php include 'headfoot/sidebar.php' ?>
        <div class="registration-form">
            <h1>UPDATE USER</h1>
            <?php
            echo '<form action="usersUpdate.php" method="POST" onsubmit="return validateRegister()" enctype="multipart/form-data">';
            echo "<input type='hidden' name='ID' value='" . $user['ID'] . "'>";
            echo '<p>Full Name:</p>';
            echo '<input type="text" id="fullname" name="fullname" value="' . $user['fullname'] . '">';
            echo '<p>Username:</p>';
            echo '<input type="text" id="username" name="username" value="' . $user['username'] . '">';
            echo '<p>Email:</p>';
            echo '<input type="text" id="email" name="email" value="' . $user['email'] . '">';
            echo '<p>Date of Birth:</p>';
            echo '<input type="text" id="birthdate" name="birthdate" value="' . $user['birthdate'] . '">';
            echo '<p>User Role:</p>';
            echo '<select id="roles" name="roles">';
            echo '<option value="user" selected>User</option>';
            echo '<option value="admin">Admin</option>';
            echo '<option value="employee">Employee</option>';
            echo '</select>';
            echo '<p>Upload Picture:</p>';
            echo '<input type ="file" id="emp_picture" name="emp_picture">';
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