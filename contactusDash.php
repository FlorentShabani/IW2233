<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once('CRUD/contactusCRUD.php');

$config = new config();
$pdo = $config->connDB();
$contactusCRUD = new contactusCRUD($pdo);
$contacts = $contactusCRUD->shfaqTeGjithaMessages();

if(isset($_POST['ID'])){
    $ID = $_POST['ID'];

    $contactusCRUD->deleteMessage($ID);
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/contactusDash.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <meta name="google" content="notranslate">
    <title>Messages | Dashboard</title>
</head>

<body>
    <?php include 'headfoot/sidebar.php' ?>
    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($contacts as $contact) {
                    echo "<tr>";
                    echo "<td>{$contact['fullname']}</td>";
                    echo "<td>{$contact['email']}</td>";
                    echo "<td>{$contact['subject']}</td>";
                    echo "<td>{$contact['message']}</td>";
                    echo "<td>";
                    echo "<form method='POST' action='contactusDash.php'>";
                    echo "<input type='hidden' name='ID' value='{$contact['ID']}'>";
                    echo "<button type='submit'>Delete</button>";
                    echo "</form></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>