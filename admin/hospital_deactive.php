<?php
//Database Connection
include("../connection.php");
// Session Start
session_start();
//Deactivate hospital
mysqli_query($con, "UPDATE hospital SET status= 0 WHERE hospital_id='$_GET[id]'");
header("location:hospitalapprove.php");
?>