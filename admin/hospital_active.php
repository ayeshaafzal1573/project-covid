<?php
//Database Connection
include("../connection.php");
// Session Start
session_start();
//Activate Hospital
mysqli_query($con, "UPDATE hospital SET status= 1 WHERE hospital_id='$_GET[id]'");
header("location:hospitalapprove.php");


?>