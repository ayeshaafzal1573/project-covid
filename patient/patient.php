<?php
// Database Connection
include("../connection.php");
// Session Start
session_start();
//if user loggout
if (!isset($_SESSION['patient_id'])) {
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient</title>

</head>

<body>
    <a href="bookappointment.php"><button>Book Appointment</button></a>

    <!-- dashboard -->
    <a href="myappointment.php">My Appointment</a>
    <a href="covidreport.php">COVID Report</a>

    <!-- PHP -->
    <?php

    if (!isset($_SESSION['patient_id'])) {
        header("Location: ../login.php");
        exit;
    }
    ?>
    <!-- PHP -->
</body>

</html>