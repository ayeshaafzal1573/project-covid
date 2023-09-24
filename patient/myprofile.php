<?php
//Database Connection
include("../connection.php");
// Session Start
session_start();
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
  

</body>

</html>