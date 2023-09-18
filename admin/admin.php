<?php
//Database Connection
include("../connection.php");
// Session Start
session_start();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Admin Panel</h1>
    <a href="patientrecord.php">Patient Record</a>
    <a href="result.php">Covid Result</a>
    <a href="testdetails.php">Booking Details</a>
    <a href="hospitaldetails.php">Hospital</a>
    <!-- PHP -->
    <?php

    if (!isset($_SESSION['admin_id'])) {
        header("Location: ../login.php");
        exit;
    }
    ?>
    <!-- PHP -->
</body>

</html>