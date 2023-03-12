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

//reads all users for the dashboard
$users = $usersCRUD->readAllUsers();

if (isset($_POST['update'])) {
    header('Location: usersUpdate.php');
    exit;
}
//deletes a user when the delete button is pressed
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
    <div class="container">
        <?php include 'headfoot/sidebar.php' ?>
        <div class="user-create">
            <p>Do you want to create a user?</p>
            <form action="usersCreate.php">
                <button type="submit">Create</button>
            </form>
        </div>
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Birthdate</th>
                        <th>Role</th>
                        <th>Image</th>
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
                        echo "<td>{$user['role']}</td>";
                        echo "<td>{$user['emp_picture']}</td>";
                        echo "<td>";
                        echo "<form method='POST' action='usersUpdate.php'>";
                        echo "<input type='hidden' name='update' value='{$user['ID']}'>";
                        echo "<button type='submit'>Update</button></form>";
                        echo "<form method='POST' action='usersDash.php'>";
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