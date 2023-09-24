<?php
session_start();
if (!isset($_SESSION['patient_id'])) {
    header("Location: login.php");
    exit();
}

include("../connection.php");

$patient_name = "";
$address = "";
$email = "";

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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the updated data from the form
    $new_patient_name = $_POST["patient_name"];
    $new_address = $_POST["address"];
    $new_email = $_POST["email"];

    // Update the patient's profile data in the database
    $query = "UPDATE `patient` SET `patient_name`='$new_patient_name', `address`='$new_address', `email`='$new_email' WHERE `patient_id` = $patient_id";

    if (mysqli_query($con, $query)) {
        header("Location: myprofile.php"); // Redirect to the profile page after successful update
        exit();
    } else {
        echo "Error updating profile: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<body>
    <h1>Edit Profile</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="patient_name">Name:</label>
        <input type="text" name="patient_name" value="<?php echo $patient_name; ?>"><br>

        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo $address; ?>"><br>

        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo $email; ?>"><br>

        <input type="submit" value="Update Profile">
    </form>
</body>
</html>
