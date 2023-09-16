<?php
session_start();

include '../connection.php';

$selectquery = "SELECT * FROM hospital where hospital_id = '$h_id'";

if (isset($_GET['hospital_id'])) {

    $h_id = $_GET['hospital_id'];
    $res = mysqli_query($con, $selectquery);
    $res2 = mysqli_fetch_array($res);
    $name = $res2['hospital_name'];
    $location = $res2['location'];
    $insert = "
INSERT INTO hospital(hospital_name, location) VALUES ('$name','$location');";
    $insert .= "
delete from hospital where hospital_id = '$h_id'";

    $res3 = mysqli_multi_query($con, $insert);
    $_SESSION['hospital_id'] = $res2['hospital_id'];

} else {
    echo "Hospital ID is not provided in the URL.";
}





?>