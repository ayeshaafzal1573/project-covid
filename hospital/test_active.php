<?php
//Database Connection
include("../connection.php");
// Session Start
session_start();
//Positive Report 
mysqli_query($con, "UPDATE appointment SET status= 1 WHERE app_id='$_GET[app_id]'");
header("location:patientappointment.php");


?>