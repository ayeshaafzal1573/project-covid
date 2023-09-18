<?php
//Database Connection
include("../connection.php");
// Session Start
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Patient Booking Details</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Patient Name</th>
            <th>Test Name</th>
            <th>Hospital Name</th>
            <th>Date</th>
            <th>Time</th>
        </tr>
        <!-- PHP -->
        <?php
        $query = "SELECT a.app_id, p.patient_name, h.hospital_name,test_name, a.app_date, a.app_time
          FROM appointment a
          LEFT JOIN patient p ON a.patient_id = p.patient_id
          LEFT JOIN hospital h ON a.hospital_id = h.hospital_id";

        $result = mysqli_query($con, $query);
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>{$row['app_id']}</td>";
            echo "<td>{$row['patient_name']}</td>";
            echo "<td>{$row['test_name']}</td>";
            echo "<td>{$row['hospital_name']}</td>";
            echo "<td>{$row['app_date']}</td>";
            echo "<td>{$row['app_time']}</td>";
            echo "</tr>";
        }
        ?>
        <!-- PHP -->
    </table>
</body>

</html>