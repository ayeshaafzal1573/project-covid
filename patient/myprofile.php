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
$patient_id = $_SESSION['patient_id'];
$query = "SELECT * FROM `patient` WHERE `patient_id` = $patient_id";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Database query failed: " . mysqli_error($con));
}

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $patient_name = $row['patient_name'];
    $address = $row['address'];
    $email = $row['email'];
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
</head>

<body>
    <h1>My Profile</h1>
    <p><strong>Name:</strong>
        <?php echo $patient_name; ?>
    </p>
    <p><strong>Address:</strong>
        <?php echo $address; ?>
    </p>
    <p><strong>Email:</strong>
        <?php echo $email; ?>
    </p>
    <p><a href="edit_profile.php">Edit Profile</a></p>
</body>

</html>