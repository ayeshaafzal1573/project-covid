<?php
// Database Connection
include("../connection.php");
// Session Start
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Dashboard</title>
</head>

<body>
    <h1>Hospital Dashboard</h1>
    <a href="covidtest.php">Test</a>
    <a href="vaccination.php">Vaccination</a>

    <?php
    // Check if the user is logged in as a hospital
    if (!isset($_SESSION['hospital_id'])) {
        header("Location: ../login.php");
        exit;
    }

    // Fetch and display details of the logged-in hospital
    $hospital_id = $_SESSION['hospital_id'];
    $query = "SELECT * FROM hospital WHERE hospital_id = $hospital_id";
    $result = mysqli_query($con, $query);

    ?>
</body>

</html>