<?php
include('connection.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    <?php

    if (!isset($_SESSION['admin_id'])) {
        header("Location: ../login.php");
        exit;
    }
    ?>
</body>

</html>