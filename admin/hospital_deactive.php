<?php
include("../connection.php");
mysqli_query($con, "UPDATE hospital SET status= 0 WHERE hospital_id='$_GET[id]'");

header("location:hospitalapprove.php");
?>