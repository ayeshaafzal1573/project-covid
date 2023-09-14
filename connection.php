<?php
// CONNECTION
$con = new mysqli('localhost', 'root', '', 'project_covid');
if ($con->connect_error) {
    die("Connection Failed: " . $con->connect_error);

}
?>