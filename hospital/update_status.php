<?php
include("../connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['app_id']) && isset($_POST['status'])) {
    $app_id = $_POST['app_id'];
    $status = $_POST['status'];

    // Update the status in the database
    $query = "UPDATE appointment SET status = $status WHERE app_id = $app_id";
    if (mysqli_query($con, $query)) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'invalid_request';
}
?>