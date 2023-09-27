<?php
//Database Connection
include("../connection.php");
// Session Start
session_start();
//Negative Report
mysqli_query($con, "UPDATE appointment SET status= 0 WHERE app_id='$_GET[app_id]'");
header("location:patientappointment.php");


?>