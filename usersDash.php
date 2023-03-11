<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once('CRUD/usersCRUD.php');

$config = new config();

$pdo = $config->connDB();

$usersCRUD = new usersCRUD($pdo);
$users = $usersCRUD->readAllUsers();

if (isset($_POST['ID'])) {
    $ID = $_POST['ID'];

    $usersCRUD->deleteUser($ID);
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/usersDash.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <meta name="google" content="notranslate">
    <title>Users | Dashboard</title>
</head>

<body>
    <div class = "container">
        <?php include 'headfoot/sidebar.php' ?>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Birthdate</th>
                            <th>Password</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($users as $user) {
                            echo "<tr>";
                            echo "<td>{$user['fullname']}</td>";
                            echo "<td>{$user['username']}</td>";
                            echo "<td>{$user['email']}</td>";
                            echo "<td>{$user['birthdate']}</td>";
                            echo "<td>{$user['password']}</td>";
                            echo "<td>{$user['role']}</td>";
                            echo "<td>";
                            echo "<form method='POST' action='usersDash.php'>";
                            echo "<input type='hidden' name='ID' value='{$user['ID']}'>";
                            echo "<button type='submit'>Create</button>";
                            echo "<input type='hidden' name='ID' value='{$user['ID']}'>";
                            echo "<button type='submit'>Update</button>";
                            echo "<input type='hidden' name='ID' value='{$user['ID']}'>";
                            echo "<button type='submit'>Delete</button>";
                            echo "</form></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
    </div>
</body>

</html>